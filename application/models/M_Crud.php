<?php if(!defined('BASEPATH')) exit ('Hacking Attempt : Keluar dari sistem.. !!');


class M_Crud extends CI_Model {
	
	function tampil_data(){
		return $this->db->get('pengguna');
	}
 
	function input_data($data,$table){
		$this->db->insert($table,$data);
	}
 
 
	function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	function edit_data($where,$table){
	return $this->db->get_where($table,$where);
	}

	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	 


}

