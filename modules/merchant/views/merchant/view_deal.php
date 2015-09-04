<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'merchant.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
	
	
	 <div class="mergent_det2">
      <fieldset>
    		<legend><?php echo $this->template->title; ?></legend>

        <table class="list_table fl clr show_details_table">
            <?php foreach( $this->deal_deatils as $d){
		$symbol = CURRENCY_SYMBOL;
	     ?>
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["DEAL_TITLE"]; ?></th><th valign="top">:</th><td align="left"><?php echo htmlspecialchars($d->deal_title); ?></td>
                </tr>
                
               <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["TOP_CATEGORY"]; ?></th><th valign="top">:</th><td align="left"><?php foreach($this->category_list as $c){ if($c->category_id==$d->category_id){ echo ucfirst(htmlspecialchars($c->category_name)); } } ?></td>
                </tr>
					
		<tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["MAIN_CATEGORY"]; ?></th><th valign="top">:</th>
                         
                         <td align="left"><?php foreach($this->category_list as $c){ if($c->category_id==$d->sub_cat){ echo ucfirst(htmlspecialchars($c->category_name)); } } ?></td>
                         
                         
                </tr>
                
                
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["SUB_CATEGORY"]; ?></th><th valign="top">:</th>
                         
                         <td align="left"><?php foreach($this->category_list as $c){ if($c->category_id==$d->sec_cat){ echo ucfirst(htmlspecialchars($c->category_name)); } } ?></td>
                         
                         
                </tr>
                <?php if($d->third_category_id != "0"){ ?>
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["SUB_SEC_CATEGORY"]; ?></th><th valign="top">:</th>
                         <td align="left"><?php  foreach($this->category_list as $c){ if($c->category_id==$d->third_category_id){ echo ucfirst(htmlspecialchars($c->category_name)); }  } ?></td>
                </tr>
		<?php } ?>

                <tr>
                   <th valign="top" align="left"><?php echo $this->Lang["DEAL_DESCC"]; ?></th><th valign="top">:</th>
                   <td align="left">
                       <div class="manage_detail_des">
                              <?php echo nl2br($d->deal_description);?>
                       </div>
                   </td>
                </tr>
               
              <tr>
                        <th align="left" ><?php echo $this->Lang["DEAL_PRI"]; ?></th><th>:</th><td align="left"><?php echo $symbol." ".$d->deal_price; ?></td>
                </tr>
 		<tr>
                        <th align="left" ><?php echo $this->Lang["DISCOUNT_PRI"]; ?></th><th>:</th><td align="left"><?php echo $symbol." ".$d->deal_value; ?></td>
                </tr>
		<tr>
                        <th align="left" ><?php echo $this->Lang["DIS_PERCENT"]; ?></th><th>:</th><td align="left"><?php echo round($d->deal_percentage); ?>%</td>
                </tr> 	
                <tr>
                        <th align="left"><?php echo $this->Lang["SAVINGS"]; ?></th><th>:</th><td align="left"><?php echo $symbol." ".$d->deal_savings; ?></td>
                </tr>
                
                <tr>
                        <th align="left" ><?php echo $this->Lang["START_DATE"]; ?></th><th>:</th><td align="left"><?php echo date('m/d/Y H:i:s', $d->startdate); ?></td>
                </tr>
                <tr>
                        <th align="left" ><?php echo $this->Lang["END_DATE"]; ?></th><th>:</th><td align="left"><?php echo date('m/d/Y H:i:s', $d->enddate); ?></td>
                </tr>
                <tr>
                        <th align="left" ><?php echo $this->Lang["EXPIRY"]; ?></th><th>:</th><td align="left"><?php echo date('m/d/Y H:i:s', $d->expirydate); }?></td>
                </tr>
		<tr>
                        <th align="left"><?php echo $this->Lang["MIN_USER_LIMIT"]; ?></th><th>:</th><td align="left"><?php echo $d->minimum_deals_limit; ?></td>
                </tr>
		<tr>
                        <th align="left"><?php echo $this->Lang["MAX_USER_LIMIT"]; ?></th><th>:</th><td align="left"><?php echo $d->maximum_deals_limit; ?></td>
                </tr>
		<tr>
                        <th align="left"><?php echo $this->Lang["USER_LIMIT_QUAN"]; ?></th><th>:</th><td align="left"><?php echo $d->user_limit_quantity; ?></td>
                </tr>
		<tr>
                        <th align="left"><?php echo $this->Lang["PURCHACE_COUNT"]; ?></th><th>:</th><td align="left"><?php echo $d->purchase_count; ?></td>
                </tr>
		<tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["MERCHANT_NAME"]; ?></th><th valign="top">:</th><td align="left"><?php echo htmlspecialchars($d->firstname); ?></td>
                </tr>
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["COUNTRY"]; ?></th><th valign="top">:</th><td align="left"><?php echo htmlspecialchars($d->country_name); ?></td>
                </tr>
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["CITY"]; ?></th><th valign="top">:</th><td align="left"><?php echo htmlspecialchars($d->city_name); ?></td>
                </tr>
                 <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["SHOP_NAME"]; ?></th><th valign="top">:</th><td align="left"><?php echo htmlspecialchars($d->store_name); ?></td>
                </tr>
                <tr>
                <th valign="top" align="left" ><?php echo $this->Lang["DEAL_IMG"]; ?></th><th valign="top">:</th>
                <?php $con=0; 
                        for($i=1; $i<=5; $i++){ 
                                if(file_exists(DOCROOT.'images/deals/1000_800/'.$d->deal_key.'_'.$i.'.png')) { 
                                        $con=$con+1; 
                                } 
                } ?>
                <?php  if(file_exists(DOCROOT.'images/deals/1000_800/'.$d->deal_key.'_1'.'.png'))  { ?>
                
                <td align="left">
                <?php for($i=1; $i<=5; $i++){ 
                                if(file_exists(DOCROOT.'images/deals/1000_800/'.$d->deal_key.'_'.$i.'.png')) {  ?>
                        <img border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'images/deals/1000_800/'.$d->deal_key.'_'.$i.'.png';?>&w=100&h=100" alt="" />
                <?php } } ?>
                </td>
                
                <?php } else { ?>
                
                <td><img border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'/images/no-images.png';?>&w=100&h=100" alt="" /></td>
                
                <?php } ?>                            
                </tr>  
			</table>
			</fieldset>
			</div>
			
			 <div class="mergent_det2">
      <fieldset>
    		<legend><?php echo $this->Lang['TRANS_DET']; ?></legend>
        <table class="list_table fl clr show_details_table">
               
                 <tr>
                 <td colspan="3">
                        <?php echo new View("merchant/transaction_list"); ?>      
                 </td>
                 </tr>  
				 
				 </table>
				 </fieldset>
				 </div>
                <tr><td colspan="3"><a href="javascript:history.back();" class="back_btn search_cancel"><?php echo $this->Lang["BACK"]; ?></a></td></tr> 
        </table>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
