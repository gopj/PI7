<h2>Reportes de ventas por mes</h2>
<?php 
if ($infor <> ""){
	echo $infor;
}
echo form_open('gerenteVentas/ventas/reporteMensuales'); ?>
<label for="fecha1">Año: </label>
<div class="controls">
	<select name="year", id='fecha1'>
		<option value="2013-">2013</option>
		<option value="2014-">2014</option>
		<option value="2015-">2015</option>
		<option value="2016-">2016</option>
	</select>
</div>

<label for="fecha">Mes: </label>
<div class="controls">
	<select name="mes", id='fecha'>
		<option value="01-">Enero</option>
		<option value="02-">Febrero</option>
		<option value="03-">Marzo</option>
		<option value="04-">Abril</option>
		<option value="05-">Mayo</option>
		<option value="06-">Junio</option>
		<option value="07-">Julio</option>
		<option value="08-">Agosto</option>
		<option value="09-">Septiembre</option>
		<option value="10-">Octubre</option>
		<option value="11-">Noviembre</option>
		<option value="12-">Diciembre</option>
	</select>
</div>
<input type="submit" name="save" value="Traer Reporte" class="btn btn-success" />
<?php echo form_close(); ?>