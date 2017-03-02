<?php 
	require 'conexion.php';
	$id=$_POST['id'];
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$direccion=$_POST['direccion'];
	$email=$_POST['email'];
	$telefono=$_POST['telefono'];

	$sql= "UPDATE contactos SET nombre='$nombre', apellido='$apellido', direccion='$direccion', email='$email', telefono='$telefono' wHERE id='$id'";

	$resultado = $link->query($sql);

	$id_insert=$id;

	if ($_FILES["archivo"]["error"]>0) {
		echo "Error al cargar archivo";
	}else{
		$permitidos=array("image/gif","image/jpeg","image/png","application/pdf");
		$limite_kb=500;
		if (in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"]<=$limite_kb*1024) {
			$ruta='../files/'.$id_insert.'/';
			$archivo=$ruta.$_FILES["archivo"]["name"];

			if (!file_exists($ruta)) {
				mkdir($ruta);
			}
			if (!file_exists($archivo)) {
				$resultado=@move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
				if ($resultado) {
					echo "Archivo guardado";
				}else{
					echo "error al guardar el archivo";
				}
			}else{
				echo "El archivo ya existe";
			}

		}else{
			echo "Archivo no permitido o excede el tamano";
		}
	}

?>
<html>
	<head>
		<title>Modificar Usuario</title>
		<?php include('../inc/head.php'); ?>
	</head>
	<body>
		<?php if($resultado){ ?>
		<h3>REGISTRO MODIFICADO</h3>
		<?php }else{ ?>
		<h3>Error al modificar</h3>
		<?php } ?>
		<a href="../index.php" class="btn btn-primary">REGRESAR</a>
	</body>
</html>