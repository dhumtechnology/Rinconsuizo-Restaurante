<?php
/**
 * Cierre de sesión:
 * - SuperAdmin → /sistema/superadmin/login.php
 * - Personal de restaurante → /{slug}/sistema/
 */
require_once __DIR__ . '/class/classconexion.php';
require_once __DIR__ . '/class/funciones_basicas.php';
if (function_exists('pos_bootstrap_session')) {
	pos_bootstrap_session();
} elseif (session_status() === PHP_SESSION_NONE) {
	session_start();
}

$__tenantCtx = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tenant_context.php';
if (is_file($__tenantCtx)) {
	require_once $__tenantCtx;
}

$wasSa = isset($_SESSION['acceso']) && $_SESSION['acceso'] === 'superadministrador';
$restSlug = '';
if (!$wasSa) {
	if (function_exists('restaurant_resolve_logout_slug')) {
		$restSlug = restaurant_resolve_logout_slug();
	} else {
		if (!empty($_SESSION['url_slug'])) {
			$restSlug = preg_replace('/[^a-z0-9\-]/', '', strtolower($_SESSION['url_slug']));
		} elseif (!empty($_GET['r_slug'])) {
			$restSlug = preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['r_slug']));
		} elseif (!empty($_COOKIE['rs_slug'])) {
			$restSlug = preg_replace('/[^a-z0-9\-]/', '', strtolower($_COOKIE['rs_slug']));
		}
	}
}

// Conservar cookie de slug de restaurante (para próximos logouts)
if ($restSlug !== '' && !headers_sent()) {
	setcookie('rs_slug', $restSlug, time() + 60 * 60 * 24 * 365, '/', '', false, true);
}

$session_name = session_name();
$_SESSION = array();
session_destroy();

if (isset($_COOKIE[$session_name])) {
	setcookie($session_name, '', time() - 3600, '/');
}

$saLogin = function_exists('app_url') ? app_url('/sistema/superadmin/login.php') : '/sistema/superadmin/login.php';
if ($wasSa) {
	$redirect = $saLogin;
} elseif ($restSlug !== '') {
	$redirect = function_exists('restaurant_login_url')
		? restaurant_login_url($restSlug)
		: (function_exists('app_url') ? app_url('/' . $restSlug . '/sistema/') : ('/' . $restSlug . '/sistema/'));
} else {
	// Sin slug conocido: no mandar a SuperAdmin por defecto si hay cookie
	if (!empty($_COOKIE['rs_slug'])) {
		$s = preg_replace('/[^a-z0-9\-]/', '', strtolower($_COOKIE['rs_slug']));
		$redirect = $s !== ''
			? (function_exists('app_url') ? app_url('/' . $s . '/sistema/') : ('/' . $s . '/sistema/'))
			: $saLogin;
	} else {
		$redirect = $saLogin;
	}
}

header('Location: ' . $redirect);
exit;
