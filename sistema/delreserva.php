    
<?php
include "../db/core/autoload.php";
include "../db/core/app/model/ReservaData.php";


if (isset($_GET['id']))
{
	$del = ReservaData::getById($_GET["id"]);
	$del->del();
} 


print "<script>window.location='reservaweb.php';</script>";
?>
			
           