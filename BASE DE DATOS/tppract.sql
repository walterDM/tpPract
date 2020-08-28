-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-08-2020 a las 06:19:48
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tppract`
--
CREATE DATABASE IF NOT EXISTS `tppract` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tppract`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
CREATE TABLE IF NOT EXISTS `ciudades` (
  `idCiudad` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `idProvincia` int(11) NOT NULL,
  PRIMARY KEY (`idCiudad`),
  KEY `fk_provincias_idx` (`idProvincia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactosproveedores`
--

DROP TABLE IF EXISTS `contactosproveedores`;
CREATE TABLE IF NOT EXISTS `contactosproveedores` (
  `idContactoProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `idProveedor` int(11) NOT NULL,
  `idTipoContacto` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idContactoProveedor`),
  KEY `fk_tipo_idx` (`idTipoContacto`),
  KEY `fk_proveedor_idx` (`idProveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `contactosproveedores`
--

INSERT INTO `contactosproveedores` (`idContactoProveedor`, `idProveedor`, `idTipoContacto`, `descripcion`) VALUES
(1, 3, 1, 'qadda@hjhf.com'),
(2, 3, 2, '252525');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallespedidos`
--

DROP TABLE IF EXISTS `detallespedidos`;
CREATE TABLE IF NOT EXISTS `detallespedidos` (
  `idPedidoProveedor` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `PrecioUnidad` double NOT NULL,
  `PrecioTotal` double NOT NULL,
  PRIMARY KEY (`idPedidoProveedor`,`idProducto`),
  KEY `fk_DetalleCompraProducto_idx` (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
CREATE TABLE IF NOT EXISTS `direcciones` (
  `idDrieccion` int(11) NOT NULL AUTO_INCREMENT,
  `idCiudad` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `idTipoDomicilio` int(11) NOT NULL,
  `calle` varchar(45) NOT NULL,
  `altura` int(11) NOT NULL,
  `dpto` varchar(45) DEFAULT NULL,
  `piso` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDrieccion`),
  KEY `fk_persona_idx` (`idPersona`),
  KEY `fk_ciudad_idx` (`idCiudad`),
  KEY `fk_domicilio_idx` (`idTipoDomicilio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `LegajoEmpleado` varchar(45) NOT NULL,
  `idPersona` int(11) NOT NULL,
  PRIMARY KEY (`LegajoEmpleado`),
  KEY `fk_personaEmp_idx` (`idPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`LegajoEmpleado`, `idPersona`) VALUES
('252525', 10),
('242424', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturadetalles`
--

DROP TABLE IF EXISTS `facturadetalles`;
CREATE TABLE IF NOT EXISTS `facturadetalles` (
  `idFactura` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioUnidad` double NOT NULL,
  `precioTotal` double NOT NULL,
  PRIMARY KEY (`idFactura`,`idProducto`),
  KEY `fk_producto_idx` (`idProducto`),
  KEY `fk_Factura_idx` (`idFactura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

DROP TABLE IF EXISTS `facturas`;
CREATE TABLE IF NOT EXISTS `facturas` (
  `idFacturaVenta` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `totalApagar` double NOT NULL,
  `fechaPedido` date NOT NULL,
  `LegajoEmpleado` int(11) NOT NULL,
  `TipoFactura` int(11) NOT NULL,
  `NumeroFactura` int(11) NOT NULL,
  PRIMARY KEY (`idFacturaVenta`),
  KEY `fkPersonaFac_idx` (`idPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE IF NOT EXISTS `grupos` (
  `idGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreGrupo` varchar(45) NOT NULL,
  PRIMARY KEY (`idGrupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`idGrupo`, `nombreGrupo`) VALUES
(18, 'ADMINISTRADOR'),
(19, 'CLIENTE'),
(20, 'EMPLEADO DE DEPOSITO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupospermisos`
--

DROP TABLE IF EXISTS `grupospermisos`;
CREATE TABLE IF NOT EXISTS `grupospermisos` (
  `idGrupo` int(11) NOT NULL,
  `idPermiso` int(11) NOT NULL,
  PRIMARY KEY (`idGrupo`,`idPermiso`),
  KEY `fk_permisos_idx` (`idPermiso`),
  KEY `fk_Grupo_idx` (`idGrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupospermisos`
--

INSERT INTO `grupospermisos` (`idGrupo`, `idPermiso`) VALUES
(18, 1),
(20, 1),
(18, 2),
(20, 2),
(18, 3),
(20, 3),
(18, 4),
(20, 4),
(18, 5),
(18, 6),
(20, 6),
(18, 7),
(20, 7),
(18, 8),
(20, 8),
(18, 9),
(20, 9),
(18, 10),
(20, 10),
(18, 11),
(18, 12),
(18, 13),
(18, 14),
(18, 15),
(18, 16),
(18, 17),
(18, 18),
(18, 21),
(18, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposusuarios`
--

DROP TABLE IF EXISTS `gruposusuarios`;
CREATE TABLE IF NOT EXISTS `gruposusuarios` (
  `idPersona` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  PRIMARY KEY (`idPersona`,`idGrupo`),
  KEY `fk_Grupos_idx` (`idGrupo`),
  KEY `fk_personas_idx` (`idPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gruposusuarios`
--

INSERT INTO `gruposusuarios` (`idPersona`, `idGrupo`) VALUES
(10, 18),
(11, 18),
(12, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `idMarca` int(11) NOT NULL AUTO_INCREMENT,
  `nombreMarca` varchar(45) NOT NULL,
  PRIMARY KEY (`idMarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`idMarca`, `nombreMarca`) VALUES
(3, 'ilolay'),
(4, 'serenisima'),
(5, 'cocacola'),
(6, 'fanta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE IF NOT EXISTS `paises` (
  `idPais` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosproveedores`
--

DROP TABLE IF EXISTS `pedidosproveedores`;
CREATE TABLE IF NOT EXISTS `pedidosproveedores` (
  `idPedidoProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `idProveedor` int(11) NOT NULL,
  `LegajoEmpleado` varchar(45) NOT NULL,
  `FechaPedido` date NOT NULL,
  PRIMARY KEY (`idPedidoProveedor`),
  KEY `fk_PedidoProveedor_idx` (`idProveedor`),
  KEY `fk_pedidoEmpleado_idx` (`LegajoEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `idPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePermiso` varchar(45) NOT NULL,
  PRIMARY KEY (`idPermiso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idPermiso`, `nombrePermiso`) VALUES
(1, 'alta producto'),
(2, 'baja producto'),
(3, 'modificar producto'),
(4, 'buscar producto'),
(5, 'realizar envios'),
(6, 'buscar proveedores'),
(7, 'alta proveedor'),
(8, 'baja proveedor'),
(9, 'modificar proveedor'),
(10, 'realizar pedidos'),
(11, 'reportes de stock'),
(12, 'reportes de caducidad'),
(13, 'reportes de ventas'),
(14, 'buscar usuarios'),
(15, 'alta usuario'),
(16, 'baja usuario'),
(17, 'modificar usuario'),
(18, 'asignar permisos'),
(19, 'eliminar cliente'),
(20, 'modificar cliente'),
(21, 'listar cliente'),
(22, 'notificar cliente'),
(23, 'crear estante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE IF NOT EXISTS `personas` (
  `idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `numDocumento` int(11) NOT NULL,
  `idTipoDocumento` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `fechaNac` date NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `contrasenia` varchar(45) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idPersona`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `fk_tipo_idx` (`idTipoDocumento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idPersona`, `numDocumento`, `idTipoDocumento`, `nombre`, `apellido`, `fechaNac`, `usuario`, `contrasenia`, `token`) VALUES
(10, 408474312, 1, 'Fabricio', 'Colavella', '1997-12-09', 'Fabricolavella', 'b279b7f4d0bc48a7660f007ae7983154b706ac57', NULL),
(11, 37200769, 1, 'walter', 'martinez', '1995-06-21', 'Waltermartinez', 'a213f9e4f1dbdba548d256335dc57bf65404210a', NULL),
(12, 95180213, 1, 'Esthefany', 'Graterox', '1997-08-20', 'Esthefanyg', '44f14b2ad2fa68bd07ccb6008d67ba4450b87ab3', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personascontactos`
--

DROP TABLE IF EXISTS `personascontactos`;
CREATE TABLE IF NOT EXISTS `personascontactos` (
  `idPersonaContacto` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `idTipoContacto` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idPersonaContacto`),
  KEY `fk_telPer_idx` (`idPersona`),
  KEY `fk_tipo_idx` (`idTipoContacto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `personascontactos`
--

INSERT INTO `personascontactos` (`idPersonaContacto`, `idPersona`, `idTipoContacto`, `descripcion`) VALUES
(7, 11, 1, 'martinezw@gmail.com'),
(8, 11, 2, '1145742345'),
(15, 10, 1, 'colavella22@gmail.com'),
(16, 10, 2, '1140397424');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `idPuestoFisico` int(11) NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `Lote` varchar(45) NOT NULL,
  `fechaCaducidad` date NOT NULL,
  `cantidadProd` int(11) NOT NULL,
  `precio` float NOT NULL,
  `estado` varchar(100) NOT NULL,
  PRIMARY KEY (`idProducto`),
  UNIQUE KEY `idPuestoFisico` (`idPuestoFisico`),
  KEY `FK_Fisico_idx` (`idPuestoFisico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `descripcion`, `idPuestoFisico`, `imagen`, `Lote`, `fechaCaducidad`, `cantidadProd`, `precio`, `estado`) VALUES
(19, 'leche entera', 21, 'leche1.jpg', 'l34526', '2020-08-30', 4, 78, 'Activo'),
(20, 'coca 2 1/4', 6, 'coca 225.jpg', '5896352146', '2020-08-27', 5, 120, 'Activo'),
(21, 'coca 3 litros', 13, 'coca 225.jpg', 'L95683252', '2020-08-27', 10, 130, 'Inactivo'),
(34, 'fanta', 7, 'coca 225.jpg', 'wa221', '2020-08-21', 21, 22, 'Activo'),
(35, 'leche Serenisima', 8, 'serenisima.jpg', 'asd', '2020-08-27', 21, 34, 'Activo'),
(36, 'chocolatada', 25, 'index.jpg', 'asd2134', '2020-08-27', 41, 445, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos-proveedores`
--

DROP TABLE IF EXISTS `productos-proveedores`;
CREATE TABLE IF NOT EXISTS `productos-proveedores` (
  `idProveedor` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `precioCompra` double NOT NULL,
  PRIMARY KEY (`idProveedor`,`idProducto`),
  KEY `fk_Proveedor_idx` (`idProveedor`),
  KEY `fk_Producto_idx` (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productostpmarcas`
--

DROP TABLE IF EXISTS `productostpmarcas`;
CREATE TABLE IF NOT EXISTS `productostpmarcas` (
  `idProducto` int(11) NOT NULL,
  `idTpMarca` int(11) NOT NULL,
  KEY `idProducto` (`idProducto`),
  KEY `idTpMarca` (`idTpMarca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productostpmarcas`
--

INSERT INTO `productostpmarcas` (`idProducto`, `idTpMarca`) VALUES
(19, 1),
(20, 3),
(21, 3),
(34, 4),
(35, 2),
(36, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(45) NOT NULL,
  `dirección` varchar(45) NOT NULL,
  `cuit` varchar(11) NOT NULL,
  `descripción` varchar(200) NOT NULL,
  PRIMARY KEY (`idProveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `empresa`, `dirección`, `cuit`, `descripción`) VALUES
(1, 'sdsf', 'afafaf', '225626', 'wetwtw'),
(2, 'wrqrtwsf', 'q4qrqr', '67432674', 'eyeyey'),
(3, 'wwtwtwrq', 'wtwtwt', '473214', 'wrwrwr');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

DROP TABLE IF EXISTS `provincias`;
CREATE TABLE IF NOT EXISTS `provincias` (
  `idProvincia` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `idpaises` int(11) NOT NULL,
  PRIMARY KEY (`idProvincia`),
  KEY `fk_pais_idx` (`idpaises`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestofisico`
--

DROP TABLE IF EXISTS `puestofisico`;
CREATE TABLE IF NOT EXISTS `puestofisico` (
  `idPuestoFisico` int(11) NOT NULL AUTO_INCREMENT,
  `estante` varchar(45) NOT NULL,
  `fila` int(11) NOT NULL,
  `columna` int(11) NOT NULL,
  PRIMARY KEY (`idPuestoFisico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `puestofisico`
--

INSERT INTO `puestofisico` (`idPuestoFisico`, `estante`, `fila`, `columna`) VALUES
(6, 'A', 1, 1),
(7, 'A', 1, 2),
(8, 'A', 1, 3),
(9, 'A', 2, 1),
(10, 'A', 2, 2),
(11, 'A', 2, 3),
(12, 'A', 3, 1),
(13, 'A', 3, 2),
(14, 'A', 3, 3),
(15, 'B', 1, 1),
(16, 'B', 1, 2),
(17, 'B', 1, 3),
(18, 'B', 2, 1),
(19, 'B', 2, 2),
(20, 'B', 2, 3),
(21, 'B', 3, 1),
(22, 'B', 3, 2),
(23, 'B', 3, 3),
(24, 'B', 4, 1),
(25, 'B', 4, 2),
(26, 'B', 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `idStock` int(11) NOT NULL AUTO_INCREMENT,
  `LegajoEmpleado` varchar(45) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idTipoMovimiento` int(11) NOT NULL,
  `fechaMovimiento` date NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `idPedidoProveedor` int(11) DEFAULT NULL,
  `idFacturaVenta` int(11) DEFAULT NULL,
  PRIMARY KEY (`idStock`),
  KEY `fk_producto_idx` (`idProducto`),
  KEY `fkTipoMovimiento_idx` (`idTipoMovimiento`),
  KEY `fk_empleado_idx` (`LegajoEmpleado`),
  KEY `fk_pedidoProveedor_idx` (`idPedidoProveedor`),
  KEY `fk_egresoVenta_idx` (`idFacturaVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetascliente`
--

DROP TABLE IF EXISTS `tarjetascliente`;
CREATE TABLE IF NOT EXISTS `tarjetascliente` (
  `idTarjetaCliente` int(11) NOT NULL AUTO_INCREMENT,
  `numTarjeta` int(11) NOT NULL,
  `idTipoTarjeta` int(11) NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `idPersona` int(11) NOT NULL,
  `codBanco` varchar(45) NOT NULL,
  PRIMARY KEY (`idTarjetaCliente`),
  KEY `fk_tipoTarjeta_idx` (`idTipoTarjeta`),
  KEY `fk_personas_idx` (`idPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposcontactos`
--

DROP TABLE IF EXISTS `tiposcontactos`;
CREATE TABLE IF NOT EXISTS `tiposcontactos` (
  `idTipoContacto` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idTipoContacto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tiposcontactos`
--

INSERT INTO `tiposcontactos` (`idTipoContacto`, `descripcion`) VALUES
(1, 'email'),
(2, 'telefono');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposdocumentos`
--

DROP TABLE IF EXISTS `tiposdocumentos`;
CREATE TABLE IF NOT EXISTS `tiposdocumentos` (
  `idTipoDocumento` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idTipoDocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tiposdocumentos`
--

INSERT INTO `tiposdocumentos` (`idTipoDocumento`, `descripcion`) VALUES
(1, 'DNI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposdomicilios`
--

DROP TABLE IF EXISTS `tiposdomicilios`;
CREATE TABLE IF NOT EXISTS `tiposdomicilios` (
  `idTipoDomicilio` int(11) NOT NULL AUTO_INCREMENT,
  `descripción` varchar(45) NOT NULL,
  PRIMARY KEY (`idTipoDomicilio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposmovientos`
--

DROP TABLE IF EXISTS `tiposmovientos`;
CREATE TABLE IF NOT EXISTS `tiposmovientos` (
  `idTipoMoviento` int(11) NOT NULL AUTO_INCREMENT,
  `nombreMovimiento` varchar(45) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`idTipoMoviento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposproductos`
--

DROP TABLE IF EXISTS `tiposproductos`;
CREATE TABLE IF NOT EXISTS `tiposproductos` (
  `idTipoProducto` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idTipoProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tiposproductos`
--

INSERT INTO `tiposproductos` (`idTipoProducto`, `descripcion`) VALUES
(5, 'lacteos'),
(6, 'bebidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposproductos_marcas`
--

DROP TABLE IF EXISTS `tiposproductos_marcas`;
CREATE TABLE IF NOT EXISTS `tiposproductos_marcas` (
  `idTpMarca` int(11) NOT NULL AUTO_INCREMENT,
  `idMarca` int(11) NOT NULL,
  `idTipoProducto` int(11) NOT NULL,
  PRIMARY KEY (`idTpMarca`),
  KEY `idTpMarca` (`idTpMarca`),
  KEY `idMarca` (`idMarca`),
  KEY `idTipoProducto` (`idTipoProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tiposproductos_marcas`
--

INSERT INTO `tiposproductos_marcas` (`idTpMarca`, `idMarca`, `idTipoProducto`) VALUES
(1, 3, 5),
(2, 4, 5),
(3, 5, 6),
(4, 6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipostarjetas`
--

DROP TABLE IF EXISTS `tipostarjetas`;
CREATE TABLE IF NOT EXISTS `tipostarjetas` (
  `idTipoTarjeta` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idTipoTarjeta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `fk_provincias` FOREIGN KEY (`idProvincia`) REFERENCES `provincias` (`idProvincia`);

--
-- Filtros para la tabla `contactosproveedores`
--
ALTER TABLE `contactosproveedores`
  ADD CONSTRAINT `fk_proveedor` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`),
  ADD CONSTRAINT `fk_tipoTelefono0` FOREIGN KEY (`idTipoContacto`) REFERENCES `tiposcontactos` (`idTipoContacto`);

--
-- Filtros para la tabla `detallespedidos`
--
ALTER TABLE `detallespedidos`
  ADD CONSTRAINT `fk_DetalleCompraProducto` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `fk_DetalleFacturaCompra` FOREIGN KEY (`idPedidoProveedor`) REFERENCES `pedidosproveedores` (`idPedidoProveedor`);

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `fk_ciudad` FOREIGN KEY (`idCiudad`) REFERENCES `ciudades` (`idCiudad`),
  ADD CONSTRAINT `fk_domicilio` FOREIGN KEY (`idTipoDomicilio`) REFERENCES `tiposdomicilios` (`idTipoDomicilio`),
  ADD CONSTRAINT `fk_persona` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_personaEmp` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`);

--
-- Filtros para la tabla `facturadetalles`
--
ALTER TABLE `facturadetalles`
  ADD CONSTRAINT `fk_Factura` FOREIGN KEY (`idFactura`) REFERENCES `facturas` (`idFacturaVenta`),
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fkPersonaFac` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`);

--
-- Filtros para la tabla `grupospermisos`
--
ALTER TABLE `grupospermisos`
  ADD CONSTRAINT `fk_Grupo` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`idGrupo`),
  ADD CONSTRAINT `fk_permisos` FOREIGN KEY (`idPermiso`) REFERENCES `permisos` (`idPermiso`);

--
-- Filtros para la tabla `gruposusuarios`
--
ALTER TABLE `gruposusuarios`
  ADD CONSTRAINT `fk_Grupos` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`idGrupo`),
  ADD CONSTRAINT `fk_personasGrupo` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`);

--
-- Filtros para la tabla `pedidosproveedores`
--
ALTER TABLE `pedidosproveedores`
  ADD CONSTRAINT `fk_pedidoEmpleado` FOREIGN KEY (`LegajoEmpleado`) REFERENCES `empleados` (`LegajoEmpleado`),
  ADD CONSTRAINT `fk_PedidoProveedor` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`idTipoDocumento`) REFERENCES `tiposdocumentos` (`idTipoDocumento`);

--
-- Filtros para la tabla `personascontactos`
--
ALTER TABLE `personascontactos`
  ADD CONSTRAINT `fk_telPer` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`),
  ADD CONSTRAINT `fk_tipoTelefono` FOREIGN KEY (`idTipoContacto`) REFERENCES `tiposcontactos` (`idTipoContacto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_Fisico` FOREIGN KEY (`idPuestoFisico`) REFERENCES `puestofisico` (`idPuestoFisico`);

--
-- Filtros para la tabla `productos-proveedores`
--
ALTER TABLE `productos-proveedores`
  ADD CONSTRAINT `fk_ProductoLista` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `fk_ProveedorLista` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`);

--
-- Filtros para la tabla `productostpmarcas`
--
ALTER TABLE `productostpmarcas`
  ADD CONSTRAINT `fktpmpMarca` FOREIGN KEY (`idTpMarca`) REFERENCES `tiposproductos_marcas` (`idTpMarca`),
  ADD CONSTRAINT `fkTpMprod` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `fk_pais` FOREIGN KEY (`idpaises`) REFERENCES `paises` (`idPais`);

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fkTipoMovimiento` FOREIGN KEY (`idTipoMovimiento`) REFERENCES `tiposmovientos` (`idTipoMoviento`),
  ADD CONSTRAINT `fk_egresoVenta` FOREIGN KEY (`idFacturaVenta`) REFERENCES `facturas` (`idFacturaVenta`),
  ADD CONSTRAINT `fk_empleado` FOREIGN KEY (`LegajoEmpleado`) REFERENCES `empleados` (`LegajoEmpleado`),
  ADD CONSTRAINT `fk_pedidoProveedorStock` FOREIGN KEY (`idPedidoProveedor`) REFERENCES `pedidosproveedores` (`idPedidoProveedor`),
  ADD CONSTRAINT `fk_producto1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `tarjetascliente`
--
ALTER TABLE `tarjetascliente`
  ADD CONSTRAINT `fk_personas` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`),
  ADD CONSTRAINT `fk_tipoTarjeta` FOREIGN KEY (`idTipoTarjeta`) REFERENCES `tipostarjetas` (`idTipoTarjeta`);

--
-- Filtros para la tabla `tiposproductos_marcas`
--
ALTER TABLE `tiposproductos_marcas`
  ADD CONSTRAINT `fktpMarcaTp` FOREIGN KEY (`idTipoProducto`) REFERENCES `tiposproductos` (`idTipoProducto`),
  ADD CONSTRAINT `fkTpMarca` FOREIGN KEY (`idMarca`) REFERENCES `marcas` (`idMarca`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
