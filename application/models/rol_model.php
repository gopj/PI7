<?php 

class Rol_model extends My_Model {

	public function __construct() {

		$this->tableName = 'roles';
		$this->primaryKey = 'idRol';
		$this->load->database();
		parent::__construct();
	}

	public function getRoles(){

		$query = $this->db->query('
			select ro.idRol as idRol, ro.dia as dia, ru.nombre_ruta as nombre 
			from roles as ro, rutas as ru
			where 
			ro.idRuta = ru.idRuta
			order by dia;
		');
		return $query;
	}

	public function getRolDia($id){

		$query = $this->db->query('
			select ro.dia as dia
			from roles as ro
			where 
			ro.idRol = '. $id .'
			;
		');
		if($query -> num_rows() > 0) {
			foreach ($query->result() as $rol) {
			 	return $rol->dia;
			 } 
			//return $query;
		}
		//si no hay regresamos un false
		else{
			return false;	
		}
	}
}

 ?>