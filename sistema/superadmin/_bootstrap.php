<?php
/** Layout helpers for SuperAdmin console */

function sa_nav_active($files)
{
	$script = isset($_SERVER['SCRIPT_NAME']) ? basename($_SERVER['SCRIPT_NAME']) : '';
	$files = (array) $files;
	return in_array($script, $files, true) ? 'active' : '';
}

function sa_icon($name)
{
	$icons = array(
		'mark' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19V7l8-4 8 4v12"/><path d="M4 11h16"/><path d="M9 19v-5h6v5"/></svg>',
		'home' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11.5 12 4l8 7.5"/><path d="M6 10.5V20h12v-9.5"/></svg>',
		'store' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10h16v10H4z"/><path d="M4 10 6 4h12l2 6"/><path d="M9 20v-6h6v6"/></svg>',
		'users' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3.2"/><path d="M3.5 19c.6-3.2 2.8-5 5.5-5s4.9 1.8 5.5 5"/><circle cx="17" cy="9" r="2.4"/><path d="M16.2 14.2c2.2.4 3.9 2 4.4 4.8"/></svg>',
		'chart' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19h16"/><path d="M7 16V9"/><path d="M12 16V5"/><path d="M17 16v-7"/></svg>',
		'out' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10 5H6v14h4"/><path d="M13 12H4"/><path d="m16 8 5 4-5 4"/></svg>',
		'plus' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>',
		'search' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="11" cy="11" r="6.5"/><path d="m20 20-3.5-3.5"/></svg>',
		'menu' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>',
		'eye' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>',
		'copy' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="8" y="8" width="12" height="12" rx="2"/><path d="M4 16V6a2 2 0 0 1 2-2h10"/></svg>',
		'coin' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8"/><path d="M12 7v10M9.5 9.5c.6-1 2.6-1.3 3.6-.3s.2 2.4-1.6 2.8c-1.8.4-2.5 1.6-1.6 2.7s3 .8 3.7-.2"/></svg>',
		'ticket' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 8h16v3a2 2 0 0 0 0 4v3H4v-3a2 2 0 0 0 0-4V8z"/></svg>',
	);
	return isset($icons[$name]) ? $icons[$name] : '';
}

function sa_initials($nombre)
{
	$nombre = trim((string) $nombre);
	if ($nombre === '') {
		return '?';
	}
	$parts = preg_split('/\s+/', $nombre);
	$out = strtoupper(substr($parts[0], 0, 1));
	if (count($parts) > 1) {
		$out .= strtoupper(substr($parts[count($parts) - 1], 0, 1));
	}
	return htmlspecialchars($out);
}

function sa_logo_html($logo, $nombre, $class = 'sa-logo-preview')
{
	if (!empty($logo)) {
		$src = function_exists('restaurant_logo_url') ? restaurant_logo_url($logo) : '../' . $logo;
		return '<img class="' . htmlspecialchars($class) . '" src="' . htmlspecialchars($src) . '" alt="">';
	}
	return '<span class="sa-initials" title="' . htmlspecialchars($nombre) . '">' . sa_initials($nombre) . '</span>';
}

function sa_money($n)
{
	return 'S/ ' . number_format((float) $n, 2);
}

function sa_fecha($s)
{
	$t = strtotime((string) $s);
	if (!$t) {
		return htmlspecialchars((string) $s);
	}
	return date('d/m/Y H:i', $t);
}

function sa_fecha_larga()
{
	$meses = array(1 => 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
	$dias = array('domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado');
	$n = (int) date('n');
	$w = (int) date('w');
	return $dias[$w] . ' ' . (int) date('j') . ' de ' . $meses[$n] . ' de ' . date('Y');
}

function sa_saludo()
{
	$h = (int) date('G');
	if ($h < 12) {
		return 'Buenos días';
	}
	if ($h < 19) {
		return 'Buenas tardes';
	}
	return 'Buenas noches';
}

function sa_nav_item($href, $label, $files, $icon)
{
	$active = sa_nav_active($files);
	$aria = $active ? ' aria-current="page"' : '';
	echo '<a class="' . $active . '" href="' . htmlspecialchars($href) . '"' . $aria . '>' . sa_icon($icon) . '<span>' . htmlspecialchars($label) . '</span></a>';
}

function sa_header($title = 'SuperAdmin', $subtitle = '')
{
	$nombre = isset($_SESSION['nombres']) ? (string) $_SESSION['nombres'] : 'SuperAdmin';
	$safeNombre = htmlspecialchars($nombre);
	echo '<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">';
	echo '<title>' . htmlspecialchars($title) . ' · Plataforma</title>';
	echo '<link href="../assets/css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="../assets/css/icons.css" rel="stylesheet">';
	echo '<link href="assets/sa.css?v=17" rel="stylesheet">';
	echo '<script src="../assets/js/jquery.min.js"></script>';
	echo '</head><body class="sa-body">';
	echo '<a class="sa-skip" href="#sa-content">Saltar al contenido</a>';
	echo '<div class="sa-overlay" id="sa-overlay"></div>';
	echo '<aside class="sa-sidebar" id="sa-sidebar">';
	echo '<a class="sa-brand" href="panel.php"><div class="sa-mark">' . sa_icon('mark') . '</div><div><strong>Plataforma</strong><small>Consola SuperAdmin</small></div></a>';
	echo '<nav>';
	echo '<p class="sa-nav-label">Resumen</p>';
	sa_nav_item('panel.php', 'Inicio', 'panel.php', 'home');
	echo '<p class="sa-nav-label">Operación</p>';
	sa_nav_item('restaurantes.php', 'Restaurantes', array('restaurantes.php', 'forrestaurante.php', 'config_restaurante.php'), 'store');
	sa_nav_item('usuarios.php', 'Usuarios', array('usuarios.php', 'forusuario.php'), 'users');
	sa_nav_item('ventas.php', 'Ventas', 'ventas.php', 'chart');
	echo '</nav>';
	echo '<div class="sa-sidebar-foot">';
	echo '<div class="sa-sidebar-user"><span class="sa-avatar">' . sa_initials($nombre) . '</span><div class="meta"><strong>' . $safeNombre . '</strong><span>Superadministrador</span></div></div>';
	echo '<nav><a class="sa-nav-out" href="logout.php">' . sa_icon('out') . '<span>Cerrar sesión</span></a></nav>';
	echo '</div></aside>';
	echo '<main class="sa-main">';
	echo '<header class="sa-top">';
	echo '<div class="sa-top-copy"><h1>' . htmlspecialchars($title) . '</h1>';
	if ($subtitle !== '') {
		echo '<p>' . htmlspecialchars($subtitle) . '</p>';
	}
	echo '</div><div class="sa-top-tools">';
	echo '<button type="button" class="sa-menu-btn" id="sa-menu-btn" aria-label="Abrir menú">' . sa_icon('menu') . '</button>';
	echo '<div class="sa-chip">' . $safeNombre . '</div>';
	echo '</div></header>';
	echo '<div class="sa-content" id="sa-content">';
}

function sa_footer()
{
	echo '</div></main>';
	echo '<div class="sa-toast" id="sa-toast" role="status"></div>';
	echo '<script src="../assets/js/bootstrap.min.js"></script>';
	echo '<script src="assets/sa.js?v=9"></script>';
	echo '</body></html>';
}

function sa_empty($title, $text, $href = '', $cta = '')
{
	echo '<div class="sa-empty">';
	echo '<div class="sa-empty-icon">' . sa_icon('store') . '</div>';
	echo '<h3>' . htmlspecialchars($title) . '</h3>';
	echo '<p>' . htmlspecialchars($text) . '</p>';
	if ($href !== '' && $cta !== '') {
		echo '<a class="sa-btn" href="' . htmlspecialchars($href) . '">' . htmlspecialchars($cta) . '</a>';
	}
	echo '</div>';
}

function sa_search($placeholder = 'Buscar…')
{
	echo '<div class="sa-search">' . sa_icon('search') . '<input type="search" data-sa-search placeholder="' . htmlspecialchars($placeholder) . '" aria-label="Buscar"></div>';
}

function sa_gate()
{
	require_once("../class/class.php");
	if (!isset($_SESSION['acceso']) || $_SESSION['acceso'] !== 'superadministrador') {
		header('Location: login.php');
		exit;
	}
	$tra = new Login();
	$tra->ExpiraSession();
	return $tra;
}
