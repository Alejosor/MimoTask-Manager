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
}
?>