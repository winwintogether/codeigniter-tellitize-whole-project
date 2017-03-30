<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myposts extends CI_Controller {
    
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
            if(isset($_SESSION['userid']))
            {
                $this->data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
		$this->datadata['category_list'] = $this->home_model->getCategoryList();	
		$this->datadata['place_list'] = $this->home_model->getPlaceList();
                
                $this->data['title'] = 'My Post';
                $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='myposts';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
                //$this->load->view('myposts',$data);
            }
            else
            {
                redirect('home', 'refresh');
            }
        }
}
?>