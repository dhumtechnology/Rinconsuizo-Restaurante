<?php
/**
 * Envío de correo vía SMTP (PHPMailer).
 * Requiere variables SMTP_* en .env / entorno del contenedor.
 *
 * @return array{ok: bool, error: string}
 */

function cargar_env_smtp_si_falta()
{
    if (getenv('SMTP_HOST')) {
        return;
    }
    $envFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';
    if (!is_readable($envFile)) {
        return;
    }
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
            continue;
        }
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value, " \t\"'");
        if ($key === '') {
            continue;
        }
        $actual = getenv($key);
        // Docker puede inyectar SMTP_* vacío; en ese caso sí leemos .env
        if ($actual !== false && $actual !== '') {
            continue;
        }
        putenv($key . '=' . $value);
        $_ENV[$key] = $value;
    }
}

function enviar_correo_web($para, $asunto, $html, $nombreDestino = '')
{
    cargar_env_smtp_si_falta();

    $host = getenv('SMTP_HOST') ?: '';
    $user = getenv('SMTP_USER') ?: '';
    $pass = getenv('SMTP_PASS') ?: '';
    $port = (int) (getenv('SMTP_PORT') ?: 587);
    $fromEmail = getenv('SMTP_FROM_EMAIL') ?: $user;
    $fromName = getenv('SMTP_FROM_NAME') ?: 'Rincon Suizo';
    $secure = strtolower(getenv('SMTP_SECURE') ?: 'tls');

    if ($para === '' || !filter_var($para, FILTER_VALIDATE_EMAIL)) {
        return [
            'ok' => false,
            'error' => 'Correo destino inválido',
        ];
    }

    if ($host === '' || $user === '' || $pass === '') {
        return [
            'ok' => false,
            'error' => 'SMTP no configurado (SMTP_HOST, SMTP_USER, SMTP_PASS en .env)',
        ];
    }

    require_once __DIR__ . '/PHPMailer-5.2-stable/PHPMailerAutoload.php';

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host = $host;
    $mail->SMTPAuth = true;
    $mail->Username = $user;
    $mail->Password = $pass;
    $mail->Port = $port;

    if ($secure === 'ssl') {
        $mail->SMTPSecure = 'ssl';
    } elseif ($secure === 'tls') {
        $mail->SMTPSecure = 'tls';
    }

    $mail->setFrom($fromEmail, $fromName);
    $mail->addAddress($para, $nombreDestino);
    $mail->isHTML(true);
    $mail->Subject = $asunto;
    $mail->Body = $html;
    $mail->AltBody = strip_tags($html);

    if (!$mail->send()) {
        return ['ok' => false, 'error' => $mail->ErrorInfo];
    }

    return ['ok' => true, 'error' => ''];
}
