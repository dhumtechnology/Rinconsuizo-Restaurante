<?php
	include('class.consultas.php');
	$filtro    = $_GET["term"];
	$Json      = new Json;
	$venta  = $Json->BuscaCodventa($filtro);
	echo  json_encode($venta);
	
?>  