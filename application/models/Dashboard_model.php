<?php
class Dashboard_model extends CI_Model {
	
	
public function view_details($user_id) {
			$this->db->select('*');
			$this->db->from('login');
			$this->db->where('user_id', $user_id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->row_array();
	    }
		
		public function generate_key( $length = 8 ) {
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&";
			$password = substr( str_shuffle( $chars ), 0, $length );
			return $password;
		}
			
		
 public function get_project_data($start_date,$finish_date){
	
	if($start_date!='' && $finish_date!=''){	 
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id WHERE p.start_date >='$start_date' AND p.end_date  <='$finish_date' GROUP BY p.project_id ORDER BY p.project_name ASC";
	}else{
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id GROUP BY p.project_id ORDER BY p.project_name ASC";	
	}
	$res=$this->db->query($sql);
	return $res->result_array();	 
	 
 }
 
 public function get_project_data_member($start_date,$finish_date,$memberid){
	
	if($start_date!='' && $finish_date!=''){	 
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' WHERE p.start_date >='$start_date' AND p.end_date  <='$finish_date' GROUP BY p.project_id ORDER BY p.project_name ASC";
	}else{
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' GROUP BY p.project_id ORDER BY p.project_name ASC";	
	}
	$res=$this->db->query($sql);
	return $res->result_array();	 
	 
 }
 
  public function get_project_data_pm($start_date,$finish_date,$memberid){
	
	if($start_date!='' && $finish_date!=''){	 
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' WHERE p.start_date >='$start_date' AND p.end_date  <='$finish_date' GROUP BY p.project_id ORDER BY p.project_name ASC";
	}else{
		 $sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' GROUP BY p.project_id ORDER BY p.project_name ASC";	
	}
	$res=$this->db->query($sql);
	return $res->result_array();	 
	 
 }
 
 
 public function get_project_names($projectid){
	
	if($projectid){	 
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		
		//$name='<a href="wbs_list/index/'.$result['project_id'].'">'.substr($result['project_name'],0,3).'</a>';
		//$all_projects.="'".$name."',";	
		
		if(strlen($result['project_name']) >15) {
		$all_projects.="'".substr($result['project_name'],0,15).".."."',";	
		}
		else{
		$all_projects.="'".$result['project_name']."',";		
		}
	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
  public function get_project_names1($projectid){
	
	if($projectid){	 
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		
		//$name='<a href="wbs_list/index/'.$result['project_id'].'">'.substr($result['project_name'],0,3).'</a>';
		//$all_projects.="'".$name."',";	
		
		
		$all_projects.=$result['project_name'].",";		
		
	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 public function get_project_names_pm($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		if(strlen($result['project_name']) >8) {
		$all_projects.="'".substr($result['project_name'],0,8).".."."',";	
		}
		else{
		$all_projects.="'".$result['project_name']."',";		
		}
	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
  public function get_project_names_pm1($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		
		$all_projects.=$result['project_name'].",";		
		
	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 
 public function get_project_sdate_pm($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT start_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT start_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		$all_projects.="".$result['start_date'].",";	
	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 public function get_project_edate_pm($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT end_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT end_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		$all_projects.="".$result['end_date'].",";	
	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 public function get_project_names_member($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_name DESC";
	}else{
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_name DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		if(strlen($result['project_name']) >8) {
		$all_projects.="'".substr($result['project_name'],0,8).".."."',";	
		}
		else{
		$all_projects.="'".$result['project_name']."',";		
		}
	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 public function get_project_names_member1($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_name DESC";
	}else{
		$sql="SELECT p.* FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_name DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		
		$all_projects.=$result['project_name'].",";		
		
	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 public function get_project_sdate_member($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT start_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT start_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		$all_projects.="".$result['start_date'].",";	
	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 public function get_project_edate_member($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT end_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT end_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		$all_projects.="".$result['end_date'].",";		
	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 public function get_all_members_project($start_date,$finish_date,$project_filterid){
	//$sql="SELECT u.name FROM tm_project tm INNER JOIN login u ON u.user_id=tm.tm_list GROUP BY u.id  UNION SELECT u1.name FROM pm_project pm INNER JOIN login u1 ON u1.user_id=pm.pm_list GROUP BY u1.id";
	if($project_filterid!=''){
	$filter="AND project_id='".$project_filterid."'";	
	}
	if($start_date!='' && $finish_date!=''){	
	$sql="SELECT * FROM activity a INNER JOIN login u ON a.assigned_person=u.user_id  WHERE a.status=0 AND str_to_date(start_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date' OR  str_to_date(finish_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date' ".$filter." GROUP BY assigned_person  order BY assigned_person";
	}
	else{
		$sql="SELECT * FROM activity a INNER JOIN login u ON a.assigned_person=u.user_id AND a.status=0  ".$filter." order BY assigned_person";	
	}
	$res=$this->db->query($sql);
	$all_members='';
	foreach($res->result_array() as $result){
	$all_members.="'".$result['name']."',";	
		
	}
	$all_members=substr($all_members,0,-1); 
	return $all_members;
 }
 
  public function get_finish_date_project($projectid){
	$sql="SELECT `end_date`,datediff(CURDATE(), end_date) as delay FROM `project_name` WHERE project_id='".$projectid."' ";
	$res=$this->db->query($sql);
	return $res->row(); 
	 
 }
 
  public function get_start_date_project($projectid){
	$sql="SELECT `start_date` FROM `project_name` WHERE project_id='".$projectid."'";
	$res=$this->db->query($sql);
	return $res->row(); 
	 
 }
 
 public function get_completed_activity($projectid){
	$sql="SELECT count(1) as total from activity where activity_status=1 AND status=0 AND project_id='".$projectid."'";
	$res=$this->db->query($sql);
	return $res->row()->total; 
	 
 }
 
 public function get_incompleted_activity($projectid){
	$sql="SELECT count(1) as total from activity where activity_status=0  AND status=0  AND project_id='".$projectid."'";
	$res=$this->db->query($sql);
	return $res->row()->total; 
	 
 }
 
 public function get_total_activity($projectid){
	$sql="SELECT count(1) as total from activity where project_id='".$projectid."' AND status=0 ";
	$res=$this->db->query($sql);
	return $res->row()->total; 
	 
 }
 
 	public function get_total_time_in_days($finish_date,$start_date,$projectid){
	$sql="SELECT datediff(str_to_date('$finish_date','%d/%m/%Y'), str_to_date('$start_date','%d/%m/%Y')) as total_time FROM `activity` WHERE project_id='".$projectid."' ";
	$res=$this->db->query($sql);
	return $res->row()->total_time; 
	 
 	}
	
	
	public function get_employee_performance($start_date,$finish_date,$project_filterid,$memberid){
	
	$role = $this->session->userdata['role'];
	$user_id = $this->session->userdata['user_id'];
	
	
	if($project_filterid!=''){
	$filter="AND project_id='".$project_filterid."'";	
	}else{
		if($role == 'Project Manager'){
				$sql="SELECT * FROM pm_project WHERE pm_list='".$user_id."'"	;
				$query=$this->db->query($sql);
				if(count($query->result_array())>0){
				$ids='';
				foreach($query->result_array() as $res) {
					$ids.=$res['project_id'].",";
				}
							
				$ids=substr($ids,0,-1);	
				$filter="AND project_id IN (".$ids.")";	
				}
				else{
				$ids='';	
				$filter="AND project_id IN ('')";	
				}
				
		}
		
		
	}
	if($memberid!=''){
	$filter2="AND a.assigned_person='".$memberid."'";	
	}
	
	if($start_date!='' && $finish_date!=''){	
	 $sql="SELECT a.* FROM activity a INNER JOIN login u ON a.assigned_person=u.user_id  WHERE a.status=0 AND str_to_date(start_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date' OR  str_to_date(finish_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date' ".$filter2."  ".$filter." order BY a.assigned_person";
	}
	else{
		$sql="SELECT a.* FROM activity a INNER JOIN login u ON a.assigned_person=u.user_id AND a.status=0 ".$filter2."  ".$filter." order BY a.assigned_person  ";	
	}
	$res=$this->db->query($sql);
	
	$emplyee_name='';
	foreach($res->result_array() as $result){
		
	$employee_name.="'".$result['name']."'".",";	
	}
	$emp_names=substr($employee_name,0,-1); 
	return $emp_names;
 	}
	
	public function get_employee_performance_member($start_date,$finish_date,$project_filterid,$memberid){
	
	if($project_filterid!=''){
	$filter="AND a.project_id='".$project_filterid."'";	
	}
	if($start_date!='' && $finish_date!=''){	
	 $sql="SELECT u.name,sum(case when a.status=0 then 1 end) as total,sum(case when a.activity_status= '1' then 1 else 0 end) completed FROM activity a INNER JOIN login u ON u.user_id=a.assigned_person WHERE  a.status=0 AND (str_to_date(a.start_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date' OR  str_to_date(a.finish_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date') AND a.assigned_person='".$memberid."' ".$filter."   GROUP BY a.assigned_person  order BY a.assigned_person";
	}
	else{
		$sql="SELECT u.name,sum(case when a.status=0 then 1 end) as total,sum(case when a.activity_status= '1'= '1' then 1 else 0 end) completed FROM activity a INNER JOIN login u ON u.user_id=assigned_person WHERE a.status=0 AND a.assigned_person='".$memberid."' ".$filter."  GROUP BY a.assigned_person  order BY assigned_person";	
	}
	$res=$this->db->query($sql);
	
	$emplyee_name='';
	foreach($res->result_array() as $result){
		
		
		
	$employee_name.="'".$result['name']."'".",";	
	}
	$emp_names=substr($employee_name,0,-1); 
	return $emp_names;
 	}
	
	public function get_employee_per($start_date,$finish_date,$project_filterid){
		
	$role = $this->session->userdata['role'];
	$user_id = $this->session->userdata['user_id'];
	
	
	if($project_filterid!=''){
	$filter="AND project_id='".$project_filterid."'";	
	}else{
		if($role == 'Project Manager'){
				$sql="SELECT * FROM pm_project WHERE pm_list='".$user_id."'"	;
				$query=$this->db->query($sql);
				$ids='';
				if(count($query->result_array())>0){
				foreach($query->result_array() as $res) {
					$ids.=$res['project_id'].",";
				}
							
				$ids=substr($ids,0,-1);	
				$filter="AND project_id IN (".$ids.")";	
				}else{
				$filter="AND project_id IN ('')";		
				}
		}
		
		
	}
	if($start_date!='' && $finish_date!=''){		
	$sql_activity_count="SELECT sum(case when status=0 then 1 end) as total,sum(case when `activity_status` = '1' then 1 else 0 end) completed FROM activity WHERE  status=0 AND (str_to_date(start_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date' OR  str_to_date(finish_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date') AND assigned_person!='' ".$filter."  GROUP BY assigned_person  order BY assigned_person";
	}else{
	$sql_activity_count="SELECT sum(case when status=0 then 1 end) as total,sum(case when `activity_status` = '1' then 1 else 0 end) completed FROM activity WHERE status=0 AND assigned_person!='' ".$filter."  GROUP BY assigned_person  order BY assigned_person";	
	}
	
	
	$res_activity=$this->db->query($sql_activity_count);
	$per='';
	foreach($res_activity->result_array() as $result){
	$total_activity=$result['total'];
	$total_completed=$result['completed'];
	
	$percentage=ceil(($total_completed/$total_activity)*100);
	$per.=$percentage.",";
	}
	
	$per=substr($per,0,-1); 	
	return $per;	
	}
	
	
	public function get_employee_per_member($start_date,$finish_date,$user,$project_filterid){
	if($project_filterid!=''){
	$filter="AND project_id='".$project_filterid."'";	
	}	
	
	if($start_date!='' && $finish_date!=''){		
	$sql_activity_count="SELECT sum(case when status=0 then 1 end) as total,sum(case when `activity_status` = '1' then 1 else 0 end) completed FROM activity WHERE  status=0 AND (str_to_date(start_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date' OR  str_to_date(finish_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date') AND assigned_person='".$user."' ".$filter." GROUP BY assigned_person  order BY assigned_person";
	}else{
	$sql_activity_count="SELECT sum(case when status=0 then 1 end) as total,sum(case when `activity_status` = '1' then 1 else 0 end) completed FROM activity WHERE status=0 AND assigned_person='".$user."'  ".$filter." GROUP BY assigned_person  order BY assigned_person";	
	}
	
	
	$res_activity=$this->db->query($sql_activity_count);
	$per='';
	foreach($res_activity->result_array() as $result){
	$total_activity=$result['total'];
	$total_completed=$result['completed'];
	
	$percentage=ceil(($total_completed/$total_activity)*100);
	$per.=$percentage.",";
	}
	
	$per=substr($per,0,-1); 	
	return $per;	
	}
	
	
	public function donut_graph(){
	$sql="SELECT (SELECT count(distinct(p.project_id)) as total FROM  project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id ) as total,(SELECT count(distinct(p.project_id)) as total FROM  project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id  WHERE `end_date` >= CURDATE() AND p.status=0 )  as ontime,(SELECT count(distinct(p.project_id)) as total FROM  project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id  WHERE `end_date` <= CURDATE() AND p.status=0) as delay ,(SELECT count(distinct(p.project_id)) as total FROM  project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id  WHERE p.status=1 ) as completed";
	$res=$this->db->query($sql);
	return $res->row();
	}
	
	
	public function donut_graph_member($memberid){
	$sql="SELECT (SELECT count(distinct(p.project_id)) as total FROM  project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."') as total,(SELECT count(distinct(p.project_id)) as total FROM  project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."'  WHERE `end_date` >= CURDATE() AND p.status=0)  as ontime,(SELECT count(distinct(p.project_id)) as total FROM  project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id  INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' WHERE `end_date` <= CURDATE() AND p.status=0) as delay ,(SELECT count(distinct(p.project_id)) as total FROM  project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' WHERE p.status=1) as completed";
	$res=$this->db->query($sql);
	return $res->row();
	}
	
	public function donut_graph_pm($memberid){
	$sql="SELECT (SELECT count(distinct(p.project_id)) as total FROM  project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."') as total,(SELECT count(distinct(p.project_id)) as total FROM  project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."'  WHERE `end_date` >= CURDATE() AND p.status=0)  as ontime,(SELECT count(distinct(p.project_id)) as total FROM  project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id  INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' WHERE `end_date` <= CURDATE() AND p.status=0) as delay ,(SELECT count(distinct(p.project_id)) as total FROM  project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' WHERE p.status=1) as completed";
	$res=$this->db->query($sql);
	return $res->row();
	}
	
	
	
	public function get_project_months($projectid) {
	
		if($projectid!='' || $projectid!=0){	 
			$sql="SELECT TIMESTAMPDIFF(MONTH, start_date,end_date) as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id WHERE p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
		}else{
			$sql="SELECT TIMESTAMPDIFF(MONTH,start_date,end_date) as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id GROUP BY p.project_id  ORDER BY p.project_id DESC";	
		}
		$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			$all_projects.="'".($result['month']+1)."',";	
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects; 
	}
	
	
	
	
	
	public function completed_activities_till_today($projectid,$start_date,$end_date) {
		
		
		if($start_date!='' && $end_date!=''){	
		
		//$date_filter="AND STR_TO_DATE(start_date,'%d/%m/%Y') >= '".$start_date."' AND STR_TO_DATE(finish_date,'%d/%m/%Y') <= '".$end_date."'";
		}
		
		if($projectid!=''){
		$project_filter="AND a.project_id='".$projectid."'";	
		}
			
		
		if($projectid!='' || $projectid!=0){	 
			$sql="SELECT a.project_id,count(*) as total ,(select count(b.activity_id) from activity as b where b.project_id = a.project_id and b.activity_status = 1 AND status=0 ".$date_filter." ".$project_filter."  ) incomplete 
FROM activity as a where 1=1 ".$date_filter." ".$project_filter." AND status=0 GROUP BY a.project_id ORDER BY project_id DESC";	
		}else{
			 $sql="SELECT a.project_id,count(*) as total ,(select count(b.activity_id) from activity as b where b.project_id = a.project_id and b.activity_status = 1 AND status=0 ".$date_filter." ) incomplete 
FROM activity as a where 1=1 ".$date_filter."  AND status=0 GROUP BY a.project_id ORDER BY project_id DESC";	
		}
		$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			$per=ceil(($result['incomplete']/$result['total'])*100);
			$all_projects.="".$per."%,";	
			
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects; 
	}
	
	
	public function get_project_sdate($projectid){
	
	if($projectid!='' || $projectid!=0){	 
		$sql="SELECT start_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id WHERE  p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT start_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id GROUP BY p.project_id ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			
			$all_projects.="".$result['start_date'].",";	
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects;  
	 
 }
 
 public function get_project_edate($projectid){
	
	if($projectid!='' || $projectid!=0){	 
		$sql="SELECT end_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id WHERE  p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT end_date FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id  GROUP BY p.project_id ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			
			$all_projects.="".$result['end_date'].",";	
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects;  
	 
 }
 
 
 public function get_project_remaining_days($projectid){
	
	if($projectid!='' || $projectid!=0){	 
		$sql="SELECT datediff(p.end_date, p.start_date) as remaining FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id WHERE  p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT datediff(p.end_date, p.start_date) as remaining  FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id GROUP BY p.project_id ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			
			if($result['remaining']==NULL){
			$reamin=0;	
			}else{
				$reamin=$result['remaining'];	
			}
			$all_projects.="".$reamin.",";	
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects;  
	 
 }
 
 public function get_project_ending_days($projectid){
	
	if($projectid!='' || $projectid!=0){	 
		$sql="SELECT case when datediff(p.end_date,CURDATE())<0 then 0 
  when datediff(p.end_date,CURDATE())>0 then datediff(p.end_date,CURDATE()) end as enddays FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id WHERE  p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		 $sql="SELECT case when datediff(p.end_date,CURDATE())<0 then 0 
  when datediff(p.end_date,CURDATE())>0 then datediff(p.end_date,CURDATE()) end as enddays  FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id GROUP BY p.project_id ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			
			
			$all_projects.="".$result['enddays'].",";	
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects;  
	 
 }
 
 
 public function get_project_delay($projectid){
	
	if($projectid!='' || $projectid!=0){	 
		$sql="SELECT datediff(CURDATE(),p.end_date) as delay FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id WHERE  p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT datediff(CURDATE(),p.end_date) as delay FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id GROUP BY p.project_id ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			
			if($result['delay']>0){
			$reamin=$result['delay'];	
			}else{
				$reamin=0;	
			}
			//echo "<br>".$reamin;
			$all_projects.="".$reamin.",";	
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects;  
	 
 }
 
 
 public function get_project_delay_pm($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT datediff(CURDATE(),p.end_date) as delay FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT datediff(CURDATE(),p.end_date) as delay FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		
		
			
			if($result['delay']>0){
			$reamin=$result['delay'];	
			}else{
				$reamin=0;	
			}
			//echo "<br>".$reamin;
			$all_projects.="".$reamin.",";	
		
			
			
		}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 
 public function get_project_remaining_days_pm($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT  datediff(p.end_date, p.start_date) as remaining FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT  datediff(p.end_date, p.start_date) as remaining FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){if($result['remaining']==NULL){
			$reamin=0;	
			}else{
				$reamin=$result['remaining'];	
			}
			$all_projects.="".$reamin.",";	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 
 public function get_project_ending_days_pm($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT  case when datediff(p.end_date,CURDATE())<0 then 0 
  when datediff(p.end_date,CURDATE())>0 then datediff(p.end_date,CURDATE()) end as enddays FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT  case when datediff(p.end_date,CURDATE())<0 then 0 
  when datediff(p.end_date,CURDATE())>0 then datediff(p.end_date,CURDATE()) end as enddays FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
		
		
			$all_projects.="".$result['enddays'].",";	}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 
  public function till_today_months($projectid) {
		$todays_date=date("Y-m-d");
		if($projectid!='' || $projectid!=0){	 
			$sql="SELECT TIMESTAMPDIFF(MONTH, `start_date`,'".$todays_date."') as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id WHERE p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
		}else{
			 $sql="SELECT TIMESTAMPDIFF(MONTH,`start_date`,'".$todays_date."') as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id GROUP BY p.project_id  ORDER BY p.project_id DESC";	
		}
		$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			$all_projects.="'".($result['month']+1)."',";	
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects; 
	}
	
public function get_project_remaining_days_member($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT datediff(p.end_date, p.start_date) as remaining FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT datediff(p.end_date, p.start_date) as remaining FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
			
			if($result['remaining']==NULL){
			$reamin=0;	
			}else{
				$reamin=$result['remaining'];	
			}
			$all_projects.="".$reamin.",";	
		}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 public function get_project_ending_days_member($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT case when datediff(p.end_date,CURDATE())<0 then 0 
  when datediff(p.end_date,CURDATE())>0 then datediff(p.end_date,CURDATE()) end as enddays FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT case when datediff(p.end_date,CURDATE())<0 then 0 
  when datediff(p.end_date,CURDATE())>0 then datediff(p.end_date,CURDATE()) end as enddays FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
			
			
			$all_projects.="".$result['enddays'].",";	
		}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }
 
 
 public function get_project_delay_member($projectid,$memberid){
	
	if($projectid){	 
		$sql="SELECT datediff(CURDATE(),p.end_date) as delay FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' AND p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
	}else{
		$sql="SELECT datediff(CURDATE(),p.end_date) as delay FROM project_name p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
	}
	$res=$this->db->query($sql);
	$all_projects='';
	foreach($res->result_array() as $result){
			
			if($result['delay']>0){
			$reamin=$result['delay'];	
			}else{
				$reamin=0;	
			}
			//echo "<br>".$reamin;
			$all_projects.="".$reamin.",";	
		}
	$all_projects=substr($all_projects,0,-1); 
	return $all_projects; 
	 
 }	
 
 public function completed_activities_till_today_member($projectid,$start_date,$end_date,$memberid) {
		
		
		if($start_date!='' && $end_date!=''){	
		
		//$date_filter="AND STR_TO_DATE(start_date,'%d/%m/%Y') >= '".$start_date."' AND STR_TO_DATE(finish_date,'%d/%m/%Y') <= '".$end_date."'";
		}
		
		if($projectid!=''){
		$project_filter="AND a.project_id='".$projectid."'";	
		}
			
		
		if($projectid!='' || $projectid!=0){	 
			$sql="SELECT a.project_id,count(*) as total ,(select count(b.activity_id) from activity as b  INNER JOIN tm_project tmp ON tmp.project_id=b.project_id AND tmp.tm_list='".$memberid."' where b.project_id = a.project_id and b.activity_status = 1 AND status=0 ".$date_filter." ".$project_filter."  ) incomplete 
FROM activity as a INNER JOIN tm_project tmp ON tmp.project_id=a.project_id AND tmp.tm_list='".$memberid."' where 1=1 ".$date_filter." ".$project_filter." AND status=0 GROUP BY a.project_id ORDER BY project_id DESC";	
		}else{
			 $sql="SELECT a.project_id,count(*) as total ,(select count(b.activity_id) from activity as b  INNER JOIN tm_project tmp ON tmp.project_id=b.project_id AND tmp.tm_list='".$memberid."' where b.project_id = a.project_id  and b.activity_status = 1 AND status=0 ".$date_filter." ) incomplete 
FROM activity as a INNER JOIN tm_project tmp ON tmp.project_id=a.project_id AND tmp.tm_list='".$memberid."' where 1=1 ".$date_filter."  AND status=0 GROUP BY a.project_id ORDER BY project_id DESC";	
		}
		$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			$per=ceil(($result['incomplete']/$result['total'])*100);
			$all_projects.="".$per."%,";	
			
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects; 
	}	
	
	
	public function completed_activities_till_today_pm($projectid,$start_date,$end_date,$memberid) {
		
		
		if($start_date!='' && $end_date!=''){	
		
		//$date_filter="AND STR_TO_DATE(start_date,'%d/%m/%Y') >= '".$start_date."' AND STR_TO_DATE(finish_date,'%d/%m/%Y') <= '".$end_date."'";
		}
		
		if($projectid!=''){
		$project_filter="AND a.project_id='".$projectid."'";	
		}
			
		
		if($projectid!='' || $projectid!=0){	 
			$sql="SELECT a.project_id,count(*) as total ,(select count(b.activity_id) from activity as b INNER JOIN pm_project tmp ON tmp.project_id=b.project_id AND tmp.pm_list='".$memberid."'   where b.project_id = a.project_id and b.activity_status = 1 AND status=0 ".$date_filter." ".$project_filter."  ) incomplete 
FROM activity as a INNER JOIN pm_project tmp ON tmp.project_id=a.project_id AND tmp.pm_list='".$memberid."' where 1=1 ".$date_filter." ".$project_filter." AND status=0 GROUP BY a.project_id ORDER BY project_id DESC";	
		}else{
			$sql="SELECT a.project_id,count(*) as total ,(select count(b.activity_id) from activity as b INNER JOIN pm_project tmp ON tmp.project_id=b.project_id AND tmp.pm_list='".$memberid."' where b.project_id = a.project_id   and b.activity_status = 1 AND status=0 ".$date_filter." ) incomplete 
FROM activity as a INNER JOIN pm_project tmp ON tmp.project_id=a.project_id AND tmp.pm_list='".$memberid."' where 1=1 ".$date_filter."  AND status=0 GROUP BY a.project_id ORDER BY project_id DESC";	
		}
		$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			$per=ceil(($result['incomplete']/$result['total'])*100);
			$all_projects.="".$per."%,";	
			
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects; 
	}	
	
	
	 public function till_today_months_pm($projectid,$memberid) {
		$todays_date=date("Y-m-d");
		if($projectid!='' || $projectid!=0){	 
			$sql="SELECT TIMESTAMPDIFF(MONTH, `start_date`,'".$todays_date."') as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id WHERE p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
		}else{
			$sql="SELECT TIMESTAMPDIFF(MONTH,`start_date`,'".$todays_date."') as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
		}
		$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			$all_projects.="'".($result['month']+1)."',";	
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects; 
	}
	
	public function till_today_months_member($projectid,$memberid) {
		$todays_date=date("Y-m-d");
		if($projectid!='' || $projectid!=0){	 
			$sql="SELECT TIMESTAMPDIFF(MONTH, `start_date`,'".$todays_date."') as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id WHERE p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
		}else{
			$sql="SELECT TIMESTAMPDIFF(MONTH,`start_date`,'".$todays_date."') as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
		}
		$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			$all_projects.="'".($result['month']+1)."',";	
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects; 
	}
	
	public function get_project_months_member($projectid,$memberid) {
	
		if($projectid!='' || $projectid!=0){	 
			$sql="SELECT TIMESTAMPDIFF(MONTH, start_date,end_date) as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' WHERE p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
		}else{
			$sql="SELECT TIMESTAMPDIFF(MONTH,start_date,end_date) as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN tm_project tmp ON tmp.project_id=p.project_id AND tmp.tm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
		}
		$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			$all_projects.="'".($result['month']+1)."',";	
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects; 
	}
	
	public function get_project_months_pm($projectid,$memberid) {
	
		if($projectid!='' || $projectid!=0){	 
			$sql="SELECT TIMESTAMPDIFF(MONTH, start_date,end_date) as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' WHERE p.project_id='".$projectid."' GROUP BY p.project_id ORDER BY p.project_id DESC";
		}else{
			$sql="SELECT TIMESTAMPDIFF(MONTH,start_date,end_date) as month FROM project_name  p INNER JOIN mega_process mp  ON  p.project_id=mp.project_id INNER JOIN pm_project tmp ON tmp.project_id=p.project_id AND tmp.pm_list='".$memberid."' GROUP BY p.project_id  ORDER BY p.project_id DESC";	
		}
		$res=$this->db->query($sql);
		$all_projects='';
		foreach($res->result_array() as $result){
			$all_projects.="'".($result['month']+1)."',";	
		}
		$all_projects=substr($all_projects,0,-1); 
		return $all_projects; 
	}
	
	
	public function get_all_users(){
	
	$sql="SELECT * FROM login ORDER BY name";
	$res=$this->db->query($sql);
	return $res->result_array();	 
	 
	 }
	 
	 
	 public function get_project_users($pid){
		
		if($pid>0){
		$sql="SELECT * FROM pm_project p INNER JOIN login l on l.user_id=p.pm_list WHERE project_id='".$pid."' UNION SELECT * FROM tm_project  p INNER JOIN login l on l.user_id=p.tm_list WHERE project_id='".$pid."' ORDER BY name"	;
		}else{
		$sql="SELECT DISTINCT(p.pm_list),l.user_id,l.name FROM pm_project p INNER JOIN login l on l.user_id=p.pm_list UNION SELECT DISTINCT(p.tm_list),l.user_id,l.name FROM tm_project  p INNER JOIN login l on l.user_id=p.tm_list ORDER BY name"	;	
		}
		$query =$this->db->query($sql);
		
		return $query->result_array();	 
		
		}
		
	 
	 public function get_role_users($userid){
	
	$sql="SELECT * FROM login WHERE user_id='".$userid."'";
	$res=$this->db->query($sql);
	return $res->row(); 
	 
	 }
	 
	 public function get_pm_users($pmid){
		$sql="SELECT * FROM pm_project WHERE pm_list='".$pmid."'"	;
		$query=$this->db->query($sql);
		$ids='';
		foreach($query->result_array() as $res) {
			$ids.=$res['project_id'].",";
			}
			
		$ids=substr($ids,0,-1);	
		if($ids){	
		$sql="SELECT distinct(tm.tm_list) as user_id,l.name as name FROM tm_project tm INNER JOIN login l on l.user_id=tm.tm_list AND tm.project_id IN (".$ids.") ORDER BY name";	
		}else{
		$sql="SELECT distinct(tm.tm_list) as user_id,l.name as name FROM tm_project tm INNER JOIN login l on l.user_id=tm.tm_list AND tm.project_id IN ('')  ORDER BY name";	
		}
		$res=$this->db->query($sql);
		return $res->result_array();
		
		
		}
	    
	    
}
?>