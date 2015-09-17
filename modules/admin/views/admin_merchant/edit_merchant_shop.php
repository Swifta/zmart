<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<head>
   
 	<!-- Dependencies: JQuery and GMaps API should be loaded first -->
	
	<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

	<!-- CSS and JS for our code -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>css/map/jquery-gmaps-latlon-picker.css"/>
	<script src="<?php echo PATH; ?>js/map/jquery-gmaps-latlon-picker.js"></script>
      
    <script>
  
   $(document).ready(function(){					   		   
	    //Close Popups and Fade Layer
	    //Fade in the fade layer 
	    $('a#close8').live('click', function() { //When clicking on the close or fade layer...
		    $('#popup6').css({'display' : 'none'});
			    $('.popup_block5').css({'display' : 'none'});
			    $('#fade').css({'display' : 'none'});
	      	
		    return false;
	    });		
    });
	function show_popup()
    {
	$('.popup_block5').css({'display' : 'block'});
	
	
    }

</script>

</head>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
		<?php /*
	 <div id="popup6" class="popup_block5">
        <div class="login1">
          <div class="log_in_top1">
            <div class="share_top_lft">
              <div class="share_top_rgt">
                <div class="share_top_mid"> </div>
              </div>
            </div>
          </div>
          <div class="log_middle">
            <div class="con_mid_lft">
              <div class="con_mid_rgt">
                <div class="con_mid_mid">
					<form name="share" method="post" action="<?php echo PATH; ?>welcome/share_offers">
                  <div class="share_social">
                    <h1></h1>
                    <a class="share_close" id="close8">&nbsp;</a>
                    <div align="center" id="map" style="width: 500px; height: 400px"></div>                     
                      
                     </div> 
		            </form>
                  </div>                
                  
                </div>
              </div>
            </div>
          </div>
          <div class="log_bot">
            <div class="con_bot_lft_r">
              <div class="con_bot_rgt_r">
                <div class="con_bot_mid_r"> </div>
              </div>
            </div>
          </div>
       
        </div>
		*/ ?>
      <div class="mergent_det">
      <fieldset>
      <legend><?php echo $this->template->title; ?></legend>      
        <?php foreach($this->user_data as $u){ ?>
        
            <script>
/*	function show_popup()
    {
	$('.popup_block5').css({'display' : 'block'});
	
	
	  if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        var center = new GLatLng(<?php echo $u->latitude;?>, <?php echo $u->longitude;?>);
        map.setCenter(center, 7);
        geocoder = new GClientGeocoder();
        var marker = new GMarker(center, {draggable: true});  
        map.addOverlay(marker);
        document.getElementById("lat").value = center.lat().toFixed(5);
        document.getElementById("lng").value = center.lng().toFixed(5);

	  GEvent.addListener(marker, "dragend", function() {
       var point = marker.getPoint();
	      map.panTo(point);
       document.getElementById("lat").value = point.lat().toFixed(5);
       document.getElementById("lng").value = point.lng().toFixed(5);

        });


	 GEvent.addListener(map, "moveend", function() {
		  map.clearOverlays();
    var center = map.getCenter();
		  var marker = new GMarker(center, {draggable: true});
		  map.addOverlay(marker);
		  document.getElementById("lat").value = center.lat().toFixed(5);
	   document.getElementById("lng").value = center.lng().toFixed(5);


	 GEvent.addListener(marker, "dragend", function() {
      var point =marker.getPoint();
	     map.panTo(point);
      document.getElementById("lat").value = point.lat().toFixed(5);
	     document.getElementById("lng").value = point.lng().toFixed(5);

        });
 
        });

      }
    }
*/
</script>
<div class="gllpLatlonPicker">
        <form method="post" class="admin_form" name="edit_users" enctype="multipart/form-data">
                <table>
                                               
                         <tr>
                                <td><label><?php echo $this->Lang["STORE_NAME"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="storename"  maxlength="255" value="<?php echo $u->store_name;?>" autofocus /> 
                                <em><?php if(isset($this->form_error['storename'])){ echo $this->form_error["storename"]; }?></em>
                                </td>
                        </tr>
                        
                         <tr>
                                <td><label><?php echo $this->Lang["USER_NAME"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="username" maxlength="255" value="<?php echo $u->firstname;?>" />
                                <em><?php if(isset($this->form_error['username'])){ echo $this->form_error["username"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["EMAIL_ID"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="store_email" maxlength="255" value="<?php echo $u->email;?>" />
                                <em><?php if(isset($this->form_error['store_email'])){ echo $this->form_error["store_email"]; }?></em>
                                </td>
                        </tr>

                        <tr>
                        <td><label><?php echo $this->Lang["SECTOR"]; ?></label><span>*</span></td>
                        <td><label>:</label></td>
                        <td>
                                <select autofocus name="sector" onchange="return change_sector(this.value);">
                               
                                <?php foreach($this->sector_list as $c){ ?>
                                <option value="<?php echo $c->sector_id ?>" <?php if($c->sector_id==$u->store_sector_id) { ?> selected="selected" <?php } ?>><?php echo ucfirst($c->sector_name); ?></option>

                                <?php }  ?>
                                </select>
                                <em><?php if(isset($this->form_error["sector"])){ echo $this->form_error["sector"]; }?></em>

                        </td>
                        </tr>

                        <tr id="subsector" class="subsector_list" <?php if($u->store_subsector_id == 0) { ?> style="display:none;" <?php } ?> >
                                <td><label><?php echo $this->Lang["SUBSECTOR"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td>
		                        <select name="subsector" >
					<?php foreach($this->sub_sector_list as $s){  if($u->store_sector_id == $s->main_sector_id) { 
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
						if($theme_check==true){?>
					<option value="<?php echo $s->sector_id; ?>" <?php if($s->sector_id == $u->store_subsector_id){ ?> selected <?php } ?> > <?php echo $s->sector_name; ?></option>
					<?php } }  } ?>
		                        </select>
		                        <em><?php if(isset($this->form_error["sector"])){ echo $this->form_error["sector"]; }?></em>

                                </td>
                        </tr>   

                         <tr>
                                <td><label><?php echo $this->Lang["PHONE"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mobile" maxlength="15" value="<?php echo $u->phone_number;?>"/>
                                <em><?php if(isset($this->form_error['mobile'])){ echo $this->form_error["mobile"]; }?></em>
                                </td>
                        </tr> 
                          <tr>
                                <td><label><?php echo $this->Lang["ADDR1"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address1" maxlength="255" value="<?php echo $u->address1;?>"/>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["ADDR2"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address2" maxlength="255" value="<?php echo $u->address2;?>"/>
                                </td>
                        </tr>  
                    
                  
                        <tr>
                                <td><label><?php echo $this->Lang["SEL_COUNTRY"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td>
                                <select name="country" onchange="return city_change_merchant(this.value);">
                                <option value=""><?php echo $this->Lang["SEL_COUNTRY"]; ?></option>


                                <?php foreach($this->country_list as $d){ ?>
                                <option value="<?php echo $d->country_id ?>" <?php if($d->country_id==$u->country_id) { ?> selected="selected" <?php } ?>><?php echo $d->country_name; ?></option>
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
                                <?php foreach($this->city_list as $d){ if($u->country_id == $d->country_id) { ?>
                                <option value=<?php echo $d->city_id; ?> <?php if($u->city_id==$d->city_id) { ?> selected="selected" <?php  } ?>><?php echo $d->city_name; ?></option>
                                <?php } }  ?> 
                                </select>
                                <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em>
	                        </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["ZIP_CODE"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="zipcode" maxlength="10"  value="<?php echo $u->zipcode;?>"/>
                                <em><?php if(isset($this->form_error['zipcode'])){ echo $this->form_error["zipcode"]; }?></em>
                                </td>
                        </tr>
			
                        <tr>
                                <td><label><?php echo $this->Lang["ABOUT_US_PAGE"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td>
                                <textarea name="about_us" maxlength="1000"><?php echo $u->about_us; ?></textarea>
                                <em><?php if(isset($this->form_error["about_us"])){ echo $this->form_error["about_us"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["META_KEY"]; ?></label></td>
                                <td><label>:</label></td>
                                <td>
                                <textarea name="meta_keywords"><?php echo $u->meta_keywords; ?></textarea>
                                <em><?php if(isset($this->form_error["meta_keywords"])){ echo $this->form_error["meta_keywords"]; }?></em>
                                </td>
                        </tr>

                        <tr>
                                <td><label><?php echo $this->Lang["META_DESC"]; ?></label></td>
                                <td><label>:</label></td>
                                <td>
                                <textarea name="meta_description"><?php echo $u->meta_description; ?></textarea>
                                <em><?php if(isset($this->form_error["meta_description"])){ echo $this->form_error["meta_description"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["WEBSITE"]; ?><span>*</span></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="website" maxlength="100" value="<?php echo $u->website;?>"/>
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
								<input type="text" onclick="show_popup();" name="latitude" class="gllpLatitude" readonly value="<?php echo $u->latitude; ?>"/>
								<em><?php if(isset($this->form_error['latitude'])){ echo $this->form_error["latitude"]; }?></em>
								</td>
								</tr>
								<tr>
								<td><label><?php echo $this->Lang["LONGITUDE"]; ?><span>*</span></label></td>
								<td><label>:</label></td>
								<td>
								<input type="text" name="longitude" class="gllpLongitude" readonly value="<?php echo $u->longitude; ?>"/>
								<em><?php if(isset($this->form_error['longitude'])){ echo $this->form_error["longitude"]; }?></em>
								<input type="hidden" class="gllpZoom" value="3"/>
								<input type="hidden" class="gllpUpdateButton" value="update map">
								</td>
						</tr>
                        
                       
                        
                        <tr>
                                <td><label><?php echo $this->Lang["STORES_IMG"]; ?></label></td>
                                <td><label>:</label></td>
                                <td>
                                <input type="file" name="image"/>
                                <em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                              <label><?php echo $this->Lang['IM_UP_S']; ?> <?php echo STORE_DETAIL_WIDTH; ?> X <?php echo STORE_DETAIL_HEIGHT; ?> </label>
                                </td>
                        </tr>
                        
                        <tr>
                                <td></td>
                                <td></td>
                               <?php  if(file_exists(DOCROOT.'images/merchant/290_215/'.$u->merchant_id.'_'.$u->store_id.'.png'))       
	                        { ?>
                                <td><img border="0" src= "<?php echo PATH.'images/merchant/290_215/'.$u->merchant_id.'_'.$u->store_id.'.png';?>" alt="" width="100" /></td>
                                <?php } else { ?>
                                 <td><img border="0" src= "<?php echo PATH.'/images/no-images.png';?>" alt="" width="100" /></td>
                                <?php } ?>
                        </tr> 
                         <input type="hidden" name="storeid" value="<?php echo $u->store_id;?>"/>
                         <input type="hidden" name="store_admin_id" value="<?php echo $u->user_id;?>"/>
                        <tr>
                                <td></td>
                                <td></td>
                                <?php $mid=$u->merchant_id; ?>
                                <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>admin/merchant-shop/<?php echo $mid ?>.html"'/></td>
                                
                        </tr>
                      
                </table>
          </form>
          <?php  }?>
          </fieldset>
          </div>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
</div>
