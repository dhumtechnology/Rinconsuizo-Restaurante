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

if (!isset($_SESSION['web_cart_boot'])) {
    $_SESSION['web_cart_boot'] = time();
}

function web_session_id()
{
    return session_id();
}
