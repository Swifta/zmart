<html>
    <body>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
            <tr style="background: #d6d2d3;height: 15px;"> <td colspan="3" style="font-size: 0;line-height: 0;"> &nbsp;</td></tr>
            <tr>
                <td style="padding:8px;background: #d6d2d3;"></td>
                <td width="568">
                    <table width="568" cellpadding="0" cellspacing="0" border="0" style="padding: 15px 10px;">                        
                        <tr><td width="100%" align="center"><img src="<?php echo THEME; ?>images/red_emarket.png"  alt="<?php echo SITENAME; ?>"  /></td></tr>                        
                        <tr style="height: 20px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 17px arial;color:#a61c00;"><?php if(isset($this->name)) { ?>
                                           <?php echo $this->Lang['DEAR']; ?> <?php echo $this->name; ?>,
                                           <?php } else { ?>
                                           <?php echo $this->Lang['DEAR']; ?> <?php echo $this->Lang['CUST']; ?>,
                                           <?php } ?></td></tr>
                        <tr style="height: 10px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 13px arial;color:#000;">You have a NEWSletter.</td></tr>
                        <tr style="height: 10px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 13px arial;color:#000;">
							<?php if(isset($this->message)){
                                 echo $this->message;}
                                 else{
									 echo $_POST['message'];
									 }?>
                            </td></tr>
                        <tr style="height: 10px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <?php /*<tr><td width="100%" align="center">
                                <p style="width: 300px;"><label style="float: left;font:bold 13px arial;color:#000;width: 105px;text-align: left;">Your password</label>
                                <b style="float: left;font:bold 13px arial;color:#000;padding: 0 15px;">:</b> 
                                <span style="float: left;font:bold 13px arial;color:#666;">1234565</span></p>
                            </td></tr>*/?>
                        <tr style="height: 20px;"><td style="font-size: 0;line-height: 0;border-bottom: 1px solid #000;">&nbsp;</td></tr>
                        <tr style="height: 5px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 12px arial;color:#000;"><?php echo SITENAME;?></td></tr>
                        <tr><td width="100%" align="center" style="font:bold 12px arial;color:#a61c00;">Thank you,  <?php echo SITENAME;?> Team.</td></tr>
                    </table>
                </td>
                <td style="padding:8px;background: #d6d2d3;"></td>
            </tr>
            <tr style="background: #d6d2d3;height:15px;"> <td colspan="3" style="font-size: 0;line-height: 0;"> &nbsp;</td></tr>
        </table>
    </body>
</html>
