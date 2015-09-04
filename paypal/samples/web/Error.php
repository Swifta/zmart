<html>
<head>
<title>PayPal SDK - PHP Exception</title>
</head>
<body alink=#0000FF vlink=#0000FF>
<center>
<br>
<font size=2 color=black face=Verdana><b>PHP Exception</b></font>
<br><br>
<b>A PHP exception has occured!</b><br><br>

<?php

if(array_key_exists("error_msg", $_POST)) {
	$error_msg = htmlspecialchars($_POST["error_msg"]);
	if(array_key_exists("error_no", $_POST)) {
		if(0 != htmlspecialchars($_POST["error_no"])) {
			$error_msg = "Error ".htmlspecialchars($_POST["error_no"]).": $error_msg";
		}
	}
	echo "<b>$error_msg</b><br><br>";
}

?>

<b>Please check your configuration.</b>
<br><br>
</center>
<b>Help:</b>
<ul>
<li><a href='https://www.paypal.com/IntegrationCenter'>PayPal Integration Center</a><br>
<li><a href='https://www.paypal.com/IntegrationCenter/ic_button-encryption.html'>Encrypted Website Payments (EWP)</a><br>
<li>For Encrypted Website Payments (EWP) functionality of the SDK, make sure you have installed the OpenSSL Extension.
</ul>
<a href="index.html">Index</a>
</body>
</html>