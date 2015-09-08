<?php defined('SYSPATH') or die('No direct script access.');
class Auction_Paypal_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();	
		$this->UserID = $this->session->get("UserID");
		$this->UserName = $this->session->get("UserName");
	}
	
	/** GET DEALS DETAILS  **/
	
	public function get_deals_payment_details($deal_key = "", $url_title = "")
	{
			$result = $this->db->select("*","stores.phone_number as phone")
                                        ->from("auction")
                                        ->where(array("url_title" => $url_title, "deal_key" => $deal_key,"deal_status" => 1, "category.category_status" => 1, "store_status" => 1))
                                        ->join("stores","stores.store_id","auction.shop_id")
                                        ->join("category","category.category_id","auction.category_id")
                                        ->get();
                return $result;
	}
	
	/** *GET DEALS DETAILS */

	public function get_deals_details($deal_id = "")
	{
		$result = $this->db->query("select * from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id where deal_status = 1 and category.category_status = 1 and  store_status = 1 and auction.auction_id = $deal_id");
	        return $result;
	}
	
	/** GET USER LIMIT **/
	
	public function get_user_limit_details($deal_id = "")
	{
		$result = $this->db->count_records("transaction_mapping", array( "auction_id" => $deal_id, "user_id" => $this->UserID));	            
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

	
	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - PAYPAL EXPRESS CHECK OUT **/

	public function insert_paypal_transaction_details($R = "", $payer="", $type = "",$deal_id = "", $bid_amount = "", $shipping_amount = "", $purchase_qty = 1, $captured = "",$paymentType = "",$merchant_id = "", $qty = 1,$adderss1 = "",$adderss2 = "",$state = "",$city = "",$country = "",$zip = "" ,$phone = "",$tax_amount = 0,$shipping_name = "",$bid_id = 0,$tot_amount=0)
	{
		if($R->ACK = "SUCCESSWITHWARNING"){
			$R->ACK = "Success";
		}
                $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission; 
		
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
		$result = $this->db->insert("transaction",array("user_id" => $this->UserID , "auction_id" => $deal_id, "payer_id" => $payer->PAYERID , "payer_status" =>$payer->PAYERSTATUS, "paypal_email" => $payer->EMAIL ,"country_code" => COUNTRY_CODE, "currency_code" => CURRENCY_CODE, "transaction_date" => strtotime($R->TIMESTAMP), "correlation_id" => $R->CORRELATIONID, "transaction_id" => $R->TRANSACTIONID, "transaction_type" =>  $R->TRANSACTIONTYPE, "payment_type" => $paymentType, "acknowledgement" => $R->ACK, "firstname" => $this->UserName, "lastname" => $this->UserName, "order_date" => time(), "amount" => $tot_amount,"payment_status" => "Completed", "pending_reason" => $R->PENDINGREASON, "reason_code" => $R->REASONCODE , "quantity" => $qty,"bid_amount" => $bid_amount, "shipping_amount" => $shipping_amount,"tax_amount"=>$tax_amount, "type" => $type, "captured" => $captured,'deal_merchant_commission' => $commission_amount,"ip"=>$ip,"ip_country_code" => $ip_country_code, "ip_country_name" => $ip_country_name, "ip_city_name"=>$ip_city_name));

		$trans_ID = $result->insert_id(); 

		$this->db->insert("shipping_info", array("transaction_id" => $trans_ID , "user_id" => $this->UserID, "adderss1" => $adderss1 , "address2" => $adderss2, "city" => $city ,"state" => $state ,"country" => $country,"shipping_type" => 2, "name" => $shipping_name,"postal_code" => $zip,"phone" => $phone,"shipping_date" => time()));
		     
		for($q=1; $q <= $qty; $q++){
			$coupon_code = text::random($type = 'alnum', $length = 8);
			$this->db->insert("transaction_mapping", array("auction_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>time(),"friend_name" =>'xxxyyy', "friend_email" => 'xxxyyy@zzz.com'));
		}
             
       	 $total_pay_amount = ($bid_amount + $shipping_amount + $tax_amount); 
		 $commission=(($bid_amount)*($commission_amount/100));
         $merchantcommission = $total_pay_amount - $commission ; 
         $this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");

		$this->db->query("update users set merchant_account_balance = merchant_account_balance + $total_pay_amount where user_type = 1");

		 $this->db->update("bidding",array("winning_status" => 2),array("bid_id" =>$bid_id,"user_id" =>$this->UserID,"auction_id" =>$deal_id));
		 
		 $this->db->update("auction",array("auction_status" => 2),array("deal_id" =>$deal_id));  // for check the auction is bought

		return $trans_ID;

	}
	
	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CREDIT CARD PAYMENT **/

	public function insert_transaction_details($R = "", $deal_id = "", $country_code = "", $firstName = "", $lastName = "", $ref_amount = 0, $qty = 1, $type = 1, $captured = 0, $purchase_qty = "" ,$post = "",$merchant_id = "",$tax_amount = "",$shipping_amount = "", $deal_amount = "",$bid_id = 0)
	{
	
	    $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission;  
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
		$result = $this->db->insert("transaction",array("user_id" => $this->UserID , "auction_id" => $deal_id, "country_code" => $country_code, "currency_code" => CURRENCY_CODE, "transaction_date" => strtotime($R->TIMESTAMP), "correlation_id" => $R->CORRELATIONID, "acknowledgement" => $R->ACK, "firstname" => $this->UserName, "lastname" => $this->UserName, "transaction_id" => $R->TRANSACTIONID, "order_date" => time(), "amount" => $deal_amount ,"bid_amount" => $deal_amount , "referral_amount" => $ref_amount, "payment_status" => "Completed", "quantity" => $qty, "type" => $type, "captured" => $captured,'deal_merchant_commission' => $commission_amount,"shipping_amount"=>$shipping_amount, "tax_amount"=>$tax_amount,"ip"=>$ip,"ip_country_code" => $ip_country_code, "ip_country_name" => $ip_country_name, "ip_city_name"=>$ip_city_name));
		$trans_ID = $result->insert_id();

		for($q=1; $q <= $qty; $q++){
			$coupon_code = text::random($type = 'alnum', $length = 8);
			$this->db->insert("transaction_mapping", array("auction_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>time(),"friend_name" =>'xxxyyy', "friend_email" => 'xxxyyy@zzz.com'));
		}
		
		$this->db->insert("shipping_info", array("transaction_id" => $trans_ID , "user_id" => $this->UserID, "shipping_type" => 2,"adderss1" => $post->shipping_adderss1 , "address2" => $post->shipping_address2, "city" => $post->shipping_city ,"state" => $post->shipping_state ,"country" => $post->shipping_country,"name" => $post->shipping_name ,"postal_code" => $post->shipping_postal_code ,"phone" => $post->shipping_phone, "shipping_date" => time()));
		
		 $total_pay_amount = ($deal_amount + $shipping_amount + $tax_amount); 
		 $commission=(($deal_amount)*($commission_amount/100));
         $merchantcommission = $total_pay_amount - $commission ; 
         $this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");

	     $this->db->query("update users set merchant_account_balance = merchant_account_balance + $total_pay_amount where user_type = 1");
	
		 $this->db->update("bidding",array("winning_status" => 2),array("bid_id" =>$bid_id,"user_id" =>$this->UserID,"auction_id" =>$deal_id));
		 $this->db->update("auction",array("auction_status" => 2),array("deal_id" =>$deal_id)); // for check the auction is bought	

		return $trans_ID;
	}

	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CREDIT CARD PAYMENT **/

	public function insert_cod_transaction_details($deal_id = "", $ref_amount = 0, $qty = 1, $type = 5, $captured = 0, $purchase_qty = "" ,$post = "",$merchant_id = "",$tax_amount = "",$shipping_amount = "", $deal_amount = "",$bid_id = 0)
	{
	
	    $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission;
		
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
   
		$result = $this->db->insert("transaction",array("user_id" => $this->UserID , "auction_id" => $deal_id, "country_code" => COUNTRY_CODE, "currency_code" => CURRENCY_CODE, "transaction_date" => time(), "acknowledgement" => "Success",  "firstname" => $this->UserName, "lastname" => $this->UserName,"order_date" => time(), "amount" => $deal_amount ,"bid_amount" => $deal_amount , "referral_amount" => $ref_amount, "transaction_type" => "COD","payment_status" => 'Pending', "pending_reason" => 'Cash on delivery', "quantity" => $qty, "type" => $type, "captured" => $captured,'deal_merchant_commission' => $commission_amount,"shipping_amount"=>$shipping_amount, "tax_amount"=>$tax_amount,"ip"=>$ip,"ip_country_code" => $ip_country_code, "ip_country_name" => $ip_country_name, "ip_city_name"=>$ip_city_name));
		
		$trans_ID = $result->insert_id();

		for($q=1; $q <= $qty; $q++){
			$coupon_code = text::random($type = 'alnum', $length = 8);
			$this->db->insert("transaction_mapping", array("auction_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>time(),"friend_name" =>'xxxyyy', "friend_email" => 'xxxyyy@zzz.com'));
		}
		
		$this->db->insert("shipping_info", array("transaction_id" => $trans_ID , "user_id" => $this->UserID, "adderss1" => $post->adderss1 , "address2" => $post->address2, "city" => $post->city ,"state" => $post->state ,"country" => $post->country,"name" => $post->shipping_name ,"postal_code" => $post->postal_code ,"phone" => $post->phone,"shipping_type" =>2,"shipping_date" => time()));
		
		 /*$total_pay_amount = ($deal_amount + $shipping_amount + $tax_amount); 
		 $commission=(($deal_amount)*($commission_amount/100));
         $merchantcommission = $total_pay_amount - $commission ; 
         $this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id "); */

	     //$this->db->query("update users set merchant_account_balance = merchant_account_balance + $deal_amount where user_type = 1");
	
		 $this->db->update("bidding",array("winning_status" => 2),array("bid_id" =>$bid_id,"user_id" =>$this->UserID,"auction_id" =>$deal_id));
		 $this->db->update("auction",array("auction_status" => 2),array("deal_id" =>$deal_id)); // for check the auction is bought	

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

	/** GET AUCTION MAIL DATA   **/

	public function get_auction_mail_data($deal_id = "",$transaction_id = "")
	{

		$result = $this->db->select("shipping_info.*,deal_title,deal_price,transaction.bid_amount,transaction.quantity,transaction.shipping_amount,transaction.tax_amount,transaction.transaction_date,store_name,stores.address1 as addr1,stores.address2 as addr2,city_name,stores.zipcode,stores.phone_number as str_phone,transaction.shipping_amount as shipping,shipping_info.adderss1 as saddr1,shipping_info.address2 as saddr2,shipping_info.phone,stores.website,shipping_info.name,shipping_info.country,auction.deal_key,auction.deal_value,auction.url_title,users.fb_session_key,users.fb_user_id,users.email,users.facebook_update,auction.shipping_info,ip,ip_city_name,ip_country_name")
		->from("shipping_info")
		->join("transaction","transaction.id","shipping_info.transaction_id")
		->join("auction","auction.deal_id","transaction.auction_id")
		->join("stores","stores.store_id","auction.shop_id")
		->join("city","city.city_id","shipping_info.city")
		->join("users","users.user_id","shipping_info.user_id")
		->where(array("users.user_id" => $this->UserID,"transaction.id" =>$transaction_id,"auction.deal_id" => $deal_id))
		->get();
		return $result;
	}
	/** GET AUTHORIZATION PAYMENT LIST FROM TRANSACTION LIST  **/

	public function payment_authorization_list($deal_id = "")
	{
		$result = $this->db->from("transaction")->where(array("auction_id" => $deal_id, "captured" => 1))->get();
		return $result;
	}
	
	/** GET AUTHORIZATION PAYMENT LIST FROM TRANSACTION LIST  **/

	public function payment_authorization_mail_list($deal_id = "")
	{
	    $cont = array("transaction.auction_id" => $deal_id, "captured" => 0, "coupon_mail_sent" => 0);
		$result = $this->db->select("users.email", "transaction.id", "deal_title","deal_value", "transaction.quantity", "transaction.amount", "transaction.referral_amount", "transaction.user_id", "transaction.order_date","ip","ip_city_name","ip_country_name")
					->from("transaction")
					->join("auction", "auction.deal_id", "transaction.auction_id")
					->join("users", "users.user_id", "transaction.user_id")
					->where($cont)
					->get();
		return $result;
	}
	
	/** UPDATE THE CAPTURED TRANSACTION **/

	public function update_captured_transaction($C = "", $id = "", $deal_id = "", $user_id = "", $bid_amount)
	{
            $contition = array("captured_transaction_id" => $C->CORRELATIONID , "captured_date" => strtotime($C->TIMESTAMP) , "captured_correlation_id" => $C->CORRELATIONID, "captured_ack" => $C->ACK, "captured" => 0, "payment_status" => "Completed");
	
		$result = $this->db->update("transaction", $contition , array("id" => $id));
		$result = $this->db->update("auction", array("auction_status" =>1 ,"winner" => $user_id, "high_bid_amount" => $bid_amount), array("deal_id" => $deal_id)); 
		return;
	}

	/** GET ALL CAPTURED TRANSACTION LIST **/

	public function get_all_deal_captured_transaction($deal_id = "", $transaction_id = "", $captured = "")
	{
		if($captured  == 0){
			$cont = array("transaction.auction_id" => $deal_id, "captured" => 0, "coupon_mail_sent" => 0);
		}
		else{
			$cont = array("transaction.id" => $transaction_id);
		}
		$result = $this->db->select("users.email", "transaction.id", "deal_title","deal_value", "transaction.quantity", "transaction.amount", "transaction.referral_amount", "transaction.user_id", "transaction.order_date")
					->from("transaction")
					->join("auction", "auction.deal_id", "transaction.auction_id")
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
					->where(array("transaction_mapping.auction_id" => $deal_id, "coupon_code_status" => 1, "transaction_mapping.user_id" => $user_id, "transaction_mapping.transaction_date" => $order_date, "transaction.coupon_mail_sent" => 0))
					->get();
		        return $result;
	}
	
	/** UPDATE TRANSACTION COUPON STATUS  **/
	
	public function update_transaction_coupon_status($deal_id = "", $user_id = "")
	{
	                $result = $this->db->update("transaction", array("coupon_mail_sent" => 1), array("transaction.auction_id" => $deal_id, "transaction.user_id" => $user_id)); 
	}
	
	/** GET FRIEND DETAILS **/

	public function get_friend_transaction_details($deal_id = "", $transaction_id = "")
	{
	        $result = $this->db->select("transaction_mapping.friend_name", "transaction_mapping.friend_email")
					->from("transaction_mapping")
					->where(array("transaction_id" => $transaction_id, "auction_id" => $deal_id))
					->get();
		return $result;
	
	}
	
	public function get_auction_transaction_bid_amount_data($deal_id = "")
	{
	$query = " SELECT * FROM transaction join users on users.user_id =transaction.user_id where transaction.auction_id = $deal_id ORDER BY bid_amount DESC LIMIT 1";
	$result_high = $this->db->query($query);
	    if(count($result_high)>0){
	    $bid_amount_high= $result_high->current()->bid_amount;
	    $query_count = " SELECT * FROM transaction join users on users.user_id =transaction.user_id where transaction.auction_id = $deal_id and bid_amount = $bid_amount_high"; 
	    $result = $this->db->query($query_count);
	            return $result;	        
	    }     
	return $result_high;  
	}
	
	public function get_auction_transaction_data($deal_id = "")
	{
	
	    $result = $this->db->update("transaction", array("payment_status" => 'Refund', "coupon_mail_sent" =>2 ,"pending_reason" => "None"), array("auction_id" => $deal_id, "payment_type" => 'Authorization', "payment_status" => 'Pending' )); 
	
	}
	
	
	public function get_Auction_data($deal_id = "")
       {
               $result = $this->db->from("auction")
                                ->where(array("deal_id" => $deal_id))
                                ->join("stores","stores.store_id","auction.shop_id")
                                ->join("city","city.city_id","stores.city_id")
                                ->join("country","country.country_id","stores.country_id")
                                ->join("users","users.user_id","auction.merchant_id")
                                ->join("category","category.category_id","auction.category_id")        
                                ->get();
               return $result;
       }
	
	
	
}	
