<?php
require_once __DIR__ . '/../class/class.php';

$_SESSION = array();
if (session_status() === PHP_SESSION_ACTIVE) {
	$params = session_get_cookie_params();
	setcookie(
		session_name(),
		'',
		time() - 3600,
		isset($params['path']) ? $params['path'] : '/',
		isset($params['domain']) ? $params['domain'] : '',
		!empty($params['secure']),
		true
	);
	session_destroy();
}
header('Location: login.php');
exit;
