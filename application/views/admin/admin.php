<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/myprofile.css" rel="stylesheet" />	
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/admin-page.css" rel="stylesheet" />		

<div id="header">
<?php $this->load->view('header'); ?>
</div>

<div id="mid_container">
			<div class="mid_content">
				<div id="myprofile">
						<div class="myprofile">
									<div class="orang_left"></div>
									<div class="orang_mid">
										<h4>Adminstrator</h4>
										
										</div>
									<div class="orang_rit"></div>									
							</div>
						 <div class="signUp">
						 
						 		
						  		<div id="left-main">
									<img width="202" height="392" alt="free-account" src="<?php echo $GLOBALS['base_url']; ?>/images/free-account-big.jpg">
								</div>
						  		<div id="right-main">
								  <div style="margin:75px">
								   <?php echo form_open("admin/process"); ?>
										<ul>												

												<li>
													<h1>Username</h1>
													<h2><?php echo form_input($login); ?></h2>				
												</li>
												
												<li>
													<h1>password</h1>
													<h2><?php echo form_password($password); ?></h2>				
												</li>
											
												<li id="signup">
												  <?php echo form_submit($submit); ?>			
												</li>
												
																		
										</ul>
											
									<?php echo form_close(); ?>	
								<p><?php echo $msg; ?>   </p>
								   </div>
								</div>
						  </div>
						  <div style="font:12px arial;line-height:20px;margin-left:180px;margin-top:10px;">Your personal information will never be sold or shared for marketing purpose</div>
						  	
					</div>	
					
			</div>
</div>			


<div id="footer">
<?php $this->load->view('footer'); ?>
</div>