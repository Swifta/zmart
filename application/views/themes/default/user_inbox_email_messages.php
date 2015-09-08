
<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
		<table>
			<tr>
				<td>
		<?php echo "Receivers  ";?></td>
		<td><label>:</label></td>
		
		<td><?php foreach($this->message as $message){?>
		<?php $email_messages=explode(',',$message->receivers_id);
		foreach($email_messages as $user){
			$this->users = new Admin_users_Model();	
			$result=$this->user_name=$this->users->get_user_name($user);
			echo $result." , ";
		}
		?>
		</td>
		</tr>
		</table>
<html>
    <body>
		
					<?php 
					 if($message->email_template==1)
                        {
                        $logo ='<img src="'.PATH.'/themes/'.THEME_NAME.'/images/red_emarket.png"  />';
                        $color1="color:#a61c00;";
                        $color2="background: #d6d2d3";
                        $color3="#d6d2d3";
					}else{
						$logo ='<img src="'.PATH.'/themes/'.THEME_NAME.'/images/green_emarket.png"  />';
						$color1="color:#5bb110;";
						$color2="background: #d4fede";
						$color3="#d4fede";
					}
					?>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
            <tr style="height: 15px;<?php echo $color2;?>"> <td colspan="3" style="font-size: 0;line-height: 0;"> &nbsp;</td></tr>
            <tr>
                <td style="padding:8px;<?php echo $color2;?>"></td>
                <td width="568">
					
                    <table width="568" cellpadding="0" cellspacing="0" border="0" style="padding: 15px 10px;">                        
                        <tr><td width="100%" align="center"><?php echo $logo;?></td></tr>                        
                        <tr style="height: 20px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 17px arial;<?php echo $color1;?>;"> <?php echo $this->Lang['DEAR']; ?> <?php echo $this->Lang['CUST']; ?>,</td></tr>
                        <tr style="height: 10px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 13px arial;color:#000;"><?php echo $message->email_subject;?></td></tr>
                        <tr style="height: 25px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr> 
                        
                        <tr><td width="100%" align="center" style="font:normal 13px/19px arial;color:#555;padding:0 15px;"><?php echo $message->email_message;?></td></tr>
                        <tr style="height: 30px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr> 
                        <tr style="height: 20px;"><td style="font-size: 0;line-height: 0;border-bottom: 1px solid #000;">&nbsp;</td></tr>
                        <tr style="height: 5px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 12px arial;color:#000;">emarketplace.com</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 12px arial;<?php echo $color1;?>">Thank you,  eMarketplace Team.</td></tr>
                    </table>
                   
                </td>
                <td style="padding:8px;<?php echo $color2;?>;"></td>
            </tr>
            <tr style="<?php echo $color2;?>;height:15px;"> <td colspan="3" style="font-size: 0;line-height: 0;"> &nbsp;</td></tr>
        </table>
         
    </body>
</html>
<?php } ?>
</div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
