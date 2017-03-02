<?php session_start(); 
require 'php/conexion.php';
$where = "";

if (!empty($_POST)) {
	$valor=$_POST['campo'];
	if (!empty($valor)) {
		$where= "WHERE nombre LIKE '$valor%'";
	}
}

$sql="SELECT * FROM contactos $where";
$resultado=$link->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Agenda</title>
	<?php include('inc/head.php'); ?>
	<script>
		$(document).ready(function(){
			$('#miTabla').DataTable({
				"order":[[0,"asc"]],
				"language":{
					"lengthMenu": "Mostrar _MENU_ registros por pagina",
					"info":"Mostrando pagina _PAGE_ de _PAGES_",
					"infoEmpty":"No hay registros disponibles",
					"infoFiltered":"(filtrada de _MAX_ registros)",
					"loadingRecords":"Cargando...",
					"processing":"Procesando...",
					"search":"Buscar",
					"zeroRecords":"No se encuentran registros coincidentes",
					"paginate":{
						"previous":"Anterior",
						"next":"Siguiente"
					},
				},
			});
		});
	</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<h2 style="text-align: center;">
				Agenda
			</h2>
		</div>
		<div class="row">
			<a href="contactoNuevo.php" class="btn btn-primary">Agregar</a>
			<!-- <form action="<?php //$_SERVER['PHP_SELF']; ?>" method="POST">
				<b>Nombre: </b><input type="text" id="campo" name="campo">
				<input type="submit" id="enviar" name="enviar" value="BUSCAR" class="btn btn-info">
			</form> -->
		</div>
		<br>
		<div class="row table-responsive">
			<table class="display" id="miTabla">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Direccion</th>
						<th>Email</th>
						<th>Telefono</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php while($fila = $resultado->fetch_array(MYSQL_ASSOC)){ ?>
					<tr>
						<td><?php echo $fila['id']; ?></td>
						<td><?php echo $fila['nombre']; ?></td>
						<td><?php echo $fila['apellido']; ?></td>
						<td><?php echo $fila['direccion']; ?></td>
						<td><?php echo $fila['email']; ?></td>
						<td><?php echo $fila['telefono']; ?></td>
						<td><a href="modificar.php?id=<?php echo $fila['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
						<td>
						<a href="#" data-href="php/eliminar.php?id=<?php echo $fila['id']; ?>" data-toggle="modal" data-target="#confirm-delete">
						<span class="glyphicon glyphicon-trash"></span></a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- MODAL -->
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Eliminar registro</h4>
				</div>
				<div class="modal-body">
					Desea eliminar registro?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<a class="btn btn-danger btn-eliminar">Eliminar</a>
				</div>
			</div>
		</div>
	</div>

	<script>
		$('#confirm-delete').on('show.bs.modal', function(e){
			$(this).find('.btn-eliminar').attr('href', $(e.relatedTarget).data('href'));

			$('.debug-url').html('Delete URL: <strong>'+$(this).find('.btn-eliminar').attr('href')+'</strong>');
		})
	</script>
</body>
</html>