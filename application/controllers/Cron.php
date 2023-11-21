<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cron extends CI_Controller {
	public function __construct(){
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
    }
    public function getActivityById($id) {
        $this->db->select('*');
        $this->db->from('activity');
        $this->db->where('activity_id', $id); 
        $query = $this->db->get(); 
        return $query->row_array();
    }
    public function getProjectById($id) {
        $this->db->select('*');
        $this->db->from('project_name');
        $this->db->where('project_id', $id); 
        $query = $this->db->get(); 
        return $query->row_array();
    }
    public function updateWbs(){
    
        $this->db->select('*');
        $this->db->from('job_card');
        $this->db->group_start();
        $this->db->where('DATE(created_date)', date('Y-m-d'));
        $this->db->or_where('DATE(created_date)', date('Y-m-d', strtotime('-1 day')));
        $this->db->group_end();
        $this->db->where('actually_quantity >', 0);
        $query = $this->db->get();
        $results = $query->result_array();
       
        $log_message = "Live: Wbs Update Time ".date('Y-m-d h:i:s a', time());
        $log_file_path = APPPATH . 'logs/wbsupdate.log';  
        write_file($log_file_path, $log_message . "\n", 'a');

        if($results) {
            foreach($results as $row) {
                $activities = $this->getActivityById($row['activity_id']);
                $cron_time  = $this->getProjectById($activities['project_id']);
                $current_time = date("H:i:s"); 
                $extra_time  = date('H:i:s', strtotime($cron_time['daterange'].'+ 5 minute'));
 
               if($cron_time['daterange'] <= $current_time && $extra_time > $current_time ){
                    //$this->db->query("UPDATE `activity` SET actually_quantity='actually_quantity+".$row['actually_quantity']."',temp_actual_quantity='temp_actual_quantity+".$row['actually_quantity']."' WHERE activity_id='".$row['activity_id']."'");		
                    //$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");
                   // $this->db->query("UPDATE `job_card` SET planned_quantity='".($row['planned_quantity']-$row['actually_quantity'])."' , actually_quantity = '0' WHERE activity_id='".$row['activity_id']."'");
                 //  echo "UPDATE `activity` SET actually_quantity = COALESCE(actually_quantity, 0) + " . $row['actually_quantity'] . ", temp_actual_quantity = COALESCE(temp_actual_quantity, 0) + " . $row['actually_quantity'] . " WHERE activity_id = '" . $row['activity_id'] . "'";die;
                   $this->db->query("UPDATE `activity` SET actually_quantity = COALESCE(actually_quantity, 0) + " . $row['actually_quantity'] . ", temp_actual_quantity = COALESCE(temp_actual_quantity, 0) + " . $row['actually_quantity'] . " WHERE activity_id = '" . $row['activity_id'] . "'");
                   $this->db->query("UPDATE `job_card` SET planned_quantity='".($row['planned_quantity']-$row['actually_quantity'])."' , actually_quantity = '0' WHERE activity_id='".$row['activity_id']."'");
                   
                   
                   echo $row['activity_id'] . ' Wbs has been updated successfully<br>';
                      
                    write_file($log_file_path,  $row['activity_id'] . "Wbs has been updated successfully \n", 'a');
                } else {
                    write_file($log_file_path,  $row['activity_id'] . "Not Update \n", 'a');
                     
                }
                
            }	
        }
    }

    // public function updateJobCard(){
    //     $this->db->select('*');
    //     $this->db->from('job_card');
    //     $this->db->where('DATE(created_date)', date('Y-m-d',strtotime("-1 days")));
    //     $query = $this->db->get();
    //     $results = $query->result_array();
       
    //     if($results) {
    //         foreach($results as $row) {
    //             $current_date = date("Y-m-d");
 
    //            if($row['created_date'] < $current_date ){
    //                // $this->db->query("UPDATE `activity` SET actually_quantity='".$row['actually_quantity']."',temp_actual_quantity='".$row['actually_quantity']."' WHERE activity_id='".$row['activity_id']."'");		
    //                 //$this->db->query("UPDATE `activity` SET `activity_status`='".$_POST['odif_status'][$x]."',activity_status_modified='".$date_modified."',comments='".$_POST['odif_comment'][$x]."' WHERE activity_id='".$_POST['odif_id'][$x]."'");
    //                 $this->db->query("UPDATE `job_card` SET planned_quantity='".($row['planned_quantity']-$row['actually_quantity'])."' , actually_quantity = '0' WHERE activity_id='".$row['activity_id']."'");
    //             }
                
    //         }	
    //     }
    // }

	public function __destruct() {
		$this->db->close();
	}
}