<?php
include '..\..\config\database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_oferta'])) {
    $id_oferta = intval($_POST['id_oferta']);

    // Preparar la consulta para eliminar la oferta
    $stmt = $conn->prepare("DELETE FROM ofertas WHERE id_oferta = ?");
    $stmt->bind_param("i", $id_oferta);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Oferta eliminada correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar la oferta."]);
    }

    $stmt->close();
    $conn->close();
    exit;

    header("Location: C:\Git\GitHub\ProyectoOriginal\ProyectoWeb-main\ProyectoWeb-main\ProyectoOriginal\Admin\Ofertas\view_ofer_produc.php");
    exit;
}
?>