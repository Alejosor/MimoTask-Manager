<?php
require_once '../controllers/UsuarioController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $controller = new UsuarioController();
    $controller->registrar($nombre, $email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/auth-styles.css">
</head>
<body>
    <div class="auth-container">
        <h1>Registro</h1>
        <form method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre" required>
            
            <label for="email">Correo:</label>
            <input type="email" id="email" name="email" placeholder="Escribe tu correo" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Escribe tu contraseña" required>
            
            <button type="submit">Registrar</button>
        </form>
        <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
</body>
</html>