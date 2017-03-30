<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewprofile extends CI_Controller {
	function __construct()
	 { session_start();
	   parent::__construct();
	   $this->load->model('myprofile_model','',TRUE); 
	    $this->load->library('session');
	 }
	  public function index(){
	    
	  	 if(!isset($_SESSION['userid'])){
			 $this->load->helper(array('form', 'url'));
		     $this->load->library('form_validation');
		 	 redirect('home', 'refresh');
		 }
		 else
	  	 if(isset($_GET['profileid'])) $this->seoUrlIndex($_GET['profileid']);
		 
	  }
	  
	 public function seoUrlIndex($id)
	 {
		
		 $this->load->helper(array('form', 'url'));	
		$this->load->library('form_validation');
		if(isset($_SESSION['userid']))
		{
			$query = $this->myprofile_model->get($id);
			$data['profileid']=$id;
			$data['username'] = $query['user_name'];
			$data['email'] = $query['email'];
			if($query['last_name']!='')
				$data['name'] = $query['name'].' '.$query['last_name'] ;
			else
				$data['name'] = $query['name'];
			$data['name_link'] = str_replace(" ","-",$data['name']);
			$data['location'] = $query['location'];
			$data['password'] = $query['password'];
			$data['about_me'] = $query['about_me'];
			$data['age'] = $query['age'];
			$data['search_tags'] = $query['search_tags'];
			$data['city'] = $query['city'];
			$data['state'] = $query['state'];
			$data['zipcode'] = $query['zipcode'];
			$data['nickname'] = $query['nickname'];
			$data['tattoos'] = $query['tattoos'];
			$data['scars'] = $query['scars'];
			$data['highschool'] = $query['highschool'];
			$data['college'] = $query['college'];
			$data['relationshp_status'] = $query['relationshp_status'];
			$data['reg_status'] = $query['reg_status'];
			if($data['reg_status']!=0)
			$data['username']=$query['name'];
			$data['profile_img'] = $query['profile_img'];
			$this->load->view('view_profile',$data);
		}
		else{
			 redirect('home', 'refresh');
		}
		
	}
	
}

?>