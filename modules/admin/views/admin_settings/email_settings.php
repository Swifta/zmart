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
       
        </div><div class="gllpLatlonPicker">
        <form action="" method="post" class="admin_form">
            <table>
                 <tr>
                    <td><label><?php echo $this->Lang["CONTACT_NAME"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="name"  value="<?php echo CONTACT_NAME;?>" maxlength="70" autofocus />
                    <em><?php if(isset($this->form_error["name"])){ echo $this->form_error["name"]; }?></em></td>
                 </tr>

                 <tr>
                    <td><label><?php echo $this->Lang["CONTACT_EMAIL"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="contact_email" value="<?php echo CONTACT_EMAIL;?>"  maxlength="150" />
                    <em><?php if(isset($this->form_error["contact_email"])){ echo $this->form_error["contact_email"]; }?></em></td>
                 </tr>

                 <tr>
                    <td><label><?php echo $this->Lang["WBMASTER_EMAIL"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="webmaster_email"  value="<?php echo WEBMASTER_EMAIL;?>" maxlength="150"/>
                    <em><?php if(isset($this->form_error["webmaster_email"])){ echo $this->form_error["webmaster_email"]; }?></em></td>
                 </tr>

                 <tr>
                    <td><label><?php echo $this->Lang["SITE_NOREP_MAIL"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="noreply_email" value="<?php echo NOREPLY_EMAIL;?>" maxlength="150" />
                    <em><?php if(isset($this->form_error["noreply_email"])){ echo $this->form_error["noreply_email"]; }?></em></td>
                 </tr>

		 <tr>
                    <td><label><?php echo $this->Lang["CONTACT_PH1"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="phone1" value="<?php echo PHONE1;?>" maxlength="20" />
                    <em><?php if(isset($this->form_error["phone1"])){ echo $this->form_error["phone1"]; }?></em></td>
                 </tr>

		 <tr><td></td><td></td><td><p>Ex: +91 422-4221160</p></td></tr>
				<tr>
                    <td><label><?php echo $this->Lang["CONTACT_PH2"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="phone2" value="<?php echo PHONE2;?>" maxlength="20" />
                    <em><?php if(isset($this->form_error["phone2"])){ echo $this->form_error["phone2"]; }?></em></td>
                 </tr>

                        <tr >
                        <td><label><?php echo $this->Lang['MAP_SEARCH_LO']; ?><span>*</span></label></td>
                        <td><label>:</label></td>
                        <td >
                        <input type="text" class="gllpSearchField">
                        <input type="button" class="gllpSearchButton" maxlength="100" value="<?php echo $this->Lang['SEARCH']; ?>">
                        <br/><br/><br/>
                        <div class="gllpMap" ><?php echo $this->Lang['GOOG_MAP']; ?></div>
                        </td>
                        </tr>  
			   <td><label><?php echo $this->Lang["LATITUDE"]; ?><span>*</span></label></td>
				<td><label>:</label></td>
				<td>
				<input type="text" name="latitude" class="gllpLatitude" readonly value="<?php echo LATITUDE;?>"/>
				<em><?php if(isset($this->form_error['latitude'])){ echo $this->form_error["latitude"]; }?></em>
				</td>
				</tr>
				<tr>
				<td><label><?php echo $this->Lang["LONGITUDE"]; ?><span>*</span></label></td>
				<td><label>:</label></td>
				<td>
				<input type="text" name="longitude" class="gllpLongitude" readonly value="<?php echo LONGITUDE;?>"/>
				<em><?php if(isset($this->form_error['longitude'])){ echo $this->form_error["longitude"]; }?></em>
				<input type="hidden" class="gllpZoom" value="3"/>
				<input type="hidden" class="gllpUpdateButton" value="update map">
				</td>
		</tr>
						
				
                 <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" title="<?php echo $this->Lang['UPDATE']; ?>"/><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" title="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>admin.html"'/></td>
                 </tr>

            </table>
        </form>
    </div></div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
