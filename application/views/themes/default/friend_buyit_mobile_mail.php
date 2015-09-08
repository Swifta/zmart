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
                                   
                                    <tr>                   
                                        <td width="15"></td>
                                        <td>
                                            <p style="width:641px;padding: 6px 0 0; font:normal 12px arial; color:#696969; margin:5px;">
												<?php if($R->purchase_count >= $R->minimum_deals_limit) 
														{ ?>
													<?php echo $this->Lang["YOUR_FRD"]; ?> ( <?php echo $R->user_name; ?> ) <?php echo $this->Lang["DEAL_BOUGHT1"]; ?>
												
												<?php } else { ?>
													<?php echo $this->Lang["YOUR_FRD"]; ?> ( <?php echo $R->user_name; ?> ) <?php echo $this->Lang["DEAL_BOUGHT"]; ?>
												<?php } ?>
												</p>
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
                                                    <td><p style="width:108px;font:normal 17px arial; color:#000; margin:0px; padding-bottom: 5px;  text-align: center;"><?php echo $this->Lang["COUPON_CODE"]; ?></p>
                                                    </td>
                                                    <td><p style="width:142px;font:normal 17px arial; color:#000; margin:0px; padding-bottom: 5px;  text-align: center;"><?php echo $this->Lang["EXP_DATE"]; ?></p>
                                                    </td>
                                                  
                                                    <td><p style="width:93px;font:normal 17px arial; color:#000; margin:0px; padding-bottom: 5px;  text-align: center;">&nbsp;</p>
                                                    </td>
                                                    <td><p style="width:55px;font:normal 17px arial; color:#000; margin:0px; padding-bottom: 5px;  text-align: center;"><?php echo $this->Lang["QUAN"]; ?></p>
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
                                                        <p style="width:193px;font:normal 12px arial; color:#696969; margin:0px; padding-bottom: 10px;"><a style="text-decoration: none;font:normal 12px arial; color:#696969;"href="<?php echo PATH.$R->store_url_title.'/deals/'.$R->deal_key.'/'.$R->url_title.'.html';?>"><?php echo $R->deal_title; ?></a></p>
                                                    </td>
                                                    <td  style="">
                                                        <table>
                                                            <tr>

                                                                <td style=" padding: 0px; margin: 0px;">
																	 <p style="width:55px;font:normal 12px arial; color:#696969; margin:0px; padding-bottom: 10px;  text-align: center;"><?php 									
																		if($R->purchase_count >= $R->minimum_deals_limit)
																		{
																		  if($R->couponcode) echo $R->couponcode; else echo $this->Lang['ACTIVE'];
																		}
																		else
																		{ 
																			echo $this->Lang['PENDING'];
																		
																		}
																	?>		</p>
																</td>
                                                              
                                                            </tr>
                                                        </table>

                                                    </td>
                                                    
                                                    <td  style="">
                                                        <p style="width:286px;font:normal 12px arial; color:#696969; margin:0px; padding-bottom: 10px;  text-align: center;"><?php echo date('d-m-Y h:i:s A',$R->expirydate);?></p>
                                                    </td>
                                                   
                                                   
                                                    <td  style="">
                                                        <p style="width:4px;font:normal 12px arial; color:#696969; margin:0px; padding-bottom: 10px;  text-align: center;"></p>
                                                    </td>
                                                    <td>
                                                        <p style="width:55px;font:normal 12px arial;color:#696969; margin:0px; padding-bottom: 10px;  text-align: center;"><?php echo $R->item_qty; ?></p>
                                                    </td>

                                                </tr>

                                            </table>
                                        </td>

                                    </tr>

                                    <tr style="height:28px;"><td style="border-bottom:1px solid #ECE9E4;" colspan="6">&nbsp;</td></tr>

                                    <tr style=" height:8px"><td></td></tr>
                                    <tr>
                                        <td width="12"></td>
                                        <td style=" width:600px;">
                                            <p style="font: bold 18px arial; color:#333;padding: 7px 0 0;"><?php echo $this->Lang['STORE_DETAILS']; ?></p>
                                            <p style="font: normal 12px arial;color: #696969;margin: 0px;padding-bottom: 5px;"><?php echo $R->store_name; ?>,</p>
											<p style="font: normal 12px arial;color: #696969;margin: 0px;padding-bottom: 5px;"><?php echo $R->store_address; ?>,</p>
											<p style="font: normal 12px arial;color: #696969;margin: 0px;padding-bottom: 5px;"><?php echo $R->city_name; ?>,</p>
											<p style="font: normal 12px arial;color: #696969;margin: 0px;padding-bottom: 5px;"><?php echo $R->zipcode; ?>.</p>
											<p style="font: normal 12px arial;color: #696969;margin: 0px;padding-bottom: 15px;"><?php echo $R->website; ?></p>
                                        </td>

                                    </tr>								
									
                                </table>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <p  style="width:100px; float: right;padding: 0 303px 0 0px; margin-bottom: 0px; font: normal 12px arial; color:#000; text-align:center;">
									<?php echo $this->Lang['THK_U']; ?>.
                                </p>
                                <p  style="width:175px; float: right;padding: 0 254px 0 0px; font: normal 12px arial; color:#000; text-align:center;">
                                <a style="text-decoration: none;font: bold 18px arial;color: #333;" href="<?php echo PATH; ?>" title="<?php echo SITENAME ; ?>"><?php echo SITENAME ; ?></a>
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
