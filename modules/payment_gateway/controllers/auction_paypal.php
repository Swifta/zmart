<?php defined('SYSPATH') OR die('No direct access allowed.');
class Auction_Paypal_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{

		parent::__construct();
		$this->paypal = new Auction_Paypal_Model;
        $this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css'));
		foreach($this->generalSettings as $s){

			$this->Api_Username = $s->paypal_account_id;
			$this->Api_Password = $s->paypal_api_password;
			$this->Api_Signature = $s->paypal_api_signature;

			$this->Api_Username = "nandhu_1337947987_biz_api1.gmail.com";
			$this->Api_Password = "1337948040";
			$this->Api_Signature = "A0YqGlJEML24al4qg2LnV2U.g2ThAfXD37NEiWIVcgjl1pxlygg-XaVs";

			$this->Live_Mode = $s->paypal_payment_mode;
			$this->API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
			$this->Paypal_Url = "https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=";

			if($this->Live_Mode == 1){
				$this->API_Endpoint = "https://api-3t.paypal.com/nvp";
				$this->Paypal_Url = "https://www.paypal.com/webscr&cmd=_express-checkout&token=";
			}
			
		}
		$this->Api_Version = "76.0";
		$this->Api_Subject = $this->AUTH_token = $this->AUTH_signature = $this->AUTH_timestamp = '';
	}

	/** DoDirectPayment - Credit Card  **/

	public function dodirectpayment()
	{ 

		if($_POST){  
				$deal_id = $this->input->post("deal_id");
				$merchant_id = $this->input->post("merchant_id"); 
				$bid_id = $this->input->post("bid_id"); 
				$deal_key = $this->input->post("deal_key"); 
				$url_title = $this->input->post("url_title");   
				$referral_amount = 0;
				$item_qty = $this->input->post("P_QTY");
				$amount = $this->input->post("amount");			
				$deal_value = $this->input->post("deal_value");
				$shipping_amount = $this->input->post("shipping_amount");
				$tax_amount = 0;
					
				$tot_amount = $tot_amount1 = $amount+$shipping_amount;
			
				$adderss1 = $this->input->post("adderss1");
				$adderss2 = $this->input->post("adderss2");
				$state = $this->input->post("state");
				$city = $this->input->post("city");
				$country = $this->input->post("country");
				$zip = $this->input->post("postal_code");
				$phone = $this->input->post("phone");

				$post = arr::to_object($this->input->post());
					$paymentType = "Sale";
					$captured = 0;
				
				$creditCardNumber = urlencode($post->creditCardNumber);
				$cvv2Number = urlencode($post->cvv2Number);
				$expDateMonth =urlencode( $post->expDateMonth);
				$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
				$expDateYear =urlencode( $post->expDateYear);
				$firstName =urlencode( $post->firstName);
				$lastName =urlencode( $post->firstName);			
				$address1 = urlencode($post->address1);
				$city = urlencode($post->city);
				$state =urlencode($post->state);
				$zip = urlencode($post->zip);
				$country_code = COUNTRY_CODE;
				$amount = urlencode($post->amount);
				$currencyCode = CURRENCY_CODE;

				if(CURRENCY_CODE !="USD"){ // for Currency conversion 
					$tot_amount = common::currency_conversion(CURRENCY_CODE,"USD",$tot_amount);
					$currencyCode = "USD";
				}					
				
				$nvpstr ="&PAYMENTACTION=$paymentType&AMT=$tot_amount&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country_code&CURRENCYCODE=$currencyCode";
				$this->result = arr::to_object($this->hash_call("doDirectPayment", $nvpstr));
				$ack = strtoupper($this->result->ACK);

				if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){				
			        
			        $transaction = $this->paypal->insert_transaction_details($this->result, $deal_id, $country_code, $firstName, $lastName, $referral_amount, $item_qty, 1, $captured, $item_qty, $post,$merchant_id,$tax_amount,$shipping_amount,$amount,$bid_id);	
					
			        $status = $this->payment_mail_function($deal_id,$transaction);
			        $this->results = arr::to_object(array('TIMESTAMP'=> date('d/m/Y h:i:s A', time()),'ACK'=>$this->Lang['SUCCESS'],'AMT'=>$tot_amount1,'CURRENCYCODE'=>CURRENCY_CODE));
			  		$this->session->set('payment_result', $this->results);
					url::redirect(PATH.'transaction.html');
				}
					
				} else {
				
					common::message(-1, $this->Lang["PROB_PAYPAL"]);  
					url::redirect(PATH."cart.html");	
				}
	}


	/** CASH ON DELIVERY **/

	public function cash_on_delivery()
	{ 

		if($_POST){  
				$deal_id = $this->input->post("deal_id");
				$merchant_id = $this->input->post("merchant_id"); 
				$bid_id = $this->input->post("bid_id"); 
				$deal_key = $this->input->post("deal_key"); 
				$url_title = $this->input->post("url_title");   
				$referral_amount = 0;
				$item_qty = $this->input->post("P_QTY");
				$amount = $this->input->post("amount");			
				$deal_value = $this->input->post("deal_value");
				$shipping_amount = $this->input->post("shipping_amount");
				$tax_amount = 0;
					
				$tot_amount = $tot_amount1 = $amount+$shipping_amount+$tax_amount;

				$post = arr::to_object($this->input->post());
					$captured = 0;
					
			        $transaction = $this->paypal->insert_cod_transaction_details($deal_id,$referral_amount, $item_qty, 5, $captured, $item_qty, $post,$merchant_id,$tax_amount,$shipping_amount,$amount,$bid_id);	
					
			        $status = $this->payment_mail_function($deal_id,$transaction);
			        $this->results = arr::to_object(array('TIMESTAMP'=> date('d/m/Y h:i:s A', time()),'ACK'=>$this->Lang['SUCCESS'],'AMT'=>$tot_amount1,'CURRENCYCODE'=>CURRENCY_CODE));
			  		$this->session->set('payment_result', $this->results);
					url::redirect(PATH.'transaction.html');
									
				} else {
				
					common::message(-1, $this->Lang["PAGE_NOT"]);  
					url::redirect(PATH."auction.html");	
				}
	}



	/** Paypal Payment - Express check out **/

	public function expresscheckout()
	{

		if($_POST){ 	
			$deal_id = $this->input->post("deal_id"); 
			$merchant_id = $this->input->post("merchant_id"); 
			$bid_id = $this->input->post("bid_id"); 
			$deal_key = $this->input->post("deal_key"); 
		    $url_title = $this->input->post("url_title");   
			$referral_amount = 0;
			$item_qty = $this->input->post("P_QTY");
			$amount = $this->input->post("amount");			
			$deal_value = $this->input->post("deal_value");
			$shipping_amount = $this->input->post("shipping_amount");
			$tax_amount = 0;			

		    $tot_amount = $amount+$shipping_amount;
			$paymentType = "Sale";
			$captured = 0;
			
			$shipping_name = $this->input->post("shipping_name");			
			$adderss1 = $this->input->post("adderss1");
			$adderss2 = $this->input->post("adderss2");
			$state = $this->input->post("state");
			$city = $this->input->post("city");
			$country = $this->input->post("country");
			$zip = $this->input->post("postal_code");
			$phone = $this->input->post("phone");
			
			        //$tot_bid_increment = $deal_price + $bid_increment;
			        $deal_custom_details = $deal_id."--".$amount."--".$shipping_amount."--".$tax_amount."--".$captured."--".$merchant_id."--"."--".$item_qty."--".$adderss1."--".$adderss2."--".$state."--".$city."--".$country."--".$zip."--".$phone."--".$shipping_name."--".$bid_id;
			        $returnURL = urlencode(PATH."auction_paypal/authorize/".$deal_id."/");
			        $cancelURL = urlencode(PATH."deal/payment_details/".$deal_key."/".$url_title.".html");
			        $currencyCodeType = CURRENCY_CODE;

				if(CURRENCY_CODE !="USD"){ // for Currency conversion 
					
					$shipping_amount = common::currency_conversion(CURRENCY_CODE,"USD",$shipping_amount);
					$amount = common::currency_conversion(CURRENCY_CODE,"USD",$amount);

					//$tot_amount = common::currency_conversion(CURRENCY_CODE,"USD",$tot_amount);
					$tot_amount = $amount+$shipping_amount;
					
					$currencyCodeType = "USD";
				}
				
			        
			        $nvpstr="&AMT=".$tot_amount."&ITEMAMT=".$amount."&TAXAMT=0.00"."&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType."&L_NAME0=".$url_title."&SHIPPINGAMT=".$shipping_amount."&L_AMT0=".$amount."&L_QTY0=".$item_qty."&CUSTOM=".$deal_custom_details."&LOGOIMG=".PATH.'themes/'.THEME_NAME.'/images/logo.png';       
          			$resArray = $this->hash_call("SetExpressCheckout",$nvpstr);                   
			        $ack = strtoupper($resArray["ACK"]); 
			        
			        if($ack == "SUCCESS" || $ack == 'SUCCESSWITHWARNING'){
				        $this->session->set("IS_authorize", 1);
				        url::redirect($this->Paypal_Url.urldecode($resArray["TOKEN"]));
			        }
			        else{
				        common::message(-1,$this->Lang["PLES_TRY_SOMETIMES"]);
			        }
			 
			
		}
		else{	
			common::message(-1, $this->Lang["PAGE_NOT"]);		
		}
		url::redirect(PATH);
	}

	/** Redirect After paypal authorize (Success) **/

	public function authorize($deal_id = "")
	{

		$status = $this->session->get("IS_authorize");
		if($status == 1){
			$this->session->delete("IS_authorize");
			$token =urlencode($_REQUEST['token']);
			$nvpstr="&TOKEN=".$token;

			$Response = $this->hash_call("GetExpressCheckoutDetails", $nvpstr);

			$ack = strtoupper($Response["ACK"]);
			if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
				$Response = arr::to_object($Response);
				$deal_custom = explode("--", $Response->PAYMENTREQUEST_0_CUSTOM);
				$deal_id = $deal_custom[0];
				$amount = $deal_custom[1];
				$shipping_amount = $deal_custom[2];
				$tax_amount = $deal_custom[3];
				$captured = $deal_custom[4];
				$merchant_id = $deal_custom[5];
				$purchase_qty = $deal_custom[6];
				$item_qty = $deal_custom[7];
				$adderss1 = $deal_custom[8];
				$adderss2 = $deal_custom[9];
				$state = $deal_custom[10];
				$city = $deal_custom[11];
				$country = $deal_custom[12];
				$zip = $deal_custom[13];
				$phone = $deal_custom[14];
				$shipping_name = $deal_custom[15];
				$bid_id = $deal_custom[16];
				$tot_amount1 = $shipping_amount+$amount;
				$currencyCodeType = "USD";
				$paymentType = "Sale";
				$nvpstr ="&TOKEN=".$Response->TOKEN."&PAYERID=".$Response->PAYERID."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType."&AMT=".$Response->AMT;
				$result = arr::to_object($this->hash_call("DoExpressCheckoutPayment",$nvpstr));
				$ack = strtoupper($result->ACK);

				if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){				
					$transaction = $this->paypal->insert_paypal_transaction_details($result, $Response, 2, $deal_id, $amount, $shipping_amount, $purchase_qty, $captured, $paymentType, $merchant_id,$item_qty,$adderss1,$adderss2,$state,$city,$country,$zip,$phone,$tax_amount,$shipping_name,$bid_id,$tot_amount1);
					
					$mail_status = $this->payment_mail_function($deal_id, $transaction);

					 $this->results = arr::to_object(array('TIMESTAMP'=> date('d/m/Y h:i:s A', time()),'ACK'=>"Success",'AMT'=>$tot_amount1,'CURRENCYCODE'=>CURRENCY_CODE));
			  		$this->session->set('payment_result', $this->results);
			  		
	                url::redirect(PATH.'transaction.html');	
				}
				else{
					common::message(-1, $this->Lang["PROB_PAYPAL"]);	
				}		
			}
			else{
				common::message(-1, $this->Lang["PROB_PAYPAL"]);
			}
		}
		else{	
			common::message(-1,$this->Lang["PAGE_NOT"]);
		}
		url::redirect(PATH);
	}

	/** Send Purchase details to user Email **/
	
	private function payment_mail_function($deal_id = "", $transaction_id = "")
	{
		$this->auction_details = $this->paypal->get_auction_mail_data($deal_id,$transaction_id);

		 $message = new View("themes/".THEME_NAME."/auction/auction_payment_mail"); 

		foreach ($this->auction_details as $row) {

			if($row->facebook_update == 1){
				
					$dealURL = PATH."auction/".$row->deal_key.'/'.$row->url_title.".html";
					$message1 = $this->Lang['ACT_PURCASH'].$row->deal_title." ".$dealURL;
					$post_arg = array("access_token" => $row->fb_session_key, "message" => $message1, "id" => $row->fb_user_id, "method" => "post");
					common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg );
				
			}

			$from = CONTACT_EMAIL;
			$subject = $this->Lang['THANKS_BUY'];
				if(EMAIL_TYPE==2){
                    email::smtp($from,$row->email, $subject, $message);
			    }
			    else{
			      email::sendgrid($from,$row->email, $subject, $message);
			    }

 		}
		

		/*$from = NOREPLY_EMAIL;
	 	
		$transaction_details = $this->paypal->get_all_deal_captured_transaction($deal_id, $transaction_id, $captured);	
		foreach($transaction_details as $TD){	
		
		        $friend_details = $this->paypal->get_friend_transaction_details($deal_id, $TD->id);			        
                $friend_email = $friend_details->current()->friend_email;
                $friend_name = $friend_details->current()->friend_name;        
			    $this->result_mail = arr::to_object(array("deal_title" => $TD->deal_title, "shipping_amount" => $shipping_amount ,"total" => $TD->amount ,"ref_amount"=> $TD->referral_amount, "amount"=> $amount ,"friend_name" => $friend_name,"value" =>$TD->amount));
			    $subject = "Thanks for buying from ". SITENAME;		
			        if($friend_email != "xxxyyy@zzz.com"){
			                $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail");
			        } else {
			                $message = new View("themes/".THEME_NAME."/auction/auction_payment_mail");
			        }
			        if($friend_email != "xxxyyy@zzz.com"){
				    if(EMAIL_TYPE==2){
		                    email::smtp($from, $friend_email, "You Got Coupon Gift from your Friend" ,$friend_message);
				}else{
				   email::sendgrid($from, $friend_email, "You Got Coupon Gift from your Friend" ,$friend_message);
				}
		            } else {
				    if(EMAIL_TYPE==2){			        
		                    email::smtp($from,$TD->email, $subject, $message);
				    }
				    else{
				      email::sendgrid($from,$TD->email, $subject, $message);
				    }
		            }
			
		}	*/	
		return;
	}
 

	private function hash_call($methodName, $nvpStr)
	{
	        
		$nvpheader = $this->nvpHeader();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);

		if($this->AUTH_token && $this->AUTH_signature && $this->AUTH_timestamp){
			$headers_array[] = "X-PP-AUTHORIZATION: ".$nvpheader;
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_array);
			curl_setopt($ch, CURLOPT_HEADER, false);
		}
		else {
			$nvpStr = $nvpheader.$nvpStr;
		}
		
		if(strlen(str_replace('VERSION=', '', strtoupper($nvpStr))) == strlen($nvpStr)) {
			$nvpStr = "&VERSION=" . $this->Api_Version . $nvpStr;	
		}
               

		$nvpreq = "METHOD=".urlencode($methodName).$nvpStr;
				

		curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);
		$response = curl_exec($ch);
		$nvpResArray = $this->deformatNVP($response);
		if(curl_errno($ch)) { 
			$_SESSION['curl_error_no']=curl_errno($ch) ;
			$_SESSION['curl_error_msg']=curl_error($ch);
		} else {
			curl_close($ch);
		}

		return $nvpResArray;
	}

	/** NVP Header **/

	public function nvpHeader()
	{
		$nvpHeaderStr = "";
		if($this->Api_Username && $this->Api_Password && $this->Api_Signature && $this->Api_Subject) {
			$nvpHeaderStr = "&PWD=".urlencode($this->Api_Password)."&USER=".urlencode($this->Api_Username)."&SIGNATURE=".urlencode($this->Api_Signature)."&SUBJECT=".urlencode($this->Api_Subject);
		}
		elseif($this->Api_Username && $this->Api_Password && $this->Api_Signature) {
			$nvpHeaderStr = "&PWD=".urlencode($this->Api_Password)."&USER=".urlencode($this->Api_Username)."&SIGNATURE=".urlencode($this->Api_Signature);
		}
		elseif ($this->AUTH_token && $this->AUTH_signature && $this->AUTH_timestamp) {
			$nvpHeaderStr = $this->formAutorization($this->AUTH_token,$this->AUTH_signature,$this->AUTH_timestamp);
		}
		elseif($this->Api_Subject) {
			$nvpHeaderStr = "&SUBJECT=".urlencode($this->Api_Subject);
		}
		return $nvpHeaderStr;
	}
	
	/** form Autorization**/

	private function formAutorization($auth_token,$auth_signature,$auth_timestamp)
	{
		$authString="token=".$auth_token.",signature=".$auth_signature.",timestamp=".$auth_timestamp ;
		return $authString;
	}

	/** Format Response Data  **/

	private function deformatNVP($nvpstr)
	{
		$intial = 0;
		$nvpArray = array();

		while(strlen($nvpstr)){
			$keypos= strpos($nvpstr,'=');
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);

			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
		}
		return $nvpArray;
	}
	
	/** PAYMENT STATS AFTER PAYMENT PROCESS COMPLETE **/

	public function success()
	{
	        $this->result = $this->session->get('payment_result');
		if(!$this->result){
			url::redirect(PATH);
		}
	        $this->session->delete('payment_result');
		$this->template->content = new View("themes/".THEME_NAME."/success_payment");
	}

}

