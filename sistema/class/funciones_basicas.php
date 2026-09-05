<?php 
## funcion para prevenir ataques XSS
function limpiar($tags){
$tags = strip_tags($tags);
$tags = stripslashes($tags);
$tags = htmlentities($tags);
return $tags;
}

#####CONTRASE�A DE-ENCRIPTAR

function encrypt($string, $key) {
		$result = ''; $key=$key.'2013';
	   	for($i=0; $i<strlen($string); $i++) {
			  $char = substr($string, $i, 1);
			  $keychar = substr($key, ($i % strlen($key))-1, 1);
			  $char = chr(ord($char)+ord($keychar));
			  $result.=$char;
	   	}
	   	return base64_encode($result);
	}

function decrypt($string, $key) {
	   	$result = ''; $key=$key.'2013';
	   	$string = base64_decode($string);
	   	for($i=0; $i<strlen($string); $i++) {
			  $char = substr($string, $i, 1);
			  $keychar = substr($key, ($i % strlen($key))-1, 1);
			  $char = chr(ord($char)-ord($keychar));
			  $result.=$char;
	   	}
	   	return $result;
}



function limpiarEntrada($texto) {
 
 	//creamos un arreglo que sirva de patrones para eliminar partes no deseadas en las cadenas
	$busqueda = array(
	'@<script[^>]*?>.*?</script>@si',   // quitar javascript
	'@<[\/\!]*?[^<>]*?>@si',            // quitar tags de HTML
	'@<style[^>]*?>.*?</style>@siU',    // quitar estilos
	'@<![\s\S]*?--[ \t\n\r]*>@'         // quitar comentarios multil�nea
	);
 
 	//utilizamos la funci�n preg_replace que busca en una cadena patrones para sustituir
    $salida = preg_replace($busqueda, '', $texto);
    //devolvemos la cadena sin los patrones encontrados
    return $salida;
}


function edad($fecha_nac){
//Esta funcion toma una fecha de nacimiento 
//desde una base de datos mysql
//en formato aaaa/mm/dd y calcula la edad en numeros enteros

$dia=date("j");
$mes=date("n");
$anno=date("Y");

//descomponer fecha de nacimiento
$dia_nac=substr($fecha_nac, 8, 2);
$mes_nac=substr($fecha_nac, 5, 2);
$anno_nac=substr($fecha_nac, 0, 4);


if($mes_nac>$mes){
$calc_edad= $anno-$anno_nac-1;
}else{
if($mes==$mes_nac AND $dia_nac>$dia){
$calc_edad= $anno-$anno_nac-1; 
}else{
$calc_edad= $anno-$anno_nac;
}
}
return $calc_edad;
} 



	function estado($muestra) {

    if($muestra == "administrador") {
    echo "ADMINISTRADOR(A)";
    } elseif ($muestra == "cajero") {
    echo "CAJERO(A)";
    } elseif ($muestra == "cocinero") {
    echo "COCINERO(A)";
    } elseif ($muestra == "mesero") {
    echo "MESERO(A)";
    }   
    }

function convertir($string)
{
       $string = str_replace(
       array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'),
       array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', ' DIC'),
       $string
   );        
   return $string;
}

function meses($string)
{
       $string = str_replace(
      array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'),
      array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', ' DICIEMBRE'),
       $string
   );        
   return $string;
}

function dias($string)
{
       $string = str_replace(
       array('0', '1', '2', '3', '4', '5', '6'),
       array('DOM..', 'LUN.', 'MART.', 'MIERC.', 'JUEV.', 'VIER.', 'SAB.'),
       $string
   );        
   return $string;
}
	
function generar_clave($longitud){ 
           $cadena="[^A-Z0-9]"; 
           return substr(preg_replace($cadena, "", sha1(md5(rand()))) . 
           preg_replace($cadena, "", sha1(md5(rand()))) . 
           preg_replace($cadena, "", sha1(md5(rand()))), 
           0, $longitud); 
    }

//M�todo con rand()
function GenerateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} 

//M�todo con str_shuffle() 
function generateRandomString2($length = 10) { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
} 

function random_string($length) {
    switch(true) {
        case function_exists('mcrypt_create_iv') :
            $r = mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
        break;
        case function_exists('openssl_random_pseudo_bytes') :
            $r = openssl_random_pseudo_bytes($length);
        break;
        case is_readable('/dev/urandom') : // deceze
            $r = file_get_contents('/dev/urandom', false, null, 0, $length);
        break;
        default :
            $i = 0;
            $r = '';
            while($i ++ < $length) {
                $r .= chr(mt_rand(0, 255));
            }
        break;
    }
    return substr(bin2hex($r), 0, $length);
}


function formatear($valor)
{
    $a = explode(".",$valor);
    $b = substr($a[1],0,2);
    $numero = $a[0].".".$b;
    
    return $numero;
}

function formatear2($number, $digitos)
{
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos, '.', '.');

}

function rount($number, $digitos)
{
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos, '.', '');

}

function removeEmptyElements(&$element)
{
    if (is_array($element)) {
        if ($key = key($element)) {
            $element[$key] = array_filter($element);
        }

        if (count($element) != count($element, COUNT_RECURSIVE)) {
            $element = array_filter(current($element), __FUNCTION__);
        }

        $element = array_filter($element);

        return $element;
    } else {
        return empty($element) ? false : $element;
    }
}

########### CALCULAR DIAS TRANSCURRIDOS ENTRE DOS FECHAS CONTANDO PURO DIAS HABILES #########
function fechas($start, $end) {
    $range = array();

    if (is_string($start) === true) $start = strtotime($start);
    if (is_string($end) === true ) $end = strtotime($end);

    if ($start > $end) return createDateRangeArray($end, $start);

    do {
        $range[] = date('Y-m-d', $start);
        $start = strtotime("+ 1 day", $start);
    } while($start <= $end);

    return $range;
}
########### CALCULAR DIAS TRANSCURRIDOS ENTRE DOS FECHAS #########
function Dias_Transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
}
########### CACLULAR DIAS DE RETRASO ENTRE DOS FECHAS #########
function atraso($fecha)
{
    return floor((time()-strtotime($fecha)) / (60 * 60 * 24 ));
}

function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el l�mite a 6 d�gitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya lleg� al l�mite m�ximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres d�gitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres d�gitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                            
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es n�mero redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Mill�n, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aqu� si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma l�gica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                            
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                            
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta l�nea la puedes cambiar de acuerdo a tus necesidades o a tu pa�s -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO BOLIVARES $xdecimales/100 M.N.";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN BOLIVAR $xdecimales/100 M.N. ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " BOLIVARES $xdecimales/100 M.N. "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para M�xico se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

// END FUNCTION

function subfijo($xx)
{ // esta funci�n regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}


function getSubString($string, $length=NULL)
{
    //Si no se especifica la longitud por defecto es 50
    if ($length == NULL)
        $length = 50;
    //Primero eliminamos las etiquetas html y luego cortamos el string (UTF-8 seguro)
    $clean = strip_tags((string) $string);
    if (function_exists('mb_substr') && function_exists('mb_strlen')) {
        $stringDisplay = mb_substr($clean, 0, $length, 'UTF-8');
        if (mb_strlen($clean, 'UTF-8') > $length) {
            $stringDisplay .= '.';
        }
        return $stringDisplay;
    }
    $stringDisplay = substr($clean, 0, $length);
    if (strlen($clean) > $length) {
        $stringDisplay .= '.';
    }
    return $stringDisplay;
}

function renderEsperaBadge($fechapedido)
{
    if (empty($fechapedido) || $fechapedido === '0000-00-00 00:00:00') {
        return '';
    }
    $inicioTs = strtotime($fechapedido);
    if ($inicioTs === false || $inicioTs <= 0) {
        return '';
    }
    $diffSec = time() - $inicioTs;
    if ($diffSec < 0) {
        $diffSec = 0;
    }
    $h = (int) floor($diffSec / 3600);
    $m = (int) floor(($diffSec % 3600) / 60);
    $s = (int) ($diffSec % 60);
    $texto = ($h > 0)
        ? sprintf('%02d:%02d:%02d', $h, $m, $s)
        : sprintf('%02d:%02d', $m, $s);
    $minutos = $diffSec / 60;
    if ($minutos >= 15) {
        $bg = '#d9534f';
    } elseif ($minutos >= 5) {
        $bg = '#f0ad4e';
    } else {
        $bg = '#333';
    }
    return '<span class="mesa-espera" data-inicio-ts="' . (int) $inicioTs . '" style="background:' . $bg . ';"><i class="fa fa-clock-o"></i> <span class="mesa-espera-text">' . $texto . '</span></span>';
}

function mesaNombreExtraClass($nombreRaw)
{
    $len = function_exists('mb_strlen') ? mb_strlen($nombreRaw, 'UTF-8') : strlen($nombreRaw);
    if ($len > 12) {
        return ' mesa-nombre--xlargo';
    }
    if ($len > 8) {
        return ' mesa-nombre--largo';
    }
    return '';
}

function mesaEstadoCssClass($color, $listo = false)
{
    if ($listo) {
        return 'miMesa--listo';
    }
    $c = strtolower(trim((string) $color));
    if ($c === 'red' || $c === '#d9534f' || strpos($c, 'red') !== false) {
        return 'miMesa--ocupada';
    }
    if ($c === '#f0ad4e') {
        return 'miMesa--listo';
    }
    return 'miMesa--libre';
}

function aplicarMapaUnionAMesas($mesas, $mapa)
{
    if ($mesas == "" || empty($mesas)) {
        return array();
    }
    if (!is_array($mesas)) {
        return array();
    }
    if (empty($mapa['por_mesa'])) {
        return $mesas;
    }
    $porCod = array();
    foreach ($mesas as $mesa) {
        $porCod[(string) $mesa['codmesa']] = $mesa;
    }
    $resultado = array();
    foreach ($mesas as $mesa) {
        $cod = (string) $mesa['codmesa'];
        if (isset($mapa['por_mesa'][$cod]) && $mapa['por_mesa'][$cod] !== $cod) {
            continue;
        }
        if (isset($mapa['grupos'][$cod])) {
            $mesa['nombremesa'] = implode(' + ', $mapa['grupos'][$cod]['nombres']);
            $mesa['es_union'] = 1;
            $mesa['codmesa_principal'] = $cod;
            // Acumular métricas del grupo para que el timer no se pierda
            $cocina = 0;
            $activos = 0;
            $pendientes = 0;
            $fechaMin = null;
            $status = (int) $mesa['statusmesa'];
            foreach ($mapa['grupos'][$cod]['mesas'] as $codGrupo) {
                $codGrupo = (string) $codGrupo;
                if (!isset($porCod[$codGrupo])) {
                    continue;
                }
                $m = $porCod[$codGrupo];
                $cocina += isset($m['pedidos_cocina']) ? (int) $m['pedidos_cocina'] : 0;
                $activos += isset($m['pedidos_activos']) ? (int) $m['pedidos_activos'] : 0;
                $pendientes += isset($m['pedidos_pendientes']) ? (int) $m['pedidos_pendientes'] : 0;
                if ((int) $m['statusmesa'] === 1) {
                    $status = 1;
                }
                if (!empty($m['fechapedido']) && $m['fechapedido'] !== '0000-00-00 00:00:00') {
                    if ($fechaMin === null || strtotime($m['fechapedido']) < strtotime($fechaMin)) {
                        $fechaMin = $m['fechapedido'];
                    }
                }
            }
            $mesa['pedidos_cocina'] = $cocina;
            $mesa['pedidos_activos'] = $activos;
            $mesa['pedidos_pendientes'] = $pendientes > 0 ? $pendientes : ($cocina + $activos);
            $mesa['statusmesa'] = (string) $status;
            if ($fechaMin !== null) {
                $mesa['fechapedido'] = $fechaMin;
            }
        }
        $resultado[] = $mesa;
    }
    return $resultado;
}

function esMeseroSesion()
{
    return isset($_SESSION['acceso']) && $_SESSION['acceso'] === 'mesero';
}

function esSuperAdmin()
{
    return isset($_SESSION['acceso']) && $_SESSION['acceso'] === 'superadministrador';
}

/**
 * Usuario autenticado del POS (mostrador/caja), no SuperAdmin.
 */
function posUsuarioAutenticado()
{
    return isset($_SESSION['acceso'], $_SESSION['id_restaurante'])
        && in_array($_SESSION['acceso'], array('administrador', 'cajero', 'mesero', 'cocinero', 'repartidor'), true)
        && (int) $_SESSION['id_restaurante'] > 0;
}

/**
 * Tras resolver tenant por URL, alinear contexto web con el restaurante del login POS.
 * Evita tenantId()=0 cuando la URL trae otro slug pero la sesión es válida.
 */
function pos_sync_tenant_from_session()
{
    if (!posUsuarioAutenticado()) {
        return;
    }
    $sessionId = (int) $_SESSION['id_restaurante'];
    if ($sessionId <= 0) {
        return;
    }
    $urlId = function_exists('url_tenant_id') ? (int) url_tenant_id() : 0;
    if ($urlId > 0 && $urlId === $sessionId) {
        return;
    }
    $_SESSION['url_id_restaurante'] = $sessionId;
    $_SESSION['web_id_restaurante'] = $sessionId;
    if (function_exists('tenant_db_pdo')) {
        $pdo = tenant_db_pdo();
        if ($pdo) {
            $st = $pdo->prepare('SELECT * FROM restaurantes WHERE id_restaurante = ? LIMIT 1');
            $st->execute(array($sessionId));
            $row = $st->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $_SESSION['url_slug'] = $row['slug'];
                $_SESSION['web_slug'] = $row['slug'];
                $_SESSION['web_restaurante'] = $row;
                if (function_exists('restaurant_brand_apply_session')) {
                    restaurant_brand_apply_session($row);
                }
            }
        }
    }
}

/**
 * Sesión POS con cookie path=/ (compatible con /{slug}/sistema/...).
 */
function pos_bootstrap_session()
{
    if (session_status() !== PHP_SESSION_NONE) {
        return;
    }
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

function pos_redirect_login($msg = 'requerida')
{
    // Si la sesión POS sigue viva, no mandar al login (parece un deslogueo).
    if (function_exists('posUsuarioAutenticado') && posUsuarioAutenticado()) {
        $panelUrl = function_exists('sistema_url') ? sistema_url('panel') : 'panel';
        header('Location: ' . $panelUrl);
        exit;
    }
    $url = function_exists('pos_login_url') ? pos_login_url() : 'index';
    $url = rtrim((string) $url, '/');
    if ($msg !== '') {
        $url .= (strpos($url, '?') !== false ? '&' : '?') . 'msg=' . rawurlencode($msg);
    }
    header('Location: ' . $url);
    exit;
}

/**
 * Auth POS: roles permitidos + ExpiraSession. Nunca redirige a logout (no destruye sesión).
 */
function pos_require_auth($roles = null)
{
    if (!isset($_SESSION['acceso'])) {
        pos_redirect_login('requerida');
    }
    if ($roles !== null) {
        $roles = is_array($roles) ? $roles : array($roles);
        if (!in_array($_SESSION['acceso'], $roles, true)) {
            $panelUrl = function_exists('sistema_url') ? sistema_url('panel') : 'panel';
            echo '<script type="text/javascript">alert("NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.\\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO");document.location.href=';
            echo json_encode($panelUrl);
            echo ';</script>';
            exit;
        }
    }
    if (function_exists('pos_sync_tenant_from_session')) {
        pos_sync_tenant_from_session();
    }
    if (class_exists('Login')) {
        $tra = new Login();
        $tra->ExpiraSession();
    }
}

function pos_login_url()
{
    if (!empty($_SESSION['url_slug'])) {
        $slug = preg_replace('/[^a-z0-9\-]/', '', strtolower($_SESSION['url_slug']));
        if ($slug !== '' && function_exists('restaurant_login_url')) {
            return restaurant_login_url($slug);
        }
    }
    if (function_exists('restaurant_resolve_logout_slug')) {
        $slug = restaurant_resolve_logout_slug();
        if ($slug !== '' && function_exists('restaurant_login_url')) {
            return restaurant_login_url($slug);
        }
    }
    if (function_exists('sistema_url')) {
        return rtrim(sistema_url(''), '/');
    }
    return 'index';
}

function tenantId()
{
    if (esSuperAdmin()) {
        return 0;
    }
    if (!isset($_SESSION['id_restaurante']) || $_SESSION['id_restaurante'] === '' || $_SESSION['id_restaurante'] === null) {
        return 0;
    }
    $id = (int) $_SESSION['id_restaurante'];
    if ($id > 0 && function_exists('url_tenant_id')) {
        $urlId = (int) url_tenant_id();
        if ($urlId > 0 && $urlId !== $id) {
            if (posUsuarioAutenticado()) {
                return $id;
            }
            return 0;
        }
    }
    return $id;
}

function requireSuperAdmin()
{
    if (!isset($_SESSION['acceso']) || $_SESSION['acceso'] !== 'superadministrador') {
        header('Location: ../logout.php');
        exit;
    }
}

function requireTenant()
{
    if (esSuperAdmin()) {
        header('Location: superadmin/panel.php');
        exit;
    }
    if (tenantId() <= 0) {
        $out = 'logout.php';
        if (function_exists('sistema_url') && function_exists('restaurant_resolve_logout_slug')) {
            $s = restaurant_resolve_logout_slug();
            if ($s !== '') {
                $_SESSION['url_slug'] = $s;
                $out = sistema_url('logout');
            } elseif (function_exists('app_url')) {
                $out = app_url('/sistema/logout.php');
            }
        } elseif (function_exists('restaurant_resolve_logout_slug')) {
            $s = restaurant_resolve_logout_slug();
            if ($s !== '') {
                $out = '/' . $s . '/sistema/logout';
            }
        }
        header('Location: ' . $out);
        exit;
    }
}

function tenantWhere($alias = '')
{
    $col = ($alias !== '') ? $alias . '.id_restaurante' : 'id_restaurante';
    $id = tenantId();
    if ($id <= 0) {
        return ' 1=0 ';
    }
    return ' ' . $col . ' = ' . (int) $id . ' ';
}

function puedeGestionarUnionMesas()
{
    if (!isset($_SESSION['acceso'])) {
        return false;
    }
    return in_array($_SESSION['acceso'], array('mesero', 'cajero', 'administrador'), true);
}

function getMesaEstadoMesero($mesa)
{
    $pendientesCocina = isset($mesa['pedidos_cocina']) ? (int) $mesa['pedidos_cocina'] : 0;
    $pedidosActivos = isset($mesa['pedidos_activos']) ? (int) $mesa['pedidos_activos'] : 0;
    $pedidosPendientes = isset($mesa['pedidos_pendientes'])
        ? (int) $mesa['pedidos_pendientes']
        : ($pendientesCocina + $pedidosActivos);
    $fechapedido = isset($mesa['fechapedido']) ? $mesa['fechapedido'] : '';
    $statusmesa = (int) $mesa['statusmesa'];

    // Libre solo cuando caja liberó la mesa (sin ventas PENDIENTE)
    $ocupada = ($statusmesa === 1) || ($pedidosPendientes > 0);
    if (!$ocupada) {
        return array(
            'color' => '#5cb85c',
            'listo' => false,
            'timer' => false,
            'fechapedido' => ''
        );
    }

    // Mientras la mesa esté ocupada el cronómetro sigue (rojo o amarillo)
    $timer = !empty($fechapedido) && $fechapedido !== '0000-00-00 00:00:00';

    if ($pendientesCocina > 0) {
        return array(
            'color' => 'red',
            'listo' => false,
            'timer' => $timer,
            'fechapedido' => $fechapedido
        );
    }

    // Cocina entregó: amarillo + LISTO, timer sigue hasta que caja cierre
    return array(
        'color' => '#f0ad4e',
        'listo' => true,
        'timer' => $timer,
        'fechapedido' => $fechapedido
    );
}

function renderMesaListItem($mesa, $imgStyle = 'display:inline;margin:18px;float:left;width:78px;height:65px;')
{
    $codmesaEnc = base64_encode($mesa['codmesa']);
    $nombre = htmlspecialchars($mesa['nombremesa'], ENT_QUOTES, 'UTF-8');
    $estado = getMesaEstadoMesero($mesa);
    $bg = $estado['color'];
    $timer = $estado['timer'] ? renderEsperaBadge($estado['fechapedido']) : '';
    $badgeListo = $estado['listo']
        ? '<span class="mesa-chip mesa-chip--listo"><i class="fa fa-check"></i> LISTO</span>'
        : '';
    $badgeUnion = !empty($mesa['es_union'])
        ? '<span class="mesa-chip mesa-chip--union"><i class="fa fa-link"></i> UNIDAS</span>'
        : '';
    $pedidoActivo = ((int) $mesa['statusmesa'] !== 0)
        || (isset($mesa['pedidos_activos']) && (int) $mesa['pedidos_activos'] > 0)
        || (isset($mesa['pedidos_cocina']) && (int) $mesa['pedidos_cocina'] > 0);
    if ((int) $mesa['statusmesa'] !== 0
        && (int) (isset($mesa['pedidos_activos']) ? $mesa['pedidos_activos'] : 0) === 0
        && (int) (isset($mesa['pedidos_cocina']) ? $mesa['pedidos_cocina'] : 0) === 0) {
        $pedidoActivo = false;
    }
    $claseExtra = (puedeGestionarUnionMesas() && !$pedidoActivo) ? ' mesa-unible' : '';
    $onclick = puedeGestionarUnionMesas()
        ? "manejarClickMesa(this, '" . $codmesaEnc . "')"
        : "RecibeMesa('" . $codmesaEnc . "')";
    $estadoClase = mesaEstadoCssClass($bg, !empty($estado['listo']));
    $nombreClase = mesaNombreExtraClass($mesa['nombremesa']);
    $metaHtml = $timer . $badgeListo . $badgeUnion;
    $conMeta = ($metaHtml !== '') ? ' miMesa--con-meta' : '';
    ob_start();
    ?>
            <li class="mesa-tile-wrap">
<div class="users-list-name codMesa mesa-tile<?php echo $claseExtra; ?>" title="<?php echo $nombre; ?>"
     data-codmesa="<?php echo (int) $mesa['codmesa']; ?>"
     data-codsala="<?php echo (int) $mesa['codsala']; ?>"
     data-statusmesa="<?php echo (int) $mesa['statusmesa']; ?>"
     data-pedido-activo="<?php echo $pedidoActivo ? '1' : '0'; ?>"
     onclick="<?php echo $onclick; ?>">
                    <div class="miMesa <?php echo $estadoClase . $conMeta; ?>">
                        <img src="assets/images/mesa.png" alt="" class="mesa-icon">
                        <span class="mesa-nombre<?php echo $nombreClase; ?>"><?php echo $nombre; ?></span>
                        <?php if ($metaHtml !== '') { ?><span class="mesa-meta"><?php echo $metaHtml; ?></span><?php } ?>
                    </div>
                </div>
            </li>
    <?php
    return ob_get_clean();
}

function renderMesasPanel($imgStyle = 'display:inline;margin:18px;float:left;width:78px;height:65px;')
{
    ob_start();
    $sala = new Login();
    $salas = $sala->ListarSalas();
    $mesaObj = new Login();
    $mapaUnion = $mesaObj->ObtenerMapaMesasUnidas();
    if ($salas == "") {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><span class='fa fa-info-circle'></span> NO EXISTEN SALAS REGISTRADAS ACTUALMENTE</center></div>";
        return ob_get_clean();
    }
    if (puedeGestionarUnionMesas()) {
        ?>
        <div id="barra-juntar-mesas" class="clearfix" style="margin-bottom:12px;padding:8px;background:#f9f9f9;border-radius:4px;">
            <button type="button" id="btn-modo-juntar" class="btn btn-info btn-sm"><i class="fa fa-link"></i> Juntar mesas</button>
            <span id="juntar-mesas-ayuda" style="display:none;margin-left:8px;color:#555;font-size:12px;">Seleccione 2 o más mesas <strong>disponibles (verdes)</strong> sin pedido en curso, del mismo salón.</span>
            <button type="button" id="btn-confirmar-juntar" class="btn btn-success btn-sm" style="display:none;margin-left:6px;"><i class="fa fa-check"></i> Confirmar unión</button>
            <button type="button" id="btn-cancelar-juntar" class="btn btn-default btn-sm" style="display:none;margin-left:4px;">Cancelar</button>
            <span id="juntar-mesas-contador" class="label label-primary" style="display:none;margin-left:8px;">0</span>
        </div>
        <?php
    }
    ?>
                        <ul class="nav nav-tabs tabs">
    <?php for ($i = 0; $i < sizeof($salas); $i++) { ?>
    <li class="tab <?php echo $i === 0 ? 'active' : ''; ?>">
        <a href="#<?php echo $salas[$i]['codsala'];?>" data-toggle="tab" aria-expanded="true" role="tab">
        <span class="visible-xs" title="<?php echo htmlspecialchars($salas[$i]['nombresala']);?>"><i class="fa fa-building"></i></span>
        <span class="hidden-xs"><?php echo htmlspecialchars($salas[$i]['nombresala']);?></span>
        </a>
    </li>
    <?php } ?>
</ul>
<div class="tab-content">
    <?php for ($i = 0; $i < sizeof($salas); $i++) {
            $codigo_sala = $salas[$i]['codsala'];
    ?>
    <div class="tab-pane <?php echo $i === 0 ? 'active' : ''; ?>" id="<?php echo $codigo_sala;?>">
        <p>
        <ul class="users-list clearfix mesas-grid" id="listMesas">
            <?php
                $mesas = $mesaObj->ListarMesas();
                if ($mesas == "") {
                    echo "<div class='alert alert-danger'><center><span class='fa fa-info-circle'></span> NO EXISTEN MESAS REGISTRADAS EN LAS SALAS ACTUALMENTE</center></div>";
                } else {
                    $mesasSala = array();
                    for ($ii = 0; $ii < sizeof($mesas); $ii++) {
                        if ($mesas[$ii]['codsala'] == $codigo_sala) {
                            $mesasSala[] = $mesas[$ii];
                        }
                    }
                    $mesasSala = aplicarMapaUnionAMesas($mesasSala, $mapaUnion);
                    foreach ($mesasSala as $mesaItem) {
                        echo renderMesaListItem($mesaItem, $imgStyle);
                    }
                }
            ?>
        </ul>
        </p>
    </div>
    <?php } ?>
</div>
    <?php
    return ob_get_clean();
}

function renderMesaListItemCocinero($mesa, $imgStyle = 'display:inline;margin:18px;float:left;width:78px;height:65px;')
{
    $pendientes = isset($mesa['pedidos_cocina']) ? (int) $mesa['pedidos_cocina'] : 0;
    if ($pendientes <= 0) {
        return '';
    }
    $codmesaEnc = base64_encode($mesa['codmesa']);
    $nombre = htmlspecialchars($mesa['nombremesa'], ENT_QUOTES, 'UTF-8');
    $timer = renderEsperaBadge(isset($mesa['fechapedido']) ? $mesa['fechapedido'] : '');
    $badge = ($pendientes > 1) ? '<span class="mesa-badge-count">' . $pendientes . '</span>' : '';
    $badgeUnion = !empty($mesa['es_union'])
        ? '<span class="mesa-chip mesa-chip--union"><i class="fa fa-link"></i></span>'
        : '';
    $nombreClase = mesaNombreExtraClass($mesa['nombremesa']);
    ob_start();
    ?>
            <li class="mesa-tile-wrap">
<div class="users-list-name codMesa mesa-tile" title="<?php echo $nombre; ?>" onclick="RecibeMesaCocinero('<?php echo $codmesaEnc; ?>')">
                    <div class="miMesa miMesa--ocupada"><?php echo $badge; ?>
                        <img src="assets/images/mesa.png" alt="" class="mesa-icon">
                        <span class="mesa-nombre<?php echo $nombreClase; ?>"><?php echo $nombre; ?></span>
                        <span class="mesa-meta"><?php echo $timer . $badgeUnion; ?></span>
                    </div>
                </div>
            </li>
    <?php
    return ob_get_clean();
}

function renderDeliveryTileCocinero($deliveryInfo, $imgStyle = 'display:inline;margin:18px;float:left;width:78px;height:65px;')
{
    $count = isset($deliveryInfo['total']) ? (int) $deliveryInfo['total'] : 0;
    if ($count <= 0) {
        return '';
    }
    $codmesaEnc = base64_encode('0');
    $timer = renderEsperaBadge(isset($deliveryInfo['fechapedido']) ? $deliveryInfo['fechapedido'] : '');
    ob_start();
    ?>
            <li class="mesa-tile-wrap">
<div class="users-list-name codMesa mesa-tile" title="Delivery" onclick="RecibeMesaCocinero('<?php echo $codmesaEnc; ?>')">
                    <div class="miMesa miMesa--ocupada"><span class="mesa-badge-count"><?php echo $count; ?></span>
                        <img src="assets/images/mesa.png" alt="" class="mesa-icon">
                        <span class="mesa-nombre mesa-nombre--largo">DELIVERY</span>
                        <span class="mesa-meta"><?php echo $timer; ?></span>
                    </div>
                </div>
            </li>
    <?php
    return ob_get_clean();
}

function renderMesasPanelCocinero($imgStyle = 'display:inline;margin:18px;float:left;width:78px;height:65px;')
{
    ob_start();
    $sala = new Login();
    $salas = $sala->ListarSalas();
    $deliveryObj = new Login();
    $deliveryInfo = $deliveryObj->ContarDeliveryCocina();
    $deliveryCount = isset($deliveryInfo['total']) ? (int) $deliveryInfo['total'] : 0;

    $mesaObj = new Login();
    $mesas = $mesaObj->ListarMesasCocinero();
    $mapaUnion = $mesaObj->ObtenerMapaMesasUnidas();
    $pendientesPorSala = array();
    $mesasPorSala = array();
    if ($mesas != "") {
        for ($ii = 0; $ii < sizeof($mesas); $ii++) {
            $codsala = (string) $mesas[$ii]['codsala'];
            $count = isset($mesas[$ii]['pedidos_cocina']) ? (int) $mesas[$ii]['pedidos_cocina'] : 0;
            if ($count <= 0) {
                continue;
            }
            if (!isset($pendientesPorSala[$codsala])) {
                $pendientesPorSala[$codsala] = 0;
                $mesasPorSala[$codsala] = array();
            }
            $pendientesPorSala[$codsala] += $count;
            $mesasPorSala[$codsala][] = $mesas[$ii];
        }
    }

    if ($salas == "" && $deliveryCount == 0) {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><span class='fa fa-info-circle'></span> NO EXISTEN SALAS REGISTRADAS ACTUALMENTE</center></div>";
        return ob_get_clean();
    }
    ?>
                        <ul class="nav nav-tabs tabs" id="cocinero-tabs">
    <?php if ($deliveryCount > 0) { ?>
    <li class="tab">
        <a href="#cocina-delivery" data-toggle="tab" aria-expanded="false" role="tab">
        <span class="visible-xs" title="Delivery"><i class="fa fa-motorcycle"></i> <span class="label label-danger"><?php echo $deliveryCount; ?></span></span>
        <span class="hidden-xs">Delivery <span class="label label-danger"><?php echo $deliveryCount; ?></span></span>
        </a>
    </li>
    <?php } ?>
    <?php for ($i = 0; $i < sizeof($salas); $i++) {
            $codigoSala = (string) $salas[$i]['codsala'];
            $countSala = isset($pendientesPorSala[$codigoSala]) ? (int) $pendientesPorSala[$codigoSala] : 0;
    ?>
    <li class="tab <?php echo $i === 0 ? 'active' : ''; ?>">
        <a href="#cocina-sala-<?php echo $codigoSala;?>" data-toggle="tab" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" role="tab">
        <span class="visible-xs" title="<?php echo htmlspecialchars($salas[$i]['nombresala']);?>"><i class="fa fa-building"></i><?php if ($countSala > 0) { ?> <span class="label label-danger"><?php echo $countSala; ?></span><?php } ?></span>
        <span class="hidden-xs"><?php echo htmlspecialchars($salas[$i]['nombresala']); ?><?php if ($countSala > 0) { ?> <span class="label label-danger"><?php echo $countSala; ?></span><?php } ?></span>
        </a>
    </li>
    <?php } ?>
</ul>
<div class="tab-content">
    <?php if ($deliveryCount > 0) { ?>
    <div class="tab-pane" id="cocina-delivery">
        <p>
        <ul class="users-list clearfix mesas-grid">
            <?php echo renderDeliveryTileCocinero($deliveryInfo, $imgStyle); ?>
        </ul>
        </p>
    </div>
    <?php } ?>
    <?php for ($i = 0; $i < sizeof($salas); $i++) {
            $codigo_sala = (string) $salas[$i]['codsala'];
            $mesasEnSala = isset($mesasPorSala[$codigo_sala]) ? $mesasPorSala[$codigo_sala] : array();
            $countSala = isset($pendientesPorSala[$codigo_sala]) ? (int) $pendientesPorSala[$codigo_sala] : 0;
    ?>
    <div class="tab-pane <?php echo $i === 0 ? 'active' : ''; ?>" id="cocina-sala-<?php echo $codigo_sala;?>">
        <p>
        <ul class="users-list clearfix mesas-grid" id="listMesasCocinero">
            <?php
                if (empty($mesasEnSala)) {
                    echo "<div class='alert alert-info'><center><span class='fa fa-info-circle'></span> NO HAY PEDIDOS EN ESTA SALA</center></div>";
                } else {
                    $mesasEnSala = aplicarMapaUnionAMesas($mesasEnSala, $mapaUnion);
                    foreach ($mesasEnSala as $mesaItem) {
                        echo renderMesaListItemCocinero($mesaItem, $imgStyle);
                    }
                }
            ?>
        </ul>
        </p>
    </div>
    <?php } ?>
</div>
    <?php
    return ob_get_clean();
}

function carritoMesaDecode($codmesaRef)
{
    if ($codmesaRef === '' || $codmesaRef === null) {
        return '';
    }
    $ref = trim((string) $codmesaRef);
    if (preg_match('/^\d+$/', $ref)) {
        return $ref;
    }
    $decoded = base64_decode($ref, true);
    if ($decoded !== false && $decoded !== '' && preg_match('/^\d+$/', $decoded)) {
        return $decoded;
    }
    return $ref;
}

function resolverClaveCarritoMesa($codmesaRef = null)
{
    if ($codmesaRef === null || $codmesaRef === '') {
        $codmesaRef = isset($_SESSION['CarritoMesaActiva']) ? $_SESSION['CarritoMesaActiva'] : '';
        if ($codmesaRef === '') {
            return '';
        }
    }
    $codmesa = carritoMesaDecode($codmesaRef);
    if ($codmesa === '') {
        return '';
    }
    $login = new Login();
    return (string) $login->ResolverMesaPrincipal($codmesa);
}

function activarCarritoMesa($codmesaRef)
{
    $codmesa = resolverClaveCarritoMesa($codmesaRef);
    if ($codmesa === '') {
        return '';
    }
    $_SESSION['CarritoMesaActiva'] = $codmesa;
    if (!isset($_SESSION['CarritoVentasPorMesa']) || !is_array($_SESSION['CarritoVentasPorMesa'])) {
        $_SESSION['CarritoVentasPorMesa'] = array();
    }
    if (!isset($_SESSION['CarritoVentasPorMesa'][$codmesa])) {
        $_SESSION['CarritoVentasPorMesa'][$codmesa] = array();
    }
    sincronizarCarritoVentasActivo($codmesa);
    return $codmesa;
}

function sincronizarCarritoVentasActivo($codmesa = null)
{
    if ($codmesa === null) {
        $codmesa = isset($_SESSION['CarritoMesaActiva']) ? $_SESSION['CarritoMesaActiva'] : '';
    }
    $codmesa = (string) $codmesa;
    if (!isset($_SESSION['CarritoVentasPorMesa'][$codmesa])) {
        $_SESSION['CarritoVentasPorMesa'][$codmesa] = array();
    }
    $_SESSION['CarritoVentas'] = $_SESSION['CarritoVentasPorMesa'][$codmesa];
}

function getCarritoVentas($codmesa = null)
{
    $codmesa = resolverClaveCarritoMesa($codmesa);
    if ($codmesa === '') {
        return array();
    }
    if (!isset($_SESSION['CarritoVentasPorMesa']) || !is_array($_SESSION['CarritoVentasPorMesa'])) {
        return array();
    }
    if (!isset($_SESSION['CarritoVentasPorMesa'][$codmesa])) {
        return array();
    }
    return normalizarItemsCarritoPedido($_SESSION['CarritoVentasPorMesa'][$codmesa]);
}

function normalizarItemsCarritoPedido($items)
{
    if (!is_array($items)) {
        return array();
    }
    $out = array();
    foreach ($items as $row) {
        if (!is_array($row) || !isset($row['txtCodigo']) || $row['txtCodigo'] === '') {
            continue;
        }
        $cant = isset($row['cantidad']) ? (float) $row['cantidad'] : 0;
        if ($cant <= 0) {
            continue;
        }
        $out[] = array(
            'txtCodigo' => (string) $row['txtCodigo'],
            'ivaproducto' => isset($row['ivaproducto']) ? (string) $row['ivaproducto'] : 'NO',
            'precioconiva' => isset($row['precioconiva']) ? $row['precioconiva'] : '0',
            'precio' => isset($row['precio']) ? $row['precio'] : '0',
            'precio2' => isset($row['precio2']) ? $row['precio2'] : '0',
            'existencia' => isset($row['existencia']) ? $row['existencia'] : '0',
            'tipo' => isset($row['tipo']) ? (string) $row['tipo'] : '0',
            'cantidad' => $cant,
            'descripcion' => isset($row['descripcion']) ? (string) $row['descripcion'] : '',
        );
    }
    return $out;
}

function obtenerCarritoPedido($codmesaRef)
{
    $clave = resolverClaveCarritoMesa($codmesaRef);
    if ($clave === '') {
        return array();
    }
    if (!empty($_POST['carrito_json'])) {
        $raw = json_decode($_POST['carrito_json'], true);
        if (!is_array($raw)) {
            $raw = json_decode(stripslashes($_POST['carrito_json']), true);
        }
        $items = normalizarItemsCarritoPedido($raw);
        if (!empty($items)) {
            setCarritoVentas($items, $clave);
            return $items;
        }
    }
    return getCarritoVentas($clave);
}

function setCarritoVentas($items, $codmesa = null)
{
    $codmesa = resolverClaveCarritoMesa($codmesa);
    if ($codmesa === '') {
        return;
    }
    if (!isset($_SESSION['CarritoVentasPorMesa']) || !is_array($_SESSION['CarritoVentasPorMesa'])) {
        $_SESSION['CarritoVentasPorMesa'] = array();
    }
    $_SESSION['CarritoVentasPorMesa'][$codmesa] = $items;
    sincronizarCarritoVentasActivo($codmesa);
}

function unsetCarritoVentas($codmesa = null)
{
    $codmesa = resolverClaveCarritoMesa($codmesa);
    if ($codmesa === '') {
        return;
    }
    if (isset($_SESSION['CarritoVentasPorMesa'][$codmesa])) {
        unset($_SESSION['CarritoVentasPorMesa'][$codmesa]);
    }
    sincronizarCarritoVentasActivo($codmesa);
}

function renderCarritoMesaPanel($config)
{
    $simbolo = isset($config[0]['simbolo']) ? $config[0]['simbolo'] : '';
    $ivav = isset($config[0]['ivav']) ? $config[0]['ivav'] : '0.00';
    ob_start();
    ?>
<div class="panel panel-info mesa-carrito-panel" style="margin-bottom:0;">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Orden en curso</h3>
    </div>
    <div class="panel-body" style="padding:8px;">
        <div class="table-responsive" data-pattern="priority-columns">
            <table id="carrito" class="table table-small-font table-striped">
                <thead>
                    <tr style="background:#01ba9a;">
                        <th style="color:#FFFFFF;">Cant.</th>
                        <th style="color:#FFFFFF;">Producto</th>
                        <th style="color:#FFFFFF;">Precio</th>
                        <th style="color:#FFFFFF;">Acci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4"><center><label><h5>NO HAY PRODUCTOS AGREGADOS</h5></label></center></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <table width="100%" id="carritototal" style="margin-top:10px;">
            <tr>
                <td colspan="3"><span class="Estilo9"><label>Total a Confirmar:</label></span></td>
                <td><div align="right" class="Estilo9"><?php echo "<strong>" . htmlspecialchars($simbolo) . "</strong>"; ?><label id="lbltotal" name="lbltotal">0.00</label>
                <input type="hidden" name="txtsubtotal" id="txtsubtotal" value="0.00"/>
                <input type="hidden" name="txtsubtotal2" id="txtsubtotal2" value="0.00"/>
                <input type="hidden" name="iva" id="iva" value="<?php echo htmlspecialchars($ivav); ?>"/>
                <input type="hidden" name="txtIva" id="txtIva" value="0.00"/>
                <input type="hidden" name="txtDescuento" id="txtDescuento" value="0.00"/>
                <input type="hidden" name="txtTotal" id="txtTotal" value="0.00"/>
                <input type="hidden" name="txtTotalCompra" id="txtTotalCompra" value="0.00"/></div></td>
            </tr>
        </table>
        <div style="display:none;">
            <label id="lblsubtotal" name="lblsubtotal">0.00</label>
            <label id="lblsubtotal2" name="lblsubtotal2">0.00</label>
            <label id="lbliva" name="lbliva">0.00</label>
            <label id="lbldescuento" name="lbldescuento">0.00</label>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-md-12">
                <label id="boton-observaciones" onClick="mostrar();" style="cursor:pointer;">Agregar Observaciones:</label>
                <div id="panel-observaciones" style="display:none;">
                    <div class="form-group has-feedback">
                        <textarea name="observaciones" class="form-control teclado-observaciones" id="observaciones-pedido" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observaciones"></textarea>
                        <i class="fa fa-comments form-control-feedback"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="mesa-carrito-acciones" style="margin-top:12px;">
            <button type="submit" name="btn-venta" id="btn-venta" class="btn btn-primary btn-block"><span class="fa fa-save"></span> Confirmar Pedido</button>
            <button type="submit" name="btn-agregapedidos" id="btn-agregapedidos" class="btn btn-primary btn-block" style="display:none;"><span class="fa fa-save"></span> Confirmar Pedido</button>
            <button type="button" id="vaciarv" class="btn btn-danger btn-block" title="Vaciar Carrito"><span class="fa fa-trash-o"></span> Limpiar</button>
        </div>
    </div>
</div>
    <?php
    return ob_get_clean();
}

function renderCarritoMesaTabla()
{
    $config = new Login();
    $config = $config->ConfiguracionPorId();
    return renderCarritoMesaPanel($config);
}

?>