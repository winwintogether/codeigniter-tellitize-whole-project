<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myprofile extends CI_Controller {
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('myprofile_model','',TRUE); 
	 }
	 public function index()
	{
		session_start();
		$this->load->helper('form');		
		$this->load->library('form_validation');
		if(isset($_SESSION['userid']))
		{
			$query = $this->myprofile_model->get($_SESSION['userid']);
			$data['username'] = stripslashes($query['user_name']);
			$data['usernamefb']=$query['user_name'];
			$data['email'] = $query['email'];
			$data['first_name'] =stripslashes($query['name']);
			//$name=explode(' ',$name);
			//$data['first_name'] =$name[0];
			//if(count($name)>1)
			$data['last_name'] =stripslashes($query['last_name']);
			//else $data['last_name'] ='';
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
			$data['username']='';
			$data['profile_img'] = $query['profile_img'];
			$data['my_tags'] = '';
			$data['my_tags'] =$this->myprofile_model->getTagSuggetion();
			$data['search_tag_list'] =$this->myprofile_model->getTaglist();
			$this->load->view('myprofile',$data);
		}
		else{
		}
		
	}
	
}

?>