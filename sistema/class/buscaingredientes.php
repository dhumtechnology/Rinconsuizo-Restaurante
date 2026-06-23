<?php
	include('class.consultas.php');
	$filtro    = $_GET["term"];
	$Json      = new Json;
	$ingredientes  = $Json->BuscaIngredientes($filtro);
	echo  json_encode($ingredientes);
	
?>  