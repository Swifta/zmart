<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
       <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
<div class="bread_crumb"><a href="<?php echo PATH.'merchant.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10" >
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="get" class="admin_form" action="">
            <table class="list_table1 fl clr">
	 <?php if(count($this->shipping_list)>0){?>

	<?php if($this->pagination !=""){ ?>
				<a class="fr frm_export" href="<?php echo PATH.$this->url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&search='.$this->input->get('search');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
			<?php } ?>
		<a class="fr frm_export" href="<?php echo PATH.$this->url.'?id='.$this->Lang['ALL2'].'&search='.$this->input->get('search');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>
		
	<?php  }	 ?>	
                <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key;
	            }?>
                

			 <tr>
		<td><label><?php echo $this->Lang['SEARCH']; ?></label></td>
                <td><label>:</label></td>
                <td><input type = "text" name ="search" <?php if(isset($s->search)){?> value="<?php echo $s->search; ?>"<?php } ?> autofocus />
                    <div class="new_search_button"> <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/> </div>
                </td>
	
                <td></td>
            </tr>
             <tr>
            <td></td><td></td><td>
           	 <label><?php echo $this->Lang['NAME'].",".$this->Lang['EMAIL'].",".'Coupon Code'; ?></label>
            </td>
            </tr>
        </table>
        </form>
    
    <?php if(count($this->shipping_list)>0){?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt15">
        	<tr>
        	<th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
        	<th align="left" ><?php echo $this->Lang['PRODUCTS']; ?> <?php echo $this->Lang['NAME']; ?></th>
			<th align="left" ><?php echo $this->Lang['NAME']; ?></th>
           	<th align="left" ><?php echo $this->Lang['EMAIL']; ?></th>
			<th align="left" ><?php echo $this->Lang['DATE']; ?></th>
			<th align="left" ><?php echo $this->Lang['PH_NUM']; ?></th>
			<th align="left" ><?php echo $this->Lang['ADDRES']; ?></th>
        	<th align="left" ><?php echo $this->Lang['DETAILS']; ?></th>
			<th align="left" ><?php echo $this->Lang['DELIVERY_STA']; ?></th>
			
		<?php /*<th align="left" ><?php echo $this->Lang["DELETE"]; ?></th> */ ?>
                
            </tr>
            <?php $i=0; $first_item = $this->pagination->current_first_item;

                foreach($this->shipping_list as $u){?>
                <tr>    
                        <td align="left"><?php echo $i+$first_item; ?></td>
                        <td align="left"><a href="<?php echo PATH.'merchant/view-products/'.$u->deal_key.'/'.$u->product_id.'.html';?>"><?php echo $u->deal_title; ?></a></td>
                    	<td align="left"><?php echo $u->firstname; ?></td>

                        <td align="left"><?php echo $u->email; ?></td>	
						<td align="left"><?php echo date('d-M-Y h:i:s',$u->shipping_date); ?></td>	
                  
     			 		<td width=12 align="left"><?php echo $u->phone; ?></td>
			
						<td align="left"><?php echo $u->adderss1.",".$u->address2; ?></td>
			
			<td align="left"><center><a id="details-panel<?php echo $u->shipping_id; ?>" title="<?php echo $this->Lang['SEND_MAIL']; ?>"  href="javascript:;" ><img src="<?php echo PATH;?>images/details_view.gif"><input type="hidden" name="email1" id="mail" value="<?php echo $u->email; ?>"></center></a>
			
			
            
			<div class="popup_show1 popup_block_mer_cod" id="lightboxdetails-panel<?php echo $u->shipping_id; ?>" style="display:none;"  >
			<div id="divToPrint<?php echo $u->shipping_id; ?>"   class="divToPrintval" >
			<div class="rejected_shipping" id="details-close<?php echo $u->shipping_id; ?>" ></div>
			<div class="printer_shipping blink" onclick="PrintDiv('<?php echo $u->shipping_id; ?>');" ></div>
			
			<script type="text/javascript">     
        function PrintDiv(val) {    
           var divid = 'divToPrint'+val;
           var divToPrint = document.getElementById(divid);          
           var popupWin = window.open('', '_blank', 'width=600,height=500');
           $('.print_div').hide();
            popupWin.document.open();
            popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
            $('.print_div').show();
                }
     </script> 
                <div class="display" style="width:666px; margin: 15px auto;"> 
		        
						<div style="width:99%;">
							<div class="HeadLogo" style="float:left; width: 35%;">
								<img style="border: medium none;" src="<?php echo PATH; ?>/themes/<?php echo THEME_NAME; ?>/images/logo.png" height="20"><br>
								<span style="color:#666666; font-size: 11px; line-height: 1.3em;">  

									<?php echo $u->store_name ; ?>,<br>
									<?php echo $u->addr1.','.$u->addr2 ; ?>,<br>
									<?php echo common::get_city_name($u->str_city_id).'-'.$u->zipcode; ?>.<br>
									<?php echo $this->Lang['PHONE']; ?>: <?php echo $u->str_phone; ?><br>
								</span>
							</div>
							<div style="float:left; width: 20%; text-align:center;">
								<strong style="font-size: 15px; font-weight:bold; font-family: Arial;"><?php echo $this->Lang['TAX_INVO']; ?> <br>
									</strong>
							</div>
							<div style="float:right; margin-right: 5px;text-align:center;">
								<div style="font-weight: bold; font-size: 15px; float:left; margin: 60px 10px 0 0;"></div>
								
							   <div style="clear:both;"></div>
							</div>
							<div style="clear:both;"></div>
						</div>
		        
					<hr style="border: 1px solid black; padding:0; margin: 20px 0 0 0; width: 99%;">
		        
						<div style="margin-top: 20px; width:99%;">
							<div style="float:left; margin-top: 20px;"></div>
								<div style="float:left; width: 40%; font-size:12px; border-right: 1px dotted #666666; margin-left: 10px;">
										<strong style="font-size: 15px; margin:0; padding:0;"><?php echo $this->Lang['CASH_ON_DELI']; ?></strong><br><br><br>
										<?php $ship = 0;  if(($u->shipping_methods != 1) && ($u->shipping_methods != 5) ){ ?> <?php $ship = $u->shipping;  } ?>
										<strong style="font-size: 15px; margin:0; padding:0;"><?php echo $this->Lang['AMO_TO_B_PAID']; ?>: <?php echo CURRENCY_SYMBOL.($u->amount+$ship); ?></strong><br>
										<span class="caption"><?php echo $this->Lang['INCLU_ALL_CH']; ?></span><br><br>
										<strong style="font-size: 15px; margin:0; padding:0;"><?php echo $this->Lang['COUP_NO']; ?> : <?php echo $u->coupon_code; ?></strong><br>
											<?php echo $this->Lang['OR_DATE']; ?>: <?php echo date("d-M-Y h:i:s A",$u->transaction_date); ?><br><br>
											<b><?php echo $this->Lang['IP'] . ' : ' . $u->ip; ?><br>
                                                                        <?php if($u->ip_city_name != "" ){ ?>
                                                                        <?php echo $this->Lang['IP_CITY'] . ' : ' . $u->ip_city_name; ?><br>
                                                                        <?php } ?>
                                                                        <?php echo $this->Lang['IP_COUNTRY'] . ' : ' . $u->ip_country_name; ?><br></b>
			   
								</div>
								<div style="float:left; width: 50%; margin-left: 20px;">
										 <strong style="font-size: 15px; font-weight:bold;"><?php echo $this->Lang['SHIP_ADDR']; ?></strong>
										<br><br>
										<strong style="font-size: 15px; font-weight:bold;"><?php echo ucfirst($u->name); ?> </strong><br>
										<?php echo $u->saddr1."<br />".$u->saddr2; ?>,<br>
										<?php echo $u->city_name . '-' . $u->postal_code; ?><br>
										<?php echo $u->state; ?> ,<?php echo $u->country; ?><br>
										<strong style="font-size: 15px; font-weight:bold;"><?php echo $this->Lang['PHONE']; ?>: <?php echo $u->phone; ?> </strong>
								</div>
								<?php if($u->user_auto_key!=""){?>
								<?php if($u->bulk_discount!=""){?>
							<div style="clear:both;text-align:center;"><strong style="font-size: 15px; font-weight:bold;"><?php echo "Offer :".$u->bulk_discount;?></strong></div>
							<?php } ?>
							 <?php $this->gift=$this->merchant->get_gift($u->gift_id);?>
							<?php if(count($this->gift)>0){?>
							<div style="clear:both;text-align:center;"><strong style="font-size: 15px; font-weight:bold;"><?php echo "Free Gift :".$this->gift->current()->gift_name;?></strong></div>
							<?php } ?>
						</div>
						<?php } ?>
					
					<hr style="border: 1px dotted black; padding:0; margin: 20px 0 0 0; width: 99%;">
						<div style="margin-top: 50px; text-align:center;">
							<strong style="font-size: 15px; font-weight:bold; font-family: Arial;"><?php echo $this->Lang['IN_DETAILS']; ?></strong><br>
							<b><?php echo $this->Lang['NOTE']; ?>:</b> <?php echo $this->Lang['THIS_SH_CON_FO_IT']; ?><br><br>
						</div>
					<table cellpadding="0" cellspacing="0" width="99%">
						<tbody><tr>
							<td><hr style="border: 1px solid black;"></td>
						</tr>
						<tr>
							<td>
								<table class="printtable" cellpadding="0" cellspacing="0" width="99%">
									<tbody>
                                                                        <tr>
                                                                        <td colspan="7"><b>1. <?php echo $u->deal_title; ?></b></td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td colspan="7">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td width="10%">&nbsp;</td>
                                                                        <td width="13%" align="center"><?php echo $this->Lang['COLOR']; ?></td>
                                                                        <td width="13%" align="center"><?php echo $this->Lang['SIZE']; ?></td>
                                                                        <td width="13%" align="center"><?php echo $this->Lang['QUAN']; ?></td>
                                                                        <td width="13%" align="center"><?php echo $this->Lang['UNIR_PR']; ?></td>
                                                                        <td width="20%" align="center"><?php echo $this->Lang['DEALVALUE']; ?></td>
                                                                        <td width="13%" align="right"><?php echo $this->Lang['SUB_TOT']; ?></td>
                                                                        </tr>
                                                                        <tr><td>&nbsp;</td><td colspan="6"><hr style="border:1px dotted #AAAAAA;"></td></tr>
                                                                        <tr>
                                                                        <td width="16%">&nbsp;</td>
                                                                        <?php if($u->product_color !=0 ) { foreach($this->product_color as $pro){ ?>
                                                                        <?php if($u->product_color == $pro->id){ ?>                   
                                                                        <td align="center">
                                                                        <?php echo ucfirst($pro->color_name); ?></td>
                                                                        <?php } } } else { ?><td align="center">-</td> <?php } ?>
                                                                        <?php if($u->product_size != 0 ){ foreach($this->product_size as $size){ ?>
                                                                        <?php if($u->product_size == $size->size_id){ ?>                 
                                                                        <td align="center">
                                                                        <?php echo $size->size_name; ?></td>
                                                                        <?php } } } else { ?><td align="center">-</td> <?php } ?>
                                                                        <td align="center"><?php echo $u->quantity; ?></td>
                                                                        <td align="center"><?php echo CURRENCY_SYMBOL.$u->deal_price; ?></td>
                                                                        <td align="center"><?php echo CURRENCY_SYMBOL.$u->deal_value; ?></td>
                                                                        <td align="right"><?php echo CURRENCY_SYMBOL.$u->deal_value * $u->quantity; ?></td>
                                                                        </tr>
                                                                        <tr><td colspan="7">&nbsp;</td></tr>
								</tbody>
								</table>
								<table class="printtable" cellpadding="0" cellspacing="0" width="99%">
                                                                <tbody>
                                                                <?php $ship_dispay = ""; 
                                                                if($u->shipping_methods == 1){
                                                                $ship_dispay = $this->Lang['FREE_SHIPP_PROD'];
                                                                } ?>                                                                
                                                                <?php if($u->shipping_methods == 2){
                                                                $ship_dispay = $this->Lang['FLAT_SHIPP_T_PRO'];
                                                                } ?>                                                                
                                                                <?php if($u->shipping_methods == 3){
                                                                $ship_dispay = $this->Lang['PER_PRO_SHIPP_PRODUCT_SHIPP'];
                                                                } ?>                                                                
                                                                <?php if($u->shipping_methods == 4){ 
                                                                $ship_dispay = $this->Lang['PER_ITEM_PRODU_SHIPPING_AMOU'];
                                                                } ?>
                                                                <?php if($u->shipping_methods == 5){ 
                                                                $ship_dispay = $this->Lang['ARAMEX_SHIPP_PROD'];
                                                                } ?>
                                                                <tr>
                                                                <td width="60%">&nbsp;</td>
                                                                <td align="right"><?php echo $ship_dispay; ?> <?php if(($u->shipping_methods != 1) && ($u->shipping_methods != 5) ){ ?> ( <?php echo CURRENCY_SYMBOL.$u->shipping; ?> )  <?php } ?></td>
                                                                </tr>
                                                                <?php if($u->shipping_methods == 5){ ?>
                                                                <tr>
                                                                <td align="right"><?php echo $this->Lang['CUUR_CODE']; ?> ( <?php echo $u->aramex_currencycode; ?> ) </td>
                                                                <td align="right"><?php echo $this->Lang['ARAMEX_COST']; ?> ( <?php echo $u->aramex_value; ?> ) </td>
                                                                </tr>
                                                                <?php } ?>
                                                                </tbody>
                                                                </table>
							</td>
						</tr>
						<tr>
							<td><hr style="border: 1px solid black;"></td>
						</tr>
					</tbody></table>
						<div style="clear:both;"></div>
						<div style="width:99%;  line-height: 2em; text-align:left; page-break-before: auto;">
							<div style="float:left; width: 55%">&nbsp;</div>
							<div style="float:left; width: 27%; text-align:left;"><?php echo $this->Lang['SHIP_VAL']; ?></div>
							<div style="float:left; width: 18%; text-align:right;"><b><?php echo CURRENCY_SYMBOL.$u->deal_value * $u->quantity; ?></b></div>
							<div style="clear:both;"></div>
					    	        	    
							<div style="float:left; width: 55%">&nbsp;</div>
							<div style="float:left; width: 27%; text-align:left;"><?php echo $this->Lang['SHIP_ING']; ?></div>
							<div style="float:left; width: 18%; text-align:right;"><b><?php if($u->shipping != 0 ) echo CURRENCY_SYMBOL.$u->shipping; else echo '-'; ?> </b></div>
							<div style="clear:both;"></div>
							
							<?php /*<div style="float:left; width: 55%">&nbsp;</div>
							<div style="float:left; width: 27%; text-align:left;"><?php echo $this->Lang['TAX']; ?></div>
							<div style="float:left; width: 18%; text-align:right;"><b><?php if($u->tax_amount != 0 ) echo CURRENCY_SYMBOL.$u->tax_amount; else echo '-'; ?> </b></div>
							<div style="clear:both;"></div> */ ?>
							<div style="float:left; width: 55%; margin-top: 10px;">&nbsp;</div>
							<div style="float:left; width: 45%; margin-top: 10px;">
								<div style="padding: 10px 0px; border-top: solid 0.15em; border-bottom: 0.15em solid;">
									<div style="width:50%; float:left;"><?php echo $this->Lang['AMO_TO_B_PAID']; ?></div>
									<div style="text-align:right; float:right; width:50%;">
										<strong style="font-size: 17px;"><?php echo CURRENCY_SYMBOL.(($u->deal_value * $u->quantity) + ($u->shipping) + ($u->tax_amount)); ?></strong>
									</div>
									<div style="clear:both;"></div>
								</div>
							</div>
							<div style="clear:both"></div>
						</div>
		
						<div style="clear:both"></div>
		    	        <div style="height: 30px;">&nbsp;</div>
						<div style="clear:both;"></div>
		        
						<div style="position: relative; bottom: 2px;">
							<div style="text-align:left; margin-top: 30px; padding: 0;">
								<?php echo $this->Lang['QUES_FEEL_CUST']; ?> <b><?php echo $u->str_phone; ?></b> <?php echo $this->Lang['OR_WEB']; ?> <b><?php echo $u->website; ?></b>                
							</div>
				              
						</div>
					</div>
				</div>
                

	</div>
	    </div>
			</div>
			
			
			</td>
			
			 
     
		<script>
		
		$(document).keyup(function(e) {
                if (e.keyCode == 27) 
                  {
                $('.popup_block_mer_cod').hide();
                 } 
                });
                
$(document).ready(function(){


$('a#show-panel<?php echo $u->shipping_id; ?>').click(function(){ 
$('#lightbox-panel<?php echo $u->shipping_id; ?>').show();
})

$('a#details-panel<?php echo $u->shipping_id; ?>').click(function(){ 
$('#lightboxdetails-panel<?php echo $u->shipping_id; ?>').show();
$('.divToPrintval').show();
})

$('#details-close<?php echo $u->shipping_id; ?>').click(function(){ 
$('#lightboxdetails-panel<?php echo $u->shipping_id; ?>').hide();
})

$('#submit-<?php echo $u->shipping_id; ?>').click(function(){


var path = $('#path').val();
var coupon = $('#coupon-<?php echo $u->shipping_id; ?>').val();
var amount = $('#amount-<?php echo $u->shipping_id; ?>').val();
var trans_id = $('#trans_id-<?php echo $u->shipping_id; ?>').val();

if(coupon==''){
$('td#error-<?php echo $u->shipping_id; ?>').html("Please enter coupon code");
return false;
}
else if(coupon != '' && amount != '' && trans_id != ''){
		
	$.post(path+'merchant/validate_coupon?coupon='+coupon+'&amount='+amount+'&trans_id='+trans_id,{

				}, function(data){ 
								
				if(data == 1){
					$('#form-<?php echo $u->shipping_id; ?>').submit();
				}
				else { 
						$('td#error-<?php echo $u->shipping_id; ?>').html("Please correctly enter a coupon code for this shipping");
						return false;					
				}
		});
}

});
$('#details-cancel<?php echo $u->shipping_id; ?>').click(function(){ 
	$('td#error-<?php echo $u->shipping_id; ?>').html("");
	$('#coupon-<?php echo $u->shipping_id; ?>').val('');
	$('#lightbox-panel<?php echo $u->shipping_id; ?>').hide();
})

});

</script>
	
                        <td align="center">
						<?php if($u->delivery_status==4) {
								echo $this->Lang['COMPLETED'];
							?>
								
						<?php } elseif($u->delivery_status==5) {
									echo $this->Lang['FAILED'];
							} else { ?>
							<select  onchange="return product_cod_delivery('<?php echo $u->email; ?>','<?php echo $u->firstname; ?>','<?php echo $u->shipping_id; ?>',this.value,'<?php echo $u->trans_id; ?>','<?php echo $u->product_id; ?>','<?php echo $u->merchant_id; ?>','1')">
							<option value="0" <?php if($u->delivery_status==0){ ?> selected <?php } ?>><?php echo $this->Lang['PENDING']; ?></option>
								<option value="4" <?php if($u->delivery_status==4){ ?> selected <?php } ?>><?php echo $this->Lang['COMPLETED']; ?></option>
								<option value="5" <?php if($u->delivery_status==5){ ?> selected <?php } ?>><?php echo $this->Lang['FAILED']; ?></option>
							<?php } ?>
                    </td>
                    
                </tr>
            <?php $i++;} ?>   
        </table>
        </div>
<?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
     <?php echo $this->pagination; ?>    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
 
</div>



