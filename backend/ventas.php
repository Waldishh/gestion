<?php
header('Content-Type: application/json');

// Simulación de base de datos de productos
$productos = [
    ["id_producto" => 1, "nombre_producto" => "Salteña de carne", "precio" => 5.00],
    ["id_producto" => 2, "nombre_producto" => "Salteña de pollo", "precio" => 4.50],
    ["id_producto" => 3, "nombre_producto" => "Salteña de queso", "precio" => 6.00],
];

// Devolver como JSON
echo json_encode($productos);
