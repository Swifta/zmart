<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script>
    $(document).ready(function(){
      $(".CityPAY_new").hide();
        $("#commentForm_product").validate({

            messages: {

                friend_name: {
                    required: "<?php echo $this->Lang['PLS_ENT_FRD_NAM']; ?>"
                },
                friend_email: {
                    required: "<?php echo $this->Lang['PLS_ENT_FRD_EMAIL']; ?>",
                    email : "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>"
                },
                firstName: {
                    required: "<?php echo $this->Lang['PLS_ENT_CARD_NAM']; ?>"
                },
                creditCardNumber: {
                    required: "<?php echo $this->Lang['PLS_ENT_VAL_NO']; ?>" ,
                    creditcard: "<?php echo $this->Lang['PLS_ENT_VAL_NO']; ?>"
                },
                cvv2Number: {
                    required: "<?php echo $this->Lang['PLS_ENT_NO']; ?>",
                    number: "<?php echo $this->Lang['PLS_ENT_NO']; ?>"

                },
                address1: {
                    required: "<?php echo $this->Lang['PLS_ENT_VLD_ADDR']; ?>"
                },
                city : {
                    required: "<?php echo $this->Lang['PLS_ENT_CITY']; ?>"
                },
                state : {
                    required: "<?php echo $this->Lang['PLS_ENT_STATE']; ?>"
                },
                zip : {
                    required: "<?php echo $this->Lang['PLS_ENT_ZIP']; ?>",
                    number: "<?php echo $this->Lang['PLS_ENT_NO']; ?>"
                },

                shipping_name: {
                    required: "<?php echo $this->Lang['PLS_ENT_NAM']; ?>"
                },

                shipping_adderss1: {
                    required: "<?php echo $this->Lang['PLS_ENT_VLD_ADDR']; ?>"
                },

                shipping_state : {
                    required: "<?php echo $this->Lang['PLS_ENT_STATE1']; ?>"
                },
                shipping_postal_code : {
                    required: "<?php echo $this->Lang['PLS_ENT_ZIP']; ?>",
                    number: "<?php echo $this->Lang['PLS_ENT_NO']; ?>"
                },
                shipping_phone : {
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
        $("#shipping_address").change(function() {
          $(".CityPAY").show();
	     $(".CityPAY_new").hide();
            if($(this).is(':checked')) {
                $("#ship_nam1").val($("#ship_nam").val());
                $("#ship_addr2").val($("#ship_address2").val());
                $("#ship_postal_code1").val($("#ship_zipcode").val());
                $("#ship_addr1").val($("#ship_address1").val());
                $("#ship_cityp1").val($("#ship_city").val());
                $("#ship_countryp1").val($("#ship_country").val());
                $("#ship_state1").val($("#ship_state").val());
                $("#ship_phone1").val($("#ship_phone").val());

            } else {
                $("#ship_nam1").val('');
                $("#ship_addr2").val('');
                $("#ship_postal_code1").val('');
                $("#ship_addr1").val('');
                $("#ship_state1").val('');
                $("#ship_cityp1").val('');
                $("#ship_countryp1").val('');
                $("#ship_phone1").val('');


            }
        });
    });

</script>
<?php foreach ($this->get_cart_products as $payment) { ?>
    <form name="payment" method="POST" id="commentForm_product" action="<?php echo PATH; ?>creditcard_paypal/dodirectpayment">
        <?php
        $total_amount = "";
        foreach ($_SESSION as $key => $value) {
            if ((is_string($value)) && ($key == 'product_cart_id' . $value)) {
                ?>
                <input name="<?php echo $key; ?>" id="PC_QTY_VAL<?php echo $key; ?>" value="1" type="hidden">
            <?php
            }
        }
        ?>
    <?php if ($this->uri->last_segment() == "payment_details_friend.html") { ?>
            <div class="payment_form_block clearfix">
                <h3 class="type_form_title"><?php echo $this->Lang['FRI_INFO']; ?></h3>
                <div class="payment_form_section">
                    <div class="payment_form">
                        <ul>
                            <li>
                                <label><?php echo $this->Lang['FRI_NAME']; ?> :<span class="form_star">*</span></label>
                                <div class="fullname"><input type="text" value="" name="friend_name" AUTOCOMPLETE="OFF"  class="required"
				placeholder="<?php echo $this->Lang['ENTER_FRI_NAME']; ?>" autofocus /></div>
        <?php if (isset($this->form_error['friend_name'])) {
            echo $this->form_error["friend_name"];
        } ?>
                            </li>
                            <li>
                                <label><?php echo $this->Lang['FRI_EMAIL']; ?> :<span class="form_star">*</span></label>
                                <div class="fullname"><input type="text" value="" name="friend_email" AUTOCOMPLETE="OFF"  class="required"
				placeholder="<?php echo $this->Lang['ENTER_FRI_EMAIL']; ?>"/></div>
        <?php if (isset($this->form_error['friend_email'])) {
            echo $this->form_error["friend_email"];
        } ?>
                                <input name="friend_gift"  value="1" type="hidden">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>



    <?php } else { ?>
            <input name="friend_name"  type="hidden" value="xxxyyy" >
            <input name="friend_email"   type="hidden" value="xxxyyy@zzz.com" >

            <input name="friend_gift"  value="0" type="hidden">
    <?php } ?>
        <input name="amount" size="40" id="TotalAmount" type="hidden" value="<?php echo $total_amount; ?>"/>
        <input name="p_referral_amount" id="PC_REFERRAL" value="0" type="hidden" >
        <input name="prime_customer" id="PCD_PRIME_CUSTOMER" value="<?php echo $this->session->get('prime_customer');?>" type="hidden" >


        <div class="payment_form_block clearfix">
            <h3 class="type_form_title">Account Information</h3>
            <div class="payment_form_section">
                <div class="payment_form">
                    <ul>



                        <li>
                            <label> <?php echo $this->Lang['CAR_HOLDER']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text" value="" tabindex="1" maxlength="40" AUTOCOMPLETE="OFF"  name="firstName" class="required"
			placeholder="<?php echo $this->Lang['ENTER_CAR_HOLDER']; ?>"/></div>
                            <em>
    <?php if (isset($this->form_error['firstName'])) {
        echo $this->form_error["firstName"];
    } ?>

                            </em>
                        </li>
                        <li>
                            <label><?php echo $this->Lang['CARD_NUMBER']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text" maxlength="19" tabindex="2" AUTOCOMPLETE="OFF" name="creditCardNumber" class="required creditcard" placeholder="<?php echo $this->Lang['ENTER_CARD_NUMBER']; ?>"/></div>
                            <em>
    <?php if (isset($this->form_error['creditCardNumber'])) {
        echo $this->form_error["creditCardNumber"];
    } ?>
                            </em>
                            <div class="security_cards_img">   </div>
                        </li>
                        
                        <li>
                            <label><?php echo $this->Lang['EXPI_DATE']; ?> :</label>
                            <div class="exp_date_outer"><div class="expir_date"> <select name=expDateMonth tabindex="3" >
    <?php for ($m = 1; $m <= 12; $m++) { ?>
                                            <option value="<?php echo $m; ?>" <?php if (date("n", time()) == $m) {
            echo "Selected";
        } ?>><?php echo $m; ?></option>
    <?php } ?>
                                    </select></div>
                                <div class="expir_date"> <select name=expDateYear tabindex="4">
                                <?php for ($y = 2012; $y <= 2024; $y++) { ?>
                                            <option value="<?php echo $y; ?>"   <?php if (date("Y", time()) == $y) {
                                echo "Selected";
                            } ?>><?php echo $y; ?></option>
    <?php } ?>
                                    </select></div></div>
                        </li>
                        <li>
                            <label><?php echo $this->Lang['SECU_CODE']; ?> :<span class="form_star">*</span></label>
                            <div class="security_code_outer">
                                <div class="security_code">
                                    <input type="password" maxlength="4" AUTOCOMPLETE="OFF" tabindex="5" name="cvv2Number" class="required number"
					placeholder="<?php echo $this->Lang['ENTER_SECU_CODE']; ?>" />
                                </div>
                                <div class="card_img">  </div>
                                <em>

    <?php if (isset($this->form_error['cvv2Number'])) {
        echo $this->form_error["cvv2Number"];
    } ?>
                                </em>


                            </div>


                        </li>

                        
                    </ul>

                </div>

                <div class="payment_form">
                    <ul>
                        <li>
                            <label><?php echo $this->Lang['BILL_ADD']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text" maxlength="100" tabindex="6" AUTOCOMPLETE="OFF"  name="address1" class="required" placeholder="<?php echo $this->Lang['ENTER_BILL_ADD']; ?>"/></div>
                            <em>
    <?php if (isset($this->form_error['address1'])) {
        echo $this->form_error["address1"];
    } ?>
                            </em>
                        </li>
                        <li>
                            <label><?php echo $this->Lang['CITY']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text" tabindex="7" maxlength="40" AUTOCOMPLETE="OFF"  name="city" class="required"
				placeholder="<?php echo $this->Lang['ENTER_CITY']; ?>"/></div>
                            <em>
    <?php if (isset($this->form_error['city'])) {
        echo $this->form_error["city"];
    } ?>
                            </em>
                        </li>
                        <li>
                            <label><?php echo $this->Lang['STATE_PROVINCE']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text" maxlength="2" tabindex="8" AUTOCOMPLETE="OFF"  name="state" class="required"
				placeholder="<?php echo $this->Lang['ENTER_STATE_PROVINCE']; ?>" /></div>
                            <em>
    <?php if (isset($this->form_error['state'])) {
        echo $this->form_error["state"];
    } ?>
                            </em>
                        </li>

                        <li>
                            <label><?php echo $this->Lang['POSTAL_CODE']; ?> :<span class="form_star">*</span></label>

                            <div class="fullname"><input type="text" tabindex="9" maxlength="10" name="zip" AUTOCOMPLETE="OFF"  class="required number" placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>"/></div>
                            <em>
    <?php if (isset($this->form_error['zip'])) {
        echo $this->form_error["zip"];
    } ?>
                            </em>
                        </li>
                    </ul>
                </div>



            </div>


        </div>


        <div class="payment_form_block clearfix">
            <h3 class="type_form_sub_title"  style="display:none"><?php echo $this->Lang['SHIPPING_INFO']; ?></h3>
            <div class="shipping_copy_address"  style="display:none">
                <input type="checkbox" id="shipping_address">
                <label><?php echo $this->Lang['COPY_SHIP_ADDR']; ?></label>
            </div>
            <div class="payment_form_section">
                <div class="payment_form payment_shipping_form">
                    <ul  style="display:none">
                        <li>
                            <label><?php echo $this->Lang['NAME']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input id="ship_nam1" name="shipping_name" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" tabindex="1" value=" <?php echo ucfirst($this->session->get('shipping_name')); ?>" class="required" maxlength="256"/></div>
                        </li>
                        <li>
                            <label><?php echo $this->Lang['ADDR1']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input  id="ship_addr1" name="shipping_adderss1" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" value="<?php echo ucfirst($this->session->get('shipping_address1')); ?>" tabindex="2" class="required" maxlength="256"/></div>
                        </li>
                        <li class="frm_clr">
                            <label><?php echo $this->Lang['ADDR2']; ?> :</label>
                            <div class="fullname"><input id="ship_addr2" name="shipping_address2"  AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" tabindex="3" value="<?php echo ucfirst($this->session->get('shipping_address2')); ?>" size="40"  maxlength="256"/></div>
                        </li>
                      
                        <li>
                            <label><?php echo $this->Lang['COUNTRY']; ?> :<span class="form_star">*</span> </label>
                            <div class="fullname">
                                <select name="shipping_country" id="ship_countryp1" onchange="return city_change_payment(this.value);" >
                                  <option value=""><?php echo $this->Lang['SELECT_Y_COUNTRY']; ?></option>
                    <?php foreach ($this->all_country_list as $countryL) { ?>
                                        <option <?php if ($countryL->country_name == $this->session->get('shipping_country')) {
                    echo 'Selected="true"';
                } ?> value="<?php echo $countryL->country_name; ?>"><?php echo ucfirst($countryL->country_name); ?></option>
    <?php } ?>
                                </select>

                        </li>                        
                          <li class="frm_clr">
                            <label><?php echo $this->Lang['SEL_CITY']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname">
                                <select name="shipping_city"  id="ship_cityp1" class="CityPAY required">
                                <option value=""><?php echo $this->Lang['COUNTRY_FIRST']; ?></option>
                                    <?php 
                                    foreach ($this->all_city_list as $CityL) {
                                        ?>
                                        <option <?php if ($CityL->city_id == $this->session->get('shipping_city')) {
                                            echo 'Selected="true"';
                                        } ?> value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
    <?php } ?>
                                </select>
                                
                                 <select name="shipping_city" class="CityPAY_new required">
                                    <?php 
                                    foreach ($this->all_city_list as $CityL) {
                                        ?>
                                        <option <?php if ($CityL->city_id == $this->session->get('shipping_city')) {
                                            echo 'Selected="true"';
                                        } ?> value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
    <?php } ?>
                                </select>

                            </div>

                        </li>
                        
                        <li>
                            <label><?php echo $this->Lang['STATE']; ?> :<span class="form_star">*</span> </label>
                            <div class="fullname"><input id="ship_state1" name="shipping_state" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_STATE']; ?>" type="text" tabindex="4" value="<?php echo ucfirst($this->session->get('shipping_state')); ?>" size="40" class="required" maxlength="256"/></div>
                        </li>
                        <li class="frm_clr">
                            <label><?php echo $this->Lang['POSTAL_CODE']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input id="ship_postal_code1" name="shipping_postal_code" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>" type="text" value="<?php echo $this->session->get('shipping_postal_code'); ?>" class="required number" maxlength="256"/></div>
                        </li>
                        <li>
                            <label><?php echo $this->Lang['PHONE']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input  id="ship_phone1" name="shipping_phone"  size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>" type="text" value="<?php echo $this->session->get('shipping_phone'); ?>" class="required number" maxlength="18"/></div>
                        </li>

                    </ul>



    <?php foreach ($this->get_cart_products as $payment) { ?>
                        <input name="P_QTY" id="P_QTY_VAL" value="1" type="hidden" >
                        <input name="p_deal_id"  type="hidden" value="<?php echo $payment->deal_id; ?>" >
                        <input name="P_deal_key" type="hidden" value="<?php echo $payment->deal_key; ?>" >
                        <input name="p_deal_value" type="hidden" value="<?php echo $payment->deal_value; ?>" >
                        <input name="p_amount" id="P_AMOUNT"  type="hidden" value="<?php echo $payment->deal_value; ?>" >
                        <input name="p_referral_amount" id="P_REFERRAL" value="0" type="hidden" >

    <?php } ?>

                </div>

            </div>
            <div class="buy_it complete_order_button" id="submit">
                <input type="submit" value="<?php echo $this->Lang['COMP_ODR']; ?>" tabindex="10" title="<?php echo $this->Lang['COMP_ODR']; ?>" />
            </div>
        <?php if(count($this->cms_tc) > 0){ ?>
            <div class="payment_terms_outer"><p class="terms-conditons-text" id="terms1"> <span class="fl font_myriad_pro"><?php echo $this->Lang['BY_CLICK']; ?> </span> <a onclick="show_dis_tc();" tabindex="11" title="<?php echo $this->Lang['TEMRS']; ?>" class="font_myriad_pro mt5"><?php echo $this->Lang['TEMRS']; ?>.</a></p> </div>
            <?php } ?>
        </div>
    </FORM>

<?php } ?>

