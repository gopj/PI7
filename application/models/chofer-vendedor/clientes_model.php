<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Clientes_model extends My_Model {
	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	//funcion para obtener los productos que comercializa un chofer especifico
	public function getClientesChofer($data) {
		//obtenemos productos del chofer
		$query = $this->db->query("
			Select 
				c.idCliente,
				c.status as status, 
				c.nombre as nombre,
				m.nombre as municipio, 
				c.direccion  as direccion,
				c.status as status,
				(select getDia(c.dia_visita)) as dia 
			FROM 
				rol_clientes as rc
			INNER JOIN 
				roles as ro ON rc.idRol = ro.idRol
			INNER JOIN 
				clientes as c ON rc.idCliente = c.idCliente
			INNER JOIN 
				rutas as r ON r.idRuta = ro.idRuta
			INNER JOIN 
				municipios as m ON c.idMunicipio = m.idMunicipio
			WHERE 
				r.idUsuario = ". $data['usuario'] ." 
			ORDER by nombre;

		");

		//si hay productos, regresamos los resultados
		if ($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;
		}

	}

	//preguntar por esta funcion, cuando se agrega un cliente?? a donde se agrega??
	public function agregarCliente($nombre, $direccion, $idMunicipio,$dia){
		$this->db->set('idCliente', 'null');
		$this->db->set('nombre', $nombre);
		$this->db->set('direccion', $direccion);
		$this->db->set('idMunicipio', $idMunicipio);
		$this->db->set('dia_visita', $dia);
		if($this->db->insert('clientes')){
			$idCliente = $this->db->insert_id();
			return $idCliente;
		}else{
			return false;
		}
	}

	public function agregarClienteARol($idCliente, $idUsuario){
		//obtenemos el rol del chofer, dependiendo del dia actual 
		$query = $this->db->query("
			SELECT 
				idRol 
			FROM
				roles as ro
			INNER JOIN  
				rutas as ru ON ru.idRuta = ro.idRuta
			where
				ro.dia = (SELECT DAYNAME(current_date())) and
				ru.idUsuario = ". $idUsuario ."; 
		");
		$rol = 0;
		if($query -> num_rows() > 0) {
			foreach ($query->result() as $rol) {
				$idRol = $rol->idRol;
			}
		}

		//agregamos el cliente al rol del chofer vendedor
		$this->db->set('idRol_cliente','null');
		$this->db->set('idRol',$idRol);
		$this->db->set('idCliente',$idCliente);
		$this->db->insert('rol_clientes');

	} 

	public function getCliente($id){
		//comparamos si los id son iguales 
		$this->db->where('idCliente',$id);
		$query=$this->db->get('clientes');
		if($query -> num_rows() > 0) {
			return $query;
		}
		else{
			return false;	
		}
	}

}
?>