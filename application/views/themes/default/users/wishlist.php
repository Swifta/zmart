<div class="contianer_outer1">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>products.html" title="<?php echo $this->Lang['PRODUCTS']; ?>"><?php echo $this->Lang['PRODUCTS']; ?></a></p></li>
                    <li><p><?php echo $this->Lang['WISH_LIST']; ?></p></li>
                </ul>
            </div>
            <!--content start-->
            <div class="content_abouts">
                <div class="all_mapbg_mid_common">
                    <div class="content_abou_common">
                         <div class="pro_top5">
                            <div class="common_ner_commont1">
<div class="common_ner_commont">     
                         <h2><?php echo $this->Lang['WISH_LIST']; ?></h2>
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
                                    <li class="tab_act">
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
                                    
                                    <li >
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
                        <div class="mybuys_content">  
                            <?php
                                                                if($this->user_wishlist_count) { ?>
                            <div class="show_wishlist_title">
                                    <div class="show_wishlist_limit">
                                        <label><?php echo $this->Lang['SHW']; ?>:</label>
                                            <select onchange="location = this.value;">
                                                    <?php foreach($this->limit_value as $limit) { ?>
                                                    <option value="<?php echo PATH; ?>wishlist.html?limit=<?php echo $limit; ?>" <?php if(isset($this->limit) && $this->limit== $limit) {?> selected <?php } ?>><?php echo $limit; ?></option>
                                                    <?php } ?>
                                            </select>
                                    </div>
                                </div>
                                                <?php } ?>                              
							 <?php if($this->user_wishlist_count && count($this->user_wishlist_count) > 0) { ?>
                            <div class="my_account_table">
                            <table class="maccount_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0">
                                <thead>
                                    <tr>
                                         <th align="left" width="100"><?php echo $this->Lang['IMAGE']; ?></th>
                                            <th align="left" width="100"><?php echo $this->Lang['TITLE']; ?></th>
                                            <th align="left" width="100"><?php echo "Top category"; ?></th>
                                            <th align="left" width="100"><?php echo $this->Lang['ACT_PRI']; ?></th>
                                            <th align="left" width="100"><?php echo $this->Lang['PRICE']; ?></th>
                                            <th align="center" width="100"><?php echo $this->Lang['DELETE']; ?></th>
                                             <th align="left" width="100"><?php echo $this->Lang['ADD_TO_CART']; ?></th>
                                        </tr>
                                </thead>
                                        <?php
						foreach($this->user_wishlist as $u)
						{
							$wishlist_id = unserialize($u->wishlist);
							$i=1;
							foreach($wishlist_id as $p_id)
							{
								$limit = (isset($this->limit) && $this->limit == "100")?count($this->user_wishlist_count):$this->limit;
								if($i <= $limit)
								{
								$this->products = new Products_Model();
								$this->get_wishlist_products = $this->products->get_wishlist_products($p_id);
								$this->product_size = $this->products->get_product_one_size($p_id);
								//$size = $this->product_size->current()->size_id;
								foreach($this->get_wishlist_products as $products)
								{
					                        ?>
								<tr>
									<td>

										<a href="<?php echo PATH.$products->store_url_title.'/product/'.$products->deal_key.'/'.$products->url_title.'.html';?>" title="<?php echo $products->deal_title; ?>">
												<?php  if(file_exists(DOCROOT.'images/products/1000_800/'.$products->deal_key.'_1'.'.png')){ ?>
														<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'/images/products/1000_800/'.$products->deal_key.'_1.png'?>&w=80&h=80"  alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>">
												<?php } else { ?>
														<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=80&h=80" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
												<?php }?>
										</a>

									</td>
									
									<td>
											<a href="<?php echo PATH.$products->store_url_title.'/product/'.$products->deal_key.'/'.$products->url_title.'.html';?>" title="<?php echo $products->deal_title; ?>"><?php echo $products->deal_title; ?></a>
									</td>
									<?php
											$symbol = CURRENCY_SYMBOL;

									?>
									<td><?php  echo $products->category_name; ?></td>

									<td><?php  if($products->deal_price!=0) { echo $symbol.$products->deal_price; } else { echo $symbol.$products->deal_value; }  ?></td>
									<td><?php if($products->deal_price!=0) { echo $symbol.$products->deal_value; } else { echo "-"; }  ?></td>
							
									<td align="center">
											<a class="cart_delete" onclick="removewishlist('<?php echo $products->deal_id; ?>')" title="<?php echo $this->Lang['DELETE']; ?>">&nbsp;</a>
									</td>
									
									<td>
											<a href="<?php echo PATH.$products->store_url_title.'/product/'.$products->deal_key.'/'.$products->url_title.'.html';?>" class="buy_it" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php echo $this->Lang['ADD_TO_CART']; ?></a>
								   </td>
								</tr>
							                            <?php
								                  }
							                   }
					                $i++; }
							}
							?> 



                            </table>
                                </div>
                            
 <?php } else { ?>
                                       <div class="wishlist_empty">
                                                            <p><?php echo $this->Lang['YR_WIS_LIS_MT']; ?></p>
                                                            <img alt="logo" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/wishlist_empty.png"/>
                                                        </div>
                                        
<?php } ?> 
                                
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
