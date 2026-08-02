<?php
/**
 * Contexto multi-tenant por URL (slug path o dominio personalizado).
 * Usado por tienda pública y por /{slug}/sistema.
 */

if (!function_exists('tenant_reserved_paths')) {
	function tenant_reserved_paths()
	{
		$paths = array(
			'sistema', 'db', 'css', 'js', 'img', 'fonts', 'mail', 'docker',
			'uploads', 'assets', 'vendor', 'node_modules', 'phpmyadmin', 'superadmin'
		);
		// Evitar que el nombre de la carpeta de despliegue (ej. resto) sea un slug
		if (function_exists('app_base_path')) {
			$seg = trim(app_base_path(), '/');
			if ($seg !== '' && !in_array($seg, $paths, true)) {
				$paths[] = $seg;
			}
		}
		return $paths;
	}
}

if (!function_exists('app_base_path')) {
	/**
	 * Prefijo de la app bajo el docroot.
	 * Docker (raíz): "" → URLs /slug/sistema/...
	 * XAMPP en htdocs/resto: "/resto" → URLs /resto/slug/sistema/...
	 *
	 * Prioridad: APP_BASE_PATH en entorno/.env → auto-detect por DOCUMENT_ROOT.
	 */
	function app_base_path()
	{
		static $cached = null;
		if ($cached !== null) {
			return $cached;
		}

		$env = getenv('APP_BASE_PATH');
		if (($env === false || $env === '') && is_readable(__DIR__ . DIRECTORY_SEPARATOR . '.env')) {
			$lines = @file(__DIR__ . DIRECTORY_SEPARATOR . '.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			if (is_array($lines)) {
				foreach ($lines as $line) {
					$line = trim($line);
					if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
						continue;
					}
					list($k, $v) = explode('=', $line, 2);
					if (trim($k) === 'APP_BASE_PATH') {
						$env = trim($v, " \t\"'");
						break;
					}
				}
			}
		}

		if ($env !== false && $env !== null && trim((string) $env) !== '') {
			$base = '/' . trim(str_replace('\\', '/', (string) $env), '/');
			$cached = ($base === '/' ? '' : $base);
			return $cached;
		}

		$docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : false;
		$appRoot = realpath(__DIR__);
		if ($docRoot && $appRoot) {
			$docRoot = str_replace('\\', '/', $docRoot);
			$appRoot = str_replace('\\', '/', $appRoot);
			if (strpos($appRoot, $docRoot) === 0) {
				$rel = substr($appRoot, strlen($docRoot));
				$rel = '/' . trim(str_replace('\\', '/', (string) $rel), '/');
				$cached = ($rel === '/' ? '' : $rel);
				return $cached;
			}
		}

		// Fallback: URL del navegador /resto/{slug}/sistema/... → /resto
		$reqPath = isset($_SERVER['REQUEST_URI']) ? parse_url((string) $_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
		$reqPath = is_string($reqPath) ? str_replace('\\', '/', $reqPath) : '';
		if ($reqPath !== '' && preg_match('#^(/[^/]+)/[a-z0-9\-]+/sistema(?:/|$)#i', $reqPath, $m)) {
			$doc = $docRoot ? rtrim(str_replace('\\', '/', $docRoot), '/') : '';
			if ($doc === '' || is_dir($doc . $m[1] . '/sistema') || is_file($doc . $m[1] . '/tenant_context.php')) {
				$cached = $m[1];
				return $cached;
			}
		}

		// Fallback: SCRIPT_NAME (ej. /resto/sistema/index.php)
		$script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', (string) $_SERVER['SCRIPT_NAME']) : '';
		if ($script !== '' && preg_match('#^(.*?)/sistema(?:/|$)#i', $script, $m)) {
			$cached = rtrim($m[1], '/');
			return $cached;
		}
		if ($script !== '') {
			$dir = rtrim(str_replace('\\', '/', dirname($script)), '/');
			// Si el script está en la raíz del proyecto (index.php), dirname es el base
			if ($dir !== '' && $dir !== '/' && basename($dir) !== 'sistema' && basename($dir) !== 'superadmin') {
				$cached = $dir;
				return $cached;
			}
		}

		$cached = '';
		return $cached;
	}
}

if (!function_exists('app_url')) {
	/** URL absoluta de la app (incluye /resto si aplica). */
	function app_url($path = '')
	{
		$base = app_base_path();
		$path = (string) $path;
		if ($path === '' || $path === '/') {
			return $base !== '' ? $base . '/' : '/';
		}
		if ($path[0] !== '/') {
			$path = '/' . $path;
		}
		return $base . $path;
	}
}

if (!function_exists('tenant_normalize_slug')) {
	function tenant_normalize_slug($slug)
	{
		$slug = strtolower(trim((string) $slug));
		$slug = preg_replace('/[^a-z0-9\-]+/', '-', $slug);
		$slug = trim($slug, '-');
		return $slug;
	}
}

if (!function_exists('tenant_normalize_host')) {
	function tenant_normalize_host($host)
	{
		$host = strtolower(trim((string) $host));
		$host = preg_replace('/:\d+$/', '', $host);
		if (strpos($host, 'www.') === 0) {
			$host = substr($host, 4);
		}
		return $host;
	}
}

if (!function_exists('tenant_db_pdo')) {
	function tenant_db_pdo()
	{
		static $pdo = null;
		if ($pdo instanceof PDO) {
			return $pdo;
		}
		$host = getenv('DB_HOST') ?: 'localhost';
		$user = getenv('DB_USER') ?: 'root';
		$pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
		$name = getenv('DB_NAME') ?: 'rinconsuizo';
		try {
			$pdo = new PDO(
				"mysql:host={$host};dbname={$name};charset=utf8",
				$user,
				$pass,
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
			);
		} catch (Exception $e) {
			$pdo = null;
		}
		return $pdo;
	}
}

if (!function_exists('tenant_find_restaurante')) {
	function tenant_find_restaurante($slug = null, $dominio = null)
	{
		$pdo = tenant_db_pdo();
		if (!$pdo) {
			return null;
		}
		if ($slug) {
			$slug = tenant_normalize_slug($slug);
			if ($slug === '' || in_array($slug, tenant_reserved_paths(), true)) {
				return null;
			}
			$stmt = $pdo->prepare("SELECT * FROM restaurantes WHERE slug = ? AND status = 'ACTIVO' LIMIT 1");
			$stmt->execute(array($slug));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				return $row;
			}
		}
		if ($dominio) {
			$host = tenant_normalize_host($dominio);
			if ($host === '' || $host === 'localhost' || $host === '127.0.0.1') {
				return null;
			}
			try {
				$stmt = $pdo->prepare("SELECT * FROM restaurantes WHERE status = 'ACTIVO' AND dominio IS NOT NULL AND dominio != '' AND (LOWER(dominio) = ? OR LOWER(dominio) = ? OR LOWER(REPLACE(dominio,'www.','')) = ?) LIMIT 1");
				$stmt->execute(array($host, 'www.' . $host, $host));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($row) {
					return $row;
				}
			} catch (Exception $e) {
				// columna dominio aún no migrada
			}
		}
		return null;
	}
}

if (!function_exists('tenant_resolve_request')) {
	function tenant_resolve_request()
	{
		$slug = null;
		if (!empty($_GET['r_slug'])) {
			$slug = tenant_normalize_slug($_GET['r_slug']);
		} elseif (!empty($_REQUEST['r_slug'])) {
			$slug = tenant_normalize_slug($_REQUEST['r_slug']);
		}

		$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
		$row = tenant_find_restaurante($slug, $host);

		if ($row) {
			$_SESSION['web_id_restaurante'] = (int) $row['id_restaurante'];
			$_SESSION['web_slug'] = $row['slug'];
			$_SESSION['web_restaurante'] = $row;
			$_SESSION['url_id_restaurante'] = (int) $row['id_restaurante'];
			$_SESSION['url_slug'] = $row['slug'];
			if (function_exists('restaurant_brand_apply_session')) {
				restaurant_brand_apply_session($row);
			}
			return $row;
		}

		// Sin slug/dominio: no forzar tenant web (compatibilidad)
		return null;
	}
}

if (!function_exists('web_tenant_id')) {
	function web_tenant_id()
	{
		if (!empty($_SESSION['web_id_restaurante'])) {
			return (int) $_SESSION['web_id_restaurante'];
		}
		return 0;
	}
}

if (!function_exists('web_tenant_slug')) {
	function web_tenant_slug()
	{
		if (!empty($_SESSION['web_slug'])) {
			return (string) $_SESSION['web_slug'];
		}
		if (!empty($_SESSION['url_slug'])) {
			return (string) $_SESSION['url_slug'];
		}
		return '';
	}
}

if (!function_exists('web_tenant_row')) {
	/** Fila del restaurante resuelto por URL (sesión actualizada en cada request). */
	function web_tenant_row()
	{
		if (!empty($_SESSION['web_restaurante']) && is_array($_SESSION['web_restaurante'])) {
			return $_SESSION['web_restaurante'];
		}
		$id = function_exists('web_tenant_id') ? (int) web_tenant_id() : 0;
		if ($id <= 0) {
			return null;
		}
		$pdo = tenant_db_pdo();
		if (!$pdo) {
			return null;
		}
		try {
			$stmt = $pdo->prepare("SELECT * FROM restaurantes WHERE id_restaurante = ? LIMIT 1");
			$stmt->execute(array($id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				$_SESSION['web_restaurante'] = $row;
				return $row;
			}
		} catch (Exception $e) {
			// ignore
		}
		return null;
	}
}

if (!function_exists('web_brand_colors')) {
	/** Colores de marca del restaurante actual (menú / tienda). */
	function web_brand_colors()
	{
		$row = web_tenant_row();
		$prim = '#1e3d32';
		$sec = '#1a2a3a';
		$acc = '#c45c26';
		if ($row) {
			if (!empty($row['color_primario'])) {
				$prim = $row['color_primario'];
			}
			if (!empty($row['color_secundario'])) {
				$sec = $row['color_secundario'];
			}
			if (!empty($row['color_acento'])) {
				$acc = $row['color_acento'];
			}
		} else {
			if (!empty($_SESSION['restaurante_color_primario'])) {
				$prim = $_SESSION['restaurante_color_primario'];
			}
			if (!empty($_SESSION['restaurante_color_secundario'])) {
				$sec = $_SESSION['restaurante_color_secundario'];
			}
			if (!empty($_SESSION['restaurante_color_acento'])) {
				$acc = $_SESSION['restaurante_color_acento'];
			}
		}
		return array(
			'primario' => $prim,
			'secundario' => $sec,
			'acento' => $acc,
		);
	}
}

if (!function_exists('web_hex_to_rgb')) {
	/** "#RRGGBB" → "r, g, b" para usar en rgba(). */
	function web_hex_to_rgb($hex)
	{
		$hex = ltrim(trim((string) $hex), '#');
		if (strlen($hex) === 3) {
			$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
		}
		if (!preg_match('/^[0-9A-Fa-f]{6}$/', $hex)) {
			return '30, 61, 50';
		}
		return hexdec(substr($hex, 0, 2)) . ', ' . hexdec(substr($hex, 2, 2)) . ', ' . hexdec(substr($hex, 4, 2));
	}
}

if (!function_exists('web_brand_head_styles')) {
	/** Imprime CSS variables + overrides del tema para el menú público. */
	function web_brand_head_styles()
	{
		$c = web_brand_colors();
		$p = htmlspecialchars($c['primario'], ENT_QUOTES, 'UTF-8');
		$s = htmlspecialchars($c['secundario'], ENT_QUOTES, 'UTF-8');
		$a = htmlspecialchars($c['acento'], ENT_QUOTES, 'UTF-8');
		$pr = web_hex_to_rgb($c['primario']);
		$sr = web_hex_to_rgb($c['secundario']);
		$ar = web_hex_to_rgb($c['acento']);
		echo "<style id=\"web-brand-theme\">\n";
		echo ":root{\n";
		echo "  --brand-primary: {$p};\n";
		echo "  --brand-secondary: {$s};\n";
		echo "  --brand-accent: {$a};\n";
		echo "  --brand-primary-rgb: {$pr};\n";
		echo "  --brand-secondary-rgb: {$sr};\n";
		echo "  --brand-accent-rgb: {$ar};\n";
		echo "  --rs-forest: {$p};\n";
		echo "  --rs-ink: {$s};\n";
		echo "  --rs-accent: {$a};\n";
		echo "}\n";
		/* Barra superior */
		echo "#header .bottomnav, .bottomnav {\n";
		echo "  background-color: var(--brand-primary) !important;\n";
		echo "}\n";
		echo "#header .bottomnav a,\n";
		echo "#header .bottomnav .text-freeship,\n";
		echo "#header .bottomnav .nav2-icon-phone,\n";
		echo "#header .bottomnav .title-cog {\n";
		echo "  color: #fff !important;\n";
		echo "}\n";
		/* Textos / títulos del tema (#142332) */
		echo "body.lang-es,\n";
		echo "h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6,\n";
		echo ".product-price, .rs-add-cart-price,\n";
		echo "div.verticalmenu .navbar-nav > li > a,\n";
		echo ".popup-over .popup-content a {\n";
		echo "  color: var(--brand-secondary);\n";
		echo "}\n";
		/* Acento del tema (#f79a34): enlaces, nombres, hovers */
		echo "a:hover,\n";
		echo ".leo-megamenu .nav-link:hover .menu-title,\n";
		echo ".popup-over .popup-content a:hover,\n";
		echo ".popup-over .popup-content li.current,\n";
		echo ".popup-over .popup-content li.current a,\n";
		echo "#blockcart-modal .product-name,\n";
		echo ".rs-add-cart-name,\n";
		echo ".product-miniature .product-title a:hover {\n";
		echo "  color: var(--brand-accent) !important;\n";
		echo "}\n";
		echo ".popup-over .popup-content li.current a img {\n";
		echo "  border-color: var(--brand-accent) !important;\n";
		echo "}\n";
		/* Botones CTA */
		echo ".btn-primary, .btn-cart, .add-to-cart,\n";
		echo ".product-miniature .product-flags .new,\n";
		echo "#wrapper .btn-primary,\n";
		echo "#blockcart-modal .btn-primary,\n";
		echo ".rs-add-cart-actions .btn-primary {\n";
		echo "  background-color: var(--brand-accent) !important;\n";
		echo "  border-color: var(--brand-accent) !important;\n";
		echo "  color: #fff !important;\n";
		echo "}\n";
		echo ".btn-primary:hover, #wrapper .btn-primary:hover {\n";
		echo "  background-color: var(--brand-primary) !important;\n";
		echo "  border-color: var(--brand-primary) !important;\n";
		echo "}\n";
		/* Modal carrito / éxito (#4cbb6c) */
		echo "#blockcart-modal .modal-header,\n";
		echo ".rs-add-cart-header,\n";
		echo ".modal-header[style*=\"#4cbb6c\"],\n";
		echo ".ps-alert-success .item {\n";
		echo "  background: var(--brand-primary) !important;\n";
		echo "  border-color: var(--brand-primary) !important;\n";
		echo "}\n";
		/* Badges / destacados inline del tema (legacy #f79a34 / #4cbb6c / #142332) */
		echo "[style*=\"background-color: #f79a34\"],\n";
		echo "[style*=\"background-color:#f79a34\"],\n";
		echo "h1[style*=\"#f79a34\"],\n";
		echo "h4[style*=\"#f79a34\"] {\n";
		echo "  background-color: var(--brand-accent) !important;\n";
		echo "}\n";
		echo "[style*=\"color: #f79a34\"],\n";
		echo "[style*=\"color:#f79a34\"] {\n";
		echo "  color: var(--brand-accent) !important;\n";
		echo "}\n";
		echo "[style*=\"color: #142332\"],\n";
		echo "[style*=\"color:#142332\"] {\n";
		echo "  color: var(--brand-secondary) !important;\n";
		echo "}\n";
		echo "[style*=\"background: #4cbb6c\"],\n";
		echo "[style*=\"background:#4cbb6c\"] {\n";
		echo "  background: var(--brand-primary) !important;\n";
		echo "}\n";
		/* Controles del tema que aún usan acento naranja fijo */
		echo "#product-modal .modal-content .modal-body .arrows i:hover,\n";
		echo "#product-modal .modal-content .modal-body .slick-arrow {\n";
		echo "  background: var(--brand-accent) !important;\n";
		echo "  border-color: var(--brand-accent) !important;\n";
		echo "}\n";
		echo ".product-thumb-images .thumb.selected,\n";
		echo ".product-thumb-images .thumb:hover {\n";
		echo "  border-color: var(--brand-secondary) !important;\n";
		echo "}\n";
		/* Banner breadcrumb / tipografía de menú */
		echo "#wrapper .breadcrumb:before {\n";
		echo "  background: linear-gradient(120deg, rgba({$pr}, 0.92), rgba({$sr}, 0.85)),\n";
		echo "    url(/img/breadcrumb-bg.jpg) center/cover no-repeat !important;\n";
		echo "}\n";
		echo "#_desktop_cart .cart-products-count {\n";
		echo "  background: var(--brand-accent) !important;\n";
		echo "}\n";
		echo ".footer-center {\n";
		echo "  background: var(--brand-secondary) !important;\n";
		echo "}\n";
		echo ".block-categories .title_block {\n";
		echo "  background: var(--brand-primary) !important;\n";
		echo "}\n";
		echo "#js-product-list .btn-product.add-to-cart {\n";
		echo "  background: var(--brand-primary) !important;\n";
		echo "}\n";
		echo "#js-product-list .btn-product.add-to-cart:hover {\n";
		echo "  background: var(--brand-accent) !important;\n";
		echo "}\n";
		echo "</style>\n";
	}
}

if (!function_exists('sistema_brand_colors')) {
	/**
	 * Colores de marca para el POS (cualquier rol del restaurante).
	 * Prioriza BD del tenant; cae a sesión / defaults.
	 */
	function sistema_brand_colors()
	{
		$prim = '#2f353f';
		$sec = '#3c4858';
		$acc = '#01ba9a';
		$row = null;

		$id = 0;
		if (function_exists('tenantId')) {
			$id = (int) tenantId();
		}
		if ($id <= 0 && !empty($_SESSION['id_restaurante'])) {
			$id = (int) $_SESSION['id_restaurante'];
		}
		if ($id <= 0 && !empty($_SESSION['url_id_restaurante'])) {
			$id = (int) $_SESSION['url_id_restaurante'];
		}

		if ($id > 0 && function_exists('tenant_db_pdo')) {
			$pdo = tenant_db_pdo();
			if ($pdo) {
				try {
					$stmt = $pdo->prepare("SELECT color_primario, color_secundario, color_acento, logo, nombre, slug, id_restaurante FROM restaurantes WHERE id_restaurante = ? LIMIT 1");
					$stmt->execute(array($id));
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					if ($row && function_exists('restaurant_brand_apply_session')) {
						restaurant_brand_apply_session($row);
					}
				} catch (Exception $e) {
					$row = null;
				}
			}
		}

		if (!$row && !empty($_SESSION['web_restaurante']) && is_array($_SESSION['web_restaurante'])) {
			$row = $_SESSION['web_restaurante'];
		}

		if ($row) {
			if (!empty($row['color_primario'])) {
				$prim = $row['color_primario'];
			}
			if (!empty($row['color_secundario'])) {
				$sec = $row['color_secundario'];
			}
			if (!empty($row['color_acento'])) {
				$acc = $row['color_acento'];
			}
		} else {
			if (!empty($_SESSION['restaurante_color_primario'])) {
				$prim = $_SESSION['restaurante_color_primario'];
			}
			if (!empty($_SESSION['restaurante_color_secundario'])) {
				$sec = $_SESSION['restaurante_color_secundario'];
			}
			if (!empty($_SESSION['restaurante_color_acento'])) {
				$acc = $_SESSION['restaurante_color_acento'];
			}
		}

		return array(
			'primario' => $prim,
			'secundario' => $sec,
			'acento' => $acc,
		);
	}
}

if (!function_exists('sistema_brand_head_styles_html')) {
	/** Devuelve el CSS/JS de marca como string (seguro para callbacks de ob_start). */
	function sistema_brand_head_styles_html()
	{
		static $cache = null;
		if ($cache !== null) {
			return $cache;
		}
		if (!empty($_SESSION['acceso']) && $_SESSION['acceso'] === 'superadministrador') {
			return $cache = '';
		}
		$c = sistema_brand_colors();
		$p = htmlspecialchars($c['primario'], ENT_QUOTES, 'UTF-8');
		$s = htmlspecialchars($c['secundario'], ENT_QUOTES, 'UTF-8');
		$a = htmlspecialchars($c['acento'], ENT_QUOTES, 'UTF-8');
		$pr = function_exists('web_hex_to_rgb') ? web_hex_to_rgb($c['primario']) : '47, 53, 63';
		$sr = function_exists('web_hex_to_rgb') ? web_hex_to_rgb($c['secundario']) : '60, 72, 88';
		$ar = function_exists('web_hex_to_rgb') ? web_hex_to_rgb($c['acento']) : '1, 186, 154';
		$jp = json_encode($c['primario']);
		$js = json_encode($c['secundario']);
		$ja = json_encode($c['acento']);

		$css = "<style id=\"sistema-brand-theme\">\n";
		$css .= ":root{\n";
		$css .= "  --brand-primary: {$p};\n";
		$css .= "  --brand-secondary: {$s};\n";
		$css .= "  --brand-accent: {$a};\n";
		$css .= "  --brand-primary-rgb: {$pr};\n";
		$css .= "  --brand-secondary-rgb: {$sr};\n";
		$css .= "  --brand-accent-rgb: {$ar};\n";
		$css .= "}\n";
		$css .= ".navbar-default,.topbar .navbar-default,.navbar.navbar-default{background-color:var(--brand-primary)!important;border-color:var(--brand-primary)!important;}\n";
		$css .= ".topbar .topbar-left{background-color:var(--brand-secondary)!important;}\n";
		$css .= ".left.side-menu,.side-menu,#sidebar-menu,#sidebar-menu > ul > li > a,#wrapper.enlarged .left.side-menu #sidebar-menu ul > li:hover > ul a{background-color:var(--brand-secondary)!important;}\n";
		$css .= "#sidebar-menu a,#sidebar-menu ul li a,#sidebar-menu > ul > li > a,#sidebar-menu ul ul a,.side-menu a,.left.side-menu a{color:rgba(255,255,255,.88)!important;background-color:transparent!important;}\n";
		$css .= "#sidebar-menu > ul > li > a{background-color:var(--brand-secondary)!important;}\n";
		$css .= "#sidebar-menu > ul > li > a:hover,#sidebar-menu > ul > li > a:focus,#sidebar-menu > ul > li > a.subdrop,#sidebar-menu ul li a.subdrop,.subdrop{background-color:rgba(0,0,0,.22)!important;color:#fff!important;}\n";
		$css .= "#sidebar-menu > ul > li > a.active,#sidebar-menu ul li a.active{background-color:var(--brand-accent)!important;color:#fff!important;}\n";
		$css .= "#sidebar-menu ul ul a:hover,#sidebar-menu ul ul li.active a,#sidebar-menu ul ul a:focus{color:#fff!important;background-color:rgba(0,0,0,.18)!important;}\n";
		$css .= "#sidebar-menu a i,#sidebar-menu a span,#sidebar-menu .pull-right i{color:inherit!important;}\n";
		$css .= ".btn-warning,.btn-warning:hover,.btn-warning:focus,.btn-warning:active,.btn-success,.btn-success:hover,.btn-success:focus,.btn-teal,.btn-search,.bg-primary,.label-primary,.label-success,.badge-primary,.badge-success,.social-links li a,.pagination > .active > a,.pagination > .active > span,.nav-pills > li.active > a,.nav-pills > li.active > a:hover,.nav-pills > li.active > a:focus{background-color:var(--brand-accent)!important;border-color:var(--brand-accent)!important;color:#fff!important;}\n";
		$css .= ".btn-primary,.btn-primary:hover,.btn-primary:focus,.btn-primary:active{background-color:var(--brand-primary)!important;border-color:var(--brand-primary)!important;color:#fff!important;}\n";
		$css .= ".btn-info,.btn-info:hover,.btn-info:focus{background-color:var(--brand-secondary)!important;border-color:var(--brand-secondary)!important;}\n";
		$css .= "a{color:var(--brand-accent);}a:hover,a:focus{color:var(--brand-primary);}\n";
		$css .= "#sidebar-menu a:hover,#sidebar-menu a:focus,.side-menu a:hover,.side-menu a:focus{color:#fff!important;}\n";
		$css .= ".text-primary,.text-success{color:var(--brand-accent)!important;}\n";
		$css .= ".panel-primary > .panel-heading,.panel-color .panel-heading,.panel-pages .panel-heading.bg-img{background-color:var(--brand-primary)!important;border-color:var(--brand-primary)!important;}\n";
		$css .= ".progress-bar,.progress-bar-success{background-color:var(--brand-accent)!important;}\n";
		$css .= ".form-control:focus{border-color:var(--brand-accent)!important;box-shadow:0 0 0 0.15rem rgba(var(--brand-accent-rgb),.25)!important;}\n";
		$css .= "th[style*=\"#01ba9a\"],td[style*=\"#01ba9a\"],tr[style*=\"#01ba9a\"],[style*=\"background:#01ba9a\"],[style*=\"background: #01ba9a\"],[style*=\"background-color:#01ba9a\"],[style*=\"background-color: #01ba9a\"]{background:var(--brand-accent)!important;background-color:var(--brand-accent)!important;}\n";
		$css .= ".table > thead > tr > th{border-bottom-color:var(--brand-accent);}\n";
		$css .= ".checkbox-primary input[type=checkbox]:checked + label::before,.checkbox-success input[type=checkbox]:checked + label::before,.radio-primary input[type=radio]:checked + label::before{background-color:var(--brand-accent)!important;border-color:var(--brand-accent)!important;}\n";
		$css .= ".waves-effect.waves-light .waves-ripple{background:rgba(var(--brand-accent-rgb),.4);}\n";
		$css .= "</style>\n";
		$css .= "<script>window.__BRAND_PRIMARY={$jp};window.__BRAND_SECONDARY={$js};window.__BRAND_ACCENT={$ja};</script>\n";
		return $cache = $css;
	}
}

if (!function_exists('sistema_brand_head_styles')) {
	/** Tema de marca del POS: navbar, botones, badges, tablas, etc. */
	function sistema_brand_head_styles()
	{
		static $printed = false;
		if ($printed) {
			return;
		}
		$printed = true;
		echo sistema_brand_head_styles_html();
	}
}


if (!function_exists('web_base_path')) {
	function web_base_path()
	{
		$slug = web_tenant_slug();
		$app = app_base_path();
		if ($slug !== '') {
			return $app . '/' . $slug;
		}
		return $app;
	}
}

if (!function_exists('web_base_href')) {
	function web_base_href()
	{
		$base = web_base_path();
		return ($base !== '' ? $base : '') . '/';
	}
}

if (!function_exists('web_url')) {
	function web_url($path = '')
	{
		$path = ltrim((string) $path, '/');
		$base = web_base_path();
		if ($path === '') {
			return $base !== '' ? $base . '/' : '/';
		}
		return ($base !== '' ? $base . '/' : '/') . $path;
	}
}

if (!function_exists('sistema_url')) {
	function sistema_url($path = '')
	{
		$path = ltrim((string) $path, '/');
		$slug = web_tenant_slug();
		if ($slug === '' && !empty($_SESSION['url_slug'])) {
			$slug = $_SESSION['url_slug'];
		}
		$app = app_base_path();
		$prefix = $slug !== '' ? $app . '/' . $slug . '/sistema' : $app . '/sistema';
		if ($path === '') {
			return $prefix . '/';
		}
		return $prefix . '/' . $path;
	}
}

if (!function_exists('sistema_request_path')) {
	/** Path de la petición actual (sin query), normalizado. */
	function sistema_request_path()
	{
		$uri = isset($_SERVER['REQUEST_URI']) ? (string) $_SERVER['REQUEST_URI'] : '';
		$path = parse_url($uri, PHP_URL_PATH);
		if (!is_string($path) || $path === '') {
			$script = isset($_SERVER['SCRIPT_NAME']) ? (string) $_SERVER['SCRIPT_NAME'] : '';
			$path = $script !== '' ? $script : '/';
		}
		return str_replace('\\', '/', $path);
	}
}

if (!function_exists('sistema_assets_base_href')) {
	/**
	 * <base href> del POS = prefijo real de la URL del navegador hasta /sistema/.
	 * Ej: /resto/dhum/sistema/panel → /resto/dhum/sistema/
	 * Así el menú conserva el slug y no depende de APP_BASE_PATH mal detectado.
	 */
	function sistema_assets_base_href()
	{
		$path = sistema_request_path();
		if (preg_match('#^(.*?)/sistema(?:/|$)#i', $path, $m)) {
			return rtrim($m[1], '/') . '/sistema/';
		}
		if (function_exists('sistema_url')) {
			return rtrim(sistema_url(''), '/') . '/';
		}
		return rtrim(app_url('/sistema'), '/') . '/';
	}
}

if (!function_exists('sistema_static_base_href')) {
	/**
	 * Prefijo donde viven los archivos CSS/JS en disco: /[resto/]sistema/
	 * (NO bajo /{slug}/). Evita 404 cuando el rewrite del slug falla en XAMPP.
	 */
	function sistema_static_base_href()
	{
		$path = sistema_request_path();
		$doc = isset($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : false;
		$doc = $doc ? rtrim(str_replace('\\', '/', $doc), '/') : '';

		// /resto/{slug}/sistema/... → CSS físico en /resto/sistema/assets/...
		// (con 2 segmentos antes de sistema, el primero es siempre la carpeta de la app)
		if (preg_match('#^(/[^/]+)/[a-z0-9\-]+/sistema(?:/|$)#i', $path, $m)) {
			return $m[1] . '/sistema/';
		}

		// /resto/sistema/... (sin slug en la URL) → /resto/sistema/
		// /dhum/sistema/... (Docker raíz) → /sistema/  (dhum es el slug, no la carpeta)
		if (preg_match('#^(/[^/]+)/sistema(?:/|$)#i', $path, $m)) {
			$candidate = $m[1];
			if ($doc !== '' && (is_dir($doc . $candidate . '/sistema/assets') || is_file($doc . $candidate . '/tenant_context.php'))) {
				return $candidate . '/sistema/';
			}
			$app = app_base_path();
			if ($app !== '' && strcasecmp($app, $candidate) === 0) {
				return $candidate . '/sistema/';
			}
			return '/sistema/';
		}

		if (preg_match('#^/sistema(?:/|$)#i', $path)) {
			return '/sistema/';
		}

		$app = app_base_path();
		return ($app !== '' ? $app : '') . '/sistema/';
	}
}

if (!function_exists('url_tenant_id')) {
	function url_tenant_id()
	{
		if (!empty($_SESSION['url_id_restaurante'])) {
			return (int) $_SESSION['url_id_restaurante'];
		}
		return web_tenant_id();
	}
}

if (!function_exists('restaurant_logo_url')) {
	/**
	 * URL absoluta del logo del restaurante (válida con <base href> y rutas /{slug}/sistema/).
	 * Los logos se guardan en sistema/uploads/restaurantes/.
	 */
	function restaurant_logo_url($logo = null)
	{
		$default = app_url('/sistema/assets/images/logo_white_2.png');
		static $dbCache = array();

		if ($logo === null || $logo === '') {
			$id = 0;
			if (function_exists('tenantId')) {
				$id = (int) tenantId();
			}
			if ($id <= 0) {
				$id = function_exists('web_tenant_id') ? (int) web_tenant_id() : 0;
			}
			if ($id <= 0) {
				$id = function_exists('url_tenant_id') ? (int) url_tenant_id() : 0;
			}

			if ($id > 0) {
				if (!array_key_exists($id, $dbCache)) {
					$dbCache[$id] = null;
					$pdo = tenant_db_pdo();
					if ($pdo) {
						$st = $pdo->prepare('SELECT logo FROM restaurantes WHERE id_restaurante = ? LIMIT 1');
						$st->execute(array($id));
						$r = $st->fetch(PDO::FETCH_ASSOC);
						if ($r && !empty($r['logo'])) {
							$dbCache[$id] = $r['logo'];
							$_SESSION['restaurante_logo'] = $r['logo'];
						}
					}
				}
				$logo = $dbCache[$id];
			}

			if (($logo === null || $logo === '') && !empty($_SESSION['restaurante_logo'])) {
				$logo = $_SESSION['restaurante_logo'];
			} elseif (($logo === null || $logo === '') && !empty($_SESSION['web_restaurante']['logo'])) {
				$logo = $_SESSION['web_restaurante']['logo'];
			} elseif ($logo === null || $logo === '') {
				$row = function_exists('web_tenant_row') ? web_tenant_row() : null;
				if ($row && !empty($row['logo'])) {
					$logo = $row['logo'];
				}
			}
		}

		if ($logo === null || $logo === '') {
			return $default;
		}

		$logo = str_replace('\\', '/', (string) $logo);
		if (preg_match('#^https?://#i', $logo)) {
			return $logo;
		}
		$logo = ltrim($logo, '/');
		if (strpos($logo, 'sistema/') === 0) {
			return app_url('/' . $logo);
		}
		if (strpos($logo, 'uploads/') === 0 || strpos($logo, 'assets/') === 0 || strpos($logo, 'fotos/') === 0) {
			return app_url('/sistema/' . $logo);
		}
		return app_url('/' . $logo);
	}
}

if (!function_exists('restaurant_brand_apply_session')) {
	/** Guarda branding del restaurante en sesión (login POS / resolución URL). */
	function restaurant_brand_apply_session($row)
	{
		if (!$row || !is_array($row)) {
			return;
		}
		$_SESSION['web_restaurante'] = $row;
		if (!empty($row['logo'])) {
			$_SESSION['restaurante_logo'] = $row['logo'];
		}
		if (!empty($row['nombre'])) {
			$_SESSION['restaurante_nombre'] = $row['nombre'];
		}
		if (!empty($row['color_primario'])) {
			$_SESSION['restaurante_color_primario'] = $row['color_primario'];
		}
		if (!empty($row['color_secundario'])) {
			$_SESSION['restaurante_color_secundario'] = $row['color_secundario'];
		}
		if (!empty($row['color_acento'])) {
			$_SESSION['restaurante_color_acento'] = $row['color_acento'];
		}
		if (!empty($row['slug'])) {
			$slug = preg_replace('/[^a-z0-9\-]/', '', strtolower($row['slug']));
			$_SESSION['url_slug'] = $slug;
			$_SESSION['web_slug'] = $slug;
			// Cookie para que logout/expiración vuelvan al login del restaurante
			if ($slug !== '' && !headers_sent()) {
				setcookie('rs_slug', $slug, time() + 60 * 60 * 24 * 365, '/', '', false, true);
			}
		}
		if (!empty($row['id_restaurante'])) {
			$_SESSION['url_id_restaurante'] = (int) $row['id_restaurante'];
			$_SESSION['web_id_restaurante'] = (int) $row['id_restaurante'];
		}
	}
}

if (!function_exists('restaurant_slug_normalize')) {
	function restaurant_slug_normalize($slug)
	{
		return preg_replace('/[^a-z0-9\-]/', '', strtolower((string) $slug));
	}
}

if (!function_exists('restaurant_login_url')) {
	/** URL del login POS del restaurante (o SuperAdmin si no hay slug). */
	function restaurant_login_url($slug = null)
	{
		$slug = restaurant_slug_normalize($slug !== null ? $slug : '');
		if ($slug === '') {
			return app_url('/sistema/superadmin/login.php');
		}
		return app_url('/' . $slug . '/sistema/');
	}
}

if (!function_exists('restaurant_resolve_logout_slug')) {
	/**
	 * Obtiene el slug del restaurante antes de destruir la sesión.
	 */
	function restaurant_resolve_logout_slug()
	{
		$candidates = array();
		if (!empty($_GET['r_slug'])) {
			$candidates[] = $_GET['r_slug'];
		}
		if (!empty($_REQUEST['r_slug'])) {
			$candidates[] = $_REQUEST['r_slug'];
		}
		if (!empty($_SESSION['url_slug'])) {
			$candidates[] = $_SESSION['url_slug'];
		}
		if (!empty($_SESSION['web_slug'])) {
			$candidates[] = $_SESSION['web_slug'];
		}
		if (!empty($_COOKIE['rs_slug'])) {
			$candidates[] = $_COOKIE['rs_slug'];
		}
		// Desde la URL actual: [ /resto ] /{slug}/sistema/...
		$uri = isset($_SERVER['REQUEST_URI']) ? (string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
		$app = app_base_path();
		if ($app !== '' && strpos($uri, $app . '/') === 0) {
			$uri = substr($uri, strlen($app));
		} elseif ($app !== '' && $uri === $app) {
			$uri = '/';
		}
		if (preg_match('#^/([a-z0-9\-]+)/sistema(?:/|$)#i', $uri, $m)) {
			$candidates[] = $m[1];
		}
		$ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		if ($ref !== '' && preg_match('#(?:' . preg_quote($app, '#') . ')?/([a-z0-9\-]+)/sistema(?:/|$)#i', $ref, $m2)) {
			$candidates[] = $m2[1];
		}

		foreach ($candidates as $c) {
			$slug = restaurant_slug_normalize($c);
			if ($slug !== '' && $slug !== 'sistema' && $slug !== 'superadmin') {
				return $slug;
			}
		}

		// Último recurso: id_restaurante en sesión → BD
		$id = 0;
		if (!empty($_SESSION['id_restaurante'])) {
			$id = (int) $_SESSION['id_restaurante'];
		} elseif (!empty($_SESSION['url_id_restaurante'])) {
			$id = (int) $_SESSION['url_id_restaurante'];
		}
		if ($id > 0 && function_exists('tenant_db_pdo')) {
			$pdo = tenant_db_pdo();
			if ($pdo) {
				$st = $pdo->prepare('SELECT slug FROM restaurantes WHERE id_restaurante = ? LIMIT 1');
				$st->execute(array($id));
				$row = $st->fetch(PDO::FETCH_ASSOC);
				if ($row && !empty($row['slug'])) {
					return restaurant_slug_normalize($row['slug']);
				}
			}
		}

		return '';
	}
}

