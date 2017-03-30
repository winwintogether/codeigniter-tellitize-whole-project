<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Placediscussions extends CI_Controller {
    
        function __construct()
	{
            parent::__construct();
            $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE); 
            $this->load->model('place_model','',TRUE); 
            $this->load->library('session');
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->library('layout');
            $this->load->library('templatelayout');
            $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
	}
	 
	public function index()
        {
            if(isset($_GET['placeid'])) $this->seoUrlIndex($_GET['placeid']);
	 
	}
        
	public function seoUrlIndex($id)
	{            
            if(isset($_SESSION['userid']))
            {
                $IP     = $_SERVER['REMOTE_ADDR'];
		$SSID   = htmlentities (SID);
                // If IP address exists
                // Get country (and City) via  api.hostip.info
		if (!empty ($IP)) 
                {
                    if(file_get_contents ('http://api.hostip.info/get_html.php?ip='.$IP))
                        $location=file_get_contents ('http://api.hostip.info/get_html.php?ip='.$IP);
			$this->data['country']= $this->home_model->get_string_between($location,"Country:","City");
			$this->data['city']=$this->home_model->get_string_between($location,"City:","IP");
		} 
		
                $this->data['category'] = $this->home_model->getAllCategory();
		
                if(!isset($_GET['placeid']))
                {
                    $_GET['placeid']=$id;
                }
                if(isset($_GET['placeid']))
		{
                    $this->data['placeid']=$_GET['placeid'];
                    $this->data['placeUsers'] = $this->place_model->getUserList($_GET['placeid']);
                    $this->data['placeUsersList'] = $this->place_model->getAllUserList($_GET['placeid']);
                    $this->data['article']=$this->place_model->article($_GET['placeid']);
		} 
		else
                {
                    $this->data['placeid']=0;
                    $this->data['placeUsers'] ='';
                    $this->data['placeUsersList'] ='';
                    $this->data['article']='';
		}
		
                $place_name = $this->place_model->getPlaceName($_GET['placeid']);
                $this->data['title'] = $place_name;
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='place_discussion_view';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
                //$this->load->view('place_discussion_view',$this->data);
            }
            else
            {
                redirect('home', 'refresh');
            }
					
	}
	
}
?>