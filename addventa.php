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
$id_restaurante = function_exists('web_tenant_id') ? (int) web_tenant_id() : 0;
if ($id_restaurante <= 0) {
    echo "<script>alert('No se pudo identificar el restaurante. Recargue la página e intente de nuevo.');window.location='carrito.php';</script>";
    exit;
}

// Siguiente código de venta (numérico) = código de confirmación del pedido
$base = new Database();
$con = $base->connect();
$rs = $con->query("SELECT COALESCE(MAX(CAST(codventa AS UNSIGNED)), 0) + 1 AS next_num FROM ventas");
$rowNext = $rs ? $rs->fetch_assoc() : null;
$nextNum = $rowNext ? (int) $rowNext['next_num'] : 1;
$codigo = str_pad((string) $nextNum, 7, '0', STR_PAD_LEFT);

$venta = new VentaData();
$venta->codventa = $codigo;

// Asociar al arqueo abierto del local (si existe) para que sume en caja
$codcajaWeb = 0;
$codarqueoWeb = 0;
$stmtArq = $con->prepare("SELECT codarqueo, codcaja FROM arqueocaja WHERE statusarqueo = '1' AND id_restaurante = ? ORDER BY codarqueo DESC LIMIT 1");
if ($stmtArq) {
    $stmtArq->bind_param('i', $id_restaurante);
    $stmtArq->execute();
    $resArq = $stmtArq->get_result();
    if ($resArq && ($rowArq = $resArq->fetch_assoc())) {
        $codcajaWeb = (int) $rowArq['codcaja'];
        $codarqueoWeb = (int) $rowArq['codarqueo'];
    }
    $stmtArq->close();
}

$venta->codcaja = $codcajaWeb;
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
$venta->codarqueocaja = $codarqueoWeb;
$venta->comprobante = '1';
$venta->serie_doc = '001';
$venta->aceptado = 'no';
$venta->enviado = '1';
$venta->id_restaurante = $id_restaurante;
$venta->add();

// Sumar el pedido web a los ingresos del arqueo abierto
if ($codarqueoWeb > 0) {
    $montoWeb = (float) str_replace(',', '', (string) $subtotal);
    if ($montoWeb > 0) {
        $stmtIng = $con->prepare('UPDATE arqueocaja SET ingresos = ingresos + ? WHERE codarqueo = ? AND statusarqueo = \'1\' AND id_restaurante = ?');
        if ($stmtIng) {
            $stmtIng->bind_param('dii', $montoWeb, $codarqueoWeb, $id_restaurante);
            $stmtIng->execute();
            $stmtIng->close();
        }
    }
}

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

// Correo con código de confirmación + detalle (antes de vaciar el carrito en sesión DB)
$para = trim((string) $cliente->emailcliente);
$restaurante_nombre = web_mail_restaurante_info()['nombre'];
$titulo = 'Código de confirmación de pedido - ' . $restaurante_nombre;
ob_start();
include "mail/comprobante.php";
$cuerpo = ob_get_clean();

$envio = enviar_correo_web($para, $titulo, $cuerpo, $cliente->nomcliente);
$mailOk = !empty($envio['ok']);
if (!$mailOk) {
    error_log('Pedido web: fallo envío correo a ' . $para . ' — ' . (isset($envio['error']) ? $envio['error'] : 'desconocido'));
}

foreach (CarritoData::getAllTemporal($session_id) as $del) {
    $eliminar = CarritoData::getById($del->id);
    if ($eliminar) {
        $eliminar->del();
    }
}

$qs = 'tipo=pedido&cod=' . rawurlencode($codigo);
if (!$mailOk) {
    $qs .= '&mail=0';
}
if (!$mailOk) {
    $msg = 'Su pedido fue registrado con código ' . $codigo . ', pero no se pudo enviar el correo de confirmación. Revise spam o verifique su email en la cuenta.';
    echo "<script>alert(" . json_encode($msg, JSON_UNESCAPED_UNICODE) . ");window.location='gracias.php?" . $qs . "';</script>";
    exit;
}

header('Location: gracias.php?' . $qs);
exit;
