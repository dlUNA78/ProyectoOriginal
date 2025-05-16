-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 16-05-2025 a las 13:00:09
-- Versión del servidor: 8.0.41
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(4, 'panes'),
(7, 'sadads');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_producto`
--

DROP TABLE IF EXISTS `imagenes_producto`;
CREATE TABLE IF NOT EXISTS `imagenes_producto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `ruta_imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `imagenes_producto`
--

INSERT INTO `imagenes_producto` (`id`, `id_producto`, `ruta_imagen`) VALUES
(93, 62, 'assets/img/productos/6815778321d4a_ar58.jpg'),
(94, 62, 'assets/img/productos/68157783237f1_rukia.jpg'),
(95, 62, 'assets/img/productos/68157783250a9_furina.jpg'),
(96, 62, 'assets/img/productos/681577832649d_7bd993d06458b14ec81cdad80bac6ba4.webp'),
(97, 62, 'assets/img/productos/68157783276d7_shikanoko.jpg'),
(98, 62, 'assets/img/productos/68157783286f2_hatsunemiku2.jpg'),
(99, 62, 'assets/img/productos/6815778329a9f_hatsunemiku1.jpg'),
(100, 62, 'assets/img/productos/681577832ab96_triangulomorado.jpg'),
(101, 62, 'assets/img/productos/681577832c2fa_cuadrado rojo.jpg'),
(102, 62, 'assets/img/productos/681577832d346_7d93f1ae75b930d75f40316bc3afdc59 (1) (1)_batcheditor_fotor (1).png'),
(103, 62, 'assets/img/productos/681577832e7a3_7d93f1ae75b930d75f40316bc3afdc59 (1) (1)_batcheditor_fotor.png'),
(104, 63, 'assets/img/productos/68268483eac05_Linux-server-vs.-Windows-Server.jpg'),
(105, 63, 'assets/img/productos/68269da2aceb8_pan.webp'),
(106, 63, 'assets/img/productos/6826b4c129dce_2.sm.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
CREATE TABLE IF NOT EXISTS `ofertas` (
  `id_oferta` int NOT NULL AUTO_INCREMENT,
  `Nombre_oferta` varchar(100) NOT NULL,
  `precio` int NOT NULL,
  `precio_oferta` decimal(10,2) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `Fecha_inicio` date NOT NULL,
  `Fecha_expirada` date NOT NULL,
  `id_producto` int NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id_oferta`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id_oferta`, `Nombre_oferta`, `precio`, `precio_oferta`, `imagen`, `Fecha_inicio`, `Fecha_expirada`, `id_producto`, `descripcion`) VALUES
(1, 'pan', 123, 111.00, 'Admin/assets/img/ofertas/oferta_68269fec74450.jpg', '2025-05-15', '2025-05-17', 62, 'pandeolla123'),
(3, 'pan', 123, 122.00, '/Admin/assets/img/ofertas/hanekawa-tsubasa.gif', '2025-05-15', '2025-06-06', 62, 'pandeolla123'),
(4, 'pan', 123, 121.00, '/Admin/assets/img/ofertas/hanekawa-tsubasa.gif', '2025-05-15', '2025-06-06', 62, 'pandeolla123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_categoria` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `id_categoria`) VALUES
(62, 'pan', 'pandeolla123', 123.00, 4),
(63, 'dsda', 'sadadsawdsasd', 213123.00, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `contraseña`, `imagen`) VALUES
(11, 'Eduardo', 'eduardo1@gmail.com', '$2y$10$s2qvOP6OEAW/jtNA0SNCDees2iQSMSxFICnvmQRseqykN1lb4TyIm', '6813adacd638e.png'),
(12, 'asdasdqqqqq', 'admin123', '$2y$10$dssc7qs6qcQxXgggMbeFjuI1qiXo2/tYR7QtZG1WrqfEdIZYCy1vS', '6814224212501.png');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  ADD CONSTRAINT `imagenes_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
