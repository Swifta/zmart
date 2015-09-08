<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<!DOCTYPE html>
<html lang="en" class="demo-1">
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $this->Lang["SUCC_MAIL"]; ?></title>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0" border="0" width="700" style=" background:#fff; width:700px; border:  1px solid #ECE9E4;">
			<?php foreach ($this->auction_details as $p ) { ?>
            <tr>
                <td>
                    <table cellspacing="0" cellpadding="0" border="0" style=" width:680px; margin:0 0 0 9px;">
                        <tr  style="height:20px"><td></td></tr>
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0" border="0" >
                                    <tr>				
                                        <td style=" width:544px;margin:0px; padding:0px; height:2px;">
                                            <div style="width:116px; margin:0px; padding:0px;  height:2px;">&nbsp;</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0"  style="width:680px;    border: 1px solid #ECE9E4; background:#fff;">
                                    <tr style=" height:14px;"><td></td></tr>
                                    <tr>
                                        <td width="30">&nbsp;</td>
                                        <td style=" vertical-align: top; font:  bold 16px arial; color: #333;">1.    <?php echo $p->deal_title; ?></td>
                                        <td width="30">&nbsp;</td>	
                                    </tr>
                                    <tr style="height:10px"><td></td></tr>
                                    <tr>
                                        <td width="30">&nbsp;</td>
                                        <td style=" vertical-align: top; font: bold 12px arial; color: #666;">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tr>
                                                    <td style="vertical-align: top; width: 115px;  border-bottom: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font: normal 14px arial; color: #1f1f1f; margin: 0px; padding: 0 0 6px 22px;"><?php echo $this->Lang['QUAN']; ?>
</p>
                                                    </td>
                                                    <td style="vertical-align: top; width: 115px;  border-bottom: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font: normal 14px arial; color: #1f1f1f;  margin: 0px; padding: 0 0 6px;"><?php echo $this->Lang['START_BID_AMO']; ?>
</p>
                                                    </td>
                                                    <td style="vertical-align: top; width: 115px;  border-bottom: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font: normal 14px arial; color: #1f1f1f;  margin: 0px; padding: 0 0 6px;"><?php echo $this->Lang['YOUR_BID']; ?>
</p>
                                                    </td>
                                                    <td style="vertical-align: top; width: 100px;  border-bottom: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font: normal 14px arial; color: #1f1f1f;  margin: 0px; padding: 0 0 6px 32px;"><?php echo $this->Lang['SUB_TOT']; ?>
</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="30">&nbsp;</td>	
                                    </tr>
                                    <tr style=" height:10px;"><td></td></tr>
                                    <tr>
                                        <td width="30">&nbsp;</td>
                                        <td style=" vertical-align: top; font: bold 12px arial; color: #666;">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tr>
													<td style="vertical-align: top; width: 115px; border-bottom: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font: normal 14px arial; color: #1f1f1f;  margin: 0px;padding: 0px 0px 24px 43px;"><?php echo $p->quantity; ?> </p>
                                                    </td>
                                                   
                                              
                                                    <td style="vertical-align: top; width: 115px;  border-bottom: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font: normal 14px arial; color: #1f1f1f;  margin: 0px; padding: 0px 0 6px 20px;"><?php echo CURRENCY_SYMBOL.$p->deal_value; ?> </p>
                                                    </td>
                                                    <td style="vertical-align: top; width: 120px;  border-bottom: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font: normal 14px arial; color: #1f1f1f;  margin: 0px; padding: 0px 0 6px 20px;"><?php echo CURRENCY_SYMBOL.$p->bid_amount; ?> </p>
                                                    </td>
                                                    <td style="vertical-align: top; width: 88px;  border-bottom: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font: normal 14px arial; color: #1f1f1f;  margin: 0px; padding: 0px 0 6px 30px;"><?php echo CURRENCY_SYMBOL.$p->bid_amount * $p->quantity; ?> </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="30">&nbsp;</td>	
                                    </tr>
                                    <tr style="height:19px;"><td></td></tr>
                                    <tr>
                                        <td width="30">&nbsp;</td>
                                        <td style=" vertical-align: top; font: bold 12px arial; color: #666;">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tr>
                                                    <td style="vertical-align: top; width:350px;">&nbsp;</td>
                                                    <td style="vertical-align: top; ;">
                                                        <table cellspacing="0" cellpadding="0" border="0">
                                                            <tr>
                                                                <td style="vertical-align: top; width: 195px;">
                                                                    <p style="vertical-align: top; font:  normal 12px arial; color: #333; margin: 0px; padding: 0px 0 0px 0px;"><?php echo $this->Lang['SHIP_VAL']; ?></p>
                                                                </td>
                                                                <td>
                                                                    <p style="vertical-align: top; font:  bold 14px arial; color: #333; margin: 0px; padding: 0px 0 0px 0px; text-align:right;"><?php echo CURRENCY_SYMBOL.$p->bid_amount * $p->quantity; ?> </p>    
                                                                </td>
                                                            </tr>
                                                            <tr style=" height:12px"><td></td></tr>
                                                            <tr>
                                                                <td style="vertical-align: top; width: 195px;">
                                                                    <p style="vertical-align: top; font:  normal 12px arial; color: #333; margin: 0px; padding: 0px 0 0px 0px;"><?php echo $this->Lang['SHIP_AMOU']; ?></p>
                                                                </td>
                                                                <td>
                                                                    <p style="vertical-align: top; font:  bold 14px arial; color: #333; margin: 0px; padding: 0px 0 0px 0px; text-align:right;"> <?php if($p->shipping_amount != 0 ) echo CURRENCY_SYMBOL.$p->shipping_amount; else echo '-'; ?></p>    
                                                                </td>
                                                            </tr>
                                                            <tr style="height:12px;"><td></td></tr>
                                                            <tr>
                                                                <td style="vertical-align: top; width: 195px;">
                                                                    <p style="vertical-align: top; font:  normal 12px arial; color: #333; margin: 0px; padding: 0px 0 0px 0px;"><?php echo $this->Lang['TAX']; ?></p>
                                                                </td>
                                                                <td>
                                                                    <p style="vertical-align: top; font:  bold 14px arial; color: #333; margin: 0px; padding: 0px 0 0px 0px; text-align:right;"><?php if($p->tax_amount != 0 ) echo CURRENCY_SYMBOL.$p->tax_amount; else echo '-'; ?> </p>    
                                                                </td>
                                                            </tr>
                                                            <tr style="height:12px;"><td></td></tr>
                                                            <tr>
                                                                <td style="vertical-align: top; width: 195px; border-bottom: 1px solid #ECE9E4; border-top: 1px solid #ECE9E4;  padding: 5px; padding-left:0px; padding-right: 0px;">
                                                                    <p style="vertical-align: top; font:  bold 12px arial; color: #333; margin: 0px; padding:4px;"><?php echo $this->Lang['AMO_TO_B_PAID']; ?></p>
                                                                </td>
                                                                <td style="border-bottom: 1px solid #ECE9E4; border-top: 1px solid #ECE9E4;  padding: 5px; padding-left: 0px;">
                                                                    <p style="vertical-align: top; font:  bold 20px arial; color: #333; margin: 0px; padding: 0px 0 0px 0px; text-align:right;"> <?php echo CURRENCY_SYMBOL.(($p->bid_amount * $p->quantity) + ($p->shipping_amount) + ($p->tax_amount)); ?> </p>    
                                                                </td>
                                                            </tr>
                                                        </table >
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="30">&nbsp;</td>	
                                    </tr>
                                    <tr>
                                        <td width="30">&nbsp;</td>
                                        <td style=" vertical-align: top; font: bold 12px arial; color: #666;">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tr style="height:34px;"><td></td></tr>
                                                <tr>
                                                    <td style=" vertical-align: top; width: 347px; border-top: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font:  bold 18px arial; color: #333; margin: 0px; padding: 15px 0 0px 60px;"><?php echo $this->Lang['OR_DATE']; ?>
:</p>
                                                    </td>
                                                    <td style=" vertical-align: top; width: 259px; border-top: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font:  bold 18px arial; color: #333; margin: 0px; padding: 15px 0 0px 60px;"><?php echo $this->Lang['DELIVERY_STA']; ?>
:</p>
                                                    </td>
                                                </tr>
                                                <tr style="height:10px;"><td></td></tr>
                                                <tr>
                                                    <td style=" vertical-align: top; width: 347px;">
                                                        <p style="vertical-align: top; font:  bold 12px arial; color: #666; margin: 0px; padding: 0px 0 0px 60px;"><?php echo date("d-M-Y h:i:s A",$p->transaction_date); ?></p>
                                                    </td>
                                                    <td style=" vertical-align: top; width: 259px;">
                                                        <p style="vertical-align: top; font:  bold 12px arial; color: #666; margin: 0px; padding: 0px 0 0px 60px;"><?php echo $this->Lang['TWO_THREE_WORK_DAYS']; ?>
</p>
                                                    </td>
                                                </tr>
                                                <tr style="height:30px;"><td></td></tr>
                                                <tr>
                                                    <td style=" vertical-align: top; width: 347px; border-top: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font:  bold 14px arial; color: #33; margin: 0px; padding: 16px 0 0px 60px;"><?php echo $this->Lang['SHOP_ADDR']; ?></p>
                                                    </td>
                                                    <td style=" vertical-align: top; width: 259px; border-top: 1px solid #ECE9E4;">
                                                        <p style="vertical-align: top; font:  bold 14px arial; color: #333; margin: 0px; padding: 16px 0 0px 60px;"><?php echo $this->Lang['SHIP_ADDR']; ?></p>
                                                    </td>
                                                </tr>
                                                <tr style="height:5px;"><td></td></tr>
                                                <tr>
                                                    <td style=" vertical-align: top; width: 347px;">
                                                        <p style="vertical-align: top; font:  bold 18px arial; color: #333; margin: 0px; padding: 14px 0 0px 60px;"><?php echo $p->store_name ; ?> </p>
                                                    </td>
                                                    <td style=" vertical-align: top; width: 259px;">
                                                        <p style="vertical-align: top; font:  bold 18px arial; color: #333; margin: 0px; padding: 14px 0 0px 60px;"><?php echo ucfirst($p->name); ?></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style=" vertical-align: top; width: 347px;">
                                                        <p style="vertical-align: top; font:  normal 12px/20px arial; color: #666; margin: 0px; padding: 0px 0 0px 60px;"><?php echo $p->addr1.','.$p->addr2 ; ?></p>
                                                    </td>
                                                    <td style=" vertical-align: top; width: 259px;">
                                                        <p style="vertical-align: top; font: normal 12px/20px arial; color: #666; margin: 0px; padding: 0px 0 0px 60px;"><?php echo $p->saddr1."<br />".$p->saddr2; ?></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style=" vertical-align: top; width: 347px;">
                                                        <p style="vertical-align: top; font:  normal 12px/20px arial; color: #666; margin: 0px; padding: 0px 0 0px 60px;"><?php echo $p->city_name.'-'.$p->zipcode; ?>  ,</p>
                                                    </td>
                                                    <td style=" vertical-align: top; width: 259px;">
                                                        <p style="vertical-align: top; font: normal 12px/20px arial; color: #666; margin: 0px; padding: 0px 0 0px 60px;"><?php echo $p->city_name . '-' . $p->postal_code; ?></p>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td style=" vertical-align: top; width: 347px;">
                                                        <p style="vertical-align: top; font: bold 14px/23px arial; color: #666; margin: 0px; padding: 0px 0 0px 60px;"><?php echo $this->Lang['PHO']; ?>
 : <?php echo $p->str_phone; ?></p>
                                                    </td>
                                                    <td style=" vertical-align: top; width: 259px;">
                                                        <p style="vertical-align: top; font: normal 12px/23px arial; color: #666; margin: 0px; padding: 0px 0 0px 60px;"><?php echo $p->country; ?></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style=" vertical-align: top; width: 347px;">
                                                        <p style="vertical-align: top; font: bold 14px arial; color: #666; margin: 0px; padding: 0px 0 0px 60px;"><?php echo $this->Lang['WEBSITE']; ?>: <a href="<?php echo PATH; ?>" style=" color: #ff9b02;" title="<?php echo $p->website; ?>"><?php echo $p->website; ?></a></p>
                                                    </td>
                                                    <td style=" vertical-align: top; width: 259px;">
                                                        <p style="vertical-align: top; font: bold 14px arial; color: #666; margin: 0px; padding: 0px 0 0px 60px;"><?php echo $this->Lang['PHO']; ?> : <?php echo $p->phone; ?> </p>
                                                    </td>
                                                </tr>
                                                <tr style="height:12px;"><td></td></tr>
                                            </table>
                                        </td>
                                        <td width="30">&nbsp;</td>	
                                    </tr>
								<?php } ?>
                                </table>
                            </td>
                        </tr>
						<tr>
							<td>
								<table cellspacing="0" cellpadding="0" border="0">
									<tr style="height:14px;"></tr>

								</table>
							</td>
						</tr>
					</table>
					<tr style=" height:30px"></tr>	
				</table>
	</body>
</html>
