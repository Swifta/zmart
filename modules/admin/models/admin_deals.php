<?php defined('SYSPATH') or die('No direct script access.');
class Admin_deals_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();	
	}

	/** GET DEALS CATEGORY LIST **/

	public function get_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"main_category_id"=>0))->orderby("category_name","ASC")->get();
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
	
	public function get_third_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type"=>4))->orderby("category_name","ASC")->get();
		return $result;
	}
	/** GET CITY LIST **/
	
	public function get_city_list()
	{
		$result = $this->db->from("city")->join("country","country.country_id","city.country_id")->where(array("city_status" => 1,"country_status" => 1))->orderby("city_name","ASC")->get();
		return $result;
	}

	/** ADD DEALS **/
	
	public function add_deals($post = "", $deal_key = "",$adminid = "")
	{

		$savings=($post->price-$post->deal_value);
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal          
		// $sub_cat = implode(',',$sub_cat1);
		$result = $this->db->insert("deals", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category,"deal_price" => $post->price,"deal_value" => $post->deal_value,"deal_savings" => $savings,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date), "expirydate" => strtotime($post->expiry_date),"created_date" => time(),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => ($savings/$post->price)*100,"minimum_deals_limit" =>  $post->minlimit,"maximum_deals_limit" => $post->maxlimit , "user_limit_quantity" =>  $post->quantity,"merchant_id"=>$post->users,"shop_id"=>$post->stores,"created_by"=>$adminid,"deal_status" => 1));
	
		if(count($result) == 1){
			return $result->insert_id();
		}
		return 0;
	}

        /** CHECK TITLE EXIST **/ 

	public function exist_title($title = "")
	{
		$result = $this->db->count_records('deals', array('deal_title' => $title));
		return (bool) $result;
	}

	/** MANAGE  DEALS **/

	public function get_all_deals_list($type = "",$offset = "", $record = "", $city = "", $name = "",$sort_type = "",$param = "",$limit = "",$today="", $startdate = "", $enddate = "")
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
		$limit1 = $limit !=1 ?"limit $offset,$record":"";
		$conditions = "deals.enddate $cont ".time()." AND deals.enddate > 0 and city_status = 1 and country_status = 1 ";
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
			
			$query = "select * , deals.created_date as createddate from deals join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id where $conditions $limit1";
                      
			
		}
		else{
		      $query = "select * , deals.created_date as createddate from deals join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id where $conditions order by deals.deal_id DESC $limit1";
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

                        $conditions = "deals.enddate $cont ".time()." AND deals.enddate > 0 ";
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

                                $query = "select * from deals join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id   where $conditions";
                                $result = $this->db->query($query);
                }
                else{
                        $result = $this->db->select("deal_id")->from("deals")
                                        ->where(array("enddate $cont" => time()))
                                        ->join("stores","stores.store_id","deals.shop_id")
                                        ->join("city","city.city_id","stores.city_id")
                                        ->join("country","country.country_id","stores.country_id")
                                        ->join("category","category.category_id","deals.category_id")
                                        ->join("users","users.user_id","deals.merchant_id")
                                        ->orderby("deal_id","DESC")
                                        ->get();
                }
                return count($result);
	
	}
	
	/** VIEW DEALS **/
	
	public function get_deals_data($deal_key = "", $deal_id = "")
	{
	        $result = $this->db->select('*','deals.sub_category_id as sub_cat','deals.sec_category_id as sec_cat')->from("deals")
	                        ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key))
                                ->join("stores","stores.store_id","deals.shop_id")
                                ->join("city","city.city_id","stores.city_id")
                                ->join("country","country.country_id","stores.country_id")
                                ->join("users","users.user_id","deals.merchant_id")
                                ->join("category","category.category_id","deals.category_id")	
 	                        ->get();
                return $result;
	}
	
	public function get_deals_data_mail($deal_key = "", $deal_id = "")
	{
	        $result = $this->db->select('*','deals.sub_category_id as sub_cat','deals.sec_category_id as sec_cat')->from("deals")
	                        ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key, "deal_status" => 1))
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
				->where(array("deal_id" => $deal_id, "deal_key" => $deal_key))
		     		->get();
		return $result;
	}
	
	/** UPDATE DEALS **/
	
	public function edit_deals($deal_id = "", $deal_key = "", $post = "")
	{
		$dealdata = $this->db->select("deal_title","url_title")->from("deals")->where(array("deal_id" => $deal_id, "deal_key" => $deal_key))->get();
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal          
	//	$sub_cat = implode(',',$sub_cat1);

		if(count($dealdata) == 1){			
			
			
			$savings=($post->price-$post->deal_value);
			$this->db->update("deals", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category, "sub_category_id" => $post->sub_category, "sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category,"deal_price" => $post->price,"deal_value" => $post->deal_value,"deal_savings" =>$savings,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date), "expirydate" => strtotime($post->expiry_date),"created_date" => time(),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => ($savings/$post->price)*100,"minimum_deals_limit" =>  $post->minlimit,"maximum_deals_limit" => $post->maxlimit , "user_limit_quantity" =>  $post->quantity,"merchant_id"=>$post->users,"shop_id"=>$post->stores), array("deal_id" => $deal_id, "deal_key" => $deal_key));
		
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
		$result = $this->db->update("deals", array("deal_status" => $status), array("deal_id" => $deal_id, "deal_key" => $key));
		return count($result);
	}
	
	/** GET CATEGORY LIST **/
	
	public function all_category_list()
	{
		$result = $this->db->from("category")->where("category_status",1)->get();
		return $result;
	}
	
        /** GET MARCHANT LIST **/
        
	public function getmarchantlist()
        { 
		$result = $this->db->from("users")->where(array("user_type" => '3',"user_status"=> '1'))->orderby("firstname")->get();
		return $result;
        }
	
         /** GET SHOP LIST **/
         
	public function get_shop_list()
        {
                $result = $this->db->from("stores")
                            ->join("users","users.user_id","stores.merchant_id")
                            ->orderby("stores.store_name", "ASC")
                            ->where(array("store_status" => '1'))
                            ->get();
                return $result;
        }
        



        /** GET CITY LIST **/
   	public function get_city_lists()
        {
                $result = $this->db->from("city")
			    ->join("country","country.country_id","city.country_id")
                            ->orderby("city.city_name", "ASC")
                            ->where(array("city_status" => '1',"country.country_status"=>1))
                            ->get();
                return $result;
        }
        
        
        /** GET STORE LIST BY USER **/
        public function get_store_by_users($users = "")
	{
		$result = $this->db->from("stores")
		                    ->where(array("user_id" => $users, "store_status" => '1',"city.city_status" => '1'))
	                        ->join("city","city.city_id","stores.city_id")
	                        ->join("users","users.user_id","stores.merchant_id")
	                        ->orderby("store_name")->get();
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
	
	/** GET DEAL COMMENTS LIST  **/
	
        public function get_users_comments_list($offset = "", $record = "",  $firstname = "",$deal_type = "")
        {

                $contitions = "discussion.type = $deal_type ";
                        if($firstname){
                        $contitions .= ' AND (users.firstname like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR deals.deal_title like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR discussion.comments like "%'.mysql_real_escape_string($firstname).'%")';
                        }
                       $result = $this->db->query("select *, discussion.created_date as dis_create from discussion join users on users.user_id=discussion.user_id join deals on deals.deal_id=discussion.deal_id where $contitions order by discussion_id DESC limit $offset, $record");
                      return $result;
        }
	
        /** GET USERS COMMENTS COUNT  **/
	
        public function get_users_comments_count($firstname = "",$deal_type = "")
        {
               $contitions = "discussion.type = $deal_type ";
                        if($firstname){
                        $contitions .= 'AND (users.firstname like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR deals.deal_title like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR discussion.comments like "%'.mysql_real_escape_string($firstname).'%")';
                        }
                       $result = $this->db->query("select *, discussion.created_date as dis_create from discussion join users on users.user_id=discussion.user_id join deals on deals.deal_id=discussion.deal_id where $contitions order by discussion_id DESC");
                       return count($result);
        }
        
        /** GET SINGLE USER COMMENT DATA **/
	
	public function get_users_comments_data($discussionid = "")
	{
		$result = $this->db->from("discussion")->where(array("discussion_id" => $discussionid))->join("deals","deals.deal_id","discussion.deal_id")->limit(1)->get();
		return $result;
	}
        
        /** UPDATE USER COMMENT**/
	
        public function edit_users_comments($commentsid = "",$post = "") 
        {
                $result = $this->db->update("discussion", array("comments" => $post->comments, "created_date"=>time()), array("discussion_id" => $commentsid));
                return 1;
        }
        
        /** BLOCK & UNBLOCK USER COMMENT**/
         
        public function blockunblockusercomments($type = "", $commentsid = "")
        {
                $status = 0;
                if($type == 1){
                    $status = 1;
                }
                $result = $this->db->update("discussion", array("discussion_status" => $status), array("discussion_id" => $commentsid));
                return count($result);
        }
        
        /** DELETE DEAL COMMENT  **/
		
		public function deleteusercomments($discussion_id = "")
		{
			$result = $this->db->delete('discussion', array('discussion_id' => $discussion_id));
					  $this->db->delete('discussion_likes', array('discussion_id' => $discussion_id));
					  $this->db->delete('discussion_unlike', array('discussion_id' => $discussion_id));
			return count($result);
		}		
        
        
        /** VIEW DEALS FOR TRANSACTION**/
	
	public function get_transaction_data( $deal_id = "",$type="")
	{
		$conditions = array("transaction.deal_id" => $deal_id,"type!=" => 5);
		if($type){
				$conditions = array("transaction.deal_id" => $deal_id,"type" => 5);
		}
        $result = $this->db->from("deals")
	                    ->where($conditions)
	                	->join("transaction","transaction.deal_id","deals.deal_id")
	                	->orderby("transaction.id","DESC")
	                    ->get();
        return $result;
	} 
	
	/** GET MERCHANT BALANCE **/
	
	public function get_merchant_balance()
	{
	
                $result =$this->db->from("users")->where(array("user_type" => 3))->get();
                return $result;
	 } 
	

	
	/** FORCE CLOSE DEALS **/
	
	public function force_close_deal($deal_id = "",$deal_key = "")
	{
		$purchace_count = $this->db->select("purchase_count","maximum_deals_limit")->from("deals")
						->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"enddate < "=>time()))
						->limit(1)
						->get();

		if(count($purchace_count)){
			$purchace_count_val = $purchace_count->current()->purchase_count;
			$maximum_deals_limit = $purchace_count->current()->maximum_deals_limit;

			if($maximum_deals_limit > $purchace_count_val) {
			$result = $this->db->update("deals", array("minimum_deals_limit" => $purchace_count_val-1, "deals.enddate"=>time()), array("deal_id" => $deal_id, "deal_key" => $deal_key));

			return count($result);
			}
		    return 0;
		}
		return 0;

	} 
	
	 /** GET USER LIST **/
	public function get_transaction_chart_list()
	{	
	        $result = $this->db->from("transaction_mapping")
	                            ->join("deals","deals.deal_id","transaction_mapping.deal_id")
                                ->get();
                return $result;
               
	}
	
	/** GET USER LIST **/
	public function get_transaction_chart_list_date($start, $end)
	{	
	        $result = $this->db->from("transaction_mapping")
	                            ->join("deals","deals.deal_id","transaction_mapping.deal_id")
	                            ->where(array("transaction_date > " => strtotime($start), "transaction_date <" => strtotime($end)))
                                ->get();
                               
                return $result;
               
	}
	
	public function get_deals_chart_list()
	{	
	    $result_active_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->join("category","category.category_id","deals.category_id")->join("users","users.user_id","deals.merchant_id")->where(array("enddate >" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["active_deals"]=count($result_active_deals);
		
		$result_archive_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate <" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["archive_deals"]=count($result_archive_deals);
		return $result;
	}
	
	/** GET SINGLE USER DATA **/
	
	public function get_users_data($userid = "")
	{
		$result = $this->db->from("users")->where(array("user_type" => $userid))->where('user_status',1)->orderby("firstname","ASC")->get();
		return $result;
	}
	/* GET COUPON LIST */
 	public function get_coupon_list($offset = "", $record = "",$code = "" , $name = "",$limit = "")
	{ 
		$limit1 = $limit !=1 ?"limit $offset,$record":"";
		
		$contitions = "transaction_mapping.coupon_code_status=0";
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
//print_r($result); exit;
	return $result;  
	}
	/* GET COUPON COUNT */
	public function get_coupon_count($code = "" , $name = "")
	{
		$contitions = "transaction_mapping.coupon_code_status = 0";
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

	/* VALIDATE COUPON */
	public function validate_coupon($coupon = "",$product_amount = "",$trans_id = "")
	{ 
		$result =  $this->db->count_records("transaction_mapping", array("coupon_code" => $coupon,"transaction_id" => $trans_id,"coupon_code_status" =>1)); 
			if($result > 0){
				//$this->db->query("update users set merchant_account_balance = merchant_account_balance + $product_amount where user_type = 1");
				$this->db->update('transaction',array('captured' => 1,'captured_date' =>time(),'payment_status' => 'Completed','pending_reason' =>'None'),array('id' => $trans_id));

				$this->db->update('transaction_mapping',array('coupon_code_status' => 0),array("transaction_id" => $trans_id));
				
				return 1;
			}
			else return 0;
	}

	public function change_commission_data($commission = "" , $deal_id = "")
	{
	        $result = $this->db->query("update deals set commission_status = $commission where deal_id = '$deal_id'");
	        return $result;
	}
	
	/*	GET HOT PRODUCT LIST */
	public function get_hot_product_list($product_id="",$type="")
	{
		
		$result= $this->db->update('deals',array('deal_feature' => $type),array("deal_id" => $product_id));
		return 1;
	}

}
