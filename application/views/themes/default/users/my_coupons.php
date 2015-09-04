<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript"> 
    $(document).ready(function(){
        $('.products_coupon').hide();
        $('.auctions_coupon').hide();
    });
</script>
<script type="text/javascript"> 
    function CouponsDeals() {
        $('.deals_coupon').show();
        $('.products_coupon').hide();
        $('.auctions_coupon').hide();
                                
        $("#CouponsDeals").addClass("sub_act");
        $("#CouponsProducts").addClass("sub_act");
        $("#CouponsAuctions").removeClass("sub_act");
        $("#CouponsProducts").addClass("sub_act");	
        $("#CouponsDeals").addClass("sub_act1");
        $("#CouponsAuctions").removeClass("sub_act1");
        $("#CouponsProducts").removeClass("sub_act1");			
       		
    }
        
    function CouponsProducts() {


        $('.products_coupon').show();
        $('.deals_coupon').hide();
        $('.auctions_coupon').hide();
                
        $("#CouponsProducts").addClass("sub_act");
	
        $("#CouponsAuctions").removeClass("sub_act");
        $("#CouponsDeals").addClass("sub_act");
        $("#CouponsProducts").addClass("sub_act1");
        $("#CouponsAuctions").removeClass("sub_act1");
        $("#CouponsDeals").removeClass("sub_act1");
    }
    function CouponsAuctions() {


        $('.auctions_coupon').show();
        $('.deals_coupon').hide();
        $('.products_coupon').hide();

               
        $("#CouponsProducts").addClass("sub_act");
				
       		
        $("#CouponsProducts").removeClass("sub_act1");
        $("#CouponsAuctions").addClass("sub_act1");
        $("#CouponsAuctions").removeClass("sub_act");
        $("#CouponsDeals").removeClass("sub_act1");
    }
</script>

<div class="contianer_outer1">
    <div class="contianer_inner">

        <div class="contianer">
            <div class="bread_crumb">

                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p>  <?php echo $this->Lang['MY_BUYS']; ?></p></li>
                </ul>
            </div>
            <!--content start-->
            <div class="content_abouts">
                <div class="all_mapbg_mid_common">
                    <div class="content_abou_common">
                         <div class="pro_top5">
                                                                                <div class="common_ner_commont1">
<div class="common_ner_commont">        
                        <h2>  <?php echo $this->Lang['MY_BUYS']; ?></h2>
</div>
                                                                                </div>
                        
                         </div>
                        <div class="all_mapbg_mid">   
                            <div class="myemai_mnu">
                                <div class="top_menu myemail_subbor">
                                    <a class="tab_navicon" href="#" title="Menu">Menu</a>
                                    <ul class="tab_nav">
                                        <li>
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-account.html" title="<?php echo $this->Lang['MY_ACC']; ?>"><?php echo $this->Lang['MY_ACC']; ?></a></div>
                                            <div class="tab_rgt"></div>

                                        </li>
                                        <li>
                                        <div class="tab_left"></div>
                                        <div class="tab_mid"><a href="<?php echo PATH; ?>wishlist.html" title="<?php echo $this->Lang['MY_WISH']; ?>"><?php echo $this->Lang['MY_WISH']; ?></a></div>
                                        <div class="tab_rgt"></div>
                                    </li>
                                        <li class="tab_act">
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
                                              <div class="tab_mid"><a href="<?php echo PATH;?>users/my-winner-list.html" title="<?php echo $this->Lang['WON_AUC']; ?>"><?php echo $this->Lang['WON_AUC']; ?></a></div> 
                                            <div class="tab_rgt"></div>

                                        </li>
                                        
                                         <li>
                                            <div class="tab_left"></div>
                                             <div class="tab_mid"><a href="<?php echo PATH;?>users/my-shipping-address.html" title="<?php echo $this->Lang['MY_SHIPPING_ADD']; ?>"><?php echo $this->Lang['MY_SHIPPING_ADD']; ?></a></div> 
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
                        <div class="bot_menu">
                            <ul>
                                <li  class="sub_act sub_act1" id="CouponsDeals">
                                    <a onclick="return CouponsDeals();"  style="cursor:pointer;" title="<?php echo $this->Lang['DEALS']; ?>"  ><?php echo $this->Lang['DEALS']; ?></a>
                                </li>
                                <li class="sub_act" id="CouponsProducts">
                                    <a onclick="return CouponsProducts();"title="<?php echo $this->Lang['PRODUCTS']; ?>" style="cursor:pointer;" ><?php echo $this->Lang['PRODUCTS']; ?></a>
                                </li>
                                <li id="CouponsAuctions">
                                    <a onclick="return CouponsAuctions();"title="<?php echo $this->Lang['AUCT']; ?>" style="cursor:pointer;" ><?php echo $this->Lang['AUCT']; ?></a>
                                </li>
                            </ul>                                                                
                        </div>
                        <div class="mybuys_content">   
                                <div class="deals_coupon">                                                        
                            <div class="my_account_table"> 
                            <?php if (($this->deal_setting) || (count($this->deals_coupons_list) > 0 )) { ?>
                           <?php echo new View("themes/" . THEME_NAME . "/users/deals");     ?> 
                           <?php } else {  ?>                                 
                           <?php echo $this->Lang['ADMIN_BLOCK_DEAL']; ?>
                           <?php } ?>
                            </div>
                            </div>
                            <div class="products_coupon">  
                            <div class="my_account_table">
                                  <?php if (($this->product_setting) || (count($this->products_coupons_list) > 0 )) { ?>
                                  <?php echo new View("themes/" . THEME_NAME . "/users/products"); ?>      
                                   <?php } else {  ?>                                 
                               <?php echo $this->Lang['ADMIN_BLOCK_PRODUCT']; ?>
                           <?php } ?>        
                            </div>
                            </div>
                            <div class="auctions_coupon">  
                            <div  class="my_account_table">        
                                   <?php if (($this->auction_setting) || (count($this->auctions_coupons_list) > 0 )) { ?>                        
                                    <?php echo new View("themes/" . THEME_NAME . "/users/auction"); ?>   
                                    <?php } else {  ?>                                 
                                        <?php echo $this->Lang['ADMIN_BLOCK_AUCTION']; ?>
                                    <?php } ?>                            
                            </div>
                            </div>
                            <div class="pagenation myrefer_pagenation deals_coupon">
                                <?php echo $this->pagination; ?>
                            </div>

                        </div>
                    </div>
                </div>  


            </div>
            <!--end-->
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
<?php if($this->session->get('hdn_type')!=''){
	$hdn_type = $this->session->get('hdn_type');
	$this->session->delete('hdn_type');
	if($hdn_type==1){?>
	<script>
		$(document).ready(function() {
			CouponsProducts();
		});
	</script>
	<?php }else if($hdn_type==2){?>
	<script>
		$(document).ready(function() {
			CouponsDeals();
		});
	</script>
	<?php }else if($hdn_type==3){?>
	<script>
		$(document).ready(function() {
			CouponsAuctions();
		});
	</script>
<?php }
}?>
