-- Migración 004: símbolo de moneda a soles peruanos (S/)
-- Ejecutar manualmente en phpMyAdmin o:
--   docker exec -i rinconsuizo-db mysql -urinconsuizo -princonsuizo_secret rinconsuizo < sistema/migrations/004_simbolo_soles.sql
--
-- Nota: la columna configuracion.simbolo es varchar(2); "S/" cabe exactamente.
-- El panel admin (Configuración) y reportes/tickets leen este valor.
-- La tienda online también usa "S/" fijo en el frontend.

UPDATE configuracion
SET simbolo = 'S/'
WHERE simbolo IN ('$', 'RD$', 'US$', '') OR simbolo IS NULL;
