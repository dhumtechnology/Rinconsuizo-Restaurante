<?php
require_once __DIR__ . '/web_session.php';
$session_id = web_session_id();

include "db/core/autoload.php";
include "db/core/app/model/CategoriasData.php";
include "db/core/app/model/ProductoData.php";
include "db/core/app/model/CarritoData.php";

header('Content-Type: application/json; charset=utf-8');

function carritoResumen($session_id)
{
    $tpms = CarritoData::getAllTemporal($session_id);
    $total = 0;
    $cantidad = 0;

    foreach ($tpms as $tpm) {
        $total += $tpm->cantidad * $tpm->precio;
        $cantidad += $tpm->cantidad;
    }

    return array(
        'ok' => true,
        'count' => count($tpms),
        'cantidad' => $cantidad,
        'total' => $total
    );
}

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$delta = isset($_POST['delta']) ? (int) $_POST['delta'] : 0;
$set = isset($_POST['cantidad']) ? (int) $_POST['cantidad'] : null;

if ($id <= 0) {
    echo json_encode(array('ok' => false, 'error' => 'id'));
    exit;
}

$item = CarritoData::getById($id);
if (!$item || (string) $item->sessionn_id !== (string) $session_id) {
    echo json_encode(array('ok' => false, 'error' => 'not_found'));
    exit;
}

if ($set !== null) {
    $nueva = $set;
} else {
    $nueva = (int) $item->cantidad + $delta;
}

if ($nueva < 1) {
    $item->del();
    $resumen = carritoResumen($session_id);
    $resumen['removed'] = true;
    echo json_encode($resumen);
    exit;
}

$item->cantidad = $nueva;
$item->updateCantidad();

$resumen = carritoResumen($session_id);
$resumen['item_cantidad'] = $nueva;
$resumen['item_id'] = $id;
echo json_encode($resumen);
