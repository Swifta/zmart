<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<SCRIPT language="Javascript">
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode        
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }
   </SCRIPT>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
         <form action="" method="post" class="admin_form">
         <?php foreach($this->blog_settings_data as $d){?>
            <table>
                 <tr>
                    <td><label><?php echo $this->Lang['ALLW_COMM_BLOG']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><select name="allow_comment_posting" autofocus >
                    		<option value="1" <?php if($d->allow_comment_posting == 1){ echo 'selected';} ?>><?php echo $this->Lang['YES']; ?></option>
                    		<option value="2" <?php if($d->allow_comment_posting == 2){ echo 'selected';} ?>><?php echo $this->Lang['NO']; ?></option>
                    	</select>
                    <em><?php if(isset($this->form_error["allow_comment_posting"])){ echo $this->form_error["allow_comment_posting"]; }?></em></td>
                </tr>
                   <tr>
                    <td><label><?php echo $this->Lang['REQ_ADMIN_APP']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><select name="require_approval_comments" >
                    		<option value="1" <?php if($d->require_adminapproval_comments == 1){ echo 'selected';} ?>><?php echo $this->Lang['YES']; ?></option>
                    		<option value="2" <?php if($d->require_adminapproval_comments == 2){ echo 'selected';} ?>><?php echo $this->Lang['NO']; ?></option>
                    	</select>
                    <em><?php if(isset($this->form_error["require_approval_comments"])){ echo $this->form_error["require_approval_comments"]; }?></em></td>
                </tr>
                   <tr>
                    <td><label><?php echo $this->Lang['POST_PAG']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="post_per_page"  onkeypress="return isNumberKey(event)" value="<?php echo $d->posts_per_page;?>" maxlength="2" />
                    <em><?php if(isset($this->form_error["post_per_page"])){ echo $this->form_error["post_per_page"]; }?></em></td>
                </tr>                   
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH; ?>admin.html"'/></td>
                </tr>
            </table>
            <?php }?>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
