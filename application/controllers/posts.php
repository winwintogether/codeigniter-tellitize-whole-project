<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {
    
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
            session_start();
	 }
         
         public function index()
         {
            $this->data['title'] = 'User Posts';
            $this->templatelayout->get_header();
            $this->templatelayout->get_footer();
            $this->elements['middle']='userposts';
            $this->elements_data['middle'] = $this->data;
            $this->layout->setLayout('front_layout');
            $this->layout->multiple_view($this->elements,$this->elements_data);
            //$this->load->view('userposts');
         }
	
}
?>