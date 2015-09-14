<?php defined('SYSPATH') OR die('No direct access allowed.');
class Pay_later_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->pay_later = new Pay_later_Model;
	}

	public function product_payment()
	{
		
		$cart_merchant=array();
		$merchant_id_array=array();
		foreach($_SESSION as $key=>$value)
        {
        if(!is_array($value)){            
            if(($key=='product_cart_id'.$value)){
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
                $this->product_size_details = $this->pay_later->product_size_details($deal_id, $product_size);
                //$dbquantity=$this->product_size_details->current()->quantity;
                 $dbquantity=isset($this->product_size_details[0]->quantity)?$this->product_size_details[0]->quantity:0;

                if($dbquantity < $item_qty || $dbquantity==0){
                    $this->session->set('product_quantity_qty'.$deal_id,$dbquantity);
                    common::message(-1, $this->Lang['CHE_PRO_QTY']);
                    url::redirect(PATH."cart.html");
                }
            }
            
            }
        }
		if($_POST){
			$referral_amount = $this->input->post("p_referral_amount");
			$prime_customer = $this->input->post("prime_customer");
		    $this->userPost = $this->input->post();
			$product_color="";
			$paymentType = "Pay Later";
			$captured = 0;
			$total_amount="";
			$total_qty="";
			$product_title="";
			$produ_qty="";
			$total_shipping="";
			$pay_amount1=0; // for total transaction amount for success page
			$bulk_discount="";
			$bulk_discount1="";
			$total_bulk_discount=0;
			$product_gift=0;
			$gift_type=0;
			$TRANSACTIONID = text::random($type = 'alnum', $length = 16);
			foreach($_SESSION as $key=>$value)
			{
                            if(!is_array($value)){
				if(($key=='product_cart_id'.$value)){
					$product_color = 0;
					$product_size = 0;
					$deal_id = $_SESSION[$key];
					$item_qty = $this->session->get('product_cart_qty'.$deal_id);
					$this->session->set('product_cart_qty'.$deal_id,$item_qty);
					$amount = $this->input->post("amount");
					$this->deals_payment_deatils = $this->pay_later->get_product_payment_details($deal_id);
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
							$merchant_id = $UL->merchant_id;
							$product_shipping = $UL->shipping_amount;
							$shipping_methods = $UL->shipping;
							$end_date=$UL->end_date;
							$start_date=$UL->start_date;
							$product_offer=$UL->product_offer;
							$gift_offer=$UL->gift_offer;
							
							if($item_qty >= $UL->bulk_discount_buy && $this->session->get('prime_customer')==1 && $UL->end_date > time() && $UL->start_date < time()&& $UL->bulk_discount_buy!=0){
                                        $bulk_discount = $UL->bulk_discount_get;
                                        $bulk_discount1 = $UL->bulk_discount_buy;
                                         $r=(int)($item_qty / $bulk_discount1);
                                        $total_bulk_discount=$r*$bulk_discount;
										}else{
											$bulk_discount=0;
											$bulk_discount1=0;
											$total_bulk_discount=0;
										}
										/*if($this->session->get('prime_customer')==1 && $UL->product_offer==2 && $UL->end_date > time() && $UL->start_date < time()){
											$product_gift=$UL->gift_offer;
											
										}else{
											$product_gift=0;
										}*/
					}
					$this->gift_type=$this->pay_later->get_product_gift_type($merchant_id,$deal_id,$gift_offer);
					$gift_type=isset($this->gift_type[0]->gift_type)?$this->gift_type[0]->gift_type:0;
					

					 if($shipping_methods  == 1){
							$shipping_amount = 0;
					}  elseif($shipping_methods  == 2){
							$merchant_flat_amount = $this->pay_later->get_userflat_amount($merchant_id);
							$shipping_amount = $merchant_flat_amount->flat_amount;
					} elseif($shipping_methods  == 3){
							$shipping_amount =$product_shipping;
					} elseif($shipping_methods  == 4){
							$shipping_amount =$product_shipping*$item_qty;
					} elseif($shipping_methods  == 5){
							 $shipping_amount = 0;
					}

					$taxdeal_amount=($deal_value*$item_qty)+$shipping_amount;
					$tax_amount = ((TAX_PRECENTAGE_VALUE/100)*$taxdeal_amount);
					$pay_amount1 += ($taxdeal_amount+$tax_amount);
					
					foreach($_SESSION as $key=>$value)
					{
						if(($key=='product_size_qty'.$deal_id)){
							$product_size = $value;
						}
						if(($key=='product_color_qty'.$deal_id)){
							$product_color = $value;
						}
					}
					if($this->session->get('prime_customer')==1){
								//if(array_key_exists($merchant_id,$cart_merchant)){
									
									$cart_product_amount=$product_amount;
									
									if($product_offer==2 && $gift_type==1 &&  $end_date > time() && $start_date < time())
									{
													$this->free_gift=$this->pay_later->get_free_gift($cart_product_amount,$merchant_id,$deal_id);
												}elseif($product_offer==2 && $gift_type==0 &&  $end_date > time() && $start_date < time()){
												
													$this->free_gift=$this->pay_later->get_free_gft_not_per_amount($merchant_id,$deal_id,$product_offer);
												}
													
													$this->free_gift=isset($this->free_gift[0]->gift_offer)?$this->free_gift[0]->gift_offer:0;
					$transaction = $this->pay_later->insert_cash_delivery_transaction_details($deal_id, $referral_amount, $item_qty, 6, $captured, $purchase_qty,$paymentType,$product_amount,$merchant_id,$product_size,$product_color,$tax_amount,$shipping_amount,$shipping_methods, arr::to_object($this->userPost),$TRANSACTIONID,$bulk_discount,$this->free_gift,$prime_customer,$bulk_discount1,$total_bulk_discount,$product_offer,$gift_type);

					$status = $this->do_captured_transaction($captured, $deal_id,$item_qty,$transaction);
				//}
			}else{
				$this->free_gift="";
				$transaction = $this->pay_later->insert_cash_delivery_transaction_details($deal_id, $referral_amount, $item_qty, 6, $captured, $purchase_qty,$paymentType,$product_amount,$merchant_id,$product_size,$product_color,$tax_amount,$shipping_amount,$shipping_methods, arr::to_object($this->userPost),$TRANSACTIONID,$bulk_discount,$this->free_gift,$bulk_discount1,$total_bulk_discount,$product_offer,$gift_type);

					$status = $this->do_captured_transaction($captured, $deal_id,$item_qty,$transaction);
			}
				}
                            }
			}
	        $status = $this->do_captured_transaction1($captured, $deal_id,$item_qty,$transaction,$TRANSACTIONID);

			$this->transaction_result = array("TIMESTAMP" => date('m/d/Y h:i:s a', time()), "ACK" => $this->Lang['SUCCESS'] ,"AMT"=> $pay_amount1,"CURRENCYCODE"=>CURRENCY_CODE);
                        $this->transaction_result['T_ID'] = $TRANSACTIONID;
			$this->result_transaction = arr::to_object($this->transaction_result);
			$this->session->set('payment_result', $this->result_transaction);
			url::redirect(PATH."payment_product/pay_later_transaction.html");
		}
	}
	
	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SEND MAIL **/

	public function do_captured_transaction($captured = "", $deal_id = "", $qty = "",$transaction = "")
	{
		$from = CONTACT_EMAIL;
		$this->products_list = $this->pay_later->get_products_coupons_list($transaction,$deal_id);
		$this->product_size = $this->pay_later->get_shipping_product_size();
		$this->product_color = $this->pay_later->get_shipping_product_color();

		$this->merchant_id = $this->products_list->current()->merchant_id;
		$this->get_merchant_details = $this->pay_later->get_merchant_details($this->merchant_id);
		$this->merchant_firstneme = $this->get_merchant_details->current()->firstname;
		$this->merchant_lastname = $this->get_merchant_details->current()->lastname;
		$this->merchant_email = $this->get_merchant_details->current()->email;
		$message_merchant = new View("themes/".THEME_NAME."/payment_mail_product_merchant");

		if(EMAIL_TYPE==2) {
			email::smtp($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
			
		}else{
			email::sendgrid($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
		}

		$user_details = $this->pay_later->get_purchased_user_details();
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->pay_later->update_referral_amount($U->referred_user_id);
			}
			$deals_details = $this->pay_later->get_deals_details($deal_id);
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
		$user_details = $this->pay_later->get_purchased_user_details();
		foreach($user_details as $U){

			$deals_details = $this->pay_later->get_deals_details($deal_id);
			/** Send Purchase details to user Email **/
			foreach($deals_details as $D){
				$deal_title = $D->deal_title;
				$deal_amount = $D->deal_value;
			}

			$this->set_pay_later = 1;
			$friend_details = $this->pay_later->get_friend_transaction_details($deal_id, $transaction);
			$friend_email = $friend_details->current()->friend_email;
			$friend_name = $friend_details->current()->friend_name;
            if($friend_email != "xxxyyy@zzz.com"){
                $from = CONTACT_EMAIL;
                $this->transaction_mail =array("deal_title" => $deal_title, "item_qty" => $qty ,"total" => ($deal_amount * $qty) ,"amount"=> ($deal_amount * $qty),"ref_amount"=> "0","value" =>$deal_amount,"friend_name" => $friend_name,"value" =>$deal_amount);
                $this->result_mail = arr::to_object($this->transaction_mail);
                $this->admin_list = $this->pay_later->get_admin_list();
				$this->admin_email = $this->admin_list->current()->email;
				$this->products_list = $this->pay_later->get_products_coupons_list($transaction,$deal_id);
				$this->product_size = $this->pay_later->get_shipping_product_size();
				$this->product_color = $this->pay_later->get_shipping_product_color();
                $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail");
                $message_admin = new View("themes/".THEME_NAME."/payment_mail_product_admin");
                if(EMAIL_TYPE==2) {
					email::smtp($from,$friend_email, $this->Lang['PRO_GIFT']. SITENAME ,$friend_message);
					email::smtp($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
				}else{
					email::sendgrid($from,$friend_email, $this->Lang['PRO_GIFT']. SITENAME ,$friend_message);
					email::sendgrid($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
				}
            } else {
                $from = CONTACT_EMAIL;
				$this->products_list = $this->pay_later->get_products_coupons_list($transaction,$deal_id);
				$this->product_size = $this->pay_later->get_shipping_product_size();
				$this->product_color = $this->pay_later->get_shipping_product_color();

				$this->admin_list = $this->pay_later->get_admin_list();
				$this->admin_email = $this->admin_list->current()->email;
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
	
	public function deal_cash_delivery()
	{
		if($_POST){
			$deal_id = $this->input->post("deal_id");
			$deal_key = $this->input->post("deal_key");
			$referral_amount = $this->input->post("p_referral_amount");
			$item_qty = $this->input->post("P_QTY");
			$amount = $this->input->post("amount");

			$this->deals_payment_deatils = $this->pay_later->get_deals_payment_details($deal_id, $deal_key);

			if(count($this->deals_payment_deatils) == 0){
				common::message(-1, $this->Lang["PAGE_NOT"]);
				url::redirect(PATH);
			}
			$this->referral_balance_deatils = $this->pay_later->get_user_referral_balance_details();
			$this->get_user_limit_details = $this->pay_later->get_user_limit_details($deal_id);
			$this->get_user_limit_count = $this->pay_later->get_user_limit_details($deal_id);
			$this->user_referral_balance = $this->pay_later->get_user_referral_balance_details();

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
			$paymentType = "Pay Later";
			$TRANSACTIONID = text::random($type = 'alnum', $length = 16);
			$transaction = $this->pay_later->insert_deal_pay_later_transaction_details($deal_id,arr::to_object($_POST), $referral_amount,$amount, $item_qty, 6, $captured, $purchase_qty,$merchant_id,$TRANSACTIONID);
			$status = $this->do_captured_transaction_deal($captured, $deal_id, $item_qty);
			$mail_status = $this->payment_mail_function_deal($captured, $deal_id, $transaction);
			$this->transaction_result = array("TIMESTAMP" => date('m/d/Y h:i:s a', time()), "ACK" => $this->Lang['SUCCESS'] ,"AMT"=> $amount,"CURRENCYCODE" =>CURRENCY_CODE);
			$this->result = arr::to_object($this->transaction_result);
			$this->session->set('payment_result', $this->result);
			url::redirect(PATH.'transaction.html');
		}else{
			common::message(-1, $this->Lang["PAGE_NOT"]);
			url::redirect(PATH);
		}
	}

	private function do_captured_transaction_deal($captured = "", $deal_id = "", $qty = "")
	{
		if($captured == 0){
			$this->set_pay_later = 1;
			$captured_list = $this->pay_later->payment_authorization_list($deal_id);
			foreach($captured_list as $C){
				if(($C->type==1)||($C->type==2)){  // for COD transaction
					$nvpStr = "&AUTHORIZATIONID=".$C->transaction_id."&AMT=".$C->amount."&COMPLETETYPE=Complete";
					$result = arr::to_object($this->hash_call("DoCapture", $nvpStr));
					if($result->ACK = "Success" ){
							$status = $this->pay_later->update_captured_transaction($result, $C->id);
					}
				} else {
						$status = $this->pay_later->update_captured_transaction_success($C->id);
				}
			}
			$captured_mail_list = $this->pay_later->payment_authorization_mail_list($deal_id);
			foreach($captured_mail_list as $mail){
				$friend_details = $this->pay_later->get_friend_transaction_details_deal($deal_id, $mail->id);
				$friend_email = $friend_details->current()->friend_email;
				$friend_name = $friend_details->current()->friend_name;
				$this->result_mail = arr::to_object(array("deal_title" => $mail->deal_title, "item_qty" => $mail->quantity ,"total" => $mail->amount + $mail->referral_amount,"ref_amount"=> $mail->referral_amount, "amount"=> $mail->amount ,"friend_name" => $friend_name,"user_name" => $mail->firstname,"value" =>$mail->deal_value,"merchant_id" =>$mail->merchant_id,"ip" => $mail->ip,"ip_city_name" => $mail->ip_city_name,"ip_country_name" => $mail->ip_country_name));

				$transaction_coupon_details = $this->pay_later->get_all_deal_captured_coupon($deal_id, $mail->user_id, $mail->order_date);
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
					$store_detail = $this->pay_later->get_payment_store_detail($deal_id);
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
				$this->admin_list = $this->pay_later->get_admin_list();
				$this->admin_email = $this->admin_list->current()->email;
				
				$merchant_email = ""; 
				$this->get_merchant_details = $this->pay_later->get_merchant_details($mail->merchant_id);
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
				}else {
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
				$transaction_coupon_update = $this->pay_later->update_transaction_coupon_status1($deal_id,$mail->user_id,$mail->order_date);
				for($i=0; $i < count($coupon_array); $i++){
					unlink("images/pdf/Voucher".$i.".pdf");
				}
			}
		}
		$user_details = $this->pay_later->get_purchased_user_details();
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->pay_later->update_referral_amount($U->referred_user_id);
			}
			if($U->facebook_update == 1){
				$deals_details = $this->pay_later->get_deals_details($deal_id);
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
	
	private function payment_mail_function_deal( $captured = "", $deal_id = "", $transaction_id = "")
	{
	    if($captured == 1){
			$this->set_pay_later = 1;
			$from = CONTACT_EMAIL;
			$transaction_details = $this->pay_later->get_all_deal_captured_transaction($deal_id, $transaction_id, $captured);
			foreach($transaction_details as $TD){
				$friend_details = $this->pay_later->get_friend_transaction_details_deal($deal_id, $TD->id);
				$friend_email = $friend_details->current()->friend_email;
				$friend_name = $friend_details->current()->friend_name;
				$this->result_mail = arr::to_object(array("deal_title" => $TD->deal_title, "item_qty" => $TD->quantity ,"total" => $TD->amount + $TD->referral_amount,"ref_amount"=> $TD->referral_amount, "amount"=> $TD->amount ,"friend_name" => $friend_name,"user_name" => $TD->firstname,"value" =>$TD->deal_value,"merchant_id" =>$TD->merchant_id,"ip" =>$TD->ip,"ip_city_name"=>$TD->ip_city_name,"ip_country_name" =>$TD->ip_country_name));
				$subject = $this->Lang['THANKS_BUY'];
				if($friend_email != "xxxyyy@zzz.com"){
					$store_detail = $this->pay_later->get_payment_store_detail($deal_id);
					$store_name = $store_detail->current()->store_name;
					$store_address = $store_detail->current()->address1." ,".$store_detail->current()->address2;
					$phone_number = $store_detail->current()->phone_number;
					$zipcode = $store_detail->current()->zipcode;
					$website = $store_detail->current()->website;
					$city_name = $store_detail->current()->city_name;

					$this->result_mail = arr::to_object(array("deal_title" => $TD->deal_title,"deal_key" => $TD->deal_key,"url_title" => $TD->url_title, "item_qty" => $TD->quantity ,"total" => $TD->amount + $TD->referral_amount,"ref_amount"=> $TD->referral_amount, "amount"=> $TD->amount ,"friend_name" => $friend_name,"value" =>$TD->deal_value,"user_name" => $TD->firstname,"expirydate"=>$TD->expirydate,"couponcode"=>"","purchase_count"=>$TD->purchase_count,"minimum_deals_limit"=>$TD->minimum_deals_limit,"value" =>$TD->deal_value,"store_name" => $store_name,"store_address" =>$store_address,"zipcode" =>$zipcode,"phone_number" => $phone_number,"website" => $website,"city_name" =>$city_name,"merchant_id" =>$TD->merchant_id,"ip" =>$TD->ip,"ip_city_name"=>$TD->ip_city_name,"ip_country_name" =>$TD->ip_country_name));
					$friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail");
				} else {
					$this->coupon_active = 0;// for check the coupon is active
					$message = new View("themes/".THEME_NAME."/payment_mail");
				}
							
				$message_admin = new View("themes/".THEME_NAME."/payment_mail_admin");
				$this->admin_list = $this->pay_later->get_admin_list();
				$this->admin_email = $this->admin_list->current()->email;


				$merchant_email = ""; 
				$this->get_merchant_details = $this->pay_later->get_merchant_details($TD->merchant_id);
				$merchant_email = $this->get_merchant_details->current()->email;
				$this->merchant_firstname = $this->get_merchant_details->current()->firstname;
				$this->merchant_lastname = $this->get_merchant_details->current()->lastname;
				$message_merchant = new View("themes/".THEME_NAME."/payment_mail_merchant");

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
	
	public function auction_payment()
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
			
			$transaction = $this->pay_later->insert_auction_pay_transaction_details($deal_id,$referral_amount, $item_qty, 6, $captured, $item_qty, $post,$merchant_id,$tax_amount,$shipping_amount,$amount,$bid_id);	
					
			$status = $this->payment_mail_function($deal_id,$transaction);
			$this->results = arr::to_object(array('TIMESTAMP'=> date('d/m/Y h:i:s A', time()),'ACK'=>$this->Lang['SUCCESS'],'AMT'=>$tot_amount1,'CURRENCYCODE'=>CURRENCY_CODE));
			$this->session->set('payment_result', $this->results);
			url::redirect(PATH.'transaction.html');
		} else {
			common::message(-1, $this->Lang["PAGE_NOT"]);  
			url::redirect(PATH."auction.html");	
		}
	}
	
	private function payment_mail_function($deal_id = "", $transaction_id = "")
	{
		$this->auction_details = $this->pay_later->get_auction_mail_data($deal_id,$transaction_id);
		$this->set_pay_later = 1;
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
			}else{
				email::sendgrid($from,$row->email, $subject, $message);
			}
 		}
		return;
	}
}
