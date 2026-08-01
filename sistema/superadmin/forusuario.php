<?php
require_once('_bootstrap.php');
$tra = sa_gate();

if (isset($_POST['btn-admin'])) {
	$tra->RegistrarAdminRestaurante();
	exit;
}

$restaurantes = $tra->ListarRestaurantes();
$pre = isset($_GET['id_restaurante']) ? (int)$_GET['id_restaurante'] : 0;
sa_header('Crear administrador de restaurante');
?>
<div id="sa-msg"></div>
<form class="sa-form" method="post" id="form-admin" action="#">
  <div class="sa-form-grid">
    <div class="form-group full">
      <label>Restaurante *</label>
      <select name="id_restaurante" required>
        <option value="">SELECCIONE</option>
        <?php foreach ($restaurantes as $r) { ?>
        <option value="<?php echo (int)$r['id_restaurante']; ?>" <?php echo $pre===(int)$r['id_restaurante']?'selected':''; ?>>
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
    <div class="form-group">
      <label>Cargo</label>
      <input type="text" name="cargo" value="ADMINISTRADOR">
    </div>
    <div class="form-group full">
      <label>Email</label>
      <input type="email" name="email">
    </div>
    <div class="form-group">
      <label>Usuario login *</label>
      <input type="text" name="usuario" required autocomplete="off">
    </div>
    <div class="form-group">
      <label>Password *</label>
      <input type="password" name="password" required autocomplete="new-password">
    </div>
  </div>
  <div class="sa-form-actions">
    <button type="submit" class="sa-btn" name="btn-admin" id="btn-admin">Crear administrador</button>
    <a class="sa-btn secondary" href="usuarios.php">Volver</a>
  </div>
</form>
<script>
$('#form-admin').on('submit', function(e){
  e.preventDefault();
  $.post('forusuario.php', $(this).serialize() + '&btn-admin=1', function(html){
    $('#sa-msg').html(html);
    if (html.indexOf('alert-success') !== -1) {
      setTimeout(function(){ window.location = 'usuarios.php'; }, 900);
    }
  });
});
</script>
<?php sa_footer(); ?>
