<script type="text/javascript"> 
        $(document).ready(function(){  
        
        
       <?php if($this->paypal_setting) { ?> 
        $('.cancel_login').hide();
        <?php } else { ?>
        $('.befor_login').hide();
         $('.cancel_login').show();
        <?php } ?>
        $('.AuthorizeNet_pay').hide();
        $('.cod').hide();
        $('.no_paypal').hide();
        $('.pay_later').hide();
        });
</script>
<script type="text/javascript"> 
        $('.cancel_login').hide();
        function SimilarDeals() {
				var refamt= $("#ref").val();
				$("#order_complete").hide();
				if (refamt=="" || refamt==0) { 
						$("#order_hide").show();
				}
				$('.error').html('');
                $('.cancel_login').show();
				$('#order_hide').hide();
                $('.befor_login').hide();
                $('.AuthorizeNet_pay').hide();
                $('.cod').hide();
				$('.pay_later').hide();
        }
        function SimilarProducts() {
				
				var refamt= $("#ref").val();
				
				if (refamt=="" || refamt==0) { 
						$("#order_hide").show();
						 $('.payment_select').show();
				}
				$('.error').html('');
                $('.befor_login').show();
                $('.cancel_login').hide();
                $('.AuthorizeNet_pay').hide();
				$('#order_hide').show();
				$('.cod').hide();
				$('.pay_later').hide();
        }
        function Authorize() {
				var refamt= $("#ref").val();
				if (refamt=="" || refamt==0) {
                                        $("#order_hide").show();
                                        $('.payment_select').show();
				}
				$('.error').html('');
				$('#order_hide').hide();
                $('.befor_login').hide();
                $('.cancel_login').hide();
                $('.cod').hide();
                $('.AuthorizeNet_pay').show();
                $('.pay_later').hide();
        }
        function COD() {
				var refamt= $("#ref").val();
				if (refamt=="" || refamt==0) {
						$("#order_hide").show();
						 $('.payment_select').show();
				}
				$('.error').html('');
				$('#order_hide').hide();
                $('.befor_login').hide();
                $('.cancel_login').hide();
                $('.cod').show();
                $('.AuthorizeNet_pay').hide();
                 $('.pay_later').hide();
        }
        
         function Pay_later() {
				var refamt= $("#ref").val();
				if (refamt=="" || refamt==0) {
						$("#order_hide").show();
						 $('.payment_select').show();
				}
				$('.error').html('');
				$('#order_hide').hide();
                $('.befor_login').hide();
                $('.cancel_login').hide();
                $('.cod').hide();
                $('.pay_later').show();
                $('.AuthorizeNet_pay').hide();
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
    </script>
<SCRIPT language=Javascript>
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</SCRIPT> 
<?php 
$this->session = Session::instance();
		$this->UserID = $this->session->get("UserID")
		?>
     <div class="contianer_outer1">
            <div class="contianer_inner">
                <div class="contianer">
                    <div class="bread_crumb">
                        <ul>
                            <li><p><a href="<?php echo PATH;?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                            <li><p><?php echo $this->Lang['TYPE_PAY']; ?></p></li>
                        </ul>
                    </div>

                    <!--content start-->                    
                        <div class="payouter_block pay_br">                             
                            <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['TYPE_PAY']; ?></h3>                             
                            <div class="p_inner_block clearfix">
                            <div class="payment_select"> 
                   <?php
			$friend_buy=0;
			 if($this->paypal_setting) { ?>
                    <div class="payment_sel_lft"><a onclick="return SimilarProducts();" id="SimilarProducts"  > <input value="1" class="pay_option" id="paypal_radio" type="radio" name="name" checked/></a> <p><?php echo $this->Lang['PAYPAL']; ?></p></div>
                   <?php } ?>
                   <?php if($this->credit_card_setting) { ?>
                   <div class="payment_sel_lft"><a onclick="return SimilarDeals();" id="SimilarDeals"  >    <input class="pay_option" value="2" type="radio" name="name"  <?php if($this->paypal_setting) { } else { ?> checked <?php } ?> /></a> <p><?php echo $this->Lang['PAYPAL_CREDIT']; ?></p></div>
                   <?php } ?>
                   <?php if($this->authorize_setting) { ?>
                  <div class="payment_sel_lft"><a onclick="return Authorize();" id="Authorize"  >       <input type="radio" value="3" class="pay_option" name="name"  /></a> <p><?php echo $this->Lang['AUTHORIZE']; ?></p></div>
                  <?php } ?>
                  <?php if ($this->uri->segment(2) != "payment_details_friend") { ?>
                      <?php if($this->cash_on_delivery_setting) { ?>
                  <div class="payment_sel_lft"><a onclick="return COD();" id="COD"  >       <input type="radio" name="name" value="4"  /></a> <p><?php echo $this->Lang['CASH_ON_DEL']; ?></p></div>
                  <?php } ?>
                  <?php } ?>
                  <?php if($this->pay_later_setting) { ?>
                  <div class="payment_sel_lft"><a onclick="return Pay_later();" id="pay_later"  >       <input type="radio" value="6" class="pay_option" name="name"  /></a> <p><?php echo $this->Lang['PAY_LATER']; ?></p></div>
                  <?php } ?>
                                </div>
           <?php  $referral_balance = $this->user_referral_balance;  ?>           
                                <?php if($referral_balance !=0){ ?>                 
                                <p class="pay_reference_info"><?php echo $this->Lang['YOUR_PAYMENT']; ?>  &nbsp;<span><?php echo CURRENCY_SYMBOL.$referral_balance;  ?>.</span> <?php //echo $this->Lang['USE_ONLY']; ?></p> 
                                <?php } ?>
                             <div class="cart_table payment_table clearfix">                                   
                                     <table class="mcart_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0">
                                         <thead>
                                            <tr>
                                                <th width="100" align="left"><?php echo $this->Lang['DESC']; ?></th>
                                                <th width="100" align="left"><?php echo $this->Lang['QUAN']; ?></th>
                                                <th width="20" align="left"></th>
                                                <th width="100" align="left"><?php echo $this->Lang['PRI']; ?></th>
                                                <th width="100" align="left"><?php echo $this->Lang['REFEREL']; ?></th>
                                                <th width="20" align="left"></th>
                                                <th width="100" align="left"><?php echo $this->Lang['TOTAL']; ?></th>
                                            </tr> 
                                        </thead>
                <?php  foreach($this->deals_payment_deatils as $payment) { 
                $this->deals = new Deals_Model();
                $this->user_purch_count = $this->deals->get_deal_purchased_count($payment->deal_id, $this->UserID);
                 ?>                                                                          
                                             <tr>
                                                 <td><?php echo $payment->deal_title; ?></td>                                                                                          
                                                 <td>
                                                     <div class="quantity_bx quantity_bx_row">
                                                     <?php 
                                                     $purchase_count = $payment->purchase_count;
                                                     $user_limit_quantity = $payment->user_limit_quantity;
                                                     $max_limit = $payment->maximum_deals_limit;
                                                     $user_purchase_count = $this->get_user_limit_count;
                                                     $avail_deal = $user_limit_quantity - $user_purchase_count;
                                                     if ($avail_deal > 1 && ($max_limit - $purchase_count) > 1) {
                                                     ?>
                                                         <div class="lessthen">
                                                             <a id="QtyDown"  class="less_min" onclick="DownTotal()">-</a>
                                                         </div>
                                                     <?php } ?>
                                                                                        
                                                     <div class="lessthen1">
                                                         <input name="QTY" id="QTY" class="QTY_val" value="1" readonly="readonly" type="text" rel="20">
                                                     </div>
                                                     <?php
                                                     if ($avail_deal > 1 && ($max_limit - $purchase_count) > 1) {
                                                         ?>
                                                         <div class="greaterthen">
                                                             <a id="QtyUp" class="plus" onclick="UpTotal()">+</a>
                                                         </div>
                                                                                                                                    
                                                     <?php } ?>				
                                                     </div>                                 
                                                 </td>
                                                 <script>
                                                     function UpTotal()
                                                     {
                                                         var gateway=$("input:radio[name='name']:checked").val();
                                                         var count_limit=<?php echo $payment->user_limit_quantity; ?>-<?php echo $this->user_purch_count; ?>;
                                                         var count_user_limit=<?php echo $payment->purchase_count; ?>+(parseInt($('#QTY').val()) + 1);
                                                         if(($('#QTY').val()!=count_limit)&&(<?php echo $payment->maximum_deals_limit; ?> >= count_user_limit))
                                                         {
                                                             if(<?php echo $this->user_purch_count; ?><=<?php echo $payment->user_limit_quantity; ?>)
                                                             {
                                                                 var plus_amount = parseInt($('#QTY').val()) + 1;
                                                                 $('#QTY').val(plus_amount);
                                                                 $('#PC_QTY_VAL').val(plus_amount);
                                                                 $('#PCC_QTY_VAL').val(plus_amount);
                                                                 $('#APCC_QTY_VAL').val(plus_amount);
                                                                 $('#COD_QTY_VAL').val(plus_amount); // for COD
                                                                 $('#PCR_QTY_VAL').val(plus_amount);
                                                                  $('#PL_QTY_VAL').val(plus_amount);
                                                                 var total_amount = <?php echo $payment->deal_value; ?>*plus_amount;
                                                                 if(total_amount!="0") {
                                                                     $('#amount').text(total_amount);
                                                                     $('#tot').text(total_amount);
                                                                     $('#oldamount').text(total_amount);
                                                                     $('#PC_AMOUNT').val(total_amount);
                                                                     $('#PCC_AMOUNT').val(total_amount);
                                                                     $('#APCC_AMOUNT').val(total_amount);
                                                                     $('#COD_AMOUNT').val(total_amount); // for COD
                                                                     $('#PCR_AMOUNT').val(total_amount);
                                                                     $('#PL_AMOUNT').val(total_amount);
                                                                     $('#ref').val('0');
                                                                     $('#PC_REFERRAL').val('0')
                                                                     $('#PCR_REFERRAL').val('0')
                                                                     $('#PL_REFERRAL').val('0');
                                                                     $('.no_paypal').hide();
                                                                     $('.totlal_amount').show();
                                                                     $('.payment_top').show();
                                                                 }
                                                                 else { 
                                                                     if(val!="") {
                                                                         $('#amount').text(1*<?php echo $payment->deal_value; ?>);
                                                                         $('#tot').text(1*<?php echo $payment->deal_value; ?>);
                                                                         $('#oldamount').text(1*<?php echo $payment->deal_value; ?>);
                                                                         $('#PC_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);
                                                                         $('#PCC_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);
                                                                         $('#APCC_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);
                                                                         $('#COD_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);  // for COD
                                                                         $('#PCR_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);
                                                                         $('#PL_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);
                                                                         $('#ref').val('0');
                                                                         $('#PC_REFERRAL').val('0')
                                                                         $('#PCR_REFERRAL').val('0')
                                                                         $('#PL_REFERRAL').val('0');
                                                                     } else {
                                                                         $('#amount').text('0');
                                                                         $('#tot').text('0');
                                                                         $('#oldamount').text('0');
                                                                         $('#PC_AMOUNT').val('0');
                                                                         $('#PCC_AMOUNT').val('0');
                                                                         $('#APCC_AMOUNT').val('0');
                                                                         $('#COD_AMOUNT').val('0'); // for COD
                                                                         $('#PL_AMOUNT').val('0');
                                                                     }
                                                                 }
                            
                                                                 var plus_amount = parseInt($('#QTY').val());
                                                                 var total_amount = parseFloat(<?php echo $payment->deal_value; ?>*plus_amount);
                            
                                                                 /* New - script issue fix*/
                                                                 if(<?php echo $referral_balance; ?> <= total_amount)
                                                                 {
                                                                     if(gateway==1) {
                                                                         $('.befor_login').show(); 
                                                                     }
                                                                     if(gateway==2) {
                                                                         $('.cancel_login').show();
                                                                         $("#order_complete").hide();
                                                                     }
                                                                     if(gateway==3) {
                                                                         $('.AuthorizeNet_pay').show();
                                                                         $("#order_complete").hide();
                                                                     }
                                                                     if(gateway==4) {
                                                                         $('.cod').show();
                                                                         $("#order_complete").hide();
                                                                     }	
                                                                     if(gateway==6) {
                                                                         $('.pay_later').show();
                                                                         $("#order_complete").hide();
                                                                     }		
                                                                 }else{
                                                                     if(gateway==1) {
                                                                         $('.befor_login').show(); 
                                                                     }
                                                                     if(gateway==2) {
                                                                         $('.cancel_login').show();
                                                                         $("#order_complete").hide();
                                                                     }
                                                                     if(gateway==3) {
                                                                         $('.AuthorizeNet_pay').show();
                                                                         $("#order_complete").hide();
                                                                     }
                                                                     if(gateway==4) {
                                                                         $('.cod').show();
                                                                         $("#order_complete").hide();
                                                                     }
                                                                     if(gateway==6) {
                                                                         $('.pay_later').show();
                                                                         $("#order_complete").hide();
                                                                     }
                                                                 }
                                                                 /* New - script issue fix end*/  
                                                             }
                                                         }
                                                     }
                                                     function DownTotal()
                                                     {
                                                         var gateway=$("input:radio[name='name']:checked").val();
                                                         if($('#QTY').val()!=1) {
                                                             var plus_amount = parseInt($('#QTY').val()) - 1;
                                                             $('#QTY').val(plus_amount);
                                                             $('#PC_QTY_VAL').val(plus_amount);
                                                             $('#PCC_QTY_VAL').val(plus_amount);
                                                             $('#APCC_QTY_VAL').val(plus_amount);
                                                             $('#COD_QTY_VAL').val(plus_amount);  // for COD
                                                             $('#PCR_QTY_VAL').val(plus_amount);
                                                             $('#PL_QTY_VAL').val(plus_amount);
                                                             var total_amount = <?php echo $payment->deal_value; ?>*plus_amount;
                                                             if(total_amount!="0") {
                                                                 $('#amount').text(total_amount);
                                                                 $('#tot').text(total_amount);
                                                                 $('#oldamount').text(total_amount);
                                                                 $('#PC_AMOUNT').val(total_amount);
                                                                 $('#PCC_AMOUNT').val(total_amount);
                                                                 $('#APCC_AMOUNT').val(total_amount);
                                                                 $('#COD_AMOUNT').val(total_amount);  // for COD
                                                                 $('#PCR_AMOUNT').val(total_amount);
                                                                 $('#PL_AMOUNT').val(total_amount);
                                                                 $('#ref').val('0');
                                                                 $('#PC_REFERRAL').val('0');
                                                                 $('#PCC_REFERRAL').val('0');
                                                                 $('#APCC_REFERRAL').val('0');
                                                                 $('#COD_REFERRAL').val('0');  // for COD
                                                                 $('#PCR_REFERRAL').val('0');
																 $('#PL_REFERRAL').val('0');
                                                             }
                                                             else {
                                                                 if(val!="") {
                                                                     $('#amount').text(1*<?php echo $payment->deal_value; ?>);
                                                                     $('#tot').text(1*<?php echo $payment->deal_value; ?>);
                                                                     $('#oldamount').text(1*<?php echo $payment->deal_value; ?>);
                                                                     $('#PC_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);
                                                                     $('#PCC_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);
                                                                     $('#APCC_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);
                                                                     $('#COD_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);  // for COD
                                                                     $('#PCR_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);
                                                                     $('#PL_AMOUNT').val(1*<?php echo $payment->deal_value; ?>);
                                                                     $('#ref').val('0');
                                                                     $('#PC_REFERRAL').val('0');
                                                                     $('#PCC_REFERRAL').val('0');
                                                                     $('#APCC_REFERRAL').val('0');
                                                                     $('#COD_REFERRAL').val('0'); // for COD
                                                                     $('#PCR_REFERRAL').val('0');
                                                                     $('#PL_REFERRAL').val('0');
                                                                 } else {
                                                                     $('#amount').text('0');
                                                                     $('#tot').text('0');
                                                                     $('#oldamount').text('0');
                                                                     $('#PC_AMOUNT').val('0');
                                                                     $('#PCC_AMOUNT').val('0');
                                                                     $('#APCC_AMOUNT').val('0');
                                                                     $('#COD_AMOUNT').val('0');	// for COD
                                                                     $('#PCR_AMOUNT').val('0');
																	 $('#PL_AMOUNT').val('0');
                                                                 }
                                                             }
                                                             var plus_amount = parseInt($('#QTY').val());
                                                             var total_amount = parseFloat(<?php echo $payment->deal_value; ?>*plus_amount);
                                                             /* New - script issue fix*/
                                                             if(<?php echo $referral_balance; ?> <= total_amount)
                                                             { 
                                                                 if(gateway==1) {
                                                                     $('.befor_login').show(); 
                                                                 }
                                                                 if(gateway==2) {
                                                                     $('.cancel_login').show();
                                                                     $("#order_complete").hide();
                                                                 }
                                                                 if(gateway==3) {
                                                                     $('.AuthorizeNet_pay').show();
                                                                     $("#order_complete").hide();
                                                                 }
                                                                 if(gateway==4) {
                                                                     $('.cod').show();
                                                                     $("#order_complete").hide();
                                                                 }
                                                                 if(gateway==6) {
																	 $('.pay_later').show();
																	 $("#order_complete").hide();
																 }
                                                             } 
                                                             /* New - script issue fix end*/  
                                                         }
                                                     }
                
                                                     function ReferralTotal(ref)
                                                     {      
                                                         var gateway=$("input:radio[name='name']:checked").val();
                                                         if(ref <= <?php echo $referral_balance; ?>)
                                                         {
                                                             if(ref==""){
                                                                 var ref_amount=$('#oldamount').text();
                                                                 $('#amount').text(ref_amount);
                                                                 $('#PC_AMOUNT').val(ref_amount);
                                                                 $('#PCC_AMOUNT').val(ref_amount);
                                                                 $('#APCC_AMOUNT').val(ref_amount);
                                                                 $('#COD_AMOUNT').val(ref_amount);  // for COD
                                                                 $('#PCR_AMOUNT').val(ref_amount);
                                                                 $('#PL_AMOUNT').val(ref_amount);
                                                                 $('#tot').text(ref_amount);
                                                                 $('.cancel_login').hide();
                                                                 $("#order_hide").hide();
                                                                 $('.payment_select').show();
                                                                 $("#order_complete").hide();
                                                                 if(gateway==1) {
                                                                     $('.befor_login').show();
                                                                     $("#order_complete").hide();
                                                                 }
                                                                 if(gateway==2) {
                                                                     $('.cancel_login').show();
                                                                     $("#order_complete").hide();
                                                                 }
                                                                 if(gateway==3) {
                                                                     $('.AuthorizeNet_pay').show();
                                                                     $("#order_complete").hide();
                                                                 }
                                                                 if(gateway==4) {
                                                                     $('.cod').show();
                                                                     $("#order_complete").hide();
                                                                 }
                                                                 if(gateway==6) {
																	 $('.pay_later').show();
																	 $("#order_complete").hide();
																 }
                                                             }
                                                             else{
                                                                 var ref_amount=$('#oldamount').text()-ref;
                                                                 ref_amount=parseFloat(ref_amount);
                                                                 if(gateway==1) {						 
                                                                     $("#order_hide").show();
                                                                     $("#order_complete").hide();
                                                                 }
                                                                 $('#PC_REFERRAL').val(ref);
                                                                 $('#PCC_REFERRAL').val(ref);
                                                                 $('#APCC_REFERRAL').val(ref);
                                                                 $('#COD_REFERRAL').val(ref);  // for COD
                                                                 $('#PCR_REFERRAL').val(ref);
                                                                 $('#PL_REFERRAL').val(ref);
                                                                 if(ref_amount==0)
                                                                 {      
                                                                     $('.no_paypal').show();                                                
                                                                     $('.payment_select').hide();
                                                                     $('.totlal_amount').hide();
                                                                     $('.befor_login').hide();
                                                                     $('.payment_top').hide();
                                                                     $('.cancel_login').hide();
                                                                     $('.AuthorizeNet_pay').hide();
                                                                     $('.cod').hide();
                                                                     $("#order_complete").show();
                                                                     if(gateway==1) {
                                                                         $("#order_complete").hide();
                                                                     }
                                                                 }
                            
                                                                 if(ref_amount >= 0) {
                                                                     $('#amount').text(ref_amount);
                                                                     $('#tot').text(ref_amount);
                                                                     $('#PC_AMOUNT').val(ref_amount);
                                                                     $('#PCC_AMOUNT').val(ref_amount);
                                                                     $('#APCC_AMOUNT').val(ref_amount);
                                                                     $('#COD_AMOUNT').val(ref_amount);  // for COD
                                                                     $('#PCR_AMOUNT').val(ref_amount);
                                                                     $('#PL_AMOUNT').val(ref_amount);
                                                                     if(ref_amount!=0)
                                                                     {       
                                                                         $('.no_paypal').hide();
                                                                         $('.totlal_amount').show();
                                                                         $('.payment_select').show();
                                                                         $('.payment_top').show();
                                                                         $("#order_complete").show();
                                                                         if(gateway==1) {
                                                                             $('.befor_login').show();
                                                                             $("#order_complete").hide();
                                                                         }
                                                                         if(gateway==2) {
                                                                             $('.cancel_login').show();
                                                                             $("#order_complete").hide();
                                                                         }
                                                                         if(gateway==3) {
                                                                             $('.AuthorizeNet_pay').show();
                                                                             $("#order_complete").hide();
                                                                         }
                                                                         if(gateway==4) {
                                                                             $('.cod').show();
                                                                             $("#order_complete").hide();
                                                                         }
                                                                         if(gateway==6) {
																			 $('.pay_later').show();
																			 $("#order_complete").hide();
																		 }
                                                                     }
                                                                 }
                                                                 else { 
                                                                     $('#ref').val($('#oldamount').text());
                                                                     $('#PC_REFERRAL').val($('#oldamount').text());
                                                                     $('#PCC_REFERRAL').val($('#oldamount').text());
                                                                     $('#APCC_REFERRAL').val($('#oldamount').text());
                                                                     $('#COD_REFERRAL').val($('#oldamount').text());  // for COD
                                                                     $('#PCR_REFERRAL').val($('#oldamount').text());
                                                                     $('#PL_REFERRAL').val($('#oldamount').text());
                                                                     var ref_amount=$('#oldamount').text()-$('#oldamount').text();
                                                                     $('#amount').text(ref_amount);
                                                                     $('#tot').text(ref_amount);
                                                                     $('#PC_AMOUNT').val(ref_amount);
                                                                     $('#PCC_AMOUNT').val(ref_amount);
                                                                     $('#APCC_AMOUNT').val(ref_amount);
                                                                     $('#COD_AMOUNT').val(ref_amount);  // for COD
                                                                     $('#PCR_AMOUNT').val(ref_amount);
                                                                     $('#PL_AMOUNT').val(ref_amount);
                                                                     $("#order_complete").hide();
                                                                     if(ref_amount==0)
                                                                     {
                                                                         $('.no_paypal').show();
                                                                         $('.payment_select').hide();
                                                                         $('.totlal_amount').hide();
                                                                         $('.befor_login').hide();
                                                                         $('.payment_top').hide();
                                                                         $('.cancel_login').hide();
                                                                         $('.AuthorizeNet_pay').hide();
                                                                         $('.cod').hide();
                                                                         if(gateway!=1){
                                                                             $("#order_complete").show();
                                                                         }
                                                                     }
                                                                     var plus_amount = parseInt($('#QTY').val());
                                                                     var total_amount = parseFloat(<?php echo $payment->deal_value; ?>*plus_amount);
                                                                     /* New - script issue fix*/
                                                                     if(gateway==1 && <?php echo $referral_balance; ?> >= total_amount)
                                                                     {
                                                                         $("#order_complete").hide();	
                                                                     }
                                                                 }
                                                             }
                                                         }
                                                         else{
                                                             $('#ref').val(<?php echo $referral_balance; ?>);  
                                                             $('#PC_REFERRAL').val(<?php echo $referral_balance; ?>);
                                                             $('#PCC_REFERRAL').val(<?php echo $referral_balance; ?>);
                                                             $('#APCC_REFERRAL').val(<?php echo $referral_balance; ?>);
                                                             $('#COD_REFERRAL').val(<?php echo $referral_balance; ?>);  // for COD
                                                             $('#PCR_REFERRAL').val(<?php echo $referral_balance; ?>);
                                                             $('#PL_REFERRAL').val(<?php echo $referral_balance; ?>);
                                                             var ref_amount=$('#oldamount').text()-<?php echo $referral_balance; ?>; 
                                                             if(ref_amount >= 0) {
                                                                 $('#amount').text(ref_amount);
                                                                 $('#tot').text(ref_amount);
                                                                 $('#PC_AMOUNT').val(ref_amount);
                                                                 $('#PCC_AMOUNT').val(ref_amount);
                                                                 $('#APCC_AMOUNT').val(ref_amount);
                                                                 $('#COD_AMOUNT').val(ref_amount);   // for COD
                                                                 $('#PCR_AMOUNT').val(ref_amount);
                                                                 $('#PL_AMOUNT').val(ref_amount);
                                                             }            
                                                             else {
                                                                 $('#ref').val($('#oldamount').text());
                                                                 $('#PC_REFERRAL').val($('#oldamount').text());
                                                                 $('#PCC_REFERRAL').val($('#oldamount').text());
                                                                 $('#APCC_REFERRAL').val($('#oldamount').text());
                                                                 $('#COD_REFERRAL').val($('#oldamount').text());  // for COD
                                                                 $('#PCR_REFERRAL').val($('#oldamount').text());
                                                                 $('#PL_REFERRAL').val($('#oldamount').text());
                                                                 var ref_amount=$('#oldamount').text()-$('#oldamount').text();
                                                                 $('#amount').text(ref_amount);
                                                                 $('#tot').text(ref_amount);
                                                                 $('#PC_AMOUNT').val(ref_amount);
                                                                 $('#PCC_AMOUNT').val(ref_amount);
                                                                 $('#APCC_AMOUNT').val(ref_amount);
                                                                 $('#COD_AMOUNT').val(ref_amount);  // for COD
                                                                 $('#PCR_AMOUNT').val(ref_amount);
                                                                 $('#PL_AMOUNT').val(ref_amount);
                                                                 if(ref_amount==0)
                                                                 {      
                                                                     $('.no_paypal').show();
                                                                     $('.payment_select').hide();
                                                                     $('.totlal_amount').hide();
                                                                     $('.befor_login').hide();
                                                                     $('.payment_top').hide();
                                                                     $('.cancel_login').hide();
                                                                     $('.AuthorizeNet_pay').hide();
                                                                     $('.cod').hide();
                                                                 }  
                                                             }      
                                                         }
                                                         function Referralfriend(ref)
                                                         {
                                                             $('.sign_in').show();
                                                         }
                                                     }
                                                 </script>
                                                 <td>x</td>
                                                 <td><?php echo CURRENCY_SYMBOL . $payment->deal_value; ?></td>
                                                 <td><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/reg_img.png" alt="Qty-Counter" title="Qty Counter" /> <INPUT class="referral_input" TYPE=TEXT NAME="ref" id="ref"  SIZE=10 maxlength="10" value="0" onkeypress="return isNumberKey(event)" onkeyup="ReferralTotal(this.value)" > </td> 
                                                 <td>=</td>
                                                 <td><?php echo CURRENCY_SYMBOL; ?><span id="amount"><?php echo $payment->deal_value; ?>
                                                         <INPUT TYPE="hidden"  id="ref_deal_id"  value="<?php echo $payment->deal_id; ?>"></td>
                                                         </tr>
                                                         <tfoot>
                                                         <tr>           
                                                            <td align="right" colspan="5"><?php echo $this->Lang['TOT_PAY2']; ?></td>  
                                                            <td>=</td>
                                                            <td>
                                                                 <p><?php echo CURRENCY_SYMBOL; ?><span id="tot"><?php echo $payment->deal_value; ?></span></p>
                                                             </td>
                                                            </tr>
                                                         </tfoot>
                                                         </table>                                                         
                        </div>
       
              
		<div style="display:none" id="oldamount"><?php echo $payment->deal_value; ?></div>
        <div class="befor_login">
        <?php echo new View("themes/".THEME_NAME."/paypal/paypal"); ?>
        </div>        
        <div class="cancel_login">
        <?php echo new View("themes/".THEME_NAME."/paypal/dodirect_creditcard"); ?>        
        </div>
        <div class="AuthorizeNet_pay">
        <?php echo new View("themes/".THEME_NAME."/paypal/deal_Authorize"); ?>        
        </div>
        <div class="cod">
        <?php echo new View("themes/".THEME_NAME."/paypal/deal_COD"); ?>        
        </div>
         <div class="pay_later">
        <?php echo new View("themes/".THEME_NAME."/paypal/deal_pay_later"); ?>        
        </div>
                <script>
                $(document).ready(function(){
                $("#commentForm_ref").validate();
                });
                </script>
				<form name="payment" method="POST" id="commentForm_ref" action="<?php echo PATH;?>paypal/referral_payment">
                <div class="no_paypal">
                
                <input name="P_QTY" id="PCR_QTY_VAL" value="1" type="hidden" >
                <input name="deal_id"  type="hidden" value="<?php echo $payment->deal_id; ?>" >
                <input name="deal_key" type="hidden" value="<?php echo $payment->deal_key; ?>" >
                <input name="deal_value" type="hidden" value="<?php echo $payment->deal_value; ?>" >
                <input name="amount" id="PCR_AMOUNT"  type="hidden" value="<?php echo $payment->deal_value; ?>" >
                <input name="p_referral_amount" id="PCR_REFERRAL" value="0" type="hidden">
                <?php if($this->uri->segment(2) == "payment_details_friend"){ $friend_buy=1; ?>
                <div class="payment_form_block clearfix">
                <h3 class="type_form_title"><?php echo $this->Lang['FRI_INFO']; ?></h3>
				<div class="payment_form_section">
				<div class="payment_form">
					<ul>
						<li>
							<label> <?php echo $this->Lang['FRI_NAME']; ?> :<span class="form_star">*</span></label>
							<div class="fullname"><input type="text" value="" name="friend_name" class="required" onkeyup="Referralfriend(this.value)" autofocus /></div>
							<em>
	<?php if(isset($this->form_error['friend_name'])){ echo $this->form_error["friend_name"]; }?>
	</em>
						</li>
						<li>
							<label><?php echo $this->Lang['FRI_EMAIL']; ?> :<span class="form_star">*</span></label>
							<div class="fullname"><input type="text" value="" name="friend_email" class="required" onkeyup="Referralfriend(this.value)"/></div>
							<em>
	<?php if(isset($this->form_error['friend_email'])){ echo $this->form_error["friend_email"]; }?>
	</em>
						</li>
					</ul>
				</div>
				</div>
                </div>
                <input name="friend_gift"  value="1" type="hidden">

                <?php } else {?>
                <input name="friend_name"  type="hidden" value="xxxyyy" >
                <input name="friend_email"   type="hidden" value="xxxyyy@zzz.com" >
                <input name="friend_gift"  value="0" type="hidden">
                <?php } ?>

  

		<div id="order_hide">
               <div class="buy_it complete_order_button">
                                                        
                <input class="bnone" id="complete_order" name="Submit" type="submit" value="<?php echo $this->Lang['COMP_ODR']; ?>" onclick="return complete_ref();"/>
                
                
                   

               </div> 
                <div class="payment_terms_outer"><p class="terms-conditons-text" style="padding-left:0px;"> <span class="fl font_myriad_pro"><?php echo $this->Lang['BY_CLICK']; ?> </span> <a onclick="show_dis_tc();" title="<?php echo $this->Lang['TEMRS']; ?>" class="font_myriad_pro mt5"><?php echo $this->Lang['TEMRS']; ?>.</a></p> </div>
               

                
                
                </div>
		
		</div>
				</form>
				<?php
						/* New div for paymnet- script issue fix - start*/
				?>
				<div id="order_complete" style="display:none;">
               <div class="buy_it complete_order_button">                                                        
                <input id="complete_order" name="Submit" type="submit" value="<?php echo $this->Lang['COMP_ODR']; ?>" onclick="return complete_ref();"/>
                </div>
                
                   

                <?php if(count($this->cms_tc) > 0){ ?>
                <div class="payment_terms_outer"><p class="terms-conditons-text" style="padding-left:0px;"> <span class="fl font_myriad_pro"><?php echo $this->Lang['BY_CLICK']; ?> </span> <a onclick="show_dis_tc();" title="<?php echo $this->Lang['TEMRS']; ?>" class="font_myriad_pro mt5"><?php echo $this->Lang['TEMRS']; ?>.</a></p> </div>
                <?php } ?>

                
                
                </div>
				
				<?php
						/* New div for paymnet- script issue fix - end*/
				?>
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

                    </div>
                    <!--end-->
                </div>
            </div>
        </div>

<script type="text/javascript">
var friend_buy = <?php echo $friend_buy;?>;
function complete_ref() {
		var ref=$("#ref").val();
		
		if(ref <= <?php echo $referral_balance;  ?>)
                {
						if(friend_buy==0){
						$(".complete_order_button").hide(); 
						}
						$('form#commentForm_ref').submit();
						return true;
				}else{
						alert("Insufficient balance");	
						return false;
				}
		}

</script>

