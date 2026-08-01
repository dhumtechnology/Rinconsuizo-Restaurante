<!DOCTYPE html>
<?php
if (!isset($restaurante_nombre) || $restaurante_nombre === '') {
    $restaurante_nombre = function_exists('web_mail_restaurante_info')
        ? web_mail_restaurante_info()['nombre']
        : 'Restaurante';
}
$full_name = strip_tags(isset($cliente->nomcliente) ? $cliente->nomcliente : '');
$email = strip_tags(isset($cliente->emailcliente) ? $cliente->emailcliente : '');
$codigoPedido = isset($codigo) ? (string) $codigo : '';
$subject = "Comprobante de pedidos";
?>
<html lang="es">
    <head>
        <title>Comprobante</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
   <div style="border: 1px solid #6c91b2;border-radius: 10px; padding: 10px;">


     <table width='100%' bgcolor='white' cellpadding='0' cellspacing='0' border='0'>

     <tr><td>

     <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:white; font-family:Verdana, Geneva, sans-serif;'>


        <tr height='80'>
         <th colspan='4' style='background-color:white; border-bottom:solid 0px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >
         <h4><?php echo htmlspecialchars(function_exists('mb_strtoupper') ? mb_strtoupper($restaurante_nombre, 'UTF-8') : strtoupper($restaurante_nombre)); ?></h4>


          <p style='font-size: 16px;font-family: Verdana, Geneva, sans-serif;background-color: #333f50;color: white;text-align: center; font-weight: 200;padding: 15px;border-radius: 10px;'> <?php echo htmlspecialchars($full_name); ?></p>
         </th>
        </tr>

          <?php if ($codigoPedido !== '') { ?>
          <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
           <td colspan='2' style='width: 40%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: #c45c26;color: white;text-align: center; font-weight: 200;padding: 8px;border-radius: 5px;'> CÓDIGO DE CONFIRMACIÓN </p></td>
           <td colspan='2' style='width: 60%'><p style='font-size: 20px;font-family: Verdana, Geneva, sans-serif;background-color: white;color: #1a2a3a;text-align: center; font-weight: 700;padding: 8px;border-radius: 5px;border: 2px solid #c45c26;margin-left: 3px; letter-spacing: 2px;'> <?php echo htmlspecialchars($codigoPedido); ?></p></td>
          </tr>
          <?php } ?>

          <?php
          $total = 0;
          $tmpsMail = isset($tmps) && is_array($tmps) ? $tmps : CarritoData::getAllTemporal($session_id);
          if (is_array($tmpsMail)) {
            foreach ($tmpsMail as $p) {
              $prod = method_exists($p, 'getProducto') ? $p->getProducto() : null;
              if (!$prod) {
                continue;
              }
              $precioLinea = isset($prod->precioventa) ? (float) $prod->precioventa : (isset($p->precio) ? (float) $p->precio : 0);
              $cantLinea = isset($p->cantidad) ? (float) $p->cantidad : 0;
              $total += ($precioLinea * $cantLinea);
              ?>
            <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
           <td colspan='2' style='width: 30%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: #547386;color: white;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;'> <?php echo htmlspecialchars($prod->producto); ?></p></td>
           <td colspan='2' style='width: 30%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: white;color: #7d8181;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;border: 1px solid #547386;margin-left: 3px;'> <?php echo number_format($precioLinea, 2, '.', ','); ?></p></td>
            <td colspan='2' style='width: 20%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: white;color: #7d8181;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;border: 1px solid #547386;margin-left: 3px;'> <?php echo $cantLinea; ?></p></td>
             <td colspan='2' style='width: 20%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: white;color: #7d8181;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;border: 1px solid #547386;margin-left: 3px;'> <?php echo number_format($precioLinea * $cantLinea, 2, '.', ','); ?></p></td>
          </tr>
           <?php
            }
          }
          ?>

           <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
           <td colspan='2' style='width: 30%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: #547386;color: white;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;'> TOTAL: </p></td>
           <td colspan='2' style='width: 70%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: white;color: #7d8181;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;border: 1px solid #547386;margin-left: 3px;'> <?php echo number_format($total, 2, '.', ','); ?></p></td>
          </tr>

          <tr>
            <td colspan='4' style='padding:12px;font-size:13px;color:#555;font-family:Verdana, Geneva, sans-serif;'>
              Guarde este código de confirmación. Lo usaremos para identificar su pedido.
            </td>
          </tr>

     </table>


     </td></tr>
    </table>
  </div>

</body></html>
