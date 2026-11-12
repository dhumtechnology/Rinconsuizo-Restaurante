<?php
require_once __DIR__ . '/web_session.php';
include "db/core/autoload.php";
include "db/core/app/model/ClientesData.php";

$dest = function_exists('web_url') ? web_url('micuenta.php') : 'micuenta.php';

$idCliente = isset($_POST['id_cliente']) ? (int) $_POST['id_cliente'] : 0;
if ($idCliente <= 0 && !empty($_SESSION['id_cliente'])) {
	$idCliente = (int) $_SESSION['id_cliente'];
}

$codigo = ClientesData::getById($idCliente);
if ($codigo && isset($codigo->codigo) && isset($_POST['codigo']) && $codigo->codigo == $_POST['codigo']) {
	$codigo->estado = "1";
	$codigo->updateCantidad();
	echo '<script>alert(' . json_encode('Gracias por confirmar', JSON_UNESCAPED_UNICODE) . ');window.location=' . json_encode($dest) . ';</script>';
	exit;
}

echo '<script>alert(' . json_encode('El código brindado no es igual, verifique por favor!!', JSON_UNESCAPED_UNICODE) . ');window.location=' . json_encode($dest) . ';</script>';
exit;
