<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bajas extends My_Controller {

	public function __construct() {
		parent::__construct();
		$this->setLayout('gerenteVentas');
		$this -> load -> library('menu');
		$this->load->model('gerenteVentas/reporte_model','reporte');
	}

	//el index de ventas del usuario chofer vendedor
	public function index($data = null) {
		if ($this->session->userdata['user']['perfil'] != '1'){
			if ($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '5'){
				redirect(base_url().'login');
			}
		}


		$this->setLayout('gerenteVentas');

		//cargamos la libreria
		

		//construimos nuestro sidebar
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Productos dados de baja por caducidad'), 
			'',
			'gerenteVentas/bajas',
			array('bajaXcaducidad'));
		
		
		$this->load->view('gerenteVentas/bajas/index', $data);
	}

	public function bajaXcaducidad(){
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Productos dados de baja por caducidad'), 
			'',
			'gerenteVentas/bajas',
			array('bajaXcaducidad'));
		$data['infor'] = "";
		$this->load->view('gerenteVentas/bajas/bajasXcaducidad', $data);
	}

	public function reporteBajaXcaducidad(){
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Productos dados de baja por caducidad'), 
			'',
			'gerenteVentas/bajas',
			array('bajaXcaducidad'));

		if ( $this->input->post() ){
			$fecha = $this->input->post("fecha");
			$data['reportes'] = $this->reporte->bajasXcaducidad($fecha);
			if (!$data['reportes']){
				$data['infor'] = '<h5>No hay registro de mermas en la fecha indicada, intente con otra fecha.</h5>';
				$this->load->view('gerenteVentas/bajas/bajasXcaducidad', $data);
			}else{
				$this->load->view('gerenteVentas/bajas/re', $data);
			}			
		}else{
			redirect('gerenteVentas/bajas');
		}
	}
}
?>