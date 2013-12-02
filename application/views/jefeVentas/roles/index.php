<h2>Roles</h2>
<p>
	<?=anchor( "jefeVentas/roles/create/" ,"Agregar" ,"class='btn btn-primary'" )?>
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
			$dia = '';
			if ($rol->dia == '1'){$dia = 'Lunes';}
			elseif ($rol->dia == '2'){$dia = 'Martes';}
			elseif ($rol->dia == '3'){$dia = 'Miercoles';}
			elseif ($rol->dia == '4'){$dia = 'Jueves';}
			elseif ($rol->dia == '5'){$dia = 'Viernes';}
			else {$dia = 'Sabado';}

			echo "
				<tr>
					<td>".$rol->idRol."</td>
					<td>".$rol->nombre."</td>
					<td>".$dia."</td>
					<td>
						" . anchor( "jefeVentas/roles/update/".$rol->idRol , "Editar" , "class='btn btn-primary'" ) . "
						" . anchor( "jefeVentas/roles/delete/".$rol->idRol , "Eliminar" , "class='btn btn-danger'" ) . "
					</td>
				</tr>
			";
		}
	?>
</table>