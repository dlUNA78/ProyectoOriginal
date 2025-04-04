<?php
//Recibe datos del formulario //SE REEEMPLAZA CON EL NOMBRE DE LOS CAMPOS DEL FORMULARIO
include 'C:\Git\GitHub\ProyectoOriginal\ProyectoWeb-main\ProyectoWeb-main\ProyectoOriginal\config\database.php';
$nombre = $_POST['nombre'];
//Conexion a la base de datos

//Inserta los datos en la tabla
//SE CAMBIARAN LOS DATOS TAL COMO SE ENCUENTREN EN LA BASE DE DATOS
$sql = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
if ($conn->query($sql) === TRUE) {
    echo "Datos insertados correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//Cierra la conexion
$conn->close();

header("Location: ../../categories.php "); 
?>