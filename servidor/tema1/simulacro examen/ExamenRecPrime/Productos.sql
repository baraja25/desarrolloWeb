-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-01-2025 a las 18:12:16
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Tema2Blobs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos`
--

CREATE TABLE `Productos` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Marca` int(11) NOT NULL,
  `Modelo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`Id`, `Nombre`, `Precio`, `Marca`, `Modelo`) VALUES
(7, 'Twingo', 2000, 5, '1.6'),
(9, 'Vario', 3000, 10, '20.3'),
(10, 'Xiaomi', 250, 17, 'Poco X3 Pro'),
(12, 'Nothing Phone 1', 349, 22, 'nothing1phone'),
(13, 'Nothing Phone 2', 550, 22, 'nothing2phone'),
(14, 'Telefono Basico', 38, 24, '2057D'),
(15, 'Nokia', 50, 19, '3330'),
(16, 'Nvidia GeForce RTX™ 4090 ', 2500, 20, 'GeForce RTX 4090 '),
(17, 'Nokia', 40, 19, 'N70'),
(18, 'Lenovo', 1100, 23, 'Legion 5'),
(21, 'RTX 3060', 300, 20, 'GeForce'),
(22, 'Ordenador Portátil', 600, 23, 'Ideapad Gaming 3'),
(23, 'RTX 4090', 750, 20, 'GeForce'),
(24, 'Alcatel B1', 2000, 24, 'B1'),
(25, 'Alcatel SMART', 3000, 24, 'T10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Productos`
--
ALTER TABLE `Productos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
