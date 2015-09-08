<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script>
    $(document).ready(function(){
    $('.hideerror').hide();
        $(".CityPAY_new").hide();
         $("#commentForm_cod").validate({
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
			   required: "<?php echo $this->Lang['PLS_ENT_STATE1']; ?>"                         
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
                if (document.getElementById('ship_citycod2').value == ' ') { 
                        $('.hideerror').show();
                        $('div#submit').show();
                        return false; 
                }    else {
                $('div#submit').hide();
                form.submit();
                }
            }
});

	// for shipping address change
 $("#shipping_address_pay").change(function() {
                 $(".CityPAY").show();
	        $(".CityPAY_new").hide();
		if($(this).is(':checked')) { 
			 $("#ship_nam_pay1").val($("#ship_nam").val());
			 $("#ship_addr_pay2").val($("#ship_address2").val());
			 $("#ship_postal_code_pay1").val($("#ship_zipcode").val());
			 $("#ship_addr_pay1").val($("#ship_address1").val());
			 $("#ship_citypay1").val($("#ship_city").val());
			 city_change_payment($("#ship_country").val());
			 $("#ship_countrypay1").val($("#ship_country").val());
			 $("#ship_state_pay1").val($("#ship_state").val());
			 $("#ship_phone_pay1").val($("#ship_phone").val());
			
		} else { 
			 $("#ship_nam_pay1").val('');
			 $("#ship_addr_pay2").val('');
			 $("#ship_postal_code_pay1").val('');
			 $("#ship_addr_pay1").val('');
			 city_change_payment("");
			 $("#ship_state_pay1").val('');
			  $("#ship_citypay1").val('');
			 $("#ship_countrypay1").val('');
			 $("#ship_phone_pay1").val('');		
	        }
	});
	
});
   
</script>

<form name="payment" method="POST" id="commentForm_cod" action="<?php echo PATH;?>pay_later/auction_payment">

<?php  foreach($this->deals_payment_deatils as $payment) {  ?>

	<input name="P_QTY" id="PC_QTY_VAL" value="1" type="hidden" >
	<input name="deal_id"  type="hidden" value="<?php echo $payment->deal_id; ?>" >
	<input name="merchant_id"  type="hidden" value="<?php echo $payment->merchant_id; ?>" >
	<input name="bid_id"  type="hidden" value="<?php echo $this->bid_id; ?>" >
	<input name="deal_key" type="hidden" value="<?php echo $payment->deal_key; ?>" >
	<input name="url_title" type="hidden" value="<?php echo $payment->url_title; ?>" >
	<input name="deal_value" type="hidden" value="<?php echo $payment->deal_value; ?>" >
	<input name="shipping_amount"  type="hidden" value="<?php echo $payment->shipping_fee; ?>" >
	<input name="amount" id="PC_AMOUNT"  type="hidden" value="<?php echo $this->current_bid_value; ?>" >     
  
				
				<!--content start-->
                                <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['SHIPPING_INFO']; ?></h3>
                                <div class="p_inner_block">
                       <div class="payment_form_block clearfix">                                                                                    							
                            <div class="shipping_copy_address">
                                <input type="checkbox" id="shipping_address_pay" tabindex="1" />
                                <label><?php echo $this->Lang['COPY_SHIP_ADDR']; ?></label>                                                                                                                                             					                                             
                            </div>
                            <div class="payment_form_section">
                                <div class="payment_form payment_shipping_form">
                                    <ul>
                                        <li>
                                            <label> <?php echo $this->Lang['NAME']; ?>  :<span class="form_star">*</span></label>
                                            <div class="fullname"><input autofocus tabindex="2" id="ship_nam_pay1" name="shipping_name" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" value="" class="required" maxlength="35"/>
                                            </div>
                                        </li>
                                        <li>
                                            <label><?php echo $this->Lang['ADDR1']; ?> :<span class="form_star">*</span></label>
                                            <div class="fullname"><input tabindex="3" id="ship_addr_pay1" name="adderss1" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" value="" class="required" maxlength="100"/></div>                                           
                                        </li>
                                        <li class="frm_clr">
                                            <label> <?php echo $this->Lang['ADDR2']; ?>  :</label>
                                            <div class="fullname"><input tabindex="4" id="ship_addr_pay2" name="address2" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" value="" size="40"  maxlength="100"/>
                                            </div>
                                        </li>
                                       <li>
                                            <label><?php echo $this->Lang['COUNTRY']; ?> :<span class="form_star">*</span></label>
                                            <div class="fullname">
                                            <select name="country" id="ship_countrypay1" tabindex="5"  onchange="return city_change_payment(this.value);">
                                            <option value=""><?php echo $this->Lang['SELECT_Y_COUNTRY']; ?></option>
                                            <?php foreach($this->all_country_list as $countryL){ ?>
                                           <option  value="<?php echo $countryL->country_name; ?>"><?php echo ucfirst($countryL->country_name); ?></option>
                                           <?php } ?>
                                           </select>
                                            </div>
                                        </li>
                                        <li class="frm_clr">
                                            <label><?php echo $this->Lang['SEL_CITY']; ?> :<span class="form_star">*</span></label>
                                            <div class="fullname">
                                            <select name="city"  id="ship_citypay1"  tabindex="6" class="CityPAY required">
                                            <option value=""><?php echo $this->Lang['COUNTRY_FIRST']; ?></option>
                                            <?php 
                                            foreach($this->all_city_list as $CityL){ ?>
                                            <option  value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
                                            <?php } ?>
                                            </select>

                                             <div class="hideerror" id="city_validation">This Field Is Required.</div>    
                                            </div>
                                        </li>
                                        <li>
                                            <label><?php echo $this->Lang['STATE']; ?> :<span class="form_star">*</span> </label>
												<div class="fullname"><input tabindex="7" id="ship_state_pay1" name="state" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_STATE']; ?>" type="text" value="" size="40" class="required" maxlength="50"/></div>
                                        </li>                                         
										<li class="frm_clr">
                                            <label><?php echo $this->Lang['POSTAL_CODE']; ?> :<span class="form_star">*</span></label>
												<div class="fullname"><input tabindex="8" id="ship_postal_code_pay1" name="postal_code" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>" type="text" value="" class="required number" maxlength="8"/></div>
                                        </li>	
											
										<li>
												<label><?php echo $this->Lang['PHONE']; ?> :<span class="form_star">*</span></label>
												<div class="fullname"><input tabindex="9" id="ship_phone_pay1" name="phone" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>" type="text" value="" class="required number" maxlength="18"/></div>
										</li>

                                    </ul>
                                </div>

                            </div>
                                <div class="buy_it complete_order_button" id="submit">                                        
                                        <input type="submit" tabindex="10" value="<?php echo $this->Lang['COMP_ODR']; ?>" title="<?php echo $this->Lang['COMP_ODR']; ?>" />												
                                </div>
                                <?php if(count($this->cms_tc) > 0){ ?>
                                <div class="payment_terms_outer"><p class="terms-conditons-text"> <span class="fl font_myriad_pro"><?php echo $this->Lang['BY_CLICK']; ?> </span> <a onclick="show_dis_tc();"  tabindex="11" title="<?php echo $this->Lang['TEMRS']; ?>" class="font_myriad_pro mt5"><?php echo $this->Lang['TEMRS']; ?>.</a></p> </div>
                                <?php } ?>
                        </div>
                    </div>
                    
                    <!--end-->
<?php } ?>                
</form>

				
