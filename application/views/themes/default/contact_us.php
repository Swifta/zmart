<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script>
$(document).ready(function(){
	$("#contactus").validate({
            messages: {
                   name: {
                       required: "<?php echo $this->Lang['PLS_ENT_NAM']; ?>"                         
                   },
                   phone: {
                       number: "<?php echo $this->Lang['PLS_ENT_NO']; ?>"                         
                   },
                   email: {
                       required: "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>",
                       email : "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>"                          
                   },
                   message: {
                       required: "<?php echo $this->Lang['PLS_ENT_MSG']; ?>"                         
                   },
           },
	  submitHandler: function(form) {
	   // some other code
	   // maybe disabling submit button
	   // then:
	   $('#submit').hide();
	   form.submit();
	 }
	});
});
</script> 
        <div class="contianer_outer1">
            <div class="contianer_inner">
<div class="bread_crumb">
                        <ul>
                            <li><p><a href="<?php echo PATH;?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?></a></p></li>
                            <li><p><?php echo $this->Lang['CONTACT_US']; ?></p></li>
                        </ul>
                    </div>
                <div class="contianer">
                   <!--content start-->
                    <div class="content_abouts">
                        <div class="content_abou_common">
                            <h2 class="inner_commen_title"><?php echo $this->Lang['CONTACT_US']; ?></h2>                             
                            <div class="contactus_block clearfix">                                
                                <div class="signup_form_block contact_form_block">                                    
                                    <form action="" id="contactus" method="post">                                            
                                        <ul>
                                            <li>
                                                <label><?php echo $this->Lang["NAME"]; ?>:<span class="form_star">*</span></label>
                                                <div class="fullname"><input name="name" class="required" type="text" value="" size="40" placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" autofocus />&nbsp;</div>
                                            </li>
                                            <li id="email_li_ml">
                                                <label><?php echo $this->Lang["EMAIL"]; ?>:<span class="form_star">*</span></label>
                                                <div class="fullname"><input class="required email" name="email" type="text" value="" size="40" placeholder="<?php echo $this->Lang['ENTER_EMAIL']; ?>"/>&nbsp;
                                                </div>
                                            </li>
                                            <li>
                                                <label><?php echo $this->Lang["PHONE"]; ?>:</label>
                                                <div class="fullname"><input class="number" name="phone" type="text" value="" size="40" placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>"/>&nbsp;</div>
                                            </li>                                                
                                            <li>
                                                <label><?php echo $this->Lang["MSGG"]; ?>:<span class="form_star">*</span></label>
                                                <div class="fullname">
                                                    <textarea   class="required"  name="message" title="<?php echo $this->Lang['ENTR_MSG']; ?>"  placeholder="<?php echo $this->Lang['ENTR_MSG']; ?>"></textarea>
                                                </div>
                                            </li>
                                            <li>
                                                <label>&nbsp;</label>
                                                <input class="sign_submit" id="submit" type="submit" title="<?php echo $this->Lang['SUBMIT']; ?>" value="<?php echo $this->Lang['SUBMIT']; ?>" />
                                                <input class="sign_cancel" type="reset" title="<?php echo $this->Lang['CANCEL']; ?>" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="window.location.href='<?php echo PATH; ?>'" /> 
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                                <div class="contact_detail_block">
                                    <div class="deal_map_address contact_map_address">	
                                        <h3><?php echo $this->Lang['CONT_DET']; ?></h3>
                                         <?php if(PHONE1 || PHONE2 || CONTACT_EMAIL || CONTACT_NAME){ ?>
                                         <?php if(CONTACT_NAME){ ?>
                                         <p class="contact_icon1"><?php echo CONTACT_NAME;?></p>                                            
                                         <?php } ?>
                                         <p class="contact_icon2"><?php echo PHONE1;?></p>                                                                                        
                                         <p class="contact_icon3"><?php echo PHONE2;?></p>                                                                                        
                                         <p class="contact_icon4"> <a class="deal_web_link" href="mailto:<?php echo CONTACT_EMAIL; ?>" title="<?php echo CONTACT_EMAIL; ?>"><?php echo  CONTACT_EMAIL; ?></a></p>                                            
                                         <?php } ?>                                  
                                    </div>
                                    <div class="clearfix">                                       
                                        <div class="contactus_map wloader_parent" id="map_main" style="width:318px; height:210px;">
                                            <i class="wloader_img">&nbsp;</i>
                                        </div>
                                        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                                            <script type="text/javascript">
                                                    var latlng = new google.maps.LatLng(<?php echo LATITUDE;?>,<?php echo LONGITUDE;?>);
                                                    var myOptions = {
                                                    zoom: 13,
                                                    center: latlng,
                                                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                                                    navigationControl: true,
                                                    mapTypeControl: true,
                                                    scaleControl: true
                                                    };
                                                    var map = new google.maps.Map(document.getElementById("map_main"), myOptions);
                                                    var marker = new google.maps.Marker({
                                                    position: latlng,
                                                    animation: google.maps.Animation.BOUNCE
                                                    });
                                                    marker.setMap(map);
                                            </script>                                        
                                         </div>
                                      </div>  
                                </div>
                            </div>
                        </div>  
                    </div>
                    <!--end-->
                </div>
            </div>
        </div>
