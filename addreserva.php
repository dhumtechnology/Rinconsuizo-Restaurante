<?php
session_start(); 
$session_id= session_id(); 

include "db/core/autoload.php";
include "db/core/app/model/CategoriasData.php";
include "db/core/app/model/ProductoData.php";
include "db/core/app/model/CarritoData.php";
include "db/core/app/model/ReservaData.php";
include "db/core/app/model/ClientesData.php";

$cliente = ClientesData::getById($_SESSION["id_cliente"]);

$id_cliente= $cliente->codcliente;

    $reserva = new ReservaData();
    $reserva->id_cliente = $id_cliente; 
    $reserva->cantidad = $_POST["cantidad"]; 
    $reserva->fecha = $_POST["fecha"].' '.$_POST["hora"];
    $reserva->mensaje =  $_POST["mensaje"];

   
    $reserva->add();  


$para  = $cliente->emailcliente;
$titulo = 'Reservas';
ob_start();
include "mail/reservamesa.php";
$mensaje = ob_get_contents();
ob_end_clean();
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";   
$cabeceras .= 'From: Reservas <rinconsuizo0744@gmail.com>' . "\r\n";    
mail($para, $titulo, $mensaje, $cabeceras);
print "<script>window.location='gracias.php';</script>";
?>
			
           