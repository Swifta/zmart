<?php defined('SYSPATH') OR die("No direct access allowed."); ?>
<?php  if(($this->uri->segment(2)=='view-auction')){	
		 if(count($this->transaction_auction_list) > 0){ ?>
		<a class="fr" style="float:right;text-decoration: underline; cursor: pointer;position:relative; z-index:2;" href="<?php echo PATH.'admin/view-auction/'.$this->auction_key.'/'.$this->auction_id.'.html?id=BID'  ?>" title="<?php echo $this->Lang['EXPO_BIDD_LI']; ?>"><img src="<?php echo PATH ?>images/csv.png" class="image" alt="<?php echo $this->Lang['EXPO_BIDD_LI']; ?>"/></a>
		<?php } } ?>

<?php if(count($this->transaction_auction_list) > 0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt20">
        	<tr>
			<th align="left" ><?php echo $this->Lang["S_NO"]; ?></span></th>
			<?php if(($this->uri->segment(2) != "view-auction") && ($this->uri->segment(2) != "view-user")){  ?>
			<th align="left" ><div class="arrow"><a href="<?php echo $this->sort_url;?>param=username&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_BY_NAME']; ?>" ><?php echo $this->Lang["USERS"]; ?></a></div></th>
			
			<th align="left" ><div class="arrow1"><a href="<?php echo $this->sort_url;?>param=title&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_B_DEAL_TIT']; ?>" ><?php echo $this->Lang['AUC_TIT2']; ?></a></div></th>
			
			<th align="left" ><div class="arrow3"><a href="<?php echo $this->sort_url;?>param=bidamount&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_B_BID_AMOU']; ?>" ><?php echo $this->Lang['BIDING_PRICE']; ?><?php echo '('.CURRENCY_SYMBOL.')';?></a></div></th>
			<th align="left" ><div class="arrow3"><a href="<?php echo $this->sort_url;?>param=shipping_fee&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="Sort By  Shipping Fee" >Shipping Fee<?php echo '('.CURRENCY_SYMBOL.')';?></a></div></th>
			<?php } else { ?>	
			<th align="left"> <?php echo $this->Lang["USERS"]; ?> </th> 			
			<th align="left"> <?php echo $this->Lang['AUC_TIT2']; ?> </th>
			<th align="left"> <?php echo $this->Lang['BIDING_PRICE']; ?><?php echo '('.CURRENCY_SYMBOL.')';?> </th>
			<th align="left"> <?php echo $this->Lang['SHIP_FEE']; ?><?php echo '('.CURRENCY_SYMBOL.')';?> </th>
			<?php } ?>
			<th align="left" > <?php echo $this->Lang['PAY_AMOUNT']; ?><?php echo '('.CURRENCY_SYMBOL.')';?> </th>	
			<?php if($this->uri->segment(2) != "view-user"){  ?>	
			<th align="left" ><?php echo $this->Lang["ADMIN_COMMISSION"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></th>
			<?php } ?>			
            <th align="left" ><?php echo $this->Lang["STATUS"]; ?></th>			
			<th align="left" ><?php echo $this->Lang["TRANS_DATE"]; ?></th>
			<? /* <th align="left" ><?php echo $this->Lang["TRANS_TYPE"]; ?></th> */ ?>
                </tr>
           <?php $i = 0;  if(($this->uri->segment(2) == "view-auction") || ($this->uri->segment(2) == "view-user")) {  $first_item = 1; } else {  $first_item = $this->pagination->current_first_item; }
                
            $tot_quan = count($this->transaction_auction_list); 
			$tot_amount = "";
			$tot_commission = "";
			$biding_amount = "";
			$shipping_amount = "";
			
			foreach($this->transaction_auction_list as $u){?>
                <tr> 
				<td align="left" > <?php echo $i+$first_item; ?> </td>
         	    <?php if($this->uri->segment(2) != "view-user"){  ?>
		    <td align="left"><span class="clor4"><a href="<?php echo PATH.'admin/view-user/'.$u->user_id;?>.html" title="<?php echo $u->firstname; ?>"><?php echo ucfirst(htmlspecialchars($u->firstname)); ?></a></span></td>
		    <?php } else { ?>
         	   
		    <td align="left"><?php echo ucfirst(htmlspecialchars($u->firstname)); ?></td>
		    <?php } ?>
		    <?php if($this->uri->segment(2) != "view-auction"){  ?>
		   
		   <td align="left"><a href="<?php echo PATH.'admin/view-auction/'.$u->deal_key.'/'.$u->deal_id.'.html';?>" title="<?php echo $u->deal_title; ?>"><?php echo $u->deal_title; ?></a></td>
		    <?php } else { ?>	
			<td align="left" > <?php echo htmlspecialchars($u->deal_title); ?> </td>
			<?php } ?>
		    <td align="center"><?php echo $u->bid_amount; ?></td>
		    <?php $biding_amount +=$u->bid_amount; ?> 
		   <td align="center"><?php echo $u->shipping_amount; ?></td>
		    <?php $shipping_amount +=$u->shipping_amount; ?>
		    <td align="center"><?php echo $u->amount; ?></td>
		    <?php if($this->uri->segment(2) != "view-user"){  ?>
		     <?php $commission_val=$u->deal_merchant_commission; ?> 
		    <?php  
		        $commission=$u->bid_amount *($commission_val/100);
		    ?>	   
		     
		    <td align="center"><span class="align"><?php echo ($commission); ?></span></td>
		       
		    
		    <?php $tot_commission += $commission; } ?> 	
		    <?php $tot_amount +=($u->bid_amount+$u->shipping_amount); ?>
		    <td ><span class="align">
		    <?php if($u->payment_status=="SuccessWithWarning"){ echo '<span class="clor">'. $this->Lang["SUCCESS"] .'</span>'; } ?>
		    <?php if($u->payment_status=="Completed"){ echo '<span class="clor3">'. $this->Lang["COMPLETED"] .'</span>'; } ?>
		    <?php if($u->payment_status=="Success"){ echo '<span class="clor">'. $this->Lang["SUCCESS"] .'</span>'; } ?>
		    <?php if($u->payment_status=="Pending"){ echo '<span class="clor4">'.$this->Lang["PENDING"].'</span>'; } ?>
		    <?php if($u->payment_status=="Failed"){ echo '<span class="clor5">'.$this->Lang["FAILED"].'</span>'; } ?>
		    
		    </span></td>
			
             <td align="left"><?php echo date('d-M-Y h:i:s A',$u->transaction_date); ?></td>
                    
              <? /*      <td ><span class="align">
		    <?php if($u->type=="1"){ echo '<span class="clor2">'. $this->Lang["PAYPAL_CREDIT"] .'</span>'; } ?>
		    <?php if($u->type=="2"){ echo '<span class="clor2">'. $this->Lang["PAYPAL"] .'</span>'; } ?>
		    <?php if($u->type=="3"){ echo '<span class="clor2">'. $this->Lang["REF_PAYMENT"] .'</span>'; } ?>
		    <?php if($u->type=="4"){ echo '<span class="clor2">'. "Authorize.net(".$u->transaction_type.")" .'</span>'; } ?>
		    </span></td> */ ?>
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
           <div class="value_amount"><p align="left"> <?php echo $this->Lang['TOTA_BID_CO']; ?></p> <b>:</b><span align="center"><?php echo $tot_quan; ?></span></div>
            <div class="value_amount"><p align="left"><?php echo $this->Lang["TOT_PURC_AMOUNT"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_amount; ?> </span></div>
            <?php if($this->user_type != 3){  ?>
             <div class="value_amount"><p align="left"><?php echo $this->Lang['TOTA_BID_PRICE']; ?> </p><b>:</b><span align="center"><?php echo CURRENCY_SYMBOL.$biding_amount; ?></span></div>
             <?php } ?>
            
             <div class="value_amount"><p align="left"><?php echo $this->Lang['TOTAL_SHIP_FEES']; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.($shipping_amount); ?> </span></div> 
             <?php if($this->uri->segment(2) != "view-user"){  ?>
           <div class="value_amount"><p align="left"><?php echo $this->Lang["TOT_ADM_COMM"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_commission; ?> </span></div>
           
           <div class="value_amount"><p align="left"><?php echo $this->Lang["TOT_MER_AMOU"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.($tot_amount-$tot_commission); ?> </span></div>
            <?php } ?>
           
             </th>       
             
            </div> 
           </fieldset>
            </table>
        </div>
  <?php } else{?><p class="nodata"><?php echo $this->Lang['NO_AU_PROD_FOUND']; ?></p><?php }?>
