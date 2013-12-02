<h2>Reporte de productos en merma por fecha</h2>

<?php 
if ($infor <> ""){
	echo $infor;
}
echo form_open('gerenteVentas/bajas/reporteBajaXcaducidad'); 

?>

	<label for="fecha">Fecha de caducidad: </label>
	<div class="controls">
		<input name="fecha" type="date" value="2013-05-01"/>
	</div>

	<input type="submit" name="save" value="Traer Reporte" class="btn btn-success" />
<?php echo form_close(); ?>