<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



	class Wbs_list extends CI_Controller {

		

		public function __construct(){  

			parent::__construct();  

			$this->load->model("wbs_list_model");

			$this->load->model("wbs_model");

			$this->load->model("users_model");

			$this->load->model("edit_wbs_model");

			$this->load->model('logo_model');

			$this->load->model('odif_model');

			$this->load->model('dashboard_model');

			$this->load->model('projects_model');

			$this->load->library('Csvimport');

			$this->load->helper('csv');

			$this->load->library('email');

			error_reporting(0); 			

		} 

		

		public function mail1() {

			

			// echo base_url('/uploads');die;

		$this->load->library('email');



              		$this->load->library('parser');

					$this->email->clear();



				$config['mailtype'] = "html";



				$config['useragent'] = 'CodeIgniter';



				$config['protocol'] = 'smtp';



				$this->email->initialize($config);



				$this->email->set_newline("\r\n");

		

					 $this->email->from('plot@pboplus.com');



        // $this->email->from('plot@pboplus.com', 'Plot');

        $this->email->to('singh.kunal104@gmail.com'); 



        $this->email->subject('Email Test');

        $this->email->message("<body>

<style>

*{

font-family: 'Open Sans', sans-serif;	

padding:0;

margin:0;	

}

</style>

<table class='table' style='width:700px;max-width:100%; margin:0 auto;' border='0' cellpadding='0' cellspacing='0' bgcolor='#24a158'>

<tbody>

	<tr>

    	<td align='center'><img src='http://algn.development-review.net/images/logo.png' alt=''/></td>

    </tr>

    <tr>

    	<td align='center'>

        	<table class='table' cellpadding='10' cellspacing='10' border='0' bgcolor='#ffffff' width='95%'>

            	<tbody>

       

    <tr>

   

    <td style='font-size:14px;color:#5b6a6f;padding:10px 25px;'>

    	<p>You has been invited by meeting creator  for a meeting meeting name scheduled at date time.</p>

        <p><strong>Would you like to do Accept Decline?</strong></p>

    </td>

    <td style='padding:10px;'><img src='http://algn.development-review.net/images/plane.png' alt=''/></td>

    </tr>

   

    <tr>

    <td colspan='2'>

    	<table width='100%'>

        <tbody>

        <tr>

    	<td align='right' width='50%'><a href='#'><img src='http://algn.development-review.net/images/accept.png' alt='accept'/></a></td>

        <td align='left' width='50%'><a href='#'><img src='http://algn.development-review.net/images/decline.png' alt='decline'/></a></td>

        </tr>

        </tbody>

        </table>

        </td>

    </tr>

     <tr>

    	<td colspan='2'><p>&nbsp;</p></td>

    </tr>

    <tr>

    <td style='font-size:14px;color:#5b6a6f;padding:10px 25px;' colspan='2'>

    	<p>See you soon on Algn app. if you don’t have the app.  you can download it from the Google Play Store or Iphone Store.</p>

        <br>

<p><strong>Thanks<br>

Algn Team</strong>

</p>

    </td>

    </tr>

     <tr>

    	<td colspan='2'><p>&nbsp;</p></td>

    </tr>

    <tr>

    <td colspan='2' align='center' bgcolor='#f8f8f8' style='font-size:12px;padding:20px 0;line-height:15px;font-weight:500;'>

    <p>You are receiving this email because you are requested with Algn. <br>

If you do not wish to receive any further communications, please unsubscrddibe here<br> 

@ ".date("Y")." PBOPlus Consulting Services Ltd. All rights reserved</p>

    </td>

    </tr>

</tbody>

            </table>        

    	</td>

    </tr>

    <tr>

    	<td><p>&nbsp;</p></td>

    </tr>

    

</tbody>



</table>



</body>");  



        // $this->email->send();



       // echo $this->email->print_debugger();





        //$this->load->view('email_view');







    if ($this->email->send()) {

        echo 'Your email was sent, thanks chamil.';

    } else {

        show_error($this->email->print_debugger());

    }	

			

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

			$get_id =  $this->uri->segment('3');

			

	       

			if(isset($_POST['export']))

			{

                $get_id =  $this->uri->segment('3');

				$this->load->dbutil();

				$this->load->helper('file');

				$this->load->helper('download');

				$delimiter = ",";

				$newline = "\r\n";

				$filename = "wbs.csv";

				$result=$this->wbs_list_model->select($get_id);

				$data = $this->dbutil->csv_from_result($result, $delimiter, $newline);

				force_download($filename, $data);

					   

			}



			////////////////////////////////

			

			

			$get_id =  $this->uri->segment('3');

			//$data['tm_details'] = $this->wbs_model->get_assiged_tm_details($get_id);

	        $data['assign_pm_list'] = $this->projects_model->assign_pmlist($get_id);

			$data['assign_tm_list'] = $this->projects_model->assign_tmlist($get_id);

			$data['project_details']=$this->projects_model->view_projects_details_id($get_id);

			

			

			

			

			//$pmtmlist = array_merge($data["assign_pm_list"], $data['assign_tm_list']);

			 

			 /////////Share send

			  if(isset($_POST['sharesend'])){

				   $stitle = $_POST['sharetitle'];

				   $ssubject = $_POST['sharename'];

				   $smessage = $_POST['sharemessage'];

		  

		     foreach($data['assign_pm_list'] as $key=>$value){

		        $pmid = $value['pm_list'];

			 

			  }

			 foreach($data['assign_tm_list'] as $key=>$value){

				$tmid = $value['tm_list'];

			

			 }

			 

		}

		/////////Final Approve send

		 if(isset($_POST['finalsend'])){

				    $ftitle = $_POST['finaltitle'];

				    $fname = $_POST['finalname'];

				    $fmessage = $_POST['finalmessage'];

					

		              $config=array(

						'charset'=>'utf-8',

						'wordwrap'=> TRUE,

						'mailtype' => 'html'

						);

					

				foreach($data['assign_pm_list'] as $key=>$value){

				   $pmid = $value['pm_list'];

				   $this->wbs_list_model->delete_pm_permission($get_id,$pmid);

						

						$this->email->initialize($config);

						$this->email->to($pmid);

						$this->email->from($fromemail, "Final");

						$this->email->subject($fname);

						$this->email->message($fmessage);

						$mail = $this->email->send();

		

			   }

			   foreach($data['assign_tm_list'] as $key=>$value){

				  $tmid = $value['tm_list'];

				  $this->wbs_list_model->delete_tm_permission($get_id,$tmid);

				  

				        $this->email->initialize($config);

						$this->email->to($tmid);

						$this->email->from($fromemail, "Final");

						$this->email->subject($fname);

						$this->email->message($fmessage);

						$mail = $this->email->send();

		

		 }

			 

		 }

		 /////////Reject

		 if(isset($_POST['rejectsend'])){

				    $rtitle = $_POST['rejecttitle'];

				    $rname = $_POST['rname'];

				    $rmessage = $_POST['rejectmessage'];

		  

				foreach($data['assign_pm_list'] as $key=>$value){

				   $pmid = $value['pm_list'];

			 

		

			   }

			   foreach($data['assign_tm_list'] as $key=>$value){

				  $tmid = $value['tm_list'];

		

		 }

			 

		 }

			//////////////////////////

			$loggedin = $this->logged_in();

			if($loggedin == TRUE) {

				

				

				$get_id =  $this->uri->segment('3');

				$user_id = $this->session->userdata['user_id'];

				$role = $this->session->userdata['role'];

				$uname = $this->session->userdata['name'];

				

				$data['logo'] = $this->logo_model->view_logo();

				$data['user_detail'] = $this->dashboard_model->view_details($user_id);

				$data['project_details'] = $this->wbs_model->get_project_details($get_id);

				$data['responsible_person']=$this->wbs_model->get_reponsible_person($get_id);

				

				$data['all_mp']=$this->wbs_list_model->get_all_mega_process($get_id);

				$data['all_process']=$this->wbs_list_model->get_all_process($get_id);

				

				//assigned PM list and TM list

				//$data['assign_pm_list'] = $this->projects_model->assign_pmlist($get_id);

			    //$data['assign_tm_list'] = $this->projects_model->assign_tmlist($get_id);

				//check permission wbs edit

				$data['pmpermissionwbs']=$this->wbs_list_model->wbs_edit_pm($user_id);

				$data['tmpermissionwbs']=$this->wbs_list_model->wbs_edit_tm($user_id); 

			

						    //print_r($data['getcomment']); die;

				

				//insert user comment

				if(isset($_POST['ucomment'])){

				    $usercomment = $_POST['usercomment'];

					$data['mycomment']=$this->wbs_list_model->user_comment($get_id,$user_id,$uname,$usercomment);

					//print_r($data['mycomment']); die; 	

				    redirect(base_url().'wbs_list/'. 'index/' . $this->uri->segment('3'));

				}

				

							

				if($role == 'Admin'){

						

					$data['wbs_data']=$this->wbs_list_model->get_wbs_data($this->uri->segment('3'));

					//print_r($wbs_data);

					$this->load->view('header', $data);

					$this->load->view('admin_sidebar', $data);

										

					$this->load->view('Wbs/wbs_list', $data);

					

					$this->load->view('footer');

				}elseif($role == 'Editor'){

					$data['wbs_data']=$this->wbs_list_model->get_wbs_data($this->uri->segment('3'));

					//print_r($wbs_data);

					$this->load->view('header', $data);

					$this->load->view('admin_sidebar', $data);

										

					$this->load->view('Wbs/wbs_list', $data);

					

					$this->load->view('footer');

				}elseif($role == 'Project Manager'){

					$data['wbs_data']=$this->wbs_list_model->get_wbs_data($this->uri->segment('3'));

					$this->load->view('header', $data);

					$this->load->view('admin_sidebar', $data);

										

					$this->load->view('Wbs/wbs_list', $data);

				 
					$this->load->view('footer');

				}elseif($role == 'Team Member'){

					$data['wbs_data']=$this->wbs_list_model->get_wbs_data($this->uri->segment('3'));

					//print_r($wbs_data);

					$this->load->view('header', $data);

					$this->load->view('admin_sidebar', $data);

										

					$this->load->view('Wbs/wbs_list', $data);

					

					$this->load->view('footer');

				}

				

			} else {

				redirect(base_url().'login/');

			}					

		}

		

		/*----------------developed by Samar Jeet Singh----------------------------------------*/

		public function search_list()

		{

		   //$project_id=$this->uri->segment('3');

		   if(isset($_POST['activity_filter']))

		   {

		      $filter_value= $this->input->post('activity_filter');

			  $this->wbs_list_model->getRequiredActivity('2015-10-16','2016-10-24');

			  

		   }

		   else

		   {

		     echo "nothing to show";

		   }

		}

		/*-----------------End Samar Jeet Singh------------------------------------------------*/

		

		

		public function update_pm_permission()

		{   

		

				$user_id = $this->session->userdata['user_id'];

				$role = $this->session->userdata['role'];

			if($role == 'Admin' || $role == 'Editor'){

			//update permission

					$per = $this->input->post('status');

			        $pm_list = $this->input->post('pm_list');

			        $this->wbs_list_model->update_pm($per,$pm_list); 

			}

		}

		

		public function update_tm_permission()

		{  

		        $user_id = $this->session->userdata['user_id'];

				$role = $this->session->userdata['role'];

		    if($role != "Team Member"){

					$tmper = $this->input->post('tmstatus');

					$tm_list = $this->input->post('tm_list');

					$this->wbs_list_model->update_tm($tmper,$tm_list); 

		  }

		}

		

// 		public function import(){

			

// 		//print_r($_FILES)	;

// 		$handle = fopen($_FILES['csv_to_process']['tmp_name'], "r");

		

// 		$header = null;

// 		while ($row = fgetcsv($handle, 10000, ",")) {

// 		//print_r($row);

// 		if ($header === null) {

// 			$header = $row;

// 			continue;

// 		}



// 		//$all_rows[]= array_map('foo', $header, $row);	

//    		$all_rows[] = $this->wbs_list_model->array_combine_new($header, $row);

// 		}

// 		//print_r($all_rows);

		

// 		if($_FILES['csv_to_process']['tmp_name']!=''){

					

// 					$sqlmp="DELETE FROM mega_process WHERE project_id='".$_POST['project_id']."'";

					

// 					//$sqlmp="truncate table  mega_process";

					

// 					$this->db->query($sqlmp);

					

// 					$sqlp="DELETE FROM  process WHERE  project_id='".$_POST['project_id']."'";

					

// 					//$sqlp="truncate table  process";

// 					$this->db->query($sqlp);

					

// 					$sqla="DELETE FROM  activity WHERE project_id='".$_POST['project_id']."'";

					

// 					//$sqla="truncate table  activity";

// 					$this->db->query($sqla);

					

		

	

		

		

// 		for($i=0;$i<count($all_rows);$i++){

		

// 		//print_r($all_rows);

// 		if(is_array($all_rows[$i]['Process'])){

// 		 	$process_count=count($all_rows[$i]['Process']);

// 		}else{

// 			$process_count=1;	

// 		}

// 		if(is_array($all_rows[$i]['Activity'])){

// 		 $activity_count=count($all_rows[$i]['Activity']);

// 		}else{

// 			$activity_count=1;	

// 		}

		 

// 		 //echo "<br>aaa-->".$process_count;

// 		 // echo "<br>bbb-->".$activity_count;

		 

// 		$sql_column_ins="UPDATE project_name SET process_columns='".$process_count."', activity_columns='".$activity_count."' WHERE project_id='".$_POST['projectid']."'";

// 		$this->db->query($sql_column_ins);	

		

// 		//echo "<br>MP Value-->".$all_rows[$i]['Mega Process'];

// 		if($all_rows[$i]['Mega Process']!=''){

// 		$sql_ins="INSERT INTO mega_process (mp_name,project_id,last_modified) VALUES ('".addslashes($all_rows[$i]['Mega Process'])."','".$_POST['projectid']."',now())";	 		

		

// 		$this->db->query($sql_ins);

// 		$autoid_mp=$this->db->insert_id();		

// 		}

		

// 		if(is_array($all_rows[$i]['Process'])){

			

		

// 		foreach($all_rows[$i]['Process'] as $key => $value){

// 	if($value!=''){

// 	echo "<br>The value is-->".$value;

// 	if($key==0){

// 	$sql_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('".$autoid_mp."','".addslashes($value)."','','".$_POST['projectid']."',now())";	

// 	$this->db->query($sql_ins);

// 	$autoid_process=$this->db->insert_id();		

// 	}

// 	else{

// 		$sql_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('".$autoid_mp."','".addslashes($value)."','','".$_POST['projectid']."',now())";	

// 	  $this->db->query($sql_ins);

// 	 $autoid_process=$this->db->insert_id();		

// 		$values=$this->wbs_list_model->findmykey($all_rows,'Process',$key-1,$i);

// 		$parent_value=addslashes(end($values));

		

// 		$sql="select pid from process WHERE process_name='".$parent_value."' AND project_id='".$_POST['projectid']."' AND status=0 ORDER BY pid DESC LIMIT 1";

// 		$query=$this->db->query($sql);

// 		$res = $query->result(); 

		

// 		//print_r($res);

		

// 		$sql_update_parent="UPDATE process SET parent_processid='".$res[0]->pid."' 

// 		WHERE pid='".$autoid_process."'   AND project_id='".$_POST['projectid']."'  AND status=0 ";

// 		$this->db->query($sql_update_parent);

		

		

// 	}

// 	}

// }



// 		}else{

			

// 			//echo "under";

// 				if($all_rows[$i]['Process']!=''){

				

// 		$sql_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('".$autoid_mp."','".addslashes($all_rows[$i]['Process'])."','','".$_POST['projectid']."',now())";	

// 	  $this->db->query($sql_ins);

// 	  $autoid_process=$this->db->insert_id();	

	  

	  

// 	  $myval1=array();

// 		for($j=0;$j<$i;$j++){

	

// 			if($all_rows[$j]['Mega Process']!='')

// 			{

// 				//echo "<br>aaaa-->".$all_rows[$j]['Process'];	

// 				array_push($myval1,$all_rows[$j]['Mega Process']);

// 			}

			

// 		}

		

// 		//print_r($myval);

		

// 		//echo "<br>aaaa-->".$i;

		

// 		$parent_value1=addslashes(end($myval1));

		

// 		//print_r($values);

		

// 		$sql="select mp_id from mega_process WHERE mp_name='".$parent_value1."' AND project_id='".$_POST['projectid']."'  AND status=0  ORDER BY mp_id DESC LIMIT 1";

// 		$query=$this->db->query($sql);

// 		$res = $query->result(); 

		

// 		//print_r($res);

		

// 		$sql_update_parent="UPDATE process SET mp_id='".$res[0]->mp_id."' 

// 		WHERE pid='".$autoid_process."'   AND project_id='".$_POST['projectid']."'  AND status=0   ";

// 		$this->db->query($sql_update_parent);

		

					

// 				}

				

		

			

// 		}

		

// 	if(is_array($all_rows[$i]['Activity'])){	

// $date_modified=date("Y-m-d H:i:s");

// 	foreach($all_rows[$i]['Activity'] as $key => $value){

// 		if($value!=''){

			

// 		if($all_rows[$i]['Start Date']!=''){

// 						$st_date=explode('/',$all_rows[$i]['Start Date']);

// 						if(strlen($st_date[2])==2){

// 							$new_start_date=$st_date[0].'/'.$st_date[1].'/20'.$st_date[2];	

// 						}else{

// 							$new_start_date=$all_rows[$i]['Start Date']	;	

// 						}

						

// 					}

					

// 					if($all_rows[$i]['Finish Date']!=''){

// 						$en_date=explode('/',$all_rows[$i]['Finish Date']);

// 						if(strlen($en_date[2])==2){

// 							$new_end_date=$en_date[0].'/'.$en_date[1].'/20'.$en_date[2];	

// 						}else{

// 							$new_end_date=$all_rows[$i]['Finish Date'];		

// 						}

						

// 					}

						

// 		//echo "<br>The value is-->".$value;

// 			if($key==0){

// 				$sql_ins="INSERT INTO activity (activity_name,process_id,planned_quantity,actually_quantity,start_date,finish_date,assigned_person,

// 				dependent_on,resources,template_reference,project_id,last_modified,comments,activity_status,activity_status_modified) 

// 				VALUES ('".addslashes($value)."','".$autoid_process."','".$all_rows[$i]['Planned Quantity']."','".$all_rows[$i]['Actual Quantity']."','".$new_start_date."',

// 				'".$new_end_date."','".$all_rows[$i]['Assigned Person']."','','".$all_rows[$i]['Resources']."','".$all_rows[$i]['Template Reference']."','".$_POST['projectid']."',now(),'".$all_rows[$i]['Comments']."','".$all_rows[$i]['Status']."','".$date_modified."')";	

// 				$this->db->query($sql_ins);

// 			}

// 		else{

// 		$sql_ins="INSERT INTO activity (activity_name,process_id,planned_quantity,actually_quantity,start_date,finish_date,assigned_person,

// dependent_on,parent_activity_id,resources,template_reference,project_id,last_modified,comments,activity_status,activity_status_modified) 

// 		VALUES ('".addslashes($value)."','".$autoid_process."','".$all_rows[$i]['Planned Quantity']."','".$all_rows[$i]['Actual Quantity']."','".$new_start_date."',

// 		'".$new_end_date."','".$all_rows[$i]['Assigned Person']."','','',

// 		'".$all_rows[$i]['Resources']."','".$all_rows[$i]['Template Reference']."','".$_POST['projectid']."',now(),'".$all_rows[$i]['Comments']."','".$all_rows[$i]['Status']."','".$date_modified."')";	

// 	 	$this->db->query($sql_ins);

// 	  	$autoid_activity=$this->db->insert_id();	

// 	 	$values=$this->wbs_list_model->findmykey($all_rows,'Activity',$key-1,$i);

// 	 	$parent_value_activity=addslashes(end($values));

		

// 		$sql="select activity_id from activity WHERE activity_name='".$parent_value_activity."'  AND project_id='".$_POST['projectid']."'  AND status=0   ORDER BY activity_id DESC LIMIT 1";

// 		$query=$this->db->query($sql);

// 		$res = $query->result(); 

		

// 		$sql_update_parent="UPDATE activity SET parent_activity_id='".$res[0]->activity_id."' WHERE 

// 		activity_id='".$autoid_activity."'   AND project_id='".$_POST['projectid']."'  AND status=0 ";

// 		$this->db->query($sql_update_parent);

		

		

// 		}

// 	 }

//  }

 

// 	}else{

		

// 				if($all_rows[$i]['Start Date']!=''){

// 						$st_date=explode('/',$all_rows[$i]['Start Date']);

// 						if(strlen($st_date[2])==2){

// 							$new_start_date=$st_date[0].'/'.$st_date[1].'/20'.$st_date[2];	

// 						}else{

// 							$new_start_date=$all_rows[$i]['Start Date']	;	

// 						}

						

// 					}

					

// 					if($all_rows[$i]['Finish Date']!=''){

// 						$en_date=explode('/',$all_rows[$i]['Finish Date']);

// 						if(strlen($en_date[2])==2){

// 							$new_end_date=$en_date[0].'/'.$en_date[1].'/20'.$en_date[2];	

// 						}else{

// 							$new_end_date=$all_rows[$i]['Finish Date'];		

// 						}

						

// 					}

				

// 				$date_modified=date("Y-m-d H:i:s");

// 				if($all_rows[$i]['Activity']!=''){

				

// 			$sql_ins="INSERT INTO activity (activity_name,process_id,planned_quantity,actually_quantity,start_date,finish_date,assigned_person,

// 		dependent_on,parent_activity_id,resources,template_reference,project_id,last_modified,comments,activity_status,activity_status_modified) 

// 		VALUES ('".addslashes($all_rows[$i]['Activity'])."','".$autoid_process."','".$all_rows[$i]['Planned Quantity']."','".$all_rows[$i]['Actual Quantity']."','".$new_start_date."',

// 		'".$new_end_date."','".$all_rows[$i]['Assigned Person']."','','',

// 		'".$all_rows[$i]['Resources']."','".$all_rows[$i]['Template Reference']."','".$_POST['projectid']."',now(),'".$all_rows[$i]['Comments']."','".$all_rows[$i]['Status']."','".$date_modified."')";	

// 	 	$this->db->query($sql_ins);

// 	  	$autoid_activity=$this->db->insert_id();	

// 		$myval=array();

// 		for($j=0;$j<$i;$j++){

	

// 			if($all_rows[$j]['Process']!='')

// 			{

// 				//echo "<br>aaaa-->".$all_rows[$j]['Process'];	

// 				array_push($myval,$all_rows[$j]['Process']);

// 			}

			

// 		}

		

// 		//print_r($myval);

		

// 		//echo "<br>aaaa-->".$i;

		

// 		$parent_value=addslashes(end($myval));

		

// 		//print_r($values);

		

// 		$sql="select pid from process WHERE process_name='".$parent_value."' AND project_id='".$_POST['projectid']."'  AND status=0  ORDER BY pid DESC LIMIT 1";

// 		$query=$this->db->query($sql);

// 		$res = $query->result(); 

		

// 		//print_r($res);

		

// 		$sql_update_parent="UPDATE activity SET process_id='".$res[0]->pid."' 

// 		WHERE activity_id='".$autoid_activity."'   AND project_id='".$_POST['projectid']."'  AND status=0   ";

// 		$this->db->query($sql_update_parent);

		

					

// 				}

				

			

// 	}

		

// 		//die;	

		

// 		}

// 		$autoid_process='';	

// 		$autoid_activity='';

// 		}

// 	$sql_column_ins="UPDATE project_name SET is_wbs_submitted='0' WHERE project_id='".$_POST['projectid']."'";

// 	$this->db->query($sql_column_ins);	

// 	header ("location:".base_url()."wbs_list/index/".$_POST['projectid']."/");

		

// 	}


public function import(){

			

	//print_r($_FILES)	;

	$handle = fopen($_FILES['csv_to_process']['tmp_name'], "r");

	

	$header = null;

	while ($row = fgetcsv($handle, 10000, ",")) {

	//print_r($row);

	if ($header === null) {

		$header = $row;

		continue;

	}



	//$all_rows[]= array_map('foo', $header, $row);	

	   $all_rows[] = $this->wbs_list_model->array_combine_new($header, $row);

	}

	//print_r($all_rows);

	

	if($_FILES['csv_to_process']['tmp_name']!=''){

				

				$sqlmp="DELETE FROM mega_process WHERE project_id='".$_POST['project_id']."'";

				

				//$sqlmp="truncate table  mega_process";

				

				$this->db->query($sqlmp);

				

				$sqlp="DELETE FROM  process WHERE  project_id='".$_POST['project_id']."'";

				

				//$sqlp="truncate table  process";

				$this->db->query($sqlp);

				

				$sqla="DELETE FROM  activity WHERE project_id='".$_POST['project_id']."'";

				

				//$sqla="truncate table  activity";

				$this->db->query($sqla);

				

	



	

	

	for($i=0;$i<count($all_rows);$i++){

	

	//print_r($all_rows);

	if(is_array($all_rows[$i]['Process'])){

		 $process_count=count($all_rows[$i]['Process']);

	}else{

		$process_count=1;	

	}

	if(is_array($all_rows[$i]['Activity'])){

	 $activity_count=count($all_rows[$i]['Activity']);

	}else{

		$activity_count=1;	

	}

	 

	 //echo "<br>aaa-->".$process_count;

	 // echo "<br>bbb-->".$activity_count;

	 

	$sql_column_ins="UPDATE project_name SET process_columns='".$process_count."', activity_columns='".$activity_count."' WHERE project_id='".$_POST['projectid']."'";

	$this->db->query($sql_column_ins);	

	

	//echo "<br>MP Value-->".$all_rows[$i]['Mega Process'];

	if($all_rows[$i]['Mega Process']!=''){

	$sql_ins="INSERT INTO mega_process (mp_name,project_id,last_modified) VALUES ('".addslashes($all_rows[$i]['Mega Process'])."','".$_POST['projectid']."',now())";	 		

	

	$this->db->query($sql_ins);

	$autoid_mp=$this->db->insert_id();		

	}

	

	if(is_array($all_rows[$i]['Process'])){

		

	

	foreach($all_rows[$i]['Process'] as $key => $value){

if($value!=''){

echo "<br>The value is-->".$value;

if($key==0){

$sql_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('".$autoid_mp."','".addslashes($value)."','','".$_POST['projectid']."',now())";	

$this->db->query($sql_ins);

$autoid_process=$this->db->insert_id();		

}

else{

	$sql_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('".$autoid_mp."','".addslashes($value)."','','".$_POST['projectid']."',now())";	

  $this->db->query($sql_ins);

 $autoid_process=$this->db->insert_id();		

	$values=$this->wbs_list_model->findmykey($all_rows,'Process',$key-1,$i);

	$parent_value=addslashes(end($values));

	

	$sql="select pid from process WHERE process_name='".$parent_value."' AND project_id='".$_POST['projectid']."' AND status=0 ORDER BY pid DESC LIMIT 1";

	$query=$this->db->query($sql);

	$res = $query->result(); 

	

	//print_r($res);

	

	$sql_update_parent="UPDATE process SET parent_processid='".$res[0]->pid."' 

	WHERE pid='".$autoid_process."'   AND project_id='".$_POST['projectid']."'  AND status=0 ";

	$this->db->query($sql_update_parent);

	

	

}

}

}



	}else{

		

		//echo "under";

			if($all_rows[$i]['Process']!=''){

			

	$sql_ins="INSERT INTO process (mp_id,process_name,parent_processid,project_id,last_modified) VALUES ('".$autoid_mp."','".addslashes($all_rows[$i]['Process'])."','','".$_POST['projectid']."',now())";	

  $this->db->query($sql_ins);

  $autoid_process=$this->db->insert_id();	

  

  

  $myval1=array();

	for($j=0;$j<$i;$j++){



		if($all_rows[$j]['Mega Process']!='')

		{

			//echo "<br>aaaa-->".$all_rows[$j]['Process'];	

			array_push($myval1,$all_rows[$j]['Mega Process']);

		}

		

	}

	

	//print_r($myval);

	

	//echo "<br>aaaa-->".$i;

	

	$parent_value1=addslashes(end($myval1));

	

	//print_r($values);

	

	$sql="select mp_id from mega_process WHERE mp_name='".$parent_value1."' AND project_id='".$_POST['projectid']."'  AND status=0  ORDER BY mp_id DESC LIMIT 1";

	$query=$this->db->query($sql);

	$res = $query->result(); 

	

	//print_r($res);

	

	$sql_update_parent="UPDATE process SET mp_id='".$res[0]->mp_id."' 

	WHERE pid='".$autoid_process."'   AND project_id='".$_POST['projectid']."'  AND status=0   ";

	$this->db->query($sql_update_parent);

	

				

			}

			

	

		

	}

	
	
if(is_array($all_rows[$i]['Activity'])){	

$date_modified=date("Y-m-d H:i:s");
 
foreach($all_rows[$i]['Activity'] as $key => $value){

	if($value!=''){

		
				
				if($all_rows[$i]['Start Date']!=''){
					$st_date=explode('/',$all_rows[$i]['Start Date']);
					if(strlen($st_date[2])==2){
						$new_start_date=$st_date[0].'/'.$st_date[1].'/20'.$st_date[2];	
					}else{
						$new_start_date=$all_rows[$i]['Start Date']	;	
					}
				}

			//	$new_start_date = convertDateFormat($all_rows[$i]['Start Date']);

				if($all_rows[$i]['Finish Date']!=''){
					$en_date=explode('/',$all_rows[$i]['Finish Date']);
					if(strlen($en_date[2])==2){
						$new_end_date=$en_date[0].'/'.$en_date[1].'/20'.$en_date[2];	
					}else{
						$new_end_date=$all_rows[$i]['Finish Date'];		
					}
				}

				// $new_end_date = convertDateFormat($all_rows[$i]['Finish Date']);

					

	//echo "<br>The value is-->".$value;

		if($key==0){

			$sql_ins="INSERT INTO activity (activity_name,process_id,planned_quantity,actually_quantity,start_date,finish_date,assigned_person,

			dependent_on,resources,template_reference,project_id,last_modified,comments,activity_status,activity_status_modified) 

			VALUES ('".addslashes($value)."','".$autoid_process."','".$all_rows[$i]['Planned Quantity']."','".$all_rows[$i]['Actual Quantity']."','".$new_start_date."',

			'".$new_end_date."','".$all_rows[$i]['Assigned Person']."','','".$all_rows[$i]['Resources']."','".$all_rows[$i]['Template Reference']."','".$_POST['projectid']."',now(),'".$all_rows[$i]['Comments']."','".$all_rows[$i]['Status']."','".$date_modified."')";	

			$this->db->query($sql_ins);

		}

	else{

	$sql_ins="INSERT INTO activity (activity_name,process_id,planned_quantity,actually_quantity,start_date,finish_date,assigned_person,

dependent_on,parent_activity_id,resources,template_reference,project_id,last_modified,comments,activity_status,activity_status_modified) 

	VALUES ('".addslashes($value)."','".$autoid_process."','".$all_rows[$i]['Planned Quantity']."','".$all_rows[$i]['Actual Quantity']."','".$new_start_date."',

	'".$new_end_date."','".$all_rows[$i]['Assigned Person']."','','',

	'".$all_rows[$i]['Resources']."','".$all_rows[$i]['Template Reference']."','".$_POST['projectid']."',now(),'".$all_rows[$i]['Comments']."','".$all_rows[$i]['Status']."','".$date_modified."')";	

	 $this->db->query($sql_ins);

	  $autoid_activity=$this->db->insert_id();	

	 $values=$this->wbs_list_model->findmykey($all_rows,'Activity',$key-1,$i);

	 $parent_value_activity=addslashes(end($values));

	

	$sql="select activity_id from activity WHERE activity_name='".$parent_value_activity."'  AND project_id='".$_POST['projectid']."'  AND status=0   ORDER BY activity_id DESC LIMIT 1";

	$query=$this->db->query($sql);

	$res = $query->result(); 

	

	$sql_update_parent="UPDATE activity SET parent_activity_id='".$res[0]->activity_id."' WHERE 

	activity_id='".$autoid_activity."'   AND project_id='".$_POST['projectid']."'  AND status=0 ";

	$this->db->query($sql_update_parent);

	

	

	}

 }

}



}else{

	

				if($all_rows[$i]['Start Date']!=''){
					$st_date=explode('/',$all_rows[$i]['Start Date']);
					if(strlen($st_date[2])==2){
						$new_start_date=$st_date[0].'/'.$st_date[1].'/20'.$st_date[2];	
					}else{
						$new_start_date=$all_rows[$i]['Start Date']	;	
					}
				}
				//echo $new_start_date;die;
				//$new_start_date = date("d/m/Y", strtotime($new_start_date));
				// $new_start_date = convertDateFormat($all_rows[$i]['Start Date']);

				
				if($all_rows[$i]['Finish Date']!=''){
					$en_date=explode('/',$all_rows[$i]['Finish Date']);
					if(strlen($en_date[2])==2){
						$new_end_date=$en_date[0].'/'.$en_date[1].'/20'.$en_date[2];	
					}else{
						$new_end_date=$all_rows[$i]['Finish Date'];		
					}
				}
				//$new_end_date = date("d/m/Y", strtotime($new_end_date));
			//	$new_end_date = convertDateFormat($all_rows[$i]['Finish Date']);
			

			$date_modified=date("Y-m-d H:i:s");
			$new_start_date = str_replace('-', '/', $new_start_date);
			$new_end_date = str_replace('-', '/', $new_end_date);
			if($all_rows[$i]['Activity']!=''){
				 
				// $new_start_date = date("d/m/Y", strtotime($new_start_date));
				// $new_end_date = date("d/m/Y", strtotime($new_end_date));
				//echo $new_start_date;die;
// echo $new_start_date;die;
		$sql_ins="INSERT INTO activity (activity_name,process_id,planned_quantity,actually_quantity,start_date,finish_date,assigned_person,

	dependent_on,parent_activity_id,resources,template_reference,project_id,last_modified,comments,activity_status,activity_status_modified) 

	VALUES ('".addslashes($all_rows[$i]['Activity'])."','".$autoid_process."','".$all_rows[$i]['Planned Quantity']."','".$all_rows[$i]['Actual Quantity']."','".$new_start_date."',

	'".$new_end_date."','".$all_rows[$i]['Assigned Person']."','','',

	'".$all_rows[$i]['Resources']."','".$all_rows[$i]['Template Reference']."','".$_POST['projectid']."',now(),'".$all_rows[$i]['Comments']."','".$all_rows[$i]['Status']."','".$date_modified."')";	
// echo $sql_ins;die;
	 $this->db->query($sql_ins);

	  $autoid_activity=$this->db->insert_id();	

	$myval=array();

	for($j=0;$j<$i;$j++){



		if($all_rows[$j]['Process']!='')

		{

			//echo "<br>aaaa-->".$all_rows[$j]['Process'];	

			array_push($myval,$all_rows[$j]['Process']);

		}

		

	}

	

	//print_r($myval);

	

	//echo "<br>aaaa-->".$i;

	

	$parent_value=addslashes(end($myval));

	

	//print_r($values);

	

	$sql="select pid from process WHERE process_name='".$parent_value."' AND project_id='".$_POST['projectid']."'  AND status=0  ORDER BY pid DESC LIMIT 1";

	$query=$this->db->query($sql);

	$res = $query->result(); 

	

	//print_r($res);

	

	$sql_update_parent="UPDATE activity SET process_id='".$res[0]->pid."' 

	WHERE activity_id='".$autoid_activity."'   AND project_id='".$_POST['projectid']."'  AND status=0   ";

	$this->db->query($sql_update_parent);

	

				

			}

			

		

}

	

	//die;	

	

	}

	$autoid_process='';	

	$autoid_activity='';

	}

$sql_column_ins="UPDATE project_name SET is_wbs_submitted='0' WHERE project_id='".$_POST['projectid']."'";

$this->db->query($sql_column_ins);	

header ("location:".base_url()."wbs_list/index/".$_POST['projectid']."/");

	

}

//-------------------function to call export data in excel-----------------------------



function export_data_in_excel()

{

ob_end_clean();

header("Content-type: application/vnd.ms-excel");

header("Content-Disposition: attachment; filename=report.xls");

header("Pragma: no-cache");

header("Expires: 0");



?>

<html xmlns:x="urn:schemas-microsoft-com:office:excel">

<head>

    <!--[if gte mso 9]>

    <xml>

        <x:ExcelWorkbook>

            <x:ExcelWorksheets>

                <x:ExcelWorksheet>

                    <x:Name>Sheet 1</x:Name>

                    <x:WorksheetOptions>

                        <x:Print>

                            <x:ValidPrinterInfo/>

                        </x:Print>

                    </x:WorksheetOptions>

                </x:ExcelWorksheet>

            </x:ExcelWorksheets>

        </x:ExcelWorkbook>

    </xml>

    <![endif]-->

    </head>

<body>

    <table width="100%" cellspacing="0" class="table2 table-bordered nowrap" id="datatable-keytable_wrapper">

            

		<thead>

        <tr style="background-color:#1D9F75;color:#FFFFFF;">

        <th class="cell12">Unique Code</th>

        <th class="cell12">Mega Process</th>

        <?php

      $sql_depth="SELECT process_columns, activity_columns FROM project_name  WHERE project_id='".$this->uri->segment('3')."'"; 	

	$res_depth= $this->db->query($sql_depth);

	$result_depth=$res_depth->row();

	$result_depth_process=$result_depth->process_columns;

	$result_depth_activity=$result_depth->activity_columns;

	//print_r($result_depth_activity);

		for($i=0;$i<$result_depth_process;$i++){

		?>

        

		<th class="cell13">Process</th>

        <?php } for($i=0;$i<$result_depth_activity;$i++){?>

        <th class="cell13">Activity

        

        </th>

        <?php } ?>
        <th class="cell13">Planned Quantity</th>
		
		<th class="cell13">Actual Quantity</th>
		
        <th class="cell13">Start Date</th>

        <th class="cell13">Finish Date</th>

        <th class="cell13">Assigned Person</th>

        <th class="cell13">Resources</th>

         <th> Dependency</th>

        <th class="cell13">Team Name</th>

        <th class="cell13">Template Document</th>

        <th class="cell13">Status</th>

        

		</tr>

         </thead>

         <tbody>   

            <?php

			

			$sql_mp="SELECT * FROM mega_process WHERE project_id='".$this->uri->segment('3')."' AND status=0";

			$res_mp=$this->db->query($sql_mp);

			

			//print_r($res_mp->result());



			$mp=0;

			foreach ($res_mp->result() as $result){

			$mp++;

			$sql_process="SELECT * FROM process WHERE mp_id='".$result->mp_id."' AND status=0";

			$res_process=$this->db->query($sql_process);

	

			?>

 			<tr>

            <td  align='left'> <?php echo $result->unique_code?></td>

      		<td align='left'>

        

            <?php echo $result->mp_name?>

           

            </td>

            

            <?php for($i=0;$i<$result_depth_process;$i++){?>

            

            <td></td>

      		<?php } for($i=0;$i<$result_depth_activity;$i++){ ?>

            

            <td></td>

            <?php }?>

            <td>&nbsp;</td>

           <td>&nbsp;</td>

           <td>&nbsp;</td>

           <td>&nbsp;</td>

           <td>&nbsp;</td>

           <td>&nbsp;</td>

           <td>&nbsp;</td>

         

			</tr>

      

<?php

			echo $this->wbs_list_model->tree_process_export(0,$result->mp_id,1,$this->uri->segment('3'));



		}

			?>



			</tbody>

			</table>

            </body></html>

    <?php

	

	}	

	

	function share(){

	$odif=$this->odif_model->get_todays_odif($_POST['projectid']);

	

	$p_details=$this->projects_model->view_projects_details_id($_POST['projectid']);

	$user_details= $this->users_model->get_user_details_byemail($p_details['user_id']);

	$powner=$this->projects_model->view_projects_details_id($_POST['projectid']);
	$currentDate = date('d-m-Y');
	//echo $currentDate;die;
	$count_of_activities=0;
	foreach($odif as $value){
		$count_of_activities=$count_of_activities+$value['actually_quantity'];
		//$tes=count($value['actually_quantity']);
	}
	//echo $tes;die;

	 	

	$message.="<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>

<body>

<style>

*{

font-family: 'Open Sans', sans-serif;	

padding:0;

margin:0;	

}

</style>

<table class='table' style='width:700px;max-width:100%; margin:0 auto;' border='0' cellpadding='0' cellspacing='0' bgcolor='#1d9f75'>

<tbody>

	<tr>

    	<td align='center'><img src='".base_url()."images/logo2.png' alt='Algn'/></td>

    </tr>

    <tr>

    	<td><p>&nbsp;</p></td>

    </tr>

    <tr>

    	<td align='center'>

        	<table class='table' cellpadding='10' cellspacing='10' border='0' bgcolor='#ffffff' width='95%'>

            	<tbody>

				 <tr>

                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0px;margin:0;'>

                    	Project Name:<a style='text-decoration:none;' href='".base_url()."/wbs_list/index/".$p_details['project_id']."'>".$p_details['project_name']."</a>

                    	

                    	</h4></td>

                    </tr>

                    

                    <tr>

                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0px;margin:0;'>

                    	Project Owner: ".$powner['name']." </h4></td>

                    </tr>
					<tr>

					<td style='color:#1d9f75;'>Date: ".$currentDate."</td>

                    </tr>
					<tr>

					<td style='color:#1d9f75;'>Total Activities: ".$count_of_activities."</td>

                    </tr>

                <tr>

                    	<td>".$_POST['share_message']."</td>

                    </tr>

                	<tr>

                    	<td><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:5px;'>Job Card</h4></td>

                    </tr>

                    <tr>

                    	<td style='    border: 1px solid #ddd;'>

                        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>

                            <thead>

                            	<tr>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>S. NO.</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>MEGA PROCESS</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PROCESS</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTIVITY</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PLANNED QUANTITY</th>

									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTUAL QUANTITY</th>

									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>START DATE</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>FINISH DATE</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>STATUS</th>

									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>COMMENTS</th>

                            	</tr>

                            </thead>

            	<tbody>";

$sl=0;
									//$count_of_activities=0;
									foreach($odif as $value){
										//$count_of_activities=$count_of_activities+$value['actually_quantity'];
										$sl++;

										if($value['activity_status']==0) {

											//$status="Incomplete";
											$status='0';

										}

										elseif($value['activity_status']==1) {

											//$status="Complete";
											$status='0';

										}                 

$message.="<tr bgcolor='#f6f6f6'>

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$sl."</td>

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['mp_name']."</td>

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['process_name']."</td>

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['activity_name']."</td>
						
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['planned_quantity']."</td>

						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['actually_quantity']."</td>

						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['start_date']."</td>
                		

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['finish_date']."</td>

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$status."</td>

							<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['comments']."</td>

                	</tr>";

   }              

 //echo $count_of_activities;die;                 

$message.="</tbody>

                </table>

                        </td>

                    </tr>

                       <tr>

    	<td><p>&nbsp;</p></td>

    </tr>

                     <tr>

    <td align='center' bgcolor='#f8f8f8' style='font-size:12px;padding:20px 0;line-height:15px;font-weight:500;'>

    <p>You are receiving this email because you are requested with PLOT. <br>

If you do not wish to receive any further communications, please unsubscribe here<br> 

@ ".date("Y")."  PBOPlus Consulting Services Ltd. All rights reserved</p>

    </td>

    </tr>

                </tbody>

            </table>        

    	</td>

    </tr>

    

     <tr>

    	<td><p>&nbsp;</p></td>

    </tr>

</tbody>



</table>



</body>";

	
//echo $message;die;
	 $emails=explode(",",$_POST['share_emails']);

	 $output = fopen('report.xls', 'w');

	 foreach($emails as $emails){

		 

		$this->load->library('email');

		

		$this->load->library('parser');

		$this->email->clear();

		

		$config['mailtype'] = "html";

		

		$config['useragent'] = 'CodeIgniter';

		

		$config['protocol'] = 'smtp';

		

		$this->email->initialize($config);

		

		$this->email->set_newline("\r\n");

		

		// $this->email->from('info@pboplot.com', 'Pboplus');
$this->email->from('plot@pboplus.com');

		 $this->email->to($emails);

		 $this->email->subject($_POST['share_subject']);

		 $this->email->message($message);

		 //$this->email->attach('report.xls');

		 $this->email->send();	

	 }

	redirect(base_url().'odif/'. 'index/' . $_POST['projectid']);					  

	//die;

		

	}

	//function to share ODIF reports
function share_odif(){

	$odif=$this->odif_model->get_todays_odif($_POST['projectid']);
	//print_r($odif);die;
	//print_r($odif['complete_activity']);die;

	

	$p_details=$this->projects_model->view_projects_details_id($_POST['projectid']);

	$user_details= $this->users_model->get_user_details_byemail($p_details['user_id']);

	$powner=$this->projects_model->view_projects_details_id($_POST['projectid']);
	$currentDate = date('d-m-Y');
	//echo $currentDate;die;
	$count_of_actual_activities=0;
	$count_of_total_activities=0;
	foreach($odif as $value){
		$count_of_actual_activities=$count_of_actual_activities+$value['actually_quantity'];
		$count_of_total_activities=$count_of_total_activities+$value['planned_quantity'];
	}
	// echo $count_of_actual_activities;
	// echo "<br>";
	// echo $count_of_total_activities;die;
	$performance=$count_of_actual_activities.'/'.$count_of_total_activities;
	$odif_score=($count_of_actual_activities/$count_of_total_activities)*100;
	$odif_score=round($odif_score,2).'%';
	// 	echo $performance;
	// echo "<br>";
	// echo $odif_score;die;

	 	

	$message.="<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>

<body>

<style>

*{

font-family: 'Open Sans', sans-serif;	

padding:0;

margin:0;	

}

</style>

<table class='table' style='width:700px;max-width:100%; margin:0 auto;' border='0' cellpadding='0' cellspacing='0' bgcolor='#1d9f75'>

<tbody>

	<tr>

    	<td align='center'><img src='".base_url()."images/logo2.png' alt='Algn'/></td>

    </tr>

    <tr>

    	<td><p>&nbsp;</p></td>

    </tr>

    <tr>

    	<td align='center'>

        	<table class='table' cellpadding='10' cellspacing='10' border='0' bgcolor='#ffffff' width='95%'>

            	<tbody>

				 <tr>

                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0px;margin:0;'>

                    	Project Name:<a style='text-decoration:none;' href='".base_url()."/wbs_list/index/".$p_details['project_id']."'>".$p_details['project_name']."</a>

                    	

                    	</h4></td>

                    </tr>

                    

                    <tr>

                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0px;margin:0;'>

                    	Project Owner: ".$powner['name']." </h4></td>

                    </tr>
					<tr>

					<td style='color:#1d9f75;'>Date: ".$currentDate."</td>

                    </tr>
					<tr>

					<td style='color:#1d9f75;'>Performance: ".$performance."</td>

                    </tr>
					<tr>

					<td style='color:#1d9f75;'>ODIF Score: ".$odif_score."</td>

                    </tr>

                <tr>

                    	<td>".$_POST['share_message']."</td>

                    </tr>

                	<tr>

                    	<td><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:5px;'>ODIF Report</h4></td>

                    </tr>

                    <tr>

                    	<td style='    border: 1px solid #ddd;'>

                        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>

                            <thead>

                            	<tr>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>S. NO.</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>MEGA PROCESS</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PROCESS</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTIVITY</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PLANNED QUANTITY</th>

									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTUAL QUANTITY</th>

									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>START DATE</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>FINISH DATE</th>

                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>STATUS</th>

									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>COMMENTS</th>

                            	</tr>

                            </thead>

            	<tbody>";

$sl=0;
									//$count_of_activities=0;
									foreach($odif as $value){
										//$count_of_activities=$count_of_activities+$value['actually_quantity'];
										$sl++;

										if($value['activity_status']==0) {

											//$status="Incomplete";
											$status='0';

										}

										elseif($value['activity_status']==1) {

											//$status="Complete";
											$status='0';

										}                 

$message.="<tr bgcolor='#f6f6f6'>

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$sl."</td>

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['mp_name']."</td>

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['process_name']."</td>

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['activity_name']."</td>
						
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['planned_quantity']."</td>

						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['actually_quantity']."</td>

						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['start_date']."</td>
                		

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['finish_date']."</td>

                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$status."</td>

							<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$value['comments']."</td>

                	</tr>";

   }              

 //echo $count_of_activities;die;                 

$message.="</tbody>

                </table>

                        </td>

                    </tr>

                       <tr>

    	<td><p>&nbsp;</p></td>

    </tr>

                     <tr>

    <td align='center' bgcolor='#f8f8f8' style='font-size:12px;padding:20px 0;line-height:15px;font-weight:500;'>

    <p>You are receiving this email because you are requested with PLOT. <br>

If you do not wish to receive any further communications, please unsubscribe here<br> 

@ ".date("Y")."  PBOPlus Consulting Services Ltd. All rights reserved</p>

    </td>

    </tr>

                </tbody>

            </table>        

    	</td>

    </tr>

    

     <tr>

    	<td><p>&nbsp;</p></td>

    </tr>

</tbody>



</table>



</body>";

	
//echo $message;die;
	 $emails=explode(",",$_POST['share_emails']);

	 $output = fopen('report.xls', 'w');

	 foreach($emails as $emails){

		 

		$this->load->library('email');

		

		$this->load->library('parser');

		$this->email->clear();

		

		$config['mailtype'] = "html";

		

		$config['useragent'] = 'CodeIgniter';

		

		$config['protocol'] = 'smtp';

		

		$this->email->initialize($config);

		

		$this->email->set_newline("\r\n");

		

		// $this->email->from('info@pboplot.com', 'Pboplus');
$this->email->from('plot@pboplus.com');

		 $this->email->to($emails);

		 $this->email->subject($_POST['share_subject']);

		 $this->email->message($message);

		 //$this->email->attach('report.xls');

		 $this->email->send();	

	 }

	redirect(base_url().'odif/'. 'index/' . $_POST['projectid']);					  

	//die;

		

	}	

public function share_wps()

{

	$project_id=$this->input->post('projectid');

	$send_emails=$this->input->post('share_emails');

	$subject=$this->input->post('share_subject');

	$share_message=$this->input->post('share_message');

	

	$p_details=$this->projects_model->view_projects_details_id($project_id);

	$powner=$this->projects_model->view_projects_details_id($project_id);

	

	$user_details= $this->users_model->get_user_details_byemail($p_details['user_id']);

	

	$message="<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>

<body>

<style>

*{

font-family: 'Open Sans', sans-serif;	

padding:0;

margin:0;	

}

</style>

<table class='table' style='width:700px;max-width:100%; margin:0 auto;' border='0' cellpadding='0' cellspacing='0' bgcolor='#1d9f75'>

<tbody>

	<tr>

    	<td align='center'><img src='".base_url()."images/logo2.png' alt=''/></td>

    </tr>

    <tr>

    	<td><p>&nbsp;</p></td>

    </tr>

    <tr>

    	<td align='center'>

        	<table class='table' cellpadding='10' cellspacing='10' border='0' bgcolor='#ffffff' width='95%'>

            	<tbody>

                 <tr>

                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0px;margin:0;'>

                    	Project Name:<a style='text-decoration:none;' href='".base_url()."/wbs_list/index/".$p_details['project_id']."'>".$p_details['project_name']."</a>

                    	

                    	</h4></td>

                    </tr>

                    

                    <tr>

                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0px;margin:0;'>

                    	Project Owner: ".$powner['name']." </h4></td>

                    </tr>

                	

                    

                       <tr>

    	<td>".$share_message."</td>

    </tr>

                     <tr>

    <td align='center' bgcolor='#f8f8f8' style='font-size:12px;padding:20px 0;line-height:15px;font-weight:500;'>

    <p>You are receiving this email because you are requested with PLOT. <br>

If you do not wish to receive any further communications, please unsubscribe here<br> 

@ ".date("Y")." PBOPlus Consulting Services Ltd. All rights reserved</p>

    </td>

    </tr>

                </tbody>

            </table>        

    	</td>

    </tr>

    

     <tr>

    	<td><p>&nbsp;</p></td>

    </tr>

</tbody>



</table>



</body>";





	ob_end_clean();

header("Content-type: application/vnd.ms-excel");

header("Content-Disposition: attachment; filename=report.xls");

header("Pragma: no-cache");

header("Expires: 0");

ob_start();



?>

<html xmlns:x="urn:schemas-microsoft-com:office:excel">

<head>

    <!--[if gte mso 9]>

    <xml>

        <x:ExcelWorkbook>

            <x:ExcelWorksheets>

                <x:ExcelWorksheet>

                    <x:Name>Sheet 1</x:Name>

                    <x:WorksheetOptions>

                        <x:Print>

                            <x:ValidPrinterInfo/>

                        </x:Print>

                    </x:WorksheetOptions>

                </x:ExcelWorksheet>

            </x:ExcelWorksheets>

        </x:ExcelWorkbook>

    </xml>

    <![endif]-->

    </head>

<body>

    <table width="100%" cellspacing="0" class="table2 table-bordered nowrap" id="datatable-keytable_wrapper">

            

		<thead>

        <tr style="background-color:#1D9F75;color:#FFFFFF;">

         <th class="cell12">Unique Code</th>

        <th class="cell12">Mega Process</th>

        <?php

      $sql_depth="SELECT process_columns, activity_columns FROM project_name  WHERE project_id='".$project_id."'"; 	

	$res_depth= $this->db->query($sql_depth);

	$result_depth=$res_depth->row();

	$result_depth_process=$result_depth->process_columns;

	$result_depth_activity=$result_depth->activity_columns;

	//print_r($result_depth_activity);

		for($i=0;$i<$result_depth_process;$i++){

		?>

        

		<th class="cell13">Process</th>

        <?php } for($i=0;$i<$result_depth_activity;$i++){?>

        <th class="cell13">Activity

        

        </th>

        <?php } ?>
        <th class="cell13">Planned Quantity</th>
		
		<th class="cell13">Actual Quantity</th>
		
        <th class="cell13">Start Date</th>

        <th class="cell13">Finish Date</th>

        <th class="cell13">Assigned Person</th>

        <th class="cell13">Resources</th>

        <th class="cell13"> Dependency</th>

		<th class="cell13">Team Name</th>

        <th class="cell13">Template Reference</th>	

		<th class="cell13">Status</th>

		</tr>

         </thead>

         <tbody>   

            <?php

			

			$sql_mp="SELECT * FROM mega_process WHERE project_id='".$project_id."' AND status=0";

			$res_mp=$this->db->query($sql_mp);

			

			//print_r($res_mp->result());



			$mp=0;

			foreach ($res_mp->result() as $result){

			$mp++;

			$sql_process="SELECT * FROM process WHERE mp_id='".$result->mp_id."' AND status=0";

			$res_process=$this->db->query($sql_process);

	

			?>

 			<tr>

            <td align="left">  <?php echo $result->unique_code?></td>

      		<td align="left">

            <!--<input type='textbox'  name='mega_process[<?php echo $result->mp_id?>]'  value='<?php echo $result->mp_name?>'>-->

            

            <?php echo $result->mp_name?>

           

            </td>

            

            <?php for($i=0;$i<$result_depth_process;$i++){?>

            

            <td></td>

      		<?php } for($i=0;$i<$result_depth_activity;$i++){ ?>

            

            <td></td>

            <?php }?>

            <td>&nbsp;</td>

           <td>&nbsp;</td>

           <td>&nbsp;</td>

           <td>&nbsp;</td>

           <td>&nbsp;</td>

           <td>&nbsp;</td>

			</tr>

      

<?php

			echo $this->wbs_list_model->tree_process_export(0,$result->mp_id,1,$project_id);



		}

			?>



			</tbody>

			</table>

            </body></html>

    <?php

	

	  $this->load->library('email');

        $this->load->library('parser');

		$this->email->clear();

		$config['mailtype'] = "html";

		$config['useragent'] = 'CodeIgniter';

		$config['protocol'] = 'smtp';

		$this->email->initialize($config);

		


	$output_so_far = ob_get_contents();
	
	 //print_r($output_so_far);die;

	ob_clean();
		$xls_file_name='WBS_'.$project_id.'.xls';
		//echo $xls_file_name;die;
		// if(file_exists("uploads/WBS.xls")){
		// 	echo "1";
		// }else{
		// 	echo "2";
		// }
		// die;
   file_put_contents("uploads/WBS.xls", $output_so_far);
  

   $emails=explode(",",$send_emails);

 foreach($emails as $emailss){
	$this->load->library('email');

		

		$this->load->library('parser');

		$this->email->clear();

		

		$config['mailtype'] = "html";

		

		$config['useragent'] = 'CodeIgniter';

		

		$config['protocol'] = 'smtp';		

		$this->email->initialize($config);

		$this->email->set_newline("\r\n");

		//$this->email->from('info@pboplot.com', 'Pboplus');
		$this->email->from('plot@pboplus.com');		

		 $this->email->to($emailss);

		 $this->email->subject($subject);

		 $this->email->message($message);
			
		 $this->email->attach('uploads/WBS.xls');
		 $this->email->send();	
//echo $this->email->print_debugger();

	 }
//die;
rename("uploads/WBS.xls","uploads/WBS_".time().".xls");
redirect('wbs_list/index/'.$project_id."/");

	}	

	

	public function clearwbs(){
		//echo "test";die;

	error_reporting(E_ALL)	;

	$pid=$_POST['pid'];

	$sqlmp="DELETE FROM  mega_process WHERE project_id='".$_POST['pid']."'";

					//$sqlmp="truncate table  mega_process";

	$this->db->query($sqlmp);

					

	$sqlp="DELETE FROM  process WHERE project_id='".$_POST['pid']."'";

	//$sqlp="truncate table  process";

	$this->db->query($sqlp);

	

	$sqla="DELETE FROM  activity  WHERE project_id='".$_POST['pid']."'";

	//$sqla="truncate table  activity";

	$this->db->query($sqla);

	

	$sql="UPDATE project_name SET is_wbs_submitted=0 WHERE project_id='".$_POST['pid']."'";

	$this->db->query($sql);

	

	echo "WBS Cleared";

	}

	

	}

?>