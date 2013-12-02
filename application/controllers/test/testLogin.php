<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TestLogin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('unit_test');
		$this->load->model('user_model','user');

	}
	

	/**
	 * Esta funcion realiza cinco pruebas a la funcion identificar del 
	 * modelo user_model
	 * @return [type] [description]
	 */
	public function testIdentificar(){
	$test_name = 'Identificar: usuario y clave correcta';
        $usuario = 'victor';
        $clave = 'victor';
        $esperado = true;
        $identifica = $this->user->identificar($usuario,$clave);
        echo $this->unit->run($identifica, $esperado, $test_name);

        $test_name = 'Identificar: usuario parecido';
        $usuario = 'Victor';
        $clave = 'Victor';
        $esperado = false;
        $identifica = $this->user->identificar($usuario,$clave);
        echo $this->unit->run($identifica, $esperado, $test_name);

        $test_name = 'Identificar: numeros';
        $usuario = '123';
        $clave = '';
        $esperado = false;
        $identifica = $this->user->identificar($usuario,$clave);
        echo $this->unit->run($identifica, $esperado, $test_name);

        $test_name = 'Identificar: numeros letras';
        $usuario = 'vic1or';
        $clave = 'victor';
        $esperado = false;
        $identifica = $this->user->identificar($usuario,$clave);
        echo $this->unit->run($identifica, $esperado, $test_name);

        $test_name = 'Identificar: usuario correcto';
        $usuario = 'victor';
        $clave = 'vic1or';
        $esperado = false;
        $identifica = $this->user->identificar($usuario,$clave);
        echo $this->unit->run($identifica, $esperado, $test_name);
	}



	
}