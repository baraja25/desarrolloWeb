-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-11-2024 a las 15:54:58
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
-- Base de datos: `Prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumnos`
--

CREATE TABLE `Alumnos` (
  `NIF` varchar(9) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `Apellido1` varchar(25) NOT NULL,
  `Apellido2` varchar(25) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Telefono` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Alumnos`
--

INSERT INTO `Alumnos` (`NIF`, `Nombre`, `Apellido1`, `Apellido2`, `Edad`, `Telefono`) VALUES
('24206736F', 'Elena', 'Perez', 'Perezaaa', 22, '624355292'),
('36956961I', 'Carlos', 'Garcia', 'Martinez', 30, '636386928'),
('37345301C', 'Juan', 'Gomez', 'Torres', 30, '644041867'),
('37421135D', 'Jose', 'Diaz', 'Hernandez', 27, '648904488'),
('38172726Q', 'Carlos', 'Torres', 'Perez', 20, '610108124'),
('38613467H', 'Pedro', 'Sanchez', 'Perez', 28, '686933777'),
('51188455M', 'Carlos', 'Perez', 'Gomez', 25, '609697175'),
('55293919H', 'Carlos', 'Sanchez', 'Ramirez', 21, '661262728'),
('57135405Q', 'Ana', 'Lopez', 'Diaz', 20, '663645831'),
('65405610M', 'Laura', 'Gomez', 'Torres', 27, '661929225'),
('65931912U', 'Laura', 'Gomez', 'Perez', 24, '678435884'),
('74573453F', 'Pedro', 'Torres', 'Martinez', 29, '613066059'),
('75397241A', 'Jose', 'Garcia', 'Garcia', 22, '695679424'),
('79430037J', 'Maria', 'Hernandez', 'Gomez', 19, '686071393'),
('80356162O', 'Maria', 'Gomez', 'Torres', 22, '670748886'),
('84226838U', 'Carlos', 'Martinez', 'Diaz', 25, '699904660'),
('90105911A', 'Laura', 'Lopez', 'Lopez', 27, '622170643'),
('97879374F', 'Laura', 'Sanchez', 'Perez', 20, '651080365'),
('99909840G', 'Laura', 'Lopez', 'Torres', 30, '699109111');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Alumnos`
--
ALTER TABLE `Alumnos`
  ADD PRIMARY KEY (`NIF`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
