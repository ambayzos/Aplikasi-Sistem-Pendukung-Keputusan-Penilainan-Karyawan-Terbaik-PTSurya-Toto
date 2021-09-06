<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_register extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getAllUsers(){
		$query = $this->db->get('pengguna');
		return $query->result(); 
	}

	public function insert($pengguna){
		$this->db->insert('pengguna', $pengguna);
		return $this->db->insert_id(); 
	}

	public function getUser($id){
		$query = $this->db->get_where('pengguna',array('id_pengguna'=>$id));
		return $query->row_array();
	}

	public function activate($data, $id_pengguna){
		$this->db->where('pengguna.id_pengguna', $id_pengguna);
		return $this->db->update('pengguna', $data);
	}

}
