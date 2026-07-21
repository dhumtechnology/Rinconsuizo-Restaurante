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
    echo "<script>alert('Debe iniciar sesión para reservar.');window.location='micuenta.php';</script>";
    exit;
}

$cliente = ClientesData::getById($_SESSION['id_cliente']);
if (!$cliente || empty($cliente->codcliente)) {
    echo "<script>alert('No se encontró su cuenta. Inicie sesión nuevamente.');window.location='micuenta.php';</script>";
    exit;
}

$id_cliente = $cliente->codcliente;
$cantidad = isset($_POST['cantidad']) ? (int) $_POST['cantidad'] : 0;
$fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
$hora = isset($_POST['hora']) ? trim($_POST['hora']) : '';
$mensajeTxt = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';

if ($cantidad < 1 || $fecha === '' || $hora === '') {
    echo "<script>alert('Complete cantidad, fecha y hora de la reserva.');window.location='reserva.php';</script>";
    exit;
}

$reserva = new ReservaData();
$reserva->id_cliente = $id_cliente;
$reserva->cantidad = $cantidad;
$reserva->fecha = $fecha . ' ' . $hora;
$reserva->mensaje = $mensajeTxt;
$reserva->add();

$para = $cliente->emailcliente;
$titulo = 'Confirmación de reserva - Rincon Suizo';
ob_start();
include "mail/reservamesa.php";
$cuerpo = ob_get_clean();

$envio = enviar_correo_web($para, $titulo, $cuerpo, $cliente->nomcliente);
if (!$envio['ok']) {
    error_log('Reserva web: fallo envío correo a ' . $para . ' — ' . $envio['error']);
}

header('Location: gracias.php?tipo=reserva');
exit;
