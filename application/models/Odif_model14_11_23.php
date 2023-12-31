<?php
	class Odif_model extends CI_Model{
		
		public function select($get_id) {  
			$this->db->select('*');
			$this->db->from('wbs');
			$this->db->where('project_id', $get_id);
			$this->db->where('end_date', date('m/d/Y'));
			$query = $this->db->get();
			return $query;
			 
		}
		
		public function odif_filter($get_id,$sdate,$edate) {  
			$this->db->select('*');
			$this->db->from('wbs');
			$this->db->where('project_id', $get_id);
			$this->db->where('start_date >=', $sdate);
            $this->db->where('end_date <=', $edate);
			$query = $this->db->get();
			return $query;
			 
		} 

		public function odif_filter_range($projectid,$sdate,$edate,$responsilbe_person){
			$current_date=$sdate;
			$current_date_db=date("Y-m-d");

			// if($sdate!=''){
			// 	$od_query1="AND ((STR_TO_DATE(a.finish_date,'%d/%m/%Y') between '".$sdate."' AND '".$edate."' ) OR (STR_TO_DATE(a.finish_date,'%d/%m/%Y') between '".$sdate."' AND '".$edate."'))";		
			// }		
			if ($sdate !== '') {
				$od_query1="AND (
					((a.completed = '') OR (DATE(a.completed) BETWEEN '".$sdate."' AND '".$edate."') OR DATE(a.completed) > '".$sdate."')
					OR
					((STR_TO_DATE(a.finish_date, '%d/%m/%Y') BETWEEN '".$sdate."' AND '".$edate."')
					OR (STR_TO_DATE(a.finish_date, '%d/%m/%Y') BETWEEN '".$sdate."' AND '".$edate."'))
				)";
			}	
		
			if($responsilbe_person!=''){
				$od_query2="AND a.assigned_person='".$responsilbe_person."'";	
			}
		
		   $sql="SELECT *,CASE WHEN ((DATE(a.completed) BETWEEN '" . $sdate . "' AND '" . $edate . "')) THEN 1 ELSE 0 END AS activity_status  FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE a.status = 0 AND a.project_id='".$projectid."' ".$od_query1." ".$od_query2." " ;
		   $res=$this->db->query($sql);
		   return $res->result_array();			
		   }
		   public function odif_multi_filter_range($projectid,$sdate,$edate,$responsilbe_person){
			$current_date=$sdate;
			$current_date_db=date("Y-m-d");

			// if($sdate!=''){
			// 	$od_query1="AND ((STR_TO_DATE(a.finish_date,'%d/%m/%Y') between '".$sdate."' AND '".$edate."' ) OR (STR_TO_DATE(a.finish_date,'%d/%m/%Y') between '".$sdate."' AND '".$edate."'))";		
			// }			
			if ($sdate !== '') {
				$od_query1="AND (
					((a.completed = '') OR (DATE(a.completed) BETWEEN '".$sdate."' AND '".$edate."') OR DATE(a.completed) > '".$sdate."')
					OR
					((STR_TO_DATE(a.finish_date, '%d/%m/%Y') BETWEEN '".$sdate."' AND '".$edate."')
					OR (STR_TO_DATE(a.finish_date, '%d/%m/%Y') BETWEEN '".$sdate."' AND '".$edate."'))
				)";
			}
			if($responsilbe_person!=''){
				$od_query2="AND a.assigned_person='".$responsilbe_person."'";	
			}
		
		   $sql="SELECT *,count(a.activity_name) AS activity_name, SUM(a.planned_quantity) AS planned_quantity,SUM(a.actually_quantity) AS actually_quantity, CASE WHEN ((DATE(a.completed) BETWEEN '" . $sdate . "' AND '" . $edate . "')) THEN 1 ELSE 0 END AS activity_status FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE a.`status` = '0' AND a.project_id='".$projectid."' ".$od_query1." ".$od_query2."  GROUP BY a.finish_date, a.assigned_person";
		 // echo $sql;die;
		//  $sql = "SELECT a.finish_date, a.assigned_person, COUNT(a.activity_name) AS activity_name, SUM(a.planned_quantity) AS planned_quantity, SUM(a.actually_quantity) AS actually_quantity, CASE WHEN (DATE(a.completed) BETWEEN '" . $sdate . "' AND '" . $edate . "') THEN 1 ELSE 0 END AS activity_status 
        // FROM `activity` a 
        // INNER JOIN process p ON a.`process_id`=p.pid 
        // INNER JOIN mega_process mp ON p.mp_id=mp.mp_id 
        // WHERE a.`status` = '0' AND a.project_id='".$projectid."' ".$od_query1." ".$od_query2."  
        // GROUP BY a.finish_date, a.assigned_person, activity_status";

		   $res=$this->db->query($sql);
			//    echo "<pre>";
			//    print_r($res->result_array()	);die;
		   return $res->result_array();			
		   }

		   public function get_odif_all_filter_range($projectid,$sdate,$edate,$responsilbe_person){
			$current_date=date("d/m/Y");
			$current_date_db=date("Y-m-d");

			// if($sdate!=''){
			// 	$od_query1="AND ((STR_TO_DATE(a.finish_date,'%d/%m/%Y') between '".$sdate."' AND '".$edate."' ) OR (STR_TO_DATE(a.finish_date,'%d/%m/%Y') between '".$sdate."' AND '".$edate."'))";		
			// }		
			if ($sdate !== '') {
				$od_query1="AND (
					((a.completed = '' ) OR (DATE(a.completed) BETWEEN '".$sdate."' AND '".$edate."') OR DATE(a.completed) >= '".$sdate."')
					OR
					((STR_TO_DATE(a.finish_date, '%d/%m/%Y') BETWEEN '".$sdate."' AND '".$edate."')
					OR (STR_TO_DATE(a.finish_date, '%d/%m/%Y') BETWEEN '".$sdate."' AND '".$edate."'))
				)";
			}	
		
			if($responsilbe_person!=''){
				$od_query2="AND a.assigned_person='".$responsilbe_person."'";	
			}

			$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE a.status = 0 AND a.project_id='".$projectid."' ".$od_query1." ".$od_query2." " ;
			$res=$this->db->query($sql);
			return $res->result_array();
				
			}
			
			public function get_odif_completed_filter_range($projectid,$sdate,$edate,$responsilbe_person){
			$current_date=date("d/m/Y");
			$current_date_db=date("Y-m-d");

			// if($sdate!=''){
			// 	$od_query1="AND ((STR_TO_DATE(a.finish_date,'%d/%m/%Y') between '".$sdate."' AND '".$edate."' ) OR (STR_TO_DATE(a.finish_date,'%d/%m/%Y') between '".$sdate."' AND '".$edate."'))";		
			// }	
			if ($sdate !== '') {
				$od_query1 = "AND (
					(
						(a.completed = '') 
						AND (
							(STR_TO_DATE(a.finish_date, '%d/%m/%Y') BETWEEN '$sdate' AND '$edate')
							OR (STR_TO_DATE(a.finish_date, '%d/%m/%Y') BETWEEN '$sdate' AND '$edate')
						)
					)
					OR
					(
						(a.completed IS NOT NULL) 
						AND (DATE(a.completed) BETWEEN '$sdate' AND '$edate')
					)
				)";
			}		
		
			if($responsilbe_person!=''){
				$od_query2="AND a.assigned_person='".$responsilbe_person."'";	
			}

			$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE a.activity_status=1 AND a.status = 0 AND a.project_id='".$projectid."' ".$od_query1." ".$od_query2." " ;
			$res=$this->db->query($sql);
			return $res->result_array();
				
			}

		
		public function odif_score($projectid){
		$current_date=date("d/m/Y");	
		$current_date_db=date("Y-m-d");
		$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE (( a.project_id='".$projectid."') AND (STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y')   OR date(a.activity_status_modified)='".$current_date_db."') ) AND a.project_id='".$projectid."'   AND a.status=0" ;
		$res=$this->db->query($sql);
		$total_count=count($res->result_array());	
				
		$sql_completed= "
SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE (( a.project_id='".$projectid."') AND (STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.activity_status=1  OR date(a.activity_status_modified)='".$current_date_db."') ) AND a.status=0 AND a.project_id='".$projectid."'" ;
		$res_completed=$this->db->query($sql_completed);
		$total_count_completed=count($res_completed->result_array());	
		
		$total_score=ceil(($total_count_completed/$total_count)*100);
		return $total_score;
		
		}
		
		
		public function odif_score_members($projectid,$memberid){
		$current_date=date("d/m/Y");	
		$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id AND a.finish_date = '".$current_date."'  AND a.project_id='".$projectid."' AND a.assigned_person='".$memberid."'  AND a.status=0" ;
		$res=$this->db->query($sql);
		$total_count=count($res->result_array());	
				
		$sql_completed= "SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id AND a.finish_date = '".$current_date."' AND a.activity_status=1  AND a.project_id='".$projectid."'  AND a.assigned_person='".$memberid."'  AND a.status=0" ;
		$res_completed=$this->db->query($sql_completed);
		$total_count_completed=count($res_completed->result_array());	
		
		$total_score=ceil(($total_count_completed/$total_count)*100);
		return $total_score;
		
		}
		
		
		 
		public function get_activity_start_today($filed,$value){
		$current_date=date("d/m/Y");//echo $current_date;exit;	
		$sql="SELECT * FROM `activity`  a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id  WHERE a.start_date = '".$current_date."' AND a.".$filed."='".$value."' AND a.status=0";
		$res=$this->db->query($sql);
		return $res->result_array();	
		}
		
		public function get_activity_end_today($filed,$value){
		$current_date=date("d/m/Y");	
		$sql="SELECT * FROM `activity`   a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id   WHERE a.finish_date = '".$current_date."' AND a.".$filed."='".$value."'  AND a.status=0";
		$res=$this->db->query($sql);
		return $res->result_array();	
		}
		
		public function get_activity_start_end_today($filed,$value){
		$current_date=date("d/m/Y");	
		$sql="SELECT * FROM `activity`   a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id   WHERE a.start_date = '".$current_date."' AND 
a.finish_date = '".$current_date."' AND a.".$filed."='".$value."'  AND a.status=0" ;
		$res=$this->db->query($sql);
		return $res->result_array();	
		}
		
		function activity_union(){
			$current_date=date("d/m/Y");
			$sql="SELECT distinct(assigned_person) as assigned_person,a.project_id FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id  WHERE a.start_date = '".$current_date."'  AND pn.is_wbs_submitted=1
			UNION 
			SELECT distinct(assigned_person) as assigned_person,a.project_id FROM `activity`    a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id   WHERE a.finish_date = '".$current_date."' AND pn.is_wbs_submitted=1
			UNION 
			SELECT distinct(assigned_person) as assigned_person,a.project_id FROM `activity`    a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id   WHERE a.start_date = '".$current_date."' AND a.finish_date = '".$current_date."' AND pn.is_wbs_submitted=1";
			$res=$this->db->query($sql);
			return $res->result_array();	
			
		}
		
		function activity_union_projectwise($projectid){
			$current_date=date("d/m/Y");
		$sql="SELECT distinct(assigned_person) as assigned_person,a.project_id FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id  WHERE a.start_date = '".$current_date."' AND a.project_id='".$projectid."' AND pn.is_wbs_submitted=1
			UNION 
			SELECT distinct(assigned_person) as assigned_person,a.project_id FROM `activity`    a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id   WHERE a.finish_date = '".$current_date."' AND a.project_id='".$projectid."' AND pn.is_wbs_submitted=1
			UNION 
			SELECT distinct(assigned_person) as assigned_person,a.project_id FROM `activity`    a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id   WHERE a.start_date = '".$current_date."' AND a.project_id='".$projectid."' AND a.finish_date = '".$current_date."' AND pn.is_wbs_submitted=1";
			$res=$this->db->query($sql);
			return $res->result_array();	
			
		}
		
		
		function activity_union_clients(){
			$current_date=date("d/m/Y");
			$sql="SELECT distinct(a.project_id) as project_id FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id  WHERE a.start_date = '".$current_date."'  AND pn.is_wbs_submitted=1
			UNION 
			SELECT distinct(a.project_id) as project_id FROM `activity`    a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id   WHERE a.finish_date = '".$current_date."' AND pn.is_wbs_submitted=1
			UNION 
			SELECT distinct(a.project_id) as project_id FROM `activity`    a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id   WHERE a.start_date = '".$current_date."' AND a.finish_date = '".$current_date."' AND pn.is_wbs_submitted=1";
			$res=$this->db->query($sql);
			return $res->result_array();	
			
		}
		
		function activity_union_clients_projectwise($projectid){
			$current_date=date("d/m/Y");
			$sql="SELECT distinct(a.project_id) as project_id FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id  WHERE a.start_date = '".$current_date."' AND a.project_id='".$projectid."'  AND pn.is_wbs_submitted=1
			UNION 
			SELECT distinct(a.project_id) as project_id FROM `activity`    a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id   WHERE a.finish_date = '".$current_date."' AND a.project_id='".$projectid."' AND pn.is_wbs_submitted=1
			UNION 
			SELECT distinct(a.project_id) as project_id FROM `activity`    a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id INNER JOIN project_name pn ON p.project_id=mp.project_id   WHERE a.start_date = '".$current_date."' AND a.project_id='".$projectid."' AND a.finish_date = '".$current_date."' AND pn.is_wbs_submitted=1";
			$res=$this->db->query($sql);
			return $res->result_array();	
			
		}
		
		
		
		
		function odif_report_delay($project_id){
		$sql="SELECT *,datediff(CURDATE(), str_to_date(`finish_date`,'%d/%m/%Y')) as delay FROM `activity` a 
INNER JOIN process p ON a.`process_id`=p.pid and a.project_id='".$project_id."' INNER JOIN mega_process mp on p.mp_id=mp.mp_id  
WHERE str_to_date(`finish_date`,'%d/%m/%Y') =CURDATE() OR (str_to_date(`finish_date`,'%d/%m/%Y') < CURDATE() AND activity_status=0 AND status=0) 
and a.project_id='".$project_id."' AND a.status=0";
		$res=$this->db->query($sql);
		return $res->result_array();	
		}
		
		
		
		
		public function get_all_projects(){
		
		$sql="SELECT * FROM project_name WHERE status=0 AND is_wbs_submitted=1";
		$res=$this->db->query($sql);
		return $res->result_array();	
		}
		
		public function get_project_reminder_time($project_id){
		
		$sql="SELECT * FROM project_name WHERE project_id='".$project_id."'";
		$res=$this->db->query($sql);
		return $res->row();
		}
		
		public function get_todays_odif($projectid){
		 $current_date=date("d/m/Y");
		 $current_date_db=date("Y-m-d");
		 if($projects->daterange > date('H:i'))
			$sym = '>';
		else 
			$sym = '<';
		if($projects->daterange < date('H:i'))
			$sym1 = '=';
		else 
			$sym1 = '';

		$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE ((DATE_FORMAT(CURRENT_TIME(), '%H:%i') ".$sym."= '$projects->daterange' AND a.finish_date = '$current_date' AND a.status = 0)  OR  (STR_TO_DATE(finish_date,'%d/%m/%Y') <".$sym1." STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.status=0  AND (a.activity_status=0 OR date(a.activity_status_modified)='".$current_date_db."') )) AND a.project_id='".$projectid."' Order by finish_date" ;
		
		$res=$this->db->query($sql);
		return $res->result_array();			
		}
		
		
		public function get_todays_odif_all($projectid){
		$projects  = $this->get_project_reminder_time($projectid);
		$current_date=date("d/m/Y");
		$current_date_db=date("Y-m-d");
		//$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE ((a.finish_date = '".$current_date."' AND a.status=0) OR  (STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.status=0  AND (a.activity_status=0 OR date(a.activity_status_modified)='".$current_date_db."') )) AND a.project_id='".$projectid."' " ;
// echo $projects->daterange;die;/
//echo date('H:i');die;
		if($projects->daterange > date('H:i'))
		$sym = '>';
		else 
		$sym = '<';
		if($projects->daterange < date('H:i'))
		$sym1 = '=';
		else 
		$sym1 = '';
		$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE (
			(DATE_FORMAT(CURRENT_TIME(), '%H:%i') ".$sym."= '$projects->daterange' AND a.finish_date = '$current_date' AND a.status = 0)  OR  (STR_TO_DATE(finish_date,'%d/%m/%Y') <".$sym1." STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.status=0  AND (a.activity_status=0 OR date(a.activity_status_modified)='".$current_date_db."') )) AND a.project_id='".$projectid."' " ;
			//echo $sql;die;
		$res=$this->db->query($sql);
		return $res->result_array();
			
		}
		
		public function get_todays_odif_completed($projectid){
		$current_date=date("d/m/Y");
		$current_date_db=date("Y-m-d");
		$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.activity_status=1 AND a.project_id='".$projectid."' AND a.status=0 AND  date(a.activity_status_modified)='".$current_date_db."'" ;
		$res=$this->db->query($sql);
		return $res->result_array();
			
		}
		
	
		
		public function get_todays_odif_member($projectid,$assigned_person){
		$current_date=date("d/m/Y");
		$current_date_db=date("Y-m-d");
	    $sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE ((a.finish_date = '".$current_date."' AND a.project_id='".$projectid."' AND a.assigned_person='".$assigned_person."') OR (STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y')  AND a.assigned_person='".$assigned_person."' AND a.project_id='".$projectid."' AND  (a.activity_status=0 OR date(a.activity_status_modified) ='".$current_date_db."')) )  AND a.status=0" ;
		$res=$this->db->query($sql);
		return $res->result_array();
			
		}
		
		public function get_todays_odif_member_all($projectid,$assigned_person){
		$current_date=date("d-m-Y");
		$current_date_db=date("Y-m-d");
		$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE (( a.project_id='".$projectid."' AND a.assigned_person='".$assigned_person."') AND (STR_TO_DATE(finish_date,'%d-%m-%Y') <= STR_TO_DATE('".$current_date."','%d-%m-%Y')  AND a.assigned_person='".$assigned_person."' AND a.project_id='".$projectid."'  AND date(a.activity_status_modified)='".$current_date_db."') )  AND a.status=0" ;
		$res=$this->db->query($sql);
		return $res->result_array();
			
		}
		
		public function get_todays_odif_member_completed($projectid,$assigned_person){
		$current_date=date("d/m/Y");
		$current_date_db=date("Y-m-d");
		$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE (( a.project_id='".$projectid."' AND a.assigned_person='".$assigned_person."') AND (STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.activity_status=1 AND a.assigned_person='".$assigned_person."' AND a.project_id='".$projectid."'  AND date(a.activity_status_modified)='".$current_date_db."') )  AND a.status=0" ;
		$res=$this->db->query($sql);
		return $res->result_array();
			
		}
		  
	
		public function complete_activity($get_id) {
			$current_date=date("d/m/Y");
			$current_date_db=date("Y-m-d");
		$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE (( a.project_id='".$get_id."') AND (STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.activity_status=1  AND date(a.activity_status_modified)='".$current_date_db."') ) AND a.status=0 AND a.project_id='".$get_id."' " ;
		$res=$this->db->query($sql);
		return count($res->result_array());
	    }
		
		public function total_activity($get_id) {
			$current_date=date("d/m/Y");
			$current_date_db=date("Y-m-d");
			$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE ((a.finish_date = '".$current_date."' AND a.status=0) OR  (STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.status=0  AND (a.activity_status=0 OR date(a.activity_status_modified)='".$current_date_db."') )) AND a.project_id='".$get_id."' " ;
		$res=$this->db->query($sql);
		$count=$res->result_array();
		  return count($count);
	    }
		
		
		public function complete_activity_members( $get_id,$memberid) {
			$this->db->select('*');
			$this->db->from('activity');
			$this->db->where("project_id", $get_id);
			$this->db->where("assigned_person", $memberid);
			$this->db->where("activity_status", '1');
			$this->db->where("status", '0');
			$query = $this->db->count_all_results();
			
			//echo $this->db->last_query();
			if($query>0)
		    return $query;
			else
			return 0;
	    }
		
		public function total_activity_members($get_id,$memberid) {
			$this->db->select('*');
			$this->db->from('activity');
			$this->db->where("project_id", $get_id);
			$this->db->where("assigned_person", $memberid);
			$this->db->where("status", '0');
			$query = $this->db->count_all_results();
		    return $query;
	    }
		
		
		public function incomplete_activity($get_id) {
			$this->db->select('*');
			$this->db->from('activity');
			$this->db->where("project_id", $get_id);
			$this->db->where("activity_status", '0');
			$this->db->where("status", '0');
			$query = $this->db->count_all_results();
		    return $query;
	    }
		
		public function odif_report_odif_userwise($filed,$value,$uservalue){
		 $current_date=date("d/m/Y");
		 $current_date_db=date("Y-m-d");
		$sql="SELECT *,datediff(CURDATE(), str_to_date(`finish_date`,'%d/%m/%Y')) as delay FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE ((a.finish_date = '".$current_date."' AND a.status=0) OR  (STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.status=0  AND (a.activity_status=0 OR date(a.activity_status_modified)='".$current_date_db."') )) AND a.project_id='".$value."' AND a.assigned_person='".$uservalue."' " ;
		$res=$this->db->query($sql);
		return $res->result_array();	
				
		}
		
			public function complete_activity_userwise($get_id,$uservalue) {
			$current_date=date("d/m/Y");
			$current_date_db=date("Y-m-d");
		$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE (( a.project_id='".$get_id."') AND (STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.activity_status=1  AND date(a.activity_status_modified)='".$current_date_db."') ) AND a.status=0 AND a.project_id='".$get_id."'  AND a.assigned_person='".$uservalue."' " ;
		$res=$this->db->query($sql);
		return count($res->result_array());
	    }
		
		public function total_activity_userwise($get_id,$uservalue) {
			$current_date=date("d/m/Y");
			$current_date_db=date("Y-m-d");
			$sql="SELECT * FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE ((a.finish_date = '".$current_date."' AND a.status=0) OR  (STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.status=0  AND (a.activity_status=0 OR date(a.activity_status_modified)='".$current_date_db."') )) AND a.project_id='".$get_id."' AND a.assigned_person='".$uservalue."'  " ;
		$res=$this->db->query($sql);
		$count=$res->result_array();
		  return count($count);
	    }
		
		public function odif_report_odif($filed,$value){
		 $current_date=date("d/m/Y");
		 $current_date_db=date("Y-m-d");
		$sql="SELECT *,datediff(CURDATE(), str_to_date(`finish_date`,'%d/%m/%Y')) as delay FROM `activity` a INNER JOIN process p ON a.`process_id`=p.pid INNER JOIN mega_process mp on p.mp_id=mp.mp_id WHERE ((a.finish_date = '".$current_date."' AND a.status=0) OR  (STR_TO_DATE(finish_date,'%d/%m/%Y') <= STR_TO_DATE('".$current_date."','%d/%m/%Y') AND a.status=0  AND (a.activity_status=0 OR date(a.activity_status_modified)='".$current_date_db."') )) AND a.project_id='".$value."' " ;
		$res=$this->db->query($sql);
		return $res->result_array();	
				
		}
		
		
		
	}
?>