<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends My_Controller {
	function __construct() {
		parent::__construct(true);
		$this->load->helper('form');

		//cargamos nuestros modelos 
		$this->load->model('chofer-vendedor/clientes_model','clientes');
		$this->load->model('municipio_model','municipio');
		
		//cargamos nuestra librerias
		$this -> load -> library('menu');

		//cargamos nuestros modelos
		$this->setLayout('chofer_vendedor');

	}

	//el index de ventas del usuario chofer vendedor
	public function index() {

		if ($this->session->userdata['user']['perfil'] != '1'){
			if ($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '2'){
				redirect(base_url().'login');
			}
		}

		//construimos nuestro sidebar
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Agregar cliente'), //opciones sidebar
			'', //opcion seleccionada
			'chofer-vendedor/clientes', //submenu actual, en este caso ventas
			array('agregarCliente'));

		$data['segmento'] = $this->uri->segment(3);

		$data['usuario'] = $this->session->userdata['user']['idUsuario'];
		
		//obtenemos los productos del chofer actual 
		$data['clientesChofer'] = $this->clientes->getClientesChofer($data);
		
		$data['output'] = $this->load->view('chofer-vendedor/clientes/index', $data, true);
		
		$this->load->view('chofer-vendedor/clientes/index', $data);

	}

	//funcion que nos permite agregar un cliente 
	public function agregarCliente(){
		//construimos nuestro sidebar
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Agregar cliente'), //opciones sidebar
			'Agregar Cliente', //opcion seleccionada
			'chofer-vendedor/clientes', //submenu actual, en este caso ventas
			array('agregarCliente'));

		$data['perfil'] =  $this->session->userdata['user']['perfil'];
		$data['perfiles'] = $this->municipio->getAllToSelect();
		
		$data['output'] = $this->load->view('chofer-vendedor/clientes/agregarCliente', $data, true);
		
		$this->load->view('chofer-vendedor/clientes/agregarCliente', $data);

	}

	//funcion que recibe los datos del formulario agregar cliente
	public function recibirdatosCliente(){
		if (($_POST['nombre']!='') && ($_POST['direccion']!='') && ($_POST['municipio']!='')) {
			//datos para agregar un cliente
			$nombre = $this->input->post("nombre");
			$direccion = $this->input->post("direccion");
			$idMunicipio = $this->input->post("municipio");
			$dia = $this->input->post("diaVisita");

			//obtenemos el id cliente, del cliente recien agregado
			$idCliente = $this->clientes->agregarCliente($nombre, $direccion, 
				$idMunicipio,$dia);

			if($idCliente != false) {
				//si queremos q el cliente se le asigne al chofer, descomentar 
				//las dos lineas de abajo
				//$idUsuario =  $this->session->userdata['user']['idUsuario'];
				//$this->cliente->agregarClienteARol($idCliente, $idUsuario);
				
				//redireccionamos a la vista clientes
				redirect('chofer-vendedor/clientes');
			}else{
				//si else, hubo error al agregar
				redirect('chofer-vendedor/clientes/agregarCliente');
			}

		}else{
			//no se han seleccionado los campos completos 
			redirect('chofer-vendedor/clientes/agregarCliente');			 
		}

	}
}

?>