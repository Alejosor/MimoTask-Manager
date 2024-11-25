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
        $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
        $orden = isset($_GET['orden']) ? $_GET['orden'] : 'fecha_creacion';
        $direccion = isset($_GET['direccion']) ? $_GET['direccion'] : 'DESC';

        $tareas = $this->tareaModel->obtenerTareasFiltradas($filtro, $orden, $direccion);
        require __DIR__ . '/../views/tareas/index.php';
    }

    public function agregar($nombre, $descripcion) {
        if ($this->tareaModel->agregarTarea($nombre, $descripcion)) {
            header('Location: /MimoTask-Manager/public/index.php'); // Cambia esto según tu entorno
            exit;
        } else {
            echo "Error al agregar la tarea.";
        }
    }

    public function mostrarFormularioEdicion($id) {
        $tarea = $this->tareaModel->obtenerTareaPorId($id);
        require __DIR__ . '/../views/tareas/editar.php';
    }
    
    public function editar($id, $nombre, $descripcion) {
        if ($this->tareaModel->editarTarea($id, $nombre, $descripcion)) {
            header('Location: /MimoTask-Manager/public/index.php'); // Ruta absoluta correcta
            exit;
        } else {
            echo "Error al editar la tarea.";
        }
    }

    public function eliminar($id) {
        if ($this->tareaModel->eliminarTarea($id)) {
            header('Location: /MimoTask-Manager/public/index.php'); // Redirige al listado de tareas
            exit;
        } else {
            echo "Error al eliminar la tarea.";
        }
    }

    public function completar($id) {
        if ($this->tareaModel->marcarComoCompletada($id)) {
            header('Location: /MimoTask-Manager/public/index.php'); // Redirige al listado
            exit;
        } else {
            echo "Error al marcar la tarea como completada.";
        }
    }    
}
?>