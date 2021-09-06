<?php 
	class M_reset extends CI_Model
	{
		public function get_member_by_email($email)
		{
			return $this->db->get_where('pengguna', array('email' => $email,  'active' => '1'))->row_array();
			
		}

		public function getUser($email){
		return $this->db->get_where('pengguna', ['email'=>$email])->row_array();
	}
		


public function update_password($password,$email){
				$this->db->set('password', $password);
   				$this->db->where('email', $email);
   			    $this->db->update('pengguna');
     }


	
	public function update_reset_key($email,$code)
		{
			$this->db->where('email', $email);
			$data = array('code'=>$code);
			$this->db->update('pengguna', $data);
			if($this->db->affected_rows()>0)
			{
				return TRUE;
			}else{
				return FALSE;
			}
		}


	}

