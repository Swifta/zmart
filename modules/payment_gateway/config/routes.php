<?php defined('SYSPATH') OR die('No direct access allowed.');

/** PAYMENT **/

$config['payment/creditcard.php'] = "paypal/dodirectpayment";
$config['payment/paypal.php'] = "paypal/expresscheckout";
$config['payment/auction-paypal.php'] = "auction_paypal/expresscheckout";
$config['transaction.html'] = "/paypal/success";
$config['creditcard_payment/paypal.php'] = "creditcard_paypal/expresscheckout";

