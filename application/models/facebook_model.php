<?php
/*
 * Facebook model
 * @package	 onehome
 * @category	 Model
 * @author	 prabin
 * @usage        facebook related api call
 * @actors       Admin,users
 * Created Date  26-03-2012
 * Last updated  27-03-2012(prabin)
 */
class Facebook_model extends CI_Model {
       		private $_api_url;
		private $_api_key;
		private $_api_secret;
		private $_default_scope;
		private $_user;
    
	public function __construct()
	{
		parent::__construct();
		//load the config file to set the(FB app key,Secret key,scope)
		$this->load->config('facebook');
                $this->_api_url 	= $this->config->item('facebook_api_url');
		$this->_api_key 	= $this->config->item('facebook_app_id');
		$this->_api_secret 	= $this->config->item('facebook_api_secret');
		$this->_default_scope	= $this->config->item('facebook_default_scope');
		$this->_app_album_name	= $this->config->item('app_album_name');
                $config = array(
					'appId'  => $this->_api_key,
					'secret' => 	$this->_api_secret,
					'cookie' => 'true',
					'fileUpload' => true, // Indicates if the CURL based @ syntax for file uploads is enabled.
						);
		$this->load->library('facebook', $config);//load facebook library for facebook sdk
	}

function get_user(){//return the facebook user id

		
	return $this->_user=$this->facebook->getUser();
}
function get_app_id(){//return the facebook app id
	return $this->_api_key;
}
function get_profile(){
	$profile = $this->facebook->api('/me');
	return $profile;
}

function get_login_url(){//return the facebook login url. like to change the scope of loginUrl(config/facebook.php)
	return  $this->facebook->getLoginUrl(
            array(
                'scope'         => $this->_default_scope
		
		
            )
    );
}

function get_logout_url(){//return the facebook logoutUrl

	return  $this->facebook->getLogoutUrl();
}
function get_app_album_name(){
	return $this->_app_album_name;

}
function set_session_data(){//set session variable return true if set else false
	try {
		$user=$this->get_user();
		$fqlResult   =   $this->facebook->api('/'.$user);
		//print_r($fqlResult);
		$fb_data = array(
							'uid' => $fqlResult['id'],
						'full_name' => $fqlResult['name'],
						'email' =>$fqlResult['email'],
						'is_logged_in' =>'1'
				);		
		//session create
		$this->session->set_userdata($fb_data);
		
		
		return true;
			
			} catch (FacebookApiException $e) {
				error_log($e);

			    $user = null;
				return false;
			}
	}

function check_is_app_user(){//return 1 if the user is using the current application
	try{
	$user=$this->get_user();
        $fql    =   "select is_app_user from user where uid=" . $user;
            $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
	
            $fqlResult   =   $this->facebook->api($param);
	
	if($fqlResult)
		return $fqlResult['0']['is_app_user'];
        }
	 catch(Exception $o){
            d($o);
        }

}



function upload_photo($file,$desc='onehome photo'){
		 $this->facebook->setFileUploadSupport(true);

//Create an album
$album_details = array(
        'message'=> 'Album desc',
        'name'=> 'Album name'
);
//$create_album = $this->facebook->api('/me/albums', 'post', $album_details);
 

//Get album ID of the album you've just created
//$album_uid = $create_album['id'];
  
//Upload a photo to album of ID...
$photo_details = array(
    'message'=> $desc
);
//$file='prabin.jpeg'; //Example image file
 $photo_details['image'] = '@' .$file;
$upload_photo = $this->facebook->api('/me/photos', 'post', $photo_details);

return $upload_photo;


}

function friends_list(){

$user_facebook_id=$this->get_user();
$users_json= $this->facebook->api("/$user_facebook_id/friends");
return $users_json;
}

function post_wall(){

$result = $this->facebook->api(
    '/me/feed/',
    'post',
    array('message' => 'hai all friends')
);
return $result;

}

function invite_friends(){

$result = $this->facebook->api(
    '/me/feed/',
    'post',
    array('message' => 'hai all friends')
);
return $result;

}

function get_album_id_by_album_name($album_name='Crashcoder.com Photos'){//return array of data


        $fql            =   'SELECT aid, owner, name, object_id FROM album WHERE owner=me() and name="'.$album_name.'"';
			 
                $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResult   =   $this->facebook->api($param);
	return $fqlResult;

}
function get_photos_by_album_id($album_id){

if($album_id)
        $fql            =   'SELECT pid,src_big,owner,link,position,created,caption,src FROM photo WHERE aid="'.$album_id.'"';
			 
                $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResult   =   $this->facebook->api($param);
		return $fqlResult;

}
function friends_autocomplete_data(){
			
	
        $fql    =   "SELECT uid, name, pic_square 
FROM user  
WHERE is_app_user=1 AND uid IN (SELECT uid2 FROM friend WHERE uid1 =".$this->get_user().")";
	
                $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResult   =   $this->facebook->api($param);
	
		return $fqlResult;

	}

function get_facebook_user_details($user_facebook_id){
	 $fql    =   "SELECT name,pic_square,hometown_location,current_location,uid 
FROM user  
WHERE is_app_user=1 AND uid  =".$user_facebook_id;

                $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResult   =   $this->facebook->api($param);
		return $fqlResult[0];

}





}
