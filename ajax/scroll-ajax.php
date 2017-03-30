<?php
//error_reporting(0);
session_start();
require('config.php');
if(isset($_GET['mode']) AND $_GET['mode']=='getLastPosts'){
		$article_id='article';
		$last_post_id=$_GET['lastID'];
		if(isset($_SESSION['userid'])){
		if(isset($_GET['groupid'])){
			if(isset($_GET['name']) && $_GET['name']!=' '){
			if($_GET['email']!='') $emailchek="OR email='".$_GET['email']."'"; else $emailchek='';
				$select=mysql_query("SELECT * FROM public_post where postid <".$last_post_id. " and postid not in 
							(SELECT postid FROM report_abused_list 
							where userid =".$_SESSION['userid'].") And postid in(select postid from post_details where first_name='".$_GET['name']."' ".$emailchek." 
							) AND  group_id=".$_GET['groupid']." and status=0 order by  postid desc limit 10
							");
							
			}
			else {
							$select=mysql_query("SELECT * FROM public_post where postid <".$last_post_id. " and postid not in 
							(SELECT postid FROM report_abused_list 
							where userid =".$_SESSION['userid'].") AND  group_id=".$_GET['groupid']." and status=0 order by  postid desc limit 10
							");
			}				
			$article_id='group_article';
			$reply_comment_class='class="group_reply_comment"';
			$people_agree='Agree';
			$people_disagree='DisAgree';
			}
		 else if(isset($_GET['placeid'])){
		 	if(isset($_GET['name']) && $_GET['name']!=' '){
			if($_GET['email']!='') $emailchek="OR email='".$_GET['email']."'"; else $emailchek='';
				$select=mysql_query("SELECT * FROM public_post where postid <".$last_post_id. " and postid not in 
							(SELECT postid FROM report_abused_list 
							where userid =".$_SESSION['userid'].") And postid in(select postid from post_details where first_name='".$_GET['name']."' 
							".$emailchek.") AND  placeid=".$_GET['placeid']." order by  postid desc limit 10
							");
							
			}
			else {
							$select=mysql_query("SELECT * FROM public_post where postid <".$last_post_id. " and postid not in 
							(SELECT postid FROM report_abused_list 
							where userid =".$_SESSION['userid'].") AND  placeid=".$_GET['placeid']."  and status=0 order by  postid desc limit 10
							");
			}				
			$article_id='group_article';
			$reply_comment_class='class="group_reply_comment"';
			$people_agree='Agree';
			$people_disagree='DisAgree';
			}
			else{
			$select = mysql_query(
					"SELECT * FROM public_post where postid <".$last_post_id. " and postid not in 
					(SELECT postid FROM report_abused_list 
					  where userid =".$_SESSION['userid'].") AND  group_id=0 AND  placeid=0 and status=0 order by  postid desc limit 10
					");
			$article_id='article';
			$reply_comment_class='';
			$people_agree='Agree';
			$people_disagree='Disagree';
			}		
		}
		else{
		$select = mysql_query("SELECT * FROM public_post where postid <".$last_post_id."  AND  group_id=0 AND  placeid=0  and status=0 order by  postid desc limit 10");
		}
		
		if($select){
		   while($row=mysql_fetch_array($select)){
		   	$agreed='';
			$disagreed='';
			$agree_status='';
		   	 $selectuser=mysql_query("SELECT user_name,reg_status,name,last_name from users where userid='".$row['from']."'");
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
							
							$category=$postAbout['first_name'];
							
						}
						else $category='';
						
						
				}
				 $commentonpost=htmlspecialchars($row['comment']);
	       		if($category=='') $style='style="padding-top:6px"';
				else $style="";
				$category_link= str_replace(" ","-",$category);
				//if(isset($_SESSION['username'])) {
										$share_btncode='<div class="addthis_toolbox addthis_default_style " >

  										<a class="addthis_button"  href="javascript:void(0)" addthis:url="'.$base_url.'" 
										  addthis:title="'.$category.','.$commentonpost.'"  addthis:description=" '.$commentonpost.'">share</a>
								</div>';
						
			 //}
			$selectcat=mysql_query("select cate_name from category where cid in(select cid from public_post where postid=".$row['postid'].")");
									if($row_cat=mysql_fetch_array($selectcat)){					
									$cat_name = str_replace(" ","-",$row_cat['cate_name']);
									$cat_name = preg_replace("![^a-z0-9]+!i", "-",$cat_name );	
									}	
									$user_title='<a href="'.$GLOBALS['base_url'].''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'].'">'.$category.'</a>';					
									
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
				$html.='<div class="contents_list" id="'.$row['postid'].'">';
				if(isset($_SESSION['userid']) && $row['userid']==$_SESSION['userid']){
					$html.='<div class="delete-post'.$row['postid'].'" id="delete_post_icon" onclick="deleteOwnPost('.$row['postid'].')"> 
												<img src="'.$GLOBALS['base_url'].'images/close-btn.jpg" width="15" height="15" alt="delete" title="delete">
										</div>';
					}	
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

                                                                                                                    $html.=  '<div class="orangeButton"  id="btn'.$row['postid'].'">
                                                                                                                                <input type="button" id="agreebtn'.$row['postid'].'"'.$agree_click.' class="orangeButton-right" value="agree" '.$agreeClick.'>
                                                                                                                              </div>';
                                                                                                           }
                                                                                                           else { 
                                                                                                                    /*$html.='<div  class="agree-btn "  id="btn'.$row['postid'].'">'.$agreed.' </div>'; */
                                                                                                                    $html.='<div  class="disableButton"  id="btn'.$row['postid'].'">
                                                                                                                                <input type="button" id="agreebtn'.$row['postid'].'" class="disableButton-right" value="agree">
                                                                                                                            </div>'; 
                                                                                                           }

                                                                                                           if($disagreed==''){

                                                                                                                    /*$html.= ' <div  class="disagree-btn" id="btnd'.$row['postid'].'">
                                                                                                                                                    <a href="javascript:void(0)"' .$disagreeClick.'  id="disagreebtn'.$row['postid'].'"'.$disagree_click.' " class="able_disagree">disagree</a>
                                                                                                                                              </div>';*/
                                                                                                                    $html.=  '<div class="orangeButton"  id="btn'.$row['postid'].'">
                                                                                                                                <input type="button" id="disagreebtn'.$row['postid'].'" '.$disagree_click.' " class="orangeButton-right" value="disagree" '.$disagreeClick.'>
                                                                                                                              </div>';
                                                                                                           }
                                                                                                           else {
                                                                                                                    /*$html.='<div  class="disagree-btn" id="btnd'.$row['postid'].'">'.$disagreed.' </div>'; */
                                                                                                                    $html.='<div  class="disableButton"  id="btn'.$row['postid'].'">
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
														</a>';
                                                                                                                
                                                                                                                $post_link  = $GLOBALS['base_url'].$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'];
                                                                                                                //$post_button = "<a class='greyLeft_btn moreLink' href='".$post_link."'> More Options</a>"; //greyRight
                                                                                                                $post_button = '<input type="button" class="greyLeft_btn moreLink" value="More Options" onclick="more_link(\''.$post_link.'\');" />';
                                                                                                                
                                                                                                                $black_button_html = '';
                                                                                                                
                                                                                                                if(isset($_SESSION['userid']))
                                                                                                                {
                                                                                                                    if($row['from'] == 0)
                                                                                                                    {
                                                                                                                        $black_button_html= '<div class="black_button_home">
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
                                                                                                                        $black_button_html .= '<div class="black_button_home">
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
                                                                                                                        $black_button_html.= '<div class="black_button_home">
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
                                                                                                                    $black_button_html.= '<div class="black_button_home">
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
                                                                                                                $respond_html   = '<div id="grant_div_'.$row['postid'].'" style="display:none;" class="grant_div">
                                                                                                                                    <textarea id="grant_text_'.$row['postid'].'" name="grant" rows="3" cols="20"></textarea><br>
                                                                                                                                    <input type="button" class="signupOrange" name="grant_button" id="grant_button_'.$row['postid'].'" value="Submit">
                                                                                                                                    <input type="button" class="signupOrange" name="cancel_grant_button" id="cancel_grant_button_'.$row['postid'].'" value="Cancel">
                                                                                                                                    <input type="hidden" name="to_user" id="to_user_'.$row['postid'].'" value="'.$session_id.'">
                                                                                                                                    <input type="hidden" name="from_user" id="from_user_'.$row['postid'].'" value="'.$row['userid'].'">  
                                                                                                                                  </div>';
                                                                                                                $html .= '</div>'.$black_button_html .$respond_html.'</div></div>';
								
				if(isset($_SESSION['userid'])){
					//no: of comments
					$Countquery =mysql_query("SELECT count(*) as cnt FROM post_replies where postid='".$row['postid']."'");
					if ($row_count=mysql_fetch_array($Countquery) ) {	$count=$row_count['cnt']; }
					if($count>5) 
					{ $html.='<div class="view_all view_all'.$row['postid'].'"><a href="javascript:void(0)" onclick="viewreplies('.$row['postid'].');">View all '.$count.' comments</a></div>';}else{
						$html.='<div class="view_all view_all'.$row['postid'].'"></div>';
					}
				     //view comment
					 $selectreplies=mysql_query("SELECT * from post_replies where  postid='".$row['postid']."' order by id desc limit 5 ");
						$html.='<div class="viewList'.$row['postid'].'">';
						while($row1=mysql_fetch_array($selectreplies)){
						
						
						
							//delete link only for user who posts or replied
							$user_post=0;
							//if replied user
							$selectUserreply=mysql_query("SELECT userid from post_replies where  id='".$row1['id']."'");
							if($ruser_r=mysql_fetch_array($selectUserreply)){if($ruser_r['userid']==$_SESSION['userid']) $user_post=1;}
							
							//if posted user
							$selectUserpost=mysql_query("SELECT userid from public_post where 	postid='".$row['postid']."'");
							if($ruser_p=mysql_fetch_array($selectUserpost)){if($ruser_p['userid']==$_SESSION['userid']) $user_post=1;}
							if($user_post==1)
							$delete_link='  |   <span class="deletReply'.$row1['id'].'" href="javascript:void(0);">
							<a onclick="deleteReply('.$row1['id'].','.$row['postid'].');" href="javascript:void(0);">Delete </a>
							</span>';
							else 
							$delete_link='';
						
							//if replies 
							$agree_link=' <a onclick="agreeReply('.$row1['id'].');"  href="javascript:void(0);">Agree </a>';
							$disagree_link=' <a onclick="disagreeReply('.$row1['id'].');"  href="javascript:void(0);">Disgree </a>';
							$selectReplylikes = mysql_query("SELECT like_status from reply_likes where userid=".$_SESSION['userid']." and reply_id ='".$row1['id']."'");
							while($replyStatus=mysql_fetch_array($selectReplylikes)){
							
								   $like_status=$replyStatus['like_status'];
								   if($like_status==1){ $agree_link="<a>Agreed</a>";
								   }
								   else  if($like_status==0){ $disagree_link="<a>Disagreed</a>";
								   }
								}
					
							$usr_img='';
							$query = mysql_query("SELECT profile_img,name,last_name from users where userid='".$row1['userid']."'");
								if($p_row=mysql_fetch_array($query)){
								   {
									$usr_img=$p_row['profile_img'];
									if($p_row['last_name']!='')
									$name_link=$p_row['name'].' '.$p_row['last_name'];				
									else
									 $name_link=$p_row['name'];
									
									}
									$name_link= str_replace(" ","-",$name_link);
							}
							if($usr_img!='') {
							$userPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
							}
							else{
							$userPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';
							}
							$reply_agree_cnt=0;
							$reply_disagree_cnt=0;
							$selectreplyCnt = mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=1");
							$agreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_agree_cnt=$agreecnt['cnt'];
							
							$selectreplyCnt  =  mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=0");
							$dagreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_disagree_cnt=$dagreecnt['cnt'];
							$comment_replied= autolink($row1['comment'] );
							/*$html.='<div id="replyComment" '.$reply_comment_class.'>
								
									<div class=profilepicreply>									
									<a class="link_user" href="'.$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$row1['userid'].'">
									'.$userPic.'</a>
									</div>
									<div class="commentreplyview">'.$comment_replied.'</div>
									<div class="agreereplyCount" >
										 <div class="circle" id="agreereply_circle'.$row1['id'].'">'.$reply_agree_cnt.'</div>
													  <div class="people-agree">'.$people_agree.'</div>
													 <div class="circle" id="disagreereply_circle'.$row1['id'].'">'.$reply_disagree_cnt.'</div>
													<div class="people-agree">'.$people_disagree.'</div>
									</div>
									<div class="agreereply" >
									  <span class="agreeReply'.$row1['id'].'">'.$agree_link.'  </span> | 
									   <span class="disagreeReply'.$row1['id'].'">'.$disagree_link.' </span>	   '.
									   $delete_link.'
									</div>
									
									</div>		';*/
				}	
				$html.='</div>';		
				  //reply comment	
					/*$html.='<div id="replyComment">
                                                    <form name="replyPost" id="replyPost">
                                                        <div class=profilepicreply>'.$profilPic.'</div>
							<div class="commentreply">
                                                            <textarea class="input-tetlize commentreplyArea" name="commentreplyArea" id="commentreplyArea'.$row['postid'].'"></textarea>
                                                        </div>
							<div class="postreply" onclick="postReply('.$row['postid'].');">
                                                            <img src="'.$base_url.'images/comment.png" alt="comment" />
                                                        </div>
                                                    </form>	
						</div>';*/
					}	$html.='</div><div class="clear:both;" style="min-height:2px;">&nbsp;</div>';				
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


?>