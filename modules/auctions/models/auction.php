<?php defined('SYSPATH') or die('No direct script access.');
class Auction_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->city_id = $this->session->get("CityID");
		$this->UserID = $this->session->get("UserID");
		
		/*
			Test for club membership and set conditions.
			@Live
		*/
		
		(strcmp($_SESSION['Club'], '0') == 0)?$this->auction_club_condition = 'and auction.for_store_cred = '.$_SESSION['Club'].' ':$this->auction_club_condition = '';
		(strcmp($_SESSION['Club'], '0') == 0)?$this->auction_club_condition_arr = true:$this->auction_club_condition_arr = false;
	}
	

		/* GET BANNER LIST */
	public function get_banner_list()
	{
		$result = $this->db->from("banner_image")->where(array("status" => 1, "auction" => 1))->get();
		return $result;
	}

	/** TODAY DEALS COUNT**/
    public function get_today_deals_count($category = "",$sort = "",$search = "")
	{
		$conditions = " deal_status = 1 ".$this->auction_club_condition."  and enddate >".time()." and category.category_status = 1 and stores.store_status= 1 and auction_status = 0 ";
		if(CITY_SETTING){
			$conditions .= "and stores.city_id = $this->city_id  ";
		}

		if($_GET){
					$sort_con = "order by deal_id DESC";

			if($category){
						$conditions .= "and category.category_id IN ($category)";
				}
			if($sort==1){
				$sort_con = "order by auction.enddate ASC";
			}
			if($sort==2){
				$sort_con = "order by auction.enddate DESC";
			}
			if($sort==3){
				$sort_con = "order by deal_value ASC";
			}
			if($sort==4){
				$sort_con = "order by deal_value DESC";
			}
			if($sort==5){
				$sort_con = "order by deal_title ASC";
			}
			if($sort==6){
				$sort_con = "order by deal_title DESC";
			}
			if($search){

		        $conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
			$conditions .= " or deal_description like '%".mysql_real_escape_string($search)."%')";
			}
			$query="select auction.deal_id from(auction) join category on category.category_id=auction.category_id join stores on stores.store_id=auction.shop_id where $conditions $sort_con";
			$result = $this->db->query($query);
		        } else {

			$query="select auction.deal_id from(auction) join category on category.category_id=auction.category_id join stores on stores.store_id=auction.shop_id where $conditions order by deal_id DESC";
			$result = $this->db->query($query);
		        }
		return count($result);

        }
        /** PAYMENT  LIST */
        public function payment_list()
	    {
			$result = $this->db->select("users.firstname","bidding_time as transaction_date","bidding.bid_amount","auction_id")->from("bidding")->join("auction", "auction.deal_id", "bidding.auction_id")->join("users","users.user_id","bidding.user_id")->get();

		return $result;

	    }

		/**  CHECK THE USER IS ALREADY BUY THE AUCTION     **/

		public function check_already_buy($bid_id ="",$user_id = "")
		{
				$result = $this->db->count_records("bidding",array("bid_id" =>$bid_id,"user_id" => $user_id,"winning_status" =>2));

				if($result==0){
					return 1;
				}
				return 0;
		}

        /** GET TODAY DEALS LIST **/

	public function get_today_deals_list($offset = "", $record = "",$category = "",$sort = "",$search = "",$price="",$main_cat="",$sub_cat="",$sec_cat="",$third_cat="",$price_text="")
	{
		$conditions = " deal_status = 1 ".$this->auction_club_condition."  and enddate >".time()." and category.category_status = 1 and stores.store_status= 1 and auction_status = 0 ";
		if(CITY_SETTING){
			$conditions .= "and stores.city_id = $this->city_id  ";
		}

		if($main_cat){
			 $conditions .= " and category.category_url='$main_cat'";
		}
		if($sub_cat){
			$conditions .= " and category.category_url='$sub_cat'";
			$join ="join category on category.category_id=auction.sub_category_id";
		}
		if($sec_cat){
			$conditions .= " and category.category_url='$sec_cat'";
			$join ="join category on category.category_id=auction.sec_category_id";
		}
		if($third_cat){
			$conditions .= " and category.category_url='$third_cat'";
			$join ="join category on category.category_id=auction.third_category_id";
		}

		/*if($discount){
			$discount = rtrim($discount, ",");
			$discount1 = explode(',',$discount);
			$arr = array("1" => "<10", "2" => "10 and 20", "3" => "20 and 30", "4" => "30 and 50", "5" => "50 and 75", "6" => ">75");

			if(count($discount1) == 1){

				$val = $discount1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (deals.deal_percentage $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($discount1); $i++){
					$val = $discount1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (deals.deal_percentage between $arr[$val]";
						}else{
							$conditions .="and (deals.deal_percentage $arr[$val]";
						}
					}else if($i == count($discount1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or deals.deal_percentage between $arr[$val])";
						}else{
							$conditions .=" or deals.deal_percentage $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or deals.deal_percentage between $arr[$val]";
						}else{
							$conditions .=" or deals.deal_percentage $arr[$val]";
						}
					}
				}
			}
		}  */

		if($price){
			$price = rtrim($price, ",");
			$price1 = explode(',',$price);
			$arr = array("1" => "<500", "2" => "501 and 1000", "3" => "1001 and 1500", "4" => "1501 and 2000", "5" => "2001 and 2500", "6" => ">2500");

			if(count($price1) == 1){

				$val = $price1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (auction.deal_value $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($price1); $i++){
					$val = $price1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (auction.deal_value between $arr[$val]";
						}else{
							$conditions .="and (auction.deal_value $arr[$val]";
						}
					}else if($i == count($price1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or auction.deal_value between $arr[$val])";
						}else{
							$conditions .=" or auction.deal_value $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or auction.deal_value between $arr[$val]";
						}else{
							$conditions .=" or auction.deal_value $arr[$val]";
						}
					}
				}
			}
		}

		if($price_text){
			$price_text = str_replace(array(CURRENCY_SYMBOL," "),"",$price_text);
			$price_array = explode("-", $price_text);
			$conditions .=" and auction.deal_value between $price_array[0] and $price_array[1]";
		}

                if($_GET){
	                $sort_con = "order by deal_id DESC";

                        if($category){
	                                        $conditions .= "and category.category_id IN ($category)";
                                }
                        if($sort==1){
                                $sort_con = "order by auction.enddate ASC";
                        }
                        if($sort==2){
                                $sort_con = "order by auction.enddate DESC";
                        }
                        if($sort==3){
                                $sort_con = "order by deal_value ASC";
                        }
                        if($sort==4){
                                $sort_con = "order by deal_value DESC";
                        }
                        if($sort==5){
                                $sort_con = "order by deal_title ASC";
                        }
                        if($sort==6){
                                $sort_con = "order by deal_title DESC";
                        }
	                if($search){

                        $conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
	                $conditions .= " or deal_description like '%".mysql_real_escape_string($search)."%')";
	                }

	                $query="select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,product_value,auction.enddate,stores.store_url_title,(select avg(rating) from rating where type_id=auction.deal_id and module_id=3) as avg_rating from(auction) join category on category.category_id=auction.category_id join stores on stores.store_id=auction.shop_id where $conditions $sort_con limit $offset,$record ";
				                $result = $this->db->query($query);
                }

		else{

			$query="select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,product_value,auction.enddate,stores.store_url_title,(select avg(rating) from rating where type_id=auction.deal_id and module_id=3) as avg_rating from(auction) join category on category.category_id=auction.category_id join stores on stores.store_id=auction.shop_id where $conditions order by deal_id DESC limit $offset,$record ";
						$result = $this->db->query($query);
		}

		return $result;
	}

	/** ALL DEALS AND CATEGORY DEALS COUNT **/

        public function get_deals_count($cat_type ="",$category = "")
		{
			$conditions = " deal_status = 1 ".$this->auction_club_condition."  AND enddate > ".time()." AND category.category_status = 1 AND  store_status = 1 and auction_status = 0 ";
			$join = "auction.category_id";
		if(CITY_SETTING){
			$conditions .= " AND stores.city_id = $this->city_id ";
		}
		if($category && $cat_type=='main'){
			$conditions .= " AND category.category_url = '$category' ";
		}
		else if($category && $cat_type=='sub'){
			$conditions .= " AND category.category_url = '$category' ";
			$join = "auction.sub_category_id";

		}
		else if($category && $cat_type=='sec'){
			$conditions .= " AND category.category_url = '$category' ";
			$join = "auction.sec_category_id";

		}
		else if($category && $cat_type=='third'){
			$conditions .= " AND category.category_url = '$category' ";
			$join = "auction.third_category_id";

		}
		        $result = $this->db->query( "select auction.deal_id from auction join category ON category.category_id = $join join stores ON stores.store_id = auction.shop_id  where $conditions  group by deal_id order by deal_id DESC ");
         		return count($result);
        }

     /** ALL DEALS AND CATEGORY DEALS LIST **/

	public function get_deals_list($cat_type ="",$category = "", $offset = "", $record = "")
	{

		$conditions = " deal_status = 1 ".$this->auction_club_condition."  AND enddate > ".time()." AND category.category_status = 1 AND  store_status = 1 and auction_status = 0 ";
			$join = "auction.category_id";
		if(CITY_SETTING){
			$conditions .= " AND stores.city_id = $this->city_id ";
		}
				if($category && $cat_type=='main'){
			$conditions .= " AND category.category_url = '$category' ";
		}
		else if($category && $cat_type=='sub'){
			$conditions .= " AND category.category_url = '$category' ";
			$join = "auction.sub_category_id";

		}
		else if($category && $cat_type=='sec'){
			$conditions .= " AND category.category_url = '$category' ";
			$join = "auction.sec_category_id";

		}
		else if($category && $cat_type=='third'){
			$conditions .= " AND category.category_url = '$category' ";
			$join = "auction.third_category_id";

		}
		        $result = $this->db->query( "select auction.deal_id,auction.deal_key,product_value,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,auction.enddate,stores.store_url_title,(select avg(rating) from rating where type_id=auction.deal_id and module_id=3) as avg_rating from auction join category ON category.category_id = $join join stores ON stores.store_id = auction.shop_id  where $conditions  group by deal_id order by deal_id DESC limit $offset,$record ");

				return $result;
	}

	/** MOST VIEW AUCTION LIST **/

	public function get_auction_view()
	{
	/*if(CITY_SETTING){ 
	$conditions = " deal_status = 1 ".$this->auction_club_condition."  AND enddate > ".time()." AND category.category_status = 1 AND  store_status = 1 and stores.city_id = '$this->city_id' and auction_status = 0 ";
	$result = $this->db->query( "select * from auction join category ON category.category_id = category.category_id join stores ON stores.store_id = auction.shop_id  where $conditions  order by auction.view_count DESC limit 3 ");
	return $result;
	} else {
	$conditions = " deal_status = 1 ".$this->auction_club_condition."  AND enddate > ".time()." AND category.category_status = 1 AND  store_status = 1 and auction_status = 0 ";
	$result = $this->db->query( "select * from auction join category ON category.category_id = category.category_id join stores ON stores.store_id = auction.shop_id  where $conditions  order by auction.view_count DESC limit 3 ");
	return $result;
	} */
	
	
	
	if(CITY_SETTING){ 
	$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,product_value,auction.enddate,stores.store_url_title,(select avg(rating) from rating where type_id=auction.deal_id and module_id=3) as avg_rating from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id where enddate > ".time()."  and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and stores.city_id = '$this->city_id' and  store_status = 1 order by auction.view_count DESC limit 3 ";

	$result = $this->db->query($query);
	} else {
	$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,product_value,auction.enddate,stores.store_url_title,(select avg(rating) from rating where type_id=auction.deal_id and module_id=3) as avg_rating from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id where enddate > ".time()."  and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and  store_status = 1 order by auction.view_count DESC limit 3 ";

	$result = $this->db->query($query);
	}
		return $result;
		

        }

        /** SEARCH DEALS COUNT **/

	public function get_search_deals_count($search = "",$maincatid="")
	{
	        $conditions = "enddate > ".time()." and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and  store_status = 1 and auction_status = 0 ";

		if(CITY_SETTING){
				$conditions .= "and stores.city_id = '$this->city_id' ";
		}
		if($maincatid!= 0) {

			$conditions .= " and category.category_id=$maincatid ";
		}

		if($search){
			$conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
			$conditions .= " or deal_description like '%".mysql_real_escape_string($search)."%')";
		}

		$query = "select deal_id from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id where  $conditions order by deal_id DESC";
		$result = $this->db->query($query);
	        return count($result);
	}

	/** GET SEARCH DEALS LIST **/

	public function  get_search_deals_list($search = "",  $offset = "", $record = "",$maincatid="")
	{
		 $conditions = "enddate > ".time()." and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and  store_status = 1 and auction_status = 0 ";

		if(CITY_SETTING){
				$conditions .= "and stores.city_id = '$this->city_id' ";
		}
		if($maincatid!= 0) {

			$conditions .= " and category.category_id=$maincatid ";
		}

		if($search){
			$conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
			$conditions .= " or deal_description like '%".mysql_real_escape_string($search)."%')";
		}


		$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,product_value,auction.enddate,stores.store_url_title,(select avg(rating) from rating where type_id=auction.deal_id and module_id=3) as avg_rating from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id where $conditions order by deal_id DESC limit $offset,$record";
		$result = $this->db->query($query);
	        return $result;
	}
	
	public function  get_hot_deals_view()
	{
	        if(CITY_SETTING){ 
		 $conditions = "enddate > ".time()." and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and  store_status = 1 and auction_status = 0 ";
		$query = "select *,(select avg(rating) from rating where type_id=auction.deal_id and module_id=3) as avg_rating from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id join users on users.user_id=stores.merchant_id join city on city.city_id=stores.city_id where $conditions and deal_feature = 1 and stores.city_id = '$this->city_id'  and users.user_status=1 and city.city_status=1 ORDER BY RAND() limit 4";
		$result = $this->db->query($query);
		} else {
		$conditions = "enddate > ".time()." and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and  store_status = 1 and auction_status = 0 ";
		$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,product_value,auction.enddate,store_url_title,(select avg(rating) from rating where type_id=auction.deal_id and module_id=3) as avg_rating from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id join users on users.user_id=stores.merchant_id join city on city.city_id=stores.city_id where $conditions and deal_feature = 1 and users.user_status=1 and city.city_status=1 ORDER BY RAND() limit 4";
		$result = $this->db->query($query);
		}
	        return $result;
	}
	
	/** GET DEALS DETAILS  **/

	public function get_deals_details($deal_key = "", $url_title = "",$type = "")
	{
	       
	        if($type == "admin-preview" && $type ="merchant-preview"){
			$condition = array("url_title" => $url_title, "deal_key" => $deal_key,"category.category_status" => 1, "store_status" => 1);
			} else {
			        $ip=$_SERVER['REMOTE_ADDR'];
			        
                                 /*$addr_details = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
                                $city = stripslashes(ucfirst($addr_details['geoplugin_city']));
				$country = stripslashes(ucfirst($addr_details['geoplugin_countryName'])); */
				$city = "";
				$country = "";
			        $count_view = $this->db->from("view_count_location")->where(array("deal_key" => $deal_key,"ip" =>$ip))->get();
			        if(count($count_view) == 0){
			                $this->db->insert("view_count_location", array("deal_key" => $deal_key,"ip" =>$ip,"city" => $city,"country" => $country,"date" => time()));
			                $this->db->query("update auction set view_count = view_count + 1 where deal_key = '$deal_key'");
			       }
			       $condition = array("url_title" => $url_title, "deal_key" => $deal_key, "auction.deal_status" => 1, "category.category_status" => 1, "store_status" => 1,"auction.deal_status" => 1);
			}
			$result = $this->db->select("*","stores.phone_number as phone","stores.address1 as addr1","stores.address2 as addr2")
                                        ->from("auction")
                                        ->where($condition)
                                        ->join("stores","stores.store_id","auction.shop_id")
                                        ->join("city","city.city_id","stores.city_id")
                                        ->join("country","country.country_id","stores.country_id")
                                        ->join("users","users.user_id","auction.merchant_id")
                                        ->join("category","category.category_id","auction.category_id")
                                        ->get();
                return $result;
	}
	/** INSERT BIDDING */
	public function insert_bidding($post = "")
	{
		$result1 = $this->db->from("bidding")->where(array("auction_id" => $post->bid_deal_id,"bid_amount" => $post->bid_value,"shipping_amount" => $post->shipping_amount))->get();
		if(count($result1)==0){
		$result = $this->db->insert("bidding",array("auction_id" => $post->bid_deal_id,"auction_title" =>$post->bid_title,"user_id" => $this->UserID,"bid_amount" => $post->bid_value,"shipping_amount" => $post->shipping_amount,"bidding_time" => time(),"end_time" => $post->end_time ));
		$this->db->query("update auction set deal_price = bid_increment + deal_price,bid_count = bid_count + 1 where deal_id = $post->bid_deal_id ");
		return count($result);
		}
		return 0;
	}
	/* GET AUCTION PAYMENT DETAILS */

	public function get_payment_auction_details($deal_id = "")
	{
		if($this->auction_club_condition_arr)
		
		$result = $this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->where($n_condition)->get();
		return $result;
	}
	/** GET RELATED CATEGORY DEALS LIST  **/

	public function get_related_category_deals_list($deal_id = "", $category_id = "")
	{
		$condition = array("deal_id <>" => $deal_id,"auction.sec_category_id" =>$category_id, "enddate >" => time(),"deal_status" => 1, "category.category_status" => 1, "store_status" => 1,"auction_status" => 0);
		if($this->auction_club_condition_arr)
		$condition = array("deal_id <>" => $deal_id,"auction.sec_category_id" =>$category_id, "enddate >" => time(),"deal_status" => 1, "for_store_cred" => 0, "category.category_status" => 1, "store_status" => 1,"auction_status" => 0);
	 if(CITY_SETTING){
		 
		 $condition = array("deal_id <>" => $deal_id,"auction.sec_category_id" =>$category_id, "stores.city_id" => $this->city_id, "enddate >" => time(),"deal_status" => 1, "category.category_status" => 1, "store_status" => 1,"city.city_status" => 1);
		 if($this->auction_club_condition_arr)
		 	$condition = array("deal_id <>" => $deal_id,"auction.sec_category_id" =>$category_id, "stores.city_id" => $this->city_id, "enddate >" => time(),"deal_status" => 1, "for_store_cred" => 0, "category.category_status" => 1, "store_status" => 1,"city.city_status" => 1);
		}

	        $result = $this->db->select("*","stores.phone_number as phone")->from("auction")
                                        ->where($condition)
                                        ->join("stores","stores.store_id","auction.shop_id")
                                        ->join("city", "city.city_id", "stores.city_id")
                                        ->join("category","category.category_id","auction.category_id")
                                        //->limit(2)
                                        ->get();
                return $result;
	}
	/** GET COMMENTS LIST **/

	public function get_comments_data($deal_id = "")
	{
		$result = $this->db->from("discussion")->join("users","users.user_id","discussion.user_id")->where(array("deal_id" => $deal_id,"discussion_status" => "1","delete_status" => 1,"type" =>3))->orderby("discussion_id", "DESC")->get();
		return $result;
	}

	/** ADD COMMENTS **/

	public function add_comments($comments = "" , $deal_id = "")
	{
	        $result = $this->db->insert("discussion", array("user_id" =>$this->UserID, "deal_id" => $deal_id, "comments" => $comments,"type" =>3, "created_date" => time()));
		return 0;
	}

	/** GET DEALS PAYMENT DETAILS

	public function get_deals_payment_details($deal_key = "", $url_title = "")
	{
	        $result = $this->db->from("deals")
			            ->where(array("url_title" => $url_title, "deal_key" => $deal_key,"deal_type" => 1,"deal_status" => 1))
				    ->get();
                return $result;
	}**/

        /** GET DEALS LIST **/

	public function get_store_lists()
	{
		 $contition = array("stores.city_id" => $this->city_id );
		 $result = $this->db->from("stores")
                                ->join("city","city.city_id","stores.city_id")
                                ->join("country","country.country_id","stores.country_id")
                                ->where($contition)
                                ->get();
		  return $result;
	}

	/** GET TRANSACTION LIST  **/

	public function get_auction_transaction_data($deal_id = "")
	{
		$result = $this->db->select("users.firstname","users.lastname","city_name","bidding_time as transaction_date","users.user_id","bidding.bid_amount","auction_id")->from("bidding")->join("users", "users.user_id", "bidding.user_id") ->join("city","city.city_id","users.city_id")->where(array("bidding.auction_id" => $deal_id))->orderby("bidding.bid_amount", "DESC")->get();
		return $result;
	}

	/** GET AUCTION WINNER TRANSACTION LIST  **/

	public function get_auction_winner_transaction_data($deal_id = "")
	{
	    $query = " SELECT * FROM transaction join users on users.user_id=transaction.user_id join city on city.city_id=users.city_id join country on country.country_id=users.country_id where transaction.deal_id = $deal_id ORDER BY bid_amount DESC LIMIT 1";
	        $result_high = $this->db->query($query);
	            if(count($result_high)>0){
	                    $bid_amount_high= $result_high->current()->bid_amount;
	                    $query_count = " SELECT * FROM transaction join users on users.user_id=transaction.user_id join city on city.city_id=users.city_id join country on country.country_id=users.country_id where transaction.deal_id = $deal_id and bid_amount = $bid_amount_high";
	                    $result = $this->db->query($query_count);
	                    return $result;
	            }
	return $result_high;
	}


	/** GET AUCTION MAP **/

	public function get_deals_list_map()
	{
				$contition = array("stores.city_id" => $this->city_id ,"enddate >" => time(), "deal_status" => 1,"city_status" => 1);

				if($this->auction_club_condition_arr)
	        		$contition = array("stores.city_id" => $this->city_id ,"enddate >" => time(), "deal_status" => 1, "for_store_cred" => 0,"city_status" => 1);
				
		        $result = $this->db->from("deals")
                                                ->join("stores","stores.store_id","deals.shop_id")
                                                ->join("city","city.city_id","stores.city_id")
                                                ->join("category","category.category_id","deals.category_id")
                                                ->where($contition)
                                                ->orderby("deals.enddate","ASC")
                                                ->get();
                return $result;
	}

	/** GET LIKE COUNT **/

	public function get_like_data($deal_id = "")
	{
		$result = $this->db->from('discussion_likes')->where(array('deal_id' => $deal_id))->get();
		return $result;
	}

	/** GET UNLIKE COUNT **/

	public function get_unlike_data($deal_id = "")
	{
		$result = $this->db->from('discussion_unlike')->where(array('deal_id' => $deal_id))->get();
		return $result;
	}

    /**COUNT LIKE  **/

    public function like1($deal_id = "",$user_id="",$dis_id = "")
    {

            $result = $this->db->insert("discussion_likes",array("discussion_id" => $dis_id, "deal_id" => $deal_id, "user_id" => $this->session->get('UserID')));
            $result = $this->db->from('discussion_unlike')->where(array("discussion_id" => $dis_id, "deal_id" => $deal_id, "user_id" => $this->session->get('UserID')))->get();
            if(count($result) > 0){
		$result = $this->db->delete('discussion_unlike', array("discussion_id" => $dis_id, "deal_id" => $deal_id, "user_id" => $this->session->get('UserID')));
			}
            return 1;
    }
    /* UNLIKE */
     public function unlike1($deal_id = "",$user_id="",$dis_id = "")
    {

            $result = $this->db->insert("discussion_unlike",array("discussion_id" => $dis_id, "deal_id" => $deal_id, "user_id" => $this->session->get('UserID')));
            $result = $this->db->from('discussion_likes')->where(array("discussion_id" => $dis_id, "deal_id" => $deal_id, "user_id" => $this->session->get('UserID')))->get();
            if(count($result) > 0){
			$result = $this->db->delete('discussion_likes', array("discussion_id" => $dis_id, "deal_id" => $deal_id, "user_id" => $this->session->get('UserID')));
			}
            return 1;
    }

	/** GET AUCTION LIKE COUNT **/

	public function get_like_details($dis_id = "")
	{
		$result = $this->db->from('discussion_likes')->where(array('discussion_id' => $dis_id))->get();
		return count($result);
	}
	/* GET AUCTION UNLIKE COUNT */
	public function get_unlike_details($dis_id = "")
	{
		$result = $this->db->from('discussion_unlike')->where(array('discussion_id' => $dis_id))->get();
		return count($result);
	}

	/** AUCTION WINNER LIST  **/

	public function get_winner_list($offset = "", $record = "")
	{
		$query = " SELECT auction.deal_title,auction.deal_key,auction.url_title,auction.product_value,auction.deal_value,auction.enddate,users.user_id,users.firstname,bidding.bid_amount,store_url_title FROM auction join users on users.user_id=auction.winner join bidding on bidding.auction_id = auction.deal_id join stores on stores.store_id=auction.shop_id join city on city.city_id=users.city_id join category on category.category_id=auction.category_id where auction.winner != 0 and auction.auction_status != 0 AND bidding.winning_status = 1 and users.user_status = 1 and stores.store_status = 1 and category_status = 1 limit $offset,$record ";
	$result_high = $this->db->query($query);
	return $result_high;

	}

	/** AUCTION WINNER 	COUNT  **/

	public function get_winner_count()
	{
	        $query = "SELECT auction.deal_id FROM auction join users on users.user_id=auction.winner join bidding on bidding.auction_id = auction.deal_id join stores on stores.store_id=auction.shop_id join city on city.city_id=users.city_id join category on category.category_id=auction.category_id where auction.winner != 0 and auction.auction_status != 0 AND bidding.winning_status = 1 and users.user_status = 1 and stores.store_status = 1 and category_status = 1  ";
            	$result_high = $this->db->query($query);
    	return count($result_high);
	}
	/** AUCTION RATING **/

	public function save_auction_rating($post="")
	{
		$result= $this->db->from("rating")->where(array("type_id" => $post->deal_id, "user_id" => $this->UserID))->get();
		if(count($result)==0)
		{
			$result = $this->db->insert("rating", array("type_id" => $post->deal_id, "user_id" => $this->UserID, "rating" => $post->rate, "module_id" => 3));
		}
		elseif(count($result)>0)
		{
			$result= $this->db->update("rating", array("rating" => $post->rate), array("type_id" => $post->deal_id, "user_id" => $this->UserID, "module_id" => 3));
		}
	}

	/** AUCTION RATING **/

	public function get_auction_rating($aucton_id="")
	{
    	$result= $this->db->from("rating")->where(array("type_id" => $aucton_id))->get();
		if(count($result)>0)
		{
			$get_rate = count($result);
			$sum= $this->db->query("select sum(rating) as sum from rating where type_id=$aucton_id AND module_id = 3");
			$get_sum=$sum->current()->sum;
			$average= $get_sum/$get_rate;
			return $average;
		}
		elseif(count($result)==0)
		{
			return 0;
		}
	}
	/* GET AUCTION RATING */
	public function get_all_auction_rating()
	{
		$result = $this->db->from('rating')->where('module_id',3)->get();
		return $result;
	}

	 /** GET DEALS LIST BY FILTER */

	 public function get_auctions_lists_byfilter($price_from,$price_to)
	  {
		if(CITY_SETTING){

				$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,auction.enddate from (auction)  join category on category.category_id=auction.category_id join stores on stores.store_id=auction.shop_id where enddate > ".time()." and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and  store_status = 1 and auction_status = 0  and stores.city_id = '$this->city_id' and auction.deal_value between $price_from and $price_to   order by deal_id ASC ";
				$result = $this->db->query($query);
				return $result;
		}
		else {

				$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,auction.enddate from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id where enddate > ".time()." and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and  store_status = 1 and auction_status = 0 and auction.deal_value between $price_from and $price_to  order by deal_id ASC ";
				$result = $this->db->query($query);
				return $result;
		}
	  }
	/* CHECK BIDDING AMOUNT EXISTS */
	public function check_exist_amount($amount = "",$auction_id = "")
	{
			return $this->db->count_records("bidding",array("auction_id" => $auction_id,"bid_amount" =>$amount));
	}

	/** GET DEALS SUB CATEGORY LIST **/

	public function get_subcategory_list($id="",$type="")
	{
		$conditions = array("category_status" => 1,"main_category_id !="=>0,"main_category_id"=>$id,"type"=> 2);
		if($type == 2){
			$conditions = array("category_status" => 1,"main_category_id !="=>0,"sub_category_id"=>$id,"type"=> 3);
		}
		if($type == 3){
			$conditions = array("category_status" => 1,"main_category_id !="=>0,"sub_category_id"=>$id,"type"=> 4);
		}
		$result = $this->db->from("category")->where($conditions)->orderby("category_name","ASC")->get();
		return $result;
	}

			/** GET DEALS LIST **/

	public function  get_auction_min_max()
	{

		if(CITY_SETTING){
		$query = "select MAX(deal_value) as max_deal,MIN(deal_value) as min_deal from auction join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id where  enddate > ".time()." and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and  store_status = 1 and auction_status = 0 and stores.city_id = '$this->city_id'   order by deal_id  ";
		$result = $this->db->query($query);

		} else {
		$query = "select MAX(deal_value) as max_deal, MIN(deal_value) as min_deal from auction join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id where  enddate > ".time()." and   deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and auction_status = 0 and  store_status = 1  order by deal_id ";
		$result = $this->db->query($query);

		}
		return $result;
	}

	/** GET AUCTION SUB CATEGORY LIST **/

	public function get_main_category($category="")
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"category_url"=>$category))->orderby("category_name","ASC")->get();
		return $result;
	}

	/** GET AUCTION SUB CATEGORY LIST **/

	public function get_main_categoryname($category_id="")
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"category_id"=>$category_id))->orderby("category_name","ASC")->get();
		return $result;
	}

	/** GET CATEGORY NAME  **/

	public function get_categoryname($category = "" )
	{
		$result = $this->db->from('category')->where(array("category_url" => $category))->get();
		return $result;
	}

	/** GET DEALS LIST **/

	public function  get_ajax_auctions_list($price="",$main_cat="",$sub_cat="",$sec_cat="",$third_cat="",$price_text="",$type="")
	{
		$join =" join category on category.category_id=auction.category_id";

		$conditions = "";

		if($main_cat){
			 $conditions .= " and category.category_url='$main_cat'";
		}
		if($sub_cat){
			$conditions .= " and category.category_url='$sub_cat'";
			$join ="join category on category.category_id=auction.sub_category_id";
		}
		if($sec_cat){
			$conditions .= " and category.category_url='$sec_cat'";
			$join ="join category on category.category_id=auction.sec_category_id";
		}
		if($third_cat){
			$conditions .= " and category.category_url='$third_cat'";
			$join ="join category on category.category_id=auction.third_category_id";
		}

		/*if($discount){
			$discount = rtrim($discount, ",");
			$discount1 = explode(',',$discount);
			$arr = array("1" => "<10", "2" => "10 and 20", "3" => "20 and 30", "4" => "30 and 50", "5" => "50 and 75", "6" => ">75");

			if(count($discount1) == 1){

				$val = $discount1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (deals.deal_percentage $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($discount1); $i++){
					$val = $discount1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (deals.deal_percentage between $arr[$val]";
						}else{
							$conditions .="and (deals.deal_percentage $arr[$val]";
						}
					}else if($i == count($discount1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or deals.deal_percentage between $arr[$val])";
						}else{
							$conditions .=" or deals.deal_percentage $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or deals.deal_percentage between $arr[$val]";
						}else{
							$conditions .=" or deals.deal_percentage $arr[$val]";
						}
					}
				}
			}
		}  */

		if($price){
			$price = rtrim($price, ",");
			$price1 = explode(',',$price);
			$arr = array("1" => "<500", "2" => "501 and 1000", "3" => "1001 and 1500", "4" => "1501 and 2000", "5" => "2001 and 2500", "6" => ">2500");

			if(count($price1) == 1){

				$val = $price1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (auction.deal_value $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($price1); $i++){
					$val = $price1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (auction.deal_value between $arr[$val]";
						}else{
							$conditions .="and (auction.deal_value $arr[$val]";
						}
					}else if($i == count($price1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or auction.deal_value between $arr[$val])";
						}else{
							$conditions .=" or auction.deal_value $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or auction.deal_value between $arr[$val]";
						}else{
							$conditions .=" or auction.deal_value $arr[$val]";
						}
					}
				}
			}
		}

		if($price_text){
			$price_text = str_replace(array(CURRENCY_SYMBOL," "),"",$price_text);
			$price_array = explode("-", $price_text);
			$conditions .=" and auction.deal_value between $price_array[0] and $price_array[1]";
		}

		$pagin = "";
		if($type != 1){
			$pagin = " limit 12";
		}

		if(CITY_SETTING){
			$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,auction.enddate,stores.store_url_title from auction join stores on stores.store_id=auction.shop_id $join where enddate > ".time()." and  deal_status = 1 ".$this->auction_club_condition."  and auction_status = 0 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id'  $conditions group by auction.deal_id order by auction.deal_id DESC $pagin";
		$result = $this->db->query($query);

		} else {
			$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,auction.enddate,stores.store_url_title from auction  join stores on stores.store_id=auction.shop_id $join where enddate > ".time()." and auction_status = 0 and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and  store_status = 1 $conditions group by auction.deal_id order by auction.deal_id DESC $pagin";
			$result = $this->db->query($query);

		}
		//print_r($result);
		return $result;
	}

	// for shipping address used in payment pages

	public function get_user_data_list()
	{
		$result = $this->db->from("users")
				   ->join("city","city.city_id","users.ship_city")
				   ->join("country","country.country_id","users.ship_country")
				   ->where(array("user_id" => $this->UserID))
				   ->get();
		return $result;
	}
	
	public function  get_hot_all_deals_view($deal_id = "")
	{
	
	         if(CITY_SETTING){
				
				$conditions = "enddate > ".time()." and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and  store_status = 1 and auction_status = 0 and deal_id <> '$deal_id' and stores.city_id = '$this->city_id'";

		$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,product_value,auction.enddate from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id where $conditions and deal_feature = 1 ORDER BY RAND()";
		$result = $this->db->query($query);
	        return $result;
	        
		}
		else {
		 $conditions = "enddate > ".time()." and  deal_status = 1 ".$this->auction_club_condition."  and category.category_status = 1 and  store_status = 1 and auction_status = 0 and stores.city_id = '$this->city_id'";

		$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price, category.category_url,product_value,auction.enddate from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=auction.category_id where $conditions and deal_feature = 1 ORDER BY RAND()";
		$result = $this->db->query($query);
	        return $result;
	        
	        }
	}
        
	public function get_store_id($storeurl="") 
	{ 
			$result = $this->db->select("store_id")->from("stores")->where(array("store_url_title"=>$storeurl))->get();
			return $result->current()->store_id;
	}

	public function get_theme_name($store_id=''){
		$result = $this->db->select("sector_name")->from("stores")->join("sector","sector.sector_id","stores.store_subsector_id")->where("store_id",$store_id)->get();
		if(count($result)>0)
			return strtolower($result[0]->sector_name);
		return "default";
	}
	
	public function get_merchant_details($merchant_id=''){
		$result = $this->db->select("*")->from("users")->join("city","city.city_id","users.city_id","left")->join("country","country.country_id","users.country_id","left")->where("user_id",$merchant_id)->get();
		return $result;
	}
}
