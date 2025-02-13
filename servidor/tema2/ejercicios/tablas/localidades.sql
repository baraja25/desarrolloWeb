-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2020 a las 13:16:36
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servidor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `IdLoc` int(11) NOT NULL,
  `IdPais` int(11) NOT NULL,
  `IdProvincia` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`IdLoc`, `IdPais`, `IdProvincia`, `Nombre`) VALUES
(1, 1, 1, 'Madrid'),
(1, 1, 2, 'Barcelona'),
(1, 1, 3, 'Valencia'),
(1, 2, 1, 'Paris'),
(1, 2, 2, 'Lyon'),
(1, 2, 3, 'tolouse'),
(2, 1, 1, 'Mostoles'),
(2, 1, 2, 'Badalona'),
(2, 1, 3, 'Alcira'),
(2, 2, 1, 'Paris Oeste'),
(2, 2, 2, 'Lyon Este'),
(2, 2, 3, 'tolouse Este');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`IdLoc`,`IdPais`,`IdProvincia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
