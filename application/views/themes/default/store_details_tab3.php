<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery(1).js"  type="text/javascript"></script>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#messagedisplay1').hide();
    });
</script>
<!--Carousel Script-->
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/tabs.js"></script>
<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#mycarousel20').jcarousel({
            wrap: 'circular'
        });
    });

</script>  

<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#mycarousel12').jcarousel({
            wrap: 'circular'
        });
    });

</script>
<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#mycarousel10').jcarousel({
            wrap: 'circular'
        });
    });

</script>
<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#mycarousel11').jcarousel({
            wrap: 'circular'
        });
    });

</script>
<!--Carousel Script-->
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/tabs.js"></script>
  <?php if (count($this->get_top_selling_product_categories) > 0) { ?>  
<div class="store_page_listing">
                <div class="product_list_inner">
                  
                        <?php if ($this->product_setting) { ?>                                                                            
                            <?php if (count($this->get_top_selling_product_categories) > 0) { ?>
                    <div class="related_product_list clearfix">
                        <div class="title_outer">
                            <h2 class="title_inner2"><?php echo $this->Lang['RE_PRO']; ?></h2>  
                        </div>                        
                                
                            <?php } ?>                                        
                            <div class="slider_wrap">
                                    <ul  <?php if (count($this->get_top_selling_product_categories) > 4) { ?> id="mycarousel12" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>                         
                                        <?php
                                        $i = 1;
                                        foreach ($this->get_top_selling_product_categories as $products) {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>
                                            <li <?php if (count($this->get_top_selling_product_categories) < 5) { ?> <?php if($i==4) { ?> class="margin_zero" <?php } ?> <?php } else { ?> <?php } ?>>

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
                                                            <a  href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"  alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>"></a>
                                                        <?php } ?>                                                            
                                                    </div>

                                                    <div class="store_product_list_detail">
                                                        <a class="pro_title"  style="font:<?php echo $font_size; ?> arial; <?php echo $font_color; ?>" href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 100); ?></a>
                                                        <!--<h3><a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo substr(ucfirst(strip_tags($products->deal_description)), 0, 20) . '...'; ?>"><?php echo substr(ucfirst(strip_tags($products->deal_description)), 0, 25) . '...'; ?></a></h3>-->
                                                            <?php /* <p> <?php echo $symbol . " " . $products->deal_price; ?> <?php echo CURRENCY_CODE; ?></p> */ ?>
                                                        <p style="font:18px arial;color:#000;"><?php echo $symbol . " " . $products->deal_value; ?> <?php echo CURRENCY_CODE; ?> </p>                                                       
                                                        <?php /*<div class="store_add_to_cart">
                                                            <a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php echo $this->Lang['ADD_TO_CART']; ?></a>                                                                     
                                                        </div> */ ?>
                                                    </div>
                                                    <div class="store_product_list_hover">
                                                        <div class=" store_product_list_img_hover"></div> 
                                                        <div class="store_product_list_detail white_bg">
                                                        <a class="pro_title" style="font:<?php echo $font_size; ?> arial;<?php echo $font_color; ?>" href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 100); ?></a> 
                                                        <div class="green_cart_outer">
                                                        <a class="green_cart" href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php echo $this->Lang['ADD_TO_CART']; ?></a>                                                                    
                                                        </div>
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
<?php }else{
				$symbol = CURRENCY_SYMBOL; ?> 
            <div class="empty_product">
                <div class="title_outer">
                    <h2 class="title_inner2"><?php echo $this->Lang['RE_PRO']; ?></h2>  
                </div>  
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
            </div>
            <?php }?>
            
 <?php if (count($this->get_top_sellingdeals_categories) > 0) { ?>
            <div class="store_page_listing">
                <div class="product_list_inner">
                                                                                            
                        <?php if (($this->deal_setting)) { ?>
                            <?php $j=1; if (count($this->get_top_sellingdeals_categories) > 0) { ?>
                    <div class="related_product_list clearfix"> 
                        <div class="title_outer">
                            <h2 class="title_inner2"><?php echo $this->Lang['FEAT_DEALS']; ?> </h2>  
                        </div>  
                            <?php } ?>                                                                        
                            <div class="slider_wrap">                                
                                    <ul  <?php if (count($this->get_top_sellingdeals_categories) > 4) { ?> id="mycarousel10" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>
                                        <?php
                                        foreach ($this->get_top_sellingdeals_categories as $deals_categories) {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>
                                            <li <?php if (count($this->get_top_sellingdeals_categories) < 5) { ?> <?php if($j==4) { ?> class="margin_zero" <?php } ?> <?php } else { ?> <?php } ?>>
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
                                                            <a style="font:<?php echo $font_size; ?>  arial;<?php echo $font_color; ?> " href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo substr(ucfirst($deals_categories->deal_title), 0, 25) . "..."; ?>"><?php echo substr(ucfirst($deals_categories->deal_title), 0, 100) ; ?></a>
                                                                                                                           
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
                                    <?php $j++; } ?>
                                    </ul>
                           
                            </div>
                                </div>
                                 <?php } ?>
                </div>                 
            </div>
              <?php }else{ ?>     
			<div class="empty_deals">
                <div class="title_outer">
                    <h2 class="title_inner2"><?php echo $this->Lang['FEAT_DEALS']; ?> </h2>  
                </div>  
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
            </div>
            <?php }?>
                
                
            
           
          
                    
                    
		
