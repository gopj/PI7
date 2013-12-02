<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends My_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){

		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$this->load->model("User_model", "user");

			if($this->user->identificar($this->input->post('usuario'), $this->input->post('clave'))){
				// Preparar informacion para la sesion
				$user = array(
					'idUsuario' => $this->user['idUsuario'],
					'nombre' => $this->user['nombre_usuario'],
					'perfil' => $this->user['idTipo_usuario']
				);

				$this->session->set_userdata('user', $user);
				
				switch ($this->session->userdata['user']['perfil']){
					case '1':
						redirect("admin/index/");
						break;					
					case '2':
						redirect("chofer-vendedor/index/");
						break;
					case '3':
						redirect("jefeVentas/index");
						break;
					case '4':
						redirect("usuario-inventario/index/");
						break;
					case '5':
						redirect("gerenteVentas/index/");
						break;
						
				}
	

			} else {
				// Mostrar motivo de error

			}
		}

		$this->load->view('login/index');
	}


	public function logout(){
		$this->session->sess_destroy();
		redirect("index");
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */