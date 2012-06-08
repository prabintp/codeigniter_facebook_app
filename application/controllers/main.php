<?php
class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('facebook_model');
		$this->index();
	}
	
	function index()
	{	
		if($this->session->userdata('is_logged_in')=='')
		redirect('home/index');
	}
	function home(){
		$data['app_id']=$this->facebook_model->get_app_id();
		$data['logout_url']=$this->facebook_model->get_logout_url();
		$data['uid']=$this->session->userdata('uid');	
		$data['full_name']=$this->session->userdata('full_name');	
		//$this->session->unset_userdata('is_app_user','');
		$this->load->view('welcome',$data);
	}
	function profile()
	{
	$data['logout_url']=$this->facebook_model->get_logout_url();
		$data['uid']=$this->session->userdata('uid');	
		$data['full_name']=$this->session->userdata('full_name');
	$data['profile']=$this->facebook_model->get_profile();
	$this->load->view('profile_view', $data);
		
	}
	function view_friends(){
		
		$data['logout_url']=$this->facebook_model->get_logout_url();
		$data['uid']=$this->session->userdata('uid');	
		$data['full_name']=$this->session->userdata('full_name');
		$data['friends']=$this->facebook_model->friends_list();
		$this->load->view('friends_view', $data);
	


	}
	function upload_photo()
	{
	$desc=$this->input->post('desc');
	$userfile_name = $_FILES['image']['name'];
	$userfile_tmp = $_FILES['image']['tmp_name'];
	$userfile_size = $_FILES['image']['size'];
	$userfile_type = $_FILES['image']['type'];
	$filename = basename($_FILES['image']['name']);
	$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	$result=$this->facebook_model->upload_photo($userfile_tmp,$desc);
	redirect("main/get_photos");
	

	}
	function get_photos(){
	$app_album_name=$this->facebook_model->get_app_album_name();
	$data['uid']=$this->session->userdata('uid');	
	$data['full_name']=$this->session->userdata('full_name');
	$album_result=$this->facebook_model->get_album_id_by_album_name($app_album_name." Photos");//input param album name 
	if($album_result){
		$album_id=$album_result[0]['aid'];
		$photo_result=$this->facebook_model->get_photos_by_album_id($album_id);//input param album id
		$data['photos_array']=$photo_result;
		}
		else{
	$data['photos_array']=array();
		}

		$this->load->view('photos_view',$data);
	

	}
	function add_friends(){
		$suggested_friends=$this->facebook_model->friends_autocomplete_data();
		
		$data['sugg_friends']=$this->shuffle_assoc_array($suggested_friends);//suggest friends shuffled array
		$data['app_id']=$this->facebook_model->get_app_id();
		//$res=$this->get_application_user_jsonlist();
		//$data['app_user_json']=str_replace('name":','value":',$res);


		$this->load->view('add_friends_view',$data);
	}
	function main_page(){
		$data['logout_url']=$this->facebook_model->get_logout_url();
		$this->load->view('home_view',$data);
	}
	
	
	
	function logout()
	{
		$this->load->model('facebook_model');
		$data['redirect']=$this->facebook_model->get_logout_url();
		$array_items = array('uid' => '','is_logged_in' => '');
		$this->session->unset_userdata($array_items);
		$this->session->sess_destroy();
		$this->load->view('redirect',$data);
        	
   	 }
	
	
	
			
		
}
