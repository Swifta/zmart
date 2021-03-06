<?php defined('SYSPATH') or die('No direct script access.');
class Store_credit_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();	
		$this->UserID = $this->session->get("UserID");
		$this->UserName = $this->session->get("UserName");
	}

	/** GET PRODUCT PAYMENT DETAILS  **/
	
	public function get_product_payment_details($deal_id = "")
	{
		$result = $this->db->query("select * from product  join category on category.category_id=product.category_id where deal_status = 1 and category.category_status = 1 and deal_id = $deal_id ");
	        return $result;

	}

	/** INSERT TRANSACTION DETAILS TO TRANSACTION TABLE - CASH ON DELIVERY **/

	public function insert_cash_delivery_transaction_details($deal_id = "", $referral_amount = "", $qty = "",$type ="", $captured = "",$purchase_qty = "",$paymentType = "",$product_amount = "",$merchant_id = "",$product_size = "",$product_color = "",$tax_amount = "",$shipping_amount = "",$shipping_methods = "",$post="",$TRANSACTIONID="",$bulk_discount="",$free_gift="",$store_credit_id="",$store_credit_period="",$bulk_discount="",$free_gift="",$prime_customer=0,$bulk_discount1="",$total_bulk_discount="",$product_offer="",$gift_type="",$instalment_value="",$installment_paid="",$main_storecreditid="")
	{
	
	    $merchant_commission = $this->db->select("merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();
		$commission_amount=$merchant_commission->current()->merchant_commission; 
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
		
		if($installment_paid==0) {	
			$result = $this->db->insert("storecredit_transaction",array("user_id" => $this->UserID , "product_id" => $deal_id, "firstname" => $this->UserName, "lastname" => $this->UserName, "order_date" => time(), "amount" => $product_amount, "payment_status" => 'Pending', "pending_reason" => 'None', "country_code" => COUNTRY_CODE, "currency_code" => CURRENCY_CODE,"transaction_id" => $TRANSACTIONID,"referral_amount" => $referral_amount,"transaction_type" => $paymentType, "quantity" => $qty, "type" => $type, "captured" => $captured,"transaction_date" =>time(),'deal_merchant_commission' => $commission_amount,"friend_gift_status" => $post->friend_gift,"product_size" => $product_size, "product_color"=>$product_color,"shipping_amount"=>$shipping_amount, "tax_amount"=>$tax_amount, "shipping_methods"=>$shipping_methods, "aramex_currencycode"=>$aramex_currencycode, "aramex_value"=>$aramex_value,"ip"=>$ip,"ip_country_code" => $ip_country_code, "ip_country_name" => $ip_country_name, "ip_city_name"=>$ip_city_name,"bulk_discount" =>$bulk_discount,"gift_id" =>$free_gift,"store_credit_id"=>$store_credit_id,"store_credit_period"=>$store_credit_period,"bulk_discount" =>$bulk_discount,"gift_id" =>$free_gift,"prime_customer" =>$prime_customer,"bulk_buy"=>$bulk_discount1,"total_discount"=>$total_bulk_discount,"main_storecreditid"=>$main_storecreditid,"storecredit_amount"=>$instalment_value,"storecredit_transaction_date"=>time()));

			$trans_ID = $result->insert_id();
			
			$this->db->insert("storecredit_shipping_info", array("transaction_id" => $trans_ID , "user_id" => $this->UserID, "adderss1" => $post->adderss1 , "address2" => $post->address2, "city" => $post->city ,"state" => $post->state ,"country" => $post->country,"name" => $post->shipping_name ,"postal_code" => $post->postal_code ,"phone" => $post->phone,"shipping_type" =>1,"shipping_date" => time()));

			//for($q=1; $q <= $qty; $q++){
				$coupon_code = text::random($type = 'alnum', $length = 8);
				$this->db->insert("storecredit_transaction_mapping", array("product_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code" => $coupon_code , "coupon_code_status" => 1,"transaction_date"=>time(),"friend_name" =>$post->friend_name, "friend_email" => $post->friend_email,"product_size" => $product_size, "product_color"=>$product_color));
			//}

			 $total_pay_amount = ($product_amount + $shipping_amount + $tax_amount); 
			 $commission=(($product_amount)*($commission_amount/100));
					 $merchantcommission = $total_pay_amount - $commission ; 
					 
					 $this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");

					$this->db->query("update users set merchant_account_balance = merchant_account_balance + $total_pay_amount where user_type = 1");	     
			 
			$purchase_count_total = $purchase_qty + $qty+$total_bulk_discount;
			$quantity=$qty+$total_bulk_discount;
			$result_deal = $this->db->update("product", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
			 $this->db->query("update product_size set quantity = quantity - $quantity where deal_id = $deal_id and size_id = $product_size");
			 
			if($product_offer==2 )
			{
				$this->db->query("update free_gift set purchased_quantity=purchased_quantity+1 where gift_id=$free_gift ");
			}
		} else {
			$result_ID = $this->db->select("id")->from("storecredit_transaction")->where(array("main_storecreditid"=>$main_storecreditid))->get()->current();
			$trans_ID = $result_ID->id;
			$this->db->query("update storecredit_transaction set storecredit_amount = storecredit_amount + $instalment_value,storecredit_transaction_date = ".time()." where main_storecreditid = $main_storecreditid ");
			//$this->db->update("storecredit_transaction",array("storecredit_amount"=>"storecredit_amount+$instalment_value,"storecredit_transaction_date"=>time()),array("main_storecreditid"=>$main_storecreditid));
			
		}
		$check_final_instalment = $this->db->select("duration_period,installments_paid")->from("store_credit_save")->where(array("storecredit_id"=>$main_storecreditid))->get();
		if(count($check_final_instalment)>0) {
			if($check_final_instalment->current()->duration_period == $installment_paid+1) {
				$this->db->query("update users set monthly_installment_amt = monthly_installment_amt - $instalment_value where user_id = $this->UserID");
				$this->db->query("update storecredit_transaction set payment_status = 'Completed' where  main_storecreditid = $main_storecreditid ");
			}
		}
		
		$this->db->update("store_credit_save",array("credit_status"=>4,"installments_paid"=>$installment_paid+1),array("storecredit_id"=>$main_storecreditid));
		
		return $trans_ID;
		

	}

	/** GET PURCHASED USERID **/

	public function get_purchased_user_details()
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

	/** GET DEALS DETAILS **/

	public function get_deals_details($deal_id = "")
	{
		$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id where deal_status = 1 and category.category_status = 1 and  store_status = 1 and product.deal_id = $deal_id");
	        return $result;
	}
	
	/** GET FRIEND DETAILS **/

	public function get_friend_transaction_details($deal_id = "", $transaction_id = "")
	{
	        $result = $this->db->select("storecredit_transaction_mapping.friend_name", "storecredit_transaction_mapping.friend_email")
					->from("storecredit_transaction_mapping")
					->where(array("transaction_id" => $transaction_id, "product_id" => $deal_id))
					->get();
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

		$result = $this->db->select('*','storecredit_shipping_info.adderss1 as saddr1','storecredit_shipping_info.address2 as saddr2','users.phone_number','storecredit_transaction.id as trans_id','storecredit_transaction.transaction_id as transactionid','users.address1 as addr1','users.address2 as addr2','users.phone_number as str_phone','storecredit_transaction.shipping_amount as shipping','storecredit_transaction.prime_customer')->from("storecredit_shipping_info")
                                ->where(array("shipping_type"=>1,"storecredit_shipping_info.user_id" => $this->UserID,"storecredit_transaction.id" =>$transaction,"storecredit_transaction.product_id" =>$deal_id))
                                ->join("users","users.user_id","storecredit_shipping_info.user_id")
                                ->join("storecredit_transaction","storecredit_transaction.id","storecredit_shipping_info.transaction_id")
                                ->join("product","product.deal_id","storecredit_transaction.product_id")
                                ->join("store_credit_save","store_credit_save.storecredit_id","storecredit_transaction.main_storecreditid") //storecredit products
                                ->join("city","city.city_id","storecredit_shipping_info.city")
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
	
	public function get_products_merchant_list($trans_id="",$merchant_id = "", $type="") 
	{
		$condition = "AND t.type != 5";				
		if($type){
			$condition = " AND t.type = 5 ";
		}
		$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping,stores.city_id as str_city_id from storecredit_shipping_info as s join storecredit_transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id  where shipping_type = 1 and t.transaction_id ='$trans_id' and d.merchant_id ='$merchant_id' $condition order by shipping_id DESC "); 
		
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
	
	public function check_installment($productid="",$store_credit_id="")
	{
		$result = $this->db->select("installments_paid")->from("store_credit_save")
							->where(array("productid"=>$productid,"storecredit_id"=>$store_credit_id))
							->get();
		return $result;
	}

}
