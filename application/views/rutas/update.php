<div class="span8 offset4">
	<h2>Modificar Ruta</h2>

	<?php echo form_open('admin/rutas/update/'. $ruta['idRuta']);?>
		<label class="control-label" for="clave">Municipio:</label>
				<div class="controls">

			<?php
			if($mun):
				?>
				<select name="municipio", id='user'>
					<?php
				foreach($mun->result() as $m):
				?>
				<option value="<?=$m->idMunicipio;?>"><?=$m->nombre;?></option>
				<?php
				endforeach;?>
				</select><?php
			endif;
			?>
			
		</div>

		<label class="control-label" for="nombre_ruta1">Nombre ruta:</label>
		<div class="controls">
			<?=form_input('nombre_ruta', $ruta['nombre_ruta'], '  id="nombre_ruta1" placeholder="Nombre ruta"')?> <br />
		</div>

		<label class="control-label" for="chofer1">Chofer a cargo:</label>
		<div class="controls">

					<?php
				if($nombres):
					?>
					<select name="chofer", id='user'>
						<?php
					foreach($nombres->result() as $nom):
					?>
					<option value="<?=$nom->idUsuario;?>"><?=$nom->nombre_usuario;?></option>
					<?php
					endforeach;?>
					</select><?php
				endif;
			?>

		<br /> <br />

		<input type="submit" name="save" value="Guardar" class="btn btn-success" />
	<?php echo form_close(); ?>
</div>