<div class="contianer_outer1">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><?php echo $this->Lang['STR_CRD_PURCH'];  ?></p></li>
                </ul>
            </div>					
            <!--content start-->
            <div class="content_abouts" style=" border: 1px solid  #E8E8E8;">

                <div class="all_mapbg_mid_common">
                    <div class="content_abou_common">
                    <div class="won_auction_outer">
                         <div class="pro_top5">
                            <div class="common_ner_commont1" style="width:98%;">
                             <div class="common_ner_commont">    
    
                              <h2><?php echo $this->Lang['STR_CRD_PURCH'];  ?></h2>
                           </div>
                                                       </div>
                         </div>
                        <div class="all_mapbg_mid">
                            <div class="top_menu top_menu myemail_subbor">
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
                                        <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-winner-list.html" title="<?php echo $this->Lang['WON_AUC'];  ?>"><?php echo $this->Lang['WON_AUC'];  ?></a></div> 
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
                                         <li  class="tab_act">
                                            <div class="tab_left"></div>
                                             <div class="tab_mid"><a href="<?php echo PATH;?>users/my-storecredits.html" title="<?php echo $this->Lang['MY_STR_LIST']; ?>"><?php echo $this->Lang["MY_STR_LIST"]; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <?php } ?>
                                </ul>                                                                
                            </div> 
                        </div>
                    </div>                    
                    <div class="mybuys_content">
                    <div class="my_account_table">
                        <table class="maccount_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0">
                            <thead>
                            <?php if (count($this->user_storecredit_list) > 0) { ?>   
                                <tr>
									
                                    <th width="100" align="center"><?php echo $this->Lang['PRODUCT']; ?></th>
                                    <th width="100" align="center"><?php echo $this->Lang['TITLE']; ?></th>              
                                    <th width="100" align="center"><?php echo $this->Lang['DUR_PERD']; ?></th>
                                    <th width="100" align="center"><?php echo $this->Lang['AMT_ALRDY_PAID']; ?></th>
                                    <th width="100" align="center"><?php echo $this->Lang['AMT_DUE']; ?></th>
                                    <th width="100" align="center"><?php echo $this->Lang['TOT_AMOUNT']; ?></th>
                                    <th width="100" align="center"><?php echo $this->Lang['STATUS1']; ?></th>
                                    <th width="100" align="center"><?php echo $this->Lang['PAY_NW']; ?></th>
                                </tr>
                            </thead>
                            <?php } ?>
                        <?php
                        $k = 0;
                        if (count($this->user_storecredit_list) > 0) { ?>                                                          
                           <?php  
										$next_payment =0;
										$installment_value=0;
										$first_item = $this->pagination->current_first_item;
                            foreach ($this->user_storecredit_list as $u) {
                                ?>                                 
                                <tr>
									
                                    <td >
        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $u->deal_key . '_1' . '.png')) { ?>
                                           <a href="<?php echo PATH.$u->store_url_title.'/product/'.$u->deal_key.'/'.$u->url_title.'.html';?>" title="<?php echo $u->deal_title;?>" class="fl clear">
                                              <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$u->deal_key.'_1'.'.png'?>&w=100&h=100" alt="<?php echo $this->Lang['IMAGE']; ?>" />
                                            </a>
        <?php } else { ?>
                                             <a href="<?php echo PATH.$u->store_url_title.'/product/'.$u->deal_key.'/'.$u->url_title.'.html';?>" title="<?php echo $u->deal_title;?>" class="fl clear">
                                               <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=100&h=100"  alt="<?php echo $this->Lang['IMAGE']; ?>" />
                                            </a>
        <?php } ?>
                                    </td>
                                    <td>
                                        <p><a href="<?php echo PATH . $u->store_url_title.'/product/' . $u->deal_key . '/' . $u->url_title . '.html'; ?>" title="<?php echo $u->deal_title; ?>"><?php echo $u->deal_title; ?></a></p>
                                    </td>
      
                                    <?php $installment_value = $u->product_value/$u->duration_period; 
									
										$next_payment = $u->installments_paid+1;
										?>
											<?php if($u->duration_period!=""){ 
												$amount_paid=0;
												$balance_to_be_paid=0;
												for($i=1;$i<=$u->duration_period;$i++) { ?>
													<?php if($u->installments_paid>=$i) {
														$amount_paid += $installment_value;
													} else {
														$balance_to_be_paid += $installment_value;
													}
														 ?>
													<?php } } ?>
                                    <td>
                                        <p><?php echo $u->duration_period." Months"; ?></p>
                                    </td>
                                    <td align="center">
                                        <p><?php echo CURRENCY_SYMBOL . $amount_paid; ?> </p>
                                    </td>
                                   
                                    <td align="center">
                                        <p><?php echo CURRENCY_SYMBOL . $balance_to_be_paid; ?> </p>
                                    </td>
                                    <td align="center">
                                        <p><?php $total = $u->product_value;
        echo CURRENCY_SYMBOL . $total; ?></p>
                                    </td>
                                     <td align="center">
                                        <p><?php if ($u->credit_status==1) { ?>
											<span style="font:bold 12px arial;color:#FDA237;margin:0px;margin-left:10px;padding:4px 11px 5px 12px;text-decoration:none" title="<?php echo $this->Lang['PENDING']; ?>" ><?php echo $this->Lang['PENDING']; ?> </span>
                                    <?php } else if ($u->credit_status==2) { ?>
											<span style="font:bold 12px arial;color:#353637;margin:0px;margin-left:10px;padding:4px 11px 5px 12px;text-decoration:none" title="<?php echo $this->Lang['APPR']; ?>" ><?php echo $this->Lang['APPR']; ?> </span>
                                    <?php } else if ($u->credit_status==3) { ?>
											<span style="font:bold 12px arial;color:#A61C00;margin:0px;margin-left:10px;padding:4px 11px 5px 12px;text-decoration:none" title="<?php echo $this->Lang['FAIL']; ?>" ><?php echo $this->Lang['FAIL']; ?> </span>
                                    <?php } ?><br/></p>
                                    </td>
                                    <td align="center">
										
										<?php if($u->installments_paid==$u->duration_period) { ?> 
											<span style="font:bold 12px arial;background:#FDA237;color:#fff;margin:0px;margin-left:10px;padding:4px 11px 5px 12px;text-decoration:none" title="<?php echo $this->Lang['COMP']; ?>" > <?php echo $this->Lang['COMP']; ?> </span>
										<?php  } else if($u->installments_paid==0 && $u->credit_status==2) { ?>
											<a style="font:bold 12px arial;background:#A61C00;color:#fff;margin:0px;margin-left:10px;padding:4px 11px 5px 12px;text-decoration:none" href="<?php echo PATH.'products/purchase_order/'.base64_encode($u->storecredit_id).'/'.base64_encode($u->userid).'/'.base64_encode($u->productid).'/'.base64_encode($next_payment); ?>" title="<?php echo $this->Lang['PAY_NW']; ?>" target="_blank"><?php echo $this->Lang['PAY_NW']; ?></a>
                                    <?php } else { ?> 
											<span style="font:bold 12px arial;color:#353637;margin:0px;margin-left:10px;padding:4px 11px 5px 12px;text-decoration:none"><?php echo $this->Lang["NOT_AVAIL"]; ?></span>
                                    <?php  } ?>
                                    </td>

                                </tr>
                                                             
        <?php $k++; ?>
                                
                     
  <?php  }  ?>                          
         
                                
                                <?php }  ?>
                                 </table>
                                <?php if (count($this->user_storecredit_list) == 0) { ?>  
                                <p class="no_referal"><?php echo $this->Lang['NO_DATA_F']; ?></p>
                       
<?php } ?> 
                           
                        <div class=""><?php echo $this->pagination; ?></div>                    
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
