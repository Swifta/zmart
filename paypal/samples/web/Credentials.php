<?php
/* DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/tr/xhtml1/DTD/xhtml1-transitional.dtd" */

require_once 'constants.php';

?>

<HTML>
	<HEAD>
		<title>PayPal Website Payment Standard Credentials Page</title>
		<LINK href="sdk.css" type="text/css" rel="stylesheet">
	</HEAD>
	<body>
		<center>
			<form id="LoginForm" runat="server">
				<p>
					<font face="Verdana, Arial, Helvetica, sans-serif" color="#000000">
						<br>
						<b>Credentials Used To Create Encrypted Buy Now Buttons</b></font></p>
				<p align="left"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000"><br>
						<span style="FONT-SIZE: 10pt; FONT-FAMILY: Arial; mso-fareast-font-family: 'Arial Unicode MS'; mso-bidi-font-family: 'Times New Roman'; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA">
      Below are the credentials used to encrypt buy now buttons. </span></font></p>
				<p align="left"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000"><span style="FONT-SIZE: 10pt; FONT-FAMILY: Arial; mso-fareast-font-family: 'Arial Unicode MS'; mso-bidi-font-family: 'Times New Roman'; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA">PayPal
      includes a default account for testing on the PayPal sandbox. You can modify
      these credentials by editing the utility.jsp file</span></font></p>
				<p align="left"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000"><span style="FONT-WEIGHT: bold; COLOR: red">NOTES:
      </span></font></p>
				<ul>
					<li>
						<div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000">Production
								code should NEVER expose credentials in this manner. We are showing you
								credentials for testing purposes only.</font></div>
					<li>
						<div align="left"><font face="Verdana, Arial, Helvetica, sans-serif">Sandbox
								credentials are different than that of live credentials. You will need a different set
								to encrypt buy now buttons on the live production system.</font></div>
					<li>
						<div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000">The
								credentials given below are used to encrypt buy now buttons. They are not the
								credentials used to make PayPal API calls.</font></div>
					</li>
				</ul>
				<table border="1">
					<tr>
						<td align="left">PayPal Account:</td>
						<td align="left"><?php echo DEFAULT_EMAIL_ADDRESS ?></td>
					</tr>
					<tr>
						<td align="left">Certificate PKCS12 (.p12) format:</td>
						<td align="left"><?php echo DEFAULT_EWP_CERT_PATH ?></td>
					</tr>
					<tr>
						<td align="left">Certificate Private Key Password
							<br>
							(OpenSSL Export Password):</td>
						<td align="left"><?php echo DEFAULT_EWP_PRIVATE_KEY_PWD ?></td>
					</tr>
					<tr>
						<td align="left">Private Key File:</td>
						<td align="left"><?php echo DEFAULT_EWP_PRIVATE_KEY_PATH ?></td>
					</tr>
					<tr>
						<td align="left">Cert ID:</td>
						<td align="left"><?php echo DEFAULT_CERT_ID ?></td>
					</tr>
					<tr>
						<td align="left">PayPal Certificate:</td>
						<td align="left"><?php echo PAYPAL_CERT_PATH ?></td>
					</tr>
					<tr>
						<td align="left">Identity token:</td>
						<td align="left"><?php echo DEFAULT_IDENTITY_TOKEN ?></td>
					</tr>
					<tr>
						<td align="left" height="16">
							Endpoint(sandbox or live):
						</td>
						<td align="left" height="16"><?php echo DEFAULT_ENV ?></td>
					</tr>
				</table>
			</form>
		</center>
		<font size="2" color="black" face="Verdana"><a href="index.html">Home</a></font>
	</body>
</HTML>