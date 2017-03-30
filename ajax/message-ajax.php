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

if(isset($_GET['mode']) AND $_GET['mode']=='readMessage')
{
	$user_id		= $_SESSION['userid'];
	$updateMessage	= mysql_query("UPDATE messages SET read_status = 1 WHERE to_user = '".$user_id."'");
	echo "success";
}

if(isset($_GET['mode']) AND $_GET['mode']=='grant')
{
	$to_user_id     = $_GET['to_user'];
        $from_user_id   = $_GET['from_user'];
        $message        = $_GET['message'];
        $date           = date('Y-m-d');

        mysql_query("INSERT INTO `messages` (`id`, `to_user`, `from`, `message`, `date`, `read_status`) VALUES 
                     (NULL, '".$from_user_id."', '".$to_user_id."', '".$message."', '".$date."','0')");
        
        /* Email to user starts*/
        
        $query          = "SELECT name, last_name, email FROM users WHERE userid = '".$from_user_id."'";
        $selectQuery    = mysql_query($query);
        $arr_query      = mysql_fetch_array($selectQuery);
        
        $name           = $arr_query['name']." ".$arr_query['last_name'];
        $to             = $arr_query['email'];
        
        $subject        = "You have been Tellitized";
        $headers        = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers.= "From: info@tellitize.com" ;
        
        $view_url       = $base_url."inbox";
        $image_src      = $base_url."images/tellitizeLogo.png";
                                                
        $msg            = "<a href='".$base_url."' title='tellitize.com'>
                           <img border='0' alt='tellitize.com' src='".$image_src."' />
                           </a><br><br>Hello ".$name.", <br><br>Somebody has given a message to you. 
                           Please click on following link to review and respond.<br><br>
                           ".$view_url;
                                                
        mail($to,$subject,$msg ,$headers);
        
        /* Email to user ends */
	
	echo "success";
}

if(isset($_GET['mode']) AND $_GET['mode']=='respond_to_author'){
    
    $post_id        = $_GET['post_id'];
    $query          = "SELECT userid FROM public_post WHERE postid = '".$post_id."'";
    $selectQuery    = mysql_query($query);
    $arr_query      = mysql_fetch_array($selectQuery);
    $userid         = $arr_query['userid'];
    
    $html='<ul>
            <li id="email_left">Message :</li>
            <li id="email_rit"><textarea id="grant_text" name="grant" rows="3" cols="20"></textarea></li>
           </ul>
           <div id="sent_btn" onClick="sendResponseToAuthor();"></div>
           <input type="hidden" name="to_user" id="to_user" value="'.$userid.'">
           <input type="hidden" name="from_user" id="from_user" value="'.$_SESSION['userid'].'">';
                
    $val = array("success" => "yes","html"=>$html);
    $output = json_encode($val);
    echo $output;
		
				
}

?>