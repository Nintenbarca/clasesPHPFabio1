<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
include_once "../modelo/dbpdo.php";
include_once "../modelo/post.php";
include_once "../modelo/usuario.php";
session_start();
$dbpdoPosts = new DBPDO('post');
$dbpdoPosts->modeDEV = false;
$posts = $dbpdoPosts->all(1000);
?>

<h1>Posts</h1><br>
<?php

foreach ($posts as $post) {
	$dbpdoUsers = new DBPDO('usuario');
	$usuario = ($dbpdoUsers->getID($post['autor']))[0];

	$dbpdoCat = new DBPDO('categoria');
	$categoria = ($dbpdoCat->getID($post['categoria']))[0];

	echo "<h2>Titulo: ". $post['titulo'] ."</h2>";
	echo "<h3>Autor: ". $usuario['nick'] ."</h3>";
	echo "<p>". $post['contenido'] ."</p>";
	echo "<p>Categoria: ". $categoria['nombre'] ."</p>";

	if (isset($_SESSION['user']) && ($_SESSION['user']->getId() == $post['autor'])) {
		echo "<p><a href='editar.php?id=".$post['id']."'>Editar</a></p>";
		echo "<p><a href='../acciones/posts/borrar.php?id=".$post['id']."'>Borrar</a></p>
		<br>";
	}
}

if (isset($_SESSION['user'])) {
	echo "<p><a href='nuevoPost.php'>Crear Post</a></p>";
}
?>


</body>
</html>