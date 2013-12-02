<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends My_Controller {

	function __construct() {
		parent::__construct(true);
		
		$this->load->model("producto_model", "producto");

		$this->setLayout('admin');
	}

	public function index($pag = null){
		
		if($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '1'){
			redirect(base_url().'login');
		}
		
		$data['productos'] = $this->producto->getAll();

		$this->load->view('productos/index', $data);
	}

	public function create(){
		if ( $this->input->post() ){

			$product = new Producto_model();

			$product['nombre_producto'] = $this->input->post("nombre_producto");
			$product['presentacion'] = ($this->input->post("presentacion"));
			$product['precio_fabrica'] = $this->input->post("precio_fabrica");
			$product['precio_publico'] = $this->input->post("precio_publico");
			$product['status'] = 1;
			$product['cantidad'] = $this->input->post("cantidad");
			$product['fecha_caducidad'] = $this->input->post("caducidad");

			if ( $product->save() ){
				redirect('admin/productos');
			}
		}

		$this->setLayout('blank');

		$this->load->view("productos/create");
	}	

	public function update($id = null){
		$data = array();

		$data['producto'] = $this->producto->getByIdAsArray($id);

		if (is_null($id)){
			redirect("admin/productos");
		}



		if ( $this->input->post() ){
			$product = new Producto_model();

			$product['idProducto'] = $id;
			$product['nombre_producto'] = $this->input->post("nombre_producto");
			$product['presentacion'] = $this->input->post("presentacion");
			$product['precio_fabrica'] = $this->input->post("precio_fabrica");
			$product['precio_publico'] = $this->input->post("precio_publico");
			$product['status'] = $this->input->post("status");
			$product['cantidad'] = $this->input->post("cantidad");
			$product['fecha_caducidad'] = $this->input->post("caducidad");


			if ( $product->save() ){
				redirect('admin/productos');
			}
		}

		$this->setLayout('blank');

		$this->load->view("productos/update",$data);
	}

	public function delete($id = null){
		$product = new Producto_model();

		$product['idProducto'] = $id;
		$product['status'] = 0;

		if ( $product->save() ){
			redirect('admin/productos');
		}
	}	

	
	
}
