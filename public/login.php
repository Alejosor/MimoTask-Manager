<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../controllers/UsuarioController.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php'); // Redirige si el usuario ya está autenticado
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Correo inválido.";
    } elseif (empty($password)) {
        $error = "La contraseña no puede estar vacía.";
    } else {
        $controller = new UsuarioController();
        try {
            $controller->login($email, $password);
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/auth-styles.css">
</head>
<body>
    <div class="auth-container">
        <h1>Iniciar Sesión</h1>
        
        <?php if (!empty($error)): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="email">Correo:</label>
            <input type="email" id="email" name="email" placeholder="Escribe tu correo" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Escribe tu contraseña" required>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
        <a href="registro.php">¿No tienes cuenta? Regístrate</a>
    </div>
</body>
</html>