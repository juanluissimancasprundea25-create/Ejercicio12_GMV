<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Cursos</title>
  <style>
    :root { --primary: #2563eb; --success: #10b981; --error-bg: #fef2f2; --error-border: #fecaca; }
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; max-width: 1000px; margin: 0 auto; padding: 20px; }
    .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #eee; padding-bottom: 15px; }
    .menu { background: #f8fafc; padding: 12px; border-radius: 8px; margin: 20px 0; text-align: center; }
    .menu a { display: inline-block; margin: 0 10px; text-decoration: none; color: var(--primary); font-weight: 500; padding: 8px 15px; border-radius: 6px; transition: all 0.3s; }
    .menu a:hover { background: #eff6ff; }
    .menu a.active { background: var(--primary); color: white; }
    .alert { padding: 12px 15px; border-radius: 6px; margin: 15px 0; font-weight: 500; }
    .alert-error { background-color: var(--error-bg); border-left: 4px solid var(--error-border); color: #b91c1c; }
    .alert-success { background-color: #ecfdf5; border-left: 4px solid #10b981; color: #065f46; }
    table { width: 100%; border-collapse: collapse; margin: 20px 0; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e2e8f0; }
    th { background-color: #f1f5f9; font-weight: 600; }
    tr:hover { background-color: #f8fafc; }
    .form-group { margin-bottom: 15px; }
    label { display: block; margin-bottom: 5px; font-weight: 500; }
    input[type="text"] { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 16px; }
    input[type="text"]:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2); }
    button { background: var(--primary); color: white; border: none; padding: 12px 24px; font-size: 16px; border-radius: 6px; cursor: pointer; transition: background 0.3s; }
    button:hover { background: #1d4ed8; }
    .card { background: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 25px; margin-top: 10px; }
    .empty-state { text-align: center; padding: 30px; color: #64748b; }
    footer { text-align: center; margin-top: 30px; color: #64748b; font-size: 0.9em; border-top: 1px solid #eee; padding-top: 15px; }
  </style>
</head>
<body>
  <div class="header">
    <h1>Registro de Cursos (MVC + PDO)</h1>
    <p>Sistema de gestión académica - Solo Crear y Listar</p>
  </div>

  <div class="menu">
    <a href="<?= $_SERVER['PHP_SELF'] ?>?accion=listar" <?= ($accion ?? 'listar') === 'listar' ? 'class="active"' : '' ?>>Listar cursos</a>
    <a href="<?= $_SERVER['PHP_SELF'] ?>?accion=crear" <?= ($accion ?? '') === 'crear' ? 'class="active"' : '' ?>>Nuevo curso</a>
  </div>

  <?php if (isset($error) && $error): ?>
    <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  
  <?php if (isset($_GET['exito']) && $_GET['exito'] == 1): ?>
    <div class="alert alert-success">Curso creado exitosamente</div>
  <?php endif; ?>

  <div class="card">
    <?php require $vistaContenido; ?>
  </div>
</body>
</html>