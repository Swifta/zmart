<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="content_outer fl clr">
<div class="breadcrumb fl clr">
    <ul>
        <li class="breadcrumb_arrow">
        <a href="<?php echo PATH;?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a>
        </li>
        <li><p title="<?php echo $this->Lang['ABT']; ?>"> <?php echo $this->Lang['ERR_PAG']; ?> </p></li>
    </ul>    
	</div>
	<div class="content_top fl clr">
    	<h2 class="fl clr"><?php echo $this->template->title; ?></h2>
    </div>
	
<div class="content_middle fl clr">

<div class="error_container fl clr">
	<div class="error_msg_content fl clr">
    	<div class="error_titlt fl clr">
    		<h1 class="fl clr"><?php echo $this->Lang['STOP_VISIT_WORK_PAGE']; ?></h1>
        </div>
        <ul class="fl clr">
        	<li>
            	<a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a>
            </li>
            <li>
                <a href="<?php echo PATH?>aboutus.html" title="<?php echo $this->Lang['ABOUT']; ?>" class="fl"><?php echo $this->Lang['ABOUT']; ?></a>
            </li>
            <li>
                <a href="<?php echo PATH?>blog.html" title="<?php echo $this->Lang['BLOG']; ?>" class="fl"><?php echo $this->Lang['BLOG']; ?></a>
            </li>
            <li>
                <a href="<?php echo PATH?>contactus.html" title="<?php echo $this->Lang['CONTACT_US']; ?>" class="fl"><?php echo $this->Lang['CONTACT_US']; ?></a>
            </li>
             <li>
                <a href="<?php echo PATH?>faq.html" title="<?php echo $this->Lang['FAQ']; ?>" class="fl"><?php echo $this->Lang['FAQ']; ?></a>
            </li>
        </ul>
        <div class="share_error fl clr">
        	<p><?php echo $this->Lang['VISIT_ON']; ?></p>
            <ul>
            	 <?php if(FB_PAGE){?>
                        <li>
                            <a href="<?php echo FB_PAGE; ?>"  title="<?php echo $this->Lang['FB']; ?>" target="_blank">
                                <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/facebook_link.png" width="20" height="20" alt="<?php echo $this->Lang['FB']; ?>" />
                                
                            </a>
                        </li>
                      <?php }if(TWITTER_PAGE){?> 
                        <li>
                            <a href="<?php echo TWITTER_PAGE;?>" title="<?php echo $this->Lang['TW']; ?>" target="_blank">
                                <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/twitter_link.png" width="20" height="20" alt="<?php echo $this->Lang['TW']; ?>" />
                                
                            </a>
                        </li>
                       <?php }if(LINKEDIN_PAGE){ ?> 
                        <li>
                            <a href="<?php echo LINKEDIN_PAGE; ?>" title="<?php echo $this->Lang['LINK']; ?>" target="_blank">
								<img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/linked_in.png" width="20" height="20" alt="<?php echo $this->Lang['LINK']; ?>" />
                                
                            </a>
                        </li>
                        <?php }?>
            </ul>
        </div>
    </div>
</div>
</div>
<div class="content_bottom fl clr"></div>
</div>
