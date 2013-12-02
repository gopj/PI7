<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_model extends My_Model {
	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	public function ventaDiariaProducto($fecha) {
		$query = $this->db->query("
			SELECT 
			p.nombre_producto as nombre_producto,
			p.precio_publico as precio_publico,
			sum(dv.cantidad) as cantidad,
			v.fecha_venta as fecha_venta

			FROM productos as p, vta_detalles as dv, ventas as v
			where 
			    v.idVenta = dv.idVenta and
				dv.idProducto = p.idProducto and
			    v.fecha_venta = '". $fecha ."' 
			group by p.idProducto;

		");

		//si hay productos, regresamos los resultados
		if ($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;
		}
	}


	public function bajasXcaducidad($fecha) {
		$query = $this->db->query("
			SELECT 
			p.idProducto as idProducto,
			p.nombre_producto as nombre_producto,
			p.precio_publico as precio_publico,
			sum(m.cantidad) as cantidad

			FROM productos as p, mermas as m
			where 
				m.idProducto = p.idProducto and
			    p.fecha_caducidad = '". $fecha ."' 
			group by p.idProducto;
		");
		//Preguntar si este reporte es especifico de una sola fecha o no?

		//si hay productos, regresamos los resultados
		if ($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;
		}
	}


	public function ventasMensuales($fecha) {
		$query = $this->db->query("
			SELECT 
			v.fecha_venta as fecha_venta,
			sum(v.total) as total,
			u.nombre_usuario as nombre_usuario,
			c.nombre as nombre

			FROM ventas as v, usuarios as u, clientes as c
			where 
				v.idUsuario = u.idUsuario and
				v.idCliente = c.idCliente and
				v.fecha_venta like '%" . $fecha . "%'
			group by c.idCliente;
		");

		//si hay productos, regresamos los resultados
		if ($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;
		}
	}


	public function ventasXchofer($fecha) {
		$query = $this->db->query("
				SELECT 
					v.fecha_venta AS fecha_venta,
					SUM( v.total ) AS total, 
					u.nombre_usuario AS nombre_usuario

				FROM 
					ventas AS v, usuarios AS u
				WHERE 
					v.idUsuario = u.idUsuario AND 
					v.fecha_venta =  '" . $fecha . "'
					GROUP BY v.idUsuario;
		");

		//si hay productos, regresamos los resultados
		if ($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;
		}
	}
}
?>