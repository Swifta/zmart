	
    
    <div class="shadow_bg"></div>
        <div class="sign_up_outer">  
            <div class="sign_up_logo">
                <a href="<?php echo PATH;?>"><img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png"/></a>        	
                <a class="close2" title="<?php echo $this->Lang['CLOSE']; ?>" id="close_verify_acc">&nbsp;</a>                
            </div>
            <div class="signup_content clearfix">
              <div class="signup_form_block">
                  <h2 class="signup_title"><?php echo $this->Lang['ZENITH_ACCOUNT_OPEN']; ?></h2>
                  <!--
                  	TODO
                  	Client side validation of this form needed.
                    #Live 
                    
                    I have disabled the onsubmit function below
                    This is for form onsubmit event
                    ::::onsubmit="return validateForms();
                    
                    This is for the submit button.
                    ::::onclick="return validateForms();
                    
                    Backup for action
                    ::::<?php //echo PATH; ?>users/club_open_bank_account_user
                    
                    This was no Gender field.
                    ::::onchange="return city_change_merchant(this.value);"
                  ---->
                  
                  
                  <form id="zenith_account_open" name="zenith_offer" method="POST" onsubmit="return false" action="<?php echo PATH; ?>users/club_open_bank_account_user"   autocomplete="off">
                      <ul>
                            <li>
                                <label><?php echo $this->Lang["FIRST_NAME"]; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                   <input class="z_acc_input" name="f_name" type="text" maxlength="20"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" value="" autofocus />
                                   <em id="f_name_err"></em>
                                </div>   
                            </li>
                            
                            <li>
                                <label><?php echo $this->Lang["LAST_NAME"]; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                   <input name="l_name" class="z_acc_input" type="text" maxlength="20"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" value="" autofocus />
                                   <em id="l_name_err"></em>
                                </div>   
                            </li>
                            
                            
                             <li>
                                <label><?php echo $this->Lang['EMAIL']; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                  <input name="email" class="z_acc_input" type="text" maxlength="64" placeholder="<?php echo $this->Lang['ENTER_EMAIL']; ?>" value="" />
                                  <em id="email_err"></em>
                                </div>   
                            </li> 
                            
                            
                            <li>
                                <label><?php echo $this->Lang["PHO"]; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                   <input name="phone" class="z_acc_input" type="text" maxlength="20"  placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>" value="" autofocus />
                                   <em id="phone_err"></em>
                                </div>   
                            </li>
                            
                            <li>
                                <label><?php echo $this->Lang["ADDRES"]; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                   <input name="addr" class="z_acc_input" type="text" maxlength="20"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" value="" autofocus />
                                   <em id="addr_err"></em>
                                </div>   
                            </li>
                            
                            
                            
                            
                            
                                            
                            <li>
                                <label><?php echo $this->Lang['GENDER'];?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                    <select name="gender" class="z_acc_input" >
                                            <option value="-99"><?php echo $this->Lang['SEL_GENDER']; ?></option>
                                           
                                             <option  title="<?php echo $this->Lang['MALE']; ?>" value="M" ><?php echo $this->Lang['MALE']; ?></option>
                                             <option  title="<?php echo $this->Lang['FEMALE']; ?>" value="F" ><?php echo $this->Lang['FEMALE']; ?></option>
   
                                    </select>
                                     <em id="gender_err"></em>
                                </div>
                            

                            </li>
                            
                            
                            
                            <li>
                                <label><?php echo $this->Lang['ZENITH_BRANCH'];?>:<span class="form_star">*</span></label>
                                <div class="fullname" >
                                        <div id="CitySD_log">
                                      <select name="branch_no" id="id_z_branch"  class="z_acc_input">
                                            <option value="-99"><?php echo $this->Lang['ZENITH_SEL_BRANCH']; ?></option>
                                    </select>
                                    </div>
                                     <em id="branch_no_err"></em>
                                </div>
                            </li>
                            
                            
                              <li>
                                <label><?php echo $this->Lang['ZENITH_CLASS_CODE'];?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                        <div id="CitySD_log">
                                      <select name="class_code" id = "id_z_class" class="z_acc_input" >
                                            <option value="-99"><?php echo $this->Lang['ZENITH_SEL_CLASS']; ?></option>
                                    </select>
                                    </div>
                                     <em id="class_code_err"></em>
                                </div>
                            </li>
                            
                            
                           
                            
                            
                            <li class="check_box">
                                <p><input type="checkbox" name="terms" id="id_terms" class="z_acc_input" value="0" ><?php echo $this->Lang['Z_BY_CLICKING_SUBMIT']; ?> 									
                                <a class="forget_link" target="_blank" title="<?php echo $this->Lang['TEMRS']; ?>" href="<?php echo PATH; ?>zenith_terms-and-conditions.php"><?php echo $this->Lang['TEMRS']; ?></a>
                         								
                                </p>
                                <em id="terms_err"></em>
                            </li>
                          <li>
                          
                              
                              <!--
                                    I have remove this from the input field below. and commented out original input field.
                                    ::return validateForms();
                                    ::<input class="sign_submit" type="submit" value="Open Account" title="OPEN ACCOUNT" />
                                    @Live
                              	-->
                               <input class="sign_submit" id ="id_z_open_account" type="submit" value="Open Account" title="Open Account">
                               
                          </li>
                      </ul>                                                                       
                  </form>
              </div>
              <div class="signup_social_block">
                  <h2 class="signup_title"><?php echo $this->Lang['ZENITH_ALREADY_HAVE_ACCOUNT']; ?></h2>
                      <p><?php echo $this->Lang['ZENITH_INFO_OFFER']; ?></p>
                      <form id="zenith_account_verify" name="zenith_offer"  
                            onsubmit="return false;"  autocomplete="off">
                      <ul>
                            <li>
                                <label><?php echo $this->Lang["ACCOUNT_NUMBER"]; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                   <input name="nuban" id="id_nuban" type="text" maxlength="10"  placeholder="<?php echo $this->Lang['ENTER_ACCOUNT_NUMBER']; ?>" value="" autofocus />
                                   <em id="z_acc_error"></em>
                                </div>   
                            </li>
                          <li>
                              <input class="sign_submit" id ="submit_acc" type="submit" value="<?php echo $this->Lang['Z_SUBSCRIBE NOW'];?>" title="Apply for Offer" onclick="return false;">
                          </li>
                      </ul>
                      </form>
                      <!--<a class="f_connect" onclick="return false;" title="<?php echo $this->Lang['SIGN_UP_WITH']; ?>">&nbsp;</a> -->
                      <p><?php echo $this->Lang['DONT_HAV']; ?> <a class="forget_link" title="<?php echo $this->Lang['SIGN_UP']; ?>" href="javascript:showsignup();"><?php echo $this->Lang['SIGN_UP']; ?></a> </p>                
              </div>
            </div>
        </div>
              

<script type="text/javascript">
$(document).ready(function(){
$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer 				   		   
//Close Popups and Fade Layer
$('#closeOffer').live('click', function() {
		$('.popup_block3').css({'display' : 'none'});
		
		$('#fade').css({'visibility' : 'hidden'});
			//  location.reload();
	
	return false;
});

$('#close_open_acc').live('click', function() {
		$('.popup_block3_0').css({'display' : 'none'});
		
		$('#fade').css({'visibility' : 'hidden'});
			//  location.reload();
	
	return false;
});

$('#close_verify_acc').live('click', function() {
		$('.popup_block3_1').css({'display' : 'none'});
		
		$('#fade').css({'visibility' : 'hidden'});
			//  location.reload();
	
	return false;
});

$(document).keyup(function(e) { 
	if (e.keyCode == 27) { // esc keycode
		$('.popup_block3').css({'display' : 'none'});
		$('#fade').css({'visibility' : 'hidden'});
	
	
	return false;
	}
});


/*if(password == '')
{
	$('#password_error').html("<?php //echo $this->Lang['PLS_ENT_PASS']; ?>");
}*/


$('#id_z_branch').focus(function(e) {
	
	if(is_branch_api_running){
	   return false;
   }
   is_branch_api_running = true;
   var sel_branch = $('#id_z_branch');
   var sel_opt_label = sel_branch.children('option').first();
   sel_opt_label.text("Loading branches...");
   sel_branch.css({'color':'#384'});
  
   javascript:get_zenith_branches(sel_branch);
   return;
   
});

$('#id_z_class').focus(function(e) {
	
	if(is_class_api_running){
	   return false;
   }
   is_class_api_running = true;
   var sel_class = $('#id_z_class');
   var sel_opt_label = sel_class.children('option').first();
   sel_opt_label.text("Loading classes...");
   sel_class.css({'color':'#384'});
  
   javascript:get_zenith_class(sel_class);
   return;
   
});

$('#id_z_open_account').click(function(e) {
	
	$('#f_name_err').text("");
	$('#l_name_err').text("");
	$('#email_err').text("");
	$('#phone_err').text("");
	$('#addr_err').text("");
	$('#gender_err').text("");
	$('#branch_no_err').text("");
	$('#class_code_err').text("");
	
	if(!document.getElementById('id_terms').checked){
		alert("Please accept terms before submitting");
		exit;
	}
	

	if(is_z_open_account_api_running){
	   return false;
   }
   
   is_z_open_account_api_running = true;
   javascript:open_zenith_account();
   return;
   
});


$('#submit_acc').click(function() {
	
			
			$('#z_acc_error').html('');
			
			var nuban = $('#id_nuban').val();
			if(nuban == ''){
				alert("Empty field");
				return false;
			}
			
			var reg = /\d{10}/;
			var is_no = reg.exec(nuban);
			if(!is_no){
				if(nuban.length != 10){
					alert("Zenith A/C no must be 10 digits.");
					return false;
				}
				
				alert("Only digits (i.e. 0,1, 2... 9)");
				return false;
			}
			
			if(is_z_verify_account_api_running){
				return false;	
			}
			
			
	
			is_z_verify_account_api_running = true;
			
			var url = Path+'users/club_registration_logged_in_user/'; 
			

	            $.ajax(
	            {
		        type:'POST',
		        url:url,
				data:{nuban:nuban},
		        cache:false,
		        async:true,
		        global:false,
		        dataType:"html",
		        success:function(check)
		        {
					
					is_z_verify_account_api_running = false;
					if(isNaN(check)){
						window.location.href = check;
						return;
					}
					
					/*
					  TODO
					  Need to internationalize the string below.
					  @Live
					 */
					
					if(check == -1){
						$('#z_acc_error').html("<?php echo "Sorry, Account verification failed. Please try again."; ?>");
						return;
					}
					
					
					
					$('#z_acc_error').html("<?php echo "Something went wrong. Please contact site admin."; ?>");
					return;
						
			
				 
		          
		        },
		        error:function()
		        {
					is_z_verify_account_api_running = false;
			        alert('No data found.');
		        }

	                });
		});
		

	
	
});


</script>