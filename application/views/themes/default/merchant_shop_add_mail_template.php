<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
        <title></title>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0" border="0" width="700" bgcolor="#ffffff" style="border:1px solid #d3d2d1;">
            <tr>
                <td style="padding:15px;">
                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#144F5D">
                                    <tr height="68">
                                        <td width="10"></td>
                                        <td align="center" width="235" bgcolor="#fff"><a href="<?php echo PATH; ?>" title="<?php echo SITENAME; ?>"><img src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png"" border="0" alt="" /></a></td>
                                        <td>&nbsp;</td>                                                
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr height="20">
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                 <table cellspacing="0" cellpadding="0"  style="width:600px;    border: 1px solid #ECE9E4; background:#fff;">
                                    <tr style="height:7px;"><td></td></tr>
                                    <tr>
                                        <td width="12px"></td>
                                        <td style="  font:bold 18px arial; color:#144F5D;">			
                                            <?php echo $this->Lang['DEAR']; ?> <?php if(isset($this->firstname)) { echo ucfirst($this->firstname); } ?> 
                                        </td>
                                    </tr>
                                    <tr style="height:7px;"><td></td></tr>
                                    <tr style="height:10"><td></td></tr>
                                    <tr>
                                        <td width="15"></td>
                                        <td style="width:600px; font:bold 16px/25px arial; color:#666;">
						<?php echo $this->Lang['NEW_SHOP_ADD_SUC']; ?>.
					</td>
                                    </tr>
                                    <tr style="height:7px;"><td></td></tr>
                                    <tr style="height:10"><td></td></tr>
                                     <tr>                   
                                        <td width="15"></td>
                                        <td><p style=" font:bold  12px/25px arial; color:#666;margin:0; padding:0;"><?php echo $this->Lang['YOUR_SHOP_NAM']; ?> : <span style=" font:normal 12px arial; text-decoration: none; color:#333;" title="" ><?php if(isset($_POST['storename'])) { echo $_POST['storename']; } ?></span></p></td>
                                    </tr>
                                    
                                    
                                     <tr style=" height:8"><td></td></tr>
                                    <tr>                   
                                        <td width="15"></td>
                                        <td><p style=" font:bold  12px/25px arial; color:#666;margin:0; padding:0;"><?php echo $this->Lang['SHOP_ADDR']; ?> : <span style=" font:normal 12px arial; text-decoration: none; color:#333;" title="" ><?php if(isset($_POST['address1'])) { echo $_POST['address1']; } ?> , <?php if(isset($_POST['address2'])) { echo $_POST['address2']; } ?></span></p></td>
                                    </tr>
                                     <tr style=" height:8"><td></td></tr>
                                     
                                     <tr>                   
                                        <td width="15"></td>
                                        <td><p style=" font:bold  12px/25px arial; color:#666;margin:0; padding:0;"><?php echo $this->Lang['CITY']; ?> : <span style=" font:normal 12px arial; text-decoration: none; color:#333;" title="" ><?php if(isset($this->city_name)) { echo $this->city_name; } ?> </span></p></td>
                                    </tr>
                                     <tr style=" height:8"><td></td></tr>
                                     <tr>                   
                                        <td width="15"></td>
                                        <td><p style=" font:bold  12px/25px arial; color:#666;margin:0; padding:0;"><?php echo $this->Lang['COUNTRY']; ?> : <span style=" font:normal 12px arial; text-decoration: none; color:#333;" title="" ><?php if(isset($this->country_name)) { echo $this->country_name; } ?> </span></p></td>
                                    </tr>
                                     <tr style=" height:8"><td></td></tr>
                                     <tr>                   
                                        <td width="15"></td>
                                        <td><p style=" font:bold  12px/25px arial; color:#666;margin:0; padding:0;"><?php echo $this->Lang['ZIP_CODE']; ?> : <span style=" font:normal 12px arial; text-decoration: none; color:#333;" title="" ><?php if(isset($_POST['zipcode'])) { echo $_POST['zipcode']; } ?></span></p></td>
                                    </tr>
                                     <tr style=" height:8"><td></td></tr>
                                     
                                    <tr>                   
                                        <td width="15"></td>
                                        <td><p style=" font:bold  12px/25px arial; color:#666;margin:0; padding:0;"><?php echo $this->Lang['SHOP_WEB']; ?> : <span style=" font:normal 12px arial; text-decoration: none; color:#333;" title="" ><?php if(isset($_POST['website'])) { echo $_POST['website']; } ?></span></p></td>
                                    </tr>
                                    
                                    <tr>                   
                                        <td width="15"></td>
                                        <td><p style=" font:bold  12px/25px arial; color:#666;margin:0; padding:0;"><?php echo $this->Lang['STORE_URL']; ?> : <a style=" font:normal 12px arial; text-decoration: none; " href="<?php echo PATH.url::title($_POST['storename']); ?>" > <?php echo PATH.url::title($_POST['storename']); ?> </a></p></td>
                                    </tr>
                                                                        
                                    <tr>
                                        <td width="8"></td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr style="height:30px;"><td></td></tr>
                                </table>
                            </td>
                        </tr>
                        <tr height="30">
                            <td></td>
                        </tr>
                        <tr>
                            <td align="left" style="font:normal 13px/19px arial;color:#333;">
                               <a href="<?php echo PATH; ?>" title="<?php echo SITENAME; ?>" style="font:normal 12px arial; color:#000000; text-decoration:none;"><?php echo PATH; ?></a>
                            </td> 
                        </tr>
                         <tr>      
                            <td align="left" style="font:normal 13px/19px arial;color:#333;">
                             <?php echo $this->Lang['THK_U']; ?>
                            </td>
                        </tr>
                         <tr>
                            <td align="left" style="font:normal 13px/19px arial;color:#333;">
                              <a href="<?php echo PATH; ?>" title="<?php echo SITENAME; ?>" style="font:normal 12px arial; color:#000000; text-decoration:none;"><?php echo SITENAME; ?></a> <?php echo $this->Lang['TEAM']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
