<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php if(!$this->UserID) { ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
		$('#fade').css({'filter' : 'alpha(opacity=100)'}).fadeIn();
		$('#fade').css({'visibility' : 'visible'});
		$('.popup_block4').css({'display' : 'block'});	
		
	});
</script>
<div class="popup_block4">
    <div class="shadow_bg"></div>
	<div class="sign_up_outer">
            <div class="sign_up_logo">
                <a href="<?php echo PATH; ?>product.html" class="close2" title="close" style="cursor:pointer;">&nbsp;</a>
                <a href="<?php echo PATH; ?>" title="<?php echo SITENAME; ?>"><img src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png" border="0" alt="" /></a>
            </div>
		<div class="signup_content clearfix">									
                        <div class="signup_form_block auction_pop_block">											
                            <h2 class="signup_title"><?php echo $this->Lang['USER_LOG']; ?></h2>
                            <form id="login" name="login1" method="post" action="" onsubmit="return validate_login();" autocomplete="off">
                                <ul>
                                    <li>
                                            <label><?php echo $this->Lang['EMAIL']; ?>:<span class="form_star"></span> </label>
                                            <div class="fullname">
                                                <input type="text" value="" name="email" placeholder="<?php echo $this->Lang['ENTER_EMAIL']; ?>" autocomplete="off" autofocus />
                                                <em id="email_error1"></em>
                                            </div>
                                    </li>                                    
                                    <li>
                                            <label><?php echo $this->Lang['PASSWORD']; ?>:<span class="form_star"></span> </label>
                                            <div class="fullname">
                                                <input type="password" placeholder="<?php echo $this->Lang['ENTER_PASS']; ?>" value="" name="password" autocomplete="off">
                                                <em id="password_error1"></em>
                                            </div>
                                    </li>
                                    <?php /*<li>
                                            <label ><a class="forgot" href="javascript:showforgotpassword();" title="<?php echo $this->Lang['FORGOT_PASS']; ?>?"><?php echo $this->Lang['FORGOT_PASS']; ?>?</a></label>
                                    </li> */ ?>
                                    <li>
                                        <input class="sign_submit" type="submit" value="<?php echo $this->Lang['LOGIN2']; ?>" >
                                    </li>
                                </ul>
                            </form>						
                        </div>								
                    </div>
                </div>
            </div>

	<script type="text/javascript">
            
            $(document).keyup(function(e) { 
			if (e.keyCode == 27) { // esc keycode
				//$('#popup1').css({'visibility' : 'hidden'});
			//	$('.popup1').css({'visibility' : 'hidden'});
			$('.popup_block4').css({'display' : 'none'});
			$('#fade').css({'visibility' : 'hidden'});
				window.location.href = '<?php echo PATH; ?>auction.html';
			
			return;
			}
		});
                
	$(document).ready(function(){
	$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
	$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer 				   		   
	//Close Popups and Fade Layer
	/*$('#close').live('click', function() { //When clicking on the close or fade layer...
		//$('#popup1').css({'visibility' : 'hidden'});
			$('.auction_login').css({'visibility' : 'hidden'});
			$('#fade').css({'visibility' : 'hidden'});
		
		
		return false;
	}); */
			
	});
	function validate_login()
		{

			var email = document.login1.email.value;	
			var password = document.login1.password.value;
			var atpos=email.indexOf("@");
			var dotpos=email.lastIndexOf(".");
			if(email =='' || password == '' || (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length))
			{
				if(password == '')
				{
					$('#password_error1').html('Required*');
				}
				else 
				{
					$('#password_error1').html('');
				}
				if(email == '')
				{
					$('#email_error1').html('Required*');

				}
				
				else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
				{
					$('#email_error1').html('Invalid email');
					document.login1.email.value = '';
					document.login1.password.value = '';
				}
				else {
					$('#email_error1').html('');
				}
				
			}
			else{
				
				var url= Path+'users/check_user_login/?email='+email+'&password='+password;
				$.post(url,function(check){
					if(check == -1)
					{
						$('#email_error1').html('');
						$('#password_error1').html("User name or Password doesn't match");
						document.login1.email.value = '';
						document.login1.password.value = '';
					}
				
					else if(check == 8){
						$('#email_error1').html('User Has been Blocked ! Contact Admin');
						$('#password_error1').html('');
						document.login1.email.value = '';
						document.login1.password.value = '';
					}
					
					else if(check == 1){ 
						document.login1.submit();
					}
				});
			}
			return false;
		
		}
		
	</script>

<?php } elseif($this->UserID == $this->storecredit_user){ ?>

<?php echo new View("themes/".THEME_NAME."/store_credits/storecredit_payment2"); ?>

<?php } else { ?>
	<form method="post" >
            <div class="auction_payment_spg">
                <div class="auction_payment_spg_inner">
                    <h2 class="signup_title"><?php echo $this->Lang['SORRY_NOT_BUY_AUC']; ?></h2>
                    <input class="sign_submit" type="button" value="<?php echo $this->Lang['CLK_IT']; ?>" onclick="window.location.href='<?php echo PATH; ?>auction.html'" >
                </div>
            </div>
	</form>
<?php } ?>
