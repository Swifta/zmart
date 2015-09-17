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
<script type="text/javascript"> 
        function WhatHappens() {
                $('.what_happens').slideToggle(300);
                $('#down1').slideToggle(300);
                $('#right1').slideToggle(300);
                
        }
        function Whatbuygift() {
                 $('.what_buygift').slideToggle(300);
                 $('#down2').slideToggle(300);
                $('#right2').slideToggle(300);
        }
        function CanChange() {
                $('.can_change').slideToggle(300);
                $('#down3').slideToggle(300);
                $('#right3').slideToggle(300);
        }
</script>

        <div class="contianer_outer">
            <div class="contianer_inner">
				
                <div class="contianer">
					<div class="bread_crumb">
                        <ul>
                            <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                            <li><p><?php echo $this->Lang['PAY_SUCC']; ?></p></li>
                        </ul>
                    </div>



                    <!--content start-->
                    <div class="payouter_block pay_br">
                        <!--Blog content starts-->                        
                            <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['PAY_SUCC']; ?>                            
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
                                            <h2><?php echo $this->Lang["YOUR_PAYMENT_SUCCESS"]; if(isset($this->is_store_credit)) {  echo " and ".$this->Lang["YOUR_MER_APPR"]; } ?></h2>
											<?php $R = $this->result; ?>
                                            <ul>
												<?php if(isset($R->TIMESTAMP)){ ?>
												<li><label><?php echo $this->Lang["TRAN_TIME"]; ?> </label><span>:</span><p><?php echo $R->TIMESTAMP; ?></p></li>
												<?php } if(isset($R->ACK)){ ?>
												<li><label><?php echo $this->Lang["TRAN_STATUS"]; ?> </label><span>:</span><p><?php echo $R->ACK; ?></p></li>
												<?php } if(isset($R->AMT)){ ?>
												<li><label><?php echo $this->Lang["TRAN_AMOUNT"]; ?> </label><span>:</span><p><?php echo $R->AMT; ?></p></li>
												<?php } if(isset($R->CURRENCYCODE)){ ?>
												<li><label><?php echo $this->Lang["CURR_CODE"]; ?>  </label><span>:</span><p><?php echo $R->CURRENCYCODE; ?></p></li>
												<?php } ?>
                                            </ul>
                                            <a class="success_back_home"  href="<?php echo PATH;?>" title="<?php echo $this->Lang["BACK_TO_HOME"]; ?>"><?php echo $this->Lang["BACK_TO_HOME"]; ?></a>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>                        
                        <?php /* <div class="pay_br payright_block">
                            <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['PAY_MEN']; ?></h3>
                            <div class="payment-faq-container">                                
                                <div class="faq-content2">
                                    <div class="faq-content-heading">
                                        <div class="faq-content-heading-left">
											<div class="faq-content-arrow-right" id="right1">
												<a onclick="return WhatHappens();"><?php echo $this->Lang['WAT_HAPP']; ?></a>
											</div>
										</div>
										 <div class="faq-content-heading-left">
											<div class="faq-content-arrow-down" id="down1">
												<a onclick="return WhatHappens();"><?php echo $this->Lang['WAT_HAPP']; ?></a>
											</div>
										</div>
										 
                                    </div>
                                     <div class="what_happens"> 
                                    <div class="faq-content-text">
										<p><?php echo $this->Lang['WHILE_BUY_A_PRODUCT']; ?></p>
                                       
                                    </div>
                                    </div>
                                    
                                </div>
                                <div class="faq-content2">
                                    <div class="faq-content-heading">
                                        <div class="faq-content-heading-left">
										<div class="faq-content-arrow-right" id="right2">
												<a onclick="return Whatbuygift();"><?php echo $this->Lang['DO_I_NEED']; ?></a>
											</div>
										</div>
										 <div class="faq-content-heading-left">
											<div class="faq-content-arrow-down" id="down2">
												<a onclick="return Whatbuygift();"><?php echo $this->Lang['DO_I_NEED']; ?></a>
											</div>
										</div>

                                    </div>
                                     <div class="what_buygift">  
									<div class="faq-content-text">
										<p><?php echo $this->Lang['ITS_QUITE_OPTIONAL']; ?></p>
									</div>
									</div>
                                </div>
                                <div class="faq-content2">
                                    <div class="faq-content-heading">
                                        <div class="faq-content-heading-left">
											<div class="faq-content-arrow-right" id="right3">
												<a onclick="return CanChange();"><?php echo $this->Lang['MAY_I_USE']; ?></a>
											</div>
										</div>
										 <div class="faq-content-heading-left">
											<div class="faq-content-arrow-down" id="down3">
												<a onclick="return CanChange();"><?php echo $this->Lang['MAY_I_USE']; ?></a>
											</div>
										</div>
										<div class="can_change">
											<div class="faq-content-text">
												<p><?php echo $this->Lang['OBVIOUSLY_YES']; ?></p>
											</div>
										</div>

                                    </div>
                                </div>

                            </div>



                        </div> */ ?>
                    </div>
                    <!--Blog content ends-->
                </div>
            </div>
        </div>
