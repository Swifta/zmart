<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
    <table width="700" cellpadding="0" align="center" cellspacing="0" border="0" bgcolor="#ffffff">
    
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
					 <div style="text-align:center;margin:0 0 20px;padding:10px 0;">
						<strong style="font-size: 20px; font-weight:bold; font-family: Arial;color:#666;"><?php echo $this->Lang['DEAR']." ".$this->Lang["CUST"].","; ?></strong><br>
						<b style="font-size: 12px; font-weight: normal;font-family: Arial;color:#666;"><?php echo $this->Lang["MER_PRD_APPR_MSG"]; ?> </b></td>
					</div>
				 </div>
        </tr>
        <tr>
			
            <td>
                <div style="width:636px;margin:0 auto;">
        <div style="text-align:center;margin:0 0 20px;padding:10px 0;background:#e2e2e2;">
                            <strong style="font-size: 20px; font-weight:bold; font-family: Arial;color:#666;"><?php echo $this->Lang['PRODUCT_DET']; ?></strong><br>
                            <b style="font-size: 12px; font-weight:bold; font-family: Arial;color:#666;"><?php echo $this->Lang['NOTE']; ?>:</b><b style="font-size: 12px; font-weight: normal;font-family: Arial;color:#666;"> <?php echo $this->Lang["MER_PRD_APPR_MSG"]; ?> </b>
                        </div>
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                        <?php
										
				
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
                                                <td colspan="7"><b style="font-size: 15px; font-weight:bold; font-family: Arial;color:#144F5D;"><?php echo $j.". ".$u->deal_title; ?>  </b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                           
                                                            <td width="80%" valign="top">
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                        <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
                                                                        <td width="13%" align="center"><?php echo $this->Lang['COLOR']; ?></td>
                                                                        <td width="13%" align="center"><?php echo $this->Lang['SIZE']; ?></td>
                                                                        <td width="13%" align="center"><?php echo $this->Lang['QUAN']; ?></td>
                                                                        
                                                                        <td width="13%" align="center"><?php echo $this->Lang['DEALVALUE']; ?></td>
                                                                        <td width="13%" align="center"><?php echo $this->Lang['SUB_TOT']; ?></td>
                                                                        </tr>
                                                                        <tr><td colspan="7">&nbsp;</td></tr>
                                                                        <tr style="font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
                                                                        <td width="13%" align="center">
                                                                        <?php if($u->colorid !=0 ) { foreach($this->product_color as $pro){ ?>
                                                                        <?php if($u->colorid == $pro->id){ ?>   
                                                                        <?php echo ucfirst($pro->color_name); ?>
                                                                        <?php } } } else echo "--";?></td>
                                                                        <td width="13%" align="center">
                                                                        <?php if($u->sizeid != 0 ){ foreach($this->product_size as $size){ ?>
                                                                        <?php if($u->sizeid == $size->size_id){ ?>  
                                                                        <?php echo $size->size_name; ?> 
                                                                        <?php } } } else echo"-"; ?>
                                                                        </td>
                                                                        <td width="13%" align="center"><?php echo $u->product_quantity; ?></td>
                                                                        <td width="13%" align="center"><?php echo CURRENCY_SYMBOL.$u->product_value; ?></td>
                                                                        <td width="13%" align="center"><?php echo CURRENCY_SYMBOL.$u->product_value * $u->product_quantity; ?></td>
                                                                        </tr>
                                                                </table>
                                                                <?php $ship_dispay = ""; if($u->shipping_method == 1){ 
                                                                $ship_dispay = $this->Lang['FREE_SHIPP_PROD'];
                                                                } ?>                                                                
                                                                <?php if($u->shipping_method == 2){ 
                                                                $ship_dispay = $this->Lang['FLAT_SHIPP_T_PRO'];
                                                                } ?>                                                                
                                                                <?php if($u->shipping_method == 3){ 
                                                                $ship_dispay = $this->Lang['PER_PRO_SHIPP_PRODUCT_SHIPP'];
                                                                } ?>                                                                
                                                                <?php if($u->shipping_method == 4){ 
                                                                $ship_dispay = $this->Lang['PER_ITEM_PRODU_SHIPPING_AMOU'];
                                                                } ?>
                                                               
                                                                <br> 
                                                                
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
                                                                <td width="80%" align="center"><?php echo $ship_dispay; ?> <?php if(($u->shipping_method != 1)){ ?> ( <?php echo CURRENCY_SYMBOL.$u->shipping; ?> )  <?php } ?></td>
                                                                </tr>
                                                                 <?php   $val_tot += $u->product_value * $u->product_quantity; 
			//$tax_tot += $u->tax_amount; 
			$tot_ship += $u->shipping_amount;
			//$grand_tot = $val_tot +$tot_ship + $tax_tot; 
			$grand_tot = $val_tot +$tot_ship; 
			 ?>  
                                                            
                                                                </table>
                                                                	
                    
                                                               
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
                        <?php 
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
									 <td width="13%" align="right" style="color:#144F5D; font: bold 12px arial;"><?php  echo $this->Lang['AMO_TO_B_PAID']; ?></td>
									 <td width="13%" align="center" style="color:#666666; font: bold 12px arial;"><?php echo CURRENCY_SYMBOL.$grand_tot; ?></td>
								 </tr>
							</table>
                            <div style="clear:both"></div>
                        </div>
                        
                        <div style="text-align:center; padding-top:10px; margin:10px;" >
							
							  
							</div>
                </div>
                <table cellpadding="0" cellspacing="0" width="100%">
                                                              
           <?php   
				$instalment_value =0;
				if($u->duration_period!=""){ 
				$instalment_value = $grand_tot/$u->duration_period;
				} 
			?>  
                                                                 <?php if($u->duration_period!=""){?>
                                                                 <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
                                                                <td width="80%" align="center"><?php echo "Store Credits : ".$u->duration_period." Months"; ?></td></tr>
                                                                <?php } ?>
																<?php if($u->duration_period!=""){ 
																	for($i=1;$i<=$u->duration_period;$i++) { ?>
		
                                                                 <tr height="30" valign="middle" style="background: #eaeaea;font-size: 12px; font-weight:bold; font-family: Arial;color:#666;">
                                                                <td width="80%" align="center"><?php echo "Installment ".$i." : ".CURRENCY_SYMBOL.$instalment_value." => "; ?>
                                                                <?php if($u->installments_paid>=$i) { ?>
                                                                <span style="color:#000">Paid </span>
                                                                <?php } elseif($u->installments_paid+1==$i) { ?>
																	<span style="color:#A61C00"> Current Installment Payment </span>
																	<a style="font:bold 12px arial;background:#A61C00;color:#fff;margin:0px;margin-left:10px;padding:4px 11px 5px 12px;text-decoration:none" href="<?php echo PATH.'products/purchase_order/'.base64_encode($u->storecredit_id).'/'.base64_encode($u->userid).'/'.base64_encode($u->productid).'/'.base64_encode($i); ?>" title="Pay Now" target="_blank">Pay Now</a>
																<?php } else { ?>
                                                                <span style="color:#A61C00"> Yet to Pay</span>
                                                                <?php } ?>
                                                                </td></tr>
                                                                <?php } } ?>
                                                                </table>
                                                                	
                    
                                                               
                                                            </td>

                                                        </tr>

                                                    </table>
            </td>
        </tr>
                        <tr>
                            <td style="padding:15px 0;">
                               
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
        
    </table>
</body>
</html>
