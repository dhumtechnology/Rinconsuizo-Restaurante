/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.27-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: rinconsuizo
-- ------------------------------------------------------
-- Server version	10.6.27-MariaDB-ubu2204

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- =============================================================================
-- Rinconsuizo Restaurante — plantilla de instalación (Hostinger / producción)
-- Estructura actual + datos semilla de plataforma. Sin restaurantes ni ventas.
-- SuperAdmin: usuario SUPERADMIN — contraseña SuperAdmin2026!
-- id_restaurante = 0 → plantillas de sistema (no es un local).
-- =============================================================================

-- Importación: en phpMyAdmin seleccione su base vacía y ejecute este archivo.
-- Docker:  Get-Content rinconsuizo_plantilla.sql | docker exec -i rinconsuizo-db mysql -uroot -p... rinconsuizo

--
-- Table structure for table `_migrations`
--

DROP TABLE IF EXISTS `_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `_migrations` (
  `filename` varchar(255) NOT NULL,
  `applied_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`filename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `abonoscreditos`
--

DROP TABLE IF EXISTS `abonoscreditos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `abonoscreditos` (
  `codabono` int(11) NOT NULL AUTO_INCREMENT,
  `codventa` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codcliente` int(11) NOT NULL,
  `montoabono` float(12,2) NOT NULL,
  `fechaabono` datetime NOT NULL,
  `codigo` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  PRIMARY KEY (`codabono`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `arqueocaja`
--

DROP TABLE IF EXISTS `arqueocaja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `arqueocaja` (
  `codarqueo` int(11) NOT NULL AUTO_INCREMENT,
  `codcaja` int(11) NOT NULL,
  `montoinicial` float(12,2) NOT NULL,
  `ingresos` float(12,2) NOT NULL,
  `egresos` float(12,2) NOT NULL,
  `dineroefectivo` float(12,2) NOT NULL,
  `diferencia` float(12,2) NOT NULL,
  `comentarios` text NOT NULL,
  `fechaapertura` datetime NOT NULL,
  `fechacierre` datetime NOT NULL,
  `statusarqueo` int(2) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codarqueo`),
  KEY `idx_arqueocaja_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cajas`
--

DROP TABLE IF EXISTS `cajas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cajas` (
  `codcaja` int(11) NOT NULL AUTO_INCREMENT,
  `nrocaja` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombrecaja` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codcaja`),
  KEY `idx_cajas_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `sessionn_id` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_carrito_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `codcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nomcategoria` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codcategoria`),
  KEY `idx_categorias_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `codcliente` int(11) NOT NULL AUTO_INCREMENT,
  `cedcliente` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nomcliente` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `direccliente` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `tlfcliente` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `emailcliente` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `documento` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `codigo` varchar(6) DEFAULT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codcliente`),
  KEY `idx_clientes_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `compras` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `codcompra` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codseriec` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codproveedor` int(11) NOT NULL,
  `subtotalivasic` float(12,2) NOT NULL,
  `subtotalivanoc` float(12,2) NOT NULL,
  `ivac` float(12,2) NOT NULL,
  `totalivac` float(12,2) NOT NULL,
  `descuentoc` float(12,2) NOT NULL,
  `totaldescuentoc` float(12,2) NOT NULL,
  `totalc` float(12,2) NOT NULL,
  `tipocompra` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `formacompra` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fechavencecredito` date NOT NULL,
  `statuscompra` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fechacompra` datetime NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcompra`),
  KEY `idx_compras_rest` (`id_restaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rifempresa` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomempresa` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `direcempresa` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tlfempresa` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `correoempresa` varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `cedresponsable` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomresponsable` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `correoresponsable` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tlfresponsable` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ivac` float(12,2) NOT NULL,
  `ivav` float(12,2) NOT NULL,
  `simbolo` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fac_ele` int(11) NOT NULL DEFAULT 3,
  `clave` varchar(100) NOT NULL,
  `usuariosol` varchar(100) NOT NULL,
  `clavesol` varchar(100) NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_config_restaurante` (`id_restaurante`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detallecompras`
--

DROP TABLE IF EXISTS `detallecompras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `detallecompras` (
  `coddetallecompra` int(11) NOT NULL AUTO_INCREMENT,
  `codcompra` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codproducto` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `producto` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `categoria` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `cantcompra` float(5,2) NOT NULL,
  `precio1` float(12,2) NOT NULL,
  `precio2` float(12,2) NOT NULL,
  `ivaproductoc` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `importecompra` float(12,2) NOT NULL,
  `tipoentrada` varchar(35) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fechadetallecompra` datetime NOT NULL,
  `codigo` int(11) NOT NULL,
  PRIMARY KEY (`coddetallecompra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detalleventas`
--

DROP TABLE IF EXISTS `detalleventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalleventas` (
  `coddetalleventa` int(11) NOT NULL AUTO_INCREMENT,
  `codventa` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codcliente` int(11) NOT NULL,
  `codproducto` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `producto` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codcategoria` int(11) NOT NULL,
  `cantventa` float(5,2) NOT NULL,
  `preciocompra` float(12,2) NOT NULL,
  `precioventa` float(12,2) NOT NULL,
  `ivaproducto` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `importe` float(12,2) NOT NULL,
  `importe2` float(12,2) NOT NULL,
  `fechadetalleventa` datetime NOT NULL,
  `statusdetalle` int(2) NOT NULL,
  `codigo` int(11) NOT NULL,
  `comanda` int(11) NOT NULL DEFAULT 1,
  `numerocomanda` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`coddetalleventa`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `impresoras`
--

DROP TABLE IF EXISTS `impresoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `impresoras` (
  `id_impresora` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `puerto` int(11) NOT NULL DEFAULT 9100,
  `status` varchar(15) NOT NULL DEFAULT 'ACTIVO',
  `id_restaurante` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_impresora`),
  KEY `idx_impresoras_restaurante` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredientes` (
  `idingrediente` int(11) NOT NULL AUTO_INCREMENT,
  `codingrediente` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nomingrediente` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `cantingrediente` float(5,2) NOT NULL,
  `costoingrediente` float(12,2) NOT NULL,
  `unidadingrediente` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codproveedor` int(11) NOT NULL,
  `stockminimoingrediente` float(5,2) NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idingrediente`),
  KEY `idx_ingredientes_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kardexingredientes`
--

DROP TABLE IF EXISTS `kardexingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `kardexingredientes` (
  `codkardexing` int(11) NOT NULL AUTO_INCREMENT,
  `codprocesoing` varchar(20) NOT NULL,
  `codresponsableing` int(11) NOT NULL,
  `codproducto` varchar(15) NOT NULL,
  `codingrediente` varchar(15) NOT NULL,
  `movimientoing` varchar(35) NOT NULL,
  `entradasing` float(5,2) NOT NULL,
  `salidasing` float(5,2) NOT NULL,
  `stockactualing` float(5,2) NOT NULL,
  `preciouniting` float(12,2) NOT NULL,
  `costototaling` float(12,2) NOT NULL,
  `documentoing` text NOT NULL,
  `fechakardexing` date NOT NULL,
  PRIMARY KEY (`codkardexing`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kardexproductos`
--

DROP TABLE IF EXISTS `kardexproductos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `kardexproductos` (
  `codkardex` int(11) NOT NULL AUTO_INCREMENT,
  `codproceso` varchar(20) NOT NULL,
  `codresponsable` int(11) NOT NULL,
  `codproducto` varchar(15) NOT NULL,
  `movimiento` varchar(35) NOT NULL,
  `entradas` float(5,2) NOT NULL,
  `salidas` float(5,2) NOT NULL,
  `devolucion` float(5,2) NOT NULL,
  `stockactual` float(5,2) NOT NULL,
  `preciom` float(12,2) NOT NULL,
  `costototal` float(12,2) NOT NULL,
  `documento` text NOT NULL,
  `fechakardex` date NOT NULL,
  PRIMARY KEY (`codkardex`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `tiempo` datetime DEFAULT NULL,
  `detalles` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `paginas` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `usuario` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `id_restaurante` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_log_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mediospagos`
--

DROP TABLE IF EXISTS `mediospagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `mediospagos` (
  `codmediopago` int(11) NOT NULL AUTO_INCREMENT,
  `mediopago` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codmediopago`),
  KEY `idx_mediospagos_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mesas`
--

DROP TABLE IF EXISTS `mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesas` (
  `codmesa` int(11) NOT NULL AUTO_INCREMENT,
  `codsala` int(11) NOT NULL,
  `nombremesa` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `mesacreada` datetime NOT NULL,
  `statusmesa` int(1) NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codmesa`),
  KEY `idx_mesas_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mesas_unidas`
--

DROP TABLE IF EXISTS `mesas_unidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesas_unidas` (
  `idunion` int(11) NOT NULL AUTO_INCREMENT,
  `codmesa_principal` int(11) NOT NULL COMMENT 'Mesa que concentra pedido y cuenta',
  `codmesa` int(11) NOT NULL COMMENT 'Cada mesa fÃ­sica del grupo',
  `codsala` int(11) NOT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT 1,
  `fechacreacion` datetime NOT NULL,
  PRIMARY KEY (`idunion`),
  KEY `idx_mesa_activa` (`codmesa`,`activa`),
  KEY `idx_principal_activa` (`codmesa_principal`,`activa`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `movimientoscajas`
--

DROP TABLE IF EXISTS `movimientoscajas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimientoscajas` (
  `codmovimientocaja` int(11) NOT NULL AUTO_INCREMENT,
  `tipomovimientocaja` varchar(10) NOT NULL,
  `montomovimientocaja` float(12,2) NOT NULL,
  `mediopagomovimientocaja` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `descripcionmovimientocaja` text NOT NULL,
  `fechamovimientocaja` datetime NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codmovimientocaja`),
  KEY `idx_movimientoscajas_rest` (`id_restaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pagosventa`
--

DROP TABLE IF EXISTS `pagosventa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagosventa` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `codventa` varchar(30) NOT NULL,
  `codmediopago` int(11) NOT NULL,
  `monto` decimal(12,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`idpago`),
  KEY `idx_pagosventa_codventa` (`codventa`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `codalmacen` int(11) NOT NULL AUTO_INCREMENT,
  `codproducto` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `producto` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codcategoria` int(11) NOT NULL,
  `preciocompra` float(12,2) NOT NULL,
  `precioventa` float(12,2) NOT NULL,
  `existencia` float(5,2) NOT NULL,
  `stockminimo` int(5) NOT NULL,
  `ivaproducto` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descproducto` float(12,2) NOT NULL,
  `codproveedor` int(11) NOT NULL,
  `codigobarra` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `favorito` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `statusproducto` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codalmacen`),
  KEY `idx_productos_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `productosvsingredientes`
--

DROP TABLE IF EXISTS `productosvsingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `productosvsingredientes` (
  `codagrega` int(11) NOT NULL AUTO_INCREMENT,
  `codproducto` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codingrediente` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `cantracion` float(5,2) NOT NULL,
  PRIMARY KEY (`codagrega`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `codproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `ritproveedor` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nomproveedor` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `direcproveedor` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `tlfproveedor` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `emailproveedor` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `contactoproveedor` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codproveedor`),
  KEY `idx_proveedores_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_reservas_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `restaurantes`
--

DROP TABLE IF EXISTS `restaurantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `restaurantes` (
  `id_restaurante` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `dominio` varchar(150) DEFAULT NULL,
  `ruc` varchar(25) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `color_primario` varchar(20) NOT NULL DEFAULT '#1a1a2e',
  `color_secundario` varchar(20) NOT NULL DEFAULT '#16213e',
  `color_acento` varchar(20) NOT NULL DEFAULT '#e94560',
  `status` varchar(15) NOT NULL DEFAULT 'ACTIVO',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_restaurante`),
  UNIQUE KEY `uq_restaurantes_slug` (`slug`),
  UNIQUE KEY `uq_restaurantes_dominio` (`dominio`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `salas`
--

DROP TABLE IF EXISTS `salas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `salas` (
  `codsala` int(11) NOT NULL AUTO_INCREMENT,
  `nombresala` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `salacreada` datetime NOT NULL,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codsala`),
  KEY `idx_salas_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombres` varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nrotelefono` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `cargo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usuario` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nivel` varchar(30) NOT NULL,
  `status` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_restaurante` int(11) DEFAULT 1,
  `password_plain` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `idx_usuarios_restaurante` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `codventa` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
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
  `tipopagove` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `formapagove` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `montopagado` float(12,2) NOT NULL,
  `montodevuelto` float(12,2) NOT NULL,
  `fechavencecredito` date NOT NULL,
  `statusventa` varchar(10) NOT NULL,
  `statuspago` int(2) NOT NULL,
  `fechaventa` datetime NOT NULL,
  `codigo` int(11) NOT NULL,
  `cocinero` int(2) NOT NULL,
  `delivery` int(2) NOT NULL,
  `repartidor` int(11) NOT NULL,
  `entregado` int(2) NOT NULL,
  `observaciones` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codarqueocaja` int(11) NOT NULL DEFAULT 1,
  `comprobante` int(11) NOT NULL DEFAULT 1,
  `serie_doc` varchar(3) NOT NULL DEFAULT '001',
  `aceptado` varchar(20) NOT NULL,
  `enviado` int(11) NOT NULL DEFAULT 0,
  `id_restaurante` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idventa`),
  UNIQUE KEY `uk_ventas_codventa` (`codventa`),
  KEY `idx_ventas_rest` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Datos semilla (plataforma; sin restaurantes)
--

LOCK TABLES `_migrations` WRITE;
/*!40000 ALTER TABLE `_migrations` DISABLE KEYS */;
INSERT INTO `_migrations` (`filename`, `applied_at`) VALUES
('001_mesas_unidas.sql', '2026-11-12 00:00:00'),
('002_numerocomanda.sql', '2026-11-12 00:00:00'),
('003_fix_codventa.sql', '2026-11-12 00:00:00'),
('004_simbolo_soles.sql', '2026-11-12 00:00:00'),
('005_multitenant_restaurantes.sql', '2026-11-12 00:00:00'),
('006_restaurante_dominio.sql', '2026-11-12 00:00:00');
/*!40000 ALTER TABLE `_migrations` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`codigo`, `cedula`, `nombres`, `nrotelefono`, `cargo`, `email`, `usuario`, `password`, `nivel`, `status`, `id_restaurante`, `password_plain`) VALUES
(1, '00000000', 'SUPER ADMINISTRADOR', '000 000 0000', 'SUPERADMIN', 'superadmin@plataforma.local', 'SUPERADMIN', 'f9d5bf21b323db2d06620a10ac85a8f85bd48ce0', 'SUPERADMINISTRADOR', 'ACTIVO', NULL, NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` (`id`, `rifempresa`, `nomempresa`, `direcempresa`, `tlfempresa`, `correoempresa`, `cedresponsable`, `nomresponsable`, `correoresponsable`, `tlfresponsable`, `ivac`, `ivav`, `simbolo`, `fac_ele`, `clave`, `usuariosol`, `clavesol`, `id_restaurante`) VALUES
(1, '00000000000', 'PLANTILLA SISTEMA', '-', '000', 'info@plataforma.local', '00000000', 'RESPONSABLE', 'info@plataforma.local', '000', 18.00, 18.00, 'S/', 3, '', '', '', 0);
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `mediospagos` WRITE;
/*!40000 ALTER TABLE `mediospagos` DISABLE KEYS */;
INSERT INTO `mediospagos` (`codmediopago`, `mediopago`, `id_restaurante`) VALUES
(1, 'EFECTIVO', 0),
(2, 'TRANSFERENCIA', 0),
(3, 'TARJETA DEBITO/CREDITO', 0),
(4, 'YAPE', 0),
(5, 'PLIN', 0),
(6, 'CHEQUE', 0);
/*!40000 ALTER TABLE `mediospagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'rinconsuizo'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-12 22:29:12
