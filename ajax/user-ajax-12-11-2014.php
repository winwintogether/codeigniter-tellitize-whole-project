<?php
//error_reporting(0);
session_start();
require('config.php');
if(isset($_GET['mode']) AND $_GET['mode']=='save_user'){
	$select="SELECT * FROM users WHERE  user_name='".addslashes($_POST['username'])."'";
	$sql=mysql_query("SELECT * FROM users WHERE  user_name='".addslashes($_POST['username'])."' OR email='".$_POST['email']."'");
	$row=mysql_num_rows($sql);
	if($row){
	$exist=mysql_fetch_array($sql);
	if($exist['user_name']==$_POST['username']){
			$val = array("success" => "no","status" =>"username");
			$output = json_encode($val);
			echo $output;
	}
	else{
		$val = array("success" => "no","status" =>"email");
			$output = json_encode($val);
			echo $output;
	}
		}
	else{
			$val = array("success" => "yes","status" =>$select);
			$output = json_encode($val);
			echo $output;
		}
}
if(isset($_GET['mode']) AND $_GET['mode']=='update_user'){
	$select="SELECT * FROM users WHERE  user_name='".addslashes($_POST['username'])."' and userid!='".$_SESSION['userid']."'";
	$sql=mysql_query("SELECT * FROM users WHERE  user_name='".addslashes($_POST['username'])."' and userid!='".$_SESSION['userid']."'" );
	$row=mysql_num_rows($sql);
	if($row){
	$val = array("success" => "no","status" =>$select);
			$output = json_encode($val);
			echo $output;
		}
	else{
			$name=$_POST['firstname'];
			$update=mysql_query("Update users SET user_name='".$_POST['username']."',email='".$_POST['email']."',name='".$name."',last_name='".$_POST['lastname']."',age='".$_POST['age']."',about_me='".$_POST['aboutme']."',search_tags='".$_POST['tags']."' ,zipcode='".$_POST['zipcode']."',nickname='".$_POST['nickname']."',scars='".$_POST['scars']."',tattoos='".$_POST['tattoos']."',highschool='".$_POST['highschool']."',college='".$_POST['college']."',relationshp_status='".$_POST['relation_status']."',state='".$_POST['state']."',city='".$_POST['city']."' where userid='".$_SESSION['userid']."'");
			if($update){
				$val = array("success" => "yes","status" =>$update);
				$output = json_encode($val);
				echo $output;
			}
			else{
				$val = array("success" => "db","status" =>$update);
				$output = json_encode($val);
				echo $output;
			}
		}
}
if(isset($_GET['mode']) AND $_GET['mode']=='login_user'){

        $select="SELECT * FROM users WHERE  user_name='".addslashes($_POST['login_username'])."' AND password= md5('".$_POST['login_pw']."') AND status=1";
	$sql=mysql_query("SELECT * FROM users WHERE  user_name='".addslashes($_POST['login_username'])."' AND password= md5('".$_POST['login_pw']."')AND status=1");
	$row=mysql_num_rows($sql);
	$result=mysql_fetch_array($sql);
       if($row){
	$val = array("success" => "yes","status" => $_SESSION['userid']);
			$output = json_encode($val);
                        echo $output;
		}
	else{
			$val = array("success" => "no","status" => $select);
			$output = json_encode($val);
			echo $output;
		}
}
if(isset($_GET['mode']) AND $_GET['mode']=='checkComment'){
	 			$selectWords=mysql_query("select words from badwords_list where id=1");
				$words=mysql_fetch_array($selectWords);
				if($words){
				$word_list=explode(',', strtolower($words['words']) );
				}
				//echo "1".$word_list;
				$word_list= array_filter($word_list);
				$wordpost=explode( ' ', strtolower($_POST['commentArea']) );
				$result = array_diff( $wordpost,$word_list);
				$result=count($result);$result2=count($wordpost);
				if($result==$result2)
				{
	  				$val = array("success" => "yes","status" =>"bad-words","result2"=>$result2,"result"=>$result);
					$output = json_encode($val);
					echo $output;
	             }
				 else{
				 	$val = array("success" => "no","status" =>"badwords");
					$output = json_encode($val);
					echo $output;
				 }
}
if(isset($_GET['mode']) AND $_GET['mode']=='saveComment'){
    $comment_posted = htmlspecialchars($_POST['commentArea']);
    $headers        = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    if($_POST['emailidUser']==1){ //echo "h".$_POST['emailidUser'];
            //echo "email";
            $selectMail=mysql_query("select email from users where userid=".$_SESSION['userid']);
            //echo "select email from users where userid=".$_SESSION['userid'];
            $rowemail=mysql_fetch_array($selectMail);
            if($rowemail['email']!='') {
                $headers.="From : ".$rowemail['email'];
            }
            else $headers.= "From: info@tellitize.com" ;
    }
    else
        //echo "No email";
        $headers.= "From: info@tellitize.com" ;
	/*if(isset($_SESSION['userid']))
	{ */ // Blocked by SB login checking blocked on 10-11-2014
            $result_post=0;
            $from=$_POST['postasuser'];
            $IP         = $_SERVER['REMOTE_ADDR'];
            $getUrl     = "http://www.geoplugin.net/php.gp?ip=".$IP;
            $geoplugin  = unserialize(file_get_contents($getUrl));
            $country_name   = strtoupper($geoplugin['geoplugin_countryName']);
            $state_name     = strtoupper($geoplugin['geoplugin_region']);
            $city_name      = strtoupper($geoplugin['geoplugin_city']);
            $location       = $city_name.", ".$state_name.", ".$country_name;
            /*$in="INSERT INTO `public_post` (`postid`, `cid`, `from`, `comment`, `post_date`, `location`, `group_id`, `userid`, `placeid`)
                 VALUES (NULL ,'".$_POST['category']."','".$from."','".$comment_posted ."','".date("y/m/d")."','".$_POST['location']."','".$_POST['group']."','".$_SESSION['userid']."'
		 ,'".$_POST['place']."')";*/
            $in="INSERT INTO `public_post` (`postid`, `cid`, `from`, `comment`, `post_date`, `location`, `group_id`, `userid`, `placeid`)
                 VALUES (NULL ,'".$_POST['category']."','".$from."','".$comment_posted ."','".date("y/m/d")."','".$location."','".$_POST['group']."','".$_SESSION['userid']."'
		 ,'".$_POST['place']."')";
            $insert=mysql_query($in);
				if($insert){
					$categoryQuery=mysql_query("select cate_name from category where cid=".$_POST['category']);
						   $categoryres=mysql_fetch_array($categoryQuery);
						   $category_name=$categoryres['cate_name'];
				    $post_id=mysql_insert_id();
					//post group/POD
					//category name for url
				$selectcat=mysql_query("select cate_name from category where cid in(select cid from public_post where postid=".$post_id.")");
				if($row_cat=mysql_fetch_array($selectcat)){
						$cat_name = str_replace(" ","-",$row_cat['cate_name']);
						$cat_name = preg_replace("![^a-z0-9]+!i", "-",$cat_name );
				}
					if(isset($_POST['group']) || isset($_POST['place'])){
					    if(isset($_POST['group'])) {
							$postAbout='group';
							$selgroup=mysql_query("select group_name  from group_list where id=".$_POST['group']);
							$group_res=mysql_fetch_array($selgroup);
							$mail_category=$group_res['group_name']." group";
						}
						else{ $postAbout='pod';
							$selpod=mysql_query("select place  from place_of_discussion where id=".$_POST['place']);
							$pod_res=mysql_fetch_array($selpod);
							$mail_category=$pod_res['place']." pod";
						}
					    $selectUserId=mysql_query("SELECT userid from  users where email='".$_POST['user_email']."'");
						if($emailuser=mysql_fetch_array($selectUserId)){
							$group_post_about=$emailuser['userid'];
						}
						else {	$group_post_about=0; }
                                                if($_POST['name_user'] == '')
                                                {
                                                    $user_first_name = $_GET['name_user'];
                                                }
                                                else
                                                {
                                                    $user_first_name = $_POST['name_user'];
                                                }
						$in=mysql_query("INSERT INTO `post_details` (
						`postid` ,
						`post_about` ,
						`email`,
						`first_name`,
						`group_post_about`
						)
						VALUES (
						'".$post_id."','".$postAbout."','".$_POST['user_email']."','".$user_first_name."','".$group_post_about."'
						)");
						if($in){
								$to = $_POST['user_email'];
								$title_post=str_replace(" ","-",$user_first_name);
								$subject = "You have been Tellitized";
								//$msg  = $_POST['commentArea'];
								$view_url=$base_url.''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $title_post).'/'.$post_id.'/ref';
								$msg = '<a href="'.$base_url.'" title="tellitize.com" >
                   					 <img border="0" alt="tellitize.com" src="'.$base_url.'images/tellitizeLogo.png">
								 </a>
								<p style="font:14px arial;line-height:20px;">Your name has been mentioned in the Tellitize
								'.$mail_category.'.
								 Please click here to review and respond : '.  $view_url.'</p>
								<p><b>Tellitize Support Team</b></p>';
							if($to!=''){
								if(mail($to,$subject,$msg ,$headers)){
									$insert=mysql_query("INSERT INTO `mail_status` (`userid`,`emailid`)	VALUES ('".$_SESSION['userid']."','".$to."')");
									if($insert) $mailsuccess='mailsent';
								}
								else $mailsuccess='mailfailed';
							}
							else $mailsuccess='mailfailed';
						}
					}
					//post place name
					if(isset($_POST['place_name']) and $_POST['post_about']=='place'){
						$in=mysql_query("INSERT INTO `post_details` (
						`postid` ,
						`post_about` ,
						`place`
						)
						VALUES (
						'".$post_id."','place','".$_POST['place_name']."'
						)");
						if(isset($_POST['email'])){
							$title_post=str_replace(" ","-",$_POST['place_name']);
							$to = $_POST['email'];
							$subject = "You have been Tellitized";
							$view_url=$base_url.''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $title_post).'/'.$post_id.'/ref';
								$msg = '<a href="'.$base_url.'" title="tellitize.com" >
                   					 <img border="0" alt="tellitize.com" src="'.$base_url.'images/tellitizeLogo.png">
								 </a>
								<p style="font:14px arial;line-height:20px;">Your name has been mentioned in the Tellitize
								'.$category_name.'.
								 Please click here to review and respond : '.  $view_url.'</p>
								<p><b>Tellitize Support Team</b></p>';
							//$headers = "From: info@tellitize.com" ;
						if($to!=''){
							if(mail($to,$subject,$msg ,$headers)){
								$insert=mysql_query("INSERT INTO `mail_status` (`userid`,`emailid`)	VALUES ('".$_SESSION['userid']."','".$to."')");
								if($insert) $mailsuccess='mailsent';
							}else $mailsuccess='mailfailed';
						}
						else $mailsuccess='mailfailed';
						}
					}
					if(isset($_POST['other_desc']) and $_POST['post_about']=='other'){
						$in=mysql_query("INSERT INTO `post_details` (
						`postid` ,
						`post_about` ,
						`other_description`
						)
						VALUES (
						'".$post_id."','other','".$_POST['other_desc']."'
						)");
						if(isset($_POST['email'])){
							$title_post=str_replace(" ","-",$_POST['other_desc']);
							$to = $_POST['email'];
							$subject = "You have been Tellitized";
							$view_url=$base_url.''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $title_post).'/'.$post_id.'/ref';
                           $msg='<a href="'.$base_url.'" title="tellitize.com" >
                   					 <img border="0" alt="tellitize.com" src="'.$base_url.'images/tellitizeLogo.png">
								 </a>
								<p style="font:14px arial;line-height:20px;">Your name has been mentioned in the Tellitize
								'.$category_name.' category.
								 Please click here to review and respond : '.  $view_url.'</p>
								<p><b>Tellitize Support Team</b></p>';
							//$headers = "From: info@tellitize.com" ;
						   if($to!=''){
								if(mail($to,$subject,$msg ,$headers)){
								$insert=mysql_query("INSERT INTO `mail_status` (`userid`,`emailid`)	VALUES ('".$_SESSION['userid']."','".$to."')");
								if($insert) $mailsuccess='mailsent';
							}else $mailsuccess='mailfailed';
						}
						else $mailsuccess='mailfailed';
						}
					}
					if(isset($_POST['first_name']) and $_POST['post_about']=='person'){
						$in=mysql_query("INSERT INTO `post_details` (
						`postid` ,
						`post_about` ,
						`first_name` ,
						`last_name` ,
						`email`
						)
						VALUES (
						'".$post_id."','person','".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['email']."'
						)");
						if(isset($_POST['email'])){
						   $fullnameofuser=$_POST['first_name']." ".$_POST['last_name'];
							$title_post=str_replace(" ","-",$fullnameofuser);
							$to = $_POST['email'];
							$subject = "You have been Tellitized";
							$view_url=$base_url.''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $title_post).'/'.$post_id.'/ref';
							$msg = '<a href="'.$base_url.'" title="tellitize.com" >
                   					 <img border="0" alt="tellitize.com" src="'.$base_url.'images/tellitizeLogo.png">
								 </a>
								<p style="font:14px arial;line-height:20px;">Your name has been mentioned in the Tellitize
								'.$category_name.' category.
								 Please click here to review and respond : '.  $view_url.'</p>
								<p><b>Tellitize Support Team</b></p>';
							//$headers = "From: info@tellitize.com" ;
						     if($to!=''){
								if(mail($to,$subject,$msg ,$headers)){
								$insert=mysql_query("INSERT INTO `mail_status` (`userid`,`emailid`)	VALUES ('".$_SESSION['userid']."','".$to."')");
								if($insert) $mailsuccess='mailsent';
								}else $mailsuccess='mailfailed';
							}
							else $mailsuccess='mailfailed';
						}
					}
					$val = array("success" => "yes","status" =>$insert,"mail"=>$mailsuccess,"result"=>$result);
					$output = json_encode($val);
					echo $output;
				}
				else{
					$val = array("success" => "no","status" =>$insert);
					$output = json_encode($val);
					echo $output;
				}
		/*}
		else{
			$val = array("success" => "no","status" =>"notauser");
					$output = json_encode($val);
					echo $output;
		} */
}
if(isset($_GET['mode']) AND $_GET['mode']=='viewComment'){
        $article_id='article';
		if(isset($_SESSION['userid'])){
			if(isset($_GET['groupid'])){
							$select=mysql_query("SELECT * FROM public_post where postid not in
							(SELECT postid FROM report_abused_list
							where userid =".$_SESSION['userid'].") AND  group_id=".$_GET['groupid']." AND  placeid=0 and status=0 order by  postid desc limit 10
							");
			$article_id='group_article';
			$reply_comment_class='class="group_reply_comment"';
			$people_agree='Agree';
			$people_disagree='DisAgree';
			}
		else if(isset($_GET['placeid'])){
							$select=mysql_query("SELECT * FROM public_post where postid not in
							(SELECT postid FROM report_abused_list
							where userid =".$_SESSION['userid'].") AND  placeid=".$_GET['placeid']." and status=0 order by  postid desc limit 10
							");
			$article_id='group_article';
			$reply_comment_class='class="group_reply_comment"';
			$people_agree='Agree';
			$people_disagree='DisAgree';
			}
		else{
			$select=mysql_query("SELECT * FROM public_post where postid not in
						(SELECT postid FROM report_abused_list
						where userid =".$_SESSION['userid'].")and group_id=0 AND  placeid=0 and status=0 order by  postid desc limit 10
						");
			$article_id='article';
			$reply_comment_class='';
			$people_agree='Agree';
			$people_disagree='Disagree';
		}
		}
		else{
		$select=mysql_query("SELECT * FROM public_post where group_id=0 AND  placeid=0 and status=0 order by  postid desc limit 10");
		}
		if($select){
		   while($row=mysql_fetch_array($select)){
		   	$agreed='';
			$disagreed='';
			$agree_status='';
		   	 $selectuser=mysql_query("SELECT user_name,name,reg_status,last_name from users where userid='".$row['from']."'");
			 $user=mysql_fetch_array($selectuser);
		   	if($row['from']=='' || $row['from']=='0')  $from='Anonymous';
			else
			{
				if($user['reg_status']==0)
				$from=stripslashes($user['name']).' '.stripslashes($user['last_name']);
				else
					$from=stripslashes($user['name']);
			}
			$share_btncode=' <a href="javascript:void(0)" onclick="notValidUser()";>share</a>';
			if(isset($_SESSION['username'])){
				$agreeClick='onclick="agreePost('.$row['postid'].');"';
				$disagreeClick='onclick="disagreePost('.$row['postid'].');"';
				//$report_abuse='onclick="reportAbuse('.$row['postid'].');"';
				//check agreed or disagreed
				$agree_click='';
				$disagree_click='';
				$selectQuery = mysql_query("SELECT like_status from post_likes where userid='".$_SESSION['userid']."' and postid='".$row['postid']."'");
				if($agreeStatus=mysql_fetch_array($selectQuery)){
					$agree_status=$agreeStatus['like_status'];
					$agreed='';
					if($agree_status==1)  { $agree_click="style=display:none";
					$agreed=' <a href="javascript:void(0)"  id="agreebtn'.$row['postid'].'" class="disable_agree"></a>';
					}
					if( $agree_status==0) { $disagree_click="style=display:none";
					$disagreed=' <a href="javascript:void(0)"  id="disagreebtn'.$row['postid'].' " class="disable_disagree"></a>';
					}
				}
				$profile_img='';
				$query = mysql_query("SELECT profile_img from users where userid='".$_SESSION['userid']."'");
				if($p_row=mysql_fetch_array($query)){
				   {
					$profile_img=$p_row['profile_img'];
					}
					if($profile_img!='')
					{
						$profilPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$base_url.'/ajax/uploads/'.$profile_img.'" />';
					}
				else{$profilPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';}
			}
			}
			else{
				$agreeClick='onclick="notValidUser()"';
				$disagreeClick='onclick="notValidUser()"';
				//$report_abuse='onclick="notValidUser()"';
				$agree_click='';
				$disagree_click='';
			}
			$report_abuse='onclick="reportAbuse('.$row['postid'].');"';
			$agree_cnt=0;
			$disagree_cnt=0;
			$select_count = mysql_query("SELECT count(*) as c from post_likes where  postid='".$row['postid']."' AND like_status=1");
			$agree=mysql_fetch_array($select_count );
			$agree_cnt=$agree['c'];
			$select_count  =  mysql_query("SELECT count(*) as c from post_likes where  postid='".$row['postid']."' AND like_status=0");
			$dagree=mysql_fetch_array($select_count );
			$disagree_cnt=$dagree['c'];
			$date=$row['post_date'];
			$date=explode( '-', $date );
			$date=$date[1].'-'.$date[2].'-'.$date[0];
			$location=$row['location'];
			 $selectcat=mysql_query("SELECT cate_name from category where cid='".$row['cid']."'");
			 $cat=mysql_fetch_array($selectcat);
			 $category=$cat['cate_name'];
			 $category='';
				$selectPostAbout = mysql_query("SELECT * from post_details where  postid='".$row['postid']."'");
				if($postAbout=mysql_fetch_array($selectPostAbout))
				{
						$about=$postAbout['post_about'];
						if($about=='person')
						$category=$postAbout['first_name']." ".$postAbout['last_name'];
						else if($about=='place')
						$category=$postAbout['place'];
						else if($about=='other')
						$category=$postAbout['other_description'];
						else if($about=='group' || $about=='pod')
						{
						    $category='';
							/*$query_name = mysql_query("SELECT name from group_userlist where emailid='".$postAbout['email']."'");
							if($name_row=mysql_fetch_array($query_name))
							{
								$category=$name_row['name'];
							}*/
							$category=$postAbout['first_name'];
						}
						else $category='';
				}
	       		if($category=='') $style='style="padding-top:6px"';
				else $style="";
				$category_link= str_replace(" ","-",$category);
				$commentonpost=htmlspecialchars($row['comment']);
				if(isset($_SESSION['username'])) {
										$share_btncode='<div class="addthis_toolbox addthis_default_style " >
																<a class="addthis_button"  href="http://www.addthis.com/bookmark.php" addthis:url="http://118.94.177.106:8165/"
																  addthis:title="'.$category.', '.$commentonpost.'"  addthis:description=" '.$commentonpost.'">share</a>
														</div>';
									$selectcat=mysql_query("select cate_name from category where cid in(select cid from public_post where postid=".$row['postid'].")");
									if($row_cat=mysql_fetch_array($selectcat)){
									$cat_name = str_replace(" ","-",$row_cat['cate_name']);
									$cat_name = preg_replace("![^a-z0-9]+!i", "-",$cat_name );
									}
									$user_title='<a href="'.$GLOBALS['base_url'].''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", ",","-", $category_link).'/'.$row['postid'].'">'.$category.'</a>';
			 }
			 else  $user_title='<a href="javascript:void(0)" onClick="notValidUser();">'.$category.'</a>';
					$postuser_img='';
							$query = mysql_query("SELECT profile_img,name,last_name from users where userid='".$row['from']."'");
								if($p_row=mysql_fetch_array($query)){
								   {
									$postuser_img=$p_row['profile_img'];
									if($p_row['last_name']!='')
									$name_link=$p_row['name'].' '.$p_row['last_name'];
									else
									 $name_link=$p_row['name'];
									}
									$name_link= str_replace(" ","-",$name_link);
							}
							if($postuser_img!='') {
							$postuserPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$postuser_img.'" />';
							}
							else{
							$postuserPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';
							}
					if(isset($_SESSION['userid']) && $row['from']!=0){
						//get Name
						$pic_link=$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$row['from'];
					}
					else $pic_link='javascript:void(0)';
                                        $str_len    = strlen($row['comment']);
                                        if($str_len > 50)
                                        {
                                            $comment_posted_little = substr($row['comment'],0,50)."...";
                                        }
                                        else
                                        {
                                            $comment_posted_little = $row['comment'];
                                        }
                                        $comment_posted_on_hover = $row['comment'];
                                        $comment_posted= autolink($row['comment'] );
                                        //$comment_posted= autolink($row['comment'] );
				$html.='<div class="contents_list" id="'.$row['postid'].'">';
							$html.='<div id="'.$article_id.'">
									<div class="post_user-main">
										<div class="user_post-icon"></div>
										<div class="userpost-name">
											 <div class="userpost-title">'.$user_title.'</div>
											<div class="user-post-id" '.$style.'>From: <span class="id-text">'.$from.'</span></div>
										 </div>
										 <div class="userpost-city">Posted: '.$date.','.$location.'</div>
									 </div>';
                                                                        $html .= '<div>
                                                                         <div class="profilepicpost" style="float:left">
                                                                            <a class="link_user" href="'.$pic_link.'">'.$postuserPic.'</a>
									</div>
                                                                        <div class="postcontent-main">
                                                                            <div class="postcontent">
                                                                                <div class="less_comment" id="less_comment_'.$row['postid'].'">'.$comment_posted_little.'</div>
                                                                                <div class="more_comment" id="more_comment_'.$row['postid'].'" style="display:none;">
                                                                                    <span class="moreCommentLink">
                                                                                        <a style="color:#000000;" class="postLink " href="'.$GLOBALS['base_url'].''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'].'">'.$comment_posted_on_hover.'</a>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                                                            <div class="postcontent-aggre-main">
                                                                                                                <div class="circle" id="agree_circle'.$row['postid'].'">'.$agree_cnt.'</div>
                                                                                                                <div class="people-agree">Agree</div>
                                                                                                                <div class="circle" id="disagree_circle'.$row['postid'].'">'.$disagree_cnt.'</div>
                                                                                                                <div class="people-agree">Disagree</div>
                                                                                                                <div class="report-abues reLink">&nbsp;</div>'; //<div class="report-abues reLink" ><a  class="reLink" href="javascript:void(0)"' .$report_abuse.'>Report Abuse</a></div>
                                                                                                                   if($agreed==''){
                                                                                                                            /*$html.=  '<div class="agree-btn "  id="btn'.$row['postid'].'">
                                                                                                                                              <a href="javascript:void(0)"' .$agreeClick.' id="agreebtn'.$row['postid'].'"'.$agree_click.' class="able_agree">agree</a>
                                                                                                                                             </div>';*/
                                                                                                                            $html.=  '<div class="orangeButton agree_'.$row['postid'].'"  id="btn'.$row['postid'].'">
                                                                                                                                        <input type="button" id="agreebtn'.$row['postid'].'"'.$agree_click.' class="orangeButton-right" value="agree" '.$agreeClick.'>
                                                                                                                                      </div>';
                                                                                                                   }
                                                                                                                   else {
                                                                                                                            /*$html.='<div  class="agree-btn "  id="btn'.$row['postid'].'">'.$agreed.' </div>'; */
                                                                                                                            $html.='<div  class="disableButton disagree_'.$row['postid'].'"  id="btn'.$row['postid'].'">
                                                                                                                                        <input type="button" id="agreebtn'.$row['postid'].'" class="disableButton-right" value="agree">
                                                                                                                                    </div>';
                                                                                                                   }
                                                                                                                   if($disagreed==''){
                                                                                                                            /*$html.= ' <div  class="disagree-btn" id="btnd'.$row['postid'].'">
                                                                                                                                                            <a href="javascript:void(0)"' .$disagreeClick.'  id="disagreebtn'.$row['postid'].'"'.$disagree_click.' " class="able_disagree">disagree</a>
                                                                                                                                                      </div>';*/
                                                                                                                            $html.=  '<div class="orangeButton disagree_'.$row['postid'].'"  id="btn'.$row['postid'].'">
                                                                                                                                        <input type="button" id="disagreebtn'.$row['postid'].'" '.$disagree_click.' " class="orangeButton-right" value="disagree" '.$disagreeClick.'>
                                                                                                                                      </div>';
                                                                                                                   }
                                                                                                                   else {
                                                                                                                            /*$html.='<div  class="disagree-btn" id="btnd'.$row['postid'].'">'.$disagreed.' </div>'; */
                                                                                                                            $html.='<div  class="disableButton disagree_'.$row['postid'].'"  id="btn'.$row['postid'].'">
                                                                                                                                        <input type="button" id="disagreebtn'.$row['postid'].'" class="disableButton-right" value="disagree">
                                                                                                                                    </div>';
                                                                                                                   }
													   $url_twit=$GLOBALS['base_url'].''.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'];
													  $twittercomment=$category.':'.$commentonpost;
													  $twitcomment_url=$twittercomment.' '.$url_twit;
													  if(strlen($twitcomment_url) > 140){
													        $length=strlen($GLOBALS['base_url']);
															if($length<140)
														   $twitter_commentonpost =  substr($twittercomment, 0, 136-$length).'...';
														   else {$url_twit=''.$GLOBALS['base_url'];$twitter_commentonpost=substr($twittercomment, 0, 136-strlen($url_twit)).'...';}
														}
														   else {$twitter_commentonpost=$twittercomment;}
													  $html.='<div class="share">
                                                                                                                    <a target="_new" href="http://www.facebook.com/dialog/feed?
                                                                                                                    app_id=171832922955728&
                                                                                                                    link='.$GLOBALS['base_url'].''.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'].'/&
                                                                                                                    picture='.$GLOBALS['base_url'].'images/fb_logo.png&
                                                                                                                    name=Tellitize&
                                                                                                                    caption='.$category.'&
                                                                                                                    description='.htmlspecialchars($commentonpost).'&
                                                                                                                    redirect_uri='.$GLOBALS['base_url'].'">
                                                                                                                    <img src="'.$GLOBALS['base_url'].'images/fbshare.jpg" title="Share on Facebook" id="face"/></a>
                                                                                                                    <a target="_new" class="twitter"
                                                                                                                    href="http://twitter.com/share?url='.$url_twit.'&text='.htmlspecialchars($twitter_commentonpost).'">
                                                                                                                    <img src="'.$GLOBALS['base_url'].'images/twitter-share.jpg" title="Share on Twitter" id="Tweet"/>
                                                                                                                    </a>
                                                                                                                </div>';
                                                                                                                $post_link  = $GLOBALS['base_url'].$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'];
                                                                                                                //$post_button = "<a class='greyLeft_btn moreLink' href='".$post_link."'> More Options</a>"; //greyRight
                                                                                                                $post_button = '<input type="button" class="greyLeft_btn moreLink" value="More Options" onclick="more_link(\''.$post_link.'\');" />';
                                                                                                                $black_button_html = '';
                                                                                                            if(isset($_SESSION['userid']))
                                                                                                            {
                                                                                                                if($row['from'] == 0)
                                                                                                                {
                                                                                                                    $black_button_html = '<div class="black_button_home">
                                                                                                                                <div class="greyLeft">
                                                                                                                                    <input type="button" class="greyLeft_btn" value="Respond to Author" id="grant_message_'.$row['postid'].'" />
                                                                                                                                </div>
                                                                                                                                <div class="greyLeft">
                                                                                                                                    <input type="button" class="greyLeft_btn" value="Email Message Anonymously" onclick="emailPost('.$row['postid'].',0)" />
                                                                                                                                </div>
                                                                                                                                <div class="greyLeft">
                                                                                                                                    <input type="button" class="greyLeft_btn" value="Email Message As Yourself" onclick="emailPost('.$row['postid'].',1)" />
                                                                                                                                </div>
                                                                                                                                <div class="greyLeft">'.$post_button.'</div>
                                                                                                                             </div>';
                                                                                                                    //$html .= '<img src="'.$GLOBALS['base_url'].'images/message.png" width="72" height="26" alt="Grant" class="no_grant" name="grant_button_link" style="cursor:pointer;" />';
                                                                                                                }
                                                                                                                else if($row['from'] == $_SESSION['userid'])
                                                                                                                {
                                                                                                                    $black_button_html = '<div class="black_button_home">
                                                                                                                                <div class="greyLeft">
                                                                                                                                    <input type="button" class="greyLeft_btn" value="Email Message Anonymously" onclick="emailPost('.$row['postid'].',0)" /></div>
                                                                                                                                <div class="greyLeft">
                                                                                                                                    <input type="button" class="greyLeft_btn" value="Email Message As Yourself" onclick="emailPost('.$row['postid'].',1)" />
                                                                                                                                </div>
                                                                                                                                <div class="greyLeft">'.$post_button.'</div>
                                                                                                                              </div>';
                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                    $black_button_html = '<div class="black_button_home">
                                                                                                                                <div class="greyLeft">
                                                                                                                                    <input type="button" class="greyLeft_btn" value="Respond to Author" id="grant_message_'.$row['postid'].'" />
                                                                                                                                </div>
                                                                                                                                <div class="greyLeft">
                                                                                                                                    <input type="button" class="greyLeft_btn" value="Email Message Anonymously" onclick="emailPost('.$row['postid'].',0)" /></div>
                                                                                                                                <div class="greyLeft">
                                                                                                                                    <input type="button" class="greyLeft_btn" value="Email Message As Yourself" onclick="emailPost('.$row['postid'].',1)" />
                                                                                                                                </div>
                                                                                                                                <div class="greyLeft">'.$post_button.'</div>
                                                                                                                             </div>';
                                                                                                                    //$html .= '<img src="'.$GLOBALS['base_url'].'images/message.png" width="72" height="26" alt="Grant" name="grant_button_link" id="grant_message_'.$row['postid'].'" style="cursor:pointer;" />';
                                                                                                                }
                                                                                                            }
                                                                                                            else
                                                                                                            {
                                                                                                                $black_button_html = '<div class="black_button_home">
                                                                                                                            <div class="greyLeft">
                                                                                                                                <input type="button" class="greyLeft_btn" value="Respond to Author" onclick="notValidUser()"; />
                                                                                                                            </div>
                                                                                                                            <div class="greyLeft">
                                                                                                                                <input type="button" class="greyLeft_btn" value="Email Message Anonymously" onclick="emailPost('.$row['postid'].',0)" /></div>
                                                                                                                            <div class="greyLeft">
                                                                                                                                <input type="button" class="greyLeft_btn" value="Email Message As Yourself" onclick="emailPost('.$row['postid'].',1)" />
                                                                                                                            </div>
                                                                                                                            <div class="greyLeft">'.$post_button.'</div>
                                                                                                                         </div>';
                                                                                                                //$html .= '<img src="'.$GLOBALS['base_url'].'images/message.png" width="72" height="26" alt="Grant" name="grant_button_link" onclick="notValidUser()"; style="cursor:pointer;" />';
                                                                                                            }
                                                                                                            if(isset($_SESSION['userid']))
                                                                                                            {
                                                                                                                $session_id = $_SESSION['userid'];
                                                                                                            }
                                                                                                            else
                                                                                                            {
                                                                                                                $session_id = 0;
                                                                                                            }
                                                                                                          $html.='</div></div>';
                                                                                                          if(isset($_GET['placeid']) || isset($_GET['groupid']))
                                                                                                          {
                                                                                                              $html .= '</div></div></div>';
                                                                                                          }
                                                                                                          else
                                                                                                          {
                                                                                                              $respond_html .= '<div id="grant_div_'.$row['postid'].'" style="display:none;" class="grant_div">
                                                                                                                                <textarea id="grant_text_'.$row['postid'].'" name="grant" rows="3" cols="20"></textarea><br>
                                                                                                                                <input type="button" class="signupOrange" name="grant_button" id="grant_button_'.$row['postid'].'" value="Submit">
                                                                                                                                <input type="button" class="signupOrange" name="cancel_grant_button" id="cancel_grant_button_'.$row['postid'].'" value="Cancel">
                                                                                                                                <input type="hidden" name="to_user" id="to_user_'.$row['postid'].'" value="'.$session_id.'">
                                                                                                                                <input type="hidden" name="from_user" id="from_user_'.$row['postid'].'" value="'.$row['userid'].'">
                                                                                                                             </div>';
                                                                                                              $html .= '</div>'.$black_button_html .$respond_html.'</div></div>';
                                                                                                          }

                                $html.='</div><div class="clear:both;" style="min-height:2px;">&nbsp;</div>';
				}
				$val = array("success" => "yes","status" =>$insert,"html"=>$html);
				$output = json_encode($val);
				echo $output;
			}
			else{
				$val = array("success" => "no","status" =>$insert);
				$output = json_encode($val);
				echo $output;
			}
}
if(isset($_GET['mode']) AND $_GET['mode']=='create_group'){
	$selectGroup=mysql_query("select id from group_list where group_name='".$_POST['gname']."'");
	$num=mysql_num_rows($selectGroup);
	if($num>0){
		$val = array("success" => "no","status" =>"exist");
											$output = json_encode($val);
											echo $output;
	}
	else{
			   if(isset($_POST['groupid']))
			   {
					$groupid=$_POST['groupid'];
					$in="Update group_list SET group_name='".$_POST['gname']."',description='".$_POST['g_desc']."' where id='".$_POST['groupid']."' AND userid='".$_SESSION['userid']."'";
					$update=mysql_query($in);
								if($update){
									$val = array("success" => "yes","status" =>$update,"group"=>$groupid);
									$output = json_encode($val);
									echo $output;
								}
								else{
									$val = array("success" => "no","status" =>$update);
									$output = json_encode($val);
									echo $output;
								}
			   }
			   else{
						$groupid='';
						$in="INSERT INTO `group_list` (
											`id` ,
											`group_name` ,
											`description` ,
											`userid` ,
											`date`
											)
											VALUES (
											NULL ,'".$_POST['gname']."','".$_POST['g_desc']."','".$_SESSION['userid']."','".date("y/m/d")."'
											)";
											$insert=mysql_query($in);
						$groupid=mysql_insert_id();
						$selectuser=mysql_query("select name,last_name,email from users where userid='".$_SESSION['userid']."'");
						if($userdata=mysql_fetch_array($selectuser)){
						if($userdata['last_name']!='')
							$full_name=$userdata['name'].' '.$userdata['last_name'];
						else
							$full_name=$userdata['name'];
						$insert_place=mysql_query("INSERT INTO `group_userlist` (`id` ,`name` ,`groupid`,`emailid`,`owner_id`,`userid` )VALUES (NULL ,'".$full_name."','".$groupid."','".$userdata['email']."','".$_SESSION['userid']."','".$_SESSION['userid']."')");
										if($insert){
											$val = array("success" => "yes","status" =>$insert_place,"group"=>$groupid);
											$output = json_encode($val);
											echo $output;
										}
										else{
											$val = array("success" => "no","status" =>$insert_place);
											$output = json_encode($val);
											echo $output;
										}
						}
					}
			}
}
if(isset($_GET['mode']) AND $_GET['mode']=='deleteGroup'){
$delete=mysql_query("Delete from group_list where id='".$_GET['id']."'");
	if($delete){
			$deleteusers=mysql_query("Delete from group_userlist where groupid='".$_GET['id']."'");
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
if(isset($_GET['mode']) AND $_GET['mode']=='create_discussion'){
	if($_GET['id']==0){
			 $selectGroup=mysql_query("select id from place_of_discussion where place='".$_POST['place']."'");
				$num=mysql_num_rows($selectGroup);
				if($num>0){
					$val = array("success" => "no","status" =>"exist");
														$output = json_encode($val);
														echo $output;
				}
				else{
				$in="INSERT INTO `place_of_discussion` (
									`id` ,
									`place` ,
									`description` ,
									`userid` ,
									`date`
									)
									VALUES (
									NULL ,'".$_POST['place']."','".$_POST['p_desc']."','".$_SESSION['userid']."','".date("y/m/d")."'
									)";
									$insert=mysql_query($in);
					$placeid=mysql_insert_id();
					$selectuser=mysql_query("select name,last_name,email from users where userid='".$_SESSION['userid']."'");
					if($userdata=mysql_fetch_array($selectuser)){
					if($userdata['last_name']!='')
					$full_name=$userdata['name'].' '.$userdata['last_name'];
					else
					$full_name=$userdata['name'];
					$insert_place=mysql_query("INSERT INTO `discussionplace_userlist` (`id` ,`name` ,`placeid`,`emailid`,`owner_id`,`userid`)
					VALUES (NULL ,'".$full_name."','".$placeid."','".$userdata['email']."','".$_SESSION['userid']."','".$_SESSION['userid']."')");
								if($insert_place){
											$val = array("success" => "yes","status" =>$insert,"place"=>$placeid);
											$output = json_encode($val);
											echo $output;
										}
								else{
											$val = array("success" => "no","status" =>$in);
											$output = json_encode($val);
											echo $output;
							}
										}
				}
		}
	else{
		$update=mysql_query("Update place_of_discussion set place='".$_POST['place']."',description='".$_POST['p_desc']."' where id=".$_GET['id']);
		if($update){
			//$selectplaceid="";
											$val = array("success" => "yes","status" =>"updated","place"=>$_GET['id']);
											$output = json_encode($val);
											echo $output;
										}
								else{
											$val = array("success" => "no","status" =>"0");
											$output = json_encode($val);
											echo $output;
							}
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='deletePlace'){
$delete=mysql_query("Delete from place_of_discussion where id='".$_GET['id']."'");
	if($delete){
		$deletepodUsers=mysql_query("Delete from  discussionplace_userlist where placeid='".$_GET['id']."'");
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
if(isset($_GET['mode']) AND $_GET['mode']=='saveGroup'){
	$userid=$_GET['userid'];
	if(isset($userid) && $userid==0){
		if(isset($_POST['email']) && $_POST['email']!='')
		{
			$selecexistuser=mysql_query("SELECT count(*) as cnt from group_userlist where emailid='".$_POST['email']."'AND groupid='".$_POST['group']."'");
			$r=mysql_fetch_array($selecexistuser);
			if($r['cnt']>0){
				$val = array("success" => "no","status" =>"exist");
								$output = json_encode($val);
								echo $output;
								exit();
			}
		}
		$selectexistname=mysql_query("SELECT count(*) as cnt from group_userlist
		   where name='".addslashes($_POST['name'])."' AND groupid='".$_POST['group']."'");
			if($r_name=mysql_fetch_array($selectexistname)){
					if($r_name['cnt']>0){
						$val = array("success" => "no","status" =>"existname");
										$output = json_encode($val);
										echo $output;
										exit();
					}
			}
	}
	if(isset($userid) && $userid!=0)
		{
		   $selectuserData=mysql_query("select name,last_name,email from users where userid=".$userid);
		   if($row_user=mysql_fetch_array($selectuserData)){
				$selecexistuser=mysql_query("SELECT count(*) as cnt from group_userlist where
				emailid='".$row_user['email']."'AND groupid='".$_POST['group']."'");
				$r=mysql_fetch_array($selecexistuser);
				if($r['cnt']>0){
					$val = array("success" => "no","status" =>"exist");
									$output = json_encode($val);
									echo $output;
									exit();
				}
			else{
				$name=$row_user['name'].' '.$row_user['last_name'];
				$in="INSERT INTO `group_userlist` (`id` ,`name` ,`groupid`,`emailid` ,`userid`,`owner_id`)
				VALUES (NULL ,'".$name."','".$_POST['group']."','".$row_user['email']."',".$userid.",".$_SESSION['userid'].")";
			}
			}
		}
		else{ if(!isset($userid)) $userid=0;
			$in="INSERT INTO `group_userlist` (`id` ,`name` ,`groupid`,`emailid` ,`userid`,`owner_id`)
			VALUES (NULL ,'".$_POST['name']."','".$_POST['group']."','".$_POST['email']."',".$userid.",".$_SESSION['userid'].")";
		}
							$insert=mysql_query($in);
						$groupuserlistid=mysql_insert_id();
					if($insert){
						$groupid=$_POST['group'];
						if($userid!=''){
						 $insertNotify=mysql_query("Insert into notifications(notify_id,notification_on,userid,date,read_status)
							Values('".$groupuserlistid."','add-to-group','".$userid."','". date("Y-m-d")."',0)");
						}
						$val = array("success" => "yes","status" =>$insert,"group"=>$groupid);
						$output = json_encode($val);
						echo $output;
					}
					else{
						$val = array("success" => "no","status" =>"");
						$output = json_encode($val);
						echo $output;
					}
}
if(isset($_GET['mode']) AND $_GET['mode']=='saveDiscussionUser'){
    $userid=$_GET['userid'];
    if(isset($userid) && $userid==0)
    {
        if(isset($_POST['email']) && $_POST['email']!='')
	{
            $selecexistuser=mysql_query("SELECT count(*) as cnt from discussionplace_userlist where emailid='".$_POST['email']."' AND placeid='".$_POST['places']."'");
            $r=mysql_fetch_array($selecexistuser);
            if($r['cnt']>0)
            {
                $val = array("success" => "no","status" =>"exist");
		$output = json_encode($val);
		echo $output;
		exit();
            }
	}
        $selectexistname=mysql_query("SELECT count(*) as cnt from discussionplace_userlist where name='".$_POST['name']."' AND placeid='".$_POST['places']."'");
	if($r_name=mysql_fetch_array($selectexistname))
        {
            if($r_name['cnt']>0)
            {
                $val = array("success" => "no","status" =>"existname");
		$output = json_encode($val);
		echo $output;
		exit();
            }
	}
    }
		if(isset($userid) && $userid!=0)
			{
			   $selectuserData=mysql_query("select name,last_name,email from users where userid=".$userid);
			   if($row_user=mysql_fetch_array($selectuserData)){
					$selecexistuser=mysql_query("SELECT count(*) as cnt from discussionplace_userlist where emailid='".$row_user['email']."'
													AND placeid='".$_POST['places']."'");
					$r=mysql_fetch_array($selecexistuser);
					if($r['cnt']>0){
						$val = array("success" => "no","status" =>"exist");
										$output = json_encode($val);
										echo $output;
										exit();
					}
				else{
					$name=$row_user['name'].' '.$row_user['last_name'];
					$in="INSERT INTO `discussionplace_userlist` (`id` ,`name` ,`placeid`,`emailid` ,`userid`,`owner_id`)
					VALUES (NULL ,'".$name."','".$_POST['places']."','".$row_user['email']."',".$userid.",".$_SESSION['userid'].")";
				}
				}
			}
			else{
	               if(!isset($userid)) $userid=0;
					$in="INSERT INTO `discussionplace_userlist` (`id` ,`name` ,`placeid`,`emailid`,`userid` ,`owner_id`)
					VALUES (NULL ,'".$_POST['name']."','".$_POST['places']."','".$_POST['email']."',".$userid.",".$_SESSION['userid'].")";
				}
					$insert=mysql_query($in);
					$placelistid=mysql_insert_id();
					if($insert){
						 if($userid!=''){
						 $insertNotify=mysql_query("Insert into notifications(notify_id,notification_on,userid,date,read_status)
							Values('".$placelistid."','add-to-pod','".$userid."','". date("Y-m-d")."',0)");
						}
					    $placeid=$_POST['places'];
						$val = array("success" => "yes","status" =>$insert,"place"=> $placeid);
						$output = json_encode($val);
						echo $output;
					}
					else{
						$val = array("success" => "no","status" =>$insert);
						$output = json_encode($val);
						echo $output;
					}
}
if(isset($_GET['mode']) AND $_GET['mode']=='change-pw'){
	$select="SELECT * FROM users WHERE  userid='".$_SESSION['userid']."' AND password= md5('".$_POST['oldpw']."') ";
	$sql=mysql_query("SELECT * FROM users WHERE  userid='".$_SESSION['userid']."' AND password= md5('".$_POST['oldpw']."') ");
	$row=mysql_num_rows($sql);
	if($row){
		if($_POST['newpw']==$_POST['confirm_pw']){
	 	$update=mysql_query("Update users set password=md5('".$_POST['newpw']."') where userid='".$_SESSION['userid']."'");
		if($update){
			$val = array("success" => "yes","status" =>$update);
						$output = json_encode($val);
						echo $output;
		}
		else{
			$val = array("success" => "no","status" =>$update);
						$output = json_encode($val);
						echo $output;
		}
	 }
	 else{
	 	$val = array("success" => "no","status" =>"mismatch");
						$output = json_encode($val);
						echo $output;
	 }
	}
	else{
		$val = array("success" => "no","status" =>"incorrect");
						$output = json_encode($val);
						echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='update_tags'){
   $tag_value   = $_GET['value'];
   $select=mysql_query("select search_tags from users where userid='".$_SESSION['userid']."'");
   $rowtag=mysql_fetch_array($select);
   $stag=explode(',', $rowtag['search_tags']);
   $count_tag=count($stag);
   for($i=0;$i<$count_tag;$i++){
   	if($stag[$i]!=''){
            $stag_name="'".$stag[$i]."'";
            if($stag[$i]==$_POST['tagList']){
                $val = array("success" => "no","status" =>exist);
		$output = json_encode($val);
		echo $output;
		exit();
            }
  	 }
   }
   $new_tag= $rowtag['search_tags'].','.$_POST['tagList'];
   $update=mysql_query("Update users set  search_tags='".$new_tag."' where userid='".$_SESSION['userid']."'");
   if($update){
       $query = mysql_query("SELECT search_tags FROM users where userid='".$_SESSION['userid'] ."'");
       $tag_list='';
       if($row=mysql_fetch_array($query)){
           $tag=$row['search_tags'];
       }
       $tag = explode(',',$tag);
       $count = count($tag);
       for($i=0;$i<$count;$i++){
           if($tag[$i]!=''){
               $tag_name="'".$tag[$i]."'";
               $class   = "class_".$tag_name;
               $tag_list.= '<div class="tag-name-main">
                                <div class="tag-name">'.$tag[$i].'</div>
                                <input type="hidden" value="'.$tag_value.'" class="'.$class.'">
				<div class="close-btn">
                                    <a href="javascript:void(0);" onclick="deleteTag('.$tag_name.')">
                                        <img src="'.$base_url.'images/close-btn.jpg" width="15" height="15" alt="close-btn">
                                    </a>
				</div>
                            </div>';
            }
	}
	$val = array("success" => "yes","status" =>$update,"html"=>$tag_list);
	$output = json_encode($val);
	echo $output;
    }
    else{
        $val = array("success" => "no","status" =>$update);
	$output = json_encode($val);
	echo $output;
    }
}
if(isset($_GET['mode']) AND $_GET['mode']=='delete_tag'){
   $select=mysql_query("select search_tags from users where userid='".$_SESSION['userid']."'");
   if($rowtag=mysql_fetch_array($select)){
   	$tag=$rowtag['search_tags'];
   }
   $tag=explode(',',$tag);
   $arr_tag = array_diff($tag,array($_GET['tagname']));
   $tag_new=implode(',',$arr_tag );
	$update=mysql_query("Update users set  search_tags='".$tag_new."' where userid='".$_SESSION['userid']."'");
	if($update){
			$query = mysql_query("SELECT search_tags FROM users where userid='".$_SESSION['userid'] ."'");
		$tag_list='';
		if($row=mysql_fetch_array($query)){
			$tag=$row['search_tags'];
		}
		$tag=explode(',',$tag);
		$tag_list='';
		$count=count($tag);
		for($i=0;$i<$count;$i++){
			if($tag[$i]!=''){
			 	$tag_name="'".$tag[$i]."'";
				$tag_list.='<div class="tag-name-main">
								 <div class="tag-name">'.$tag[$i].'</div>
								 <div class="close-btn"><a href="javascript:void(0);" onclick="deleteTag('.$tag_name.')">
										<img src="'.$base_url.'images/close-btn.jpg" width="15" height="15" alt="close-btn"></a>
								 </div>
						 </div>';
			}
		}
			$val = array("success" => "yes","status" =>$update,"html"=>$tag_list);
						$output = json_encode($val);
						echo $output;
		}
		else{
			$val = array("success" => "no","status" =>$update);
						$output = json_encode($val);
						echo $output;
		}
}
if(isset($_GET['mode']) AND $_GET['mode']=='listUsers'){
	$name=$_POST['name'];
	$first_name='';
	$last_name='';
	$name_array=explode(' ',$name);
	$first_name=$name_array[0];
	$last_name=$name_array[1];
	$selectQuery=mysql_query("select * from users where name='".$first_name."' and last_name='".$last_name."' or name='".$name."'");
	//echo "select * from users where name='".$first_name."' and last_name='".$last_name."'";
	 $html='';
	 $num=mysql_num_rows($selectQuery);
	if($num>0) {
	       $html.='<div  id="close_list" onclick="closeUserlist();">
								<img src="'.$base_url.'images/close_icon2.png" alt="close"/>
					</div>
					<h3 >
					Find out if the user is already in Tellitize
					<span style="float:right;margin-right:150px;">
					<a href="javascript:void(0)" onclick="saveGroup(0);" class="skip_step">Skip</a>
					</span>
					</h3>
					<div id="user_list_content">
					<input type="hidden" id="group_id" name="group_id" value="'.$_POST['group'].'">';
					//echo "select * from users where name='".$first_name."' and last_name='".$last_name."'";
			while($row=mysql_fetch_array($selectQuery)){
				$full_name=$row['name'].' '.$row['last_name'];
				if($row['profile_img']=='') {
					$pic='<img  alt="user-pic" src="'.$base_url.'images/user-photo.jpg" width="39" height="42"/>';
					}
				else {
					$pic='<img  alt="user photo" src="'.$base_url.'/ajax/uploads/'.$row['profile_img'].'"  width="39" height="42"/>';
				}
				$details='';
				if($row['city']!=''){$details=$sep.'City:'.$row['city'];}
				//if($row['location']!=''){$details.='Location: '.$row['location'];}
				if($details!='') $sep=',';
				if($row['state']!=''){$details.=$sep.'State:'.$row['state'];}
				if($row['college']!=''){$details.=$sep.'College:'.$row['college'];}
				if($row['age']!='' & $row['age']!=0){$details.=$sep.'Age:'.$row['age'];}
				$html.='<div class="user_list"'.$row['userid'].' id="user_list">
				            <div class="user_pic">'.$pic.'</div>
							<div class="user_details">
								<div id="name_user">'.$full_name.'</div>
								<div>'.$details.'</div>
							</div>
							<div class="selectUser'.$row['userid'].'" id="selectUser">
								<a href="javascript:void(0)" onclick="saveGroup('.$row['userid'].');" class="add-btn">
								 ADD
								 </a>
							</div>
						</div>';
			}
			$html.='</div>';
			$val = array("success" => "yes","status" =>"select * from users where name='".$first_name."' and last_name='".$last_name."'","html"=>$html);
									$output = json_encode($val);
									echo $output;
	}
	else{
		$val = array("success" => "no","status" =>"0");
						$output = json_encode($val);
						echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='listPodUsers'){
	$name=$_POST['name'];
	$first_name='';
	$last_name='';
	$name_array=explode(' ',$name);
	$first_name=$name_array[0];
	$last_name=$name_array[1];
	$selectQuery=mysql_query("select * from users where name='".$first_name."' and last_name='".$last_name."' or name='".$name."'");
	//echo "select * from users where name='".$first_name."' and last_name='".$last_name."'";
	 $html='';
	 $num=mysql_num_rows($selectQuery);
	if($num>0) {
	       $html.='<div  id="close_list" onclick="closePODlist();">
								<img src="'.$base_url.'images/close_icon2.png" alt="close"/>
					</div>
					<h3 >
					Find out if the user is already in Tellitize
					<span style="float:right;margin-right:150px;">
					<a href="javascript:void(0)" onclick="saveDiscussionUser(0);" class="skip_step">Skip</a>
					</span>
					</h3>
					<div id="user_list_content">';
					//echo "select * from users where name='".$first_name."' and last_name='".$last_name."'";
			while($row=mysql_fetch_array($selectQuery)){
				$full_name=$row['name'].' '.$row['last_name'];
				if($row['profile_img']=='') {
					$pic='<img  alt="user-pic" src="'.$base_url.'images/user-photo.jpg" width="39" height="42"/>';
					}
				else {
					$pic='<img  alt="user photo" src="'.$base_url.'/ajax/uploads/'.$row['profile_img'].'"  width="39" height="42"/>';
				}
				$details='';
				//if($row['location']!=''){$details.='Location: '.$row['location'];}
				if($row['city']!=''){$details.=$sep.'City:'.$row['city'];}
				if($details!='') $sep=',';
				if($row['state']!=''){$details.=$sep.'State:'.$row['state'];}
				if($row['college']!=''){$details.=$sep.'College:'.$row['college'];}
				if($row['age']!='' & $row['age']!=0){$details.=$sep.'Age:'.$row['age'];}
				$html.='<div class="user_list"'.$row['userid'].' id="user_list">
				            <div class="user_pic">'.$pic.'</div>
							<div class="user_details">
								<div id="name_user">'.$full_name.'</div>
								<div>'.$details.'</div>
							</div>
							<div class="selectUser'.$row['userid'].'" id="selectUser">
								<a href="javascript:void(0)" onclick="saveDiscussionUser('.$row['userid'].');" class="add-btn">
								 ADD
								 </a>
							</div>
						</div>';
			}
			$html.='</div>';
			$val = array("success" => "yes","status" =>"select * from users where name='".$first_name."' and last_name='".$last_name."'","html"=>$html);
									$output = json_encode($val);
									echo $output;
	}
	else{
		$val = array("success" => "no","status" =>"0");
						$output = json_encode($val);
						echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='discardGroupUser'){
	$delete=mysql_query("delete from notifications where id=".$_GET['id']);
	if($delete){
		$delete_details=mysql_query("delete from notification_for_group_or_pod where notification_id=".$_GET['id']);
		$val = array("success" => "yes","status" =>$delete);
						$output = json_encode($val);
						echo $output;
	}
	else{
		$val = array("success" => "no","status" =>"0");
						$output = json_encode($val);
						echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='approveGroupUser'){
	$select=mysql_query("select userlist_id from notification_for_group_or_pod where notification_id=".$_GET['id']);
	//echo "select userlist_id from notification_for_group_or_pod where notification_id=".$_GET['id'];
	if($row=mysql_fetch_array($select)){
	    $selectgroup_userlist=mysql_query("select userid from group_userlist where id=".$row['userlist_id']);
		$r_userid=mysql_fetch_array($selectgroup_userlist);
		if($r_userid['userid']==0)
		{
		$updategroupUser=mysql_query("update group_userlist set userid=".$_GET['userid']." where id=".$row['userlist_id']);
		//echo "update group_userlist set userid=".$_GET['userid']." where id=".$row['userlist_id'];
		$selectOthernotifications=mysql_query("select notification_id from notification_for_group_or_pod where userlist_id=".$row['userlist_id']);
		while($row_other=mysql_fetch_array($selectOthernotifications)){
			$delete=mysql_query("delete from notifications where id=".$row_other['notification_id']);
			$delete_details=mysql_query("delete from notification_for_group_or_pod where notification_id=".$row_other['notification_id']);
		}
			$val = array("success" => "yes","status" =>$updategroupUser);
						$output = json_encode($val);
						echo $output;
		}
		else{
			$val = array("success" => "no","status" =>"exist");
						$output = json_encode($val);
						echo $output;
		}
	}
	else{
		$val = array("success" => "no","status" =>"0");
						$output = json_encode($val);
						echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='discardPodUser'){
	$delete=mysql_query("delete from notifications where id=".$_GET['id']);
	if($delete){
		$delete_details=mysql_query("delete from notification_for_group_or_pod where notification_id=".$_GET['id']);
		$val = array("success" => "yes","status" =>$delete);
						$output = json_encode($val);
						echo $output;
	}
	else{
		$val = array("success" => "no","status" =>"0");
						$output = json_encode($val);
						echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='approvePodUser'){
	$select=mysql_query("select userlist_id from notification_for_group_or_pod where notification_id=".$_GET['id']);
	if($row=mysql_fetch_array($select)){
	    $selectgroup_userlist=mysql_query("select userid from discussionplace_userlist where id=".$row['userlist_id']);
		$r_userid=mysql_fetch_array($selectgroup_userlist);
		if($r_userid['userid']==0)
		{
		$updategroupUser=mysql_query("update discussionplace_userlist set userid=".$_GET['userid']." where id=".$row['userlist_id']);
		$selectOthernotifications=mysql_query("select notification_id from notification_for_group_or_pod where userlist_id=".$row['userlist_id']);
		while($row_other=mysql_fetch_array($selectOthernotifications)){
			$delete=mysql_query("delete from notifications where id=".$row_other['notification_id']);
			$delete_details=mysql_query("delete from notification_for_group_or_pod where notification_id=".$row_other['notification_id']);
		}
			$val = array("success" => "yes","status" =>$updategroupUser);
						$output = json_encode($val);
						echo $output;
		}
		else{
			$val = array("success" => "no","status" =>"exist");
						$output = json_encode($val);
						echo $output;
		}
	}
	else{
		$val = array("success" => "no","status" =>"0");
						$output = json_encode($val);
						echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='searchEmail'){
	$selectEmail=mysql_query("select userid,password,user_name,reg_status from users where email='".$_GET['email']."' and reg_status=0");
	if($selectEmail){
		$row=mysql_fetch_array($selectEmail);
		 $newpw= mb_substr($row['password'], 0, 5);
		 $updatePw=mysql_query("Update users set password=md5('".$newpw."') where userid='".$row['userid']."'");
		 if($updatePw){
			$to=$_GET['email'];
			$subject='Tellitize- Reset Password';
			$msg='<a href="'.$base_url.'" title="tellitize.com" >
                   					 <img border="0" alt="tellitize.com" src="'.$base_url.'images/tellitizeLogo.png">
								 </a>
								<p style="font:14px arial;line-height:20px;">Tellitize reset your password.Now login with the new password.
								 </p>
								 <p>Username:'.$row['user_name'].'</p>
								 <p>Password:'.$newpw.'</p>
								<p><b>Tellitize Support Team</b></p>';
			$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers.= "From: info@tellitize.com" ;
			if(mail($to,$subject,$msg ,$headers)){
									$insert=mysql_query("INSERT INTO `mail_status` (`userid`,`emailid`,`purpose`)
									VALUES ('".$row['userid']."','".$_GET['email']."','reset-password')");
									if($insert) $mailsuccess='mailsent';
									$val = array("success" => "yes","status" =>$mailsuccess);
									$output = json_encode($val);
									echo $output;
								}
								else{
									$val = array("success" => "no","status" =>"mailfailed");
									$output = json_encode($val);
									echo $output;
								}
		}
		else{
			$val = array("success" => "no","status" =>"notexist");
									$output = json_encode($val);
									echo $output;
		}
	}
	else{
		$val = array("success" => "no","status" =>"0");
									$output = json_encode($val);
									echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='joinGroup'){
	$select=mysql_query("select id from group_userlist where groupid=".$_GET['id']. " and userid='".$_SESSION['userid']."'");
	$num=mysql_num_rows($select);
	if($num>0){
		$val = array("success" => "no","status" =>"exist");
									$output = json_encode($val);
									echo $output;
	}
	else{
	 $selectuserData=mysql_query("select name,last_name,email from users where userid=".$_SESSION['userid']);
	 $row_user=mysql_fetch_array($selectuserData);
	 $name=$row_user['name'].' '.$row_user['last_name'];
	 $insert=mysql_query("INSERT INTO `group_userlist` (`id` ,`name` ,`groupid`,`emailid` ,`userid`,`owner_id`)
				VALUES (NULL ,'".$name."','".$_GET['id']."','".$row_user['email']."',".$_SESSION['userid'].",".$_SESSION['userid'].")");
				$groupuserlistid=mysql_insert_id();
	 if($insert){
	    $selOwner=mysql_query("select userid from group_list where id=".$_GET['id']);
		$resowner=mysql_fetch_array( $selOwner);
		$group_ownerid=$resowner['userid'];
	    $insertNotify=mysql_query("Insert into notifications(notify_id,notification_on,userid,date,read_status)
							Values('".$groupuserlistid."','join-group','".$group_ownerid."','". date("Y-m-d")."',0)");
	 	$select_grp=mysql_query("select id,group_name from group_list where id=".$_GET['id']);
		if($r_group_name=mysql_fetch_array($select_grp)){
		$group_name = str_replace(" ","-",$r_group_name['group_name']);
   		 $group_name =preg_replace("![^a-z0-9]+!i", "-",$group_name);
		 }
	 	$val = array("success" => "yes","status" =>"1","redirect_link"=>$group_name);
									$output = json_encode($val);
									echo $output;
	 }
	 else{
	 	$val = array("success" => "no","status" =>"1");
									$output = json_encode($val);
									echo $output;
	 }
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='joinPod'){
	$select=mysql_query("select id from discussionplace_userlist where  placeid=".$_GET['id']. " and userid='".$_SESSION['userid']."'");
	$num=mysql_num_rows($select);
	if($num>0){
		$val = array("success" => "no","status" =>"exist");
									$output = json_encode($val);
									echo $output;
	}
	else{
	 $selectuserData=mysql_query("select name,last_name,email from users where userid=".$_SESSION['userid']);
	 $row_user=mysql_fetch_array($selectuserData);
	 $name=$row_user['name'].' '.$row_user['last_name'];
	$insert=mysql_query("INSERT INTO `discussionplace_userlist` (`id` ,`name` ,`placeid`,`emailid` ,`userid`,`owner_id`)
					VALUES (NULL ,'".$name."','".$_GET['id']."','".$row_user['email']."',".$_SESSION['userid'].",".$_SESSION['userid'].")");
	$poduserlistid=mysql_insert_id();
	 if($insert){
	    $selOwner=mysql_query("select userid from place_of_discussion where id=".$_GET['id']);
		$resowner=mysql_fetch_array( $selOwner);
		$pod_ownerid=$resowner['userid'];
	    $insertNotify=mysql_query("Insert into notifications(notify_id,notification_on,userid,date,read_status)
							Values('".$poduserlistid."','join-pod','".$pod_ownerid."','". date("Y-m-d")."',0)");
		$selectpod=mysql_query("select id,place from place_of_discussion where id=".$_GET['id']);
		if($row_pod=mysql_fetch_array($selectpod)){
			$place = str_replace(" ","-",$row_pod['place']);
			$place =preg_replace("![^a-z0-9]+!i", "-",$place);
		}
	 	$val = array("success" => "yes","status" =>"1","redirect_link"=>$place);
									$output = json_encode($val);
									echo $output;
	 }
	 else{
	 	$val = array("success" => "no","status" =>"1");
									$output = json_encode($val);
									echo $output;
	 }
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='deleteGroupUser'){
	$delete=mysql_query("delete from group_userlist where id=".$_GET['id']);
	if($delete){
		$val = array("success" => "yes","status" =>"1","listid"=>$_GET['id']);
										$output = json_encode($val);
										echo $output;
	}
	else{
		$val = array("success" => "no","status" =>"0");
									$output = json_encode($val);
									echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='delPodUser'){
	$delete=mysql_query("delete from discussionplace_userlist where id=".$_GET['id']);
	if($delete){
		$val = array("success" => "yes","status" =>"1","listid"=>$_GET['id']);
										$output = json_encode($val);
										echo $output;
	}
	else{
		$val = array("success" => "no","status" =>"0");
									$output = json_encode($val);
									echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='searchGroupUsers'){
	$group_userid='';
	$query_groupUserid = mysql_query("SELECT userid from group_list where id=".$_GET['id']);
		if($row_groupUserid=mysql_fetch_array($query_groupUserid)){
			$groupUserid=$row_groupUserid['userid'];
		}
	if($groupUserid==$_SESSION['userid']) $delete=1;
	else $delete=0;
		if(isset($_GET['name']) && $_GET['name']!='')
		$query =mysql_query("SELECT id,name,emailid,userid from group_userlist where groupid=".$_GET['id']." and name Like '".$_GET['name']."%' order by  id ");
		else
		$query =mysql_query("SELECT id,name,emailid,userid from group_userlist where groupid=".$_GET['id']."  order by  id ");
		if($query)
		{
		   $html='<ul>';
			while($row=mysql_fetch_array($query))
				{
				$group_username="'".$row['name']."'";
				$full_name=$row['name'];
				$group_useremail="'".$row['emailid']."'";
				if($row['emailid']!='') {
						$user_link='javascript:void(0)';
						$query_user = mysql_query("SELECT userid,name from  users where email='".$row['emailid']."'");
						 //if ($query_user->num_rows()){
								if($user=mysql_fetch_array($query_user)){
									$userid=$user['userid'];
									$queryName = mysql_query("SELECT name,last_name from users where userid='".$userid."'");
									if($p_row=mysql_fetch_array($queryName)){
									   {
										if($p_row['last_name']!='')
										$name_link=$p_row['name'].' '.$p_row['last_name'];
										else
										 $name_link=$p_row['name'];
										}$full_name=$name_link;
										$name_link= str_replace(" ","-",$name_link);
								}
								}
								$user_link=$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$userid;
							//}
							//else{
								//$user_link='javascript:void(0)';
							 //}
					}
						else{
								$user_link='javascript:void(0)';
							 }
				if($full_name=='') $full_name=$row['name'];
				 $html.='<li id="groupuserlist_'.$row['id'].'" class="'.$row['id'].'">
								<a href="'.$user_link.'" class="userlist">'.$full_name.'</a>
								<div style="float:right">';
								if($delete==1 && $row['userid']!=$_SESSION['userid']){
				 			    	$html.='<a style="float:left;margin-right:5px" href="javascript:void(0);" onclick="delGroupUser('.$row['id'].');">
												<img width="10" height="10" alt="del" src="'.$GLOBALS['base_url'].'images/del.jpg" >
											</a>';
								}
							    $html.='<a href="javascript:void(0)" class="postimg" onClick="showPostArea('.$group_username.','.$group_useremail.');">
									<img width="16" height="16" alt="post" src="'.$base_url.'images/tellitize-small-logo.png" >
								</a>
								<a href="javascript:void(0)" class="postimg" onClick="showPostsAbout('.$group_username.','.$group_useremail.','.$_GET['id'].');">
									<img width="16" height="16" alt="view-post" src="'.$base_url.'images/post-icon.jpg" >
								</a>
							</div>
							</li>';
			 }
		$html.='<ul>';
		$val = array("success" => "yes","status" =>"1","html"=>$html);
										$output = json_encode($val);
										echo $output;
	}
	else{
		$val = array("success" => "no","status" =>"0","html"=>$html);
										$output = json_encode($val);
										echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='searchPodUsers'){
		$podUserid='';
	   $query_podUserid = mysql_query("SELECT userid from place_of_discussion where id=".$_GET['id']);
		if($row_podUserid=mysql_fetch_array($query_podUserid)){
			$podUserid=$row_podUserid['userid'];
		}
		if($podUserid==$_SESSION['userid']) $delete_podUser=1;
		else $delete_podUser=0;
		if(isset($_GET['name']) && $_GET['name']!='')
		$query =mysql_query("SELECT id,name,emailid,userid from discussionplace_userlist where placeid=".$_GET['id']." and name Like '".$_GET['name']."%' order by  id ");
		else
		$query = mysql_query("SELECT id,name,emailid,userid from discussionplace_userlist where placeid=".$_GET['id']);
		if($query)
		{
		    $html='<ul>';
			while($row=mysql_fetch_array($query))
				{
					$pod_username="'".$row['name']."'";
					$full_name=$row['name'];
					$pod_useremail="'".$row['emailid']."'";
					if($row['emailid']!='') {
						$user_link='javascript:void(0)';
						$query_user = mysql_query("SELECT userid,name from  users where email='".$row['emailid']."'");
						 //if ($query_user->num_rows()){
								if($user=mysql_fetch_array($query_user)){
									$userid=$user['userid'];
									$queryName = mysql_query("SELECT name,last_name from users where userid='".$userid."'");
									if($p_row=mysql_fetch_array($queryName)){
									   {
										if($p_row['last_name']!='')
										$name_link=$p_row['name'].' '.$p_row['last_name'];
										else
										 $name_link=$p_row['name'];
										}$full_name=$name_link;
										$name_link= str_replace(" ","-",$name_link);
								}
								}
								$user_link=$base_url.'view-profile/'.$name_link.'/'.$userid;
							//}
							//else{
								//$user_link='javascript:void(0)';
							 //}
					}
						else{
								$user_link='javascript:void(0)';
							 }
					if($full_name=='') $full_name=$row['name'];
					 $html.='<li id="poduserlist_'.$row['id'].'">
									<a href="'.$user_link.'" class="userlist">'.$full_name.'</a>
									<div style="float:right">';
									if($delete_podUser==1 && $row['userid']!=$_SESSION['userid']){
										$html.='<a style="float:left;margin-right:5px" href="javascript:void(0);" onclick="delPodUser('.$row['id'].');">
													<img width="10" height="10" alt="del" src="'.$base_url.'images/del.jpg" >
												</a>';
									}
									$html.='<a href="javascript:void(0)" class="postimg" onClick="showPostArea('.$pod_username.','.$pod_useremail.');">
										<img width="16" height="16" alt="post" src="'.$base_url.'images/tellitize-small-logo.png" >
									</a>
									<a href="javascript:void(0)" class="postimg" onClick="showPostsAbout('.$pod_username.','.$pod_useremail.','.$_GET['id'].');">
										<img width="16" height="16" alt="view-post" src="'.$base_url.'images/post-icon.jpg" >
									</a>
								</div>
								</li>';
				 }
			$html.='<ul>';
		  $val = array("success" => "yes","status" =>"1","html"=>$html);
										$output = json_encode($val);
										echo $output;
	 }
	else{
		$val = array("success" => "no","status" =>"0","html"=>$html);
										$output = json_encode($val);
										echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='check_email'){
	$sql=mysql_query("SELECT * FROM users WHERE email = '".$_GET['email']."'");
	$row=mysql_num_rows($sql);
	$result=mysql_fetch_array($sql);
	if($row){
		$val = array("success" => "yes");
		$output = json_encode($val);
		echo $output;
	}
	else{
		$val = array("success" => "no");
		$output = json_encode($val);
		echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='check_username'){
    $sql=mysql_query("SELECT * FROM users WHERE user_name='".addslashes($_GET['username'])."'");
    $row=mysql_num_rows($sql);
    $result=mysql_fetch_array($sql);
	if($row){
		$val = array("success" => "yes");
		$output = json_encode($val);
		echo $output;
	}
	else{
		$val = array("success" => "no");
		$output = json_encode($val);
		echo $output;
	}
}
if(isset($_GET['mode']) AND $_GET['mode']=='get_place_name_link'){
    $place_id    = $_GET['place_id'];
    $query  = mysql_query("SELECT place FROM place_of_discussion WHERE id = '".$place_id."'");
    $row    = mysql_fetch_array($query);
    //echo "<pre>";print_r($row);
    $place  = str_replace(" ","-",$row['place']);
    $place  = preg_replace("![^a-z0-9]+!i", "-",$place);
    echo $place;
}
