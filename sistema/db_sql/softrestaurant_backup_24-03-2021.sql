# +===================================================================
# | Generado el 24-03-2019 a las 11:25:06 AM 
# | Servidor: localhost
# | MySQL Version: 5.5.5-10.1.37-MariaDB
# | PHP Version: 7.3.1
# | Base de datos: 'softrestaurant'
# | Tablas: abonoscreditos;  arqueocaja;  cajas;  categorias;  clientes;  compras;  configuracion;  detallecompras;  detalleventas;  ingredientes;  kardexingredientes;  kardexproductos;  log;  mediospagos;  mesas;  movimientoscajas;  productos;  productosvsingredientes;  proveedores;  salas;  usuarios;  ventas
# +-------------------------------------------------------------------
# Si tienen tablas con relacion y no estan en orden dara problemas al recuperar datos. Para evitarlo:
SET FOREIGN_KEY_CHECKS=0; 
SET time_zone = '+00:00';
SET sql_mode = ''; 


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

# | Vaciado de tabla 'abonoscreditos'
# +-------------------------------------
DROP TABLE IF EXISTS `abonoscreditos`;


# | Estructura de la tabla 'abonoscreditos'
# +-------------------------------------
CREATE TABLE `abonoscreditos` (
  `codabono` int(11) NOT NULL AUTO_INCREMENT,
  `codventa` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcliente` int(11) NOT NULL,
  `montoabono` float(12,2) NOT NULL,
  `fechaabono` datetime NOT NULL,
  `codigo` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  PRIMARY KEY (`codabono`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'abonoscreditos'
# +-------------------------------------

# | Vaciado de tabla 'arqueocaja'
# +-------------------------------------
DROP TABLE IF EXISTS `arqueocaja`;


# | Estructura de la tabla 'arqueocaja'
# +-------------------------------------
CREATE TABLE `arqueocaja` (
  `codarqueo` int(11) NOT NULL AUTO_INCREMENT,
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
  `codigo` int(11) NOT NULL,
  PRIMARY KEY (`codarqueo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
                
# | Carga de datos de la tabla 'arqueocaja'
# +-------------------------------------

# | Vaciado de tabla 'cajas'
# +-------------------------------------
DROP TABLE IF EXISTS `cajas`;


# | Estructura de la tabla 'cajas'
# +-------------------------------------
CREATE TABLE `cajas` (
  `codcaja` int(11) NOT NULL AUTO_INCREMENT,
  `nrocaja` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombrecaja` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo` int(11) NOT NULL,
  PRIMARY KEY (`codcaja`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'cajas'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `cajas` (`codcaja`, `nrocaja`, `nombrecaja`, `codigo`) VALUES 
      ('1', '00001', 'PRINCIPAL', '1'), 
      ('2', '00002', 'SECUNDARIA', '2');
COMMIT;

# | Vaciado de tabla 'categorias'
# +-------------------------------------
DROP TABLE IF EXISTS `categorias`;


# | Estructura de la tabla 'categorias'
# +-------------------------------------
CREATE TABLE `categorias` (
  `codcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nomcategoria` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'categorias'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `categorias` (`codcategoria`, `nomcategoria`) VALUES 
      ('1', 'ASADOS'), 
      ('2', 'SUIZOS'), 
      ('3', 'SALCHIPAPAS'), 
      ('4', 'PICADAS'), 
      ('5', 'MAIZ DESGRANADOS'), 
      ('6', 'HAMBURGUESAS'), 
      ('7', 'CHUZOS DESGRANADOS'), 
      ('8', 'PERROS'), 
      ('9', 'PATACONES'), 
      ('10', 'BEBIDAS'), 
      ('11', 'ADICIONALES');
COMMIT;

# | Vaciado de tabla 'clientes'
# +-------------------------------------
DROP TABLE IF EXISTS `clientes`;


# | Estructura de la tabla 'clientes'
# +-------------------------------------
CREATE TABLE `clientes` (
  `codcliente` int(11) NOT NULL AUTO_INCREMENT,
  `cedcliente` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomcliente` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccliente` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tlfcliente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `emailcliente` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'clientes'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `clientes` (`codcliente`, `cedcliente`, `nomcliente`, `direccliente`, `tlfcliente`, `emailcliente`) VALUES 
      ('1', '8909856037', 'HOSPITAL SAN SEBASTIAN DE URABA', 'VIA A TURBO', '821 454 6', ''), 
      ('2', '8166139', 'CARLOS MARIO RAMOS AGAMEZ', 'CLL DEL CEMENTERIO - NECOCLI ANTIOQUIA', '310 545 4011', 'CARLOSMARIO@HOTMAIL.COM'), 
      ('3', '1067851702', 'YUSTTER HERNAN HOYOS', 'CLL DEL CEMENTERIO NECOCLI - ANTIOQUIA', '321 516 5858', 'YUSSTER@HOTMAIL.COM'), 
      ('4', '1067877555', 'ALBA ROSA ALVAREZ ARGEL', 'CLL DEL CEMENTERIO NECOCLI - ANTIOQUIA', '311 436 2229', 'ALBAROSA@HOTMAIL.COM'), 
      ('5', '1068806992', 'NAURYS NEGRETE BARRIOS', 'CLL DEL CEMENTERIO NECOCLI - ANTIOQUIA', '322 414 6975', 'NAURYSNEGRETE@HOTMAIL.COM'), 
      ('6', '1040804386', 'LUZ ESTHER SERRANO', 'BARRIO SIMON BOLIVAR NECOCLI - ANTIOQUIA', '310 748 0032', 'LUZESTHER@HOTMAIL.COM'), 
      ('7', '1068811764', 'DORAINE NEGRETE BARRIOS', 'CLL DEL CEMENTERIO NECOCLI - ANTIOQUIA', '320 737 4971', 'DORAINEGRETE1988@HOTMAIL.COM'), 
      ('8', '10688117647', 'DONEBA', 'CLL 51 47 48', '323 352 4016', 'DORAINEGRETE1988@HOTMAIL.COM'), 
      ('9', '1020465519', 'KATERINE LLORENTE DIAZ', 'VEREDA HOYITO', '323 229 0549', 'KETE_LLORENTE@HOTMAIL.COM');
COMMIT;

# | Vaciado de tabla 'compras'
# +-------------------------------------
DROP TABLE IF EXISTS `compras`;


# | Estructura de la tabla 'compras'
# +-------------------------------------
CREATE TABLE `compras` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
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
  `codigo` int(11) NOT NULL,
  PRIMARY KEY (`idcompra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'compras'
# +-------------------------------------

# | Vaciado de tabla 'configuracion'
# +-------------------------------------
DROP TABLE IF EXISTS `configuracion`;


# | Estructura de la tabla 'configuracion'
# +-------------------------------------
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'configuracion'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `configuracion` (`id`, `rifempresa`, `nomempresa`, `direcempresa`, `tlfempresa`, `correoempresa`, `cedresponsable`, `nomresponsable`, `correoresponsable`, `tlfresponsable`, `ivac`, `ivav`, `simbolo`) VALUES 
      ('1', '1068811764-7', 'DONEBA RESTAURANTE', 'AVENIDA ROMULO, CALLE 51 # 47-48', '323 352 4016', 'DONEBAREST@GMAIL.COM', '1068811764', 'DORAINE NEGRETE BARRIOS', 'DORAINEGRETE1998@HOTMAIL.COM', '323 352 4016', '0.00', '0.00', '$');
COMMIT;

# | Vaciado de tabla 'detallecompras'
# +-------------------------------------
DROP TABLE IF EXISTS `detallecompras`;


# | Estructura de la tabla 'detallecompras'
# +-------------------------------------
CREATE TABLE `detallecompras` (
  `coddetallecompra` int(11) NOT NULL AUTO_INCREMENT,
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
  `codigo` int(11) NOT NULL,
  PRIMARY KEY (`coddetallecompra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'detallecompras'
# +-------------------------------------

# | Vaciado de tabla 'detalleventas'
# +-------------------------------------
DROP TABLE IF EXISTS `detalleventas`;


# | Estructura de la tabla 'detalleventas'
# +-------------------------------------
CREATE TABLE `detalleventas` (
  `coddetalleventa` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`coddetalleventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'detalleventas'
# +-------------------------------------

# | Vaciado de tabla 'ingredientes'
# +-------------------------------------
DROP TABLE IF EXISTS `ingredientes`;


# | Estructura de la tabla 'ingredientes'
# +-------------------------------------
CREATE TABLE `ingredientes` (
  `idingrediente` int(11) NOT NULL AUTO_INCREMENT,
  `codingrediente` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomingrediente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantingrediente` float(5,2) NOT NULL,
  `costoingrediente` float(12,2) NOT NULL,
  `unidadingrediente` varchar(6) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codproveedor` int(11) NOT NULL,
  `stockminimoingrediente` float(5,2) NOT NULL,
  PRIMARY KEY (`idingrediente`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'ingredientes'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `ingredientes` (`idingrediente`, `codingrediente`, `nomingrediente`, `cantingrediente`, `costoingrediente`, `unidadingrediente`, `codproveedor`, `stockminimoingrediente`) VALUES 
      ('1', '1', 'PAPAS A LA FRANCESA', '184.50', '1100.00', 'UNID.', '1', '20.00'), 
      ('2', '2', 'LOMO DE RES', '70.00', '9500.00', 'UNID.', '1', '0.00'), 
      ('3', '3', 'BUTIFARRA', '85.00', '430.20', 'UNID.', '1', '30.00'), 
      ('4', '4', 'LOMO DE CERDO', '16.50', '6000.00', 'UNID.', '1', '15.00'), 
      ('5', '5', 'PECHUGA ', '107.00', '6000.00', 'UNID.', '1', '15.00'), 
      ('6', '6', 'SALCHICHA DE PERRO', '96.00', '463.00', 'UNID.', '1', '30.00'), 
      ('7', '7', 'SALCHICHA AMERICANA', '31.00', '1248.00', 'UNID.', '1', '10.00'), 
      ('8', '8', 'SUIZA', '96.50', '3075.00', 'UNID.', '1', '10.00'), 
      ('9', '9', 'RANCHERA', '77.00', '1828.57', 'UNID.', '1', '10.00'), 
      ('10', '10', 'MANGUERA', '132.00', '1016.00', 'UNID.', '1', '30.00'), 
      ('11', '11', 'CHORIZO', '60.55', '999.00', 'UNID.', '1', '20.00'), 
      ('12', '12', 'JAMON', '122.00', '173.00', 'UNID.', '1', '10.00'), 
      ('13', '13', 'MOZARELLA', '386.00', '250.00', 'UNID.', '1', '10.00'), 
      ('14', '14', 'TOCINETA', '17.00', '473.48', 'UNID.', '1', '15.00'), 
      ('15', '15', 'MAIZ', '30.00', '1366.71', 'UNID.', '1', '6.00'), 
      ('16', '16', 'PAN PERRO', '87.00', '350.00', 'UNID.', '1', '5.00'), 
      ('17', '17', 'PAN HAMBURGUESA', '40.00', '450.00', 'UNID.', '1', '0.00'), 
      ('18', '18', 'PATACON', '120.00', '300.00', 'UNID.', '1', '12.00'), 
      ('19', '19', 'HAMBURGUESA CARNE', '83.00', '2000.00', 'UNID.', '1', '20.00'), 
      ('20', '20', 'HAMBURGUESA DE POLLO', '50.00', '2000.00', 'UNID.', '1', '5.00'), 
      ('21', '21', 'PICADA DE POLLO', '46.00', '4000.00', 'UNID.', '1', '10.00'), 
      ('22', '22', 'PICADA DE LOMITO', '120.00', '5000.00', 'UNID.', '1', '10.00'), 
      ('23', '23', 'PICADA DE CERDO', '39.00', '4500.00', 'UNID.', '1', '20.00'), 
      ('24', '24', 'CHUZO DE POLLO', '180.50', '3000.00', 'UNID.', '1', '20.00'), 
      ('25', '25', 'CHUZO DE LOMITO', '21.50', '4000.00', 'UNID.', '1', '8.00'), 
      ('26', '26', 'CHUZO DE CERDO', '18.00', '3500.00', 'UNID.', '1', '5.00'), 
      ('27', '27', 'PUNTA ANCA', '21.00', '6500.00', 'UNID.', '1', '10.00'), 
      ('28', '28', 'CHURRASCO', '21.00', '6500.00', 'UNID.', '1', '10.00');
COMMIT;

# | Vaciado de tabla 'kardexingredientes'
# +-------------------------------------
DROP TABLE IF EXISTS `kardexingredientes`;


# | Estructura de la tabla 'kardexingredientes'
# +-------------------------------------
CREATE TABLE `kardexingredientes` (
  `codkardexing` int(11) NOT NULL AUTO_INCREMENT,
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
  `fechakardexing` date NOT NULL,
  PRIMARY KEY (`codkardexing`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
                
# | Carga de datos de la tabla 'kardexingredientes'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `kardexingredientes` (`codkardexing`, `codprocesoing`, `codresponsableing`, `codproducto`, `codingrediente`, `movimientoing`, `entradasing`, `salidasing`, `stockactualing`, `preciouniting`, `costototaling`, `documentoing`, `fechakardexing`) VALUES 
      ('1', '1', '0', '0', '1', 'ENTRADAS', '184.50', '0.00', '184.50', '1100.00', '202950.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('2', '2', '0', '0', '2', 'ENTRADAS', '70.00', '0.00', '70.00', '9500.00', '665000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('3', '3', '0', '0', '3', 'ENTRADAS', '85.00', '0.00', '85.00', '430.20', '36567.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('4', '4', '0', '0', '4', 'ENTRADAS', '16.50', '0.00', '16.50', '6000.00', '99000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('5', '5', '0', '0', '5', 'ENTRADAS', '107.00', '0.00', '107.00', '6000.00', '642000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('6', '6', '0', '0', '6', 'ENTRADAS', '96.00', '0.00', '96.00', '463.00', '44448.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('7', '7', '0', '0', '7', 'ENTRADAS', '31.00', '0.00', '31.00', '1248.00', '38688.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('8', '8', '0', '0', '8', 'ENTRADAS', '96.50', '0.00', '96.50', '3075.00', '296737.50', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('9', '9', '0', '0', '9', 'ENTRADAS', '77.00', '0.00', '77.00', '1828.57', '140799.88', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('10', '10', '0', '0', '10', 'ENTRADAS', '132.00', '0.00', '132.00', '1016.00', '134112.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('11', '11', '0', '0', '11', 'ENTRADAS', '60.55', '0.00', '60.55', '999.00', '60489.45', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('12', '12', '0', '0', '12', 'ENTRADAS', '122.00', '0.00', '122.00', '173.00', '21106.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('13', '13', '0', '0', '13', 'ENTRADAS', '386.00', '0.00', '386.00', '250.00', '96500.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('14', '14', '0', '0', '14', 'ENTRADAS', '17.00', '0.00', '17.00', '473.48', '8049.16', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('15', '15', '0', '0', '15', 'ENTRADAS', '30.00', '0.00', '30.00', '1366.71', '41001.30', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('16', '16', '0', '0', '16', 'ENTRADAS', '87.00', '0.00', '87.00', '350.00', '30450.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('17', '17', '0', '0', '17', 'ENTRADAS', '40.00', '0.00', '40.00', '450.00', '18000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('18', '18', '0', '0', '18', 'ENTRADAS', '120.00', '0.00', '120.00', '300.00', '36000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('19', '19', '0', '0', '19', 'ENTRADAS', '83.00', '0.00', '83.00', '2000.00', '166000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('20', '20', '0', '0', '20', 'ENTRADAS', '50.00', '0.00', '50.00', '2000.00', '100000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('21', '21', '0', '0', '21', 'ENTRADAS', '46.00', '0.00', '46.00', '4000.00', '184000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('22', '22', '0', '0', '22', 'ENTRADAS', '120.00', '0.00', '120.00', '5000.00', '600000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('23', '23', '0', '0', '23', 'ENTRADAS', '39.00', '0.00', '39.00', '4500.00', '175500.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('24', '24', '0', '0', '24', 'ENTRADAS', '180.50', '0.00', '180.50', '3000.00', '541500.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('25', '25', '0', '0', '25', 'ENTRADAS', '21.50', '0.00', '21.50', '4000.00', '86000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('26', '26', '0', '0', '26', 'ENTRADAS', '18.00', '0.00', '18.00', '3500.00', '63000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('27', '27', '0', '0', '27', 'ENTRADAS', '21.00', '0.00', '21.00', '6500.00', '136500.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('28', '28', '0', '0', '28', 'ENTRADAS', '21.00', '0.00', '21.00', '6500.00', '136500.00', 'INVENTARIO INICIAL', '2018-10-23');
COMMIT;

# | Vaciado de tabla 'kardexproductos'
# +-------------------------------------
DROP TABLE IF EXISTS `kardexproductos`;


# | Estructura de la tabla 'kardexproductos'
# +-------------------------------------
CREATE TABLE `kardexproductos` (
  `codkardex` int(11) NOT NULL AUTO_INCREMENT,
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
  `fechakardex` date NOT NULL,
  PRIMARY KEY (`codkardex`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
                
# | Carga de datos de la tabla 'kardexproductos'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `kardexproductos` (`codkardex`, `codproceso`, `codresponsable`, `codproducto`, `movimiento`, `entradas`, `salidas`, `devolucion`, `stockactual`, `preciom`, `costototal`, `documento`, `fechakardex`) VALUES 
      ('1', '1', '0', '1', 'ENTRADAS', '63.00', '0.00', '0.00', '10.00', '12000.00', '120000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('2', '2', '0', '2', 'ENTRADAS', '75.00', '0.00', '0.00', '10.00', '10000.00', '100000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('3', '3', '0', '3', 'ENTRADAS', '82.00', '0.00', '0.00', '10.00', '11000.00', '110000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('4', '4', '0', '4', 'ENTRADAS', '91.00', '0.00', '0.00', '10.00', '12400.00', '124000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('5', '5', '0', '5', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '13400.00', '134000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('6', '6', '0', '6', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '11000.00', '110000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('7', '7', '0', '7', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '14300.00', '143000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('8', '8', '0', '8', 'ENTRADAS', '57.00', '0.00', '0.00', '10.00', '10000.00', '100000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('9', '9', '0', '9', 'ENTRADAS', '93.00', '0.00', '0.00', '10.00', '10000.00', '100000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('10', '10', '0', '10', 'ENTRADAS', '928.00', '0.00', '0.00', '10.00', '8000.00', '80000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('11', '11', '0', '11', 'ENTRADAS', '816.00', '0.00', '0.00', '10.00', '4000.00', '40000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('12', '12', '0', '12', 'ENTRADAS', '92.00', '0.00', '0.00', '10.00', '14500.00', '145000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('13', '13', '0', '13', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '15300.00', '153000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('14', '14', '0', '14', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '18800.00', '188000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('15', '15', '0', '15', 'ENTRADAS', '91.00', '0.00', '0.00', '10.00', '10800.00', '108000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('16', '16', '0', '16', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '11100.00', '111000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('17', '17', '0', '17', 'ENTRADAS', '95.00', '0.00', '0.00', '10.00', '10900.00', '109000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('18', '18', '0', '18', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '8800.00', '88000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('19', '19', '0', '19', 'ENTRADAS', '89.00', '0.00', '0.00', '10.00', '13600.00', '136000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('20', '20', '0', '20', 'ENTRADAS', '95.00', '0.00', '0.00', '10.00', '11300.00', '113000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('21', '21', '0', '21', 'ENTRADAS', '95.00', '0.00', '0.00', '10.00', '19600.00', '196000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('22', '22', '0', '22', 'ENTRADAS', '892.00', '0.00', '0.00', '10.00', '6000.00', '60000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('23', '23', '0', '23', 'ENTRADAS', '81.00', '0.00', '0.00', '10.00', '8800.00', '88000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('24', '24', '0', '24', 'ENTRADAS', '85.00', '0.00', '0.00', '10.00', '8500.00', '85000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('25', '25', '0', '25', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '9100.00', '91000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('26', '26', '0', '26', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '8900.00', '89000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('27', '27', '0', '27', 'ENTRADAS', '94.00', '0.00', '0.00', '10.00', '8800.00', '88000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('28', '28', '0', '28', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '12900.00', '129000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('29', '29', '0', '29', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '23100.00', '231000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('30', '30', '0', '30', 'ENTRADAS', '58.00', '0.00', '0.00', '10.00', '8000.00', '80000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('31', '31', '0', '31', 'ENTRADAS', '93.00', '0.00', '0.00', '10.00', '8600.00', '86000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('32', '32', '0', '32', 'ENTRADAS', '91.00', '0.00', '0.00', '10.00', '8300.00', '83000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('33', '33', '0', '33', 'ENTRADAS', '74.00', '0.00', '0.00', '10.00', '11200.00', '112000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('34', '34', '0', '34', 'ENTRADAS', '59.00', '0.00', '0.00', '10.00', '8300.00', '83000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('35', '35', '0', '35', 'ENTRADAS', '86.00', '0.00', '0.00', '10.00', '8800.00', '88000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('36', '36', '0', '36', 'ENTRADAS', '87.00', '0.00', '0.00', '10.00', '6800.00', '68000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('37', '37', '0', '37', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '14100.00', '141000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('38', '38', '0', '38', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '8300.00', '83000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('39', '39', '0', '39', 'ENTRADAS', '95.00', '0.00', '0.00', '10.00', '11000.00', '110000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('40', '40', '0', '40', 'ENTRADAS', '95.00', '0.00', '0.00', '10.00', '10900.00', '109000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('41', '41', '0', '41', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '12200.00', '122000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('42', '42', '0', '42', 'ENTRADAS', '81.00', '0.00', '0.00', '10.00', '13600.00', '136000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('43', '43', '0', '43', 'ENTRADAS', '77.00', '0.00', '0.00', '10.00', '22000.00', '220000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('44', '44', '0', '44', 'ENTRADAS', '84.00', '0.00', '0.00', '10.00', '6000.00', '60000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('45', '45', '0', '45', 'ENTRADAS', '92.00', '0.00', '0.00', '10.00', '8800.00', '88000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('46', '46', '0', '46', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '8800.00', '88000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('47', '47', '0', '47', 'ENTRADAS', '94.00', '0.00', '0.00', '10.00', '9100.00', '91000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('48', '48', '0', '48', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '8900.00', '89000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('49', '49', '0', '49', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '9300.00', '93000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('50', '50', '0', '50', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '12900.00', '129000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('51', '51', '0', '51', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '15700.00', '157000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('52', '52', '0', '52', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '11800.00', '118000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('53', '53', '0', '53', 'ENTRADAS', '98.00', '0.00', '0.00', '10.00', '23100.00', '231000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('54', '54', '0', '54', 'ENTRADAS', '53.00', '0.00', '0.00', '10.00', '5000.00', '50000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('55', '55', '0', '55', 'ENTRADAS', '88.00', '0.00', '0.00', '10.00', '5000.00', '50000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('56', '56', '0', '56', 'ENTRADAS', '86.00', '0.00', '0.00', '10.00', '8300.00', '83000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('57', '57', '0', '57', 'ENTRADAS', '92.00', '0.00', '0.00', '10.00', '7200.00', '72000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('58', '58', '0', '58', 'ENTRADAS', '87.00', '0.00', '0.00', '10.00', '10500.00', '105000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('59', '59', '0', '59', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '8500.00', '85000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('60', '60', '0', '60', 'ENTRADAS', '98.00', '0.00', '0.00', '10.00', '13000.00', '130000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('61', '61', '0', '61', 'ENTRADAS', '89.00', '0.00', '0.00', '10.00', '9500.00', '95000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('62', '62', '0', '62', 'ENTRADAS', '39.00', '0.00', '0.00', '10.00', '6500.00', '65000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('63', '63', '0', '63', 'ENTRADAS', '89.00', '0.00', '0.00', '10.00', '7500.00', '75000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('64', '64', '0', '64', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '7300.00', '73000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('65', '65', '0', '65', 'ENTRADAS', '88.00', '0.00', '0.00', '10.00', '7000.00', '70000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('66', '66', '0', '66', 'ENTRADAS', '69.00', '0.00', '0.00', '10.00', '7900.00', '79000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('67', '67', '0', '67', 'ENTRADAS', '90.00', '0.00', '0.00', '10.00', '8900.00', '89000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('68', '68', '0', '68', 'ENTRADAS', '87.00', '0.00', '0.00', '10.00', '7500.00', '75000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('69', '69', '0', '69', 'ENTRADAS', '98.00', '0.00', '0.00', '10.00', '8100.00', '81000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('70', '70', '0', '70', 'ENTRADAS', '88.00', '0.00', '0.00', '10.00', '7800.00', '78000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('71', '71', '0', '71', 'ENTRADAS', '92.00', '0.00', '0.00', '10.00', '8100.00', '81000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('72', '72', '0', '72', 'ENTRADAS', '89.00', '0.00', '0.00', '10.00', '7700.00', '77000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('73', '73', '0', '73', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '8200.00', '82000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('74', '74', '0', '74', 'ENTRADAS', '98.00', '0.00', '0.00', '10.00', '7800.00', '78000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('75', '75', '0', '75', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '8900.00', '89000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('76', '76', '0', '76', 'ENTRADAS', '93.00', '0.00', '0.00', '10.00', '10700.00', '107000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('77', '77', '0', '77', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '8300.00', '83000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('78', '78', '0', '78', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '7500.00', '75000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('79', '79', '0', '79', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '7800.00', '78000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('80', '80', '0', '80', 'ENTRADAS', '98.00', '0.00', '0.00', '10.00', '7700.00', '77000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('81', '81', '0', '81', 'ENTRADAS', '91.00', '0.00', '0.00', '10.00', '7000.00', '70000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('82', '82', '0', '82', 'ENTRADAS', '98.00', '0.00', '0.00', '10.00', '7000.00', '70000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('83', '83', '0', '83', 'ENTRADAS', '98.00', '0.00', '0.00', '10.00', '8900.00', '89000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('84', '84', '0', '84', 'ENTRADAS', '95.00', '0.00', '0.00', '10.00', '12300.00', '123000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('85', '85', '0', '85', 'ENTRADAS', '92.00', '0.00', '0.00', '10.00', '13200.00', '132000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('86', '86', '0', '86', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '22000.00', '220000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('87', '87', '0', '87', 'ENTRADAS', '148.00', '0.00', '0.00', '50.00', '2000.00', '100000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('88', '88', '0', '88', 'ENTRADAS', '93.00', '0.00', '0.00', '50.00', '4000.00', '200000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('89', '89', '0', '89', 'ENTRADAS', '157.00', '0.00', '0.00', '5.00', '6000.00', '30000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('90', '90', '0', '90', 'ENTRADAS', '9.00', '0.00', '0.00', '5.00', '2500.00', '12500.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('91', '91', '0', '91', 'ENTRADAS', '146.00', '0.00', '0.00', '6.00', '2000.00', '12000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('92', '92', '0', '92', 'ENTRADAS', '113.00', '0.00', '0.00', '50.00', '2500.00', '125000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('93', '93', '0', '93', 'ENTRADAS', '150.00', '0.00', '0.00', '1.00', '3000.00', '3000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('94', '94', '0', '94', 'ENTRADAS', '115.00', '0.00', '0.00', '0.00', '2800.00', '0.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('95', '95', '0', '95', 'ENTRADAS', '16.00', '0.00', '0.00', '5.00', '2500.00', '12500.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('96', '96', '0', '96', 'ENTRADAS', '25.00', '0.00', '0.00', '6.00', '2000.00', '12000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('97', '97', '0', '97', 'ENTRADAS', '24.00', '0.00', '0.00', '5.00', '3000.00', '15000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('98', '98', '0', '98', 'ENTRADAS', '26.00', '0.00', '0.00', '10.00', '1500.00', '15000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('99', '99', '0', '99', 'ENTRADAS', '40.00', '0.00', '0.00', '10.00', '2500.00', '25000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('100', '100', '0', '100', 'ENTRADAS', '78.00', '0.00', '0.00', '10.00', '3000.00', '30000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('101', '101', '0', '101', 'ENTRADAS', '94.00', '0.00', '0.00', '10.00', '2750.00', '27500.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('102', '102', '0', '102', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '3050.00', '30500.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('103', '103', '0', '103', 'ENTRADAS', '91.00', '0.00', '0.00', '10.00', '1500.00', '15000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('104', '104', '0', '104', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '3300.00', '33000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('105', '105', '0', '105', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '2000.00', '20000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('106', '106', '0', '106', 'ENTRADAS', '94.00', '0.00', '0.00', '10.00', '1500.00', '15000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('107', '107', '0', '107', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '2750.00', '27500.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('108', '108', '0', '108', 'ENTRADAS', '38.00', '0.00', '0.00', '10.00', '700.00', '7000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('109', '109', '0', '109', 'ENTRADAS', '966.00', '0.00', '0.00', '10.00', '3000.00', '30000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('110', '110', '0', '110', 'ENTRADAS', '77.00', '0.00', '0.00', '10.00', '4400.00', '44000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('111', '111', '0', '111', 'ENTRADAS', '94.00', '0.00', '0.00', '10.00', '5800.00', '58000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('112', '112', '0', '112', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '7200.00', '72000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('113', '113', '0', '113', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '9400.00', '94000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('114', '114', '0', '114', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '5200.00', '52000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('115', '115', '0', '115', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '4500.00', '45000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('116', '116', '0', '116', 'ENTRADAS', '90.00', '0.00', '0.00', '10.00', '5000.00', '50000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('117', '117', '0', '117', 'ENTRADAS', '90.00', '0.00', '0.00', '10.00', '7200.00', '72000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('118', '118', '0', '118', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '5000.00', '50000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('119', '119', '0', '119', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '6000.00', '60000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('120', '120', '0', '120', 'ENTRADAS', '98.00', '0.00', '0.00', '10.00', '5800.00', '58000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('121', '122', '0', '122', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '5900.00', '59000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('122', '123', '0', '123', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '5000.00', '50000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('123', '124', '0', '124', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '5200.00', '52000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('124', '125', '0', '125', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '3700.00', '37000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('125', '126', '0', '126', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '8200.00', '82000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('126', '127', '0', '127', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '11000.00', '110000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('127', '128', '0', '128', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '11500.00', '115000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('128', '129', '0', '129', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '7500.00', '75000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('129', '130', '0', '130', 'ENTRADAS', '100.00', '0.00', '0.00', '10.00', '7000.00', '70000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('130', '131', '0', '131', 'ENTRADAS', '94.00', '0.00', '0.00', '10.00', '12000.00', '120000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('131', '132', '0', '132', 'ENTRADAS', '77.00', '0.00', '0.00', '10.00', '1000.00', '10000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('132', '133', '0', '133', 'ENTRADAS', '96.00', '0.00', '0.00', '10.00', '2000.00', '20000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('133', '134', '0', '134', 'ENTRADAS', '97.00', '0.00', '0.00', '10.00', '700.00', '7000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('134', '135', '0', '135', 'ENTRADAS', '98.00', '0.00', '0.00', '10.00', '2900.00', '29000.00', 'INVENTARIO INICIAL', '2018-10-23'), 
      ('135', '136', '0', '136', 'ENTRADAS', '99.00', '0.00', '0.00', '10.00', '6100.00', '61000.00', 'INVENTARIO INICIAL', '2018-10-23');
COMMIT;

# | Vaciado de tabla 'log'
# +-------------------------------------
DROP TABLE IF EXISTS `log`;


# | Estructura de la tabla 'log'
# +-------------------------------------
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo` datetime DEFAULT NULL,
  `detalles` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `paginas` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'log'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `log` (`id`, `ip`, `tiempo`, `detalles`, `paginas`, `usuario`) VALUES 
      ('1', '127.0.0.1', '2019-03-12 10:46:27', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:64.0) Gecko/20100101 Firefox/64.0', '/restaurant/index.php', 'RUBENCHIRINOS'), 
      ('2', '127.0.0.1', '2019-03-23 11:36:01', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0', '/restaurant/index.php', 'RUBENCHIRINOS'), 
      ('3', '127.0.0.1', '2019-03-24 11:24:58', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0', '/restaurant/index.php', 'RUBENCHIRINOS');
COMMIT;

# | Vaciado de tabla 'mediospagos'
# +-------------------------------------
DROP TABLE IF EXISTS `mediospagos`;


# | Estructura de la tabla 'mediospagos'
# +-------------------------------------
CREATE TABLE `mediospagos` (
  `codmediopago` int(11) NOT NULL AUTO_INCREMENT,
  `mediopago` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codmediopago`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'mediospagos'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `mediospagos` (`codmediopago`, `mediopago`) VALUES 
      ('1', 'EFECTIVO'), 
      ('2', 'TRANSFERENCIA'), 
      ('3', 'TARJETA DEBITO'), 
      ('4', 'TARJETA CREDITO'), 
      ('5', 'CHEQUE');
COMMIT;

# | Vaciado de tabla 'mesas'
# +-------------------------------------
DROP TABLE IF EXISTS `mesas`;


# | Estructura de la tabla 'mesas'
# +-------------------------------------
CREATE TABLE `mesas` (
  `codmesa` int(11) NOT NULL AUTO_INCREMENT,
  `codsala` int(11) NOT NULL,
  `nombremesa` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `mesacreada` datetime NOT NULL,
  `statusmesa` int(1) NOT NULL,
  PRIMARY KEY (`codmesa`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'mesas'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `mesas` (`codmesa`, `codsala`, `nombremesa`, `mesacreada`, `statusmesa`) VALUES 
      ('1', '1', 'MESA 1', '2017-11-08 11:44:33', '0'), 
      ('2', '1', 'MESA 2', '2017-11-08 12:05:05', '0'), 
      ('4', '1', 'MESA 3', '2017-11-10 02:08:07', '0'), 
      ('5', '1', 'MESA 4', '2017-11-10 02:08:20', '0'), 
      ('6', '1', 'MESA 5', '2017-11-10 02:08:32', '0'), 
      ('7', '1', 'MESA 6', '2017-11-10 02:08:57', '0'), 
      ('8', '1', 'MESA 7', '2017-11-10 02:09:08', '0'), 
      ('9', '1', 'MESA 8', '2017-11-10 02:09:22', '0'), 
      ('10', '1', 'M # 1 DROG.', '2017-11-10 02:09:56', '0'), 
      ('11', '1', 'M # 2 DROG.', '2017-11-10 02:10:20', '0'), 
      ('12', '1', 'M # 1 ZAPA.', '2017-11-10 02:10:41', '0'), 
      ('13', '1', 'M # 2 ZAPA.', '2017-11-10 02:10:58', '0'), 
      ('14', '2', 'MESA 1', '2017-11-10 02:11:11', '0'), 
      ('15', '2', 'MESA 2', '2017-11-10 02:11:27', '0'), 
      ('16', '2', 'MESA 3', '2018-10-20 11:35:29', '0'), 
      ('17', '2', 'MESA 4', '2018-10-20 11:35:35', '0'), 
      ('18', '3', 'MESA 1', '2018-10-20 11:35:40', '0'), 
      ('19', '3', 'MESA 2', '2018-10-20 11:35:46', '0');
COMMIT;

# | Vaciado de tabla 'movimientoscajas'
# +-------------------------------------
DROP TABLE IF EXISTS `movimientoscajas`;


# | Estructura de la tabla 'movimientoscajas'
# +-------------------------------------
CREATE TABLE `movimientoscajas` (
  `codmovimientocaja` int(11) NOT NULL AUTO_INCREMENT,
  `tipomovimientocaja` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `montomovimientocaja` float(12,2) NOT NULL,
  `mediopagomovimientocaja` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `descripcionmovimientocaja` text COLLATE utf8_spanish_ci NOT NULL,
  `fechamovimientocaja` datetime NOT NULL,
  `codigo` int(11) NOT NULL,
  PRIMARY KEY (`codmovimientocaja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
                
# | Carga de datos de la tabla 'movimientoscajas'
# +-------------------------------------

# | Vaciado de tabla 'productos'
# +-------------------------------------
DROP TABLE IF EXISTS `productos`;


# | Estructura de la tabla 'productos'
# +-------------------------------------
CREATE TABLE `productos` (
  `codalmacen` int(11) NOT NULL AUTO_INCREMENT,
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
  `statusproducto` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codalmacen`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'productos'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `productos` (`codalmacen`, `codproducto`, `producto`, `codcategoria`, `preciocompra`, `precioventa`, `existencia`, `stockminimo`, `ivaproducto`, `descproducto`, `codproveedor`, `codigobarra`, `favorito`, `statusproducto`) VALUES 
      ('1', '1', 'LOMITO DE RES', '1', '10000.00', '12000.00', '63.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('2', '2', 'PECHUGA A LA PLANCHA', '1', '8000.00', '10000.00', '75.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('3', '3', 'LOMITO DE CERDO', '1', '9000.00', '11000.00', '82.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('4', '4', 'LOMITO DE CERDO ENCEBOLLADO Y GRATINADO', '1', '10400.00', '12400.00', '91.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('5', '5', 'LOMITO DE RES ENCEBOLLADO Y GRATINADO', '1', '11400.00', '13400.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('6', '6', 'MIXTO', '1', '9000.00', '11000.00', '97.00', '10', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('7', '7', 'LOMITO DE CERDO RANCHERO', '1', '12000.00', '14300.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('8', '8', 'PUNTA DE ANCA', '1', '8000.00', '10000.00', '57.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('9', '9', 'CHURRASCO', '1', '8000.00', '10000.00', '93.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('10', '10', 'SUPER SUIZO', '2', '6000.00', '8000.00', '928.00', '10', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('11', '11', 'MINI SUIZO', '2', '3000.00', '4000.00', '816.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('12', '12', 'BANDEJA 4 CARNES', '1', '12000.00', '14500.00', '92.00', '10', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('13', '13', 'BANDEJA TRIFASICA', '1', '13000.00', '15300.00', '97.00', '10', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('14', '14', 'BANDEJA 5 CARNES', '1', '16000.00', '18800.00', '97.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('15', '15', 'SUIZO ESPECIAL_POLLO', '2', '8000.00', '10800.00', '91.00', '10', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('16', '16', 'SUIZO ESPECIAL_LOMITO', '2', '9000.00', '11100.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('17', '17', 'SUIZO ESPECIAL_CERDO', '2', '8000.00', '10900.00', '95.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('18', '18', 'SUIZO, CHORIZO Y BUTIFARRA', '2', '6000.00', '8800.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('19', '19', 'SUIZO CON TODO', '2', '11000.00', '13600.00', '89.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('20', '20', 'SUIZO RANCHERO', '2', '9000.00', '11300.00', '95.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('21', '21', 'SUIZO DONEBA', '2', '17000.00', '19600.00', '95.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('22', '22', 'SALCHIPAPA SENCILLA', '3', '4000.00', '6000.00', '892.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('23', '23', 'SALCHIPAPA CON POLLO', '3', '6800.00', '8800.00', '81.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('24', '24', 'SALCHIPAPA CHORIZO Y BUTIFARRA', '3', '6500.00', '8500.00', '85.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('25', '25', 'SALCHIPAPA CON LOMITO', '3', '7100.00', '9100.00', '97.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('26', '26', 'SALCHIPAPA CON CERDO', '3', '6900.00', '8900.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('27', '27', 'SALCHIPAPA CON SUIZA', '3', '6800.00', '8800.00', '94.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('28', '28', 'SALCHIPAPA HAWAIANA', '3', '10900.00', '12900.00', '97.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('29', '29', 'SALCHIPAPA DONEBA', '3', '21100.00', '23100.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('30', '30', 'PICADA DE POLLO', '4', '6000.00', '8000.00', '58.00', '10', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('31', '31', 'PICADA DE LOMITO', '4', '6600.00', '8600.00', '93.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('32', '32', 'PICADA DE CERDO', '4', '6300.00', '8300.00', '91.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('33', '33', 'PICADA TRIFASICA', '4', '100.00', '11200.00', '74.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('34', '34', 'PICADA MIXTA', '4', '6300.00', '8300.00', '59.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('35', '35', 'PICADA SUIZO, CHORIZO Y BUTIFARRA', '4', '6800.00', '8800.00', '86.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('36', '36', 'PICADA RANCHERA', '4', '5800.00', '6800.00', '87.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('37', '37', 'PICADA ESCOCESA', '4', '12100.00', '14100.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('38', '38', 'PICADA POLLO 100 GRS. Y MAIZ', '4', '6300.00', '8300.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('39', '39', 'PICADA DE POLLO 200 GRS. Y MAIZ', '4', '9000.00', '11000.00', '95.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('40', '40', 'PICADA HAWAIANA', '4', '8900.00', '10900.00', '95.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('41', '41', 'PICADA 4 CARNES', '4', '10200.00', '12200.00', '97.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('42', '42', 'PICADA CON TODO', '4', '11600.00', '13600.00', '81.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('43', '43', 'PICADA DONEBA', '4', '20000.00', '22000.00', '77.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('44', '44', 'MAIZ AMERICANO SENCILLO', '5', '4500.00', '6000.00', '84.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('45', '45', 'MAIZ CON SUIZO', '5', '5800.00', '8800.00', '92.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('46', '46', 'MAIZ CON POLLO', '5', '7800.00', '8800.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('47', '47', 'MAIZ CON LOMITO', '5', '8100.00', '9100.00', '94.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('48', '48', 'MAIZ CON CERDO', '5', '7900.00', '8900.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('49', '49', 'MAIZ RANCHERO', '5', '8300.00', '9300.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('50', '50', 'MAIZ HAWAIANO', '5', '11900.00', '12900.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('51', '51', 'MAIZ CON TODO', '5', '14700.00', '15700.00', '97.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('52', '52', 'MAIZ CON POLLO Y LOMITO', '5', '10800.00', '11800.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('53', '53', 'MAIZ DONEBA', '5', '21100.00', '23100.00', '98.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('54', '54', 'HAMB. DE CARNE', '6', '300.00', '5000.00', '53.00', '10', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('55', '55', 'HAMB. DE POLLO', '6', '3000.00', '5000.00', '88.00', '10', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('56', '56', 'HAMB. MIXTA', '6', '6000.00', '8300.00', '86.00', '10', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('57', '57', 'HAMB. HAWAIANA', '6', '6000.00', '7200.00', '92.00', '10', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('58', '58', 'HAMB. ESPECIAL', '6', '8000.00', '10500.00', '87.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('59', '59', 'HAMB. CARNE, CHORIZO Y BUTIFARRA', '6', '6000.00', '8500.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('60', '60', 'HAMB. DONEBA', '6', '10000.00', '13000.00', '98.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('61', '61', 'HAMB. COMBO', '6', '7000.00', '9500.00', '89.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('62', '62', 'CHUZO DE POLLO', '7', '5000.00', '6500.00', '39.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('63', '63', 'CHUZO DE LOMITO', '7', '6000.00', '7500.00', '89.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('64', '64', 'CHUZO DE CERDO', '7', '6000.00', '7300.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('65', '65', 'CHUZO DE POLLO Y LOMITO', '7', '5000.00', '7000.00', '88.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('66', '66', 'CHUZO DE POLLO GRATINADO', '7', '5900.00', '7900.00', '69.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('67', '67', 'CHUZO DE LOMITO GRATINADO', '7', '6900.00', '8900.00', '90.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('68', '68', 'PATACON CON POLLO', '9', '5000.00', '7500.00', '87.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('69', '69', 'PATACON CON LOMITO', '9', '6000.00', '8100.00', '98.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('70', '70', 'PATACON POLLO Y LOMITO', '9', '5800.00', '7800.00', '88.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('71', '71', 'PATACON POLLO Y RANCHERA', '9', '6000.00', '8100.00', '92.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('72', '72', 'PATACON POLLO Y CERDO', '9', '5700.00', '7700.00', '89.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('73', '73', 'PATACON CERDO Y RANCHERO', '9', '6200.00', '8200.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('74', '74', 'PATACON CON CERDO', '9', '5800.00', '7800.00', '98.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('75', '75', 'PATACON SUIZO AL GRATIN', '9', '6900.00', '8900.00', '97.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('76', '76', 'PATACON TRIFASICO', '9', '8700.00', '10700.00', '93.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('77', '77', 'PATACON SUIZO, CHORIZO Y BUTIFARRA', '9', '6300.00', '8300.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('78', '78', 'PATACON POLLO Y SUIZO', '9', '5500.00', '7500.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('79', '79', 'PATACON LOMITO Y SUIZO', '9', '5800.00', '7800.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('80', '80', 'PATACON LOMITO Y RANCHERA', '9', '5700.00', '7700.00', '98.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('81', '81', 'PATACON CERDO Y SUIZO', '9', '5000.00', '7000.00', '91.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('82', '82', 'PATACON CHORIZO Y BUTIFARRA', '9', '5000.00', '7000.00', '98.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('83', '83', 'PATACON HAWAIANA', '9', '6900.00', '8900.00', '98.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('84', '84', 'PATACON ESCOCES', '9', '10300.00', '12300.00', '95.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('85', '85', 'PATACON CON TODO', '9', '11200.00', '13200.00', '92.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('86', '86', 'PATACON DONEBA', '9', '20000.00', '22000.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('87', '87', 'GASEOSA 400', '10', '1300.00', '2000.00', '148.00', '50', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('88', '88', 'GASEOSA 1.5', '10', '2500.00', '4000.00', '93.00', '50', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('89', '89', 'GASEOSA 2.5', '10', '4500.00', '6000.00', '157.00', '5', 'NO', '0.00', '0', '0', 'SI', 'ACTIVO'), 
      ('90', '90', 'MT TEE', '10', '1525.00', '2500.00', '9.00', '5', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('91', '91', 'AGUA BOTELLA', '10', '1200.00', '2000.00', '146.00', '6', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('92', '92', 'HIT 500 ML', '10', '1525.00', '2500.00', '113.00', '50', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('93', '93', 'CERVEZA LIGTH', '10', '2000.00', '3000.00', '150.00', '1', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('94', '94', 'CERVEZA AGUILA NEGRA', '10', '1800.00', '2800.00', '115.00', '0', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('95', '95', 'H2O', '10', '1525.00', '2500.00', '16.00', '5', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('96', '96', 'BRETA?A', '10', '1300.00', '2000.00', '25.00', '6', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('97', '97', 'GATORADE', '10', '2050.00', '3000.00', '24.00', '5', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('98', '98', 'HIT CAJA', '10', '900.00', '1500.00', '26.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('99', '99', 'PAPAS A LA FRACESA', '11', '1100.00', '2500.00', '40.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('100', '100', ' PORCION MAIZ', '11', '1300.00', '3000.00', '78.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('101', '101', 'PORCION DE POLLO', '11', '4000.00', '2750.00', '94.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('102', '102', 'PORCION DE LOMITO', '11', '5000.00', '3050.00', '97.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('103', '103', 'BUTIFARRA', '11', '450.00', '1500.00', '91.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('104', '104', 'RANCHERA', '11', '1050.00', '3300.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('105', '105', 'CHORIZO', '11', '1000.00', '2000.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('106', '106', 'TOCINETA', '11', '800.00', '1500.00', '94.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('107', '107', 'SUIZA', '11', '1050.00', '2750.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('108', '108', 'MOZARELLA', '11', '300.00', '700.00', '38.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('109', '109', 'PERRO SENCILLO', '8', '2000.00', '3000.00', '966.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('110', '110', 'PERRO SUPER DONEBA', '8', '3000.00', '4400.00', '77.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('111', '111', 'PERRO AMERICANO', '8', '4000.00', '5800.00', '94.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('112', '112', 'PERRO SUIZO', '8', '5000.00', '7200.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('113', '113', 'PERRO ITALO SUIZO', '8', '7000.00', '9400.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('114', '114', 'PERRO SUICITO', '8', '3000.00', '5200.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('115', '115', 'PERRO CON TOCINETA', '8', '2500.00', '4500.00', '97.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('116', '116', 'PERRO RANCHERO', '8', '3500.00', '5000.00', '90.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('117', '117', 'PERRO ITALO RANCHERO', '8', '5000.00', '7200.00', '90.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('118', '118', 'PERRO CHORIPERRO', '8', '3500.00', '5000.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('119', '119', 'PERRO BUTIPERRO', '8', '4500.00', '6000.00', '97.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('120', '120', 'PERRO CON POLLO', '8', '3800.00', '5800.00', '98.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('121', '122', 'PERRO CON CERDO', '8', '3500.00', '5900.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('122', '123', 'PERRO GEMELO', '8', '3500.00', '5000.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('123', '124', 'PERRO HAWAIANO', '8', '3500.00', '5200.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('124', '125', 'PERRO ITALIANO', '8', '2000.00', '3700.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('125', '126', 'PERRO MIX', '8', '6000.00', '8200.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('126', '127', 'PERRO TRIFASICO', '8', '9000.00', '11000.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('127', '128', 'PERRO SALVAJE DONEBA', '8', '9500.00', '11500.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('128', '129', 'PERRO COMBO', '8', '5000.00', '7500.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('129', '130', 'PERRO SUIZO, CHORIZO Y BUTIFARRA', '8', '5000.00', '7000.00', '100.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('130', '131', 'PERRA', '8', '10000.00', '12000.00', '94.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('131', '132', 'TRABAJADOR', '11', '1000.00', '1000.00', '77.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('132', '133', 'DOMICILIO', '11', '1000.00', '2000.00', '96.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('133', '134', 'JAMON', '11', '300.00', '700.00', '97.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('134', '135', 'PORCION DE CERDO', '11', '1900.00', '2900.00', '98.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO'), 
      ('135', '136', 'PERRO CON LOMITO', '8', '4000.00', '6100.00', '99.00', '10', 'NO', '0.00', '0', '0', 'NO', 'ACTIVO');
COMMIT;

# | Vaciado de tabla 'productosvsingredientes'
# +-------------------------------------
DROP TABLE IF EXISTS `productosvsingredientes`;


# | Estructura de la tabla 'productosvsingredientes'
# +-------------------------------------
CREATE TABLE `productosvsingredientes` (
  `codagrega` int(11) NOT NULL AUTO_INCREMENT,
  `codproducto` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codingrediente` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantracion` float(5,2) NOT NULL,
  PRIMARY KEY (`codagrega`)
) ENGINE=InnoDB AUTO_INCREMENT=427 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'productosvsingredientes'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `productosvsingredientes` (`codagrega`, `codproducto`, `codingrediente`, `cantracion`) VALUES 
      ('1', '4', '1', '1.00'), 
      ('2', '4', '4', '1.00'), 
      ('5', '4', '13', '2.00'), 
      ('6', '5', '1', '1.00'), 
      ('7', '5', '2', '1.00'), 
      ('8', '5', '13', '2.00'), 
      ('9', '6', '1', '1.00'), 
      ('10', '6', '5', '0.50'), 
      ('11', '6', '2', '0.50'), 
      ('12', '7', '1', '1.00'), 
      ('13', '7', '4', '1.00'), 
      ('14', '7', '9', '1.00'), 
      ('15', '8', '1', '1.00'), 
      ('16', '8', '27', '1.00'), 
      ('17', '9', '1', '1.00'), 
      ('18', '9', '28', '1.00'), 
      ('19', '10', '1', '1.00'), 
      ('20', '10', '8', '1.00'), 
      ('21', '11', '1', '0.50'), 
      ('22', '11', '8', '0.50'), 
      ('23', '1', '1', '1.00'), 
      ('24', '1', '1', '1.00'), 
      ('25', '12', '11', '0.50'), 
      ('26', '12', '3', '1.00'), 
      ('27', '12', '5', '0.50'), 
      ('28', '12', '2', '0.50'), 
      ('29', '12', '1', '1.00'), 
      ('30', '2', '5', '1.00'), 
      ('31', '2', '1', '1.00'), 
      ('32', '13', '5', '0.50'), 
      ('33', '13', '2', '0.50'), 
      ('34', '13', '4', '0.50'), 
      ('35', '13', '1', '1.00'), 
      ('36', '14', '1', '1.00'), 
      ('37', '14', '2', '0.50'), 
      ('38', '14', '4', '0.50'), 
      ('39', '14', '5', '0.50'), 
      ('40', '14', '11', '0.50'), 
      ('41', '14', '3', '1.00'), 
      ('42', '15', '8', '0.50'), 
      ('43', '15', '21', '0.50'), 
      ('44', '15', '1', '1.00'), 
      ('45', '16', '8', '0.50'), 
      ('46', '16', '22', '0.50'), 
      ('47', '16', '1', '1.00'), 
      ('48', '17', '1', '1.00'), 
      ('49', '17', '8', '0.50'), 
      ('50', '17', '23', '0.50'), 
      ('51', '18', '1', '1.00'), 
      ('52', '18', '8', '0.50'), 
      ('53', '18', '11', '0.50'), 
      ('54', '18', '3', '1.00'), 
      ('55', '19', '1', '1.00'), 
      ('56', '19', '8', '0.50'), 
      ('57', '19', '21', '0.50'), 
      ('58', '19', '22', '0.50'), 
      ('59', '19', '11', '0.50'), 
      ('60', '19', '3', '1.00'), 
      ('61', '20', '1', '1.00'), 
      ('62', '20', '8', '0.50'), 
      ('63', '20', '9', '1.00'), 
      ('64', '20', '14', '1.00'), 
      ('65', '20', '12', '1.00'), 
      ('66', '21', '1', '1.00'), 
      ('67', '21', '8', '0.50'), 
      ('68', '21', '21', '0.50'), 
      ('69', '21', '22', '0.50'), 
      ('70', '21', '23', '0.50'), 
      ('71', '21', '3', '1.00'), 
      ('72', '21', '15', '0.50'), 
      ('73', '21', '9', '1.00'), 
      ('74', '22', '1', '1.00'), 
      ('75', '22', '10', '1.00'), 
      ('76', '23', '1', '1.00'), 
      ('77', '23', '10', '1.00'), 
      ('78', '23', '21', '0.50'), 
      ('79', '24', '1', '1.00'), 
      ('80', '24', '10', '1.00'), 
      ('81', '24', '11', '0.50'), 
      ('82', '24', '3', '1.00'), 
      ('83', '25', '1', '1.00'), 
      ('84', '25', '10', '1.00'), 
      ('85', '25', '22', '0.50'), 
      ('86', '26', '1', '1.00'), 
      ('87', '26', '23', '0.50'), 
      ('88', '26', '10', '1.00'), 
      ('89', '27', '1', '1.00'), 
      ('90', '27', '10', '1.00'), 
      ('91', '27', '8', '0.50'), 
      ('92', '28', '1', '1.00'), 
      ('93', '28', '10', '1.00'), 
      ('94', '28', '12', '1.00'), 
      ('95', '28', '14', '1.00'), 
      ('96', '28', '13', '2.00'), 
      ('97', '29', '8', '0.50'), 
      ('98', '30', '1', '1.00'), 
      ('99', '30', '21', '1.00'), 
      ('100', '31', '1', '1.00'), 
      ('101', '31', '22', '1.00'), 
      ('102', '32', '1', '1.00'), 
      ('103', '32', '23', '1.00'), 
      ('104', '33', '1', '1.00'), 
      ('105', '33', '22', '0.50'), 
      ('106', '33', '21', '0.50'), 
      ('107', '33', '23', '0.50'), 
      ('108', '34', '1', '1.00'), 
      ('109', '34', '21', '0.50'), 
      ('110', '34', '23', '0.50'), 
      ('111', '35', '1', '1.00'), 
      ('112', '35', '8', '0.50'), 
      ('113', '35', '11', '0.50'), 
      ('114', '35', '3', '1.00'), 
      ('115', '36', '1', '1.00'), 
      ('116', '36', '9', '1.00'), 
      ('117', '37', '21', '0.50'), 
      ('118', '37', '22', '0.50'), 
      ('119', '37', '8', '0.50'), 
      ('120', '37', '15', '0.50'), 
      ('121', '38', '1', '1.00'), 
      ('122', '38', '15', '0.50'), 
      ('123', '38', '21', '0.50'), 
      ('124', '39', '1', '1.00'), 
      ('125', '39', '15', '0.50'), 
      ('126', '39', '21', '1.00'), 
      ('127', '40', '1', '1.00'), 
      ('128', '40', '21', '0.50'), 
      ('129', '40', '23', '0.50'), 
      ('130', '40', '14', '1.00'), 
      ('131', '40', '12', '1.00'), 
      ('132', '40', '13', '2.00'), 
      ('133', '41', '1', '1.00'), 
      ('134', '41', '22', '0.50'), 
      ('135', '41', '21', '0.50'), 
      ('136', '41', '11', '0.50'), 
      ('137', '41', '3', '1.00'), 
      ('138', '42', '1', '1.00'), 
      ('139', '42', '22', '0.50'), 
      ('140', '42', '21', '0.50'), 
      ('141', '42', '8', '0.50'), 
      ('142', '42', '3', '1.00'), 
      ('143', '42', '11', '0.50'), 
      ('144', '43', '1', '1.00'), 
      ('145', '43', '21', '0.50'), 
      ('146', '43', '22', '0.50'), 
      ('147', '43', '23', '0.50'), 
      ('148', '43', '8', '0.50'), 
      ('149', '43', '11', '0.50'), 
      ('150', '43', '3', '1.00'), 
      ('151', '43', '9', '1.00'), 
      ('152', '43', '15', '0.50'), 
      ('153', '44', '15', '1.00'), 
      ('154', '45', '15', '1.00'), 
      ('155', '45', '8', '0.50'), 
      ('156', '46', '15', '1.00'), 
      ('157', '46', '21', '0.50'), 
      ('158', '47', '15', '1.00'), 
      ('159', '47', '22', '0.50'), 
      ('160', '48', '23', '0.50'), 
      ('161', '49', '15', '1.00'), 
      ('162', '49', '9', '1.00'), 
      ('163', '50', '15', '1.00'), 
      ('164', '50', '14', '1.00'), 
      ('165', '50', '12', '1.00'), 
      ('166', '50', '9', '1.00'), 
      ('167', '50', '13', '2.00'), 
      ('168', '51', '15', '1.00'), 
      ('169', '51', '21', '0.50'), 
      ('170', '51', '22', '0.50'), 
      ('171', '51', '3', '1.00'), 
      ('172', '51', '11', '0.50'), 
      ('173', '52', '15', '1.00'), 
      ('174', '52', '21', '0.50'), 
      ('175', '52', '22', '0.50'), 
      ('176', '53', '15', '1.00'), 
      ('177', '53', '21', '0.50'), 
      ('178', '53', '22', '0.50'), 
      ('179', '53', '23', '0.50'), 
      ('180', '53', '8', '0.50'), 
      ('181', '53', '3', '1.00'), 
      ('182', '53', '9', '1.00'), 
      ('183', '54', '19', '1.00'), 
      ('184', '54', '17', '1.00'), 
      ('185', '54', '13', '1.00'), 
      ('186', '55', '20', '1.00'), 
      ('187', '55', '17', '1.00'), 
      ('188', '55', '13', '1.00'), 
      ('189', '56', '17', '1.00'), 
      ('190', '56', '19', '1.00'), 
      ('191', '56', '20', '1.00'), 
      ('192', '56', '13', '1.00'), 
      ('193', '57', '17', '1.00'), 
      ('194', '57', '19', '1.00'), 
      ('195', '57', '14', '1.00'), 
      ('196', '57', '12', '1.00'), 
      ('197', '57', '13', '1.00'), 
      ('198', '58', '17', '1.00'), 
      ('199', '58', '19', '1.00'), 
      ('200', '58', '20', '1.00'), 
      ('201', '58', '14', '1.00'), 
      ('202', '58', '12', '1.00'), 
      ('203', '58', '13', '1.00'), 
      ('204', '59', '17', '1.00'), 
      ('205', '59', '19', '1.00'), 
      ('206', '59', '11', '0.50'), 
      ('207', '59', '3', '1.00'), 
      ('208', '60', '17', '1.00'), 
      ('209', '60', '19', '1.00'), 
      ('210', '60', '12', '1.00'), 
      ('211', '60', '3', '1.00'), 
      ('212', '60', '11', '0.50'), 
      ('213', '60', '20', '1.00'), 
      ('214', '60', '13', '1.00'), 
      ('215', '61', '17', '1.00'), 
      ('216', '61', '19', '1.00'), 
      ('217', '61', '13', '1.00'), 
      ('218', '61', '1', '1.00'), 
      ('219', '62', '24', '1.00'), 
      ('220', '62', '1', '1.00'), 
      ('221', '63', '25', '1.00'), 
      ('222', '63', '1', '1.00'), 
      ('223', '64', '26', '1.00'), 
      ('224', '64', '1', '1.00'), 
      ('225', '65', '1', '1.00'), 
      ('226', '65', '24', '0.50'), 
      ('227', '65', '25', '0.50'), 
      ('228', '66', '1', '1.00'), 
      ('229', '66', '24', '1.00'), 
      ('230', '66', '13', '2.00'), 
      ('231', '67', '1', '1.00'), 
      ('232', '67', '25', '1.00'), 
      ('233', '67', '13', '2.00'), 
      ('234', '68', '18', '1.00'), 
      ('235', '68', '21', '1.00'), 
      ('236', '69', '18', '1.00'), 
      ('237', '69', '22', '1.00'), 
      ('238', '70', '18', '1.00'), 
      ('239', '70', '21', '0.50'), 
      ('240', '70', '22', '0.50'), 
      ('241', '71', '18', '1.00'), 
      ('242', '71', '21', '0.50'), 
      ('243', '71', '9', '1.00'), 
      ('244', '72', '18', '1.00'), 
      ('245', '72', '21', '0.50'), 
      ('246', '72', '23', '0.50'), 
      ('247', '73', '18', '1.00'), 
      ('248', '73', '23', '0.50'), 
      ('249', '73', '9', '1.00'), 
      ('250', '74', '18', '1.00'), 
      ('251', '74', '23', '1.00'), 
      ('252', '75', '18', '1.00'), 
      ('253', '75', '8', '1.00'), 
      ('254', '75', '13', '2.00'), 
      ('255', '76', '18', '1.00'), 
      ('256', '76', '21', '0.50'), 
      ('257', '76', '22', '0.50'), 
      ('258', '76', '23', '0.50'), 
      ('259', '77', '18', '1.00'), 
      ('260', '77', '8', '0.50'), 
      ('261', '77', '11', '0.50'), 
      ('262', '77', '3', '1.00'), 
      ('263', '78', '18', '1.00'), 
      ('264', '78', '21', '0.50'), 
      ('265', '78', '8', '0.50'), 
      ('266', '79', '18', '1.00'), 
      ('267', '79', '22', '0.50'), 
      ('268', '79', '8', '0.50'), 
      ('269', '80', '18', '1.00'), 
      ('270', '80', '22', '0.50'), 
      ('271', '80', '9', '1.00'), 
      ('272', '81', '18', '1.00'), 
      ('273', '81', '23', '0.50'), 
      ('274', '81', '8', '0.50'), 
      ('275', '82', '18', '1.00'), 
      ('276', '82', '11', '1.00'), 
      ('277', '82', '3', '2.00'), 
      ('278', '83', '18', '1.00'), 
      ('279', '83', '13', '2.00'), 
      ('280', '83', '12', '1.00'), 
      ('281', '83', '14', '1.00'), 
      ('282', '83', '21', '0.50'), 
      ('283', '84', '18', '1.00'), 
      ('284', '84', '15', '0.50'), 
      ('285', '84', '21', '0.50'), 
      ('286', '84', '22', '0.50'), 
      ('287', '85', '18', '1.00'), 
      ('288', '85', '22', '0.50'), 
      ('289', '85', '21', '0.50'), 
      ('290', '85', '3', '1.00'), 
      ('291', '85', '11', '0.50'), 
      ('292', '85', '8', '0.50'), 
      ('293', '86', '18', '1.00'), 
      ('294', '86', '21', '0.50'), 
      ('295', '86', '22', '0.50'), 
      ('296', '86', '23', '0.50'), 
      ('297', '86', '8', '0.50'), 
      ('298', '86', '11', '0.50'), 
      ('299', '86', '3', '1.00'), 
      ('300', '86', '9', '1.00'), 
      ('301', '86', '15', '0.50'), 
      ('302', '99', '1', '1.00');
COMMIT;
INSERT IGNORE INTO `productosvsingredientes` (`codagrega`, `codproducto`, `codingrediente`, `cantracion`) VALUES 
      ('303', '100', '15', '0.50'), 
      ('304', '101', '21', '0.50'), 
      ('305', '102', '22', '0.50'), 
      ('306', '103', '3', '1.00'), 
      ('307', '104', '9', '1.00'), 
      ('308', '105', '11', '1.00'), 
      ('309', '106', '14', '1.00'), 
      ('310', '107', '8', '0.50'), 
      ('311', '108', '13', '1.00'), 
      ('312', '109', '16', '1.00'), 
      ('313', '109', '6', '1.00'), 
      ('314', '109', '13', '1.00'), 
      ('315', '110', '16', '1.00'), 
      ('316', '110', '7', '1.00'), 
      ('317', '110', '13', '1.00'), 
      ('318', '110', '12', '1.00'), 
      ('319', '111', '16', '1.00'), 
      ('320', '111', '8', '0.50'), 
      ('321', '111', '13', '1.00'), 
      ('322', '112', '16', '1.00'), 
      ('323', '112', '8', '1.00'), 
      ('324', '112', '13', '1.00'), 
      ('325', '113', '16', '1.00'), 
      ('326', '113', '8', '1.00'), 
      ('327', '113', '14', '1.00'), 
      ('328', '113', '12', '1.00'), 
      ('329', '113', '13', '1.00'), 
      ('330', '114', '16', '1.00'), 
      ('331', '114', '8', '0.50'), 
      ('332', '114', '13', '1.00'), 
      ('333', '115', '16', '1.00'), 
      ('334', '115', '14', '1.00'), 
      ('335', '115', '13', '1.00'), 
      ('336', '116', '16', '1.00'), 
      ('337', '116', '9', '1.00'), 
      ('338', '116', '13', '1.00'), 
      ('339', '116', '12', '1.00'), 
      ('340', '117', '16', '1.00'), 
      ('341', '117', '9', '1.00'), 
      ('342', '117', '14', '1.00'), 
      ('343', '117', '12', '1.00'), 
      ('344', '117', '13', '1.00'), 
      ('345', '118', '16', '1.00'), 
      ('346', '118', '11', '0.50'), 
      ('347', '118', '13', '1.00'), 
      ('348', '119', '16', '1.00'), 
      ('349', '119', '3', '1.00'), 
      ('350', '119', '13', '1.00'), 
      ('351', '120', '16', '1.00'), 
      ('352', '120', '21', '0.50'), 
      ('353', '120', '13', '1.00'), 
      ('354', '121', '16', '1.00'), 
      ('355', '121', '22', '0.50'), 
      ('356', '121', '13', '1.00'), 
      ('357', '122', '16', '1.00'), 
      ('358', '122', '23', '0.50'), 
      ('359', '122', '13', '1.00'), 
      ('360', '123', '16', '1.00'), 
      ('361', '123', '6', '2.00'), 
      ('362', '123', '13', '2.00'), 
      ('363', '124', '16', '1.00'), 
      ('364', '124', '14', '1.00'), 
      ('365', '124', '12', '1.00'), 
      ('366', '124', '13', '1.00'), 
      ('367', '125', '16', '1.00'), 
      ('368', '125', '12', '1.00'), 
      ('369', '125', '13', '1.00'), 
      ('370', '126', '16', '1.00'), 
      ('371', '126', '21', '0.50'), 
      ('372', '126', '22', '0.50'), 
      ('373', '126', '13', '1.00'), 
      ('374', '127', '16', '1.00'), 
      ('375', '127', '21', '0.50'), 
      ('376', '127', '22', '0.50'), 
      ('377', '127', '23', '0.50'), 
      ('378', '127', '13', '1.00'), 
      ('379', '128', '16', '1.00'), 
      ('380', '128', '21', '0.50'), 
      ('381', '128', '22', '0.50'), 
      ('382', '128', '11', '0.50'), 
      ('383', '128', '6', '1.00'), 
      ('384', '128', '13', '2.00'), 
      ('385', '129', '16', '1.00'), 
      ('386', '129', '6', '1.00'), 
      ('387', '129', '13', '1.00'), 
      ('388', '129', '1', '1.00'), 
      ('389', '130', '16', '1.00'), 
      ('390', '130', '13', '1.00'), 
      ('391', '130', '8', '0.50'), 
      ('392', '130', '11', '0.50'), 
      ('393', '130', '3', '1.00'), 
      ('394', '131', '16', '1.00'), 
      ('395', '131', '14', '7.00'), 
      ('396', '131', '13', '1.00'), 
      ('397', '134', '12', '1.00'), 
      ('398', '135', '23', '0.50'), 
      ('399', '29', '1', '1.00'), 
      ('400', '29', '9', '1.00'), 
      ('401', '29', '21', '0.50'), 
      ('402', '29', '22', '0.50'), 
      ('403', '29', '11', '0.50'), 
      ('404', '29', '3', '1.00'), 
      ('405', '29', '23', '0.50'), 
      ('406', '29', '15', '0.50'), 
      ('407', '29', '10', '1.00'), 
      ('408', '37', '1', '1.00'), 
      ('409', '48', '15', '1.00'), 
      ('410', '53', '11', '0.50'), 
      ('411', '59', '13', '1.00'), 
      ('412', '60', '14', '1.00'), 
      ('413', '111', '6', '1.00'), 
      ('414', '115', '6', '1.00'), 
      ('415', '118', '6', '1.00'), 
      ('416', '119', '6', '1.00'), 
      ('417', '120', '6', '1.00'), 
      ('418', '122', '6', '1.00'), 
      ('419', '124', '6', '1.00'), 
      ('420', '125', '6', '1.00'), 
      ('421', '3', '4', '1.00'), 
      ('422', '3', '1', '1.00'), 
      ('423', '136', '16', '1.00'), 
      ('424', '136', '22', '0.50'), 
      ('425', '136', '6', '1.00'), 
      ('426', '136', '13', '1.00');
COMMIT;

# | Vaciado de tabla 'proveedores'
# +-------------------------------------
DROP TABLE IF EXISTS `proveedores`;


# | Estructura de la tabla 'proveedores'
# +-------------------------------------
CREATE TABLE `proveedores` (
  `codproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `ritproveedor` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomproveedor` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direcproveedor` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tlfproveedor` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `emailproveedor` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contactoproveedor` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codproveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'proveedores'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `proveedores` (`codproveedor`, `ritproveedor`, `nomproveedor`, `direcproveedor`, `tlfproveedor`, `emailproveedor`, `contactoproveedor`) VALUES 
      ('1', '71261097-1', 'CASA FRICAR', 'MONTERIA', '314 596 9694', 'CASAFRICAR@HOTMAIL.COM', 'FERNEY'), 
      ('2', '43417696-3', 'DEPOSITO AL MAR', 'CLL COTIZADA NECOCLI', '821 43 42', 'DEPOSITOALMAR@HOTMAIL.COM', 'PALOMO'), 
      ('3', '1045507345-8', 'DISTRIFODS LA GRANJA', 'APARTADO ANTIOQUIA', '301 219 0235', 'DISTRIFODSLAGRANJA@HOTMAIL.COM', 'JAMES'), 
      ('4', '890903939-5', 'POSTOBON', 'CHIGORODO', '310 681 4957', 'POSTOBON@HOTMAIL.COM', 'JUAN DAVID'), 
      ('5', '1027953891-4', 'PORKY CARNE LA LIGA', 'NECOCLI - ANTIOQUIA', '301 452 8312', 'PORKY@HOTMAIL.COM', 'ANDREA JARAMILLO'), 
      ('6', 'PROVEEDORES VARIOS', 'PROVEEDORES VARIOS', 'NECOCLI - ANTIOQUIA', '320 737 4971', 'DORAINEGRETE@HOTMAIL.COM', 'VARIOS'), 
      ('7', '900430430-3', 'AGUILA GRUPO EMPRESARIAL S.A.S.', 'MONTERIA - CORDOBA', '317 370 3166', 'GRUPOAGUILA@HOTMAIL.COM', 'ADRIANA'), 
      ('8', '1039086972', 'EXPENDIO DE CARNES', 'PLAZA DE MERCADO', '322 662 5684', 'GERMAN@GMAIL.COM', 'GERMAN'), 
      ('9', '901022172-1', 'SOLANO ESCUDERO SAS', 'K1 VIA APARATADO', '828 379 9', 'SOLANO@HOTMAIL.COM', 'EDER FLOREZ');
COMMIT;

# | Vaciado de tabla 'salas'
# +-------------------------------------
DROP TABLE IF EXISTS `salas`;


# | Estructura de la tabla 'salas'
# +-------------------------------------
CREATE TABLE `salas` (
  `codsala` int(11) NOT NULL AUTO_INCREMENT,
  `nombresala` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `salacreada` datetime NOT NULL,
  PRIMARY KEY (`codsala`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'salas'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `salas` (`codsala`, `nombresala`, `salacreada`) VALUES 
      ('1', 'SALA PRINCIPAL', '2017-11-08 11:44:21'), 
      ('2', 'SALA SECUNDARIA', '2017-11-08 12:04:05'), 
      ('3', 'SALA BALCON', '2018-10-19 02:09:09');
COMMIT;

# | Vaciado de tabla 'usuarios'
# +-------------------------------------
DROP TABLE IF EXISTS `usuarios`;


# | Estructura de la tabla 'usuarios'
# +-------------------------------------
CREATE TABLE `usuarios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nrotelefono` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cargo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nivel` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `status` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'usuarios'
# +-------------------------------------

COMMIT;
INSERT IGNORE INTO `usuarios` (`codigo`, `cedula`, `nombres`, `nrotelefono`, `cargo`, `email`, `usuario`, `password`, `nivel`, `status`) VALUES 
      ('1', '18633174', 'RUBEN DARIO CHIRINOS RODRIGUEZ', '416 342 2924', 'WEBMASTER', 'ELSAIYA@GMAIL.COM', 'RUBENCHIRINOS', '3ee657cddb83008a70c1701814c36989456c64e6', 'ADMINISTRADOR', 'ACTIVO'), 
      ('2', '16317737', 'MARBELLAPAREDES MARQUEZ', '424 722 2094', 'WEBMASTER', 'PAREDESMARQUEZMARBELLA@GMAIL.COM', 'MARBELLAPAREDES', '3721ad498dd15cea0235827e328a0f5814ece591', 'CAJERO', 'ACTIVO'), 
      ('3', '23654387', 'MOISES RODOLFO CHIRINOS LEAL', '000 000 0000', 'MESERO', 'MOISESRODOLFO@GMAIL.COM', 'MOISESRODOLFO', '70753bef4d7b163dd7939aa7cefdffdfa0a07bc8', 'MESERO', 'ACTIVO'), 
      ('4', '129873456', 'RAFAEL DE JESUS CONTRERAS', '000 000 0000', 'COCINERO', 'JCOCINERO@GMAIL.COM', 'COCINERO', '87ca0623c32aa690c9eb93ef1002aa03fc11b691', 'COCINERO', 'ACTIVO'), 
      ('5', '24987234', 'MARIA DEL CARMEN CONTRERAS', '000 000 0000', 'COCINERO', 'COCINERA@GMAIL.COM', 'COCINERO2', '9c12cc0d9d2f44820876f283342c2dad3644dcca', 'COCINERO', 'INACTIVO'), 
      ('6', '21354698', 'RAMON ANTONIO CONTRERAS RUIZ', '412 763 9845', 'REPARTIDOR', 'RAMONUR@GMAIL.COM', 'RAMONANTONIO', '2d3070afcbce9a05a2e4735d338c28c855d6f7d1', 'REPARTIDOR', 'ACTIVO');
COMMIT;

# | Vaciado de tabla 'ventas'
# +-------------------------------------
DROP TABLE IF EXISTS `ventas`;


# | Estructura de la tabla 'ventas'
# +-------------------------------------
CREATE TABLE `ventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
# | Carga de datos de la tabla 'ventas'
# +-------------------------------------


