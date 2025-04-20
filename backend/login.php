<?php
session_start();

// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificamos si llegaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombre"]) && isset($_POST["clave"])) {
        $nombre = trim($_POST["nombre"]);
        $clave = trim($_POST["clave"]);

        echo "Nombre recibido: $nombre<br>";
        echo "Contraseña recibida: $clave<br>";

        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "sistemas_de_gestion_de_ventas");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Buscar el usuario en la base de datos
        $sql = "SELECT clave FROM clientes WHERE nombre = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $fila = $resultado->fetch_assoc();
            $clave_hash = $fila["clave"];

            // Verificar la contraseña ingresada contra el hash
            if (password_verify($clave, $clave_hash)) {
                $_SESSION["usuario"] = $nombre;
                echo "✅ Inicio de sesión exitoso. Redirigiendo...";
                header("Location: ../frontend/panel.html"); // Ajusta la ruta si es necesario
                exit;
            } else {
                echo "⚠️ Usuario o contraseña incorrectos.";
            }
        } else {
            echo "⚠️ Usuario o contraseña incorrectos.";
        }

        $stmt->close();
        $conexion->close();
    } else {
        echo "❌ Faltan campos en el formulario.";
    }
}
?>