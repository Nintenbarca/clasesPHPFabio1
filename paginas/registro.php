<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<h1>Registro</h1>

<?php
session_start();
	<input type="text" name="nombre"></p>

	<p><label for="apellidos">Apellidos: </label>
	<input type="text" name="apellidos"></p>

	<p><label for="email">Email: </label>
	<input type="email" name="email"></p>

	<p><label for="nick">Nick: </label>
	<input type="text" name="nick"></p>

	<p><label for="pass">Contraseña: </label>
	<input type="password" name="pass"></p>

	<p><label for="pass2">Repetir Contraseña: </label>
	<input type="password" name="pass2"></p>

	<p><input type="submit" value="Enviar"></p>
</form>

</body>
</html>