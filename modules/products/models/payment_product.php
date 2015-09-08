<?php defined('SYSPATH') or die('No direct script access.');
class Payment_product_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance(); 
		$this->UserID = $this->session->get("UserID");
		$this->UserName = $this->session->get("UserName");
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
		$result = $this->db->select("user_referral_balance")
                                        ->from("users")
                                        ->where(array("user_id" => $this->UserID))
                                        ->get();
		if(count($result)){
			return $result->current()->user_referral_balance;
		}
		return 0;
	}

	/** GET PRODUCT PAYMENT DETAILS  **/
	
	public function get_product_payment_details($deal_id = "")
	{
		$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id where deal_type = 2  and deal_status = 1 and category.category_status = 1 and  store_status = 1 and deal_id = '$deal_id' ");
	        return $result;
	}
	/** PRODUCTS BUY FOR FRIEND REFERRAL PAYMENT **/
	
	public function products_referral_payment_deatils($post = "", $referral_amount = "", $quantity = "", $deal_id = "", $purchase_qty = "",$deal_amount = "" )
	{
		 $result = $this->db->insert("transaction", array("user_id" => $this->UserID,"deal_id" =>$deal_id,'firstname' =>$this->UserName, 'acknowledgement' => "Success", 'order_date' => time(), 'amount' => 0, "referral_amount" => $deal_amount , "payment_status" =>  "Success", 'quantity' => $quantity, 'type' => "3","transaction_date" => time()));
		 
		 $trans_ID = $result->insert_id();
		 
		 for($q=1; $q <= $quantity; $q++){
			$this->db->insert("transaction_mapping", array("deal_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code_status" => 1, "transaction_date"=>time()));
		 }
		 
		 $this->db->insert("shipping_info", array("transaction_id" => $trans_ID , "user_id" => $this->UserID, "adderss1" => $post->adderss1 , "address2" => $post->address2, "city" => $post->city ,"state" => $post->state ,"country" => $post->country, "shipping_date" => time()));
		 
                 $purchase_count_total = $purchase_qty + $quantity;
	         $result_deal = $this->db->update("deals", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
                 $this->db->query("update users set deal_bought_count = deal_bought_count + $quantity where user_id = $this->UserID");
                 
		 return $result_deal; exit;
	}
	
	/** REFERRAL AMOUNT UPDATE **/
	
	public function products_referral_amount_payment_deatils($referral_amount="")
	{
	        if($referral_amount){
		$this->db->query("update users set user_referral_balance = user_referral_balance - $referral_amount  where user_id = $this->UserID");
		} 
	}
	
	/** GET USERS FULL DETAILS **/
	
	public function get_user_details()
	{
		$result = $this->db->from("users")->where(array("user_id" => $this->UserID))->get();
		return $result;
	}
	
	public function get_user_data_list()
	{
		$result = $this->db->from("users")
				   ->join("city","city.city_id","users.ship_city")
				   ->join("country","country.country_id","users.ship_country")
				   ->where(array("user_id" => $this->UserID))
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

	public function get_cart_products($deal_id = "")
	{                   
		$result = $this->db->from("product")->where(array("deal_id" => $deal_id))->get();
		return $result;
	}
	
	public function get_city_by_country_pay($country=""){
	        $conditions = (is_numeric($country))?array("country_id" => $country, "country_status" => '1'):array("country_name" => $country, "country_status" => '1');
	        $result_country = $this->db->from("country")->where($conditions)->get();
		$country_id = $result_country->current()->country_id;
		$result = $this->db->from("city")->where(array("country_id" => $country_id, "city_status" => '1'))
                                        ->orderby("city_name")
                                        ->get();
		return $result;
	}
	
	public  function getcountrydata($countryurl)
	{
		$result = $this->db->select('country_code')->from("country")
			->where(array( "country_url" => $countryurl ))
			->limit(1)
			->get();
		return $result;
	}
	
	/** TO GET THE DETAILS OF PRODUCT JUST ADDED TO CART**/
	public function get_product_details_cart($deal_id="")
	{
		$result=$this->db->select('stores.store_url_title','product.deal_key','product.url_title')->from("product")->join("stores","stores.merchant_id","product.merchant_id")->where(array("product.deal_id" => $deal_id))->get();
		return $result;
	}
/* GET STORE CREDIT PRODUCT DETAILS */
	public function get_store_credits_product($productid="",$durationid="")
	{
		$result = $this->db->from("product")
							->join("duration","duration.duration_merchantid","product.merchant_id")
							->join("stores","stores.store_id","product.shop_id")
							->where(array("duration_id"=>$durationid,"deal_id"=>$productid,"store_status" => 1))
							->get();
		return $result;
	}
	/* INSERT STORE CREDIT PRODUCTS */
	public function insert_storecredit_products($deal_id="",$deal_value="",$product_qty="",$merchant_id="",$shipping_amount="",$shipping_methods="",$durationid="",$duration_period="",$product_size="",$product_color="",$installment_value="")
	{
		
		$this->db->query("update users set monthly_installment_amt = monthly_installment_amt + $installment_value where user_id = $this->UserID");
		$result = $this->db->insert("store_credit_save",array("productid"=>$deal_id,"product_value"=>$deal_value,"product_quantity"=>$product_qty,"sizeid"=>$product_size,"colorid"=>$product_color,"durationid"=>$durationid,"duration_period"=>$duration_period,"shipping_method"=>$shipping_methods,"shipping_amount"=>$shipping_amount,"merchantid"=>$merchant_id,"userid"=>$this->UserID,"credit_status"=>1,"document_no"=>$this->UserID));
		$storecredit_ID = $result->insert_id();
		return $storecredit_ID;
		
	}
	public function get_userflat_amount($userid)
	{
		$result = $this->db->select("flat_amount")->from("users")->where(array("user_id" => $userid))->get()->current();
		return $result;
	}
	
	public function get_products_list($duration_id="",$productid="") 
	{
		$result = $this->db->query("select *,s.shipping_amount from product  join store_credit_save as s on productid=deal_id where s.storecredit_id = $duration_id and deal_id = $productid");
		/*
		$result = $this->db->query("select *,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping,stores.city_id as str_city_id,t.store_credit_period from shipping_info as s join store_credit_save as t on t.productid=s.transaction_id join product as d on d.deal_id=t.product_id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id  where shipping_type = 1 and t.transaction_id ='$trans_id' $condition order by shipping_id DESC "); 
		*/
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
	
	public function get_merchant_details($user_id="")
	{
		$result = $this->db->select("email")->from("users")->where(array("user_id"=>$user_id))->get()->current();
		return $result;
	}

public function get_cart_products1($deal_id = "")
	{                   
		$result = $this->db->from("product")->join("stores","stores.store_id","product.shop_id")->where(array("deal_id" => $deal_id))->get();
		return $result;
	}
	/* CHECK STORE CREDITS PRODUCT ALREADY EXITS */
	public function check_storecredit_already_exits($deal_id="",$merchant_id="",$durationid="",$duration_period="",$product_size="",$product_color="",$product_qty="")
	{
		$qty_check = $this->db->select("storecredit_id,product_quantity")->from("store_credit_save")->where(array("productid"=>$deal_id,"sizeid"=>$product_size,"colorid"=>$product_color,"durationid"=>$durationid,"duration_period"=>$duration_period,"merchantid"=>$merchant_id,"userid"=>$this->UserID,"credit_status"=>1))->get();
		if((count($qty_check) >0)) {
			if($product_qty != $qty_check->current()->product_quantity) {
				$storecredit_id = $qty_check->current()->storecredit_id;
				$this->db->query("DELETE FROM store_credit_save where storecredit_id = $storecredit_id");
				return 0;
			}
		}
		return count($qty_check);
	}
	/* check user limit installment */
	public function check_user_instalment_limit($installment_value="")
	{
		$result = $this->db->query("select monthly_installment_amt from users where user_id = $this->UserID");
		if(isset($result)) {
			$balance_instalment_amt = MONTHLY_INSTALLMENT_LIMIT - $result->current()->monthly_installment_amt;
			if($balance_instalment_amt > 0) { 				//100 - 80 = 20
				$balance = $balance_instalment_amt;
			} elseif($balance_instalment_amt < 0) { 			// 80-50 = -30
				$balance = 0;
			} elseif($balance_instalment_amt ==0) {  // 100 -100 =0
				$balance =0;
			}
			$total_instalment_val = $result->current()->monthly_installment_amt + $installment_value;
			if($total_instalment_val > MONTHLY_INSTALLMENT_LIMIT) {
				return $balance; //restricts the user
			}
			return -2;
		}
		return -1;
		
		//echo MONTHLY_INSTALLMENT_LIMIT." ";
	}
}
