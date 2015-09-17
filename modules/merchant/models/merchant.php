<?php defined('SYSPATH') or die('No direct script access.');
class Merchant_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->user_id = $this->session->get("user_id");
		$this->user_id1 = $this->session->get("user_id1");
	}

        /** MERCHANT DASHBORAD DATA **/

	public function get_merchant_dashboard_data()
	{
		$result_active_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->where(array("enddate >" => time(),"deals.merchant_id" => $this->user_id,"deal_status"=>"1","stores.store_status" => "1"))->get();
		$result["active_deals"]=count($result_active_deals);

		$result_archive_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->where(array("enddate <" => time(),"deals.merchant_id" => $this->user_id,"deal_status"=>"1","stores.store_status" => "1"))->get();
		$result["archive_deals"]=count($result_archive_deals);

		$result_active_products =$this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE purchase_count < user_limit_quantity  and deal_status=1 and stores.store_status = 1 and product.merchant_id = ".$this->user_id."");
		$result["active_products"]=count($result_active_products);

		$result_sold_products =$this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE  purchase_count = user_limit_quantity  and deal_status=1 and stores.store_status = 1 and product.merchant_id = ".$this->user_id."");
		$result["sold_products"]=count($result_sold_products);

		$result_active_auction =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->join("category","category.category_id","auction.category_id")->where(array("enddate >" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1","auction.merchant_id" => $this->user_id))->get();
		$result["active_auction"]=count($result_active_auction);

		$result_archive_auction =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate <" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1","auction.merchant_id" => $this->user_id))->get();
		$result["archive_auction"]=count($result_archive_auction);

		$result["products_shipping"] = count($this->db->select("shipping_info.shipping_id")->from("shipping_info")->join("transaction","transaction.id","shipping_info.transaction_id")->join("product","product.deal_id","transaction.product_id")->where(array( "shipping_type" => 1,"transaction.type !=" =>5,"product.merchant_id" => $this->user_id))->groupby("shipping_id")->get());

		//$result["auction_shipping"] = $this->db->count_records("shipping_info", array( "shipping_type" => 2));
		$result["auction_shipping"] = count($this->db->select("shipping_info.shipping_id")->from("shipping_info")->join("transaction","transaction.id","shipping_info.transaction_id")->join("auction","auction.deal_id","transaction.auction_id")->where(array( "shipping_type" => 2,"transaction.type !=" =>5,"auction.merchant_id" => $this->user_id))->groupby("shipping_id")->get());

		$result["stores"] = $this->db->count_records("stores", array( "store_status" => 1, "merchant_id" => $this->user_id));
		$result["request_fund"] = $this->db->count_records("request_fund", array( "request_status" => 2, "user_id" => $this->user_id));
		$result_close_coupon = $this->db->select("transaction_mapping.id")->from("transaction_mapping")->join("deals","deals.deal_id","transaction_mapping.deal_id")->where(array("coupon_code_status" => 0,"deals.merchant_id" => $this->user_id))->get();
		$result["close_coupon"] = count($result_close_coupon);
		return $result;
	}

	/** GET MERCHANT BALANCE **/

        public function get_merchant_balance_fund()
	{
                $result =$this->db->from("request_fund")->where(array("request_status" => 2, "user_id" => $this->user_id))->get();
                return $result;
        }

	/** MERCHANT LOGIN **/

	public function merchant_login($email = "", $password = "")
	{
               $result=$this->db->query("SELECT * FROM users WHERE email = '$email' AND password ='".md5($password)."' AND user_type IN(3,8)");
                //$result = $this->db->from("users")->where(array("email" => $email, "password" => md5($password),"user_type","in" =>(3,8))->limit(1)->get();
		     if(count($result)>0){
                        if(count($result) == 1){
	                        if($result->current()->user_status == 1){
				if($result->current()->user_type == 8){ 
					$this->merchant_id=$result->current()->merchantid;
					$this->merchant_id1=$result->current()->user_id;
				} else {
					$this->merchant_id=$result->current()->user_id;
					$this->merchant_id1=$result->current()->user_id;
				}
		                        $this->session->set(array(
						                "user_id" => $this->merchant_id,
						                "user_id1" => $this->merchant_id1,
						                "name" => $result->current()->firstname ,
						                "user_email" => $result->current()->email,
						                "user_city" => $result->current()->city_id,
						                "user_type" =>  $result->current()->user_type,
								"facebook_status" =>$result->current()->facebook_update,
								"fb_access_token" =>$result->current()->fb_session_key,
								"fb_user_id" =>$result->current()->fb_user_id
				                        ));
				                        return 10;
	                        }
	                        return 9;
                        }
                        else{
	                        $emailCount = $this->db->count_records("users", array("email" => $email), "user_type","IN",array(3,8));
	                        if($emailCount == 0){
		                        return 8;
	                        }
	                        return 7;
                        }
		    }
		    return 0;
	}

        /** MERCHANT DETAILS **/

	public function user_details()
	{

                $result = $this->db->from("users")
                                ->where(array("user_id" => $this->user_id1))
                                ->join("city","city.city_id","users.city_id")
                                ->join("country","country.country_id","city.country_id")
                                ->get();
                return $result;
	}

	/** GET SINGLE MERCHANT DATA **/

	public function get_users_data()
	{

                $result = $this->db->from("users")->where(array("user_id" => $this->user_id1))->join("city","city.city_id","users.city_id")->limit(1)->get();
                return $result;
	}

	/** GET CITY LIST **/

	public function getCityList()
	{

		$result = $this->db->from("city")
			        ->join("country","country.country_id","city.country_id")
			        ->orderby("city.city_name", "ASC")
			        ->get();
		return $result;
	}

	/** UPDATE MERCHANT **/

        public function edit_merchant($id = "" ,$post = "")
	{
                $result = $this->db->update("users", array('firstname' => $post->firstname, 'lastname' => $post->lastname,'email' => $post->email,'phone_number' => $post->mobile, 'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'payment_account_id' => $post->payment), array('user_id' => $id));
                return $result;
        }

        /** UPDATE PASSWORD **/

        public function change_password($id = "", $pass = "")
	{
                $result = $this->db->update("users", array('password' => md5($pass->password)), array('user_id' => $id));
                return count($result);

        }
        
        /** UPDATE FLAT AMOUNT **/

        public function change_flat_amount($id = "", $post = "")
	{
		if(PRIVILEGES_SHIPPING_MODULE_EDIT!= 1){
			common::message(-1, "You cannot access this module");        
			url::redirect(PATH."merchant.html");	        
		}
                $result = $this->db->update("users", array('flat_amount' => $post->flat_shipping), array('user_id' => $id));
                
                                $free = "0";
                                if(isset($post->free)){
                                $free = $post->free;
                                }
                                $flat = "0";
                                if(isset($post->flat)){
                                $flat = $post->flat;
                                }
                                $product = "0";
                                if(isset($post->product)){
                                $product = $post->product;
                                }
                                $quantity = "0";
                                if(isset($post->quantity)){
                                $quantity = $post->quantity;
                                }
                                $aramex = "0";
                                if(isset($post->aramex)){
                                $aramex = $post->aramex;
                                }
                                $result_shipping = $this->db->update("shipping_module_settings", array("free" => $free,"flat" => $flat, "per_product" => $product,'per_quantity' => $quantity, 'aramex' => $aramex), array('ship_user_id' => $id));
                return count($result);

        }

        /** CHECK PASSWORD **/

        public function exist_password($pass = "", $id = "")
	{
                $result = $this->db->count_records('users', array('user_id' => $id, 'password' => md5($pass)));
		return (bool) $result;
        }

        /** ADD DEALS **/

	public function add_deals($post = "", $deal_key = "")
	{

		$savings=($post->price-$post->deal_value);
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal

		//$sub_cat = implode(',',$sub_cat1);
		$result = $this->db->insert("deals", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category, "deal_price" => $post->price,"deal_value" => $post->deal_value,"deal_savings" => $savings,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date), "expirydate" => strtotime($post->expiry_date),"created_date" => time(),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => ($savings/$post->price)*100,"minimum_deals_limit" =>  $post->minlimit,"maximum_deals_limit" => $post->maxlimit , "user_limit_quantity" =>  $post->quantity,"merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"created_date" => time(),"created_by"=>$this->user_id,"deal_status" => 1, "for_store_cred" => $post->store_cred));

		if(count($result) == 1){
			return $result->insert_id();
		}
		return 0;
	}

	/** GET DEALS CATEGORY LIST **/
	
	public function get_category_list_order($count = "")
	{
	        if($count == 1){
	        
	                $dispa = array("category_status" => 1,"main_category_id"=>0 , "deal" =>1);
	        } 
	        if($count == 2){
	                 $dispa = array("category_status" => 1,"main_category_id"=>0 , "product" =>1);
	        } 
	        if($count == 3){
	                $dispa = array("category_status" => 1,"main_category_id"=>0 , "auction" =>1);
	        } 

		$result = $this->db->from("category")
		->where($dispa)
		->orderby("category_name","ASC")->get();
		return $result;
	}

	public function get_gategory_list()
	{

		$result = $this->db->from("category")->where(array("category_status" => 1,"main_category_id"=>0))->orderby("category_name","ASC")->get();
		return $result;
	}

	/** GET ALL CATEGORY LIST **/
	public function all_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1))->orderby("category_name","ASC")->get();
		return $result;

	}
	/** GET MERCHANT BALANCE **/

	public function get_merchant_balance($store_id="")
	{
                $result =$this->db->from("users")->where(array("user_type" => 3, "user_id" => $this->user_id))->get();
                return $result;
	}

	/** GET SHOP LIST **/

	public function get_shop_list()
	{

                $result = $this->db->from("stores")
                            ->join("users","users.user_id","stores.merchant_id")
                            ->join("city","city.city_id","stores.city_id")
                            ->orderby("stores.store_name", "ASC")
                            ->where(array("stores.store_status" => '1',"merchant_id" => $this->user_id, "city_status" => '1'))
                            ->get();
                return $result;
        }

        /** GET COUNTRY BASED CITY LIST **/

	public function get_city_by_country($country)
	{

		$result = $this->db->from("city")->where(array("country_id" => $country, "city_status" => '1'))->orderby("city_name")->get();
		return $result;
	}

        /** MANAGE  DEALS **/

	public function get_all_deals_list($type = "", $offset = "", $record = "", $city = "", $name = "",$sort_type = "",$param = "",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}

		if($type == 1){
			$cont = "<";
		}
		else{
			$cont = ">";
		}
		 $conditions = "deals.enddate $cont ".time()." AND deals.merchant_id = ".$this->user_id;
                if($_GET){

                        if($city){
                                $conditions .= " and city.city_id = ".$city;
                        }
                        if($name){
                                $conditions .= " and (deals.deal_title like '%".mysql_real_escape_string($name)."%'";
                                $conditions .= " or stores.store_name like '%".mysql_real_escape_string($name)."%')";
                        }
                        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( deals.created_date between $startdate_str and $enddate_str )";	
                        }

			$sort_arr = array("name"=>" order by deals.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by deals.deal_price $sort","value"=>" order by deals.deal_value $sort","savings"=>" order by deals.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by deals.deal_id DESC'; }

					 $query = "select * , deals.created_date as createddate from deals join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id join country on country.country_id=stores.country_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id where $conditions $limit1 ";



                }
	        else{
				$query = "select * , deals.created_date as createddate from deals join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id join country on country.country_id=stores.country_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id where $conditions order by deals.deal_id DESC $limit1 ";
                }

                $result = $this->db->query($query);
                return $result;
        }

    	/** DEALS COUNT **/

	public function get_all_deals_count($type = "", $city = "", $name = "",$sort_type = "",$param = "",$today="", $startdate = "", $enddate = "")
	{
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}

	        if($type == 1){
			$cont = "<";
		}
		else{
			$cont = ">";
		}

		if($_GET){
                        $conditions = "deals.enddate $cont ".time()." AND deals.merchant_id = ".$this->user_id;

                        if($city){
                                $conditions .= " and city.city_id = ".$city;
                        }
                        if($name){
                                $conditions .= " and (deals.deal_title like '%".mysql_real_escape_string($name)."%'";
                                $conditions .= " or stores.store_name like '%".mysql_real_escape_string($name)."%')";
                        }
                        
                        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( deals.created_date between $startdate_str and $enddate_str )";	
                        }

			$sort_arr = array("name"=>" order by deals.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by deals.deal_price $sort","value"=>" order by deals.deal_value $sort","savings"=>" order by deals.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by deals.deal_id DESC'; }

                        $query = "select * from deals join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id where $conditions ";
                        $result = $this->db->query($query);
                }
		else{
			$result = $this->db->select("deal_id")->from("deals")
						->join("stores","stores.store_id","deals.shop_id")
						->join("city","city.city_id","stores.city_id")
						->where(array("enddate $cont" => time(), "deals.merchant_id" => $this->user_id))
						->get();
		}
		return count($result);
	}

	/** GET CITY LIST **/
   	public function get_city_lists()
	{

                $result = $this->db->from("city")

                            ->orderby("city.city_name", "ASC")
			    ->join("country","country.country_id","city.country_id")
                            ->where(array("city_status" => '1',"country.country_status"=>1))
                            ->get();
                return $result;
        }

        /** VIEW DEALS **/

	public function get_deals_data($deal_key = "", $deal_id = "")
	{

                $result = $this->db->select('*','deals.sub_category_id as sub_cat','deals.sec_category_id as sec_cat')->from("deals")
				->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"deals.merchant_id" => $this->user_id))
				->join("stores","stores.store_id","deals.shop_id")
				->join("city","city.city_id","stores.city_id")
				->join("country","country.country_id","stores.country_id")
				->join("users","users.user_id","deals.merchant_id")
				->join("category","category.category_id","deals.category_id")
				->get();
                return $result;
	}
	
	public function get_dealsmail_data($deal_key = "", $deal_id = "")
	{

                $result = $this->db->select('*','deals.sub_category_id as sub_cat','deals.sec_category_id as sec_cat')->from("deals")
				->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"deal_status" => 1,"deals.merchant_id" => $this->user_id))
				->join("stores","stores.store_id","deals.shop_id")
				->join("city","city.city_id","stores.city_id")
				->join("country","country.country_id","stores.country_id")
				->join("users","users.user_id","deals.merchant_id")
				->join("category","category.category_id","deals.category_id")
				->get();
                return $result;
	}

	/** EDIT DEALS DATA **/

	public function get_edit_deal($deal_id = "",$deal_key = "")
	{

	 $result = $this->db->from("deals")
                        ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))
             		->get();

           return $result;

	}

	/** UPDATE DEALS **/

	public function edit_deals($deal_id = "", $deal_key = "", $post = "",$adminid)
	{

		$dealdata = $this->db->select("deal_title","url_title")->from("deals")->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))->get();
		if(count($dealdata) == 1){
			$oldurlTitle = $dealdata->current()->url_title;
			if($oldurlTitle != url::title($post->title)){
				$result = $this->db->count_records("deals", array("url_title" => url::title($post->title)));
				if($result > 0){
					return 0;
				}
			}
			$savings=($post->price-$post->deal_value);
			$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal
		//$sub_cat = implode(',',$sub_cat1);
			$this->db->update("deals", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category, "deal_type"=> $post->deal_type, "deal_price" => $post->price,"deal_value" => $post->deal_value,"deal_savings" =>$savings,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date), "expirydate" => strtotime($post->expiry_date),"created_date" => time(),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => ($savings/$post->price)*100,"minimum_deals_limit" =>  $post->minlimit,"maximum_deals_limit" => $post->maxlimit , "user_limit_quantity" =>  $post->quantity,"merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"created_by"=>$this->user_id), array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id));

			return 1;
		}
		return 8;
	}

	/** BLOCK UNBLOCK DEALS **/

	public function blockunblockdeal($type = "", $key = "", $deal_id = "" )
	{

                $status = 0;
                if($type == 1){
                        $status = 1;
                }
                $result = $this->db->update("deals", array("deal_status" => $status), array("deal_id" => $deal_id, "deal_key" => $key, "merchant_id" => $this->user_id));
                return count($result);
	}

	/**  GET CLOSED COUPON COUNT   **/

	public function get_coupon_count($code = "" , $name = "")
	{
		$contitions = "transaction_mapping.coupon_code_status = 0 AND deals.merchant_id = $this->user_id";

		if($_GET){

		        if($name){
				        $contitions .= ' and (users.firstname like "%'.mysql_real_escape_string($name).'%"';
                        $contitions .= ' OR deals.deal_title like "%'.mysql_real_escape_string($name).'%")';
					}
                    if($code){
						$contitions .= ' and transaction_mapping.coupon_code like "%'.mysql_real_escape_string($code).'%"';
					}

                       $result = $this->db->query("SELECT * FROM transaction_mapping join deals on deals.deal_id = transaction_mapping.deal_id join users on users.user_id=transaction_mapping.user_id where $contitions");
		}
		else {
		$query = "SELECT * FROM transaction_mapping join deals on deals.deal_id = transaction_mapping.deal_id join users on users.user_id=transaction_mapping.user_id where $contitions ";
	$result = $this->db->query($query);
		}

	return count($result);
	}

	/** GET CLOSED COUPON LIST **/
	public function get_coupon_list($offset = "", $record = "",$code = "" , $name = "",$limit="")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$contitions = "transaction_mapping.coupon_code_status=0 AND deals.merchant_id = $this->user_id";
		if($_GET){
					if($name){
				        $contitions .= ' and (users.firstname like "%'.mysql_real_escape_string($name).'%"';
                        $contitions .= ' OR deals.deal_title like "%'.mysql_real_escape_string($name).'%")';
					}
                    if($code){
						$contitions .= ' and transaction_mapping.coupon_code like "%'.mysql_real_escape_string($code).'%"';
					}
                       $result = $this->db->query("SELECT * FROM transaction_mapping join deals on deals.deal_id = transaction_mapping.deal_id join users on users.user_id=transaction_mapping.user_id where $contitions $limit1 ");
		}
		else {
		$query = "SELECT * FROM transaction_mapping join deals on deals.deal_id = transaction_mapping.deal_id join users on users.user_id=transaction_mapping.user_id where $contitions $limit1 ";
	$result = $this->db->query($query);
		}

	return $result;
	}
        /** GET COUNTRY LIST **/

        public function getcountrylist()
	{

	        $result = $this->db->from("country")->where(array("country_status" => '1'))->orderby("country_name")->get();
	        return $result;
        }

	/** ADD MERCHANT SHOP ACCOUNT **/

	public function add_merchant_shop($post = "",$store_key = "",$password="")
	{
			$website="http://".$post->website;

		$sector = isset($post->sector)?$post->sector:0;
		$subsector = isset($post->subsector)?$post->subsector:0;
			
			$res = $this->db->insert("users",array("firstname"=>$post->username,"email"=>$post->email,"password"=>md5($password),"user_type"=>9,"created_by"=>$this->user_id,"referred_user_id"=>$this->user_id,"user_status"=>1,"login_type"=>1,"approve_status"=>1,"address1"=>$post->address1,"address2"=>$post->address2,"city_id"=>$post->city,"country_id"=>$post->country, 'phone_number' => $post->mobile,"user_sector_id"=>$subsector));
			
			$stores_result = $this->db->insert("stores", array("store_name" => $post->storename,"store_url_title" => url::title($post->storename),'store_key' =>$store_key,'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $post->country, 'phone_number' => $post->mobile, 'zipcode' => $post->zipcode, "meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,'website' => $website, 'latitude' => $post->latitude, 'longitude' => $post->longitude,'created_by'=>$this->user_id, 'store_type' => '2','merchant_id'=>$this->user_id,"created_date" => time(),"about_us"=>$post->about_us,"store_admin_id"=>$res->insert_id(),"store_sector_id"=>$sector,"store_subsector_id"=>$subsector));
			 $result = $this->db->insert("merchant_attribute", array("merchant_id" => $this->user_id,"storeid" =>$stores_result->insert_id()));
			$merchant_id = $stores_result->insert_id();
			return $merchant_id;
        }

        /** GET MERCHANT SHOP DATA  **/

        public function get_merchant_list_shop($offset = "", $record = "",  $name = "", $city = "",$limit="")
	{
			$limit1 = $limit !=1 ?"limit $offset,$record":"";

                $contitions = "merchant_id = ".$this->user_id;
                if($_GET){
                        if($city){

				$contitions .= ' and stores.city_id = '.$city;
                        }

                        if($name){
			        $contitions .= ' and store_name like "%'.mysql_real_escape_string($name).'%"';
                        }
                         $result = $this->db->query("select * from stores join country on country.country_id = stores.country_id join city on city.city_id = stores.city_id where $contitions ORDER BY stores.store_id $limit1");

                }
                else{
                        $result = $this->db->query("select * from stores join country on country.country_id = stores.country_id join city on city.city_id = stores.city_id where $contitions ORDER BY stores.store_id $limit1");
                }
                return $result;
        }

        /** GET MERCHANT SHOP COUNT DATA  **/

        public function get_merchant_shop_count($name = "", $city = "")
 	{

                $contitions = "merchant_id = ".$this->user_id;
                if($_GET){
                        if($city){

				$contitions .= ' and stores.city_id = '.$city;
                        }

                        if($name){
			        $contitions .= ' and store_name like "%'.mysql_real_escape_string($name).'%"';
                        }
                         $result = $this->db->query("select * from stores join country on country.country_id = stores.country_id join city on city.city_id = stores.city_id where $contitions ");

                }
                else{
                        $result = $this->db->query("select * from stores join country on country.country_id = stores.country_id join city on city.city_id = stores.city_id where $contitions ");
                }
                return count($result);
        }

        /** UPDATE MERCHANT SHOP **/

        public function edit_merchant_shop($id = "", $post = "")
	{

			$sector = isset($post->sector)?$post->sector:0;
			$subsector = isset($post->subsector)?$post->subsector:0;

			$this->db->update("users",array("firstname"=>$post->username,"email"=>$post->email,"address1"=>$post->address1,"address2"=>$post->address2,"city_id"=>$post->city,"country_id"=>$post->country, 'phone_number' => $post->mobile,"user_sector_id"=>$subsector),array("user_id" => $post->store_admin_id));
			$merchant_result = $this->db->update("stores", array("store_name" => $post->storename,"store_url_title" => url::title($post->storename),'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $post->country, 'phone_number' => $post->mobile, 'zipcode' => $post->zipcode, "meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,'website' => $post->website, 'latitude' => $post->latitude, 'longitude' => $post->longitude,"about_us"=>$post->about_us,"store_sector_id"=>$sector,"store_subsector_id"=>$subsector), array('store_id' => $id,"merchant_id" => $this->user_id));
			
			//$merchant_id = $stores_result->insert_id();
                return $id;
        }
	
        /** GET SINGLE MERCHANT SHOP DATA **/

	public function get_merchant_shop_data($storeid = "")
	{
		$result = $this->db->from("stores")->join("city","city.city_id","stores.city_id")->join("users","users.user_id","stores.store_admin_id","left")->where(array("store_id" => $storeid, "merchant_id" => $this->user_id))->limit(1)->get();
		return $result;
	}

	/** BLOCK & UNBLOCK MERCHANT SHOP **/

        public function blockunblockmerchantshop($type = "", $storesid = "")
	{
                $status = 0;
                if($type == 1){
                    $status = 1;
                }
                $get_data = $this->db->from("stores")->join("users","stores.merchant_id","users.user_id")->where(array("store_id" => $storesid,"user_id" => $this->user_id))->get();
                foreach($get_data as $c){
			if($c->user_status == 1){
				$result = $this->db->update("stores", array("store_status" => $status), array("store_id" => $storesid));
				$result = $this->db->update("users", array("user_status" => $status), array("user_id" => $c->store_admin_id));
				 return count($result);
			}
			else{
				return -1;
			}
		}
        }

        /** FUND REQUEST **/

        public function add_fund_request($amount = "",$useramount = "")
	{

                $stores_result = $this->db->insert("request_fund", array("type" => "1", 'user_id' => $this->user_id, 'amount' => $amount, 'date_time' => time()));

                if(count($stores_result) == 1){

                        $result = $this->db->update("users", array("merchant_account_balance" => $useramount), array("user_id" => $this->user_id));
                }
               return $stores_result;
        }

        /** MANAGE FUND REQUEST **/

        public function get_all_fund_request($offset = "", $record = "")
	{

        $result = $this->db->from("request_fund")
                                    ->where(array("user_id" => $this->user_id))
                                    ->orderby("request_id", "DESC")
                                    ->limit($record, $offset)
                                    ->get();
        return $result;
        }

        /** MANAGE FUND REQUEST COUNT**/

        public function get_fund_request()
	{

        $result = $this->db->select("request_id")->from("request_fund")
                                    ->where(array("user_id" => $this->user_id))
                                    ->orderby("request_id", "DESC")
                                    ->get();
         return count($result);
        }

        /** DELETE FUND REQUEST **/

        public function deletefund($request_id = "", $useramount= "")
	{

		$result = $this->db->delete('request_fund', array('request_id' => $request_id,"request_status"=>1,"user_id" => $this->user_id));
		if(count($result) == 1){

		        $result_user = $this->db->update("users", array("merchant_account_balance" => $useramount), array("user_id" => $this->user_id));
		}
		return count($result);
	}

	/** GET FUND REQUEST **/

	public function get_fund_request_data($request_id = "")
	{
		$result = $this->db->from("request_fund")->where(array('request_id' => $request_id, 'request_status' => 1, "user_id" => $this->user_id))->limit(1)->get();
		return $result;

	}

	/** UPDATE FUND REQUEST **/

        public function edit_fund_request($request_id = "",$amount = "", $useramount = "")
	{

                $stores_result = $this->db->update("request_fund", array("amount" => $amount, 'date_time' => time()), array("user_id" => $this->user_id, 'request_id' => $request_id, 'request_status' => 1));

                if(count($stores_result) == 1){

                        $result = $this->db->update("users", array("merchant_account_balance" => $useramount), array("user_id" => $this->user_id));
                 }

               return $stores_result;
        }

        /** VIEW DEALS FOR TRANSACTION**/

	public function get_transaction_data($deal_id = "")
	{
                $result = $this->db->from("deals")
                                ->where(array("transaction.deal_id" => $deal_id,"deals.merchant_id" =>$this->user_id))
	                        ->join("transaction","transaction.deal_id","deals.deal_id")
	                        ->orderby("transaction.id","DESC")
                                ->get();
                return $result;
	}

	 /** VIEW PRODUCT FOR TRANSACTION**/

	public function get_product_transaction_data($deal_id = "")
	{
                $result = $this->db->select("*","transaction.shipping_amount as shippingamount")->from("product")
                                ->where(array("transaction.product_id" => $deal_id,"transaction.type !=" =>5,"product.merchant_id" =>$this->user_id))
	                        	->join("transaction","transaction.product_id","product.deal_id")
	                        	->orderby("transaction.id","DESC")
                                ->get();
                return $result;
	}

	 /** VIEW PRODUCT FOR TRANSACTION**/

	public function get_cod_transaction_data($deal_id = "")
	{
                $result = $this->db->select("*","transaction.shipping_amount as shippingamount")->from("product")
                                ->where(array("transaction.product_id" => $deal_id,"transaction.type" =>5,"product.merchant_id" =>$this->user_id))
	                        	->join("transaction","transaction.product_id","product.deal_id")
	                        	->orderby("transaction.id","DESC")
                                ->get();
                return $result;
	}

	/** VIEW AUCTION FOR TRANSACTION**/

	public function get_auction_transaction_data($deal_id = "")
	{
                $result = $this->db->from("auction")
                                ->where(array("transaction.auction_id" => $deal_id,"auction.merchant_id" =>$this->user_id))
	                        	->join("transaction","transaction.auction_id","auction.deal_id")
	                        	->orderby("transaction.id","DESC")
                                ->get();
                return $result;
	}
        /** ADD PRODUCTS **/

	public function add_products($post = "", $deal_key = "",$size_quantity = "")
	{
	    $quantity = "";
	    foreach($size_quantity as $sq){
	    $quantity += $sq;
	    }
	    $inc_tax = "0";
			 if(isset($_POST['Including_tax'])) {
			        $inc_tax = "1";
			 }
		$savings=(($post->price)-($post->deal_value));
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal
	//	$sub_cat = implode(',',$sub_cat1);

                $shipping_amount = "0";
		 if(isset($_POST['shipping_amount'])) {
		        $shipping_amount = $_POST['shipping_amount'];
		 }
		 
		        $weight = "0";
			 if(isset($_POST['weight'])) {
			        $weight = $_POST['weight'];
			 }
			 $height = "0";
			 if(isset($_POST['height'])) {
			        $height = $_POST['height'];
			 }
			 $length = "0";
			 if(isset($_POST['length'])) {
			        $length = $_POST['length'];
			 }
			 $width = "0";
			 if(isset($_POST['width'])) {
			        $width = $_POST['width'];
			 }
			 $duration = "";
			 if(isset($_POST['duration'])) {
			        $duration = serialize($_POST['duration']);
			 }
			 
			 if($post->price!='') // if discount price is not empty orignal price value is inserted to deal_price field and discount price is inserted to deal value 
			{
				$deal_price = $post->deal_value;
				$deal_val = $post->price;
				$savings=($post->deal_value - $post->price);
				$value=($savings/$post->deal_value)*100;
			}else{ // if discount price is given empty orignal price value is inserted to deal_value field 
				$deal_val = $post->deal_value;
				$savings=0;
				$deal_price=0;
				$value=0;
			}
	        $atr_option = isset($post->attr_option)?$post->attr_option:0;  // for attribute is present or not
			$pro_status = 1;
			if(isset($_POST['status']))
				$pro_status = $_POST['status'];
				
		$result = $this->db->insert("product", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description,"delivery_period" => $post->delivery_days,"category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category,"deal_price" => $deal_price,"deal_value" => $deal_val,"deal_type"=> 2,"deal_savings" => $savings,"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => $value,"merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"shipping"=>$post->shipping,"created_by"=>$this->user_id,"color" => $post->color_val,"size" => $post->size_val,"weight" => $weight,"height" => $height,"length" => $length,"width" => $width,"shipping_amount" => $shipping_amount,"user_limit_quantity"=>$quantity,"deal_status" =>$pro_status,"attribute"=>$atr_option,"Including_tax" =>$inc_tax,"product_duration"=>$duration,"created_date" => time(), "bulk_discount_buy" => $post->buy_bulk,"bulk_discount_get"=>$post->get_bulk,"product_offer" =>$post->offer,"start_date"=>strtotime($post->start_date),"end_date" =>strtotime($post->end_date),"gift_offer" =>$post->free_gift, "for_store_cred" => $post->store_cred));

                $product_id = $result->insert_id();
                if(($post->color_val) == 1){
                    foreach($post->color as $c){
                        $result_count = $this->db->from("color")->where(array("deal_id" => $product_id, "color_name" => $c))->get();
                        if(count($result_count)==0){
                                $result_id = $this->db->from("color_code")->where(array("color_code" => $c))->get();
                                $result_color = $this->db->insert("color", array("deal_id" => $product_id, "color_name" => $c, "color_code_id" => $result_id->current()->id,"color_code_name" => $result_id->current()->color_name));
                        }
                    }
                }
                
	    if(($post->size_val) == 1){
	        $i= 0;
            if(isset($post->size)){
	        foreach($post->size as $s){
	            $result_count = $this->db->from("product_size")->where(array("deal_id" => $product_id, "size_id" => $s))->get();
	            if(count($result_count)==0){
	            $result_id = $this->db->from("size")->where(array("size_id" => $s))->get();
	            		$size_tot = count((array)$post->size);
						//To avoid None size if other sizes selected
					if($size_tot == 1 && ($s!=1 || $s==1)){
						$result_color = $this->db->insert("product_size", array("deal_id" => $product_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
					}elseif($size_tot > 1 && $s!=1){
							$result_color = $this->db->insert("product_size", array("deal_id" => $product_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
					}
	            $i++; }
	        }
                
            }
	        }

                //Attribute start
                if(($post->attr_option) == 1){
                        $attr_result = $this->db->delete('product_attribute', array('product_id' => $product_id));
                        $attr = array_unique($_POST['attribute']);
                        //print_r($attr);exit;
                        foreach($attr as $k=>$s){
                        $result_attribute = $this->db->insert("product_attribute", array("product_id" => $product_id, "attribute_id" => $s,"text"=>$_POST['attribute_value'][$k]));
                        }
                }

	//Attribute end

	$policy = array_unique($_POST['Delivery_value']);
        if(count($policy)>0){
        $Deli_result = $this->db->delete('product_policy', array('product_id' => $product_id));
        foreach($policy as $p=>$s){
	                $result_Delivery = $this->db->insert("product_policy", array("product_id" => $product_id,"text"=>$_POST['Delivery_value'][$p]));
		}
	}

	if(count($result) == 1){
		return $result->insert_id();
	}
	return 0;
	}

	/** PRODUCTS COUNT **/

	public function get_all_products_count($type = "", $city = "", $name = "",$sort_type = "",$param = "",$today="", $startdate = "", $enddate = "",$product_duration="")
	{
			$sort = "ASC";
				if($sort_type == "DESC" ){
					$sort = "DESC";


				}
		if($_GET){

			if($type != "1")
		        {
		                $conditions = "purchase_count < user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1 and deal_status!=2 ";
		        }else {
		                $conditions = "purchase_count = user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1 and deal_status!=2 ";
		        }
			if($city){
				$conditions .= " and city.city_id = ".$city;
			}

			if($name){
				$conditions .= " and deal_title like '%".mysql_real_escape_string($name)."%'";
			}
			if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( product.created_date between $startdate_str and $enddate_str )";	
                        }
            if($product_duration ==2){
				$conditions .= ' and product.product_duration =""';
			} else if($product_duration ==3){
				$conditions .= ' and product.product_duration !="" ';
			} 

			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; }
			$query = "select ('deal_id') from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id join country on country.country_id=stores.country_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions";
			$result = $this->db->query($query);
		}
		else{

			if($type != "1")
		        {
		                $conditions = "purchase_count < user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1 and deal_status!=2 ";
		        }else {
		                $conditions = "purchase_count = user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1 and deal_status!=2 ";
		        }

			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; }

			$query = "select * from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions";
			$result = $this->db->query($query);
		}
		return count($result);
	}

	/** MANAGE  PRODUCTS **/

	public function get_all_product_list($type, $offset = "", $record = "", $city = "", $name = "",$sort_type = "",$param = "",$limit="",$today="", $startdate = "", $enddate = "",$product_duration="")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
                if($_GET){
		         if($type != "1")
		        {
		                $conditions = "purchase_count < user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1 and deal_status!=2 ";
		        }else {
		                $conditions = "purchase_count = user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1 and deal_status!=2 ";
		        }

			if($city){
			        $conditions .= " and city.city_id = ".$city;
			}
			if($name){
			        $conditions .= " and (deal_title like '%".mysql_real_escape_string($name)."%'";
			        $conditions .= " or store_name like '%".mysql_real_escape_string($name)."%')";
			}
			if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( product.created_date between $startdate_str and $enddate_str )";	
                        }
			if($product_duration ==2){
				$conditions .= ' and product.product_duration =""';
			} else if($product_duration ==3){
				$conditions .= ' and product.product_duration !="" ';
			} 
			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; }

			$query = "select * , product.created_date as createddate from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions  $limit1 ";
			$result = $this->db->query($query);
		}
	        else{
	                 if($type != "1")
		        {
		                $conditions = "purchase_count < user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1 and deal_status!=2 ";
		        }else {
		                $conditions = "purchase_count = user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1 and deal_status!=2 ";
		        }

			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; }

			$query = "select * , product.created_date as createddate from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions $limit1 ";
			$result = $this->db->query($query);
                }
            return $result;
        }
	/** UPDATE PRODUCTS **/

	public function edit_product($deal_id = "", $deal_key = "", $post = "",$size_quantity = "",$preview_type="")
	{

		 $quantity = 0;

	     for($i=0;$i<count($size_quantity); $i++){
			if($size_quantity[$i]!=0){
				$quantity +=$size_quantity[$i];
			}

		 }
		
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal
		// $sub_cat = implode(',',$sub_cat1);

		$dealdata = $this->db->select("deal_title","url_title","user_limit_quantity","purchase_count")->from("product")->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))->get();

		$total_quantity = $quantity;

		if( $dealdata->current()->purchase_count >= $dealdata->current()->user_limit_quantity)
		{
			$total_quantity = $dealdata->current()->user_limit_quantity+$quantity;
		}
		else if( $dealdata->current()->purchase_count < $dealdata->current()->user_limit_quantity && ($dealdata->current()->purchase_count !=0 ) && ($quantity ==0 ) ){
			$total_quantity = $dealdata->current()->purchase_count;
		}
		else if( $dealdata->current()->purchase_count < $dealdata->current()->user_limit_quantity && ($dealdata->current()->purchase_count !=0 ) && ($quantity !=0 ) ){
			$total_quantity = $dealdata->current()->purchase_count+$quantity;
		}

		if(count($dealdata) == 1){
			$oldurlTitle = $dealdata->current()->url_title;
			if($oldurlTitle != url::title($post->title)){
				$result = $this->db->count_records("product", array("url_title" => url::title($post->title)));
				if($result > 0){
					return 0;
				}
			}
			 $inc_tax = "0";
			 if(isset($_POST['Including_tax'])) {
			        $inc_tax = "1";
			 }
			$result = $this->db->delete('color', array('deal_id' => $deal_id));
			$result = $this->db->delete('product_size', array('deal_id' => $deal_id));
			$savings=($post->price-$post->deal_value);
			$atr_option = isset($post->attr_option)?$post->attr_option:0; // for attribute

                         $shipping_amount = "0";
		         if(isset($_POST['shipping_amount'])) {
		                $shipping_amount = $_POST['shipping_amount'];
		         }
		         
		         $weight = "0";
			 if(isset($_POST['weight'])) {
			        $weight = $_POST['weight'];
			 }
			 $height = "0";
			 if(isset($_POST['height'])) {
			        $height = $_POST['height'];
			 }
			 $length = "0";
			 if(isset($_POST['length'])) {
			        $length = $_POST['length'];
			 }
			 $width = "0";
			 if(isset($_POST['width'])) {
			        $width = $_POST['width'];
			 }
			 $duration = "";
			 if(isset($_POST['duration'])) {
			        $duration = serialize($_POST['duration']);
			 }
			 if($post->price!='') // if discount price is not empty orignal price value is inserted to deal_price field and discount price is inserted to deal value 
			{
				$deal_price = $post->deal_value;
				$deal_val = $post->price;
				$savings=($post->deal_value - $post->price);
				$value=($savings/$post->deal_value)*100;
			} else { // if discount price is given empty orignal price value is inserted to deal_value field 
				$deal_val = $post->deal_value;
				$savings=0;
				$deal_price=0;
				$value=0;
			}
			 
			$this->db->update("product", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description,"delivery_period"=> $post->delivery_days, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category, "third_category_id" => $post->third_category,"deal_price" => $deal_price,"deal_value" => $deal_val,"deal_savings" =>$savings,"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => $value, "merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"created_by"=>$this->user_id,"color" => $post->color_val,"size" => $post->size_val,"shipping_amount" => $shipping_amount,"user_limit_quantity"=>$quantity,"shipping"=>$post->shipping,"attribute"=>$atr_option,"Including_tax" =>$inc_tax, "weight" => $weight,"height" => $height,"length" => $length,"width" => $width,"product_duration" =>$duration, "bulk_discount_buy" => $post->buy_bulk,"bulk_discount_get"=>$post->get_bulk,"product_offer" =>$post->offer,"start_date"=>strtotime($post->start_date),"end_date" =>strtotime($post->end_date),"gift_offer" =>$post->free_gift), array("deal_id" => $deal_id, "deal_key" => $deal_key));

			if($preview_type=="preview")
				$this->db->update("product",array("deal_status"=>2),array("deal_id" => $deal_id, "deal_key" => $deal_key));
				
			if(isset($_POST['status']) && $_POST['status']==1)
				$this->db->update("product",array("deal_status"=>1),array("deal_id" => $deal_id, "deal_key" => $deal_key,"deal_status"=>2));
				
			 if(($post->color_val) == 1){
				foreach($post->color as $c){
					 $result_id = $this->db->from("color_code")->where(array("color_code" => $c))->get();
			        $result_color = $this->db->insert("color", array("deal_id" => $deal_id, "color_name" => $c, "color_code_id" => $result_id->current()->id,"color_code_name" => $result_id->current()->color_name));
			    }
	        }

	        if(($post->size_val) == 1){
				$i= 0;
				foreach($post->size as $s){
					$result_count = $this->db->from("product_size")->where(array("deal_id" => $deal_id, "size_id" => $s))->get();
					if(count($result_count)==0){
					$result_id = $this->db->from("size")->where(array("size_id" => $s))->get();
							$size_tot = count((array)$post->size);
							//To avoid None size if other sizes selected
						if($size_tot == 1 && ($s!=1 || $s==1)){
							$result_color = $this->db->insert("product_size", array("deal_id" => $deal_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
						}elseif($size_tot > 1 && $s!=1){
								$result_color = $this->db->insert("product_size", array("deal_id" => $deal_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
						}
					$i++; }
				}
			}

				//Attribute start
		$attr_result = $this->db->delete('product_attribute', array('product_id' => $deal_id));
		if(($post->attr_option) == 1){

		$attr = array_unique($_POST['attribute']);
		//print_r($attr);exit;
	        foreach($attr as $k=>$s){
		$result_attribute = $this->db->insert("product_attribute", array("product_id" => $deal_id, "attribute_id" => $s,"text"=>$_POST['attribute_value'][$k]));

				}

	        }

		//Attribute end

		$policy = array_unique($_POST['Delivery_value']);
	        if(count($policy)>0){
	        $Deli_result = $this->db->delete('product_policy', array('product_id' => $deal_id));
	        foreach($policy as $p=>$s){
		                $result_Delivery = $this->db->insert("product_policy", array("product_id" => $deal_id,"text"=>$_POST['Delivery_value'][$p]));
				}
		}


		        return 1;
		}
		return 8;
	}
 	/** EDIT PRODUCTS DATA **/

	public function get_edit_product($deal_id = "",$deal_key = "")
	{
	   $result = $this->db->from("product")
	                        ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))
	             		->get();
           return $result;
	}

	 /** VIEW PRODUCTSS **/

	public function get_products_data($deal_key = "", $deal_id = "")
	{

                 $result = $this->db->select('*','product.sub_category_id as sub_cat','product.sec_category_id as sec_cat')->from("product")
                                ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"product.merchant_id" => $this->user_id))
	                        ->join("stores","stores.store_id","product.shop_id")
                                ->join("city","city.city_id","stores.city_id")
                                ->join("country","country.country_id","stores.country_id")
		                ->join("users","users.user_id","product.merchant_id")
		                ->join("category","category.category_id","product.category_id")
	                        ->get();
                return $result;
	}
	
	public function get_productsmail_data($deal_key = "", $deal_id = "")
	{

                 $result = $this->db->select('*','product.sub_category_id as sub_cat','product.sec_category_id as sec_cat')->from("product")
                                ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"deal_status" => 1,"product.merchant_id" => $this->user_id))
	                        ->join("stores","stores.store_id","product.shop_id")
                                ->join("city","city.city_id","stores.city_id")
                                ->join("country","country.country_id","stores.country_id")
		                ->join("users","users.user_id","product.merchant_id")
		                ->join("category","category.category_id","product.category_id")
	                        ->get();
                return $result;
	}
	/** BLOCK UNBLOCK PRODUCTS **/

	public function blockunblockproducts($type = "", $key = "", $deal_id = "" )
	{
                $status = 0;
                if($type == 1){
                        $status = 1;
                }
                $result = $this->db->update("product", array("deal_status" => $status), array("deal_id" => $deal_id, "deal_key" => $key,"merchant_id" => $this->user_id));
                return count($result);
	}

	/** GET SHIPPING DATA  **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping    **/

        public function get_shipping_list($offset = "", $record = "",  $name= "",$type = "",$limit="")
        {
			$limit1 = $limit !=1 ?"limit $offset,$record":"";

				$condition = "AND t.type != 5";

				if($type){
					$condition = " AND t.type = 5 ";

				}
        		if($_GET){
	        		$contitions = ' (u.firstname like "%'.mysql_real_escape_string($name).'%"';
                    $contitions .= 'OR u.email like "%'.mysql_real_escape_string($name).'%"';
            		$contitions .= 'OR tm.coupon_code like "%'.mysql_real_escape_string($name).'%")';

					$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping,stores.city_id as str_city_id from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where $contitions and shipping_type = 1 AND d.merchant_id = $this->user_id $condition group by shipping_id order by shipping_id DESC $limit1 ");

				}
				else {

					$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping,stores.city_id as str_city_id from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where shipping_type = 1 AND d.merchant_id = $this->user_id $condition group by shipping_id order by shipping_id DESC $limit1 ");
				}
                return $result;
        }


		 /** GET CONTACTS DATA  **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping     **/

        public function get_shipping_count($name = "",$type = "")
        {
				$condition = "AND t.type != 5";

				if($type){
					$condition = " AND t.type = 5 ";

				}
           		if($_GET){
			        $contitions = ' (u.firstname like "%'.mysql_real_escape_string($name).'%"';
                    $contitions .= ' OR u.email like "%'.mysql_real_escape_string($name).'%"';
					$contitions .= 'OR tm.coupon_code like "%'.mysql_real_escape_string($name).'%")';

                  $result = $this->db->query("select s.shipping_id  from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where $contitions and shipping_type = 1 AND d.merchant_id = $this->user_id $condition group by shipping_id order by shipping_id DESC ");
		}
		else {
			 $result = $this->db->query("select s.shipping_id  from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where shipping_type = 1 AND d.merchant_id = $this->user_id $condition group by shipping_id order by shipping_id DESC ");
		}
                return count($result);
        }

	/* UPDATE SHIPPING STATUS */
	public function update_shipping_status($id = "",$type="")
	{

		$result = $this->db->update('shipping_info',array('delivery_status' => $type),array('shipping_id' => $id));

		return count($result);
	}

	/* VALIDATE COUPON */
	public function validate_coupon($coupon = "",$product_amount = "",$trans_id = "")
	{
		$result =  $this->db->count_records("transaction_mapping", array("coupon_code" => $coupon,"transaction_id" => $trans_id,"coupon_code_status" =>1));
			if($result > 0){
				//$this->db->query("update users set merchant_account_balance = merchant_account_balance + $product_amount where user_type = 1");
				$this->db->update('transaction',array('captured' => 1,'captured_date' =>time(),'payment_status' => 'Success','pending_reason' =>'None'),array('id' => $trans_id));

				$this->db->update('transaction_mapping',array('coupon_code_status' => 0),array("transaction_id" => $trans_id));

				return 1;
			}

			else return 0;
	}
	/** GET COUNT FOR TRANSACTION  **/

	public function count_transaction_list($type = "", $search_key = "",$sort_type = "",$param = "",$trans_type="",$today="", $startdate = "", $enddate = "")
	{
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
			$conditions = "";
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions .= "transaction.id > 0";
		          }else {
		                $conditions .= "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		          if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}

			$result = $this->db->query('select * from transaction join users on users.user_id=transaction.user_id join auction on auction.deal_id=transaction.auction_id where '.$conditions.' and auction.merchant_id ='.$this->user_id.' and users.firstname like "%'.$search_key.'%" OR transaction.transaction_id like "%'.$search_key.'%" OR auction.deal_title like "%'.$search_key.'%"');

		}
		else{

			if(($type=="")||($type=="mail")) {

					$conditions = "transaction.id >= 0 and auction.merchant_id = '$this->user_id'";

				if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}


		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");
		       }
		      else {

					$conditions = " payment_status = '$type' and auction.merchant_id = '$this->user_id'";

				  if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}

		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort_type","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");


		             }

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->select("*")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("auction","auction.deal_id","transaction.auction_id")
						->where($conditions)
						->get();
		}
		return count($result);
	}

	/** GET COUNT FOR DEAL TRANSACTION  **/

	public function count_transaction_deal_list($type = "", $search_key = "",$sort_type = "",$param = "",$trans_type = "",$today="", $startdate = "", $enddate = "")
	{
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
			
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0 ";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		          if($trans_type){
				$conditions .= " AND transaction.type = 5 ";
			}
			else{
				$conditions .= " AND transaction.type != 5 ";
			}

			if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
                        
                        $conditions .= " and deals.merchant_id = $this->user_id ";
				
			$result = $this->db->query('select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join deals on deals.deal_id=transaction.deal_id where '.$conditions.' and (users.firstname like "%'.$search_key.'%" OR transaction.transaction_id like "%'.$search_key.'%" OR deals.deal_title like "%'.$search_key.'%")');
				

		}
		else{

			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");

			$conditions = "transaction.id >= 0 and deals.merchant_id = '$this->user_id'";
			if($trans_type){
				$conditions .= " AND transaction.type = 5 ";
			}
			else{
				$conditions .= " AND transaction.type != 5 ";
			}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");
			$conditions = " payment_status = '$type' and deals.merchant_id = '$this->user_id'";

		             }

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->select("transaction.id")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("deals","deals.deal_id","transaction.deal_id")
						->where($conditions)
						->get();
		}
		return count($result);
	}

	/** GET TRANSACTION LIST **/

	public function get_transaction_deal_list($type = "", $search_key = "",$offset = "", $record = "",$sort_type = "",$param = "",$trans_type="",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		          if($trans_type){
				$conditions .= " AND transaction.type = 5 ";
			}
			else{
				$conditions .= " AND transaction.type != 5 ";
			}
		        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
			
			$conditions .= " and deals.merchant_id = $this->user_id ";
			
			 $result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join deals on deals.deal_id=transaction.deal_id where $conditions and (users.firstname like '%".$search_key."%' OR transaction.transaction_id like '%".$search_key."%' OR deals.deal_title like '%".$search_key."%') order by transaction.id DESC  $limit1 "); 
		}
		else{
			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");

			$conditions = "transaction.id >= 0 and deals.merchant_id = '$this->user_id'";
			if($trans_type){
				$conditions .= " AND transaction.type = 5 ";
			}
			else{
				$conditions .= " AND transaction.type != 5 ";
			}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");
			$conditions = " payment_status = '$type' and deals.merchant_id = '$this->user_id'";

		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join deals on deals.deal_id=transaction.deal_id where $conditions $limit1 ");
		}
		return $result;
	}
		/** GET COUNT FOR PRODUCT TRANSACTION  **/

	public function count_transaction_product_list($type = "", $search_key = "",$sort_type = "",$param = "",$trans_type = "",$today="", $startdate = "", $enddate = "")
	{
					$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		        if($trans_type){
					
							$conditions .= " AND transaction.type = 5";
							
							
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
			$result = $this->db->query("select transaction.id from transaction join users on users.user_id=transaction.user_id join product on product.deal_id=transaction.product_id where $conditions and product.merchant_id = $this->user_id  and ( users.firstname like '%".$search_key."%' OR transaction.transaction_id like '%".$search_key."%' OR product.deal_title like '%".$search_key."%' )");
		}
		else{
				$conditions = "transaction.id >= 0 and product.merchant_id = '$this->user_id' ";
				if($trans_type){
						
							$conditions .= " AND transaction.type = 5";
							
						
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		       }
		      else {
				$conditions = " payment_status = '$type' and product.merchant_id = '$this->user_id'";
				if($trans_type){
				
							$conditions .= " AND transaction.type = 5";
							
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		             }

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->select("transaction.id")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("product","product.deal_id","transaction.product_id")
						->where($conditions)
						->get();
		}
		return count($result);
	}

	/** GET TRANSACTION LIST **/

	public function get_transaction_list($type = "", $search_key = "", $offset = "", $record = "",$sort_type = "",$param = "",$trans_type="",$today="", $startdate = "", $enddate = "")
	{
		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		          if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}

			$result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join auction on auction.deal_id=transaction.auction_id where $conditions and auction.merchant_id = $this->user_id and ( users.firstname like '%".$search_key."%' OR transaction.transaction_id like '%".$search_key."%' OR auction.deal_title like '%".$search_key."%' ) limit $offset,$record");
		}
		else{

			if(($type=="")||($type=="mail")) {
				$conditions = "transaction.id >= 0 and auction.merchant_id = '$this->user_id'";
				if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}

		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");



		       }
		      else {
				  $conditions = " payment_status = '$type' and auction.merchant_id = '$this->user_id'";

				  if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}


		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");


		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->select("*")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("auction","auction.deal_id","transaction.auction_id")
						->where($conditions)
						->limit($record, $offset)
						->get();
		}
		return $result;
	}
		/** GET PRODUCT TRANSACTION LIST **/

	public function get_transaction_product_list($type = "", $search_key = "", $offset = "", $record = "",$type1 = "",$sort_type = "",$param = "",$trans_type = "",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";
		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		        if($trans_type){
						
							$conditions .= " AND transaction.type = 5";
						
						
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
			$result = $this->db->query("select *,users.firstname as firstname, transaction.shipping_amount as shippingamount from transaction join users on users.user_id=transaction.user_id join product on product.deal_id=transaction.product_id where $conditions and product.merchant_id = $this->user_id  and ( users.firstname like '%".$search_key."%' OR transaction.transaction_id like '%".$search_key."%' OR product.deal_title like '%".$search_key."%' ) $limit1 ");
		}
		else{
				$conditions = "transaction.id >= 0 and product.merchant_id = '$this->user_id' ";
				if($trans_type){
						
							$conditions .= " AND transaction.type = 5";
						
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		       }
		      else {
				$conditions = " payment_status = '$type' and product.merchant_id = '$this->user_id'";
				if($trans_type){
						
							$conditions .= " AND transaction.type = 5";
						
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->select("*","transaction.shipping_amount as shippingamount")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("product","product.deal_id","transaction.product_id")
						->where($conditions)
						->limit($record, $offset)
						->get();
		}
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
                        $query = "select deals.*,transaction_mapping.coupon_code,transaction_mapping.coupon_code_status,transaction.type,transaction.id as trans_id,transaction.amount,transaction.referral_amount,transaction.quantity,transaction.file_name from deals join transaction on transaction.deal_id=deals.deal_id  join transaction_mapping on transaction_mapping.transaction_id=transaction.id and transaction_mapping.deal_id=transaction.deal_id where $conditions and deals.expirydate > $time and merchant_id = '$this->user_id' limit 1 ";
                        $result = $this->db->query($query);

			return $result;

	}
	/* GET SHIPPING PRODUCT COLOR */
	public function get_shipping_product_color()
	{
		$result = $this->db->from("color_code")->orderby("color_name","asc")->get();
		return $result;
	}
	/*GET SHIPPING PRODUCT SIZE */
	public function get_shipping_product_size()
	{
		$result = $this->db->from("size")->get();
		return $result;
	}
	/** UPDATE COUPON STATUS **/

	public function close_coupon_status($type = "",$coupon_code="",$deal_id = "",$trans_id=0,$act=0)
	{
	       //$count = $this->db->count_records("transaction_mapping", array("coupon_code_status" => $type), array("coupon_code" => $coupon_code,"deal_id" => $deal_id));

			//if($count==0){

             $transaction_details = $this->db->select("referral_amount","amount","deal_merchant_commission","quantity")->from("transaction")->where(array("deal_id" => $deal_id,"id" =>$trans_id))->get();
             $transaction_referral_amount=$transaction_details->current()->referral_amount;
             $merchant_commission = $transaction_details->current()->deal_merchant_commission;
             $transaction_amount=$transaction_details->current()->amount;
             $transaction_quantity=$transaction_details->current()->quantity;
             $transaction_total_amount = ($transaction_referral_amount + $transaction_amount)/$transaction_quantity;

	         // select merchant details
	         $merchant_details = $this->db->select("merchant_account_balance","merchant_commission")->from("users")->where(array("user_id" => $this->user_id))->get();

	         $merchant_account_balance = $merchant_details->current()->merchant_account_balance;
	         $admin_percentage = ($merchant_commission/100);
	         $admin_commission = $admin_percentage * $transaction_total_amount;
	         $merchant_amount = $transaction_total_amount - $admin_commission;

	         $merchant_account = $merchant_account_balance + $merchant_amount;

		  if($act==0){ // for normal transaction
	         // update merchant account balance details
	         $result_mer = $this->db->update("users", array("merchant_account_balance" => $merchant_account), array("user_id" => $this->user_id));
		  }
	         // select admin details
	      /*   $admin_details = $this->db->select("merchant_account_balance")->from("users")->where(array("user_type" => "1"))->get();
	         $admin_account_balance=$admin_details->current()->merchant_account_balance;
	         $admin_commission_amount=($admin_account_balance+$admin_commission);
	         $admin_total_amount=($admin_commission_amount-$transaction_total_amount);

	         // update admin account balance details
	         $result_admin = $this->db->update("users", array("merchant_account_balance" => $admin_total_amount), array("user_type" => "1")); */
	         // coupon code closed
              $result = $this->db->update("transaction_mapping", array("coupon_code_status" => $type), array("coupon_code" => $coupon_code,"deal_id" => $deal_id));

			if($act==1){  // cod transaction
				//$coupon_count = $this->db->count_records("transaction_mapping", array("coupon_code_status" => $type), array("transaction_id" => $trans_id,"deal_id" => $deal_id));

				//if($coupon_count == $transaction_quantity){
					$this->db->update('transaction',array('captured_date' =>time(),'payment_status' => 'Completed','pending_reason' =>'None'),array('id' => $trans_id));
				//}
			}

                return count($result);
          //}
         // return 0;
	}

	/** GET USER LIST **/
	public function get_transaction_chart_list()
	{
	        $result = $this->db->from("transaction_mapping")
                                ->where(array("deals.merchant_id" => $this->user_id))
	                            ->join("deals","deals.deal_id","transaction_mapping.deal_id")
                                ->get();
                return $result;
	}

	/** GET DEAL TRANSACTION LIST FOR HOME PAGE**/
	public function get_merchant_deal_transaction_chart_list()
	{
	        $result = $this->db->select("transaction.*")->from("transaction")
								->where(array("deals.merchant_id" => $this->user_id))
								->join("deals","deals.deal_id","transaction.deal_id")
                                ->get();
                return $result;
	}

	/** GET PRODUCT TRANSACTION LIST FOR HOME PAGE**/
	public function get_merchant_product_transaction_chart_list()
	{
	        $result = $this->db->select("transaction.*")->from("transaction")
								->where(array("product.merchant_id" => $this->user_id))
								->join("product","product.deal_id","transaction.product_id")
                                ->get();
                return $result;
	}

	/** GET AUCTION TRANSACTION LIST FOR HOME PAGE**/
	public function get_merchant_auction_transaction_chart_list()
	{
	        $result = $this->db->select("transaction.*")->from("transaction")
								->where(array("auction.merchant_id" => $this->user_id))
								->join("auction","auction.deal_id","transaction.auction_id")
                                ->get();
                return $result;
	}
	/** GET USER LIST **/
	public function get_product_transaction_chart_list()
	{
	        $result = $this->db->from("transaction_mapping")
                                ->where(array("product.merchant_id" => $this->user_id))
	                            ->join("product","product.deal_id","transaction_mapping.product_id")
                                ->get();
                return $result;
	}

	/** GET USER LIST **/
	public function get_auction_transaction_chart_list()
	{
	        $result = $this->db->from("transaction")
	                            ->join("auction","auction.deal_id","transaction.auction_id")
								 ->where(array("auction.merchant_id" => $this->user_id))
                                ->get();
                return $result;
	}

	/** GET BIDDING DATA **/

	public function get_bidding_data_list()
	{
                $result =$this->db->from("bidding")->get();
                return $result;
	 }

	/** ADD AUCTION **/

	public function add_auction_products($post = "", $deal_key = "")
	{
		$savings = $post->product_price-$post->deal_value;
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal
		//$sub_cat = implode(',',$sub_cat1);

	    $result = $this->db->insert("auction", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category,"product_value" => $post->product_price,"deal_value" => $post->deal_value,"deal_price" => $post->deal_value,"deal_savings"=> $savings,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date), "created_date" => time(),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description, "merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"created_by"=>$this->user_id,"bid_increment"=>$post->bid_increment,"shipping_fee"=>$post->shipping_fee ,"shipping_info"=>$post->shipping_info,"deal_status" => 1, "for_store_cred" => $post->store_cred));

		if(count($result) == 1){
			return $result->insert_id();
		}
		return 0;
	}

	/** UPDATE AUCTION **/

	public function edit_auction($deal_id = "", $deal_key = "", $post = "")
	{
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal
		//$sub_cat = implode(',',$sub_cat1);

		$dealdata = $this->db->select("deal_title","url_title","bid_count")->from("auction")->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))->get();

				if(count($dealdata) == 1){
			$oldurlTitle = $dealdata->current()->url_title;
			if($oldurlTitle != url::title($post->title)){
				$result = $this->db->count_records("deals", array("url_title" => url::title($post->title)));
				if($result > 0){
					return 0;
				}
			}

			$this->db->update("auction", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category, "third_category_id" => $post->third_category,"product_value" => $post->product_price, "deal_value" => $post->deal_value,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description, "merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"created_by"=>$this->user_id,"bid_increment"=>$post->bid_increment,"shipping_fee"=>$post->shipping_fee ,"shipping_info"=>$post->shipping_info), array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id));

			if($dealdata->current()->bid_count == 0 ){ // for no one bid
					$this->db->update("auction", array("deal_price" => $post->deal_value),array("deal_id" => $deal_id, "deal_key" => $deal_key));
				}


			return 1;
		}
		return 8;
	}
	/** MANAGE  AUCTION **/

	public function get_all_auction_list($type = "",$offset = "", $record = "", $city = "", $name = "",$sort_type = "",$param = "",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}

		if($type == 1){

		$cont = "<";
		}
		else{
		$cont = ">";
		}

		$conditions = "auction.enddate $cont ".time()." AND auction.enddate > 0 AND stores.store_status = 1 AND auction.merchant_id = $this->user_id AND city_status =1 AND country_status = 1 ";

		if($_GET){


			if($city){
			$conditions .= " and city.city_id = ".$city;
			}
			if($name){
			$conditions .= " and (deal_title like '%".mysql_real_escape_string($name)."%'";
			$conditions .= " or store_name like '%".mysql_real_escape_string($name)."%')";
			}
			if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( auction.created_date between $startdate_str and $enddate_str )";	
                        }
			$sort_arr = array("name"=>" order by auction.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by auction.deal_price $sort","count"=>" order by auction.bid_count $sort","increment"=>" order by auction.bid_increment $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by auction.deal_id DESC'; }

			$query = "select * , auction.created_date as createddate from auction join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=auction.category_id join users on users.user_id=auction.merchant_id where $conditions $limit1 ";


		}
		else{

			$query = "select * , auction.created_date as createddate from auction join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=auction.category_id join users on users.user_id=auction.merchant_id where $conditions order by auction.deal_id DESC $limit1 ";
		}

		$result = $this->db->query($query);
		return $result;
	}

	/** AUCTION COUNT **/

	public function get_all_auction_count($type = "", $city = "", $name = "",$sort_type = "",$param = "",$today="", $startdate = "", $enddate = "")
	{
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}

                if($type == 1){

                        $cont = "<";
                }
                else{
                        $cont = ">";
                }

                if($_GET){

                        $conditions = "auction.enddate $cont ".time()."  AND auction.enddate > 0 AND stores.store_status = 1 AND auction.merchant_id = $this->user_id";
                        if($city){
                                $conditions .= " and city.city_id = ".$city;
                        }

                        if($name){
                                $conditions .= " and (deal_title like '%".mysql_real_escape_string($name)."%'";
			        $conditions .= " or store_name like '%".mysql_real_escape_string($name)."%')";
                        }

                        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( auction.created_date between $startdate_str and $enddate_str )";	
                        }
			$sort_arr = array("name"=>" order by auction.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by auction.deal_price $sort","count"=>" order by auction.bid_count $sort","increment"=>" order by auction.bid_increment $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by auction.deal_id DESC'; }

                                $query = "select * from auction join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id join category on category.category_id=auction.category_id join users on users.user_id=auction.merchant_id   where $conditions";
                                $result = $this->db->query($query);
                }
                else{
                        $result = $this->db->select("deal_id")->from("auction")
                                        ->where(array("enddate $cont" => time(),"stores.store_status" => "1","auction.merchant_id" =>$this->user_id))
			                            ->join("stores","stores.store_id","auction.shop_id")
			                            ->join("city","city.city_id","stores.city_id")
			                            ->join("country","country.country_id","stores.country_id")
						    			->join("category","category.category_id","auction.category_id")
						    			->join("users","users.user_id","auction.merchant_id")
			                            ->orderby("deal_id","DESC")
                                        ->get();
                }
                return count($result);
	}

	/** VIEW AUCTION **/

	public function get_auction_data($deal_key = "", $deal_id = "")
	{

	        $result = $this->db->select('*','auction.sub_category_id as sub_cat','auction.sec_category_id as sec_cat')->from("auction")
                                                ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key))
                                                ->join("stores","stores.store_id","auction.shop_id")
                                                ->join("city","city.city_id","stores.city_id")
                                                ->join("country","country.country_id","stores.country_id")
                                                ->join("users","users.user_id","auction.merchant_id")
                                                ->join("category","category.category_id","auction.category_id")
                                                ->get();
                return $result;
	}
	
	public function get_auctionmail_data($deal_key = "", $deal_id = "")
	{

	        $result = $this->db->select('*','auction.sub_category_id as sub_cat','auction.sec_category_id as sec_cat')->from("auction")
                                                ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key, "deal_status" => 1))
                                                ->join("stores","stores.store_id","auction.shop_id")
                                                ->join("city","city.city_id","stores.city_id")
                                                ->join("country","country.country_id","stores.country_id")
                                                ->join("users","users.user_id","auction.merchant_id")
                                                ->join("category","category.category_id","auction.category_id")
                                                ->get();
                return $result;
	}

	/** EDIT AUCTION DATA **/

	public function get_edit_auction($deal_id = "",$deal_key = "")
	{
		$result = $this->db->from("auction")
							->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))
		     				->get();
		return $result;
	}

	/** GET SINGLE USER DATA **/

	public function get_auction_users_data($userid = "")
	{
		$result = $this->db->from("users")->where(array("user_type" => $userid))->where('user_status',1)->orderby("firstname","ASC")->get();
		return $result;
	}

	/** BLOCK UNBLOCK AUCTION **/

	public function blockunblockauction($type = "", $key = "", $deal_id = "" )
	{

		$status = 0;
		if($type == 1){
		$status = 1;
		}
		$result = $this->db->update("auction", array("deal_status" => $status), array("deal_id" => $deal_id, "deal_key" => $key));
		return count($result);
	}


		/** GET SHIPPING DATA  **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping    **/

        public function get_auction_shipping_list($offset = "", $record = "",  $name= "",$type = "",$limit="")
        {
			$limit1 = $limit !=1 ?"limit $offset,$record":"";

				$condition = "AND t.type != 5  AND d.merchant_id = $this->user_id ";

				if($type){
					$condition = " AND t.type = 5 AND d.merchant_id = $this->user_id ";
				}
        		if($_GET){
	        		$contitions = ' (u.firstname like "%'.mysql_real_escape_string($name).'%"';
                    $contitions .= 'OR u.email like "%'.mysql_real_escape_string($name).'%"';
            		$contitions .= 'OR tm.coupon_code like "%'.mysql_real_escape_string($name).'%")';

                   $result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where $contitions and shipping_type = 2 $condition group by shipping_id order by shipping_id DESC  $limit1 ");
				}
				else {
					$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id  where shipping_type = 2 $condition group by shipping_id order by shipping_id DESC $limit1 ");
				}
                return $result;
        }


		 /** GET CONTACTS DATA  **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping     **/

        public function get_auction_shipping_count($name = "",$type = "")
        {
				$condition = "AND t.type != 5 and d.merchant_id = $this->user_id ";
				if($type){
					$condition = " AND t.type = 5 and d.merchant_id = $this->user_id ";

				}
           		if($_GET){
			        $contitions = ' (u.firstname like "%'.mysql_real_escape_string($name).'%"';
                    $contitions .= ' OR u.email like "%'.mysql_real_escape_string($name).'%"';
					$contitions .= 'OR tm.coupon_code like "%'.mysql_real_escape_string($name).'%")';

                   $result = $this->db->query("select s.shipping_id from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join users as u on u.user_id=s.user_id where $contitions and shipping_type = 2 $condition group by shipping_id order by shipping_id DESC ");
		}
		else {
			$result = $this->db->query("select s.shipping_id from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join users as u on u.user_id=s.user_id where shipping_type = 2 $condition group by shipping_id order by shipping_id DESC");
		}
                return count($result);
        }


	/** AUCTION WINNER LIST  **/

	public function get_winner_list($offset = "", $record = "", $name = "",$limit="")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$contitions = "auction.winner != 0 and auction.merchant_id = $this->user_id and bidding.winning_status!=0 ";

		if($_GET){

		        	   $contitions .= ' and (users.firstname like "%'.mysql_real_escape_string($name).'%"';
                       $contitions .= ' OR auction.deal_title like "%'.mysql_real_escape_string($name).'%")';

		}

		$query = " SELECT * FROM auction join users on users.user_id=auction.winner join city on city.city_id=users.city_id join country on country.country_id=users.country_id  join bidding on bidding.auction_id = auction.deal_id where $contitions order by auction.deal_id DESC $limit1 ";

				$result = $this->db->query($query);

	return $result;

	}

	/** AUCTION WINNER 	COUNT  **/

	public function get_winner_count($name = "")
	{
		$contitions = "auction.winner != 0 and auction.merchant_id = $this->user_id and bidding.winning_status!=0 ";

		if($_GET){
		        	   $contitions .= ' and (users.firstname like "%'.mysql_real_escape_string($name).'%"';
                       $contitions .= ' OR auction.deal_title like "%'.mysql_real_escape_string($name).'%")';
                       $result = $this->db->query("SELECT count(bidding.bid_id) as count FROM auction join users on users.user_id=auction.winner join city on city.city_id=users.city_id join country on country.country_id=users.country_id join bidding on bidding.auction_id = auction.deal_id where $contitions ");
			}

		else {
		$result = $this->db->query( " SELECT count(bidding.bid_id) as count FROM auction join users on users.user_id=auction.winner join city on city.city_id=users.city_id join country on country.country_id=users.country_id  join bidding on bidding.auction_id = auction.deal_id where $contitions " );
		}
	return $result[0]->count;

	}
	/* GET BIDDING LIST */
	public function get_bidding_list($deal_id = "")
		{
			$result = $this->db->from("bidding")->join("auction","auction.deal_id","bidding.auction_id")->join("users","users.user_id","bidding.user_id")->where(array("auction.deal_status" => 1,"auction.deal_id" => $deal_id,"users.user_status" =>1))->orderby("bid_id","DESC")->get();
		return $result;

		}
	/** GET DEALS SUB CATEGORY LIST **/

	public function get_sub_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type"=>2))->orderby("category_name","ASC")->get();
		return $result;
	}

	public function get_sec_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type"=>3))->orderby("category_name","ASC")->get();
		return $result;
	}

    /** GET SUB CATEGORY LIST BY CATEGORY **/
        public function get_sub_category($category = "")
	{
		$result = $this->db->from("category")
		                    ->where(array("main_category_id" => $category, "category_status" => 1,"type" => 2))
	                        ->orderby("category_name")->get();
		return $result;
	}


	/** GET SEC SUB CATEGORY LIST BY CATEGORY **/
        public function get_sec_category($category = "")
	{
		$result = $this->db->from("category")
		                    ->where(array("sub_category_id" => $category, "category_status" => 1,"type" => 3))
	                        ->orderby("category_name")->get();
		return $result;
	}

	/** GET SEC SUB CATEGORY LIST BY CATEGORY **/
        public function get_third_category($category = "")
	{
		$result = $this->db->from("category")
		                    ->where(array("sub_category_id" => $category, "category_status" => 1,"type" => 4))
	                        ->orderby("category_name")->get();
		return $result;
	}

        public function get_third_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type"=>4))->orderby("category_name","ASC")->get();
		return $result;
	}

	/** FORGOT PASSWORD **/

	public function forgot_password($email = "", $password = "")
	{

		$email = trim($email);
		$result = $this->db->from("users")->where(array("email" => $email,"user_type" => 3,"user_status" => 1))->limit(1)->get();
		if(count($result) > 0){
			
			$userid = $result->current()->user_id;
			$name = $result->current()->firstname;
			$email = $result->current()->email;
			$this->db->update("users",array("password" => md5($password) ), array("user_id" => $userid));
			return 1;
		}
		else{
			return 0;
		}
	}
	
	public function get_user_details_list($email)
	{
		$email = trim($email);
		/*$result = $this->db->from("users")->where(array("email" => $email,"user_type" => 3,"user_status" => 1))->limit(1)->get();*/
		$result=$this->db->query("select * from users where email='$email' and user_status=1 and user_type IN(3,8)");
		return $result;
	}

	/* GET DEALS CHART */
	public function get_deals_chart_list()
	{
	    $result_active_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate >" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1","deals.merchant_id" => $this->user_id))->get();
		$result["active_deals"]=count($result_active_deals);

		$result_archive_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate <" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1","deals.merchant_id" => $this->user_id))->get();
		$result["archive_deals"]=count($result_archive_deals);
		return $result;
	}
	/* GET PRODUCT CHART LIST */
	public function get_products_chart_list()
	{
	    $result_active_products = $this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE purchase_count < user_limit_quantity and deal_status = 1 and stores.store_status = 1 and product.merchant_id = $this->user_id");
		$result["active_products"]=count($result_active_products);

		$result_sold_products =$this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE purchase_count = user_limit_quantity and deal_status = 1 and stores.store_status = 1 and product.merchant_id = $this->user_id");
		$result["archive_products"]=count($result_sold_products);
		return $result;
	}

	/** AUCTION DASHBOARD   **/

	public function get_auction_chart_list()
	{
	    $result_active_deals =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate >" => time(), "auction.merchant_id" =>$this->user_id,"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["active_auction"]=count($result_active_deals);

		$result_archive_deals =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate <" => time(),"auction.merchant_id" =>$this->user_id, "deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["archive_auction"]=count($result_archive_deals);
		return $result;
	}

		/** REGISTER DELS AUTO POST INTO FACEBOOK  WALL **/

	public function register_autopost($fb_profile = array(),$fb_access_token = "")
	{

        $result= $this->db->update("users", array("fb_user_id" => $fb_profile->id ,"fb_session_key" => $fb_access_token,"facebook_update"=>1), array("user_id" =>$this->user_id));
		$this->session->set(array("fb_access_token" => $fb_access_token,"fb_user_id" => $fb_profile->id));
		return $result;
	}

	/** UPDATE DEAL AUTO POST **/
	public function update_autopost($value = "")
	{
		$result = $this->db->update("users", array("facebook_update" =>$value,"fb_user_id"=>0,"fb_session_key"=>0), array("user_id" =>$this->user_id));
		return $result;
	}

	/** GET PRODUCT COLOR **/

	public function get_color_code()
	{
		$result = $this->db->from("color")->join("color_code","color_code.color_code","color.color_name","left")
				->where(array("color_status" =>0,"color_code.color_name!="=>"NULL"))
				->orderby("color.color_code_name","ASC")
				->groupby("color.color_name")
		     		->get();
		return $result;
	}

	/** GET PRODUCT SIZE **/

	public function get_product_size()
	{
		$query = "SELECT * FROM size where size_id!=1 ORDER BY CAST(size_name as SIGNED INTEGER)  ASC";
	        $result = $this->db->query($query);
		return $result;
	}

	/** GET PRODUCT COLOR **/

	public function get_color_data($color_id="")
	{
		$result = $this->db->from("color_code")
		                ->where(array("color_code" => $color_id))
						->get();
		return $result;
	}

	/** GET PRODUCT SIZE **/

	public function get_size_data($size_id="")
	{
		$result = $this->db->from("size")
		                ->where(array("size_id" => $size_id))
		     		->get();
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
	/** GET PRODUCT SIZE **/

	public function get_product_one_size($deal_id = "")
	{
		$result = $this->db->from("product_size")
				->where(array("deal_id" => $deal_id))
		     		->get();
		return $result;
	}

	/** GET PRODUCT COLOR **/

	public function store_size_data($city_id = "",$deal_id = "")
	{
	    $dealdata = $this->db->select("product_size_id")->from("product_size")->where(array("deal_id" => $deal_id,"size_id" => $city_id))->get();
	    if(count($dealdata) == 1){
	        return 0;
	    } else {

	    $result_id = $this->db->select("size_name")->from("size")->where(array("size_id" => $city_id))->get();
		$result = $this->db->insert("product_size", array("deal_id" => $deal_id,"size_id" => $city_id,"size_name" => $result_id->current()->size_name));
		return 1;
		}
	}

	/** GET PRODUCT COLOR **/

	public function store_color_data($city_id = "",$deal_id = "")
	{
	    $dealdata = $this->db->select("color_id")->from("color")->where(array("deal_id" => $deal_id,"color_name" => $city_id))->get();
	    if(count($dealdata) == 1){
	        return 0;
	    } else {

	    $result_id = $this->db->select("id","color_name")->from("color_code")->where(array("color_code" => $city_id))->get();
		$result = $this->db->insert("color", array("deal_id" => $deal_id,"color_code_id" => $result_id->current()->id,"color_name" => $city_id,"color_code_name" => $result_id->current()->color_name));

		return 1;
		}
	}
	/** GET SHIPPING DATA FOR DELIVERY MAIL **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping    **/

        public function get_shipping_list1()
        {
			$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id  where shipping_type = 1  group by shipping_id order by shipping_id DESC");
            return $result;
        }

        /**  UPDATE THE DELIVERY STATUS OF COD **/
	public function update_cod_shipping_status($id = "",$type="",$trans_id=0,$product_id=0,$merchant_id=0)
	{
			$check = $this->db->count_records('shipping_info',array('shipping_id' =>$id,'delivery_status'=>0));
			if($check){
			$get_detail = $this->db->select("deal_merchant_commission","shipping_amount","tax_amount","amount","product_size","quantity")->from('transaction')->where(array("id" =>$trans_id,"product_id" =>$product_id))->get();
			if(count($get_detail)){
				if($type==4){ // for completed transaction update the merchant balance
				$product_amount=$get_detail[0]->amount;
				 $total_pay_amount = ($product_amount + $get_detail[0]->shipping_amount + $get_detail[0]->tax_amount);
				 $commission=(($product_amount)*($get_detail[0]->deal_merchant_commission/100));
				 $merchantcommission = $total_pay_amount - $commission ;
				 //$this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");

				 $this->db->update('transaction',array('captured' => 1,'captured_date' =>time(),'payment_status' => 'Success','pending_reason' =>'None'),array('id' => $trans_id));

				$this->db->update('transaction_mapping',array('coupon_code_status' => 0),array("transaction_id" => $trans_id));

				}
				else if($type==5){  // for failed transcation reset the quantity for that size
						$quantity=$get_detail[0]->quantity;
						$size_id = $get_detail[0]->product_size;
					$this->db->query("update product_size set quantity = quantity + $quantity where deal_id = '$product_id' and size_id = '$size_id' ");

					$this->db->query("update product set user_limit_quantity = user_limit_quantity + $quantity where deal_id = '$product_id'");

					$this->db->update('transaction',array('payment_status' => 'Failed','pending_reason' =>'Not paid'),array('id' => $trans_id));

				}
			}

		$result = $this->db->update('shipping_info',array('delivery_status' => $type),array('shipping_id' => $id ,'shipping_type' => 1));

		return count($result);
		}
		return 0;
	}

	public function get_auction_mail_data($deal_id = "",$transaction_id = "",$shipping_id="")
	{

		$result = $this->db->select("shipping_info.*,auction.deal_title,deal_price,transaction.bid_amount,transaction.quantity,transaction.shipping_amount,transaction.tax_amount,transaction.transaction_date,store_name,stores.address1 as addr1,stores.address2 as addr2,city_name,stores.zipcode,stores.phone_number as str_phone,transaction.shipping_amount as shipping,shipping_info.adderss1 as saddr1,shipping_info.address2 as saddr2,shipping_info.phone,stores.website,shipping_info.name,shipping_info.country,auction.deal_key,auction.deal_value,auction.url_title,users.fb_session_key,users.fb_user_id,users.email,users.facebook_update")->from("shipping_info")->join("transaction","transaction.id","shipping_info.transaction_id")->join("auction","auction.deal_id","transaction.auction_id")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","shipping_info.city")->join("users","users.user_id","shipping_info.user_id")->where(array("shipping_info.shipping_id" => $shipping_id,"transaction.id" =>$transaction_id,"auction.deal_id" => $deal_id))->get();

		return $result;
	}

	/**  UPDATE THE DELIVERY STATUS OF AUCTION COD  **/
	public function auction_update_cod_shipping_status($id = "",$type="",$trans_id=0,$auction_id=0,$merchant_id=0)
	{

	$check = $this->db->count_records('shipping_info',array('shipping_id' =>$id,'delivery_status'=>0));
			if($check){
			$get_detail = $this->db->select("deal_merchant_commission","shipping_amount","tax_amount","amount","product_size","quantity")->from('transaction')->where(array("id" =>$trans_id,"auction_id" =>$auction_id))->get();
			if(count($get_detail)){
				if($type==4){ // for completed transaction update the merchant balance
				$product_amount=$get_detail[0]->amount;
				 $total_pay_amount = ($product_amount + $get_detail[0]->shipping_amount + $get_detail[0]->tax_amount);
				 $commission=(($product_amount)*($get_detail[0]->deal_merchant_commission/100));
				 $merchantcommission = $total_pay_amount - $commission ;
				 $this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");

				 $this->db->update('transaction',array('captured' => 1,'captured_date' =>time(),'payment_status' => 'Success','pending_reason' =>'None'),array('id' => $trans_id));

				$this->db->update('transaction_mapping',array('coupon_code_status' => 0),array("transaction_id" => $trans_id));

				}
				else if($type==5){  // for failed transcation reset the quantity for that size

						$time=time()+(AUCTION_EXTEND_DAY*24*60*60);
						$result = $this->db->query("UPDATE auction SET enddate = $time,winner = 0,auction_status = 0 WHERE deal_id = $auction_id");
						$this->db->delete("bidding",array("auction_id" => $auction_id));

					$this->db->update('transaction',array('payment_status' => 'Failed','pending_reason' =>'Not paid'),array('id' => $trans_id));

				}
			}

		$result = $this->db->update('shipping_info',array('delivery_status' => $type),array('shipping_id' => $id ,'shipping_type' => 2));

		return count($result);
		}
		return 0;

	}

	/* GET HIGHEST BID */
		public function get_highest_bid($deal_id ="")
		{
			$result = $this->db->from("bidding")->select("bid_amount","bid_id")->where(array("auction_id" => $deal_id))->orderby("bid_amount","DESC")->limit(1)->get();
			return $result;
		}

	/** GET MERCHANT BALANCE **/

	public function get_merchant_balance1()
	{
                $result =$this->db->select("merchant_account_balance")->from("users")->where(array("user_type" => 3, "user_id" => $this->user_id))->get();
                return (count($result))?$result->current()->merchant_account_balance:0;
	}

		/* Attributes start */
	/*To get all attributes*/
	public function GetAttributes(){
		 $result = $this->db->from("attribute")->get();

		return $result;
	}

	/*To get single product attributes*/
	public function get_product_attributes($product_id=""){
		 $result = $this->db->from("product_attribute")->where(array("product_id"=>$product_id))->get();
		 return $result;
	}

	/*To get product attribute and attribute groups*/
	public function getProductAttributes() {
		$product_attribute_group_data = array();

		$product_attribute_group_query = $this->db->select("ag.attribute_group_id", "ag.groupname", "ag.sort_order")
						->from("attribute as a")
						->join("attribute_group as ag","a.attribute_group" ,"ag.attribute_group_id","left")
						->groupby("ag.attribute_group_id")
						->orderby("ag.sort_order", "ag.groupname","asc")
						->get()->as_array(false);
		//print_r($product_attribute_group_query); exit;
		 foreach ($product_attribute_group_query as $product_attribute_group) {
			$product_attribute_data = array();

			$product_attribute_query = $this->db->select("a.attribute_id", "a.name")
						->from("attribute as a")
						->where(array("a.attribute_group"=>$product_attribute_group['attribute_group_id']))
						->groupby("a.attribute_id")
						->orderby("a.sort_order", "a.name","asc")
						->get()->as_array(false);


			foreach ($product_attribute_query as $product_attribute) {
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute['attribute_id'],
					'name'         => $product_attribute['name']
				);
			}

			$product_attribute_group_data[] = array(
				'attribute_group_id' => $product_attribute_group['attribute_group_id'],
				'name'               => $product_attribute_group['groupname'],
				'attribute'          => $product_attribute_data
			);
		}

		//print_r($product_attribute_group_data); exit;
		return $product_attribute_group_data;
	}

	/* Attributes end */

	/*To get single product policy*/
	public function get_product_policy($product_id=""){
		 $result = $this->db->from("product_policy")->where(array("product_id"=>$product_id))->get();
		 return $result;
	}
	
	/** GET MERCHANT SHIPPING DATA **/
	
	public function get_shipping_data()
	{
		$result = $this->db->from("shipping_module_settings")->where(array("ship_user_id" => $this->user_id))->limit(1)->get();
		return $result;
	}
	
	/** UPDATE SHIPPING ACCOUNT SETTINGS **/
	
	public function shipping_settings($post = "")
	{
		$result = $this->db->update("users",array("AccountCountryCode" => $post->AccountCountryCode, "AccountEntity" => $post->AccountEntity, "AccountNumber" => $post->AccountNumber, "AccountPin" => $post->AccountPin,"UserName" => $post->UserName, "ShippingPassword" => $post->Password ), array("user_type" => 3, "user_id" => $this->user_id));
		return 1;
	}
	
		/** Import product option category add **/

	public function importproduct_addcategory($category = "",$sub_category = "",$sec_category = "",$third_category = "")
	{//echo $category.'<br />'.$sub_category.'<br />'.$sec_category.'<br />'.$third_category;
		$main_cat_id = 0;
		$sub_cat_id = 0;
		$sec_cat_id = 0;
		$third_cat_id = 0;
		if(($category != "") && ($sub_category != "") && ($sec_category != "")){
		$result = $this->db->count_records("category", array("category_url" => url::title($category)));
		if($result > 0){
			$status = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($category),"type"=>1))->get();
			$main_cat_id = (count($status))?$status[0]->category_id:0;
		}
		if($main_cat_id!=0){
			$result1 = $this->db->count_records("category", array("category_url" => url::title($sub_category)));
			if($result1 > 0){
				$status1 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($sub_category),"type"=>2))->get();
				$sub_cat_id = (count($status1))?$status1[0]->category_id:0;
			}
			
		}
		if($sub_cat_id!=0){
			$result2 = $this->db->count_records("category", array("category_url" => url::title($sec_category)));
			if($result2 > 0){
				$status2 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($sec_category),"type"=>3))->get();
				$sec_cat_id = (count($status2))?$status2[0]->category_id:0;
			}
			
		}
		$third_cat_id=0;
		if($third_category!=""){
			if($sec_cat_id!=0){
				$result3 = $this->db->count_records("category", array("category_url" => url::title($third_category)));
				if($result3 > 0){
					$status3 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($third_category),"type"=>4))->get();
					$third_cat_id = (count($status3))?$status3[0]->category_id:0;
				}
			}
		}
	}
	
		$cat_result['main_category_id'] = $main_cat_id;
		$cat_result['sub_category_id'] = $sub_cat_id;
		$cat_result['sec_category_id'] = $sec_cat_id;
		$cat_result['third_category_id'] = $third_cat_id;
		
	//echo '$main_cat_id:'.$main_cat_id.'$sub_cat_id:'.$sub_cat_id.'$sec_cat_id:'.$sec_cat_id.'$third_cat_id:'.$third_cat_id; exit;
		return $cat_result;
	}
	
	/** GET MERCHANT DETAILS **/
	
	public function get_merchant_details($shop_name="")
        {
                $query = "select * from users left join stores ON users.user_id=stores.merchant_id where stores.store_name='$shop_name' AND users.user_id=$this->user_id";
                $result = $this->db->query($query);                     
                return $result;
        }
        
        public function get_merchant_and_shop_status($shop_name="")
	{
                $merchant_id = $this->user_id;
                $query = "select * from stores where store_name='$shop_name' AND merchant_id='$merchant_id'";
                $result_1 = $this->db->query($query);  
                $result = count($result_1);
                if($result == 1)
                {
                        return 1;
                }
                else
                {
                        return 0;
                }
		
	}
	
	/** GET COLOR DETAILS **/
	
	public function get_color_details($color)
	{
		$result = $this->db->from("color_code")->where(array("color_name" => $color))->get();
		return $result;
	}
	
	/** GET SIZES **/
	
	public function get_size_details($size)
	{
		$result = $this->db->count_records("size", array("size_name" => $size));
		if($result == 0){
			$result = $this->db->insert("size",array("size_name" =>$size,"size_arabic" =>""));
		}
		$result = $this->db->from("size")->where(array("size_name" => $size))->get();
		return $result;
	}
	
	/** IMPORT PRODUCTS **/
	
	public function add_import_product($adminid ="",$title = "",$deal_key="", $category_id = "",$sub_category_id = "",$sec_category_id = "",$third_category_id = "",$product_price ="", $discount_price ="", $product_desc = "",$deliver_days ="",$merchant_id ="",$shop_id ="",$color_val ="",$size_val ="",$col ="",$size ="",$size_quantity="",$attribute_type="",$attribute="",$meta_keywords="",$meta_description="",$deliver_policy="",$shipping_amount_val = "" , $shipping_method = "",$shipping_weight = "", $shipping_height = "", $shipping_length ="", $shipping_width ="")
	{ 
		if($category_id !="0" && $sub_category_id !="0" ) {
                        $quantity = "";
                        foreach($size_quantity as $sq){
                                $quantity += $sq;
                        }

			$inc_tax = "1";
			
			$shipping_amount = "0";
			 if(isset($shipping_amount_val)) {
			        $shipping_amount = $shipping_amount_val;
			 }
			 
			 $weight = "0";
			 if(isset($shipping_weight)) {
			        $weight = $shipping_weight;
			 }
			 $height = "0";
			 if(isset($shipping_height)) {
			        $height = $shipping_height;
			 }
			 $length = "0";
			 if(isset($shipping_length)) {
			        $length = $shipping_length;
			 }
			 $width = "0";
			 if(isset($shipping_width)) {
			        $width = $shipping_width;
			 }
			 
			$savings=($product_price-$discount_price);
			$result = $this->db->insert("product", array("deal_title" => $title,"url_title" => url::title($title), "deal_key" => $deal_key,"category_id" => $category_id,"sub_category_id" => $sub_category_id,"sec_category_id" =>  $sec_category_id,"third_category_id" =>  $third_category_id,"deal_price" => $product_price,"deal_value" => $discount_price,"deal_savings" => $savings,"deal_percentage" => ($savings/$discount_price)*100,"deal_description" => $product_desc,"size" =>$size_val,"color" =>$color_val,"delivery_period" => $deliver_days,"merchant_id" =>$merchant_id,"shop_id" => $shop_id,"created_date" => time(),"created_by"=>$adminid,"user_limit_quantity"=>$quantity,"deal_status" =>0,"attribute"=>$attribute_type,"meta_description"=>$meta_description,"meta_keywords"=>$meta_keywords,"shipping_amount"=>$shipping_amount,"shipping"=>$shipping_method,"Including_tax" =>$inc_tax,"weight" => $weight,"height" => $height,"length" => $length,"width" => $width,"created_date" => time()));
	                $product_id = $result->insert_id();
                        if(($color_val) == 1){
                                foreach ($col as $colors) {
                                        $color_detail = explode("_",$colors);
                                        $color_id = $color_detail[0];
                                        $color_code = $color_detail[1];
                                        $color_name = $color_detail[2];
                                        $result_color = $this->db->insert("color", array("deal_id" => $product_id, "color_name" => $color_code, "color_code_id" => $color_id,"color_code_name" => $color_name));
                                } 
                        } 
                        if(($size_val) == 1){
                                foreach ($size as $sizes) {
                                        $size_detail = explode("_",$sizes);
                                        $size_id =$size_detail[0];
                                        $size_name =$size_detail[1];
                                        $size_quant =$size_detail[2];
                                        $result_color = $this->db->insert("product_size", array("deal_id" => $product_id, "size_name" => $size_name, "size_id" => $size_id,"quantity"=>$size_quant));
                                }			
                        }
                        if($attribute_type !=0){
                                foreach($attribute as $a) {
                                        $vals = explode('-',$a);
                                        $main_attr_group = isset($vals[0])?$vals[0]:'';
                                        $sub_attr_group = isset($vals[1])?$vals[1]:'';
                                        $attr_description = isset($vals[2])?$vals[2]:'';
                                        $main_group_id = $this->get_main_group($main_attr_group);
                                        $sub_group_id = $this->get_sub_group($sub_attr_group,$main_group_id);
                                        if(($main_attr_group !='') &&  ($sub_attr_group !='')) { 
                                                $result_attribute = $this->db->insert("product_attribute", array("product_id" => $product_id, "attribute_id" => $sub_group_id,"text"=>$attr_description));
                                        }
                                }	
                        }
                        $Deli_result = $this->db->delete('product_policy', array('product_id' => $product_id));
	                $result_Delivery = $this->db->insert("product_policy", array("product_id" => $product_id,"text"=>$deliver_policy));
	                return $product_id;
	                }
        }
        
         /* GET ATTRIBUTE MAIN GROUP DETAILS */
	   public function get_main_group($groupname="")
	   {
			$result = $this->db->select("attribute_group_id")->from("attribute_group")->where(array("groupname"=>$groupname))->get();
			$group_id = (count($result))?$result[0]->attribute_group_id:0;
			return $group_id;
	   }
	      /* GET ATTRIBUTE SUB GROUP DETAILS */
	   public function get_sub_group($subgroupname="",$maingroupid="")
	   {
			$result = $this->db->select("attribute_id")->from("attribute")->where(array("name"=>$subgroupname,"attribute_group"=>$maingroupid))->get();
			$sub_group_id = (count($result))?$result[0]->attribute_id:0;
			return $sub_group_id;
	   }
		
        /**  GET SECTOR DATA **/
        public function get_all_sector_data()
        {
	        return $this->db->getwhere('sector',array('sector_status' => 1,'type'=>1));
        }

		 /* Get the store name */
		public function get_store_name($storeid="") 
		{
			$result = $this->db->select("store_url_title","store_subsector_id")->from("stores")->where(array("store_id"=>$storeid,"merchant_id"=>$this->user_id))->get();
			return $result;
		}
        
        public function get_data_list(){
		 $result = $this->db->from("stores")->where(array("merchant_id"=>$this->user_id, "store_type" => 1))->get();
		 return $result;
	}
	
	public function update_cms($post = "")
	{
		
                if(isset($post->terms_conditions)){
					if(PRIVILEGES_TERMS_AND_CONDITIONS_EDIT!= 1){
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."merchant.html");	        
		}
		$result = $this->db->update("stores",array("terms_conditions" => $post->terms_conditions, "terms_conditions_status" => $post->terms_conditions_status), array("merchant_id" => $this->user_id));
		}
		if(isset($post->return_policy)){
			if(PRIVILEGES_RETURN_POLICY_EDIT!= 1){
			common::message(-1, "You cannot access this module");        
			url::redirect(PATH."merchant.html");	        
		}
		$result = $this->db->update("stores",array("return_policy" => $post->return_policy, "return_policy_status" => $post->return_policy_status), array("merchant_id" => $this->user_id));
		}
		if(isset($post->about_us)){
			if(PRIVILEGES_ABOUT_US_EDIT!= 1){
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."merchant.html");	        
		}
		$result = $this->db->update("stores",array("warranty" => $post->about_us, "warranty_status" => $post->about_us_status), array("merchant_id" => $this->user_id));
		}

		return 1;
	}
	
	public function get_merchant_attribute_data_list($store_id=""){
		  $result = $this->db->select("merchant_attribute.*","sector.sector_name")->from("merchant_attribute")->join("stores","stores.store_id","merchant_attribute.storeid")->join("sector","sector.sector_id","stores.store_sector_id")->where(array("merchant_attribute.storeid"=>$store_id))->get();
		 return $result;
	}
	
	public function get_merchant_sector_data_list($store_id=""){
		$result = $this->db->from("stores")->join("sector","sector.sector_id" ,"stores.store_subsector_id")->where(array("store_id"=>$store_id))->get();
		 /*$result = $this->db->from("users")->join("sector","sector.sector_id" ,"users.user_sector_id")->where(array("user_id"=>$this->user_id))->get();*/
		 return $result;
	}
	
	public function update_merchant_attribute($post = "",$store_id="")
	{
		$result = $this->db->update("merchant_attribute",array("bg_color" => $post->bg_color, "font_color" => $post->font_color, "font_size" => $post->font_size, "banner_1_link" => $post->banner_1_link, "banner_2_link" =>$post->banner_2_link, "banner_3_link" => $post->banner_3_link, "ads_1_link" => $post->ads_1_link, "ads_2_link" =>$post->ads_2_link, "ads_3_link" => $post->ads_3_link), array("merchant_id" => $this->user_id,"storeid" => $store_id));
		
                $user_result = $this->db->update("users", array("user_sector_id" => $post->sector,"user_sub_sector_id" =>$post->subsector), array("user_id" => $this->user_id));
                $user_result = $this->db->update("stores", array("store_sector_id" =>$post->sector,"store_subsector_id" =>$post->subsector), array("store_id" => $store_id));
		return $store_id;
	}
	
	/** ADD MODERATOR'S LIST **/
	
	public function add_moderator($post = "",$referral_id = "", $password = "")
	{
			$news_city = $post->city.",";
			$result = $this->db->insert("users", array("firstname" => $post->firstname,"lastname" => $post->lastname, "email" => $post->email, 'password' => md5($password), 'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $post->country, 'referral_id' => $referral_id, 'phone_number' => $post->mobile, 'login_type'=>'2','user_type'=>'8', "joined_date" => time(),"merchantid" =>$post->merchant_id));
			
			$result_city = $this->db->select("city_id")->from("email_subscribe")->where(array("email_id" =>$post->email))->get();

			if(count($result_city) > 0) {
					$city_subscribe = $post->city;
					$city_subscribe .=",".$post->city;
					$result = $this->db->update("email_subscribe", array("user_id" =>$result->insert_id(),"country_id" =>$post->country,"city_id" =>$city_subscribe,"category_id"=> 0),array("email_id" => $post->email));		        
			} else {
			$result_email_subscribe = $this->db->insert("email_subscribe", array("user_id" => $result->insert_id(), "email_id" => $post->email,"city_id" => $post->city,"country_id" =>$post->country,"category_id"=> 0));
			}
			$user_id = $result->insert_id();
					$data = array("privileges_deals","privileges_deals_add","privileges_deals_edit","privileges_deals_block",
					 "privileges_products","privileges_products_add","privileges_products_edit","privileges_products_block",
					 "privileges_auctions","privileges_auctions_add","privileges_auctions_edit","privileges_auctions_block",
					 
					 "privileges_transactions","privileges_fundrequest","privileges_fundrequest_edit","privileges_shop","privileges_shop_add","privileges_shop_edit","privileges_shop_block","privileges_shipping","privileges_shipping_edit","privileges_tac","privileges_tac_edit","privileges_return_policy","privileges_return_policy_edit","privileges_about_us","privileges_about_us_edit","privileges_personalized_store","privileges_personalized_store_edit","privileges_newsletter","privileges_newsletter_add","privileges_attributs","privileges_attributs_add","privileges_attributs_edit","privileges_categories","privileges_categories_add","privileges_categories_edit","privileges_specification","privileges_specification_add","privileges_specification_edit","privileges_gift","privileges_gift_add","privileges_gift_edit","privileges_gift_block");
						   $arr =array();
						   if(count($data)){
								   foreach($data as $row) {
										   $field = (isset($_POST[$row]))?1:0;
											$arr[$row] = $field.',';
								   }
						   }
						   $user = array("moderator_id" => $user_id);
						   $result_array = array_merge($arr, $user);
						   $in = $this->db->insert("moderator_privileges_map",$result_array);
		   
	return 1;
	}
	
	/** GET MODERATOR COUNT DATA  **/
	
        public function get_moderator_count($name = "", $email = "", $city = "", $logintype = "",$sort_type = "",$param = "")
        { 
				$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
                $contitions = "user_type = 8";
                if($_GET){
                        if($city){
                        $contitions .= ' and users.city_id = '.$city;
                        }
                        if($logintype){
                        $contitions .= ' and login_type = '.$logintype;
                        }
                        if($name){
                        $contitions .= ' and firstname like "%'.mysql_real_escape_string($name).'%"';
                        }
                        if($email){
                        $contitions .= ' and email like "%'.mysql_real_escape_string($email).'%"';
                        }
			$sort_arr = array("name"=>" order by users.firstname $sort","city"=>" order by city.city_name $sort","email"=>" order by users.email $sort","date"=>" order by users.joined_date $sort");

			if(isset($sort_arr[$param])){
	       		 $contitions .= $sort_arr[$param];
		}else{  $contitions .= ' order by users.user_id DESC'; }

                        $result = $this->db->query("select ('user_id') from users join city on city.city_id = users.city_id join country on country.country_id = users.country_id where $contitions");
                }
                else{
                        $result = $this->db->from("users")
                                    ->where(array("user_type" => 8))
				    				->join("city","city.city_id","users.city_id")
				    				->join("country","country.country_id","users.country_id")
                                    //->orderby("user_id", "DESC")
                                    ->get();
                }
                return count($result);
        }
        
        /** GET CITY LIST ONLY**/
        
		public function getCityListOnly()
        {
			$result = $this->db->select("city_id,city_name")->from("city")
			->join("country","country.country_id","city.country_id")
			->where(array("city_status" => 1,"country.country_status" => 1))
			->orderby("city.city_name", "ASC")
			->get();
			return $result;
        }
        
        /** GET MODERATORS DATA  **/
	
        public function get_moderator_list($offset = "", $record = "",  $name = "", $email = "", $city = "", $logintype = "",$sort_type = "",$param = "",$limit="")
        {
			$limit1 = $limit !=1 ?"limit $offset,$record":"";
			
				$sort = "DESC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
                $contitions = "user_type = 8";
                if($_GET){
                        if($city){
                        $contitions .= ' and users.city_id = '.$city;
                        }
                        if($logintype){
                        $contitions .= ' and login_type = '.$logintype;
                        }
                        if($name){
                        $contitions .= ' and firstname like "%'.mysql_real_escape_string($name).'%"';
                        }
                        if($email){
                        $contitions .= ' and email like "%'.mysql_real_escape_string($email).'%"';
                        }

						$sort_arr = array("name"=>" order by users.firstname $sort","city"=>" order by city.city_name $sort","email"=>" order by users.email $sort","date"=>" order by users.joined_date $sort");

						if(isset($sort_arr[$param])){
							 $contitions .= $sort_arr[$param];
							}else{  $contitions .= ' order by users.user_id DESC'; }
                }
                        $result = $this->db->query("select user_id,firstname,lastname,phone_number,email,city.city_id,joined_date,address1,address2,country_name,city_name,user_status from users join city on city.city_id = users.city_id join country on country.country_id = users.country_id where $contitions $limit1 ");
                
                return $result;
        }
        
        /** UPDATE MERCHANT MODERATOR **/
	
        public function edit_moderator($id,$post) 
        {
                $result_emailid = $this->db->count_records("users", array("email" => $post->email,"user_id !=" => $id));
                        if($result_emailid == 0){
                                $result = $this->db->update("users", array("firstname" => $post->firstname,"lastname" => $post->lastname, "email" => $post->email, 'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $post->country, 'phone_number' => $post->mobile,"merchantid" =>$post->merchant_id), array('user_id' => $id,'user_type'=>'8'));
                                $data = array("privileges_deals","privileges_deals_add","privileges_deals_edit","privileges_deals_block",
								 "privileges_products","privileges_products_add","privileges_products_edit","privileges_products_block",
								 "privileges_auctions","privileges_auctions_add","privileges_auctions_edit","privileges_auctions_block",
								 
								 "privileges_transactions","privileges_fundrequest","privileges_fundrequest_edit","privileges_shop","privileges_shop_add","privileges_shop_edit","privileges_shop_block","privileges_shipping","privileges_shipping_edit","privileges_tac","privileges_tac_edit","privileges_return_policy","privileges_return_policy_edit","privileges_about_us","privileges_about_us_edit","privileges_personalized_store","privileges_personalized_store_edit","privileges_newsletter","privileges_newsletter_add","privileges_attributs","privileges_attributs_add","privileges_attributs_edit","privileges_categories","privileges_categories_add","privileges_categories_edit","privileges_specification","privileges_specification_add","privileges_specification_edit","privileges_gift","privileges_gift_add","privileges_gift_edit","privileges_gift_block");
                                $arr =array();
                               if(count($data)){
                                       foreach($data as $row) {
                                               $field = (isset($_POST[$row]))?1:0;
                                                $arr[$row] = $field.',';
                                       }
                               }
                               $in = $this->db->update("moderator_privileges_map",$arr,array('moderator_id' => $id));
                                return 1;
                        }
                return 2;
        }
        
         public function moderator_privileges($user_id)
		{ 
			$result = $this->db->from("moderator_privileges_map")
							->where(array("moderator_id" => $user_id))
							->get();

			return $result;
		}
		
		/** GET SINGLE MODERATOR DATA **/
	
		public function get_moderator_data($userid = "")
		{
			$result = $this->db->from("users")->where(array("user_id" => $userid))->join("city","city.city_id","users.city_id")->limit(1)->get();
			return $result;
		}
		
		/** BLOCK & UNBLOCK MODERATOR **/
         
        public function blockunblockuser($type = "", $uid = "", $email = "")
        {
			$status = 0;
			if($type == 1){
				$status = 1;
			}
			$result = $this->db->update("users", array("user_status" => $status), array("user_id" => $uid, "email" => $email));
			return count($result);
        }
        
        /** DELETE MODERATOR **/
          
		public function deleteuser($uid = "", $email = "")
		{
			$result = $this->db->delete('users', array('user_id' => $uid, "email" => $email));
			$email = $this->db->delete('email_subscribe', array('user_id' => $uid, "email_id" => $email));
			$moderator = $this->db->delete('moderator_privileges_map', array('moderator_id' => $uid));
			return count($result);
		}
		/** GET SINGLE MODERATOR DATA FOR VIEW MODERATOR  **/
	
		public function get_user_view_data($userid = "")
		{
			$result = $this->db->from("users")->where(array("user_id" => $userid))->join("city","city.city_id","users.city_id")->join("country","country.country_id","users.country_id") ->limit(1)->get();
			return $result;
		}
		
		/** GET USER LIST **/
	public function get_user_list()
	{
		$result = $this->db->query("SELECT user_type,joined_date,login_type FROM users WHERE  user_status = 1  and user_type = 8 ");
		return $result;
	}
	/** CHECK EMAIL EXIST **/ 
	
	public function exist_email($email = "")
	{
		$result = $this->db->count_records('users', array('email' => $email,'user_type' =>8));
		return (bool) $result;
	}
	
	
	public function get_user_list1($all_users="",$city="",$gender="",$age_range="")
	{
		if($city==0)
		{
			$city="";
		}if($gender==0)
		{
			$gender="";
		}if($age_range==0)
		{
			$age_range="";
		}
		$conditions=" and product.merchant_id = $this->user_id1 ";
		
		if($city=="" && $gender=="" && $age_range=="")
		{
		$news=$this->db->select("users.email","users.firstname")->from("users")->join("transaction","transaction.user_id","users.user_id")
		->join("product","product.deal_id","transaction.product_id")->where(array("user_status"=>1,"user_type"=>4,"product.merchant_id"=>$this->user_id1))->groupby("transaction.user_id")->get();
		return $news;
		}
		if(isset($all_users) && ((isset($city) && $city!="")||(isset($gender) && $gender!="")||(isset($age_range) && $age_range!=""))){
			
		if(($city=='all' && $gender =='all' && $age_range=='all')||($city=='all' && $gender !='all' && $age_range!='all')||($city!='all' && $gender =='all' && $age_range!='all')||($city=='all' && $gender !='all' && $age_range=='all') || ($city=='all' && $gender =='all' && $age_range!='all') || ($city!='all' && $gender =='all' && $age_range=='all') || ($city=='all' && $gender !='all' && $age_range=='all')){
				
				$conditions .=" and user_type=4 ";
				
			} 
			if(isset($city) && $city!="" && $city!='all') {
				$conditions.="and city_id=".$city." and user_type=4 ";
			}
			if(isset($gender) && $gender!="" && $gender!='all')
			{
					$conditions.=" and gender=".$gender." and user_type=4 ";
				
			}
			if(isset($age_range) && $age_range!="" && $age_range!='all'){
				
				$conditions.=" and age_range=".$age_range." and user_type=4 ";
			}
			
			$news=$this->db->query("select * from  users join transaction on transaction.user_id=users.user_id join product on product.deal_id=transaction.product_id where user_status=1 $conditions group by transaction.user_id");
			return $news;
			
		}elseif(isset($all_users) && $all_users!=""){
			
			$news=$this->db->query("select * from  users join transaction on transaction.user_id=users.user_id join product on product.deal_id=transaction.product_id where user_status=1 and user_type=4 and product.merchant_id = $this->user_id1 group by transaction.user_id");
			return $news;
		}
		
		
	}
	
	
	/** NEWSLETTER SEND **/

	public function send_newsletter($post="",$file="",$logo='')
	{
		$conditions="";
		
		if(!isset($post->email)){
			
			if(isset($post->all_users)&&((isset($post->city)&&$post->city!="")||(isset($post->gender)&&$post->gender!="")||(isset($post->age_range)&&$post->age_range!=""))){
				
				if(($post->city=='all' && $post->gender =='all' && $post->age_range=='all')||($post->city=='all' && $post->gender !='all' && $post->age_range!='all')||($post->city!='all' && $post->gender =='all' && $post->age_range!='all')||($post->city=='all' && $post->gender !='all' && $post->age_range=='all') || ($post->city=='all' && $post->gender =='all' && $post->age_range!='all') || ($post->city!='all' && $post->gender =='all' && $post->age_range=='all') || ($post->city=='all' && $post->gender !='all' && $post->age_range=='all')){
					
					$conditions .=" and user_type=4";
					
				} 
				if(isset($post->city) && $post->city!="" && $post->city!='all') {
					$conditions.="and city_id=".$post->city;
				}
				if(isset($post->gender) && $post->gender!="" && $post->gender!='all')
				{
						$conditions.=" and gender=".$post->gender;
					
				}
				if(isset($post->age_range) && $post->age_range!="" && $post->age_range!='all'){
					
					$conditions.=" and age_range=".$post->age_range;
				}
				
				$news=$this->db->query("select * from  users where user_status=1 $conditions");
				
			}elseif(isset($post->all_users) && $post->all_users!=""){
				
				$news=$this->db->query("select * from  users where user_status=1 and user_type=4");
			}
			if(isset($post->users)&& $post->users!=""){
				
				$news=$this->db->query("select * from email_subscribe where  suscribe_status=1 and is_deleted= 0");
				
			}
			
			if(count($news) > 0){

			foreach($news as $c){
            	$this->email_id = "";
				$this->name = "";
				$this->message = $post->message;
				$this->news_title = $post->title;
				$this->news_message = $post->message;
				$this->news_footer = $post->footer;
				$this->news_logo = $logo;
				$message = new View("themes/".THEME_NAME."/Template_file_".$post->template);
				if(EMAIL_TYPE==2){
					email::smtp($from, $c->email,$post->subject,$message,$file);
				} else{
					email::sendgrid($from, $c->email,$post->subject,$message);
				}
			}
			return 1;
  		}
  		
		}
			if(isset($post->email) && $post->email!="") 
			{
				$email = $post->email;
				$i="0";
				foreach($email as $mail){
					if($mail=="0"){
						if($i=="0" && $mail=="0"){
										return -1;
										}
					}
						$mails = explode("__",$mail);
						$useremail = $this->mail= $mails[0];
						$username =  $mails[1];
						if(isset($username) && isset($useremail))
						$message = " <p> ".$post->message." </p>";
						$this->email_id = $useremail;
						$this->name = $username;
						$this->message = $message;
						$fromEmail = NOREPLY_EMAIL;
						$this->newstitle = $post->title;
						$this->newsmessage = $post->message;
						$this->newsfooter = $post->footer;
						$this->newslogo = $logo;
						$message = new View("themes/".THEME_NAME."/Template_file_".$post->template);

						$fromEmail = NOREPLY_EMAIL;
						if(EMAIL_TYPE==2){
						email::smtp($fromEmail,$useremail,$post->subject,$message,$file);
						}else {
						email::sendgrid($fromEmail,$useremail,$post->subject,$message);
						}


						}return 1;
				
			}
	
		
	}
	
	public function getUSERList()
	{
		$result=$this->db->select("email","users.firstname","users.user_id")->from("users")
		->join("transaction","transaction.user_id","users.user_id")
		->join("product","product.deal_id","transaction.product_id")->where(array("user_status"=>1,"user_type"=>4,"product.merchant_id"=>$this->user_id1))->groupby("transaction.user_id")->get();
		return $result;
	}
/** EXIST SECTOR DATA **/
        
        public function exist_name($name = "",$store_id="")
	{
		if($store_id !=""){
		    $result = $this->db->count_records('stores', array('store_name' => $name,'store_id !='=>$store_id));
		}else{
		    $result = $this->db->count_records('stores', array('store_name' => $name));
		}
		return (bool) $result;
	}

	/** ADD DURATION **/

	public function add_duration($post = "")
	{
		$status = $this->db->insert("duration", array("duration_period" => $post->duration ,"duration_status" => 0,"duration_merchantid"=>$this->user_id));
		if(count($status) == 1){
			return $status->insert_id();
        }
		
	}
	/* COUNT DURATION PERIOD */
	public function get_count_duration($name="")
	{
		$contitions = ' duration_merchantid = '.$this->user_id;
		if($_GET){
			if($name){
				$contitions .= ' and duration_period like "%'.mysql_real_escape_string($name).'%"';
			}
		}
		$result = $this->db->query("select duration_id from duration where $contitions order by duration_period ASC ");
		return count($result);
	}
	/* GET DURATION LIST */
	public function get_duration_list($offset="",$record="",$name="")
	{
		$contitions = ' duration_merchantid = '.$this->user_id;
		if($_GET){
			if($name){
				$contitions .= ' and duration_period like "%'.mysql_real_escape_string($name).'%"';
			}
			$result = $this->db->query("select * from duration where $contitions order by duration_period ASC limit $offset,$record");
        } else{
			$result = $this->db->query("select * from duration where $contitions order by duration_period ASC limit $offset,$record");
        }
        return $result;
	}
	/* Get edit data for duration */
	public function getdurationData($durationid="") 
	{
		$result = $this->db->from("duration")->where(array("duration_id"=>$durationid))->get();
		return $result;
	}
	/** EDIT DURATION **/

	public function edit_duration($post = "", $durationid = "")
	{
		$status = $this->db->update("duration", array("duration_period" => $post->duration),array("duration_id" => $durationid,"duration_merchantid"=>$this->user_id));
		if($status){
			return 1;
		}
	}
	/** BLOCK & UNBLOCK DURATION **/
         
	public function blockunblockduration($type = "", $durationid = "")
	{
		$status = 0;
		if($type == 1){
			$status = 1;
		}
		$result = $this->db->update("duration", array("duration_status" => $status), array("duration_id" => $durationid));
		return count($result);
	}
	/* GET DURATION PERIOD ACCORDING TO MERCHANT */
	public function get_duration_values()
	{
		$result = $this->db->from("duration")->where(array("duration_merchantid"=>$this->user_id))->orderby("duration_period","ASC")->get();
		return $result;
	}
	
	/** SPENT GIFT AMOUNT **/
	public function add_gift($post="")
	{
		/*$result=$this->db->query("select gift_id from free_gift where gift_Amount=$post->amount and merchant_id=$this->user_id and gift_name LIKE '%".mysql_real_escape_string($post->gift)."%'");
		if(count($result)>0)
		{
			return 0;
		}else{ */ 
			$gift_key = text::random($type = 'alnum', $length = 8);
			$result=$this->db->insert("free_gift",array("gift_name" => $post->gift,"gift_key" => $gift_key,"gift_description" => $post->description,"category_id" => $post->category,"quantity" => $post->quantity,"gift_type" => $post->gift_type,"gift_Amount" => $post->amount,"merchant_id" => $this->user_id,"time" => time()));
			return $result->insert_id();
		//}
	}
	
	/** EDIT GIFT **/
	public function edit_gift($post="",$gift_id="")
	{
		$result=$this->db->update("free_gift",array("gift_name" => $post->gift,"gift_description" => $post->description,"category_id" => $post->category,"quantity" => $post->quantity,"gift_type" => $post->gift_type,"gift_Amount" => $post->amount),array("gift_id" => $gift_id, "merchant_id" => $this->user_id));
		return 1;
	}
	
	/** GIFT LIST **/
	public function get_gift_list($offset="",$record="")
	{
		$result=$this->db->from("free_gift")->where(array("merchant_id" => $this->user_id))->orderby("gift_id","DESC")->limit($record,$offset)->get();
		return $result;
		
	}
	/** GIFT LIST **/
	public function get_gift_list_count()
	{
		$result=$this->db->from("free_gift")->where(array("merchant_id" => $this->user_id1))->get();
		return count($result);
		
	}
	
	/** BLOCK OR UNBLOCK GIFT **/

	public function blockunblockgift($type="", $gift_id="", $merchant_id="")
	{
		$status = 0;
		if($type == 1){
			$status = 1;
		}
		$result = $this->db->update("free_gift", array("gift_status" => $status), array("gift_id" => $gift_id, "merchant_id" => $this->user_id1 ));
				
		return count($result);
	}
	
	/** DELETE GIFT **/

	public function deleteGift($gift_id="", $merchant_id="")
	{
		$result = $this->db->delete("free_gift",array("gift_id" => $gift_id, "merchant_id" => $this->user_id1));
		return count($result);
	}
	
	/** GIFT LIST **/
	public function get_gift_data($gift_id="", $merchant_id="")
	{
		$result=$this->db->from("free_gift")->where(array("gift_id" => $gift_id, "merchant_id" => $this->user_id1,"gift_status" =>1))->get();
		return $result;
		
	}
	
	

	public function get_gift($gift_id="")
	{
		$resulkt=$this->db->select("gift_name")->from("free_gift")->where(array("gift_status" => 1,"gift_id" =>$gift_id))->get();
		return $resulkt;
	}
	
	public function change_product_status($deal_id = "" )
	{
		$status = 1;
		$result = $this->db->update("product", array("deal_status" => $status), array("deal_id" => $deal_id));
		return count($result);
	}
	
	/** GET COUNT FOR PRODUCT STORE CREDIT TRANSACTION  **/

	public function count_transaction_product_storecredit_list($type = "", $search_key = "",$sort_type = "",$param = "",$trans_type = "",$today="", $startdate = "", $enddate = "")
	{
					$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "storecredit_transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( storecredit_transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		        if($trans_type){
					
							$conditions .= " AND storecredit_transaction.type = 5 AND store_credit_id !=0";
							
							
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5 AND store_credit_id !=0";
					}
			$result = $this->db->query("select storecredit_transaction.id from storecredit_transaction join store_credit_save on store_credit_save.storecredit_id = storecredit_transaction.main_storecreditid  join users on users.user_id=storecredit_transaction.user_id join product on product.deal_id=storecredit_transaction.product_id where $conditions and product.merchant_id = $this->user_id  and ( users.firstname like '%".$search_key."%' OR storecredit_transaction.transaction_id like '%".$search_key."%' OR product.deal_title like '%".$search_key."%' )");
		}
		else{
				$conditions = "storecredit_transaction.id >= 0 and product.merchant_id = '$this->user_id' ";
				if($trans_type){
						
							$conditions .= " AND storecredit_transaction.type = 5 AND store_credit_id !=0";
							
						
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5 AND store_credit_id !=0";
					}
			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by storecredit_transaction.quantity $sort","amount"=>" order by storecredit_transaction.amount $sort","refamount"=>" order by storecredit_transaction.referral_amount $sort","commision"=>" order by storecredit_transaction.deal_merchant_commission $sort","bidamount" => "order by storecredit_transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		       }
		      else {
				$conditions = " payment_status = '$type' and product.merchant_id = '$this->user_id'";
				if($trans_type){
				
							$conditions .= " AND storecredit_transaction.type = 5 AND store_credit_id !=0";
							
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5 AND store_credit_id !=0";
					}
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by storecredit_transaction.quantity $sort_type","amount"=>" order by storecredit_transaction.amount $sort","refamount"=>" order by storecredit_transaction.referral_amount $sort","commision"=>" order by storecredit_transaction.deal_merchant_commission $sort","bidamount" => "order by storecredit_transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		             }

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by storecredit_transaction.id DESC'; }

			$result = $this->db->select("storecredit_transaction.id")->from("storecredit_transaction")
						->join("store_credit_save","store_credit_save.storecredit_id","storecredit_transaction.main_storecreditid")
						->join("users","users.user_id","storecredit_transaction.user_id")
						->join("product","product.deal_id","storecredit_transaction.product_id")
						->where($conditions)
						->get();
		}
		return count($result);
	}
		/** GET PRODUCT STORE CREDITS TRANSACTION LIST **/

	public function get_transaction_product_storecredit_list($type = "", $search_key = "", $offset = "", $record = "",$type1 = "",$sort_type = "",$param = "",$trans_type = "",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";
		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "storecredit_transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( storecredit_transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		        if($trans_type){
						
							$conditions .= " AND storecredit_transaction.type = 5  AND store_credit_id !=0";
						
						
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5  AND store_credit_id !=0";
					}
			$result = $this->db->query("select *,users.firstname as firstname, storecredit_transaction.shipping_amount as shippingamount from storecredit_transaction join store_credit_save on store_credit_save.storecredit_id = storecredit_transaction.main_storecreditid join users on users.user_id=storecredit_transaction.user_id join product on product.deal_id=storecredit_transaction.product_id where $conditions and product.merchant_id = $this->user_id  and ( users.firstname like '%".$search_key."%' OR storecredit_transaction.transaction_id like '%".$search_key."%' OR product.deal_title like '%".$search_key."%' ) $limit1 ");
		}
		else{
				$conditions = "storecredit_transaction.id >= 0 and product.merchant_id = '$this->user_id' ";
				if($trans_type){
						
							$conditions .= " AND storecredit_transaction.type = 5  AND store_credit_id !=0";
						
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5  AND store_credit_id !=0";
					}
			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by storecredit_transaction.quantity $sort","amount"=>" order by storecredit_transaction.amount $sort","refamount"=>" order by storecredit_transaction.referral_amount $sort","commision"=>" order by storecredit_transaction.deal_merchant_commission $sort","bidamount" => "order by storecredit_transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		       }
		      else {
				$conditions = " payment_status = '$type' and product.merchant_id = '$this->user_id'";
				if($trans_type){
						
							$conditions .= " AND storecredit_transaction.type = 5  AND store_credit_id !=0";
						
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5  AND store_credit_id !=0";
					}
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by storecredit_transaction.quantity $sort_type","amount"=>" order by storecredit_transaction.amount $sort","refamount"=>" order by storecredit_transaction.referral_amount $sort","commision"=>" order by storecredit_transaction.deal_merchant_commission $sort","bidamount" => "order by storecredit_transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by storecredit_transaction.storecredit_transaction_date DESC'; }

			$result = $this->db->select("*","storecredit_transaction.shipping_amount as shippingamount")->from("storecredit_transaction")
						->join("store_credit_save","store_credit_save.storecredit_id","storecredit_transaction.main_storecreditid")
						->join("users","users.user_id","storecredit_transaction.user_id")
						->join("product","product.deal_id","storecredit_transaction.product_id")
						->where($conditions)
						->limit($record, $offset)
						->get();
		}
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
	
	/** ADD ATTRIBUTE  **/
	
	public function add_attribute($data = "")
	{ 

		$result =  $this->db->count_records("attribute", array("name" => $data->name,"attribute_group="=>$data->attribute_group));
			if($result > 0){
				return 0;
			} 
		$result = $this->db->insert("attribute",array("name" =>$data->name, "attribute_group" =>$data->attribute_group,"sort_order"=>$data->sort_order));
			return 1;
	}	
	public function get_all_attribute_group(){
		return $this->db->orderby("sort_order","ASC","groupname","ASC")->get('attribute_group');
	}
	
	/** GET ATTRIBUTE COUNT  **/
	
	public function get_attribute_count()
	{
		return $this->db->count_records("attribute");
	}
	
	/** GET ATTRIBUTE LIST  **/
	
	public function get_attribute_list($offset = "", $record = "")
	{
		$result = $this->db->select("attribute.name","attribute.attribute_id","attribute.sort_order", "attribute.attribute_group", "attribute_group.groupname")->from('attribute')->join("attribute_group","attribute.attribute_group","attribute_group.attribute_group_id","left")->orderby("attribute.sort_order","ASC","attribute.name","ASC")->limit($record,$offset)->get();
 
		return $result;

	}
	/** EDIT ATTRIBUTE DATA AND UPDATE  **/

	public function edit_attribute($attribute_id = "",$data = "")
	{
			$result =  $this->db->count_records("attribute", array("name" => $data->name,"attribute_group="=>$data->attribute_group,"attribute_id!="=>$attribute_id));
			if($result > 0){
				return 0;
			}
			$status = $this->db->update("attribute", array("name" =>$data->name, "attribute_group" =>$data->attribute_group,"sort_order"=>$data->sort_order),array("attribute_id" => $attribute_id));
		return 1;

	}
	
	/** GET SINGLE ATTRIBUTE DATA FOR EDIT  **/

	public function getattributeData($attribute_id = "")
	{
		return $this->db->getwhere('attribute',array('attribute_id' => $attribute_id));
	}
	
	/** INSERT SIZE VALUE TO THE DATABASE */
	
	public function add_attribute_group($data = "")
	{
		
		$result = $this->db->insert("attribute_group",array("groupname" =>$data->groupname,"sort_order"=>$data->sort_order));
			return 1;
		
	}	
	
	
	/** GET ATTRIBUTE GROUP COUNT  **/
	
	public function get_attribute_group_count()
	{
		return $this->db->count_records("attribute_group");
	}

	/** GET ATTRIBUTE GROUP LIST  **/
	
	public function get_attribute_group_list($offset = "", $record = "")
	{
		return $this->db->orderby("sort_order","ASC","groupname","ASC")->limit($record,$offset)->get('attribute_group');
	}

	/** EDIT ATTRIBUTE GROUP DATA AND UPDATE  **/

	public function edit_attribute_group($group_id = "",$data = "")
	{

		$result =  $this->db->count_records("attribute_group", array("groupname" => $data->groupname,"attribute_group_id!=" => $group_id));
			if($result > 0){
				return 0;
			}

		$status = $this->db->update("attribute_group", array("groupname" =>$data->groupname,"sort_order"=>$data->sort_order),array("attribute_group_id" => $group_id));
		return 1;

	}

	/** GET SINGLE ATTRIBUTE GROUP DATA FOR EDIT  **/

	public function getattributegroupData($group_id = "")
	{
		return $this->db->getwhere('attribute_group',array('attribute_group_id' => $group_id));
	}
	/*UNIQUE ATTRIBUTE GROUP NAME CHECK*/
	public function check_attrgroup_exist($groupname){
			
		$result =  $this->db->count_records("attribute_group", array("groupname" => $groupname));
		 
		return $result;
	}
	/** ADD CATEGORY **/

	/*public function add_category($category = "", $cat_status = "",$deal = "",$product = "",$auction = "")
	{
		$result = $this->db->count_records("category", array("category_url" => url::title($category),"type"=>1));
		if($result == 0){
			$status = $this->db->insert("category", array("category_name" => $category , "category_url" => url::title($category),"category_status" => $cat_status,"deal" => $deal,"product" => $product,"auction" => $auction,"type" => "1"));
                        if(count($status) == 1){
                                return $status->insert_id();
                        }
		}
		return 0;
	}

	

	public function add_sub_category($category = "", $cat_status = "",$cat_id = "",$cat_type = "",$type = "")
	{
		sub_result = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => $type))->get();
		$mail_cat_id = $sub_result->current()->main_category_id;
		if($type == 1){
			$mail_cat_id = $cat_id;
		}
		
		$result = $this->db->select("category_id","category_status")->from("category")->where(array("category_url" => url::title($category),"type"=>$cat_type,"sub_category_id"=>$cat_id,"main_category_id" => $mail_cat_id))->get();
		
		//$result = $this->db->count_records("category", array("category_url" => url::title($category),"type" => $type));
		if(count($result) == 0){
		        $sub_result = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => $type))->get();
		        $mail_cat_id = $sub_result->current()->main_category_id;
		        if($type == 1){
		         $mail_cat_id = $cat_id;
		        }
			$status = $this->db->insert("category", array("category_name" => $category , "category_url" => url::title($category),"category_status" => $cat_status,"main_category_id" => $mail_cat_id,"sub_category_id" => $cat_id,"type" => $cat_type));
                        if(count($status) == 1){
                                return $status->insert_id();
                        }
		}
		return 0;
	}
*/
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
		$result = $this->db->from("category")->where(array("type" => "1"))->orderby("category_name", "ASC")->get();
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

		$result = $this->db->from("category")->where(array("sub_category_id" =>$cat_id,"type" => "2"))->orderby("category_name", "ASC")->get();
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
		$result = $this->db->from("category")->where(array("sub_category_id" =>$cat_id,"type" => "3"))->orderby("category_name", "ASC")->get();
		return $result;
	}

	/** GET SEC SUB CATEGORY LIST **/

	public function get_sub_category_list3($cat_id = "")
	{
		$result = $this->db->from("category")->where(array("sub_category_id" =>$cat_id,"type" => "4"))->orderby("category_name", "ASC")->get();
		return $result;
	}


	public function get_mail_category($cat_id = "", $type = "")
	{

		$resultcount = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => $type))->get();
		$mail = $resultcount->current()->main_category_id;
		$result = $this->db->from("category")->where(array("category_id" =>$mail,"type" => "1"))->get();

		return $result;
	}

	public function get_sub_categoryy($cat_id = "",$type = "")
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

	/*public function edit_category($category = "", $cat_status = "", $cat_id = "", $cat_url = "",$deal = "",$product = "",$auction = "")
	{
		if(url::title($category) != $cat_url){
			$sub_result = $this->db->from("category")->where(array("category_id" =>$cat_id,"type" => $type))->get();
			$mail_cat_id = $sub_result->current()->main_category_id;
			$sub_category_id = $sub_result->current()->sub_category_id;
			if($type == 1){
				$mail_cat_id = 0;
				$sub_category_id = 0;
			}
			
			$result = $this->db->count_records("category", array("category_name" => url::title($category),"type" => $type));
			if($result > 0){
				return 0;
			}
		}
		$status = $this->db->update("category", array("category_name" => $category , "category_url" => url::title($category), "category_status" => $cat_status,"deal" => $deal,"product" => $product,"auction" => $auction),
		array("category_id" => $cat_id, "category_url" => url::title($cat_url)));
		return 1;
	}*/
	
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
	
	public function get_all_sub_sectors()
	{
		$result=$this->db->select("sector_id","sector_name","main_sector_id")->from("sector")->where(array("type"=>2))->get();
		return $result;
		
	}
	/** LISTING THE SUB SECTORS CORRESPONDING TO THE SECTOR SELECTED **/
	public function get_sub_sectors($sector="")
	{
		$result=$this->db->select("sector_id","sector_name")->from("sector")->where(array("main_sector_id" => $sector,"sector_status" =>1))->get();
		return $result;
	}
	
	/** Gift list **/
	public function get_gift_list1()
	{
		$result=$this->db->select("gift_name","gift_id")->from("free_gift")->where(array("merchant_id"=>$this->user_id1,"quantity!=" => 0))->orderby("gift_id","DESC")->get();
		return $result;
	}
	
	public function exist_store_admin($email='',$user_id=''){
		if($user_id!='')
			$result = $this->db->count_records('users', array('user_type' => 9,'email'=>$email,'user_id!='=>$user_id));
		else
			$result = $this->db->count_records('users', array('user_type' => 9,'email'=>$email));
		return (bool) $result;
	}
	
	/** NEWSLETTER SEND **/

	public function send_moderator_newsletter($post="",$file="",$type="")
	{
		$conditions="";
		
		if(!isset($post->email)){
			
			if(isset($post->all_users)&&((isset($post->city)&&$post->city!="")||(isset($post->gender)&&$post->gender!="")||(isset($post->age_range)&&$post->age_range!=""))){
				
				if(($post->city=='all' && $post->gender =='all' && $post->age_range=='all')||($post->city=='all' && $post->gender !='all' && $post->age_range!='all')||($post->city!='all' && $post->gender =='all' && $post->age_range!='all')||($post->city=='all' && $post->gender !='all' && $post->age_range=='all') || ($post->city=='all' && $post->gender =='all' && $post->age_range!='all') || ($post->city!='all' && $post->gender =='all' && $post->age_range=='all') || ($post->city=='all' && $post->gender !='all' && $post->age_range=='all')){
					
					$conditions .=" and user_type=8";
					
				} 
				if(isset($post->city) && $post->city!="" && $post->city!='all') {
					$conditions.="and city_id=".$post->city;
				}
				if(isset($post->gender) && $post->gender!="" && $post->gender!='all')
				{
						$conditions.=" and gender=".$post->gender;
					
				}
				if(isset($post->age_range) && $post->age_range!="" && $post->age_range!='all'){
					
					$conditions.=" and age_range=".$post->age_range;
				}
				
				$news=$this->db->query("select * from  users where user_status=1 $conditions");
				
			}elseif(isset($post->all_users) && $post->all_users!=""){
				
				$news=$this->db->query("select * from  users where user_status=1 and user_type=8");
			}
			if(isset($post->users)&& $post->users!=""){
				
				$news=$this->db->query("select * from  users where user_status=1 and user_type=8");
				
			}
			$user_array1=array();
			if(count($news) > 0){

			foreach($news as $c){
            		$from = CONTACT_EMAIL;
            		$user_array1[]=$c->user_id;
            		
				$this->email_id = "";
				$this->name = "";
				$this->message = $post->message;
				if($type==1){
					if($post->template==1)
					  {
					$message = new View("themes/".THEME_NAME."/template1");
					 }else{
						 $message = new View("themes/".THEME_NAME."/template2");
						}
					if(EMAIL_TYPE==2){
						email::smtp($from, $c->email,$post->subject,$message,$file);
					} else{
						email::sendgrid($from, $c->email,$post->subject,$message);
					}
				}else{
					if(EMAIL_TYPE==2){
						email::smtp($from, $c->email,$post->subject,$this->message);
					} else{
						email::sendgrid($from, $c->email,$post->subject,$this->message);
					}
				}
				 
			}
			$user_array1=implode(',',$user_array1);
			$result=$this->db->insert("email",array("receivers_id" =>$user_array1,"sender_id" =>$this->user_id,"email_subject" =>$post->subject,"email_message" =>$this->message,"email_template" =>$post->template,"type" =>$post->mail_category,"send_time"=>time()));
			return 1;
  		}
  		
		}
			if(isset($post->email) && $post->email!="") 
			{
				$email = $post->email;
				$user_array=array();
				$i="0";
				foreach($email as $mail){
					if($mail=="0"){
						if($i=="0" && $mail=="0"){
										return -1;
										}
					}
										$mails = explode("__",$mail);
										$useremail = $this->mail= $mails[0];
										$username =  $mails[1];
										$user_array[]=$mails[2];
										if(isset($username) && isset($useremail))
											$message = " <p> ".$post->message." </p>";
											
											
											$this->email_id = $useremail;
											$this->name = $username;
											$this->message = $message;
											$fromEmail = NOREPLY_EMAIL;
											
											if($type==1){
												if($post->template==1)
												{
													$message = new View("themes/".THEME_NAME."/template1");
												}else{
													$message = new View("themes/".THEME_NAME."/template2");
												}
												if(EMAIL_TYPE==2){
													email::smtp($fromEmail,$useremail,$post->subject,$message,$file);
												}else {
													email::sendgrid($fromEmail,$useremail,$post->subject,$message);
												}
											}else{
												if(EMAIL_TYPE==2){
													email::smtp($fromEmail,$useremail,$post->subject,$this->message);
												}else {
													email::sendgrid($fromEmail,$useremail,$post->subject,$this->message);
												}
											}
									}
									$user_array=implode(',',$user_array);
									$result=$this->db->insert("email",array("receivers_id" =>$user_array,"sender_id" =>$this->user_id,"email_subject" =>$post->subject,"email_message" =>$this->message,"email_template" =>$post->template,"type" =>$post->mail_category,"send_time"=>time()));
									return 1;
				
			}
	
		
	}
	public function get_mercahnt_list1($all_users="",$city="",$gender="",$age_range="")
	{
		if($city==0)
		{
			$city="";
		}if($gender==0)
		{
			$gender="";
		}if($age_range==0)
		{
			$age_range="";
		}
		$conditions="";
		
		if($city=="" && $gender=="" && $age_range=="")
		{
		$news=$this->db->select("email","firstname","user_id")->from("users")->where(array("user_status"=>1,"user_type"=>8))->get();
		return $news;
		}
		if(isset($all_users) && ((isset($city) && $city!="")||(isset($gender) && $gender!="")||(isset($age_range) && $age_range!=""))){
			
		if(($city=='all' && $gender =='all' && $age_range=='all')||($city=='all' && $gender !='all' && $age_range!='all')||($city!='all' && $gender =='all' && $age_range!='all')||($city=='all' && $gender !='all' && $age_range=='all') || ($city=='all' && $gender =='all' && $age_range!='all') || ($city!='all' && $gender =='all' && $age_range=='all') || ($city=='all' && $gender !='all' && $age_range=='all')){
				
				$conditions .=" and user_type=8 ";
				
			} 
			if(isset($city) && $city!="" && $city!='all') {
				$conditions.="and city_id=".$city." and user_type=8 ";
			}
			if(isset($gender) && $gender!="" && $gender!='all')
			{
					$conditions.=" and gender=".$gender." and user_type=8 ";
				
			}
			if(isset($age_range) && $age_range!="" && $age_range!='all'){
				
				$conditions.=" and age_range=".$age_range." and user_type=8 ";
			}
			
			$news=$this->db->query("select * from  users where user_status=1 $conditions");
			return $news;
			
		}elseif(isset($all_users) && $all_users!=""){
			
			$news=$this->db->query("select * from  users where user_status=1 and user_type=8");
			return $news;
		}
		
		
	}
	/** NEWSLETTER SEND **/

	public function send_merchant_newsletter($post="",$file="",$type='')
	{
		$conditions="";
		
		if(!isset($post->email)){
			
			if(isset($post->all_users)&&((isset($post->city)&&$post->city!="")||(isset($post->gender)&&$post->gender!="")||(isset($post->age_range)&&$post->age_range!=""))){
				
				if(($post->city=='all' && $post->gender =='all' && $post->age_range=='all')||($post->city=='all' && $post->gender !='all' && $post->age_range!='all')||($post->city!='all' && $post->gender =='all' && $post->age_range!='all')||($post->city=='all' && $post->gender !='all' && $post->age_range=='all') || ($post->city=='all' && $post->gender =='all' && $post->age_range!='all') || ($post->city!='all' && $post->gender =='all' && $post->age_range=='all') || ($post->city=='all' && $post->gender !='all' && $post->age_range=='all')){
					
					$conditions .=" and user_type=4";
					
				} 
				if(isset($post->city) && $post->city!="" && $post->city!='all') {
					$conditions.="and city_id=".$post->city;
				}
				if(isset($post->gender) && $post->gender!="" && $post->gender!='all')
				{
						$conditions.=" and gender=".$post->gender;
					
				}
				if(isset($post->age_range) && $post->age_range!="" && $post->age_range!='all'){
					
					$conditions.=" and age_range=".$post->age_range;
				}
				
				$news=$this->db->query("select * from  users join transaction on transaction.user_id=users.user_id join product on product.deal_id=transaction.product_id where user_status=1 and product.merchant_id=$this->user_id1 $conditions group by transaction.user_id");
				
			}elseif(isset($post->all_users) && $post->all_users!=""){
				
				$news=$this->db->query("select * from  users join transaction on transaction.user_id=users.user_id join product on  product.deal_id=transaction.product_id where user_status=1 and product.merchant_id=$this->user_id1 and user_type=4 groupby transaction.user_id");
			}
			if(isset($post->users)&& $post->users!=""){
				
				$news=$this->db->query("select * from  users join transaction on transaction.user_id=users.user_id join product on product.deal_id=transaction.product_id where user_status=1 and product.merchant_id=$this->user_id1 and user_type=4 group by transaction.user_id");
				
			}
			$user_array1=array();
			if(count($news) > 0){

			foreach($news as $c){
            		$from = CONTACT_EMAIL;
            		$user_array1[]=$c->user_id;
            		
				$this->email_id = "";
				$this->name = "";
				$this->message = $post->message;
				if($type==1){
					 if($post->template==1)
					  {
					$message = new View("themes/".THEME_NAME."/template1");
					 }else{
						 $message = new View("themes/".THEME_NAME."/template2");
						}
					if(EMAIL_TYPE==2){
						email::smtp($from, $c->email,$post->subject,$message,$file);
					} else{
						email::sendgrid($from, $c->email,$post->subject,$message);
					}
				}else{
					if(EMAIL_TYPE==2){
						email::smtp($from, $c->email,$post->subject,$this->message);
					} else{
						email::sendgrid($from, $c->email,$post->subject,$this->message);
					}
				}
			}
			$user_array1=implode(',',$user_array1);
			$result=$this->db->insert("email",array("receivers_id" =>$user_array1,"sender_id" =>$this->user_id,"email_subject" =>$post->subject,"email_message" =>$this->message,"email_template" =>$post->template,"type" =>$post->mail_category,"send_time"=>time()));
			return 1;
  		}
  		
		}
			if(isset($post->email) && $post->email!="") 
			{
				$email = $post->email;
				$user_array=array();
				$i="0";
				foreach($email as $mail){
					if($mail=="0"){
						if($i=="0" && $mail=="0"){
										return -1;
										}
					}
										$mails = explode("__",$mail);
										$useremail = $this->mail= $mails[0];
										$username =  $mails[1];
										$user_array[]=$mails[2];
										if(isset($username) && isset($useremail))
											$message = " <p> ".$post->message." </p>";
											
											
												$this->email_id = $useremail;
												$this->name = $username;
												$this->message = $message;
												$fromEmail = NOREPLY_EMAIL;
												
												if($type==1){
													if($post->template==1)
													{
														$message = new View("themes/".THEME_NAME."/template1");
													}else{
														$message = new View("themes/".THEME_NAME."/template2");
													}
													if(EMAIL_TYPE==2){
													email::smtp($fromEmail,$useremail,$post->subject,$message,$file);
													}else {
													email::sendgrid($fromEmail,$useremail,$post->subject,$message);
													}
												}else{
													if(EMAIL_TYPE==2){
														email::smtp($fromEmail,$useremail,$post->subject,$this->message);
													}else {
														email::sendgrid($fromEmail,$useremail,$post->subject,$this->message);
													}
												}
									}
									$user_array=implode(',',$user_array);
									$result=$this->db->insert("email",array("receivers_id" =>$user_array,"sender_id" =>$this->user_id,"email_subject" =>$post->subject,"email_message" =>$this->message,"email_template" =>$post->template,"type" =>$post->mail_category,"send_time"=>time()));
									return 1;
				
			}
	
		
	}
	
	public function get_mercahnt_user_list1($all_users="",$city="",$gender="",$age_range="")
	{
		if($city==0)
		{
			$city="";
		}if($gender==0)
		{
			$gender="";
		}if($age_range==0)
		{
			$age_range="";
		}
		$conditions="";
		
		if($city=="" && $gender=="" && $age_range=="")
		{
		$news=$this->db->select("email","users.firstname","users.user_id")->from("users")->join("transaction","transaction.user_id","users.user_id")
		->join("product","product.deal_id","transaction.product_id")->where(array("user_status"=>1,"user_type"=>4,"product.merchant_id"=>$this->user_id1))->groupby("transaction.user_id")->get();
		return $news;
		}
		if(isset($all_users) && ((isset($city) && $city!="")||(isset($gender) && $gender!="")||(isset($age_range) && $age_range!=""))){
			
		if(($city=='all' && $gender =='all' && $age_range=='all')||($city=='all' && $gender !='all' && $age_range!='all')||($city!='all' && $gender =='all' && $age_range!='all')||($city=='all' && $gender !='all' && $age_range=='all') || ($city=='all' && $gender =='all' && $age_range!='all') || ($city!='all' && $gender =='all' && $age_range=='all') || ($city=='all' && $gender !='all' && $age_range=='all')){
				
				$conditions .=" and users.user_type=4 ";
				
			} 
			if(isset($city) && $city!="" && $city!='all') {
				$conditions.="and users.city_id=".$city." and users.user_type=4 ";
			}
			if(isset($gender) && $gender!="" && $gender!='all')
			{
					$conditions.=" and users.gender=".$gender." and users.user_type=4 ";
				
			}
			if(isset($age_range) && $age_range!="" && $age_range!='all'){
				
				$conditions.=" and users.age_range=".$age_range." and users.user_type=4 ";
			}
			
			$news=$this->db->query("select users.email,users.firstname,users.user_id from  users join transaction on transaction.user_id=users.user_id join product on product.deal_id=transaction.product_id where users.user_status=1 and product.merchant_id =$this->user_id1 $conditions group by transaction.user_id");
			return $news;
			
		}elseif(isset($all_users) && $all_users!=""){
			
			$news=$this->db->query("select users.email,users.firstname,users.user_id from  users join transaction on transaction.user_id=users.user_id join product on product.deal_id=transaction.product_id where users.user_status=1 and product.merchant_id =$this->user_id1 and users.user_type=4 group by transaction.user_id");
			return $news;
		}
		
		
	}
	
	/** ADMIN TO USERS MAIL COMMUNICATION **/
	public function get_user_messages($offset="",$record="")
	{
		$result=$this->db->from("email")->where(array("sender_id" =>$this->user_id,"type" =>3))->orderby("id","DESC")->limit($record,$offset)->get();
		return $result;
	}
	
	public function get_user_messages_count()
	{
		$result=$this->db->select("id")->from("email")->where(array("sender_id" =>$this->user_id,"type" =>3))->get();
		return count($result);
	}
	
	public function get_user_message($message_id="")
	{
		$result=$this->db->from("email")->where(array("id" =>$message_id ))->get();
		return $result;
		
	}
	
	public function get_user_name($user_id="")
	{
		$result=$this->db->select("firstname")->from("users")->where(array("user_id" =>$user_id))->get();
		return $result->current()->firstname;
		
	}
	
	/** ADMIN TO USERS MAIL COMMUNICATION **/
	public function get_moderator_messages($offset="",$record="")
	{
		$result=$this->db->from("email")->where(array("sender_id" =>$this->user_id,"type" =>4))->orderby("id","DESC")->limit($record,$offset)->get();
		return $result;
	}
	
	public function get_moderator_messages_count()
	{
		$result=$this->db->select("id")->from("email")->where(array("sender_id" =>$this->user_id,"type" =>4))->get();
		return count($result);
	}
	public function getUSERList1()
	{
		$result=$this->db->select("email","firstname","user_id")->from("users")->where(array("user_status"=>1,"user_type"=>8))->get();
		return $result;
	}

	public function get_subsector_name($sector_id ='')
	{
		$sector_query = $this->db->query("select * from  sector where sector_id='$sector_id' ");
		return $sector_query;
	}

/* COUNT OF STORE CREDIT TRANSACTION */
	public function count_transaction_storecredit_list($status="",$search_key="")
	{
		$result = $this->db->select("storecredit_id")->from("store_credit_save")->join("product","product.deal_id","store_credit_save.productid")->where(array("credit_status"=>$status,"merchantid"=>$this->user_id))->get();
		return count($result);
	}
	/* GET STORE CREDIT TRANSACTION LIST */
	public function get_transaction_storecredit_list($status="",$search_key="",$offset = "", $record = "")
	{
		$condition="";
		$result = $this->db->query("select * from store_credit_save as s join product on product.deal_id = s.productid join users on users.user_id = s.userid where credit_status = $status and s.merchantid=$this->user_id $condition limit $offset,$record ");
		return $result;
	}
	/* GET STORECREDIT PRODUCT DETAILS */
	public function get_storecredits_product_details($storecreditid="",$productid="")
	{
	
		$result = $this->db->query("select *,s.shipping_amount from product left join store_credit_save as s on productid=deal_id where s.storecredit_id = $storecreditid and deal_id = $productid");
		return $result;
	}
	/* GET USER DETAILS */
	public function get_user_details($storecreditid="")
	{
		$result = $this->db->select("email,firstname")->from("users")
							->join("store_credit_save","store_credit_save.userid","users.user_id")
							->where(array("storecredit_id"=>$storecreditid))
							->get();
		return $result;
		
	} 
	/* UPDATE STORECREDIT STATUS */
	public function update_storecredit_status($status="",$storecreditid="")
	{
		$result = $this->db->update("store_credit_save",array("credit_status"=>$status),array("storecredit_id"=>$storecreditid));
		return $result;
	}
	
	public function get_newsletter_list(){
		$result = $this->db->from("newsletter")->where("newsletter_status",1)->orderby("newsletter_id","ASC")->get();
		return $result;
	}
	
	public function add_template($post=''){
		$result = $this->db->count_records("newsletter", array("newsletter_url" => url::title($post->title)));
		if($result == 0){
			$status = $this->db->insert("newsletter", array("newsletter_title" => $post->title , "newsletter_url" => url::title($post->title),"newsletter_status" => 1));
			if(count($status) == 1){
					return $status->insert_id();
			}
		}
		return 0;
	}
	
	public function get_template_count(){
		$result = $this->db->from("newsletter")->orderby("newsletter.newsletter_id", "DESC")->get();
		return count($result);
	}
	
	public function get_template_list($offset='',$limit=''){
		$result = $this->db->from("newsletter")->offset($offset)->limit($limit)->orderby("newsletter.newsletter_id", "DESC")->get();
		return $result;
	}
	
	public function edit_template($post='',$newsletter_id=''){
		$result = $this->db->count_records("newsletter", array("newsletter_url" => url::title($post->title),"newsletter_id!="=>$newsletter_id));
		if($result == 0){
			$status = $this->db->update("newsletter", array("newsletter_title" => $post->title , "newsletter_url" => url::title($post->title)),array("newsletter_id"=>$newsletter_id));
			return $newsletter_id;
		}
		return 0;
	}
	
	public function get_newsletter_details($newsletter_id=''){
		$result = $this->db->from("newsletter")->where("newsletter_id",$newsletter_id)->get();
		return $result;
	}
	
	public function blockunblockTemplate($type='',$newsletter_id=''){
		$status = 0;
		if($type == 1){
			$status = 1;
		}
		$result = $this->db->update("newsletter", array("newsletter_status" => $status),array("newsletter_id" => $newsletter_id));
		return count($result);
	}
	
	public function deleteTemplate($newsletter_id=''){
		$result = $this->db->delete("newsletter",array("newsletter_id" => $newsletter_id ));
		return count($result);
	}
	
	public function get_merchant_email($merchant_id="")
	{
		$result=$this->db->select("email")->from("users")->where(array("user_id" =>$merchant_id))->get();
		return $result->current()->email;
	}
	public function get_merchant_store_name($store_id="")
	{
		$result=$this->db->select("store_name")->from("stores")->where(array("store_id" =>$store_id))->get();
		return $result->current()->store_name;
		
	}
	
	public function get_sector_data($sector_id="")
	{
		$result=$this->db->select("sector_name")->from("sector")->where(array("sector.sector_id" => $sector_id))->get();
		return $result;
	
	}
	public function get_store_details($store_id="")
	{
		$result=$this->db->from("stores")->where(array("store_id" =>$store_id))->get();
        return $result;
	}
	
}
