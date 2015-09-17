<?php
require_once 'AuthorizeNet.php'; // The SDK
$url = "http://192.168.1.175:1200/authorize/direct_post.php";
$api_login_id = '5vfX65Hd';
$transaction_key = '6V7heC523x6mZXK2';
$md5_setting = '5vfX65Hd'; // Your MD5 Setting
$amount = "5.99";
AuthorizeNetDPM::directPostDemo($url, $api_login_id, $transaction_key, $amount, $md5_setting);
?>
