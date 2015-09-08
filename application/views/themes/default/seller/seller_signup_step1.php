<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

 <!-- SELLER SIGNUP -->
    <div class="contianer_outer">
        <div class="contianer_inner">
            <div class="contianer">
                <h2 class="seller_sign_title"><?php echo $this->Lang['WEL_SEL_SIGN']; ?></h2>
                <p class="seller_sign_info"><?php echo $this->Lang['YOU_GUIDED_CRTE_STRE']; ?></p>
                <div class="seller_signup clearfix">
                    <div class="seller_signup_menu">
                        <div class="seller_signup_introduction active_tab">
                            <span>01</span>
                            <p><?php echo $this->Lang['INTRO']; ?></p>
                        </div>
                        <div class="seller_signup_form_submit">
                            <span>02</span>
                            <p><?php echo $this->Lang['SIGN_UP']; ?></p>
                        </div>
                        <?php /*<div class="seller_signup_finish">                            
                            <span>03</span>
                            <p><?php echo $this->Lang['SECTOR_SEL']; ?></p>                            
                        </div>*/?>
                        <div class="seller_signup_finish">                            
                            <span>03</span>
                            <p><?php echo $this->Lang['FINISH']; ?></p>                            
                        </div>
                        
                    </div>                    
                    <div class="payouter_block pay_br">
                        <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['CRTE_YR_STRE']; ?>: <?php echo $this->Lang['INTRO']; ?></h3>
                        <div class="p_inner_block clearfix">
                            <p class="merchant_intro">
                            <?php echo $this->Lang['SELLER_INTRODUCTION']; ?>
                            
                            </p>
                        </div>
                    </div>                    
                    <div class="merchant_submit_buttons clearfix">                      
                        <a href="<?php echo PATH; ?>merchant-signup-step2.html" title="<?php echo $this->Lang['ACC']; ?>" class="buy_it"><?php echo $this->Lang['ACC']; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SELLER SIGNUP -->
