<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#messagedisplay1').hide();
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

        //Front page Carousel - Initial Setup
       /* $('div#slideshow-carousel a img').css({'opacity': '1.0'});
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
<div class="contianer_outer1">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li>
                        <p><a href="<?php echo PATH; ?>today-deals.html" title="<?php echo $this->Lang['DEALS']; ?>"><?php echo $this->Lang['DEALS']; ?></a></p>
                    </li>
                    <?php foreach ($this->deals_deatils as $deals) {
                        $symbol = CURRENCY_SYMBOL;
                        ?>
                        <li class="act"><p><?php echo ucfirst($deals->deal_title); ?></p></li>
<?php } ?>
                </ul>
            </div>
            <div  id="messagedisplay1" style="display:none;">
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
            <?php
            foreach ($this->deals_deatils as $deals) {
                $symbol = CURRENCY_SYMBOL;   ?>
                <!--content start-->
                <div class="detail_block">
                    <div class="deal_content">
                        <div class="deal_image wloader_parent">
                            <i class="wloader_img" style="min-height: 300px;">&nbsp;</i>           
                          <div class="deal_image_inner">
                                <?php $image_count = "";
                                for ($i = 1; $i <= 5; $i++) { ?>
                                    <?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png')) {
                                        $image_count +=1;
                                    }
                                } ?>

    <?php for ($i = 1; $i <= 5; $i++) { ?>
        <?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png')) { ?>

                                            <?php break;
                                        }
                                    } if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png')) {     +
                                     $image_url = PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png';
                                $size = getimagesize($image_url);  ?>


                                    <a href="<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>" class="MagicZoomPlus" id="Zoomer3" rel="zoom-position: inner; selectors-change: mouseover; selectors-mouseover-delay:70; selectors-effect: fade" title="">
                                    <?php if(($size[0] > DEAL_DETAIL_WIDTH) && ($size[1] > DEAL_DETAIL_HEIGHT)) { ?>
                                        <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png' ?>&w=<?php echo DEAL_DETAIL_WIDTH; ?>" />
                                        <?php } else { ?>
                                          <img src="<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png' ?>" />
                                        <?php } ?>
                                    <?php /* <img src="<?php echo PATH.'images/deals/1000_700/'.$deals->deal_key.'_'.$i.'.png';?>"/> */ ?></a>
        <?php if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) { ?>
                                    <div class="should_out_images">
                                        &nbsp;
                                    </div>
                                <?php } ?>
                                <?php } else { ?>

                                    <a href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_details.png" class="MagicZoomPlus" id="Zoomer3" rel="zoom-position: inner; selectors-change: mouseover; selectors-mouseover-delay:70; selectors-effect: fade" title=""><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_details.png&w=<?php echo DEAL_DETAIL_WIDTH; ?>"/></a>
                                     <?php if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) { ?>
                                    <div class="should_out_images">
                                        &nbsp;
                                    </div>
                                <?php } ?>
                                    <?php } ?>                                    
  								
								<?php $k=0; if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1.png')){ ?>
										<?php for($i=1; $i<=5; $i++){
											if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_'.$i.'.png')){
									?>
								<?php $k++; } } } ?>
                                                                   <?php if($k>1){ ?>
								<span <?php if($k>3){ ?>class="MagicScroll" id="ZoomScroll" <?php } ?>>
									<?php if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1.png')){ ?>
										<?php for($i=1; $i<=5; $i++){
											if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_'.$i.'.png')){
											  $image_url = PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png';
                                                                                        $size = getimagesize($image_url);  
									?>
									<?php if(($size[0] > DEAL_DETAIL_WIDTH) && ($size[1] > DEAL_DETAIL_HEIGHT)) { ?>
										<a href="<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>" rel="zoom-id:Zoomer3" rev="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>&w=<?php echo DEAL_DETAIL_WIDTH; ?>" title="">
                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png' ?>&w=<?php echo DEAL_THUMB_WIDTH; ?>&h=<?php echo DEAL_THUMB_HEIGHT; ?>" />
                <?php /* <img src="<?php echo PATH.'images/deals/100_100/'.$products->deal_key.'_'.$i.'.png';?>"/> */ ?></a>
                
                                                                        <?php } else { ?>
                                                                        <a href="<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>" rel="zoom-id:Zoomer3" rev="<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>" title="">
                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png' ?>&w=<?php echo DEAL_THUMB_WIDTH; ?>&h=<?php echo DEAL_THUMB_HEIGHT; ?>" /></a>
                                                                        <?php } ?>
										<?php } } ?>
									<?php } ?>
								</span>
								<?php } ?>
								
								
                            <?php /* if ($image_count > 1) { ?>
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
            <?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png')) { ?>
                                        <a href="<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>" rel="zoom-id:Zoomer3" rev="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png'; ?>&w=<?php echo DEAL_DETAIL_WIDTH; ?>&h=<?php echo DEAL_DETAIL_HEIGHT; ?>" title="">
                                            <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/deals/1000_800/' . $deals->deal_key . '_' . $i . '.png' ?>&w=<?php echo DEAL_THUMB_WIDTH; ?>&h=<?php echo DEAL_THUMB_HEIGHT; ?>" /></a>
            <?php } else {
            }
        }
    } */
    ?>  </div>
                        </div>
                        <div class="deal_info">
                            <h2 class="deal_title"><?php echo ucfirst($deals->deal_title); ?></h2>
                            <div class="deal_buy_detail clearfix">
                                <div class="deal_rating">
                                    <a class="basic<?php echo $deals->deal_id; ?>" id="<?php echo $this->avg_rating; ?>" title="<?php echo $this->avg_rating; ?> / 5" >
                                        <link href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/css/jRating.jquery.css" rel="stylesheet" type="text/css"/>
                                        <script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jRating.jquery.js"></script>
                                        <script type="text/javascript">
                                            $(document).ready(function(){
                                                $(".basic<?php echo $deals->deal_id; ?>").jRating({
                                                    bigStarsPath : '<?php echo PATH; ?>/images/star_03.png', // path of the icon stars.png
                                                    smallStarsPath : '<?php echo PATH; ?>/images/new/white_star.png', // path of the icon small.png
                                                    phpPath : '<?php echo PATH; ?>deal-rating.html', // path of the php file jRating.php
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
                                   <span><?php echo $this->sum_rating; ?> <?php echo $this->Lang['RATINGS']; ?></span>
                                </div>
                                    <?php if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) {
                                    } else { ?>
                                    <a class="buy_it_fr" <?php if (!$this->UserID) { ?>href="javascript:showlogin('<?php if (isset($this->UserID)) {
                                        echo $this->UserID;
                                    } ?>','<?php echo $this->uri->segment(1); ?>','<?php echo $deals->deal_key; ?>','<?php echo $deals->url_title; ?>');" <?php } else { ?> href="<?php echo PATH . 'deal/payment_details_friend/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" <?php } ?>	 title="Send to a friend"><?php echo $this->Lang['SE_A_FR']; ?></a>
                                <?php } ?>
                            </div>
                            <div class="deal_bought_detail clearfix">
                                <div class="deal_bought_price">
                                    <span>(<?php echo round($deals->deal_percentage); ?>% <?php echo $this->Lang['OFFER']; ?>)</span>
                                    <strike><?php echo $symbol . " " . $deals->deal_price; ?></strike>
                                    <b><?php echo $symbol . " " . $deals->deal_value; ?> <?php echo CURRENCY_CODE; ?></b>                                    
                                    <p><?php echo $this->Lang['INCLU_OF_TAXES']; ?></p>
                                </div>
                                <div class="deal_bought_view">
                                <?php if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) { ?>
                                <?php } else { ?>
                                <?php if (($deals->purchase_count) < ($deals->minimum_deals_limit)) { ?>
                                <?php $total = ($deals->purchase_count * 100) / $deals->minimum_deals_limit; ?>
                                <h3><?php echo $deals->purchase_count; ?> <?php echo $this->Lang['BOUGHT']; ?></h3>
                                <div class="pg_bar"><div class="range_but" style="margin-left:<?php echo $total; ?>%"></div></div>
                                <p><span class="range_left">0</span><span class="range_right"><?php echo $deals->minimum_deals_limit; ?></span></p>
                                <?php } else { ?>
                                <h3 class="success_deal_on"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/success_tick.png" alt="" title=""> <?php echo $this->Lang['THE_DEAL_IS']; ?> <b><?php echo $deals->purchase_count; ?> <?php echo $this->Lang['BOUGHT']; ?></b>
                                </h3>
                                <?php } ?>
                                <?php } ?>
                                </div>
                            </div>
                            <div class="deal_valid_detail clearfix">
                                <div class="deal_price_detail">
                                    <div class="price_common">
                                        <p><?php echo $this->Lang['VALUE']; ?></p>
                                        <span><?php echo $symbol . " " . $deals->deal_price; ?></span>
                                    </div>
                                    <div class="price_common price_common_1">
                                        <p><?php echo $this->Lang['DISCOUNT']; ?></p>
                                        <span><?php echo round($deals->deal_percentage); ?>%</span>
                                    </div>
                                    <div class="price_common price_common_2">
                                        <p><?php echo $this->Lang['YOU_SAVE']; ?></p>
                                        <span><?php echo $symbol . " " . $deals->deal_savings; ?></span>
                                    </div>
                                </div>
                                <?php if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) { ?>
                                
                                <?php } else { ?>
                                <div class="deal_valid_time">
                                    <div class="time_price">
                                        <span time="<?php echo $deals->enddate; ?>" class="kkcount-down-detail" ></span>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="deal_share clearfix">
                                <div class="social_share">
                                    <div class="social_share">
                                        <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?> &amp;layout=button_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden;  height:21px; width:82px;" allowTransparency="true"></iframe>
                                            <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                                            <a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" data-count="horizontal"><?php echo $this->Lang['TWEET']; ?></a>
                                       <script type="text/javascript" src="https://apis.google.com/js/plusone.js">
                                            {parsetags: 'explicit'}
                                            </script>
                                            <!-- Place this tag where you want the +1 button to render -->
                                            <div class="g-plusone" data-size="medium" data-href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>"></div>
                                            <!-- Place this render call where appropriate -->
                                            <script type="text/javascript">gapi.plusone.go();</script>
                                             <li>
											<span class="ig-follow" data-id="<?php echo INSTAGRAM_ID; ?>" data-handle="<?php echo INSTAGRAM_USER; ?>" data-count="true" data-size="small" data-username="false"></span>
											<script>(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.src="//x.instagramfollowbutton.com/follow.js";s.parentNode.insertBefore(g,s);}(document,"script"));</script>
                                         </li>
                                    </div>
                                </div>

    <?php if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) { ?>
                                    <a class="buy_it" titile="<?php echo $this->Lang['SOLD_OUT2']; ?>" style="cursor:default;" ><?php echo $this->Lang['SOLD_OUT2']; ?></a>
                        <?php } else { ?>
                         <script type="text/javascript">
                                                        $(document).ready(function() {
                                                        $("#sold").hide();
                                                        setInterval(function()
                                                        {
                                                               var d = new Date();
                                                                var n = Math.floor(d.getTime()/1000);
                                                                var e = <?php echo $deals->enddate; ?>;
                                                                if(n > e){
                                                                        $("#auction").hide();
                                                                         $("#sold").show();
                                                                }
                                                        //alert(dis);
                                                        }, 1000);//time in milliseconds
                                                        });
                                                        </script>
                                                        <?php if ($deals->deal_status == "1"){ ?>
                                    <a class="buy_it" id="auction" href="<?php echo PATH . 'deals_payment/p/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php echo $this->Lang['BUY_NOW2']; ?> </a>
                                                        
                                    
                                    <a class="buy_it" id="sold" titile="<?php echo $this->Lang['SOLD_OUT2']; ?>" style="cursor:default;" ><?php echo $this->Lang['SOLD_OUT2']; ?></a>
                                    <?php } ?>
                        <?php } ?>

                            </div>



                        </div>
                    </div>

                    <div class="deal_descripe clearfix">
                        <h2 class="deal_sub_title"><?php echo ucfirst($deals->deal_title); ?></h2>
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
                                        content: '<b><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $deals->store_name); ?></b><p><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $deals->addr1); ?><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $deals->addr2); ?></p><p><?php echo $deals->city_name; ?>,<?php echo $deals->country_name; ?></p>'
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
                                <p><?php echo $deals->city_name; ?></p>
                                <p><?php echo $deals->country_name; ?></p>
                                <p><?php echo $this->Lang['MOBILE']; ?>: <?php echo $deals->phone; ?></p>
                                <p><?php echo $this->Lang['WEBSITE']; ?>:<a href="<?php echo $deals->website; ?>" target="blank" class="deal_web_link"> <?php echo $deals->website; ?></a>  </p>
                            </address>
                        </div>
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

                        <?php /* if (count($this->all_deals_list) > 0) { ?>
                          <div>

                          <div class="content_store_list">
                          <div class="slider_wrap">
                          <?php echo new View("themes/" . THEME_NAME . "/deals/deals_list"); ?>
                          </div>
                          </div>
                          </div>
                         */ ?>
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
                                    <div width="370" class="fb-comments" data-href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" data-num-posts="10" ></div>
                                </div>
                            </div>
                        </div>
                    <!--slider_right content start-->
    <?php if (count($this->all_deals_list) > 0) { ?>
<div class="deal_list_slide_outer">
    <h2 class="deal_sub_title"><?php echo $this->products_list_name; ?></h2> 
<div class="deal_list_slide clearfix">
        <?php /* <p> <?php echo $this->Lang['FEAT_DEALS']; ?></p> */ ?>

                            <div id="welcomeHero">
                                <div id="slideshow-carousel" <?php if (count($this->all_deals_list) <= 5) { ?> class="deallist_slider_center" <?php } ?>>
                                    <ul id="carousel" <?php if (count($this->all_deals_list) > 5) { ?> class="jcarousel jcarousel-skin-tango" <?php } ?>>

                                                    <?php
                                                    foreach ($this->all_deals_list as $deals1) {
                                                        if (($deals1->maximum_deals_limit == $deals1->purchase_count) || ($deals1->maximum_deals_limit < $deals1->purchase_count) || ($deals1->enddate < time())) {
                                                            
                                                        } else {
                                                            $symbol = CURRENCY_SYMBOL;
                                                            ?>
                                                <li>
                                                    <div class="product_listing">
                                                        <div class="deal_listing_image wloader_parent">
                                                            <i class="wloader_img">&nbsp;</i>
                                                            
                                                            <div class="deal_image_1">
                                                                <?php if ($this->session->get('cate') != "") { ?> <?php $url = $this->session->get('cate'); ?> <?php } else { ?> <?php $url = $deals1->category_url; ?>  <?php } ?>
                                                                <?php if (file_exists(DOCROOT . 'images/category/icon/' . $url . '.png')) { ?>

                <?php } else { ?>

                                                            <?php } ?>

                <?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals1->deal_key . '_1' . '.png')) { 
                 $image_url = PATH . 'images/deals/1000_800/' . $deals1->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                ?>
                                                                <a href="<?php echo PATH . $deals1->store_url_title.'/deals/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>">
                                                                 <?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
                                                                    <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/deals/1000_800/' . $deals1->deal_key . '_1' . '.png' ?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" >
                                                                    <?php } else { ?>
                                 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals1->deal_key.'_1'.'.png'?>" />
                                <?php } ?>

                                                                </a>
                <?php } else { ?>
                                                                <a href="<?php echo PATH . $deals1->store_url_title.'/deals/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" ></a>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="deal_image_2">
                                                                <a href="<?php echo PATH . $deals1->store_url_title.'/deals/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" ></a>
                                                            </div>
                                                        </div>
                                                        <div class="hot_label">
                                                                <p>OFF</p>
                                                                <p><?php echo round($deals1->deal_percentage); ?>%</p>
                                                            </div>
                                                        <div class="product_listing_detail">
                                                            <h2>
                                                                <?php $type = "";
                                                                $categories = $deals1->category_url;
                                                                ?>
                                                                <a class="cursor" href="<?php echo PATH . $deals1->store_url_title.'/deals/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>"><?php echo substr(ucfirst($deals1->deal_title), 0, 100); ?></a>
                                                            </h2>

                                                            <div class="deal_timer">
                                                                    <label>
                                                                        <span time="<?php echo $deals1->enddate; ?>" class="kkcount-down" ></span>
                                                                    </label>
                                                            </div>
                                                            <div class="deal_listing_price_details">
                                                                <strike><?php echo $symbol . " " . $deals->deal_price; ?></strike> 
                                                                <p><?php echo $symbol . " " . $deals1->deal_value; ?></p>
                                                            </div>											
                                                        </div>
                                                        <div class="list_bottom">
                                                        <div class="bottom_stars">
                                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
                                                        </div>
                                                        <div class="new_list_bottom_icons">
                                                            <ul>
                                                                <li class="new_cart"><a  href="<?php echo PATH . $deals1->store_url_title.'/deals/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php // echo $this->Lang['BUY_NOW2']; ?></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </li>
            <?php }
        }
        ?>
                                    </ul>
                                </div>
                            </div>

                        </div>
</div>
    <?php } ?>
                    <!--slider_right content end -->
                    
<?php } ?>
                <!--end-->

            </div>
        </div>


    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        // $.noConflict();
        $("body").kkCountDown({
            colorText:'#666',
            addClass : 'shadow',
            dayText:"<?php echo $this->Lang['DAY_TEXT']; ?>",
            daysText:"<?php echo $this->Lang['DAYS_TEXT']; ?>"
        });
    });
</script>



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
