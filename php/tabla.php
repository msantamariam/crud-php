<?php 
include('conexion.php');

$contactos='SELECT * FROM contactos';
$datos= $link->query($contactos);
?>

<?php if($datos->num_rows>0): ?>
	<table>
		<thead>
			<th>ID</th>
			<th>Nombre/s</th>
			<th>Apellido/s</th>
			<th>Direccion</th>
			<th>Email</th>
			<th>Telefono</th>
		</thead>
	<?php while ($p=$datos->fetch_array()): ?>
		<tr>
			<td><?php echo $p['id']; ?></td>
			<td><?php echo $p['nombre']; ?></td>
			<td><?php echo $p['apellido']; ?></td>
			<td><?php echo $p['direccion']; ?></td>
			<td><?php echo $p['email']; ?></td>
			<td><?php echo $p['telefono']; ?></td>
		</tr>
	<?php endwhile; ?>
	</table>
<?php else: ?>
	<p>NO HAY RESULTADOS</p>
<?php endif; ?>