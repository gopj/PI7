	<?php
		
			echo '
			<h2>Reporte de venta diaria por producto</h2>
			<table class="table table-striped table-bordered" >
			<thead>
				<tr>
					<th>Id Producto</th>
					<th>Nombre producto</th>
					<th>Precio publico</th>
					<th>cantidad</th>
				</tr>
			</thead>';
			foreach ($reportes ->result() as $reporte) {
			echo "

				<tr>
					<td>".$reporte->idProducto."</td>
					<td>".$reporte->nombre_producto."</td>
					<td>".$reporte->precio_publico."</td>
					<td>".$reporte->cantidad. "</td>
				</tr>
			";
			}
			echo "</table>";
		
	?>
