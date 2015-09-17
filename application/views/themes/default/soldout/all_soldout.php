<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
        <!--Carousel Script-->
        <script src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/js/jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#mycarousel2').jcarousel({
                    wrap: 'circular'
                });
            });
        </script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#mycarousel5').jcarousel({
                    wrap: 'circular'
                });
            });
        </script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#mycarousel6').jcarousel({
                    wrap: 'circular'
                });
            });
        </script>
        <div class="contianer_outer1">
            <div class="contianer_inner">
                <div class="contianer">
                    <div class="bread_crumb">
                        <ul>
                            <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                            <li><p><?php echo $this->Lang['SOLD_OUT2']; ?></p></li>
                        </ul>
                    </div>
                <!--content start-->
                <!--div class="common_ner_commont1">
                <div class="common_ner_commont">                    
                <h2><?php echo $this->Lang['PRODUCTS']; ?> <span class="right_top_ae">&nbsp; </span></h2>
                </div>
                </div-->                    
            <div class="store_lists_block">
                    <!--   my carousel2  -->
                    <?php  if($this->product_setting){ ?>
                    <?php if(count($this->get_sold_products)>0){ ?>
                    <div class="store_slide_list clearfix">
                            <h2 class="inner_commen_title"><?php echo $this->Lang['PRODUCTS']; ?></h2>                                                                
                            <div class="default_rel_pro">
                                <ul <?php if(count($this->get_sold_products)>5){ ?> id="mycarousel2" class=" jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>
                                <?php  foreach( $this->get_sold_products as $p){
					$symbol = CURRENCY_SYMBOL; 
					?>
                                    <li>
                                        <div class="product_listing">
                                            <div class="deal_listing_image wloader_parent">
                                                <i class="wloader_img">&nbsp;</i>
                                    <?php  if(file_exists(DOCROOT.'images/products/1000_800/'.$p->deal_key.'_1'.'.png')){ 
                                    $image_url = PATH . 'images/products/1000_800/' . $p->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                                    ?>
					<a href="<?php echo PATH.$p->store_url_title.'/product/'.$p->deal_key.'/'.$p->url_title.'.html';?>" title="<?php echo $p->deal_title; ?>">
					
					<?php if(($size[0] > 173) && ($size[1] > 152)) { ?>
<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$p->deal_key.'_1'.'.png'?>&w=173&h=252" alt="<?php echo $p->deal_title; ?>" title="<?php echo $p->deal_title; ?>" border="0" />

<?php } else { ?>
                                 <img src="<?php echo PATH .'images/products/1000_800/'.$p->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
<?php /*<img src="<?php echo PATH.'images/products/290_215/'.$p->deal_key.'_1'.'.png';?>" alt="<?php echo $p->deal_title; ?>"   border="0" />*/ ?></a>
					<?php } else { ?>
					<a href="<?php echo PATH.$p->store_url_title.'/product/'.$p->deal_key.'/'.$p->url_title.'.html';?>" title="<?php echo $p->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=173&h=252" alt="<?php echo $p->deal_title; ?>" /></a>
					<?php  }?>                                             
                                        <a class="sold_out_bt"><?php echo $this->Lang['SOLD_OUT2']; ?></a>
                                         </div>
                                            <div class="product_listing_detail">
                                               <?php /** <h2>Electronics</h2> **/ ?>
                                                <h2><a href="<?php echo PATH.$p->store_url_title.'/product/'.$p->deal_key.'/'.$p->url_title.'.html';?>" title="<?php echo $p->deal_title; ?>"><?php echo substr(ucfirst($p->deal_title),0,100); ?></a></h2>
                                            </div>
                                        </div> 
                                    </li>
                                    <?php }?>
                                </ul>
                            </div>                                                
                            </div>
                    <?php }  } ?>                    
                    <!--   my carousel3  -->                                        
                        <?php if ($this->deal_setting) { ?>
                            <?php if (count($this->get_sold_deals) > 0) { ?>
                                <div class="store_slide_list clearfix">  
                                <h2 class="inner_commen_title"><?php echo $this->Lang['DEALS']; ?> </h2>                            
                                <div class="slider_wrap">
                                <ul <?php if(count($this->get_sold_deals)>4){ ?> id="mycarousel5" class=" jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>
                                <?php  foreach( $this->get_sold_deals as $d){
						if (($d->maximum_deals_limit <= $d->purchase_count) || ($d->enddate < time())) {
						        $symbol = CURRENCY_SYMBOL; 
			                 	?>
                                    <li>
                                        <div class="product_listing">
                                                <div class="deal_listing_image wloader_parent">
                                                    <i class="wloader_img">&nbsp;</i>
                                <?php if(file_exists(DOCROOT.'images/deals/1000_800/'.$d->deal_key.'_1'.'.png')){ 
                                 $image_url = PATH . 'images/deals/1000_800/' . $d->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                                ?>
					<a href="<?php echo PATH.$d->store_url_title.'/deals/'.$d->deal_key.'/'.$d->url_title.'.html';?>" title="<?php echo $d->deal_title; ?>">
					 <?php if(($size[0] > 173) && ($size[1] > 252)) { ?>
<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$d->deal_key.'_1'.'.png'?>&w=173&h=252" alt="<?php echo $d->deal_title; ?>" title="<?php echo $d->deal_title; ?>" border="0" />
                                <?php } else { ?>
                                 <img src="<?php echo PATH .'images/deals/1000_800/'.$d->deal_key.'_1'.'.png'?>" />
                                <?php } ?>

<?php /* <img src="<?php echo PATH.'images/deals/220_160/'.$d->deal_key.'_1'.'.png' ?>"  alt="<?php echo $d->deal_title; ?>" title="<?php echo $d->deal_title; ?>" border="0" />*/ ?></a>
				<?php } else { ?>
					<a href="<?php echo PATH.$d->store_url_title.'/deals/'.$d->deal_key.'/'.$d->url_title.'.html';?>" title="<?php echo $d->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=173&h=252"  alt="<?php echo $d->deal_title; ?>" title="<?php echo $d->deal_title; ?>" border="0" /></a>
				<?php }?>
                                                    <a class="sold_out_bt"><?php echo $this->Lang['SOLD_OUT2']; ?></a>                                                    
                                                </div>
                                                <div class="product_listing_detail">
                                                    <h2><a href="<?php echo PATH.$d->store_url_title.'/deals/'.$d->deal_key.'/'.$d->url_title.'.html';?>" title="<?php echo $d->deal_title; ?>"><?php echo substr(ucfirst($d->deal_title),0,100); ?></a></h2>
                                                </div>
                                        </div> 
                                    </li>
                                 <?php } } ?>     
                                </ul>
                            </div>                        
                        </div>                   
                        <?php }  } ?>
                    <!--   my carousel4  -->  
             <?php  if($this->auction_setting){ ?>
            <?php if(count($this->get_sold_auction)>0){ ?>
                    <div class="store_slide_list clearfix">   
                    <h2 class="inner_commen_title"><?php echo $this->Lang['AUCTION']; ?> </h2>                                            
                    <div class="slider_wrap">
                        <ul <?php if(count($this->get_sold_auction)>4){ ?> id="mycarousel6" class=" jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>
                        <?php  foreach( $this->get_sold_auction as $d){
                                                        $symbol = CURRENCY_SYMBOL; 
                                            ?>
                            <li>
                                <div class="product_listing">
                                    <div class="deal_listing_image wloader_parent">
                                        <i class="wloader_img">&nbsp;</i>
                                           <?php if(file_exists(DOCROOT.'images/auction/1000_800/'.$d->deal_key.'_1'.'.png')){
                                           $image_url = PATH . 'images/auction/1000_800/' . $d->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                                            ?>
                                                                <a href="<?php echo PATH.$d->store_url_title.'/auction/'.$d->deal_key.'/'.$d->url_title.'.html';?>" title="<?php echo $d->deal_title; ?>">
                                                                 <?php if(($size[0] > 173) && ($size[1] > 252)) { ?>
<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/auction/1000_800/'.$d->deal_key.'_1'.'.png'?>&w=173&h=252" alt="<?php echo $d->deal_title; ?>" title="<?php echo $d->deal_title; ?>" border="0" />
                                <?php } else { ?>
                                 <img src="<?php echo PATH .'images/auction/1000_800/'.$d->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
</a>
                                                                <?php } else { ?>
                                                                <a href="<?php echo PATH.$d->store_url_title.'/auction/'.$d->deal_key.'/'.$d->url_title.'.html';?>" title="<?php echo $d->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=173&h=252"  alt="<?php echo $d->deal_title; ?>" title="<?php echo $d->deal_title; ?>" border="0" /></a>
                                                                <?php }?> 
                                       <a class="sold_out_bt"><?php echo $this->Lang['SOLD_OUT2']; ?></a>
                                    </div>
                                    <div class="product_listing_detail">
                                        <h2><a href="<?php echo PATH.$d->store_url_title.'/auction/'.$d->deal_key.'/'.$d->url_title.'.html';?>" title="<?php echo $d->deal_title; ?>"><?php echo substr(ucfirst($d->deal_title),0,100); ?></a></h2>
                                    </div>
                                </div> 
                            </li>
                            <?php }?> 
                        </ul>
                    </div>
                </div>
                </div>
   <?php }  } ?>
   <!--end-->
       </div>
       </div>         
    <?php if((count($this->get_sold_products)==0) && (count($this->get_sold_auction)==0) && (count($this->get_sold_deals)==0)) { ?>
		<?php echo new View("themes/" . THEME_NAME . "/subscribe"); ?>
		<?php  }  ?>
          </div>
     </div>
</div>
