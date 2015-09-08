<?php defined('SYSPATH') or die('No direct script access.');
class Authorize_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();	
		$this->UserID = $this->session->get("UserID");
		$this->UserName = $this->session->get("UserName");
	}

	/** GET DEALS PAYMENT DETAILS  **/

	public function get_deals_payment_details($deal_id = "", $deal_key = "")
	{
		$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where deal_status = 1 and category.category_status = 1 and  store_status = 1 and deal_key = '$deal_key'  and deals.deal_id = '$deal_id' and enddate > 'time()'");
	        return $result;
	}

	/** *GET DEALS DETAILS */

	public function get_deals_details($deal_id = "")
	{
		$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where  deal_status = 1 and category.category_status = 1 and  store_status = 1 and deals.deal_id = '$deal_id'");
	        return $result;
	}

	/** *GET PRODUCT DETAILS */

	public function get_product_details($deal_id = "")
	{
		$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id where  deal_status = 1 and category.category_status = 1 and  store_status = 1 and product.deal_id = '$deal_id'");
	        return $result;
	}

	/** GET USER LIMIT **/

	public function get_user_limit_details($deal_id = "")
	{
		$result = $this->db->count_records("transaction_mapping", array( "deal_id" => $deal_id, "user_id" => $this->UserID));	            
                return $result;
	}

	/** GET USER REFERRAL BALANCE DETAILS **/

	public function get_user_referral_balance_details()
	{
		$result = $this->db->select("user_referral_balance")->from("users")
				   ->where(array("user_id" => $this->UserID))
				   ->get();
		if(count($result)){
			return $result->current()->user_referral_balance;
		}
		return 0;
	}

	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CREDIT CARD PAYMENT **/

	public function insert_transaction_details($R = "", $pay_amount = "" , $deal_id = "", $transaction_id = "", $country_code = "",$currencyCode = "", $firstName = "", $lastName = "", $ref_amount = 0, $qty = 1, $type = 4, $captured = 0, $purchase_qty = "" ,$friend_gift = "",$friendName = "",$friendEmail = "",$merchant_id = "")
	{
	    $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission; 

		$payment_status = "Pending";
		if($captured == 0){
			$payment_status = "Completed";
		}
		$current = time();
		$ip=$_SERVER['REMOTE_ADDR'];
	        //$ip = "41.184.34.101"; //Nigeria
	        $ip_country_code="";
	        $ip_country_name="";
	        $ip_city_name="";		
		$url = "http://api.ipinfodb.com/v3/ip-city/?key=8042c4ccb295723ec0791f306df5f9e92632e9b1ba0beda3e1ff399f207d2767&ip=$ip";
		$data = file_get_contents($url);
		$dat = explode(";",$data);
		if($dat[3] != "-"){
		        $ip_country_code=$dat[3];
		        $ip_country_name=$dat[4];
		        $ip_city_name=$dat[5];
		} else {
                        $geodata = Kogeoip::getRecord($ip);
                        if(isset($geodata->country_code)){
                                $ip_country_code=$geodata->country_code;
                                $ip_country_name=$geodata->country_name;
                                $ip_city_name="";
                        } else {
                                $ip_country_code = "Other";
                                $ip_country_name="Other";
                                $ip_city_name="Other";
                        }
		}	
		$result = $this->db->insert("transaction",array("user_id" => $this->UserID , "deal_id" => $deal_id, "country_code" => $country_code, "currency_code" => CURRENCY_CODE, "transaction_date" => $current, "correlation_id" => $R['Authorization_Code'], "acknowledgement" => "Success", "firstname" => $this->UserName, "lastname" => $this->UserName, "transaction_id" => $transaction_id, "order_date" => $current, "amount" => $pay_amount, "referral_amount" => $ref_amount, "transaction_type" =>  $R['Credit_card'], "payment_status" => $payment_status, "quantity" => $qty, "type" => "4", "captured" => $captured,"friend_gift_status" => $friend_gift, 'deal_merchant_commission' => $commission_amount,"ip"=>$ip,"ip_country_code" => $ip_country_code, "ip_country_name" => $ip_country_name, "ip_city_name"=>$ip_city_name));

		$trans_ID = $result->insert_id();

		for($q=1; $q <= $qty; $q++){
			$coupon_code = text::random($type = 'alnum', $length = 8);
			$this->db->insert("transaction_mapping", array("deal_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>$current,"friend_name" =>$friendName, "friend_email" => $friendEmail ));
					
			                        if($q==1){
			                        include "modules/BarcodeQR.php"; 
                                                $qr = new BarcodeQR();
                                                }
                                                $qr->url($coupon_code); 									 
                                                $qr->draw(180, DOCROOT."images/user/qrcode/".$coupon_code.".png");
                                                $url1= PATH."modules/barcode_generator/barcode_generator.php?ccode=".$coupon_code;
                                                $imageDir1 = "images/user/barcode/";
                                                $imagePath1 = $imageDir1.$coupon_code.".png";
                                                $image11 = file_get_contents($url1);
                                                file_put_contents(DOCROOT.$imagePath1, $image11);
                                                	
		}

			$amount=$pay_amount+$ref_amount;
			
		 $purchase_count_total = $purchase_qty + $qty;
	     $result_deal = $this->db->update("deals", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
		 $this->db->query("update users set user_referral_balance = user_referral_balance - $ref_amount, deal_bought_count = deal_bought_count + $qty where user_id = $this->UserID");
		 $this->db->query("update users set merchant_account_balance = merchant_account_balance + $amount where user_type = 1");

		return $trans_ID;
	}

	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CREDIT CARD PAYMENT **/

	public function insert_product_transaction_details($R = "", $pay_amount = "", $deal_id = "", $transaction_id = "", $country_code = "",$currencyCode = "", $firstName = "", $lastName = "", $ref_amount = 0, $qty = 1, $type = 4, $captured = 0, $purchase_qty = "" ,$friend_gift = "",$friendName = "",$friendEmail = "",$merchant_id = "", $post = "", $product_size  = "",$product_color = "",$tax_amount = "" ,$shipping_amount = "",$shipping_methods = "",$bulk_discount="",$free_gift="",$prime_customer=0,$bulk_discount1="",$total_bulk_discount="",$product_offer="",$gift_type="")
	{
	        $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission;
		$payment_status = "Pending";
		if($captured == 0){
			$payment_status = "Completed";
		}
		$aramex_currencycode = "0";
	        $aramex_value = "0";
	        if($shipping_methods ==  "5"){
	                $aramex_currencycode = $this->session->get('aramex_currencycode' . $deal_id);
	                $aramex_value = $this->session->get('aramex_value' . $deal_id);
	        }
	        $ip=$_SERVER['REMOTE_ADDR'];
	        //$ip = "41.184.34.101"; //Nigeria
	        $ip_country_code="";
	        $ip_country_name="";
	        $ip_city_name="";		
		$url = "http://api.ipinfodb.com/v3/ip-city/?key=8042c4ccb295723ec0791f306df5f9e92632e9b1ba0beda3e1ff399f207d2767&ip=$ip";
		$data = file_get_contents($url);
		$dat = explode(";",$data);
		if($dat[3] != "-"){
		        $ip_country_code=$dat[3];
		        $ip_country_name=$dat[4];
		        $ip_city_name=$dat[5];
		} else {
                        $geodata = Kogeoip::getRecord($ip);
                        if(isset($geodata->country_code)){
                                $ip_country_code=$geodata->country_code;
                                $ip_country_name=$geodata->country_name;
                                $ip_city_name="";
                        } else {
                                $ip_country_code = "Other";
                                $ip_country_name="Other";
                                $ip_city_name="Other";
                        }
		}	
		$result = $this->db->insert("transaction",array("user_id" => $this->UserID , "product_id" => $deal_id, "country_code" => $country_code, "currency_code" => CURRENCY_CODE, "transaction_date" => time(), "correlation_id" => $R['Authorization_Code'], "acknowledgement" => "Success", "firstname" => $this->UserName, "lastname" => $this->UserName, "transaction_id" => $transaction_id, "order_date" => time(), "amount" => $pay_amount, "referral_amount" => $ref_amount, "transaction_type" =>  $R['Credit_card'], "payment_status" => "Success", "quantity" => $qty, "type" => "4", "captured" => $captured,"friend_gift_status" => $friend_gift, 'deal_merchant_commission' => $commission_amount,"product_size" => $product_size, "product_color"=>$product_color,"shipping_amount"=>$shipping_amount, "tax_amount"=>$tax_amount, "shipping_methods"=>$shipping_methods, "aramex_currencycode"=>$aramex_currencycode, "aramex_value"=>$aramex_value,"ip"=>$ip,"ip_country_code" => $ip_country_code, "ip_country_name" => $ip_country_name, "ip_city_name"=>$ip_city_name,"bulk_discount" =>$bulk_discount,"gift_id" =>$free_gift,"prime_customer" =>$prime_customer,"bulk_buy"=>$bulk_discount1,"total_discount"=>$total_bulk_discount));

		$trans_ID = $result->insert_id();
		for($q=1; $q <= $qty; $q++){
			$coupon_code = text::random($type = 'alnum', $length = 8);
			$this->db->insert("transaction_mapping", array("product_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>time(),"friend_name" =>$friendName, "friend_email" => $friendEmail,"product_size" => $product_size, "product_color"=>$product_color ));			
		}

                $purchase_count_total = $purchase_qty + $qty;		
                $this->db->insert("shipping_info", array("transaction_id" => $trans_ID , "user_id" => $this->UserID, "adderss1" => $post->shipping_adderss1 , "address2" => $post->shipping_address2, "city" => $post->shipping_city ,"state" => $post->shipping_state ,"country" => $post->shipping_country,"name" => $post->shipping_name ,"postal_code" => $post->shipping_postal_code ,"phone" => $post->shipping_phone, "shipping_date" => time()));

                $total_pay_amount = ($pay_amount + $shipping_amount + $tax_amount); 
                $commission=(($pay_amount)*($commission_amount/100));
                $merchantcommission = $total_pay_amount - $commission ; 
                $this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");
                 
                $purchase_count_total = $purchase_qty + $qty+$total_bulk_discount;
                $quantity=$qty+$total_bulk_discount;
                $result_deal = $this->db->update("product", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
                $this->db->query("update users set merchant_account_balance = merchant_account_balance + $total_pay_amount where user_type = 1");
                $this->db->query("update product_size set quantity = quantity - $quantity where deal_id = $deal_id and size_id = $product_size");
				if($product_offer==2 )
				{
				$this->db->query("update free_gift set purchased_quantity=purchased_quantity+1 where gift_id=$free_gift ");
				}

		return $trans_ID;
	}

	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CREDIT CARD PAYMENT FOR AUCTION **/

	public function insert_auction_transaction_details($R = "", $pay_amount = "", $deal_id = "", $transaction_id = "", $country_code = "",$currencyCode = "", $firstName = "", $lastName = "", $ref_amount = 0, $qty = 1, $type = 4, $captured = 0, $purchase_qty = "" ,$merchant_id = "", $post = "",$tax_amount = "" ,$shipping_amount = "",$auction_amount = 0,$bid_id = 0)
	{
	    $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission; 

		$payment_status = "Pending";
		if($captured == 0){
			$payment_status = "Completed";
		}
	        $ip=$_SERVER['REMOTE_ADDR'];
	        //$ip = "41.184.34.101"; //Nigeria
	        $ip_country_code="";
	        $ip_country_name="";
	        $ip_city_name="";		
		$url = "http://api.ipinfodb.com/v3/ip-city/?key=8042c4ccb295723ec0791f306df5f9e92632e9b1ba0beda3e1ff399f207d2767&ip=$ip";
		$data = file_get_contents($url);
		$dat = explode(";",$data);
		if($dat[3] != "-"){
		        $ip_country_code=$dat[3];
		        $ip_country_name=$dat[4];
		        $ip_city_name=$dat[5];
		} else {
                        $geodata = Kogeoip::getRecord($ip);
                        if(isset($geodata->country_code)){
                                $ip_country_code=$geodata->country_code;
                                $ip_country_name=$geodata->country_name;
                                $ip_city_name="";
                        } else {
                                $ip_country_code = "Other";
                                $ip_country_name="Other";
                                $ip_city_name="Other";
                        }
		}	
		$result = $this->db->insert("transaction",array("user_id" => $this->UserID , "auction_id" => $deal_id, "country_code" => $country_code, "currency_code" => CURRENCY_CODE, "transaction_date" => time(), "correlation_id" => $R['Authorization_Code'], "acknowledgement" => "Success", "firstname" => $this->UserName, "lastname" => $this->UserName, "transaction_id" => $transaction_id, "order_date" => time(), "amount" => $pay_amount,"bid_amount" =>$auction_amount, "referral_amount" => $ref_amount, "transaction_type" =>  $R['Credit_card'], "payment_status" => "Completed", "quantity" => $qty, "type" => 4, "captured" => $captured, 'deal_merchant_commission' => $commission_amount,"shipping_amount"=>$shipping_amount, "tax_amount"=>$tax_amount,"ip"=>$ip,"ip_country_code" => $ip_country_code, "ip_country_name" => $ip_country_name, "ip_city_name"=>$ip_city_name));

		$trans_ID = $result->insert_id();

		for($q=1; $q <= $qty; $q++){
			$coupon_code = text::random($type = 'alnum', $length = 8);
			$this->db->insert("transaction_mapping", array("auction_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>time(),"friend_name" => 'xxxyyy', "friend_email" => 'xxxyyy@zzz.com'));			
		}

	 $total_pay_amount = ($pay_amount + $shipping_amount + $tax_amount); 
	 $commission=(($pay_amount)*($commission_amount/100));
         $merchantcommission = $total_pay_amount - $commission ; 
         $this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");

		// $purchase_count_total = $purchase_qty + $qty;     

		$this->db->insert("shipping_info", array("transaction_id" => $trans_ID , "user_id" => $this->UserID, "adderss1" => $post->shipping_adderss1 , "address2" => $post->shipping_address2, "city" => $post->shipping_city ,"state" => $post->shipping_state ,"country" => $post->shipping_country,"name" => $post->shipping_name ,"postal_code" => $post->shipping_postal_code ,"phone" => $post->shipping_phone,"shipping_type" => 2, "shipping_date" => time()));

		//$purchase_count_total = $purchase_qty + $qty;
	   // $result_deal = $this->db->update("deals", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
		$this->db->query("update users set merchant_account_balance = merchant_account_balance + $total_pay_amount where user_type = 1");

		 $this->db->update("bidding",array("winning_status" => 2),array("bid_id" =>$bid_id,"user_id" =>$this->UserID,"auction_id" =>$deal_id));
		 $this->db->update("auction",array("auction_status" => 2),array("deal_id" =>$deal_id));  // for check the auction is bought
		//$this->db->query("update product_size set quantity = quantity - $qty where deal_id = $deal_id and size_id = $product_size");

		return $trans_ID;
	}

	/** GET AUCTION MAIL DATA   **/

	public function get_auction_mail_data($deal_id = "",$transaction_id = "")
	{

		$result = $this->db->select("shipping_info.*,auction.deal_title,deal_price,transaction.bid_amount,transaction.quantity,transaction.shipping_amount,transaction.tax_amount,transaction.transaction_date,store_name,stores.address1 as addr1,stores.address2 as addr2,city_name,stores.zipcode,stores.phone_number as str_phone,transaction.shipping_amount as shipping,shipping_info.adderss1 as saddr1,shipping_info.address2 as saddr2,shipping_info.phone,stores.website,shipping_info.name,shipping_info.country,auction.deal_key,auction.deal_value,auction.url_title,users.fb_session_key,users.fb_user_id,users.email,users.facebook_update,auction.shipping_info,ip,ip_city_name,ip_country_name")->from("shipping_info")->join("transaction","transaction.id","shipping_info.transaction_id")->join("auction","auction.deal_id","transaction.auction_id")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","shipping_info.city")->join("users","users.user_id","shipping_info.user_id")->where(array("users.user_id" => $this->UserID,"transaction.id" =>$transaction_id,"auction.deal_id" => $deal_id))->get();
			
		return $result;
	}

	/** UPDATE AMOUNT TO REFERED USER **/

	public function update_referral_amount($ref_user_id = "")
	{
		$referral_amount = REFERRAL_AMOUNT;
		$this->db->query("update users set user_referral_balance = user_referral_balance+$referral_amount where user_id = $ref_user_id");
		return;
	}

	/** GET PURCHASED USERID **/

	public function get_purchased_user_details()
	{
		$result = $this->db->from("users")->where(array("user_id" => $this->UserID))->get();
		return $result;
	}

	/** GET AUTHORIZATION PAYMENT LIST FROM TRANSACTION LIST  **/

	public function payment_authorization_mail_list($deal_id = "")    
	{
		$cont = array("transaction.deal_id" => $deal_id, "captured" => 0, "coupon_mail_sent" => 0);
		$result = $this->db->select("users.email","users.firstname", "transaction.id", "deal_title","deal_value","url_title","deal_key", "transaction.quantity", "transaction.amount", "transaction.referral_amount", "transaction.user_id", "transaction.order_date","deals.expirydate","deals.purchase_count","deals.minimum_deals_limit","deals.merchant_id","ip","ip_city_name","ip_country_name")
		                ->from("transaction")
		                //->join("transaction_mapping", "transaction_mapping.transaction_id", "transaction.id")
		                ->join("deals", "deals.deal_id", "transaction.deal_id")
		                ->join("users", "users.user_id", "transaction.user_id")
		                ->where($cont)
		                //->groupby("transaction.id")
		                ->get();
		return $result;
	}

	/** GET AUTHORIZATION PAYMENT LIST FROM TRANSACTION LIST  **/

	public function payment_authorization_list( $deal_id = "")
	{
		$result = $this->db->from("transaction")->where(array("deal_id" => $deal_id, "captured" => 1))->get();
		return $result;
	}

	/** UPDATE THE CAPTURED TRANSACTION **/

	public function update_captured_transaction($now_transaction_id = "", $now_authorization_code = "", $id = "")
	{
		 $contition = array("captured_transaction_id" => $now_transaction_id , "captured_date" => time() , "captured_correlation_id" => $now_authorization_code, "captured_ack" => "Success",  "captured_payment_status" => "Completed", "captured_pending_reason" => "None", "captured" => 0, "payment_status" => "Completed");
		
		$result = $this->db->update("transaction", $contition , array("id" => $id));
		return;
	}

	/** UPDATE THE CAPTURED TRANSACTION FAILED **/

	public function update_captured_transaction_failed($id = "")
	{
		 $contition = array("captured_date" => time() , "captured_ack" => "Failed",  "captured_payment_status" => "Failed", "captured_pending_reason" => "None", "captured" => 0, "payment_status" => "Failed", "acknowledgement"=>"Failed");
		
		$result = $this->db->update("transaction", $contition , array("id" => $id));
		return;
	}

	/** GET ALL CAPTURED TRANSACTION LIST **/

	public function get_all_deal_captured_transaction($deal_id = "", $transaction_id = "", $captured = "")
	{
		if($captured  == 0){
			$cont = array("transaction.deal_id" => $deal_id, "captured" => 0, "coupon_mail_sent" => 0);
		}
		else{
			$cont = array("transaction.id" => $transaction_id);
		}
		$result = $this->db->select("users.email", "transaction.id", "deal_title","deal_key", "url_title", "deal_value", "transaction.quantity", "transaction.amount", "transaction.referral_amount", "transaction.user_id", "transaction.order_date","deals.expirydate","transaction_mapping.coupon_code","transaction_mapping.coupon_code","deals.purchase_count","deals.minimum_deals_limit","transaction.order_date","users.firstname","deals.merchant_id")
					->from("transaction")
					->join("transaction_mapping", "transaction_mapping.transaction_id", "transaction.id")
					->join("deals", "deals.deal_id", "transaction.deal_id")
					->join("users", "users.user_id", "transaction.user_id")
					->where($cont)
					->get();
		return $result;
	}

	/** GET COUPON DETAILS **/

	public function get_all_deal_captured_coupon($deal_id = "", $user_id = "", $order_date = "")
	{
		     $result = $this->db->select("coupon_code")->from("transaction_mapping")
		                        ->join("transaction", "transaction.id", "transaction_mapping.transaction_id")
					->where(array("transaction_mapping.deal_id" => $deal_id, "coupon_code_status" => 1, "transaction_mapping.user_id" => $user_id, "transaction_mapping.transaction_date" => $order_date, "transaction.coupon_mail_sent" => 0))
					->get();
		        return $result;
	}

	/** UPDATE TRANSACTION COUPON STATUS  **/

	public function update_transaction_coupon_status($transaction_id = "", $user_id = "")
	{
	                $result = $this->db->update("transaction", array("coupon_mail_sent" => 1), array("transaction.id" => $transaction_id, "transaction.user_id" => $user_id)); 
	}

	/** UPDATE TRANSACTION COUPON STATUS  **/

	public function update_transaction_coupon_status1($deal_id = "", $user_id = "",$order_date ="")
	{
	                $result = $this->db->update("transaction", array("coupon_mail_sent" => 1), array("transaction.deal_id" => $deal_id, "transaction.user_id" => $user_id,"transaction.order_date" => $order_date)); 
	                 return 1;
	}

	/** GET FRIEND DETAILS **/

	public function get_friend_transaction_details($deal_id = "", $transaction_id = "")
	{
	        $result = $this->db->select("transaction_mapping.friend_name", "transaction_mapping.friend_email")
					->from("transaction_mapping")
					->where(array("transaction_id" => $transaction_id, "deal_id" => $deal_id))
					->get();
		return $result;
	
	}

	/** GET FRIEND DETAILS **/

	public function get_friend_transaction_product_details($deal_id = "", $transaction_id = "")
	{
	        $result = $this->db->select("transaction_mapping.friend_name", "transaction_mapping.friend_email")
					->from("transaction_mapping")
					->where(array("transaction_id" => $transaction_id, "product_id" => $deal_id))
					->get();
		return $result;
	
	}

	/** GET PRODUCT PAYMENT DETAILS  **/

	public function get_product_payment_details($deal_id = "")
	{
		$result = $this->db->query("select * from product  join category on category.category_id=product.category_id where  deal_status = 1 and category.category_status = 1 and deal_id = '$deal_id' ");
	        return $result;

	}

	/** GET PRODUCT SIZE **/

	public function product_size_details($deal_id = "", $size_id = "")
	{
		$result = $this->db->from("product_size")
				->where(array("deal_id" => $deal_id,"size_id" => $size_id))
		     		->get();
		return $result;
	}

	/**GET PRODUCTS LIST**/

	public function get_products_coupons_list($transaction = "",$deal_id = "")
	{

		$result = $this->db->select('*','shipping_info.adderss1 as saddr1','shipping_info.address2 as saddr2','users.phone_number','transaction.id as trans_id','transaction.transaction_id as transactionid','users.address1 as addr1','users.address2 as addr2','users.phone_number as str_phone','transaction.shipping_amount as shipping','transaction.prime_customer')->from("shipping_info")
                                ->where(array("shipping_type"=>1,"shipping_info.user_id" => $this->UserID,"transaction.id" =>$transaction,"transaction.product_id" =>$deal_id))
                                ->join("users","users.user_id","shipping_info.user_id")
                                ->join("transaction","transaction.id","shipping_info.transaction_id")
                                ->join("product","product.deal_id","transaction.product_id")
                                ->join("city","city.city_id","shipping_info.city")
                                ->orderby("shipping_id","DESC")
                                ->get();
		return $result;	
                
	}

	public function get_shipping_product_color()
	{
		$result = $this->db->from("color_code")->get();
		return $result;
	}

	public function get_shipping_product_size()
	{
		$result = $this->db->from("size")->get();
		return $result;
	}

	public function get_payment_store_detail($deal_id = "")
	{
		$result = $this->db->select("stores.*","city.city_name")->from("stores")->join("deals","deals.shop_id","stores.store_id")->join("city","city.city_id","stores.city_id")->where(array("deal_id" =>$deal_id))->get();
		return $result;
	}
	
	public function get_products_merchant_list($trans_id="",$merchant_id = "", $type="") 
	{
		$condition = "AND t.type != 5";				
		if($type){
			$condition = " AND t.type = 5 ";
		}
		$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping,stores.city_id as str_city_id from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id  where shipping_type = 1 and t.transaction_id ='$trans_id' and d.merchant_id ='$merchant_id' $condition order by shipping_id DESC "); 
		
		return $result;
	}
	
	public function get_merchant_details($merchant = "")
	{
		$result = $this->db->from("users")->where(array("user_id" => $merchant))->get();
		return $result;
	}
	
	public function get_admin_list()
	{
		$result = $this->db->from("users")->where(array("user_type" => "1"))->get();
		return $result;
	}
	
        public function update_captured_transaction_success($id = "")
        {
	          
	           $contition = array( "captured_date" => time() , "captured_ack" => "Success",  "captured" => 0,"captured_date" => time(), "payment_status" => "Completed");
	           $result = $this->db->update("transaction", $contition , array("id" => $id));
	           return;
        }
   
        public function update_captured_transaction_paypal($C = "", $id = "")
        {
	           $contition = array( "captured_date" => strtotime($C->TIMESTAMP) , "captured_correlation_id" => $C->CORRELATIONID, "captured_ack" => $C->ACK,  "captured" => 0,"captured_date" => time(), "payment_status" => "Completed");
	           $result = $this->db->update("transaction", $contition , array("id" => $id));
	           return;
        }
        
        public function get_userflat_amount($userid)
	{
		$result = $this->db->select("flat_amount")->from("users")->where(array("user_id" => $userid))->get()->current();
		return $result;
	}
	
	public function get_free_gift($gift_amount="",$merchant_id="",$deal_id="")
	{
	$result=$this->db->query("select gift_offer from product join free_gift on free_gift.merchant_id=product.merchant_id where gift_Amount<= $gift_amount and free_gift.merchant_id=$merchant_id and gift_status=1 and product.deal_id=$deal_id order by gift_Amount DESC limit 1");
		/*$result=$this->db->select("gift_id")->from("free_gift")->where(array("gift_Amount <=" => $gift_amount))->orderby("gift_Amount","DESC")->limit(1,0)->get();*/
		
		return $result;
		
	}
	
	/**  TO GET THE PRODUCT GIFT TYPE **/
	public function get_product_gift_type($merchant_id="",$deal_id="",$gift_offer="")
	{
		$result=$this->db->select("gift_type")
		->join("product","product.merchant_id","free_gift.merchant_id")
		->from("free_gift")
		->where(array("free_gift.merchant_id" =>$merchant_id,"product.deal_id" => $deal_id,"free_gift.gift_id" => $gift_offer ))
		->get();
		return $result;
	} 
	public function get_free_gft_not_per_amount($merchant_id="",$deal_id="",$product_offer="")
	{
		$result=$this->db->select("gift_offer")/*->join("free_gift","free_gift.merchant_id","product.merchant_id")*/->from("product")->where(array("product.merchant_id" => $merchant_id,"product.deal_id" => $deal_id,"product.product_offer" => $product_offer/*,"free_gift.gift_status"=>1*/))->get();
		return $result;
	}
}	
