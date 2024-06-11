<?php

// Parámetros de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registar";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibe los datos del formulario
$nombre_producto = $_POST["nombre_producto"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];
$id_categoria = $_POST["id_categoria"];
$descuento = $_POST["descuento"]; // Nueva columna
$descripcion = $_POST["descripcion"]; // Nueva columna

// Calcular impuesto (8%)
$impuesto_porcentaje = 0.08; // 8%
$impuesto = $precio * $impuesto_porcentaje;

// Convertir el descuento a un valor decimal (porcentaje)
$descuento_porcentaje = $descuento / 100;
$descuento_valor = $precio * $descuento_porcentaje;

// Calcular el precio final
$precio_final = $precio + $impuesto - $descuento_valor;

// Subir imagen del producto
$target_dir = "uploads/"; // Directorio donde se almacenarán las imágenes
$target_file = $target_dir . basename($_FILES["imagen_producto"]["name"]);
move_uploaded_file($_FILES["imagen_producto"]["tmp_name"], $target_file);
$imagen_producto = $target_file;

// Query para insertar el producto en la base de datos
$sql = "INSERT INTO productos (nombre_producto, precio, impuesto, stock, id_categoria, descuento, descripcion, imagen_producto)
        VALUES ('$nombre_producto', $precio_final, $impuesto, $stock, $id_categoria, $descuento_valor, '$descripcion', '$imagen_producto')";

if ($conn->query($sql) === TRUE) {
    echo "Producto registrado correctamente";
} else {
    echo "Error al registrar el producto: " . $conn->error;
}
