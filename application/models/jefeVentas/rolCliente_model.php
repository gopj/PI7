<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class RolCliente_model extends My_Model {
	public function __construct() {
		parent::__construct();
		$this->tableName = 'rol_clientes';
		$this->primaryKey = 'idRol_cliente';
		$this->load->database();
	}

	public function insertClienteRol($clientes, $idRol){
		for ($i = 0; $i < count($clientes); $i++){
			$this->db->set('idRol', $idRol);
			$this->db->set('idCliente', $clientes[$i]);
			$this->db->insert('rol_clientes');

			$this->db->set('asignado', '1');
			$this->db->where('idCliente', $clientes[$i]);
			$this->db->update('clientes');
		}

	}

	public function getClienteIdFromRol_cliente($id){
		$query = $this->db->query('
			select 
				rc.*
			from rol_clientes as rc
			where 
			rc.idRol_cliente = '. $id .';
		');
		//si hay cursos, regresamos los resultados
		if($query -> num_rows() > 0) {
			$row = $query->row();
			return $row->idCliente;		 
		}
		//si no hay regresamos un false
		else{
			return false;	
		}

	}

}
?>