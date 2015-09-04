<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script>
$(document).ready(function(){
 
 $("#commentpaypal_deals").validate({
	messages: {
		
			friend_name: {
			   required: "<?php echo $this->Lang['PLS_ENT_FRD_NAM']; ?>"                         
		   },
		   	friend_email: {
			   required: "<?php echo $this->Lang['PLS_ENT_FRD_EMAIL']; ?>", 
			    email : "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>"                             
		   },
		}
	});
});
</script>
<form name="payment" method="POST" id="commentpaypal_deals" action="<?php echo PATH; ?>payment/paypal.php">
<div class="payment_form_block clearfix">
<?php  foreach($this->deals_payment_deatils as $payment) {  ?>

        <?php if($this->uri->segment(2) == "payment_details_friend"){ ?>
     
                        <h3 class="type_form_title"><?php echo $this->Lang['FRI_INFO']; ?></h3>
						<div class="payment_form_section">
						<div class="payment_form">
										<ul>
											<li>
												<label> <?php echo $this->Lang['FRI_NAME']; ?> :<span class="form_star">*</span></label>
												<div class="fullname"><input type="text" value="" name="friend_name" AUTOCOMPLETE="OFF"  class="required" placeholder="<?php echo $this->Lang['ENTER_FRI_NAME']; ?>" autofocus /></div>
												<em>
                        <?php if(isset($this->form_error['friend_name'])){ echo $this->form_error["friend_name"]; }?>
                        </em>
											</li>
											<li>
												<label><?php echo $this->Lang['FRI_EMAIL']; ?> :<span class="form_star">*</span></label>
												<div class="fullname"><input type="text" value="" name="friend_email" AUTOCOMPLETE="OFF"  class="required" placeholder="<?php echo $this->Lang['ENTER_FRI_EMAIL']; ?>"/></div>
												<em>
                        <?php if(isset($this->form_error['friend_email'])){ echo $this->form_error["friend_email"]; }?>
                        </em>
											</li>
											</ul>
											</div>
											</div>
                
                <input name="friend_gift"  value="1" type="hidden">

        <?php } else {?>
                <input name="friend_name"  type="hidden" value="xxxyyy" >
                <input name="friend_email"   type="hidden" value="xxxyyy@zzz.com" >
                <input name="friend_gift"  value="0" type="hidden">
        <?php } ?>
        <input name="P_QTY" id="PC_QTY_VAL" value="1" type="hidden" >
        <input name="deal_id"  type="hidden" value="<?php echo $payment->deal_id; ?>" >
        <input name="deal_key" type="hidden" value="<?php echo $payment->deal_key; ?>" >
        <input name="deal_value" type="hidden" value="<?php echo $payment->deal_value; ?>" >
        <input name="amount" id="PC_AMOUNT"  type="hidden" value="<?php echo $payment->deal_value; ?>" >
        <input name="p_referral_amount" id="PC_REFERRAL" value="0" type="hidden" >


          <div class="personal_info_panel"> <div class="paypal_link"> <a > <input name="Submit" type="submit" value="" tabindex="1" /> </a></div>  </div>
          <?php if(count($this->cms_tc) > 0){ ?>
        <div class="payment_terms_outer"><p class="terms-conditons-text"> <span class="fl font_myriad_pro"><?php echo $this->Lang['BY_CLICK1']; ?> </span> <a onclick="show_dis_tc();" tabindex="2" title="<?php echo $this->Lang['TEMRS']; ?>" class="font_myriad_pro mt5"><?php echo $this->Lang['TEMRS']; ?>.</a></p> </div>        
        <?php } ?>
        <?php } ?>
</div>
</form>
