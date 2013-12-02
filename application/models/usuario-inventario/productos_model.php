<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Productos_model extends My_Model {
	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	/**
	 * [Esta funcion nos permite agregar un producto a la bd]
	 * @param  [array] $producto [array que guarda un producto]
	 * @return [query]           [regresamos un set de resultados del query hecho]
	 */
	public function agregarProducto($producto){
		$this->db->set('idProducto', 'null');
		$this->db->set('nombre_producto', $producto['nombre_producto']);
		$this->db->set('presentacion', $producto['presentacion']);
		$this->db->set('precio_fabrica', $producto['precio_fabrica']);
		$this->db->set('precio_publico', $producto['precio_publico']);
		$this->db->set('status', $producto['status']);
		$this->db->set('cantidad', $producto['cantidad']);
		$this->db->set('fecha_caducidad', $producto['fecha_caducidad']);
		$this->db->insert('productos');
	}

	/**
	 * Esta funcion nos obtiene todos los productos del inventario]
	 * @return [query] [regresamos un set de resultados del query hecho]
	 */
	public function getProductos(){
		$query = $this->db->get('productos');
		if($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;	
		}
	}

	/**
	 * [getProducto description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getProducto($id){
		//comparamos si los id son iguales 
		$this->db->where('idProducto',$id);
		$query=$this->db->get('productos');
		if($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;	
		}
	}

	/**
	 * Esta funcion obtiene los productos que ya caducaron
	 * @return [query] Regresamos un set de resultados del query
	 */
	public function getProductosCaducados(){
		$query=$this->db->query('
			SELECT 
				* 
			FROM 
				productos as p
			WHERE 
				p.fecha_caducidad < (SELECT CURRENT_DATE());  
		');
		if($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;	
		}
	}

	/**
	 * Esta funcion nos permite eliminar un producto del sistema,
	 * no se elimina completamente, sino se cambia su status
	 * @param  [array] $idProductos [Un array de ids de los productos que queremos eliminar]
	 * @return [type]              [no regresa nada]
	 */
	public function eliminarProductos($idProductos){
		for ($i=0; $i < count($idProductos); $i++) { 
			$this->db->set('status',0);
			$this->db->where('idProducto', $idProductos[$i]);
			$this->db->update('productos');
		}
	}

}
?>