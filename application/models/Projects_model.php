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
			echo $this->db->last_query();
	    }
		
		public function update_projects($project_details, $hidden_id){
			$this->db->where('project_id', $hidden_id);
			$this->db->update('project_name', $project_details);
			echo $this->db->last_query();
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
		
		public function get_projects_of_pm($user_id) {
		$sql="SELECT project_id FROM pm_project WHERE pm_list='".$user_id."' UNION SELECT project_id FROM tm_project WHERE tm_list='".$user_id."' ORDER BY project_id DESC";	
		$res=$this->db->query($sql);
		return $res->result_array();
			
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
			$sql="SELECT *,u.user_id as powner FROM project_name p INNER JOIN pm_project pm ON p.project_id=pm.project_id 
			INNER JOIN login u ON pm.pm_list=u.user_id AND p.project_id='".$project_id."' ORDER BY p.project_id DESC";
			$query = $this->db->query($sql);
			//echo $this->db->last_query();
			return $query->row_array();
	    }
		
		public function view_projects_details() {
			$sql="SELECT *,u.user_id as powner FROM project_name p INNER JOIN pm_project pm ON p.project_id=pm.project_id INNER JOIN login u ON pm.pm_list=u.user_id ORDER BY p.project_id DESC";
			
			$query = $this->db->query($sql);
			//echo $this->db->last_query();
			return $query->result_array();
	    }

		public function delete_project($delete_id) {
			$this->db->where('project_id', $delete_id);
			$this->db->delete('project_name');
			
			$sqlmp="DELETE FROM mega_process WHERE project_id='".$delete_id."'";
			$this->db->query($sqlmp);
					
			$sqlp="DELETE FROM process WHERE project_id='".$delete_id."'";
			$this->db->query($sqlp);
					
			$sqla="DELETE FROM activity WHERE project_id='".$delete_id."'";
			$this->db->query($sqla);
			
			$sql_pm="DELETE FROM pm_project WHERE project_id='".$delete_id."'";
			$this->db->query($sql_pm);
			
			$sql_tm="DELETE FROM pm_project WHERE project_id='".$delete_id."'";
			$this->db->query($sql_tm);
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
		
		
		public function array_qsort2 (&$array, $column=0, $order="ASC") {
    $oper = ($order == "ASC")?">":"<";
    if(!is_array($array)) return;
    usort($array, create_function('$a,$b',"return (\$a['$column'] $oper \$b['$column']);")); 
    reset($array);
}
		
		
	
	}
?>