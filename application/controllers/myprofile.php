<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myprofile extends CI_Controller {

        function __construct()
	{
            parent::__construct();
            $this->load->model('myprofile_model','',TRUE);
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->library('layout');
            $this->load->library('templatelayout');
            session_start();
	}

        public function index()
	{
            if(isset($_SESSION['userid']))
            {
                $query = $this->myprofile_model->get($_SESSION['userid']);
		$this->data['username'] = stripslashes($query['user_name']);
		$this->data['usernamefb']=$query['user_name'];
		$this->data['email'] = $query['email'];
		$this->data['first_name'] =stripslashes($query['name']);
		//$name=explode(' ',$name);
		//$this->data['first_name'] =$name[0];
		//if(count($name)>1)
		$this->data['last_name'] =stripslashes($query['last_name']);
		//else $this->data['last_name'] ='';
		$this->data['location'] = $query['location'];
		$this->data['password'] = $query['password'];
		$this->data['about_me'] = $query['about_me'];
		$this->data['age'] = $query['age'];
		$this->data['search_tags'] = $query['search_tags'];
		$this->data['city'] = $query['city'];
		$this->data['state'] = $query['state'];
		$this->data['zipcode'] = $query['zipcode'];
		$this->data['nickname'] = $query['nickname'];
		$this->data['tattoos'] = $query['tattoos'];
		$this->data['scars'] = $query['scars'];
		$this->data['highschool'] = $query['highschool'];
		$this->data['college'] = $query['college'];
		$this->data['relationshp_status'] = $query['relationshp_status'];
		$this->data['reg_status'] = $query['reg_status'];
		if($this->data['reg_status']!=0)
                    $this->data['username']='';
                    $this->data['profile_img'] = $query['profile_img'];
                    $this->data['my_tags'] = '';
                    $this->data['my_tags'] =$this->myprofile_model->getTagSuggetion();
                    $this->data['search_tag_list'] =$this->myprofile_model->getTaglist();

                $this->data['title'] = 'View Profile';
                $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='myprofile';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
                //$this->load->view('myprofile',$this->data);
            }
            else{
            }
	}

        public function editprofile()
	{


            if(isset($_SESSION['userid']))
            {
                $query = $this->myprofile_model->get($_SESSION['userid']);
		$this->data['username'] = stripslashes($query['user_name']);
		$this->data['usernamefb']=$query['user_name'];
		$this->data['email'] = $query['email'];
		$this->data['first_name'] =stripslashes($query['name']);
		//$name=explode(' ',$name);
		//$this->data['first_name'] =$name[0];
		//if(count($name)>1)
		$this->data['last_name'] =stripslashes($query['last_name']);
		//else $this->data['last_name'] ='';
		$this->data['location'] = $query['location'];
		$this->data['password'] = $query['password'];
		$this->data['about_me'] = $query['about_me'];
		$this->data['age'] = $query['age'];
		$this->data['search_tags'] = $query['search_tags'];
		$this->data['city'] = $query['city'];
		$this->data['state'] = $query['state'];
		$this->data['zipcode'] = $query['zipcode'];
		$this->data['nickname'] = $query['nickname'];
		$this->data['tattoos'] = $query['tattoos'];
		$this->data['scars'] = $query['scars'];
		$this->data['highschool'] = $query['highschool'];
		$this->data['college'] = $query['college'];
		$this->data['relationshp_status'] = $query['relationshp_status'];
		$this->data['reg_status'] = $query['reg_status'];
		if($this->data['reg_status']!=0)
                    $this->data['username']='';
                    $this->data['profile_img'] = $query['profile_img'];
                    $this->data['my_tags'] = '';
                    $this->data['my_tags'] =$this->myprofile_model->getTagSuggetion();
                    $this->data['search_tag_list'] =$this->myprofile_model->getTaglist();

                $this->data['title'] = 'Edit Profile';
                $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='editprofile';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
                //$this->load->view('editprofile',$this->data);
            }
            else{
            }
	}

        public function changepwd()
	{
            if(isset($_SESSION['userid']))
            {
                $query = $this->myprofile_model->get($_SESSION['userid']);
		$this->data['password'] = $query['password'];

                $this->data['title'] = 'Change Password';
                $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='changepwd';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
		//$this->load->view('changepwd',$this->data);
            }

	}

}

?>