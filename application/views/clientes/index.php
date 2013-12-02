<script type="text/javascript">
	$(document).ready(function() {
		$('#example').dataTable( {
			"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>"
		} );
	} );

	$.extend( $.fn.dataTableExt.oStdClasses, {
		"sWrapper": "dataTables_wrapper form-inline"
	} );
</script>

<script type="text/javascript">
	$(function() {
		$('[data-toggle="cCliente"]').click(function(e) {
			e.preventDefault();

			var href = $(this).attr('href');

			if (href.indexOf('#') == 0) {
				$(href).modal('open');
			} else {
				$.get(href, function(data) {
					$(data).modal();
				});
			}
		});
	});
</script>

<h2>Clientes</h2>
<p>
	<?=anchor( "admin/clientes/create/" ,"Agregar" ,"data-toggle='cCliente' class='btn btn-primary'" )?>
</p>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable" id="example" aria-describedby="example_info">
	<thead>
		<tr role="row">
			<th>Id</th>
			<th>Nombre</th>
			<th>Direcci&oacute;n</th>
			<th>Municipio</th>
			<th>Status</th>
			<th>Asignado</th>
			<th>Día</th>
			<th>Opciones</th>
		</tr>
	</thead>

	<?php
		foreach ($clientes ->result() as $cliente) {
			if ($cliente->dia == '1'){$dia = "Lunes";}
			elseif ($cliente->dia == '2'){$dia = "Martes";}
			elseif ($cliente->dia == '3'){$dia = "Miercoles";}
			elseif ($cliente->dia == '4'){$dia = "Jueves";}
			elseif ($cliente->dia == '5'){$dia = "Viernes";}
			else {$dia = "Sabado";}
			$val = $cliente->status;
			if ($val == '1'){$val = "Activo";}
			else {$val = "Inactivo";}

			$a = $cliente->asignado;
			if ($a == '1'){$a = "Si";}
			else {$a = "No";}
			echo "
				<tr>
					<td>".$cliente->idCliente."</td>
					<td>".$cliente->nombre."</td>
					<td>".$cliente->direccion."</td>
					<td>".$cliente->idMunicipio."</td>
					<td>".$val."</td>					
					<td>".$a."</td>
					<th>".$dia."</th>					
					<td>
						" . anchor( "admin/clientes/update/".$cliente->idCliente , "Editar" , "data-toggle='update' class='btn btn-primary'" ) . "
						" . anchor( "#dDelete" , "Eliminar" , "class='btn btn-danger' data-toggle='modal'" ) . "
					</td>
				</tr>
			";
		}
	?>
</table>

<div id="dDelete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Eliminar</h3>
	</div>
	<div class="modal-body">
		<p>¿Estas seguro que deseas eliminar el cliente?</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
		<?php echo anchor( "admin/productos/delete/".$cliente->idCliente, "Eliminar" , "class='btn btn-danger'" ); ?>
	</div>
</div>
