<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Add_users extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model('users_model');
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
			error_reporting(0);
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['role'] = $role;
				if($role == 'Admin'){
					if($_POST || $_FILES){
						//print_R($_FILES); die();
						//print_R($_POST);
						$config['upload_path'] = './user_uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image']['name'];
						$img_name = str_replace(' ','_', $image_name);	
						//echo $img_name;die;				
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('image')) {
							$data['message']= '<div class="alert alert-danger">Please upload user image.Your details has not upload yet!</div>';		
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('Users/Admin/add_users', $data);
							$this->load->view('footer');
						}else{
							$details = array(
								'user_id' => $_POST['user_id'],
								'name' => $_POST['name'],
								'designation' => $_POST['designation'],
								'password' => $_POST['password'],
								'role' => $_POST['user_role'],
								'image' => $img_name
							);
							$exist_user_id = $_POST['user_id'];
							$get_user_id = $this->users_model->view_exist_details($exist_user_id);
							if($get_user_id['user_id'] == $_POST['user_id']){
								$data['message'] = '<div class="alert alert-info">This User ID already exist. Please try different User ID.</div>';
							}else{
								$this->users_model->add_details($details);
								$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
								redirect(base_url().'add_users/view_users/');
							}
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('Users/Admin/add_users', $data);
							$this->load->view('footer');
						}
					}else{
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('Users/Admin/add_users');
						$this->load->view('footer');
					}
				}elseif($role == 'Editor'){
					if($_POST || $_FILES){
						//print_R($_FILES);
						$config['upload_path'] = './user_uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image']['name'];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('image')) {
							$data['message']= '<div class="alert alert-danger">Please upload user image.Your details has not upload yet!</div>';		
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('Users/add_users', $data);
							$this->load->view('footer');
						}else{
							$details = array(
								'user_id' => $_POST['user_id'],
								'name' => $_POST['name'],
								'designation' => $_POST['designation'],
								'password' => $_POST['password'],
								'role' => $_POST['user_role'],
								'image' => $img_name
							);
							$exist_user_id = $_POST['user_id'];
							$get_user_id = $this->users_model->view_exist_details($exist_user_id);
							if($get_user_id['user_id'] == $_POST['user_id']){
								$data['message'] = '<div class="alert alert-info">This User ID already exist. Please try different User ID.</div>';
							}else{
								$this->users_model->add_details($details);
								$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
								redirect(base_url().'add_users/view_users/');
							}
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('Users/Editor/add_users', $data);
							$this->load->view('footer');
						}
					}else{
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('Users/Editor/add_users');
						$this->load->view('footer');
					}
				}elseif($role == 'Project Manager'){
					if($_POST || $_FILES){
						//print_R($_FILES);
						$config['upload_path'] = './user_uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image']['name'];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('image')) {
							$data['message']= '<div class="alert alert-danger">Please upload user image.Your details has not upload yet!</div>';		
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('Users/Pm/add_users', $data);
							$this->load->view('footer');
						}else{
							$details = array(
								'user_id' => $_POST['user_id'],
								'name' => $_POST['name'],
								'designation' => $_POST['designation'],
								'password' => $_POST['password'],
								'role' => $_POST['user_role'],
								'image' => $img_name
							);
							$exist_user_id = $_POST['user_id'];
							$get_user_id = $this->users_model->view_exist_details($exist_user_id);
							if($get_user_id['user_id'] == $_POST['user_id']){
								$data['message'] = '<div class="alert alert-info">This User ID already exist. Please try different User ID.</div>';
							}else{
								$this->users_model->add_details($details);
								$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
								redirect(base_url().'add_users/view_users/');
							}
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('Users/Pm/add_users', $data);
							$this->load->view('footer');
						}
					}else{
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('Users/Pm/add_users');
						$this->load->view('footer');
					}
				}
				
			} else {
				redirect(base_url().'login/');
			}
		}
		
		public function view_users(){
			error_reporting(0);
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['role'] = $role;
				if($role == 'Admin'){
					$data['details'] = $this->users_model->view_details($_POST['uname']);
					$this->load->view('header', $data);
					$this->load->view('admin_sidebar', $data);
					$this->load->view('Users/Admin/view_users', $data);
					$this->load->view('footer');
				}elseif($role == 'Editor'){
					$data['details'] = $this->users_model->view_details($_POST['uname']);
					$this->load->view('header', $data);
					$this->load->view('admin_sidebar', $data);
					$this->load->view('Users/Admin/view_users', $data);
					$this->load->view('footer');
				}elseif($role == 'Project Manager'){
					$data['details'] = $this->users_model->view_details($_POST['uname']);
					$this->load->view('header', $data);
					$this->load->view('admin_sidebar', $data);
					$this->load->view('Users/Pm/view_users', $data);
					$this->load->view('footer');
				}
			} else {
				redirect(base_url().'login/');
			}
		}
		
		public function edit_users($id){
			error_reporting(0);
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['role'] = $role;
				if($role == 'Admin'){
					$get_id =  $this->uri->segment('3');
					if($_FILES['image']['name']){
						$config['upload_path'] = './user_uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image']['name'];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('image')) {
							$data['message']= '<div class="alert alert-danger">Your details has not upload yet!</div>';		
							$data['user_detail'] = $this->users_model->get_id_details($get_id);
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('Users/Admin/edit_users', $data);
							$this->load->view('footer');
						}else{
							$details = array(
								'user_id' => $_POST['user_id'],
								'name' => $_POST['name'],
								'designation' => $_POST['designation'],
								'password' => $_POST['password'],
								'role' => $_POST['user_role'],
								'image' => $img_name
							);
							$get_id =  $this->uri->segment('3');
							$data['user_detail'] = $this->users_model->get_id_details($get_id);
							$data['details'] = $this->users_model->edit_user_details($get_id, $details);
							$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
							redirect(base_url().'add_users/edit_users/'.$get_id.'/');
						}
					}elseif($_POST){
						$details = array(
							'user_id' => $_POST['user_id'],
							'name' => $_POST['name'],
							'designation' => $_POST['designation'],
							'password' => $_POST['password'],
							'role' => $_POST['user_role']
						);
						$get_id =  $this->uri->segment('3');
						$data['user_detail'] = $this->users_model->get_id_details($get_id);
						$data['details'] = $this->users_model->edit_user_details($get_id, $details);
						$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
						redirect(base_url().'add_users/edit_users/'.$get_id.'/');
					}else{
						$get_id =  $this->uri->segment('3');
						$data['user_detail'] = $this->users_model->get_id_details($get_id);
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('Users/Admin/edit_users', $data);
						$this->load->view('footer');
					}
				}elseif($role == 'Editor'){
					$get_id =  $this->uri->segment('3');
					if($_FILES['image']['name']){
						$config['upload_path'] = './user_uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image']['name'];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('image')) {
							$data['message']= '<div class="alert alert-danger">Your details has not upload yet!</div>';		
							$data['user_detail'] = $this->users_model->get_id_details($get_id);
							$this->load->view('header', $data);
							$this->load->view('editor_sidebar', $data);
							$this->load->view('Users/Admin/edit_users', $data);
							$this->load->view('footer');
						}else{
							$details = array(
								'user_id' => $_POST['user_id'],
								'name' => $_POST['name'],
								'designation' => $_POST['designation'],
								'password' => $_POST['password'],
								'role' => $_POST['user_role'],
								'image' => $img_name
							);
							$get_id =  $this->uri->segment('3');
							$data['user_detail'] = $this->users_model->get_id_details($get_id);
							$data['details'] = $this->users_model->edit_user_details($get_id, $details);
							$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
							$this->load->view('header', $data);
							$this->load->view('editor_sidebar', $data);
							$this->load->view('Users/Admin/edit_users', $data);
							$this->load->view('footer');
						}
					}elseif($_POST){
						$details = array(
							'user_id' => $_POST['user_id'],
							'name' => $_POST['name'],
							'designation' => $_POST['designation'],
							'password' => $_POST['password'],
							'role' => $_POST['user_role']
						);
						$get_id =  $this->uri->segment('3');
						$data['user_detail'] = $this->users_model->get_id_details($get_id);
						$data['details'] = $this->users_model->edit_user_details($get_id, $details);
						$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
						$this->load->view('header', $data);
						$this->load->view('editor_sidebar', $data);
						$this->load->view('Users/Editor/edit_users', $data);
						$this->load->view('footer');
					}else{
						$get_id =  $this->uri->segment('3');
						$data['user_detail'] = $this->users_model->get_id_details($get_id);
						$this->load->view('header', $data);
						$this->load->view('editor_sidebar', $data);
						$this->load->view('Users/Editor/edit_users', $data);
						$this->load->view('footer');
					}
				}elseif($role == 'Project Manager'){
					$get_id =  $this->uri->segment('3');
					if($_FILES['image']['name']){
						$config['upload_path'] = './user_uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image']['name'];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('image')) {
							$data['message']= '<div class="alert alert-danger">Your details has not upload yet!</div>';		
							$data['user_detail'] = $this->users_model->get_id_details($get_id);
							$this->load->view('header, $data');
							$this->load->view('pm_sidebar', $data);
							$this->load->view('Users/Pm/edit_users', $data);
							$this->load->view('footer');
						}else{
							$details = array(
								'user_id' => $_POST['user_id'],
								'name' => $_POST['name'],
								'designation' => $_POST['designation'],
								'password' => $_POST['password'],
								'role' => $_POST['user_role'],
								'image' => $img_name
							);
							$get_id =  $this->uri->segment('3');
							$data['user_detail'] = $this->users_model->get_id_details($get_id);
							$data['details'] = $this->users_model->edit_user_details($get_id, $details);
							$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
							$this->load->view('header', $data);
							$this->load->view('pm_sidebar', $data);
							$this->load->view('Users/Pm/edit_users', $data);
							$this->load->view('footer');
						}
					}elseif($_POST){
						$details = array(
							'user_id' => $_POST['user_id'],
							'name' => $_POST['name'],
							'designation' => $_POST['designation'],
							'password' => $_POST['password'],
							'role' => $_POST['user_role']
						);
						$get_id =  $this->uri->segment('3');
						$data['user_detail'] = $this->users_model->get_id_details($get_id);
						$data['details'] = $this->users_model->edit_user_details($get_id, $details);
						$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
						
						
						redirect(base_url().'add_users/view_users/');
					}else{
						$get_id =  $this->uri->segment('3');
						$data['user_detail'] = $this->users_model->get_id_details($get_id);
						$this->load->view('header', $data);
						$this->load->view('pm_sidebar', $data);
						$this->load->view('Users/Pm/edit_users', $data);
						$this->load->view('footer');
					}
				}
			} else {
				redirect(base_url().'login/');
			}
		}
		
		public function delete_users(){
			error_reporting(0);
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				$data['logo'] = $this->logo_model->view_logo();
				$data['role'] = $role;
				if($role == 'Admin'){
					$delete_id =  $this->uri->segment('3');
					$deleted_id = $this->users_model->delete_user_id($delete_id);
					$data['details'] = $this->users_model->view_details();
					$this->load->view('header', $data);
					$this->load->view('admin_sidebar', $data);
					$this->load->view('Users/Admin/view_users', $data);
					$this->load->view('footer');
				}elseif($role == 'Editor'){
					$delete_id =  $this->uri->segment('3');
					$deleted_id = $this->users_model->delete_user_id($delete_id);
					$data['details'] = $this->users_model->view_details();
					$this->load->view('header', $data);
					$this->load->view('editor_sidebar', $data);
					$this->load->view('Users/Editor/view_users', $data);
					$this->load->view('footer');
				}elseif($role == 'Project Manager'){
					$delete_id =  $this->uri->segment('3');
					$deleted_id = $this->users_model->delete_user_id($delete_id);
					$data['details'] = $this->users_model->view_details();
					$this->load->view('header', $data);
					$this->load->view('pm_sidebar', $data);
					$this->load->view('Users/Pm/view_users', $data);
					$this->load->view('footer');
				}			
			} else {
				redirect(base_url().'login/');
			}
		}
	}
?>