<?php  session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
    
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
             if(isset($_GET['cid'])) $this->seoUrlIndex($_GET['cid']);
	 
	 }
	 
         public function seoUrlIndex($id)
         {
             
             $category_name = $this->home_model->getCategoryName($id);
             
             if(!isset($_GET['cid'])){$this->data['category_id']=$id;}
             else $data['category_id']=$_GET['cid'];
		if(isset($_SESSION['userid']))
                {
                    $this->data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
                    $this->data['place_list'] = $this->home_model->getPlaceList();
		}
			
		$this->data['category_list'] = $this->home_model->getCategoryList();	
		
                $this->data['title'] = $category_name;
                $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='category_posts';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
            
		//$this->load->view('category_posts',$data);
          }
	
	
}
?>