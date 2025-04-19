<?php
$servername = "localhost"; // o el servidor que estés usando
$username = "root"; // tu usuario de MySQL
$password = ""; // tu contraseña de MySQL
$dbname = "sistemas_de_gestion_de_ventas"; // nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

