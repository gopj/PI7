<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ventas extends My_Controller {

	function __construct()  {
		parent::__construct(true);
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
		
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Venta diaria por producto', 'Venta diaria por chofer','Ventas mensuales'), 
			'',
			'gerenteVentas/ventas',
			array('ventaDiariaXproducto', 'diariaXchofer', 'mensuales'));		
		$this->load->view('gerenteVentas/ventas/index', $data);
	}

	public function ventaDiariaXproducto(){
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Venta diaria por producto', 'Venta diaria por chofer','Ventas mensuales'), 
			'',
			'gerenteVentas/ventas',
			array('ventaDiariaXproducto', 'diariaXchofer', 'mensuales'));
		$data['infor'] = "";
		$this->load->view('gerenteVentas/ventas/ventaDiariaXproducto', $data);
	}

	public function reporteVentaDiariaXproducto(){
		$data['sidebar'] = $this -> menu -> construirSidebar(
		array('Venta diaria por producto', 'Venta diaria por chofer','Ventas mensuales'), 
		'',
		'gerenteVentas/ventas',
		array('ventaDiariaXproducto', 'diariaXchofer', 'mensuales'));


		if ( $this->input->post() ){
			$fecha = $this->input->post("fecha");
			$data['reportes'] = $this->reporte->ventaDiariaProducto($fecha);
			if (!$data['reportes']){
				$data['infor'] = '<h5>No hay registro de ventas en la fecha indicada, intente con otra fecha.</h5>';
				$this->load->view('gerenteVentas/ventas/ventaDiariaXproducto', $data);
			}else{
				$this->load->view('gerenteVentas/ventas/re', $data);
			}			
		}else{
			redirect('gerenteVentas/ventas');
		}
	}

	public function diariaXchofer(){
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Venta diaria por producto', 'Venta diaria por chofer','Ventas mensuales'), 
			'',
			'gerenteVentas/ventas',
			array('ventaDiariaXproducto', 'diariaXchofer', 'mensuales'));
			$data['infor'] = "";
		$this->load->view('gerenteVentas/ventas/diariaXchofer', $data);
	}

	public function reporteDiariaXchofer(){
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Venta diaria por producto', 'Venta diaria por chofer','Ventas mensuales'), 
			'',
			'gerenteVentas/ventas',
			array('ventaDiariaXproducto', 'diariaXchofer', 'mensuales'));
			$data['infor'] = "";
		if ( $this->input->post() ){
			$fecha = $this->input->post("fecha");
			$data['reportes'] = $this->reporte->ventasXchofer($fecha);
			if (!$data['reportes']){
				$data['infor'] = '<h5>No hay registro de ventas en esta fecha.</h5>';
				$this->load->view('gerenteVentas/ventas/diariaXchofer', $data);
			}else{
				$this->load->view('gerenteVentas/ventas/reporteVentasXchofer', $data);
			}			
		}else{
			redirect('gerenteVentas/ventas');
		}	
	}

	public function mensuales(){
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Venta diaria por producto', 'Venta diaria por chofer','Ventas mensuales'), 
			'',
			'gerenteVentas/ventas',
			array('ventaDiariaXproducto', 'diariaXchofer', 'mensuales'));
		$data['infor'] = "";
		$this->load->view('gerenteVentas/ventas/mensuales', $data);
	}


	public function reporteMensuales(){
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Venta diaria por producto', 'Venta diaria por chofer','Ventas mensuales'), 
			'',
			'gerenteVentas/ventas',
			array('ventaDiariaXproducto', 'diariaXchofer', 'mensuales'));
		
		if ( $this->input->post() ){
			$year = $this->input->post("year");
			$month = $this->input->post("mes");
			$fecha = $year . $month;

			$data['reportes'] = $this->reporte->ventasMensuales($fecha);
			if (!$data['reportes']){
				$data['infor'] = '<h5>No hay registro de ventas mensuales para la solicitud.</h5>';
				$this->load->view('gerenteVentas/ventas/mensuales', $data);
			}else{
				$this->load->view('gerenteVentas/ventas/reporteMensual', $data);
			}			
		}else{
			redirect('gerenteVentas/ventas');
		}
	}
}
?>