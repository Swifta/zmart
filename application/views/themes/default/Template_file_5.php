<html>
    <body>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
            <tr style="background: #d4fede;height: 15px;"> <td colspan="3" style="font-size: 0;line-height: 0;"> &nbsp;</td></tr>
            <tr>
                <td style="padding:8px;background: #d4fede;"></td>
                <td width="568">
                    <table width="568" cellpadding="0" cellspacing="0" border="0" style="padding: 15px 10px;">                        
                        <tr><td width="100%" align="center">
							<img src="<?php echo PATH.'images/newsletter/'.$_FILES['attach']['name']; ?>"  alt="<?php echo SITENAME; ?>"  /></td></tr>
                        <tr style="height: 20px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 17px arial;color:#5bb110;"><?php if(isset($this->name)) { ?>
					   <?php echo $this->Lang['DEAR']; ?> <?php echo $this->name; ?>,
					   <?php } else { ?>
					   <?php echo $this->Lang['DEAR']; ?> <?php echo $this->Lang['CUST']; ?>,
					   <?php } ?></td></tr>
                        <tr style="height: 10px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 13px arial;color:#000;"><?php echo $_POST['title'];?></td></tr>
                        <tr style="height: 25px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr> 
                        
                        <tr><td width="100%" align="center" style="font:normal 13px/19px arial;color:#555;padding:0 15px;"><?php if(isset($this->news_message)){
                                 echo $this->news_message;}
                                 else{
									 echo $_POST['message'];
									 }?></td></tr>
                        <tr style="height: 30px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr> 
                        <tr style="height: 20px;"><td style="font-size: 0;line-height: 0;border-bottom: 1px solid #000;">&nbsp;</td></tr>
                        <tr style="height: 5px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 12px arial;color:#000;"><?php echo SITENAME; ?></td></tr>
                        <tr><td width="100%" align="center" style="font:bold 12px arial;color:#a61c00;"><?php echo $_POST['footer'];?></td></tr>
                    </table>
                </td>
                <td style="padding:8px;background: #d4fede;"></td>
            </tr>
            <tr style="background: #d4fede;height:15px;"> <td colspan="3" style="font-size: 0;line-height: 0;"> &nbsp;</td></tr>
        </table>
    </body>
</html>
