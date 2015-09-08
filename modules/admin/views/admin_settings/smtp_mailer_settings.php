<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
	<div><input type="checkbox"  class="sengrid" <?php if(EMAIL_TYPE==1){ ?>  checked <?php } ?> name="sendgrid" id="sendgrid_1" value="1"><?php echo $this->Lang['SEND_GRID']; ?> <input type="checkbox" class="smtp" name="smtp" <?php if(EMAIL_TYPE==2){ ?>  checked <?php } ?>  value="2" id="smtp_1" ><?php echo $this->Lang['SM_TP']; ?> 
<?php /**<input type="checkbox" name="mailchimp" value="3" class="mailchimp" <?php if(EMAIL_TYPE==3){ ?>  checked <?php } ?> id="mailchimp_1">Mailchimp **/?></div>
<?php if(EMAIL_TYPE==1){ ?>
	<div id="sengrid">
         <form action="" method="post" class="admin_form">
            <table>
            	  <tr>
                    <td></td>
                    <td></td>
                    <td>
                  <?php echo $this->Lang["SMTP_ALERT"]; ?></td>
                  </tr>

                  <tr>
                    <td><label><?php echo $this->Lang['HO_ST']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="smtp_host"  value="<?php echo SMTP_HOST;?>" maxlength="150" />
                    <em><?php if(isset($this->form_error["smtp_host"])){ echo $this->form_error["smtp_host"]; }?></em></td>
                 </tr>

                   <tr>
                    <td><label><?php echo $this->Lang['PO_RT']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="smtp_port"  value="<?php echo SMTP_PORT;?>" maxlength="10" />
                    <em><?php if(isset($this->form_error["smtp_port"])){ echo $this->form_error["smtp_port"]; }?></em></td>
                  </tr>

                   <tr>
                    <td><label><?php echo $this->Lang['USER_NAME']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="smtp_username"   value="<?php echo SMTP_USERNAME;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["smtp_username"])){ echo $this->form_error["smtp_username"]; }?></em></td>
                  </tr>

                   <tr>
                    <td><label><?php echo $this->Lang['PASSWORD']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="password" name="smtp_password"   value="<?php echo SMTP_PASSWORD;?>" maxlength="50" />
                    <em><?php if(isset($this->form_error["smtp_password"])){ echo $this->form_error["smtp_password"]; }?></em></td>
                  </tr>

                  <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" name="sendgrid" title="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" title="<?php echo $this->Lang['CANCEL']; ?>"  onclick='window.location.href="<?php echo PATH?>admin.html"'/></td>
                  </tr>

            </table>
        </form>
	</div>
<?php }?>
<?php if(EMAIL_TYPE==2){ ?>
<div id="smtp" >
         <form action="" method="post" class="admin_form">
            <table>
            	  <tr>
                    <td></td>
                    <td></td>
                    <td>
                  <?php echo $this->Lang["SMTP_ALERT"]; ?></td>
                  </tr>

                  <tr>
                    <td><label><?php echo $this->Lang['SMTP_HOST']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="host"  value="<?php echo HOST;?>" maxlength="150" autofocus />
                    <em><?php if(isset($this->form_error["host"])){ echo $this->form_error["host"]; }?></em></td>
                 </tr>

                   <tr>
                    <td><label> <?php echo $this->Lang['SMTP_PORT']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="port"  value="<?php echo PORT;?>" maxlength="10" />
                    <em><?php if(isset($this->form_error["port"])){ echo $this->form_error["port"]; }?></em></td>
                  </tr>

                   <tr>
                    <td><label><?php echo $this->Lang['SMTP_USER_N']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="username"   value="<?php echo USERNAME;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["username"])){ echo $this->form_error["username"]; }?></em></td>
                  </tr>

                   <tr>
                    <td><label><?php echo $this->Lang['SMTP_PASS']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="password" name="password"   value="<?php echo PASSWORD;?>" maxlength="50" />
                    <em><?php if(isset($this->form_error["password"])){ echo $this->form_error["password"]; }?></em></td>
                  </tr>

                  <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" name="smtp" title="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" title="<?php echo $this->Lang['CANCEL']; ?>"  onclick='window.location.href="<?php echo PATH?>admin.html"'/></td>
                  </tr>

            </table>
        </form>
	</div>
<?php }?>
<?php if(EMAIL_TYPE==3){ ?>
<div id="mailchimp" >
         <form action="" method="post" class="admin_form">
            <table>
            	  <tr>
                    <td></td>
                    <td></td>
                    <td>
                  <?php echo $this->Lang["SMTP_ALERT"]; ?></td>
                  </tr>

                  <tr>
                    <td><label><?php echo $this->Lang['MAIL_CHIMP']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="api"  value="<?php echo API;?>" maxlength="150" />
                    <em><?php if(isset($this->form_error["api"])){ echo $this->form_error["api"]; }?></em></td>
                 </tr>

                   <tr>
                    <td><label><?php echo $this->Lang['MAIL_CHIMP']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="listid"  value="<?php echo LISTID;?>" maxlength="10" />
                    <em><?php if(isset($this->form_error["listid"])){ echo $this->form_error["listid"]; }?></em></td>
                  </tr>

                   <tr>
                    <td><label><?php echo $this->Lang['REPLY_T_MAIL']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="replay"   value="<?php echo REPLAY_TO_MAIL;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["replay"])){ echo $this->form_error["replay"]; }?></em></td>
                  </tr>

                   <tr>
                    <td><label><?php echo $this->Lang['FROM_NAME']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="from"   value="<?php echo FROM;?>" maxlength="50" />
                    <em><?php if(isset($this->form_error["from"])){ echo $this->form_error["from"]; }?></em></td>
                  </tr>

                  <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>"  name="mailchimp" title="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" title="<?php echo $this->Lang['CANCEL']; ?>"  onclick='window.location.href="<?php echo PATH?>admin.html"'/></td>
                  </tr>

            </table>
        </form>
	</div>
<?php }?>

    </div>

    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
