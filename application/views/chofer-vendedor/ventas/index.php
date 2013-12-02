<h2>Ventas </h2>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>N°</th>
			<th>Usuario</th>
			<th>Cliente</th>
			<th>Fecha</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
<?php 
	//vemos si ventas contiene algo
	if($ventas):
		foreach ($ventas->result() as $venta): 
			?>
				<tr>
					<td>
					<a title='Ver detalle' href="<?=base_url();?>chofer-vendedor/ventas/index/
							<?= $venta->idVenta; ?>">
							<?= $venta->idVenta; ?> 
					</a>
					</td>
					<td><?= $venta->usuario; ?></td>
					<td><?= $venta->cliente; ?></td>
					<td><?= $venta->fecha; ?></td>
					<td><?= $venta->total; ?></td>
				</tr>
			<?php 
		endforeach;
	else:
		echo "<p class='alert'>Actualmente no hay ventas realizadas</p>";
	endif;
?>
	</tbody>
</table>

<!--Si consulta solo una venta, se le muestra el detalle de la venta -->
<?php if (isset($detalleVenta)): ?>
<h2>Detalle de la venta</h2>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Producto</th>
			<th>Presentacion</th>
			<th>Caducidad</th>
			<th>Precio</th>
			<th>Cantidad comprada</th>
		</tr>
	</thead>
	<tbody>
<?php 
	//vemos si ventas contiene algo
	if($detalleVenta):
		foreach ($detalleVenta->result() as $detalle): 
			?>
				<tr>
					<td><?= $detalle->producto; ?></td>
					<td><?= $detalle->presentacion . " gr"; ?></td>
					<td><?= $detalle->caducidad; ?></td>
					<td><?= $detalle->precio; ?></td>
					<td><?= $detalle->cantidad; ?></td>
				</tr>
			<?php 
		endforeach;
	else:
		echo "<p class='alert'>No hay detalle para esta venta</p>";
	endif;
?>
	</tbody>
</table>

<?php endif; ?>


