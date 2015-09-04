<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

    $('.cancel_login').hide();
    function SimilarDeals() {
        $('.cancel_login').show();
        $('.befor_login').hide();
    }
    function SimilarProducts() {
        $('.befor_login').show();
        $('.cancel_login').hide();
    }

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
    
        function delete_cart(dealid)
        {
                if(dealid){ 
                        window.location.href = Path+"payment_product/cart_remove/product_cart_id"+dealid;
                }
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

</div>
</div>
</div>
<!--end-->
<div class="contianer_outer">
    <div class="contianer_inner">
        <div class="contianer">
        <div class="bread_crumb">
            <ul>
                <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                <?php if($this->session->get('count')>0){ ; ?>
                <li><p><?php echo $this->Lang['PRODUCT_DET']; ?></p></li>
                <?php } else { ?>
                <li><p><?php echo $this->Lang['CART_DET']; ?></p></li>
                <?php } ?>
            </ul>
        </div>        
            <!--content start-->
            <div class="payouter_block"> 
                <div class="payleft_block">
                <div class="payouter_block pay_br" style="margin:0;">
                <!--Blog content starts-->
                                                       
<!--                        <h2 class="inner_commen_title"><?php echo $this->Lang['PRODUCT_DET']; ?></h2>
                            <p class="lp-status-text"><?php echo $this->Lang['YOU_CURRENTLY_HAVE']; ?>
                                <?php $item_count = $this->session->get('count'); ?>
                                <span class="have_count" >
                                    <?php if ($item_count != "" && $item_count != 0) {
                                        echo $item_count;
                                    } else {
                                        echo "0";
                                    } ?>
                                </span>
<?php echo $this->Lang['PRO_SH_CA']; ?>.
                                <span class="continue-shop">
                                    <a href="<?php echo PATH ?>products.html" title="<?php echo $this->Lang['CONTINUE_SHOPPING']; ?>">	<?php echo $this->Lang['CONTINUE_SHOPPING']; ?>
                                    </a>
                                </span>
                            </p>                            -->                
                                <?php
                                $total_amount = "0";
                                $empty = "";
                                foreach ($_SESSION as $key => $value) {
                                    if ((is_string($value)) && ($key == 'product_cart_id' . $value)) {
                                        $this->products = new Products_Model();
                                        $this->get_cart_products = $this->products->get_cart_products($this->session->get($key));
                                        foreach ($this->get_cart_products as $products) {
                                            $empty = "1";
                                            ?>
        <?php
        }
    }
}
?>
                    <div class="cart_table">
	                     

                                
                                        <table class="mcart_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0">                                 
                                        <?php if ($empty) { ?>       
                                            <thead class="pay_titlebg">
                                                <tr id="cart_item_0">                                                        
                                                    <th width="100" align="left"><?php echo $this->Lang['IMAGE']; ?></th>                                                                                                                
                                                    <th width="100" align="left"><?php echo $this->Lang['DESC']; ?></th>                                                                                                                
                                                    <th width="100" align="left"><?php echo $this->Lang['PRI']; ?></th>                                                                                                                
                                                    <th width="100">Remove</th>                                                                                                                
                                                </tr> 
                                            </thead>
                                        <?php } ?>
                                        <?php
                                        $total_amount = "0";
                                        foreach ($_SESSION as $key => $value) {
                                            if ((is_string($value)) && ($key == 'product_cart_id' . $value)) {
                                                $this->products = new Products_Model();
                                                $this->get_cart_products = $this->products->get_cart_products($this->session->get($key));
                                                foreach ($this->get_cart_products as $products) {
                                                    ?>
                                                    <tr id="cart_item_<?php echo $value; ?>">
                                                        <td>
                                                        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { ?>
                                                        <a href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img src="<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png'; ?>"  alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" width="80" height="80"></a>
                                                        <?php } else { ?>
                                                        <a href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" width="80" height="80" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>"></a>
                                                        <?php } ?> 
                                                        </td>                                            
                                                        <td>

                                                            <h4 class="cart_desc_title"><a href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo $products->deal_title; ?></a></h4>
                                                            <p><?php echo text::limit_words(strip_tags($products->deal_description), 12, '&nbsp;'); ?></p>
                                                        </td>
            <?php $total_amount +=$products->deal_value; ?>
                                                        <td><?php echo CURRENCY_SYMBOL . $products->deal_value; ?></td>	

                                                        <td align="center">
                                                    <?php /* for ajax  <a style="cousor:pointer;" onclick="remove_cart_item('<?php echo 'product_cart_id'.$value; ?>')" title="<?php echo $this->Lang['DELETE']; ?>">&nbsp;</a> */ ?>
                                                            <a class="cart_delete" id="prodele_<?php echo $products->deal_id; ?>" onclick="delete_cart('<?php echo $value; ?>');" title="<?php echo $this->Lang['DELETE']; ?>">&nbsp;</a>
                                                            
                                                            <script>
                                                        $('#prodele_<?php echo $products->deal_id; ?>').click(function() {
                                                                $('#prodele_<?php echo $products->deal_id; ?>').hide();
                                                        });
                                                </script>

                                                        </td>                                            
                                                    </tr>

            <?php
        }
    }
}
?>
                                    </table>  
                                           </div>                     
                            <?php /* <input type="hidden" name="item_count" value="<? if ($item_count != "" && $item_count != 0) {
    echo $item_count;
} else {
    echo '0';
} ?>" /> */ ?> 


<?php if ($total_amount != 0) {
    ?>
                            <div class="p_inner_block">
                                <div class="checkout-section clearfix">
                                    <div class="checkout_section_right">
                                        <div class="continue-shop-text"><a href="<?php echo PATH ?>products.html"><?php echo $this->Lang['CONTINUE_SHOPPING']; ?></a></div>
                                        <small><?php echo $this->Lang['OR']; ?></small>
                                        <div class="checkout-button">                                        
                                            <a class="buy_it" <?php if ($this->UserID) { ?>   href="<?php echo PATH ?>cart_checkout.html"  <?php } else { ?> href="javascript:showlogin();" <?php } ?> title="<?php echo $this->Lang['PROCEDURE']; ?>"><?php echo $this->Lang['PROCEDURE']; ?></a>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                    <?php } else { ?> 
                            <?php /* <h2 class="paybr_title pay_titlebg"><?php echo $this->Lang['YOUR_SHOPPING_BAG']; ?></h2> */ ?>
                            <div class="p_inner_block">
                                <div class="content_empt_lft">

                                    <h2><?php echo $this->Lang['YOUR_SHOPPING_BAG']; ?></h2>

                                    <div class="checkout-button">                                        
                                        <a class="buy_it" href="<?php echo PATH ?>products.html"><?php echo $this->Lang['CONTINUE_SHOPPING']; ?></a>
                                    </div>
                                </div>  

                                <div class="content_empt_rgt">
                                    <img alt="logo" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cat_ta_img.png"/>
                                </div> 
                            </div>
           
                          
<?php } ?>
                                 
            </div>  
                <?php if ($total_amount != 0) {
    ?>
    <div class="payouter_block pay_br">    
        <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['ACC_INFO']; ?></h3>
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

                    <div class="cancel_login" id="login" >                                                                
                        <div class="payment_login_form clearfix"> 
                            <div class="signup_form_block">
                                <form method="post" id="commentForm_deals13" action="<?php echo PATH; ?>payment_product/p_login">                                                                                
                                    <ul>
                                        <li>
                                            <label><?php echo $this->Lang['EMAIL']; ?>:<span class="form_star">*</span></label>
                                            <div class="fullname"><input tabindex="10" name="email" maxlength="64" placeholder="<?php echo $this->Lang['ENTER_EMAIL']; ?>" type="text"  class="required " /></div>
                                        </li>                                           
                                        <li>
                                            <label><?php echo $this->Lang['PASSWORD']; ?>:<span class="form_star">*</span></label>
                                            <div class="fullname"><input tabindex="11" name="password"  maxlength="15" placeholder="<?php echo $this->Lang['ENTER_PASS']; ?>" type="password" class="required"/></div>
                                            <p><a class="forget_link" tabindex="14" onclick="showforgotpassword();" style="cursor:pointer;" title="<?php echo $this->Lang['FORGOT_PASS']; ?>"><?php echo $this->Lang['FORGOT_PASS']; ?></a></p>
                                        </li>                                                                                   
                                        <li>  
                                            <label>&nbsp;</label>
                                            <input class="sign_submit" tabindex="12" name="Submit" type="submit" value="<?php echo $this->Lang['LOGIN']; ?>" title="<?php echo $this->Lang['LOGIN']; ?>"/>                                                
                                            <a class="sign_cancel" tabindex="13" title="<?php echo $this->Lang['CANCEL']; ?>" class="cancle" onclick="return SimilarProducts();"  id="SimilarProducts"  ><?php echo $this->Lang['CANCEL']; ?></a>
                                        </li> 
                                    </ul> 
                                </form>  
                            </div>
                        </div>
                    </div>


                    <div class="payment_form_block clearfix">                                
                        <h3 class="type_form_title"><?php echo $this->Lang['PERSONAL_INFO']; ?></h3>                                
                        <form method="post" id="commentForm_deals12"  action="<?php echo PATH; ?>payment_product/p_signup">                            
                                <div class="payment_form_section">

                                    <div class="payment_form">
                                        <ul>
                                            <li>
                                                <label><?php echo $this->Lang['NAME']; ?>:<span class="form_star">*</span></label>
                                                <div class="fullname"><input autofocus tabindex="1" name="f_name" size="40" maxlength="20"  class="required"placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" value="<?php if (!isset($this->form_error['f_name']) && isset($this->userPost['f_name'])) {
    echo $this->userPost['f_name'];
    } ?>" />
                                                    <em><?php if (isset($this->form_error['f_name'])) {
    echo $this->form_error["f_name"];
    } ?></em>
                                                </div>
                                            </li>

                                            <li>
                                                <label><?php echo $this->Lang['EMAIL']; ?>:<span class="form_star">*</span></label>
                                                <div class="fullname"><input name="email" tabindex="2" class="required" maxlength="64" placeholder="<?php echo $this->Lang['ENTER_EMAIL']; ?>" type="text" value="<?php if (!isset($this->form_error['email']) && isset($this->userPost['email'])) {
                                                            echo $this->userPost['email'];
                                                        } else if (isset($this->email)) {
                                                            echo $this->email;
                                                        } ?>" size="40"  /> <em><?php if (isset($this->form_error['email'])) {
                                                            echo $this->form_error["email"];
                                                        } ?> </em></div>
                                            </li>
                                            <li>
                                                              <label><?php echo $this->Lang['PASSWORD']; ?>:<span class="form_star">*</span></label>
                                                              <div class="fullname"><input name="password"  tabindex="3" maxlength="15" placeholder="<?php echo $this->Lang['ENTER_PASS']; ?>" type="password" class="required"  value="<?php if (!isset($this->form_error['password']) && isset($this->userPost['cpassword'])) {
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
                                                              <div class="fullname"><input name="cpassword"  tabindex="4" maxlength="15" placeholder="<?php echo $this->Lang['ENTER_CPASS']; ?>" type="password" class="required"  value="<?php if (!isset($this->form_error['cpassword']) && isset($this->userPost['cpassword'])) {
                                                                          echo $this->userPost['cpassword'];
                                                                      } ?>" size="40"/></div>
                                                              <em>
                                                                      <?php if (isset($this->form_error['cpassword'])) {
                                                                          echo $this->form_error["cpassword"];
                                                                      } ?>
                                                              </em>
                                                          </li>
                                                          <li>
                                <label><?php echo $this->Lang['GENDER']; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
									 <select name="gender" class="required">
										<option value=""><?php echo $this->Lang["SEL_GEN"]; ?></option>
										<option value="1"><?php echo $this->Lang["MALE"]; ?></option>
										<option value="2"><?php echo $this->Lang["FEMALE"]; ?></option>
									 </select>
                                  <em id="gender_error"></em>
                                </div>   
                            </li>
                            <li>
                                <label><?php echo $this->Lang['AGE_RNG']; ?>:<span class="form_star">*</span></label>
                                <div class="fullname">
									<select name="age_range" class="required">
										<option value=""><?php echo $this->Lang['SEL_AGE_RNG']; ?></option>
										<option value="1" ><?php echo $this->Lang["17_BEL"]; ?></option>
										<option value="2"><?php echo $this->Lang["18_25"]; ?></option>
										<option value="3"><?php echo $this->Lang["26_35"]; ?></option>
										<option value="4"><?php echo $this->Lang["36_45"]; ?></option>
										<option value="5"><?php echo $this->Lang["46_65"]; ?></option>
										<option value="6"><?php echo $this->Lang["66_ABV"]; ?></option>
									</select>
                                  <em id="age_range_error"></em>
                                </div>   
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
                                                         <li>
                                <label><?php echo $this->Lang['UNIQ_IDEN'];?>:<span class="form_star"></span></label>
                                <div class="fullname">
                                    <input name="unique_identifier" maxlength="15" placeholder="<?php echo $this->Lang['ENTER_UNIQ_IDEN']; ?>" type="text" value="" />
                                </div>   
                                <label></label>
                            </li>
                                        </ul>
                                        <?php if(count($this->cms_tc) > 0){ ?>
                                        <div class="payment_terms_outer">
                                            <p id="terms1" class="terms-conditons-text">
                                                <span class="fl font_myriad_pro"><input type="checkbox" tabindex="7" name="terms" value="terms" class="required"><?php echo $this->Lang['BY_CLICK']; ?> <a class="font_myriad_pro mt5 fl_none" tabindex="8" title="<?php echo $this->Lang['TERMS_COND']; ?>" onclick="show_dis_tc();"  ><?php echo $this->Lang['TERMS_COND']; ?>.</a></span>
                                                
                                            </p>
                                        </div>
                                        <?php } ?>
                                        <div class="buy_it complete_order_button">                                                    
                                            <input type="submit" tabindex="9" value="<?php echo $this->Lang['COMP_ODR']; ?>" title="<?php echo $this->Lang['COMP_ODR']; ?>" />							
                                        </div>
                                    </div>
                                </div>                            
                                    </form>

                                </div>



                            </div>
                            <!--<p class="terms-conditons-text">By clicking Complete Order I accept the <a href="#" title="Terms & Conditions">Terms and contitions.</a></p>-->

                    
                
        </div>
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
                <div class="pay_br payright_block">
                    <div class="payment-faq-container">
                        <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['PAY_MEN']; ?></h3>

                        <div class="faq-content2 br_nn">
                            <div class="faq-content-heading" onclick="return WhatHappens();">

                                <div class="faq-content-heading-left active_arrw" id="right1">
                                    <a><?php echo $this->Lang['WAT_HAPP']; ?></a>
                                </div>
                                <div class="faq-content-heading-left" id="down1">
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

                                <div class="faq-content-heading-left active_arrw" id="right2">
                                    <a><?php echo $this->Lang['DO_I_NEED']; ?></a>
                                </div>
                                <div class="faq-content-heading-left" id="down2">
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
                                <div class="faq-content-heading-left active_arrw" id="right3">
                                    <a><?php echo $this->Lang['MAY_I_USE']; ?></a>
                                </div>
                                <div class="faq-content-heading-left" id="down3">
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
    </div>  
            
            
            
            <!--content ends-->
        
            
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.hideerror').hide();
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
		   gender: {
			   required: "<?php echo "Please Select the Gender"; ?>"                         
		   },
		   age_range: {
			   required: "<?php echo "Please Select the Age range"; ?>"                         
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
                } else {
                $('div#submit').hide();
                form.submit();
                }
            }
        });

    });
</script>
