<?php
/**
 * Envío de correo vía SMTP (PHPMailer).
 * Requiere variables SMTP_* en .env / entorno del contenedor.
 *
 * @return array{ok: bool, error: string}
 */

function cargar_env_smtp_si_falta()
{
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

/**
 * Nombre y email del restaurante actual (tienda web / tenant).
 * @return array{nombre: string, email: string}
 */
function web_mail_restaurante_info()
{
    $nombre = '';
    $email = '';

    if (function_exists('web_tenant_row')) {
        $row = web_tenant_row();
        if (is_array($row)) {
            if (!empty($row['nombre'])) {
                $nombre = trim((string) $row['nombre']);
            }
            if (!empty($row['email'])) {
                $email = trim((string) $row['email']);
            }
        }
    }

    if ($nombre === '' && !empty($_SESSION['restaurante_nombre'])) {
        $nombre = trim((string) $_SESSION['restaurante_nombre']);
    }

    if ($nombre === '') {
        $nombre = trim((string) (getenv('SMTP_FROM_NAME') ?: ''));
    }
    if ($nombre === '') {
        $nombre = 'Restaurante';
    }

    return array('nombre' => $nombre, 'email' => $email);
}

/**
 * @param string $para
 * @param string $asunto
 * @param string $html
 * @param string $nombreDestino
 * @param string|null $fromNameOverride Nombre visible del remitente (por defecto: restaurante del tenant)
 * @return array{ok: bool, error: string}
 */
function enviar_correo_web($para, $asunto, $html, $nombreDestino = '', $fromNameOverride = null)
{
    cargar_env_smtp_si_falta();

    $host = getenv('SMTP_HOST') ?: '';
    $user = getenv('SMTP_USER') ?: '';
    $pass = getenv('SMTP_PASS') ?: '';
    // Gmail app password: espacios son solo visuales
    $pass = str_replace(' ', '', $pass);
    $port = (int) (getenv('SMTP_PORT') ?: 587);
    $fromEmail = getenv('SMTP_FROM_EMAIL') ?: $user;
    $secure = strtolower(getenv('SMTP_SECURE') ?: 'tls');

    $info = web_mail_restaurante_info();
    $fromName = ($fromNameOverride !== null && trim((string) $fromNameOverride) !== '')
        ? trim((string) $fromNameOverride)
        : $info['nombre'];

    $para = trim((string) $para);
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
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ),
    );

    if ($secure === 'ssl') {
        $mail->SMTPSecure = 'ssl';
    } elseif ($secure === 'tls') {
        $mail->SMTPSecure = 'tls';
    }

    $mail->setFrom($fromEmail, $fromName);
    $mail->addAddress($para, $nombreDestino);

    $replyEmail = $fromEmail;
    if (!empty($info['email']) && filter_var($info['email'], FILTER_VALIDATE_EMAIL)) {
        $replyEmail = $info['email'];
    }
    $mail->addReplyTo($replyEmail, $fromName);

    $mail->isHTML(true);
    $mail->Subject = $asunto;
    $mail->Body = $html;
    $mail->AltBody = strip_tags($html);

    if (!$mail->send()) {
        return ['ok' => false, 'error' => $mail->ErrorInfo];
    }

    return ['ok' => true, 'error' => ''];
}
