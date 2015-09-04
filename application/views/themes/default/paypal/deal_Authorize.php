<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script>
    $(document).ready(function(){
        $("#commentForm_authorize").validate({
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
                country : {
                    required: "<?php echo $this->Lang['PLS_ENT_CRTY']; ?>"                         
                },
                zip : {
                    required: "<?php echo $this->Lang['PLS_ENT_ZIP']; ?>",
                    number: "<?php echo $this->Lang['PLS_ENT_NO']; ?>"                             
                },
                phone: {
                    required :"<?php echo $this->Lang['PLS_ENT_NO']; ?>",
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
    });
   
</script>
<?php foreach ($this->deals_payment_deatils as $payment) { ?>
    <form name="payment" method="POST" id="commentForm_authorize" action="<?php echo PATH; ?>authorize/dodirectpayment">
        <input name="P_QTY" id="APCC_QTY_VAL" value="1" type="hidden" >
        <input name="deal_id"  type="hidden" value="<?php echo $payment->deal_id; ?>" >
        <input name="deal_key" type="hidden" value="<?php echo $payment->deal_key; ?>" >
        <input name="deal_value" type="hidden" value="<?php echo $payment->deal_value; ?>" >
        <input name="amount" id="APCC_AMOUNT"  type="hidden" value="<?php echo $payment->deal_value; ?>" >
        <input name="p_referral_amount" id="APCC_REFERRAL" value="0" type="hidden">
        <?php if ($this->uri->segment(2) == "payment_details_friend") { ?>
            <div class="payment_form_block clearfix">
                <h3 class="type_form_title"><?php echo $this->Lang['FRI_INFO']; ?></h3>
            <div class="payment_form_section">
                <div class="payment_form">
                    <ul>
                        <li>
                            <label> <?php echo $this->Lang['FRI_NAME']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text" value=""  AUTOCOMPLETE="OFF" name="friend_name" class="required" placeholder="<?php echo $this->Lang['ENTER_FRI_NAME']; ?>" autofocus /></div>
                            <em>
                                <?php if (isset($this->form_error['friend_name'])) {
                                    echo $this->form_error["friend_name"];
                                } ?>
                            </em>
                        </li>
                        <li>
                            <label><?php echo $this->Lang['FRI_EMAIL']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text" value="" AUTOCOMPLETE="OFF" name="friend_email" class="required" placeholder="<?php echo $this->Lang['ENTER_FRI_EMAIL']; ?>"/></div>
                            <em>
        <?php if (isset($this->form_error['friend_email'])) {
            echo $this->form_error["friend_email"];
        } ?>
                            </em>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
            <input name="friend_gift"  value="1" type="hidden">

        <?php } else { ?>
            <input name="friend_name"  type="hidden" value="xxxyyy" >
            <input name="friend_email"   type="hidden" value="xxxyyy@zzz.com" >
            <input name="friend_gift"  value="0" type="hidden">

    <?php } ?>
        <div class="payment_form_block clearfix">
            <h3 class="type_form_sub_title"><?php echo $this->Lang['ACC_INFO']; ?></h3>
            <div class="payment_form_section">
                <div class="payment_form">
                    <ul>
                        <li>
                            <label> <?php echo $this->Lang['CAR_HOLDER']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text" value="" tabindex="1"  maxlength="40" AUTOCOMPLETE="OFF" name="firstName" class="required" placeholder="<?php echo $this->Lang['ENTER_CAR_HOLDER']; ?>" autofocus /></div>
                            <em>
    <?php if (isset($this->form_error['firstName'])) {
        echo $this->form_error["firstName"];
    } ?>
                            </em>    
                        </li>
                        <li>
                            <label><?php echo $this->Lang['CARD_NUMBER']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text"  tabindex="2" AUTOCOMPLETE="OFF" maxlength="19" name="creditCardNumber" class="required creditcard" placeholder="<?php echo $this->Lang['ENTER_CARD_NUMBER']; ?>"/></div>
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
                                <div class="expir_date"> <select name=expDateYear tabindex="4" >
    <?php for ($y = 2012; $y <= 2024; $y++) { ?>
                                            <option value="<?php echo $y; ?>"   <?php if (date("Y", time()) == $y) {
            echo "Selected";
        } ?>><?php echo $y; ?></option>
    <?php } ?>
                                    </select></div></div>
                        </li>
                        <li>
                            <label><?php echo $this->Lang['SECU_CODE']; ?> :<span class="form_star">*</span></label>
                            <div class="security_code_outer">	<div class="security_code"><input type="password" tabindex="5" maxlength="4"  AUTOCOMPLETE="OFF" name="cvv2Number" class="required number" placeholder="<?php echo $this->Lang['ENTER_SECU_CODE']; ?>"/></div>
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
                            <div class="fullname"><input type="text"  tabindex="6" AUTOCOMPLETE="OFF" maxlength="100" name="address1" class="required" placeholder="<?php echo $this->Lang['ENTER_BILL_ADD']; ?>" /></div>
                            <em>
    <?php if (isset($this->form_error['address1'])) {
        echo $this->form_error["address1"];
    } ?>
                            </em>
                        </li>
                        <li>
                            <label><?php echo $this->Lang['CITY']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text"  tabindex="7" AUTOCOMPLETE="OFF" maxlength="40" name="city" class="required" placeholder="<?php echo $this->Lang['ENTER_CITY']; ?>" /></div>
                            <em>
                                <?php if (isset($this->form_error['city'])) {
                                    echo $this->form_error["city"];
                                } ?>
                            </em>
                        </li>
                        <li>
                            <label><?php echo $this->Lang['STATE_PROVINCE']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text" tabindex="8" maxlength="2"  AUTOCOMPLETE="OFF" name="state" class="required" placeholder="<?php echo $this->Lang['ENTER_STATE_PROVINCE']; ?>"/></div>
                            <em>
                                <?php if (isset($this->form_error['state'])) {
                                    echo $this->form_error["state"];
                                } ?>
                            </em>    
                        </li>

                        <li>
                            <label><?php echo $this->Lang['COUNTRY']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text"  tabindex="9" AUTOCOMPLETE="OFF" maxlength="64" name="country" class="required" placeholder="<?php echo $this->Lang['ENTER_COUNTRY']; ?>"/></div>


                            <em>
    <?php if (isset($this->form_error['country'])) {
        echo $this->form_error["country"];
    } ?>
                            </em>     
                        </li>

                        <li>
                            <label><?php echo $this->Lang['POSTAL_CODE']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text" tabindex="10"  AUTOCOMPLETE="OFF" maxlength="10" name="zip" class="required number" placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>"/></div>
                            <em>
    <?php if (isset($this->form_error['zip'])) {
        echo $this->form_error["zip"];
    } ?>
                            </em>     
                        </li>
                        <li>
                            <label><?php echo $this->Lang['PHONE']; ?> :<span class="form_star">*</span></label>
                            <div class="fullname"><input type="text"  tabindex="11" AUTOCOMPLETE="OFF" maxlength="10" name="phone" class="required number" placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>"/></div>
                            <em>
    <?php if (isset($this->form_error['phone'])) {
        echo $this->form_error["phone"];
    } ?>
                            </em>     
                        </li>


                    </ul>
                </div>



            </div>
            <div class="buy_it complete_order_button" id="submit">											 
                <input type="submit" tabindex="12" value="<?php echo $this->Lang['COMP_ODR']; ?>" title="<?php echo $this->Lang['COMP_ODR']; ?>" />
            </div>

<?php if(count($this->cms_tc) > 0){ ?>
            <div class="payment_terms_outer"><p class="terms-conditons-text" style="padding-left:0px;"> <span class="fl font_myriad_pro"><?php echo $this->Lang['BY_CLICK']; ?> </span> <a onclick="show_dis_tc();" title="<?php echo $this->Lang['TEMRS']; ?>" tabindex="13" class="font_myriad_pro mt5"><?php echo $this->Lang['TEMRS']; ?>.</a></p> </div>
            <?php } ?>
        </div>

    </form>
<?php } ?>

