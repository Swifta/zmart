<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
		$('#fade').css({'filter' : 'alpha(opacity=100)'}).fadeIn();
		$('#fade').css({'visibility' : 'visible'});
	});
</script>
<style>
#fade { background: #fff; position: fixed; left: 0; top: 0; width: 100%; height: 100%; opacity: 1.0; z-index: 9999; }
</style>
<div class="bidding_auction" >
	<!--QTY header start-->
        <div class="header_outer">
            <div class="qty_header_top_inner">
                <div class="logo">
                    <h1>
                        <a href="<?php echo PATH;?>" title="logo"><img alt="logo" src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png" /></a>
                    </h1>
                </div>
            </div>
        </div> 
	<!--QTY header end-->
<!--QTY CONTENT start-->
	<form method="post" name="success" action="<?php echo PATH;?>auction/success_bidding" >                                  
                    <div class="qty_content_outer">
                        <div class="qty_heading">
							<input type="hidden" id="new_bid" name="bid_value" value="<?php echo $this->current_bid_value; ?>" >
							<input type="hidden"  name="bid_deal_id" value="<?php echo $this->deal_id; ?>" >
							<input type="hidden"  name="bid_deal_key" value="<?php echo $this->deal_key; ?>" >
							<input type="hidden"  name="bid_title" value="<?php echo $this->bid_title; ?>" >
							<input type="hidden"  name="bid_url_title" value="<?php echo $this->url_title; ?>" >
							<input type="hidden" name="shipping_amount" value="<?php echo $this->shipping_amount; ?>" >
							<input type="hidden" name="end_time" value="<?php echo $this->end_time; ?>" >
							<input type="hidden" name="store_url" value="<?php echo $this->store_url; ?>" >
                            <h2><?php echo $this->bid_title; ?></h2>
                            <p><?php echo $this->Lang['BID_AMO']; ?>: <?php echo CURRENCY_SYMBOL." ".$this->current_bid_value; ?></p>
                        </div>
                        <div class="qty_content">
                            <div class="qty_content_left">
								
									<?php if(file_exists(DOCROOT.'images/auction/1000_800/'.$this->deal_key.'_1'.'.png')) {
								$image = PATH.'images/auction/1000_800/'.$this->deal_key.'_1'.'.png';
							} else {
								$image = PATH."themes/".THEME_NAME."/images/noimage_auctions_details.png";
							} ?>
                                <a href="" title="bid_image">
                                    <img src="<?php echo $image; ?>" alt="bid_image"/>
                                </a>
                            </div>
                            <div class="qty_content_right">
                                <div class="qty_top_box">
                                    <h3><?php echo $this->Lang['BID_SUMM']; ?></h3>
                                    <ul>
                                       <?php /* <li>
                                            <div class="bs_row">
                                                <div class="bs_row_left">
                                                    <p>Auction Amount:</p>
                                                </div>
                                                <div class="bs_row_right">
                                                    <p>2@$45/ea.</p>
                                                </div>
                                            </div>
                                        </li> */ ?>
                                        <li>
                                            <div class="bs_row">
                                                <div class="bs_row_left">
                                                    <p><?php echo $this->Lang['BID_AMOUN']; ?>:</p>
                                                </div>
                                                <div class="bs_row_center">
                                                    <p>:</p>
                                                </div>
                                                <div class="bs_row_right">
                                                    <p><?php echo CURRENCY_SYMBOL." ".$this->current_bid_value; ?></p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bs_row">
                                                <div class="bs_row_left">
                                                    <p><?php echo $this->Lang['SHIP_AMOU']; ?></p>
                                                </div>
                                                <div class="bs_row_center">
                                                    <p>:</p>
                                                </div>
                                                <div class="bs_row_right">
                                                    <p><?php echo CURRENCY_SYMBOL." ".$this->shipping_amount; ?></p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bs_row">
                                                <div class="bs_row_left">
                                                    <b><?php echo $this->Lang['TOTAL']; ?></b>
                                                </div>
                                                <div class="bs_row_center">
                                                    <p>:</p>
                                                </div>
                                                <div class="bs_row_right">
                                                    <p class="row_price"><?php echo CURRENCY_SYMBOL." ".($this->current_bid_value + $this->shipping_amount); ?></p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bs_row">
                                                <div class="bs_row_left">&nbsp;</div>
                                                <div class="bs_row_center">&nbsp;</div>
                                                <div class="bs_row_right">
                                                    <input class="sign_submit" type="submit" value="<?php echo $this->Lang['PLC_BID']; ?>">
                                                </div>                                                              
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="qty_box_notes">
                                        <h4>Good News !</h4>
                                        <p>A product of Telekonnectors Ltd. selling speciality mobile phones for 
elderly and physically information to Indians living in Australia. </p>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    <div class="qty_footer_list">
                        <ul>
                             <li><?php echo $this->Lang['ALTER_INFO_WIN']; ?></li>
                            <li><?php echo $this->Lang['YOUR_CREDIT_C_NOT']; ?></li>
                            <li><?php echo $this->Lang['A_TRANS_MIN']; ?></li>
                            <li><?php echo $this->Lang['OR_CAN_CREDIT_CA']; ?></li>
                            <li><?php echo $this->Lang['AP_SALES_TAX']; ?>  <?php echo $this->Lang['TENN_O']; ?> </li>
                            <li><?php echo $this->Lang['BY_BID_AG']; ?> <?php echo $this->Lang['BID_RULE']; ?></li>
                        </ul>  
                    </div>                            
        </div>
	</form>
<!--QTY CONTENT ends-->
</div>


