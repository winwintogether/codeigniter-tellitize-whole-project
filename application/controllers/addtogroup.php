<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addtogroup extends CI_Controller {
        
        function __construct()
	{
            parent::__construct();
            $this->load->model('home_model','',TRUE); 
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
            {
                if(isset($_GET['profileid'])) $this->seoUrlIndex($_GET['profileid']);
		else
                {
                    $this->data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
                    $this->data['group'] = $this->myprofile_model->getgroup($_SESSION['userid']);
                    $this->data['category_list'] = $this->home_model->getCategoryList();	

                    $this->data['place_list'] = $this->home_model->getPlaceList();
                    $this->data['email']='';
                    $this->data['name']='';
                    
                    $this->data['title'] = 'Add People';
                    $this->templatelayout->get_header();
                    $this->templatelayout->get_footer();
                    $this->elements['middle']='addtogroup_view';
                    $this->elements_data['middle'] = $this->data;
                    $this->layout->setLayout('front_layout');
                    $this->layout->multiple_view($this->elements,$this->elements_data);
                
                    //$this->load->view('addtogroup_view',$this->data);
		}
            } 
	}
	  
        public function seoUrlIndex($id)
	{
            if(isset($_SESSION['userid']))
            {
                $this->data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
		$this->data['group'] = $this->myprofile_model->getgroup($_SESSION['userid']);
		$this->data['category_list'] = $this->home_model->getCategoryList();	
		$this->data['place_list'] = $this->home_model->getPlaceList();
                
		if(isset($id))
                {
                    $profileid=$id;
                    //$this->data['profileid']=$this->home_model->getEmail($profileid);
                    $this->data['email']=$this->home_model->getEmail($profileid);
                    $this->data['name']=$this->home_model->getFullName($profileid);
		}	 
		else
                {
                    $this->data['email']='';
                    $this->data['name']='';
		}
                
                $this->data['title'] = 'Add People';
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='addtogroup_view';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
                    
		//$this->load->view('addtogroup_view',$this->data);
            }
            else
            {
                redirect('home', 'refresh');
            }	
					
	}
	
}
?>