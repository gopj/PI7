<h2>Usuarios</h2>
<p>
	<?=anchor( "admin/usuarios/create/" ,"Agregar" ,"class='btn btn-primary'" )?>
</p>
<table class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Id</th>
			<th>Tipo de usuario</th>
			<th>Nombre</th>
			<th>Estado</th>
			<th colspan="2">Opciones</th>
		</tr>
	</thead>

	<?php
		foreach ($users ->result() as $user) {
			$val = $user->status;
			if ($val == '1'){$val = "Activo";}
			else {$val = "Inactivo";}
			echo "
				<tr>
					<td>".$user->idUsuario."</td>
					<td>".$user->idTipo_usuario."</td>
					<td>".$user->nombre_usuario."</td>
					<td>".$val."</td>
					<td>
						" . anchor( "admin/usuarios/update/".$user->idUsuario , "Editar" , "class='btn btn-primary'" ) . "
						" . anchor( "admin/usuarios/delete/".$user->idUsuario , "Eliminar" , "class='btn btn-danger'" ) . "
					</td>
				</tr>
			";
		}
	?>
</table>