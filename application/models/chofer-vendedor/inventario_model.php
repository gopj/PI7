<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Inventario_model extends My_Model {
	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	//funcion para obtener los productos que comercializa un chofer especifico
	public function getProductosChofer($data) {
		//obtenemos productos del chofer
		$query = $this->db->query("
			SELECT 
				p.idProducto,
			    p.nombre_producto,
			    p.presentacion, 
			    p.precio_publico,
			    p.status,
			    p.fecha_caducidad,
			    dse.cantidadLleva as cantidadLleva,
			    dse.cantidadRegreso as cantidadRegreso 
			FROM
			    detalle_salidas_entradas as dse
			INNER JOIN 
			    salidas_entradas as se ON dse.idSalidas_entradas = se.idSalidas_entradas 
			INNER JOIN
			    productos as p ON dse.idProducto = p.idProducto 
			WHERE 
			    se.idUsuario = ". $data['usuario'] ." 
			    and se.fecha =(SELECT CURRENT_DATE())
			ORDER BY p.nombre_producto
		");
		//si hay productos, regresamos los resultados
		if ($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;
		}

	}

	//funcion para obtener todos los productos caducados
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

}
?>