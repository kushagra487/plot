<?php defined('BASEPATH') OR exit('No direct script access allowed');



	class Manage_users extends CI_Controller {

		

		public function __construct() {

			parent::__construct();

			$this->load->model('users_model');

			$this->load->model('logo_model');

			$this->load->model('dashboard_model');

			error_reporting(0);

		}

		

		public function logged_in() {

			$loggedin = $this->session->userdata('login_flag');

			$uid = $this->session->userdata['uid'];

			$user_id = $this->session->userdata['user_id'];

			$role = $this->session->userdata['role'];

			if($loggedin == true){

				return TRUE;

			}else{

				return FALSE;

			}

		}

		

		



		

		public function edit_users($id){

			error_reporting(0);

			$loggedin = $this->logged_in();

			if($loggedin == TRUE) {

				$user_id = $this->session->userdata['user_id'];

				$uid = $this->session->userdata['uid'];

				$role = $this->session->userdata['role'];

				$data['user_detail'] = $this->dashboard_model->view_details($user_id);

				$data['logo'] = $this->logo_model->view_logo();

			

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

							$data['user_detail'] = $this->users_model->get_id_details($uid);

							$this->load->view('header', $data);

							$this->load->view('admin_sidebar', $data);

							$this->load->view('manage_users/edit_users', $data);

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

							$data['user_detail'] = $this->users_model->get_id_details($uid);

							$data['details'] = $this->users_model->edit_user_details($uid, $details);

							

						$this->session->set_flashdata('update_msg', '<div class="alert alert-success">Your details has been updated successfully.</div>');

							redirect(base_url().'manage_users/edit_users/');

						}

					}elseif($_POST){

						$details = array(

							'user_id' => $_POST['user_id'],

							'name' => $_POST['name'],

							'designation' => $_POST['designation'],

							'password' => $_POST['password'],

							'role' => $_POST['user_role']

						);

						$data['user_detail'] = $this->users_model->get_id_details($uid);

						$data['details'] = $this->users_model->edit_user_details($uid, $details);

						

						$this->session->set_flashdata('update_msg', '<div class="alert alert-success">Your details has been updated successfully.</div>');

						redirect(base_url().'manage_users/edit_users/');

					}else{

						$data['user_detail'] = $this->users_model->get_id_details($uid);

						$this->load->view('header', $data);

						$this->load->view('admin_sidebar', $data);

						$this->load->view('manage_users/edit_users', $data);

						$this->load->view('footer');

					}

				

			} else {

				redirect(base_url().'login/');

			}

		}

		

	}

?>