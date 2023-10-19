<?php
	class Login_model extends CI_Model {
	
		public function get_details($data) {

			$this->db->select('*');
			$this->db->from('login');
			$this->db->where('user_id', $data['user_id']);
			$this->db->where('password', $data['password']);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->row();	
	    }
	}
?>