<?php
require_once __DIR__ . '/web_session.php';
$session_id = web_session_id();

include "db/core/autoload.php";
include "db/core/app/model/CategoriasData.php";
include "db/core/app/model/ProductoData.php";
include "db/core/app/model/CarritoData.php";
include "db/core/app/model/ReservaData.php";
include "db/core/app/model/ClientesData.php";
require_once __DIR__ . '/mail/enviar_correo.php';

if (empty($_SESSION['id_cliente'])) {
    rs_alert_go('Debe iniciar sesión para reservar.', 'micuenta.php');
}

$cliente = ClientesData::getById($_SESSION['id_cliente']);
if (!$cliente || empty($cliente->codcliente)) {
    rs_alert_go('No se encontró su cuenta. Inicie sesión nuevamente.', 'micuenta.php');
}

$id_cliente = $cliente->codcliente;
$cantidad = isset($_POST['cantidad']) ? (int) $_POST['cantidad'] : 0;
$fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
$hora = isset($_POST['hora']) ? trim($_POST['hora']) : '';
$mensajeTxt = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$telefono = preg_replace('/[^\d\+\-\s\(\)]/', '', $telefono);
$emailForm = isset($_POST['email']) ? trim($_POST['email']) : '';
$nombreForm = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

// Teléfono: formulario o el guardado en la cuenta
if ($telefono === '' && !empty($cliente->tlfcliente)) {
    $telefono = trim((string) $cliente->tlfcliente);
}

if ($cantidad < 1 || $fecha === '' || $hora === '') {
    rs_alert_go('Complete cantidad, fecha y hora de la reserva.', 'reserva.php');
}

if ($telefono === '') {
    rs_alert_go('Ingrese un teléfono de contacto para la reserva.', 'reserva.php');
}

// Normalizar fecha/hora a datetime MySQL
$horaNorm = strlen($hora) === 5 ? ($hora . ':00') : $hora;
$fechaHora = $fecha . ' ' . $horaNorm;
$ts = strtotime($fechaHora);
if ($ts === false) {
    rs_alert_go('Fecha u hora inválida. Verifique e intente de nuevo.', 'reserva.php');
}
$fechaHora = date('Y-m-d H:i:s', $ts);

$reserva = new ReservaData();
$reserva->id_cliente = $id_cliente;
$reserva->cantidad = $cantidad;
$reserva->fecha = $fechaHora;
$reserva->mensaje = $mensajeTxt;
$reserva->telefono = $telefono;
$okAdd = $reserva->add();

if (!$okAdd) {
    rs_alert_go('No se pudo registrar la reserva. Intente de nuevo o contacte al restaurante.', 'reserva.php');
}

// Actualizar datos del cliente si cambiaron
if ($telefono !== '' && (string) $cliente->tlfcliente !== (string) $telefono) {
    $cliente->tlfcliente = $telefono;
    $cliente->updateTelefono();
}

$para = '';
if ($emailForm !== '' && filter_var($emailForm, FILTER_VALIDATE_EMAIL)) {
    $para = $emailForm;
} elseif (!empty($cliente->emailcliente) && filter_var($cliente->emailcliente, FILTER_VALIDATE_EMAIL)) {
    $para = $cliente->emailcliente;
}

if ($para !== '' && (string) $cliente->emailcliente !== (string) $para) {
    $cliente->emailcliente = $para;
    $cliente->updateEmail();
}

$nombreDestino = $nombreForm !== '' ? $nombreForm : $cliente->nomcliente;

// Enviar correo solo si hay destino válido (la reserva ya está guardada)
if ($para !== '') {
    $restaurante_nombre = web_mail_restaurante_info()['nombre'];
    $titulo = 'Confirmación de reserva - ' . $restaurante_nombre;
    $reserva_email = array(
        'nombre' => $nombreDestino,
        'email' => $para,
        'telefono' => $telefono,
        'cantidad' => $cantidad,
        'fecha' => $fecha,
        'hora' => $hora,
        'mensaje' => $mensajeTxt,
    );

    ob_start();
    include "mail/reservamesa.php";
    $cuerpo = ob_get_clean();

    $envio = enviar_correo_web($para, $titulo, $cuerpo, $nombreDestino);
    if (!$envio['ok']) {
        error_log('Reserva web: fallo envío correo a ' . $para . ' — ' . $envio['error']);
        $msg = 'Su reserva fue registrada correctamente, pero no se pudo enviar el correo de confirmación. Revise spam o contacte al restaurante.';
        rs_alert_go($msg, 'gracias.php?tipo=reserva');
    }
} else {
    $msg = 'Su reserva fue registrada. No se envió correo porque no hay un email válido en su cuenta.';
    rs_alert_go($msg, 'gracias.php?tipo=reserva');
}

header('Location: gracias.php?tipo=reserva');
exit;
