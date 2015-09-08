<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script >
	$(document).ready(function () {
		
		$(".privileges_deals, .privileges_products,.privileges_shop,.privileges_shipping,.privileges_return_policy,.privileges_about_us, .privileges_personalized,.privileges_auctions,.privileges_fundrequest,.transactions_check,.fundrequest_check,.privileges_tac,.personalized_check,.about_us_check,.return_policy_check,.tac_check,.shipping_check,.newsletter_check,.privileges_newsletter,.attributs_check,.categories_check,.privileges_attributs,.privileges_categories,.specification_check,.privileges_specification,.gift_check,.privileges_gift").on('click', function (e) {
			var isCheck = $(this).is(':checked');
			if (isCheck)
			{
				var numberOfChecked = $('input:checkbox:checked').length;
				if(numberOfChecked == 44)
				{
					$('#checkall').prop('checked', true);
				}
				else
				{
					$('#checkall').prop('checked', false);
				}
			}
			else
			{
				$('#checkall').prop('checked', false);
			}
		});
		
        $(".deals_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_deals").prop("disabled", false);
                
            } else {
              $(".privileges_deals").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".products_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_products").prop("disabled", false);
                
            } else {
              $(".privileges_products").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
         $(".auctions_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_auctions").prop("disabled", false);
                
            } else {
              $(".privileges_auctions").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".shops_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_shop").prop("disabled", false);
                
            } else {
              $(".privileges_shop").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".shipping_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_shipping").prop("disabled", false);
                
            } else {
              $(".privileges_shipping").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".tac_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_tac").prop("disabled", false);
                
            } else {
              $(".privileges_tac").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
         $(".return_policy_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_return_policy").prop("disabled", false);
                
            } else {
              $(".privileges_return_policy").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
         $(".about_us_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_about_us").prop("disabled", false);
                
            } else {
              $(".privileges_about_us").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".personalized_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_personalized").prop("disabled", false);
                
            } else {
              $(".privileges_personalized").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        
         $(".fundrequest_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_fundrequest").prop("disabled", false);
                
            } else {
              $(".privileges_fundrequest").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".newsletter_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_newsletter").prop("disabled", false);
                
            } else {
              $(".privileges_newsletter").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".attributs_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_attributs").prop("disabled", false);
                
            } else {
              $(".privileges_attributs").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
         $(".categories_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_categories").prop("disabled", false);
                
            } else {
              $(".privileges_categories").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".specification_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_specification").prop("disabled", false);
                
            } else {
              $(".privileges_specification").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".gift_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_gift").prop("disabled", false);
                
            } else {
              $(".privileges_gift").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        
});
</script>


<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    <form method="post"  class="admin_form" name="send_privileges_mod">
        <div class="mergent_det">
                       <fieldset>
                       <legend><?php echo $this->Lang['ADD_MODE']; ?></legend>
        
        
                <table>
                        <tr>
                                <td><label><?php echo $this->Lang["FIRST_NAME"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="firstname" value="<?php if(!isset($this->form_error['firstname']) && isset($this->userPost['firstname'])){echo $this->userPost['firstname'];}?>"/>
                                <em><?php if(isset($this->form_error['firstname'])){ echo $this->form_error["firstname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["LAST_NAME"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="lastname" value="<?php if(!isset($this->form_error['lastname']) && isset($this->userPost['lastname'])){echo $this->userPost['lastname'];}?>"/>
                                <em><?php if(isset($this->form_error['lastname'])){ echo $this->form_error["lastname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["EMAIL_F"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="email" value="<?php if(!isset($this->form_error['email']) && isset($this->userPost['email'])){echo $this->userPost['email'];}?>"/>
                                <em><?php if(isset($this->form_error['email'])){ echo $this->form_error["email"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["PHONE"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mobile" maxlength="15" value="<?php if(!isset($this->form_error['mobile']) && isset($this->userPost['mobile'])){echo $this->userPost['mobile'];}?>"/>
                                <em><?php if(isset($this->form_error['mobile'])){ echo $this->form_error["mobile"]; }?></em>
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang["ADDR1"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address1" value="<?php if(isset($this->userPost['address1'])){echo $this->userPost['address1'];}?>"/>
                                <em><?php if(isset($this->form_error['address1'])){ echo $this->form_error["address1"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["ADDR2"]; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address2" value="<?php if(isset($this->userPost['address2'])){echo $this->userPost['address2'];}?>"/>
                                <em><?php if(isset($this->form_error['address2'])){ echo $this->form_error["address2"]; }?></em>
                                </td>
                        </tr>                        
                       
                        <tr>
                    <td><label><?php echo $this->Lang["SEL_COUNTRY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="country" onchange="return city_change(this.value);">
                        <option value=""><?php echo $this->Lang["SEL_COUNTRY"]; ?></option>
                        
                        <?php foreach($this->country_list as $d){ ?>
                        
                        <option value="<?php echo $d->country_id ?>" <?php if(!isset($this->form_error['country']) && isset($_POST['country'])){ if($_POST['country'] == $d->country_id){ ?> selected <?php } } ?>><?php echo $d->country_name; ?></option>
                          <?php } ?>
                        </select>
                       <em><?php if(isset($this->form_error["country"])){ echo $this->form_error["country"]; }?></em>
                     </td>
                     </tr>
                     
                        <tr id="CitySD">
                    <td><label><?php echo $this->Lang["SEL_CITY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <?php if(!isset($this->form_error['city']) && isset($_POST['city'])){ ?>
				<select name="city">
				<?php foreach($this->city_list as $s){ ?>
				<?php if($s->city_id == $_POST['city']){ ?>
			                <option value="<?php echo $s->city_id; ?>" <?php if(isset($_POST['city'])){ if($_POST['city'] == $s->city_id){ ?> selected <?php } } ?>><?php echo $s->city_name; ?></option>
				<?php } } ?>
		                </select>
			<?php  } else{  ?>
		                <select name="city">
		                <option value=""> <?php echo $this->Lang["CITY_FIRST"]; ?></option>
		                </select>
                        <?php } ?>
                        <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em>
					</td>
                        </tr> 
                        
                          </table>
       
        </fieldset>
        </div>
        
        
        <div class="mergent_det2">
                       <fieldset>
                       <legend><?php echo $this->Lang["SELECT_MOD_PRIVI"]; ?></legend>
        
        
                <table>
                                              
                       <tr>
                        <td></td>
                                <td></td> 
                                <td><label><input type="checkbox" id="checkall"  <?php if (isset($_POST['checkall'])) { ?>checked = "checked" <?php } ?> onclick="checkboxcheckAll_moderator()"  name="checkall"> <?php echo $this->Lang["SELECT_ALL"]; ?></label></td>
                           
				 <?php /* <td><label><input type="checkbox" class="cityall"  <?php if (isset($_POST['privileges_cityall'])) { ?>checked = "checked" <?php } ?>   name="privileges_cityall"> <?php //echo $this->Lang["CITY_ALL"]; ?></label></td>
				 
				  <td><label><input type="checkbox" class="countryall"  <?php if (isset($_POST['privileges_countryall'])) { ?>checked = "checked" <?php } ?>   name="privileges_countryall"> <?php //echo $this->Lang["COUNTRY_ALL"]; ?></label></td>
				  */ ?>
                       </tr>
                       
                       
                       <tr>
                         <td></td>
                                <td></td>
                        <table class="list_table3 fl clr show_details_table show_details_table_new">
                                <tr>
                                <td width="200"><label><?php echo $this->Lang["MANAG_NAME"]; ?></label></td>
                                
                                <td width="100"><label><?php echo $this->Lang["VIEW"]; ?></label></td>
                                <td width="100"><label><?php echo $this->Lang["ADD"]; ?></label></td>
                                <td width="100"><label><?php echo $this->Lang["EDIT"]; ?></label></td>
                                <td width="100"><label><?php echo $this->Lang["BLOCK"]; ?> / <?php echo $this->Lang["UNBLOCK"]; ?></label></td>
                                 </tr>
                        
                                
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["DEALS"]; ?></label></td>
                               
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_deals" class="deals_check"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_deals_add'])) { ?>checked = "checked" <?php } ?> name="privileges_deals_add" class="privileges_deals"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_deals_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_deals_edit" class="privileges_deals"></td>
                                <td ><input type="checkbox" value="1" <?php if (isset($_POST['privileges_deals_block'])) { ?>checked = "checked" <?php } ?> name="privileges_deals_block" class="privileges_deals"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["PRODUCT"]; ?></label></td>
                               
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_products" class="products_check"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_products_add'])) { ?>checked = "checked" <?php } ?> name="privileges_products_add" class="privileges_products"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_products_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_products_edit" class="privileges_products"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_products_block'])) { ?>checked = "checked" <?php } ?> name="privileges_products_block" class="privileges_products"></td>
                                 </tr>
                                 
                                   <tr>
                                <td><label><?php echo $this->Lang["AUCTION"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_auctions" class="auctions_check"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_auctions_add'])) { ?>checked = "checked" <?php } ?> name="privileges_auctions_add" class="privileges_auctions"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_auctions_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_auctions_edit" class="privileges_auctions"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_auctions_block'])) { ?>checked = "checked" <?php } ?> name="privileges_auctions_block" class="privileges_auctions"></td>
                                 </tr>
                                  <tr>
                                <td><label><?php echo $this->Lang["FUND_REQ"]; ?></label></td>
                               
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_fundrequest" class="fundrequest_check"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_fundrequest_edit'])) { ?> checked = "checked" <?php } ?> name="privileges_fundrequest_edit" class="privileges_fundrequest" ></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["TRANS"]; ?></label></td>
                               
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_transactions" class="transactions_check"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                 
                                 <td><label><?php echo $this->Lang["SHOP"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_shop" class="shops_check"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_shop_add'])) { ?>checked = "checked" <?php } ?> name="privileges_shop_add" class="privileges_shop"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_shop_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_shop_edit" class="privileges_shop"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_shop_block'])) { ?>checked = "checked" <?php } ?> name="privileges_shop_block" class="privileges_shop"></td>
                                 </tr>
                                 <tr>
                                 
                                 <td><label><?php echo $this->Lang["SHIPP_MODULE"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_shipping" class="shipping_check"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_shipping_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_shipping_edit" class="privileges_shipping"></td>
                               <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                 
                                 <td><label><?php echo $this->Lang["TAC"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_tac" class="tac_check"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_tac_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_tac_edit" class="privileges_tac"></td>
                               <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                 
                                 <td><label><?php echo $this->Lang["RET_POL"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_return_policy" class="return_policy_check"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_return_policy_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_return_policy_edit" class="privileges_return_policy"></td>
                               <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                 
                                 <td><label><?php echo $this->Lang["ABOUT_US_PAGE"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_about_us" class="about_us_check"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_about_us_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_about_us_edit" class="privileges_about_us"></td>
                               <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                 
                                 <td><label><?php echo $this->Lang["STORE_PERSONALIZED"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_personalized_store" class="personalized_check"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_personalized_store_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_personalized_store_edit" class="privileges_personalized"></td>
                               <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["NEWSLETTER"]; ?></label></td>
                               
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_newsletter" class="newsletter_check"></td>
                                 <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_newsletter_add'])) { ?> checked = "checked" <?php } ?> name="privileges_newsletter_add" class="privileges_newsletter" ></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                  <tr>
                                <td><label><?php echo $this->Lang["ATTIBUTSS"]; ?></label></td>
                              
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_attributs" class="attributs_check"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_attributs_add'])) { ?>checked = "checked" <?php } ?> name="privileges_attributs_add" class="privileges_attributs"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_attributs_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_attributs_edit" class="privileges_attributs"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["CATEGORIE"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_categories" class="categories_check" ></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_categories_add'])) { ?>checked = "checked" <?php } ?> name="privileges_categories_add" class="privileges_categories"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_categories_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_categories_edit" class="privileges_categories"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                <td><label><?php echo $this->Lang["ATTRIBUTES"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_specification" class="specification_check" ></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_specification_add'])) { ?>checked = "checked" <?php } ?> name="privileges_specification_add" class="privileges_specification"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_specification_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_specification_edit" class="privileges_specification"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 <tr>
                                 
                                 <td><label><?php echo $this->Lang["GIFT"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" checked = "checked" name="privileges_gift" class="gift_check"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_gift_add'])) { ?>checked = "checked" <?php } ?> name="privileges_gift_add" class="privileges_gift"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_gift_edit'])) { ?>checked = "checked" <?php } ?> name="privileges_gift_edit" class="privileges_gift"></td>
                                <td><input type="checkbox" value="1" <?php if (isset($_POST['privileges_gift_block'])) { ?>checked = "checked" <?php } ?> name="privileges_gift_block" class="privileges_gift"></td>
                                 </tr>
                                 <tr>
                                 <input type="hidden" name="merchant_id" value="<?php echo $this->user_id;?>">
                                 
                                  
                                 
                                 
                                 
                        </table>
                           </tr>                 
                            
                      </table>
       
        </fieldset>
        </div>
                       <div class="mergent_det2">
        
        
                <table>
                        <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="submit" id="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>merchant/add-moderator.html'"/></td>
                        </tr>
                        </table>
       
        </div>
                 </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>





