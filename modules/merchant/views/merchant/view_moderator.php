<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'merchant.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    
    
     
                <div class="mergent_det2">
      <fieldset>
    		<legend><?php echo $this->template->title; ?></legend>
        <table class="list_table fl clr show_details_table">
            <?php foreach( $this->users_deatils as $d){			
		?>
              
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["FIRST_NAME"]; ?></th><th valign="top">:</th><td align="left"><?php echo ucfirst($d->firstname); ?></td>
                </tr>
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["LAST_NAME"]; ?></th><th valign="top">:</th><td align="left"><?php echo ucfirst($d->lastname); ?></td>
                </tr>
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["EMAIL_F"]; ?></th><th valign="top">:</th><td align="left"><?php echo $d->email; ?></td>
                </tr>

                <tr>
                   <th valign="top" align="left"><?php echo $this->Lang["PHONE"]; ?></th><th valign="top">:</th><td align="left"><?php echo nl2br($d->phone_number);?></td>
                </tr>
               
                <tr>
                        <th align="left" ><?php echo $this->Lang["ADDR1"]; ?></th><th>:</th><td align="left"><?php echo $d->address1; ?></td>
                </tr>
                <tr>
                        <th align="left"><?php echo $this->Lang["ADDR2"]; ?></th><th>:</th><td align="left"><?php echo $d->address2; ?></td>
                </tr>
                <tr>
                        <th align="left" ><?php echo $this->Lang["COUNTRY"]; ?></th><th>:</th><td align="left"><?php echo $d->country_name; ?></td>
                </tr> 	
                
                <tr>
                        <th align="left" ><?php echo $this->Lang["CITY"]; ?></th><th>:</th><td align="left"><?php echo ucfirst($d->city_name); ?></td>
                </tr>
                
		
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["JOIN_DATE"]; ?></th><th valign="top">:</th><td align="left"><?php echo date('d-M-Y H:m:s', $d->joined_date); ?></td>
                </tr>
                
                     <?php } ?> 
                     
                     
                     <?php if(count($this->moderator_list) > 0) { ?>
                        
                                             
                       
                       <tr>
                         <td></td>
                                <td></td>
                        <table class="list_table fl clr show_details_table show_details_table_new4">
                                <tr>
                                <td width="200"><label><?php echo $this->Lang["MANAG_NAME"]; ?> </label></td>
                                <td width="100"><label><?php echo $this->Lang["VIEW"]; ?> </label></td>
                                <td width="100"><label><?php echo $this->Lang["ADD"]; ?></label></td>
                                <td width="100"><label><?php echo $this->Lang["EDIT"]; ?></label></td>
                                <td width="100"><label><?php echo $this->Lang["BLOCK"]; ?> /<br> <?php echo $this->Lang["UNBLOCK"]; ?></label></td>
                                 </tr>
                        
                                
                                  <?php foreach($this->moderator_list as $mo ) { ?>
                                 <tr>
                                <td><label><?php echo $this->Lang["DEALS"]; ?> </label></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_deals == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_deals"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_deals_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_deals_add"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_deals_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_deals_edit"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_deals_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_deals_block"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["PRODUCT"]; ?> </label></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_products == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_products"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_products_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_products_add"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_products_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_products_edit"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_products_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_products_block"></td>
                                 </tr>
                                 
                                   <tr>
                                <td><label><?php echo $this->Lang["AUCTION"]; ?></label> </td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_auctions == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_auctions"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_auctions_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_auctions_add"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_auctions_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_auctions_edit"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_auctions_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_auctions_block"></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["TRANS"]; ?></label></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_transactions == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_transactions"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["FUND_REQ"]; ?></label></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_fundrequest == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_fundrequest"></td>
                                 <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_fundrequest_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_fundrequest_edit"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                              
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                  <tr>
                                <td><label><?php echo $this->Lang["SHOP"]; ?></label> </td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_shop == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_shop"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_shop_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_shop_add"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_shop_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_shop_edit"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_shop_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_shop_block"></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["SHIPP_MODULE"]; ?></label> </td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_shipping == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_shop"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_shipping_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_shipping_edit"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["TAC"]; ?></label> </td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_tac == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_tac"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_tac_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_tac_edit"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["RET_POL"]; ?></label> </td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_return_policy == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_return_policy"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_return_policy_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_return_policy_edit"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                  <tr>
                                <td><label><?php echo $this->Lang["ABOUT_US_PAGE"]; ?></label> </td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_about_us == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_about_us"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_about_us_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_about_us_edit"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                  <tr>
                                <td><label><?php echo $this->Lang["STORE_PERSONALIZED"]; ?></label> </td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_personalized_store == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_personalized"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_personalized_store_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_personalized_edit"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["NEWSLETTER"]; ?></label></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_newsletter == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_newsletter"></td>
                                 <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_newsletter_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_newsletter_add"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                              
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["ATTIBUTSS"]; ?> </label></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_attributs == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_attributs"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_attributs_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_attributs_add"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_attributs_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_attributs_edit"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["CATEGORIE"]; ?> </label></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_categories == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_categories"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_categories_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_categories_add"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_categories_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_categories_edit"></td>
								<td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["ATTRIBUTES"]; ?> </label></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_specification == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_specification"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_specification_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_specification_add"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_specification_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_specification_edit"></td>
                               <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["GIFT"]; ?> </label></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_gift == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_gift"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_gift_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_gift_add"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_gift_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_gift_edit"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_gift_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_gift_block"></td>
                                 </tr>
                                 
                                   
                                 
                                   <?php } ?>
                                 
                                 
                        </table>
                           </tr>                 
                        
                        <?php } ?>
                        
                    
                     
                     

                 </tr>
				 </table>
				 </fieldset>
				 </div>
                     
                <tr><td colspan="3"><a href="javascript:history.back();" class="back_btn"><?php echo $this->Lang["BACK"]; ?></a></td></tr>  
                
        </table>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
