<?php
class Perfil_model extends My_Model{
	
	public function __construct(){
		$this->tableName = 'tipo_usuarios';
		$this->primaryKey = 'idTipo_usuario';
        // Call the Model constructor
        parent::__construct();
    }

	public function getAllToSelect(){
		$perfilesResult = $this->getAll();
		$perfiles = array();
		foreach ($perfilesResult as $key => $perfil) {
			$perfiles[$perfil->idTipo_usuario] = $perfil->nombre;
		}
		
		return $perfiles;
	}
}