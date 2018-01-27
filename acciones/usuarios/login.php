<?php

include_once "../../modelo/dbpdo.php";
include_once "../../modelo/usuario.php";

session_start();

if (!isset($_SESSION['errores'])) {
	$_SESSION['errores'] = array();
}

$email = $_POST['email'];
$pass = $_POST['pass'];

$dbpdo = new DBPDO('usuario');
$u = $dbpdo->select(array('email' => $email));

if ($u == NULL) {
	array_push($_SESSION['errores'], 'No existe el usuario');
}else{
	$u=$u[0];	
	$id = $u['id'];
	$nombre = $u['nombre'];
	$apellidos = $u['apellidos'];
	$email = $u['email'];
	$nick = $u['nick'];
	$md5pass = $u['md5pass'];
	$u = new Usuario($id, $nombre, $apellidos, $email, $nick, $md5pass);
	if ($u->auth($pass)) {
		$_SESSION['user'] = $u;
		header('Location: ../../paginas/index.php');
	}else{
		array_push($_SESSION["errores"], "Usuario/contraseña incorrecto(s)");
		header('Location: ../../paginas/login.php');
	}		
}

