<?php class SendinBlue_Test extends Controller{
	
	public function index(){
	require_once(APPPATH."vendor/mailin-api-php-master/V2.0/Mailin.php");
	$mailin = new Mailin("https://api.sendinblue.com/v2.0", "QxKf6XDyrJZAT9da");
	$html = "";
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
	}
	
}?>