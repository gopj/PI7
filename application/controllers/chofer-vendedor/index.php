<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {

	function __construct() {
		parent::__construct(true);
		
		$this->setLayout('chofer_vendedor');

		//cargamos la libreria
		$this->load->library('menu');
	}
	public function index(){
		if ($this->session->userdata['user']['perfil'] != '1'){
			if ($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '2'){
				redirect(base_url().'login');
			}
		}

		/*echo "<pre>";
		print_r( $this->session->userdata);
		print($this->session->userdata['user']['perfil']);
		print($this->session->userdata['user']['idUsuario']);
		echo "</pre>";*/

		//construimos nuestro sidebar
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Ventas', 'Inventario','Clientes'), //opciones sidebar
			'', //opcion seleccionada
			'chofer-vendedor', //submenu actual, en este caso el index
			array('ventas','inventario','clientes'));

		$data['output'] = $this->load->view('chofer-vendedor/index/index', $data, true);

		$this->load->view('chofer-vendedor/index/index', $data);
		
	}

	
}