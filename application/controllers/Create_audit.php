<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Create_audit extends CI_Controller {

	public function __construct() {
        parent::__construct(); 
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

	public function index(){
		
				 
        $loggedin = $this->logged_in();
        if($loggedin == TRUE) { 
            
            $data['logo'] = $this->logo_model->view_logo();    
             
            $this->load->view('header', $data);
            $this->load->view('admin_sidebar', $data);
            $this->load->view('create_audit', $data);
            $this->load->view('footer',$data);
           
        } else {
            redirect(base_url().'login/');
        }
    }
 
		
}
?>