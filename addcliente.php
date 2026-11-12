<?php
require_once __DIR__ . '/web_session.php';
include "db/core/autoload.php";
include "db/core/app/model/ClientesData.php";
require_once __DIR__ . '/mail/enviar_correo.php';

function rs_web_redirect($path, $query = '')
{
	$url = function_exists('web_url') ? web_url($path) : $path;
	if ($query !== '') {
		$url .= (strpos($url, '?') === false ? '?' : '&') . $query;
	}
	header('Location: ' . $url);
	exit;
}

function rs_web_alert_redirect($message, $path)
{
	$url = function_exists('web_url') ? web_url($path) : $path;
	if (function_exists('rs_dialog_redirect')) {
		rs_dialog_redirect($message, $url);
	}
	echo '<script>alert(' . json_encode($message, JSON_UNESCAPED_UNICODE) . ');window.location=' . json_encode($url) . ';</script>';
	exit;
}

if (count($_POST) > 0) {

	$email = isset($_POST['email']) ? trim($_POST['email']) : '';
	$password = isset($_POST['password']) ? (string) $_POST['password'] : '';

	$clienteexiste = ClientesData::getByEmail($email, true);

	if ($clienteexiste) {
		if ($password !== '' && ClientesData::authenticate($email, $password)) {
			ClientesData::startWebSession($clienteexiste);
			rs_web_redirect('micuenta.php');
		}
		rs_web_alert_redirect('Error, ya existe esta cuenta.', 'micuenta.php');
	}

	$caracteres_permitidos = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$longitud = 6;
	$codigo = substr(str_shuffle($caracteres_permitidos), 0, $longitud);

	$cliente = new ClientesData();
	$cliente->cedcliente = isset($_POST['documento']) ? $_POST['documento'] : '';
	$cliente->nomcliente = isset($_POST['nombre']) ? $_POST['nombre'] : '';
	$cliente->direccliente = isset($_POST['direccion']) ? $_POST['direccion'] : '';
	$cliente->tlfcliente = isset($_POST['celular']) ? $_POST['celular'] : '';
	$cliente->emailcliente = $email;
	$cliente->password = $password;
	$cliente->codigo = $codigo;
	$cliente->estado = 0;
	if (function_exists('web_tenant_id')) {
		$tid = (int) web_tenant_id();
		if ($tid > 0) {
			$cliente->id_restaurante = $tid;
		}
	}

	$ret = $cliente->addCliente();
	if (!$ret || $ret[0] === false) {
		rs_web_alert_redirect('No se pudo crear la cuenta. Intente de nuevo.', 'crearcuenta.php');
	}

	$para = $email;
	$restaurante_nombre = function_exists('web_mail_restaurante_info') ? web_mail_restaurante_info()['nombre'] : '';
	$titulo = 'Confirmación de cuenta - ' . $restaurante_nombre;
	ob_start();
	include "mail/voucher.php";
	$mensaje = ob_get_contents();
	ob_end_clean();

	$envio = array('ok' => true, 'error' => '');
	if (function_exists('enviar_correo_web')) {
		$envio = enviar_correo_web($para, $titulo, $mensaje, isset($_POST['nombre']) ? $_POST['nombre'] : '');
		if (!$envio['ok']) {
			error_log('Registro cliente: fallo envío correo a ' . $para . ' — ' . $envio['error']);
		}
	}

	if (!isset($codigo) || $codigo === '') {
		$codigo = isset($cliente->codigo) ? $cliente->codigo : '';
	}

	$cli = ClientesData::authenticate($email, $password);
	if (!$cli && !empty($cliente->codcliente)) {
		$cli = ClientesData::getById($cliente->codcliente);
	}
	if ($cli) {
		ClientesData::startWebSession($cli);
	}

	if (empty($envio['ok'])) {
		$alerta = 'Su cuenta fue creada, pero no se pudo enviar el correo de verificación. Su código es: ' . $codigo . '. Revise spam o contacte al administrador.';
		rs_web_alert_redirect($alerta, 'micuenta.php');
	}

	rs_web_redirect('micuenta.php');
}

rs_web_redirect('crearcuenta.php');
