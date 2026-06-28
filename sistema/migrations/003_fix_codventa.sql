-- Corrige codventa duplicados (mesas mezcladas) y evita que vuelva a ocurrir.
-- Ejecutar: docker exec -i rinconsuizo-db mysql -uroot -proot_secret rinconsuizo < sistema/migrations/003_fix_codventa.sql

DROP PROCEDURE IF EXISTS fix_duplicate_codventa;

DELIMITER //
CREATE PROCEDURE fix_duplicate_codventa()
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE v_id INT;
  DECLARE v_old_cod VARCHAR(20);
  DECLARE v_fecha DATETIME;
  DECLARE v_next INT;
  DECLARE v_new_cod VARCHAR(20);
  DECLARE v_fecha_fin DATETIME;

  DECLARE cur CURSOR FOR
    SELECT v.idventa, v.codventa, v.fechaventa
    FROM ventas v
    INNER JOIN (
      SELECT codventa, MIN(idventa) AS min_id
      FROM ventas
      GROUP BY codventa
      HAVING COUNT(*) > 1
    ) d ON v.codventa = d.codventa AND v.idventa > d.min_id
    ORDER BY v.idventa;

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  SELECT COALESCE(MAX(CAST(codventa AS UNSIGNED)), 0) INTO v_next FROM ventas;

  OPEN cur;
  read_loop: LOOP
    FETCH cur INTO v_id, v_old_cod, v_fecha;
    IF done THEN
      LEAVE read_loop;
    END IF;

    SET v_next = v_next + 1;
    SET v_new_cod = LPAD(v_next, 8, '0');

    SELECT COALESCE(MIN(v2.fechaventa), '2099-12-31 23:59:59') INTO v_fecha_fin
    FROM ventas v2
    WHERE v2.codventa = v_old_cod AND v2.idventa > v_id;

    UPDATE detalleventas
    SET codventa = v_new_cod
    WHERE codventa = v_old_cod
      AND fechadetalleventa >= v_fecha
      AND fechadetalleventa < v_fecha_fin;

    UPDATE ventas
    SET codventa = v_new_cod
    WHERE idventa = v_id;
  END LOOP;

  CLOSE cur;
END//
DELIMITER ;

CALL fix_duplicate_codventa();
DROP PROCEDURE IF EXISTS fix_duplicate_codventa;

-- Índice único (ignorar error si ya existe)
SET @idx_exists = (
  SELECT COUNT(*) FROM information_schema.statistics
  WHERE table_schema = DATABASE()
    AND table_name = 'ventas'
    AND index_name = 'uk_ventas_codventa'
);
SET @sql_idx = IF(
  @idx_exists = 0,
  'ALTER TABLE ventas ADD UNIQUE INDEX uk_ventas_codventa (codventa)',
  'SELECT 1'
);
PREPARE stmt_idx FROM @sql_idx;
EXECUTE stmt_idx;
DEALLOCATE PREPARE stmt_idx;
