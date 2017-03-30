<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
    
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
            session_start();
	}
        
	public function index()
	{
            if(isset($_SESSION['userid']))
            {
                if(isset($_GET['replyid']))
                {
                    $this->data['to_name']=$this->home_model->getUsername($_GET['replyid']);
		}
		else 
                    $this->data['to_name']='';
		
                $this->data['group_list']     = $this->myprofile_model->getgroupList($_SESSION['userid']);
		$this->data['category_list']  = $this->home_model->getCategoryList();	
		$this->data['place_list']     = $this->home_model->getPlaceList();
                
                $this->data['title'] = 'Message';
                $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='message_view';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
    
            }
            else
            {
                redirect('home', 'refresh');
            }	
	}
}
?>