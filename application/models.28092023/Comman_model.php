<?php

	class Comman_model extends CI_Model {
		
		public function get_projects(){
			
			$this->db->select('*');
			$this->db->from('project_name');
			$query = $this->db->get();
			return $query->row_array();
			
		}
		
		public function get_activity_start_today($data){
		$current_date=date("d/m/Y");	
		$sql="SELECT * FROM `activity` WHERE start_date = '".$current_date."'";
		$res=$this->db->query($sql);
		return $res->result_array();	
		}
		
		public function get_activity_end_today($data){
		$current_date=date("d/m/Y");	
		$sql="SELECT * FROM `activity` WHERE finish_date = '".$current_date."'";
		$res=$this->db->query($sql);
		return $res->result_array();	
		}
		
		public function get_activity_start_end_today($data){
		$current_date=date("d/m/Y");	
		$sql="SELECT * FROM `activity` WHERE start_date = '".$current_date."' AND 
finish_date = '".$current_date."'";
		$res=$this->db->query($sql);
		return $res->result_array();	
		}
	    
		
		
	    
	}
?>