<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script >
	$(document).ready(function () {
		var deal=$(".deals_check").is(':checked');
		var product=$(".products_check").is(':checked'); 
		var auction=$(".auctions_check").is(':checked'); 
		var customer= $(".customer_check").is(':checked'); 
		var merchant= $(".merchant_check").is(':checked'); 
		var blogs= $(".blogs_check").is(':checked'); 
		var cms=  $(".cms_check").is(':checked'); 
		var attributs=   $(".attributs_check").is(':checked'); 
		var category=   $(".categories_check").is(':checked'); 
		var country=   $(".country_check").is(':checked'); 
		var city=   $(".city_check").is(':checked');
		var cityall=   $(".cityall").is(':checked'); 
		var countryall=   $(".countryall").is(':checked'); 
		
		var customercare=   $(".customercare_check").is(':checked'); 
		var banner=   $(".banner_check").is(':checked'); 
		var specification=   $(".specification_check").is(':checked'); 
		var sector =   $(".sector_check").is(':checked'); 
		var ads =   $(".ads_check").is(':checked'); 
		var faq =   $(".faq_check").is(':checked'); 
		var newsletter =   $(".newsletter_check").is(':checked'); 
		
		if(deal ==false )
		{
			$(".privileges_deals").prop("disabled", true).prop('checked', false);
			
		}if(product ==false){
			
			$(".privileges_products").prop("disabled", true).prop('checked', false);
		}if(auction==false)
		{
			$(".privileges_auctions").prop("disabled", true).prop('checked', false);
		}if(customer == false)
		{
			$(".privileges_customer").prop("disabled", true).prop('checked', false);
		}if(merchant ==false)
		{
			$(".privileges_merchant").prop("disabled", true).prop('checked', false);
		}if(blogs == false)
		{
				
			$(".privileges_blogs").prop("disabled", true).prop('checked', false);
		}if(cms ==false)
		{
			  $(".privileges_cms").prop("disabled", true).prop('checked', false);
		 }if(attributs == false)
		  {
			   $(".privileges_attributs").prop("disabled", true).prop('checked', false);
		}if(category == false)
		{
			 $(".privileges_categories").prop("disabled", true).prop('checked', false);
		}if(country == false)
		{
			$(".privileges_country").prop("disabled", true).prop('checked', false);
			$(".countryall").prop("disabled", true).prop('checked', false);
		}if(city ==false)
		{
			 $(".privileges_city").prop("disabled", true).prop('checked', false);
			 $(".cityall").prop("disabled", true).prop('checked', false);
		}
		if(customercare == false){
			$(".privileges_customercare").prop("disabled", true).prop('checked', false);
		}
		if(banner == false){
			$(".privileges_banner").prop("disabled", true).prop('checked', false);
		}
		if(specification == false){
			$(".privileges_specification").prop("disabled", true).prop('checked', false);
		}
		if(sector == false){
			$(".privileges_sector").prop("disabled", true).prop('checked', false);
		}
		if(ads == false){
			$(".privileges_ads").prop("disabled", true).prop('checked', false);
		}
		if(faq == false){
			$(".privileges_faq").prop("disabled", true).prop('checked', false);
		}
		if(newsletter == false){
			$(".privileges_newsletter").prop("disabled", true).prop('checked', false);
		}
		
			  
		var numberOfChecked = $('input:checkbox:checked').length;
		if(numberOfChecked == 77)
		{
			$('#checkall').prop('checked', true);
		}
		else
		{
			$('#checkall').prop('checked', false);
		}
		
		$(".privileges_deals, .privileges_products, .privileges_auctions,.privileges_customer,.privileges_merchant,.privileges_blogs,.privileges_cms,.transactions_check,.fundrequest_check,.daily_newsletter_check,.privileges_attributs,.privileges_categories,.privileges_country,.privileges_city,.privileges_sector,.privileges_storecredit,.privileges_customercare,.privileges_banner,.privileges_specification,.privileges_ads,.privileges_faq,.privileges_newsletter,.privileges_fundrequest").on('click', function (e) {
			var isCheck = $(this).is(':checked');
			if (isCheck)
			{
				var numberOfChecked = $('input:checkbox:checked').length;
				if(numberOfChecked == 77)
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
         $(".customer_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_customer").prop("disabled", false);
                
            } else {
              $(".privileges_customer").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".merchant_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_merchant").prop("disabled", false);
                
            } else {
              $(".privileges_merchant").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
         $(".blogs_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_blogs").prop("disabled", false);
                
            } else {
              $(".privileges_blogs").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
         $(".cms_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_cms").prop("disabled", false);
                
            } else {
              $(".privileges_cms").prop("disabled", true).prop('checked', false);
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
         $(".country_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_country").prop("disabled", false);
				 $(".countryall").prop("disabled", false);
                
            } else {
              $(".privileges_country").prop("disabled", true).prop('checked', false);
              $(".countryall").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
         $(".city_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_city").prop("disabled", false);
				 $(".cityall").prop("disabled", false);
                
            } else {
              $(".privileges_city").prop("disabled", true).prop('checked', false);
              $(".cityall").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
	     $(".sector_check").on('click', function (e) {
	    var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_sector").prop("disabled", false);
				// $(".cityall").prop("disabled", false);
                
            } else {
              $(".privileges_sector").prop("disabled", true).prop('checked', false);
	      //$(".cityall").prop("disabled", true).prop('checked', false);
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
          $(".customercare_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_customercare").prop("disabled", false);
                
            } else {
              $(".privileges_customercare").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".banner_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_banner").prop("disabled", false);
                
            } else {
              $(".privileges_banner").prop("disabled", true).prop('checked', false);
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
         
         $(".ads_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_ads").prop("disabled", false);
                
            } else {
              $(".privileges_ads").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        $(".faq_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_faq").prop("disabled", false);
                
            } else {
              $(".privileges_faq").prop("disabled", true).prop('checked', false);
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
        $(".storecredit_check").on('click', function (e) {
			var isCheck = $(this).is(':checked');
            if (isCheck) { 
				 $(".privileges_storecredit").prop("disabled", false);
                
            } else {
              $(".privileges_storecredit").prop("disabled", true).prop('checked', false);
              $('#checkall').prop('checked', false);
            }
        });
        
});
</script>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
       <form method="post" class="admin_form" name="edit_users" >
    <div class="content_middle">
      
        <?php foreach($this->user_data as $u){ ?>
                 <div class="mergent_det">
                       <fieldset>
                       <legend><?php echo $this->Lang['EDIT_MODE']; ?></legend>
                <table>
                        <tr> 
                                <td><label><?php echo $this->Lang["FIRST_NAME"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="firstname" value="<?php echo $u->firstname;?>"/>
                                <em><?php if(isset($this->form_error['firstname'])){ echo $this->form_error["firstname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr> 
                                <td><label><?php echo $this->Lang["LAST_NAME"]; ?></label><span></span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="lastname" value="<?php echo $u->lastname;?>"/>
                                 <em><?php if(isset($this->form_error['lastname'])){ echo $this->form_error["lastname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["EMAIL_F"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><label><?php echo $u->email;?></label>
                                <input type="hidden" name="email" value="<?php echo $u->email;?>"/>
                                <em><?php if(isset($this->form_error['email'])){ echo $this->form_error["email"]; }?></em>
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang["PHONE"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mobile" value="<?php echo $u->phone_number;?>"/>
                                <em><?php if(isset($this->form_error['mobile'])){ echo $this->form_error["mobile"]; }?></em>
                                </td>
                        </tr> 
                          <tr>
                                <td><label><?php echo $this->Lang["ADDR1"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address1" value="<?php echo $u->address1;?>"/>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["ADDR2"]; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address2" value="<?php echo $u->address2;?>"/>
                                </td>
                        </tr>                            
                       <tr>
                    <td><label><?php echo $this->Lang["SEL_COUNTRY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="country" class="country" onchange="return city_change(this.value);">
                        <option value=""><?php echo $this->Lang["SEL_COUNTRY"]; ?></option>
                        
                        
                        <?php foreach($this->country_list as $d){ ?>
                        <option value="<?php echo $d->country_id ?>" <?php if($d->country_id==$u->country_id) { ?> selected="selected" <?php } ?>><?php echo $d->country_name; ?></option>
                          <?php }  ?>
                        </select>
                        <em><?php if(isset($this->form_error["country"])){ echo $this->form_error["country"]; }?></em>
                      
                     </td>
                     </tr>   

                    
                       <tr id="CitySD">
                    <td><label><?php echo $this->Lang["SEL_CITY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="city">
                        <option value="" <?php if($u->city_id==0){ ?>selected="selected" <?php } ?>><?php echo $this->Lang["CITY_FIRST"]; ?></option>
	                <?php foreach($this->city_list as $d){ if($u->country_id == $d->country_id) { ?>
	                <option value=<?php echo $d->city_id; ?> <?php if($u->city_id==$d->city_id) { ?> selected="selected" <?php  } ?>><?php echo $d->city_name; ?></option>
	                <?php } }  ?> 
                        </select>
                        <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em>
					</td>
                        </tr> 
                        
                           </table>
       
        </fieldset>
        </div>
                        
                        <?php if(count($this->moderator_list) > 0) { ?>
                                
        
        
        <div class="mergent_det2">
                       <fieldset>
                       <legend><?php echo $this->Lang["SELECT_MOD_PRIVI"]; ?></legend>
        
        
                <table>
                       <tr>
                        <td></td>
                                <td></td> 
                                <td><label><input type="checkbox" id="checkall" onclick="checkboxcheckAll_admin_moderator('edit_users', 'checkall')"  name="checkall"> <?php echo $this->Lang["SELECT_ALL"]; ?></label></td>
				
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
                        
                                
                                  <?php foreach($this->moderator_list as $mo ) { ?>
                                 <tr>
                                <td><label><?php echo $this->Lang["DEALS"]; ?></label> </td>
                             
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_deals == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_deals" class="deals_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_deals_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_deals_add" class="privileges_deals"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_deals_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_deals_edit" class="privileges_deals"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_deals_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_deals_block" class="privileges_deals"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["PRODUCT"]; ?> </label></td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_products == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_products" class="products_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_products_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_products_add" class="privileges_products"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_products_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_products_edit" class="privileges_products"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_products_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_products_block" class="privileges_products"></td>
                                 </tr>
                                 
                                   <tr>
                                <td><label><?php echo $this->Lang["AUCTION"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_auctions == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_auctions" class="auctions_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_auctions_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_auctions_add" class="privileges_auctions"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_auctions_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_auctions_edit" class="privileges_auctions"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_auctions_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_auctions_block" class="privileges_auctions"></td>
                                 </tr>
                                 
                                   <tr>
                                <td><label><?php echo $this->Lang["CUSTOMERS"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customer == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_customer" class="customer_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customer_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_customer_add" class="privileges_customer"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customer_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_customer_edit" class="privileges_customer"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customer_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_customer_block" class="privileges_customer"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["MERCHANTS"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_merchant == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_merchant" class="merchant_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_merchant_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_merchant_add" class="privileges_merchant"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_merchant_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_merchant_edit" class="privileges_merchant"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_merchant_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_merchant_block" class="privileges_merchant"></td>
                                 </tr>
                                 
                                  <tr>
									<td><label><?php echo $this->Lang["FUND_REQ"]; ?></label></td>
								   
									<td><input type="checkbox" value="1" <?php if($mo->privileges_fundrequest == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_fundrequest" class="fundrequest_check"></td>
									<td><input type="checkbox" value="1"  disabled></td>
									<td><input type="checkbox" value="1" <?php if($mo->privileges_fundrequest_edit == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_fundrequest_edit" class="privileges_fundrequest" ></td>
									<td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["TRANS"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_transactions == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_transactions" class="transactions_check"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["STR_CRD_ORD"]; ?></label></td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_storecredit == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_storecredit" class="storecredit_check"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 
                                 
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["SEND_DAILY_DEALS"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_daily_newsletter == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_daily_newsletter" class="daily_newsletter_check"></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                <td><input type="checkbox" value="1"  disabled></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["BLOGS1"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_blogs == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_blogs"class="blogs_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_blogs_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_blogs_add" class="privileges_blogs"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_blogs_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_blogs_edit" class="privileges_blogs"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_blogs_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_blogs_block" class="privileges_blogs"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["CUSTOMER_CARE"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customercare == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_customercare"class="customercare_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customercare_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_customercare_add" class="privileges_customercare"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customercare_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_customercare_edit" class="privileges_customercare"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_customercare_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_customercare_block" class="privileges_customercare"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["BANA"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_banner == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_banner"class="banner_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_banner_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_banner_add" class="privileges_banner"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_banner_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_banner_edit" class="privileges_banner"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_banner_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_banner_block" class="privileges_banner"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["ATTIBUTSS"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_attributs == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_attributs" class="attributs_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_attributs_add == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_attributs_add" class="privileges_attributs"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_attributs_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_attributs_edit" class="privileges_attributs"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_attributs_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_attributs_block" class="privileges_attributs"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["ATTIBUTS"]; ?></label> </td>
                                
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_specification == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_specification" class="specification_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_specification_add == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_specification_add" class="privileges_specification"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_specification_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_specification_edit" class="privileges_specification"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_specification_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_specification_block" class="privileges_specification"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["COUNTRY"]; ?></label> </td>
                               
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_country == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_country" class="country_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_country_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_country_add" class="privileges_country"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_country_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_country_edit" class="privileges_country"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_country_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_country_block" class="privileges_country"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["CITY"]; ?></label> </td>
                               
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_city == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_city"class="city_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_city_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_city_add" class="privileges_city"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_city_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_city_edit" class="privileges_city"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_city_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_city_block" class="privileges_city"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["CATEGORIE"]; ?></label> </td>
                               
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_categories == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_categories" class="categories_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_categories_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_categories_add" class="privileges_categories"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_categories_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_categories_edit" class="privileges_categories"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_categories_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_categories_block" class="privileges_categories"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["SECTOR"]; ?></label> </td>
                               
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_sector == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_sector" class="sector_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_sector_add == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_sector_add" class="privileges_sector"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_sector_edit == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_sector_edit" class="privileges_sector"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_sector_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_sector_block" class="privileges_sector"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["CMS"]; ?></label> </td>
								<td><input type="checkbox" value="1" <?php if($mo->privileges_cms == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_cms" class="cms_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_cms_add == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_cms_add" class="privileges_cms"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_cms_edit == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_cms_edit" class="privileges_cms"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_cms_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_cms_block" class="privileges_cms"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["ADS"]; ?></label> </td>
								<td><input type="checkbox" value="1" <?php if($mo->privileges_ads == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_ads" class="ads_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_ads_add == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_ads_add" class="privileges_ads"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_ads_edit == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_ads_edit" class="privileges_ads"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_ads_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_ads_block" class="privileges_ads"></td>
                                 </tr>
                                 
                                 <tr>
                                <td><label><?php echo $this->Lang["FAQ"]; ?></label> </td>
								<td><input type="checkbox" value="1" <?php if($mo->privileges_faq == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_faq" class="faq_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_faq_add == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_faq_add" class="privileges_faq"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_faq_edit == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_faq_edit" class="privileges_faq"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_faq_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_faq_block" class="privileges_faq"></td>
                                 </tr>
                                 
                                  <tr>
                                <td><label><?php echo $this->Lang["NEWS_TEMP"]; ?></label> </td>
								<td><input type="checkbox" value="1" <?php if($mo->privileges_newsletter == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_newsletter" class="newsletter_check"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_newsletter_add == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_newsletter_add" class="privileges_newsletter"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_newsletter_edit == "1" ){  ?>checked = "checked" <?php } ?> name="privileges_newsletter_edit" class="privileges_newsletter"></td>
                                <td><input type="checkbox" value="1" <?php if($mo->privileges_newsletter_block == "1" ){  ?>checked = "checked" <?php } ?>name="privileges_newsletter_block" class="privileges_newsletter"></td>
                                 </tr>
				                 
                                   <?php } ?>
                                 
                                 
                        </table>
                           </tr>
			     
                           
                           </table>
       
        </fieldset>
        </div>
                                 
                        
                        <?php } ?>
                        
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
                                <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>admin/manage-moderator.html"'/></td>
                        </tr>
                      
                </table>
        </form>
          <?php  }?>
	   </div>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>

