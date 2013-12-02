<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Municipios extends My_Controller {

	function __construct() {
		parent::__construct(true);
		
		$this->load->model("municipio_model","municipio");
		$this->setLayout('admin');
	}

	public function index($pag = null){

		if($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '1'){
			redirect(base_url().'login');
		}
		
		$data['municipios'] = $this->municipio->getAll();	

		$this->load->view('municipios/index', $data);
	}

	public function delete($id = null){
		$this->municipio['idMunicipio'] = $id;
		if ( $this->municipio->delete() ){

		}
		redirect("admin/municipios");
	}	

	public function create($id = null){
	
		if ( $this->input->post() ){

			$m = new Municipio_model();

			$m['nombre'] = $this->input->post("nombre");
			
			if ( $m->save() ){

				redirect('admin/municipios');

			}
		}
		$this->load->view("municipios/create");	
		
	}	

	public function update($id = null){
		$data['mun'] = $this->municipio->getByIdAsArray($id);
		if (is_null($id)){
			redirect("admin/municipios");
		}


		if ( $this->input->post() ){

			$m = new Municipio_model();

			$m['idMunicipio'] = $id;
			$m['nombre'] = $this->input->post("nombre");

			if ( $m->save() ){

				redirect('admin/municipios');

			}
		}
		$this->load->view("municipios/update", $data);	
	}	

	
}