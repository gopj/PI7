<h2>Rutas</h2>
<p>
	<?=anchor( "jefeVentas/rutas/create/" ,"Agregar" ,"class='btn btn-primary'" )?>
</p>
<table class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Chofer a cargo</th>
			<th>Municipio</th>
			<th colspan="2">Opciones</th>
		</tr>
	</thead>

	<?php
		foreach ($rutas ->result() as $ruta) {
			echo "
				<tr>
					<td>".$ruta->idRuta."</td>
					<td>".$ruta->nombreRuta."</td>
					<td>".$ruta->nombreUser."</td>
					<td>".$ruta->nombre."</td>
					<td>
						" . anchor( "jefeVentas/rutas/update/".$ruta->idRuta , "Editar" , "class='btn btn-primary'" ) . "
						" . anchor( "jefeVentas/rutas/delete/".$ruta->idRuta , "Eliminar" , "class='btn btn-danger'" ) . "
					</td>
				</tr>
			";
		}
	?>
</table>