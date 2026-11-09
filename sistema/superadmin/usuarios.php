<?php
require_once('_bootstrap.php');
$tra = sa_gate();

$idRest = isset($_GET['id_restaurante']) ? (int) $_GET['id_restaurante'] : 0;
$cargo = isset($_GET['cargo']) ? trim((string) $_GET['cargo']) : '';

$lista = $tra->ListarUsuariosPlataforma($idRest > 0 ? $idRest : null, $cargo !== '' ? $cargo : null);
$restaurantes = $tra->ListarRestaurantes();
$cargos = $tra->ListarCargosUsuariosPlataforma();

sa_header('Usuarios', 'Personal de cada restaurante. Las claves se muestran solo al revelarlas.');
?>
<div class="sa-toolbar">
  <a class="sa-btn" href="forusuario.php<?php echo $idRest > 0 ? '?id_restaurante=' . $idRest : ''; ?>"><?php echo sa_icon('plus'); ?> Crear administrador</a>
  <?php sa_search('Buscar por nombre, usuario o restaurante'); ?>
</div>

<form class="sa-filters sa-filters--dense" method="get" action="usuarios.php" id="filtros-usuarios">
  <div class="sa-filter-field">
    <label for="filtro-restaurante">Restaurante</label>
    <select name="id_restaurante" id="filtro-restaurante">
      <option value="0">Todos</option>
      <?php foreach ($restaurantes as $r) {
        $rid = (int) $r['id_restaurante'];
        $sel = ($idRest === $rid) ? ' selected' : '';
        echo '<option value="' . $rid . '"' . $sel . '>' . htmlspecialchars($r['nombre']) . '</option>';
      } ?>
    </select>
  </div>
  <div class="sa-filter-field">
    <label for="filtro-cargo">Cargo o nivel</label>
    <select name="cargo" id="filtro-cargo">
      <option value="">Todos</option>
      <?php foreach ($cargos as $c) {
        $sel = ($cargo === $c) ? ' selected' : '';
        echo '<option value="' . htmlspecialchars($c) . '"' . $sel . '>' . htmlspecialchars($c) . '</option>';
      } ?>
    </select>
  </div>
  <div class="sa-filter-actions">
    <button type="submit" class="sa-btn">Filtrar</button>
    <?php if ($idRest > 0 || $cargo !== '') { ?>
      <a class="sa-btn secondary" href="usuarios.php">Limpiar</a>
    <?php } ?>
  </div>
</form>

<?php if (empty($lista)) {
  sa_empty('Nadie coincide con esos filtros', 'Prueba otro restaurante o cargo, o crea un administrador.', 'forusuario.php', 'Crear administrador');
} else { ?>
<div class="sa-table-wrap sa-table-wrap--data">
<table class="sa-table sa-table--data">
<thead>
  <tr>
    <th>Persona</th>
    <th>Usuario</th>
    <th>Contraseña</th>
    <th>Cargo</th>
    <th>Nivel</th>
    <th>Restaurante</th>
    <th>Estado</th>
  </tr>
</thead>
<tbody>
<?php foreach ($lista as $u) {
  $plain = isset($u['password_plain']) ? trim((string) $u['password_plain']) : '';
  $hay = $u['nombres'] . ' ' . $u['usuario'] . ' ' . (isset($u['restaurante_nombre']) ? $u['restaurante_nombre'] : '') . ' ' . $u['nivel'];
?>
<tr data-sa-row="<?php echo htmlspecialchars($hay); ?>">
  <td>
    <div class="sa-name-cell">
      <span class="sa-initials"><?php echo sa_initials($u['nombres']); ?></span>
      <div>
        <strong><?php echo htmlspecialchars($u['nombres']); ?></strong>
        <small>#<?php echo (int) $u['codigo']; ?></small>
      </div>
    </div>
  </td>
  <td><?php echo htmlspecialchars($u['usuario']); ?></td>
  <td><?php
    if ($plain !== '') {
      echo '<span class="sa-secret" data-secret="' . htmlspecialchars($plain) . '" data-shown="0">';
      echo '<code class="sa-pass">••••••••</code>';
      echo '<button type="button" class="sa-icon-btn" data-sa-reveal title="Mostrar">' . sa_icon('eye') . '</button>';
      echo '<button type="button" class="sa-icon-btn" data-sa-copy="' . htmlspecialchars($plain) . '" title="Copiar">' . sa_icon('copy') . '</button>';
      echo '</span>';
    } else {
      echo '<span class="sa-muted" title="Se mostrará al crear o cambiar la clave">Sin clave en claro</span>';
    }
  ?></td>
  <td><?php echo htmlspecialchars(isset($u['cargo']) && $u['cargo'] !== '' ? $u['cargo'] : '—'); ?></td>
  <td><span class="sa-badge info"><?php echo htmlspecialchars($u['nivel']); ?></span></td>
  <td><?php
    if (!empty($u['id_restaurante'])) {
      echo '<a href="usuarios.php?id_restaurante=' . (int) $u['id_restaurante'] . '">' . htmlspecialchars(isset($u['restaurante_nombre']) ? $u['restaurante_nombre'] : '—') . '</a>';
    } else {
      echo '—';
    }
  ?></td>
  <td><span class="sa-badge <?php echo $u['status'] === 'ACTIVO' ? 'ok' : 'off'; ?>"><?php echo htmlspecialchars($u['status']); ?></span></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<?php } ?>
<script>
$('#filtro-restaurante, #filtro-cargo').on('change', function () {
  $('#filtros-usuarios').submit();
});
</script>
<?php sa_footer(); ?>
