<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_crud');
		
		if($this->session->userdata('level') <> 'admin'){
			redirect('login');
		}
	}



	public function index()
	{
		$this->page->setTitle('Pengguna');
		$data['pengguna'] = $this->m_crud->tampil_data()->result();
		loadPage('pengguna/index',$data);
	}


	public function tambah(){
		$this->page->setTitle('Tambah Pengguna');
		loadPage('pengguna/tambah');
	}

	public function edit_pengguna($id){
		$this->page->setTitle('Edit Pengguna');
		$where = array('id_pengguna'=> $id);
		$data['data'] =$this->m_crud->edit_data($where,'pengguna')->result();
		loadPage('pengguna/edit_pengguna', $data);
	}

	public function tambah_aksi(){

		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$code = substr(str_shuffle($set), 0, 12);
		$image = 'default.jpg';
		$data = array(
			'nama_lengkap' =>$this->input->post('nama_lengkap'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'level' => $this->input->post('level'),
			'password'	=> $this->input->post('password'),
			'active' => 1,
			'code' => $code,
			'image'=> $image,

			
		);
		$this->m_crud->input_data($data,'pengguna');
		$this->session->set_flashdata('message', 'Berhasil disimpan!');
		redirect('pengguna');
	}


	public function update_data(){
		$id = $this->input->post('id_pengguna');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$level = $this->input->post('level');
		$active = $this->input->post('active');

		$data = array(
			'nama_lengkap' => $nama_lengkap,
			'username' => $username,
			'email' => $email,
			'password' => $password, 
			'level' => $level,
			'active' => $active
		);

		$where = array('id_pengguna'=>$id);


		$this->m_crud->update_data($where,$data,'pengguna');
		$this->session->set_flashdata('message', 'Berhasil diupdate!');
		redirect('pengguna');

	}

	public function hapus($id_pengguna){
		$where = array('id_pengguna'=> $id_pengguna);
		$this->m_crud->hapus_data($where,'pengguna');
		$this->session->set_flashdata('message', 'Berhasil dihapus!');
		redirect('pengguna');
	}

	public function my_profile(){
		$this->page->setTitle('My Profile');
		$data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
		loadPage('pengguna/my_profile', $data);
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
		redirect('pengguna/my_profile');

	}

}
