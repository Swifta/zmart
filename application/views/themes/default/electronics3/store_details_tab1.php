<!--Carousel Script-->
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/tabs.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#mycarousel').jcarousel({
            wrap: 'circular'
        });
        jQuery('#mycarousel2').jcarousel({
            wrap: 'circular'
        });
        jQuery('#mycarousel3').jcarousel({
            wrap: 'circular'
        });
         jQuery('#mycarousel4').jcarousel({
            wrap: 'circular'
        });
    });
</script>
<?php 
				$font_color = "";
				$bg_color ="";
				$font_size ="";
				if(count($this->merchant_personalised_details)>0) { 
					foreach($this->merchant_personalised_details as $m) {  
						$font_color = "color:".$m->font_color.";";
						$bg_color ="background:".$m->bg_color.";";
						$font_size = $m->font_size."px";
					} 
				}	?>       
			<?php if (count($this->get_product_categories) > 0) { ?>  
            <div class="store_page_listing">
                <div class="product_list_inner">
                  
                        <?php if ($this->product_setting) { ?>                                                                            
                            <?php if (count($this->get_product_categories) > 0) { ?>
                    <div class="related_product_list clearfix">
                        <div class="title_outer">
                            <h2 class="title_inner2"><?php echo $this->Lang['RE_PRO']; ?></h2>  
                        </div>                        
                                
                            <?php } ?>                                        
                            <div class="slider_wrap">
                                    <ul  <?php if (count($this->get_product_categories) > 4) { ?> id="mycarousel2" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>                         
                                        <?php
                                        $k = 1;
                                        foreach ($this->get_product_categories as $products) {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>
                                            <li <?php if (count($this->get_product_categories) < 5) { ?> <?php if($k==4) { ?> class="margin_zero" <?php } ?> <?php } else { ?> <?php } ?> >

                                                <div class="store_product_list">
                                                    <div class=" store_product_list_img">
                                                        <i class="wloader_img">&nbsp;</i>
                                                        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { 
                                                        $image_url = PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png';
                                                        $size = getimagesize($image_url);
                                                        ?>
                                                            <a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>">
                                                            <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png' ?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
                                                                 <?php } else { ?>
                                 <img src="<?php echo PATH .'images/products/1000_800/'.$products->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                                                
                                                                <?php /* <img src="<?php echo PATH.'images/products/290_215/'.$products->deal_key.'_1'.'.png';?>"  alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>"> */ ?></a>
                                                        <?php } else { ?>
                                                            <a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"  alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>"></a>
                                                        <?php } ?>                                                            
                                                    </div>

                                                    <div class="store_product_list_detail">
                                                        <a class="pro_title" style="font:<?php echo $font_size; ?> arial; <?php echo $font_color; ?>" href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 100); ?></a>
                                                        <!--<h3><a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo substr(ucfirst(strip_tags($products->deal_description)), 0, 20) . '...'; ?>"><?php echo substr(ucfirst(strip_tags($products->deal_description)), 0, 25) . '...'; ?></a></h3>-->
                                                            <?php /* <p> <?php echo $symbol . " " . $products->deal_price; ?> <?php echo CURRENCY_CODE; ?></p> */ ?>
                                                        <div class="ratings">
															<?php $avg_rating = $products->avg_rating;
																if($avg_rating!=''){
																	$avg_rating = round($avg_rating); ?>
																	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
																<?php } else { ?>
																	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
																<?php } ?>
                                                        </div>
                                                        <p style="font:18px arial;color:#000;"><?php echo $symbol . " " . $products->deal_value; ?> <?php echo CURRENCY_CODE; ?> </p>                                                       
                                                        <?php /*<div class="store_add_to_cart">
                                                            <a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php echo $this->Lang['ADD_TO_CART']; ?></a>                                                                     
                                                        </div> */ ?>
                                                    </div>
                                                    <div class="store_product_list_hover">
                                                        <a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>"><div class=" store_product_list_img_hover"></div></a>
                                                        <div class="store_product_list_detail white_bg">
                                                        <a class="pro_title" style="font:<?php echo $font_size; ?> arial;<?php echo $font_color; ?>" href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 100); ?></a> 
                                                        <div class="green_cart_outer">
                                                        <a class="green_cart" href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php echo $this->Lang['ADD_TO_CART']; ?></a>                                                                    
                                                        </div>
                                                        <div class="compare_wish">
                                                            <div class="wish">
                                                                <a onclick="addToWishList('<?php echo $products->deal_id; ?>','<?php echo addslashes($products->deal_title); ?>');" title="<?php echo $this->Lang['ADD_WISH_LIST'];?>">&nbsp;</a>
                                                            </div>
                                                            <div class="cmpr">
																 <a onclick="addToCompare('<?php echo $products->deal_id; ?>','','detail');" title="<?php echo $this->Lang['ADD_COMPARE']; ?>">&nbsp;</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div> 
                                            </li>
                                        <?php $k++; } ?>

                                    </ul>
                              
                            </div>
                                </div>
                        <?php } ?>        
                          
                </div>
            </div>
            <?php }else{
				$symbol = CURRENCY_SYMBOL; ?> 
            <div class="empty_product">
                <div class="title_outer">
                    <h2 class="title_inner2"><?php echo $this->Lang['RE_PRO']; ?></h2>  
                </div>  
                <div class="no_deals">
						<p><?php echo $this->Lang["PRD_CURR_NT_AVAIL"]; ?></p>
					</div>
                <?php /*
                <ul>
					<?php for($pro_lis=0;$pro_lis<4;$pro_lis++){?>
                    <li>
                        <div class="empty_product_list">
                            <div class=" store_product_list_img">
                                <a href="#" title="<?php echo $this->Lang['PRODUCT_IMG']; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/pro_noimage.png"/></a>
                            </div>
                            <div class="empty_pro_det">
                            <h3><a href="#" title="<?php echo $this->Lang['PRODUCT_TITLE']; ?>"><?php echo $this->Lang['PRODUCT_TITLE']; ?></a></h3>
                            <p><?php echo $this->Lang['PRODUCT_PRI']; ?> </p>                                                       
                            </div>
                        </div>
                    </li>
                    <?php }?>
                </ul>
                */ ?>
            </div>
            <?php } ?>
            <?php if (count($this->get_deals_categories) > 0) { ?>
            <div class="store_page_listing">
                <div class="product_list_inner">                                             
                        <?php if (($this->deal_setting)) { ?>
                            <?php if (count($this->get_deals_categories) > 0) { ?>
                    <div class="related_product_list clearfix"> 
                        <div class="title_outer">
                            <h2 class="title_inner2"><?php echo $this->Lang['FEAT_DEALS']; ?> </h2>  
                        </div>  
                            <?php } ?>                                                                        
                            <div class="slider_wrap">                                
                                    <ul  <?php $i=1; if (count($this->get_deals_categories) > 4) { ?> id="mycarousel3" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>
                                        <?php
                                        foreach ($this->get_deals_categories as $deals_categories) {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>
                                            <li <?php if (count($this->get_deals_categories) < 5) { ?> <?php if($i==4) { ?> class="margin_zero" <?php } ?> <?php } else { ?> <?php } ?>>
                                                <div class="green_store_deal_list">
                                                    <div class="green_store_deal_list_img">
                                                        <i class="wloader_img">&nbsp;</i>
                                                        <?php if (file_exists(DOCROOT . 'images/category/icon/' . $deals_categories->category_url . '.png')) { ?>

                                                        <?php } else { ?>

                                                        <?php } ?>

                                                        <?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals_categories->deal_key . '_1' . '.png')) {
                                                           $image_url = PATH . 'images/deals/1000_800/' . $deals_categories->deal_key . '_1' . '.png';
                                                           $size = getimagesize($image_url); ?>
                                                            <a href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" >
                                                             <?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
                                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/deals/1000_800/' . $deals_categories->deal_key . '_1' . '.png'; ?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>" alt="<?php echo $this->Lang['IMAGE']; ?>" title="<?php echo $this->Lang['IMAGE']; ?>" />
                                                                <?php } else { ?>
                                                                 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals_categories->deal_key.'_1'.'.png'?>" />
                                                                <?php } ?>
                                                                <?php /* <img src="<?php echo PATH.'images/deals/220_160/'.$deals_categories->deal_key.'_1'.'.png';?>"   alt="<?php echo $this->Lang['IMAGE']; ?>" title="<?php echo $this->Lang['IMAGE']; ?>" > */ ?></a>
                                                        <?php } else { ?>
                                                        <a  href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" ><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"   alt="<?php echo $this->Lang['IMAGE']; ?>" title="<?php echo $this->Lang['IMAGE']; ?>"  ></a>
                                                        <?php } ?>                                                                                                                                            
                                                            <div class="deal_of_icon">
                                                                <p><?php echo round($deals_categories->deal_percentage); ?>%</p>
                                                                <p>OFF</p>
                                                            </div>                                                            
                                                    </div>
                                                    <div class="green_store_deal_list_detail">
                                                        <?php $type = "";
                                            $categories = $deals_categories->category_url;
                                                        ?>
                                                            <a class="pro_title" style="font:<?php echo $font_size; ?> arial; <?php echo $font_color; ?>" href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo substr(ucfirst($deals_categories->deal_title), 0, 25) . "..."; ?>"><?php echo substr(ucfirst($deals_categories->deal_title), 0, 100) ; ?></a>
                                                                                                                           
                                                        <?php /*<div class="deal_list_time">
                                                            <div class="time_price_lft">
                                                                <label> <span time="<?php echo $deals_categories->enddate; ?>" class="kkcount-down" ></span></label>
                                                            </div>
                                                        </div>    */ ?>                                                    
                                                            <div class="ratings">
																
<?php $avg_rating = $deals_categories->avg_rating;
if($avg_rating!=''){
	$avg_rating = round($avg_rating); ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
<?php } else { ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
<?php } ?>
                                                            </div>

  <?php /* <p><?php echo $symbol . " " . $deals_categories->deal_price; ?></p> */ ?>
                                                            <p style="font:18px arial;color:#5BB110;"><?php echo $symbol . " " . $deals_categories->deal_value; ?></p>
                                                            <?php /*<div class="store_add_to_cart">
                                                                <a href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php echo $this->Lang['BUY_NOW2']; ?></a>
                                                            </div>   */ ?>                                                                                                                        
                                                    </div>
                                                    <div class="green_deal_hover">
                                                      <div class="green_store_deal_list_detail">
                                                        <?php $type = "";
                                            $categories = $deals_categories->category_url;
                                                        ?>
                                                            <a class="pro_title" style="font:<?php echo $font_size; ?> arial;<?php echo $font_color; ?>" href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo substr(ucfirst($deals_categories->deal_title), 0, 25) . "..."; ?>"><?php echo substr(ucfirst($deals_categories->deal_title), 0, 100) ; ?></a>
                                                                                                                           
                                                        <?php /*<div class="deal_list_time">
                                                            <div class="time_price_lft">
                                                                <label> <span time="<?php echo $deals_categories->enddate; ?>" class="kkcount-down" ></span></label>
                                                            </div>
                                                        </div>    */ ?>                                                  
                                                            <p style="font:18px arial;color:#5BB110;"><?php echo $symbol . " " . $deals_categories->deal_value; ?></p>
                                                            <?php /*<div class="store_add_to_cart">
                                                                <a href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php echo $this->Lang['BUY_NOW2']; ?></a>
                                                            </div>   */ ?>                                                                                                                        
                                                    </div>
                                                       <div class="time_price">                                                
                                                <span class="kkcount-down-detail" time="<?php echo $deals_categories->enddate; ?>" >
                                                </span>       
                                                        <div class="green_buy_nw">
                                                            <a href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php echo $this->Lang['BUY_NOW2']; ?></a>
                                                        </div>
                                                    </div>

                                                </div> 
                                            </li>
                                    <?php $i++; } ?>
                                    </ul>
                           
                            </div>
                                </div>
                                 <?php } ?>
                                             
                </div>                 
            </div>
              <?php }else{  ?>     
			<div class="empty_deals">
                <div class="title_outer">
                    <h2 class="title_inner2"><?php echo $this->Lang['FEAT_DEALS']; ?> </h2>  
                </div>  
                <div class="no_deals">
					<p><?php echo $this->Lang["DEALS_CURR_NT_AVAIL"]; ?></p>
				</div>
				<?php /*
                <ul>
					<?php for($del_list=0;$del_list<4;$del_list++){?>
                    <li>
                        <div class="empty_deal_list">
                            <div class="emt_deal_img">
                                <a href="#" title="<?php echo $this->Lang['DEAL_IMG']; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/deal_noimage.png"/></a>
                            </div>
                            <div class="offer"><p><?php //echo round($deals_categories->deal_percentage); ?>% OFF</p></div>
                            <div class="empty_deal_det">
                                <h3><a href="#" title="<?php echo $this->Lang['DEAL_TITLE']; ?>"><?php echo $this->Lang['DEAL_TITLE']; ?></a></h3>
                                <p><?php echo $this->Lang['DEAL_PRICE']; ?></p>
                            </div>
                        </div>
                    </li>
                    <?php }?>
                </ul>
                */ ?>
            </div>
            <?php  } ?>
            <?php if (count($this->get_auction_categories) > 0) { ?>
            <div class="store_page_listing">
                <div class="product_list_inner">
                        <?php if (($this->auction_setting)) { ?>
                            <?php if (count($this->get_auction_categories) > 0) { ?>
                    <div class="related_product_list clearfix"> 
                            <div class="title_outer">
                                <h2 class="title_inner2"><?php echo $this->Lang['RE_AUC']; ?></h2>  
                            </div>                                
                                <?php } ?>                                                                            
                            <div class="slider_wrap">  
                                    <ul <?php $j=1; if (count($this->get_auction_categories) > 4) { ?> id="mycarousel4" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>
                                        <?php
                                        foreach ($this->get_auction_categories as $deals1) {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>			
                                            <li <?php if (count($this->get_auction_categories) < 5) { ?> <?php if($j==4) { ?> class="margin_zero" <?php } ?> <?php } else { ?> <?php } ?> >
                                                <div class="store_product_list">
                                                    <div class="store_product_list_img">
                                                        <i class="wloader_img">&nbsp;</i>
            <?php if (file_exists(DOCROOT . 'images/auction/1000_800/' . $deals1->deal_key . '_1' . '.png')) { 
               $image_url = PATH . 'images/auction/1000_800/' . $deals1->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                                ?>
                                                            <a href="<?php echo PATH . $deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>">
                                                                               <?php if(($size[0] > AUCTION_LIST_WIDTH) && ($size[1] > 130)) { ?>
                                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/auction/1000_800/' . $deals1->deal_key . '_1' . '.png'; ?>&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=130" alt="<?php echo $deals1->deal_title; ?>" alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" border="0" />
                                                                <?php } else { ?>
                                 <img src="<?php echo PATH .'images/auction/1000_800/'.$deals1->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                                                
                                                            <?php /* <img src="<?php echo PATH.'images/auction/220_160/'.$deals1->deal_key.'_1'.'.png';?>"  alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" border="0" /> */ ?></a>

                                                        <?php } else { ?>
                                                            <a  href="<?php echo PATH .$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_auctions_list.png&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=130"  alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>"  border="0" /></a>
            <?php } ?>                                                                                                                                                   
                                                            <div class="green_auction_hover">
                                                                <a href="<?php echo PATH .$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $this->Lang['BID_NOW1']; ?>"><?php echo $this->Lang['BID_NOW1']; ?></a>
                                                            </div>    
                                                    </div>
                                                    <div class="store_product_list_detail">
                                                        <?php $type = "";$categories = $deals1->category_url;?>
                                                        <a class="pro_title" style="font:<?php echo $font_size; ?> arial;<?php echo $font_color; ?>" class="cursor" href="<?php echo PATH .$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>"><?php echo substr(ucfirst($deals1->deal_title), 0, 100); ?></a>
                                                        <div class="ratings">
                                                        															
<?php $avg_rating = $deals1->avg_rating;
if($avg_rating!=''){
	$avg_rating = round($avg_rating); ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
<?php } else { ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
<?php } ?>
                                                        </div>
                                                        <div class="bidder_details">
                                                            <?php $q = 0;
                                                            foreach ($this->all_payment_list as $payment) {
                                                                ?>
                                                                <?php
                                                                if ($payment->auction_id == $deals1->deal_id) {
                                                                    $firstname = $payment->firstname;
                                                                    $transaction_time = $payment->transaction_date;
                                                                    $q = 1;
                                                                }
                                                            }
                                                            ?>
            <?php if ($q == 1) { ?>
                                                            <p style="font:12px arial;color:#111;"><?php echo $this->Lang['LAST_BID']; ?> : <span><?php echo substr(ucfirst($firstname), 0, 10) . '..'; ?></span></p>
                                                            <p style="font:12px arial;color:#111;"><?php echo $this->Lang['BID']; ?> : <span><?php echo $symbol . " " . $deals1->deal_value; ?></span></p>                                                                    


            <?php } ?>
            <?php if ($q == 0) { ?>
                                                            <p style="font:12px arial;color:#111;"><?php echo $this->Lang['LAST_BID']; ?> : <span><?php echo $this->Lang['NOT_YET_BID']; ?></span></p>
                                                            <p style="font:12px arial;color:#111;"><?php echo $this->Lang['CLOSE_T']; ?> : <span><?php echo $symbol . " " . $deals1->deal_price; ?></span></p>                                                                    	
            <?php } ?>                                                            
                                                            <?php /*<a class="buy_it list_buy_it bid_it" href="<?php echo PATH .$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $this->Lang['BID_NOW1']; ?>"><?php echo $this->Lang['BID_NOW1']; ?></a> */ ?>                                                                   
                                                        </div>
                                                    </div>
                                                    <div class="auction_timer">                                                                                                                                           
                                                            <span time="<?php echo $deals1->enddate; ?>" class="kkcount-down" ></span>                                                                
                                                      </div> 
                                                </div> 
                                            </li>
                                        <?php  $j++; } ?>                    
                                </ul>
                            </div>                                    
                        </div>


              <?php   }   ?>

                </div>
            </div>
            <?php }else{  ?> 
               <div class="empty_deals">
                    <div class="title_outer">
                        <h2 class="title_inner2"><?php echo $this->Lang['RE_AUC']; ?></h2>  
                    </div> 
                     <div class="no_deals">
					<p><?php echo $this->Lang["AUC_CURR_NT_AVAIL"]; ?></p>
				</div>
                    <?php /*
                    <ul>
						<?php for($aus_list=0;$aus_list<4;$aus_list++){?>
                        <li>
                            <div class="empty_deal_list">
                                <div class="empty_act_img">
                                    <a href="#" title="<?php echo $this->Lang['AUC_IM']; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/action_noimage.png"/></a>
                                </div>
                                <div class="empty_action_det">
                                    <div class="em_act_det">
                                        <h3><a href="#" title="<?php echo $this->Lang['AUC_TIT']; ?>"><?php echo $this->Lang['AUC_TIT']; ?></a></h3>
                                        <div class="bidder_details">
                                            <p><?php echo $this->Lang['LAST_BID']; ?> : <span><?php echo '- - - '; ?></span></p>
                                            <p><?php echo $this->Lang['BID']; ?> : <span><?php echo " - - -"; ?></span></p>                                                                    
                                        </div>
                                    </div>
                                    <div class="em_timer">
                                        <span time="<?php echo strtotime(" +61days "); ?>" class="kkcount-down" ></span>   
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php }?>
                    </ul>
                    */ ?>
                </div>
               <?php } ?>
                    
	
