<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ventas extends My_Controller {

	function __construct() {
		parent::__construct(true);
		//cargamos la libreria
		$this -> load -> library('menu');
		$this->load->library('table');

		//cargamos nuestros modelos 
		$this -> load -> model('chofer-vendedor/ventas_model', 'ventas');
		$this -> load -> model('chofer-vendedor/inventario_model', 'inventario');
		$this -> load -> model('chofer-vendedor/clientes_model', 'cliente');

		$this->setLayout('chofer_vendedor');

	}

	//el index de ventas del usuario chofer vendedor
	public function index() {
		if ($this->session->userdata['user']['perfil'] != '1'){
			if ($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '2'){
				redirect(base_url().'login');
			}
		}

		//obtenemos segmento de la url, una parte de la url, el id de venta
		$data['idVenta'] = $this->uri->segment(4);

		//construimos nuestro sidebar
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Crear venta'), //opciones sidebar
			'', //opcion seleccionada
			'chofer-vendedor/ventas', //submenu actual, en este caso ventas
			array('crearVenta'));		
 		
		if(!$data['idVenta']){
			//obtenemos las ventas y las mostramos
			$data['ventas'] = $this->ventas->getVentas();
		}
		else{
			$data['ventas'] = $this->ventas->getVenta($data['idVenta']);
			$data['detalleVenta'] = $this->ventas->getDetalleVenta($data['idVenta']);
		}

		$data['output'] = $this->load->view('chofer-vendedor/ventas/index', $data, true);
		
		$this->load->view('chofer-vendedor/ventas/index', $data);

	}
	public function crearVenta() {
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Crear venta'), //opciones sidebar
			'Crear venta', //opcion seleccionada
			'chofer-vendedor/ventas', //submenu actual, en este caso ventas
			array('crearVenta'));

		//datos del usuario actual, y fecha
		$data['usuario'] = $this->session->userdata['user']['idUsuario'];
		$data['fecha'] = date( 'Y-m-d');

		//obtenemos los clientes 
		$data['clientes'] = $this->cliente->getClientesChofer($data);

		//obtenemos los productos del chofer actual
		$data['productos'] = $this -> inventario -> getProductosChofer($data);

		$data['todosProductos'] = $this -> inventario -> getProductosCaducados();

		$data['output'] = $this -> load -> view('chofer-vendedor/ventas/crearVenta', $data, true);
		
		$this->load->view('chofer-vendedor/ventas/crearVenta', $data);
	}

	//esta funcion recibe los datos del formulario crear venta 
	function recibirdatosVenta(){

		if (isset($_POST['productos']) && isset($_POST['cliente']) && 
			isset($_POST['cantidadComprar'])) {
			
			//datos sobre el detalle de la venta 
			$arrayProductos = $this->input->post('productos');
			$arrayCantidad = $this->input->post('cantidadComprar'); 

			//datos sobre la venta	
			$usuario = $this->session->userdata['user']['idUsuario'];
			$cliente = $this->input->post("cliente");
			$fechaVenta = date( 'Y-m-d');
			$totalVenta = $this->ventas->obtenerTotalProductos($arrayProductos,$arrayCantidad);

			//agegamos la venta, y obtenemos el id de la venta 
			$idVenta = $this->ventas->agregarVenta($usuario, $cliente,$fechaVenta,$totalVenta);

			//agregamos los detalles de venta 
			$this->ventas->agregarDetalleVenta($idVenta, $arrayProductos, $arrayCantidad);

			if (isset($_POST['productosT']) && isset($_POST['cantidadCaducados'])){
				//productos caducados 
				$arrayProductosCad = $this->input->post('productosT');
				$arrayCantidadCad = $this->input->post('cantidadCaducados'); 

				//obtenemos la salida del chofer 
				$idSalida = $this->ventas->getSalida($usuario,$fechaVenta);
				//agregamos los productos caducados
				
				$this->ventas->agregarMerma($arrayProductosCad, $arrayCantidadCad,$idSalida);
			}
				
			//redireccionamos a ventas 
			redirect('chofer-vendedor/ventas');

		}else{
			//no se han seleccionado los campos completos 
			redirect('chofer-vendedor/ventas/crearVenta');			 
		}

	}

}
?>