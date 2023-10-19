<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Add_project extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('projects_model');
			$this->load->model('logo_model');
			$this->load->model('dashboard_model');
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

		public function index(){
			
			if(isset($_POST['edit'])){
				$rvalue = $_REQUEST['sendpid'];
				header ("location:http:edit_project_users/$rvalue/");
			}elseif(isset($_POST['view'])){
				$rvalue = $_REQUEST['sendpid'];
				header ("location:view_assigned_users/$rvalue/");
			}elseif(isset($_POST['project_deleteid'])){
				
				$delete_id = $_REQUEST['project_deleteid'];
				header ("location:".base_url()."/add_project/delete_projects/$delete_id/");
			}
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['pm_details'] = $this->projects_model->view_pm_details();
				$data['tm_details'] = $this->projects_model->view_tm_details();
				if($role == 'Admin'){
					
					//echo "hello";die;
					if(isset($_POST['project_name'])){
						
						//echo "hello";die;
						
						$config['upload_path'] = './project_uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image']['name'];
						$img_name = str_replace(' ','_', $image_name);				
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('image')) {
							$data['project_details'] = $this->projects_model->view_projects_details();
							$data['message']= '<div class="alert alert-danger">Your details has not upload yet!</div>';		
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('User_projects/add_projects', $data);
							$this->load->view('footer');
						}else{
							$details = array(
							'project_name' => $_POST['project_name'],
							'project_logo' => $img_name,
							'user_id' => $user_id,
							'created_date' => date('Y-m-d'),
							'status' => 0
							);
							$this->projects_model->add_projects($details);
							$data['project_details'] = $this->projects_model->view_projects_details();
							$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('User_projects/add_projects', $data);
							$this->load->view('footer');
						}
					}elseif(isset($_POST['update_users'])){
						
								
						$config['upload_path'] = './project_uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image1']['name'];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						$pm_lists = $_POST['pm_list'];
						$tm_lists = $_POST['tm_list'];
						
						
						if (!$this->upload->do_upload('image1')) {
							foreach($pm_lists as $key => $value){
								$pm_details = array(
									'pm_list' => $value,
									'user_id' => $user_id,
									
									'project_id' => $_POST['hidden_id']
								);
								$this->projects_model->add_project_pm($pm_details);
							}
							foreach($tm_lists as $key => $value){
								$tm_details = array(
									'tm_list' => $value,
									'user_id' => $user_id,
									'project_id' => $_POST['hidden_id']
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$hidden_id = $_POST['hidden_id'];
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								 'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->update_projects($project_details, $hidden_id);
							$data['project_details'] = $this->projects_model->view_projects_details();
							$data['message1']= '<div class="alert alert-success">Your details has been inserted successfully.</div>';		
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('User_projects/add_projects', $data);
							$this->load->view('footer');
						}else{
							$hidden_id = $_POST['hidden_id'];
							foreach($pm_lists as $key => $value){
								$pm_details = array(
									'pm_list' => $value,
									'user_id' => $user_id,
									'project_id' => $_POST['hidden_id']
								);
								$this->projects_model->add_project_pm($pm_details);
							}
							foreach($tm_lists as $key => $value){
								$tm_details = array(
									'tm_list' => $value,
									'user_id' => $user_id,
									'project_id' => $_POST['hidden_id']
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								'project_logo' => $img_name,
								 'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->update_projects($project_details, $hidden_id);
							$data['project_details'] = $this->projects_model->view_projects_details();
							$data['message1'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('User_projects/add_projects', $data);
							$this->load->view('footer');
						}
					}else{
						$data['project_details'] = $this->projects_model->view_projects_details();
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('User_projects/add_projects', $data);
						$this->load->view('footer');
					}
				}
				elseif($role == 'Editor'){
					if(isset($_POST['project_name'])){}
					elseif(isset($_POST['update_users'])){
						$config['upload_path'] = './project_uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image1']['name'];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						$pm_lists = $_POST['pm_list'];
						$tm_lists = $_POST['tm_list'];
						if (!$this->upload->do_upload('image1')) {
							foreach($pm_lists as $key => $value){
								$pm_details = array(
									'pm_list' => $value,
									'user_id' => $user_id,
									'project_id' => $_POST['hidden_id']
								);
								$this->projects_model->add_project_pm($pm_details);
							}
							foreach($tm_lists as $key => $value){
								$tm_details = array(
									'tm_list' => $value,
									'user_id' => $user_id,
									'project_id' => $_POST['hidden_id']
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$hidden_id = $_POST['hidden_id'];
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								 'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->update_projects($project_details, $hidden_id);
							$data['project_details'] = $this->projects_model->view_projects_details();
							$data['message1']= '<div class="alert alert-success">Your details has been inserted successfully.</div>';		
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('User_projects/add_projects', $data);
							$this->load->view('footer');
						}else{
							$hidden_id = $_POST['hidden_id'];
							foreach($pm_lists as $key => $value){
								$pm_details = array(
									'pm_list' => $value,
									'user_id' => $user_id,
									'project_id' => $_POST['hidden_id']
								);
								$this->projects_model->add_project_pm($pm_details);
							}
							foreach($tm_lists as $key => $value){
								$tm_details = array(
									'tm_list' => $value,
									'user_id' => $user_id,
									'project_id' => $_POST['hidden_id']
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								'project_logo' => $img_name,
								 'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->update_projects($project_details, $hidden_id);
							$data['project_details'] = $this->projects_model->view_projects_details();
							$data['message1'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('User_projects/add_projects', $data);
							$this->load->view('footer');
						}
					}else{
						$data['project_details'] = $this->projects_model->view_projects_details();
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('User_projects/add_projects', $data);
						$this->load->view('footer');
					}
				}
				elseif($role == 'Project Manager'){
					//print_r($_POST);
					if(isset($_POST['project_name'])){
						
						
						
						$config['upload_path'] = './project_uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image']['name'];
						$img_name = str_replace(' ','_', $image_name);				
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('image')) {
							$data['message']= '<div class="alert alert-danger">Your details has not upload yet!</div>';		
							$this->load->view('header', $data);
							$this->load->view('pm_sidebar', $data);
							$this->load->view('User_projects/pm_add_project', $data);
							$this->load->view('footer');
						}else{
							$details = array(
								'project_name' => $_POST['project_name'],
								'project_logo' => $img_name,
								'user_id' => $user_id,
								'created_date' => date('Y-m-d'),
								'status' => 0
							);
							
							
							$this->projects_model->add_projects($details);
							$data['project_details'] = $this->projects_model->view_projects_details_user_id($user_id);
							$data['pm_assigned_details'] = $this->projects_model->view_pm_admin_editor_assigned_details($user_id);
							foreach($data['pm_assigned_details'] as $key => $project_id_value){
								$project_id = $project_id_value['project_id'];
								$admin_editor_assigned_project[] = $this->projects_model->view_projects_details_id($project_id);
							}
							$data['admin_editor_assigned_project_details'] = $admin_editor_assigned_project;
							$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
							$this->load->view('header', $data);
							$this->load->view('pm_sidebar', $data);
							$this->load->view('User_projects/pm_add_project', $data);
							$this->load->view('footer');
						}
					}elseif(isset($_POST['update_users'])){
						$config['upload_path'] = './project_uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image1']['name'];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						$pm_lists = $_POST['pm_list'];
						$tm_lists = $_POST['tm_list'];
						if (!$this->upload->do_upload('image1')) {
							foreach($tm_lists as $key => $value){
								$tm_details = array(
									'tm_list' => $value,
									'user_id' => $user_id,
									'project_id' => $_POST['hidden_id']
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$hidden_id = $_POST['hidden_id'];
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								 'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->update_projects($project_details, $hidden_id);
							$data['project_details'] = $this->projects_model->view_projects_details_user_id($user_id);
							$data['pm_assigned_details'] = $this->projects_model->view_pm_admin_editor_assigned_details($user_id);
							foreach($data['pm_assigned_details'] as $key => $project_id_value){
								$project_id = $project_id_value['project_id'];
								$admin_editor_assigned_project[] = $this->projects_model->view_projects_details_id($project_id);
							}
							$data['admin_editor_assigned_project_details'] = $admin_editor_assigned_project;
							$data['message1']= '<div class="alert alert-success">Your details has been inserted successfully.</div>';		
							$this->load->view('header', $data);
							$this->load->view('pm_sidebar', $data);
							$this->load->view('User_projects/pm_add_project', $data);
							$this->load->view('footer');
						}else{
							$hidden_id = $_POST['hidden_id'];
							foreach($tm_lists as $key => $value){
								$tm_details = array(
									'tm_list' => $value,
									'user_id' => $user_id,
									'project_id' => $_POST['hidden_id']
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								'project_logo' => $img_name,
								 'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->update_projects($project_details, $hidden_id);
							$data['project_details'] = $this->projects_model->view_projects_details_user_id($user_id);
							$data['pm_assigned_details'] = $this->projects_model->view_pm_admin_editor_assigned_details($user_id);
							foreach($data['pm_assigned_details'] as $key => $project_id_value){
								$project_id = $project_id_value['project_id'];
								$admin_editor_assigned_project[] = $this->projects_model->view_projects_details_id($project_id);
							}
							$data['admin_editor_assigned_project_details'] = $admin_editor_assigned_project;
							$data['message1'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
							$this->load->view('header', $data);
							$this->load->view('pm_sidebar', $data);
							$this->load->view('User_projects/pm_add_project', $data);
							$this->load->view('footer');
						}
					}else{
						
						
						
						//$data['project_details'] = $this->projects_model->view_projects_details_user_id($user_id);
						$data['pm_assigned_details'] = $this->projects_model->get_projects_of_pm($user_id);
												
						//array_merge($data['pm_assigned_details'],$data['tm_assigned_details']);
						foreach($data['pm_assigned_details'] as $key => $project_id_value){
							$project_id = $project_id_value['project_id'];
							$admin_editor_assigned_project[] = $this->projects_model->view_projects_details_id($project_id);
						}
						
						
						$data['project_details'] =$admin_editor_assigned_project;
						
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('User_projects/add_projects', $data);
						$this->load->view('footer');
					}
				}elseif($role == 'Team Member'){ 
					//echo "hiii";die;
					$data['tm_assigned_details'] = $this->projects_model->view_tm_assigned_details($user_id);
					
					//print_r($data);die;
					foreach($data['tm_assigned_details'] as $key => $project_id_value){
						$project_id = $project_id_value['project_id'];
						$admin_editor_assigned_project[] = $this->projects_model->view_projects_details_id($project_id);
					}
					$data['project_details'] = $admin_editor_assigned_project;
					
					//print_r($data);
							
					$this->load->view('header', $data);
					$this->load->view('admin_sidebar', $data);
					$this->load->view('User_projects/add_projects', $data);
					$this->load->view('footer');
					}
			} else {
				redirect(base_url().'login/');
			}
		}

		public function delete_projects(){
			
			//echo "hiiiiiiii";die;
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['project_details'] = $this->projects_model->view_projects_details();
				$data['pm_list'] = $this->projects_model->view_pm_details();
				$data['tm_list'] = $this->projects_model->view_tm_details();
				if($role == 'Admin'){
					if(isset($_POST['project_deleteid'])){
						$delete_id = $_REQUEST['project_deleteid'];
					}else{
						$delete_id =  $this->uri->segment('3');
					}
					$project_id =  $this->uri->segment('3');
					$deleted_id = $this->projects_model->delete_project($delete_id);
					$this->projects_model->delete_update_project_pm($project_id);
					$this->projects_model->delete_update_project_tm($project_id);
					//$data['message'] = "Project deleted successfully";
					$this->session->set_flashdata('message', 'Project deleted successfully');
					$data['details'] = $this->projects_model->view_projects_details();
					redirect(base_url().'add_project/index/');
				}elseif($role == 'Editor'){
					$delete_id =  $this->uri->segment('3');
					$project_id =  $this->uri->segment('3');
					$deleted_id = $this->projects_model->delete_project($delete_id);
					$this->projects_model->delete_update_project_pm($project_id);
					$this->projects_model->delete_update_project_tm($project_id);
					$data['details'] = $this->projects_model->view_projects_details();
					redirect(base_url().'add_project/index/');
				}elseif($role == 'Project Manager'){
					$delete_id =  $this->uri->segment('3');
					$project_id =  $this->uri->segment('3');
					$deleted_id = $this->projects_model->delete_project($delete_id);
					$this->projects_model->delete_update_project_pm($project_id);
					$this->projects_model->delete_update_project_tm($project_id);
					$data['details'] = $this->projects_model->view_projects_details();
					redirect(base_url().'add_project/index/');
				}							
			} else {
				redirect(base_url().'login/');
			}
		}

		public function view_assigned_users(){
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$project_id =  $this->uri->segment('3');
				$user_id = $this->session->userdata['user_id'];
				$data['pm_id'] = $user_id;
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['project_details'] = $this->projects_model->view_projects_details();
				$data['tm_list'] = $this->projects_model->view_assigned_tm_details($project_id);
				if($role == 'Admin'){
					$data['pm_list'] = $this->projects_model->view_assigned_pm_details($project_id);
					$this->load->view('header', $data);
					$this->load->view('admin_sidebar', $data);
					$this->load->view('User_projects/view_project_users', $data);
					$this->load->view('footer');
				}elseif($role == 'Editor'){
					$data['pm_list'] = $this->projects_model->view_assigned_pm_details($project_id);
					$this->load->view('header', $data);
					$this->load->view('editor_sidebar', $data);
					$this->load->view('User_projects/view_project_users', $data);
					$this->load->view('footer');
				}elseif($role == 'Project Manager'){
					$data['pm_list'] = $this->projects_model->view_assigned_pm_loggedin_details($project_id, $user_id);
					$this->load->view('header', $data);
					$this->load->view('pm_sidebar', $data);
					$this->load->view('User_projects/view_pm_project_users', $data);
					$this->load->view('footer');
				}				
			} else {
				redirect(base_url().'login/');
			}
		}

		public function delete_pm_projects(){
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$project_id =  $this->uri->segment('3');
				$delete_id =  $this->uri->segment('4');
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['project_details'] = $this->projects_model->view_projects_details_id($project_id);
				$data['pm_list'] = $this->projects_model->view_assigned_pm_details($project_id);
				$data['tm_list'] = $this->projects_model->view_assigned_tm_details($project_id);
				if($role == 'Admin'){
					$deleted_id = $this->projects_model->delete_project_pm($delete_id);
					redirect(base_url().'add_project/view_assigned_users/'.$project_id.'/');
				}elseif($role == 'Editor'){
					$deleted_id = $this->projects_model->delete_project_pm($delete_id);
					redirect(base_url().'add_project/view_assigned_users/'.$project_id.'/');
				}elseif($role == 'Project Manager'){
					$deleted_id = $this->projects_model->delete_project_pm($delete_id);
					redirect(base_url().'add_project/view_assigned_users/'.$project_id.'/');
				}							
			} else {
				redirect(base_url().'login/');
			}
		}

		public function delete_tm_projects(){
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$project_id =  $this->uri->segment('3');
				$delete_id =  $this->uri->segment('4');
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['project_details'] = $this->projects_model->view_projects_details_id($project_id);
				$data['pm_list'] = $this->projects_model->view_assigned_pm_details($project_id);
				$data['tm_list'] = $this->projects_model->view_assigned_tm_details($project_id);
				if($role == 'Admin'){
					$deleted_id = $this->projects_model->delete_project_tm($delete_id);
					redirect(base_url().'add_project/view_assigned_users/'.$project_id.'/');
				}elseif($role == 'Editor'){
					$deleted_id = $this->projects_model->delete_project_tm($delete_id);
					redirect(base_url().'add_project/view_assigned_users/'.$project_id.'/');
				}elseif($role == 'Project Manager'){
					$deleted_id = $this->projects_model->delete_project_tm($delete_id);
					redirect(base_url().'add_project/view_assigned_users/'.$project_id.'/');
				}							
			} else {
				redirect(base_url().'login/');
			}
		}

		public function edit_project_users(){
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$project_id =  $this->uri->segment('3');
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['pm_details'] = $this->projects_model->view_pm_details();
				$data['tm_details'] = $this->projects_model->view_tm_details();
				$data['project_details'] = $this->projects_model->view_projects_details_id($project_id);
				$data['pm_list'] = $this->projects_model->view_assigned_pm_details($project_id);
				$data['tm_list'] = $this->projects_model->view_assigned_tm_details($project_id);
				if($role == 'Admin'){
					$config['upload_path'] = './project_uploads/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['overwrite'] = TRUE;
					$image_name = $_FILES['image1']['name'];
					$img_name = str_replace(' ','_', $image_name);					
					$config['file_name'] = $img_name;
					$this->load->library('upload', $config);
					$pm_lists = $_POST['pm_list'];
					$tm_lists = $_POST['tm_list'];
					if($_POST){
						if (!$this->upload->do_upload('image1')) {
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								'comment' => $_POST['comment'],
								'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->delete_update_project_pm($project_id);
							foreach($pm_lists as $key => $pm_value){
								$pm_details = array(
									'pm_list' => $pm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_pm($pm_details);
							}
							$this->projects_model->delete_update_project_tm($project_id);
							foreach($tm_lists as $key => $tm_value){
								$tm_details = array(
									'tm_list' => $tm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$this->projects_model->update_project_view($project_details, $project_id);		
							redirect(base_url().'add_project/');
						}else{
							$this->projects_model->delete_update_project_pm($project_id);
							foreach($pm_lists as $key => $pm_value){
								$pm_details = array(
									'pm_list' => $pm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_pm($pm_details);
							}
							$this->projects_model->delete_update_project_tm($project_id);
							foreach($tm_lists as $key => $tm_value){
								$tm_details = array(
									'tm_list' => $tm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								'project_logo' => $img_name,
								 'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->update_project_view($project_details, $project_id);
							redirect(base_url().'add_project/');
						}
					}else{
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('User_projects/edit_project_users', $data);
						$this->load->view('footer');
					}
				}elseif($role == 'Editor'){
					$config['upload_path'] = './project_uploads/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['overwrite'] = TRUE;
					$image_name = $_FILES['image1']['name'];
					$img_name = str_replace(' ','_', $image_name);					
					$config['file_name'] = $img_name;
					$this->load->library('upload', $config);
					$pm_lists = $_POST['pm_list'];
					$tm_lists = $_POST['tm_list'];
					if($_POST){
						if (!$this->upload->do_upload('image1')) {
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								 'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->delete_update_project_pm($project_id);
							foreach($pm_lists as $key => $pm_value){
								$pm_details = array(
									'pm_list' => $pm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_pm($pm_details);
							}
							$this->projects_model->delete_update_project_tm($project_id);
							foreach($tm_lists as $key => $tm_value){
									$tm_details = array(
									'tm_list' => $tm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$this->projects_model->update_project_view($project_details, $project_id);		
							redirect(base_url().'add_project/');
						}else{
							$this->projects_model->delete_update_project_pm($project_id);
							foreach($pm_lists as $key => $pm_value){
								$pm_details = array(
									'pm_list' => $pm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_pm($pm_details);
							}
							//echo "munesh u are here"; die();
							$this->projects_model->delete_update_project_tm($project_id);
							foreach($tm_lists as $key => $tm_value){
								$tm_details = array(
									'tm_list' => $tm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								'project_logo' => $img_name,
								 'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->update_project_view($project_details, $project_id);
							redirect(base_url().'add_project/');
						}
					}else{
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('User_projects/edit_project_users', $data);
						$this->load->view('footer');
					}
				}elseif($role == 'Project Manager'){
					$config['upload_path'] = './project_uploads/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['overwrite'] = TRUE;
					$image_name = $_FILES['image1']['name'];
					$img_name = str_replace(' ','_', $image_name);			
					$config['file_name'] = $img_name;
					$this->load->library('upload', $config);
					$pm_lists = $_POST['pm_list'];
					$tm_lists = $_POST['tm_list'];
					if($_POST){
						if (!$this->upload->do_upload('image1')) {
							$project_details = array(
							'project_name' => $_POST['project_name1'],
							'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->delete_update_project_tm($project_id);
							foreach($tm_lists as $key => $tm_value){
								$tm_details = array(
									'tm_list' => $tm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$this->projects_model->update_project_view($project_details, $project_id);		
							redirect(base_url().'add_project/');
						}else{
							$this->projects_model->delete_update_project_tm($project_id);
							foreach($tm_lists as $key => $tm_value){
								$tm_details = array(
									'tm_list' => $tm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								'project_logo' => $img_name, 
								'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->update_project_view($project_details, $project_id);
							redirect(base_url().'add_project/');
						}
					}else{
						$this->load->view('header', $data);
						$this->load->view('pm_sidebar', $data);
						$this->load->view('User_projects/pm_edit_project_users', $data);
						$this->load->view('footer');
					}
				}
			} else {
				redirect(base_url().'login/');
			}
		}

		public function view_tm_assigned_projects(){
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['tm_assigned_details'] = $this->projects_model->view_tm_assigned_details($user_id);
				foreach($data['tm_assigned_details'] as $key => $project_id_value){
					$project_id = $project_id_value['project_id'];
					$admin_editor_assigned_project[] = $this->projects_model->view_projects_details_id($project_id);
				}
				$data['admin_editor_assigned_project_details'] = $admin_editor_assigned_project;
				$this->load->view('header', $data);
				$this->load->view('tm_sidebar', $data);
				$this->load->view('User_projects/tm_view_project', $data);
				$this->load->view('footer');
			} else {
				redirect(base_url().'login/');
			}
		}

		public function pm_checked(){
			$user_id = $this->session->userdata['user_id'];
			$project_id =  $this->uri->segment('3');
			//print_r($project_id); 
			$check_value = $_POST['checked'];
			$this->projects_model->checked_update($user_id,$project_id,$check_value);
		}
		
		public function add_new_project(){
		
		//print_r($_POST)	;die;
		
		$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$role = $this->session->userdata['role'];
				$user_id = $this->session->userdata['user_id'];
				if($role == 'Admin' || $role == 'Project Manager' || $role == 'Editor'){
					
						if(isset($_POST['project_name1'])) {
							$config['upload_path'] = './project_uploads/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['overwrite'] = TRUE;
							$image_name = $_FILES['image1']['name'];
							$img_name = str_replace(' ','_', $image_name);					
							$config['file_name'] = $img_name;
							$this->load->library('upload', $config);
							$pm_lists = $_POST['pm_list'];
							$tm_lists = $_POST['tm_list'];	
							
							$this->upload->do_upload('image1');
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names']?$_POST['undefined_names']:'',
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
								'project_logo' => $img_name, 
								'created_date' => date("Y-m-d H:i:s"), 
								'user_id' => $user_id , 
								
							);
							
							$a=$this->projects_model->add_projects($project_details);
							
							$last_projectid= $this->db->insert_id();
							
							foreach($pm_lists as $key => $pm_value){
								$pm_details = array(
									'pm_list' => $pm_value,
									'user_id' => $user_id,
									'project_id' => $last_projectid
								);
								$this->projects_model->add_project_pm($pm_details);
							}
							
								foreach($tm_lists as $key => $tm_value){
								$tm_details = array(
									'tm_list' => $tm_value,
									'user_id' => $user_id,
									'project_id' => $last_projectid
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							
							redirect(base_url().'add_project/');
							
						}else{
							$data['user_detail'] = $this->dashboard_model->view_details($user_id);
							$data['logo'] = $this->logo_model->view_logo();
							$data['pm_details'] = $this->projects_model->view_pm_details();
							$data['tm_details'] = $this->projects_model->view_tm_details();
							$data['project_details'] = $this->projects_model->view_projects_details_id($project_id);
							$data['pm_list'] = $this->projects_model->view_assigned_pm_details($project_id);
							$data['tm_list'] = $this->projects_model->view_assigned_tm_details($project_id);
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('User_projects/add_new_project', $data);
							$this->load->view('footer');
						}
					
				}
			}else{
			redirect(base_url().'login/');	
			}
			
		}

		public function add_project123(){
			$data['project_id'] = $this->uri->segment(3);
			//$data['project_details'] = $this->projects_model->view_projects_details();
			/*$this->load->view('header', $data);
			$this->load->view('admin_sidebar', $data);
			$this->load->view('User_projects/user123', $data);
			$this->load->view('footer');*/
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$project_id =  $this->uri->segment('3');
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['pm_details'] = $this->projects_model->view_pm_details();
				$data['tm_details'] = $this->projects_model->view_tm_details();
				$data['project_details'] = $this->projects_model->view_projects_details_id($project_id);
				$data['pm_list'] = $this->projects_model->view_assigned_pm_details($project_id);
				$data['tm_list'] = $this->projects_model->view_assigned_tm_details($project_id);
				
				
				if($role == 'Admin' || $role == 'Project Manager' || $role == 'Editor'){
					$config['upload_path'] = './project_uploads/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['overwrite'] = TRUE;
					$image_name = $_FILES['image1']['name'];
					$img_name = str_replace(' ','_', $image_name);					
					$config['file_name'] = $img_name;
					$this->load->library('upload', $config);
					$pm_lists = $_POST['pm_list'];
					$tm_lists = $_POST['tm_list'];
					if($_POST){
						if (!$this->upload->do_upload('image1')) {
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								'comment' => $_POST['comment'],
								'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
								
							);
							$this->projects_model->delete_update_project_pm($project_id);
							foreach($pm_lists as $key => $pm_value){
								$pm_details = array(
									'pm_list' => $pm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_pm($pm_details);
							}
							$this->projects_model->delete_update_project_tm($project_id);
							foreach($tm_lists as $key => $tm_value){
								$tm_details = array(
									'tm_list' => $tm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$this->projects_model->update_project_view($project_details, $project_id);		
							redirect(base_url().'add_project/');
						}else{
							$this->projects_model->delete_update_project_pm($project_id);
							foreach($pm_lists as $key => $pm_value){
								$pm_details = array(
									'pm_list' => $pm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_pm($pm_details);
							}
							$this->projects_model->delete_update_project_tm($project_id);
							foreach($tm_lists as $key => $tm_value){
								$tm_details = array(
									'tm_list' => $tm_value,
									'user_id' => $user_id,
									'project_id' => $project_id
								);
								$this->projects_model->add_project_tm($tm_details);
							}
							$project_details = array(
								'project_name' => $_POST['project_name1'],
								'project_logo' => $img_name, 
								'client_emails'=>$_POST['client_email'],
								'undefined_names'=>$_POST['undefined_names'],
								'daterange'=>$_POST['daterange'],
								'start_date'=>$_POST['start_date'],
								'end_date'=>$_POST['end_date'],
								'status'=>$_POST['project_status'],
							);
							$this->projects_model->update_project_view($project_details, $project_id);
							$this->session->set_flashdata('message', 'Project added successfully');
							redirect(base_url().'add_project/');
						}
					}else{
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('User_projects/user123', $data);
						$this->load->view('footer');
					}
				}
			} else {
				redirect(base_url().'login/');
			}
		}
		
		public function get_project_users(){
		$pid=$_POST['pid'];	
		if($pid>0){
		$sql="SELECT * FROM pm_project p INNER JOIN login l on l.user_id=p.pm_list WHERE project_id='".$pid."' UNION SELECT * FROM tm_project  p INNER JOIN login l on l.user_id=p.tm_list WHERE project_id='".$pid."'"	;
		}else{
		$sql="SELECT DISTINCT(p.pm_list),l.user_id,l.name FROM pm_project p INNER JOIN login l on l.user_id=p.pm_list UNION SELECT DISTINCT(p.tm_list),l.user_id,l.name FROM tm_project  p INNER JOIN login l on l.user_id=p.tm_list "	;	
		}
		$query =$this->db->query($sql);
		
	
			//echo $this->db->last_query();
		echo "<option value=''>Select User</option>";	
		foreach($query->result_array() as $result){
		echo "<option value='".$result['user_id']."'>".$result['name']."</option>";	
		}
		
		
		
		}
		
		public function delete_activity(){
		$did =  $_POST['did'];
		if($did!='' && $did>0){
		$sql="UPDATE activity SET template_document='' WHERE activity_id='".$did."'";
		$this->db->query($sql);
		}
			
		}
		
		
	}
?>