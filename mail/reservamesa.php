<!DOCTYPE html>
<?php
$full_name = isset($reserva_email['nombre'])
    ? strip_tags($reserva_email['nombre'])
    : (isset($cliente->nomcliente) ? strip_tags($cliente->nomcliente) : '');
$email = isset($reserva_email['email'])
    ? strip_tags($reserva_email['email'])
    : (isset($cliente->emailcliente) ? strip_tags($cliente->emailcliente) : '');
$tel = isset($reserva_email['telefono'])
    ? $reserva_email['telefono']
    : (isset($telefono) ? $telefono : (isset($_POST['telefono']) ? $_POST['telefono'] : ''));
$cant = isset($reserva_email['cantidad'])
    ? $reserva_email['cantidad']
    : (isset($_POST['cantidad']) ? $_POST['cantidad'] : '');
$fechaTxt = isset($reserva_email['fecha'])
    ? ($reserva_email['fecha'] . ' ' . (isset($reserva_email['hora']) ? $reserva_email['hora'] : ''))
    : ((isset($_POST['fecha']) ? $_POST['fecha'] : '') . ' ' . (isset($_POST['hora']) ? $_POST['hora'] : ''));
$msgTxt = isset($reserva_email['mensaje'])
    ? $reserva_email['mensaje']
    : (isset($_POST['mensaje']) ? $_POST['mensaje'] : '');
?>
<html lang="es">
    <head>
        <title>Reservas</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
   <div style="border: 1px solid #6c91b2;border-radius: 10px; padding: 10px;">


     <table width='100%' bgcolor='white' cellpadding='0' cellspacing='0' border='0'>

     <tr><td>

     <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:white; font-family:Verdana, Geneva, sans-serif;'>


        <tr height='80'>
         <th colspan='4' style='background-color:white; border-bottom:solid 0px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >
         <h4>RESTAURANTE EL RINCON SUIZO</h4>


          <p style='font-size: 16px;font-family: Verdana, Geneva, sans-serif;background-color: #333f50;color: white;text-align: center; font-weight: 200;padding: 15px;border-radius: 10px;'> <?php echo htmlspecialchars($full_name); ?></p>
         </th>
        </tr>



           <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
           <td colspan='2' style='width: 40%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: #547386;color: white;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;'> CORREO: </p></td>
           <td  colspan='2' style='width: 60%' ><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: white;color: #7d8181;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;border: 1px solid #547386;margin-left: 3px;'> <?php echo htmlspecialchars($email); ?></p></td>
          </tr>
           <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
           <td colspan='2' style='width: 40%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: #547386;color: white;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;'> TELÉFONO: </p></td>
           <td  colspan='2' style='width: 60%' ><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: white;color: #7d8181;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;border: 1px solid #547386;margin-left: 3px;'> <?php echo htmlspecialchars($tel); ?></p></td>
          </tr>
          <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
           <td colspan='2' style='width: 40%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: #547386;color: white;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;'> CANTIDAD DE PERSONAS: </p></td>
           <td  colspan='2' style='width: 60%' ><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: white;color: #7d8181;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;border: 1px solid #547386;margin-left: 3px;'> <?php echo htmlspecialchars((string) $cant); ?></p></td>
          </tr>
          <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
           <td colspan='2' style='width: 40%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: #547386;color: white;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;'> FECHA Y HORA DE LLEGADA: </p></td>
           <td  colspan='2' style='width: 60%' ><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: white;color: #7d8181;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;border: 1px solid #547386;margin-left: 3px;'> <?php echo htmlspecialchars(trim($fechaTxt)); ?></p></td>
          </tr>
          <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
           <td colspan='2' style='width: 40%'><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: #547386;color: white;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;'> MENSAJE ADICIONAL: </p></td>
           <td  colspan='2' style='width: 60%' ><p style='font-size: 14px;font-family: Verdana, Geneva, sans-serif;background-color: white;color: #7d8181;text-align: center; font-weight: 200;padding: 5px;border-radius: 5px;border: 1px solid #547386;margin-left: 3px;'> <?php echo htmlspecialchars($msgTxt); ?></p></td>
          </tr>



     </table>


     </td></tr>
    </table>
  </div>

</body></html>
