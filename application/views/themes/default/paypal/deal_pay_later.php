<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script>
    $(document).ready(function(){
          $("#commentForm_cod").validate({
	messages: {
		
			friend_name: {
			   required: "<?php echo $this->Lang['PLS_ENT_FRD_NAM']; ?>"                         
		   },
		   	friend_email: {
			   required: "<?php echo $this->Lang['PLS_ENT_FRD_EMAIL']; ?>", 
			    email : "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>"                             
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
<?php  foreach($this->deals_payment_deatils as $payment) {  ?>
<form name="payment" method="POST" id="commentForm_cod" action="<?php echo PATH;?>pay_later/deal_cash_delivery">
  <input name="P_QTY" id="PL_QTY_VAL" value="1" type="hidden" >
  <input name="deal_id"  type="hidden" value="<?php echo $payment->deal_id; ?>" >
  <input name="deal_key" type="hidden" value="<?php echo $payment->deal_key; ?>" >
  <input name="deal_value" type="hidden" value="<?php echo $payment->deal_value; ?>" >
  <input name="amount" id="PL_AMOUNT"  type="hidden" value="<?php echo $payment->deal_value; ?>" >
  <input name="p_referral_amount" id="PL_REFERRAL" value="0" type="hidden">
  <?php if($this->uri->segment(2) == "payment_details_friend"){ ?>
  <div class="payment_form_block clearfix">
                <h3 class="type_form_title"><?php echo $this->Lang['FRI_INFO']; ?></h3>
			<div class="payment_form_section">
			<div class="payment_form">
							<ul>
								<li>
									<label> <?php echo $this->Lang['FRI_NAME']; ?> :<span class="form_star">*</span></label>
									<div class="fullname"><input type="text" value=""  AUTOCOMPLETE="OFF" name="friend_name" class="required" placeholder="<?php echo $this->Lang['ENTER_FRI_NAME']; ?>" autofocus /></div>
									<em>
            <?php if(isset($this->form_error['friend_name'])){ echo $this->form_error["friend_name"]; }?>
            </em>
								</li>
								<li>
									<label><?php echo $this->Lang['FRI_EMAIL']; ?> :<span class="form_star">*</span></label>
									<div class="fullname"><input type="text" value="" AUTOCOMPLETE="OFF" name="friend_email" class="required" placeholder="<?php echo $this->Lang['ENTER_FRI_EMAIL']; ?>"/></div>
									<em>
            <?php if(isset($this->form_error['friend_email'])){ echo $this->form_error["friend_email"]; }?>
            </em>
								</li>
						</ul>
				    </div>
				</div>
  </div>
                <input name="friend_gift"  value="1" type="hidden">

  <?php } else {?>
          <input name="friend_name"  type="hidden" value="xxxyyy" >
          <input name="friend_email"   type="hidden" value="xxxyyy@zzz.com" >
          <input name="friend_gift"  value="0" type="hidden">

  <?php } ?>
    <?php /*    <div class="personal_info_panel">
                                            <p class="per-info-heading"><?php echo $this->Lang['SHIPP_INFO2']; ?></p>
                                            <div class="per-info-section">
                                                <div class="contact_form1">
                                                    <ul>
                                                       <li>
												<label><?php echo $this->Lang['NAME']; ?> :<span class="form_star">*</span></label>
												<div class="fullname"><input name="shipping_name" tabindex="1" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" value="" class="required" maxlength="256"/></div>
											</li>
											
											<li>
												<label><?php echo $this->Lang['ADDR2']; ?> :<span class="form_star">*</span> </label>
												<div class="fullname"><input name="address2" tabindex="3" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" value="" size="40" class="required" maxlength="256"/></div>
											</li>
											
											
											
											<li>
												<label><?php echo $this->Lang['SEL_CITY']; ?> :<span class="form_star">*</span></label>
												<div class="fullname">
												<select name="city" tabindex="5">
                                                <?php $cityid = $this->city_id;
                                                if(isset($this->current_cityid)){ $cityid = $this->current_cityid;}
                                                $cityURL = "";
                                                foreach($this->all_city_list as $CData){ if($CData->city_id == $cityid){ $cityURL = $CData->city_url.".html";?>
                                                <option value="<?php echo $CData->city_id; ?>"><?php echo ucfirst($CData->city_name); ?></option>
                                                <?php 	}   }
                                                foreach($this->all_city_list as $CityL){ ?>
                                                <option <?php if($CityL->city_url==$this->input->get('city')){ echo 'Selected="true"'; } ?> value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
                                                <?php } ?>
                                                </select>
												
												</div>
												
											</li>
											
											<li>
												<label><?php echo $this->Lang['POSTAL_CODE']; ?> :<span class="form_star">*</span></label>
												<div class="fullname"><input name="postal_code" tabindex="7" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>" type="text" value="" class="required number" maxlength="256"/></div>
											</li>
											
                                                    </ul>  
                            
													<div class="complete-order-button" id="submit">
                                                        <div class="ora_left">
                                                             <div class="ora_right">
																 <div class="ora_mid2">
																	<input type="submit"  tabindex="9" value="<?php echo $this->Lang['COMP_ODR']; ?>" title="<?php echo $this->Lang['COMP_ODR']; ?>" />
																 </div>
															 </div>
                                                        </div>  
                                                    </div>
                                                    
                                                    <div class="payment_terms_outer">
														<p class="terms-conditons-text" id="terms1"> <span class="fl font_myriad_pro"><?php echo $this->Lang['BY_CLICK']; ?> </span> <a href="<?php echo PATH;?>terms-and-conditions.php" title="<?php echo $this->Lang['TEMRS']; ?>" tabindex="10" class="font_myriad_pro mt5"><?php echo $this->Lang['TEMRS']; ?>.</a></p>
													</div>



                                                </div>

                                                <div class="contact_form">
                                                    <ul>
                                                       <li>
												<label><?php echo $this->Lang['ADDR1']; ?> :<span class="form_star">*</span></label>
												<div class="fullname"><input name="adderss1"  tabindex="2" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" value="" class="required" maxlength="256"/></div>
											</li>
											
											<li>
												<label><?php echo $this->Lang['STATE']; ?> :<span class="form_star">*</span> </label>
												<div class="fullname"><input name="state" tabindex="4" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_STATE']; ?>" type="text" value="" size="40" class="required" maxlength="256"/></div>
											</li>
														
											<li>
												<label><?php echo $this->Lang['COUNTRY']; ?> :<span class="form_star">*</span></label>
												<div class="fullname">
												<select name="country" tabindex="6">
												<?php foreach($this->all_country_list as $countryL){ ?>
                                                <option <?php if($countryL->country_url==$this->input->get('country')){ echo 'Selected="true"'; } ?> value="<?php echo $countryL->country_name; ?>"><?php echo ucfirst($countryL->country_name); ?></option>
                                                <?php } ?>
                                                </select>
												
											</li>
											
											
											<li>
												<label><?php echo $this->Lang['PHONE']; ?> :<span class="form_star">*</span></label>
												<div class="fullname"><input name="phone" tabindex="8" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>" type="text" value="" class="required number" maxlength="18"/></div>
											</li>
                                                    </ul>
                                                </div>
                                                </div>
                                                </div>
                                                </div> */ ?>

                                                 <div class="personal_info_panel">
                                                    <div class="buy_it complete_order_button" id="submit">                                                        
                                                        <input type="submit"  value="<?php echo $this->Lang['COMP_ODR']; ?>" tabindex="1" title="<?php echo $this->Lang['COMP_ODR']; ?>" />																 
                                                    </div>
                                                    <?php if(count($this->cms_tc) > 0){ ?>
													<div class="payment_terms_outer">
														<p class="terms-conditons-text" id="terms1"> <span class="fl font_myriad_pro"><?php echo $this->Lang['BY_CLICK']; ?> </span> <a onclick="show_dis_tc();" title="<?php echo $this->Lang['TEMRS']; ?>" tabindex="2" class="font_myriad_pro mt5"><?php echo $this->Lang['TEMRS']; ?>.</a></p>
													</div>
													<?php } ?>
												</div>
												
        
                          
                        </form>
<?php } ?>

