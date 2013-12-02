 <div class="row-fluid">
	 <div class="span12 offset4">
	<h2>Agregar cliente</h2>
	 	<?= form_open('chofer-vendedor/clientes/recibirdatosCliente'); ?>
		  <div class="control-group">
		    <label class="control-label" for="nombre">Nombre:</label>
		    <div class="controls">
		     <input style="height:30px" required type="text" id="nombre" name="nombre" placeholder="Nombre">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="direccion">Dirección:</label>
		    <div class="controls">
		      <input style="height:30px" required type="text" id="direccion" name="direccion" placeholder="Direccion">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="diaVisita">Dia visita:</label>
		    <div class="controls">
		    	<select name="diaVisita" >
			  		<option value="1">Lunes</option>
			  		<option value="2">Martes</option>
			  		<option value="3">Miércoles</option>
			  		<option value="4">Jueves</option>
			  		<option value="5">Viernes</option>
			  		<option value="6">Sábado</option>
			  		<option value="7">Domingo</option>
				</select>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="municipio">Municipio:</label>
		    <div class="controls">
		      <?=form_dropdown('municipio', $perfiles, @$perfil['nombre']);?>
		    </div>
		  </div>
		  <div class="control-group">
		    <div class="controls">
		      	<button type="submit" class="btn btn-primary">Guardar</button>
  				<button type="button" class="btn">Cancelar</button>
		    </div>
		  </div>
		<?= form_close(); ?>
	 </div>
 </div>