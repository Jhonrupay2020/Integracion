	<?php
		if (isset($title))
		{
	?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">RedCovery</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php echo $active_productos;?>"><a href="productos.php"><i class='glyphicon glyphicon-barcode'></i> Productos</a></li>
        <?php if ($_SESSION['rolId'] == 2) : ?>
            <li class="<?php echo $active_facturas;?>"><a href="facturas.php"><i class='glyphicon glyphicon-list-alt'></i> Facturas <span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $active_clientes;?>"><a href="clientes.php"><i class='glyphicon glyphicon-user'></i> Clientes</a></li>
            <li class="<?php echo $active_usuarios;?>">
              <a href="usuarios.php"><i  class='glyphicon glyphicon-lock'></i> Usuarios</a>
            </li>
		        <li class="<?php if(isset($active_perfil)){echo $active_perfil;}?>"><a href="perfil.php"><i  class='glyphicon glyphicon-cog'></i> Configuración</a></li>
        <?php endif; ?>

       </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="https://www.facebook.com/REDcoveryOficial/" target='_blank'><i class='glyphicon  glyphicon-envelope'></i> Soporte</a></li>
		    <li>
            <form action="logout.php" method="post" id="frmLogout" style="display:none;">
            </form>
            <a href="#" onclick="document.getElementById('frmLogout').submit()">Salir</a>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<?php
		}
	?>