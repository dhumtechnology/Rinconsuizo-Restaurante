<?php
require_once 'class/class.php';
require_once 'class/impresoras_red.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if (!isset($_SESSION['acceso']) || !in_array($_SESSION['acceso'], array('administrador', 'cajero', 'mesero', 'cocinero', 'repartidor'), true)) {
    http_response_code(401);
    echo json_encode(array('ok' => false, 'error' => 'Sesión requerida.'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(array(
        'ok' => true,
        'printers' => array_values(listarImpresorasRed()),
    ));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(array('ok' => false, 'error' => 'Método no permitido.'));
    exit;
}

$printerId = isset($_POST['printer_id']) ? trim((string) $_POST['printer_id']) : '';
$paper = isset($_POST['paper']) ? trim((string) $_POST['paper']) : '80';
if (!in_array($paper, array('58', '80', 'a4'), true)) {
    $paper = '80';
}

if ($printerId === '' || $printerId === 'browser') {
    echo json_encode(array('ok' => false, 'error' => 'Selecciona una impresora de red.'));
    exit;
}

if (!isset($_FILES['image']) || !is_array($_FILES['image'])) {
    echo json_encode(array('ok' => false, 'error' => 'Falta la imagen del ticket. Espera a que cargue la vista previa.'));
    exit;
}

$err = isset($_FILES['image']['error']) ? (int) $_FILES['image']['error'] : UPLOAD_ERR_NO_FILE;
if ($err !== UPLOAD_ERR_OK) {
    echo json_encode(array('ok' => false, 'error' => 'No se pudo subir la imagen del ticket.'));
    exit;
}

$tmp = isset($_FILES['image']['tmp_name']) ? (string) $_FILES['image']['tmp_name'] : '';
if ($tmp === '' || !is_uploaded_file($tmp)) {
    echo json_encode(array('ok' => false, 'error' => 'Archivo de impresión inválido.'));
    exit;
}

$dest = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'rs-print-' . uniqid('', true) . '.png';
if (!@move_uploaded_file($tmp, $dest)) {
    echo json_encode(array('ok' => false, 'error' => 'No se pudo preparar el ticket para imprimir.'));
    exit;
}

try {
    $impresora = imprimirImagenEnImpresoraRed($printerId, $dest, $paper);
    echo json_encode(array(
        'ok' => true,
        'message' => 'Enviado a ' . $impresora['name'] . ' (' . $impresora['ip'] . ').',
        'printer' => $impresora,
    ));
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array('ok' => false, 'error' => $e->getMessage()));
} finally {
    if (is_file($dest)) {
        @unlink($dest);
    }
}
