<?php
// app/Vistas/cursos/listar.php
?>
<h2>Listado de Cursos</h2>
<?php if (empty($cursos)): ?>
  <div class="empty-state">
    <div style="font-size: 48px; margin-bottom: 15px"></div>
    <p>No hay cursos registrados. <a href="<?= $_SERVER['PHP_SELF'] ?>?accion=crear" style="color: #2563eb; text-decoration: underline">¡Crea tu primer curso!</a></p>
  </div>
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>Fecha de Creación</th>
        <th>Nombre del Curso</th>
        <th>Horas</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cursos as $c): ?>
        <tr>
          <td><?= htmlspecialchars($c->fechaCreacion) ?></td>
          <td><?= htmlspecialchars($c->nombre) ?></td>
          <td><?= htmlspecialchars($c->horas) ?> horas</td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>