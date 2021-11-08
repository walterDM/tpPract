-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2021 a las 14:54:33
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tppract`
--
CREATE DATABASE IF NOT EXISTS `tppract` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tppract`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
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
(16, 'Ticul', 7),
(17, 'Banfield', 5),
(18, 'Lomas de Zamora', 5),
(19, 'Moreno', 5),
(20, 'San Isidro', 5),
(21, 'Quilmes', 5),
(22, 'Palermo', 9),
(23, 'Recoleta', 9),
(24, 'Puerto Madero', 9),
(25, 'Retiro', 9),
(26, 'Belgrano', 9),
(27, 'Barracas', 9),
(28, 'Boedo', 9),
(29, 'Caballito', 9),
(30, 'Flores', 9),
(31, 'Villa del parque', 9),
(32, 'Almagro', 9),
(33, 'Parque Patricios', 9),
(34, 'Monserrat', 9),
(35, 'São Gonçalo', 33),
(36, 'Duque de Caxias', 33),
(37, 'Nova Iguaçu', 33),
(38, 'Alto Teresópolis', 34),
(39, 'Bela Vista', 34),
(40, 'Azenha', 34),
(41, 'San Fernando del Valle', 22),
(42, 'Las Juntas', 22),
(43, 'El Rodeo', 22),
(45, 'Resistencia', 16),
(46, 'Charata', 16),
(47, 'General Vedia', 16),
(48, 'Comodoro Rivadavia', 20),
(49, 'Bahia Bustamante', 20),
(50, 'El Hoyo', 20),
(51, 'Carlos paz', 10),
(52, 'Ciudad de cordoba', 10),
(53, 'Embalse', 10),
(54, 'Rio Tercero', 10),
(55, 'Corrientes Capital', 17),
(56, 'Colonia Pellegirni', 17),
(57, 'Goya', 17),
(58, 'Purmamarca', 19),
(59, 'Hornillos', 19),
(60, 'Tilcara', 19),
(61, 'Mendoza Capital', 11),
(62, 'Lujan de Cuyo', 11),
(63, 'Godoy Cruz', 11),
(64, 'San Martin', 11),
(65, 'Bernado de Irigoyen', 18),
(66, 'Campo grande', 18),
(67, '25 de Mayo', 18),
(68, 'Centenario', 14),
(69, 'Andacollo', 14),
(70, 'Formosa Capital', 13),
(71, 'General Manuel Belgrano', 13),
(72, 'Cafayate', 15),
(73, 'San Carlos', 15),
(74, 'Cabra Corral', 15),
(75, 'Rivadavia', 12),
(76, 'General San Martín', 12),
(77, 'Caucete', 12),
(78, 'Pellegrini', 21),
(79, 'Alberdi', 21),
(80, 'Boa Vista', 37),
(81, 'Sebastião Pereira', 37),
(82, 'Pompílio Marques', 37),
(83, 'Santos', 36),
(84, 'Santo André', 36),
(85, 'São José dos Campos', 36),
(86, 'Cruzeiro', 35),
(87, 'Novo Mundo', 35),
(88, 'Boqueirão', 35),
(89, 'Iztapalapa', 23),
(90, 'Miguel Hidalgo', 23),
(91, 'Benito Juárez', 23),
(92, 'San Juan de Guadalupe', 25),
(93, 'Tamazula', 25),
(94, 'Mezquital', 25),
(95, 'Acapulco', 28),
(96, 'Taxco', 28),
(97, 'Ciudad Altamirano', 28),
(98, 'Ahuazotepec', 24),
(99, 'Ajalpan', 24),
(100, 'Aquixtla', 24),
(101, 'Colonia Chiapaneca Siglo XXI', 26),
(102, 'San José (La Gota de Oro)', 26),
(103, 'Puerto Morelos', 26),
(104, 'Coatzacoalcos', 27),
(105, 'Orizaba', 27),
(106, 'Palos Blancos', 38),
(107, 'Calamarca', 38),
(108, 'Tiahuanacu', 38),
(109, 'Quillacollo', 39),
(110, 'Chimoré', 39),
(111, 'Tacopaya', 39),
(112, 'Viña del Mar', 42),
(113, 'Casa Blanca', 42),
(114, 'Cerrillos', 41),
(115, 'El Bosque', 41),
(116, 'Ciudad Bolívar', 43),
(117, 'Antonio Nariño', 43),
(118, 'Kennedy', 43),
(119, 'Cali-Aguacatal', 45),
(120, 'Cauca Sur', 45),
(121, 'Comuna 1 - Popular', 44),
(122, 'Comuna -13', 44),
(123, 'La Concepción', 46),
(124, 'San Roque ', 46),
(125, 'San Luis', 46),
(126, 'Sucre', 47),
(127, 'Ayacucho', 47),
(128, 'Luque', 50),
(129, 'Fernando de la Mora', 50),
(130, 'Ciudad del Este', 51),
(131, 'Doctor Raúl Peña', 51),
(132, 'Villa Maria Del Triunfo', 52),
(133, 'San Juan de Miraflores', 52),
(134, 'San Sebastián ', 53),
(135, 'Saylla', 53),
(136, 'Caricuao', 40),
(137, 'Candelaria', 40),
(138, 'Caucagüita', 40),
(139, ' San Francisco', 54),
(140, 'Miranda', 54),
(141, 'Punta ballena', 31),
(142, 'Hipódromo', 31),
(143, 'Ciudad Vieja', 29),
(144, 'Barrio Sur', 29),
(145, 'Jose Ignacio', 32),
(146, ' Carmelo', 30),
(147, 'El Semillero', 30),
(148, 'Almirante ', 49),
(149, 'Changuinola', 49),
(150, 'Alcalde Díaz', 48),
(151, 'Alto de la Estancia', 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactosproveedores`
--

DROP TABLE IF EXISTS `contactosproveedores`;
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
(1, 3, 1, 'losmolinos@gmail.com'),
(2, 3, 2, '1165789001'),
(11, 4, 1, 'macrosa@gmail.com'),
(12, 4, 2, '1149876543'),
(18, 5, 1, 'gradesdulces@gmail.com'),
(19, 5, 2, '1123456579'),
(40, 6, 1, 'empresa23@gmail.com'),
(41, 6, 2, '1143235466'),
(46, 7, 1, 'consultaphpedi@gmail.com'),
(47, 7, 2, '1143869579'),
(48, 8, 1, 'nuevoamancersa@gmail.com'),
(49, 8, 2, '1123432345'),
(54, 9, 1, 'mayoristasa@yahoo.com'),
(55, 9, 2, '1123433632'),
(72, 2, 1, 'losgalgos@gmail.com'),
(73, 2, 2, '1123435678'),
(74, 1, 1, 'colavella22@gmail.com'),
(75, 1, 2, '1123456789');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosfacturas`
--

DROP TABLE IF EXISTS `datosfacturas`;
CREATE TABLE `datosfacturas` (
  `idFactura` int(11) NOT NULL,
  `idTipoFactura` int(11) NOT NULL DEFAULT 3,
  `idTipoTransaccion` int(11) NOT NULL DEFAULT 1,
  `numFactura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datosfacturas`
--

INSERT INTO `datosfacturas` (`idFactura`, `idTipoFactura`, `idTipoTransaccion`, `numFactura`) VALUES
(8, 3, 1, 200),
(10, 3, 1, 201),
(11, 3, 1, 202),
(12, 3, 1, 203),
(13, 3, 1, 204),
(14, 3, 1, 205),
(15, 3, 1, 206),
(16, 3, 1, 207),
(17, 3, 1, 208),
(18, 3, 1, 209),
(19, 3, 1, 210),
(20, 3, 1, 211),
(21, 3, 1, 212),
(22, 3, 1, 213),
(23, 3, 1, 214),
(24, 3, 1, 215),
(25, 3, 1, 216),
(26, 3, 1, 217),
(27, 3, 1, 218),
(28, 3, 1, 219),
(29, 3, 1, 220),
(30, 3, 1, 221),
(31, 3, 1, 222),
(32, 3, 1, 223),
(33, 3, 1, 224),
(34, 3, 1, 225),
(35, 3, 1, 226),
(36, 3, 1, 227),
(37, 3, 1, 228),
(38, 3, 1, 229);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallespedidos`
--

DROP TABLE IF EXISTS `detallespedidos`;
CREATE TABLE `detallespedidos` (
  `idPedidoProveedor` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detallespedidos`
--

INSERT INTO `detallespedidos` (`idPedidoProveedor`, `idProducto`, `cantidad`) VALUES
(5, 34, 2),
(6, 34, 3),
(7, 34, 2),
(8, 34, 2),
(9, 34, 2),
(10, 34, 2),
(11, 34, 7),
(11, 36, 2),
(12, 34, 1),
(13, 34, 4),
(13, 36, 4),
(14, 34, 5),
(14, 36, 1),
(15, 36, 3),
(15, 34, 4),
(16, 36, 3),
(16, 34, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
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
(9, 9, 16, 1, 'Alsina', 1191, '', ''),
(10, 9, 16, 1, 'Zeballos', 124, '', ''),
(11, 10, 17, 2, 'Manuel Estevez', 4321, '', ''),
(12, 9, 18, 2, 'Gorriti', 2365, '', ''),
(18, 9, 20, 1, 'Lavalle', 1190, '', ''),
(23, 9, 12, 1, 'Cazón', 242, 'H', '3'),
(24, 9, 19, 2, 'Sarmiento ', 1154, '', ''),
(25, 9, 23, 2, 'Lacarra', 1201, '4', '2'),
(27, 9, 24, 1, 'Gral Guemes', 1000, '5', '8'),
(29, 9, 25, 2, 'Leandro Alem ', 1000, 'G', '2'),
(33, 9, 14, 1, 'Florentino Ameghino', 22, '2', '2'),
(34, 15, 15, 2, 'belgrano', 1358, '', ''),
(35, 9, 21, 2, 'Diaz Velez ', 1358, '', ''),
(36, 9, 11, 2, 'Av.Belgrano', 34, 'E', '4'),
(37, 9, 10, 2, '25 de Mayo', 343, 'B', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccionesprov`
--

DROP TABLE IF EXISTS `direccionesprov`;
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
(1, 9, 5, 2, 'Alicia moreu de justo', 1860, '5', '2'),
(12, 10, 6, 1, 'Beron estrada', 324, '', ''),
(15, 9, 7, 1, 'La plata', 5964, '', ''),
(18, 9, 9, 1, 'Estevez', 1000, '', '2'),
(29, 10, 2, 1, 'Amancio Alcorta', 1800, '', ''),
(30, 17, 3, 1, 'Belgrano', 1850, '', ''),
(31, 29, 4, 1, 'Avenida Rivadavia', 1500, '', ''),
(32, 10, 1, 1, 'Cnel Maure', 100, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `LegajoEmpleado` varchar(45) NOT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`LegajoEmpleado`, `idPersona`) VALUES
('29200139', 10),
('292001399', 10),
('292001400', 11),
('34765', 12),
('2002', 14),
('2342', 15),
('423451', 19),
('29200400', 20),
('12384', 21),
('42332', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `idEstado` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstado`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadospedidos`
--

DROP TABLE IF EXISTS `estadospedidos`;
CREATE TABLE `estadospedidos` (
  `idPedidoProveedor` int(11) NOT NULL,
  `idContactoProveedor` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadospedidos`
--

INSERT INTO `estadospedidos` (`idPedidoProveedor`, `idContactoProveedor`, `idEstado`) VALUES
(15, 74, 2),
(16, 74, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturadetalles`
--

DROP TABLE IF EXISTS `facturadetalles`;
CREATE TABLE `facturadetalles` (
  `idFactura` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioUnitario` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturadetalles`
--

INSERT INTO `facturadetalles` (`idFactura`, `idProducto`, `cantidad`, `precioUnitario`) VALUES
(8, 36, 1, 445),
(9, 36, 1, 445),
(10, 36, 1, 445),
(11, 36, 2, 445),
(12, 20, 2, 120),
(12, 37, 2, 23),
(13, 21, 2, 130),
(14, 20, 3, 120),
(14, 21, 2, 130),
(15, 44, 2, 55),
(16, 36, 2, 445),
(17, 36, 1, 445),
(18, 20, 3, 120),
(18, 36, 25, 445),
(19, 63, 3, 155),
(20, 63, 3, 155),
(20, 84, 3, 105),
(21, 36, 4, 445),
(21, 55, 1, 330),
(22, 36, 4, 445),
(22, 55, 1, 330),
(23, 36, 4, 445),
(23, 55, 1, 330),
(24, 63, 4, 155),
(25, 62, 1, 155),
(26, 62, 1, 155),
(27, 36, 1, 445),
(28, 63, 1, 155),
(29, 77, 1, 165),
(30, 63, 1, 155),
(31, 69, 1, 98),
(32, 50, 4, 145),
(32, 55, 1, 330),
(32, 56, 4, 185),
(32, 65, 3, 145),
(32, 72, 4, 95),
(32, 92, 1, 450),
(33, 78, 3, 95),
(33, 80, 1, 115),
(34, 55, 4, 330),
(34, 56, 11, 185),
(34, 63, 3, 155),
(34, 65, 1, 145),
(34, 72, 1, 95),
(34, 75, 1, 95),
(35, 62, 1, 155),
(35, 63, 1, 155),
(35, 65, 1, 145),
(36, 50, 1, 145),
(36, 55, 5, 330),
(36, 56, 3, 185),
(36, 69, 1, 98),
(36, 72, 1, 95),
(37, 36, 1, 445),
(37, 50, 1, 145),
(37, 55, 1, 330),
(37, 56, 1, 185),
(37, 63, 1, 155),
(37, 75, 1, 95),
(37, 76, 1, 95),
(38, 55, 1, 330);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

DROP TABLE IF EXISTS `facturas`;
CREATE TABLE `facturas` (
  `idFacturaVenta` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `totalApagar` double NOT NULL,
  `fechaPedido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idFacturaVenta`, `idPersona`, `totalApagar`, `fechaPedido`) VALUES
(8, 11, 445, '2020-11-17'),
(9, 11, 445, '2020-11-17'),
(10, 11, 445, '2020-11-17'),
(11, 11, 445, '2020-11-17'),
(12, 11, 286, '2020-11-17'),
(13, 20, 260, '2020-11-17'),
(14, 20, 620, '2020-11-17'),
(15, 20, 110, '2020-11-18'),
(16, 10, 11125, '2021-07-16'),
(17, 23, 445, '2021-07-16'),
(18, 25, 11485, '2021-07-16'),
(19, 10, 465, '2021-08-02'),
(20, 10, 780, '2021-08-02'),
(21, 10, 2110, '2021-08-02'),
(22, 10, 2110, '2021-08-02'),
(23, 10, 2110, '2021-08-02'),
(24, 10, 620, '2021-08-02'),
(25, 10, 155, '2021-08-03'),
(26, 10, 155, '2021-08-03'),
(27, 10, 445, '2021-08-03'),
(28, 10, 155, '2021-08-03'),
(29, 10, 165, '2021-08-03'),
(30, 10, 155, '2021-08-03'),
(31, 10, 98, '2021-08-03'),
(32, 10, 2915, '2021-08-03'),
(33, 10, 400, '2021-08-04'),
(34, 10, 4155, '2021-08-04'),
(35, 10, 455, '2021-08-05'),
(36, 10, 2543, '2021-08-21'),
(37, 10, 1450, '2021-10-29'),
(38, 10, 330, '2021-10-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestiones`
--

DROP TABLE IF EXISTS `gestiones`;
CREATE TABLE `gestiones` (
  `idGestiones` int(11) NOT NULL,
  `nombreGestion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gestiones`
--

INSERT INTO `gestiones` (`idGestiones`, `nombreGestion`) VALUES
(1, 'gestion productos'),
(2, 'gestion proveedores'),
(3, 'gestion usuarios '),
(4, 'gestion reportes'),
(5, 'gestion clientes'),
(6, 'gestion carrito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestiones_permisos`
--

DROP TABLE IF EXISTS `gestiones_permisos`;
CREATE TABLE `gestiones_permisos` (
  `idPermiso` int(11) NOT NULL,
  `idGestiones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gestiones_permisos`
--

INSERT INTO `gestiones_permisos` (`idPermiso`, `idGestiones`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(7, 2),
(8, 2),
(9, 2),
(6, 2),
(10, 2),
(15, 3),
(16, 3),
(17, 3),
(14, 3),
(21, 3),
(18, 3),
(12, 4),
(11, 4),
(13, 4),
(24, 6),
(25, 6),
(26, 5),
(27, 5),
(20, 5),
(29, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos` (
  `idGrupo` int(11) NOT NULL,
  `nombreGrupo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`idGrupo`, `nombreGrupo`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'CLIENTES'),
(3, 'EMPLEADO DE DEPOSITO'),
(4, 'ENCARGADO DE CLIENTES'),
(5, 'VENDEDOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupospermisos`
--

DROP TABLE IF EXISTS `grupospermisos`;
CREATE TABLE `grupospermisos` (
  `idGrupo` int(11) NOT NULL,
  `idPermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupospermisos`
--

INSERT INTO `grupospermisos` (`idGrupo`, `idPermiso`) VALUES
(1, 18),
(1, 26),
(1, 1),
(1, 7),
(1, 15),
(1, 25),
(1, 27),
(1, 2),
(1, 8),
(1, 16),
(1, 4),
(1, 6),
(1, 14),
(1, 14),
(1, 23),
(1, 19),
(1, 21),
(1, 20),
(1, 3),
(1, 9),
(1, 17),
(1, 22),
(1, 5),
(1, 10),
(1, 12),
(1, 11),
(1, 13),
(1, 29),
(2, 24),
(2, 29),
(2, 25),
(1, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposusuarios`
--

DROP TABLE IF EXISTS `gruposusuarios`;
CREATE TABLE `gruposusuarios` (
  `idPersona` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gruposusuarios`
--

INSERT INTO `gruposusuarios` (`idPersona`, `idGrupo`) VALUES
(10, 1),
(11, 1),
(12, 1),
(23, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE `marcas` (
  `idMarca` int(11) NOT NULL,
  `nombreMarca` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`idMarca`, `nombreMarca`) VALUES
(1, 'Sprite'),
(3, 'Ilolay'),
(4, 'Serenisima'),
(5, 'Coca cola'),
(6, 'Fanta'),
(7, 'Marolio'),
(8, 'Favorita'),
(9, 'Sancor'),
(10, 'Manaos'),
(11, 'Pepsi'),
(12, 'Activia'),
(13, 'La Paulina'),
(14, 'Milkaut'),
(15, 'Luchetti'),
(16, 'Cif'),
(17, 'Ayudin'),
(18, 'Poet'),
(19, 'Procenex'),
(20, 'Colgate'),
(21, 'Guaymayen'),
(22, 'Arcor'),
(23, 'Milka'),
(24, 'Oreo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises` (
  `idPais` int(11) NOT NULL,
  `nombrePais` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`idPais`, `nombrePais`) VALUES
(1, 'Argentina'),
(2, 'Mexico'),
(3, 'Uruguay'),
(4, 'Paraguay'),
(5, 'Brasil'),
(6, 'Bolivia'),
(7, 'Chile'),
(8, 'Colombia'),
(9, 'Venezuela'),
(10, 'Panama'),
(11, 'Peru'),
(12, 'Ecuador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosproveedores`
--

DROP TABLE IF EXISTS `pedidosproveedores`;
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
(2, 2, '29200400', '2020-11-18'),
(5, 1, '292001399', '2021-08-02'),
(6, 1, '292001399', '2021-08-02'),
(7, 1, '292001399', '2021-08-02'),
(8, 1, '292001399', '2021-08-02'),
(9, 1, '292001399', '2021-08-02'),
(10, 1, '292001399', '2021-08-02'),
(11, 1, '292001399', '2021-08-02'),
(12, 1, '292001399', '2021-08-02'),
(13, 1, '292001399', '2021-08-02'),
(14, 1, '292001399', '2021-08-02'),
(15, 1, '292001399', '2021-08-02'),
(16, 1, '292001399', '2021-08-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
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
(23, 'crear estante'),
(24, 'alta carrito'),
(25, 'baja carrito'),
(26, 'alta cliente'),
(27, 'baja cliente'),
(28, 'modificar cliente'),
(29, 'ver perfil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `idPersona` int(11) NOT NULL,
  `numDocumento` int(11) NOT NULL,
  `idTipoDocumento` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `fechaNac` date NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `contrasenia` varchar(45) NOT NULL,
  `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idPersona`, `numDocumento`, `idTipoDocumento`, `nombre`, `apellido`, `fechaNac`, `usuario`, `contrasenia`, `idEstado`) VALUES
(10, 40847431, 1, 'Fabricio', 'Colavella', '1997-12-09', 'Fabricolavella', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(11, 37200769, 1, 'walter', 'martinez', '1995-06-21', 'Waltermartinez', '6095f7790353eb1d6407d958bf97c18d6fd052d6', 1),
(12, 95180213, 1, 'Esthefany', 'Graterox', '1997-08-20', 'Esthefanyg', '8cb2237d0679ca88db6464eac60da96345513964', 1),
(14, 21543256, 1, 'Lucas', 'Perez', '1998-01-10', 'Lucasp', 'b279b7f4d0bc48a7660f007ae7983154b706ac57', 1),
(15, 23345443, 1, 'Oscar ', 'Quintero', '2002-07-15', 'Oscarq', '8cb2237d0679ca88db6464eac60da96345513964', 1),
(16, 25669365, 1, 'Pablo', 'Gonzalez', '1998-09-10', 'PabloGonzalez', '7088f91898a8b3f32260d7c6ea3a04828bf53fb2', 2),
(17, 23631935, 1, 'Angel', 'Garcia', '1980-06-29', 'AngelG', 'e9a9eeb2e0e2d7a11629cbd38ebcb8db0ee52dec', 1),
(18, 20345679, 1, 'gonzalo', 'Jara', '2002-11-05', 'jarag', 'c8a4c46985fc4832bce1d24a3f555ab6bd397323', 1),
(19, 27807643, 1, 'Carlos', 'Jara', '2001-11-08', 'cjara', 'c8a4c46985fc4832bce1d24a3f555ab6bd397323', 1),
(20, 32709542, 1, 'Juan', 'Perez', '1978-11-05', 'juanP', 'd96dbce9b3a3a2a2165a9bd59cdd59bc2078cf77', 1),
(21, 23567899, 1, 'Miguel', 'Perez', '1994-02-11', 'miguelP', '1bc47f1f9397d59445930db7ac383b78ff70341d', 1),
(22, 12345679, 1, 'Camilo', 'Morales', '1990-09-28', 'CamiloMorales', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(23, 12345677, 1, 'Chester', 'Bennigton', '1990-06-29', 'chester24', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(24, 94282522, 1, 'Anabella', 'Hernandez', '1989-06-29', 'AnabellaH', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2),
(25, 27890435, 1, 'Florencia', 'Soriano', '2000-07-14', 'FlorenciaS', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personascontactos`
--

DROP TABLE IF EXISTS `personascontactos`;
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
(39, 16, 1, 'consultaphpedi@gmail.com'),
(40, 16, 2, '47659585'),
(41, 17, 1, 'garciaangel@gmail.com'),
(42, 17, 2, '42366495'),
(43, 18, 1, 'GonzaJ@gmail.com'),
(44, 18, 2, '1154769811'),
(55, 20, 1, 'Perezjuan@gmail.com'),
(56, 20, 2, '1169256498'),
(65, 12, 1, 'mercedesgraterox@gmail.com'),
(66, 12, 2, '1146829453'),
(67, 22, 1, 'moralescamilo@gmail.com'),
(68, 22, 2, '1135353524'),
(69, 19, 1, 'carlosjara@gmail.com'),
(70, 19, 2, '42369568'),
(71, 23, 1, 'chester@gmail.com'),
(72, 23, 2, '1123456789'),
(75, 24, 1, 'florsoriano@gmail.com'),
(76, 24, 2, '125643246'),
(79, 25, 1, 'florsoriano@gmail.com'),
(80, 25, 2, '1123467867'),
(87, 14, 1, 'lucasPerez@gmail.com'),
(88, 14, 2, '1124560789'),
(89, 15, 1, 'quintero_oscar@gmail.com'),
(90, 15, 2, '22233445'),
(91, 21, 1, 'miguelperezem@gmail.com'),
(92, 21, 2, '1159987552'),
(93, 11, 1, 'consultaphpedi@gmail.com'),
(94, 11, 2, '1145742345'),
(95, 10, 1, 'colavella22@gmail.com'),
(96, 10, 2, '1140397424');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `idPuestoFisico` int(11) NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `Lote` varchar(45) NOT NULL,
  `fechaCaducidad` date NOT NULL,
  `cantidadProd` int(11) NOT NULL,
  `precio` float NOT NULL,
  `idEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `descripcion`, `idPuestoFisico`, `imagen`, `Lote`, `fechaCaducidad`, `cantidadProd`, `precio`, `idEstado`) VALUES
(19, 'Leche entera', 21, 'leche1.jpg', 'l34526', '2020-08-30', 5, 78, 2),
(20, 'coca 2 1/4', 6, 'coca 225.jpg', 'L234567', '2020-08-27', 3, 120, 2),
(21, 'Coca Cola 3 Litros', 13, 'coca3lts.jpg', 'L958776', '2020-08-27', 10, 130, 2),
(34, 'Fanta', 7, 'fanta225.jpg', 'L278906', '2020-08-21', 21, 22, 2),
(35, 'Leche clasica', 8, 'serenisima.jpg', 'L203465', '2020-08-27', 5, 34, 2),
(36, 'Chocolatada', 25, 'index.jpg', 'L203458', '2020-08-27', 22, 445, 1),
(37, 'Manteca 200gr', 9, '', 'L102345', '2020-11-10', 31, 54, 2),
(39, 'Fanta', 11, 'fanta225.jpg', 'L098765', '2020-11-12', 32, 43, 2),
(42, 'Capelettis', 15, '', 'L875645', '2020-11-13', 12, 32, 2),
(43, 'Coca Cola', 16, 'coca 225.jpg', 'L567809', '2021-11-11', 23, 113, 2),
(44, 'Marolio spaghetti', 14, 'marolio1.jpg', 'L956321', '2022-01-18', 20, 55, 2),
(45, 'Mostachol 500gr', 10, 'marolio2jpg.jpg', 'L526398', '2021-08-18', 32, 45, 2),
(46, 'Tirabuzón 500gr', 12, 'favorita1.jpg', 'L452169', '2021-09-18', 25, 65, 2),
(47, 'Fideos Largos', 22, 'fidio.jpg', 'L567887', '2021-07-07', 2, 2, 2),
(48, 'Crema de leche', 19, 'ilolayl.jpeg', 'L133456', '2021-07-29', 2, 100, 2),
(49, 'Manteca Clasica', 18, 'matecaserenisina200gr.png', 'L678906', '2021-12-27', 10, 62, 2),
(50, 'Queso Crema', 17, 'lapaulinaquesocrema.png', 'L654321', '2022-01-26', 39, 145, 1),
(51, 'Dulce de Leche Familiar', 23, 'lapaulinadulcedeleche.jpg', 'L654429', '2021-12-30', 50, 135, 1),
(52, 'Manteca Clásica 100gr', 26, 'mantecalapaulina.jpg', 'L086754', '2022-02-04', 35, 75, 1),
(53, 'Queso Rallado 40gr', 20, 'quesorallado40g.jpg', 'L678906', '2022-02-03', 40, 110, 1),
(54, 'Queso Cremoso Doble Crema', 24, 'quesocremosolapaulina.jpg', 'L654321', '2021-11-26', 35, 225, 1),
(55, 'Queso Cremón', 27, 'serenisimaquesocremon.jpg', 'L6780956', '2021-11-24', 12, 330, 1),
(56, 'Queso Crema', 28, 'queso-crema-clasico-finlandia.jpg', 'L432156', '2021-12-27', 14, 185, 1),
(59, 'Crema de Leche', 29, 'Cremadelechemilkaut.jpg', 'L345678', '2021-12-15', 40, 165, 1),
(60, 'Sprite 1lts', 30, 'Gaseosa-Sprite.jpg', 'L908765', '2023-01-26', 60, 145, 1),
(61, 'Sprite x500 cc', 31, 'sprite600.jpg', 'L075641', '2022-11-26', 30, 75, 1),
(62, 'Coca Cola 2Lts', 32, 'cocacola2lts.jpg', 'L876788', '2022-06-26', 57, 155, 1),
(63, 'Coca Cola Zer', 33, 'cocacolazero.jpg', 'L980112', '2022-12-26', 28, 155, 1),
(65, 'Fanta 2Lts', 34, 'fanta.png', 'L456213', '2021-12-15', 60, 145, 1),
(66, 'Fanta x400 ml', 35, 'fantachica.jpg', 'L789065', '2022-09-21', 35, 75, 1),
(67, 'Fanta Lata x350 ml', 36, 'fantaenlata.jpg', 'L042345', '2022-07-26', 46, 65, 1),
(68, 'Manaos 2Lts', 37, 'manaos.jpg', '', '2022-08-26', 55, 120, 1),
(69, 'Coditos 500gr', 38, 'coditoluchetti.jpg', 'L890102', '2021-11-26', 53, 98, 1),
(70, 'Tallarín 500gr', 39, 'tallarinluchetti.jpg', 'L903456', '2022-01-01', 35, 105, 1),
(71, 'Nido Fettuccine 500gr', 40, 'fetucine.jpg', 'L786213', '2021-12-30', 60, 105, 1),
(72, 'Spaghetti 500gr', 41, 'spaguetifavorita.jpg', 'L675412', '2022-07-26', 42, 95, 1),
(73, 'Tirabuzón 500gr', 42, 'tirabuzonfav.jpg', 'L689760', '2021-12-15', 30, 90, 1),
(74, 'Cabello de Angel 500gr', 43, 'cabellodengelmariolio.jpg', 'L034523', '2021-12-03', 50, 95, 2),
(75, 'Mostachol 500gr', 44, 'mostacholmarolio.jpg', 'L980876', '2022-06-22', 53, 95, 1),
(76, 'Tallarín 500gr', 45, 'tallarinmarolio.jpg', '', '2022-08-11', 59, 95, 1),
(77, 'Cif Crema Limpiadora', 46, 'cifcrema.jpg', 'L456701', '2022-12-13', 54, 165, 1),
(78, 'Detergente', 47, 'cifdetergente.jpg', 'L012302', '2022-12-07', 67, 95, 1),
(79, 'Lavandina 1Lts', 48, 'lavandinaayudin.jpg', 'L450405', '2022-12-30', 70, 75, 1),
(80, 'Spray Ultrabrillo', 49, 'spraycif.png', 'L084561', '2023-07-27', 99, 115, 1),
(81, 'Cif Antigrasa', 50, 'cifantigrasa.png', '', '2022-08-27', 70, 135, 1),
(82, 'Cif en Gel 2 en 1', 51, 'cifgel.jpg', 'L567123', '2023-11-27', 80, 175, 1),
(83, 'Lavandina 2Lts', 52, 'lavandinaayudin2lts.jpg', 'L034598', '2023-06-27', 67, 98, 1),
(84, 'Limpiador Liquido Anti-hongos', 53, 'ayudinliquido.jpg', 'L609075', '2022-07-27', 84, 105, 1),
(85, 'Aerosol Desinfectante', 54, 'aerosoldesinfectateayudin.png', 'L341253', '2023-06-27', 68, 155, 1),
(86, 'Poet Aerosol de Lavanda', 55, 'poetlavanda.jpg', '', '2022-08-31', 95, 160, 1),
(87, 'Limpiador de piso Fragancia primavera 1,5Lts', 56, 'Poetprimavera.jpg', '', '2023-12-18', 105, 95, 1),
(88, 'Colgate Ultra Blanco', 57, 'colgate.jpg', 'L093452', '2023-01-27', 105, 110, 1),
(89, 'Antidesgrasante', 58, 'antigrasaprocenex.png', 'L012983', '2022-08-27', 95, 125, 1),
(90, 'Limpiador de Vidrios', 59, 'limpiadordebrillos.jpg', 'L081234', '2023-11-16', 78, 90, 1),
(91, 'Bon o Bon Tradicional 24 Unidades', 60, 'bonobontradicional.jpg', 'L019023', '2023-01-27', 65, 450, 1),
(92, 'Bon o Bon Chocolate Blanco 24 Unidades', 61, 'bonobonblanco.png', 'L092385', '2022-12-28', 79, 450, 1),
(93, 'fideo mostachol', 62, 'fideoMos.jpg', 'a1209834', '2021-08-26', 25, 75, 2),
(94, 'pure de tomates marolio', 65, 'pure de tomate marolio.jpg', 'a1209833', '2021-09-25', 30, 75, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productostpmarcas`
--

DROP TABLE IF EXISTS `productostpmarcas`;
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
(20, 9, 3, 32),
(21, 9, 3, 42),
(34, 1, 4, 44),
(35, 4, 2, 56),
(36, 1, 1, 25),
(37, 2, 3, 23),
(42, 3, 3, 32),
(43, 6, 3, 113),
(44, 3, 5, 55),
(45, 3, 5, 45),
(46, 4, 6, 65),
(47, 3, 3, 2),
(48, 2, 1, 89),
(49, 2, 2, 62),
(50, 2, 12, 85),
(51, 2, 12, 135),
(52, 2, 12, 75),
(53, 2, 12, 110),
(54, 2, 12, 225),
(55, 2, 2, 330),
(56, 2, 2, 350),
(59, 2, 13, 110),
(60, 9, 8, 145),
(61, 9, 8, 75),
(62, 9, 3, 155),
(63, 9, 3, 155),
(65, 9, 4, 145),
(66, 9, 4, 75),
(67, 9, 4, 65),
(68, 9, 9, 120),
(69, 3, 6, 95),
(70, 3, 14, 105),
(71, 3, 14, 105),
(72, 3, 6, 95),
(73, 3, 6, 85),
(74, 3, 5, 95),
(75, 3, 5, 95),
(76, 3, 5, 95),
(77, 10, 15, 165),
(78, 10, 15, 95),
(79, 10, 16, 75),
(80, 10, 15, 115),
(81, 10, 15, 135),
(82, 10, 15, 145),
(83, 10, 16, 98),
(84, 10, 16, 105),
(85, 10, 16, 155),
(86, 10, 17, 160),
(87, 10, 17, 95),
(88, 10, 18, 110),
(89, 10, 19, 125),
(90, 10, 19, 90),
(91, 5, 21, 450),
(92, 5, 21, 450),
(93, 3, 6, 75),
(94, 2, 25, 75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_proveedores`
--

DROP TABLE IF EXISTS `productos_proveedores`;
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

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL,
  `empresa` varchar(45) NOT NULL,
  `cuit` varchar(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `idEstado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `empresa`, `cuit`, `descripcion`, `idEstado`) VALUES
(1, 'Mayorista Villa del sur', '30603456789', 'Bebidas sin gas, agua mineral', 1),
(2, 'Mayorista de Lacteos Los Galgos', '30678093459', 'Lacteos', 1),
(3, 'Mayorista de Pastas Los Molinos ', '30276987659', 'Pastas', 1),
(4, 'Mayorista Legumbres Macro', '30678908989', 'Legumbres', 1),
(5, 'Mayorista Grandes Dulces', '30678657379', 'Golosinas', 1),
(6, 'Mayorista de Limpieza Grandes hermanos', '38756899863', 'Articulos de limpieza', 2),
(7, 'Mayorista bebidas con alcohol Nueva Luna', '30355869577', 'Bebidas con alcohol', 2),
(8, 'Mayorista de Embutidos Nuevo Amanecer', '30525252539', 'Embutidos, fiambres', 2),
(9, 'Mayorista Gaseosas ', '30789750679', 'Gaseosas', 1),
(10, 'Mayorista Margo-Limpieza', '30670809899', 'Productos de limpieza', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

DROP TABLE IF EXISTS `provincias`;
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
(7, 'Yucatan', 2),
(8, 'Sinaloa', 2),
(9, 'Capital Federal', 1),
(10, 'Cordoba', 1),
(11, 'Mendoza', 1),
(12, 'San Juan', 1),
(13, 'Formosa', 1),
(14, 'Neuquen', 1),
(15, 'Salta', 1),
(16, 'Chaco', 1),
(17, 'Corrientes', 1),
(18, 'Misiones', 1),
(19, 'Jujuy', 1),
(20, 'Chubut', 1),
(21, 'Santiago del Estero', 1),
(22, 'Catamarca', 1),
(23, 'Ciudad de Mexico', 2),
(24, 'Puebla', 2),
(25, 'Durango', 2),
(26, 'Quintana Roo', 2),
(27, 'Veracruz', 2),
(28, 'Guerrero', 2),
(29, 'Montevideo', 3),
(30, 'Colonia', 3),
(31, 'Maldonado', 3),
(32, 'Punta del Este', 3),
(33, 'Rio de Janeiro', 5),
(34, 'Porto Alegre', 5),
(35, 'Curitiba', 5),
(36, 'Sao Pablo', 5),
(37, 'Brasilia', 5),
(38, 'La Paz', 6),
(39, 'Cochabamba', 6),
(40, 'Caracas', 9),
(41, 'Santiago de Chile', 7),
(42, 'Valparaiso', 7),
(43, 'Bogotá', 8),
(44, 'Medellin', 8),
(45, 'Cali', 8),
(46, 'Quito', 12),
(47, 'Guayaquil', 12),
(48, 'Ciudad de Panama', 10),
(49, 'Bocas del Toro', 10),
(50, 'Asuncion', 4),
(51, 'Alto Paraná', 4),
(52, 'Lima', 11),
(53, 'Cusco', 11),
(54, 'Maracaibo', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestofisico`
--

DROP TABLE IF EXISTS `puestofisico`;
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
(26, 'B', 4, 3),
(27, 'C', 1, 1),
(28, 'C', 1, 2),
(29, 'C', 1, 3),
(30, 'C', 1, 4),
(31, 'C', 1, 5),
(32, 'C', 1, 6),
(33, 'C', 1, 7),
(34, 'C', 1, 8),
(35, 'C', 1, 9),
(36, 'C', 1, 10),
(37, 'C', 1, 11),
(38, 'C', 1, 12),
(39, 'C', 2, 1),
(40, 'C', 2, 2),
(41, 'C', 2, 3),
(42, 'C', 2, 4),
(43, 'C', 2, 5),
(44, 'C', 2, 6),
(45, 'C', 2, 7),
(46, 'C', 2, 8),
(47, 'C', 2, 9),
(48, 'C', 2, 10),
(49, 'C', 2, 11),
(50, 'C', 2, 12),
(51, 'C', 3, 1),
(52, 'C', 3, 2),
(53, 'C', 3, 3),
(54, 'C', 3, 4),
(55, 'C', 3, 5),
(56, 'C', 3, 6),
(57, 'C', 3, 7),
(58, 'C', 3, 8),
(59, 'C', 3, 9),
(60, 'C', 3, 10),
(61, 'C', 3, 11),
(62, 'C', 3, 12),
(63, 'C', 4, 1),
(64, 'C', 4, 2),
(65, 'C', 4, 3),
(66, 'C', 4, 4),
(67, 'C', 4, 5),
(68, 'C', 4, 6),
(69, 'C', 4, 7),
(70, 'C', 4, 8),
(71, 'C', 4, 9),
(72, 'C', 4, 10),
(73, 'C', 4, 11),
(74, 'C', 4, 12),
(75, 'C', 5, 1),
(76, 'C', 5, 2),
(77, 'C', 5, 3),
(78, 'C', 5, 4),
(79, 'C', 5, 5),
(80, 'C', 5, 6),
(81, 'C', 5, 7),
(82, 'C', 5, 8),
(83, 'C', 5, 9),
(84, 'C', 5, 10),
(85, 'C', 5, 11),
(86, 'C', 5, 12),
(87, 'C', 6, 1),
(88, 'C', 6, 2),
(89, 'C', 6, 3),
(90, 'C', 6, 4),
(91, 'C', 6, 5),
(92, 'C', 6, 6),
(93, 'C', 6, 7),
(94, 'C', 6, 8),
(95, 'C', 6, 9),
(96, 'C', 6, 10),
(97, 'C', 6, 11),
(98, 'C', 6, 12),
(99, 'C', 7, 1),
(100, 'C', 7, 2),
(101, 'C', 7, 3),
(102, 'C', 7, 4),
(103, 'C', 7, 5),
(104, 'C', 7, 6),
(105, 'C', 7, 7),
(106, 'C', 7, 8),
(107, 'C', 7, 9),
(108, 'C', 7, 10),
(109, 'C', 7, 11),
(110, 'C', 7, 12),
(111, 'C', 8, 1),
(112, 'C', 8, 2),
(113, 'C', 8, 3),
(114, 'C', 8, 4),
(115, 'C', 8, 5),
(116, 'C', 8, 6),
(117, 'C', 8, 7),
(118, 'C', 8, 8),
(119, 'C', 8, 9),
(120, 'C', 8, 10),
(121, 'C', 8, 11),
(122, 'C', 8, 12),
(123, 'C', 9, 1),
(124, 'C', 9, 2),
(125, 'C', 9, 3),
(126, 'C', 9, 4),
(127, 'C', 9, 5),
(128, 'C', 9, 6),
(129, 'C', 9, 7),
(130, 'C', 9, 8),
(131, 'C', 9, 9),
(132, 'C', 9, 10),
(133, 'C', 9, 11),
(134, 'C', 9, 12),
(135, 'C', 10, 1),
(136, 'C', 10, 2),
(137, 'C', 10, 3),
(138, 'C', 10, 4),
(139, 'C', 10, 5),
(140, 'C', 10, 6),
(141, 'C', 10, 7),
(142, 'C', 10, 8),
(143, 'C', 10, 9),
(144, 'C', 10, 10),
(145, 'C', 10, 11),
(146, 'C', 10, 12),
(147, 'C', 11, 1),
(148, 'C', 11, 2),
(149, 'C', 11, 3),
(150, 'C', 11, 4),
(151, 'C', 11, 5),
(152, 'C', 11, 6),
(153, 'C', 11, 7),
(154, 'C', 11, 8),
(155, 'C', 11, 9),
(156, 'C', 11, 10),
(157, 'C', 11, 11),
(158, 'C', 11, 12),
(159, 'C', 12, 1),
(160, 'C', 12, 2),
(161, 'C', 12, 3),
(162, 'C', 12, 4),
(163, 'C', 12, 5),
(164, 'C', 12, 6),
(165, 'C', 12, 7),
(166, 'C', 12, 8),
(167, 'C', 12, 9),
(168, 'C', 12, 10),
(169, 'C', 12, 11),
(170, 'C', 12, 12),
(171, 'C', 1, 1),
(172, 'C', 1, 2),
(173, 'C', 1, 3),
(174, 'C', 1, 4),
(175, 'C', 1, 5),
(176, 'C', 1, 6),
(177, 'C', 1, 7),
(178, 'C', 1, 8),
(179, 'C', 1, 9),
(180, 'C', 2, 1),
(181, 'C', 2, 2),
(182, 'C', 2, 3),
(183, 'C', 2, 4),
(184, 'C', 2, 5),
(185, 'C', 2, 6),
(186, 'C', 2, 7),
(187, 'C', 2, 8),
(188, 'C', 2, 9),
(189, 'C', 3, 1),
(190, 'C', 3, 2),
(191, 'C', 3, 3),
(192, 'C', 3, 4),
(193, 'C', 3, 5),
(194, 'C', 3, 6),
(195, 'C', 3, 7),
(196, 'C', 3, 8),
(197, 'C', 3, 9),
(198, 'C', 4, 1),
(199, 'C', 4, 2),
(200, 'C', 4, 3),
(201, 'C', 4, 4),
(202, 'C', 4, 5),
(203, 'C', 4, 6),
(204, 'C', 4, 7),
(205, 'C', 4, 8),
(206, 'C', 4, 9),
(207, 'C', 5, 1),
(208, 'C', 5, 2),
(209, 'C', 5, 3),
(210, 'C', 5, 4),
(211, 'C', 5, 5),
(212, 'C', 5, 6),
(213, 'C', 5, 7),
(214, 'C', 5, 8),
(215, 'C', 5, 9),
(216, 'C', 6, 1),
(217, 'C', 6, 2),
(218, 'C', 6, 3),
(219, 'C', 6, 4),
(220, 'C', 6, 5),
(221, 'C', 6, 6),
(222, 'C', 6, 7),
(223, 'C', 6, 8),
(224, 'C', 6, 9),
(225, 'C', 7, 1),
(226, 'C', 7, 2),
(227, 'C', 7, 3),
(228, 'C', 7, 4),
(229, 'C', 7, 5),
(230, 'C', 7, 6),
(231, 'C', 7, 7),
(232, 'C', 7, 8),
(233, 'C', 7, 9),
(234, 'C', 8, 1),
(235, 'C', 8, 2),
(236, 'C', 8, 3),
(237, 'C', 8, 4),
(238, 'C', 8, 5),
(239, 'C', 8, 6),
(240, 'C', 8, 7),
(241, 'C', 8, 8),
(242, 'C', 8, 9),
(243, 'C', 9, 1),
(244, 'C', 9, 2),
(245, 'C', 9, 3),
(246, 'C', 9, 4),
(247, 'C', 9, 5),
(248, 'C', 9, 6),
(249, 'C', 9, 7),
(250, 'C', 9, 8),
(251, 'C', 9, 9),
(252, 'C', 10, 1),
(253, 'C', 10, 2),
(254, 'C', 10, 3),
(255, 'C', 10, 4),
(256, 'C', 10, 5),
(257, 'C', 10, 6),
(258, 'C', 10, 7),
(259, 'C', 10, 8),
(260, 'C', 10, 9),
(261, 'C', 11, 1),
(262, 'C', 11, 2),
(263, 'C', 11, 3),
(264, 'C', 11, 4),
(265, 'C', 11, 5),
(266, 'C', 11, 6),
(267, 'C', 11, 7),
(268, 'C', 11, 8),
(269, 'C', 11, 9),
(270, 'C', 12, 1),
(271, 'C', 12, 2),
(272, 'C', 12, 3),
(273, 'C', 12, 4),
(274, 'C', 12, 5),
(275, 'C', 12, 6),
(276, 'C', 12, 7),
(277, 'C', 12, 8),
(278, 'C', 12, 9),
(279, 'C', 1, 1),
(280, 'C', 1, 2),
(281, 'C', 1, 3),
(282, 'C', 1, 4),
(283, 'C', 1, 5),
(284, 'C', 1, 6),
(285, 'C', 1, 7),
(286, 'C', 1, 8),
(287, 'C', 1, 9),
(288, 'C', 1, 10),
(289, 'C', 1, 11),
(290, 'C', 1, 12),
(291, 'C', 2, 1),
(292, 'C', 2, 2),
(293, 'C', 2, 3),
(294, 'C', 2, 4),
(295, 'C', 2, 5),
(296, 'C', 2, 6),
(297, 'C', 2, 7),
(298, 'C', 2, 8),
(299, 'C', 2, 9),
(300, 'C', 2, 10),
(301, 'C', 2, 11),
(302, 'C', 2, 12),
(303, 'C', 3, 1),
(304, 'C', 3, 2),
(305, 'C', 3, 3),
(306, 'C', 3, 4),
(307, 'C', 3, 5),
(308, 'C', 3, 6),
(309, 'C', 3, 7),
(310, 'C', 3, 8),
(311, 'C', 3, 9),
(312, 'C', 3, 10),
(313, 'C', 3, 11),
(314, 'C', 3, 12),
(315, 'C', 4, 1),
(316, 'C', 4, 2),
(317, 'C', 4, 3),
(318, 'C', 4, 4),
(319, 'C', 4, 5),
(320, 'C', 4, 6),
(321, 'C', 4, 7),
(322, 'C', 4, 8),
(323, 'C', 4, 9),
(324, 'C', 4, 10),
(325, 'C', 4, 11),
(326, 'C', 4, 12),
(327, 'C', 5, 1),
(328, 'C', 5, 2),
(329, 'C', 5, 3),
(330, 'C', 5, 4),
(331, 'C', 5, 5),
(332, 'C', 5, 6),
(333, 'C', 5, 7),
(334, 'C', 5, 8),
(335, 'C', 5, 9),
(336, 'C', 5, 10),
(337, 'C', 5, 11),
(338, 'C', 5, 12),
(339, 'C', 6, 1),
(340, 'C', 6, 2),
(341, 'C', 6, 3),
(342, 'C', 6, 4),
(343, 'C', 6, 5),
(344, 'C', 6, 6),
(345, 'C', 6, 7),
(346, 'C', 6, 8),
(347, 'C', 6, 9),
(348, 'C', 6, 10),
(349, 'C', 6, 11),
(350, 'C', 6, 12),
(351, 'C', 7, 1),
(352, 'C', 7, 2),
(353, 'C', 7, 3),
(354, 'C', 7, 4),
(355, 'C', 7, 5),
(356, 'C', 7, 6),
(357, 'C', 7, 7),
(358, 'C', 7, 8),
(359, 'C', 7, 9),
(360, 'C', 7, 10),
(361, 'C', 7, 11),
(362, 'C', 7, 12),
(363, 'C', 8, 1),
(364, 'C', 8, 2),
(365, 'C', 8, 3),
(366, 'C', 8, 4),
(367, 'C', 8, 5),
(368, 'C', 8, 6),
(369, 'C', 8, 7),
(370, 'C', 8, 8),
(371, 'C', 8, 9),
(372, 'C', 8, 10),
(373, 'C', 8, 11),
(374, 'C', 8, 12),
(375, 'C', 9, 1),
(376, 'C', 9, 2),
(377, 'C', 9, 3),
(378, 'C', 9, 4),
(379, 'C', 9, 5),
(380, 'C', 9, 6),
(381, 'C', 9, 7),
(382, 'C', 9, 8),
(383, 'C', 9, 9),
(384, 'C', 9, 10),
(385, 'C', 9, 11),
(386, 'C', 9, 12),
(387, 'C', 10, 1),
(388, 'C', 10, 2),
(389, 'C', 10, 3),
(390, 'C', 10, 4),
(391, 'C', 10, 5),
(392, 'C', 10, 6),
(393, 'C', 10, 7),
(394, 'C', 10, 8),
(395, 'C', 10, 9),
(396, 'C', 10, 10),
(397, 'C', 10, 11),
(398, 'C', 10, 12),
(399, 'C', 11, 1),
(400, 'C', 11, 2),
(401, 'C', 11, 3),
(402, 'C', 11, 4),
(403, 'C', 11, 5),
(404, 'C', 11, 6),
(405, 'C', 11, 7),
(406, 'C', 11, 8),
(407, 'C', 11, 9),
(408, 'C', 11, 10),
(409, 'C', 11, 11),
(410, 'C', 11, 12),
(411, 'C', 12, 1),
(412, 'C', 12, 2),
(413, 'C', 12, 3),
(414, 'C', 12, 4),
(415, 'C', 12, 5),
(416, 'C', 12, 6),
(417, 'C', 12, 7),
(418, 'C', 12, 8),
(419, 'C', 12, 9),
(420, 'C', 12, 10),
(421, 'C', 12, 11),
(422, 'C', 12, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `idStock` int(11) NOT NULL,
  `LegajoEmpleado` varchar(45) DEFAULT NULL,
  `idProducto` int(11) NOT NULL,
  `idTipoMovimiento` int(11) NOT NULL,
  `fechaMovimiento` date NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `idPedidoProveedor` int(11) NOT NULL,
  `idFacturaVenta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetascliente`
--

DROP TABLE IF EXISTS `tarjetascliente`;
CREATE TABLE `tarjetascliente` (
  `idTarjetaCliente` int(11) NOT NULL,
  `numTarjeta` varchar(16) NOT NULL,
  `idTipoTarjeta` int(11) NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `idPersona` int(11) NOT NULL,
  `codBanco` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tarjetascliente`
--

INSERT INTO `tarjetascliente` (`idTarjetaCliente`, `numTarjeta`, `idTipoTarjeta`, `fechaVencimiento`, `idPersona`, `codBanco`) VALUES
(1, '2145341', 0, '2021-10-06', 11, ''),
(2, '2147483647', 1, '2020-10-29', 16, ''),
(3, '2147483647', 1, '2022-10-18', 17, '259'),
(4, '2147483647', 1, '2021-11-03', 18, '231'),
(5, '2568956324127858', 1, '2021-01-16', 20, '263'),
(6, '6433346', 0, '2021-07-16', 10, '123'),
(7, '212334532', 0, '2021-07-09', 23, '1234'),
(8, '12344534', 0, '2021-07-22', 25, '1871'),
(9, '404567890987', 1, '2021-07-29', 12, '667');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoestados`
--

DROP TABLE IF EXISTS `tipoestados`;
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

DROP TABLE IF EXISTS `tiposcontactos`;
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

DROP TABLE IF EXISTS `tiposdocumentos`;
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

DROP TABLE IF EXISTS `tiposdomicilios`;
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
-- Estructura de tabla para la tabla `tiposfacturas`
--

DROP TABLE IF EXISTS `tiposfacturas`;
CREATE TABLE `tiposfacturas` (
  `idTipoFactura` int(11) NOT NULL,
  `descripcion` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposfacturas`
--

INSERT INTO `tiposfacturas` (`idTipoFactura`, `descripcion`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposmovientos`
--

DROP TABLE IF EXISTS `tiposmovientos`;
CREATE TABLE `tiposmovientos` (
  `idTipoMoviento` int(11) NOT NULL,
  `nombreMovimiento` varchar(45) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposproductos`
--

DROP TABLE IF EXISTS `tiposproductos`;
CREATE TABLE `tiposproductos` (
  `idTipoProducto` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tiposproductos`
--

INSERT INTO `tiposproductos` (`idTipoProducto`, `descripcion`) VALUES
(5, 'Lacteos'),
(6, 'Bebidas'),
(7, 'Pastas'),
(8, 'Productos de limpieza'),
(9, 'Golosinas'),
(10, 'salsas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposproductos_marcas`
--

DROP TABLE IF EXISTS `tiposproductos_marcas`;
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
(4, 6, 6),
(5, 7, 7),
(6, 8, 7),
(7, 9, 5),
(8, 1, 6),
(9, 10, 6),
(10, 11, 6),
(11, 12, 5),
(12, 13, 5),
(13, 14, 5),
(14, 15, 7),
(15, 16, 8),
(16, 17, 8),
(17, 18, 8),
(18, 20, 8),
(19, 19, 8),
(20, 21, 9),
(21, 22, 9),
(22, 21, 9),
(23, 23, 9),
(24, 24, 9),
(25, 7, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipostarjetas`
--

DROP TABLE IF EXISTS `tipostarjetas`;
CREATE TABLE `tipostarjetas` (
  `idTipoTarjeta` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipostarjetas`
--

INSERT INTO `tipostarjetas` (`idTipoTarjeta`, `descripcion`) VALUES
(0, 'Debito'),
(1, 'Credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipostransacciones`
--

DROP TABLE IF EXISTS `tipostransacciones`;
CREATE TABLE `tipostransacciones` (
  `idTipoTransaccion` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `Abreviacion` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipostransacciones`
--

INSERT INTO `tipostransacciones` (`idTipoTransaccion`, `descripcion`, `Abreviacion`) VALUES
(1, 'Ventas', 'V');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE `tokens` (
  `idToken` int(11) NOT NULL,
  `token` varchar(45) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_finalizacion` datetime DEFAULT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tokens`
--

INSERT INTO `tokens` (`idToken`, `token`, `fecha_inicio`, `fecha_finalizacion`, `idPersona`) VALUES
(2, '5fb572ac11735', '2020-11-18 16:14:52', '2020-11-18 16:16:52', 11),
(3, '60f0c5f39bed7', '2021-07-15 20:34:11', '2021-07-15 20:36:11', 10),
(4, '60f1dcedebf0b', '2021-07-16 16:24:29', '2021-07-16 16:26:29', 10),
(5, '60f1dd6c3131a', '2021-07-16 16:26:36', '2021-07-16 16:28:36', 10),
(6, '60f1dd9e049a6', '2021-07-16 16:27:26', '2021-07-16 16:29:26', 10),
(7, '60f1ddcb6622c', '2021-07-16 16:28:11', '2021-07-16 16:30:11', 10),
(9, '60f1ea7b34aea', '2021-07-16 17:22:19', '2021-07-16 17:24:19', 10),
(10, '60f1eb0fda38a', '2021-07-16 17:24:47', '2021-07-16 17:26:47', 10),
(11, '60f1ebb6e5c56', '2021-07-16 17:27:34', '2021-07-16 17:29:34', 10);

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
-- Indices de la tabla `datosfacturas`
--
ALTER TABLE `datosfacturas`
  ADD KEY `fk_TipoFacturaTFF` (`idTipoFactura`),
  ADD KEY `fk_TipoTransaccion` (`idTipoTransaccion`),
  ADD KEY `FK_FacturasTFF` (`idFactura`);

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
  ADD UNIQUE KEY `idCiudad` (`idCiudad`,`idProveedor`,`idTipoDomicilio`),
  ADD KEY `FK_dirPRov` (`idProveedor`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`LegajoEmpleado`),
  ADD KEY `fk_personaEmp_idx` (`idPersona`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `estadospedidos`
--
ALTER TABLE `estadospedidos`
  ADD KEY `idContactoProveedor` (`idContactoProveedor`),
  ADD KEY `idPedidoProveedor` (`idPedidoProveedor`);

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
  ADD KEY `FK_PersonaFactura` (`idPersona`);

--
-- Indices de la tabla `gestiones`
--
ALTER TABLE `gestiones`
  ADD PRIMARY KEY (`idGestiones`);

--
-- Indices de la tabla `gestiones_permisos`
--
ALTER TABLE `gestiones_permisos`
  ADD KEY `idPermiso` (`idPermiso`),
  ADD KEY `idGestiones` (`idGestiones`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idGrupo`);

--
-- Indices de la tabla `grupospermisos`
--
ALTER TABLE `grupospermisos`
  ADD KEY `idGrupo` (`idGrupo`),
  ADD KEY `idPermiso` (`idPermiso`);

--
-- Indices de la tabla `gruposusuarios`
--
ALTER TABLE `gruposusuarios`
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idGrupo` (`idGrupo`);

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
  ADD KEY `fk_tipo_idx` (`idTipoDocumento`),
  ADD KEY `idEstado` (`idEstado`);

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
  ADD KEY `FK_Fisico_idx` (`idPuestoFisico`),
  ADD KEY `fk_estadoProducto` (`idEstado`);

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
  ADD PRIMARY KEY (`idProveedor`),
  ADD KEY `fk_estadoProv` (`idEstado`);

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
-- Indices de la tabla `tiposfacturas`
--
ALTER TABLE `tiposfacturas`
  ADD PRIMARY KEY (`idTipoFactura`);

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
-- Indices de la tabla `tipostransacciones`
--
ALTER TABLE `tipostransacciones`
  ADD PRIMARY KEY (`idTipoTransaccion`);

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
  MODIFY `idCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- AUTO_INCREMENT de la tabla `contactosproveedores`
--
ALTER TABLE `contactosproveedores`
  MODIFY `idContactoProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `idDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `direccionesprov`
--
ALTER TABLE `direccionesprov`
  MODIFY `idDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idFacturaVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `gestiones`
--
ALTER TABLE `gestiones`
  MODIFY `idGestiones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `idPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedidosproveedores`
--
ALTER TABLE `pedidosproveedores`
  MODIFY `idPedidoProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `personascontactos`
--
ALTER TABLE `personascontactos`
  MODIFY `idPersonaContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `idProvincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `puestofisico`
--
ALTER TABLE `puestofisico`
  MODIFY `idPuestoFisico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `idStock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarjetascliente`
--
ALTER TABLE `tarjetascliente`
  MODIFY `idTarjetaCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT de la tabla `tiposfacturas`
--
ALTER TABLE `tiposfacturas`
  MODIFY `idTipoFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tiposmovientos`
--
ALTER TABLE `tiposmovientos`
  MODIFY `idTipoMoviento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposproductos`
--
ALTER TABLE `tiposproductos`
  MODIFY `idTipoProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tiposproductos_marcas`
--
ALTER TABLE `tiposproductos_marcas`
  MODIFY `idTpMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `tipostransacciones`
--
ALTER TABLE `tipostransacciones`
  MODIFY `idTipoTransaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `idToken` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Filtros para la tabla `datosfacturas`
--
ALTER TABLE `datosfacturas`
  ADD CONSTRAINT `FK_FacturasTFF` FOREIGN KEY (`idFactura`) REFERENCES `facturas` (`idFacturaVenta`),
  ADD CONSTRAINT `fk_TipoFacturaTFF` FOREIGN KEY (`idTipoFactura`) REFERENCES `tiposfacturas` (`idTipoFactura`),
  ADD CONSTRAINT `fk_TipoTransaccion` FOREIGN KEY (`idTipoTransaccion`) REFERENCES `tipostransacciones` (`idTipoTransaccion`);

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
-- Filtros para la tabla `direccionesprov`
--
ALTER TABLE `direccionesprov`
  ADD CONSTRAINT `FK_dirPRov` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`),
  ADD CONSTRAINT `FK_dirProvCiudad` FOREIGN KEY (`idCiudad`) REFERENCES `ciudades` (`idCiudad`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_personaEmp` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`);

--
-- Filtros para la tabla `estadospedidos`
--
ALTER TABLE `estadospedidos`
  ADD CONSTRAINT `estadospedidos_ibfk_1` FOREIGN KEY (`idPedidoProveedor`) REFERENCES `pedidosproveedores` (`idPedidoProveedor`),
  ADD CONSTRAINT `estadospedidos_ibfk_2` FOREIGN KEY (`idContactoProveedor`) REFERENCES `contactosproveedores` (`idContactoProveedor`);

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
  ADD CONSTRAINT `FK_PersonaFactura` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`),
  ADD CONSTRAINT `fkPersonaFac` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`);

--
-- Filtros para la tabla `gestiones_permisos`
--
ALTER TABLE `gestiones_permisos`
  ADD CONSTRAINT `gestiones_permisos_ibfk_1` FOREIGN KEY (`idPermiso`) REFERENCES `permisos` (`idPermiso`),
  ADD CONSTRAINT `gestiones_permisos_ibfk_2` FOREIGN KEY (`idGestiones`) REFERENCES `gestiones` (`idGestiones`);

--
-- Filtros para la tabla `grupospermisos`
--
ALTER TABLE `grupospermisos`
  ADD CONSTRAINT `grupospermisos_ibfk_1` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`idGrupo`),
  ADD CONSTRAINT `grupospermisos_ibfk_2` FOREIGN KEY (`idPermiso`) REFERENCES `permisos` (`idPermiso`);

--
-- Filtros para la tabla `gruposusuarios`
--
ALTER TABLE `gruposusuarios`
  ADD CONSTRAINT `gruposusuarios_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`),
  ADD CONSTRAINT `gruposusuarios_ibfk_2` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`idGrupo`);

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
  ADD CONSTRAINT `fk_estadoPersonas` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`),
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
  ADD CONSTRAINT `FK_Fisico` FOREIGN KEY (`idPuestoFisico`) REFERENCES `puestofisico` (`idPuestoFisico`),
  ADD CONSTRAINT `fk_estadoProducto` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`);

--
-- Filtros para la tabla `productostpmarcas`
--
ALTER TABLE `productostpmarcas`
  ADD CONSTRAINT `fk_IDPPROD` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
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
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `fk_estadoProv` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`);

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
