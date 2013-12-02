<div class="span8 offset4">
	<h2>Modificar Usuario</h2>

	<?php echo form_open('admin/usuarios/update/'. $user['idUsuario']); 
		$activo = $user['status'];
	if ($activo == '1'){
		$activo="<option value='1' selected>Activo</option>
		 <option value='0'>Inactivo</option>";
		}
	else{
		 $activo="<option value='1'>Activo</option>
		 <option value='0' selected>Inactivo</option>";
		 }
	?>

		<label class="control-label" for="nombre">Nombre usuario:</label>
		<div class="controls">
			<?=form_input('nombre_usuario', $user['nombre_usuario'], '  id="nombre" placeholder="Nombre del usuario"')?> <br />
		</div>

		<label class="control-label" for="clave">Clave:</label>
		<div class="controls">
			<?=form_password('clave', '', ' id="clave" placeholder="Clave"')?> <br />
		</div>

		<label class="control-label" for="perfil">Tipo de usuario:</label>
		<div class="controls">
			<?=form_dropdown('idTipo_usuario', $perfiles, @$perfil['nombre']);?>
		</div>

		<label class="control-label" for="estado">Estado:</label>
		<div class="controls">
			<select name="estado">
				<?php echo $activo; ?>
			</select>
		</div>

		<br /> <br />

		<input type="submit" name="save" value="Guardar" class="btn btn-success" />
	<?php echo form_close(); ?>
</div>