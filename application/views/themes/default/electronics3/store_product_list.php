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


			<?php if (count($this->all_products_list) > 0) { ?>  
			<ul>
			<?php
			$k = 1;
			foreach ($this->all_products_list as $products) {
				$symbol = CURRENCY_SYMBOL;?>
                                <li>

								<div class="store_pro_list">
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
                                      <a class="pro_title" style="font:<?php echo $font_size; ?> arial; <?php echo $font_color; ?>" href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 25)."..."; ?></a>
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
									</div>
									<div class="store_product_list_hover">
										<div class=" store_product_list_img_hover"></div> 
										<div class="store_product_list_detail white_bg">
										<a class="pro_title" style="font:<?php echo $font_size; ?> arial;<?php echo $font_color; ?>" href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 25)."..."; ?></a> 
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
<?php }else{?>
<div class="no_product_found"><?php echo $this->Lang['NO_PRODUCTS'];?></div>
<?php }?>


