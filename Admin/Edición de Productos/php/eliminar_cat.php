<!-- Eliminar registro por ID-->
<?php
//Recibe el id del registro a eliminars
$id = $_POST['id'];
//Conexion a la base de datos
include 'C:\Git\GitHub\ProyectoOriginal\ProyectoWeb-main\ProyectoWeb-main\ProyectoOriginal\config\database.php';
//Elimina el registro de la tabla
$sql = "DELETE FROM categorias WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "Registro eliminado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//Cierra la conexion
$conn->close();

//Redirecciona a la pagina principal
header("Location: ../../categories.php ");  
?>