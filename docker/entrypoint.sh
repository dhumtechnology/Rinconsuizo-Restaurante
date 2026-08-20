#!/bin/bash
set -e

echo "[entrypoint] Esperando a que MySQL esté listo..."
until mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" -e "SELECT 1" "$DB_NAME" &>/dev/null; do
  sleep 2
done
echo "[entrypoint] MySQL listo."

# Tabla de control de migraciones
mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" <<'SQL'
CREATE TABLE IF NOT EXISTS _migrations (
  filename VARCHAR(255) NOT NULL PRIMARY KEY,
  applied_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL

# Ejecutar migraciones pendientes en orden
MIGRATION_DIR="/var/www/html/sistema/migrations"
if [ -d "$MIGRATION_DIR" ]; then
  for file in $(ls "$MIGRATION_DIR"/*.sql 2>/dev/null | sort); do
    fname=$(basename "$file")
    already=$(mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" \
      -N -e "SELECT COUNT(*) FROM _migrations WHERE filename='$fname'")
    if [ "$already" = "0" ]; then
      echo "[entrypoint] Aplicando migración: $fname"
      mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" < "$file"
      mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" \
        -e "INSERT INTO _migrations (filename) VALUES ('$fname')"
    fi
  done
  echo "[entrypoint] Migraciones completadas."
else
  echo "[entrypoint] No se encontró carpeta de migraciones."
fi

# Arrancar Apache (CMD del Dockerfile)
exec "$@"
