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

    <!-- Formulario de Filtros -->
    <form method="GET" action="index.php">
        <label for="filtro">Estado:</label>
        <select id="filtro" name="filtro">
            <option value="">Todos</option>
            <option value="Pendiente" <?= isset($_GET['filtro']) && $_GET['filtro'] === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="Completada" <?= isset($_GET['filtro']) && $_GET['filtro'] === 'Completada' ? 'selected' : '' ?>>Completada</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <!-- Enlaces para Ordenar -->
    <a href="index.php?orden=nombre&direccion=ASC">Ordenar por Nombre (A-Z)</a>
    <a href="index.php?orden=nombre&direccion=DESC">Ordenar por Nombre (Z-A)</a>
    <a href="index.php?orden=fecha_creacion&direccion=ASC">Ordenar por Fecha (Antiguas)</a>
    <a href="index.php?orden=fecha_creacion&direccion=DESC">Ordenar por Fecha (Recientes)</a>

    <!-- Lista de Tareas -->
    <ul>
        <?php foreach ($tareas as $tarea): ?>
            <li>
                <?= htmlspecialchars($tarea['nombre']) ?> - <?= htmlspecialchars($tarea['estado']) ?> - <?= htmlspecialchars($tarea['fecha_creacion']) ?>
                <a href="editar_tarea.php?id=<?= $tarea['id'] ?>">Editar</a>
                <a href="eliminar_tarea.php?id=<?= $tarea['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">Eliminar</a>

                <?php if ($tarea['estado'] === 'Pendiente'): ?>
                    <a href="completar_tarea.php?id=<?= $tarea['id'] ?>">Completar</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="agregar_tarea.php">Nueva Tarea</a>
</body>
</html>