<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_register');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');

        //get all users
        // $this->data['users'] = $this->m_register->getAllUsers();
	}

	public function index(){
		
		$this->load->view('register');
	}

	public function registerakun(){
		$this->form_validation->set_rules('nama_lengkap', 'Nama_lengkap', 'required|trim');
		$this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[pengguna.username]',[
			'is_unique' => 'Username sudah terdaftar!']);
		$this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[pengguna.email]|required|trim',[
			'is_unique' => 'Email sudah terdaftar!']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]|matches[password_confirm]|max_length[30]', [
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek!']);
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|trim|matches[password]');
		

		if ($this->form_validation->run() == FALSE) { 
			$this->load->view('register');
		}
		else{
			//get user inputs
			$nama_lengkap = $this->input->post('nama_lengkap');
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');



			//generate simple random code
			$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code = substr(str_shuffle($set), 0, 12);
			$level = 'user';
			$image = 'default.jpg';

			//insert user to users table and get id
			$pengguna['nama_lengkap'] = $nama_lengkap;
			$pengguna['username'] = $username;
			$pengguna['email'] = $email;
			$pengguna['password'] = $password;
			$pengguna['level'] = $level;
			$pengguna['code'] = $code;
			$pengguna['active'] = false;
			$pengguna['image'] = $image;
			$id_pengguna = $this->m_register->insert($pengguna);

			//set up email
			$config = array(
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
				'protocol'  => 'smtp',
				'smtp_host' => 'smtp.gmail.com',
            	'smtp_user' => 'email@anda',  // Email gmail
            	'smtp_pass'   => 'password_anda',  // Password gmail
            	'smtp_crypto' => 'ssl',
            	'smtp_port'   => 465,
            	'crlf'    => "\r\n",
            	'newline' => "\r\n"
            	
            );

			$message = 	"
			<html>
			<head>
			<title>Verification Code</title>
			</head>
			<body>
			<h2>Thank you for Registering.</h2>
			<p>Your Account:</p>
			<p>Nama Lengkap: ".$nama_lengkap."</p>
			<p>Username: ".$username."</p>
			<p>Email: ".$email."</p>
			<p>Password: ".$password."</p>
			<p>Please click the link below to activate your account.</p>
			<h4><a href='".base_url()."register/activate/".$id_pengguna."/".$code."'>Activate My Account</a></h4>
			</body>
			</html>
			";
			
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from($config['smtp_user']);
			$this->email->to($email);
			$this->email->subject('Signup Verification Email');
			$this->email->message($message);

		    //sending email
			if($this->email->send()){
				$this->session->set_flashdata('message','Activation code sent to email');
			}
			else{
				$this->session->set_flashdata('message', $this->email->print_debugger());
				
			}

			redirect('login');
		}

	}

	public function activate(){
		$id_pengguna =  $this->uri->segment(3);
		$code = $this->uri->segment(4);

		//fetch user details
		$pengguna = $this->m_register->getUser($id_pengguna);

		//if code matches
		if($pengguna['code'] == $code){
			//update user active status
			$data['active'] = true;
			$query = $this->m_register->activate($data, $id_pengguna);

			if($query){
				$this->session->set_flashdata('message', 'User activated successfully');
			}
			else{
				$this->session->set_flashdata('message', 'Something went wrong in activating account');
			}
		}
		else{
			$this->session->set_flashdata('message', 'Cannot activate account. Code didnt match');
		}

		redirect('login');

	}

}
