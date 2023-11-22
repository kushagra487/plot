<?php
include("connection.php");
$current_date=date("d/m/Y");
$sql_todays_activity_start=" SELECT * FROM `activity` WHERE start_date = '".$current_date."'";
$res_todays_start=mysql_query($sql_todays_activity_start);


$sql_todays_activity_end=" SELECT * FROM `activity` WHERE finish_date = '".$current_date."'";
$res_todays_end=mysql_query($sql_todays_activity_end);


$sql_todays=" SELECT * FROM `activity` WHERE start_date = '".$current_date."' AND 
finish_date = '".$current_date."'";
$res_todays=mysql_query($sql_todays);

$sql_projects="SELECT * FROM project_name WHERE status=0";
$res_projects=$wpdb->get_results($sql_projects);


foreach($activity_start_today as $start_today){
					
					$mailto=$start_today->assigned_person;	
					
					
					
				}
				
				foreach($activity_end_today as $end_today){
					
					$mailto=$end_today->assigned_person;	
				
					$this->email->from('your@example.com', 'Your Name');
					$this->email->to($mailto);
					$this->email->cc('another@another-example.com');
					$this->email->bcc('them@their-example.com');
					$this->email->subject('Email Test');
					$this->email->message('Testing the email class.');
					$this->email->send();	
					
					
				}
				
				foreach($activity_start_end_today as $start_end_today){
					$mailto=$start_end_today->assigned_person;	
				
					$this->email->from('your@example.com', 'Your Name');
					$this->email->to($mailto);
					$this->email->cc('another@another-example.com');
					$this->email->bcc('them@their-example.com');
					$this->email->subject('Email Test');
					$this->email->message('Testing the email class.');
					$this->email->send();		
				}





?>