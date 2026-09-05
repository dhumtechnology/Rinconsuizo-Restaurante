<?php
/**
 * Impresoras térmicas de red (ESC/POS, puerto 9100).
 * Se configuran en el .env de la raíz del proyecto.
 */

function cargar_env_impresoras_si_falta()
{
    static $cargado = false;
    if ($cargado) {
        return;
    }
    $cargado = true;

    $envFile = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . '.env';
    if (!is_readable($envFile)) {
        return;
    }
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
            continue;
        }
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value, " \t\"'");
        if ($key === '') {
            continue;
        }
        $actual = getenv($key);
        if ($actual !== false && $actual !== '') {
            continue;
        }
        putenv($key . '=' . $value);
        $_ENV[$key] = $value;
    }
}

function impresora_red_slug($nombre, $fallback)
{
    $slug = strtolower(trim((string) $nombre));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');
    if ($slug === '') {
        $slug = $fallback;
    }
    return $slug;
}

function impresora_red_normalizar($id, $nombre, $ip, $port)
{
    $ip = trim((string) $ip);
    if ($ip === '' || filter_var($ip, FILTER_VALIDATE_IP) === false) {
        return null;
    }
    $port = (int) $port;
    if ($port <= 0) {
        $port = 9100;
    }
    if ($port > 65535) {
        return null;
    }
    $nombre = trim((string) $nombre);
    if ($nombre === '') {
        $nombre = $ip;
    }
    $id = trim((string) $id);
    if ($id === '') {
        $id = impresora_red_slug($nombre, 'p-' . str_replace('.', '-', $ip));
    }
    return array(
        'id' => $id,
        'name' => $nombre,
        'ip' => $ip,
        'port' => $port,
    );
}

function listarImpresorasRed()
{
    cargar_env_impresoras_si_falta();
    $out = array();
    $vistos = array();

    for ($i = 1; $i <= 20; $i++) {
        $ip = getenv('PRINTER_' . $i . '_IP');
        if ($ip === false || trim((string) $ip) === '') {
            continue;
        }
        $nombre = getenv('PRINTER_' . $i . '_NAME');
        $port = getenv('PRINTER_' . $i . '_PORT');
        $id = getenv('PRINTER_' . $i . '_ID');
        $item = impresora_red_normalizar(
            $id !== false ? $id : '',
            $nombre !== false ? $nombre : ('Impresora ' . $i),
            $ip,
            $port !== false ? $port : 9100
        );
        if ($item === null) {
            continue;
        }
        $clave = $item['ip'] . ':' . $item['port'];
        if (isset($vistos[$clave])) {
            continue;
        }
        $vistos[$clave] = true;
        $out[] = $item;
    }

    $compact = getenv('PRINTERS');
    if ($compact !== false && trim((string) $compact) !== '') {
        $partes = explode(',', $compact);
        foreach ($partes as $parte) {
            $parte = trim($parte);
            if ($parte === '') {
                continue;
            }
            $bits = explode(':', $parte);
            if (count($bits) < 2) {
                continue;
            }
            $nombre = trim($bits[0]);
            $ip = trim($bits[1]);
            $port = isset($bits[2]) ? trim($bits[2]) : 9100;
            $item = impresora_red_normalizar('', $nombre, $ip, $port);
            if ($item === null) {
                continue;
            }
            $clave = $item['ip'] . ':' . $item['port'];
            if (isset($vistos[$clave])) {
                continue;
            }
            $vistos[$clave] = true;
            $out[] = $item;
        }
    }

    return $out;
}

function impresoraRedPorId($id)
{
    $id = trim((string) $id);
    if ($id === '') {
        return null;
    }
    foreach (listarImpresorasRed() as $item) {
        if ((string) $item['id'] === $id) {
            return $item;
        }
    }
    return null;
}

function impresoras_red_autoload_escpos()
{
    $autoload = dirname(dirname(__DIR__)) . '/db/view/inicio/imprimir/autoload.php';
    if (!is_file($autoload)) {
        throw new Exception('No se encontró la librería de impresión ESC/POS.');
    }
    require_once $autoload;
}

function impresoras_red_redimensionar_png($ruta, $anchoMax)
{
    $anchoMax = (int) $anchoMax;
    if ($anchoMax < 200) {
        $anchoMax = 384;
    }
    $anchoMax = (int) (floor($anchoMax / 8) * 8);
    $im = @imagecreatefrompng($ruta);
    if ($im === false) {
        throw new Exception('No se pudo leer la imagen del ticket.');
    }
    $w = imagesx($im);
    $h = imagesy($im);
    if ($w <= 0 || $h <= 0) {
        imagedestroy($im);
        throw new Exception('Imagen de ticket inválida.');
    }
    if ($w === $anchoMax) {
        imagedestroy($im);
        return;
    }
    $nh = (int) max(1, round($h * ($anchoMax / $w)));
    $dst = imagecreatetruecolor($anchoMax, $nh);
    $blanco = imagecolorallocate($dst, 255, 255, 255);
    imagefilledrectangle($dst, 0, 0, $anchoMax, $nh, $blanco);
    imagecopyresampled($dst, $im, 0, 0, 0, 0, $anchoMax, $nh, $w, $h);
    imagedestroy($im);
    imagepng($dst, $ruta);
    imagedestroy($dst);
}

function imprimirImagenEnImpresoraRed($printerId, $pngPath, $paper = '80')
{
    $impresora = impresoraRedPorId($printerId);
    if ($impresora === null) {
        throw new Exception('Impresora no encontrada. Revisa el .env.');
    }
    if (!is_file($pngPath) || !is_readable($pngPath)) {
        throw new Exception('No hay imagen para imprimir.');
    }

    $ancho = ($paper === '58') ? 384 : 576;
    impresoras_red_redimensionar_png($pngPath, $ancho);

    impresoras_red_autoload_escpos();

    $oldTimeout = ini_get('default_socket_timeout');
    ini_set('default_socket_timeout', '5');
    try {
        $connector = new \Mike42\Escpos\PrintConnectors\NetworkPrintConnector(
            $impresora['ip'],
            (string) $impresora['port']
        );
    } catch (Exception $e) {
        if ($oldTimeout !== false) {
            ini_set('default_socket_timeout', $oldTimeout);
        }
        throw new Exception(
            'No se pudo conectar a ' . $impresora['name'] . ' (' . $impresora['ip'] . ':' . $impresora['port'] . '). ' .
            'Comprueba que la impresora esté encendida y en la misma red.'
        );
    }
    if ($oldTimeout !== false) {
        ini_set('default_socket_timeout', $oldTimeout);
    }

    $printer = new \Mike42\Escpos\Printer($connector);
    try {
        $img = \Mike42\Escpos\EscposImage::load($pngPath, false, array('gd', 'native'));
        $printer->initialize();
        $printer->bitImage($img);
        $printer->feed(2);
        $printer->cut();
    } finally {
        $printer->close();
    }

    return $impresora;
}
