<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script>
    $(document).ready(function(){
         $(".CityPAY_new").hide();
        
        $("#cashForm").validate({
            messages: {
                friend_name: {
                    required: "<?php echo $this->Lang['PLS_ENT_FRD_NAM']; ?>"                         
                },
                friend_email: {
                    required: "<?php echo $this->Lang['PLS_ENT_FRD_EMAIL']; ?>", 
                    email : "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>"                             
                },
                shipping_name: {
                    required: "<?php echo $this->Lang['PLS_ENT_NAM']; ?>"                         
                },		  
                adderss1: {
                    required: "<?php echo $this->Lang['PLS_ENT_VLD_ADDR']; ?>"                         
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
                storecredit : {
                    required: "Please upload store credit document",
                },
            },
            submitHandler: function(form) {
                $('div#submit').hide();
                form.submit();
            }
        });
        $("#shipping_address1").change(function() { 
                $(".CityPAY").show();
	     $(".CityPAY_new").hide();
            if($(this).is(':checked')) {  
                $("#ship_nam_p1").val($("#ship_nam").val());
                $("#ship_addr_p2").val($("#ship_address2").val());
                $("#ship_postal_code_p1").val($("#ship_zipcode").val());
                $("#ship_addr_p1").val($("#ship_address1").val());
                $("#ship_city_p1").val($("#ship_city").val());
                $(".CityPAY_new").val($("#ship_city").val());
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
                $("#ship_city_p1").val('');
                city_change_payment('-99');
                $(".CityPAY_new").val('');
                $("#ship_country_p1").val('');
                $("#ship_phone_p1").val('');
            }
        }); 
    });
</script> 
    <div class="payment_form_block clearfix">
        <div class="shipping_copy_address">
            <input type="checkbox" id="shipping_address1"  name="shipping_checkbox" <?php if($this->session->get('shipping_checkbox')){ ?> checked <?php  } ?>tabindex="1" />
            <label><?php echo $this->Lang['COPY_SHIP_ADDR']; ?></label>
        </div>    
        <div class="payment_form_section">
            <div class="payment_form payment_shipping_form">
                <ul>
                    <li>
                    
                        <label><?php echo $this->Lang['NAME']; ?> :<span class="form_star">*</span></label>
                        <div class="fullname"><input id="ship_nam_p1"  name="shipping_name" size="40" tabindex="2" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" value="<?php if($this->session->get('shipping_name')){ echo $this->session->get('shipping_name'); } ?>" class="required" maxlength="35" autofocus /></div>
                    </li>
                    <li>
                        <label><?php echo $this->Lang['ADDR1']; ?> :<span class="form_star">*</span></label>
                        <div class="fullname"><input id="ship_addr_p1" name="address1" tabindex="3" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" value="<?php if($this->session->get('shipping_address1')){ echo $this->session->get('shipping_address1'); } ?>" class="required" maxlength="100"/></div>
                    </li>
                    <li class="frm_clr">
                        <label><?php echo $this->Lang['ADDR2']; ?> : </label>
                        <div class="fullname"><input id="ship_addr_p2" name="address2" tabindex="4" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" value="<?php if($this->session->get('shipping_address2')){ echo $this->session->get('shipping_address2'); } ?>" size="40"  maxlength="100"/></div>
                    </li>
                    <li>
                        <label><?php echo $this->Lang['COUNTRY']; ?> :<span class="form_star">*</span></label>
                        <div class="fullname">
                        <select name="country" id="ship_country_p1" tabindex="5" onchange="return city_change_payment(this.value);" class="required">
                        <option value=""><?php echo $this->Lang['SELECT_Y_COUNTRY']; ?></option>
                        <?php if($this->session->get('shipping_country')){ ?>
                        <?php foreach ($this->all_country_list as $countryL) { ?>
                        <option <?php if ($countryL->country_name == $this->session->get('shipping_country')) {
                        echo 'Selected="true"';
                        } ?> value="<?php echo $countryL->country_name; ?>"><?php echo ucfirst($countryL->country_name); ?></option>
                        <?php } ?>
                        <?php } else { ?>
                        <?php foreach ($this->all_country_list as $countryL) { ?>
                        <option <?php if ($countryL->country_url == $this->input->get('country')) {
                        echo 'Selected="true"';
                        } ?> value="<?php echo $countryL->country_name; ?>"><?php echo ucfirst($countryL->country_name); ?></option>
                        <?php } ?>
                        <?php } ?>
                        </select>
                        </div>
                    </li>                    
                    <li class="frm_clr">
                        <label><?php echo $this->Lang['SEL_CITY']; ?> :<span class="form_star">*</span></label>
                        <div class="fullname">
                            <select name="city"  id="ship_city_p1" tabindex="6" class="CityPAY required">
                            <option value=""><?php echo $this->Lang['COUNTRY_FIRST']; ?></option>
                            <?php if($this->session->get('shipping_city')){ ?>
                                <?php foreach ($this->all_city_list as $CityL) {  ?>                                
                                    <option <?php if ($CityL->city_id == $this->session->get('shipping_city')) {
                                        echo 'Selected="true"';
                                    }  ?> value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
                                <?php } ?>
                                <?php } else { ?>
                                <?php foreach ($this->all_city_list as $CityL) {  ?>                                
                                    <option <?php if ($CityL->city_url == $this->input->get('city')) {
                                        echo 'Selected="true"';
                                    }  ?> value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
                                <?php } ?>
                                
                                <?php } ?>
                            </select>
                            
                        </div>
                    </li>
                    <li>
                        <label><?php echo $this->Lang['STATE']; ?> :<span class="form_star">*</span> </label>
                        <div class="fullname"><input id="ship_state_p1"  name="state" tabindex="7" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_STATE']; ?>" type="text" value="<?php if($this->session->get('shipping_state')){ echo $this->session->get('shipping_state'); } ?>" size="40" class="required" maxlength="100"/></div>
                    </li>
                    <li class="frm_clr">
                        <label><?php echo $this->Lang['POSTAL_CODE']; ?> :<span class="form_star">*</span></label>
                        <div class="fullname"><input id="ship_postal_code_p1" name="postal_code" tabindex="8" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>" type="text" value="<?php if($this->session->get('shipping_postal_code')){ echo $this->session->get('shipping_postal_code'); } ?>" class="required number" maxlength="8"/></div>
                    </li>
                    <li>
                        <label><?php echo $this->Lang['PHONE']; ?> :<span class="form_star">*</span></label>
                        <div class="fullname"><input id="ship_phone_p1" name="phone" tabindex="9" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>" type="text" value="<?php if($this->session->get('shipping_phone')){ echo $this->session->get('shipping_phone'); } ?>" class="required number" maxlength="16"/></div>
                    </li>
                </ul>
                <?php foreach ($this->get_cart_products as $payment) { ?>
                    <?php  $total_amount = "";
                    foreach ($_SESSION as $key => $value) {
                     if (is_string($value) && ($key == 'product_cart_id' . $value)) {  ?>
                    <input name="<?php echo $key; ?>" id="PCC_QTY_VAL<?php echo $key; ?>" value="1" type="hidden">
                    <?php  }  }  ?> 
                    <input name="amount" size="40" id="P_TotalAmount" type="hidden" value="<?php echo $total_amount; ?>"/>
                    <input name="p_referral_amount" id="PC_REFERRAL" value="0" type="hidden" >
                <?php } ?>
            </div>
        </div>
        <?php /*<div class="p_inner_block">
            <div class="checkout-section clearfix">
                <a class="gift_card" <?php if ($this->session->get("UserID")) { ?>href="<?php echo PATH . 'product/payment_details_friend.html'; ?>" <?php } else { ?>onclick="showlogin();" style="cursor:pointer;"<?php } ?> title="<?php echo $this->Lang['BUY_FOR_FR']; ?>"> <?php echo $this->Lang['BUY_FOR_FR']; ?> </a> 
                <div class="checkout_section_right">
                    <div class="continue-shop-text"><a href="<?php echo PATH ?>products.html"><?php echo $this->Lang['CONTINUE_SHOPPING']; ?></a></div>
                    <small><?php echo $this->Lang['OR']; ?></small>
                    <div class="checkout-button">                                                                    
                        <a class="buy_it"  <?php if ($this->UserID) { ?>   href="<?php echo PATH ?>cart_checkout.html"  <?php } else { ?> href="javascript:showlogin();" <?php } ?> title="<?php echo $this->Lang['PROCEDURE']; ?>"><?php echo $this->Lang['PROCEDURE']; ?></a>
                    </div>                                                  
                </div>    
            </div>  
        </div> */ ?>   
            
                                                               
                         <div class="buy_it complete_order_button">
                <input type="submit" value="<?php echo $this->Lang['CONTINUE']; ?>.." tabindex="10" title="<?php echo $this->Lang['CONTINUE']; ?>.." />
            </div>  
                        
        <div class="payment_terms_outer"><?php /*<p class="terms-conditons-text" id="terms1"> <span class="fl font_myriad_pro"><?php echo $this->Lang['BY_CLICK1']; ?> </span> <a onclick="show_dis_tc();" title="<?php echo $this->Lang['TEMRS']; ?>" tabindex="11" class="font_myriad_pro mt5"><?php echo $this->Lang['TEMRS']; ?>.</a></p>*/ ?> </div> 
    </div>

