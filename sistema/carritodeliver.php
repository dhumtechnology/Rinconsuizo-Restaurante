<?php
//CARRITO DE ENTRADAS DE PRODUCTOS
session_start();
$ObjetoCarrito   = json_decode($_POST['MiCarritoD']);
if ($ObjetoCarrito->Codigo=="vaciar") {
    unset($_SESSION["CarritoDelivery"]);
} else {
    if (isset($_SESSION['CarritoDelivery'])) {
        $carrito_delivery=$_SESSION['CarritoDelivery'];
        if (isset($ObjetoCarrito->Codigo)) {
            $txtCodigo = $ObjetoCarrito->Codigo;
            $ivaproducto= $ObjetoCarrito->Ivaproducto;
            $precioconiva= $ObjetoCarrito->Precioconiva;
            $precio = $ObjetoCarrito->Precio;
            $precio2 = $ObjetoCarrito->Precio2;
            $existencia = $ObjetoCarrito->Existencia;
            $tipo = $ObjetoCarrito->Tipo;
            $cantidad = $ObjetoCarrito->Cantidad;
            $descripcio= $ObjetoCarrito->Descripcion;
            $opCantidad = $ObjetoCarrito->opCantidad;
            $donde  = array_search($txtCodigo, array_column($carrito_delivery, 'txtCodigo'));
            if ($donde !== FALSE) {
                if ($opCantidad === '=') {
                    $cuanto = $cantidad;
                } else {
                    $cuanto = $carrito_delivery[$donde]['cantidad'] + $cantidad;
                }
                $carrito_delivery[$donde] = array(
                    "txtCodigo"=>$txtCodigo,
                    "ivaproducto"=>$ivaproducto,
                    "precioconiva"=>$precioconiva,
                    "precio"=>$precio,
                    "precio2"=>$precio2,
                    "existencia"=>$existencia,
                    "tipo"=>$tipo,
                    "cantidad"=>$cuanto,
                    "descripcion"=>$descripcio
                );
            } else {
                $carrito_delivery[]=array(
                    "txtCodigo"=>$txtCodigo,
                    "ivaproducto"=>$ivaproducto,
                    "precioconiva"=>$precioconiva,
                    "precio"=>$precio,
                    "precio2"=>$precio2,
                    "existencia"=>$existencia,
                    "tipo"=>$tipo,
                    "cantidad"=>$cantidad,
                    "descripcion"=>$descripcio);
            }
        }
    } else {
        $txtCodigo = $ObjetoCarrito->Codigo;
        $ivaproducto = $ObjetoCarrito->Ivaproducto;
        $precioconiva = $ObjetoCarrito->Precioconiva;
        $precio = $ObjetoCarrito->Precio;
        $precio2 = $ObjetoCarrito->Precio2;
        $existencia = $ObjetoCarrito->Existencia;
        $tipo = $ObjetoCarrito->Tipo;
        $cantidad = $ObjetoCarrito->Cantidad;
        $descripcio = $ObjetoCarrito->Descripcion;
        $carrito_delivery[] = array(
            "txtCodigo"=>$txtCodigo,
            "ivaproducto"=>$ivaproducto,
            "precioconiva"=>$precioconiva,
            "precio"=>$precio,
            "precio2"=>$precio2,
            "existencia"=>$existencia,
            "tipo"=>$tipo,
            "cantidad"=>$cantidad,
            "descripcion"=>$descripcio
        );
    }
    $carrito_delivery = array_values(
        array_filter($carrito_delivery, function($v) {
            return $v['cantidad'] > 0;
        })
    );
    $_SESSION['CarritoDelivery'] = $carrito_delivery;
    echo json_encode($_SESSION['CarritoDelivery']);
}
