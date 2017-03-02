<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Agenda CRUD</title>
		<?php include('inc/head.php');
		// Crea conexion a la BD
		include('php/conexion.php');
		 ?>
	</head>
	<body>
		<?php include('inc/menu.php'); ?>
			<?php include('php/tabla.php'); ?>
		<a href="contactoNuevo.php" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></a>
		<a href="#agregar" class="btn btn-default">Agregar</a>
		
		<div class="modal fade" id="agregar" tabindex="-1" role="dialog">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Agregar</h4>
				</div>
				<div class="modal-body">
					<form role="form" method="post" action="php/agregar.php">
						<div class="form-group">
							<label for="nombre">Nombre:</label>
							<input type="text" class="form-control" name="nombre" required>
						</div>
						<div class="form-group">
							<label for="apellido">Apellido:</label>
							<input type="text" class="form-control" name="apellido" required>
						</div>
						<div class="form-group">
							<label for="direccion">Direccion:</label>
							<input type="text" class="form-control" name="direccion" required>
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="text" class="form-control" name="email" required>
						</div>
						<div class="form-group">
							<label for="telefono">Telefono:</label>
							<input type="text" class="form-control" name="telefono" required>
						</div>
					</form>				
				</div>				
			</div>			
			</div>
		</div>

	</body>
</html>