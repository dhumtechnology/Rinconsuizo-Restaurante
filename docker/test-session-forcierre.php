<?php
/**
 * Establece sesión POS de prueba (solo desarrollo local).
 * GET /docker/test-session-forcierre.php?key=dev
 */
require_once __DIR__ . '/../sistema/class/class.php';

$key = isset($_GET['key']) ? $_GET['key'] : '';
if ($key !== 'dev') {
    http_response_code(403);
    echo 'forbidden';
    exit;
}

$_SESSION['acceso'] = 'administrador';
$_SESSION['usuario'] = 'ADMINISTRADOR';
$_SESSION['codigo'] = 1;
$_SESSION['id_restaurante'] = 1;
$_SESSION['url_slug'] = 'rincon-suizo';
$_SESSION['url_id_restaurante'] = 1;
$_SESSION['web_slug'] = 'rincon-suizo';
$_SESSION['web_id_restaurante'] = 1;
$_SESSION['nombres'] = 'TEST ADMIN';
$_SESSION['cedula'] = '00000000';
$_SESSION['time'] = time();

header('Content-Type: text/plain; charset=utf-8');
echo 'session_id=' . session_id() . "\n";
echo 'acceso=' . $_SESSION['acceso'] . "\n";
echo 'test_url=/rincon-suizo/sistema/forcierrearqueo?codarqueo=4' . "\n";
