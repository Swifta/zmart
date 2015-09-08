<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <?php foreach($this->data as $d){ ?>
        <form action="" method="post" class="admin_form">
            <table>
            <tr><td><label><?php echo $this->Lang['STATUS']; ?> :</label><em><?php if(isset($this->form_error["data"])){ echo $this->form_error["data"]; }?></em></td></tr>
                <tr><td><label><input type="radio" <?php if($d->about_us_status == 1){ ?> checked  <?php } ?> name="about_us_status" value="1"><?php echo $this->Lang['ACTIVE1']; ?></label><label><input type="radio" <?php if($d->about_us_status == 0){ ?> checked  <?php } ?> name="about_us_status" value="0" ><?php echo $this->Lang['DEACTIVE']; ?></label></td></tr>
                <tr><td><label><?php echo $this->template->title; ?> :</label><em><?php if(isset($this->form_error["data"])){ echo $this->form_error["data"]; }?></em></td></tr>
                <tr><td><textarea autofocus name="about_us" class="TextArea" ><?php echo $d->about_us; ?></textarea></td></tr>
                <tr><td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>cms/warranty.html'"/></td></tr>
            </table>
        </form>
        <?php } ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
