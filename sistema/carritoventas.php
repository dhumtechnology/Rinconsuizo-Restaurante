<?php
//CARRITO DE ENTRADAS DE PRODUCTOS
session_start();
$ObjetoCarritoV   = json_decode($_POST['MiCarritoV']);
if ($ObjetoCarritoV->Codigo=="vaciar") {
    unset($_SESSION["CarritoVentas"]);
} else {
    if (isset($_SESSION['CarritoVentas'])) {
        $carrito_venta=$_SESSION['CarritoVentas'];
        if (isset($ObjetoCarritoV->Codigo)) {
            $txtCodigo = $ObjetoCarritoV->Codigo;
            $ivaproducto= $ObjetoCarritoV->Ivaproducto;
            $precioconiva= $ObjetoCarritoV->Precioconiva;
            $precio = $ObjetoCarritoV->Precio;
            $precio2 = $ObjetoCarritoV->Precio2;
            $existencia = $ObjetoCarritoV->Existencia;
            $tipo = $ObjetoCarritoV->Tipo;
            $cantidad = $ObjetoCarritoV->Cantidad;
            $descripcio= $ObjetoCarritoV->Descripcion;
            $opCantidad = $ObjetoCarritoV->opCantidad;
            $donde  = array_search($txtCodigo, array_column($carrito_venta, 'txtCodigo'));
            if ($donde !== FALSE) {
                if ($opCantidad === '=') {
                    $cuanto = $cantidad;
                } else {
                    $cuanto = $carrito_venta[$donde]['cantidad'] + $cantidad;
                }
                $carrito_venta[$donde] = array(
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
                $carrito_venta[]=array(
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
        $txtCodigo = $ObjetoCarritoV->Codigo;
        $ivaproducto = $ObjetoCarritoV->Ivaproducto;
        $precioconiva = $ObjetoCarritoV->Precioconiva;
        $precio = $ObjetoCarritoV->Precio;
        $precio2 = $ObjetoCarritoV->Precio2;
        $existencia = $ObjetoCarritoV->Existencia;
        $tipo = $ObjetoCarritoV->Tipo;
        $cantidad = $ObjetoCarritoV->Cantidad;
        $descripcio = $ObjetoCarritoV->Descripcion;
        $carrito_venta[] = array(
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
    $carrito_venta = array_values(
        array_filter($carrito_venta, function($v) {
            return $v['cantidad'] > 0;
        })
    );
    $_SESSION['CarritoVentas'] = $carrito_venta;
    echo json_encode($_SESSION['CarritoVentas']);
}
