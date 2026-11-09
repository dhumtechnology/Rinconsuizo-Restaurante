<?php
require_once('_bootstrap.php');
$tra = sa_gate();
$id = isset($_GET['id_restaurante']) ? (int) $_GET['id_restaurante'] : 0;
$ventas = $tra->ListarVentasPorRestaurante($id > 0 ? $id : null);
$rests = $tra->ListarRestaurantes();
$nombreRest = '';
if ($id > 0) {
	foreach ($rests as $r) {
		if ((int) $r['id_restaurante'] === $id) {
			$nombreRest = $r['nombre'];
			break;
		}
	}
}
$titulo = $nombreRest !== '' ? 'Ventas · ' . $nombreRest : 'Ventas globales';
sa_header($titulo, 'Últimas 200 órdenes pagadas o registradas en la plataforma');

$total = 0;
$totalPagado = 0;
$pagadas = 0;
foreach ($ventas as $v) {
	$monto = (float) $v['totalpago'];
	$total += $monto;
	if (isset($v['statusventa']) && strtoupper($v['statusventa']) === 'PAGADA') {
		$pagadas++;
		$totalPagado += $monto;
	}
}
function sa_status_badge($st)
{
	$u = strtoupper(trim((string) $st));
	$class = 'neutral';
	if ($u === 'PAGADA') {
		$class = 'ok';
	} elseif ($u === 'PENDIENTE') {
		$class = 'off';
	} elseif ($u === 'ANULADA' || $u === 'CANCELADA') {
		$class = 'off';
	}
	return '<span class="sa-badge ' . $class . '">' . htmlspecialchars($st) . '</span>';
}
?>
<form class="sa-filters sa-filters--dense" method="get" action="ventas.php" id="filtros-ventas">
  <div class="sa-filter-field">
    <label for="filtro-restaurante">Restaurante</label>
    <select name="id_restaurante" id="filtro-restaurante">
      <option value="0">Todos</option>
      <?php foreach ($rests as $r) {
        $rid = (int) $r['id_restaurante'];
        $sel = ($id === $rid) ? ' selected' : '';
        echo '<option value="' . $rid . '"' . $sel . '>' . htmlspecialchars($r['nombre']) . '</option>';
      } ?>
    </select>
  </div>
  <div class="sa-filter-actions">
    <button type="submit" class="sa-btn">Ver ventas</button>
    <?php if ($id > 0) { ?>
      <a class="sa-btn secondary" href="ventas.php">Quitar filtro</a>
    <?php } ?>
  </div>
  <?php sa_search('Buscar código, restaurante o tipo'); ?>
</form>

<?php if (!empty($ventas)) { ?>
<div class="sa-totals sa-totals--compact">
  <div>Órdenes: <b><?php echo count($ventas); ?></b></div>
  <div>Pagadas: <b><?php echo $pagadas; ?></b></div>
  <div>Importe pagado: <b><?php echo sa_money($totalPagado); ?></b></div>
  <div>Importe listado: <b><?php echo sa_money($total); ?></b></div>
</div>
<?php } ?>

<?php if (empty($ventas)) {
  sa_empty('Sin ventas registradas', $id > 0 ? 'Este restaurante aún no tiene órdenes en el listado.' : 'Cuando haya ventas en los locales, aparecerán aquí.');
} else { ?>
<div class="sa-table-wrap sa-table-wrap--data">
<table class="sa-table sa-table--data">
<thead><tr><th>Fecha</th><th>Código</th><th>Restaurante</th><th>Tipo</th><th>Estado</th><th>Total</th></tr></thead>
<tbody>
<?php foreach ($ventas as $v) {
  $hay = $v['codventa'] . ' ' . $v['restaurante'] . ' ' . $v['tipopagove'] . ' ' . $v['statusventa'];
?>
<tr data-sa-row="<?php echo htmlspecialchars($hay); ?>">
  <td><?php echo sa_fecha($v['fechaventa']); ?></td>
  <td><code class="sa-pass"><?php echo htmlspecialchars($v['codventa']); ?></code></td>
  <td><?php echo htmlspecialchars($v['restaurante']); ?></td>
  <td><?php echo htmlspecialchars($v['tipopagove']); ?></td>
  <td><?php echo sa_status_badge($v['statusventa']); ?></td>
  <td><strong><?php echo sa_money($v['totalpago']); ?></strong></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<?php } ?>
<script>
$('#filtro-restaurante').on('change', function () {
  $('#filtros-ventas').submit();
});
</script>
<?php sa_footer(); ?>
