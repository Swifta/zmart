<?php defined('SYSPATH') OR die("No direct access allowed."); ?>
<?php  if(($this->uri->segment(2)=='view-products')){	
								
		/* if(count($this->store_credits_transaction_list) > 0){ ?>

		<a class="fr" style="float:right;text-decoration: underline; cursor: pointer;position:relative; z-index:2;" href="<?php echo PATH.'merchant/view-products/'.$this->product_key.'/'.$this->product_id.'.html?id=COD' ?>" title="<?php echo $this->Lang['EXP_PRO']; ?>"><img src="<?php echo PATH ?>images/csv.png" class="image" alt="<?php echo $this->Lang['EXP_PRO']; ?>"/></a>

		<?php } */ } ?>

<?php if(count($this->store_credits_transaction_list) > 0){ ?>
                <div class="table_over_flow">
        <table class="list_table fl clr mt20">
        	<tr>
			<th align="left" ><?php echo $this->Lang["S_NO"]; ?></span></th>
			<?php if(($this->uri->segment(2) != "view-deal")&&($this->uri->segment(2) != "view-products") && ($this->uri->segment(2) != "view-user")){  ?>
			<th align="left" ><div class="arrow"><a href="<?php echo $this->sort_url;?>param=username&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_BY_NAME']; ?>" ><?php echo $this->Lang["USERS"]; ?></a></div></th>
			
			<th align="left" ><div class="arrow1"><a href="<?php echo $this->sort_url;?>param=title&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_B_DEAL_TIT']; ?>" ><?php echo $this->Lang["PRODUCT_TITLE"]; ?></a></div></span></th>
			
			<th align="left" ><div class="arrow3"><a href="<?php echo $this->sort_url;?>param=quantity&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_B_QUAN']; ?>" ><?php echo $this->Lang["QUAN"]; ?></a></div></th>
			<th align="left" ><div class="arrow3"><a href="<?php echo $this->sort_url;?>param=amount&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_B_AMOUNT']; ?>" ><?php echo $this->Lang["AMOUNT"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></a></div></th>
		
		
					
				<?php   } else { ?>
			<th align="lefft" > <?php echo $this->Lang['USERS']; ?> </th>
			<?php if(($this->uri->segment(2) != "view-deal") && ($this->uri->segment(2) != "view-products")){  ?>
			<th align="lefft" > <?php echo $this->Lang["PRODUCT_TITLE"]; ?> </th>
			<?php } ?>
			<th align="lefft" > <?php echo $this->Lang["QUAN"]; ?> </th>
			
			<th align="lefft" > <?php echo $this->Lang["AMOUNT"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?> </th>
			<?php   }  ?>
			
			<?php if($this->uri->segment(2) != "view-user"){  ?>	
			<th align="left" ><?php echo $this->Lang["ADMIN_COMMISSION"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></th>
			<?php } ?>
			<th align="lefft" > <?php echo $this->Lang['SHIP_ING']; ?> <?php echo '('.CURRENCY_SYMBOL.')';?></th>
			<?php /**<th align="lefft" > <?php echo $this->Lang['TAX']; ?> <?php echo '('.CURRENCY_SYMBOL.')';?></th> */ ?>
			<?php if(($this->uri->segment(2) == "view-deal")&&($this->uri->segment(2) == "view-products")){  ?>	
			<th align="left" ><?php echo $this->Lang["TRANS_ID"]; ?></span></th>
			<?php } ?>
			<?php if(($this->uri->segment(2) == "view-deal")||($this->uri->segment(2) == "view-products")||($this->uri->last_segment() == "all-transaction.html")||($this->uri->segment(2) == "all-transaction")){  ?>			
			<th align="left" ><?php echo $this->Lang["STATUS"]; ?></th> 
			<?php } ?>
			<th align="left" ><?php echo $this->Lang["TRANS_DATE"]; ?></th>
			<th align="left" ><?php echo $this->Lang["INST_DET"]; ?></th>
			
                </tr>
                
                
                
                <?php $k = 0;  if(($this->uri->segment(2) == "view-deal") ||($this->uri->segment(2) == "view-products")) {  $first_item = 1; } else { $first_item = $this->pagination->current_first_item; }
                
                        $tot_quan = ""; 
			$tot_amount = "";
			$tot_commission = "";
			$tot_reff = "";
			$tot_shipping = "";
			$tot_tax = "";
			
			foreach($this->store_credits_transaction_list as $u){?>
                <tr> 
         	    <td align="center"><?php echo $k+$first_item; ?></span></td>	
		    <td align="left" > <?php echo ucfirst(htmlspecialchars($u->firstname)); ?> </td>
		    
		    <?php if(($this->uri->segment(2) != "view-deal") && ($this->uri->segment(2) != "view-products")){  ?>
		   
		    <td align="left"><a href="<?php echo PATH.'admin/view-products/'.$u->deal_key.'/'.$u->deal_id.'.html';?>" title="<?php echo $u->deal_title; ?>">
		    <?php echo htmlspecialchars($u->deal_title); ?></a></td>
			<?php } ?>
		    <td align="center"><?php echo $u->quantity; ?></td>
		    
		    
		    <?php $tot_quan +=$u->quantity; ?>
		    
		     <?php $commission_val=$u->deal_merchant_commission; ?> 
		    <?php  
		        $commission=$u->deal_value *($commission_val/100);
		    ?>	   
		     
		    <td align="center"><span class="align"><?php echo ($u->deal_value-$commission)*$u->quantity; ?></span></td>
		    <?php $tot_amount +=($u->deal_value)*$u->quantity; ?>
		    
		    <td align="center"><span class="align"><?php echo $commission*$u->quantity; ?></span></td>  
		    <?php $tot_commission +=$commission*$u->quantity; ?>
		    <td align="center"><?php echo $u->shippingamount; ?></td>
		    <?php /**<td align="center"><?php echo $u->tax_amount; ?></td> */ ?>
		    <?php $tot_shipping +=$u->shippingamount; ?>
		    <?php $tot_tax +=$u->tax_amount; ?>
		    <?php if(($this->uri->segment(2) == "view-deal")&&($this->uri->segment(2) == "view-products")){  ?>	
		    <td ><span class="align"><?php echo $u->transaction_id; ?></span></td>
		   <?php }?>
		    <?php if(($this->uri->segment(2) == "view-deal")||($this->uri->segment(2) == "view-products")||($this->uri->last_segment() == "all-transaction.html")||($this->uri->segment(2) == "all-transaction")){  ?>
		    <td ><span class="align">
		    <?php if($u->payment_status=="SuccessWithWarning"){ echo '<span class="clor">'. $this->Lang["SUCCESS"] .'</span>'; } ?>
		    <?php if($u->payment_status=="Completed"){ echo '<span class="clor3">'. $this->Lang["COMPLETED"] .'</span>'; } ?>
		    <?php if($u->payment_status=="Success"){ echo '<span class="clor">'. $this->Lang["SUCCESS"] .'</span>'; } ?>
		    <?php if($u->payment_status=="Pending"){ echo '<span class="clor4">'.$this->Lang["PENDING"].'</span>'; } ?>
		    <?php if($u->payment_status=="Failed"){ echo '<span class="clor5">'.$this->Lang["FAILED"].'</span>'; } ?>
		    
		    </span></td>
		    <?php } ?>	
			
                    <td align="left"><?php echo date('d-M-Y h:i:s A',$u->transaction_date); ?></td>
                   <td align="center">
					 <a id="details-panel<?php echo $u->main_storecreditid; ?>" title=""  href="javascript:;" ><img src="<?php echo PATH;?>images/details_view.gif"></a>
					<div class="popup_show1 popup_block_mer_ship" id="lightboxdetails-panel<?php echo $u->main_storecreditid; ?>" style="display:none;"  >
						<div class="rejected_shipping" id="details-close<?php echo $u->main_storecreditid; ?>" ></div>
						<?php   
						$instalment_value =0;
						$grand_tot = ($u->deal_value * $u->quantity)+ $u->shippingamount;
						if($u->duration_period!="" && $u->duration_period!=0){ 
							$instalment_value = $grand_tot/$u->duration_period;
						} 
					?>  
						<table cellpadding="0" cellspacing="0" width="100%">
							 <tr height="30" valign="middle" style=" padding: 10px; font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
								 <td width="80%" align="center">
								<img style="border: medium none;" src="<?php echo PATH; ?>/themes/<?php echo THEME_NAME; ?>/images/logo.png" height="20"><br>
								</td>
							</tr>
							<?php if($u->duration_period!=""){?>
							 <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
							<td width="80%" align="center"><?php echo $this->Lang["STR_CRD"]." : ".$u->duration_period." ".$this->Lang["MTHS"]; ?></td></tr>
							<?php } ?>
							<?php if($u->duration_period!=""){ 
								for($i=1;$i<=$u->duration_period;$i++) { ?>

							 <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
							<td width="80%" align="center"><?php echo $this->Lang["INSTL"]." ".$i." : ".CURRENCY_SYMBOL.$instalment_value." => "; ?>
							<?php if($u->installments_paid>=$i) { ?>
							<span style="color:#000"><?php echo $this->Lang["PAID"]; ?> </span>
							<?php } elseif($u->installments_paid+1==$i) { ?>
								<span style="color:#FDB713"> <?php echo $this->Lang["NXT_INST_PAY"]; ?> </span>
							<?php } else { ?>
							<span style="color:#A61C00"><?php echo $this->Lang["YET_TO_PAY"]; ?> </span>
							<?php } ?>
							</td></tr>
							<?php } } ?>
							</table>
					</div>
                 </td>
                   <script>
					$(document).keyup(function(e) {
						if (e.keyCode == 27) 
						{
							$('.popup_block_mer_ship').hide();
						 } 
					 });
                
					$(document).ready(function(){
						$('a#details-panel<?php echo $u->main_storecreditid; ?>').click(function(){ 
							$('#lightboxdetails-panel<?php echo $u->main_storecreditid; ?>').show();
						});
						
						$('#details-close<?php echo $u->main_storecreditid; ?>').click(function(){ 
						$('#lightboxdetails-panel<?php echo $u->main_storecreditid; ?>').hide();
						})
					});
                
                </script>
                </tr>
            <?php  $k++;} ?> 
        </table> 
                </div>
                <div class="table_over_flow">
        <table class="list_table fl clr mt20">
            
           <th align="left" >
           <fieldset>
    		<legend><?php echo $this->Lang["PAYMENT_DETAILS"]; ?></legend>
         <div class="value_total_in">
           
           <div class="value_amount"><p align="left"> <?php echo $this->Lang["TOT_PURC_QUAN"]; ?> </p> <b>:</b><span align="center"><?php echo $tot_quan; ?></span></div>
            <div class="value_amount"><p align="left"><?php echo $this->Lang["TOT_PURC_AMOUNT"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.($tot_amount+$tot_shipping+$tot_tax); ?> </span></div>
            
           <div class="value_amount"><p align="left"><?php echo $this->Lang["TOT_ADM_COMM"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_commission; ?> </span></div>
           
           <div class="value_amount"><p align="left"><?php echo $this->Lang["TOT_MER_AMOU"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.($tot_amount-$tot_commission); ?> </span></div>
           
           <div class="value_amount"><p align="left"><?php echo $this->Lang['TOTA_SHIPP_AMOUNT']; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_shipping; ?> </span></div>
           
           <?php /** <div class="value_amount"><p align="left"><?php echo $this->Lang['TOT_TAX_AMOUN']; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.($tot_tax); ?> </span></div> */ ?>
             </th>       
             
            </div> 
           </fieldset>
            </table>
                </div>
  <?php } else{?><p class="nodata"><?php echo $this->Lang['NO_STR_T_FOUND']; ?></p><?php }?>
