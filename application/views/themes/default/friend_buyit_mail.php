<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
$this->session = Session::instance();
$this->UserName = $this->session->get("UserName");
$R = $this->result_mail; 
?>

    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
        <title><?php echo $this->Lang["SUCC_MAIL"]; ?> </title>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0" border="0" width="700" style=" background:#fff; width:700px; border:  1px solid #ccc;">
            <tr>
                <td>
                    <table cellspacing="0" cellpadding="0" border="0" style=" width:680px; margin:0 0 0 9px;">
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
                                <table cellspacing="0" cellpadding="0" border="0">
                                    <tr style="height:16px;"><td></td></tr>
                                    <tr>

                                        <td style="margin:0px; padding:9px 0 33px 0; ">
                                            <a href="<?php echo PATH; ?>" title="<?php echo SITENAME; ?>"><img src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png" border="0" alt="" /></a>
                                        </td>

                                    </tr>
                                    <tr style="height:12px;"><td></td></tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0"  style="width:680px;    border: 1px solid #ECE9E4; background:#fff;">
                                    <tr style="height:7px;"><td></td></tr>
                                    <tr>
                                        <td width="12"></td>
                                        <td style=" width:600px; font: bold 18px arial; color:#333;     padding: 7px 0 0;">
                                            <?php echo $this->Lang["HELLO"]; ?> <?php echo $R->friend_name; ?>,
                                        </td>

                                    </tr>
                                    <tr style="height:7px;"><td></td></tr>
                                    <tr  style="height:7px"><td></td></tr>
                                    <tr>
                                        <td width="15"></td>
                                        <td style="width:600px; font:bold  14px arial; color:#000;"><?php echo $this->Lang["YOUR_FRD"]; ?> (  <?php  echo $this->UserName;  ?> ) <?php echo $this->Lang["PRODUCT_BOUGHT"]; ?>...</td>

                                    </tr>
                                    <tr style="height:7px; "><td></td></tr>

                                    <tr>                   
                                        <td width="15"></td>
                                        <td>
                                            <p style="width:641px;     padding: 6px 0 0; font:normal 12px arial; color:#696969; margin:0px;"><?php echo $this->Lang["FOLLOWING_ORDERS"]; ?> <a href="<?php echo PATH;?>users/my-coupons.html"><?php echo $this->Lang["MY_BUYS"]; ?></a> <?php echo $this->Lang["WILL_ACTIVATE"]; ?>.</p>
                                        </td>
                                    </tr>
                                    <tr style="height:25px;"><td></td></tr>
                                    <tr>
                                        <td width="15" style=" "></td>
                                        <td>
                                            <table cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td><p style="width:193px;font:normal 17px arial; color:#000; margin:0px; padding-bottom: 5px;"><?php echo $this->Lang["TITLE"]; ?></p>
                                                    </td>
                                                    <td><p style="width:84px;font:normal 17px arial; color:#000; margin:0px; padding-bottom: 5px;  text-align: center;"><?php echo $this->Lang["QUAN"]; ?></p>
                                                    </td>
                                                    <td><p style="width:93px;font:normal 17px arial; color:#000; margin:0px; padding-bottom: 5px;  text-align: center;">&nbsp;</p>
                                                    </td>
                                                    <td><p style="width:55px;font:normal 17px arial; color:#000; margin:0px; padding-bottom: 5px;  text-align: center;"><?php echo $this->Lang["PRI"]; ?></p>
                                                    </td>
                                                    <td><p style="width:166px;font:normal 17px arial; color:#000; margin:0px; padding-bottom: 5px;  text-align: center;">&nbsp;</p>
                                                    </td>


                                                    <td><p style="width:55px;font:normal 17px arial; color:#000; margin:0px; padding-bottom: 5px;  text-align: center;"><?php echo $this->Lang["TOTAL"]; ?></p>
                                                    </td>

                                                </tr>
                                            </table>
                                        </td>

                                    </tr>
                                    <tr style="height:24px;"><td></td></tr>


                                    <tr>
                                        <td width="15" style=" "></td>
                                        <td>
                                            <table cellspacing="0" cellpadding="0">

                                                <tr>
                                                    <td style=" ">
                                                        <p style="width:193px;font:normal 12px arial; color:#696969; margin:0px; padding-bottom: 10px;"><?php echo $R->deal_title; ?></p>
                                                    </td>
                                                    <td  style="">
                                                        <table>
                                                            <tr>

                                                                <td style=" padding: 0px; margin: 0px;">
																	 <p style="width:55px;font:normal 12px arial; color:#696969; margin:0px; padding-bottom: 10px;  text-align: center;"><?php echo $R->item_qty; ?></p>
																</td>
                                                              
                                                            </tr>
                                                        </table>

                                                    </td>
                                                    <td width="63"></td>
                                                    <td  style="">
                                                        <p style="width:38px;font:normal 12px arial; color:#696969; margin:0px; padding-bottom: 10px;  text-align: center;">X</p>
                                                    </td>
                                                    <td  style=" ">
                                                        <p style="width:55px;font:normal 12px arial; color:#696969; margin:0px; padding-bottom: 10px;  text-align: center;"><?php echo CURRENCY_SYMBOL.$R->value; ?></p>
                                                    </td>
                                                    <td width="144"></td>
                                                    <td  style="">
                                                        <p style="width:28px;font:normal 12px arial; color:#696969; margin:0px; padding-bottom: 10px;  text-align: center;">=</p>
                                                    </td>

                                                    <td  style=" ">
                                                        <p style="width:55px;font:normal 12px arial;color:#696969; margin:0px; padding-bottom: 10px;  text-align: center;"><?php echo CURRENCY_SYMBOL.$R->total; ?></p>
                                                    </td>

                                                </tr>

                                            </table>
                                        </td>

                                    </tr>

                                    <tr style="height:28px;"><td style="border-bottom:1px solid #ECE9E4;" colspan="6">&nbsp;</td></tr>


                                    <tr>
                                        <td width="15"></td>
                                        <td>
                                            <table cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td></td>
                                                </tr>

                                                <tr>	
                                                    <td><p style="width:596px;font:normal 18px arial; color:#333; text-align: right; margin:0px; padding: 10px 0 5px 0;"><?php echo $this->Lang["TOTAL"]; ?></p></td>

                                                    <td><p style="width:40px;font:normal 18px arial; color:#144F5D; margin:0px;  text-align: center; padding-top:10px;"><?php echo CURRENCY_SYMBOL.$R->total; ?></p></td>
                                                </tr>

                                            </table>
                                        </td>

                                    </tr>

                                    <tr style=" height:8px"><td></td></tr>								

                                </table>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <p  style="width:660px; margin:0px; padding:15px 0 0 0px; font: normal 12px arial; color:#000; text-align:center;">
									<?php echo $this->Lang["IN_STORE"]; ?> - <?php echo $this->Lang["BUY_CLOSE_EMAIL"]; ?>
									<a href="<?php echo PATH;?>users/my-coupons.html" ><?php echo $this->Lang["MY_BUYS"]; ?></a><?php echo $this->Lang["TICKET_PRINTED"]; ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0" border="0">
                                    <tr style="height:14px;"><td></td></tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>



    </body>
</html>
