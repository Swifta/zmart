<?php defined('SYSPATH') or die('No direct script access.');
class Soldout_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->city_id = $this->session->get("CityID");
	}
	
	/* GET SOLD  OUT DEALS LIST */
	public function get_solddeals_list($cityid="",$store_id="")
	{
		if(CITY_SETTING)
			$conditions = "stores.city_id = $cityid  and stores.store_status = 1 and category.category_status = 1 and city.city_status = 1 and (purchase_count = maximum_deals_limit or deals.enddate <".time()." ) ";
		else
			$conditions = "stores.store_status = 1 and category.category_status = 1 and city.city_status = 1 and (purchase_count = maximum_deals_limit or deals.enddate <".time()." )";
			
		if($store_id!=''){
			$conditions .= " and stores.store_id = $store_id ";
		}
		$query = "select *,stores.store_url_title from deals join category on category.category_id=deals.category_id  join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id  where $conditions ";
		$result = $this->db->query($query);
		return $result; 
	}
	
	/* GET SOLD OUT PRODUCTS LIST */
	public function get_soldproducts_list($cityid="",$store_id="")
	{
		if(CITY_SETTING){ 
			$conditions = "stores.city_id = $cityid and purchase_count = user_limit_quantity and stores.store_status = 1 and category.category_status = 1 and city.city_status = 1 ";
		}else{
			$conditions = "purchase_count = user_limit_quantity and stores.store_status = 1 and category.category_status = 1 and city.city_status = 1 ";
		}
		
		if($store_id!=''){
			$conditions .= " and stores.store_id = $store_id ";
		}
		
		$query = "select *,stores.store_url_title from product join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id where $conditions";
		$result = $this->db->query($query);
		return $result;
	}
	
	
	/* GET SOLD OUT AUCTION LIST */
	public function get_soldauction_list($cityid="",$store_id="")
	{
		$conditions = "";
		if($store_id!="")
			$conditions = " and stores.store_id = $store_id ";
		if(CITY_SETTING){ 
			$query = " SELECT *,stores.store_url_title FROM auction join users on users.user_id=auction.winner join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id join country on country.country_id=city.country_id join category on category.category_id=auction.category_id where auction.winner != 0 and auction.auction_status != 0 and stores.city_id=$cityid and category.category_status = 1 and city.city_status = 1 $conditions ";
			$result_high = $this->db->query($query); 
			return $result_high; 
		} else {
			$query = " SELECT *,stores.store_url_title FROM auction join users on users.user_id=auction.winner join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id join country on country.country_id=city.country_id join category on category.category_id=auction.category_id where auction.winner != 0 and auction.auction_status !=0 and category.category_status = 1 and city.city_status = 1 $conditions ";
			$result_high = $this->db->query($query); 
			return $result_high;
		} 
	}
	
	public function get_store_details($store_url=''){
		$result = $this->db->select("store_id,merchant_id,store_name")->from("stores")->where(array("store_url_title"=>$store_url,"store_status"=>1))->get();
		return $result;
	}
	
	public function get_theme_name($store_id=''){
		$result = $this->db->select("sector_name")->from("stores")->join("sector","sector.sector_id","stores.store_subsector_id")->where("store_id",$store_id)->get();
		if(count($result)>0)
			return strtolower($result[0]->sector_name);
		return "default";
	}
	
	public function get_merchant_personalised_details($merchantid="",$store_id="")
	{
		$result = $this->db->select("merchant_attribute.*","sector.sector_name")->from("merchant_attribute")->join("stores","stores.store_id","merchant_attribute.storeid")->join("sector","sector.sector_id","stores.store_sector_id")->where(array("merchant_attribute.merchant_id"=>$merchantid,"merchant_attribute.storeid"=>$store_id))->get();
			return $result;
		return $result;
	}
	
	public function payment_list()
	{
		$result = $this->db->select("users.firstname","bidding_time as transaction_date","bidding.bid_amount","auction_id")->from("bidding")->join("auction", "auction.deal_id", "bidding.auction_id")->join("users","users.user_id","bidding.user_id")->get(); 
		return $result;
	}
	
	public function get_about_us_footer($storeurl="")
	{
		$result = $this->db->from("stores")->where(array("stores.store_url_title"=>$storeurl))->get();
		return $result;
	}
	
	public function get_merchant_cms($merchantid="") 
	{
		$result = $this->db->select("warranty_status,warranty,terms_conditions,terms_conditions,terms_conditions_status,return_policy,return_policy_status,about_us,about_us_status,merchant_id")->from("stores")->where(array("store_type"=>1,"merchant_id"=>$merchantid))->get();
		return $result;
	}
	
	public function get_merchant_details($merchant_id=''){
		$result = $this->db->select("*")->from("users")->join("city","city.city_id","users.city_id","left")->join("country","country.country_id","users.country_id","left")->where("user_id",$merchant_id)->get();
		return $result;
	}

}
