<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE); 
		$this->load->library('session');
		 $this->load->model('ip2locationlite','',TRUE); 
	 }
	public function index()
	{  
        
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 $IP = $_SERVER['REMOTE_ADDR'];
			/*$SSID = htmlentities (SID);
			// If IP address exists
			// Get country (and City) via  api.hostip.info
			if (!empty ($IP)) {
			if(file_get_contents ('http://api.hostip.info/get_html.php?ip='.$IP))
			$location=file_get_contents ('http://api.hostip.info/get_html.php?ip='.$IP);
			$data['country']= $this->home_model->get_string_between($location,"Country:","City");
			$data['city']=$this->home_model->get_string_between($location,"City:","IP");
			} */
			$location=$this->ip2locationlite->getCity($IP);
			$data['country']=$location['countryName'];
			$data['city']=$location['cityName'].','.$location['regionName'];
			$data['category'] = $this->home_model->getAllCategory();
			$data['category_list'] = $this->home_model->getCategoryList();	
		if(isset($_SESSION['userid'])) {
			$query = $this->myprofile_model->get($_SESSION['userid']);
			$data['profile_img'] = $query['profile_img'];
			$data['reg_status'] = $query['reg_status'];
			if($data['reg_status']!=0){
				 $_SESSION['username']= $query['name'];
			}
			$data['group'] = $this->myprofile_model->getgroup($_SESSION['userid']);
			$data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
			
			//$data['category_list'] = $this->home_model->getCategoryList();	
			$data['place'] = $this->home_model->getAllPlace();
			$data['place_list'] = $this->home_model->getPlaceList();					
						
		}  
		 if(isSet($_COOKIE['cookiename']))
			{
				parse_str($_COOKIE['cookiename']);				
				$data['user']=$usr;
				$data['password']=$hash;
				$this->load->view('home_view',$data);
			}
			else{
				$data['user']='';
				$data['password']='';
				$data['article']=$this->home_model->article();
				$this->load->view('home_view',$data);
			}
		
		
		
	}
	function process(){
      $this->load->helper(array('form', 'url'));	 
	  $this->home_model->register();	                             
   	  redirect('home', 'refresh');
    }
	
	function login(){ 
	
		
		$username = addslashes($this->input->post('login_username'));
		$password= $this->input->post('login_pw');
		$remember= $this->input->post('remember');
		
		if ($remember==1) {
  $password_hash = $password; // will result in a 32 characters hash
$cookie_time = (3600 * 24 * 30);
	setcookie ('cookiename', 'usr='.$username.'&hash='.$password_hash, time() + $cookie_time);



   // $this->input->set_cookie($username,);
}
		$result = $this->home_model->login($username, $password);

		   if($result)
		   { 
			 
			 $sess_array = array();
			 foreach($result as $row)
			 {
			 	 $_SESSION['userid'] = $row->userid;
				 $_SESSION['username'] = $row->user_name;
			     $sess_array = array(
				 'id' => $row->userid,
				 'email' => $row->email,
				 'username' => $row->user_name
			   );
			   $this->session->set_userdata('logged_in', $sess_array);
			 }
			 
		   }  
	   $this->load->helper(array('form', 'url')); 
	  // redirect('userhome', 'refresh');
	  redirect('home', 'refresh');
    }
	function logout() {
	   
	   $this->load->helper(array('form', 'url'));
	   $this->session->unset_userdata('logged_in');
	    unset($_SESSION['id']);
    	unset($_SESSION['username']);
   	    unset($_SESSION['oauth_provider']);
	   session_destroy();
	   if(isSet($_COOKIE['cookiename']))
			{
			// remove 'site_auth' cookie
			$cookie_time = (3600 * 24 * 30);
			setcookie ('cookiename', '', time() - $cookie_time);
			}
	   redirect('home', 'refresh');
    }
	
function aboutus(){
	 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');	
	$this->load->view('about-us');
}
function termsofuse(){
	 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');	
	$this->load->view('terms-of-use');
}	
function contactus(){
	 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');	
	$this->load->view('contact-us');
}

function privacypolicy(){
	 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');	
	$this->load->view('privacy-policy');
}
function faq(){
	 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');	
	$this->load->view('faq_view');
}

}

?>