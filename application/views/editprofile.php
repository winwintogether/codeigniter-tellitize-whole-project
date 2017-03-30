<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-1.7.1.min.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/myprofile.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-ui-1.8.16.custom.min.js"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery.form.js"> </script>
<link rel="stylesheet" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/jquery-ui-1.8.16.custom.css" media="all" />
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/myprofile.css" rel="stylesheet" />
	
<script type="text/javascript">

$(document).ready(function(){    
	//$('#profile-tabs').tabs();
	$('#photoimg').live('change', function(){
		$("#user-photo").html('');
		//$("#user-photo").css('background','none');
		$("#user-photo").html('<img src="loader.gif" alt="Uploading...."/>');
		$("#imageform").ajaxForm({
			target: '#user-photo'
		}).submit();
	});
 }); 
 
function updateUser(){
	dataString = $('form[name=profile]').serialize();
			
	
		$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=update_user",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {    
				alert("Successfully updated");
				//$('#profile').submit();
				}
				else if(data.success == "no")
			  {    
				alert("Username already exist");
				return false;
				}
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
}


function opendialogbox(inputid){

	 $('#photoimg').click();
	 
 
}

function addTag(){
	dataString 		= $('form[name=tagForm]').serialize();
	var tag			= $('#tagList').val(); 
	var id_value	= $('#tagList').find(':selected')[0].id;
	
	if(parseInt($('#tagList').find(':selected')[0].id.replace("tag_", "")))
	{
		var id = $('#tagList').find(':selected')[0].id.replace("tag_", "");
		var tag_value	= $('#tag_'+id).text();
	}
	else
	{
		var id = $('#tagList').find(':selected')[0].id.replace("edited_tag_", "");
		var tag_value	= $('#edited_tag_'+id).text();
	}
	

	$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=update_tags&value="+tag_value,
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
				if(data.success == "yes")
				{
					$('#list-tags').html(data.html);
					$('#list-tags_view').html(data.html);
					$("#tagList").find("option[id="+id_value+"]").remove(); 
///					$("#tagList option[value=tag]").remove();
				}
				else if(data.status == "exist")
				{
					alert("Tag already in list");
				}
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
	});
}

function deleteTag(tag){ 
	//dataString = $('form[name=tagForm]').serialize();
	//var tag=$('#tagList').val(); 
	//alert($(".class_"+tag).val());exit();
	var class_name	= $('div').filter('.tag-name-main').length;
	//var class_name	= "'"+tag+"'";
		$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=delete_tag&tagname="+tag,
			cache: false,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {
				$('#tagList').append('<option value="'+tag+'" id="edited_tag_'+class_name+'" selected="selected">'+tag+'</option>');
			  	$('#list-tags').html(data.html);
				$('#list-tags_view').html(data.html);
				
			  }
				
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
}

</script>

<div id="mid_container">
			<div class="mid_content">
				<div id="myprofile">
						<div class="myprofile">
									<div class="orang_left"></div>
									<div class="orang_mid">
										<h4>MY PROFILE</h4>
										
										</div>
									<div class="orang_rit"></div>									
							</div>
							
						 <div id="profile-tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
								<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
									<li id="1" class="ui-state-default ui-corner-top">
										<a href="<?php echo $GLOBALS['base_url']; ?>myprofile">VIEW PROFILE</a>
									</li>
									<li id="2" class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
										<a href="#">EDIT PROFILE</a>
									</li>
									<li id="3" class="ui-state-default ui-corner-top">
										<a href="<?php echo $GLOBALS['base_url']; ?>myprofile/changepwd">CHANGE PASSWORD</a>
									</li>
								</ul>
								
										<!--profile_container-->
											
											<div id="edit">
												<div id="profile_container">
												  
														<div id="left-main">
														<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS['base_url']; ?>ajax/ajaximage.php'>
															<div id="user-photo">
															<?php  
															if($profile_img=='')
															{   if($reg_status==1) {echo '<img src="https://graph.facebook.com/'.$usernamefb.'/picture"/>';}
															else{
																echo '<img  alt="user photo" src="'.$GLOBALS['base_url'].'images/user-photo.jpg" />';
																}
															}
																														
															else
																echo '<img  alt="user photo" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$profile_img.'" />';
																?>
															
															</div>
															
															<div style="display:none"> <input type="file" name="photoimg" id="photoimg" /></div>
															<div class="upload_photo" onClick="opendialogbox('imageform');"  ></div>
															</form>
																	<div class="my-tags-main">
												   <div class="my-tags-inner"> 
														 <div class="btn-text"><a href="#">MY TAGS</a></div>
												   </div>
												   <form id="tagForm" method="post" name="tagForm">
												   	<div class="multiselect">
													
														 <div class="multiselect-left">
																<select id="tagList" name="tagList" style="width:158px; height:22px;font:12px arial;line-height:20px;padding:2px">
																	<?php echo $my_tags;?>
																	
																</select>
														</div>
													
														 <div class="multiselect-right">
														  	<a href="javascript:void(0);" onclick="addTag();">
																<img src="../images/plus-icon.jpg" width="29" height="26" alt="multi-plus-icon">
															</a>
														 </div>
														  
												 </div>
												 </form>
										         <div id="list-tags" style="overflow:hidden;float:left"> 
												 	<?php echo $search_tag_list;?>
												 </div>
									   </div>
									</div>
														
												   <?php echo form_open('updateuser',array('name' => 'profile' ,'id'=>'profile')); ?>
												   
														<div id="right-main">
															
																<ul>
																		
																	<li>
																		<h1>First Name</h1>
																		<h2><input type="text" name="firstname" value="<?php echo $first_name;?>"  id="firstname" class="input_txt"/></h2>				
																	</li>
																	<li>
																		<h1>Last Name</h1>
																		<h2><input type="text" name="lastname" value="<?php echo $last_name;?>"  id="lastname" class="input_txt"/></h2>				
																	</li>
																	<li>
																		<h1>User Name</h1>
																		<h2>
																		<input type="text" name="username" value="<?php echo $username;?>"  id="username" class="input_txt" readonly="readonly" style="color:#E2E1D6" />
																		</h2>				
																	</li>
																		
																		
																		<li>
																			<h1>City</h1>
																			<h2><input type="text" name="city" value="<?php echo $city;?>"  id="city" class="input_txt"/></h2>				
																		</li>
																		<li>
																			<h1>State</h1>
																			<h2><input type="text" name="state" value="<?php echo $state;?>"  id="state" class="input_txt"/></h2>				
																		</li>
																		<li>
																			<h1>Zipcode</h1>
																			<h2><input type="text" name="zipcode" value="<?php echo $zipcode;?>"  
																			id="zipcode" class="input_txt" /></h2>				
																		</li>
																		<li>
																			<h1>Email</h1>
																			<h2><input type="text" name="email" value="<?php echo $email;?>"  id="email" class="input_txt"/></h2>				
																		</li>
																		<li>
																			<h1>Age</h1>
																			<h2><input type="text" name="age" value="<?php echo $age;?>"  id="age" class="input_txt"/></h2>				
																		</li>
																		<li>
																			<h1>Nickname</h1>
																			<h2><input type="text" name="nickname" value="<?php echo $nickname;?>"  
																			id="nickname" class="input_txt" /></h2>				
																		</li>
																		<li>
																			<h1>Scars</h1>
																			<h2><input type="text" name="scars" value="<?php echo $scars;?>"  
																			id="scars" class="input_txt" /></h2>				
																		</li>
																		<li>
																			<h1>Tattoos</h1>
																			<h2><input type="text" name="tattoos" value="<?php echo $tattoos;?>"  
																			id="tattoos" class="input_txt" /></h2>				
																		</li>
																		<li>
																			<h1>High School</h1>
																			<h2><input type="text" name="highschool" value="<?php echo $highschool;?>"  
																			id="highschool" class="input_txt" /></h2>				
																		</li>
																		<li>
																			<h1>College</h1>
																			<h2><input type="text" name="college" value="<?php echo $college;?>"  
																			id="college" class="input_txt" /></h2>				
																		</li>
																		<li>
																			<h1>Relationship status</h1>
																			<h2>
																				<select id="relation_status" name="relation_status" class="input_txt">
																					<option value="single" <?php if($relationshp_status == 'single'){?> selected<?php } ?>>single</option>
																					<option value="married" <?php if($relationshp_status == 'married'){?> selected<?php } ?>>married</option>
																					<option value="divorced" <?php if($relationshp_status == 'divorced'){?> selected<?php } ?>>divorced</option>
																				</select>
																			</h2>				
																		</li>
																		<li>
																			<h1>About me</h1>
																			<h2><textarea name="aboutme" id="aboutme" class="input_ta"><?php echo $about_me;?></textarea></h2>				
																		</li>
																		<li>
																			<h1>Tags</h1>
																			<h2><input type="text" name="tags" value="<?php echo $search_tags;?>"  id="tags" class="input_txt"/></h2>				
																		</li>
																		<li>
																			<div id="doneButton" >
																			<img width="138" height="33" alt="sign-up-account" src="../images/save-edit.jpg"  onClick="validateUpdation();">
																			</div>
																			
																							
																		</li>
																		
																								
																</ul>
														
														</div><?php echo form_close(); ?>
												  </div>
													
											</div>	<!--profile_container-->
												
											</div>
											
											
									</div>
									
												
						</div>
						  
			</div>
</div>