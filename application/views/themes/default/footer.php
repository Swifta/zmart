<!--New Footer-->
<div class="footer_subscrbtion">
    <div class="footer_subscrbtion_inner">
        <div class="footer_subscrbtion_common">
            <div class="subscribe_lft">
                <label><?php echo $this->Lang['GET_UR_LATEST_NS_UTS'];?></label>
                <div class="subscribe_lft_txt_field">
                    <input type="text" value="" id="subscribe" name="subscribe" placeholder="<?php echo $this->Lang['ENTER_EMAIL'];?>" onkeypress="return check_color();"/>
                    <input type="submit" value="<?php echo $this->Lang['SUBSCRIBE'];?>" onclick="return check_subscribe();"/>
                    <em id="email_subscriber_error"></em>
                </div>
            </div>
            <div class="new_footer_social">
                <ul>
                    <li><a href="<?php echo FB_FAN_PAGE;?>" target="_blank" class="new_fb" title="<?php echo $this->Lang['FB'];?>"></a></li>
                    <li><a href="<?php echo LINKEDIN_PAGE;?>" target="_blank" class="new_linkedin" title="<?php echo $this->Lang['LINK'];?>"></a></li>
                    <li><a href="<?php echo FB_FAN_PAGE;?>" target="_blank" class="new_gplus" title="<?php echo $this->Lang['GOOGLE_PLUS'];?>"></a></li>
                    <li><a href="<?php echo TWITTER_PAGE;?>" target="_blank" class="new_twitt" title="<?php echo $this->Lang['TW'];?>"></a></li>
                    <li><a href="<?php echo YOUTUBE_URL;?>" target="_blank" class="new_youtube" title="<?php echo $this->Lang['YOU_TUBE'];?>"></a></li>
                    <li><a href="<?php echo INSTAGRAM_PAGE; ?>" target="_blank" class="new_insta" title="<?php echo $this->Lang['INST']; ?>"></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--New Footer-->

<div class="footer_outer">
        <div class="footer_inner">
            <div class="footer">
                <div class="footer_aboutus footer_list">
                    <h3><?php echo $this->Lang['ABT'];?></h3>
                    <?php if(count($this->get_about_us)>0){
						foreach($this->get_about_us as $cms){
							if($cms->cms_url=='about-us'){?>
                    <p><?php echo substr(html_entity_decode(strip_tags($cms->cms_desc)),0,280)."...";?></p>
                    <?php }}}?>
                </div>
                     <div class="footer_coloumn_one footer_list">
                         <h3><?php echo $this->Lang['SERV']; ?></h3>
                          <ul>
                        <li> <a href="<?php echo PATH ?>about-us.html" title="<?php echo $this->Lang['ABT']; ?>"><?php echo $this->Lang["ABT"]; ?></a></li>
                        <li><a href="<?php echo PATH ?>contactus.html" title="<?php echo $this->Lang['CONTACT_US']; ?>"><?php echo $this->Lang["CONTACT_US"]; ?></a></li>
                       
                      
    <?php if ($this->blog_setting) { ?>
                            <li><a href="<?php echo PATH ?>blog" title="<?php echo $this->Lang['BLOG']; ?>"><?php echo $this->Lang["BLOG"]; ?></a></li>
                        <?php } ?>

    <?php if ($this->cms_setting == 0) {
        foreach ($this->get_all_cms_title as $d) { ?>
        <?php if($d->cms_title != "Help" && $d->cms_url!='privacy-policy' && $d->cms_url!='Warranty' && $d->cms_url!='Returns'){ ?>
                                <li> <a <?php if ($d->type == 3) { ?>href="<?php echo $d->cms_desc; ?>" <?php } else { ?> href="<?php echo PATH . $d->cms_url . '.php' ?>" <?php } ?> title="<?php echo $d->cms_title; ?>"> <span class="aerro_right_common1"> <?php echo $d->cms_title; ?></span></a></li>
                        <?php } ?>
                    <?php }
                } ?>
               </ul>
             </div>
                <div class="footer_coloumn_two footer_list">
                    <h3><?php echo $this->Lang['CUSTOMER_SERVICE'];?></h3>
                    <ul>
					<?php if ($this->cms_setting == 0) {
					foreach ($this->get_all_cms_title as $d) { ?>
					<?php if($d->cms_url=='privacy-policy' || $d->cms_url=='Warranty' || $d->cms_url=='Returns'){ ?>
											<li> <a <?php if ($d->type == 3) { ?>href="<?php echo $d->cms_desc; ?>" <?php } else { ?> href="<?php echo PATH . $d->cms_url . '.php' ?>" <?php } ?> title="<?php echo $d->cms_title; ?>"> <span class="aerro_right_common1"> <?php echo $d->cms_title; ?></span></a></li>
									<?php } ?>
								<?php }
							} ?>
                          <?php if ($this->faq_setting) { ?>
                            <li><a href="<?php echo PATH ?>faq.html" title="<?php echo $this->Lang['FAQ']; ?>"><?php echo $this->Lang['FAQ']; ?></a></li>
                        <?php } ?>                    
                    </ul>
                </div>
                <div class="footer_contact footer_list">
                   <h3><?php echo $this->Lang['CONTACT_US1'];?></h3>
                   <?php $address1 = $address2 = $city = $country = "";
                   if(count($this->admin_details)>0){
					   foreach($this->admin_details as $ad){
						   $address1 = $ad->address1;
						   $address2 = $ad->address2;
						   $city = $ad->city_name;
						   $country = $ad->country_name;
					   }
				   }?>
                   <div class="footer_contact_addr">
                       <p class="location_icon"> <?php echo $address1;?></p>
                       <p><?php echo $address2;?>, <?php echo $city;?></p>
                       <p> <?php echo $country;?></p>
                   </div>
                   <ul>
                       <li><p class="phone_icon"><?php echo PHONE1;?></p></li>
                       <li><p class="phone_icon"><?php echo PHONE2;?></p></li>
                       <li><a class="mail_icoon" href="#" title="<?php echo CONTACT_EMAIL;?>"><?php echo CONTACT_EMAIL;?></a></li>   
                   </ul>
                </div>
                <?php /* if ((ANDROID_PAGE) || (IPHONE_PAGE)) { ?>
                <div class="footer_coloumn_two footer_list">
                    <div class="footer_mobile_app">
                        <h3><?php echo $this->Lang['NOW_APP_STORE']; ?></h3>
                        <ul>
                            <?php if (ANDROID_PAGE) { ?>
                            <li><a href="<?php echo ANDROID_PAGE; ?>" title="<?php echo $this->Lang['DOWN_ANDROID']; ?>"  target="blank"  class="foot_andi"><?php echo $this->Lang['DOWN_ANDROID']; ?></a></li>
                            <?php } if (IPHONE_PAGE) { ?>
                            <li><a href="<?php echo IPHONE_PAGE; ?>" title="<?php echo $this->Lang['DOWN_IPHONE']; ?>"  target="blank" class="foot_andi foot_iphone"><?php echo $this->Lang['DOWN_IPHONE']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } */?>
              <?php /* <div class="footer_coloumn_three footer_list">					
                   <div class="cridit_cards"> <h3><?php echo $this->Lang['MERCHANT_ACC']; ?></h3>
                    <ul class="foot_merchant">
                         <li> <a  href="<?php echo PATH . 'merchant-login.html'; ?>" title="<?php  echo $this->Lang['MER_LOIN']; ?>"><?php echo $this->Lang['MER_LOIN']; ?></a></li>
                         <li>/ </li>
                    <li><a  href="<?php echo PATH . 'merchant-signup-step1.html'; ?>" title="<?php  echo $this->Lang['MER_REGI']; ?>"><?php echo $this->Lang['MER_REGI']; ?></a> </li>
                    </ul>
                </div>
                 ?>
                <div class="cridit_cards"> <h3><?php echo $this->Lang['PAY_MTD']; ?></h3>
                    <ul>
                         <li><img  src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/payment_cards.png" alt="<?php echo $this->Lang['VISA']; ?>"/></li>
                    </ul>
                </div>
                </div> */ ?>
                <?php /* <div class="footer_coloumn_four footer_list">
                    <div class="social_icon">
                    <h3><?php echo $this->Lang['JOIN_US']; ?></h3>
                    <ul>
                        <?php if (FB_PAGE) { ?>
                            <li><a class="facebook1" href="<?php echo FB_PAGE; ?>"  target="blank" title="<?php echo $this->Lang['FB']; ?>"></a></li>
                        <?php }if (TWITTER_PAGE) { ?>
                            <li><a class="twitter1" href="<?php echo TWITTER_PAGE; ?>" target="blank" title="<?php echo $this->Lang['TW']; ?>"></a></li>
                        <?php }if (LINKEDIN_PAGE) { ?>
                            <li><a class="linke_in" href="<?php echo LINKEDIN_PAGE; ?>" target="blank" title="<?php echo $this->Lang['LINK']; ?>"></a></li>
                        <?php }if (YOUTUBE_URL) { ?>
                            <li><a class="youtube" href="<?php echo YOUTUBE_URL; ?>" target="blank" title="<?php echo $this->Lang['YOU_TUBE']; ?>"></a></li>
    <?php } ?>
    <?php if (INSTAGRAM_PAGE) { ?>
                            <li><a class="instagram" href="<?php echo INSTAGRAM_PAGE; ?>" target="blank" title="<?php echo $this->Lang['INST']; ?>"></a></li>
    <?php } ?>
    
    <?php if(CITY_SETTING) {
     if ($this->city_id) { ?>
        <?php foreach ($this->all_city_list as $CX) {
            if ($this->city_id == $CX->city_id) { ?>
                                    <li><a class="rss_1" href="<?php echo PATH . 'deals/rss/' . $this->city_id . '/' . $CX->city_url; ?>" target="blank" title="<?php echo $this->Lang['RSS_FEED']; ?>"></a></li>

            <?php }
        }
    } 
    
    }  else { ?>
    
    <li><a class="rss_1" href="<?php echo PATH . 'rss'; ?>" target="_blank" title="<?php echo $this->Lang['RSS_FEED']; ?>"></a></li>
    
  <?php  }?>                       
    
                    </ul>
                    <div class="copy_right" >
                    <label> <?php echo $this->Lang['FOOTER_COPYRIGHT']; ?> <?php echo SITENAME; ?> <?php echo $this->Lang['FOOTER_ALLRIGHT']; ?></label>
                </div>
                </div> 
                </div>*/ ?>
            </div>
        </div>
    </div>

<div class="new_footer_bottom_outer">
    <div class="new_footer_bottom_inner">
        <div class="new_footer_bottom_common">
            <p class="new_footer_copyright">Copyright  &copy;2015 emarketplace.com All rights reserved</p>
            <div class="payment_img">
                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/new_foot_pay_img.png"/>
            </div>
        </div>
    </div>
</div>
<script>
function check_subscribe(){
	var email = $("#subscribe").val();
	var atpos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	var x=0;
	if(email == '') {
		$('.subscribe_lft_txt_field').css('border','1px solid red');
		x++;
	}else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length){
		x++;
		$('.subscribe_lft_txt_field').css('border','1px solid red');
	}else {
		x=0;
		$('#email_subscriber_error').html('');
	}
	if(x==0){
		var url= Path+'users/check_user_signup/?email='+email;
		$.post(url,function(check){
			if(check == -1){
				$('.subscribe_lft_txt_field').css('border','1px solid red');
				$("#subscribe").val('');
				$("#subscribe").attr('placeholder','<?php echo $this->Lang['EMAIL_EXIST']; ?>');
				return false;
			}else{
				var url= Path+'users/user_subscriber/?email='+email;
				$.ajax(
				{
					type:'POST',
					url:url,
					cache:false,
					async:true,
					global:false,
					dataType:"html",
					success:function(check)
					{
						window.location.href=Path;
						
					},
					error:function()
					{
						
					}
				});
			}
		});
	}
}
function check_color(){
	$('.subscribe_lft_txt_field').css('border','none');
}
</script>


