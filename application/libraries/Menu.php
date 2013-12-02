<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/*Clase que nos ayuda a construir un menu a partir de un array con las opciobes del menu*/
	class Menu{
		//private $array_menu;
		public function __construct(){
			
		}

		function construirMenuPrincipal($array,$vistaActual){
			$menu = "<div class='nav-collapse collapse'> 
						<ul class='nav'>";
			foreach($array as $opcion){
				if($opcion==$vistaActual){
					$menu .= "<li class='active'> <a href='#'>" . $opcion ."</a></li>";
				}
				else{
					$menu .= "<li> <a href='#'>" . $opcion ."</a></li>";
				}
			}
			$menu .= "</ul>
					</div>";

			return $menu;
		}

		function construirMenuSecundario($array,$opcionActual){
			$menu = "<div class='navbar-inner'>
						<ul class='nav pull-right'>";
			foreach($array as $opcion){
				if($opcion==$opcionActual){
					$menu .= "<li class='active'> <a href='#''>" . $opcion ."</a></li>";
				}
				else{
					$menu .= "<li> <a href='#''>" . $opcion ."</a></li>";
				}
			}
			$menu .= "</ul>
					</div>";

			return $menu;
		}

		function construirSidebar($array,$opcionActual,$subMenu,$arrayMetodos){
		    $side = "<ul class='nav nav-list'>";
		    $side .= "<li class='nav-header'>Opciones</li>";
		    $i=0;
		   $base = base_url();
			foreach($array as $opcion){
				if($opcion==$opcionActual){
					$side .= "<li class=''> <a href='".$base."
					". $subMenu . "/" . $arrayMetodos[$i] ."'>" . $opcion ."</a></li>";
				}
				else{
					$side .= "<li class=''> <a href='".$base."
					". $subMenu . "/" . $arrayMetodos[$i] ."'>" . $opcion ."</a></li>";
				}
				$i+=1; //incrementamos leer el otro metodo del link
			}
			$side .= "</ul>";

			return $side;
		}

	} 

?>