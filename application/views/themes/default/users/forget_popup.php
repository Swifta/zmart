<div class="shadow_bg"></div>
<div class="sign_up_outer">  	                        
    <div class="sign_up_logo">
        <a href="<?php echo PATH; ?>"><img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/logo.png"/></a>
        <a class="close2" title="close" onclick="hide_forgot_popup()" >&nbsp;</a>
    </div>	    
    <div class="signup_content clearfix">
        <div class="signup_form_block">
            <h2 class="signup_title"><?php echo $this->Lang['FORGOT_PASS']; ?></h2>
            <form name="forget_password" method="post" action="<?php echo PATH; ?>users/forgot" onsubmit="return validate_forget_password();">
                <ul>
                    <li>                
                        <label><?php echo $this->Lang['EMAIL']; ?>:<span class="form_star"> * </span></label>
                        <div class="fullname">
                            <input type="text" value="" placeholder="<?php echo $this->Lang['ENTER_EMAIL']; ?>" name="email"  />
                            <em id="femail_error"></em>
                            <em></em>
                        </div>                     
                    </li>                

                <li>  
                    <input class="sign_submit" type="submit" title="<?php echo $this->Lang['SUBMIT']; ?>" value="<?php echo $this->Lang['SUBMIT']; ?>" onclick="return validate_forget_password();"/>
                </li>
            </ul>
            </form>
        </div>

        <div class="signup_social_block">                    
            <p><?php echo $this->Lang['SIGN_IN_WITH']; ?></p>
            <a class="f_connect" onclick="facebookconnect();" title="<?php echo $this->Lang['SIGN_UP_WITH']; ?>">&nbsp;</a>
            <p><?php echo $this->Lang['ALREADY_A_MEMBER']; ?> <a class="forget_link" title="<?php echo $this->Lang['SIGN_IN']; ?> " href="javascript:showlogin();"><?php echo $this->Lang['SIGN_IN']; ?> </a> </p>                    
        </div>
    </div>                          
</div>



<script type="text/javascript">
    $(document).ready(function(){
        $(document).keyup(function(e) { 
            if (e.keyCode == 27) { // esc keycode
                $('.popup_block2').css({'display' : 'none'});
                $('#fade').css({'visibility' : 'hidden'});
	  	
		
                return false;
            }
        });
    });
    function hide_forgot_popup()
    {
        $('.popup_block2').css({'display' : 'none'});
        $('#fade').css({'visibility' : 'hidden'});
    }


    function validate_forget_password()
    {
		
        var email = document.forget_password.email.value;	
        var atpos=email.indexOf("@");
        var dotpos=email.lastIndexOf(".");
        if(email =='' || (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length))
        {
		
            if(email == '')
            {
                $('#femail_error').html("<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>");
                return false;
            }
		
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
            {
                $('#femail_error').html("<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>");
                document.forget_password.email.value = '';
                return false;
            }
		
            return false;	
        }
        else{
		
            var url= Path+'users/check_user_signup/?email='+email;
            $.post(url,function(check){ 
                if(check == -1){
                    document.forget_password.submit();
                    //return true;
                }else{
                    $('#femail_error').html("<?php echo $this->Lang['USER_NT_EX']; ?>");
                    return false;
                }
			
            });
            return false;
        }	
    }
</script>
