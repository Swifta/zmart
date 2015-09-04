<script type="text/javascript"> 
$(document).ready(function(){  

                        	$(document).keyup(function(e) { 
        if (e.keyCode == 27) { // esc keycode
            $('div#show').hide();
            $('div#show_tc').hide();
			$('#fade').css({'visibility' : 'hidden'});
	  	        //location.reload();
		
		return false;
        }
    });
    
        <?php if ($this->paypal_setting) { ?> 
        $('.cancel_login').hide();
        <?php } else { ?>
        $('.befor_login').hide();
        $('.cancel_login').show();
        <?php } ?>
        $('.AuthorizeNet_pay').hide();
        $('.cod_pay').hide();
        $('.no_paypal').hide();
});
</script>
<script type="text/javascript"> 
    $('.cancel_login').hide();
    function SimilarDeals() {
	$('.error').html('');
        $('.cancel_login').show();
        $('.befor_login').hide();
        $('.AuthorizeNet_pay').hide();
        $('.cod_pay').hide();
        $('.hideerror').hide();
        $('.pay_later').hide();
    }
    function SimilarProducts() {
	$('.error').html('');
        $('.befor_login').show();
        $('.cancel_login').hide();
        $('.AuthorizeNet_pay').hide();
        $('.cod_pay').hide();
        $('.hideerror').hide();
        $('.pay_later').hide();
    }
    function Authorize() {
	$('.error').html('');
        $('.befor_login').hide();
        $('.cancel_login').hide();
        $('.AuthorizeNet_pay').show();
        $('.cod_pay').hide();
        $('.hideerror').hide();
        $('.pay_later').hide();
    }
     function COD() {
	$('.error').html('');
        $('.befor_login').hide();
        $('.cancel_login').hide();
        $('.AuthorizeNet_pay').hide();
        $('.cod_pay').show();
        $('.hideerror').hide();
        $('.pay_later').hide();
    }
    function Pay_Later() {
		$('.error').html('');
        $('.befor_login').hide();
        $('.cancel_login').hide();
        $('.AuthorizeNet_pay').hide();
        $('.cod_pay').hide();
        $('.hideerror').hide();
        $('.pay_later').show();
    }
</script>
<SCRIPT language=Javascript>
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</SCRIPT>
<script type="text/javascript"> 
        $(document).ready(function(){  
        $('.cancel_login').hide();
        $('.what_happens').hide();
        $('.what_buygift').hide();
        $('.can_change').hide();
        $('#down1').hide();
        $('#down2').hide();
        $('#down3').hide();
        });
</script>

<script type="text/javascript"> 
        function WhatHappens() {
                $('.what_happens').slideToggle(300);
                $('#down1').slideToggle(300);
                $('#right1').slideToggle(300);
                
        }
        function Whatbuygift() {
                 $('.what_buygift').slideToggle(300);
                 $('#down2').slideToggle(300);
                $('#right2').slideToggle(300);
        }
        function CanChange() {
                $('.can_change').slideToggle(300);
                $('#down3').slideToggle(300);
                $('#right3').slideToggle(300);
        }
        
        function show_dis_auction()
		{ 
			$("form#submit_changes").validate({
				submitHandler: function(form) {  // How to repace this? 
                                        if (document.getElementById('CitySD').value == ' ') { 
                                                $('#city_validation').html('This Field Is Required.');
                                                return false; 
                                        }       
					$.post('<?php echo PATH;?>products/update_shipping_address/', $("form#submit_changes").serialize(), function(data) { 
						$('#new_shipping_address').html(data);
						$('#city_validation').html('');
                                                $('#fade').css({'visibility' : 'hidden'});
						$('div#show').hide();
					}); 
				}
				});
			         $('#fade').css({'visibility' : 'visible'});
				$('div#show').show();
		}	
		
		function hide_shipping_addr()
		{
			$('div#show').hide();
                        $('#fade').css({'visibility' : 'hidden'});
		}
		
		function show_dis_tc()
		{
			        $('#fade').css({'visibility' : 'visible'});
				$('div#show_tc').show();
		}	
		
		function hide_shipping_addr_tc()
		{
			$('div#show_tc').hide();
                        $('#fade').css({'visibility' : 'hidden'});
		}
		
</script>
<!--end-->
<div class="contianer_outer1">
    <div class="contianer_inner">
        <div class="contianer">
						<div class="bread_crumb">
				<ul>
					<li><p><a title="<?php echo $this->Lang['HOME']; ?>" href="<?php echo PATH; ?>" ><?php echo $this->Lang['HOME']; ?></a></p></li>
					<li><p><?php echo $this->Lang['YOUR_PUR']; ?></p></li>
				</ul>
			</div>
		
            <!--content start-->
            <div class="payouter_block"  id="payment_credit_card">
                <div class="payleft_block pay_br">                
                    <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['TYPE_PAY']; ?></h3>
                    <div class="p_inner_block">
                    <div class="payment_select"> 
                        <?php if ($this->paypal_setting) { ?>
                            <div class="payment_sel_lft"><a onclick="return SimilarProducts();" id="SimilarProducts"  > <input id="paypal_radio" type="radio" name="name" checked /></a>  <p><?php echo $this->Lang['PAYPAL']; ?></p></div>
                        <?php } ?>
                        <?php if ($this->credit_card_setting) { ?>
                            <div class="payment_sel_lft"><a onclick="return SimilarDeals();" id="SimilarDeals"  > <input type="radio" name="name"  <?php if ($this->paypal_setting) {
                        } else { ?> checked <?php } ?> /></a> <p><?php echo $this->Lang['PAYPAL_CREDIT']; ?></p></div>
                        <?php } ?>
                        <?php if ($this->authorize_setting) { ?>
                            <div class="payment_sel_lft"> <a onclick="return Authorize();" id="Authorize"  > <input type="radio" name="name"  /></a> <p><?php echo $this->Lang['AUTHORIZE']; ?></p></div>
						<?php } ?>

						<?php if ($this->cash_on_delivery_setting) { ?>
                            <div class="payment_sel_lft"> <a onclick="return COD();" id="COD"  > <input type="radio" name="name"  /></a> <p><?php echo $this->Lang['CASH_ON_DEL']; ?></p></div>
						<?php } ?>
						
						<?php if ($this->pay_later_setting) { ?>
                            <div class="payment_sel_lft"> <a onclick="return Pay_Later();" id="pay_later"  > <input type="radio" name="name"  /></a> <p><?php echo $this->Lang['PAY_LATER']; ?></p></div>
						<?php } ?>

						
                    </div>                
				<?php $referral_balance = "0"; ?>
                <?php foreach ($this->deals_payment_deatils as $payment) { ?>
                    <div class="content_auction_mid">
                        <div class="cont_auc_lft">
                            <?php if (file_exists(DOCROOT . 'images/auction/1000_800/' . $payment->deal_key . '_1' . '.png')) { ?>
                                <a href="<?php echo PATH . $payment->store_url_title.'/auction/' . $payment->deal_key . '/' . $payment->url_title . '.html'; ?>" title="<?php echo $payment->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/auction/1000_800/' . $payment->deal_key . '_1' . '.png'; ?>&w=<?php echo DEAL_THUMB_WIDTH; ?>&h=<?php echo DEAL_THUMB_HEIGHT; ?>"  alt="<?php echo $payment->deal_title; ?>" title="<?php echo $payment->deal_title; ?>" >&nbsp;</a>
                            <?php } else { ?>
                                <a href="<?php echo PATH . $payment->store_url_title.'/auction/' . $payment->deal_key . '/' . $payment->url_title . '.html'; ?>" title="<?php echo $payment->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=<?php echo DEAL_THUMB_WIDTH; ?>&h=<?php echo DEAL_THUMB_HEIGHT; ?>"  alt="<?php echo $payment->deal_title; ?>" title="<?php echo $payment->deal_title; ?>" >&nbsp;</a>  
							<?php } ?> 
                        </div>
                        <div class="cont_auc_rgt">
                            <ul>
								
                                <li>
                                    <label><?php echo $this->Lang['DESC']; ?>   </label>
                                    <b>:</b>
                                    <span><?php echo $payment->deal_title; ?></span>
                                </li>
                                <li>
                                    <label><?php echo $this->Lang['SHIP_FEE']; ?>   </label>
                                    <b>:</b>
                                    <p><?php echo CURRENCY_SYMBOL . $payment->shipping_fee; ?> </p>
                                </li>
                                <li>
                                    <label><?php echo $this->Lang['BID_AMO']; ?>    </label>
                                    <b>:</b>
                                    <p><?php echo CURRENCY_SYMBOL . $this->current_bid_value; ?> </p>
                                </li>
                                <li>
                                    <label><?php echo $this->Lang['TOTAL']; ?>     </label>
                                    <b>:</b>
                                    <span id="amount"><?php echo CURRENCY_SYMBOL; ?><?php echo $this->current_bid_value + $payment->shipping_fee; ?></span>
                                    <INPUT TYPE="hidden"  id="ref_deal_id"  value="<?php echo $payment->deal_id; ?>">
                                </li>
                            </ul>
                        </div>
                        <div style="display:none" id="oldamount"><?php echo $this->current_bid_value; ?></div>
                   
               </div>    
                    <?php } ?>
  
                </div>
                </div>
         <div class="payright_block">                             

					<?php // for shipping address start  ?>
					 <div class="pay_br right_shipping_address">
                           
                                <h3 class="paybr_title pay_titlebg shipping_edit_title clearfix">
                                    <span><?php echo $this->Lang['SHIP_ADD']; ?></span>
                                     <?php if (count($this->shipping_address) > 0) { ?>
                                    <a  onclick="show_dis_auction();"  class="saddress_edit" title="<?php echo $this->Lang['EDIT']; ?>"><?php echo $this->Lang['EDIT']; ?></a>
                                    <?php } else { ?>
                                <a href="<?php echo PATH; ?>users/my-shipping-address.html" title="<?php echo $this->Lang['EDIT']; ?>" class="saddress_edit"><?php echo $this->Lang['EDIT']; ?></a>        
                                <?php } ?>
                                </h3>  
                                 <?php if(count($this->shipping_address) > 0){ ?>
                                <div id="new_shipping_address" > 
                                <?php common::shipping_address(); ?>	
                                </div>								
				<?php } ?>
					</div>
				<?php // for shipping address end  ?>

                        </div>
				</div>
				
				
				
				
				 <div id="show" class="popup_block5" style="display:none;">                                                                   
                                <?php foreach($this->shipping_address as $s) { ?> 
                                <form method="post" id="submit_changes">
                                <div class="sign_up_outer"> 
                                       <a onclick="hide_shipping_addr()" class="close2" title="close" id="close" style="cursor:pointer;">&nbsp;</a>
                                                <div class="signup_content clearfix">
                                                    <h2 class="signup_title shipping_poptitle"><?php echo $this->Lang['SHIP_ADDR']; ?></h2>
                                                    <div class="payment_form payment_shipping_form">
                                                <ul class="clearfix">
                                                                <li>
                                                                    <label><?php echo $this->Lang['NAME']; ?>  <span> * </span></label>
                                                                    <div class="fullname">                                                                            
                                                                        <input name="firstname" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" class="required" maxlength="256" value="<?php echo $s->ship_name; ?>" autofocus />
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <label><?php echo $this->Lang['ADDR1']; ?> <span> * </span></label>
                                                                    <div class="fullname">
                                                                        <input  name="address1" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" class="required" maxlength="256" value="<?php echo $s->ship_address1; ?>" />
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                <label><?php echo $this->Lang['ADDR2']; ?> <span> * </span></label>
                                                                <div class="fullname">
                                                                <input name="address2" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" size="40"  maxlength="256" value="<?php echo $s->ship_address2; ?>"/>
                                                                </div>
                                                        </li>

                                                        <li>
                                                                <label><?php echo $this->Lang['COUNTRY']; ?><span> * </span></label>                                    
                                                                <div class="fullname">
                                                                        <select class="select" name="country" onchange="return city_change_merchant(this.value);">
                                                                                <?php foreach ($this->all_country_list as $countryL) { ?>
                                                                                <option <?php if ($countryL->country_id == $s->ship_country) {
                                                                                echo 'Selected="true"';
                                                                                } ?> value="<?php echo $countryL->country_id; ?>"><?php echo ucfirst($countryL->country_name); ?></option>
                                                                                <?php } ?>
                                                                        </select>      
                                                                </div>
                                                        </li>
                                                                                                     
                                                        <li class="frm_clr">
                                                                <label><?php echo $this->Lang['STATE']; ?><span> * </span></label>
                                                                <div class="fullname">
                                                                    <input name="state" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_STATE']; ?>" type="text" size="40" class="required" maxlength="256" value="<?php echo $s->ship_state; ?>" />
                                                                </div>
                                                        </li>
                                                        <li>
                                                                <label><?php echo $this->Lang['SEL_CITY']; ?>  <span> * </span></label>                                        
                                                                <div class="clearfix fullname">
                                                                        <div class="select_box_outer country_select_box">
                                                                        <select name="city" class="select"  id="CitySD">
                                                                        <?php foreach ($this->all_city_list as $CityL) { ?>
                                                                        <option <?php if ($CityL->city_id == $s->ship_city) {
                                                                        echo 'Selected="true"';
                                                                        } ?> value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
                                                                        <?php } ?>
                                                                        </select>
                                                                        <div id="city_validation"> </div>                                 
                                                                        </div>
                                                                </div>  
                                                        </li>           
                                                        
                                                        <li class="frm_clr">
                                                                <label><?php echo $this->Lang['POSTAL_CODE']; ?> <span> * </span></label>
                                                                <div class="fullname">
                                                                    <input  name="zip_code" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>" type="text" class="required number" maxlength="256" value="<?php echo $s->ship_zipcode; ?>"/>
                                                                </div>
                                                        </li>
                                                        <li>
                                                                <label><?php echo $this->Lang['PHONE']; ?><span> * </span></label>
                                                                <div class="fullname">
                                                                <input name="mobile" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>" type="text" class="required number" maxlength="18" value="<?php echo $s->ship_mobileno; ?>" />
                                                                </div>
                                                        </li>
                                                </ul>
                                                        </div>
                                          <input type="submit" value="Update" class="sign_submit" />
                                          <input class="sign_cancel" type="button" value="Cancel" onclick="hide_shipping_addr()" />
                                </div>

                                </div>
                        </form>
                <?php } ?>				
                </div>
                
                
                <?php if(count($this->cms_tc) > 0){ ?>
                       <div id="show_tc" class="popup_block6" style="display:none;">   
                                <div class="sign_up_outer"> 
                                       <a onclick="hide_shipping_addr_tc()" class="close2" title="close" id="close" style="cursor:pointer;">&nbsp;</a>
                                                <div class="signup_content clearfix">
                                                    <h2 class="signup_title shipping_poptitle"><?php echo $this->cms_tc->current()->cms_title; ?></h2>
                                                    <div class="content_abouts">
                        <div class="content_abou_common">                                                                                     
                            <div class="content_abou_text">
				<p><?php echo $this->cms_tc->current()->cms_desc;?></p>
                            </div>
                        </div>  
                    </div>
                   </div>
                </div>				
                </div>
             <?php } ?>
             
            <div class="payouter_block pay_br">                
                    <div class="befor_login">
                            <?php echo new View("themes/" . THEME_NAME . "/paypal/auction_paypal"); ?>
                    </div>
                    <div class="cancel_login">
                                            <?php echo new View("themes/" . THEME_NAME . "/paypal/auction_dodirect_creditcard"); ?>
                    </div>
                     <div class="AuthorizeNet_pay">
                                    <?php echo new View("themes/" . THEME_NAME . "/paypal/auction_Authorize"); ?>

                    </div>
                     <div class="cod_pay">
                    <?php echo new View("themes/" . THEME_NAME . "/paypal/auction_COD"); ?>

                    </div>
                    <div class="pay_later">
                    <?php echo new View("themes/" . THEME_NAME . "/paypal/auction_pay_later"); ?>

                    </div>


                    <script>
                        $(document).ready(function(){
                            $("#commentForm_ref").validate();
                        });
                    </script>
                    <div class="no_paypal">
                        <form name="payment" method="POST" id="commentForm_ref" action="<?php echo PATH; ?>payment/referral_payment">
                            <input name="P_QTY" id="PCR_QTY_VAL" value="1" type="hidden" >
                            <input name="deal_id"  type="hidden" value="<?php echo $payment->deal_id; ?>" >
                            <input name="deal_key" type="hidden" value="<?php echo $payment->deal_key; ?>" >
                            <input name="deal_value" type="hidden" value="<?php echo $this->current_bid_value; ?>" >
                            <input name="amount" id="PCR_AMOUNT"  type="hidden" value="<?php echo $this->current_bid_value; ?>" >
                            <input name="p_referral_amount" id="PCR_REFERRAL" value="0" type="hidden">
                                                <?php if ($this->uri->segment(2) == "payment_details_friend") { ?>
                                <div class="pop_up_1">
                                    <label><?php echo $this->Lang['FRI_NAME']; ?></label>
                                    <div class="text_box_2">
                                        <div class="pur_txt_box">
                                            <input type="text" value="" name="friend_name" class="required" onkeyup="Referralfriend(this.value)"/>
                                        </div>
                                        <em>
                                                                                <?php if (isset($this->form_error['friend_name'])) {
                                                                                        echo $this->form_error["friend_name"];
                                                                                } ?>
                                        </em> 
                                    </div>
                                </div>
                                <div class="pop_up_1">
                                    <label><?php echo $this->Lang['FRI_EMAIL']; ?></label>
                                    <div class="text_box_2">
                                        <div class="pur_txt_box">
                                            <input type="text" value="" name="friend_email" class="required email" onkeyup="Referralfriend(this.value)"/>
                                        </div>
                                        <em>
                                                                                <?php if (isset($this->form_error['friend_email'])) {
                                                                                        echo $this->form_error["friend_email"];
                                                                                } ?>
                                                                        </em> 
                                    </div>
                                </div>
                                <input name="friend_gift"  value="1" type="hidden">
                                                <?php } else { ?>
                                <input name="friend_name"  type="hidden" value="xxxyyy" >
                                <input name="friend_email"   type="hidden" value="xxxyyy@zzz.com" >
                                <input name="friend_gift"  value="0" type="hidden">
                                                <?php } ?>
                    <!--end-->

                    </div>                
            </div>
</div>
</div>
</div>
         </div>     
