-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2022 a las 19:29:19
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restord`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonoscreditos`
--

CREATE TABLE `abonoscreditos` (
  `codabono` int(11) NOT NULL,
  `codventa` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcliente` int(11) NOT NULL,
  `montoabono` float(12,2) NOT NULL,
  `fechaabono` datetime NOT NULL,
  `codigo` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arqueocaja`
--

CREATE TABLE `arqueocaja` (
  `codarqueo` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `montoinicial` float(12,2) NOT NULL,
  `ingresos` float(12,2) NOT NULL,
  `egresos` float(12,2) NOT NULL,
  `dineroefectivo` float(12,2) NOT NULL,
  `diferencia` float(12,2) NOT NULL,
  `comentarios` text COLLATE utf8_spanish_ci NOT NULL,
  `fechaapertura` datetime NOT NULL,
  `fechacierre` datetime NOT NULL,
  `statusarqueo` int(2) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `arqueocaja`
--

INSERT INTO `arqueocaja` (`codarqueo`, `codcaja`, `montoinicial`, `ingresos`, `egresos`, `dineroefectivo`, `diferencia`, `comentarios`, `fechaapertura`, `fechacierre`, `statusarqueo`, `codigo`) VALUES
(1, 1, 100.00, 82776.00, 0.00, 70.00, -82806.00, '', '2021-06-04 04:35:24', '2021-06-24 11:52:50', 0, 1),
(2, 1, 100.00, 8381.00, 0.00, 8481.50, 0.50, 'FF', '2021-06-24 10:54:07', '2021-06-25 01:29:16', 0, 1),
(3, 2, 100.00, 256.50, 0.00, 0.00, 0.00, '', '2021-06-28 11:31:42', '0000-00-00 00:00:00', 1, 2),
(4, 1, 100.00, 1758.00, 0.00, 0.00, 0.00, '', '2021-07-24 02:52:17', '0000-00-00 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `codcaja` int(11) NOT NULL,
  `nrocaja` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombrecaja` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`codcaja`, `nrocaja`, `nombrecaja`, `codigo`) VALUES
(1, '00001', 'PRINCIPAL', 1),
(2, '00002', 'SECUNDARIA', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `sessionn_id` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `id_producto`, `cantidad`, `precio`, `sessionn_id`, `fecha`) VALUES
(13, 1, 1, 16, '9n0n2rf4gm8jb061ho4ot93d91', NULL),
(14, 2, 1, 32, '9n0n2rf4gm8jb061ho4ot93d91', NULL),
(15, 0, 1, 16.5, '9n0n2rf4gm8jb061ho4ot93d91', NULL),
(16, 0, 1, 16.5, 'hrjmloj7n0tt0sa36f66lofdd3', NULL),
(17, 1, 1, 16, 'hrjmloj7n0tt0sa36f66lofdd3', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `codcategoria` int(11) NOT NULL,
  `nomcategoria` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`codcategoria`, `nomcategoria`) VALUES
(1, 'ENTRADAS'),
(2, 'ESPECIALIDADES'),
(3, 'DE LA PARRILLA'),
(4, 'PESCADOS Y MARISCOS'),
(5, 'CALDOS'),
(6, 'SANDWICHES'),
(7, 'DESAYUNOS'),
(8, 'ACOMPANAMIENTOS'),
(10, 'BEBIDAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `codcliente` int(11) NOT NULL,
  `cedcliente` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomcliente` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccliente` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tlfcliente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `emailcliente` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documento` int(11) NOT NULL DEFAULT '1',
  `estado` int(11) NOT NULL DEFAULT '1',
  `codigo` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`codcliente`, `cedcliente`, `nomcliente`, `direccliente`, `tlfcliente`, `emailcliente`, `password`, `documento`, `estado`, `codigo`) VALUES
(1, '8909856037', 'HOSPITAL SAN SEBASTIAN DE URABA', 'VIA A TURBO', '821 454 6', '', NULL, 1, 1, ''),
(2, '8166139', 'CARLOS MARIO RAMOS AGAMEZ', 'CLL DEL CEMENTERIO - NECOCLI ANTIOQUIA', '310 545 4011', 'CARLOSMARIO@HOTMAIL.COM', NULL, 1, 1, ''),
(3, '1067851702', 'YUSTTER HERNAN HOYOS', 'CLL DEL CEMENTERIO NECOCLI - ANTIOQUIA', '321 516 5858', 'YUSSTER@HOTMAIL.COM', NULL, 1, 1, ''),
(4, '1067877555', 'ALBA ROSA ALVAREZ ARGEL', 'CLL DEL CEMENTERIO NECOCLI - ANTIOQUIA', '311 436 2229', 'ALBAROSA@HOTMAIL.COM', NULL, 1, 1, ''),
(5, '1068806992', 'NAURYS NEGRETE BARRIOS', 'CLL DEL CEMENTERIO NECOCLI - ANTIOQUIA', '322 414 6975', 'NAURYSNEGRETE@HOTMAIL.COM', NULL, 1, 1, ''),
(6, '1040804386', 'LUZ ESTHER SERRANO', 'BARRIO SIMON BOLIVAR NECOCLI - ANTIOQUIA', '310 748 0032', 'LUZESTHER@HOTMAIL.COM', NULL, 1, 1, ''),
(7, '1068811764', 'DORAINE NEGRETE BARRIOS', 'CLL DEL CEMENTERIO NECOCLI - ANTIOQUIA', '320 737 4971', 'DORAINEGRETE1988@HOTMAIL.COM', NULL, 1, 1, ''),
(8, '10688117647', 'DONEBA', 'CLL 51 47 48', '323 352 4016', 'DORAINEGRETE1988@HOTMAIL.COM', NULL, 1, 1, ''),
(9, '1020465519', 'KATERINE LLORENTE DIAZ', 'VEREDA HOYITO', '323 229 0549', 'KETE_LLORENTE@HOTMAIL.COM', NULL, 1, 1, ''),
(10, '71895719', 'NELSON FRANCISCO YCHPAS SULLCA', 'SIN DIRECCION', '(9834) - 9834', '', NULL, 1, 1, ''),
(11, '20395649397', 'MALAGA REPRESENTACIONES S.R.L.', 'JR LOBATO NRO 560', '(9886) - 232', 'NELSON01221@GMAIL.COM', NULL, 2, 1, ''),
(12, '2054348100', 'INVERSIONES KARMONT S.A.C', 'CALLE SAN MANUEL 155 URB SANTA LUISA-LOS OLIVOS-LIMA', '(9825) - 512', 'NELSON01221@GMAIL.COM', NULL, 2, 1, ''),
(23, '71895719', 'RONALD YCHPAS SULLCA', 'CALLE NAPO NRO 356', '982398392', 'nfychpas@gmail.com', '123456', 1, 1, '3HOFY5'),
(24, '20304050', 'JAZMIN', 'JASHJSHJA', '(8237) - 8232837', 'JASMIN@GMAIL.COM', NULL, 1, 1, 'NULL'),
(25, '97838974', 'NJNININN', 'JKHJKHJKH', '(8376) - 478', 'JHUBH@GMAIL.COM', NULL, 1, 1, 'NULL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `idcompra` int(11) NOT NULL,
  `codcompra` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codseriec` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codproveedor` int(11) NOT NULL,
  `subtotalivasic` float(12,2) NOT NULL,
  `subtotalivanoc` float(12,2) NOT NULL,
  `ivac` float(12,2) NOT NULL,
  `totalivac` float(12,2) NOT NULL,
  `descuentoc` float(12,2) NOT NULL,
  `totaldescuentoc` float(12,2) NOT NULL,
  `totalc` float(12,2) NOT NULL,
  `tipocompra` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `formacompra` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechavencecredito` date NOT NULL,
  `statuscompra` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechacompra` datetime NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `rifempresa` varchar(25) CHARACTER SET latin1 NOT NULL,
  `nomempresa` varchar(100) CHARACTER SET latin1 NOT NULL,
  `direcempresa` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tlfempresa` varchar(20) CHARACTER SET latin1 NOT NULL,
  `correoempresa` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cedresponsable` varchar(25) CHARACTER SET latin1 NOT NULL,
  `nomresponsable` varchar(100) CHARACTER SET latin1 NOT NULL,
  `correoresponsable` varchar(70) CHARACTER SET latin1 NOT NULL,
  `tlfresponsable` varchar(20) CHARACTER SET latin1 NOT NULL,
  `ivac` float(12,2) NOT NULL,
  `ivav` float(12,2) NOT NULL,
  `simbolo` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fac_ele` int(11) NOT NULL DEFAULT '3',
  `clave` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usuariosol` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `clavesol` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `rifempresa`, `nomempresa`, `direcempresa`, `tlfempresa`, `correoempresa`, `cedresponsable`, `nomresponsable`, `correoresponsable`, `tlfresponsable`, `ivac`, `ivav`, `simbolo`, `fac_ele`, `clave`, `usuariosol`, `clavesol`) VALUES
(1, '20607320986', 'EL RINCON SUIZO', 'PANAMERICANA NORTE 790 URB', '323 352 4016', 'DONEBAREST@GMAIL.COM', '15539294358', 'DORAINE NEGRETE BARRIOS', 'DORAINEGRETE1998@HOTMAIL.COM', '323 352 4016', 18.00, 18.00, '$', 3, '123654', 'MODDATOS', 'moddatos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompras`
--

CREATE TABLE `detallecompras` (
  `coddetallecompra` int(11) NOT NULL,
  `codcompra` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codproducto` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `producto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(6) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantcompra` float(5,2) NOT NULL,
  `precio1` float(12,2) NOT NULL,
  `precio2` float(12,2) NOT NULL,
  `ivaproductoc` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `importecompra` float(12,2) NOT NULL,
  `tipoentrada` varchar(35) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechadetallecompra` datetime NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventas`
--

CREATE TABLE `detalleventas` (
  `coddetalleventa` int(11) NOT NULL,
  `codventa` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcliente` int(11) NOT NULL,
  `codproducto` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `producto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcategoria` int(11) NOT NULL,
  `cantventa` float(5,2) NOT NULL,
  `preciocompra` float(12,2) NOT NULL,
  `precioventa` float(12,2) NOT NULL,
  `ivaproducto` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `importe` float(12,2) NOT NULL,
  `importe2` float(12,2) NOT NULL,
  `fechadetalleventa` datetime NOT NULL,
  `statusdetalle` int(2) NOT NULL,
  `codigo` int(11) NOT NULL,
  `comanda` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalleventas`
--

INSERT INTO `detalleventas` (`coddetalleventa`, `codventa`, `codcliente`, `codproducto`, `producto`, `codcategoria`, `cantventa`, `preciocompra`, `precioventa`, `ivaproducto`, `importe`, `importe2`, `fechadetalleventa`, `statusdetalle`, `codigo`, `comanda`) VALUES
(89, '00000001', 10, '2', 'SOLE MIO GRANDE', 1, 1.00, 32.00, 32.00, 'NO', 32.00, 32.00, '2021-07-25 02:57:25', 0, 1, 1),
(90, '00000002', 0, '2', 'SOLE MIO GRANDE', 1, 1.00, 32.00, 32.00, 'NO', 32.00, 32.00, '2021-07-25 04:03:50', 0, 1, 1),
(91, '00000003', 10, '8', 'REGINA GRANDE', 1, 1.00, 32.00, 32.00, 'NO', 32.00, 32.00, '2021-07-25 04:21:33', 0, 1, 1),
(92, '00000004', 10, '3', '4 QUESOS MEDIANA', 1, 1.00, 17.00, 17.00, 'NO', 17.00, 17.00, '2021-07-25 04:25:13', 0, 1, 1),
(93, '00000005', 10, '2', 'SOLE MIO GRANDE', 1, 1.00, 32.00, 32.00, 'NO', 32.00, 32.00, '2021-07-25 04:46:44', 0, 1, 1),
(94, '00000006', 10, '3', '4 QUESOS MEDIANA', 1, 1.00, 17.00, 17.00, 'NO', 17.00, 17.00, '2021-07-25 05:10:58', 0, 1, 1),
(95, '00000007', 10, '12', 'HAWAIANA GRANDE', 1, 1.00, 32.00, 32.00, 'NO', 32.00, 32.00, '2021-07-25 05:43:19', 0, 1, 1),
(96, '00000008', 11, '6', 'FUNGHI GRANDE', 1, 1.00, 30.00, 30.00, 'NO', 30.00, 30.00, '2021-07-25 06:13:39', 0, 1, 1),
(97, '00000009', 11, '14', 'VEGETARIANA GRANDE', 1, 1.00, 32.00, 32.00, 'NO', 32.00, 32.00, '2021-07-25 06:18:23', 0, 1, 1),
(98, '00000010', 11, '6', 'FUNGHI GRANDE', 1, 1.00, 30.00, 30.00, 'NO', 30.00, 30.00, '2021-07-25 06:24:52', 0, 1, 1),
(99, '00000011', 10, '12', 'HAWAIANA GRANDE', 1, 1.00, 32.00, 32.00, 'NO', 32.00, 32.00, '2021-07-25 06:25:56', 0, 1, 1),
(100, '00000012', 0, '7', 'REGINA MEDIANA', 1, 1.00, 16.00, 16.00, 'NO', 16.00, 16.00, '2022-03-31 07:10:42', 0, 1, 0),
(101, '00000013', 0, '1', 'SOLE MIO MEDIANA', 1, 1.00, 16.00, 16.00, 'NO', 16.00, 16.00, '2022-03-31 07:28:43', 0, 1, 1),
(102, '00000013', 0, '13', 'VEGETARIANA MEDIANA', 1, 1.00, 16.00, 16.00, 'NO', 16.00, 16.00, '2022-03-31 07:28:44', 0, 1, 1),
(103, '00000013', 0, '15', 'VENEZOLANA MEDIANA', 2, 1.00, 17.00, 17.00, 'NO', 17.00, 17.00, '2022-03-31 07:28:45', 0, 1, 1),
(104, '00000014', 0, '8', 'REGINA GRANDE', 1, 1.00, 32.00, 32.00, 'NO', 32.00, 32.00, '2022-03-31 07:32:39', 0, 1, 1),
(105, '0000015', 5, '22', 'SALCHIPAPA SENCILLA', 3, 1.00, 20.50, 16.50, 'NO', 16.00, 20.00, '2022-03-31 08:18:43', 0, 1, 1),
(106, '0000015', 5, '7', 'REGINA MEDIANA', 1, 1.00, 16.00, 16.00, 'NO', 16.00, 16.00, '2022-03-31 08:18:44', 0, 1, 1),
(107, '0000015', 5, '1', 'SOLE MIO MEDIANA', 1, 1.00, 16.00, 16.00, 'NO', 16.00, 16.00, '2022-03-31 08:18:44', 0, 1, 1),
(108, '0000017', 22, '0', 'SALCHIPAPA SENCILLA', 3, 2.00, 20.50, 16.50, 'NO', 16.50, 16.50, '2022-04-03 18:53:17', 0, 1, 1),
(109, '0000017', 22, '1', 'SOLE MIO MEDIANA', 1, 1.00, 16.00, 16.00, 'NO', 16.00, 16.00, '2022-04-03 18:53:17', 0, 1, 1),
(110, '0000018', 23, '0', 'SALCHIPAPA SENCILLA', 3, 1.00, 20.50, 16.50, 'NO', 16.50, 16.50, '2022-04-03 18:59:36', 0, 1, 1),
(111, '0000018', 23, '1', 'SOLE MIO MEDIANA', 1, 1.00, 16.00, 16.00, 'NO', 16.00, 16.00, '2022-04-03 18:59:36', 0, 1, 1),
(112, '00000019', 0, '004', 'SOLE MIO GRANDE', 1, 1.00, 32.00, 32.00, 'NO', 32.00, 32.00, '2022-04-03 08:02:56', 0, 1, 1),
(113, '00000019', 0, '12', 'HAWAIANA GRANDE', 1, 1.00, 32.00, 32.00, 'NO', 32.00, 32.00, '2022-04-03 08:02:56', 0, 1, 1),
(114, '0000020', 23, '1', 'SOLE MIO MEDIANA', 1, 1.00, 16.00, 16.00, 'NO', 16.00, 16.00, '2022-04-03 21:36:50', 0, 1, 1),
(115, '0000020', 23, '2', 'SOLE MIO GRANDE', 1, 1.00, 32.00, 32.00, 'NO', 32.00, 32.00, '2022-04-03 21:36:50', 0, 1, 1),
(116, '00000021', 0, '002', 'PICADERA DE LA CASA', 1, 1.00, 400.00, 475.00, 'NO', 475.00, 400.00, '2022-04-04 01:01:40', 0, 1, 1),
(117, '00000021', 0, '003', 'BOLITA DE QUESOS', 1, 1.00, 275.00, 275.00, 'NO', 275.00, 275.00, '2022-04-04 01:07:59', 0, 1, 1),
(118, '00000021', 0, '6', 'SOPA DE GALLINA', 5, 1.00, 300.00, 325.00, 'NO', 325.00, 300.00, '2022-04-04 01:12:04', 0, 1, 1),
(119, '00000021', 0, '3', 'CHICHARRON DE POLLO', 2, 1.00, 300.00, 355.00, 'NO', 355.00, 300.00, '2022-04-04 01:12:05', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `idingrediente` int(11) NOT NULL,
  `codingrediente` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomingrediente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantingrediente` float(5,2) NOT NULL,
  `costoingrediente` float(12,2) NOT NULL,
  `unidadingrediente` varchar(6) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codproveedor` int(11) NOT NULL,
  `stockminimoingrediente` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`idingrediente`, `codingrediente`, `nomingrediente`, `cantingrediente`, `costoingrediente`, `unidadingrediente`, `codproveedor`, `stockminimoingrediente`) VALUES
(1, '1', 'PAPAS A LA FRANCESA', 76.50, 1100.00, 'UNID.', 1, 20.00),
(2, '2', 'LOMO DE RES', 47.50, 9500.00, 'UNID.', 1, 0.00),
(3, '3', 'BUTIFARRA', 72.00, 430.20, 'UNID.', 1, 30.00),
(4, '4', 'LOMO DE CERDO', 0.50, 6000.00, 'UNID.', 1, 15.00),
(5, '5', 'PECHUGA ', 84.50, 6000.00, 'UNID.', 1, 15.00),
(6, '6', 'SALCHICHA DE PERRO', 96.00, 463.00, 'UNID.', 1, 30.00),
(7, '7', 'SALCHICHA AMERICANA', 31.00, 1248.00, 'UNID.', 1, 10.00),
(8, '8', 'SUIZA', 86.50, 3075.00, 'UNID.', 1, 10.00),
(9, '9', 'RANCHERA', 70.00, 1828.57, 'UNID.', 1, 10.00),
(10, '10', 'MANGUERA', 122.00, 1016.00, 'UNID.', 1, 30.00),
(11, '11', 'CHORIZO', 54.55, 999.00, 'UNID.', 1, 20.00),
(12, '12', 'JAMON', 122.00, 173.00, 'UNID.', 1, 10.00),
(13, '13', 'MOZARELLA', 386.00, 250.00, 'UNID.', 1, 10.00),
(14, '14', 'TOCINETA', 17.00, 473.48, 'UNID.', 1, 15.00),
(15, '15', 'MAIZ', 29.50, 1366.71, 'UNID.', 1, 6.00),
(16, '16', 'PAN PERRO', 87.00, 350.00, 'UNID.', 1, 5.00),
(17, '17', 'PAN HAMBURGUESA', 40.00, 450.00, 'UNID.', 1, 0.00),
(18, '18', 'PATACON', 120.00, 300.00, 'UNID.', 1, 12.00),
(19, '19', 'HAMBURGUESA CARNE', 83.00, 2000.00, 'UNID.', 1, 20.00),
(20, '20', 'HAMBURGUESA DE POLLO', 50.00, 2000.00, 'UNID.', 1, 5.00),
(21, '21', 'PICADA DE POLLO', 30.00, 4000.00, 'UNID.', 1, 10.00),
(22, '22', 'PICADA DE LOMITO', 119.50, 5000.00, 'UNID.', 1, 10.00),
(23, '23', 'PICADA DE CERDO', 38.50, 4500.00, 'UNID.', 1, 20.00),
(24, '24', 'CHUZO DE POLLO', 180.50, 3000.00, 'UNID.', 1, 20.00),
(25, '25', 'CHUZO DE LOMITO', 21.50, 4000.00, 'UNID.', 1, 8.00),
(26, '26', 'CHUZO DE CERDO', 18.00, 3500.00, 'UNID.', 1, 5.00),
(27, '27', 'PUNTA ANCA', 15.00, 6500.00, 'UNID.', 1, 10.00),
(28, '28', 'CHURRASCO', 18.00, 6500.00, 'UNID.', 1, 10.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardexingredientes`
--

CREATE TABLE `kardexingredientes` (
  `codkardexing` int(11) NOT NULL,
  `codprocesoing` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `codresponsableing` int(11) NOT NULL,
  `codproducto` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `codingrediente` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `movimientoing` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `entradasing` float(5,2) NOT NULL,
  `salidasing` float(5,2) NOT NULL,
  `stockactualing` float(5,2) NOT NULL,
  `preciouniting` float(12,2) NOT NULL,
  `costototaling` float(12,2) NOT NULL,
  `documentoing` text COLLATE utf8_spanish_ci NOT NULL,
  `fechakardexing` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardexproductos`
--

CREATE TABLE `kardexproductos` (
  `codkardex` int(11) NOT NULL,
  `codproceso` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `codresponsable` int(11) NOT NULL,
  `codproducto` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `movimiento` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `entradas` float(5,2) NOT NULL,
  `salidas` float(5,2) NOT NULL,
  `devolucion` float(5,2) NOT NULL,
  `stockactual` float(5,2) NOT NULL,
  `preciom` float(12,2) NOT NULL,
  `costototal` float(12,2) NOT NULL,
  `documento` text COLLATE utf8_spanish_ci NOT NULL,
  `fechakardex` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `kardexproductos`
--

INSERT INTO `kardexproductos` (`codkardex`, `codproceso`, `codresponsable`, `codproducto`, `movimiento`, `entradas`, `salidas`, `devolucion`, `stockactual`, `preciom`, `costototal`, `documento`, `fechakardex`) VALUES
(252, '00000021', 0, '002', 'SALIDAS', 0.00, 1.00, 0.00, 49.00, 475.00, 475.00, 'VENTA - FACTURA: 00000021', '2022-04-04'),
(253, '00000021', 0, '003', 'SALIDAS', 0.00, 1.00, 0.00, 59.00, 275.00, 275.00, 'VENTA - FACTURA: 00000021', '2022-04-04'),
(254, '00000021', 0, '6', 'SALIDAS', 0.00, 1.00, 0.00, 49.00, 325.00, 325.00, 'VENTA - FACTURA: 00000021', '2022-04-04'),
(255, '00000021', 0, '3', 'SALIDAS', 0.00, 1.00, 0.00, 76.00, 355.00, 355.00, 'VENTA - FACTURA: 00000021', '2022-04-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo` datetime DEFAULT NULL,
  `detalles` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `paginas` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id`, `ip`, `tiempo`, `detalles`, `paginas`, `usuario`) VALUES
(1, '127.0.0.1', '2019-03-12 10:46:27', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:64.0) Gecko/20100101 Firefox/64.0', '/restaurant/index.php', 'RUBENCHIRINOS'),
(2, '127.0.0.1', '2019-03-23 11:36:01', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0', '/restaurant/index.php', 'RUBENCHIRINOS'),
(3, '127.0.0.1', '2019-03-24 11:24:58', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0', '/restaurant/index.php', 'RUBENCHIRINOS'),
(4, '::1', '2021-06-04 05:34:49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(5, '::1', '2021-06-07 05:50:48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(6, '::1', '2021-06-24 09:55:28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36', '/RESTAURANTE/index.php', 'RUBENCHIRINOS'),
(7, '::1', '2021-06-24 03:55:26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(8, '::1', '2021-06-25 01:12:38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36', '/RESTAURANTE/index.php', 'RUBENCHIRINOS'),
(9, '::1', '2021-06-28 12:30:06', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36', '/RESTAURANTE/index.php', 'RUBENCHIRINOS'),
(10, '::1', '2021-06-28 12:32:41', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36', '/RESTAURANTE/index.php', 'MOISESRODOLFO'),
(11, '::1', '2021-06-28 12:33:05', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36', '/RESTAURANTE/index.php', 'NELSON'),
(12, '::1', '2021-06-30 08:39:34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(13, '::1', '2021-06-30 08:40:21', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '/restaurante/index.php', 'MOISESRODOLFO'),
(14, '::1', '2021-06-30 08:42:33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(15, '::1', '2021-06-30 08:42:50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '/restaurante/index.php', 'MARBELLAPAREDES'),
(16, '::1', '2021-07-24 03:52:03', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(17, '::1', '2021-07-24 04:05:33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(18, '::1', '2021-07-24 04:47:08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(19, '::1', '2021-07-25 12:54:30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(20, '::1', '2021-07-25 01:12:50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(21, '::1', '2021-08-26 12:03:24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(22, '::1', '2021-08-26 12:04:56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', '/restaurante/index.php', 'MARBELLAPAREDES'),
(23, '::1', '2021-08-26 12:05:29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(24, '::1', '2021-08-26 12:06:07', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', '/restaurante/index.php', 'MOISESRODOLFO'),
(25, '::1', '2021-08-26 12:06:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(26, '::1', '2021-08-26 12:06:59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', '/restaurante/index.php', 'COCINERO'),
(27, '::1', '2021-08-26 12:07:24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(28, '::1', '2021-08-26 01:07:26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(29, '::1', '2021-08-26 01:21:44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', '/restaurante/index.php', 'COCINERO'),
(30, '::1', '2021-09-05 07:08:29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(31, '::1', '2021-11-14 11:50:21', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(32, '::1', '2022-03-31 07:09:49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36', '/restaurante/index.php', 'RUBENCHIRINOS'),
(33, '::1', '2022-03-31 07:19:56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36', '/restaurantes/rd/index.php', 'RUBENCHIRINOS'),
(34, '::1', '2022-03-31 07:28:17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36', '/restaurantes/rd/index.php', 'RUBENCHIRINOS'),
(35, '::1', '2022-04-01 12:36:35', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36', '/restaurantes/rd/index.php', 'RUBENCHIRINOS'),
(36, '::1', '2022-04-01 05:30:11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36', '/restaurantes/rd/index.php', 'RUBENCHIRINOS'),
(37, '::1', '2022-04-03 08:01:09', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36', '/restaurantes/rd/web/sistema/index.php', 'RUBENCHIRINOS'),
(38, '::1', '2022-04-03 08:43:32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36', '/restaurantes/rd/web/sistema/index.php', 'RUBENCHIRINOS'),
(39, '::1', '2022-04-04 12:21:53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36', '/restaurantes/rd/web/sistema/index.php', 'RUBENCHIRINOS'),
(40, '127.0.0.1', '2022-04-04 01:14:48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:98.0) Gecko/20100101 Firefox/98.0', '/restaurantes/rd/web/sistema/index.php', 'RUBENCHIRINOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mediospagos`
--

CREATE TABLE `mediospagos` (
  `codmediopago` int(11) NOT NULL,
  `mediopago` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mediospagos`
--

INSERT INTO `mediospagos` (`codmediopago`, `mediopago`) VALUES
(1, 'EFECTIVO'),
(2, 'TRANSFERENCIA'),
(3, 'TARJETA DEBITO/CREDITO'),
(4, 'YAPE'),
(5, 'PLIN'),
(6, 'CHEQUE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `codmesa` int(11) NOT NULL,
  `codsala` int(11) NOT NULL,
  `nombremesa` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `mesacreada` datetime NOT NULL,
  `statusmesa` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`codmesa`, `codsala`, `nombremesa`, `mesacreada`, `statusmesa`) VALUES
(1, 1, 'MESA 1', '2017-11-08 11:44:33', 0),
(2, 1, 'MESA 2', '2017-11-08 12:05:05', 0),
(4, 1, 'MESA 3', '2017-11-10 02:08:07', 0),
(5, 1, 'MESA 4', '2017-11-10 02:08:20', 0),
(6, 1, 'MESA 5', '2017-11-10 02:08:32', 0),
(7, 1, 'MESA 6', '2017-11-10 02:08:57', 0),
(8, 1, 'MESA 7', '2017-11-10 02:09:08', 0),
(9, 1, 'MESA 8', '2017-11-10 02:09:22', 0),
(10, 1, 'MESA 9', '2017-11-10 02:09:56', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientoscajas`
--

CREATE TABLE `movimientoscajas` (
  `codmovimientocaja` int(11) NOT NULL,
  `tipomovimientocaja` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `montomovimientocaja` float(12,2) NOT NULL,
  `mediopagomovimientocaja` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `descripcionmovimientocaja` text COLLATE utf8_spanish_ci NOT NULL,
  `fechamovimientocaja` datetime NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codalmacen` int(11) NOT NULL,
  `codproducto` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `producto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcategoria` int(11) NOT NULL,
  `preciocompra` float(12,2) NOT NULL,
  `precioventa` float(12,2) NOT NULL,
  `existencia` float(5,2) NOT NULL,
  `stockminimo` int(5) NOT NULL,
  `ivaproducto` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descproducto` float(12,2) NOT NULL,
  `codproveedor` int(11) NOT NULL,
  `codigobarra` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `favorito` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `statusproducto` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codalmacen`, `codproducto`, `producto`, `codcategoria`, `preciocompra`, `precioventa`, `existencia`, `stockminimo`, `ivaproducto`, `descproducto`, `codproveedor`, `codigobarra`, `favorito`, `statusproducto`) VALUES
(0, '002', 'PICADERA DE LA CASA', 1, 400.00, 475.00, 49.00, 10, 'NO', 0.00, 0, '0', 'NO', 'ACTIVO'),
(1, '003', 'BOLITA DE QUESOS', 1, 275.00, 275.00, 59.00, 1, 'NO', 0.00, 0, '0', 'NO', 'ACTIVO'),
(2, '004', 'CHIVITO GUISADO', 2, 700.00, 715.00, 67.00, 10, 'NO', 0.00, 0, '0', 'NO', 'ACTIVO'),
(3, '3', 'CHICHARRON DE POLLO', 2, 300.00, 355.00, 76.00, 10, 'NO', 0.00, 0, '0', 'SI', 'ACTIVO'),
(4, '4', 'POLLO A LA PARRILLA', 3, 400.00, 455.00, 32.00, 10, 'NO', 0.00, 0, '0', 'NO', 'ACTIVO'),
(5, '5', 'CANGREJO BAHIA', 4, 540.00, 545.00, 16.00, 10, 'NO', 0.00, 0, '0', 'NO', 'ACTIVO'),
(6, '6', 'SOPA DE GALLINA', 5, 300.00, 325.00, 49.00, 10, 'NO', 0.00, 0, '0', 'SI', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosvsingredientes`
--

CREATE TABLE `productosvsingredientes` (
  `codagrega` int(11) NOT NULL,
  `codproducto` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codingrediente` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantracion` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productosvsingredientes`
--

INSERT INTO `productosvsingredientes` (`codagrega`, `codproducto`, `codingrediente`, `cantracion`) VALUES
(12, '7', '1', 1.00),
(13, '7', '4', 1.00),
(14, '7', '9', 1.00),
(15, '8', '1', 1.00),
(16, '8', '27', 1.00),
(17, '9', '1', 1.00),
(18, '9', '28', 1.00),
(19, '10', '1', 1.00),
(20, '10', '8', 1.00),
(21, '11', '1', 0.50),
(22, '11', '8', 0.50),
(25, '12', '11', 0.50),
(26, '12', '3', 1.00),
(27, '12', '5', 0.50),
(28, '12', '2', 0.50),
(29, '12', '1', 1.00),
(31, '2', '1', 1.00),
(32, '13', '5', 0.50),
(33, '13', '2', 0.50),
(34, '13', '4', 0.50),
(35, '13', '1', 1.00),
(36, '14', '1', 1.00),
(37, '14', '2', 0.50),
(38, '14', '4', 0.50),
(39, '14', '5', 0.50),
(40, '14', '11', 0.50),
(41, '14', '3', 1.00),
(42, '15', '8', 0.50),
(43, '15', '21', 0.50),
(44, '15', '1', 1.00),
(45, '16', '8', 0.50),
(46, '16', '22', 0.50),
(47, '16', '1', 1.00),
(48, '17', '1', 1.00),
(49, '17', '8', 0.50),
(50, '17', '23', 0.50),
(51, '18', '1', 1.00),
(52, '18', '8', 0.50),
(53, '18', '11', 0.50),
(54, '18', '3', 1.00),
(55, '19', '1', 1.00),
(56, '19', '8', 0.50),
(57, '19', '21', 0.50),
(58, '19', '22', 0.50),
(59, '19', '11', 0.50),
(60, '19', '3', 1.00),
(61, '20', '1', 1.00),
(62, '20', '8', 0.50),
(63, '20', '9', 1.00),
(64, '20', '14', 1.00),
(65, '20', '12', 1.00),
(66, '21', '1', 1.00),
(67, '21', '8', 0.50),
(68, '21', '21', 0.50),
(69, '21', '22', 0.50),
(70, '21', '23', 0.50),
(71, '21', '3', 1.00),
(72, '21', '15', 0.50),
(73, '21', '9', 1.00),
(74, '22', '1', 1.00),
(75, '22', '10', 1.00),
(76, '23', '1', 1.00),
(77, '23', '10', 1.00),
(78, '23', '21', 0.50),
(79, '24', '1', 1.00),
(80, '24', '10', 1.00),
(81, '24', '11', 0.50),
(82, '24', '3', 1.00),
(83, '25', '1', 1.00),
(84, '25', '10', 1.00),
(85, '25', '22', 0.50),
(86, '26', '1', 1.00),
(87, '26', '23', 0.50),
(88, '26', '10', 1.00),
(89, '27', '1', 1.00),
(90, '27', '10', 1.00),
(91, '27', '8', 0.50),
(92, '28', '1', 1.00),
(93, '28', '10', 1.00),
(94, '28', '12', 1.00),
(95, '28', '14', 1.00),
(96, '28', '13', 2.00),
(97, '29', '8', 0.50),
(98, '30', '1', 1.00),
(99, '30', '21', 1.00),
(100, '31', '1', 1.00),
(101, '31', '22', 1.00),
(102, '32', '1', 1.00),
(103, '32', '23', 1.00),
(104, '33', '1', 1.00),
(105, '33', '22', 0.50),
(106, '33', '21', 0.50),
(107, '33', '23', 0.50),
(108, '34', '1', 1.00),
(109, '34', '21', 0.50),
(110, '34', '23', 0.50),
(111, '35', '1', 1.00),
(112, '35', '8', 0.50),
(113, '35', '11', 0.50),
(114, '35', '3', 1.00),
(115, '36', '1', 1.00),
(116, '36', '9', 1.00),
(117, '37', '21', 0.50),
(118, '37', '22', 0.50),
(119, '37', '8', 0.50),
(120, '37', '15', 0.50),
(121, '38', '1', 1.00),
(122, '38', '15', 0.50),
(123, '38', '21', 0.50),
(124, '39', '1', 1.00),
(125, '39', '15', 0.50),
(126, '39', '21', 1.00),
(127, '40', '1', 1.00),
(128, '40', '21', 0.50),
(129, '40', '23', 0.50),
(130, '40', '14', 1.00),
(131, '40', '12', 1.00),
(132, '40', '13', 2.00),
(133, '41', '1', 1.00),
(134, '41', '22', 0.50),
(135, '41', '21', 0.50),
(136, '41', '11', 0.50),
(137, '41', '3', 1.00),
(138, '42', '1', 1.00),
(139, '42', '22', 0.50),
(140, '42', '21', 0.50),
(141, '42', '8', 0.50),
(142, '42', '3', 1.00),
(143, '42', '11', 0.50),
(144, '43', '1', 1.00),
(145, '43', '21', 0.50),
(146, '43', '22', 0.50),
(147, '43', '23', 0.50),
(148, '43', '8', 0.50),
(149, '43', '11', 0.50),
(150, '43', '3', 1.00),
(151, '43', '9', 1.00),
(152, '43', '15', 0.50),
(153, '44', '15', 1.00),
(154, '45', '15', 1.00),
(155, '45', '8', 0.50),
(156, '46', '15', 1.00),
(157, '46', '21', 0.50),
(158, '47', '15', 1.00),
(159, '47', '22', 0.50),
(160, '48', '23', 0.50),
(161, '49', '15', 1.00),
(162, '49', '9', 1.00),
(163, '50', '15', 1.00),
(164, '50', '14', 1.00),
(165, '50', '12', 1.00),
(166, '50', '9', 1.00),
(167, '50', '13', 2.00),
(168, '51', '15', 1.00),
(169, '51', '21', 0.50),
(170, '51', '22', 0.50),
(171, '51', '3', 1.00),
(172, '51', '11', 0.50),
(173, '52', '15', 1.00),
(174, '52', '21', 0.50),
(175, '52', '22', 0.50),
(176, '53', '15', 1.00),
(177, '53', '21', 0.50),
(178, '53', '22', 0.50),
(179, '53', '23', 0.50),
(180, '53', '8', 0.50),
(181, '53', '3', 1.00),
(182, '53', '9', 1.00),
(183, '54', '19', 1.00),
(184, '54', '17', 1.00),
(185, '54', '13', 1.00),
(186, '55', '20', 1.00),
(187, '55', '17', 1.00),
(188, '55', '13', 1.00),
(189, '56', '17', 1.00),
(190, '56', '19', 1.00),
(191, '56', '20', 1.00),
(192, '56', '13', 1.00),
(193, '57', '17', 1.00),
(194, '57', '19', 1.00),
(195, '57', '14', 1.00),
(196, '57', '12', 1.00),
(197, '57', '13', 1.00),
(198, '58', '17', 1.00),
(199, '58', '19', 1.00),
(200, '58', '20', 1.00),
(201, '58', '14', 1.00),
(202, '58', '12', 1.00),
(203, '58', '13', 1.00),
(204, '59', '17', 1.00),
(205, '59', '19', 1.00),
(206, '59', '11', 0.50),
(207, '59', '3', 1.00),
(208, '60', '17', 1.00),
(209, '60', '19', 1.00),
(210, '60', '12', 1.00),
(211, '60', '3', 1.00),
(212, '60', '11', 0.50),
(213, '60', '20', 1.00),
(214, '60', '13', 1.00),
(215, '61', '17', 1.00),
(216, '61', '19', 1.00),
(217, '61', '13', 1.00),
(218, '61', '1', 1.00),
(219, '62', '24', 1.00),
(220, '62', '1', 1.00),
(221, '63', '25', 1.00),
(222, '63', '1', 1.00),
(223, '64', '26', 1.00),
(224, '64', '1', 1.00),
(225, '65', '1', 1.00),
(226, '65', '24', 0.50),
(227, '65', '25', 0.50),
(228, '66', '1', 1.00),
(229, '66', '24', 1.00),
(230, '66', '13', 2.00),
(231, '67', '1', 1.00),
(232, '67', '25', 1.00),
(233, '67', '13', 2.00),
(234, '68', '18', 1.00),
(235, '68', '21', 1.00),
(236, '69', '18', 1.00),
(237, '69', '22', 1.00),
(238, '70', '18', 1.00),
(239, '70', '21', 0.50),
(240, '70', '22', 0.50),
(241, '71', '18', 1.00),
(242, '71', '21', 0.50),
(243, '71', '9', 1.00),
(244, '72', '18', 1.00),
(245, '72', '21', 0.50),
(246, '72', '23', 0.50),
(247, '73', '18', 1.00),
(248, '73', '23', 0.50),
(249, '73', '9', 1.00),
(250, '74', '18', 1.00),
(251, '74', '23', 1.00),
(252, '75', '18', 1.00),
(253, '75', '8', 1.00),
(254, '75', '13', 2.00),
(255, '76', '18', 1.00),
(256, '76', '21', 0.50),
(257, '76', '22', 0.50),
(258, '76', '23', 0.50),
(259, '77', '18', 1.00),
(260, '77', '8', 0.50),
(261, '77', '11', 0.50),
(262, '77', '3', 1.00),
(263, '78', '18', 1.00),
(264, '78', '21', 0.50),
(265, '78', '8', 0.50),
(266, '79', '18', 1.00),
(267, '79', '22', 0.50),
(268, '79', '8', 0.50),
(269, '80', '18', 1.00),
(270, '80', '22', 0.50),
(271, '80', '9', 1.00),
(272, '81', '18', 1.00),
(273, '81', '23', 0.50),
(274, '81', '8', 0.50),
(275, '82', '18', 1.00),
(276, '82', '11', 1.00),
(277, '82', '3', 2.00),
(278, '83', '18', 1.00),
(279, '83', '13', 2.00),
(280, '83', '12', 1.00),
(281, '83', '14', 1.00),
(282, '83', '21', 0.50),
(283, '84', '18', 1.00),
(284, '84', '15', 0.50),
(285, '84', '21', 0.50),
(286, '84', '22', 0.50),
(287, '85', '18', 1.00),
(288, '85', '22', 0.50),
(289, '85', '21', 0.50),
(290, '85', '3', 1.00),
(291, '85', '11', 0.50),
(292, '85', '8', 0.50),
(293, '86', '18', 1.00),
(294, '86', '21', 0.50),
(295, '86', '22', 0.50),
(296, '86', '23', 0.50),
(297, '86', '8', 0.50),
(298, '86', '11', 0.50),
(299, '86', '3', 1.00),
(300, '86', '9', 1.00),
(301, '86', '15', 0.50),
(302, '99', '1', 1.00),
(303, '100', '15', 0.50),
(304, '101', '21', 0.50),
(305, '102', '22', 0.50),
(306, '103', '3', 1.00),
(307, '104', '9', 1.00),
(308, '105', '11', 1.00),
(309, '106', '14', 1.00),
(310, '107', '8', 0.50),
(311, '108', '13', 1.00),
(312, '109', '16', 1.00),
(313, '109', '6', 1.00),
(314, '109', '13', 1.00),
(315, '110', '16', 1.00),
(316, '110', '7', 1.00),
(317, '110', '13', 1.00),
(318, '110', '12', 1.00),
(319, '111', '16', 1.00),
(320, '111', '8', 0.50),
(321, '111', '13', 1.00),
(322, '112', '16', 1.00),
(323, '112', '8', 1.00),
(324, '112', '13', 1.00),
(325, '113', '16', 1.00),
(326, '113', '8', 1.00),
(327, '113', '14', 1.00),
(328, '113', '12', 1.00),
(329, '113', '13', 1.00),
(330, '114', '16', 1.00),
(331, '114', '8', 0.50),
(332, '114', '13', 1.00),
(333, '115', '16', 1.00),
(334, '115', '14', 1.00),
(335, '115', '13', 1.00),
(336, '116', '16', 1.00),
(337, '116', '9', 1.00),
(338, '116', '13', 1.00),
(339, '116', '12', 1.00),
(340, '117', '16', 1.00),
(341, '117', '9', 1.00),
(342, '117', '14', 1.00),
(343, '117', '12', 1.00),
(344, '117', '13', 1.00),
(345, '118', '16', 1.00),
(346, '118', '11', 0.50),
(347, '118', '13', 1.00),
(348, '119', '16', 1.00),
(349, '119', '3', 1.00),
(350, '119', '13', 1.00),
(351, '120', '16', 1.00),
(352, '120', '21', 0.50),
(353, '120', '13', 1.00),
(354, '121', '16', 1.00),
(355, '121', '22', 0.50),
(356, '121', '13', 1.00),
(357, '122', '16', 1.00),
(358, '122', '23', 0.50),
(359, '122', '13', 1.00),
(360, '123', '16', 1.00),
(361, '123', '6', 2.00),
(362, '123', '13', 2.00),
(363, '124', '16', 1.00),
(364, '124', '14', 1.00),
(365, '124', '12', 1.00),
(366, '124', '13', 1.00),
(367, '125', '16', 1.00),
(368, '125', '12', 1.00),
(369, '125', '13', 1.00),
(370, '126', '16', 1.00),
(371, '126', '21', 0.50),
(372, '126', '22', 0.50),
(373, '126', '13', 1.00),
(374, '127', '16', 1.00),
(375, '127', '21', 0.50),
(376, '127', '22', 0.50),
(377, '127', '23', 0.50),
(378, '127', '13', 1.00),
(379, '128', '16', 1.00),
(380, '128', '21', 0.50),
(381, '128', '22', 0.50),
(382, '128', '11', 0.50),
(383, '128', '6', 1.00),
(384, '128', '13', 2.00),
(385, '129', '16', 1.00),
(386, '129', '6', 1.00),
(387, '129', '13', 1.00),
(388, '129', '1', 1.00),
(389, '130', '16', 1.00),
(390, '130', '13', 1.00),
(391, '130', '8', 0.50),
(392, '130', '11', 0.50),
(393, '130', '3', 1.00),
(394, '131', '16', 1.00),
(395, '131', '14', 7.00),
(396, '131', '13', 1.00),
(397, '134', '12', 1.00),
(398, '135', '23', 0.50),
(399, '29', '1', 1.00),
(400, '29', '9', 1.00),
(401, '29', '21', 0.50),
(402, '29', '22', 0.50),
(403, '29', '11', 0.50),
(404, '29', '3', 1.00),
(405, '29', '23', 0.50),
(406, '29', '15', 0.50),
(407, '29', '10', 1.00),
(408, '37', '1', 1.00),
(409, '48', '15', 1.00),
(410, '53', '11', 0.50),
(411, '59', '13', 1.00),
(412, '60', '14', 1.00),
(413, '111', '6', 1.00),
(414, '115', '6', 1.00),
(415, '118', '6', 1.00),
(416, '119', '6', 1.00),
(417, '120', '6', 1.00),
(418, '122', '6', 1.00),
(419, '124', '6', 1.00),
(420, '125', '6', 1.00),
(423, '136', '16', 1.00),
(424, '136', '22', 0.50),
(425, '136', '6', 1.00),
(426, '136', '13', 1.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `codproveedor` int(11) NOT NULL,
  `ritproveedor` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomproveedor` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direcproveedor` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tlfproveedor` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `emailproveedor` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contactoproveedor` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`codproveedor`, `ritproveedor`, `nomproveedor`, `direcproveedor`, `tlfproveedor`, `emailproveedor`, `contactoproveedor`) VALUES
(1, '71261097-1', 'CASA FRICAR', 'MONTERIA', '314 596 9694', 'CASAFRICAR@HOTMAIL.COM', 'FERNEY'),
(2, '43417696-3', 'DEPOSITO AL MAR', 'CLL COTIZADA NECOCLI', '821 43 42', 'DEPOSITOALMAR@HOTMAIL.COM', 'PALOMO'),
(3, '1045507345-8', 'DISTRIFODS LA GRANJA', 'APARTADO ANTIOQUIA', '301 219 0235', 'DISTRIFODSLAGRANJA@HOTMAIL.COM', 'JAMES'),
(4, '890903939-5', 'POSTOBON', 'CHIGORODO', '310 681 4957', 'POSTOBON@HOTMAIL.COM', 'JUAN DAVID'),
(5, '1027953891-4', 'PORKY CARNE LA LIGA', 'NECOCLI - ANTIOQUIA', '301 452 8312', 'PORKY@HOTMAIL.COM', 'ANDREA JARAMILLO'),
(6, 'PROVEEDORES VARIOS', 'PROVEEDORES VARIOS', 'NECOCLI - ANTIOQUIA', '320 737 4971', 'DORAINEGRETE@HOTMAIL.COM', 'VARIOS'),
(7, '900430430-3', 'AGUILA GRUPO EMPRESARIAL S.A.S.', 'MONTERIA - CORDOBA', '317 370 3166', 'GRUPOAGUILA@HOTMAIL.COM', 'ADRIANA'),
(8, '1039086972', 'EXPENDIO DE CARNES', 'PLAZA DE MERCADO', '322 662 5684', 'GERMAN@GMAIL.COM', 'GERMAN'),
(9, '901022172-1', 'SOLANO ESCUDERO SAS', 'K1 VIA APARATADO', '828 379 9', 'SOLANO@HOTMAIL.COM', 'EDER FLOREZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `mensaje` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `id_cliente`, `cantidad`, `fecha`, `mensaje`) VALUES
(2, 23, 5, '2022-04-12 10:22:00', 'Algun dato ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `codsala` int(11) NOT NULL,
  `nombresala` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `salacreada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`codsala`, `nombresala`, `salacreada`) VALUES
(1, 'SALA PRINCIPAL', '2017-11-08 11:44:21'),
(2, 'SALA SECUNDARIA', '2017-11-08 12:04:05'),
(3, 'SALA BALCON', '2018-10-19 02:09:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo` int(11) NOT NULL,
  `cedula` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nrotelefono` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cargo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nivel` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `status` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `cedula`, `nombres`, `nrotelefono`, `cargo`, `email`, `usuario`, `password`, `nivel`, `status`) VALUES
(1, '18633174', 'RUBEN DARIO CHIRINOS RODRIGUEZ', '416 342 2924', 'WEBMASTER', 'ELSAIYA@GMAIL.COM', 'RUBENCHIRINOS', '3ee657cddb83008a70c1701814c36989456c64e6', 'ADMINISTRADOR', 'ACTIVO'),
(2, '16317737', 'MARBELLAPAREDES MARQUEZ', '424 722 2094', 'WEBMASTER', 'PAREDESMARQUEZMARBELLA@GMAIL.COM', 'MARBELLAPAREDES', '3721ad498dd15cea0235827e328a0f5814ece591', 'CAJERO', 'ACTIVO'),
(3, '23654387', 'MOISES RODOLFO CHIRINOS LEAL', '000 000 0000', 'MESERO', 'MOISESRODOLFO@GMAIL.COM', 'MOISESRODOLFO', '70753bef4d7b163dd7939aa7cefdffdfa0a07bc8', 'MESERO', 'ACTIVO'),
(4, '129873456', 'RAFAEL DE JESUS CONTRERAS', '000 000 0000', 'COCINERO', 'JCOCINERO@GMAIL.COM', 'COCINERO', '87ca0623c32aa690c9eb93ef1002aa03fc11b691', 'COCINERO', 'ACTIVO'),
(5, '24987234', 'MARIA DEL CARMEN CONTRERAS', '000 000 0000', 'COCINERO', 'COCINERA@GMAIL.COM', 'COCINERO2', '9c12cc0d9d2f44820876f283342c2dad3644dcca', 'COCINERO', 'INACTIVO'),
(6, '21354698', 'RAMON ANTONIO CONTRERAS RUIZ', '412 763 9845', 'REPARTIDOR', 'RAMONUR@GMAIL.COM', 'RAMONANTONIO', '2d3070afcbce9a05a2e4735d338c28c855d6f7d1', 'REPARTIDOR', 'ACTIVO'),
(7, '101010010', 'NELSON', '893 743 7', 'MESERO', 'MESE@GMAIL.COM', 'NELSON', '3f148997191fb2f8cd16de6de8d9c376772cd434', 'MESERO', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idventa` int(11) NOT NULL,
  `codventa` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcaja` int(11) NOT NULL,
  `codcliente` int(11) NOT NULL,
  `codmesa` int(11) NOT NULL,
  `subtotalivasive` float(12,2) NOT NULL,
  `subtotalivanove` float(12,2) NOT NULL,
  `ivave` int(2) NOT NULL,
  `totalivave` float(12,2) NOT NULL,
  `descuentove` int(2) NOT NULL,
  `totaldescuentove` float(12,2) NOT NULL,
  `totalpago` float(12,2) NOT NULL,
  `totalpago2` float(12,2) NOT NULL,
  `tipopagove` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `formapagove` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `montopagado` float(12,2) NOT NULL,
  `montodevuelto` float(12,2) NOT NULL,
  `fechavencecredito` date NOT NULL,
  `statusventa` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `statuspago` int(2) NOT NULL,
  `fechaventa` datetime NOT NULL,
  `codigo` int(11) NOT NULL,
  `cocinero` int(2) NOT NULL,
  `delivery` int(2) NOT NULL,
  `repartidor` int(11) NOT NULL,
  `entregado` int(2) NOT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codarqueocaja` int(11) NOT NULL DEFAULT '1',
  `comprobante` int(11) NOT NULL DEFAULT '1',
  `serie_doc` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '001',
  `aceptado` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `enviado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idventa`, `codventa`, `codcaja`, `codcliente`, `codmesa`, `subtotalivasive`, `subtotalivanove`, `ivave`, `totalivave`, `descuentove`, `totaldescuentove`, `totalpago`, `totalpago2`, `tipopagove`, `formapagove`, `montopagado`, `montodevuelto`, `fechavencecredito`, `statusventa`, `statuspago`, `fechaventa`, `codigo`, `cocinero`, `delivery`, `repartidor`, `entregado`, `observaciones`, `codarqueocaja`, `comprobante`, `serie_doc`, `aceptado`, `enviado`) VALUES
(52, '00000001', 1, 10, 1, 0.00, 32.00, 18, 0.00, 0, 0.00, 32.00, 32.00, 'CONTADO', '1', 32.00, 0.00, '0000-00-00', 'PAGADA', 0, '2021-07-25 02:57:25', 1, 0, 0, 0, 0, '12', 4, 1, '001', 'Aceptada', 1),
(53, '00000002', 1, 10, 2, 0.00, 32.00, 18, 0.00, 0, 0.00, 32.00, 32.00, 'CONTADO', '1', 32.00, 0.00, '0000-00-00', 'PAGADA', 0, '2021-07-25 04:03:49', 1, 0, 0, 0, 0, '', 4, 1, '001', 'Aceptada', 1),
(54, '00000003', 1, 10, 2, 0.00, 32.00, 18, 0.00, 0, 0.00, 32.00, 32.00, 'CONTADO', '1', 32.00, 0.00, '0000-00-00', 'PAGADA', 0, '2021-07-25 04:21:33', 1, 0, 0, 0, 0, '', 4, 1, '001', 'Aceptada', 1),
(55, '00000004', 1, 10, 4, 0.00, 17.00, 18, 0.00, 0, 0.00, 17.00, 17.00, 'CONTADO', '1', 17.00, 0.00, '0000-00-00', 'PAGADA', 0, '2021-07-25 04:25:13', 1, 0, 0, 0, 0, '', 4, 1, '001', 'Aceptada', 1),
(56, '00000005', 1, 10, 2, 0.00, 32.00, 18, 0.00, 0, 0.00, 32.00, 32.00, 'CONTADO', '1', 32.00, 0.00, '0000-00-00', 'PAGADA', 1, '2021-07-25 04:46:44', 1, 1, 0, 0, 0, '', 4, 1, '001', 'Aceptada', 1),
(57, '00000006', 1, 10, 2, 0.00, 17.00, 18, 0.00, 0, 0.00, 17.00, 17.00, 'CONTADO', '1', 17.00, 0.00, '0000-00-00', 'PAGADA', 0, '2021-07-25 05:10:58', 1, 0, 0, 0, 0, '', 4, 3, '001', 'no', 1),
(58, '00000007', 1, 10, 2, 0.00, 32.00, 18, 0.00, 0, 0.00, 32.00, 32.00, 'CONTADO', '1', 32.00, 0.00, '0000-00-00', 'PAGADA', 0, '2021-07-25 05:43:19', 1, 0, 0, 0, 0, '', 4, 1, '001', 'Aceptada', 1),
(59, '00000008', 1, 11, 4, 0.00, 30.00, 18, 0.00, 0, 0.00, 30.00, 30.00, 'CONTADO', '1', 30.00, 0.00, '0000-00-00', 'PAGADA', 0, '2021-07-25 06:13:39', 1, 0, 0, 0, 0, '', 4, 2, '001', 'no', 1),
(60, '00000009', 1, 11, 5, 0.00, 32.00, 18, 0.00, 0, 0.00, 32.00, 32.00, 'CONTADO', '1', 32.00, 0.00, '0000-00-00', 'PAGADA', 0, '2021-07-25 06:18:23', 1, 0, 0, 0, 0, '', 4, 2, '001', 'no', 1),
(61, '00000010', 1, 11, 6, 0.00, 30.00, 18, 0.00, 0, 0.00, 30.00, 30.00, 'CONTADO', '1', 30.00, 0.00, '0000-00-00', 'PAGADA', 0, '2021-07-25 06:24:52', 1, 0, 0, 0, 0, '', 4, 2, '001', 'Aceptada', 1),
(62, '00000011', 1, 10, 2, 0.00, 32.00, 18, 0.00, 0, 0.00, 32.00, 32.00, 'CONTADO', '1', 32.00, 0.00, '0000-00-00', 'PAGADA', 0, '2021-07-25 06:25:56', 1, 0, 0, 0, 0, '', 4, 2, '001', 'no', 1),
(63, '00000012', 1, 0, 2, 0.00, 16.00, 18, 0.00, 0, 0.00, 16.00, 16.00, 'CONTADO', '1', 16.00, 0.00, '0000-00-00', 'PAGADA', 0, '2022-03-31 07:10:42', 1, 0, 0, 0, 0, '', 4, 3, '001', 'no', 1),
(64, '00000013', 1, 0, 4, 0.00, 49.00, 18, 0.00, 0, 0.00, 49.00, 49.00, 'CONTADO', '1', 49.00, 0.00, '0000-00-00', 'PAGADA', 0, '2022-03-31 07:28:43', 1, 0, 0, 0, 0, '', 4, 3, '001', 'no', 1),
(65, '00000014', 1, 0, 5, 0.00, 32.00, 18, 0.00, 0, 0.00, 32.00, 32.00, 'CONTADO', '1', 32.00, 0.00, '0000-00-00', 'PAGADA', 0, '2022-03-31 07:32:39', 1, 0, 0, 0, 0, '', 4, 3, '001', 'no', 1),
(66, '0000015', 0, 5, 0, 0.00, 48.50, 18, 0.00, 0, 0.00, 48.50, 52.50, 'CONTADO', '1', 48.50, 0.00, '0000-00-00', 'PAGADA', 0, '2022-03-31 08:18:43', 1, 1, 1, 6, 1, '', 4, 1, '001', 'no', 1),
(67, '0000016', 0, 22, 0, 0.00, 49.00, 18, 0.00, 0, 0.00, 49.00, 49.00, 'CONTADO', '1', 49.00, 0.00, '0000-00-00', 'PAGADA', 0, '2022-04-03 18:53:17', 1, 1, 1, 6, 1, 'No', 4, 1, '001', 'no', 1),
(68, '0000017', 0, 22, 0, 0.00, 49.00, 18, 0.00, 0, 0.00, 49.00, 49.00, 'CONTADO', '1', 49.00, 0.00, '0000-00-00', 'PAGADA', 0, '2022-04-03 18:53:17', 1, 1, 1, 6, 1, 'No', 4, 1, '001', 'no', 1),
(69, '0000018', 0, 23, 0, 0.00, 32.50, 18, 0.00, 0, 0.00, 32.50, 32.50, 'CONTADO', '1', 32.50, 0.00, '0000-00-00', 'PAGADA', 0, '2022-04-03 18:59:36', 1, 1, 1, 6, 0, 'No', 4, 1, '001', 'no', 1),
(70, '00000019', 1, 0, 8, 0.00, 64.00, 18, 0.00, 0, 0.00, 64.00, 64.00, 'CONTADO', '1', 64.00, 0.00, '0000-00-00', 'PAGADA', 0, '2022-04-03 08:02:56', 1, 0, 0, 0, 0, '', 4, 3, '001', 'no', 1),
(71, '0000020', 0, 23, 0, 0.00, 48.00, 18, 0.00, 0, 0.00, 48.00, 48.00, 'CONTADO', '1', 48.00, 0.00, '0000-00-00', 'PAGADA', 0, '2022-04-03 21:36:50', 1, 1, 1, 6, 1, 'No', 4, 1, '001', 'no', 1),
(72, '00000021', 1, 0, 2, 0.00, 275.00, 18, 0.00, 0, 0.00, 275.00, 275.00, 'CONTADO', '1', 275.00, 0.00, '0000-00-00', 'PAGADA', 0, '2022-04-04 01:01:40', 1, 0, 0, 0, 0, '', 4, 3, '001', 'no', 1),
(73, '00000021', 1, 0, 4, 0.00, 275.00, 18, 0.00, 0, 0.00, 275.00, 275.00, 'CONTADO', '1', 275.00, 0.00, '0000-00-00', 'PAGADA', 0, '2022-04-04 01:07:59', 1, 0, 0, 0, 0, '', 4, 3, '001', 'no', 1),
(74, '00000021', 1, 0, 4, 0.00, 275.00, 18, 0.00, 0, 0.00, 275.00, 275.00, 'CONTADO', '1', 275.00, 0.00, '0000-00-00', 'PAGADA', 0, '2022-04-04 01:12:04', 1, 0, 0, 0, 0, '', 4, 3, '001', 'no', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonoscreditos`
--
ALTER TABLE `abonoscreditos`
  ADD PRIMARY KEY (`codabono`);

--
-- Indices de la tabla `arqueocaja`
--
ALTER TABLE `arqueocaja`
  ADD PRIMARY KEY (`codarqueo`);

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`codcaja`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codcategoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`codcliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idcompra`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallecompras`
--
ALTER TABLE `detallecompras`
  ADD PRIMARY KEY (`coddetallecompra`);

--
-- Indices de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD PRIMARY KEY (`coddetalleventa`);

--
-- Indices de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`idingrediente`);

--
-- Indices de la tabla `kardexingredientes`
--
ALTER TABLE `kardexingredientes`
  ADD PRIMARY KEY (`codkardexing`);

--
-- Indices de la tabla `kardexproductos`
--
ALTER TABLE `kardexproductos`
  ADD PRIMARY KEY (`codkardex`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mediospagos`
--
ALTER TABLE `mediospagos`
  ADD PRIMARY KEY (`codmediopago`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`codmesa`);

--
-- Indices de la tabla `movimientoscajas`
--
ALTER TABLE `movimientoscajas`
  ADD PRIMARY KEY (`codmovimientocaja`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codalmacen`);

--
-- Indices de la tabla `productosvsingredientes`
--
ALTER TABLE `productosvsingredientes`
  ADD PRIMARY KEY (`codagrega`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`codproveedor`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`codsala`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idventa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonoscreditos`
--
ALTER TABLE `abonoscreditos`
  MODIFY `codabono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `arqueocaja`
--
ALTER TABLE `arqueocaja`
  MODIFY `codarqueo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `codcaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `codcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `codcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `idcompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detallecompras`
--
ALTER TABLE `detallecompras`
  MODIFY `coddetallecompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  MODIFY `coddetalleventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `idingrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `kardexingredientes`
--
ALTER TABLE `kardexingredientes`
  MODIFY `codkardexing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT de la tabla `kardexproductos`
--
ALTER TABLE `kardexproductos`
  MODIFY `codkardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `mediospagos`
--
ALTER TABLE `mediospagos`
  MODIFY `codmediopago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `codmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `movimientoscajas`
--
ALTER TABLE `movimientoscajas`
  MODIFY `codmovimientocaja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codalmacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `productosvsingredientes`
--
ALTER TABLE `productosvsingredientes`
  MODIFY `codagrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=427;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `codproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `codsala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
