<?php

session_start();
header('Content-type: application/json');

include('../config/db.php');
include('../config/conexion.php');
include('../funciones.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
require_once("../libraries/password_compatibility_library.php");

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$passwordConfirmation = $_POST['passwordConfirmation'];

$response = $mysqli->query("SELECT user_id FROM users WHERE user_name = '$usuario' OR user_email = '$email' LIMIT 1");

if($response && $response->num_rows) {

    $usuario = $response->fetch_assoc();
    $message = '';

    if ($usuario['user_email'] == $email) $message .= 'E-mail ya registrado';
    if ($usuario['user_name'] == $email) $message .= 'Nombre de usuario ya registrado';

    echo json_encode(['status' => 'error', 'message' => 'Error al registrar los datos. ' . $message]);
    exit;
}

$password = password_hash($password, PASSWORD_DEFAULT);

try {
    $response = $mysqli->query("INSERT INTO users(firstname, lastname, user_name, user_password_hash, user_email, rolId) 
    VALUES('$nombres', '$apellidos', '$usuario', '$password', '$email', 1)");

    if (!$response || !$mysqli->affected_rows) throw new \Exception("Error al insertar los datos");

    echo json_encode(['status' => 'success', 'message' => 'Registro completado satisfactoriamente, por favor inicia sesión.']);

} catch (\Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al registrar los datos (este? xd).', 'content' => $e->getMessage()]);
    exit;
}





