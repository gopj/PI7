
	<h2>Clientes</h2>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>N°</th>
				<th>Nombre</th>
				<th>Dirección</th>
				<th>Municipio</th>
				<th>Día</th>
			</tr>
		</thead>
		<tbody>
	<?php 
		//vemos si ventas contiene algo
		if($clientesChofer):
			foreach ($clientesChofer->result() as $cliente):
				if($cliente->status == "1"): 
					echo "<tr class='success'>";
				else:
					echo "<tr class='error'>"; 
				endif; 
				?>
						<td><?= $cliente->idCliente; ?> </td>
						<td><?= $cliente->nombre; ?></td>
						<td><?= $cliente->direccion; ?></td>
						<td><?= $cliente->municipio; ?></td>
						<td><?= $cliente->dia; ?></td>
					</tr>
				<?php 
			endforeach;
		else:
			echo "<p class='alert'>Acutalmente no tiene asignados clientes</p>";
		endif;
	?>
		</tbody>
	</table>
