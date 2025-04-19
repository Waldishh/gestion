<?php
session_start();

// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si la sesión de usuario está activa
if (!isset($_SESSION['usuario'])) {
    echo "La sesión no está iniciada. Por favor, inicie sesión.";
    exit; // Salir si no hay sesión activa
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nuevo_usuario']) && isset($_POST['nueva_clave'])) {
        // Obtener los datos del formulario
        $nuevo_usuario = $_POST['nuevo_usuario'];
        $nueva_clave = $_POST['nueva_clave'];

        // Mostrar los datos para depuración
        echo "Nuevo Usuario: " . $nuevo_usuario . "<br>";
        echo "Nueva Contraseña: " . $nueva_clave . "<br>";

        // Aquí puedes encriptar la contraseña antes de actualizarla
        $nueva_clave_encriptada = hash('sha256', $nueva_clave);

        // Conectar a la base de datos
        $conexion = new mysqli("localhost", "root", "", "sistemas_de_gestion_de_ventas");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Suponiendo que el usuario está guardado en la sesión como 'usuario'
        $usuario_actual = $_SESSION['usuario'];

        // Actualizar el usuario y la contraseña en la base de datos
        $sql = "UPDATE clientes SET nombre = ?, clave = ? WHERE nombre = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sss", $nuevo_usuario, $nueva_clave_encriptada, $usuario_actual);

        if ($stmt->execute()) {
            echo "Datos actualizados correctamente.";
            $_SESSION['usuario'] = $nuevo_usuario; // Actualiza el nombre de usuario en la sesión
        } else {
            echo "Error al actualizar los datos.";
        }

        $stmt->close();
        $conexion->close();
    } else {
        echo "Datos incompletos en el formulario.";
    }
}
