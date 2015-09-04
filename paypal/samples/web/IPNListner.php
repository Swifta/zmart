<?php
/**
* DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
*/

require_once "utility.php";
require_once "constants.php";

$logStr = "";
$logFd = fopen(PAYPAL_IPN_LOG, "a");


fwrite($logFd, "****************************************************************************************************\n");

if(array_key_exists("txn_id", $_POST)) {
	$logStr = "Received IPN,  TX ID : ".htmlspecialchars($_POST["txn_id"]);
	fwrite($logFd, strftime("%d %b %Y %H:%M:%S ")."[IPNListner.php] $logStr\n");
} else {
	$logStr = "IPN Listner recieved an HTTP request with out a Transaction ID.";
	fwrite($logFd, strftime("%d %b %Y %H:%M:%S ")."[IPNListner.php] $logStr\n");
	fclose($logFd);
	exit;
}

$tmpAr = array_merge($_POST, array("cmd" => "_notify-validate"));
$postFieldsAr = array();
foreach ($tmpAr as $name => $value) {
	$postFieldsAr[] = "$name=$value";
}
$logStr = "Sending IPN values:\n".implode("\n", $postFieldsAr);
fwrite($logFd, strftime("%d %b %Y %H:%M:%S ")."[IPNListner.php] $logStr\n");

$ppResponseAr = Utils::PPHttpPost("https://www.".DEFAULT_ENV.".paypal.com/cgi-bin/webscr", implode("&", $postFieldsAr), false);
if(!$ppResponseAr["status"]) {
	fwrite($logFd, "--------------------\n");
	$logStr = "IPN Listner recieved an Error:\n";
	if(0 !== $ppResponseAr["error_no"]) {
		$logStr .= "Error ".$ppResponseAr["error_no"].": ";
	}
	$logStr .= $ppResponseAr["error_msg"];
	fwrite($logFd, strftime("%d %b %Y %H:%M:%S ")."[IPNListner.php] $logStr\n");
	fclose($logFd);
	exit;
}

fwrite($logFd, "--------------------\n");
$logStr = "IPN Post Response:\n".$ppResponseAr["httpResponse"];
fwrite($logFd, strftime("%d %b %Y %H:%M:%S ")."[IPNListner.php] $logStr\n");

fclose($logFd);

?>