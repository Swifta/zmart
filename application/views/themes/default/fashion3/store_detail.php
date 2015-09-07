<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<!--Carousel Script-->
<script src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery(1).js"  type="text/javascript"></script>
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js"></script>
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
        jQuery('#mycarousel5').jcarousel({
            wrap: 'circular'
        });
         jQuery('#mycarousel6').jcarousel({
            wrap: 'circular'
        });
    });
</script>
<script type="text/javascript" src="<?php echo PATH; ?>js/timer/kk_countdown_1_2_jquery_min.js"></script>
<script type="text/javascript" src="<?php echo PATH; ?>js/timer/kk_countdown_1_2_jquery_min_detail.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("body").kkCountDowndetail({
            colorText: '#7b7b7b',
            addClass: 'shadow'
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("body").kkCountDown({
            colorText:'#000000',
            colorTextDay:'#000000'	
        });
         $('.submit-link')
               .click(function(e){ 
			$('input[name="c"]').val(btoa($(this).attr('id').replace('sample-','')));
			$('input[name="c_t"]').val('<?php echo base64_encode("main"); ?>');
                       e.preventDefault();
                       $(this).closest('form')
                               .submit();                                               
                });
        });
$(function() {
$(".slidetabs").tabs(".images > div", {
	effect: 'fade',
	fadeOutSpeed: "medium",
	rotate: true
}).slideshow();
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#messagedisplay1').hide();
    });
</script>



<!-- banner start-->
<?php 
$banner_check ="";
if(count($this->merchant_personalised_details)>0) { 
	foreach($this->merchant_personalised_details as $m) {  ?>
            <div class="banner">
                                <div class="slider_home">
									
                                    <div class="images wloader_parent">
										<?php $tabs=0;for ($i = 1; $i <= 3; $i++) {?>
										<?php if (file_exists(DOCROOT . 'images/merchant/banner/' . $m->storeid.'_'.$m->sector_name.'_'.$i.'_banner.png')) { 
											$banner_link="";
											
											if($m->banner_1_link !="" || $m->banner_2_link !="" || $m->banner_3_link !="") { $banner_check = 1;
											if($i==1) { $banner_link = $m->banner_1_link; } else if($i==2) { $banner_link = $m->banner_2_link; } else if($i==3) { $banner_link = $m->banner_3_link; }}  ?>
										
                                        <i class="wloader_img" style="min-height: 525px;">&nbsp;</i>   
                                        <div style="display: none;">                                                                                
                                            <a href="<?php echo $banner_link; ?>"  title = "<?php echo $banner_link; ?>">
                                                <img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH; ?>images/merchant/banner/<?php echo $m->storeid.'_'.$m->sector_name.'_'.$i.'_banner.png'; ?>"/>
                                            </a>
                                        </div>
                                        <?php $tabs++;} ?>
                                       
                                            <?php }
                                            if($tabs==0){ ?>
											<img alt="Banner image" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME ?>/images/fashion_banner.png"/>											
                                            <?php } ?>                                  
                                      </div>  
                                      
                                                               
                                            <div class="controls">                                                    
                                                    <div class="slidetabs">
														
						<?php for ($i = 1; $i <= $tabs; $i++) {  if (file_exists(DOCROOT . 'images/merchant/banner/' . $m->storeid.'_'.$m->sector_name.'_'.$i.'_banner.png')) { ?>
                                                       <a href="" class="slider_dot current">&nbsp;</a> 
                                                        
                                                        <?php } } ?>
                                                       
                                                    </div>                                                                                                   
                                            </div>
                                             
                                    </div>
            </div>
            <?php   }  } ?>
            <!-- banner end-->
            <?php /*if(count($this->merchant_personalised_details)==0 || $banner_check==0){?>
            <div class="banner">
                <div class="slider_home">
                    <img alt="Banner image" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME ?>/images/fashion_banner.png"/>
                </div>
            </div>
            <?php }*/?>
            
            
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
				}	 ?>
<div class="contianer_outer1" style="<?php echo $bg_color; ?>">
    <div class="contianer_inner">
        <div class="contianer">
            <?php /*<div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><a href="<?php echo PATH; ?>stores.html" title="<?php echo $this->Lang['STORES']; ?>"><?php echo $this->Lang['STORES']; ?></a></p></li>
                    <?php foreach ($this->get_store_details as $store) { ?>
                        <li><p><?php echo ucfirst($store->store_name); ?></p></li>
                    <?php } ?>
                </ul>
            </div> */ ?>
            <div  id="messagedisplay1" style="display:none;">      
                <div class="session_wrap">
                    <div class="session_container">
                        <div class="success_session">
                            <p><span ><?php echo $this->Lang['COMM_POST_SUCC']; ?>.</span></p>
                            <div class="close_session_2">
                                <a class="closestatus cur" title="<?php echo $this->Lang['CLOSE']; ?>"  onclick="return closeerr();" >&nbsp;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <?php 
            $ads_check = "";
            if(count($this->merchant_personalised_details)>0) { 
	foreach($this->merchant_personalised_details as $m) {
		 ?>        
            <div class="advertice_part">
                <ul>
					<?php for ($i = 1; $i <= 3; $i++) { ?>
										<?php if (file_exists(DOCROOT . 'images/merchant/ads/' . $m->storeid.'_'.$m->sector_name.'_'.$i.'_ads.png')) {
											$ads_link="";
											if($m->ads_1_link !="" || $m->ads_2_link !="" || $m->ads_3_link !="") {  $ads_check = 1;
											if($i==1) { $ads_link = $m->ads_1_link; } else if($i==2) { $ads_link = $m->ads_2_link; } else if($i==3) { $ads_link = $m->ads_3_link; } } ?>
                    <li>
                        <div class="advertice_inner">
                            <a href="<?php echo $ads_link; ?>" title="<?php echo $ads_link; ?>">
                              <img alt="" src="<?php echo PATH; ?>images/merchant/ads/<?php echo $m->storeid.'_'.$m->sector_name.'_'.$i.'_ads.png'; ?>"/>  
                            </a>
                        </div>
                    </li>
                    <?php }else{?>
						<li><img alt="Banner image" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME ?>/images/fashion_add.png"/></li>
                    <?php }}?> 
                   
                </ul>  
            </div>
            <?php  } } ?>
            <?php /* if($ads_check==0){?>
            <div class="empty_add">
                <ul>
                    <li><img alt="Banner image" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME ?>/images/fashion_add.png"/></li>
                    <li><img alt="Banner image" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME ?>/images/fashion_add.png"/></li>
                    <li><img alt="Banner image" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME ?>/images/fashion_add.png"/></li>
                </ul>
            </div>
            <?php }*/?>
           
            <?php if((count($this->best_seller)>0) || (count($this->get_product_categories)>0)) { ?>
            <div class="best_seller_outer">
				<?php if(count($this->best_seller)>0) { ?>
                <div class="best_seller_lft">
                    <div class="best_seller_inner">
                        <div class="title_outer">
                          <h2 class="title_inner">Best Seller</h2>  
                        </div>
                        <div class="best_seller_list">                            
                            <ul id="mycarousel5" class="jcarousel-skin-tango5">
								<?php foreach($this->best_seller as $best) {  $symbol = CURRENCY_SYMBOL; ?>
                                <li>
                                    <div class="seller_listing">
                                        <div class="seller_listing_img">
                                          <a href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>" title="<?php echo $best->deal_title; ?>">
												<?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $best->deal_key . '_1' . '.png')) { $image_url = PATH . 'images/products/1000_800/' . $best->deal_key . '_1' . '.png';
												$size = getimagesize($image_url); if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                                                 <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $best->deal_key . '_1' . '.png' ?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $best->deal_title; ?>" title="<?php echo $best->deal_title; ?>" />
												<?php } else { ?>
												 <img src="<?php echo PATH .'images/products/1000_800/'.$best->deal_key.'_1'.'.png'?>" />
												<?php } ?>
                                                <?php } else { ?>
														<img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" alt="<?php echo $best->deal_title; ?>" title="<?php echo $best->deal_title; ?>" />
												<?php } ?>
                                            </a>
                                            <div class="seller_listing_img_hover">
                                               <a href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>" title="<?php echo $best->deal_title; ?>">
                                                  <?php /*  <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cart_icon_seller.png"/>   */?>
                                                </a> 
                                            </div>  
                                            <div class="action_links">
                                                    <div class="cmpr">
													
 
<a onclick="addToCompare('<?php echo $best->deal_id; ?>','','detail');" title="<?php echo $this->Lang['ADD_COMPARE']; ?>">&nbsp;</a>

                                                    </div>
                                                    <div class="crt">
                                                        <a href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>" title="Add to cart">Add to cart</a>
                                                    </div>
                                                    <div class="wish">
															<a onclick="addToWishList('<?php echo $best->deal_id; ?>','<?php echo addslashes($best->deal_title); ?>');" title="<?php echo $this->Lang['ADD_WISH_LIST'];?>">&nbsp;</a>
                                                        
                                                    </div>  
                                                </div>
                                        </div>
                                        <div class="seller_listing_content">
                                            <a class="pro_tit" href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>" title="<?php echo $best->deal_title; ?>" style="font-size:<?php echo $font_size; ?> arial; <?php echo $font_color; ?>"> <?php echo $best->deal_title; ?></a>
                                            <div class="ratings">
                                                
<?php $avg_rating = $best->avg_rating;
if($avg_rating!=''){
	$avg_rating = round($avg_rating); ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
<?php } else { ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
<?php } ?>
                                            </div>
                                            <p style="font:18px arial;color: #000;"><?php echo $symbol . " " . $best->deal_value; ?></p>
                                        </div>
                                    </div>                                    
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <?php } ?>
               <?php  if(count($this->get_product_categories)>0) { ?> 
                <div class="best_seller_rgt">
                    <div class="title_outer">
                        <h2 class="title_inner">Latest Products</h2>  
                    </div>
                    <div class="latest_product">
                        <ul id="mycarousel6" class="jcarousel-skin-tango5">
			<?php $k = 0; foreach($this->get_product_categories as $products) {
                                   $symbol = CURRENCY_SYMBOL; 
                                   $kk = $k%2;
                                   $k++;
                                   ?>
                                   <?php if($kk == 0) { ?>
                                        <li> 
                                <?php } ?>
                                <div class="latest_product_common  ">
                                 
                                    <div class="latest_product_inner <?php if($kk == 1) { ?> latest_product_inner2 <?php } ?>">
                                        <div class="latest_product_lft">
											<a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>">
					<?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { 
						$image_url = PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png';
						$size = getimagesize($image_url); ?>
                 <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                        <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png' ?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
                        <?php } else { ?>
                                 <img src="<?php echo PATH .'images/products/1000_800/'.$products->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                <?php } else { ?>
                                          <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" /> 
                                           <?php } ?>
                                           </a>
                                        </div>
                                        <div class="latest_product_right">
                                            <a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>"><p style="font-size:<?php echo $font_size; ?> arial;<?php echo $font_color; ?>">
                                            <?php echo substr($products->deal_title,0,40); ?></p> </a>
                                            <span><?php echo $symbol . " " . $products->deal_value; ?>  </span>
                                            <div class="ratings">
												
<?php $avg_rating = $products->avg_rating;
if($avg_rating!=''){
	$avg_rating = round($avg_rating); ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
<?php } else { ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
<?php } ?>
          
                                            </div>
                                            <div class="action_links">
                                                    <div class="cmpr">
                                                        
<a onclick="addToCompare('<?php echo $products->deal_id; ?>','','detail');" title="<?php echo $this->Lang['ADD_COMPARE']; ?>">&nbsp;</a>
                                                    </div>
                                                    <div class="crt">
                                                        <a href="<?php echo PATH .  $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>">Add to cart</a>
                                                    </div>
                                                    <div class="wish">
														<a onclick="addToWishList('<?php echo $products->deal_id; ?>','<?php echo addslashes($products->deal_title); ?>');" title="<?php echo $this->Lang['ADD_WISH_LIST'];?>">&nbsp;</a>

                                                    </div>  
                                                </div>
                                            
                                        </div>
                                    </div>
                                    <?php /*<div class="latest_product_inner latest_product_inner2">
                                        <div class="latest_product_lft">
                                            <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { 
                $image_url = PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png';
                $size = getimagesize($image_url); ?>
                 <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                        <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png' ?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
                        <?php } else { ?>
                                 <img src="<?php echo PATH .'images/products/1000_800/'.$products->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                <?php } else { ?>
                                          <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" /> 
                                           <?php } ?>
                                        </div>
                                        <div class="latest_product_right">
                                            <p><?php echo $products->deal_title; ?></p> 
                                            <span><?php echo $symbol . " " . $products->deal_value; ?></span>
                                           <a href="<?php echo PATH .  $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"></a>
                                        </div>
                                    </div> */ ?>
                                    
                                </div><?php if($kk == 1) { ?>
                            </li> 
                            <?php } ?>
                            <?php  } ?>
                            
                         
                        </ul>
                    </div>
                </div>
            </div>
            <?php } }else{ ?>
          <div class="best_seller_outer">
                <div class="best_seller_lft">
                    <div class="empty_seller">
                    <div class="title_outer">
                        <h2 class="title_inner">Best Seller</h2>  
                      </div>
						<div class="no_deals">
							<p><?php echo $this->Lang["PRD_CURR_NT_AVAIL"]; ?></p>
						</div> 
                      <?php /*
                    <ul>
						<?php for($pro_lis=0;$pro_lis<3;$pro_lis++){?>
                        <li>
                            <div class="seller_listing">
                                <div class=" seller_listing_img">
                                    <a href="#" title="<?php echo $this->Lang['PRODUCT_IMG']; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/240X183.png"/></a>
                                </div>
                                <div class="empty_pro_det">
                                <h3><a href="#" title="<?php echo $this->Lang['PRODUCT_TITLE']; ?>"><?php echo $this->Lang['PRODUCT_TITLE']; ?></a></h3>
                                <p><?php echo $this->Lang['PRODUCT_PRI']; ?></p>                                                       
                                </div>
                            </div>
                        </li>
                        <?php }?>
                    </ul>
                    */ ?>
                </div>
                </div>
                
                <div class="best_seller_rgt">
                    <div class="title_outer">
                        <h2 class="title_inner">Latest Products</h2>  
                    </div>
                    <div class="emt_latest_product">
						<div class="no_deals">
							<p><?php echo $this->Lang["PRD_CURR_NT_AVAIL"]; ?></p>
						</div>
						<?php /*
                        <ul>
							<?php for($pro_lis=0;$pro_lis<2;$pro_lis++){?>
                            <li>
                                <div class="latest_product_lft">
                                    <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/145X111.png" alt="<?php echo $this->Lang['PRODUCT_IMG']; ?>" title="<?php echo $this->Lang['PRODUCT_IMG']; ?>" /> 
                                </div>
                                <div class="emt_latest_right">
                                    <p><?php echo $this->Lang['PRODUCT_TITLE']; ?></p> 
                                    <span><?php echo $this->Lang['PRODUCT_PRI']; ?></span>
                                    <a href="#" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php echo $this->Lang['ADD_TO_CART']; ?></a>
                                </div>
                            </li>
                            <?php }?>
                        </ul>
                        */ ?>
                    </div>
                </div>
               
            </div>
             <?php  }?>
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
                                        $l = 1;
                                        foreach ($this->get_product_categories as $products) {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>
                                            <li <?php if($l==4) { ?> class="margin_zero" <?php } ?>>

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
                                                          
                                                             <div class="seller_listing_img_hover">
                                                                 <a href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>" title="<?php echo $best->deal_title; ?>">&nbsp;</a>
                                                             </div>
                                                         <div class="action_links">
                                                    <div class="cmpr">
                                                        
<a onclick="addToCompare('<?php echo $products->deal_id; ?>','','detail');" title="<?php echo $this->Lang['ADD_COMPARE']; ?>">&nbsp;</a>


                                                    </div>
                                                    <div class="crt">
                                                        <a href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php echo $this->Lang['ADD_TO_CART']; ?></a>
                                                    </div>
                                                    
                                                    <div class="wish">
														 <a onclick="addToWishList('<?php echo $products->deal_id; ?>','<?php echo addslashes($products->deal_title); ?>');" title="<?php echo $this->Lang['ADD_WISH_LIST'];?>">&nbsp;</a>
                                                    </div>         
                                                </div>   
                                                    </div>

                                                    <div class="store_product_list_detail">
                                                        <a class="pro_tit" style="font-size:<?php echo $font_size; ?> arial;<?php echo $font_color; ?>" href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 100); ?></a>
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
                                                        
                                                     <?php /*   <div class="store_add_to_cart_out">
                                                            <div class="store_add_to_cart">
                                                                <a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php echo $this->Lang['ADD_TO_CART']; ?></a>                                                                     
                                                            </div>
                                                        </div> */?>
                                                    </div>
                                                </div> 
                                            </li>
                                        <?php $l++; } ?>

                                    </ul>
                              
                            </div>
                                </div>
                            
                          <?php } ?> 
                </div>
            </div>
              <?php }else{  ?>  
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
                            <div class="empty_add_to_cart">
                                <a href="#" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php echo $this->Lang['ADD_TO_CART']; ?></a>                                                                     
                            </div>
                        </div>
                    </li>
                    <?php } ?> 
                </ul>
                */ ?>
            </div>
            <?php  } ?>
            <?php if (count($this->get_deals_categories) > 0) { ?>
            <div class="store_page_listing">
                <div class="product_list_inner">
                                                                                             
                        <?php if (($this->deal_setting)) { ?>
                            <?php $m=1; if (count($this->get_deals_categories) > 0) { ?>
                    <div class="related_product_list clearfix"> 
                        <div class="title_outer">
                            <h2 class="title_inner2"><?php echo $this->Lang['FEAT_DEALS']; ?> </h2>  
                        </div>  
                            <?php } ?>                                                                        
                            <div class="slider_wrap">                                
                                    <ul  <?php if (count($this->get_deals_categories) > 4) { ?> id="mycarousel3" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>
                                        <?php
                                        foreach ($this->get_deals_categories as $deals_categories) {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>
                                            <li <?php if($m==4) { ?> class="margin_zero" <?php } ?>>
                                                <div class="store_product_list">
                                                    <div class="deal_list_img">
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
                                                              </a>
                                                        <?php } else { ?>
                                                            <a href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" ><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"   alt="<?php echo $this->Lang['IMAGE']; ?>" title="<?php echo $this->Lang['IMAGE']; ?>"  ></a>
                                                        <?php } ?>                                                                                                                                            
                                                            <div class="deal_of_icon">
                                                                <p><?php echo round($deals_categories->deal_percentage); ?>%</p>
                                                                <p>OFF</p>
                                                            </div>
                                                            <div class="time_price">                                                
                                                <span class="kkcount-down-detail" time="<?php echo $deals_categories->enddate; ?>" >
                                                </span>                                                    
                                            </div>          
                                                    <div class="red_auction_hover_1">&nbsp;</div>
                                                    <div class="qv_button_container">
                                                        <a href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php echo $this->Lang['BUY_NOW2']; ?></a>
                                                    </div>        
                                                    </div>
                                                    <div class="store_product_list_detail">
                                                        <?php $type = "";
                                            $categories = $deals_categories->category_url;
                                                        ?>
                                                            <a class="pro_tit" style="font-size:<?php echo $font_size; ?> arial; <?php echo $font_color; ?>" href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo substr(ucfirst($deals_categories->deal_title), 0, 25) . "..."; ?>"><?php echo substr(ucfirst($deals_categories->deal_title), 0, 100) ; ?></a>
                                                                                                                           
                                                        <?php /*<div class="deal_list_time">
                                                            <div class="time_price_lft">
                                                                <label> <span time="<?php echo $deals_categories->enddate; ?>" class="kkcount-down" ></span></label>
                                                            </div>
                                                        </div>    */ ?>                                                    
                                                            <?php /* <p><?php echo $symbol . " " . $deals_categories->deal_price; ?></p> */ ?>
                                                            <div class="ratings">
																
<?php $avg_rating = $deals_categories->avg_rating;
if($avg_rating!=''){
	$avg_rating = round($avg_rating); ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
<?php } else { ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
<?php } ?>
                                                            </div>
                                                            
                                                            <p style="font:18px arial;color:#000;"><?php echo $symbol . " " . $deals_categories->deal_value; ?></p>
                                                            <?php /*<div class="store_add_to_cart">
                                                                <a href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php echo $this->Lang['BUY_NOW2']; ?></a>
                                                            </div>   */ ?>                                                                                                                        
                                                    </div>

                                                </div> 
                                            </li>
                                    <?php $m++; } ?>
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
                            <div class="time_price">                                                
                                <span class="kkcount-down-detail" time="<?php echo strtotime(" +61days "); ?>" ></span>                                                    
                            </div> 
                            </div>
                            <div class="offer"><p><?php //echo round($deals_categories->deal_percentage); ?>% OFF</p></div>
                            <div class="empty_deal_det">
                                <h3><a href="#" title="<?php echo $this->Lang['DEAL_TITLE']; ?>>"><?php echo $this->Lang['DEAL_TITLE']; ?></a></h3>
                                <p><?php echo $this->Lang['DEAL_PRICE']; ?></p>
                            </div>
                        </div>
                    </li>
                     <?php } ?>
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
                                    <ul <?php if (count($this->get_auction_categories) > 4) { ?> id="mycarousel4" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>
                                        <?php
                                        foreach ($this->get_auction_categories as $deals1) {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>			
                                            <li>
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
                                                            <div class="red_auction_hover">&nbsp;</div>
                                                            <div class="qv_button_container">
                                                                <a href="<?php echo PATH .$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="Bid Now">Bid Now</a>
                                                            </div>
                                                               
                                                          
                                                       <div class="auction_timer">                                                                                                                                           
                                                              <span time="<?php echo $deals1->enddate; ?>" class="kkcount-down" ></span>                                                                
                                                        </div>     
                                                    </div>
                                                    <div class="store_product_list_detail">
                                                        <?php $type = "";$categories = $deals1->category_url;?>
                                                        <a class="pro_tit" style="font-size:<?php echo $font_size; ?> arial;<?php echo $font_color; ?>" class="cursor" href="<?php echo PATH .$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>"><?php echo substr(ucfirst($deals1->deal_title), 0, 50); ?></a>
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
                                                </div> 
                                            </li>
                                        <?php  } ?>                    
                                </ul>
                            </div>                                    
                        </div>


              <?php   }   ?>

                </div>
            </div>
            <?php }else{  ?> 
           <div class="empty_product">
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
                            <div class="empty_product_list">
                                <div class="empty_act_img">
                                    <a href="#" title="<?php echo $this->Lang['AUC_IM']; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/action_noimage.png"/></a>
                                <div class="auction_timer">                                                                                                                                           
                                   <span time="<?php echo strtotime(" +61days "); ?>" class="kkcount-down" ></span>                                                                
                                </div> 
                                </div>
                                <div class="empty_action_det">
                                    <div class="em_act_det">
                                        <h3><a href="#" title="<?php echo $this->Lang['AUC_TIT']; ?>"><?php echo $this->Lang['AUC_TIT']; ?></a></h3>
                                        <div class="bidder_details">
                                           <p><?php echo $this->Lang['LAST_BID']; ?> : <span><?php echo '- - - '; ?></span></p>
                                            <p><?php echo $this->Lang['BID']; ?> : <span><?php echo '- - - '; ?></span></p>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                      <?php }?>
                        
                    </ul>
                    */ ?>
                </div>
            
          <?php  } ?>
            
            
            <div class="map_address_part">
                <div class="store_address">                    
                        <?php foreach ($this->get_store_details as $store) { ?>                
                    <?php /*<div class="store_image wloader_parent">
                        <i class="wloader_img" style="min-height: 300px;">&nbsp;</i>           
                        <?php if (file_exists(DOCROOT . 'images/merchant/600_370/' . $store->merchant_id . '_' . $store->store_id . '.png')) { ?>
                            <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/merchant/600_370/' . $store->merchant_id . '_' . $store->store_id . '.png' ?>&w=<?php echo STORE_DETAIL_WIDTH; ?>&h=<?php echo STORE_DETAIL_HEIGHT; ?>" alt="<?php echo $this->Lang['IMAGE']; ?>" />
                        <?php } else { ?>
                            <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_stores_details.png&w=<?php echo STORE_DETAIL_WIDTH; ?>&h=<?php echo STORE_DETAIL_HEIGHT; ?>"  alt="<?php echo $this->Lang['IMAGE']; ?>">
                        <?php } ?>
                    </div> */ ?>
                    <div class="map_address">                    
                        <div class="clearfix wloader_parent">
                            <i class="wloader_img">&nbsp;</i>
                            <div id="map_main" style="height:306px;"></div>
                            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                            <script type="text/javascript">
                                var latlng = new google.maps.LatLng(<?php echo $store->latitude; ?>,<?php echo $store->longitude; ?>);
                                var myOptions = {
                                    zoom: 12,
                                    center: latlng,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                                    navigationControl: true,
                                    mapTypeControl: true,
                                    scaleControl: true
                                };
                            
                                var map = new google.maps.Map(document.getElementById("map_main"), myOptions);
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    animation: google.maps.Animation.BOUNCE
                                });
                            
                                var infowindow = new google.maps.InfoWindow({
                                    content: '<b><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $store->store_name); ?></b><p><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $store->address1); ?></p><p><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $store->address2); ?></p><p><?php echo $store->city_name; ?>,<?php echo $store->country_name; ?></p>'
                                });
                            
                                google.maps.event.addListener(marker, 'click', function() { 
                                    infowindow.open(map, marker);
                                });
                                marker.setMap(map);
                            
                            </script>
                        </div>                                                                                                                        
                    </div>
                    <div class="store_address_cont">                    
                    <h2><?php echo ucfirst($store->store_name) ; ?></h2>                    
                        <?php /* <h2 class="deal_sub_title store_address_title"><?php echo $this->Lang['ADDRES']; ?></h2> */ ?>                        
                            <!--<h3><?php echo $store->store_name; ?>,</h3>-->
                            <p><?php echo $store->address1; ?>,</p>
                            <p><?php echo $store->address2; ?>,  </p>                                    
                            <p><?php echo $store->city_name; ?>, <?php echo $store->country_name; ?>. </p>                  
                            <p><?php echo $this->Lang['MOBILE']; ?>: <?php echo $store->phone_number; ?> </p>
                            <p><?php echo $this->Lang['WEBSITE']; ?>: <a href="<?php echo $store->website; ?>" target="blank" class="deal_web_link"> <?php echo $store->website; ?></a></p>                        
                    </div>
                <?php } ?>                    
                </div> 
                <div class="store_map_comment">
                    <div class="title_outer">
                        <h2 class="title_inner2"><?php echo $this->Lang['COMM']; ?></h2>  
                    </div>                    
                        <div class="fbok_comment wloader_parent" style="min-height:220px;">
                            <i class="wloader_img">&nbsp;</i>
                            <div id="fb-root"></div>
                            <script>
                                (function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;

                                    js = d.createElement(s); js.id = id;
                                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));														
                            </script>
                            <div width="100%" class="fb-comments" data-href="<?php echo PATH . $store->store_url_title.'/'; ?>" data-num-posts="10" ></div>
                        </div>                     
                </div>
            </div>
               <?php if (count($this->get_sub_store_details) > 0) { ?>     
            <div class="store_page_listing">
                <div class="product_list_inner">
                 
                        <div class="store_slide_list clearfix">
                                <h2 class="inner_commen_title" style="text-transform:uppercase;"> <?php echo $this->Lang['BRANCHES']; ?><span class="right_top_ae">&nbsp; </span></h2>                                                                        
                                <div class="slider_wrap">
                                    <ul <?php if (count($this->get_sub_store_details) > 2) { ?> id="mycarousel" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?> >


                                                    <?php foreach ($this->get_sub_store_details as $stores) { ?>

                                            <li>

                                                <div class="branch_listing">                                                                                                                        
                                                    <div class="branch_listing_img">      
                                                        <i class="wloader_img">&nbsp;</i>
                                                        <?php if (file_exists(DOCROOT . 'images/merchant/290_215/' . $stores->merchant_id . '_' . $stores->store_id . '.png')) { ?>
                                                            <a href="<?php echo PATH . $stores->store_url_title . '/'; ?>" title="<?php echo $stores->store_name; ?>">
                                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/merchant/290_215/' . $stores->merchant_id . '_' . $stores->store_id . '.png' ?>&w=150&h=130" alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>" />
            <?php /* <img  src="<?php echo PATH.'images/merchant/290_215/'.$stores->merchant_id.'_'.$stores->store_id.'.png';?>"   alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>"> */ ?></a>
        <?php } else { ?>
                                                            <a href="<?php echo PATH . $stores->store_url_title.'/'; ?>" title="<?php echo $stores->store_name; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_stores_list.png&w=150&h=130"   alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>" ></a>
        <?php } ?>                                                   
                                                    </div>
                                                    <div class="branch_details">
                                                        <a style="font:bold <?php echo $font_size; ?>  arial;<?php echo $font_color; ?> " href="<?php echo PATH . $stores->store_url_title . '/'; ?>" title="<?php echo $stores->store_name; ?>"><?php echo substr(ucfirst($stores->store_name), 0, 100) ; ?></a>
                                                        <p style="font:11px/15px arial;color:#666;"><?php echo substr($stores->about_us,0,150); ?></p>
                                                        <!--<h3> <a title="<?php echo $stores->address1; ?>"><?php echo $stores->address1; ?></a></h3>-->                                                                                                                                                                                                                                                                                              
                                                        <div class="branch_details_but">
                                                          <a href="<?php echo PATH . $stores->store_url_title.'/'; ?>" title="<?php echo $this->Lang['VIEW_DETAILS']; ?>"><?php echo $this->Lang['VIEW_DETAILS']; ?></a>                                                                                                                                                      
                                                        </div>
                                                        
                                                    </div>                                                                                                                        
                                                </div> 
                                            </li>
                                <?php } ?>   


                                    </ul>
                                </div>                                                                 
                                </div>

                </div>
            </div>
            <?php }else{  ?>
           <div class="empty_branches">
				<h2 class="inner_commen_title" style="text-transform:uppercase;"> <?php echo $this->Lang['BRANCHES']; ?><span class="right_top_ae">&nbsp; </span></h2>
				<div class="no_deals">
					<p><?php echo $this->Lang["BRANCH_CURR_NT_AVAIL"]; ?></p>
				</div>
				<?php /*
				<ul>
					<?php for($aus_list=0;$aus_list<6;$aus_list++){?>
					<li>
						<div class="empty_branch_list">
							<div class="branch_listing_img">
								<a href="#" title="<?php echo $this->Lang['BRANCH_IMAGE']; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/branches_noimage.png"   alt="<?php echo $this->Lang['BRANCH_IMAGE']; ?>" title="<?php echo $this->Lang['BRANCH_IMAGE']; ?>" ></a>
							</div>
							<div class="empty_br_det">
								<h3><a href="#" title="<?php echo $this->Lang['BRANCH_TITLE']; ?>"><?php echo $this->Lang['BRANCH_TITLE']; ?></a></h3>
								<p><?php echo $this->Lang['BRANCH_DESC']; ?></p>
							</div>
							<div class="empty_br_but">
								<a href="#" title="View more">View more</a>
							</div>
						</div>
					</li>
				   <?php }?>
				</ul>
				*/ ?>
			</div>
          <?php  } ?>
         </div>
	</div>
</div>
<div class="store_subscribe_part_outer">
    <div class="store_subscribe_part">
        <div class="store_subscribe_part_inner">
            <h2>Subscribe</h2>
            <p>Subscribe to receive our news everyday !</p>
            <div class="sub_cont">
                <div class="sub_cont_inner">
                    <input type="text" name="store_subscriber" id="store_subscriber1"  placeholder="Enter Email Address" onkeypress="return check_color();" />
                     <input type="submit" onclick="return store_subscriber_validate1('<?php echo $this->storeurl;?>');" value=""/>
                    <input type="hidden" name="subscriber_store_id" id="subscriber_store_id1" value="<?php echo $this->storeid;?>"/>
                </div>  
                <em id="email_subscriber_error1"></em>
            </div>
        </div>
    </div>    
</div>

<script>
function store_subscriber_validate1(store_url)
{
	var email = $("#store_subscriber1").val();
	var atpos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	var x=0;
	if(email == '') {
			$('.sub_cont_inner').css('border','1px solid red');
			x++;
		}
		else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
		{
			x++;
			$('.sub_cont_inner').css('border','1px solid red');
		}else {
			x=0;
			$('#email_subscriber_error1').html('');
		}
		if(x==0){
		var url= Path+'users/check_user_signup/?email='+email;
		$.post(url,function(check){
			if(check == -1){
				$('.sub_cont_inner').css('border','1px solid red');
				$("#store_subscriber1").val('');
				$("#store_subscriber1").attr('placeholder','<?php echo $this->Lang['EMAIL_EXIST']; ?>');
				return false;
			}
			add_store_email_subscriber(email,store_url);
			
		});
	}
	
}
function add_store_email_subscriber(email,store_url)
{
	var store_id=$("#subscriber_store_id1").val();
	var url= Path+'stores/user_subscriber_signup/?email='+email+'&store_id='+store_id+'&store_url='+store_url;
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,
		dataType:"html",
		success:function(check)
		{
			window.location.href=Path+store_url+'/';
			
		},
		error:function()
		{
			
		}
	});
}
function check_color(){
	$('.sub_cont_inner').css('border','none');
	$('.sub_cont_inner').css('border-bottom','2px solid #404040');
}
</script>

