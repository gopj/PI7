<h2>Asignación de clientes</h2>

<?=form_open('jefeVentas/clienteRol/hacerAsignar/'. $this-> uri -> segment(4), 'class="form-horizontal"'); ?>
<table class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th></th>
			<th>Id Cliente</th>
			<th>Cliente</th>
			<th>Dirección</th>
			<th>Municipio</th>
			<th>Dia de visita</th>
			
		</tr>
	</thead>

	<?php
	if($clientes){
		foreach ($clientes ->result() as $Cliente) {
			if ($Cliente->dia_visita == '1'){$dia = "Lunes";}
			elseif ($Cliente->dia_visita == '2'){$dia = "Martes";}
			elseif ($Cliente->dia_visita == '3'){$dia = "Miercoles";}
			elseif ($Cliente->dia_visita == '4'){$dia = "Jueves";}
			elseif ($Cliente->dia_visita == '5'){$dia = "Viernes";}
			else {$dia = "Sabado";}
			echo "
				<tr>
					<td><input type='checkbox' name='clientes[]' value='". $Cliente->idCliente ."'></td>
					<td>".$Cliente->idCliente."</td>
					<td>".$Cliente->nombre."</td>
					<td>".$Cliente->direccion."</td>
					<td>".$Cliente->nombreMunicipio."</td>
					<td>".$dia."</td>
				</tr>
			";
		}
	}else{
		echo "<p>Actualmente no hay candidatos para este rol</p>";
	}
	?>
</table>
<input type="submit" name="enviar" value="Asignar estos clientes" class="btn btn-success btn-large" />
<?= form_close(); ?>