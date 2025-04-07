<?php
$servername = "localhost:3308";
$username = "root";
$password = "1234"; //tu contraseña de la base de datos
$dbname = "proyecto1";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Conexion Fallida: " . $conn->connect_error);
}   
echo "";
?>