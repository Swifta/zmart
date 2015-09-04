<script type="text/javascript">
    $(document).ready(function(){
        $('#messagedisplay1').hide();
        $('.error_size').hide();
        $('.error_color').hide();
        $('.error_all').hide();

        if($('#messagedisplay')){
            $('#messagedisplay').animate({opacity: 1.0}, 8000)
            $('#messagedisplay').fadeOut('slow');
        }

        if($('#error_messagedisplay')){
            $('#error_messagedisplay').animate({opacity: 1.0}, 8000)
            $('#error_messagedisplay').fadeOut('slow');
        }

    });
</script>


<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/css/jquery.jcarousel.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/css/skin.css" media="all">
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js "></script>
<script src="<?php echo PATH; ?>js/magiczoomplus.js" type="text/javascript"></script>
<script src="<?php echo PATH; ?>js/magicscroll.js" type="text/javascript"></script>
<link href="<?php echo PATH; ?>/css/magiczoomplus.css" rel="stylesheet" type="text/css" />
<link href="<?php echo PATH; ?>/css/magicscroll.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
    $(document).ready(function () {

        //jCarousel Plugin
        $('#carousel').jcarousel({
            horizontal: true,
            scroll: 1,
            auto: 2,
            wrap: 'last',
            initCallback: mycarousel_initCallback
        });
    });

    //Carousel Tweaking

    function mycarousel_initCallback(carousel) {
        carousel.clip.hover(function() {
            carousel.stopAuto();
        }, function() {
            carousel.startAuto();
        });
    }

</script>
<?php
foreach ($this->product_deatils as $products) {
    $symbol = CURRENCY_SYMBOL;
    ?>
    <div class="contianer_outer1">
        <div class="contianer_inner">
            <div class="contianer">

                <!--header start-->
                <div class="bread_crumb">
                    <ul>
                        <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                        <li><p><a href="<?php echo PATH; ?>products.html" title="<?php echo $this->Lang['PRODUCTS']; ?>"><?php echo $this->Lang["PRODUCTS"]; ?></a></p></li>

                        <li><p><?php echo ucfirst($products->deal_title); ?></p></li>
                    </ul>
                </div>
                <!--end-->	<div  id="messagedisplay1" style="display:none;">
                    <div class="session_wrap">
                        <div class="session_container">
                            <div class="success_session">
                                <p><span ><?php echo $this->Lang['COMM_POST_SUCC']; ?>.</span></p>
                                <div class="close_session_2">
                                    <a class="closestatus cur" title="<?php echo $this->Lang['CLOSE']; ?>"  onclick="return closeerr();" >&nbsp;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--content start-->
                <div class="product_detail_block">
                    <div class="deal_content product_content">
                        <div class="product_image wloader_parent">
                               <i class="wloader_img" style="min-height: 300px;">&nbsp;</i>           

                            <div class="product_image_inner">
                                <?php $image_count = "";
                                for ($i = 1; $i <= 5; $i++) { ?>
                                    <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png')) {
                                        $image_count +=1;
                                    }
                                } ?>
                                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                                        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png')) { ?>

                                            <?php break;
                                        }
                                    } if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png')) {     +
                                     $image_url = PATH . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png';
                                $size = getimagesize($image_url);  ?>
                                <a href="<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png'; ?>" class="MagicZoomPlus" id="Zoomer3" rel="zoom-position: inner; selectors-change: mouseover; selectors-mouseover-delay:70; selectors-effect: fade" title="">
                                    <?php if(($size[0] > PRODUCT_DETAIL_WIDTH) && ($size[1] > PRODUCT_DETAIL_HEIGHT)) { ?>
                                        <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png' ?>&w=<?php echo PRODUCT_DETAIL_WIDTH; ?>" />
                                        <?php } else { ?>
                                          <img src="<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png' ?>" />
                                        <?php } ?>
                                    <?php /* <img src="<?php echo PATH.'images/products/1000_700/'.$products->deal_key.'_'.$i.'.png';?>"/> */ ?></a>
        <?php if ($products->purchase_count >= $products->user_limit_quantity) { ?>
                                        <div class="should_out_images">
                                            &nbsp;
                                        </div>
        <?php } ?>
                                <?php } else { ?>

                                    <a href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_details.png" class="MagicZoomPlus" id="Zoomer3" rel="zoom-position: inner; selectors-change: mouseover; selectors-mouseover-delay:70; selectors-effect: fade" title=""><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_details.png&w=<?php echo PRODUCT_DETAIL_WIDTH; ?>"/></a>
                                    <?php if ($products->purchase_count >= $products->user_limit_quantity) { ?>
                                        <div class="should_out_images">
                                            &nbsp;
                                        </div>
        <?php } ?>
                                    <?php } ?>                                    
                                    <?php $k=0; if(file_exists(DOCROOT.'images/products/1000_800/'.$products->deal_key.'_1.png')){ ?>
										<?php for($i=1; $i<=5; $i++){
											if(file_exists(DOCROOT.'images/products/1000_800/'.$products->deal_key.'_'.$i.'.png')){
									?>
								<?php $k++; } } } ?>
                                                                   <?php if($k>1){ ?>
								<span <?php if($k>3){ ?>class="MagicScroll" id="ZoomScroll" <?php } ?>>
									<?php if(file_exists(DOCROOT.'images/products/1000_800/'.$products->deal_key.'_1.png')){ ?>
										<?php for($i=1; $i<=5; $i++){
											if(file_exists(DOCROOT.'images/products/1000_800/'.$products->deal_key.'_'.$i.'.png')){
											  $image_url = PATH . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png';
                                                                                        $size = getimagesize($image_url);  
									?>
									<?php if(($size[0] > PRODUCT_DETAIL_WIDTH) && ($size[1] > PRODUCT_DETAIL_HEIGHT)) { ?>
										<a href="<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png'; ?>" rel="zoom-id:Zoomer3" rev="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png'; ?>&w=<?php echo PRODUCT_DETAIL_WIDTH; ?>" title="">
                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png' ?>&w=<?php echo PRODUCT_THUMB_WIDTH; ?>&h=<?php echo PRODUCT_THUMB_HEIGHT; ?>" />
                <?php /* <img src="<?php echo PATH.'images/products/100_100/'.$products->deal_key.'_'.$i.'.png';?>"/> */ ?></a>
                
                                                                        <?php } else { ?>
                                                                        <a href="<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png'; ?>" rel="zoom-id:Zoomer3" rev="<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png'; ?>" title="">
                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_' . $i . '.png' ?>&w=<?php echo PRODUCT_THUMB_WIDTH; ?>&h=<?php echo PRODUCT_THUMB_HEIGHT; ?>" /></a>
                                                                        <?php } ?>
										<?php } } ?>
									<?php } ?>
								</span>
								<?php } ?>

                            </div>


                        </div>
                        <div class="deal_info product_info">
                            <h2 class="deal_title"><?php echo ucfirst($products->deal_title); ?></h2>
                            <div class="deal_buy_detail clearfix">
                                <div class="clearfix">
                                    <div class="deal_rating">

                                        <link href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/css/jRating.jquery.css" rel="stylesheet" type="text/css"/>
                                        <script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jRating.jquery.js"></script>

                                        <script type="text/javascript">
                                            $(document).ready(function(){
                                                $(".basic<?php echo $products->deal_id; ?>").jRating({
                                                    bigStarsPath : '<?php echo PATH; ?>/images/star_03.png', // path of the icon stars.png
                                                    smallStarsPath : '<?php echo PATH; ?>/images/small.png', // path of the icon small.png
                                                    phpPath : '<?php echo PATH; ?>product-rating.html', // path of the php file jRating.php
                                                    length : 5,
                                                    rateMax : 5,
                                                    step:true,

                                                    //decimalLength:1,
                                                    showRateInfo: false,
                                                    canRateAgain : true,
                                                    nbRates : 10,
                                                    onError : function(){
                                                        //$('.jStar').css({backgroundColor: 'white'});
                                                        showlogin();
                                                    }
                                                });
                                            });
                                        </script>


                                        <label class="basic<?php echo $products->deal_id; ?>" id="<?php echo $this->avg_rating; ?>" title="<?php echo $this->avg_rating; ?> / 5">
                                            <!--
                                                    Check the images folder for 'black_star.png' and 'white_star.png'
                                            -->
                                        </label>
                                        <span><?php echo $this->sum_rating; ?> <?php echo $this->Lang['RATINGS']; ?></span>


                                    </div>
                                    <ul class="product_compare_link">
                                        <li>
                                            <a class="buy_it_fr add_compare_icon" onclick="addToCompare('<?php echo $products->deal_id; ?>','','detail');" title="<?php echo $this->Lang['ADD_COMPARE']; ?>"><?php echo $this->Lang['ADD_COMPARE']; ?></a>
                                        </li>
                                        <li>|</li>
                                        <li>
                                            <a class="buy_it_fr add_wish_icon" onclick="addToWishList('<?php echo $products->deal_id; ?>','<?php echo addslashes($products->deal_title); ?>');" title="<?php echo $this->Lang['ADD_WISH_LIST']; ?>"><?php echo $this->Lang['ADD_WISH_LIST']; ?></a>
                                        </li>
                                         <?php /* $this->gift_list=$this->products->get_gift_list($products->merchant_id);?>
                                        <?php if(count($this->gift_list)){?>
                                        <?php if ($this->session->get('UserID')&& $this->session->get('prime_customer')==1) { ?>
                                        <li>|</li>
                                        <li>
                                            <a class="buy_it_fr add_wish_icon"  id="someelemtax" title=""><?php echo $this->Lang['GIFT']; ?></a>
                                            
                                        </li>
                                        <?php }} */?>
                                    </ul>
                                </div>
                                
									 <?php /*if ($this->session->get('UserID')&& $this->session->get('prime_customer')==1 && $products->bulk_discount_buy!=0) { ?>
									 <div class="new_offer_shw">
											<h2><?php echo $this->Lang['OFFER'];?></h2>
											<p><?php echo $this->Lang['BUY_ONE']. "  ".$products->bulk_discount_buy."  ".$this->Lang['GET']."  ".$products->bulk_discount_get;?></p>
									 </div>									 
									 <?php }*/ ?>
									 
									 
                                <div class="clearfix">
                                            <?php if (count($this->product_size) > 0) { ?>
                                                <?php
                                                $c = 0;
                                                foreach ($this->product_size as $size) {
                                                    if ($size->size_name == "None") {
                                                        $nosize = 1;
                                                    } else {
                                                        $c = 1;
                                                        break;
                                                    }
                                                }
                                                ?>
                                                <?php if ($c != 0) { ?>
                                            <div class="choose_your_size">
                                                <h3 class="select_color_title"><?php echo $this->Lang['CHOO_Y_SIZE']; ?></h3>

                                                <ul>
            <?php $nosize = "";
            foreach ($this->product_size as $size) { ?>
                              <?php if ($size->quantity != 0) { ?><li  class="size_<?php echo $size->size_id; ?> <?php if ($size->quantity != 0) {
                                            if ($this->session->get('product_size_qty' . $products->deal_id) == $size->size_id) { ?> act <?php }
                                        } ?>" ><a onclick="select_size('<?php echo $size->size_id; ?>', '<?php echo $products->deal_id; ?>', '<?php echo $size->quantity; ?>');" > <?php echo $size->size_name; ?> </a></li> <?php } else { ?><li><a class="sold_out" > <?php echo $size->size_name; ?> </a></li><?php }
                                } ?>

                                                </ul>
                                            </div>
        <?php } ?>
    <?php } ?>

    <?php $color_count = 0;
    if (count($this->product_color) > 0) {
        $color_count = 1; ?>
                                        <div class="chose_color">
                                            <h3 class="select_color_title" <?php if ($c == 0) { ?>  <?php } ?>><?php echo $this->Lang['CHOOSE_COLOR']; ?> </h3>
                                            <ul>
                                                <?php foreach ($this->product_color as $color) { ?>
                                                    <li>
                                                        <a onclick="select_color('<?php echo $color->color_code_id; ?>', '<?php echo $products->deal_id; ?>');"  title="<?php echo $color->color_code_name; ?>" class="color_<?php echo $color->color_code_id; ?> <?php if ($this->session->get('product_color_qty' . $products->deal_id) == $color->color_code_id) { ?> active <?php } ?>">
                                                            <span class="choose_color" style="background:#<?php echo $color->color_name; ?>;"></span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
    <?php } ?>
                                    <input type="hidden" name="nosize" id="no_size" value="<?php echo $nosize; ?>">
                                    <input type="hidden" name="color_count" id="color_count" value="<?php echo $color_count; ?>" />
                                    <input type="hidden" name="select_color" id="sel_color" value="<?php echo $this->session->get('product_color_qty' . $products->deal_id); ?>" />
                                    <input type="hidden" name="select_size" id="sel_size" value="<?php echo $this->session->get('product_size_qty' . $products->deal_id); ?>" />
                                    <input type="hidden" name="select_quantity" id="sel_quant" value="<?php echo $this->session->get('product_quantity_qty' . $products->deal_id); ?>" />
                                </div>
                            </div>
                            <div class="deal_bought_detail product_bought_detail clearfix"> 
                        <?php    $count_del = "0";
                        if(count($this->delivery_details) > 0 ) { ?>
                                <ul class="product_buy_notes">
                                        <?php foreach($this->delivery_details as $del) { if(strlen($del->text) > 0 ) { $count_del = "1"; ?>
                                                <li><?php echo $del->text ; ?> </li>
                                        <?php } } ?>
                                </ul>
                        <?php } ?>
                        <?php  if($count_del == '1'){ ?> 
                        <div class="deal_bought_price product_bought_price" >
                        <?php } else { ?>
                        <div class="deal_bought_price product_bought_price product_left_price_details" >
                        <?php } ?>
                        <?php if($products->deal_percentage>0 && $products->deal_percentage!=''){ ?>
                        <span>(<?php echo round($products->deal_percentage); ?>% <?php echo $this->Lang['OFFER']; ?>)</span>
                        <?php } ?>
						 <?php if($products->deal_price!=0) { ?>	
							<strike><?php echo $symbol . "" . $products->deal_price; ?> </strike>
							<b><?php echo $symbol . "" . $products->deal_value; ?></b>
						<?php } else  { ?>
							<strike></strike>
							<b><?php echo $symbol."".$products->deal_value; ?> </b>
						<?php } ?> 
                        <?php  if($products->Including_tax  == 1){ ?>
                        <p><?php echo $this->Lang['INCLU_OF_TAXES']; ?></p>
                        <?php } ?>
                        <?php  if($products->shipping  == 1){ ?>
                        <p><?php echo $this->Lang['FREE_SHIPP_PROD']; ?></p>
                        <?php } elseif($products->shipping  == 2){ ?>
                        <p><?php echo $this->Lang['FLAT_SHIPP_T_PRO_AMO']; ?>( <?php echo $symbol . " " . $this->userflat_amount; ?> )</p>
                        <?php } elseif($products->shipping  == 3){ ?>
                        <p><?php echo $this->Lang['PER_PRO_SHIPP_PRODUCT_SHIPP']; ?>( <?php  echo $symbol . " " .$products->shipping_amount; ?> )</p>
                        <?php } elseif($products->shipping  == 4){ ?>
                        <p><?php echo $this->Lang['PER_ITEM_PRODU_SHIPPING_AMOU']; ?>( <?php  echo $symbol . " " .$products->shipping_amount; ?> )</p>
                        <?php } elseif($products->shipping  == 5){ ?>
                        <p><?php echo $this->Lang['ARAMEX_SHIPP_PROD']; ?></p>
                        <?php } ?>
                        <div class="product_buy_but">                            

                            <?php /*
                            <div class="deliv_rgt1">
                            <p><?php echo $products->delivery_period." ".$this->Lang['DELI_DAYS']; ?></p>
                            <span>(<?php echo $this->Lang['DELI_T_SHIPP_ADD']; ?>)</span>
                            </div>
                            */ ?>
                           <div class="clearfix">
                               
                                <?php //if ($products->deal_status == "0"){ 
                                if($this->uri->last_segment() == "admin-preview.html"){ ?>
                                 <a href="<?php echo PATH; ?>/admin/confirm-product-status/<?php echo $products->deal_id; ?>.html" class="buy_it" style="cursor:pointer;" id="allselect_nosize_1" title="<?php echo $this->Lang['SUBMIT']; ?>"><?php echo $this->Lang['SUBMIT']; ?></a>
                                 <a href="<?php echo PATH; ?>/admin/edit-products/<?php echo base64_encode($products->deal_id); ?>/<?php echo $products->deal_key;?>.html" class="buy_it" style="cursor:pointer;" id="allselect_nosize_1" title="<?php echo $this->Lang['GO_BACK']; ?>"><?php echo $this->Lang['GO_BACK']; ?></a>
                                <?php } elseif($this->uri->last_segment() =="merchant-preview.html") { ?>
                                <a href="<?php echo PATH; ?>/merchant/confirm-product-status/<?php echo $products->deal_id; ?>.html" class="buy_it" style="cursor:pointer;" id="allselect_nosize_1" title="<?php echo $this->Lang['SUBMIT']; ?>"><?php echo $this->Lang['SUBMIT']; ?></a>
                                <a href="<?php echo PATH; ?>/merchant/edit-products/<?php echo base64_encode($products->deal_id); ?>/<?php echo $products->deal_key;?>.html" class="buy_it" style="cursor:pointer;" id="allselect_nosize_1" title="<?php echo $this->Lang['GO_BACK']; ?>"><?php echo $this->Lang['GO_BACK']; ?></a>
                                <?php }else{ //} ?>
                                
                                 <?php if ($products->deal_status == "1"){ ?>
                                <?php if ($products->purchase_count >= $products->user_limit_quantity) { ?>
                                 <a class="buy_it"style="cursor:pointer" <?php echo $this->Lang['SOLD_OUT']; ?>></a>
                                <?php } else { ?>
                                 <a  class="buy_it" style="cursor:pointer;" id="allselect_nosize_1" onclick="check_validation('<?php echo $products->deal_id; ?>');" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php echo $this->Lang['ADD_TO_CART']; ?></a>
                                <?php } ?>
                                <?php }} ?>
                            </div>
                            <span class="error_size" style="display:none;"><?php echo $this->Lang['SELECT_SIZE_LIST']; ?></span>
                            <span class="error_color" style="display:none;"><?php echo $this->Lang['SELECT_COLOR_LIST']; ?></span>
                            <span class="error_all" style="display:none;"><?php echo $this->Lang['PLS_COLOR_SIZE_FROM_LI']; ?></span>
                        </div>
                        </div>
                        </div>
                            <div class="deal_share clearfix">
                                <div class="social_share">
                                    <ul>
                                        <li>  <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?> &amp;layout=button_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden;  height:21px; width:82px;" allowTransparency="true"></iframe></li>
                                        <li>
                                            <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                                            <a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" data-count="horizontal"><?php echo $this->Lang['TWEET']; ?></a></li>
                                        <li> <script type="text/javascript" src="https://apis.google.com/js/plusone.js"> {parsetags: 'explicit'} </script>
                                            <!-- Place this tag where you want the +1 button to render -->
                                            <div class="g-plusone" data-size="medium" data-href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>"></div>
                                            <!-- Place this render call where appropriate -->
                                            <script type="text/javascript">gapi.plusone.go();</script> </li>
                                             <li>
                                                <span class="ig-follow" data-id="<?php echo INSTAGRAM_ID; ?>" data-handle="<?php echo INSTAGRAM_USER; ?>" data-count="true" data-size="small" data-username="false"></span>
                                                <script>(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.src="//x.instagramfollowbutton.com/follow.js";s.parentNode.insertBefore(g,s);}(document,"script"));</script>
                                         </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                     <?php if(count($this->merchant_cms)>0) { ?>
                    <div class="bid_advance_block">
		    <?php if(($this->merchant_cms->current()->about_us_status ==1) || ($this->merchant_cms->current()->return_policy_status ==1) || ($this->merchant_cms->current()->terms_conditions_status ==1)) { ?>
                        <li>
                            <h2 class="deal_sub_title"><?php echo "Store Info"; ?></h2>
                            <?php if($this->merchant_cms->current()->about_us_status ==1) { ?>
                            <div  class="bid_advance_detail">
                                <label><a href="<?php echo PATH.'merchant/'.base64_encode($products->merchant_id).'/about_us.html'; ?>"><?php echo $this->Lang["ABT"]; ?></a></label>
                            </div>
                            <?php } ?>
                            <?php if($this->merchant_cms->current()->return_policy_status ==1) { ?>
                            <div  class="bid_advance_detail">
                                 <label><a href="<?php echo PATH.'merchant/'.base64_encode($products->merchant_id).'/return_policy.html'; ?>"><?php echo $this->Lang["RET_POLICY"]; ?></a></label>
                            </div>
                              <?php } ?>
                            <?php if($this->merchant_cms->current()->terms_conditions_status ==1) { ?>
                            <div  class="bid_advance_detail">
                                 <label><a href="<?php echo PATH.'merchant/'.base64_encode($products->merchant_id).'/terms_and_condition.html'; ?>"><?php echo $this->Lang["TERMS_COND"]; ?></a></label>
                            </div>
                            <?php } ?>
                        </li>
                        <?php } ?>
                        <li>
                            <h2 class="deal_sub_title"><?php echo $this->Lang['SHIP_DET']; ?></h2>
                            <div  class="bid_advance_detail">
                                <label><?php echo $this->Lang['SHIP_FEE']; ?> : </label>
                                <?php  if($products->shipping  == 1){ ?>
				<span><?php echo $this->Lang['FREE_SHIPP_PROD']; ?></span>
				<?php } elseif($products->shipping  == 2){ ?>
				<span><?php echo $this->Lang['FLAT_SHIPP_T_PRO_AMO']; ?>( <?php echo $symbol . " " . $this->userflat_amount; ?> )</span>
				<?php } elseif($products->shipping  == 3){ ?>
				<span><?php echo $this->Lang['PER_PRO_SHIPP_PRODUCT_SHIPP']; ?>( <?php  echo $symbol . " " .$products->shipping_amount; ?> )</span>
				<?php } elseif($products->shipping  == 4){ ?>
				<span><?php echo $this->Lang['PER_ITEM_PRODU_SHIPPING_AMOU']; ?>( <?php  echo $symbol . " " .$products->shipping_amount; ?> )</span>
				<?php } elseif($products->shipping  == 5){ ?>
				<span><?php echo $this->Lang['ARAMEX_SHIPP_PROD']; ?></span>
				<?php } ?>
                            </div>
                            <div  class="bid_advance_detail">
                                <label><?php echo $this->Lang['SHIPPING_INFO']; ?> : </label>
                                <span><?php  echo $products->delivery_period." days "; ?></span>
                            </div>
                        </li>
                    </div>
                    <?php } ?>
                    <div class="deal_descripe clearfix">
                        <h2 class="deal_sub_title"><?php echo ucfirst($products->deal_title); ?></h2>
                        <?php echo nl2br($products->deal_description); ?>
                    </div>
                    <?php /* 
                      <div class="top_tab">
                      <ul>
                      <li class="act4" id ="deal_details" ><a onclick="return deal_detail();" id ="deal_details" title="<?php echo $this->Lang['PRODUCT_DET']; ?>"><?php echo $this->Lang['PRODUCT_DET']; ?></a></li>
                      <li id ="highlights" ><a id ="highlights" onclick="return high_lights();" title="<?php echo $this->Lang['HEIGHLIGHTS']; ?>"><?php echo $this->Lang['HEIGHLIGHTS']; ?></a></li>
                      <li id ="fineprints" ><a  id ="fineprints" onclick="return fine_prints();" title="<?php echo $this->Lang['FINEPRINTS']; ?>"><?php echo $this->Lang['FINEPRINTS']; ?></a></li>
                      <li id ="specification" ><a  id ="specification" onclick="return specification();" title="<?php echo $this->Lang['SPECIFICATION']; ?>"><?php echo $this->Lang['SPECIFICATION']; ?></a></li>
                      </ul>
                      <div class="produt_review">
                      <a href="#" title="Product Reviews">Product Reviews</a>
                      </div>
                      </div> */ ?>
                    <div class="deal_comment_block">
                        <div class="deal_address">
                            <h2 class="deal_sub_title"><?php echo $this->Lang['ADDRES']; ?></h2>
                            <div class="deal_map_sec wloader_parent">
                                <i class="wloader_img">&nbsp;</i>
                                <div id="map_main" style="height:250px;">                                    
                                </div>
                                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                                <script type="text/javascript">
                                    var latlng = new google.maps.LatLng(<?php echo $products->latitude; ?>,<?php echo $products->longitude; ?>);
                                    var myOptions = {
                                        zoom: 12,
                                        center: latlng,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                                        navigationControl: true,
                                        mapTypeControl: true,
                                        scaleControl: true
                                    };
                                    var map = new google.maps.Map(document.getElementById("map_main"), myOptions);
                                    var marker = new google.maps.Marker({
                                        position: latlng,
                                        animation: google.maps.Animation.BOUNCE
                                    });
                                    var infowindow = new google.maps.InfoWindow({
                                        content: '<b><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $products->store_name); ?></b><p><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $products->addr1); ?></p><p><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $products->addr2); ?></p><p><?php echo $products->city_name; ?>,<?php echo $products->country_name; ?></p>'
                                    });
                                    google.maps.event.addListener(marker, 'click', function() {
                                        infowindow.open(map, marker);
                                    });
                                    marker.setMap(map);
                                </script>                                
                            </div>       
                            <address class="deal_map_address">
                                <h3><a href="<?php echo PATH . $products->store_url_title.'/'; ?>" title="<?php echo $products->store_name; ?>"><?php echo $products->store_name; ?></a></h3>
                                <p><?php echo $products->addr1; ?>,</p>
                                <p><?php echo $products->addr2; ?>,</p>
                                <p><?php echo $products->city_name; ?> - <?php echo $products->zipcode; ?>,  </p>
                                <p><?php echo $products->country_name; ?></p>
                                <p><?php echo $this->Lang['MOBILE']; ?>: <?php echo $products->phone; ?></p>
                                <p><?php echo $this->Lang['WEBSITE']; ?>: <a class="deal_web_link" href="<?php echo $products->website; ?>" target="blank" > <?php echo $products->website; ?></a></p>
                            </address>
                        </div>
                        <div class="fbok_comment_block">
                            <h2 class="deal_sub_title"><?php echo $this->Lang['COMM']; ?></h2>
                            <div class="fbok_comment wloader_parent">
                                <i class="wloader_img" style="min-height:220px;">&nbsp;</i>
                                <div id="fb-root"></div>
                                <script>
                                    (function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));

                                </script>
                                <div width="370" class="fb-comments" data-href="<?php echo PATH . $products->store_url_title.'/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" data-num-posts="10" ></div>
                            </div>
                        </div>
                    </div>
                    <!--slider_right content start-->
                     <?php if (count($this->all_products_list) > 0) { ?>
                    <div class="deal_list_slide_outer">
                        <h2 class="deal_sub_title"><?php echo $this->products_list_name; ?></h2>                        
                            <div class="deal_list_slide clearfix">
                                <div id="welcomeHero">
                                    <div id="slideshow-carousel"  <?php if (count($this->all_products_list) <= 5) { ?> class="deallist_slider_center" <?php } ?>>
                                        <ul id="carousel"  <?php if (count($this->all_products_list) > 5) { ?> class="jcarousel jcarousel-skin-tango" <?php } ?>>
            <?php
            $deal_offset = $this->input->get('offset');
            foreach ($this->all_products_list as $products_list) {
                $symbol = CURRENCY_SYMBOL;
                ?>
                                                <li>

                                                    <div class="product_listing">
                                                        <div class="product_listing_image wloader_parent">
                                                            <i class="wloader_img">&nbsp;</i>
                                                            <?php if (file_exists(DOCROOT . 'images/category/icon/' . $products_list->category_url . '.png')) { ?>

                <?php } else { ?>

                <?php } ?>
                <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products_list->deal_key . '_1' . '.png')) { 
                
                   $image_url = PATH . 'images/products/1000_800/' . $products_list->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url); ?>
                                                                <a href="<?php echo PATH . $products_list->store_url_title.'/product/' . $products_list->deal_key . '/' . $products_list->url_title . '.html'; ?>" title="<?php echo $products_list->deal_title; ?>" >
                                                                
                                                                <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                                                                    <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products_list->deal_key . '_1' . '.png' ?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $products_list->deal_title; ?>" title="<?php echo $products_list->deal_title; ?>" />
                                                                    <?php } else { ?>
                                 <img src="<?php echo PATH .'images/products/1000_800/'.$products_list->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                                                    
                    <?php /* <img title=" " alt="" src="<?php echo PATH.'images/products/290_215/'.$products_list->deal_key.'_1'.'.png'?>"> */ ?>
                                                                </a>
                <?php } else { ?>

                                                                <a href="<?php echo PATH . $products_list->store_url_title.'/product/' . $products_list->deal_key . '/' . $products_list->url_title . '.html'; ?>" title="<?php echo $products_list->deal_title; ?>">
                                                                   <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
                                                                </a>
                <?php } ?>
                <?php $url = PATH . $products_list->store_url_title.'/product/' . $products_list->deal_key . '/' . $products_list->url_title . '.html'; ?>
                                                <?php /*                                            <div class="normal_view">
                                                  <div class="normal_view2">
                                                  <div class="view_mid">
                                                  <a title="<?php echo $this->Lang['ADD_TO_CART']; ?>"  onclick="redirect_url('<?php echo $url; ?>');" > <?php echo $this->Lang['ADD_TO_CART']; ?></a>
                                                  </div>
                                                  </div>
                                                  </div> */ ?>
                                                        </div>
                                                        <div class="product_listing_detail">
                                                            <h2>
                                                                <a class="cursor" onclick="redirect_url('<?php echo $url; ?>');" title="<?php echo $products_list->deal_title; ?>"><?php echo substr(ucfirst($products_list->deal_title), 0, 100); ?></a>
                                                            </h2>

                                                        </div>
                                                        <div class="product_listing_price_details">
															<?php if($products_list->deal_price!=0) { ?>	
																	<p><?php echo $symbol . "" . $products_list->deal_value; ?></p>
																<?php } else  { ?>
																	<p><?php echo $symbol."".$products_list->deal_value; ?> </p>
																<?php } ?> 
                <?php /* <p><?php echo $symbol . " " . $products_list->deal_price; ?></p> */ ?>
                                                            
                                                        </div>
                                                    </div>
                                                </li>

            <?php } $deal_offset++; ?>




                                        </ul>
                                    </div>
                                </div>

                            </div>
                            </div>
    <?php } ?>                            
                    <div class="bot_mid_det specification"  style="display:none;">
                        <?php if (!empty($this->attribute_groups)) { ?>
                            <ul>
                            <?php foreach ($this->attribute_groups as $attribute_group) { ?>
                                    <li>
                                        <p style="color:#0078CA;font: bold 14px/35px arial;background: #F7F7F7;text-align: left; padding:0 0 0 9px; width: 99%;"><?php echo ucfirst($attribute_group['name']); ?></p>
                                    </li>
            <?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?>
                                        <ul>
                                            <li>
                                                <label class="left_right"><?php echo ucfirst($attribute['name']); ?></label>
                <?php foreach ($this->product_compare as $c) { ?>
                    <?php if (isset($this->product_compare[$c['deal_id']]['attribute'][$key])) { ?>
                                                        <p class="total_shif"><?php echo $this->product_compare[$c['deal_id']]['attribute'][$key]; ?></p>
                    <?php } else { ?>
                                                        <p>---</p>
                    <?php } ?>
                <?php } ?>
                                            </li>
                                        </ul>
            <?php } ?>
                                <?php } ?>
                            </ul>
                            <?php } else { ?>
                            <p> --- </p>
                            <?php } ?>
                    </div>
                </div>
            </div>
            <!--end-->
        </div>
    </div>
    </div>
    </div>
    </div>
<?php } ?>

<script>
    function redirect_url(url){
        window.location.href = url;
    }
</script>

