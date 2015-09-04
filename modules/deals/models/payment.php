<?php defined('SYSPATH') or die('No direct script access.');
class Payment_Model extends Model
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
	
	public function get_deals_payment_details($deal_key = "", $url_title = "")
	{
		$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where deal_status = 1 and category.category_status = 1 and  store_status = 1 and deal_key = '$deal_key'  and deals.url_title = '$url_title' and enddate > 'time()'and purchase_count < maximum_deals_limit");
	        return $result;
	}
	
	/** GET USER LIMIT **/
	
	public function get_user_limit_details($deal_id = "")
	{
		$result = $this->db->count_records("transaction_mapping", array( "deal_id" => $deal_id, "user_id" =>$this->UserID));	            
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
	
   /** DEALS BUY FOR FRIEND REFERRAL PAYMENT **/
	
	public function insert_referral_tranasaction($referral_amount = "", $quantity = "", $deal_id = "", $purchase_qty = "",$friend_name = "",$friend_email = "" ,$friend_gift_status = "",$merchant_id = "")
	{

        $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission;
		$result = $this->db->insert("transaction", array("user_id" => $this->UserID, "deal_id" => $deal_id, 'firstname' => $this->UserName, 'acknowledgement' => "Success", 'order_date' => time(), 'amount' => 0, "referral_amount" => $referral_amount, "payment_status" => "Success", 'quantity' => $quantity, 'type' => "3","transaction_date" => time(),"friend_gift_status" => $friend_gift_status, 'deal_merchant_commission' => $commission_amount));
		
		        $trans_ID = $result->insert_id();
                $current_coupon_code = "";        
		    for($q=1; $q <= $quantity; $q++) {
			    $coupon_code = text::random($type = 'alnum', $length = 8);
			    $result_coupon = $this->db->insert("transaction_mapping", array("deal_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1, "transaction_date"=>time(),"friend_name" =>$friend_name, "friend_email" => $friend_email));
			    $current_coupon_code .=$coupon_code.",";
		    } 
		
                 $current_coupon = rtrim($current_coupon_code, ',');
                 $current_coupon_array=explode(',', $current_coupon);
                 $purchase_count_total = $purchase_qty + $quantity;
	             $result_deal = $this->db->update("deals", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
         $this->db->query("update users set user_referral_balance = user_referral_balance - $referral_amount , deal_bought_count = deal_bought_count + $quantity where user_id = $this->UserID");
		return $current_coupon_array;
	}
		
	/** GET USERS FULL DETAILS **/
	
	public function get_user_details()
	{
		$result = $this->db->from("users")->where(array("user_id" => $this->UserID))->get();
		return $result;
	}

	/** UPDATE AMOUNT TO REFERED USER **/

	public function update_referral_amount($ref_user_id = "")
	{
		$referral_amount = REFERRAL_AMOUNT;
		$this->db->query("update users set user_referral_balance = user_referral_balance+$referral_amount where user_id = $ref_user_id");
		return;
	}
	
	/** GET DEALS PAYMENT DETAILS  **/
	
	public function get_deals_payments_details($deal_id = "", $deal_key = "")
	{
		$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where deal_status = 1 and category.category_status = 1 and  store_status = 1 and deal_key = '$deal_key'  and deals.deal_id = '$deal_id' and enddate > 'time()'and purchase_count < maximum_deals_limit");
	        return $result;
	}
	
}
