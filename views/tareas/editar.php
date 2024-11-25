<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/styles.css">
    <title>Editar Tarea</title>
</head>
<body>
    <h1>Editar Tarea</h1>
    <form method="POST" action="editar_tarea.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($tarea['id']) ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($tarea['nombre']) ?>" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?= htmlspecialchars($tarea['descripcion']) ?></textarea>
        <br>
        <button type="submit">Guardar Cambios</button>
    </form>
    <a href="index.php">Volver al listado</a>
</body>
</html>