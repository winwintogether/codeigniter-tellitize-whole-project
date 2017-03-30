<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discussionplace extends CI_Controller {
    
        function __construct()
	{
            parent::__construct();
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
                if(isset($_GET['place-id']))
                {
                    $selectplace    = $this->db->query("SELECT * FROM place_of_discussion where id='".$_GET['place-id']."'");
                    foreach ($selectplace->result_array() as $row)
                    {
                        $this->data['place']        = $row['place'];
			$this->data['description']  = $row['description'];
                    }							
		}
		else
                {
                    $this->data['place']        = '';
                    $this->data['description']  = '';
		}
                
                $this->data['title'] = 'Place of Discussion';
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='create_discussion';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
		//$this->load->view('create_discussion',$data);
            }
            else
            {
                redirect('home', 'refresh');
            }
	}
}

?>