<?php
class Database {
    // Configuración de la base de datos
    private $host = 'localhost';      // Servidor de la base de datos
    private $db_name = 'proyecto_original';  // Nombre de tu base de datos
    private $username = 'root';       // Usuario de MySQL (ajusta según tu configuración)
    private $password = 'guerito32';           // Contraseña de MySQL (ajusta según tu configuración)
    public $conn;

    // Método para conectar a la base de datos
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username,
                $this->password
            );
            // Configurar PDO para que lance excepciones en errores
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Forzar codificación UTF-8
            $this->conn->exec('SET NAMES utf8');
        } catch(PDOException $e) {
            // En producción, deberías registrar este error en un archivo de log
            die('Error de conexión: ' . $e->getMessage());
        }

        return $this->conn;
    }
}
?>