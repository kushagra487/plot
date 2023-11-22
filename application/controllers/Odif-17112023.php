<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

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

		

	/**
	 * Send Job card function Email will send to clients
	 */
	public function send_job_card_clients(){

		$this->load->library('email');
		$this->load->library('parser');
		$all_projects=$this->odif_model->get_all_projects();//print_r($all_projects);exit;
		foreach($all_projects as $all_project){
			$odif=$this->odif_model->get_todays_odif($all_project['project_id']);
			$p_details=$this->projects_model->view_projects_details_id($all_project['project_id']);

			$user_details= $this->users_model->get_user_details_byemail($p_details['user_id']);

			$powner=$this->projects_model->view_projects_details_id($all_project['project_id']);
			$currentDate = date('d-m-Y');
			//echo $currentDate;die;
			$count_of_activities=0;
			foreach($odif as $value){
				$count_of_activities=$count_of_activities+$value['actually_quantity'];
				//$tes=count($value['actually_quantity']);
			}
			$reminder_time = $this->odif_model->get_project_reminder_time($all_project['project_id']);
			$reminder_time = $reminder_time->daterange;

			// Assuming $reminder_time is in HH:mm format
			$current_time = strtotime(date("Y-m-d $reminder_time"));

			// Calculate the next run time by adding 5 minutes to the current time
			$fiveMinutesAfter = $current_time . ' +5 minutes';

			// Get the current server time
			$server_time = strtotime(date("Y-m-d H:i"));
			$project_details=$this->odif_model->get_project_reminder_time($all_project['project_id']);	

				/**
				* For dev server if project id is 315 then only send mail
				*/
				if($all_project['project_id'] == 315 || $all_project['project_id'] == 188) {	

					echo '<br>Server Time-->'.date("Y-m-d H:i", strtotime(date("Y-m-d H:i")));
					echo '<br>Current Time-->'.date("Y-m-d H:i", $current_time);
					echo '<br>Five Minutes After-->'.date("Y-m-d H:i", $fiveMinutesAfter + 300);

					if($server_time > $current_time && $server_time < $fiveMinutesAfter + 300){	

						echo '<br>aa-->';
						
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

		$client_emails=explode(",", $project_details->client_emails);

		print_r($client_emails);

		echo '<br>'.$message;

		foreach($client_emails as $client_emails){
			if($client_emails!=''){

				$this->email->clear();
				$config['mailtype'] = "html";
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from('plot@pboplus.com', 'Pboplus');
				$this->email->to(trim($client_emails));
				$this->email->subject('Today Job Card');
				$this->email->message($message);
				$this->email->send();
			}

			$client_emails='';

		}
			
					}//if server time 
				}
			
			
		}//all projects		
	}

	/**
	 * Send Job card function Email will send to assigned Project Manager and employees
	 */
	public function send_job_card_members(){
		$all_projects=$this->odif_model->get_all_projects();

		foreach($all_projects as $all_project) {
		$reminder_time = $this->odif_model->get_project_reminder_time($all_project['project_id']);
		$reminder_time = $reminder_time->daterange;
	
		// Assuming $reminder_time is in HH:mm format
		$current_time = strtotime(date("Y-m-d $reminder_time"));
	
		// Calculate the next run time by adding 5 minutes to the current time
		$fiveMinutesAfter = $current_time . ' +5 minutes';
	
		// Get the current server time
		$server_time = strtotime(date("Y-m-d H:i"));
		$project_details=$this->odif_model->get_project_reminder_time($all_project['project_id']);	
		$messagePm = null;
		$messageTm = null;
	
		/**
		* For dev server if project id is 315 then only send mail
		*/
		if($all_project['project_id'] == 315 || $all_project['project_id'] == 188) {	
	
			echo '<br>Server Time-->'.date("Y-m-d H:i", strtotime(date("Y-m-d H:i")));
			echo '<br>Current Time-->'.date("Y-m-d H:i", $current_time);
			echo '<br>Five Minutes After-->'.date("Y-m-d H:i", $fiveMinutesAfter + 300);
	
			if($server_time > $current_time && $server_time < $fiveMinutesAfter + 300){	
	
					$assigedTm = $this->wbs_model->get_assiged_tm_details($all_project['project_id']);print_r($assigedTm);
	
					foreach($assigedTm as $assigedTmValue) {
						$user_details= $this->users_model->get_user_details_byemail($assigedTmValue['tm_list']);
						$odif=$this->odif_model->get_todays_odif_member_all($all_project['project_id'], $user_details['user_id']);
						$p_details=$this->projects_model->view_projects_details_id($all_project['project_id']);
	
						$user_details= $this->users_model->get_user_details_byemail($p_details['user_id']);
	
						$powner=$this->projects_model->view_projects_details_id($all_project['project_id']);
						$currentDate = date('d-m-Y');
						//echo $currentDate;die;
						$count_of_activities=0;
						foreach($odif as $value){
							$count_of_activities=$count_of_activities+$value['actually_quantity'];
							//$tes=count($value['actually_quantity']);
						}
	
						$messageTm.="<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>
	
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
	
		$messageTm.="<tr bgcolor='#f6f6f6'>
	
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
	
		$messageTm.="</tbody>
	
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
	
						$mailTm= $assigedTmValue['tm_list'];
						$this->email->clear();
						$config['mailtype'] = "html";
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from('plot@pboplus.com');
						$this->email->to($mailTm);
	
						$this->email->subject('Plot Job Card');
						$this->email->message($messageTm);
						if($mailTm) {
							$this->email->send();
							$messageTm = '';
						}
	
	
					}
					$assigedPm = $this->wbs_model->get_assiged_pm_details($all_project['project_id']);
					foreach($assigedPm as $assigedPmValue) {
						$user_details= $this->users_model->get_user_details_byemail($p_details['pm_list']);
						$odif=$this->odif_model->get_todays_odif_member_all($all_project['project_id'], $user_details['user_id']);
						$p_details=$this->projects_model->view_projects_details_id($all_project['project_id']);
	
						$user_details= $this->users_model->get_user_details_byemail($p_details['user_id']);
	
						$powner=$this->projects_model->view_projects_details_id($all_project['project_id']);
						$currentDate = date('d-m-Y');
						//echo $currentDate;die;
						$count_of_activities=0;
						foreach($odif as $value){
							$count_of_activities=$count_of_activities+$value['actually_quantity'];
							//$tes=count($value['actually_quantity']);
						}
	
						$messagePm.="<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>
	
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
	
		$messagePm.="<tr bgcolor='#f6f6f6'>
	
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
	
		$messagePm.="</tbody>
	
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
					$mailPm=	$assigedPmValue['pm_list'];
					$this->email->clear();
					$config['mailtype'] = "html";
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from('plot@pboplus.com');
					$this->email->to($mailPm);
					$this->email->subject('Plot Job Card');

					$this->email->message($messagePm);
					if($mailPm) {
						$this->email->send();
						$messagePm = '';
					}
	
					}
	
			}//if server time
	
	
		}//if all project

	}//foreach all projects
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
				
				$server_time=date("Y-m-d H:i");
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
					$this->email->from('plot@pboplus.com');
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

		

		

		public function send_odif_report(){
			error_reporting(E_ALL);
			$this->load->library('email');
			$this->load->library('parser');
			$all_projects=$this->odif_model->get_all_projects();//print_r($all_projects);exit;
			$message = null;
			$message_pm = null;

			foreach($all_projects as $all_project){
				$odif=$this->odif_model->get_todays_odif($all_project['project_id']);
	
				$p_details=$this->projects_model->view_projects_details_id($all_project['project_id']);

				$user_details= $this->users_model->get_user_details_byemail($p_details['user_id']);

				$powner=$this->projects_model->view_projects_details_id($all_project['project_id']);
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
				$performance = 0;
				$odif_score = 0;

				if($count_of_total_activities > 0) {
					$performance=$count_of_actual_activities.'/'.$count_of_total_activities;
					$odif_score=($count_of_actual_activities/$count_of_total_activities)*100;
					$odif_score=round($odif_score,2).'%';
				}

				$assiged_tm=$this->wbs_model->get_assiged_tm_details($all_project['project_id']);
				$assiged_pm=$this->wbs_model->get_assiged_pm_details($all_project['project_id']);
				$reminder_time = $this->odif_model->get_project_reminder_time($all_project['project_id']);
				$reminder_time = $reminder_time->daterange;

				// Assuming $reminder_time is in HH:mm format
				$current_time = strtotime(date("Y-m-d $reminder_time"));

				// Calculate the next run time by adding 5 minutes to the current time
				$fiveMinutesAfter = $current_time . ' +5 minutes';

				// Get the current server time
				$server_time = strtotime(date("Y-m-d H:i"));	

				/**
				* For dev server if project id is 315 then only send mail
				*/
				if($all_project['project_id'] == 315 || $all_project['project_id'] == 188) {	

					/*echo '<br>Server Time-->'.date("Y-m-d H:i", strtotime(date("Y-m-d H:i")));
					echo '<br>Current Time-->'.date("Y-m-d H:i", $current_time);
					echo '<br>Five Minutes After-->'.date("Y-m-d H:i", $fiveMinutesAfter + 300);*/

					if($server_time > $current_time && $server_time < $fiveMinutesAfter + 300){	

						foreach($assiged_tm as $assiged_tm){
									 
							$activity_start_today_member=$this->odif_model->odif_report_odif_userwise('project_id',$all_project['project_id'],$assiged_tm['tm_list']);
							$total_activities=$this->odif_model->total_activity_userwise($all_project['project_id'],$assiged_tm['tm_list']);
							//echo $total_activities.'<br>';
							$complete_activity=$this->odif_model->complete_activity_userwise($all_project['project_id'],$assiged_tm['tm_list']);
			
			
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
							foreach($odif as $value){
							$sl++;
			
							if($value['activity_status']==0) {
							$status='0';
							}
							elseif($value['activity_status']==1) {
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
			
							$this->email->clear();
			
							$config['mailtype'] = "html";
							$config['useragent'] = 'CodeIgniter';
							$config['protocol'] = 'smtp';
							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from('plot@pboplus.com');
							$this->email->to($assiged_tm['tm_list']);
							$this->email->subject("PLOT ODIF Report");
							$this->email->message($message);
							$this->email->send();
			
			
						}
						foreach($assiged_pm as $assiged_pm){	
			
							$message_pm.="<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>
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
							foreach($odif as $value){
							$sl++;
			
							if($value['activity_status']==0) {
							$status='0';
							}
							elseif($value['activity_status']==1) {
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
			
							//echo "<br>aaa-->".$assiged_pm['pm_list'];	
							$this->email->clear();
							$config['mailtype'] = "html";
							$config['useragent'] = 'CodeIgniter';
							$config['protocol'] = 'smtp';
							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from('plot@pboplus.com');
							$this->email->to($assiged_pm['pm_list']);
							$this->email->subject("PLOT ODIF Report");
							$this->email->message($message_pm);
							$this->email->send();	
			
			
			
			
						}
			
					}//if server time 
				}
			
			
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
							$config['protocol'] = 'smtp';
							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from('plot@pboplus.com');
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
							if(($data['project_details']['daterange'] > date('H:i')) && ($_POST['odif_status'][$x]==1) ){
								$current_datetime = date('Y-m-d H:i:s', strtotime('yesterday'));
								$date_modified=date("Y-m-d H:i:s",strtotime('yesterday'));
							} else {
								$current_datetime =  date("Y-m-d H:i:s");
								$date_modified=date("Y-m-d H:i:s");
							}
							
							
							//$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."',actually_quantity='".$_POST['actually_quantity'][$x]."',temp_actual_quantity='".$_POST['actually_quantity'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");
							
							 
							if($_POST['odif_status'][$x]==1){
								$this->db->query("UPDATE `activity` SET `completed`='".$current_datetime."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							}		
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
							if($_POST['actually_quantity'][$x]){
								if($job_card <= 0){    
									$this->db->insert('job_card', $job_array); 
								} else {  
									$this->db->query("UPDATE `job_card` SET actually_quantity='".$_POST['actually_quantity'][$x]."' , created_date = '".date('Y-m-d')."' WHERE activity_id='".$_POST['odif_id'][$x]."'");	
								}	
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

			
							if($data['project_details']['daterange'] > date('H:i')){
								$current_datetime = date('Y-m-d H:i:s', strtotime('yesterday'));
								$date_modified=date("Y-m-d H:i:s",strtotime('yesterday'));
							} else {
								$current_datetime =  date("Y-m-d H:i:s");
								$date_modified=date("Y-m-d H:i:s");
							}
							

							//$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."',actually_quantity='".$_POST['actually_quantity'][$x]."',temp_actual_quantity='".$_POST['actually_quantity'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							// if($data['project_details']['daterange'] > date('H:i')){
							// 	$current_datetime = date('Y-m-d H:i:s', strtotime('yesterday'));
							// } else {
							// 	$current_datetime =  date("Y-m-d H:i:s");
							// }
							 
							if($_POST['odif_status'][$x]==1){
								$this->db->query("UPDATE `activity` SET `completed`='".$current_datetime."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							}	
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
							if($_POST['actually_quantity'][$x]){
								if($job_card <= 0){    
									$this->db->insert('job_card', $job_array); 
								} else {  
									$this->db->query("UPDATE `job_card` SET actually_quantity='".$_POST['actually_quantity'][$x]."' , created_date = '".date('Y-m-d')."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
								}
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

							if($data['project_details']['daterange'] > date('H:i')){
								$current_datetime = date('Y-m-d H:i:s', strtotime('yesterday'));
								$date_modified=date("Y-m-d H:i:s",strtotime('yesterday'));
							} else {
								$current_datetime =  date("Y-m-d H:i:s");
								$date_modified=date("Y-m-d H:i:s");
							}
							
							//$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."',actually_quantity='".$_POST['actually_quantity'][$x]."',temp_actual_quantity='".$_POST['actually_quantity'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");	
							$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");	
							// if($data['project_details']['daterange'] > date('H:i')){
							// 	$current_datetime = date('Y-m-d H:i:s', strtotime('yesterday'));
							// } else {
							// 	$current_datetime =  date("Y-m-d H:i:s");
							// }
							 
							if($_POST['odif_status'][$x]==1){
								$this->db->query("UPDATE `activity` SET `completed`='".$current_datetime."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							}	
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
							if($_POST['actually_quantity'][$x]){
								if($job_card <= 0){    
									$this->db->insert('job_card', $job_array); 
								} else {  
									$this->db->query("UPDATE `job_card` SET actually_quantity='".$_POST['actually_quantity'][$x]."' , created_date = '".date('Y-m-d')."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
								}
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

						if($data['project_details']['daterange'] > date('H:i')){
							$current_datetime = date('Y-m-d H:i:s', strtotime('yesterday'));
							$date_modified=date("Y-m-d H:i:s",strtotime('yesterday'));
						} else {
							$current_datetime =  date("Y-m-d H:i:s");
							$date_modified=date("Y-m-d H:i:s");
						}
							
						//$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."',actually_quantity='".$_POST['actually_quantity'][$x]."',temp_actual_quantity='".$_POST['actually_quantity'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
						$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
						// if($data['project_details']['daterange'] > date('H:i')){
						// 	$current_datetime = date('Y-m-d H:i:s', strtotime('yesterday'));
						// } else {
						// 	$current_datetime =  date("Y-m-d H:i:s");
						// }
						 
						if($_POST['odif_status'][$x]==1){
							$this->db->query("UPDATE `activity` SET `completed`='".$current_datetime."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
						}	
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
						if($_POST['actually_quantity'][$x]){
							if($job_card <= 0){    
								$this->db->insert('job_card', $job_array); 
							} else {  
								$this->db->query("UPDATE `job_card` SET actually_quantity='".$_POST['actually_quantity'][$x]."' , created_date = '".date('Y-m-d')."' WHERE activity_id='".$_POST['odif_id'][$x]."'");		
							}		
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
					

					$data['total_activity'] = $this->odif_model->get_todays_odif_member_all($get_id,$user_id);

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

								$diff=date_diff(date_create($edate),date_create($sdate));
								$data['datediff'] = $diff->format("%a");
								
								if($data['datediff'] <= 0) {
									$data['odif'] = $this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);	
								} else {
									$data['odif'] = $this->odif_model->odif_multi_filter_range($get_id,$sdate,$edate,$responsilbe_person);
								}
								
								//$data['odif']=$this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);								

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

								$diff=date_diff(date_create($edate),date_create($sdate));
								$data['datediff'] = $diff->format("%a");
								
								if($data['datediff'] <= 0) {
									$data['odif'] = $this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);	
								} else {
									$data['odif'] = $this->odif_model->odif_multi_filter_range($get_id,$sdate,$edate,$responsilbe_person);
								}

								//$data['odif']=$this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);  

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

								$diff=date_diff(date_create($edate),date_create($sdate));
								$data['datediff'] = $diff->format("%a");
								
								if($data['datediff'] <= 0) {
									$data['odif'] = $this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);	
								} else {
									$data['odif'] = $this->odif_model->odif_multi_filter_range($get_id,$sdate,$edate,$responsilbe_person);
								}

								//$data['odif']=$this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);  

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

								$diff=date_diff(date_create($edate),date_create($sdate));
								$data['datediff'] = $diff->format("%a");
								
								if($data['datediff'] <= 0) {
									$data['odif'] = $this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);	
								} else {
									$data['odif'] = $this->odif_model->odif_multi_filter_range($get_id,$sdate,$edate,$responsilbe_person);
								}
								//$data['odif']=$this->odif_model->odif_filter_range($get_id,$sdate,$edate,$responsilbe_person);  

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
		
		/**
		 * Send Odif Reminder
		 * odif/odif_reminder
		 */
		public function odif_reminder(){
			$all_projects = $this->odif_model->get_all_projects();

			foreach ($all_projects as $project) { // Use a different variable name for clarity

				/**
				 * For dev server if project id is 315 then only send mail
				 */
				if($project['project_id'] == 315 || $project['project_id'] == 188) {
				$user_details = $this->users_model->get_user_details_byemail($project['user_id']);
				$reminder_time = $this->odif_model->get_project_reminder_time($project['project_id']);
				$powner = $this->projects_model->view_projects_details_id($project['project_id']);
				$reminder_time = $reminder_time->daterange;

				$assiged_tm = $this->wbs_model->get_assiged_tm_details($project['project_id']);
				$assiged_pm = $this->wbs_model->get_assiged_pm_details($project['project_id']);

				$server_time = date("Y-m-d H:i");

				$current_time = date("Y-m-d $reminder_time");
				$two_hours_before = strtotime($current_time . ' -1 hours');
				$thirty_minutes_before = strtotime($current_time . ' -30 minutes');

				if (strtotime($server_time) >= $two_hours_before && strtotime($server_time) < $two_hours_before + 300) {
					
					$this->sendReminderEmails($assiged_tm, $assiged_pm, '', $project, $powner, $reminder_time);
				}

				if (strtotime($server_time) >= $thirty_minutes_before && strtotime($server_time) < $thirty_minutes_before + 300) {
					$this->sendReminderEmails($assiged_tm, $assiged_pm, true, $project, $powner, $reminder_time);
				}

				}

			}

			echo 'Reminder mail sent successfully';
		}
		
		/**
		 * Set up ODIF ReminderEmails to be sent to TM and PM
		 */
		public function sendReminderEmails($assiged_tm, $assiged_pm, $isThirtyMinutesBefore = false, $project, $powner, $reminder_time) {
			foreach ($assiged_tm as $assiged_tm) {
				$mail_tm = $assiged_tm['tm_list'];
		
				if ($mail_tm != '') {
					$this->sendReminderEmail($mail_tm, $isThirtyMinutesBefore, $project, $powner, $reminder_time);
				}
			}

			foreach ($assiged_pm as $assiged_pm) {
				$mail_pm = $assiged_pm['pm_list'];
		
				if ($mail_pm != '') {
					$this->sendReminderEmail($mail_pm, $isThirtyMinutesBefore, $project, $powner, $reminder_time);
				}
			}
		}

		/**
		 * Send ODIF reminder mails to TM and PM
		 */
		public function sendReminderEmail($recipient, $isThirtyMinutesBefore = false, $project, $powner, $reminder_time) {
			$this->load->library('email');
			$this->load->library('parser');
			$this->email->clear();
			$config['mailtype'] = "html";
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('plot@pboplus.com');
			$this->email->to($recipient);

			echo '<br>'.$recipient;
		
			$subject = 'ODIF Report Reminder';

			$thirtyMinutesBeforeMsg = null;

			if($isThirtyMinutesBefore) {
				$thirtyMinutesBeforeMsg = 'If its already updated, then kindly ignore this email.';
			}
		
			$this->email->subject($subject);

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
				<td colspan='2'><p>&nbsp;</p></td>
			</tr>

			<tr>
                    	<td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding:0;margin:0;'>
                    	Project Name:<a style='text-decoration:none;' href='".base_url()."/wbs_list/index/".$project['project_id']."'>".$project['project_name']."</a>
                    	
                    	</h4></td><td><h4 style='color:#1d9f75;font-size:20px;font-weight:normal;padding-bottom:5px;'>
                    	Project Owner: ".$powner['name']." </h4></td>
                    </tr>
	    <tr>				
    <td style='font-size:14px;color:#5b6a6f;padding:10px 25px;'  colspan='2'>
    	<p>ODIF report will be share at ".$reminder_time." Please update the ODIF as per yesterday's job card. ".$thirtyMinutesBeforeMsg."</p>
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

		public function generatePdf(){
			$loggedin = $this->logged_in();
			$this->load->library('pdf');

			if ($loggedin == TRUE) {
				$get_id =  $this->uri->segment('3');
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$uname = $this->session->userdata['name'];

				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['project_details'] = $this->wbs_model->get_project_details($get_id);
				$data['logo'] = $this->logo_model->view_logo();

				// assigned PM list and TM list
				$data['assign_pm_list'] = $this->projects_model->assign_pmlist($get_id);
				$data['assign_tm_list'] = $this->projects_model->assign_tmlist($get_id);

				if ($role != "Team Member") {
					$data['total_activity'] = $this->odif_model->get_todays_odif_all($get_id);
					$data['complete_activity'] = $this->odif_model->get_todays_odif_completed($get_id);
					$data['odif_score'] = $this->odif_model->odif_score($get_id);
				} else {
					$data['total_activity'] = $this->odif_model->get_todays_odif_member_all($get_id, $user_id);
					$data['complete_activity'] = $this->odif_model->get_todays_odif_member_completed($get_id, $user_id);
					$data['odif_score'] = $this->odif_model->odif_score_members($get_id, $user_id);
				}

				// Get user Comment
				$data['getcomment'] = $this->wbs_list_model->get_comment($get_id);

				if ($role == 'Admin') {
					$data['odif'] = $this->odif_model->get_todays_odif($get_id);
					$this->pdf->load_view('pdf/odif', $data);
					$this->pdf->render();
					$this->pdf->stream("jobcard.pdf");
				} elseif ($role == 'Editor') {
					$data['odif'] = $this->odif_model->get_todays_odif($get_id);
					$this->pdf->load_view('pdf/odif', $data);
					$this->pdf->render();
					$this->pdf->stream("jobcard.pdf");
				} elseif ($role == 'Project Manager') {
					$data['odif'] = $this->odif_model->get_todays_odif($get_id);
					$this->pdf->load_view('pdf/odif', $data);
					$this->pdf->render();
					$this->pdf->stream("jobcard.pdf");
				} elseif ($role == 'Team Member') {
					$data['odif'] = $this->odif_model->get_todays_odif_member($get_id, $this->session->userdata['user_id']);
					$this->pdf->load_view('pdf/odif', $data);
					$this->pdf->render();
					$this->pdf->stream("jobcard.pdf");
				}
			} else {
				redirect(base_url() . 'login/');
			}	
		}
	}	

?>