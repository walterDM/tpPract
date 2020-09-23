-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2020 a las 17:54:57
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tppract`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `idCiudad` int(11) NOT NULL,
  `nombreCiudad` varchar(45) DEFAULT NULL,
  `idProvincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idCiudad`, `nombreCiudad`, `idProvincia`) VALUES
(9, 'Avellaneda', 5),
(10, 'Lanus', 5),
(11, 'Concepcion', 6),
(12, 'San Miguel de Tucuman', 6),
(13, 'Culiacan', 8),
(14, 'Concordia', 8),
(15, 'Merida', 7),
(16, 'Ticul', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactosproveedores`
--

CREATE TABLE `contactosproveedores` (
  `idContactoProveedor` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idTipoContacto` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contactosproveedores`
--

INSERT INTO `contactosproveedores` (`idContactoProveedor`, `idProveedor`, `idTipoContacto`, `descripcion`) VALUES
(1, 3, 1, 'walter.m.d92@gmail.com'),
(2, 3, 2, '252525'),
(11, 4, 1, 'walter.m.d92@gmail.com'),
(12, 4, 2, '41414'),
(13, 1, 1, 'walter.m.d92@gmail.com'),
(14, 1, 2, '234556'),
(15, 2, 1, 'walter.m.d92@gmail.com'),
(16, 2, 2, '45697956'),
(17, 2, 2, '30004243'),
(18, 5, 1, 'prueba@hotmail.com'),
(19, 5, 2, '1123456579');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallespedidos`
--

CREATE TABLE `detallespedidos` (
  `idPedidoProveedor` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detallespedidos`
--

INSERT INTO `detallespedidos` (`idPedidoProveedor`, `idProducto`, `cantidad`) VALUES
(1, 36, 2),
(1, 20, 3),
(2, 36, 2),
(2, 20, 2),
(2, 34, 2),
(3, 36, 2),
(3, 20, 5),
(4, 19, 3),
(5, 21, 2),
(6, 36, 2),
(6, 20, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `idDireccion` int(11) NOT NULL,
  `idCiudad` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `idTipoDomicilio` int(11) NOT NULL,
  `calle` varchar(45) DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `dpto` varchar(45) DEFAULT NULL,
  `piso` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`idDireccion`, `idCiudad`, `idPersona`, `idTipoDomicilio`, `calle`, `altura`, `dpto`, `piso`) VALUES
(4, 14, 14, 1, 'afaafa', 22, '2', '2'),
(5, 9, 11, 2, 'gajdgaj', 34, 'e', '4'),
(6, 9, 12, 1, 'sfsf', 242, 'h', '3'),
(7, 9, 10, 2, 'dgd', 343, 't', '3'),
(8, 9, 15, 2, 'belgrano', 1358, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccionesprov`
--

CREATE TABLE `direccionesprov` (
  `idDireccion` int(11) NOT NULL,
  `idCiudad` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idTipoDomicilio` int(11) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `altura` int(11) NOT NULL,
  `depto` varchar(50) NOT NULL,
  `piso` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `direccionesprov`
--

INSERT INTO `direccionesprov` (`idDireccion`, `idCiudad`, `idProveedor`, `idTipoDomicilio`, `calle`, `altura`, `depto`, `piso`) VALUES
(1, 9, 5, 2, 'alicia moreu de justo', 1860, '5', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `LegajoEmpleado` varchar(45) NOT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`LegajoEmpleado`, `idPersona`) VALUES
('252525', 10),
('242424', 11),
('3476', 12),
('2515165', 14),
('2342', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadospedidos`
--

CREATE TABLE `estadospedidos` (
  `idPedidoProveedor` int(11) NOT NULL,
  `idContactoProveedor` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadospedidos`
--

INSERT INTO `estadospedidos` (`idPedidoProveedor`, `idContactoProveedor`, `idEstado`) VALUES
(1, 13, 2),
(2, 13, 2),
(4, 15, 2),
(3, 13, 2),
(5, 1, 2),
(6, 13, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturadetalles`
--

CREATE TABLE `facturadetalles` (
  `idFactura` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioUnidad` double NOT NULL,
  `precioTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `idFacturaVenta` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `totalApagar` double NOT NULL,
  `fechaPedido` date NOT NULL,
  `LegajoEmpleado` int(11) NOT NULL,
  `TipoFactura` int(11) NOT NULL,
  `NumeroFactura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas`
--

CREATE TABLE `fechas` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fechas`
--

INSERT INTO `fechas` (`id`, `fecha`) VALUES
(1, '0000-00-00 00:00:00'),
(2, '2020-09-01 13:08:55'),
(3, '0000-00-00 00:00:00'),
(4, '2020-09-01 14:43:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idGrupo` int(11) NOT NULL,
  `nombreGrupo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `grupospermisos` (
  `idGrupo` int(11) NOT NULL,
  `idPermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupospermisos`
--

INSERT INTO `grupospermisos` (`idGrupo`, `idPermiso`) VALUES
(18, 1),
(18, 2),
(18, 3),
(18, 4),
(18, 5),
(18, 6),
(18, 7),
(18, 8),
(18, 9),
(18, 10),
(18, 11),
(18, 12),
(18, 13),
(18, 14),
(18, 15),
(18, 16),
(18, 17),
(18, 18),
(18, 21),
(18, 23),
(20, 1),
(20, 2),
(20, 3),
(20, 4),
(20, 6),
(20, 7),
(20, 8),
(20, 9),
(20, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposusuarios`
--

CREATE TABLE `gruposusuarios` (
  `idPersona` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gruposusuarios`
--

INSERT INTO `gruposusuarios` (`idPersona`, `idGrupo`) VALUES
(10, 18),
(11, 18),
(12, 18),
(14, 18),
(15, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `idMarca` int(11) NOT NULL,
  `nombreMarca` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `paises` (
  `idPais` int(11) NOT NULL,
  `nombrePais` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`idPais`, `nombrePais`) VALUES
(1, 'Argentina'),
(2, 'Mexico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosproveedores`
--

CREATE TABLE `pedidosproveedores` (
  `idPedidoProveedor` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `LegajoEmpleado` varchar(45) NOT NULL,
  `FechaPedido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedidosproveedores`
--

INSERT INTO `pedidosproveedores` (`idPedidoProveedor`, `idProveedor`, `LegajoEmpleado`, `FechaPedido`) VALUES
(1, 1, '242424', '2020-09-16'),
(2, 1, '242424', '2020-09-16'),
(3, 1, '242424', '2020-09-16'),
(4, 2, '242424', '2020-09-16'),
(5, 3, '242424', '2020-09-16'),
(6, 1, '242424', '2020-09-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idPermiso` int(11) NOT NULL,
  `nombrePermiso` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `personas` (
  `idPersona` int(11) NOT NULL,
  `numDocumento` int(11) NOT NULL,
  `idTipoDocumento` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `fechaNac` date NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `contrasenia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idPersona`, `numDocumento`, `idTipoDocumento`, `nombre`, `apellido`, `fechaNac`, `usuario`, `contrasenia`) VALUES
(10, 408474312, 1, 'Fabricio', 'Colavella', '1997-12-09', 'Fabricolavella', 'b279b7f4d0bc48a7660f007ae7983154b706ac57'),
(11, 37200769, 1, 'walter', 'martinez', '1995-06-21', 'Waltermartinez', 'a213f9e4f1dbdba548d256335dc57bf65404210a'),
(12, 95180213, 1, 'Esthefany', 'Graterox', '1997-08-20', 'Esthefanyg', '44f14b2ad2fa68bd07ccb6008d67ba4450b87ab3'),
(14, 212621, 1, 'agagag', 'gaag', '2020-09-10', 'fabri3', 'b279b7f4d0bc48a7660f007ae7983154b706ac57'),
(15, 23345443, 1, 'Oscar ', 'quintero', '2002-07-15', 'practica', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personascontactos`
--

CREATE TABLE `personascontactos` (
  `idPersonaContacto` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `idTipoContacto` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personascontactos`
--

INSERT INTO `personascontactos` (`idPersonaContacto`, `idPersona`, `idTipoContacto`, `descripcion`) VALUES
(7, 11, 1, 'martinezw@gmail.com'),
(8, 11, 2, '1145742345'),
(15, 10, 1, 'colavella22@gmail.com'),
(16, 10, 2, '1140397424'),
(33, 14, 1, 'dqdq@gmail.com'),
(34, 14, 2, '242155'),
(35, 12, 1, 'esthefany@gmail.com'),
(36, 12, 2, '1146829453'),
(37, 15, 1, 'ejemplo@gmail.com'),
(38, 15, 2, '2223344');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `idPuestoFisico` int(11) NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `Lote` varchar(45) NOT NULL,
  `fechaCaducidad` date NOT NULL,
  `cantidadProd` int(11) NOT NULL,
  `precio` float NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `productostpmarcas`
--

CREATE TABLE `productostpmarcas` (
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idTpMarca` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productostpmarcas`
--

INSERT INTO `productostpmarcas` (`idProducto`, `idProveedor`, `idTpMarca`, `precio`) VALUES
(19, 2, 1, 22),
(20, 1, 3, 32),
(21, 3, 3, 42),
(34, 1, 4, 44),
(35, 4, 2, 56),
(36, 1, 1, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_proveedores`
--

CREATE TABLE `productos_proveedores` (
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos_proveedores`
--

INSERT INTO `productos_proveedores` (`idProducto`, `idProveedor`, `precio`) VALUES
(19, 1, 60),
(21, 1, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL,
  `empresa` varchar(45) NOT NULL,
  `cuit` varchar(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `empresa`, `cuit`, `descripcion`) VALUES
(1, 'zink', '225626', 'wetwtw'),
(2, 'pok', '67432674', 'eyeyey'),
(3, 'jink', '473214', 'wrwrwr'),
(4, 'camp', '4141414', 'afafaf'),
(5, 'prueba ', '30678657379', 'Golosinas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `idProvincia` int(11) NOT NULL,
  `nombreProvincia` varchar(45) DEFAULT NULL,
  `idPais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`idProvincia`, `nombreProvincia`, `idPais`) VALUES
(5, 'Buenos Aires', 1),
(6, 'Tucuman', 1),
(7, 'yucatan', 2),
(8, 'sinaloa', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestofisico`
--

CREATE TABLE `puestofisico` (
  `idPuestoFisico` int(11) NOT NULL,
  `estante` varchar(45) NOT NULL,
  `fila` int(11) NOT NULL,
  `columna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `stock` (
  `idStock` int(11) NOT NULL,
  `LegajoEmpleado` varchar(45) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idTipoMovimiento` int(11) NOT NULL,
  `fechaMovimiento` date NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `idPedidoProveedor` int(11) DEFAULT NULL,
  `idFacturaVenta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetascliente`
--

CREATE TABLE `tarjetascliente` (
  `idTarjetaCliente` int(11) NOT NULL,
  `numTarjeta` int(11) NOT NULL,
  `idTipoTarjeta` int(11) NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `idPersona` int(11) NOT NULL,
  `codBanco` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoestados`
--

CREATE TABLE `tipoestados` (
  `idEstado` int(11) NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipoestados`
--

INSERT INTO `tipoestados` (`idEstado`, `descripcion`) VALUES
(1, 'Pendiente'),
(2, 'Enviado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposcontactos`
--

CREATE TABLE `tiposcontactos` (
  `idTipoContacto` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `tiposdocumentos` (
  `idTipoDocumento` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
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

CREATE TABLE `tiposdomicilios` (
  `idTipoDomicilio` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tiposdomicilios`
--

INSERT INTO `tiposdomicilios` (`idTipoDomicilio`, `descripcion`) VALUES
(1, 'Trabajo'),
(2, 'Casa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposmovientos`
--

CREATE TABLE `tiposmovientos` (
  `idTipoMoviento` int(11) NOT NULL,
  `nombreMovimiento` varchar(45) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposproductos`
--

CREATE TABLE `tiposproductos` (
  `idTipoProducto` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `tiposproductos_marcas` (
  `idTpMarca` int(11) NOT NULL,
  `idMarca` int(11) NOT NULL,
  `idTipoProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `tipostarjetas` (
  `idTipoTarjeta` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `idToken` int(11) NOT NULL,
  `token` varchar(45) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_finalizacion` datetime DEFAULT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`idCiudad`),
  ADD KEY `idProvincia` (`idProvincia`);

--
-- Indices de la tabla `contactosproveedores`
--
ALTER TABLE `contactosproveedores`
  ADD PRIMARY KEY (`idContactoProveedor`),
  ADD KEY `fk_tipo_idx` (`idTipoContacto`),
  ADD KEY `fk_proveedor_idx` (`idProveedor`);

--
-- Indices de la tabla `detallespedidos`
--
ALTER TABLE `detallespedidos`
  ADD KEY `fk_detalleProducto` (`idProducto`),
  ADD KEY `fk_detallesPedidoProveedor` (`idPedidoProveedor`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`idDireccion`),
  ADD KEY `idCiudad` (`idCiudad`),
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idTipoDomicilio` (`idTipoDomicilio`);

--
-- Indices de la tabla `direccionesprov`
--
ALTER TABLE `direccionesprov`
  ADD PRIMARY KEY (`idDireccion`),
  ADD UNIQUE KEY `idCiudad` (`idCiudad`,`idProveedor`,`idTipoDomicilio`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`LegajoEmpleado`),
  ADD KEY `fk_personaEmp_idx` (`idPersona`);

--
-- Indices de la tabla `facturadetalles`
--
ALTER TABLE `facturadetalles`
  ADD PRIMARY KEY (`idFactura`,`idProducto`),
  ADD KEY `fk_producto_idx` (`idProducto`),
  ADD KEY `fk_Factura_idx` (`idFactura`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idFacturaVenta`),
  ADD KEY `fkPersonaFac_idx` (`idPersona`);

--
-- Indices de la tabla `fechas`
--
ALTER TABLE `fechas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idGrupo`);

--
-- Indices de la tabla `grupospermisos`
--
ALTER TABLE `grupospermisos`
  ADD PRIMARY KEY (`idGrupo`,`idPermiso`),
  ADD KEY `fk_permisos_idx` (`idPermiso`),
  ADD KEY `fk_Grupo_idx` (`idGrupo`);

--
-- Indices de la tabla `gruposusuarios`
--
ALTER TABLE `gruposusuarios`
  ADD PRIMARY KEY (`idPersona`,`idGrupo`),
  ADD KEY `fk_Grupos_idx` (`idGrupo`),
  ADD KEY `fk_personas_idx` (`idPersona`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`idPais`);

--
-- Indices de la tabla `pedidosproveedores`
--
ALTER TABLE `pedidosproveedores`
  ADD PRIMARY KEY (`idPedidoProveedor`),
  ADD KEY `fk_PedidoProveedor_idx` (`idProveedor`),
  ADD KEY `fk_pedidoEmpleado_idx` (`LegajoEmpleado`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idPermiso`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idPersona`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `fk_tipo_idx` (`idTipoDocumento`);

--
-- Indices de la tabla `personascontactos`
--
ALTER TABLE `personascontactos`
  ADD PRIMARY KEY (`idPersonaContacto`),
  ADD KEY `fk_telPer_idx` (`idPersona`),
  ADD KEY `fk_tipo_idx` (`idTipoContacto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD UNIQUE KEY `idPuestoFisico` (`idPuestoFisico`),
  ADD KEY `FK_Fisico_idx` (`idPuestoFisico`);

--
-- Indices de la tabla `productostpmarcas`
--
ALTER TABLE `productostpmarcas`
  ADD PRIMARY KEY (`idProducto`,`idProveedor`,`idTpMarca`),
  ADD KEY `fk_proeedortpmp` (`idProveedor`),
  ADD KEY `fk_tpmProdProv` (`idTpMarca`);

--
-- Indices de la tabla `productos_proveedores`
--
ALTER TABLE `productos_proveedores`
  ADD PRIMARY KEY (`idProducto`,`idProveedor`),
  ADD KEY `fk_proveedoresProd` (`idProveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`idProvincia`),
  ADD KEY `idPais` (`idPais`);

--
-- Indices de la tabla `puestofisico`
--
ALTER TABLE `puestofisico`
  ADD PRIMARY KEY (`idPuestoFisico`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idStock`),
  ADD KEY `fk_producto_idx` (`idProducto`),
  ADD KEY `fkTipoMovimiento_idx` (`idTipoMovimiento`),
  ADD KEY `fk_empleado_idx` (`LegajoEmpleado`),
  ADD KEY `fk_pedidoProveedor_idx` (`idPedidoProveedor`),
  ADD KEY `fk_egresoVenta_idx` (`idFacturaVenta`);

--
-- Indices de la tabla `tarjetascliente`
--
ALTER TABLE `tarjetascliente`
  ADD PRIMARY KEY (`idTarjetaCliente`),
  ADD KEY `fk_tipoTarjeta_idx` (`idTipoTarjeta`),
  ADD KEY `fk_personas_idx` (`idPersona`);

--
-- Indices de la tabla `tipoestados`
--
ALTER TABLE `tipoestados`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `tiposcontactos`
--
ALTER TABLE `tiposcontactos`
  ADD PRIMARY KEY (`idTipoContacto`);

--
-- Indices de la tabla `tiposdocumentos`
--
ALTER TABLE `tiposdocumentos`
  ADD PRIMARY KEY (`idTipoDocumento`);

--
-- Indices de la tabla `tiposdomicilios`
--
ALTER TABLE `tiposdomicilios`
  ADD PRIMARY KEY (`idTipoDomicilio`);

--
-- Indices de la tabla `tiposmovientos`
--
ALTER TABLE `tiposmovientos`
  ADD PRIMARY KEY (`idTipoMoviento`);

--
-- Indices de la tabla `tiposproductos`
--
ALTER TABLE `tiposproductos`
  ADD PRIMARY KEY (`idTipoProducto`);

--
-- Indices de la tabla `tiposproductos_marcas`
--
ALTER TABLE `tiposproductos_marcas`
  ADD PRIMARY KEY (`idTpMarca`),
  ADD KEY `idTpMarca` (`idTpMarca`),
  ADD KEY `idMarca` (`idMarca`),
  ADD KEY `idTipoProducto` (`idTipoProducto`);

--
-- Indices de la tabla `tipostarjetas`
--
ALTER TABLE `tipostarjetas`
  ADD PRIMARY KEY (`idTipoTarjeta`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`idToken`),
  ADD KEY `idPersona` (`idPersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `idCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `contactosproveedores`
--
ALTER TABLE `contactosproveedores`
  MODIFY `idContactoProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `idDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `direccionesprov`
--
ALTER TABLE `direccionesprov`
  MODIFY `idDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idFacturaVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fechas`
--
ALTER TABLE `fechas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `idPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidosproveedores`
--
ALTER TABLE `pedidosproveedores`
  MODIFY `idPedidoProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `personascontactos`
--
ALTER TABLE `personascontactos`
  MODIFY `idPersonaContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `idProvincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `puestofisico`
--
ALTER TABLE `puestofisico`
  MODIFY `idPuestoFisico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `idStock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarjetascliente`
--
ALTER TABLE `tarjetascliente`
  MODIFY `idTarjetaCliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoestados`
--
ALTER TABLE `tipoestados`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tiposcontactos`
--
ALTER TABLE `tiposcontactos`
  MODIFY `idTipoContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tiposdomicilios`
--
ALTER TABLE `tiposdomicilios`
  MODIFY `idTipoDomicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tiposmovientos`
--
ALTER TABLE `tiposmovientos`
  MODIFY `idTipoMoviento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposproductos`
--
ALTER TABLE `tiposproductos`
  MODIFY `idTipoProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tiposproductos_marcas`
--
ALTER TABLE `tiposproductos_marcas`
  MODIFY `idTpMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `idToken` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`idProvincia`) REFERENCES `provincias` (`idProvincia`);

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
  ADD CONSTRAINT `fk_detalleProducto` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `fk_detallesPedidoProveedor` FOREIGN KEY (`idPedidoProveedor`) REFERENCES `pedidosproveedores` (`idPedidoProveedor`);

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`idCiudad`) REFERENCES `ciudades` (`idCiudad`),
  ADD CONSTRAINT `direcciones_ibfk_2` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`),
  ADD CONSTRAINT `direcciones_ibfk_3` FOREIGN KEY (`idTipoDomicilio`) REFERENCES `tiposdomicilios` (`idTipoDomicilio`);

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
  ADD CONSTRAINT `fk_PedidoProveedor` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`),
  ADD CONSTRAINT `fk_pedidoEmpleado` FOREIGN KEY (`LegajoEmpleado`) REFERENCES `empleados` (`LegajoEmpleado`);

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
-- Filtros para la tabla `productostpmarcas`
--
ALTER TABLE `productostpmarcas`
  ADD CONSTRAINT `fk_productostpmP` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `fk_proeedortpmp` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`),
  ADD CONSTRAINT `fk_tpmProdProv` FOREIGN KEY (`idTpMarca`) REFERENCES `tiposproductos_marcas` (`idTpMarca`);

--
-- Filtros para la tabla `productos_proveedores`
--
ALTER TABLE `productos_proveedores`
  ADD CONSTRAINT `fk_productosProv` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `fk_proveedoresProd` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`);

--
-- Filtros para la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `provincias_ibfk_1` FOREIGN KEY (`idPais`) REFERENCES `paises` (`idPais`);

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
  ADD CONSTRAINT `fkTpMarca` FOREIGN KEY (`idMarca`) REFERENCES `marcas` (`idMarca`),
  ADD CONSTRAINT `fktpMarcaTp` FOREIGN KEY (`idTipoProducto`) REFERENCES `tiposproductos` (`idTipoProducto`);

--
-- Filtros para la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
