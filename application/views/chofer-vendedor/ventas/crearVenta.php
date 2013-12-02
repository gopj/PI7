<?= form_open('chofer-vendedor/ventas/recibirdatosVenta', 'class="form-horizontal"'); ?>
 <div class="row-fluid">
	 <div class="span12">
	 	<h3>1.- Seleccionar cliente</h3>
	 	<div class="accordion" id="accordion2">
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
					 title="Selecciona cliente" href="#clientes"> Lista clientes </a>
				</div>
				<div id="clientes" class="accordion-body collapse">
					<div class="accordion-inner">
					 	<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>N°</th>
									<th>Nombre</th>
									<th>Direccion</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							//vemos si ventas contiene algo
							if($clientes):
								foreach ($clientes->result() as $cliente): 
									if($cliente->status == "1"): 
										echo "<tr class='success'>";
									else:
										echo "<tr class='error'>"; 
									endif;
									?>
											<td>
													<?= $cliente->idCliente; ?>
													<input type="radio" title="Seleccionar" name="cliente" value="<?= $cliente->idCliente; ?>">
												</a>
											</td>
											<td><?= $cliente->nombre; ?></td>
											<td><?= $cliente->direccion; ?></td>
										</tr>
									<?php 
								endforeach;
							else:
								echo "<p class='alert'>Actualmente no tiene asignados clientes</p>";
							endif;
						?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	 </div>
 </div>
 <div class="row-fluid">
	 <div class="span12">
		<h3>2.- Productos a comprar</h3>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
				 title="Selecciona los productos" href="#productos"> Lista de productos en camión </a>
			</div>
			<div id="productos" class="accordion-body collapse">
				<div class="accordion-inner">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>N°</th>
								<th>Producto</th>
								<th>Presentacion</th>
								<th>Caducidad</th>
								<th>Precio</th>
								<th>Cantidad actual</th>
								<th>Cantidad comprar</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						//vemos si ventas contiene algo
						if($productos):
							$i = 1;
							foreach ($productos->result() as $producto): 
								if($producto->status == "1"): 
									echo "<tr class='success'>";
								else:
									echo "<tr class='error'>"; 
								endif;
								?>
										<td>
											<?= $producto->idProducto; ?>
											<input type="checkbox" title="Agregar" name="productos[]" id="check<?=$i?>" onclick="habilitarInput(check<?=$i?>,cantidad<?=$i?>)" value="<?= $producto->idProducto; ?>">
										</td>
										<td>
											<?= $producto->nombre_producto; ?>
										</td>
										<td><?= $producto->presentacion . " gr"; ?></td>
										<td><?= $producto->fecha_caducidad; ?></td> 
										<td><?= $producto->precio_publico; ?></td>
										<td><?= $producto->cantidadRegreso; ?></td> 
										<td><input type="text" class="input-small" id="cantidad<?=$i?>"   name="cantidadComprar[]" disabled="true" /></td>
									</tr>
								<?php 
								$i++;
							endforeach;
						else:
							echo "<p class='alert'>Actualmente no tiene asignados productos</p>";
						
						endif;
					?>	
							<!--<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td> 
								<td></td>
								<td>Total</td> 
								<td><input type="text" class="input-small" id="total"   name="total" disabled="true" /></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td> 
								<td></td>
								<td>Pago</td> 
								<td><input type="text" class="input-small" id="pago" name="pago" /></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td> 
								<td><input type="button" class="btn" id="pagar" name="pagar" value="Pagar"/></td>
								<td>Cambio</td> 
								<td><input type="text" class="input-small" id="cambio"   name="cambio" disabled="true" /></td>
							</tr>-->
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<h3>3.- Agregar producto caducado</h3>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
				 title="Productos expirados" href="#productosEx"> Lista productos caducados </a>
			</div>
			<div id="productosEx" class="accordion-body collapse">
				<div class="accordion-inner">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>N°</th>
								<th>Producto</th>
								<th>Presentacion</th>
								<th>Precio</th>
								<th>Caducidad</th>
								<th>Cantidad devolver</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						//vemos si ventas contiene algo
						if($todosProductos):
							$i = 1;
							foreach ($todosProductos->result() as $producto): 
								if($producto->status == "1"): 
									echo "<tr class='success'>";
								else:
									echo "<tr class='error'>"; 
								endif;
								?>
										<td>
											<?= $producto->idProducto; ?>
											<input type="checkbox" title="Agregar" name="productosT[]" id="checkT<?=$i?>" 
											onclick="habilitarInput(checkT<?=$i?>,cantidadT<?=$i?>)" 
											value="<?= $producto->idProducto; ?>">
										</td>
										<td>
											<?= $producto->nombre_producto; ?>
										</td>
										<td><?= $producto->presentacion . " gr"; ?></td> 
										<td><?= $producto->precio_publico; ?></td> 
										<td><?= $producto->fecha_caducidad; ?></td> 
										<td>	
											<input type="text" class="input-small" id="cantidadT<?=$i?>" 
											name="cantidadCaducados[]" disabled="true" />
										</td>

									</tr>
								<?php 
								$i++;
							endforeach;
						else:
							echo "<p class='alert'>Actualmente no hay productos caducados en inventario</p>";
						endif;
					?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
<input type="submit" name="enviar" value="Enviar venta" class="btn btn-success btn-large" />
<?= form_close(); ?>

<!--Funcion para habilitar  deshabilitar el input dentro de la fila--> 
<script type="text/javascript">
function habilitarInput(check, input){
	if(check.checked==true){
		input.disabled = false;
	}
	if(check.checked==false){
		input.disabled = true;
	}
}

function validar(tabla) {
  for(i=0; ele=tabla.elements[i]; i++){
    if (ele.type=='checkbox' && ele.checked)
      return true;
  	alert('Error');
  	return false;
  }
}
</script>
