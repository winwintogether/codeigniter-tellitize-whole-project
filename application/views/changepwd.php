<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-1.7.1.min.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/myprofile.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-ui-1.8.16.custom.min.js"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery.form.js"> </script>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/myprofile.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/jquery-ui-1.8.16.custom.css" media="all" />	
<script type="text/javascript">

$(document).ready(function(){    
	//$('#profile-tabs').tabs();
}); 

function opendialogbox(inputid){
	$('#photoimg').click();
}

function savePassword(){
	dataString = $('form[name=changepw]').serialize();
			
	$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=change-pw",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
            	if(data.success == "yes")
			  	{  
			  		$('.result').html("Updated...");
					$('#oldpw').val('');
					$('#newpw').val('');
					$('#confirm_pw').val('');
					$('.result').show();
				}
				else if(data.success == "no")
			  	{
					if(data.status=="incorrect"){
						$("#oldpw").css("border","1px solid red");			
						$('.result').html("Incorrect password.Please try again");
						$('.result').show();
					}
					else if(data.status=="mismatch"){
						$("#newpw").css("border","1px solid red");	
						$("#confirm_pw").css("border","1px solid red");
						$('.result').html("Password mismatch");
						$('.result').show();
					}
					else{
					}
				
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
									<li id="2" class="ui-state-default ui-corner-top">
										<a href="<?php echo $GLOBALS['base_url']; ?>myprofile/editprofile">EDIT PROFILE</a>
									</li>
									<li id="3" class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active" >
										<a href="#">CHANGE PASSWORD</a>
									</li>
								</ul>
								
									<!--profile_container-->
								<div class="clear:both">&nbsp;</div>			
								<div id="changepw">
									<div id="right-main" style="margin:0 auto">
									<?php echo form_open('myprofile',array('name' => 'changepw' ,'id'=>'changepw')); ?>
										<ul>
											<li>
														<h1>Old Password</h1>
														<h2><input type="password" name="oldpw" id="oldpw" class="input_txt" /></h2>				
											</li>
											<li>
													<h1>New Password</h1>
													<h2><input type="password" name="newpw" id="newpw" class="input_txt" /></h2>				
											</li>
											<li>
													<h1>Confirm Password</h1>
													<h2><input type="password" name="confirm_pw" id="confirm_pw" class="input_txt" /></h2>				
											</li>
											<li>
														<div id="doneButton" >
															<img width="138" height="33" alt="sign-up-account" src="../images/save-edit.jpg"  onclick="updatePassword();">
														</div>
																			
																							
											</li>
											<li>
													
													<div style="color:#FF0000;display:none" class="result"></div></h2>				
											</li>
										</ul>
										<?php echo form_close();?>
									</div>
								</div>
											
											
										
											<!--profile_container-->
												
											</div>
											
											
									</div>
									
												
						</div>
						  
			</div>
</div>