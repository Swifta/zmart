<?php 
	if(defined('SYSPATH') or die('No direct access allowed.'));
?>

<?php

	class Sample_Controller extends Controller {
		
public function index(){
		smtp("",array(),"","","");
}

public function smtp($from = "",$receiver = array(), $subject = "", $message = "",$file = ""){
	
	$from = "";
	$receiver = array();
	
	
   require_once(APPPATH.'vendor/mailin-sendinblue/V2.0/Mailin.php');
   $mail = new Mailin("https://api.sendinblue.com/v2.0","Kx4syT6qOJmWCbLU");
   
   		/*$sitename = SITENAME;
        if(!$sitename){
            $sitename = $_SERVER['HTTP_HOST'];
        }
        $fromEmail = NOREPLY_EMAIL;
        if(!$fromEmail){
            $fromEmail = "noreply@".$_SERVER['HTTP_HOST'];
        }*/
		
		
		
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
				
			//$to = array("pkigozi@swifta.com"=>"CLIENT"); //mandatory
			$subject = "";
			//$from = array("pwndz172@gmail.com","support@zmart"); //mandatory
			//$html = "This is the <h1>HTML</h1>"; //mandatory
			//$text = "This is the text";
			$cc = array(); 
			$bcc = array();
			$replyto = array("noreply@zmart.com","NOREPLY"); 
			$attachment = array(); 
			$headers = array("Content-Type"=> "text/html; charset=iso-8859-1","X-Ewiufkdsjfhn"=> "hello","X-Custom" => "Custom");
			
            $r = $mail->send_email($receiver,$subject,$from,$message,"",$cc,$bcc,$replyto,$attachment,$headers);
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
