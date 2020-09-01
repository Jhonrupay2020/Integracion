<?php

session_start();

header('Content-type: application/json');

include('../config/db.php');
include('../config/conexion.php');
include('../funciones.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
redirectIfIsNotAdmin();

$idCliente = $_POST['id_cliente'];
$idVendedor = $_POST['id_vendedor'];
$condiciones = $_POST['condiciones'];
$sessionId = session_id();

$response = $mysqli->query("SELECT * FROM tmp WHERE session_id = '$sessionId'");

$productos = [];
$totalVenta = 0;

if($response && $response->num_rows) {
    while ($producto = $response->fetch_assoc()) {
        $productos[] = $producto;
        $totalVenta += $producto['precio_tmp'] ?? 0;
    }
}

$response = $mysqli->query("select LAST_INSERT_ID(numero_factura) as last from facturas order by id_factura desc limit 1");
$numeroFactura = 1;
if ($response && $response->num_rows) {
    $numeroFactura = $response->fetch_assoc();
    $numeroFactura = $numeroFactura['last'] + 1;
}

$fechaFactura = date('Y-m-d H:i:s');

try {
    $response = $mysqli->query("INSERT INTO facturas(numero_factura, fecha_factura, id_cliente, id_vendedor, condiciones, total_venta, estado_factura) 
    VALUES($numeroFactura, '$fechaFactura', $idCliente, $idVendedor, '$condiciones',' $totalVenta', 1)");

    if (!$response || !$mysqli->affected_rows) throw new \Exception("Error al registrar los datos");

    $idFactura = $mysqli->insert_id;

    try {
        foreach ($productos as $producto) {
            $idProducto = $producto['id_producto'];
            $cantidad = $producto['cantidad_tmp'];
            $precioVenta = $producto['precio_tmp'];
        
            $response = $mysqli->query("INSERT INTO detalle_factura(numero_factura, id_producto, cantidad, precio_venta) 
            VALUES($numeroFactura, $idProducto, $cantidad, $precioVenta)");
        
            if (!$response || !$mysqli->affected_rows) {
                break;
                throw new \Exception("Error al registrar los datos");
            }
        }

        $mysqli->query("DELETE FROM tmp WHERE session_id = '$sessionId'");
        
        echo json_encode(['status' => 'success', 'message' => 'Factura registrada correctamente.', 'content' => $idFactura]);
    
    } catch (\Exception $e) {
    
        $mysqli->query("DELETE FROM facturas WHERE numero_factura = $numeroFactura");
        $mysqli->query("DELETE FROM detalle_factura WHERE numero_factura = $numeroFactura");
        throw new \Exception("Error al registrar el detalle de la factura");
    }
} catch (\Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al registrar los datos.']);
    exit;
}





