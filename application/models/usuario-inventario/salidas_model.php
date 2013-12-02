<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Salidas_model extends My_Model {
	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	/**
	 * Obtiene las todas las salidas de inventario
	 * @return [type] [description]
	 */
	public function getSalidas(){
		$query = $this->db->query("
			SELECT 
				se.idSalidas_entradas as idSalida,
				u.nombre_usuario as usuario,
				se.status as status, 
				se.fecha as fecha
			FROM 	
				salidas_entradas as se
			INNER JOIN 
				usuarios as u ON u.idUsuario = se.idUsuario
			ORDER by fecha;

		");
		if($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;	
		}
	}

	/**
	 * Obtiene la salida de inventario que especifiquemos con el id
	 * @param  [type] $idSalida [description]
	 * @return [type]           [description]
	 */
	public function getSalida($idSalida){
		$query = $this->db->query('
			SELECT 
				se.idSalidas_entradas as idSalida,
				se.status as status,
				u.nombre_usuario as usuario, 
				se.fecha as fecha
			FROM 	
				salidas_entradas as se
			INNER JOIN 
				usuarios as u ON u.idUsuario = se.idUsuario
			WHERE se.idSalidas_entradas = '. $idSalida .'
			ORDER by fecha;
		');
		if($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;	
		}
	}

	/**
	 * Esta funcion nos permite obtener el detalle de una salida a partir del id de esta salida
	 * @param  [int] $idSalida [El idSalida del que queremos el detalle]
	 * @return [query]           [regresamos un set de resultados con el detalle de la salida]
	 */
	public function getDetalleSalida($idSalida){
		$query = $this->db->query('
			SELECT 
				dse.idSalidas_entradas as idSalida,
				p.idProducto as idProducto, 
				p.nombre_producto as producto, 
				p.presentacion as presentacion, 
				p.fecha_caducidad as caducidad,
				p.precio_publico as precio, 
				dse.cantidadLleva as cantidadLleva,
				dse.cantidadRegreso as cantidadRegreso 
			FROM
				detalle_salidas_entradas as dse, 
				productos as p
			WHERE 
				dse.idProducto = p.idProducto and 
				dse.idSalidas_entradas = '. $idSalida .'
			ORDER by idSalida;
		');
	
		if($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;	
		}
	}

	/**
	 * Esta funcion agregar una nueva salida a un chofer en especifico
	 * @param  [int] $idUsuario   [El usuario de la salida]
	 * @param  [date] $fechaSalida [La fecha de la salida]
	 * @return [int]              [Regresamos el id de la salida]
	 */
	public function agregarSalida($idUsuario, $fechaSalida){
		$this->db->set('idSalidas_entradas', 'null');
		$this->db->set('idUsuario', $idUsuario);
		$this->db->set('fecha', $fechaSalida);
		$this->db->insert('salidas_entradas');

		//obtenemos el id de la salida realizada, para usarlo adelante 
		$idSalida = $this->db->insert_id();

		return $idSalida; 
	}

	/**
	 * Esta funcion agrega los detalles de una salida, los productos y la cantiadad de producto que se lleva un chofer
	 * @param  [array int] $arrayProductos  [Un array con los ids de los productos]
	 * @param  [array int] $arrayCantidades [Un array con las cantidades]
	 * @param  [int] $idSalida        [El id de la salida]
	 * @return [nada]                  [description]
	 */
	public function agregarDetalleSalida($arrayProductos,$arrayCantidades,$idSalida){
		for ($i=0; $i < count($arrayProductos); $i++) { 
			$this->db->set('idDetalle_salidas_entradas', 'null');
			$this->db->set('idProducto', $arrayProductos[$i]);
			$this->db->set('cantidadLleva', $arrayCantidades[$i]);
			$this->db->set('cantidadRegreso', $arrayCantidades[$i]);
			$this->db->set('idSalidas_entradas', $idSalida);
			$this->db->insert('detalle_salidas_entradas');

			//modificamos la cantidad 
			 $this->modificarCantidadProducto($arrayProductos[$i],$arrayCantidades[$i]);
		}
	}

	public function modificarStatusSalida($idSalida, $status){
		$this->db->set('status',$status);
		$this->db->where('idSalidas_entradas', $idSalida);
		$this->db->update('salidas_entradas');
	}

	/**
	 * Esta funcion modifica la cantidad de productos en la tabla productos que quedan al realizar la salida de productos del inventario 
	 * @param  [type] $idProducto    [description]
	 * @param  [type] $cantidadNueva [description]
	 * @return [type]                [description]
	 */
	public function modificarCantidadProducto($idProducto,$cantidadNueva){
		//obtenermos la cantidad actual de producto en inventario
		$query = $this->db->query("
			Select cantidad as cantidad from productos 
			where idProducto=" . $idProducto  . "");
		$canActual = 0;
		if($query -> num_rows() > 0) {
			foreach ($query->result() as $producto) {
				$canActual = $producto->cantidad;
			}
		}
		
		//restamos la cantidad actual menos la que se vendio
		if($cantidadNueva > $canActual){
			redirect('usuario-inventario/salidas/registrarSalida');
		}else{
			$cantidadNueva = $canActual - $cantidadNueva;
		}
		
		//modificamos la actual por la cantidad nueva  
		$this->db->set('cantidad', $cantidadNueva );
		$this->db->where('idProducto', $idProducto);
		$this->db->update('productos');
	}
}
?>	