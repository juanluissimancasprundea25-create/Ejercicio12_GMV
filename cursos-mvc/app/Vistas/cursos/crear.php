<?php
// app/Vistas/cursos/crear.php
$antiguos = $antiguos ?? ['nombre' => '', 'horas' => ''];
?>
<h2>Registrar Nuevo Curso</h2>
<form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>?accion=guardar">
  <div class="form-group">
    <label for="nombre">Nombre del curso *</label>
    <input 
      type="text" 
      id="nombre" 
      name="nombre" 
      value="<?= htmlspecialchars($antiguos['nombre']) ?>" 
      required 
      autofocus>
  </div>
  
  <div class="form-group">
    <label for="horas">Horas académicas *</label>
    <input 
      type="text" 
      id="horas" 
      name="horas" 
      value="<?= htmlspecialchars($antiguos['horas']) ?>" 
      required
      pattern="[0-9]+">
    <small style="color: #64748b; display: block; margin-top: 4px">Mínimo 1 hora, máximo 1000 horas</small>
  </div>
  
  <button type="submit">Guardar Curso</button>
  <a href="<?= $_SERVER['PHP_SELF'] ?>?accion=listar" style="display: inline-block; margin-top: 15px; color: #64748b; text-decoration: underline">← Volver al listado</a>
</form>