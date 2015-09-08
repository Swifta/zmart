<div class="shadow_bg"></div>
            <div class="sign_up_outer">  	                        
                    <div class="sign_up_logo">
                        <a href="<?php echo PATH;?>"><img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png"/></a>
                        <a class="close2" title="<?php echo $this->Lang['CLOSE']; ?>" id="close4"></a>
                    </div>				
                <div class="signup_content new_user_signup clearfix">
                    <div class="signup_form_block">
                        <h2 class="signup_title"><?php echo $this->Lang['USER_FB_SIGN_UP']; ?></h2>
                        <form name="fb_signup" method="post"  onsubmit="return validatefbsignup();" action="<?php echo PATH; ?>users/fbsignup">
                            <ul>                               
                            <li>
								<label><?php echo $this->Lang['EMAIL']; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                  <input name="email" type="text" maxlength="64" placeholder="<?php echo $this->Lang['ENTER_EMAIL']; ?>" value="" />
                                  <em id="emai_error1"></em>
                                </div>   
                            </li>
                             
                            <li>                                  
                               
                            </li>
                            </ul>
                            <div class="signup_social_block">                        
                         <input class="sign_submit" type="submit" id="fb_signup" title="Sign Up" value="Sign Up" />                                                   
                    </div>
                        </form>
                    </div>
                    
                </div>                          
            </div>
              

<script type="text/javascript">
$(document).ready(function(){
$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer 				   		   
//Close Popups and Fade Layer
$('#close4').live('click', function() {
		$('.popup_block4').css({'display' : 'none'});
		
		$('#fade').css({'visibility' : 'hidden'});
			//  location.reload();
	
	return false;
});
	$(document).keyup(function(e) { 
        if (e.keyCode == 27) { // esc keycode
        	$('.popup_block4').css({'display' : 'none'});
			$('#fade').css({'visibility' : 'hidden'});
	  	
		
		return false;
        }
    });
});

function validatefbsignup()
{
		
		
	var email = document.fb_signup.email.value;	
		
	
	if(email =='')
	{
		
		if(email == '') {
			$('#emai_error1').html("<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>");
		}
		else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
		{
			$('#emai_error1').html("<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>");
			document.fb_signup.email.value = '';
			
		}
		else {
			$('#emai_error1').html('');
		}
		
		
		return false;
		
	}
	else{
		
		var url= Path+'users/check_user_signup/?email='+email;
		$.post(url,function(check){
			if(check == -1){
				$('#emai_error1').html("<?php echo $this->Lang['EMAIL_EXIST']; ?>");
				
				document.fb_signup.email.value = '';
				
				
				return false;
			}
			
			
			
			
		});
		var url = Path+'/users/fbsignup?email='+email; 
	//$.post(url,function(check){ $("#CitySD").html(check); /*document.getElementById('CitySD').innerHTML = check; */});
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,
		dataType:"html",
		success:function(check)
		{
			
			$('.popup_block4').css({'display' : 'none'});
			$('#fade').css({'visibility' : 'hidden'});
		     win2 = window.open(Path+'facebook-connect.php',null,'width=750,location=0,status=0,height=500');
        checkChild();
		},
		error:function()
		{
			
		}
	});
	}
	return false;
}

</script> 

