<?php
	
	class Edit_wbs_model extends CI_Model{	
	
		public function wbs_update_list($wbs_edit_data){
			
			//print_r($wbs_edit_data);
			//print_r($editcol);	
		$this->db->query("INSERT INTO `wbs`(`mega_process`, `process`, `activity`, `responsibility`, `start_date`, `end_date`, `resources`, `department`, `project_id`, `status`, `activity1`, `activity2`, `activity3`, `activity4`, `activity5`, `activity6`, `activity7`, `activity8`, `activity9`, `activity10`, `activity11`, `activity12`, `activity13`, `activity14`, `activity15`, `activity16`, `activity17`, 			`activity18`, `activity19`, `activity20`) VALUES $wbs_edit_data ") ;		
		}
		
		public function update_wbs_col($editcol) {
			$this->db->insert('column_table', $editcol); 
			//echo $this->db->last_query();	
	    }
		
		public function delete_edit_wbs_row($get_id) {
			$this->db->where('project_id', $get_id);
			$this->db->delete('wbs');
        }
		
		public function delete_edit_wbs_menu_row($get_id) {
			$this->db->where('col_project_id', $get_id);
			$this->db->delete('column_table');
        }
	}

?>
