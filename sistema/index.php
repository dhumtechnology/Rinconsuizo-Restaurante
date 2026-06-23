<?php
require_once("class/class.php");
$tra = new Login();

if(isset($_POST['btn-login']))
{
	$log = $tra->Logueo();
	exit;
}
elseif(isset($_POST["btn-recuperar"]))
{
	$reg = $tra->RecuperarPassword();
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="assets/images/favicon.png" rel="icon" type="image">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css"> 
<!-- script jquery -->
<script src="assets/js/jquery.min.js"></script> 
<script type="text/javascript" src="assets/script/titulos.js"></script>
<script type="text/javascript" src="assets/script/validation.min.js"></script>
<script type="text/javascript" src="assets/script/script.js"></script>
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
              <input class="form-control" type="email" placeholder="Ingrese su Email" name="email" id="email" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true">
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
  		<!--<img class="sobre" src="assets/images/sclogo.png" width="440" height="140" />--->
  		<div class="panel-heading bg-img"> 
  			<span class="text-center m-t-12 text-white">
  				<img src="assets/images/logo_white_2.png" alt="Software Gestión para Restaurant" width="250" height="77" class='retina-ready'>
  			</span>                          
  		</div>

			   <!---<div class="panel-heading"> 
		<div align="center" class="Estilo1"><img src="assets/images/logo_dark.png" alt="Software Academico" class='retina-ready' ></div>
	</div> --->

	<div class="panel-body">
		<form class="form-horizontal m-t-20" name="loginform" id="loginform" action="">

			<div id="error">
				<!-- error will be shown here ! -->
			</div>

			<div class="form-group has-feedback">
				<label class="control-label">Ingrese su Usuario: <span class="symbol required"></span></label>
				<input type="text" class="form-control" placeholder="Ingrese su Usuario" name="usuario" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true">
				<i class="fa fa-user form-control-feedback"></i>
			</div>

			<div class="form-group has-feedback">
				<label class="control-label">Ingrese su Password: <span class="symbol required"></span></label>
				<input class="form-control" type="password" placeholder="Ingrese su Password" name="password" id="password" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true">
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

        <script>
            var resizefunc = [];
        </script>

        <!-- Main -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.app.js"></script>
		
        <!-- jQuery  -->
        <script src="assets/pages/jquery.dashboard.js"></script>
        <script src="assets/plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
		
		 <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/images/login-bg.jpg", {speed: 500});
    </script>
</body>
</html>