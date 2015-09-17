<?php defined('SYSPATH') OR die("No direct access allowed."); ?>
<?php  if(($this->uri->segment(2)=='view-deal')){	
								
		 if(count($this->cod_transaction_list) > 0){ ?>

		<a class="fr" style="float:right;text-decoration: underline; cursor: pointer;position:relative; z-index:2;" href="<?php echo PATH.'admin/view-deal/'.$this->deal_key.'/'.$this->deal_id.'.html?id='.$this->Lang['CO_D'];  ?>" title="<?php echo $this->Lang['EXP_DL']; ?>"><img src="<?php echo PATH ?>images/csv.png" class="image" alt="<?php echo $this->Lang['EXP_DL']; ?>"/></a>

		<?php } } ?>
<?php if(count($this->cod_transaction_list) > 0){ ?>
        <div class="table_over_flow">
        <table class="list_table fl clr mt20">
        	<tr>
			<th align="left" ><?php echo $this->Lang["S_NO"]; ?></span></th>
			<?php if(($this->uri->segment(2) != "view-deal")&&($this->uri->segment(2) != "view-products") && ($this->uri->segment(2) != "view-user")){  ?>
			<th align="left" ><div class="arrow"><a href="<?php echo $this->sort_url;?>param=username&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_BY_NAME']; ?>" ><?php echo $this->Lang["USERS"]; ?></a></div></th>
			
			<th align="left" ><div class="arrow1"><a href="<?php echo $this->sort_url;?>param=title&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_B_DEAL_TIT']; ?>" ><?php echo $this->Lang["DEAL_TITLE"]; ?></a></div></span></th>
			
			<th align="left" ><div class="arrow3"><a href="<?php echo $this->sort_url;?>param=quantity&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_B_QUAN']; ?>" ><?php echo $this->Lang["QUAN"]; ?></a></div></th>
			<th align="left" ><div class="arrow3"><a href="<?php echo $this->sort_url;?>param=amount&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="<?php echo $this->Lang['SORT_B_AMOUNT']; ?>" ><?php echo $this->Lang["AMOUNT"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></a></div></th>
			<?php if($this->user_type != 3){  ?>
				
			<?php /** <th align="left" ><div class="arrow3"><a href="<?php echo $this->sort_url;?>param=refamount&sort=<?php if($this->input->get('sort')=='DESC'){ echo 'ASC'; }else{ echo 'DESC'; } ?>" title="Sort By  Refferal amount" ><?php echo $this->Lang["REF_AMM"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></a></div></th> **/?>
					
				<?php }  } else { ?>
			<th align="lefft" > <?php echo $this->Lang['USERS']; ?> </th>
			<th align="lefft" > <?php echo $this->Lang["DEAL_TITLE"]; ?> </th>
			<th align="lefft" > <?php echo $this->Lang["QUAN"]; ?> </th>
			<th align="lefft" > <?php echo $this->Lang["AMOUNT"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?> </th>

			<?php if($this->user_type != 3){  ?>
			<?php /**<th align="lefft" > <?php echo $this->Lang["REF_AMM"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?> </th> **/ ?>

				<?php  } }  ?>
			
			<?php if($this->uri->segment(2) != "view-user"){  ?>	
			<th align="left" ><?php echo $this->Lang["ADMIN_COMMISSION"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></th>
			<?php } ?>
			<?php if(($this->uri->segment(2) == "view-deal")&&($this->uri->segment(2) == "view-products")){  ?>	
			<th align="left" ><?php echo $this->Lang["TRANS_ID"]; ?></span></th>
			<?php } ?>
			<?php if(($this->uri->segment(2) == "view-deal")||($this->uri->segment(2) == "view-products")||($this->uri->last_segment() == "all-transaction.html")||($this->uri->segment(2) == "view-user")||($this->uri->segment(2) == "all-transaction")){  ?>			
			<th align="left" ><?php echo $this->Lang["STATUS"]; ?></th> 
			<?php } ?>
			<th align="left" width="12%"><?php echo $this->Lang["TRANS_DATE"]; ?></th>
			<?php /*<th align="left" ><?php echo $this->Lang["TRANS_TYPE"]; ?></th> */ ?>
                </tr>
                
                
                
                <?php $i = 0;  if(($this->uri->segment(2) == "view-deal") ||($this->uri->segment(2) == "view-products")||($this->uri->segment(2) == "view-user")) {  $first_item = 1; } else { $first_item = $this->pagination->current_first_item; }
                
                        $tot_quan = ""; 
			$tot_amount = "";
			$tot_commission = "";
			$tot_reff = "";
			
			foreach($this->cod_transaction_list as $u){?>
                <tr> 
         	    <td align="center"><?php echo $i+$first_item; ?></span></td>	
         	    <?php if($this->uri->segment(2) != "view-user"){  ?>
		    <td align="left"><span class="clor4"><a href="<?php echo PATH.'admin/view-user/'.$u->user_id;?>.html" title="<?php echo $u->firstname; ?>"><?php echo htmlspecialchars($u->firstname); ?></a></span></td>
		    <?php } else { ?>
		    <td align="left" > <?php echo ucfirst(htmlspecialchars($u->firstname)); ?> </td>
			<?php } ?>
		    
		    <?php if(($this->uri->segment(2) != "view-deal") && ($this->uri->segment(2) != "view-products")){  ?>
		  
		   <td align="left"><a href="<?php echo PATH.'admin/view-deal/'.$u->deal_key.'/'.$u->deal_id.'.html';?>" title="<?php echo $u->deal_title; ?>">
		    <?php echo htmlspecialchars($u->deal_title); ?></a></td>
		    
		    <?php } else { ?>	
			<td align="left" > <?php echo htmlspecialchars($u->deal_title); ?> </td>
			<?php } ?>
		    <td align="center"><?php echo $u->quantity; ?></td>
		    
		    <?php $tot_quan +=$u->quantity; ?>
		    
		    <?php if($this->uri->segment(2) == "view-user"){  ?>
		    <td align="center"><span class="align"><?php echo ($u->deal_value*$u->quantity); ?></span></td>
		    <?php $tot_amount +=$u->deal_value*$u->quantity; ?>
		    <?php } ?>
		    
		    <?php if($this->uri->segment(2) != "view-user"){  ?>
		     <?php $commission_val=$u->deal_merchant_commission; ?> 
		    <?php  
		        $commission=$u->deal_value *($commission_val/100);
		        
		    ?>	   
		     
		    <td align="center"><span class="align"><?php echo ($u->deal_value-$commission)*$u->quantity; ?></span></td>
		    <?php $tot_amount +=($u->deal_value)*$u->quantity; ?>
		    
		    <?php } ?> 	
		   <?php if($this->user_type != 3){  ?>
		   <?php /** <td align="center"><span class="align"><?php echo $u->referral_amount; ?></span></td> **/?>
		    <?php $tot_reff +=$u->referral_amount; ?>	
		    <?php } ?>	
		    
		   <?php if($this->uri->segment(2) != "view-user"){  ?>
		    <td align="center"><span class="align"><?php echo $commission*$u->quantity; ?></span></td>  
		    <?php $tot_commission +=$commission*$u->quantity; ?>
		    <?php } ?> 	
		    <?php if(($this->uri->segment(2) == "view-deal")&&($this->uri->segment(2) == "view-products")){  ?>	
		    <td ><span class="align"><?php echo $u->transaction_id; ?></span></td>
		   <?php }?>
		    <?php if(($this->uri->segment(2) == "view-deal")||($this->uri->segment(2) == "view-products")||($this->uri->last_segment() == "all-transaction.html")||($this->uri->segment(2) == "view-user")||($this->uri->segment(2) == "all-transaction")){  ?>
		    <td ><span class="align">
		    <?php if($u->payment_status=="SuccessWithWarning"){ echo '<span class="clor">'. $this->Lang["SUCCESS"] .'</span>'; } ?>
		    <?php if($u->payment_status=="Completed"){ echo '<span class="clor3">'. $this->Lang["COMPLETED"] .'</span>'; } ?>
		    <?php if($u->payment_status=="Success"){ echo '<span class="clor">'. $this->Lang["SUCCESS"] .'</span>'; } ?>
		    <?php if($u->payment_status=="Pending"){ echo '<span class="clor4">'.$this->Lang["PENDING"].'</span>'; } ?>
		    <?php if($u->payment_status=="Failed"){ echo '<span class="clor5">'.$this->Lang["FAILED"].'</span>'; } ?>
		    
		    </span></td>
		    <?php } ?>	

			
                    <td align="left"><?php echo date('d-M-Y h:i:s A',$u->transaction_date); ?></td>
                    
                 <?php /*   <td ><span class="align">
		    <?php if($u->type=="1"){ echo '<span class="clor2">'. $this->Lang["PAYPAL_CREDIT"] .'</span>'; } ?>
		    <?php if($u->type=="2"){ echo '<span class="clor2">'. $this->Lang["PAYPAL"] .'</span>'; } ?>
		    <?php if($u->type=="3"){ echo '<span class="clor2">'. $this->Lang["REF_PAYMENT"] .'</span>'; } ?>
		    <?php if($u->type=="4"){ echo '<span class="clor2">'. $this->Lang["AUTHORIZE"].'('.$u->transaction_type.')' .'</span>'; } ?>
			<?php if($u->type =="5"){ echo '<span class="clor2">'. $this->Lang["CASH_ON_DEL"] .'</span>'; } ?>
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
           
           <div class="value_amount"><p align="left"> <?php echo $this->Lang["TOT_PURC_QUAN"]; ?> </p> <b>:</b><span align="center"><?php echo $tot_quan; ?></span></div>
            <div class="value_amount"><p align="left"><?php echo $this->Lang["TOT_PURC_AMOUNT"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_amount; ?> </span></div>
            <?php if($this->user_type != 3){  ?>
             <div class="value_amount"><p align="left"><?php echo $this->Lang["TOT_REF_AMO_USE"]; ?>  </p><b>:</b><span align="center"><?php echo CURRENCY_SYMBOL.$tot_reff; ?></span></div>
             <?php } ?>
            
             <div class="value_amount"><p align="left"><?php echo $this->Lang["TOT_ONL_PAY_USE"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.($tot_amount-$tot_reff); ?> </span></div> 
             <?php if($this->uri->segment(2) != "view-user"){  ?>
           <div class="value_amount"><p align="left"><?php echo $this->Lang["TOT_ADM_COMM"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.$tot_commission; ?> </span></div>
           
           <div class="value_amount"><p align="left"><?php echo $this->Lang["TOT_MER_AMOU"]; ?> </p><b>:</b><span align="center"> <?php echo CURRENCY_SYMBOL.($tot_amount-$tot_commission); ?> </span></div>
            <?php } ?>
             </th>       
             
            </div> 
           </fieldset>
            </table>
        </div>
  <?php } else{?><p class="nodata"><?php echo $this->Lang['NO_COD_T_FOUND']; ?></p><?php }?>
