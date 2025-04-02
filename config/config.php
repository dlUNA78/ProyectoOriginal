<?php
// Configuración básica de la aplicación
define('APP_NAME', 'Proyecto Original');
define('APP_ROOT', dirname(dirname(__FILE__)));
define('APP_URL', 'http://localhost/ProyectoOriginal'); // Ajusta esta URL

// Configuración para mostrar errores (solo en desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el archivo de conexión a la base de datos
require_once './database.php';

// Crear instancia de la base de datos
$database = new Database();
$db = $database->connect();

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Funciones útiles (opcional)
function redirect($url) {
    header("Location: $url");
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['usuario_id']);
}

function isAdmin() {
    return isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin';
}
?>