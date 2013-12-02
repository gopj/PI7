<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->setLayout('default');

	}

	public function index($id = true){

		$this->load->view('index/index');
	}

	
}
