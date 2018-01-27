<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<h1>Bienvenido</h1>

<?php

session_start();

if (isset($_SESSION['user'])) {
	echo '<p><a href="lista.php">Posts</a></p>';
	echo '<p><a href="../acciones/usuarios/logout.php">Cerrar Sesion</a></p>';
}else{
	echo '<p><a href="registro.php">Registrar</a></p>';
	echo '<p><a href="login.php">Login</a></p>';
	echo '<p><a href="lista.php">Posts</a></p>';
}

?>

</body>
</html>