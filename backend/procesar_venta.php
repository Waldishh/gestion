<?php
// conexion.php (Conexión a la base de datos)
include 'conexion.php';

// Procesar la venta cuando se envíen los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $tipoSalteña = $_POST['tipo-salteña'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $total = $_POST['total'];
    $fechaHora = date('Y-m-d H:i:s');  // Fecha y hora actuales
    $estadoVenta = 'Pendiente';  // Estado inicial

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO ventas (tipo_salteña, cantidad, precio_unitario, total, fecha_hora, estado_venta)
            VALUES ('$tipoSalteña', '$cantidad', '$precio', '$total', '$fechaHora', '$estadoVenta')";

    // Ejecutar la consulta
    if (mysqli_query($conn, $sql)) {
        echo "Venta registrada correctamente.";
    } else {
        echo "Error al registrar la venta: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
