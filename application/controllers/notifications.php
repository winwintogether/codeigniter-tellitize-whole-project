<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
	$this->load->model('home_model','',TRUE); 
	$this->load->model('myprofile_model','',TRUE); 
	$this->load->model('notification_model','',TRUE); 
	$this->load->library('session');
        $this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
        $this->load->library('layout');
        $this->load->library('templatelayout');
        session_start();
        
        $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
    }
    
    public function index()
    {
        if(isset($_SESSION['userid']))
        {
            $this->data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
            $this->data['category_list'] = $this->home_model->getCategoryList();	
            $this->data['place_list'] = $this->home_model->getPlaceList();
            $update= $this->notification_model->update();
            
            $this->data['title'] = 'Notifications';
            $this->templatelayout->get_header();
            $this->templatelayout->get_footer();
            $this->elements['middle']='notifications';
            $this->elements_data['middle'] = $this->data;
            $this->layout->setLayout('front_layout');
            $this->layout->multiple_view($this->elements,$this->elements_data);
            
            //$this->load->view('notifications',$data);
	}
	else
        {
            redirect('home', 'refresh');
	}
     }
	
}
?>