<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
	
        <form action="" method="post" class="admin_form">
            <table>
				<?php foreach($this->sizeData as $row ){ ?>
                 <tr>
                    <td><label><?php echo $this->Lang['SIZE']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input autofocus type="text" name="size" maxlength="10" value="<?php echo $row->size_name; ?>" />
                    <em><?php if(isset($this->form_error["size"])){ echo $this->form_error["size"]; }?></em></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                        <?php 
                        $lastsession = $this->session->get("lasturl");
                        if($lastsession){
                        $url = PATH.$lastsession;
                        } else {
                        $url = PATH."admin/manage-sizes.html";
                        }
                        ?>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="javascript:window.location='<?php echo $url; ?>'"/></td>
                </tr>
			<?php } ?>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
