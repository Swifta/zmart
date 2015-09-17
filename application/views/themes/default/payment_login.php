<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript"> 
        $(document).ready(function(){  
        $('.cancel_login').hide();
        $('.what_happens').show();
        $('.what_buygift').show();
        $('.can_change').show();
        $('#down1').hide();
        $('#down2').hide();
        $('#down3').hide();
        });
</script>

<script type="text/javascript"> 
        	$(document).keyup(function(e) { 
        if (e.keyCode == 27) { // esc keycode
            $('div#show').hide();
            $('div#show_tc').hide();
			$('#fade').css({'visibility' : 'hidden'});
	  	        //location.reload();
		return false;
        }
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
 <div class="contianer_outer">
            <div class="contianer_inner">
                <div class="contianer">
<div class="bread_crumb">
                        <ul>
                            <li><p><a href="<?php echo PATH;?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                            <li><p><?php echo $this->Lang["ORDER_DETAILS"]; ?></p></li>
                        </ul>
                    </div>
                    <!--content start-->                                                
                        <div class="payouter_block">
                            <div class="payleft_block">
                            <div class="payouter_block pay_br" style="margin:0;">
                                  <?php /*  <h2 class="inner_commen_title"><?php echo $this->Lang["ORDER_DETAILS"]; ?></h2>    */ ?>
                                <div class="cart_table clearfix"> 
                                
                                    <table class="mcart_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0">
                                        <thead class="pay_titlebg">
                                            <tr>                                            
                                                <th width="100" align="left"><?php echo $this->Lang["DESC"]; ?></th>                                                                                       
                                                <th width="100" align="left"><?php echo $this->Lang["QUAN"]; ?></th>
                                                <th width="20" align="left"></th>
                                                <th width="100" align="left"><?php echo $this->Lang["PRI"]; ?></th>						
                                                <th width="20" align="left"></th>
                                                <th width="100" align="left"><?php echo $this->Lang["TOTAL"]; ?></th>                                            
                                            </tr>
                                        </thead>
                                
					<?php  foreach($this->deals_payment_deatils as $payment) {  ?>
                                                                            
                                        <tr>
                                            <td><?php echo $payment->deal_title; ?></td>
                                            <td>
                                                <div class="quantity_bx quantity_bx_row">
                                                <div class="lessthen">
                                                    <a class="less_min" style="cursor:pointer;" id="QtyDown" onclick="DownTotal()" title="">-</a>
                                                </div>
                                                <div class="lessthen1">
                                                   <input name="QTY" id="QTY" value="1" readonly="readonly" type="text" rel="20">
                                                </div>
                                                <div class="greaterthen">
                                                    <a class="plus" style="cursor:pointer;" id="QtyUp" onclick="UpTotal()" title="">+</a>
                                                </div>
                                                </div>
                                            </td>
                                            <td>x</td>
                                                            <script>
            function UpTotal()
            {
                    if($('#QTY').val()!=<?php echo $payment->user_limit_quantity; ?>) {
                            var plus_amount = parseInt($('#QTY').val()) + 1;
                            $('#QTY').val(plus_amount); 
                            var total_amount = <?php echo $payment->deal_value; ?>*plus_amount;
                            if(total_amount!="0") {
                                    $('#amount').text(total_amount);
                                    $('#oldamount').text(total_amount);
                            }
                            else {
                                    if(val!="") {
                                    $('#amount').text(1*<?php echo $payment->deal_value; ?>);
                                    $('#oldamount').text(1*<?php echo $payment->deal_value; ?>);
                                    } else {
                                            $('#amount').text('0');
                                            $('#oldamount').text('0');
                                    }
                            }
                    }

            }

            function DownTotal()
            {
                    if($('#QTY').val()!=1) {
                            var plus_amount = parseInt($('#QTY').val()) - 1;
                            $('#QTY').val(plus_amount); 
                            var total_amount = <?php echo $payment->deal_value; ?>*plus_amount;
                            if(total_amount!="0") {
                                    $('#amount').text(total_amount);
                                    $('#oldamount').text(total_amount);
                            }
                            else {
                                    if(val!="") {
                                    $('#amount').text(1*<?php echo $payment->deal_value; ?>);
                                    $('#oldamount').text(1*<?php echo $payment->deal_value; ?>);
                                    } else {
                                            $('#amount').text('0');
                                            $('#oldamount').text('0');
                                    }
                            }
                    }
            }

            </script>

                                            <td><?php echo CURRENCY_SYMBOL.$payment->deal_value; ?></td>
                                            <td>=</td>
                                            <td><?php echo CURRENCY_SYMBOL; ?><span id="amount"><?php echo $payment->deal_value; ?></span></td>
                                        </tr>
                                        <tfoot>
                                            <tr>                                                
                                                <td colspan="4" align="right">Total to Pay</td>    
                                                <td>=</td>
                                                <td id="balance">
                                                     <p><?php echo CURRENCY_SYMBOL; ?><span id="oldamount"><?php echo $payment->deal_value; ?></span></p>
                                                  </td>
                                            </tr>
                                        </tfoot>
                                    </table>                                
                            </div>                                
                                
	<?php }?>

                                  




                            </div>
                            <div class="payouter_block pay_br">
                        <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang["ACC_INFO"]; ?></h3>	
                        <div class="p_inner_block">
                    <div class="befor_login">                                                                          
                                      <div class="payment_login_form clearfix">                                                                                                            
                                          <div class="payment_login_text">
                                              <p><?php echo $this->Lang['ALREADY_ACC']; ?></p>
                                              <p><?php echo $this->Lang['PURCHACED_GR']; ?></p>
                                          </div>                                     
                                          <a class="buy_it pament_b_sign" onclick="return SimilarDeals();" id="SimilarDeals"  title="<?php echo $this->Lang['SIGN_IN']; ?>"><?php echo $this->Lang['LOGIN']; ?></a>
                                      </div>															
                                  </div>
                                  <div class="cancel_login">                                      
                                      <div class="payment_login_form clearfix">
                                          <div class="signup_form_block">
                                              <form method="post" id="commentForm_deals13" action="<?php echo PATH; ?>payment/login">                                            
                                                  <?php foreach ($this->deals_payment_deatils as $payment) { ?>
                                                      <input name="dealid" type="hidden" value="<?php echo $payment->deal_key; ?>" />
                                                      <input name="url" type="hidden" value="<?php echo $payment->url_title; ?>"/>
                                                  <?php } ?>                                                    
                                                  <ul>
                                                      <li>
                                                          <label><?php echo $this->Lang["EMAIL_F"]; ?>:<span class="form_star">*</span></label>
                                                          <div class="fullname"> <input tabindex="10" name="email" placeholder="<?php echo $this->Lang['ENTER_EMAIL']; ?>" type="text"  class="required"/></div>
                                                      </li>                                                    
                                                      <li>
                                                          <label><?php echo $this->Lang['PASSWORD']; ?>:<span class="form_star">*</span></label>
                                                          <div class="fullname"><input name="password" tabindex="11" placeholder="<?php echo $this->Lang['ENTER_PASS']; ?>" type="password" class="required" /></div>
                                                          <p><a class="forget_link" tabindex="14" onclick="showforgotpassword();" style="cursor:pointer;" title="<?php echo $this->Lang['FORGOT_PASS']; ?>"><?php echo $this->Lang['FORGOT_PASS']; ?></a></p>
                                                      </li>   
                                                      <li>        
                                                          <label>&nbsp;</label>
                                                          <input class="sign_submit" tabindex="12" name="Submit" type="submit" value="<?php echo $this->Lang['LOGIN']; ?>" />                                                                    
                                                          <a  class="sign_cancel" tabindex="13" onclick="return SimilarProducts();"  id="SimilarProducts"  ><?php echo $this->Lang['CANCEL']; ?></a>                                                                                                                                
                                                      </li> 
                                                  </ul>
                                                        
                                              </form>
                                          </div>
                                      </div>	                                
                                  </div>

                                  <div class="payment_form_block clearfix">
                                    
                                    
                                      <h3 class="type_form_title">Personal Information</h3>                                      
                                          <form method="post" id="commentForm_deals12" action="<?php echo PATH; ?>payment/signup_user">
                                              
                                                  <div class="payment_form_section">
                                                      
                                                  <?php foreach ($this->deals_payment_deatils as $payment) { ?>
                                                      <input name="deal_key" type="hidden" value="<?php echo $payment->deal_key; ?>" size="40"/>
                                                      <input name="url_title" type="hidden" value="<?php echo $payment->url_title; ?>" size="40"/>
                                                  <?php } ?>
                                                  <div class="payment_form">
                                                      <ul>
                                                          <li>
                                                              <label><?php echo $this->Lang["NAME"]; ?>:<span class="form_star">*</span></label>
                                                              <div class="fullname"><input autofocus tabindex="1" name="f_name" size="40" maxlength="20"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" value="<?php if (!isset($this->form_error['f_name']) && isset($this->userPost['f_name'])) {
                                                      echo $this->userPost['f_name'];
                                                  } ?>" class="required" /></div><em>
<?php if (isset($this->form_error['f_name'])) {
    echo $this->form_error["f_name"];
} ?>
                                                              </em>
                                                          </li>
                                                          <li>
                                                              <label><?php echo $this->Lang['EMAIL_F']; ?>:<span class="form_star">*</span></label>
                                                              <div class="fullname"><input name="email" maxlength="64" tabindex="2" placeholder="<?php echo $this->Lang['ENTER_EMAIL']; ?>" type="text" value="<?php if (!isset($this->form_error['email']) && isset($this->userPost['email'])) {
    echo $this->userPost['email'];
} else if (isset($this->email)) {
    echo $this->email;
} ?>" size="40" class="required"  /></div>
                                                              <em>
                                                          <?php if (isset($this->form_error['email'])) {
                                                              echo $this->form_error["email"];
                                                          } ?>
                                                              </em>
                                                          </li>
                                                          <li>
                                                              <label><?php echo $this->Lang['PASSWORD']; ?>:<span class="form_star">*</span></label>
                                                              <div class="fullname"><input name="password" maxlength="15" tabindex="3" placeholder="<?php echo $this->Lang['ENTER_PASS']; ?>" type="password" class="required"  value="<?php if (!isset($this->form_error['password']) && isset($this->userPost['password'])) {
                                                                          echo $this->userPost['password'];
                                                                      } ?>" size="40"/></div>
                                                              <em>
                                                                      <?php if (isset($this->form_error['password'])) {
                                                                          echo $this->form_error["password"];
                                                                      } ?>
                                                              </em>
                                                          </li>
                                                          
                                                           <li>
                                                              <label><?php echo $this->Lang['CPASSWORD']; ?>:<span class="form_star">*</span></label>
                                                              <div class="fullname"><input name="cpassword" maxlength="15" tabindex="4" placeholder="<?php echo $this->Lang['ENTER_CPASS']; ?>" type="password" class="required"  value="<?php if (!isset($this->form_error['cpassword']) && isset($this->userPost['cpassword'])) {

                                                                          echo $this->userPost['cpassword'];
                                                                      } ?>" size="40"/></div>
                                                              <em>
                                                                      <?php if (isset($this->form_error['cpassword'])) {
                                                                          echo $this->form_error["cpassword"];
                                                                      } ?>
                                                              </em>
                                                          </li>
                                                               <li>
                                <label><?php echo $this->Lang['SEL_COUNTRY'];?>:<span class="form_star">*</span></label>
                                <div class="fullname">
                                    <select name="country" tabindex="5" onchange="return city_change_merchant(this.value);" class="required">
                                            <option value=""><?php echo $this->Lang['SELECT_Y_COUNTRY']; ?></option>
                                           <?php foreach ($this->all_country_list as $c) { ?>
                                             <option  title="<?php echo $c->country_name; ?>" value="<?php echo $c->country_id; ?>" ><?php echo $c->country_name; ?></option>
    <?php } ?>
                                    </select>
                                     <em>
                                                                      <?php if (isset($this->form_error['country'])) {
                                                                          echo $this->form_error["country"];
                                                                      } ?>
                                                              </em>
                                </div>
                            

                            </li>            
                                                                           
                                                                                                                                            
                                                        <li>
                                                        <label><?php echo $this->Lang['SEL_CITY']; ?>:<span class="form_star">*</span></label>
                                                        <div class="fullname">
                                                        <select name="city" tabindex="6" id="CitySD"  class="required">
                                                        <option value=""><?php echo $this->Lang['COUNTRY_FIRST']; ?></option>
                                                        
                                                        </select>
                                                        <em>
                                                                      <?php if (isset($this->form_error['city'])) {
                                                                          echo $this->form_error["city"];
                                                                      } ?>
                                                              </em>
                                                        </div>
                                                         <div class="hideerror" id="city_validation">This Field Is Required.</div> 
                                                        </li>
                                                      </ul>
                                                    <?php if(count($this->cms_tc) > 0){ ?>
                                                      <div class="payment_terms_outer">
                                                          <p  id="terms1" class="terms-conditons-text">
                                                              <span class="fl font_myriad_pro"><input type="checkbox" tabindex="7" name="terms" value="terms" class="required"><?php echo $this->Lang['BY_CLICK']; ?> </span>
                                                              <a class="font_myriad_pro mt5" tabindex="8" title="<?php echo $this->Lang['TERMS_COND']; ?>" onclick="show_dis_tc();" ><?php echo $this->Lang['TERMS_COND']; ?>.</a>
                                                          </p>
                                                          <em></em>
                                                      </div>
                                                      <?php } ?>
                                                        <div class="buy_it complete_order_button">                                                    
                                                          <input name="Submit" tabindex="9" type="submit" value="<?php echo $this->Lang['COMP_ODR']; ?>" />
                                                      </div>
                                                      </form>
                                                  </div>
                                             
                                              </div>  
                                          </form>   
                                  </div>
                    </div>
                </div>
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
                
                            <div class="pay_br payright_block">
			
				<div class="payment-faq-container">
					<h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['PAY_MEN']; ?></h3>				
			<div class="faq-content2">
						<div class="faq-content-heading br_nn" onclick="return WhatHappens();">
													
							<div class="faq-content-heading-left active_arrw cursor" id="right1">
							<a><?php echo $this->Lang['WAT_HAPP']; ?></a>
							</div>
							<div class="faq-content-heading-left cursor" id="down1">
							<a><?php echo $this->Lang['WAT_HAPP']; ?></a>
							</div>
						</div>
					     <div class="what_happens">
						<div class="faq-content-text">
						    
							<p><?php echo $this->Lang['WHILE_BUY_A_PRODUCT']; ?></p>
						</div>
						</div>
					</div>
					<div class="faq-content2">
						<div class="faq-content-heading" onclick="return Whatbuygift();">
							
							<div class="faq-content-heading-left active_arrw cursor" id="right2">
							<a><?php echo $this->Lang['DO_I_NEED']; ?></a>
							</div>
							<div class="faq-content-heading-left cursor" id="down2">
							<a><?php echo $this->Lang['DO_I_NEED']; ?></a>
							</div>
						</div>
						  <div class="what_buygift">  
						<div class="faq-content-text">
							<p><?php echo $this->Lang['ITS_QUITE_OPTIONAL']; ?></p>
						</div>
						</div>
					</div>
					<div class="faq-content2">
						<div class="faq-content-heading" onclick="return CanChange();">
							<div class="faq-content-heading-left active_arrw cursor" id="right3">
							<a><?php echo $this->Lang['MAY_I_USE']; ?></a>
							</div>
							<div class="faq-content-heading-left cursor" id="down3">
							<a><?php echo $this->Lang['MAY_I_USE']; ?></a>
							</div>
						</div>
						<div class="can_change">
						<div class="faq-content-text">
							<p><?php echo $this->Lang['OBVIOUSLY_YES']; ?></p>
						</div>
						</div>
					</div>
				</div>
			</div>
                        </div>
                    
                        <!--div class="payment-login-deals-right></div-->
			          
        </div>
                      
                    <!--Blog content ends-->
                </div>
            </div>
        
        </div>
<script>
$(document).ready(function(){
   $('.hideerror').hide();
$("#commentForm_deals12").validate({ 
	messages: {
		
			f_name: {
			   required: "<?php echo $this->Lang['PLS_ENT_NAM']; ?>"                         
		   },
			password: {
			   required: "<?php echo $this->Lang['PLS_ENT_PASS']; ?>"                         
		   },
		   cpassword: {
			   required: "<?php echo $this->Lang['PLS_ENT_CPASS']; ?>"                      
		   },
		   country: {
			   required: "<?php echo $this->Lang['PLS_SEL_COUNTRY']; ?>"                         
		   },
		   city: {
			   required: "<?php echo $this->Lang['PLS_SEL_COUNTRY_FIR']; ?>"                         
		   },
		   terms: {
		       required:"<?php echo $this->Lang['PLEASE_SELECT_TERMS']; ?>"
                },
		   	email: {
			   required: "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>", 
			   email : "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>"                             
		   },
    },
 submitHandler: function(form) {
                if (document.getElementById('CitySD').value == ' ') { 
                        $('.hideerror').show();
                        $('div#submit').show();
                        return false; 
                }    else {
                $('div#submit').hide();
                form.submit();
                }
            }
});

$("#commentForm_deals13").validate({ 
	messages: {
		       password: {
			   required: "<?php echo $this->Lang['PLS_ENT_PASS']; ?>"                         
		   },
		   	email: {
			   required: "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>", 
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

