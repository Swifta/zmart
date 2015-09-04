<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
		<?php if(count($this->winner_list)>0){ ?>
						<?php  $deal_offset = $this->input->get('offset'); foreach($this->winner_list as $deals){ ?>
                            <div class="winner_listing">                                                                                                                                                 
                                <div class="product_listing_image winner_listing_image wloader_parent">
                                    <i class="wloader_img">&nbsp;</i>
                                    <?php  if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png')){ 
                                    
                                    $image_url = PATH . 'images/auction/1000_800/' . $deals->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                                    ?>
                                                                                    <a href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>">
                                           <?php if(($size[0] > AUCTION_LIST_WIDTH) && ($size[1] > AUCTION_LIST_HEIGHT)) { ?>
    <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png'?>&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=<?php echo AUCTION_LIST_HEIGHT; ?>" alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" />
    <?php } else { ?>
                                 <img src="<?php echo PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
    
    <?php /* <img src="<?php echo PATH.'images/auction/220_160/'.$deals->deal_key.'_1'.'.png';?>" alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" >*/ ?></a>
                                                                                    <?php } else { ?>
                                                                                    <a href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>">
    <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=<?php echo AUCTION_LIST_HEIGHT; ?>" alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" />
    <?php /*<img src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png" alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" >*/ ?></a>
                                                                                    <?php }?>
                                </div>                                                                                
                                <div class="product_listing_detail">
                                    <div class="bid_cont">
                                        <div class="bid_value">
                                            <label class="bidvalue_label"><?php echo $this->Lang['WINNERS3']; ?>  : </label>
                                            <span class="winner_art"><?php echo ucfirst($deals->firstname); ?></span> 
                                        </div>
                                    </div>
                                    <h2><a href="<?php echo PATH.$deals->store_url_title.'/auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo substr($deals->deal_title,0,40)."..";?>"><?php echo substr(ucfirst($deals->deal_title),0,100);?></a></h2>
                                    <div class="bid_cont">
                                        <div class="bid_value">
                                            <label><?php echo $this->Lang['RE_PRIC']; ?> : </label>
                                            <span> <?php echo CURRENCY_SYMBOL.$deals->product_value; ?></span>

                                        </div>
                                        <div class="bid_value">
                                            <label><?php echo $this->Lang['AUC_PRICE']; ?> :  </label>
                                            <span> <?php echo CURRENCY_SYMBOL.$deals->deal_value; ?></span>

                                        </div>
                                        <div class="bid_value">
                                            <label><?php echo $this->Lang['BID_AMO']; ?> :  </label>
                                            <span> <?php echo CURRENCY_SYMBOL." ".$deals->bid_amount; ?></span>
                                        </div>
                                    </div>
                                </div>                                                                    
                            </div>
                            
					   <?php } $deal_offset++; ?>
					<?php }else {?>
<p class="no_data"><?php echo $this->Lang['NO_DATA_F']; ?></p>
<?php } ?>
