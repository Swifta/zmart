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
            <div class="contianer">
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
                        <?php /*<div class="seller_signup_finish active_tab">                            
                            <span>03</span>
                            <p><?php echo $this->Lang['SECTOR_SEL']; ?></p>                            
                        </div>*/?>
                        <div class="seller_signup_finish ">                            
                            <span>03</span>
                            <p><?php echo $this->Lang['FINISH']; ?></p>                            
                        </div>
                        
                    </div>
               <form action="" method="post" name="signup5"  id="signup5" enctype="multipart/form-data" >
		<div class="payouter_block pay_br">
                   <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['CRTE_YR_STRE']; ?>: <?php echo $this->Lang['SECTOR_SEL']; ?></h3>
                        <div class="p_inner_block clearfix">
                            <div class="payment_form_section">
                            <div class="payment_form merchant_paymet_form">
								
                                <div class="dash_active_left"> </div>
				<div class="dash_active_mid_mod">							  
				<div class="dash_act_img">
				<img src="<?php echo PATH ?>images/deal_module.png" class="image" alt="<?php echo $this->Lang['SECTOR1']; ?>"/>
				</div>
				<p><?php echo "Default"; ?>
				<span><input type="radio" name="sector" checked = "checked" value="0" <?php if($this->session->get('sector')) { if($this->session->get('sector')== '0') { ?>
                                        checked <?php } } else { ?> checked <?php } ?>></span>
				</p>
				 </div>
				 
				<?php foreach($this->sector_list as $sector){?>
						 <div class="dash_active_mid_mod">
											  
						  <div class="dash_act_img">
						
						  <img src="<?php echo PATH ?>images/deal_module.png" class="image" alt="<?php echo $this->Lang['SECTOR1']; ?>"/>
						   </div>
						   
						   <p><?php echo $sector->sector_name; ?>
						   <span><input type="radio" name="sector"  value="<?php echo $sector->sector_id;?>" <?php if($this->session->get('sector')) { if($this->session->get('sector')==$sector->sector_id) { ?>checked="checked" <?php } }?>></span>
						  </p>
						   </div> 
						   <?php } ?>
                                 <div class="dash_active_right">  </div> 
						
                                <div class="merchant_submit_buttons" id="submit32">
                                    <label>&nbsp;</label><input type="submit" value="<?php echo $this->Lang['CONTINUE'];?>" class="sign_submit" />
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
				  required: true,
				  url: true
				}
			  },
  
			 messages: {
				 
		   storename: {
			   required: "<?php echo $this->Lang['PLS_ENT_STR_NAM']; ?>"                         
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
		website : {
		   required: "<?php echo $this->Lang['PLS_ENT_URL']; ?>",
		   url: "<?php echo $this->Lang['PLS_ENT_URL']; ?>"                             
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
