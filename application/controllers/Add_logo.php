<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Add_logo extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
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
			$loggedin = $this->logged_in();
			if($loggedin == TRUE) {
				$user_id = $this->session->userdata['user_id'];
				$role = $this->session->userdata['role'];
				$data['user_detail'] = $this->dashboard_model->view_details($user_id);
				if($role == 'Admin'){
					if($_POST || $_FILES){
						//print_R($_FILES); die();
						$config['upload_path'] = './logo/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$image_name = $_FILES['image']['name'];
						$img_name = str_replace(' ','_', $image_name);					
						$config['file_name'] = $img_name;
						$this->load->library('upload', $config);
						$data['logo'] = $this->logo_model->view_logo();
						if (!$this->upload->do_upload('image')) {
							$data['message']= '<div class="alert alert-danger">Your Logo has not upload yet!</div>';		
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('Logo/add_logo', $data);
							$this->load->view('footer');
						}else{
							$details = array(
								'image_name' => $img_name
							);
							$this->logo_model->add_logo($details);
							$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
							redirect(base_url().'add_logo/index/');
						}
					}else{
						$data['logo'] = $this->logo_model->view_logo();
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('Logo/add_logo');
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
							$data['message']= '<div class="alert alert-danger">Your details has not upload yet!</div>';		
							$this->load->view('header', $data);
							$this->load->view('sidebar', $data);
							$this->load->view('Logo/add_logo', $data);
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
							$get_user_id = $this->logo_model->view_exist_details($exist_user_id);
							if($get_user_id['user_id'] == $_POST['user_id']){
								$data['message'] = '<div class="alert alert-info">This User ID already exist. Please try different User ID.</div>';
							}else{
								$this->logo_model->add_details($details);
								$data['message'] = '<div class="alert alert-success">Your details has been inserted successfully.</div>';
							}
							$this->load->view('header', $data);
							$this->load->view('admin_sidebar', $data);
							$this->load->view('Logo/add_logo', $data);
							$this->load->view('footer');
						}
					}else{
						$this->load->view('header', $data);
						$this->load->view('admin_sidebar', $data);
						$this->load->view('Logo/add_logo');
						$this->load->view('footer');
					}
				}
			} else {
				redirect(base_url().'login/');
			}
		}
	}
?>