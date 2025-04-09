<?php
// Configuración de la conexión PDO
include '..\..\config\database.php';

if (isset($_POST['query'])) {
    $busqueda = $_POST['query'];
    $stmt = $conn->prepare("SELECT id, nombre, precio FROM productos WHERE nombre LIKE ?");
    $like = "%$busqueda%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    $datos = [];
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }

    echo json_encode($datos);
}
