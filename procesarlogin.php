<?php
require_once __DIR__ . '/web_session.php';
include "db/core/autoload.php";
include "db/core/app/model/ClientesData.php";

$destLogin = function_exists('web_url') ? web_url('micuenta.php') : 'micuenta.php';
$destOk = $destLogin;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: ' . $destLogin);
	exit;
}

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$cli = ClientesData::authenticate($email, $password);

if ($cli) {
	ClientesData::startWebSession($cli);
	if (isset($_POST['checkout'])) {
		$destOk = function_exists('web_url') ? web_url('micuenta.php') : 'micuenta.php';
	} else {
		$destOk = function_exists('web_url') ? web_url('carrito.php') : 'carrito.php';
	}
	header('Location: ' . $destOk);
	exit;
}

$sep = (strpos($destLogin, '?') === false) ? '?' : '&';
header('Location: ' . $destLogin . $sep . 'login=error');
exit;
