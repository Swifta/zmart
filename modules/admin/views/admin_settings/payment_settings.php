<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
       
       <?php foreach($this->payment_settings_data as $general){ ?>
        <form action="" method="post" class="admin_form">

	<div class="mergent_det">
	<fieldset>
   		<legend><?php echo $this->Lang['SHIP_ING']; ?> </legend>
            <table>
             
            
                <tr >
                    <td style="width: 200px;"><label><?php echo $this->Lang['FLAT_SH']; ?> ( <?php  echo CURRENCY_SYMBOL; ?> )</label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="flat_shipping" maxlength="4" value="<?php echo $general->flat_shipping; ?>" autofocus />
                    <em><?php if(isset($this->form_error["flat_shipping"])){ echo $this->form_error["flat_shipping"]; }?></em></td>
                </tr>
                <input type="hidden" name="tax_percentage" maxlength="3"   value="<?php echo $general->tax_percentage; ?>"/>
                <?php /* <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang['TAX_PERS']; ?> ( <?php  echo '%'; ?> )</label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="tax_percentage" maxlength="3"   value="<?php echo $general->tax_percentage; ?>"/>
                    <em><?php if(isset($this->form_error["tax_percentage"])){ echo $this->form_error["tax_percentage"]; }?></em></td>
                </tr> */ ?>
               
               
		</table>
	</fieldset>
	<fieldset>
   		<legend><?php echo $this->Lang['STR_CRD']; ?> </legend>
            <table>
				<tr>
                    <td style="width: 200px; "><label><?php echo $this->Lang['MON_LMT_STR']; ?> ( <?php  echo CURRENCY_SYMBOL; ?> )</label><span>*</span></td>
                    <td><label>:</label></td>
                    <td ><input type="text" name="monthly_storecredit"  value="<?php echo $general->monthly_storecredit; ?>" autofocus />
                    <em><?php if(isset($this->form_error["monthly_storecredit"])){ echo $this->form_error["monthly_storecredit"]; }?></em></td>
                </tr>
             </table>
	</fieldset>
</div>

<div class="mergent_det2">
	<fieldset>
   		<legend><?php echo $this->Lang['AUCTION']; ?></legend>
            <table>
             
            
                <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang['EXT_DAYS']; ?> </label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="auction_extend_day" maxlength="8" value="<?php echo $general->auction_extend_day; ?>" />
                    <em><?php if(isset($this->form_error["auction_extend_day"])){ echo $this->form_error["auction_extend_day"]; }?></em></td>
                </tr>

                <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang['ALTE_DAY']; ?> </label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="auction_alert_day" maxlength="8"   value="<?php echo $general->auction_alert_day; ?>"/>
                    <em><?php if(isset($this->form_error["auction_alert_day"])){ echo $this->form_error["auction_alert_day"]; }?></em></td>
                </tr>
                
		</table>
	</fieldset>
</div>
<div class="mergent_det2">
	<fieldset>
   		<legend><?php echo $this->Lang["FUND_REQ"]; ?> / <?php echo $this->Lang['REFERRAL']; ?></legend>
            <table>
             
            
                <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang["MIN_FUND"]; ?> ( <?php  echo CURRENCY_SYMBOL; ?> )</label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="minfund" maxlength="8" value="<?php echo $general->min_fund_request; ?>" />
                    <em><?php if(isset($this->form_error["minfund"])){ echo $this->form_error["minfund"]; }?></em></td>
                </tr>

                <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang["MAX_FUND"]; ?> ( <?php  echo CURRENCY_SYMBOL; ?> )</label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="maxfund" maxlength="8"   value="<?php echo $general->max_fund_request; ?>"/>
                    <em><?php if(isset($this->form_error["maxfund"])){ echo $this->form_error["maxfund"]; }?></em></td>
                </tr>
                
                <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang["REF_AMM"]; ?> ( <?php  echo CURRENCY_SYMBOL; ?> ) </label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="referral_amount" maxlength=8 value="<?php echo $general->referral_amount; ?>" />
  
                    <em><?php if(isset($this->form_error["referral_amount"])){ echo $this->form_error["referral_amount"]; }?></em></td>

                </tr>
		</table>
	</fieldset>
</div>

<div class="mergent_det2">
	
	<fieldset>
   		<legend><?php echo 'Country'; ?> / <?php echo $this->Lang["CURRENCY1"]; ?></legend>
            <table>
				
                <table id="CitySD">
					<tr >
                    <td style="width: 200px;"><label><?php echo $this->Lang["COUNTRY_NAME"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><select name="country" onchange="return country_change(this.value);">
						
			<?php foreach($this->country_list as $name){ ?>
						<option value="<?php echo $name->country_id; ?> "> <?php echo $name->country_name; } ?>
			<option value=""><?php echo $this->Lang['SEL_COUNTRY']; ?></option>
			
			
			<?php foreach($this->countryname_list as $country){ ?>

				<option value= "<?php echo $country->country_id;?>" ><?php echo $country->country_name;?></option>
						<?php } ?>
			</select>
  
                    <em><?php if(isset($this->form_error["country"])){ echo $this->form_error["country"]; }?></em></td>
                </tr>
					 <tr>
                    <td><label><?php echo $this->Lang['COUN_CO']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="country_code" maxlength="3" readonly readonly value="<?php echo $general->country_code; ?>"/>
                  
                    <em><?php if(isset($this->form_error["country_code"])){ echo $this->form_error["country_code"]; }?></em></td>
                     
                </tr>
                
		<tr>
			<td  style="width: 200px;"><label><?php echo $this->Lang['CURRENCY']; ?> </label><span>*</span></td>
			<td><label>:</label></td>
			<td><input type="text" name="currency_symbol" readonly value="<?php echo $general->currency_symbol; ?>" readonly /></td>
		</tr>
		<tr>
			<td  style="width: 200px;"><label><?php echo $this->Lang['CUUR_CODE']; ?></label><span>*</span></td>
			<td><label>:</label></td>
			<td><input type="text" name="currency_code" readonly maxlength=3 value="<?php echo $general->currency_code; ?>" /></td>
		</tr>
		</table>
		</table>
	</fieldset>
</div>
				
<div class="mergent_det2">
	<fieldset>
    	<legend><?php echo $this->Lang["PAYMENT_ACC"]; ?></legend>   
			<table>
		        <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang['PAL_ACC']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="Paypal_Account" maxlength="100"   value="<?php echo $general->paypal_account_id; ?>"/>
                    <em><?php if(isset($this->form_error["Paypal_Account"])){ echo $this->form_error["Paypal_Account"]; }?></em></td>
                </tr>
                
		        <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang['PAL_API_PASS']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="Paypal_API_Password" maxlength="32"   value="<?php echo $general->paypal_api_password; ?>"/>
                    <em><?php if(isset($this->form_error["Paypal_API_Password"])){ echo $this->form_error["Paypal_API_Password"]; }?></em></td>
                </tr>
                
		        <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang['PAYPAL_API_SIG']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="Paypal_API_Signature" maxlength="150"   value="<?php echo $general->paypal_api_signature; ?>"/>
                    <em><?php if(isset($this->form_error["Paypal_API_Signature"])){ echo $this->form_error["Paypal_API_Signature"]; }?></em></td>
                </tr>
                
                <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang['AU_TR_KEY']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="authorizenet_transaction_key" maxlength="250"   value="<?php echo $general->authorizenet_transaction_key; ?>"/>
                    <em><?php if(isset($this->form_error["authorizenet_transaction_key"])){ echo $this->form_error["authorizenet_transaction_key"]; }?></em></td>
                </tr>
                
                <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang['AUTH_ID']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="authorizenet_api_id" maxlength="100"   value="<?php echo $general->authorizenet_api_id; ?>"/>
                    <em><?php if(isset($this->form_error["authorizenet_api_id"])){ echo $this->form_error["authorizenet_api_id"]; }?></em></td>
                </tr>
                
                  <tr>
                    <td style="width: 200px;"><label><?php echo $this->Lang['PAY_LATER_DETAILS']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><textarea name="pay_later" cols="5" rows="5"><?php echo $general->pay_later; ?></textarea>
                    <em><?php if(isset($this->form_error["pay_later"])){ echo $this->form_error["pay_later"]; }?></em></td>
                </tr>
                
                 <tr>
                    <td  style="width: 200px;"><label><?php echo $this->Lang["PAYMENT_MODE"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    <input type="radio" name="paypal_payment_mode" value="0" <?php if($general->paypal_payment_mode=="0"){ ?> checked <?php } ?>> <?php echo $this->Lang["TEST_ACCOUNT"]; ?>
                    <input type="radio" name="paypal_payment_mode" value="1" <?php if($general->paypal_payment_mode=="1"){ ?> checked <?php } ?>> <?php echo $this->Lang["LIVE_ACCOUNT"]; ?>
                    </td>
                </tr>
                
			</table>
	</fieldset>
</div>       


			<table>
				<tr>
                   
                    <td style="padding:15px 0px 0px 223px;"><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" title="<?php echo $this->Lang['UPDATE']; ?>" /><input type="button" title="<?php echo $this->Lang['CANCEL']; ?>"  value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>admin.html"'/></td>
                </tr>
            </table>
        </form>
        <?php } ?>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
