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
<link href="assets/sa.css" rel="stylesheet">
<script src="../assets/js/jquery.min.js"></script>
<style>
body.sa-login {
  margin: 0;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: radial-gradient(ellipse at 20% 20%, #1a2a40 0%, #0f1419 55%, #0a0e14 100%);
  color: var(--sa-text);
  font-family: "Segoe UI", "Helvetica Neue", Arial, sans-serif;
}
.sa-login-box {
  width: 100%;
  max-width: 400px;
  background: var(--sa-panel);
  border: 1px solid var(--sa-border);
  border-radius: 12px;
  padding: 36px 32px;
  box-shadow: 0 24px 48px rgba(0,0,0,0.35);
}
.sa-login-box h1 {
  margin: 0 0 6px;
  font-size: 1.5rem;
  font-weight: 700;
}
.sa-login-box .sub {
  color: var(--sa-muted);
  font-size: 0.9rem;
  margin-bottom: 28px;
}
.sa-login-box label {
  display: block;
  font-size: 0.8rem;
  color: var(--sa-muted);
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}
.sa-login-box .form-control {
  background: #121a26;
  border: 1px solid var(--sa-border);
  color: var(--sa-text);
  height: 44px;
  margin-bottom: 16px;
}
.sa-login-box .form-control:focus {
  border-color: var(--sa-accent);
  box-shadow: 0 0 0 2px rgba(61,156,253,0.2);
}
.sa-login-box .btn-sa {
  width: 100%;
  height: 46px;
  background: var(--sa-accent);
  border: none;
  color: #fff;
  font-weight: 600;
  border-radius: 8px;
  margin-top: 8px;
}
.sa-login-box .btn-sa:hover { background: #5aadff; color: #fff; }
#error { margin-bottom: 12px; }
</style>
</head>
<body class="sa-login">
  <div class="sa-login-box">
    <h1>Plataforma</h1>
    <p class="sub">Acceso SuperAdministrador</p>
    <form name="loginform" id="loginform" action="" method="post">
      <input type="hidden" name="login_mode" value="superadmin">
      <div id="error"></div>
      <label for="usuario">Usuario</label>
      <input type="text" class="form-control" name="usuario" id="usuario" autocomplete="username" required
             onKeyUp="this.value=this.value.toUpperCase();">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" autocomplete="current-password" required>
      <button class="btn btn-sa" name="btn-login" id="btn-login" type="submit">
        <span class="fa fa-sign-in"></span> Acceder
      </button>
    </form>
  </div>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script>
  $(function () {
    $('#loginform').on('submit', function (e) {
      e.preventDefault();
      var data = $(this).serialize();
      if (data.indexOf('btn-login=') === -1) data += (data ? '&' : '') + 'btn-login=1';
      $('#btn-login').prop('disabled', true).html('<i class="fa fa-refresh"></i> Verificando...');
      $.ajax({
        type: 'POST',
        url: 'login.php',
        data: data,
        success: function (response) {
          if (response.indexOf('window.location') !== -1) {
            $('body').append(response);
            return;
          }
          $('#error').html('<div style="color:#ff8a8a;margin-bottom:12px">' + response + '</div>');
          $('#btn-login').prop('disabled', false).html('<span class="fa fa-sign-in"></span> Acceder');
        },
        error: function () {
          $('#error').html('<div style="color:#ff8a8a">Error de conexión</div>');
          $('#btn-login').prop('disabled', false).html('<span class="fa fa-sign-in"></span> Acceder');
        }
      });
    });
  });
  </script>
</body>
</html>
