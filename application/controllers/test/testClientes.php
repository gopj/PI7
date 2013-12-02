<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TestClientes extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('unit_test');
		$this->load->model('chofer-vendedor/clientes_model','clientes');
	}

	public function agregarCliente(){
		$test_name = 'Agregar cliente: datos correctos';
        $nombre = 'cris';
        $direccion = 'palomas 97';
        $idMunicipio = 1; //Colima
        $dia = 1; //Lunes
        $esperado = true;
        $cliente = $this->clientes->agregarCliente($nombre, $direccion, $idMunicipio,$dia);
        echo $this->unit->run($cliente, $esperado, $test_name);

        $test_name = 'Agregar cliente: faltan datos';
        $nombre = '';
        $direccion = '';
        $idMunicipio = 1;
        $dia = 1;
        $esperado = false;
        $cliente = $this->clientes->agregarCliente($nombre, $direccion, $idMunicipio,$dia);
        echo $this->unit->run($cliente, $esperado, $test_name);

        $test_name = 'Agregar cliente: direccion y dia 0';
        $nombre = 'victor 2';
        $direccion = 'direccion 2';
        $idMunicipio = 0;
        $dia = 0;
        $esperado = true;
        $cliente = $this->clientes->agregarCliente($nombre, $direccion, $idMunicipio,$dia);
        echo $this->unit->run($cliente, $esperado, $test_name);

	}
}

?>
