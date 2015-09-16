<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<style>
.error{float: left;width: 50%; } 
</style>
<!-- Dependencies: JQuery and GMaps API should be loaded first -->
	<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<!-- CSS and JS for our code -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>css/map/jquery-gmaps-latlon-picker.css"/>
	<script src="<?php echo PATH; ?>js/map/jquery-gmaps-latlon-picker.js"></script>
  
<!-- SELLER SIGNUP -->
    <div class="contianer_outer">
        <div class="contianer_inner">
            <div class="contianer seller_t">
                <h2 class="seller_sign_title"><?php echo $this->Lang['WEL_SEL_SIGN']; ?></h2>
                <p class="seller_sign_info"><?php echo $this->Lang['YOU_GUIDED_CRTE_STRE']; ?></p>
                <div class="seller_signup">
                       <div class="seller_signup_menu clearfix">
                        <div class="seller_signup_introduction">
                            <span>01</span>
                            <p><?php echo $this->Lang['INTRO']; ?></p>
                        </div>
                        <div class="seller_signup_form_submit">
                            <span>02</span>
                            <p><?php echo $this->Lang['SIGN_UP']; ?></p>                            
                        </div>
                        <?php /*<div class="seller_signup_finish">                            
                            <span>03</span>
                            <p><?php echo $this->Lang['SECTOR_SEL']; ?></p>                            
                        </div>*/?>
                        <div class="seller_signup_finish active_tab">                            
                            <span>03</span>
                            <p><?php echo $this->Lang['FINISH']; ?></p>                            
                        </div>
                        
                    </div>
               <form action="" method="post" name="signup4"  id="signup4" enctype="multipart/form-data" >
		<div class="payouter_block pay_br">
                   <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['CRTE_YR_STRE']; ?>: <?php echo $this->Lang['FINISH']; ?></h3>
                        <div class="p_inner_block clearfix">
                            <div class="payment_form_section">
                            <div class="payment_form merchant_paymet_form">
                                <ul>
                                    <li>
                                        <label><?php echo $this->Lang["STORE_NAME"]; ?> <span style="color:red">*</span>:</label>
                                 <div class="fullname">
                                 <input type="text" name="storename" class="required" placeholder="<?php echo $this->Lang["ENTER_STORE_NAME"]; ?>"  value="<?php if(!isset($this->form_error['storename']) && isset($this->userPost['storename'])){echo $this->userPost['storename'];}?>" autofocus />
				<em><?php if(isset($this->form_error['storename'])){ echo $this->form_error["storename"]; }?></em>
                                 </div>
                             </li>
                             
                              <li>
                                        <label><?php echo $this->Lang["USER_NAME"]; ?> <span style="color:red">*</span>:</label>
                                 <div class="fullname">
                                 <input type="text" name="username" class="required" placeholder="<?php echo $this->Lang["ENTER_STORE_USER_NAME"]; ?>"  value="<?php if(!isset($this->form_error['username']) && isset($this->userPost['username'])){echo $this->userPost['username'];}?>" autofocus />
				<em><?php if(isset($this->form_error['username'])){ echo $this->form_error["username"]; }?></em>
                                 </div>
                             </li>
                             
                              <li>
                                        <label><?php echo $this->Lang["EMAIL_ID"]; ?> <span style="color:red">*</span>:</label>
                                 <div class="fullname">
                                 <input type="text" name="store_email_id" id="store_email_id"  class="required" placeholder="<?php echo $this->Lang["ENTER_STORE_EMAIL_ID"]; ?>"  value="<?php if(!isset($this->form_error['store_email_id']) && isset($this->userPost['store_email_id'])){echo $this->userPost['store_email_id'];}?>" autofocus />
				<em><?php if(isset($this->form_error['store_email_id'])){ echo $this->form_error["store_email_id"]; }?></em>
                                 </div>
                             </li>
                             
                            <li>
                             <label><?php echo $this->Lang["PHONE"]; ?> <span style="color:red">*</span>:</label>
                                 <div class="fullname">
									<input type="text" name="mobile" maxlength="15" class="required number" placeholder="<?php echo $this->Lang["ENTER_PHONE"]; ?>" value="<?php if(!isset($this->form_error['mobile']) && isset($this->userPost['mobile'])){echo $this->userPost['mobile'];}?>"/>
                                     <em><?php if(isset($this->form_error['mobile'])){ echo $this->form_error["mobile"]; }?></em>
                                 </div>
                                </li>
                            
                                 <li>
                                     <label><?php echo $this->Lang["ADDR1"]; ?> <span style="color:red">*</span>:</label>
                                 <div class="fullname">
                            <input type="text" name="address1" class="required" value="<?php if(isset($this->userPost['address1'])){echo $this->userPost['address1'];}?>" placeholder="<?php echo $this->Lang["ENTER_ADDR1"]; ?>" />
                            
								<em><?php if(isset($this->form_error['address1'])){ echo $this->form_error["address1"]; }?></em>
                                 </div>
                                     </li>
                                    <li>
                                        <label><?php echo $this->Lang["ADDR2"]; ?> <span style="color:red">*</span>:</label>
				 <div class="fullname">				
                            <input type="text" name="address2" class="required" value="<?php if(isset($this->userPost['address2'])){echo $this->userPost['address2'];}?>" placeholder="<?php echo $this->Lang["ENTER_ADDR2"]; ?>" />
                            
								<em><?php if(isset($this->form_error['address2'])){ echo $this->form_error["address2"]; }?></em>
                                 </div>
                                 </li>
                                 
                                <li>
                                <label><?php echo $this->Lang['COUNTRY']; ?> <span style="color:red">*</span>:</label>
                                <div class="fullname">
                                <select name="country" id="country" onchange="return city_change_payment_step(this.value);" class="select required">
                                <option value=""><?php echo $this->Lang["SEL_COUNTRY"]; ?></option> 
                                <?php foreach ($this->country_list as $c) { ?>
                                <option <?php  if(isset($this->userPost['country'])){ if ($c->country_id == $this->userPost['country']) { ?> selected <?php } } ?>  title="<?php echo $c->country_name; ?>" value="<?php echo $c->country_id; ?>" ><?php echo $c->country_name; ?></option>
                                <?php } ?>
                                </select> 
                                </div>
                                <em><?php if (isset($this->form_error['country'])) {
                                echo $this->form_error["country"];
                                } ?></em>
                                </li>
                            
                                <li class="frm_clr">
                                <label><?php echo $this->Lang['CITY']; ?> <span style="color:red">*</span>:</label>
                                <div class="fullname">
                                <select name="city" id="CitySD"  class="select required">
                                <option value=""><?php echo $this->Lang["COUNTRY_FIRST"]; ?></option>
                                <?php foreach ($this->all_city_list as $c) { ?>
                                <option  <?php  if(isset($this->userPost['city'])){ if ($c->city_id == $this->userPost['city']) { ?> selected <?php } } ?> title="<?php echo $c->city_name; ?>"value="<?php echo $c->city_id; ?>" ><?php echo $c->city_name; ?></option>
                                <?php } ?>
                                </select> 
                                </div>
                                <em><?php if (isset($this->form_error['city'])) {
                                echo $this->form_error["city"];
                                } ?></em>

                                </li>

                                <li class="frm_clr">
                                        <label style="width:480px"><?php echo $this->Lang["SEARCH_LOCATION"]; ?> <span style="color:red">*</span>:</label>
                                        <div class="fullname map_loc_section map_re_w">
                                        <div class="gllpLatlonPicker">
                                        <div class="top_popup_select2">        
                                        <input type="text" class="gllpSearchField required" style="width:370px">
                                        <input type="button" class="gllpSearchButton sign_submit"  value="<?php echo $this->Lang['SEARCH']; ?>">
                                        </div>
                                        <br/>
                                        
                                        <div class="gllpMap" style="width:480px"><?php echo $this->Lang['GOOG_MAP']; ?></div>
                                        <br/>
                                        
                                        <div class="top_popup_select2">
                                        <input type="text" name="latitude" placeholder="<?php echo $this->Lang["LATITUDE"]; ?>" class="gllpLatitude required" readonly value="<?php if(!isset($this->form_error['latitude']) && isset($this->userPost['latitude'])){echo $this->userPost['latitude'];}?>"/>
                                      
                                        <input type="text" name="longitude" placeholder="<?php echo $this->Lang["LONGITUDE"]; ?>" class="gllpLongitude required" readonly value="<?php if(!isset($this->form_error['longitude']) && isset($this->userPost['longitude'])){echo $this->userPost['longitude'];}?>" />
                                          <em><?php if(isset($this->form_error['latitude'])){ echo $this->form_error["latitude"]; }?></em>
                                        <em><?php if(isset($this->form_error['longitude'])){ echo $this->form_error["longitude"]; }?></em>
                                        </div>
                                        <input type="hidden" class="gllpZoom" value="3"/>
                                        <input type="hidden" class="gllpUpdateButton" value="update map">
                                        </div>
                                        </div>
                                </li>
                                
                                    <li>
                                        <label><?php echo $this->Lang["ZIP_CODE"]; ?>:</label>
                                 <div class="fullname">
									<input type="text" name="zipcode" maxlength="10" class="" value="<?php if(!isset($this->form_error['zipcode']) && isset($this->userPost['zipcode'])){echo $this->userPost['zipcode'];}?>" placeholder="<?php echo $this->Lang["ENTER_ZIP_CODE"]; ?>"/>
									<em><?php if(isset($this->form_error['zipcode'])){ echo $this->form_error["zipcode"]; }?></em>
                                 </div>
                                        </li>
                                    <li>
                                        <label><?php echo $this->Lang["WEBSITE"]; ?>: http://</label>
                                 <div class="fullname">
									<input type="text" name="website" placeholder="<?php echo $this->Lang["STORE_WEBSITE"]; ?>" value="<?php if(!isset($this->form_error['website']) && isset($this->userPost['website'])){echo $this->userPost['website'];}?>"/>
									
									<em><?php if(isset($this->form_error['website'])){ echo $this->form_error["website"]; }?></em>
                                 </div>
                                        </li>
					 <li>
					<label><?php echo $this->Lang["ABT"]; ?>:</label>
					<div class="fullname">
					<textarea  name="data"  class="required" placeholder="<?php echo $this->Lang['HELP_TOKNOW'];?>" maxlength="1000"><?php if(!isset($this->form_error['data']) && isset($this->userPost['data'])){echo $this->userPost['data'];}?></textarea>

					<em><?php if(isset($this->form_error['data'])){ echo $this->form_error["data"]; }?></em>
					</div>
				    </li>
                                    <li>
                                        <label><?php echo $this->Lang['IM_UP_S']; ?>:</label>
                                 <div class="fullname">
									<input type="file" name="image" class="required" />
									
									<em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                                 <label><?php echo $this->Lang['IM_UP_S']; ?> <?php echo STORE_DETAIL_WIDTH; ?> X <?php echo STORE_DETAIL_HEIGHT; ?> </label>
                                 </div>
                                   </li>
				   
                                </ul>
                                <div class="merchant_submit_buttons step3_new" id="submit32">
                                    <label>&nbsp;</label><input type="submit" id="merchant_step3" value="<?php echo $this->Lang['FINISH'];?>" class="sign_submit" />
                                    <a href="<?php echo PATH; ?>merchant-signup-step2.html" title="<?php echo $this->Lang['GO_BACK'];?>" class="sign_cancel"><?php echo $this->Lang['GO_BACK'];?></a>                        
                                </div>
                            </div>
                        </div>
                    </div>                    
               </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SELLER SIGNUP -->
<script src="<?php echo PATH.'themes/'.THEME_NAME.'/js/jquery.validate.js'; ?>" type="text/javascript"></script>
 <script>
 
    $(document).ready(function(){
         $("form#signup4").validate({
			 rules: {
				website: {
				  //required: true,
				  //url: true
				}
				
			  },
  
			 messages: {
				 
		   storename: {
			   required: "<?php echo $this->Lang['PLS_ENT_STR_NAM']; ?>"                         
		   },
		   
		    username: {
			   required: "<?php echo $this->Lang['ENTER_STORE_USER_NAME']; ?>"                         
		   },
		   
		    store_email_id: {
			   required: "<?php echo $this->Lang['ENTER_STORE_EMAIL_ID']; ?>"                         
		   },

		   city: {
			   required: "<?php echo $this->Lang['SELECT UR CITY HERE']; ?>"                         
		   },
		   
		   country: {
			   required: "<?php echo $this->Lang['SELECT UR COUNTRY HERE']; ?>"                         
		   },

		   /*latitude: {
				required:"<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>",
			},
			
			longitude: {
				required:"<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>",
			}, */
		   
		   address1: {
			   required: "<?php echo $this->Lang['PLS_ENT_VLD_ADDR']; ?>"                         
		   },
			address2: {
			   required: "<?php echo $this->Lang['PLS_ENT_VLD_ADDR']; ?>"                         
		   },
		  mobile : {
			   required: "<?php echo $this->Lang['PLZ_ETR_PHO']; ?>",
			   number: "<?php echo $this->Lang['PLS_ENT_NO']; ?>"                             
			},
		zipcode : {
		   required: "<?php echo $this->Lang['PLS_ENT_ZIP']; ?>",
		   number: "<?php echo $this->Lang['PLS_ENT_NO']; ?>"                             
		},
		//website : {
		   //required: "<?php echo $this->Lang['PLS_ENT_URL']; ?>",
		   //url: "<?php echo $this->Lang['PLS_ENT_URL']; ?>"                             
		//},
		data : {
		   required: "<?php echo $this->Lang['PLZ_DESCRIBE']; ?>"
		},
		
    },
 submitHandler: function(form) {
     
   // some other code
   // maybe disabling submit button
   // then:
	$('div#submit').hide();
   form.submit();
 }
});
});
 
 </script>
