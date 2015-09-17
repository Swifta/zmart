<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form method="post"  class="admin_form" enctype="multipart/form-data">
                <table>     
                
                        <?php $merchant_amount = "0"; foreach($this->balance_list as $u){ $merchant_amount=$u->merchant_account_balance; } ?>
                        
                        <tr>
                                <td ><span>*</span><label><?php echo $this->Lang['ACC_BALANCE_IS'].CURRENCY_SYMBOL." ".$merchant_amount; ?></label></td>
                        </tr> 
                        
                        <tr>
                                <td ><span>*</span><label><?php echo $this->Lang['MINI_WITH_AMOUNT'].CURRENCY_SYMBOL." ".MIN_FUND_REQUEST; ?></label></td>
                        </tr> 
                        <tr>
                                <td><span>*</span><label><?php echo $this->Lang['MAX_WITH_AMOUNT'].CURRENCY_SYMBOL." ".MAX_FUND_REQUEST; ?></label></td>
                        </tr>          
                       
                         <tr>
                                <td ><label><?php echo $this->Lang['AMOUNT']; ?><span>*</span></label></td>
                                </tr>
                        <tr>
                                
                                <td><input type="text" maxlength="10" name="amount" autofocus />
                                <em><?php if(isset($this->error)){ echo $this->error; }?></em>
                                </td>
                        </tr>
                             
                                                                       
                        <tr>
                                <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>"  id="check2"/><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>merchant/add_fund_request.html'"/></td>
                        </tr>
                </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>






