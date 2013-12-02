<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rutas extends My_Controller {

	function __construct() {
		parent::__construct(true);
		$this->load->library('menu');
		$this->load->model("ruta_model","ruta");
		$this->load->model("user_model","user");
		$this->load->model("municipio_model","municipio");
		$this->setLayout('jefeVentas');
	}

	public function index($pag = null){
		if ($this->session->userdata['user']['perfil'] != '1'){
			if ($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '3'){
				redirect(base_url().'login');
			}
		}
		
		$data['rutas'] = $this->ruta->getRutas();	
		$data['sidebar'] = $this -> menu -> construirSidebar(
		array('Rutas', 'Roles', 'Asignar Clientes a un rol'), 
		'',
		'jefeVentas',
		array('rutas','roles','clienteRol'));

		$this->load->view('jefeVentas/rutas/index', $data);
	}

	public function create($id = null){

		if ( $this->input->post() ){
			$ruta = new ruta_model();
			$ruta['idMunicipio'] = $this->input->post("municipio");
			$ruta['nombre_ruta'] = $this->input->post("nombre_ruta");
			$ruta['idUsuario'] = $this->input->post("chofer");
			if ( $ruta->save() ){

				redirect('jefeVentas/rutas');

			}
		}

		$data['mun'] = $this->municipio->getMunicipios();
		$data['nombres'] = $this->user->getChoferes();	
		$data['rutas'] = $this->ruta->getRutas();	
		$data['sidebar'] = $this -> menu -> construirSidebar(
		array('Rutas', 'Roles', 'Asignar Clientes a un rol'), 
		'',
		'jefeVentas',
		array('rutas','roles','clienteRol'));
		$this->load->view("jefeVentas/rutas/create", $data);
	}

	public function update($id = null){
		//municipio
		$data['ruta'] = $this->ruta->getByIdAsArray($id);
		if (is_null($id)){
			redirect("jefeVentas/rutas");
		}
		if ( $this->input->post() ){

			$r = new Ruta_model();
			$r['idRuta'] = $id;
			$r['idMunicipio'] = $this->input->post("municipio");
			$r['nombre_ruta'] = $this->input->post("nombre_ruta");
			$r['idUsuario'] = $this->input->post("chofer");

			if ( $r->save() ){

				redirect('jefeVentas/rutas');

			}
		}
		$data['mun'] = $this->municipio->getMunicipios();
		$data['nombres'] = $this->user->getChoferes();	
		$data['rutas'] = $this->ruta->getRutas();	
		$data['sidebar'] = $this -> menu -> construirSidebar(
		array('Rutas', 'Roles', 'Asignar Clientes a un rol'), 
		'',
		'jefeVentas',
		array('rutas','roles','clienteRol'));
		$this->load->view("jefeVentas/rutas/update", $data);
	}

	public function delete($id = null){
		$this->ruta['idRuta'] = $id;
		if ( $this->ruta->delete() ){

		}
		redirect("jefeVentas/rutas");
	}	
}
