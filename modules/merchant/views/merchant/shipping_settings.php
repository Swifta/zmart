<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
      
        <?php foreach($this->shipping_settings_data as $general){ ?>
        <form action="" method="post" class="admin_form">
                        <div class="mergent_det">
	                        <fieldset>
                            	<legend><?php echo $this->Lang["ARAMAX_ACC"]; ?></legend>   
			                        <table>
		                                <tr>
                                            <td style="width: 200px;"><label><?php echo $this->Lang['ACCOUNTCOUNTRYCODE']; ?></label></td>
                                            <td><label>:</label></td>
                                            <td><input type="text" name="AccountCountryCode" maxlength="3"   value="<?php echo $general->AccountCountryCode; ?>" autofocus/>
                                            <em><?php if(isset($this->form_error["AccountCountryCode"])){ echo $this->form_error["AccountCountryCode"]; }?></em>
                                            </td>
                                        </tr>
                                        
		                                <tr>
                                            <td style="width: 200px;"><label><?php echo $this->Lang['ACCOUNTENTITY']; ?></label></td>
                                            <td><label>:</label></td>
                                            <td><input type="text" name="AccountEntity" maxlength="8"   value="<?php echo $general->AccountEntity; ?>"/>
                                            <em><?php if(isset($this->form_error["AccountEntity"])){ echo $this->form_error["AccountEntity"]; }?></em>
                                            </td>
                                        </tr>
                                        
		                                <tr>
                                            <td style="width: 200px;"><label><?php echo $this->Lang['ACCOUNTNUMBER']; ?></label></td>
                                            <td><label>:</label></td>
                                            <td><input type="text" name="AccountNumber" maxlength="32"   value="<?php echo $general->AccountNumber; ?>"/>
                                            <em><?php if(isset($this->form_error["AccountNumber"])){ echo $this->form_error["AccountNumber"]; }?>
                                            </em></td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="width: 200px;"><label><?php echo $this->Lang['ACCOUNTPIN']; ?></label></td>
                                            <td><label>:</label></td>
                                            <td><input type="text" name="AccountPin" maxlength="32"   value="<?php echo $general->AccountPin; ?>"/>
                                            <em><?php if(isset($this->form_error["AccountPin"])){ echo $this->form_error["AccountPin"]; }?></em></td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="width: 200px;"><label><?php echo $this->Lang['USERNAME']; ?></label></td>
                                            <td><label>:</label></td>
                                            <td><input type="text" name="UserName" maxlength="128"   value="<?php echo $general->UserName; ?>"/>
                                            <em><?php if(isset($this->form_error["UserName"])){ echo $this->form_error["UserName"]; }?></em></td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="width: 200px;"><label><?php echo $this->Lang['PASSWORD']; ?></label></td>
                                            <td><label>:</label></td>
                                            <td><input type="text" name="Password" maxlength="128"   value="<?php echo $general->ShippingPassword; ?>"/>
                                            <em><?php if(isset($this->form_error["Password"])){ echo $this->form_error["Password"]; }?></em></td>
                                        </tr>
                                        
			                        </table>
	                        </fieldset>
                        </div>       


			<table>
				<tr>
                   
                    <td style="padding:15px 0px 0px 223px;"><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" title="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" title="<?php echo $this->Lang['CANCEL']; ?>"  value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>merchant.html"'/></td>
                </tr>
            </table>
        </form>
        <?php } ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
