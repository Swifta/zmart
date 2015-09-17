<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a>
  <p><?php echo $this->template->title; ?></p>
</div>
<div class="cont_container mt15 mt10">
  <div class="content_top">
    <div class="top_left"></div>
    <div class="top_center"></div>
    <div class="top_rgt"></div>
  </div>
  <div class="content_middle">
    <div class="mergent_det">
	
      <fieldset><legend><?php echo $this->template->title; ?></legend>
      <table class="list_table fl clr show_details_table">
        <?php foreach( $this->product_deatils as $d){
				$symbol = CURRENCY_SYMBOL;
				
			
			?>
        <tr>
          <th valign="top" align="left" width="20%"><?php echo $this->Lang["PRODUCT_TITLE"]; ?></th>
          <th valign="top">:</th>
          <td align="left"><?php echo ucfirst(htmlspecialchars($d->deal_title)); ?></td>
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
          <th valign="top" align="left"><?php echo $this->Lang["PRODUCT_DESCC"]; ?></th>
          <th valign="top">:</th>
          <td align="left">
              <div class="manage_detail_des">
                  <?php echo nl2br($d->deal_description);?>
              </div>
          </td>
        </tr>
        <tr>
          <th align="left" ><?php echo $this->Lang["DISCOUNT_PRI"]; ?></th>
          <th>:</th>
           <td align="left"><?php if($d->deal_price!=0){ echo $symbol." ".$d->deal_price; } else { echo $symbol." ".$d->deal_value; } ?></td>
        </tr>
          <?php if($d->deal_price!=0){?>
        <tr>
          <th align="left" ><?php echo $this->Lang["PRODUCT_PRI"]; ?></th>
          <th>:</th>
          <td align="left"><?php echo $symbol." ".$d->deal_value; ?></td>
        </tr>
        <?php }?>
        <tr>
          <th align="left"><?php echo $this->Lang["SAVINGS"]; ?></th>
          <th>:</th>
          <td align="left"><?php echo $symbol." ".$d->deal_savings; ?></td>
        </tr>
        <tr>
          <th align="left" ><?php echo $this->Lang["PRODUCT_PERCENT"]; ?></th>
          <th>:</th>
          <td align="left"><?php echo round($d->deal_percentage); ?>%</td>
        </tr>
        
        <?php if($d->shipping == 1){ 
        $ship_dispay = $this->Lang['FREE_SHIPP_PROD'];
        } ?>                                                                
        <?php if($d->shipping == 2){ 
        $ship_dispay = $this->Lang['FLAT_SHIPP_T_PRO'];
        } ?>                                                                
        <?php if($d->shipping == 3){ 
        $ship_dispay = $this->Lang['PER_PRO_SHIPP_PRODUCT_SHIPP'];
        } ?>                                                                
        <?php if($d->shipping == 4){ 
        $ship_dispay = $this->Lang['PER_ITEM_PRODU_SHIPPING_AMOU'];
        } ?>
        <?php if($d->shipping == 5){ 
        $ship_dispay = $this->Lang['ARAMEX_SHIPP_PROD'];

        } ?>
        <tr>
          <th align="left" ><?php echo $this->Lang['SHIP_AMOU']; ?></th>
          <th>:</th>
          <td align="left"><?php echo $ship_dispay; ?>  <?php if(($d->shipping != 5) && ($d->shipping != 1)){ ?> ( <?php echo $symbol." ".$d->shipping_amount; ?> ) <?php } ?></td>
        </tr>
        
         <?php if($d->shipping == 5){  ?>
        <tr>
          <th align="left" ><?php echo $this->Lang["WT"]; ?></th>
          <th>:</th>
          <td align="left"><?php echo $d->weight; ?></td>
        </tr>
        <tr>
          <th align="left" ><?php echo $this->Lang["LEN"]; ?></th>
          <th>:</th>
          <td align="left"><?php echo $d->length; ?></td>
        </tr>
        <tr>
          <th align="left" ><?php echo $this->Lang["HEI"]; ?></th>
          <th>:</th>
          <td align="left"><?php echo $d->height; ?></td>
        </tr>
        <tr>
          <th align="left" ><?php echo $this->Lang["WID"]; ?></th>
          <th>:</th>
          <td align="left"><?php echo $d->width; ?></td>
        </tr>
        <?php } ?>
        
        
        <tr>
          <th align="left" ><?php echo $this->Lang["PRODUCT_QUANTITY"]; ?></th>
          <th>:</th>
          <td align="left"><?php echo $d->user_limit_quantity; ?></td>
        </tr>
        <tr>
          <th align="left"><?php echo $this->Lang["PURCHACE_COUNT"]; ?></th>
          <th>:</th>
          <td align="left"><?php echo $d->purchase_count; ?></td>
        </tr>
        <tr>
          
        </tr>
        <tr>
          <th valign="top" align="left" width="20%"><?php echo $this->Lang["MERCHANT_NAME"]; ?></th>
          <th valign="top">:</th>
          <td align="left"><?php echo ucfirst($d->firstname); ?></td>
        </tr>
        <tr>
          <th valign="top" align="left" width="20%"><?php echo $this->Lang["COUNTRY"]; ?></th>
          <th valign="top">:</th>
          <td align="left"><?php echo ucfirst($d->country_name); ?></td>
        </tr>
        <tr>
          <th valign="top" align="left" width="20%"><?php echo $this->Lang["CITY"]; ?></th>
          <th valign="top">:</th>
          <td align="left"><?php echo ucfirst($d->city_name); ?></td>
        </tr>
        <tr>
          <th valign="top" align="left" width="20%"><?php echo $this->Lang["SHOP_NAME"]; ?></th>
          <th valign="top">:</th>
          <td align="left"><?php echo ucfirst($d->store_name); ?></td>
        </tr>
        <?php $duration = unserialize($d->product_duration);
        if($duration !="") { 
        $this->merchant_duration = $this->products->get_duration_values($d->user_id); // store credits options
			if(count($this->merchant_duration)){			
        ?>
        <tr>
          <th valign="top" align="left" width="20%"><?php echo $this->Lang["STR_CRD"]; ?></th>
          <th valign="top">:</th>
          <td align="left"><?php foreach($this->merchant_duration as $dur){ if(in_array($dur->duration_id.','.$dur->duration_period,$duration)){echo ucfirst($dur->duration_period).","; }}?></td>
        </tr>
        <?php } } ?>
        
        <?php if(count($this->selectproduct_policy)>0) { ?>
        <tr>
          <th valign="top" align="left" width="20%"><?php echo $this->Lang['DEL_POLICY']; ?></th>
          <th valign="top">:</th>
          <td align="left">
        <?php 
                foreach($this->selectproduct_policy as $policy){
                     echo ucfirst($policy->text)."<br>";
                } ?>
                </td>
        </tr>
       <?php } ?>
        
        <?php if(count($this->product_color)>0) { ?>
        <tr>
          <th valign="top" align="left" width="20%"><?php echo $this->Lang['PRODUC_COLOR']; ?></th>
          <th valign="top">:</th>
          <td align="left" class="product_color_selection">
        <?php 
                foreach($this->product_color as $color){
                     echo "<span style='padding:3px;margin:2px;width:auto;height:20px;line-height:20px;vetical-align:top;display:inline-block;border:3px solid #$color->color_name;'>".ucfirst($color->color_code_name)."</span> ";
                } ?>
                </td>
        </tr>
       <?php } ?>
       
       <?php if(count($this->product_size)>0) { ?>
        <tr>
          <th valign="top" align="left" width="20%"><?php echo $this->Lang['PRODU_SIZ']; ?></th>
          <th valign="top">:</th>
          <td align="left">
        <?php 
                foreach($this->product_size as $size){
                     echo "<span style='width:3px;padding:3px;'>".ucfirst($size->size_name)."</span> ";
                } ?>
                </td>
        </tr>
       <?php } ?>
       
        <tr>
          <th valign="top" align="left" ><?php echo $this->Lang["PRODUCT_IMG"]; ?></th>
          <th valign="top">:</th>
          <?php $con=0; 
                        for($i=1; $i<=5; $i++){ 
                                if(file_exists(DOCROOT.'images/products/1000_800/'.$d->deal_key.'_'.$i.'.png')) { 
                                        $con=$con+1; 
                                } 
                         } ?>
          <?php  if(file_exists(DOCROOT.'images/products/1000_800/'.$d->deal_key.'_1'.'.png'))  { ?>
          <td align="left"><?php for($i=1; $i<=5; $i++){ 
          if(file_exists(DOCROOT.'images/products/1000_800/'.$d->deal_key.'_'.$i.'.png')) { 
          ?>
 <img border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo PATH.'images/products/1000_800/'.$d->deal_key.'_'.$i.'.png';?>&w=100&h=100" alt="" />
           <?php /* <img border="0" src= "<?php echo PATH.'images/products/466_347/'.$d->deal_key.'_'.$i.'.png';?>" alt="" width="100" /> */ ?>
            <?php } } ?>
          </td>
          <?php } 
                else { ?>
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
      <legend> <?php echo $this->Lang['TRANS_DET']; ?></legend>
      <table class="list_table fl clr show_details_table">
        <tr>
          <td colspan="3" ><?php echo new View("payment/product_transaction_list"); ?> </td>
        </tr>
        </table>
         <?php if(count($this->cod_transaction_list) > 0){ ?>
		<table class="list_table fl clr show_details_table">
        <tr>
          <td colspan="3" ><?php echo new View("payment/cod_transaction_list"); ?> </td>
        </tr>
        </table>
        <?php } ?>
		</fieldset>
    </div>
     <?php }?>   
        
        <?php if(count($this->cod_transaction_list) > 0){ ?>
        <?php if($d->purchase_count == $d->user_limit_quantity) { ?>
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
        
        <?php  }?>
        <table class="list_table fl clr show_details_table">
        <tr>
          <td colspan="3"><a href="javascript:history.back();" class="back_btn"><?php echo $this->Lang["BACK"]; ?></a></td>
        </tr>
      </table>
     
  </div>

<div class="content_bottom">
  <div class="bot_left"></div>
  <div class="bot_center"></div>
  <div class="bot_rgt"></div>
  </div>
</div>
</div>

