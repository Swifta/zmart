<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript"> 
        	$(document).keyup(function(e) { 
        if (e.keyCode == 27) { // esc keycode
            $('div#show').hide();
            $('div#show_tc').hide();
			$('#fade').css({'visibility' : 'hidden'});
	  	        //location.reload();
		return false;
        }
    });
    
    $(document).ready(function(){ 
        function blink(selector){
            $(selector).fadeOut('slow', function(){
                $(this).fadeIn('slow', function(){
                    blink(this);
                });
            });
        }
        blink('.blink');
<?php if ($this->paypal_setting) { ?> 
            $('.cancel_login').hide();
<?php } else { ?>
            $('.befor_login').hide();
            $('.cancel_login').show();
<?php } ?>
        $('.AuthorizeNet_pay').hide();
        $('.cash_pay').hide();
        $('.what_happens').hide();
        $('.what_buygift').hide();
        $('.can_change').hide();
        $('.ref_paypal').hide();
        $('#down1').hide();
        $('#down2').hide();
        $('#down3').hide();
        
        var tooltipTimeout;
        $("#someelem").hover(function()
        {tooltipTimeout = setTimeout(showTooltip, 2);}, 
        hideTooltip);
        function hideTooltip()
        {
            clearTimeout(tooltipTimeout);
            $("#tooltip").fadeOut().remove();
        }
    
        var tooltipTimeouttax;
        $("#someelemtax").hover(function()
        {tooltipTimeouttax = setTimeout(showTooltiptax, 2);}, 
        hideTooltiptax);
        function hideTooltiptax()
        {
            clearTimeout(tooltipTimeouttax);
            $("#tooltiptax").fadeOut().remove();
        }
    
        function showTooltiptax()
        {
            var tooltiptax = $("<div id='tooltiptax' class='tooltiptax'> <?php echo $this->Lang['TX_AMT']; ?> = <?php echo TAX_PRECENTAGE_VALUE; ?>% <br><?php echo $this->Lang['TOT_AMT']; ?><br><?php echo $this->Lang['TX']; ?></div>");
            tooltiptax.appendTo($("#someelemtax"));
        }
    });
</script>

<script type="text/javascript"> 
    $('.cancel_login').hide();
    function SimilarDeals() {
        $('.error').html('');
        $('.cancel_login').show();
        $('.befor_login').hide();
        $('.AuthorizeNet_pay').hide();
        $('.cash_pay').hide();
    }
    function SimilarProducts() {
        $('.error').html('');
        $('.befor_login').show();
        $('.cancel_login').hide();
        $('.AuthorizeNet_pay').hide();
        $('.cash_pay').hide();
    }
    function Authorize() {
        $('.error').html('');
        $('.befor_login').hide();
        $('.cancel_login').hide();
        $('.AuthorizeNet_pay').show();
        $('.cash_pay').hide();
    }
    function cash_delivery() {
        $('.error').html('');
        $('.cash_pay').show();
        $('.befor_login').hide();
        $('.cancel_login').hide();
        $('.AuthorizeNet_pay').hide();
				
    }
        
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
    function show_dis()
		{
		         
			$("form#submit_changes").validate({
				submitHandler: function(form) {  // How to repace this? 
					$.post('<?php echo PATH;?>products/update_shipping_address/', $("form#submit_changes").serialize(), function(data) { 
						$('#new_shipping_address').html(data);
                                                $('#fade').css({'visibility' : 'hidden'});
						$('div#show').hide();
					}); 
				}
				});
			        $('#fade').css({'visibility' : 'visible'});
				$('div#show').show();
		}	
		
		function hide_shipping_addr()
		{
			$('div#show').hide();
                        $('#fade').css({'visibility' : 'hidden'});
		}
		
		
		function show_dis_tc()
		{
			        $('#fade').css({'visibility' : 'visible'});
				$('div#show_tc').show();
		}	
		
		function hide_shipping_addr_tc()
		{
			$('div#show_tc').hide();

                        $('#fade').css({'visibility' : 'hidden'});
		}
</script>

</div>
</div>
</div>
<!--end-->
<div class="contianer_outer">
    <div class="contianer_inner">
        <div class="contianer">
        <div class="bread_crumb">
            <ul>
                <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                <li><p><?php echo $this->Lang['PRO_PAY']; ?></p></li>
            </ul>
        </div>
        

            <!--content start-->                        
            <div class="payouter_block">
            <div class="pay_br payleft_block">                                          
                    <?php /* <h2 class="inner_commen_title"><?php echo $this->Lang['PRO_PAY']; ?></h2> 


                        <p class="lp-status-text"><?php echo $this->Lang['YOU_CURRENTLY_HAVE']; ?> <?php
if ($this->session->get('count') != "") {
    echo $this->session->get('count');
} else {
    echo "0";
}
?> <?php echo $this->Lang['PRO_SH_CA']; ?>.</p>*/ ?>   
                        <div class="cart_table clearfix">
                            <table class="mcart_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0" >                                        
                                <thead class="pay_titlebg">
                                    <tr>                                            
                                        <th width="100" align="left"><?php echo $this->Lang['IMAGE']; ?></th>
                                        <th width="300" align="left" <?php if ($this->shipping_setting != 4) { ?> colspan="3"
                                        <?php } ?> ><?php echo $this->Lang['DESC']; ?></th>
                                        <th <?php if ($this->shipping_setting != 4) { ?> width="100" <?php } else { ?> width="200" <?php } ?>align="left"><?php echo $this->Lang['QUAN']; ?></th>
                                        <th width="20" align="left"></th>
                                        <th width="100" align="left"><?php echo $this->Lang['PRI']; ?></th>
                                        <th width="20" align="left"></th>
                                        <?php if ($this->shipping_setting == 4) { ?>
                                            <th width="100" align="left"><?php echo $this->Lang['SHIP_ING']; ?></th>
                                        <th width="100" align="left"></th>
                                        <?php } ?>
                                        <th width="20" align="left"><?php echo $this->Lang['TOTAL']; ?></th>                                                                                                                                                            
                                        <th width="20"  >Remove</th>                                                                                                                
                                    </tr>
                                </thead>                                                                    


                                <?php
                                $total_amount = "0";
                                $shippingamount = "0";
                                $flatamount = "0";
                                $per_productshipping = "0";
                                $add_productshipping = "0";
                                $itemshippingamount = "0";
                                $taxamount = "0";
                                $shippingamountcurrency = "0";
                                

                                if ($this->shipping_setting == 3) {

                                    foreach ($_SESSION as $key => $value) {
                                        if ((is_string($value)) && ($key == 'product_cart_id' . $value)) {
                                            $this->products = new Products_Model();
                                            $this->get_cart_products = $this->products->get_cart_products($this->session->get($key));
                                            foreach ($this->get_cart_products as $products) {
                                            
                                                $results = common::shipping_rates_calculator($products->weight, $products->length, $products->width, $products->height);	
	                                        if($results->HasErrors == 1){
	                                                $this->Message   = $results->Notifications->Notification->Message;
	                                                common::message(-1, "Aramax Shipping : ".$this->Message);
	                                                url::redirect(PATH."prodicts/cart.html");
	                                        }
	                                        $this->CurrencyCode = $results->TotalAmount->CurrencyCode;
	                                        $this->shipping_amount = $results->TotalAmount->Value;
	                                        if($this->CurrencyCode !=CURRENCY_CODE){ // for Currency conversion
			                                $per_productshipping += common::currency_conversion($this->CurrencyCode,CURRENCY_CODE,$this->shipping_amount);                          
			                                $shippingamountcurrency = common::currency_conversion($this->CurrencyCode,CURRENCY_CODE,$this->shipping_amount);
			                                $currencyCode = CURRENCY_CODE;
		                                }
		                                 $add_productshipping .= number_format((float) $shippingamountcurrency, 2, '.', '') . " + <br> ";
                                                //$per_productshipping += $products->shipping_amount;
                                               // $add_productshipping .= number_format((float) $products->shipping_amount, 2, '.', '') . " + <br> ";
                                            }
                                        }
                                        ?>

                                        <script type="text/javascript"> 
                                            function showTooltip()
                                            {
                                                                                
                                                var tooltip = $("<div id='tooltip' class='tooltip'><?php echo $add_productshipping; ?> <hr> <?php echo $this->Lang['SHIP_AMOU']; ?> = <?php echo number_format((float) $per_productshipping, 2, '.', ''); ?>   </div>");
                                                tooltip.appendTo($("#someelem"));
                                            }
                                                                            
                                                                            
                                        </script>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                foreach ($_SESSION as $key => $value) {
                                    if ((is_string($value)) && ($key == 'product_cart_id' . $value)) {
                                        $this->products = new Products_Model();
                                        $this->get_cart_products = $this->products->get_cart_products($this->session->get($key));
                                        foreach ($this->get_cart_products as $products) {

                                            $results = common::shipping_rates_calculator($products->weight, $products->length, $products->width, $products->height);	
	                                        if($results->HasErrors == 1){
	                                                $this->Message   = $results->Notifications->Notification->Message;
	                                                common::message(-1, "Aramax Shipping : ".$this->Message);
	                                                url::redirect(PATH."prodicts/cart.html");
	                                        }
	                                        $this->CurrencyCode = $results->TotalAmount->CurrencyCode;
	                                        $this->shipping_amount = $results->TotalAmount->Value;
	                                        if($this->CurrencyCode !=CURRENCY_CODE){ 
	                                                // for Currency conversion
			                                $shippingamountcurrency = common::currency_conversion($this->CurrencyCode,CURRENCY_CODE,$this->shipping_amount);
		                                }
		                                
                                            $get_size_name = $this->products->get_size_data($products->deal_id);
                                            $get_color_data = $this->products->get_color_data($products->deal_id);
                                            $taxamount = TAX_PRECENTAGE_VALUE;

                                            /* 1- Free Shipping ,  2- Flat Shipping, 3- Per Product Shipping , 4- Per Item Shipping */
                                            if ($this->shipping_setting == 1) {
                                                $shippingamount = 0;
                                            } elseif ($this->shipping_setting == 2) {
                                                $shippingamount = 0;
                                                $flatamount = FLAT_SHIPPING_AMOUNT;
                                            } elseif ($this->shipping_setting == 3) {
                                                $shippingamount = 0;
                                                $flatamount = $per_productshipping;
                                            } elseif ($this->shipping_setting == 4) {
                                                $itemshippingamount = $products->shipping_amount;
                                                $shippingamount = $products->shipping_amount;
                                            }
                                            ?>
                                            <tr>

                                                <td>
                                                        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { ?>
                                                        <a href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>">
                                                            <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png'; ?>&w=80&h=80" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" /></a>

                                                    <?php } else { ?>
                                                        <a href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" width="80" height="80" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>"></a>

            <?php } ?> 
                                                </td>                                                                
                                                <td <?php if ($this->shipping_setting != 4) { ?> colspan="3"
                                        <?php } ?>>                                                                        
                                                    <h3 class="cart_desc_title"><a href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>"><?php echo $products->deal_title; ?></a></h3>
                                                    <p><?php echo substr(strip_tags($products->deal_description), 0, 50); ?></p>                                                                                                                                                        			

                                                    <div  class="clearfix">                                                                            
                                                        <div class="cart_color_detail">
                                                            <?php /*
                                                            if (count($get_color_data) > 1) {
                                                                foreach ($get_color_data as $gc) {
                                                                    if ($gc->color_code_id == $this->session->get('product_color_qty' . $products->deal_id)) {
                                                                        ?>
                                                                        <p class="cc-desc-title" ><?php echo $this->Lang['SEL_COL']; ?>: <span><?php echo $gc->color_code_name; ?></span></p>
                                                                        <?php
                                                                    }
                                                                }
                                                            } */ 
                                                            ?>
                                                        </div>


                                                        <div class="cart_color_detail">
                                                            <?php /*
                                                            $nosize = "";
                                                            if (count($get_size_name) > 0) {
                                                                foreach ($get_size_name as $gs) {
                                                                    if ($gs->size_name == "None") {
                                                                        $nosize = 1;
                                                                        $this->session->set('product_quantity_qty' . $products->deal_id, $gs->quantity);
                                                                        ?>
                                                                        <p><?php echo $this->Lang['AVAIL_QUAN']; ?>: <span><?php echo $get_size_name[0]->quantity; ?></span></p>	 
                                                                        <?php
                                                                    } else {
                                                                        if ($gs->size_id == $this->session->get('product_size_qty' . $products->deal_id)) {

                                                                            $this->session->set('product_quantity_qty' . $products->deal_id, $gs->quantity);
                                                                            ?>

                                                                            <p><?php echo $this->Lang['SELE_SIZE']; ?> <span><?php echo $gs->size_name; ?></span></p>
                                                                            <p><?php echo $this->Lang['AVAIL_QUAN']; ?> <span><?php echo $gs->quantity; ?></span></p>     


                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            }  */
                                                            ?>

                                                        </div>                                                                             
            <?php /* if (count($get_color_data) > 1) { ?> 
                                                            <div class="cart_select_detail">
                                                                <label><?php echo $this->Lang['COLOR']; ?>:</label>

                                                                <select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
                                                                    <option> <?php echo $this->Lang['COL']; ?> </option> 
                                                                    <?php
                                                                    foreach ($get_color_data as $gc) {
                                                                        if ($gc->color_code_id != $this->session->get('product_color_qty' . $products->deal_id)) {
                                                                            ?>
                                                                            <option value="<?php echo PATH . 'products/addmore_paycolor/' . $gc->color_code_id . '/' . $products->deal_id; ?>" style="color:#<?php echo $gc->color_name; ?>"> <?php echo $gc->color_code_name; ?> </option>  
                    <?php
                    }
                }
                ?>
                                                                </select>		



                                                            </div>
                                                        <?php } */ ?>
                                                        <?php
                                                        $i = 0; // for check the one size is there
                                                        foreach ($get_size_name as $gs) {
                                                            if (($gs->quantity != 0) && ($gs->size_id != $this->session->get('product_size_qty' . $products->deal_id))) {
                                                                $i++;
                                                                ?>

                                                            <?php
                                                            }
                                                        }
                                                        ?>

            <?php  /*
            if (count($get_size_name) > 1 && ($i != 0)) {
                if ($nosize == "") {
                    ?>
                                                                <div class="cart_select_detail">
                                                                    <label><?php echo $this->Lang['SIZE']; ?>:</label>

                                                                    <select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
                                                                        <option> <?php echo $this->Lang['SIZZ']; ?> </option> 
                                                                        <?php
                                                                        foreach ($get_size_name as $gs) {
                                                                            if (($gs->quantity != 0) && ($gs->size_id != $this->session->get('product_size_qty' . $products->deal_id))) {
                                                                                ?>
                                                                                <option value="<?php echo PATH . 'products/addmore_cart_size/' . $gs->size_id . '/' . $products->deal_id . '/' . $gs->quantity; ?>"> <?php echo $gs->size_name; ?> </option>  
                                                                    <?php
                                                                    }
                                                                }
                                                                ?>
                                                                    </select>
                                                                </div> 
                <?php } ?>	
                                                    <?php }  */ ?>

                                                    <?php if (($this->shipping_setting == 3)) { ?>
                                                            <p><?php echo $this->Lang['SHIP_FEE']; ?>: <span><?php echo CURRENCY_SYMBOL; ?><?php echo number_format((float) $shippingamountcurrency, 2, '.', ''); ?></span></p>							
            <?php } ?>
                                                    </div> 

                                                </td>
                                                
                                                <td>
                                                
                                                
                                                <?php
                                                            $nosize = "";
                                                            $size_count = "";
                                                            if (count($get_size_name) > 0) {
                                                                foreach ($get_size_name as $gs) {
                                                                    if ($gs->size_name == "None") {
                                                                        $nosize = 1;
                                                                        $this->session->set('product_quantity_qty' . $products->deal_id, $gs->quantity);
                                                                        $size_count = $get_size_name[0]->quantity;
                                                                        
                                                                        ?>
                                                                        
                                                                        <?php
                                                                    } else {
                                                                        if ($gs->size_id == $this->session->get('product_size_qty' . $products->deal_id)) {

                                                                            $this->session->set('product_quantity_qty' . $products->deal_id, $gs->quantity);
                                                                            
                                                                            $size_count = $gs->quantity;
                                                                            
                                                                            ?>
                                                   
                                                                           


                                                                            <?php
                                                                        }
                                                                    }
                                                                }

                                                            } 
                                                            ?>
                                                            
            <?php
            if ($size_count > 1) {
                ?>
                                                        <div class="lessthen">
                                                            <a class="less_min" id="QtyDown" onclick="<?php echo $key; ?>1()"></a>
                                                        </div>
            <?php } ?>
                                                    <div class="lessthen1">
                                                        <input name="QTY" id="<?php echo $key; ?>" value="1" readonly="readonly" type="text" rel="20">
                                                    </div>
            <?php
            if ($size_count > 1) {
                ?>
                                                        <div class="greaterthen">
                                                            <a class="plus" id="QtyUp" onclick="<?php echo $key; ?>()"></a>
                                                        </div>
                                                <?php } ?>

                                                </td>


                                                <td>X </td>	
                                                <td><?php echo CURRENCY_SYMBOL . $products->deal_value; ?></td>

            <?php if ($this->shipping_setting == 4) { ?>
                                                    <td>+</td>	
                                                    <td><?php echo CURRENCY_SYMBOL; ?><span id="<?php echo $key; ?>amount_shipping"><?php echo number_format((float) $products->shipping_amount, 2, '.', ''); ?></span></td>	
            <?php } ?>
                                                <td>=<?php $product_quantity = $this->session->get('product_quantity_qty' . $products->deal_id); ?></td>

                                            <script>
                                                                                                
                                                function <?php echo $key; ?>()
                                                {  
                                                    if($('#<?php echo $key; ?>').val()!=<?php echo $size_count; ?>) {
                                                        var plus_amount = parseInt($('#<?php echo $key; ?>').val()) + 1;
                                                        $('#RE_QTY_VAL').val(plus_amount);
                                                        $('#PC_QTY_VAL<?php echo $key; ?>').val(plus_amount);
                                                        $('#PCC_QTY_VAL<?php echo $key; ?>').val(plus_amount); 
                                                        $('#COD_QTY_VAL<?php echo $key; ?>').val(plus_amount); 										
                                                        $('#APCC_QTY_VAL<?php echo $key; ?>').val(plus_amount); 
                                                                                                        
                                                        $('#PRO_REFERRAL').val('0');
                                                        $('#PC_REFERRAL').val('0');
                                                        $('#COD_REFERRAL').val('0');
                                                        if(plus_amount!="0"){
                                                            $('#<?php echo $key; ?>').val(plus_amount); 
                                                        }
                                                        var total_amount = ((<?php echo $itemshippingamount; ?>)*plus_amount) + ((<?php echo $products->deal_value; ?>)*plus_amount);
                                                        var total_shipp = ((<?php echo $shippingamount; ?>)*plus_amount);
                                                        var keyamountshipping = total_shipp.toFixed(2);
                                                        $('#<?php echo $key; ?>amount_shipping').text(keyamountshipping);
                                                        if(total_amount!="0") {
                                                                                                            
                                                            var keyamount = total_amount.toFixed(2);
                                                            $('#<?php echo $key; ?>amount').text(keyamount);
                                                            var qqqq = parseFloat($('#totalamount').text())+<?php echo $products->deal_value; ?>+<?php echo $itemshippingamount; ?>;
                                                            var qqq = qqqq.toFixed(2); 
                                                            var flatqqq = qqqq+<?php echo $flatamount; ?>;
                                                            var flat = flatqqq.toFixed(2);    
                                                                                                            
                                                            var taxqqq = (<?php echo $taxamount; ?>/100)*flat;
                                                            var taxvalue = taxqqq.toFixed(2); 
                                                                                                            
                                                            $('#totalamount').text(qqq);  
                                                            $('#Grandamount').text(qqq);
                                                            $('#TotalAmount').val(qqq);
                                                            $('#P_TotalAmount').val(qqq);
                                                            $('#COD_TotalAmount').val(qqq);
                                                            $('#ref').val('0');
                                                            $('#PRO_REFERRAL').val('0');
                                                            $('#PC_REFERRAL').val('0');
                                                            $('#COD_REFERRAL').val('0');
                                                        }
                                                    }
                                                    $('#taxamount').text(taxvalue); 
                                                    var totgrand = (parseFloat(flat)+parseFloat(taxvalue));
                                                    var totgrandval = totgrand.toFixed(2);
                                                    if(totgrandval != "NaN"){
                                                        $('#Grandamount').text(totgrandval); 
                                                    }
                                                                                                    
                                                                                                    
                                                                                                    
                                                }
                                                                                                
                                                function <?php echo $key; ?>1()
                                                { 
                                                    if($('#<?php echo $key; ?>').val()>1){
                                                        var plus_amount = parseInt($('#<?php echo $key; ?>').val()) - 1;
                                                        $('#RE_QTY_VAL').val(plus_amount);
                                                        $('#PC_QTY_VAL<?php echo $key; ?>').val(plus_amount);
                                                        $('#PCC_QTY_VAL<?php echo $key; ?>').val(plus_amount);
                                                        $('#COD_QTY_VAL<?php echo $key; ?>').val(plus_amount);
                                                        $('#APCC_QTY_VAL<?php echo $key; ?>').val(plus_amount);
                                                        $('#PRO_REFERRAL').val('0');
                                                        $('#PC_REFERRAL').val('0');
                                                        $('#COD_REFERRAL').val('0');
                                                        var total_shipp = ((<?php echo $shippingamount; ?>)*plus_amount);
                                                        var keyamountshipping = total_shipp.toFixed(2);
                                                        $('#<?php echo $key; ?>amount_shipping').text(keyamountshipping);
                                                        if(plus_amount!="0"){
                                                            $('#<?php echo $key; ?>').val(plus_amount); 
                                                        } 
                                                        var total_amount = <?php echo $shippingamount; ?> + (<?php echo $products->deal_value; ?>*plus_amount);
                                                        if(total_amount!="0") {
                                                            var keyamount = total_amount.toFixed(2);
                                                            $('#<?php echo $key; ?>amount').text(keyamount);
                                                            var qqqq = parseFloat($('#totalamount').text())-<?php echo $products->deal_value; ?>-<?php echo $itemshippingamount; ?>;
                                                            var qqq = qqqq.toFixed(2); 
                                                            var flatqqq = qqqq+<?php echo $flatamount; ?>;
                                                            var flat = flatqqq.toFixed(2);    
                                                                                                            
                                                            var taxqqq = (<?php echo $taxamount; ?>/100)*flat;
                                                            var taxvalue = taxqqq.toFixed(2);
                                                                                                            
                                                            $('#totalamount').text(qqq);
                                                            $('#Grandamount').text(qqq);
                                                            $('#TotalAmount').val(qqq);
                                                            $('#P_TotalAmount').val(qqq);
                                                            $('#COD_TotalAmount').val(qqq);
                                                            $('#ref').val('0');
                                                            $('#PRO_REFERRAL').val('0');
                                                            $('#PC_REFERRAL').val('0');
                                                            $('#COD_REFERRAL').val('0');
                                                        }
                                                    }
                                                                                                    
                                                    $('#taxamount').text(taxvalue); 
                                                    var totgrand = (parseFloat(flat)+parseFloat(taxvalue));
                                                    var totgrandval = totgrand.toFixed(2);
                                                    if(totgrandval != "NaN"){
                                                        $('#Grandamount').text(totgrandval); 
                                                    }
                                                                                                    
                                                }  
                                                                                                
                                            </script>
                                            <td><?php echo CURRENCY_SYMBOL; ?><span id="<?php echo $key; ?>amount"><?php echo number_format((float) $products->deal_value + $shippingamount, 2, '.', ''); ?></span></td>
                                            <?php $total_amount +=$products->deal_value + $shippingamount; ?>
                                            <td align="center">
                                                <a class="cart_delete" id="prodele_<?php echo $products->deal_id; ?>" href="<?php echo PATH . 'payment_product/cart_remove/product_cart_id' . $value; ?>" title="<?php echo $this->Lang['RMV']; ?>">&nbsp;</a>
                                            </td>
                                                <script>
                                                        $('#prodele_<?php echo $products->deal_id; ?>').click(function() {
                                                                $('#prodele_<?php echo $products->deal_id; ?>').hide();
                                                        });
                                                </script>

                                            </tr>

            <?php
        }
    }
}
?>

                                <tfoot>                                
                                    <tr <?php if ($this->shipping_setting == 4) { ?> style="display:none" <?php } ?>>
                                        <td align="right" colspan="7"><?php echo $this->Lang['TOTAL']; ?></td>
                                        <td align="left">=</td>
                                        <td align="left" colspan="2"><p><?php echo CURRENCY_SYMBOL; ?><span id="totalamount"><?php echo number_format((float) $total_amount, 2, '.', ''); ?></span><p></td>
                                    </tr>



                                            <?php if (($this->shipping_setting == 2) || ($this->shipping_setting == 1) || ($this->shipping_setting == 3)) { ?>
                                        <tr>
                                            <td align="right" colspan="7"><?php if ($this->shipping_setting == 1) { ?>
                                                    <?php echo $this->Lang['SHIP_ING']; ?> 
                                                    <?php } if ($this->shipping_setting == 2) { ?>
        <?php echo $this->Lang['FLAT_SHIPP_AMOUNT']; ?>
    <?php
    } if ($this->shipping_setting == 3) {
        if ($this->session->get('count') != "1") {
            ?><span id="someelem"> <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/message_box.png" class="blink" > </span><?php
                                                echo $this->session->get('count') . " Products ";
                                            }
        ?>
                                                        <?php echo $this->Lang['SHIP_AMOU']; ?>
                                                    <?php } ?></td>
                                            <td align="left">=</td>
                                            <td align="left" colspan="2">
                                                <p><?php if ($this->shipping_setting == 1) { ?>
                                                        <span><?php echo $this->Lang['FREE']; ?></span>
                                        <?php } if ($this->shipping_setting == 2) { ?>

                                                        <span><?php echo CURRENCY_SYMBOL . number_format((float) $flatamount, 2, '.', ''); ?></span>
    <?php } if ($this->shipping_setting == 3) { ?>
                                                        <span><?php echo CURRENCY_SYMBOL . number_format((float) $flatamount, 2, '.', ''); ?></span>
    <?php } ?></p>
                                            <td>
                                        </tr>
<?php } ?>
<?php $taxamounttot = "0";
if ($taxamount != 0) {
    ?>
                                        <tr>
                                            <td align="right" colspan="7">

                                                <span>
                                                    <span id="someelemtax"> <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/message_box.png" class="blink" >
                                                    </span>
    <?php echo $this->Lang['TAX']; ?></span>

                                            </td>
                                            <td align="left">=</td>
                                            <td align="left" colspan="2"><p><?php $taxamounttot = ($taxamount / 100) * ($total_amount + $flatamount); ?>
                                                    <span><?php echo CURRENCY_SYMBOL; ?><span id="taxamount"><?php echo number_format((float) $taxamounttot, 2, '.', ''); ?></span></span></p>
                                            </td>
                                        </tr>
<?php } ?>
                                    <tr>
                                        <td align="right" colspan="7"><?php echo $this->Lang['GRAND_TOTAL']; ?></td>
                                        <td align="left">=</td>
                                        <td align="left" colspan="2"><p><span><?php echo CURRENCY_SYMBOL; ?><span id="Grandamount"><?php echo number_format((float) $total_amount + $flatamount + $taxamounttot, 2, '.', ''); ?></span></span></p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>                   
                        

                    
                           
            </div>
                <div class="payright_block">
                        <div class="pay_br right_shipping_address">
                                   
                                <h3 class="paybr_title pay_titlebg shipping_edit_title clearfix ">
                                <span><?php echo $this->Lang['SHIP_ADD']; ?></span>
                                 <?php if (count($this->shipping_address) > 0) { ?>
                                <a onclick="show_dis();" title="<?php echo $this->Lang['EDIT']; ?>" class="saddress_edit"><?php echo $this->Lang['EDIT']; ?></a>        <?php } else { ?>
                                <a href="<?php echo PATH; ?>users/my-shipping-address.html" title="<?php echo $this->Lang['EDIT']; ?>" class="saddress_edit"><?php echo $this->Lang['EDIT']; ?></a>        
                                <?php } ?>
                                </h3>
                                         <?php if (count($this->shipping_address) > 0) { ?>                    
                               <div id="new_shipping_address" > <?php common::shipping_address(); ?> </div>

                        <?php } ?>                            
                        </div>
                    <?php /* <div class="payment-faq-container">
                        <p class="faq-heading-text"><?php echo $this->Lang['PAY_MEN']; ?></p>

                        <div class="faq-content2">
                            <div class="faq-content-heading" onclick="return WhatHappens();">

                                <div class="faq-content-heading-left" id="right1">
                                    <a><?php echo $this->Lang['WAT_HAPP']; ?></a>
                                </div>
                                <div class="faq-content-heading-left1" id="down1">
                                    <a><?php echo $this->Lang['WAT_HAPP']; ?></a>
                                </div>
                            </div>
                            <div class="what_happens">
                                <div class="faq-content-text">

                                    <p><?php echo $this->Lang['WHILE_BUY_A_PRODUCT']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="faq-content2">
                            <div class="faq-content-heading" onclick="return Whatbuygift();">

                                <div class="faq-content-heading-left" id="right2">
                                    <a><?php echo $this->Lang['DO_I_NEED']; ?></a>
                                </div>
                                <div class="faq-content-heading-left1" id="down2">
                                    <a><?php echo $this->Lang['DO_I_NEED']; ?></a>
                                </div>
                            </div>
                            <div class="what_buygift">  
                                <div class="faq-content-text">
                                    <p><?php echo $this->Lang['ITS_QUITE_OPTIONAL']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="faq-content3">
                            <div class="faq-content-heading" onclick="return CanChange();">
                                <div class="faq-content-heading-left" id="right3">
                                    <a><?php echo $this->Lang['MAY_I_USE']; ?></a>
                                </div>
                                <div class="faq-content-heading-left1" id="down3">
                                    <a><?php echo $this->Lang['MAY_I_USE']; ?></a>
                                </div>
                            </div>
                            <div class="can_change">
                                <div class="faq-content-text">
                                    <p><?php echo $this->Lang['OBVIOUSLY_YES']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    




                    <div class="payment-faq-container">
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo FB_PAGE; ?>&amp;width=235&amp;height=268&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:234px; height:300px;" class="fan_box connections_grid  grid_item" allowTransparency="true"></iframe>
                    </div> */ ?>





                </div>
        </div>
        
         <div id="show" class="popup_block5" style="display:none;">                                                                   
                                <?php foreach($this->shipping_address as $s) { ?> 
                                <form method="post" id="submit_changes">
                                <div class="sign_up_outer"> 
                                       <a onclick="hide_shipping_addr()" class="close2" title="close" id="close" style="cursor:pointer;">&nbsp;</a>
                                                <div class="signup_content clearfix">
                                                    <h2 class="signup_title shipping_poptitle"><?php echo $this->Lang['SHIP_ADDR']; ?></h2>
                                                    <div class="payment_form payment_shipping_form">
                                                <ul class="clearfix">
                                                                <li>
                                                                    <label><?php echo $this->Lang['NAME']; ?>  <span> * </span></label>
                                                                    <div class="fullname">                                                                            
                                                                        <input name="firstname" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" class="required" maxlength="256" value="<?php echo $s->ship_name; ?>" autofocus />
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <label><?php echo $this->Lang['ADDR1']; ?> <span> * </span></label>
                                                                    <div class="fullname">
                                                                        <input  name="address1" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" class="required" maxlength="256" value="<?php echo $s->ship_address1; ?>" />
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                <label><?php echo $this->Lang['ADDR2']; ?> <span> * </span></label>
                                                                <div class="fullname">
                                                                <input name="address2" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" size="40"  maxlength="256" value="<?php echo $s->ship_address2; ?>"/>
                                                                </div>
                                                        </li>
                                                        <li>
                                                                <label><?php echo $this->Lang['COUNTRY']; ?><span> * </span></label>                                    
                                                                <div class="fullname">
                                                                        <select class="select" name="country" onchange="return city_change_merchant(this.value);">
                                                                                <?php foreach ($this->all_country_list as $countryL) { ?>
                                                                                <option <?php if ($countryL->country_id == $s->ship_country) {
                                                                                echo 'Selected="true"';
                                                                                } ?> value="<?php echo $countryL->country_id; ?>"><?php echo ucfirst($countryL->country_name); ?></option>
                                                                                <?php } ?>
                                                                        </select>      
                                                                </div>
                                                        </li>
                                                                                                       
                                                        <li class="frm_clr">
                                                                <label><?php echo $this->Lang['STATE']; ?><span> * </span></label>
                                                                <div class="fullname">
                                                                    <input name="state" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_STATE']; ?>" type="text" size="40" class="required" maxlength="256" value="<?php echo $s->ship_state; ?>" />
                                                                </div>
                                                        </li>
                                                        
                                                        
                                                         <li>
                                                                <label><?php echo $this->Lang['SEL_CITY']; ?>  <span> * </span></label>                                        
                                                                <div class="clearfix fullname">
                                                                        <div class="select_box_outer country_select_box">
                                                                        <select name="city" class="select" id="CitySD">
                                                                        <?php foreach ($this->all_city_list as $CityL) { ?>
                                                                        <option <?php if ($CityL->city_id == $s->ship_city) {
                                                                        echo 'Selected="true"';
                                                                        } ?> value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
                                                                        <?php } ?>
                                                                        </select>                            
                                                                        </div>
                                                                </div>  
                                                        </li>        
                                                        <li class="frm_clr">
                                                                <label><?php echo $this->Lang['POSTAL_CODE']; ?> <span> * </span></label>
                                                                <div class="fullname">
                                                                    <input  name="zip_code" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>" type="text" class="required number" maxlength="256" value="<?php echo $s->ship_zipcode; ?>"/>
                                                                </div>
                                                        </li>
                                                        <li>
                                                                <label><?php echo $this->Lang['PHONE']; ?><span> * </span></label>
                                                                <div class="fullname">
                                                                <input name="mobile" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>" type="text" class="required number" maxlength="18" value="<?php echo $s->ship_mobileno; ?>" />
                                                                </div>
                                                        </li>
                                                </ul>
                                                        </div>
                                          <input type="submit" value="Update" class="sign_submit" />
                                          <input class="sign_cancel" type="button" value="Cancel" onclick="hide_shipping_addr()" />
                                </div>

                                </div>
                        </form>
                <?php } ?>				
                </div>
             </div>
             
             
             <?php if(count($this->cms_tc) > 0){ ?>
              <div id="show_tc" class="popup_block6" style="display:none;">   
                                <div class="sign_up_outer"> 
                                       <a onclick="hide_shipping_addr_tc()" class="close2" title="close" id="close" style="cursor:pointer;">&nbsp;</a>
                                                <div class="signup_content clearfix">
                                                    <h2 class="signup_title shipping_poptitle"><?php echo $this->cms_tc->current()->cms_title; ?></h2>
                                                    <div class="content_abouts">
                        <div class="content_abou_common">                                                                                     
                            <div class="content_abou_text">
				<p><?php echo $this->cms_tc->current()->cms_desc;?></p>
                            </div>
                        </div>  
                    </div>
                   </div>
                </div>				
                </div>
             <?php } ?>
<div class="payouter_block pay_br">
    <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['TYPE_PAY']; ?></h3>
    <div class="p_inner_block">                            
                            <div class="payment_select"> 
                                    <?php if ($this->paypal_setting) { ?>
                                    <div class="payment_sel_lft">
                                        <a onclick="return SimilarProducts();" id="SimilarProducts"  >
                                            <input id="paypal_radio" type="radio" name="name"  checked /></a><p><?php echo $this->Lang['PAYPAL']; ?></p></div>
                                <?php } ?>
                                <?php if ($this->credit_card_setting) { ?>
                                    <div class="payment_sel_lft">  <a onclick="return SimilarDeals();" id="SimilarDeals"  >
                                            <input type="radio" name="name"  <?php if ($this->paypal_setting) {
                                    
                                } else {
                                        ?> checked <?php } ?>  /></a><p><?php echo $this->Lang['PAYPAL_CREDIT']; ?></p></div>
<?php } ?>
<?php if ($this->authorize_setting) { ?>
                                    <div class="payment_sel_lft"> 

                                        <a onclick="return Authorize();" id="Authorize"  > <input type="radio" name="name"  /></a> <p><?php echo $this->Lang['AUTHORIZE']; ?></p></div>
<?php } ?>
                                <?php if ($this->uri->last_segment() != "payment_details_friend.html") { ?>
                                    <?php if ($this->cash_on_delivery_setting) { ?>
                                        <div class="payment_sel_lft"> <a onclick="return cash_delivery();" > <input type="radio" name="name"  /></a> <p><?php echo $this->Lang['CASH_ON_DEL']; ?></p></div>
                                <?php } ?>
                                <?php } ?>
                            </div>


                               
             
                            <div class="befor_login">
                                <?php echo new View("themes/" . THEME_NAME . "/paypal/p_paypal"); ?>
                            </div>

                            <div class="AuthorizeNet_pay">
<?php echo new View("themes/" . THEME_NAME . "/paypal/p_Authorize"); ?>
                            </div>
<?php if ($this->uri->last_segment() != "payment_details_friend.html") { ?>
                                <div class="cash_pay">
    <?php echo new View("themes/" . THEME_NAME . "/paypal/cash_delivery"); ?>
                                </div>
<?php } ?>

                            <div class="cancel_login">
<?php echo new View("themes/" . THEME_NAME . "/paypal/p_dodirect_creditcard"); ?>
                            </div>
</div>
                        </div>


                <!--Blog content ends-->

            </div>

        </div>
    </div>




