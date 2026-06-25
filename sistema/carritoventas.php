<?php
require_once('class/class.php');

header('Content-Type: application/json; charset=UTF-8');

if (isset($_POST['cambiarMesa'])) {
    activarCarritoMesa($_POST['cambiarMesa']);
    echo json_encode(getCarritoVentas());
    exit;
}

if (!isset($_POST['MiCarritoV'])) {
    echo json_encode(array());
    exit;
}

$codmesaRef = isset($_POST['codmesa']) ? $_POST['codmesa'] : '';
if ($codmesaRef !== '') {
    activarCarritoMesa($codmesaRef);
}

$ObjetoCarritoV = json_decode($_POST['MiCarritoV']);

if ($ObjetoCarritoV->Codigo == 'vaciar') {
    unsetCarritoVentas($codmesaRef);
    echo json_encode(array());
    exit;
}

$carrito_venta = getCarritoVentas($codmesaRef);

if (isset($ObjetoCarritoV->Codigo)) {
    $txtCodigo = (string) $ObjetoCarritoV->Codigo;
    $ivaproducto = $ObjetoCarritoV->Ivaproducto;
    $precioconiva = $ObjetoCarritoV->Precioconiva;
    $precio = $ObjetoCarritoV->Precio;
    $precio2 = $ObjetoCarritoV->Precio2;
    $existencia = $ObjetoCarritoV->Existencia;
    $tipo = $ObjetoCarritoV->Tipo;
    $cantidad = $ObjetoCarritoV->Cantidad;
    $descripcio = $ObjetoCarritoV->Descripcion;
    $opCantidad = $ObjetoCarritoV->opCantidad;
    $donde = false;
    foreach ($carrito_venta as $idx => $itemCarrito) {
        if ((string) $itemCarrito['txtCodigo'] === $txtCodigo) {
            $donde = $idx;
            break;
        }
    }
    if ($donde !== false) {
        if ($opCantidad === '=') {
            $cuanto = (float) $cantidad;
        } else {
            $cuanto = (float) $carrito_venta[$donde]['cantidad'] + (float) $cantidad;
        }
        $carrito_venta[$donde] = array(
            'txtCodigo' => $txtCodigo,
            'ivaproducto' => $ivaproducto,
            'precioconiva' => $precioconiva,
            'precio' => $precio,
            'precio2' => $precio2,
            'existencia' => $existencia,
            'tipo' => $tipo,
            'cantidad' => $cuanto,
            'descripcion' => $descripcio
        );
    } else {
        $carrito_venta[] = array(
            'txtCodigo' => $txtCodigo,
            'ivaproducto' => $ivaproducto,
            'precioconiva' => $precioconiva,
            'precio' => $precio,
            'precio2' => $precio2,
            'existencia' => $existencia,
            'tipo' => $tipo,
            'cantidad' => (float) $cantidad,
            'descripcion' => $descripcio
        );
    }
}

$carrito_venta = array_values(array_filter($carrito_venta, function ($v) {
    return $v['cantidad'] > 0;
}));

setCarritoVentas($carrito_venta, $codmesaRef);
echo json_encode(getCarritoVentas($codmesaRef));
