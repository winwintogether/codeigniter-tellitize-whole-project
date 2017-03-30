//var base_url="http://localhost/tellitize_new/";
//var base_url="http://yours-website.com/tellitize/";
var base_url="http://www.tellitize.com/";

function validate_signUp_form()	{
    var email=$.trim($("#email").val());
	 if($.trim($("#first_name").val()) == ""){
		$("#first_name").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#first_name").css("border","1px solid #CCCCCC");	
		}
	 if($.trim($("#last_name").val()) == ""){
		$("#last_name").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#last_name").css("border","1px solid #CCCCCC");	
		}
			
	 if($.trim($("#email").val()) == ""){
		$("#email").css("border","1px solid red");			  
		 return false;
		 }
		else if(!checkemail(email)){
		    alert("Invalid emailid");
			$("#email").css("border","1px solid red");			  
		 return false;
			
    	}
		else{
			$("#email").css("border","1px solid #CCCCCC");	
		}
		 if($.trim($("#username").val()) == ""){
		$("#username").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#username").css("border","1px solid #CCCCCC");	
		}
		
		 if($.trim($("#password").val()) == ""){
		$("#password").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#password").css("border","1px solid #CCCCCC");	
		}
		
		 if($.trim($("#passwordConfirm").val()) == ""){
		$("#passwordConfirm").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#passwordConfirm").css("border","1px solid #CCCCCC");	
		}
		  if($.trim($("#passwordConfirm").val()) !=$.trim($("#password").val())){
		 $("#passwordConfirm").css("border","1px solid red");
		 alert("Password mismatch")	;		  
		 return false;
		 }
		  else{
			$("#passwordConfirm").css("border","1px solid #CCCCCC");	
		}
		if(!$('#right-main input[type="checkbox"]').is(':checked')){
		  alert("Please agree to the terms and conditions");
		  return false;
		}
	
		//alert("success");
		save_user();
	 
}



function checkemail(em)   //Email validation 
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(em))
	return true;
	else
	return false;
}
function verifyLogin(){  if($.trim($("#loginUsername").val()) == "" || $.trim($("#loginUsername").val()) == "Username"){
		$("#loginUsername").css("border","1px solid red");			  
		 return false;
		 }
	else{
		$("#loginUsername").css("border","1px solid #CCCCCC")
	}
	if($.trim($("#loginPw").val()) == "" || $.trim($("#loginPw").val()) == "Password" ){
		$("#loginPw").css("border","1px solid red");			  
		 return false;
		 }
	else{
		$("#loginPw").css("border","1px solid #CCCCCC")
	}
	loginuser();
}
function loginuser() {
    dataString = $('form[name=login]').serialize();
    $.ajax({
        type: "POST",
        url:"ajax/user-ajax.php?mode=login_user",
        cache: false,
        data: dataString,
        dataType: "json",
        success: function (data) {
            
			if (data.success == "yes") {
                $('#loginForm').submit();
            }
            if (data.success == "no") {
                $('.log_er').show();
            }
        }
    })
}
function validatePostComment(PostSms){
    //alert('Post Type====='+PostSms);
	if($("#commentArea").val() == '' || $("#commentArea").val() == 'Type Message Here' || $("#commentArea").val().replace(/ /g,"-") == ''){
		$("#commentArea").css("border","1px solid red");			  
		 return false;
	} else {
		$("#commentArea").css("border","1px solid #CCCCCC");			  
	} 
	
	if($.trim($("#postasuser").val()) ==-1){
		$("#postasuser").css("border","1px solid red");			  
		 return false;
		 }
	else{
			$("#postasuser").css("border","1px solid #CCCCCC")
		}
	if($.trim($("#category").val()) ==0){
		$("#category").css("border","1px solid red");			  
		 return false;
		 }
	else{
			$("#category").css("border","1px solid #CCCCCC")
		}
	
	
	if($.trim($("#commentArea").val()) == "" || $.trim($("#commentArea").val()) == "Type Text Here"){
		$("#commentArea").css("border","1px solid red");			  
		 return false;
		 }
	
	else{
			$("#commentArea").css("border","0px ");
		}
                $('#post_type').val(PostSms);
		checkBadwords();
		
		
}
function checkBadwords(){
	dataString = $('form[name=publicPost]').serialize();
		$.ajax({
				type: "POST",
				url:base_url+"ajax/user-ajax.php?mode=checkComment",
				cache: false,
				data: dataString,
				dataType: "json",
				success: function(data) {
				 if(data.success == "yes")
				  	{    
                                            show_postAbout();
					}
					else if(data.success == "no")
				  	{    
						  if(data.status=="badwords"){alert("Please avoid bad words from post");}
						 $("#commentArea").css("border","1px solid red");	
					}
				
					else {
						alert(" Occured internal Error.please check network connection" );
					}
				}
		});
}

function notValid(){
	  alert("Please login to post");
	   return false;
}
function notValidSearch(){
	  alert("Please login to Search");
	   return false;
}
function notValidUser(){
	//alert("Please Register/Login");
	alert("Please Login");
	return false;
}
function show_postAbout()
{
	//$("body").append('<div class="modalOverlay">');
	$('#person_area').hide();
	$('#place_area').hide();
	$('#other_area').hide();
	 $('input[name=post_about]:checked').attr('checked', false);
	$('.modalOverlay').show();
	$('.post_about').show("slow");
	
}
function skipPost(v){
	
	if(v==1){
		 $('input[name=post_about]:checked').attr('checked', false);
	 $('.post_about').hide();
	
	}
	if(v==2)
	{
			$('#email').val("");
			 $('.email_add').hide();
	}
	$('.modalOverlay').hide();
	//$('#place_name').val("");
	//$('#other_desc').val("");
	//$('#other_desc').val("");
	
	postComment();
}
function show_nextEmail(){
	 
		if($.trim($("#first_name").val()) == "" || $.trim($("#first_name").val()) == "Type first name here"){
			$("#first_name").css("border","1px solid red");			
			return false;
		}
		else{
		$("#first_name").css("border","1px solid #CCCCCC");
		}
		if($.trim($("#last_name").val()) == "" || $.trim($("#last_name").val()) == "Type last name here"){
			$("#last_name").css("border","1px solid red");			
			return false;
		}
		else{
		$("#first_name").css("border","1px solid #CCCCCC");
		}
	 $('.post_about').hide();
         // check which text to show in labels start Added by SB on 12-11-2014
         if($('#post_type').val()=='sms')
         {
            $('#h3LablelId').html('Anonymously SMS this message to somebody after posting it?');
         }
         else
         {
             $('#h3LablelId').html('Anonymously email this message to somebody after posting it?');
         }
          // check which text to show in labels end Added by SB on 12-11-2014
        $('.email_add').show("slow");
	
}
function post_withComment(){
	var postAbout=$('input[name=post_about]:checked').val();
	if(postAbout=="place"){
		if($.trim($("#place_name").val()) == "" || $.trim($("#place_name").val()) == "Type name of place here"){
			$("#place_name").css("border","1px solid red");			
			return false;
		}
		else{
		$("#place_name").css("border","1px solid #CCCCCC");
	}
	}
	if(postAbout=="other"){
		if($.trim($("#other_desc").val()) == "" || $.trim($("#other_desc").val()) == "Type text here"){
			$("#other_desc").css("border","1px solid red");			
			return false;
		}
		else{
		$("#other_desc").css("border","1px solid #CCCCCC");
	}
	}
	
	 $('.post_about').hide();
	// $('.modalOverlay').hide();
	// postComment();
         // check which text to show in labels start Added by SB on 12-11-2014
         if($('#post_type').val()=='sms')
         {
            $('#h3LablelId').html('Anonymously SMS this message to somebody after posting it?');
         }
         else
         {
             $('#h3LablelId').html('Anonymously email this message to somebody after posting it?');
         }
          // check which text to show in labels end Added by SB on 12-11-2014
	$('.email_add').show("slow");
	
}

function sendAlert(){
	
        if($('#post_type').val()=='sms')
         {
              if($.trim($("#email").val()) == ""){
                            $("#email").css("border","1px solid red");			
                            return false;
                    }
                    else{
                    $("#email").css("border","1px solid #CCCCCC");
                }
                // $('.email_add').hide();
                 // $('.modalOverlay').hide();
                
                dataString = $('form[name=publicPost]').serialize();

		dataString+="&"+ $('form[name=postAbout]').serialize();

		if($.trim($("#email").val()) != ""){

		dataString+="&"+ $('form[name=mailAlert]').serialize();	

		}
			 $.ajax({
				   type: "POST",
                                    url:base_url+"ajax/user-ajax.php?mode=sendSms",
                                    cache: false,
                                    data: dataString,
                                    dataType: "json",
                                    success: function(data) {
                                            if(data.success == "yes")
                                           {
                                               
                                                 $('#commentArea').val('');

                                                 $('#email').val('');

                                                 $('#my_post_span').html(parseInt($('#my_post_span').html())+1);
                                                 
                                                 $('.email_add').hide();
                                                 $('.modalOverlay').hide();
                                                 refreshPost();

                                           } 
                                           else if(data.success == "no")
                                           {

                                                 if(data.status == "notauser"){

                                                   alert("Please login to post");

                                                   }
                                                   else
                                                   {
                                                          alert("failed ");
                                                   }

                                           }
                                           else 
                                           {

                                               alert(" Occured internal Error.please check network connection" );

                                           }
                                    }
			});
                
         }
         else
         {
            if($.trim($("#email").val()) == "" || $.trim($("#email").val()) == "Enter email address here"){
                            $("#email").css("border","1px solid red");			
                            return false;
                    }
                    else{
                    $("#email").css("border","1px solid #CCCCCC");
                }
                $('.email_add').hide();
                // $('.modalOverlay').hide();
                // postComment();
                $('.email_from').show();
         }
	
	
}
function searchNow(){
	
	/* if($.trim($("#s_first_name").val()) == "" && $.trim($("#s_last_name").val()) == ""  && $.trim($("#s_age").val()) == "" &&
		$.trim($("#s_location").val()) == ""  && $.trim($("#s_zipcode").val()) == ""  && $.trim($("#s_nick_name").val()) == "" 
		&&$.trim($("#s_others").val()) == ""){
		//v=0;alert("1");
		alert("e1");return false;
	}
	 */
	  if($.trim($("#s_first_name").val()) == "FIRST NAME" && $.trim($("#s_last_name").val()) == "LAST NAME"  && $.trim($("#s_age").val()) == "AGE" &&
		$.trim($("#s_location").val()) == "LOCATION"  && $.trim($("#s_nick_name").val()) == "NICK NAME" && $.trim($("#s_groups").val()) == "GROUPS" 
		&& $.trim($("#s_pods").val()) == "PODS"){
		alert("Enter atleast one field");
		return false;
	 }
	
	$('#search-form').submit();
}
function sendEmailanonymousCheck(v){
	if(v==1) {
		 $('.modalOverlay').hide();
		 $('#emailidUser').val("0");
		 $('.email_from').hide();
		  postComment();
	}
	else{
		$('.modalOverlay').hide();
		$('#emailidUser').val("1");
		$('.email_from').hide();
		postComment();
	}
}

function forgotPw(){
	$('.modalOverlayHed').show();
	$('.forgot_pw').show();
}
function deleteOwnPost(id){
	var answer = confirm('Are you sure you want to delete this post?');
	if (answer)
		{
			 dataString='id='+id;
			 $.ajax({
				   type: "POST",
					url:base_url+"ajax/post-ajax.php?mode=deletePost",
					cache: false,
					data: dataString,
					dataType: "json",
					success: function(data) {
					if(data.success == "yes")
					  {    
						
						 //$("#message_txt").val('');
						 //$("#to_user").val('');
						 $('#my_post_span').html(parseInt($('#my_post_span').html())  - 1);
						$("#"+id).hide();
						
						}
					
						else {
							alert(" Occured internal Error.please check network connection" );
						}
					}
			});
		}
	else
	{
 	 console.log('cancel');
	}
}

$(document).ready(function() {

	var session_id;

	$("[id^=less_comment]").live("mouseover",function(){
		var idArr = this.id.split("_");
		var id = idArr[2];
		$("#less_comment_"+id).hide();
		$("#more_comment_"+id).show();
	});
	/*$("[id^=less_comment]").live("mouseover",function(){
		var idArr = this.id.split("_");
		var id = idArr[2];
		$("#less_comment_"+id).hide();
		$("#more_comment_"+id).show();
	}).live("mouseleave", function() {
		var idArr = this.id.split("_");
		var id = idArr[2];
		$("#more_comment_"+id).hide();
		$("#less_comment_"+id).show();
	});*/
	
	$("[id^=more_comment]").live("mouseleave",function(){
		var idArr = this.id.split("_");
		var id = idArr[2];
		$("#more_comment_"+id).hide();
		$("#less_comment_"+id).show();
		
	});
	
	$("[id^=grant_message]").live("click",function(){
		var idArr = this.id.split("_");
		var id = idArr[2];
		$("#grant_div_"+id).slideToggle('slow');
	});
	
	$("[id^=cancel_grant_button]").live("click",function(){
		var idArr = this.id.split("_");
		var id = idArr[3];
		$("#grant_div_"+id).slideUp();
	});
	
	$(".no_grant").live("click",function(){
		alert('You can not send message to Anonymous user');
	});
	
	$("[id^=grant_button]").live("click",function(){
		var idArr 		= this.id.split("_");
		var id 			= idArr[2]; 
		var grantText	= $("#grant_text_"+id).val();
		var toUser		= $("#to_user_"+id).val();
		var fromUser	= $("#from_user_"+id).val();
		if(grantText != "")
		{
			$.ajax({
					type: "POST",
					url: base_url+"ajax/message-ajax.php?mode=grant&to_user="+toUser+"&from_user="+fromUser+"&message="+grantText,
					cache: false,
					data: grantText,
					dataType: "html",
					success: function(data) { 
						alert('You have successfully sent message to the author');
						$("#grant_text_"+id).val('');
						$("#grant_div_"+id).hide();
					}
				});
			}
			else
			{
				$("#grant_text_"+id).css("border","1px solid red");
				$("#grant_text_"+id).focus();
			}
				
	});
	
	var referer	= '';
	var ref		= document.referrer;
	if(ref != '')
	{
		var arrreferer	= ref.split("/");
		var	referer1	= arrreferer[2].toString();
		var arrreferer1	= referer1.split("."); 
		var referer		= arrreferer1[1];
	}
	
	var url			= window.location; 
	var arrUrl		= url.toString().split("/");
	var redirect	= arrUrl[6]; //arrUrl[7]
	if(referer == 'google' || redirect == 'ref')
	{
		var page_name	= $('#page_name').val();
	
		if($('#user_session_id').val() == 0 && getCookie('baloon_pop_up') != 1 && getCookie('don_show_again') != $('#session_id').val() && page_name != 'signup')	//	$('#user_session_id').val() == 0 && 
		{
			
				/*$.blockUI({ 
					message: $('#ballon_popup_frm'),
				});*/
				
				var questionDiv	= 0;
				$('.baloon').animate({
						left: '+=355px'
					}, 2000);
					
				var length = $(".question_div").length - 1;
					
				var i = 1;
				
				$('#back_options').hide();
					
				$('#more_options').click(function(){ 
						setTimeout(function(){ 
							$(".question_div:eq("+questionDiv+")").hide();
							questionDiv = questionDiv+1;
							$(".question_div:eq("+questionDiv+")").show();
							$('#back_options').show();
							if(i==2){
								$('#don_show').hide();
								$('#more_options').hide();
							}
							i++;
						}, 500);
				});
				
				$('#back_options').click(function(){ 
						setTimeout(function(){ 
							$(".question_div:eq("+questionDiv+")").hide();
							questionDiv = questionDiv-1;
							$(".question_div:eq("+questionDiv+")").show();
							$('#don_show').show();
							$('#more_options').show();
							if(i==2){
								$('#back_options').hide();
							}
							i--;
						}, 500);
				});
					
				$('.ballon_popup_radio').click(function(){
						setTimeout(function(){ 
							$(".question_main_div").hide();
							$("#register_account").show();
						}, 500);
				});
					
				$("#thanks_skip").click(function(){
					var cookieName	= 'baloon_pop_up';
					var value		= 1;
					var exdays		= 30;
					setCookie(cookieName,value,exdays);
					//$.unblockUI();
					$('.baloon').animate({
						left: '-=355px'
					}, 2000);
				});
					
				$("#don_show").click(function(){ 
					var cookieName	= 'don_show_again';
					var value		= $('#session_id').val();
					var date = new Date();
					var minutes = 60;
					date.setTime(date.getTime() + (minutes * 60 * 1000));
					
					setCookie(cookieName,value,date);
					//$.unblockUI();
					$('.baloon').animate({
						left: '-=355px'
					}, 2000);
					
				});
				
				$(".baloon_pop_up_close").click(function(){
					$('.baloon').animate({
						left: '-=355px'
					}, 2000);
				});
					
				$('.register_account_radio').click(function(){
					var radio_value = $('input[name=register_or_account]:radio:checked').val();
					if(radio_value == 'register')
					{
						window.location.href = base_url+"signup";
						//$.unblockUI();
					}
					else if(radio_value == 'account')
					{
						setTimeout(function(){ 
							$('.baloon').animate({
								left: '-=355px'
							}, 2000);
							scrollWin();
							$('#loginUsername').focus();
							return false;
							}, 500);
					}
						
				});
					
				function scrollWin(){
					$('html,body').animate({
						scrollTop: $("#loginUsername").offset().top
						}, 2000);
						$.unblockUI();
				}
					
			}
	}
		
});

function setCookie(c_name,value,exdays)
{
	var exdate	= new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie	= c_name + "=" + c_value;
	return document.cookie;
}

function getCookie(c_name)
{
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	{
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name)
		{
			return unescape(y);
		}
	}
}

function more_link(url)
{
	window.location.href=url;
}