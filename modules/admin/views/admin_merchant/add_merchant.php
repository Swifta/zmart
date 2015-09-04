<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>


 <head>
	<!-- Dependencies: JQuery and GMaps API should be loaded first -->
	<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<!-- CSS and JS for our code -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>css/map/jquery-gmaps-latlon-picker.css"/>
	<script src="<?php echo PATH; ?>js/map/jquery-gmaps-latlon-picker.js"></script>
	<SCRIPT language="Javascript">
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode        
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }
   </SCRIPT>
	
</head>
<script> 
	function atleast_onecheckbox(e) {
          if ($("input[type=checkbox]:checked").length === 0) {
              e.preventDefault();
              alert('Shipping Method Should be Mandatory, You should choose any one of the shipping method');
              return false;
          }
}
	</script>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    <div class="gllpLatlonPicker">
            <form method="post" onclick="return atleast_onecheckbox(event)" class="admin_form" enctype="multipart/form-data">
    		<div class="mergent_det">
            <fieldset>
            <legend><?php echo $this->Lang["MERCHANT_ACC"]; ?></legend>

                <table>
                
                         <tr>
                                <td><label><?php echo $this->Lang["FIRST_NAME"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input autofocus type="text" name="firstname" maxlength="32"  value="<?php if(!isset($this->form_error['firstname']) && isset($this->userPost['firstname'])){echo $this->userPost['firstname'];}?>"/>
                                <em><?php if(isset($this->form_error['firstname'])){ echo $this->form_error["firstname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["LAST_NAME"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="lastname"  maxlength="32" value="<?php if(!isset($this->form_error['lastname']) && isset($this->userPost['lastname'])){echo $this->userPost['lastname'];}?>"/>
                                <em><?php if(isset($this->form_error['lastname'])){ echo $this->form_error["lastname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["EMAIL_F"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="email" maxlength="255" value="<?php if(!isset($this->form_error['email']) && isset($this->userPost['email'])){echo $this->userPost['email'];}?>"/>
                                <em><?php if(isset($this->form_error['email'])){ echo $this->form_error["email"]; }?></em>
                                </td>
                        </tr>

                         <?php /*<tr>
                                <td><label><?php echo $this->Lang["RE_PASSWORD"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="password" name="cpassword" maxlength="16"/>
                                <em><?php if(isset($this->form_error['cpassword'])){ echo $this->form_error["cpassword"]; }?></em>
                                </td>
                        </tr>  */ ?>
                        <tr>
                                <td><label><?php echo $this->Lang["PHONE"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>

                                <td><input type="text" name="mr_mobile" maxlength="15"  value="<?php if(!isset($this->form_error['mr_mobile']) && isset($this->userPost['mr_mobile'])){echo $this->userPost['mr_mobile'];}?>"/>
                                <em><?php if(isset($this->form_error['mr_mobile'])){ echo $this->form_error["mr_mobile"]; }?></em>
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang["ADDR1"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mr_address1" maxlength="100" value="<?php if(isset($this->userPost['mr_address1'])){echo $this->userPost['mr_address1'];}?>"/>
                                <em><?php if(isset($this->form_error['mr_address1'])){ echo $this->form_error["mr_address1"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["ADDR2"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mr_address2" maxlength="100" value="<?php if(isset($this->userPost['mr_address2'])){echo $this->userPost['mr_address2'];}?>"/>
                                <em><?php if(isset($this->form_error['mr_address2'])){ echo $this->form_error["mr_address2"]; }?></em>
                                </td>
                        </tr> 
                        <tr>
                                <td><label><?php echo $this->Lang["PAYMENT_ACC"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="payment_acc" maxlength="255" value="<?php if(!isset($this->form_error['payment_acc']) && isset($this->userPost['payment_acc'])){echo $this->userPost['payment_acc'];}?>"/>

                                <em><?php if(isset($this->form_error['payment_acc'])){ echo $this->form_error["payment_acc"]; }?></em>
                                </td>
                        </tr>  
                        <tr>
                                <td><label>Shipping method<span>*</span></label></td>
                                <td><label>:</label></td>
                                <td>
                                 <table style="border: 1px solid #999; border-collapse: collapse; width:242px;">
                                        <?php if($this->free_shipping_setting == 1){ ?>
                                       <tr><td> <input type="checkbox" name="free" value="1" checked>Free Shipping</td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="free" value="0" >
                                        <?php } if($this->flat_shipping_setting == 1){ ?>
                                        <tr><td><input type="checkbox" name="flat" value="1" checked>Flat Shipping</td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="flat" value="0" >
                                         <?php } if($this->per_product_setting == 1){ ?>
                                       <tr><td> <input type="checkbox" name="product" value="1" checked>Per product base Shipping</td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="product" value="0" >
                                         <?php } if($this->per_quantity_setting == 1){ ?>
                                        <tr><td><input type="checkbox" name="quantity" value="1" checked>Per quantity base Shipping</td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="quantity" value="0" >
                                         <?php } if($this->aramex_setting == 1){ ?>
                                        <tr><td><input type="checkbox" name="aramex" value="1" checked>Aramex Shipping</td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="aramex" value="0" >
                                        <?php } ?>
                                 </table>
                                 </td>
                        </tr>
                       </table>
            
                       </fieldset>
                       </div>
                       <div class="mergent_det2">
                       <fieldset>
                       <legend><?php echo $this->Lang["STORE_DETAILS"]; ?></legend>
     
                     <table>
                       
                       
                         <tr>
                                <td width="110px;"><label><?php echo $this->Lang["STORE_NAME"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="storename" maxlength="255"  value="<?php if(!isset($this->form_error['storename']) && isset($this->userPost['storename'])){echo $this->userPost['storename'];}?>"/>
                                <em><?php if(isset($this->form_error['storename'])){ echo $this->form_error["storename"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["USER_NAME"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="username" maxlength="255" value="<?php if(!isset($this->form_error['username']) && isset($this->userPost['username'])){echo $this->userPost['username'];}?>" />
                                <em><?php if(isset($this->form_error['username'])){ echo $this->form_error["username"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["EMAIL_ID"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="store_email" maxlength="255" value="<?php if(!isset($this->form_error['store_email']) && isset($this->userPost['store_email'])){echo $this->userPost['store_email'];}?>" />
                                <em><?php if(isset($this->form_error['store_email'])){ echo $this->form_error["store_email"]; }?></em>
                                </td>
                        </tr>

                        <tr>
                        <td><label><?php echo $this->Lang["SECTOR"]; ?></label><span>*</span></td>
                        <td><label>:</label></td>
                        <td>
                                <select autofocus name="sector" onchange="return change_sector(this.value);">
				     
                                <?php 
                                if(!isset($this->form_error["sector"]) && isset($this->userPost["sector"])){ 
				    
				    if($this->userPost["sector"] != 0){ ?>
				       
                                      <?php   foreach($this->sector_list as $c){
                                                if($c->sector_id == $this->userPost["sector"]){ ?>
                                                <option value="<?php echo $c->sector_id; ?>" selected="selected"><?php echo ucfirst($c->sector_name); ?></option> 
                                                <?php 
                                                }
                                        }
				    }
                                } else { ?>
                                        <option value=""> <?php echo $this->Lang['SELECT_SECTOR']; ?> </option>
					            <?php } foreach($this->sector_list as $c){ ?>
                                        <option value="<?php echo $c->sector_id; ?>"><?php echo ucfirst($c->sector_name); ?></option>  

                                <?php } ?>
                                </select>
                                <em><?php if(isset($this->form_error["sector"])){ echo $this->form_error["sector"]; }?></em>
                        </td>
                        </tr>
                        <tr id="subsector" class="subsector_list">
                                <td><label><?php echo $this->Lang["SUBSECTOR"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>

                                <td>
									 <?php if(!isset($this->form_error['sector']) && isset($_POST['sector'])){ ?>
									 <select name="subsector" >
									 <?php foreach($this->sub_sector_list as $s){  ?>

				<?php if($s->main_sector_id == $_POST['sector']){
						$theme_check = true;
						$theme_name = strtolower($s->sector_name);
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/controllers/'.$theme_name.'.php'))
							$theme_check = false;
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/models/'.$theme_name.'.php'))
							$theme_check = false;
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/config/routes.php'))
							$theme_check = false;
						if(!is_dir(DOCROOT.'themes/'.THEME_NAME.'/css/'.$theme_name))
							$theme_check = false;
						if(!is_dir(DOCROOT.'application/views/themes/'.THEME_NAME.'/'.$theme_name))
							$theme_check = false;
						if($theme_check==true){ ?>
			                <option value="<?php echo $s->sector_id; ?>" <?php if(isset($_POST['subsector'])){ if($_POST['subsector'] == $s->sector_id){ ?> selected <?php } } ?> > <?php echo $s->sector_name; ?></option>
				<?php }} } ?>
				 </select>
			<?php } else{ ?>
			<select name="subsector" >
                                <option value=""><?php echo $this->Lang['SELECT_SECTORS_FIRST']; ?></option>
                               
                                </select>
                                 <?php }?>
                                <em><?php if(isset($this->form_error['subsector'])){ echo $this->form_error["subsector"]; }?></em>
                                </td>
                        </tr>

                        
                        <tr>
                                <td><label><?php echo $this->Lang["PHONE"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mobile" maxlength="15"  value="<?php if(!isset($this->form_error['mobile']) && isset($this->userPost['mobile'])){echo $this->userPost['mobile'];}?>"/>
                                <em><?php if(isset($this->form_error['mobile'])){ echo $this->form_error["mobile"]; }?></em>
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang["ADDR1"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address1" maxlength="255" value="<?php if(isset($this->userPost['address1'])){echo $this->userPost['address1'];}?>"/>
                                <em><?php if(isset($this->form_error['address1'])){ echo $this->form_error["address1"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["ADDR2"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address2" maxlength="255" value="<?php if(isset($this->userPost['address2'])){echo $this->userPost['address2'];}?>"/>
                                <em><?php if(isset($this->form_error['address2'])){ echo $this->form_error["address2"]; }?></em>
                                </td>
                        </tr>                     
                       
                        <tr>
                                <td><label><?php echo $this->Lang["SEL_COUNTRY"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td>
                                <select name="country" onchange="return city_change_merchant(this.value);">
                                <option value=""><?php echo $this->Lang["SEL_COUNTRY"]; ?></option>
                                <?php foreach($this->country_list as $d){ ?>
                                <option value="<?php echo $d->country_id ?>" <?php if(!isset($this->form_error['country']) && isset($_POST['country'])){ if($_POST['country'] == $d->country_id){ ?> selected <?php } } ?>><?php echo $d->country_name; ?></option>
                                <?php } ?>
                                </select>
                                <em><?php if(isset($this->form_error["country"])){ echo $this->form_error["country"]; }?></em>
                                </td>
                        </tr>

                        <tr id="CitySD">
                                <td><label><?php echo $this->Lang["SEL_CITY"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td>
                               <?php if(!isset($this->form_error['city']) && isset($_POST['city'])){ ?>
				<select name="city">
				<?php foreach($this->city_list as $s){ ?>
				<?php if($s->city_id == $_POST['city']){ ?>
			                <option value="<?php echo $s->city_id; ?>" <?php if(isset($_POST['city'])){ if($_POST['city'] == $s->city_id){ ?> selected <?php } } ?>><?php echo $s->city_name; ?></option>
				<?php } } ?>
		                </select>
			<?php } else{ ?>
		                <select name="city">
		                <option value=""> <?php echo $this->Lang["CITY_FIRST"]; ?></option>
		                </select>
                        <?php } ?>
                                <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em>
                                </td>
                        </tr> 
                        
                        <tr>
                                <td><label><?php echo $this->Lang["ZIP_CODE"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="zipcode" maxlength="10" value="<?php if(!isset($this->form_error['zipcode']) && isset($this->userPost['zipcode'])){echo $this->userPost['zipcode'];}?>"/>
                                <em><?php if(isset($this->form_error['zipcode'])){ echo $this->form_error["zipcode"]; }?></em>
                                </td>
                        </tr>
			  <tr>
                                <td><label><?php echo $this->Lang["ABOUT_US_PAGE"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td>
                                <textarea name="about_us" maxlength="1000"><?php if(!isset($this->form_error["about_us"])&&isset($this->userPost["about_us"])){ echo $this->userPost["about_us"]; }?></textarea>
                                <em><?php if(isset($this->form_error["about_us"])){ echo $this->form_error["about_us"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["META_KEY"]; ?></label></td>
                                <td><label>:</label></td>
                                <td>
                                <textarea name="meta_keywords"><?php if(!isset($this->form_error["meta_keywords"])&&isset($this->userPost["meta_keywords"])){ echo $this->userPost["meta_keywords"]; }?></textarea>
                                <em><?php if(isset($this->form_error["meta_keywords"])){ echo $this->form_error["meta_keywords"]; }?></em>
                                </td>
                        </tr>

                        <tr>
                                <td><label><?php echo $this->Lang["META_DESC"]; ?></label></td>
                                <td><label>:</label></td>
                                <td>
                                <textarea name="meta_description"><?php if(!isset($this->form_error["meta_description"])&&isset($this->userPost["meta_description"])){ echo $this->userPost["meta_description"]; }?></textarea>




                                <em><?php if(isset($this->form_error["meta_description"])){ echo $this->form_error["meta_description"]; }?></em>
                                </td>
                        </tr>
                        
                         <tr>
                                <td><label><?php echo $this->Lang["WEBSITE"]; ?><span>*</span></label></td>
                                <td><label>:http://</label></td>
                                <td><input type="text" name="website" maxlength="100" value="<?php if(!isset($this->form_error['website']) && isset($this->userPost['website'])){echo $this->userPost['website'];}?>"/>
                                <em><?php if(isset($this->form_error['website'])){ echo $this->form_error["website"]; }?></em>
                                </td>
                        </tr>
							<tr >
									  <td><label><?php echo $this->Lang['MAP_SEARCH_LO']; ?><span>*</span></label></td>
                                <td><label>:</label></td>
								  <td >
                       
                   
                    <input type="text" class="gllpSearchField">
		            <input type="button" class="gllpSearchButton" value="<?php echo $this->Lang['SEARCH']; ?>">
		            <br/><br/><br/>
		            <div class="gllpMap" ><?php echo $this->Lang['GOOG_MAP']; ?></div>
		           
                       
                        </td>
							</tr>  
							   <td><label><?php echo $this->Lang["LATITUDE"]; ?><span>*</span></label></td>
								<td><label>:</label></td>
								<td>
								<input type="text" onclick="show_popup();" name="latitude" class="gllpLatitude" readonly value="<?php if(!isset($this->form_error['latitude']) && isset($this->userPost['latitude'])){echo $this->userPost['latitude'];}?>"/>
								<em><?php if(isset($this->form_error['latitude'])){ echo $this->form_error["latitude"]; }?></em>
								</td>
								</tr>
								<tr>
								<td><label><?php echo $this->Lang["LONGITUDE"]; ?><span>*</span></label></td>
								<td><label>:</label></td>
								<td>
								<input type="text" name="longitude" class="gllpLongitude" readonly value="<?php if(!isset($this->form_error['longitude']) && isset($this->userPost['longitude'])){echo $this->userPost['longitude'];}?>"/>
								<em><?php if(isset($this->form_error['longitude'])){ echo $this->form_error["longitude"]; }?></em>
								<input type="hidden" class="gllpZoom" value="3"/>
								<input type="hidden" class="gllpUpdateButton" value="update map">
								</td>
						</tr>
					
					<?php /*	<tr>
                                <td><label><?php echo $this->Lang["LATITUDE"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="latitude" id="lat" onclick="show_popup();" readonly value="<?php if(!isset($this->form_error['latitude']) && isset($this->userPost['latitude'])){echo $this->userPost['latitude'];}?>"/>
                                <em><?php if(isset($this->form_error['latitude'])){ echo $this->form_error["latitude"]; }?></em>
                                </td>
                        </tr>
                        
                         <tr>
                                <td><label><?php echo $this->Lang["LONGITUDE"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="longitude" id="lng" readonly value="<?php if(!isset($this->form_error['longitude']) && isset($this->userPost['longitude'])){echo $this->userPost['longitude'];}?>"/>
                                <em><?php if(isset($this->form_error['longitude'])){ echo $this->form_error["longitude"]; }?></em>
                                </td>
                        </tr> */ ?>
                        
                        
                       
			 <tr>
                                <td><label><?php echo $this->Lang["COMMISION"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="commission" maxlength="3" onkeypress="return isNumberKey(event)"  value="<?php if(!isset($this->form_error['commission']) && isset($this->userPost['commission'])){echo $this->userPost['commission'];}?>"/>
				 <span class="pbl1">%</span>
                                <em><?php if(isset($this->form_error['commission'])){ echo $this->form_error["commission"]; }?></em>
                              
 </td>
			
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["STORES_IMG"]; ?></label></td>
                                <td><label>:</label></td>
                                <td>
                                <input type="file" name="image" />
                                <em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                                 <label><?php echo $this->Lang['IM_UP_S']; ?> <?php echo STORE_DETAIL_WIDTH; ?> X <?php echo STORE_DETAIL_HEIGHT; ?> </label>
                                </td>
                        </tr>                    
                     
                        <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" id="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/add-merchant.html'"/></td>
                        </tr>
                </table>
                
        </form>
        
        </div>
        
        
        
    </div>
        
</div>
<div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>

