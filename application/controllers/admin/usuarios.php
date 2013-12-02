<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends My_Controller {

	function __construct() {
		parent::__construct(true);

		$this->load->model("user_model","user");
		$this->load->model("perfil_model","perfil");
		$this->load->model("producto_model", "producto");

		$this->setLayout('admin');
	}

	public function index($pag = null){
		
		if($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '1'){
			redirect(base_url().'login');
		}
		
		$data['users'] = $this->user->getUsers();	

		$this->load->view('usuarios/index', $data);
	}

	public function create($id = null){

		if ( $this->input->post() ){

			$user = new User_model();

			$user['nombre_usuario'] = $this->input->post("nombre_usuario");
			$user['clave'] = MD5($this->input->post("clave"));
			$user['idTipo_usuario'] = $this->input->post("idTipo_usuario");
			$user['status'] = 1;
			if ( $user->save() ){

				redirect('admin/usuarios');

			}
		}

		$perfil = new Perfil_model();

		$data['perfil'] = $this->perfil->getByIdAsArray($id);
		$data['perfiles'] = $this->perfil->getAllToSelect();

		$this->load->view("usuarios/create", $data);
	}

	public function update($id = null){
		$data['user'] = $this->user->getByIdAsArray($id);
		if (is_null($id)){
			redirect("admin/productos");
		}


		if ( $this->input->post() ){

			$user = new User_model();

			$user['idUsuario'] = $id;
			$user['idTipo_usuario'] = $this->input->post("idTipo_usuario");
			$user['nombre_usuario'] = $this->input->post("nombre_usuario");
			$user['clave'] = MD5($this->input->post("clave"));
			$user['status'] = $this->input->post("estado");

			if ( $user->save() ){

				redirect('admin/usuarios');

			}
		}

		$perfil = new Perfil_model();

		$data['perfil'] = $this->perfil->getByIdAsArray($id);
		$data['perfiles'] = $this->perfil->getAllToSelect();

		$this->load->view("usuarios/update", $data);
	}

	public function delete($id = null){
		$usr = new User_model();

		$usr['idUsuario'] = $id;
		$usr['status'] = 0;

		if ( $usr->save() ){
			redirect('admin/usuarios');
		}
	}		
}
