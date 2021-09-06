<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpass extends CI_Controller {
	
	function __construct(){	
		parent:: __construct();
		$this->load->model('m_reset');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	public function index(){
		$this->load->view('forgotpassword');
	}
	

	function forgotpassword(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		if($this->form_validation->run()==false){
			$this->load->view('forgotpassword');
		} else{
			//get user inputs
			$email = $this->input->post('email');
			$pengguna = $this->m_reset->get_member_by_email($email);
			if ($pengguna) {
				
				$code =  base64_encode(random_bytes(32));
				$this->m_reset->update_reset_key($email, $code);
			//set up email
				$config = array(
					'mailtype'  => 'html',
					'charset'   => 'utf-8',
					'protocol'  => 'smtp',
					'smtp_host' => 'smtp.gmail.com',
            	'smtp_user' => 'ahhambali.2020@gmail.com',  // Email gmail
            	'smtp_pass'   => 'ambay123456789',  // Password gmail
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
				<h2>Thank you for Reset Password.</h2>
				<p>Your Account:</p>
				<p>Email: ".$email."</p>
				<p>Please click the link below to reset your password.</p>
				<h4><a href='" . base_url() . 'forgotpass/reset_password?email=' . $email . '&code=' . urlencode($code) . "'>Reset your Password...</a></h4>
				</body>
				</html>
				";
				
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from($config['smtp_user']);
				$this->email->to($email);
				$this->email->subject('Verification Email');
				$this->email->message($message);

		    //sending email
				if($this->email->send()){
					$this->session->set_flashdata('message','Silahkan cek email, untuk melakukan reset password!');
					redirect('login');
				}else
				{
					$this->session->set_flashdata('fail','gagal reset password!');
					redirect('login');
				}

				

			}else {
				$this->session->set_flashdata('forgotpassword','Email belum registrasi atau tidak Active!');
				$this->load->view('forgotpassword');
			}
		}
	}

	public function reset_password(){
		$email = $this->input->get('email');
		$code = $this->input->get('code');
		//$email =  $this->uri->segment(4);
		// $code = $this->uri->segment(4);

		$pengguna =  $this->m_reset->getUser($email);

		if ($pengguna) {
			$code_user = $this->m_reset->getUser($email);
			if ($code_user) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			}else{
				$this->session->set_flashdata('fail', 'Reset password Failed! Wrong code.');
				redirect('login');
			}

			
		} else {
			$this->session->set_flashdata('fail', 'Reset password Failed! Wrong email.');
			redirect('login');
		}
	}

	


	public function changePassword(){

		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|min_length[3]|matches[password1]');
		if ($this->form_validation->run() == false) {
			
			$this->load->view('change_password');
			
		} else {
			$password = $this->input->post('password1');
			$email = $this->session->userdata('reset_email');

			
			$this->m_reset->update_password($password,$email,'pengguna');
			$this->session->unset_userdata('email');
			$this->session->set_flashdata('message', 'Password has been changed! Please login');
			redirect('login');
		}
	}
}