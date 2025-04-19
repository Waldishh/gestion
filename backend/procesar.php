<?php
include('../backend/conexion.php');

// Obtener datos del formulario
$id_cliente = $_POST['id_cliente']; // Cliente que realiza la compra
$productos = $_POST['productos']; // Array de productos con su cantidad
$total_venta = 0; // Total de la venta

// Iniciar transacción para evitar inconsistencias
$conn->begin_transaction();

try {
    // Insertar la venta en la tabla `ventas`
    $sql_venta = "INSERT INTO ventas (id_cliente, fecha_venta, total_venta, metodo_pago, estado_venta) 
                  VALUES ('$id_cliente', NOW(), '$total_venta', 'Efectivo', 'pendiente')";
    if ($conn->query($sql_venta) === TRUE) {
        $id_venta = $conn->insert_id; // Obtener el ID de la venta recién insertada

        // Insertar los detalles de la venta en la tabla `detalle_ventas`
        foreach ($productos as $producto) {
            $id_producto = $producto['id_producto'];
            $cantidad = $producto['cantidad'];

            // Obtener el precio unitario del producto
            $sql_producto = "SELECT precio FROM productos WHERE id_producto = '$id_producto'";
            $result = $conn->query($sql_producto);
            $row = $result->fetch_assoc();
            $precio_unitario = $row['precio'];

            // Calcular el total por producto
            $total_producto = $cantidad * $precio_unitario;
            $total_venta += $total_producto;

            // Insertar el detalle de la venta
            $sql_detalle = "INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, precio_unitario, total) 
                            VALUES ('$id_venta', '$id_producto', '$cantidad', '$precio_unitario', '$total_producto')";
            $conn->query($sql_detalle);
        }

        // Actualizar el total de la venta en la tabla `ventas`
        $sql_update_venta = "UPDATE ventas SET total_venta = '$total_venta' WHERE id_venta = '$id_venta'";
        $conn->query($sql_update_venta);

        // Confirmar la transacción
        $conn->commit();
        echo "Venta registrada correctamente.";
    } else {
        // Si hay un error, revertir la transacción
        $conn->rollback();
        echo "Error al registrar la venta.";
    }
} catch (Exception $e) {
    // Si ocurre un error, revertir la transacción
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$conn->close();
