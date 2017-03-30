<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        session_start();
	$this->load->model('myprofile_model','',TRUE); 
        $this->load->library('layout');
        $this->load->library('templatelayout');
        $this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
    }
    
    public function index()
    {
        $this->data['errormsg']       = '';
        $this->data['successmsg']     = '';
        $this->data['msg_class']      = '';
        $this->data['display_option'] = 'none';
        
        if(isset($_SESSION['errormsg']) != '')
        {
            $this->data['msg']              = $_SESSION['errormsg'];
            $_SESSION['errormsg']           = '';
            $this->data['msg_class']        = 'errormsg';
            $this->data['display_option']   = 'block';
        }
        else if(isset($_SESSION['successmsg']) != '')
        {
            $this->data['msg']              = $_SESSION['successmsg'];
            $_SESSION['successmsg']         = '';
            $this->data['msg_class']        = 'successmsg';
            $this->data['display_option']   = 'block';
        }
        else
        {
            $this->data['msg']            = '';
            $this->data['successmsg']     = '';
            $this->data['msg_class']      = '';
            $this->data['display_option'] = 'none';
        }
        
        $this->data['title'] = 'Sign Up';
        $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
        $this->templatelayout->get_header();
        $this->templatelayout->get_footer();
        $this->elements['middle']='signup';
        $this->elements_data['middle'] = $this->data;
        $this->layout->setLayout('front_layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    
	//$this->load->view('signup', $data);
    }
	
}

?>