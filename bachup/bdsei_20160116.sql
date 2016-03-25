-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2016 a las 20:34:15
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bdsei`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `login`(in nom varchar(100), in pass varchar(100))
begin
SELECT u.ID_Usuario, u.Nombre, u.Email, u.Cargo, u.Cod_Perfil, u.Nom_Usu,
u.Clave
FROM bdsei.usuarios as u 
WHERE u.Nom_Usu=nom and u.Clave=pass;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos`
--

CREATE TABLE IF NOT EXISTS `codigos` (
  `Cod_Tipo` int(5) NOT NULL,
  `Cod_Codigo` int(5) NOT NULL,
  `Descr` varchar(100) NOT NULL,
  `Cod_Padre` int(5) NOT NULL,
  PRIMARY KEY (`Cod_Tipo`,`Cod_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `codigos`
--

INSERT INTO `codigos` (`Cod_Tipo`, `Cod_Codigo`, `Descr`, `Cod_Padre`) VALUES
(1, 1, 'Admin', 0),
(1, 2, 'Usuario', 0),
(1, 3, 'Soporte', 0),
(1, 4, 'Analista', 0),
(1, 5, 'JP', 0),
(1, 6, 'SA', 0),
(2, 1, 'Sistemas', 0),
(2, 2, 'Redes', 0),
(2, 3, 'Infraestructura', 0),
(2, 4, 'PMO', 0),
(3, 1, 'Baja', 0),
(3, 2, 'Media', 0),
(3, 3, 'Alta', 0),
(3, 4, 'Critica', 0),
(4, 1, 'Incidencias', 0),
(4, 2, 'Requerimientos', 0),
(4, 3, 'Tareas y Subtareas', 0),
(7, 1, 'Abierto', 0),
(7, 2, 'En Progreso', 0),
(7, 3, 'Reabierto', 0),
(7, 4, 'En Analisis', 0),
(7, 5, 'En Correccion', 0),
(7, 6, 'Rechazado', 0),
(7, 7, 'En Liberacion', 0),
(7, 8, 'Liberado', 0),
(7, 9, 'En Aprobacion', 0),
(7, 10, 'Aprobado', 0),
(7, 11, 'Cerrado', 0),
(7, 12, 'En Espera', 0),
(7, 13, 'Devuelto', 0),
(8, 1, '20', 1),
(8, 2, '14', 2),
(8, 3, '7', 3),
(8, 4, '4', 4),
(9, 1, 'Abierto', 0),
(9, 2, 'En Progreso', 0),
(9, 3, 'Cerrado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `ID_Comentario` int(5) NOT NULL,
  `ID_Tarea` int(5) NOT NULL,
  `ID_Usuario` int(5) NOT NULL,
  `Fec_Ing` date NOT NULL,
  `Detalle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE IF NOT EXISTS `documentos` (
  `ID_Docto` int(5) NOT NULL,
  `Cod_Tipo_Req` int(5) NOT NULL,
  `ID_Num_Req` int(5) NOT NULL,
  `Ruta` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Docto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapas`
--

CREATE TABLE IF NOT EXISTS `etapas` (
  `ID_Etapa` int(5) NOT NULL,
  `Descr` varchar(100) NOT NULL,
  `Detalle` text NOT NULL,
  `Orden` int(5) NOT NULL,
  PRIMARY KEY (`ID_Etapa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `etapas`
--

INSERT INTO `etapas` (`ID_Etapa`, `Descr`, `Detalle`, `Orden`) VALUES
(1, 'Análisis', ': El problema es analizado por un ingeniero el cual determina si aplica realizar una mantención correctiva o solo es un problema de configuración de parámetros.', 1),
(2, 'Construcción', 'Se da solución al problema y se generan las Pruebas Unitarias para el QA.', 2),
(3, 'Liberación QA', 'Se solicita copiar la pieza a ambiente de QA. Previo a esta solicitud se debe adjunto el Tag de versionamiento de la pieza.', 3),
(4, 'Auditoria', 'La pieza es validada por un ingeniero externo al equipo y posteriormente es aprobada por el jefe de Área.', 4),
(5, 'QA Interno', 'Área QA replica las pruebas unitarias realizando pruebas funcionales y de impacto.', 5),
(6, 'Liberación Producción', 'Se solicita pasar la Pieza a ambiente de Producción. Previo a esta solicitud se debe adjunto el Tag de versionamiento de la pieza.', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujo_secuencia`
--

CREATE TABLE IF NOT EXISTS `flujo_secuencia` (
  `ID_Etapa` int(5) NOT NULL,
  `ID_Estado` int(5) NOT NULL,
  `Orden` int(5) NOT NULL,
  PRIMARY KEY (`ID_Etapa`,`ID_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `flujo_secuencia`
--

INSERT INTO `flujo_secuencia` (`ID_Etapa`, `ID_Estado`, `Orden`) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 3, 3),
(1, 4, 4),
(1, 11, 5),
(1, 12, 6),
(2, 1, 1),
(2, 2, 2),
(2, 3, 3),
(2, 5, 4),
(2, 11, 5),
(2, 12, 6),
(3, 1, 1),
(3, 2, 2),
(3, 3, 3),
(3, 7, 4),
(3, 8, 5),
(3, 11, 6),
(3, 12, 7),
(3, 13, 8),
(4, 1, 1),
(4, 2, 2),
(4, 3, 3),
(4, 6, 4),
(4, 11, 5),
(4, 12, 6),
(4, 13, 7),
(5, 1, 1),
(5, 2, 2),
(5, 3, 3),
(5, 6, 4),
(5, 11, 5),
(5, 12, 6),
(5, 13, 7),
(6, 1, 1),
(6, 2, 2),
(6, 3, 3),
(6, 7, 4),
(6, 8, 5),
(6, 9, 6),
(6, 10, 7),
(6, 11, 8),
(6, 12, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujo_tarea`
--

CREATE TABLE IF NOT EXISTS `flujo_tarea` (
  `ID_Tarea` int(5) NOT NULL,
  `ID_Etapa` int(5) NOT NULL,
  `ID_Estado` int(5) NOT NULL,
  PRIMARY KEY (`ID_Tarea`,`ID_Etapa`,`ID_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE IF NOT EXISTS `incidencias` (
  `ID_Incidencia` int(5) NOT NULL,
  `Fec_Ing` date NOT NULL,
  `Descr` varchar(100) NOT NULL,
  `Detalle` text NOT NULL,
  `Dependencia` varchar(100) NOT NULL,
  `ID_Usuario` int(5) NOT NULL,
  PRIMARY KEY (`ID_Incidencia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE IF NOT EXISTS `modulos` (
  `ID_Modulo` int(5) NOT NULL,
  `Descr` varchar(100) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Estado` varchar(1) NOT NULL,
  `ID_Mod_Padre` int(5) NOT NULL,
  PRIMARY KEY (`ID_Modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`ID_Modulo`, `Descr`, `URL`, `Estado`, `ID_Mod_Padre`) VALUES
(1, 'Login de acceso', '', 'V', 0),
(2, 'Registro de usuario', '', 'V', 0),
(3, 'Recupera contraseña', '', 'V', 0),
(4, 'Ingreso de Incidencias', '', 'V', 0),
(5, 'Crear Incidencia', '', 'V', 4),
(6, 'Listado de Incidencias', '', 'V', 4),
(7, 'Ingreso de Requerimientos', '', 'V', 0),
(8, 'Crear Requerimientos', '', 'V', 7),
(9, 'Listado de Requerimientos', '', 'V', 7),
(10, 'Ingreso de Tareas', '', 'V', 0),
(11, 'Crear Tareas', '', 'V', 10),
(12, 'Listado de Tareas', '', 'V', 10),
(13, 'Modulo de Tarea', '', 'V', 10),
(14, 'Seguimiento flujo de Estados', '', 'V', 0),
(15, 'Calendario de Tareas', '', 'V', 0),
(16, 'Mantenedores', '', 'V', 0),
(17, 'Tipos', '', 'V', 16),
(18, 'Codigos Gral', '', 'V', 16),
(19, 'Etapas', '', 'V', 16),
(20, 'Usuarios', '', 'V', 16),
(21, 'Privilegios', '', 'V', 16),
(22, 'Modulos', '', 'V', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitoreo`
--

CREATE TABLE IF NOT EXISTS `monitoreo` (
  `ID_Monitoreo` int(5) NOT NULL,
  `Cod_Tipo_Req` int(5) NOT NULL,
  `ID_Num_Req` int(5) NOT NULL,
  `ID_Usu_Encargado` int(5) NOT NULL,
  `Fec_Solucion` date NOT NULL,
  `Cod_Estado` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `Cod_Perfil` int(5) NOT NULL,
  `ID_Modulo` int(5) NOT NULL,
  `SW_Consultar` int(5) NOT NULL,
  `SW_Guardar` int(5) NOT NULL,
  `SW_Modificar` int(5) NOT NULL,
  `SW_Eliminar` int(5) NOT NULL,
  PRIMARY KEY (`Cod_Perfil`,`ID_Modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`Cod_Perfil`, `ID_Modulo`, `SW_Consultar`, `SW_Guardar`, `SW_Modificar`, `SW_Eliminar`) VALUES
(1, 1, 1, 1, 1, 1),
(1, 2, 1, 1, 1, 1),
(1, 3, 1, 1, 1, 1),
(1, 16, 1, 1, 1, 1),
(1, 17, 1, 1, 1, 1),
(1, 18, 1, 1, 1, 1),
(1, 19, 1, 1, 1, 1),
(1, 20, 1, 1, 1, 1),
(1, 21, 1, 1, 1, 1),
(1, 22, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 1),
(2, 2, 1, 1, 1, 1),
(2, 3, 1, 1, 1, 1),
(2, 4, 1, 1, 1, 1),
(2, 5, 1, 1, 1, 1),
(2, 6, 1, 1, 1, 1),
(2, 7, 1, 1, 1, 1),
(3, 1, 1, 1, 1, 1),
(3, 2, 1, 1, 1, 1),
(3, 3, 1, 1, 1, 1),
(3, 7, 1, 1, 1, 1),
(3, 8, 1, 1, 1, 1),
(3, 9, 1, 1, 1, 1),
(4, 1, 1, 1, 1, 1),
(4, 2, 1, 1, 1, 1),
(4, 3, 1, 1, 1, 1),
(4, 6, 1, 1, 1, 1),
(4, 9, 1, 1, 1, 1),
(4, 13, 1, 1, 1, 1),
(4, 14, 1, 1, 1, 1),
(4, 15, 1, 1, 1, 1),
(5, 1, 1, 1, 1, 1),
(5, 2, 1, 1, 1, 1),
(5, 3, 1, 1, 1, 1),
(5, 10, 1, 1, 1, 1),
(5, 11, 1, 1, 1, 1),
(5, 12, 1, 1, 1, 1),
(5, 13, 1, 1, 1, 1),
(5, 14, 1, 1, 1, 1),
(5, 15, 1, 1, 1, 1),
(6, 1, 1, 1, 1, 1),
(6, 2, 1, 1, 1, 1),
(6, 3, 1, 1, 1, 1),
(6, 4, 1, 1, 1, 1),
(6, 5, 1, 1, 1, 1),
(6, 6, 1, 1, 1, 1),
(6, 7, 1, 1, 1, 1),
(6, 8, 1, 1, 1, 1),
(6, 9, 1, 1, 1, 1),
(6, 10, 1, 1, 1, 1),
(6, 11, 1, 1, 1, 1),
(6, 12, 1, 1, 1, 1),
(6, 13, 1, 1, 1, 1),
(6, 14, 1, 1, 1, 1),
(6, 15, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientos`
--

CREATE TABLE IF NOT EXISTS `requerimientos` (
  `ID_Req` int(5) NOT NULL,
  `Fec_Ing` date NOT NULL,
  `Cod_Area` int(5) NOT NULL,
  `Cod_Prioridad` int(5) NOT NULL,
  `ID_Incidencia` int(5) NOT NULL,
  `Observacion` text NOT NULL,
  `ID_Usuario` int(5) NOT NULL,
  PRIMARY KEY (`ID_Req`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE IF NOT EXISTS `tareas` (
  `ID_tarea` int(5) NOT NULL,
  `Fec_Ing` date NOT NULL,
  `Usu_Gestor` int(5) NOT NULL,
  `Usu_Asignado` int(5) NOT NULL,
  `Fec_Ini` date NOT NULL,
  `Fec_Fin` date NOT NULL,
  `Descr` varchar(100) NOT NULL,
  `Detalle` text NOT NULL,
  `ID_Tarea_Padre` int(5) NOT NULL,
  `ID_Req` int(5) NOT NULL,
  PRIMARY KEY (`ID_tarea`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `Cod_Tipo` int(5) NOT NULL,
  `Descr` varchar(100) NOT NULL,
  `Cod_Tip_Padre` int(5) NOT NULL,
  `Estado` varchar(1) NOT NULL,
  PRIMARY KEY (`Cod_Tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`Cod_Tipo`, `Descr`, `Cod_Tip_Padre`, `Estado`) VALUES
(1, 'Perfiles', 0, 'V'),
(2, 'Areas', 0, 'V'),
(3, 'Prioridad', 0, 'V'),
(4, 'Identificador Doctos', 0, 'V'),
(7, 'Estados de Flujo', 0, 'V'),
(8, 'Tiempos', 3, 'V'),
(9, 'Estados de Incidencia', 0, 'V');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID_Usuario` int(5) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Cargo` varchar(50) NOT NULL,
  `Cod_Perfil` int(5) NOT NULL,
  `Nom_Usu` varchar(60) NOT NULL,
  `Clave` varchar(60) NOT NULL,
  PRIMARY KEY (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuario`, `Nombre`, `Email`, `Cargo`, `Cod_Perfil`, `Nom_Usu`, `Clave`) VALUES
(1, 'Enrique Quijón', 'enriquequijonm@gmail.com', 'Ingeniero de Software', 6, 'equijon', '123456'),
(2, 'Adrián Siñiga', 'ajaxwd@gmail.com', 'Ingeniero de Software', 6, 'asiniga', '123456'),
(3, 'Usuario Prueba', 'ajaxwd@gmail.com', 'Operador', 2, 'usuario', '123456'),
(4, 'Soporte', 'ajaxwd@gmail.com', 'Operador', 3, 'soporte', '123456'),
(5, 'Analista', 'ajaxwd@gmail.com', 'Operador', 4, 'analista', '123456'),
(6, 'JP', 'ajaxwd@gmail.com', 'Jefe de Area', 5, 'jefe', '123456'),
(7, 'Admin', 'ajaxwd@gmail.com', 'Administrador', 1, 'admin', '123456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
