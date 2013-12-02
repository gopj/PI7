<h2>Roles</h2>
<p>
	<?=anchor( "admin/roles/create/" ,"Agregar" ,"class='btn btn-primary'" )?>
</p>
<table class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Id Rol</th>
			<th>Ruta</th>
			<th>Rol dia</th>
			<th colspan="2">Opciones</th>
		</tr>
	</thead>

	<?php
		foreach ($roles ->result() as $rol) {
			echo "
				<tr>
					<td>".$rol->idRol."</td>
					<td>".$rol->nombre."</td>
					<td>".$rol->dia."</td>
					<td>
						" . anchor( "admin/roles/update/".$rol->idRol , "Editar" , "class='btn btn-primary'" ) . "
						" . anchor( "admin/roles/delete/".$rol->idRol , "Eliminar" , "class='btn btn-danger'" ) . "
					</td>
				</tr>
			";
		}
	?>
</table>