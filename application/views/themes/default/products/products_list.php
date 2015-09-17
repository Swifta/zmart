<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php if (count($this->all_products_list) > 0) { ?>
<?php  $deal_offset = $this->input->get('offset');
$i = 1;
foreach ($this->all_products_list as $products) {
        $symbol = CURRENCY_SYMBOL;
         $image=array();
		for($i=1;$i<=5;$i++)
			if(file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_'.$i. '.png'))
				$image[] = $i;
?>
<div class="new_prdt_listing <?php if(($i%4) == 0){ ?>margin-right0<?php } ?>">
    <div class="new_prdt_listing_img wloader_parent">        
        <i class="wloader_img">&nbsp;</i>
       <?php if(count($image)>0){?>
			<div class="new_prdt_listing_img1">
				<a href="<?php echo PATH .$products->store_url_title. '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$products->deal_key.'_'.$image[0].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
			</div>
			<?php if(isset($image[1]) && $image[1]!=''){?>
			<div class="new_prdt_listing_img2">
			   <a href="<?php echo PATH .$products->store_url_title. '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$products->deal_key.'_'.$image[1].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
			</div>
			<?php }}else{?>
			 <div class="new_prdt_listing_img1">
				<a href="<?php echo PATH .$products->store_url_title. '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
			</div>
			<div class="new_prdt_listing_img2">
				<a href="<?php echo PATH .$products->store_url_title. '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
			</div>
			<?php }?>   
        </div>
        <?php $type = "products";
        $categories = $products->category_url; ?>
            <div class="new_prdt_listing_details">
                <h2><a href="<?php echo PATH .  $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 100) ; ?></a>                </h2>
<!--<h3><?php //echo substr(ucfirst(strip_tags($products->deal_description)), 0, 25) . ".."; ?></h3>-->
                <div class="new_price_details">
					<?php if($products->deal_price!=0) { ?>	
						<p><?php echo $symbol . "" . $products->deal_price; ?> </p>
						<span><?php echo $symbol . "" . $products->deal_value; ?></span>
					<?php } else  { ?>
						<p></p>
						<span><?php echo $symbol."".$products->deal_value; ?> </span>
					<?php } ?> 
                </div>                
                <?php /*<div class="product_view_detail">
                     <a href="<?php echo PATH .  $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"></a>
                 </div> */ ?>
                <?php  if (isset($this->sub_cat) && ($this->sub_cat != "")) {    // for product comparision
                $checked = "";
                $compare = $this->session->get("product_compare");
                if (is_array($compare) && count($compare) && (in_array($products->deal_id, $compare))) {
                $checked = "checked";
                } ?>
               <?php /* <p class="compare_check"><input type="checkbox" name="add_to_comp" <?php echo $checked; ?> onclick="addToCompare('<?php echo $products->deal_id; ?>', this,'list')" data-added="" data-unadded="0" >
                    <span><?php echo $this->Lang['ADD_COMPARE']; ?></span>
                </p>*/?>
                <?php } ?>
            </div>
            <div class="new_list_bottom">
                <div class="new_list_bottom_stars">
                   <?php $avg_rating = $products->avg_rating;
						if($avg_rating!=''){
							$avg_rating = round($avg_rating); ?>
							<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
						<?php }else{?>
							<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
						<?php }?>
                </div>
                <div class="new_list_bottom_icons">
                    <ul>
                        <li class="new_wishlist"><a onclick="addToWishList('<?php echo $products->deal_id; ?>','<?php echo addslashes($products->deal_title); ?>');" title="<?php echo $this->Lang['ADD_WISH_LIST'];?>"></a></li>
                        <li class="new_compare"> <a onclick="addToCompare('<?php echo $products->deal_id; ?>','','detail');" title="<?php echo $this->Lang['ADD_COMPARE']; ?>"></a></li>
                        <li class="new_cart"><a href="<?php echo PATH .$products->store_url_title. '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART'];?>"></a></li>
                    </ul>
                </div>
            </div>        
        </div>
        <?php if(($i%4) == 0){ ?>
        <?php /*<div class="listingspliter"></div> */ ?>
        <?php } ?>
    <?php $i++; } $deal_offset++; } else { ?>
<?php //echo new View("themes/".THEME_NAME."/subscribe_new"); ?>
<div class="nodata_list_block">
        <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/sorry_icon.png" >
        <p> <?php echo $this->Lang['SORRY_NO_ITEM_TODAY']; ?></p>
</div>

<?php } ?>
