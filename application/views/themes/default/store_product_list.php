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
}?>
<?php if (count($this->all_products_list) > 0) { ?>  

	<?php
	$i = 1;
	foreach ($this->all_products_list as $products) {
	$symbol = CURRENCY_SYMBOL;
	$image=array();
	for($i=1;$i<=5;$i++)
	if(file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_'.$i. '.png'))
		$image[] = $i;
	?>
	
	<div class="new_prdt_listing">
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
		<div class="new_prdt_listing_details">
			<h2><a href="<?php echo PATH .$products->store_url_title. '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 100); ?></a></h2>
			<div class="new_price_details">
				<p><?php echo $symbol . " " . $products->deal_price; ?></p>
				<span><?php echo $symbol . " " . $products->deal_value; ?></span>
			</div>
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

	<?php } ?>

<?php }else{?>
<div class="no_product_found"><?php echo $this->Lang['NO_PRODUCTS'];?></div>
<?php }?>
