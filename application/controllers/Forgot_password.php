<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Forgot_password extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model('logo_model');
			$this->load->model('dashboard_model');
			error_reporting(0);
		}
		
	
		public function index(){
			//echo "hiiiiiiii";die;
			$this->load->view('Forgot_password/forgot_password');	
		}
		
		public function check(){
		$email=$this->input->post('username');
		$sql="SELECT * FROM login WHERE user_id='".$email."'";
		$res=$this->db->query($sql);
		$result=$res->result_array();
		$total_count=count($res->result_array());
		if($total_count==0){
			$this->session->set_flashdata('message', 'Sorry no records found');	
			redirect(base_url().'Forgot_password');
		}else{
				$emailConfig = array(
					'protocol'  => 'smtp',
					'smtp_host' => '10.36.0.12',
					'smtp_port' => '25',
					'_smtp_auth'=>false,
					'mailtype'  => 'html',
					'starttls'  => true,
					'newline'   => "\r\n"
				  );		
				$this->load->library('email',$emailConfig);
$email_setting  = array('mailtype'=>'html');
$this->email->initialize($email_setting);

              	$this->load->library('parser');
				$this->email->clear();
				
				$this->email->set_newline("\r\n");
				$this->email->from('plot@angul.jspl.com'); // change it to yours
				
				//print_r($result);
				//echo $result[0]['user_id'];
				$key=$this->dashboard_model->generate_key();
				
				$sql="UPDATE login SET `key`='".$key."' where user_id='".$email."'";
				$this->db->query($sql);
				
				$msg="Hi there,<br>\r\n\r\nYou have requested to reset your password\r\n\r\n<br>";
				$msg.="Please click on link below to reset tour password\r\n\r\n<br>";
				$msg.=base_url().'Forgot_password/reset_password/?key='.$key.'&userid='.$result[0]['id'];
				$this->email->to($result[0]['user_id']);
						
				$this->email->subject('Your Pasword reset link');
				$this->email->message($msg);
				$this->email->send();
					
				$this->session->set_flashdata('message', 'A link to reset your password has been sent to your email.');	
				redirect(base_url().'Forgot_password');
				
		
		}
			
		}
		
		public function reset_password(){
		if(isset($_POST['pwd'])) {
		
		//$current_pwd=$this->input->post('current_pwd');
		$pwd=$this->input->post('pwd');
		$confirm_pwd=$this->input->post('confirm_pwd');
		$key=$this->input->post('key');
		$user_current=$this->input->post('user_current');
		
		//print_r($_POST);die;	
		
		if($pwd!=$confirm_pwd){
			$this->session->set_flashdata('message', 'New Password and Confirm Password does not match.');	
			redirect(base_url().'Forgot_password/reset_password?key='.$key.'&userid='.$user_current);	
		}else{
			$sql="SELECT * FROM login WHERE id='".$user_current."'";
			$res=$this->db->query($sql);
			$result=$res->result_array();
			//print_r($result);die;
			if($result[0]['key']==$key){
				$sql="UPDATE login SET `key`='',password='".$pwd."' where id='".$user_current."'";
				$this->db->query($sql);	
				$this->session->set_flashdata('message', 'Password reset successfull.');	
				redirect(base_url().'login');		
			}else{
				$this->session->set_flashdata('message', 'Invalid key or user.');	
				redirect(base_url().'Forgot_password/reset_password?key='.$key.'&userid='.$user_current);		
			}
		}
		
		
		$this->load->view('Forgot_password/reset_password');	
		}else{
			
			
		$this->load->view('Forgot_password/reset_password');
		
		}
		
		}
		
		
		
			
			
	}
?>