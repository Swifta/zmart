<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script>

    jQuery(function ($) {
    //form submit handler
    $('#booking').submit(function (e) {
        //check atleat 1 checkbox is checked
        if (!$('.roomselect').is(':checked')) {
        $('.processing_image').hide();
            //prevent the default form submit if it is not checked
            alert("Select any one ( Product , Deal , Auction )");
    }else{
        $("#booking").submit();
    }
    })
})
</script>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form fl" id="booking" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label><?php echo $this->Lang['IMG_TIT']; ?>*</label></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="title" maxlength="255" value="<?php if(!isset($this->form_error['title']) && isset($this->userPost['title'])){ echo $this->userPost['title']; }?>" autofocus />
                    	<em><?php if(isset($this->form_error["title"])){ echo $this->form_error["title"]; }?></em>
                    </td>
                </tr>
                <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
                
                <td>
                <input type='checkbox' name='product' checked='checked' value='1' class="roomselect">&nbsp;Product
                <input type='checkbox' name='deal'  value='1' class="roomselect">&nbsp;Deal
                <input type='checkbox' name='auction'  value='1' class="roomselect">&nbsp;Auction
                </td>
                </tr>
                <tr>
                    <td><label><?php echo $this->Lang['UP_BA_IM']; ?>*</label></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="file" name="image" />
                    	<em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
                    	<br>
                    	<label><?php echo $this->Lang['IMG_UP']; ?> 500 X 250 </label>
                    </td>
                </tr>               
                <tr>
                    <td><label><?php echo $this->Lang['REDIRECT']; ?>*</label></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="redirect_url" value="<?php if(!isset($this->form_error['redirect_url']) && isset($this->userPost['redirect_url'])){ echo $this->userPost['redirect_url']; }?>" />
                    	<em><?php if(isset($this->form_error["redirect_url"])){ echo $this->form_error["redirect_url"]; }?></em>
                    </td>
                </tr>
				<?php /* <tr>
                    <td><label><?php echo 'Position'; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="position" value="<?php if(!isset($this->form_error['position']) && isset($this->userPost['position'])){ echo $this->userPost['position']; }?>" />
                    	<em><?php if(isset($this->form_error["position"])){ echo $this->form_error["position"]; }?></em>
                    </td>
                </tr> */ ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" id="submit" title="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/add-banner-image.html'" title="<?php echo $this->Lang['RESET']; ?>" /> </td>
                </tr>

            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
