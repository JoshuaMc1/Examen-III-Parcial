-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-04-2022 a las 00:50:18
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `examen3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `idCiudad` int(11) NOT NULL,
  `Ciudad` varchar(250) NOT NULL,
  `Pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`idCiudad`, `Ciudad`, `Pais`) VALUES
(1, 'Tegucigalpa', 1),
(2, 'San Pedro Sula', 1),
(3, 'San Salvador', 2),
(4, 'Ciudad de Mexico', 3),
(5, 'Monterrey', 3),
(6, 'New York', 4),
(7, 'Los Angeles', 4),
(8, 'Guatemala', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `idPais` int(11) NOT NULL,
  `Pais` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idPais`, `Pais`) VALUES
(1, 'Honduras'),
(2, 'El Salvador'),
(3, 'Mexico'),
(4, 'Estados Unidos'),
(5, 'Guatemala');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_poblacional`
--

CREATE TABLE `registro_poblacional` (
  `idRegistro` int(11) NOT NULL,
  `idCiudad` int(11) NOT NULL,
  `totalMujeres` int(11) NOT NULL,
  `totalHombres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro_poblacional`
--

INSERT INTO `registro_poblacional` (`idRegistro`, `idCiudad`, `totalMujeres`, `totalHombres`) VALUES
(1, 1, 19500, 15000),
(2, 6, 15867, 15000),
(3, 8, 19500, 12300),
(4, 4, 10000, 12300),
(5, 5, 19500, 15000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`idCiudad`),
  ADD KEY `Pais` (`Pais`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`idPais`);

--
-- Indices de la tabla `registro_poblacional`
--
ALTER TABLE `registro_poblacional`
  ADD PRIMARY KEY (`idRegistro`),
  ADD KEY `idCiudad` (`idCiudad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `idCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `idPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `registro_poblacional`
--
ALTER TABLE `registro_poblacional`
  MODIFY `idRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`Pais`) REFERENCES `pais` (`idPais`);

--
-- Filtros para la tabla `registro_poblacional`
--
ALTER TABLE `registro_poblacional`
  ADD CONSTRAINT `registro_poblacional_ibfk_1` FOREIGN KEY (`idCiudad`) REFERENCES `ciudad` (`idCiudad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
