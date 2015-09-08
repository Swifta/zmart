<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="login_inner"  >
		
    		
                <div class="login_form forget_form">
                   <div class="login_form_middle">
                    <div class="login_container">
                    <div class="login_form">
                        <h1><?php echo $this->Lang['FORGOT_PASS']; ?></h1>
                        <div class="form">
                        <form action="<?php echo PATH;?>store-admin/forgot-password.html" method="post">
                            
                            <ul>
                                <li><strong ><?php echo $this->Lang["EMAIL"]; ?> : </strong></li>
                                <li>
                                    <div class="login_uname_bg ml10"><input type="text" name="email" value="" class="login_txt ml10" maxlength="256"/></div>
                                    <?php if(isset($this->email_error)){ echo "<em>".$this->email_error."</em>"; } ?>
                                    <em><?php if(isset($this->form_error['email'])){ echo $this->form_error["email"]; }?></em>
                                </li>
                                <li><img height="35" width="150" src="<?php echo PATH; ?>/captcha/default" alt="<?php echo $this->Lang['CAPTCHA']; ?>" /></li>
                                <li><p><?php echo $this->Lang['ETR_TXT_BLW']; ?></p></li>
                                <li><strong ><?php echo $this->Lang['CAPTCHA']; ?> : </strong></li>
                                <li>
                                    <div class="login_capcta_bg"> <input class="ml10" type="text" name="captcha"  maxlength="32"/> </div>
                                    <div class="captcha_error_msg"><?php if(isset($this->captcha_error)){ echo "<em>".$this->captcha_error."</em>"; } ?></div>
                                    <div class="captcha_error_msg"><em><?php if(isset($this->form_error['captcha'])){ echo $this->form_error["captcha"]; }?></em></div>
                                 </li>
                                <li>
                                    <input class="submit" type="submit" value="" title="<?php echo $this->Lang['SUBMIT']; ?>"/> 
                                    <input class="cancel" type="button"  title="<?php echo $this->Lang['CANCEL']; ?>"  onclick="window.location.href='<?php echo PATH; ?>store-admin-login.html'"/>
                                </li>
                            </ul>
                     </form>
                        </div>
                     </div>
                    </div>
                 
                 </div>
                 
                 <div class="login_form_bottom">  </div>
                 
        	
            
    </div>

   

