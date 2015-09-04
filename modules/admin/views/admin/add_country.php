<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form">
            <table>
                <tr>
                    <td><label><?php echo $this->Lang["COUNTRY_NAME"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="country" maxlength="32" value="" autofocus />
                    <em><?php if(isset($this->form_error["country"])){ echo $this->form_error["country"]; }?></em></td>
                </tr>
                <tr>
                    <td><label><?php echo $this->Lang['COUN_CO']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="country_code" maxlength="3" value=""/>
                    <em><?php if(isset($this->form_error["country_code"])){ echo $this->form_error["country_code"]; }?></em></td>
                     
                </tr>
                 <tr><td></td><td></td><td><p><?php echo $this->Lang['EX_AL']; ?></p></td></tr>
                <tr>
                    <td><label><?php echo $this->Lang["CUUR_SYM"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                     <td><input type="text" name="currency_symbol" maxlength="5" value="" />
                     <em><?php if(isset($this->form_error["currency_symbol"])){ echo $this->form_error["currency_symbol"]; }?></em></td>
                     
                </tr>
                <tr>
					<td></td><td></td><td><p><?php echo $this->Lang["EXAM1"]; ?></p></td>
                </tr>
                 <tr>
                    <td><label><?php echo $this->Lang["CUUR_CODE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="currency_code" maxlength="3" value=""/>
                    <em><?php if(isset($this->form_error["currency_code"])){ echo $this->form_error["currency_code"]; }?></em></td>
                     
                </tr>
                 <tr><td></td><td></td><td><p><?php echo $this->Lang["EXAM2"]; ?></p></td></tr>
                <tr>
				
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/add-country.html'"/></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
