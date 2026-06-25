-- Migración: mesas unidas (juntar mesas del mismo salón)
-- Ejecutar una sola vez sobre la base de datos rinconsuizo.
-- Ejemplo Docker:
--   docker exec -i rinconsuizo-db mysql -uroot -proot_secret rinconsuizo < sistema/migrations/001_mesas_unidas.sql

CREATE TABLE IF NOT EXISTS `mesas_unidas` (
  `idunion` int(11) NOT NULL AUTO_INCREMENT,
  `codmesa_principal` int(11) NOT NULL COMMENT 'Mesa que concentra pedido y cuenta',
  `codmesa` int(11) NOT NULL COMMENT 'Cada mesa física del grupo',
  `codsala` int(11) NOT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT 1,
  `fechacreacion` datetime NOT NULL,
  PRIMARY KEY (`idunion`),
  KEY `idx_mesa_activa` (`codmesa`, `activa`),
  KEY `idx_principal_activa` (`codmesa_principal`, `activa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
