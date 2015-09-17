<?php defined('SYSPATH') or die('No direct script access.');
class Admin_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->user_id = $this->session->get("user_id");
	}

	/** ADMIN HOME DASHBOARD DATA COUNT **/

	public function get_admin_dashboard_data()
	{

	        $result_active_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->join("category","category.category_id","deals.category_id")->where(array("enddate >" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["active_deals"]=count($result_active_deals);

		$result_archive_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->join("category","category.category_id","deals.category_id")->where(array("enddate <" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["archive_deals"]=count($result_archive_deals);


		$result_active_auction =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->join("category","category.category_id","auction.category_id")->where(array("enddate >" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["active_auction"]=count($result_active_auction);

		$result_archive_auction =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate <" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["archive_auction"]=count($result_archive_auction);

		$result_active_products = $this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE purchase_count < user_limit_quantity and deal_status = 1 and stores.store_status = 1");
		$result["active_products"]=count($result_active_products);

		$result_sold_products =$this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE purchase_count = user_limit_quantity and deal_status = 1 and stores.store_status = 1");
		$result["archive_products"]=count($result_sold_products);

		$result_users = $this->db->from("users")->join("city","city.city_id","users.city_id")->join("country","country.country_id","users.country_id")->where(array("user_type" => 4, "user_status" => 1)) ->get();
            	$result["users"] =count($result_users);

		$result["admin"] = $this->db->count_records("users", array( "user_type" => 1, "user_status" => 1));
		$result_merchant = $this->db->from("users")->join("stores","stores.merchant_id","users.user_id")->join("city","city.city_id","users.city_id")->join("country","country.country_id","users.country_id")->where(array("user_type" => 3, "stores.store_type" => 1,"user_status" => 1))  ->get();
            	$result["merchant"]=count($result_merchant);
		$result_city = $this->db->from("city")->join("country","country.country_id","city.country_id")->where(array("city_status" => 1,"country.country_status" => 1))->get();
		$result["city"] = count($result_city);

		$result["county"] = $this->db->count_records("country", array( "country_status" => 1));

		$result_stores = $this->db->from("stores")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->join("users","users.user_id","stores.merchant_id")->where(array("store_status" => 1,"country_status" => 1,"city_status" => 1,"stores.store_type"=>1))->get();
                $result["stores"] =count($result_stores);

		$result["fund"] = $this->db->count_records("request_fund", array("type" => 1));

		$result["blog"] = $this->db->count_records("blog", array( "blog_status" => 1));



		$result["category"] = $this->db->count_records("category", array("category_status" => 1));

		$result_category = $this->db->from("category")->where(array("category_status" => 1))->get();
                $result["category"] =count($result_category);


		$result["FAQ"] = $this->db->count_records("faq", array( "faq_status" => 1));
		$result["contact"] = $this->db->count_records("contact", array( "status" => 1));

		$result_subscribe = $this->db->from("email_subscribe")->join("city","city.city_id","email_subscribe.city_id")->where(array("is_deleted" => 0,"suscribe_status"=>1))->get();
                $result["subscribe"] =count($result_subscribe);

		$result["products_shipping"] = count($this->db->select("shipping_info.shipping_id")->from("shipping_info")->join("transaction","transaction.id","shipping_info.transaction_id")->join("product","product.deal_id","transaction.product_id")->where(array( "shipping_type" => 1,"transaction.type !=" =>5))->groupby("shipping_id")->get());

		$result["auction_shipping"] = $this->db->count_records("shipping_info", array( "shipping_type" => 2));


	$result_coupon= $this->db->query("SELECT * FROM transaction_mapping join deals on deals.deal_id = transaction_mapping.deal_id join users on users.user_id=transaction_mapping.user_id where transaction_mapping.coupon_code_status = 0");
		$result["close_coupon"] = count($result_coupon);

		return $result;
	}

	/** GET ADMIN BALANCE **/

	public function get_admin_balance()
	{
                $result =$this->db->from("users")->where(array("user_type" => 1, "user_id" => $this->user_id))->get();
                return $result;
	 }

	/** GET USER LIST **/
	public function get_user_list()
	{
                $result = $this->db->query("SELECT * FROM users WHERE  user_status = 1 ");
                return $result;
	}

	/** GET USER LIST **/
	public function get_transaction_list()
	{
                $result = $this->db->query("SELECT * FROM transaction_mapping");
                return $result;
	}

	/** GET USER LIST **/
	public function get_transaction_chart_list()
	{
	        $result = $this->db->from("transaction")
                                ->get();
                return $result;

	}

	/** ADMINISTRATOR LOGIN **/

	public function admin_login($email = "", $password = "")
	{
		 $result=$this->db->query("SELECT * FROM users WHERE email = '$email' AND password ='".md5($password)."' AND user_type IN(1,7,2)");
		//$result = $this->db->from("users")->where(array("email" => $email, "password" => md5($password)), "user_type" ,"IN", array(1,7))->limit(1)->get();
		if(count($result) == 1){
			if($result->current()->user_status == 1){
				$this->session->set(array(
							"user_id" => $result->current()->user_id,
							"name" => $result->current()->firstname ,
							"user_email" => $result->current()->email,
							"user_city" => $result->current()->city_id,
							"user_type" =>  $result->current()->user_type,
							"facebook_status" =>  $result->current()->facebook_update,
							"fb_access_token" =>  $result->current()->fb_session_key,
							"fb_user_id" =>  $result->current()->fb_user_id
						));
						return 10;
			}
			return 9;
		}
		else{
			$emailCount = $this->db->count_records("users", array("email" => $email), "user_type" ,"IN",array(1,7,2));
			if($emailCount == 0){
				return 8;
			}
			return 0;
		}
	}

	/** GET CITY DATA **/

	public  function getCityData($country , $city)
	{
		$result = $this->db->from("city")
			->join("country","country.country_id","city.country_id")
			->where(array("city.country_id" => $country, "city_url" => $city ))
			->limit(1)
			->get();
		return $result;
	}
	/** GET CITY LIST **/

	public function get_City_List()
	{
		$result = $this->db->from("city")
					->join("country","country.country_id","city.country_id")
					->where(array("city_status" => 1,"country.country_status" => 1))
					->orderby("city.city_name", "ASC")
					->get();
		return $result;
	}

	/** GET CITY LIST **/

	public function get_all_City_List()
	{
		$result = $this->db->from("city")
		            ->join("country","country.country_id","city.country_id")
		            ->where(array("city_status!=" =>2 ))
					->orderby("city.city_name", "ASC")
					->get();
		return $result;
	}

	/** GET CITY LIST **/

	public function getCityList()
	{
		$result = $this->db->from("city")
					->join("country","country.country_id","city.country_id")
					->where(array("city_status" => 1))
					->orderby("city.city_name", "ASC")
					->get();
		return $result;
	}

	/** GET SINGLE ADMIN DATA **/

	public function get_users_data($userid = "")
	{
		$result = $this->db->from("users")->where(array("user_id" => $userid))->join("city","city.city_id","users.city_id")->limit(1)->get();
		return $result;
	}

	/** ADD COUNTRY TO COUNTRY TABLE**/

	public function add_country($post="")
	{
		$result = $this->db->from("country")->where(array("country_url" => url::title($post->country)))->get();
		if(count($result) == 0){
			$insert = $this->db->insert("country", array("country_name" => $post->country,"country_code" => $post->country_code, "country_url" => url::title($post->country),"currency_symbol" => $post->currency_symbol,"currency_code" => $post->currency_code));
			return count($insert);
		}else{
			if($result[0]->country_status==2)
			{
				$insert=$this->db->update("country",array("country_status" =>1),array("country_url" => url::title($post->country)));
				return 1;
			}
				return 0;
			}
	}

	/** MANAGE COUNTRY DATA LIST **/

	public function getcountryDataList()
	{
		$result = $this->db->from("country")->where(array("country_status!=" => 2))->orderby("country_url", "ASC")->get();
		return $result;
	}

	/** GET COUNTRY DATA **/

	public function getcountryData($country = "")
	{
		$result = $this->db->from("country")->where(array("country_url" => $country))->get();
		return $result;
	}

	/** EDIT COUNTRY **/

	public function edit_country($post = "", $country_url = "")
	{

		if(url::title($post->country) != $country_url){
			$result =  $this->db->count_records("country", array("country_url" => url::title($post->country)));
			if($result > 0){
				return 0;
			}

			//$status = $this->db->update("country", array("country_name" => $post->country, "country_url" => url::title($post->country),"currency_symbol" => $post->currency_symbol,"currency_code" => $post->currency_code),array("country_url" => $country_url));
		}
		$status = $this->db->update("country", array("country_name" => $post->country,"country_code"=>$post->country_code, "country_url" => url::title($post->country),"currency_symbol" => $post->currency_symbol,"currency_code" => $post->currency_code),array("country_url" => $country_url));
		if($status){
		return 1;
	}
	}

	/** DELETE COUNTRY **/

	public function deleteCountry($country = "")
	{
		$query=$this->db->select("country_id")->from("country")->where(array("country_url" => $country))->get();
		$query_result=$this->db->select("city_id")->from("city")->where(array("country_id" => $query[0]->country_id,"default" => 1))->get();
		if(count($query_result)==0){
			$result = $this->db->update("country",array("country_status" =>2),array("country_url" => $country ));
			$result1 = $this->db->update("city", array("city_status" => 2), array("country_id" => $query[0]->country_id));
			return count($result);
		}
		return -1;
		
	}

	/** BLOCK UNBLOCK COUNTRY **/

	public function blockunblockcountry($type = "", $country = "")
	{
		$status = 0;
		if($type == 1){
			$status = 1;
		}
		$result = $this->db->update("country", array("country_status" => $status),array("country_url" => $country));
		return count($result);
	}

	/** GET COUNTRY LIST **/

	public function get_country_list()
	{
		$result = $this->db->from("country")->where(array("country_status" => 1))->orderby("country_name", "ASC")->get();
		return $result;
	}

	/** ADD CITY TO DB **/

	public function add_city($country = "", $city = "",$post = "")
	{

		$result = $this->db->from("city")->where(array("country_id" => $country , "city_url" => url::title($city)))->get();
		if(count($result) == 0){
			$result1 = $this->db->from("city")->where(array("country_id!=" => $country , "city_url" => url::title($city),"city_status" =>2))->get();
			if(count($result1)==0)
			{
			$addCity = $this->db->insert("city", array("country_id" => $country, "city_name" => $city, "city_url" => url::title($city),"city_latitude"=>$post->latitude,"city_longitude"=>$post->longtitude));
			}else{
				$addCity = $this->db->update("city", array("country_id" => $country, "city_name" => $city, "city_url" => url::title($city),"city_latitude"=>$post->latitude,"city_longitude"=>$post->longtitude,"city_status"=>1),array("country_id!=" => $country , "city_url" => url::title($city),"city_status" =>2));
			}
			return 1;			
		}else
		{
			if($result[0]->city_status==2)
			{
				$add_city=$this->db->update("city",array("city_status"=>1),array("country_id" => $country , "city_url" => url::title($city)));
				return 1;
			}
			return 0;
		}
	}

	/** EDIT CITY DATA **/

	public function edit_city($country = "", $city = "", $post = "")
	{

		if($country == $post["country"] && $city ==  url::title($post["city"]) ){
                $this->db->update("city", array("city_latitude" => $post["latitude"], "city_longitude" => $post["longtitude"]),array("country_id" => $country, "city_url" => $city));
			return 1;
		}
		$result = $this->db->count_records("city", array("city_url" => url::title($post["city"]), "country_id" => $post["country"]));


		if($result == 0){
			$this->db->update("city", array("country_id" => $post["country"] , "city_name" => $post["city"] ,"city_url" =>  url::title($post["city"]),"city_latitude" => $post["latitude"], "city_longitude" => $post["longtitude"]),
			array("country_id" => $country, "city_url" => $city));
			return 1;
		}




		return 0;
	}

	/** BLOCK OR UNBLOCK CITY **/

	public function blockunblockcity($type = "", $country = "", $city = "")
	{
		$status = 0;
		if($type == 1){
			$status = 1;
		}
		$result = $this->db->update("city", array("city_status" => $status), array("country_id" => $country, "city_url" => $city ));
		return count($result);
	}

	/** DELETE CITY **/

	public function deleteCity($country = "", $city = "")
	{
		$result = $this->db->update("city",array("city_status"=>2),array("country_id" => $country, "city_url" => $city));
		return count($result);
	}

	/** SET DEFAULT CITY **/

	public function default_city($city)
	{
		if($city){
		$city_update = $this->db->update("city", array("default" => 0), array("city_id >" => 0));
		}
		$result = $this->db->update("city", array("default" => 1), array("city_id" => $city));
		return 1;

	}


	/** ADD CATEGORY **/

	public function add_category($category = "", $cat_status = "",$deal = "",$product = "",$auction = "")
	{
		$result = $this->db->select("category_id","category_status")->from("category")->where(array("category_url" => url::title($category),"type"=>1))->get();
		if(count($result) == 0){
			$status = $this->db->insert("category", array("category_name" => $category , "category_url" => url::title($category),"category_status" => $cat_status,"deal" => $deal,"product" => $product,"auction" => $auction,"type" => "1"));
				if(count($status) == 1){
						return $status->insert_id();
				}
		}else{
			if($result[0]->category_status==2)
			{
				$status=$this->db->update("category",array("category_name" => $category , "category_url" => url::title($category),"category_status" => $cat_status,"deal" => $deal,"product" => $product,"auction" => $auction,"type" => "1","category_status"=>1),array("category_status" =>2,"category_id" => $result[0]->category_id));
				if(count($status) == 1){
					return 1;
				}
			}
			return 0;
		}
	}

		/** ADD SUB CATEGORY **/

	public function add_sub_category($category = "", $cat_status = "",$cat_id = "",$cat_type = "",$type = "")
	{
		$sub_result = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => $type))->get();
		$mail_cat_id = $sub_result->current()->main_category_id;
		if($type == 1){
			$mail_cat_id = $cat_id;
		}
		        
		$result = $this->db->select("category_id","category_status")->from("category")->where(array("category_url" => url::title($category),"type"=>$cat_type,"sub_category_id"=>$cat_id,"main_category_id" => $mail_cat_id))->get();
		
		if(count($result) == 0){
		        
			$status = $this->db->insert("category", array("category_name" => $category , "category_url" => url::title($category),"category_status" => $cat_status,"main_category_id" => $mail_cat_id,"sub_category_id" => $cat_id,"type" => $cat_type));
                        if(count($status) == 1){
                                return $status->insert_id();
                        }
		}else{
			if($result[0]->category_status==2)
			{
				$sub_result = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => $type))->get();
		        $mail_cat_id = $sub_result->current()->main_category_id;
		        if($type == 1){
		         $mail_cat_id = $cat_id;
		        }
				$results=$this->db->update("category",array("category_name" => $category , "category_url" => url::title($category),"category_status" => $cat_status,"main_category_id" => $mail_cat_id,"sub_category_id" => $cat_id,"type" => $cat_type,"category_status" => 1),array("category_url" => url::title($category),"category_id" => $result[0]->category_id));
				return 1;
			}
			return 0;
		}
	}


	/** GET CATEGORY LIST **/

	public function get_category_list()
	{
		$result = $this->db->from("category")->orderby("category_name", "ASC")->get();
		return $result;
	}

	public function get_main_category_list()
	{
		$result = $this->db->from("category")->where(array("type" => "1","category_status!=" =>2))->orderby("category_name", "ASC")->get();
		return $result;
	}

	/** GET SUB CATEGORY LIST **/

	public function get_sub_category_list()
	{
		$result = $this->db->from("category")->where(array("type" => "2"))->orderby("category_name", "ASC")->get();
		return $result;
	}

	/** GET SEC SUB CATEGORY LIST **/

	public function get_sec_sub_category_list()
	{
		$result = $this->db->from("category")->where(array("type" => "3"))->orderby("category_name", "ASC")->get();
		return $result;
	}

	/** GET THIRD SUB CATEGORY LIST **/

	public function get_third_sub_category_list()
	{
		$result = $this->db->from("category")->where(array("main_category_id !=" =>0,"type" => "4"))->orderby("category_name", "ASC")->get();
		return $result;
	}

	/** GET SUB CATEGORY LIST **/

	public function get_sub_category_list1($cat_id = "")
	{

		$result = $this->db->from("category")->where(array("sub_category_id" =>$cat_id,"type" => "2","category_status!=" =>2))->orderby("category_name", "ASC")->get();
		return $result;
	}

	public function get_sub_category_list11($main_cat_id = "", $cat_id = "", $cat_url = "" )
	{

                $resultcount = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => 3))->get();

		$main = $resultcount->current()->sub_category_id;
		$result = $this->db->from("category")->where(array("category_id" =>$main ,"type" => "2"))->orderby("category_name", "ASC")->get();

		return $result;
	}

	/** GET SEC SUB CATEGORY LIST **/

	public function get_sub_category_list2($cat_id = "")
	{
		$result = $this->db->from("category")->where(array("sub_category_id" =>$cat_id,"type" => "3","category_status!="=>2))->orderby("category_name", "ASC")->get();
		return $result;
	}

	/** GET SEC SUB CATEGORY LIST **/

	public function get_sub_category_list3($cat_id = "")
	{
		$result = $this->db->from("category")->where(array("sub_category_id" =>$cat_id,"type" => "4","category_status!="=>2))->orderby("category_name", "ASC")->get();
		return $result;
	}


	public function get_mail_category($cat_id = "", $type = "")
	{

		$resultcount = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => $type))->get();
		$mail = $resultcount->current()->main_category_id;
		$result = $this->db->from("category")->where(array("category_id" =>$mail,"type" => "1"))->get();

		return $result;
	}

	public function get_sub_category($cat_id = "",$type = "")
	{
	        $sub_type =  $type - 1;
		$resultcount = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => $type))->get();
		$mail = $resultcount->current()->sub_category_id;
		$result = $this->db->from("category")->where(array("category_id" =>$mail,"type" =>$sub_type))->get();
		return $result;
	}

	public function get_category($cat_id = "")
	{
	$resultcount = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => "2"))->get();
	return $resultcount;
	}

	public function get_sub_sec_category($cat_id = "")
	{
	$resultcount = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => "3"))->get();
	return $resultcount;
	}
	/** GET MAIN CATEGORY DATA **/

	public function get_category_data($cat_id = "", $cat_url = "")
	{
		$result = $this->db->from("category")->where( array("category_id" => $cat_id, "category_url" => url::title($cat_url)))->get();
		return $result;
	}

	/** GET MAIN SUB CATEGORY DATA **/

	public function get_sub_category_data($cat_id = "", $cat_url = "",$cat_type = "")
	{
		$result = $this->db->from("category")->where( array("category_id" => $cat_id, "category_url" => url::title($cat_url),"main_category_id !=" =>0,"type" => $cat_type))->get();
		return $result;
	}



	/** EDIT CATEGORY **/

	public function edit_category($category = "", $cat_status = "", $cat_id = "", $cat_url = "",$type="",$deal = "",$product = "",$auction = "")
	{
		if(url::title($category) != $cat_url){
			$sub_result = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => $type))->get();
			$mail_cat_id = $sub_result->current()->main_category_id;
			$sub_category_id = $sub_result->current()->sub_category_id;
			if($type == 1){
				$mail_cat_id = 0;
				$sub_category_id = 0;
			}
			
			//$result = $this->db->select("category_id","category_status")->from("category")->where(array("category_url" => url::title($category),"type"=>$type,"category_id != "=>$cat_id))->get();
			
			$result = $this->db->select("category_id","category_status")->from("category")->where(array("category_url" => url::title($category),"type"=>$type,"sub_category_id"=>$sub_category_id,"main_category_id" => $mail_cat_id,"category_id != "=>$cat_id))->get();
			
			if(count($result) > 0){
				if($result[0]->category_status==2)
				{
					$status=$this->db->update("category",array("category_name" => $category , "category_url" => url::title($category), "category_status" => $cat_status,"deal" => $deal,"product" => $product,"auction" => $auction,"category_status"=>1),array("category_status" =>2,"category_id" =>$result[0]->category_id));
					return 1;
				}
				return 0;
			}
			
		}
		$status = $this->db->update("category", array("category_name" => $category , "category_url" => url::title($category), "category_status" => $cat_status,"deal" => $deal,"product" => $product,"auction" => $auction),
		array("category_id" => $cat_id, "category_url" => url::title($cat_url)));
		return 1;
	}



	/** BLOCK OR UNBLOCK CATEGORY **/

	public function blockunblockcategory($type = "", $cat_id = "", $cat_url = "")
	{
		$status = 0;
		if($type == 1){
			$status = 1;
		}
		$result = $this->db->update("category", array("category_status" => $status), array("category_id" => $cat_id, "category_url" => $cat_url ));
				$this->db->update("category", array("category_status" => $status), array("main_category_id" => $cat_id));
		return count($result);
	}

	/** BLOCK OR UNBLOCK SUB CATEGORY **/

	public function blockunblocksubcategory($type = "", $main_cat_id, $cat_id = "", $cat_url = "")
	{
		$status = 0;
		if($type == 1){
			$status = 1;
		}
				$result = $this->db->from('category')->select('category_status')->where(array("category_id" => $main_cat_id,"main_category_id"=>0,"category_status" =>1))->get();
				if(count($result)>0){

		$result1 = $this->db->update("category", array("category_status" => $status), array("category_id" => $cat_id, "category_url" => $cat_url ));

				return count($result);
			}
			else return 0;
	}


	public function blockunblocksecsubcategory($type = "", $main_cat_id, $cat_id = "", $cat_url = "")
	{
		$status = 0;
		if($type == 1){
			$status = 1;
		}
				$result = $this->db->from('category')->select('category_status')->where(array("category_id" => $main_cat_id,"main_category_id !="=>0,"category_status" =>1))->get();
				if(count($result)>0){

		$result1 = $this->db->update("category", array("category_status" => $status), array("category_id" => $cat_id, "category_url" => $cat_url ));

				return count($result);
			}
			else return 0;
	}

	/** DELETE CATEGORY **/

	public function deleteCategory($cat_id = "", $cat_url = "")
	{
		$result = $this->db->update("category",array("category_status" =>2),array("category_id" => $cat_id, "category_url" => $cat_url));
		$query=$this->db->update("category",array("category_status" =>2),array("main_category_id" => $cat_id));
		$query=$this->db->update("category",array("category_status" =>2),array("sub_category_id" => $cat_id));
		return count($result);
	}

       /** ADMIN DETAILS **/

	public function user_details()
	{

		$result = $this->db->from("users")
				->where(array("user_id" =>$this->user_id))
                                ->join("city","city.city_id","users.city_id")
                                ->join("country","country.country_id","city.country_id")
                                ->get();

                return $result;
	}





       /** UPDATE ADMIN **/

        public function edit_admin($id = "",$post= "")
        {
		$city_id=$post->city;
		$result_country = $this->db->select("country_id")->from("city")
					      ->where(array("city_id" =>$city_id))
				              ->limit(1)
					      ->get();
		                               $country_value = $result_country->current()->country_id;

		$result = $this->db->update("users", array('firstname' => $post->name, 'email' => $post->email,'phone_number' => $post->mobile, 'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city,'payment_account_id' => $post->payment,'country_id' =>$country_value), array('user_id' => $id));
		return $result;
        }



       /** UPDATE PASSWORD **/

	public function change_password($id = "", $pass = "")
	{
		$result = $this->db->update("users", array('password' => md5($pass->password)), array('user_id' => $id));
		return count($result);

	}


      /** CHECK PASSWORD **/

	public function exist_password($pass = "", $id = "")
	{
		$result = $this->db->count_records('users', array('user_id' => $id, 'password' => md5($pass)));
		return (bool) $result;
	}

	/** CHECK EMAIL EXIST **/

	public function exist_email($email = "")
	{
		$result = $this->db->count_records('users', array('email' => $email));
		return (bool) $result;
	}

	/** GET COPY RIGHTS**/

	public function get_copy_right()
	{
		$result = $this->db->from("cms")->where(array("cms_id" => 8))->get();
		return $result;
	}

	/**GET  DEALS COUPON **/

	public function coupon_code_validate($code="")
	{
	                $time=time();
			$conditions="";
              		if($code || $code=='0'){
                                $conditions= "transaction_mapping.coupon_code ='".mysql_real_escape_string($code)."'";
                         }
                        $query = "select deals.*,transaction_mapping.coupon_code,transaction_mapping.coupon_code_status,transaction.type,transaction.id as trans_id,transaction.amount,transaction.referral_amount,transaction.quantity,transaction.file_name from deals join transaction on transaction.deal_id=deals.deal_id  join transaction_mapping on transaction_mapping.transaction_id=transaction.id where $conditions and expirydate > $time limit 1 ";
                        $result = $this->db->query($query);

			return $result;

	}

	/** UPDATE COUPON STATUS **/

	public function close_coupon_status($type = "",$coupon_code="",$deal_id = "" ,$trans_id=0,$act=0)
	{

			//$count = $this->db->count_records("transaction_mapping", array("coupon_code_status" => $type), array("coupon_code" => $coupon_code,"deal_id" => $deal_id));

			//if($count==0){

	         $transaction_details = $this->db->select("referral_amount","amount","deal_merchant_commission","quantity")->from("transaction")->where(array("deal_id" => $deal_id,"id" =>$trans_id))->get();
             $transaction_referral_amount=$transaction_details->current()->referral_amount;
             $merchant_commission = $transaction_details->current()->deal_merchant_commission;
             $transaction_amount=$transaction_details->current()->amount;
             $quantity= $transaction_details->current()->quantity;
             $transaction_total_amount = $transaction_referral_amount + $transaction_amount;
             $transaction_total_amount = $transaction_total_amount/$quantity; // for separate quantity

             $deals_details = $this->db->select("merchant_id")->from("deals")->where(array("deal_id" => $deal_id))->get();
	         $merchant_id=$deals_details->current()->merchant_id;

	         // select merchant details
	         $merchant_details = $this->db->select("merchant_account_balance","merchant_commission")->from("users")->where(array("user_id" => $merchant_id))->get();

	         $merchant_account_balance = $merchant_details->current()->merchant_account_balance;

	         $admin_percentage = ($merchant_commission/100);
	         $admin_commission = $admin_percentage * $transaction_total_amount;
	         $merchant_amount = $transaction_total_amount - $admin_commission;
	         $merchant_account = $merchant_account_balance + $merchant_amount;

	         // update merchant account balance details
	         $result_mer = $this->db->update("users", array("merchant_account_balance" => $merchant_account), array("user_id" => $merchant_id));

	         // select admin details
	       /*  $admin_details = $this->db->select("merchant_account_balance")->from("users")->where(array("user_type" => "1"))->get();
	         $admin_account_balance=$admin_details->current()->merchant_account_balance;
	         $admin_commission_amount=($admin_account_balance+$admin_commission);
	         $admin_total_amount=($admin_commission_amount-$transaction_total_amount);

	         // update admin account balance details
	         $result_admin = $this->db->update("users", array("merchant_account_balance" => $admin_total_amount), array("user_type" => "1"));   */
            $result = $this->db->update("transaction_mapping", array("coupon_code_status" => $type), array("coupon_code" => $coupon_code,"deal_id" => $deal_id));
			if($act==1){  // cod transaction

			//$coupon_count = $this->db->count_records("transaction_mapping", array("coupon_code_status" => $type), array("transaction_id" => $trans_id,"deal_id" => $deal_id));

				//if($coupon_count == $quantity){
					$this->db->update('transaction',array('captured_date' =>time(),'payment_status' => 'Completed','pending_reason' =>'None'),array('id' => $trans_id));
				//}

			}

                return count($result);
         // }
          //return 0;
	}

	/** UPDATE COD COUPON STATUS **/

	/*public function close_coupon_status_cod($type = "",$coupon_code="",$deal_id = "" ,$trans_id=0,$merchant_id=0,$val=0)
	{

			if($merchant_id && $val==4){

				 $transaction_details = $this->db->select("referral_amount","amount","deal_merchant_commission","quantity")->from("transaction")->where(array("deal_id" => $deal_id,"id" =>$trans_id))->get();
				 $transaction_referral_amount=$transaction_details->current()->referral_amount;
				 $merchant_commission = $transaction_details->current()->deal_merchant_commission;
				 $transaction_amount=$transaction_details->current()->amount;
				 $transaction_total_amount = $transaction_referral_amount + $transaction_amount;
				 $quantity= $transaction_details->current()->quantity;
				 $transaction_total_amount = $transaction_total_amount/$quantity;// for separate quantity
				 $admin_percentage = ($merchant_commission/100);
				 $admin_commission = $admin_percentage * $transaction_total_amount;
				 $merchant_amount = $transaction_total_amount - $admin_commission;
				 //$merchant_account = $merchant_account_balance + $merchant_amount;

				 // update merchant account balance details
				$this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchant_amount where user_type = 3 and user_id = $merchant_id ");

				 // select admin details
				 $admin_details = $this->db->select("merchant_account_balance")->from("users")->where(array("user_type" => "1"))->get();
				 $admin_account_balance=$admin_details->current()->merchant_account_balance;
				 $admin_commission_amount=($admin_account_balance+$admin_commission);
				 $admin_total_amount=($admin_commission_amount-$transaction_total_amount);

				 // update admin account balance details
				 $result_admin = $this->db->update("users", array("merchant_account_balance" => $admin_total_amount), array("user_type" => "1"));

				$result = $this->db->update("transaction_mapping", array("coupon_code_status" => $type), array("coupon_code" => $coupon_code,"deal_id" => $deal_id,"transaction_id" => $trans_id));

				//$coupon_count = $this->db->count_records("transaction_mapping", array("coupon_code_status" => $type), array("transaction_id" => $trans_id,"deal_id" => $deal_id));

				//if($coupon_count == $quantity){

				$this->db->update('transaction',array('captured' => 1,'captured_date' =>time(),'payment_status' => 'Completed','pending_reason' =>'None'),array('id' => $trans_id));

				//}


					return count($result);
           }
           else if($merchant_id && $val==5){

					$result = $this->db->update("transaction_mapping", array("coupon_code_status" => -1), array("coupon_code" => $coupon_code,"deal_id" => $deal_id,"transaction_id" => $trans_id));

					return 1;

			}
	}  */


	//** EMAIL SUBSCRIBER***//
	
	/** GET USERS DATA  **/
	
        public function get_subscriber_list($offset = "", $record = "",  $category= "",$email="")
        {

                	$contitions = "where email_subscribe.is_deleted=0";
			 if($category){
                                $contitions .= " AND find_in_set($category,email_subscribe.category_id)";
                        }

                        if($email){

		       // $contitions .= ' AND city.city_name like "%'.mysql_escape_string($city).'%"';
                        $contitions .= ' AND email_subscribe.email_id like "%'.mysql_escape_string($email).'%"';
                       
                        }	
 
                       $result = $this->db->query("select *,email_subscribe.category_id as category_ids from email_subscribe left join category on category.category_id=email_subscribe.category_id    $contitions  order by subscribe_id DESC limit $offset, $record");

                return $result;
        }
	
        /** GET USERS COMMANTS DATA  **/
	
        public function get_subscriber_count($category = "",$email="")
        {
               		$contitions = "where email_subscribe.is_deleted= 0";
                        if($category){
                                $contitions .= " AND find_in_set($category,email_subscribe.category_id)";
                        }

                        if($email){

		       // $contitions .= ' AND city.city_name like "%'.mysql_escape_string($city).'%"';
                        $contitions .= ' AND email_subscribe.email_id like "%'.mysql_escape_string($email).'%"';
                       
                        }	
                       $result = $this->db->query("select * from email_subscribe left join category on category.category_id=email_subscribe.category_id   $contitions  order by email_subscribe.subscribe_id DESC ");


                return count($result);
        }




        /** BLOCK & UNBLOCK SUBSCRIBER**/

        public function block_subscriber($type="", $subscribe_id="")
        {
                $status = 0;
                if($type == 1){
                    $status = 1;
                }
                $result = $this->db->update("email_subscribe", array("suscribe_status" => $status), array("subscribe_id" => $subscribe_id));
                return count($result);
        }

	/** DELETE  SUBSCRIBER**/

	public function delete_subscriber($subscribe_id = "")
	{
		$result = $this->db->update("email_subscribe",array("is_deleted" => 1),array("subscribe_id" => $subscribe_id));
		return count($result);
	}


	/** GET CONTACTS DATA  **/

        public function get_contacts_list($offset = "", $record = "",  $name= "",$limit="")
        {
			$limit1 = $limit !=1 ?"limit $offset,$record":"";

                	$contitions = "where status=1";
                        if($name){
						$contitions .= ' AND name like "%'.mysql_real_escape_string($name).'%"';
                        $contitions .= ' OR email like "%'.mysql_real_escape_string($name).'%"';
                        }
                       $result = $this->db->query("select * from contact $contitions order by contact_id DESC $limit1 ");
                return $result;
        }


	 /** GET CONTACTS DATA  **/

        public function get_contacts_count($name = "")
        {
               		$contitions = "where status=1";
                        if($name){

		        $contitions .= ' AND name like "%'.mysql_real_escape_string($name).'%"';
                        $contitions .= ' OR email like "%'.mysql_real_escape_string($name).'%"';
                        }
                       $result = $this->db->query("select * from contact $contitions order by contact_id DESC ");
                return count($result);
        }



	/** DELETE  SUBSCRIBER**/

	public function delete_contact($contact_id = "")
	{
		//$result = $this->db->delete('contact',array('contact_id' => $contact_id));
		$result = $this->db->update("contact",array("status" => 0),array("contact_id" => $contact_id));
		return count($result);
	}

	/** GET REFERRAL USERRS COUNT **/

	public function get_referral_users_count($name = "",$email = "")
	{
		$contitions = "u2.user_status = 1";
                        if($name){
                                $contitions .= ' AND u2.firstname like "%'.mysql_real_escape_string($name).'%" OR u1.firstname like "%'.mysql_real_escape_string($name).'%" ';
                        }

                        if($email){
		       // $contitions .= ' AND city.city_name like "%'.mysql_real_escape_string($city).'%"';
                        $contitions .= ' AND u2.email like "%'.mysql_real_escape_string($email).'%"';

                        }
                       $result = $this->db->query("select u1.firstname as refered_name,u2.firstname as referal_name,u2.joined_date as ref_joined_date,u2.email as ref_email from users as u1 join users as u2 on u2.referred_user_id = u1.user_id where $contitions  order by u2.joined_date DESC ");

                return count($result);
	}

	/** GET REFERRAL USERRS LIST **/

	public function get_referral_users_list($offset = "", $record = "",$name = "",$email = "",$limit="")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$contitions = "u2.user_status = 1";
                        if($name){
                                $contitions .= ' AND u2.firstname like "%'.mysql_real_escape_string($name).'%" OR u1.firstname like "%'.mysql_real_escape_string($name).'%"';
                        }

                        if($email){

		       // $contitions .= ' AND city.city_name like "%'.mysql_real_escape_string($city).'%"';
                        $contitions .= ' AND u2.email like "%'.mysql_real_escape_string($email).'%"';
                        }
                       $result = $this->db->query("select u1.firstname as refered_name,u1.user_id as referreduserid, u2.user_id as userid,u2.firstname as referal_name,u2.joined_date as ref_joined_date,u2.email as ref_email from users as u1 join users as u2 on u2.referred_user_id = u1.user_id where $contitions  order by u2.joined_date DESC $limit1 ");
                return $result;
	}

	/** ADD COLOR  **/

	public function add_color($color_code = "",$color_name = "")
	{
		$count = $this->db->count_records("color_code",array("color_name" =>$color_name));
		if($count == 0){
			$result = $this->db->insert("color_code",array("color_code" =>substr($color_code,1), "color_name" =>$color_name));
		}
			return 1;

	}

	/** GET COLOR COUNT  **/

	public function get_color_count()
	{
		return $this->db->count_records("color_code");
	}

	/** GET COLOR LIST  **/

	public function get_color_list($offset = "", $record = "")
	{
		return $this->db->limit($record,$offset)->get('color_code');

	}

	/** EDIT COLOR DATA AND UPDATE  **/

	public function edit_color($color_id = "",$color_code = "",$color_name = "")
	{
			$result =  $this->db->count_records("color_code", array("color_code" => substr($color_code,1)));
			if($result > 0){
				return 0;
			}
			$status = $this->db->update("color_code", array("color_code" => substr($color_code,1), "color_name" => $color_name),array("id" => $color_id));
		return 1;

	}

	/** GET SINGLE COLO DATA FOR EDIT  **/

	public function getcolorData($color_id = "")
	{
		return $this->db->getwhere('color_code',array('id' => $color_id));
	}

	/** DELETE COLOR **/

	public function delete_color($color_id = "")
	{
		$result = $this->db->delete("color_code",array("id" => $color_id ));
		return count($result);
	}

	/** INSERT SIZE VALUE TO THE DATABASE */

	public function add_size($size = "")
	{
		$result = $this->db->insert("size",array("size_name" =>$size));
			return 1;
	}


	/** GET SIZE COUNT  **/

	public function get_sizes_count()
	{
		return $this->db->count_records("size");
	}

	/** GET SIZE LIST  **/

	public function get_sizes_list($offset = "", $record = "")
	{
		return $this->db->limit($record,$offset)->get('size');
	}

	/** EDIT SIZE DATA AND UPDATE  **/

	public function edit_size($size_id = "",$size = "")
	{
			$result =  $this->db->count_records("size", array("size_name" =>$size));
			if($result > 0){
				return 0;
			}
			$status = $this->db->update("size", array("size_name" =>$size),array("size_id" => $size_id));
		return 1;

	}

	/** GET SINGLE COLO DATA FOR EDIT  **/

	public function getsizeData($size_id = "")
	{
		return $this->db->getwhere('size',array('size_id' => $size_id));
	}

	/** DELETE SIZE **/

	public function delete_size($size_id = "")
	{
		$result = $this->db->delete("size",array("size_id" => $size_id ));
		return count($result);
	}

	/** REGISTER  AUTO POST INTO FACEBOOK  WALL **/

	public function register_autopost($fb_profile = array(),$fb_access_token = "")
	{
        $result= $this->db->update("users", array("fb_user_id" => $fb_profile->id ,"fb_session_key" => $fb_access_token,"facebook_update"=>1), array("user_id" =>$this->user_id));
		$this->session->set(array("fb_access_token" => $fb_access_token,"fb_user_id" => $fb_profile->id));
		return $result;
	}

	/** UPDATE  AUTO POST **/
	public function update_autopost($value = "")
	{
		$result = $this->db->update("users", array("facebook_update" =>$value,"fb_user_id"=>0,"fb_session_key"=>0), array("user_id" =>$this->user_id));
		return $result;
	}

	/** GET ADMIN BALANCE **/

	public function get_admin_balance1()
	{
                $result =$this->db->select("merchant_account_balance")->from("users")->where(array("user_type" => 1))->get();
                return (count($result))?$result->current()->merchant_account_balance:0;
	 }
	 
	 /**  ADD SECTOR DATA **/
	 public function add_sector($data = "")
	{
		$result = $this->db->insert("sector",array("sector_name" =>$data->sector, "type" => '1'));
			return 1;
	}	
        
        /** GET SECTOR COUNT  **/
	
	public function get_sector_count()
	{
		return $this->db->count_records("sector");
	}

	/** GET SECTOR LIST  **/
	
	public function get_sector_list($offset = "", $record = "")
	{
		return $this->db->where(array("type"=>1))->orderby("sector_name","ASC")->limit($record,$offset)->get('sector');
	}
	
	/** EDIT SECTOR DATA AND UPDATE  **/

	public function edit_sector($sector_id = "",$data = "")
	{
		$result =  $this->db->count_records("sector", array("sector_name" => $data->sector,"sector_id!=" => $sector_id));
			if($result > 0){
				return 0;
			}
		$status = $this->db->update("sector", array("sector_name" =>$data->sector),array("sector_id" => $sector_id));
		return 1;
	}

	/** GET SECTOR DATA FOR EDIT  **/

	public function getsectorData($sector_id = "")
	{
		return $this->db->getwhere('sector',array('sector_id' => $sector_id));
	}
	
	/** DELETE SECTOR DATA **/
	
	public function delete_sector($sector_id = "")
	{
               $result = $this->db->delete("sector",array("sector_id" => $sector_id ));
              return count($result);
        }
        
        /** EXIST SECTOR DATA **/
        
        public function exist_name($name = "")
	{
		$result = $this->db->count_records('sector', array('sector_name' => $name));
		return (bool) $result;
	}
	
	 /** BLOCK & UNBLOCK SUBSCRIBER**/

        public function block_sector($type="", $sector_id="")
        {
                $status = 0;
                if($type == 1){
                    $status = 1;
                }
                $result = $this->db->update("sector", array("sector_status" => $status), array("sector_id" => $sector_id));
                $this->db->update("sector", array("sector_status" => $status), array("main_sector_id" => $sector_id));
                return count($result);
        }
        
        /** SECTOR DATA **/
        public function get_sector_data($sector_id="",$sector_name="")
        {
			$result=$this->db->select("sector_name")->from("sector")->where(array("sector_id" =>$sector_id, "sector_name" =>$sector_name))->get();
			return $result;
		}
		
		/** ADDING SUB SECTOR **/
		public function add_sub_sector($subsector="", $cat_status="", $cat_id="",$type="")
		{
			
			$result = $this->db->count_records("sector", array("sector_name" => $subsector));
		if($result == 0){
		        $sub_result = $this->db->from("sector")->where(array("sector_id" =>$cat_id,"type" => 1))->get();
		        $mail_cat_id = $sub_result->current()->sector_id;
		        
			$status = $this->db->insert("sector", array("sector_name" => $subsector , "sector_status" => $cat_status,"main_sector_id" => $mail_cat_id,"type" => $type));
                        if(count($status) == 1){
                                return $status->insert_id();
                        }
		}
		return 0;
		}
		
		/** SUBSECTOR LIST **/
		public function get_sub_sector_list($sector_id="")
		{
			$result=$this->db->from("sector")->where(array("type" =>2 ,"main_sector_id"=>$sector_id))->get();
			return $result;
		}
		/** SUBSECTOR LIST COUNT **/
		public function get_sub_sector_count()
		{
			$result=$this->db->from("sector")->where(array("type" =>2 ))->get();
			return count($result);
		}
		/** SUBSECTOR LIST **/
		public function get_sub_sector_list1()
		{
			$result=$this->db->from("sector")->where(array("sector_status" =>1, "type" =>2 ))->get();
			return $result;
		}
		/** BLOCK OR UNBLOCK SUB SECTOR **/

	public function blockunblocksubsector($type = "", $main_cat_id, $cat_id = "", $cat_url = "")
	{
		$status = 0;
		if($type == 1){
			$status = 1;
		}
				$result = $this->db->from('sector')->select('sector_status')->where(array("sector_id" => $main_cat_id,"sector_status" =>1))->get();
				if(count($result)>0){

		$result1 = $this->db->update("sector", array("sector_status" => $status), array("sector_id" => $cat_id, "sector_name" => $cat_url ));

				return count($result);
			}
			else return 0;
	}
	
	public function get_subsector($cat_id = "")
	{
	$resultcount = $this->db->from("sector")->where(array("sector_id" =>$cat_id,"type" => "2"))->get();
	return $resultcount;
	}
	
	/** GET MAIN SUB CATEGORY DATA **/

	public function get_sub_sector_data($cat_id = "", $cat_url = "",$cat_type = "")
	{
		$result = $this->db->from("sector")->where( array("sector_id" => $cat_id, "sector_name" => $cat_url,"type" => $cat_type))->get();
		return $result;
	}
	/** EDIT CATEGORY **/

	public function edit_sub_sector($sector = "", $cat_status = "", $cat_id = "", $cat_url = "")
	{
		if($sector != $cat_url){
			$result = $this->db->count_records("sector", array("sector_name" => url::title($sector)));
			if($result > 0){
				return 0;
			}
		}
		$status = $this->db->update("sector", array("sector_name" => $sector, "sector_status" => $cat_status),
		array("sector_id" => $cat_id, "sector_name" => $cat_url));
		return 1;
	}
	
	/** DELETE CATEGORY **/

	public function deletesubsector($cat_id = "", $cat_url = "")
	{
		$result = $this->db->delete("sector",array("sector_id" => $cat_id, "sector_name" => $cat_url));
		return count($result);
	}

	public function getlike_subsector($name="")
	{
		if($name)
		{
			$search_key = common::mysql_escape_string_function($name);
			$conditions = " sector_name like '%".$search_key."%' and main_sector_id !='0' and  type ='2' and sector_status ='1' ";
		}

		$this->db->select("sector_name,sector_id")->from("sector")->where($conditions)->orderby("sector_id","desc")->limit(10)->offset(0);

		$result = $this->db->get();
		return $result;
	}
	
	public function change_sortorder($order='',$category_id=''){
		if($order==0){
			$this->db->update("category",array("order_by"=>0),array("category_id"=>$category_id));
			return 1;
		}else{
			$result = $this->db->count_records("category",array("order_by"=>$order,"category_id!="=>$category_id));
			if($result==0){
				$this->db->update("category",array("order_by"=>$order),array("category_id"=>$category_id));
				return 1;
			}else{
				return -1;
			}
		}
	}
	
	public function check_sub_sector($subsector="", $cat_status="", $cat_id="",$type="")
	{	
		$result = $this->db->count_records("sector", array("sector_name" => $subsector));
		return $result;
	}

}

