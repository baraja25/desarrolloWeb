-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2024 a las 17:55:58
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tema2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `NIF` varchar(9) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `Apellido1` varchar(25) NOT NULL,
  `Apellido2` varchar(25) NOT NULL,
  `edad` int(11) NOT NULL,
  `telefono` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`NIF`, `Nombre`, `Apellido1`, `Apellido2`, `edad`, `telefono`) VALUES
('11111111A', 'Luisa', 'Vera', 'Moreno', 0, '987654321'),
('12345678A', 'Juan', 'Perez', 'Lopez', 0, ''),
('20266156G', 'Luis', 'Gomez', 'Hernandez', 30, '683323952'),
('24206736F', 'Elena', 'Perez', 'Perez', 22, '624355292'),
('33333333C', 'Maria', 'Lopez', 'Ruiz', 0, '444444444'),
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
('77788899z', 'jose', 'Marino', 'ruiz', 0, '111222333'),
('79430037J', 'Maria', 'Hernandez', 'Gomez', 19, '686071393'),
('80356162O', 'Maria', 'Gomez', 'Torres', 22, '670748886'),
('84226838U', 'Carlos', 'Martinez', 'Diaz', 25, '699904660'),
('90105911A', 'Laura', 'Lopez', 'Lopez', 27, '622170643'),
('97879374F', 'Laura', 'Sanchez', 'Perez', 20, '651080365'),
('99909840G', 'Laura', 'Lopez', 'Torres', 30, '699109111');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `curso` varchar(1) NOT NULL,
  `horas` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `idAlumno` varchar(9) NOT NULL,
  `idModulo` int(11) NOT NULL,
  `nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `Apellido1` varchar(25) NOT NULL,
  `Apellido2` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`NIF`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`idAlumno`,`idModulo`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
