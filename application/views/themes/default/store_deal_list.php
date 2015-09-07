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
<?php
foreach ($this->all_deals_list as $deals_categories) {
	$symbol = CURRENCY_SYMBOL;
	?>
	<li>

		 <div class="product_listing ">
                <div class="deal_listing_image wloader_parent">
                    <i class="wloader_img">&nbsp;</i>
                    
                
		<?php if($this->session->get('cate')!="") { ?> <?php $url=$this->session->get('cate'); ?> <?php } else { ?> <?php $url=$deals_categories->category_url; ?>  <?php } ?>
		 <?php 
			$image=array();
			for($i=1;$i<=5;$i++)
				if(file_exists(DOCROOT . 'images/deals/1000_800/' . $deals_categories->deal_key . '_'.$i. '.png'))
					$image[] = $i;
			
			if(count($image)>0){ 
				$image_url = PATH . 'images/deals/1000_800/' . $deals_categories->deal_key . '_'.$image[0] . '.png';
				$size = getimagesize($image_url);?>
			<div class="deal_image_3">
				<a href="<?php echo PATH . $deals_categories->store_url_title.'/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $deals_categories->deal_title; ?>"> 
				<?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
				<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$deals_categories->deal_key.'_'.$image[0].'.png'?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>" alt="<?php echo $deals_categories->deal_title; ?>"   border="0" />
				<?php }else{?>
				 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals_categories->deal_key.'_'.$image[0].'.png'?>" alt="<?php echo $deals_categories->deal_title; ?>"   border="0" />
				<?php }?>
				</a>
			</div>
			<?php 
				if(isset($image[1]) && $image[1]!=''){
					$image_url = PATH . 'images/deals/1000_800/' . $deals_categories->deal_key . '_'.$image[1] . '.png';
					$size = getimagesize($image_url); ?>
					<div class="deal_image_4">
						<a href="<?php echo PATH . $deals_categories->store_url_title.'/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $deals_categories->deal_title; ?>"> 
					 <?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
						<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$deals_categories->deal_key.'_'.$image[1].'.png'?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>" alt="<?php echo $deals_categories->deal_title; ?>"   border="0" />
						<?php }else{?>
						 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals_categories->deal_key.'_'.$image[1].'.png'?>" alt="<?php echo $deals_categories->deal_title; ?>"   border="0" />
						<?php }?>
						</a>
					</div>
				<?php }else{ ?>
				<div class="deal_image_4">
						<a href="<?php echo PATH . $deals_categories->store_url_title.'/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $deals_categories->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals_categories->deal_title; ?>" title="<?php echo $deals_categories->deal_title; ?>" ></a>
				   </div>
				<?php }
			}else{ ?>
			 <div class="deal_image_3">
				<a href="<?php echo PATH . $deals_categories->store_url_title.'/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $deals_categories->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals_categories->deal_title; ?>" title="<?php echo $deals_categories->deal_title; ?>" ></a>
		   </div>
			 <div class="deal_image_4">
				<a href="<?php echo PATH . $deals_categories->store_url_title.'/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $deals_categories->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals_categories->deal_title; ?>" title="<?php echo $deals_categories->deal_title; ?>" ></a>
		   </div>
			<?php }?>   
                </div>
                    <div class="hot_label">
                        <p>OFF</p>
                        <p><?php echo round($deals_categories->deal_percentage); ?>%</p>
                    </div>
                <div class="product_listing_detail">
                    <h2>
			<?php $type = ""; $categories = $deals_categories->category_url; ?>
			<a class="cursor" href="<?php echo PATH . $deals_categories->store_url_title.'/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>"><?php echo substr(ucfirst($deals_categories->deal_title),0,100); ?></a>
			</h2>

                    <div class="deal_timer">
                            <label> <span time="<?php echo $deals_categories->enddate; ?>" class="kkcount-down" ></span></label>
                    </div>
                <div class="deal_listing_price_details">
                <strike><?php echo $symbol . " " . $deals_categories->deal_price; ?></strike> 
                <p><?php echo $symbol." ".$deals_categories->deal_value; ?></p>
                </div>
                
                </div>
            <div class="list_bottom">
                <div class="bottom_stars">
                <?php $avg_rating = $deals_categories->avg_rating;
				if($avg_rating!=''){
					$avg_rating = round($avg_rating); ?>
					<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
				<?php }else{?>
					<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
				<?php }?>
                </div>
                <div class="new_list_bottom_icons">
                    <ul>
                        <li class="new_cart"><a  href="<?php echo PATH .$deals_categories->store_url_title.'/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php // echo $this->Lang['BUY_NOW2']; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
	</li>
<?php } ?>
</ul>
<?php }else{?>
<div class="no_product_found"><?php echo $this->Lang['NO_DEALS'];?></div>
<?php }?>
