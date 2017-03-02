
<?php 
	require 'conexion.php';
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$direccion=$_POST['direccion'];
	$email=$_POST['email'];
	$telefono=$_POST['telefono'];

	$sql= "INSERT INTO contactos(nombre,apellido,direccion,email,telefono) 
	VALUE('$nombre','$apellido','$direccion','$email','$telefono')";

	$resultado = $link->query($sql);
	$id_insert=$link->insert_id;

	if ($_FILES["archivo"]["error"]>0) {
		echo "Error al cargar archivo";
	}else{
		$permitidos=array("image/gif","image/png","image/jpeg","application/pdf");
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
		
	</head>
	<body>
		<?php if($resultado){ ?>
		<h3>REGISTRO GUARDADO</h3>
		<?php }else{ ?>
		<h3>Error al guardar</h3>
		<?php } ?>
		<a href="../index.php" class="btn btn-primary">REGRESAR</a>
	</body>
</html>