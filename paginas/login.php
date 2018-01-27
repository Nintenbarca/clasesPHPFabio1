<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<h1>Login</h1>

<?php
session_start();

if (!empty($_SESSION['errores'])) {
	echo "<ul>";
	while (!empty($_SESSION['errores'])) {
		echo "<li>". array_pop($_SESSION['errores']) ."</li>";
	}
	echo "</ul>";
}	
?>

<form action="../acciones/usuarios/login.php" method="POST">

	<p><label for="email">Email: </label>
	<input type="email" name="email"></p>

	<p><label for="pass">Contraseña: </label>
	<input type="password" name="pass"></p>

	<p><input type="submit" value="Enviar"></p>

</form>

</body>
</html>