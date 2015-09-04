<?php defined('SYSPATH') OR die('No direct access allowed.');
class Paypal_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->paypal = new Paypal_Model;
                if(LANGUAGE == "french" ){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/french_style.css',PATH.'themes/'.THEME_NAME.'/css/fr_multi_style.css'));
		}else if(LANGUAGE == "spanish"){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/spanish_style.css',PATH.'themes/'.THEME_NAME.'/css/sp_multi_style.css'));
		}
		else{
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}
		foreach($this->generalSettings as $s){

			$this->Api_Username = $s->paypal_account_id;
			$this->Api_Password = $s->paypal_api_password;
			$this->Api_Signature = $s->paypal_api_signature;

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
			$deal_key = $this->input->post("deal_key");
			$referral_amount = $this->input->post("p_referral_amount");
			$item_qty = $this->input->post("P_QTY");
			$this->deals_payment_deatils = $this->paypal->get_deals_payment_details($deal_id, $deal_key);

			if(count($this->deals_payment_deatils) == 0){
				common::message(-1, $this->Lang["PAGE_NOT"]);
				url::redirect(PATH);
			}
			$this->referral_balance_deatils = $this->paypal->get_user_referral_balance_details();
			$this->get_user_limit_details = $this->paypal->get_user_limit_details($deal_id);
			$this->get_user_limit_count = $this->paypal->get_user_limit_details($deal_id);
			$this->user_referral_balance = $this->paypal->get_user_referral_balance_details();

			foreach($this->deals_payment_deatils as $UL){
				$purchase_qty = $UL->purchase_count;
				$max_user_limit = $UL->user_limit_quantity;
				$min_deals_limit = $UL->minimum_deals_limit;
				$merchant_id = $UL->merchant_id;
			}

			if($referral_amount > $this->referral_balance_deatils ){
				common::message(-1,$this->Lang["INVALID_REF_AMONT"]);
				url::redirect(PATH);
			}

			if(($this->get_user_limit_details + $item_qty) > $max_user_limit){
				common::message(-1, $this->Lang["MAX_PURCH_LIMIT"]);
				url::redirect(PATH);
			}

			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
			                ->add_rules('firstName','required','chars[a-zA-Z_ -.,%\']')
			                ->add_rules('address1','required')
			                ->add_rules('creditCardNumber','required')
			                ->add_rules('city','required')
			                ->add_rules('state','required')
			                ->add_rules('zip','required')
			                ->add_rules('cvv2Number','required')
			                ->add_rules('deal_value','required')
			                ->add_rules('amount','required')
			                ->add_rules('friend_name','required')
			                ->add_rules('friend_email','required');
			if($post->validate()){
				$post = arr::to_object($this->input->post());

				if(($purchase_qty + $item_qty) >= $min_deals_limit){
					    $paymentType = "Sale";
					    $captured = 0;
				    } else {
					    $paymentType = "Authorization";
					    $captured = 1;
				}

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

				$friend_gift =$post->friend_gift;
				$friendName =$post->friend_name;
				$friendEmail =$post->friend_email;

				if(CURRENCY_CODE !="USD"){ // for Currency conversion
					$amount = common::currency_conversion(CURRENCY_CODE,"USD",$amount);
					$currencyCode = "USD";
				}
				$amount1 = $post->amount; // for insert and mail function
				$nvpstr ="&PAYMENTACTION=$paymentType&AMT=$amount&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country_code&CURRENCYCODE=$currencyCode";

				$this->result = arr::to_object($this->hash_call("doDirectPayment", $nvpstr));
				$ack = strtoupper($this->result->ACK);

				if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
					$transaction = $this->paypal->insert_transaction_details($this->result, $deal_id, $country_code, $firstName, $lastName, $referral_amount, $item_qty, 1, $captured, $purchase_qty, $friend_gift, $friendName, $friendEmail,$merchant_id,$amount1);
					$status = $this->do_captured_transaction($captured, $deal_id, $item_qty);
					$mail_status = $this->payment_mail_function($captured, $deal_id, $transaction);

					$this->results = arr::to_object(array('TIMESTAMP'=> date('d/m/Y h:i:s A', time()),'ACK'=>$this->Lang['SUCCESS'],'AMT'=>$amount1,'CURRENCYCODE'=>CURRENCY_CODE));
					$this->session->set('payment_result', $this->results);
					url::redirect(PATH.'transaction.html');
				}
				else{
				   if($this->result->L_LONGMESSAGE0){
				   common::message(-1, $this->result->L_LONGMESSAGE0);
					url::redirect(PATH);
				   } else {
					common::message(-1, $this->Lang["PROB_PAYPAL"]);
					url::redirect(PATH);
				   }
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
				$this->template->content = new View("themes/".THEME_NAME."/payment");
			}
		}
		else{
			common::message(-1, $this->Lang["PAGE_NOT"]);
			url::redirect(PATH);
		}
	}

	/** Paypal Payment - Express check out **/

	public function expresscheckout()
	{
		if($_POST){
			$deal_id = $this->input->post("deal_id");
			$deal_key = $this->input->post("deal_key");
			$referral_amount = $this->input->post("p_referral_amount");
			$item_qty = $this->input->post("P_QTY");
			$amount = $this->input->post("amount");
			$deal_value = $this->input->post("deal_value");
			$this->deals_payment_deatils = $this->paypal->get_deals_payment_details($deal_id, $deal_key);
			if(count($this->deals_payment_deatils) == 0){
				common::message(-1, $this->Lang["PAGE_NOT"]);
				url::redirect(PATH);
			}
			$this->referral_balance_deatils = $this->paypal->get_user_referral_balance_details();
			$this->get_user_limit_details = $this->paypal->get_user_limit_details($deal_id);
			$this->get_user_limit_count = $this->paypal->get_user_limit_details($deal_id);
			$this->user_referral_balance = $this->paypal->get_user_referral_balance_details();

			foreach($this->deals_payment_deatils as $UL){
				$purchase_qty = $UL->purchase_count;
				$max_user_limit = $UL->user_limit_quantity;
				$min_deals_limit = $UL->minimum_deals_limit;
				$url_title = $UL->url_title;
				$deal_price = $UL->deal_value;
				$merchant_id = $UL->merchant_id;
			}

			if($deal_price != $deal_value || (( $item_qty * $deal_value )-$referral_amount) != $amount){
				common::message(-1, $this->Lang["INVAL_DEAL_VAL"]);
				url::redirect(PATH);
			}
			if($referral_amount){
				 $deal_value = round(($amount / $item_qty),2);
				 $amount = round($deal_value*$item_qty,2);
			}

			if(($purchase_qty + $item_qty) >= $min_deals_limit ){
				$paymentType = "Sale";
				$captured = 0;
			}
			else{
				$paymentType = "Authorization";
				$captured = 1;
			}

			if($referral_amount > $this->referral_balance_deatils ){
				common::message(-1, $this->Lang["INVALID_REF_AMONT"]);
				url::redirect(PATH);
			}

			if(($this->get_user_limit_details + $item_qty) > $max_user_limit){
				common::message(-1, $this->Lang["MAX_PURCH_LIMIT"]);
				url::redirect(PATH);
			}

			$friend_name = $this->input->post("friend_name");
			$friend_email = $this->input->post("friend_email");
			$friend_gift_status = $this->input->post("friend_gift");
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('friend_name','required')
						->add_rules('friend_email','required')
						->add_rules('friend_gift','required');
			if($post->validate()){

			        $deal_custom_details = $deal_id."--".$referral_amount."--".$item_qty."--".$purchase_qty."--".$captured."--".$friend_name."--".$friend_email."--".$friend_gift_status."--".$merchant_id."--".$amount;
			        $returnURL = urlencode(PATH."paypal/authorize/".$deal_id."/");
			        $cancelURL = urlencode(PATH."deal/payment_details/".$deal_key."/".$url_title.".html");
			        $currencyCodeType = CURRENCY_CODE;

			        if(CURRENCY_CODE !="USD"){ // for Currency conversion
						$amount = common::currency_conversion(CURRENCY_CODE,"USD",$amount);
						$deal_value = common::currency_conversion(CURRENCY_CODE,"USD",$deal_value);
						$currencyCodeType = "USD";
					}

			        $nvpstr= "&AMT=".$amount."&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType."&L_NAME0=".$url_title."&L_AMT0=".$deal_value."&L_QTY0=".$item_qty."&CUSTOM=".$deal_custom_details."&LOGOIMG=".PATH.'themes/'.THEME_NAME.'/images/logo.png';

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
				$this->form_error = error::_error($post->errors());
				$this->template->content = new View("themes/".THEME_NAME."/payment");
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
				$referral_amount = $deal_custom[1];
				$qty = $deal_custom[2];
				$purchase_qty = $deal_custom[3];
				$captured = $deal_custom[4];
				$friend_name = $deal_custom[5];
				$friend_email = $deal_custom[6];
				$friend_gift_status = $deal_custom[7];
				$merchant_id = $deal_custom[8];
				$amount1 = $deal_custom[9];
				$paymentType = "Sale";
				$currencyCodeType = "USD";
				if($captured == 1){
					$paymentType = "Authorization";
				}
				$nvpstr ="&TOKEN=".$Response->TOKEN."&PAYERID=".$Response->PAYERID."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType."&AMT=".$Response->AMT;
				$result = arr::to_object($this->hash_call("DoExpressCheckoutPayment",$nvpstr));
				$ack = strtoupper($result->ACK);

				if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
					$transaction = $this->paypal->insert_paypal_transaction_details($result, $Response, 2, $deal_id, $referral_amount, $qty, $purchase_qty, $captured, $paymentType, $friend_name, $friend_email, $friend_gift_status , $merchant_id,$amount1);

					$status = $this->do_captured_transaction($captured, $deal_id, $qty);
					$mail_status = $this->payment_mail_function($captured, $deal_id, $transaction);

					$this->results = arr::to_object(array('TIMESTAMP'=> date('d/m/Y h:i:s A', time()),'ACK'=>$this->Lang['SUCCESS'],'AMT'=>$amount1,'CURRENCYCODE'=>CURRENCY_CODE)); // for success popup in home page

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

	public function referral_payment()
	{
		if($_POST){

			$deal_id = $this->input->post("deal_id");
			$deal_key = $this->input->post("deal_key");
			$referral_amount = $this->input->post("p_referral_amount");
			$item_qty = $this->input->post("P_QTY");
			$amount = $this->input->post("amount");
			$friend_name = $this->input->post("friend_name");
			$friend_email = $this->input->post("friend_email");
			$friend_gift_status = $this->input->post("friend_gift");
			$currencyCodeType = CURRENCY_CODE;
			$country_code = COUNTRY_CODE;

			$this->deals_payment_deatils = $this->paypal->get_deals_payment_details($deal_id, $deal_key);
			if(count($this->deals_payment_deatils) == 0){
				common::message(-1, $this->Lang["PAGE_NOT"]);
				url::redirect(PATH);
			}

			$this->referral_balance_deatils = $this->paypal->get_user_referral_balance_details();
			$this->get_user_limit_details = $this->paypal->get_user_limit_details($deal_id);
			$this->get_user_limit_count = $this->paypal->get_user_limit_details($deal_id);
			$this->user_referral_balance = $this->paypal->get_user_referral_balance_details();

			foreach($this->deals_payment_deatils as $UL) {
				$purchase_qty = $UL->purchase_count;
				$max_user_limit = $UL->user_limit_quantity;
				$min_deals_limit = $UL->minimum_deals_limit;
				$deal_price = $UL->deal_value;
				$deal_title = $UL->deal_title;
				$merchant_id = $UL->merchant_id;
			}

			if(($referral_amount > $this->referral_balance_deatils) || ($amount < 0) || (($deal_price * $item_qty) != $referral_amount)){
				common::message(-1, $this->Lang["INVALID_REF_AMONT"]);
				url::redirect(PATH);
			}

			if(($this->get_user_limit_details + $item_qty) > $max_user_limit){
				common::message(-1, $this->Lang["MAX_PURCH_LIMIT"]);
				url::redirect(PATH);
			}

			if(($purchase_qty + $item_qty) >= $min_deals_limit){
				$captured = 0;
			}
			else{
				$captured = 1;
			}

	        $transaction = $this->paypal->insert_referral_tranasaction($referral_amount, $item_qty, $deal_id, $purchase_qty, $friend_name, $friend_email, $friend_gift_status,$merchant_id,$currencyCodeType,$country_code);

	            $status = $this->do_captured_transaction($captured, $deal_id, $item_qty);
				$mail_status = $this->payment_mail_function($captured, $deal_id, $transaction);

				$this->transaction_result = array("TIMESTAMP" => date('m/d/Y h:i:s a', time()), "ACK" => $this->Lang['SUCCESS'] ,"AMT"=> $referral_amount,"CURRENCYCODE"=>CURRENCY_CODE);
	                $this->result_transaction = arr::to_object($this->transaction_result);
	                $this->session->set('payment_result', $this->result_transaction);
	                url::redirect(PATH.'transaction.html');

             }


	}

	/** CASH ON DELIIVERY  **/
	public function deal_cash_delivery()
	{
		if($_POST){
			$deal_id = $this->input->post("deal_id");
			$deal_key = $this->input->post("deal_key");
			$referral_amount = $this->input->post("p_referral_amount");
			$item_qty = $this->input->post("P_QTY");
			$amount = $this->input->post("amount");

			$this->deals_payment_deatils = $this->paypal->get_deals_payment_details($deal_id, $deal_key);

			if(count($this->deals_payment_deatils) == 0){
				common::message(-1, $this->Lang["PAGE_NOT"]);
				url::redirect(PATH);
			}
			$this->referral_balance_deatils = $this->paypal->get_user_referral_balance_details();
			$this->get_user_limit_details = $this->paypal->get_user_limit_details($deal_id);
			$this->get_user_limit_count = $this->paypal->get_user_limit_details($deal_id);
			$this->user_referral_balance = $this->paypal->get_user_referral_balance_details();

			foreach($this->deals_payment_deatils as $UL){
				$purchase_qty = $UL->purchase_count;
				$max_user_limit = $UL->user_limit_quantity;
				$min_deals_limit = $UL->minimum_deals_limit;
				$merchant_id = $UL->merchant_id;
			}

			if($referral_amount > $this->referral_balance_deatils ){
				common::message(-1,$this->Lang["INVALID_REF_AMONT"]);
				url::redirect(PATH);
			}

			if(($this->get_user_limit_details + $item_qty) > $max_user_limit){
				common::message(-1, $this->Lang["MAX_PURCH_LIMIT"]);
				url::redirect(PATH);
			}
			if(($purchase_qty + $item_qty) >= $min_deals_limit){
					    $captured = 0;
				    } else {

					    $captured = 1;
				}
				$paymentType = "COD";
				$TRANSACTIONID = text::random($type = 'alnum', $length = 16);

				$transaction = $this->paypal->insert_deal_cod_transaction_details($deal_id,arr::to_object($_POST), $referral_amount,$amount, $item_qty, 5, $captured, $purchase_qty,$merchant_id,$TRANSACTIONID);
					$status = $this->do_captured_transaction($captured, $deal_id, $item_qty);
					$mail_status = $this->payment_mail_function($captured, $deal_id, $transaction);
					 $this->transaction_result = array("TIMESTAMP" => date('m/d/Y h:i:s a', time()), "ACK" => $this->Lang['SUCCESS'] ,"AMT"=> $amount,"CURRENCYCODE" =>CURRENCY_CODE);
					$this->result = arr::to_object($this->transaction_result);
					$this->session->set('payment_result', $this->result);
					url::redirect(PATH.'transaction.html');

		}
		else{
			common::message(-1, $this->Lang["PAGE_NOT"]);
			url::redirect(PATH);
		}
	}


	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SENT MAIL **/

	private function do_captured_transaction($captured = "", $deal_id = "", $qty = "")
	{
		if($captured == 0){
			$captured_list = $this->paypal->payment_authorization_list($deal_id);
			foreach($captured_list as $C){
				if(($C->type==1)||($C->type==2)){  // for COD transaction
					$nvpStr = "&AUTHORIZATIONID=".$C->transaction_id."&AMT=".$C->amount."&COMPLETETYPE=Complete";
					$result = arr::to_object($this->hash_call("DoCapture", $nvpStr));
					if($result->ACK = "Success" ){
							$status = $this->paypal->update_captured_transaction($result, $C->id);
					}
				} else {
				        $status = $this->paypal->update_captured_transaction_success($C->id);
				}
				
				
			}

			$captured_mail_list = $this->paypal->payment_authorization_mail_list($deal_id);
			foreach($captured_mail_list as $mail){
			    $friend_details = $this->paypal->get_friend_transaction_details($deal_id, $mail->id);
                        $friend_email = $friend_details->current()->friend_email;
                        $friend_name = $friend_details->current()->friend_name;

			   $this->result_mail = arr::to_object(array("deal_title" => $mail->deal_title, "item_qty" => $mail->quantity ,"total" => $mail->amount + $mail->referral_amount,"ref_amount"=> $mail->referral_amount, "amount"=> $mail->amount ,"friend_name" => $friend_name,"user_name" => $mail->firstname,"value" =>$mail->deal_value,"merchant_id" =>$mail->merchant_id,"ip" => $mail->ip,"ip_city_name" => $mail->ip_city_name,"ip_country_name" => $mail->ip_country_name));

				$transaction_coupon_details = $this->paypal->get_all_deal_captured_coupon($deal_id, $mail->user_id, $mail->order_date);
				$coupon_array = array();
				$coupon_code = "";
				foreach($transaction_coupon_details as $coupon_details){
					$coupon_array[] = $coupon_details->coupon_code;
				}
				pdf::pdf_created($coupon_array);
				$file=array();
				for($i=0; $i < count($coupon_array); $i++){
					array_push($file, "images/pdf/Voucher".$i.".pdf");
				}

			    $subject = $this->Lang['THANKS_BUY'];
			    if($friend_email != "xxxyyy@zzz.com"){
						 $store_detail = $this->paypal->get_payment_store_detail($deal_id);
						 $store_name = $store_detail->current()->store_name;
						 $store_address = $store_detail->current()->address1." ,".$store_detail->current()->address2;
						 $phone_number = $store_detail->current()->phone_number;
						 $zipcode = $store_detail->current()->zipcode;
						 $website = $store_detail->current()->website;
						 $city_name = $store_detail->current()->city_name;

						 $this->result_mail = arr::to_object(array("deal_title" => $mail->deal_title, "url_title"=>$mail->url_title,"deal_key" => $mail->deal_key,"item_qty" => $mail->quantity ,"total" => $mail->amount + $mail->referral_amount,"ref_amount"=> $mail->referral_amount, "amount"=> $mail->amount ,"user_name" => $mail->firstname,"friend_name" => $friend_name,"value" =>$mail->deal_value,"expirydate"=>$mail->expirydate,"couponcode"=>$coupon_code,"purchase_count"=>$mail->purchase_count,"minimum_deals_limit"=>$mail->minimum_deals_limit,"store_name" => $store_name,"store_address" =>$store_address,"zipcode" =>$zipcode,"phone_number" => $phone_number,"website" => $website,"city_name" =>$city_name,"merchant_id" =>$mail->merchant_id,"ip" => $mail->ip,"ip_city_name" => $mail->ip_city_name,"ip_country_name" => $mail->ip_country_name));

			            $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail");
			    } else {
						$this->coupon_active = 1;// for check the coupon is active
			            $message = new View("themes/".THEME_NAME."/payment_mail");
			    }

				$from  = CONTACT_EMAIL;
				
				$message_admin = new View("themes/".THEME_NAME."/payment_mail_admin");
                                $this->admin_list = $this->paypal->get_admin_list();
				$this->admin_email = $this->admin_list->current()->email;
				
				$merchant_email = ""; 
                                $this->get_merchant_details = $this->paypal->get_merchant_details($mail->merchant_id);
                                $merchant_email = $this->get_merchant_details->current()->email;
                                $this->merchant_firstname = $this->get_merchant_details->current()->firstname;
                                $this->merchant_lastname = $this->get_merchant_details->current()->lastname;
				$message_merchant = new View("themes/".THEME_NAME."/payment_mail_merchant");
			
				
				if($friend_email != "xxxyyy@zzz.com"){
							if(EMAIL_TYPE==2){

								$status = email::smtp($from,$friend_email, $this->Lang['FRI_SUB'], $friend_message, $file);
								email::smtp($from, $this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
								email::smtp($from, $merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
								//$status = email::smtp($from,$this->admin_email, $this->Lang['USER_BUY'], $message_admin, $file);
                                                                //$status = email::smtp($from,$merchant_email, $this->Lang['USER_BUY'], $message_merchant, $file);

							} else {
								$a = email::sendgrid_attach1($friend_email, $this->Lang['FRI_SUB'] ,$friend_message,$file);
								$a = email::sendgrid($from, $this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
								$a = email::sendgrid($from, $merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
								//$a = email::sendgrid_attach1($this->admin_email, $this->Lang['USER_BUY'] ,$message_admin,$file);
								//$a = email::sendgrid_attach1($merchant_email, $this->Lang['USER_BUY'] ,$message_merchant,$file);
							}
						} else {
							 if(EMAIL_TYPE==2){
									email::smtp($from,$mail->email, $subject, $message,$file);
									email::smtp($from,$this->admin_email, $this->Lang['USER_BUY'], $message_admin);
								        email::smtp($from,$merchant_email, $this->Lang['USER_BUY'], $message_merchant);
									//email::smtp($from,$this->admin_email, $this->Lang['USER_BUY'], $message_admin,$file);
								        //email::smtp($from,$merchant_email, $this->Lang['USER_BUY'], $message_merchant,$file);
							}else {
								$status = email::sendgrid_attach1($mail->email, $subject, $message, $file);
								$a = email::sendgrid($from,$this->admin_email, $this->Lang['USER_BUY'], $message_admin);
								$a = email::sendgrid($from,$merchant_email, $this->Lang['USER_BUY'], $message_merchant);
								//$status = email::sendgrid_attach1($this->admin_email, $this->Lang['USER_BUY'], $message_admin, $file);
								//$status = email::sendgrid_attach1($merchant_email, $this->Lang['USER_BUY'], $message_merchant, $file);
							}
						}
				$transaction_coupon_update = $this->paypal->update_transaction_coupon_status1($deal_id,$mail->user_id,$mail->order_date);
				for($i=0; $i < count($coupon_array); $i++){
					unlink("images/pdf/Voucher".$i.".pdf");
				}

			}
		}
        $user_details = $this->paypal->get_purchased_user_details();
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->paypal->update_referral_amount($U->referred_user_id);
			}
			if($U->facebook_update == 1){
				$deals_details = $this->paypal->get_deals_details($deal_id);
				foreach($deals_details as $D){
					$dealURL = PATH."deals/".$D->deal_key.'/'.$D->url_title.".html";
					$message = $this->Lang['PURS_DEAL'].$D->deal_title." ".$dealURL.$this->Lang['LIMIT_OFF'];
					$post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");
					common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg );
				}
			}
		}
		return;
	}

	/** Send Purchase details to user Email **/

	private function payment_mail_function( $captured = "", $deal_id = "", $transaction_id = "")
	{
	    if($captured == 1){
		$from = CONTACT_EMAIL;
		$transaction_details = $this->paypal->get_all_deal_captured_transaction($deal_id, $transaction_id, $captured);
		foreach($transaction_details as $TD){
		        $friend_details = $this->paypal->get_friend_transaction_details($deal_id, $TD->id);
				$friend_email = $friend_details->current()->friend_email;
				$friend_name = $friend_details->current()->friend_name;

			   $this->result_mail = arr::to_object(array("deal_title" => $TD->deal_title, "item_qty" => $TD->quantity ,"total" => $TD->amount + $TD->referral_amount,"ref_amount"=> $TD->referral_amount, "amount"=> $TD->amount ,"friend_name" => $friend_name,"user_name" => $TD->firstname,"value" =>$TD->deal_value,"merchant_id" =>$TD->merchant_id));

					$subject = $this->Lang['THANKS_BUY'];
						if($friend_email != "xxxyyy@zzz.com"){

						 $store_detail = $this->paypal->get_payment_store_detail($deal_id);
						 $store_name = $store_detail->current()->store_name;
						 $store_address = $store_detail->current()->address1." ,".$store_detail->current()->address2;
						 $phone_number = $store_detail->current()->phone_number;
						 $zipcode = $store_detail->current()->zipcode;
						 $website = $store_detail->current()->website;
						 $city_name = $store_detail->current()->city_name;

						$this->result_mail = arr::to_object(array("deal_title" => $TD->deal_title,"deal_key" => $TD->deal_key,"url_title" => $TD->url_title, "item_qty" => $TD->quantity ,"total" => $TD->amount + $TD->referral_amount,"ref_amount"=> $TD->referral_amount, "amount"=> $TD->amount ,"friend_name" => $friend_name,"value" =>$TD->deal_value,"user_name" => $TD->firstname,"expirydate"=>$TD->expirydate,"couponcode"=>"","purchase_count"=>$TD->purchase_count,"minimum_deals_limit"=>$TD->minimum_deals_limit,"value" =>$TD->deal_value,"store_name" => $store_name,"store_address" =>$store_address,"zipcode" =>$zipcode,"phone_number" => $phone_number,"website" => $website,"city_name" =>$city_name,"merchant_id" =>$TD->merchant_id));

							 $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail");
						} else {
							$this->coupon_active = 0;// for check the coupon is active
								$message = new View("themes/".THEME_NAME."/payment_mail");
						}
						
						$message_admin = new View("themes/".THEME_NAME."/payment_mail_admin");
                                                $this->admin_list = $this->paypal->get_admin_list();
				                $this->admin_email = $this->admin_list->current()->email;
				
				
				                $merchant_email = ""; 
                                                $this->get_merchant_details = $this->paypal->get_merchant_details($TD->merchant_id);
                                                $merchant_email = $this->get_merchant_details->current()->email;
                                                $this->merchant_firstname = $this->get_merchant_details->current()->firstname;
                                                $this->merchant_lastname = $this->get_merchant_details->current()->lastname;
				                $message_merchant = new View("themes/".THEME_NAME."/payment_mail_merchant");

						//print_r($this->result_mail);

						if($friend_email != "xxxyyy@zzz.com"){
							if(EMAIL_TYPE==2){
								email::smtp($from, $friend_email, $this->Lang['FRI_SUB'] ,$friend_message);
								email::smtp($from, $this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
								email::smtp($from, $merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);

							} else {
								$a = email::sendgrid($from, $friend_email, $this->Lang['FRI_SUB'] ,$friend_message);
								$a = email::sendgrid($from, $this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
								$a = email::sendgrid($from, $merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
							}
						} else {
							 if(EMAIL_TYPE==2){
									email::smtp($from,$TD->email, $subject, $message);
									email::smtp($from,$this->admin_email, $this->Lang['USER_BUY'], $message_admin);
								        email::smtp($from,$merchant_email, $this->Lang['USER_BUY'], $message_merchant);
							}else {
								$a = email::sendgrid($from,$TD->email, $subject, $message);
								$a = email::sendgrid($from,$this->admin_email, $this->Lang['USER_BUY'], $message_admin);
								$a = email::sendgrid($from,$merchant_email, $this->Lang['USER_BUY'], $message_merchant);
							}
						}
		      }
		}
		        return;
	}

	/** Public Function Masspay [ FUND REQUEST ] **/

	public function masspay_fund_update($request_id = "", $user_id = "", $type = "")
	{
		
		$this->user_id = $this->session->get("user_id");
		$this->user_type = $this->session->get("user_type");

		if($this->user_id && $this->user_type == 1){
			$this->payment= new Admin_payment_Model();
			$users_details_amount = $this->payment->get_users_details_amount($request_id, $user_id);
			if(count($users_details_amount) == 0){
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
			else{
			        foreach($users_details_amount as $FR){

				        $account_balance = $FR->merchant_account_balance;
				        $request_amount = $FR->amount;
				        $total_amount = $account_balance + $request_amount;
				        $paypal_email = $FR->payment_account_id;
				    }

				  if($type == 2){

					if($paypal_email && $request_amount){
						$nvpStr = "&L_EMAIL0=".$paypal_email."&L_AMT0=".$request_amount;
						$result = arr::to_object($this->hash_call("MassPay", $nvpStr));

						//echo kohana::debug($result);exit;

						if($result->ACK == 'Success' || $result->ACK == 'SuccessWithWarning'){

							$status = $this->payment->update_fund_request_status($request_id, $user_id, 2, 1,$result,$request_amount);
							common::message(1, $this->Lang["WITHD_SUCC"]);
						}
						else{
							$status = $this->payment->update_fund_request_status($request_id, $user_id, 2, 2,$result,$request_amount);
							common::message(-1,$this->Lang["FUND_FAILD"]);
						}
					}
					else{
						common::message(-1, $this->Lang["PAYPAL_ACCOUNT_MISSING"]);
					}
				}
				elseif($type == 3){
					$status = $this->payment->update_fund_reject_status($request_id, $user_id, 3,0,$total_amount);
					common::message(1, $this->Lang["WITHD_REJ"]);
				}
			}
			$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH.'admin/all-fund-request.html');
                }
		}
		common::message(-1, $this->Lang["PAGE_NOT"]);
		url::redirect(PATH);
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
