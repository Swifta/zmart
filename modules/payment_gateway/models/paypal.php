<?php defined('SYSPATH') or die('No direct script access.');
class Paypal_Model extends Model
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
		$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where deal_status = 1 and category.category_status = 1 and  store_status = 1 and deal_key = '$deal_key'  and deals.deal_id = $deal_id and enddate >".time()."");
	        return $result;
	}
	
	/** *GET DEALS DETAILS */

	public function get_deals_details($deal_id = "")
	{
		$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where deals.deal_id = '$deal_id'");
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

	public function insert_transaction_details($R = "", $deal_id = "", $country_code = "", $firstName = "", $lastName = "", $ref_amount = 0, $qty = 1, $type = 1, $captured = 0, $purchase_qty = "" ,$friend_gift = "",$friendName = "",$friendEmail = "",$merchant_id = "",$amount)
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
		$current = time();
		$result = $this->db->insert("transaction",array("user_id" => $this->UserID , "deal_id" => $deal_id, "country_code" => $country_code, "currency_code" => CURRENCY_CODE, "transaction_date" => $current, "correlation_id" => $R->CORRELATIONID, "acknowledgement" => $R->ACK, "firstname" => $this->UserName, "lastname" => $this->UserName, "transaction_id" => $R->TRANSACTIONID, "order_date" => $current, "amount" => $amount, "referral_amount" => $ref_amount, "payment_status" => $payment_status, "quantity" => $qty, "type" => $type, "captured" => $captured,"friend_gift_status" => $friend_gift, 'deal_merchant_commission' => $commission_amount,"ip"=>$ip,"ip_country_code" => $ip_country_code, "ip_country_name" => $ip_country_name, "ip_city_name"=>$ip_city_name ));

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

		$amount=$amount+$ref_amount; // for rerfferal amount add

		 $purchase_count_total = $purchase_qty + $qty;
	         $result_deal = $this->db->update("deals", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
		 $this->db->query("update users set user_referral_balance = user_referral_balance - $ref_amount, deal_bought_count = deal_bought_count + $qty where user_id = $this->UserID");
		 $this->db->query("update users set merchant_account_balance = merchant_account_balance + $amount where user_type = 1");

		return $trans_ID;
	}

	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - PAYPAL EXPRESS CHECK OUT **/

	public function insert_paypal_transaction_details($R = "", $payer="", $type = "",$deal_id = "", $referral_amount = "", $qty = "", $purchase_qty = "", $captured = "",$paymentType = "",$friend_name = "",$friend_email = "" ,$friend_gift_status = "",$merchant_id = "",$amount)
	{
		if($R->ACK = "SUCCESSWITHWARNING"){
			$R->ACK = "Success";
		}
                
        $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission;
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
		$result = $this->db->insert("transaction",array("user_id" => $this->UserID , "deal_id" => $deal_id, "payer_id" => $payer->PAYERID , "payer_status" =>$payer->PAYERSTATUS, "paypal_email" => $payer->EMAIL ,"country_code" => COUNTRY_CODE, "currency_code" => CURRENCY_CODE, "transaction_date" => $current, "correlation_id" => $R->CORRELATIONID, "transaction_id" => $R->TRANSACTIONID, "transaction_type" =>  $R->TRANSACTIONTYPE, "payment_type" => $paymentType, "acknowledgement" => $R->ACK, "firstname" => $this->UserName, "lastname" => $this->UserName, "order_date" => $current, "amount" => $amount, "payment_status" => $R->PAYMENTSTATUS, "pending_reason" => $R->PENDINGREASON, "reason_code" => $R->REASONCODE , "referral_amount" => $referral_amount, "quantity" => $qty, "type" => $type, "captured" => $captured,"friend_gift_status" => $friend_gift_status, 'deal_merchant_commission' => $commission_amount,"ip"=>$ip,"ip_country_code" => $ip_country_code, "ip_country_name" => $ip_country_name, "ip_city_name"=>$ip_city_name));

		$trans_ID = $result->insert_id();      
		for($q=1; $q <= $qty; $q++){
			$coupon_code = text::random($type = 'alnum', $length = 8);
			$this->db->insert("transaction_mapping", array("deal_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>$current,"friend_name" =>$friend_name, "friend_email" => $friend_email));
			
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
             $amount=$amount+$referral_amount;
             
                $purchase_count_total = $purchase_qty + $qty;
                $result_deal = $this->db->update("deals", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
		$this->db->query("update users set user_referral_balance = user_referral_balance - $referral_amount, deal_bought_count = deal_bought_count + $qty where user_id = $this->UserID");
		$this->db->query("update users set merchant_account_balance = merchant_account_balance + $amount where user_type = 1");

		return $trans_ID;

	}

	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CREDIT CARD PAYMENT **/

	public function insert_deal_cod_transaction_details($deal_id = "", $post="", $ref_amount = 0, $amount = 0,$qty = 1, $type = 5, $captured = 0, $purchase_qty = "" ,$merchant_id = "",$TRANSACTIONID="")
	{
	
	    $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission; 

		$name=$this->session->get('UserName');
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
		$result = $this->db->insert("transaction",array("user_id" => $this->UserID , "deal_id" => $deal_id, "country_code" => COUNTRY_CODE, "currency_code" => CURRENCY_CODE, "transaction_date" => $current, "acknowledgement" => "Success","payment_status" => 'Pending', "pending_reason" => 'Cash on delivery',  "firstname" => $this->UserName, "lastname" => $this->UserName, "transaction_id" => $TRANSACTIONID, "order_date" => $current, "amount" => $amount, "referral_amount" => $ref_amount, "quantity" => $qty, "type" => $type, "captured" => $captured,"friend_gift_status" => $post->friend_gift, 'deal_merchant_commission' => $commission_amount,"ip"=>$ip,"ip_country_code" => $ip_country_code, "ip_country_name" => $ip_country_name, "ip_city_name"=>$ip_city_name));

		$trans_ID = $result->insert_id();

		//$this->db->insert("shipping_info", array("transaction_id" => $trans_ID , "user_id" => $this->UserID, "adderss1" => $post->adderss1 , "address2" => $post->address2, "city" => $post->city ,"state" => $post->state ,"country" => $post->country,"name" => $post->shipping_name ,"postal_code" => $post->postal_code ,"phone" => $post->phone,"shipping_type" =>3,"shipping_date" => time()));

                for($q=1; $q <= $qty; $q++){
                        $coupon_code = text::random($type = 'alnum', $length = 8);
                        $this->db->insert("transaction_mapping", array("deal_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>$current,"friend_name" =>$post->friend_name, "friend_email" => $post->friend_email ));
                       
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
		 $amount=$amount+$ref_amount; // for rerfferal amount add
		 $purchase_count_total = $purchase_qty + $qty;
		 $result_deal = $this->db->update("deals", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id));
		 
		 $this->db->query("update users set user_referral_balance = user_referral_balance - $ref_amount, deal_bought_count = deal_bought_count + $qty where user_id = $this->UserID");  // count user buyed deal
		 
		 $this->db->query("update users set merchant_account_balance = merchant_account_balance + $amount where user_type = 1"); // for admin balance

		return $trans_ID;
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

	public function payment_authorization_list($deal_id = "")
	{
		$result = $this->db->from("transaction")->where(array("deal_id" => $deal_id, "captured" => 1))->get();
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
	
	/** UPDATE THE CAPTURED TRANSACTION **/

/*	public function update_captured_transaction($C = "", $id = "")
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
   
   
   public function update_captured_transaction_success($id = "")
   {
	  
	   $contition = array( "captured_date" => time() , "captured_ack" => "Success",  "captured" => 0,"captured_date" => time(), "payment_status" => "Completed");
	  
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
		$result = $this->db->select("users.email", "transaction.id", "deal_title","deal_key", "url_title", "deal_value", "transaction.quantity", "transaction.amount", "transaction.referral_amount", "transaction.user_id", "transaction.order_date","deals.expirydate","deals.purchase_count","deals.minimum_deals_limit","transaction.order_date","users.firstname","deals.merchant_id")
					->from("transaction")
					//->join("transaction_mapping", "transaction_mapping.transaction_id", "transaction.id")
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
	
	public function update_transaction_coupon_status($deal_id = "", $user_id = "",$order_date = "")
	{
	                $result = $this->db->update("transaction", array("coupon_mail_sent" => 1), array("transaction.deal_id" => $deal_id, "transaction.user_id" => $user_id,"transaction.order_date" => $order_date)); 
	                 return 1;
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

	/** GET STORE DETAILS  **/
	public function get_payment_store_detail($deal_id = "")
	{
		$result = $this->db->select("stores.*","city.city_name")->from("stores")->join("deals","deals.shop_id","stores.store_id")->join("city","city.city_id","stores.city_id")->where(array("deal_id" =>$deal_id))->get();
		return $result;
	}
	
	 /** DEALS BUY FOR FRIEND REFERRAL PAYMENT **/
	
	public function insert_referral_tranasaction($referral_amount = "", $quantity = "", $deal_id = "", $purchase_qty = "",$friend_name = "",$friend_email = "" ,$friend_gift_status = "",$merchant_id = "",$currency_code = "",$country_code = "")
	{

        $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission;
		$result = $this->db->insert("transaction", array("user_id" => $this->UserID, "deal_id" => $deal_id, 'firstname' => $this->UserName, 'acknowledgement' => "Success", "country_code" => $country_code, "currency_code" => $currency_code,'order_date' => time(), 'amount' => 0, "referral_amount" => $referral_amount, "payment_status" => "Success", 'quantity' => $quantity, 'type' => "3","transaction_date" => time(),"friend_gift_status" => $friend_gift_status, 'deal_merchant_commission' => $commission_amount));
		
		        $trans_ID = $result->insert_id();
                $current_coupon_code = "";        
		    for($q=1; $q <= $quantity; $q++) {
			    $coupon_code = text::random($type = 'alnum', $length = 8);
			    $result_coupon = $this->db->insert("transaction_mapping", array("deal_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1, "transaction_date"=>time(),"friend_name" =>$friend_name, "friend_email" => $friend_email));
			   
		    } 
		    
			$purchase_count_total = $purchase_qty + $quantity;
			
		     $result_deal = $this->db->update("deals", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
		     
         $this->db->query("update users set user_referral_balance = user_referral_balance - $referral_amount , deal_bought_count = deal_bought_count + $quantity where user_id = $this->UserID");
         
         $this->db->query("update users set merchant_account_balance = merchant_account_balance + $referral_amount where user_type = 1");
         
		return $trans_ID;
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
	
}	
