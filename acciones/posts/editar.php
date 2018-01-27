<?php

include_once "../../modelo/dbpdo.php";
include_once "../../modelo/post.php";
include_once "../../modelo/usuario.php";
session_start();

if (!isset($_SESSION['errores'])) {
	$_SESSION['errores'] = array();
}

if (isset($_SESSION['user'])) {	
	$titulo = $_POST['titulo'];
	$contenido = $_POST['contenido'];
	$categoria = $_POST['categoria'];
	$dbpdoPost = new DBPDO('post');
	$post = $dbpdoPost->getID($_POST['id'])[0];

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

	if ($_SESSION['user']->getId() == $post['autor']) {
		if (empty($_SESSION['errores'])) {
			$dbpdoPost->update(array('titulo' => $titulo, 'contenido' => $contenido, 
				'categoria' => $categoria) , array('id' => $post['id']));
			header('Location: ../../paginas/lista.php');
		}else{
			header('Location: ../../paginas/editar.php?id='.$_POST['id']);
		}			
	}	
}