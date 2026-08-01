<?php
require_once('_bootstrap.php');
$tra = sa_gate();

if (isset($_POST['btn-restaurante'])) {
	$tra->RegistrarRestaurante();
	exit;
}
if (isset($_POST['btn-actualizar'])) {
	$tra->ActualizarRestaurante();
	exit;
}
if (isset($_POST['btn-admin'])) {
	$tra->RegistrarAdminRestaurante();
	exit;
}
if (isset($_POST['btn-config'])) {
	$tra->ActualizarConfiguracionRestaurante();
	exit;
}

$dash = $tra->DashboardSuperAdmin();
sa_header('Dashboard');
?>
<div class="sa-toolbar">
  <a class="sa-btn" href="forrestaurante.php">+ Nuevo restaurante</a>
  <a class="sa-btn secondary" href="restaurantes.php">Ver todos</a>
  <a class="sa-btn secondary" href="ventas.php">Ventas</a>
</div>

<p class="sa-section-title">Resumen</p>
<div class="sa-cards">
  <div class="sa-card"><div class="label">Restaurantes</div><div class="value"><?php echo (int)$dash['total_restaurantes']; ?></div></div>
  <div class="sa-card accent-ok"><div class="label">Activos</div><div class="value"><?php echo (int)$dash['activos']; ?></div></div>
  <div class="sa-card"><div class="label">Usuarios</div><div class="value"><?php echo (int)$dash['usuarios']; ?></div></div>
  <div class="sa-card accent-warn"><div class="label">Ventas hoy</div><div class="value">S/ <?php echo number_format($dash['ventas_hoy'], 2); ?></div></div>
  <div class="sa-card"><div class="label">Órdenes hoy</div><div class="value"><?php echo (int)$dash['ordenes_hoy']; ?></div></div>
  <div class="sa-card"><div class="label">Ventas mes</div><div class="value">S/ <?php echo number_format($dash['ventas_mes'], 2); ?></div></div>
  <div class="sa-card"><div class="label">Órdenes mes</div><div class="value"><?php echo (int)$dash['ordenes_mes']; ?></div></div>
</div>

<p class="sa-section-title">Por restaurante</p>
<div class="sa-table-wrap">
<table class="sa-table">
<thead>
<tr>
  <th>ID</th><th>Nombre</th><th>Estado</th><th>Usuarios</th>
  <th>Ventas hoy</th><th>Ventas mes</th><th>Órdenes mes</th><th>Ticket prom.</th><th></th>
</tr>
</thead>
<tbody>
<?php foreach ($dash['por_restaurante'] as $r) {
  $ord = (int)$r['ordenes_mes'];
  $prom = $ord > 0 ? ((float)$r['ventas_mes'] / $ord) : 0;
?>
<tr>
  <td><?php echo (int)$r['id_restaurante']; ?></td>
  <td>
    <?php if (!empty($r['logo'])) { ?><img class="sa-logo-preview" src="<?php echo htmlspecialchars(function_exists('restaurant_logo_url') ? restaurant_logo_url($r['logo']) : '../'.$r['logo']); ?>" alt=""> <?php } ?>
    <?php echo htmlspecialchars($r['nombre']); ?>
  </td>
  <td><span class="sa-badge <?php echo $r['status']==='ACTIVO'?'ok':'off'; ?>"><?php echo htmlspecialchars($r['status']); ?></span></td>
  <td><?php echo (int)$r['usuarios']; ?></td>
  <td>S/ <?php echo number_format($r['ventas_hoy'], 2); ?></td>
  <td>S/ <?php echo number_format($r['ventas_mes'], 2); ?></td>
  <td><?php echo $ord; ?></td>
  <td>S/ <?php echo number_format($prom, 2); ?></td>
  <td class="sa-actions">
    <a href="forrestaurante.php?id_restaurante=<?php echo base64_encode($r['id_restaurante']); ?>">Editar</a>
    <a href="config_restaurante.php?id_restaurante=<?php echo (int)$r['id_restaurante']; ?>">Config</a>
    <a href="ventas.php?id_restaurante=<?php echo (int)$r['id_restaurante']; ?>">Ventas</a>
  </td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<?php sa_footer(); ?>
