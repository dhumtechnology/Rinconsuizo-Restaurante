<?php
/**
 * Sesión compartida para la tienda web (index, carrito, agregar_tmp, etc.)
 */
if (session_status() === PHP_SESSION_NONE) {
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    if (PHP_VERSION_ID >= 70300) {
        session_set_cookie_params(array(
            'lifetime' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => $secure,
            'httponly' => true,
            'samesite' => 'Lax',
        ));
    } else {
        session_set_cookie_params(0, '/');
    }
    session_start();
}

require_once __DIR__ . '/tenant_context.php';
tenant_resolve_request();

if (!isset($_SESSION['web_cart_boot'])) {
    $_SESSION['web_cart_boot'] = time();
}

function web_session_id()
{
    return session_id();
}

/**
 * Cláusula SQL AND id_restaurante = N para tienda web
 */
function web_tenant_sql($alias = '')
{
    $id = web_tenant_id();
    if ($id <= 0) {
        $id = 1;
    }
    $col = $alias !== '' ? $alias . '.id_restaurante' : 'id_restaurante';
    return ' AND ' . $col . ' = ' . (int) $id . ' ';
}
