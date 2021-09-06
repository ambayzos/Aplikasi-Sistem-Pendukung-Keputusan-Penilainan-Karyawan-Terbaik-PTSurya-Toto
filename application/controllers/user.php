<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_crud');
		if($this->session->userdata('level') <> 'user'){
			redirect('login');
		}
	}


	


	public function index()
	{
	// $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
		$this->page->setTitle('Welcome in SPK ');
		loadPageUser('user/index');
	}

	public function my_profile(){
		$this->page->setTitle('My Profile');
		$data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
		loadPageUser('user/my_profile', $data);
	}

	public function update_profile(){

		$id = $this->input->post('id_pengguna');
		
		$nama_lengkap = $this->input->post('nama_lengkap');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		$upload_image = $_FILES['image']['name'];
		if ($upload_image) {
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/profile/';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$new_image = $this->upload->data('file_name');
				$this->db->set('image', $new_image);
			}else{
				echo $this->upload->dispay_error();
			}
		}


		$data = array(
			'nama_lengkap' => $nama_lengkap,
			'username' => $username,
			'email' => $email,
			'password' => $password,



		);

		$where = array('id_pengguna'=>$id);


		$this->m_crud->update_data($where,$data,'pengguna');
		$this->session->set_flashdata('message', 'Berhasil diupdate!');
		redirect('user/my_profile');

	}
}
