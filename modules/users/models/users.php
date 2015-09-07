<?php defined('SYSPATH') or die('No direct script access.');
class Users_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db=new Database();
		$this->session = Session::instance();
		$this->city_id = $this->session->get("CityID");
		$this->UserID = $this->session->get("UserID");
		
	}
	
	/** GET LOGIN DETAILS **/
	
	/*
		TODO
		Added club membership status to session to support 
		previous implementations for now.
		This has to be replaced with the vendor's implementation that
		users prime_customer session value.
		@Live
	*/
	public function login_users($email = "",$password = "", $z_offer = "0")
	{ 
		$result = $this->db->from("users")->where(array("email" => $email, "password" =>  md5($password),"user_type" =>4))->get();
		if(count($result) == 1){
			foreach($result as $a){
				if($a->user_status == 1){ 
						
				        $this->session->set(array("UserID" => $a->user_id, "UserName" => $a->firstname , "UserEmail" => $a->email, "city_id" => $a->city_id,"UserType" => $a->user_type, "Club" => $a->club_member));
				        if($a->unique_identifier !="" && $a->user_auto_key !="") {
							$this->session->set("user_auto_key",$a->user_auto_key);
							$this->session->set("prime_customer",1);
						}
						
						if(strcmp($z_offer, "1") == 0)
				        	return -999;
				        return 1;
				}
				else if($a->user_status == 0){
				        return 8;
				}
				else{
				        return -1;
				}
			}
		} else { return -1; }
	}
	
	    /** REGISTER USERS **/

	    public function add_users($post = "" , $user_referral_id = "")
	    {
			
		$referral_id = text::random($type = 'alnum', $length = 8);
		if($post->unique_identifier !=""){ 
			$user_auto_key = text::random($type = 'alnum', $length = 4);
			$this->session->set("user_auto_key",$user_auto_key);
			$this->session->set("prime_customer",1);
		} else {
			$user_auto_key ="";
			$this->session->set("prime_customer",0);
		}
		
		
		$result_country = $this->db->select("country_id")->from("city")->where(array("city_id" => $post->city ))->limit(1)->get();
		$country_value = $result_country->current()->country_id;
		$referred_user_id = 0;
		
		if($user_referral_id)
		{
		$result_referral = $this->db->select("user_id")->from("users")->where(array("referral_id" =>$user_referral_id))->limit(1)->get();
			if(count($result_referral)){
				$referred_user_id  = $result_referral->current()->user_id;
			}
		}
		
		
		$result = $this->db->insert("users", array("firstname" => $post->f_name, "email" => $post->email, "password" =>  md5($post->password),"city_id" => $post->city, "country_id" => $post->country, "referral_id" => $referral_id, "referred_user_id" =>$referred_user_id, "joined_date" => time(),"last_login" => time(), "user_type"=> 4,"gender" =>$post->gender,"age_range"=>$post->age_range,"unique_identifier"=>$post->unique_identifier,"user_auto_key"=>$user_auto_key));
		
		$result_city = $this->db->select("category_id,city_id")->from("email_subscribe")->where(array("email_id" =>$post->email))->get();
		        if(count($result_city) > 0) {
                        $city_subscribe = $result_city->current()->city_id;
                        $city_subscribe .=",".$post->city;
                        $result = $this->db->update("email_subscribe", array("user_id" =>$result->insert_id(),"category_id"=> $city_subscribe),array("email_id" => $post->email));		        
                        } else {
                        $category_result = $this->db->query("select * from category   where type = 1 and category_status = 1  ORDER BY RAND() LIMIT 1");
			$category_subscribe = $category_result->current()->category_id;
		        $result_email_subscribe = $this->db->insert("email_subscribe", array("user_id" => $result->insert_id(), "email_id" => $post->email,"city_id" => $post->city,"country_id" =>$post->country,"category_id" =>$category_subscribe));
  		      }
		/*
			TODO
			Add club member to this session.
			@Live
		*/
		$this->session->set(array("UserID" => $result->insert_id(), "UserName" => $post->f_name, "UserEmail" => $post->email, "city_id" => $post->city, "UserType" => 4, "Club" => 0));
		
		return 1;
	}
	
	/** REGISTER FACEBOOK USERS **/

	public function register_facebook_user($fb_profile = array(), $city_id="", $fb_access_token = "",$user_referral_id = "",$password = "")
	{ 
		$result_country = $this->db->from("city")->where(array("default" =>1))->limit(1)->get();
		$fb_profile_email=$this->session->get('fb_email');
		$country_value = "";
		if(count($result_country) >0 ){
		$country_value = $result_country->current()->country_id; 
		$city_id = $result_country->current()->city_id; 
		}
				                              
		$result = $this->db->from("users")->where(array("email" => $fb_profile_email))->limit(1)->get();
		if(count($result) == 0){
			$fb_image_url = "http://graph.facebook.com/".$fb_profile->id."/picture";
			//$password = text::random($type = 'alnum', $length = 10);
			$store_key = text::random($type = 'alnum', $length = 10);
			$referral_id = text::random($type = 'alnum', $length = 10);
			$referred_user_id = 0;
			if($user_referral_id)
		    {
		        $result_referral = $this->db->select("user_id")->from("users")->where(array("referral_id" =>$user_referral_id))->limit(1)->get();
			    if(count($result_referral)){
				    $referred_user_id  = $result_referral->current()->user_id;
			    }
		    }
			
			$insert = $this->db->insert("users",array("firstname" => $fb_profile->name/*, "lastname" => $fb_profile->last_name */, "email" => $fb_profile_email, "password" => md5($password), "city_id" => $city_id , "country_id" => $country_value,"referral_id" => $referral_id,"referred_user_id" =>$referred_user_id,"joined_date" => time(), "last_login" => time(),  "fb_user_id" => $fb_profile->id , "fb_session_key" => $fb_access_token ,"login_type"=>"3"));

			$result_city = $this->db->select("category_id")->from("email_subscribe")->where(array("email_id" =>$fb_profile_email))->get();
			if(count($result_city) > 0){
						$city_subscribe = $result_city->current()->category_id;
						$result = $this->db->update("email_subscribe", array("user_id" =>$insert->insert_id(),"category_id" =>$city_subscribe),array("email_id" => $fb_profile_email));
				
					} else {
				$category_result = $this->db->query("select * from category   where type = 1 and category_status = 1  ORDER BY RAND() LIMIT 1");
				$category_subscribe = $category_result->current()->category_id;
				$result_email_subscribe = $this->db->insert("email_subscribe", array("user_id" => $insert->insert_id(),"email_id" => $fb_profile_email,"category_id" => $category_subscribe));
  		                        }
			$this->session->set(array("UserID" => $insert->insert_id(), "UserName" => $fb_profile->name, "UserEmail" => $fb_profile_email, "fb_access_token" => $fb_access_token,"UserType" => "4"));
			
			if($fb_image_url){
				$image = file_get_contents($fb_image_url);
				$file = DOCROOT.'images/user/150_115/'.$insert->insert_id().".jpg";
				file_put_contents($file, $image);
			}
			
			
		} else {
			$userid = $result->current()->user_id;
			$name = $result->current()->firstname;
			$user_type = $result->current()->user_type;
			$this->session->set(array("UserID" => $userid, "UserName" => $name, "UserEmail" => $fb_profile_email,"UserType" => $user_type));
			return 1;
		}
		
		return $insert->insert_id();
	}
	
	/** REGISTER FACEBOOK USERS **/

	public function facebook_share_user($fb_profile = array(), $fb_access_token = "")
	{
            $fb_image_url = "http://graph.facebook.com/".$fb_profile->id."/picture";		
	        $result = $this->db->update("users", array("fb_user_id" => $fb_profile->id , "fb_session_key" => $fb_access_token , "facebook_update" => "1"), array("user_id" =>$this->UserID));

			if($fb_image_url){
				$image = file_get_contents($fb_image_url);
				$file = DOCROOT.'images/user/150_115/'.$this->UserID.".jpg";
				file_put_contents($file, $image);
			}
		return;
	}
	
	/** CHECK USER EXIST **/
	
	public function check_user_exist($email = "", $z_offer = "0")
	{
		$result = $this->db->from('users')->where(array('email' => $email))->get();
		if(count($result) == 0){
			if(strcmp($z_offer, "1") == 0)
				return -999;
			return 1;
		}
		return -1;
	}
	
	  /** CHECK PASSWORD **/
    
	public function exist_password($pass = "", $id = "")
	{
		$result = $this->db->count_records('users', array('user_id' => $id, 'password' => md5($pass)));
		return (bool) $result;
	}

	/** GET USER DETAILS **/
	
	public function get_users_details()
	{
		$result = $this->db->from("users")
				   ->where(array("user_id" => $this->UserID))
				   ->get();
		return $result;
	}

	/** GET USERS LIST **/

	public function get_user_data_list()
	{
		$result = $this->db->from("users")
				   ->join("city","city.city_id","users.city_id")
				   ->join("country","country.country_id","city.country_id")
				   ->where(array("user_id" => $this->UserID))
				   ->get();
		return $result;
	}

	/** UPDATE USERS **/

	public function update_user($post = array(),$cat_pref="")
	{
		$category_preference = "";
	        if($cat_pref != ""){
                        foreach($cat_pref as $cat_preference)
                        {
                               $category_preference .= $cat_preference.',';
                        }
                        $category_preferences = rtrim($category_preference, ',');
                }else {
	                $category_preferences = 0;
		
                }		
		$result = $this->db->update("users", array("firstname" => $post->firstname,"lastname" => $post->lastname, "email" => $post->email,'address1' => $post->address1, 'address2' => $post->address2,'phone_number' => $post->mobile,'my_favouites'=>$category_preference), array("user_id" =>$this->UserID));
		return 1;
	}

	 /** GET USERS CATEGORY LIST **/

	public function get_users_category_list()
	{
		$result = $this->db->select("my_favouites")->from("users")
		->where(array("user_id" => $this->UserID))->limit(1)->get();
		return $result; 
	}

	/** GET USERS CITY LIST **/

	public function get_users_city_list($user_id = "")
	{
		$result = $this->db->select("newsletter_city")->from("users")->where(array("user_id" => $this->UserID))->limit(1)->get();
		return $result;
	}

   	/** GET DEALS CATEGORY LIST **/

	public function get_gategory_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	/** ALL COUNTRY LIST **/

	public function allCountryList()
	{
		$result = $this->db->from("country")->where(array("country_status" => 1)) ->orderby("country.country_name", "ASC")->get();
		return $result;
	}

	/** UPDATE EMAIL **/

	public function update_email($post,$userid)
	{
		$result = $this->db->update("users", array("email" => $post->email), array("user_id" => $userid));
		return 1;
	}

    /** UPDATE REFERRAL BALANCE **/

	public function get_users_details_amount($refamount)
	{
		$result = $this->db->update("users", array("user_referral_balance" => $refamount), array("user_id" => $this->UserID));
		return 1;
	}
	
	/** UPDATE PASSWORD **/

	public function update_Password($post)
	{
		$result = $this->db->update("users", array("password" => md5($post->password)), array("user_id" => $this->UserID));
		return 1;
	}

	/** GET USER DETAILS **/

	public function user_details()
	{
		$result = $this->db->from("users")
				->join("city","city.city_id","users.city_id")
				->where(array("user_id" => $this->UserID))
				->get();
		return $result;
	}
	
	/** CHECK EMAIL EXIST **/

	public function exist_email($email = "")
	{
		$result = $this->db->count_records('users', array('email' => $email));
		return (bool) $result;
	}

	/** CHEXK OLD PASSWORD **/

	public function oldpassword($pass = "")
	{
		$result = $this->db->from('users')->where(array("user_id" => $this->UserID, 'password'=> md5($pass)))->get();
		return count($result);

	}
	/* GET DEALS  BOUGHT  COUNT*/
	public function get_user_bought($uid = "")
	{
		$result = $this->db->delete('deals', array('deal_key' => $uid));
		return count($result);
	}

	/** CITY SETTINGS UPDATED**/

	public function update_city_settings($citysubs = array())
	{
		$city_subscribe = "";

		foreach($citysubs as $cc){
			 $city_subscribe .= $cc.',';
		}
		$city_subscribe = rtrim($city_subscribe, ',');
		if($city_subscribe){
			$result = $this->db->update("users", array("newsletter_city" => $city_subscribe), array("user_id" => $this->UserID));
		}
		return 1; 
	}

	/** CATEGORY SETTINGS UPDATED**/

	public function update_category_preference($cat_pref = "")
	{
	        $category_preference = "";
	        if($cat_pref != ""){
                        foreach($cat_pref as $cat_preference)
                        {
                               $category_preference .= $cat_preference.',';
                        }
                        $category_preferences = rtrim($category_preference, ',');
                }else {
	                $category_preferences = 0;
                }
		$result = $this->db->update("users", array("newsletter_category" => $category_preferences), array("user_id" => $this->UserID));
		return 1;
	}

	/** FORGOT PASSWORD **/

	public function forgot_password($email = "")
	{
		$email = trim($email);
		$result = $this->db->from("users")->where(array("email" => $email))->limit(1)->get();
		if(count($result) > 0){
		        $result_new = $this->db->from("users")->where(array("email" => $email,"user_status"=>1))->limit(1)->get();
		        if(count($result_new) == 0){
		                return -2;
		        }
			$password = text::random($type = 'alnum', $length = 10);
			$userid = $result->current()->user_id;
			$name = $result->current()->firstname;
			$email = $result->current()->email;
			
			$results['name']=$result->current()->firstname;
			$results['email']=$result->current()->email;
			$results['password']=$password;
			$result1=$this->db->update("users",array("password" => md5($password) ), array("user_id" => $userid));
			if($result1){
					return $results;	
				}
		}
		else{
			return 0;
		}
	}

	/* GET DEALS BOUGHT DATA */
	
	public function get_deals_bought()
	{
		$result = $this->db->from("cms")->where(array("cms_id" => 7))->get();
		return $result;
	}

 	/* GET COPY RIGHT  DATA */
	public function get_copy_right()
	{
		$result = $this->db->from("cms")->where(array("cms_id" => 8))->get();
		return $result;
	}
	
	public function get_user_bought_product($uid = "")
	{
		$result = $this->db->delete('product', array('deal_key' => $uid));
		return count($result);
	}
	
       /** GET COUNTRY LIST **/
	public function getcountrylist()
        {
		$result = $this->db->from("country")
                        ->orderby("country.country_name", "ASC")
		        ->where(array("country_status" => '1'))->get();
		return $result;
	}
	
        /** GET CITY LIST **/
	public function getCityList()
        {
        $result = $this->db->from("city")
                            ->join("country","country.country_id","city.country_id")
                            ->orderby("city.city_id", "ASC")
                            ->where(array("city_status" => '1'))
                            ->get();
        return $result;
        }
	
	/** GET CITY LIST BY COUNTRY **/
	public function get_city_by_country($country){
		$result = $this->db->from("city")->where(array("country_id" => $country, "city_status" => '1'))->orderby("city_name")
		->get();
		return $result;
	}
	
	/**GET DELAS COUPONS LIST COUNT**/

	public function get_deals_coupons_list_count()
	{
		$result = $this->db->from("transaction")
                ->where(array("transaction.user_id" => $this->UserID,"transaction_mapping.user_id" => $this->UserID))
                ->join("deals","deals.deal_id","transaction.deal_id")
                ->join("transaction_mapping","transaction_mapping.transaction_id","transaction.id")
                ->join("stores","stores.store_id","deals.shop_id")
                ->orderby("transaction.transaction_date","DESC")
                ->get();
		return count($result);
	}

	/**GET DELAS COUPONS LIST**/

	public function get_deals_coupons_list($offset = "", $record = "")
	{
		$result = $this->db->select("*","transaction.type as trans_type","transaction.id as trans_id")->from("transaction")
                    ->where(array("transaction.user_id" => $this->UserID,"transaction_mapping.user_id" => $this->UserID))
                    ->join("deals","deals.deal_id","transaction.deal_id")
                    ->join("transaction_mapping","transaction_mapping.transaction_id","transaction.id")
                    ->join("stores","stores.store_id","deals.shop_id")
                    ->limit($record, $offset)
                    ->orderby("transaction.transaction_date","DESC")
                    ->get();
		return $result;	
	}

		/**GET PRODUCTS COUPONS LIST COUNT**/

	public function get_products_coupons_list_count()
	{

		$result = $this->db->select('*','shipping_info.adderss1 as saddr1','shipping_info.address2 as saddr2','users.phone_number','transaction.id as trans_id','stores.address1 as addr1','stores.address2 as addr2','stores.phone_number as str_phone','transaction.shipping_amount as shipping','transaction.type as pay_type')->from("shipping_info")
                    ->where(array("shipping_type"=>1,"shipping_info.user_id" => $this->UserID))
                    ->join("users","users.user_id","shipping_info.user_id") 					
                    ->join("transaction","transaction.id","shipping_info.transaction_id")  
		    ->join("product","product.deal_id","transaction.product_id") 
		    ->join("stores","stores.store_id","product.shop_id") 
		    ->join("city","city.city_id","shipping_info.city")    
		      
                    ->orderby("shipping_id","DESC")

                    ->get(); 
		return count($result);	
                
	}
	/**GET PRODUCTS COUPONS LIST**/

	public function get_products_coupons_list($offset = "", $record = "")
	{

		$result = $this->db->select('*','shipping_info.adderss1 as saddr1','shipping_info.address2 as saddr2','users.phone_number','transaction.id as trans_id','stores.address1 as addr1','stores.address2 as addr2','stores.phone_number as str_phone','transaction.shipping_amount as shipping','stores.city_id as str_city_id','transaction.store_credit_period','transaction.type as pay_type')->from("shipping_info")
                    ->where(array("shipping_type"=>1,"shipping_info.user_id" => $this->UserID))
                    ->join("users","users.user_id","shipping_info.user_id") 					
                    ->join("transaction","transaction.id","shipping_info.transaction_id")  
					->join("product","product.deal_id","transaction.product_id") 
					->join("stores","stores.store_id","product.shop_id") 
					->join("city","city.city_id","shipping_info.city") 
		       ->limit($record, $offset)               
                    ->orderby("shipping_id","DESC")

                    ->get(); 
		return $result;	
	}

	/**GET PRODUCTS COUPONS LIST**/

	public function get_auctions_coupons_list()
	{
		$result = $this->db->select('*','shipping_info.adderss1 as de_add1','shipping_info.address2 as de_add2','transaction.type as pay_type',"transaction.id as trans_id")->from("shipping_info")
                    ->where(array("shipping_type"=>2,"shipping_info.user_id" => $this->UserID))
                    ->join("users","users.user_id","shipping_info.user_id") 					
                    ->join("transaction","transaction.id","shipping_info.transaction_id")  
					->join("auction","auction.deal_id","transaction.auction_id") 
					 ->join("stores","stores.store_id","auction.shop_id")                
                    ->orderby("shipping_id","DESC")

                    ->get(); 
		return $result;	
                
	}
	
	/** GET USER REFERAL LIST**/

	public function user_refrel_list_count()
	{
		$result = $this->db->from("users")
                        ->where(array("user_status"=>1,"referred_user_id" => $this->UserID))
                        ->get();
		return count($result);
			
	}
	/* GET USER BOUGHT AUCTION */
	public function get_user_bought_boughtau($uid = "")
	{
		$result = $this->db->delete('auction', array('deal_key' => $uid));
		return count($result);
	}
	/** GET USER REFERAL LIST**/

	public function user_refrel_list($offset = "", $record = "")
	{
		$result = $this->db->from("users")
                        ->where(array("referred_user_id" => $this->UserID))
			->limit($record, $offset)
                        ->get();

		return $result;
	}
	
	/** GET USER WINNER LIST**/

	public function user_winner_list_count()
	{
		$result = $this->db->from("bidding")->select("bidding.bid_id")->join("auction","auction.deal_id","bidding.auction_id")->join("stores","stores.store_id","auction.shop_id")->where(array("auction.deal_status" => 1,"bidding.user_id" => $this->UserID))->orderby("bidding_time","DESC")->get();
		return count($result);
	}

	/** GET USER WINNER LIST**/

	public function user_winner_list($offset = "", $record = "")
	{
		$result = $this->db->from("bidding")->select("auction.deal_title","auction.deal_value","auction.url_title","auction.deal_key","bidding.bid_amount","bidding.shipping_amount","bidding.bidding_time","stores.store_url_title")->join("auction","auction.deal_id","bidding.auction_id")->join("stores","stores.store_id","auction.shop_id")->where(array("auction.deal_status" => 1,"bidding.user_id" => $this->UserID))->orderby("bidding_time","DESC")->limit($record,$offset)->get();
		return $result;
	}
	/** GET DEALS CATEGORY LIST **/

	public function get_category_list()
	{
		$result = $this->db->from("category")
		->where(array("category_status" => 1,"main_category_id" =>0))->orderby("category_name","ASC")->get();
		return $result; 
	}
	/** GET DEALS CATEGORY LIST **/

	public function get_city_list()
	{
		$result = $this->db->from("city")
		->join("country","country.country_id","city.country_id")
		->where(array("city_status" => 1,"country_status" => 1))
		->orderby("city.city_name", "ASC")
		->get();

		return $result;
	}

	/** CATEGORY AND SETTINGS UPDATED**/

	public function update_preference($city_subscribe="",$cat_subscribe = "")
	{	
		
		if(CITY_SETTING) {
		$city_value = "";
	        if(count($city_subscribe)!= "" && count($city_subscribe)!= 0 ){
                        foreach($city_subscribe as $city_preference)
                        {
                               $city_value .= $city_preference.',';
                        } 
                        $city_value1 = rtrim($city_value, ',');
                } else {
	                $city_value1 = 0;
                }           
	        $category_value = "";
	        if($cat_subscribe != ""){
                        foreach($cat_subscribe as $preference)
                        {
                               $category_value .= $preference.',';
                        }
                        $category_value1 = rtrim($category_value, ',');
                }else {
	                $category_value1 = 0;
                }  
                $result = $this->db->update("email_subscribe", array("city_id" => $city_value1,"category_id" => $category_value1), array("user_id" => $this->UserID));

		return count($result);
		} else {
			
	        $category_value = "";
	        if($cat_subscribe != ""){
                        foreach($cat_subscribe as $preference)
                        {
                               $category_value .= $preference.',';
                        }
                        $category_value1 = rtrim($category_value, ',');
                }else {
	                $category_value1 = 0;
                }  
                $result = $this->db->update("email_subscribe", array("category_id" => $category_value1), array("user_id" => $this->UserID));

		return count($result);
		}
	}

	 /** GET USERS CITY LIST **/

	public function get_users_select_list()
	{
		$result = $this->db->select("city_id,email_id,user_id,suscribe_city_status")->from("email_subscribe")
		               ->where(array("user_id" => $this->UserID))->limit(1)->get();
		return $result;
	}
	
	 /** GET USERS SELECT CATEGORY LIST **/

	public function get_users_select_list1()
	{
		$result = $this->db->select("category_id")->from("email_subscribe")
		               ->where(array("user_id" => $this->UserID))->limit(1)->get();
		return $result; 
	}

	/** GET CITY DATA **/

	public function get_city_data($city_id = ""){
		$result = $this->db->from("city")->where(array("city_id" => $city_id))->get();
		return $result;	
	}

	/** BLOCK UNBLOCK SUBSCRIBE **/
	
	public function blockunblocksubscriber($type = "",$user_id = "" )
	{  
		$status=0;
        	if($type == 1){
          	$status=1;
        }
        	$result = $this->db->update("email_subscribe", array("suscribe_city_status" => $status), array("user_id" => $user_id));
        	return count($result);
	}

	/** UPDATE  FACEBOOK WALL **/

	public function update_facebook_wal($facebook ="")
	{
		    $result = $this->db->update("users", array("facebook_update" =>$facebook), array("user_id" =>$this->UserID));
			return 1;
	}

	/**GET DELAS COUPONS LIST PDF GENERATE**/

	public function get_deals_coupons($deal_coupon_code="")
	{
	         $result = $this->db->from("transaction_mapping")
                            ->where(array("transaction_mapping.user_id" => $this->UserID,"transaction.user_id" => $this->UserID,"transaction_mapping.coupon_code"=>$deal_coupon_code))
                            ->join("deals","deals.deal_id","transaction_mapping.deal_id")
                            ->join("transaction","transaction.deal_id","deals.deal_id")
                            ->join("stores","stores.store_id","deals.shop_id")
                             ->join("city","city.city_id","stores.city_id")
                            ->join("country","country.country_id","stores.country_id")
                            ->get();                 
		
                return $result;

	}
	
	/**GET DELAS COUPONS LIST PDF GENERATE**/

	public function get_deals_coupons_mail($deal_coupon_code="")
	{
	         $result = $this->db->from("transaction_mapping")
                            ->where(array("transaction_mapping.coupon_code"=>$deal_coupon_code))
                            ->join("deals","deals.deal_id","transaction_mapping.deal_id")
                            ->join("transaction","transaction.deal_id","deals.deal_id")
                            ->join("stores","stores.store_id","deals.shop_id")
                            ->join("city","city.city_id","stores.city_id")
                            ->join("country","country.country_id","stores.country_id")
                            ->get();                 
		
                return $result;
	}
	
	/** CITY SUBSCRIBE **/
	
	public function subscribe_city($post="")
	{
	        $result_city = $this->db->select("category_id")->from("email_subscribe")->where(array("email_id" =>$post->subscribe_email))->get();             
		if(count($result_city) > 0){
			$city = array_unique(explode(',',$result_city[0]->category_id)); //convert the cites to array and remove duplicate values
		        $city_subscribe = $result_city->current()->category_id;
		        $city_subscribe .=",".$post->city_id;
			if (in_array($post->city_id,$city,TRUE)){ // check the city is subscribed 
                        return -3;
			} else {
			$result = $this->db->update("email_subscribe", array("category_id" =>$city_subscribe), array("email_id" => $post->subscribe_email));
			return 1;   
		      }
                }
 	        else{
	                 $result = $this->db->insert("email_subscribe", array("category_id" => $post->city_id,"email_id" => $post->subscribe_email));
					//$admin_email = $this->db->select('email')->from('users')->where(array('user_type' => 1))->limit(1)->get();
	                return 1;
  		}
     }
        
        /** CATEGORY SUBSCRIBE **/
        
        public function subscribe_category($post="")
	    {
	
	        $result_category = $this->db->select("category_id")->from("email_subscribe")->where(array("email_id" => $post->subscribe_email))->get();
		    if(count($result_category) > 0){
		        $category_subscribe = $result_category->current()->category_id;
		        $category_subscribe .=",".$post->category_id;
                        $result = $this->db->update("email_subscribe", array("category_id" =>$category_subscribe), array("email_id" => $post->subscribe_email));
                        
		                return 1;
            } else {
	                 $result = $this->db->insert("email_subscribe", array("category_id" => $post->category_id,"email_id" => $post->subscribe_email));
	                return 1;
  		    }
  		
        }


	/* UPDATE PHONE */
	public function update_phone($phone="")
	{ 		
		$result = $this->db->update("users", array("phone_number" => $phone), array("user_id" =>$this->UserID));
		return $result;
	}
	/* UPDATE USERS ADDRESS */
	public function update_address($address1 = "",$address2 =" ")
	{ 		
		$result = $this->db->update("users", array("address1" => $address1,"address2" =>$address2), array("user_id" =>$this->UserID));
		return $result;
	}
	/* UPDATE CITY */
	public function update_city($city = "")
	{ 		
		$result = $this->db->update("users", array("city_id" => $city), array("user_id" =>$this->UserID));
		return $result;
	}
	/*UPDATE COUNTRY */
	public function update_country($country = "")
	{ 
		$result = $this->db->update("users", array("country_id" => $country), array("user_id" =>$this->UserID));
		return $result;
	}
		/** GET EDIT followup **/
	
	public function get_edit_name($user_id = "")
	{
		$result = $this->db->from('users')->where(array("user_id" => $user_id))->get();												
		return $result;	
	}
		
			/** UPDATE PROFILE **/
	public function update_user_info($user_id  = "",$first_name="",$last_name="")
	{ 		
		$result = $this->db->update("users", array("firstname" => $first_name,"lastname" =>$last_name), array("user_id" =>$user_id));
		return $result;
	}
			/** GET EDIT followup **/
	public function update_user_password($old_pass = "",$new_pass = "")
	{ 	
			
		$result = $this->db->from('users')->select('password')->where(array("user_id" =>$this->UserID,"password"=>md5($old_pass)))->get();
		if(count($result) == 1){ 
			$result1 = $this->db->update("users", array("password" =>md5($new_pass)), array("user_id" =>$this->UserID)); 
			return count($result1);
		}
		else{  echo "-1";   }
	}
	/* GET SHIPPING PRODUCT COLOR */
	public function get_shipping_product_color()
	{
		$result = $this->db->from("color_code")->get();
		return $result;
	}
	
	/* GET PRODUCT SHIPPING PRODUCT SIZE */
	public function get_shipping_product_size()
	{
		$result = $this->db->from("size")->get();
		return $result;
	}
	
	/** UPDATE USER SHIPPING INFO **/

	public function update_shipping_address($post = array())
	{ 
			
		$result = $this->db->update("users", array("ship_name" => $post->firstname,"ship_address1" => $post->address1, "ship_address2" => $post->address2,"ship_mobileno" => $post->mobile,"ship_city"=>$post->city,"ship_country" => $post->country,"ship_state" => $post->state,"ship_zipcode" =>$post->zip_code), array("user_id" =>$this->UserID));
		return 1;
	}
	/* UPDATE GENDER */
	public function update_gender($gender="") 
	{
		$result = $this->db->update("users", array("gender" => $gender), array("user_id" => $this->UserID));
	}
	/* UPDATE  AGE RANGE */
	public function update_agerange($update_age_range="") 
	{
		$result = $this->db->update("users", array("age_range" => $update_age_range), array("user_id" => $this->UserID));
	}
	
	/**  UPDATE UNIQUE IDENTIFIER**/
	public function update_unique_identifier($unique_identifier="")
	{
		if($unique_identifier !=""){ 
			$user_auto_key = text::random($type = 'alnum', $length = 4);
			$this->session->set("user_auto_key",$user_auto_key);
			$this->session->set("prime_customer",1);
		} else {
			$user_auto_key ="";
			$this->session->delete("user_auto_key");
			$this->session->set("prime_customer",0);
		}
		$result = $this->db->update("users", array("unique_identifier" => $unique_identifier,"user_auto_key"=>$user_auto_key), array("user_id" => $this->UserID));print_r($result);exit;
	}
	
	public function get_gift($gift_id="")
	{
		$resulkt=$this->db->select("gift_name")->from("free_gift")->where(array("gift_status" => 1,"gift_id" =>$gift_id))->get();
		return $resulkt;
	}
	
	public function update_bank_deposit_document($trans_id='',$file_name=''){
		$result = $this->db->update('transaction',array('file_name'=>base64_encode($trans_id).'_'.$file_name),array('id'=>$trans_id));
		return 1;
	}
	
	public function add_email_subscriber($email="")
	{
		$result = $this->db->count_records("email_subscribe",array("email_id"=>$email));
		if($result==0)
			$this->db->insert("email_subscribe",array("email_id"=>$email));
		return 1;
	}
	/** GET USER STORECREDIT PURCHASE LIST COUNT **/

	public function user_storecredit_list_count()
	{
		$result = $this->db->from("storecredit_transaction")->select("store_credit_save.storecredit_id")->join("product","product.deal_id","storecredit_transaction.product_id")->join("stores","stores.store_id","product.shop_id")->join("store_credit_save",array("store_credit_save.userid"=>"storecredit_transaction.user_id","store_credit_save.storecredit_id"=>"storecredit_transaction.main_storecreditid"),"left")->where(array("product.deal_status" => 1,"storecredit_transaction.user_id" => $this->UserID,"credit_status"=>4))->groupby("storecredit_transaction.transaction_id")->orderby("storecredit_transaction_date","DESC")->get();
		/* $result = $this->db->from("store_credit_save")->select("store_credit_save.storecredit_id")->join("product","product.deal_id","store_credit_save.productid")->join("storecredit_transaction","storecredit_transaction.user_id","store_credit_save.userid")->join("stores","stores.store_id","product.shop_id")->where(array("product.deal_status" => 1,"store_credit_save.userid" => $this->UserID))->orderby("storecredit_transaction_date","DESC")->get();
		 */
		return count($result);
	}
	
	/** GET USER STORECREDIT PURCHASE LIST**/

	public function user_storecredit_list($offset = "", $record = "")
	{
		$result = $this->db->from("storecredit_transaction")->select("product.deal_title","store_credit_save.product_value","product.url_title","product.deal_key","store_credit_save.duration_period","store_credit_save.shipping_amount","store_credit_save.storecredit_id","store_credit_save.userid","storecredit_transaction.product_id","store_credit_save.installments_paid","storecredit_transaction.storecredit_transaction_date","stores.store_url_title")->join("product","product.deal_id","storecredit_transaction.product_id")->join("stores","stores.store_id","product.shop_id")->join("store_credit_save",array("store_credit_save.userid"=>"storecredit_transaction.user_id","store_credit_save.storecredit_id"=>"storecredit_transaction.main_storecreditid"),"left")->where(array("product.deal_status" => 1,"storecredit_transaction.user_id" => $this->UserID,"credit_status"=>4))->groupby("storecredit_transaction.transaction_id")->orderby("storecredit_transaction_date","DESC")->limit($record,$offset)->get();
		return $result;
	}
	
	/* GET USER STORECREDIT LIST COUNT */
	public function storecredit_list_count()
	{
		$result = $this->db->query("select storecredit_id from store_credit_save as s join product on product.deal_id = s.productid join stores on stores.store_id = product.shop_id where deal_status =1 and store_status =1 and userid = $this->UserID and credit_status !=4");
		return count($result);
		
	}
	
	/* GET USER STORECREDIT LIST */
	public function storecredit_list($offset = "",$record = "")
	{
		$result = $this->db->query("select * from store_credit_save as s join product on product.deal_id = s.productid join stores on stores.store_id = product.shop_id where deal_status =1 and store_status =1 and userid = $this->UserID and credit_status !=4 order by s.storecredit_id DESC limit $offset,$record");
		return $result;
	}
	
	
}
