-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS `proyecto1`;
USE `proyecto1`;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    imagen VARCHAR(255) NOT NULL
);

-- Tabla de categorías
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Tabla de productos
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    id_categoria INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)
);

-- Tabla de imágenes por producto (para múltiples imágenes por producto)
CREATE TABLE IF NOT EXISTS imagenes_producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
    ruta_imagen VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_producto) REFERENCES productos(id) ON DELETE CASCADE
);

-- Tabla de ofertas (referencia a un producto)
--CREATE TABLE IF NOT EXISTS ofertas (
--    id INT AUTO_INCREMENT PRIMARY KEY,
--   id_producto INT NOT NULL,
--   precio_oferta DECIMAL(10, 2) NOT NULL,
--    descripcion TEXT,
--    FOREIGN KEY (id_producto) REFERENCES productos(id) ON DELETE CASCADE
--);

CREATE TABLE `ofertas` (
  `id_oferta` int NOT NULL,
  `Nombre_oferta` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `precio` int NOT NULL,
  `precio_oferta` decimal(10,2) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `Fecha_inicio` date NOT NULL,
  `Fecha_expirada` date NOT NULL,
  `id_producto` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabla de imágenes para ofertas (si son distintas a las del producto)
CREATE TABLE IF NOT EXISTS imagenes_oferta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_oferta INT NOT NULL,
    ruta_imagen VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_oferta) REFERENCES ofertas(id) ON DELETE CASCADE
);

ESTE ES UN SQL PARA LA BASE DE DATOS, SIENTO QUE AUN FALTAN CAMBIOS, CHEQUEN BIEN, AUN NO HAGAN CAMBIOS GRANDDES