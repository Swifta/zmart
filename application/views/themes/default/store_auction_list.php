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
<?php if (count($this->all_auction_list) > 0) { ?>
<ul>
<?php
foreach ($this->all_auction_list as $deals1) {
	$symbol = CURRENCY_SYMBOL;
	?>			
	<li>

		<div class="product_listing auction_listing">
			<div class="product_listing_image wloader_parent">
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

			</div>
			<div class="product_listing_detail">
				<h2><?php $type = "";
$categories = $deals1->category_url;
?>
					<a class="cursor" href="<?php echo PATH .$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>"><?php echo substr(ucfirst($deals1->deal_title), 0, 100); ?></a>
				</h2>                                                                    

				<div class="bid_cont">

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

						<div class="bid_value">					
							<label class="bidvalue_label">  <?php echo $this->Lang['LAST_BID']; ?>:</label>
							<span><?php echo substr(ucfirst($firstname), 0, 10) . '..'; ?></span>
						</div>
						<div class="bid_value">					
							<label> <?php echo $this->Lang['BID']; ?>:</label>
<?php /* <span> <?php echo date("d-m-Y ", $transaction_time); ?><?php echo date("h:i A", $transaction_time); ?></span> */ ?>
							<span><?php echo $symbol . " " . $deals1->deal_value; ?>	</span>
						</div>


<?php } ?>
<?php if ($q == 0) { ?>
						<div class="bid_value">  



							<label class="bidvalue_label"> <?php echo $this->Lang['LAST_BID']; ?>  :</label>
							<span> <?php echo $this->Lang['NOT_YET_BID']; ?></span>
						</div>
						<div class="bid_value">    
							<label> <?php echo $this->Lang['CLOSE_T']; ?>:</label>
						<?php /* <span><?php echo date("d-m-Y", $deals1->enddate); ?><?php echo date("h:i A", $deals1->enddate); ?></span> */ ?>
							<span><?php echo $symbol . " " . $deals1->deal_price; ?></span>
						</div>	
<?php } ?>
					<div class="deal_list_time">
						<div class="time_price_lft">                                                                            
							<label><span time="<?php echo $deals1->enddate; ?>" class="kkcount-down" ></span></label>
						</div>
					</div>
					<a class="buy_it list_buy_it bid_it" href="<?php echo PATH .$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $this->Lang['BID_NOW1']; ?>"><?php echo $this->Lang['BID_NOW1']; ?></a>                                                                    

				</div>



			</div>
		</div> 
	</li>
<?php  } ?>
</ul>
<?php }else{?>
<div class="no_product_found"><?php echo $this->Lang['NO_AUC_FOUND'];?></div>
<?php }?>
