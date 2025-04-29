<?php
include '..\..\config\database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_oferta'])) {
    $id_oferta = intval($_POST['id_oferta']);

    // Preparar la consulta para eliminar la oferta
    $stmt = $conn->prepare("DELETE FROM ofertas WHERE id_oferta = ?");
    $stmt->bind_param("i", $id_oferta);

    if ($stmt->execute()) {
        header("Location: ../Ofertas/view_ofer_produc.php?success=1");
    } else {
        header("Location: ../Ofertas/view_ofer_produc.php?error=1");
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>