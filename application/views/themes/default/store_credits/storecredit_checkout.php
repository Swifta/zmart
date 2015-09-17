<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script>
  $(document).ready(function(){
        $(".CityPAY_new").hide();
	$("#commentForm").validate({
		messages: {
			friend_name: {
			   required: "<?php echo $this->Lang['PLS_ENT_FRD_NAM']; ?>"                         
		   },
		   	friend_email: {
			    required: "<?php echo $this->Lang['PLS_ENT_FRD_EMAIL']; ?>", 
			    email : "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>"                             
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
            shipping_name: {
			   required: "<?php echo $this->Lang['PLS_ENT_NAM']; ?>"                         
		   },
		    phone : {
			   required: "<?php echo $this->Lang['PLZ_ETR_PHO']; ?>",
			   number: "<?php echo $this->Lang['PLS_ENT_NO']; ?>"                             
			},
		},
		 submitHandler: function(form) {
		   // some other code
		   // maybe disabling submit button
		   // then:
			$('div#submit').hide();
		   form.submit();
		 }
	});
	 $("#shipping_address2").change(function() {
	        $(".CityPAY").show();
	        $(".CityPAY_new").hide();
		if($(this).is(':checked')) { 
			 $("#ship_nam_cod1").val($("#ship_nam").val());
			 $("#ship_addr_cod2").val($("#ship_address2").val());
			 $("#ship_postal_code_cod1").val($("#ship_zipcode").val());
			 $("#ship_addr_cod1").val($("#ship_address1").val());
			 $("#ship_citycod1").val($("#ship_city").val());
			 $("#ship_countrycod1").val($("#ship_country").val());
			 $("#ship_state_cod1").val($("#ship_state").val());
			 $("#ship_phone_cod1").val($("#ship_phone").val());
			
		} else { 
			 $("#ship_nam_cod1").val('');
			 $("#ship_addr_cod2").val('');
			 $("#ship_postal_code_cod1").val('');
			 $("#ship_addr_cod1").val('');
			 $("#ship_state_cod1").val('');
			  $("#ship_citycod1").val('');
			 $("#ship_countrycod1").val('');
			 $("#ship_phone_cod1").val('');		
	        }
	});
});
      
</script>
  
<form name="payment" method="POST" id="commentForm" action="<?php echo PATH;?>store_credit/storecredit">  
	<input name="friend_name"  type="hidden" value="xxxyyy" >
	<input name="friend_email"   type="hidden" value="xxxyyy@zzz.com" >
	<input name="friend_gift"  value="0" type="hidden">
	<div class="payment_form_block clearfix">
                                            <h3 class="type_form_title"  style="display:none"><?php echo $this->Lang['SHIPPING_INFO']; ?></h3>
                                            <div class="shipping_copy_address"  style="display:none">
                                                <input type="checkbox" id="shipping_address2"/>
                                                <label><?php echo $this->Lang['COPY_SHIP_ADDR']; ?></label>
                                            </div>
                                            <div class="payment_form_section">
                                                <div class="payment_form payment_shipping_form">
                                                    <ul  style="display:none">
                                                       <li>
                                                                <label><?php echo $this->Lang['NAME']; ?> :<span class="form_star">*</span></label>
                                                                <div class="fullname"><input id="ship_nam_cod1" name="shipping_name" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" value="<?php echo ucfirst($this->session->get('shipping_name')); ?>" class="required" maxlength="256"/></div>
                                                        </li>
                                                        <li>
                                                                 <label><?php echo $this->Lang['ADDR1']; ?> :<span class="form_star">*</span></label>
                                                                 <div class="fullname"><input  id="ship_addr_cod1" name="adderss1" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" value="<?php echo ucfirst($this->session->get('shipping_address1')); ?>" class="required" maxlength="256"/></div>
                                                         </li>
                                                        <li class="frm_clr">
                                                                <label><?php echo $this->Lang['ADDR2']; ?> :</label>
                                                                <div class="fullname"><input id="ship_addr_cod2" name="address2" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" value="<?php echo ucfirst($this->session->get('shipping_address2')); ?>" size="40"  maxlength="256"/></div>
                                                        </li>
                                                        <li>
                                                                 <label><?php echo $this->Lang['COUNTRY']; ?> :<span class="form_star">*</span></label>
                                                                 <div class="fullname">
                                                                 <select name="country" id="ship_countrycod1" onchange="return city_change_payment(this.value);">
                                                                 <option value=""><?php echo $this->Lang['SELECT_Y_COUNTRY']; ?></option>
                                                                 <?php foreach($this->all_country_list as $countryL){ ?>
                                                                <option <?php if ($countryL->country_name == $this->session->get('shipping_country')) { echo 'Selected="true"'; } ?> value="<?php echo $countryL->country_name; ?>"><?php echo ucfirst($countryL->country_name); ?></option>
                                                                <?php } ?>
                                                                </select>
                                                                 </div>
                                                         </li>
                                                        <li class="frm_clr">
                                                                <label><?php echo $this->Lang['SEL_CITY']; ?> :<span class="form_star">*</span></label>
                                                                <div class="fullname">
                                                                <select name="city"  id="ship_citycod1"  class="CityPAY required">
                                                                <option value=""><?php echo $this->Lang['COUNTRY_FIRST']; ?></option>
                                                                <?php 
                                                                foreach($this->all_city_list as $CityL){ ?>
                                                                <option <?php if ($CityL->city_id == $this->session->get('shipping_city')) { echo 'Selected="true"'; } ?> value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
                                                                <?php } ?>
                                                                </select>
                                                                <select name="city" tabindex="5" class="CityPAY_new required">
                                                                <?php 
                                                                foreach($this->all_city_list as $CityL){ ?>
                                                                <option <?php if ($CityL->city_id == $this->session->get('shipping_city')) { echo 'Selected="true"'; } ?> value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
                                                                <?php } ?>
                                                                </select>
                                                                </div>
                                                        </li>
                                                        <li>
                                                                 <label><?php echo $this->Lang['STATE']; ?> :<span class="form_star">*</span> </label>
                                                                 <div class="fullname"><input  id="ship_state_cod1" name="state" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_STATE']; ?>" type="text" value="<?php echo ucfirst($this->session->get('shipping_state')); ?>" size="40" class="required" maxlength="256"/></div>
                                                         </li>                                                         
                                                        <li class="frm_clr">
                                                                <label><?php echo $this->Lang['POSTAL_CODE']; ?> :<span class="form_star">*</span></label>
                                                                <div class="fullname"><input id="ship_postal_code_cod1" name="postal_code" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>" type="text" value="<?php echo $this->session->get('shipping_postal_code'); ?>" class="required number" maxlength="256"/></div>
                                                        </li>
                                                        <li>
                                                                 <label><?php echo $this->Lang['PHONE']; ?> :<span class="form_star">*</span></label>
                                                                 <div class="fullname"><input id="ship_phone_cod1" name="phone" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>" type="text" value="<?php echo $this->session->get('shipping_phone'); ?>" class="required number" maxlength="18"/></div>
                                                         </li>
											
                                                    </ul>
                                                    
                                                    
                                                    
                          <?php  foreach($this->get_cart_products as $payment) {  ?>
            <?php  $total_amount="";
                    foreach($_SESSION as $key=>$value) 
                    { 

                            if ((is_string($value)) && ($key == 'product_cart_id' . $value)) {?>
                            <input name="<?php echo $key; ?>" id="COD_QTY_VAL<?php echo $key; ?>" value="1" type="hidden">
                            <?php }
                    } 

            ?> 
            <input name="amount" size="40" id="COD_TotalAmount" type="hidden" value="<?php echo $total_amount; ?>"/>
            <input name="p_referral_amount" id="COD_REFERRAL" value="0" type="hidden" >
                <?php } ?>
                
                <input name="prime_customer" id="IS_PRIME_CUSTOMER" value="<?php echo $this->session->get('prime_customer');?>" type="hidden" >
                          
                            
                             



                                                </div>
                                                                 <div class="buy_it complete_order_button" id="submit">                                                        
                                    <input type="submit" value="<?php echo $this->Lang['COMP_ODR']; ?>" tabindex="1" title="<?php echo $this->Lang['COMP_ODR']; ?>" />                                                                                                               
                                </div>
                                <?php if(count($this->cms_tc) > 0){ ?>
                                <div class="payment_terms_outer"><p class="terms-conditons-text" id="terms1"> <span class="fl font_myriad_pro"><?php echo $this->Lang['BY_CLICK']; ?> </span> <a onclick="show_dis_tc();" title="<?php echo $this->Lang['TEMRS']; ?>" class="font_myriad_pro mt5" tabindex="2"><?php echo $this->Lang['TEMRS']; ?>.</a></p> </div>
                                <?php } ?>
                                                </div>
                                                </div>                                                
                                        </form>
