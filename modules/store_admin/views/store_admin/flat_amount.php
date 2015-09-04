<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script> 
	function atleast_onecheckbox(e) {
          if ($("input[type=checkbox]:checked").length === 0) {
              e.preventDefault();
              alert('Shipping Method Should be Mandatory, You should choose any one of the shipping method');
              $('.processing_image').hide();
              return false;
          } 
}
	</script>
<div class="bread_crumb"><a href="<?php echo PATH."store-admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
      
        <?php foreach($this->user_data as $ud){ ?>
        <form method="post" class="admin_form" onclick="return atleast_onecheckbox(event)" name="edit_users" >
        <div class="mergent_det2">
		<fieldset>
			<legend><?php echo $this->Lang['FLAT_SH']; ?></legend>  
			<div class="paypal_mod">
                <table>
                        <tr> 
                                <td><label><?php echo $this->Lang['FLAT_SH']; ?> ( <?php  echo CURRENCY_SYMBOL; ?> )</label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="flat_shipping" value="<?php echo $ud->flat_amount;?>" autofocus />
                                <em><?php if(isset($this->form_error['flat_shipping'])){ echo $this->form_error["flat_shipping"]; }?></em>
                                </td>
                        </tr>
                        
                </table>
                </div>
		</fieldset>
	</div>
                
                
                
                
                
                <div class="mergent_det2">
		<fieldset>
			<legend><?php echo $this->Lang['SHIPP_MODULE']; ?> <?php echo $this->Lang["SETTINGS"]; ?></legend>  
			<div class="paypal_mod">
					
				<?php foreach($this->shipping_data as $u ){ ?>
					
				<?php if($this->free_shipping_setting == 1){ ?>
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/sign_free_red.png" class="image" alt="<?php echo $this->Lang['FREE_SH']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['FREE_SH']; ?>
						   <span> <input type="checkbox" name="free" <?php if($u->free == 1){ ?> checked = "checked" <?php }  ?> value="1">
						  
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					  
					
                                        <?php } else { ?>
                                        <input type="hidden" name="free" value="<?php echo $u->free; ?>">
                                        <?php } if($this->flat_shipping_setting == 1){ ?>
			
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/flat_shipping.png" class="image" alt="<?php echo $this->Lang['FLAT_SH']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['FLAT_SH']; ?>
						   <span> <input type="checkbox" name="flat" <?php if($u->flat == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					
					 <?php } else { ?>
                                        <input type="hidden" name="flat" value="<?php echo $u->flat; ?>">
                                         <?php } if($this->per_product_setting == 1){ ?>
					
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/product_shipping.png" class="image" alt="<?php echo $this->Lang['PER_PRODU_SHIPP']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['PER_PRODU_SHIPP']; ?>
						   <span> <input type="checkbox" name="product" <?php if($u->per_product == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					   
					
					<?php } else { ?>
                                        <input type="hidden" name="product" value="<?php echo $u->per_product; ?>">
                                         <?php } if($this->per_quantity_setting == 1){ ?>
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/item_shipping.png" class="image" alt="<?php echo $this->Lang['PER_ITEM_SH']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['PER_ITEM_SH']; ?>
						   <span> <input type="checkbox" name="quantity" <?php if($u->per_quantity == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						   <?php } else { ?>
                                        <input type="hidden" name="quantity" value="<?php echo $u->per_quantity; ?>">
                                         <?php } if($this->aramex_setting == 1){ ?>
						   
						   
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/aramex.png" class="image" alt="<?php echo $this->Lang['PER_ITEM_SH']; ?>"/>
						   </div>
						   
						   <p>Aramex Shipping
						   <span> <input type="checkbox" name="aramex" <?php if($u->aramex == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					   <?php } else { ?>
                                        <input type="hidden" name="aramex" value="<?php echo $u->aramex; ?>">
                                        <?php } ?>
					

			 <?php } ?>         
					
				</div>
		</fieldset>
	</div>
	
	<div class="mergent_det2">
		
			<div class="paypal_mod">
                <table>
                 <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>merchant/settings.html"'/></td>
                        </tr>
                        
                        </table>
                </div>
	</div>
	
        </form>
          <?php  }?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
