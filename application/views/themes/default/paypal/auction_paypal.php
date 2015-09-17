<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script>
$(document).ready(function(){ 
$('.hideerror').hide();
        $(".CityPAY_new").hide();
     $("#commentpaypal_auction").validate({
		messages: {
			shipping_name: {
			   required: "<?php echo $this->Lang['PLS_ENT_NAM']; ?>"                         
		   },
		    adderss1: {
			   required: "<?php echo $this->Lang['PLS_ENT_VLD_ADDR']; ?>"                         
		   },
			city : {
			   required: "<?php echo $this->Lang['PLS_ENT_CITY']; ?>"                         
		   },
			state : {
			   required: "<?php echo $this->Lang['PLS_ENT_STATE']; ?>"                         
		   },
			postal_code : {
			   required: "<?php echo $this->Lang['PLS_ENT_ZIP']; ?>",
			   number: "<?php echo $this->Lang['PLS_ENT_NO']; ?>"                             
			},
			phone : {
			   required: "<?php echo $this->Lang['PLZ_ETR_PHO']; ?>",
			   number: "<?php echo $this->Lang['PLS_ENT_NO']; ?>"                             
			},
		},
		 submitHandler: function(form) {
                if (document.getElementById('ship_city_p2').value == ' ') { 
                        $('.hideerror').show();
                        $('div#submit').show();
                        return false; 
                }    else {
                $('div#submit').hide();
                form.submit();
                }
            }
	});

	// for shipping address 
	$("#shipping_address1").change(function() { 
	$(".CityPAY").show();
	     $(".CityPAY_new").hide();
		if($(this).is(':checked')) {  
			 $("#ship_nam_p1").val($("#ship_nam").val());
			 $("#ship_addr_p2").val($("#ship_address2").val());
			 $("#ship_postal_code_p1").val($("#ship_zipcode").val());
			 $("#ship_addr_p1").val($("#ship_address1").val());
			 $("#ship_city_p1").val($("#ship_city").val());
			 city_change_payment($("#ship_country").val());
			 $("#ship_country_p1").val($("#ship_country").val());
			 $("#ship_state_p1").val($("#ship_state").val());
			 $("#ship_phone_p1").val($("#ship_phone").val());
			
		} else { 
			 $("#ship_nam_p1").val('');
			 $("#ship_addr_p2").val('');
			 $("#ship_postal_code_p1").val('');
			 $("#ship_addr_p1").val('');
			 $("#ship_state_p1").val('');
			 city_change_payment("");
			  $("#ship_city_p1").val('');
			 $("#ship_country_p1").val('');
			 $("#ship_phone_p1").val('');
		
		
	}
	});
	
});
</script>
<form name="payment" method="POST" id="commentpaypal_auction" action="<?php echo PATH; ?>payment/auction-paypal.php">	
		<?php  foreach($this->deals_payment_deatils as $payment) {  ?>

			<?php /* if($this->uri->segment(2) == "payment_details_friend"){ ?>
     
                        <p class="per-info-heading"><?php echo $this->Lang['FRI_INFO']; ?></p>
						<div class="per-info-section">
						<div class="contact_form">
										<ul>
											<li>
												<label> <?php echo $this->Lang['FRI_NAME']; ?> :</label>
												<div class="fullname"><input type="text" value="" name="friend_name" AUTOCOMPLETE="OFF"  class="required"/></div>
												<em>
                        <?php if(isset($this->form_error['friend_name'])){ echo $this->form_error["friend_name"]; }?>
                        </em>
											</li>
											<li>
												<label><?php echo $this->Lang['FRI_EMAIL']; ?> :</label>
												<div class="fullname"><input type="text" value="" name="friend_email" AUTOCOMPLETE="OFF"  class="required email"/></div>
												<em>
                        <?php if(isset($this->form_error['friend_email'])){ echo $this->form_error["friend_email"]; }?>
                        </em>
											</li>
											</ul>
											</div>
											</div>
                
					<input name="friend_gift"  value="1" type="hidden">

			<?php } else {?>
                <input name="friend_name"  type="hidden" value="xxxyyy" >
                <input name="friend_email"   type="hidden" value="xxxyyy@zzz.com" >
                <input name="friend_gift"  value="0" type="hidden">
			<?php }  */ ?>          
    <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['SHIPPING_INFO']; ?></h3>
    <div class="p_inner_block">
				 <div class="payment_form_block clearfix">
                                     <div class="shipping_copy_address">
                                        <input type="checkbox" id="shipping_address1" tabindex="1" />
                                        <label><?php echo $this->Lang['COPY_SHIP_ADDR']; ?></label>
                                    </div>
                            <div class="payment_form_section">
                                <div class="payment_form payment_shipping_form">
                                    <ul>
										<li>
                                            <label> <?php echo $this->Lang['NAME']; ?> :<span class="form_star">*</span></label>
                                            <div class="fullname"><input name="shipping_name" id="ship_nam_p1" autofocus tabindex="2"  size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" value="" class="required" maxlength="50"/>
                                            </div>
                                        </li>
                                        <li>
                                            <label><?php echo $this->Lang['ADDR1']; ?> :<span class="form_star">*</span></label>
                                            <div class="fullname"><input name="adderss1" id="ship_addr_p1" tabindex="3" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" value="" class="required" maxlength="100"/>
                                            </div>
                                        </li>
                                        <li class="frm_clr">
                                            <label> <?php echo $this->Lang['ADDR2']; ?> :</label>
                                            <div class="fullname"><input name="address2" id="ship_addr_p2" tabindex="4" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" value="" size="40"  maxlength="100"/>
                                            </div>
                                        </li>
                                         <li>
                                            <label> <?php echo $this->Lang['COUNTRY']; ?> :<span class="form_star">*</span></label>
                                            <div class="fullname">
                                                <select name="country" id="ship_country_p1" tabindex="5" onchange="return city_change_payment(this.value);">
                                                <option value=""><?php echo $this->Lang['SELECT_Y_COUNTRY']; ?></option>
                                                <?php foreach($this->all_country_list as $countryL){ ?>
                                                <option <?php if($countryL->country_url==$this->input->get('country')){ echo 'Selected="true"'; } ?> value="<?php echo $countryL->country_name; ?>"><?php echo ucfirst($countryL->country_name); ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </li>                      
                                        <li class="frm_clr">
                        <label><?php echo $this->Lang['SEL_CITY']; ?> :<span class="form_star">*</span></label>
                        <div class="fullname">
                            <select name="city"  id="ship_city_p1" tabindex="6" class="CityPAY required">
                            <option value=""><?php echo $this->Lang['COUNTRY_FIRST']; ?></option>
                                <?php foreach ($this->all_city_list as $CityL) {  ?>
                                    <option  value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
                                <?php } ?>
                            </select>
                            
                        
                             <div class="hideerror" id="city_validation">This Field Is Required.</div>    
                        </div>
                    </li>
                                        
                                        <li>
                                            <label><?php echo $this->Lang['STATE']; ?>:<span class="form_star">*</span></label>
                                            <div class="fullname"><input name="state" id="ship_state_p1"  tabindex="7" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_STATE']; ?>" type="text" value="" size="40" class="required" maxlength="50"/>
                                            </div>
                                        </li>                                                                                
                                       
                                        <li class="frm_clr">
                                            <label> <?php echo $this->Lang['POSTAL_CODE']; ?> :<span class="form_star">*</span></label>
                                            <div class="fullname"><input name="postal_code"  id="ship_postal_code_p1" tabindex="8" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>" type="text" value="" class="required number" maxlength="8"/>
                                            </div>
                                        </li>
                                        <li>
                                            <label> <?php echo $this->Lang['PHONE']; ?> :<span class="form_star">*</span></label>
                                            <div class="fullname"><input name="phone" id="ship_phone_p1" tabindex="9" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>" type="text" value="" class="required number" maxlength="18"/>
                                            </div>
                                        </li>
                                        

                                    </ul>
                                </div>

                            </div>

                        </div>
                                            
								
						          
						          
       
			<input name="P_QTY" id="PC_QTY_VAL" value="1" type="hidden" >
			<input name="deal_id"  type="hidden" value="<?php echo $payment->deal_id; ?>" >
			<input name="merchant_id"  type="hidden" value="<?php echo $payment->merchant_id; ?>" >
			<input name="bid_id"  type="hidden" value="<?php echo $this->bid_id; ?>" >
			<input name="deal_key" type="hidden" value="<?php echo $payment->deal_key; ?>" >
			<input name="url_title" type="hidden" value="<?php echo $payment->url_title; ?>" >
			<input name="deal_value" type="hidden" value="<?php echo $payment->deal_value; ?>" >
			<input name="shipping_amount"  type="hidden" value="<?php echo $payment->shipping_fee; ?>" >
			<input name="amount" id="PC_AMOUNT"  type="hidden" value="<?php echo $this->current_bid_value; ?>" >        
                        <div class="personal_info_panel" id="submit"> <div class="paypal_link"><a > <input tabindex="11"  name="Submit" type="submit" value="" /> </a>  </div></div>
                        <?php if(count($this->cms_tc) > 0){ ?>
				<div class="payment_terms_outer"><p class="terms-conditons-text"> <span class="fl font_myriad_pro"><?php echo $this->Lang['BY_CLICK1']; ?> </span> <a  onclick="show_dis_tc();"  title="<?php echo $this->Lang['TEMRS']; ?>" class="font_myriad_pro mt5" tabindex="11"><?php echo $this->Lang['TEMRS']; ?>.</a></p> </div>  
				<?php } ?>      
        
        
        <?php } ?>
                         
						
	
</div>
</form>
