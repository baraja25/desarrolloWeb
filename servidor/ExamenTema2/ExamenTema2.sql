-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-11-2024 a las 19:30:18
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
-- Base de datos: `ExamenTema2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categoria`
--

CREATE TABLE `Categoria` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Categoria`
--

INSERT INTO `Categoria` (`Id`, `Nombre`) VALUES
(1, 'Electrónica'),
(2, 'Hogar'),
(3, 'Smartphone'),
(4, 'Novedades'),
(5, 'Juguetes'),
(6, 'Computadoras'),
(7, 'Accesorios'),
(8, 'Ropa'),
(9, 'Deportes'),
(10, 'Belleza'),
(11, 'Electrodomésticos'),
(12, 'Cuidado Personal'),
(13, 'Gaming'),
(14, 'Automotriz'),
(15, 'Libros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Marcas`
--

CREATE TABLE `Marcas` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Marcas`
--

INSERT INTO `Marcas` (`Id`, `Nombre`) VALUES
(1, 'Samsung'),
(2, 'Apple'),
(3, 'Sony'),
(4, 'Microsoft'),
(5, 'Nike'),
(6, 'Adidas'),
(7, 'LG'),
(8, 'HP'),
(9, 'Philips'),
(10, 'Panasonic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProdCatego`
--

CREATE TABLE `ProdCatego` (
  `IdPro` int(11) NOT NULL,
  `IdCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ProdCatego`
--

INSERT INTO `ProdCatego` (`IdPro`, `IdCat`) VALUES
(1, 1),
(1, 3),
(2, 2),
(2, 4),
(3, 5),
(4, 6),
(5, 7),
(5, 8),
(6, 9),
(7, 10),
(8, 1),
(8, 5),
(9, 2),
(10, 3),
(11, 1),
(11, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Producto`
--

CREATE TABLE `Producto` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `Marca` int(11) NOT NULL,
  `Modelo` varchar(25) NOT NULL,
  `Precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Producto`
--

INSERT INTO `Producto` (`Id`, `Nombre`, `Marca`, `Modelo`, `Precio`) VALUES
(1, 'Galaxy S23', 1, 'S23', 800),
(2, 'iPhone 14', 2, '14 Pro', 1200),
(3, 'PlayStation 5', 3, 'PS5', 500),
(4, 'Xbox Series X', 4, 'X', 550),
(5, 'Air Max 90', 5, '90', 150),
(6, 'Ultraboost', 6, '22', 180),
(7, 'OLED TV', 7, 'CX', 1200),
(8, 'Pavilion', 8, '15', 700),
(9, 'Hue Bulb', 9, 'A19', 25),
(10, 'Lumix Camera', 10, 'G95', 800),
(11, 'Iphone', 2, '20', 2000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `ProdCatego`
--
ALTER TABLE `ProdCatego`
  ADD PRIMARY KEY (`IdPro`,`IdCat`);

--
-- Indices de la tabla `Producto`
--
ALTER TABLE `Producto`
  ADD PRIMARY KEY (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
