<?php defined('SYSPATH') OR die("No direct access allowed."); ?>
<style>
.clor2 {
color: navy;
font: normal 13px arial;
}
</style>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label><?php echo $this->Lang["CODE"]; ?></label> <span>*</span></td>
		   
                    <td><label>:</label></td>
                    <td>
                    	<input type="text" name="code" value="<?php if(!isset($this->form_error['code'])&&isset($this->userPost['code'])){ echo $this->userPost['code']; }?>" autofocus />
                      	<em><?php if(isset($this->form_error['code'])){ echo $this->form_error['code']; }?></em>
                   	</td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/couopn_code.html'"/></td>
                </tr>
            </table>
        </form>
        <div class="table_over_flow">
            <table class="list_table fl clr mt20">

                          <?php if(isset($this->deal_list)){ 
                           foreach($this->deal_list as $u){?>


                   <?php if ($u->coupon_code_status== 1){ 
                                                                           echo " <th colspan='9'  style='text-align:center; background:none;'><font color='green'>".$this->Lang['COUPON_AVIL']."</font></th>";  ?>
                                                                           <?php } else { 
                                                                           echo "<th colspan='9' style='text-align:center; background:none;'><font color='red'>".$this->Lang['COUPON_ALREADY']."</font></th>";  ?>
   <?php }?>



                           <tr> 
                           <th align="left" width="10%"><?php echo $this->Lang["DEAL_IMG"]; ?></th> 
                           <th align="left" width="17%"><?php echo $this->Lang["DEALS_NAME"]; ?></th>
                           <th align="left" width="5%"><?php echo $this->Lang["PRICE"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></th>
                           <th align="left" width="5%"><?php echo $this->Lang["DEALVALUE"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></th>
                           <th align="left" width="5%"><?php echo $this->Lang["SAVINGS"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></th>
                           <th align="left" width="5%"><?php echo $this->Lang["COUPON_CODE"]; ?></th>
                           <th align="left" width="15%" ><?php echo $this->Lang["TRANS_TYPE"]; ?></th>
                           <?php if($u->type =="5"){ ?> <th align="left" width="4%" ><?php echo $this->Lang["PAY_AMOUNT"]; ?><?php echo '('.CURRENCY_SYMBOL.')';?></th> <?php } ?>
                           <th align="left" width="15%"><?php echo $this->Lang['MA_GE']; ?></th>
                           <th align="left" ><?php echo $this->Lang["PAY_LATER_DOCUMENT"]; ?></th>

                           </tr>
                          <td align="left">

                           <?php if(file_exists(DOCROOT.'images/deals/1000_800/'.$u->deal_key.'_1.png')) { ?>

                           <img border="0" src= "<?php echo PATH.'images/deals/1000_800/'.$u->deal_key.'_1'.'.png';?>" alt="" width="80" />

                           <?php } else { ?>

                           <img border="0" src= "<?php echo PATH.'themes/'.THEME_NAME.'/images/noimage_products_list.png';?>" alt="" width="80" />
                           <?php } ?>

                          </td>
                           <td align="left"><?php echo $u->deal_title; ?></td>
                           <td align="left"><?php echo $u->deal_price; ?></td>
                           <td align="left"><?php echo $u->deal_value; ?></td>
                           <td align="left"><?php echo $u->deal_savings; ?></td>
                           <td align="left"><?php echo $u->coupon_code; ?></td>
                           <td align="left">
                                           <?php if($u->type=="1"){ echo '<span class="clor2">'. $this->Lang["PAYPAL_CREDIT"] .'</span>'; } ?>
                                           <?php if($u->type=="2"){ echo '<span class="clor2">'. $this->Lang["PAYPAL"] .'</span>'; } ?>
                                           <?php if($u->type=="3"){ echo '<span class="clor2">'. $this->Lang["REF_PAYMENT"] .'</span>'; } ?>
                                           <?php if($u->type=="4"){ echo '<span class="clor2">'. $this->Lang["AUTHORIZE"].'</span>';  } ?>
                                           <?php if($u->type =="5"){ echo '<span class="clor2">'. $this->Lang["CASH_ON_DEL"] .'</span>'; } ?>

                           </td>
                           <?php  if($u->type =="5"){ ?>
                                           <td align="left">
                                                   <?php $total_amount = ($u->amount)/($u->quantity);
                                                           echo $total_amount;
                                                   ?>
                                           </td>
                                   <?php	} ?>
                                           <?php /* if($u->type==5 ){ ?>
                                                   <td align="center">
                                                   <?php if($u->coupon_code_status == 1) { ?>	
                                                   <?php if($u->coupon_code_status==0) {
                                                                   echo $this->Lang['DELIVERED'];
                                                           ?>

                                                   <?php } elseif($u->coupon_code_status==2) {
                                                                           echo $this->Lang['FAILED'];
                                                           } else { ?>
                                                           <select  onchange="return deal_cod_delivery('<?php echo $u->coupon_code;?>',this.value,'<?php echo $u->trans_id; ?>','<?php echo $u->deal_id; ?>','<?php echo $u->merchant_id; ?>','close')">
                                                                   <option value="0" ><?php echo $this->Lang['PENDING']; ?></option>
                                                                   <option value="4" ><?php echo $this->Lang['DELIVERED']; ?></option>
                                                                   <option value="5" ><?php echo $this->Lang['FAILED']; ?></option>
                                                           <?php } ?>
                                                   <?php } else { } ?>
                       </td>
                                           <?php } else {  */?>
                           <td><?php $type = ($u->type == 5)?1:0; if($u->coupon_code_status == 1){  ?>

                                                   <a onclick="return admin_close_deal('<?php echo $u->deal_id; ?>','<?php echo $u->coupon_code; ?>','close','<?php echo $u->trans_id; ?>','<?php echo $type; ?>');" class="close"></a>

                                                   <?php }else { echo "---"; }?>
                                                   </td>
                           <?php //} ?>
                            <td><?php if($u->type=="6"){ if(file_exists(DOCROOT.'images/Pay_Later_Doc/'.$u->file_name) && $u->file_name!=''){ ?> <a href="<?php echo PATH.'images/Pay_Later_Doc/'.$u->file_name;?>"><?php echo $u->file_name;?></a><?php }else{ echo " - - -";}}else{ echo " - - - ";}?></td>
                        <?php  } }?>

            </table>
     </div>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
  
