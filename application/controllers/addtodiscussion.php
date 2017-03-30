<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addtodiscussion extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
	$this->load->model('home_model','',TRUE); 
	$this->load->model('myprofile_model','',TRUE); 
	$this->load->library('session');
        $this->load->library('layout');
        $this->load->library('templatelayout');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
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
                $this->data['group_list']    = $this->myprofile_model->getgroupList($_SESSION['userid']);
                $this->data['place']         = $this->home_model->getAllPlace();
                $this->data['category_list'] = $this->home_model->getCategoryList();	
                $this->data['place_list']    = $this->home_model->getPlaceList();
                $this->data['email']         = '';
                $this->data['name']          = '';
                
                $this->data['title'] = 'Add People';
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='addtodiscussion_view';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
                
                //$this->load->view('addtodiscussion_view',$data);
            }
         }
      }
	  
        public function seoUrlIndex($id)
	{
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            
            if(isset($_SESSION['userid']))
            {
                $this->data['group_list']     = $this->myprofile_model->getgroupList($_SESSION['userid']);
		$this->data['place']          = $this->home_model->getAllPlace();
		$this->data['category_list']  = $this->home_model->getCategoryList();	
		$this->data['place_list']     = $this->home_model->getPlaceList();
		if(isset($id))
                {
                    $profileid=$id;
                    $this->data['email']  = $this->home_model->getEmail($profileid);
                    $this->data['name']   = $this->home_model->getFullName($profileid);
		}	 
		else 
                {
                    $this->data['email']  = '';
                    $this->data['name']   = '';
		}
		$this->data['title'] = 'Add To Discussion';
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='addtodiscussion_view';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
                
                //$this->load->view('addtodiscussion_view',$data);
            }
            else
            {
                redirect('home', 'refresh');
            }	
	}
	
}
?>