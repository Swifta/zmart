<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang["HOME"]; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    <div class="mergent_det">
    <fieldset>
    <legend><?php echo $this->Lang['AUC_PRO_DETAILS']; ?></legend>
        <table class="list_table fl clr show_details_table">
            <?php foreach( $this->deal_deatils as $d){	$symbol = CURRENCY_SYMBOL;      ?>
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang['AUC_TIT']; ?></th><th valign="top">:</th><td align="left"><?php echo ucfirst(htmlspecialchars($d->deal_title)); ?></td>
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
                   <th valign="top" align="left"><?php echo $this->Lang['AUCT_DESC']; ?></th><th valign="top">:</th>
                   <td align="left">
                       <div class="manage_detail_des">
                        <?php echo nl2br($d->deal_description);?>
                       </div>
                   </td>
                </tr>
              
 		<tr>
                   <th align="left" ><?php echo $this->Lang['AUCT_ORI_PRIC']; ?></th><th>:</th><td align="left"><?php echo $symbol." ".$d->product_value; ?></td>
                </tr>
                
                   <th align="left" ><?php echo $this->Lang['AUC_PRICE']; ?></th><th>:</th><td align="left"><?php echo $symbol." ".$d->deal_value; ?></td>
                </tr>
			
                <tr>
                        <th align="left"><?php echo $this->Lang['BID_INCR']; ?></th><th>:</th><td align="left"><?php echo $symbol." ".$d->bid_increment; ?></td>
                </tr>
                
                <tr>
                        <th align="left"><?php echo $this->Lang['BID_COUNT']; ?></th><th>:</th><td align="left"><?php echo $d->bid_count; ?></td>
                </tr>

                <tr>
                        <th align="left"><?php echo $this->Lang['SHIP_FEE']; ?></th><th>:</th><td align="left"><?php echo $symbol." ".$d->shipping_fee; ?></td>
                </tr>
                
                <tr>
                        <th align="left"><?php echo $this->Lang['SHIPP_INFO2']; ?></th><th>:</th><td align="left"><?php echo $d->shipping_info; ?></td>
                </tr>
                
                <tr>
                        <th align="left" ><?php echo $this->Lang["START_DATE"]; ?></th><th>:</th><td align="left"><?php echo date("d-M-Y h:i:s A", $d->startdate); ?></td>
                </tr>

                <tr>
                        <th align="left" ><?php echo $this->Lang["END_DATE"]; ?></th><th>:</th><td align="left"><?php echo date("d-M-Y h:i:s A", $d->enddate); ?></td>
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
                <th valign="top" align="left" ><?php echo $this->Lang['AUC_IM']; ?></th><th valign="top">:</th>
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
                 <?php /* <img border="0" src= "<?php echo PATH.'images/auction/466_347/'.$d->deal_key.'_'.$i.'.png';?>" alt="" width="100" /> */ ?>
                <?php } } ?>
                </td>
                
                <?php } else { ?>
                
                <td>
<img border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'/images/no-images.png';?>&w=100&h=100" alt="" />
</td>
                
                <?php } ?>                            
                </tr>  
                </table>
                </fieldset>
                </div>
               <?php if(ADMIN_PRIVILEGES_TRANSACTIONS){?> 
                <div class="mergent_det2">
	
      <fieldset>
		 <legend > <?php echo $this->Lang['BIDING_DEA']; ?></legend>
      				
<?php  if(($this->uri->segment(2)=='view-auction')){	
		 if(count($this->bidding_list) > 0){ ?>
		<a class="fr" style="float:right;text-decoration: underline; cursor: pointer;position:relative; z-index:2;" href="<?php echo PATH.'admin/view-auction/'.$this->auction_key.'/'.$this->auction_id.'.html?id='.$this->Lang['SEARCH'];  ?>" title="<?php echo $this->Lang['EXPO_BIDD_LI']; ?>"><img src="<?php echo PATH ?>images/csv.png" class="image" alt="<?php echo $this->Lang['EXPO_BIDD_LI']; ?>"/></a>
		<?php } } ?>
     			<?php if($this->uri->segment(2) != "view-user"){ 
			if(count($this->bidding_list) > 0){ ?>
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
                        <td align="left"><?php echo date("d-M-Y h:i:s A", $u->bidding_time); ?></td>
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
		<?php } else{ ?> <p class="nodata"><?php echo $this->Lang['NO_AU_BID_INFOR']; ?></p> <?php  } }  ?>
		</fieldset>
	</div>
	<div class="mergent_det2">
		<fieldset> 
<legend> <?php echo $this->Lang['TRANS_DET']; ?></legend>
               <table> 
                <tr> 
                <td colspan="3"> <?php echo new View("payment/biding_transaction_list"); ?><p class="nodata"> </p></td>
                </tr>  
        </table>
        </fieldset>
        </div>
        <?php }?>
         <?php if(count($this->transaction_auction_list) > 0){ ?>
        <?php foreach($this->transaction_auction_list as $new){ if($new->type=="5"){  ?>
        <div class="mergent_det2">
      <fieldset>
      <legend><?php echo $this->Lang["COMMISSION_COD_STATUS"]; ?> </legend>
            <form action="" method="post" class="admin_form" enctype="multipart/form-data" id="addFormId">
      <table class="list_table fl clr show_details_table">

       <div class="mergent_det2 user_date">
       <?php if($d->commission_status == 1) { ?>
        <tr>
            <td></td>
            <td></td>
            <input type="hidden" name="commission_status" value="2" />
            <input type="hidden" name="commission_deal_key" value="<?php echo $d->deal_key; ?>" />
            <input type="hidden" name="commission_deal_id" value="<?php echo $d->deal_id; ?>" />
            <td><input type="submit" value="<?php echo $this->Lang['CLICK_CHANGE_STATUS']; ?>"  /></td>
        </tr>
        <?php } else { ?>
                <div class="clearfix"><p class="comission_collection"><?php echo $this->Lang["COMMISSION_COLLECT_STATUS"]; ?> </p></div>
                
                <p> </p>
        <?php } ?>
        </div>

        </table>
        </form>		
	</fieldset>
          </div>
          <?php } ?>
         <?php } ?>
         <?php } ?>
         
        <?php } ?>
        <a href="javascript:history.back();" class="back_btn"><?php echo $this->Lang["BACK"]; ?></a>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>



