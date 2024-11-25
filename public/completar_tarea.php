<?php
require_once __DIR__ . '/../controllers/TareaController.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new TareaController();
    $controller->completar($id);
} else {
    echo "Solicitud no válida.";
}
?>