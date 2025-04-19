<?php
session_start(); // Iniciar sesión antes de cualquier salida

$conexion = new mysqli("localhost", "root", "", "sistemas_de_gestion_de_ventas");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verifica si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'], $_POST['clave'])) {

    // Imprimir los datos para depuración
    echo "Nombre recibido: " . $_POST['nombre'] . "<br>";
    echo "Contraseña recibida: " . $_POST['clave'] . "<br>";

    $nombre = $_POST['nombre'];
    $clave = hash('sha256', $_POST['clave']); // Cifra la contraseña

    $sql = "SELECT * FROM clientes WHERE nombre = ? AND clave = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $nombre, $clave);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica si el usuario y la contraseña coinciden
    if ($resultado->num_rows === 1) {
        $_SESSION['usuario'] = $nombre; // Guarda en sesión el nombre de usuario
        header("Location: ../frontend/panel.html");
        exit();
    } else {
        echo "⚠️ Usuario o contraseña incorrectos."; // Si no se encuentra
    }

    $stmt->close();
} else {
    echo "⛔ Datos incompletos en el formulario.";
}

$conexion->close();
