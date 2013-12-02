	<?php
		
			echo '
			<h2>Reporte de venta diaria por producto</h2>
			<table class="table table-striped table-bordered" >
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Chofer-Vendedor</th>
					<th>Total MN</th>
				</tr>
			</thead>';
			foreach ($reportes ->result() as $reporte) {
			echo "

				<tr>
					<td>".$reporte->fecha_venta."</td>
					<td>".$reporte->nombre_usuario."</td>
					<td>$".$reporte->total. "</td>
				</tr>
			";
			}
			echo "</table>";
		
	?>