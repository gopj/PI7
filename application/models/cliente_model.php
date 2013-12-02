<?php
class Cliente_model extends My_Model{
	
	public function __construct(){
		$this->tableName = 'clientes';
		$this->primaryKey = 'idCliente';
        // Call the Model constructor
        parent::__construct();
    }

	public function getClientes(){
		//un query que obtiene los cursos
		$query = $this->db->query('
			select 
				cl.idCliente as idCliente, 
				cl.nombre as nombre, 
				cl.direccion as direccion, 
				mu.nombre as idMunicipio , 
				cl.status as status,
				cl.asignado as asignado,
				cl.dia_visita as dia
			from clientes as cl, municipios as mu
			where 
			cl.idMunicipio = mu.idMunicipio;
		');
		//si hay cursos, regresamos los resultados
		if($query -> num_rows() > 0) {
			return $query;
		}
		//si no hay regresamos un false
		else{
			return false;	
		}
	}

	public function getByIdToSelect($id){
		$clientesResult = $this->getAllBy("idMunicipio", $id);
		$clientes = array();
		foreach ($clientesResult as $key => $cliente) {
			$clientes[$cliente->idCliente] = $cliente->nombre;
		}
		return $clientes;
	}

	//Este metodo me regresa todos los clientes que pertenecen a un cierto rol
	public function getClientesRol($idRol){
		//un query que obtiene los cursos
		$query = $this->db->query('
			select 
				cl.idCliente as idCliente, 
				cl.nombre as nombre, 
				cl.direccion as direccion, 
				mu.nombre as idMunicipio, 
				rc.idRol_cliente as idRol_cliente
			from 
				clientes as cl, municipios as mu, rol_clientes as rc
			where 
				cl.idMunicipio = mu.idMunicipio and
				cl.idCliente = rc.idCliente and
	            rc.idRol = '. $idRol .';
		');
		//si hay cursos, regresamos los resultados
		if($query -> num_rows() > 0) {
			return $query;
		}
		//si no hay regresamos un false
		else{
			return false;	
		}
	}

	//Este metodo me regresa los clientes que no han sido asignados a una ruta de un determinado municipio
	public function getClientesLibres($idMunicipio, $dia){
		//un query que obtiene los cursos
		$query = $this->db->query('
		SELECT 
			c . *,
			m.nombre as nombreMunicipio
		FROM 
			clientes AS c,
			municipios as m		 
		WHERE 
			c.idMunicipio = m.idMunicipio and
			c.idMunicipio = '. $idMunicipio .' and
			c.status = 1 and
			c.dia_visita = '. $dia .' and 
			c.asignado = 0
			;
		');
		//si hay cursos, regresamos los resultados
		if($query -> num_rows() > 0) {
			return $query;
		}
		//si no hay regresamos un false
		else{
			return false;	
		}
	}



}