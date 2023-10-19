<?php
	class Logo_model extends CI_Model {
	
		public function add_logo($details) {
			$this->db->where('id', 1);
			$this->db->update('logo', $details);
			//echo $this->db->last_query();
	    }
		
		public function view_logo() {
			$this->db->select('*');
			$this->db->from('logo');
			$this->db->where('id', 1);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->row_array();
	    }
	}
?>