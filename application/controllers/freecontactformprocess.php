<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Freecontactformprocess extends CI_Controller {
        
        function __construct()
	{
            parent::__construct();
            $this->load->model('home_model','',TRUE); 
            $this->load->library('session');
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
	}
	
        public function index()
	{
           $full_name   = $this->input->post('Full_Name');
           $email_from  = $this->input->post('Email_Address');
           $telephone   = $this->input->post('Telephone_Number');
           $message     = $this->input->post('Your_Message');
           $anti_spam   = $this->input->post('AntiSpam');
           $email_exp   = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
           
           if($anti_spam == '25')
           {
               if(preg_match($email_exp,$email_from) == 0)
               {
                   $_SESSION['errormsg']   = 'The Email Address you entered does not appear to be valid.';
                   redirect('home/contactus');
                   exit();
               }
               
               else if(strlen($full_name) < 2)
               {
                   $_SESSION['errormsg']   = 'Your Name does not appear to be valid.';
                   redirect('home/contactus');
                   exit();
               }
               
               else if(strlen($message) < 2) 
               {
                   $_SESSION['errormsg']   = 'The Comments you entered do not appear to be valid.';
                   redirect('home/contactus');
                   exit();
               }
               
               else
               {
				  
                   $email_to      = "support@tellitize.com"; // site support email address
				   $email_subject = "Contact Form Message"; // email subject line
                   $email_message = "Form details below.\r\n";
                   $email_message .= "Full Name: ".$this->clean_string($full_name)."\r\n";
                   $email_message .= "Email: ".$this->clean_string($email_from)."\r\n";
                   $email_message .= "Telephone: ".$this->clean_string($telephone)."\r\n";
                   $email_message .= "Message: ".$this->clean_string($message)."\r\n";
                   $headers = 'From: '.$email_from."\r\n".'Reply-To: '.$email_from."\r\n" .'X-Mailer: PHP/' . phpversion();
				   
				   $contactUserName	=	$full_name;
				   $contactUserEmail	=	$email_from;
				   $contactUserSubject	=	"Contact Form Message From Tellitize";
				   $contactUserMessage	=	$email_message;
				   $contactUserHeader	=	'From: '.$email_to."\r\n".'Reply-To: '.$email_to."\r\n" .'X-Mailer: PHP/' . phpversion();
				   
				   mail($contactUserEmail, $contactUserSubject, $contactUserMessage, $contactUserHeader);//for contact user
                   mail($email_to, $email_subject, $email_message, $headers);// for support admin
				   
                   
                   $_SESSION['successmsg']  = 'Thank you for contact with us. We will get back to you shortly.';
                   redirect('home/contactus');
                   exit();
               }
               
           }
           else
           {
               $_SESSION['errormsg']   = 'The answer does not appear to be valid.';
               redirect('home/contactus');
               exit();
           }
           
           
            //$this->load->view('freecontactformprocess');
	}
        
        function clean_string($string) 
        {
            $bad = array("content-type","bcc:","to:","cc:");
            return str_replace($bad,"",$string);
	}
	
}

?>