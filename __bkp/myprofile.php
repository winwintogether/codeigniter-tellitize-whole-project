<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/myprofile.css" rel="stylesheet" />


<div id="header">
<?php $this->load->view('header'); ?>
</div>

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
							
						 <div id="profile-tabs" >
								<ul>
										<li id="1"><a href="#view">VIEW PROFILE</a></li>
										<li id="2"><a href="#edit">EDIT PROFILE</a></li>
													
								</ul>
									<div id="view">
											<div id="profile_container">
												  
														<div id="left-main">
														<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS['base_url']; ?>ajax/ajaximage.php'>
															<div id="user-photo">
															<?php 
															if($profile_img=='')
																echo '<img  alt="user photo" src="../images/user-photo.jpg" />';
															else
																echo '<img  alt="user photo" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$profile_img.'" />';
																?>	
															</div>
															
															<div style="display:none"> <input type="file" name="photoimg" id="photoimg" /></div>
															<div id="upload_photo" onClick="javascript:opendialogbox('imageuploadform1');" id="photoimg"></div>
															</form>
																	<div class="my-tags-main">
												   <div class="my-tags-inner"> 
														 <div class="btn-text"><a href="#">MY TAGS</a></div>
												   </div>
												   <?php echo form_open('updateuser',array('name' => 'profile' ,'id'=>'profile')); ?>
												   <div class="multiselect">
														 <div class="multiselect-left">
																<select id="my-dropdown3" name="my-dropdown" style="width:158px; height:22px;">
																	<option value="1">A cappella</option><option value="2">Acid Jazz</option>
																	<option value="3" selected="selected">Big Band</option>
																	<option value="4">Big Beat</option>
																	<option value="5">Cakewalk</option>
																	<option value="6">Calenda</option>
																	<option value="7">Dark ambient</option>
																	<option value="8">Dark cabaret</option>
																</select>
														</div>
														  
														  <div class="multiselect-right"><a href="#"><img src="../images/plus-icon.jpg" width="29" height="26" alt="multi-plus-icon"></a></div>
														  
												 </div>
										 
												   <div class="city-name-main">
													 <div class="city001"><input name="New York" type="text" value="New York" class="city-input"></div>
														 <div class="close-btn"><a href="#">
														 <img src="../images/close-btn.jpg" width="15" height="15" alt="close-btn"></a>
														 </div>
												   </div>
									   </div>
														</div>
														<div id="right-main">
															
																<ul>
																		
																	<li>
																		<h1>Name</h1>
																		<h2><input type="text" name="name" value="<?php echo $name;?>"  id="name" class="input_txt"/></h2>				
																	</li>
																	<li>
																		<h1>User Name</h1>
																		<h2>
																		<input type="text" name="username" value="<?php echo $username;?>"  id="username" class="input_txt" />
																		</h2>				
																	</li>
																		
																		<li>
																			<h1>Location</h1>
																			<h2><input type="text" name="location" value="<?php echo $location;?>"  id="location" class="input_txt"/></h2>				
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
																			<h1>About me</h1>
																			<h2><textarea name="aboutme" id="aboutme" class="input_ta"><?php echo $about_me;?></textarea></h2>				
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
											
											
											<div id="edit">
												
											</div>
											
											
									</div>
									
												
						</div>
						  
			</div>
</div>			


<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-1.7.1.min.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/myprofile.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-ui-1.8.16.custom.min.js"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery.form.js"> </script>
<link rel="stylesheet" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/jquery-ui-1.8.16.custom.css" media="all" />	
<script type="text/javascript">

$(document).ready(function(){    
	$('#profile-tabs').tabs();
	
	
	
});	


</script>  
<script language="javascript">
$(document).ready(function() { 
		
            $('#photoimg').live('change', function()			{ 
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
</script>

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>