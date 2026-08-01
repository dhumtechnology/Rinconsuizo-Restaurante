<?php
require_once("class/class.php");
$tra = new Login();

// Solo por URL (?r_slug= o rewrite /{slug}/sistema/), no por sesión previa
$loginSlug = '';
if (!empty($_GET['r_slug'])) {
	$loginSlug = preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['r_slug']));
} elseif (!empty($_REQUEST['r_slug']) && (isset($_POST['btn-login']) || isset($_POST['usuario']))) {
	$loginSlug = preg_replace('/[^a-z0-9\-]/', '', strtolower($_REQUEST['r_slug']));
}

// Sin slug: el login de restaurante no aplica → SuperAdmin
if ($loginSlug === '' && !(isset($_POST['btn-login']) || (isset($_POST['usuario']) && isset($_POST['password'])))) {
	header('Location: /sistema/superadmin/login.php');
	exit;
}

if (isset($_POST['btn-login']) || (isset($_POST['usuario']) && isset($_POST['password']) && !isset($_POST['btn-recuperar'])))
{
	if ($loginSlug === '') {
		header('Location: /sistema/superadmin/login.php');
		exit;
	}
	$_GET['r_slug'] = $loginSlug;
	if (function_exists('tenant_resolve_request')) {
		tenant_resolve_request();
	}
	$log = $tra->Logueo();
	exit;
}
elseif(isset($_POST["btn-recuperar"]))
{
	$reg = $tra->RecuperarPassword();
	exit;
}

$loginRest = null;
if ($loginSlug !== '' && function_exists('tenant_find_restaurante')) {
	$loginRest = tenant_find_restaurante($loginSlug, null);
	if ($loginRest) {
		$_SESSION['url_slug'] = $loginRest['slug'];
		$_SESSION['url_id_restaurante'] = (int) $loginRest['id_restaurante'];
		$_SESSION['web_restaurante'] = $loginRest;
	}
}
if (!$loginRest) {
	header('Location: /sistema/superadmin/login.php');
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $loginRest ? htmlspecialchars($loginRest['nombre']).' · Acceso' : 'Acceso'; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="assets/images/favicon.png" rel="icon" type="image">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<style>
  /* Login: nunca mostrar teclado táctil (ni si queda script en caché) */
  #teclado-tactil { display: none !important; visibility: hidden !important; pointer-events: none !important; height: 0 !important; overflow: hidden !important; }
</style>
<script>
window.__DISABLE_TECLADO_TACTIL = true;
(function () {
  function killTeclado() {
    try {
      if (window.TecladoTactil && typeof window.TecladoTactil.__destroy === 'function') {
        window.TecladoTactil.__destroy();
      }
    } catch (e) { /* ignore */ }
    window.TecladoTactil = {
      __disabled: true,
      __destroy: function () {},
      show: function () {},
      hide: function () {},
      openForObservaciones: function () {},
      closeObservaciones: function () {}
    };
    var n = document.getElementById('teclado-tactil');
    if (n && n.parentNode) n.parentNode.removeChild(n);
  }
  // Bloquear inyección dinámica del script (jquery.app.js antiguo en caché)
  var appendChildOrig = Node.prototype.appendChild;
  Node.prototype.appendChild = function (child) {
    if (child && child.tagName) {
      var src = child.src || child.href || '';
      if (typeof src === 'string' && src.indexOf('teclado-tactil') !== -1) {
        return child;
      }
      if (child.id === 'teclado-tactil') {
        return child;
      }
    }
    return appendChildOrig.call(this, child);
  };
  killTeclado();
  document.addEventListener('DOMContentLoaded', killTeclado);
  window.addEventListener('load', killTeclado);
  setTimeout(killTeclado, 0);
  setTimeout(killTeclado, 300);
  setTimeout(killTeclado, 1000);
})();
</script>
<?php if ($loginRest) {
  if (function_exists('restaurant_brand_apply_session')) {
    restaurant_brand_apply_session($loginRest);
  }
  if (function_exists('sistema_brand_head_styles')) {
    sistema_brand_head_styles();
  }
?>
<style>
  .panel-pages .panel-heading.bg-img {
    text-align: center !important;
  }
  .panel-pages .login-brand {
    display: block;
    width: 100%;
    text-align: center;
    padding: 12px 16px 8px;
  }
  .panel-pages .login-brand img {
    display: block;
    margin: 0 auto;
    max-width: 220px;
    max-height: 88px;
    width: auto;
    height: auto;
    object-fit: contain;
  }
  .panel-pages .login-brand-name {
    margin-top: 8px;
    font-size: 14px;
    text-align: center;
  }
</style>
<?php } ?>
<!-- script jquery -->
<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/script/titulos.js"></script>
<script type="text/javascript" src="assets/script/validation.min.js"></script>
<script type="text/javascript" src="assets/script/script.js?v=salogin3"></script>
<!-- script jquery -->
</head>
<body>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button>
          <h4 class="modal-title text-primary" id="myModalLabel"><strong>Recuperar Password</strong></h4>
        </div>
        <form class="form-horizontal m-t-20" method="post" name="recuperarpassword" id="recuperarpassword">
          <div id="errorr">
            <!-- error will be shown here ! -->
          </div>

           <div class="col-sm-12">
             <div class="form-group has-feedback">
              <label class="control-label">Ingrese su Email: <span class="symbol required"></span></label>
              <input class="form-control no-teclado" type="email" placeholder="Ingrese su Email" name="email" id="email" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true">
              <i class="fa fa-envelope form-control-feedback"></i>
              </div>
            </div>

            <p class="text-muted"><small>Su nueva clave de Acceso será enviada al Correo Electrónico que ingrese</small></p>

            <div class="modal-footer">
              <button class="btn btn-block btn-lg btn-warning waves-effect waves-light" name="btn-recuperar" id="btn-recuperar" type="submit"><span class="fa fa-check-square-o"></span> Recuperar Password</button>
            </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

	<style type="text/css">
   .panel-primary>.panel-heading {
    background-color: #e8e8e8;
}
  </style>

  <div class="accountbg"></div>

  <div class="wrapper-page">
  	<div class="panel panel-color panel-primary panel-pages">
  		<div class="panel-heading bg-img">
  			<div class="login-brand text-white">
  				<?php
  				$logoSrc = function_exists('restaurant_logo_url')
  					? restaurant_logo_url($loginRest && !empty($loginRest['logo']) ? $loginRest['logo'] : null)
  					: 'assets/images/logo_white_2.png';
  				?>
  				<img src="<?php echo htmlspecialchars($logoSrc); ?>" alt="<?php echo $loginRest ? htmlspecialchars($loginRest['nombre']) : 'Restaurant'; ?>">
  				<?php if ($loginRest) { ?>
  				<div class="login-brand-name"><?php echo htmlspecialchars($loginRest['nombre']); ?></div>
  				<?php } ?>
  			</div>
  		</div>

	<div class="panel-body">
		<form class="form-horizontal m-t-20" name="loginform" id="loginform" action="">
			<?php if ($loginSlug !== '') { ?>
			<input type="hidden" name="r_slug" value="<?php echo htmlspecialchars($loginSlug); ?>">
			<?php } ?>

			<div id="error">
				<!-- error will be shown here ! -->
			</div>

			<div class="form-group has-feedback">
				<label class="control-label">Ingrese su Usuario: <span class="symbol required"></span></label>
				<input type="text" class="form-control no-teclado" placeholder="Ingrese su Usuario" name="usuario" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="username" required="" aria-required="true" inputmode="text">
				<i class="fa fa-user form-control-feedback"></i>
			</div>

			<div class="form-group has-feedback">
				<label class="control-label">Ingrese su Password: <span class="symbol required"></span></label>
				<input class="form-control no-teclado" type="password" placeholder="Ingrese su Password" name="password" id="password" autocomplete="current-password" required="" aria-required="true">
				<i class="fa fa-lock form-control-feedback"></i>
			</div>

            <div class="form-group">
              <div class="col-md-12 m-t-20">
                <a href="javascript:void(0)" class="text-dark pull-right" data-href="#" data-toggle="modal" data-target=".bs-example-modal-sm" data-placement="left" data-backdrop="static" data-keyboard="false" rel="tooltip" title="Recuperar Contraseña"><i class="fa fa-lock"></i> Olvidaste tu Contraseña?</a>
              </div>
            </div>

			<div class="form-group text-center m-t-20">
				<div class="col-xs-12">
					<button class="btn btn-block btn-lg btn-warning waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Haga clic aquí para iniciar sesión" name="btn-login" id="btn-login" type="submit"><span class="fa fa-sign-in"></span> Acceder</button>
				</div>
			</div>

			</form>
		</div>
	</div>
</div>

        <!-- Solo lo necesario para login (sin jquery.app = sin teclado en caché) -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
        <script>
        $.backstretch("assets/images/login-bg.jpg", {speed: 500});
        </script>
</body>
</html>