<?php
class Producto_model extends My_Model{
	
	public function __construct(){
		$this->tableName = 'productos';
		$this->primaryKey = 'idProducto';
        // Call the Model constructor
        parent::__construct();
    }

	public function getAllToSelect(){
		
	}

	public function createProduct(){
		
	}
}