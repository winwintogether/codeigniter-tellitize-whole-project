<div><?php if($username) {  $stat= 'loggedin'; } else { $stat= 'loggedout';  }?></div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
<style type="text/css">
.fb{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;
color:#FFFFFF;
}
</style>
<div id="FBauth"></div>
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId  : '265802783532850',
            status : true, // check login status
            cookie : true, // enable cookies to allow the server to access the session
            xfbml  : true, // parse XFBML
            //channelUrl : 'http://WWW.MYDOMAIN.COM/channel.html', // channel.html file
            oauth  : true // enable OAuth 2.0
        });
        if (window!=window.top) {
            FB.Canvas.setAutoResize();
        };
        FB.getLoginStatus(function(response) {
            if (response.authResponse) {
			
			        FB.api('/me', function(response) {
					
                     var query = FB.Data.query('select name, email, hometown_location, sex, pic_square from user where uid={0}', response.id);
                     query.wait(function(rows) {
                       //document.getElementById('name').innerHTML = rows[0].name + "<br />" +
                         //'<img src="' + rows[0].pic_square + '" alt="" />' + "<br />"+rows[0].email;
						 var stat='<?php echo $stat;?>';
						 if(stat=='loggedin'){
				        document.getElementById('name').innerHTML = '<img src="' + rows[0].pic_square + '" alt="" />';
						  }
						var name=rows[0].name;
						var email=rows[0].email;
                     
                     });
    });
	
	
                // logged in and connected user, someone you know

                // no user session available, someone you dont know
                var authbox = document.getElementById('FBauth');
                authbox.innerHTML="";
                var a = document.createElement('a');
                a.setAttribute("href","javascript:void();");
                a.setAttribute("onclick","FBlogin();");
				a.setAttribute("class","fb");
                a.innerHTML="FB Login";
                authbox.appendChild(a);

                window.FBlogin = function(){
                    FB.login(function(response) {
                        if (response.authResponse) {
						
					FB.api('/me', function(response) {
                     var query = FB.Data.query('select name, email, hometown_location, sex, pic_square from user where uid={0}', response.id);
                     query.wait(function(rows) {
					 //document.getElementById('name').innerHTML = '<img src="' + rows[0].pic_square + '" alt="" />';
						var name=rows[0].name;
						var email=rows[0].email;
						var uid=response.id;
	 $.ajax({ 
	  type: 'POST',                                     
	  url: '<?php echo base_url();?>ajax/email.php',                        
      data: 'email='+email+'&pass='+uid+'&name='+name,                        
      dataType: 'json',                   
      success: function(data)        
        {
		document.location.href="<?php echo base_url();?>fblogin/"+response.id+'/'+rows[0].email;
		}           
      });
                     
                     });
    });
						
						

                        } // Push user name for personalization.
                        else {
                            top.location.href = "http://118.94.177.106:8165/";
                              // user cancealed login.
							  
                        }
                    }, {scope: 'email'});
					
					
					
                };
				
                //
            
            }
            else {
                // no user session available, someone you dont know
                var authbox = document.getElementById('FBauth');
                authbox.innerHTML="";
                var a = document.createElement('a');
                a.setAttribute("href","javascript:void();");
                a.setAttribute("onclick","FBlogin();");
                a.innerHTML="Login with FB";
                authbox.appendChild(a);

                window.FBlogin = function(){
                    FB.login(function(response) {
                        if (response.authResponse) {
						

                        } // Push user name for personalization.
                        else {
                            top.location.href = "http://118.94.177.106:8165/";
                              // user cancealed login.
							  
                        }
                    }, {scope: 'email'});
                };
                //
            }
			
        });

        FB.Event.subscribe('auth.login', function(response) {
		
		
					 FB.api('/me', function(response) {
					
                     var query = FB.Data.query('select name, email, hometown_location, sex, pic_square from user where uid={0}', response.id);
                     query.wait(function(rows) {
					// document.getElementById('name').innerHTML = '<img src="' + rows[0].pic_square + '" alt="" />';
						var name=rows[0].name;
						var uid=response.id;
						var email=rows[0].email;

	 $.ajax({ 
	  type: 'POST',                                     
	  url: '<?php echo base_url();?>ajax/email.php',                        
      data: 'email='+email+'&pass='+uid+'&name='+name,                        
      dataType: 'json',                   
      success: function(data)        
        {
		document.location.href="<?php echo base_url();?>fblogin/"+response.id+'/'+rows[0].email;
		}           
      });
					 
    });
    })
		
});

        FB.Event.subscribe('auth.logout', function(response) {
		
            //top.location.href = "http://facebook.com/shawnsspace.com";
        });
    };
	
    (function() {
          var e = document.createElement('script'); e.async = true;
          e.src = document.location.protocol +
            '//connect.facebook.net/en_US/all.js';
          document.getElementById('fb-root').appendChild(e);
    }());
	
</script>
<div id="name1"></div>

