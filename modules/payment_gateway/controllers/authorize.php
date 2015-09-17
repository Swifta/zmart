<?php defined('SYSPATH') OR die('No direct access allowed.');
class Authorize_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->authorize = new Authorize_Model;
        $this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css'));
        $this->session = Session::instance();
		$this->UserID = $this->session->get("UserID");
		$this->UserEmail = $this->session->get("UserEmail");
		foreach($this->generalSettings as $s){
		    $this->Live_Mode = $s->paypal_payment_mode;
		    require_once APPPATH.'vendor/authorize.net/AuthorizeNet.php';
	        define("AUTHORIZENET_API_LOGIN_ID", $s->authorizenet_api_id);
	        define("AUTHORIZENET_TRANSACTION_KEY", $s->authorizenet_transaction_key);
	        define("AUTHORIZENET_SANDBOX", true);
			if($this->Live_Mode == 1){
				define("AUTHORIZENET_SANDBOX", false);
			}
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

	public function productpayment()
	{
			$cart_merchant=array();
			$merchant_id_array=array();
			
         $bulk_discount="";
         $bulk_discount1="";
         $total_bulk_discount=0;
         
	         foreach($_SESSION as $key=>$value)
                {
                    if((is_string($value)) && ($key=='product_cart_id'.$value)){
                    $deal_id = $_SESSION[$key];
                    $item_qty = $this->session->get('product_cart_qty'.$deal_id);
                    $product_size = "1";
                        foreach($_SESSION as $key=>$value)
                        {
                            if(($key=='product_size_qty'.$deal_id)){
                                $product_size = $value;
                            }
                            if(($key=='product_quantity_qty'.$deal_id)){
                                $product_quantity = $value;
                            }
                              if(($key=='store_credit_id'.$deal_id)){
									$this->session->delete('product_size_qty'.$deal_id);
									$this->session->delete('product_quantity_qty'.$deal_id);
									$this->session->delete('product_color_qty'.$deal_id);
									$this->session->delete('store_credit_period'.$deal_id);
									$this->session->delete('product_cart_qty'.$deal_id);
									$this->session->delete('product_cart_id'.$deal_id);
									unset($_SESSION[$key]);
								}
                        }
                        /*if($this->session->get('prime_customer')==1){
                        $this->products = new Products_Model();
                 $this->get_cart_products = $this->products->get_cart_products($deal_id);
                                            foreach ($this->get_cart_products as $products) {
                $this->merchant_id=$this->products->get_deal_merchant_id($products->deal_id);
                                            $merchant_id=$this->merchant_id->current()->merchant_id;
											$dealamountdispaly1 = $products->deal_value * $this->session->get('product_cart_qty' . $products->deal_id);
											if(array_key_exists($merchant_id,$merchant_id_array)){
											$cart_merchant[$products->merchant_id]=$dealamountdispaly1+$cart_merchant[$products->merchant_id];
											$merchant_id_array[$merchant_id]=$merchant_id_array[$merchant_id]+1;
											//$cart_merchant[$products->merchant_id]=$cart_merchant[$products->merchant_id]+1;
											}else{

											$cart_merchant[$products->merchant_id]=$dealamountdispaly1;
											$merchant_id_array[$merchant_id]=0;
											}
										}
									}*/
                        $this->product_size_details = $this->authorize->product_size_details($deal_id, $product_size);
                        $dbquantity=$this->product_size_details->current()->quantity;
                        if($dbquantity < $item_qty){
                            $this->session->set('product_quantity_qty'.$deal_id,$dbquantity);
                            common::message(-1, $this->Lang['CHE_PRO_QTY']);
                            url::redirect(PATH."cart.html");
                        }
                    }
                }
		if($_POST){
			$referral_amount = $this->input->post("p_referral_amount");
			$prime_customer = $this->input->post("prime_customer");
		        $this->userPost = $this->input->post();
		        $total_amount="";
		        $total_qty="";
		        $product_title="";
		        $produ_qty="";
		        $total_shipping="";
		         $product_shipping = "";
		        foreach($_SESSION as $key=>$value)
                {
                    if((is_string($value)) && ($key=='product_cart_id'.$value)){
                    $deal_id = $_SESSION[$key];
                    $item_qty = $this->session->get('product_cart_qty'.$deal_id);
                    $this->session->set('product_cart_qty'.$deal_id,$item_qty);
                    $amount = $this->input->post("amount");
			        $this->deals_payment_deatils = $this->authorize->get_product_payment_details($deal_id);
			        if(count($this->deals_payment_deatils) == 0){
                        unset($_SESSION[$key]);
                        $this->session->delete('product_cart_qty'.$value);
                        $this->session->delete("count");
				        common::message(-1, $this->Lang["PAGE_NOT"]);
				        url::redirect(PATH."products.html");
			        }
			        foreach($this->deals_payment_deatils as $UL){
			            $purchase_qty = $UL->purchase_count;
				        $deal_title = $UL->deal_title;
				        $deal_key  = $UL->deal_key;
				        $url_title = $UL->url_title;
				        $deal_value = $UL->deal_value;
				        $product_amount = $UL->deal_value*$item_qty;
				        $shipping_amount = $UL->shipping_amount;
				        $shipping_methods = $UL->shipping;
				        $merchant_id = $UL->merchant_id;
				       
			        }

			        if($shipping_methods  == 1){
			        $total_shipping += 0;
			        }  elseif($shipping_methods  == 2){
			        $merchant_flat_amount = $this->authorize->get_userflat_amount($merchant_id);
			        $total_shipping += $merchant_flat_amount->flat_amount;
			        } elseif($shipping_methods  == 3){
			        $total_shipping +=$shipping_amount;
			        } elseif($shipping_methods  == 4){
			        $total_shipping +=$shipping_amount*$item_qty;
			        } elseif($shipping_methods  == 5){
			        $total_shipping +=0;
			        }

			        $total_amount +=$product_amount;
			        $total_qty += $item_qty;
			        $product_title .=$deal_title.",";
			        $produ_qty .=$item_qty.",";
			       }
	            }
                $pay_amount1=0; // for total transaction amount for success page
                $total_tax = (TAX_PRECENTAGE_VALUE/100)*($total_amount+$total_shipping);
                $pay_amount = $pay_amount1 = $total_amount+$total_shipping+$total_tax;

                $currencyCode = CURRENCY_CODE;

                        if(CURRENCY_CODE !="USD"){ // for Currency conversion
                                $pay_amount = common::currency_conversion(CURRENCY_CODE,"USD",$pay_amount);
                                $total_tax = common::currency_conversion(CURRENCY_CODE,"USD",$total_tax);
                                $currencyCode = "USD";
                        }

                $post = arr::to_object($this->input->post());

                // authorize
                $sale = new AuthorizeNetAIM;
                $sale->cust_id = $this->UserID;
                $paymentType = "Sale";
                $captured = 0;

                $shipping_info                     = (object) array();
                $shipping_info->ship_to_first_name = urlencode($post->shipping_name);
                //$shipping_info->ship_to_last_name  = urlencode($post->shipping_last_name);
                $shipping_info->ship_to_last_name  = "";
                $shipping_info->ship_to_address    = urlencode($post->shipping_adderss1." , ".$post->shipping_address2);
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
                $customer->email                   = $this->UserEmail;
                $customer->country                 = urlencode($post->country);
                $customer->phone                   = urlencode($post->phone);

                $sale->amount                      = urlencode($pay_amount);
                $sale->tax                         = urlencode($total_tax);
                $sale->card_num                    = urlencode($post->creditCardNumber);
                $sale->card_code                   = urlencode($post->cvv2Number);
                $sale->exp_date                    = urlencode($post->expDateMonth)."/".urlencode($post->expDateYear);
                $sale->invoice_num                 = substr(time(), 0, 6);
                $sale->description                 = $product_title;
                $sale->setFields($shipping_info);
                $sale->setFields($customer);
                $response = $sale->authorizeOnly();

                $friend_gift =$post->friend_gift;
                $friendName =$post->friend_name;
                $friendEmail =$post->friend_email;
                $country_code = COUNTRY_CODE;
                $product_size="";
                $product_color="";
                $pay_amount = $pay_amount;
                    if ($response->approved) {
                        $transaction_id = $response->transaction_id;
                        $responseheader = array('Order_Status'=>$response->response_reason_text,'Invoice_Number'=>$response->invoice_number,'Authorization_Code'=>$response->authorization_code,'Credit_card'=>$response->card_type,'Billing_Address'=>$response->address);
                        foreach($_SESSION as $key=>$value)
                        {
                            if((is_string($value)) && ($key=='product_cart_id'.$value)){
                                $product_color = 0;
                                $product_size = 0;
                                $qty = $this->session->get('product_cart_qty'.$value);
                                $deal_id = $_SESSION[$key];
                                $this->deals_payment_deatils = $this->authorize->get_product_payment_details($deal_id);
                                foreach($this->deals_payment_deatils as $UL){
                                    $purchase_qty = $UL->purchase_count;
                                    $deal_title = $UL->deal_title;
                                    $deal_value = $UL->deal_value;
                                    $product_shipping = $UL->shipping_amount;
                                    $merchant_id = $UL->merchant_id;
                                    $shipping_methods = $UL->shipping;
                                    $end_date=$UL->end_date;
									$start_date=$UL->start_date;
									$product_offer=$UL->product_offer;
									$gift_offer=$UL->gift_offer;
                                     if($qty>=$UL->bulk_discount_buy && $this->session->get('prime_customer')==1 && $UL->end_date > time() && $UL->start_date < time()&& $UL->bulk_discount_buy!=0)
                                        {
                                        $bulk_discount = $UL->bulk_discount_get;
                                        $bulk_discount1 = $UL->bulk_discount_buy;
                                         $r=(int)($qty / $bulk_discount1);
                                        $total_bulk_discount=$r*$bulk_discount;
										}else{
											$bulk_discount=0;
											$bulk_discount1=0;
											$total_bulk_discount=0;
										}
                                }
                                $this->gift_type=$this->authorize->get_product_gift_type($merchant_id,$deal_id,$gift_offer);
								$gift_type=isset($this->gift_type[0]->gift_type)?$this->gift_type[0]->gift_type:0;
                                        if($shipping_methods  == 1){
                                        $shipping_amount = 0;
                                        }  elseif($shipping_methods  == 2){
                                        $merchant_flat_amount = $this->authorize->get_userflat_amount($merchant_id);
                                        $shipping_amount = $merchant_flat_amount->flat_amount;
                                        } elseif($shipping_methods  == 3){
                                        $shipping_amount =$product_shipping;
                                        } elseif($shipping_methods  == 4){
                                        $shipping_amount =$product_shipping*$qty;
                                        } elseif($shipping_methods  == 5){
                                        $shipping_amount = 0;
                                        }

		                        $taxdeal_amount=($deal_value*$qty)+$shipping_amount;
		                        $tax_amount = ((TAX_PRECENTAGE_VALUE/100)*$taxdeal_amount);

                                        foreach($_SESSION as $key=>$value)
                                        {
                                                if((is_string($value))){
                                                        if(($key=='product_size_qty'.$deal_id)){
                                                                $product_size = $value;
                                                        }
                                                        if(($key=='product_color_qty'.$deal_id)){
                                                                $product_color = $value;
                                                        }
                                                }
                                        }
                                $deal_amount=$deal_value*$qty;
                                if($this->session->get('prime_customer')==1){
                                //if(array_key_exists($merchant_id,$cart_merchant)){
									if($product_offer==2 && $gift_type==1 &&  $end_date > time() && $start_date < time())
									{
										$this->free_gift=$this->authorize->get_free_gift($deal_amount,$merchant_id,$deal_id);
									}elseif($product_offer==2 && $gift_type==0 &&  $end_date > time() && $start_date < time()){

										$this->free_gift=$this->authorize->get_free_gft_not_per_amount($merchant_id,$deal_id,$product_offer);
									}	
										$this->free_gift=isset($this->free_gift[0]->gift_offer)?$this->free_gift[0]->gift_offer:0;
									
                                $transaction = $this->authorize->insert_product_transaction_details($responseheader, $deal_amount,$deal_id, $transaction_id,$country_code, $currencyCode,$post->firstName, $post->firstName, $referral_amount, $qty, 4, $captured, $purchase_qty, $friend_gift, $friendName, $friendEmail,$merchant_id,arr::to_object($this->userPost), $product_size,$product_color,$tax_amount,$shipping_amount, $shipping_methods,$bulk_discount,$this->free_gift,$prime_customer,$bulk_discount1,$total_bulk_discount,$product_offer,$gift_type);

                            $status = $this->do_captured_product_transaction($captured, $deal_id,$qty,$transaction);
						//}
					}else{
						$this->free_gift="";
						$transaction = $this->authorize->insert_product_transaction_details($responseheader, $deal_amount,$deal_id, $transaction_id,$country_code, $currencyCode,$post->firstName, $post->firstName, $referral_amount, $qty, 4, $captured, $purchase_qty, $friend_gift, $friendName, $friendEmail,$merchant_id,arr::to_object($this->userPost), $product_size,$product_color,$tax_amount,$shipping_amount, $shipping_methods,$bulk_discount,$this->free_gift,$prime_customer,$bulk_discount1,$total_bulk_discount,$product_offer,$gift_type);

                            $status = $this->do_captured_product_transaction($captured, $deal_id,$qty,$transaction);
						
					}
                            }
                        }
                        $capture = new AuthorizeNetAIM;
		                $capture->amount = $pay_amount;
			            $capture->trans_id = $transaction_id;
			            $response = $capture->priorAuthCapture();
				        if ($response->approved) {
		                    $now_transaction_id=$response->transaction_id;
		                    $now_authorization_code=$response->authorization_code;
		                    $status = $this->authorize->update_captured_transaction($now_transaction_id,$now_authorization_code, $transaction);
				        } else {
				            $status = $this->authorize->update_captured_transaction_failed($transaction);
				        }
				        $status = $this->do_captured_product_transaction1($captured, $deal_id,$qty,$transaction);
				        $this->transaction_result = array("TIMESTAMP" => date('m/d/Y h:i:s a', time()), "ACK" => $this->Lang['SUCCESS'] ,"AMT"=> $pay_amount1,"CURRENCYCODE"=>CURRENCY_CODE);
						$this->result_transaction = arr::to_object($this->transaction_result);
						$this->session->set('payment_result', $this->result_transaction);
						//url::redirect(PATH.'transaction.html');
                        url::redirect(PATH."payment_product/cart_payment_paypal.html");
                    }   else {
                    $responseheader = array('Error'=>$response->response_reason_text,'Error code'=>$response->response_reason_code,'Authorization Code'=>'Not Authorized','Credit card'=>$response->card_type,'Billing Address'=>$response->address);
                    common::message(-1, $response->response_reason_text);
                    url::redirect(PATH);
                    }

		}
		else{
			common::message(-1, $this->Lang["PAGE_NOT"]);
            url::redirect(PATH."payment_product/problem_payment_paypal.html");
		}
	}


	/** DoDirectPayment - Credit Card  **/

	public function auctionpayment()
	{

		if($_POST){
				$referral_amount = 0;
				$auction_amount = $this->input->post("amount");
				$deal_id = $this->input->post("deal_id");
				$qty = $this->input->post("P_QTY");
				$merchant_id = $this->input->post("merchant_id");
				$bid_id = $this->input->post("bid_id");
				$shipping_amount = $this->input->post("shipping_amount");
				$tax_amount = 0;
                $pay_amount = $pay_amount1 = $auction_amount+$shipping_amount+$tax_amount;
                $product_title = $this->input->post("auction_title");

                $post = arr::to_object($this->input->post());

                // authorize
                $sale = new AuthorizeNetAIM;
                $sale->cust_id = $this->UserID;
                $paymentType = "Sale";
                $captured = 0;
                $purchase_qty = $qty;

                $country_code = COUNTRY_CODE;
                $currencyCode = CURRENCY_CODE;

                if(CURRENCY_CODE !="USD"){ // for Currency conversion
	                $pay_amount = common::currency_conversion(CURRENCY_CODE,"USD",$pay_amount);
	                $tax_amount = common::currency_conversion(CURRENCY_CODE,"USD",$tax_amount);
	                $currencyCode = "USD";
                }

                $shipping_info                     = (object) array();
                $shipping_info->ship_to_first_name = urlencode($post->shipping_name);
                $shipping_info->ship_to_last_name  = urlencode($post->shipping_name);
                $shipping_info->ship_to_address    = urlencode($post->shipping_adderss1." , ".$post->shipping_address2);
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
                $customer->email                   = $this->UserEmail;
                $customer->country                 = urlencode($post->country);
                $customer->phone                   = urlencode($post->phone);

                $sale->amount                      = urlencode($pay_amount);
                $sale->tax                         = urlencode($tax_amount);
                $sale->card_num                    = urlencode($post->creditCardNumber);
                $sale->card_code                   = urlencode($post->cvv2Number);
                $sale->exp_date                    = urlencode($post->expDateMonth)."/".urlencode($post->expDateYear);
                $sale->invoice_num                 = substr(time(), 0, 6);
                $sale->description                 = $product_title;
                $sale->setFields($shipping_info);
                $sale->setFields($customer);

                $response = $sale->authorizeOnly();
                // Authorize from Authorize.net if respose is approved the payment process not error showend


                    if ($response->approved) {
                        $transaction_id = $response->transaction_id;
                        $responseheader = array('Order_Status'=>$response->response_reason_text,'Invoice_Number'=>$response->invoice_number,'Authorization_Code'=>$response->authorization_code,'Credit_card'=>$response->card_type,'Billing_Address'=>$response->address);

                    $transaction = $this->authorize->insert_auction_transaction_details($responseheader, $pay_amount1,$deal_id, $transaction_id,$country_code, $currencyCode,$post->firstName, $post->firstName, $referral_amount, $qty, 4, $captured, $purchase_qty, $merchant_id,$post,$tax_amount,$shipping_amount,$auction_amount,$bid_id);

                     $status = $this->payment_auction_mail_function($deal_id,$transaction);

                        $capture = new AuthorizeNetAIM;
		                $capture->amount = $pay_amount;
			            $capture->trans_id = $transaction_id;
			            $response = $capture->priorAuthCapture();
				        if ($response->approved) {
		                    $now_transaction_id=$response->transaction_id;
		                    $now_authorization_code=$response->authorization_code;
		                    $status = $this->authorize->update_captured_transaction($now_transaction_id,$now_authorization_code, $transaction);

		                    $this->result = arr::to_object(array('TIMESTAMP'=> date('d/m/Y h:i:s A', time()),'ACK'=>$this->Lang['SUCCESS'],'AMT'=>$pay_amount1,'CURRENCYCODE'=>CURRENCY_CODE));
							$this->session->set('payment_result', $this->result);
							url::redirect(PATH.'transaction.html');

				        } else {
				            $status = $this->authorize->update_captured_transaction_failed($transaction);
				          }

                        url::redirect(PATH."payment_product/cart_payment_paypal.html");

                    }   else {
                    $responseheader = array('Error'=>$response->response_reason_text,'Error code'=>$response->response_reason_code,'Authorization Code'=>'Not Authorized','Credit card'=>$response->card_type,'Billing Address'=>$response->address);
                    common::message(-1, $response->response_reason_text);
                    url::redirect(PATH);
                    }

		}
		else{
			common::message(-1, $this->Lang["PAGE_NOT"]);
            url::redirect(PATH."payment_product/problem_payment_paypal.html");
		}
	}

	/** DoDirectPayment - Credit Card  **/

	public function dodirectpayment()
	{
	        if($_POST){
			$deal_id = $this->input->post("deal_id");
			$deal_key = $this->input->post("deal_key");
			$referral_amount = $this->input->post("p_referral_amount");
			$item_qty = $this->input->post("P_QTY");
			$this->deals_payment_deatils = $this->authorize->get_deals_payment_details($deal_id, $deal_key);
			if(count($this->deals_payment_deatils) == 0){
				common::message(-1, $this->Lang["PAGE_NOT"]);
				url::redirect(PATH);
			}
			$this->referral_balance_deatils = $this->authorize->get_user_referral_balance_details();
			$this->get_user_limit_details = $this->authorize->get_user_limit_details($deal_id);
			$this->get_user_limit_count = $this->authorize->get_user_limit_details($deal_id);
			$this->user_referral_balance = $this->authorize->get_user_referral_balance_details();

			foreach($this->deals_payment_deatils as $UL){
				$purchase_qty = $UL->purchase_count;
				$deal_title = $UL->deal_title;
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
				            ->add_rules('country','required')
				            ->add_rules('zip','required')
				            ->add_rules('cvv2Number','required')
				            ->add_rules('deal_value','required')
				            ->add_rules('amount','required')
				            ->add_rules('friend_name','required')
				            ->add_rules('friend_email','required');
			if($post->validate()){
				$post = arr::to_object($this->input->post());
                $sale = new AuthorizeNetAIM;
                // authorize
                $sale->cust_id = $this->UserID;
                if($post->amount != 0)
                {
                    if(($purchase_qty + $item_qty) >= $min_deals_limit){
			            $captured = 0;
		            }else{
			            $captured = 1;
		            }
		            $currencyCode = CURRENCY_CODE;
		            $pay_amount = $post->amount;
		             if(CURRENCY_CODE !="USD"){ // for Currency conversion
						$pay_amount = common::currency_conversion(CURRENCY_CODE,"USD",$pay_amount);
						//$tax_amount = common::currency_conversion(CURRENCY_CODE,"USD",$tax_amount);
						$currencyCode = "USD";
					}
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
                    $sale->phone = urlencode($post->phone);
                    $sale->country = urlencode($post->country);
                    $sale->email = $this->UserEmail;
                    $sale->invoice_num = substr(time(), 0, 6);
                    $sale->description = $deal_title;
                    $response = $sale->authorizeOnly();
                    $friend_gift =$post->friend_gift;
				    $friendName =$post->friend_name;
				    $friendEmail =$post->friend_email;
				    $country_code = COUNTRY_CODE;

				    $pay_amount = $post->amount;
				    if ($response->approved) {
                        $transaction_id = $response->transaction_id;
                        $responseheader = array('Order_Status'=>$response->response_reason_text,'Invoice_Number'=>$response->invoice_number,'Authorization_Code'=>$response->authorization_code,'Credit_card'=>$response->card_type,'Billing_Address'=>$response->address);
                        $transaction = $this->authorize->insert_transaction_details($responseheader, $pay_amount,$deal_id, $transaction_id,$country_code, $currencyCode,$post->firstName, $post->firstName, $referral_amount, $item_qty, 1, $captured, $purchase_qty, $friend_gift, $friendName, $friendEmail,$merchant_id);
                        $status = $this->do_captured_transaction($captured, $deal_id, $item_qty);
                        $mail_status = $this->payment_mail_function($captured, $deal_id, $transaction);
                        $this->result = arr::to_object(array('TIMESTAMP'=> date('d/m/Y h:i:s A', time()),'ACK'=>$this->Lang['SUCCESS'],'AMT'=>$pay_amount,'CURRENCYCODE'=>CURRENCY_CODE));
                        $this->session->set('payment_result', $this->result);
                        url::redirect(PATH.'transaction.html');
                    } else {
                        $responseheader = array('Error'=>$response->response_reason_text,'Error code'=>$response->response_reason_code,'Authorization Code'=>'Not Authorized','Credit card'=>$response->card_type,'Billing Address'=>$response->address);
                        common::message(-1, $response->response_reason_text);
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

	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SENT MAIL **/

	private function do_captured_transaction($captured = "", $deal_id = "", $qty = "")
	{
		if($captured == 0){
			$captured_list = $this->authorize->payment_authorization_list($deal_id);
			$capture = new AuthorizeNetAIM;
			foreach($captured_list as $C){
				if($C->type==4){ // for COD transaction
					$capture->amount = $C->amount;
					$capture->trans_id = $C->transaction_id;
					$response = $capture->priorAuthCapture();
					if ($response->approved) {
						$now_transaction_id=$response->transaction_id;
						$now_authorization_code=$response->authorization_code;
						$status = $this->authorize->update_captured_transaction($now_transaction_id,$now_authorization_code, $C->id);
					} else {
						$status = $this->authorize->update_captured_transaction_failed($C->id);
					}				
				} elseif(($C->type==1)||($C->type==2)){  // for COD transaction
					$nvpStr = "&AUTHORIZATIONID=".$C->transaction_id."&AMT=".$C->amount."&COMPLETETYPE=Complete";
					$result = arr::to_object($this->hash_call("DoCapture", $nvpStr));
					if($result->ACK = "Success" ){
							$status = $this->authorize->update_captured_transaction_paypal($result, $C->id);
					}
				} else {
				        $status = $this->authorize->update_captured_transaction_success($C->id);
				}
			}

			$captured_mail_list = $this->authorize->payment_authorization_mail_list($deal_id);
			foreach($captured_mail_list as $mail){
			    $friend_details = $this->authorize->get_friend_transaction_details($deal_id, $mail->id);
                $friend_email = $friend_details->current()->friend_email;
                $friend_name = $friend_details->current()->friend_name;
			     $this->result_mail = arr::to_object(array("deal_title" => $mail->deal_title, "item_qty" => $mail->quantity ,"total" => $mail->amount + $mail->referral_amount,"ref_amount"=> $mail->referral_amount, "amount"=> $mail->amount ,"friend_name" => $friend_name,"user_name" => $mail->firstname,"value" =>$mail->deal_value,"merchant_id" =>$mail->merchant_id,"ip" => $mail->ip,"ip_city_name" => $mail->ip_city_name,"ip_country_name" => $mail->ip_country_name));

				$transaction_coupon_details = $this->authorize->get_all_deal_captured_coupon($deal_id, $mail->user_id, $mail->order_date);
				$coupon_array = array();
				$coupon_code = "";
				foreach($transaction_coupon_details as $coupon_details){
					$coupon_array[] = $coupon_details->coupon_code;
					//$coupon_code .=  $coupon_details->coupon_code."<br>";
				}
				pdf::pdf_created($coupon_array);
				$file=array();
				for($i=0; $i < count($coupon_array); $i++){
					array_push($file, "images/pdf/Voucher".$i.".pdf");
				}

			    $subject = $this->Lang['THANKS_BUY'];
			    if($friend_email != "xxxyyy@zzz.com"){
                                $store_detail = $this->authorize->get_payment_store_detail($deal_id);
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
			        $from  = NOREPLY_EMAIL;
			        $message_admin = new View("themes/".THEME_NAME."/payment_mail_admin");
                                $this->admin_list = $this->authorize->get_admin_list();
				$this->admin_email = $this->admin_list->current()->email;
				$merchant_email = ""; 
                                $this->get_merchant_details = $this->authorize->get_merchant_details($mail->merchant_id);
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
				$transaction_coupon_update = $this->authorize->update_transaction_coupon_status1($deal_id,$mail->user_id,$mail->order_date);
				for($i=0; $i < count($coupon_array); $i++){
					unlink("images/pdf/Voucher".$i.".pdf");
				}
			}
		}
        $user_details = $this->authorize->get_purchased_user_details();
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->authorize->update_referral_amount($U->referred_user_id);
			}
			/*if($U->facebook_update == 1){
				$deals_details = $this->authorize->get_deals_details($deal_id);
				foreach($deals_details as $D){
					$dealURL = PATH."deals/".$D->deal_key.'/'.$D->url_title.".html";
					$message = $this->Lang['PURS_DEAL'].$D->deal_title." ".$dealURL.$this->Lang['LIMIT_OFF'];
					$post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");
					common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg );
				}
			}*/
		}
		return;
	}


	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SEND MAIL **/

	public function do_captured_product_transaction($captured = "", $deal_id = "", $qty = "",$transaction = "")
	{

                $from = CONTACT_EMAIL;
		$this->products_list = $this->authorize->get_products_coupons_list($transaction,$deal_id);
		$this->product_size = $this->authorize->get_shipping_product_size();
		$this->product_color = $this->authorize->get_shipping_product_color();
                $this->merchant_id = $this->products_list->current()->merchant_id;
                $this->get_merchant_details = $this->authorize->get_merchant_details($this->merchant_id);
                $this->merchant_firstneme = $this->get_merchant_details->current()->firstname;
                $this->merchant_lastname = $this->get_merchant_details->current()->lastname;
                $this->merchant_email = $this->get_merchant_details->current()->email; 
                $message_merchant = new View("themes/".THEME_NAME."/payment_mail_product_merchant");

		if(EMAIL_TYPE==2) {
				email::smtp($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
		}else{
		                email::sendgrid($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
		}
		
		
	    $user_details = $this->authorize->get_purchased_user_details();
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->authorize->update_referral_amount($U->referred_user_id);
			}
			$deals_details = $this->authorize->get_product_details($deal_id);
			if($U->facebook_update == 1){
				foreach($deals_details as $D){
					$dealURL = PATH."deals/".$D->deal_key.'/'.$D->url_title.".html";
					$message = $this->Lang['PURS_DEAL'].$D->deal_title." ".$dealURL.$this->Lang['LIMIT_OFF'];
					$post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");
					common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg);
				}
			}
		}
		return;

	}

	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SEND MAIL **/

	public function do_captured_product_transaction1($captured = "", $deal_id = "", $qty = "",$transaction = "")
	{

	    $user_details = $this->authorize->get_purchased_user_details();
		foreach($user_details as $U){
			$deals_details = $this->authorize->get_product_details($deal_id);

			/** Send Purchase details to user Email **/
			foreach($deals_details as $D){
			    $deal_title = $D->deal_title;
			    $deal_amount = $D->deal_value;
			}

			$friend_details = $this->authorize->get_friend_transaction_product_details($deal_id, $transaction);
            $friend_email = $friend_details->current()->friend_email;
            $friend_name = $friend_details->current()->friend_name;
            if($friend_email != "xxxyyy@zzz.com"){
                $from = CONTACT_EMAIL;
                $this->transaction_mail =array("deal_title" => $deal_title, "item_qty" => $qty ,"total" => ($deal_amount * $qty) ,"amount"=> ($deal_amount * $qty),"ref_amount"=> "0","value" =>$deal_amount,"friend_name" => $friend_name,"value" =>$deal_amount);
                $this->result_mail = arr::to_object($this->transaction_mail);
                $this->admin_list = $this->authorize->get_admin_list();
		$this->admin_email = $this->admin_list->current()->email;
		
                $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail");
                $message_admin = new View("themes/".THEME_NAME."/payment_mail_product_admin");
		if(EMAIL_TYPE==2){
                email::smtp($from, $friend_email, $this->Lang['PRO_GIFT'] ,$friend_message);
                email::smtp($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
		}else{
		 email::sendgrid($from, $friend_email, $this->Lang['PRO_GIFT'] ,$friend_message);
		 email::sendgrid($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);

		}

            } else {
                $from = CONTACT_EMAIL;
				$this->products_list = $this->authorize->get_products_coupons_list($transaction,$deal_id);
				$this->product_size = $this->authorize->get_shipping_product_size();
				$this->product_color = $this->authorize->get_shipping_product_color();
                // $this->transaction_mail = array("deal_title" => $deal_title, "item_qty" => $qty ,"total" => ($deal_amount * $qty) ,"amount"=> ($deal_amount * $qty),"value" =>$deal_amount);
                //$this->result_mail = arr::to_object($this->transaction_mail);
                
                $this->admin_list = $this->authorize->get_admin_list();
		$this->admin_email = $this->admin_list->current()->email;
				
                /* Mail template */
                $message = new View("themes/".THEME_NAME."/payment_mail_product");
                  $message_admin = new View("themes/".THEME_NAME."/payment_mail_product_admin");
		if(EMAIL_TYPE==2){
                email::smtp($from,$U->email, $this->Lang['THANKS_BUY'] ,$message);
                email::smtp($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
		}else{
		 email::sendgrid($from,$U->email, $this->Lang['THANKS_BUY'] ,$message);
		 email::sendgrid($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
		}
            }

		}
		return;

	}

	/** Send Purchase details to user Email **/

	private function payment_mail_function( $captured = "", $deal_id = "", $transaction_id = "")
	{
		if($captured == 1){

			$from = NOREPLY_EMAIL;
			$transaction_details = $this->authorize->get_all_deal_captured_transaction($deal_id, $transaction_id, $captured);
			foreach($transaction_details as $TD){
					$friend_details = $this->authorize->get_friend_transaction_details($deal_id, $transaction_id);
					$friend_email = $friend_details->current()->friend_email;
					$friend_name = $friend_details->current()->friend_name;

				 $this->result_mail = arr::to_object(array("deal_title" => $TD->deal_title, "item_qty" => $TD->quantity ,"total" => $TD->amount + $TD->referral_amount,"ref_amount"=> $TD->referral_amount, "amount"=> $TD->amount ,"friend_name" => $friend_name,"user_name" => $TD->firstname,"value" =>$TD->deal_value,"merchant_id" =>$TD->merchant_id));

					$subject = $this->Lang['THANKS_BUY'];
						if($friend_email != "xxxyyy@zzz.com"){

						 $store_detail = $this->authorize->get_payment_store_detail($deal_id);
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
                                                $this->admin_list = $this->authorize->get_admin_list();
				                $this->admin_email = $this->admin_list->current()->email;
                                                
                                                $merchant_email = ""; 
                                                $this->get_merchant_details = $this->authorize->get_merchant_details($TD->merchant_id);
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

	/** Send Purchase details to user Email **/

	private function payment_auction_mail_function($deal_id = "", $transaction_id = "")
	{
		$this->auction_details = $this->authorize->get_auction_mail_data($deal_id,$transaction_id);
		$message = new View("themes/".THEME_NAME."/auction/auction_payment_mail");
		foreach ($this->auction_details as $row) {
			if($row->facebook_update == 1){
					$dealURL = PATH."auction/".$row->deal_key.'/'.$row->url_title.".html";
					$message = $this->Lang['ACT_PURCASH'].$row->deal_title." ".$dealURL;
					$post_arg = array("access_token" => $row->fb_session_key, "message" => $message, "id" => $row->fb_user_id, "method" => "post");
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

