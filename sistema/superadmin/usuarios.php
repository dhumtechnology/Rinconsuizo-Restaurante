<?php
require_once('_bootstrap.php');
$tra = sa_gate();

$idRest = isset($_GET['id_restaurante']) ? (int) $_GET['id_restaurante'] : 0;
$cargo = isset($_GET['cargo']) ? trim((string) $_GET['cargo']) : '';

$lista = $tra->ListarUsuariosPlataforma($idRest > 0 ? $idRest : null, $cargo !== '' ? $cargo : null);
$restaurantes = $tra->ListarRestaurantes();
$cargos = $tra->ListarCargosUsuariosPlataforma();

sa_header('Usuarios de restaurantes');
?>
<div class="sa-toolbar">
  <a class="sa-btn" href="forusuario.php">+ Crear administrador</a>
</div>

<form class="sa-filters" method="get" action="usuarios.php">
  <div class="sa-filter-field">
    <label for="filtro-restaurante">Restaurante</label>
    <select name="id_restaurante" id="filtro-restaurante">
      <option value="0">Todos</option>
      <?php foreach ($restaurantes as $r) {
        $rid = (int) $r['id_restaurante'];
        $sel = ($idRest === $rid) ? ' selected' : '';
        echo '<option value="'.$rid.'"'.$sel.'>'.htmlspecialchars($r['nombre']).'</option>';
      } ?>
    </select>
  </div>
  <div class="sa-filter-field">
    <label for="filtro-cargo">Cargo</label>
    <select name="cargo" id="filtro-cargo">
      <option value="">Todos</option>
      <?php foreach ($cargos as $c) {
        $sel = ($cargo === $c) ? ' selected' : '';
        echo '<option value="'.htmlspecialchars($c).'"'.$sel.'>'.htmlspecialchars($c).'</option>';
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

<div class="sa-table-wrap">
<table class="sa-table">
<thead>
  <tr>
    <th>Código</th>
    <th>Nombre</th>
    <th>Usuario</th>
    <th>Cargo</th>
    <th>Nivel</th>
    <th>Restaurante</th>
    <th>Estado</th>
  </tr>
</thead>
<tbody>
<?php
if (empty($lista)) {
  echo '<tr><td colspan="7">No hay usuarios con esos filtros.</td></tr>';
} else {
  for ($i = 0; $i < count($lista); $i++) {
    $u = $lista[$i];
?>
<tr>
  <td><?php echo (int)$u['codigo']; ?></td>
  <td><?php echo htmlspecialchars($u['nombres']); ?></td>
  <td><?php echo htmlspecialchars($u['usuario']); ?></td>
  <td><?php echo htmlspecialchars(isset($u['cargo']) && $u['cargo'] !== '' ? $u['cargo'] : '—'); ?></td>
  <td><?php echo htmlspecialchars($u['nivel']); ?></td>
  <td><?php echo htmlspecialchars(isset($u['restaurante_nombre']) ? $u['restaurante_nombre'] : '—'); ?></td>
  <td><span class="sa-badge <?php echo $u['status']==='ACTIVO'?'ok':'off'; ?>"><?php echo htmlspecialchars($u['status']); ?></span></td>
</tr>
<?php
  }
}
?>
</tbody>
</table>
</div>
<?php sa_footer(); ?>
