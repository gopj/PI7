<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ClienteRol extends My_Controller {

	function __construct() {
		parent::__construct(true);
		$this->load->library('menu');
		$this->load->model("rol_model","rol");
		$this->load->model("ruta_model","ruta");
		$this->load->model("municipio_model", "municipio");
		$this->load->model("cliente_model","cliente");
		$this->load->model("jefeVentas/rolCliente_model","rolCliente");
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
		$this->load->view('jefeVentas/clienteRol/index', $data);

		
	}

	public function asignar($id = null){
		$data['sidebar'] = $this -> menu -> construirSidebar(
		array('Rutas', 'Roles', 'Asignar Clientes a un rol'), 
		'',
		'jefeVentas',
		array('rutas','roles','clienteRol'));
		$municipio = $this-> municipio -> getMunicipioRol($id);
		$dia = $this -> rol ->getRolDia($id);
		$data['clientes'] = $this -> cliente -> getClientesLibres($municipio, $dia);
		$this->load->view('jefeVentas/clienteRol/asignacion',$data);
	}

	public function listarClientes($id = null){
		$data['sidebar'] = $this -> menu -> construirSidebar(
		array('Rutas', 'Roles', 'Asignar Clientes a un rol'), 
		'',
		'jefeVentas',
		array('rutas','roles','clienteRol'));
		$data['clientes'] = $this -> cliente -> getClientesRol($id);
		$this->load->view('jefeVentas/clienteRol/listar',$data);
	}

	public function delete($id = null){ 
		$c = $this -> rolCliente -> getClienteIdFromRol_cliente($id);

		$client = new Cliente_model();

		$client['idCliente'] = $c;
		$client['asignado'] = 0;
		
		if ( $client->save() ){
			$this->rolCliente['idRol_cliente'] = $id;
			if ( $this->rolCliente->delete() ){
				redirect('jefeVentas/clienteRol');
			}else{
				redirect('jefeVentas/clienteRol');
			}
		}
	}

	
	public function hacerAsignar($id = null){

		if (isset($_POST['clientes']) ) {			

			$clientes = $_POST["clientes"];
			$this -> rolCliente -> insertClienteRol($clientes, $id);
			redirect('jefeVentas/clienteRol');

		}else{
			redirect('jefeVentas/clienteRol/asignar/'.$id);			 
		}

	}
		
}