<div class="span8 offset4">

	<?php echo form_open('admin/productos/create', 'class="form-horizontal"'); ?>
		
		<div class="modal" id="myModal">
			
			<div class="modal-header">
				<a class="close" data-dismiss="modal"> x </a>
				<h3>Nuevo producto</h3>
			</div>

			<div class="modal-body">
				
				<label class="control-label" for="nombre">Nombre Producto:</label>
				<div class="controls">
					<?=form_input('nombre_producto', '', ' id="nombre" placeholder="Nombre del producto"')?> 
				</div> <br />

				<label class="control-label" for="Presentacion">Presentación:</label>
				<div class="controls">
					<?=form_input('presentacion', '', ' id="Presentacion" placeholder="Gramos"')?> 
				</div> <br />

				<label class="control-label" for="precio_fabrica">Precio Fabrica:</label>
				<div class="controls">
					<?=form_input('precio_fabrica', '', ' id="Precio_fabrica" placeholder="Precio de Fabrica"')?> 
				</div> <br />

				<label class="control-label" for="precio_publico">Precio Publico:</label>
				<div class="controls">
					<?=form_input('precio_publico', '', ' id="Precio_publico" placeholder="Precio de Publico"')?>
				</div> <br />

				<label class="control-label" for="cantidad">Cantidad:</label>
				<div class="controls">
					<?=form_input('cantidad', '', ' id="cantidad" placeholder="Cantidad"')?> 
				</div> <br />

				<label class="control-label" for="caducidad">Fecha de caducidad: </label>
				<div class="controls">
					<input name="caducidad" type="date" value="2013-05-01"/>
				</div>
			</div>

			<div class="modal-footer">
				<input type="submit" name="save" value="Guardar" class="btn btn-success" />
				<?php echo anchor("admin/productos", "Cancelar", 'class="btn"'); ?>
			</div>
		<div>
	<?php echo form_close(); ?>
</div>