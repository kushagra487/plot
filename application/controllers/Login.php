<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Login extends CI_Controller {
		
		public function __construct() {
			
			parent::__construct();
			$this->load->model('login_model');
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
				redirect(base_url().'dashboard/');
			} else {
				if($_POST) {
					$file=array(
						'user_id' => $_POST['username'],
						'password' => $_POST['password'],
					);
					$result = $this->login_model->get_details($file);
					$uid = $result->id;
					$user_name = $result->user_id;
					$password = $result->password;
					$role = $result->role;
					$name = $result->name;
					if($user_name == $_POST['username'] && $password == $_POST['password']){
						$this->session->set_userdata('login_flag', TRUE);
						$this->session->set_userdata('uid', $uid);
						$this->session->set_userdata('user_id', $user_name);
						$this->session->set_userdata('role', $role);
						$this->session->set_userdata('name', $name);
						$loggedin = $this->session->userdata('login_flag');
						if($loggedin == true){
							redirect(base_url().'dashboard/');
						}else{
							redirect(base_url().'login/');
						}
					} else {
					  $this->session->set_flashdata('message', 'invalid credentials');
					}
				}
				$this->load->view('Login/login');	
			}
		}
		
		public function logout() {
			
			// Destroy all session data
			$this->session->sess_destroy();
			redirect(base_url().'login/');
		}
	}
?>