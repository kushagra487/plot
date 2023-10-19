<?php
	class Users_model extends CI_Model {
	
		public function add_details($details) {
			$this->db->insert('login', $details); 
			//echo $this->db->last_query();	
	    }
		
		public function view_details($name) {
			$this->db->select('*');
			$this->db->from('login');
			
			if($name!=''){
			$this->db->like('name', $name);
			$this->db->or_like('user_id', $name);	
			}
			$this->db->order_by("name", "asc");
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
	    }
		
		public function view_exist_details($exist_user_id) {
			$this->db->select('*');
			$this->db->from('login');
			$this->db->where("user_id", $exist_user_id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->row_array();
	    }
		
		public function delete_user_id($delete_id) {
			$this->db->where('id', $delete_id);
			$this->db->delete('login'); 
	    }
		
		public function edit_user_details($get_id, $details) {

			$this->db->where('id', $get_id);
			$this->db->update('login', $details); 
	    }
		
		public function get_id_details($get_id) {
			$this->db->select('*');
			$this->db->from('login');
			$this->db->where("id", $get_id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->row_array();
	    }

        public function get_user_details_byemail($get_id) {
            $this->db->select('*');
            $this->db->from('login');
            $this->db->where("user_id", $get_id);
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->row_array();
        }
	}
?>