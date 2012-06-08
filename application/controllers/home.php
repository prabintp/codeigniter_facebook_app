<?php
class Home extends CI_Controller {

	
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('facebook_model');
		error_reporting(E_ALL);
	}
	
	
	function index(){
			
			$user=($this->session->userdata('uid')) ? $this->session->userdata('uid') : '';
			if($this->input->get('state')==''){//check wheather url from login url
		
				}		
				else{
					$user=$this->facebook_model->get_user();
				
	}	
		
				if($user){
			
			
					$this->facebook_model->set_session_data($user);
					
					//if($this->session->userdata('is_app_user')==0)
						redirect('main/home');
					//else
						//$this->main_page();
				}
				else{	
			
						$data['login_url']=$this->facebook_model->get_login_url();
				
			
						$this->load->view('sign_in',$data);

				}
		
		
	}
	
	
	
}

	
