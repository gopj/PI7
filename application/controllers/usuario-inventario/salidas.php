<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Salidas extends My_Controller {

	function __construct() {
		parent::__construct(true);
		//cargamos la libreria
		$this -> load -> library('menu');
		$this->load->model('usuario-inventario/salidas_model','salidas');
		$this->load->model('usuario-inventario/productos_model','productos');
		$this->load->model('user_model','usuarios');

		$this->setLayout('usuario_inventario');

	}

	/**
	 * La funcion index de la vista de inventario, muestra las salidas de producto de los choferes 
	 * @return [type] [no regresa nada]
	 */
	public function index() {
		if ($this->session->userdata['user']['perfil'] != '1'){
			if ($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '4'){
				redirect(base_url().'login');
			}
		}

		//obtenemos segmento de la url, una parte de la url, el id de venta
		$data['idSalida'] = $this->uri->segment(4);

		//construimos nuestro sidebar
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Registrar salida'), //opciones sidebar
			'', //opcion seleccionada
			'usuario-inventario/salidas', //submenu actual, en este caso ventas
			array('registrarSalida'));

		if(isset($_POST['idSalida'])){
			//hay que modificar el status
			$data['idSalida'] = $this->input->post('idSalida');
			$data['salidas'] = $this->salidas->getSalida($data['idSalida']);
			$data['detalleSalida'] = $this->salidas->getDetalleSalida($data['idSalida']);

			//para descontar los productos que vendio el chofer del inventario
			foreach ($data['detalleSalida']->result() as $detalle):
				$cantidad = ($detalle->cantidadLleva-$detalle->cantidadRegreso);
				$this->salidas->modificarCantidadProducto($detalle->idProducto,$cantidad);
			endforeach;

			//modificamos el status, para saber q ya se cotejo, ponemos el status en 0
			$this->salidas->modificarStatusSalida($data['idSalida'], 0); 
		}

		if(!$data['idSalida']){
			//obtenemos las salidas de todos los choferes 
			$data['salidas'] = $this->salidas->getSalidas();
		}
		else{
			$data['salidas'] = $this->salidas->getSalida($data['idSalida']);
			$data['detalleSalida'] = $this->salidas->getDetalleSalida($data['idSalida']);

		}

		//para descontar los productos que vendio el chofer del inventario
			if(isset($_POST['cantidadLleva']) && isset($_POST['cantidadRegreso'])
				&& isset($_POST['idProducto'])){
				$cantidadLleva = $this->input->post('cantidadLleva');
				$cantidadRegreso = $this->input->post('cantidadRegreso');
				$idProducto = $this->input->post('idProducto');
				$cantidad = 0;
				redirect('hola');
				for ($i=0; $i < count($idProducto); $i++) {
					$cantidad = ($cantidadLleva[$i]-$cantidadRegreso[$i]);
					$this->salidas->modificarCantidadProducto($idProducto[$i],$cantidad);
				} 
			}		

		$data['output'] = $this->load->view('usuario-inventario/salidas/index', $data, true);
		
		$this->load->view('usuario-inventario/salidas/index', $data);

	}

	/**
	 * Esta funcion nos permite registrar una salida de inventario
	 * @return [type] [description]
	 */
	public function registrarSalida(){
		if ( $this->input->post() ){
			if ( 
				isset($_POST['fechaSalida']) && 
				isset($_POST['productos']) && 
				isset($_POST['cantidadAsignar']) ) {

				//obtenemos los datos de la salida y su detalle
				$salida['idUsuario'] = $this->input->post("chofer");
				$salida['fechaSalida'] = ($this->input->post("fechaSalida"));

				$salida['productos'] = $this->input->post("productos");
				$salida['cantidades'] = $this->input->post("cantidadAsignar");

				//registramos la salida, obtenemos el id de la salida 
				$idSalida = $this->salidas->agregarSalida($salida['idUsuario'],$salida['fechaSalida']);

				//registramos el detalle de la salida 				
				$this->salidas->agregarDetalleSalida($salida['productos'],$salida['cantidades'],$idSalida);
				
				//redireccionamos a la vista productos
				redirect('usuario-inventario/salidas/index');
			}else{
				redirect('usuario-inventario/salidas/registrarSalida');
			}
		}

		//construimos nuestro sidebar
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Registrar salida'), //opciones sidebar
			'', //opcion seleccionada
			'usuario-inventario/salidas', //submenu actual, en este caso ventas
			array('registrarSalida'));

		$data['choferes'] = $this->usuarios->getChoferes();

		//obtenemos los productos 
		$data['productos'] = $this->productos->getProductos();		

		$data['output'] = $this->load->view('usuario-inventario/salidas/registrarSalida', $data, true);
		
		$this->load->view('usuario-inventario/salidas/registrarSalida', $data);
	}

}
?>
