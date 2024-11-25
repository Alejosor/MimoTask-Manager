<?php
require_once __DIR__ . '/../config/Database.php';

class Usuario {
    private $conn;
    private $table = 'usuarios';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarUsuario($nombre, $email, $password) {
        $query = "INSERT INTO {$this->table} (nombre, email, password) VALUES (:nombre, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Asegúrate de enviar una contraseña hasheada
        return $stmt->execute();
    }

    public function obtenerUsuarioPorEmail($email) {
        $query = "SELECT * FROM {$this->table} WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>