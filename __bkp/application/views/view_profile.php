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
										<h4>PROFILE</h4>
										
										</div>
									<div class="orang_rit"></div>									
							</div>
							
								<ul id="invite_btns">
									<li><a href="<?php echo $GLOBALS['base_url']; ?>add-to-group/<?php echo $name_link;?>/<?php echo $profileid;?>">Invite <?php echo $name;?> to Group</a></li>
									<li><a href="<?php echo $GLOBALS['base_url']; ?>add-to-discussion/<?php echo $name_link;?>/<?php echo $profileid;?>">Invite <?php echo $name;?> to POD</a></li>
								</ul>
						
						  <div id="profile-tabs" >
								
									<div id="view">
											<div id="profile_container" style="border:none">
												       
													   
														<div id="left-main">
														
															<div id="userview-photo">
															<?php  
															if($profile_img=='')
															{  // if($reg_status==1) {echo '<img src="https://graph.facebook.com/'.$username.'/picture"/>';}
															//else{
																echo '<img  alt="user photo" src="'.$GLOBALS['base_url'].'images/user-photo.jpg" />';
																//}
															}
																														
															else
																echo '<img  alt="user photo" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$profile_img.'" />';
																?>
															</div>
																
															
															
														</div>
														
														<div id="right-main">
															
																<ul>
																		
																	<li>
																		<h1>Name</h1>
																		<h2><input type="text" name="name_view" value="<?php echo $name;?>"  
																		id="name" class="input_txt" disabled="disabled"/></h2>				
																	</li>
																	<!--<li>
																		<h1>User Name</h1>
																		<h2>
																		<input type="text" name="username_view" value="<?php echo $username;?>"  
																		id="username" class="input_txt" disabled="disabled"/>
																		</h2>				
																	</li>-->
																		
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
																			id="aboutme" class="input_ta" disabled="disabled"><?php echo $about_me;?></textarea></h2>				
																		</li>
																	<!--	<li>
																			<h1>Tags</h1>
																			<h2>
																			<input type="text" name="tags_view" value="<?php echo $search_tags;?>"
																			  id="tags" class="input_txt" disabled="disabled"/>
																			</h2>				
																		</li>-->
																		
																		
																								
																</ul>
														
														</div>
												  </div>
													
											</div>	<!--profile_container-->
											
																						
									</div>								
											
						</div>						  
			</div>
</div>			


<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-1.7.1.min.js" type="text/javascript"> </script>

	

 

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>