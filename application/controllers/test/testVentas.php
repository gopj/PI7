<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TestVentas extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('unit_test');
		$this->load->model('chofer-vendedor/ventas_model','ventas');

	}

	/**
	 * Esta funcion prueba la funcion getVentas del modelo ventas
	 * @return [type] [description]
	 */
	public function testGetVentas(){
		$test_name = 'Get Ventas: ';
        $esperado = true;
        $venta = $this->ventas->getVentas();
        echo $this->unit->run($venta, $esperado, $test_name);
    }

    /**
     * Esta funcion prueba la funcion getVenta del modelo ventas
     * @return [type] [description]
     */
    public function testGetVenta(){
		$test_name = 'Get Venta: venta existe';
        $idVenta = 60;
        $esperado = true;
        $venta = $this->ventas->getVenta($idVenta);
        echo $this->unit->run($venta, $esperado, $test_name);

        $test_name = 'Get Venta: numero decimal negativo';
        $idVenta = -10898986.59;
        $esperado = false;
        $venta = $this->ventas->getVenta($idVenta);
        echo $this->unit->run($venta, $esperado, $test_name);

        $test_name = 'Get Venta: caracter';
        $idVenta = 'a';
        $esperado = false;
        $venta = $this->ventas->getVenta($idVenta);
        echo $this->unit->run($venta, $esperado, $test_name);

    }

    public function testAgregarVenta(){
    	$test_name = 'Agregar Venta: datos reales, tipos dato correctos';
        $usuario = 3;  
        $cliente = 44;
        $fecha = '2013-06-01';
        $total= 800;
        $esperado = true;
        $venta = $this->ventas->agregarVenta($usuario, $cliente,$fecha,$total);
        echo $this->unit->run($venta, $esperado, $test_name);
 
        //da un error: el usuario no existe
        $test_name = 'Agregar Venta: datos no correctos';
        $usuario = 100; //usuario no existe
        $cliente = 44;
        $fecha = '2013-06-01';
        $total= 120;
        $esperado = false;
        $venta = $this->ventas->agregarVenta($usuario, $cliente,$fecha,$total);
        echo $this->unit->run($venta, $esperado, $test_name);
    }

    public function testGetSalida(){
    	//pasa
    	$test_name = 'Get Salida: datos correctos';
        $usuario = 3; 
        $fecha = '2013-05-31';
        $esperado = 2;
        $salida = $this->ventas->getSalida($usuario, $fecha);
        echo $this->unit->run($salida, $esperado, $test_name);

        //pasa
        $test_name = 'Get Salida: letra en fecha';
        $usuario = 3; 
        $fecha = '2013-05-s'; 
        $esperado = false;
        $salida = $this->ventas->getSalida($usuario, $fecha);
        echo $this->unit->run($salida, $esperado, $test_name);

        //pasa
        $test_name = 'Get Salida: fecha otro formato';
        $usuario = 3; 
        $fecha = '2013-30-05'; 
        $esperado = false;
        $salida = $this->ventas->getSalida($usuario, $fecha);
        echo $this->unit->run($salida, $esperado, $test_name);

        //pasa
        $test_name = 'Get Salida: numero en vez fecha';
        $usuario = 3; 
        $fecha = '25000'; 
        $esperado = false;
        $salida = $this->ventas->getSalida($usuario, $fecha);
        echo $this->unit->run($salida, $esperado, $test_name);

        //hay error, no acepta letras en parametro idUsuario
        $test_name = 'Get Salida: letra en usuario';
        $idUsuario = o; 
        $fecha = '25000'; 
        $esperado = 'error';
        $salida = $this->ventas->getSalida($idUsuario, $fecha);
        echo $this->unit->run($salida, $esperado, $test_name);

    }

    public function testObtenerTotalProductos(){
    	//pasa
        $test_name = 'Obtener total productos: datos correctos';
        $idProductos = array(1,2); 
        $cantidades = array(1,1); 
        $esperado = 11;
        $salida = $this->ventas->obtenerTotalProductos($idProductos,$cantidades);
        echo $this->unit->run($salida, $esperado, $test_name);

        //pasa
        $test_name = 'Obtener total productos: cantidades cero';
        $idProductos = array(1,2); 
        $cantidades = array(0,0); 
        $esperado = 0;
        $salida = $this->ventas->obtenerTotalProductos($idProductos,$cantidades);
        echo $this->unit->run($salida, $esperado, $test_name);

        //no pasa
        $test_name = 'Obtener total productos: ids cero';
        $idProductos = array(-1,0,9.5); 
        $cantidades = array(1,2,3,5); 
        $esperado = false; //se espera error
        $salida = $this->ventas->obtenerTotalProductos($idProductos,$cantidades);
        echo $this->unit->run($salida, $esperado, $test_name);

        //no pasa, deberia dar error al ponerle cantidades double, solo 
        //debe adminitir integer
        $test_name = 'Obtener total productos: cantidades double';
        $idProductos = array(0,0,664,4454,43); 
        $cantidades = array(1.9,2.5); 
        $esperado = false; //se espera error
        $salida = $this->ventas->obtenerTotalProductos($idProductos,$cantidades);
        echo $this->unit->run($salida, $esperado, $test_name);

        //no pasa
        $test_name = 'Obtener total productos: cantidades double';
        $idProductos = array(1,3,9); 
        $cantidades = array('s','s'); 
        $esperado = false;
        $salida = $this->ventas->obtenerTotalProductos($idProductos,$cantidades);
        echo $this->unit->run($salida, $esperado, $test_name);
    }
}

?>