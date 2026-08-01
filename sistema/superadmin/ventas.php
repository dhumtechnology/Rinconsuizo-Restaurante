<?php
require_once('_bootstrap.php');
$tra = sa_gate();
$id = isset($_GET['id_restaurante']) ? (int)$_GET['id_restaurante'] : 0;
$ventas = $tra->ListarVentasPorRestaurante($id > 0 ? $id : null);
$titulo = $id > 0 ? 'Ventas · restaurante #'.$id : 'Ventas globales';
sa_header($titulo);
?>
<div class="sa-toolbar">
  <a class="sa-btn secondary" href="ventas.php">Todas</a>
  <?php
  $rests = $tra->ListarRestaurantes();
  foreach ($rests as $r) {
    $cls = $id === (int)$r['id_restaurante'] ? 'sa-btn' : 'sa-btn secondary';
    echo ' <a class="'.$cls.'" href="ventas.php?id_restaurante='.(int)$r['id_restaurante'].'">'.htmlspecialchars($r['nombre']).'</a>';
  }
  ?>
</div>
<div class="sa-table-wrap">
<table class="sa-table">
<thead><tr><th>Fecha</th><th>Código</th><th>Restaurante</th><th>Tipo</th><th>Estado</th><th>Total</th></tr></thead>
<tbody>
<?php
if (empty($ventas)) {
  echo '<tr><td colspan="6">Sin ventas registradas</td></tr>';
} else {
  foreach ($ventas as $v) {
?>
<tr>
  <td><?php echo htmlspecialchars($v['fechaventa']); ?></td>
  <td><?php echo htmlspecialchars($v['codventa']); ?></td>
  <td><?php echo htmlspecialchars($v['restaurante']); ?></td>
  <td><?php echo htmlspecialchars($v['tipopagove']); ?></td>
  <td><?php echo htmlspecialchars($v['statusventa']); ?></td>
  <td>S/ <?php echo number_format($v['totalpago'], 2); ?></td>
</tr>
<?php } } ?>
</tbody>
</table>
</div>
<?php sa_footer(); ?>
