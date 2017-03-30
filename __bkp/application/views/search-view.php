<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Tellitize</title>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/posts.css" rel="stylesheet" />
<style type="text/css">
ul.pagination1{
margin:0px;
padding:0px;

}
.searchresult-main{
	color:#000000;
	text-align:center;
	padding:0px 0px;
	font:12px arial;
	font-weight:normal;
}

</style>
</head>
<body>

<div id="header">
<?php $this->load->view('header'); $base_url=$GLOBALS['base_url'];?>
</div>


	<div id="mid_container">
		<div class="mid_content">
			<div class="left" >
			<div class="top_bar" style="margin-top:1px;margin-bottom:1px;">
							<div class="mypost_icon" style="float:left;margin-left:5px;"><span style="position:relative;top:10px;"><img width="27" height="32" alt="search" src="../images/search-top-icon.png"></span>
							<span style="font:14px arial;font-weight:normal;color:#666666;padding-top:-10px;">SEARCH</span>
							</div>
							
							<div class="user_group" style="float:right">
								<h3>SEND ANONYMOUS EMAILS</h3>
							</div>
						</div><!--top_bar-->
			<div class="post_area_bg" style="padding-top:0px;">
								<div class="orang_left"></div>
								<div class="orang_mid">
									<h4>SEARCH RESULT</h4>									
									</div>
								<div class="orang_rit"></div>
								
						</div>
				<div id="post_contents" >
				 
		          <ul class="pagination1">
			       
				   
				  <?php
				  $searh_common=0;
				  if($_GET['s_groups']!='' && $_GET['s_groups']!="GROUPS") {$searh_common=1;}
				  else if($_GET['s_pods']!='' && $_GET['s_pods']!='PODS') $searh_common=2;
				  else  $searh_common=0;
				
				  if($searh_common==0)
				  {
					   $selectpostlocation='';
						  $selectSearch='';
						  $search='';
						$search1="SELECT userid FROM users where status=1";
					     if(isset($_GET['s_first_name']) && $_GET['s_first_name']!='' && $_GET['s_first_name']!='FIRST NAME'){
						  $selectSearch.=" AND first_name LIKE '%".$_GET['s_first_name']."%' OR place LIKE '%".$_GET['s_first_name']."%' OR other_description LIKE '%".$_GET['s_first_name']."%'";
						  $search.=" AND name LIKE '".$_GET['s_first_name']."%'";
						  $scanComment=" OR comment LIKE '%".$_GET['s_first_name']."%'";
						
					  }
					  if(isset($_GET['s_last_name']) && $_GET['s_last_name']!='' && $_GET['s_last_name']!='LAST NAME'){
					     $selectSearch.="AND last_name='".$_GET['s_last_name']."'";	
					     if(isset($_GET['s_first_name']) && $_GET['s_first_name']!='' && $_GET['s_first_name']!='FIRST NAME'){
						 	$selectSearch.="OR first_name 	='".$_GET['s_first_name'].' '.$_GET['s_last_name']."' ";
						 }
						 					 
						 $search.=" AND name LIKE '%".$_GET['s_last_name']."' OR last_name LIKE '".$_GET['s_last_name']."%'";
						 $scanComment=" OR comment LIKE '%".$_GET['s_last_name']."%'";
					  }
					 
					  if(isset($_GET['s_location']) && $_GET['s_location']!='' && $_GET['s_location']!='LOCATION'){
						 $selectSearch.="AND place='".$_GET['s_location']."'";
						 $search.=" AND city='".$_GET['s_location']."'";
						 $scanComment=" OR comment LIKE '%".$_GET['s_location']."%'";
					  }
					  if(isset($_GET['s_age']) && $_GET['s_age']!='' && $_GET['s_age']!='AGE'){
						
						  $search.=" AND age='".$_GET['s_age']."'";
						  $scanComment=" OR comment LIKE '%".$_GET['s_age']."%'";
					  }
					   
					  if(isset($_GET['s_nick_name']) && $_GET['s_nick_name']!='' && $_GET['s_nick_name']!='NICK NAME'){
						$search.=" AND  nickname='".$_GET['s_nick_name']."'";
						$scanComment=" OR comment LIKE '%".$_GET['s_nick_name']."%'";
						  
					  }
					  if( $selectSearch!='')
					 $selectSearch="and postid in(SELECT postid FROM post_details where post_about!='' ".$selectSearch.")";
					if($search!=''){
					    if( $selectSearch!='') $command="OR"; else $command="AND";
						$search=$command." postid in (select postid from public_post where status=0 and `from`!=0 and userid in(".$search1.$search."))";
					}
					
					 $selectQuery=" SELECT * FROM public_post  where status=0 
					 ".$selectSearch." ".$search." ".$scanComment." order by postid desc ";
					// echo $selectQuery;
					  }
					  else{
					        if($searh_common==1){
							$selectQuery="select * from group_list where group_name LIKE '".$_GET['s_groups']."%'";
							}
							else{
								$selectQuery="select * from place_of_discussion where place LIKE '".$_GET['s_pods']."%'";
							}
						
						
						}
						
						//echo $selectSearch;
						$html='';$style="";
						
								$count=0;
							
								$select=mysql_query($selectQuery);
								$select_count=mysql_query($selectQuery);
								
								if($select_count){ 
									while($row_count=mysql_fetch_array($select_count))
									{$count++;
									}
								}
						
							?>
							 <div class="searchresult-main"><span class="orange"><?php echo $count;?></span> Result Found</div>
							<?php
							if($select){
							   while($row=mysql_fetch_array($select)){
							   
								$agreed='';
								$disagreed='';
								$agree_status='';
								if($searh_common==0)
								{
									 $selectuser=mysql_query("SELECT user_name from users where userid='".$row['from']."'");
									 $user=mysql_fetch_array($selectuser);
									if($row['from']=='' || $row['from']=='0')  $from='Anonymous';
									else 
									{	$from=$this->home_model->getFullName($row['from']);
									}
								}
								else{
									$from=$this->home_model->getFullName($row['userid']);
								}
								if($searh_common==0)
								{       $report_abuse='onclick="reportAbuse('.$row['postid'].');"';
										if(isset($_SESSION['username']) ){
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
													$profilPic='<img  alt="user photo" width="39" height="42" alt="user-img-small" class="bdr" src="'.$base_url.'/ajax/uploads/'.$profile_img.'" />';
												}
											else{$profilPic='<img  src="../images/user-photo.jpg" width="39" height="42" alt="user-img-small" class="bdr"/>';}
										}
										}
										else{
											$agreeClick='';
											$disagreeClick='';
											//$report_abuse='';
											$agree_click='';
											$disagree_click='';
										}
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
										$category='';
										$selectPostAbout = $this->db->query("SELECT * from post_details where  postid='".$row['postid']."'");
										foreach ($selectPostAbout->result_array() as $postAbout)
										{
											$about=$postAbout['post_about'];
											if($about=='person')
											$category=$postAbout['first_name']." ".$postAbout['last_name'];
											if($about=='place')
											$category=$postAbout['place'];
											if($about=='other')
											$category=$postAbout['other_description'];
											if($about=='group' || $about=='pod')					
					    				    $category=$postAbout['first_name'];
										}
									   if($category=='') $style='style="padding-top:6px"';
										else $style="";
										$category_link= str_replace(" ","-",$category);
								}
								if($searh_common==1){
									$user_title=$row['group_name'];
									$row['postid']=0;
									$style='style="width:100%"';
									if(isset($_SESSION['username'])) $joinfun='onclick="joinGroup('.$row['id'].');"';
									else $joinfun='onclick="notValidUser()"';
								}
								else if($searh_common==2){
									$user_title=$row['place'];
									$row['postid']=0;
									$style='style="width:100%"';
									if(isset($_SESSION['username'])) $joinfun='onclick="joinPod('.$row['id'].');"';
									else $joinfun='onclick="notValidUser()"';
								}
								else{
									//if(isset($_SESSION['username'])){
									   $cat_name = str_replace(" ","-",$this->home_model->getCategory($row['cid']));
									$cat_name = preg_replace("![^a-z0-9]+!i", "-",$cat_name );		
									$user_title='<a href="'.$GLOBALS['base_url'].''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'].'">'.$category.'</a>';
										
									//}
									//else  $user_title='<a href="javascript:void(0)" onClick="notValidUser();">'.$category.'</a>';
								}
									?>
									<li id="list_<?php echo $row['postid'];?>"><div id="article">
														<div class="post_user-main">
															<?php
															 if($searh_common==0)
															 echo '<div class="user_post-icon"></div>' ;
															 ?>
															<div class="userpost-name" <?php  if($searh_common>0) echo 'style="width:99%"';?>>
																 <div class="userpost-title"><?php echo $user_title;
																 
																 ?></div>
																<div class="user-post-id" <?php echo $style;?>>
                                                                <?php  if($searh_common==0) echo 'From:'; 
																else 
																{ echo 'Created by:'; 
																
																}?>
                                                                <span class="id-text"><?php echo $from ; ?></span>
                                                                <?php  if($searh_common>0){
																
                                                              //  if(isset($_SESSION['username']))
																echo '<form id="join_Group'.$row['id'].'" name="join_Group">
																<a href="javascript:void(0);" style="float:right;font-weight:bold" '.$joinfun.' >JOIN</a>
																</form>';
																
															   }
																?>
                                                                </div>
                                                                
															 </div>
                                                              <?php
															 if($searh_common==0){
															 ?>
																 <div class="userpost-city">Posted: <?php echo $date.','.$location; ?></div>
                                                             <?php } ?>
														 </div>
														
														
																<div class="postcontent-main">
																 <div class="postcontent">
																	  <?php
																	  	 if($searh_common==0){echo $row['comment'];}
																		 else echo $row['description'];
																	  ?>
																 </div>
									<?php							  
									}
											
									
								}
						//}		
					?>
		 </ul>

		 <div class="clearing"></div>
		</div> 
	
  </div>
 <?php
 	require("right-nav.php");
 ?>
</div>
</div>
</div>	
<div id="footer">
<?php $this->load->view('footer'); ?>
</div>
<script language="javascript">
function joinGroup(id){
$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=joinGroup&id="+id,
			cache: false,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {   
				
				//$('#post_contents').html('');
				//$('#post_contents').html(data.html);
				
				alert("Joined in the group");
				$("#join_Group"+id).attr("action","<?php echo $GLOBALS['base_url']; ?>"+data.redirect_link);
				$("#join_Group"+id).submit();
				}
				else if(data.status == "exist")
			  {   
				
				alert("You are already in the group")
				}
							
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}	
	function joinPod(id){
	$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=joinPod&id="+id,
			cache: false,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {   
				
				//$('#post_contents').html('');
				//$('#post_contents').html(data.html);
				
				alert("Joined in the POD");
				$("#join_Group"+id).attr("action","<?php echo $GLOBALS['base_url']; ?>"+data.redirect_link);
				$("#join_Group"+id).submit();
				}
				else if(data.status == "exist")
			  {   
				
				alert("You are already in the POD")
				}
							
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}	
function refreshPost(){
	        $('#post_contents').html('<p align="center"><img src="../images/ajax-loader.gif"  /></p>');
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=viewComment",
			cache: false,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {   
				
				$('#post_contents').html('');
				$('#post_contents').html(data.html);
				
				
				}
				else if(data.success == "no")
			    {    
					alert("failed to load");
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}	


function agreePost(id){
	        dataString='postid='+id+'&lik=1';
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=agreePost",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {   
				$('#agree_circle'+id).html('');
				$('#agree_circle'+id).html(data.agree);
				$('#disagree_circle'+id).html('');
				$('#disagree_circle'+id).html(data.disagree);
				$('#agreebtn'+id).hide();
				$('#agreebtn'+id).hide();
				$('#btn'+id).html("");
				$('#btn'+id).html('<a href="javascript:void(0)"  id="disagreebtn" class="disable_agree"></a>');
				$('#btnd'+id).html("");
				$('#btnd'+id).html('<a href="javascript:void(0)"  id="disagreebtn'+id+'" class="able_disagree" onclick="disagreePost('+id+')">disagree</a>');
				//$('#disagreebtn'+id).hide();
				
				}
				else if(data.success == "no")
			    {    
				    if(data.status=='liked'){
						alert("already agreed");
					}
					else{
					alert("failed to load");
					}
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}	
	function disagreePost(id){
	        dataString='postid='+id+'&lik=0';
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=agreePost",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				$('#agree_circle'+id).html('');
				$('#agree_circle'+id).html(data.agree);
				$('#disagree_circle'+id).html('');
				$('#disagree_circle'+id).html(data.disagree);
				//$('#agreebtn'+id).hide();
				//$('#disagreebtn'+id).hide();
				$('#btnd'+id).html("");
				$('#btnd'+id).html('<a href="javascript:void(0)"  id="disagreebtn" class="disable_disagree"></a>');
				$('#btn'+id).html("");
				$('#btn'+id).html('<a href="javascript:void(0)" id="agreebtn'+id+'" class="able_agree" onclick="agreePost('+id+')">agree</a>');
				
				}
				else if(data.success == "no")
			    {    
				    if(data.status=='liked'){
						alert("already disagreed");
					}
					else{
					alert("failed to load");
					}
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}
	
	
function postReply(id){
			//$('#post_contents').html('<p align="center"><img src="../images/ajax-loader.gif"  /></p>');
			if($.trim($('#commentreplyArea'+id).val()) == ""){
			$('#commentreplyArea'+id).css("border","1px solid red");			  
			 return false;
			 }
			 else{
				$('#commentreplyArea'+id).css("border","");	
			}
			var comment=$('#commentreplyArea'+id).val();
	        dataString='postid='+id+'&comment='+comment;
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=postReply",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {  
			  	 $('.view_all'+id).html('');
				 $('.view_all'+id).html(data.view);
				$('.viewList'+id).html('');
				$('#commentreplyArea'+id).val('');
				$('.viewList'+id).html(data.html);
				//alert("s");
				}
				else if(data.success == "no")
			    {    
				    
					alert("failed to load");
					
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}
   function reportAbuse(id){
			$('li#list_'+id).html('<p align="center"><img src="../images/ajax-loader.gif"  /></p>');
	        dataString='postid='+id;
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=reportAbuse",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				//alert("Removed");
				//$('#post_contents').html('');
				$('li#list_'+id).html('');
				
				//refreshPost();
				}
				else if(data.success == "no")
			    {    
				    
					alert("failed to load");
					
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}	
	
  function viewreplies(id){	
  	 		dataString='postid='+id;
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=viewReplies",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {      
			        $('.view_all'+id).html('');
			  		 $('.viewList'+id).html('');
			   		$('.viewList'+id).html(data.html);
				
				}
				else if(data.success == "no")
			    {    
				    
					alert("failed to load");
					
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
 } 
 
 function agreeReply(id){
	        dataString='replyid='+id+'&lik=1';
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=agreeReply",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				
				$('.agreeReply'+id).html("");
				$('.agreeReply'+id).html("<a>Agreed</a>");
				$('.disagreeReply'+id).html("");
				$('.disagreeReply'+id).html('<a onclick="disagreeReply('+id+');" href="javascript:void(0);" >Disgree </a>');
				
				
				}
				else if(data.success == "no")
			    {    
				    if(data.status=='liked'){
						alert("already agreed");
					}
					else{
					alert("failed to load");
					}
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}
	 function disagreeReply(id){
	        dataString='replyid='+id+'&lik=0';
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=agreeReply",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				
				$('.disagreeReply'+id).html("");
				$('.disagreeReply'+id).html("<a>Disgreed</a>");
				$('.agreeReply'+id).html("");
				$('.agreeReply'+id).html('<a onclick="agreeReply('+id+');" href="javascript:void(0);">Agree</a>');
				
				//alert(""+data.agree);
				}
				else if(data.success == "no")
			    {    
				    if(data.status=='liked'){
						alert("already disagreed");
					}
					else{
					alert("failed to load");
					}
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}
	
function deleteReply(id,pid){
	        dataString='replyid='+id+'&pid='+pid;
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=deleteReply",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				
				$('.view_all'+pid).html('');
				 $('.view_all'+pid).html(data.view);
				$('.viewList'+pid).html('');
				$('#commentreplyArea'+pid).val('');
				$('.viewList'+pid).html(data.html);
				
				}
				else if(data.success == "no")
			    {    
				    if(data.status=='liked'){
						alert("already disagreed");
					}
					else{
					alert("failed to load");
					}
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}							
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/jquery.quick.pagination.min.js"></script>




<script type="text/javascript">
$(document).ready(function() {
	$("ul.pagination1").quickPagination();
	//$("ul.pagination2").quickPagination({pagerLocation:"both"});
	//$("ul.pagination3").quickPagination({pagerLocation:"both",pageSize:"3"});
});
</script>

<style type="text/css">

</style>

