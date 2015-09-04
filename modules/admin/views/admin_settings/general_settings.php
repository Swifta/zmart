<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
       

        <form action="" method="post" class="admin_form">
            <table>
                <tr>
                    <td><label><?php echo $this->Lang["SITE_NAME"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="name" maxlength="100" value="<?php echo SITENAME; ?>" autofocus />
                    <em><?php if(isset($this->form_error["name"])){ echo $this->form_error["name"]; }?></em></td>
                </tr>

                <tr>
                    <td><label><?php echo $this->Lang["META_TITLE"]; ?><span>*</span></label></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="title"  maxlength="250" value="<?php echo SITE_TITLE; ?>"/>
                    <em><?php if(isset($this->form_error["title"])){ echo $this->form_error["title"]; }?></em></td>
                </tr>

                <tr>
                    <td><label><?php echo $this->Lang["META_KEY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><textarea  cols="5" rows="5" name="keywords" ><?php echo META_KEYWORDS; ?></textarea>
                    <em><?php if(isset($this->form_error["keywords"])){ echo $this->form_error["keywords"]; }?></em></td>
                </tr>

                <tr>
                    <td><label><?php echo $this->Lang["META_DESC"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><textarea rows="5" cols="5" name="description"><?php echo META_DESCRIPTION; ?></textarea>
                    <em><?php if(isset($this->form_error["description"])){ echo $this->form_error["description"]; }?></em></td>
                </tr>

                <tr>
                    <td><label><?php echo $this->Lang["DEFAULT_THEME"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
      					<select name="theme">
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
                    <td><label><?php echo $this->Lang["DEFAULT_LANG"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
      					<select name="language">
                        	<option value="<?php echo DEFAULT_LANGUAGE;?>"><?php echo ucfirst(DEFAULT_LANGUAGE);?></option>
                        	<?php 
								foreach($this->language_List as $lang){
									if(DEFAULT_LANGUAGE != $lang){
							?>
                            <option value="<?php echo $lang; ?>"><?php echo ucfirst($lang); ?></option>
                            <?php } } ?>
                      </select>
                        <em><?php if(isset($this->form_error["language"])){ echo $this->form_error["language"]; }?></em>
                   </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>"  title="<?php echo $this->Lang['UPDATE']; ?>" />
                    <input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" title="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>admin.html"'/></td>
                </tr>

            </table>
        </form>

    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
