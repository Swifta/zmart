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
}
?>
 
	<?php if (count($this->all_deals_list) > 0) { ?>                                    
		<ul>
			<?php $l = 1;
				foreach ($this->all_deals_list as $deals_categories) {
					$symbol = CURRENCY_SYMBOL;?>
						<li <?php if($l%4==0) { ?> class="margin_zero" <?php } ?>>
							<div class="store_pro_list">
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
										<a class="pro_title" style="font-size:<?php echo $font_size; ?> arial; <?php echo $font_color; ?>" href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo substr(ucfirst($deals_categories->deal_title), 0, 25) . "..."; ?>"><?php echo substr(ucfirst($deals_categories->deal_title), 0, 100) ; ?></a>
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
								</div>

							</div> 
						</li>
				<?php $l++; } ?>
		</ul>
<?php }else{?>
<div class="no_product_found"><?php echo $this->Lang['NO_DEALS'];?></div>
<?php }?>                   


