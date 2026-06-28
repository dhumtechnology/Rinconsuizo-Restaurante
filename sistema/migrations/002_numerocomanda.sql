-- Migración: numerar cada ronda de pedido (comanda) por mesa
-- Ejecutar una sola vez sobre la base de datos rinconsuizo.
-- Ejemplo Docker:
--   docker exec -i rinconsuizo-db mysql -uroot -proot_secret rinconsuizo < sistema/migrations/002_numerocomanda.sql

ALTER TABLE `detalleventas`
  ADD COLUMN `numerocomanda` int(11) NOT NULL DEFAULT 1 AFTER `comanda`;

UPDATE `detalleventas` SET `numerocomanda` = 1 WHERE `numerocomanda` IS NULL OR `numerocomanda` = 0;
