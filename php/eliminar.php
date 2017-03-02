
<?php 
	require 'conexion.php';
	$id=$_GET['id'];

	$sql= "DELETE FROM contactos wHERE id='$id'";

	$resultado = $link->query($sql);
	eliminarDir('../files/'.$id);

	function eliminarDir($carpeta){
		foreach (glob($carpeta."/*") as $archivos_carpeta) {
			if (is_dir($archivos_carpeta)) {
				eliminarDir($archivos_carpeta);
			}else{
				unlink($archivos_carpeta);
			}
		}
		rmdir($carpeta);
	}

?>
<html>
	<head>
		<title>Modificar Usuario</title>
		<?php include('../inc/head.php'); ?>
	</head>
	<body>
		<?php if($resultado){ ?>
		<h3>REGISTRO ELIMINADO</h3>
		<?php }else{ ?>
		<h3>Error al eliminar</h3>
		<?php } ?>
		<a href="../index.php" class="btn btn-primary">REGRESAR</a>
	</body>
</html>