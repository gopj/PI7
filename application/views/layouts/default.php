<?php // $user = $this->session->userdata('user'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta http-equiv="Content-type" content="text/html"; charset="utf-8" />
	<title>Botanitas</title>

	<?php echo link_tag( 'css/bootstrap.css' ) ?>
	<?php echo link_tag( 'css/bootstrap.min.css' ) ?>
	<?php echo link_tag( 'css/prettify.css' ) ?>
	<?php echo link_tag( 'css/style.css' ) ?>

	<script src="<?=base_url('js/jquery-1.9.0.js')?>"> </script>
	<script src="<?=base_url('js/bootstrap.js')?>"> </script>
</head>
<body>
<div class="navbar navbar-fixed-top navbar-inverse" style="position: static;">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>

			<a class="brand" href="<?=base_url()?>">Botanitas</a>
			<div class="nav-collapse collapse navbar-inverse-collapse">

				<ul class="nav">
					<li><a href="#">Conocenos</a></li>
					<li><a href="#">Link</a></li>
				</ul>

				<ul class="nav pull-right">
					<li class="divider-vertical"></li>
					<li><a href="<?=base_url()?>login">Iniciar Sesion</a></li>
				</ul>
			</div><!-- /.nav-collapse -->
		</div>
	</div><!-- /navbar-inner -->
</div><!-- /navbar -->

	<?php echo $output; ?>
</body>
</html>