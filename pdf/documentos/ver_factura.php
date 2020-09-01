<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
    }
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	//Archivo de funciones PHP
	include("../../funciones.php");
	$id_factura= intval($_GET['id_factura']);

	$sql = "SELECT f.numero_factura, f.fecha_factura, f.condiciones, f.total_venta, c.nombre_cliente, c.email_cliente, c.direccion_cliente, c.telefono_cliente
	FROM `facturas` f
	INNER JOIN clientes c
	ON f.id_cliente = c.id_cliente
	WHERE f.id_factura = $id_factura";

	if (!$resultado = $mysqli->query($sql)) {
		header("location: /");
		exit;
	}

	$factura = $resultado->fetch_assoc();

	$resultado = $mysqli->query("SELECT df.precio_venta, p.nombre_producto, df.cantidad, 
	(df.precio_venta * (select impuesto from perfil where id_perfil = 1) / 100) as igv, f.total_venta 
	FROM `detalle_factura` df 
	INNER JOIN facturas f on df.numero_factura = f.numero_factura 
	INNER JOIN products p on df.id_producto = p.id_producto
	WHERE f.id_factura = {$id_factura}");

	$productos = [];

	while ($producto = $resultado->fetch_assoc()) {
		$productos[] = $producto;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Factura</title>
		<style>
			#factura {
				padding: 20px;
				font-family: Arial, sans-serif;
				font-size: 16px ;
			}

			#logo {
				float: left;
				margin-left: 2%;
				margin-right: 2%;
			}
			#imagen {
				width: 100px;
			}

			#fact {
				font-size: 18px;
				font-weight: bold;
				text-align: center;
			}   

			#datos {
				float: left;
				margin-top: 0%;
				margin-left: 2%;
				margin-right: 2%;
				/*text-align: justify;*/
			}

			#encabezado {
				text-align: center;
				margin-left: 10px;
				margin-right: 10px;
				font-size: 16px;
			}

			section {
				clear: left;
			}

			#cliente {
				text-align: left;
			}

			#facliente {
				width: 40%;
				border-collapse: collapse;
				border-spacing: 0;
				margin-bottom: 15px;
			}

			#fa {
				color: #FFFFFF;
				font-size: 14px;
			}

			#facarticulo {
				width: 100%;
				border-collapse: collapse;
				border-spacing: 0;
				padding: 20px;
				margin-bottom: 15px;
			}

			#facarticulo thead {
				padding: 20px;
				background: #2183E3;
				text-align: center;
				border-bottom: 1px solid #FFFFFF;
			}

			#gracias {
				text-align: center;
			}

			tr.producto td {
				text-align: center;
				vertical-align: center;
			}
		</style>
	</head>
	<body id="factura">
        <header>
            <div id="logo">
                <img src="/img/logo2.png" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>REDCOVERY</b><br>Jr. Santa Cruz 56, Bella Durmiente - Tingo Maria, Perú<br>Telefono:(+51)962802315<br>Email:Redcovery@hotmail.com
                </p>
            </div>
            <div id="fact">
                <p>Factura<br>
				<?= str_pad($factura['numero_factura'], 4, "0", STR_PAD_LEFT)
					. '-'
					.str_pad($factura['numero_factura'], 4, "0", STR_PAD_LEFT) ?>
				<br>
                <?= $factura['fecha_factura'] ?></p>
            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="facliente">
                    <tbody>
                        <tr>
                            <td id="cliente">
                                 
                                <strong>Sr(a). <?= $factura['nombre_cliente'] ?></strong><br>
                                <!-- <strong>Documento:</strong> 47805181<br> -->
                                <strong>Dirección:</strong> <?= $factura['direccion_cliente'] ?><br>
                                <strong>Teléfono:</strong> <?= $factura['telefono_cliente'] ?><br>
                                <strong>Email:</strong> <?= $factura['email_cliente'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">
                            <th>CANT</th>
                            <th>DESCRIPCION</th>
                            <th>PRECIO UNIT</th>
                            <th>IGV.</th>
                            <th>PRECIO TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach($productos as $item) : ?>
                        <tr class="producto">
                            <td>
								<?= $item['cantidad'] ?>
							</td>
                            <td><?= $item['nombre_producto'] ?></td>
                            <td>
								<?= $item['precio_venta'] ?>
							</td>
                            <td>
								<?= $item['igv'] ?>
							</td>
                            <td>
								<?= $item['total_venta'] ?>
							</td>
                        </tr>
						<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            <div id="gracias">
                <p><b>Gracias por su compra!</b></p>
            </div>
        </footer>
    </body>
</html>
<!-- $sql_factura=mysqli_query($con,"select * from facturas where id_factura='".$id_factura."'");
$rw_factura=mysqli_fetch_array($sql_factura);

echo "<pre>";
var_dump($rw_factura);
echo "</pre>";
exit;

$numero_factura=$rw_factura['numero_factura'];
$id_cliente=$rw_factura['id_cliente'];
$id_vendedor=$rw_factura['id_vendedor'];
$fecha_factura=$rw_factura['fecha_factura'];
$condiciones=$rw_factura['condiciones'];
$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1); -->
