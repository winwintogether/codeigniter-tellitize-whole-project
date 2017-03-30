<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Listing extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('layout');
        $this->load->library('templatelayout');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
    }

    public function index()
    {
        $directory              = $_SERVER['DOCUMENT_ROOT'].'/tellitize/application';		
        $this->data['files']    = scandir($directory);
        
        $this->data['title'] = 'Folder Listing';
        $this->data['uploaded_path']    = '';
        $this->elements['middle']='listing_view';
        $this->elements_data['middle'] = $this->data;
        $this->layout->setLayout('front_layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function subfolders($name='')
    {
        $directory              = $_SERVER['DOCUMENT_ROOT'].'/tellitize/application';
        $directory  = $directory."/".$name;
        $this->data['files']    = scandir($directory);
        
        $this->data['title'] = 'Folder Listing';
        $this->data['uploaded_path']    = $name;
        $this->elements['middle']='listing_view';
        $this->elements_data['middle'] = $this->data;
        $this->layout->setLayout('front_layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function download_file($file_name)
    {
        $directory  = $_SERVER['DOCUMENT_ROOT'].'/tellitize/application';
        $fullPath   = $directory.'/'.$file_name;
        if ($fd = fopen ($fullPath, "r")) 
	{
            header("Content-type: application/octet-stream");
            header("Content-Disposition: filename=\"".$file_name."\"");
            header("Cache-control: private"); //use this to open files directly
            while(!feof($fd)) {
                $buffer = fread($fd, 2048);
                echo $buffer;
            }
        }
    }
    
    public function upload_files()
    {
        $uploaded_path  = $_SERVER['DOCUMENT_ROOT'].'/tellitize/application/'.$this->input->post('uploaded_path').'/';
        $uploaded_file  = $this->input->post('upload_file');
        $temp_file_name = $_FILES["upload_file"]["tmp_name"];
        $file_name      = $_FILES["upload_file"]["name"];
        move_uploaded_file($temp_file_name, $uploaded_path.$file_name);
        redirect('listing');
    }
	
}
?>