<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = new mysqli("localhost:3308", "root", "1234", "proof");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $usuario = $_POST['usuario'];

    $stmt = $conexion->prepare("DELETE FROM Usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    $stmt->close();
    $conexion->close();

    // Redirigir con un parámetro indicando éxito
    header("Location: ../Menú/user.php?mensaje=Usuario eliminado correctamente");
    exit();
}
?>
