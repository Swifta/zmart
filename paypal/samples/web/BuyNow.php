<?php

include "ppwps_include_path.inc";

require_once "utility.php";
require_once "constants.php";
require_once "EWPServices.php";

$buttonParams = array(	"cmd"			=> "_xclick",
						"business" 		=> DEFAULT_EMAIL_ADDRESS,
						"cert_id"		=> DEFAULT_CERT_ID,
						"charset"		=> "UTF-8",
						"item_name"		=> htmlspecialchars($_POST["item_name"]),
						"item_number"	=> htmlspecialchars($_POST["item_number"]),
						"amount"		=> htmlspecialchars($_POST["amount"]),
						"currency_code"	=> htmlspecialchars($_POST["currency_code"]),
						"return"		=> htmlspecialchars($_POST["returnURL"]),
						"cancel_return"	=> htmlspecialchars($_POST["cancelURL"]),
						"notify_url"	=> htmlspecialchars($_POST["notifyURL"]),
						"custom"		=> "PayPal EWP Sample");

$envURL = "https://www.".DEFAULT_ENV.".paypal.com";

$buttonReturn = EWPServices::encryptButton(	$buttonParams,
											realpath(DEFAULT_EWP_CERT_PATH),
											realpath(DEFAULT_EWP_PRIVATE_KEY_PATH),
											DEFAULT_EWP_PRIVATE_KEY_PWD,
											realpath(PAYPAL_CERT_PATH),
											$envURL,
											BUTTON_IMAGE);

if(!$buttonReturn["status"]) {
	Utils::PPError($buttonReturn["error_msg"], $buttonReturn["error_no"]);
	exit;
}
$button = $buttonReturn["encryptedButton"];

?>

<html>
<head>
	<title>PayPal Website Payment Standard Buy Now</title>
</head>
<body alink=#0000FF vlink=#0000FF>
<br>
<center>
<font size=2 color=black face=Verdana><b>Encrypted Website Payment (EWP) Buttons</b></font>
<br><br>
<font color=red>
	<b>You must be logged into <a href="https://<?php echo DEFAULT_DEV_CENTRAL ?>.paypal.com" target="_blank">Developer Central</a></b>
</font>
<br><br>
<table cellpadding="2" cellspacing="2" border="1">
<tr><td align=left>Item Name</td><td align=left><?php echo $buttonParams["item_name"] ?></td></tr>
<tr><td align=left>Amount</td><td align=left><?php echo $buttonParams["amount"] ?></td></tr>
</table>
<br><br><?php echo $button ?>
<br>Using the credentials specified in the utility.php file, the payment details are
now encrypted. Click on the Buy Now button to complete the payment on PayPal<br><br>
<font face="Verdana" color="black" size="2">The following are the parameters being passed: </font>
<br>
<table cellpadding="2" cellspacing="2" border="1">
		<tr><td align=left>cmd:</td><td align=left>_xclick</td></tr>
		<tr><td align=left>business</td><td align=left><?php echo DEFAULT_EMAIL_ADDRESS ?></td></tr>
		<tr><td align=left>cert_id</td><td align=left><?php echo DEFAULT_CERT_ID ?></td></tr>
		<tr><td align=left>item_name</td><td align=left><?php echo $buttonParams["item_name"] ?></td></tr>
		<tr><td align=left>item_number</td><td align=left><?php echo $buttonParams["item_number"] ?></td></tr>
		<tr><td align=left>amount</td><td align=left><?php echo $buttonParams["amount"] ?></td></tr>
		<tr><td align=left>currency_code</td><td align=left><?php echo $buttonParams["currency_code"] ?></td></tr>
		<tr><td align=left>return</td><td align=left><?php echo $buttonParams["return"] ?></td></tr>
		<tr><td align=left>cancel_return</td><td align=left><?php echo $buttonParams["cancel_return"] ?></td></tr>
		<tr><td align=left>notify_url</td><td align=left><?php echo $buttonParams["notify_url"] ?></td></tr>

</table>

<br><br>
</center>
</body>
</html>