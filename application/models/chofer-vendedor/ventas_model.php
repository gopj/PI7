<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ventas_model extends My_Model {
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getVentas() {
		//un query que obtiene las ventas
		$query = $this->db->query('
			SELECT
				v.idVenta as idVenta, 
				u.nombre_usuario as usuario,
				c.nombre as cliente,
			 	v.fecha_venta as fecha, 
				v.total as total
			FROM 
				ventas as v
			INNER JOIN 	
				usuarios as u on  u.idUsuario = v.idUsuario 
			INNER JOIN 
				clientes as c on c.idCliente = v.idCliente
			ORDER by fecha;
		');
		//si hay ventas, regresamos los resultados
		if ($query -> num_rows() > 0) {
			return $query;
		}
		//si no hay regresamos un false
		else {
			return false;
		}
	}

	//esta funcion nos permite obetener una venta mediante su indice
	public function getVenta($idVenta){
		$query = $this->db->query('
			SELECT
				v.idVenta as idVenta, 
				u.nombre_usuario as usuario,
				c.nombre as cliente,
			 	v.fecha_venta as fecha, 
				v.total as total
			FROM 
				ventas as v
			INNER JOIN 	
				usuarios as u on  u.idUsuario = v.idUsuario 
			INNER JOIN 
				clientes as c on c.idCliente = v.idCliente
			where v.idVenta = '. $idVenta .'
			ORDER by idVenta;
		');
		if($query -> num_rows() > 0) {
			return $query;
			
		}
		else{
			return false;	
		}
	}

	//esta funcion nos permite obtener el detalle de una determinada venta 
	public function getDetalleVenta($idVenta){
		$query = $this->db->query('
			SELECT 
				dv.idVenta as idVenta, 
				p.nombre_producto as producto, 
				p.presentacion as presentacion, 
				p.fecha_caducidad as caducidad,
				p.precio_publico as precio, 
				dv.cantidad as cantidad
			FROM 
				vta_detalles as dv, 
				productos as p
			WHERE 
				dv.idProducto = p.idProducto and 
				dv.idVenta = '. $idVenta .'
			ORDER by idVenta;
		');
	
		if($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;	
		}
	}


	//esta funcion nos permite agregar una venta y sus detalles, 
	//donde recibimos los datos necesarios 
	public function agregarVenta($usuario, $cliente,$fecha,$total){
		//agregar la venta realizada en la tabla de venta
		$this->db->insert('ventas',
			array('idUsuario' => $usuario,
			 	  'idCliente' => $cliente,
			 	  'fecha_venta' => $fecha,
			 	  'total' => $total
			 	  )
		);

		//obtenemos el id de la venta realizada, para usarlo adelante 
		$idVenta = $this->db->insert_id();

		return $idVenta; 
	}

	//funcion para agregar los detalles de la venta
	public function agregarDetalleVenta($idVenta, $arrayProductos, $arrayCantidad){
		//insertamos los productos en el detalle de la venta
		for ($i = 0; $i < count($arrayProductos); $i++){
			$this->db->set('idVtaDetalle', 'null');
			 $this->db->set('idVenta', $idVenta);
			 $this->db->set('idProducto', $arrayProductos[$i]);
			 $this->db->set('cantidad', $arrayCantidad[$i]);
			 $this->db->insert('vta_detalles');

			 //modificamos la cantidad 
			 $this->modificarCantidadProducto($arrayProductos[$i],$arrayCantidad[$i]);
		} 
	}

	//esta funcion modifica la cantidad de productos que quedan al realizar la venta 
	public function modificarCantidadProducto($idProducto,$cantidadNueva){
		//obtenermos la cantidad actual
		$query = $this->db->query("
			Select cantidadLleva as cantidad from detalle_salidas_entradas 
			where idProducto=" . $idProducto  . "");
		$canActual = 0;
		if($query -> num_rows() > 0) {
			foreach ($query->result() as $detalle) {
				$canActual = $detalle->cantidad;
			}
		}
		
		//restamos la cantidad actual menos la que se vendio
		if($cantidadNueva > $canActual){
			redirect('chofer-vendedor/ventas/crearVenta');
		}else{
			$cantidadNueva = $canActual - $cantidadNueva;
		}
		
		//modificamos la actual por la cantidad nueva  
		$this->db->set('cantidadRegreso', $cantidadNueva );
		$this->db->where('idProducto', $idProducto);
		$this->db->update('detalle_salidas_entradas');
	}

	/**
	 * [getSalida description]
	 * @param  [type] $idUsuario [description]
	 * @param  [type] $fecha     [description]
	 * @return [type]            [description]
	 */
	public function getSalida($idUsuario, $fecha){
		$query=$this->db->query("
			select idSalidas_entradas 
			from salidas_entradas 
			where idUsuario= ". $idUsuario ."
			and fecha='". $fecha ."';
		");
		$res = 0;
		if($query -> num_rows() > 0) {
			foreach ($query->result() as $salida){
				$res = $salida->idSalidas_entradas; 
			}
			return $res;
		}else{
			return false;
		}
	}

	//esta funcion modifica la cantidad de productos despues de entregar un producto 
	//por producto caducado 
	public function modificarCantidadMerma($idProducto,$cantidadNueva){
		//obtenermos el producto caducado del inventario
		$this->db->where('idProducto',$idProducto);
		$query =$this->db->query("Select * 
			from productos where idProducto = ". $idProducto ." ");

		$canActual = 0;
		$query2 = "";
		if($query -> num_rows() > 0) :
			foreach ($query->result() as $prodCaducado) :
				//hacemos una consulta para buscar en el inventario del chofer, 
				//si tenemos ese producto, le cambiamos uno
				$query2 =$this->db->query("
					select 
						p.idProducto as idProducto,
						dse.cantidadLleva as cantidad
					from 	
						detalle_salidas_entradas as dse
					inner join 
						salidas_entradas as se on se.idSalidas_entradas = dse.idSalidas_entradas
					inner join 
						productos as p on p.idProducto = dse.idProducto 
					where 
						p.nombre_producto = ". $prodCaducado->nombre_producto ." and 
						p.presentacion = ". $prodCaducado->presentacion ." and
						p.precio_fabrica = ". $prodCaducado->precio_fabrica ." and 
						p.precio_publico = ". $prodCaducado->precio_publico ." and 
						p.status = 1 and 
						p.fecha_caducidad > (SELECT CURRENT_DATE())
						limit 1; 
				");
				//obtenemos la cantidad y la restamos 
				if($query2 -> num_rows() > 0) :
					//si se encuentra ese producto en nuestro camion (inventario chofer)
					foreach ($query2->result() as $prodNuevo) :
						$idProducto =  $prodNuevo->idProducto; 

						$canActual = $prodNuevo->cantidad; 

						//restamos la cantidad actual menos la que se vendio
						if($cantidadNueva > $canActual){
							//la cantidad es mayor que la q se tiene en inventario
							return false;
						}else{
							$cantidadNueva = $canActual - $cantidadNueva;
							$this->db->query("
								UPDATE 
									detalle_salidas_entradas 
									SET cantidadRegreso = ". $cantidadNueva ."
								WHERE idProducto = ". $idProducto .";
							");
						}
					endforeach;
				else: 
					return false;
				endif;
			endforeach;
		else:
			return false;
		endif;
		
	}

	//esta funcion nos permite agregar a la bd productos pasados de su fecha de caducidad 
	public function agregarMerma($idProducto, $cantidad,$idSalidas_entradas){
		for ($i = 0; $i < count($idProducto); $i++){
			$this->db->set('idProducto', $idProducto[$i]);
			$this->db->set('cantidad', $cantidad[$i]);
			$this->db->set('idSalidas_entradas', $idSalidas_entradas);
			$this->db->insert('mermas');

			 //modificamos la cantidad 
			 $this->modificarCantidadMerma($idProducto[$i],$cantidad[$i]);
		} 
	}

	//esta funcion nos permite obtener el total venta de la suma de productos 
	public function obtenerTotalProductos($productos,$cantidad){
		$total = 0;
		for ($i = 0; $i < count($productos); $i++) {
			$this->db->where('idProducto',$productos[$i]);
			$precio = $this->db->get('productos');
			if($precio -> num_rows() > 0) {
				foreach ($precio->result() as $producto){
					$mul = $producto->precio_publico * $cantidad[$i]; 
				}
				$total = $total + $mul;
			}else{
				return false;
			}
		} 
		return $total;
	}

}
?>