<?php defined('SYSPATH') OR die('No direct access allowed.');
class Api_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->api = new Api_Model;		
		
		foreach($this->generalSettings as $s){
		
			$this->Api_Username = $s->paypal_account_id;
			$this->Api_Password = $s->paypal_api_password;
			$this->Api_Signature = $s->paypal_api_signature;

			$this->Live_Mode = $s->paypal_payment_mode;
			$this->API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
			$this->Paypal_Url = "https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=";
			
			/**  For Authorize.net   **/
			
			require_once APPPATH.'vendor/authorize.net/AuthorizeNet.php'; 
	                define("AUTHORIZENET_API_LOGIN_ID", $s->authorizenet_api_id);
	                define("AUTHORIZENET_TRANSACTION_KEY", $s->authorizenet_transaction_key);
	        
	        
			if($this->Live_Mode == 1){
				$this->API_Endpoint = "https://api-3t.paypal.com/nvp";
				$this->Paypal_Url = "https://www.paypal.com/webscr&cmd=_express-checkout&token=";
				
				/**  For Authorize.net   **/
				
				define("AUTHORIZENET_SANDBOX", false);
				
			} else {
			define("AUTHORIZENET_SANDBOX", true);
			 }
		}
		$this->Api_Version = "76.0";
		$this->Api_Subject = $this->AUTH_token = $this->AUTH_signature = $this->AUTH_timestamp = '';
	}


    /** DoDirectPayment - Credit Card  **/

	public function product_dodirectpayment()
	{
		
	  if($_POST){ 
           $get_deal_id = substr($this->input->post("deal_id"),0,-1);
            $deal_id = explode(",", $get_deal_id );
            $cart_count = count($deal_id);
            $get_deal_qty = substr($this->input->post("deal_qty"),0,-1);
            $deal_qty = explode(",", $get_deal_qty);
            $size_array = explode(",",substr($this->input->post("product_size"),0,-1));
            $color_array = explode(",",substr($this->input->post("product_color"),0,-1));
            $userid = $this->input->post("userid");
            $lang = $this->input->post("lang");
            $total_product_amount = $this->input->post("total_product_amount");
                if((count($deal_id))==(count($deal_qty))) {
                    $this->userPost = $this->input->post();
					$product_color="0";
					$total_amount="0";
					$total_qty="0";
					$produ_qty="0";
					$total_shipping="0";
                    $referral_amount=0;
                    $product_size = "0";
		    $product_shipping = ""; 
                        for($i=0; $i<count($deal_id); $i++) {
                                                                /** Check the quatity available in particular size start */
                                                                $product_size =$size_array[$i]; 
                                                                $product_color=$color_array[$i];
                                                                $this->product_size_details = $this->api->product_size_details($deal_id[$i], $product_size); 
								$dbquantity=$this->product_size_details->current()->quantity;
								$this->deals_payment_deatils = $this->api->get_product_payment_details($deal_id[$i]);
								$product_title = $this->deals_payment_deatils->current()->deal_title;
								$product_title_arabic = $this->deals_payment_deatils->current()->deal_title;
								$purchase_count = $this->deals_payment_deatils->current()->purchase_count;
								$user_limit_quantity = $this->deals_payment_deatils->current()->user_limit_quantity;
								
								if($purchase_count >= $user_limit_quantity ){
									if($lang == "ar"){
									$response = array("response" => array("httpCode" => 400 , "Message" => "المنتج المحدد ($product_title_arabic) وقد بيعت اختيار بعض المنتجات الأخرى" ));
									} else {
									$response = array("response" => array("httpCode" => 400 , "Message" => "Selected product ($product_title) was sold out choose some other product" ));
									}
									echo json_encode($response);
									exit;
									
								}
								
								if($dbquantity == 0 ) {
								        if($lang == "ar"){
									$response = array("response" => array("httpCode" => 400 , "Message" => "بيعت حجم اختيارها من تحديد بعض حجم أخرى للمنتج,$product_title_arabic" ));
									} else {
									$response = array("response" => array("httpCode" => 400 , "Message" => "Selected size was sold out select some other size for product,$product_title" ));
									}
									echo json_encode($response);
									exit;
								}
								
								else if($dbquantity < $deal_qty[$i]){
								        if($lang == "ar"){
									$response = array("response" => array("httpCode" => 400 , "Message" => "كمية غير كافية لحجم المحدد والمنتج. الرجاء اختيار ضمن هذه الكمية $dbquantity للمنتج,$product_title_arabic" ));
									} else {
									$response = array("response" => array("httpCode" => 400 , "Message" => "Insufficient quantity for the selected size and product. Please select within this quantity $dbquantity for product,$product_title" ));
									}
									echo json_encode($response);
									exit;
								}
								
							/** End   **/
							
                                                        $this->deals_payment_deatils = $this->api->get_product_payment_details($deal_id[$i]); 
							if(count($this->deals_payment_deatils) == 0){
							        if($lang == "ar"){
								$response = array("response" => array("httpCode" => 401 , "Message" => "الصفحة لم يتم العثور حاول مرة أخرى!" ));
								} else {
								$response = array("response" => array("httpCode" => 401 , "Message" => "Page not found try again!" ));
								}
								echo json_encode($response);
								exit;
							}
                                                        foreach($this->deals_payment_deatils as $UL){
								$purchase_qty = $UL->purchase_count;
								$deal_title = $UL->deal_title;
								$deal_key  = $UL->deal_key;
                                                                $deal_value = $UL->deal_value;
								$url_title = $UL->url_title;
                                                                $merchant_id = $UL->merchant_id;
                                                                $shipping_amount = $UL->shipping_amount;
                                                                $product_amount = $UL->deal_value*$deal_qty[$i];
								$shipping_methods = $UL->shipping;
                                                        }   
                                
                                                if($shipping_methods  == 1){
									$total_shipping += 0;
								}  elseif($shipping_methods  == 2){
							$merchant_flat_amount = $this->api->get_userflat_amount($merchant_id);
									$total_shipping += $merchant_flat_amount->flat_amount;
								} elseif($shipping_methods == 3){
									$total_shipping +=$shipping_amount;
								} elseif($shipping_methods  == 4){
									$total_shipping +=$shipping_amount*$deal_qty[$i];
								}
								$total_amount +=$product_amount;
								
						}		
								
							$total_tax = (TAX_PRECENTAGE_VALUE/100)*($total_amount+$total_shipping);
							$pay_amount = $total_amount+$total_shipping+$total_tax;
									
							
                    if($total_product_amount==$pay_amount){
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
						//$amount = urlencode($post->amount);
						$currencyCode = CURRENCY_CODE;
						
						$friend_gift =$post->friend_gift;
						$friendName =$post->friend_name;
						$friendEmail =$post->friend_email;
						$product_size="";
						$product_color="";
						
					if(CURRENCY_CODE !="USD"){ // for Currency conversion
					        $pay_amount = common::currency_conversion(CURRENCY_CODE,"USD",$pay_amount);
					        $currencyCode = "USD";
				        }
						
						$nvpstr ="&PAYMENTACTION=$paymentType&AMT=$pay_amount&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country_code&CURRENCYCODE=$currencyCode";
				
						$this->result = arr::to_object($this->hash_call("doDirectPayment", $nvpstr));
				                
						$ack = strtoupper($this->result->ACK);
						if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
							$product_color="0";
							$product_size = "0"; 
						
							for($i=0; $i<count($deal_id); $i++) {
								
								/** Check the quatity available in particular size start */
								$product_size =$size_array[$i]; 
								$product_color=$color_array[$i];
								
								$this->deals_payment_deatils = $this->api->get_product_payment_details($deal_id[$i]);	
									foreach($this->deals_payment_deatils as $UL){
										$purchase_qty = $UL->purchase_count;
										$deal_value = $UL->deal_value;
										$merchant_id = $UL->merchant_id;
										$product_shipping = $UL->shipping_amount;
										 $shipping_methods = $UL->shipping;
										$delivery_period = $UL->delivery_period;
										$product_amount = $UL->deal_value*$deal_qty[$i];
									}   
									
									if($shipping_methods  == 1){
										$shipping_amount = 0;
									}elseif($shipping_methods  == 2){
							$merchant_flat_amount = $this->api->get_userflat_amount($merchant_id);
									    $shipping_amount = $merchant_flat_amount->flat_amount;
									} elseif($shipping_methods  == 3){
										$shipping_amount =$product_shipping;
									} elseif($shipping_methods  == 4){
										$shipping_amount =$product_shipping*$deal_qty[$i];
									}		        
											
									$taxdeal_amount=($deal_value*$deal_qty[$i])+$shipping_amount;
									$tax_amount = ((TAX_PRECENTAGE_VALUE/100)*$taxdeal_amount);
									  $deal_amount=$deal_value*$deal_qty[$i];
									  
										$transaction = $this->api->insert_product_transaction_details($this->result, $deal_id[$i], $country_code, $firstName, $lastName, $referral_amount, $deal_qty[$i], 1, $captured, $purchase_qty, arr::to_object($this->userPost),$merchant_id,$userid,$friend_gift, $friendName, $friendEmail, $product_size,$product_color,$tax_amount,$shipping_amount,$deal_amount,$shipping_methods);
										
										if($transaction){
										    $status = $this->do_product_transaction($captured , $deal_id[$i], $deal_qty[$i],$transaction,$userid);
											
										}
										$deal_id1=$deal_id[$i];
										$deal_qty1= $deal_qty[$i];
								
							}
                                                                 
							$status = $this->do_product_transaction1($captured, $deal_id1,$deal_qty1,$transaction,$userid,$lang);
							
							$R = $this->result;
							
							 if($lang == "ar"){
							$response = array("response" => array("Transaction_Time" => $R->TIMESTAMP,"Transaction_id" =>$R->TRANSACTIONID,"Transaction_Status" => $R->ACK,"Transaction_amount" => $pay_amount ,"Currency_code" => $R->CURRENCYCODE, "httpCode" => 200, "Message" => "تم اكتمال الصفقة دفع بنجاح",  "currency_symbol" => CURRENCY_SYMBOL, "delivery" =>$delivery_period));
							} else {   
							
							$response = array("response" => array("Transaction_Time" => $R->TIMESTAMP,"Transaction_id" =>$R->TRANSACTIONID,"Transaction_Status" => $R->ACK,"Transaction_amount" => $pay_amount ,"Currency_code" => $R->CURRENCYCODE, "httpCode" => 200, "Message" => "Payment transaction has been completed successfully", "currency_symbol" => CURRENCY_SYMBOL, "delivery" =>$delivery_period));
							}
							echo json_encode($response);
							exit;
									
						} else { 
								 if($this->result->L_LONGMESSAGE0){
								   $response = array("response" => array("httpCode" => 401 , "Message" => $this->result->L_LONGMESSAGE0 ));
									echo json_encode($response);
									exit;		
								   } else {
								          if($lang == "ar"){
									$response = array("response" => array("httpCode" => 401 , "Message" => "مشكلة في باي بال. حاول مرة أخرى في بعض الأحيان ..." ));    
									} else {
									$response = array("response" => array("httpCode" => 401 , "Message" => "Problem in paypal.Please Try again sometimes..." ));    
									}
									echo json_encode($response);
									exit;		
								   } 	
							}

                    } else {
                    if($lang == "ar"){
                    $response = array("response" => array("httpCode" => 401 , "Message" => "قادر على معالجة معاملتك حاول مرة أخرى!" ));
                    } else {
                     $response = array("response" => array("httpCode" => 401 , "Message" => "Unable to process your transaction try again!" ));
                    }
                    echo json_encode($response);
                    exit;
                    
                    }

                } else {
                    if($lang == "ar"){
                    $response = array("response" => array("httpCode" => 401 , "Message" => "اكتب أسلوب غير صالحة" ));
                    } else {
                    $response = array("response" => array("httpCode" => 401 , "Message" => "Invalid method type" ));
                    }
                    echo json_encode($response);
                    exit;
                    
                }
		} else {	

			$response = array("response" => array("httpCode" => 401 , "Message" => "Invalid method type" ));
			echo json_encode($response);
			exit;		
			
		}
	}
	
	/**  PRODUCT CASH ON DELIVERY   **/
	
	public function cash_delivery()
	{
		
	    if($_POST){
			
            $get_deal_id = substr($this->input->post("deal_id"),0,-1);
	   
            $deal_id = explode(",", $get_deal_id );
            $cart_count = count($deal_id);
            $get_deal_qty = substr($this->input->post("deal_qty"),0,-1);
            $deal_qty = explode(",", $get_deal_qty);
            $size_array = explode(",",substr($this->input->post("product_size"),0,-1));
            $color_array = explode(",",substr($this->input->post("product_color"),0,-1));
            $userid = $this->input->post("userid");
            $lang = $this->input->post("lang");
            $total_product_amount = $this->input->post("total_product_amount");
	    
                if((count($deal_id))==(count($deal_qty))) { 
                    $this->userPost = $this->input->post();
					$product_color="0";
					$paymentType = "COD";
					$captured = 0;
					$total_amount="0";
					$total_qty="0";
					$product_title="";
					$produ_qty="0";
					$total_shipping="0";
                    $referral_amount=0;
                    $product_size = "0"; 
                    $shipping_amount = "0";
                    $country_code = COUNTRY_CODE;
                    $currencyCode = CURRENCY_CODE;
                        for($i=0; $i<count($deal_id); $i++) {
                        
				/** Check the quatity available in particular size start */
				$product_size =$size_array[$i]; 
				
				$product_color=$color_array[$i];
				$deal_id_pro=$deal_id[$i];
				 $this->product_size_details = $this->api->product_size_details($deal_id_pro, $product_size);
				 
					$dbquantity=$this->product_size_details->current()->quantity;
					
					$this->deals_payment_deatils = $this->api->get_product_payment_details($deal_id[$i]);
					
					$product_title = $this->deals_payment_deatils->current()->deal_title;
					$product_title_arabic = $this->deals_payment_deatils->current()->deal_title;
					$purchase_count = $this->deals_payment_deatils->current()->purchase_count;
					$user_limit_quantity = $this->deals_payment_deatils->current()->user_limit_quantity;
					
					if($purchase_count >= $user_limit_quantity ){
						if($lang == "ar"){						
						$response = array("response" => array("httpCode" => 400 , "Message" => "المنتج المحدد ($product_title_arabic) وقد بيعت اختيار بعض المنتجات الأخرى" ));
						} else {
						$response = array("response" => array("httpCode" => 400 , "Message" => "Selected product ($product_title) was sold out choose some other product" ));
						}
						echo json_encode($response);
						exit;
						
					}
					
					if($dbquantity == 0 ) {
					        if($lang == "ar"){	
						$response = array("response" => array("httpCode" => 400 , "Message" => "بيعت حجم اختيارها من تحديد بعض حجم أخرى للمنتج,$product_title_arabic" ));
						} else {
						$response = array("response" => array("httpCode" => 400 , "Message" => "Selected size was sold out select some other size for product,$product_title" ));
						}
						echo json_encode($response);
						exit;
					}
					
					else if($dbquantity < $deal_qty[$i]){
					        if($lang == "ar"){
						$response = array("response" => array("httpCode" => 400 , "Message" => "كمية غير كافية لحجم المحدد والمنتج. الرجاء اختيار ضمن هذه الكمية $dbquantity للمنتج,$product_title_arabic" ));
						} else {
						$response = array("response" => array("httpCode" => 400 , "Message" => "Insufficient quantity for the selected size and product. Please select within this quantity $dbquantity for product,$product_title" ));
						}
						echo json_encode($response);
						exit;
					}
					
				/** End   **/
							
                            $this->deals_payment_deatils = $this->api->get_product_payment_details($deal_id[$i]);
                            
                            if(count($this->deals_payment_deatils) == 0){
                                        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "الصفحة لم يتم العثور حاول مرة أخرى!" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Page not found try again!" ));
					}
					echo json_encode($response);
					exit;
				}	
                                foreach($this->deals_payment_deatils as $UL){
                                    $purchase_qty = $UL->purchase_count;
				    $deal_title = $UL->deal_title;
				    $deal_key  = $UL->deal_key;
				    $url_title = $UL->url_title;
				    $deal_value = $UL->deal_value;
				    $merchant_id = $UL->merchant_id;
				    $delivery_period = $UL->delivery_period;
				    $product_shipping = $UL->shipping_amount;
                                    $product_amount = $UL->deal_value*$deal_qty[$i];
				    $shipping_methods = $UL->shipping;
                                }   
                                
                                if($shipping_methods  == 1){
									$shipping_amount = 0;
								}elseif($shipping_methods  == 2){
									//$total_flateshipping = FLAT_SHIPPING_AMOUNT;
									//$shipping_amount = number_format((float)($total_flateshipping/$cart_count), 2, '.', '');
									$merchant_flat_amount = $this->api->get_userflat_amount($merchant_id);
									$shipping_amount = $merchant_flat_amount->flat_amount;
								} elseif($shipping_methods  == 3){
									$shipping_amount =$product_shipping;
								} elseif($shipping_methods  == 4){
									$shipping_amount =$product_shipping*$deal_qty[$i];
								}		        
									
								$taxdeal_amount=($deal_value*$deal_qty[$i])+$shipping_amount;
								$tax_amount = ((TAX_PRECENTAGE_VALUE/100)*$taxdeal_amount);
								       
									$transaction = $this->api->insert_cash_delivery_transaction_details_product($deal_id[$i], $userid,$referral_amount, $deal_qty[$i], 5, $captured, $purchase_qty,$paymentType,$product_amount,$merchant_id,$product_size,$product_color,$tax_amount,$shipping_amount, $shipping_methods,arr::to_object($_POST),$country_code,$currencyCode);
								      	 
									if($transaction){
									$status = $this->do_product_transaction($captured,$deal_id[$i], $deal_qty[$i],$transaction,$userid);
											
										}
										
									$deal_id1=$deal_id[$i];
									$deal_qty1= $deal_qty[$i];
						}
						
						$status = $this->do_product_transaction1($captured, $deal_id1,$deal_qty1,$transaction,$userid,$lang);
				
				                          if($lang == "ar"){
							$response = array("response" => array("Transaction_Time" => date('d/m/Y h:i:s A', time()),"Transaction_id" =>$transaction,"Transaction_Status" => "نجاح","Transaction_amount" => $total_product_amount ,"Currency_code" => $currencyCode, "httpCode" => 200, "Message" => "تم اكتمال الصفقة دفع بنجاح",  "currency_symbol" => CURRENCY_SYMBOL, "delivery" =>$delivery_period));
							} else {
							$response = array("response" => array("Transaction_Time" => date('d/m/Y h:i:s A', time()),"Transaction_id" =>$transaction,"Transaction_Status" => "Success","Transaction_amount" => $total_product_amount ,"Currency_code" => $currencyCode, "httpCode" => 200, "Message" => "Payment transaction has been completed successfully", "currency_symbol" => CURRENCY_SYMBOL, "delivery" =>$delivery_period));
							}
							echo json_encode($response);	
							exit;
				}
				else {
		                        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "المشكلة في النقد عند التسليم المحاولة مرة أخرى" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Problem in Cash on delivery try again" ));
					}
					echo json_encode($response);
					exit;
					
				}
		}
		else {
		
			$response = array("response" => array("httpCode" => 401 , "Message" => "Problem in Cash on delivery try again" ));
			echo json_encode($response);
			exit;
			
		}
		
	}
	
	public function product_authorize()
	{
		
		if($_POST){ 
				$get_deal_id = substr($this->input->post("deal_id"),0,-1);
				$deal_id = explode(",", $get_deal_id );
				$cart_count = count($deal_id); 
				$get_deal_qty = substr($this->input->post("deal_qty"),0,-1);
				$deal_qty = explode(",", $get_deal_qty);
				$size_array = explode(",",substr($this->input->post("product_size"),0,-1));
				$color_array = explode(",",substr($this->input->post("product_color"),0,-1));
				$userid = $this->input->post("userid");
				$lang = $this->input->post("lang");
				$total_product_amount = $this->input->post("total_product_amount");
					if((count($deal_id))==(count($deal_qty))) {
						$this->userPost = $this->input->post();
						$product_color="0";
						$total_amount="0";
						$total_shipping="0";
						$referral_amount=0;
						$product_size = "0"; 
						$product_title="";
						$shipping_amount = "0";
					   
							for($i=0; $i<count($deal_id); $i++) {
								
								/** Check the quatity available in particular size start */
								$product_size =$size_array[$i]; 
								$product_color=$color_array[$i];
								 $this->product_size_details = $this->api->product_size_details($deal_id[$i], $product_size); 
									$dbquantity=$this->product_size_details->current()->quantity;
									
									$this->deals_payment_deatils = $this->api->get_product_payment_details($deal_id[$i]);
									$product_title = $this->deals_payment_deatils->current()->deal_title;
									$product_title_arabic = $this->deals_payment_deatils->current()->deal_title;
									$purchase_count = $this->deals_payment_deatils->current()->purchase_count;
									$user_limit_quantity = $this->deals_payment_deatils->current()->user_limit_quantity;
								
								if($purchase_count >= $user_limit_quantity ){
									if($lang == "ar"){								
									$response = array("response" => array("httpCode" => 400 , "Message" => "المنتج المحدد ($product_title_arabic) وقد بيعت اختيار بعض المنتجات الأخرى" ));
									} else {
									$response = array("response" => array("httpCode" => 400 , "Message" => "Selected product ($product_title) was sold out choose some other product" ));
									}
									echo json_encode($response);
									exit;
									
								}
								
								if($dbquantity == 0 ) {
								        if($lang == "ar"){
									$response = array("response" => array("httpCode" => 400 , "Message" => "بيعت حجم اختيارها من تحديد بعض حجم أخرى للمنتج,$product_title_arabic" ));
									} else {
									$response = array("response" => array("httpCode" => 400 , "Message" => "Selected size was sold out select some other size for product,$product_title" ));
									}
									echo json_encode($response);
									exit;
								}
								
								else if($dbquantity < $deal_qty[$i]){
								        if($lang == "ar"){
									$response = array("response" => array("httpCode" => 400 , "Message" => "كمية غير كافية لحجم المحدد والمنتج. الرجاء اختيار ضمن هذه الكمية $dbquantity للمنتج,$product_title_arabic" ));
									} else {
									$response = array("response" => array("httpCode" => 400 , "Message" => "Insufficient quantity for the selected size and product. Please select within this quantity $dbquantity for product,$product_title" ));
									}
									echo json_encode($response);
									exit;
								}
									
								/** End   **/
								
								$this->deals_payment_deatils = $this->api->get_product_payment_details($deal_id[$i]);
								if(count($this->deals_payment_deatils) == 0){
								        if($lang == "ar"){
									$response = array("response" => array("httpCode" => 401 , "Message" => "الصفحة لم يتم العثور حاول مرة أخرى!" ));
									} else {
									$response = array("response" => array("httpCode" => 401 , "Message" => "Page not found try again!" ));
									}
									echo json_encode($response);
									exit;
								}
									foreach($this->deals_payment_deatils as $UL){
										$purchase_qty = $UL->purchase_count;
										$deal_title = $UL->deal_title;
										$deal_key  = $UL->deal_key;
										$url_title = $UL->url_title;
										$deal_value = $UL->deal_value;
										$merchant_id = $UL->merchant_id;
										$delivery_period = $UL->delivery_period;
										$shipping_amount = $UL->shipping_amount;
										$shipping_methods = $UL->shipping;
										$product_amount = $UL->deal_value*$deal_qty[$i];
									}   
									
									 if($shipping_methods == 1){
										$total_shipping += 0;
									}  elseif($shipping_methods  == 2){
								 $merchant_flat_amount = $this->api->get_userflat_amount($merchant_id);
										$total_shipping += $merchant_flat_amount->flat_amount;
									} elseif($shipping_methods  == 3){
										$total_shipping +=$shipping_amount;
									} elseif($shipping_methods  == 4){
										$total_shipping +=$shipping_amount*$deal_qty[$i];
									}
									$total_amount +=$product_amount;	
									
									
									$product_title .=$deal_title.",";
									 
						 }		
									
						$total_tax = (TAX_PRECENTAGE_VALUE/100)*($total_amount+$total_shipping);
						$pay_amount = $total_amount+$total_shipping+$total_tax;
						
						
						
						if($total_product_amount==$pay_amount){
							$post = arr::to_object($this->input->post());
							
							$email = $this->api->getuser_email($userid);
							if(CURRENCY_CODE !="USD"){  // for Currency conversion
		                                        $pay_amount = common::currency_conversion(CURRENCY_CODE,"USD",$pay_amount);
		                                        $total_tax = common::currency_conversion(CURRENCY_CODE,"USD",$total_tax);
		                                        $currencyCode = "USD";
							}
							// authorize
							$sale = new AuthorizeNetAIM;                
							$sale->cust_id = $userid;
							$paymentType = "Sale";
							$captured = 0;
							
							$shipping_info                     = (object) array();
							$shipping_info->ship_to_first_name = urlencode($post->shipping_name); 
							//$shipping_info->ship_to_last_name  = urlencode($post->shipping_name);
							$shipping_info->ship_to_address    = urlencode($post->shipping_address1." , ".$post->shipping_address2); 
							$shipping_info->ship_to_state      = urlencode($post->shipping_state);
							$shipping_info->ship_to_zip        = urlencode($post->shipping_postal_code); 
							$shipping_info->ship_to_country    = urlencode($post->shipping_country);                 
							
							$customer                          = (object) array();
							$customer->first_name              = urlencode($post->firstName);
							$customer->last_name               = urlencode($post->firstName);
							$customer->address                 = urlencode($post->address1);
							$customer->city                    = urlencode($post->city);
							$customer->state                   = urlencode($post->state);
							$customer->zip                     = urlencode($post->zip);
							$customer->email                   = $email;
							//$customer->country                 = urlencode($post->country);
							$customer->phone                   = urlencode($post->shipping_phone); 
							 
							$sale->amount                      = urlencode($pay_amount);
							$sale->tax                         = urlencode($total_tax);
							$sale->card_num                    = urlencode($post->creditCardNumber);
							$sale->card_code                   = urlencode($post->cvv2Number);
							$sale->exp_date                    = urlencode($post->expDateMonth)."/".urlencode($post->expDateYear);
							$sale->invoice_num                 = substr(time(), 0, 6);
							$sale->description                 = $product_title;
							$sale->setFields($shipping_info);
							$sale->setFields($customer);
							$response[] = $sale->authorizeOnly();
							$friend_gift =$post->friend_gift;
							$friendName =$post->friend_name;
							$friendEmail =$post->friend_email;
							$country_code = COUNTRY_CODE;
							$currencyCode = CURRENCY_CODE;
							$product_size="";
							$product_color="";
							$pay_amount = $pay_amount;
							$response = $response['0'];
								if ($response->approved) {
									$transaction_id = $response->transaction_id;
									$responseheader = array('Order_Status'=>$response->response_reason_text,'Invoice_Number'=>$response->invoice_number,'Authorization_Code'=>$response->authorization_code,'Credit_card'=>$response->card_type,'Billing_Address'=>$response->address);                 
										
										$product_color="0";
										$product_size = "0"; 
									
										for($i=0; $i<count($deal_id); $i++) {
											
											/** Check the quatity available in particular size start */
											$product_size =$size_array[$i]; 
											$product_color=$color_array[$i];
											
											$this->deals_payment_deatils = $this->api->get_product_payment_details($deal_id[$i]);	
												foreach($this->deals_payment_deatils as $UL){
													$purchase_qty = $UL->purchase_count;
													$deal_value = $UL->deal_value;
													$merchant_id = $UL->merchant_id;
													$product_shipping = $UL->shipping_amount;
													$shipping_methods = $UL->shipping;
													$product_amount = $UL->deal_value*$deal_qty[$i];
												}   
												
												if($shipping_methods == 1){
													$shipping_amount = 0;
												}elseif($shipping_methods  == 2){
								    $merchant_flat_amount = $this->api->get_userflat_amount($merchant_id);
													$shipping_amount = $merchant_flat_amount->flat_amount;
												} elseif($shipping_methods  == 3){
													$shipping_amount =$product_shipping;
												} elseif($shipping_methods  == 4){
													$shipping_amount =$product_shipping*$deal_qty[$i];
												}		
												
												$product_amount_display = $product_amount + $shipping_amount;     
												$taxdeal_amount=($deal_value*$deal_qty[$i])+$shipping_amount;
												$tax_amount = ((TAX_PRECENTAGE_VALUE/100)*$taxdeal_amount);
												  $deal_amount=$deal_value*$deal_qty[$i];
												  
													$transaction = $this->api->insert_product_transaction_details_authorize($responseheader, $deal_amount,$deal_id[$i], $transaction_id,$country_code, $currencyCode,$post->firstName, $post->firstName, $referral_amount, $deal_qty[$i], 1, $captured, $purchase_qty, $friend_gift, $friendName, $friendEmail,$merchant_id,arr::to_object($this->userPost), $product_size,$product_color,$tax_amount,$shipping_amount,$userid, $shipping_methods);
													
													if($transaction){
										    $status = $this->do_product_transaction($captured , $deal_id[$i], $deal_qty[$i],$transaction,$userid);
											
										}
										$deal_id1=$deal_id[$i];
										$deal_qty1= $deal_qty[$i];			
										}
										$status = $this->do_product_transaction1($captured, $deal_id1,$deal_qty1,$transaction,$userid,$lang);
										/*$capture = new AuthorizeNetAIM;
										$capture->amount = $pay_amount;
										$capture->trans_id = $transaction_id;
										
										//$response[] = new PriorAuthCapture();
										$response[] = $capture->priorAuthCapture();
										print_r($response); exit;
										if ($response->approved) { 
										$now_transaction_id=$response->transaction_id;
											$now_authorization_code=$response->authorization_code;
											$status = $this->api->authorize_update_captured_transaction($now_transaction_id,$now_authorization_code, $transaction);
										
										*/ 
										if ($transaction_id) { 
											$now_transaction_id=$transaction_id;
											$now_authorization_code=$transaction_id;
											$status = $this->api->authorize_update_captured_transaction($now_transaction_id,$now_authorization_code, $transaction);
											if($lang == "ar"){
											$response = array("response" => array("Transaction_Time" => date('d/m/Y h:i:s A', time()),"Transaction_Status" => "نجاح","Transaction_id" =>$transaction_id,"Transaction_amount" => $product_amount_display ,"Currency_code" => $currencyCode, "httpCode" => 200, "Message" => "تم اكتمال الصفقة دفع بنجاح",  "currency_symbol" => CURRENCY_SYMBOL, "delivery" =>$delivery_period));
											
											} else {
											$response = array("response" => array("Transaction_Time" => date('d/m/Y h:i:s A', time()),"Transaction_Status" => "Success","Transaction_id" =>$transaction_id,"Transaction_amount" => $product_amount_display ,"Currency_code" => $currencyCode, "httpCode" => 200, "Message" => "Payment transaction has been completed successfully", "currency_symbol" => CURRENCY_SYMBOL, "delivery" =>$delivery_period));
											}
													echo json_encode($response);
													exit;
										} else {
											$status = $this->api->authorize_update_captured_transaction_failed($transaction);	
											if($lang == "ar"){
											$response = array("response" => array("httpCode" => 401 , "Message" => "مشكلة في Authorize.net المحاولة مرة أخرى" ));
											} else {
											$response = array("response" => array("httpCode" => 401 , "Message" => "Problem in Authorize.net try again" ));
											}
												echo json_encode($response);
												exit;			
										}	 				
										
												
								}else {
								        if($lang == "ar"){
									$response = array("response" => array("httpCode" => 401,'Message'=>$response->response_reason_text,'Authorization Code'=>'لا المصرح','Credit card'=>$response->card_type,'Billing Address'=>$response->address));
									} else {
									$response = array("response" => array("httpCode" => 401,'Message'=>$response->response_reason_text,'Authorization Code'=>'Not Authorized','Credit card'=>$response->card_type,'Billing Address'=>$response->address));
									}
									echo json_encode($response);
									exit;
							
								}        

						} else {
						if($lang == "ar"){
						$response = array("response" => array("httpCode" => 401 , "Message" => "قادر على معالجة معاملتك حاول مرة أخرى!" ));
						} else {
						$response = array("response" => array("httpCode" => 401 , "Message" => "Unable to process your transaction try again!" ));
						}
						echo json_encode($response);
						exit;
						
						}

					} else {
					        if($lang == "ar"){
						$response = array("response" => array("httpCode" => 401 , "Message" => "اكتب أسلوب غير صالحة" ));
						} else {
						$response = array("response" => array("httpCode" => 401 , "Message" => "Invalid method type" ));
						}
						echo json_encode($response);
						exit;
						
					}
		} else {	

			$response = array("response" => array("httpCode" => 401 , "Message" => "Invalid method type" ));
			echo json_encode($response);
			exit;		
			
		}
	}
		
	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SEND MAIL **/

	public function do_product_transaction($captured = "", $deal_id = "", $qty = "",$transaction = "",$userid = "")
	{
		$from = CONTACT_EMAIL;
		$this->products_list = $this->api->get_products_coupons_list($transaction,$deal_id,$userid);
		
		$this->product_size = $this->api->get_shipping_product_size();
		$this->product_color = $this->api->get_shipping_product_color(); 
                $this->merchant_id = $this->products_list->current()->merchant_id;
                $this->get_merchant_details = $this->api->get_merchant_details($this->merchant_id);   
                $this->merchant_firstneme = $this->get_merchant_details->current()->firstname;
                $this->merchant_lastname = $this->get_merchant_details->current()->lastname; 
                $this->merchant_email = $this->get_merchant_details->current()->email; 
                
                $message_merchant = new View("themes/".THEME_NAME."/payment_mail_product_merchant");
               
		if(EMAIL_TYPE==2) {
				email::smtp($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
		}else{
		                email::sendgrid($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
		}   
		$user_details = $this->api->get_purchased_user_details($userid);
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->api->update_referral_amount($U->referred_user_id);
			}
			$deals_details = $this->api->get_product_details_share($deal_id);
			if($U->facebook_update == 1){				
				foreach($deals_details as $D){
					$dealURL = PATH."product/".$D->deal_key.'/'.$D->url_title.".html";
					$message = "I have purchased the product...".$D->deal_title." ".$dealURL." limited offer hurry up!";
					$post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");
					common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg);
				}
			}  
			
			/** Send Purchase details to user Email **/
		/**	foreach($deals_details as $D){
			    $deal_title = $D->deal_title;
			    $deal_amount = $D->deal_value;
			}
                $from = CONTACT_EMAIL;
                $this->transaction_mail = array("deal_title" => ucfirst($deal_title), "item_qty" => $qty ,"total" => ($deal_amount * $qty) ,"amount"=> ($deal_amount * $qty),"value" =>$deal_amount);
                $this->result_mail = arr::to_object($this->transaction_mail);
                // Mail template 
                $message = new View("themes/".THEME_NAME."/payment_mail_product");
                email::sendgrid($from,$U->email, "Thanks for buying from ". SITENAME ,$message);  **/
		}
		return;
	}
	
	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SEND MAIL **/

	public function do_product_transaction1($captured = "", $deal_id = "", $qty = "",$transaction = "",$userid = "", $lang ="")
	{
	        $this->language = ($lang == "ar")?"arabic":"english";
                                include Kohana::find_file('vendor/language/frontend_language',$this->language);
                                $this->Lang = $content_text;
                                
                                if($lang == "ar"){
			    $subject = "شكرا لشراء من ". SITENAME;			
			    } else {
			    $subject = "Thanks for buying from  ". SITENAME;	
			    }
			    
			    
			    if($lang == "ar"){
			    $fri_subject = "كنت حصلت على قسيمة هدية من صديقك ";			
			    } else {
			    $fri_subject = "You Got Product Gift from your Friend ";	
			    }
                                
		$user_details = $this->api->get_purchased_user_details($userid);
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->api->update_referral_amount($U->referred_user_id);
			}
			$deals_details = $this->api->get_product_details_share($deal_id);
			if($U->facebook_update == 1){				
				foreach($deals_details as $D){
					$dealURL = PATH."product/".$D->deal_key.'/'.$D->url_title.".html";
					$message = "I have purchased the deal...".$D->deal_title." ".$dealURL." limited offer hurry up!";
					$post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");
					common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg);
				}
			}
			         
			/** Send Purchase details to user Email **/
			foreach($deals_details as $D){
			    $deal_title = $D->deal_title;
			    $deal_amount = $D->deal_value;
			}
			
			$friend_details = $this->api->get_friend_transaction_details_product($deal_id, $transaction);
           $friend_email = $friend_details->current()->friend_email;
           $friend_name = $friend_details->current()->friend_name;
           $username = $U->firstname;
	if($friend_email != "xxxyyy@zzz.com"){
				
                $from = CONTACT_EMAIL;
                $this->transaction_mail =array("deal_title" => ucfirst($deal_title), "item_qty" => $qty ,"total" => ($deal_amount * $qty) ,"amount"=> ($deal_amount * $qty),"ref_amount"=> "0","value" =>$deal_amount,"friend_name" => $friend_name,"user_name" =>$username,"value" =>$deal_amount);
                $this->result_mail = arr::to_object($this->transaction_mail); 
                
                $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail");  
                
				if(EMAIL_TYPE==2) {        
					email::smtp($from, $friend_email, $fri_subject ,$friend_message); 
				}else {
					email::sendgrid($from, $friend_email, $fri_subject,$friend_message); 

				}        
            
            } else {
                $from = CONTACT_EMAIL;
				$this->products_list = $this->api->get_products_coupons_list($transaction,$deal_id,$userid);
				
				$this->product_size = $this->api->get_shipping_product_size();
				$this->product_color = $this->api->get_shipping_product_color();
                // $this->transaction_mail = array("deal_title" => $deal_title, "item_qty" => $qty ,"total" => ($deal_amount * $qty) ,"amount"=> ($deal_amount * $qty),"value" =>$deal_amount);
                // $this->result_mail = arr::to_object($this->transaction_mail);
                /* Mail template */
               
                $message = new View("themes/".THEME_NAME."/payment_mail_product");
                
				if(EMAIL_TYPE==2) {   	
						email::smtp($from,$U->email, $subject ,$message);  
				}else{
				 email::sendgrid($from,$U->email, $subject ,$message);  
				}          
            }  
			
		}
		return;
	}
    /** DoDirectPayment - Credit Card  **/

	public function dodirectpayment()
	{
		
		if($_POST){ 
		    $userid = $this->input->post("userid");
			$deal_id = $this->input->post("deal_id");
			$deal_key = $this->input->post("deal_key");
			$referral_amount = $this->input->post("referral_amount");
			$item_qty = $this->input->post("QTY");
			$lang = $this->input->post("lang");
			$this->deals_payment_deatils = $this->api->get_deals_payment_details($deal_id, $deal_key);
                          
			if(count($this->deals_payment_deatils) == 0){	
			     if($lang == "ar"){		
			    $response = array("response" => array("httpCode" => 401 , "Message" => "الصفحة غير موجودة!" ));
			    } else {
			    $response = array("response" => array("httpCode" => 401 , "Message" => "Page not found !" ));
			    }
				echo json_encode($response);
				exit;
			}  
			$this->referral_balance_deatils = $this->api->get_user_referral_balance_details($userid);
			$this->get_user_limit_details = $this->api->get_user_limit_details($deal_id,$userid);
			$this->get_user_limit_count = $this->api->get_user_limit_details($deal_id,$userid);
			$this->user_referral_balance = $this->api->get_user_referral_balance_details($userid);
			  
			foreach($this->deals_payment_deatils as $UL){
				$purchase_qty = $UL->purchase_count;
				$max_user_limit = $UL->user_limit_quantity;
				$min_deals_limit = $UL->minimum_deals_limit;
				$maximum_deals_limit = $UL->maximum_deals_limit;
				$merchant_id = $UL->merchant_id;
			}
			
			if($referral_amount > $this->referral_balance_deatils ){
			      if($lang == "ar"){	
			    $response = array("response" => array("httpCode" => 401 , "Message" => "مبلغ الإحالة غير صالحة" ));
			    } else {
			    $response = array("response" => array("httpCode" => 401 , "Message" => "Invalid referral amount" ));
			    }
				echo json_encode($response);
				exit;
			}

			if(($this->get_user_limit_details + $item_qty) > $max_user_limit){		
			 if($lang == "ar"){		
			    $response = array("response" => array("httpCode" => 401 , "Message" => "الحد الأقصى شراء صلت" ));
			    } else {
			    $response = array("response" => array("httpCode" => 401 , "Message" => "Maximum purchase limit reached" ));
			    }
				echo json_encode($response);
				exit;				
			}
			
			/*if($purchase_qty < $maximum_deals_limit){
				$response[] = array("response" => array("httpCode" => 401 , "Message" => "Maximum purchase limit reached" ));
				echo json_encode($response);
				exit;	
			} */
			 
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
			                ->add_rules('firstName','required')
			                ->add_rules('address1','required')
			                ->add_rules('creditCardNumber','required')
			                ->add_rules('city','required')
			                ->add_rules('state','required')
			                ->add_rules('zip','required')
			                ->add_rules('cvv2Number','required')
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
					        
					$this->api = new Api_Model;
					
					$transaction = $this->api->insert_transaction_details($this->result, $deal_id, $country_code, $firstName, $lastName, $referral_amount, $item_qty, 1, $captured, $purchase_qty, $friend_gift, $friendName, $friendEmail,$merchant_id,$userid,$amount1);    
					$status = $this->do_captured_transaction($captured, $deal_id, $item_qty, $userid,$lang);
					$mail_status = $this->payment_mail_function($captured, $deal_id, $transaction,$lang);
					
					$R = $this->result;
					 if($lang == "ar"){
					$response = array("response" => array("Transaction_Time" => $R->TIMESTAMP,"Transaction_id" =>$R->TRANSACTIONID,"Transaction_Status" => "نجاح","Transaction_amount" => $amount1 ,"Currency_code" => $R->CURRENCYCODE, "httpCode" => 200, "Message" => "تم اكتمال الصفقة دفع بنجاح", 'currency_symbol' => CURRENCY_SYMBOL));
					} else {
					$response = array("response" => array("Transaction_Time" => $R->TIMESTAMP,"Transaction_id" =>$R->TRANSACTIONID,"Transaction_Status" => $R->ACK,"Transaction_amount" => $amount1 ,"Currency_code" => $R->CURRENCYCODE, "httpCode" => 200, "Message" => "Payment transaction has been completed successfully", 'currency_symbol' => CURRENCY_SYMBOL));
					}
				    echo json_encode($response);	
				    exit;				    
				}
				else{
					
				   if($this->result->L_LONGMESSAGE0){
				             if($lang == "ar"){	
					   $response = array("response" => array("httpCode" => 401 , "Message" => "مشكلة في باي بال ".$this->result->L_LONGMESSAGE0 ));
					   } else {
					   $response = array("response" => array("httpCode" => 401 , "Message" => "Problem in paypal ".$this->result->L_LONGMESSAGE0 ));
					   }
						echo json_encode($response);
						exit;		
				   } else {
				         if($lang == "ar"){	
					$response = array("response" => array("httpCode" => 401 , "Message" => "مشكلة في باي بال. حاول مرة أخرى في بعض الأحيان ..." ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Problem in paypal.Please Try again sometimes..." ));
					}
				    echo json_encode($response);
				    exit;		
				   } 		
				   
				    
				}
			}
			else{
			         if($lang == "ar"){	
				$response = array("response" => array("httpCode" => 400 , "Message" => "البيانات المطلوبة في عداد المفقودين" ));
				} else {
				$response = array("response" => array("httpCode" => 400 , "Message" => "Required data missing" ));
				}
				echo json_encode($response);
				exit;
			}
		}
		else{	
			$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		    echo json_encode($response);
		    exit;		
		}
	}
	
	public function authorize_dodirectpayment()
	{
		
	        if($_POST){  
	        $userid = $this->input->post("userid");
			$deal_id = $this->input->post("deal_id");
			$deal_key = $this->input->post("deal_key");
			$referral_amount = $this->input->post("referral_amount");
			$item_qty = $this->input->post("QTY");
			$lang = $this->input->post("lang");
			$this->deals_payment_deatils = $this->api->get_deals_payment_details($deal_id, $deal_key);
			  
			if(count($this->deals_payment_deatils) == 0){
			     if($lang == "ar"){			
			    $response = array("response" => array("httpCode" => 401 , "Message" => "الصفحة غير موجودة!" ));
			    } else {
			    $response = array("response" => array("httpCode" => 401 , "Message" => "Page not found !" ));
			    }
				echo json_encode($response);
				exit;
			}
			 
			$this->referral_balance_deatils = $this->api->get_user_referral_balance_details($userid);
			$this->get_user_limit_details = $this->api->get_user_limit_details($deal_id,$userid);
			$this->get_user_limit_count = $this->api->get_user_limit_details($deal_id,$userid);
			$this->user_referral_balance = $this->api->get_user_referral_balance_details($userid);
			
			foreach($this->deals_payment_deatils as $UL){
				$purchase_qty = $UL->purchase_count;
				$deal_title = $UL->deal_title;
				$max_user_limit = $UL->user_limit_quantity;
				$min_deals_limit = $UL->minimum_deals_limit;
				$merchant_id = $UL->merchant_id;
			}
			if($referral_amount > $this->referral_balance_deatils ){
			  if($lang == "ar"){
			    $response = array("response" => array("httpCode" => 401 , "Message" => "مبلغ الإحالة غير صالحة" ));
			    } else {
			    $response = array("response" => array("httpCode" => 401 , "Message" => "Invalid referral amount" ));
			    }
				echo json_encode($response);
				exit;
			}
			
			if(($this->get_user_limit_details + $item_qty) > $max_user_limit){	
			  if($lang == "ar"){		
			    $response = array("response" => array("httpCode" => 401 , "Message" => "الحد الأقصى شراء صلت" ));
			    } else {
			    $response = array("response" => array("httpCode" => 401 , "Message" => "Maximum purchase limit reached" ));
			    }
				echo json_encode($response);
				exit;
			}
			
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
				            ->add_rules('firstName','required','chars[a-zA-Z_ -.,%\']')
				            ->add_rules('address1','required')
				            ->add_rules('creditCardNumber','required')
				            ->add_rules('city','required')
				            ->add_rules('state','required')
				            //->add_rules('country','required')
				            ->add_rules('zip','required')
				            ->add_rules('cvv2Number','required')
				           // ->add_rules('deal_value','required')
				            ->add_rules('amount','required')
				            ->add_rules('friend_name','required')
				            ->add_rules('friend_email','required');
			if($post->validate()){
				$post = arr::to_object($this->input->post());
				
				$pay_amount = $post->amount;
		             if(CURRENCY_CODE !="USD"){ // for Currency conversion
						$pay_amount = common::currency_conversion(CURRENCY_CODE,"USD",$pay_amount);
						//$tax_amount = common::currency_conversion(CURRENCY_CODE,"USD",$tax_amount);
						$currencyCode = "USD";
					}
					
                $sale = new AuthorizeNetAIM;
                // authorize
                $sale->cust_id = $userid;
                if($pay_amount != 0) 
                {                
                    if(($purchase_qty + $item_qty) >= $min_deals_limit){
			            $captured = 0;
		            }else{
			            $captured = 1;
		            }		
		            $email = $this->api->getuser_email($userid);
		            		                         
                    $sale->amount = urlencode($pay_amount);
                    $sale->card_num = urlencode($post->creditCardNumber);
                    $sale->card_code = urlencode($post->cvv2Number);
                    $sale->exp_date = urlencode($post->expDateMonth)."/".urlencode($post->expDateYear);
                    $sale->first_name = urlencode($post->firstName);
                    $sale->last_name = urlencode($post->firstName);
                    $sale->address = urlencode($post->address1);
                    $sale->city = urlencode($post->city);
                    $sale->state = urlencode($post->state);
                    $sale->zip = urlencode($post->zip);         
                    //$sale->phone = urlencode($post->phone);              
                    //$sale->country = urlencode($post->country);
                    $sale->email = $email;
                    $sale->invoice_num = substr(time(), 0, 6);
                    $sale->description = $deal_title;
                    $response[] = $sale->authorizeOnly(); 
                    $friend_gift =$post->friend_gift;
				    $friendName =$post->friend_name;
				    $friendEmail =$post->friend_email;
				    $country_code = COUNTRY_CODE;
				    $currencyCode = CURRENCY_CODE;
				    $pay_amount1 = $post->amount;
				    //print_r($response['0']->approved); exit;
				    $response = $response['0'];
				    if ($response->approved ) {
                        $transaction_id = $response->transaction_id;
                        $responseheader = array('Order_Status'=>$response->response_reason_text,'Invoice_Number'=>$response->invoice_number,'Authorization_Code'=>$response->authorization_code,'Credit_card'=>$response->card_type,'Billing_Address'=>$response->address);  
                           
                        $this->api = new Api_Model;
                                                 
                        $transaction = $this->api->authorize_insert_transaction_details($responseheader, $pay_amount1,$deal_id, $transaction_id,$country_code, $currencyCode,$post->firstName, $post->firstName, $referral_amount, $item_qty, 1, $captured, $purchase_qty, $friend_gift, $friendName, $friendEmail,$merchant_id,$userid);
                         
                        $status = $this->authorize_do_captured_transaction($captured, $deal_id, $item_qty,$userid,$lang);
                        
                        $mail_status = $this->payment_mail_function($captured, $deal_id, $transaction,$lang);      
                        
                        // for respnose                      
                                                  if($lang == "ar"){
						$response = array("response" => array("Transaction_Time" => date('d/m/Y h:i:s A', time()),"Transaction_Status" => "نجاح","Transaction_amount" => $pay_amount1 ,"Transaction_id" =>$transaction_id,"Currency_code" => $currencyCode, "httpCode" => 200, "Message" => "تم اكتمال الصفقة دفع بنجاح", 'currency_symbol' => CURRENCY_SYMBOL));
						} else {
						$response = array("response" => array("Transaction_Time" => date('d/m/Y h:i:s A', time()),"Transaction_Status" => "Success","Transaction_amount" => $pay_amount1 ,"Transaction_id" =>$transaction_id,"Currency_code" => $currencyCode, "httpCode" => 200, "Message" => "Payment transaction has been completed successfully", 'currency_symbol' => CURRENCY_SYMBOL));
						}
						echo json_encode($response);	
						exit;
										   
                    } else {
                        $responseheader = array('Error'=>$response->response_reason_text,'Error code'=>$response->response_reason_code,'Authorization Code'=>'Not Authorized','Credit card'=>$response->card_type,'Billing Address'=>$response->address);
						$response = array("response" => array("httpCode" => 401 , "Message" => $response->response_reason_text ));
						echo json_encode($response);
						exit;
                    }
                }				
			}
			else{
			          if($lang == "ar"){
				$response = array("response" => array("httpCode" => 400 , "Message" => "البيانات المطلوبة في عداد المفقودين" ));
				} else {
				$response = array("response" => array("httpCode" => 400 , "Message" => "Required data missing" ));
				}
				echo json_encode($response);
				exit;
			}
		}
		else{	
			$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		    echo json_encode($response);
		    exit;	
		}
	}
	
	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SENT MAIL **/

	private function do_captured_transaction($captured = "", $deal_id = "", $qty = "", $userid = "",$lang = "")
	{
		$this->api = new Api_Model;
		
		if($captured == 0){
			$captured_list = $this->api->payment_authorization_list($deal_id);
			foreach($captured_list as $C){
				$nvpStr = "&AUTHORIZATIONID=".$C->transaction_id."&AMT=".$C->amount."&COMPLETETYPE=Complete";
				
				$result = arr::to_object($this->hash_call("DoCapture", $nvpStr));
				if($result->ACK = "Success" ){
					
				        $status = $this->api->update_captured_transaction($result, $C->id);
				}
			} 
			
			$captured_mail_list = $this->api->payment_authorization_mail_list($deal_id);
			foreach($captured_mail_list as $mail){			
			    $friend_details = $this->api->get_friend_transaction_details($deal_id, $mail->id);			        
                $friend_email = $friend_details->current()->friend_email;
                $friend_name = $friend_details->current()->friend_name; 
                
                        
			    $this->result_mail = arr::to_object(array("deal_title" => ucfirst($mail->deal_title), "item_qty" => $mail->quantity ,"total" => $mail->amount + $mail->referral_amount,"ref_amount"=> $mail->referral_amount, "amount"=> $mail->amount ,"friend_name" => $friend_name,"user_name" => $mail->firstname,"value" =>$mail->deal_value));
			  
				$transaction_coupon_details = $this->api->get_all_deal_captured_coupon($deal_id, $mail->user_id, $mail->order_date);
				$coupon_array = array();
				$coupon_code = "";
				foreach($transaction_coupon_details as $coupon_details){
					$coupon_array[] = $coupon_details->coupon_code;	
					$coupon_code .=  $coupon_details->coupon_code."<br>";
				}				
				pdf::pdf_created($coupon_array);
				$file=array();
				for($i=0; $i < count($coupon_array); $i++){
					array_push($file, "images/pdf/Voucher".$i.".pdf");
				}	
				$this->language = ($lang == "ar")?"arabic":"english";
                                include Kohana::find_file('vendor/language/frontend_language',$this->language);
                                $this->Lang = $content_text;
				
				if($lang == "ar"){
			            $subject = "شكرا لشراء القسيمة من ". SITENAME;			
			            } else {
			            $subject = "Thanks for buying from coupon ". SITENAME;	
			       }
			    
			    if($lang == "ar"){
			            $fri_subject = "كنت حصلت على قسيمة هدية من صديقك ";			
			            } else {
			            $fri_subject = "You Got Coupon Gift from your Friend ";	
			    }
			    if($friend_email != "xxxyyy@zzz.com"){
			    
                                        $store_detail = $this->api->get_payment_store_detail($deal_id);
                                        $store_name = $store_detail->current()->store_name;
                                        $store_address = $store_detail->current()->address1." ,".$store_detail->current()->address2;
                                        $phone_number = $store_detail->current()->phone_number;
                                        $zipcode = $store_detail->current()->zipcode;
                                        $website = $store_detail->current()->website;
                                        $city_name = $store_detail->current()->city_name;

                                        $this->result_mail = arr::to_object(array("deal_title" => ucfirst($mail->deal_title),"url_title"=>$mail->url_title,"deal_key" => $mail->deal_key,"item_qty" => $mail->quantity ,"total" => $mail->amount + $mail->referral_amount,"ref_amount"=> $mail->referral_amount, "amount"=> $mail->amount ,"user_name" => $mail->firstname,"friend_name" => $friend_name,"value" =>$mail->deal_value,"expirydate"=>$mail->expirydate,"couponcode"=>$coupon_code,"purchase_count"=>$mail->purchase_count,"minimum_deals_limit"=>$mail->minimum_deals_limit,"store_name" => ucfirst($store_name),"store_address" =>$store_address,"zipcode" =>$zipcode,"phone_number" => $phone_number,"website" => $website,"city_name" =>$city_name)); 
                                        $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mobile_mail");
                                        
			    } else {
					$this->coupon_active = 1;// for check the coupon is active
			            $message = new View("themes/".THEME_NAME."/payment_mail");
			    }			    
				
				$from  = NOREPLY_EMAIL;
				if($friend_email != "xxxyyy@zzz.com"){
					if(EMAIL_TYPE==2){
						 email::smtp($from,$friend_email, $fri_subject, $friend_message, $file);
						
					} else {
							email::sendgrid_attach($friend_email, $friend_message,$friend_message,$file);
					}
				} else {
					if(EMAIL_TYPE==2){				        
							email::smtp($from,$mail->email, $subject, $message,$file);
					}else {
							email::sendgrid_attach($mail->email, $subject, $message, $file);
					}
				}
				$transaction_coupon_update = $this->api->update_transaction_coupon_status1($deal_id,$mail->user_id,$mail->order_date);
				for($i=0; $i < count($coupon_array); $i++){
					unlink("images/pdf/Voucher".$i.".pdf");
				}
				//print_r($transaction_coupon_update); exit;
			}			
		}
		
                $user_details = $this->api->get_purchased_user_details($userid);
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->api->update_referral_amount($U->referred_user_id);
			}
			if($U->facebook_update == 1){
				$deals_details = $this->api->get_deals_details($deal_id);
				foreach($deals_details as $D){
					$dealURL = PATH."deals/".$D->deal_key.'/'.$D->url_title.".html";
					$message = "I have purchased the deal...".$D->deal_title." ".$dealURL." limited offer hurry up!";
					$post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");
					common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg );
				}
			}
		}
		return;
	}
	
	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SENT MAIL(WITH COUPON ATTACHMENT) **/

	private function authorize_do_captured_transaction($captured = "", $deal_id = "", $qty = "",$userid = "", $lang = "")
	{
		$this->api = new Api_Model;
		$this->language = ($lang == "ar")?"arabic":"english";
                include Kohana::find_file('vendor/language/frontend_language',$this->language);
                $this->Lang = $content_text;
		if($captured == 0){
			$captured_list = $this->api->payment_authorization_list($deal_id);
			$capture = new AuthorizeNetAIM;
			foreach($captured_list as $C){
                                $capture->amount = $C->amount;
                                $capture->trans_id = $C->transaction_id;
                                $response[] = $capture->priorAuthCapture();	
                                $response = $response['0'];		
                                if ($response->approved) {
                                        $now_transaction_id=$response->transaction_id;
                                        $now_authorization_code=$response->authorization_code;
                                        $status = $this->api->authorize_update_captured_transaction($now_transaction_id,$now_authorization_code, $C->id);
                                } else {
                                        $status = $this->api->authorize_update_captured_transaction_failed($C->id);				
                                }
			}	
			
			$captured_mail_list = $this->api->payment_authorization_mail_list($deal_id);
			foreach($captured_mail_list as $mail){
			$friend_details = $this->api->get_friend_transaction_details($deal_id, $mail->id);			        
                        $friend_email = $friend_details->current()->friend_email;
                        $friend_name = $friend_details->current()->friend_name; 
                
			    if($lang == "ar"){
			    $subject = "شكرا لشراء القسيمة من ". SITENAME;			
			    } else {
			    $subject = "Thanks for buying from coupon ". SITENAME;	
			    }
			    
			    if($lang == "ar"){
			    $fri_subject = "كنت حصلت على قسيمة هدية من صديقك ";			
			    } else {
			    $fri_subject = "You Got Coupon Gift from your Friend ";	
			    }	
			    if($friend_email != "xxxyyy@zzz.com"){
						 $store_detail = $this->api->get_payment_store_detail($deal_id);
						 $store_name = $store_detail->current()->store_name;
						 $store_address = $store_detail->current()->address1." ,".$store_detail->current()->address2;
						 $phone_number = $store_detail->current()->phone_number;
						 $zipcode = $store_detail->current()->zipcode;
						 $website = $store_detail->current()->website;
						 $city_name = $store_detail->current()->city_name;
						 
						$this->result_mail = arr::to_object(array("deal_title" => ucfirst($mail->deal_title), "url_title"=>$mail->url_title,"deal_key" => $mail->deal_key,"item_qty" => $mail->quantity ,"total" => $mail->amount + $mail->referral_amount,"ref_amount"=> $mail->referral_amount, "amount"=> $mail->amount ,"user_name" => $mail->firstname,"friend_name" => $friend_name,"value" =>$mail->deal_value,"expirydate"=>$mail->expirydate,"couponcode"=>"","purchase_count"=>$mail->purchase_count,"minimum_deals_limit"=>$mail->minimum_deals_limit,"store_name" => ucfirst($store_name),"store_address" =>$store_address,"zipcode" =>$zipcode,"phone_number" => $phone_number,"website" => $website,"city_name" =>$city_name));
			            $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mobile_mail");
			    } else {
				    $this->result_mail = arr::to_object(array("deal_title" => ucfirst($mail->deal_title), "url_title"=>$mail->url_title,"deal_key" => $mail->deal_key,"item_qty" => $mail->quantity ,"total" => $mail->amount + $mail->referral_amount,"ref_amount"=> $mail->referral_amount, "amount"=> $mail->amount ,"user_name" => $mail->firstname,"friend_name" => $friend_name,"value" =>$mail->deal_value)); 
				    $this->coupon_active = 1;// for check the coupon is active
			            $message = new View("themes/".THEME_NAME."/payment_mail");
			    }  
				$transaction_coupon_details = $this->api->get_all_deal_captured_coupon($deal_id, $mail->user_id, $mail->order_date);
				$coupon_array = array();
				foreach($transaction_coupon_details as $coupon_details){
					$coupon_array[] = $coupon_details->coupon_code;	
				}				
				pdf::pdf_created($coupon_array);
				$file=array();
				for($i=0; $i < count($coupon_array); $i++){
					array_push($file, "images/pdf/Voucher".$i.".pdf");
				}
				$from  = NOREPLY_EMAIL;
				if($friend_email != "xxxyyy@zzz.com"){
					if(EMAIL_TYPE==2){
						$status = email::smtp($from,$friend_email, $fri_subject, $friend_message, $file);
					} else {
						$a = email::sendgrid_attach($friend_email, $fri_subject,$friend_message,$file);
					}
				} else {
					 if(EMAIL_TYPE==2){				        
						email::smtp($from,$mail->email, $subject, $message,$file);
					}else {
						$status = email::sendgrid_attach($mail->email, $subject, $message, $file);
					}
				}
				$transaction_coupon_update = $this->api->update_transaction_coupon_status1($deal_id,$mail->user_id,$mail->order_date);
				for($i=0; $i < count($coupon_array); $i++){
					unlink("images/pdf/Voucher".$i.".pdf");
				}
			}
		}
        $user_details = $this->api->get_purchased_user_details($userid);
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->api->update_referral_amount($U->referred_user_id);
			}
			if($U->facebook_update == 1){
				$deals_details = $this->api->get_deals_details($deal_id);
				foreach($deals_details as $D){
					$dealURL = PATH."deals/".$D->deal_key.'/'.$D->url_title.".html";
					$message = "I have purchased the deal...".$D->deal_title." ".$dealURL." limited offer hurry up!";
					$post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");
					common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg );
				}
			}
		}
		return;
	}
	
	/** Send Purchase details to user Email **/
	
	private function payment_mail_function( $captured = "", $deal_id = "", $transaction_id = "", $lang = "")
	{ 
		
        $this->language = ($lang == "ar")?"arabic":"english";
        include Kohana::find_file('vendor/language/frontend_language',$this->language);
        $this->Lang = $content_text;
                                
	    if($captured == 1){
			$from = NOREPLY_EMAIL;
			$transaction_details = $this->api->get_all_deal_captured_transaction($deal_id, $transaction_id, $captured);
			foreach($transaction_details as $TD){	
			
					$friend_details = $this->api->get_friend_transaction_details($deal_id, $TD->id);
					$friend_email = $friend_details->current()->friend_email;
					$friend_name = $friend_details->current()->friend_name;  
					      
					$this->result_mail = arr::to_object(array("deal_title" => ucfirst($TD->deal_title), "item_qty" => $TD->quantity ,"total" => $TD->amount + $TD->referral_amount,"ref_amount"=> $TD->referral_amount, "amount"=> $TD->amount ,"friend_name" => $friend_name,"user_name" => $TD->firstname,"value" =>$TD->deal_value));
					
                                                if($lang == "ar"){
                                                $subject = "شكرا لشراء من ". SITENAME;			
                                                } else {
                                                $subject = "Thanks for buying from ". SITENAME;	
                                                }


                                                if($lang == "ar"){
                                                $fri_subject = "كنت حصلت على قسيمة هدية من صديقك ";			
                                                } else {
                                                $fri_subject = "You Got Coupon Gift from your Friend ";	
                                                }
					
						if($friend_email != "xxxyyy@zzz.com"){
							
						 $store_detail = $this->api->get_payment_store_detail($deal_id);
						 $store_name = $store_detail->current()->store_name;
						 $store_address = $store_detail->current()->address1." ,".$store_detail->current()->address2;
						 $phone_number = $store_detail->current()->phone_number;
						 $zipcode = $store_detail->current()->zipcode;
						 $website = $store_detail->current()->website;
						 $city_name = $store_detail->current()->city_name;
						 
						$this->result_mail = arr::to_object(array("deal_title" => ucfirst($TD->deal_title), "deal_key" => $TD->deal_key,"url_title" => $TD->url_title, "item_qty" => $TD->quantity ,"total" => $TD->amount + $TD->referral_amount,"ref_amount"=> $TD->referral_amount, "amount"=> $TD->amount ,"friend_name" => $friend_name,"value" =>$TD->deal_value,"user_name" => $TD->firstname,"expirydate"=>$TD->expirydate,"couponcode"=>"","purchase_count"=>$TD->purchase_count,"minimum_deals_limit"=>$TD->minimum_deals_limit,"value" =>$TD->deal_value,"store_name" => ucfirst($store_name),"store_address" =>$store_address,"zipcode" =>$zipcode,"phone_number" => $phone_number,"website" => $website,"city_name" =>$city_name)); 
				
							 $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mobile_mail"); 
						} else {
								$this->coupon_active = 0;
								$message = new View("themes/".THEME_NAME."/payment_mail");
						}
						
						//print_r($this->result_mail);
						
						if($friend_email != "xxxyyy@zzz.com"){
							if(EMAIL_TYPE==2){
								email::smtp($from, $friend_email, $fri_subject,$friend_message);
								
							} else {
								email::sendgrid($from, $friend_email, $fri_subject ,$friend_message);
							}
						} else {
							 if(EMAIL_TYPE==2){				        
									email::smtp($from,$TD->email, $subject, $message);
							}else {
									email::sendgrid($from,$TD->email, $subject, $message);
							}
						}
				
			}	
		}	
		return;
		
	}
	
	/** Hash Call **/
	
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
	
	
	
	
	/** USER LOGIN **/
	
	public function login()
	{
		/*if($_POST){ */
			$post = $this->input->post();
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$lang = $this->input->post('lang');
			$status = $this->api->login($email, $password);
			if($status >= 1){
			        if($lang == "ar"){
				$response = array("response" => array("user_id" => $status,"email" => $email,"httpCode" => 200,"Message" => "تسجيل بنجاح في"));
				} else {
				$response = array("response" => array("user_id" => $status,"email" => $email,"httpCode" => 200,"Message" => "Successfully logged in"));
				}
				echo json_encode($response);	
			}
			else if($status == -2){
                                if($lang == "ar"){
				$response = array("response" => array("httpCode" => 401 , "Message" => "محظور المستخدم" ));
				} else {
				$response = array("response" => array("httpCode" => 401 , "Message" => "User has been blocked kindly contact admin" ));
				}
				echo json_encode($response);
			}
			else{
			        if($lang == "ar"){
				$response = array("response" => array("httpCode" => 401 , "Message" => "تفاصيل تسجيل الدخول غير صحيحة" ));
				} else {
				$response = array("response" => array("httpCode" => 401 , "Message" => "Incorrect login details" ));
				}
				echo json_encode($response);
			 }
			exit;
		/*} */
		if($lang == "ar"){
		$response = array("response" => array("httpCode" => 400 , "Message" => "اكتب أسلوب غير صالحة" ));
		} else {
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		}
		echo json_encode($response);
		exit;
	}

	/* USER REGISTRATION **/

	public function registration()
	{
		if($_POST){ 
			$post = new Validation($_POST);
			$lang = $this->input->post('lang');
			$post = Validation::factory($_POST)
						->add_rules('firstname','required')
						->add_rules('email','required')
						//->add_rules('password','required')
						->add_rules('city_id','required');
			if($post->validate()){
                              
				if(!valid::email($this->input->post("email"))){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "البريد الإلكتروني غير صالحة" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Invalid email" ));
					}
					echo json_encode($response);
					exit;
				}
				/*if(strlen($this->input->post("password")) < 6){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "يجب أن تكون كلمة السر على الأقل 6 أحرف" ));
					} else { 
					$response = array("response" => array("httpCode" => 401 , "Message" => "Password should be minimum 6 chars" ));
					}
					echo json_encode($response);
					exit;	
				}   */

				$status = $this->api->registration(arr::to_object($this->input->post()));

				if($status > 0){
				
                                                $this->language = ($lang == "ar")?"arabic":"english";
                                                include Kohana::find_file('vendor/language/frontend_language',$this->language);
                                                $this->Lang = $content_text;
						$this->signup=1;
						$from = CONTACT_EMAIL;
						$this->name=$_POST['firstname'];
						$this->email =$_POST['email'];
						$this->password =$_POST['password'];  
						$subject = $this->Lang['YOUR'].' '.SITENAME.' '.$this->Lang['REG_COMPLETE'];
						$message = new View("themes/".THEME_NAME."/mail_template");
						
						if(EMAIL_TYPE==2){
						email::smtp($from, $post->email,$subject, $message);
						}else{
						email::sendgrid($from, $post->email,$subject, $message);
						} 
					if($lang == "ar"){
					$response = array("response" => array("user_id" => $status, "email" => $post->email, "httpCode" => 200,"Message" => "بنجاح عضو مسجل"));
					} else {
					$response = array("response" => array("user_id" => $status, "email" => $post->email, "httpCode" => 200,"Message" => "Successfully user registered"));
					}
				}
				elseif($status == -1){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "مستخدمين موجودة بالفعل" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Users already exist" ));
					}
				}
				elseif($status == -2){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "ID المدينة غير صالحة" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Invalid city ID" ));
					}

				}
				else{
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "خطأ في تسجيل المستخدم" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Error in user registration" ));
					}
				}
				echo json_encode($response);exit;
				

			}
			else{
			        if($lang == "ar"){
				$response = array("response" => array("httpCode" => 400 , "Message" => "البيانات المطلوبة في عداد المفقودين" ));
				}  else { 
				$response = array("response" => array("httpCode" => 400 , "Message" => "Required data missing" ));
				}
				echo json_encode($response);
				exit;
			}			
	
		}
		$response[] = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
	}
	
	
	/** GET USER PROFILE DATA **/

	public function user_profile_data($lang = "", $user_id = "")
	{
		$data = $this->api->get_user_profile_data($user_id);
		if(count($data) > 0){
			foreach($data as $R){
			    if(file_exists(DOCROOT.'images/user/150_115/'.$user_id.'.png')){
					$user_image_path = PATH.'images/user/150_115/'.$user_id.'.png';
				}else{
					$user_image_path = PATH.'images/user/150_115/profileimg.png';
				}
				 if($lang == "ar"){
				$response = array("response" => array("user_id" => $user_id, "email" => $R->email, "firstname" => $R->firstname, "lastname" => $R->lastname, "address1" => $R->address1, "address2" => $R->address2,"city_id" => $R->cityid, "city_name" => $R->city_name_arabic,  "phone" => $R->phone_number, "user_image" => $user_image_path,  "httpCode" => 200));
				} else {
				$response = array("response" => array("user_id" => $user_id, "email" => $R->email, "firstname" => $R->firstname, "lastname" => $R->lastname, "address1" => $R->address1, "address2" => $R->address2, "city_id" => $R->cityid,"city_name" => $R->city_name,  "phone" => $R->phone_number, "user_image" => $user_image_path,  "httpCode" => 200));
				}
				echo json_encode($response);
				exit;
			}
			
		}
		if($lang == "ar"){
		$response = array("response" => array("httpCode" => 401 , "Message" => "مستخدم غير صالح" ));
		} else {
		$response = array("response" => array("httpCode" => 401 , "Message" => "Invalid user" ));
		}
		echo json_encode($response);
		exit;
		
	}
	
	/* EDIT PROFILE **/

	public function edit_profile()
	{
		if($_POST){
				    
			$post = new Validation($_POST);
			$userid = $this->input->post('userid');
			$lang = $this->input->post('lang');
			if($userid){
			$post = Validation::factory($_POST)
			            ->add_rules('userid','required')
				    ->add_rules('city_id','required');
			if($post->validate()){
                
				$status = $this->api->edit_profile(arr::to_object($this->input->post()));

				if($status > 0){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 200,"Message" => "بنجاح الجانبي للمستخدم تحديث"));				
					} else {
					$response = array("response" => array("httpCode" => 200,"Message" => "Successfully user profile updated"));				
					}
				}
				elseif($status == -1){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "لم يتم العثور على المستخدمين" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Users not found" ));
					}
				}
				else{
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "خطأ في تحديث الملف الشخصي للمستخدم" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Error in user profile update" ));
					}
				}
				echo json_encode($response);
				exit;			

			}
			else{
			        if($lang == "ar"){
				$response = array("response" => array("httpCode" => 400 , "Message" => "البيانات المطلوبة في عداد المفقودين" ));
				} else {
				$response = array("response" => array("httpCode" => 400 , "Message" => "Required data missing" ));
				}
				echo json_encode($response);
				exit;
			}			
	
		}		
		else{
		                if($lang == "ar"){
				$response = array("response" => array("httpCode" => 400 , "Message" => "الدخول إلى تعديل الملف الشخصي" ));
				} else {
				$response = array("response" => array("httpCode" => 400 , "Message" => "Login to edit profile" ));
				}
				echo json_encode($response);
				exit;
			}		
		}
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
	}
	
	/*  FORGOT PASSWORD **/

	public function forgot_password()
	{
		//if($_POST){		
		    $emailid = $this->input->post('emailid');
		    $lang = $this->input->post('lang');
		   
				$status = $this->api->forgot_password($emailid,$lang);
				if($status > 0){
				        if($lang == "ar"){
					$response = array("response" => array("user_id" => $status, "email" => $emailid, "httpCode" => 200,"Message" => "كلمة السر تغيرت بنجاح يرجى مراجعة البريد الخاص بك"));	
					} else {
					$response = array("response" => array("user_id" => $status, "email" => $emailid, "httpCode" => 200,"Message" => "Successfully your password changed please check your mail"));
					}			
				}
				elseif($status == -1){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "لم يتم العثور على المستخدمين" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Users not found" ));
					}
				}
				else{
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "خطأ في المستخدم نسيت كلمة المرور" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Error in user forgot password" ));
					}
				}
				echo json_encode($response);
				exit;
	
		//}
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
	}

	/* USER CHANGE PASSWORD **/

	public function change_password()
	{
		if($_POST){

			$post = new Validation($_POST);
			$lang = $this->input->post('lang');
			$post = Validation::factory($_POST)
						->add_rules('user_id','required')
						->add_rules('old_password','required') ;
						//->add_rules('new_password','required');
			if($post->validate()){
                              
				/*if(strlen($this->input->post("new_password")) < 6){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "يجب أن تكون كلمة مرور جديدة على الأقل 6 أحرف" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "New password should be minimum 6 chars" ));
					}
					echo json_encode($response);
					exit;	
				}*/
				/*if($this->input->post("old_password") == $this->input->post("new_password")){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "لا ينبغي أن تكون كلمة المرور الحالية وكلمة المرور الجديدة نفس" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Current password and new password should not be same" ));
					}
					echo json_encode($response);
					exit;	
				}*/
				$status = $this->api->changepassword(arr::to_object($this->input->post()));
				if($status == 1){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 200, "Message" => "تغيير كلمة المرور بنجاح"));				
					} else {
					$response = array("response" => array("httpCode" => 200, "Message" => "Password changed successfully"));			
					}
				}
				else{
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401, "Message" => "كلمة المرور الحالية التي أدخلتها غير صحيحة."));	
					} else {
					$response = array("response" => array("httpCode" => 401, "Message" => "The current password you have entered is incorrect."));	
					}
				}
				echo json_encode($response);
				exit;	

			}
			else{
			        if($lang == "ar"){
				$response = array("response" => array("httpCode" => 400 , "Message" => "البيانات المطلوبة في عداد المفقودين" ));
				} else { 
				$response = array("response" => array("httpCode" => 400 , "Message" => "Required data missing" ));
				}
				echo json_encode($response);
				exit;
			}	
		}   
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
	}
	
	
	/** GET USER SHIPPING DATA **/

	public function user_shipping_data($lang = "", $user_id = "")
	{

		$data = $this->api->get_user_shipping_data($user_id);
		if(count($data) > 0){
			foreach($data as $R){	
				if($lang == "ar"){        
				$response = array("response" => array("shipping_user" => $R->ship_name, "shipping_address1" => $R->ship_address1, "shipping_address2" => $R->ship_address2, "shipping_state" => $R->ship_state, "shipping_country_id" => $R->ship_country, "shipping_city_id" => $R->ship_city, "shipping_mobileno" => $R->ship_mobileno,  "shipping_zipcode" => $R->ship_zipcode, "shipping_country_name" => $R->country_name_arabic,  "shipping_city_name" => $R->city_name_arabic, "httpCode" => 200));
				} else {
				$response = array("response" => array("shipping_user" => $R->ship_name, "shipping_address1" => $R->ship_address1, "shipping_address2" => $R->ship_address2, "shipping_state" => $R->ship_state, "shipping_country_id" => $R->ship_country, "shipping_city_id" => $R->ship_city, "shipping_mobileno" => $R->ship_mobileno,  "shipping_zipcode" => $R->ship_zipcode, "shipping_country_name" => $R->country_name,  "shipping_city_name" => $R->city_name, "httpCode" => 200));
				}
				echo json_encode($response);
				exit;
			}
			
		}
		if($lang == "ar"){
		$response = array("response" => array("httpCode" => 401 , "Message" => "مستخدم غير صالح" ));
		} else {
		$response = array("response" => array("httpCode" => 401 , "Message" => "Invalid user" ));
		}
		echo json_encode($response);
		exit;
		
	}
	
	/* EDIT SHIPPING **/

	public function edit_shipping()
	{
		if($_POST){
			$post = new Validation($_POST);
			$userid = $this->input->post('userid');
			$lang = $this->input->post('lang');
			if($userid){
			
			
			$post = Validation::factory($_POST)
			            ->add_rules('userid','required')
			            ->add_rules('lang','required')
			            ->add_rules('ship_name','required')
			            ->add_rules('ship_address1','required')
			            ->add_rules('ship_address2','required')
			            ->add_rules('ship_state','required')
			            ->add_rules('ship_country','required')
			            ->add_rules('ship_city','required')
			            ->add_rules('ship_mobileno','required')
			            ->add_rules('ship_zipcode','required');
			if($post->validate()){
				$status = $this->api->edit_shipping(arr::to_object($this->input->post()));
				if($status > 0){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 200,"Message" => "تفاصيل الشحن استخدمت بنجاح تحديث"));
					} else {
					$response = array("response" => array("httpCode" => 200,"Message" => "Successfully user shipping details  updated"));
					}
				}
				elseif($status == -1){
				        if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "لم يتم العثور على المستخدمين" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Users not found" ));
					}
				}
				else{
				         if($lang == "ar"){
					$response = array("response" => array("httpCode" => 401 , "Message" => "خطأ في تفاصيل الشحن المستخدم التحديث" ));
					} else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Error in user shipping details update" ));
					}
				}
				echo json_encode($response);
				exit;	
			}
			else{
			         if($lang == "ar"){
				$response = array("response" => array("httpCode" => 400 , "Message" => "البيانات المطلوبة في عداد المفقودين" ));
				} else {
				$response = array("response" => array("httpCode" => 400 , "Message" => "Required data missing" ));
				}
				echo json_encode($response);
				exit;
			}
		}
		else{
		                 if($lang == "ar"){
				$response = array("response" => array("httpCode" => 400 , "Message" => "الدخول إلى تعديل تفاصيل الشحن" ));
				} else {
				$response = array("response" => array("httpCode" => 400 , "Message" => "Login to edit shipping details" ));
				}
				echo json_encode($response);
				exit;
			}
		}
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
	}
	/** CITY LIST **/
	
	public function city_list($lang= "")
	{
		$data = $this->api->get_city_list();
		if(count($data) > 0){
			foreach($data as $city){
			        if($lang == "ar"){
				$response[] = array("city_list" => array("httpCode" => 200 , "Message" => "مدينة متاح","city_id" => $city->city_id, "country_id" => $city->country_id,"country_name" => $city->country_name_arabic, "city_name" => $city->city_name_arabic, "city_url" => $city->city_url));
				} else {
				$response[] = array("city_list" => array("httpCode" => 200 , "Message" => "City available","city_id" => $city->city_id, "country_id" => $city->country_id,"country_name" => $city->country_name, "city_name" => $city->city_name, "city_url" => $city->city_url));
				}
			}
			$city_response["citylist"] = $response;
			echo json_encode($city_response);
			exit;
		}else{
		        if($lang == "ar"){
			$response[] = array("city_list" => array("httpCode" => 401 , "Message" => "لا توجد مدينة متاح" ));
			} else {
			$response[] = array("city_list" => array("httpCode" => 401 , "Message" => "No city available" ));
			}
			$today_deals_response["citylist"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
	}
	
	/** COUNTRY LIST **/
	
	public function country_list($lang= "")
	{
		$data = $this->api->get_country_list();
		if(count($data) > 0){
			foreach($data as $country){
			        if($lang == "ar"){
				$response[] = array("country_list" => array("httpCode" => 200 ,"country_id" => $country->country_id,"country_name" => $country->country_name_arabic, "country_url" => $country->country_url));
				} else {
				$response[] = array("country_list" => array("httpCode" => 200 ,"country_id" => $country->country_id,"country_name" => $country->country_name, "country_url" => $country->country_url));
				}
			}
			$country_response["countrylist"] = $response;
			echo json_encode($country_response);
			exit;
		}else{
		        if($lang == "ar"){
			$response = array("country_list" => array("httpCode" => 401 , "Message" => "لا يوجد بلد متاحة" ));
			} else {
			$response = array("country_list" => array("httpCode" => 401 , "Message" => "No country available" ));
			}
			echo json_encode($response);
			exit;
		}
	}
	
	
	/** CATEGORY LIST **/
	
	public function category_list($lang= "", $type = "", $city_id = "")
	{
		$data = $this->api->get_category_list($type);
		$count_val = 0;
		if(count($data) > 0){
			$count_total = ""; 
			foreach($data as $category){
			        if($type == "deal"){
			                $countdatadeal = $this->api->get_category_deals("1" , $category->category_id,$city_id);
			                $count_total = count($countdatadeal);
		                }else if($type == "product"){
			                $countdataproduct = $this->api->get_category_product("1" , $category->category_id,$city_id);
			                $count_total = count($countdataproduct);
		                }else if($type == "auction"){
			                $countdataauction = $this->api->get_category_auctions("1" , $category->category_id, $city_id);
			                $count_total = count($countdataauction);
		                }
		                if($count_total != 0){
		                
		                $count_val = 1;
			        if($lang == "ar"){
				$response[] = array("category_list" => array("httpCode" => 200 , "Message" => "الفئة متاحة","category_id" => $category->category_id, "category_name" => $category->category_name_arabic, "category_url_title" => $category->category_url, "count_product" => $count_total));
				} else { 
				$response[] = array("category_list" => array("httpCode" => 200 , "Message" => "Category available","category_id" => $category->category_id, "category_name" => $category->category_name, "category_url_title" => $category->category_url, "count_product" => $count_total));
				}
				} 
			}
			     if($count_val == 0){
			                if($lang == "ar"){
			                $response[] = array("category_list" => array("httpCode" => 401 , "Message" => "لا توجد" ));
			                } else {
			                $response[] = array("category_list" => array("httpCode" => 401 , "Message" => "No available" ));
			                }
			     }
			$category_response["categorylist"] = $response;
			echo json_encode($category_response);
			exit;
		}else{
		          if($lang == "ar"){
			$response[] = array("category_list" => array("httpCode" => 401 , "Message" => "لا تتوفر الفئة" ));
			} else {
			$response[] = array("category_list" => array("httpCode" => 401 , "Message" => "No category available" ));
			}
			$category_response["categorylist"] = $response;
			echo json_encode($category_response);
			exit;
		}
		
	}
	
	/** SUB CATEGORY LIST **/
	
	public function sub_category_list($lang= "",$cat_id = "", $type = "", $city_id = "")
	{
		$data = $this->api->get_sub_category_list($cat_id);
		$count_val = 0;
		if(count($data) > 0){
		
			foreach($data as $category){
			
			        if($type == "deal"){
			                $countdatadeal = $this->api->get_category_deals("2" , $category->category_id,$city_id);
			                $count_total = count($countdatadeal);
		                }else if($type == "product"){
			                $countdataproduct = $this->api->get_category_product("2" , $category->category_id,$city_id);
			                $count_total = count($countdataproduct);
		                }else if($type == "auction"){
			                $countdataauction = $this->api->get_category_auctions("2" , $category->category_id, $city_id);
			                $count_total = count($countdataauction);
		                }
		                
		                     if($count_total != 0){
		                     $count_val = 1;
			         if($lang == "ar"){
				$response[] = array("category_list" => array("httpCode" => 200 , "Message" => "الفئة الفرعية المتوفرة","sub_category_id" => $category->category_id, "sub_category_name" => $category->category_name_arabic, "sub_category_url_title" => $category->category_url, "count_product" => $count_total));
				} else {
				$response[] = array("category_list" => array("httpCode" => 200 , "Message" => "Sub category available","sub_category_id" => $category->category_id, "sub_category_name" => $category->category_name, "sub_category_url_title" => $category->category_url, "count_product" => $count_total));
				}
				} 
			}
			
			if($count_val == 0){
			                if($lang == "ar"){
			                $response[] = array("category_list" => array("httpCode" => 401 , "Message" => "لا توجد" ));
			                } else {
			                $response[] = array("category_list" => array("httpCode" => 401 , "Message" => "No available" ));
			                }
			     }
			     
			$category_response["categorylist"] = $response;
			echo json_encode($category_response);
			exit;
		}else{
		         if($lang == "ar"){
			$response[] = array("category_list" => array("httpCode" => 401 , "Message" => "لا فئة فرعية متاحة" ));
			} else { 
			$response[] = array("category_list" => array("httpCode" => 401 , "Message" => "No sub category available" ));
			}
			$category_response["categorylist"] = $response;
			echo json_encode($category_response);
			exit;
		
		}
		
	}
	
	
	/** SUB CATEGORY LIST **/
	
	public function second_sub_category_list($lang= "",$cat_id = "",$sub_id = "", $type = "", $city_id = "")
	{
		$data = $this->api->get_second_sub_category_list($cat_id,$sub_id);
		$count_val = 0;
		if(count($data) > 0){
			foreach($data as $category){
			
			     if($type == "deal"){
			                $countdatadeal = $this->api->get_category_deals("3" , $category->category_id,$city_id);
			                $count_total = count($countdatadeal);
		                }else if($type == "product"){
			                $countdataproduct = $this->api->get_category_product("3" , $category->category_id,$city_id);
			                $count_total = count($countdataproduct);
		                }else if($type == "auction"){
			                $countdataauction = $this->api->get_category_auctions("3" , $category->category_id, $city_id);
			                $count_total = count($countdataauction);
		                }
		                     if($count_total != 0){
		                     $count_val = 1;
			         if($lang == "ar"){
				$response[] = array("category_list" => array("httpCode" => 200 , "Message" => "الفئة الفرعية الثانية متاح","second_sub_category_id" => $category->category_id, "second_sub_category_name" => $category->category_name_arabic, "second_sub_category_url_title" => $category->category_url, "count_product" => $count_total));
				} else {
				$response[] = array("category_list" => array("httpCode" => 200 , "Message" => "Second sub category available","second_sub_category_id" => $category->category_id, "second_sub_category_name" => $category->category_name, "second_sub_category_url_title" => $category->category_url, "count_product" => $count_total));
				}
				} 
			}
			
			if($count_val == 0){
			                if($lang == "ar"){
			                $response[] = array("category_list" => array("httpCode" => 401 , "Message" => "لا توجد" ));
			                } else {
			                $response[] = array("category_list" => array("httpCode" => 401 , "Message" => "No available" ));
			                }
			     }
			$category_response["secondsubcategorylist"] = $response;
			echo json_encode($category_response);
			exit;
		}else{
		         if($lang == "ar"){
			$response[] = array("category_list" => array("httpCode" => 401 , "Message" => "لا تتوفر الفئة الفرعية الثانية" ));
			} else { 
			$response[] = array("category_list" => array("httpCode" => 401 , "Message" => "No Second sub category available" ));
			}
			$category_response["secondsubcategorylist"] = $response;
			echo json_encode($category_response);
			exit;
		
		}
		
	}
	
	
	/** SUB CATEGORY LIST **/
	
	public function third_sub_category_list($lang= "",$cat_id = "",$sub_id = "", $type = "", $city_id = "")
	{
		$data = $this->api->get_third_sub_category_list($cat_id,$sub_id);
		$count_val = 0;
		if(count($data) > 0){
			foreach($data as $category){
			
			        if($type == "deal"){
			                $countdatadeal = $this->api->get_category_deals("4" , $category->category_id,$city_id);
			                 $countdatadeal_zero = $this->api->get_category_deals("5" , "0", $city_id);
			                $count_total = count($countdatadeal);
			                $count_total_zero = count($countdatadeal_zero);
		                }else if($type == "product"){
			                $countdataproduct = $this->api->get_category_product("4" , $category->category_id,$city_id);
			                $count_total = count($countdataproduct);
			                 $countdataproduct_zero = $this->api->get_category_product("5" , "0", $city_id);
			                $count_total_zero = count($countdataproduct_zero);
		                }else if($type == "auction"){
			                $countdataauction = $this->api->get_category_auctions("4" , $category->category_id, $city_id);
			                $countdataauction_zero = $this->api->get_category_auctions("5" , "0", $city_id);
			                $count_total = count($countdataauction);
			                $count_total_zero = count($countdataauction_zero);
			                
		                }
		                     if($count_total != 0){
		                     $count_val = 1;
			           if($lang == "ar"){
				$response[] = array("category_list" => array("httpCode" => 200 , "Message" => "الفئة الفرعية الثالثة متاحة","third_sub_category_id" => $category->category_id, "third_sub_category_name" => $category->category_name_arabic, "third_sub_category_url_title" => $category->category_url, "count_product" => $count_total));
				if($count_total_zero != 0){
				$response[] = array("category_list" => array("httpCode" => 200 , "Message" => "الفئة الفرعية الثالثة متاحة","third_sub_category_id" => "0", "third_sub_category_name" => "آخرون", "third_sub_category_url_title" => "", "count_product" => $count_total_zero));
				}
				} else { 
				$response[] = array("category_list" => array("httpCode" => 200 , "Message" => "Third sub category available","third_sub_category_id" => $category->category_id, "third_sub_category_name" => $category->category_name, "third_sub_category_url_title" => $category->category_url, "count_product" => $count_total));
				if($count_total_zero != 0){
				$response[] = array("category_list" => array("httpCode" => 200 , "Message" => "Third sub category available","third_sub_category_id" => "0", "third_sub_category_name" => "Others",  "third_sub_category_url_title" => "", "count_product" => $count_total_zero));
				}
				}
				} 
			}
			if($count_val == 0){
			                if($lang == "ar"){
			                $response[] = array("category_list" => array("httpCode" => 401 , "Message" => "لا توجد" ));
			                } else {
			                $response[] = array("category_list" => array("httpCode" => 401 , "Message" => "No available" ));
			                }
			     }
			     
			$category_response["thirdsubcategorylist"] = $response;
			echo json_encode($category_response);
			exit;
		}else{
		        if($lang == "ar"){
			$response[] = array("category_list" => array("httpCode" => 401 , "Message" => "لا تتوفر الفئة الفرعية الثالثة" ));
			} else {
			$response[] = array("category_list" => array("httpCode" => 401 , "Message" => "No Third sub category available" ));
			}
			$category_response["thirdsubcategorylist"] = $response;
			echo json_encode($category_response);
			exit;
		
		}
		
	}
	
	/** TODAY'S DEALS **/
	
	public function deals_listing($lang = "" , $city_id = "", $search = "",$type="")
	{
		if($this->deal_setting){
			
			$data = $this->api->get_today_deals($city_id, $search,$type);
			if(count($data) > 0){
				foreach($data as $deals){
					//if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) { } else {
						
						        if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1.png')){
							        $image_path= PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png';
						        }else{
							        $image_path = PATH.'images/no-images.png';
						        }
						        if($lang == "ar"){
							$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "صفقة المتاحة","deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings, "store_name" => $deals->store_name_arabic,"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name_arabic, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name_arabic,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL,"purchase_qty" =>$deals->purchase_count,"purchase_count" => $deals->user_limit_quantity,"max_user_limit" => $deals->user_limit_quantity,"minimum_deals_limit" =>$deals->minimum_deals_limit));
							} else {
							$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "Deal available","deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings, "store_name" => ucfirst($deals->store_name),"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL,"purchase_qty" =>$deals->purchase_count,"purchase_count" => $deals->user_limit_quantity,"max_user_limit" => $deals->user_limit_quantity,"minimum_deals_limit" =>$deals->minimum_deals_limit));
							}
					}
				//}
				$today_deals_response["deallist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}else{
			       if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "لا صفقة المتاحة" ));
				} else {
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "No deal available" ));
				}
				
				$today_deals_response["deallist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}
		}
				 if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "وحدة تعطيل الصفقة من قبل المشرف!" ));
				} else {
				$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "Deal module disabled by admin!" ));
				}
				$today_deals_response["deallist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			
	}
	
	
		/** TODAY'S DEALS **/
	
	public function hot_deals_listing($lang = "", $type_view  = "" , $city_id = "")
	{
		if($this->deal_setting){
			if($type_view == "hot"){
			$data = $this->api->get_hot_today_deals($city_id);
		        } else { 
		        $data = $this->api->get_mostview_today_deals($city_id);
		        }
			if(count($data) > 0){
				foreach($data as $deals){
					//if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) { } else {
						
						if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1.png')){
							$image_path= PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png';
						}else{
							$image_path = PATH.'images/no-images.png';
						}
						
						if($lang == "ar"){
						$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "صفقة المتاحة","deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings, "store_name" => $deals->store_name_arabic,"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name_arabic, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name_arabic,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL,"purchase_qty" =>$deals->purchase_count,"purchase_count" => $deals->user_limit_quantity,"max_user_limit" => $deals->user_limit_quantity,"minimum_deals_limit" =>$deals->minimum_deals_limit));
						} else {
						$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "Deal available","deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings, "store_name" => ucfirst($deals->store_name),"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL,"purchase_qty" =>$deals->purchase_count,"purchase_count" => $deals->user_limit_quantity,"max_user_limit" => $deals->user_limit_quantity,"minimum_deals_limit" =>$deals->minimum_deals_limit));
						
						}
					}
				//}
				$today_deals_response["deallist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}else{
			        if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "لا صفقة المتاحة" ));
				} else {
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "No deal available" ));
				}
				$today_deals_response["deallist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}
		}
		               if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "وحدة تعطيل الصفقة من قبل المشرف!" ));
				} else {
				$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "Deal module disabled by admin!" ));
				}
				$today_deals_response["deallist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			
	}
	
	/** TODAY'S DEALS **/
	
	public function deals_category_listing($lang = "" , $type = "", $category = "",$city_id = "")
	{
		if($this->deal_setting){
			$data = $this->api->get_category_deals($type, $category,$city_id);
			if(count($data) > 0){
				foreach($data as $deals){
					//if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) { $response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "No Deal available" )); } else {
						
						if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1.png')){
							$image_path= PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png';
						}else{
							$image_path = PATH.'images/no-images.png';
						}
						
						if($type == "5"){					
					        if($lang == "ar"){
					                $category_name = "آخرون";
					        } else {
					                 $category_name = "Others";
					        }					
					        } else {					
					        if($lang == "ar"){
					                $category_name = $deals->category_name_arabic;
					        } else {
					                 $category_name = $deals->category_name;
					        }					
					}
					
					
						if($lang == "ar"){
						$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "صفقة المتاحة","deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings, "store_name" => $deals->store_name_arabic,"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" =>  $category_name, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path,"city_name" => $deals->city_name_arabic,"city_id" => $deals->city_id, 'currency_symbol' => CURRENCY_SYMBOL,"purchase_count" =>$deals->purchase_count,"max_user_limit" => $deals->user_limit_quantity,"minimum_deals_limit" =>$deals->minimum_deals_limit));
						} else { 
						$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "Deal available","deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings, "store_name" => ucfirst($deals->store_name),"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" =>  $category_name, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path,"city_name" => $deals->city_name,"city_id" => $deals->city_id, 'currency_symbol' => CURRENCY_SYMBOL,"purchase_count" =>$deals->purchase_count,"max_user_limit" => $deals->user_limit_quantity,"minimum_deals_limit" =>$deals->minimum_deals_limit));
						}
					}
				//}
				$today_deals_response["dealcategorylist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}else{
			         if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "لا صفقة المتاحة" ));
				} else {
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "No deal available" ));
				}
				$today_deals_response["dealcategorylist"] = $response;
				echo json_encode($today_deals_response);
				exit;
				
			} 
		}
		                if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "وحدة تعطيل الصفقة من قبل المشرف!" ));
				} else {
				$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "Deal module disabled by admin!" ));
				}
				$today_deals_response["deallist"] = $response;
				echo json_encode($today_deals_response);
				exit;
	}
	
	
	/** TODAY'S DEAL **/
	
	public function today_deals($lang= "", $city_id = "")
	{ 
		if($this->deal_setting){
			$data = $this->api->get_today_deal_details($city_id);
			if(count($data) > 0){
				foreach($data as $deals){
					//if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) { } else {
						if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1.png')){
							$image_path= PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png';
						}else{
							$image_path = PATH.'images/no-images.png';
						}
						if($lang == "ar"){
						$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "صفقة المتاحة","deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings, "store_name" => $deals->store_name_arabic,"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name_arabic, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path,"city_name" => $deals->city_name_arabic,"city_id" => $deals->city_id, 'currency_symbol' => CURRENCY_SYMBOL,"purchase_count" =>$deals->purchase_count,"max_user_limit" => $deals->user_limit_quantity,"min_deals_limit" =>$deals->minimum_deals_limit));
						} else {
						$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "Deal available","deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings, "store_name" => ucfirst($deals->store_name),"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path,"city_name" => $deals->city_name,"city_id" => $deals->city_id, 'currency_symbol' => CURRENCY_SYMBOL,"purchase_count" =>$deals->purchase_count,"max_user_limit" => $deals->user_limit_quantity,"min_deals_limit" =>$deals->minimum_deals_limit));
						}
						//}
					}
				//}
				$deal_detail_response["deallist"] = $response;
				echo json_encode($deal_detail_response);
				exit;
			}else{
			        if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "لا صفقة المتاحة" ));
				} else { 
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "No deal available" ));
				}
				$today_deals_response["deallist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}
		}
		                if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "وحدة تعطيل الصفقة من قبل المشرف!" ));
				} else {
				$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "Deal module disabled by admin!" ));
				}
				$today_deals_response["deallist"] = $response;
				echo json_encode($today_deals_response);
				exit;
		
	}
	
	/** DEAL DETAILS **/
	
	public function deal_details($lang = "", $deal_id = "", $deal_key = "", $device_number = "")
	{
		$data = $this->api->get_deal_details($deal_id,$deal_key,$device_number);
		if(count($data) > 0){
			$avg_rating =$this->api->get_average_rating($deal_id,1);
			
			
			foreach($data as $deals){
				$con=0; 
                for($i=1; $i<=10; $i++){ 
                    if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_'.$i.'.png')) { 
                        $con=$con+1; 
                    } 
                 }
				if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1.png')){
				        $image_path ="";
				        $image_path1 = "";
				   
						for($i=1; $i<=$con; $i++){ 
					        $image_path .= PATH .'images/deals/1000_800/'.$deals->deal_key.'_'.$i.'.png'.',';
					    }
					    $image_path = substr($image_path,0,-1);
				}else{
					$image_path = PATH.'images/no-images.png';
				}

				if(file_exists(DOCROOT.'images/merchant/290_215/'.$deals->merchant_id.'_'.$deals->store_id.'.png')){
					$img_path = PATH.'images/merchant/290_215/'.$deals->merchant_id.'_'.$deals->store_id.'.png';
				}else{
					$img_path = PATH.'images/no-images.png';
				}
				$social_share = PATH.'deals/'.$deals->deal_key.'/'.$deals->url_title.'.html';
				if($lang == "ar"){			
				$response[] = array("deal_details" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id, "deal_key" => $deals->deal_key, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "image_url" => $image_path, "store_id" => $deals->store_id, "store_image_url" => $img_path,"deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings, "category" => $deals->category_name_arabic, "category_id" => $deals->category_id,"description" => $deals->deal_description_arabic, "fineprints" => $deals->fineprints, "highlights" => $deals->highlights, "terms_conditions" => $deals->terms_conditions, "purchase_count" => $deals->purchase_count,"minimum_deal_limit" =>$deals->minimum_deals_limit,"max_user_limit" => $deals->user_limit_quantity, "maximum_deals_limit" => $deals->maximum_deals_limit,"startdate" => date('Y-m-d H:i:s', $deals->startdate),  "enddate" => date('Y-m-d H:i:s', $deals->enddate), "current_time" => date('Y-m-d H:i:s', time()), "store_name" => $deals->store_name_arabic, "store_address" => $deals->address1_arabic.','.$deals->address2_arabic, "city_id" => $deals->city_id, "store_city_name" => $deals->city_name_arabic,  "store_phone_number" => $deals->phone, "store_website" => $deals->website, "store_latitude" => $deals->latitude, "store_longitude" => $deals->longitude, "social_share" => $social_share, 'currency_symbol' => CURRENCY_SYMBOL,'average_rating' =>$avg_rating,"comment_type" =>1));
				} else {
				$response[] = array("deal_details" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id, "deal_key" => $deals->deal_key, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "image_url" => $image_path, "store_id" => $deals->store_id, "store_image_url" => $img_path,"deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings, "category" => $deals->category_name, "category_id" => $deals->category_id,"description" => $deals->deal_description, "fineprints" => $deals->fineprints, "highlights" => $deals->highlights, "terms_conditions" => $deals->terms_conditions, "purchase_count" => $deals->purchase_count,"minimum_deal_limit" =>$deals->minimum_deals_limit,"max_user_limit" => $deals->user_limit_quantity, "maximum_deals_limit" => $deals->maximum_deals_limit,"startdate" => date('Y-m-d H:i:s', $deals->startdate),  "enddate" => date('Y-m-d H:i:s', $deals->enddate), "current_time" => date('Y-m-d H:i:s', time()), "store_name" => ucfirst($deals->store_name), "store_address" => $deals->addr1.','.$deals->addr2, "city_id" => $deals->city_id, "store_city_name" => $deals->city_name,  "store_phone_number" => $deals->phone, "store_website" => $deals->website, "store_latitude" => $deals->latitude, "store_longitude" => $deals->longitude, "social_share" => $social_share, 'currency_symbol' => CURRENCY_SYMBOL,'average_rating' =>$avg_rating,"comment_type" =>1));
				}
			}
			$deal_detail_response["dealdetail"] = $response;
			echo json_encode($deal_detail_response);
			exit;
		}else{
		        if($lang == "ar"){
			$response = array("deal_details" => array("httpCode" => 401 , "Message" => "لا صفقة المتاحة" ));
			} else {
			$response = array("deal_details" => array("httpCode" => 401 , "Message" => "No deal available" ));
			}
			echo json_encode($response);
			exit;
		}
		
	}
	
	public function user_purchase_count($deal_id = "",$user_id = "")
	{
			if($deal_id && $user_id){
				$user_limit_count = $this->api->get_user_limit_details($deal_id,$user_id);
				$response = array("response" => array("httpCode" => 200 , "Message" => $user_limit_count ));
				echo json_encode($response);
				exit;
			}
			else{
				$response = array("response" => array("httpCode" => 400 , "Message" => "Required data missing" ));
				echo json_encode($response);
				exit;
			}
	}
	
	public function comments_list($id="",$type="")
	{
		//$id = $this->input->get("id");
		//$type = $this->input->get("type"); 
		$comments_deatils = $this->api->get_comments_data($id,$type);
			if(count($comments_deatils) >0){
				foreach($comments_deatils as $row){
					$like_count = $this->api->get_like_count($id,$row->discussion_id,$type);
					$unlike_count = $this->api->get_unlike_count($id,$row->discussion_id,$type);
					$response[] = array("comment_list" => array("httpCode" => 200 , "Message" => "Comments available","comment_id" =>$row->discussion_id,"user_id" =>$row->user_id,"comment" =>$row->comments,"name" => $row->firstname,"created_date" => date('Y-m-d H:i:s', $row->created_date),"type" =>$row->type,"like_count" =>$like_count,"unlike_count" => $unlike_count));
					
				} 
				$deal_detail_response["detail_comment_list"] = $response;
				echo json_encode($deal_detail_response);
				exit;
			}else{
				$response[] = array("comment_list" => array("httpCode" => 401 , "Message" => "No Comments available" ));
				$today_deals_response["detail_comment_list"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}
	}
	/** DEAL,PRODUCT,AUCTION COMMENTS **/
	public function comments()
	{
		 	$comment = $this->input->get("comment"); 
			$deal_id = $this->input->get("deal_id");
			$user_id = $this->input->get("user_id");
			$type = $this->input->get("type"); 
			if ( $type == 1 || $type == 2 || $type == 3 ){
				$status = $this->api->add_comments($deal_id,$user_id,$comment,$type);
				
				if($status){
					$response = array("response" => array("httpCode" => 200,"comment_id" =>$status[0]->discussion_id,"name" => $status[0]->firstname,"Message" => "Your comment has been posted successfully","created_date" => date('Y-m-d H:i:s',time())));
				}else {
					$response = array("response" => array("httpCode" => 401 , "Message" => "Sorry!,Your comment has not been posted" ));
				}
			}
			else{
				$response = array("response" => array("httpCode" => 400 , "Message" => "Incorrect data's please try again!" ));
			}	
			echo json_encode($response);
			exit;
	
	}
	
	public function like_unlike()
	{
		$action_type = $this->input->get('action_type');
		$deal_id = $this->input->get('deal_id');
		$user_id = $this->input->get('user_id');
		$comment_id = $this->input->get('comment_id');	
		$type = $this->input->get('type');
		$data = $this->api->like_unlike($action_type,$deal_id,$user_id,$comment_id,$type);
		$like_count = $this->api->get_like_count($deal_id,$comment_id,$type);
		$unlike_count = $this->api->get_unlike_count($deal_id,$comment_id,$type);
		if($data==1){
			if($action_type =="like"){
				$response = array("response" => array("httpCode" => 200,"Message" => "The comment has been liked successfully","comment_id" =>$comment_id,"like_count" =>$like_count,"unlike_count" => $unlike_count));	
			}else if($action_type =="unlike"){
				$response = array("response" => array("httpCode" => 200,"Message" => "The comment has been unliked successfully","comment_id" =>$comment_id,"like_count" =>$like_count,"unlike_count" => $unlike_count));	
			}
		}
		else if ($data == 2 ){
			$response = array("response" => array("httpCode" => 401 , "Message" => "You had already like this comment"));
		 }
		 else if ($data == 3 ){
			$response = array("response" => array("httpCode" => 401 , "Message" => "You had already unlike this comment" ));
		 }
		else{
			$response = array("response" => array("httpCode" => 401 , "Message" => "sorry!,No such comment available" ));
		}
		echo json_encode($response);
			exit;
		
	}
	
	public function star_rating()
	{
		
		$id = $this->input->get('id');
		$user_id = $this->input->get('user_id');
		$rate = $this->input->get('rate');
		$type = $this->input->get('type');
		
		$data = $this->api->insert_star_rating($type,$id,$user_id,$rate);
		if($data==1){
			
				$response[] = array("response" => array("httpCode" => 200,"Message" => "Your rating placed successfully"));	
			
		}
		else{
			$response[] = array("response" => array("httpCode" => 401 , "Message" => "Please try again sometimes" ));
		}
		
		$star_rating_response["rating_list"] = $response;
		echo json_encode($star_rating_response);
		exit;
	}

	
	/** STORE LIST **/
	
	public function store_list($lang = "", $city_id = "" , $search="")
	{
		if($this->store_setting) { 
			$data = $this->api->get_store_list($city_id,$search);
			if(count($data) > 0){
				foreach($data as $stores){
					$store_type = "";
					if($stores->store_type == 1){
					         if($lang == "ar"){
						$store_type = "المتجر الرئيسي";
						} else {
						$store_type = "Main Store";
						}
					}else{
					         if($lang == "ar"){
						$store_type = "فرع";
						} else {
						$store_type = "Branch";
						}
					}
					if(file_exists(DOCROOT.'images/merchant/290_215/'.$stores->merchant_id.'_'.$stores->store_id.'.png')){
						$img_path = PATH.'images/merchant/290_215/'.$stores->merchant_id.'_'.$stores->store_id.'.png';
					}else{
						$img_path = PATH.'images/no-images.png';
					}
					 if($lang == "ar"){
					$response[] = array("store_list" => array("store_id" => $stores->store_id, "store_name" => $stores->store_name_arabic, "store_key" => $stores->store_key, "store_url_title" => $stores->store_url_title, "address1" => $stores->addr1, "address2" => $stores->addr2, "city_id" => $stores->city_id, "city_name" => $stores->city_name_arabic, "phone_number" => $stores->phone_number, "website" => $stores->website, "latitude" => $stores->latitude, "longitude" => $stores->longitude,  "store_type" => $store_type, "store_image" => $img_path));
					} else {
					$response[] = array("store_list" => array("store_id" => $stores->store_id, "store_name" => ucfirst($stores->store_name), "store_key" => $stores->store_key, "store_url_title" => $stores->store_url_title, "address1" => $stores->addr1, "address2" => $stores->addr2, "city_id" => $stores->city_id, "city_name" => $stores->city_name, "phone_number" => $stores->phone_number, "website" => $stores->website, "latitude" => $stores->latitude, "longitude" => $stores->longitude,  "store_type" => $store_type, "store_image" => $img_path));
					}
				}
				$store_response["storelist"] = $response;
				echo json_encode($store_response);
				exit;
			}else{
			                 if($lang == "ar"){
					$response[] = array("store_list" => array("httpCode" => 401 , "Message" => "لا مخازن المتاحة!" ));
					} else {
					$response[] = array("store_list" => array("httpCode" => 401 , "Message" => "No stores available!" ));
					}
					$deal_detail_response["storelist"] = $response;
					echo json_encode($deal_detail_response);
					exit;
				
			}
		}
		         if($lang == "ar"){
			$response[] = array("store_list" => array("httpCode" => 400 , "Message" => "متجر حدة تعطيل من قبل المشرف!" ));
			} else {
			$response[] = array("store_list" => array("httpCode" => 400 , "Message" => "Store module disabled by admin!" ));
			}
			$today_deals_response["storelist"] = $response;
			echo json_encode($today_deals_response);
			exit;
	}
	
	
	/** STORE DETAIL **/
	
	public function store_detail($lang = "", $store_id = "")
	{
		$data = $this->api->get_store_detail($store_id);
		if(count($data) > 0){
			foreach($data as $stores){
				$store_type = "";
				if($stores->store_type == 1){
					if($lang == "ar"){
						$store_type = "المتجر الرئيسي";
						} else {
						if($lang == "ar"){
						$store_type = "فرع";
						} else {
						$store_type = "Branch";
						}
						}
				}else{
					$store_type = "Branch";
				}
				if(file_exists(DOCROOT.'images/merchant/290_215/'.$stores->merchant_id.'_'.$stores->store_id.'.png')){
					$img_path = PATH.'images/merchant/290_215/'.$stores->merchant_id.'_'.$stores->store_id.'.png';
				}else{
					$img_path = PATH.'images/no-images.png';
				}
				if($lang == "ar"){
				$response[] = array("store_detail" => array("store_id" => $stores->store_id, "store_name" => $stores->store_name_arabic, "store_key" => $stores->store_key, "store_url_title" => $stores->store_url_title, "address1" => $stores->address1_arabic, "address2" => $stores->address2_arabic, "city_id" => $stores->city_id, "city_name" => $stores->city_name_arabic,"country_id" => $stores->country_id, "country_name" => $stores->country_name_arabic, "phone_number" => $stores->phone_number, "pincode"=>$stores->zipcode, "website" => $stores->website, "latitude" => $stores->latitude, "longitude" => $stores->longitude,  "store_type" => $store_type, "store_image" => $img_path));
				} else {
				$response[] = array("store_detail" => array("store_id" => $stores->store_id, "store_name" => ucfirst($stores->store_name), "store_key" => $stores->store_key, "store_url_title" => $stores->store_url_title, "address1" => $stores->address1, "address2" => $stores->address2, "city_id" => $stores->city_id, "city_name" => $stores->city_name, "country_id" => $stores->country_id, "country_name" => $stores->country_name,"phone_number" => $stores->phone_number, "pincode"=>$stores->zipcode, "website" => $stores->website, "latitude" => $stores->latitude, "longitude" => $stores->longitude,  "store_type" => $store_type, "store_image" => $img_path));
				}
			}
			$store_response["storedetails"] = $response;
			echo json_encode($store_response);
			exit;
		}else{
			 if($lang == "ar"){
					$response[] = array("store_detail" => array("httpCode" => 401 , "Message" => "لا مخازن المتاحة!" ));
					} else {
					$response[] = array("store_detail" => array("httpCode" => 401 , "Message" => "No stores available!" ));
					}
			$store_response["storedetails"] = $response;
			echo json_encode($store_response);
			exit;
		}
	}
	
	/** SIMILAR DEALS BY STORES **/
	
	public function similar_deals_by_store($lang= "", $store_id = "")
	{
		$data = $this->api->get_similar_deals_stores($store_id);
		if(count($data) > 0){
			foreach($data as $deals){
				if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1.png')){
					$image_path= PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png';
				}else{
					$image_path = PATH.'images/no-images.png';
				}
				 if($lang == "ar"){
				$response[] = array("similardealslist" => array("deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key, "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "startdate" => date('d-m-Y H:i:s', $deals->startdate),"max_user_limit" => $deals->user_limit_quantity,  "enddate" => date('d-m-Y H:i:s', $deals->enddate),"deal_savings" => $deals->deal_savings, "store_name" => $deals->store_name_arabic, "deal_category" => $deals->category_name_arabic, "image_url" => $image_path, "deal_description" => strip_tags($deals->deal_description_arabic),'currency_symbol' => CURRENCY_SYMBOL));
				} else {
				$response[] = array("similardealslist" => array("deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key, "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "startdate" => date('d-m-Y H:i:s', $deals->startdate),"max_user_limit" => $deals->user_limit_quantity,  "enddate" => date('d-m-Y H:i:s', $deals->enddate),"deal_savings" => $deals->deal_savings, "store_name" => ucfirst($deals->store_name), "deal_category" => $deals->category_name, "image_url" => $image_path, "deal_description" => strip_tags($deals->deal_description),'currency_symbol' => CURRENCY_SYMBOL));
				}
			}
			$today_deals_response["similardeallist"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}else{
		         if($lang == "ar"){
			$response[] = array("similardealslist" => array("httpCode" => 401 , "Message" => "لا صفقات مماثلة متاحة" ));
			} else {
			$response[] = array("similardealslist" => array("httpCode" => 401 , "Message" => "No similar deals available" ));
			}
			$today_deals_response["similardeallist"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
	}
	
	/** SIMILAR PRODUCT BY DEAL **/
	
	public function similar_product_by_deal($category_id = "", $city_id ="")
	{
		$data = $this->api->get_similar_product_by_deal($category_id, $city_id);
		if(count($data) > 0){
			foreach($data as $deals){
				if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_1.png')){
					$image_path= PATH .'images/products/1000_800/'.$deals->deal_key.'_1'.'.png';
				}else{
					$image_path = PATH.'images/no-images.png';
				}   
				$response[] = array("similarproductlist" => array("product_id" => $deals->deal_id, "product_title" => ucfirst($deals->deal_title), "product_url_title" => $deals->url_title, "product_key" => $deals->deal_key, "product_price" => $deals->deal_price, "product_value" => $deals->deal_value, "product_discount" => round($deals->deal_percentage), "product_savings" => $deals->deal_savings, "store_name" => ucfirst($deals->store_name), "product_category" => $deals->category_name, "city_name" => $deals->city_name,"city_id" => $deals->city_id,"image_url" => $image_path, "product_description" => strip_tags($deals->deal_description), "terms_conditions" => $deals->terms_conditions, 'currency_symbol' => CURRENCY_SYMBOL,"user_limit_quantity" => $deals->user_limit_quantity,"purchase_count" => $deals->purchase_count));
			}
			$today_deals_response["similarproductlistproducts"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}else{
			$response[] = array("similarproductlist" => array("httpCode" => 401 , "Message" => "No similar product available" ));
			$today_deals_response["similarproductlistproducts"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
	}

	/** SIMILAR DEALS BY DEALS **/
	
	public function similar_deals_by_deals($lang = "" , $deal_id = "", $category_id = "", $city_id ="")
	{
	    
		$data = $this->api->get_similar_deals_by_deals($deal_id, $category_id, $city_id);
		if(count($data) > 0){
			foreach($data as $deals){
				if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1.png')){
					$image_path=PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png';
				}else{
					$image_path = PATH.'images/no-images.png';
				}
				if($lang == "ar"){	
				$response[] = array("similardealslist" => array("deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key, "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate),"deal_savings" => $deals->deal_savings, "store_name" => $deals->store_name_arabic, "deal_category" => $deals->category_name_arabic, "image_url" => $image_path, "deal_description" => strip_tags($deals->deal_description_arabic), 'currency_symbol' => CURRENCY_SYMBOL));
				} else {
				$response[] = array("similardealslist" => array("deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key, "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate),"deal_savings" => $deals->deal_savings, "store_name" => ucfirst($deals->store_name), "deal_category" => $deals->category_name, "image_url" => $image_path, "deal_description" => strip_tags($deals->deal_description), 'currency_symbol' => CURRENCY_SYMBOL));
				}
			}
			$today_deals_response["similardeallistdeals"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}else{
		        if($lang == "ar"){	
			$response[] = array("similardealslist" => array("httpCode" => 401 , "Message" => "لا صفقات مماثلة متاحة" ));
			} else { 
			$response[] = array("similardealslist" => array("httpCode" => 401 , "Message" => "No similar deals available" ));
			}
			$today_deals_response["similardeallistdeals"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
	}

	/** SIMILAR PRODUCT BY STORES **/
	
	public function similar_product_by_products($lang = "" ,$deal_id = "", $category_id = "", $city_id ="")
	{
		$data = $this->api->get_similar_product_by_products($deal_id, $category_id, $city_id);
		if(count($data) > 0){
			foreach($data as $deals){
				if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_1.png')){
					$image_path= PATH .'images/products/1000_800/'.$deals->deal_key.'_1'.'.png';
				}else{
					$image_path = PATH.'images/no-images.png';
				}   
				if($lang == "ar"){	
				$response[] = array("similarproductlist" => array("product_id" => $deals->deal_id, "product_title" => $deals->deal_title_arabic, "product_url_title" => $deals->url_title, "product_key" => $deals->deal_key, "product_price" => $deals->deal_price, "product_value" => $deals->deal_value, "product_discount" => round($deals->deal_percentage), "product_savings" => $deals->deal_savings, "store_name" => $deals->store_name_arabic, "product_category" => $deals->category_name_arabic, "image_url" => $image_path, 'currency_symbol' => CURRENCY_SYMBOL,"user_limit_quantity" => $deals->user_limit_quantity,"purchase_count" => $deals->purchase_count));
				} else {
				$response[] = array("similarproductlist" => array("product_id" => $deals->deal_id, "product_title" => ucfirst($deals->deal_title), "product_url_title" => $deals->url_title, "product_key" => $deals->deal_key, "product_price" => $deals->deal_price, "product_value" => $deals->deal_value, "product_discount" => round($deals->deal_percentage), "product_savings" => $deals->deal_savings, "store_name" => ucfirst($deals->store_name), "product_category" => $deals->category_name, "image_url" => $image_path, 'currency_symbol' => CURRENCY_SYMBOL,"user_limit_quantity" => $deals->user_limit_quantity,"purchase_count" => $deals->purchase_count));
				}
			}
			$today_deals_response["similarproductlistproducts"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}else{
		        if($lang == "ar"){	
			$response[] = array("similarproductlist" => array("httpCode" => 401 , "Message" => "أي منتج مماثل متاح" ));
			} else {
			$response[] = array("similarproductlist" => array("httpCode" => 401 , "Message" => "No similar product available" ));
			}
			$today_deals_response["similarproductlistproducts"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
	}
	
	/** SIMILAR PRODUCT BY STORES **/
	
	public function similar_deals_by_product($category_id = "", $city_id ="")
	{ 
		$data = $this->api->get_similar_deals_by_product($category_id, $city_id);
		if(count($data) > 0){
			foreach($data as $deals){
				if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1.png')){
					$image_path=PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png';
				}else{
					$image_path = PATH.'images/no-images.png';
				}
				$response[] = array("similardealslist_product" => array("deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key, "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate),"deal_savings" => $deals->deal_savings, "store_name" => ucfirst($deals->store_name), "deal_category" => $deals->category_name, "image_url" => $image_path, "deal_description" => strip_tags($deals->deal_description), 'currency_symbol' => CURRENCY_SYMBOL));
			}
			$today_deals_response["similardealslistproduct"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}else{
			$response[] = array("similardealslist_product" => array("httpCode" => 401 , "Message" => "No similar deals available" ));
			$today_deals_response["similardealslistproduct"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
	}
	
	
	/** SIMILAR PRODUCT BY PRODUCTS **/
	
	public function similar_product_by_store($lang= "", $store_id = "")
	{
		$data = $this->api->get_similar_product_stores($store_id);
		if(count($data) > 0){
			foreach($data as $deals){
				if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_1.png')){
					$image_path=PATH .'images/products/1000_800/'.$deals->deal_key.'_1'.'.png';
				}else{
					$image_path = PATH.'images/no-images.png';
				}
				if($lang == "ar"){
				$response[] = array("similarproductlist" => array("product_id" => $deals->deal_id, "product_title" => $deals->deal_title_arabic, "product_url_title" => $deals->url_title, "product_key" => $deals->deal_key, "product_price" => $deals->deal_price, "product_value" => $deals->deal_value, "product_discount" => round($deals->deal_percentage), "product_savings" => $deals->deal_savings, "store_name" => $deals->store_name_arabic, "product_category" => $deals->category_name_arabic, "image_url" => $image_path, "product_description" => strip_tags($deals->deal_description_arabic), "terms_conditions" => $deals->terms_conditions, 'currency_symbol' => CURRENCY_SYMBOL,"user_limit_quantity" => $deals->user_limit_quantity,"purchase_count" => $deals->purchase_count));
				} else {
				$response[] = array("similarproductlist" => array("product_id" => $deals->deal_id, "product_title" => ucfirst($deals->deal_title), "product_url_title" => $deals->url_title, "product_key" => $deals->deal_key, "product_price" => $deals->deal_price, "product_value" => $deals->deal_value, "product_discount" => round($deals->deal_percentage), "product_savings" => $deals->deal_savings, "store_name" => ucfirst($deals->store_name), "product_category" => $deals->category_name, "image_url" => $image_path, "product_description" => strip_tags($deals->deal_description), "terms_conditions" => $deals->terms_conditions, 'currency_symbol' => CURRENCY_SYMBOL,"user_limit_quantity" => $deals->user_limit_quantity,"purchase_count" => $deals->purchase_count));
				}
			}
			$today_deals_response["similarproductliststore"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}else{
		        if($lang == "ar"){
			$response[] = array("similarproductlist" => array("httpCode" => 401 , "Message" => "أي منتج مماثل متاح" ));
			} else {
			$response[] = array("similarproductlist" => array("httpCode" => 401 , "Message" => "No similar product available" ));
			}
			$today_deals_response["similarproductliststore"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
		
	}
	
	/** PRODUCTS LISTING **/
	
	public function product_listing($lang = "", $city_id = "", $search = "")
	{
		if($this->product_setting){
			$data = $this->api->get_today_product($city_id, $search);
			if(count($data) > 0){
				foreach($data as $deals){
					if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_1.png')){
						$image_path=PATH .'images/products/1000_800/'.$deals->deal_key.'_1'.'.png';
					}else{
						$image_path = PATH.'images/no-images.png';
					}
					if($lang == "ar"){
					$response[] = array("product_list" => array("httpCode" => 200 , "Message" => "المنتجات المتاحة","deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"purchase_count" => $deals->purchase_count,"user_limit_quantity" => $deals->user_limit_quantity, "store_name" => $deals->store_name_arabic, "deal_category" => $deals->category_name_arabic,"latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name_arabic,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL));
					} else {
					$response[] = array("product_list" => array("httpCode" => 200 , "Message" => "Product available","deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"purchase_count" => $deals->purchase_count,"user_limit_quantity" => $deals->user_limit_quantity, "store_name" => ucfirst($deals->store_name), "deal_category" => $deals->category_name,"latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL));
					}
				}
				$today_deals_response["productlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}else{
			        if($lang == "ar"){	
				$response[] = array("product_list" => array("httpCode" => 401 , "Message" => "أي منتج متاح" ));
				} else {
				$response[] = array("product_list" => array("httpCode" => 401 , "Message" => "No product available" ));
				}
				$today_deals_response["productlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}
		}
		        if($lang == "ar"){	
			$response[] = array("product_list" => array("httpCode" => 400 , "Message" => "وحدة المنتج تعطيل من قبل المشرف!" ));
			} else {
			$response[] = array("product_list" => array("httpCode" => 400 , "Message" => "Product module disabled by admin!" ));
			}
			$today_deals_response["productlist"] = $response;
			echo json_encode($today_deals_response);
			exit;		
	}
	
	/** HOT PRODUCTS LISTING **/
	
	public function hot_product_listing($lang = "", $type_view="", $city_id = "")
	{
		if($this->product_setting){
			if($type_view == "hot"){
			        $data = $this->api->get_hot_today_product($city_id);
			} else {
			        $data = $this->api->get_mostview_today_product($city_id);
			}
			if(count($data) > 0){
				foreach($data as $deals){
					if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_1.png')){
						$image_path= PATH .'images/products/1000_800/'.$deals->deal_key.'_1'.'.png';
					}else{
						$image_path = PATH.'images/no-images.png';
					}
					if($lang == "ar"){
					$response[] = array("product_list" => array("httpCode" => 200 , "Message" => "المنتجات المتاحة","deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"purchase_count" => $deals->purchase_count,"user_limit_quantity" => $deals->user_limit_quantity, "store_name" => $deals->store_name_arabic, "deal_category" => $deals->category_name_arabic,"latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name_arabic,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL));
					} else {
					$response[] = array("product_list" => array("httpCode" => 200 , "Message" => "Product available","deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"purchase_count" => $deals->purchase_count,"user_limit_quantity" => $deals->user_limit_quantity, "store_name" => ucfirst($deals->store_name), "deal_category" => $deals->category_name,"latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL));
					}
				}
				$today_deals_response["productlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}else{
			        if($lang == "ar"){
				$response[] = array("product_list" => array("httpCode" => 401 , "Message" => "أي منتج متاح" ));
				} else {
				$response[] = array("product_list" => array("httpCode" => 401 , "Message" => "No product available" ));
				}
				$today_deals_response["productlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}
		}
		        if($lang == "ar"){
			$response[] = array("product_list" => array("httpCode" => 400 , "Message" => "وحدة المنتج تعطيل من قبل المشرف!" ));
			} else { 
			$response[] = array("product_list" => array("httpCode" => 401 , "Message" => "No product available" ));
			}
			$today_deals_response["productlist"] = $response;
			echo json_encode($today_deals_response);
			exit;
	}
	
	/** PRODUCT DETAILS **/
	
	public function product_details($lang= "", $deal_id = "", $deal_key = "", $device_number = "")
	{
		$data = $this->api->get_product_details($deal_id,$deal_key,$device_number);
		if(count($data) > 0){
			foreach($data as $deals){
				$this->product_size = $this->api->get_product_one_size($deals->deal_id);
				$avg_rating =$this->api->get_average_rating($deal_id,2);
					 foreach($this->product_size as $size){  
						 if($size->size_name!="None"){
						        if($lang == "ar"){
							$sizes[] = array("size_list" =>array("size_id" =>$size->size_id,"size_name" =>$size->size_arabic,"quantity" =>$size->quantity,"size_count" => 1));
							} else {
							$sizes[] = array("size_list" =>array("size_id" =>$size->size_id,"size_name" =>$size->size_name,"quantity" =>$size->quantity,"size_count" => 1));
							}
							$size_count = 1;
						}
						else{
						
						        if($lang == "ar"){
							$sizes[] = array("size_list" => array("size" =>"لم يكن حجم","size_name" => "لم يكن حجم","quantity" =>$size->quantity,"size_id" =>$size->size_id,"size_count" => 0));
							} else {
							$sizes[] = array("size_list" => array("size" =>"no size","size_name" => "No size","quantity" =>$size->quantity,"size_id" =>$size->size_id,"size_count" => 0));
							}
							
							$size_count = 0;
						}
					} 
					if($deals->color==1){
						$this->product_color = $this->api->get_product_color($deals->deal_id);	
						foreach($this->product_color as $color){  
							$colors[] = array("colors_list" => array("color_code_id" =>$color->color_code_id,"color_code_name" =>$color->color_code_name,"color_code" =>$color->color_name,"color_count" => 1));
							$color_count = 1;
						} 
					}
					else{
						$colors[] = array("colors_list" => array("colors" =>"no value","color_count" => 0));
						$color_count = 0;
					 }
					 
					$this->delivery_policy = $this->api->get_product_delivery_policy($deals->deal_id);
					 if(count($this->delivery_policy)>=1){
						foreach($this->delivery_policy as $delivery){  
							$delivery_policy[] = array("delivery_policy" => array("policy_text" =>$delivery->text));
						} 
					}
					else{
						$delivery_policy[] = array("delivery_policy" => array("policy_text" =>"No value"));
					 }
					 
			        $con=0;   
                                for($i=1; $i<=10; $i++){
				   
                                    if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_'.$i.'.png')) { 
                                        $con=$con+1; 
                                    } 
                                 }
				if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_1.png')){
				        $image_path = "";
				        
				    for($i=1; $i<=$con; $i++){ 
					        $image_path .=PATH .'images/products/1000_800/'.$deals->deal_key.'_'.$i.'.png'.',';
					    }
					    $image_path = substr($image_path,0,-1);
				}else{
					$image_path  = PATH.'images/no-images.png';
				}
				
				
				if(file_exists(DOCROOT.'images/merchant/290_215/'.$deals->merchant_id.'_'.$deals->store_id.'.png')){
					$img_path = PATH.'images/merchant/290_215/'.$deals->merchant_id.'_'.$deals->store_id.'.png';
				}else{
					$img_path = PATH.'images/no-images.png';
				}
				
				if($deals->shipping  == 1){
					$total_shipping = 0;
				}elseif($deals->shipping  == 2){
					$merchant_flat_amount = $this->api->get_userflat_amount($deals->merchant_id);
					$total_shipping = $merchant_flat_amount->flat_amount;
				} elseif($deals->shipping == 3){
					$total_shipping =$deals->shipping_amount;
				} elseif($deals->shipping  == 4){
					$total_shipping =$deals->shipping_amount;
				}
				
				$social_share = PATH.'product/'.$deals->deal_key.'/'.$deals->url_title.'.html';
				if($lang == "ar"){
				$response[] = array("product_details" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id,"deal_key" => $deals->deal_key, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "image_url" => $image_path, "store_id" => $deals->store_id, "store_image_url" => $img_path,"deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"shipping_amount" => $total_shipping,"shipping_method" => $deals->shipping,"tax_percentage" =>TAX_PRECENTAGE_VALUE, "category" => $deals->category_name_arabic,"user_limit_quantity" => $deals->user_limit_quantity, "category_id" => $deals->category_id,"description" => $deals->deal_description_arabic,  "purchase_count" => $deals->purchase_count,  "store_name" => $deals->store_name_arabic, "store_address" => $deals->addr1.','.$deals->addr2, "city_id" => $deals->city_id, "store_city_name" => $deals->city_name_arabic,  "store_phone_number" => $deals->phone, "store_website" => $deals->website, "store_latitude" => $deals->latitude, "store_longitude" => $deals->longitude, "social_share" => $social_share, 'currency_symbol' => CURRENCY_SYMBOL,'average_rating' =>$avg_rating,"comment_type" =>2,"sizes" =>$sizes,"colors" =>$colors,"size_count" => $size_count,"color_count" => $color_count,"delivery_policy" => $delivery_policy));
				} else { 
				$response[] = array("product_details" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id,"deal_key" => $deals->deal_key, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "image_url" => $image_path, "store_id" => $deals->store_id, "store_image_url" => $img_path,"deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"shipping_amount" => $total_shipping,"shipping_method" => $deals->shipping,"tax_percentage" =>TAX_PRECENTAGE_VALUE, "category" => $deals->category_name,"user_limit_quantity" => $deals->user_limit_quantity, "category_id" => $deals->category_id,"description" => $deals->deal_description,  "purchase_count" => $deals->purchase_count,  "store_name" => ucfirst($deals->store_name), "store_address" => $deals->addr1.','.$deals->addr2, "city_id" => $deals->city_id, "store_city_name" => $deals->city_name,  "store_phone_number" => $deals->phone, "store_website" => $deals->website, "store_latitude" => $deals->latitude, "store_longitude" => $deals->longitude, "social_share" => $social_share, 'currency_symbol' => CURRENCY_SYMBOL,'average_rating' =>$avg_rating,"comment_type" =>2,"sizes" =>$sizes,"colors" =>$colors,"size_count" => $size_count,"color_count" => $color_count,"delivery_policy" => $delivery_policy));
				}
			}
			$deal_detail_response["productdetail"] = $response;
			echo json_encode($deal_detail_response);
			exit;
		}else{
		         if($lang == "ar"){
			$response[] = array("product_details" => array("httpCode" => 401 , "Message" => "وحدة المنتج تعطيل من قبل المشرف!" ));
			} else { 
			$response[] = array("product_details" => array("httpCode" => 401 , "Message" => "No product available" ));
			}
			$deal_detail_response["productdetail"] = $response;
			echo json_encode($deal_detail_response);
			exit;
		}
		
	}
	
	/** COMPARISON PRODUCT DETAILS **/
	
	public function comparison_product_details($lang= "", $deal_id = "", $deal_key = "", $sec_deal_id = "", $sec_deal_key = "")
	{
                
		
		if(($deal_id) &&($sec_deal_id)){
		        $data = $this->api->get_product_details($deal_id,$deal_key);
		        if(count($data) > 0){
		       
			foreach($data as $deals){
				$this->product_size = $this->api->get_product_one_size($deals->deal_id);
				$avg_rating =$this->api->get_average_rating($deal_id,2);
					 foreach($this->product_size as $size){  
						 if($size->size_name!="None"){
							if($lang == "ar"){
							$sizes[] = array("size_list" =>array("size_id" =>$size->size_id,"size_name" =>$size->size_arabic,"quantity" =>$size->quantity,"size_count" => 1));
							} else {
							$sizes[] = array("size_list" =>array("size_id" =>$size->size_id,"size_name" =>$size->size_name,"quantity" =>$size->quantity,"size_count" => 1));
							}
							$size_count = 1;
						}
						else{
						        if($lang == "ar"){
							$sizes[] = array("size_list" => array("size" =>"لم يكن حجم","size_name" => "لم يكن حجم","quantity" =>$size->quantity,"size_id" =>$size->size_id,"size_count" => 0));
							} else {
							$sizes[] = array("size_list" => array("size" =>"no size","size_name" => "No size","quantity" =>$size->quantity,"size_id" =>$size->size_id,"size_count" => 0));
							}
							$size_count = 0;
						}
					} 
					if($deals->color==1){
						$this->product_color = $this->api->get_product_color($deals->deal_id);	
						foreach($this->product_color as $color){  
							$colors[] = array("colors_list" => array("color_code_id" =>$color->color_code_id,"color_code_name" =>$color->color_code_name,"color_code" =>$color->color_name,"color_count" => 1));
							$color_count = 1;
						} 
					}
					else{
					         if($lang == "ar"){
						$colors[] = array("colors_list" => array("colors" =>"لا قيمة","color_count" => 0));
						} else {
						$colors[] = array("colors_list" => array("colors" =>"No value","color_count" => 0));
						}
						$color_count = 0;
					 }
					 
				$attribute_groups= $this->api->getProductAttributes($deals->deal_id, $lang);

				$attribute_data = array();

				 foreach ($attribute_groups as $attribute_group) {
					foreach ($attribute_group['attribute'] as $attribute) {
						$attribute_data[] = array("specification" => array("specification_name" =>$attribute['name'] ." - ". $attribute['text']));
					}
				}
					$this->delivery_policy = $this->api->get_product_delivery_policy($deals->deal_id);
					 if(count($this->delivery_policy)>=1){
						foreach($this->delivery_policy as $delivery){  
							$delivery_policy[] = array("delivery_policy" => array("policy_text" =>$delivery->text));
						} 
					}
					else{
					         if($lang == "ar"){
						$delivery_policy[] = array("delivery_policy" => array("policy_text" =>"لا قيمة"));
						} else {
						$delivery_policy[] = array("delivery_policy" => array("policy_text" =>"No value"));
						}
					 }
			        $con=0; 
                                for($i=1; $i<=10; $i++){ 
                                    if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_'.$i.'.png')) { 
                                        $con=$con+1; 
                                    } 
                                 }
				if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_1.png')){
				        $image_path = $image_path1 ="";
				        
				    for($i=1; $i<=$con; $i++){ 
					         $image_path .=PATH .'images/products/1000_800/'.$deals->deal_key.'_'.$i.'.png'.',';
					    }
					    $image_path = substr($image_path,0,-1);
				}else{
					$image_path = $image_path1 = PATH.'images/no-images.png';
				}
				if(file_exists(DOCROOT.'images/merchant/290_215/'.$deals->merchant_id.'_'.$deals->store_id.'.png')){
					$img_path = PATH.'images/merchant/290_215/'.$deals->merchant_id.'_'.$deals->store_id.'.png';
				}else{
					$img_path = PATH.'images/no-images.png';
				}
				$social_share = PATH.'product/'.$deals->deal_key.'/'.$deals->url_title.'.html';
				 if($lang == "ar"){
				$response[] = array("product_details" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id,"deal_key" => $deals->deal_key, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "image_url" => $image_path, "store_id" => $deals->store_id, "store_image_url" => $img_path,"deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"shipping_amount" => $deals->shipping_amount,"tax_percentage" =>TAX_PRECENTAGE_VALUE, "category" => $deals->category_name_arabic,"user_limit_quantity" => $deals->user_limit_quantity, "category_id" => $deals->category_id,"description" => strip_tags($deals->deal_description_arabic),  "purchase_count" => $deals->purchase_count,  "store_name" => $deals->store_name_arabic, "store_address" => $deals->address1_arabic.','.$deals->address2_arabic, "city_id" => $deals->city_id, "store_city_name" => $deals->city_name_arabic,  "store_phone_number" => $deals->phone, "store_website" => $deals->website, "store_latitude" => $deals->latitude, "store_longitude" => $deals->longitude, "social_share" => $social_share, 'currency_symbol' => CURRENCY_SYMBOL,'average_rating' =>$avg_rating,"comment_type" =>2,"sizes" =>$sizes,"colors" =>$colors,"size_count" => $size_count,"color_count" => $color_count,"delivery_policy" => $delivery_policy,"specification"=> $attribute_data));
				} else {
				$response[] = array("product_details" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id,"deal_key" => $deals->deal_key, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "image_url" => $image_path, "store_id" => $deals->store_id, "store_image_url" => $img_path,"deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"shipping_amount" => $deals->shipping_amount,"tax_percentage" =>TAX_PRECENTAGE_VALUE, "category" => $deals->category_name,"user_limit_quantity" => $deals->user_limit_quantity, "category_id" => $deals->category_id,"description" => strip_tags($deals->deal_description),  "purchase_count" => $deals->purchase_count,  "store_name" => ucfirst($deals->store_name), "store_address" => $deals->address1.','.$deals->address2, "city_id" => $deals->city_id, "store_city_name" => $deals->city_name,  "store_phone_number" => $deals->phone, "store_website" => $deals->website, "store_latitude" => $deals->latitude, "store_longitude" => $deals->longitude, "social_share" => $social_share, 'currency_symbol' => CURRENCY_SYMBOL,'average_rating' =>$avg_rating,"comment_type" =>2,"sizes" =>$sizes,"colors" =>$colors,"size_count" => $size_count,"color_count" => $color_count,"delivery_policy" => $delivery_policy,"specification"=> $attribute_data));
				}
			}
			} else {
			 if($lang == "ar"){
			$response = array("response" => array("httpCode" => 401 , "Message" => "أي منتج متاح" ));
			} else {
			$response = array("response" => array("httpCode" => 401 , "Message" => "No product available" ));
			}
			echo json_encode($response);
			exit;
			}
			
			$sec_data = $this->api->get_product_details($sec_deal_id,$sec_deal_key);
			if(count($sec_data) > 0){
			foreach($sec_data as $sec_deals){
				$this->product_size_sec = $this->api->get_product_one_size($sec_deals->deal_id);
				$avg_rating_sec =$this->api->get_average_rating($sec_deal_id,2);
					 foreach($this->product_size_sec as $size_sec){  
						 if($size_sec->size_name!="None"){
							if($lang == "ar"){
							$sizes_sec[] = array("size_list" =>array("size_id" =>$size_sec->size_id,"size_name" =>$size_sec->size_arabic,"quantity" =>$size_sec->quantity,"size_count" => 1));
							} else {
							$sizes_sec[] = array("size_list" =>array("size_id" =>$size_sec->size_id,"size_name" =>$size_sec->size_name,"quantity" =>$size_sec->quantity, "size_count" => 1));
							}
							$size_count = 1;
						}
						else{
						         if($lang == "ar"){
							$sizes_sec[] = array("size_list" => array("size" =>"لم يكن حجم","size_name" => "لم يكن حجم","quantity" =>$size->quantity,"size_id" =>$size->size_id,"size_count" => 0));
							} else {
							$sizes_sec[] = array("size_list" => array("size" =>"no size","size_name" => "No size","quantity" =>$size->quantity,"size_id" =>$size->size_id,"size_count" => 0));
							}
							$size_count = 0;
						}
					} 
					if($sec_deals->color==1){
						$this->product_color_sec = $this->api->get_product_color($sec_deals->deal_id);	
						foreach($this->product_color_sec as $color_sec){  
							$colors_sec[] = array("colors_list" => array("color_code_id" =>$color_sec->color_code_id,"color_code_name" =>$color_sec->color_code_name,"color_code" =>$color_sec->color_name,"color_count" => 1));
							$color_count = 1;
						} 
					}
					else{
					         if($lang == "ar"){
						$colors_sec[] = array("colors_list" => array("colors" =>"لا قيمة","color_count" => 0));
						} else {
						$colors_sec[] = array("colors_list" => array("colors" =>"No value","color_count" => 0));
						}
						$color_count = 0;
					 }
					 
					 $attribute_groupssec = $this->api->getProductAttributes($sec_deals->deal_id, $lang);

				$attribute_datasec = array();

				 foreach ($attribute_groupssec as $attribute_group) {
					foreach ($attribute_group['attribute'] as $attribute) {
						$attribute_datasec[] = array("specification" => array("specification_name" =>$attribute['name'] ." - ". $attribute['text']));
					}
				}
				
					$this->delivery_policy_sec = $this->api->get_product_delivery_policy($sec_deals->deal_id);
					 if(count($this->delivery_policy_sec)>=1){
						foreach($this->delivery_policy_sec as $delivery_new_sec){  
							$delivery_policy_sec[] = array("delivery_policy" => array("policy_text" =>$delivery_new_sec->text));
						} 
					}
					else{
					         if($lang == "ar"){
						$delivery_policy_sec[] = array("delivery_policy" => array("policy_text" =>"لا قيمة"));
						} else {
						$delivery_policy_sec[] = array("delivery_policy" => array("policy_text" =>"No value"));
						}
					 }
					 
			        $con=0; 
                                for($i=1; $i<=10; $i++){ 
                                    if(file_exists(DOCROOT.'images/products/1000_800/'.$sec_deals->deal_key.'_'.$i.'.png')) { 
                                        $con=$con+1; 
                                    } 
                                 }
				if(file_exists(DOCROOT.'images/products/1000_800/'.$sec_deals->deal_key.'_1.png')){
				        $image_path = $image_path1 ="";
				        
				    for($i=1; $i<=$con; $i++){ 
					         $image_path .= PATH .'images/products/1000_800/'.$sec_deals->deal_key.'_'.$i.'.png'.',';
					    }
					   
					    $image_path = substr($image_path,0,-1);
				}else{
					$image_path = $image_path1 = PATH.'images/no-images.png';
				}
				
				
				if(file_exists(DOCROOT.'images/merchant/290_215/'.$sec_deals->merchant_id.'_'.$sec_deals->store_id.'.png')){
					$img_path = PATH.'images/merchant/290_215/'.$sec_deals->merchant_id.'_'.$sec_deals->store_id.'.png';
				}else{
					$img_path = PATH.'images/no-images.png';
				}
				
				$social_share = PATH.'product/'.$sec_deals->deal_key.'/'.$sec_deals->url_title.'.html';
				 if($lang == "ar"){
				$response2[] = array("product_details2" => array("httpCode" => 200 ,"deal_id" => $sec_deals->deal_id,"deal_key" => $sec_deals->deal_key, "deal_title" => $sec_deals->deal_title_arabic, "deal_url_title" => $sec_deals->url_title, "image_url" => $image_path, "store_id" => $sec_deals->store_id, "store_image_url" => $img_path,"deal_price" => $sec_deals->deal_price, "deal_value" => $sec_deals->deal_value, "deal_discount" => round($sec_deals->deal_percentage), "deal_savings" => $sec_deals->deal_savings,"shipping_amount" => $sec_deals->shipping_amount,"tax_percentage" =>TAX_PRECENTAGE_VALUE, "category" => $sec_deals->category_name_arabic,"user_limit_quantity" => $sec_deals->user_limit_quantity, "category_id" => $sec_deals->category_id,"description" => strip_tags($sec_deals->deal_description_arabic),  "purchase_count" => $sec_deals->purchase_count,  "store_name" => $sec_deals->store_name_arabic, "store_address" => $sec_deals->address1_arabic.','.$sec_deals->address2_arabic, "city_id" => $sec_deals->city_id, "store_city_name" => $sec_deals->city_name_arabic,  "store_phone_number" => $sec_deals->phone, "store_website" => $sec_deals->website, "store_latitude" => $sec_deals->latitude, "store_longitude" => $sec_deals->longitude, "social_share" => $social_share, 'currency_symbol' => CURRENCY_SYMBOL,'average_rating' =>$avg_rating_sec,"comment_type" =>2,"sizes" =>$sizes_sec,"colors" =>$colors_sec,"size_count" => $size_count,"color_count" => $color_count,"delivery_policy" => $delivery_policy_sec,"specification"=> $attribute_datasec));
				} else {
				$response2[] = array("product_details2" => array("httpCode" => 200 ,"deal_id" => $sec_deals->deal_id,"deal_key" => $sec_deals->deal_key, "deal_title" => ucfirst($sec_deals->deal_title), "deal_url_title" => $sec_deals->url_title, "image_url" => $image_path, "store_id" => $sec_deals->store_id, "store_image_url" => $img_path,"deal_price" => $sec_deals->deal_price, "deal_value" => $sec_deals->deal_value, "deal_discount" => round($sec_deals->deal_percentage), "deal_savings" => $sec_deals->deal_savings,"shipping_amount" => $sec_deals->shipping_amount,"tax_percentage" =>TAX_PRECENTAGE_VALUE, "category" => $sec_deals->category_name,"user_limit_quantity" => $sec_deals->user_limit_quantity, "category_id" => $sec_deals->category_id,"description" => strip_tags($sec_deals->deal_description),  "purchase_count" => $sec_deals->purchase_count,  "store_name" => ucfirst($sec_deals->store_name), "store_address" => $sec_deals->address1.','.$sec_deals->address2, "city_id" => $sec_deals->city_id, "store_city_name" => $sec_deals->city_name,  "store_phone_number" => $sec_deals->phone, "store_website" => $sec_deals->website, "store_latitude" => $sec_deals->latitude, "store_longitude" => $sec_deals->longitude, "social_share" => $social_share, 'currency_symbol' => CURRENCY_SYMBOL,'average_rating' =>$avg_rating_sec,"comment_type" =>2,"sizes" =>$sizes_sec,"colors" =>$colors_sec,"size_count" => $size_count,"color_count" => $color_count,"delivery_policy" => $delivery_policy_sec,"specification"=> $attribute_datasec));
				}
			}
			
			} else {
			 if($lang == "ar"){
			$response[] = array("response" => array("httpCode" => 401 , "Message" => "أي منتج متاح" ));
			} else {
			$response[] = array("response" => array("httpCode" => 401 , "Message" => "No product available" ));
			}
			$deal_detail_response["comparisonproductdetail"] = $response;
			echo json_encode($deal_detail_response);
			exit;
			}
			
			$deal_detail_response["comparisonproductdetail"] = array_merge($response,$response2);
			echo json_encode($deal_detail_response);
			exit;
			
		}else{
		         if($lang == "ar"){
			$response[] = array("response" => array("httpCode" => 401 , "Message" => "لا مجال للمقارنة المنتجات المتاحة" ));
			} else {
			$response[] = array("response" => array("httpCode" => 401 , "Message" => "No product comparison available" ));
			}
			$deal_detail_response["comparisonproductdetail"] = $response;
			echo json_encode($deal_detail_response);
			exit;
		}
		
	}
	
	public function size_list($deal_id = "")
	{
		$this->product_size = $this->api->get_product_one_size($deal_id);
		 foreach($this->product_size as $size){  
			 if($size->size_name!="None"){
				$sizes[] = array("size_list" =>array("size_id" =>$size->size_id,"size_name" =>$size->size_name,"quantity" =>$size->quantity,"size_count" => 1));
				$size_count = 1;
			}
			else{
				$sizes[] = array("size_list" => array("size" =>"no size","size_name" => "no size","quantity" =>$size->quantity,"size_id" =>$size->size_id,"size_count" => 0));
				$size_count = 0;
			}
		}
			//$response[] = array("sizes" => $sizes );
			$deal_detail_response["sizelist"] = $sizes;
			echo json_encode($deal_detail_response);
			exit; 
		
	}
	
	public function color_list($deal_id = "")
	{
		$color = $this->api->get_color_type($deal_id);
		if($color == 1){
			$this->product_color = $this->api->get_product_color($deal_id);	
			foreach($this->product_color as $color){  
				$colors[] = array("colors_list" => array("color_code_id" =>$color->color_code_id,"color_code_name" =>$color->color_code_name,"color_code" =>$color->color_name,"color_count" => 1));
				$color_count = 1;
			} 
		}
		else{
			$colors[] = array("colors_list" => array("colors" =>"no value","color_count" => 0));
			$color_count = 0;
		 }
			$deal_detail_response["colorlist"] = $colors;
			echo json_encode($deal_detail_response);
			exit; 
	}
	
	public function store_list_details($page = "" )
	{		
		$this->store_details_count = $this->api->get_user_bought($page);
		url::redirect(PATH);
		
	}
	
	/** PRODUCTS CATEGORY LISTING **/
	
	public function products_category_listing($lang= "",$type = "", $category_id = "",$city_id = "")
	{
		if($this->product_setting){
			$data = $this->api->get_category_product($type,$category_id,$city_id);
			if(count($data) > 0){
				foreach($data as $deals){
					if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_1.png')){
						$image_path= PATH .'images/products/1000_800/'.$deals->deal_key.'_1'.'.png';
					}else{
						$image_path = PATH.'images/no-images.png';
					}
					
					if($type == "5"){					
					        if($lang == "ar"){
					                $category_name = "آخرون";
					        } else {
					                 $category_name = "Others";
					        }					
					        } else {					
					        if($lang == "ar"){
					                $category_name = $deals->category_name_arabic;
					        } else {
					                 $category_name = $deals->category_name;
					        }					
					}
					
					  if($lang == "ar"){
					$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "المنتجات المتاحة","deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"purchase_count" => $deals->purchase_count,"user_limit_quantity" => $deals->user_limit_quantity, "store_name" => $deals->store_name_arabic, "deal_category" => $category_name,"latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path,"city_id" => $deals->city_id, 'currency_symbol' => CURRENCY_SYMBOL));
					} else {
					$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "Product available","deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"purchase_count" => $deals->purchase_count,"user_limit_quantity" => $deals->user_limit_quantity, "store_name" => ucfirst($deals->store_name), "deal_category" => $category_name,"latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path,"city_id" => $deals->city_id, 'currency_symbol' => CURRENCY_SYMBOL));
					}
				}
				$today_deals_response["productcategorylist"] = $response;
				echo json_encode($today_deals_response);

				exit;
			}else{
			          if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "أي منتج متاح" ));
				} else {
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "No product available" ));
				}
				$today_deals_response["productcategorylist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}
		}
		          if($lang == "ar"){
			$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "وحدة المنتج تعطيل من قبل المشرف!" ));
			} else {
			$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "Product module disabled by admin!" ));
			}
			$today_deals_response["productcategorylist"] = $response;
			echo json_encode($today_deals_response);
			exit;
		
	}
	
	
	
	/** PRODUCTS FILTER LISTING **/
	
	public function filter_products($lang= "", $category_id = "", $color = "", $size = "", $price = "", $discount = "", $city_id = "")
	{
		if($this->product_setting){
			$data = $this->api->get_filter_product($category_id,$color,$size,$price,$discount,$city_id);
			if(count($data) > 0){
				foreach($data as $deals){
					if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_1.png')){
						$image_path= PATH .'images/products/1000_800/'.$deals->deal_key.'_1'.'.png';
					}else{
						$image_path = PATH.'images/no-images.png';
					}
					  if($lang == "ar"){
					$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "المنتجات المتاحة","deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"purchase_count" => $deals->purchase_count,"user_limit_quantity" => $deals->user_limit_quantity, "store_name" => $deals->store_name_arabic, "deal_category" => $deals->category_name_arabic,"latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path,"city_id" => $deals->city_id, 'currency_symbol' => CURRENCY_SYMBOL));
					} else {
					$response[] = array("dealslist" => array("httpCode" => 200 , "Message" => "Product available","deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "deal_discount" => round($deals->deal_percentage), "deal_savings" => $deals->deal_savings,"purchase_count" => $deals->purchase_count,"user_limit_quantity" => $deals->user_limit_quantity, "store_name" => ucfirst($deals->store_name), "deal_category" => $deals->category_name,"latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path,"city_id" => $deals->city_id, 'currency_symbol' => CURRENCY_SYMBOL));
					}
				}
				$today_deals_response["productcategorylist"] = $response;
				echo json_encode($today_deals_response);

				exit;
			}else{
			          if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "أي منتج متاح" ));
				} else {
				$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "No product available" ));
				}
				$today_deals_response["productcategorylist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}
		}
	        if($lang == "ar"){
		        $response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "وحدة المنتج تعطيل من قبل المشرف!" ));
		} else {
		        $response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "Product module disabled by admin!" ));
		}
		$today_deals_response["productcategorylist"] = $response;
		echo json_encode($today_deals_response);
		exit;
		
	}
	
	/** DEALS COUPONS LISTING **/
	
	public function deals_coupons_listing($lang = "", $user_id = "")
	{
		$data = $this->api->get_deals_coupons_list($user_id);
		if(count($data) > 0){
			foreach($data as $deals){
				/*new change api*/
			$m=round(($deals->expirydate-time())/60); 
			
				if(($deals->minimum_deals_limit > $deals->purchase_count)||($deals->captured == 1)) {
					    $couponstatus = 0; // for pending
				 } else {   
						 if($deals->coupon_code_status =="1") {  
							 if($m > 0){ 
									$couponstatus = 1; // for active
						
							 } else {
								$couponstatus = 2;// expired
								} 
					  } else { 
							$couponstatus = 3; // for  closed
						} 
				 }
 
				/*new change api end*/
				
				if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1.png')){
					$image_path= PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png';
				}else{
					$image_path = PATH.'images/no-images.png';
				}
				if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic,"deal_price" => $deals->deal_value,"description" => strip_tags($deals->deal_description_arabic), "deal_key" => $deals->deal_key,"expiry_date" => date('d-m-Y', $deals->expirydate),"purchase_date" => date('d-m-Y', $deals->transaction_date), "coupon_code" => $deals->coupon_code,"coupon_status" => $couponstatus, "store_name" => $deals->store_name_arabic, "friend_gift_status" => $deals->friend_gift_status,"image_url" => $image_path,"store_id" => $deals->store_id));
				} else {
				$response[] = array("dealslist" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title),"deal_price" => $deals->deal_value,"description" => strip_tags($deals->deal_description), "expiry_date" => date('d-m-Y', $deals->expirydate),"deal_key" => $deals->deal_key,"purchase_date" => date('d-m-Y', $deals->transaction_date), "coupon_code" => $deals->coupon_code,"coupon_status" => $couponstatus, "store_name" => ucfirst($deals->store_name), "friend_gift_status" => $deals->friend_gift_status,"image_url" => $image_path,"store_id" => $deals->store_id));
				}
			}
			$today_deals_response["dealscouponslist"] = $response;
			echo json_encode($today_deals_response);

			exit;
		}else{
		        if($lang == "ar"){
			$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "لا كوبونات الصفقات المتاحة" ));
			} else {
			$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "No deals coupons available" ));
			}
			$today_deals_response["dealscouponslist"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
	}
	
	/** DEALS COUPONS LISTING **/
	
	public function product_coupons_listing($lang = "", $user_id = "")
	{
		$data = $this->api->get_product_coupons_list($user_id);
		if(count($data) > 0){
			foreach($data as $deals){
				if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_1.png')){
					$image_path= PATH .'images/products/1000_800/'.$deals->deal_key.'_1'.'.png';
				}else{
					$image_path = PATH.'images/no-images.png';
				}
				if($lang == "ar"){
				$response[] = array("productslist" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic,"description" => strip_tags($deals->deal_description_arabic),"deal_key" => $deals->deal_key, "purchase_date" => date('d-m-Y', $deals->transaction_date), "store_name" => $deals->store_name_arabic, "image_url" => $image_path,"store_id" => $deals->store_id));
				} else {
				$response[] = array("productslist" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title),"description" => strip_tags($deals->deal_description), "deal_key" => $deals->deal_key,"purchase_date" => date('d-m-Y', $deals->transaction_date), "store_name" => ucfirst($deals->store_name), "image_url" => $image_path,"store_id" => $deals->store_id));
				}
			}
			$today_deals_response["productscouponslist"] = $response;
			echo json_encode($today_deals_response);

			exit;
		}else{
		        if($lang == "ar"){
			$response[] = array("productslist" => array("httpCode" => 401 , "Message" => "لا توجد منتجات شراؤها" ));
			} else {
			$response[] = array("productslist" => array("httpCode" => 401 , "Message" => "No products purchased" ));
			}
			$today_deals_response["productscouponslist"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
	}
	
	
	/** AUCTION COUPONS LISTING **/
	
	public function auction_coupons_listing($lang = "", $user_id = "")
	{
		$data = $this->api->get_auction_coupons_list($user_id);
		if(count($data) > 0){
			foreach($data as $deals){
				if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1.png')){
					$image_path= PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png';
				}else{
					$image_path = PATH.'images/no-images.png';
				}
				if($lang == "ar"){
				$response[] = array("auctionslist" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic,"description" => strip_tags($deals->deal_description_arabic),"deal_key" => $deals->deal_key, "purchase_date" => date('d-m-Y', $deals->transaction_date), "store_name" => $deals->store_name_arabic, "image_url" => $image_path,"store_id" => $deals->store_id));
				} else {
				$response[] = array("auctionslist" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title),"description" => strip_tags($deals->deal_description),"deal_key" => $deals->deal_key, "purchase_date" => date('d-m-Y', $deals->transaction_date), "store_name" => ucfirst($deals->store_name), "image_url" => $image_path,"store_id" => $deals->store_id));
				}
			}
			$today_deals_response["auctionscouponslist"] = $response;
			echo json_encode($today_deals_response);

			exit;
		}else{
		        if($lang == "ar"){
			$response[] = array("auctionslist" => array("httpCode" => 401 , "Message" => "لا المزاد شراؤها" ));
			} else {
			$response[] = array("auctionslist" => array("httpCode" => 401 , "Message" => "No auction purchased" ));
			}
			$today_deals_response["auctionscouponslist"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
	}
	
	
	
	/** GET DEALS USING GEO **/
	
	public function geo_products($lang = "", $latitude = "",$longitude = "")
	{
			if($this->product_setting){
			  
			  $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false";
			    $data = file_get_contents($url); 
			        $address = json_decode($data);
			        $addr = "";
			        $i = 0;
			        if ( $address->status === "OVER_QUERY_LIMIT" ) :
						sleep(2);
						$address = json_decode($data);
					endif;

			       
			       if(isset($address->results)  && !empty($address->results))
			       { 

							foreach($address->results[0]->address_components as $i => $val)
							{
								if(count($val) > 0){
									foreach($val as $city){
										if(isset($city) && !is_array($city)){
											$addr .= $city.',';
										}
									}
								 }
							 }
							if(!$addr){
								$addr = $address->results[0]->formatted_address;
							}
							$city = explode(',',$addr);
							//print_r($addr);exit;
							if(count($city) > 2){
								foreach($city as $c){
									$city_id = $this->api->get_city_id1(strtolower($c));
									if($city_id){
										$this->product_listing($lang,$city_id);
									}
								  }
							}		
						if($lang == "ar"){		     
						$response[] = array("product_list" => array("httpCode" => 400 , "Message" => "أي منتج متاح" ));
						} else {
						$response[] = array("product_list" => array("httpCode" => 400 , "Message" => "No product available" ));
						}
						$today_deals_response["productlist"] = $response;
						echo json_encode($today_deals_response);
						exit;
					}
					if($lang == "ar"){	
					$response[] = array("product_list" => array("httpCode" => 401 , "Message" => "أي منتج متاح" ));
					} else {
					$response[] = array("product_list" => array("httpCode" => 401 , "Message" => "No product available" ));
					}
					$today_deals_response["productlist"] = $response;
					echo json_encode($today_deals_response);
					exit;
			}
			        if($lang == "ar"){	
				$response[] = array("product_list" => array("httpCode" => 400 , "Message" => "وحدة المنتج تعطيل من قبل المشرف!" ));
				} else {
				$response[] = array("product_list" => array("httpCode" => 400 , "Message" => "Product module disabled by admin!" ));
				}
				$today_deals_response["productlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
	
	}	
	
	/** GET DEALS USING GEO **/
	
	public function geo_deals($lang = "", $latitude = "",$longitude = "")
	{
			if($this->deal_setting){
				$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false";
			    $data = file_get_contents($url); 
			        $address = json_decode($data); 
			        $addr = "";
			        $i = 0;
			        
			      if ( $address->status === "OVER_QUERY_LIMIT" ) :
						sleep(2);
						$address = json_decode($data);
					endif;

			        
			        
			       if(isset($address->results)  && !empty($address->results))
			       {
						
							foreach($address->results[0]->address_components as $i => $val)
							{
								if(count($val) > 0){
									foreach($val as $city){
										if(isset($city) && !is_array($city)){
											$addr .= $city.',';
										}
									}
								 }
							}
							 
							if(!$addr){
								$addr = $address->results[0]->formatted_address;
							}
							$city = explode(',',$addr);
							
							if(count($city) > 2){
								foreach($city as $c){ 
									$city_id = $this->api->get_city_id(strtolower($c));
									if($city_id){ 
										$this->deals_listing($lang , $city_id);
									}
								  }
							}
						if($lang == "ar"){			     
						$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "لا صفقة المتاحة" ));
						} else {
						$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "No deal available" ));
						}
						$today_deals_response["deallist"] = $response;
						echo json_encode($today_deals_response);
						exit;
					}
					if($lang == "ar"){
					$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "لا صفقة المتاحة" ));
					} else {
					$response[] = array("dealslist" => array("httpCode" => 401 , "Message" => "No deal available" ));
					}
					$today_deals_response["deallist"] = $response;
					echo json_encode($today_deals_response);
					exit;
			}
			        if($lang == "ar"){
				$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "وحدة تعطيل الصفقة من قبل المشرف!" ));
				} else {
				$response[] = array("dealslist" => array("httpCode" => 400 , "Message" => "Deal module disabled by admin!" ));
				}
				$today_deals_response["deallist"] = $response;
				echo json_encode($today_deals_response);
				exit;
	}
	
	/** GET DEALS USING GEO **/
	
	public function geo_auctions($lang = "",$latitude = "",$longitude = "")
	{
			if($this->auction_setting) {
			    $data = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&sensor=false"); 
			              
			        $address = json_decode($data);
			        $addr = "";
			        $i = 0;
			        if(count($address->results))
			        {
							foreach($address->results[0]->address_components as $i => $val)
							{
								if(count($val) > 0){
								        //print_r($val); exit;
									foreach($val as $city){
										if(isset($city) && !is_array($city)){
											$addr .= $city.',';
										}
									}
								 }
							 }
							if(!$addr){
								$addr = $address->results[0]->formatted_address;
							}
							$city = explode(',',$addr);
							//print_r($addr);exit;
							if(count($city) > 2){
								foreach($city as $c){
									$city_id = $this->api->get_city_id1(strtolower($c));
									if($city_id){
										$this->auction_listing($lang,$city_id);
									}
								  }
							}		
						if($lang == "ar"){	     
						$response[] = array("auction_list" => array("httpCode" => 401 , "Message" => "لا تتوفر المزاد" ));
						} else {
						$response[] = array("auction_list" => array("httpCode" => 401 , "Message" => "No auction available" ));
						}
						$today_deals_response["auctionlist"] = $response;
						echo json_encode($today_deals_response);
						exit;
					}
					if($lang == "ar"){
					$response[] = array("auction_list" => array("httpCode" => 401 , "Message" => "لا تتوفر المزاد" ));
					} else {
					$response[] = array("auction_list" => array("httpCode" => 401 , "Message" => "No auction available" ));
					}
					$today_deals_response["auctionlist"] = $response;
					echo json_encode($today_deals_response);
					exit;
			}
			        if($lang == "ar"){
				$response[] = array("auction_list" => array("httpCode" => 400 , "Message" => "وحدة مزاد تعطيل من قبل المشرف!" ));
				} else {
				$response[] = array("auction_list" => array("httpCode" => 400 , "Message" => "Auction module disabled by admin!" ));
				}
				$today_deals_response["auctionlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			
	}	
	
	
	/** AUCTION LISTING  **/
	
	public function auction_listing($lang= "", $city_id = "", $search = "")
	{
		if($this->auction_setting) {
			$data = $this->api->get_auction_list($city_id,$search);
			if(count($data) > 0){
				$this->all_payment_list = $this->api->payment_list(); 
					 
				foreach($data as $deals){
					
				$q=0; foreach($this->all_payment_list as $payment){ 
						 if($payment->auction_id==$deals->deal_id){ 
								$firstname = $payment->firstname;
								$transaction_time = date('d-m-Y H:i:s', $payment->transaction_date);
								$q=1;
							}     
						} 
							  if($q==0){ 
								  $firstname = 0;
								  $transaction_time = 0;
								} 
					 
					if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1.png')){
						$image_path= PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png';
					}else{
						$image_path = PATH.'images/no-images.png';
					}
					if($lang == "ar"){
					$response[] = array("auction_list" => array("httpCode" => 200 , "Message" => "مزاد متاحة","deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "store_name" => $deals->store_name_arabic,"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name_arabic, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name_arabic,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL,"last_bidder" =>$firstname,"bid_date" =>$transaction_time));
					} else {
					$response[] = array("auction_list" => array("httpCode" => 200 , "Message" => "Auction available","deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "store_name" => ucfirst($deals->store_name),"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL,"last_bidder" =>$firstname,"bid_date" =>$transaction_time));
					}
				}
				$today_deals_response["auctionlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}else{
			        if($lang == "ar"){
					$response[] = array("auction_list" => array("httpCode" => 401 , "Message" => "لا تتوفر المزاد" ));
				} else {
				$response[] = array("auction_list" => array("httpCode" => 401 , "Message" => "No auction available" ));
				}
				$today_deals_response["auctionlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}
		}
		        if($lang == "ar"){
			$response[] = array("auction_list" => array("httpCode" => 400 , "Message" => "وحدة مزاد تعطيل من قبل المشرف!" ));
			} else {
			$response[] = array("auction_list" => array("httpCode" => 400 , "Message" => "Auction module disabled by admin!" ));
			}
			$today_deals_response["auctionlist"] = $response;
			echo json_encode($today_deals_response);
			exit;
		
	}
	
	/** HOT & MOST VIEW AUCTION LISTING  **/
	
	public function hot_auction_listing($lang= "",$type_view = "", $city_id = "")
	{
		if($this->auction_setting) {
		        if($type_view == "hot"){
			$data = $this->api->get_hot_auction_list($city_id);
			} else { 
			$data = $this->api->get_mostview_auction_list($city_id);
			}
			if(count($data) > 0){
				$this->all_payment_list = $this->api->payment_list(); 
					 
				foreach($data as $deals){
					
				$q=0; foreach($this->all_payment_list as $payment){ 
						 if($payment->auction_id==$deals->deal_id){ 
								$firstname = $payment->firstname;
								$transaction_time = date('d-m-Y H:i:s', $payment->transaction_date);
								$q=1;
							}     
						} 
					        if($q==0){ 
						        $firstname = 0;
						        $transaction_time = 0;
						} 
					if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1.png')){
						$image_path= PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png';
					}else{
						$image_path = PATH.'images/no-images.png';
					}
					if($lang == "ar"){
					$response[] = array("auction_list" => array("httpCode" => 200 , "Message" => "مزاد متاحة","deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "store_name" => $deals->store_name_arabic,"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name_arabic, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name_arabic,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL,"last_bidder" =>$firstname,"bid_date" =>$transaction_time));
					} else {
					$response[] = array("auction_list" => array("httpCode" => 200 , "Message" => "Auction available","deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "store_name" => ucfirst($deals->store_name),"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL,"last_bidder" =>$firstname,"bid_date" =>$transaction_time));
					}
				}
				$today_deals_response["auctionlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}else{
			        if($lang == "ar"){
				$response[] = array("auction_list" => array("httpCode" => 401 , "Message" => "لا تتوفر المزاد" ));
				} else {
				$response[] = array("auction_list" => array("httpCode" => 401 , "Message" => "No auction available" ));
				}
				$today_deals_response["auctionlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}
		}
		        if($lang == "ar"){
			$response[] = array("auction_list" => array("httpCode" => 400 , "Message" => "وحدة مزاد تعطيل من قبل المشرف!" ));
			} else {
			$response[] = array("auction_list" => array("httpCode" => 400 , "Message" => "Auction module disabled by admin!" ));
			}
			$today_deals_response["auctionlist"] = $response;
			echo json_encode($today_deals_response);
			exit;
		
	}
	
	/**CATEGORY'S WISE AUCTION LIST **/
	
	public function auction_category_listing($lang= "" , $type = "", $category = "", $city_id = "")
	{
		if($this->auction_setting) {
			$data = $this->api->get_category_auctions($type , $category, $city_id);
			if(count($data) > 0){
				$this->all_payment_list = $this->api->payment_list();
					 
				foreach($data as $deals){
					
					$q=0; foreach($this->all_payment_list as $payment){ 
						 if($payment->auction_id==$deals->deal_id){ 
								$firstname = $payment->firstname;
								$transaction_time = date('d-m-Y H:i:s', $payment->transaction_date);
								$q=1;
							}     
						} 
					        if($q==0){ 
                                                        $firstname = 0;
                                                        $transaction_time = 0;
						} 
					 
					if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1.png')){
						$image_path= PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png';
					}else{
						$image_path = PATH.'images/no-images.png';
					}
					if($type == "5"){					
					        if($lang == "ar"){
					                $category_name = "آخرون";
					        } else {
					                 $category_name = "Others";
					        }					
					        } else {					
					        if($lang == "ar"){
					                $category_name = $deals->category_name_arabic;
					        } else {
					                 $category_name = $deals->category_name;
					        }					
					}
					
					 if($lang == "ar"){
					$response[] = array("auction_list" => array("httpCode" => 200 , "Message" => "مزاد متاحة","deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "store_name" => $deals->store_name_arabic,"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $category_name, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name_arabic,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL,"last_bidder" =>$firstname,"bid_date" =>$transaction_time));
					} else {
					$response[] = array("auction_list" => array("httpCode" => 200 , "Message" => "Auction available","deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "store_name" => ucfirst($deals->store_name),"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $category_name, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, "city_name" => $deals->city_name,"city_id" => $deals->city_id,'currency_symbol' => CURRENCY_SYMBOL,"last_bidder" =>$firstname,"bid_date" =>$transaction_time));
					}
				}
				$today_deals_response["auctionlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}else{
			         if($lang == "ar"){
				$response[] = array("auction_list" => array("httpCode" => 401 , "Message" => "لا تتوفر المزاد" ));
				} else {
				$response[] = array("auction_list" => array("httpCode" => 401 , "Message" => "No auction available" ));
				}
				$today_deals_response["auctionlist"] = $response;
				echo json_encode($today_deals_response);
				exit;
			}
		}
		        if($lang == "ar"){
			        $response[] = array("auction_list" => array("httpCode" => 400 , "Message" => "وحدة مزاد تعطيل من قبل المشرف!" ));
			} else {
			        $response[] = array("auction_list" => array("httpCode" => 400 , "Message" => "Auction module disabled by admin!" ));
			}
			$today_deals_response["auctionlist"] = $response;
			echo json_encode($today_deals_response);
			exit;
	}
	
	/** DEAL DETAILS **/
	
	public function auction_details($lang = "", $deal_id = "", $deal_key = "",$device_number = "")
	{
		$data = $this->api->get_auction_details($deal_id,$deal_key,$device_number);
		if(count($data) > 0){
			$avg_rating =$this->api->get_average_rating($deal_id,3);
			$this->transaction_details = $this->api->get_auction_transaction_data($deal_id);
			$count1 = count($this->transaction_details);
			if($count1){
				foreach($this->transaction_details as $bid){
					$bidlist[] = array("bid_history" =>array("bid_count" =>$count1,"name" =>$bid->firstname,"bid_amount" =>$bid->bid_amount,"transaction_time" =>date("d-m-Y h:i:s A", $bid->transaction_date)));
				}
			}
			else{
				$bidlist = array("response" => array("httpCode" => 401 , "Message" => "Not yet bid" ));
				
			}
			foreach($data as $deals){
				$con=0; 
                for($i=1; $i<=10; $i++){ 
                    if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_'.$i.'.png')) { 
                        $con=$con+1; 
                    } 
                 }
				if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1.png')){
				        $image_path = $image_path1 ="";
				        
				    for($i=1; $i<=$con; $i++){ 
					        $image_path .=PATH .'images/auction/1000_800/'.$deals->deal_key.'_'.$i.'.png'.',';
					    }
					
					$image_path = substr($image_path,0,-1);
				}else{
					$image_path = $image_path1 = $image_path = PATH.'images/no-images.png';
				}
				
				
				if(file_exists(DOCROOT.'images/merchant/290_215/'.$deals->merchant_id.'_'.$deals->store_id.'.png')){
					$img_path = PATH.'images/merchant/290_215/'.$deals->merchant_id.'_'.$deals->store_id.'.png';
				}else{
					$img_path = PATH.'images/no-images.png';
				}
				$social_share = PATH.'auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';
				if($lang == "ar"){			
				$response[] = array("auction_details" => array("httpCode" => 200 , "Message" => "مزاد متاحة","deal_id" => $deals->deal_id, "deal_key" => $deals->deal_key, "deal_title" => $deals->deal_title_arabic,"deal_title_english" => $deals->deal_title, "deal_url_title" => $deals->url_title, "image_url" => $image_path, "store_id" => $deals->store_id, "store_image_url" => $img_path,"retail_price" => $deals->product_value,"shipping_amount" =>$deals->shipping_fee,"bid_increment" => $deals->bid_increment ,"bid_deal_value" => $deals->deal_price,"starting_bid" => $deals->deal_value,"place_bid_amount" => $deals->deal_price, "deal_savings" => $deals->deal_savings, "category" => $deals->category_name_arabic, "category_id" => $deals->category_id,"description" => $deals->deal_description_arabic,"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "current_time" => date('d-m-Y H:i:s', time()), "Auction type(s)" => "احتياطي المزاد", "Shipping_Information" =>$deals->shipping_info, "store_name" => $deals->store_name_arabic, "store_address" => $deals->address1_arabic.','.$deals->address2_arabic, "city_id" => $deals->city_id, "store_city_name" => $deals->city_name_arabic,  "store_phone_number" => $deals->phone, "store_website" => $deals->website, "store_latitude" => $deals->latitude, "store_longitude" => $deals->longitude, "social_share" => $social_share, 'currency_symbol' => CURRENCY_SYMBOL,'average_rating' =>$avg_rating,"comment_type" =>3,"bidhistory" =>$bidlist));
				} else {
				$response[] = array("auction_details" => array("httpCode" => 200 , "Message" => "Auction available","deal_id" => $deals->deal_id, "deal_key" => $deals->deal_key, "deal_title" => ucfirst($deals->deal_title), "deal_title_english" => ucfirst($deals->deal_title),"deal_url_title" => $deals->url_title, "image_url" => $image_path, "store_id" => $deals->store_id, "store_image_url" => $img_path,"retail_price" => $deals->product_value,"shipping_amount" =>$deals->shipping_fee,"bid_increment" => $deals->bid_increment ,"bid_deal_value" => $deals->deal_price,"starting_bid" => $deals->deal_value,"place_bid_amount" => $deals->deal_price, "deal_savings" => $deals->deal_savings, "category" => $deals->category_name, "category_id" => $deals->category_id,"description" => $deals->deal_description, "fineprints" => $deals->fineprints, "highlights" => $deals->highlights, "terms_conditions" => $deals->terms_conditions,"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "current_time" => date('d-m-Y H:i:s', time()),"Auction type(s)" => "Reserve auction", "Shipping_Information" =>$deals->shipping_info, "store_name" => ucfirst($deals->store_name), "store_address" => $deals->addr1.','.$deals->addr2, "city_id" => $deals->city_id, "store_city_name" => $deals->city_name,  "store_phone_number" => $deals->phone, "store_website" => $deals->website, "store_latitude" => $deals->latitude, "store_longitude" => $deals->longitude, "social_share" => $social_share, 'currency_symbol' => CURRENCY_SYMBOL,'average_rating' =>$avg_rating,"comment_type" =>3,"bidhistory" =>$bidlist));
				}
			}
			$deal_detail_response["auctiondetail"] = $response;
			echo json_encode($deal_detail_response);
			exit;
		}else{
			if($lang == "ar"){
				$response[] = array("auction_details" => array("httpCode" => 401 , "Message" => "لا تتوفر المزاد" ));
				} else {
				$response[] = array("auction_details" => array("httpCode" => 401 , "Message" => "No auction available" ));
				}
			$today_deals_response["auctiondetail"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
		
	}
	
	public function bid_history($deal_id = "")
	{
		$this->transaction_details = $this->api->get_auction_transaction_data($deal_id);
			$count1 = count($this->transaction_details);
			if($count1){
				foreach($this->transaction_details as $bid){
					$bidlist[] = array("bid_history" =>array("httpCode" => 200 ,"bid_count" =>$count1,"name" =>$bid->firstname,"bid_amount" =>$bid->bid_amount,"place_bid_amount" => $bid->deal_price,"shipping_amount" => $bid->shipping_fee,"transaction_time" =>date("d-m-Y H:i:s A", $bid->transaction_date)));
				}
			}
			else{
				$bidlist[] = array("bid_history" =>array("bid_count" =>0));
			}
			$deal_detail_response["bidhistory"] = $bidlist;
			echo json_encode($deal_detail_response);
			exit;
			
	}
	
	/** SIMILAR AUCTIONS **/
	
	public function similar_auctions($lang= "", $deal_id = "", $category_id = "", $city_id ="")
	{
	    
		$data = $this->api->get_similar_auctions($deal_id, $category_id, $city_id);
		if(count($data) > 0){
			$this->all_payment_list = $this->api->payment_list();
				 
			foreach($data as $deals){
				
				$q=0; foreach($this->all_payment_list as $payment){ 
					 if($payment->auction_id==$deals->deal_id){ 
							$firstname = $payment->firstname;
							$transaction_time = date('d-m-Y H:i:s', $payment->transaction_date);
							$q=1;
						}     
					} 
					  if($q==0){ 
						  $firstname = 0;
						  $transaction_time = 0;
						} 
				 
				if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1.png')){
					$image_path=PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png';
				}else{
					$image_path = PATH.'images/no-images.png';
				}
				 if($lang == "ar"){
				$response[] = array("similar_auction_list" => array("httpCode" => 200 , "Message" => "مزاد متاحة" ,"deal_id" => $deals->deal_id, "deal_title" => $deals->deal_title_arabic, "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description_arabic), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "store_name" => $deals->store_name_arabic,"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name_arabic, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, 'currency_symbol' => CURRENCY_SYMBOL,"last_bidder" =>$firstname,"bid_date" =>$transaction_time));
				} else {
				$response[] = array("similar_auction_list" => array("httpCode" => 200 , "Message" => "Auction available" ,"deal_id" => $deals->deal_id, "deal_title" => ucfirst($deals->deal_title), "deal_url_title" => $deals->url_title, "deal_key" => $deals->deal_key,"description" => strip_tags($deals->deal_description), "deal_price" => $deals->deal_price, "deal_value" => $deals->deal_value, "store_name" => ucfirst($deals->store_name),"startdate" => date('d-m-Y H:i:s', $deals->startdate),  "enddate" => date('d-m-Y H:i:s', $deals->enddate), "deal_category" => $deals->category_name, "latitude" => $deals->latitude, "longitude" => $deals->longitude, "image_url" => $image_path, 'currency_symbol' => CURRENCY_SYMBOL,"last_bidder" =>$firstname,"bid_date" =>$transaction_time));
				}
			}
			$today_deals_response["similarauctionlist"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}else{
			 if($lang == "ar"){
				$response[] = array("similar_auction_list" => array("httpCode" => 401 , "Message" => "للا مزاد مماثل متاح" ));
				} else {
				$response[] = array("similar_auction_list" => array("httpCode" => 401 , "Message" => "No similar auction available" ));
				}
				$today_deals_response["similarauctionlist"] = $response;
			echo json_encode($today_deals_response);
			exit;
		}
	}
	
	/** SUCCESS BIDDING **/
	public function success_bidding($lang= "", $current_bid_value = "",$deal_value = "",$deal_id = "",$end_time = "",$shipping_amount = "",$userid = "")
	{ 
		
		if($current_bid_value && $deal_value && $deal_id && $userid){
				$end_time = $this->api->get_end_time($deal_id);
				//$end_time = strtotime($end_time);
				if($end_time > time()){
					$status = $this->api->insert_bidding($current_bid_value ,$deal_value,$deal_id,$end_time,$shipping_amount,$userid); //insert the bidding details
					$new_bid_value = $this->api->get_new_bid_value($deal_id);
					if($status>0)
					{
					         if($lang == "ar"){
						$response = array("response" => array("httpCode" => 200 , "Message" => "عرضك وضعت بنجاح!","place_bid_amount" => $new_bid_value));
						} else {
						$response = array("response" => array("httpCode" => 200 , "Message" => "Your bid placed successfully!","place_bid_amount" => $new_bid_value));
						}
						echo json_encode($response);
						exit;
					}
					if($status==0)
					{
					         if($lang == "ar"){
						$response = array("response" => array("httpCode" => 401 , "Message" => "بالفعل كان شخص ما قد يعرض نفس المبلغ.! محاولة مع كمية جديدة","place_bid_amount" => $new_bid_value ));
						} else {
						$response = array("response" => array("httpCode" => 401 , "Message" => "Already someone has bid same amount.! Try with new amount","place_bid_amount" => $new_bid_value ));
						}
						echo json_encode($response);
						exit;
						
					}
					if($status== -1)
					{
					         if($lang == "ar"){
						$response = array("response" => array("httpCode" => 401 , "Message" => "في الفترة ما بين المناقصة محاولة للشخص يرجى المحاولة مرة أخرى!","place_bid_amount" => $new_bid_value ));
						} else {
						$response = array("response" => array("httpCode" => 401 , "Message" => "In between you bid someone bid please try again!","place_bid_amount" => $new_bid_value ));
						}
						echo json_encode($response);
						exit;
						
					}
				} else {
				                 if($lang == "ar"){
						$response = array("response" => array("httpCode" => 400 , "Message" => "يتم إغلاق المزاد الوقت!" ));
						} else {
						$response = array("response" => array("httpCode" => 400 , "Message" => "Auction time is closed!" ));
						}
						echo json_encode($response);
						exit;
				}
		}
		 if($lang == "ar"){
		$response = array("response" => array("httpCode" => 400 , "Message" => "يرجى إرسال التفاصيل بشكل صحيح" ));
		} else {
		$response = array("response" => array("httpCode" => 400 , "Message" => "Please correctly send the details" ));
		}
		echo json_encode($response);
		exit;

	}
	
	/** User won auction list  **/
	
	public function winner_list($lang = "", $userid = "")
	{
		$data = $this->api->get_auction_winner_list($userid);
		if(count($data) > 0){
			foreach($data as $deals){
				if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1.png')){
					$image_path=PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png';
				}else{
					$image_path = PATH.'images/no-images.png';
				}
				$total = $deals->bid_amount + $deals->shipping_amount;
				 if($lang == "ar"){
				$response[] = array("auctionslist" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id, "deal_key" => $deals->deal_key, "deal_title" => $deals->deal_title_arabic, "purchase_date" => date('d-M-Y h:i:s A', $deals->bidding_time), "image_url" => $image_path,"bid_amount" =>$deals->bid_amount,"shipping_amount" => $deals->shipping_amount,'currency_symbol' => CURRENCY_SYMBOL,"total" => $total));
				} else {
				$response[] = array("auctionslist" => array("httpCode" => 200 ,"deal_id" => $deals->deal_id, "deal_key" => $deals->deal_key, "deal_title" => ucfirst($deals->deal_title), "purchase_date" => date('d-M-Y h:i:s A', $deals->bidding_time), "image_url" => $image_path,"bid_amount" =>$deals->bid_amount,"shipping_amount" => $deals->shipping_amount,'currency_symbol' => CURRENCY_SYMBOL,"total" => $total));
				}
			}
			$today_deals_response["auctionscouponslist"] = $response;
			echo json_encode($today_deals_response);

			exit;
		}else{
		         if($lang == "ar"){
			$response = array("auctionslist" => array("httpCode" => 401 , "Message" => "لا مزاد فاز" ));
			} else {
			$response = array("auctionslist" => array("httpCode" => 401 , "Message" => "No auction won" ));
			}
			echo json_encode($response);
			exit;
		}
	}
	
	
	/** GET DEALS USING GEO **/
	
	public function search_listing($lang = "", $keyword = "", $searchvalue = "", $city_id = "")
	{
                if($keyword=="deal"){
                        $this->deals_listing($lang,$city_id,$searchvalue,1);
                } elseif($keyword=="product"){
                        $this->product_listing($lang,$city_id,$searchvalue);
                } elseif($keyword=="store"){
                        $this->store_list($lang,$city_id,$searchvalue);
                } else if($keyword=="auction"){
			         $this->auction_listing($lang,$city_id,$searchvalue);
	        }
                
                else {
                        $response = array("response" => array("httpCode" => 401 , "Message" => "Keyword not found" ));
	                    echo json_encode($response);
	                    exit;
                }
	}

	/** INVALID REQUEST  **/

	public function __call($method, $arguments)
	{
		$response[] = array("response" => array("httpCode" => 404 , "Message" => "Request URL found" ));
		json_encode($response);
		exit;
	}
	
	public function module_settings()
	{ 
		$data = $this->api->get_setting_module_list(); 
		
		if(count($data) > 0){
			$default_city = $this->api->get_default_city();
			foreach($data as $setting){
				if( $setting->is_city == 0) $default_city = 0;
				$response[] = array("module_settings_list" => array("httpCode" => 200 ,"deal_setting" => $setting->is_deal, "product_setting" =>$setting->is_product, "auction_setting" => $setting->is_auction, "paypal_setting" => $setting->is_paypal,"credit_card_setting" => $setting->is_credit_card, "authorize_setting" => $setting->is_authorize,"cash_on_delivery_setting" => $setting->is_cash_on_delivery,"shipping_setting" => $setting->is_shipping,"flat_shipping_amount" =>FLAT_SHIPPING_AMOUNT,"tax_percentage" =>TAX_PRECENTAGE_VALUE,"map_setting" => $setting->is_map,"store_setting" => $setting->is_store_list,"city_setting" => $setting->is_city,"default_city" => $default_city));
			}
			
			$city_response["modulesettingslist"] = $response;
			echo json_encode($city_response);
			exit;
		}else{
			$response = array("response" => array("httpCode" => 401 , "Message" => "No cities available" ));
			echo json_encode($response);
			exit;
		}

		
		
	}
	
	
	public function all_size_list($lang = "")
	{
		        $this->product_size = $this->api->get_size_list();
		         foreach($this->product_size as $size){  
		                        if($lang == "ar"){
				        $sizes[] = array("size_list" =>array("httpCode" => 200 ,"size_id" =>$size->size_id,"size_name" =>$size->size_arabic));
				        } else {
				        $sizes[] = array("size_list" =>array("httpCode" => 200 ,"size_id" =>$size->size_id,"size_name" =>$size->size_name));
				        }
		        }
			$deal_detail_response["sizelist"] = $sizes;
			echo json_encode($deal_detail_response);
			exit; 
		
	}
	
	public function all_color_list($lang = "")
	{
			$this->product_color = $this->api->get_color_list();
			if(count($this->product_color) > 0){
			foreach($this->product_color as $color){  
			        if($lang == "ar"){
				$colors[] = array("colors_list" => array("httpCode" => 200 ,"color_code_id" =>$color->color_code_id,"color_code_name" =>$color->color_code_name,"color_code" =>$color->color_name,"color_count" => 1));
				 } else {
				 $colors[] = array("colors_list" => array("httpCode" => 200 ,"color_code_id" =>$color->color_code_id,"color_code_name" =>$color->color_code_name,"color_code" =>$color->color_name,"color_count" => 1));
				 }
			} 
			} else {
	                        if($lang == "ar"){
				$colors[] = array("colors_list" => array("colors" =>"لا قيمة","color_count" => 0));
				} else {
				$colors[] = array("colors_list" => array("colors" =>"No value","color_count" => 0));
				}
			}
			$deal_detail_response["colorlist"] = $colors;
			echo json_encode($deal_detail_response);
			exit; 
	}

}

