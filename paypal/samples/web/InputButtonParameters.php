<?php
/* DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/tr/xhtml1/DTD/xhtml1-transitional.dtd" */

require_once "utility.php";
require_once "constants.php";

$php_self = substr(htmlspecialchars($_SERVER["PHP_SELF"]), 1); // remove the leading /
$returnURL = Utils::getURL(substr_replace($php_self, "PDTResponse.php", strrpos($php_self, '/') + 1));
$cancelURL = Utils::getURL(substr_replace($php_self, ".", strrpos($php_self, '/') + 1));
$notifyURL = Utils::getURL(substr_replace($php_self, "IPNListner.php", strrpos($php_self, '/') + 1));

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Buy Now</title>
    <link href="sdk.css" rel="stylesheet" type="text/css" />
</head>
<body>
<center>
    <form id= InputBuyNowParametersForm action="BuyNow.php" method="post">
        <br />
        <font face="Verdana" color="black" size="2"><b>Enter Parameters to Create an Encrypted Buy Now Button.
        </b></font>
        <br /><br />
        <font face="Verdana" color="black" size="2"></font>
        <table id="info" cellSpacing="3" cellPadding="2" border="0">
		<tr>
			<td>Enter the required parameters below to create an encrypted buy now button.
			</td>
		</tr>
		<tr>
			<td>To learn more about optional variables for buy now buttons, review the Website
				Payments Standard on the <A href="https://www.paypal.com/IntegrationCenter/ic_standard_home.html#BuyNowButtons" target="_blank"
				>PayPal Integration Center</A>.
			</td>
		</tr>
		<tr>
			<td>Variables that are not editable are set in the utility.php file. (view your
				complete credentials for Website Payments Standard <A href="Credentials.php" target="_blank">
				here</A>)<br>
			</td>
		</tr>
	</table>
	<br>
        <table >
                <tr>
			<td align="left">cmd:</td>
			<td align="left">_xclick</td>
		</tr>
		<tr>
			<td align="left">PayPal Account:</td>
			<td align="left">sdk.seller@gmail.com</td>
		</tr>

                <tr>
                    <td align="left">item_name:</td>
                    <td align="left"><input   name="item_name" value="Widget" /></td>
                </tr>
                <tr>
                    <td align="left">item_number:</td>
                    <td align="left" ><input  name="item_number" value="1"/></td>
                </tr>
                <tr>
                    <td align="left">amount:</td>
                    <td align="left" ><input  name="amount" value="1"/></td>
                </tr>
                <tr>
                    <td align="left" height="7">currency_code:</td>
                    <td align="left">
                        <select name="currency_code">
                    		<option value="USD" selected="selected">USD</option>
		                	<option value="GBP">GBP</option>
        		        	<option value="EUR">EUR</option>
                			<option value="JPY">JPY</option>
		                	<option value="CAD">CAD</option>
        		        	<option value="AUD">AUD</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="left">return:</td>
                    <td align="left"><?php echo $returnURL ?></td>
                </tr>
                <tr>
                    <td align="left">cancel_return:</td>
                    <td align="left"><?php echo $cancelURL ?></td>
                </tr>
                <tr>
                    <td align="left">notify_url:</td>
                    <td align="left"><?php echo $notifyURL ?></td>
                </tr>
                <tr>
		    		<td align="left">endpoint:</td>
		   			<td align="left">https://www.<?php echo DEFAULT_ENV ?>.paypal.com/cgi-bin/webscr/</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="returnURL" value="<?php echo $returnURL ?>">
                        <input type="hidden" name="notifyURL" value="<?php echo $notifyURL ?>">
                        <input type="hidden" name="bn" value="PP-WPS_PHP">
						<input type="hidden" name="cancelURL" value="<?php echo $cancelURL ?>">
                        <input type="submit" value="Submit" name="SubmitButton" />
                    </td>
                </tr>
        </table>
    </form>
</center>
<font size="2" color="black" face="Verdana"><a href="index.html">Home</a></font>
</body>
</html>
