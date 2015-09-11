<?php 
	if(defined('SYSPATH') or die('No direct access allowed.'));
?>

<?php

	class Sample_Controller extends Controller {
		
public function index(){
		smtp("",array(),"HELLO","","");
}

public function smtp($from = "",$receiver = array(), $subject = "", $message = "",$file = ""){
	
	$to = array("pkigozi@swifta.com" => "CLIENT");
	$receiver = array();
	$subject = "TEST";
	
	/*$to = array("to@example.net"=>"to whom!"); //mandatory
	$subject = "My subject"; //mandatory
	$from = array("from@email.com","from email!"); //mandatory
	$html = "This is the <h1>HTML</h1>"; //mandatory
	$text = "This is the text";
	$cc = array("cc@example.net"=>"cc whom!"); 
	$bcc = array("bcc@example.net"=>"bcc whom!");
	$replyto = array("replyto@email.com","reply to!"); 
	$attachment = array(); //provide the absolute url of the attachment/s 
	$headers = array("Content-Type"=> "text/html; charset=iso-8859-1","X-Ewiufkdsjfhn"=> "hello","X-Custom" => "Custom");*/

	
	
   require_once(APPPATH.'vendor/mailin-sendinblue/V2.0/Mailin.php');
   $mail = new Mailin("https://api.sendinblue.com/v2.0","Kx4syT6qOJmWCbLU");
   
  
   
		$category = "TEST";
		$from_name = "support@zmart";
		$name = "campaign";
		$bat_sent = "pkigozi@swifta.com";
		$html_content = "<h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h><h>HELLO</h>";
		$html_url = "";
		$listid = array();
		$scheduled_date = "";
		$subject = "TESTING";
		$from_email = "pkigozi@swifta.com";
		$reply_to = "pkigozi@swifta.com";
		$to_field = "";
		$exclude_list = array();
		$attachmentUrl = "";
		$inline_image = 1;
		$mirror_active ="";
		$send_now = 1;
		  
   		
   
   		var_dump($mail->create_campaign(
		
									$category,
									$from_name,
									$name,
									$bat_sent,
									$html_content,
									$html_url,
									$listid,
									$scheduled_date,
									$subject,
									$from_email,
									$reply_to,
									$to_field,
									$exclude_list,
									$attachmentUrl,
									$inline_image,
									$mirror_active,
									$send_now
		));
		
		exit;
		
		
		
        try {
			$attachment = array();
            if($file != "")
			{
					$x = 0;
					foreach($file as $f){
						$attachment[x] = $f;
						$x++;

					}
			}
				
			$to = array("pkigozi@swifta.com"=>"CLIENT"); //mandatory
			$subject = "TEST";
			$from = array("pwndz172@gmail.com","support@zmart"); //mandatory
			$html = "This is the <h1>HTML</h1>"; //mandatory
			$text = "This is the text";
			$cc = array(); 
			$bcc = array();
			$replyto = array("noreply@zmart.com","NOREPLY"); 
			$attachment = array(); 
			$headers = array("Content-Type"=> "text/html; charset=iso-8859-1","X-Ewiufkdsjfhn"=> "hello","X-Custom" => "Custom");
			
            $r = $mail->send_email($to,$subject,$from,$message," ",$cc,$bcc,$replyto,$attachment,$headers);
			var_dump($r);
			exit;
			

        }
        catch(Expection $e) {
            common::message(-1,  $e->errorMessage());

        }
        catch (Exception $e) {
            common::message(-1,  $e->getMessage());
        }
        return;
    }


	}

?>
