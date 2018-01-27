<?php

include_once "../../modelo/dbpdo.php";
include_once "../../modelo/usuario.php";
include_once "../../modelo/post.php";

session_start();

if (!isset($_SESSION['errores'])) {
	$_SESSION['errores'] = array();
}

if (isset($_SESSION['user'])) {
	$titulo = $_POST['titulo'];
	$fecha = time() + 3600;
	$autor = $_SESSION['user']->getId();	
	$contenido = $_POST['contenido'];
	$categoria = $_POST['categoria'];

	if (empty($titulo)) {
		array_push($_SESSION['errores'], 'No he recibido el titulo');
	}elseif (strlen($titulo) < 3) {
		array_push($_SESSION['errores'], 'El titulo debe tener al menos 3 caracteres');
	}

	if (empty($contenido)) {
		array_push($_SESSION['errores'], 'No he recibido el contenido');
	}elseif (strlen($contenido) > 200) {
		array_push($_SESSION['errores'], 'El contenido no puede superar los 200 
			caracteres');
	}

	if (empty($categoria)) {
		array_push($_SESSION['errores'], 'No he recibido la categoria');
	}else{
		$dbpdo = new DBPDO('categoria');
		$c = $dbpdo->getID($categoria);
		if (!isset($c)) {
			array_push($_SESSION['errores'], 'La categoria no existe');
		}
	}

	if (empty($_SESSION['errores'])) {
		$dbpdo = new DBPDO('post');		
		$id = $dbpdo->insert(array('titulo' => $titulo, 'fecha' => $fecha, 
			'autor' => $autor, 'contenido' => $contenido, 'categoria' => $categoria));
		 
		$post = new Post($id, $titulo, $fecha, $autor, $contenido, $categoria);
		header('Location: ../../paginas/lista.php');
	}else{
		header('Location: ../../paginas/nuevoPost.php');
	}
}else{
	header('Location: ../../paginas/login.php');
}






