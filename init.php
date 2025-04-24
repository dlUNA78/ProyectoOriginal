<?php
// init.php

// Define la ruta raíz de tu proyecto
define('BASE_PATH', __DIR__);

// Ruta global al archivo de conexión
define('DB_PATH', BASE_PATH . '/config/database.php');

// Puedes incluir directamente la conexión si quieres que siempre esté disponible
require_once DB_PATH;

?>