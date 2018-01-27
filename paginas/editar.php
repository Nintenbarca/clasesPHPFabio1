<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<h1>Editar Post</h1>

<?php
include_once "../modelo/dbpdo.php";
include_once "../modelo/post.php";
include_once "../modelo/usuario.php";
session_start();

if (isset($_SESSION['user'])) {
	if(isset($_GET['id'])){
		$dbpdoPosts = new DBPDO('post');
		$post = $dbpdoPosts->getID($_GET['id']);
		if(count($post) != 0){
			$post = $post[0];
			if ($_SESSION['user']->getId() == $post['autor']) {
				$dbpdoCat = new DBPDO('categoria');
				$dbpdoCat->modeDEV = false;
				$categorias = ($dbpdoCat->all(100));
				if (!empty($_SESSION['errores'])) {
					echo "<ul>";
					while (!empty($_SESSION['errores'])) {
						echo "<li>". array_pop($_SESSION['errores']) ."</li>";
					}
					echo "</ul>";
				}?>
				<form action="../acciones/posts/editar.php" method="post">

					<input type="hidden" name="id" value="<?php echo $post['id'];?>">

					<p><label for="titulo">Titulo: </label>
					<input type="text" name="titulo" value="<?php echo $post['titulo'];?>"></p>

					<p><label for="contenido">Contenido: </label>
					<textarea name="contenido" value="<?php echo $post['contenido'];?>">
					<?php echo $post['contenido']; ?></textarea></p>

					<p><label for="categoria">Categoria: </label>
					<select name="categoria">
					<?php
					foreach ($categorias as $categoria) {
					
						echo '<option value="'.$categoria['id'].'"';
						if($categoria['id'] == $post['categoria']){
							echo ' selected';
						}
						echo '>';
						echo $categoria['nombre'];
						echo '</option>';
					}
					?>
					</select></p>

					<p><input type="submit" value="Guardar"></p>
				</form>

			<?php
			}

		}
	}
}

?>



</body>
</html>