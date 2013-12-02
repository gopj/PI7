<div class="span8 offset4">
	<h2>Modificar Cliente</h2>

	<?php echo form_open('admin/clientes/update/'. $cliente['idCliente']); 
	$activo = $cliente['status'];
	if ($activo == '1'){
		$activo="<option value='1' selected>Activo</option>
		 <option value='0'>Inactivo</option>";
		}
	else{
		 $activo="<option value='1'>Activo</option>
		 <option value='0' selected>Inactivo</option>";
		 }
	?>

		<label class="control-label" for="nombre">Nombre Cliente:</label>
		<div class="controls">
			<?=form_input('nombre', $cliente['nombre'], '  id="nombre" placeholder="Nombre del Cliente"')?> <br />
		</div>

		<label class="control-label" for="direccion">Dirección:</label>
		<div class="controls">
			<?=form_input('direccion', $cliente['direccion'], ' id="direccion" placeholder="Dirección"')?> <br />
		</div>

		<label class="control-label" for="idMunicipio">Municipio:</label>
		<div class="controls">
			<?=form_dropdown('idMunicipio', $perfiles, @$perfil['nombre']);?>
		</div>

		<label class="control-label" for="estado">Estado:</label>
		<div class="controls">
			<select name="estado">
				<?php echo $activo; ?>
			</select>
		</div>

		<label class="control-label" for="clave">Asignado:</label>
		<div class="controls">
			<select name="asignado">
				<option value='1'>Si</option>
		 		<option value='0' selected>No</option>
			</select>
		</div>

		<label class="control-label" for="dia_visita">Dia visita:</label>
		<div class="controls">
			<select name="dia_visita">
				<option value='1'>Lunes</option>
			 	<option value='2'>Martes</option>
			 	<option value='3'>Miercoles</option>
			 	<option value='4'>Jueves</option>
			 	<option value='5'>Viernes</option>
			 	<option value='6'>Sabado</option>
			</select><br />
		</div>

		<br /> <br />

		<input type="submit" name="save" value="Guardar" class="btn btn-success" />
	<?php echo form_close(); ?>