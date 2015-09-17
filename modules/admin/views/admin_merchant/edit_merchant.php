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
	<SCRIPT language="Javascript">
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode        
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }
   </SCRIPT>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
      
        <?php foreach($this->user_data as $u){ ?>
	
        <form method="post" class="admin_form" action = "" onclick="return atleast_onecheckbox(event)" name="edit_users" enctype="multipart/form-data">
                <table>
                        <tr> 
                                <td><label><?php echo $this->Lang["FIRST_NAME"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="firstname" maxlength="32"  value="<?php echo $u->firstname;?>" autofocus />
                                <em><?php if(isset($this->form_error['firstname'])){ echo $this->form_error["firstname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr> 
                                <td><label><?php echo $this->Lang["LAST_NAME"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="lastname" maxlength="32"  value="<?php echo $u->lastname;?>"/>
                                <em><?php if(isset($this->form_error['lastname'])){ echo $this->form_error["lastname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["EMAIL_F"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="email"  maxlength="255" value="<?php echo $u->email;?>"/>
                                <em><?php if(isset($this->form_error['email'])){ echo $this->form_error["email"]; }?></em>
                                </td>
                        </tr>

                         <tr>
                                <td><label><?php echo $this->Lang["PAYMENT_ACC"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="payment_acc" maxlength="255" value="<?php echo $u->payment_account_id;?>"/>
                                <em><?php if(isset($this->form_error['payment_acc'])){ echo $this->form_error["payment_acc"]; }?></em>
                                </td>
                        </tr>
                 
                         <tr>
                                <td><label><?php echo $this->Lang["PHONE"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mer_mobile" maxlength="15" value="<?php echo $u->user_phone_number;?>"/>
                                <em><?php if(isset($this->form_error['mer_mobile'])){ echo $this->form_error["mer_mobile"]; }?></em>
                                </td>
                        </tr> 
                          <tr>
                                <td><label><?php echo $this->Lang["ADDR1"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mer_address1" maxlength="100" value="<?php echo $u->user_address1;?>"/>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["ADDR2"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mer_address2" maxlength="100" value="<?php echo $u->user_address2;?>"/>
                                </td>
                        </tr>  
                        
                        
                                                  
                     <tr>
                    <td><label><?php echo $this->Lang["SEL_COUNTRY"]; ?><span>*</span></label></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="country" onchange="return city_change_merchant(this.value);">
                        <option value=""><?php echo $this->Lang["SEL_COUNTRY"]; ?></option>
                        
                        
                        <?php foreach($this->country_list as $d){ ?>
                        <option value="<?php echo $d->country_id ?>" <?php if($d->country_id==$u->user_country_id) { ?> selected="selected" <?php } ?>><?php echo $d->country_name; ?></option>
                          <?php }  ?>
                        </select>
                        <em><?php if(isset($this->form_error["country"])){ echo $this->form_error["country"]; }?></em>
                      
                     </td>
                     </tr>                            
                        <tr id="CitySD">
                    <td><label><?php echo $this->Lang["SEL_CITY"]; ?><span>*</span></label></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="city">
                        <option value="" <?php if($u->city_id==0){ ?>selected="selected" <?php } ?>><?php echo $this->Lang["CITY_FIRST"]; ?></option>
	                <?php foreach($this->city_list as $d){ if($u->user_country_id == $d->country_id) { ?>
	                <option value=<?php echo $d->city_id; ?> <?php if($u->user_city_id==$d->city_id) { ?> selected="selected" <?php  } ?>><?php echo $d->city_name; ?></option>                                     
	                <?php } }  ?> 
                        </select>
                        <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em>
					</td>
                        </tr>
                                                                
                      <input type="hidden" name="store_id" value="<?php echo $u->store_id;?>"/>
			 <tr>
                                <td><label><?php echo $this->Lang["COMMISION"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="commission" maxlength="3" onkeypress="return isNumberKey(event)"  value="<?php echo $u->merchant_commission;?>"/>
                                			<em><?php if(isset($this->form_error["commission"])){ echo $this->form_error["commission"]; }?></em>
			<span>%</span>
                        </td>

                       </tr>
                       <?php foreach($this->shipping_data as $ship){ ?>
                       <tr>
                                <td><label>Shipping method<span>*</span></label></td>
                                <td><label>:</label></td>
                                <td>
                                <table style="border: 1px solid #999; border-collapse: collapse; width:242px;">
                                        <?php if($this->free_shipping_setting == 1){ ?>
                                        <tr><td><input type="checkbox" name="free" value="1" <?php if($ship->free){ ?>checked <?php } ?>>Free Shipping</td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="free" value="<?php echo $ship->free; ?>">
                                        <?php } if($this->flat_shipping_setting == 1){ ?>
                                        <tr><td><input type="checkbox" name="flat" value="1" <?php if($ship->flat){ ?>checked <?php } ?>>Flat Shipping</td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="flat" value="<?php echo $ship->flat; ?>">
                                         <?php } if($this->per_product_setting == 1){ ?>
                                        <tr><td><input type="checkbox" name="product" value="1" <?php if($ship->per_product){ ?>checked <?php } ?>>Per product base Shipping</td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="product" value="<?php echo $ship->per_product; ?>">
                                         <?php } if($this->per_quantity_setting == 1){ ?>
                                        <tr><td><input type="checkbox" name="quantity" value="1" <?php if($ship->per_quantity){ ?>checked <?php } ?>>Per quantity base Shipping</td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="quantity" value="<?php echo $ship->per_quantity; ?>">
                                         <?php } if($this->aramex_setting == 1){ ?>
                                        <tr><td><input type="checkbox" name="aramex" value="1" <?php if($ship->aramex){ ?>checked <?php } ?>>Aramex Shipping</td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="aramex" value="<?php echo $ship->aramex; ?>">
                                        <?php } ?>
                                        </table>
                                </td>
                        </tr>
                       
                       <?php } ?>
			<tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>admin/merchant.html"'/></td>
                        </tr>
                      
                </table>
        </form>
          <?php  }?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
