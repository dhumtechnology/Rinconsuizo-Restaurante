<?php
require_once __DIR__ . '/../class/class.php';
$tra = new Login();

if (isset($_SESSION['acceso']) && $_SESSION['acceso'] === 'superadministrador') {
	header('Location: panel.php');
	exit;
}

if (isset($_POST['btn-login']) || (isset($_POST['usuario']) && isset($_POST['password']))) {
	$_POST['login_mode'] = 'superadmin';
	$tra->Logueo();
	exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SuperAdmin · Acceso</title>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/icons.css" rel="stylesheet">
<link href="assets/sa.css?v=17" rel="stylesheet">
<script src="../assets/js/jquery.min.js"></script>
</head>
<body class="sa-login">
  <div class="sa-login-shell">
    <aside class="sa-login-aside">
      <div>
        <div class="sa-mark" style="width:44px;height:44px;border-radius:13px;background:rgba(255,255,255,.16);display:inline-flex;align-items:center;justify-content:center;">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round"><path d="M4 19V7l8-4 8 4v12"/><path d="M4 11h16"/><path d="M9 19v-5h6v5"/></svg>
        </div>
        <h2>Una consola para todos los locales</h2>
        <p>Administra restaurantes, personal y ventas desde un solo lugar.</p>
        <ul>
          <li>Alta de locales y marca del menú</li>
          <li>Administradores por restaurante</li>
          <li>Ventas globales del día y del mes</li>
        </ul>
      </div>
      <p style="font-size:.82rem;opacity:.75;margin:0;">Acceso exclusivo de SuperAdministrador</p>
    </aside>
    <div class="sa-login-box">
      <h1>Iniciar sesión</h1>
      <p class="sub">Usa tu usuario de plataforma. El personal de cada restaurante entra por la URL de su local.</p>
      <form name="loginform" id="loginform" action="" method="post">
        <input type="hidden" name="login_mode" value="superadmin">
        <div id="error"></div>
        <label for="usuario">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="usuario" autocomplete="username" required
               onKeyUp="this.value=this.value.toUpperCase();" placeholder="SUPERADMIN">
        <label for="password">Contraseña</label>
        <div class="sa-pass-wrap">
          <input type="password" class="form-control" name="password" id="password" autocomplete="current-password" required>
          <button type="button" class="sa-pass-toggle" data-target="password">Mostrar</button>
        </div>
        <button class="btn btn-sa" name="btn-login" id="btn-login" type="submit">
          Acceder
        </button>
      </form>
    </div>
  </div>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="assets/sa.js?v=9"></script>
  <script>
  $(function () {
    $('#loginform').on('submit', function (e) {
      e.preventDefault();
      var data = $(this).serialize();
      if (data.indexOf('btn-login=') === -1) data += (data ? '&' : '') + 'btn-login=1';
      $('#btn-login').prop('disabled', true).text('Verificando…');
      $.ajax({
        type: 'POST',
        url: 'login.php',
        data: data,
        success: function (response) {
          if (typeof response === 'object' && response !== null) {
            if (response.ok && response.redirect) {
              window.location.href = response.redirect;
              return;
            }
            $('#error').html(response.html || '<div class="alert alert-danger">Datos incorrectos</div>');
            $('#btn-login').prop('disabled', false).text('Acceder');
            return;
          }
          if (typeof response === 'string' && response.indexOf('window.location') !== -1) {
            $('body').append(response);
            return;
          }
          $('#error').html(typeof response === 'string' ? response : '<div class="alert alert-danger">Datos incorrectos</div>');
          $('#btn-login').prop('disabled', false).text('Acceder');
        },
        error: function () {
          $('#error').html('<div class="alert alert-danger">Error de conexión. Revisa que el servidor esté en marcha.</div>');
          $('#btn-login').prop('disabled', false).text('Acceder');
        }
      });
    });
  });
  </script>
</body>
</html>
