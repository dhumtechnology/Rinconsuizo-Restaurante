<?php
require_once('_bootstrap.php');
$tra = sa_gate();

if (isset($_POST['btn-admin'])) {
	$tra->RegistrarAdminRestaurante();
	exit;
}

$restaurantes = $tra->ListarRestaurantes();
$pre = isset($_GET['id_restaurante']) ? (int) $_GET['id_restaurante'] : 0;
sa_header('Crear administrador', 'Podrá entrar al POS del restaurante elegido con nivel ADMINISTRADOR');
?>
<div id="sa-msg"></div>
<?php if (empty($restaurantes)) {
  sa_empty('Primero crea un restaurante', 'Un administrador siempre pertenece a un local.', 'forrestaurante.php', 'Nuevo restaurante');
} else { ?>
<form class="sa-form" method="post" id="form-admin" action="#">
  <section class="sa-form-section">
    <h2>Restaurante y persona</h2>
    <p class="lead">Usa un usuario único dentro de ese local. Las credenciales se enviarán al correo indicado.</p>
    <div class="sa-form-grid">
      <div class="form-group full">
        <label>Restaurante *</label>
        <select name="id_restaurante" required>
          <option value="">Selecciona un restaurante</option>
          <?php foreach ($restaurantes as $r) { ?>
          <option value="<?php echo (int) $r['id_restaurante']; ?>" <?php echo $pre === (int) $r['id_restaurante'] ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($r['nombre']); ?>
          </option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label>Cédula / DNI *</label>
        <input type="text" name="cedula" required>
      </div>
      <div class="form-group">
        <label>Nombres *</label>
        <input type="text" name="nombres" required>
      </div>
      <div class="form-group">
        <label>Teléfono</label>
        <input type="text" name="nrotelefono">
      </div>
      <div class="form-group full">
        <label>Email *</label>
        <input type="email" name="email" required autocomplete="email">
        <span class="sa-hint">Recibirá usuario, contraseña y enlace al POS en este correo.</span>
      </div>
    </div>
  </section>
  <section class="sa-form-section">
    <h2>Acceso al POS</h2>
    <p class="lead">El usuario se convierte a mayúsculas al iniciar sesión. La contraseña distingue mayúsculas.</p>
    <div class="sa-form-grid">
      <div class="form-group">
        <label>Usuario login *</label>
        <input type="text" name="usuario" required autocomplete="off">
      </div>
      <div class="form-group">
        <label>Contraseña *</label>
        <div class="sa-pass-wrap">
          <input type="password" name="password" id="password" required autocomplete="new-password">
          <button type="button" class="sa-pass-toggle" data-target="password">Mostrar</button>
        </div>
        <span class="sa-hint"><a href="#" data-sa-genpass="password">Generar una contraseña segura</a></span>
      </div>
    </div>
  </section>
  <div class="sa-form-actions">
    <button type="submit" class="sa-btn" name="btn-admin" id="btn-admin">Crear administrador</button>
    <a class="sa-btn secondary" href="usuarios.php">Cancelar</a>
  </div>
</form>
<script>
$('#form-admin').on('submit', function (e) {
  e.preventDefault();
  var $btn = $('#btn-admin').prop('disabled', true);
  $.ajax({
    url: 'forusuario.php',
    type: 'POST',
    data: $(this).serialize() + '&btn-admin=1',
    success: function (html) {
      var ok = window.SA.showMsg('#sa-msg', html);
      $btn.prop('disabled', false);
      if (ok) setTimeout(function () { window.location = 'usuarios.php'; }, 900);
    },
    error: function () {
      window.SA.showMsg('#sa-msg', '<div class="alert alert-danger">No se pudo crear el usuario. Inténtalo de nuevo.</div>');
      $btn.prop('disabled', false);
    }
  });
});
</script>
<?php } ?>
<?php sa_footer(); ?>
