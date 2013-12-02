<?php
class Municipio_model extends My_Model{
	  
	public function __construct(){
		$this->tableName = 'municipios';
		$this->primaryKey = 'idMunicipio';
        // Call the Model constructor
        parent::__construct();
    }

	public function getAllToSelect(){
		$muniResult = $this->getAll();
		$muni = array();
		foreach ($muniResult as $key => $municipio) {
			$muni[$municipio->idMunicipio] = $municipio->nombre;
		}
		return $muni;
	}

	public function getMunicipios(){
		$municipios = $this->db->get('municipios');
		
		return $municipios;
	}

	//Este metodo me entrega el municipio al que pertenece un determinado rol
	public function getMunicipioRol($idRol){
		//un query que obtiene los cursos
		$query = $this->db->query('
		select 
		    ru.idMunicipio as idMunicipio
		                            
		from 
		        rutas as ru, roles as ro
		where 
		        ro.idRuta = ru.idRuta and
		        ro.idRol = '. $idRol .';
		');
		//si hay cursos, regresamos los resultados
		if($query -> num_rows() > 0) {
			foreach ($query->result() as $municipio) {
			 	return $municipio->idMunicipio;
			 } 
			//return $query;
		}
		//si no hay regresamos un false
		else{
			return false;	
		}
	}
}

	