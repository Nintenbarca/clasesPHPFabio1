<?php

include_once "../../modelo/dbpdo.php";
include_once "../../modelo/usuario.php";
include_once "../../modelo/post.php";

session_start();

if (!isset($_SESSION['errores'])) {
	$_SESSION['errores'] = array();
}

if (isset($_SESSION['user'])) {
	$dbpdo = new DBPDO('post');
	$id = $_GET['id'];
	$post = $dbpdo->getID($id)[0];
	if (!isset($post)) {
		array_push($_SESSION['errores'], 'No existe el post');
		header('Location: ../../paginas/lista.php');
	}else{
		if ($_SESSION['user']->getId() == $post['autor']) {
			$dbpdo->delete(array('id' => $id));
			header('Location: ../../paginas/lista.php');
		}else{
			array_push($_SESSION['errores'], 'El usuario no es el autor de este post');
			header('Location: ../../paginas/lista.php');
		}
	}
}else{
	header('Location: ../../paginas/login.php');
}


?>