<?php
if (!isset($_SESSION['acceso'])) {
	echo '<script type="text/javascript">alert("NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\\nDEBERA DE INICIAR SESION");document.location.href="logout.php";</script>';
	exit;
}
pos_require_administrador_pos('Solo el Administrador del restaurante puede acceder a esta sección.', 'panel.php');
