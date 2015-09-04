<div class="footer_outer">
    <div class="footer_inner">
        <div class="footer_common">
            <div class=" footer_list footer_one">
                <?php if(count($this->about_us_footer)>0) { foreach($this->about_us_footer as $stores) { ?>
                <div class="footer_one_logo">
					
                    <a href="<?php echo PATH.$stores->store_url_title.'/';?>"  title = "<?php echo $stores->store_name; ?>">
                        <img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH .'images/merchant/290_215/'.$stores->merchant_id.'_'.$stores->store_id.'.png'?>"/>
                    </a>
                    
                </div>
                
                <div class="footer_one_content">
                    <p><?php echo $stores->about_us; ?> </p>
                </div>
                <?php } } ?>
                <div class="footer_one_social">
                    <h2>Join Us On</h2>
                    <ul class="foot_social_icons">
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
                </div>
            </div>
            <div class=" footer_list footer_two">
                <h2 class="footer_title">Shopping Guide</h2>
                <ul>
					 <li><a href="<?php echo PATH; ?>" title="Home">Home</a></li>
                     <?php if ($this->cms_setting == 0) {
        foreach ($this->get_all_cms_title as $d) { ?>
        <?php if($d->cms_title != "Help"){ ?>
                                <li> <a <?php if ($d->type == 3) { ?>href="<?php echo $d->cms_desc; ?>" <?php } else { ?> href="<?php echo PATH . $d->cms_url . '.php' ?>" <?php } ?> title="<?php echo $d->cms_title; ?>"> <?php echo $d->cms_title; ?></a></li>
                        <?php } ?>
                    <?php }
                } ?>
                </ul>
            </div>
            <?php if(isset($this->footer_merchant_details) && count($this->footer_merchant_details)>0){
				foreach($this->footer_merchant_details as $admin){ ?>
					 <div class=" footer_list footer_three">
					   <h2 class="footer_title"></h2>
					   <ul>
						   <li>
							   <div class="foot_location">
								   <p><?php echo $admin->address1; ?>, </p>
								   <p><?php echo $admin->address2; ?></p>
								   <p><?php echo $admin->city_name; ?></p>
								   <p><?php echo $admin->country_name; ?></p>
							   </div>
						   </li>
						   <li><p class="call_icon"><?php echo $admin->phone_number;?></p></li>
						   <li><a class="foot_mail_icon" href="mailto:<?php echo $admin->email; ?>" title="<?php echo $admin->email; ?>"><?php echo $admin->email; ?></a></li>
					   </ul>
					</div>
				<?php }
			}else if(count($this->admin_details)>0) { 
				foreach($this->admin_details as $admin) { ?>
            <div class=" footer_list footer_three">
               <h2 class="footer_title"></h2>
               <ul>
                   <li>
                       <div class="foot_location">
                           <p><?php echo $admin->address1; ?>, </p>
                           <p><?php echo $admin->address2; ?></p>
                           <p><?php echo $admin->city_name; ?></p>
                           <p><?php echo $admin->country_name; ?></p>
                       </div>
                   </li>
                   <li><p class="call_icon"><?php echo PHONE1;?>,<?php echo PHONE2;?></p></li>
                   <li><a class="foot_mail_icon" href="mailto:<?php echo CONTACT_EMAIL; ?>" title="<?php echo CONTACT_EMAIL; ?>"><?php echo  CONTACT_EMAIL; ?></a></li>
               </ul>
            </div>
             <?php } } ?>
        </div>
        <div class="footer_bottom">    
      <p class="footer_copyright"> <?php echo $this->Lang['FOOTER_COPYRIGHT']; ?> <?php echo SITENAME; ?> <?php echo $this->Lang['FOOTER_ALLRIGHT']; ?></p> 
</div>
    </div>
</div>
