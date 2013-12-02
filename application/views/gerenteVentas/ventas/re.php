	<?php
		
			echo '
			<h2>Reporte de venta diaria por producto</h2>
			<table class="table table-striped table-bordered" >
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Precio publico</th>
					<th>Cantidad</th>
					<th>Fecha de venta</th>
				</tr>
			</thead>';
			foreach ($reportes ->result() as $reporte) {
			echo "

				<tr>
					<td>".$reporte->nombre_producto."</td>
					<td>".$reporte->precio_publico."</td>
					<td>".$reporte->cantidad."</td>
					<td>".$reporte->fecha_venta. "</td>
				</tr>
			";
			}
			echo "</table>";
		
	?>
