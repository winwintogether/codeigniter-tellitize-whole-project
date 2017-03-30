<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class templatelayout {
	var $obj;
    
	public function __construct()
    {
		$this->obj =& get_instance();
    }
	
	public  function get_footer(){
		$this->footer = '';
        $this->obj->elements['footer']='includes/footer';
        $this->obj->elements_data['footer'] = $this->footer;
    }

	public function get_header(){
		$this->header = '';
		$this->obj->elements['header']='includes/header';
		$this->obj->elements_data['header'] = $this->header;
	}

}
?>