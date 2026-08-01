-- Migración 005: Multi-tenant (restaurantes) + SUPERADMINISTRADOR
-- Ejecutar:
--   docker exec -i rinconsuizo-db mysql -urinconsuizo -princonsuizo_secret rinconsuizo < sistema/migrations/005_multitenant_restaurantes.sql
--
-- Usuario seed SUPERADMIN:
--   usuario: SUPERADMIN
--   password: SuperAdmin2026!
--   Panel: /sistema/superadmin/panel.php
--   Nota: el login convierte el usuario a MAYÚSCULAS; la contraseña respeta mayúsculas/minúsculas (no usar toUpperCase en password).
--   Tras docker-compose down -v hay que volver a ejecutar esta migración.
--
-- Nota: si alguna columna ya existe, ignore el error "Duplicate column name".

CREATE TABLE IF NOT EXISTS restaurantes (
  id_restaurante INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  slug VARCHAR(80) NOT NULL,
  ruc VARCHAR(25) DEFAULT NULL,
  telefono VARCHAR(30) DEFAULT NULL,
  email VARCHAR(100) DEFAULT NULL,
  direccion VARCHAR(200) DEFAULT NULL,
  logo VARCHAR(255) DEFAULT NULL,
  color_primario VARCHAR(20) NOT NULL DEFAULT '#1a1a2e',
  color_secundario VARCHAR(20) NOT NULL DEFAULT '#16213e',
  color_acento VARCHAR(20) NOT NULL DEFAULT '#e94560',
  status VARCHAR(15) NOT NULL DEFAULT 'ACTIVO',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_restaurantes_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO restaurantes (id_restaurante, nombre, slug, ruc, telefono, email, direccion, status)
SELECT 1, COALESCE(c.nomempresa, 'EL RINCON SUIZO'), 'rincon-suizo', c.rifempresa, c.tlfempresa, c.correoempresa, c.direcempresa, 'ACTIVO'
FROM configuracion c
WHERE c.id = 1
  AND NOT EXISTS (SELECT 1 FROM restaurantes r WHERE r.id_restaurante = 1)
LIMIT 1;

INSERT INTO restaurantes (id_restaurante, nombre, slug, status)
SELECT 1, 'EL RINCON SUIZO', 'rincon-suizo', 'ACTIVO'
FROM (SELECT 1 AS x) t
WHERE NOT EXISTS (SELECT 1 FROM restaurantes r WHERE r.id_restaurante = 1);

ALTER TABLE usuarios MODIFY nivel VARCHAR(30) NOT NULL;

ALTER TABLE usuarios ADD COLUMN id_restaurante INT NULL DEFAULT 1;
ALTER TABLE usuarios ADD INDEX idx_usuarios_restaurante (id_restaurante);

UPDATE usuarios SET id_restaurante = 1 WHERE id_restaurante IS NULL AND (nivel IS NULL OR nivel <> 'SUPERADMINISTRADOR');

ALTER TABLE configuracion ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE configuracion ADD UNIQUE KEY uq_config_restaurante (id_restaurante);
UPDATE configuracion SET id_restaurante = 1 WHERE id = 1;

ALTER TABLE salas ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE salas ADD INDEX idx_salas_rest (id_restaurante);

ALTER TABLE mesas ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE mesas ADD INDEX idx_mesas_rest (id_restaurante);

ALTER TABLE cajas ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE cajas ADD INDEX idx_cajas_rest (id_restaurante);

ALTER TABLE categorias ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE categorias ADD INDEX idx_categorias_rest (id_restaurante);

ALTER TABLE productos ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE productos ADD INDEX idx_productos_rest (id_restaurante);

ALTER TABLE ingredientes ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE ingredientes ADD INDEX idx_ingredientes_rest (id_restaurante);

ALTER TABLE proveedores ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE proveedores ADD INDEX idx_proveedores_rest (id_restaurante);

ALTER TABLE clientes ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE clientes ADD INDEX idx_clientes_rest (id_restaurante);

ALTER TABLE mediospagos ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE mediospagos ADD INDEX idx_mediospagos_rest (id_restaurante);

ALTER TABLE ventas ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE ventas ADD INDEX idx_ventas_rest (id_restaurante);

ALTER TABLE compras ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE compras ADD INDEX idx_compras_rest (id_restaurante);

ALTER TABLE arqueocaja ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE arqueocaja ADD INDEX idx_arqueocaja_rest (id_restaurante);

ALTER TABLE reservas ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE reservas ADD INDEX idx_reservas_rest (id_restaurante);

ALTER TABLE carrito ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE carrito ADD INDEX idx_carrito_rest (id_restaurante);

ALTER TABLE movimientoscajas ADD COLUMN id_restaurante INT NOT NULL DEFAULT 1;
ALTER TABLE movimientoscajas ADD INDEX idx_movimientoscajas_rest (id_restaurante);

ALTER TABLE log ADD COLUMN id_restaurante INT NULL DEFAULT NULL;
ALTER TABLE log ADD INDEX idx_log_rest (id_restaurante);

-- Seed SUPERADMINISTRADOR (password: SuperAdmin2026!)
INSERT INTO usuarios (cedula, nombres, nrotelefono, cargo, email, usuario, password, nivel, status, id_restaurante)
SELECT '00000000', 'SUPER ADMINISTRADOR', '000 000 0000', 'SUPERADMIN', 'superadmin@plataforma.local', 'SUPERADMIN',
       'f9d5bf21b323db2d06620a10ac85a8f85bd48ce0', 'SUPERADMINISTRADOR', 'ACTIVO', NULL
FROM (SELECT 1 AS x) t
WHERE NOT EXISTS (SELECT 1 FROM usuarios u WHERE u.usuario = 'SUPERADMIN' OR u.usuario = 'superadmin');

UPDATE usuarios SET usuario = "SUPERADMIN" WHERE cedula = "00000000";
