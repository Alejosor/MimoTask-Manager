<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redirige al login si no está autenticado
    exit;
}

$usuarioNombre = $_SESSION['usuario_nombre'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index-styles.css">
    <title>Lista de Tareas</title>
</head>
<body>
    <header>
        <div class="user-info">
            <span>Bienvenido, <?= htmlspecialchars($usuarioNombre) ?></span>
            <a href="logout.php" class="logout-button">Cerrar Sesión</a>
        </div>
    </header>

    <h1>TaskFlow Manager</h1>
    <div class="container">
        <!-- Formulario de Filtros -->
        <form method="GET" action="index.php" class="filtros">
            <label for="filtro">Estado:</label>
            <select id="filtro" name="filtro">
                <option value="">Todos</option>
                <option value="Pendiente" <?= isset($_GET['filtro']) && $_GET['filtro'] === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="Completada" <?= isset($_GET['filtro']) && $_GET['filtro'] === 'Completada' ? 'selected' : '' ?>>Completada</option>
            </select>
            <button type="submit" class="filtrar">Filtrar</button>
        </form>

        <!-- Tareas Pendientes -->
        <div class="tareas-pendientes">
            <h2>Tareas Pendientes</h2>
            <ul>
                <?php foreach ($tareas as $tarea): ?>
                    <?php if ($tarea['estado'] === 'Pendiente'): ?>
                        <li class="pendiente">
                            <?= htmlspecialchars($tarea['nombre']) ?>
                            <div>
                                <a class="editar" href="editar_tarea.php?id=<?= $tarea['id'] ?>">Editar</a>
                                <a class="eliminar" href="eliminar_tarea.php?id=<?= $tarea['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">Eliminar</a>
                                <a class="completar" href="completar_tarea.php?id=<?= $tarea['id'] ?>">Completar</a>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Tareas Completadas -->
        <div class="tareas-completadas">
            <h2>Tareas Completadas</h2>
            <ul>
                <?php foreach ($tareas as $tarea): ?>
                    <?php if ($tarea['estado'] === 'Completada'): ?>
                        <li class="completada">
                            <?= htmlspecialchars($tarea['nombre']) ?>
                            <div>
                                <a class="editar" href="editar_tarea.php?id=<?= $tarea['id'] ?>">Editar</a>
                                <a class="eliminar" href="eliminar_tarea.php?id=<?= $tarea['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">Eliminar</a>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <a class="completar" href="agregar_tarea.php">Nueva Tarea</a>
    </div>
</body>
</html>