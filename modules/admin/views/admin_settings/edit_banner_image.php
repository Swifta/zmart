<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form fl" enctype="multipart/form-data">
            <table>
				<?php foreach($this->bannerData as $row ){ ?>
                <tr>
                    <td><label><?php echo $this->Lang['IMG_TIT']; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" maxlength="255" name="title" value="<?php echo $row->image_title; ?>" autofocus />
                    	<em><?php if(isset($this->form_error["title"])){ echo $this->form_error["title"]; }?></em>
                    </td>
                </tr>
                <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
                
                <td>
					
                <input type='checkbox' name='product' <?php if($row->product == 1) { ?>checked='checked' <?php } else { ?><?php } ?> value='<?php echo $row->product; ?>'>&nbsp;Product
                <input type='checkbox' name='deal'  <?php if($row->deal == 1) { ?>checked='checked' <?php } else { ?><?php } ?> value='<?php echo $row->deal; ?>'>&nbsp;Deal
                <input type='checkbox' name='auction'  <?php if($row->auction == 1) { ?>checked='checked' <?php } else { ?><?php } ?> value='<?php echo $row->auction; ?>'>&nbsp;Auction
                </td>
                </tr>
                <tr>
                    <td><label><?php echo $this->Lang['UP_BA_IM']; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="file" name="image" />
                    	<em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                    	<br>
                    	<label><?php echo $this->Lang['IMG_UP']; ?> 500 X 250 </label>
                    </td>
                </tr>
                
                <tr>
                    <td><label><?php echo $this->Lang['REDIRECT']; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="redirect_url" value="<?php echo $row->redirect_url; ?>" />
                    	<em><?php if(isset($this->form_error["redirect_url"])){ echo $this->form_error["redirect_url"]; }?></em>
                    </td>
                </tr>
                
				<tr>
					<td></td>
                    <td></td>
                    <?php  if(file_exists(DOCROOT.'images/banner_images/'.$row->banner_id.'.png'))  { ?>  
					<td align="left"><img border="0" src= "<?php echo PATH.'images/banner_images/'.$row->banner_id.'.png';?>" alt="" width="80" /></td>
					<?php } ?>
				</tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" title="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/manage-banner-images.html'" title="<?php echo $this->Lang['CANCEL']; ?>" /> </td>
                </tr>
		<?php } ?>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
