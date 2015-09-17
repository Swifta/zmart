<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form">
            <table>
                <?php foreach($this->category_data as $c){ ?>
                

					<tr>
                    <td><label><?php echo $this->main_cat; ?></label></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="main_category" readonly value="<?php echo $c->category_name ?>" title="<?php echo $this->Lang['CATEGORY_NAME']; ?>" />
                </tr>
					 <tr>
                    <td><label><?php echo $this->sub_cat; ?></label></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="category" maxlength="100" title="<?php echo $this->Lang['SUB_CAT_NAME']; ?>" value="<?php if(!isset($this->form_error['category']) && isset($this->userPost['category'])){ echo $this->userPost['category']; }?>" />
                    <em><?php if(isset($this->form_error["category"])){ echo $this->form_error["category"]; }?></em></td>
                </tr>
                <?php /*<tr>
                    <td><label>Category Mapping</label></td>
                    <td><label>:</label></td>
                    <td><textarea name="m_category"></textarea>
                    </td>
                </tr> */?>
                   <tr>
                    <td><label><?php echo $this->Lang["CATEGORY_STATUS"]; ?></label></td>
                    <td><label>:</label></td>
                    <td><input  type="radio"  name="status" checked="checked" title="<?php echo $this->Lang['ACTIVE']; ?>"  value="1"/> <?php echo $this->Lang["ACTIVE"]; ?> <input  type="radio" name="status" title="<?php echo $this->Lang['DEACTIVE']; ?>"  value="0" /> <?php echo $this->Lang["DEACTIVE"]; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>"/></td>
                </tr>
    <?php } ?>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
