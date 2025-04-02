Create if no exists database `proyecto1`;
-- Use the database
USE `proyecto1`;

Create table if no exists `usuarios` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);

Create table if no exists `productos` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) NOT NULL,
    `descripcion` TEXT NOT NULL,
    `precio` DECIMAL(10, 2) NOT NULL,
    `imagenes` TEXT NOT NULL,
    PRIMARY KEY (`id`)
);

Create  table if no exists `categorias` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`)
);

Create table  if no exists ofertas (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) NOT NULL,
    `descripcion` TEXT NOT NULL,
    `precioNormal` DECIMAL(10, 2) NOT NULL,
    `precioOferta` DECIMAL(10, 2) NOT NULL,
    `imagenes` TEXT NOT NULL,
    PRIMARY KEY (`id`)
);

ESTE ES UN SQL PARA LA BASE DE DATOS, SIENTO QUE AUN FALTAN CAMBIOS, CHEQUEN BIEN, AUN NO HAGAN CAMBIOS GRANDDES