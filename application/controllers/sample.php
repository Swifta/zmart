<?php 
	if(defined('SYSPATH') or die('No direct access allowed.'));
?>

<?php

	class Sample_Controller extends Controller {
		
	public function index(){
	//require_once(APPPATH."vendor/mailin-api-php-master/V2.0/Mailin.php");
	require_once(APPPATH."vendor/mailin/Mailin.php");
	$mailin = new Mailin("https://api.sendinblue.com/v2.0", "Kx4syT6q0JmWCbLU");
	
	/*$html = "";
	$message = "Testing SendInBlue";
	$subject = "Test Mail";
	$to = array("pwndz172@gmail.com" => "Swifta Developer");
	$from = array("pkigozi@swifta.com");
	$cc = array(); 
	$bcc = array();
	$replyto = array("pkigozi@swifta.com","reply to!"); 
	$attachment = array();
	$headers = array("Content-Type"=>"text/html; charset=iso-8859-1","X-Ewiufkdsjfhn"=> "hello","X-Custom" => "Custom");
    var_dump($mailin->send_email($to,$subject,$from,$html,$message,$cc,$bcc,$replyto,$attachment,$headers));
	*/
	
$mailin = new Mailin('mladejebi@swifta.com', 'Kx4syT6qOJmWCbLU');
$mailin->
addTo('mladejebi@swifta.com', 'Mr. Modupe')->
addTo('pwndz172@gmail.com', 'Live')->
setFrom('pkigozi@swifta.com', 'Paul')->
setReplyTo('pkigozi@swifta.com','Developer')->
setSubject('TEST')->
setText('TEST SENDINBLUE')->
setHtml('<strong>TESTING SENDINBLUE</strong>');
$res = $mailin->send();
var_dump($res);

}


	}

?>
