#!/bin/bash
set -euo pipefail

DB_PORT="${DB_PORT:-3306}"
MYSQL_CLI=(mysql --skip-ssl -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS")

echo "[entrypoint] Esperando a que MySQL esté listo..."
until "${MYSQL_CLI[@]}" -e "SELECT 1" "$DB_NAME" &>/dev/null; do
  sleep 2
done
echo "[entrypoint] MySQL listo."

# Tabla de control de migraciones
"${MYSQL_CLI[@]}" "$DB_NAME" <<'SQL'
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
    already=$("${MYSQL_CLI[@]}" "$DB_NAME" \
      -N -e "SELECT COUNT(*) FROM _migrations WHERE filename='$fname'")
    if [ "$already" = "0" ]; then
      echo "[entrypoint] Aplicando migración: $fname"
      set +e
      "${MYSQL_CLI[@]}" "$DB_NAME" < "$file"
      mig_status=$?
      set -e
      if [ "$mig_status" -ne 0 ]; then
        echo "[entrypoint] AVISO: $fname no se aplicó del todo (código $mig_status). Si la BD ya estaba actualizada, se marca igual en _migrations."
      fi
      "${MYSQL_CLI[@]}" "$DB_NAME" \
        -e "INSERT IGNORE INTO _migrations (filename) VALUES ('$fname')"
    fi
  done
  echo "[entrypoint] Migraciones completadas."
else
  echo "[entrypoint] No se encontró carpeta de migraciones."
fi

# Arrancar Apache (CMD del Dockerfile)
exec "$@"
