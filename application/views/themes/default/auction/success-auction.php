<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<script type="text/javascript" src="<?php echo PATH; ?>js/timer/kk_countdown_1_2_jquery_min_detail.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("body").kkCountDowndetail({
            colorText: '#7b7b7b',
            addClass: 'shadow'
        });
    });
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
		$('#fade').css({'filter' : 'alpha(opacity=100)'}).fadeIn();
		$('#fade').css({'visibility' : 'visible'});
		$("body").kkCountDown({
		colorText:'black',
		addClass : 'shadow',
		dayText:"<?php echo $this->Lang['DAY_TEXT'];?>",
		daysText:"<?php echo $this->Lang['DAYS_TEXT'];?>"
		});
		
	});
</script>
<style>
#fade { background: #fff; position: fixed; left: 0; top: 0; width: 100%; height: 100%; opacity: 1.0; z-index: 9999; }
</style>


<div class="bidding_auction">
        <!--QTY header start-->
        <div class="header_outer">
            <div class="qty_header_top_inner">
                <div class="logo">
                    <h1>
                       <a href="<?php echo PATH;?>" title="<?php echo $this->Lang['LOGO']; ?>"><img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png" /></a>
                    </h1>
                </div>
            </div>
        </div> 
        <!--QTY header end-->

        <!--QTY CONTENT start-->
        
                    <div class="qty_content_outer">
                        <div class="qty_heading">
                            <h3><?php echo $this->Lang['CONGRA']; ?>!<span><?php echo $this->Lang['Y_BID_PLACE_SUCC']; ?></span></h3>
                            <p>You’ll receive an email confirmation shortly </p>
                        </div>
                        <div class="qty_content">
                            <div class="qty_content_left">
									<?php if(file_exists(DOCROOT.'images/auction/1000_800/'.$this->deal_key.'_1'.'.png')) {
										$image = PATH.'images/auction/1000_800/'.$this->deal_key.'_1'.'.png';
									} else {
										$image = PATH."themes/".THEME_NAME."/images/noimage_auctions_details.png";
									} ?>
                                <a title="<?php echo $this->Lang['IMAGE']; ?>">
                                    <img src= "<?php echo $image; ?>" alt="<?php echo $this->Lang['IMAGE']; ?>"/>
                                </a>
                            </div>
                            <div class="qty_content_right">
                                <div class="qty_top_box_1">
                                    <div class="qty_box_commom">
                                        <ul>
                                            <li class="amount_bid">
                                                <label><?php echo $this->Lang['BID_AMOUN']; ?> :</label>
                                                <span><?php echo CURRENCY_SYMBOL." ".$this->current_bid_value; ?></span>
                                            </li>
                                            <li class="amount_bid">
                                                <label><?php echo $this->Lang['ESTI_SHIPP_CHAR']; ?> :</label>
                                                <span><?php echo CURRENCY_SYMBOL." ".$this->shipping_amount; ?></span>
                                            </li>
                                            <li>
                                                <span time="<?php echo $this->end_time; ?>" class="kkcount-down-detail" ></span>
                                            </li>
                                            <li>
                                                <h5><?php echo $this->Lang['AUC_T_REMAIN']; ?></h5>
                                            </li>
                                            <li>
                                                <div class="bs_row success_close">                                                    
                                                    <input class="sign_submit" type="button" value="<?php echo $this->Lang['CLS_WIN']; ?>" onclick="javascript:window.location='<?php echo PATH; ?><?php echo $this->store_url; ?>/auction/<?php echo $this->deal_key ; ?>/<?php echo $this->url_title; ?>.html'" >
                                                </div>
                                            </li>
                                            
                                        </ul>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="qty_footer_list">
                        <ul>
                            <li><?php echo $this->Lang['ALTER_INFO_WIN']; ?></li>
                            <li><?php echo $this->Lang['YOUR_CREDIT_C_NOT']; ?></li>
                            <li><?php echo $this->Lang['A_TRANS_MIN']; ?></li>
                            <li><?php echo $this->Lang['AP_SALES_TAX']; ?></li>
                            <li><?php echo $this->Lang['AP_SALES_TAX']; ?> &amp; <?php echo $this->Lang['TENN_O']; ?></li>
                            <li><?php echo $this->Lang['BY_BID_AG']; ?> &amp; <?php echo $this->Lang['BID_RULE']; ?></li>
                        </ul>  

                    </div>
                
        <!--QTY CONTENT ends-->
</div>

    </body>

