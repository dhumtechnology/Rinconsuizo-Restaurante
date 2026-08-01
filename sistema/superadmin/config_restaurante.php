<?php
require_once('_bootstrap.php');
$tra = sa_gate();

if (isset($_POST['btn-config'])) {
	$tra->ActualizarConfiguracionRestaurante();
	exit;
}

$id = isset($_GET['id_restaurante']) ? (int)$_GET['id_restaurante'] : 0;
$rest = $id > 0 ? $tra->RestaurantePorId($id) : array();
$cfg = $id > 0 ? $tra->ConfiguracionPorRestaurante($id) : array();
if (empty($rest) || empty($cfg)) {
	header('Location: restaurantes.php');
	exit;
}
sa_header('Configuración POS · ' . $rest[0]['nombre']);
$c = $cfg[0];
?>
<div id="sa-msg"></div>
<form class="sa-form" method="post" id="form-cfg" action="#">
  <input type="hidden" name="id_restaurante" value="<?php echo $id; ?>">
  <div class="sa-form-grid">
  <div class="form-group"><label>RUC / RIF</label><input name="rifempresa" value="<?php echo htmlspecialchars($c['rifempresa']); ?>" required></div>
  <div class="form-group"><label>Nombre empresa</label><input name="nomempresa" value="<?php echo htmlspecialchars($c['nomempresa']); ?>" required></div>
  <div class="form-group full"><label>Dirección</label><input name="direcempresa" value="<?php echo htmlspecialchars($c['direcempresa']); ?>" required></div>
  <div class="form-group"><label>Teléfono</label><input name="tlfempresa" value="<?php echo htmlspecialchars($c['tlfempresa']); ?>"></div>
  <div class="form-group"><label>Email</label><input name="correoempresa" value="<?php echo htmlspecialchars($c['correoempresa']); ?>"></div>
  <div class="form-group"><label>Doc. responsable</label><input name="cedresponsable" value="<?php echo htmlspecialchars($c['cedresponsable']); ?>"></div>
  <div class="form-group"><label>Nombre responsable</label><input name="nomresponsable" value="<?php echo htmlspecialchars($c['nomresponsable']); ?>"></div>
  <div class="form-group"><label>Email responsable</label><input name="correoresponsable" value="<?php echo htmlspecialchars($c['correoresponsable']); ?>"></div>
  <div class="form-group"><label>Tel. responsable</label><input name="tlfresponsable" value="<?php echo htmlspecialchars($c['tlfresponsable']); ?>"></div>
  <div class="form-group"><label>IVA compras %</label><input name="ivac" value="<?php echo htmlspecialchars($c['ivac']); ?>"></div>
  <div class="form-group"><label>IVA ventas %</label><input name="ivav" value="<?php echo htmlspecialchars($c['ivav']); ?>"></div>
  <div class="form-group"><label>Símbolo moneda</label><input name="simbolo" maxlength="2" value="<?php echo htmlspecialchars($c['simbolo']); ?>"></div>
  </div>
  <div class="sa-form-actions">
    <button type="submit" class="sa-btn" name="btn-config">Guardar configuración</button>
    <a class="sa-btn secondary" href="restaurantes.php">Volver</a>
  </div>
</form>
<script>
$('#form-cfg').on('submit', function(e){
  e.preventDefault();
  $.post('config_restaurante.php?id_restaurante=<?php echo $id; ?>', $(this).serialize() + '&btn-config=1', function(html){
    $('#sa-msg').html(html);
  });
});
</script>
<?php sa_footer(); ?>
