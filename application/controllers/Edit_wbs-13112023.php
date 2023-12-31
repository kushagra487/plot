<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Edit_wbs extends CI_Controller {
		
		public function __construct(){  
			parent::__construct();  
			$this->load->model("wbs_list_model");
			$this->load->model("edit_wbs_model");
			$this->load->model("wbs_model");
			$this->load->model('logo_model');
			$this->load->model('dashboard_model');
			$this->load->model('projects_model');
			error_reporting(0); 			
		} 
		
		public function logged_in() {
			$loggedin = $this->session->userdata('login_flag');
			$user_id = $this->session->userdata['user_id'];
			$role = $this->session->userdata['role'];
		
			if($loggedin == true){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function index() {	
			$loggedin = $this->logged_in();
			 
			if($loggedin == TRUE) {
				$get_id =  $this->uri->segment('3');
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$uname = $this->session->userdata['name'];
				$data['logo'] = $this->logo_model->view_logo();
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['project_details'] = $this->wbs_model->get_project_details($get_id);
				$data['tm_details'] = $this->wbs_model->get_assiged_tm_details($get_id);
				$data['responsible_person']=$this->wbs_model->get_reponsible_person($get_id);
				
				//assigned PM list and TM list
				$data['assign_pm_list'] = $this->projects_model->assign_pmlist($get_id);
			    $data['assign_tm_list'] = $this->projects_model->assign_tmlist($get_id);
				
				$data['all_mp']=$this->wbs_list_model->get_all_mega_process($get_id);
				$data['all_process']=$this->wbs_list_model->get_all_process($get_id);
				
				
				//print_r($data['unique_code']); die;
				
				$data['project_details']=$this->projects_model->view_projects_details_id($get_id);			
			   	//Get user Comment
				$data['getcomment']=$this->wbs_list_model->get_comment($get_id);
			    //print_r($data['getcomment']); die;
				
								
				if($role == 'Admin'){
					
					if(isset($_POST['project_id'])){
					//print_r($_POST);die;
					$counts = array_count_values($_POST['cell']);
				    $process_count=$counts['Process'];
				   $activity_count=$counts['Activity'];
				   $mp_count=$counts['Mega Process'];
					$sdate_count=$counts['Start Date'];
					
					$is_wbs_submitted=$_POST['is_wbs_submitted'];	
					
					//-------If header array has blank elements then redirect to error page  
					if(in_array('',$_POST['cell'])  || $mp_count>1 || $sdate_count > 1)  {
						
					$this->session->set_flashdata('headers_empty','It seems that header values are not set or there is something wrong with header');	
					redirect(base_url().'wbs_list/'. 'index/' . $this->uri->segment('3'));	
						
					}
					
					$sqlmp="UPDATE mega_process SET status=1 WHERE project_id='".$_POST['project_id']."'";
					//$sqlmp="truncate table  mega_process";
					$this->db->query($sqlmp);
					
					$sqlp="UPDATE process SET status=1 WHERE project_id='".$_POST['project_id']."'";
					//$sqlp="truncate table  process";
					$this->db->query($sqlp);
					
					$sqla="UPDATE activity SET status=1 WHERE project_id='".$_POST['project_id']."'";
					//$sqla="truncate table  activity";
					$this->db->query($sqla);
					
					/*foreach (@glob('./template_document/'.$this->uri->segment('3')."/*.*") as $filename) {
					if (is_file($filename)) {
						unlink($filename);
					}
					}*/
					
					
					
					$json_string = json_encode($_POST);
				    $file = fopen($_POST['project_id'].".txt","w");
					fwrite($file,$json_string);
					fclose($file);
					
					$sql_column_ins="UPDATE project_name SET process_columns='".$process_count."', activity_columns='".$activity_count."',is_wbs_submitted='".$is_wbs_submitted."' WHERE project_id='".$_POST['project_id']."'";
					$this->db->query($sql_column_ins);
					
					$counter_mp=0;
					for($i=0;$i<count($_POST['rowC2']);$i++){
						
						if($_POST['rowC2'][$i]!=''){
							$counter_mp++;
							$sql_mp_ins="INSERT INTO mega_process (mp_name,project_id,last_modified,unique_code) 
					VALUES ('".addslashes($_POST['rowC2'][$i])."','".$this->uri->segment('3')."',now(),'".$counter_mp."')";
							$this->db->query($sql_mp_ins);	
						}
						
					}
					$count_p=0;
					$count_p1=0;
					$mpid_unique='';
					$mpid_unique1='';
					for($i=0;$i<$process_count;$i++){
						
					$newi=$i+3;
					for($k=0;$k<count($_POST['rowC'.$newi]);$k++){	
					
					//echo "<br>newi-->".$newi;
					if($_POST['rowC'.$newi][$k]!=''){
					
					if($i==0){	
					$count_p++;
					$sql_process_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('','".addslashes($_POST['rowC'.$newi][$k])."','','".$this->uri->segment('3')."',now())";
					$this->db->query($sql_process_ins);
					
					$autoid_process=$this->db->insert_id();	
					
					$values_mp=$this->wbs_list_model->findme($_POST['rowC2'],$k-1);
					$parent_value_mp=addslashes(end($values_mp));
					
				$sql_mp="select mp_id,unique_code from mega_process WHERE mp_name='".$parent_value_mp."' AND status=0 ORDER BY mp_id DESC LIMIT 1";
					$query_mp=$this->db->query($sql_mp);
					$res_mp = $query_mp->row(); 
					
					
					/*echo "<br>bbb-->".$mpid_unique;
					echo "<br>ccc-->".$res_mp->mp_id;*/
					if($mpid_unique!=$res_mp->mp_id && $mpid_unique!=''){
						$count_p=1;	
					}
					
					$unique_code=$res_mp->unique_code.".".$count_p;
					
					
						$sql_update_parent="UPDATE process SET mp_id='".$res_mp->mp_id."',
					unique_code='".$unique_code."' WHERE pid='".$autoid_process."'  AND status=0 ";
					$this->db->query($sql_update_parent);
					
					$mpid_unique=$res_mp->mp_id;	
					
					}else {
					$count_p1++;	
					$sql_process_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('','".addslashes($_POST['rowC'.$newi][$k])."','','".$this->uri->segment('3')."',now())";
					$this->db->query($sql_process_ins);
					$autoid_process=$this->db->insert_id();		
					
					$one_minus=$newi-1;	
					/*echo "New II-->".$newi;	
					echo "One minus-->".$one_minus=$newi-1;
					
					echo "K value-->".$k;*/
					
					$values=$this->wbs_list_model->findme($_POST['rowC'.$one_minus],$k-1);
					$parent_value=addslashes(end($values));
					
					$values_mp=$this->wbs_list_model->findme($_POST['rowC2'],$k-1);
					$parent_value_mp=addslashes(end($values_mp));
					//print_r($values);
					
					$sql_mp="select mp_id from mega_process WHERE mp_name='".$parent_value_mp."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ORDER BY mp_id DESC LIMIT 1";
					$query_mp=$this->db->query($sql_mp);
					$res_mp = $query_mp->result(); 
					
					$sql="select pid,unique_code from process WHERE process_name='".$parent_value."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ORDER BY pid DESC LIMIT 1";
					$query=$this->db->query($sql);
					$res = $query->row(); 
		
					//print_r($res);
					
					
					if($mpid_unique1!=$res->pid && $mpid_unique1!=''){
						$count_p1=1;	
					}
					
					$unique_code=$res->unique_code.".".$count_p1;
					
		
					$sql_update_parent="UPDATE process SET parent_processid='".$res->pid."',mp_id='".$res_mp[0]->mp_id."',unique_code='".$unique_code."' WHERE pid='".$autoid_process."'   AND project_id='".$this->uri->segment('3')."'  AND status=0  ";
					$this->db->query($sql_update_parent);	
					
					$mpid_unique1=$res->pid;	
					}
					
					
					}
						
					}
					
					
					}
					
					$new_array1=array();
					for($p1=0;$p1<count($_POST['rowC2']);$p1++){
					
						
						array_push($new_array1,$_POST['rowC2']);
					
						
					}
					
					//print_r($new_array1);
					
					
					$id_activity='';
					for($j=0;$j<$activity_count;$j++){
					
					/*echo "<br>m-->".$j;
					echo "<br>newi-->".$newi;
					echo "<br>activity_count-->".$activity_count;*/
					$newj=	$j+$newi+1;
					$actid_unique=0;
					$id_activity1='';
					$actid_unique1=0;
					$this->load->library('upload');
					//echo "<br>Count----->".count($_POST['rowC'.$newj]);
					for($l=0;$l<count($_POST['rowC'.$newj]);$l++){	
					
					//echo "<br>Activirt value is--->".$_POST['rowC'.$newj][$l];
					if($_POST['rowC'.$newj][$l]!=''){
						
					if (!is_dir('./template_document/'.$this->uri->segment('3'))) {
   					 	mkdir('./template_document/' . $this->uri->segment('3'), 0777, TRUE);
					}	
					
					//echo "<br>Filwename-->".$_FILES['template_document']['name'][$l];
					if($_FILES['template_document']['name'][$l]!='') {
					
					$config['upload_path'] = './template_document/'. $this->uri->segment('3');
					$config['allowed_types'] = '*';
					$config['overwrite'] = TRUE;
					$_FILES['template_document1']['name'] = $_FILES['template_document']['name'][$l];
					$_FILES['template_document1']['type'] = $_FILES['template_document']['type'][$l];
                	$_FILES['template_document1']['tmp_name'] = $_FILES['template_document']['tmp_name'][$l];
                	$_FILES['template_document1']['error'] = $_FILES['template_document']['error'][$l];
                	$_FILES['template_document1']['size'] = $_FILES['template_document']['size'][$l];
					
						$image_name = $_FILES['template_document']['name'][$l];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->upload->initialize($config);
						if(!$this->upload->do_upload('template_document1'))
						{
							//echo "not upladed";
						}
					}else{
						$img_name =$_POST['previous_document'][$l];	
					}
					//echo "<br>bb-->".$img_name;	
					$actid_unique++;
					$sql_com="SELECT completed from activity WHERE activity_name='".addslashes($_POST['rowC'.$newj][$l])."' AND status=1 ORDER BY activity_id DESC LIMIT 1";
					$query_com=$this->db->query($sql_com);
					$res_com = $query_com->row(); 
					
					 
					if($res_com->completed){
						$completed = $res_com->completed;
					} else {
						$completed =  '';
					}
					$sql_actiity_ins="INSERT INTO activity (activity_name,planned_quantity,actually_quantity,start_date,finish_date,assigned_person,resources,template_reference,project_id,dependent_on,last_modified,template_document,activity_status,activity_status_modified,comments,completed) VALUES ('".addslashes($_POST['rowC'.$newj][$l])."','".$_POST['planned_quantity'][$l]."','".$_POST['actually_quantity'][$l]."','".$_POST['start_date'][$l]."','".$_POST['end_date'][$l]."','".$_POST['responsibilities'][$l]."','".$_POST['resources'][$l]."','".$_POST['template_reference'][$l]."','".$this->uri->segment('3')."','".$_POST['dependency'][$l]."',now(),'".$img_name."','".$_POST['activity_status'][$l]."','".$_POST['activity_status_modified'][$l]."','".$_POST['comments'][$l]."','".$completed."')";
					$this->db->query($sql_actiity_ins);
					
					$autoid_activity=$this->db->insert_id();	
					
					$one_minus=$newj-1;					
					$values=$this->wbs_list_model->findme($_POST['rowC'.$one_minus],$l-1);
					
					$parent_value=end($values);
					$new_array=array();
					
					for($p=0;$p<$process_count;$p++){
					
						$newp=$p+3;
						array_push($new_array,$_POST['rowC'.$newp]);
					
						
					}
					
					
					
					for($counter=$l;$counter>0;$counter--){
						$value_my=$this->wbs_list_model->find_value_from_array($counter,$new_array);
						//print_r($value_my);
						if($value_my!=""){
						
						/*
						* To find mega process id of prcoess do another query
						*/
						//echo "<br>Counter-->".$counter;
						for($mp_counter=$counter;$mp_counter>=0;$mp_counter--){
						$value_my_mp=$this->wbs_list_model->find_value_from_array($mp_counter,$new_array1);
							if($value_my_mp!=""){
								
							$sqlmp="select mp_id from mega_process WHERE mp_name='".addslashes($value_my_mp)."'   AND project_id='".$this->uri->segment('3')."' AND status=0  ORDER BY mp_id DESC LIMIT 1";
					$querymp=$this->db->query($sqlmp);
					$resmp = $querymp->result(); 
					break;
							
							}
						
						}
						
					$sql1="select pid,unique_code from process WHERE process_name='".addslashes($value_my)."'   AND project_id='".$this->uri->segment('3')."' AND status=0 and mp_id='".$resmp[0]->mp_id."'  ORDER BY pid DESC LIMIT 1";
					$query1=$this->db->query($sql1);
					$res1 = $query1->row(); 	
							
				
					
					//echo "<br>aaa-->".$res1->pid;
					//echo "<br>bbb-->".$id_activity;
					//echo "<br>Activity Name-->".$_POST['rowC'.$newj][$l];
					if($id_activity!=$res1->pid && $id_activity!=''){
						$actid_unique=1;	
					}
					$unique_code=$res1->unique_code.".".$actid_unique;	
						
					$sql_update_parent="UPDATE activity SET process_id='".$res1->pid."',unique_code='".$unique_code."' WHERE activity_id='".$autoid_activity."'   AND project_id='".$this->uri->segment('3')."'  AND status=0 ";
					$this->db->query($sql_update_parent);
					
					$id_activity=$res1->pid;	
							break;
						}
					
					}
					
					$sql="select activity_id,unique_code from activity WHERE activity_name='".addslashes($parent_value)."'   AND project_id='".$this->uri->segment('3')."'  AND status=0  ORDER BY activity_id DESC LIMIT 1";
					$query=$this->db->query($sql);
					$res = $query->row(); 
					
					if($res->activity_id >0){
					$actid_unique1++;	
					if($id_activity1!=$res->activity_id && $id_activity1!=''){
						$actid_unique1=1;	
					}
					$unique_code1=$res->unique_code.".".$actid_unique1;	
						
					$sql_update_parent="UPDATE activity SET parent_activity_id='".$res->activity_id."',unique_code='".$unique_code1."' WHERE activity_id='".$autoid_activity."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ";
					$this->db->query($sql_update_parent);
					$id_activity1=$res->activity_id;	
					}
					else{
					$sql_update_parent="UPDATE activity SET parent_activity_id='".$res->activity_id."' WHERE activity_id='".$autoid_activity."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ";
					$this->db->query($sql_update_parent);	
					}
					
					
					
					
					}
					
					}
						
					}	
						

						

				redirect(base_url().'wbs_list/'. 'index/' . $this->uri->segment('3'));	

					}else{
						
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('Wbs/edit_wbs', $data);
						$this->load->view('footer');
					}
				}elseif($role == 'Editor'){
					if(isset($_POST['project_id'])){
					//print_r($_POST);
					$counts = array_count_values($_POST['cell']);
				    $process_count=$counts['Process'];
				   $activity_count=$counts['Activity'];
				   $mp_count=$counts['Mega Process'];
					$sdate_count=$counts['Start Date'];
					
					$is_wbs_submitted=$_POST['is_wbs_submitted'];	
					
					//-------If header array has blank elements then redirect to error page  
					if(in_array('',$_POST['cell'])  || $mp_count>1 || $sdate_count > 1)  {
						
					$this->session->set_flashdata('headers_empty','It seems that header values are not set or there is something wrong with header');	
					redirect(base_url().'wbs_list/'. 'index/' . $this->uri->segment('3'));	
						
					}
					
					$sqlmp="UPDATE mega_process SET status=1 WHERE project_id='".$_POST['project_id']."'";
					//$sqlmp="truncate table  mega_process";
					$this->db->query($sqlmp);
					
					$sqlp="UPDATE process SET status=1 WHERE project_id='".$_POST['project_id']."'";
					//$sqlp="truncate table  process";
					$this->db->query($sqlp);
					
					$sqla="UPDATE activity SET status=1 WHERE project_id='".$_POST['project_id']."'";
					//$sqla="truncate table  activity";
					$this->db->query($sqla);
					
					
					/*foreach (@glob('./template_document/'.$this->uri->segment('3')."/*.*") as $filename) {
					if (is_file($filename)) {
						unlink($filename);
					}
					}*/
					$json_string = json_encode($_POST);
				    $file = fopen($_POST['project_id'].".txt","w");
					fwrite($file,$json_string);
					fclose($file);
					
					$sql_column_ins="UPDATE project_name SET process_columns='".$process_count."', activity_columns='".$activity_count."',is_wbs_submitted='".$is_wbs_submitted."' WHERE project_id='".$_POST['project_id']."'";
					$this->db->query($sql_column_ins);
					
					$counter_mp=0;
					for($i=0;$i<count($_POST['rowC2']);$i++){
						
						if($_POST['rowC2'][$i]!=''){
							$counter_mp++;
							$sql_mp_ins="INSERT INTO mega_process (mp_name,project_id,last_modified,unique_code) 
					VALUES ('".addslashes($_POST['rowC2'][$i])."','".$this->uri->segment('3')."',now(),'".$counter_mp."')";
							$this->db->query($sql_mp_ins);	
						}
						
					}
					$count_p=0;
					$count_p1=0;
					$mpid_unique='';
					$mpid_unique1='';
					for($i=0;$i<$process_count;$i++){
						
					$newi=$i+3;
					for($k=0;$k<count($_POST['rowC'.$newi]);$k++){	
					
					//echo "<br>newi-->".$newi;
					if($_POST['rowC'.$newi][$k]!=''){
					
					if($i==0){	
					$count_p++;
					$sql_process_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('','".addslashes($_POST['rowC'.$newi][$k])."','','".$this->uri->segment('3')."',now())";
					$this->db->query($sql_process_ins);
					
					$autoid_process=$this->db->insert_id();	
					
					$values_mp=addslashes($this->wbs_list_model->findme($_POST['rowC2'],$k-1));
					$parent_value_mp=addslashes(end($values_mp));
					
				$sql_mp="select mp_id,unique_code from mega_process WHERE mp_name='".$parent_value_mp."' AND status=0 ORDER BY mp_id DESC LIMIT 1";
					$query_mp=$this->db->query($sql_mp);
					$res_mp = $query_mp->row(); 
					
					
					/*echo "<br>bbb-->".$mpid_unique;
					echo "<br>ccc-->".$res_mp->mp_id;*/
					if($mpid_unique!=$res_mp->mp_id && $mpid_unique!=''){
						$count_p=1;	
					}
					
					$unique_code=$res_mp->unique_code.".".$count_p;
					
					
					$sql_update_parent="UPDATE process SET mp_id='".$res_mp->mp_id."',
					unique_code='".$unique_code."' WHERE pid='".$autoid_process."'  AND status=0 ";
					$this->db->query($sql_update_parent);
					
					$mpid_unique=$res_mp->mp_id;	
					
					}else {
					$count_p1++;	
					$sql_process_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('','".addslashes($_POST['rowC'.$newi][$k])."','','".$this->uri->segment('3')."',now())";
					$this->db->query($sql_process_ins);
					$autoid_process=$this->db->insert_id();		
					
					$one_minus=$newi-1;	
					/*echo "New II-->".$newi;	
					echo "One minus-->".$one_minus=$newi-1;
					
					echo "K value-->".$k;*/
					
					$values=$this->wbs_list_model->findme($_POST['rowC'.$one_minus],$k-1);
					$parent_value=addslashes(end($values));
					
					$values_mp=$this->wbs_list_model->findme($_POST['rowC2'],$k-1);
					$parent_value_mp=addslashes(end($values_mp));
					//print_r($values);
					
					$sql_mp="select mp_id from mega_process WHERE mp_name='".$parent_value_mp."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ORDER BY mp_id DESC LIMIT 1";
					$query_mp=$this->db->query($sql_mp);
					$res_mp = $query_mp->result(); 
					
					$sql="select pid,unique_code from process WHERE process_name='".$parent_value."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ORDER BY pid DESC LIMIT 1";
					$query=$this->db->query($sql);
					$res = $query->row(); 
		
					//print_r($res);
					
					
					if($mpid_unique1!=$res->pid && $mpid_unique1!=''){
						$count_p1=1;	
					}
					
					$unique_code=$res->unique_code.".".$count_p1;
					
		
					$sql_update_parent="UPDATE process SET parent_processid='".$res->pid."',mp_id='".$res_mp[0]->mp_id."',unique_code='".$unique_code."' WHERE pid='".$autoid_process."'   AND project_id='".$this->uri->segment('3')."'  AND status=0  ";
					$this->db->query($sql_update_parent);	
					
					$mpid_unique1=$res->pid;	
					}
					
					
					}
						
					}
					
					
					}
					
					$new_array1=array();
					for($p1=0;$p1<count($_POST['rowC2']);$p1++){
					
						
						array_push($new_array1,$_POST['rowC2']);
					
						
					}
					
					//print_r($new_array1);
					
					
					$id_activity='';
					for($j=0;$j<$activity_count;$j++){
					
					/*echo "<br>m-->".$j;
					echo "<br>newi-->".$newi;
					echo "<br>activity_count-->".$activity_count;*/
					$newj=	$j+$newi+1;
					$actid_unique=0;
					$id_activity1='';
					$actid_unique1=0;
					$this->load->library('upload');
					//echo "<br>Count----->".count($_POST['rowC'.$newj]);
					for($l=0;$l<count($_POST['rowC'.$newj]);$l++){	
					
					//echo "<br>Activirt value is--->".$_POST['rowC'.$newj][$l];
					if($_POST['rowC'.$newj][$l]!=''){
					if (!is_dir('./template_document/'.$this->uri->segment('3'))) {
   					 	mkdir('./template_document/' . $this->uri->segment('3'), 0777, TRUE);
					}	
					
					if($_FILES['template_document']['name'][$l]!='') {
					
					$config['upload_path'] = './template_document/'. $this->uri->segment('3');
					$config['allowed_types'] = '*';
					$config['overwrite'] = TRUE;
					$_FILES['template_document1']['name'] = $_FILES['template_document']['name'][$l];
					$_FILES['template_document1']['type'] = $_FILES['template_document']['type'][$l];
                	$_FILES['template_document1']['tmp_name'] = $_FILES['template_document']['tmp_name'][$l];
                	$_FILES['template_document1']['error'] = $_FILES['template_document']['error'][$l];
                	$_FILES['template_document1']['size'] = $_FILES['template_document']['size'][$l];
					
						$image_name = $_FILES['template_document']['name'][$l];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->upload->initialize($config);
						if(!$this->upload->do_upload('template_document1'))
						{
							//echo "not upladed";
						}
					}else{
						$img_name =$_POST['previous_document'][$l];	
					}
					$actid_unique++;
					$sql_com="SELECT completed from activity WHERE activity_name='".addslashes($_POST['rowC'.$newj][$l])."' AND status=1 ORDER BY activity_id DESC LIMIT 1";
					$query_com=$this->db->query($sql_com);
					$res_com = $query_com->row(); 
					
					 
					if($res_com->completed){
						$completed = $res_com->completed;
					} else {
						$completed ='';
					}

					 $sql_actiity_ins="INSERT INTO activity (activity_name,planned_quantity,actually_quantity,start_date,finish_date,assigned_person,resources,template_reference,project_id,dependent_on,last_modified,template_document,activity_status,activity_status_modified,comments,completed) VALUES ('".addslashes($_POST['rowC'.$newj][$l])."','".$_POST['planned_quantity'][$l]."','".$_POST['actually_quantity'][$l]."','".$_POST['start_date'][$l]."','".$_POST['end_date'][$l]."','".$_POST['responsibilities'][$l]."','".$_POST['resources'][$l]."','".$_POST['template_reference'][$l]."','".$this->uri->segment('3')."','".$_POST['dependency'][$l]."',now(),'".$img_name."','".$_POST['activity_status'][$l]."','".$_POST['activity_status_modified'][$l]."','".$_POST['comments'][$l]."','".$completed."')";
					$this->db->query($sql_actiity_ins);
					
					$autoid_activity=$this->db->insert_id();	
					
					$one_minus=$newj-1;					
					$values=$this->wbs_list_model->findme($_POST['rowC'.$one_minus],$l-1);
					
					$parent_value=end($values);
					$new_array=array();
					
					for($p=0;$p<$process_count;$p++){
					
						$newp=$p+3;
						array_push($new_array,$_POST['rowC'.$newp]);
					
						
					}
					
					
					
					for($counter=$l;$counter>0;$counter--){
						$value_my=$this->wbs_list_model->find_value_from_array($counter,$new_array);
						//print_r($value_my);
						if($value_my!=""){
						
						/*
						* To find mega process id of prcoess do another query
						*/
						//echo "<br>Counter-->".$counter;
						for($mp_counter=$counter;$mp_counter>=0;$mp_counter--){
						$value_my_mp=$this->wbs_list_model->find_value_from_array($mp_counter,$new_array1);
							if($value_my_mp!=""){
								
							$sqlmp="select mp_id from mega_process WHERE mp_name='".addslashes($value_my_mp)."'   AND project_id='".$this->uri->segment('3')."' AND status=0  ORDER BY mp_id DESC LIMIT 1";
					$querymp=$this->db->query($sqlmp);
					$resmp = $querymp->result(); 
					break;
							
							}
						
						}
						
					$sql1="select pid,unique_code from process WHERE process_name='".addslashes($value_my)."'   AND project_id='".$this->uri->segment('3')."' AND status=0 and mp_id='".$resmp[0]->mp_id."'  ORDER BY pid DESC LIMIT 1";
					$query1=$this->db->query($sql1);
					$res1 = $query1->row(); 	
							
				
					
					//echo "<br>aaa-->".$res1->pid;
					//echo "<br>bbb-->".$id_activity;
					//echo "<br>Activity Name-->".$_POST['rowC'.$newj][$l];
					if($id_activity!=$res1->pid && $id_activity!=''){
						$actid_unique=1;	
					}
					$unique_code=$res1->unique_code.".".$actid_unique;	
						
					$sql_update_parent="UPDATE activity SET process_id='".$res1->pid."',unique_code='".$unique_code."' WHERE activity_id='".$autoid_activity."'   AND project_id='".$this->uri->segment('3')."'  AND status=0 ";
					$this->db->query($sql_update_parent);
					
					$id_activity=$res1->pid;	
							break;
						}
					
					}
					
					$sql="select activity_id,unique_code from activity WHERE activity_name='".addslashes($parent_value)."'   AND project_id='".$this->uri->segment('3')."'  AND status=0  ORDER BY activity_id DESC LIMIT 1";
					$query=$this->db->query($sql);
					$res = $query->row(); 
					
					if($res->activity_id >0){
					$actid_unique1++;	
					if($id_activity1!=$res->activity_id && $id_activity1!=''){
						$actid_unique1=1;	
					}
					$unique_code1=$res->unique_code.".".$actid_unique1;	
						
					$sql_update_parent="UPDATE activity SET parent_activity_id='".$res->activity_id."',unique_code='".$unique_code1."' WHERE activity_id='".$autoid_activity."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ";
					$this->db->query($sql_update_parent);
					$id_activity1=$res->activity_id;	
					}
					else{
					$sql_update_parent="UPDATE activity SET parent_activity_id='".$res->activity_id."' WHERE activity_id='".$autoid_activity."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ";
					$this->db->query($sql_update_parent);	
					}
					
					
					
					
					}
					
					}
						
					}	
						

						

				redirect(base_url().'wbs_list/'. 'index/' . $this->uri->segment('3'));	

					}else{
						
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('Wbs/edit_wbs', $data);
						$this->load->view('footer');
					}
				}elseif($role == 'Project Manager'){
					if(isset($_POST['project_id'])){
					//print_r($_POST);die;
					$counts = array_count_values($_POST['cell']);
				    $process_count=$counts['Process'];
				   $activity_count=$counts['Activity'];
				   $mp_count=$counts['Mega Process'];
					$sdate_count=$counts['Start Date'];
					
					
					$is_wbs_submitted=$_POST['is_wbs_submitted'];	
					
					
					//-------If header array has blank elements then redirect to error page  
					if(in_array('',$_POST['cell'])  || $mp_count>1 || $sdate_count > 1)  {
						
					$this->session->set_flashdata('headers_empty','It seems that header values are not set or there is something wrong with header');	
					redirect(base_url().'wbs_list/'. 'index/' . $this->uri->segment('3'));	
						
					}
					
					$sqlmp="UPDATE mega_process SET status=1 WHERE project_id='".$_POST['project_id']."'";
					//$sqlmp="truncate table  mega_process";
					$this->db->query($sqlmp);
					
					$sqlp="UPDATE process SET status=1 WHERE project_id='".$_POST['project_id']."'";
					//$sqlp="truncate table  process";
					$this->db->query($sqlp);
					
					$sqla="UPDATE activity SET status=1 WHERE project_id='".$_POST['project_id']."'";
					//$sqla="truncate table  activity";
					$this->db->query($sqla);
					
					
					/*foreach (@glob('./template_document/'.$this->uri->segment('3')."/*.*") as $filename) {
					if (is_file($filename)) {
						unlink($filename);
					}
					}*/
					$json_string = json_encode($_POST);
				    $file = fopen($_POST['project_id'].".txt","w");
					fwrite($file,$json_string);
					fclose($file);
					
					$sql_column_ins="UPDATE project_name SET process_columns='".$process_count."', activity_columns='".$activity_count."',is_wbs_submitted='".$is_wbs_submitted."' WHERE project_id='".$_POST['project_id']."'";
					$this->db->query($sql_column_ins);
					
					$counter_mp=0;
					for($i=0;$i<count($_POST['rowC2']);$i++){
						
						if($_POST['rowC2'][$i]!=''){
							$counter_mp++;
							$sql_mp_ins="INSERT INTO mega_process (mp_name,project_id,last_modified,unique_code) 
					VALUES ('".addslashes($_POST['rowC2'][$i])."','".$this->uri->segment('3')."',now(),'".$counter_mp."')";
							$this->db->query($sql_mp_ins);	
						}
						
					}
					$count_p=0;
					$count_p1=0;
					$mpid_unique='';
					$mpid_unique1='';
					for($i=0;$i<$process_count;$i++){
						
					$newi=$i+3;
					for($k=0;$k<count($_POST['rowC'.$newi]);$k++){	
					
					//echo "<br>newi-->".$newi;
					if($_POST['rowC'.$newi][$k]!=''){
					
					if($i==0){	
					$count_p++;
					$sql_process_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('','".addslashes($_POST['rowC'.$newi][$k])."','','".$this->uri->segment('3')."',now())";
					$this->db->query($sql_process_ins);
					
					$autoid_process=$this->db->insert_id();	
					
					$values_mp=$this->wbs_list_model->findme($_POST['rowC2'],$k-1);
					$parent_value_mp=addslashes(end($values_mp));
					
				$sql_mp="select mp_id,unique_code from mega_process WHERE mp_name='".$parent_value_mp."' AND status=0 ORDER BY mp_id DESC LIMIT 1";
					$query_mp=$this->db->query($sql_mp);
					$res_mp = $query_mp->row(); 
					
					
					/*echo "<br>bbb-->".$mpid_unique;
					echo "<br>ccc-->".$res_mp->mp_id;*/
					if($mpid_unique!=$res_mp->mp_id && $mpid_unique!=''){
						$count_p=1;	
					}
					
					$unique_code=$res_mp->unique_code.".".$count_p;
					
					
					$sql_update_parent="UPDATE process SET mp_id='".$res_mp->mp_id."',
					unique_code='".$unique_code."' WHERE pid='".$autoid_process."'  AND status=0 ";
					$this->db->query($sql_update_parent);
					
					$mpid_unique=$res_mp->mp_id;	
					
					}else {
					$count_p1++;	
					$sql_process_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('','".addslashes($_POST['rowC'.$newi][$k])."','','".$this->uri->segment('3')."',now())";
					$this->db->query($sql_process_ins);
					$autoid_process=$this->db->insert_id();		
					
					$one_minus=$newi-1;	
					/*echo "New II-->".$newi;	
					echo "One minus-->".$one_minus=$newi-1;
					
					echo "K value-->".$k;*/
					
					$values=$this->wbs_list_model->findme($_POST['rowC'.$one_minus],$k-1);
					$parent_value=addslashes(end($values));
					
					$values_mp=$this->wbs_list_model->findme($_POST['rowC2'],$k-1);
					$parent_value_mp=addslashes(end($values_mp));
					//print_r($values);
					
					$sql_mp="select mp_id from mega_process WHERE mp_name='".$parent_value_mp."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ORDER BY mp_id DESC LIMIT 1";
					$query_mp=$this->db->query($sql_mp);
					$res_mp = $query_mp->result(); 
					
					$sql="select pid,unique_code from process WHERE process_name='".$parent_value."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ORDER BY pid DESC LIMIT 1";
					$query=$this->db->query($sql);
					$res = $query->row(); 
		
					//print_r($res);
					
					
					if($mpid_unique1!=$res->pid && $mpid_unique1!=''){
						$count_p1=1;	
					}
					
					$unique_code=$res->unique_code.".".$count_p1;
					
		
					$sql_update_parent="UPDATE process SET parent_processid='".$res->pid."',mp_id='".$res_mp[0]->mp_id."',unique_code='".$unique_code."' WHERE pid='".$autoid_process."'   AND project_id='".$this->uri->segment('3')."'  AND status=0  ";
					$this->db->query($sql_update_parent);	
					
					$mpid_unique1=$res->pid;	
					}
					
					
					}
						
					}
					
					
					}
					
					$new_array1=array();
					for($p1=0;$p1<count($_POST['rowC2']);$p1++){
					
						
						array_push($new_array1,$_POST['rowC2']);
					
						
					}
					
					//print_r($new_array1);
					
					
					$id_activity='';
					for($j=0;$j<$activity_count;$j++){
					
					/*echo "<br>m-->".$j;
					echo "<br>newi-->".$newi;
					echo "<br>activity_count-->".$activity_count;*/
					$newj=	$j+$newi+1;
					$actid_unique=0;
					$id_activity1='';
					$actid_unique1=0;
					$this->load->library('upload');
					//echo "<br>Count----->".count($_POST['rowC'.$newj]);
					for($l=0;$l<count($_POST['rowC'.$newj]);$l++){	
					
					//echo "<br>Activirt value is--->".$_POST['rowC'.$newj][$l];
					if($_POST['rowC'.$newj][$l]!=''){
					if (!is_dir('./template_document/'.$this->uri->segment('3'))) {
   					 	mkdir('./template_document/' . $this->uri->segment('3'), 0777, TRUE);
					}	
					
					if($_FILES['template_document']['name'][$l]!='') {
					
					$config['upload_path'] = './template_document/'. $this->uri->segment('3');
					$config['allowed_types'] = '*';
					$config['overwrite'] = TRUE;
					$_FILES['template_document1']['name'] = $_FILES['template_document']['name'][$l];
					$_FILES['template_document1']['type'] = $_FILES['template_document']['type'][$l];
                	$_FILES['template_document1']['tmp_name'] = $_FILES['template_document']['tmp_name'][$l];
                	$_FILES['template_document1']['error'] = $_FILES['template_document']['error'][$l];
                	$_FILES['template_document1']['size'] = $_FILES['template_document']['size'][$l];
					
						$image_name = $_FILES['template_document']['name'][$l];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->upload->initialize($config);
						if(!$this->upload->do_upload('template_document1'))
						{
							//echo "not upladed";
						}
					}else{
						$img_name =$_POST['previous_document'][$l];	
					}
					$actid_unique++;


					$sql_com="SELECT completed from activity WHERE activity_name='".addslashes($_POST['rowC'.$newj][$l])."' AND status=1 ORDER BY activity_id DESC LIMIT 1";
					$query_com=$this->db->query($sql_com);
					$res_com = $query_com->row(); 
					
					 
					if($res_com->completed){
						$completed = $res_com->completed;
					} else {
						$completed ='';
					}

					 $sql_actiity_ins="INSERT INTO activity (activity_name,planned_quantity,actually_quantity,start_date,finish_date,assigned_person,resources,template_reference,project_id,dependent_on,last_modified,template_document,activity_status,activity_status_modified,comments,completed) VALUES ('".addslashes($_POST['rowC'.$newj][$l])."','".$_POST['planned_quantity'][$l]."','".$_POST['actually_quantity'][$l]."','".$_POST['start_date'][$l]."','".$_POST['end_date'][$l]."','".$_POST['responsibilities'][$l]."','".$_POST['resources'][$l]."','".$_POST['template_reference'][$l]."','".$this->uri->segment('3')."','".$_POST['dependency'][$l]."',now(),'".$img_name."','".$_POST['activity_status'][$l]."','".$_POST['activity_status_modified'][$l]."','".$_POST['comments'][$l]."','".$completed."')";
					$this->db->query($sql_actiity_ins);
					
					$autoid_activity=$this->db->insert_id();	
					
					$one_minus=$newj-1;					
					$values=$this->wbs_list_model->findme($_POST['rowC'.$one_minus],$l-1);
					
					$parent_value=addslashes(end($values));
					$new_array=array();
					
					for($p=0;$p<$process_count;$p++){
					
						$newp=$p+3;
						array_push($new_array,$_POST['rowC'.$newp]);
					
						
					}
					
					
					
					for($counter=$l;$counter>0;$counter--){
						$value_my=$this->wbs_list_model->find_value_from_array($counter,$new_array);
						//print_r($value_my);
						if($value_my!=""){
						
						/*
						* To find mega process id of prcoess do another query
						*/
						//echo "<br>Counter-->".$counter;
						for($mp_counter=$counter;$mp_counter>=0;$mp_counter--){
						$value_my_mp=$this->wbs_list_model->find_value_from_array($mp_counter,$new_array1);
							if($value_my_mp!=""){
								
							$sqlmp="select mp_id from mega_process WHERE mp_name='".addslashes($value_my_mp)."'   AND project_id='".$this->uri->segment('3')."' AND status=0  ORDER BY mp_id DESC LIMIT 1";
					$querymp=$this->db->query($sqlmp);
					$resmp = $querymp->result(); 
					break;
							
							}
						
						}
						
					$sql1="select pid,unique_code from process WHERE process_name='".addslashes($value_my)."'   AND project_id='".$this->uri->segment('3')."' AND status=0 and mp_id='".$resmp[0]->mp_id."'  ORDER BY pid DESC LIMIT 1";
					$query1=$this->db->query($sql1);
					$res1 = $query1->row(); 	
							
				
					
					//echo "<br>aaa-->".$res1->pid;
					//echo "<br>bbb-->".$id_activity;
					//echo "<br>Activity Name-->".$_POST['rowC'.$newj][$l];
					if($id_activity!=$res1->pid && $id_activity!=''){
						$actid_unique=1;	
					}
					$unique_code=$res1->unique_code.".".$actid_unique;	
						
					$sql_update_parent="UPDATE activity SET process_id='".$res1->pid."',unique_code='".$unique_code."' WHERE activity_id='".$autoid_activity."'   AND project_id='".$this->uri->segment('3')."'  AND status=0 ";
					$this->db->query($sql_update_parent);
					
					$id_activity=$res1->pid;	
							break;
						}
					
					}
					
					$sql="select activity_id,unique_code from activity WHERE activity_name='".addslashes($parent_value)."'   AND project_id='".$this->uri->segment('3')."'  AND status=0  ORDER BY activity_id DESC LIMIT 1";
					$query=$this->db->query($sql);
					$res = $query->row(); 
					
					if($res->activity_id >0){
					$actid_unique1++;	
					if($id_activity1!=$res->activity_id && $id_activity1!=''){
						$actid_unique1=1;	
					}
					$unique_code1=$res->unique_code.".".$actid_unique1;	
						
					$sql_update_parent="UPDATE activity SET parent_activity_id='".$res->activity_id."',unique_code='".$unique_code1."' WHERE activity_id='".$autoid_activity."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ";
					$this->db->query($sql_update_parent);
					$id_activity1=$res->activity_id;	
					}
					else{
					$sql_update_parent="UPDATE activity SET parent_activity_id='".$res->activity_id."' WHERE activity_id='".$autoid_activity."'  AND project_id='".$this->uri->segment('3')."'  AND status=0 ";
					$this->db->query($sql_update_parent);	
					}
					
					
					
					
					}
					
					}
						
					}	
						

						

				redirect(base_url().'wbs_list/'. 'index/' . $this->uri->segment('3'));	

					}else{
						
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('Wbs/edit_wbs', $data);
						$this->load->view('footer');
					}
				}elseif($role == 'Team Member'){
					if(isset($_POST['wbssubmit'])){}else{
						
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('Wbs/edit_wbs', $data);
						$this->load->view('footer');
					}
				}
			} else {
				redirect(base_url().'login/');
			}					
		}
		public function update_pm_permission()
		{
			$per = $this->input->post('status');
			$pm_list = $this->input->post('pm_list');
			$this->wbs_list_model->update_pm($per,$pm_list); 
		}
		
		public function update_tm_permission()
		{
			$tmper = $this->input->post('tmstatus');
			$tm_list = $this->input->post('tm_list');
			$this->wbs_list_model->update_tm($tmper,$tm_list); 
		}
	}
?>