<?php
//CARRITO DE ENTRADAS DE PRODUCTOS
session_start();
$ObjetoCarrito   = json_decode($_POST['MiCarrito']);
if ($ObjetoCarrito->Codigo=="vaciar") {
    unset($_SESSION["CarritoC"]);
} else {
    if (isset($_SESSION['CarritoC'])) {
        $carrito_compra=$_SESSION['CarritoC'];
        if (isset($ObjetoCarrito->Codigo)) {
            $txtCodigo = $ObjetoCarrito->Codigo;
            $producto= $ObjetoCarrito->Producto;
            $presentacion = $ObjetoCarrito->Presentacion;
            $precio = $ObjetoCarrito->Precio;
            $precio2 = $ObjetoCarrito->Precio2;
            $tipoentrada = $ObjetoCarrito->Tipoentrada;
            $ivaproducto = $ObjetoCarrito->Ivaproducto;
            $precioconiva = $ObjetoCarrito->Precioconiva;
            $cantidad = $ObjetoCarrito->Cantidad;
            $opCantidad = $ObjetoCarrito->opCantidad;

            //array_search("whatisearchfor2", array_column(array_column($response, "types"), 0));

            $donde  = array_search($txtCodigo, array_column($carrito_compra, 'txtCodigo'));

            if ($donde !== FALSE) {
                if ($opCantidad === '=') {
                    $cuanto = $cantidad;
                } else {
                    $cuanto = $carrito_compra[$donde]['cantidad'] + $cantidad;
                }
                $carrito_compra[$donde] = array(
                    "txtCodigo"=>$txtCodigo,
                    "producto"=>$producto,
                    "presentacion"=>$presentacion,
                    "precio"=>$precio,
                    "precio2"=>$precio2,
                    "tipoentrada"=>$tipoentrada,
                    "ivaproducto"=>$ivaproducto,
                    "precioconiva"=>$precioconiva,
                    "cantidad"=>$cuanto
                );
            } else {
                $carrito_compra[]=array(
                    "txtCodigo"=>$txtCodigo,
                    "producto"=>$producto,
                    "presentacion"=>$presentacion,
                    "precio"=>$precio,
                    "precio2"=>$precio2,
                    "tipoentrada"=>$tipoentrada,
                    "ivaproducto"=>$ivaproducto,
                    "precioconiva"=>$precioconiva,
                    "cantidad"=>$cantidad
                );
            }
        }
    } else {
        $txtCodigo = $ObjetoCarrito->Codigo;
        $producto = $ObjetoCarrito->Producto;
        $presentacion = $ObjetoCarrito->Presentacion;
        $precio = $ObjetoCarrito->Precio;
        $precio2 = $ObjetoCarrito->Precio2;
        $tipoentrada = $ObjetoCarrito->Tipoentrada;
        $ivaproducto = $ObjetoCarrito->Ivaproducto;
        $precioconiva = $ObjetoCarrito->Precioconiva;
        $cantidad = $ObjetoCarrito->Cantidad;
        $carrito_compra[] = array(
            "txtCodigo"=>$txtCodigo,
            "producto"=>$producto,
            "presentacion"=>$presentacion,
            "precio"=>$precio,
            "precio2"=>$precio2,
            "tipoentrada"=>$tipoentrada,
            "ivaproducto"=>$ivaproducto,
            "precioconiva"=>$precioconiva,
            "cantidad"=>$cantidad
        );
    }
    $carrito_compra = array_values(
        array_filter($carrito_compra, function($v) {
            return $v['cantidad'] > 0;
        })
    );
    $_SESSION['CarritoC'] = $carrito_compra;
    echo json_encode($_SESSION['CarritoC']);
}
