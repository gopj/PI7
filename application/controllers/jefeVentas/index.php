<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('menu');
		$this->setLayout('jefeVentas');
	}
	public function index(){
		if ($this->session->userdata['user']['perfil'] != '1'){
			if ($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '3'){
				redirect(base_url().'login');
			}
		}
		
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Rutas', 'Roles', 'Asignar Clientes a un rol'), 
			'',
			'jefeVentas',
			array('rutas','roles', 'clienteRol'));

		$this->load->view('jefeVentas/index/index', $data);
	}

	
}