<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
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
                                <td><label><?php echo $this->Lang["CUSTOMERS"]; ?></label> </td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_customer == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_customer"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_customer_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_customer_add"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_customer_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_customer_edit"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_customer_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_customer_block"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["MERCHANTS"]; ?></label> </td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_merchant == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_merchant"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_merchant_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_merchant_add"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_merchant_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_merchant_edit"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_merchant_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_merchant_block"></td>
                                 </tr>
                                 
                                   <tr>
									<td><label><?php echo $this->Lang["FUND_REQ"]; ?></label></td>
									<td><input type="checkbox" value="1" <?php if($mo->privileges_fundrequest == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
									<td><input type="checkbox" value="1"  disabled></td>
									<td><input type="checkbox" value="1" <?php if($mo->privileges_fundrequest_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
									<td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["TRANS"]; ?></label></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_transactions == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_transactions"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["STR_CRD_ORD"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_storecredit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["SEND_DAILY_DEALS"]; ?></label> </td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_daily_newsletter == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_daily_newsletter"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["BLOGS1"]; ?></label> </td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_blogs == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_blogs"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_blogs_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_blogs_add"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_blogs_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_blogs_edit"></td>
                                <td><input type="checkbox" value="1" onclick="return false"<?php if($mo->privileges_blogs_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_blogs_block"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["CUSTOMER_CARE"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customercare == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customercare_add == "1" ){  ?>checked = "checked" <?php } ?>onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customercare_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customercare_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["BANA"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_banner == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_banner_add == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_banner_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_banner_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["ATTIBUTSS"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_attributs == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_attributs_add == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_attributs_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_attributs_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["ATTIBUTS"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_specification == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_specification_add == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_specification_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_specification_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["COUNTRY"]; ?></label> </td>
                               
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_country == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_country_add == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_country_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_country_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["CITY"]; ?></label> </td>
                               
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_city == "1" ){  ?>checked = "checked" <?php } ?>  onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_city_add == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_city_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_city_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["CATEGORIE"]; ?></label> </td>
                               
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_categories == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_categories_add == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_categories_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_categories_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["SECTOR"]; ?></label> </td>
                               
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_sector == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_sector_add == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_sector_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_sector_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["CMS"]; ?></label> </td>
								<td><input type="checkbox" value="1" <?php if($mo->privileges_cms == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_cms_add == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_cms_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_cms_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["ADS"]; ?></label> </td>
								<td><input type="checkbox" value="1" <?php if($mo->privileges_ads == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_ads_add == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_ads_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_ads_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["FAQ"]; ?></label> </td>
								<td><input type="checkbox" value="1" <?php if($mo->privileges_faq == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_faq_add == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_faq_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_faq_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["NEWS_TEMP"]; ?></label> </td>
								<td><input type="checkbox" value="1" <?php if($mo->privileges_newsletter == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_newsletter_add == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_newsletter_edit == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_newsletter_block == "1" ){  ?>checked = "checked" <?php } ?> onclick="return false"></td>
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
