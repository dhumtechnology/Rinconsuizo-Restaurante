<?php
require_once('class/class.php');
if (!isset($_SESSION['acceso']) || $_SESSION['acceso'] !== 'administrador') {
	if (function_exists('rs_dialog_redirect')) {
		rs_dialog_redirect('NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.', 'logout');
	}
	echo "<script>alert('NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.');document.location.href='logout';</script>";
	exit;
}

$tra = new Login();
$tra->ExpiraSession();

if (!empty($_GET['download'])) {
	$tra->DescargarRespaldoRestaurante();
}

$con = new Login();
$con = $con->ContarRegistros();
$idRest = function_exists('tenantId') ? (int) tenantId() : 0;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Respaldo</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="assets/images/favicon.png" rel="icon" type="image">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/script/titulos.js"></script>
<script type="text/javascript" src="assets/script/script2.js?v=editnav2"></script>
</head>
<body onLoad="muestraReloj(); getTime();" class="fixed-left">
<div id="wrapper">
<?php include('menu.php'); ?>
<div class="content-page">
<div class="content">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="page-header-title">
<h4 class="pull-left page-title"><i class="fa fa-database"></i> Respaldo de datos del restaurante</h4>
<ol class="breadcrumb pull-right">
<li><a href="panel">Inicio</a></li>
<li class="active">Respaldar</li>
</ol>
<div class="clearfix"></div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-download"></i> Descargar respaldo SQL</h3></div>
<div class="panel-body">
<p>Genera un archivo <strong>.sql</strong> con los datos de su restaurante (productos, ventas, mesas, clientes, configuración, etc.). No incluye información de otros locales.</p>
<?php if ($idRest <= 0) { ?>
<div class="alert alert-warning">No se detectó el restaurante en sesión.</div>
<?php } else { ?>
<p class="text-muted">Restaurante activo: <strong>#<?php echo (int) $idRest; ?></strong></p>
<a href="backup?download=1" class="btn btn-primary btn-lg"><span class="fa fa-cloud-download"></span> Descargar respaldo ahora</a>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<footer class="footer"> <i class="fa fa-copyright"></i> <span class="current-year"></span>. </footer>
</div>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.app.js"></script>
</body>
</html>
