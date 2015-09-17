<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form">
            <table>
				<tr><label><b><?php echo $this->Lang['DURATION_LABEL'];?> <?php echo $this->Lang['FR_STR_EXA']; ?></b></label></tr>
				<tr>
					<label><b></b></label>
                    <td></td>
                    <td><label></label></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><label></label></td>
                    <td></td>
                </tr>
				
                <tr>
                    <td><label><?php echo $this->Lang["DUR_NAME"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="duration" maxlength="32" value="" autofocus /> <?php $this->Lang["IN_MON"]; ?>
                    <em><?php if(isset($this->form_error["duration"])){ echo $this->form_error["duration"]; }?></em></td>
                </tr>
                
                <tr>
				
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>merchant/add-duration.html'"/></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
