<?php
//error_reporting(0);
session_start();
require('config.php');
//notifications send if any other user reply or like a comment or reply


if(isset($_GET['mode']) AND $_GET['mode']=='saveMessage'){
 				$from=$_SESSION['userid'];
  				//select userid from username
				$selUser=mysql_query("SELECT userid from users where user_name='".$_POST['to_user']."'");
				$userid=mysql_fetch_array($selUser);
				if(isset($userid) && $userid!=''){
					$in="INSERT INTO `messages` (
							`id` ,
							`to_user` ,
							`from` ,
							`message` ,
							`date` ,
							`read_status`						
							)
							VALUES (
							NULL ,'".$userid['userid']."','".$from."','".$_POST['message_txt']."','".date("y/m/d")."','0')";
							$insert=mysql_query($in);
							  
					if($insert){
						$val = array("success" => "yes","status" =>$insert);
						$output = json_encode($val);
						echo $output;
					}
					else{
						$val = array("success" => "no","status" =>$insert);
						$output = json_encode($val);
						echo $output;
					}
			}	
			else{
						$val = array("success" => "no","status" =>'notexist');
						$output = json_encode($val);
						echo $output;
					}	
		
}

if(isset($_GET['mode']) AND $_GET['mode']=='deleteMessage'){
	$delete=mysql_query("DELETE FROM messages WHERE id =".$_POST['id']);
	if($delete){
					$val = array("success" => "yes","status" =>$delete);
					$output = json_encode($val);
					echo $output;
				}
				else{
					$val = array("success" => "no","status" =>$delete);
					$output = json_encode($val);
					echo $output;
				}	
}
?>