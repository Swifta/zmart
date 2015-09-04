<div class="contianer_outer1">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><?php echo $this->Lang['MY_SHIPPING_ADD']; ?></p></li>
                </ul>
            </div>

            <!--content start-->
            <div class="content_abouts">
                <div class="all_mapbg_mid_common">
                    <div class="content_abou_common">
                        <div class="pro_top5">
                            <div class="common_ner_commont1">
                                <div class="common_ner_commont">     

                                    <h2><?php echo $this->Lang['MY_SHIPPING_ADD']; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="all_mapbg_mid">   
                            <div class="myemai_mnu">
                                <div class="top_menu myemail_subbor">
                                    <a class="tab_navicon" href="#" title="Menu">Menu</a>
                                    <ul class="tab_nav">
                                    
                                        <li   >
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-account.html" title="<?php echo $this->Lang['MY_ACC']; ?>"><?php echo $this->Lang['MY_ACC']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        
                                        <li>
                                        <div class="tab_left"></div>
                                        <div class="tab_mid"><a href="<?php echo PATH; ?>wishlist.html" title="<?php echo $this->Lang['MY_WISH']; ?>"><?php echo $this->Lang['MY_WISH']; ?></a></div>
                                        <div class="tab_rgt"></div>
                                    </li>
                                    
                                        <li>
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-coupons.html" title="<?php echo $this->Lang['MY_BUYS']; ?>"><?php echo $this->Lang['MY_BUYS']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <li>
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-referral-list.html" title="<?php echo $this->Lang['MY_REFERAL']; ?>"><?php echo $this->Lang['MY_REFERAL']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        
                                        <li>
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/email-subscribtions.html" title="<?php echo $this->Lang['MY_ELAL_SUB']; ?>"><?php echo $this->Lang['MY_ELAL_SUB']; ?></a></div> 
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <li>
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-winner-list.html" title="<?php echo $this->Lang['WON_AUC']; ?>"><?php echo $this->Lang['WON_AUC']; ?></a></div> 
                                            <div class="tab_rgt"></div>
                                        </li>

                                        <li class="tab_act">
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-shipping-address.html" title="<?php echo $this->Lang['MY_SHIPPING_ADD']; ?>"><?php echo $this->Lang['MY_SHIPPING_ADD']; ?></a></div> 
                                            <div class="tab_rgt"></div>
                                        </li>
                                         <?php  if($this->session->get('user_auto_key')) { ?>
                                        <li>
                                            <div class="tab_left"></div>
                                             <div class="tab_mid"><a href="<?php echo PATH;?>users/my-storecredit-purchase.html" title="<?php echo $this->Lang['STR_CRD_PURCH']; ?>"><?php echo $this->Lang['STR_CRD_PURCH']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <li >
                                            <div class="tab_left"></div>
                                             <div class="tab_mid"><a href="<?php echo PATH;?>users/my-storecredits.html" title="<?php echo $this->Lang['MY_STR_LIST']; ?>"><?php echo $this->Lang["MY_STR_LIST"]; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <?php } ?>
                                    </ul>                                                                
                                </div> 
                            </div>
                        </div>
                        <div class="mybuys_content mybuys_products">                             
                            <?php foreach ($this->user_detail as $u) { ?>
                                <form method="post" class="admin_form" name="edit_users"  >
                                    <div class="payment_form_block clearfix">
                                        <div class="payment_form_section">
                                            <div class="payment_form payment_shipping_form">
                                                <p class="mandarory_txt"><span>*</span> = <?php echo $this->Lang['ALL_MANDATORY']; ?></p>
                                                <ul class="clearfix">                                                    
                                                    <li>
                                                        <label><?php echo $this->Lang['FUL_NAM']; ?><span>*</span></label>
                                                        <div class="fullname">
                                                            <input type="text" name="firstname" maxlength="35"  value="<?php echo $u->ship_name; ?>" placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" autofocus />
                                                        </div>
                                                        <span></span>
                                                        <em><?php if (isset($this->form_error['firstname'])) {
                                echo $this->form_error["firstname"];
                            } ?></em>
                                                    </li>

                                                    <li>
                                                        <label><?php echo $this->Lang['ADDR1']; ?><span>*</span></label>
                                                        <div class="fullname">
                                                            <input type="text" name="address1" maxlength="100" value="<?php echo $u->ship_address1; ?>" class="fancy_input_bx"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>"/>
                                                        </div>
                                                        <em><?php if (isset($this->form_error['address1'])) {
                                echo $this->form_error["address1"];
                            } ?></em>
                                                        <span></span>
                                                    </li>
                                                    <li class="frm_clr">
                                                        <label><?php echo $this->Lang['ADDR2']; ?><span>*</span></label>
                                                        <div class="fullname">
                                                            <input type="text" name="address2" maxlength="100" value="<?php echo $u->ship_address2; ?>" class="fancy_input_bx" placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>"/>
                                                        </div>
                                                        <em><?php if (isset($this->form_error['address2'])) {
                                echo $this->form_error["address2"];
                            } ?></em>
                                                        <span></span>
                                                    </li>
                                                    <li>
                                                        <label><?php echo $this->Lang['COUNTRY']; ?><span>*</span></label>
                                                        <div class="fullname">
                                                            <select name="country" id="country" onchange="return city_change_merchant(this.value);">
    <?php foreach ($this->country_list as $c) { ?>
                                                                    <option <?php if ($c->country_id == $u->ship_country) { ?> selected <?php } ?>  title="<?php echo $c->country_name; ?>" value="<?php echo $c->country_id; ?>" ><?php echo $c->country_name; ?></option>
    <?php } ?>
                                                            </select> 
                                                        </div>
                                                        <em><?php if (isset($this->form_error['country'])) {
        echo $this->form_error["country"];
    } ?></em>

                                                    </li>
                                                    <li class="frm_clr">
                                                        <label><?php echo $this->Lang['CITY']; ?><span>*</span></label>
                                                        <div class="fullname">
                                                            <select name="city" id="CitySD">
    <?php foreach ($this->all_city_list as $c) { ?>
                <?php if ($c->country_id == $u->ship_country) { ?>
                                                                    <option  <?php if ($c->city_id == $u->ship_city) { ?> selected <?php } ?> title="<?php echo $c->city_name; ?>"value="<?php echo $c->city_id; ?>" ><?php echo $c->city_name; ?></option>
    <?php } } ?>
                                                            </select> </div>
                                                        <em><?php if (isset($this->form_error['city'])) {
        echo $this->form_error["city"];
    } ?></em>

                                                    </li>



                                                    <li>
                                                        <label><?php echo $this->Lang['STATE']; ?><span>*</span></label>
                                                        <div class="fullname">
                                                            <input type="text" name="state" maxlength="35" value="<?php echo $u->ship_state; ?>"  placeholder="<?php echo $this->Lang['ENTER_STATE']; ?>"/>
                                                        </div>
                                                        <em><?php if (isset($this->form_error['state'])) {
        echo $this->form_error["state"];
    } ?></em>

                                                    </li>
                                                    <li class="frm_clr">
                                                        <label><?php echo $this->Lang['MOBILE']; ?><span>*</span></label>
                                                        <div class="fullname">
                                                            <input type="text"  name="mobile" maxlength="18" value="<?php echo $u->ship_mobileno; ?>" placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>" />
                                                        </div>
                                                        <em><?php if (isset($this->form_error['mobile'])) {
        echo $this->form_error["mobile"];
    } ?></em>
                                                        <span></span>
                                                    </li>


                                                    <li>
                                                        <label><?php echo $this->Lang['ZIP_CODE']; ?><span>*</span></label>
                                                        <div class="fullname">
                                                            <input  type="text" name="zip_code"  value="<?php if($u->ship_zipcode !='0'){ echo $u->ship_zipcode; } ?>" maxlength="8" placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>"/>
                                                        </div>
                                                        <em><?php if (isset($this->form_error['zip_code'])) {
        echo $this->form_error["zip_code"];
    } ?></em>

                                                    </li>




                                                </ul>

                                            </div> 
                                        </div>
                                        <div class="buy_it complete_order_button ">
                                            <input name="Submit" type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" title="<?php echo $this->Lang['UPDATE']; ?>" class="preview_but" />            
                                        </div>   
                                    </div>

                                </form> 
<?php } ?>     

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>

var ww = document.body.clientWidth;

$(document).ready(function() {
	$(".tab_nav li a").each(function() {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		}
	});
	
	$(".tab_navicon").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$(".tab_nav").slideToggle();
	});
	adjustMenu();
})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 960 ) {
		$(".tab_navicon").css("display", "inline-block");
		if (!$(".tab_navicon").hasClass("active")) {
			$(".tab_nav").hide();
		} else {
			$(".tab_nav").show();
		}
		$(".tab_nav li").unbind('mouseenter mouseleave');
		$(".tab_nav li a.parent").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent("li").toggleClass("hover");
		});
	} 
	else if (ww >= 960) {
		$(".tab_navicon").css("display", "none");
		$(".tab_nav").show();
		$(".tab_nav li").removeClass("hover");
		$(".tab_nav li a").unbind('click');
		$(".tab_nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).toggleClass('hover');
		});
	}
}


</script>
