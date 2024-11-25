<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $db = new Database();
        $conn = $db->conectar();
        $this->usuarioModel = new Usuario($conn);
    }

    public function registrar($nombre, $email, $password) {
        // Hash de la contraseña
        $passwordHasheada = password_hash($password, PASSWORD_DEFAULT);

        if ($this->usuarioModel->registrarUsuario($nombre, $email, $passwordHasheada)) {
            header('Location: login.php');
            exit;
        } else {
            echo "Error al registrar el usuario.";
        }
    }

    public function login($email, $password) {
        $usuario = $this->usuarioModel->obtenerUsuarioPorEmail($email);

        if ($usuario && password_verify($password, $usuario['password'])) {
            // Iniciar sesión
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header('Location: index.php');
            exit;
        } else {
            echo "Credenciales inválidas.";
        }
    }
}
?>