<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
         <form action="" method="post" class="admin_form">
      
            <table>
             	<tr>
                    <td><label><?php echo $this->Lang["FB_APP_ID"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="facebook_app_id"  value="<?php echo FB_APP_ID; ?>" maxlength="50" autofocus />
                    <em><?php if(isset($this->form_error["facebook_app_id"])){ echo $this->form_error["facebook_app_id"]; }?></em></td>
                </tr>

                <tr>
                    <td><label><?php echo $this->Lang["FB_SEC_KEY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="facebook_secret_key"  value="<?php echo FB_APP_SECRET; ?>" maxlength="100" />
                    <em><?php if(isset($this->form_error["facebook_secret_key"])){ echo $this->form_error["facebook_secret_key"]; }?></em></td>
                </tr>

                 <tr>
                    <td><label><?php echo $this->Lang["F_PAG_LINK"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="facebook"  value="<?php echo FB_PAGE;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["facebook"])){ echo $this->form_error["facebook"]; }?></em></td>
                 </tr>
                   
                  <tr>
                    <td><label><?php echo $this->Lang["F_LIKE_LINK"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="fbfan"   value="<?php echo FB_FAN_PAGE;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["fbfan"])){ echo $this->form_error["fbfan"]; }?></em></td>
                  </tr>
	
	        <tr>
                    <td><label><?php echo $this->Lang["INS_PAG_LINK"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="instagram" value="<?php echo INSTAGRAM_PAGE;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["instagram"])){ echo $this->form_error["instagram"]; }?></em></td>
                </tr>
                <tr>
                    <td><label><?php echo $this->Lang["INS_USER"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="instagram_user_name" value="<?php echo INSTAGRAM_USER;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["instagram_user_name"])){ echo $this->form_error["instagram_user_name"]; }?></em></td>
                </tr>
                <tr>
                    <td><label><?php echo $this->Lang["INS_USER_ID"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="instagram_user_id" value="<?php echo INSTAGRAM_ID;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["instagram_user_id"])){ echo $this->form_error["instagram_user_id"]; }?></em></td>
                </tr>
		</tr>
                   <tr>
                    <td><label><?php echo $this->Lang["T_PAG_LINK"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="twitter"  value="<?php echo TWITTER_PAGE;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["twitter"])){ echo $this->form_error["twitter"]; }?></em></td>
                </tr>
		
		<tr>
                    <td><label><?php echo $this->Lang["TWI_API_ID"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="twitter_api_key"   value="<?php echo TWITTER_API_KEY;?>" maxlength="100" />
                    <em><?php if(isset($this->form_error["twitter_api_key"])){ echo $this->form_error["twitter_api_key"]; }?></em></td>
                </tr>
		<tr>
                    <td><label><?php echo $this->Lang["TWI_SEC_KEY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="twitter_secret_key"   value="<?php echo TWITTER_SECRET_KEY ;?>" maxlength="100" />
                    <em><?php if(isset($this->form_error["twitter_secret_key"])){ echo $this->form_error["twitter_secret_key"]; }?></em></td>
                </tr>
		<tr>
                    <td><label><?php echo $this->Lang["L_PAG_LINK"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="linkedin"   value="<?php echo LINKEDIN_PAGE;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["linkedin"])){ echo $this->form_error["linkedin"]; }?></em></td>
                </tr>
                
		<tr>
                    <td><label><?php echo $this->Lang["Y_LINK"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="youtube_url"   value="<?php echo YOUTUBE_URL;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["youtube_url"])){ echo $this->form_error["youtube_url"]; }?></em></td>
                </tr>
		<tr>
                    <td><label><?php echo $this->Lang["GMAP_APP_KEY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="gmapkey"   value="<?php echo GMAP_API_KEY ;?>" maxlength="100" />
                    <em><?php if(isset($this->form_error["gmapkey"])){ echo $this->form_error["gmapkey"]; }?></em></td>
                </tr>
                <tr>
                    <td><label><?php echo $this->Lang["A_PAG_LINK"]; ?></label></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="android" value="<?php echo ANDROID_PAGE;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["android"])){ echo $this->form_error["android"]; }?></em></td>
                </tr>
                <tr>
                    <td><label><?php echo $this->Lang["I_PAG_LINK"]; ?></label></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="iphone" value="<?php echo IPHONE_PAGE;?>" maxlength="256" />
                    <em><?php if(isset($this->form_error["iphone"])){ echo $this->form_error["iphone"]; }?></em></td>
                </tr>
		 <tr>
                    <td><label><?php echo $this->Lang["ANA_CODE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                   <td><textarea  name="analytics_code"><?php echo ANALYTICS_CODE;?> </textarea>
                    <em><?php if(isset($this->form_error["analytics_code"])){ echo $this->form_error["analytics_code"]; }?></em></td>
                </tr>
		<?php /*<tr>
                    <td><label><?php echo $this->Lang['AUTO_POST_FA']; ?> </label></td>
                    <td><label>:</label></td>
                                
                    <td>
	<?php if($this->status!=1) { ?> 
	 <a class="f_connect_1" style="cursor:pointer;" title="<?php echo $this->Lang['FB']; ?>" onClick="facebookconnect();">&nbsp;</a>
	<?php } else {?>

	<input type="checkbox" name="autopost" class="textmessage" id="textmess"  <?php if($this->status==1) { ?> checked   <?php }?>  value="1" >

	<?php } ?>
                    </td>
                </tr>*/?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" title="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" title="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH;?>admin.html"'/></td>
                </tr>
            </table>
           
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
