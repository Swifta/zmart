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
                          </li>
                      </ul>                                                                       
                  </form>
              </div>
              <div class="signup_social_block">                
                      <p><?php echo $this->Lang['SIGN_IN_WITH']; ?></p>
                      <a class="f_connect" onclick="facebookconnect();" title="<?php echo $this->Lang['SIGN_UP_WITH']; ?>">&nbsp;</a>
                      <p><?php echo $this->Lang['DONT_HAV']; ?> <a class="forget_link" title="<?php echo $this->Lang['SIGN_UP']; ?>" href="javascript:showsignup();"><?php echo $this->Lang['SIGN_UP']; ?></a> </p>                
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

function validateForms()
	{
		
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

	
	}
	
</script>


