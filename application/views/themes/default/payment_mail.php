<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
$this->session = Session::instance();
$this->UserName = $this->session->get("UserName");
$R = $this->result_mail; 
?>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
        <title><?php echo $this->Lang["SUCC_MAIL"]; ?></title>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0" border="0" width="700" bgcolor="#ffffff" style="border:1px solid #d3d2d1;">
            <tr>
                <td style="padding:15px;">
                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#144F5D">
                                    <tr>
                                        <td>
                                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr height="68">
                                                    <td width="10"></td>
                                                    <td align="center" width="235" bgcolor="#fff"><a href="<?php echo PATH; ?>" title="<?php echo SITENAME; ?>"><img src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png" border="0" alt="" /></a></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr height="20">
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0" border="0" width="100%" style="border:1px solid #e3e3e3;padding:10px;color:#666666;font:normal 13px/19px arial;">
                                    <tr>
                                        <td style="font:normal 18px/21px arial;color:#000;"><?php echo $this->Lang["HELLO"]; ?> <?php echo $R->user_name; ?>,</td> 
                                    </tr>
                                    <tr height="10">
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font:normal 17px/21px arial;color:#333;"><?php echo $this->Lang["THANK_U_ORDER"]; ?></td>
                                    </tr>
                                    <tr height="10">
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <?php if($this->coupon_active == 1 ) { ?>
                                        <p style="width:641px;     padding: 6px 0 0; font:normal 12px arial; color:#696969; margin:0px;"><?php echo $this->Lang["FOLLOWING_ORDERS_ACTIVE"]; ?> <a href="<?php echo PATH;?>users/my-coupons.html"><?php echo $this->Lang["MY_BUYS"]; ?></a>   <?php echo $this->Lang["WILL_ACTIVATE1"]; ?>.</p>
                                        <?php } else { ?>
                                        <p style="width:641px;     padding: 6px 0 0; font:normal 12px arial; color:#696969; margin:0px;"><?php echo $this->Lang["FOLLOWING_ORDERS"]; ?> <a href="<?php echo PATH;?>users/my-coupons.html"><?php echo $this->Lang["MY_BUYS"]; ?></a>   <?php echo $this->Lang["WILL_ACTIVATE"]; ?>.</p>
                                        <?php } ?>
                                        </td>
                                    </tr>
                                     <tr height="10">
                                        <td></td>
                                    </tr>
                                    <?php if($R->ip != ""){ ?>
                                    <tr>
                                        <td style="font:normal 12px/12px arial;color:#333;"><?php echo $this->Lang['IP']; ?>  :  <?php echo $R->ip; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if($R->ip_city_name != ""){ ?>
                                     <tr height="10">
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font:normal 12px/12px arial;color:#333;"><?php echo $this->Lang['IP_CITY']; ?>  :   <?php echo $R->ip_city_name; ?></td>
                                    </tr>
                                    <?php } ?>
                                     <tr height="10">
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font:normal 12px/12px arial;color:#333;"><?php echo $this->Lang['IP_COUNTRY']; ?>  :   <?php echo $R->ip_country_name; ?></td>
                                    </tr>
                                        
                                    <tr <?php if(isset($this->set_pay_later) && $this->set_pay_later==1){?> height="10" <?php }else{?> height="25" <?php }?>>
                                        <td></td>
                                    </tr>
                                    <?php if(isset($this->set_pay_later) && $this->set_pay_later==1){?>
                                     <tr>
                                        <td style="font:normal 12px/12px arial;color:#333;"><?php echo $this->Lang['PAY_LATER_DETAILS']; ?>  :   <?php echo PAY_LATER; ?></td>
                                    </tr>
                                    <tr height="25">
                                        <td></td>
                                    </tr>
                                    <?php }?>
                                    <tr>
                                        <td>
                                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <thead>
                                                    <tr height="30">
                                                        <th align="left" width="500" style="font:normal 17px arial;color:#333;border-bottom:1px solid #ece9e4;"><?php echo $this->Lang["TITLE"]; ?></th>
                                                        <th align="left" width="100" style="font:normal 17px arial;color:#333;border-bottom:1px solid #ece9e4;"><?php echo $this->Lang["QUAN"]; ?></th>
                                                        <th width="20" style="font:normal 17px arial;color:#333;border-bottom:1px solid #ece9e4;"></th>
                                                        <th align="left" width="100" style="font:normal 17px arial;color:#333;border-bottom:1px solid #ece9e4;"><?php echo $this->Lang["PRI"]; ?></th>
                                                        <th width="80" style="font:normal 17px arial;color:#333;border-bottom:1px solid #ece9e4;"></th>
                                                        <th align="right" width="100" style="font:normal 17px arial;color:#333;border-bottom:1px solid #ece9e4;"><?php echo $this->Lang["TOTAL"]; ?></th>
                                                    </tr>
                                                </thead>
                                                <tr height="20"><td></td></tr>
                                                <tr>
                                                    <td><?php echo $R->deal_title; ?></td>
                                                    <td><?php echo $R->item_qty; ?></td>
                                                    <td align="center">x</td>
                                                    <td><?php echo CURRENCY_SYMBOL.$R->value; ?></td>
                                                    <td align="center">=</td>
                                                    <td align="right"><?php echo CURRENCY_SYMBOL.$R->total; ?></td>
                                                </tr>
                                                <tr height="20"><td></td></tr>
                                                <tfoot style="border-top:1px solid #ece9e4;font:normal 15px arial;color:#000;">
                                                    <tr>
                                                        <td colspan="4" align="right"><?php echo $this->Lang["TOTAL"]; ?></td>
                                                        <td align="center" style="font-size: 13px; color:#666;">=</td>
                                                        <td align="right" style="color:#144F5D;"><?php echo CURRENCY_SYMBOL.$R->total; ?></td>
                                                    </tr>
                                                    <tr height="10"><td></td></tr>
                                                    <tr>
                                                        <td colspan="4" align="right"><?php echo $this->Lang["REF_AMM"]; ?></td>
                                                        <td align="center" style="font-size: 13px; color:#666;">=</td>
                                                        <td align="right" style="color:#144F5D;"><?php echo CURRENCY_SYMBOL.$R->ref_amount; ?></td>
                                                    </tr>
                                                    <tr height="10"><td></td></tr>
                                                    <tr>
                                                        <td colspan="4" align="right"><?php echo $this->Lang["CREDIT_CHARGED"]; ?></td>
                                                        <td align="center" style="font-size: 13px; color:#666;">=</td>
                                                        <td align="right" style="color:#144F5D;"><?php echo CURRENCY_SYMBOL.$R->amount; ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>                                            
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr height="30">
                            <td></td>
                        </tr>
                        <tr>
                            <td align="center" style="font:normal 13px/19px arial;color:#333;">
                                <?php echo $this->Lang["IN_STORE"]; ?> - <?php echo ($this->coupon_active==0)?$this->Lang["BUY_CLOSE_EMAIL"]:$this->Lang["BUY_CLOSE_EMAIL1"]; ?>
				<a href="<?php echo PATH;?>users/my-coupons.html" ><?php echo $this->Lang["MY_BUYS"]; ?></a> <?php echo $this->Lang["TICKET_PRINTED"]; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
