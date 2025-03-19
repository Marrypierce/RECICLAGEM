<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "reciclagem");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Crear la tabla 'usuarios' si no existe
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    email VARCHAR(50) UNIQUE,
    contraseña_hash VARCHAR(255)
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabla 'usuarios' creada correctamente o ya existente.<br>";
} else {
    echo "Error al crear la tabla 'usuarios': " . $conn->error . "<br>";
}

// Crear la tabla 'cartas'
$sql = "CREATE TABLE IF NOT EXISTS cartas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    tipo VARCHAR(50),
    rareza VARCHAR(50),
    precio DECIMAL(5,2),
    stock INT
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabla 'cartas' creada correctamente o ya existente.<br>";
} else {
    echo "Error al crear la tabla 'cartas': " . $conn->error . "<br>";
}

// Crear la tabla 'carrito'
$sql = "CREATE TABLE IF NOT EXISTS carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    carta_id INT,
    cantidad INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (carta_id) REFERENCES cartas(id) ON DELETE CASCADE
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabla 'carrito' creada correctamente o ya existente.<br>";
} else {
    echo "Error al crear la tabla 'carrito': " . $conn->error . "<br>";
}

// Crear la tabla 'ventas'
$sql = "CREATE TABLE IF NOT EXISTS ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabla 'ventas' creada correctamente o ya existente.<br>";
} else {
    echo "Error al crear la tabla 'ventas': " . $conn->error . "<br>";
}

// Cerrar la conexión
$conn->close();
?>
