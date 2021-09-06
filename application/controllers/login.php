<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct(){	
		parent:: __construct();

		
	//$this->load->model(array('m_login','m_reset'));
		$this->load->model('m_login');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	public function index(){
		if($this->session->userdata('level') == 'admin'){
			$this->session->userdata('username');
			redirect('welcome');
		}elseif($this->session->userdata('level') == 'user'){
			$this->session->userdata('username');
			redirect('user');
		}
		


		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() == false){
			$this->load->view('login');
		}else{
			$this->do_login();
		}
	}



	
	function do_login(){
		

		//$this->session->set_userdata('username');

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->m_login->ceklogin($username);

		//jika usernya ada
		if($user){
			if($user['active'] == 1){

				if($password == $user['password']){
					$data = [
						'email' => $user['email'],
						'level' => $user['level'],
					];
					$this->session->set_userdata($data);
					if ($this->session->userdata('level') == ('admin')) {
						redirect('welcome');
					}elseif ($this->session->userdata('level') == ('user')) {
						redirect('user');
					}

				}else{
					$this->session->set_flashdata('Gagallogin','Maaf, Password salah!');
					$this->load->view('login');
				}

			}else{
				$this->session->set_flashdata('Gagallogin','Maaf, Email Belum diverifikasi!');
				redirect('login');
			}
		}else{
			$this->session->set_flashdata('Gagallogin','Maaf, Email Belum registrasi');
			redirect('login');
		}
	}

}