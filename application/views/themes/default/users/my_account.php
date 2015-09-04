<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/messi.min.js" ></script>
<script type="text/javascript" src="<?php echo PATH; ?>js/jquery-ui-1.8.11.custom.min.js" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/css/messi.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/css/jquery-ui-1.8.7.custom.css" />
<script type="text/javascript">
    function select_all()
    {
        var text_val=eval("document.form1.user_referral_url");
        text_val.focus();
        text_val.select();
    }
    function cancel_hide_pr() {
        $('.Editprofile').hide();
        $('#fname_error').html('');
        $('#user_name').show();
        $('#edit_hide').show();
    }
    function cancel_hide_pr3() {
        $('#shw_address').hide();
        $('#show3').show();
        $('.profile_edit_3').show();
    }
    function cancel_hide_pr4() {
        $('#shw_city').hide();
        $('#show4').show();
        $('.profile_edit4').show();
    }
    function cancel_hide_pr_2() {
        $('.Editprofile_2').hide();
        $('#city_ic').show();
        $('#city_user').show();
    }
    function cancel_hide_pr2() {
        $('#shw_phone').hide();
        $('.profile_edit_2').show();
        $('#show2').show();
    }
    function cancel_hide_pr_3() {
        $('.Editprofile_3').hide();
        $('#dob_ic').show();
        $('#dob_user').show();
    }
    function cancel_hide_pr_4() {
        $('.Editprofile_4').hide();
        $('#old_pass_error').html('');
        $('#new_pass_error').html('');
        $('#pass_error_1').html('');
        $('#password_ic').show();
        $('#password_user').show();
    }
    function cancel_hide_pr5() {
        $('#shw_country').hide();
        $('#show5').show();
        $('.profile_edit5').show();
    }
    /*gender cancel button */
     function cancel_hide_pr7() {
        $('#shw_gender').hide();
        $('#show7').show();
        $('.profile_edit7').show();
    }
    /*age range cancel button */
     function cancel_hide_pr8() {
        $('#shw_age_range').hide();
        $('#show8').show();
        $('.profile_edit8').show();
    }
    /* Unique identifier delete button */
    function cancel_hide_pr9() {
        $('#shw_unique_identifier').hide();
        $('#show8').show();
        $('.profile_edit9').show();
    }
    function popup_show() {
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#model_dailog" ).dialog({
            height: 470,
            width: 550,
            modal: true
        });
        $('.pop_close').click(function() {
            $('#model_dailog').remove();
            $('.ui-widget-overlay').remove();
            $('#empty_value').val('');
            window.location.reload();
        });
    }
    function canceljd_hide() {
        $('#model_dailog').remove();
        $('.ui-widget-overlay').remove();
    }
    window.onload = function () {
        var form = document.getElementById('admin_form'),
        imageInput = document.getElementById('empty_value_1');
        form.onsubmit = function () {
            if(imageInput.value==''){
                alert('The field should not be empty!');
                return false;
            }
            var iSize = ($("#empty_value_1")[0].files[0].size / 1024);
            var img = imageInput.files[0].size;
            iSize = (Math.round((iSize / 1024) * 100) / 100)
            if(iSize > 1){
                alert('The image  should  be less then or equal to 1 Mb!');
                return false;
            }
            $("#lblSize").html( iSize + "Mb");
            var isValid = /\.(jpe?g|gif|png)$/i.test(imageInput.value);
            if (!isValid) {
                alert('upload valid image format like jpg,png,jpeg format');
            }
            return isValid;
        }
    };
</script>
<script type="text/javascript">
    $(document).ready(function () {
    	/** Update profile **/
	$('a.Upprofile').live("click", function(e){
		var getUID =  $(this).attr('id').replace('Upprofile-','');
		var first_name = $("#fname-"+getUID).val();
		var last_name = $("#laneme-"+getUID).val();
		var ck_name = /^[A-Za-z0-9 ]{3,20}$/;
	if(first_name=='' || first_name==null){
			$("#fname_error_12").html('Required');
			$('.Editprofile').css('display','');
	 }
	else if (ck_name.test(first_name)==true) {
		e.preventDefault();
			$.post(Path+'users/update_name?first_name='+first_name+'&last_name='+last_name +'&user_id='+getUID, {
			}, function(response){
				$("#fname_error_12").html("");
				$('.Editprofile').css('display','none');
				$('#name_user').html(first_name+' '+last_name);
				$('#user_name').show();
				$('#edit_hide').show();
				//$('#name_user').html(last_name);
					$("body").append('<div class="modalOverlay"></div>');
			 		new Messi('<?php echo $this->Lang['USER_NAME_UPDATE_SUCC']; ?>'); 
					setTimeout(function() {
						$(".modalOverlay").fadeOut('slow');
						$(".messi-box").fadeOut('slow');
					}, 2000)
					return true;
			});
		}
	else{
		$("#fname_error_12").html("In Valid Name");
		$('.Editprofile').css('display','');
	 }
	});
	$('a.profile_edit_4').live("click", function(e){
					$('#password_user').css('display','none');
					$('#password_ic').css('display','none');
					$('.Editprofile_4').css('display','');
		});
/** Update Password **/
	$('a.Uppro_file_3').live("click", function(){
		var o_pass = $("#old_pass").val();
		var n_pass = $("#new_pass").val();
		var c_pass = $("#confirm_pass").val();
		
		
		
		
                if(o_pass==''){
	                $('#old_pass_error').html('Required');
                }
                if(n_pass==''){
	                $('#new_pass_error').html('Required');
                }
                if(c_pass==''){
	                $('#pass_error_1').html('Required');
	                return false;
                }
                
                var n = n_pass.length;
		if(n < 5){ 
		$('#new_pass_error').html('Password should be minimum 5 characters long.');
		 return false;
		}
                
		if(o_pass!='Enter Your Old Password*' && n_pass!='Enter Your New Password*' && c_pass!='Enter Your Confirm Password*'){
			if(n_pass!=c_pass){
				$('#pass_error_1').html("new password and confirm password doesn't match");
				$('#old_pass_error').html('');
				$('#new_pass_error').html('');
				$('.Editprofile_4').css('display','');
				$("#old_pass").val('');
				$("#new_pass").val('');
				$("#confirm_pass").val('');
			}
			else{
				$.post(Path+'users/update_password?o_pass='+o_pass+'&n_pass='+n_pass+'&c_pass='+c_pass, {
			}, function(response){
					if(response==-1){
						$('#old_pass_error').html("Old password doesn't match");
						$('#new_pass_error').html('');
						$('#pass_error_1').html('');
						$('.Editprofile_4').css('display','');
						$("#old_pass").val('');
						$("#new_pass").val('');
						$("#confirm_pass").val('');
					}
					else{
						$('.Editprofile_4').css('display','none');
						$('#password_ic').show();
						$('#password_user').show();
						$("#old_pass").val('');
						$("#new_pass").val('');
						$("#confirm_pass").val('');
						$('#old_pass_error').html('');
						$('#new_pass_error').html('');
						$('#pass_error_1').html('');
						$("body").append('<div class="modalOverlay"></div>');
						new Messi('<?php echo $this->Lang['PASS_UPDATE_SUCC']; ?>');
						setTimeout(function() {
						$(".modalOverlay").fadeOut('slow');
						$(".messi-box").fadeOut('slow');
					}, 2000)
						return true;

					}
			});
		}
	}
	
	});
	$('.profile_edit1').click(function(){
		$('.profile_edit1').hide();
		$('#show1').hide();
		$('#shw_lname').show();
	});
	$('a.Upprofile1').live("click", function(){
		var lname = $("#lname").val();
		var ck_name = /^[A-Za-z0-9 ]{3,20}$/;
		if (ck_name.test(lname)==true || lname=='') {
			$.post(Path+'users/update_last_name?lname='+lname, {
			}, function(response){
				$("#lname_error").html("");
				$('#show1').html(lname);
				$('#shw_lname').hide();
				$('#show1').show();
				$('.profile_edit1').show();
				//$('#name_user').html(last_name);
			 		//new Messi('User name updated Success fully');
			});
		}
	else{
		$("#lname_error").html("In Valid Name");
		return false;
	 }
	});
	$('a.profile_edit_2').click(function(){
		$('.profile_edit_2').hide();
		$('#show2').hide();
		$('#shw_phone').show();
	});
	$('a.Upprofile2').live("click", function(){
		var phone = $("#phone").val();
		var ck_name = /^[0-9 +-]{10,14}$/;
		if(ck_name.test(phone)==true || phone=='') {
			$.post(Path+'users/update_phone?phone='+phone, {
			}, function(response){
				$("#phone_error").html("");
				$('#show2').html(phone);
				$('#shw_phone').hide();
				$('#show2').show();
				$('.profile_edit_2').show();
				//$('#name_user').html(last_name);
			 		$("body").append('<div class="modalOverlay"></div>');
			 		new Messi('<?php echo $this->Lang['PHONE_UPDATE_SUCC']; ?>');
					setTimeout(function() {
						$(".modalOverlay").fadeOut('slow');
						$(".messi-box").fadeOut('slow');
					}, 2000)
					return true;
			});
		}
	else{
		$("#phone_error").html("In Valid Mobile number");
		return false;
	 }
	});
   
	$('a.profile_edit_3').click(function(){
		$('.profile_edit_3').hide();
		$('#show3').hide();
		$('#shw_address').show();
	});
	$('.downarow').click(function(){
	 var getUID =  $(this).attr('id').replace('downarow-','');
		$('#categeory-'+getUID).hide();
		$('#downarow-'+getUID).hide();
		$('#sample_new-'+getUID).show();
		$('.arrow1-'+getUID).remove();
		$('.arrow-'+getUID).show();
		window.location.reload(true);
	});
	$('a.Upprofile3').live("click", function(){
		var address1 = $("#address1").val();
		var address2 = $("#address2").val();
			$.post(Path+'users/update_address?address1='+address1+"&address2="+address2, {
			}, function(response){
				$('#show3').html(address1+","+address2);
				$('#shw_address').hide();
				$('#show3').show();
				$('.profile_edit_3').show();
		                $("body").append('<div class="modalOverlay"></div>');
			 		new Messi('<?php echo $this->Lang['ADD_UPDATE_SUCC']; ?>');
					setTimeout(function() {
						$(".modalOverlay").fadeOut('slow');
						$(".messi-box").fadeOut('slow');
					}, 2000)
					return true;
			});
	});
	$('.profile_edit4').click(function(){
		$('.profile_edit4').hide();
		$('#show4').hide();
		$('#shw_city').show();
	});
	$('a.Upprofile4').live("click", function(){
		var city = $("#city").val();
			$.post(Path+'users/update_city?city='+city, {
			}, function(response){
				$("#show4").html($('#city').find("option:selected").attr("title"));
				$('#shw_city').hide();
				$('#show4').show();
				$('.profile_edit4').show();
					$("body").append('<div class="modalOverlay"></div>');
			 		new Messi('<?php echo $this->Lang['CITY_UPDATE_SUCC']; ?>');
					setTimeout(function() {
						$(".modalOverlay").fadeOut('slow');
						$(".messi-box").fadeOut('slow');
					}, 2000)
					return true;
			});
	});
	$('.profile_edit5').click(function(){
		$('.profile_edit5').hide();
		$('#show5').hide();
		$('#shw_country').show();
	});
	$('a.Upprofile5').live("click", function(){
		var country = $("#country").val();
			$.post(Path+'users/update_country?country='+country, {
			}, function(response){
				$("#show5").html($('#country').find("option:selected").attr("title"));
				$('#shw_country').hide();
				$('#show5').show();
				$('.profile_edit5').show();
				$("body").append('<div class="modalOverlay"></div>');
			 		new Messi('<?php echo $this->Lang['COUNT_UPDATE_SUCC']; ?>');
					setTimeout(function() {
						$(".modalOverlay").fadeOut('slow');
						$(".messi-box").fadeOut('slow');
					}, 2000)
					return true;
			});
	});
	$('.profile_edit6').click(function(){
		$('.profile_edit6').hide();
		//$('#show5').hide();
		$('#shw_image').show();
	});
	$('a.Upprofile5').live("click", function(){
		var country = $("#country").val();
			$.post(Path+'users/update_country?country='+country, {
			}, function(response){
				$("#show5").html($('#country').find("option:selected").attr("title"));
				$('#shw_country').hide();
				$('#show5').show();
				$('.profile_edit5').show();
			});
	});
	/* gender */
	$('.profile_edit7').click(function(){
		$('.profile_edit7').hide();
		$('#show7').hide();
		$('#shw_gender').show();
	});
	$('a.Upprofile7').live("click", function(){
		var gender = $("#gender").val();
			$.post(Path+'users/update_gender?gender='+gender, {
			}, function(response){
				$("#show7").html($('#gender').find("option:selected").attr("title"));
				$('#shw_gender').hide();
				$('#show7').show();
				$('.profile_edit7').show();
					$("body").append('<div class="modalOverlay"></div>');
			 		new Messi('<?php echo $this->Lang['GEN_UPDATE_SUCC']; ?>');
					setTimeout(function() {
						$(".modalOverlay").fadeOut('slow');
						$(".messi-box").fadeOut('slow');
					}, 2000)
					return true;
			});
	});
	/* gender ends*/
	
	/* gender */
	$('.profile_edit8').click(function(){
		$('.profile_edit8').hide();
		$('#show8').hide();
		$('#shw_age_range').show();
	});
	$('a.Upprofile8').live("click", function(){
		var age_range = $("#age_range").val();
			$.post(Path+'users/update_age_range?age_range='+age_range, {
			}, function(response){
				$("#show8").html($('#age_range').find("option:selected").attr("title"));
				$('#shw_age_range').hide();
				$('#show8').show();
				$('.profile_edit8').show();
					$("body").append('<div class="modalOverlay"></div>');
			 		new Messi('<?php echo $this->Lang['AGE_RNG_UPDATE_SUCC']; ?>');
					setTimeout(function() {
						$(".modalOverlay").fadeOut('slow');
						$(".messi-box").fadeOut('slow');
					}, 2000)
					return true;
			});
	});
	/* gender ends*/
	$('.profile_edit9').click(function(){
		$('.profile_edit9').hide();
		$('#show8').hide();
		$('#shw_unique_identifier').show();
	});
	$('a.Upprofile9').live("click", function(){
		var unique_identifier = $("#unique_identifier").val();
		//if(unique_identifier=='' || unique_identifier==null){
		//	$("#identifier_error_12").html('Required');
			//$('.shw_unique_identifier').css('display','');
		//}else{
			$.post(Path+'users/update_unique_identifier?unique_identifier='+unique_identifier, {
			}, function(response){
				$("#show9").html(unique_identifier);
				$('#shw_unique_identifier').hide();
				$('#show9').show();
				$('.profile_edit9').show();
					$("body").append('<div class="modalOverlay"></div>');
			 		new Messi('<?php echo $this->Lang['IDENTIFIER_UPDATE_SUCC']; ?>');
					setTimeout(function() {
						$(".modalOverlay").fadeOut('slow');
						$(".messi-box").fadeOut('slow');
					}, 2000)
					return true;
			});
		//}
	});
	
	
        $(function(){
            // onfocus
            $('.opassTxt').focus(function(e){
                var getPass = $('.opassTxt').val();
                if(getPass=='Enter Your Old Password*'){
                    $(this).val('');
                    this.type = 'password';
                }
            });
             //onblur
            $('.opassTxt').blur(function(){
                var getPass = $('.opassTxt').val();
                if(getPass==''){
                    this.type = 'text';
                    $(this).val('Enter Your Old Password*');
                }
                else{
                    $('.opassTxt').val(getPass);
                }
            });
            $('.cpassTxt').focus(function(e){
                var getPass = $('.cpassTxt').val();
                if(getPass=='Enter Your Confirm Password*'){
                    $(this).val('');
                    this.type = 'password';
                }
            });
            //onblur
            $('.cpassTxt').blur(function(){
                var getPass = $('.cpassTxt').val();
                if(getPass==''){
                    this.type = 'text';
                    $(this).val('Enter Your Confirm Password*');
                }
                else{
                    $('.cpassTxt').val(getPass);
                }
            });
            $('.npassTxt').focus(function(e){
                var getPass = $('.npassTxt').val();
                if(getPass=='Enter Your New Password*'){
                    $(this).val('');
                    this.type = 'password';
                }
            });
            //onblur
            $('.npassTxt').blur(function(){
                var getPass = $('.npassTxt').val();
                if(getPass==''){
                    this.type = 'text';
                    $(this).val('Enter Your New Password*');
                }
                else{
                    $('.npassTxt').val(getPass);
                }
            });
        });
    });
    
</script>
<div class="contianer_outer1">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><?php echo $this->Lang['MY_PROFILE']; ?></p></li>
                </ul>
            </div>
            <!--content start-->
            <div class="content_abouts">
                <div class="all_mapbg_mid_common">
                    <div class="content_abou_common">
                        <div class="pro_top5">
                        <div class="common_ner_commont1">
                        <div class="common_ner_commont">
                        <h2><?php echo $this->Lang['MY_PROFILE']; ?></h2>
                        </div>
                            <h3 class="unic_numb"><?php if($this->session->get('user_auto_key')) {  echo $this->Lang["UNI_AUTO_KEY"]. " : ";  echo $this->session->get('user_auto_key'); } ?></h3>
                        </div>
                       
                        </div>
                        <div class="all_mapbg_mid">
                            <div class="myemai_mnu">
                                <div class="top_menu myemail_subbor">
                                    <a class="tab_navicon" href="#" title="Menu">Menu</a>
                                    <ul class="tab_nav">
                                        <li   class="tab_act">
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-account.html" title="<?php echo $this->Lang['MY_ACC']; ?>"><?php echo $this->Lang['MY_ACC']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        
                                        <li>
                                        <div class="tab_left"></div>
                                        <div class="tab_mid"><a href="<?php echo PATH; ?>wishlist.html" title="<?php echo $this->Lang['MY_WISH']; ?>"><?php echo $this->Lang['MY_WISH']; ?></a></div>
                                        <div class="tab_rgt"></div>
                                    </li>
                                    
                                        <li>
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-coupons.html" title="<?php echo $this->Lang['MY_BUYS']; ?>"><?php echo $this->Lang['MY_BUYS']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <li>
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-referral-list.html" title="<?php echo $this->Lang['MY_REFERAL']; ?>"><?php echo $this->Lang['MY_REFERAL']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        
                                        <li>
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/email-subscribtions.html" title="<?php echo $this->Lang['MY_ELAL_SUB']; ?>"><?php echo $this->Lang['MY_ELAL_SUB']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <li>
                                            <div class="tab_left"></div>
                                             <div class="tab_mid"><a href="<?php echo PATH;?>users/my-winner-list.html" title="<?php echo $this->Lang['WON_AUC']; ?>"><?php echo $this->Lang['WON_AUC']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <li>
                                            <div class="tab_left"></div>
                                             <div class="tab_mid"><a href="<?php echo PATH;?>users/my-shipping-address.html" title="<?php echo $this->Lang['MY_SHIPPING_ADD']; ?>"><?php echo $this->Lang['MY_SHIPPING_ADD']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                          <?php  if($this->session->get('user_auto_key')) { ?>
                                        <li>
                                            <div class="tab_left"></div>
                                             <div class="tab_mid"><a href="<?php echo PATH;?>users/my-storecredit-purchase.html" title="<?php echo $this->Lang['STR_CRD_PURCH']; ?>"><?php echo $this->Lang['STR_CRD_PURCH']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <li >
                                            <div class="tab_left"></div>
                                             <div class="tab_mid"><a href="<?php echo PATH;?>users/my-storecredits.html" title="<?php echo $this->Lang['MY_STR_LIST']; ?>"><?php echo $this->Lang["MY_STR_LIST"]; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mybuys_content mybuys_products">
                            <div class="pi_mc_rl_outer">
                                <div class="pi_left">
                                    <?php foreach ($this->user_detail as $u) { ?>
                                        <div class="pi_border_mid">
                                            <ul>
                                                <li>
                                                    <h4><?php echo $this->Lang['NAME'];?></h4>
                                                    <div class="pi_detail">
                                                        <div class="pi_detail_info" id="user_name">
                                                            <div id="name_user" class="un_detail"><?php echo ucfirst($u->firstname) . " " . ucfirst($u->lastname); ?></div>
                                                        </div>
                                                        <div class="Editprofile" id="Editprofile-<?php echo $u->user_id; ?>" style="display:none;">
                                                            <div class="followup">
                                                                <div class="followup_tb_mid">
                                                                    <input type="text"  name="phone" maxlength="20"  id="fname-<?php echo $u->user_id; ?>"  class="followupnext" value="<?php echo $u->firstname; ?>" placeholder="<?php echo $this->Lang['ENT_NAME'];?>.." />
                                                                    <br/><span id="fname_error_12" style="color:red;font:13px kreonregular;letter-spacing:0.01em;"></span>
                                                                </div>
                                                            </div>
                                                            <div class="followup">
                                                                <div class="followup_tb_mid">
                                                                    <input type="text"  name="phone" maxlength="20"  id="laneme-<?php echo $u->user_id; ?>"  class="followupnext" value="<?php echo $u->lastname; ?>" placeholder="<?php echo $this->Lang['ENT_LST'];?>.."/>
                                                                    <br/><span id="fname_error_12" style="color:red;font:13px kreonregular;letter-spacing:0.01em;"></span>
                                                                </div>
                                                            </div>
                                                            <div class="followup_buttons">
                                                                <a id="Upprofile-<?php echo $u->user_id; ?>" class="buy_it Upprofile" title="<?php echo $this->Lang['UPDATE']; ?>"><?php echo $this->Lang['UPDATE']; ?> </a>
                                                                <a id="Cancelfollowup-<?php echo $u->user_id; ?>" onclick="javascript:cancel_hide_pr()" class="sign_cancel" title="<?php echo $this->Lang['CANCEL']; ?>"><?php echo $this->Lang['CANCEL']; ?> </a>
                                                            </div>
                                                        </div>
                                                        <div class="pi_detail_edit" id="edit_hide">
                                                            <p><a class="cursor profile_edit" style="cursor:pointer;"id="NEDIT-<?php echo $u->user_id; ?>" title="<?php echo $this->Lang['EDIT']; ?>"><?php echo $this->Lang['EDIT']; ?></a></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h4><?php echo $this->Lang['EMAIL']; ?></h4>
                                                    <div class="pi_detail">
                                                        <div class="pi_detail_info">
                                                            <p><?php echo $u->email; ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h4><?php echo $this->Lang['PASSWORD']; ?></h4>
                                                    <div class="pi_detail">
                                                        <div class="pi_detail_info" id="password_user">
                                                            <p>*************</p>
                                                        </div>
                                                        <div class="Editprofile_4" style="display:none;">
                                                            <div class="followup">
                                                                <div class="followup_tb_mid">
                                                                    <input name="old_pass"  id="old_pass" class="opassTxt" type="password" placeholder="<?php echo $this->Lang['EN_O_PASS']; ?>" />
                                                                    <BR/><span id="old_pass_error" style="color:red;font:13px kreonregular;letter-spacing:0.01em;"></span>
                                                                </div>
                                                            </div>
                                                            <div class="followup">
                                                                <div class="followup_tb_mid">
                                                                    <input name="new_pass"  id="new_pass" class="npassTxt" type="password" placeholder="<?php echo $this->Lang['EN_N_PASS']; ?>" />
                                                                    <br/><span id="new_pass_error" style="color:red;font:13px kreonregular;letter-spacing:0.01em;"></span>
                                                                </div>
                                                            </div>
                                                            <div class="followup">
                                                                <div class="followup_tb_mid">
                                                                    <input name="confirm_pass"  id="confirm_pass" class="cpassTxt" type="password" placeholder="<?php echo $this->Lang['EN_C_PASS']; ?>" />
                                                                    <br/><span id="pass_error_1" style="color:red;font:13px kreonregular;letter-spacing:0.01em;"></span>
                                                                </div>
                                                            </div>
                                                            <div class="followup_buttons">
                                                                <a class="buy_it Uppro_file_3 cursor"><?php echo $this->Lang['UPDATE']; ?> </a>
                                                                <a class="sign_cancel" onclick="javascript:cancel_hide_pr_4()" ><?php echo $this->Lang['CANCEL']; ?> </a>
                                                            </div>
                                                        </div>
                                                        <div class="pi_detail_edit" id="password_ic">
                                                            <p><a class="cursor profile_edit_4" style="cursor:pointer;" title="<?php echo $this->Lang['EDIT2']; ?>"><?php echo $this->Lang['EDIT2']; ?></a></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h4><?php echo $this->Lang['PH_NUM']; ?></h4>
                                                    <div class="pi_detail">
                                                        <div class="pi_detail_info" id="city_user">
                                                            <p id="show2"><?php echo $u->phone_number; ?>&nbsp;</p>
                                                        </div>
                                                        <div id="shw_phone" style="display:none;">
                                                            <div class="followup">
                                                                <div class="followup_tb_mid">
                                                                    <input type="text"  name="phone_number" id="phone" value="<?php echo $u->phone_number; ?>" placeholder="<?php echo $this->Lang['ENT_MOB']; ?>.." title="<?php echo $u->phone_number; ?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="followup_buttons">
                                                               <a class="buy_it Upprofile2" title="Update"><?php echo $this->Lang['UPDATE']; ?> </a>
                                                               <a class="sign_cancel" onclick="javascript:cancel_hide_pr2()" title="<?php echo $this->Lang['CANCEL']; ?>"><?php echo $this->Lang['CANCEL']; ?> </a>
                                                                <br/><span id="phone_error" style="color:red;font:13px kreonregular;letter-spacing:0.01em;"></span>
                                                            </div>
                                                        </div>
                                                        <div class="pi_detail_edit" id="phone" >
                                                            <p><a class="cursor profile_edit_2" style="cursor:pointer;" title="<?php echo $this->Lang['EDIT2']; ?>"><?php echo $this->Lang['EDIT2']; ?></a></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h4><?php echo $this->Lang['ADDRES']; ?></h4>
                                                    <div class="pi_detail">
                                                        <div class="pi_detail_info" id="city_user">
                                                        
                                                            <p id="show3"><?php echo $u->address1; ?><?php if($u->address2 !='') { echo ","; } else { echo "&nbsp"; } ?><?php echo $u->address2; ?></p>
                                                        </div>
                                                        <div id="shw_address" style="display:none;">
                                                            <div class="followup">
                                                                <div class="followup_tb_mid">
                                                                    <input type="text"  name="address1" id="address1" value="<?php echo $u->address1; ?>" placeholder="Enter your address 1 line" title="<?php echo $u->address1; ?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="followup">
                                                                <div class="followup_tb_mid">
                                                                    <input type="text"  name="address2" id="address2" value="<?php echo $u->address2; ?>" placeholder="Enter your address 2 line" />
                                                                </div>
                                                            </div>
                                                            <div class="followup_buttons">
                                                                <a class="buy_it Upprofile3" title="<?php echo $this->Lang['UPDATE']; ?>"><?php echo $this->Lang['UPDATE']; ?> </a>
                                                                <a onclick="javascript:cancel_hide_pr3()" class="sign_cancel" title="<?php echo $this->Lang['CANCEL']; ?>"><?php echo $this->Lang['CANCEL']; ?> </a>
                                                            </div>
                                                        </div>
                                                        <div class="pi_detail_edit"  id="city_ic">
                                                            <p><a class="cursor profile_edit_3" style="cursor:pointer;" title="<?php echo $this->Lang['EDIT2']; ?>"><?php echo $this->Lang['EDIT2']; ?></a></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li id="border_none">
                                                    <h4><?php echo $this->Lang['PROFF_IMG']; ?></h4>
                                                    <div class="pi_detail">
                                                        <div class="pi_detail_info">
                                                            <?php if (file_exists(DOCROOT . 'images/user/150_115/' . $u->user_id . '.png')) {
                                                                ?>
                                                                <img src="<?php echo PATH . 'images/user/150_115/' . $u->user_id . '.png'; ?>"  />
                                                            <?php } elseif (file_exists(DOCROOT . 'images/user/150_115/' . $u->user_id . '.jpg')) { ?>
                                                                <img src="<?php echo PATH . 'images/user/150_115/' . $u->user_id . '.jpg'; ?>"  />
                                                            <?php } else { ?>
                                                                <img src="<?php echo PATH; ?>images/user/150_115/profileimg.png"  />
                                                            <?php } ?>
                                                        </div>
                                                        <div class="pi_detail_edit">
                                                            <p><a style="cursor:pointer" onclick="javascript:popup_show()" title="<?php echo $this->Lang['EDIT2']; ?>"><?php echo $this->Lang['EDIT2']; ?></a></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="mc_rl_right">
                                        <div class="mc_section">
                                            <div class="mc_mid">
                                                <ul>
                                                    <li>
                                                        <h4><?php echo $this->Lang['CITY']; ?></h4>
                                                        <div class="pi_detail">
                                                            <div class="pi_detail_info" id="city_user">
                                                                <p id="show4" style="color: #231F20;font: bold 19px arial;"><?php echo $u->city_name; ?></p>
                                                            </div>
                                                            <div id="shw_city" style="display:none;">
                                                                <div class="followup">
                                                                    <select name="city" id="city">
                                                                        <?php foreach ($this->all_city_list as $c) { ?>
                                                                            <option  <?php if ($c->city_id == $u->city_id) { ?> selected <?php } ?> title="<?php echo $c->city_name; ?>"value="<?php echo $c->city_id; ?>" ><?php echo $c->city_name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="followup_buttons">
                                                                    <a class="buy_it Upprofile4" title="Update"><?php echo $this->Lang['UPDATE']; ?> </a>
                                                                    <a onclick="javascript:cancel_hide_pr4()" class="sign_cancel" title="<?php echo $this->Lang['CANCEL']; ?>"><?php echo $this->Lang['CANCEL']; ?> </a>
                                                                </div>
                                                            </div>
                                                            <div class="pi_detail_edit" id="city_ic">
                                                                <p><a class="cursor profile_edit4" style="cursor:pointer;" title="<?php echo $this->Lang['EDIT2']; ?>"><?php echo $this->Lang['EDIT2']; ?></a></p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <h4><?php echo $this->Lang['COUNTRY']; ?></h4>
                                                        <div class="pi_detail">
                                                            <div class="pi_detail_info">
                                                                <p id="show5" style="color: #231F20;font: bold 19px arial;">	<?php echo $u->country_name; ?></p>
                                                            </div>
                                                            <div id="shw_country" style="display:none;">
                                                                <div class="followup">
                                                                    <select name="country" id="country">
                                                                        <?php foreach ($this->country_list as $c) { ?>
                                                                            <option  <?php if ($c->country_id == $u->country_id) { ?> selected="selected" <?php } ?> title="<?php echo $c->country_name; ?>" value="<?php echo $c->country_id; ?>" ><?php echo $c->country_name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="followup_buttons">
                                                                    <a class="buy_it Upprofile5" title="<?php echo $this->Lang['UPDATE']; ?> "><?php echo $this->Lang['UPDATE']; ?> </a>
                                                                    <a class="sign_cancel" onclick="javascript:cancel_hide_pr5()" title="<?php echo $this->Lang['CANCEL']; ?>"><?php echo $this->Lang['CANCEL']; ?> </a>
                                                                </div>
                                                            </div>
                                                            <div class="pi_detail_edit" id="city_ic">
                                                                <p><a class="cursor profile_edit5" style="cursor:pointer;" title="<?php echo $this->Lang['EDIT2']; ?>" ><?php echo $this->Lang['EDIT2']; ?></a></p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <h4><?php echo $this->Lang['GENDER']; ?></h4>
                                                        <div class="pi_detail">
                                                            <div class="pi_detail_info" id="city_user">
                                                                <p id="show7" style="color: #231F20;font: bold 15px arial;"><?php if ($u->gender == 1) {  echo $this->Lang["MALE"]; } else if ($u->gender == 2) {  echo $this->Lang["FEMALE"]; } ?></p>
                                                            </div>
                                                            <div id="shw_gender" style="display:none;">
                                                                <div class="followup">
                                                                    <select name="gender" id="gender">
																		<option value=""><?php echo $this->Lang["SEL_GEN"]; ?></option>
																		<option value="1" <?php if ($u->gender == 1) { ?> selected <?php } ?> title="<?php echo $this->Lang["MALE"]; ?>" ><?php echo $this->Lang["MALE"]; ?></option>
																		<option value="2" <?php if ($u->gender == 2) { ?> selected <?php } ?> title="<?php echo $this->Lang["FEMALE"]; ?>" ><?php echo $this->Lang["FEMALE"]; ?></option>
																	 </select>
                                                                </div>
                                                                <div class="followup_buttons">
                                                                    <a class="buy_it Upprofile7" title="Update"><?php echo $this->Lang['UPDATE']; ?> </a>
                                                                    <a onclick="javascript:cancel_hide_pr7()" class="sign_cancel" title="<?php echo $this->Lang['CANCEL']; ?>"><?php echo $this->Lang['CANCEL']; ?> </a>
                                                                </div>
                                                            </div>
                                                            <div class="pi_detail_edit" id="city_ic">
                                                                <p><a class="cursor profile_edit7" style="cursor:pointer;" title="<?php echo $this->Lang['EDIT2']; ?>"><?php echo $this->Lang['EDIT2']; ?></a></p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <h4><?php echo $this->Lang['AGE_RNG']; ?></h4>
                                                        <div class="pi_detail">
                                                            <div class="pi_detail_info" id="city_user">
                                                                <p id="show8" style="color: #231F20;font: bold 15px arial;"><?php if ($u->age_range == 1) {  echo $this->Lang["17_BEL"]; } else if ($u->age_range == 2) {  echo $this->Lang["18_25"]; }  else if ($u->age_range == 3) {  echo $this->Lang["26_35"]; } else if ($u->age_range == 4) {  echo $this->Lang["36_45"]; } else if ($u->age_range == 5) {  echo $this->Lang["46_65"]; } else if ($u->age_range == 6) {  echo $this->Lang["66_ABV"]; } ?></p>
                                                            </div>
                                                            <div id="shw_age_range" style="display:none;">
                                                                <div class="followup">
                                                                    <select name="age_range" id="age_range">
																			<option value="" title=""><?php echo $this->Lang['SEL_AGE_RNG']; ?></option>
																			<option value="1" <?php if ($u->age_range == 1) { ?> selected <?php } ?> title ="<?php echo $this->Lang["17_BEL"]; ?>" ><?php echo $this->Lang["17_BEL"]; ?></option>
																			<option value="2"  <?php if ($u->age_range == 2) { ?> selected <?php } ?> title="<?php echo $this->Lang["18_25"]; ?>" ><?php echo $this->Lang["18_25"]; ?></option>
																			<option value="3" <?php if ($u->age_range == 3) { ?> selected <?php } ?> title="<?php echo $this->Lang["26_35"]; ?>" ><?php echo $this->Lang["26_35"]; ?></option>
																			<option value="4" <?php if ($u->age_range == 4) {?> selected <?php } ?> title="<?php echo $this->Lang["36_45"]; ?>" ><?php echo $this->Lang["36_45"]; ?></option>
																			<option value="5" <?php if ($u->age_range == 5) { ?> selected <?php } ?> title="<?php echo $this->Lang["46_65"]; ?>"><?php echo $this->Lang["46_65"]; ?></option>
																			<option value="6" <?php if ($u->age_range == 6) { ?> selected <?php } ?> title="<?php echo $this->Lang["66_ABV"]; ?>" ><?php echo $this->Lang["66_ABV"]; ?></option>
																	 </select>
                                                                </div>
                                                                <div class="followup_buttons">
                                                                    <a class="buy_it Upprofile8" title="Update"><?php echo $this->Lang['UPDATE']; ?> </a>
                                                                    <a onclick="javascript:cancel_hide_pr8()" class="sign_cancel" title="<?php echo $this->Lang['CANCEL']; ?>"><?php echo $this->Lang['CANCEL']; ?> </a>
                                                                </div>
                                                            </div>
                                                            <div class="pi_detail_edit" id="city_ic">
                                                                <p><a class="cursor profile_edit8" style="cursor:pointer;" title="<?php echo $this->Lang['EDIT2']; ?>"><?php echo $this->Lang['EDIT2']; ?></a></p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <h4><?php echo $this->Lang['UNIQ_IDEN']; ?></h4>
                                                        <div class="pi_detail">
                                                            <div class="pi_detail_info" id="city_user">
                                                                <p id="show9" style="color: #231F20;font: bold 15px arial;"><?php echo $u->unique_identifier; ?></p>
                                                            </div>
                                                            <div id="shw_unique_identifier" style="display:none;">
                                                                <div class="followup">
                                                                    <input type="text"  name="phone" maxlength="20"  id="unique_identifier"  class="followupnext" value="<?php echo $u->unique_identifier; ?>" placeholder="<?php echo $this->Lang['ENTER_UNIQ_IDEN'];?>.." />
                                                                    <br/><span id="identifier_error_12" style="color:red;font:13px kreonregular;letter-spacing:0.01em;"></span>
                                                                </div>
                                                                <div class="followup_buttons">
                                                                    <a class="buy_it Upprofile9" title="Update"><?php echo $this->Lang['UPDATE']; ?> </a>
                                                                    <a onclick="javascript:cancel_hide_pr9()" class="sign_cancel" title="<?php echo $this->Lang['CANCEL']; ?>"><?php echo $this->Lang['CANCEL']; ?> </a>
                                                                </div>
                                                            </div>
                                                            <div class="pi_detail_edit" id="city_ic">
                                                                <p><a class="cursor profile_edit9" style="cursor:pointer;" title="<?php echo $this->Lang['EDIT2']; ?>"><?php echo $this->Lang['EDIT2']; ?></a></p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="empty_space">&nbsp;</div>
                                        <div class="rl_section">
                                            <h3><?php echo $this->Lang['REFERAL_LINK']; ?> </h3>

                                            <div class="rl_mid">
                                                <h4><?php echo $this->Lang['USER_REFE_BAL']; ?>   <span style="color: #FF6500;"><?php echo CURRENCY_SYMBOL . " " . $u->user_referral_balance; ?> </span></h4>
                                                <h4><?php echo $this->Lang['EARN']; ?>  <span style="color: #FF6500;"><?php echo CURRENCY_SYMBOL . " " . REFERRAL_AMOUNT; ?> </span><?php echo $this->Lang['POINT_EACH_SUCC_REFE']; ?> </h4>

                                                    <div class="rl_tbox_left_outer">
                                                        <form name="form1">

                                                            <div class="rl_tbox_mid">
                                                                <input  class="auto_select text G_event E-Share_Link_ReferPage" width="160" onclick="select_all();" id="user_referral_url" name="user_referral_url" readonly="readonly" type="text" value="<?php echo PATH; ?>referral/<?php echo $u->referral_id; ?>"  />
                                                            </div>

                                                        </form>
                                                    </div>
                                            </div>

                                        </div>
                                        <div class="rl_section">
                                            <h3><?php echo $this->Lang['CONNECTIONS'];?></h3>
                                            <div class="rl_mid">
                                                    <div class="connections">
                                                        <?php foreach ($this->user_detail as $u) { ?>
                                                            <?php
                                                              $facebook_id = $u->fb_user_id;
                                                             $facebook_session = $u->fb_session_key;
                                                            if ($facebook_id == '') {
                                                                ?>

                                                                <p><?php echo $this->Lang['SIGN_IN_WITH']; ?></p>
                                                                <p><a onclick="facebookconnect_share();" style="cursor:pointer;" class="face_connect" title="<?php echo $this->Lang['FB_CONN']; ?>"></a>
                                                                </p>
        <?php } else { ?>

                                                                <div class="user_img"><img src="http://graph.facebook.com/<?php echo $facebook_id; ?>/picture?type=normal"/></div>
                                                                <form method="post" class="admin_form" name="edit_users" enctype="multipart/form-data" >
																	<?php 
$ch4 = curl_init();
curl_setopt($ch4, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch4, CURLOPT_URL, "https://graph.facebook.com/$facebook_id?access_token=$facebook_session");
curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch4);
$res = json_decode($result);
/*if(isset($res->verified)){ 
$count = 1;
} else {
$count = 0;
$pageContent = file_get_contents('http://graph.facebook.com/'.$facebook_id);
$parsedJson  = json_decode($pageContent);
}*/


$username  = ucfirst($res->name);
//$gender = ucfirst($res->gender);
//$link = $res->link;


//print_r($res->first_name); exit; 

?>
                                                                    <div class="face_det2">
                                                                        <ul>
                                                                            <li>
                                                                                <label style="font: 19px kreonregular;"><?php echo $this->Lang['USER_NAME']; ?> : </label>
                                                                                <p style="color: #231F20;font: bold 11px arial;"><?php echo  ucfirst($username);?></p>
                                                                            </li>

                                                                            <?php /*<li>
                                                                                <label style="font: 19px kreonregular;"><?php echo $this->Lang['GENDER']; ?>  : </label>
                                                                                <p style="color: #231F20;font: bold 11px arial;"><?php echo ucfirst($gender);?></p>
                                                                                </li>


																																																						<li>
                                                                                <label style="font: 19px kreonregular;"><?php echo $this->Lang['LIN']; ?> : </label>
                                                                                <p style="color: #231F20;font: bold 11px arial;"><a target="_blank" href="<?php echo $link;?>"><?php echo $link;?></a></p>
                                                                            </li>*/?>
                                                                            <li>
                                                                                <label>&nbsp;</label>
                                                                                <input class="fl" value="1" type="checkbox" name="facebook" <?php if ($u->facebook_update == '1') { ?> checked="checked" <?php } ?> ><span class="facebook_wall" style="color: #231F20;font: bold 11px arial;"><?php echo $this->Lang['AUTO_POST']; ?></span>
                                                                            </li>


                                                                            <li>
                                                                                <label>&nbsp;</label>
                                                                                <input  class="sign_submit"  name="Submit" type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" />
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </form>
        <?php }
    } ?>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="model_dailog" style="display:none">
    <div class="pop_up_profile">
        <div class="pop_up_top_profile">
             <h1><?php echo $this->Lang['CHANGE_PROFILE_PICT']; ?></h1><a  class="pop_close cursor" style="cursor:pointer;">&nbsp;</a>
        </div>
        <div class="pop_up_mid_profile">
            <div  class="pop_form_profile" >
                <form action="<?php echo PATH; ?>users/edit-profile-images.html" method="post"  id="admin_form" class="admin_form" enctype="multipart/form-data" />
                <input type="file" id="empty_value_1" size="15" name="image"/>
                <em>
<?php if (isset($this->form_error['image'])) {
    echo $this->form_error["image"];
} ?>
                </em><br/>
                <span style="font:normal 15px arial; color:#333;"><?php echo $this->Lang['IMG_UP_SIZE']; ?></span>
                <div class="pop_but_profile">
                    <input class="sign_submit"  type="submit" value="submit" />
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

var ww = document.body.clientWidth;

$(document).ready(function() {
	$(".tab_nav li a").each(function() {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		}
	});

	$(".tab_navicon").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$(".tab_nav").slideToggle();
	});
	adjustMenu();
})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 960 ) {
		$(".tab_navicon").css("display", "inline-block");
		if (!$(".tab_navicon").hasClass("active")) {
			$(".tab_nav").hide();
		} else {
			$(".tab_nav").show();
		}
		$(".tab_nav li").unbind('mouseenter mouseleave');
		$(".tab_nav li a.parent").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent("li").toggleClass("hover");
		});
	}
	else if (ww >= 960) {
		$(".tab_navicon").css("display", "none");
		$(".tab_nav").show();
		$(".tab_nav li").removeClass("hover");
		$(".tab_nav li a").unbind('click');
		$(".tab_nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).toggleClass('hover');
		});
	}
}


</script>
