<?php
              include '..\..\config\database.php';
              session_start();

    // Tomar el valor del campo 'usuario' del formulario
    $usuario = $_POST['usuario'];

    //realizar la consulta para eliminar el usuario
    $stmt = $conn->prepare("DELETE FROM Usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    //cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();

    // Redirigir con un parámetro indicando éxito
    header("Location: ../Menú/user.php?mensaje=Usuario eliminado correctamente");
    exit();

?>
