<!-- conexcion a la base de datos -->
<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "proyecto1";
// Crear conexión
$connn = new mysqli($servidor, $usuario, $contraseña, $base_datos);
// Comprobar conexión
if ($connn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    // echo "Conexión exitosa";
}

?>
