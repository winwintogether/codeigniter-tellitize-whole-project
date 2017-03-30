<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewprofile extends CI_Controller {
    
        function __construct()
	{ 
            session_start();
            parent::__construct();
            $this->load->model('myprofile_model','',TRUE); 
	    $this->load->library('session');
            $this->load->helper(array('form', 'url'));	
            $this->load->library('form_validation');
            $this->load->library('layout');
            $this->load->library('templatelayout');
            $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
	}
        
        public function index()
        {
            if(!isset($_SESSION['userid']))
            {
		redirect('home', 'refresh');
            }
            else
	  	 if(isset($_GET['profileid'])) $this->seoUrlIndex($_GET['profileid']);
	}
	  
	 public function seoUrlIndex($id)
	 {
             if(isset($_SESSION['userid']))
             {
                 $query = $this->myprofile_model->get($id);
		 $this->data['profileid']=$id;
		 $this->data['username'] = $query['user_name'];
		 $this->data['email'] = $query['email'];
		 if($query['last_name']!='')
                    $this->data['name'] = $query['name'].' '.$query['last_name'] ;
		 else
                    $this->data['name'] = $query['name'];
                 
                 $this->data['name_link'] = str_replace(" ","-",$this->data['name']);
                 $this->data['location'] = stripslashes($query['location']);
                 $this->data['password'] = $query['password'];
                 $this->data['about_me'] = stripslashes($query['about_me']);
                 $this->data['age'] = stripslashes($query['age']);
                 $this->data['search_tags'] = stripslashes($query['search_tags']);
                 $this->data['city'] = stripslashes($query['city']);
                 $this->data['state'] = stripslashes($query['state']);
                 $this->data['zipcode'] = stripslashes($query['zipcode']);
                 $this->data['nickname'] = stripslashes($query['nickname']);
                 $this->data['tattoos'] = stripslashes($query['tattoos']);
                 $this->data['scars'] = stripslashes($query['scars']);
                 $this->data['highschool'] = stripslashes($query['highschool']);
                 $this->data['college'] = stripslashes($query['college']);
                 $this->data['relationshp_status'] = stripslashes($query['relationshp_status']);
                 $this->data['reg_status'] = stripslashes($query['reg_status']);
		 
                 if($this->data['reg_status']!=0)
                    $this->data['username']=stripslashes($query['name']);
                    $this->data['profile_img'] = stripslashes($query['profile_img']);
                 
                 $this->data['title'] = 'View Profile';
                 $this->templatelayout->get_header();
                 $this->templatelayout->get_footer();
                 $this->elements['middle']='view_profile';
                 $this->elements_data['middle'] = $this->data;
                 $this->layout->setLayout('front_layout');
                 $this->layout->multiple_view($this->elements,$this->elements_data);
            
                 //$this->load->view('view_profile',$data);
            }
            else
            {
                redirect('home', 'refresh');
            }
		
	}
	
}

?>