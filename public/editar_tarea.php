<?php
require_once __DIR__ . '/../controllers/TareaController.php';

$controller = new TareaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar la edición de la tarea
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $controller->editar($id, $nombre, $descripcion);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Mostrar el formulario de edición
    $id = $_GET['id'];
    $controller->mostrarFormularioEdicion($id);
}
?>