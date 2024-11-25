<?php
require_once '/config/Database.php';

$db = new Database();
$conn = $db->conectar();

if ($conn) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error en la conexión a la base de datos.";
}
?>