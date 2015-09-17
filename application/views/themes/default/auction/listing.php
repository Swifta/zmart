<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

       <?php $i = 1; if(count($this->all_deals_list)>0){ ?>
                    <?php foreach( $this->all_deals_list as $deals){
                    $symbol = CURRENCY_SYMBOL;
                    $time = ($deals->enddate-time());
                    ?>
                    <?php if(888483 > $time ) { $closetime = $time*1000; ?>
                    <script type="text/javascript">
                    $(document).ready(function(){
                        setTimeout(function() {
                        $('#deallisting<?php echo $deals->deal_id; ?>').fadeOut('fast');
                        }, parseInt(<?php echo $closetime; ?>) );
                        setTimeout(function() {
                        $('#deallistinggallery<?php echo $deals->deal_id; ?>').fadeOut('fast');
                        }, parseInt(<?php echo $closetime; ?>) );
                        setTimeout(function() {
                        $('#deallistinglistview<?php echo $deals->deal_id; ?>').fadeOut('fast');
                        }, parseInt(<?php echo $closetime; ?>) );

                        setTimeout(callback, parseInt(<?php echo $closetime; ?>));
                        function callback()
                        {
							 //window.location.href = Path+"welcome/auction_winner/"+<?php echo $deals->deal_id; ?>;
                        }
                    });
                    </script>
                    <?php } ?>
<div class="product_listing  <?php if(($i%4) == 1){ ?>margin-left0<?php } ?>" id="<?php echo $i;?>">
	<div class="action_listing_image wloader_parent">
            <i class="wloader_img">&nbsp;</i>
                               
				<?php if($this->session->get('cate')!="") { ?> <?php $url=$this->session->get('cate'); ?> <?php } else { ?> <?php $url=$deals->category_url; ?>  <?php } ?>
				<?php
				$image=array();
								for($img_cnt=1;$img_cnt<=5;$img_cnt++)
									if(file_exists(DOCROOT . 'images/auction/1000_800/' . $deals->deal_key . '_'.$img_cnt. '.png'))
										$image[] = $img_cnt;
									?>
                              <?php 
                              if(count($image)>0){ 
								$image_url = PATH . 'images/auction/1000_800/' . $deals->deal_key . '_'.$image[0] . '.png';
								$size = getimagesize($image_url); ?>
								<div class="action_image_1">
									<a href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>">
									<?php if(($size[0] > AUCTION_LIST_WIDTH) && ($size[1] > AUCTION_LIST_HEIGHT)) { ?>
									<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/auction/1000_800/'.$deals->deal_key.'_'.$image[0].'.png'?>&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=<?php echo AUCTION_LIST_HEIGHT; ?>" alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" border="0" />
							<?php } else { ?>
                                 <img src="<?php echo PATH .'images/auction/1000_800/'.$deals->deal_key.'_'.$image[0].'.png'?>" />
                                <?php } ?> </a> </div>
					<?php if(isset($image[1]) && $image[1]!=''){
							$image_url = PATH . 'images/auction/1000_800/' . $deals->deal_key . '_'.$image[1] . '.png';
							$size = getimagesize($image_url); ?>
							<div class="action_image_2">
									<a href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>">
									<?php if(($size[0] > AUCTION_LIST_WIDTH) && ($size[1] > AUCTION_LIST_HEIGHT)) { ?>
										<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/auction/1000_800/'.$deals->deal_key.'_'.$image[1].'.png'?>&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=<?php echo AUCTION_LIST_HEIGHT; ?>" alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" border="0" />
									<?php } else { ?>
										 <img src="<?php echo PATH .'images/auction/1000_800/'.$deals->deal_key.'_'.$image[1].'.png'?>" />
										<?php } ?> </a> </div>
					<?php }else{ ?>
							<div class="action_image_2">
								<a href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_auctions_list.png&w=170&h=<?php echo AUCTION_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" border="0" /></a>
							</div>
						<?php }
					} else { ?>
						<div class="action_image_1">
							<a href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_auctions_list.png&w=170&h=<?php echo AUCTION_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" border="0" /></a>
						</div>
						<div class="action_image_2">
							<a href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_auctions_list.png&w=170&h=<?php echo AUCTION_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" border="0" /></a>
						</div>
					<?php }?>
					
					<?php /* if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png')){ 
					$image_url = PATH . 'images/auction/1000_800/' . $deals->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
					?>
						<a href="<?php echo PATH. $deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>">
						 <?php if(($size[0] > AUCTION_LIST_WIDTH) && ($size[1] > AUCTION_LIST_HEIGHT)) { ?>
							<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png'?>&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=<?php echo AUCTION_LIST_HEIGHT; ?>" alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" border="0" />
							   <?php } else { ?>
                                 <img src="<?php echo PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                
							 </a>
					<?php } else { ?>
						<a href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_auctions_list.png&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=<?php echo AUCTION_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" border="0" /></a>
					<?php }?>
                                </div>
                                <div class="action_image_2">
                                    <a href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_auctions_list.png&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=<?php echo AUCTION_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" border="0" /></a>
                                </div>*/?>

			</div>
			<div class="product_listing_detail">
				<h2><?php $type = ""; $categories = $deals->category_url; ?>
					<a class="cursor" href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title;?>"><?php echo substr(ucfirst($deals->deal_title),0,100);?></a>
				</h2>


			<div class="bid_cont">
				   <?php $q=0; foreach($this->all_payment_list as $payment){ ?>
					<?php if($payment->auction_id==$deals->deal_id){
							$firstname = $payment->firstname;
							$transaction_time = $payment->transaction_date;
							$q=1;
					}     } ?>
			  <?php if($q==0){ ?>
				<div class="bid_value">
					<label class="bidvalue_label">  <?php echo $this->Lang['LAST_BID']; ?> :</label>
					<span> <?php echo $this->Lang['NOT_YET_BID']; ?></span>
                                </div>
                                <div class="bid_value">
                                        <label><?php echo $this->Lang['BID_AMOUNT']; ?> :</label>
                                        <span><?php /* echo date("d-m-Y",$deals->enddate); */ ?><?php echo $symbol . " " . $deals->deal_value; ?>	</span>
                                </div>
			<?php } ?>
			
			<?php if($q==1){ ?>
				<div class="bid_value">
					<label class="bidvalue_label">  <?php echo $this->Lang['LAST_BID']; ?> :</label>
					<span> <?php echo $firstname; ?></span>
                                </div>
                                <div class="bid_value">
                                        <label><?php echo $this->Lang['LAST_BID_AMOUNT']; ?> :</label>
                                        <span><?php /* echo date("d-m-Y",$deals->enddate); */ ?><?php echo $symbol . " " . $deals->deal_price; ?>	</span>
                                </div>
			<?php } ?>
		</div>
                <div class="deal_timer">
                        <label><span time="<?php echo $deals->enddate; ?>" class="kkcount-down"></span></label>
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
            <li class="new_bid"><a  href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $this->Lang['BID_NOW1']; ?>"><?php // echo $this->Lang['BID_NOW1']; ?></a></li>
        </ul>
    </div>
</div>
</div>
<?php $i++; }?>
<?php if(($i%4) == 0){ ?>
      <?php /*  <div class="listingspliter"></div> */?>
        <?php } ?>


<?php }else { ?>
<?php //echo new View("themes/".THEME_NAME."/subscribe_new"); ?>
<div class="nodata_list_block">
        <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/sorry_icon.png" >
        <p> <?php echo $this->Lang['SORRY_NO_ITEM_TODAY']; ?></p>
</div>
<?php } ?>
