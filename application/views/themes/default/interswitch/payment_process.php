<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="contianer_outer1">
    <div class="contianer_inner">
<div class="bread_crumb">
                <ul>
                    <li><p><?php echo $this->Lang["GLOBAL_PAY"]; ?></p></li>
                </ul>
            </div>
        <div class="contianer">
            <!--content start-->
            <div class="content_abouts">
                <div class="content_abou_common">                            
                    <h2 class="inner_commen_title"><?php echo $this->Lang["PROCEED_GLOBAL_PAY"]; ?></h2>                            
                    <div style="text-align: center; padding-top:25px;">
                        <form role="form" method="post" action="https://stageserv.interswitchng.com/test_paydirect/pay">
                        <ul>
                           <li>
                                    <label>Customer Name :</label>
                                    <div class="fullname">
                                        <input value="<?php echo $this->cust_name; ?>" 
                                                                 type="text" disabled/>
                                    </div>
                            </li>
                           <li>
                                    <label>Transaction Reference :</label>
                                    <div class="fullname">
                                        <input value="<?php echo $this->txn_ref; ?>" 
                                                                 type="text" disabled/>
                                    </div>
                            </li>
                           <li>
                                    <label>Total Amount to Pay :</label>
                                    <div class="fullname">
                                        <input value="&#8358 <?php echo number_format($this->total_amount_to_pay); ?>" 
                                                                 type="text" disabled/>
                                    </div>
                            </li>
                        </ul>
                            <input type="hidden" name="product_id" value="<?php echo $this->product_id; ?>"/>
                            <input type="hidden" name="amount" value="<?php echo intval($this->total_amount_to_pay*100); ?>"/>
                            <input type="hidden" name="currency" value="<?php echo $this->currency; ?>"/>
                            <input type="hidden" name="site_redirect_url" value="<?php echo $this->site_redirect_url; ?>"/>
                            <input type="hidden" name="site_name" value="<?php echo $this->site_name; ?>"/>
                            <input type="hidden" name="cust_id" value="<?php echo $this->cust_id; ?>"/>
                            <input type="hidden" name="cust_name" value="<?php echo $this->cust_name; ?>"/>
                            <input type="hidden" name="txn_ref" value="<?php echo $this->txn_ref; ?>"/>
                            <input type="hidden" name="pay_item_id" value="<?php echo $this->pay_item_id; ?>"/>
                            <input type="hidden" name="pay_item_name" value="<?php echo $this->pay_item_name; ?>"/>
                            <input type="hidden" name="hash" value="<?php echo $this->hash; ?>"/>
                            <input type="hidden" name="payment_params" value="<?php echo $this->payment_params; ?>"/>
                            <input type="hidden" name="xml_data" value='<?php echo $this->xml_data; ?>' />
                            
                            <div style="text-align:center">
                                <div class="buy_it complete_order_button" id="submit">                                                        
                                    <input type="submit" value="<?php echo $this->Lang['PAY_NOW']; ?>" tabindex="3" title="<?php echo $this->Lang['PAY_NOW']; ?>" />
                                </div>
                            </div>
                        </form>
                        <div style="clear:both;margin-top:10px;">
                            <img src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/new/payment_gateway_big.png"/>
                        </div>
                    </div>
                </div>
            </div>
            <!--end-->
        </div>
    </div>
</div>

