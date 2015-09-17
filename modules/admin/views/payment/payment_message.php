<?php defined('SYSPATH') OR die("No direct access allowed."); ?>

<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a>
<?php if(isset($s->title)){?>
<a href="<?php echo PATH.$this->url; ?>" title="<?php echo $this->template->title; ?>">&nbsp;<?php echo $this->template->title; ?>&nbsp;<span class="fwn">&#155;&#155;</span>
<?php } else{ ?>
<p><?php echo $this->template->title; ?></p>
<?php } ?></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
      <?php if(count($this->users_details_amount) > 0){ ?>
        
                <?php foreach($this->users_details_amount as $user_fund) { ?>
                <div class="mergent_det">
                 <fieldset>
                 
                        <legend><?php echo $this->Lang['MERCHANT_FUND_DET']; ?></legend>
                        <table class="list_table fl clr show_details_table">
                    <tr>    
        	        <th valign="top" align="left" width="20%"><?php echo $this->Lang["MERCHANT_NAME"]; ?>  :</th><td align="left"><?php echo ucfirst($user_fund->firstname); ?></td>
        	   </tr>
        	   <tr>     
        	        
        	        <th valign="top" align="left" width="20%"><?php echo $this->Lang["MERCHANT_EMAIL"]; ?>  :</th><td align="left">
        	        <?php echo $user_fund->email; ?></td>   
        	   </tr>
        	   
        	   <tr>     
        	        
        	        <th valign="top" align="left" width="20%"><?php echo $this->Lang["MERCHANT_PAY_EMAIL"]; ?>  :</th><td align="left">
        	        <?php echo $user_fund->payment_account_id; ?></td>   
        	   </tr> 
        	   
        	   <tr>     
        	        
        	        <th valign="top" align="left" width="20%"><?php echo $this->Lang["MERCHANT_REQ_AMOUNT"]; ?>  :</th><td align="left">
        	        <?php echo CURRENCY_SYMBOL.$user_fund->amount; ?></td>   
        	   </tr>
        	   </table>
        	   </fieldset>
        	   </div>
        	   
        	   
        	   <div class="mergent_det2">
                 <fieldset> 
                <legend><?php echo $this->Lang['PAY_TRANS_DET']; ?></legend>
                <table class="list_table fl clr show_details_table">
        	   <tr>     
        	        
        	        <th valign="top" align="left" width="20%"><?php echo $this->Lang["PAY_TRANS_DATE"]; ?>  :</th><td align="left">
        	        <?php echo date('m/d/Y H:i:s', $user_fund->transaction_date); ?></td>   
        	   </tr>
        	   
        	   <tr>     
        	        
        	        <th valign="top" align="left" width="20%"><?php echo $this->Lang["PAY_TRANS_ID"]; ?>  :</th><td align="left">
        	        <?php echo $user_fund->transaction_id; ?></td>   
        	   </tr>
        	   
        	   <tr>     
        	        
        	        <th valign="top" align="left" width="20%"><?php echo $this->Lang["PAY_ERR_CODE"]; ?>  :</th><td align="left">
        	        <?php echo $user_fund->error_code; ?></td>   
        	   </tr>
        	   
        	   <tr>     
        	        
        	        <th valign="top" align="left" width="20%"><?php echo $this->Lang["PAY_ERR_TITLE"]; ?>  :</th><td align="left">
        	        <?php echo $user_fund->error_title; ?></td>   
        	   </tr> 
        	   
        	   <tr>     
        	        
        	        <th valign="top" align="left" width="20%"><?php echo $this->Lang["PAY_ERR_MSG"]; ?>  :</th><td align="left">
        	        <?php echo $user_fund->error_message; ?></td>   
        	   </tr>  
        	   
        	   <tr>     
        	        <th valign="top" align="left" width="20%"><?php echo $this->Lang["PAY_STATUS"]; ?>  :</th><td align="left">
        	                <?php if($user_fund->payment_status == 2){?>
                                        <select  onchange="return updatefundrequest_status('<?php echo $user_fund->request_id; ?>','<?php echo $user_fund->user_id; ?>',this.value)">
                                        <option value=""><?php echo $this->Lang["FAILURE"]; ?></option>
                                        <option  value="2"><?php echo $this->Lang["APPROVED"]; ?></option>
                                        <option value="3" ><?php echo $this->Lang["REJECTED"]; ?></option>
                                        </select>
                                <?php } ?>  
        	        </td>   
        	   </tr>  
        	   </table>
        	   </fieldset>
        	   </div>      
        	
        	<?php } ?>
        
        <?php } else{?><p class="nodata"><?php echo $this->Lang["NO_DATA"]; ?></p><?php }?>

          
    </div>
     <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
