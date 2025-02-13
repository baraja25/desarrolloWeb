-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-12-2022 a las 17:06:09
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Concesionario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coches`
--

CREATE TABLE `coches` (
  `Id` int(11) NOT NULL,
  `Marca` int(11) NOT NULL,
  `Modelo` varchar(50) NOT NULL,
  `Matricula` varchar(7) NOT NULL,
  `FechaMatri` int(11) NOT NULL,
  `Precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotoscoche`
--

CREATE TABLE `fotoscoche` (
  `IdCoche` int(11) NOT NULL,
  `Foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcascoches`
--

CREATE TABLE `marcascoches` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marcascoches`
--

INSERT INTO `marcascoches` (`Id`, `Nombre`, `Logo`) VALUES
(1, 'BMW', 'bmw.png'),
(2, 'Aston Martin', 'astonmartin.jpeg'),
(3, 'Cupra', '2560px-Cupra.svg.png'),
(4, 'Tesla', 'tesla.png'),
(5, 'Seat', 'seat.jpg'),
(6, 'Volkswagen', 'volkswagen.jpg'),
(7, 'Renault', 'Renault.jpg'),
(8, 'Kia ', 'kia.jpg'),
(9, 'Toyota', '580b57fcd9996e24bc43c4a3.png'),
(10, 'Opel', '580b57fcd9996e24bc43c49c.png'),
(11, 'El Suanfonson', 'sddefault.jpg'),
(12, 'Pagani', 'pagani.jpg'),
(13, 'Mazda', '580b57fcd9996e24bc43c491.png'),
(14, 'Lexus', '580b57fcd9996e24bc43c48b.png'),
(15, 'Mercedes', 'mercedes.png'),
(16, 'Ford', 'Ford-Motor-Company-Logo.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `coches`
--
ALTER TABLE `coches`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `fotoscoche`
--
ALTER TABLE `fotoscoche`
  ADD PRIMARY KEY (`IdCoche`,`Foto`);

--
-- Indices de la tabla `marcascoches`
--
ALTER TABLE `marcascoches`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `coches`
--
ALTER TABLE `coches`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcascoches`
--
ALTER TABLE `marcascoches`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
