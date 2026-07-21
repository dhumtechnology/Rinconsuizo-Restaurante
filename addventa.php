<?php
require_once __DIR__ . '/web_session.php';
$session_id = web_session_id();

include "db/core/autoload.php";
include "db/core/app/model/CategoriasData.php";
include "db/core/app/model/ProductoData.php";
include "db/core/app/model/CarritoData.php";
include "db/core/app/model/ClientesData.php";
include "db/core/app/model/VentaData.php";
include "db/core/app/model/DetalleVentaData.php";
require_once __DIR__ . '/mail/enviar_correo.php';

if (empty($_SESSION['id_cliente'])) {
    echo "<script>alert('Debe iniciar sesión para confirmar el pedido.');window.location='micuenta.php';</script>";
    exit;
}

$cliente = ClientesData::getById($_SESSION['id_cliente']);
if (!$cliente || empty($cliente->codcliente)) {
    echo "<script>alert('No se encontró su cuenta. Inicie sesión nuevamente.');window.location='micuenta.php';</script>";
    exit;
}

$tmps = CarritoData::getAllTemporal($session_id);
if (!is_array($tmps) || count($tmps) === 0) {
    echo "<script>alert('Su carrito está vacío.');window.location='carrito.php';</script>";
    exit;
}

$id_cliente = $cliente->codcliente;
$fechaventa = isset($_POST['fechaventa']) ? $_POST['fechaventa'] : date('Y-m-d H:i:s');
$subtotal = isset($_POST['subtotalivanove']) ? $_POST['subtotalivanove'] : 0;

// Siguiente código de venta (numérico)
$base = new Database();
$con = $base->connect();
$rs = $con->query("SELECT COALESCE(MAX(CAST(codventa AS UNSIGNED)), 0) + 1 AS next_num FROM ventas");
$rowNext = $rs ? $rs->fetch_assoc() : null;
$nextNum = $rowNext ? (int) $rowNext['next_num'] : 1;
$codigo = str_pad((string) $nextNum, 7, '0', STR_PAD_LEFT);

// Correo con el carrito actual (antes de vaciarlo)
$para = $cliente->emailcliente;
$titulo = 'Comprobante de pedido - Rincon Suizo';
ob_start();
include "mail/comprobante.php";
$cuerpo = ob_get_clean();

$envio = enviar_correo_web($para, $titulo, $cuerpo, $cliente->nomcliente);
if (!$envio['ok']) {
    error_log('Pedido web: fallo envío correo a ' . $para . ' — ' . $envio['error']);
}

$venta = new VentaData();
$venta->codventa = $codigo;
$venta->codcaja = 0;
$venta->codcliente = $id_cliente;
$venta->codmesa = 0;
$venta->subtotalivasive = '0.00';
$venta->subtotalivanove = $subtotal;
$venta->ivave = '18';
$venta->totalivave = '0.00';
$venta->descuentove = '0';
$venta->totaldescuentove = '0.00';
$venta->totalpago = $subtotal;
$venta->totalpago2 = $subtotal;
$venta->tipopagove = 'CONTADO';
$venta->formapagove = '1';
$venta->montopagado = '0.00';
$venta->montodevuelto = '0.00';
$venta->fechavencecredito = '0000-00-00';
// PENDIENTE: aparece en cocina y delivery del POS hasta que caja lo cierre
$venta->statusventa = 'PENDIENTE';
$venta->statuspago = '0';
$venta->fechaventa = $fechaventa;
$venta->codigo = '0';
$venta->cocinero = '1';
$venta->delivery = '1';
$venta->repartidor = '0';
$venta->entregado = '1';
$venta->observaciones = 'PEDIDO WEB';
$venta->codarqueocaja = '0';
$venta->comprobante = '1';
$venta->serie_doc = '001';
$venta->aceptado = 'no';
$venta->enviado = '1';
$venta->add();

foreach ($tmps as $p) {
    $prod = $p->getProducto();
    if (!$prod) {
        continue;
    }
    $procesoventa = new DetalleVentaData();
    $procesoventa->codventa = $codigo;
    $procesoventa->codcliente = $id_cliente;
    $procesoventa->codproducto = $p->id_producto;
    $procesoventa->producto = $prod->producto;
    $procesoventa->codcategoria = $prod->codcategoria;
    $procesoventa->cantventa = $p->cantidad;
    $procesoventa->preciocompra = $prod->preciocompra;
    $procesoventa->precioventa = $prod->precioventa;
    $procesoventa->ivaproducto = 'NO';
    $procesoventa->importe = $prod->precioventa * $p->cantidad;
    $procesoventa->importe2 = $prod->preciocompra * $p->cantidad;
    $procesoventa->fechadetalleventa = $fechaventa;
    $procesoventa->statusdetalle = '1';
    $procesoventa->codigo = '0';
    $procesoventa->comanda = '1';
    $procesoventa->add();
}

foreach (CarritoData::getAllTemporal($session_id) as $del) {
    $eliminar = CarritoData::getById($del->id);
    if ($eliminar) {
        $eliminar->del();
    }
}

header('Location: gracias.php?tipo=pedido');
exit;
