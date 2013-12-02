<div class="span8 offset4">
	<h2>Crear Ruta</h2>
	<?= form_open('admin/rutas/create'); 
	?>		
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


		<label class="control-label" for="nombre">Nombre ruta:</label>
		<div class="controls">
			<?=form_input('nombre_ruta', '', '  id="nombre" placeholder="Nombre Ruta"')?> <br />
		</div>

		<label class="control-label" for="user">Chofer a cargo:</label>
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
			
		</div>

		<br /> <br />

		<input type="submit" name="save" value="Guardar" class="btn btn-success" />
	<?= form_close(); ?>
</div>