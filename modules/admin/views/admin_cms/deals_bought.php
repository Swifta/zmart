<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript" src="<?php echo PATH ?>js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript"src="<?php echo PATH ?>js/tiny_mce/text_edit.js"></script>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html';?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?><span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title;?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form">
            <table>
                <tr><td><label><?php echo $this->Lang["DEBT"]; ?> :</label></td></tr>
                <tr><td><textarea name="deals_bought" ><?php foreach($this->deals_bought as $d){ echo $d->cms_desc; }?></textarea></td></tr>
                <tr><td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>"/></td></tr>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
