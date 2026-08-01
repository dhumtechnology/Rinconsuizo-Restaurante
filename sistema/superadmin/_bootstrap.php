<?php
/** Layout helpers for SuperAdmin console */

function sa_nav_active($files)
{
	$script = isset($_SERVER['SCRIPT_NAME']) ? basename($_SERVER['SCRIPT_NAME']) : '';
	$files = (array) $files;
	return in_array($script, $files, true) ? 'active' : '';
}

function sa_header($title = 'SuperAdmin')
{
	$nombre = isset($_SESSION['nombres']) ? htmlspecialchars($_SESSION['nombres']) : 'SuperAdmin';
	echo '<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">';
	echo '<title>'.htmlspecialchars($title).' · Plataforma</title>';
	echo '<link href="../assets/css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="../assets/css/icons.css" rel="stylesheet">';
	echo '<link href="assets/sa.css?v=3" rel="stylesheet">';
	echo '<script src="../assets/js/jquery.min.js"></script>';
	echo '</head><body class="sa-body">';
	echo '<aside class="sa-sidebar">';
	echo '<div class="sa-brand"><div class="sa-mark">SA</div><strong>Plataforma</strong><small>SuperAdministrador</small></div>';
	echo '<nav>';
	echo '<a class="'.sa_nav_active('panel.php').'" href="panel.php">Dashboard</a>';
	echo '<a class="'.sa_nav_active(array('restaurantes.php','forrestaurante.php','config_restaurante.php')).'" href="restaurantes.php">Restaurantes</a>';
	echo '<a class="'.sa_nav_active('forrestaurante.php').'" href="forrestaurante.php">Nuevo restaurante</a>';
	echo '<a class="'.sa_nav_active(array('usuarios.php','forusuario.php')).'" href="usuarios.php">Usuarios</a>';
	echo '<a class="'.sa_nav_active('forusuario.php').'" href="forusuario.php">Crear admin</a>';
	echo '<a class="'.sa_nav_active('ventas.php').'" href="ventas.php">Ventas globales</a>';
	echo '<a class="sa-nav-out" href="logout.php">Salir</a>';
	echo '</nav></aside>';
	echo '<main class="sa-main">';
	echo '<header class="sa-top"><h1>'.htmlspecialchars($title).'</h1><div class="sa-user">'.$nombre.'</div></header>';
	echo '<div class="sa-content">';
}

function sa_footer()
{
	echo '</div></main>';
	echo '<script src="../assets/js/bootstrap.min.js"></script>';
	echo '</body></html>';
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
