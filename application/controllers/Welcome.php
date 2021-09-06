<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		if($this->session->userdata('level') <> 'admin'){
			redirect('login');
		}
	}


	


	public function index()
	{
	// $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
		$this->page->setTitle('Welcome in SPK ');
		loadPage('layouts/index');
	}
}
