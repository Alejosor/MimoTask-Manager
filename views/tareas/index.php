<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Lista de Tareas</title>
</head>
<body>
    <h1>Lista de Tareas</h1>
    <a href="agregar_tarea.php">Nueva Tarea</a>
    <ul>
        <?php foreach ($tareas as $tarea): ?>
            <li>
                <?= htmlspecialchars($tarea['nombre']) ?> - <?= htmlspecialchars($tarea['estado']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>