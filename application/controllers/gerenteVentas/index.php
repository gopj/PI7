<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('menu');
		$this->setLayout('gerenteVentas');
	}
	public function index(){
		if ($this->session->userdata['user']['perfil'] != '1'){
			if ($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '5'){
				redirect(base_url().'login');
			}
		}
		
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Ventas', 'Bajas de inventario'), 
			'',
			'gerenteVentas',
			array('ventas','bajas'));

		$this->load->view('gerenteVentas/index/index', $data);
	}

	
}