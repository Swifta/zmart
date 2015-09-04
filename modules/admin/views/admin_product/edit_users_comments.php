<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">      
        <?php foreach($this->users_comments_data as $u){ ?>
        <form method="post" class="admin_form" name="edit_users" >
                <table>
                
                <tr>
                        <td><label><?php echo $this->Lang["PRODUCT_NAME"]; ?></label></td>
                        <td><label>:</label></td>
                        <td>
                        <label><?php echo ucfirst($u->deal_title); ?></label>
                        </td>
                </tr>

                <tr>
                        <td><label><?php echo $this->Lang["DESC"]; ?></label><span>*</span></td>
                        <td><label>:</label></td>
                        <td>
                        <textarea name="comments" autofocus ><?php echo $u->comments;?></textarea>
                        <em><?php if(isset($this->form_error["comments"])){ echo $this->form_error["comments"]; }?></em>
                        </td>
                </tr> 

                <tr>
                        <td></td>
                        <td></td>
                        <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" title="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" title="<?php echo $this->Lang['CANCEL']; ?>" onclick="window.location.href='<?php echo PATH?>admin/manage-product-comments.html'"/></td>
                </tr>            
                      
                </table>
        </form>
          <?php  }?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
