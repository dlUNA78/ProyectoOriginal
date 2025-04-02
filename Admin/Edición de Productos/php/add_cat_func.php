<?php
//Recibe datos del formulario //SE REEEMPLAZA CON EL NOMBRE DE LOS CAMPOS DEL FORMULARIO
$nombre = $_POST['Nombre'];
$apellidos = $_POST['Apellidos'];
//Conexion a la base de datos
include("./config/database.php");
//Inserta los datos en la tabla
//SE CAMBIARAN LOS DATOS TAL COMO SE ENCUENTREN EN LA BASE DE DATOS
$sql = "INSERT INTO categorias (nombre, apellidos) VALUES ('$nombre', '$apellidos')";
if ($conn->query($sql) === TRUE) {
    echo "Datos insertados correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//Cierra la conexion
$conn->close();

header("Location: index.php");
?>