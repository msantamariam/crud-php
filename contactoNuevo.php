<!DOCTYPE html>
<html>
<head>
	<title>Agregar Usuario</title>
	<?php include('inc/head.php'); ?>
</head>
<body>
	<?php include('inc/menu.php'); ?>
	<div class="container">
		<div class="row">
			<h4 >Agregar</h4>
		</div>
		<div class="row">
			<form class="form-horizontal" role="form" method="POST" action="php/agregar.php" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="nombre">Nombre:</label>
					<div class="col-sm-10">
						<input class="form-control" type="text"  name="nombre" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="apellido">Apellido:</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="apellido" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="direccion">Direccion:</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="direccion" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="email">Email:</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="email" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="telefono">Telefono:</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="telefono" >
					</div>
				</div>
				<div class="form-group">
					<label for="archivo" class="col-sm-2 control-label">Archivo</label>
					<div class="col-sm-10">
						<input type="file" class="form-control" id="archivo" name="archivo">
					</div>
				</div>
				<button type="submit" class="btn btn-default">Agregar</button>
			</form>				
		</div>				
	</div>
</body>
</html>