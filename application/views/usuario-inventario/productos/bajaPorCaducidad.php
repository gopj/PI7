<div class="row-fluid">
	<div class="span12">
		<h2>Productos caducados</h2>
		<?= form_open('usuario-inventario/productos/bajaPorCaducidad'); ?>
		<div class="accordion" id="accordion2">
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
					 title="Selecciona los productos" href="#productos"> Lista de productos caducados </a>
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
									<th>Baja</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							//vemos si ventas contiene algo
							if($productosCad):
								$i = 1;
								foreach ($productosCad->result() as $producto): 
									
									if($producto->status == "1"): 
										echo "<tr class='warning'>";
										$bloqueado = "enable='true'";
										
									else:
										echo "<tr class='error'>"; 
										$bloqueado = "disabled='true'";
										
									endif;
									?>
											<td>
												<?= $producto->idProducto; ?>
											</td>
											<td>
												<?= $producto->nombre_producto; ?>
											</td>
											<td><?= $producto->presentacion . " gr"; ?></td>
											<td><?= $producto->fecha_caducidad; ?></td> 
											<td><?= $producto->precio_publico; ?></td>
											<td><?= $producto->cantidad; ?></td> 
											<td>
												<input type="checkbox" name="productos[]" id="check<?=$i?>" 
												<?=$bloqueado;?> 
												value="<?= $producto->idProducto; ?>"/>
											</td>
										</tr>
									<?php 
									$i++;
								endforeach;
							else:
								echo "<p>Error en la aplicacion</p>";
							endif;
						?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<input type="submit" name="enviar" value="Dar baja" class="btn btn-success btn-large" />
		<?= form_close(); ?>
	</div>
</div>