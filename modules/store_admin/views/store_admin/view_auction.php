<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'store-admin.html'; ?>" title="<?php echo $this->Lang["HOME"]; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    <div class="mergent_det">
    <fieldset>
    <legend><?php echo $this->Lang['AUC_PRO_DETAILS']; ?></legend>
        <table class="list_table fl clr show_details_table">
            <?php foreach($this->deal_deatils as $d){
				$symbol = CURRENCY_SYMBOL;
		
			?>
  	
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["DEAL_TITLE"]; ?></th><th valign="top">:</th><td align="left"><?php echo ucfirst(htmlspecialchars($d->deal_title)); ?></td>
                </tr>

                
                 <tr>
          <th valign="top" align="left" width="20%"><?php echo $this->Lang["TOP_CATEGORY"]; ?></th>
          <th valign="top">:</th>
          <td align="left"><?php echo ucfirst(htmlspecialchars($d->category_name)); ?></td>
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
                        <th align="left" ><?php echo $this->Lang['AUC_PRICE']; ?></th><th>:</th><td align="left"><?php echo $symbol." ".$d->deal_value; ?></td>
                </tr>
			
                <tr>
                        <th align="left"><?php echo $this->Lang['BID_INCR']; ?></th><th>:</th><td align="left"><?php echo $symbol." ".$d->bid_increment; ?></td>
                </tr>
                
                <tr>
                        <th align="left"><?php echo $this->Lang['BID_COUNT']; ?></th><th>:</th><td align="left"><?php echo $d->bid_count; ?></td>
                </tr>
                
                <tr>
                        <th align="left"><?php echo $this->Lang['CU_BID_IN']; ?></th><th>:</th><td align="left"><?php echo $symbol." ".$d->bid_increment; ?></td>
                </tr>

                <tr>
                        <th align="left"><?php echo $this->Lang['SHIP_FEE']; ?></th><th>:</th><td align="left"><?php echo $symbol." ".$d->shipping_fee; ?></td>
                </tr>
                
                <tr>
                        <th align="left">Shipping Information</th><th>:</th><td align="left"><?php echo $d->shipping_info; ?></td>
                </tr>
                
                <tr>
                        <th align="left" ><?php echo $this->Lang["START_DATE"]; ?></th><th>:</th><td align="left"><?php echo date('m/d/Y H:i:s', $d->startdate); ?></td>
                </tr>

                <tr>
                        <th align="left" ><?php echo $this->Lang["END_DATE"]; ?></th><th>:</th><td align="left"><?php echo date('m/d/Y H:i:s', $d->enddate); ?></td>
                </tr>

       
		<tr>
                        <th align="left"><?php echo $this->Lang["USER_LIMIT_QUAN"]; ?></th><th>:</th><td align="left"><?php echo $d->user_limit_quantity; ?></td>
                </tr>


		<tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["MERCHANT_NAME"]; ?></th><th valign="top">:</th><td align="left"><?php echo ucfirst(htmlspecialchars($d->firstname)); ?></td>
                </tr>

                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["COUNTRY"]; ?></th><th valign="top">:</th><td align="left"><?php echo ucfirst(htmlspecialchars($d->country_name)); ?></td>
                </tr>

                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["CITY"]; ?></th><th valign="top">:</th><td align="left"><?php echo ucfirst(htmlspecialchars($d->city_name)); ?></td>
                </tr>

                 <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["SHOP_NAME"]; ?></th><th valign="top">:</th><td align="left"><?php echo ucfirst(htmlspecialchars($d->store_name)); ?></td>
                 </tr>

                <tr>
                <th valign="top" align="left" ><?php echo $this->Lang["DEAL_IMG"]; ?></th><th valign="top">:</th>
                <?php $con=0; 
                        for($i=1; $i<=5; $i++){ 
                                if(file_exists(DOCROOT.'images/auction/1000_800/'.$d->deal_key.'_'.$i.'.png')) { 
                                        $con=$con+1; 
                                } 
                } ?>
                <?php  if(file_exists(DOCROOT.'images/auction/1000_800/'.$d->deal_key.'_1'.'.png'))  { ?>
                
                <td align="left">
                <?php for($i=1; $i<=5; $i++){ 
                                if(file_exists(DOCROOT.'images/auction/1000_800/'.$d->deal_key.'_'.$i.'.png')) {  ?>
                  <img border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'images/auction/1000_800/'.$d->deal_key.'_'.$i.'.png';?>&w=100&h=100" alt="" />      
              
                <?php } } ?>
                </td>
                
                <?php } else { ?>
                
                <td><img border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="100" /></td>
                
                <?php } }?>                            
                </tr>  
                </table>
                </fieldset>
                </div>
                
                <div class="mergent_det2">
					<fieldset>
		 <legend > <?php echo $this->Lang['BIDING_DEA']; ?></legend>
					<?php  if(($this->uri->segment(2)=='view-auction')){	
		 if(count($this->bidding_list) > 0){ ?>
		<a class="fr" style="float:right;text-decoration: underline; cursor: pointer;position:relative; z-index:2;" href="<?php echo PATH.'store-admin/view-auction/'.$this->auction_key.'/'.$this->auction_id.'.html?id='.$this->Lang['SEARCH'];  ?>" title="<?php echo $this->Lang['EXPO_BIDD_LI']; ?>"><img src="<?php echo PATH ?>images/csv.png" class="image" alt="<?php echo $this->Lang['EXPO_BIDD_LI']; ?>"/></a>
		<?php } } ?>
      
		  
			 <?php if($this->uri->segment(2) != "view-user"){ 
			if(count($this->bidding_list) > 0){ ?>
                <div class="table_over_flow">
        <table class="list_table fl clr mt20">
        	<tr>
				<th align="left" width="5"><?php echo $this->Lang['S_NO']; ?></th>
				<th align="left" width="20%"><?php echo $this->Lang['AUCTION_NAME']; ?></th>
				<th align="left" width="12%"><?php echo $this->Lang['USER_NAME']; ?></th>			
				<th align="left" width="15%"><?php echo $this->Lang['STAR_BID']; ?> <?php echo '('.CURRENCY_SYMBOL.')';?></th>
				<th align="left" width="15%"><?php echo $this->Lang['BID_AMO']; ?> <?php echo '('.CURRENCY_SYMBOL.')';?></th>
				<th align="left" width="15%"><?php echo $this->Lang['BID_TIME']; ?></th> 
			
            </tr>
            
            <?php $i=1; 
			
			foreach($this->bidding_list as $u){ 
				?>
                <tr>    
                        <td align="left"><?php echo $i; ?></td>
                        <td align="left"><?php echo $u->deal_title; ?> </td>
						<td align="left"><?php echo $u->firstname; ?></td>
                        <td align="left"><?php echo $u->deal_value; ?></td>
                        <td align="left"><?php echo $u->bid_amount; ?></td>
                        <td align="left"><?php echo date('m/d/Y H:i:s', $u->end_time); ?></td>
				</tr>
				<?php if($this->highest_bid[0]->bid_id == $u->bid_id) { ?>
						<?php if($u->winner!=0) { ?>
				<div class="value_total_in_bid">
           <div class="value_amount"><p align="left"><?php echo $this->Lang['WINNERS3']; ?> </p><b>:</b><span align="center" class="blink" > <?php echo  ucfirst($u->firstname); ?> </span></div>
           
           <div class="value_amount"><p align="left"><?php echo $this->Lang['AMOUNT']; ?> </p><b>:</b><span align="center" class="blink" > <?php echo  CURRENCY_SYMBOL.($u->bid_amount); ?> </span></div></div>
					<?php } else { ?>
					<div class="value_total_in_bid">
           <div class="value_amount"><p align="left"><?php echo $this->Lang['HIGH_BID']; ?> </p><b>:</b><span align="center" class="blink" > <?php echo  ucfirst($u->firstname); ?> </span></div>
           
           <div class="value_amount"><p align="left"><?php echo $this->Lang['HIGH_BIDD_AM']; ?> </p><b>:</b><span align="center" class="blink" > <?php echo  CURRENCY_SYMBOL.($u->bid_amount); ?> </span></div></div>
				<?php } ?>
			<?php } ?>
			<?php $i++; }  ?>

			</table>
                </div>
		<?php } else{ ?> <p class="nodata"><?php echo $this->Lang['NO_AU_BID_INFOR']; ?></p> <?php  }  } ?>
</fieldset>
</div>
<div class="mergent_det2">
					<fieldset>
      <legend> <?php echo $this->Lang['TRANS_DET']; ?></legend>
               <table> 
                <tr> 
                <td colspan="3"> <?php echo new View("store_admin/biding_transaction_list"); ?></td>
                </tr> 
      
               
        </table>
        </fieldset>
        </div>
        <a href="javascript:history.back();" class="back_btn search_cancel"><?php echo $this->Lang["BACK"]; ?></a>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>



