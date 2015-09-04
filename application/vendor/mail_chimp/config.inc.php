<?php

	require_once($_SERVER['DOCUMENT_ROOT']."/includes/dboperations.php");
	$sql = "select apikey,listid,campaignid,ownermail,apiurl from mailchimp limit 0,1";
	$result = mysql_query($sql)or die(mysql_error());
	$execute = mysql_fetch_array($result);
	 
    //API Key - see http://admin.mailchimp.com/account/api
    //$apikey = '2d9be05465045fad857ce5db86ead7cb-us2';
	$apikey = $execute['apikey']; 
    
    // A List Id to run examples against. use lists() to view all
    // Also, login to MC account, go to List, then List Tools, and look for the List ID entry
    //$listId = 'YOUR MAILCHIMP LIST ID - see lists() method';
    
	//$listId = 'a8c362c8bb';
	$listId = $execute['listid'];
    // A Campaign Id to run examples against. use campaigns() to view all
    //$campaignId = 'YOUR MAILCHIMP CAMPAIGN ID - see campaigns() method';
	//$campaignId = '639e9c2d2b';
	$campaignId = $execute['campaignid'];

    //some email addresses used in the examples:
    $my_email = $execute['ownermail'];
    $boss_man_email = 'mark.anthony@ndot.in';

    //just used in xml-rpc examples
    $apiUrl = $execute['apiurl'];
    
?>
