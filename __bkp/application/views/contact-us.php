<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/message.css" rel="stylesheet" />

<div id="header">
<?php $this->load->view('header'); ?>
</div>

<div id="mid_container">
			<div class="mid_content">
				<div id="message">
						<div class="message">
									<div class="orang_left"></div>
									<div class="orang_mid">
										<h4>Contact Us</h4>
										
										</div>
									<div class="orang_rit"></div>									
							</div>
					<div id="faq">	
                    		<form name="freecontactform" method="post" action="<?php echo $GLOBALS['base_url']; ?>/freecontactformprocess" onSubmit="return validate.check(this)">
                                <table width="400px" class="freecontactform">
                                <tr>
                                 <td colspan="2">
                                  
                                 <div class="freecontactformheader">Contact Us Form</div>
                                  
                                 <div class="freecontactformmessage">Fields marked with <span class="required_star"> * </span> are mandatory.</div>
                                  
                                 </td>
                                </tr>
                                <tr>
                                 <td valign="top">
                                  <label for="Full_Name" class="required">Full Name<span class="required_star"> * </span></label>
                                 </td>
                                 <td valign="top">
                                  <input type="text" name="Full_Name" id="Full_Name" maxlength="80" style="width:230px">
                                 </td>
                                </tr>
                                <tr>
                                 <td valign="top">
                                  <label for="Email_Address" class="required">Email Address<span class="required_star"> * </span></label>
                                 </td>
                                 <td valign="top">
                                  <input type="text" name="Email_Address" id="Email_Address" maxlength="100" style="width:230px">
                                 </td>
                                </tr>
                                <tr>
                                 <td valign="top">
                                  <label for="Telephone_Number" class="not-required">Telephone Number</label>
                                 </td>
                                 <td valign="top">
                                  <input type="text" name="Telephone_Number" id="Telephone_Number" maxlength="100" style="width:230px">
                                 </td>
                                </tr>
                                <tr>
                                 <td valign="top">
                                  <label for="Your_Message" class="required">Your Message<span class="required_star"> * </span></label>
                                 </td>
                                 <td valign="top">
                                  <textarea style="width:230px;height:160px" name="Your_Message" id="Your_Message" maxlength="2000"></textarea>
                                 </td>
                                </tr>
                                <tr>
                                 <td colspan="2" style="text-align:center" >
                                  <div class="antispammessage">
                                  To help prevent automated spam, please answer this question
                                  <br /><br />
                                      <div class="antispamquestion">
                                       <span class="required_star"> * </span>
                                       Using only numbers, what is 10 plus 15? &nbsp; 
                                       <input type="text" name="AntiSpam" id="AntiSpam" maxlength="100" style="width:30px">
                                      </div>
                                  </div>
                                 </td>
                                </tr>
                                <tr>
                                 <td colspan="2" style="text-align:center" >
                                 <br /><br />
                                  <input type="submit" value=" Submit Form " style="width:200px;height:40px">
                                  <br /><br />
                                  <!-- 
                                  If you want to remove this author link, 
                                  please purchase an unbranded version from: http://www.freecontactform.com/unbranded_form.php 
                                  Or upgrade to the professional version at: http://www.freecontactform.com/professional.php
                                  -->
                                 
                                 </td>
                                </tr>
                                </table>
                              </form>
						
					</div>							
						   
												
				</div><!--message-->
						  
		</div>
</div>			

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>

<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/freecontactformvalidation.js"></script>
	<script language="javascript">
	required.add('Full_Name','NOT_EMPTY','Full Name');
	required.add('Email_Address','EMAIL','Email Address');
	required.add('Your_Message','NOT_EMPTY','Your Message');
	required.add('AntiSpam','NOT_EMPTY','Anti-Spam Question');
	</script>
 <link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/freecontactform.css" rel="stylesheet">
