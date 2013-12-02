<h2>Salidas de productos por chofer</h2>
<?= form_open('usuario-inventario/salidas/index'); ?>
<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Usuario</th>
				<th>Fecha salida</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
	<?php 
		if($salidas):
			foreach ($salidas->result() as $salida): 
				if($salida->status == "1"): 
					echo "<tr class='success'>";
					$bloqueado = "enable='true'";
					$cotejado = "cotejar";
				else:
					echo "<tr class='error'>"; 
					$bloqueado = "disabled='true'";
					$cotejado = "cotejado";
				endif;
				?>
						<td>
							<a title='Ver detalle' href="<?=base_url();?>usuario-inventario/salidas/index/
							<?= $salida->idSalida; ?>">
								<?= $salida->idSalida; ?> 
							</a>
						</td>
						<td><?= $salida->usuario; ?></td>
						<td><?= $salida->fecha; ?></td>
						<input type="hidden" name="idSalida" id="idSalida" value="<?=$salida->idSalida;;?>" />
						<td><input type="submit" <?=$bloqueado;?> class="btn btn-success" name="enviar" value="<?=$cotejado?>"/></td>
					</tr>
				<?php 
			endforeach;
		else:
			echo "<p>Actualmente no hay ventas</p>";
		endif;
	?>
		</tbody>
</table>
<?= form_close(); ?>

<?php if (isset($detalleSalida)): ?>
<h2>Detalle de la salida</h2>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Producto</th>
			<th>Presentacion</th>
			<th>Caducidad</th>
			<th>Precio</th>
			<th>Cantidad llevó</th>
			<th>Cantidad regresó</th>
		</tr>
	</thead>
	<tbody>
<?php 
	//vemos si detalle de salida contiene algo
	if($detalleSalida):
		$total = 0;
		foreach ($detalleSalida->result() as $detalle): 
			?>
				<tr>
					<td><?= $detalle->producto; ?></td>
					<td><?= $detalle->presentacion . " gr"; ?></td>
					<td><?= $detalle->caducidad; ?></td>
					<td><?= $detalle->precio; ?></td>
					<td><?= $detalle->cantidadLleva; ?></td>
					<td><?= $detalle->cantidadRegreso; ?></td>
				</tr>
			<?php 
			//obtenemos el total que se debe entregar por cada producto 
			$total += ($detalle->cantidadLleva-$detalle->cantidadRegreso)*$detalle->precio;
		endforeach;
	else:
		echo "<p>No hay detalle para esta venta</p>";
	endif;
?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>Total entregar:</td>
			<td>$ <?= $total; ?></td>
		</tr>
	</tbody>
</table>

<?php endif; ?>