-- Migración 006: dominio personalizado y URL pública por restaurante
-- Ejecutar:
--   Get-Content sistema/migrations/006_restaurante_dominio.sql -Raw | docker exec -i rinconsuizo-db mysql -urinconsuizo -princonsuizo_secret rinconsuizo
--
-- URLs:
--   /{slug}/              → menú / tienda del restaurante
--   /{slug}/sistema/      → login y POS del restaurante
--   dominio (opcional)    → Host personalizado apunta al mismo tenant

ALTER TABLE restaurantes ADD COLUMN dominio VARCHAR(150) NULL DEFAULT NULL AFTER slug;
ALTER TABLE restaurantes ADD UNIQUE KEY uq_restaurantes_dominio (dominio);

UPDATE restaurantes SET slug = 'rincon-suizo' WHERE id_restaurante = 1 AND (slug IS NULL OR slug = '');
