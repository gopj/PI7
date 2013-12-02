<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends My_Controller {

	function __construct() {
		parent::__construct(true);
		//cargamos la libreria
		$this -> load -> library('menu');
		$this->load->model('usuario-inventario/productos_model','productos');
		$this->setLayout('usuario_inventario');

	}

	/**
	 * La funcion index de la vista de inventario, muestra los productos en inventario
	 * @return [type] [no regresa nada]
	 */
	public function index() {
		if ($this->session->userdata['user']['perfil'] != '1'){
			if ($this->session->userdata['user']['perfil'] == FALSE || $this->session->userdata['user']['perfil'] != '4'){
				redirect(base_url().'login');
			}
		}

		//construimos nuestro sidebar
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Agregar productos','Baja por caducidad'), //opciones sidebar
			'', //opcion seleccionada
			'usuario-inventario/productos', //submenu actual, en este caso ventas
			array('agregarProductos','bajaPorCaducidad'));

		$data['productos'] = $this->productos->getProductos();		

		$data['output'] = $this->load->view('usuario-inventario/productos/index', $data, true);
		
		$this->load->view('usuario-inventario/productos/index', $data);

	}

	/**
	 * Esta funcion agrega productos al inventario
	 * @return [type] [no regresa nada]
	 */
	public function agregarProductos(){
		if ( $this->input->post() ){
			if (isset($_POST['nombre']) && 
				isset($_POST['presentacion']) && 
				isset($_POST['precioFabrica']) && 
				isset($_POST['precioPublico']) && 
				isset($_POST['cantidad']) && 
				isset($_POST['fechaCaducidad'])) {

				//obtenemos los datos del producto
				$producto['nombre_producto'] = $this->input->post("nombre");
				$producto['presentacion'] = ($this->input->post("presentacion"));
				$producto['precio_fabrica'] = $this->input->post("precioFabrica");
				$producto['precio_publico'] = $this->input->post("precioPublico");
				$producto['status'] = 1;
				$producto['cantidad'] = $this->input->post("cantidad");
				$producto['fecha_caducidad'] = $this->input->post("fechaCaducidad");

				//agregamos el producto
				$this->productos->agregarProducto($producto);
				
				//redireccionamos a la vista productos
				redirect('usuario-inventario/productos/index');
				

			}else{
				redirect('usuario-inventario/productos/agregarProductos');
			}

		}

		//construimos nuestro sidebar
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Agregar productos','Baja por caducidad'), //opciones sidebar
			'Agregar productos', //opcion seleccionada
			'usuario-inventario/productos', //submenu actual, en este caso ventas
			array('agregarProductos','bajaPorCaducidad'));		

		$data['output'] = $this->load->view('usuario-inventario/productos/agregarProductos', $data, true);
		
		$this->load->view('usuario-inventario/productos/agregarProductos', $data);
	}

	/**
	 * Esta funcion realiza una baja de un producto expirado
	 * @return [type] [No regresa nada]
	 */
	public function bajaPorCaducidad(){
		if ( $this->input->post() ){
			if (isset($_POST['productos'])) {
				//obtenemos los productos que queremos eliminar
				$productos['productos'] = $this->input->post("productos");

				//eliminamos los productos seleccionados
				$this->productos->eliminarProductos($productos['productos']);
				
				//redireccionamos a la vista productos
				redirect('usuario-inventario/productos/index');
			}
		}
		//construimos nuestro sidebar
		$data['sidebar'] = $this -> menu -> construirSidebar(
			array('Agregar productos','Baja por caducidad'), //opciones sidebar
			'Baja por caducidad', //opcion seleccionada
			'usuario-inventario/productos', //submenu actual, en este caso ventas
			array('agregarProductos','bajaPorCaducidad'));	

		$data['productosCad'] = $this->productos->getProductosCaducados();	

		$data['output'] = $this->load->view('usuario-inventario/productos/bajaPorCaducidad', $data, true);
		
		$this->load->view('usuario-inventario/productos/bajaPorCaducidad', $data);
	}



}
?>