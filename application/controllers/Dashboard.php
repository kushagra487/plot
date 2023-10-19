<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model('dashboard_model');
			$this->load->model('logo_model');
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
		
		public function get_employee_performance(){
			
		$datestring=$_POST['date'];	
		$string=explode("-",$datestring);
		//print_r($string);
		
		$start_date=$string[0]."-".$string[1]."-".$string[2];
		$finish_date=$string[3]."-".$string[4]."-".$string[5];
		
		$employee_performance=$this->dashboard_model->get_employee_performance($start_date,$finish_date);
		
		$emplyee_name='';
		foreach($employee_performance as $result){
			
		$employee_name.="'".$result['name']."'".",";	
		}
		$emp_names=substr($employee_name,0,-1); 
	
	
	$sql_activity_count="SELECT count(1) as total,sum(case when `activity_status` = '1' then 1 else 0 end) completed FROM activity WHERE   str_to_date(start_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date' OR  str_to_date(finish_date,'%d/%m/%Y') BETWEEN '$start_date' AND '$finish_date' GROUP BY assigned_person  order BY assigned_person";
	$res_activity=$this->db->query($sql_activity_count);
	$per='';
	foreach($res_activity->result_array() as $result){
	$total_activity=$result['total'];
	$total_completed=$result['completed'];
	
	$percentage=ceil(($total_completed/$total_activity)*100);
	$per.=$percentage.",";
	}
	
	$per=substr($per,0,-1); 
			
		echo "<script>var myChart = echarts.init(document.getElementById('echart_bar_horizontal'), theme);
    myChart.setOption({
      tooltip: {
        trigger: 'axis'
      },
      legend: {
        data: ['Percentage']
      },
      toolbox: {
        show: false,
        feature: {
          saveAsImage: {
            show: true
          }
        }
      },
      calculable: true,
      xAxis: [{
        type: 'value',
		data:[20, 40, 60, 80, 100]
      }],
      yAxis: [{
        type: 'category',
        data: [".$emp_names."]
      }],
      series: [{
        name: 'Percentage',
        type: 'bar',
        data: [".$per."]
      }]
    });

</script>";
		
		}
		
		public function index(){
		
				
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
			
			//yaha pe user_id me email return ho raha hai is liye user_id se search nahi ho raha
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				
				$datestring=$_POST['date'];	
				if($datestring!=''){
				$string=explode("-",$datestring);
		//print_r($string);
		
				$start_date=$string[0]."-".$string[1]."-".$string[2];
				$finish_date=$string[3]."-".$string[4]."-".$string[5];
				}
				$project_filterid=$_POST['project_filterid'];
				$userid_from_post=$_POST['userid'];
				$role_post=$this->dashboard_model->get_role_users($userid_from_post);
				$role_post=$role_post->role;
				
				
				$data['logo'] = $this->logo_model->view_logo();
				
				if($role == 'Admin' || $role == 'Editor'){
					
				
				if($project_filterid>0) {
				$data['all_users'] =$this->dashboard_model->get_project_users($project_filterid);		
				}else {
				$data['all_users'] =$this->dashboard_model->get_all_users();		
				}
				
				if($_POST['userid']>0 && $role_post=='Project Manager'){
				$data['donut_graph'] =$this->dashboard_model->donut_graph_pm($userid_from_post);
				$data['project_data'] = $this->dashboard_model->get_project_data_pm($start_date,$finish_date,$userid_from_post);
				$data['project_names'] = $this->dashboard_model->get_project_names_pm($project_filterid,$userid_from_post);
				$data['project_names1'] = $this->dashboard_model->get_project_names_pm1($project_filterid,$userid_from_post);
				$data['employee_performance']=$this->dashboard_model->get_employee_performance($start_date,$finish_date,$project_filterid,$userid_from_post);
				
				$data['project_sdate'] = $this->dashboard_model->get_project_sdate_pm($project_filterid,$userid_from_post);
				$data['project_edate'] = $this->dashboard_model->get_project_edate_pm($project_filterid,$userid_from_post);
				
				$data['remainig_days'] = $this->dashboard_model->get_project_remaining_days_pm($project_filterid,$userid_from_post);
				$data['delayvalue'] = $this->dashboard_model->get_project_delay_pm($project_filterid,$userid_from_post);
				$data['performance'] = $this->dashboard_model->completed_activities_till_today_pm($project_filterid,$start_date,$finish_date,$userid_from_post);
				$data['project_months'] = $this->dashboard_model->get_project_months_pm($project_filterid,$userid_from_post);
				$data['project_per'] = $this->dashboard_model->till_today_months_pm($project_filterid,$userid_from_post);	
				$data['per']=$this->dashboard_model->get_employee_per_member($start_date,$finish_date,$userid_from_post,$project_filterid);
				
				$data['end_days']=$this->dashboard_model->get_project_ending_days_pm($project_filterid,$userid_from_post);
				
				}else if($_POST['userid']>0 && $role_post=='Team Member') {
				$data['donut_graph'] =$this->dashboard_model->donut_graph_member($userid_from_post);
				$data['project_data'] = $this->dashboard_model->get_project_data_member($start_date,$finish_date,$userid_from_post);
			$data['project_names'] = $this->dashboard_model->get_project_names_member($project_filterid,$userid_from_post);
			$data['project_names1'] = $this->dashboard_model->get_project_names_member1($project_filterid,$userid_from_post);
			$data['employee_performance']=$this->dashboard_model->get_employee_performance_member($start_date,$finish_date,$project_filterid,$userid_from_post);
			
			$data['project_sdate'] = $this->dashboard_model->get_project_sdate_member($project_filterid,$userid_from_post);
			$data['project_edate'] = $this->dashboard_model->get_project_edate_member($project_filterid,$userid_from_post);
			
			$data['remainig_days'] = $this->dashboard_model->get_project_remaining_days_member($project_filterid,$userid_from_post);
		    $data['delayvalue'] = $this->dashboard_model->get_project_delay_member($project_filterid,$userid_from_post);
			$data['performance'] = $this->dashboard_model->completed_activities_till_today_member($project_filterid,$start_date,$finish_date,$userid_from_post);	
			$data['project_months'] = $this->dashboard_model->get_project_months_member($project_filterid,$userid_from_post);
			$data['project_per'] = $this->dashboard_model->till_today_months_member($project_filterid,$userid_from_post);	
			$data['per']=$this->dashboard_model->get_employee_per_member($start_date,$finish_date,$userid_from_post,$project_filterid);
			
			$data['end_days']=$this->dashboard_model->get_project_ending_days_member($project_filterid,$userid_from_post);
			
			//
				}
				
				else{
				//echo "hello";	
				$data['donut_graph'] =$this->dashboard_model->donut_graph();
				$data['project_data'] = $this->dashboard_model->get_project_data($start_date,$finish_date);
				$data['project_names'] = $this->dashboard_model->get_project_names($project_filterid);
				$data['project_names1'] = $this->dashboard_model->get_project_names1($project_filterid);
				$data['employee_performance']=$this->dashboard_model->get_employee_performance($start_date,$finish_date,$project_filterid,'');
				$data['project_sdate'] = $this->dashboard_model->get_project_sdate($project_filterid);
				$data['project_edate'] = $this->dashboard_model->get_project_edate($project_filterid);
				$data['remainig_days'] = $this->dashboard_model->get_project_remaining_days($project_filterid);
				$data['delayvalue'] = $this->dashboard_model->get_project_delay($project_filterid);
				$data['performance'] = $this->dashboard_model->completed_activities_till_today($project_filterid,$start_date,$finish_date);
				$data['project_months'] = $this->dashboard_model->get_project_months($project_filterid);
				$data['project_per'] = $this->dashboard_model->till_today_months($project_filterid);
				$data['per']=$this->dashboard_model->get_employee_per($start_date,$finish_date,$project_filterid);
				$data['end_days']=$this->dashboard_model->get_project_ending_days($project_filterid);

				}
				//print_r($data);
				}
				else if($role == 'Project Manager'){
				if($project_filterid>0) {
				$data['all_users'] =$this->dashboard_model->get_project_users($project_filterid);		
				}else {
				$data['all_users'] =$this->dashboard_model->get_all_users();		
				}
				if($_POST['userid']>0 && $role_post=='Team Member') {
				$data['donut_graph'] =$this->dashboard_model->donut_graph_member($userid_from_post);
				$data['project_data'] = $this->dashboard_model->get_project_data_member($start_date,$finish_date,$userid_from_post);
			$data['project_names'] = $this->dashboard_model->get_project_names_member($project_filterid,$userid_from_post);
			$data['project_names1'] = $this->dashboard_model->get_project_names_member1($project_filterid,$userid_from_post);
			$data['employee_performance']=$this->dashboard_model->get_employee_performance_member($start_date,$finish_date,$project_filterid,$userid_from_post);
			
			$data['project_sdate'] = $this->dashboard_model->get_project_sdate_member($project_filterid,$userid_from_post);
			$data['project_edate'] = $this->dashboard_model->get_project_edate_member($project_filterid,$userid_from_post);
			
			$data['remainig_days'] = $this->dashboard_model->get_project_remaining_days_member($project_filterid,$userid_from_post);
		    $data['delayvalue'] = $this->dashboard_model->get_project_delay_member($project_filterid,$userid_from_post);
			$data['performance'] = $this->dashboard_model->completed_activities_till_today_member($project_filterid,$start_date,$finish_date,$userid_from_post);	
			$data['project_months'] = $this->dashboard_model->get_project_months_member($project_filterid,$userid_from_post);
			$data['project_per'] = $this->dashboard_model->till_today_months_member($project_filterid,$userid_from_post);	
			$data['per']=$this->dashboard_model->get_employee_per_member($start_date,$finish_date,$userid_from_post,$project_filterid);
			
				$data['end_days']=$this->dashboard_model->get_project_ending_days_member($project_filterid,$userid_from_post);
				
				}else{	
					
				$data['donut_graph'] =$this->dashboard_model->donut_graph_pm($user_id);
				$data['project_data'] = $this->dashboard_model->get_project_data_pm($start_date,$finish_date,$user_id);
				$data['project_names'] = $this->dashboard_model->get_project_names_pm($project_filterid,$user_id);
				$data['project_names1'] = $this->dashboard_model->get_project_names_pm1($project_filterid,$user_id);
				$data['employee_performance']=$this->dashboard_model->get_employee_performance($start_date,$finish_date,$project_filterid,$user_id);
				
				$data['project_sdate'] = $this->dashboard_model->get_project_sdate_pm($project_filterid,$user_id);
				$data['project_edate'] = $this->dashboard_model->get_project_edate_pm($project_filterid,$user_id);
				
				$data['remainig_days'] = $this->dashboard_model->get_project_remaining_days_pm($project_filterid,$user_id);
				$data['delayvalue'] = $this->dashboard_model->get_project_delay_pm($project_filterid,$user_id);
				$data['performance'] = $this->dashboard_model->completed_activities_till_today_pm($project_filterid,$start_date,$finish_date,$user_id);
				$data['project_months'] = $this->dashboard_model->get_project_months_pm($project_filterid,$user_id);
				$data['project_per'] = $this->dashboard_model->till_today_months_pm($project_filterid,$user_id);
				//print_r($data);
				$data['per']=$this->dashboard_model->get_employee_per($start_date,$finish_date,$project_filterid);
				$data['end_days']=$this->dashboard_model->get_project_ending_days_pm($project_filterid,$user_id);
				}
				
				}else if($role == 'Team Member'){
				$data['donut_graph'] =$this->dashboard_model->donut_graph_member($user_id);
				$data['project_data'] = $this->dashboard_model->get_project_data_member($start_date,$finish_date,$user_id);
			$data['project_names'] = $this->dashboard_model->get_project_names_member($project_filterid,$user_id);
			$data['project_names1'] = $this->dashboard_model->get_project_names_member1($project_filterid,$user_id);
			$data['employee_performance']=$this->dashboard_model->get_employee_performance_member($start_date,$finish_date,$project_filterid,$user_id);
			
			$data['project_sdate'] = $this->dashboard_model->get_project_sdate_member($project_filterid,$user_id);
			$data['project_edate'] = $this->dashboard_model->get_project_edate_member($project_filterid,$user_id);
			
			$data['remainig_days'] = $this->dashboard_model->get_project_remaining_days_member($project_filterid,$user_id);
		    $data['delayvalue'] = $this->dashboard_model->get_project_delay_member($project_filterid,$user_id);
			$data['performance'] = $this->dashboard_model->completed_activities_till_today_member($project_filterid,$start_date,$finish_date,$user_id);	
			$data['project_months'] = $this->dashboard_model->get_project_months_member($project_filterid,$user_id);
			$data['project_per'] = $this->dashboard_model->till_today_months_member($project_filterid,$user_id);
			$data['per']=$this->dashboard_model->get_employee_per_member($start_date,$finish_date,$user_id,$project_filterid);	
			
				$data['end_days']=$this->dashboard_model->get_project_ending_days_member($project_filterid,$user_id);
				
				}
				
				
				
						
				$data['all_members']=$all_members=$this->dashboard_model->get_all_members_project($start_date,$finish_date,$project_filterid);
		

			
							
				if($role == 'Admin'){
					$this->load->view('header', $data);
					$this->load->view('admin_sidebar', $data);
					$this->load->view('Dashboard/dashboard', $data);
					$this->load->view('footer',$data);
				}elseif($role == 'Editor'){
					$this->load->view('header', $data);
					$this->load->view('editor_sidebar', $data);
					$this->load->view('Dashboard/dashboard', $data);
					$this->load->view('footer',$data);
				}elseif($role == 'Project Manager'){
					$this->load->view('header', $data);
					$this->load->view('pm_sidebar', $data);
					$this->load->view('Dashboard/dashboard', $data);
					$this->load->view('footer',$data);
				}elseif($role == 'Team Member'){
					$this->load->view('header', $data);
					$this->load->view('tm_sidebar', $data);
					$this->load->view('Dashboard/dashboard', $data);
					$this->load->view('footer',$data);
				}
			} else {
				redirect(base_url().'login/');
			}
		}
	}
?>