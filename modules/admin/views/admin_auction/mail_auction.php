<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;" />
<title>Special Auction Mail</title>
</head>
<body style="margin:0px; padding:0px;">

<table  cellspacing="0" cellpadding="0" width="701" style="background:#eae7e2;">
		<tr>
			<td width="20">&nbsp;</td>
			<td width="661">
				<table  cellspacing="0" cellpadding="0" width="661">
				
		<tr>
		<td colspan="3" height="23">&nbsp;</td>
	</tr>
	
	
	<?php 
				$symbol = CURRENCY_SYMBOL;
		
			?>
	<tr>
		<td colspan="3" style="padding-top:15px; padding-bottom:15px;">
			<table  cellspacing="0" cellpadding="0" width="661">
				<tr>
					<td width="500" style="font-family:arial; font-size:25px; font-weight:normal; color:#444444; letter-spacing:-0.05em;"><?php echo $this->Lang['SP_AU_PROD']; ?></td>
					
				</tr>
			</table>
		
		
		</td>
	</tr>
	
	<!--<tr>
		<td colspan="3" height="23">&nbsp;</td>
	</tr>-->
	
	<tr>
		<!--CONTENT ROW 1-->
		<td width="661" style="background:#fff; border:#e3e3e3 solid 1px;" colspan="3">
		
			<table  cellspacing="0" cellpadding="0" width="661">
				<tr>
					<td style="font-family:arial; font-size:18px; font-weight:bold; color:#444444; vertical-align:text-top; padding-left:10px; padding-top:10px; letter-spacing:-0.02em;"><?php echo ucfirst($this->deal_deatils['deal_title']); ?></td>
				</tr>
				<tr>
					<td style="font-family:arial; font-size:13px; color:#444444; line-height:18px; vertical-align:text-top; padding-top:10px; padding-left:10px; padding-right:10px;"><?php echo $this->deal_deatils['deal_description'];?></td>
				</tr>
				<tr>
					<td style="text-align:center; padding-top:10px;">
					<?php  if(file_exists(DOCROOT.'images/auction/1000_800/'.$this->deal_deatils['deal_key'].'_1'.'.png'))  { ?>
                
                       
                        <img border="0" src= "<?php echo PATH.'images/auction/1000_800/'.$this->deal_deatils['deal_key'].'_1'.'.png';?>" alt=""/>
                
                <?php } else { ?>
                
                <img border="0" src= "<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_auctions_list.png" alt="" />
                
                <?php } ?>  
										
					</td>
				</tr>
				<?php if(!isset($this->type)) { ?>
				<tr>
					<td style="padding-top:10px;">
						<table  cellspacing="0" cellpadding="0">
							<tr>
								
								<td style="border-right:#ece9e4 solid 1px; padding-top:5px; padding-left:20px; padding-right:20px;">
									<table  cellspacing="0" cellpadding="0">
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['BID_INCR']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo $symbol." ".$this->deal_deatils['bid_increment']; ?></td>
										</tr>
									</table>
								
								</td>
								<td style="border-right:#ece9e4 solid 1px; padding-top:5px; padding-left:20px; padding-right:20px;">
									<table  cellspacing="0" cellpadding="0">
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['QUAN']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo $this->deal_deatils['user_limit_quantity']; ?></td>
										</tr>
									</table>
								
								</td>
								<td style="border-right:#ece9e4 solid 1px; padding-top:5px; padding-left:20px; padding-right:20px;">
									<table  cellspacing="0" cellpadding="0">
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['SHIP_FEE']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo $symbol." ".$this->deal_deatils['shipping_fee']; ?></td>
										</tr>
									</table>
								
								</td>
								
								<td width="135" style="font-family:arial; font-size:24px; color:#c8161d; font-weight:bold; text-align:right;">
									<?php echo $symbol." ".$this->deal_deatils['deal_value']; ?>
								</td>
								<td width="20">&nbsp;</td>
								<td style="font-family:arial; font-size:24px; color:#fff; background:#1d95d0; text-align:center; font-weight:bold; padding-top:10px; padding-left:15px; padding-right:15px; padding-bottom:10px;">
									<a href="<?php echo PATH.$this->deal_deatils['store_url_title'].'/auction/'.$this->deal_deatils['deal_key'].'/'.$this->deal_deatils['url_title'].'.html';?>" title="<?php echo $this->Lang['VIEW_DL']; ?>" style="color:#fff; text-decoration:none;"><?php echo $this->Lang['VIEW_TH_AU']; ?></a>
								
								</td>
								
								
							</tr>
						</table>
						
					</td>
				</tr>
				<?php } else { ?>
					<tr>
					<td style="padding-top:10px;">
						<table  cellspacing="0" cellpadding="0">
							<tr>
								
								<td style="border-right:#ece9e4 solid 1px; padding-top:5px; padding-left:20px; padding-right:20px;">
									<table  cellspacing="0" cellpadding="0">
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['AMOUNT']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo $symbol." ".$this->deal_deatils['bid_amount']; ?></td>
										</tr>
									</table>
								
								</td>
								<td style="border-right:#ece9e4 solid 1px; padding-top:5px; padding-left:20px; padding-right:20px;">
									<table  cellspacing="0" cellpadding="0">
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['QUAN']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo $this->deal_deatils['user_limit_quantity']; ?></td>
										</tr>
									</table>
								
								</td>
								<td style="border-right:#ece9e4 solid 1px; padding-top:5px; padding-left:20px; padding-right:20px;">
									<table  cellspacing="0" cellpadding="0">
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['SHIP_FEE']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo $symbol." ".$this->deal_deatils['shipping_fee']; ?></td>
										</tr>
									</table>
								
								</td>
						
								<td style="border-right:#ece9e4 solid 1px; padding-top:5px; padding-left:20px; padding-right:20px;">
									<table  cellspacing="0" cellpadding="0">
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['TOTAL']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo $symbol."&nbsp;".($this->deal_deatils['bid_amount']+$this->deal_deatils['shipping_fee']); ?></td>
										</tr>
									</table>
								
								</td>
								<td width="20">&nbsp;</td>
								<td style="font-family:arial; font-size:24px; color:#fff; background:#1d95d0; text-align:center; font-weight:bold; padding-top:10px; padding-left:15px; padding-right:15px; padding-bottom:10px;">
									<a href="<?php echo PATH.$this->deal_deatils['store_url_title'].'/auction/'.$this->deal_deatils['deal_key'].'/'.$this->deal_deatils['url_title'].'.html';?>" title="<?php echo $this->Lang['VIEW_DL']; ?>" style="color:#fff; text-decoration:none;"><?php echo $this->Lang['VIEW_TH_AU']; ?></a>
								
								</td>
								
								
							</tr>
						</table>
						
					</td>
				</tr>
				<?php } ?>
				
				<tr>
					<td height="23">&nbsp;</td>
				</tr>
				
			</table>
		
		</td>
	</tr>

	
	<tr>
		<td width="661" colspan="3">&nbsp;</td>
	</tr>
	
</table>
			</td>
			<td width="20">&nbsp;</td>
		</tr>
</table>




</body>
</html>

