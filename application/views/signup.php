<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery.validationEngine.js"></script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery.validationEngine-en.js"></script>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/myprofile.css" rel="stylesheet" />
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/validationEngine.jquery.css" rel="stylesheet">
<script language="javascript" type="text/javascript">
function chk_register()
{
	var email=$.trim($("#email").val());
	
	if($.trim($("#first_name").val()) == "")
	{
		$("#first_name").css("border","1px solid red");
		$("#first_name").focus();			  
		return false;
	}
	else
	{
		$("#first_name").css("border","1px solid #CCCCCC");	
	}
	
	if($.trim($("#last_name").val()) == "")
	{
		$("#last_name").css("border","1px solid red");
		$("#last_name").focus();			  
		return false;
	}
	else
	{
		$("#last_name").css("border","1px solid #CCCCCC");	
	}
			
	if($.trim($("#email").val()) == "")
	{
		$("#email").css("border","1px solid red");
		$("#email").focus();			  
		return false;
	}
	else if(!checkemail(email))
	{
		alert("Invalid emailid");
		$("#email").css("border","1px solid red");
		$("#email").focus();			  
		return false;
	}
	else
	{
		$("#email").css("border","1px solid #CCCCCC");	
	}
	
	if($.trim($("#username").val()) == "")
	{
		$("#username").css("border","1px solid red");
		$("#username").focus();			  
	 	return false;
	}
	else
	{
		$("#username").css("border","1px solid #CCCCCC");	
	}
	
	if($.trim($("#password").val()) == "")
	{
		$("#password").css("border","1px solid red");
		$("#password").focus();			  
	 	return false;
	}
	else
	{
		$("#password").css("border","1px solid #CCCCCC");	
	}
	
	if($.trim($("#passwordConfirm").val()) == "")
	{
		$("#passwordConfirm").css("border","1px solid red");
		$("#passwordConfirm").focus();			  
	 	return false;
	}
	else
	{
		$("#passwordConfirm").css("border","1px solid #CCCCCC");	
	}
	
	if($.trim($("#passwordConfirm").val()) !=$.trim($("#password").val()))
	{
		$("#passwordConfirm").css("border","1px solid red");
	 	$("#passwordConfirm").focus();	
		alert("Password mismatch")	;		  
	 	return false;
	}
	else
	{
		$("#passwordConfirm").css("border","1px solid #CCCCCC");	
	}
	 
	if(!$('#right-main input[type="checkbox"]').is(':checked'))
	{
		alert("Please agree to the terms and conditions");
	  	return false;
	}
	else
	{
		return true;
	}
	
}

function checkemail(em)   //Email validation 
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(em))
		return true;
	else
		return false;
}

	$(document).ready(function() {
		//$("#register").validationEngine();
		
		$('#checkEmail').click(function() {
			
	 		dataEmail = $('#email').val().replace(/^\s+|\s+$/g,'');
			if(dataEmail != '')
			{
				$.ajax({
						type: "POST",
						url: "<?php echo $GLOBALS['base_url']; ?>/ajax/user-ajax.php?mode=check_email&email="+dataEmail,
						cache: false,
						data: dataEmail,
						dataType: "json",
						success: function(data) {
						if(data.success == "yes")
						{
							$('#email_div').html('Someone is already using this email');
							$('#email_div').css('color', '#FF0000');
							$('#email_div').show();
							return false;
						}
						else if(data.success == "no")
						{
							$('#email_div').html('Email is available');
							$('#email_div').css('color', '#006400');
							$('#email_div').show();
							return false;
						}
						else 
						{
							$('#email_div').html('Occured internal Error.please check network connection');
							$('#email_div').css('color', '#FF0000');
							$('#email_div').show();
							return false;
						}
					}
				});
			}
			else
			{
				alert("Enter email");
			}
		});
		
		$('#checkUserName').click(function() {
			
	 		var UserName = $('#username').val().replace(/^\s+|\s+$/g,'');
			if(UserName != '')
			{
				$.ajax({
						type: "POST",
						url: "<?php echo $GLOBALS['base_url']; ?>/ajax/user-ajax.php?mode=check_username&username="+UserName,
						cache: false,
						data: UserName,
						dataType: "json",
						success: function(data) {
						if(data.success == "yes")
						{
							$('#username_div').html('Someone already taken this username');
							$('#username_div').css('color', '#FF0000');
							$('#username_div').show();
							return false;
						}
						else if(data.success == "no")
						{
							$('#username_div').html('Username is available');
							$('#username_div').css('color', '#006400');
							$('#username_div').show();
							return false;
						}
						else 
						{
							$('#username_div').html('Occured internal Error.please check network connection');
							$('#username_div').css('color', '#FF0000');
							$('#username_div').show();
							return false;
						}
					}
				});
			}
			else
			{
				alert("Enter username");
			}
		});
		
		
	});
	
</script>
<div id="mid_container">
			<div class="mid_content">
				<div id="myprofile">
						<div class="myprofile">
									<div class="orang_left"></div>
									<div class="orang_mid">
										<h4>SIGN UP</h4>
										
										</div>
									<div class="orang_rit"></div>									
							</div>
						 <div class="signUp">
								 <form name="register" id="register" action="<?php echo $GLOBALS['base_url']; ?>reg" method="post" onSubmit="return chk_register();">
						  		<div id="left-main">
									<img width="202" height="392" alt="free-account" src="<?php echo $GLOBALS['base_url']; ?>images/free-account-big.jpg">
								</div>
						  		<div id="right-main" style=" width:530px;">
									<div style="margin-top:10px;padding-left:43px;color:#FE8A13;font-weight:bold;display:<?php echo $display_option;?>" class="<?php //echo $msg_class;?>"><?php echo $msg;?></div>
										<ul>												
												<li>
													<h1>First Name</h1>
													<h2><input type="text" name="first_name" value="" id="first_name" class="input_txt signup_textboxes validate[required]"/></h2>				
												</li>
												<li>
													<h1>Last Name</h1>
													<h2><input type="text" name="last_name" value="" id="last_name" class="input_txt signup_textboxes validate[required]"/></h2>				
												</li>
												<li style="position:relative;">
													<div>
														<h1>Email</h1>
														<h2><input type="text" name="email" value="" id="email" class="input_txt signup_textboxes validate[required,custom[email]]"  /></h2>
														<div class="greyLeft" style="margin-top:11px;margin-left:18px;"><input type="button" name="button" id="checkEmail" value="Check Availability" class="greyLeft_btn"></div>
													</div>
													<div id="email_div" class="availableMsg"></div>				
												</li>
												<li style="position:relative;">
													<div>
														<h1>Username</h1>
														<h2><input type="text" name="username" value="" id="username" class="input_txt signup_textboxes validate[required]"/></h2>
														<div class="greyLeft" style="margin-top:11px;margin-left:18px;"><input type="button" name="button" id="checkUserName" value="Check Availability" class="greyLeft_btn"></div><!--greyRight-->
													</div>
													<div id="username_div" class="availableMsg"></div>				
												</li>
												
												<li>
													<h1>password</h1>
													<h2><input type="password" name="password" value="" id="password" class="input_txt signup_textboxes validate[required] "/></h2>				
												</li>
												<li>
													<h1>Confirm Password</h1>
													<h2><input type="password" name="passconf" value="" id="passwordConfirm" class="input_txt signup_textboxes validate[required,equals[password]] "/></h2>				
												</li>
                                       <li class="tos_content signup_texarea" style="margin-left:150px">
                                               
        					<p><strong><span>Terms of Use</span></strong></p>
                               <p>Users of Tellitize use the site at their own risk. 
                               Tellitize owners, management and staff are not responsible for what members post on this web site.
                                We ask that members do not post false information about others on this site. 
                                Any requests to remove alleged false postings must be directed to the member who posted them. 
                                Tellitize is not responsible for the actions of the members who join the site and can not be held liable 
                                for the actions of any its members.</p>
   
    					       <p>Any pornographic photos or videos are strictly forbidden, 
                        any members posting pornographic material including porn videos,
                         or porn pictures, naked girls pictures or naked guys pictures, will be banned from the site.</p>
   
    			<p>Tellitize does not sell any member information or give it free to anyone. We respect our member's privacy.</p>
    
    		    <p>No one under the age of thirteen years of age will be permitted to us this site, become a member, 
            post information of any kind, or submit any information to this site.</p>
   
    
              <ol>
                <li>Definitions.</li>
                </ol>
                <p>Throughout these Terms of Use "Tellitize" will be hereafter referred to as "web site".</p>
                <p>The word "you" will hereafter mean the user of this web site, you.</p>
                <ol>
            <li>Acceptance of Terms.</li>
            </ol>
                <p>By you viewing pages or signing in to this web site, you are 
                accepting this web site's "Terms of Use" and thereby are agreeing to follow 
                all rules stated there. If you do not follow all of rules in the Terms of
                 Use you will be deleted from the Web Site with or without warning. 
                 If you don't agree with any of the rules stated in the Terms of Use you should not use or join this Web Site.</p>
                <ol>
                <li>Modifications to the Terms of Use.</li>
                </ol>
                <p>This Web Site may change the Terms of Use at any time without prior notification to you. 
                You should check back here often to see if any changes have taken place.</p>
                <ol>
                <li>Web Site Content.</li>
                </ol>
                <p>&nbsp;</p>
                <p>Everything posted on this Web Site including but not limited to: videos, photographs, text, drawings, animations, 
                or any other images or media is the sole responsibility of the person who posted it on this Web Site. This Web Site, its owners or employees,
                 are not responsible in any way for anything posted on this Web Site. This Web Site can not control what persons post on it, 
                 although we will make a reasonable effort to remove any improper postings or images from the Web Site. This Web Site does not verify, 
                 edit, or review any content members or guests post on it. You ultimately are responsible for any and all images, text, media 
                 and other content you post on this Web Site and may be held accountable for it in a court of law. &nbsp;</p>
                <p>&nbsp;</p>
                <p>When you agree to be a member of this Web Site or view any part of it as a guest, you agree and understand that
                 you may view content that you may find mean, crude, racist, libelous, indecent, or otherwise offensive. You may or may not find information about;
                  URLs to; or links to; other web sites other than this one that have nothing whatsoever to do with this Web Site.
                   If you choose to visit those sites you do so at your own risk. This Web Site will not be liable in any way for any losses 
                   or damages of any kind as a result of you using this Web Site or any other you may find referenced on this Web Site. 
                   Any and all ideas, statements, opinions, comments, threats, or images are explicitly and solely those of the individuals who posted them 
                   on this Web Site and not necessarily those of this Web Site's owners or employees.</p>
                <p>&nbsp;</p>
                <p>You understand and agree that you solely make the decision whether or not you use, rely, or choose to believe any information posted
                 on this Web Site. This Web Site will not be held responsible in any way for any loss or damages incurred due to You accessing any
                  content posted on this Web Site.</p>
                <p>&nbsp;</p>
                <p>5.&nbsp; Privacy Information.</p>
                <p>&nbsp;</p>
                <p>- Cookies</p>
                <p>&nbsp;</p>
                <p>This Web Site does use cookies. This is to enable You not to have to worry about continuously re-logging in to your account every
                 time you move from page to page. We do not collect personally identifiable information when using cookies. 
                 Almost all web sites use cookies in this manner.</p>
                <p>&nbsp;</p>
                <p>- E-mail</p>
                <p>&nbsp;</p>
                <p>We may send e-mails to our members to inform them of new features or events periodically.
                 We may also send advertising through email on occasion or special pricing reserved only for our members for products or services.
                  If you don't want to receive any emails from this Web Site, simply inform us of this and we will remove you from any future e-mailings.</p>
                <p>&nbsp;</p>
                <p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; General</p>
                <p>&nbsp;</p>
                <p>This Web Site maintains and collects certain member/user information which may contain: geographic information, names of members/users etc.,
                 e-mail addresses, and various other information entered by the members/users. This is done for purposes of Web Site functionality. 
                 Without this information the site would not function to the capacity it was intended. We do not disclose this information to others 
                 for the purposes of spamming or sending junk emails etc.</p>
                <ol>
                <li>User Rules and Responsibilities</li>
                </ol>
                <p>You are responsible for the content you post on this Web Site. You are responsible to know the laws in your area and to abide by them 
                when posting anything on this site. You agree and understand that you must only post information that is true and accurate. If you post 
                information about others that is not true, you may face legal actions brought upon you by the other party. Any unlawful content posted 
                will leave you subject to local and federal law enforcement actions.</p>
                <p>&nbsp;</p>
                <p>You agree that you will not link to, post, or in any way make available through this Web Site any content that:</p>
                <p>&nbsp;</p>
                <ol>
                <li>makes people think someone else has a sexually transmitted disease or other disease if they really do not. This includes stating 
                or implying that they have an STD or stating that the person has committed a crime if they have not.</li>
                <li>is lewd, vulgar, defamatory, libelous, harassing, obscene, threatening, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;harmful, or 
                in any way harmful to minors.</li>
                <li>misrepresents your affiliation with another person or entity, or impersonates any person or entity.</li>
                <li>attempts to scam anyone or attempts to defraud anyone.</li>
                <li>is any type or form of junk mail, advertising, chain letter, spam, marketing material, or contains links to any commercial
                 service or other websites.</li>
                <li>constitutes any content that you do not have the right to publish including: copyright, trade secrets and &nbsp;trademarked content.</li>
                </ol>
                <p>&nbsp;</p>
                <p>You agree that you will not:</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; use any of the information posted or otherwise 
                provided by this Web Site for any commercial or unlawful purposes.</p>
                <ol>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;continue to attempt to make contact with people that ask you not to do so.</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;harass anyone or make anyone feel that they are being stalked by you.<ol>
                <li>try to break into anyone else's account or gain access to our computer servers, or do anything that may cause this site to be disrupted.</li>
                <li>post anything on this Web Site that is not true, misleading or false.</li>
                <li>use any automated system to download or post anything form this Web Site unless given written permission to do so.</li>
                </ol></li>
                </ol>
                <p>&nbsp;</p>
                <p>You agree that:</p>
                <p>&nbsp;</p>
                <ol>
                <li>postings may be deleted either automatically or manually if not accessed for a period of time to be determined by the operators of 
                this Web Site to free up space.</li>
                <li>any persons mentioned by you must be at least 13 years old and you also must be at least 13 years old to view, post, or use 
                this site in any way.</li>
                </ol>
                <p><strong><span style="text-decoration: underline;"><br></span></strong></p>
                <ol> </ol>

       					
                                          </li>
												<li>
													
													<h1 style="text-transform:none;width:270px;margin-left:138px;">
													<input type="checkbox" name="agree" value="" id="agree" class="validate[required]" /> I have read and agree to the Terms of Service
													</h1>			
												</li>
                           
											
												<li id="signup">
													<!--<img width="138" height="33" alt="sign-up-account" src="<?php echo $GLOBALS['base_url']; ?>images/sign-up-btn.jpg" onClick="validate_signUp_form();">				-->
													<input type="submit" name="submit" id="submit" value="Sign Up" class="signupOrange">
												</li>
												
																		
										</ul>
											
										
								
								</div>
						  </div>
						  <div style="font:12px arial;line-height:20px;margin-left:180px;margin-top:10px;">Your personal information will never be sold or shared for marketing purpose</div>
						  </form>
					</div>	<!--signUp-->
					
			</div>
</div>			


<script language="javascript">
function save_user()
	{
	 
		dataString = $('form[name=register]').serialize();
			
	
		$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>/ajax/user-ajax.php?mode=save_user",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {    
				
				$('#register').submit();
				alert("Successfully registered.Check your mail for verification.");
				}
				else if(data.success == "no")
			  { 
					if(data.status=="username")  { 
						alert("Username already exist");
						return false;
					}
					else{
						alert("Email already exist");
						return false;
					}
					
			  }
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	   
	}
</script>