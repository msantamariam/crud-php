<?php 
require 'php/conexion.php';
$id=$_GET['id'];
$sql="SELECT * FROM contactos WHERE id='$id'";
$resultado = $link->query($sql);
$fila = $resultado->fetch_array(MYSQL_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar Usuario</title>
	<?php include('inc/head.php'); ?>
	<script>
		$(document).ready(function(){
			$('.delete').click(function(){
				var parent = $(this).parent().attr('id');
				var service = $(this).parent().attr('data');
				var dataString='id='+service;

				$.ajax({
					type: "POST",
					url: "del_file.php",
					data: dataString,
					success: function(){
						location.reload();
					}
				});
			});
		});
	</script>
</head>
<body>
	<?php include('inc/menu.php'); ?>
	<div class="container">
		<div class="row">
			<h4>Modificar registro</h4>
		</div>
		<div class="row">
			<form class="form-horizontal" role="form" method="POST" action="php/actualizar.php" enctype="multipart/form-data">
				<input type="hidden" id="id" name="id" value="<?php echo $fila['id']; ?>">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="nombre">Nombre:</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="nombre" value="<?php echo $fila['nombre'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="apellido">Apellido:</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="apellido" value="<?php echo $fila['apellido'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="direccion">Direccion:</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="direccion" value="<?php echo $fila['direccion'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="email">Email:</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="email" value="<?php echo $fila['email'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="telefono">Telefono:</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="telefono" value="<?php echo $fila['telefono'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="archivo" class="col-sm-2 control-label">Archivo</label>
					<div class="col-sm-10">
						<input type="file" class="form-control" id="archivo" name="archivo">
						<?php 
							$path="files/".$id;
							if (file_exists($path)) {
								$directorio=opendir($path);
								while ($archivo=readdir($directorio)) {
									if (!is_dir($archivo)) {
										echo "<div data='".$path."/".$archivo."'><a href='".$path."/".$archivo."' title='Ver archivo adjunto'><span class='glyphicon glyphicon-picture'></span></a>";
										echo "$archivo <a href='#' class='delete' title='Ver archivo adjunto'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></div> ";
										echo "<img src='files/$id/$archivo' width='300' />";
									}
								}
							}
						?>
					</div>
				</div>
				<button type="submit" class="btn btn-default">Modificar</button>
			</form>				
		</div>				
	</div>
</body>
</html>