<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {
	
	
	

	public function ceklogin($username){
		return $this->db->get_where('pengguna', ['username' => $username])->row_array();
	}
	

	function userData($username){
	$this->db->select('username');
	$this->db->select('name');
	$this->db->where('username', $username);
	$query = $this->db->get('pengguna');
	return $query->row();
	}

	public function get($email = null){
		$this->db->from('pengguna');
		if ($email !=null) {
			$this->db->where('email', $email);
		}
		$query = $this->db->get()->row();
		return $query;
	}
	
	}

?>