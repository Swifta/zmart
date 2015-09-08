<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$this->session = Session::instance();
$this->UserName = $this->session->get("UserName");
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
    <table width="700" cellpadding="0" align="center" cellspacing="0" border="0" bgcolor="#ffffff">
    <?php foreach($this->products_list as $p ) { ?>
        <tr height="63">
            <td valign="middle" align="left">
				<div style="margin:0 auto;width:636px;">
					<a href="<?php echo PATH; ?>" title="<?php echo SITENAME; ?>">
						<img src="<?php echo THEME; ?>images/logo.png"  alt="<?php echo SITENAME; ?>"  />
					</a>
				</div>          
            </td>
            
        </tr>
        <tr>
            <td>
                <div style="width:636px;margin:0 auto;">
                
                <div style="text-align:center;margin:0 0 20px;padding:30px 0;background:#e2e2e2"> 
<strong style="font-size:20px;font-weight:bold;font-family:Arial;margin-left:20px;color:#666"><?php echo $this->Lang['DEAR']; ?> <?php echo $this->Lang['ADMIN']; ?>,</strong><br>
<strong style="font-size:16px;font-weight:bold;font-family:Arial;margin-left:20px;color:#666"><?php echo $this->Lang['GREE_THE_DAY']; ?></strong><br>
<b style="font-size:12px;margin-left:20px;font-weight:normal;font-family:Arial;color:#666"> <?php echo $this->Lang['THANKYOU_SAVING_PURCH']; ?></b><br>
<b style="font-size:12px;margin-left:20px;font-weight:normal;font-family:Arial;color:#666"> <?php echo $this->Lang['THANKYOU_DELIVERY_ADDRESS']; ?></b><br>
</div>

        <div style="text-align:center;margin:0 0 20px;padding:10px 0;background:#e2e2e2;">
                            <strong style="font-size: 20px; font-weight:bold; font-family: Arial;color:#666;"><?php echo $this->Lang['SHIP_DET']; ?></strong><br>
                            <b style="font-size: 12px; font-weight:bold; font-family: Arial;color:#666;"><?php echo $this->Lang['NOTE']; ?>:</b><b style="font-size: 12px; font-weight: normal;font-family: Arial;color:#666;"> <?php echo $this->Lang['THIS_SH_CON_FO_IT']; ?> </b>
                        </div>
                    <table cellpadding="0" cellspacing="0" width="100%">
                    
                     <?php
                                                        $use_firstneme = "";
                                                        $use_lastname = "";
                                                        $use_email = "";                                                        
                                                        $this->get_merchant_details = $this->creditcard_paypal_pay->get_user_details();
                                                        
                                                        $use_firstneme = $this->get_merchant_details->current()->firstname;
                                                        $use_lastname = $this->get_merchant_details->current()->lastname;
                                                        $use_email = $this->get_merchant_details->current()->email;   
                                          ?> 
                                            <tr>
                                                <div style="text-align:center;margin:0 0 20px;padding:10px 0;background:#e2e2e2">
                                                <b style="font-size:12px;font-weight:bold;font-family:Arial;color:#666"><?php echo $this->Lang['BUYERS_NAME']; ?>:</b><b style="font-size:12px;font-weight:normal;font-family:Arial;color:#666"> <?php echo $use_firstneme; ?> <?php echo $use_lastname; ?> </b><br>
                                                <b style="font-size:12px;font-weight:bold;font-family:Arial;color:#666"><?php echo $this->Lang['BUYERS_EMAIL']; ?>:</b><b style="font-size:12px;font-weight:normal;font-family:Arial;color:#666"> <?php echo $use_email; ?> </b>
                                                </div>
                                            </tr>
                                            
                        <tbody>
                        <?php
							$this->creditcard_paypal_pay = new Creditcard_paypal_Model;
						if($p->type == 5) {
							$this->product_list1 = $this->creditcard_paypal_pay->get_products_list($p->transactionid,"COD");
						} else {
						//	$this->creditcard_paypal_pay = new Creditcard_paypal_Model;
							$this->product_list1 = $this->creditcard_paypal_pay->get_products_list($p->transactionid);
						}
                     
					$j=1;
					
					$val_tot = 0;
					$tax_tot =0;
					$tot_ship =0;
					$grand_tot=0;
					foreach($this->product_list1 as $u) { ?>
                        
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <table class="printtable" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td colspan="7"><b style="font-size: 15px; font-weight:bold; font-family: Arial;color:#144F5D;"><?php echo $j.". ".ucfirst($u->deal_title); ?>  </b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">&nbsp;</td>
                                            </tr>
                                            <?php
                                                        $merchant_firstneme = "";
                                                        $merchant_lastname = "";
                                                        $merchant_email = "";                                                        
                                                        $this->get_merchant_details = $this->creditcard_paypal_pay->get_merchant_details($u->merchant_id);
                                                        
                                                        $merchant_firstneme = $this->get_merchant_details->current()->firstname;
                                                        $merchant_lastname = $this->get_merchant_details->current()->lastname;
                                                        $merchant_email = $this->get_merchant_details->current()->email;   
                                          ?> 
                                            <tr>
                                                <div style="text-align:center;margin:0 0 20px;padding:10px 0;background:#e2e2e2">
                                                <b style="font-size:12px;font-weight:bold;font-family:Arial;color:#666"><?php echo $this->Lang['MERCHANT_NAME']; ?>:</b><b style="font-size:12px;font-weight:normal;font-family:Arial;color:#666"> <?php echo $merchant_firstneme; ?> <?php echo $merchant_lastname; ?> </b><br>
                                                <b style="font-size:12px;font-weight:bold;font-family:Arial;color:#666"><?php echo $this->Lang['MERCHANT_EMAIL']; ?>:</b><b style="font-size:12px;font-weight:normal;font-family:Arial;color:#666"> <?php echo $merchant_email; ?> </b>
                                                </div>
                                            </tr>
                                            
                                            <tr>
                                                <td colspan="7">
                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td width="20%" valign="top">
                                                                <b style="font-size: 14px;font-family: arial;font-weight: bold;color: #666;"><?php echo $this->Lang['SHOP_ADDR']; ?> : </b><br> <div style=" float:left;width: 80%; text-align:left;color:#666; font: bold 12px arial;">
																<b style="padding-top:5px;display:block;"><?php echo $u->store_name ; ?>,</b>
                                                                <b style="padding-top:5px;display:block;"><?php echo $u->addr1; ?>,</b>
                                                                <b style="padding-top:5px;display:block;"><?php echo $u->addr2 ; ?>,</b>
                                                                <b style="padding-top:5px;display:block;"><?php echo common::get_city_name($u->str_city_id)." - ".$u->zipcode; ?></b>
                                                                <b style="padding-top:5px;display:block;">Phone: <?php echo $u->str_phone; ?>.</b>
                                                                
                                                                </div>
                                                            </td>
                                                            <td width="80%" valign="top">
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">

                                                <td width="13%" align="center"><?php echo $this->Lang['COLOR']; ?></td>
                                                <td width="13%" align="center"><?php echo $this->Lang['SIZE']; ?></td>
                                                <td width="13%" align="center"><?php echo $this->Lang['QUAN']; ?></td>
                                                <td width="13%" align="center"><?php echo $this->Lang['UNIR_PR']; ?></td>
                                                <td width="13%" align="center"><?php echo $this->Lang['DEALVALUE']; ?></td>
                                                <td width="13%" align="center"><?php echo $this->Lang['SUB_TOT']; ?></td>
                                            </tr>
                                            <tr><td colspan="7">&nbsp;</td></tr>
											<tr style="font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">

                                                 <td width="13%" align="center">
													<?php if($u->product_color !=0 ) { foreach($this->product_color as $pro){ ?>
														<?php if($u->product_color == $pro->id){ ?>   
															<?php echo ucfirst($pro->color_name); ?>
														<?php } } } else echo "--";?></td>
                                                <td width="13%" align="center">
													<?php if($u->product_size != 0 ){ foreach($this->product_size as $size){ ?>
														<?php if($u->product_size == $size->size_id){ ?>  
															<?php echo $size->size_name; ?> 
														<?php } } } else echo"--"; ?>
												</td>

											<td width="13%" align="center"><?php echo $u->quantity; ?></td>
											<td width="13%" align="center"><?php if($u->deal_price!=0){ echo CURRENCY_SYMBOL.$u->deal_price; } else { echo CURRENCY_SYMBOL.$u->deal_value; } ?></td>
											<td width="13%" align="center"><?php  if($u->deal_price!=0){  echo CURRENCY_SYMBOL.$u->deal_value; } else { echo "-"; } ?></td>
                                            <td width="13%" align="center"><?php echo CURRENCY_SYMBOL.$u->deal_value * $u->quantity; ?></td>
                                           
                                        </tr>

								</table>
								 <?php  $ship_dispay ="";  if($u->shipping_methods == 1){ 
                                                                $ship_dispay = $this->Lang['FREE_SHIPP_PROD'];
                                                                } ?>                                                                
                                                                <?php if($u->shipping_methods == 2){ 
                                                                $ship_dispay = $this->Lang['FLAT_SHIPP_T_PRO'];
                                                                } ?>                                                                
                                                                <?php if($u->shipping_methods == 3){ 
                                                                $ship_dispay = $this->Lang['PER_PRO_SHIPP_PRODUCT_SHIPP'];
                                                                } ?>                                                                
                                                                <?php if($u->shipping_methods == 4){ 
                                                                $ship_dispay = $this->Lang['PER_ITEM_PRODU_SHIPPING_AMOU'];
                                                                } ?>
                                                                <?php if($u->shipping_methods == 5){ 
                                                                $ship_dispay = $this->Lang['ARAMEX_SHIPP_PROD'];
                                                                } ?>
                                                                <br> 
                                                                
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
                                                                <td width="80%" align="right"><?php echo $ship_dispay; ?> <?php if(($u->shipping_methods != 1) && ($u->shipping_methods != 5) ){ ?> ( <?php echo CURRENCY_SYMBOL.$u->shipping; ?> )  <?php } ?></td>
                                                                </tr>
                                                                <?php if($u->store_credit_period!=""){?>
                                                                 <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
                                                                <td width="80%" align="center"><?php echo "Store Credits : ".$u->store_credit_period." Months"; ?></td></tr>
                                                                <?php } ?>
                                                                
                                                                </table>
                                                                
                                                                <?php if($u->shipping_methods == 5){ ?>
                                                                 <table cellpadding="0" cellspacing="0" width="100%">
                                                                <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
                                                                <td width="40%" align="center"><?php echo $this->Lang['CUUR_CODE']; ?> ( <?php echo $u->aramex_currencycode; ?> ) </td>
                                                                <td width="40%" align="center"><?php echo $this->Lang['ARAMEX_COST']; ?> ( <?php echo $u->aramex_value; ?> ) </td>
                                                                </tr>
                                                                
                                                                </table>
                                                                 
                                                                 <?php } ?>
                                                            </td>

                                                        </tr>

                                                    </table>
                                                    </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="30">
                            <td><hr style="border: 1px dotted black;margin:0 auto;"></td>
                        </tr>
                        <?php 	$val_tot += $u->deal_value * $u->quantity; 
			$tax_tot += $u->tax_amount; 
			$tot_ship += $u->shipping;
			//$grand_tot = $val_tot +$tot_ship + $tax_tot; 
			$grand_tot = $val_tot +$tot_ship; 
			$j++; } ?>
                    </tbody></table>
                        <div style="clear:both;"></div>
                        <div style="width:100%;  line-height: 2em; text-align:left; page-break-before: auto;">
                            <div style="float:left; width: 74%">&nbsp;</div>
                            <div style="float:left; width: 13%; text-align:right; color:#144F5D; font: bold 12px arial;"><?php echo $this->Lang['SHIP_VAL']; ?></div>
                            <div style="float:left; width: 13%; text-align:center; color:#666666; font: bold 12px arial;"><b><?php echo CURRENCY_SYMBOL.$val_tot; ?></b></div>
                            <div style="clear:both;"></div>
                             <div style="float:left; width: 72%">&nbsp;</div>
                            <div style="float:left; width: 15%; text-align:right; color:#144F5D; font: bold 12px arial;"><?php echo $this->Lang['SHIP_ING']; ?></div>
                            <div style="float:left; width: 13%; text-align:center; color:#666666; font: bold 12px arial;"><b><?php if($tot_ship != 0 ) echo CURRENCY_SYMBOL.$tot_ship; else echo '-'; ?> </b></div>
                            <div style="clear:both;"></div>
                            <?php /*<div style="float:left; width: 72%">&nbsp;</div>
                            <div style="float:left; width: 15%; text-align:right; color:#144F5D; font: bold 12px arial;"><?php echo $this->Lang['TAX']; ?></div>
                            <div style="float:left; width: 13%; text-align:center; color:#666666; font: bold 12px arial;"><b><?php if($tax_tot != 0 ) echo CURRENCY_SYMBOL.$tax_tot; else echo '-'; ?> </b></div>
                            <div style="clear:both;"></div> */ ?>
							<table class="printtable" cellpadding="0" cellspacing="0" width="100%">
								 <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666; width:100%;">
									 <td width="74%">&nbsp;</td>
									 <td width="13%" align="right" style="color:#144F5D; font: bold 12px arial;"><?php if($p->type == 5) { echo $this->Lang['AMO_TO_B_PAID']; } else { echo $this->Lang['AMTPAID']; } ?></td>
									 <td width="13%" align="center" style="color:#666666; font: bold 12px arial;"><?php echo CURRENCY_SYMBOL.$grand_tot; ?></td>
								 </tr>
							</table>

                            <div style="clear:both"></div>
                        </div>
                </div>
            </td>
        </tr>
                        <tr>
                            <td style="padding:15px 0;">
                                <div style="width:636px;margin:0 auto;">
                                <div style="width:100%;">
                                <div style="float:left; width: 35%; font-size:12px; border-right: 1px dotted #666666; text-align: center;">
                                       <?php /* <strong style="display:block;font-size: 20px;font-family: arial;font-weight: bold;color: #666;">CASH ON DELIVERY</strong> */ ?>
                                        <strong style="display:block;padding:15px 0 0 0;font-size: 14px;font-family: arial;font-weight: bold;color: #666;"><?php if($p->type == 5) { echo $this->Lang['AMO_TO_B_PAID']; } else { echo $this->Lang['AMTPAID']; } ?> : <?php echo CURRENCY_SYMBOL.$grand_tot; ?></strong>
                                        <span style="font-size: 12px;font-family: arial;color: #666;">(inclusive of all charges)</span><br><br>
                                        <strong style="font-size: 14px;font-family: arial;font-weight: bold;color: #666;"><?php echo $this->Lang['TRANS_ID']; ?>  : <?php echo $p->transactionid; ?></strong><br>
                                        <span style="font-size: 12px;font-family: arial;color: #666;">   <?php echo $this->Lang['OR_DATE']; ?>: <?php echo date('d-m-Y H:i:s A',$p->transaction_date); ?></span></br>
                                         <strong style="font-size: 14px;font-family: arial;font-weight: bold;color: #666;"><?php echo $this->Lang['DELIVERY'];  ?>  : </strong><br>
                                            <span style="font-size: 12px;font-family: arial;color: #666;"> <?php echo $p->delivery_period." ".$this->Lang['DELI_DAYS']; ?></span></br>
                                            </br></br>
                                            
                                            <strong style="font-size: 14px;font-family: arial;font-weight: bold;color: #666;"><?php echo $this->Lang['IP']; ?>  :  <?php echo $p->ip; ?> </strong><br>
                                            <?php if($p->ip_city_name != ""){ ?>
                                            <strong style="font-size: 14px;font-family: arial;font-weight: bold;color: #666;"><?php echo $this->Lang['IP_CITY']; ?>  :   <?php echo $p->ip_city_name; ?></strong><br>
                                            <?php } ?>
                                            <strong style="font-size: 14px;font-family: arial;font-weight: bold;color: #666;"><?php echo $this->Lang['IP_COUNTRY']; ?>  :   <?php echo $p->ip_country_name; ?></strong><br>

                                </div>
                                <div style="float:left; width: auto; margin-left: 30px;">
                                         <strong style="font-size: 20px;font-family: arial;font-weight: bold;color: #666; text-align: center;display:block;"><?php echo $this->Lang['SHIP_ADDR']; ?></strong>
                                        <strong style="display:block;padding:15px 0 0 0;font-size: 14px;font-family: arial;font-weight: bold;color: #666;"><?php echo ucfirst($p->name); ?> </strong>
                                        <div style="float:left;">
                                            <span style="font-size: 12px;font-family: arial;color: #666;float:left;">
											
                                                                                        <b style="padding-top:5px;display:block;"> <?php echo $p->saddr1; ?>,</b>
											<b style="padding-top:5px;display:block;"><?php echo $p->saddr2; ?>,</b>
											<b style="padding-top:5px;display:block;"><?php echo $p->city_name." - ".$p->postal_code; ?></b>
											<b style="padding-top:5px;display:block;">  <?php echo $p->state; ?>, <?php echo $p->country; ?>.</b>
											<b style="padding-top:5px;display:block;">  <?php echo $p->phone; ?></b>
                                            </span>
                                        </div>
                                        
                                </div>
                        </div>
                        </div>

                            </td>
                        </tr>
        <tr height="80" bgcolor="#e2e2e2">
            <td valign="middle">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="color:#777;font-size: 14px;font-family: arial;">
                    <tr>
                        <td width="41"></td>
                        <td width="618" align="center"><?php echo $this->Lang['YOU_REC_MSG']; ?> <?php echo SITENAME; ?></td>
                        <td width="41"></td>
                    </tr>
                    
                    <tr height="3">
                        <td colspan="3"></td>
                    </tr>

                </table>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
