<?php $i = 1; if(count($this->store_details) > 0){ ?>	
	<?php  foreach( $this->store_details as $stores){?>	
	 <div class="feture_deal_listing_1 <?php if(($i%4) == 1){ ?>store_nomargin<?php } ?>">                                    
                                    <div class="feture_mid_1">
                                        <div class="fetur_img wloader_parent">  
                                            <i class="wloader_img">&nbsp;</i>
                                        <?php  if(file_exists(DOCROOT.'images/merchant/600_370/'.$stores->merchant_id.'_'.$stores->store_id.'.png')){ ?>
          <a href="<?php echo PATH.$stores->store_url_title.'/';?>" >
<img src="<?php echo PATH .'images/merchant/600_370/'.$stores->merchant_id.'_'.$stores->store_id.'.png'?>" alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>"  />
<?php /* <img src="<?php echo PATH.'images/merchant/290_215/'.$stores->merchant_id.'_'.$stores->store_id.'.png';?>"   alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>"> */ ?></a>

          <?php } else { ?>
          <a href="<?php echo PATH.$stores->store_url_title.'/';?>" >
<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_stores_list.png&w=<?php echo STORE_LIST_WIDTH; ?>&h=<?php echo STORE_LIST_HEIGHT; ?>" alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>" />
<?php /* <img src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_stores_list.png"   alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>"  >*/ ?></a>

          <?php }?>                                                 
                                                                                             
                                        </div>
                                        <div class="feture_bot_det">
                                        <a class="bot_square" href="<?php echo PATH.$stores->store_url_title.'/';?>" title="<?php echo $stores->store_name; ?>"><?php echo substr(ucfirst($stores->store_name),0,100);?></a>
                                           
                                            <?php /* <p class="bot_square_text"><?php echo $stores->address1; ?></p>
                                           <p class="bot_square_text"><?php echo $stores->address2; ?> , <?php echo $stores->zipcode; ?></p> */ ?>
                                              <?php /**<p class="bot_square_text"><?php echo $this->Lang['PHONE']; ?>: <?php echo $stores->phone_number; ?></p> **/?>
                                                <div class="common_store_count1">        
                                                        <div class="common_store_count">
                                                                <p><?php echo $this->Lang['DEALS']; ?> : </p>
                                                                <b>
                                                                <?php 
                                                                $deal_stores = common::get_deal_count($stores->store_id,1);
                                                                if($deal_stores == '-'){
                                                                $deal_stores = 'N/A';
                                                                }
                                                                echo $deal_stores;  ?> 
                                                                </b>
                                                                </div> 
                                                                <div class="common_store_count">
                                                                <p><?php echo $this->Lang['PRODUCT']; ?> : </p>
                                                                <b> 
                                                                <?php 
                                                                $product_stores = common::get_deal_count($stores->store_id,2);
                                                                if($product_stores == '-'){
                                                                $product_stores = 'N/A';
                                                                }
                                                                echo $product_stores;  ?>
                                                                </b>
                                                                </div> 
                                                                <div class="common_store_count">
                                                                <p><?php echo $this->Lang['AUCTION']; ?> : </p>
                                                                <b> 
                                                                <?php 
                                                                $auction_stores = common::get_deal_count($stores->store_id,3);
                                                                if($auction_stores == '-'){
                                                                $auction_stores = 'N/A';
                                                                }
                                                                echo $auction_stores;  ?>
                                                                </b>
                                                        </div> 
                                                </div>
                                                <a class="buy_it list_buy_it" href="<?php echo PATH.$stores->store_url_title.'/';?>" title="<?php echo $this->Lang['VIEW_DETAILS']; ?>"><?php echo $this->Lang['VIEW_DETAILS']; ?></a> 
                                        </div>
                                    </div>                                    
                                </div>
				<?php $i++;  } ?>
				<?php  } else {?>
      <p class="no_data"><?php echo $this->Lang["NO_DATA_F"]; ?></p>
      <?php }?>
