<div class="span8 offset4">
	<h2>Crear Usuario</h2>

	<?php echo form_open('admin/usuarios/create'); ?>

		<label class="control-label" for="nombre">Nombre usuario:</label>
		<div class="controls">
			<?=form_input('nombre_usuario', '', '  id="nombre" placeholder="Nombre del usuario"')?> <br />
		</div>

		<label class="control-label" for="clave">Clave:</label>
		<div class="controls">
			<?=form_password('clave', '', ' id="clave" placeholder="Clave"')?> <br />
		</div>

		<label class="control-label" for="perfil">Tipo de usuario:</label>
		<div class="controls">
			<?=form_dropdown('idTipo_usuario', $perfiles, @$perfil['nombre']);?>
		</div>
		<br /> <br />

		<input type="submit" name="save" value="Guardar" class="btn btn-success" />
	<?php echo form_close(); ?>
</div>