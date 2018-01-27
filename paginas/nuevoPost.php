<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<h1>Añadir Post</h1>

<?php

include_once "../modelo/dbpdo.php";

session_start();
if (!empty($_SESSION['errores'])) {
	echo "<ul>";
	while (!empty($_SESSION['errores'])) {
		echo "<li>". array_pop($_SESSION['errores']) ."</li>";
	}
	echo "</ul>";
}	
?>

<form action="../acciones/posts/crear.php" method="post">

	<p><label for="titulo">Titulo: </label>
	<input type="text" name="titulo"></p>

	<p><label for="contenido">Contenido: </label>
	<textarea name="contenido"></textarea></p>

	<p><label for="categoria">Categoria: </label>
	<select name="categoria">
		<?php
		$dbpdo = new DBPDO('categoria');
		$categorias = $dbpdo->all(1000);

		foreach ($categorias as $categoria) {
			echo '<option value ="'.$categoria['id'].'">'. $categoria['nombre'] .'</option>';
		}
	
		?>
	</select></p>

	<p><input type="submit" value="Enviar"></p>
	
</form>

</body>
</html>