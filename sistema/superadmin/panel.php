<?php
require_once('_bootstrap.php');
$tra = sa_gate();

$dash = $tra->DashboardSuperAdmin();
$ticketMes = ((int) $dash['ordenes_mes'] > 0)
	? ((float) $dash['ventas_mes'] / (int) $dash['ordenes_mes'])
	: 0;
$inactivos = max(0, (int) $dash['total_restaurantes'] - (int) $dash['activos']);
sa_header('Inicio', sa_saludo() . ' · ' . sa_fecha_larga());
?>
<div class="sa-toolbar">
  <a class="sa-btn" href="forrestaurante.php"><?php echo sa_icon('plus'); ?> Nuevo restaurante</a>
  <a class="sa-btn secondary" href="restaurantes.php">Ver restaurantes</a>
  <a class="sa-btn secondary" href="ventas.php">Ventas globales</a>
</div>

<div class="sa-kpis">
  <div class="sa-kpi">
    <div class="sa-kpi-top">
      <div class="label">Ventas de hoy</div>
      <span class="sa-kpi-ico amber"><?php echo sa_icon('coin'); ?></span>
    </div>
    <div class="value"><?php echo sa_money($dash['ventas_hoy']); ?></div>
    <div class="foot"><?php echo (int) $dash['ordenes_hoy']; ?> órdenes pagadas</div>
  </div>
  <div class="sa-kpi">
    <div class="sa-kpi-top">
      <div class="label">Ventas del mes</div>
      <span class="sa-kpi-ico green"><?php echo sa_icon('chart'); ?></span>
    </div>
    <div class="value"><?php echo sa_money($dash['ventas_mes']); ?></div>
    <div class="foot"><?php echo (int) $dash['ordenes_mes']; ?> órdenes · ticket <?php echo sa_money($ticketMes); ?></div>
  </div>
  <div class="sa-kpi">
    <div class="sa-kpi-top">
      <div class="label">Restaurantes</div>
      <span class="sa-kpi-ico rose"><?php echo sa_icon('store'); ?></span>
    </div>
    <div class="value"><?php echo (int) $dash['activos']; ?><span class="sa-muted" style="font-size:1rem;font-family:var(--sa-font);font-weight:600"> / <?php echo (int) $dash['total_restaurantes']; ?></span></div>
    <div class="foot"><?php echo $inactivos === 0 ? 'Todos activos' : $inactivos . ' inactivos'; ?></div>
  </div>
  <div class="sa-kpi">
    <div class="sa-kpi-top">
      <div class="label">Usuarios</div>
      <span class="sa-kpi-ico blue"><?php echo sa_icon('users'); ?></span>
    </div>
    <div class="value"><?php echo (int) $dash['usuarios']; ?></div>
    <div class="foot">Personal de todos los locales</div>
  </div>
</div>

<div class="sa-section-head">
  <div>
    <h2>Por restaurante</h2>
    <p>Actividad del mes y accesos rápidos</p>
  </div>
  <a class="sa-btn secondary" href="forrestaurante.php">Añadir</a>
</div>

<?php if (empty($dash['por_restaurante'])) {
  sa_empty('Aún no hay restaurantes', 'Crea el primero para publicar su menú y abrir el POS.', 'forrestaurante.php', 'Crear restaurante');
} else { ?>
<div class="sa-rest-grid">
<?php foreach ($dash['por_restaurante'] as $r) {
  $ord = (int) $r['ordenes_mes'];
  $prom = $ord > 0 ? ((float) $r['ventas_mes'] / $ord) : 0;
  $id = (int) $r['id_restaurante'];
  $hero = !empty($r['color_acento']) ? $r['color_acento'] : '#9b2c2c';
?>
  <article class="sa-rest-card" data-sa-row="<?php echo htmlspecialchars($r['nombre']); ?>">
    <div class="sa-rest-card-hero" style="background: <?php echo htmlspecialchars($hero); ?>;">
      <?php echo sa_logo_html(isset($r['logo']) ? $r['logo'] : '', $r['nombre'], 'sa-logo-lg'); ?>
      <span class="sa-badge <?php echo $r['status'] === 'ACTIVO' ? 'ok' : 'off'; ?>"><?php echo htmlspecialchars($r['status']); ?></span>
    </div>
    <div class="sa-rest-card-body">
      <h3><?php echo htmlspecialchars($r['nombre']); ?></h3>
      <div class="sa-rest-stats">
        <div><span>Hoy</span><b><?php echo sa_money($r['ventas_hoy']); ?></b></div>
        <div><span>Mes</span><b><?php echo sa_money($r['ventas_mes']); ?></b></div>
        <div><span>Ticket</span><b><?php echo sa_money($prom); ?></b></div>
      </div>
      <div class="sa-rest-meta"><?php echo (int) $r['usuarios']; ?> usuarios · <?php echo $ord; ?> órdenes este mes</div>
      <div class="sa-rest-card-actions">
        <a href="forrestaurante.php?id_restaurante=<?php echo base64_encode($id); ?>">Editar</a>
        <a href="config_restaurante.php?id_restaurante=<?php echo $id; ?>">Config POS</a>
        <a href="ventas.php?id_restaurante=<?php echo $id; ?>">Ventas</a>
        <a href="usuarios.php?id_restaurante=<?php echo $id; ?>">Usuarios</a>
      </div>
    </div>
  </article>
<?php } ?>
</div>
<?php } ?>
<?php sa_footer(); ?>
