<?php
session_start();
$session_id = session_id();

include "db/core/autoload.php";
include "db/core/app/model/CategoriasData.php";
include "db/core/app/model/ProductoData.php";
include "db/core/app/model/CarritoData.php";

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

if (isset($_GET['id'])) {
    $del = CarritoData::getById($_GET['id']);
    if ($del) {
        $del->del();
    }
}

if (isset($_POST['cantidad']) && isset($_POST['precio_venta']) && isset($_POST['id'])) {
    $producto = CarritoData::getByIdProductoSession($_POST['id'], $session_id);

    if ($producto) {
        $temporal = CarritoData::getById($producto->id);
        $temporal->cantidad = $producto->cantidad + $_POST['cantidad'];
        $temporal->updateCantidad();
    } else {
        $temporal = new CarritoData();
        $temporal->id_producto = $_POST['id'];
        $temporal->cantidad = $_POST['cantidad'];
        $temporal->precio = $_POST['precio_venta'];
        $temporal->sessionn_id = $session_id;
        $temporal->addTmp();
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(carritoResumen($session_id));
    exit;
}
