<br />

<?php echo form_open("login/", array("class" => "form-signin")); ?>
	<h2 class="form-signin-heading">Identificaci&oacute;n</h2>
	<p>
		<label for="usuario">Usuario: </label>
		<input name="usuario" type="text" class="input-block-level span3" placeholder="Nombre de usuario">
		<label for="clave">Contrase&ntilde;a:</label>
		<input name="clave" type="password" class="input-block-level span3" placeholder="Clave">
	</p>

	<?php echo form_submit("login", "Entrar", 'class="btn btn-large btn-primary"'); ?>

<?php echo form_close(); ?>	