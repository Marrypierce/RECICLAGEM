<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    $conn = new mysqli("localhost", "root", "","reciclagem");
    $stmt = $conn->prepare("SELECT id, contraseña_hash FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $contraseña_hash);
    $stmt->fetch();

    if (password_verify($contraseña, $contraseña_hash)) {
        $_SESSION['usuario_id'] = $id;
        echo "Login exitoso.";
    } else {
        echo "Credenciales incorrectas.";
    }
    $stmt->close();
    $conn->close();
}
?>
<form method="post">
    Email: <input type="email" name="email" required><br>
    Contraseña: <input type="password" name="contraseña" required><br>
    <input type="submit" value="Iniciar sesión">
</form>