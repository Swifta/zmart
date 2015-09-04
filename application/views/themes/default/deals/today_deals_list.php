<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>				
<?php if (count($this->all_deals_list) > 0) { ?>
<?php   $deal_offset = $this->input->get('offset');
$ii = 1;  foreach ($this->all_deals_list as $deals) {
if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) {  } else {
        $symbol = CURRENCY_SYMBOL; ?>
        <div class="product_listing <?php if(($ii%4) == 1){ ?>margin-left0<?php } ?>">
                <div class="deal_listing_image wloader_parent">
                    <i class="wloader_img">&nbsp;</i>
                    
                
		<?php if($this->session->get('cate')!="") { ?> <?php $url=$this->session->get('cate'); ?> <?php } else { ?> <?php $url=$deals->category_url; ?>  <?php } ?>
		 <?php 
			$image=array();
			for($i=1;$i<=5;$i++)
				if(file_exists(DOCROOT . 'images/deals/1000_800/' . $deals->deal_key . '_'.$i. '.png'))
					$image[] = $i;
			
			if(count($image)>0){ 
				$image_url = PATH . 'images/deals/1000_800/' . $deals->deal_key . '_'.$image[0] . '.png';
				$size = getimagesize($image_url);?>
			<div class="deal_image_3">
				<a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"> 
				<?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
				<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_'.$image[0].'.png'?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>" alt="<?php echo $deals->deal_title; ?>"   border="0" />
				<?php }else{?>
				 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_'.$image[0].'.png'?>" alt="<?php echo $deals->deal_title; ?>"   border="0" />
				<?php }?>
				</a>
			</div>
			<?php 
				if(isset($image[1]) && $image[1]!=''){
					$image_url = PATH . 'images/deals/1000_800/' . $deals->deal_key . '_'.$image[1] . '.png';
					$size = getimagesize($image_url); ?>
					<div class="deal_image_4">
						<a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"> 
					 <?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
						<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_'.$image[1].'.png'?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>" alt="<?php echo $deals->deal_title; ?>"   border="0" />
						<?php }else{?>
						 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_'.$image[1].'.png'?>" alt="<?php echo $deals->deal_title; ?>"   border="0" />
						<?php }?>
						</a>
					</div>
				<?php }else{ ?>
				<div class="deal_image_4">
						<a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>
				   </div>
				<?php }
			}else{ ?>
			 <div class="deal_image_3">
				<a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>
		   </div>
			 <div class="deal_image_4">
				<a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>
		   </div>
			<?php }?>   
                    <?php /*if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals->deal_key . '_1' . '.png')) { 
                      $image_url = PATH . 'images/deals/1000_800/' . $deals->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                    ?>
                        <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>">
                        <?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png'?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" > 
                        <?php } else { ?>
                                 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>
        <?php } ?>
                    </div>
                    <div class="deal_image_2">
                         <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>
                    </div>*/?>
                </div>
                    <div class="hot_label">
                        <p>OFF</p>
                        <p><?php echo round($deals->deal_percentage); ?>%</p>
                    </div>
                <div class="product_listing_detail">
                    <h2>
			<?php $type = ""; $categories = $deals->category_url; ?>
			<a class="cursor" href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>"><?php echo substr(ucfirst($deals->deal_title),0,100); ?></a>
			</h2>

                    <div class="deal_timer">
                            <label> <span time="<?php echo $deals->enddate; ?>" class="kkcount-down" ></span></label>
                    </div>
                <div class="deal_listing_price_details">
                <strike><?php echo $symbol . " " . $deals->deal_price; ?></strike> 
                <p><?php echo $symbol." ".$deals->deal_value; ?></p>
                </div>
                
                </div>
            <div class="list_bottom">
                <div class="bottom_stars">
                <?php $avg_rating = $deals->avg_rating;
				if($avg_rating!=''){
					$avg_rating = round($avg_rating); ?>
					<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
				<?php }else{?>
					<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
				<?php }?>
                </div>
                <div class="new_list_bottom_icons">
                    <ul>
                        <li class="new_cart"><a  href="<?php echo PATH .$deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php // echo $this->Lang['BUY_NOW2']; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if(($ii%4) == 0){ ?>
     <?php /*   <div class="listingspliter"></div> */?>
        <?php } ?>
    <?php  $ii ++; }  } ?>
<?php } else { ?>
<?php //echo new View("themes/".THEME_NAME."/subscribe_new"); ?>
<div class="nodata_list_block">
        <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/sorry_icon.png" >
        <p> <?php echo $this->Lang['SORRY_NO_ITEM_TODAY']; ?></p>
</div>
<?php } ?>
