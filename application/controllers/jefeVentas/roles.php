<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends My_Controller {

	function __construct() {
		parent::__construct(true);
		$this->load->library('menu');
		$this->load->model("rol_model","rol");
		$this->load->model("ruta_model","ruta");
		$this->setLayout('admin');
		$this->setLayout('jefeVentas');
	}

	public function index($pag = null){
		if ($this->session->userdata['user']['perfil'] != '1'){
			if ($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '3'){
				redirect(base_url().'login');
			}
		}
		
		$data['roles'] = $this->rol->getRoles();	
		$data['rutas'] = $this->ruta->getRutas();	
		$data['sidebar'] = $this -> menu -> construirSidebar(
		array('Rutas', 'Roles', 'Asignar Clientes a un rol'), 
		'',
		'jefeVentas',
		array('rutas','roles','clienteRol'));
		$this->load->view('jefeVentas/roles/index', $data);
	}

	public function create($id = null){

		if ( $this->input->post() ){

			$r = new rol_model();

			$r['idRuta'] = $this->input->post("ruta");
			$r['dia'] = $this->input->post("rol");
			if ( $r->save() ){

				redirect('jefeVentas/roles');

			}
		}

		

		$data['id'] = $this->ruta->getByIdAsArray($id);
		$data['nombre'] = $this->ruta->getAllToSelect();
		$data['rutas'] = $this->ruta->getRutas();	
		$data['sidebar'] = $this -> menu -> construirSidebar(
		array('Rutas', 'Roles', 'Asignar Clientes a un rol'), 
		'',
		'jefeVentas',
		array('rutas','roles','clienteRol'));

		$this->load->view("jefeVentas/roles/create",$data);
	}

	public function update($id = null){
		$data['rol'] = $this->rol->getByIdAsArray($id);
		if (is_null($id)){
			redirect("jefeVentas/roles");
		}
		if ( $this->input->post() ){

			$ro = new Rol_model();

			$ro['idRol'] = $id;
			$ro['dia'] = $this->input->post("nombre_rol");
			$ro['idRuta'] = $this->input->post("nombreRuta");

			if ( $ro->save() ){

				redirect('jefeVentas/roles');

			}
		}

		$data['perfil'] = $this->ruta->getByIdAsArray($id);
		$data['perfiles'] = $this->ruta->getAllToSelect();
		$data['rutas'] = $this->ruta->getRutas();	
		$data['sidebar'] = $this -> menu -> construirSidebar(
		array('Rutas', 'Roles', 'Asignar Clientes a un rol'), 
		'',
		'jefeVentas',
		array('rutas','roles','clienteRol'));
		$this->load->view("jefeVentas/roles/update", $data);
	}

	public function delete($id = null){
		$this->rol['idRol'] = $id;
		if ( $this->rol->delete() ){

		}
		redirect("jefeVentas/roles");
	}	
}