<?php
	class wbs_model extends CI_Model{	
	
		
		public function get_project_details($get_id){		
			$this->db->select('*');
			$this->db->from('project_name');
			$this->db->where('project_id', $get_id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->row_array();
		}

		public function get_assiged_tm_details($get_id){		
			$this->db->select('*');
			$this->db->from('tm_project');
			$this->db->where('project_id', $get_id);
			$this->db->order_by("tm_list", "ASC");
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
		}
		
		public function get_assiged_pm_details($get_id){		
			$this->db->select('*');
			$this->db->from('pm_project');
			$this->db->where('project_id', $get_id);
			$this->db->order_by("pm_list", "ASC");
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
		}
		
		public function add_col($details) {
			$this->db->insert('column_table', $details); 
			//echo $this->db->last_query();	
	    }
		
		public function get_reponsible_person($pid){
		$sql="SELECT DISTINCT(assigned_person) as assigned_person FROM activity WHERE status=0 AND project_id='".$pid."' ORDER BY assigned_person ASC";
		$res=$this->db->query($sql);	
		return $res->result_array();
		}
		
		
		public function get_unique_code($get_id,$aid){
	    $sql="SELECT unique_code FROM activity WHERE project_id='".$get_id."'  AND status=0 AND activity_id < ".$aid." ";	
		$res=$this->db->query($sql);
		return $res->result_array();	
		}
		
	}
	
?>