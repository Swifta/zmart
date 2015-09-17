<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta property="og:image"  content="<?php echo $this->template->metaimage; ?>"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title> <?php echo $this->template->title; ?> </title>
        <meta name="description" content="<?php echo $this->template->description; ?>" />
        <meta name="keywords" content="<?php echo $this->template->keywords; ?>" />
        <link rel="shortcut icon" href="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/favicon.png&w=<?php echo FAVICON_WIDTH; ?>&h=<?php echo FAVICON_HEIGHT; ?>" type="image/x-icon" />		
       
        <?php
        if ($this->city_id) {
            foreach ($this->all_city_list as $CX) {
                if ($this->city_id == $CX->city_id) {
                    ?>
                    <link rel="alternate" type="application/atom+xml" title="<?php echo ucfirst($CX->city_name); ?> deals" href="<?php echo PATH . 'deals/rss/' . $this->city_id . '/' . $CX->city_url; ?>"  />
                    <?php
                }
            }
        }
        ?>
        <?php 
        echo $this->template->style;
        echo $this->template->javascript; ?>
                  <?php /*  <link rel="stylesheet" href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/css/demo.css" type="text/css" media="screen" /> 

        <script type="text/javascript">
var __lc = {};
__lc.license = 1098049;

(function() {
var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>  */ ?>
        <body><?php if(isset($this->sector)) {
				if($this->theme_name) { 
					$sector =$this->theme_name; 
				} else{
				    $sector="default";
				    }?> 
			 <!--sector header start-->
				<?php if($sector =="default") { 
				     echo new View("themes/" . THEME_NAME . "/header");
				}else{
				    echo new View("themes/" . THEME_NAME ."/".$sector."/header"); 
				} ?>
			<!--Sector header End-->
			<?php } else {  ?>
            <!-- header start-->
				<?php echo new View("themes/" . THEME_NAME . "/header"); ?>
            <!--header End-->
            <?php } ?>
            <div class="mt10" style="display:none;" id="citylist">
                <ul>
                    <?php
                    $a = '';
                    foreach ($this->all_city_list as $city) {
                        ?>
                        <li <?php if ($a != $city->country_name) { ?>  style="clear:both; color:#E14948;float:left;" <?php } ?> > <?php
                            if ($a != $city->country_name) {
                                $a = $city->country_name;
                                echo ucfirst($city->country_name);
                            } else {
                                ?> <p>&nbsp;</p> <?php } ?>  <a  onclick="return changecity('<?php echo $city->city_id; ?>', '<?php echo $city->city_url; ?>');" ><?php echo ucfirst($city->city_name); ?>  </a></li>
<?php } ?>
                </ul>
            </div >
            <span id="success_message"></span>
<?php if (!empty($this->response)) { ?>
                <div class="msg_show"  id="messagedisplay">            
                    <div class="session_wrap">
                        <div class="session_container">
                            <div class="success_session">
                                <p><span ><?php echo $this->response; ?>.</span></p>
                                <div class="close_session_2">
                                    <a class="closestatus cur" title="Close"  onclick="return closeerr();" >&nbsp;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
<?php if (!empty($this->error_response)) { ?>
                <div class="msg_show" id="error_messagedisplay">  
                    <div class="session_wrap">
                        <div class="session_container">
                            <div class="failure_session">
                                <p ><span><?php echo $this->Lang['ERROR']; ?>!&nbsp;</span> <?php echo $this->error_response; ?></p>
                                <div class="close_session">
                                    <a  title="<?php echo $this->Lang['CLOSE']; ?>" title="Close" onclick="return closeerr('err');" > &nbsp;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
			<script type="text/javascript">
				$(window).load(function() {
					$(".wloader_img").fadeOut("slow");
					$(".wloader_img").css("visibility:visible");
				})
			</script>
            <!--container start-->
<?php echo $this->template->content; ?>
            <!--container_end-->
            <?php if(isset($this->sector)) {
				if($this->theme_name) { 
					$sector =$this->theme_name; 
				} else{
				    $sector="default";
				    }?> 
				    
			 <!--sector header start-->
				<?php if($sector =="default") { 
				     echo new View("themes/" . THEME_NAME . "/footer");
				}else{
				    echo new View("themes/" . THEME_NAME ."/".$sector."/footer"); 
				} ?> 
			 
				
			<!--Sector header End-->
			<?php } else {  ?>
            <!--footer start-->            
<?php echo new View("themes/" . THEME_NAME . "/footer"); ?>   
            <!--footer end-->
            <?php } ?>
			
        </body>
</html>
