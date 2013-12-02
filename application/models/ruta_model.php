<?php 

class Ruta_model extends My_Model {

	public function __construct() {

		$this->tableName = 'rutas';
		$this->primaryKey = 'idRuta';
		$this->load->database();
		parent::__construct();

	}

	public function getAllToSelect(){
		$nombreRutas = $this->getAll();
		$rutas = array();
		foreach ($nombreRutas as $key => $ruta) {
			$rutas[$ruta->idRuta] = $ruta->nombre_ruta;
		}
		
		return $rutas;
	}

	public function getRutas(){

		$query = $this->db->query('
			select 
				ru.idRuta as idRuta, 
				ru.nombre_ruta as nombreRuta, 
				usr.nombre_usuario as nombreUser,
				mu.nombre as nombre 
			from 
				usuarios as usr, 
				rutas as ru, 
				municipios as mu
			where 
				ru.idUsuario = usr.idUsuario and
				ru.idMunicipio = mu.idMunicipio;
		');
		return $query;
	}

}

 ?>