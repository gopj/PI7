<div class="span8 offset4">
	<h2>Modificar Rol</h2>

	<?php echo form_open('admin/roles/update/'. $rol['idRol']);
	$activo = $rol['dia'];
	if ($activo == '1'){
		$activo="<option value='1' selected>Lunes</option><option value='2'>Martes</option><option value='3'>Miercoles</option><option value='4'>Jueves</option><option value='5'>Viernes</option><option value='6'>Sabado</option>";
		}
	elseif ($activo =='2'){
		 $activo="<option value='1' >Lunes</option><option value='2' selected>Martes</option><option value='3'>Miercoles</option><option value='4'>Jueves</option><option value='5'>Viernes</option><option value='6'>Sabado</option>";
		 }
	elseif ($activo =='3'){
		 $activo="<option value='1' >Lunes</option><option value='2' >Martes</option><option value='3' selected>Miercoles</option><option value='4'>Jueves</option><option value='5'>Viernes</option><option value='6'>Sabado</option>";
		 }
	elseif ($activo =='4'){
		 $activo="<option value='1' >Lunes</option><option value='2' >Martes</option><option value='3' >Miercoles</option><option value='4' selected>Jueves</option><option value='5'>Viernes</option><option value='6'>Sabado</option>";
		 }
	elseif ($activo =='5'){
		 $activo="<option value='1' >Lunes</option><option value='2' >Martes</option><option value='3' >Miercoles</option><option value='4' >Jueves</option><option value='5' selected>Viernes</option><option value='6'>Sabado</option>";
		 }
		elseif ($activo =='6'){
		 $activo="<option value='1' >Lunes</option><option value='2' >Martes</option><option value='3' >Miercoles</option><option value='4' >Jueves</option><option value='5' >Viernes</option><option value='6' selected>Sabado</option>";
		 }
	?>

		<label class="control-label" for="rol1">Nombre rol:</label>
		<div class="controls">
			<select name="nombre_rol">
				<?= $activo; ?>
			</select>
		</div>

		<label class="control-label" for="perfil">Nombre Ruta:</label>
		<div class="controls">
			<?=form_dropdown('nombreRuta', $perfiles, @$perfil['nombre_ruta']);?>
		</div>

		<br /> <br />

		<input type="submit" name="save" value="Guardar" class="btn btn-success" />
	<?php echo form_close(); ?>
</div>