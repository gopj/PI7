<div class="span8 offset4">

	<?php echo form_open('admin/productos/update/'.$producto['idProducto']);
	$activo = $producto['status'];
	if ($activo == '1'){
		$activo="<option value='1' selected>Activo</option>
		 <option value='0'>Inactivo</option>";
		}
	else{
		 $activo="<option value='1'>Activo</option>
		 <option value='0' selected>Inactivo</option>";
		 }

	?>
		<div class="modal" id="myModal">
			
			<div class="modal-header">
				<a class="close" data-dismiss="modal"> x </a>
				<h3>Actulizar producto</h3>
			</div>

			<div class="modal-body">

				<label class="control-label" for="Nombre_producto">Nombre Producto:</label>
				<div class="controls">
					<?=form_input('nombre_producto', $producto['nombre_producto'], ' id="Nombre_producto" placeholder="Nombre del producto"')?> <br />
				</div>

				<label class="control-label" for="clave">Presentación:</label>
				<div class="controls">
					<?=form_input('presentacion', $producto['presentacion'], ' id="Presentacion" placeholder="Gramos"')?> <br />
				</div>

				<label class="control-label" for="clave">Precio Fabrica:</label>
				<div class="controls">
					<?=form_input('precio_fabrica', $producto['precio_fabrica'], ' id="Precio_fabrica" placeholder="Precio de Fabrica"')?> <br />
				</div>

				<label class="control-label" for="clave">Precio Publico:</label>
				<div class="controls">
					<?=form_input('precio_publico', $producto['precio_publico'], ' id="Precio_publico" placeholder="Precio de Publico"')?> <br />
				</div>

				<label class="control-label" for="status">Estado:</label>
				<div class="controls">
					<select name="status">
						<?php echo $activo; ?>
					</select>
				</div>

				<label class="control-label" for="cant">Cantidad:</label>
				<div class="controls">
					<?=form_input('cantidad', $producto['cantidad'], ' id="cant" placeholder=""')?> <br />
				</div>

				<label for="caducidad">Fecha de caducidad: </label>
				<div class="controls">
					<input name="caducidad" type="date" value=<?php echo '"'. $producto['fecha_caducidad'] .'"'?>/>
				</div>

			</div>

			<div class="modal-footer">
				<input type="submit" name="save" value="Guardar" class="btn btn-success" />
				<?php echo anchor("admin/productos", "Cancelar", 'class="btn"'); ?>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>