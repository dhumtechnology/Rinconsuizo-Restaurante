<?php
require_once("class/class.php");
?>
<script type="text/javascript" src="assets/script/script2.js"></script>
<script src="assets/script/jscalendario.js"></script>
<script src="assets/script/autocompleto.js"></script> 
<!-- Calendario -->

<?php
$tra = new Login();
?>

<?php 
######################### MUESTRA TIPO DE ENTRADA PARA COMPRAS ###########################
if (isset($_GET['MuestraTipoEntrada']) && isset($_GET['tipoentrada'])) { 
  
$tra = new Login();

 if($_GET['tipoentrada']==""){ ?>
 
 <select name="codcategoria" id="codcategoria" class="form-control">
          <option value="">SELECCIONE</option>
</select>
 
 <?php } elseif($_GET['tipoentrada']=="PRODUCTO"){  ?>
 
    <select name="codcategoria" id="codcategoria" class="form-control">
                        <option value="">SELECCIONE</option>
      <?php
      $cat = new Login();
      $cat = $cat->ListarCategorias();
      for($i=0;$i<sizeof($cat);$i++){
                  ?>
<option value="<?php echo $cat[$i]['codcategoria'] ?>"><?php echo $cat[$i]['nomcategoria'] ?></option>        
                      <?php } ?>
                  </select>
          
 <?php } else if($_GET['tipoentrada']=="INGREDIENTE"){  ?>
 
<select name="codcategoria" id="codcategoria" class='form-control'>
            <option value="">SELECCIONE</option>
          <option value="KG">KG</option>
          <option value="LT">LT</option>
          <option value="UNID.">UNIDAD</option>
    </select>
 
<?php  }
  }
######################### MUESTRA TIPO DE ENTRADA PARA COMPRAS ###########################
?>