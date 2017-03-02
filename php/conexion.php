<?php
	// Crea conexion a la BD
	//$link=mysqli_connect('127.0.0.1','root',null,'agenda');
	$servername = "127.0.0.1";
	$username = "root";
	$password = NULL;
	$dbname = "agenda";

	// Create connection
	$link = new mysqli($servername, $username, $password, $dbname);
	//Avisa si hubo error en la conexion y muestra el motivo.
	if ($link->connect_error) {
		die('Error en la conexion. '.$link->connect_error);
	}
	//printf('Servidor informacion: '.$link->server_info);
?>