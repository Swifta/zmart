<?php defined('SYSPATH') OR die('No direct access allowed.');
class Creditcard_paypal_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->paypal = new Paypal_Model;
		$this->creditcard_paypal_pay = new Creditcard_paypal_Model;
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
                                $this->product_size_details = $this->creditcard_paypal_pay->product_size_details($deal_id, $product_size);
                                //$dbquantity=$this->product_size_details->current()->quantity;
                                $dbquantity=isset($this->product_size_details[0]->quantity)?$this->product_size_details[0]->quantity:0;

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
			        $this->deals_payment_deatils = $this->creditcard_paypal_pay->get_product_payment_details($deal_id);
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
				         $merchant_id = $UL->merchant_id;
				        $shipping_methods = $UL->shipping;
			        }

			         if($shipping_methods  == 1){
			        $total_shipping += 0;
			        }  elseif($shipping_methods  == 2){
			        $merchant_flat_amount = $this->creditcard_paypal_pay->get_userflat_amount($merchant_id);
			        $total_shipping += $merchant_flat_amount->flat_amount;
			        } elseif($shipping_methods  == 3){
			        $total_shipping +=$shipping_amount;
			        } elseif($shipping_methods  == 4){
			        $total_shipping +=$shipping_amount*$item_qty;
			        } elseif($shipping_methods  == 5){
			        $total_shipping += 0;
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

				$friend_gift =$post->friend_gift;
				$friendName =$post->friend_name;
				$friendEmail =$post->friend_email;
				$product_size="";
				$product_color="";

				if(CURRENCY_CODE !="USD"){ // for Currency conversion
					$pay_amount = common::currency_conversion(CURRENCY_CODE,"USD",$pay_amount);
					$currencyCode = "USD";
				}
				//echo $pay_amount; exit;

				$nvpstr ="&PAYMENTACTION=$paymentType&AMT=$pay_amount&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country_code&CURRENCYCODE=$currencyCode";
				$this->result = arr::to_object($this->hash_call("doDirectPayment", $nvpstr));
				$ack = strtoupper($this->result->ACK);
				if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
				foreach($_SESSION as $key=>$value)
                {
                    if((is_string($value)) && ($key=='product_cart_id'.$value)){
                    $product_color = 0;
                    $product_size = 0;
                    $qty = $this->session->get('product_cart_qty'.$value);
                    $deal_id = $_SESSION[$key];
                    $this->deals_payment_deatils = $this->creditcard_paypal_pay->get_product_payment_details($deal_id);
			        foreach($this->deals_payment_deatils as $UL){
			            $purchase_qty = $UL->purchase_count;
			            $deal_value = $UL->deal_value;
			            $merchant_id = $UL->merchant_id;
			            $product_shipping = $UL->shipping_amount;
			            $deal_title = $UL->deal_title;
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
			        $this->gift_type=$this->creditcard_paypal_pay->get_product_gift_type($merchant_id,$deal_id,$gift_offer);
					$gift_type=isset($this->gift_type[0]->gift_type)?$this->gift_type[0]->gift_type:0;

			        if($shipping_methods  == 1){
                                        $shipping_amount = 0;
                                }  elseif($shipping_methods  == 2){
                                        $merchant_flat_amount = $this->creditcard_paypal_pay->get_userflat_amount($merchant_id);
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
                    if(($key=='product_size_qty'.$deal_id)){
                        $product_size = $value;
                    }
                    if(($key=='product_color_qty'.$deal_id)){
                        $product_color = $value;
                    }

                    }
			        $deal_amount=$deal_value*$qty;
			        if($this->session->get('prime_customer')==1){
					//if(array_key_exists($merchant_id,$cart_merchant)){
					if($product_offer==2 && $gift_type==1 &&  $end_date > time() && $start_date < time())
					{
					$this->free_gift=$this->creditcard_paypal_pay->get_free_gift($deal_amount,$merchant_id,$deal_id);
					}elseif($product_offer==2 && $gift_type==0 &&  $end_date > time() && $start_date < time()){

					$this->free_gift=$this->creditcard_paypal_pay->get_free_gft_not_per_amount($merchant_id,$deal_id,$product_offer);
					}	
					$this->free_gift=isset($this->free_gift[0]->gift_offer)?$this->free_gift[0]->gift_offer:0;
					
			        $transaction = $this->creditcard_paypal_pay->insert_transaction_details($this->result, $deal_id, $country_code, $firstName, $lastName, $referral_amount, $qty, 1, $captured, $purchase_qty, arr::to_object($this->userPost),$merchant_id,$friend_gift, $friendName, $friendEmail, $product_size,$product_color,$tax_amount,$shipping_amount,$deal_amount,$shipping_methods,$bulk_discount,$this->free_gift,$prime_customer,$bulk_discount1,$total_bulk_discount,$product_offer,$gift_type);

			       $status = $this->do_captured_transaction($captured, $deal_id,$qty,$transaction);
				//}
			}else{
				$this->free_gift="";
				$transaction = $this->creditcard_paypal_pay->insert_transaction_details($this->result, $deal_id, $country_code, $firstName, $lastName, $referral_amount, $qty, 1, $captured, $purchase_qty, arr::to_object($this->userPost),$merchant_id,$friend_gift, $friendName, $friendEmail, $product_size,$product_color,$tax_amount,$shipping_amount,$deal_amount,$shipping_methods,$bulk_discount,$this->free_gift,$prime_customer,$bulk_discount1,$total_bulk_discount,$product_offer,$gift_type);

			       $status = $this->do_captured_transaction($captured, $deal_id,$qty,$transaction);
			}


			        }
				}
				$status = $this->do_captured_transaction1($captured, $deal_id,$qty,$transaction,$this->result->TRANSACTIONID);

				$this->transaction_result = array("TIMESTAMP" => date('m/d/Y h:i:s a', time()), "ACK" => $this->Lang['SUCCESS'] ,"AMT"=> $pay_amount1,"CURRENCYCODE"=>CURRENCY_CODE);
	                $this->result_transaction = arr::to_object($this->transaction_result);
	                $this->session->set('payment_result', $this->result_transaction);
	                //url::redirect(PATH.'transaction.html');
	                url::redirect(PATH."payment_product/cart_payment_paypal.html");

				} else {

					common::message(-1, $this->Lang["PROB_PAYPAL"]);
					url::redirect(PATH."cart.html");
				}

		}
		else{
					common::message(-1, $this->Lang["PAGE_NOT"]);
            url::redirect(PATH."payment_product/problem_payment_paypal.html");
		}
	}

	/** Paypal Payment - Express check out **/
	public function expresscheckout()
	{

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
			
                $this->product_size_details = $this->creditcard_paypal_pay->product_size_details($deal_id, $product_size);

                //$dbquantity=$this->product_size_details->current()->quantity;
                 $dbquantity=isset($this->product_size_details[0]->quantity)?$this->product_size_details[0]->quantity:0;

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
		        $pay="";
		        $total_shipping="";
		        $total_pro_amount = "";
		        $i=0;
		        
		        $product_amount =0;
		        $product_amount_org =0;
		        $shipping_methods="";
		        $purchase_qty = "";
				$deal_title = "";
				$deal_key="";
				$deal_value="";
		foreach($_SESSION as $key=>$value)
                {
                    if((is_string($value)) && ($key=='product_cart_id'.$value)){
                    $deal_id = $_SESSION[$key];
                    $item_qty = $this->session->get('product_cart_qty'.$deal_id);
                    //$this->session->set('product_cart_qty'.$deal_id,$item_qty);
                    $amount = $this->input->post("amount");
			        $this->deals_payment_deatils = $this->creditcard_paypal_pay->get_product_payment_details($deal_id);
			        /* if(count($this->deals_payment_deatils) == 0){
                        unset($_SESSION[$key]);
                        $this->session->delete('product_cart_qty'.$value);
                        $this->session->delete("count");
				        common::message(-1, $this->Lang["PAGE_NOT"]);
				        url::redirect(PATH."products.html");
			        } */
			        foreach($this->deals_payment_deatils as $UL){
			            $purchase_qty = $UL->purchase_count;
				        $deal_title = $UL->deal_title;
				        $deal_key  = $UL->deal_key;
				        $url_title = $UL->url_title;
					$deal_value = $UL->deal_value;
					$merchant_id = $UL->merchant_id;
					$deal_value1 = common::currency_conversion(CURRENCY_CODE,"USD",$UL->deal_value);
					/* for Currency conversion  */
				        $shipping_amount = $UL->shipping_amount;
				        $shipping_methods = $UL->shipping;
				        $product_amount = $UL->deal_value*$item_qty;
				        //$product_amount_org = common::currency_conversion(CURRENCY_CODE,"USD",$product_amount);
				        $product_amount_org = $deal_value1*$item_qty;
			        }
			        $total_amount +=$product_amount;
			        $total_pro_amount +=$product_amount_org;
			        if($shipping_methods  == 1){
			        $total_shipping += 0;
			        }  elseif($shipping_methods  == 2){
			        $merchant_flat_amount = $this->creditcard_paypal_pay->get_userflat_amount($merchant_id);
			        $total_shipping += $merchant_flat_amount->flat_amount;
			        } elseif($shipping_methods  == 3){
			        $total_shipping +=$shipping_amount;
			        } elseif($shipping_methods  == 4){
			        $total_shipping +=$shipping_amount*$item_qty;
			        } elseif($shipping_methods  == 5){
			        $total_shipping += 0;
			        }

			        $total_qty += $item_qty;
			        $product_title .=$deal_title.",";
			        $produ_qty .=$item_qty.",";

			        if(CURRENCY_CODE !="USD"){    // for Currency conversion
						$deal_value = $deal_value1;
				}

			        $pay .="&L_PAYMENTREQUEST_0_NAME$i=".preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%-]/s", '', $deal_title)."&L_PAYMENTREQUEST_0_NUMBER$i=".$deal_key."&L_PAYMENTREQUEST_0_AMT$i=".$deal_value."&L_PAYMENTREQUEST_0_QTY$i=".$item_qty."&LOGOIMG=".PATH.'themes/'.THEME_NAME.'/images/logo.png';
			        $i++;
			       }
	            }

                    $currencyCodeType = CURRENCY_CODE;
                    $pay_amount1=0; // for total transaction amount for success page

                $total_tax = (TAX_PRECENTAGE_VALUE/100)*($total_amount+$total_shipping);
                $total_shipping_amount = $pay_amount1 = $total_amount+$total_shipping+$total_tax;

					if(CURRENCY_CODE !="USD"){ // for Currency conversion
						$total_shipping = common::currency_conversion(CURRENCY_CODE,"USD",$total_shipping);
						$total_tax = (TAX_PRECENTAGE_VALUE/100)*($total_pro_amount+$total_shipping);
						$total_tax = common::truncate_digits($total_tax); // Truncate and get only the two digits.
						$total_shipping_amount = $total_pro_amount+$total_shipping+$total_tax;
						$currencyCodeType = "USD";
					}

                                        $to_pay ="&PAYMENTREQUEST_0_SHIPPINGAMT=".$total_shipping."&PAYMENTREQUEST_0_TAXAMT=".$total_tax."&PAYMENTREQUEST_0_ITEMAMT=".$total_pro_amount."&PAYMENTREQUEST_0_AMT=".$total_shipping_amount;
                                        $friend_name = $this->input->post("friend_name");
                                        $friend_email = $this->input->post("friend_email");
                                        $friend_gift_status = $this->input->post("friend_gift");
                                        $userPost_status = arr::to_object($this->userPost);
                                        $captured =0;
		        $deal_custom_details = $deal_id."--".$referral_amount."--".$total_qty."--".$purchase_qty."--".$captured."--".$friend_name."--".$friend_email."--".$friend_gift_status;
		        $returnURL = urlencode(PATH."creditcard_paypal/authorize/".$deal_id."/".$friend_name."/".$friend_email."/".$friend_gift_status."/".$userPost_status->adderss1."/".$userPost_status->address2."/".$userPost_status->state."/".$userPost_status->city."/".$userPost_status->country."/".$userPost_status->shipping_name."/".$userPost_status->postal_code."/".$userPost_status->phone."/".$pay_amount1."/".$prime_customer);
		        $cancelURL = urlencode(PATH."cart_checkout.html");

		        $paymentType = "Sale";
		       $nvpstr="&METHOD=".'SetExpressCheckout'."&RETURNURL=".$returnURL."&CANCELURL=".$cancelURL."&PAYMENTREQUEST_0_PAYMENTACTION=".$paymentType.$pay.$to_pay."&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCodeType;
      			$resArray = $this->hash_call("SetExpressCheckout",$nvpstr);

		        $ack = strtoupper($resArray["ACK"]);
	            if($ack == "SUCCESS" || $ack == 'SUCCESSWITHWARNING'){
		            $this->session->set("IS_authorize", 1);
		            url::redirect($this->Paypal_Url.urldecode($resArray["TOKEN"]));
	            }
	            else{
		            common::message(-1, $this->Lang["PLES_TRY_SOMETIMES"]);
		            url::redirect(PATH."cart.html");
	            }

                $this->referral_amount_payment_deatils = $this->creditcard_paypal_pay->products_referral_amount_payment_deatils($referral_amount);
                common::message(1, $this->Lang["THANK_FOR_PURCH"]);
                url::redirect(PATH."payment_product/cart_payment_paypal.html");
	       }
	       else{

			common::message(-1, $this->Lang["PAGE_NOT"]);
		}
		url::redirect(PATH."payment_product/problem_payment_paypal.html");
	}

	/** Redirect After paypal authorize (Success) **/

	public function authorize($deal_id = "", $friend_name= "",$friend_email = "", $friend_gift_status = "", $adderss1= "", $adderss2 = "", $state = "", $city= "",$country = "", $shipping_name = "", $postal_code= "",$phone = "",$pay_amount1=0,$prime_customer=0)
	{
		$status = $this->session->get("IS_authorize");
		$cart_merchant=array();
        $merchant_id_array=array();
		if($status == 1){
			$this->session->delete("IS_authorize");
			$token =urlencode($_REQUEST['token']);
			$nvpstr="&TOKEN=".$token;
			$Response = $this->hash_call("GetExpressCheckoutDetails", $nvpstr);
			$ack = strtoupper($Response["ACK"]);
			if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
				$Response = arr::to_object($Response);
				$paymentType = "Sale";
				$captured = "0";
				$qty="";
				$product_size="";
				$product_color="";
				$referral_amount="";
				$shipping_amount = 0;
				$tax_amount = "";
				$currencyCodeType = "USD";
				$bulk_discount="";
				$bulk_discount1="";
				$total_bulk_discount=0;
				$product_gift=0;
				$gift_type=0;
				$nvpstr ="&TOKEN=".$Response->TOKEN."&PAYERID=".$Response->PAYERID."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType."&AMT=".$Response->AMT;
				$result = arr::to_object($this->hash_call("DoExpressCheckoutPayment",$nvpstr));
				$ack = strtoupper($result->ACK);

                                if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
									/*if($this->session->get('prime_customer')==1){
									foreach($_SESSION as $key=>$value)
                                {
                                        if((is_string($value)) && ($key=='product_cart_id'.$value)){
											$deal_id = $_SESSION[$key];
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
									}
								}
							}*/

                                foreach($_SESSION as $key=>$value)
                                {
                                        if((is_string($value)) && ($key=='product_cart_id'.$value)){
                                                $product_color = 0;
                                                $product_size = 0;
                                                $qty = $this->session->get('product_cart_qty'.$value);
                                                $deal_id = $_SESSION[$key];
                                                foreach($_SESSION as $key=>$value)
                                                {
                                                        if((is_string($value))) {
                                                                if(($key=='product_size_qty'.$deal_id)){
                                                                        $product_size = $value;
                                                                }
                                                                if(($key=='product_color_qty'.$deal_id)){
                                                                        $product_color = $value;
                                                                }
                                                        }
                                                }
                                                
                                                
                                                $this->deals_payment_deatils = $this->creditcard_paypal_pay->get_product_payment_details($deal_id);
                                                foreach($this->deals_payment_deatils as $UL){
                                                        $purchase_qty = $UL->purchase_count;
                                                        $deal_value = $UL->deal_value;
                                                        $merchant_id = $UL->merchant_id;
                                                        $product_shipping = $UL->shipping_amount;
                                                        $shipping_methods = $UL->shipping;			            
                                                       $end_date=$UL->end_date;
							$start_date=$UL->start_date;
							$product_offer=$UL->product_offer;
							$gift_offer=$UL->gift_offer;
							
							if($qty >= $UL->bulk_discount_buy && $this->session->get('prime_customer')==1 && $UL->end_date > time() && $UL->start_date < time()&& $UL->bulk_discount_buy!=0){
                                        $bulk_discount = $UL->bulk_discount_get;
                                        $bulk_discount1 = $UL->bulk_discount_buy;
                                         $r=(int)($qty / $bulk_discount1);
                                        $total_bulk_discount=$r*$bulk_discount;
										}else{
											$bulk_discount=0;
											$bulk_discount1=0;
											$total_bulk_discount=0;
										}            
                                                        $merchant_id = $UL->merchant_id;			            
                                                }
                                                $this->gift_type=$this->creditcard_paypal_pay->get_product_gift_type($merchant_id,$deal_id,$gift_offer);
												$gift_type=isset($this->gift_type[0]->gift_type)?$this->gift_type[0]->gift_type:0;
                                                
                                                if($shipping_methods  == 1){
                                                        $shipping_amount = 0;
                                                }  elseif($shipping_methods  == 2){
                                                        $merchant_flat_amount = $this->creditcard_paypal_pay->get_userflat_amount($merchant_id);
                                                        $shipping_amount = $merchant_flat_amount->flat_amount;
                                                } elseif($shipping_methods  == 3){
                                                        $shipping_amount =$product_shipping;
                                                } elseif($shipping_methods  == 4){
                                                        $shipping_amount =$product_shipping*$qty;
                                                } elseif($shipping_methods  == 5){
                                                        $shipping_amount = 0;
                                                }
                                                
                                                $deal_amount=$deal_value*$qty;
                                                $taxdeal_amount=($deal_value*$qty)+$shipping_amount;
                                                $tax_amount = ((TAX_PRECENTAGE_VALUE/100)*$taxdeal_amount);
                                                
                                                if($this->session->get('prime_customer')==1){
                                                
                                               // if(array_key_exists($merchant_id,$cart_merchant)){
													$cart_product_amount=$deal_amount;
									if($product_offer==2 && $gift_type==1 &&  $end_date > time() && $start_date < time())
									{
													$this->free_gift=$this->creditcard_paypal_pay->get_free_gift($cart_product_amount,$merchant_id,$deal_id);
												}elseif($product_offer==2 && $gift_type==0 &&  $end_date > time() && $start_date < time()){
												
													$this->free_gift=$this->creditcard_paypal_pay->get_free_gft_not_per_amount($merchant_id,$deal_id,$product_offer);
												}
													//$this->free_gift=isset($this->free_gift[0]->gift_id)?$this->free_gift[0]->gift_id:0;
													$this->free_gift=isset($this->free_gift[0]->gift_offer)?$this->free_gift[0]->gift_offer:0;
                                                $transaction = $this->creditcard_paypal_pay->insert_paypal_transaction_details($result, $Response, 2, $deal_id, $referral_amount, $qty, $purchase_qty, $captured, $paymentType,$deal_amount,$merchant_id,$friend_name, $friend_email, $friend_gift_status, $adderss1, $adderss2, $state, $city, $country, $product_size,$product_color,$shipping_name,$postal_code,$phone,$tax_amount,$shipping_amount,$shipping_methods,$bulk_discount,$this->free_gift,$prime_customer,$bulk_discount1,$total_bulk_discount,$product_offer,$gift_type);
                                                $status = $this->do_captured_transaction($captured, $deal_id, $qty,$transaction);
												//}
                                                
											}else{
												$this->free_gift="";
												 $transaction = $this->creditcard_paypal_pay->insert_paypal_transaction_details($result, $Response, 2, $deal_id, $referral_amount, $qty, $purchase_qty, $captured, $paymentType,$deal_amount,$merchant_id,$friend_name, $friend_email, $friend_gift_status, $adderss1, $adderss2, $state, $city, $country, $product_size,$product_color,$shipping_name,$postal_code,$phone,$tax_amount,$shipping_amount,$shipping_methods,$bulk_discount,$this->free_gift,$prime_customer,$bulk_discount1,$total_bulk_discount,$product_offer,$gift_type);
                                                $status = $this->do_captured_transaction($captured, $deal_id, $qty,$transaction);
											}
                                        }
                                }

                                $status = $this->do_captured_transaction1($captured, $deal_id,$qty,$transaction,$result->TRANSACTIONID);
                                $this->transaction_result = array("TIMESTAMP" => date('m/d/Y h:i:s a', time()), "ACK" => "Success" ,"AMT"=> $pay_amount1,"CURRENCYCODE"=>CURRENCY_CODE);
                                $this->result_transaction = arr::to_object($this->transaction_result);
                                $this->session->set('payment_result', $this->result_transaction);
                                //  url::redirect(PATH.'transaction.html');
                                url::redirect(PATH."payment_product/cart_payment_paypal.html");

                                }
				else {
					common::message(-1, $this->Lang["PROB_PAYPAL"]);
				}
			}
			else {
				common::message(-1, $this->Lang["PROB_PAYPAL"]);
			}
		}
		else{
			common::message(-1, $this->Lang["PAGE_NOT"]);

		}
		url::redirect(PATH."payment_product/problem_payment_paypal.html");
	}

	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SEND MAIL **/

	public function do_captured_transaction($captured = "", $deal_id = "", $qty = "",$transaction = "")
	{
	
                $from = CONTACT_EMAIL;
		$this->products_list = $this->creditcard_paypal_pay->get_products_coupons_list($transaction,$deal_id);
		$this->product_size = $this->creditcard_paypal_pay->get_shipping_product_size();
		$this->product_color = $this->creditcard_paypal_pay->get_shipping_product_color();
                $this->merchant_id = $this->products_list->current()->merchant_id;
                $this->get_merchant_details = $this->creditcard_paypal_pay->get_merchant_details($this->merchant_id);
                $this->merchant_firstneme = $this->get_merchant_details->current()->firstname;
                $this->merchant_lastname = $this->get_merchant_details->current()->lastname;
                $this->merchant_email = $this->get_merchant_details->current()->email; 
                
                $message_merchant = new View("themes/".THEME_NAME."/payment_mail_product_merchant");
                
		if(EMAIL_TYPE==2) {
				email::smtp($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
		}else{
		                email::sendgrid($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
		}
				
				
		$user_details = $this->paypal->get_purchased_user_details();
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->creditcard_paypal_pay->update_referral_amount($U->referred_user_id);
			}
			$deals_details = $this->creditcard_paypal_pay->get_deals_details($deal_id);
			/*if($U->facebook_update == 1){
				foreach($deals_details as $D){
					$dealURL = PATH."product/".$D->deal_key.'/'.$D->url_title.".html";
					$message = $this->Lang['PRO_PURCASH'].$D->deal_title." ".$dealURL;
					$post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");
					common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg);
				}
			}*/

		}
		return;
	}

	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SEND MAIL **/

	public function do_captured_transaction1($captured = "", $deal_id = "", $qty = "",$transaction = "",$transid ="")
	{
                $user_details = $this->paypal->get_purchased_user_details();
                foreach($user_details as $U){
                        $deals_details = $this->creditcard_paypal_pay->get_deals_details($deal_id);
                        /** Send Purchase details to user Email **/
                        foreach($deals_details as $D){
                            $deal_title = $D->deal_title;
                            $deal_amount = $D->deal_value;
                        }

                $friend_details = $this->creditcard_paypal_pay->get_friend_transaction_details($deal_id, $transaction);
                $friend_email = $friend_details->current()->friend_email;
                $friend_name = $friend_details->current()->friend_name;
                if($friend_email != "xxxyyy@zzz.com"){
                $from = CONTACT_EMAIL;
                $this->transaction_mail =array("deal_title" => $deal_title, "item_qty" => $qty ,"total" => ($deal_amount * $qty) ,"amount"=> ($deal_amount * $qty),"ref_amount"=> "0","value" =>$deal_amount,"friend_name" => $friend_name,"value" =>$deal_amount);
                $this->result_mail = arr::to_object($this->transaction_mail);
                
                $this->products_list = $this->creditcard_paypal_pay->get_products_coupons_list($transaction,$deal_id);
		$this->product_size = $this->creditcard_paypal_pay->get_shipping_product_size();
		$this->product_color = $this->creditcard_paypal_pay->get_shipping_product_color();
		$this->admin_list = $this->creditcard_paypal_pay->get_admin_list();
		$this->admin_email = $this->admin_list->current()->email;
				
                $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail");
                $message_admin = new View("themes/".THEME_NAME."/payment_mail_product_admin");
                
				if(EMAIL_TYPE==2) {
					email::smtp($from, $friend_email, $this->Lang['PRO_GIFT'] ,$friend_message);
					email::smtp($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
				} else {
				        email::sendgrid($from, $friend_email, $this->Lang['PRO_GIFT'] ,$friend_message);
				        email::sendgrid($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
				}
               } else {
                                $from = CONTACT_EMAIL;
				$this->products_list = $this->creditcard_paypal_pay->get_products_coupons_list($transaction,$deal_id);
				$this->product_size = $this->creditcard_paypal_pay->get_shipping_product_size();
				$this->product_color = $this->creditcard_paypal_pay->get_shipping_product_color();
				
				$this->admin_list = $this->creditcard_paypal_pay->get_admin_list();
				$this->admin_email = $this->admin_list->current()->email;
                                // $this->transaction_mail = array("deal_title" => $deal_title, "item_qty" => $qty ,"total" => ($deal_amount * $qty) ,"amount"=> ($deal_amount * $qty),"value" =>$deal_amount);
                                // $this->result_mail = arr::to_object($this->transaction_mail);
                                /* Mail template */
                                $message = new View("themes/".THEME_NAME."/payment_mail_product");
                                $message_admin = new View("themes/".THEME_NAME."/payment_mail_product_admin");

				if(EMAIL_TYPE==2) {
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

	private function hash_call($methodName, $nvpStr)
	{
		/*
			TODO
			Clear this on production.
			This change is to enable test of paypal on 
			a http rather than https.
			Changed:
			 .CURLOPT_SSL_VERIFYPEER from TRUE to FALSE
			 .CURLOPT_SSL_VERIFYHOST from TRUE to FALSE
			@Live
		*/
		$nvpheader = $this->nvpHeader();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
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

             url::redirect(PATH."merchant/problem_payment_paypal.html");
		}
	        $this->session->delete('payment_result');
		$this->template->content = new View("themes/".THEME_NAME."/success_payment");
	}
}
