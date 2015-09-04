<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">

        <div class="fl clr">
        <div class="fl current_theme">
        <h2 class="fl clr"><?php echo $this->Lang["CUR_THEM"]; ?></h2>     
        <img src="<?php echo THEME;?>images/theme.png" class="p10 fl clr" /><span class="fl"><?php echo THEME_NAME;?></span>
		</div>

        </div>
       <?php if(count($this->themes_list) > 1){ ?>
        <div class="fl clr avail_themes" >
        <h2><?php echo $this->Lang["AVAIL_THEM"]; ?></h2>      
      
        <?php 
			foreach($this->themes_list as $tl){
				if($tl != THEME_NAME){
		?>
        		<div class="fl avail_theme">
				 <img src="<?php echo PATH;?>themes/<?php echo $tl; ?>/images/theme.png" class="p10" /><p><?php echo ucfirst($tl);?></p>	
                 <div class="fl clr"><a href="" title="<?php echo $this->Lang["ACTIVE"]; ?>" class="fl"><?php echo $this->Lang["ACTIVE"]; ?></a><span class="fl">|</span> <a href=""  class="fl" title="<?php echo $this->Lang["DELETE"]; ?>"><?php echo $this->Lang["DELETE"]; ?></a></div>
                 </div>
		<?php 
				}
			}
		?>      
	</div>
<?php } ?>

    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
