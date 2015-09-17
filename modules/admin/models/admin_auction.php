<?php defined('SYSPATH') or die('No direct script access.');
class Admin_auction_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();	
		$this->user_id = $this->session->get("user_id");	
	}

	/** GET DEALS CATEGORY LIST **/
	
	public function get_gategory_list()
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

        /** GET SUB CATEGORY LIST BY CATEGORY **/
        public function get_sub_category($category = "")
	{ 
		$result = $this->db->from("category")
		                    ->where(array("main_category_id" => $category, "category_status" => 1,"type" => 2))
	                            ->orderby("category_name")
	                            ->get();
		return $result;
	} 
	
	
	/** GET SEC SUB CATEGORY LIST BY CATEGORY **/
        public function get_sec_category($category = "")
	{ 
		$result = $this->db->from("category")
		                    ->where(array("sub_category_id" => $category, "category_status" => 1,"type" => 3))
	                            ->orderby("category_name")
	                            ->get();
		return $result;
	} 
	
	/** GET CITY LIST **/
	
	public function get_city_list()
	{
		$result = $this->db->from("city")->join("country","country.country_id","city.country_id")
	                              ->where(array("city_status" => 1,"country_status" => 1))
	                              ->orderby("city_name","ASC")
	                              ->get();
		return $result;
	}

	/** ADD AUCTION PRODUCTS **/
	
	public function add_auction_products($post = "", $deal_key = "")
	{
	    $savings = $post->product_price-$post->deal_value;
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal          
		//$sub_cat = implode(',',$sub_cat1);
	    $result = $this->db->insert("auction", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category,"product_value" => $post->product_price, "deal_value" => $post->deal_value,"deal_price" => $post->deal_value, "deal_savings"=> $savings,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date), "created_date" => time(),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description, "merchant_id"=>$post->users,"shop_id"=>$post->stores,"created_by"=>$this->user_id,"bid_increment"=>$post->bid_increment,"shipping_fee"=>$post->shipping_fee ,"shipping_info"=>$post->shipping_info,"deal_status"=>1,"user_limit_quantity" => 1, "for_store_cred" => $post->store_cred));
	
		if(count($result) == 1){
			return $result->insert_id();
		}
		return 0;
	
	}
	
	/** UPDATE AUCTION **/
	
	public function edit_deals($deal_id = "", $deal_key = "", $post = "")
	{
		$dealdata = $this->db->select("deal_title","url_title","bid_count")->from("auction")->where(array("deal_id" => $deal_id, "deal_key" => $deal_key))->get();
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal          
		//$sub_cat = implode(',',$sub_cat1);
		if(count($dealdata) == 1){			
			
			$this->db->update("auction", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category,"product_value" => $post->product_price,"deal_value" => $post->deal_value,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description, "merchant_id"=>$post->users,"shop_id"=>$post->stores,"created_by"=>$this->user_id,"bid_increment"=>$post->bid_increment,"shipping_fee"=>$post->shipping_fee ,"shipping_info"=>$post->shipping_info), array("deal_id" => $deal_id, "deal_key" => $deal_key));
			
				if($dealdata->current()->bid_count == 0 ){ // for no one bid 
					$savings = $post->product_price-$post->deal_value;
					$this->db->update("auction", array("deal_price" => $post->deal_value,"deal_savings"=> $savings),array("deal_id" => $deal_id, "deal_key" => $deal_key));
				}

			return 1;
		}
		return 8;
	}
	
        /** CHECK TITLE EXIST **/ 
	
	public function exist_title($title = "")
	{
		$result = $this->db->count_records('auction', array('deal_title' => $title));
		return (bool) $result;
	}
	
	/** MANAGE  DEALS **/
	
	public function get_all_deals_list($type = "",$offset = "", $record = "", $city = "", $name = "",$sort_type = "",$param = "",$limit="",$today="", $startdate = "", $enddate = "")
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

		$conditions = "auction.enddate $cont ".time()." AND auction.enddate > 0 AND city_status = 1 AND country_status =1 ";
		
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
	        	}  else  {  $conditions .= ' order by auction.deal_id DESC'; }			
				$query = "select * , auction.created_date as createddate from auction join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=auction.category_id join users on users.user_id=auction.merchant_id where $conditions $limit1 ";
		}
		else{
				$query = "select * , auction.created_date as createddate from auction join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=auction.category_id join users on users.user_id=auction.merchant_id where $conditions order by auction.deal_id DESC $limit1 ";
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
                        $conditions = "auction.enddate $cont ".time()." AND auction.enddate > 0 ";
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
                                        ->where(array("enddate $cont" => time()))
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
	
	/** VIEW DEALS **/
	
	public function get_deals_data($deal_key = "", $deal_id = "")
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
	
	public function get_deals_data_mail($deal_key = "", $deal_id = "")
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
	
	/** EDIT DEALS DATA **/
	
	public function get_edit_deal($deal_id = "",$deal_key = "")
	{
		$result = $this->db->from("auction")
				->where(array("deal_id" => $deal_id, "deal_key" => $deal_key))
		     		->get();
		return $result; 
	}

	/** BLOCK UNBLOCK AUCTION **/
	
	public function blockunblockdeal($type = "", $key = "", $deal_id = "" )
	{  
		$status = 0;
		if($type == 1){
		$status = 1;
		}
		$result = $this->db->update("auction", array("deal_status" => $status), array("deal_id" => $deal_id, "deal_key" => $key));
		return count($result);
	}
	
	/** GET CATEGORY LIST **/
	
	public function all_category_list()
	{
		$result = $this->db->from("category")->get();
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
        /** GET USER LIST **/
        
	public function getuserlist()
        {
                $result = $this->db->from("users")
                            ->orderby("firstname", "ASC")
                            ->where(array("user_status" => '1',"user_type" => '1'))
                            ->get();
                return $result;
        }
        
        /** GET USER LIST **/
        
	public function getdeallist()
        {
                $result = $this->db->from("auction")
                            ->orderby("deal_title", "ASC")
                            ->where(array("deal_status" => '1'))
                            ->get();
                return $result;
        }
        
        /** VIEW DEALS FOR TRANSACTION**/
	
	public function get_transaction_data( $deal_id = "")
	{
	
                $result = $this->db->from("auction")
                                ->where(array("transaction.auction_id" => $deal_id))
	                            ->join("transaction","transaction.auction_id","auction.deal_id")
	                            ->join("users","users.user_id","transaction.user_id")
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
	 
	 /** GET BIDDING DATA **/
	
	public function get_bidding_data_list()
	{
	
                $result =$this->db->from("bidding")->get();
                return $result;
	 } 
	
	
	 /** GET USER LIST **/
	public function get_transaction_chart_list()
	{	
	        $result = $this->db->from("transaction")
	                            ->join("auction","auction.deal_id","transaction.auction_id")
                                ->get();
                return $result;
               
	}
	
	/*GET AUCTION CHART LIST */
	public function get_deals_chart_list()
	{	
	    $result_active_deals =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate >" => time(), "deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["active_auction"]=count($result_active_deals);
		
		$result_archive_deals =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate <" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["archive_auction"]=count($result_archive_deals);
		return $result;
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
                    $contitions .= ' OR u.email like "%'.mysql_real_escape_string($name).'%")';
            		//$contitions .= ' OR tm.coupon_code like "%'.mysql_real_escape_string($name).'%")';
                   $result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where $contitions and shipping_type = 2 $condition group by shipping_id order by shipping_id DESC $limit1 "); 
				}
				else {
					$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id  where shipping_type = 2 $condition group by shipping_id order by shipping_id DESC $limit1 "); 
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
                   
                   $result = $this->db->query("select s.shipping_id from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join users as u on u.user_id=s.user_id where $contitions and shipping_type = 2 $condition group by shipping_id order by shipping_id DESC "); 
		}
		else {
			$result = $this->db->query("select s.shipping_id from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join users as u on u.user_id=s.user_id where shipping_type = 2 $condition group by shipping_id order by shipping_id DESC"); 
		}
                return count($result);
        }
        
        /*UPDATE SHIPPING STATUS */
	public function update_shipping_status($id = "",$type="")
	{
		
		$result = $this->db->update('shipping_info',array('delivery_status' => $type),array('shipping_id' => $id)); 
		
		return count($result);
	}

	
/** AUCTION WINNER LIST  **/

	public function get_winner_list($offset = "", $record = "", $name = "",$limit="")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";
		
		$contitions = "auction.winner != 0 and  bidding.winning_status!=0";
		if($_GET){
		        	   $contitions .= ' and (users.firstname like "%'.mysql_real_escape_string($name).'%"';
                       $contitions .= ' OR auction.deal_title like "%'.mysql_real_escape_string($name).'%")';
                      
		}
		 $result = $this->db->query("SELECT * FROM auction join users on users.user_id=auction.winner join city on city.city_id=users.city_id join country on country.country_id=users.country_id join bidding on bidding.auction_id = auction.deal_id where $contitions order by auction.deal_id DESC $limit1 ");
		 
	return $result;  
	
	}

	/** AUCTION WINNER 	COUNT  **/

	public function get_winner_count($name = "")
	{
		$contitions = "auction.winner != 0 and bidding.winning_status!=0 ";
		if($_GET){

						$contitions .= ' and (users.firstname like "%'.mysql_real_escape_string($name).'%"';
                        $contitions .= ' OR auction.deal_title like "%'.mysql_real_escape_string($name).'%")';
                       
                      
		}
		$query = " SELECT * FROM auction join users on users.user_id=auction.winner join city on city.city_id=users.city_id join country on country.country_id=users.country_id join bidding on bidding.auction_id = auction.deal_id where $contitions ";
		
		$result = $this->db->query($query); 
		
		return count($result);  
	
	}
	
	/** GET AUCTION LIST  **/
	
        public function get_users_comments_list($offset = "", $record = "",  $firstname = "",$deal_type = "")
        { 

                $contitions = "discussion.type = $deal_type ";
                        if($firstname){
                        $contitions .= ' AND users.firstname like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR auction.deal_title like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR discussion.comments like "%'.mysql_real_escape_string($firstname).'%"';
                        }
                       $result = $this->db->query("select *, discussion.created_date as dis_create from discussion join users on users.user_id=discussion.user_id join auction on auction.deal_id=discussion.deal_id where $contitions order by discussion_id DESC limit $offset, $record");
              
                return $result;
        }
	
        /** GET AUCTION COMMENTS COUNT  **/
	
        public function get_users_comments_count($firstname = "",$deal_type = "")
        {
               $contitions = "discussion.type = $deal_type ";
                        if($firstname){
                        $contitions .= ' AND users.firstname like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR auction.deal_title like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR discussion.comments like "%'.mysql_real_escape_string($firstname).'%"';
                        }
                       $result = $this->db->query("select *, discussion.created_date as dis_create from discussion join users on users.user_id=discussion.user_id join auction on auction.deal_id=discussion.deal_id where $contitions  order by discussion_id DESC");
                return count($result);
        }

		 /** GET SINGLE AUCTION COMMENTS DATA **/
	
	public function get_users_comments_data($discussionid = "")
	{
		$result = $this->db->from("discussion")->where(array("discussion_id" => $discussionid))->join("auction","auction.deal_id","discussion.deal_id")->limit(1)->get();
		return $result;
	}
        
        /** UPDATE AUCTION COMMENTS**/
	
        public function edit_users_comments($commentsid = "",$post = "") 
        {
                $result = $this->db->update("discussion", array("comments" => $post->comments, "created_date"=>time()), array("discussion_id" => $commentsid));
                return 1;
        }
        
        /** BLOCK & UNBLOCK AUCTION COMMENTS**/
         
        public function blockunblockusercomments($type = "", $commentsid = "")
        {
                $status = 0;
                if($type == 1){
                    $status = 1;
                }
                $result = $this->db->update("discussion", array("discussion_status" => $status), array("discussion_id" => $commentsid));
                return count($result);
        }

		 /** DELETE AUCTION COMMENT  **/
		
		public function deleteusercomments($discussion_id = "")
		{
			$result = $this->db->delete('discussion', array('discussion_id' => $discussion_id));
				      $this->db->delete('discussion_likes', array('discussion_id' => $discussion_id));
					  $this->db->delete('discussion_unlike', array('discussion_id' => $discussion_id));
			return count($result);

		}		
 	
		/* GET BIDDING LIST */
		public function get_bidding_list($deal_id = "")
		{
			$result = $this->db->from("bidding")->select("auction.deal_title","users.firstname","auction.deal_value","bidding.bid_id","bidding.bid_amount","bidding.bidding_time","auction.winner")->join("auction","auction.deal_id","bidding.auction_id")->join("users","users.user_id","bidding.user_id")->where(array("auction.deal_status" => 1,"auction.deal_id" => $deal_id,"users.user_status" =>1))->orderby("bidding_time","DESC")->get();
		return $result;

		}
		/* GET HIGHEST BID */
		public function get_highest_bid($deal_id ="")
		{
			$result = $this->db->from("bidding")->select("bid_amount","bid_id")->where(array("auction_id" => $deal_id))->orderby("bid_amount","DESC")->limit(1)->get();
			return $result;
		}
		/** GET SHIPPING DATA  **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping    **/
	
        /** GET AUCTION MAIL DATA   **/

	public function get_auction_mail_data($deal_id = "",$transaction_id = "",$shipping_id="")
	{

		$result = $this->db->select("shipping_info.*,auction.deal_title,deal_price,transaction.bid_amount,transaction.quantity,transaction.shipping_amount,transaction.tax_amount,transaction.transaction_date,store_name,stores.address1 as addr1,stores.address2 as addr2,city_name,stores.zipcode,stores.phone_number as str_phone,transaction.shipping_amount as shipping,shipping_info.adderss1 as saddr1,shipping_info.address2 as saddr2,shipping_info.phone,stores.website,shipping_info.name,shipping_info.country,auction.deal_key,auction.deal_value,auction.url_title,users.fb_session_key,users.fb_user_id,users.email,users.facebook_update")->from("shipping_info")->join("transaction","transaction.id","shipping_info.transaction_id")->join("auction","auction.deal_id","transaction.auction_id")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","shipping_info.city")->join("users","users.user_id","shipping_info.user_id")->where(array("shipping_info.shipping_id" => $shipping_id,"transaction.id" =>$transaction_id,"auction.deal_id" => $deal_id))->get();
			
		return $result;
	}

	/**  UPDATE THE DELIVERY STATUS OF COD **/
	public function update_cod_shipping_status($id = "",$type="",$trans_id=0,$auction_id=0,$merchant_id=0)
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

				 $this->db->update('transaction',array('captured' => 1,'captured_date' =>time(),'payment_status' => 'Completed','pending_reason' =>'None'),array('id' => $trans_id));

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
	
	/** GET SEC SUB CATEGORY LIST BY CATEGORY **/
        public function get_third_category($category = "")
	{ 
		$result = $this->db->from("category")
		                    ->where(array("sub_category_id" => $category, "category_status" => 1,"type" => 4))
	                        ->orderby("category_name")->get();
		return $result;
	} 
	
	public function change_commission_data($commission = "" , $auction_id = "")
	{
	        $result = $this->db->query("update auction set commission_status = $commission where deal_id = '$auction_id'");
	        return $result;
	}
	
	/*	GET HOT PRODUCT LIST */
	public function get_hot_product_list($product_id="",$type="")
	{
		
		$result= $this->db->update('auction',array('deal_feature' => $type),array("deal_id" => $product_id));
		return 1;
	}

}
