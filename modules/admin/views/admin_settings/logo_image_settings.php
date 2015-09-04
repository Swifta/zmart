<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form fl" enctype="multipart/form-data">
            <table>
            	<tr>
                    <td><label><?php echo $this->Lang["CURRENT"]; ?> <?php echo ucfirst($this->viewName); ?></label></td>
                    <td><label>:</label></td>
                    <td>
                		
                		<?php if($this->template->title == "Noimage Settings"){ ?>
                		<img id="themeImgID" border="0" src= "<?php echo PATH.'resize.php';?>?src=<?php echo THEME.'images/'.$this->viewName.'.png';?>&w=150&h=150" alt="" />
                		<?php } else { ?>
                		<img id="themeImgID" src="<?php echo THEME."images/".$this->viewName.".png";?>" class="p5"  />
                		<?php } ?>
                    </td>
                </tr>
                <tr>
                    <td><label><?php echo $this->Lang["SELECT_THEME"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                    	<select autofocus name="theme" id="themeselectName" onclick="changelogoimage('<?php echo $this->viewName; ?>');">
                        	<option value="<?php echo THEME_NAME;?>"><?php echo ucfirst(THEME_NAME);?></option>
                        	<?php 
                                        foreach($this->themes_list as $tl){
                                        if(THEME_NAME != $tl){
				?>
                            <option value="<?php echo $tl; ?>"><?php echo ucfirst($tl); ?></option>
                            <?php } } ?>
                        </select>
                    	<em><?php if(isset($this->form_error["theme"])){ echo $this->form_error["theme"]; }?></em>
                    </td>
                </tr>
                 <tr>
                    <td></td> <td></td><td></td>
                <tr>
                    <td><label><?php echo $this->Lang["UPLOAD"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="file" name="image" />
                    	<em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                    	<?php if($this->template->title == "Noimage Settings"){ ?>
                    	<br>
                                <label><?php echo $this->Lang['IMG_UP']; ?> 800 × 800 </label>
                    	<?php } ?>
                    	<?php if($this->template->title == "Favicon Settings"){ ?>
                    	<br>
                                <label><?php echo $this->Lang['IMG_UP']; ?> 25 × 25 </label>
                    	<?php } ?>
                    	<?php if($this->template->title == "Logo Settings"){ ?>
                    	<br>
                                <label><?php echo $this->Lang['IMG_UP']; ?> 169 × 51 </label>
                    	<?php } ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" title="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" title="<?php echo $this->Lang['RESET']; ?>" /> </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
