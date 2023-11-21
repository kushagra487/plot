<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



	class Odif extends CI_Controller {

		

		public function __construct(){  

			parent::__construct();  

			$this->load->model("odif_model");

			$this->load->model('logo_model');

			$this->load->model('dashboard_model'); 

			$this->load->model("wbs_model");

			$this->load->model("edit_wbs_model");

			$this->load->model("wbs_list_model");

			$this->load->model('dashboard_model');

			$this->load->model('projects_model');
            $this->load->model('users_model');

			$this->load->library('email');

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

		

		/*

		* Send Job card function Email will send to assigned Project Manager and employees

		*/

		

		public function send_job_card_members(){
//echo date("d-m-Y H:i:s A");



			echo "<br>server_time-->".$server_time=date("Y-m-d H:i");
				//echo "<br>".$server_time."<br>";
				echo "<br>current_time-->".$current_time=date("Y-m-d 07:00");
				
				if(strtotime($server_time)==strtotime($current_time)){
					
				$all_projects=$this->odif_model->get_all_projects();
				
				foreach($all_projects as $all_project) {
					
				$user_details= $this->users_model->get_user_details_byemail($all_project['user_id']);
				 	
				$activity_union=$this->odif_model->activity_union_projectwise($all_project['project_id']);
				$powner=$this->projects_model->view_projects_details_id($all_project['project_id']);
				
				foreach($activity_union as $activity_union) {
				$mailto=$activity_union['assigned_person'];	
				$activity_start_today=$this->odif_model->get_activity_start_today('project_id',$all_project['project_id']);
				$activity_end_today=$this->odif_model->get_activity_end_today('project_id',$all_project['project_id']);
//print_r($activity_end_today);

				$activity_start_end_today=$this->odif_model->get_activity_start_end_today('project_id',$all_project['project_id']);
				$message="<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>
<style>
*{
font-family: 'Open Sans', sans-serif;	
padding:0;
margin:0;	
}
</style><table class='table' style='width:700px;max-width:100%; margin:0 auto;' border='0' cellpadding='0' cellspacing='0' bgcolor='#1d9f75'>
<tbody>
	<tr>
    	<td align='center' colspan='2'><img src='".base_url()."images/logo2.png' alt=''/></td>
    </tr>
    <tr>
    	<td align='center'><table class='table' cellpadding='10' cellspacing='10' border='0' bgcolor='#ffffff' width='95%'><tbody>
		<tr>
                    	<td><strong style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0;margin:0;'>
                    	Project Name:<a style='text-decoration:none;' href='".base_url()."/wbs_list/index/".$all_project['project_id']."'>".$all_project['project_name']."</a>
                    	
                    	</strong></td><td><strong style='color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:5px;'>
                    	Project Owner: ".$powner['name']." </strong></td>
                    </tr>
                    
                   ";


			  	if(count($activity_start_today) >0){
			  $message.="<tr>
                    	<td colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Activities that Start Today:</h4></td>
                    </tr>
                    <tr>
                    	<td style='border: 1px solid #ddd;'  colspan='2'>
                        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>S. NO.</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>MEGA PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTIVITY</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ASSIGNED PERSON</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>TEAM NAME</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>START DATE</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>FINISH DATE</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>COMMENTS</th>
                            		
                            	</tr>
                            </thead>
            	<tbody>";

			$m=0;	

			foreach($activity_start_today as $activity_start_today) {
				$assign_user= $this->users_model->get_user_details_byemail($activity_start_today['assigned_person']);
				$m++;	

			   $message.="<tr bgcolor='#f6f6f6'>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$m."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['mp_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['process_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['activity_name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$assign_user['name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['template_reference']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['start_date']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['finish_date']."</td>
        <td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['comments']."</td>        		
                	</tr>";

			}

			$message.=" </tbody> </table> </td> </tr>";

			  }

				
				if(count($activity_end_today) >0){	 

					  $message.=" <tr>
                    	<td  colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Activities that End Today:</h4></td>
                    </tr>
                    <tr>
                    	<td style='border: 1px solid #ddd;'  colspan='2'>
                        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>S. NO.</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>MEGA PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTIVITY</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ASSIGNED PERSON</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>TEAM NAME</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>START DATE</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>FINISH DATE</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>COMMENTS</th>
                            		
                            	</tr>
                            </thead>
            	<tbody>";

				  $n=0;	

				foreach($activity_end_today as $activity_end_today) {

					$n++;	
					$assign_user= $this->users_model->get_user_details_byemail($activity_end_today['assigned_person']);
				   $message.="<tr>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$n."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['mp_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['process_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['activity_name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$assign_user['name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['template_reference']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['start_date']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['finish_date']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['comments']."</td>
                		
                	</tr>";

				}
			$message.="  </tbody></table></td></tr>";
				}

				
				if(count($activity_start_end_today) >0){	 

					  $message.=" <tr>
                    	<td  colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Activities that Start and End Today:</h4></td>
                    </tr>
                    <tr>
                    	<td style=' border: 1px solid #ddd;'  colspan='2'>
                        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>S. NO.</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>MEGA PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTIVITY</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ASSIGNED PERSON</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>TEAM NAME</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>START DATE</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>FINISH DATE</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>COMMENTS</th>
                            		
                            	</tr>
                            </thead>
            	<tbody>";  

				$l=0;

				foreach($activity_start_end_today as $activity_start_end_today) {

					$l++;	
					$assign_user= $this->users_model->get_user_details_byemail($activity_start_end_today['assigned_person']);
				   $message.="  <tr>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$l."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['mp_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['process_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['activity_name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$assign_user['name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['template_reference']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['start_date']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['finish_date']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['comments']."</td>
                	</tr>";

				}
				
			$message.=" </tbody></table></td></tr>";

				}

			
	 $message.="<tr>
    <td align='center' bgcolor='#f8f8f8' colspan='2' style='font-size:12px;padding:20px 0;line-height:15px;font-weight:500;'>
    <p>You are receiving this email because you are requested with PLOT. <br>
If you do not wish to receive any further communications, please unsubscribe here.<br> 
@ ".date("Y")." PBOPlus Consulting Services Ltd. All rights reserved.</p>
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
";

				

			echo $message;
//
			echo "<br>aaa-->".$mailto;

				if($mailto!=''){

					$this->load->library('email');

              		$this->load->library('parser');
					$this->email->clear();

				$config['mailtype'] = "html";

				$config['useragent'] = 'CodeIgniter';

				$config['protocol'] = 'smtp';

				$this->email->initialize($config);

				$this->email->set_newline("\r\n");
		
					$this->email->from('info@pboplot.com', 'Pboplus');

					$this->email->to($mailto);

						

					$this->email->subject('Today Job Card');

					$this->email->message($message);

					$this->email->send();	





				}

				$mailto='';	

				$message='';

				}

			

		}
		
		
				}
		
		}

		

		

		/*

		* Send Job card function Email will send to client email IDs

		*/

		

		public function send_job_clients(){
			
			
		echo "<br>server_time-->".$server_time=date("Y-m-d H:i");
				//echo "<br>".$server_time."<br>";
		echo "<br>current_time-->".$current_time=date("Y-m-d 07:00");
				
		if(strtotime($server_time)==strtotime($current_time)){	
			
		$all_projects=$this->odif_model->get_all_projects();
				
		foreach($all_projects as $all_project) {
		$user_details= $this->users_model->get_user_details_byemail($all_project['user_id']);				
		$activity_union=$this->odif_model->activity_union_clients_projectwise($all_project['project_id']);
		$powner=$this->projects_model->view_projects_details_id($all_project['project_id']);
		foreach($activity_union as $activity_union) {

				echo "<br>ccc-->".$project_id=$activity_union['project_id'];	

				$activity_start_today=$this->odif_model->get_activity_start_today('project_id',$all_project['project_id']);

				$activity_end_today=$this->odif_model->get_activity_end_today('project_id',$all_project['project_id']);

				$activity_start_end_today=$this->odif_model->get_activity_start_end_today('project_id',$all_project['project_id']);

				$project_details=$this->odif_model->get_project_reminder_time($all_project['project_id']);

				

				//print_r($project_details);

				

			$message="<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>
<style>
*{
font-family: 'Open Sans', sans-serif;	
padding:0;
margin:0;	
}
</style><table class='table' style='width:700px;max-width:100%; margin:0 auto;' border='0' cellpadding='0' cellspacing='0' bgcolor='#1d9f75'>
<tbody>
	<tr>
    	<td align='center' colspan='2'><img src='".base_url()."images/logo2.png' alt=''/></td>
    </tr>
    <tr>
    	<td align='center'><table class='table' cellpadding='10' cellspacing='10' border='0' bgcolor='#ffffff' width='95%'><tbody><tr>
                    	<td><strong style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0;margin:0;'>
                    	Project Name:<a style='text-decoration:none;' href='".base_url()."/wbs_list/index/".$all_project['project_id']."'>".$all_project['project_name']."</a>
                    	
                    	</strong></td><td><strong style='color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:5px;'>
                    	Project Owner: ".$powner['name']." </strong></td>
                    </tr>";

			  	if(count($activity_start_today) >0){
			  $message.="<tr>
                    	<td  colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Activities that Start Today:</h4></td>
                    </tr>
                    <tr>
                    	<td style='border: 1px solid #ddd;'  colspan='2'>
                        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>S. NO.</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>MEGA PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTIVITY</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ASSIGNED PERSON</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>TEAM NAME</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>START DATE</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>FINISH DATE</th>
                        <th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>COMMENTS</th>    		
                            	</tr>
                            </thead>
            	<tbody>";

			$m=0;	

			foreach($activity_start_today as $activity_start_today) {

				$m++;	
				$assign_user= $this->users_model->get_user_details_byemail($activity_start_today['assigned_person']);
			   $message.="<tr bgcolor='#f6f6f6'>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$m."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['mp_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['process_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['activity_name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$assign_user['name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['template_reference']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['start_date']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['finish_date']."</td>
      <td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['comments']."</td>          		
                	</tr>";

			}

			$message.=" </tbody> </table> </td> </tr>";

			  }

				
				if(count($activity_end_today) >0){	 

					  $message.=" <tr>
                    	<td  colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Activities that End Today:</h4></td>
                    </tr>
                    <tr>
                    	<td style='border: 1px solid #ddd;' colspan='2'>
                        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>S. NO.</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>MEGA PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTIVITY</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ASSIGNED PERSON</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>TEAM NAME</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>START DATE</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>FINISH DATE</th>
        						 <th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>COMMENTS</th>                   		
                            	</tr>
                            </thead>
            	<tbody>";

				  $n=0;	

				foreach($activity_end_today as $activity_end_today) {

					$n++;	
					$assign_user= $this->users_model->get_user_details_byemail($activity_end_today['assigned_person']);
				   $message.="<tr>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$n."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['mp_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['process_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['activity_name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$assign_user['name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['template_reference']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['start_date']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['finish_date']."</td>
   						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_end_today['comments']."</td>             		
                	</tr>";

				}
			$message.="  </tbody></table></td></tr>";
				}

				
				if(count($activity_start_end_today) >0){	 

					  $message.=" <tr>
                    	<td colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Activities that Start and End Today:</h4></td>
                    </tr>
                    <tr>
                    	<td style=' border: 1px solid #ddd;' colspan='2'>
                        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>S. NO.</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>MEGA PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTIVITY</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ASSIGNED PERSON</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>TEAM NAME</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>START DATE</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>FINISH DATE</th>
                     			<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>COMMENTS</th>       		
                            	</tr>
                            </thead>
            	<tbody>";  

				$l=0;

				foreach($activity_start_end_today as $activity_start_end_today) {

					$l++;	
$assign_user= $this->users_model->get_user_details_byemail($activity_start_end_today['assigned_person']);
				   $message.="  <tr>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$l."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['mp_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['process_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['activity_name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$assign_user['name']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['template_reference']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['start_date']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['finish_date']."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_end_today['comments']."</td>
                	
                	</tr>";

				}
				
			$message.=" </tbody></table></td></tr>";

				}

			
	 $message.="<tr>
    <td align='center' bgcolor='#f8f8f8' colspan='2' style='font-size:12px;padding:20px 0;line-height:15px;font-weight:500;'>
    <p>You are receiving this email because you are requested with PLOT. <br>
If you do not wish to receive any further communications, please unsubscribe here.<br> 
@ ".date("Y")." PBOPlus Consulting Services Ltd. All rights reserved.</p>
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
";
			

				echo "<br>aaa-->".$message;

				

				//echo "<br>dddd-->".$client_emails=$project_details['client_emails'];

				$client_emails=explode(",",$project_details->client_emails);

				//print_r($client_emails);

				foreach($client_emails as $client_emails){

				

				if($client_emails!=''){

					echo "<br>bbbb-->".$client_emails;
					$this->load->library('email');

              			$this->load->library('parser');
					$this->email->clear();

				$config['mailtype'] = "html";

			

				$this->email->initialize($config);

				$this->email->set_newline("\r\n");
		
					$this->email->from('info@pboplot.com', 'Pboplus');

					$this->email->to(trim($client_emails));

										

					$this->email->subject('Today Job Card');

					$this->email->message($message);

					$this->email->send();

				}

					$client_emails='';

					//$message='';

				}

					

				}

			

				}
			
		}

		}

		

		public function send_odif_report_reminder(){
				
			
			$all_projects=$this->odif_model->get_all_projects();

			foreach($all_projects as $all_projects){

				//$all_projects['project_id'];
                $user_details= $this->users_model->get_user_details_byemail($all_projects['user_id']);
				$reminder_time=$this->odif_model->get_project_reminder_time($all_projects['project_id']);
				$powner=$this->projects_model->view_projects_details_id($all_projects['project_id']);
				$reminder_time=$reminder_time->daterange;

				$assiged_tm=$this->wbs_model->get_assiged_tm_details($all_projects['project_id']);
				$assiged_pm=$this->wbs_model->get_assiged_pm_details($all_projects['project_id']);
				//print_r($assiged_tm);

				///print_r($assiged_pm);

				$server_time=date("Y-m-d H:i");

				//echo "<br>strtotime-->".strtotime(date("Y-m-d H:i"));

				$current_time=date("Y-m-d $reminder_time");

				$two_hours_before = strtotime($current_time . ' -2 hours');

				$two_hours_before_date = date("Y-m-d H:i",$two_hours_before);
				
				echo "<br>aaa-->".$all_projects['project_name'];
				echo "<br>bbb--->".$user_details['name'];
				//echo "<br>strtotime1-->".$two_hours_before;

				/*

				* If current time is equal to two hours before the send notification

				*/

				/*echo "<br>aaa-->".strtotime($server_time);

				echo "<br>bbb-->".$two_hours_before;*/

				if(strtotime($server_time)==$two_hours_before){

					//echo "in time";

					foreach($assiged_tm as $assiged_tm){

					 $mail_tm=	$assiged_tm['tm_list'];

					if($mail_tm!=''){
					//echo "mail_sent";
					$this->load->library('email');
					$this->load->library('parser');
					$this->email->clear();
					$config['mailtype'] = "html";
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from('info@pboplot.com', 'Pboplus');
					$this->email->to($mail_tm);
					
					$this->email->subject('ODIF Report Reminder');

					$this->email->message("
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>
<style>
*{
font-family: 'Open Sans', sans-serif;	
padding:0;
margin:0;	
}
</style><table class='table' style='width:600px;max-width:100%;margin:0 auto;' border='0' cellpadding='0' cellspacing='0'>
<tbody>
	<tr>
    	<td colspan='2' align='center'><img src='".base_url()."images/logo2.png' alt=''/></td>
    </tr>
	  <tr><td>&nbsp;</td></tr>
    
                    
                  
    <tr>
    	<td colspan='2' align='center' style='font-size:18px;color:#1d9f75;line-height: 24px;'>
        <div>Daily Reminder</div><img src='".base_url()."images/border.png' alt=''/></td>
    </tr>
    
    

    <tr>
    	<td colspan='2'><p>&nbsp;</p></td>
    </tr>
	
	 <tr>
                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0;margin:0;'>
                    	Project Name:<a style='text-decoration:none;' href='".base_url()."/wbs_list/index/".$all_projects['project_id']."'>".$all_projects['project_name']."</a>
                    	
                    	</h4></td><td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:5px;'>
                    	Project Owner: ".$powner['name']." </h4></td>
                    </tr>
	    <tr>				
    <td style='font-size:14px;color:#5b6a6f;padding:10px 25px;'  colspan='2'>
    	<p>ODIF report will be share at ".$reminder_time." so update your report before time.</p>
    </td>
    <td style='padding:10px;'  colspan='2'><img src='".base_url()."images/plane.png' alt=''/></td>
    </tr>
    <tr>
    	<td colspan='2'><p>&nbsp;</p></td>
    </tr>
    <tr>
    <td colspan='2' align='center' bgcolor='#f8f8f8' style='font-size:12px;padding:20px 0;line-height:15px;font-weight:500;'>
    <p>You are receiving this email because you are requested with PLOT. <br>
If you do not wish to receive any further communications, please unsubscribe here.<br> 
@ ".date("Y")." PBOPlus Consulting Services Ltd. All rights reserved.</p>
    </td>
    </tr>
</tbody></table>");

					  $this->email->send();

					}

					$mail_tm='';

					}



					foreach($assiged_pm as $assiged_pm){

					$mail_pm=	$assiged_pm['pm_list'];
					if($mail_pm!=''){
					$this->email->to($mail_pm);
					$this->email->subject('ODIF Report Reminder');

					  $this->email->message("
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>
<style>
*{
font-family: 'Open Sans', sans-serif;	
padding:0;
margin:0;	
}
</style><table class='table' style='width:600px;max-width:100%;margin:0 auto;' border='0' cellpadding='0' cellspacing='0'>
<tbody>
	<tr>
    	<td colspan='2' align='center'><img src='".base_url()."images/logo2.png' alt=''/></td>
    </tr>
	<tr><td>&nbsp;</td></tr>
  
                    
                    
    <tr>
    	<td colspan='2' align='center' style='font-size:18px;color:#1d9f75;    line-height: 24px;'>
        <div>Daily Reminder</div><img src='".base_url()."images/border.png' alt=''/></td>
    </tr>
   <tr>
                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0;margin:0;'>
                    	Project Name:<a style='text-decoration:none;' href='".base_url()."/wbs_list/index/".$all_project['project_id']."'>".$all_project['project_name']."</a>
                    	
                    	</h4></td><td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>
                    	Project Owner: ".$powner['name']." </h4></td>
                    </tr>
    <tr>
    	<td colspan='2'><p>&nbsp;</p></td>
    </tr>
	<tr>
    <td style='font-size:14px;color:#5b6a6f;padding:10px 25px;'  colspan='2'>
    	<p>ODIF report will be share at ".$reminder_time." so update your report before time.</p>
    </td>
    <td style='padding:10px;' colspan='2'><img src='".base_url()."images/plane.png' alt=''/></td>
    </tr>
    <tr>
    	<td colspan='2'><p>&nbsp;</p></td>
    </tr>
    <tr>
    <td colspan='2' align='center' bgcolor='#f8f8f8' style='font-size:12px;padding:20px 0;line-height:15px;font-weight:500;'>
    <p>You are receiving this email because you are requested with PLOT. <br>
If you do not wish to receive any further communications, please unsubscribe here<br> 
@ ".date("Y")." PBOPlus Consulting Services Ltd. All rights reserved.</p>
    </td>
    </tr>
</tbody></table>");

					  $this->email->send();	

					   }

					$mail_pm='';	

					}

					

					

				}

				

			


				

				

			}

			

			

		}

		

		

function send_odif_report(){

	//error_reporting(E_ALL);
	$this->load->library('email');
	$all_projects=$this->odif_model->get_all_projects();//print_r($all_projects);exit;
	foreach($all_projects as $all_project){
		$project_details=$this->odif_model->get_project_reminder_time($all_project['project_id']);	
		$user_details= $this->users_model->get_user_details_byemail($all_project['user_id']);
		//print_r($user_details);
		$reminder_time=$this->odif_model->get_project_reminder_time($all_project['project_id']);
		$reminder_time=$reminder_time->daterange;
		$assiged_tm=$this->wbs_model->get_assiged_tm_details($all_project['project_id']);
		$assiged_pm=$this->wbs_model->get_assiged_pm_details($all_project['project_id']);
		
		$powner=$this->projects_model->view_projects_details_id($all_project['project_id']);	
		echo $all_project['project_name']."<br>";
		//echo $message;
		echo "<br>-------------------------------------------------<br>";
		echo "<br>reminder_time-->".$reminder_time;
		echo "<br>server_time-->".$server_time=date("Y-m-d H:i");
		//echo "<br>".$server_time."<br>";
		echo "<br>current_time-->".$current_time=date("Y-m-d $reminder_time");
		
		
		$activity_start_today1=$this->odif_model->odif_report_odif('project_id',$all_project['project_id']);
		$total_activities1=$this->odif_model->total_activity($all_project['project_id']);
			//echo $total_activities.'<br>';
		$complete_activity1=$this->odif_model->complete_activity($all_project['project_id']);
			
		if(strtotime($server_time)==strtotime($current_time)){	
	 
	 
		foreach($assiged_tm as $assiged_tm){
			echo "<br>aaa-->".$assiged_tm['tm_list'];		 
			$activity_start_today_member=$this->odif_model->odif_report_odif_userwise('project_id',$all_project['project_id'],$assiged_tm['tm_list']);
			$total_activities=$this->odif_model->total_activity_userwise($all_project['project_id'],$assiged_tm['tm_list']);
			//echo $total_activities.'<br>';
			$complete_activity=$this->odif_model->complete_activity_userwise($all_project['project_id'],$assiged_tm['tm_list']);
			
			if($activity_start_today_member) {

				$message="
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>
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
    	<td align='center' colspan='2'><img src='".base_url()."images/logo2.png' alt=''/></td>
    </tr>
     
    <tr>
    	<td align='center'>
        	<table class='table' cellpadding='10' cellspacing='10' border='0' bgcolor='#ffffff' width='95%'>
            	<tbody>
				
				<tr>
                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0;margin:0;'>
                    	Project Name:<a style='text-decoration:none;' href='".base_url()."/wbs_list/index/".$all_project['project_id']."'>".$all_project['project_name']."</a>
                    	
                    	</h4></td>	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:5px;'>
                    	Project Owner: ".$powner['name']." </h4></td>
                    </tr>";
					$message.=" <tr>
                    	<td colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Today's Performance Report</h4></td>
                    </tr> <tr>
    	<td align='center' colspan='2'>
        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>Total Activities</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>Completed Activities</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ODIF Score</th>
                            		
                            	</tr>
                            </thead>
            	<tbody>
          
                    <tr>
                		
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$total_activities."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$complete_activity."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".ceil(($complete_activity/$total_activities)*100)."%</td>
                		
                	</tr>
                </tbody>
                </table>       
    	</td>
    </tr>";
	 if(count($activity_start_today_member) >0){

		$message.="<tr>
                    	<td colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Today's ODIF:</h4></td>
                    </tr>
                    <tr>
                    	<td style='border: 1px solid #ddd;' colspan='2'>
                        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>S. NO.</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>MEGA PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTIVITY</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>START DATE</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>FINISH DATE</th>
   								<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>STATUS</th>		
								<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>COMMENTS</th>			                         		
                            	</tr>
                            </thead>
            	<tbody>";

			$m=0;	

			foreach($activity_start_today_member as $activity_start_today) {

				$m++;

				if($activity_start_today['activity_status']==0){

				$activity_status="Incomplete";	

				}else if($activity_start_today['activity_status']==1){

				$activity_status="Complete";	

				}	

			  $message.="<tr bgcolor='#f6f6f6'>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$m."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['mp_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['process_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['activity_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['start_date']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['finish_date']."</td>
						
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_status."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['comments']."</td>
                		
                	</tr>";

			}

			$message.=" </tbody>
                </table>
                        </td>
                    </tr>";

			  }
		
	$message.="<tr>
    <td align='center' colspan='2' bgcolor='#f8f8f8' style='font-size:12px;padding:20px 0;line-height:15px;font-weight:500;'>
    <p>You are receiving this email because you are requested with PLOT. <br>
If you do not wish to receive any further communications, please unsubscribe here.<br> 
@ ".date("Y")." PBOPlus Consulting Services Ltd. All rights reserved.</p>
    </td>
    </tr>
                </tbody>
            </table>        
    	</td>
    </tr>
    <tr>
    	<td><p>&nbsp;</p></td>
    </tr></tbody></table>";

		
			  $this->load->library('email');

			  $this->load->library('parser');
			  $this->email->clear();

			  $config['mailtype'] = "html";
			  $config['useragent'] = 'CodeIgniter';
			  $config['protocol'] = 'mail';
			  $this->email->initialize($config);
			  $this->email->set_newline("\r\n");
			  $this->email->from('info@pboplot.com', 'Pboplus');
			  $this->email->to($assiged_tm['tm_list']);
			  $this->email->subject("PLOT ODIF Report");
			  $this->email->message($message);
			  $this->email->send();	


		}
				 
				 
		 
		 
			 }
			foreach($assiged_pm as $assiged_pm){	
			
			echo "<br>assiged_pm-->".$assiged_pm['pm_list']; 
			//print_r($activity_start_today);
		if($activity_start_today1) {

				$message_pm="
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>
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
    	<td align='center' colspan='2'><img src='".base_url()."images/logo2.png' alt=''/></td>
    </tr>
     
    <tr>
    	<td align='center'>
        	<table class='table' cellpadding='10' cellspacing='10' border='0' bgcolor='#ffffff' width='95%'>
            	<tbody>
				
				<tr>
                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0;margin:0;'>
                    	Project Name:<a style='text-decoration:none;' href='".base_url()."/wbs_list/index/".$all_project['project_id']."'>".$all_project['project_name']."</a>
                    	
                    	</h4></td>	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:5px;'>
                    	Project Owner: ".$powner['name']." </h4></td>
                    </tr>";
					$message_pm.=" <tr>
                    	<td colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Today's Performance Report</h4></td>
                    </tr> <tr>
    	<td align='center' colspan='2'>
        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>Total Activities</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>Completed Activities</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ODIF Score</th>
                            		
                            	</tr>
                            </thead>
            	<tbody>
          
                    <tr>
                		
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$total_activities1."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$complete_activity1."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".ceil(($complete_activity1/$total_activities1)*100)."%</td>
                		
                	</tr>
                </tbody>
                </table>       
    	</td>
    </tr>";
	 if(count($activity_start_today1) >0){

		$message_pm.="<tr>
                    	<td colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Today's ODIF:</h4></td>
                    </tr>
                    <tr>
                    	<td style='border: 1px solid #ddd;' colspan='2'>
                        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>S. NO.</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>MEGA PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTIVITY</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>USER</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>START DATE</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>FINISH DATE</th>
   								<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>STATUS</th>			                         		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>COMMENTS</th>	
                            	</tr>
                            </thead>
            	<tbody>";

			$m1=0;	

			foreach($activity_start_today1 as $activity_start_today1) {
				
				$assign_user= $this->users_model->get_user_details_byemail($activity_start_today1['assigned_person']);

				$m1++;

				if($activity_start_today1['activity_status']==0){

				$activity_status="Incomplete";	

				}else if($activity_start_today1['activity_status']==1){

				$activity_status="Complete";	

				}	

			  $message_pm.="<tr bgcolor='#f6f6f6'>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$m1."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today1['mp_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today1['process_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today1['activity_name']."</td>
						
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$assign_user['name']."</td>
						
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today1['start_date']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today1['finish_date']."</td>
						
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_status."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today1['comments']."</td>
                		
                	</tr>";

			}

			$message_pm.="</tbody></table></td></tr>";

			  }
		
	$message_pm.="<tr>
    <td align='center' colspan='2' bgcolor='#f8f8f8' style='font-size:12px;padding:20px 0;line-height:15px;font-weight:500;'>
    <p>You are receiving this email because you are requested with PLOT. <br>
If you do not wish to receive any further communications, please unsubscribe here.<br> 
@ ".date("Y")." PBOPlus Consulting Services Ltd. All rights reserved.</p>
    </td>
    </tr>
                </tbody>
            </table>        
    	</td>
    </tr>
    <tr>
    	<td><p>&nbsp;</p></td>
    </tr></tbody></table>";
	
	echo $message_pm;

		
				
					//echo "<br>aaa-->".$assiged_pm['pm_list'];	
					$this->load->library('email');
					$this->load->library('parser');
					$this->email->clear();
					$config['mailtype'] = "html";
					$config['useragent'] = 'CodeIgniter';
					$config['protocol'] = 'mail';
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from('info@pboplot.com', 'Pboplus');
					$this->email->to($assiged_pm['pm_list']);
					$this->email->subject("PLOT ODIF Report");
					$this->email->message($message_pm);
					$this->email->send();	

					}

			

				}
		 
			 
			 
	 	
	 
		}//if server time 
		
		
	}//all projectts

	
			 
}//function 

public function odif_report_clients(){

				$all_projects=$this->odif_model->get_all_projects();
				//print_r($all_projects);

				foreach($all_projects as $all_project){
				$reminder_time=$this->odif_model->get_project_reminder_time($all_project['project_id']);
				$reminder_time=$reminder_time->daterange;
				$client_emails=$this->odif_model->get_project_reminder_time($all_project['project_id']);
				$client_emails=$client_emails->client_emails;
				$client_emails=explode(",",$client_emails);
				$activity_start_today=$this->odif_model->odif_report_odif('project_id',$all_project['project_id']);
				//print_r($activity_start_today);
				$total_activities=$this->odif_model->total_activity($all_project['project_id']);
				$powner=$this->projects_model->view_projects_details_id($all_project['project_id']);
				//echo $total_activities.'<br>';
				$complete_activity=$this->odif_model->complete_activity($all_project['project_id']);
				$odif_score=$this->odif_model->odif_score($all_project['project_id']);
			
				//echo "<br>project_id-->".$all_project['project_id'];
                $user_details= $this->users_model->get_user_details_byemail($all_project['user_id']);
				 if(count($activity_start_today) >0){
					
					

						$message="
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>
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
    	<td align='center' colspan='2'><img src='".base_url()."images/logo2.png' alt=''/></td>
    </tr>
     
    <tr>
    	<td align='center'>
        	<table class='table' cellpadding='10' cellspacing='10' border='0' bgcolor='#ffffff' width='95%'>
            	<tbody>
				
				<tr>
                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0;margin:0;'>
                    	Project Name:<a style='text-decoration:none;' href='".base_url()."/wbs_list/index/".$all_project['project_id']."'>".$all_project['project_name']."</a>
                    	
                    	</h4></td>	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:5px;'>
                    	Project Owner: ".$powner['name']." </h4></td>
                    </tr>";
					$message.=" <tr>
                    	<td colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Today's Performance Report</h4></td>
                    </tr> <tr>
    	<td align='center' colspan='2'>
        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>Total Activities</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>Completed Activities</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ODIF Score</th>
                            		
                            	</tr>
                            </thead>
            	<tbody>
          
                    <tr>
                		
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$total_activities."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$complete_activity."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".ceil(($complete_activity/$total_activities)*100)."%</td>
                		
                	</tr>
                </tbody>
                </table>       
    	</td>
    </tr>";
	 if(count($activity_start_today) >0){

		$message.="<tr>
                    	<td colspan='2'><h4 style='border-bottom:1px solid #ccc;color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:10px;'>Today's ODIF:</h4></td>
                    </tr>
                    <tr>
                    	<td style='border: 1px solid #ddd;' colspan='2'>
                        	<table class='table' cellpadding='10' cellspacing='0' border='0' bgcolor='#ffffff' width='100%'>
                            <thead>
                            	<tr>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>S. NO.</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>MEGA PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>PROCESS</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>ACTIVITY</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>START DATE</th>
                            		<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>FINISH DATE</th>
   									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>STATUS</th>
									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>COMMENTS</th>
   									<th style='font-weight:600;font-size:13px;background:#445157;color:#fff;padding:5px;'>DELAY</th>
                            	</tr>
                            </thead>
            	<tbody>";

			$m=0;	

			foreach($activity_start_today as $activity_start_today) {

				$m++;

				if($activity_start_today['activity_status']==0){

				$activity_status="Incomplete";	

				}else if($activity_start_today['activity_status']==1){

				$activity_status="Complete";	

				}	
				
				echo "<br>aaaa-->".$activity_start_today['delay']; 
					 if($activity_start_today['delay']>0) {
						$delay=$activity_start_today['delay']; 
					 }else{
						$delay=0;	 
					 }

			  $message.="<tr bgcolor='#f6f6f6'>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$m."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['mp_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['process_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['activity_name']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['start_date']."</td>
                		<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['finish_date']."</td>
						
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_status."</td>
						<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$activity_start_today['comments']."</td>
							<td  align='center'  style='font-weight:400;font-size:12px;color:#5b6a6f;padding:2px;padding:5px;'>".$delay." Days</td>
                		
                	</tr>";

			}

			$message.=" </tbody>
                </table>
                        </td>
                    </tr>";

			  }
		
	$message.="<tr>
    <td align='center' colspan='2' bgcolor='#f8f8f8' style='font-size:12px;padding:20px 0;line-height:15px;font-weight:500;'>
    <p>You are receiving this email because you are requested with PLOT. <br>
If you do not wish to receive any further communications, please unsubscribe here.<br> 
@ ".date("Y")." PBOPlus Consulting Services Ltd. All rights reserved.</p>
    </td>
    </tr>
                </tbody>
            </table>        
    	</td>
    </tr>
    <tr>
    	<td><p>&nbsp;</p></td>
    </tr></tbody></table>";







				$server_time=date("Y-m-d H:i");

				$current_time=date("Y-m-d $reminder_time");
				
				echo $message;



				/*

				* If current time is equal to two hours before the send notification

				*/

				if(strtotime($server_time)==strtotime($current_time)){

					foreach($client_emails as $client_emails){
						 if($client_emails!=''){
							
							echo "<br>aa-->".$client_emails;
							echo "<br>aaa->".$message;
							$this->load->library('email');
							
							$this->load->library('parser');
							$this->email->clear();
							$config['mailtype'] = "html";
							$config['useragent'] = 'CodeIgniter';
							$config['protocol'] = 'mail';
							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from('info@pboplot.com', 'Pboplus');
							$this->email->to(trim($client_emails));
							$this->email->subject('Plot ODIF Report');
							$this->email->message($message);
							$this->email->send();	
	
						 }//if

                      }//foreach


				}//if(strtotime($server_time)==strtotime($current_time))

			}//if(count($activity_start_today) >0){

		}

}

		

		public function get_dependant_status(){

		$aid=$_POST['aid'];

		if($aid>0) {

		$sql="SELECT * FROM activity WHERE activity_id='".$aid."'  AND status=0"	;

		$res=$this->db->query($sql);

		$result_a=$res->row();

		//print_r($result_a);

		if($result_a->dependent_on!=''){

			$sql_dep_status="SELECT activity_status,activity_name FROM activity WHERE unique_code='".$result_a->dependent_on."' AND project_id='".$result_a->project_id."' AND status=0";

			$res_dep_status=$this->db->query($sql_dep_status);

			$result_dep_status=$res_dep_status->row();

			//print_r($result_dep_status);

			if($result_dep_status->activity_status==0){

				

			echo "The dependent activty ".$result_dep_status->activity_name." is not completed yet so you can't modify the status of this activty";	

			}

			else{

			echo "";	

			}

		

		}

		}

		}

		



		public function index() {		

			$loggedin = $this->logged_in();

			if($loggedin == TRUE) {

				$get_id =  $this->uri->segment('3');		

				$user_id = $this->session->userdata['user_id'];

				$role = $this->session->userdata['role'];

				$uname = $this->session->userdata['name'];

				

				

				$data['user_detail'] = $this->dashboard_model->view_details($user_id);

				$data['project_details'] = $this->wbs_model->get_project_details($get_id);

				

				

				$data['logo'] = $this->logo_model->view_logo();

				

				//echo "hiiii";die;

				

				//assigned PM list and TM list

				$data['assign_pm_list'] = $this->projects_model->assign_pmlist($get_id);

			    $data['assign_tm_list'] = $this->projects_model->assign_tmlist($get_id);

				

				if($role!="Team Member") {

				

					$data['total_activity'] = $this->odif_model->get_todays_odif_all($get_id);

			    	$data['complete_activity'] = $this->odif_model->get_todays_odif_completed($get_id);

					$data['odif_score']=$this->odif_model->odif_score($get_id);	

				}

				else{

					

					$data['total_activity'] = $this->odif_model->get_todays_odif_member_all($get_id,$user_id);

			    	$data['complete_activity'] = $this->odif_model->get_todays_odif_member_completed($get_id,$user_id);

					$data['odif_score']=$this->odif_model->odif_score_members($get_id,$user_id);		

					

				}

			  

			  //Get user Comment

				$data['getcomment']=$this->wbs_list_model->get_comment($get_id);

			    //print_r($data['getcomment']); die;

				

				//insert user comment

				if(isset($_POST['ucomment'])){

				    $usercomment = $_POST['usercomment'];

					$data['mycomment']=$this->wbs_list_model->user_comment($get_id,$user_id,$uname,$usercomment);

					//print_r($data['mycomment']); die; 	

				    redirect(base_url().'odif/'. 'index/' . $this->uri->segment('3'));

				}

			  

				if($role == 'Admin'){

					
					//echo "<pre>";
				

					if($_POST['odif_id']){	
					//print_r($_POST);die;					

						$odif_id = $_POST['odif_id'];

						$odif_status = $_POST['odif_status'];

						for($x = 0; $x < count($_POST['odif_status']); $x++){

							$plus_three=$x+count($_POST['odif_status']);
							$date_modified=date("Y-m-d H:i:s");
							
							//$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."',actually_quantity='".$_POST['actually_quantity'][$x]."',temp_actual_quantity='".$_POST['actually_quantity'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");
										
							$sqlqty="SELECT planned_quantity FROM activity WHERE activity_id='".$_POST['odif_id'][$x]."'"	;

							$resqty=$this->db->query($sqlqty);
							$quantity = $resqty->row_array();
							$planned_quantity = $quantity['planned_quantity'];
							$job_card = 0;
							$sql="SELECT * FROM job_card WHERE activity_id='".$_POST['odif_id'][$x]."'"	;
							$res=$this->db->query($sql);
							$job_card = $res->num_rows();
							$job_array = [];
							$job_array['activity_id'] = $_POST['odif_id'][$x];
							$job_array['planned_quantity']= isset($planned_quantity)?$planned_quantity:0;
							$job_array['actually_quantity']= $_POST['actually_quantity'][$x];
							$job_array['created_date'] = date('Y-m-d');

							if($job_card <= 0){    
								$this->db->insert('job_card', $job_array); 
							} else {  
								$this->db->query("UPDATE `job_card` SET actually_quantity='".$_POST['actually_quantity'][$x]."' , created_date = '".date('Y-m-d')."' WHERE activity_id='".$_POST['odif_id'][$x]."'");	
							}
								

						}

						//print_r($_POST);die;

						
						//print_r($odif_status);

			redirect(base_url().'odif/index/'.$get_id.'/');

					} else {

						

						  if(isset($_POST['odifsort'])){

							     $sdate = $_POST['sdate'];

							     $edate = $_POST['edate'];

								

								$data['odif']=$this->odif_model->odif_filter($get_id,$sdate,$edate);

								

							  }else{

								  

						        $data['odif']=$this->odif_model->get_todays_odif($get_id);

					          }

						

						$this->load->view('header', $data);

						$this->load->view('admin_sidebar', $data);

						 

						$this->load->view('Odif/odif', $data);

						$this->load->view('footer');

					}		

				} elseif ($role == 'Editor'){

					if($_POST['odif_id']){						

						$odif_id = $_POST['odif_id'];

						$odif_status = $_POST['odif_status'];

						for($x = 0; $x < count($_POST['odif_status']); $x++){

			
							$date_modified=date("Y-m-d H:i:s");

							//$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."',actually_quantity='".$_POST['actually_quantity'][$x]."',temp_actual_quantity='".$_POST['actually_quantity'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
			
							$sqlqty="SELECT planned_quantity FROM activity WHERE activity_id='".$_POST['odif_id'][$x]."'"	;
							
							$resqty=$this->db->query($sqlqty);
							$quantity = $resqty->row_array();
							$planned_quantity = $quantity['planned_quantity'];
							$job_card = 0;
							$sql="SELECT * FROM job_card WHERE activity_id='".$_POST['odif_id'][$x]."'"	;
							$res=$this->db->query($sql);
							$job_card = $res->num_rows();
							$job_array = [];
							$job_array['activity_id'] = $_POST['odif_id'][$x];
							$job_array['planned_quantity']= isset($planned_quantity)?$planned_quantity:0;
							$job_array['actually_quantity']= $_POST['actually_quantity'][$x];
							$job_array['created_date'] = date('Y-m-d');
							
							if($job_card <= 0){    
								$this->db->insert('job_card', $job_array); 
							} else {  
								$this->db->query("UPDATE `job_card` SET actually_quantity='".$_POST['actually_quantity'][$x]."' , created_date = '".date('Y-m-d')."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							}
						}

						//print_r($_POST);die;

						//print_r($odif_status);

			redirect(base_url().'odif/index/'.$get_id.'/');

					} else {

						

						if(isset($_POST['odifsort'])){

							    $sdate = $_POST['sdate'];

							    $edate = $_POST['edate'];

								$data['odif']=$this->odif_model->odif_filter($get_id,$sdate,$edate);  

							  }else{

						        $data['odif']=$this->odif_model->get_todays_odif($get_id);

					          }

						$this->load->view('header', $data);

						$this->load->view('admin_sidebar', $data);

						$this->load->view('Odif/odif', $data);

						$this->load->view('footer');

					}			

				} elseif ($role == 'Project Manager'){

					if($_POST['odif_id']){						

						$odif_id = $_POST['odif_id'];

						$odif_status = $_POST['odif_status'];

						for($x = 0; $x < count($_POST['odif_status']); $x++){

			

							$date_modified=date("Y-m-d H:i:s");
							//$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."',actually_quantity='".$_POST['actually_quantity'][$x]."',temp_actual_quantity='".$_POST['actually_quantity'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							 $this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							$sqlqty="SELECT planned_quantity FROM activity WHERE activity_id='".$_POST['odif_id'][$x]."'"	;
							
							$resqty=$this->db->query($sqlqty);
							$quantity = $resqty->row_array();
							$planned_quantity = $quantity['planned_quantity'];
							$job_card = 0;
							$sql="SELECT * FROM job_card WHERE activity_id='".$_POST['odif_id'][$x]."'"	;
							$res=$this->db->query($sql);
							$job_card = $res->num_rows();
							$job_array = [];
							$job_array['activity_id'] = $_POST['odif_id'][$x];
							$job_array['planned_quantity']= isset($planned_quantity)?$planned_quantity:0;
							$job_array['actually_quantity']= $_POST['actually_quantity'][$x];
							$job_array['created_date'] = date('Y-m-d');
							
							if($job_card <= 0){    
								$this->db->insert('job_card', $job_array); 
							} else {  
								$this->db->query("UPDATE `job_card` SET actually_quantity='".$_POST['actually_quantity'][$x]."' , created_date = '".date('Y-m-d')."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							}
		
						}

					

			redirect(base_url().'odif/index/'.$get_id.'/');

					}else {

						if(isset($_POST['odifsort'])){

							    $sdate = $_POST['sdate'];

							    $edate = $_POST['edate'];

								$data['odif']=$this->odif_model->odif_filter($get_id,$sdate,$edate);  

							  }else{

						        $data['odif']=$this->odif_model->get_todays_odif($get_id);

					          }

						$this->load->view('header', $data);

						$this->load->view('admin_sidebar', $data);

						$this->load->view('Odif/odif', $data);

						$this->load->view('footer');

					}

				}elseif ($role == 'Team Member') {

					

					//echo "hiii";

					if($_POST['odif_id']){						

						$odif_id = $_POST['odif_id'];

						$odif_status = $_POST['odif_status'];

						for($x = 0; $x < count($_POST['odif_status']); $x++){

							$date_modified=date("Y-m-d H:i:s");
							//$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."',actually_quantity='".$_POST['actually_quantity'][$x]."',temp_actual_quantity='".$_POST['actually_quantity'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		

							$sqlqty="SELECT planned_quantity FROM activity WHERE activity_id='".$_POST['odif_id'][$x]."'"	;
							
							$resqty=$this->db->query($sqlqty);
							$quantity = $resqty->row_array();
							$planned_quantity = $quantity['planned_quantity'];
							$job_card = 0;
							$sql="SELECT * FROM job_card WHERE activity_id='".$_POST['odif_id'][$x]."'"	;
							$res=$this->db->query($sql);
							$job_card = $res->num_rows();
							$job_array = [];
							$job_array['activity_id'] = $_POST['odif_id'][$x];
							$job_array['planned_quantity']= isset($planned_quantity)?$planned_quantity:0;
							$job_array['actually_quantity']= $_POST['actually_quantity'][$x];
							$job_array['created_date'] = date('Y-m-d');
							
							if($job_card <= 0){    
								$this->db->insert('job_card', $job_array); 
							} else {  
								$this->db->query("UPDATE `job_card` SET actually_quantity='".$_POST['actually_quantity'][$x]."' , created_date = '".date('Y-m-d')."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							}
						}


			redirect(base_url().'odif/index/'.$get_id.'/');

					}else {

						

						if(isset($_POST['odifsort'])){

							    $sdate = $_POST['sdate'];

							    $edate = $_POST['edate'];

								$data['odif']=$this->odif_model->odif_filter($get_id,$sdate,$edate);  

							  }else{

						        $data['odif']=$this->odif_model->get_todays_odif_member($get_id,$this->session->userdata['user_id']);

					          }

						$this->load->view('header', $data);

						$this->load->view('tm_sidebar', $data);

						$this->load->view('Odif/odif', $data);

						$this->load->view('footer');

					}

				}	

			}	else {						

					redirect(base_url().'login/');				

				}		

		}	


		public function odiffilter() {		

			$loggedin = $this->logged_in();

			if($loggedin == TRUE) {

				$get_id =  $this->uri->segment('3');		

				$user_id = $this->session->userdata['user_id'];

				$role = $this->session->userdata['role'];

				$uname = $this->session->userdata['name'];

				$data['user_detail'] = $this->dashboard_model->view_details($user_id);

				$data['project_details'] = $this->wbs_model->get_project_details($get_id);

				$data['logo'] = $this->logo_model->view_logo();

				
    			//assigned PM list and TM list

				$data['assign_pm_list'] = $this->projects_model->assign_pmlist($get_id);

			    $data['assign_tm_list'] = $this->projects_model->assign_tmlist($get_id);

				$data['responsible_person']= $this->wbs_model->get_reponsible_person($get_id);



				if($role!="Team Member") {


					 $data['total_activity'] = $this->odif_model->get_todays_odif_all($get_id);

			    	 $data['complete_activity'] = $this->odif_model->get_todays_odif_completed($get_id);

					$data['odif_score']=$this->odif_model->odif_score($get_id);	

				}

				else{
					

					$data['total_activity'] = '$this->odif_model->get_todays_odif_member_all($get_id,$user_id)';

			    	$data['complete_activity'] = $this->odif_model->get_todays_odif_member_completed($get_id,$user_id);

					$data['odif_score']=$this->odif_model->odif_score_members($get_id,$user_id);		

					

				}

			  //Get user Comment

				$data['getcomment']=$this->wbs_list_model->get_comment($get_id);			

				//insert user comment

				if(isset($_POST['ucomment'])){

				    $usercomment = $_POST['usercomment'];

					$data['mycomment']=$this->wbs_list_model->user_comment($get_id,$user_id,$uname,$usercomment);	

				    redirect(base_url().'odif/'. 'odiffilter/' . $this->uri->segment('3'));

				}

			  

				if($role == 'Admin'){
	
					if($_POST['odif_id']){	
					//print_r($_POST);die;					

						$odif_id = $_POST['odif_id'];

						$odif_status = $_POST['odif_status'];

						for($x = 0; $x < count($_POST['odif_status']); $x++){

			$plus_three=$x+count($_POST['odif_status']);
			$date_modified=date("Y-m-d H:i:s");
			
			$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		

								

						}

						//print_r($_POST);die;

						
						//print_r($odif_status);

			redirect(base_url().'odif/odiffilter/'.$get_id.'/');

					} else {

						
						  if(isset($_POST['odifsort'])){
							// print_r($_POST);die;
								 
								$datestring=$_POST['date'];	
								$responsilbe_person=$_POST['responsilbe_person'];	
								
								if($datestring!=''){
								$string=explode("-",$datestring);	
								$sdate=$string[0]."-".$string[1]."-".$string[2];
								$edate=$string[3]."-".$string[4]."-".$string[5];
								}

								$data['total_activity'] = $this->odif_model->get_odif_all_filter_range($get_id,$sdate,$edate,$responsilbe_person);

			    	            $data['complete_activity'] = $this->odif_model->get_odif_completed_filter_range($get_id,$sdate,$edate,$responsilbe_person);


								$data['odif']=$this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);								

							  }else{								  

						        $data['odif']=$this->odif_model->get_todays_odif($get_id);

					          }

						

						$this->load->view('header', $data);

						$this->load->view('admin_sidebar', $data);

						 

						$this->load->view('Odif/odiffilter', $data);

						$this->load->view('footer');

					}		

				} elseif ($role == 'Editor'){

					if($_POST['odif_id']){						

						$odif_id = $_POST['odif_id'];

						$odif_status = $_POST['odif_status'];

						for($x = 0; $x < count($_POST['odif_status']); $x++){

			
			$date_modified=date("Y-m-d H:i:s");

			$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		

						}

						//print_r($_POST);die;

						//print_r($odif_status);

			redirect(base_url().'odif/odiffilter/'.$get_id.'/');

					} else {

						

						if(isset($_POST['odifsort'])){

							    $datestring=$_POST['date'];	
								$responsilbe_person=$_POST['responsilbe_person'];	
								
								if($datestring!=''){
								$string=explode("-",$datestring);	
								$sdate=$string[0]."-".$string[1]."-".$string[2];
								$edate=$string[3]."-".$string[4]."-".$string[5];
								}

								$data['total_activity'] = $this->odif_model->get_odif_all_filter_range($get_id,$sdate,$edate,$responsilbe_person);

			    	            $data['complete_activity'] = $this->odif_model->get_odif_completed_filter_range($get_id,$sdate,$edate,$responsilbe_person);


								$data['odif']=$this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);  

							  }else{

						        $data['odif']=$this->odif_model->get_todays_odif($get_id);

					          }

						$this->load->view('header', $data);

						$this->load->view('admin_sidebar', $data);

						$this->load->view('Odif/odiffilter', $data);

						$this->load->view('footer');

					}			

				} elseif ($role == 'Project Manager'){

					if($_POST['odif_id']){						

						$odif_id = $_POST['odif_id'];

						$odif_status = $_POST['odif_status'];

						for($x = 0; $x < count($_POST['odif_status']); $x++){

			

			$date_modified=date("Y-m-d H:i:s");
			$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		

		
						}

					

			redirect(base_url().'odif/odiffilter/'.$get_id.'/');

					}else {

						if(isset($_POST['odifsort'])){

							    $datestring=$_POST['date'];	
								$responsilbe_person=$_POST['responsilbe_person'];	
								
								if($datestring!=''){
								$string=explode("-",$datestring);	
								$sdate=$string[0]."-".$string[1]."-".$string[2];
								$edate=$string[3]."-".$string[4]."-".$string[5];
								}

								$data['total_activity'] = $this->odif_model->get_odif_all_filter_range($get_id,$sdate,$edate,$responsilbe_person);

			    	            $data['complete_activity'] = $this->odif_model->get_odif_completed_filter_range($get_id,$sdate,$edate,$responsilbe_person);


								$data['odif']=$this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);  

							  }else{

						        $data['odif']=$this->odif_model->get_todays_odif($get_id);

					          }

						$this->load->view('header', $data);

						$this->load->view('admin_sidebar', $data);

						$this->load->view('Odif/odiffilter', $data);

						$this->load->view('footer');

					}

				}elseif ($role == 'Team Member') {

					

					//echo "hiii";

					if($_POST['odif_id']){						

						$odif_id = $_POST['odif_id'];

						$odif_status = $_POST['odif_status'];

						for($x = 0; $x < count($_POST['odif_status']); $x++){

			$date_modified=date("Y-m-d H:i:s");
			$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		

						}


			redirect(base_url().'odif/odiffilter/'.$get_id.'/');

					}else {

						

						if(isset($_POST['odifsort'])){

							    $datestring=$_POST['date'];	
								$responsilbe_person=$_POST['responsilbe_person'];	
								
								if($datestring!=''){
								$string=explode("-",$datestring);	
								$sdate=$string[0]."-".$string[1]."-".$string[2];
								$edate=$string[3]."-".$string[4]."-".$string[5];
								}

								$data['total_activity'] = $this->odif_model->get_odif_all_filter_range($get_id,$sdate,$edate,$responsilbe_person);

			    	            $data['complete_activity'] = $this->odif_model->get_odif_completed_filter_range($get_id,$sdate,$edate,$responsilbe_person);


								$data['odif']=$this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);  

							  }else{

						        $data['odif']=$this->odif_model->get_todays_odif_member($get_id,$this->session->userdata['user_id']);

					          }

						$this->load->view('header', $data);

						$this->load->view('tm_sidebar', $data);

						$this->load->view('Odif/odiffilter', $data);

						$this->load->view('footer');

					}

				}	

			}	else {						

					redirect(base_url().'login/');				

				}		

		}
		



	}	

?>