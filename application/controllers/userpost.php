<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userpost extends CI_Controller {
    
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
	}
	
        public function index()
        {
            if(isset($_GET['postid'])) $this->seoUrlIndex($_GET['postid']);
	}
        
	public function seoUrlIndex($id)
	{                        
            $this->data['postid']=$id;
            if(isset($_SESSION['userid']))	
            {
                $this->data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
		$this->data['place_list'] = $this->home_model->getPlaceList();
            }			
            $this->data['category_list'] = $this->home_model->getCategoryList();
                        
            //$this->data['title']    = 'User Post';
            $this->data['title']    = $this->home_model->getPostTitle($id);
            $this->data['description']  = $this->home_model->getMetaDescriptionComment($id);
            
            $this->templatelayout->get_header();
            $this->templatelayout->get_footer();
            $this->elements['middle']='userpost';
            $this->elements_data['middle'] = $this->data;
            $this->layout->setLayout('front_layout');
            $this->layout->multiple_view($this->elements,$this->elements_data);
                    
            //$this->load->view('userpost',$data);
	}
	
}
?>