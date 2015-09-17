 <div class="shadow_bg"></div>
        <div class="sign_up_outer">  
            <div class="sign_up_logo">
                <a href="<?php echo PATH;?>"><img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png"/></a>        	
                <a class="close2" title="<?php echo $this->Lang['CLOSE']; ?>" id="close_verify_acc">&nbsp;</a>                
            </div>
            <div class="signup_content clearfix">
              
              <div class="signup_social_block zenith_verify_center">
                  <h2 class="signup_title"><?php echo $this->Lang['ZENITH_ALREADY_HAVE_ACCOUNT']; ?></h2>
                      <p><?php echo $this->Lang['ZENITH_INFO_OFFER']." "; ?>
                      
                      <br />
                      <br />
                      </p>
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
                              <input class="sign_submit" id ="submit_acc" type="submit" value="<?php echo $this->Lang['Z_SUBSCRIBE NOW'];?>" title="<?php echo $this->Lang['Z_SUBSCRIBE NOW'];?>" onclick="show_gif(this);">
                          </li>
                           <li>
                           <br />
                          <p><?php echo $this->Lang['Z_OPEN']; ?></p>
                          </li>
                          
                          <li>
                              <input class="sign_submit"  type="submit" value="OPEN A ZENITH BANK ACC." title="<?php echo $this->Lang['Z_SUBSCRIBE NOW'];?>" onclick="javascript:showmembershipsignup_open();">
                          </li>
                          
                      </ul>
                      </form>
                     <!-- <!--<a class="f_connect" onclick="return false;" title="<?php echo $this->Lang['SIGN_UP_WITH']; ?>">&nbsp;</a> -->
                    <!--  <p><?php echo $this->Lang['DONT_HAV']; ?> <a class="forget_link" title="<?php echo $this->Lang['SIGN_UP']; ?>" href="javascript:showsignup();"><?php echo $this->Lang['SIGN_UP']; ?></a> </p>  -->              
              </div>
            </div>
        </div>
              

<script type="text/javascript">
$(document).ready(function(){
$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer 				   		   
//Close Popups and Fade Layer
$('#close_verify_acc').live('click', function() {
		$('.popup_block3_0').css({'display' : 'none'});
		
		$('#fade').css({'visibility' : 'hidden'});
			//  location.reload();
	
	return false;
});

$(document).keyup(function(e) { 
	if (e.keyCode == 27) { // esc keycode
		$('.popup_block3_0').css({'display' : 'none'});
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




$('#id_z_open_accountx').click(function(e) {
	
	alert("XYM");
	
	
	
});




/*


	var sub_btn = $('#id_z_open_account').parent();
	var sub_btn_parent = sub_btn.parent().parent().parent().parent();
	var sub_btn_parent_bak = sub_btn_parent.html();
	
	sub_btn_parent.html("<div style = \"text-align:center\" ><img src = \"<?php echo PATH."images/anim/6.gif";?>\" /><p>Processing...</p></div>");
	
	
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
   
   var url = <?php echo PATH;?>+'users/club_open_bank_account_user'; 
	
	var fs = $($('.z_acc_input'));
	
	//var n1 = $(fs[0]).attr('name'); 
	var v1 = $(fs[0]).val();
	
	//var n2 = $(fs[1]).attr('name'); 
	var v2 = $(fs[1]).val();
	
	//var n3 = $(fs[2]).attr('name'); 
	var v3 = $(fs[2]).val();
	
	//var n4 = $(fs[3]).attr('name'); 
	var v4 = $(fs[3]).val();
	
	//var n5 = $(fs[4]).attr('name'); 
	var v5 = $(fs[4]).val();
	
	//var n6 = $(fs[5]).attr('name'); 
	var v6 = $(fs[5]).val();
	
	//var n7 = $(fs[6]).attr('name'); 
	var v7 = $(fs[6]).val();
	
	//var n8 = $(fs[7]).attr('name'); 
	var v8 = $(fs[7]).val();
	
	//var n9 = $(fs[8]).attr('name'); 
	var v9 = $(fs[8]).val();
	
	$('#terms_err').text('');
	
	var params_obj = {
		
		f_name:v1,
		l_name:v2,
		email:v3,
		phone:v4,
		addr:v5,
		gender:v6,
		branch_no:v7,
		class_code:v8,
		terms:v9
	}
	

	
	      $.ajax({
		        type:'POST',
		        url:url,
				data:params_obj,
		        cache:true,
		        async:true,
		        global:false,
		        dataType:"html",
		        success:function(response){
					sub_btn_parent.html(sub_btn_parent_bak);
					is_z_open_account_api_running = false;
					var res;
					try{
					var res = $(response);
					}catch(e){
					}
					
					
					if(isNaN(response) && res){
						var error_obj = res.children();
						if(error_obj){
							var errors = error_obj.children().children();
							if(errors)
							for(i = 0; i < errors.length; i++){
								var error_f_part = $(errors[i]).attr('key');
								var error_f = error_f_part+"_err";
								$("#"+error_f).text($(errors[i]).attr('value'));
							}
							exit;
						}
					
					}
					
					
					if(isNaN(response)){
						
						return false;
						
					}else{
						$('#terms_err').text("Sorry, something went wrong opening your account. Please try again.");
						
						exit;
						
					}
					
				
				return;
		
		        },
		       	 error:function(){
					 sub_btn_parent.html(sub_btn_parent_bak);
					is_z_open_account_api_running = false;
			        alert('No data found.');
		        }
		  });
*/


$('#submit_accxm').click(function() {
	
		
			var sub_btn = $('#submit_acc').parent();
			var sub_btn_parent = sub_btn.parent();
			var sub_btn_parent_parent_bak = sub_btn_parent.parent();
			var sub_btn_parent_bak = sub_btn_parent.html();
			
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
			sub_btn_parent.html("<img src = \"<?php echo PATH."images/anim/6.gif";?>\" /><p>verifying...</p>");
			

	            
		});
		
		
		

	
	
});


function show_gif(obj){
	
			var sub_btn = $(obj).parent();
			var sub_btn_parent = sub_btn.parent();
			var sub_btn_parent_bak = sub_btn_parent.html();
			
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
			sub_btn_parent.html("<img src = \"<?php echo PATH."images/anim/6.gif";?>\" /><p>verifying...</p>");
			
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
						sub_btn_parent.html(sub_btn_parent_bak);
						window.location.href = check;
						return false;
					}
					
					/*
					  TODO
					  Need to internationalize the string below.
					  @Live
					 */
					
					if(check == -1){
						sub_btn_parent.html(sub_btn_parent_bak);
						$('#z_acc_error').html("<?php echo "Sorry, Account verification failed. Please try again."; ?>");
						return false;
					}
					
					
					sub_btn_parent.html(sub_btn_parent_bak);
					$('#z_acc_error').html("<?php echo "Something went wrong. Please contact site admin."; ?>");
					return false;
						
			
				 
		          
		        },
		        error:function()
		        {
					sub_btn_parent.html(sub_btn_parent_bak);
					is_z_verify_account_api_running = false;
					$('#z_acc_error').html("<?php echo "Something went wrong. Please contact site admin."; ?>");
					return false;
		        }

	         });
			 
			return false;
	
}


</script>