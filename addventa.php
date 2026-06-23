<?php
include "db/core/autoload.php";
include "db/core/app/model/CategoriasData.php";
include "db/core/app/model/ProductoData.php";
include "db/core/app/model/CarritoData.php";

include "db/core/app/model/ClientesData.php";
include "db/core/app/model/VentaData.php";
include "db/core/app/model/DetalleVentaData.php";


session_start(); 
$session_id= session_id();

$cliente = ClientesData::getById($_SESSION["id_cliente"]);

$id_cliente= $cliente->codcliente;

$procesocod = VentaData::getUltimoProcess();
  $codigo=0;
  if(count($procesocod)>0){
    if(count($procesocod)<10){
      $codigo='000000'.(count($procesocod)+1);
    }else if($procesocod->id<100){
      $codigo='00000'.(count($procesocod)+1);
    }else if($procesocod->id<1000){
      $codigo='0000'.(count($procesocod)+1);
    }else if($procesocod->id<10000){
      $codigo='000'.(count($procesocod)+1);
    }else if($procesocod->id<100000){
      $codigo='00'.(count($procesocod)+1);
    }else if($procesocod->id<1000000){
      $codigo='0'.(count($procesocod)+1);
    }else if($procesocod->id<10000000){
      $codigo=''.(count($procesocod)+1);
    }else{
      $codigo=''.(count($procesocod)+1);
    }

  }else{$codigo='0000001';}


$para  = $cliente->emailcliente;
$titulo = 'COMPROBANTE PEDIDO';
ob_start();
include "mail/comprobante.php";
$mensaje = ob_get_contents();
ob_end_clean();
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";   
$cabeceras .= 'From: COMPROBANTE PEDIDO <rinconsuizo0744@gmail.com>' . "\r\n";    
mail($para, $titulo, $mensaje, $cabeceras);


$venta = new VentaData();
$venta->codventa = $codigo;
$venta->codcaja = 0;
$venta->codcliente = $id_cliente;

$venta->codmesa = 0;
$venta->subtotalivasive = "0.00";
$venta->subtotalivanove = $_POST["subtotalivanove"];
$venta->ivave = "18";
$venta->totalivave = "0.00";
$venta->descuentove = "0";
$venta->totaldescuentove = "0.00";
$venta->totalpago = $_POST["subtotalivanove"];
$venta->totalpago2 = $_POST["subtotalivanove"];
$venta->tipopagove = "CONTADO";
$venta->formapagove = "1";
$venta->montopagado = $_POST["subtotalivanove"];
$venta->montodevuelto = "0.00";
$venta->fechavencecredito = "0000-00-00";
$venta->statusventa = "PAGADA";
$venta->statuspago = "0";
$venta->fechaventa = $_POST["fechaventa"];
$venta->codigo = "1";
$venta->cocinero = "1";
$venta->delivery = "1";
$venta->repartidor = "6";
$venta->entregado = "1";
$venta->observaciones = "No";
$venta->codarqueocaja = "4";
$venta->comprobante = "1";
$venta->serie_doc = "001";
$venta->aceptado = "no";
$venta->enviado = "1";
$v=$venta->add();
 

$tmps = CarritoData::getAllTemporal($session_id);
	foreach($tmps as $p): 
		 
		$procesoventa = new DetalleVentaData();
		$procesoventa->codventa=$codigo;
		$procesoventa->codcliente=$id_cliente;
		$procesoventa->codproducto=$p->id_producto;

		$procesoventa->producto=$p->getProducto()->producto;
		$procesoventa->codcategoria=$p->getProducto()->codcategoria;

		$procesoventa->cantventa=$p->cantidad;
		$procesoventa->preciocompra=$p->getProducto()->preciocompra;
		$procesoventa->precioventa=$p->getProducto()->precioventa;
		$procesoventa->ivaproducto="NO";
		$procesoventa->importe=$p->getProducto()->precioventa;
		$procesoventa->importe2=$p->getProducto()->precioventa;
		$procesoventa->fechadetalleventa=$_POST["fechaventa"];
		$procesoventa->statusdetalle="0";
		$procesoventa->codigo="1";
		$procesoventa->comanda="1";
		$procesoventa->add();
	endforeach;


$dels = CarritoData::getAllTemporal($session_id);
	foreach($dels as $del):
		$eliminar = CarritoData::getById($del->id);
		$eliminar->del();
	endforeach;


print "<script>window.location='gracias.php';</script>";

?>