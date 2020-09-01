<?php
session_start();

include('funciones.php');
redirectIfIsNotAuthenticated();

$active_facturas="active";
$active_productos="";
$active_clientes="";
$active_usuarios="";	
$title="Facturas | RedCovery";

?>
<!DOCTYPE html>
<html lang="es">
  <head>
	<?php include("head.php");?>
  </head>
  <body>
	<?php
	    include("navbar.php");
	?>  
    
    <div class="container">
        <div class="jumbotron">
          <h1 class="text-center">Hola ! Bienvenido a RedCovery 😃</h1>
        </div>
    </div>

	<?php
	include("footer.php");
	?>
  </body>
</html>