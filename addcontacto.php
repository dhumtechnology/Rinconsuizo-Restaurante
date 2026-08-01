<?php
require_once __DIR__ . '/web_session.php';
require_once __DIR__ . '/mail/enviar_correo.php';

$info = web_mail_restaurante_info();
$restaurante_nombre = $info['nombre'];

$para = '';
if (!empty($info['email']) && filter_var($info['email'], FILTER_VALIDATE_EMAIL)) {
    $para = $info['email'];
}
if ($para === '') {
    $para = getenv('SMTP_FROM_EMAIL') ?: (getenv('SMTP_USER') ?: '');
}

$nombreForm = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$titulo = 'Mensaje de contacto - ' . $restaurante_nombre;
if ($nombreForm !== '') {
    $titulo .= ' · ' . $nombreForm;
}

ob_start();
include __DIR__ . '/mail/contacto.php';
$mensaje = ob_get_clean();

if ($para !== '' && filter_var($para, FILTER_VALIDATE_EMAIL)) {
    $envio = enviar_correo_web($para, $titulo, $mensaje, $restaurante_nombre);
    if (!$envio['ok']) {
        error_log('Contacto web: fallo envío correo a ' . $para . ' — ' . $envio['error']);
    }
} else {
    error_log('Contacto web: restaurante sin email válido configurado');
}

print "<script>window.location='contacto.php';</script>";
?>
