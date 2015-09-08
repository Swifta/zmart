<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/css/jquery.jcarousel.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/css/skin.css" media="all">
<script type="text/javascript">
        $(document).ready(function(){
            //$.noConflict();
            $("body").kkCountDown({
                colorText:'#7b7b7b',
                addClass : 'shadow'
            });
        });
</script>  
<script type="text/javascript">
    $(document).ready(function () {
        $('#messagedisplay1').hide();
        //jCarousel Plugin
        $('#carousel').jcarousel({
            horizontal: true,
            scroll: 1,
            auto: 2,
            wrap: 'last',
            initCallback: mycarousel_initCallback
        });
        //Front page Carousel - Initial Setup
        /*$('div#slideshow-carousel a img').css({'opacity': '1.0'});
        $('div#slideshow-carousel a img:first').css({'opacity': '1.0'});
        $('div#slideshow-carousel li a:first').append('<span class="arrow"></span>')
        //Combine jCarousel with Image Display
        $('div#slideshow-carousel li a').hover(
       	function () {
            if (!$(this).has('span').length) {
                $('div#slideshow-carousel li a img').stop(true, true).css({'opacity': '1.0'});
                $(this).stop(true, true).children('img').css({'opacity': '1.0'});
            }
       	},
       	function () {
            $('div#slideshow-carousel li a img').stop(true, true).css({'opacity': '1.0'});
            $('div#slideshow-carousel li a').each(function () {
                if ($(this).has('span').length) $(this).children('img').css({'opacity': '1.0'});
            });
       	}
    ).click(function () {
            $('span.arrow').remove();
            $(this).append('<span class="arrow"></span>');
            $('div#slideshow-main li').removeClass('active');
            $('div#slideshow-main li.' + $(this).attr('rel')).addClass('active');
            return false;
        });*/
    });
    //Carousel Tweaking
    function mycarousel_initCallback(carousel) {
        // Pause autoscrolling if the user moves with the cursor over the clip.
        carousel.clip.hover(function() {
            carousel.stopAuto();
        }, function() {
            carousel.startAuto();
        });
    }
</script>

<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js "></script>
<script type="text/javascript" src="<?php echo PATH; ?>js/timer/kk_countdown_1_2_jquery_min_detail.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("body").kkCountDowndetail({
            colorText: '#7b7b7b',
            addClass: 'shadow'
        });
    });
</script>

<script type="text/javascript" src="<?php echo PATH; ?>js/timer/kk_countdown_1_2_jquery_min.js"></script>

<script type="text/javascript">
    var aliceImageHost = 'http://ndot.in';
    var globalConfig = {};
</script>
<script src="<?php echo PATH; ?>js/magiczoomplus.js" type="text/javascript"></script>
<script src="<?php echo PATH; ?>js/magicscroll.js" type="text/javascript"></script>
<link href="<?php echo PATH; ?>/css/magiczoomplus.css" rel="stylesheet" type="text/css" />
<link href="<?php echo PATH; ?>/css/magicscroll.css" rel="stylesheet" type="text/css" />
<?php
foreach ($this->deals_deatils as $deals) {
    $symbol = CURRENCY_SYMBOL;
    ?>


    <script>
        setInterval(function()
        {
            var url ="<?php echo PATH; ?>auction/bid_history/<?php echo $deals->deal_id; ?>";
            $.post(url,function(check){
                $("div#show_bid_history").html(check);
            });
        }, 1000);//time in milliseconds
    </script>
    <script>
        setInterval(function()
        {
            var url ="<?php echo PATH; ?>auction/bid_history_amount/<?php echo $deals->deal_key; ?>/<?php echo $deals->url_title; ?>";
            $.post(url,function(check){
                var check1=check.split('--');
                $('input[name="bid_deal_value"]').val(check1[0]);
                $('span.bidamountval').html(check1[0]);
                $('span.bidamountval1').html("( <?php echo $symbol . " "; ?> "+check1[0]+" or More )");
                if(check1[1]==0){
                    $("p a#auction").removeAttr("href");
                    $("p a#auction").text('Sold Out');
                }
            });
        }, 1000);//time in milliseconds
    </script>
    <script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js "></script>

    </div> <!--for header -->
    </div>
    </div>
    <div class="contianer_outer1">
        <div class="contianer_inner">
            <div class="contianer">
                <div class="bread_crumb">
                    <ul>
                        <li><p><a href="<?php echo PATH.$this->storeurl; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                        <li><p><a href="<?php echo PATH.$this->storeurl; ?>/auction.html" title="<?php echo $this->Lang['AUCTION']; ?>"><?php echo $this->Lang['AUCTION']; ?></a></p></li>
                        <li><p><?php echo ucfirst($deals->deal_title); ?></p></li>
                    </ul>
                </div>
                <div  id="messagedisplay1" style="display:none;">
                    <div class="session_wrap">
                        <div class="session_container">
                            <div class="success_session">
                                <p><span ><?php echo $this->Lang['COMM_POST_SUCC']; ?>.</span></p>
                                <div class="close_session_2">
                                    <a class="closestatus cur" title="Close"  onclick="return closeerr();" >&nbsp;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--content start-->
                <div class="auction_block">
                    <div class="deal_content auction_content">
                        <div class="auction_image wloader_parent">                            
                            <i class="wloader_img" style="min-height: 300px;">&nbsp;</i>           
                                       <div class="auction_image_inner">
                                <?php $image_count = "";
                                for ($i = 1; $i <= 5; $i++) { ?>
                                    <?php if (file_exists(DOCROOT . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png')) {
                                        $image_count +=1;
                                    }
                                } ?>

    <?php for ($i = 1; $i <= 5; $i++) { ?>
        <?php if (file_exists(DOCROOT . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png')) { ?>

                                            <?php break;
                                        }
                                    } if (file_exists(DOCROOT . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png')) {     +
                                     $image_url = PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png';
                                $size = getimagesize($image_url);  ?>


                                    <a href="<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>" class="MagicZoomPlus" id="Zoomer3" rel="zoom-position: inner; selectors-change: mouseover; selectors-mouseover-delay:70; selectors-effect: fade" title="">
                                    <?php if(($size[0] > AUCTION_DETAIL_WIDTH) && ($size[1] > AUCTION_DETAIL_HEIGHT)) { ?>
                                        <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png' ?>&w=<?php echo AUCTION_DETAIL_WIDTH; ?>" />
                                        <?php } else { ?>
                                          <img src="<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png' ?>" />
                                        <?php } ?>
                                    <?php /* <img src="<?php echo PATH.'images/auction/1000_700/'.$deals->deal_key.'_'.$i.'.png';?>"/> */ ?></a>
        <?php if ($deals->winner != 0 && $deals->auction_status = 1) { ?>
                                            <div class="should_out_images">
                                                &nbsp;
                                            </div>
        <?php } ?>
                                <?php } else { ?>

                                    <a href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_details.png" class="MagicZoomPlus" id="Zoomer3" rel="zoom-position: inner; selectors-change: mouseover; selectors-mouseover-delay:70; selectors-effect: fade" title=""><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_details.png&w=<?php echo AUCTION_DETAIL_WIDTH; ?>"/></a>
                                    <?php if ($deals->winner != 0 && $deals->auction_status = 1) { ?>
                                            <div class="should_out_images">
                                                &nbsp;
                                            </div>
        <?php } ?>
                                    <?php } ?>
                                    
								                                    
								
								<?php $k=0; if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1.png')){ ?>
										<?php for($i=1; $i<=5; $i++){
											if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_'.$i.'.png')){
									?>
								<?php $k++; } } } ?>
                                                                   <?php if($k>1){ ?>
								<span <?php if($k>3){ ?>class="MagicScroll" id="ZoomScroll" <?php } ?>>
									<?php if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1.png')){ ?>
										<?php for($i=1; $i<=5; $i++){
											if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_'.$i.'.png')){
											  $image_url = PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png';
                                                                                        $size = getimagesize($image_url);  
									?>
									<?php if(($size[0] > AUCTION_DETAIL_WIDTH) && ($size[1] > AUCTION_DETAIL_HEIGHT)) { ?>
										<a href="<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>" rel="zoom-id:Zoomer3" rev="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>&w=<?php echo AUCTION_DETAIL_WIDTH; ?>" title="">
                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png' ?>&w=<?php echo AUCTION_THUMB_WIDTH; ?>&h=<?php echo AUCTION_THUMB_HEIGHT; ?>" />
                <?php /* <img src="<?php echo PATH.'images/auction/100_100/'.$products->deal_key.'_'.$i.'.png';?>"/> */ ?></a>
                
                                                                        <?php } else { ?>
                                                                        <a href="<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>" rel="zoom-id:Zoomer3" rev="<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>" title="">
                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png' ?>&w=<?php echo AUCTION_THUMB_WIDTH; ?>&h=<?php echo AUCTION_THUMB_HEIGHT; ?>" /></a>
                                                                        <?php } ?>
										<?php } } ?>
									<?php } ?>
								</span>
								<?php } ?>
    <?php /* if ($image_count > 1) { ?>
                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                            <?php if (file_exists(DOCROOT . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png')) { ?>

                                                <a href="<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>" rel="zoom-id:Zoomer3" rev="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>&w=<?php echo AUCTION_DETAIL_WIDTH; ?>&h=<?php echo AUCTION_DETAIL_HEIGHT; ?>" title="">
                                                    <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/auction/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>&w=<?php echo AUCTION_THUMB_WIDTH; ?>&h=<?php echo AUCTION_THUMB_HEIGHT; ?>" />
          </a>


            <?php } else {
                
            }
        }
    } */
    ?>
                        </div>
                        </div>
                        <div class="bid_history">
                            <div class="mbid_history_inner">
                            <div class="bid_history_content">					
                                <ul>
                                    <?php if (count($this->transaction_details)) { ?>
                                            <?php
                                            $i = 0;
                                            $saving = 0;
                                            foreach ($this->transaction_details as $tran) {
                                                ?>
            <?php if ($i == 0) { ?>
                                                <li class="leads_topper"><p><?php echo $this->Lang['LAED_BIDD']; ?>: </p><span><?php echo ucfirst($tran->firstname); ?></span></li>
            <?php
            } $i++;
        }
    } else {
        ?>
                                        <li class="leads_topper"><p><?php echo $this->Lang['LAED_BIDD']; ?>:<span> <?php echo $this->Lang['NOT_YET_BID']; ?></span></p></li>
                                        <?php } ?>
                                        <?php if ($deals->winner != 0 && $deals->auction_status = 1) {
    } else { ?>
                                    <li class="bid_closing bidslist_bg">
                                            <div class="time_price">                                                
                                                <span class="kkcount-down-detail" time="<?php echo $deals->enddate; ?>" >
                                                </span>                                                    
                                            </div>
                                            <p><?php echo $this->Lang['AUC_CLOSE_T']; ?>: <?php echo date('d-m-Y h:i:s A', $deals->enddate); ?></p>
                                    </li>
                                    <?php } ?>
                                    <li class="clearfix">                                                                                    
                                        <span class="bid_price"><?php echo $symbol . " " . $deals->deal_value; ?></span>                                        
                                    <?php if ($deals->winner != 0 && $deals->auction_status != 0) { ?>
                                            <a class="buy_it auction_buy_it"  id="sold" title="<?php echo $this->Lang['SOLD_OUT2']; ?>" style="cursor:default;"><?php echo $this->Lang['SOLD_OUT2']; ?></a>
                                    <?php } else { if ($deals->deal_status != 0) {?>
                                    
                                                        <script type="text/javascript">
                                                        $(document).ready(function() {
                                                        $("#sold").hide();
                                                        setInterval(function()
                                                        {
                                                               var d = new Date();
                                                                var n = Math.floor(d.getTime()/1000);
                                                                var e = <?php echo $deals->enddate; ?>;
                                                               // alert(n);
                                                                if(n > e){
                                                                        $("#auction").hide();
                                                                         $("#sold").show();
                                                                }
                                                        //alert(dis);
                                                        }, 1000);//time in milliseconds
                                                        });
                                                        </script>

                                            <a class="buy_it auction_buy_it" id="auction"  href="javascript:show_auction('<?php if (isset($this->UserID)) {
                                    echo $this->UserID;
                                } ?>','<?php echo $deals->deal_key; ?>','<?php echo $deals->url_title; ?>');"  title="<?php echo $this->Lang['BID_NOW1']; ?>"><?php echo $this->Lang['BID_NOW1']; ?></a>
                                           
                                            <a class="buy_it auction_buy_it"  id="sold" title="<?php echo $this->Lang['SOLD_OUT2']; ?>" style="cursor:default;"><?php echo $this->Lang['SOLD_OUT2']; ?></a>
                                    <?php } } ?>                                         
                                    </li>
                                     <?php if ($deals->winner != 0 && $deals->auction_status = 1) {
                                     
    } else { ?>
                                    <li class="bid_enter_value">
                                            <a style="cursor:default;" title="<?php echo $this->Lang['BID_ENTER']; ?> <?php echo $symbol . ' ' . $deals->deal_price; ?>"><?php echo $this->Lang['BID_ENTER']; ?> <?php echo $symbol . " "; ?><span class="bidamountval"><?php echo $deals->deal_price; ?></span> OR MORE.</a>                                        
                                    </li>
                                    <?php } ?>
                                    <li class="bid_pricing_details">                                        
                                        <h4><?php echo $this->Lang['WIT_ECH']; ?></h4>   
                                        <p><?php echo $this->Lang['START_B_FROM']; ?> </p><span><?php echo $symbol . " " . $deals->deal_value; ?></span>                                     
                                        <p><?php echo $this->Lang['BID_INCR']; ?></p><span><?php echo $symbol . " " . $deals->bid_increment; ?></span>
                                        <p><?php echo $this->Lang['RE_PRIC']; ?></p><span><?php echo $symbol . " " . $deals->product_value; ?></span>
                                        
                                <p><?php echo $this->Lang['AUC_TYPE']; ?></p><span><?php echo $this->Lang['RESE_AUC']; ?></span>
                                        </li>
                                        <li class="bid_pricing_details">    
                                        <div class="clearfix">
                                        <div class="deal_rating"> 
                                        <a class="basic<?php echo $deals->deal_id; ?>" id="<?php echo $this->avg_rating; ?>" title="<?php echo $this->avg_rating; ?> / 5" >                                     
                                        <link href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/css/jRating.jquery.css" rel="stylesheet" type="text/css"/>
                                        <script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jRating.jquery.js"></script>
                                        <script type="text/javascript">
                                        $(document).ready(function(){
                                        $(".basic<?php echo $deals->deal_id; ?>").jRating({
                                        bigStarsPath : '<?php echo PATH; ?>/images/star_03.png', // path of the icon stars.png
                                        smallStarsPath : '<?php echo PATH; ?>/images/new/white_star.png', // path of the icon small.png
                                        phpPath : '<?php echo PATH; ?>auction-rating.html', // path of the php file jRating.php
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
                                        </a>
                                        </div>
                                        </div>
                                    </li>
                                        <div class="social_share">
											
                                        <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo PATH . $deals->store_url_title.'/auction/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?> &amp;layout=button_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden;  height:21px; width:82px;" allowTransparency="true"></iframe>
                                            <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                                            <a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo PATH . $deals->store_url_title.'/auction/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" data-count="horizontal"><?php echo $this->Lang['TWEET']; ?></a>
                                       <script type="text/javascript" src="https://apis.google.com/js/plusone.js">
                                            {parsetags: 'explicit'}
                                            </script>
                                            <!-- Place this tag where you want the +1 button to render -->
                                            <div class="g-plusone" data-size="medium" data-href="<?php echo PATH . $deals->store_url_title.'/auction/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>"></div>
                                            <!-- Place this render call where appropriate -->
                                            <script type="text/javascript">gapi.plusone.go();</script>
                                          
									<li>
											<span class="ig-follow" data-id="<?php echo INSTAGRAM_ID; ?>" data-handle="<?php echo INSTAGRAM_USER; ?>" data-count="true" data-size="small" data-username="false"></span>
											<script>(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.src="//x.instagramfollowbutton.com/follow.js";s.parentNode.insertBefore(g,s);}(document,"script"));</script>
                                         </li>
                                        
                                    </div>
                                    </li> 
                                     <?php /* <li class="border_none">
                                        <div class="li_shareleft">
                                            <p class="save_over_text"><?php echo $this->Lang['SAVE_OVER']; ?> <span><?php
                                            $saving = $deals->product_value - $deals->deal_value;
                                            if ($saving < 0) {
                                                echo $symbol . " " . "0";
                                            } else
                                                echo $symbol . " " . $saving;
                                            ?></span></p>
                                            <h6><?php echo $this->Lang['NORM_RE_PRIC']; ?></h6>
                                        </div>
                                    </li> */ ?>
                                </ul>
                            </div>
                                <div class="bid_history_list">
                                        <h3 class="bid_hisrory_title"><?php echo $this->Lang['BID_HIS']; ?></h3>						
                                        <script>
                                            setInterval(function()
                                            {
                                                var url ="<?php echo PATH; ?>auction/bid_history/<?php echo $deals->deal_id; ?>";
                                                $.post(url,function(check){
                                                    $("div#show_bid_history").html(check);
                                                });
                                            }, 1000);//time in milliseconds
                                        </script>
                                        <span class="bids_total"><?php echo count($this->transaction_details); ?> <?php echo $this->Lang['BIDS_TOTAL']; ?></span>
                                        <h3 class="bidders_list_title bidslist_bg"><?php echo $this->Lang['LAT_BID']; ?></h3>
                                                <div class="bidders_list">
                                                    <ul id="show_bid_history" > <?php echo new View("themes/" . THEME_NAME . "/auction/bid_history"); ?></ul>
                                                </div>
                                </div>
                                </div>
                        </div>
                    </div>
                     <ul class="bid_advance_block">
                        <li>
                            <h2 class="deal_sub_title"><?php echo $this->Lang['PRIC_DET']; ?></h2>
                            <div  class="bid_advance_detail">
                                <label><?php echo $this->Lang['START_B_FROM']; ?> :</label>
                                <span><?php echo $symbol . " " . $deals->deal_value; ?></span>
                            </div>
                            <div  class="bid_advance_detail">
                                <label><?php echo $this->Lang['BID_INCR']; ?> :</label>
                                <span><?php echo $symbol . " " . $deals->bid_increment; ?></span>
                                
                            </div>
                        </li>
                        <li>
                            <h2 class="deal_sub_title"><?php echo $this->Lang['AUC_DETS']; ?></h2>
                            <div  class="bid_advance_detail">
                                <label><?php echo $this->Lang['START_T']; ?> :</label>
                                <span><?php echo date('M d, h:i A', $deals->startdate); ?></span>
                            </div>
                                <!--li>
                                  <div class="ad_detail1">
                                  <p class="ad_detail1_label">Start Time:</p>
                                  <p class="ad_detail1_value">Feb 15, 02:16 PM</p>
                                  </div>
                                  </li-->
                            <div  class="bid_advance_detail">
                                <label><?php echo $this->Lang['END_T']; ?> :</label>
                                <span><?php echo date('M d, h:i A', $deals->enddate); ?></span>
                            </div>
                        </li>
                        <li>
                            <h2 class="deal_sub_title"><?php echo $this->Lang['SHIP_DET']; ?></h2>
                            <div  class="bid_advance_detail">
                                <label><?php echo $this->Lang['SHIP_FEE']; ?> : </label>
                                <span><?php echo $symbol . " " . $deals->shipping_fee; ?></span>
                            </div>
                            <div  class="bid_advance_detail">
                                <label><?php echo $this->Lang['SHIPPING_INFO']; ?> : </label>
                                <span><?php echo $deals->shipping_info; ?></span>
                            </div>
                        </li>
                    </ul>
                    <div class="deal_descripe clearfix">
                        <h2 class="deal_sub_title"><?php echo $deals->deal_title; ?></h2>
                        <?php echo nl2br($deals->deal_description); ?>
                    </div>
                    <div class="deal_comment_block">
                    <div class="deal_address">                                                                                                                       
                                    <h2 class="deal_sub_title"><?php echo $this->Lang['ADDRES']; ?></h2>                                
                                <div class="deal_map_sec wloader_parent">
                                    <i class="wloader_img">&nbsp;</i>
                                    <div id="map_main" style="height:250px;"></div>
                                    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                                    <script type="text/javascript">
                                        var latlng = new google.maps.LatLng(<?php echo $deals->latitude; ?>,<?php echo $deals->longitude; ?>);
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
                                            content: '<b><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $deals->store_name); ?></b><p><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $deals->address1); ?></p><p><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $deals->address2); ?></p><p><?php echo $deals->city_name; ?>,<?php echo $deals->country_name; ?></p>'
                                        });
                                        google.maps.event.addListener(marker, 'click', function() {
                                            infowindow.open(map, marker);
                                        });
                                        marker.setMap(map);
                                    </script>
                                </div>
                                    <address class="deal_map_address">
                                <h3><a href="<?php echo PATH . $deals->store_url_title.'/'; ?>" title="<?php echo $deals->store_name; ?>"><?php echo $deals->store_name; ?></a></h3>
                                <p><?php echo $deals->addr1; ?>,</p>
                                <p><?php echo $deals->addr2; ?>,</p>
                                <p><?php echo $deals->city_name; ?> - <?php echo $deals->zipcode; ?>,  </p>
                                <p><?php echo $deals->country_name; ?></p>
                                <p><?php echo $this->Lang['MOBILE']; ?>: <?php echo $deals->phone; ?></p>
                                <p><?php echo $this->Lang['WEBSITE']; ?>: <a class="deal_web_link" href="<?php echo $deals->website; ?>" target="blank" > <?php echo $deals->website; ?></a></p>
                            </address>
                                    <?php /* if (strip_tags($deals->highlights) != "") { ?>
                                      <div class="bot_mid_det highlight" style="display:none;" >

                                      <p> <?php echo $deals->highlights; ?> </p>

                                      </div>
                                      <?php } ?>
                                      <?php if (strip_tags($deals->fineprints) != "") { ?>
                                      <div class="bot_mid_det fineprint" style="display:none;" >

                                      <p> <?php echo $deals->fineprints; ?> </p>

                                      </div>
                                      <?php } ?>
                                      <?php if (strip_tags($deals->terms_conditions) != "") { ?>
                                      <div class="bot_mid_det terms_conditions" style="display:none;" >

                                      <p> <?php echo $deals->terms_conditions; ?> </p>

                                      </div>
                                      <?php } */ ?>
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
                                                    <div width="370" class="fb-comments" data-href="<?php echo PATH . $deals->store_url_title.'/auction/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" data-num-posts="10" ></div>
                                                </div>                                                                      
                                                </div>
                                    <?php /*     * * AUCTION DETAIL POPUP  ** */ ?>
                                                    <form method="POST" name="auction_bid"  onsubmit="return check();">
                                                        <div class="popup_auction" >
                                                            <div class="place_sign_up">
                                                                <div class="place_sign_midd clearfix">                                    
                                                                    <a class="close2" onclick="show_place_my_bid();" style="cursor:pointer;" title="<?php echo $this->Lang['CLOSE']; ?>"></a>
                                                                    <div class="place_midd_top clearfix">
                                                                        <a href="<?php echo PATH; ?>" title="<?php echo SITENAME; ?>"><img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/logo.png" /></a>                                        
                                                                    </div>
                                    <?php if ($deals->startdate < time()) { ?>
                                        <?php if ($this->UserID) { //if($count_user==0){   ?>
                                                                            <div class="place_midd_bott clearfix">
                                                                                <div class="place_bott_top">
                                                                                    <h3><?php echo $this->Lang['BID_AMOU_LO_WIN']; ?></h3>
                                                                                    <p><?php echo $this->Lang['PLS_ENTER_BID']; ?></p>
                                                                                </div>
                                                                                <div class="place_bott_mid">
                                                                                    <div class="place_bot_left">
                                                                                        <p><?php echo $this->Lang['NEW_MAX_BID']; ?> :</p>
                                                                                    </div>
                                                                                    <div class="place_bot_center">
                                                                                        <label><?php echo $symbol; ?></label>
                                                                                        <div class="place_input">
                                                                                            <input id="new_bid" name="bid_deal_current_value" type="text" AUTOCOMPLETE="OFF" value="" maxlength="7" autofocus />
                                                                                        </div>
                                                                                        <input type="hidden" id="old_bid" name="bid_deal_value" value="<?php echo $deals->deal_price; ?>" >
                                                                                        <input type="hidden"  name="bid_deal_id" id="bid_deal_id" value="<?php echo $deals->deal_id; ?>" >
                                                                                        <input type="hidden"  name="bid_deal_key" value="<?php echo $deals->deal_key; ?>" >
                                                                                        <input type="hidden"  name="bid_title" value="<?php echo $deals->deal_title; ?>" >
                                                                                        <input type="hidden"  name="bid_url_title" value="<?php echo $deals->url_title; ?>" >
                                                                                        <input type="hidden" name="shipping_amount" value="<?php echo $deals->shipping_fee; ?>" >
                                                                                        <input type="hidden" name="end_time" value="<?php echo $deals->enddate; ?>" >
                                                                                         <input type="hidden" name="store_url" value="<?php echo $deals->store_url_title; ?>" >
                                                                                        <p></p>
                                                                                        <span class="bidamountval1">(<?php echo $symbol . " "; ?><?php echo $deals->deal_price; ?> <?php echo $this->Lang['OR_MORE']; ?>)</span>
                                                                                    </div>
                                                                                    <div class="place_bot_rgt">
                                                                                        <div class="gren_left">
                                                                                            <input class="sign_submit" id="update" type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" title="<?php echo $this->Lang['UPDATE']; ?>"/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                        <?php } else { ?>
                                                                            <div class="place_midd_bott clearfix">
                                                                                <div class="place_bott_top">
                                                                                    <h3><?php echo $this->Lang['PLS_LOGIN_BID']; ?></h3>
                                                                                </div>
                                                                            </div>
                                        <?php }
                                    } else { ?>
                                                                        <div class="place_midd_bott clearfix" >
                                                                            <div class="place_bott_top">
                                                                                <h3><?php echo $this->Lang['FUTR_AUC_BID']; ?></h3>

                                                                                <p><span><?php echo $this->Lang['AUC_ST_T']; ?>: <?php echo date('d-m-Y h:i:s A', $deals->startdate); ?></span></p>
                                                                            </div>
                                                                        </div>
                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!--end-->  
                                                </div>
                                            </div>
       <?php if (count($this->all_deals_list) > 0) { ?>
            <!--slider_right content start-->
            <div class="deal_list_slide_outer">
                        <h2 class="deal_sub_title"><?php echo $this->products_list_name; ?></h2> 
            <div class="deal_list_slide clearfix">                
                <div id="welcomeHero" >
                    <div id="slideshow-carousel" <?php if (count($this->all_deals_list) <= 5) { ?> class="deallist_slider_center" <?php } ?> >
                        <ul id="carousel" <?php if (count($this->all_deals_list) > 5) { ?> class="jcarousel jcarousel-skin-tango" <?php } ?>>
                                <?php  foreach ($this->all_deals_list as $deals1) {
                                $symbol = CURRENCY_SYMBOL;     ?>
                            <li>
                                <div class="new_auction_list">
                                    <div class="new_action_listing_image wloader_parent">
                                        <i class="wloader_img">&nbsp;</i>
                                        <div class="action_image_1">
					<?php if (file_exists(DOCROOT . 'images/auction/1000_800/' . $deals1->deal_key . '_1' . '.png')) { ?>
					<a href="<?php echo PATH.$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>">
<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'images/auction/1000_800/'.$deals1->deal_key.'_1'.'.png';?>&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=<?php echo AUCTION_LIST_HEIGHT; ?>" alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" border="0" />
<?php /*<img src="<?php echo PATH . 'images/auction/220_160/' . $deals1->deal_key . '_1' . '.png'; ?>"  alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" border="0" />*/ ?></a>
                                        <?php } else { ?>
                                            <a href="<?php echo PATH.$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>">
                                                <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_auctions_list.png&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=<?php echo AUCTION_LIST_HEIGHT; ?>" alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" border="0" />
                                            </a>
                                        <?php } ?>   
                                        </div>
                                <?php $url = PATH . $deals1->store_url_title.'/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>                                                
                                    </div>
                                    <div class="new_prdt_listing_details">
                                        <h2>
                                            <a class="cursor" onclick="redirect_url('<?php echo $url; ?>');"  title="<?php echo $deals1->deal_title; ?>"><?php echo substr(ucfirst($deals1->deal_title),0,100); ?></a>
                                        </h2>                                        
                                        <div class="bid_cont">                                        
                                            <div class="bid_value">
                                                <label><?php echo $this->Lang['BID_TO_BEAT']; ?> :</label><span><?php echo $symbol . " " . $deals1->deal_value; ?></span>
                                                
                                            </div>
                                            <div class="bid_value">
                                                <label><?php echo $this->Lang['BID']; ?> :</label><span><?php echo $symbol . " " . $deals1->product_value; ?></span>
                                            </div>
                                        </div>
                                        <div class="deal_timer">
                                                <label>
                                                    <span class="kkcount-down" time="<?php echo $deals1->enddate; ?>" >
                                                    </span>
                                                </label>
                                        </div>
                                        
                                    </div>
                                    <div class="list_bottom">
                                        <div class="bottom_stars">
                                        <img alt="" src="<?php echo PATH;?>/themes/<?php echo THEME_NAME ;?>/images/new/gray.png"/>
                                        </div>
                                        <div class="new_list_bottom_icons">
                                                <div class="new_bid"><a  title="<?php echo $this->Lang['BID_NOW1']; ?>" onclick="redirect_url('<?php echo $url; ?>');"><?php // echo $this->Lang['BID_NOW1']; ?></a> </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
			</ul>
                    </div>
                </div>
            </div>
            </div>
            <!--slider_right content end -->
            <?php } ?>            
        </div>
    </div>
<?php } ?>
</div>
</div>
<script type="text/javascript"> $(document).ready(function() {
    Rocket.SizeChart.rows = [{"CHEST (INCH)":"38","SHOULDER(INCH)":"16","LENGTH(INCH)":"27"},{"CHEST (INCH)":"40","SHOULDER(INCH)":"17","LENGTH(INCH)":"28"},{"CHEST (INCH)":"42.5","SHOULDER(INCH)":"18","LENGTH(INCH)":"29"},{"CHEST (INCH)":"45","SHOULDER(INCH)":"19","LENGTH(INCH)":"30"},{"CHEST (INCH)":"47","SHOULDER(INCH)":"19","LENGTH(INCH)":"31"},{"CHEST (INCH)":"49","SHOULDER(INCH)":"20","LENGTH(INCH)":"32"}];
    Rocket.SizeChart.columns = ["CHEST (INCH)","SHOULDER(INCH)","LENGTH(INCH)"];
    Rocket.SizeChart.conversionHoverActive = false;
    Rocket.SizeChart.preparePopup(false);
    // stop highlight animation if user overs list item
    $('#listProductSizes > li').bind('mouseover', function() {
        $(this).stop(false, true);
    });
    $(document).bind("Quicklist.productRemoved", function (e, sku) {
        //We are on the detail page of the product we just removed from quicklist
        //Enable the add to quicklist link
        if ($('#configSku').val() == sku) {
            $('#qlPrdAdded').hide();
            $('#qlPrdAdd').show();
        }
    });$('.tool-tip').hover(function() {
        var tipId = $(this).attr('label');
        var pos = $(this).position();
        $('#' + tipId).css({'top':(pos.top + 10), 'left': (pos.left + 10)});
        $('#' + tipId + ' span').css('background-color', '#fff' );
        $("#" + tipId).fadeIn(200);
    }, function() {
        var tipId = $(this).attr('label');
        $("#" + tipId).fadeOut(200);
    });
    globalConfig.product = globalConfig.product || {};
    globalConfig.product.rDetails = {"sku":"UN573MA91PPSINDFAS","chain":"3270|3328|3329|3330","brand":"United Colors of Benetton","brandId":"573","price":799,"sessionId":"qonohdq1sn843pl0afp0biklg3","userId":"","catId":"3270","cat":"Clothing","brickId":"3330","brick":"Crew Neck T-Shirts"};
    Jabong.image.initSetImage();
    $( '#prdZoomImgPrev' ).live( 'click', function() { Jabong.image.imgNavigate( 'prev' ) } );
    $( '#prdZoomImgNext' ).live( 'click', function() { Jabong.image.imgNavigate( 'next' ) } );
    if(window.location.hash == "#productReviews") {
        $("#productReviewsTab").trigger('click');
    }
    $('#recommSliderSolr').bxSlider({
        mode: 'vertical',
        auto: false,
        displaySlideQty: 3,
        moveSlideQty: 1,
        speed: 250
    });
    Rocket.QuickList.loadList([], []);
});</script>
<script type="text/javascript">$('.prd-more-images-slider').jCarouselLite({
btnNext: ".next",
btnPrev: ".prev",
circular: false,
visible: 5
});        $('#prd-imageBox-container').bind('mouseenter', function() {
$('.prd-zoom-info').hide();
});
$('#prd-imageBox-container').bind('mouseleave', function() {
$('.prd-zoom-info').show();
});
var reviewFieldMsg = "You must fill the empty field(s) highlighted above.";
var reviewSuccessMsg = "Thank you. Your review will start appearing soon.";
var reviewErrorMsg = "There has been an error saving your rating. Please try again.";
//<![CDATA[
jQuery.ajax({
type: "GET",
url: "//ndot.in",
success: function(data){
    new RecommendationView(data, 4);
}
});
//]]></script>
<script type="text/javascript">
$(document).keyup(function(e) {
    if (e.keyCode == 27) { //  esc keycode
        $('.popup_auction').css({'display' : 'none'});
        $('#fade').css({'visibility' : 'hidden'});
        $('#new_bid').val('')
        return false;
    }
});
$(document).ready(function(){
$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer
});
function show_place_my_bid()
{
$('.popup_auction').css({'display' : 'none'});
$('#fade').css({'visibility' : 'hidden'});
//return false;
}
</script>
<script>
function redirect_url(url){
window.location.href = url;
}
</script>
<script type="text/javascript">
$(document).ready(function(){
jQuery.noConflict();
jQuery("body").kkCountDown({
    colorText:'#444!important',
    colorTextDay:'#444!important',
    addClass : 'shadow',
    dayText:"<?php echo $this->Lang['DAY_TEXT']; ?>",
    daysText:"<?php echo $this->Lang['DAYS_TEXT']; ?>"
});
});
</script>
