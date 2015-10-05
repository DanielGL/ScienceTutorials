-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-11-2013 a las 19:24:52
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `basemaraton`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `Matricula` varchar(9) NOT NULL,
  `Nombre` varchar(30) NOT NULL DEFAULT '###',
  `ApellidoPaterno` varchar(20) NOT NULL DEFAULT '###',
  `ApellidoMaterno` varchar(20) NOT NULL DEFAULT '###',
  `Carrera` varchar(3) NOT NULL DEFAULT '###',
  `Contrasenia` varchar(9) NOT NULL,
  PRIMARY KEY (`Matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`Matricula`, `Nombre`, `ApellidoPaterno`, `ApellidoMaterno`, `Carrera`, `Contrasenia`) VALUES
('A01023890', 'Rodrigo', 'Perez', 'Garza', '###', 'A01023890'),
('A01034154', '###', '###', '###', '###', 'A01034154'),
('A01034201', '###', '###', '###', '###', 'A01034201'),
('A01034234', '###', '###', '###', '###', 'A01034234'),
('A01034256', '###', '###', '###', '###', 'A01034256'),
('A01034340', '###', '###', '###', '###', 'A01034340'),
('A01034341', '###', '###', '###', '###', 'A01034341'),
('A01034344', '###', '###', '###', '###', 'A01034344'),
('A01034348', 'Adriana', 'Cortes', 'Soto', '###', 'A01034348'),
('A01034349', '###', '###', '###', '###', 'A01034349'),
('A01034350', '###', '###', '###', '###', 'A01034350'),
('A01034351', '###', '###', '###', '###', 'A01034351'),
('A01034352', '###', '###', '###', '###', 'A01034352'),
('A01034353', '###', '###', '###', '###', 'A01034353'),
('A01034354', '###', '###', '###', '###', 'A01034354'),
('A01034355', '###', '###', '###', '###', 'A01034355'),
('A01034356', '###', '###', '###', '###', 'A01034356'),
('A01034357', '###', '###', '###', '###', 'A01034357'),
('A01034358', '###', '###', '###', '###', 'A01034358'),
('A01034359', '###', '###', '###', '###', 'A01034359'),
('A01034360', '###', '###', '###', '###', 'A01034360'),
('A01034361', '###', '###', '###', '###', 'A01034361'),
('A01034444', 'Hector', 'Villarreal', 'Gonzalez', '###', 'A01034444'),
('A01034467', '###', '###', '###', '###', 'A01034467'),
('A01034561', 'Liliana Gabriela', 'Rangel', 'Reynoso', '###', 'A01034561'),
('A01034562', '###', '###', '###', '###', 'A01034562'),
('A01034567', '###', '###', '###', '###', 'A01034567'),
('A01034580', '###', '###', '###', '###', 'A01034580'),
('A01034581', '###', '###', '###', '###', 'A01034581'),
('A01034582', '###', '###', '###', '###', 'A01034582'),
('A01034583', '###', '###', '###', '###', 'A01034583'),
('A01034584', '###', '###', '###', '###', 'A01034584'),
('A01034585', '###', '###', '###', '###', 'A01034585'),
('A01034586', '###', '###', '###', '###', 'A01034586'),
('A01034587', '###', '###', '###', '###', 'A01034587'),
('A01034588', 'Joaquin', 'Gonzalez', 'Nu&#241;ez', '###', 'A01034588'),
('A01034589', '###', '###', '###', '###', 'A01034589'),
('A01034590', '###', '###', '###', '###', 'A01034590'),
('A01034592', '###', '###', '###', '###', 'A01034592'),
('A01034593', '###', '###', '###', '###', 'A01034593'),
('A01034594', 'Javier', 'Yepiz', 'Valencia', '###', 'A01034594'),
('A01034595', '###', '###', '###', '###', 'A01034595'),
('A01034596', '###', '###', '###', '###', 'A01034596'),
('A01034597', '###', '###', '###', '###', 'A01034597');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE IF NOT EXISTS `clase` (
  `Clave` varchar(6) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Administrador` varchar(9) NOT NULL,
  PRIMARY KEY (`Clave`),
  KEY `Administrador` (`Administrador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`Clave`, `Nombre`, `Administrador`) VALUES
('TC2001', 'Lenguajes de Programacion', 'L01234567'),
('TC2002', 'Programacion Avanzada', 'L01234567'),
('TC2003', 'Analisis y Diseño de Algoritmo', 'L01234567'),
('TC2004', 'Desarrollo de Aplicaciones Distribuidas', 'L01234569'),
('TC2005', 'Bases de Datos', 'L01234587'),
('TC2006', 'Bases de Datos Avanzadas', 'L03456789'),
('TC2007', 'Fundamentos de la ProgramaciÃ³n', 'L03456789');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasegrupoalumno`
--

CREATE TABLE IF NOT EXISTS `clasegrupoalumno` (
  `Clave` varchar(6) NOT NULL,
  `Grupo` varchar(3) NOT NULL,
  `Matricula` varchar(9) NOT NULL,
  `NombreE` varchar(15) NOT NULL,
  PRIMARY KEY (`Clave`,`Grupo`,`Matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clasegrupoalumno`
--

INSERT INTO `clasegrupoalumno` (`Clave`, `Grupo`, `Matricula`, `NombreE`) VALUES
('TC2001', '1', 'A01034154', 'B'),
('TC2001', '1', 'A01034201', 'E'),
('TC2001', '1', 'A01034234', 'A'),
('TC2001', '1', 'A01034256', 'A'),
('TC2001', '1', 'A01034340', 'A'),
('TC2001', '1', 'A01034341', 'C'),
('TC2001', '1', 'A01034344', 'C'),
('TC2001', '1', 'A01034444', 'C'),
('TC2001', '1', 'A01034561', 'F'),
('TC2001', '1', 'A01034562', 'F'),
('TC2001', '1', 'A01034567', 'F'),
('TC2001', '1', 'A01034587', 'E'),
('TC2001', '1', 'A01034588', 'E'),
('TC2001', '1', 'A01034589', '###'),
('TC2001', '1', 'A01034590', '###'),
('TC2001', '1', 'A01034594', 'A'),
('TC2001', '1', 'A01034595', 'B'),
('TC2002', '1', 'A01034592', 'R'),
('TC2002', '1', 'A01034593', 'S'),
('TC2002', '1', 'A01034594', 'X'),
('TC2003', '1', 'A01034592', '###'),
('TC2003', '1', 'A01034593', '###'),
('TC2003', '1', 'A01034594', 'D'),
('TC2004', '2', 'A01034348', 'DD'),
('TC2004', '2', 'A01034349', 'DD'),
('TC2004', '2', 'A01034350', '###'),
('TC2004', '2', 'A01034351', '###'),
('TC2004', '2', 'A01034352', 'AA'),
('TC2004', '2', 'A01034353', 'AA'),
('TC2004', '2', 'A01034354', 'EE'),
('TC2004', '2', 'A01034355', 'EE'),
('TC2004', '2', 'A01034356', 'FF'),
('TC2004', '2', 'A01034357', 'AA'),
('TC2004', '2', 'A01034358', 'AA'),
('TC2004', '2', 'A01034359', 'AA'),
('TC2004', '2', 'A01034360', 'CC'),
('TC2004', '2', 'A01034361', 'BB'),
('TC2004', '2', 'A01034561', 'BB'),
('TC2004', '2', 'A01034594', 'CC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE IF NOT EXISTS `equipo` (
  `Clave` varchar(6) NOT NULL,
  `Grupo` varchar(3) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NombreE` varchar(15) NOT NULL,
  PRIMARY KEY (`Clave`,`Grupo`,`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`Clave`, `Grupo`, `ID`, `NombreE`) VALUES
('TC2001', '1', 16, 'A'),
('TC2001', '1', 17, 'B'),
('TC2001', '1', 18, 'C'),
('TC2001', '1', 20, 'E'),
('TC2001', '1', 21, 'F'),
('TC2002', '1', 4, 'W'),
('TC2002', '1', 5, 'R'),
('TC2002', '1', 6, 'S'),
('TC2002', '1', 13, 'X'),
('TC2002', '1', 14, 'X'),
('TC2002', '1', 15, 'X'),
('TC2003', '1', 2, 'C'),
('TC2003', '1', 3, 'D'),
('TC2004', '2', 22, 'AA'),
('TC2004', '2', 23, 'BB'),
('TC2004', '2', 24, 'CC'),
('TC2004', '2', 25, 'DD'),
('TC2004', '2', 26, 'EE'),
('TC2004', '2', 27, 'FF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `Numero` varchar(3) NOT NULL,
  `Clave` varchar(6) NOT NULL,
  `Maestro` varchar(9) NOT NULL,
  PRIMARY KEY (`Numero`,`Clave`),
  KEY `Clave` (`Clave`),
  KEY `Maestro` (`Maestro`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`Numero`, `Clave`, `Maestro`) VALUES
('1', 'TC2001', 'L01234567'),
('1', 'TC2002', 'L01234567'),
('1', 'TC2003', 'L01234567'),
('1', 'TC2004', 'L01234569'),
('2', 'TC2004', 'L01234567'),
('2', 'TC2005', 'L01234587'),
('1', 'TC2006', 'L01238976');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE IF NOT EXISTS `historial` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `Clave` varchar(6) NOT NULL,
  `Grupo` varchar(3) NOT NULL,
  `Matricula` varchar(9) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Puntaje` int(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`ID`, `Clave`, `Grupo`, `Matricula`, `Fecha`, `Puntaje`) VALUES
(1, 'TC2001', '1', 'A01034594', '2013-11-01 03:12:08', 100),
(2, 'TC2001', '1', 'A01034594', '2013-11-01 09:21:24', 70),
(3, 'TC2001', '1', 'A01034561', '2013-11-09 06:20:32', 48),
(4, 'TC2001', '1', 'A01034561', '2013-11-07 04:17:29', 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE IF NOT EXISTS `maestro` (
  `Nomina` varchar(9) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `ApellidoPaterno` varchar(20) NOT NULL,
  `ApellidoMaterno` varchar(20) NOT NULL,
  `Contrasenia` varchar(10) NOT NULL,
  `Administrador` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Nomina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `maestro`
--

INSERT INTO `maestro` (`Nomina`, `Nombre`, `ApellidoPaterno`, `ApellidoMaterno`, `Contrasenia`, `Administrador`) VALUES
('L01234567', 'Reginaaa', 'Durannn', 'Gonzalez', 'L01234567', 1),
('L01234569', 'Jimmy', 'Zenith', 'Valdez', 'L01234569', 0),
('L01234587', 'Fernando', 'Gonzalez', 'Valdez', 'L01234587', 0),
('L01238976', 'Juan', 'Perez', 'Gonzalez', 'L01238976', 0),
('L03456788', 'Jimena', 'Tijerina', 'Banuelos', 'L03456788', 1),
('L03456789', 'Jaime', 'Beltran', 'Mireles', 'L03456789', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(200) NOT NULL,
  `Tema` varchar(20) NOT NULL,
  `Parcial` int(1) NOT NULL,
  `Dificultad` int(1) NOT NULL,
  `Respuesta1` varchar(200) NOT NULL,
  `Respuesta2` varchar(200) NOT NULL,
  `Respuesta3` varchar(200) NOT NULL,
  `Respuesta4` varchar(200) NOT NULL,
  `Imagen` int(1) DEFAULT NULL,
  `Clase` varchar(6) NOT NULL,
  `ImagenSubida` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Clase`,`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`ID`, `Descripcion`, `Tema`, `Parcial`, `Dificultad`, `Respuesta1`, `Respuesta2`, `Respuesta3`, `Respuesta4`, `Imagen`, `Clase`, `ImagenSubida`) VALUES
(27, 'Prueba', 'Prueba', 1, 1, 'Prueba', 'Prueba', 'Prueba', 'Prueba', 0, '', 1),
(30, 'Prueba', 'Prueba', 1, 1, 'Prueba', 'Prueba', 'Prueba', 'Prueba', 0, '', 1),
(1, 'otra vez', 'otra', 1, 1, 'm', 'n', '3', '5', 0, 'TC2001', 1),
(2, '2+2', 'Sumas', 1, 1, '4', '2', '3', '1', 0, 'TC2001', 1),
(3, '2+2', 'Sumas', 1, 1, '4', '2', '3', '1', 0, 'TC2001', 1),
(4, '2-2', 'Restas', 1, 1, '0', '2', '3', '1', 0, 'TC2001', 1),
(5, '2-2', 'Restas', 1, 1, '0', '2', '3', '1', 0, 'TC2001', 1),
(6, '2-2', 'Restas', 1, 1, '0', '2', '3', '1', 0, 'TC2001', 1),
(7, '2-2', 'Restas', 1, 1, '0', '2', '3', '1', 0, 'TC2001', 1),
(8, '2*2', 'Multiplicacion', 1, 1, '4', '2', '1', '3', 0, 'TC2001', 1),
(9, '2/2', 'Division', 1, 1, '1', '0', '2', '3', 0, 'TC2001', 1),
(10, '2/2', 'Division', 1, 1, '1', '0', '2', '3', 0, 'TC2001', 1),
(11, '2/2', 'Division', 1, 1, '1', '0', '2', '3', 0, 'TC2001', 1),
(12, '2/2', 'Division', 1, 1, '1', '0', '2', '3', 0, 'TC2001', 1),
(13, '2/2', 'Division', 1, 1, '1', '0', '2', '3', 0, 'TC2001', 1),
(14, 'Nose', 'Nose', 1, 1, 'Nose', 'Si', 'No', 'MMM', 0, 'TC2001', 1),
(15, 'Nose', 'Ya', 1, 1, 'Si', 'No', 'MMM', 'gtyuh', 0, 'TC2001', 1),
(16, 'Nose', 'Ya', 1, 1, 'Si', 'No', 'MMM', 'gtyuh', 0, 'TC2001', 1),
(17, 'Nose', 'Ya', 1, 1, 'Si', 'No', 'MMM', 'gtyuh', 0, 'TC2001', 1),
(18, 'd', 'd', 1, 1, 'd', 'fff', 'f', 'n', 0, 'TC2001', 1),
(19, 'd', 'd', 1, 1, 'd', 'fff', 'f', 'n', 0, 'TC2001', 1),
(20, 'd', 'd', 1, 1, 'd', 'fff', 'f', 'n', 0, 'TC2001', 1),
(21, 'f', 'a', 1, 1, 'b', 'b', 'b', 'b', 0, 'TC2001', 1),
(22, 'f', 'a', 1, 1, 'b', 'b', 'b', 'b', 0, 'TC2001', 1),
(23, 'f', 'a', 1, 1, 'b', 'b', 'b', 'b', 0, 'TC2001', 1),
(24, 'f', 'a', 1, 1, 'b', 'b', 'b', 'b', 0, 'TC2001', 1),
(25, '2+2+2', 'Sumas', 2, 2, '6', '2', '0', '4', 0, 'TC2001', 1),
(26, 'Prueba', 'Prueba', 1, 1, 'Prueba', 'Prueba', 'Prueba', 'Prueba', 0, 'TC2001', 1),
(28, 'Prueba', 'Prueba', 1, 1, 'Prueba', 'Prueba', 'Prueba', 'Prueba', 0, 'TC2001', 1),
(29, 'Prueba', 'Prueba', 1, 1, 'Prueba', 'Prueba', 'Prueba', 'Prueba', 0, 'TC2001', 1),
(31, 'Prueba', 'Prueba', 1, 1, 'Prueba', 'Prueba', 'Prueba', 'Prueba', 0, 'TC2001', 1),
(32, 'Prueba', 'Prueba', 1, 1, 'Prueba', 'Prueba', 'Prueba', 'Prueba', 0, 'TC2001', 1),
(33, 'Prueba1', 'Prueba1', 1, 1, 'Prueba1', 'Prueba1', 'Prueba1', 'Prueba1', 0, 'TC2001', 1),
(34, 'Prueba1', 'Prueba1', 1, 1, 'Prueba1', 'Prueba1', 'Prueba1', 'Prueba1', 0, 'TC2001', 1),
(35, 'Prueba1', 'Prueba1', 1, 1, 'Prueba1', 'Prueba1', 'Prueba1', 'Prueba1', 1, 'TC2001', 1),
(36, 'Prueba1', 'Prueba1', 1, 1, 'Prueba1', 'Prueba1', 'Prueba1', 'Prueba1', 1, 'TC2001', 1),
(37, 'Prueba23', 'Prueba23', 1, 1, 'Prueba23', 'Prueba23', 'Prueba23', 'Prueba23', 1, 'TC2001', 1),
(38, 'Prueba23', 'Prueba23', 1, 1, 'Prueba23', 'Prueba23', 'Prueba23', 'Prueba23', 0, 'TC2001', 1),
(39, 'Prueba23', 'Prueba23', 1, 1, 'Prueba23', 'Prueba23', 'Prueba23', 'Prueba23', 1, 'TC2001', 1),
(40, 'Prueba23', 'Prueba23', 1, 1, 'Prueba23', 'Prueba23', 'Prueba23', 'Prueba23', 1, 'TC2001', 1),
(41, 'Prueba23', 'Prueba23', 1, 1, 'Prueba23', 'Prueba23', 'Prueba23', 'Prueba23', 0, 'TC2001', 1),
(42, 'Prueba23', 'Prueba23', 1, 1, 'Prueba23', 'Prueba23', 'Prueba23', 'Prueba23', 1, 'TC2001', 1),
(43, 'Prueba23', 'Prueba23', 1, 1, 'Prueba23', 'Prueba23', 'Prueba23', 'Prueba23', 1, 'TC2001', 1),
(44, 'Prueba2', 'Prueba2', 1, 1, 'Prueba2', 'Prueba2', 'Prueba2', 'Prueba2', 1, 'TC2001', 1),
(45, 'Prueba47', 'Prueba47', 1, 1, 'Prueba47', 'Prueba47', 'Prueba47', 'Prueba47', 1, 'TC2001', 1),
(46, 'Prueba100', 'Prueba100', 1, 1, 'Prueba100', 'Prueba100', 'Prueba100', 'Prueba100', 0, 'TC2001', 1),
(47, 'Prueba100', 'Prueba100', 1, 1, 'Prueba100', 'Prueba100', 'Prueba100', 'Prueba100', 0, 'TC2001', 1),
(48, 'Prueba100', 'Prueba100', 1, 1, 'Prueba100', 'Prueba100', 'Prueba100', 'Prueba100', 1, 'TC2001', 1),
(49, 'Prueba100', 'Prueba100', 1, 1, 'Prueba100', 'Prueba100', 'Prueba100', 'Prueba100', 1, 'TC2001', 1),
(50, 'Prueba100', 'Prueba100', 1, 1, 'Prueba100', 'Prueba100', 'Prueba100', 'Prueba100', 1, 'TC2001', 1),
(51, 'Prueba100', 'Prueba100', 1, 1, 'Prueba100', 'Prueba100', 'Prueba100', 'Prueba100', 1, 'TC2001', 1),
(52, 'Prueba100', 'Prueba100', 1, 1, 'Prueba100', 'Prueba100', 'Prueba100', 'Prueba100', 1, 'TC2001', 1),
(53, 'Prueba999', 'Prueba999', 1, 1, 'Prueba999', 'Prueba999', 'Prueba999', 'Prueba999', 1, 'TC2001', 1),
(54, 'En base a las \r\nsiguiente figura', 'Prueba', 2, 2, '1', '2', '3', '4', 1, 'TC2001', 1),
(55, 'Prueba215', 'Prueba215', 1, 1, 'Prueba215', 'Prueba215', 'Prueba215', 'Prueba215', 1, 'TC2002', 1),
(56, 'Prueba215', 'Prueba215', 1, 1, 'Prueba215', 'Prueba215', 'Prueba215', 'Prueba215', 1, 'TC2002', 1),
(57, 'Prueba215', 'Prueba215', 1, 1, 'Prueba215', 'Prueba215', 'Prueba215', 'Prueba215', 1, 'TC2002', 1),
(58, 'Prueba215', 'Prueba215', 1, 1, 'Prueba215', 'Prueba215', 'Prueba215', 'Prueba215', 1, 'TC2002', 1),
(59, 'Prueba215', 'Prueba215', 1, 1, 'Prueba215', 'Prueba215', 'Prueba215', 'Prueba215', 1, 'TC2002', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `superadmin`
--

CREATE TABLE IF NOT EXISTS `superadmin` (
  `ID` varchar(13) NOT NULL,
  `Contrasenia` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `superadmin`
--

INSERT INTO `superadmin` (`ID`, `Contrasenia`) VALUES
('Admin', 'admin');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `clase_ibfk_1` FOREIGN KEY (`Administrador`) REFERENCES `maestro` (`Nomina`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
