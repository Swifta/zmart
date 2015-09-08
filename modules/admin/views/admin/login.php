<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript">
window.onload=function() {
document.forms[0][0].focus();
}
</script>

	<div class="login_inner" id="login">
    
  
     <div class="login_cont_mid"> 
		<div class="login_container">
    		
                <div class="login_form">
                	<h1><?php if(isset($this->is_merchat)){echo  $this->Lang["MERCHANT_LOGIN_TITLE"];}else if(isset($this->is_store_admin)){ echo $this->Lang['STORE_ADMIN_LOGIN']; }else{echo $this->Lang["VIEW_LOGIN_TITLE"]; }?></h1><?php if(isset($this->error_login)){ ?><span class="login_error"><?php echo $this->error_login; ?></span><?php } ?>
                    <div class="form">
                    <form action="" method="post">
                        <table  cellpadding="5"  cellspacing="5" width="260" >
                            <tr>
                            	<td class="width70 login_txt" align="left" valign="middle"><strong ><?php echo $this->Lang["EMAIL"]; ?> : </strong></td>
                                </tr>
                                <tr>
                                <td>
                                     
                                    <div class="login_uname_bg"><input type="text"  name="email" value="<?php if(isset($this->postemail)){ echo $this->postemail; }?>"/></div>
                                    
                                </td>
                             </tr>
                            <tr>
                            	<td class="width70 login_txt" align="left"><strong ><?php echo $this->Lang["PASSWORD"]; ?> : </strong></td> 
                                </tr>
                                <tr>
                                <td>
                                   
                                    <div class="login_pass_bg"><input type="password" name="password"/></div>
                                 
                            	</td>
                            </tr>
                               <tr>
                          
                          <td class="login_forget"> <?php if(isset($this->is_merchat) || isset($this->is_store_admin) ){?> <span style="cursor:pointer; color:white;" >
<a <?php if(isset($this->is_merchat)){?> onclick="window.location.href='<?php echo PATH; ?>merchant/forgot-password.html'" <?php }else{?> onclick="window.location.href='<?php echo PATH; ?>store-admin/forgot-password.html'"<?php }?> title="<?php echo $this->Lang['FORGOT_PASS']; ?>"> <?php echo $this->Lang['FORGOT_PASS']; ?></a> </span><?php }else { ?> <?php }?>   </td>
                          </tr> 
                          
  
                          
                            <tr>
                            	
                                <td align="left">
                            		<input type="submit" class="login_text" value=""  title="<?php echo $this->Lang['LOGIN']; ?>" />

                            	</td>
                            </tr>
                         
		
                        </table>
                    </form>
                                        </div>
						<?php /* if(isset($this->is_merchat)){?> <span style="cursor:pointer; color:white; float:right; margin-top:-37px;" >
<a onclick="window.location.href='<?php echo PATH; ?>merchant/forgot-password.html'" title="Forgot Password"> Forgot Password</a> </span><?php }else{ } */ ?>
                   
                     </div>
                    	
                 </div>
    </div>
    </div>
    </div>

   
    </div>  
