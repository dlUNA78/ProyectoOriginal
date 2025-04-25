<?php
include '../../config/database.php';
// Comprobamos si se ha enviado el ID del producto a eliminar
if (isset($_POST['producto'])) {
    $productoId = $_POST['producto'];

    // Preparamos la consulta para eliminar el producto
    $sqlEliminar = "DELETE FROM productos WHERE id = ?";

    // Preparamos la sentencia SQL
    if ($stmt = $conn->prepare($sqlEliminar)) {
        // Vinculamos el parámetro
        $stmt->bind_param("i", $productoId);

        // Ejecutamos la consulta
        if ($stmt->execute()) {
            // Si la eliminación es exitosa, redirigimos al listado de productos
            header("Location: ../Menú/products.php?eliminado=exito");
            exit();
        } else {
            // Si hubo un error, redirigimos con mensaje de error
            header("Location: ../Menú/products.php?eliminado=error");
            exit();
        }
    } else {
        // Si no se puede preparar la consulta
        header("Location: ../Menú/products.php?eliminado=error-preparacion");
        exit();
    }
} else {
    // Si no se ha enviado el ID, redirigimos con mensaje de error
    header("Location: ../Menú/products.php?eliminado=falta-id");
    exit();
}
?>
