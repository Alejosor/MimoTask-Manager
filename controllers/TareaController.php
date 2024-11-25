<?php
require_once __DIR__ . '/../models/Tarea.php';

class TareaController {
    private $tareaModel;

    public function __construct() {
        $db = new Database();
        $conn = $db->conectar();
        $this->tareaModel = new Tarea($conn);
    }

    public function index() {
        $tareas = $this->tareaModel->obtenerTareas();
        require __DIR__ . '/../views/tareas/index.php';
    }

    public function agregar($nombre, $descripcion) {
        $this->tareaModel->agregarTarea($nombre, $descripcion);
        header('Location: /public/index.php');
    }
}
?>