<?php
	include('class.consultas.php');
	$filtro    = $_GET["term"];
	$Json      = new Json;
	$productos  = $Json->BuscaProductos($filtro);
	echo  json_encode($productos);
	
?>  