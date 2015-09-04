<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript"> 
        $(document).ready(function(){  
        $('.cancel_login').hide();
        $('.what_happens').hide();
        $('.what_buygift').hide();
        $('.can_change').hide();
        $('#down1').hide();
        $('#down2').hide();
        $('#down3').hide();
        });
</script>


        <div class="contianer_outer">
            <div class="contianer_inner">
				
                <div class="contianer">
					<div class="bread_crumb">
                        <ul>
                            <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                            <li><p><?php echo $this->Lang['ORD_SUCC']; ?></p></li>
                        </ul>
                    </div>



                    <!--content start-->
                    <div class="payouter_block pay_br">
                        <!--Blog content starts-->                        
                            <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['ORD_SUCC']; ?>                            
                            </h3>
                            <div class="p_inner_block clearfix">
                                  
                                                                  
                                <div class="payment_sucess_common">
                                    <div class="payment_sucss_lft">                                        
                                        <a href="#" title="Payment success">
                                            <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/payment_success_image.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="payment_sucss_rgt">

                                        <div class="payment_suc_content">
                                            <h1><?php echo $this->Lang["ORDER_STATUS"]; ?></h1>
                                            <h2><?php echo $this->Lang["YOUR_MER_APPR"]; ?></h2>
											
                                            <ul>
											
                                            </ul>
                                            <a class="success_back_home"  href="<?php echo PATH;?>" title="<?php echo $this->Lang["BACK_TO_HOME"]; ?>"><?php echo $this->Lang["BACK_TO_HOME"]; ?></a>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>                        
                    </div>
                    <!--Blog content ends-->
                </div>
            </div>
        </div>
