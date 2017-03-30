<?php
class Notification_model extends CI_Model{
	
	function update(){
		$this->load->database();
		$data=array(   'read_status'=>1 );
 		  $this->db->where('read_status','0');
 		  $query=$this->db->update('notifications',$data);
		  return  $query;
	}
	function changeDateFormat($date)
	{
		$extrated_date= explode(" ", $date);
		$pubDate = explode("-", $extrated_date[0]);
		$mon_array = array("01" => "January","02" => "February","03" => "March","04" => "April","05" => "May", "06" =>  "June", "07" => "July", "08" =>  "August", 
		"09" => "September", "10" => "October", "11" => "November",  "12" => "December");
		$month=$mon_array [$pubDate[1]];
		if($month!="" )
		$newDate=$month." ".$pubDate[2].", ".$pubDate[0];
		else $newDate="";
		return $newDate; 
			
		
	}
}	
?>