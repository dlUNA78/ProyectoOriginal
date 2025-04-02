<?php
require_once '../config/config.php';

class ProductoModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Obtener todos los productos activos
    public function obtenerTodos() {
        $query = "SELECT p.*, c.nombre as categoria_nombre 
                  FROM productos p
                  JOIN categorias c ON p.id_categoria = c.id_categoria
                  WHERE p.activo = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un producto por ID
    public function obtenerPorId($id) {
        $query = "SELECT p.*, c.nombre as categoria_nombre 
                  FROM productos p
                  JOIN categorias c ON p.id_categoria = c.id_categoria
                  WHERE p.id_producto = :id AND p.activo = 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo producto
    public function crear($datos) {
        $query = "INSERT INTO productos 
                  (id_categoria, nombre, descripcion, precio, stock, imagen) 
                  VALUES 
                  (:id_categoria, :nombre, :descripcion, :precio, :stock, :imagen)";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':id_categoria', $datos['id_categoria']);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':precio', $datos['precio']);
        $stmt->bindParam(':stock', $datos['stock']);
        $stmt->bindParam(':imagen', $datos['imagen']);
        
        return $stmt->execute();
    }

    // Actualizar un producto
    public function actualizar($id, $datos) {
        $query = "UPDATE productos SET 
                  id_categoria = :id_categoria,
                  nombre = :nombre,
                  descripcion = :descripcion,
                  precio = :precio,
                  stock = :stock,
                  imagen = :imagen
                  WHERE id_producto = :id";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':id_categoria', $datos['id_categoria']);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':precio', $datos['precio']);
        $stmt->bindParam(':stock', $datos['stock']);
        $stmt->bindParam(':imagen', $datos['imagen']);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    // "Eliminar" un producto (marcar como inactivo)
    public function eliminar($id) {
        $query = "UPDATE productos SET activo = 0 WHERE id_producto = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
}
?>