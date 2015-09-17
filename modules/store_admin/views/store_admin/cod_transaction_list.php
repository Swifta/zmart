<?php defined('SYSPATH') OR die("No direct access allowed."); ?>
<?php  if(($this->uri->segment(2)=='view-products')){	
								
		 if(count($this->cod_transaction_list) > 0){ ?>

		<a class="fr" style="float:right;text-decoration: underline; cursor: pointer;position:relative; z-index:2;" href="<?php echo PATH.'store-admin/view-products/'.$this->product_key.'/'.$this->product_id.'.html?id=COD' ?>" title="<?php echo $this->Lang['EXP_PRO']; ?>"><img src="<?php echo PATH ?>images/csv.png" class="image" alt="<?php echo $this->Lang['EXP_PRO']; ?>"/></a>

		<?php } } ?>

<?php if(count($this->cod_transaction_list) > 0){ ?>
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
			<?php if(($this->uri->segment(2) == "view-deal")||($this->uri->segment(2) == "view-products")) { ?>
				<th align="left" ><?php echo $this->Lang["TRANS_TYPE"]; ?></th>
			<?php } ?>
                </tr>
                
                
                
                <?php $i = 0;  if(($this->uri->segment(2) == "view-deal") ||($this->uri->segment(2) == "view-products")) {  $first_item = 1; } else { $first_item = $this->pagination->current_first_item; }
                
                        $tot_quan = ""; 
			$tot_amount = "";
			$tot_commission = "";
			$tot_reff = "";
			$tot_shipping = "";
			$tot_tax = "";
			
			foreach($this->cod_transaction_list as $u){?>
                <tr> 
         	    <td align="center"><?php echo $i+$first_item; ?></span></td>	
		    <td align="left" > <?php echo ucfirst(htmlspecialchars($u->firstname)); ?> </td>
		    
		    <?php if(($this->uri->segment(2) != "view-deal") && ($this->uri->segment(2) != "view-products")){  ?>
		   
		    <td align="left"><a href="<?php echo PATH.'store-admin/view-products/'.$u->deal_key.'/'.$u->deal_id.'.html';?>" title="<?php echo $u->deal_title; ?>">
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
                  <?php if(($this->uri->segment(2) == "view-deal")||($this->uri->segment(2) == "view-products")) { ?>  
                    <td><span class="align">
		    <?php if($u->type=="1"){ echo '<span class="clor2">'. $this->Lang["PAYPAL_CREDIT"] .'</span>'; } ?>
		    <?php if($u->type=="2"){ echo '<span class="clor2">'. $this->Lang["PAYPAL"] .'</span>'; } ?>
		    <?php if($u->type=="3"){ echo '<span class="clor2">'. $this->Lang["REF_PAYMENT"] .'</span>'; } ?>
		    <?php if($u->type=="4"){ echo '<span class="clor2">'. "Authorize.net(".$u->transaction_type.")" .'</span>'; } ?>
		    <?php if($u->type=="5"){ echo '<span class="clor2">'.$u->transaction_type.'</span>'; } ?>
		    </span></td>
				<?php } ?>
                </tr>
            <?php  $i++;} ?> 
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
  <?php } else{?><p class="nodata"><?php echo $this->Lang['NO_COD_T_FOUND']; ?></p><?php }?>
