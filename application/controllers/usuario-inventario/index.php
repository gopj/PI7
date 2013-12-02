<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {

	function __construct() {
		parent::__construct(true);
		
		$this->setLayout('usuario_inventario');

		//cargamos la libreria
		$this->load->library('menu');
	}
	public function index(){
		if ($this->session->userdata['user']['perfil'] != '1'){
			if ($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '4'){
				redirect(base_url().'login');
			}
		}

		//construimos nuestro sidebar
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Productos', 'Salidas'), //opciones sidebar
			'', //opcion seleccionada
			'usuario-inventario', //submenu actual, en este caso el index
			array('productos','salidas'));

		$data['output'] = $this->load->view('usuario-inventario/index/index', $data, true);

		$this->load->view('usuario-inventario/index/index', $data);
		
	}

	
}