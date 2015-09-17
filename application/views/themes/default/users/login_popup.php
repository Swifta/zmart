    <script type="text/javascript">
  (function() {
    var po = document.createElement('script');
    po.type = 'text/javascript'; po.async = true;
    po.src = 'https://plus.google.com/js/client:plusone.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(po, s);
  })();
    </script>
    

<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
	<div class="shadow_bg"></div>
        <div class="sign_up_outer">  
            <div class="sign_up_logo">
                <a href="<?php echo PATH;?>"><img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png"/></a>        	
                <a class="close2" title="<?php echo $this->Lang['CLOSE']; ?>" id="close">&nbsp;</a>                
            </div>
            <div class="signup_content clearfix">
              <div class="signup_form_block">
                  <h2 class="signup_title"><?php echo $this->Lang['LOGIN']; ?></h2>
                  <form id="login" name="login" method="post" action="<?php echo PATH; ?>users/login" onsubmit="return validateForms();"  autocomplete="off">
                      <ul>
                          <li>
                              <label><?php echo $this->Lang['EMAIL']; ?>:<span class="form_star">*</span> </label>                        
                              <div class="fullname">
                                  <input type="text" value="" name="email" maxlength="128" placeholder="<?php echo $this->Lang['ENTER_EMAIL']; ?>" autocomplete="off" />                        
                                  <em id="email_error"></em>                    
                              </div>   
                          </li>
                          <li>
                              <label><?php echo $this->Lang['PASSWORD']; ?>:<span class="form_star">* </span> </label>
                              <div class="fullname">
                                  <input type="password" maxlength="15" placeholder="<?php echo $this->Lang['ENTER_PASS']; ?>" value="" name="password" autocomplete="off">                         
                                  <em id="password_error"></em>                    
                              </div>
                          </li>                    
                          <li>                        
                            <?php  $val = $_SERVER['PHP_SELF'];
                                              $scriptname=end(explode('index.php/',$val));
                                      ?>
                                   <input type="hidden" placeholder="Enter your password here" value="<?php echo $scriptname;?>" name="url" autocomplete="off" class="fancy_input_bx" />
                          <a class="forget_link" href="javascript:showforgotpassword();" title="<?php echo $this->Lang['FORGOT_PASS']; ?>?"><?php echo $this->Lang['FORGOT_PASS']; ?>?</a>
                          </li>
                          <li>
                              <input class="sign_submit" type="submit" value="<?php echo $this->Lang['SIGN_IN']; ?>" title="<?php echo $this->Lang['SIGN_IN']; ?>" onclick="return validateForms();">
                               <input id = "id_z_offer_click_status" type="hidden" value="0"/>
                          </li>
                      </ul>                                                                       
                  </form>
              </div>
              <div class="signup_social_block">                
                      <p><?php echo $this->Lang['SIGN_IN_WITH']; ?></p>
                      <a class="f_connect" onclick="facebookconnect();" title="<?php echo $this->Lang['SIGN_UP_WITH']; ?>">&nbsp;</a>
<br />
    <button class="g-signin g_connect" 
            data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email"
            data-requestvisibleactions="http://schemas.google.com/AddActivity"
            data-clientId="997154646959-uttoqigl36r6gpg5a4eht2tn9jru7taq.apps.googleusercontent.com"
            data-accesstype="offline"
            data-callback="signinCallback"
            data-theme="dark"
            data-cookiepolicy="single_host_origin">
    </button>
<!--<button class="g-signin g_connect"
        data-scope="https://www.googleapis.com/auth/plus.login"
        data-clientid="997154646959-uttoqigl36r6gpg5a4eht2tn9jru7taq.apps.googleusercontent.com"
        data-callback="signinCallback"
        data-theme="dark"
        data-cookiepolicy="single_host_origin"
        data-requestvisibleactions="http://schemas.google.com/AddActivity"
        data-width="wide">Hello
    </button>--><br />
                        <!--<a class="t_connect" onclick="disconnectUser();" title="<?php echo $this->Lang['TWITTER_CONN']; ?>">&nbsp;</a>-->
                      <p><?php echo $this->Lang['DONT_HAV']; ?> <a class="forget_link" title="<?php echo $this->Lang['SIGN_UP']; ?>" href="javascript:showsignup($('#id_z_offer_click_status').val());"><?php echo $this->Lang['SIGN_UP']; ?></a> </p>                
              </div>
            </div>
        </div>
<script type="text/javascript">
$(document).ready(function(){

$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer 				   		   
//Close Popups and Fade Layer
$('#close').live('click', function() { //When clicking on the close or fade layer...
	$('#popup1').css({'visibility' : 'hidden'});
		$('.popup_block').css({'display' : 'none'});
		$('#fade').css({'visibility' : 'hidden'});
		  //location.reload();
	
	
	return false;
});
		$(document).keyup(function(e) { 
        if (e.keyCode == 27) { // esc keycode
            $('#popup1').css({'visibility' : 'hidden'});
			$('.popup_block').css({'display' : 'none'});
			$('#fade').css({'visibility' : 'hidden'});
	  	
		
		return false;
        }
    });
});


var token;
var full_name;
var gpclass = (function(){

//Defining Class Variables here
var response = undefined;
return {
        //Class functions / Objects

        mycoddeSignIn:function(response){
                // The user is signed in
                if (response['access_token']) {
                    token = response['access_token'];
                        //Get User Info from Google Plus API
                        gapi.client.load('plus','v1',this.getUserInformation);

                } else if (response['error']) {
                        // There was an error, which means the user is not signed in.
                        //alert('There was an error: ' + authResult['error']);
                }
        },

        getUserInformation: function(){
                var request = gapi.client.plus.people.get( {'userId' : 'me'} );
                request.execute( function(profile) {
                        var email = profile['emails'].filter(function(v) {
                                return v.type === 'account'; // Filter out the primary email
                        })[0].value;
                        var fName = profile.displayName;
                        //alert(fName);
                        //alert(email);
                        disconnectUser();
                        location.href='/zmart/google-connect.php?full_name='+fName+'&email='+email
                        //$("#inputFullname").val(fName);
//                        /$("#inputEmail").val(email);
                        
                });
        }

}; //End of Return
})();

function signinCallback(gpSignInResponse) {
    gpclass.mycoddeSignIn(gpSignInResponse);
//  if (authResult['access_token']) {
//    // Successfully authorized
//    token = authResult['access_token'];
//    //gapi.client.setApiKey('997154646959-uttoqigl36r6gpg5a4eht2tn9jru7taq.apps.googleusercontent.com'); //set your API KEY
//    //gapi.client.load('plus', 'v1',function(){});//Load Google + API
//
//   alert("here");
//    //then redirect to URL
//    //location.href='/ecommerce/google-connect.php?full_name='+fullName+'&email=';
//    //document.getElementById('signinButton').setAttribute('style', 'display: none');
//
//  } else if (authResult['error']) {
//    // There was an error.
//    // Possible error codes:
//    //   "access_denied" - User denied access to your app
//    //   "immediate_failed" - Could not automatially log in the user
//    // console.log('There was an error: ' + authResult['error']);
//    alert("Failed");
//  }
}

function disconnectUser() {
  var revokeUrl = 'https://accounts.google.com/o/oauth2/revoke?token=' +
      token;

  // Perform an asynchronous GET request.
  $.ajax({
    type: 'GET',
    url: revokeUrl,
    async: false,
    contentType: "application/json",
    dataType: 'jsonp',
    success: function(nullResponse) {
      // Do something now that user is disconnected
      // The response is always undefined.
    },
    error: function(e) {
      // Handle the error
      // console.log(e);
      // You could point users to manually disconnect if unsuccessful
      // https://plus.google.com/apps
    }
  });
}

function validateForms()
	{
		/*
		var email = document.login.email.value;		
		var password = document.login.password.value;
		var atpos=email.indexOf("@");
		var dotpos=email.lastIndexOf(".");
		if(email =='' || password == '' || (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length))
		{
			
			if(password == '')
			{
				$('#password_error').html("<?php echo $this->Lang['PLS_ENT_PASS']; ?>");
			}
			else 
			{
				$('#password_error').html('');
			}
			if(email == '')
			{
				$('#email_error').html("<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>");

			}
			
			else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
			{
				$('#email_error').html("<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>");
				//document.login.email.value = '';
				document.login.password.value = '';
			}
			else {
				$('#email_error').html('');
			}

		return false;	
		}
		
		else{
			
			var url= Path+'users/check_user_login/?email='+email+'&password='+password;
			$.post(url,function(check){
				if(check == -1)
				{
					$('#email_error').html('');
					$('#password_error').html("<?php echo $this->Lang['EMAIL_PASS_NT_MCH']; ?>");
					//document.login.email.value = '';
					document.login.password.value = '';
					return false;
					
				}
			
				else if(check == 8){
					$('#email_error').html("<?php echo $this->Lang['USER_BLK_AD']; ?>");
					$('#password_error').html('');
					//document.login.email.value = '';
					document.login.password.value = '';
					
				}
				
				else if(check == 1){ 
					document.login.submit();
				}
			});
			return false;	
		}
*/

var email = document.login.email.value;		
		var password = document.login.password.value;
		var atpos=email.indexOf("@");
		var z_offer = $('#id_z_offer_click_status').val();
		var dotpos=email.lastIndexOf(".");
		if(email =='' || password == '' || (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length))
		{
			
			if(password == '')
			{
				$('#password_error').html("<?php echo $this->Lang['PLS_ENT_PASS']; ?>");
			}
			else 
			{
				$('#password_error').html('');
			}
			if(email == '')
			{
				$('#email_error').html("<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>");

			}
			
			else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
			{
				$('#email_error').html("<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>");
				//document.login.email.value = '';
				document.login.password.value = '';
			}
			else {
				$('#email_error').html('');
			}

		return false;	
		}
		
		else{
			
			var url= Path+'users/check_user_login/?email='+email+'&password='+password+'&z_offer='+z_offer;
			
			$.post(url,function(check){
				
				if(check == -1)
				{
					$('#email_error').html('');
					$('#password_error').html("<?php echo $this->Lang['EMAIL_PASS_NT_MCH']; ?>");
					//document.login.email.value = '';
					document.login.password.value = '';
					return false;
					
				}
			
				else if(check == 8){
					$('#email_error').html("<?php echo $this->Lang['USER_BLK_AD']; ?>");
					$('#password_error').html('');
					//document.login.email.value = '';
					document.login.password.value = '';
					
				}
				
				
				
				else if(check == -999){
					login_after_zenith_offer_click(email, password, z_offer);
					return false;
					
				}
				
				else if(check == 1){ 
					document.login.submit();
				}
			});
			return false;	
		}
		
		
	
	}
	
</script>


