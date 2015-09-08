<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;" />
<title><?php echo $this->Lang['SPL_PRO_MAIL']; ?></title>
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
	
		
	<?php foreach( $this->shipping_list as $d){
					if($d->shipping_id == $this->shipping_id){ 
				$symbol = CURRENCY_SYMBOL;
		
			?>
	<tr>
		<td colspan="3" style="padding-top:15px; padding-bottom:15px;">
			<table  cellspacing="0" cellpadding="0" width="661">
				<tr>
					<td width="160" style="font-family:arial; font-size:25px; font-weight:normal; color:#444444; letter-spacing:-0.05em;"><?php echo $this->Lang['PRODUCT4']; ?></td>
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
					<td style="font-family:arial; font-size:18px; font-weight:bold; color:#444444; vertical-align:text-top; padding-left:10px; padding-top:10px; letter-spacing:-0.02em;"><?php echo ucfirst($d->deal_title); ?></td>
				</tr>
				<tr>
					<td style="font-family:arial; font-size:13px; color:#444444; line-height:18px; vertical-align:text-top; padding-top:10px; padding-left:10px; padding-right:10px;"><?php echo $d->deal_description;?></td>
				</tr>
				<tr>
					<td style="text-align:center; padding-top:10px;">
					<?php  if(file_exists(DOCROOT.'images/products/1000_800/'.$d->deal_key.'_1'.'.png'))  { ?>
                
                       
                        <img border="0" src= "<?php echo PATH.'images/products/1000_800/'.$d->deal_key.'_1'.'.png';?>" alt=""/>
                
                <?php } else { ?>
                
                <img border="0" src= "<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_details.png" alt="" />
                
                <?php } ?>  
										
					</td>
				</tr>
				<tr>
					<td style="padding-top:10px;">
						<table  cellspacing="0" cellpadding="0">
							<tr>
								<td style="border-right:#ece9e4 solid 1px; padding-top:5px; padding-left:20px; padding-right:20px;">
									<table  cellspacing="0" cellpadding="0">
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['PRI']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo $symbol." ".$d->deal_value; ?></td>
										</tr>
									</table>	
								
								</td>
								<td style="border-right:#ece9e4 solid 1px; padding-top:5px; padding-left:20px; padding-right:20px;">
									<table  cellspacing="0" cellpadding="0">
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['QUAN']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo $d->quantity; ?></td>
										</tr>
									</table>
								
								</td>
								<td style="border-right:#ece9e4 solid 1px; padding-top:5px; padding-left:20px; padding-right:20px;">
									<table  cellspacing="0" cellpadding="0">
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['TOT_PRI']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo $symbol." ".$d->deal_value * $d->quantity; ?></td>
										</tr>
									</table>
								
								</td>

								<td style="border-right:#ece9e4 solid 1px; padding-top:5px; padding-left:20px; padding-right:20px;">
									<table  cellspacing="0" cellpadding="0">
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['TRANS_DATE']; ?></td>

										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo date("d-M-Y h:i:s A",$d->transaction_date); ?></td>
										</tr>
									</table>
								
								</td>
							</tr>
						</table>
					</td>
				</tr>
		                  
				<tr>
					<td style="padding:19px 0px 0px 101px;">
						<table  cellpadding="3">
							<tr>
								<?php foreach($this->product_color as $pro){ ?>
            <?php if($d->product_color == $pro->id){ ?> 
								<td style="border:#ece9e4 solid 1px; padding: 6px 25px 9px 20px;">
									<table>
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['PRODUC_COLOR']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo "<span style='color: #$pro->color_code;'>".ucfirst($pro->color_name)."</span>"; ?></td>
										</tr>
									</table>
								</td>
							<?php } else { echo "<td></td>"; } } ?>
								<?php foreach($this->product_size as $size){ ?>
                            <?php if($d->product_size == $size->size_id){ ?>
								<td style="border:#ece9e4 solid 1px; padding: 6px 25px 9px 20px;">
									<table>
										<tr>
											<td style="font-family:arial; font-size:12px; color:#444444; text-align:center;"><?php echo $this->Lang['PRODU_SIZ']; ?></td>
										</tr>
										<tr>
											<td style="font-family:arial; font-size:16px; color:#444444; text-align:center; padding-top:4px; font-weight:bold;"><?php echo $size->size_name; ?></td>
										</tr>
									</table>
								</td>
							<?php } else { echo "<td></td>"; } } ?>
							</tr>
						</table>
					</td>
				</tr>
		 		<tr>
					<td style="font-family:arial; font-size:15px; font-weight:bold; color:#444444; vertical-align:text-top; padding-left:10px; padding-top:10px; letter-spacing:-0.02em;"><?php echo $this->Lang['ADDRES']; ?>:&nbsp;<span style="font-family:arial; font-size:12px; color:#444444;font-weight:normal"><?php echo $d->adderss1.",".$d->address2; ?>,<?php echo $d->city_name; ?>,<?php echo $d->country; ?> - <?php echo $d->postal_code; ?></span></td>
				</tr>
				<tr>
					<td height="23">&nbsp;</td>
				</tr>
				
			</table>
		
		</td>
	</tr>
	
	<tr>
		<td colspan="3" height="23">&nbsp;</td>
	</tr>
	
	<?php } } ?>
	
	
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
