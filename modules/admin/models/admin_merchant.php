<?php defined('SYSPATH') or die('No direct script access.');
class Admin_merchant_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db=new Database();
		$this->session = Session::instance();	
		$this->user_id = $this->session->get("user_id");
	}
	
	/** ADD MERCHANT ACCOUNT **/
	 
        public function add_merchant($post = "" ,$adminid = "",$store_key = "",$password="",$store_admin_password='')
        {
               // $password = text::random($type = 'alnum', $length = 8);
                 
            	$result = $this->db->insert("users", array("firstname" => $post->firstname,"lastname" => $post->lastname, "email" => $post->email, 'password' => md5($password), 'address1' => $post->mr_address1, 'address2' => $post->mr_address2, 'city_id' => $post->city, 'country_id' => $post->country, 'phone_number' => $post->mr_mobile, 'payment_account_id'=> $post->payment_acc,'created_by'=>$adminid, 'user_type'=>'3','login_type'=>'2', "joined_date" => time(),'merchant_commission' => $post->commission));
            	
                $merchant_id = $result->insert_id();                 
                echo $this->session->set("id",$merchant_id);
                
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
                $result = $this->db->insert("shipping_module_settings", array("free" => $free,"flat" => $flat, "per_product" => $product,'per_quantity' => $quantity, 'aramex' => $aramex,'ship_user_id' => $merchant_id));
                $website="http://".$post->website;
                
                $res = $this->db->insert("users",array("firstname"=>$post->username,"email"=>$post->store_email,"password"=>md5($store_admin_password),"user_type"=>9,"created_by"=>$merchant_id,"referred_user_id"=>$merchant_id,"user_status"=>1,"login_type"=>1,"approve_status"=>1,"address1"=>$post->address1,"address2"=>$post->address2,"city_id"=>$post->city,"country_id"=>$post->country, 'phone_number' => $post->mobile,"user_sector_id"=>$post->subsector));
                
                $stores_result = $this->db->insert("stores", array("store_name" => $post->storename,"store_url_title" => url::title($post->storename),'store_key' =>$store_key,'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $post->country, 'phone_number' => $post->mobile, 'zipcode' => $post->zipcode,"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description, 'website' => $website, 'latitude' => $post->latitude, 'longitude' => $post->longitude,'store_type' => '1','merchant_id'=>$merchant_id,'created_by'=>$adminid,"created_date" => time(),"about_us"=>$post->about_us,"store_admin_id"=>$res->insert_id(),'store_sector_id' => $post->sector,"store_subsector_id" =>$post->subsector));

                $result = $this->db->insert("merchant_attribute", array("merchant_id" => $merchant_id,"storeid" =>$stores_result->insert_id()));
                   $store_id = $stores_result->insert_id();
    
                 return $merchant_id.'_'.$store_id;
        }	
        
        /** ADD MERCHANT SHOP ACCOUNT **/
         
        public function add_merchant_shop($post = "" ,$uid = "",$adminid = "",$store_key = "",$password = "")
        {
            	$website="http://".$post->website;

		$sector = isset($post->sector)?$post->sector:0;
		$subsector = isset($post->subsector)?$post->subsector:0;
            	
            	$res = $this->db->insert("users",array("firstname"=>$post->username,"email"=>$post->store_email,"password"=>md5($password),"user_type"=>9,"created_by"=>$uid,"referred_user_id"=>$uid,"user_status"=>1,"login_type"=>1,"approve_status"=>1,"address1"=>$post->address1,"address2"=>$post->address2,"city_id"=>$post->city,"country_id"=>$post->country, 'phone_number' => $post->mobile));
            	
                $stores_result = $this->db->insert("stores", array("store_name" => $post->storename,"store_url_title" => url::title($post->storename),'store_key' =>$store_key,'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $post->country, "meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description, 'phone_number' => $post->mobile, 'zipcode' => $post->zipcode, 'website' => $website, 'latitude' => $post->latitude, 'longitude' => $post->longitude,'created_by'=>$adminid, 'store_type' => '2','merchant_id'=>$uid,"created_date" => time(),"store_admin_id"=>$res->insert_id(),"store_sector_id"=>$sector,"store_subsector_id"=>$subsector));
                 $result = $this->db->insert("merchant_attribute", array("merchant_id" => $uid,"storeid" =>$stores_result->insert_id()));
                 $merchant_id = $stores_result->insert_id();                 
                 echo $this->session->set("id",$merchant_id);

		 return $merchant_id;
        }	
        
       /** GET COUNTRY LIST **/
       
        public function getcountrylist()
        {
		$result = $this->db->from("country")->where(array("country_status" => '1'))->orderby("country_name")->get();
		return $result;
	    }
	
        /** GET CITY LIST **/
        
	    public function getCityList()
        {
                $result = $this->db->from("city")
                            ->join("country","country.country_id","city.country_id")
                            ->orderby("city.country_id", "ASC")
                            ->where(array("city_status" => '1'))
                            ->get();
                return $result;
        }
        
        /** GET CITY LIST ONLY**/
	    public function getCityListOnly()
        {
                $result = $this->db->from("city")
				->join("country","country.country_id","city.country_id")
				->where(array("city_status" => '1',"country.country_status"=>1))
				->orderby("city.city_name", "ASC")
				->get();
                return $result;
        }
	
	    /** GET COUNTRY BASED CITY LIST **/
	
	    public function get_city_by_country($country = "")
	    {
		    $result = $this->db->from("city")->where(array("country_id" => $country, "city_status" => '1'))->orderby("city_name")->get();
		    return $result;
	    }
	
	    /** USER DETAILS **/
	
	    public function user_details($user_id = "")
	    {
                    $result = $this->db->from("users")
                                    ->where(array("user_id" => $user_id))
                                    ->join("city","city.city_id","users.city_id")
                                    ->join("country","country.country_id","city.country_id")
                                    ->get();
                    return $result;
	    }
			
       /** CHECK PASSWORD **/
    
        public function exist_password($pass = "", $id = "")
        {
                 $result = $this->db->count_records('users', array('user_id' => $id, 'password' => md5($pass)));
	         return (bool) $result;
        }
	
	    /** GET MERCHANT DATA  **/
	
        public function get_merchant_list($offset = "", $record = "",  $name = "", $email = "", $city = "",$sort_type = "",$param = "",$limit ="",$today="", $startdate = "", $enddate = "")
        {
	        $limit1 = $limit !=1 ?"limit $offset,$record":"";
	        $sort = "ASC";
		        if($sort_type == "DESC" ){
			        $sort = "DESC";
		        }
                $contitions = "user_type = 3 and stores.store_type = 1";
                if($_GET){

                        if($city){
                        $contitions .= ' and users.city_id = '.$city;
                        }

                        if($name){
                        $contitions .= ' and firstname like "%'.mysql_real_escape_string($name).'%"';
                        }
                        
                        if($email){
                        $contitions .= ' and email like "%'.mysql_real_escape_string($email).'%"';
                        }
                        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $contitions .= " and users.joined_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $contitions .= " and users.joined_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $contitions .= " and users.joined_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $contitions .= " and ( users.joined_date between $startdate_str and $enddate_str )";	
                        }
			
			$sort_arr = array("name"=>" order by users.firstname $sort","city"=>" order by city.city_name $sort","email"=>" order by users.email $sort","store"=>" order by stores.store_name $sort");

			if(isset($sort_arr[$param])){
				 $contitions .= $sort_arr[$param];
			}

                        $result = $this->db->query("select *,users.address1 as user_address1,users.address2 as user_address2,users.phone_number as user_phone_number from users join stores on stores.merchant_id=users.user_id join city on city.city_id=users.city_id join country on country.country_id=users.country_id where $contitions order by users.user_id DESC $limit1 ");
                }  else {
			$result = $this->db->query("select *,users.address1 as user_address1,users.address2 as user_address2,users.phone_number as user_phone_number from users join stores on stores.merchant_id=users.user_id join city on city.city_id=users.city_id join country on country.country_id=users.country_id where $contitions order by users.user_id DESC $limit1 ");

				}
					
                
                return $result;
         }

        /** GET MERCHANT COUNT DATA  **/
	
        public function get_merchant_count($name = "", $email = "", $city = "",$sort_type = "",$param = "",$today="", $startdate = "", $enddate = "")
        {
				
		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
                $contitions = "user_type = 3 and stores.store_type = 1";
                if($_GET){
                        if($city){
                        $contitions .= ' and stores.city_id = '.$city;
                        }

                        if($name){
                        $contitions .= ' and firstname like "%'.mysql_real_escape_string($name).'%"';
                        }
                        
                        if($email){
                        $contitions .= ' and email like "%'.mysql_real_escape_string($email).'%"';
                        }
                        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $contitions .= " and users.joined_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $contitions .= " and users.joined_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $contitions .= " and users.joined_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $contitions .= " and ( users.joined_date between $startdate_str and $enddate_str )";	
                        }

			$sort_arr = array("name"=>" order by users.firstname $sort","city"=>" order by city.city_name $sort","email"=>" order by users.email $sort","store"=>" order by stores.store_name $sort");

			if(isset($sort_arr[$param])){
	       		 $contitions .= $sort_arr[$param];
		}else{  $contitions .= ' order by users.user_id DESC'; }

				$result = $this->db->query("select *,('user_id'),users.address1 as user_address1,users.address2 as user_address2,users.phone_number as user_phone_number  from users join stores on stores.merchant_id=users.user_id join city on city.city_id=users.city_id join country on country.country_id=users.country_id where $contitions");

                       
                }
                else {

					$result = $this->db->query("select *,('user_id'),users.address1 as user_address1,users.address2 as user_address2,users.phone_number as user_phone_number  from users join stores on stores.merchant_id=users.user_id join city on city.city_id=users.city_id join country on country.country_id=users.country_id where $contitions order by users.user_id DESC ");
				}
                 
                 
                return count($result);
        }
	
	/** GET MERCHANT SHOP DATA  **/
	
        public function get_merchant_list_shop($offset = "", $record = "",  $name = "", $city = "",$uid="")
        {
                $contitions = "merchant_id = $uid";
                if($_GET){
                        if($city){
							
				$contitions .= ' and city_id = '.$city;
                        }

                        if($name){
				$contitions .= ' and store_name like "%'.mysql_real_escape_string($name).'%"';
                        }
                        $result = $this->db->query("select * from stores where $contitions ORDER BY stores.store_id limit $offset, $record");
                        count($result);
                }
                else{
                        $result = $this->db->from("stores")
                                    ->where(array("merchant_id" => $uid))
                                    ->orderby("stores.store_id", "ASC")
                                    ->limit($record, $offset)
                                    ->get();
                }
                return $result;
        }
    
	    /** GET MERCHANT SHOP COUNT DATA  **/
    
        public function get_merchant_shop_count($name = "", $city = "", $uid="")
        {

                  $contitions = "merchant_id = $uid";
                if($_GET){
                        if($city){
							
				$contitions .= ' and city_id = '.$city;
                        }

                        if($name){
				$contitions .= ' and store_name like "%'.mysql_real_escape_string($name).'%"';
                        }
                        $result = $this->db->query("select stores.store_id from stores where $contitions ORDER BY stores.store_id");
                        count($result);
                }
                else{
                        $result = $this->db->select("stores.store_id")->from("stores")
                                    ->where(array("merchant_id" => $uid))
                                    ->orderby("stores.store_id", "ASC")
                                    //->limit($record, $offset)
                                    ->get();
                }
                
                return count($result);
        }
        
	/** GET SINGLE MERCHANT DATA **/
	
	public function get_merchant_data($userid = "")
	{
		
		$result = $this->db->select("*","users.address1 as user_address1","users.address2 as user_address2","users.phone_number as user_phone_number","users.city_id as user_city_id","users.country_id as user_country_id")->from("users")->join("stores","stores.merchant_id","users.user_id")->where(array("user_id" => $userid,"stores.store_type"=>1))->limit(1)->get();

		return $result;
             
	}
	
	
	/** GET SINGLE MERCHANT SHOP DATA **/
	
	public function get_merchant_shop_data($storeid = "")
	{
		$result = $this->db->from("stores")->join("city","city.city_id","stores.city_id")->join("users","users.user_id","stores.store_admin_id","left")->where(array("store_id" => $storeid))->limit(1)->get();
		return $result;
	}
	
	/** GET MERCHANT SHIPPING DATA **/
	
	public function get_shipping_data($userid = "")
	{
		$result = $this->db->from("shipping_module_settings")->where(array("ship_user_id" => $userid))->limit(1)->get();
		return $result;
	}
		     
	/** CHECK EMAIL EXIST **/ 
	
	public function exist_email($email = "")
	{
		$result = $this->db->count_records('users', array('email' => $email));
		return (bool) $result;
	}
	
	
	/** UPDATE MERCHANT **/
	
        public function edit_merchant($id = "" ,$post = "") 
        {
                $result_emailid = $this->db->count_records("users", array("email" => $post->email,"user_id !=" => $id));
                        if($result_emailid == 0){
                                $result = $this->db->update("users", array("firstname" => $post->firstname,"lastname" => $post->lastname, "email" => $post->email,'address1' => $post->mer_address1, 'address2' => $post->mer_address2, 'city_id' => $post->city, 'country_id' => $post->country, 'phone_number' => $post->mer_mobile, 'payment_account_id'=> $post->payment_acc,'merchant_commission' => $post->commission), array('user_id' => $id));
                                
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
                                $result = $this->db->update("shipping_module_settings", array("free" => $free,"flat" => $flat, "per_product" => $product,'per_quantity' => $quantity, 'aramex' => $aramex), array('ship_user_id' => $id));
                                
                                return $id;
                        }
                return 2;
        }
        
        /** UPDATE MERCHANT SHOP **/
	
        public function edit_merchant_shop($id = "" ,$post = "",$merchantid='') 
        {
		
			$sector = isset($post->sector)?$post->sector:0;
			$subsector = isset($post->subsector)?$post->subsector:0;

			if($post->store_admin_id!=''){
				$this->db->update("users",array("firstname"=>$post->username,"email"=>$post->store_email,"address1"=>$post->address1,"address2"=>$post->address2,"city_id"=>$post->city,"country_id"=>$post->country, 'phone_number' => $post->mobile,"user_sector_id"=>$subsector),array("user_id" => $post->store_admin_id));
				$store_admin_id = $post->store_admin_id;
			}else{
				$password = text::random($type = 'alnum', $length = 10);
				$res = $this->db->insert("users",array("firstname"=>$post->username,"email"=>$post->store_email,"password"=>md5($password),"user_type"=>9,"created_by"=>$merchantid,"referred_user_id"=>$merchantid,"user_status"=>1,"login_type"=>1,"approve_status"=>1,"address1"=>$post->address1,"address2"=>$post->address2,"city_id"=>$post->city,"country_id"=>$post->country, 'phone_number' => $post->mobile,"user_sector_id"=>$subsector));
				$store_admin_id = $res->insert_id();
			}
			
             $merchant_result = $this->db->update("stores", array("store_name" => $post->storename,"store_url_title" => url::title($post->storename),'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $post->country, 'phone_number' => $post->mobile, 'zipcode' => $post->zipcode,"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description, 'website' => $post->website, 'latitude' => $post->latitude, 'longitude' => $post->longitude,"about_us"=>$post->about_us,"store_sector_id"=>$sector,"store_subsector_id"=>$subsector,"store_admin_id"=>$store_admin_id), array('store_id' => $id));
          return $id;
        }
		
         /** BLOCK & UNBLOCK MERCHANT SHOP **/
         
        public function blockunblockmerchant($type = "", $uid = "", $email = "")
        {
                $status = 0;
                if($type == 1){
                    $status = 1;
                }
                $result = $this->db->update("users", array("user_status" => $status), array("user_id" => $uid, "email" => $email));
                $merchant_result = $this->db->update("stores", array("store_status" => $status), array("merchant_id" => $uid));
                
                $get_data = $this->db->from("stores")->join("users","stores.merchant_id","users.user_id")->where(array("merchant_id" => $uid))->get();
                foreach($get_data as $c){
					$result = $this->db->update("users", array("user_status" => $status), array("user_id" => $c->store_admin_id));
				}
                return count($result);
        }
    
        /** BLOCK & UNBLOCK MERCHANT SHOP **/
    
        public function blockunblockmerchantshop($type = "", $storesid = "")
        {
                $status = 0;
                if($type == 1){
                    $status = 1;
                }
                
                $get_data = $this->db->from("stores")->join("users","stores.merchant_id","users.user_id")->where(array("store_id" => $storesid))->get();
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
       	
	/** GET COUNTRY LIST **/
       
    public function getstoreslist()
    {
	    $result = $this->db->from("stores")
	  ->join("city","city.city_id","stores.city_id")
	  ->join("country","country.country_id","city.country_id")
	   ->where(array("store_status" => '1',"city.city_status"=> '1',"country.country_status"=> '1'))->get();
	    return $result;
	}	
		
	/** GET STORE DETAILS **/
	
	public function get_merchant_details($id = "")
	{
		$result = $this->db->from("users")
				   ->join("city","city.city_id","users.city_id")
		                   ->join("country","country.country_id","users.country_id")
		                   ->where(array("user_id" => $id, "user_type" => 3))->get();
		return $result;
	}
	
	/** GET STORE DETAILS **/
	
	public function get_store_details($id = ""){
		$result = $this->db->from("stores")->join("city","city.city_id","stores.city_id")
		                   ->join("country","country.country_id","stores.country_id")
		                   ->join("users","users.user_id","stores.store_admin_id","left")
		                   ->where(array("merchant_id" => $id))
		                   ->orderby("store_id")->get();
		return $result;
	}
	
	/** GET USER LIST **/
	public function get_user_list()
	{               
                $result = $this->db->query("SELECT * FROM users WHERE  user_status = 1  and user_type = 3 ");	        
                return $result;
	}
	
	/** GET MERCHANT DETAILS */
	public function get_admin_details_data()
	{
	    $result = $this->db->query("SELECT * FROM users WHERE  user_status = 1  and user_type = 1 ");
	    return $result;
	}

		/** GET STORE COMMENTS LIST  **/
	
        public function get_users_comments_list($offset = "", $record = "",  $firstname = "")
        {

                $contitions = "";
                        if($firstname){
                        $contitions .= 'where users.firstname like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR stores.store_name like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR discussion.comments like "%'.mysql_real_escape_string($firstname).'%"';
                        }
                       $result = $this->db->query("select *, discussion.created_date as dis_create from discussion join users on users.user_id=discussion.user_id join stores on stores.store_id=discussion.store_id $contitions order by discussion_id DESC limit $offset, $record");
              
                return $result;
        }
	
        /** GET STORE COMMENTS COUNT  **/
	
        public function get_users_comments_count($firstname = "")
        {
               $contitions = "";
                        if($firstname){
                        $contitions .= 'where users.firstname like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR stores.store_name like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR discussion.comments like "%'.mysql_real_escape_string($firstname).'%"';
                        }
                       $result = $this->db->query("select *, discussion.created_date as dis_create from discussion join users on users.user_id=discussion.user_id join stores on stores.store_id=discussion.store_id $contitions order by discussion_id DESC ");
              
                return count($result);
        }
		 /** GET SINGLE STORE COMMENTS DATA **/
	
	public function get_users_comments_data($discussionid = "")
	{
		$result = $this->db->from("discussion")->where(array("discussion_id" => $discussionid))->join("stores","stores.store_id","discussion.store_id")->limit(1)->get();
		return $result;
	}
        
        /** UPDATE STORE COMMENTS**/
	
        public function edit_users_comments($commentsid = "",$post = "") 
        {
                $result = $this->db->update("discussion", array("comments" => $post->comments, "created_date"=>time()), array("discussion_id" => $commentsid));
                return 1;
        }
        
        /** BLOCK & UNBLOCK STORE COMMENTS**/
         
        public function blockunblockusercomments($type = "", $commentsid = "")
        {
                $status = 0;
                if($type == 1){
                    $status = 1;
                }
                $result = $this->db->update("discussion", array("discussion_status" => $status), array("discussion_id" => $commentsid));
                return count($result);
        }

		/** DELETE STORE COMMENT  **/
		
		public function deleteusercomments($discussion_id = "")
		{
			$result = $this->db->delete('discussion', array('discussion_id' => $discussion_id));
				   	  $this->db->delete('discussion_likes', array('discussion_id' => $discussion_id));
					  $this->db->delete('discussion_unlike', array('discussion_id' => $discussion_id));
			return count($result);

		}	
		
		/** UPDATE STORE RATING **/

		public function update_shop_rating($merchant_id = "",$rate = "")
		{
			$check =  $this->db->select('user_id','rating')->from("users")->where(array('rating' =>$rate,'user_type' =>3))->get();
				if(count($check) > 0){
					$old_rate = $this->db->select('rating')->from('users')->where(array('user_id' =>$merchant_id))->get();
						$this->db->update("users", array("rating" => $old_rate[0]->rating), array("user_id" => $check[0]->user_id,'user_type' =>3));
						$this->db->update("users", array("rating" => $rate), array("user_id" => $merchant_id,'user_type' =>3));

				return $check[0]->user_id.",".$old_rate[0]->rating;
			}
				$result = $this->db->update("users", array("rating" => $rate), array("user_id" => $merchant_id,'user_type' =>3));
                return count($result);

		}

		public function approvedisapprove_merchant($type="",$merchant_id=0)
		{
			$status = 0;
                        if($type == 1){
                                $status = 1;
                        }
			$result = $this->db->update("users",array("approve_status" => $status),array("user_id" =>$merchant_id));
			return count($result);
		}
		
		/**  GET SECTOR DATA **/
	        public function get_all_sector_data()
	        {
		        return $this->db->getwhere('sector',array('sector_status' => 1 ,"type" =>1));
	        }
	        
	        /**  GET SECTOR DATA **/
	        public function getsectorData($sector_id = "")
	        {
		        return $this->db->getwhere('sector',array('sector_id' => $sector_id));
	        }
	        /* Get the store name */
	public function get_store_name($storeid="",$merchantid="") 
	{
		$result = $this->db->select("store_url_title","store_subsector_id")->from("stores")->where(array("store_id"=>$storeid,"merchant_id"=>$merchantid))->get();
		return $result;
	}
	  public function exist_name($name = "",$store_id="")
	{
		if($store_id !=""){
		    $result = $this->db->count_records('stores', array('store_name' => $name,'store_id !='=>$store_id));
		}else{
		    $result = $this->db->count_records('stores', array('store_name' => $name));
		}
		return (bool) $result;
	}
	
	public function get_merchant_attribute_data_list($store_id = ""){
		 $result = $this->db->select("merchant_attribute.*","sector.sector_name")->from("merchant_attribute")->join("stores","stores.store_id","merchant_attribute.storeid")->join("sector","sector.sector_id","stores.store_sector_id")->where(array("merchant_attribute.storeid"=>$store_id))->get();
		 return $result;
	}
	
	public function get_merchant_sector_data_list($store_id = ""){
		 $result = $this->db->from("stores")->join("sector","sector.sector_id" ,"stores.store_subsector_id")->where(array("store_id"=>$store_id))->get();
		 return $result;
	}
	
	/** GET MERCHANT BALANCE **/

	public function get_merchant_balance($store_id = "" )
	{
                /*$result =$this->db->from("users")->where(array("user_type" => 3, "user_id" => $merchant_id))->get();*/
                $result=$this->db->from("stores")->where(array("store_id" =>$store_id))->get();
                return $result;
	}
	
	public function update_merchant_attribute($post = "", $store_id = "")
	{
		$result = $this->db->update("merchant_attribute",array("bg_color" => $post->bg_color, "font_color" => $post->font_color, "font_size" => $post->font_size, "banner_1_link" => $post->banner_1_link, "banner_2_link" =>$post->banner_2_link, "banner_3_link" => $post->banner_3_link, "ads_1_link" => $post->ads_1_link, "ads_2_link" =>$post->ads_2_link, "ads_3_link" => $post->ads_3_link), array("storeid" => $store_id));
		
		if($post->sector==0)
		{
			$post->subsector=0;
		}
                //$user_result = $this->db->update("users", array("user_sector_id" => $post->sector,"user_sub_sector_id" =>$post->subsector), array("user_id" => $merchant_id));
                $user_result = $this->db->update("stores", array("store_sector_id" =>$post->sector,"store_subsector_id" =>$post->subsector), array("store_id" => $store_id));
		return $store_id;
	}
	
	/** LISTING THE SUB SECTORS CORRESPONDING TO THE SECTOR SELECTED **/
	public function get_sub_sectors($sector="")
	{
		$result=$this->db->select("sector_id","sector_name")->from("sector")->where(array("main_sector_id" => $sector,"sector_status" =>1))->get();
		return $result;
	}
	
	
	public function get_all_sub_sectors()
	{
		$result=$this->db->select("sector_id","sector_name","main_sector_id")->from("sector")->where(array("type"=>2))->get();
		return $result;
		
	}
			/** NEWSLETTER SEND **/

	public function send_newsletter($post="",$file="",$type="")
	{
		$conditions="";
		
		if(!isset($post->email)){
			
			if(isset($post->all_users)&&((isset($post->city)&&$post->city!="")||(isset($post->gender)&&$post->gender!="")||(isset($post->age_range)&&$post->age_range!=""))){
				
				if(($post->city=='all' && $post->gender =='all' && $post->age_range=='all')||($post->city=='all' && $post->gender !='all' && $post->age_range!='all')||($post->city!='all' && $post->gender =='all' && $post->age_range!='all')||($post->city=='all' && $post->gender !='all' && $post->age_range=='all') || ($post->city=='all' && $post->gender =='all' && $post->age_range!='all') || ($post->city!='all' && $post->gender =='all' && $post->age_range=='all') || ($post->city=='all' && $post->gender !='all' && $post->age_range=='all')){
					
					$conditions .=" and user_type=3";
					
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
				
				$news=$this->db->query("select * from  users where user_status=1 and user_type=3");
			}
			if(isset($post->users)&& $post->users!=""){
				
				$news=$this->db->query("select * from  users where user_status=1 and user_type=3");
				
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
				
				$i=0;
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
										$i++;}
									$user_array=implode(',',$user_array);
									$result=$this->db->insert("email",array("receivers_id" =>$user_array,"sender_id" =>$this->user_id,"email_subject" =>$post->subject,"email_message" =>$this->message,"email_template" =>$post->template,"type" =>$post->mail_category,"send_time"=>time()));
									return 1;
				
			}
	
		
	}
	public function getUSERList()
	{
		$result=$this->db->select("email","firstname","user_id")->from("users")->where(array("user_status"=>1,"user_type"=>3))->get();
		return $result;
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
		$conditions="";
		
		if($city=="" && $gender=="" && $age_range=="")
		{
		$news=$this->db->select("email","firstname","user_id")->from("users")->where(array("user_status"=>1,"user_type"=>3))->get();
		return $news;
		}
		if(isset($all_users) && ((isset($city) && $city!="")||(isset($gender) && $gender!="")||(isset($age_range) && $age_range!=""))){
			
		if(($city=='all' && $gender =='all' && $age_range=='all')||($city=='all' && $gender !='all' && $age_range!='all')||($city!='all' && $gender =='all' && $age_range!='all')||($city=='all' && $gender !='all' && $age_range=='all') || ($city=='all' && $gender =='all' && $age_range!='all') || ($city!='all' && $gender =='all' && $age_range=='all') || ($city=='all' && $gender !='all' && $age_range=='all')){
				
				$conditions .=" and user_type=3 ";
				
			} 
			if(isset($city) && $city!="" && $city!='all') {
				$conditions.="and city_id=".$city." and user_type=3 ";
			}
			if(isset($gender) && $gender!="" && $gender!='all')
			{
					$conditions.=" and gender=".$gender." and user_type=3 ";
				
			}
			if(isset($age_range) && $age_range!="" && $age_range!='all'){
				
				$conditions.=" and age_range=".$age_range." and user_type=3 ";
			}
			
			$news=$this->db->query("select * from  users where user_status=1 $conditions");
			return $news;
			
		}elseif(isset($all_users) && $all_users!=""){
			
			$news=$this->db->query("select * from  users where user_status=1 and user_type=3");
			return $news;
		}
		
		
	}

	public function exist_store_admin($email='',$user_id=''){
		if($user_id!='')
			$result = $this->db->count_records('users', array('user_type' => 9,'email'=>$email,'user_id!='=>$user_id));
		else
			$result = $this->db->count_records('users', array('user_type' => 9,'email'=>$email));
		return (bool) $result;
	}

	public function get_subsector_name($sector_id ='')
	{
		$sector_query = $this->db->query("select * from  sector where sector_id='$sector_id' ");
		return $sector_query;
	}	
	
	/** ADMIN TO USERS MAIL COMMUNICATION **/
	public function get_user_messages($offset="",$record="")
	{
		$result=$this->db->from("email")->where(array("sender_id" =>$this->user_id,"type" =>2))->orderby("id","DESC")->limit($record,$offset)->get();
		return $result;
	}
	
	public function get_user_messages_count()
	{
		$result=$this->db->select("id")->from("email")->where(array("sender_id" =>$this->user_id,"type" =>2))->get();
		return count($result);
	}
	
	public function get_user_message($message_id="")
	{
		$result=$this->db->from("email")->where(array("id" =>$message_id ))->get();
		return $result;
		
	}
	
	public function get_merchant_email($merchant_id="")
	{
		$result=$this->db->select("email")->from("users")->where(array("user_id" =>$merchant_id))->get();
		return $result->current()->email;
	}
	
	public function get_merchant_emails($merchant_id="")
	{
		$result=$this->db->select("email")->from("users")->where(array("users.created_by"=>$merchant_id))->get();
		return $result;
	}
	
	public function get_merchnat_id($store_id="")
	{
		$result=$this->db->select("merchant_id")->from("stores")->where(array("store_id" =>$store_id))->get();
		return $result->current()->merchant_id;		
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
}
