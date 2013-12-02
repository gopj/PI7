<!DOCTYPE >
<html>
	<head>
		<title>Pi-6</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<!-- Le styles -->
		<?php echo link_tag( 'css/bootstrap.css' ) ?>
		<?php echo link_tag( 'css/bootstrap.min.css' ) ?>
		<?php echo link_tag( 'css/prettify.css' ) ?>
		<?php echo link_tag( 'css/style.css' ) ?>
		<?php echo link_tag( 'css/dataTables/jquery.dataTables.css' ) ?>

		<script src="<?=base_url('js/jquery-1.9.0.js')?>"> </script>
		<script src="<?=base_url('js/bootstrap.js')?>"> </script>
		<script src="<?=base_url('js/jquery.dataTables.js')?>"> </script>

		<!--<link rel="stylesheet" type="text/css" media="screen" 
		href="<?= base_url()?>css/bootstrap.min.css"/>

		<link rel="stylesheet" type="text/css" media="screen" 
		href="<?= base_url()?>css/bootstrap-responsive.min.css"/>-->

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<![endif]-->

		<!-- Styles -->
		<style type="text/css">
			body {
				padding-top: 60px;
				/*padding-bottom: 40px;*/
			}
			.sidebar-nav {
				padding: 9px 0;
			}

			@media (max-width: 980px) {
				/* Enable use of floated navbar text */
				.navbar-text.pull-right {
					float: none;
					padding-left: 5px;
					padding-right: 5px;
				}
			}
		</style>
	</head>
	<body>
		<!--Header-->
		<header>
			<!--Nav var-->
			<div class="navbar navbar-inverse navbar-fixed-top" >
				<div class="navbar-inner">
					<div class="container-fluid">
						<a class="brand" href="#">Botanitas</a>
						<!--<?= $menu_principal; ?>-->
						<div class='nav-collapse collapse'> 
							<ul class="nav pull-right">
              					<li>
              						<a href="<?=base_url();?>login/logout" id="cerrar" role="button" >Cerrar sesión</a>
              					</li>
							</ul>
							<p class="navbar-text pull-right">
              					Bienvenido
              					<?=$this->session->userdata['user']['nombre'];?>
            				</p>
							<ul class='nav'>
								<li class="active"> <a href='<?=base_url();?>chofer-vendedor/index'>Inicio</a></li>
								<li> <a href='<?=base_url();?>chofer-vendedor/acercaDe'>Acerca de</a></li>
								<li> <a href='<?=base_url();?>chofer-vendedor/contacto'>Contacto</a></li>
							</ul>
							
						</div>
					</div>
				</div>
			</div>
			<!--Fin de nav var-->
		</header>
		<!--Fin de header-->
		
		<!--Sub nav var-->
		<div class="navbar">
            <!--<?= $menu_secundario; ?>-->
            <div class='navbar-inner'>
				<ul class='nav pull-right'>
					<li> <a href='<?=base_url();?>chofer-vendedor/ventas/index'>Ventas</a></li>
					<li> <a href='<?=base_url();?>chofer-vendedor/inventario/index'>Inventario</a></li>
					<li> <a href='<?=base_url();?>chofer-vendedor/clientes/index'>Clientes</a></li>
				</ul>
			</div>
        </div>
		<!--Fin sub nav var-->

		<!--Contenedor principal-->
		<div class="container-fluid" >
			<div class="row-fluid">
				<!--Span 3-->
				<div class="span3">
				  <!--Sidebar-->
		          <aside class="well sidebar-nav">
		          	<?= $sidebar ?>
		          </aside>
		          <!--Fin sidebar-->
		        </div>
		        <!--Fin span 3-->
		        <div class="span9">
		          <div class="well">    
				   	<?= $output; ?>
				  </div>
		        </div>
			</div>
		</div>
		<!--Fin de contenedor principal-->
		
		<!--Footer-->
		<hr>
		<footer class="footer">
			<div class="container">
				<p>
					© Company 2013
				</p>
			</div>

			<style>
				.footer {
					text-align: center;
					padding: 30px 0;
					margin-top: 70px;
					border-top: 1px solid #e5e5e5;
					background-color: #f5f5f5;
				}
			</style>
		</footer>
		<!--Fin footer-->
		
	</body>

</html>