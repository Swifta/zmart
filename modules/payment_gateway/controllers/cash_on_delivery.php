<?php defined('SYSPATH') OR die('No direct access allowed.');
class Cash_on_delivery_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->cash = new Cash_on_delivery_Model;
	}

	/** CASH ON DELIVERY  **/

	public function cash_delivery()
	{
	
	$cart_merchant=array();
    $merchant_id_array=array();
	foreach($_SESSION as $key=>$value)
        {
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
                if($this->session->get('prime_customer')==1){
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
                $this->product_size_details = $this->cash->product_size_details($deal_id, $product_size);
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
			$product_color="";
			$paymentType = "COD";
			$captured = 0;
			$total_amount="";
		        $total_qty="";
		        $product_title="";
		        $produ_qty="";
		        $total_shipping="";
		        $pay_amount1=0; // for total transaction amount for success page
		        $bulk_discount="":
		        $TRANSACTIONID = text::random($type = 'alnum', $length = 16);
		        


		        foreach($_SESSION as $key=>$value)
                {
                    if(($key=='product_cart_id'.$value)){
						$product_color = 0;
                        $product_size = 0;

                    $deal_id = $_SESSION[$key];
                    $item_qty = $this->session->get('product_cart_qty'.$deal_id);
                    $this->session->set('product_cart_qty'.$deal_id,$item_qty);
                    $amount = $this->input->post("amount");
			        $this->deals_payment_deatils = $this->cash->get_product_payment_details($deal_id);

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
                                        if($UL->bulk_discount_buy>=$item_qty && $this->session->get('prime_customer')==1)
                                        {
                                        $bulk_discount = $UL->bulk_discount_get;
										}
                                }

                                 if($shipping_methods  == 1){
                                        $shipping_amount = 0;
                                }  elseif($shipping_methods  == 2){
                                        $merchant_flat_amount = $this->cash->get_userflat_amount($merchant_id);
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
								if(array_key_exists($merchant_id,$cart_merchant)){
													$this->free_gift=$this->cash->get_free_gift($cart_merchant[$merchant_id],$merchant_id);	
													$this->free_gift=isset($this->free_gift[0]->gift_id)?$this->free_gift[0]->gift_id:0;
                                $transaction = $this->cash->insert_cash_delivery_transaction_details($deal_id, $referral_amount, $item_qty, 5, $captured, $purchase_qty,$paymentType,$product_amount,$merchant_id,$product_size,$product_color,$tax_amount,$shipping_amount,$shipping_methods, arr::to_object($this->userPost),$TRANSACTIONID,$bulk_discount,$this->free_gift,$prime_customer);

				$status = $this->do_captured_transaction($captured, $deal_id,$item_qty,$transaction);
			}
		}else{
			$this->free_gift="";
			$transaction = $this->cash->insert_cash_delivery_transaction_details($deal_id, $referral_amount, $item_qty, 5, $captured, $purchase_qty,$paymentType,$product_amount,$merchant_id,$product_size,$product_color,$tax_amount,$shipping_amount,$shipping_methods, arr::to_object($this->userPost),$TRANSACTIONID,$bulk_discount,$this->free_gift,$prime_customer);

				$status = $this->do_captured_transaction($captured, $deal_id,$item_qty,$transaction);
		}
			       }
	            }
	            $status = $this->do_captured_transaction1($captured, $deal_id,$item_qty,$transaction,$TRANSACTIONID);

	            $this->transaction_result = array("TIMESTAMP" => date('m/d/Y h:i:s a', time()), "ACK" => $this->Lang['SUCCESS'] ,"AMT"=> $pay_amount1,"CURRENCYCODE"=>CURRENCY_CODE);
	                $this->result_transaction = arr::to_object($this->transaction_result);
	                $this->session->set('payment_result', $this->result_transaction);
	               // url::redirect(PATH.'transaction.html');

				url::redirect(PATH."payment_product/cart_payment_paypal.html");


			}
	}



	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SEND MAIL **/

	public function do_captured_transaction($captured = "", $deal_id = "", $qty = "",$transaction = "")
	{

	        $from = CONTACT_EMAIL;
		$this->products_list = $this->cash->get_products_coupons_list($transaction,$deal_id);
		$this->product_size = $this->cash->get_shipping_product_size();
		$this->product_color = $this->cash->get_shipping_product_color();

                $this->merchant_id = $this->products_list->current()->merchant_id;
                $this->get_merchant_details = $this->cash->get_merchant_details($this->merchant_id);
                $this->merchant_firstneme = $this->get_merchant_details->current()->firstname;
                $this->merchant_lastname = $this->get_merchant_details->current()->lastname;
                $this->merchant_email = $this->get_merchant_details->current()->email;
                $message_merchant = new View("themes/".THEME_NAME."/payment_mail_product_merchant");

		if(EMAIL_TYPE==2) {
				//email::smtp($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
		}else{
		                email::sendgrid($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
		}

		$user_details = $this->cash->get_purchased_user_details();
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->cash->update_referral_amount($U->referred_user_id);
			}
			$deals_details = $this->cash->get_deals_details($deal_id);
			/*if($U->facebook_update == 1){
				foreach($deals_details as $D){
					$dealURL = PATH."product/".$D->deal_key.'/'.$D->url_title.".html";
					$message = $this->Lang['PRO_PURCASH'].$D->deal_title." ".$dealURL;
					$post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");
					common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg);
				}
			}*/

			/** Send Purchase details to user Email **/
			/*foreach($deals_details as $D){
			    $deal_title = $D->deal_title;
			    $deal_amount = $D->deal_value;
			}

			$friend_details = $this->cash->get_friend_transaction_details($deal_id, $transaction);
            $friend_email = $friend_details->current()->friend_email;
            $friend_name = $friend_details->current()->friend_name;
            if($friend_email != "xxxyyy@zzz.com"){
                $from = CONTACT_EMAIL;
                $this->transaction_mail =array("deal_title" => $deal_title, "item_qty" => $qty ,"total" => ($deal_amount * $qty) ,"amount"=> ($deal_amount * $qty),"ref_amount"=> "0","value" =>$deal_amount,"friend_name" => $friend_name,"value" =>$deal_amount);
                $this->result_mail = arr::to_object($this->transaction_mail);
                $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail");
                 if(EMAIL_TYPE==2) {
					email::smtp($from,$friend_email, "You Got Product Gift from your Friend". SITENAME ,$friend_message);
				}else{
					email::sendgrid($from,$friend_email, "You Got Product Gift from your Friend". SITENAME ,$friend_message);
				}

            } else {
                $from = CONTACT_EMAIL;
				$this->products_list = $this->cash->get_products_coupons_list($transaction,$deal_id);
				$this->product_size = $this->cash->get_shipping_product_size();
				$this->product_color = $this->cash->get_shipping_product_color();
                $message = new View("themes/".THEME_NAME."/payment_mail_product");
               if(EMAIL_TYPE==2) {
					email::smtp($from,$U->email, "Thanks for buying from ". SITENAME ,$message);

				}else{
					email::sendgrid($from,$U->email, "Thanks for buying from ". SITENAME ,$message);
				}
            } */


		}
		return;
	}

	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SEND MAIL **/

	public function do_captured_transaction1($captured = "", $deal_id = "", $qty = "",$transaction = "",$transid ="")
	{
		$user_details = $this->cash->get_purchased_user_details();
		foreach($user_details as $U){

		$deals_details = $this->cash->get_deals_details($deal_id);
		/** Send Purchase details to user Email **/
		foreach($deals_details as $D){
		    $deal_title = $D->deal_title;
		    $deal_amount = $D->deal_value;
		}

                $friend_details = $this->cash->get_friend_transaction_details($deal_id, $transaction);
                $friend_email = $friend_details->current()->friend_email;
                $friend_name = $friend_details->current()->friend_name;
            if($friend_email != "xxxyyy@zzz.com"){
                $from = CONTACT_EMAIL;
                $this->transaction_mail =array("deal_title" => $deal_title, "item_qty" => $qty ,"total" => ($deal_amount * $qty) ,"amount"=> ($deal_amount * $qty),"ref_amount"=> "0","value" =>$deal_amount,"friend_name" => $friend_name,"value" =>$deal_amount);
                $this->result_mail = arr::to_object($this->transaction_mail);
                $this->admin_list = $this->cash->get_admin_list();
		$this->admin_email = $this->admin_list->current()->email;
		$this->products_list = $this->cash->get_products_coupons_list($transaction,$deal_id);
				$this->product_size = $this->cash->get_shipping_product_size();
				$this->product_color = $this->cash->get_shipping_product_color();
                $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail");
                $message_admin = new View("themes/".THEME_NAME."/payment_mail_product_admin");
                 if(EMAIL_TYPE==2) {
			//email::smtp($from,$friend_email, $this->Lang['PRO_GIFT']. SITENAME ,$friend_message);
			//email::smtp($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
		}else{
			email::sendgrid($from,$friend_email, $this->Lang['PRO_GIFT']. SITENAME ,$friend_message);
			email::sendgrid($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
		}

            } else {
                $from = CONTACT_EMAIL;
				$this->products_list = $this->cash->get_products_coupons_list($transaction,$deal_id);
				$this->product_size = $this->cash->get_shipping_product_size();
				$this->product_color = $this->cash->get_shipping_product_color();

				$this->admin_list = $this->cash->get_admin_list();
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


}
