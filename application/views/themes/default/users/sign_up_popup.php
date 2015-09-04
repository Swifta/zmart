<div class="shadow_bg"></div>
            <div class="sign_up_outer">  	                        
                    <div class="sign_up_logo">
                        <a href="<?php echo PATH;?>"><img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png"/></a>
                        <a class="close2" title="<?php echo $this->Lang['CLOSE']; ?>" id="close1"></a>
                    </div>				
                <div class="signup_content new_user_signup clearfix">
                    <div class="signup_form_block">
                        <h2 class="signup_title"><?php echo $this->Lang['USER_SIGN_UP']; ?></h2>
                        <form name="signup" method="post"  onsubmit="return validatesignup();" action="<?php echo PATH; ?>users/signup">
                            <ul>                               
                            <li>
                                <label><?php echo $this->Lang["NAME"]; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                   <input name="f_name" type="text" maxlength="20"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" value="" autofocus />
                                   <em id="fname_error"></em>
                                </div>   
                            </li>
                             <li>
                                <label><?php echo $this->Lang['AGE_RNG']; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
									<select name="age_range">
										<option value=""><?php echo $this->Lang['SEL_AGE_RNG']; ?></option>
										<option value="1" ><?php echo $this->Lang["17_BEL"]; ?></option>
										<option value="2"><?php echo $this->Lang["18_25"]; ?></option>
										<option value="3"><?php echo $this->Lang["26_35"]; ?></option>
										<option value="4"><?php echo $this->Lang["36_45"]; ?></option>
										<option value="5"><?php echo $this->Lang["46_65"]; ?></option>
										<option value="6"><?php echo $this->Lang["66_ABV"]; ?></option>
									</select>
                                  <em id="age_range_error"></em>
                                </div>   
                            </li>
                            <li>
                                <label><?php echo $this->Lang['EMAIL']; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                  <input name="email" type="text" maxlength="64" placeholder="<?php echo $this->Lang['ENTER_EMAIL']; ?>" value="" />
                                  <em id="emai_error"></em>
                                </div>   
                            </li>
                             <li>
                                <label><?php echo $this->Lang['GENDER']; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
									 <select name="gender">
										<option value=""><?php echo $this->Lang["SEL_GEN"]; ?></option>
										<option value="1"><?php echo $this->Lang["MALE"]; ?></option>
										<option value="2"><?php echo $this->Lang["FEMALE"]; ?></option>
									 </select>
                                  <em id="gender_error"></em>
                                </div>   
                            </li>
                            <li>
                                <label><?php echo $this->Lang['PASSWORD'];?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                    <input name="password" maxlength="15" placeholder="<?php echo $this->Lang['ENTER_PASS']; ?>" type="password" value="" />
                                    <em id="pass_error"></em>
                                </div>   
                            </li>
                            <li>
                                <label><?php echo $this->Lang['CPASSWORD'];?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                    <input name="cpassword" maxlength="15" placeholder="<?php echo $this->Lang['ENTER_CPASS']; ?>" type="password" value="" />
                                    <em id="cpass_error"></em>
                                </div>   
                            </li>


                            <li>
                                <label><?php echo $this->Lang['SEL_COUNTRY'];?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                    <select name="country" onchange="return city_change_merchant(this.value);">
                                            <option value="-99"><?php echo $this->Lang['SELECT_Y_COUNTRY']; ?></option>
                                           <?php foreach ($this->all_country_list as $c) { ?>
                                             <option  title="<?php echo $c->country_name; ?>" value="<?php echo $c->country_id; ?>" ><?php echo $c->country_name; ?></option>
											<?php } ?>
                                    </select>
                                     <em id="country_error"></em>
                                </div>
                            </li>
                            <li>
                                <label><?php echo $this->Lang['SEL_CITY'];?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                        <div id="CitySD_log">
                                      <select name="city" >
                                            <option value="-99"><?php echo $this->Lang['COUNTRY_FIRST']; ?></option>
                                    </select>
                                    </div>
                                     <em id="city_error"></em>
                                </div>
                           </li>
			    <li>
                                <label><?php echo $this->Lang['UNIQ_IDEN'];?>:<span class="form_star"></span></label>
                                <div class="fullname">
                                    <input name="unique_identifier" maxlength="15" placeholder="<?php echo $this->Lang['ENTER_UNIQ_IDEN']; ?>" type="text" value="" />
                                </div>   
                                <label></label>
                            </li>
                           <li class="check_box">
                                <p><input type="checkbox" name="terms" id="termsquantity" value="terms"><?php echo $this->Lang['BY_CLICKING_SUBMIT']; ?> 									
                                <a class="forget_link" target="_blank" title="<?php echo $this->Lang['TEMRS']; ?>" href="<?php echo PATH; ?>terms-and-conditions.php"><?php echo $this->Lang['TEMRS']; ?></a>									
                                </p>
                                <em id="terms_error"></em>
                            </li>
                            
                            <li>                                  
                                <input class="sign_submit" type="submit" title="Sign Up" value="Sign Up" /> 
                            </li>
                            </ul>
                        </form>
                    </div>
                    <div class="signup_social_block">                        
                        <p><?php echo $this->Lang['SIGN_IN_WITH']; ?>..</p>
                        <a class="f_connect" onclick="facebookconnect();" title="<?php echo $this->Lang['FB_CONN']; ?>">&nbsp;</a>
                        <p><?php echo $this->Lang['ALREADY_A_MEMBER']; ?> <a class="forget_link" title="<?php echo $this->Lang['SIGN_IN']; ?> " href="javascript:showlogin();"><?php echo $this->Lang['SIGN_IN']; ?> </a> </p>                                                   
                    </div>
                </div>                          
            </div>
              

<script type="text/javascript">
$(document).ready(function(){
$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer 				   		   
//Close Popups and Fade Layer
$('#close1').live('click', function() {
		$('.popup_block1').css({'display' : 'none'});
		
		$('#fade').css({'visibility' : 'hidden'});
			//  location.reload();
	
	return false;
});
	$(document).keyup(function(e) { 
        if (e.keyCode == 27) { // esc keycode
        	$('.popup_block1').css({'display' : 'none'});
			$('#fade').css({'visibility' : 'hidden'});
	  	
		
		return false;
        }
    });
});

function validatesignup()
{
		
	var fname = document.signup.f_name.value;	
	var email = document.signup.email.value;	
	var password = document.signup.password.value;
	var cpassword = document.signup.cpassword.value;
	var city = document.signup.city.value;
	var country = document.signup.country.value;
	var terms = document.getElementById('termsquantity').checked;
	var atpos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	var gender = document.signup.gender.value;	
	var age_range = document.signup.age_range.value;	
	
	if(fname == '' || email =='' || password == '' || cpassword == ''|| terms == 'false' || (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) || city == '-99'|| city == '' || gender =='' || age_range=='')
	{
		if(fname == ''){
			$('#fname_error').html("<?php echo $this->Lang['PLS_ENT_NAM']; ?>");
		}
		else {
			$('#fname_error').html('');
		}
		if(password == '')
		{
			$('#pass_error').html("<?php echo $this->Lang['PLS_ENT_PASS']; ?>");
		}
		else {
			$('#pass_error').html('');
		}
		if(cpassword == '')
		{
			$('#cpass_error').html("<?php echo $this->Lang['PLS_ENT_CPASS']; ?>");
		}
		else {
			$('#cpass_error').html('');
		}
		
		if(country == '-99'){
			$('#country_error').html("<?php echo $this->Lang['PLS_SEL_COUNTRY']; ?>");
		
		}
		else {
			$('#country_error').html('');
		}
		
		if(city == '-99'){
			$('#city_error').html("<?php echo $this->Lang['PLS_SEL_COUNTRY_FIR']; ?>");
		
		}
		else {
			$('#city_error').html('');
		}
		if(city == ' '){
			$('#city_error').html("<?php echo $this->Lang['PLS_SEL_COUNTRY_FIR']; ?>");
		
		}
		else {
			$('#city_error').html('');
		}
		
		if ( document.getElementById('termsquantity').checked == false )  {
		        $('#terms_error').html("<?php echo $this->Lang['PLEASE_SELECT_TERMS']; ?>");
                }

		if(email == '') {
			$('#emai_error').html("<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>");
		}
		else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
		{
			$('#emai_error').html("<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>");
			document.signup.email.value = '';
			document.signup.password.value = '';
		}
		else {
			$('#emai_error').html('');
		}
		if(gender == ''){
			$('#gender_error').html("<?php echo $this->Lang['PLS_ENT_NAM']; ?>");
		}
		else {
			$('#gender_error').html('');
		}
		if(age_range == ''){
			$('#age_range_error').html("<?php echo $this->Lang['PLS_ENT_NAM']; ?>");
		}
		else {
			$('#age_range_error').html('');
		}
		
		return false;
		
	}
	else{
		
		if (password != cpassword) {
                        document.signup.password.value = "";
                        document.signup.cpassword.value = "";
                        $('#country_error').html('');
                        $('#emai_error').html('');
                        $('#city_error').html('');
                        $('#pass_error').html('');
                        $('#fname_error').html('');
						$('#gender_error').html('');
						$('#age_range_error').html('');
                        $('#cpass_error').html("<?php echo $this->Lang['PCPM']; ?>");
                        return false;
                 }
                else {
                    $('#cpass_error').html('');
                    
                }
                
                if ( document.getElementById('termsquantity').checked == false )  {
		        $('#terms_error').html("<?php echo $this->Lang['PLEASE_SELECT_TERMS']; ?>");
		        return false;
                }
		var url= Path+'users/check_user_signup/?email='+email;
		$.post(url,function(check){
			if(check == -1){
				$('#emai_error').html("<?php echo $this->Lang['EMAIL_EXIST']; ?>");
				
				document.signup.email.value = '';
				document.signup.password.value = '';
				$('#city_error').html('');
				return false;
			}
			
			document.signup.submit();
		});
	}
	return false;
}

</script> 

