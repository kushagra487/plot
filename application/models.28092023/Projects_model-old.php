<?php

	class Projects_model extends CI_Model {
	
		public function add_projects($details) {
			$this->db->insert('project_name', $details);
			//echo $this->db->last_query();
	    }
		
		public function add_project_pm($pm_details) {
			$this->db->insert('pm_project', $pm_details);
			//echo $this->db->last_query();
	    }
		
		public function add_project_tm($tm_details) {
			$this->db->insert('tm_project', $tm_details);
			//echo $this->db->last_query();
	    }
		
		public function update_projects($project_details, $hidden_id){
			$this->db->where('project_id', $hidden_id);
			$this->db->update('project_name', $project_details);
			//echo $this->db->last_query();
		}
		
		public function update_project_view($project_details, $project_id){
			$this->db->where('project_id', $project_id);
			$this->db->update('project_name', $project_details);
			//echo $this->db->last_query();
		}
		
		public function view_pm_details() {
			$this->db->select('*');
			$this->db->from('login');
			$this->db->where('role', 'Project Manager');
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
	    }
		
		public function view_tm_details() {
			$this->db->select('*');
			$this->db->from('login');
			$this->db->where('role', 'Team Member');
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
	    }
		
		public function view_projects_details_user_id($user_id) {
			$this->db->select('*');
			$this->db->from('project_name');
			$this->db->where('user_id', $user_id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
	    }
		
		public function view_pm_admin_editor_assigned_details($user_id) {
			$this->db->select('*');
			$this->db->from('pm_project');
			$this->db->where('pm_list', $user_id);
			$this->db->order_by("project_id","desc");
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
	    }
		
		public function view_tm_assigned_details($user_id) {
			$this->db->select('*');
			$this->db->from('tm_project');
			$this->db->where('tm_list', $user_id);
			$this->db->order_by("project_id","desc");
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
	    }
		
		public function view_projects_details_id($project_id) {
			$this->db->select('*');
			$this->db->from('project_name');
			$this->db->where('project_id', $project_id);
			$this->db->order_by("project_id","desc");
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->row_array();
	    }
		
		public function view_projects_details() {
			$this->db->select('*');
			$this->db->from('project_name');
			$this->db->order_by("project_id", "desc");
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
	    }

		public function delete_project($delete_id) {
			$this->db->where('project_id', $delete_id);
			$this->db->delete('project_name');
	    }
		
		public function view_assigned_pm_details($project_id) {
			$this->db->select('*');
			$this->db->from('pm_project');
			$this->db->where('project_id', $project_id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
	    }
		
		
			public function assign_pmlist($get_id) {
			$this->db->select('*');
			$this->db->from('pm_project');
			$this->db->where('project_id', $get_id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
	    }
		//pmchecked
		public function checked_update($user_id,$project_id,$check_value) {
	
			$query = $this->db->query("UPDATE `pm_project` SET `wbs_permission`='$check_value' WHERE project_id='$project_id'");
			echo $this->db->last_query();
			return $query->result_array();
	    }
		
		public function view_assigned_tm_details($project_id) {
			$this->db->select('*');
			$this->db->from('tm_project');
			$this->db->where('project_id', $project_id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
	    }
		
		public function assign_tmlist($get_id) {
			$this->db->select('*');
			$this->db->from('tm_project');
			$this->db->where('project_id', $get_id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
	    }
		
		public function view_assigned_pm_loggedin_details($project_id, $user_id) {
			$this->db->select('*');
			$this->db->from('pm_project');
			$this->db->where('project_id', $project_id);
			$this->db->where('user_id', $user_id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->row_array();
	    }
		
		public function delete_project_pm($delete_id) {
			$this->db->where('id', $delete_id);
			$this->db->delete('pm_project');
			//echo $this->db->last_query();
	    }
		
		public function delete_project_tm($delete_id) {
			$this->db->where('id', $delete_id);
			$this->db->delete('tm_project');
			//echo $this->db->last_query();
	    }
		
		public function delete_update_project_pm($project_id) {
			$this->db->where('project_id', $project_id);
			$this->db->delete('pm_project');
			//echo $this->db->last_query();
	    }
		
		public function delete_update_project_tm($project_id) {
			$this->db->where('project_id', $project_id);
			$this->db->delete('tm_project');
			//echo $this->db->last_query();
	    }
	}
?>