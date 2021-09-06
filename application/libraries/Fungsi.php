<?php

Class Fungsi{
	protected $ci;
	function __construct(){
		$this->ci =& get_instance();
	}

	function user_login(){
		$this->ci->load->model('m_login');
		$user_email = $this->ci->session->userdata('email');
		$user_data = $this->ci->m_login->get($user_email);
		return $user_data;
	}
}