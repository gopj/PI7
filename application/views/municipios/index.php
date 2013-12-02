<h2>Municipios</h2>
<p>
	<?=anchor( "admin/municipios/create/" ,"Agregar" ,"class='btn btn-primary'" )?>
</p>
<table class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th colspan="2">Opciones</th>
		</tr>
	</thead>

	<?php
		foreach ($municipios as $key => $m) {
			echo "
				<tr>
					<td>".$m->idMunicipio."</td>
					<td>".$m->nombre."</td>
					<td>
						" . anchor( "admin/municipios/update/".$m->idMunicipio , "Editar" , "class='btn btn-primary'" ) . "
						" . anchor( "admin/municipios/delete/".$m->idMunicipio , "Eliminar" , "class='btn btn-danger'" ) . "
					</td>
				</tr>
			";
		}
	?>
</table>