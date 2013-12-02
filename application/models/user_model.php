<?php 

class User_model extends My_Model {

	public function __construct() {

		$this->tableName = 'usuarios';
		$this->primaryKey = 'idUsuario';
		$this->load->database();

		parent::__construct();

	}

	public function getUsers(){

		$query = $this->db->query('
			select u.idUsuario as idUsuario, t.nombre as idTipo_usuario, u.nombre_usuario as nombre_usuario, u.status as status
			from usuarios as u, tipo_usuarios as t
			where 
			u.idTipo_usuario = t.idTipo_usuario;
		');
		if($query -> num_rows() > 0) {
			return $query;
		}
		//si no hay regresamos un false
		else{
			return false;	
		}
		return $query;
	}

	public function getChoferes(){
		$this->db->where('idTipo_usuario',2);
		$nombreUsers = $this->db->get('usuarios');
		
		return $nombreUsers;
	}

	public function getIdChoferes(){
		$this->db->where('idTipo_usuario',2);
		$nombreUsers = $this->db->get('usuarios');
		//$nombreUsers = $this->getAll();
		$users = array();
		foreach ($nombreUsers->result() as $user) {
			$users[$user->nombre_usuario] = $user->idUsuario;
		}
		
		return $users;
	}

	public function identificar($nombre_usuario, $clave){

		$identificar = FALSE;

		// Limpiamos los valores de posible inyeccion XSS
		$nombre_usuario = $this->security->xss_clean($nombre_usuario);
		$clave = $this->security->xss_clean($clave);

		// Preparar la consulta
		$this->db->where('nombre_usuario', $nombre_usuario);
		$this->db->where('clave', MD5($clave));
		$this->db->join('tipo_usuarios', "usuarios.idTipo_usuario = tipo_usuarios.idTipo_usuario");
		$this->db->limit(1);

		// Obtenemos el resultado de la consulta
		$query = $this->db->get($this->tableName);

		// Si se encontro un resultado
		if($query->num_rows() == 1){
			// Asignar los valores al record
			$this->record = $query->row_array();
			// Asignar identificacion positiva
			$identificar = TRUE;
		}

		return $identificar;
	}

}

 ?>