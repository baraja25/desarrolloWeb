-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2024 a las 19:02:43
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
  `Edad` int(11) NOT NULL,
  `Telefono` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`NIF`, `Nombre`, `Apellido1`, `Apellido2`, `Edad`, `Telefono`) VALUES
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
  `IdAlum` varchar(9) NOT NULL,
  `IdMod` int(11) NOT NULL,
  `Nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`IdAlum`, `IdMod`, `Nota`) VALUES
('20266156G', 1, 4),
('20266156G', 2, 4),
('20266156G', 3, 2),
('20266156G', 4, 2),
('20266156G', 5, 3),
('24206736F', 1, 7),
('24206736F', 2, 5),
('24206736F', 3, 10),
('24206736F', 4, 1),
('24206736F', 5, 7),
('36956961I', 1, 3),
('36956961I', 2, 4),
('36956961I', 3, 10),
('36956961I', 4, 4),
('36956961I', 5, 7),
('37345301C', 1, 1),
('37345301C', 2, 3),
('37345301C', 3, 1),
('37345301C', 4, 7),
('37345301C', 5, 9),
('37421135D', 1, 2),
('37421135D', 2, 9),
('37421135D', 3, 9),
('37421135D', 4, 6),
('37421135D', 5, 2),
('38172726Q', 1, 7),
('38172726Q', 2, 7),
('38172726Q', 3, 8),
('38172726Q', 4, 2),
('38172726Q', 5, 7),
('38613467H', 1, 9),
('38613467H', 2, 7),
('38613467H', 3, 9),
('38613467H', 4, 1),
('38613467H', 5, 2),
('51188455M', 1, 3),
('51188455M', 2, 9),
('51188455M', 3, 5),
('51188455M', 4, 2),
('51188455M', 5, 5),
('55293919H', 1, 5),
('55293919H', 2, 8),
('55293919H', 3, 10),
('55293919H', 4, 7),
('55293919H', 5, 10),
('57135405Q', 1, 2),
('57135405Q', 2, 6),
('57135405Q', 3, 5),
('57135405Q', 4, 9),
('57135405Q', 5, 4),
('65405610M', 1, 7),
('65405610M', 2, 1),
('65405610M', 3, 5),
('65405610M', 4, 1),
('65405610M', 5, 5),
('65931912U', 1, 3),
('65931912U', 2, 3),
('65931912U', 3, 7),
('65931912U', 4, 10),
('65931912U', 5, 1),
('74573453F', 1, 6),
('74573453F', 2, 1),
('74573453F', 3, 5),
('74573453F', 4, 7),
('74573453F', 5, 3),
('75397241A', 1, 3),
('75397241A', 2, 7),
('75397241A', 3, 2),
('75397241A', 4, 3),
('75397241A', 5, 2),
('79430037J', 1, 1),
('79430037J', 2, 9),
('79430037J', 3, 8),
('79430037J', 4, 1),
('79430037J', 5, 10),
('80356162O', 1, 3),
('80356162O', 2, 9),
('80356162O', 3, 5),
('80356162O', 4, 9),
('80356162O', 5, 4),
('84226838U', 1, 9),
('84226838U', 2, 5),
('84226838U', 3, 4),
('84226838U', 4, 2),
('84226838U', 5, 9),
('90105911A', 1, 2),
('90105911A', 2, 9),
('90105911A', 3, 9),
('90105911A', 4, 2),
('90105911A', 5, 5),
('97879374F', 1, 1),
('97879374F', 2, 2),
('97879374F', 3, 4),
('97879374F', 4, 10),
('97879374F', 5, 5),
('99909840G', 1, 2),
('99909840G', 2, 2),
('99909840G', 3, 10),
('99909840G', 4, 4),
('99909840G', 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`Id`, `Nombre`) VALUES
(1, 'España'),
(2, 'Francia'),
(3, 'Alemania');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `IdPro` int(11) NOT NULL,
  `IdPais` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`IdPro`, `IdPais`, `Nombre`) VALUES
(1, 1, 'Madrid'),
(1, 2, 'Paris'),
(1, 3, 'Berlin'),
(2, 1, 'Barcelona'),
(2, 2, 'Lyon'),
(2, 3, 'Munich'),
(3, 1, 'Valencia'),
(3, 2, 'Tolouse'),
(3, 3, 'Studgart');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`NIF`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`IdLoc`,`IdPais`,`IdProvincia`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`IdAlum`,`IdMod`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`IdPro`,`IdPais`);

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
