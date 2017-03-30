<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-1.7.1.min.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/myprofile.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-ui-1.8.16.custom.min.js"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery.form.js"> </script>
<script type="text/javascript">
$(document).ready(function(){    
	//$('#profile-tabs').tabs();
}); 

function opendialogbox(inputid){
	$('#photoimg').click();
}
</script>
<link rel="stylesheet" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/jquery-ui-1.8.16.custom.css" media="all" />
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/myprofile.css" rel="stylesheet" />

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
								<ul class="ui-tabs-nav"> <!-- ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all-->
									<li id="1" class="ui-state-default ui-tabs-selected ui-state-active"> <!--ui-corner-top -->
										<a href="#">VIEW PROFILE</a>
									</li>
									<li id="2" class="ui-state-default ui-corner-top">
										<a href="<?php echo $GLOBALS['base_url']; ?>myprofile/editprofile">EDIT PROFILE</a>
									</li>
									<li id="3" class="ui-state-default ui-corner-top">
										<a href="<?php echo $GLOBALS['base_url']; ?>myprofile/changepwd">CHANGE PASSWORD</a>
									</li>
								</ul>
								
									<div id="view">
											<div id="profile_container">
												  
														<div id="left-main">
														
															<div id="userview-photo">
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
																<div id="upload_photo_view"  ></div>
															
															
																	<div class="my-tags-main">
												   <div class="my-tags-inner"> 
														 <div class="btn-text"><a href="#">MY TAGS</a></div>
												   </div>
												  
												   <div class="multiselect">
														 <div class="multiselect-left">
																<select id="tagList_view" name="my-dropdown" 
																	style="width:158px; height:22px;font:12px arial;line-height:20px;padding:2px" disabled="disabled">
																	<?php echo $my_tags;?>																	
																</select>
														</div>
														  
														  <div class="multiselect-right">
														  	<a href="javascript:void(0);" ><img src="../images/plus-icon.jpg" width="29" height="26" alt="multi-plus-icon"></a>
														</div>
														  
												 </div>
										 
												 <div id="list-tags_view" style="overflow:hidden;float:left"> 
												 	<?php echo $search_tag_list;?>
												 </div>
									   </div>
														</div>
														<div id="right-main">
															
																<ul>
																		
																	<li>
																		<h1>First Name</h1>
																		<h2><input type="text" name="name_view" value="<?php echo $first_name;?>"  
																		id="firstname_view" class="input_txt" disabled="disabled"/></h2>				
																	</li>
																	<li>
																		<h1>Last Name</h1>
																		<h2><input type="text" name="name_view" value="<?php echo $last_name;?>"  
																		id="lastname_view" class="input_txt" disabled="disabled"/></h2>				
																	</li>
																	<li>
																		<h1>User Name</h1>
																		<h2>
																		<input type="text" name="username_view" value="<?php echo $username;?>"  
																		id="username_view" class="input_txt" disabled="disabled"/>
																		</h2>				
																	</li>
																		
																		
																		<li>
																			<h1>City</h1>
																			<h2><input type="text" name="city" value="<?php echo $city;?>"  id="city" class="input_txt" disabled="disabled"/></h2>				
																		</li>
																		<li>
																			<h1>State</h1>
																			<h2><input type="text" name="state" value="<?php echo $state;?>"  id="state" class="input_txt" disabled="disabled"/></h2>				
																		</li>
																		<li>
																			<h1>Zipcode</h1>
																			<h2><input type="text" name="zipcode" value="<?php echo $zipcode;?>"  
																			id="zipcode" class="input_txt" disabled="disabled"/></h2>				
																		</li>
																		<li>
																			<h1>Email</h1>
																			<h2><input type="text" name="email_view" value="<?php echo $email;?>"  
																			id="email_view" class="input_txt" disabled="disabled"/></h2>				
																		</li>
																		<li>
																			<h1>Age</h1>
																			<h2><input type="text" name="age_view" value="<?php echo $age;?>"  
																			id="age_view" class="input_txt" disabled="disabled"/></h2>				
																		</li>
																		<li>
																			<h1>Nickname</h1>
																			<h2><input type="text" name="nickname" value="<?php echo $nickname;?>"  
																			id="nickname" class="input_txt" disabled="disabled"/></h2>				
																		</li>
																		<li>
																			<h1>Scars</h1>
																			<h2><input type="text" name="scars" value="<?php echo $scars;?>"  
																			id="scars" class="input_txt" disabled="disabled"/></h2>				
																		</li>
																		<li>
																			<h1>Tattoos</h1>
																			<h2><input type="text" name="tattoos" value="<?php echo $tattoos;?>"  
																			id="tattoos" class="input_txt" disabled="disabled"/></h2>				
																		</li>
																		<li>
																			<h1>High School</h1>
																			<h2><input type="text" name="highschool" value="<?php echo $highschool;?>"  
																			id="highschool" class="input_txt" disabled="disabled"/></h2>				
																		</li>
																		<li>
																			<h1>College</h1>
																			<h2><input type="text" name="college" value="<?php echo $college;?>"  
																			id="college" class="input_txt" disabled="disabled"/></h2>				
																		</li>
																		<li>
																			<h1>Relationship status</h1>
																			<h2><select id="relation_status" name="relation_status" disabled="disabled" class="input_txt">
																			    <?php if(isset($relationshp_status))
																					{
																						echo '<option value="'.$relationshp_status.'">'.$relationshp_status.'</option>';
																						
																					}
																				?>
																				<option value="single">single</option>
																				<option value="single">married</option>
																				<option value="single">divorced</option>
																			</select></h2>				
																		</li>
																		<li>
																			<h1>About me</h1>
																			<h2><textarea name="aboutme_view" 
																			id="aboutme_view" class="input_ta" disabled="disabled"><?php echo $about_me;?></textarea></h2>				
																		</li>
																		<li>
																			<h1>Tags</h1>
																			<h2>
																			<input type="text" name="tags_view" value="<?php echo $search_tags;?>"
																			  id="tags_view" class="input_txt" disabled="disabled"/>
																			</h2>				
																		</li>
																		<!--<li>
																			<div id="doneButton" >
																			<img width="138" height="33" alt="sign-up-account" src="../images/save-edit.jpg"  >
																			</div>
																			
																							
																		</li>-->
																		
																								
																</ul>
														
														</div>
												  </div>
													
											</div>	<!--profile_container-->
											
											<!--profile_container-->
												
											</div>
									</div>
						</div>
			</div>
</div>