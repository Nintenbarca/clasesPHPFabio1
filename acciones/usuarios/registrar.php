<?php

include_once "../../modelo/dbpdo.php";
include_once "../../modelo/usuario.php";


$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$nick = $_POST['nick'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];

$u = ((new DBPDO('usuario'))->select(array('email'=> $email)));

session_start();

if (!isset($_SESSION['errores'])) {
	$_SESSION['errores'] = array();
}

if (empty($nombre)) {
	array_push($_SESSION['errores'], 'No he recibido el nombre');
}elseif (strlen($nombre) < 3) {
	array_push($_SESSION['errores'], 'El nombre debe tener al menos 3 caracteres');
}

if (empty($apellidos)) {
	array_push($_SESSION['errores'], 'No he recibido el apellido');
}elseif (strlen($apellidos) < 3) {
	array_push($_SESSION['errores'], 'El apellido debe tener al menos 3 caracteres');
}

if (empty($email)) {
	array_push($_SESSION['errores'], 'No he recibido el email');
}elseif (strlen($email) < 3) {
	array_push($_SESSION['errores'], 'El email debe tener al menos 3 caracteres');
}

if (empty($nick)) {
	array_push($_SESSION['errores'], 'No he recibido el nick');
}elseif (strlen($nick) < 3) {
	array_push($_SESSION['errores'], 'El nick debe tener al menos 3 caracteres');
}

if (empty($pass)) {
	array_push($_SESSION['errores'], 'No he recibido la contraseña');
}elseif (strlen($pass) < 6) {
	array_push($_SESSION['errores'], 'La contraseña debe tener al menos 6 caracteres');
}
if (empty($pass2)) {
	array_push($_SESSION['errores'], 'No he recibido la segunda contraseña');
}

if ($pass != $pass2) {
	array_push($_SESSION['errores'], 'Las contraseñas deben ser iguales');
}else{/*
	$matches = array();
	preg_match('/[A-Z]/', $pass, $matches, PREG_OFFSET_CAPTURE);
	if (array_count_values($matches)<1) {
		array_push($_SESSION['errores'], 'La contraseña debe tener al menos 1 mayuscula');
	}
	preg_match('/[a-z]/', $pass, $matches, PREG_OFFSET_CAPTURE);
	if (array_count_values($matches)<1) {
		array_push($_SESSION['errores'], 'La contraseña debe tener al menos 1 minuscula');
	}
	preg_match('/[0-9]/', $pass, $matches, PREG_OFFSET_CAPTURE);
	if (array_count_values($matches)<1) {
		array_push($_SESSION['errores'], 'La contraseña debe tener al menos 1 numero');
	}*/
}

if (count($u)>0) {
	array_push($_SESSION["errores"], "Ya existe un usuario con este email");
}

if (empty($_SESSION['errores'])) {
	$dbpdo = new DBPDO('usuario');
	$id = $dbpdo->insert(array('nombre' =>  $nombre, 'apellidos' => $apellidos, 'email' =>  $email,
		'nick' =>  $nick, 'md5pass' =>  md5($pass)));
	$usuario = new Usuario($id, $nombre, $apellidos, $email, $nick, md5($pass));
	header('Location: ../../paginas/index.php');
}else{
	header('Location: ../../paginas/registro.php');
}
