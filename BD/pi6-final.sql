-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-06-2013 a las 00:26:12
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pi6`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getDia`(`intDia` int) RETURNS varchar(20) CHARSET latin1
BEGIN
	#Routine body goes here...
	DECLARE res varchar(20);
	IF intDia = 1 THEN 
		SET res = 'Lunes';
    	ELSEIF intDia = 2 THEN 
		SET res= 'Martes';
	ELSEIF intDia = 3 THEN 
		SET res= 'Miércoles';
	ELSEIF intDia = 4 THEN 
		SET res= 'Jueves';
	ELSEIF intDia = 5 THEN
		SET res= 'Viernes'; 
	ELSEIF intDia = 6 THEN
		SET res= 'Sábado'; 
	ELSE 
		SET res= 'Domingo';
	END IF;
	RETURN  res;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `idMunicipio` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `dia_visita` int(2) NOT NULL,
  `asignado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCliente`),
  KEY `idMunicipio` (`idMunicipio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombre`, `direccion`, `idMunicipio`, `status`, `dia_visita`, `asignado`) VALUES
(31, 'angel', 'Calle antorcha del campesino', 1, 0, 2, 0),
(32, 'Vict5or', 'swdf', 1, 1, 1, 0),
(33, 'santa', 'sdfsd', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_salidas_entradas`
--

CREATE TABLE IF NOT EXISTS `detalle_salidas_entradas` (
  `idDetalle_salidas_entradas` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) NOT NULL,
  `cantidadLleva` int(11) NOT NULL,
  `cantidadRegreso` int(11) DEFAULT NULL,
  `idSalidas_entradas` int(11) NOT NULL,
  PRIMARY KEY (`idDetalle_salidas_entradas`),
  KEY `idProducto_idx` (`idProducto`),
  KEY `idSalidas_entradas` (`idSalidas_entradas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mermas`
--

CREATE TABLE IF NOT EXISTS `mermas` (
  `idMerma` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idSalidas_entradas` int(11) NOT NULL,
  PRIMARY KEY (`idMerma`),
  KEY `idProducto` (`idProducto`),
  KEY `idSalidas_entradas` (`idSalidas_entradas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE IF NOT EXISTS `municipios` (
  `idMunicipio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`idMunicipio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`idMunicipio`, `nombre`) VALUES
(1, 'Colima'),
(2, 'Manzanillo'),
(3, 'Tecoman'),
(4, 'Armeria'),
(5, 'Ixtlahuacan'),
(6, 'Coquimatlan'),
(7, 'Minatitlan'),
(8, 'Villa de alvarez'),
(9, 'Cuauhtemoc'),
(12, 'Comala');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(50) NOT NULL,
  `presentacion` varchar(20) NOT NULL,
  `precio_fabrica` double NOT NULL,
  `precio_publico` double NOT NULL,
  `status` int(2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_caducidad` date NOT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre_producto`, `presentacion`, `precio_fabrica`, `precio_publico`, `status`, `cantidad`, `fecha_caducidad`) VALUES
(1, 'Papitas', '150', 3, 5, 1, 100, '2015-05-26'),
(2, 'Chetos', '135', 4, 6, 1, 234, '2015-05-26'),
(3, 'Cacahuates', '40', 8, 10, 1, 123, '2015-05-26'),
(4, 'Pistaches', '55', 12, 15, 1, 125, '2015-05-26'),
(5, 'Churrumaiz', '35', 2, 4, 1, 432, '2015-05-26'),
(6, 'doritos', '40', 6.5, 7, 1, 10, '2013-05-02'),
(7, 'doritos', '40', 6.5, 7, 1, 287, '2013-09-27'),
(8, 'doritos', '40', 6.5, 7, 1, 80, '2013-07-25'),
(9, 'fa', '343', 3, 3, 1, 23, '2013-06-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `idRuta` int(11) NOT NULL,
  `dia` varchar(50) NOT NULL,
  PRIMARY KEY (`idRol`),
  KEY `idRuta` (`idRuta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `idRuta`, `dia`) VALUES
(14, 5, '1'),
(15, 6, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_clientes`
--

CREATE TABLE IF NOT EXISTS `rol_clientes` (
  `idRol_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `idRol` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  PRIMARY KEY (`idRol_cliente`),
  KEY `idRol` (`idRol`),
  KEY `idCliente` (`idCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `rol_clientes`
--

INSERT INTO `rol_clientes` (`idRol_cliente`, `idRol`, `idCliente`) VALUES
(20, 14, 32),
(21, 14, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE IF NOT EXISTS `rutas` (
  `idRuta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_ruta` varchar(45) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idMunicipio` int(11) NOT NULL,
  PRIMARY KEY (`idRuta`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre_ruta`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idMunicipio` (`idMunicipio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`idRuta`, `nombre_ruta`, `idUsuario`, `idMunicipio`) VALUES
(5, 'Colonia Lomas de vista hermosa', 3, 1),
(6, 'Colonia Centenario 2', 3, 5),
(7, 'Colonia feliz', 3, 1),
(8, 'Colonia miramar 2', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas_entradas`
--

CREATE TABLE IF NOT EXISTS `salidas_entradas` (
  `idSalidas_entradas` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idSalidas_entradas`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

CREATE TABLE IF NOT EXISTS `tipo_usuarios` (
  `idTipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idTipo_usuario`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`idTipo_usuario`, `nombre`) VALUES
(1, 'Admin'),
(2, 'Chofer-vendedor'),
(5, 'Gerente de ventas'),
(3, 'Jefe de ventas'),
(4, 'Usuario de inventario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `idTipo_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `nombre_usuario_UNIQUE` (`nombre_usuario`),
  KEY `idTipo_usuario` (`idTipo_usuario`),
  KEY `idTipo_usuario_2` (`idTipo_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `idTipo_usuario`, `nombre_usuario`, `clave`, `status`) VALUES
(1, 1, 'chuy', 'c7432b40153b80353dd6f7524416472c', 1),
(2, 2, 'vic', 'vic', 1),
(3, 2, 'victor', 'ffc150a160d37e92012c196b6af4160d', 1),
(4, 5, 'juan', 'a94652aa97c7211ba8954dd15a3cf838', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `idVenta` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`idVenta`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idCliente` (`idCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vta_detalles`
--

CREATE TABLE IF NOT EXISTS `vta_detalles` (
  `idVtaDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `idVenta` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`idVtaDetalle`),
  KEY `idVenta` (`idVenta`),
  KEY `idProducto` (`idProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`idMunicipio`) REFERENCES `municipios` (`idMunicipio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_salidas_entradas`
--
ALTER TABLE `detalle_salidas_entradas`
  ADD CONSTRAINT `detalle_salidas_entradas_ibfk_1` FOREIGN KEY (`idSalidas_entradas`) REFERENCES `salidas_entradas` (`idSalidas_entradas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idProducto` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mermas`
--
ALTER TABLE `mermas`
  ADD CONSTRAINT `mermas_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mermas_ibfk_2` FOREIGN KEY (`idSalidas_entradas`) REFERENCES `salidas_entradas` (`idSalidas_entradas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`idRuta`) REFERENCES `rutas` (`idRuta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_clientes`
--
ALTER TABLE `rol_clientes`
  ADD CONSTRAINT `rol_clientes_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_clientes_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `rutas_ibfk_2` FOREIGN KEY (`idMunicipio`) REFERENCES `municipios` (`idMunicipio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rutas_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salidas_entradas`
--
ALTER TABLE `salidas_entradas`
  ADD CONSTRAINT `salidas_entradas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `idTipo_usuario` FOREIGN KEY (`idTipo_usuario`) REFERENCES `tipo_usuarios` (`idTipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vta_detalles`
--
ALTER TABLE `vta_detalles`
  ADD CONSTRAINT `vta_detalles_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vta_detalles_ibfk_2` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`idVenta`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
