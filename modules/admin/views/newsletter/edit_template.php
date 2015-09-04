<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form" enctype="multipart/form-data">
            <table>
				<?php foreach($this->newsletter_details as $news){?>
                <tr>
                    <td><label><?php echo $this->Lang["TITLE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="title" maxlength="60" value="<?php echo $news->newsletter_title;?>" autofocus />
                    <em><?php if(isset($this->form_error["title"])){ echo $this->form_error["title"]; }?></em></td>
                </tr>
               <tr>
                    <td><label><?php echo $this->Lang['TEMPLATE_FILE']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="file" name="template_file" />
                    	<a href="<?php echo PATH.'images/newsletter/Template_file_'.$news->newsletter_id.'.php';?>" target="_blank"><?php echo "Template_file_".$news->newsletter_id.".php";?></a>
                    	<em><?php if(isset($this->form_error["template_file"])){ echo $this->form_error["template_file"]; }?></em>
                    </td>
                </tr>
                <tr>
                    <td><label><?php echo $this->Lang['TEMPLATE_IMAGE']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="file" name="template_image" />
                    	<em><?php if(isset($this->form_error["template_image"])){ echo $this->form_error["template_image"]; }?></em>
                    	<label><?php echo $this->Lang['IMG_UP']; ?> 192 * 98 </label>
                    	<img src="<?php echo PATH.'images/newsletter/'.$news->newsletter_id.'.png';?>" style="width:50px;height:50px">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" /><input type="reset" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/manage-template.html'"/></td>
                </tr>
                <?php }?>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
