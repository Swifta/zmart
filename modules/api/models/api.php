<?php defined('SYSPATH') or die('No direct script access.');
class Api_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
	}
	
	/** GET DEALS PAYMENT DETAILS  **/
	
	public function get_deals_payment_details($deal_id = "", $deal_key = "")
	{
		
		$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where deal_status = 1 and category.category_status = 1 and  store_status = 1 and deal_key = '$deal_key'  and deals.deal_id = '$deal_id'");
		
	        return $result;
	}
	
	/** GET USER REFERRAL BALANCE DETAILS **/
	
	public function get_user_referral_balance_details($userid = "")
	{
		$result = $this->db->select("user_referral_balance")->from("users")
				   ->where(array("user_id" => $userid))
				   ->get();
		if(count($result)){
			return $result->current()->user_referral_balance;
		}
		return 0;
	}
	
	/** GET USER LIMIT **/
	
	public function get_user_limit_details($deal_id = "",$userid = "")
	{
		$result = $this->db->count_records("transaction_mapping", array( "deal_id" => $deal_id, "user_id" => $userid));	            
                return $result;
	}
	
	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CREDIT CARD PAYMENT **/

	public function insert_product_transaction_details($R = "", $deal_id = "", $country_code = "", $firstName = "", $lastName = "", $ref_amount = 0, $qty = 1, $type = 1, $captured = 0, $purchase_qty = "" ,$post = "",$merchant_id = "",$userid = "",$friend_gift = "",$friendName = "",$friendEmail = "",$product_size = "",$product_color = "",$tax_amount = "" ,$shipping_amount = "", $deal_amount = "",$shipping_methods="")
	{
	    $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission;
		    
		$result = $this->db->insert("transaction",array("user_id" => $userid , "product_id" => $deal_id, "country_code" => $country_code, "currency_code" => $R->CURRENCYCODE, "transaction_date" => strtotime($R->TIMESTAMP), "correlation_id" => $R->CORRELATIONID, "acknowledgement" => $R->ACK, "firstname" => $firstName, "lastname" => $lastName, "transaction_id" => $R->TRANSACTIONID, "order_date" => time(), "amount" => $deal_amount , "referral_amount" => $ref_amount, "payment_status" => "Completed", "quantity" => $qty, "type" => $type, "captured" => $captured,'deal_merchant_commission' => $commission_amount,"friend_gift_status" => $friend_gift,"product_size" => $product_size, "product_color"=>$product_color,"shipping_amount"=>$shipping_amount, "tax_amount"=>$tax_amount, "shipping_methods"=>$shipping_methods));
		$trans_ID = $result->insert_id();

		for($q=1; $q <= $qty; $q++){
			$coupon_code = text::random($type = 'alnum', $length = 8);
			$this->db->insert("transaction_mapping", array("product_id" => $deal_id , "user_id" => $userid, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>time(),"friend_name" =>$friendName, "friend_email" => $friendEmail,"product_size" => $product_size, "product_color"=>$product_color));
		}
		
		$this->db->insert("shipping_info", array("transaction_id" => $trans_ID , "user_id" => $userid, "adderss1" => $post->shipping_address1 , "address2" => $post->shipping_address2, "city" => $post->shipping_city ,"state" => $post->shipping_state ,"country" => $post->shipping_country,"name" => $post->shipping_name ,"postal_code" => $post->shipping_postal_code ,"phone" => $post->shipping_phone, "shipping_date" => time()));
		
                $total_pay_amount = ($deal_amount + $shipping_amount + $tax_amount); 
                $commission=(($deal_amount)*($commission_amount/100));
                $merchantcommission = $total_pay_amount - $commission ; 
                $this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");

                $purchase_count_total = $purchase_qty + $qty;
                $result_deal = $this->db->update("product", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
                $this->db->query("update users set merchant_account_balance = merchant_account_balance + $total_pay_amount where user_type = 1");	     
                $this->db->query("update product_size set quantity = quantity - $qty where deal_id = $deal_id and size_id = $product_size");		

		 return $trans_ID;
	}

	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CASH ON DELIVERY **/
																					
	public function insert_cash_delivery_transaction_details_product($deal_id = "",$userid = "", $referral_amount = "", $qty = "",$type ="", $captured = "",$purchase_qty = "",$paymentType = "",$product_amount = "",$merchant_id = "",$product_size = "",$product_color = "",$tax_amount = "",$shipping_amount = "",$shipping_methods = "",$post = "",$country_code = "",$currencyCode = "")
	{
		
                $TRANSACTIONID = text::random($type = 'alnum', $length = 16);
                $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
                $commission_amount=$merchant_commission->current()->merchant_commission; 
                $result = $this->db->insert("transaction",array("user_id" => $userid , "product_id" => $deal_id, "country_code" => $country_code, "currency_code" => $currencyCode,"transaction_id" => $TRANSACTIONID,"firstname" => $post->shipping_name, "lastname" => $post->shipping_name, "order_date" => time(), "amount" => $product_amount, "payment_status" => 'Pending', "pending_reason" => 'Cash on delivery', "referral_amount" => $referral_amount,"transaction_type" => $paymentType, "quantity" => $qty, "type" => $type, "captured" => $captured,"transaction_date" =>time(),'deal_merchant_commission' => $commission_amount,"friend_gift_status" => $post->friend_gift,"product_size" => $product_size, "product_color"=>$product_color,"shipping_amount"=>$shipping_amount, "tax_amount"=>$tax_amount, "shipping_methods"=>$shipping_methods));
                $trans_ID = $result->insert_id();
		$a=$this->db->insert("shipping_info", array("transaction_id" => $trans_ID , "user_id" => $userid, "adderss1" => $post->shipping_address1 , "address2" => $post->shipping_address2, "city" => $post->shipping_city ,"state" => $post->shipping_state ,"country" => $post->shipping_country,"name" => $post->shipping_name ,"postal_code" => $post->shipping_postal_code ,"phone" => $post->shipping_phone,"shipping_type" =>1,"shipping_date" => time()));

                //for($q=1; $q <= $qty; $q++){
                $coupon_code = text::random($type = 'alnum', $length = 8);
                $this->db->insert("transaction_mapping", array("product_id" => $deal_id , "user_id" => $userid, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>time(),"friend_name" =>$post->friend_name, "friend_email" => $post->friend_email,"product_size" => $product_size, "product_color"=>$product_color));
                //}

                $purchase_count_total = $purchase_qty + $qty;
                $result_deal = $this->db->update("product", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
                $this->db->query("update product_size set quantity = quantity - $qty where deal_id = $deal_id and size_id = $product_size");
                return $trans_ID;
 
	}
	
	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CREDIT CARD PAYMENT **/
										
	public function insert_product_transaction_details_authorize($R = "", $pay_amount = "", $deal_id = "", $transaction_id = "", $country_code = "",$currencyCode = "", $firstName = "", $lastName = "", $ref_amount = 0, $qty = 1, $type = 4, $captured = 0, $purchase_qty = "" ,$friend_gift = "",$friendName = "",$friendEmail = "",$merchant_id = "", $post = "", $product_size  = "",$product_color = "",$tax_amount = "" ,$shipping_amount = "",$userid = "",$shipping_methods = "")
	{     
	    $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission;
		$payment_status = "Pending";
		if($captured == 0){
			$payment_status = "Completed";
		}
				
		$result = $this->db->insert("transaction",array("user_id" => $userid , "product_id" => $deal_id, "country_code" => $country_code, "currency_code" => $currencyCode, "transaction_date" => time(), "correlation_id" => $R['Authorization_Code'], "acknowledgement" => "Success", "firstname" => $firstName, "lastname" => $lastName, "transaction_id" => $transaction_id, "order_date" => time(), "amount" => $pay_amount, "referral_amount" => $ref_amount, "transaction_type" =>  $R['Credit_card'], "payment_status" => $payment_status, "quantity" => $qty, "type" => "4", "captured" => $captured,"friend_gift_status" => $friend_gift, 'deal_merchant_commission' => $commission_amount,"product_size" => $product_size, "product_color"=>$product_color,"shipping_amount"=>$shipping_amount, "tax_amount"=>$tax_amount, "shipping_methods"=>$shipping_methods));

		$trans_ID = $result->insert_id();

		for($q=1; $q <= $qty; $q++){
			$coupon_code = text::random($type = 'alnum', $length = 8);
			$this->db->insert("transaction_mapping", array("product_id" => $deal_id , "user_id" => $userid, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>time(),"friend_name" =>$friendName, "friend_email" => $friendEmail,"product_size" => $product_size, "product_color"=>$product_color ));			
		}

		 $purchase_count_total = $purchase_qty + $qty;		
		 $this->db->insert("shipping_info", array("transaction_id" => $trans_ID , "user_id" => $userid, "adderss1" => $post->shipping_address1 , "address2" => $post->shipping_address2, "city" => $post->shipping_city ,"state" => $post->shipping_state ,"country" => $post->shipping_country,"name" => $post->shipping_name ,"postal_code" => $post->shipping_postal_code ,"phone" => $post->shipping_phone, "shipping_date" => time()));
                  
         $total_pay_amount = ($pay_amount + $shipping_amount + $tax_amount); 
		 $commission=(($pay_amount)*($commission_amount/100));
         $merchantcommission = $total_pay_amount - $commission ; 
         $this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");
         
		$purchase_count_total = $purchase_qty + $qty;
	    $result_deal = $this->db->update("product", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
		$this->db->query("update users set merchant_account_balance = merchant_account_balance + '$total_pay_amount' where user_type = 1");
		$this->db->query("update product_size set quantity = quantity - '$qty' where deal_id = '$deal_id' and size_id = '$product_size'");
                
		return $trans_ID;
	}
	
	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CREDIT CARD PAYMENT **/

	public function insert_transaction_details($R = "", $deal_id = "", $country_code = "", $firstName = "", $lastName = "", $ref_amount = 0, $qty = 1, $type = 1, $captured = 0, $purchase_qty = "" ,$friend_gift = "",$friendName = "",$friendEmail = "",$merchant_id = "",$userid = "", $amount1 = "")
	{
	      
	    $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission; 

		$payment_status = "Pending";
		if($captured == 0){
			$payment_status = "Completed";
		}
		 
		$result = $this->db->insert("transaction",array("user_id" => $userid , "deal_id" => $deal_id, "country_code" => $country_code, "currency_code" => $R->CURRENCYCODE, "transaction_date" => strtotime($R->TIMESTAMP), "correlation_id" => $R->CORRELATIONID, "acknowledgement" => $R->ACK, "firstname" => $firstName, "lastname" => $lastName, "transaction_id" => $R->TRANSACTIONID, "order_date" => time(), "amount" => $amount1, "referral_amount" => $ref_amount, "payment_status" => $payment_status, "quantity" => $qty, "type" => $type, "captured" => $captured,"friend_gift_status" => $friend_gift, 'deal_merchant_commission' => $commission_amount));
                     
		$trans_ID = $result->insert_id();
                    
		for($q=1; $q <= $qty; $q++){
			$coupon_code = text::random($type = 'alnum', $length = 8);
			$this->db->insert("transaction_mapping", array("deal_id" => $deal_id , "user_id" => $userid, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>time(),"friend_name" =>$friendName, "friend_email" => $friendEmail ));
			
		}
                             
		 $purchase_count_total = $purchase_qty + $qty;
		 
		  $result_deal = $this->db->update("deals", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
		 $this->db->query("update users set user_referral_balance = user_referral_balance - '$ref_amount', deal_bought_count = deal_bought_count + '$qty' where user_id = '$userid'");    
		 $this->db->query("update users set merchant_account_balance = merchant_account_balance + $amount1 where user_type = 1");

		 
	        
                 
		return $trans_ID;
	}
	
	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CREDIT CARD PAYMENT USING AUTHORIZE.NET **/ 
	
	public function authorize_insert_transaction_details($R = "", $pay_amount = "" , $deal_id = "", $transaction_id = "", $country_code = "",$currencyCode = "", $firstName = "", $lastName = "", $ref_amount = 0, $qty = 1, $type = 4, $captured = 0, $purchase_qty = "" ,$friend_gift = "",$friendName = "",$friendEmail = "",$merchant_id = "",$userid = "")
	{       
	    $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission; 

		$payment_status = "Pending";
		if($captured == 0){
			$payment_status = "Completed";
		}
				
		$result = $this->db->insert("transaction",array("user_id" => $userid, "deal_id" => $deal_id, "country_code" => $country_code, "currency_code" => $currencyCode, "transaction_date" => time(), "correlation_id" => $R['Authorization_Code'], "acknowledgement" => "Success", "firstname" => $firstName, "lastname" => $lastName, "transaction_id" => $transaction_id, "order_date" => time(), "amount" => $pay_amount, "referral_amount" => $ref_amount, "transaction_type" =>  $R['Credit_card'], "payment_status" => $payment_status, "quantity" => $qty, "type" => "4", "captured" => $captured,"friend_gift_status" => $friend_gift, 'deal_merchant_commission' => $commission_amount));

		$trans_ID = $result->insert_id();

		for($q=1; $q <= $qty; $q++){
			$coupon_code = text::random($type = 'alnum', $length = 8);
			$this->db->insert("transaction_mapping", array("deal_id" => $deal_id , "user_id" => $userid, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>time(),"friend_name" =>$friendName, "friend_email" => $friendEmail ));			
		}

		 $purchase_count_total = $purchase_qty + $qty;   
	     $result_deal = $this->db->update("deals", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
		 $this->db->query("update users set user_referral_balance = user_referral_balance - '$ref_amount', deal_bought_count = deal_bought_count + '$qty' where user_id = '$userid'");
		 $this->db->query("update users set merchant_account_balance = merchant_account_balance + $pay_amount where user_type = 1");
		  
		 return $trans_ID;
	}
	
	
	/** GET AUTHORIZATION PAYMENT LIST FROM TRANSACTION LIST  **/

	public function payment_authorization_list( $deal_id = "")
	{
		$result = $this->db->from("transaction")->where(array("deal_id" => $deal_id, "captured" => 1))->get();
		return $result;
	}
	
	/** UPDATE THE CAPTURED TRANSACTION **/

	/*public function update_captured_transaction($C = "", $id = "")
	{
		$contition = array("captured_transaction_id" => $C->TRANSACTIONID , "captured_date" => strtotime($C->TIMESTAMP) , "captured_correlation_id" => $C->CORRELATIONID, "captured_ack" => $C->ACK, "captured_payment_type" => $C->PAYMENTTYPE , "captured_payment_status" => $C->PAYMENTSTATUS, "captured_pending_reason" => $C->PENDINGREASON);	
		if($C->PAYMENTSTATUS == "Completed"){			
			$contition = array("captured_transaction_id" => $C->TRANSACTIONID , "captured_date" => strtotime($C->TIMESTAMP) , "captured_correlation_id" => $C->CORRELATIONID, "captured_ack" => $C->ACK, "captured_payment_type" => $C->PAYMENTTYPE , "captured_payment_status" => $C->PAYMENTSTATUS, "captured_pending_reason" => $C->PENDINGREASON, "captured" => 0, "payment_status" => "Completed");
		}
		$result = $this->db->update("transaction", $contition , array("id" => $id));
		return;
	} */
	
	public function update_captured_transaction($C = "", $id = "")
   {
	  
	   $contition = array( "captured_date" => strtotime($C->TIMESTAMP) , "captured_correlation_id" => $C->CORRELATIONID, "captured_ack" => $C->ACK,  "captured" => 0,"captured_date" => time(), "payment_status" => "Completed");
	   
	   $result = $this->db->update("transaction", $contition , array("id" => $id));
	   return;
   }
       
	
	/** UPDATE THE CAPTURED TRANSACTION  USING AUTHORIZE.NET **/
	
	public function authorize_update_captured_transaction($now_transaction_id = "", $now_authorization_code = "", $id = "")
	{
		 $contition = array("captured_transaction_id" => $now_transaction_id , "captured_date" => time() , "captured_correlation_id" => $now_authorization_code, "captured_ack" => "Success",  "captured_payment_status" => "Completed", "captured_pending_reason" => "None", "captured" => 0, "payment_status" => "Completed");
		
		$result = $this->db->update("transaction", $contition , array("id" => $id));
		return;
	}
	
	
	/** UPDATE THE CAPTURED TRANSACTION FAILED **/

	public function authorize_update_captured_transaction_failed($id = "")
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
		
		
		$result = $this->db->select("users.email", "transaction.id", "deal_title","deal_key", "url_title", "deal_value", "transaction.quantity", "transaction.amount", "transaction.referral_amount", "transaction.user_id", "transaction.order_date","deals.expirydate","deals.purchase_count","deals.minimum_deals_limit","transaction.order_date","users.firstname")
					->from("transaction")
					//->join("transaction_mapping", "transaction_mapping.transaction_id", "transaction.id")
					->join("deals", "deals.deal_id", "transaction.deal_id")
					->join("users", "users.user_id", "transaction.user_id")
					->where($cont)
					->get();
		return $result;
	}
	
	
	/** GET PURCHASED USERID **/

	public function get_purchased_user_details($userid = "")
	{
		$result = $this->db->from("users")->where(array("user_id" => $userid))->get();
		return $result;
	}
	
	/** GET AUTHORIZATION PAYMENT LIST FROM TRANSACTION LIST  **/

	public function payment_authorization_mail_list($deal_id = "")
	{
	    /*$cont = array("transaction.deal_id" => $deal_id, "captured" => 0, "coupon_mail_sent" => 0);
	    
		$result = $this->db->select("users.email","users.firstname", "transaction.id", "deal_title","deal_value", "transaction.quantity", "transaction.amount", "transaction.referral_amount", "transaction.user_id", "transaction.order_date")
					->from("transaction")
					->join("deals", "deals.deal_id", "transaction.deal_id")
					->join("users", "users.user_id", "transaction.user_id")
					->where($cont)
					->get(); */
		$cont = array("transaction.deal_id" => $deal_id, "captured" => 0, "coupon_mail_sent" => 0);
			$result = $this->db->select("users.email","users.firstname", "transaction.id", "deal_title", "deal_value","url_title","deal_key", "transaction.quantity", "transaction.amount", "transaction.referral_amount", "transaction.user_id", "transaction.order_date","deals.expirydate","deals.purchase_count","deals.minimum_deals_limit")
							->from("transaction")
							//->join("transaction_mapping", "transaction_mapping.transaction_id", "transaction.id")
							->join("deals", "deals.deal_id", "transaction.deal_id")
							->join("users", "users.user_id", "transaction.user_id")
							->where($cont)
							//->groupby("transaction.id")
							->get();
		return $result;
	}
	
	/** UPDATE AMOUNT TO REFERED USER **/

	public function update_referral_amount($ref_user_id = "")
	{
		$referral_amount = REFERRAL_AMOUNT;
		
		$this->db->query("update users set user_referral_balance = user_referral_balance+$referral_amount where user_id = $ref_user_id");
		return;
	}
	
	/** *GET DEALS DETAILS */

	public function get_deals_details($deal_id = "")
	{
		$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where deal_status = 1 and category.category_status = 1 and  store_status = 1 and deals.deal_id = '$deal_id'");
	        return $result;
	}
	/** *GET DEALS DETAILS */

	public function get_product_details_share($deal_id = "")
	{
		$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where  deal_status = 1 and category.category_status = 1 and  store_status = 1 and deals.deal_id = '$deal_id'");
	        return $result;
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

	public function get_friend_transaction_details_product($deal_id = "", $transaction_id = "")
	{
	        $result = $this->db->select("transaction_mapping.friend_name", "transaction_mapping.friend_email")
					->from("transaction_mapping")
					->where(array("transaction_id" => $transaction_id, "product_id" => $deal_id))
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
	                return 1;
	}
	
	/** UPDATE TRANSACTION COUPON STATUS  **/
	
	public function update_transaction_coupon_status1($deal_id = "", $user_id = "",$order_date ="")
	{
	                $result = $this->db->update("transaction", array("coupon_mail_sent" => 1), array("transaction.deal_id" => $deal_id, "transaction.user_id" => $user_id,"transaction.order_date" => $order_date)); 
	                 return 1;
	}
	
	/** USER LOGIN **/

	public function login($email = "",$password = "")
	{
		$result = $this->db->from("users")->where(array("email" => $email, "password" =>  md5($password),"user_type !=" => 3))->get();
		
		if(count($result) == 1){ 
			if($result->current()->user_status == 1){
			        return $result->current()->user_id;
			}
			else if($result->current()->user_status == 0){
			        return -2;
			}
		} 
		return -1;
	}

	/** USER REGISTRATION **/

	public function registration($post = array())
	{
		$result = $this->db->count_records('users', array('email' => $post->email));
		if($result == 0){
			$citycount = $this->db->count_records('city', array('city_id' => $post->city_id));
			if($citycount == 0){
				return -2;
			}
			$referral_id = text::random($type = 'alnum', $length = 8);
			$result_country = $this->db->select("country_id")->from("city")->where(array("city_id" => $post->city_id ))->limit(1)->get();
			$country_value = $result_country->current()->country_id;
			$status = $this->db->insert("users",array("firstname" => $post->firstname, "email" => $post->email, "password" => md5($post->password), "city_id" => $post->city_id,"country_id" => $country_value,"referral_id" => $referral_id,"joined_date" => time(),"last_login" => time()));
			return $status->insert_id();

		}
		return -1;
	}
	
	/** EDIT PROFILE **/

	public function edit_profile($post = array())
	{
		$result = $this->db->count_records('users', array('user_id' => $post->userid));
		    if($result){	
		       $status =  $this->db->update("users",array("firstname" => $post->firstname, "lastname" => $post->lastname, "address1" => $post->address1, "address2" => $post->address2, "phone_number" => $post->phone, "city_id" => $post->city_id), array('user_id' => $post->userid));
			    return 1;
		    }
		return -1;
	}
	
	
	/** FORGOT PASSWORD **/

	public function forgot_password($emailid,$lang)
	{
		$result = $this->db->count_records('users', array('email' => $emailid));
		if($result){		
		        $password = text::random($type = 'alnum', $length = 10);
		        $this->db->update("users",array("password" => md5($password) ), array('email' => $emailid));	
			    if($emailid){
                                $from = CONTACT_EMAIL;
                                if($lang == "ar"){
                                $message = "";
                                $subject = "إعادة تعيين كلمة المرور الخاصة بك بنجاح.";
                                $message .= "<p> تم إعادة تعيين كلمة المرور الخاصة بك  </p><p>البريد الإلكتروني : ".$emailid."<p/><p>كلمة السر : ".$password."<p/><br /> <p>شكرا,</p>";    
                                } else {
                                $message = "";
                                $subject = "Your Password reset Successfully.";
                                $message .= "<p>Your Password was reseted </p><p>Email : ".$emailid."<p/><p>Password : ".$password."<p/><br /> <p>Thanks,</p>"; 
                                }
                                if(EMAIL_TYPE==2) {
                                email::smtp($from, $emailid, $subject ,$message); 
                                }else {
                                email::sendgrid($from, $emailid, $subject ,$message); 
                                }
			   }
			return 1;
		}
		return -1;
	}

	/** CHANGE PASSWORD **/

	public function changepassword($post = array())
	{
		$citycount = $this->db->update('users', array("password" => md5($post->new_password) ), array('user_id' => $post->user_id, "password" => md5($post->old_password)));
		if(count($citycount) == 1){
			return 1;
		}
		return -1;
	}

	
	/** USER PROFILE DATA ( PARAMETER USER ID ) **/

	public function get_user_profile_data($user_id = "")
	{
		$result = $this->db->select("firstname", "lastname", "email", "address1", "address2", "users.city_id as cityid","city_name", "users.country_id", "phone_number")->from("users")->join('city', 'city.city_id','users.city_id')->where(array("user_id" => $user_id ))->get();
		return $result;
	}
	
	
	/** USER SHIPPING DATA ( PARAMETER USER ID ) **/

	public function get_user_shipping_data($user_id = "")
	{
		$result = $this->db->select("ship_name", "ship_address1", "ship_address2", "ship_state", "ship_country", "ship_city", "ship_mobileno", "ship_zipcode", "country_name", "city_name")->from("users")->join('city', 'city.city_id','users.ship_city')->join('country', 'country.country_id','users.ship_country')->where(array("user_id" => $user_id ))->get();
		return $result;
	}
	
	
	/** EDIT SHIPPING DATA **/

	public function edit_shipping($post = array())
	{
		$result = $this->db->count_records('users', array('user_id' => $post->userid));
		    if($result){	
		       $status =  $this->db->update("users",array("ship_name" => $post->ship_name, "ship_address1" => $post->ship_address1, "ship_address2" => $post->ship_address2, "ship_state" => $post->ship_state, "ship_country" => $post->ship_country, "ship_city" => $post->ship_city, "ship_mobileno" => $post->ship_mobileno, "ship_zipcode" => $post->ship_zipcode), array('user_id' => $post->userid));
			    return 1;
		    }
		return -1;
	}
	
	/** CITY LIST **/
	
	public function get_city_list()
	{
		$result = $this->db->from('city')->join('country', 'country.country_id','city.country_id')
						 ->where(array('city_status' => 1,"country_status" => 1))
						 ->orderby("city_name", "ASC")
						 ->get();
		return $result;
	}
	
	/** CITY LIST **/
	
	public function get_default_city()
	{
		$result = $this->db->select("city.city_id")->from('city')->where(array('city_status' => 1,"default" => 1))->get();
			if(count($result)){
				return $result[0]->city_id;
			}
			return 0;
	}
	
	/** COUNTRY LIST **/
	
	public function get_country_list()
	{
		$result = $this->db->from('country')
						 ->where(array("country_status" => 1))
						 ->orderby("country_name", "ASC")
						 ->get();
		return $result;
	}
	
	/** CATEGORY LIST **/
	
	public function get_category_list($type = "")
	{
		$cont = "";
		if($type == "deal"){
			$cont = " AND deal = 1";
		}else if($type == "product"){
			$cont = " AND product = 1";
		}else if($type == "auction"){
			$cont = " AND auction = 1";
		}
		
		$result = $this->db->query(" select * from category where category_status = 1 AND main_category_id = 0 $cont order by category_name ASC");
		return $result;
	}
	
	/** GET DEALS SUB CATEGORY LIST **/
	
	public function get_sub_category_list($id="")
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type" => 2,"main_category_id !=" => 0,"main_category_id"=>$id,"sub_category_id"=>$id))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	/** GET DEALS SUB CATEGORY LIST **/
	
	public function get_second_sub_category_list($id="", $sub_id="")
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type" => 3,"main_category_id !=" => 0,"main_category_id"=>$id,"sub_category_id"=>$sub_id))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	
	/** GET DEALS SUB CATEGORY LIST **/
	
	public function get_third_sub_category_list($id="",$sub_id="")
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type" => 4,"main_category_id !=" => 0,"main_category_id"=>$id,"sub_category_id"=>$sub_id))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	/** DEALS LIST **/
	
	public function get_today_deals($city_id, $search,$type = "")
	{
	        
		$conditions = " enddate >".time()."  and   purchase_count < maximum_deals_limit and deal_status = 1 and category.category_status = 1 and  store_status = 1 and city_status = 1  and  users.user_status = 1";
		
	   
			if($search){
				$conditions .= " and (deal_title like '%".mysql_escape_string($search)."%'";
				$conditions .= " or deal_title like '%".mysql_escape_string($search)."%')";
			}
			
			if(CITY_SETTING){ 
				if($city_id){
					$conditions .= " and stores.city_id = '$city_id' ";
				}
				$query = "select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id join city on city.city_id=stores.city_id where $conditions AND city.city_status = 1 order by deal_id DESC ";
			}
			else{
					$query = "select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id join city on city.city_id=stores.city_id where $conditions order by deal_id DESC ";
			}
		
			
		
		
		$result = $this->db->query($query);
		return $result;
	}
	
	/** HOT DEALS LIST **/
	
	public function get_hot_today_deals($city_id)
	{
		$conditions = " enddate >".time()."  and   purchase_count < maximum_deals_limit and deal_status = 1 and category.category_status = 1 and  store_status = 1 and deal_feature = 1 and city_status = 1  and  users.user_status = 1";
			
			if(CITY_SETTING){ 
				if($city_id){
					$conditions .= " and stores.city_id = '$city_id' ";
				}
				$query = "select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id join city on city.city_id=stores.city_id where $conditions AND city.city_status = 1 order by deal_id DESC ";
			}
			else{
					$query = "select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id  join users on users.user_id=deals.merchant_id join city on city.city_id=stores.city_id where $conditions order by deal_id DESC ";
			}
		
		$result = $this->db->query($query);
		
		return $result;
	}
	
	
	/** MOSTVIEW DEALS LIST **/
	
	public function get_mostview_today_deals($city_id)
	{
		$conditions = " enddate >".time()." and   purchase_count < maximum_deals_limit and deal_status = 1 and category.category_status = 1 and  store_status = 1  and view_count != 0 and city_status = 1  and  users.user_status = 1";
			
			if(CITY_SETTING){ 
				if($city_id){
					$conditions .= " and stores.city_id = '$city_id' ";
				}
				$query = "select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id join city on city.city_id=stores.city_id where $conditions AND city.city_status = 1 order by deals.view_count DESC ";
			}
			else{
					$query = "select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id join city on city.city_id=stores.city_id where $conditions order by deals.view_count DESC ";
			}
		
		$result = $this->db->query($query);
		
		return $result;
	}
	
	public function get_user_bought($uid = "")
	{
		$result = $this->db->query($uid);
		return count($result);
	}
	
	/** DEALS LIST **/
	
	public function get_category_deals($type = "", $category = "",$city_id = "")
	{
		
	                if($type =="1"){
	                        $cat_type = "deals.category_id = $category ";
	                        $join = "join category ON category.category_id = deals.category_id";
	                }
	                if($type =="2"){
	                        $cat_type = "deals.sub_category_id = $category ";
	                       $join = "join category ON category.category_id = deals.sub_category_id";
	                }
	                if($type =="3"){
	                        $cat_type = "deals.sec_category_id = $category ";
	                        $join = "join category ON category.category_id = deals.sec_category_id";
	                }
	                if($type =="4"){
	                        $cat_type = "deals.third_category_id = $category ";
	                        $join = "join category ON category.category_id = deals.third_category_id";
	                }
	                 if($type =="5"){
	                
	                $cat_type = "deals.third_category_id = 0 ";
	                $join = "";
	                if(CITY_SETTING){ 
			$conditions = "deal_status = 1 AND enddate >".time()."  AND store_status = 1 AND city.city_status = 1 AND $cat_type  AND  purchase_count < maximum_deals_limit  and  users.user_status = 1 and stores.city_id = $city_id ";
			} else {
			$conditions = "deal_status = 1 AND enddate >".time()."   AND store_status = 1 AND city.city_status = 1 AND $cat_type  AND  purchase_count < maximum_deals_limit  and  users.user_status = 1";
			}
			
			} else {
			
			
			 if(CITY_SETTING){ 
			$conditions = "deal_status = 1 AND enddate >".time()." AND category.category_status = 1 AND store_status = 1 AND city.city_status = 1 AND $cat_type  AND  purchase_count < maximum_deals_limit  and  users.user_status = 1 and stores.city_id = $city_id ";
			} else {
			$conditions = "deal_status = 1 AND enddate >".time()."  AND category.category_status = 1 AND store_status = 1 AND city.city_status = 1 AND $cat_type  AND  purchase_count < maximum_deals_limit  and  users.user_status = 1";
			}
			
			}
			
		        $result = $this->db->query(" select * from deals   $join join stores ON stores.store_id = deals.shop_id  join users on users.user_id=deals.merchant_id join city ON city.city_id = stores.city_id where($conditions) group by deal_id order by deal_id DESC ");
		                        
		   
		return $result;
	}
	
	/** TODAY DEAL **/
	
	public function get_today_deal_details($city_id = "")
	{ 
	        if($city_id =="none"){
	                $result = $this->db->select("city_id")->from('city')->join('country', 'country.country_id','city.country_id')
						         ->where(array('city_status' => 1,"country_status" => 1,"default" =>1))
						         ->orderby("city_name", "ASC") ->get();
		        $city_id = $result->current()->city_id;
	        }
	        
		if(CITY_SETTING){   
			$query = "select * from deals  join stores on stores.store_id=deals.shop_id join city on city.city_id = stores.city_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id where enddate > ".time()." and deal_status = 1 and category.category_status = 1 and  store_status = 1 and city.city_status = 1   and  users.user_status = 1 and  purchase_count < maximum_deals_limit  and stores.city_id = '$city_id' order by deal_id DESC ";
		} else {
		        $query = "select * from deals join stores on stores.store_id=deals.shop_id join city on city.city_id = stores.city_id join category on category.category_id=deals.category_id  join users on users.user_id=deals.merchant_id where enddate > ".time()." and deal_status = 1 and category.category_status = 1 and  store_status = 1 and  users.user_status = 1  and  purchase_count < maximum_deals_limit order by deal_id DESC";
		}
		$result = $this->db->query($query);
		
	        return $result;
		
	}
	
	/** DEAL DETAILS **/
	
	public function get_deal_details($deal_id = "", $deal_key = "", $device_number = "")
	{
	         $ip=$device_number;
				$city = "";
				$country = "";
			        $count_view = $this->db->from("view_count_location")->where(array("deal_key" => $deal_key,"ip" =>$ip))->get();
			        if(count($count_view) == 0){
			                $this->db->insert("view_count_location", array("deal_key" => $deal_key,"ip" =>$ip,"city" => $city,"country" => $country,"date" => time()));
			                $this->db->query("update deals set view_count = view_count + 1 where deal_key = '$deal_key'");
			       }
			       
		$result = $this->db->select("*", "stores.phone_number as phone","stores.address1 as addr1","stores.address2 as addr2")
						   ->from("deals")
						   ->join("stores", "stores.store_id", "deals.shop_id")
			               ->join("city", "city.city_id", "stores.city_id")
			               //->join("country", "country.country_id", "stores.country_id")
					       ->join("users", "users.user_id", "deals.merchant_id")
					       ->join("category", "category.category_id", "deals.category_id")
			               ->where(array("deal_key" => $deal_key, "deal_id" => $deal_id, "deal_status" => 1, "category.category_status" => 1, "store_status" => 1, "users.user_status" => 1))
	 	                   ->get();
		return $result;
	}
	
	/** GET COMMENTS LIST **/

	public function get_comments_data($deal_id = "",$type = "")
	{
                               
		$result = $this->db->select("discussion.*","users.user_id","users.firstname")->from("discussion")
						   ->join("users","users.user_id","discussion.user_id")
						   ->where(array("deal_id" => $deal_id,"discussion_status" => "1","delete_status" => 1,"type" =>$type))->orderby("discussion_id", "DESC")->get();
		return $result;
	}
	/** ADD COMMENTS **/

	public function add_comments($deal_id = "",$user_id = "",$comments = "",$type = "")
	{
		
		$user_check = $this->db->count_records('users',array("user_id" =>$user_id));
		if($user_check>0){
	        $result = $this->db->insert("discussion", array("user_id" =>$user_id, "deal_id" => $deal_id, "comments" => $comments,"type" =>$type,"created_date" => time()));
	        
	        $result1 = $this->db->select("discussion.*","users.user_id","users.firstname")->from("discussion")
						   ->join("users","users.user_id","discussion.user_id")
						   ->where(array("deal_id" => $deal_id,"discussion_status" => "1","delete_status" => 1,"type" =>$type,"discussion.discussion_id" =>$result->insert_id()))->get();
						   
			return $result1; 
		}
		return 0;
	}
	/** GET LIKE COUNT **/
	
	public function get_like_count($deal_id = "",$comment_id = "",$type = "")
	{
		$result = $this->db->count_records('discussion_likes',array("discussion_id" => $comment_id, "deal_id" => $deal_id,"type" =>$type));
		return $result;
	}
	
	/** GET UNLIKE COUNT **/
	
	public function get_unlike_count($deal_id = "",$comment_id = "",$type = "")
	{
		$result = $this->db->count_records('discussion_unlike',array("discussion_id" => $comment_id, "deal_id" => $deal_id,"type" =>$type));
		return $result;
	}
	
	 public function like_unlike($action_type = "",$deal_id = "",$user_id="",$comment_id = "",$type = "")
    { 
        if($action_type == 'like'){
				$check = $this->db->count_records('discussion_likes',array("discussion_id" => $comment_id, "deal_id" => $deal_id,"type" =>$type,"user_id" => $user_id));
				  if($check==0){
						$result = $this->db->insert("discussion_likes",array("discussion_id" => $comment_id, "deal_id" => $deal_id,"type" =>$type, "user_id" => $user_id));
						$result = $this->db->from('discussion_unlike')->where(array("discussion_id" => $comment_id, "deal_id" => $deal_id, "type" =>$type,"user_id" => $user_id))->get();
					if(count($result) > 0){
						$result = $this->db->delete('discussion_unlike', array("discussion_id" => $comment_id, "deal_id" => $deal_id, "type" =>$type,"user_id" => $user_id));
					}
					 return 1;
				 }
				 return 2;
			
         }
         else if($action_type == 'unlike'){
			 $check = $this->db->count_records('discussion_unlike',array("discussion_id" => $comment_id, "deal_id" => $deal_id,"type" =>$type,"user_id" => $user_id));
				  if($check==0){
						$result = $this->db->insert("discussion_unlike",array("discussion_id" => $comment_id, "deal_id" => $deal_id,"type" =>$type, "user_id" => $user_id));
						$result = $this->db->from('discussion_likes')->where(array("discussion_id" => $comment_id, "deal_id" => $deal_id, "type" =>$type,"user_id" => $user_id))->get();
						if(count($result) > 0){
							$result = $this->db->delete('discussion_likes', array("discussion_id" => $comment_id, "deal_id" => $deal_id,"type" =>$type, "user_id" => $user_id));
						}
						return 1;
					}
				return 3;
        }
		else return 0;
			
    }
	
	/** STAR RATING **/
	
	public function insert_star_rating($type = "",$id = "",$user_id = "",$rate = "")
	{
		$result= $this->db->from("rating")->where(array("type_id" => $id, "user_id" => $user_id))->get(); 

		if(count($result)==0)
		{
			$result = $this->db->insert("rating", array("type_id" => $id, "user_id" => $user_id, "rating" => $rate, "module_id" => $type));
			return 1;
		}
		elseif(count($result)>0)
		{
			$result= $this->db->update("rating", array("rating" => $rate), array("type_id" => $id, "user_id" => $user_id, "module_id" => $type));
			return 1;
		} 
		
		return 0;
		
	}
	
	/** STORE LIST **/
	
	public function get_store_list($city_id = "", $search = "")
	{
		
	    $conditions = " stores.store_status = 1 AND users.user_type = 3 AND users.user_status = 1 and city_status = 1  and  users.user_status = 1";
	    if(CITY_SETTING){
	                if ($city_id) {
			        $conditions .= " and stores.city_id = $city_id";
			}
		}
	    if($search){
			$conditions .= " and store_name like '%".mysql_escape_string($search)."%'";
		}
					
		$query = "select *,stores.address1 as addr1,stores.address2 as addr2 from stores join users ON users.user_id = stores.merchant_id join city on city.city_id=stores.city_id where $conditions order by store_id DESC ";
		$result = $this->db->query($query);
		return $result;
		
		
	}
	
	/** STORE DETAILS **/
	
	public function get_store_detail($store_id = "")
	{
	    
		$result = $this->db->from("stores")
		                   ->join("city", "city.city_id", "stores.city_id")
		                   ->join("country", "country.country_id", "stores.country_id")
		                   ->where(array("store_id" => $store_id))
		                   ->get();
		return $result;
	}
	
	/** GET SIMILAR DEALS BY STORES **/
	
	public function get_similar_deals_stores($store_id = "")
	{
		$result = $this->db->from("deals")->join("category", "category.category_id", "deals.category_id")
                                          ->join("stores", "stores.store_id", "deals.shop_id")
                                          ->join("city", "city.city_id", "stores.city_id")
										  ->where(array("stores.store_id" => $store_id, "deal_status" => 1, "enddate >" => time(),"startdate <" => time(), "category.category_status" => 1, "store_status" => 1, "city.city_status" => 1 , "city_status" => 1))
                                          ->orderby("deal_id", "DESC")
										  ->get();
		return $result;
	}
	
	
	/** GET SIMILAR DEALS BY STORES **/
	
	public function get_similar_deals_by_deals($deal_id = "", $category_id = "", $city_id = "")
	{
		$condition = "deal_id != $deal_id AND purchase_count < maximum_deals_limit AND deals.category_id = $category_id AND enddate > ".time()." AND startdate < ".time()." AND deal_status = 1 AND category.category_status = 1 and  users.user_status = 1 AND store_status = 1 and city_status = 1";
		
	 if(CITY_SETTING){
	 
		$condition = "deal_id != $deal_id AND purchase_count < maximum_deals_limit AND deals.category_id = $category_id AND stores.city_id = $city_id AND enddate > ".time()." AND startdate < ".time()." AND deal_status = 1 AND category.category_status = 1 and  users.user_status = 1 AND store_status = 1 AND city.city_status = 1 ";
		 
		}
	 $result = $this->db->query("select *,stores.phone_number as phone from deals join stores ON stores.store_id = deals.shop_id join city ON city.city_id = stores.city_id join users on users.user_id=deals.merchant_id join category ON category.category_id = deals.category_id where $condition order by deal_id DESC ");
 	                        
		
                return $result;
	}
	
	
	/** GET SIMILAR PRODUCT BY PRODUCTS **/
	
	public function get_similar_product_by_products($deal_id = "", $category_id = "", $city_id = "")
	{
		$condition = "";
		 if(CITY_SETTING){
			$condition = " and stores.city_id = $city_id and city.city_status  = 1 ";
		}
		
		$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join city on city.city_id = stores.city_id join users on users.user_id=product.merchant_id join category on category.category_id=product.category_id where purchase_count < user_limit_quantity and deal_status = 1 and  users.user_status = 1 and category.category_status = 1 and  store_status = 1 and deal_id <> '$deal_id' $condition and product.category_id =  '$category_id'   order by deal_id DESC ");
	        return $result;
	        
		    
	}
	
	/** GET SIMILAR DEALS BY PRODUCT **/
	
	public function get_similar_deals_by_product($category_id = "", $city_id = "")
	{
		/*$condition = array("deals.category_id" =>$category_id, "enddate >" => time(),"startdate <" => time(),"deal_status" => 1, "category.category_status" => 1, "store_status" => 1);
	 if(CITY_SETTING){
		 $condition = array("deals.category_id" =>$category_id, "stores.city_id" => $city_id, "enddate >" => time(),"startdate <" => time(),"deal_status" => 1, "category.category_status" => 1, "store_status" => 1,"city.city_stauts" => 1);
		}
	 $result = $this->db->select("*","stores.phone_number as phone")->from("deals")
						->where($condition)
						->join("stores","stores.store_id","deals.shop_id")
						->join("city", "city.city_id", "stores.city_id")
						->join("category","category.category_id","deals.category_id")
						 ->orderby("deal_id", "DESC")
				        ->get(); */
				        
				$condition = " purchase_count < maximum_deals_limit AND deals.category_id = $category_id AND enddate > ".time()." AND startdate < ".time()." AND deal_status = 1 AND category.category_status = 1 AND store_status = 1 and city_status = 1  and  users.user_status = 1";
	 if(CITY_SETTING){
		$condition = " purchase_count < maximum_deals_limit AND deals.category_id = $category_id AND stores.city_id = $city_id AND enddate > ".time()." AND startdate < ".time()." AND deal_status = 1 AND category.category_status = 1 AND store_status = 1 AND city.city_status = 1  and  users.user_status = 1";
		}
	 $result = $this->db->query("select *,stores.phone_number as phone from deals join stores ON stores.store_id = deals.shop_id join city ON city.city_id = stores.city_id join users on users.user_id=deals.merchant_id join category ON category.category_id = deals.category_id where $condition order by deal_id DESC ");
 	                        
		
                return $result;
	        
		    
	}
	
	/** DEAL STAR AVERAGE RATING **/
	
	public function get_average_rating($deal_id="",$type="")
	{
		$result= $this->db->from("rating")->where(array("type_id" => $deal_id))->get();
		if(count($result)>0)
		{
			$get_rate = count($result);
			$sum= $this->db->query("select sum(rating) as sum from rating where type_id=$deal_id AND module_id = $type ");
			$get_sum=$sum->current()->sum;
			$average= $get_sum/$get_rate;
			return round($average);
		}
		elseif(count($result)==0)
		{
			return 0;
		}
	}
	
	/** GET SIMILAR PRODUCT BY DEAL **/
	
	public function get_similar_product_by_deal($category_id = "", $city_id = "")
	{
				$condition = "";
		 if(CITY_SETTING){
			$condition = " and stores.city_id = $city_id and city.city_status  = 1 ";
		}
		
		$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join city on city.city_id = stores.city_id join category on category.category_id=product.category_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 $condition and product.category_id =  '$category_id'   order by deal_id DESC ");
		
		/*	$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join city on city.city_id = stores.city_id  join category on category.category_id=product.category_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and city.city_status  = 1 and stores.city_id = '$city_id' and product.category_id =  '$category_id' order by deal_id DESC ");  */
	        return $result;
	}
	
	/** GET SIMILAR PRODUCT BY PRODUCTS **/
	
	public function get_today_product($city_id = "",$search = "")
	{ 
	
		 $conditions = "";
			
		$join ="join category on category.category_id=product.category_id";
		
		if($search){
			
			 $conditions .= " and (deal_title like '%".mysql_escape_string($search)."%'";
			 $conditions .= " or deal_title like '%".mysql_escape_string($search)."%')";
		}
		if(CITY_SETTING){ 
			
			if($city_id) $conditions .= "and stores.city_id = '$city_id'";
			
		$query = "select product.*,stores.*,category.*,city.* from product  join stores on stores.store_id=product.shop_id join users on users.user_id=product.merchant_id join city on city.city_id = stores.city_id $join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and  users.user_status = 1 and category.category_status = 1 and  store_status = 1 AND city.city_status = 1 $conditions group by product.deal_id order by product.deal_id DESC "; 
			$result = $this->db->query($query);
	       
		} else {
			
			$query = "select product.*,stores.*,category.*,city.* from product  join stores on stores.store_id=product.shop_id join users on users.user_id=product.merchant_id join city on city.city_id = stores.city_id $join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and  users.user_status = 1 and category.category_status = 1 and city_status = 1 and  store_status = 1 $conditions  group by product.deal_id order by product.deal_id DESC "; 
			$result = $this->db->query($query);
		} 
		
		  return $result;	    
	}
	
	/** GET HOT PRODUCTS **/
	
	public function get_hot_today_product($city_id = "")
	{ 

		$join ="join category on category.category_id=product.category_id";

		if(CITY_SETTING){ 
			if($city_id) $conditions = "and stores.city_id = '$city_id' and deal_feature = 1";
			
		$query = "select product.*,stores.*,category.*,city.* from product  join stores on stores.store_id=product.shop_id join users on users.user_id=product.merchant_id join city on city.city_id = stores.city_id $join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and  users.user_status = 1 and category.category_status = 1 and  store_status = 1 AND city.city_status = 1 $conditions group by product.deal_id order by product.deal_id DESC "; 
			$result = $this->db->query($query);
	       
		} else {
			 $conditions = " and deal_feature = 1";
			$query = "select product.*,stores.*,category.*,city.* from product  join stores on stores.store_id=product.shop_id join users on users.user_id=product.merchant_id join city on city.city_id = stores.city_id $join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and  users.user_status = 1 and city_status = 1 and category.category_status = 1 and  store_status = 1 $conditions  group by product.deal_id order by product.deal_id DESC "; 
			$result = $this->db->query($query);
		} 
		
		  return $result;	    
	}
	
	/** GET HOT PRODUCTS **/
	
	public function get_mostview_today_product($city_id = "")
	{ 

		$join ="join category on category.category_id=product.category_id";

		if(CITY_SETTING){ 
			$conditions = "and stores.city_id = '$city_id' and view_count != 0";
			
		$query = "select product.*,stores.*,category.*,city.* from product  join stores on stores.store_id=product.shop_id join users on users.user_id=product.merchant_id join city on city.city_id = stores.city_id $join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and  users.user_status = 1 and category.category_status = 1 and  store_status = 1 AND city.city_status = 1 $conditions group by product.deal_id order by product.view_count DESC "; 
			$result = $this->db->query($query);
	       
		} else {
			 $conditions = " and view_count != 0";
			$query = "select product.*,stores.*,category.*,city.* from product  join stores on stores.store_id=product.shop_id join users on users.user_id=product.merchant_id join city on city.city_id = stores.city_id $join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and  users.user_status = 1 and category.category_status = 1 and city_status = 1 and  store_status = 1 $conditions  group by product.deal_id order by product.view_count DESC "; 
			$result = $this->db->query($query);
		} 
		
		  return $result;	    
	}
	
	public function get_category_product($type = "", $category_id = "", $city_id = "")
	{ 
	
	                if($type =="1"){
	                        $cat_type = "product.category_id = $category_id ";
	                        $join = "join category ON category.category_id = product.category_id";
	                }
	                if($type =="2"){
	                        $cat_type = "product.sub_category_id = $category_id ";
	                       $join = "join category ON category.category_id = product.sub_category_id";
	                }
	                if($type =="3"){
	                        $cat_type = "product.sec_category_id = $category_id ";
	                        $join = "join category ON category.category_id = product.sec_category_id";
	                }
	                if($type =="4"){
	                        $cat_type = "product.third_category_id = $category_id ";
	                        $join = "join category ON category.category_id = product.third_category_id";
	                }
	                $conditions = "";
	                 if($type =="5"){
	                
	                        $cat_type = "product.third_category_id = 0 ";
	                        $join = "";
	                        
	                }
	                
		        if(CITY_SETTING){ 
				if($city_id){
					$conditions = " and stores.city_id = '$city_id' ";
				}
			}
			$query = "select * from product  join stores on stores.store_id=product.shop_id $join join users on users.user_id=product.merchant_id join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and  users.user_status = 1 and  store_status = 1  $conditions AND $cat_type group by product.deal_id order by product.deal_id DESC"; 
			$result = $this->db->query($query);
		
		            return $result;
	}
	
	/** GET SIMILAR PRODUCT BY STORES **/
	
	public function get_similar_product_stores($store_id = "")
	{
		
		
		$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id join city ON city.city_id = stores.city_id where purchase_count < user_limit_quantity and deal_status = 1 and  users.user_status = 1 and category.category_status = 1 and  store_status = 1 and city_status = 1 and stores.store_id = $store_id order by deal_id DESC ");
	        return $result;
	        
	        
		/*$result = $this->db->from("deals")->join("category", "category.category_id", "deals.category_id")
                                          ->join("stores", "stores.store_id", "deals.shop_id")
                                          ->join("city", "city.city_id", "stores.city_id")
										  ->where(array("stores.store_id" => $store_id, "deal_status" => 1, "category.category_status" => 1, "store_status" => 1, "city_status" => 1, "purchase_count !=" => "deals.user_limit_quantity"))
                                          ->orderby("deal_id", "DESC")
										  ->get();
		return $result; */
	}
	
	
	/**GET DELAS COUPONS LIST**/

	public function get_deals_coupons_list($user_id = "")
	{
		$result = $this->db->from("transaction")
                    ->where(array("transaction.user_id" => $user_id,"transaction_mapping.user_id" => $user_id))
                    ->join("deals","deals.deal_id","transaction.deal_id")
                    ->join("transaction_mapping","transaction_mapping.transaction_id","transaction.id")
                    ->join("stores","stores.store_id","deals.shop_id")
                    ->orderby("transaction.transaction_date","DESC")
                    ->get();
		return $result;	
	}
	
	/** VIEW PRODUCTS **/
	
	public function get_product_details($deal_id = "", $deal_key = "", $device_number = "")
	{
	 
                                $ip=$device_number;
				$city = "";
				$country = "";
			        $count_view = $this->db->from("view_count_location")->where(array("product_key" => $deal_key,"ip" =>$ip))->get();
			        if(count($count_view) == 0){
			                $this->db->insert("view_count_location", array("product_key" => $deal_key,"ip" =>$ip,"city" => $city,"country" => $country,"date" => time()));
			                $this->db->query("update product set view_count = view_count + 1 where deal_key = '$deal_key'");
			       }
			       
			       
				$condition = array("deal_id" => $deal_id, "deal_key" => $deal_key,"deal_status" => 1, "category.category_status" => 1, "store_status" => 1);
			
	        $result = $this->db->select("*","stores.phone_number as phone","stores.address1 as addr1","stores.address2 as addr2")->from("product")
	                        ->where($condition)
			                ->join("stores","stores.store_id","product.shop_id")
	                        ->join("city","city.city_id","stores.city_id")
	                        ->join("country","country.country_id","stores.country_id")
				            ->join("users","users.user_id","product.merchant_id")
				            ->join("category","category.category_id","product.category_id")
 	                        ->get();
                return $result;
	}
	
	/** GET CITY ID FOR CITY NAME **/
	
	public function get_city_id($city_name = "")
	{
		$city_url = url::title($city_name);
		$query = "select city_id from city where city_url like '%$city_url%'";
		$result = $this->db->query($query);
		if(count($result) > 0)
		{
			return $result->current()->city_id;
		}
		return 0;
	}
	
	/** GET CITY ID FOR CITY NAME **/
	
	public function get_city_id1($city_name = "")
	{
		$city_url = url::title($city_name);
		$query = "select city_id from city where city_url like '%$city_url%'";
		$result = $this->db->query($query);
		if(count($result) > 0)
		{
			return $result->current()->city_id;
		}
		return 0;
	}
	
	/** GET PRODUCT PAYMENT DETAILS  **/
	
	public function get_product_payment_details($deal_id = "")
	{
		$result = $this->db->query("select * from product  join category on category.category_id=product.category_id where deal_status = 1 and category.category_status = 1 and deal_id = $deal_id ");
	        return $result;


	}
	
	public function getuser_email($userid = "")
	{
		$result = $this->db->select("email")->from("users")->where(array("user_id" => $userid))->get();
		if(count($result)){
			return $result->current()->email;
		}
		return "No email";
	}
	
	/* GET MODULE SETTING LIST */
	public function get_setting_module_list()
	{
		$result = $this->db->from("module_settings")->get();
		return $result;
	}
	
	/** GET PRODUCT SIZE **/
	public function get_product_one_size($deal_id = "")
	{
		$result = $this->db->query("select * from product_size  where  deal_id = '$deal_id' order by CAST(size_name as SIGNED INTEGER) ASC ");
		return $result;
	}
	
	/** GET PRODUCT COLOR **/
	public function get_product_color($deal_id = "")
	{
		$result = $this->db->from("color")
				->where(array("deal_id" => $deal_id))
		     		->get();
		return $result;
	}
	
	/** GET PRODUCT COLOR **/
	public function get_product_delivery_policy($deal_id = "")
	{
		$result = $this->db->from("product_policy")
				->where(array("product_id" => $deal_id))
		     		->get();
		return $result;
	}
	
	/** GET PRODUCT SIZE for payment gate way **/
	
	public function product_size_details($deal_id = "", $size_id = "")
	{
		$result = $this->db->from("product_size")
				->where(array("deal_id" => $deal_id,"size_id" => $size_id))
		     		->get();
		return $result;
	}
	
	/**GET PRODUCTS LIST**/

	public function get_products_coupons_list($transaction = "",$deal_id = "",$userid = "")
	{

		/*$result = $this->db->select('*','shipping_info.adderss1 as saddr1','shipping_info.address2 as saddr2','users.phone_number','transaction.id as trans_id','transaction.id as transaction_id','stores.address1 as addr1','stores.address2 as addr2','stores.phone_number as str_phone','transaction.shipping_amount as shipping')->from("shipping_info")
                    ->where(array("shipping_type"=>1,"shipping_info.user_id" => $userid,"transaction.id" =>$transaction,"transaction.product_id" =>$deal_id))
                    ->join("users","users.user_id","shipping_info.user_id") 					
                    ->join("transaction","transaction.id","shipping_info.transaction_id")  
					->join("product","product.deal_id","transaction.product_id") 
					->join("stores","stores.store_id","product.shop_id") 
					->join("city","city.city_id","shipping_info.city")             
                    ->orderby("shipping_id","DESC")

                    ->get(); 
		return $result;	 */ 
		
		$result = $this->db->select('*','shipping_info.adderss1 as saddr1','shipping_info.address2 as saddr2','users.phone_number','transaction.id as trans_id','transaction.transaction_id as transactionid','users.address1 as addr1','users.address2 as addr2','users.phone_number as str_phone','transaction.shipping_amount as shipping')->from("shipping_info")
                                ->where(array("shipping_type"=>1,"shipping_info.user_id" => $userid,"transaction.id" =>$transaction,"transaction.product_id" =>$deal_id))
                                ->join("users","users.user_id","shipping_info.user_id")
                                ->join("transaction","transaction.id","shipping_info.transaction_id")
                                ->join("product","product.deal_id","transaction.product_id")
                                ->join("city","city.city_id","shipping_info.city")
                                ->join("country","country.country_id","shipping_info.country")
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

	public function get_auction_list($city_id = "", $search = "")
	{
		$conditions = "";
		if($search){
				$conditions .= " and (deal_title like '%".mysql_escape_string($search)."%'";
				$conditions .= " or deal_title like '%".mysql_escape_string($search)."%')";
		}
		
			if(CITY_SETTING){ 
				if($city_id){
					$conditions .= " and stores.city_id = '$city_id' ";
				}
				$conditions .= " AND city.city_status = 1 ";
			}
			$query="select auction.*,stores.*,category.*,city.* from(auction) join category on category.category_id=auction.category_id join stores on stores.store_id=auction.shop_id join users on users.user_id=auction.merchant_id join city on city.city_id=stores.city_id where deal_status = 1 and  users.user_status = 1 and enddate >".time()." AND startdate <".time()." and category.category_status = 1 and city_status = 1 and stores.store_status= 1  $conditions  order by auction.deal_id DESC";
				$result = $this->db->query($query);
			return $result;
	}
	
	public function get_hot_auction_list($city_id = "")
	{

		$conditions = " and deal_feature = 1";
			if(CITY_SETTING){ 
				if($city_id){
					$conditions .= " and stores.city_id = '$city_id' ";
				}
				$conditions .= " AND city.city_status = 1 ";
			}
			$query="select auction.*,stores.*,category.*,city.* from(auction) join category on category.category_id=auction.category_id join stores on stores.store_id=auction.shop_id join users on users.user_id=auction.merchant_id join city on city.city_id=stores.city_id where deal_status = 1 and  users.user_status = 1 and enddate >".time()." AND startdate <".time()." and category.category_status = 1 and city_status = 1 and stores.store_status= 1  $conditions order by auction.deal_id DESC ";
				$result = $this->db->query($query);
			return $result;
	}
	
	public function get_mostview_auction_list($city_id = "")
	{

		$conditions = " and view_count != 1";
			if(CITY_SETTING){ 
				if($city_id){
					$conditions .= " and stores.city_id = '$city_id' ";
				}
				$conditions .= " AND city.city_status = 1 ";
			}
			$query="select auction.*,stores.*,category.*,city.* from(auction) join category on category.category_id=auction.category_id join stores on stores.store_id=auction.shop_id join users on users.user_id=auction.merchant_id join city on city.city_id=stores.city_id where deal_status = 1 and  users.user_status = 1 and enddate >".time()." AND startdate <".time()." and category.category_status = 1 and city_status = 1 and stores.store_status= 1  $conditions order by auction.deal_id DESC ";
				$result = $this->db->query($query);
			return $result;
	}
	
	/** DEALS LIST **/
	
	public function get_category_auctions($type = "", $category_id = "", $city_id = "")
	{
		
	              if($type =="1"){
	                        $cat_type = "auction.category_id = $category_id ";
	                        $join = "join category ON category.category_id = auction.category_id";
	                }
	                if($type =="2"){
	                        $cat_type = "auction.sub_category_id = $category_id ";
	                       $join = "join category ON category.category_id = auction.sub_category_id";
	                }
	                if($type =="3"){
	                        $cat_type = "auction.sec_category_id = $category_id ";
	                        $join = "join category ON category.category_id = auction.sec_category_id";
	                }
	                if($type =="4"){
	                        $cat_type = "auction.third_category_id = $category_id ";
	                        $join = "join category ON category.category_id = auction.third_category_id";
	                }
	                
	                if($type =="5"){
	                
	                        $cat_type = "auction.third_category_id = 0 ";
	                        $join = "";
	                        if(CITY_SETTING){ 
			        $conditions = "deal_status = 1 AND enddate >".time()."  and  users.user_status = 1 AND store_status = 1 AND city.city_status = 1 AND $cat_type  and stores.city_id = $city_id ";
			        } else {
			        $conditions = "deal_status = 1 AND enddate >".time()."  and  users.user_status = 1 AND store_status = 1 AND city.city_status = 1 AND $cat_type ";
			        }
	                        
	                } else {
			
	                if(CITY_SETTING){ 
			$conditions = "deal_status = 1 AND enddate >".time()."  AND category.category_status = 1 and  users.user_status = 1 AND store_status = 1 AND city.city_status = 1 AND $cat_type  and stores.city_id = $city_id ";
			} else {
			$conditions = "deal_status = 1 AND enddate >".time()." AND category.category_status = 1 and  users.user_status = 1 AND store_status = 1 AND city.city_status = 1 AND $cat_type ";
			}
			
			}
			
		        $result = $this->db->query(" select * from auction   $join  join stores ON stores.store_id = auction.shop_id join users on users.user_id=auction.merchant_id join city ON city.city_id = stores.city_id where($conditions) group by deal_id order by deal_id DESC ");

		   
		return $result;
	}
	
	/** DEAL DETAILS **/
	
	public function get_auction_details($deal_id = "", $deal_key = "", $device_number = "")
	{
                $ip=$device_number;
		$city = "";
		$country = "";
	        $count_view = $this->db->from("view_count_location")->where(array("auction_key" => $deal_key,"ip" =>$ip))->get();
	        if(count($count_view) == 0){
	                $this->db->insert("view_count_location", array("auction_key" => $deal_key,"ip" =>$ip,"city" => $city,"country" => $country,"date" => time()));
	                $this->db->query("update auction set view_count = view_count + 1 where deal_key = '$deal_key'");
	       }
			       
		$result = $this->db->select("*", "stores.phone_number as phone","stores.address1 as addr1","stores.address2 as addr2")
						   ->from("auction")
						   ->join("stores", "stores.store_id", "auction.shop_id")
			               ->join("city", "city.city_id", "stores.city_id")
			                ->join("users", "users.user_id", "auction.merchant_id")
					       ->join("category", "category.category_id", "auction.category_id")
			               ->where(array("deal_key" => $deal_key, "deal_id" => $deal_id, "deal_status" => 1, "category.category_status" => 1, "store_status" => 1))
	 	                   ->get(); 
		return $result;
	}
	
	/** GET TRANSACTION LIST  **/

	public function get_auction_transaction_data($deal_id = "")
	{
		$result = $this->db->select("users.firstname","users.lastname","bidding_time as transaction_date","users.user_id","bidding.bid_amount","auction_id","auction.deal_price","auction.shipping_fee")->from("bidding")->join("users", "users.user_id", "bidding.user_id") ->join("auction","auction.deal_id","bidding.auction_id") ->where(array("bidding.auction_id" => $deal_id))->orderby("bidding.bid_id", "DESC")->get(); 
		return $result;
	}
	
	/** PAYMENT  LIST */
	public function payment_list()
	{
		$result = $this->db->select("users.firstname","bidding_time as transaction_date","bidding.bid_amount","auction_id")->from("bidding")->join("auction", "auction.deal_id", "bidding.auction_id")->join("users","users.user_id","bidding.user_id")->get(); 

	return $result;
	   
	}
	    
	  /** GET RELATED CATEGORY AUCTION LIST  **/
	
	public function get_similar_auctions($deal_id = "", $category_id = "",$city_id = "")
	{
		$condition = array("deal_id <>" => $deal_id,"auction.category_id" =>$category_id, "enddate >" => time(),"startdate <" => time(),"deal_status" => 1, "category.category_status" => 1, "store_status" => 1 , "city_status" => 1);
	 if(CITY_SETTING){
		 $condition = array("deal_id <>" => $deal_id,"auction.category_id" =>$category_id, "stores.city_id" => $city_id, "enddate >" => time(),"startdate <" => time(),"deal_status" => 1, "category.category_status" => 1, "store_status" => 1,"city.city_status" => 1);
		}
		$result = $this->db->select("*","stores.phone_number as phone")->from("auction")
						->where($condition)
						->join("stores","stores.store_id","auction.shop_id")
						->join("city", "city.city_id", "stores.city_id")
						->join("users", "users.user_id", "auction.merchant_id")
						->join("category","category.category_id","auction.category_id")
						// ->orderby("deal_id", "DESC")
				        ->get();
                return $result;
	}
	
	/** INSERT BIDDING */
	
	public function insert_bidding($current_bid_value = "",$deal_value = "",$deal_id = "",$end_time = "",$shipping_amount = "",$userid = "")
	{
	        //echo $current_bid_value; exit;
		$result = $this->db->select("deal_price")->from("auction")->where(array("deal_id" =>$deal_id))->get();
		if($result[0]->deal_price <= $current_bid_value){
			$result1 = $this->db->from("bidding")->where(array("auction_id" => $deal_id,"bid_amount" => $current_bid_value,"shipping_amount" => $shipping_amount))->get();
			if(count($result1)==0){
			$result = $this->db->insert("bidding",array("auction_id" => $deal_id,"user_id" => $userid,"bid_amount" => $current_bid_value,"shipping_amount" => $shipping_amount,"bidding_time" => time(),"end_time" => $end_time ));
			$this->db->query("update auction set deal_price = bid_increment + deal_price,bid_count = bid_count + 1 where deal_id = $deal_id ");
			return count($result); 
			}
			return 0; 
		}
		return -1;
	}
	
	public function get_new_bid_value($deal_id = "")
	{
			$result = $this->db->select("deal_price")->from("auction")->where(array("deal_id" =>$deal_id))->get();
			return $result[0]->deal_price;
	}
	
	/**GET PRODUCT COUPONS LIST**/

	public function get_product_coupons_list($user_id = "")
	{
		$result = $this->db->from("transaction")
                                    ->where(array("transaction.user_id" => $user_id))
                                    ->join("product","product.deal_id","transaction.product_id") 
                                    ->join("stores","stores.store_id","product.shop_id")
                                    ->orderby("transaction.transaction_date","DESC")
                                    ->get();
		return $result;	
	}
	
	/**GET AUCTION COUPONS LIST**/

	public function get_auction_coupons_list($user_id = "")
	{
		$result = $this->db->from("transaction")
                                    ->where(array("transaction.user_id" => $user_id))
                                    ->join("auction","auction.deal_id","transaction.auction_id") 
                                    ->join("stores","stores.store_id","auction.shop_id")
                                    ->orderby("transaction.transaction_date","DESC")
                                    ->get();
		return $result;	
	}
	
	/** GET USER WON ACTION LIST  **/
	
	public function get_auction_winner_list($user_id)
	{
		$result = $this->db->from("bidding")->select("auction.deal_title","auction.deal_title","auction.deal_id","auction.deal_value","auction.url_title","auction.deal_key","bidding.bid_amount","bidding.shipping_amount","bidding.bidding_time")->join("auction","auction.deal_id","bidding.auction_id")->where(array("auction.deal_status" => 1,"bidding.user_id" => $user_id))->orderby("bidding_time","DESC")->get();
		
		return $result;
	}
	
	public function get_color_type($deal_id = "")
	{
		$result = $this->db->select("color")->from("product")->where(array("deal_id" => $deal_id))->get();
		return $result->current()->color;
	}
		
	public function get_payment_store_detail($deal_id = "")
	{
		$result = $this->db->select("stores.*","city.city_name")->from("stores")->join("deals","deals.shop_id","stores.store_id")->join("city","city.city_id","stores.city_id")->where(array("deal_id" =>$deal_id))->get();
		return $result;
	}
	
	/** GET THE AUCTION END TIME **/
	public function get_end_time($deal_id = "")
	{
		$result = $this->db->select("enddate")->from("auction")->where(array("deal_id" =>$deal_id))->get();
		return $result->current()->enddate;
	}
	
	public function get_filter_product($main_cat = "", $color = "", $size = "", $price = "", $discount = "", $city_id = "")
	{ 
		$conditions = "";
		$join ="join category on category.category_id=product.category_id";
		if($main_cat != "none"){  
			 $conditions .= " and category.category_id='$main_cat'";
		}
		if($size != "none"){
			$size = rtrim($size, ",");
			$conditions .= " and product_size.size_id in($size)";
		}
		if($color != "none"){
			$color = rtrim($color, ",");
			$join = $join." join color on color.deal_id=product.deal_id";
			$conditions .= " and color.color_code_id in($color)";
		}
		if($discount != "none"){
			$discount = rtrim($discount, ",");
			$discount1 = explode(',',$discount);
			$arr = array("1" => "<10", "2" => "10 and 20", "3" => "20 and 30", "4" => "30 and 50", "5" => "50 and 75", "6" => ">75");
			if(count($discount1) == 1){
				$val = $discount1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (product.deal_percentage $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($discount1); $i++){
					$val = $discount1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (product.deal_percentage between $arr[$val]";
						}else{
							$conditions .="and (product.deal_percentage $arr[$val]";
						}
					}else if($i == count($discount1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_percentage between $arr[$val])";
						}else{
							$conditions .=" or product.deal_percentage $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_percentage between $arr[$val]";
						}else{
							$conditions .=" or product.deal_percentage $arr[$val]";
						}
					}
				}
			}
		}
		if($price != "none"){
			$price = rtrim($price, ",");
			$price1 = explode(',',$price);
			$arr = array("1" => "<500", "2" => "501 and 1000", "3" => "1001 and 1500", "4" => "1501 and 2000", "5" => "2001 and 2500", "6" => ">2500");

			if(count($price1) == 1){

				$val = $price1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (product.deal_value $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($discount1); $i++){
					$val = $discount1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (product.deal_value between $arr[$val]";
						}else{
							$conditions .="and (product.deal_value $arr[$val]";
						}
					}else if($i == count($discount1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_value between $arr[$val])";
						}else{
							$conditions .=" or product.deal_value $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_value between $arr[$val]";
						}else{
							$conditions .=" or product.deal_value $arr[$val]";
						}
					}
				}
			}
		}
		// filter end

		if(CITY_SETTING){
		        $query = "select * from product  join stores on stores.store_id=product.shop_id $join  join users on users.user_id=product.merchant_id join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and  users.user_status = 1 and  users.user_status = 1 and stores.city_id = $city_id  $conditions group by product.deal_id order by product.deal_id DESC";
		} else {
			$query = "select * from product  join stores on stores.store_id=product.shop_id $join join users on users.user_id=product.merchant_id join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and users.user_status = 1 and  store_status = 1  $conditions  group by product.deal_id order by product.deal_id DESC";
		}
		$result = $this->db->query($query);
		return $result;   
	}
	
	/** GET PRODUCT COLOR **/
	public function get_color_list()
	{
		$result = $this->db->select("color.*")->from("color")->join("color_code","color_code.color_code","color.color_name","left")
				->where(array("color_status" =>0,"color_code.color_name!="=>"NULL"))
				->orderby("color.color_code_name","ASC")
				->groupby("color.color_name")
		     		->get();
		return $result;
	}
	
	public function get_size_list()
	{
	        $query = "SELECT * FROM size ORDER BY CAST(size_name as SIGNED INTEGER) ASC";
	        $result = $this->db->query($query);
		return $result;
	}
	
	public function getProductAttributes($product_id = "", $lang = "") {
		$product_attribute_group_data = array();
		$product_attribute_group_query = $this->db->select("ag.attribute_group_id", "ag.groupname","ag.groupname", "ag.sort_order")
						->from("product_attribute as pa")
						->join("attribute as a","pa.attribute_id","a.attribute_id","left")
						->join("attribute_group as ag","a.attribute_group" ,"ag.attribute_group_id","left")
						->where(array("pa.product_id"=>$product_id))
						->groupby("ag.attribute_group_id")
						->orderby("ag.sort_order", "ag.groupname","asc")
						->get()->as_array(false);
		//print_r($product_attribute_group_query); exit;
		 foreach ($product_attribute_group_query as $product_attribute_group) {
			$product_attribute_data = array();
			$product_attribute_query = $this->db->select("a.attribute_id", "a.name","a.name", "pa.text")
						->from("product_attribute as pa")
						->join("attribute as a","pa.attribute_id","a.attribute_id","left")
						->where(array("pa.product_id"=>$product_id,"a.attribute_group"=>$product_attribute_group['attribute_group_id']))
						->groupby("a.attribute_id")
						->orderby("a.sort_order", "a.name","asc")
						->get()->as_array(false);

			foreach ($product_attribute_query as $product_attribute) {
				$field = 'name';
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute['attribute_id'],
					'name'         => $product_attribute[$field],
					'text'         => $product_attribute['text']
				);
			}
			$field = 'groupname';
			$product_attribute_group_data[] = array(
				'attribute_group_id' => $product_attribute_group['attribute_group_id'],
				'name'               => $product_attribute_group[$field],
				'attribute'          => $product_attribute_data
			);
		}
		//print_r($product_attribute_group_data); exit;
		return $product_attribute_group_data;
	}
	public function get_userflat_amount($userid)
	{
		
		$result = $this->db->select("flat_amount")->from("users")->where(array("user_id" => $userid))->get()->current();
		return $result;
	}
	public function get_admin_list()
	{
		$result = $this->db->from("users")->where(array("user_type" => "1"))->get();
		return $result;
	}
	public function get_merchant_details($merchant = "")
	{
		$result = $this->db->from("users")->where(array("user_id" => $merchant))->get();
		return $result;
	}
}	
