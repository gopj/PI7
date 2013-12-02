
	<h2>Crear Rol</h2>

	<?php echo form_open('jefeVentas/roles/create'); ?>

		<label class="control-label" for="roln">Nombre rol:</label>
		<div class="controls">
			<select name="rol">
				<option value='1'>Lunes</option>
			 	<option value='2'>Martes</option>
			 	<option value='3'>Miercoles</option>
			 	<option value='4'>Jueves</option>
			 	<option value='5'>Viernes</option>
			 	<option value='6'>Sabado</option>
			</select><br />
		</div>

		<label class="control-label" for="perfil">Ruta:</label>
		<div class="controls">
			<?=form_dropdown('ruta', $nombre, @$id['nombre_ruta']);?>
		</div>
		<br /> <br />

		<input type="submit" name="save" value="Guardar" class="btn btn-success" />
	<?php echo form_close(); ?>
