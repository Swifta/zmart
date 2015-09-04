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
    <fieldset>
    <legend><?php echo $this->Lang["MERCHANT_DEL"]; ?></legend>
    <table class="list_table fl clr show_details_table">
      <?php foreach($this->merchant_details as $d){			
			
			?>
      <tr>
        <th valign="top" align="left" width="20%"><?php echo $this->Lang["FIRST_NAME"]; ?></th>
        <th valign="top">:</th>
        <td align="left"><?php echo htmlspecialchars($d->firstname); ?></td>
      </tr>
      <tr>
        <th valign="top" align="left" width="20%"><?php echo $this->Lang["LAST_NAME"]; ?></th>
        <th valign="top">:</th>
        <td align="left"><?php echo htmlspecialchars($d->lastname); ?></td>
      </tr>
      <tr>
        <th valign="top" align="left" width="20%"><?php echo $this->Lang["EMAIL"]; ?></th>
        <th valign="top">:</th>
        <td align="left"><?php echo $d->email; ?></td>
      </tr>
      <tr>
        <th valign="top" align="left"><?php echo $this->Lang["MOBILE"]; ?></th>
        <th valign="top">:</th>
        <td align="left"><?php echo $d->phone_number;?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["ADDRES"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo htmlspecialchars($d->address1.','.$d->address2); ?></td>
      </tr>
      <tr>
        <th align="left"><?php echo $this->Lang["PAYMENT_ACC"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo $d->payment_account_id; ?></td>
      </tr>
	 <tr>
        <th align="left"><?php echo $this->Lang['COMMISION']; ?></th>
        <th>:</th>
        <td align="left"><?php echo $d->merchant_commission; ?>%</td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["CITY"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo htmlspecialchars($d->city_name); ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["COUNTRY"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo htmlspecialchars($d->country_name); ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["MERCHANT_STATUS"]; ?></th>
        <th>:</th>
        <td align="left"><?php if($d->user_status == 1){ echo $this->Lang['ACTIVE'];  }else{ echo $this->Lang['BLOCKED']; } ?></td>
      </tr>
      
      <tr>
        <th align="left" ><?php echo $this->Lang["SECTOR"]; ?></th>
        <th>:</th>
        <?php if($d->user_sector_id != 0){ ?>
        <?php foreach($this->sector_list as $c){ 
                if($d->user_sector_id == $c->sector_id){ ?>
        <td align="left"><?php echo htmlspecialchars($c->sector_name); ?></td>
        <?php } } }else { ?>
        <td align="left"><?php echo "Dafult"; ?></td>
        <?php } ?>
        
      </tr>
    
      <?php } ?>
      
      <?php foreach($this->shipping_data as $ship){ ?>
                                <tr>
                                <th align="left" >Shipping method </th>
                                <th>:</th>
                                <td>
                                        <?php if($this->free_shipping_setting == 1 && $ship->free ==1){ ?>
                                        <input type="checkbox" name="free" value="1" <?php if($ship->free){ ?>checked  onclick="return false"  <?php } ?>>Free Shipping
                                        <?php } else { ?>
                                        <input type="hidden" name="free" value="<?php echo $ship->free; ?>">
                                        <?php } if($this->flat_shipping_setting == 1 && $ship->flat == 1){ ?>
                                        <input type="checkbox" name="flat" value="1" <?php if($ship->flat){ ?>checked  onclick="return false"  <?php } ?>>Flat Shipping
                                        <?php } else { ?>
                                        <input type="hidden" name="flat" value="<?php echo $ship->flat; ?>">
                                         <?php } if($this->per_product_setting == 1 && $ship->per_product == 1){ ?>
                                        <input type="checkbox" name="product" value="1" <?php if($ship->per_product){ ?>checked  onclick="return false"  <?php } ?>>Per product base Shipping<br>
                                        <?php } else { ?>
                                        <input type="hidden" name="product" value="<?php echo $ship->per_product; ?>">
                                         <?php } if($this->per_quantity_setting == 1 && $ship->per_quantity == 1){ ?>
                                        <input type="checkbox" name="quantity" value="1" <?php if($ship->per_quantity){ ?>checked  onclick="return false"  <?php } ?>>Per quantity base Shipping
                                        <?php } else { ?>
                                        <input type="hidden" name="quantity" value="<?php echo $ship->per_quantity; ?>">
                                         <?php } if($this->aramex_setting == 1 && $ship->aramex == 1){ ?>
                                        <input type="checkbox" name="aramex" value="1" <?php if($ship->aramex){ ?>checked  onclick="return false"  <?php } ?>>Aramex Shipping<br>
                                        <?php } else { ?>
                                        <input type="hidden" name="aramex" value="<?php echo $ship->aramex; ?>">
                                        <?php } ?>
                                </td>
                                </tr>
                       <?php } ?>

    </table>
    </fieldset>
  </div>
  <div class="mergent_det2">
    
     <?php foreach($this->store_details as $c){ ?>
    <fieldset>
      
    <legend>
    <?php echo $this->Lang["SHOP_DET"]; ?>
    </legend>
  
    <table class="list_table fl clr show_details_table">
   
      <tr>
        <th align="left" valign="top" width="20%" ><?php echo $this->Lang["SHOP_NAME"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo htmlspecialchars($c->store_name); ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["USER_NAME"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo htmlspecialchars($c->firstname); ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["EMAIL_ID"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo htmlspecialchars($c->email); ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["SHOP_ADDR1"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo htmlspecialchars($c->address1); ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["SHOP_ADDR2"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo htmlspecialchars($c->address2); ?></td>
      </tr>
	<tr>
        <th align="left" ><?php echo $this->Lang['PH_NUM']; ?></th>
        <th>:</th>
        <td align="left"><?php echo $c->phone_number; ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["COUNTRY"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo htmlspecialchars($c->country_name); ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["CITY"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo htmlspecialchars($c->city_name); ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["SHOP_LATI"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo $c->latitude; ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["SHOP_LONG"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo $c->longitude; ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["SHOP_WEB"]; ?></th>
        <th>:</th>
        <td align="left"><?php echo $c->website; ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["SHOP_STATUS"]; ?></th>
        <th>:</th>
        <td align="left"><?php if($c->store_status == 1){ echo $this->Lang['ACTIVE'];  }else{ echo $this->Lang['BLOCKED']; } ?></td>
      </tr>
      <tr>
        <th align="left" ><?php echo $this->Lang["SHOP_TYPE"]; ?></th>
        <th>:</th>
        <td><?php if($c->store_type == 1){ echo $this->Lang['MAIN']; } else{ echo $this->Lang['BRANCH']; } ?></td>
      </tr>
       <tr>
        <th align="left" ><?php echo $this->Lang["ABOUT_US_PAGE"]; ?></th>
        <th>:</th>
       <td align="left"><?php echo $c->about_us; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    
    
     </fieldset>
      <?php } ?>
  </div>
 
  <table class="list_table fl clr show_details_table">
    <tr>
      <td colspan="3"><a href="javascript:history.back();" class="back_btn"><?php echo $this->Lang["BACK"]; ?></a></td>
    </tr>
  </table> </div>
  <div class="content_bottom">
    <div class="bot_left"></div>
    <div class="bot_center"></div>
    <div class="bot_rgt"></div>
 
</div>
</div>
