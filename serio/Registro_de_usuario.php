<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "reciclagem");
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $contraseña);
    $stmt->execute();
    echo "Registro exitoso.";
    $stmt->close();
    $conn->close();
}
?>
<form method="post">
    Nombre: <input type="text" name="nombre" required><br>
    Email: <input type="email" name="email" required><br>
    Contraseña: <input type="password" name="contraseña" required><br>
    <input type="submit" value="Registrarse">
</form>
