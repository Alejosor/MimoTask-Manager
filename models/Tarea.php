<?php
require_once __DIR__ . '/../config/Database.php';

class Tarea {
    private $conn;
    private $table = 'tareas';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTareas() {
        $query = "SELECT * FROM {$this->table} ORDER BY fecha_creacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarTarea($nombre, $descripcion) {
        $query = "INSERT INTO {$this->table} (nombre, descripcion) VALUES (:nombre, :descripcion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }    

    public function editarTarea($id, $nombre, $descripcion) {
        $query = "UPDATE {$this->table} SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public function obtenerTareaPorId($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }    

    public function eliminarTarea($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }    

    public function obtenerTareasFiltradas($filtro = '', $orden = 'fecha_creacion', $direccion = 'DESC') {
        $query = "SELECT * FROM {$this->table}";
    
        // Filtros dinámicos
        if (!empty($filtro)) {
            $query .= " WHERE estado = :filtro";
        }
    
        // Orden dinámico
        $query .= " ORDER BY $orden $direccion";
    
        $stmt = $this->conn->prepare($query);
    
        if (!empty($filtro)) {
            $stmt->bindParam(':filtro', $filtro);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function marcarComoCompletada($id) {
        $query = "UPDATE {$this->table} SET estado = 'Completada' WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }    
}
?>