<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/css/style.css" />
<div class="content_outer1" style="margin:auto;" >
<div class="breadcrumb1 fl clr">
    <ul>
        <li class="breadcrumb_arrow1">
        <a href="<?php echo PATH;?>" title="Home">Home</a>
        </li>
        <li><p title="Error Page"> Error Page </p></li>
    </ul>    
	</div>
	<div class="content_top1 fl clr">
    	<h2 class="fl clr">Page Not Found</h2>
    </div>
	
<div class="content_middle1 fl clr">

<div class="error_container1 fl clr">
	<div class="error_msg_content1 fl clr">
    	<div class="error_titlt1 fl clr">
    		<h1 class="fl clr">Stop by and Visit of our Working Pages</h1>
        </div>
        <ul class="fl clr">
        	<li>
            	<a href="<?php echo PATH; ?>" title="HOME">HOME</a>
            </li>
            <li>
                <a href="<?php echo PATH?>aboutus.html" title="About Us" class="fl">About Us</a>
            </li>
            <li>
                <a href="<?php echo PATH?>blog" title="Blog" class="fl">Blog</a>
            </li>
            <li>
                <a href="<?php echo PATH?>contactus.html" title="Contact Us" class="fl">Contact Us</a>
            </li>
             <li>
                <a href="<?php echo PATH?>terms-and-conditions.php" title="Terms And Conditions" class="fl">Terms And Conditions</a>
            </li>
        </ul>
        <div class="share_error1 fl clr">
        	<p>Visit us on</p>
            <ul>
            	 <?php if(FB_PAGE){?>
                        <li>
                            <a href="<?php echo FB_PAGE; ?>"  title="Facebook" target="_blank">
                                <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/facebook_link.png" width="20" height="20" alt="Facebook" />
                                
                            </a>
                        </li>
                      <?php }if(TWITTER_PAGE){?> 
                        <li>
                            <a href="<?php echo TWITTER_PAGE;?>" title="Twitter" target="_blank">
                                <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/twitter_link.png" width="20" height="20" alt="Twitter" />
                                
                            </a>
                        </li>
                       <?php }if(LINKEDIN_PAGE){ ?> 
                        <li>
                            <a href="<?php echo LINKEDIN_PAGE; ?>" title="LinkedIn" target="_blank">
			    <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/linked_in.png" width="20" height="20" alt="LinkedIn" />
                                
                            </a>
                        </li>
                        <?php }?>
            </ul>
        </div>
    </div>
</div>
</div>
<div class="content_bottom1 fl clr"></div>
</div>


