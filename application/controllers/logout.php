<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	
	function __construct(){	
		parent:: __construct();
	}
	
	public function index()
	{
		//$this->session->sess_destroy();
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');

		redirect('login','refresh');
		
	}
	
}
?>