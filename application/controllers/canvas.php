<?php
class Canvas extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('facebook_model');
	}
	
	function index()
	{	
		
		if($this->input->get('code')==''){//check wheather url from login url
			$data['login_url']=$this->facebook_model->get_login_url();
		$this->load->view('canvas_page',$data);		

				}
			else{
			redirect('onehome/index');
			}
		
	}
}
