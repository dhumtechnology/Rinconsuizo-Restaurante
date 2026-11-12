<?php
/**
 * Compatibilidad PHP 8.2–8.5 (Hostinger) y Docker 8.3.
 * Incluir una vez al inicio de cada entrada (POS, tienda, mail).
 */
if (defined('RS_PHP_COMPAT_LOADED')) {
	return;
}
define('RS_PHP_COMPAT_LOADED', true);

if (!function_exists('get_magic_quotes_runtime')) {
	function get_magic_quotes_runtime()
	{
		return false;
	}
}

if (!function_exists('get_magic_quotes_gpc')) {
	function get_magic_quotes_gpc()
	{
		return false;
	}
}

if (!function_exists('set_magic_quotes_runtime')) {
	function set_magic_quotes_runtime($new_setting)
	{
		return false;
	}
}

// Eliminadas en PHP 8.4; en 8.2–8.3 siguen deprecadas (FPDF / tickets).
if (!function_exists('utf8_encode')) {
	function utf8_encode($string)
	{
		$s = (string) $string;
		if ($s === '') {
			return '';
		}
		return mb_convert_encoding($s, 'ISO-8859-1', 'UTF-8');
	}
}

if (!function_exists('utf8_decode')) {
	function utf8_decode($string)
	{
		$s = (string) $string;
		if ($s === '') {
			return '';
		}
		return mb_convert_encoding($s, 'ISO-8859-1', 'UTF-8');
	}
}
