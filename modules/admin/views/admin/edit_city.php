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
       <?php foreach($this->cityData as $city){ ?>
	<div class="gllpLatlonPicker">
        <form action="" method="post" class="admin_form">
            <div class="mergent_det2">
	        <fieldset>
    	        <legend><?php echo $this->Lang["MANAGE_CITY"]; ?></legend>  
            <table>
                <tr>
                    <td><label><?php echo $this->Lang["COUNTRY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <select autofocus name="country">
                            <option value="<?php echo $city->country_id;?>"><?php echo $city->country_name; ?></option> 
						<?php  foreach($this->country_list as $c){ ?>
                            <option value="<?php echo $c->country_id; ?>"><?php echo ucfirst($c->country_name); ?></option>  
                            <?php } ?>
                        </select>
                        <em><?php if(isset($this->form_error["country"])){ echo $this->form_error["country"]; }?></em>
					</td>
                 </tr>
                 <tr>
                    <td><label><?php echo $this->Lang["CITY_NAME"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="city" maxlength="100" value="<?php echo $city->city_name; ?>" />
                    <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em></td>
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
								<input type="text" name="latitude" class="gllpLatitude" readonly value="<?php echo $city->city_latitude; ?>"/>
								<em><?php if(isset($this->form_error['latitude'])){ echo $this->form_error["latitude"]; }?></em>
								</td>
								</tr>
								<tr>
								<td><label><?php echo $this->Lang["LONGITUDE"]; ?><span>*</span></label></td>
								<td><label>:</label></td>
								<td>
								<input type="text" name="longtitude" class="gllpLongitude" readonly value="<?php echo $city->city_longitude; ?>"/>
								<em><?php if(isset($this->form_error['longtitude'])){ echo $this->form_error["longtitude"]; }?></em>
								<input type="hidden" class="gllpZoom" value="3"/>
								<input type="hidden" class="gllpUpdateButton" value="update map">
								</td>
						</tr>
                        
                <tr>
                
 </table>
            	</fieldset>
</div>       

<table>
                 
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="window.location.href='<?php echo PATH?>admin/manage-city.html'"/></td>
                </tr>
            </table>
        </form>
        <?php } ?>
    </div>
      </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
