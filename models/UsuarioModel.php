<?php
require_once '../config/config.php';

class UsuarioModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Registrar un nuevo usuario
    public function registrar($datos) {
        $query = "INSERT INTO usuarios (nombre, apellido, email, password, telefono, direccion, rol) 
                  VALUES (:nombre, :apellido, :email, :password, :telefono, :direccion, :rol)";
        
        $stmt = $this->db->prepare($query);
        
        // Hash de la contraseña
        $password_hash = password_hash($datos['password'], PASSWORD_BCRYPT);
        
        // Asignar rol por defecto si no se especifica
        $rol = isset($datos['rol']) ? $datos['rol'] : 'cliente';
        
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':apellido', $datos['apellido']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':telefono', $datos['telefono']);
        $stmt->bindParam(':direccion', $datos['direccion']);
        $stmt->bindParam(':rol', $rol);
        
        return $stmt->execute();
    }

    // Iniciar sesión
    public function login($email, $password) {
        $query = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(password_verify($password, $usuario['password'])) {
                // Configurar datos de sesión
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_email'] = $usuario['email'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_rol'] = $usuario['rol'];
                
                return true;
            }
        }
        
        return false;
    }

    // Obtener información de un usuario
    public function obtenerPorId($id) {
        $query = "SELECT * FROM usuarios WHERE id_usuario = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar información de usuario
    public function actualizar($id, $datos) {
        $query = "UPDATE usuarios SET 
                  nombre = :nombre,
                  apellido = :apellido,
                  telefono = :telefono,
                  direccion = :direccion
                  WHERE id_usuario = :id";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':apellido', $datos['apellido']);
        $stmt->bindParam(':telefono', $datos['telefono']);
        $stmt->bindParam(':direccion', $datos['direccion']);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
}
?>