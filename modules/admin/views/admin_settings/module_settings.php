<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
	<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
	<div class="cont_container mt15 mt10">
		<div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
		<div class="content_middle">
			<form action="" method="post" class="admin_form fl" >
	<div class="mergent_det2">
		<fieldset>
			<legend>Modules <?php echo $this->Lang["SETTINGS"]; ?></legend> 
				<div class="paypal_mod">
				<?php foreach($this->set_module as $u ){ ?>
						 <div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/deal_module.png" class="image" alt="<?php echo $this->Lang['DL_MDL']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['DL_MDL']; ?>
						   <span><input type="checkbox" name="deal" <?php if($u->is_deal == 1){ ?> checked = "checked" <?php }  ?> value="1" ></span>
						  </p>
						   </div> <div class="dash_active_right">  </div> 

						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/product_module.png" class="image" alt="<?php echo $this->Lang['PRO_MDL']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['PRO_MDL']; ?>
						   <span><input type="checkbox" name="product" <?php if($u->is_product == 1){ ?> checked = "checked" <?php }  ?> value="1"></span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					   
					
					
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/auction_module.png" class="image" alt="<?php echo $this->Lang['ACT_MDL']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['ACT_MDL']; ?>
						   <span> <input type="checkbox" name="auction" <?php if($u->is_auction == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					   
					

					
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/blog_module.png" class="image" alt="<?php echo $this->Lang['BLG_MDL']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['BLG_MDL']; ?>
						   <span><input type="checkbox" name="blog" <?php if($u->is_blog == 1){ ?> checked = "checked" <?php }  ?> value="1"></span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					   
					
				   
					
				
						 <div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/near_me_map_module.png" class="image" alt="<?php echo $this->Lang['NEAR_ME_MAP']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['NEAR_ME_MAP']; ?>
						   <span><input type="checkbox" name="near_me_map" <?php if($u->is_map == 1){ ?> checked = "checked" <?php }  ?> value="1" ></span>
						  </p>
						   </div> <div class="dash_active_right">  </div> 
						
					  
					
					

						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/store_list.png" class="image" alt="<?php echo $this->Lang['STORE_LI_MO']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['STORE_LI_MO']; ?>
						   <span><input type="checkbox" name="store_list" <?php if($u->is_store_list == 1){ ?> checked = "checked" <?php }  ?> value="1"></span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					   
					
					
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/completed_deals.png" class="image" alt="<?php echo $this->Lang['PAST_DEALS']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['PAST_DEALS']; ?>
						   <span> <input type="checkbox" name="past_deal" <?php if($u->is_past_deal == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 

						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/faq_module.png" class="image" alt="<?php echo $this->Lang['FAQ_MOD']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['FAQ_MOD']; ?>
						   <span><input type="checkbox" name="faq" <?php if($u->is_faq == 1){ ?> checked = "checked" <?php }  ?> value="1"></span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 

			 <?php } ?>
		   </div>
				
		</fieldset>
	</div>
	<div class="mergent_det2">
		<fieldset>
			<legend> Payment type <?php echo $this->Lang["SETTINGS"]; ?></legend>  
			<div class="paypal_mod">
					
				<?php foreach($this->set_module as $u ){ ?>
					
				
						<?php /*<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/cash_on_delivery.png" class="image" alt="<?php echo $this->Lang['CASH_ON_DEL']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['CASH_ON_DEL']; ?>

						   <span> <input type="checkbox" name="cash_on_delivery" <?php if($u->is_cash_on_delivery == 1){ ?> checked = "checked" <?php }  ?> value="1" >
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> */?>
						   <input type="checkbox" style="display:none" name="cash_on_delivery" <?php if($u->is_cash_on_delivery == 1){ ?> checked = "checked" <?php }  ?> value="1" >
						
					  
					
					
					
					
				
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/paypal_mod.png" class="image" alt="<?php echo $this->Lang['PAYPAL_MDL']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['PAYPAL_MDL']; ?>
						   <span> <input type="checkbox" name="paypal" <?php if($u->is_paypal == 1){ ?> checked = "checked" <?php }  ?> value="1" >
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					  
					

			
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/credit_card_mod.png" class="image" alt="<?php echo $this->Lang['CRD_CARD_MDL']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['CRD_CARD_MDL']; ?>
						   <span> <input type="checkbox" name="credit_card" <?php if($u->is_credit_card == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					
					
					
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/Authorizedotnet.png" class="image" alt="<?php echo $this->Lang['AUTH_MDL']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['AUTH_MDL']; ?>
						   <span> <input type="checkbox" name="authorize" <?php if($u->is_authorize == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						   
						   
						   	<div class="dash_active_left"> </div> 
							 <div class="dash_active_mid_mod">
												  
							  <div class="dash_act_img">
							
							  <img src="<?php echo PATH ?>images/paylater.png" class="image" alt="<?php echo $this->Lang['PAY_LATER_MODULE']; ?>" style="width:78px;height:48px;"/>
							   </div>
							   
							   <p><?php echo $this->Lang['PAY_LATER_MODULE']; ?>
							   <span> <input type="checkbox" name="pay_later" <?php if($u->is_pay_later == 1){ ?> checked = "checked" <?php }  ?> value="1">
							   </span> </p>
							  
							   </div> <div class="dash_active_right">  </div> 
						
					   
					

			 <?php } ?>         
					
				</div>
		</fieldset>
	</div>


	<div class="mergent_det2">
		<fieldset>
			<legend><?php echo $this->Lang['SHIP_ING']; ?> <?php echo $this->Lang["SETTINGS"]; ?></legend>  
			<div class="paypal_mod">
					
				<?php foreach($this->set_module as $u ){ ?>
					
				
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/sign_free_red.png" class="image" alt="<?php echo $this->Lang['FREE_SH']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['FREE_SH']; ?>
						   <span> <input type="checkbox" name="free_shipping" <?php if($u->free_shipping == 1){ ?> checked = "checked" <?php }  ?> value="1">
						  
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					  
					

			
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/flat_shipping.png" class="image" alt="<?php echo $this->Lang['FLAT_SH']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['FLAT_SH']; ?>
						   <span> <input type="checkbox" name="flat_shipping" <?php if($u->flat_shipping == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					
					
					
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/product_shipping.png" class="image" alt="<?php echo $this->Lang['PER_PRODU_SHIPP']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['PER_PRODU_SHIPP']; ?>
						   <span> <input type="checkbox" name="per_product" <?php if($u->per_product == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						
					   
					
					
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/item_shipping.png" class="image" alt="<?php echo $this->Lang['PER_ITEM_SH']; ?>"/>
						   </div>
						   
						   <p><?php echo $this->Lang['PER_ITEM_SH']; ?>
						   <span> <input type="checkbox" name="per_quantity" <?php if($u->per_quantity == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div> 
						   
						   
						   <input type="hidden" name="aramex" <?php if($u->aramex == 1){ ?> checked = "checked" <?php }  ?> value="0">
						<?php /*<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/aramex.png" class="image" alt="<?php echo $this->Lang['PER_ITEM_SH']; ?>"/>
						   </div>
						   
						   <p>Aramex Shipping
						   <span> <input type="checkbox" name="aramex" <?php if($u->aramex == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   </span> </p>
						  
						   </div> <div class="dash_active_right">  </div>  */ ?>
						
					   
					

			 <?php } ?>         
					
				</div>
		</fieldset>
	</div>
	
	<?php /* NEWSLETTER TEMPLATE */ ?>	
	
	<div class="mergent_det2">
		<fieldset>
			<legend><?php echo $this->Lang['NEWS_TEMP']; ?></legend>  
			<div class="paypal_mod">
					
				<?php foreach($this->set_module as $u ){ ?>
					
				
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/newsletter1.png" class="image" alt="<?php echo $this->Lang['TEMPLATE']; ?> 1"/>
						   </div>
						   <p><?php echo $this->Lang['TEMPLATE']; ?> 1
						   <span> <input type="radio" name="newsletter" <?php if($u->is_newsletter == 1){ ?> checked = "checked" <?php }  ?> value="1" >
						   </span> </p> 
                                                 </div>
                                                 <div class="dash_active_right">  </div> 
        					 <div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
						  <div class="dash_act_img">
						  <img src="<?php echo PATH ?>images/newsletter2.png" class="image" alt="<?php echo $this->Lang['TEMPLATE']; ?> 2"/>
						   </div>
						   <p><?php echo $this->Lang['TEMPLATE']; ?> 2
						   <span> <input type="radio" name="newsletter" <?php if($u->is_newsletter == 2){ ?> checked = "checked" <?php }  ?> value="2">
						   </span> </p>
						   </div> <div class="dash_active_right">  </div> 
						<div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
						  <div class="dash_act_img">
						  <img src="<?php echo PATH ?>images/newsletter3.png" class="image" alt="<?php echo $this->Lang['TEMPLATE']; ?> 3 "/>
						   </div>
						   <p><?php echo $this->Lang['TEMPLATE']; ?> 3
						   <span> <input type="radio" name="newsletter" <?php if($u->is_newsletter == 3){ ?> checked = "checked" <?php }  ?> value="3">
						   </span> </p>
						   </div> <div class="dash_active_right">  </div> 
						   <div class="dash_active_left"> </div> 
						 <div class="dash_active_mid_mod">
						  <div class="dash_act_img">
						  <img src="<?php echo PATH ?>images/newsletter4.png" class="image" alt="<?php echo $this->Lang['TEMPLATE']; ?> 3 "/>
						   </div>
						   <p><?php echo $this->Lang['TEMPLATE']; ?> 4
						   <span> <input type="radio" name="newsletter" <?php if($u->is_newsletter == 4){ ?> checked = "checked" <?php }  ?> value="4">
						   </span> </p>
						   </div> <div class="dash_active_right">  </div> 
			                <?php } ?>
				</div>
		</fieldset>
	</div>
	<?php /* CITY SETTINGS */ ?>
	<div class="mergent_det2">
		<fieldset>
			<legend><?php echo $this->Lang['CITY']; ?> / <?php echo "CMS"; ?> <?php echo $this->Lang["SETTINGS"]; ?></legend>  
			<div class="paypal_mod">
				<?php foreach($this->set_module as $u ){ ?>
                                                <div class="dash_active_left"> </div> 
                                                <div class="dash_active_mid_mod">
                                                <div class="dash_act_img">
                                                <img src="<?php echo PATH ?>images/with_city.png" class="image" alt="<?php echo $this->Lang['WITH_C']; ?>"/>
                                                </div>
                                                <p><?php echo $this->Lang['WITH_C']; ?>
                                                <span> <input type="radio" name="city" <?php if($u->is_city == 1){ ?> checked = "checked" <?php }  ?> value="1" >
                                                </span> </p>
                                                </div> <div class="dash_active_right">  </div> 
                                                <div class="dash_active_left"> </div> 
                                                <div class="dash_active_mid_mod">  
                                                <div class="dash_act_img">
                                                <img src="<?php echo PATH ?>images/with_out_city.png" class="image" alt="<?php echo $this->Lang['WITH_O_C']; ?>"/>
                                                </div>
                                                <p><?php echo $this->Lang['WITH_O_C']; ?>
                                                <span> <input type="radio" name="city" <?php if($u->is_city == 0){ ?> checked = "checked" <?php }  ?> value="0">
                                                </span> </p>
                                                </div> <div class="dash_active_right">  </div> 
                                                <input type="hidden" name="cms" <?php if($u->is_cms == 1){ ?> checked = "checked" <?php }  ?> value="0">
						   <?php /*  <div class="dash_active_left"> </div> 
						  <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/view_text.png" class="image" alt="<?php echo "CMS Header Setting"; ?>"/>
						   </div>
						   
						   <p><?php echo "CMS Header Setting"; ?>
						   <span> <input type="checkbox" name="cms" <?php if($u->is_cms == 1){ ?> checked = "checked" <?php }  ?> value="1">
						   </span> </p>
						   </div> <div class="dash_active_right">  </div>  */ ?>
						
			 <?php } ?>         
					
				</div>
		</fieldset>
	</div>
	
	
	
	
	
			<table>
					<tr>
					   
						<td style="padding:10px 0px 0px 193px;"><input type="submit" name="update" value="<?php echo $this->Lang['UPDATE']; ?>" title="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" title="<?php echo $this->Lang['CANCEL']; ?>"  value="<?php echo $this->Lang['CANCEL']; ?>" onclick="window.location.href='<?php echo PATH?>admin.html'"/></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
	</div>
