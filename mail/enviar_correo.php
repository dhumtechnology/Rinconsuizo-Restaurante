<?php
/**
 * Envío de correo vía SMTP (PHPMailer).
 * Requiere variables SMTP_* en .env / entorno del contenedor.
 *
 * @return array{ok: bool, error: string}
 */
function enviar_correo_web($para, $asunto, $html, $nombreDestino = '')
{
    $host = getenv('SMTP_HOST') ?: '';
    $user = getenv('SMTP_USER') ?: '';
    $pass = getenv('SMTP_PASS') ?: '';
    $port = (int) (getenv('SMTP_PORT') ?: 587);
    $fromEmail = getenv('SMTP_FROM_EMAIL') ?: $user;
    $fromName = getenv('SMTP_FROM_NAME') ?: 'Rincon Suizo';
    $secure = strtolower(getenv('SMTP_SECURE') ?: 'tls');

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
