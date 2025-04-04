<?php
include 'C:\Git\GitHub\ProyectoOriginal\ProyectoWeb-main\ProyectoWeb-main\ProyectoOriginal\config\database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    

    // Actualizar el registro
    $sql = "UPDATE categorias SET nombre = '$nombre'  WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado correctamente.";
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }

    $conn->close();
    header("Location: ../../categories.php "); // Redirige de vuelta a la página principal
    exit();
}
?>