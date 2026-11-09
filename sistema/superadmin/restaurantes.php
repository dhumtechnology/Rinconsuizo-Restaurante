<?php
require_once('_bootstrap.php');
$tra = sa_gate();
$lista = $tra->ListarRestaurantes();
sa_header('Restaurantes', 'Locales de la plataforma, menú público y acceso al POS');
?>
<div class="sa-toolbar">
  <a class="sa-btn" href="forrestaurante.php"><?php echo sa_icon('plus'); ?> Nuevo restaurante</a>
  <?php sa_search('Buscar por nombre, slug o dominio'); ?>
</div>

<?php if (empty($lista)) {
  sa_empty('Aún no hay restaurantes', 'Crea el primero para publicar su menú y abrir el POS.', 'forrestaurante.php', 'Crear restaurante');
} else { ?>
<div class="sa-rest-grid">
<?php foreach ($lista as $r) {
  $slug = $r['slug'];
  $id = (int) $r['id_restaurante'];
  $menuUrl = function_exists('app_url') ? app_url('/' . $slug . '/') : '/' . $slug . '/';
  $posUrl = function_exists('app_url') ? app_url('/' . $slug . '/sistema/') : '/' . $slug . '/sistema/';
  $hero = !empty($r['color_primario']) ? $r['color_primario'] : '#9b2c2c';
  $hay = $r['nombre'] . ' ' . $slug . ' ' . (isset($r['dominio']) ? $r['dominio'] : '');
?>
  <article class="sa-rest-card" data-sa-row="<?php echo htmlspecialchars($hay); ?>">
    <div class="sa-rest-card-hero" style="background: <?php echo htmlspecialchars($hero); ?>;">
      <?php echo sa_logo_html(isset($r['logo']) ? $r['logo'] : '', $r['nombre'], 'sa-logo-lg'); ?>
      <span class="sa-badge <?php echo $r['status'] === 'ACTIVO' ? 'ok' : 'off'; ?>"><?php echo htmlspecialchars($r['status']); ?></span>
    </div>
    <div class="sa-rest-card-body">
      <h3><?php echo htmlspecialchars($r['nombre']); ?></h3>
      <p class="slug">/<?php echo htmlspecialchars($slug); ?>/</p>
      <div class="sa-url-stack">
        <a href="<?php echo htmlspecialchars($menuUrl); ?>" target="_blank" rel="noopener" title="<?php echo htmlspecialchars($menuUrl); ?>">Abrir menú público</a>
        <span class="sa-url-path" title="<?php echo htmlspecialchars($menuUrl); ?>"><?php echo htmlspecialchars($menuUrl); ?></span>
        <a class="dim" href="<?php echo htmlspecialchars($posUrl); ?>" target="_blank" rel="noopener" title="<?php echo htmlspecialchars($posUrl); ?>">Abrir acceso POS</a>
        <span class="sa-url-path dim" title="<?php echo htmlspecialchars($posUrl); ?>"><?php echo htmlspecialchars($posUrl); ?></span>
      </div>
      <?php if (!empty($r['dominio'])) { ?>
        <div class="sa-rest-meta">Dominio: <?php echo htmlspecialchars($r['dominio']); ?></div>
      <?php } ?>
      <span class="sa-swatches" title="<?php echo htmlspecialchars($r['color_primario'] . ' / ' . $r['color_secundario'] . ' / ' . $r['color_acento']); ?>">
        <span style="background:<?php echo htmlspecialchars($r['color_primario']); ?>"></span>
        <span style="background:<?php echo htmlspecialchars($r['color_secundario']); ?>"></span>
        <span style="background:<?php echo htmlspecialchars($r['color_acento']); ?>"></span>
      </span>
      <div class="sa-rest-card-actions">
        <a href="forrestaurante.php?id_restaurante=<?php echo base64_encode($id); ?>">Editar</a>
        <a href="config_restaurante.php?id_restaurante=<?php echo $id; ?>">Config POS</a>
        <a href="forusuario.php?id_restaurante=<?php echo $id; ?>">Crear admin</a>
        <a href="usuarios.php?id_restaurante=<?php echo $id; ?>">Usuarios</a>
        <a href="ventas.php?id_restaurante=<?php echo $id; ?>">Ventas</a>
      </div>
    </div>
  </article>
<?php } ?>
</div>
<?php } ?>
<?php sa_footer(); ?>
