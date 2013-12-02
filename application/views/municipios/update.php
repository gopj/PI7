<div class="span8 offset4">
	<h2>Modificar Municipio</h2>

	<?php echo form_open('admin/municipios/update/'. $mun['idMunicipio']); ?>

		<label class="control-label" for="nombre">Nombre del Municipio:</label>
		<div class="controls">
			<?=form_input('nombre', $mun['nombre'], '  id="nombre" placeholder="Nombre del Municipio"')?> <br />
		</div>

		<br /> <br />

		<input type="submit" name="save" value="Guardar" class="btn btn-success" />
	<?php echo form_close(); ?>
</div>