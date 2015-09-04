<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">

        <form action="" method="post" class="admin_form">
            <table>
                <tr>
                <td><label><?php echo $this->Lang["OLD_PASS"]; ?> :</label><span>*</span></td>
                <td><input name="oldpassword" type="password" value="" size="30"  placeholder="<?php echo $this->Lang["OLD_PASS"]; ?>" autofocus /><em><?php if(isset($this->form_error['oldpassword'])){ echo $this->form_error['oldpassword']; }?></em></td>
                <tr>
                <td><label><?php echo $this->Lang["NEW_PASS"]; ?> :</label><span>*</span></td>
                <td><input name="password" type="password" value="" size="30" placeholder="<?php echo $this->Lang["NEW_PASS"]; ?>"/><em><?php if(isset($this->form_error['password'])){ echo $this->form_error["password"]; }?></em></td>
                </tr>
                <tr>
                <td><label><?php echo $this->Lang["CONFIRM_PASS"]; ?> :</label><span>*</span></td>
                <td><input name="cpassword" type="password" value="" size="30" placeholder="<?php echo $this->Lang["CONFIRM_PASS"]; ?>" /><em><?php if(isset($this->form_error['cpassword'])){ echo $this->form_error["cpassword"]; }?></td>
                 <tr>
                 <td></td>
                  <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>merchant/settings.html"'/></td>
                </tr>
             </table>
        </form>

    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
