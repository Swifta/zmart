<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10" >
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="get" class="admin_form" action="">
            <table class="list_table1 fl clr">
             <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
	 <?php if(count($this->shipping_list)>0){?>

	 	<?php if($this->pagination !=""){ // export per page ?>
				<a class="fr frm_export" href="<?php echo PATH.$this->url.'/page/'.$this->page.'?id='.$this->Lang['SEARCH'].'&search='.$this->input->get('search');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_PAGE']; ?></a>
			<?php } ?>
			
		<a class="fr frm_export" href="<?php echo PATH.$this->url.'?id='.$this->Lang['ALL2'].'&search='.$this->input->get('search');  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><?php echo $this->Lang['EXP_ALL']; ?></a>

	<?php }  ?>	
                <?php 
	            if(isset($this->search_key)){
		            $s = $this->search_key;
	            }?>
                

			 <tr>
				<td><label><?php echo $this->Lang['SEARCH']; ?></label></td>
                <td><label>:</label></td>
                <td><input autofocus type = "text" name ="search" <?php if(isset($s->search)){?> value="<?php echo $s->search; ?>"<?php } ?>/>
                    <div class="new_search_button"> <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>"/> </div>
                </td>
	
                <td></td>
            </tr>
            <tr>
            <td></td><td></td><td>
           	 <label><?php echo $this->Lang['NAME'].",".$this->Lang['EMAIL']; ?></label>
            </td>
            </tr>
        </table>
        </form>
    
    <?php if(count($this->shipping_list)>0){?>
        <table class="list_table fl clr mt15">
        	<tr>
        	<th align="left" ><?php echo $this->Lang['S_NO']; ?></th>
        	<th align="left" ><?php echo $this->Lang['AUCTION']; ?> <?php echo $this->Lang['NAME']; ?></th>
			<th align="left" ><?php echo $this->Lang['NAME']; ?></th>
           	<th align="left" ><?php echo $this->Lang['EMAIL']; ?></th>
			<th align="left" ><?php echo $this->Lang['DATE']; ?></th>
			<th align="left" ><?php echo $this->Lang['PH_NUM']; ?></th>
	<?php /* <th align="left" ><?php echo $this->Lang['ADDRES']; ?></th> */ ?>
        	<th align="left" ><?php echo $this->Lang['DETAILS']; ?></th>
			<th align="left" ><?php echo $this->Lang['DELIVERY_STA']; ?></th>
			
		<?php /*<th align="left" ><?php echo $this->Lang["DELETE"]; ?></th> */ ?>
                
            </tr>
            <?php $i=0; $first_item = $this->pagination->current_first_item;

                foreach($this->shipping_list as $u){?>
                <tr>    
                        <td align="left"><?php echo $i+$first_item; ?></td>
                        <td align="left"><a href="<?php echo PATH.'admin/view-auction/'.$u->deal_key.'/'.$u->auction_id.'.html';?>"><?php echo $u->deal_title; ?></a></td>
                    	<td align="left"><?php echo $u->firstname; ?></td>

                        <td align="left"><?php echo $u->email; ?></td>	
						<td align="left"><?php echo date('d-M-Y h:i:s',$u->shipping_date); ?></td>	
                  
     			 <td width=12 align="left"><?php echo $u->phone; ?></td>
		<?php /*	
			<td align="left"><?php echo $u->adderss1.",".$u->address2; ?></td> */ ?>
			
			<td align="left"><center><a id="details-panel<?php echo $u->shipping_id; ?>" title="<?php echo $this->Lang['SEND_MAIL']; ?>"  href="javascript:;" ><img src="<?php echo PATH;?>images/details_view.gif"><input type="hidden" name="email1" id="mail" value="<?php echo $u->email; ?>"></center></a>
            
			<div class="popup_show1 popup_show_act_ship" id="lightboxdetails-panel<?php echo $u->shipping_id; ?>" style="display:none;"  >
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
									<?php echo $u->city_name.'-'.$u->zipcode; ?>.<br>
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
										<strong style="font-size: 15px; margin:0; padding:0;"><?php echo $this->Lang['SHIP_DEL']; ?></strong><br>
										<strong style="font-size: 13px; margin:0; padding:0;"><?php echo $this->Lang['AMO_TO_B_PAID']; ?>: <?php echo CURRENCY_SYMBOL.(($u->bid_amount * $u->quantity) + ($u->shipping) + ($u->tax_amount)); ?></strong><br>
										<span class="caption"><?php echo $this->Lang['INCLU_ALL_CH']; ?></span><br>
										<strong style="font-size: 13px; margin:0; padding:0;"><?php echo $this->Lang['OR_DATE']; ?>: <?php echo date("d-M-Y h:i:s A",$u->transaction_date); ?></strong><br>
										<strong style="font-size: 13px; margin:0; padding:0;"><?php echo $this->Lang['DELIVERY_STA']; ?>: <?php echo $u->shipping_info; ?></strong><br>
											<br><br>
											<strong style="font-size: 12px; margin:0; padding:0;"><?php echo $this->Lang['IP']; ?>: <?php echo $u->ip; ?></strong><br>
											<strong style="font-size: 12px; margin:0; padding:0;"><?php echo $this->Lang['IP_CITY']; ?>: <?php echo $u->ip_city_name; ?></strong><br>
											<strong style="font-size: 12px; margin:0; padding:0;"><?php echo $this->Lang['IP_COUNTRY']; ?>: <?php echo $u->ip_country_name; ?></strong><br>
			   
								</div>
								<div style="float:left; width: 50%; margin-left: 20px;">
										 <strong style="font-size: 15px; font-weight:bold;"><?php echo $this->Lang['SHIP_ADDR']; ?></strong>
										<br><br>
										<strong style="font-size: 15px; font-weight:bold;"><?php echo ucfirst($u->name); ?> </strong><br>
										<?php echo $u->saddr1."<br />".$u->saddr2; ?>,<br>
										<?php echo $u->city_name . '-' . $u->postal_code; ?><br>
										<?php echo $u->country; ?><br>
										<strong style="font-size: 15px; font-weight:bold;"><?php echo $this->Lang['PHO']; ?>: <?php echo $u->phone; ?> </strong>
								</div>
							<div style="clear:both;"></div>
						</div>
					
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
												<td width="13%" align="center"><?php echo $this->Lang['QUAN']; ?></td>
												<td width="13%" align="center"><?php echo $this->Lang['START_BID_AMO']; ?></td>
												<td width="13%" align="center"><?php echo $this->Lang['YOUR_BID']; ?></td>
												<td width="13%" align="right"><?php echo $this->Lang['SUB_TOT']; ?></td>
											</tr>
										<tr><td>&nbsp;</td><td colspan="6"><hr style="border:1px dotted #AAAAAA;"></td></tr>
										<tr>
											<td width="16%">&nbsp;</td>
											<td align="center"><?php echo $u->quantity; ?></td>
											<td align="center"><?php echo CURRENCY_SYMBOL.$u->deal_value; ?></td>
											<td align="center"><?php echo CURRENCY_SYMBOL.$u->bid_amount; ?></td>
											<td align="right"><?php echo CURRENCY_SYMBOL.$u->bid_amount * $u->quantity; ?></td>
										</tr>
										<tr><td colspan="7">&nbsp;</td></tr>
										 
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
							<div style="float:left; width: 18%; text-align:right;"><b><?php echo CURRENCY_SYMBOL.$u->bid_amount * $u->quantity; ?></b></div>
							<div style="clear:both;"></div>
					    	        	    
							<div style="float:left; width: 55%">&nbsp;</div>
							<div style="float:left; width: 27%; text-align:left;"><?php echo $this->Lang['SHIP_ING']; ?></div>
							<div style="float:left; width: 18%; text-align:right;"><b><?php if($u->shipping != 0 ) echo CURRENCY_SYMBOL.$u->shipping; else echo '-'; ?> </b></div>
							<div style="clear:both;"></div>
							
							<div style="float:left; width: 55%">&nbsp;</div>
							<div style="float:left; width: 27%; text-align:left;"><?php echo $this->Lang['TAX']; ?></div>
							<div style="float:left; width: 18%; text-align:right;"><b><?php if($u->tax_amount != 0 ) echo CURRENCY_SYMBOL.$u->tax_amount; else echo '-'; ?> </b></div>
							<div style="clear:both;"></div>
							<div style="float:left; width: 55%; margin-top: 10px;">&nbsp;</div>
							<div style="float:left; width: 45%; margin-top: 10px;">
								<div style="padding: 10px 0px; border-top: solid 0.15em; border-bottom: 0.15em solid;">
									<div style="width:50%; float:left;"><?php echo $this->Lang['AMO_TO_B_PAID']; ?></div>
									<div style="text-align:right; float:right; width:50%;">
										<strong style="font-size: 17px;"><?php echo CURRENCY_SYMBOL.(($u->bid_amount * $u->quantity) + ($u->shipping) + ($u->tax_amount)); ?></strong>
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
			
			
			</td>
			
			 
     
		<script>
$(document).keyup(function(e) {
if (e.keyCode == 27) 
  {
$('.popup_show_act_ship').hide();
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

$('#details-cancel<?php echo $u->shipping_id; ?>').click(function(){ 
$('#lightbox-panel<?php echo $u->shipping_id; ?>').hide();
})


$('#cancel').click(function(){ 
$('#em').text(''); 

})

});

</script>
	
                    <td align="center">
						<?php if($this->user_type==1){?>
						<?php if($u->delivery_status==4){ echo $this->Lang['DELIVERED']; } else { ?>
						<select  onchange="return auction_shipping_delivery('<?php echo $u->email; ?>','<?php echo $u->firstname; ?>','<?php echo $u->shipping_id; ?>',this.value,'0','<?php echo $u->auction_id; ?>','<?php echo $u->trans_id; ?>')">
							
								<option value="0" <?php if($u->delivery_status==0){ ?> selected <?php } ?> ><?php echo $this->Lang['PENDING']; ?></option>
								<option value="1"   <?php if($u->delivery_status==1){ ?> selected <?php } ?>><?php echo $this->Lang['ORDER_PACKED']; ?></option>
								<option value="2"  <?php if($u->delivery_status==2){ ?> selected <?php } ?>><?php echo $this->Lang['SHIPPED_DELI_CENT']; ?></option>
								<option value="3"  <?php if($u->delivery_status==3){ ?> selected <?php } ?>><?php echo $this->Lang['OR_OUT_DELI']; ?></option>
								<option value="4"  <?php if($u->delivery_status==4){ ?> selected <?php } ?>><?php echo $this->Lang['DELIVERED']; ?></option>
						</select>
					<?php } ?>
					<?php }else{
                                             if($u->delivery_status==0){
						   echo $this->Lang['PENDING'];
					     }else if($u->delivery_status==1){
						    echo $this->Lang['ORDER_PACKED'];
					     }else if($u->delivery_status==2){
						    echo $this->Lang['SHIPPED_DELI_CENT']; 
					     }else if($u->delivery_status==3){
						    echo $this->Lang['OR_OUT_DELI'];
					    }else{
						echo $this->Lang['DELIVERED'];
					    }

					    } ?>
                    </td>
                </tr>
            <?php $i++;} ?>   
        </table>
<?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>
     <?php echo $this->pagination; ?>    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
 
</div>



