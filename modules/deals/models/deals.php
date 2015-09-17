<?php defined('SYSPATH') or die('No direct script access.');
class Deals_Model extends Model
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
		
		(strcmp($_SESSION['Club'], '0') == 0)?$this->deal_club_condition = 'and deals.for_store_cred = '.$_SESSION['Club'].' ':$this->deal_club_condition = '';
		(strcmp($_SESSION['Club'], '0') == 0)?$this->deal_club_condition_arr = true:$this->deal_club_condition_arr = false;
		
	}

	/* GET BANNER LIST */
	public function get_banner_list()
	{
		$result = $this->db->from("banner_image")->where(array("status" => 1, "deal" => 1))->get();
		return $result;
	}

	/** TODAY DEALS COUNT**/

        public function get_today_deals_count($category = "")
	{
		$conditions = "";
                if($category){
                        $conditions = "and category.category_id IN ($category)";
                }
                if(CITY_SETTING){
                        $query = "select deal_id from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id' $conditions order by deal_id DESC ";
                        $result = $this->db->query($query);
                        return count($result);
                } else {
                        $query = "select deal_id from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1  $conditions order by deal_id DESC ";
                        $result = $this->db->query($query);
                        return count($result);
                }
        }

        /** GET TODAY DEALS LIST **/

	public function get_today_deals_list($offset = "", $record = "",$category = "",$discount="",$price="",$main_cat="",$sub_cat="",$sec_cat="",$third_cat="",$price_text="")
	{

		$join =" join category on category.category_id=deals.category_id";
		$conditions = "";
		if($main_cat){
			 $conditions .= " and category.category_url='$main_cat'";
		}
		if($sub_cat){
			$conditions .= " and category.category_url='$sub_cat'";
			$join ="join category on category.category_id=deals.sub_category_id";
		}
		if($sec_cat){
			$conditions .= " and category.category_url='$sec_cat'";
			$join ="join category on category.category_id=deals.sec_category_id";
		}
		if($third_cat){
			$conditions .= " and category.category_url='$third_cat'";
			$join ="join category on category.category_id=deals.third_category_id";
		}

		if($discount){
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
		}

		if($price){
			$price = rtrim($price, ",");
			$price1 = explode(',',$price);
			$arr = array("1" => "<500", "2" => "501 and 1000", "3" => "1001 and 1500", "4" => "1501 and 2000", "5" => "2001 and 2500", "6" => ">2500");

			if(count($price1) == 1){

				$val = $price1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (deals.deal_value $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($price1); $i++){
					$val = $price1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (deals.deal_value between $arr[$val]";
						}else{
							$conditions .="and (deals.deal_value $arr[$val]";
						}
					}else if($i == count($price1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or deals.deal_value between $arr[$val])";
						}else{
							$conditions .=" or deals.deal_value $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or deals.deal_value between $arr[$val]";
						}else{
							$conditions .=" or deals.deal_value $arr[$val]";
						}
					}
				}
			}
		}

		if($price_text){
			$price_text = str_replace(array(CURRENCY_SYMBOL," "),"",$price_text);
			$price_array = explode("-", $price_text);
			$conditions .=" and deals.deal_value between $price_array[0] and $price_array[1]";
		}

			$conditions = "";
			if($category){
			$conditions = "and category.category_id IN ($category)";
				}

		if(CITY_SETTING){

		$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,stores.store_url_title,(select avg(rating) from rating where type_id=deals.deal_id and module_id=1) as avg_rating from deals  join stores on stores.store_id=deals.shop_id $join  where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id' $conditions order by deal_id DESC limit $offset,$record";
		$result = $this->db->query($query);

		} else {
		$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,stores.store_url_title,(select avg(rating) from rating where type_id=deals.deal_id and module_id=1) as avg_rating from deals  join stores on stores.store_id=deals.shop_id $join  where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1 $conditions order by deal_id DESC limit $offset,$record";
		$result = $this->db->query($query);

		}
		  return $result;

	}


	/** ALL DEALS AND CATEGORY DEALS COUNT **/

        public function get_deals_count($cat_type,$category = "")
	{
		$conditions = "deal_status = 1 ".$this->deal_club_condition." AND enddate > ".time()." AND startdate < ".time()." AND purchase_count < maximum_deals_limit  AND category.category_status = 1 AND store_status = 1 " ;
		$join = "deals.category_id";

		if(CITY_SETTING){
				$conditions .= " AND stores.city_id = $this->city_id ";
		}
		if($category && $cat_type=='main'){
			$conditions .= " AND category.category_url =  '$category' ";
		}
		else if($category && $cat_type=='sub'){
			$conditions .= " AND category.category_url =  '$category' ";
			$join = "deals.sub_category_id";
		}
		else if($category && $cat_type=='sec'){
			$conditions .= " AND category.category_url =  '$category' ";
			$join = "deals.sec_category_id";
		}
		else if($category && $cat_type=='third'){
			$conditions .= " AND category.category_url =  '$category' ";
			$join = "deals.third_category_id";
		}
		        $result = $this->db->query("select deals.deal_id from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id = $join where $conditions group by deal_id order by deal_id DESC ");
         		return count($result);
        }



     /** ALL DEALS AND CATEGORY DEALS LIST **/

	public function get_deals_list($cat_type,$category = "", $offset = "", $record = "")
	{
		 $conditions = " deal_status = 1 ".$this->deal_club_condition."  AND enddate > ".time()." AND startdate < ".time()." AND purchase_count < maximum_deals_limit AND category.category_status = 1 AND store_status = 1 " ;
			$join = "deals.category_id";
		if(CITY_SETTING){
				$conditions .= " AND stores.city_id = $this->city_id ";
		}
		if($category && $cat_type=='main'){
			$conditions .= " AND category.category_url =  '$category' ";
		}
		else if($category && $cat_type=='sub'){
			$conditions .= " AND category.category_url =  '$category' ";
			$join = "deals.sub_category_id";
		}
		else if($category && $cat_type=='sec'){
			$conditions .= " AND category.category_url =  '$category' ";
			$join = "deals.sec_category_id";
		}
		else if($category && $cat_type=='third'){
			$conditions .= " AND category.category_url =  '$category' ";
			$join = "deals.third_category_id";
		}

			$result = $this->db->query("select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,stores.store_url_title,(select avg(rating) from rating where type_id=deals.deal_id and module_id=1) as avg_rating  from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id = $join where $conditions group by deal_id order by deal_id DESC limit $offset,$record ");
			//print_r($result);
		return $result;
	}


        /** SEARCH DEALS COUNT **/

	public function get_search_deals_count($search = "",$maincatid="")
	{
	     $conditions = " enddate >".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1 ";
		if(CITY_SETTING){
			$conditions .= " and stores.city_id = '$this->city_id' ";
		}
		if($search){
			$conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
			$conditions .= " or deal_description like '%".mysql_real_escape_string($search)."%')";
		}
		if($maincatid!= 0) {

			$conditions .= " and category.category_id=$maincatid ";
		}
		$query = "select deal_id from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where $conditions order by deal_id DESC";
		$result = $this->db->query($query);
		        return count($result);
	}

	/** GET SEARCH DEALS LIST **/

	public function  get_search_deals_list($search = "",  $offset = "", $record = "",$maincatid="")
	{
		$conditions = " enddate >".time()." AND purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1 ";
			if(CITY_SETTING){
				$conditions .= " and stores.city_id = '$this->city_id' ";
			}
			if($search){
				$conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
				$conditions .= " or deal_description like '%".mysql_real_escape_string($search)."%')";
			}
			if($maincatid!= 0) {

				$conditions .= " and category.category_id=$maincatid ";
			}

		$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url,deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,stores.store_url_title,(select avg(rating) from rating where type_id=deals.deal_id and module_id=1) as avg_rating  from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where $conditions order by deal_id DESC limit $offset,$record";
		$result = $this->db->query($query);
	        return $result;
	}

	/** MOST VIEW DEALS LIST **/

	public function get_deals_view()
	{
	
	if(CITY_SETTING){ 
	$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,stores.store_url_title,(select avg(rating) from rating where type_id=deals.deal_id and module_id=1) as avg_rating  from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and stores.city_id = '$this->city_id' and  store_status = 1 order by deals.view_count DESC limit 3 ";

	$result = $this->db->query($query);
	} else {
	$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,stores.store_url_title,(select avg(rating) from rating where type_id=deals.deal_id and module_id=1) as avg_rating  from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1 order by deals.view_count DESC limit 3 ";

	$result = $this->db->query($query);
	}
		return $result;
	}

	public function get_hot_deals_view()
	{
	if(CITY_SETTING){ 
	$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,store_url_title,(select avg(rating) from rating where type_id=deals.deal_id and module_id=1) as avg_rating  from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  deal_feature =  1 and store_status = 1 and stores.city_id = '$this->city_id' ORDER BY RAND() limit 4";

	$result = $this->db->query($query);
	
	} else {
	$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,store_url_title,(select avg(rating) from rating where type_id=deals.deal_id and module_id=1) as avg_rating  from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1  ".$this->deal_club_condition."  and category.category_status = 1 and  deal_feature =  1 and store_status = 1 ORDER BY RAND() limit 4";

	$result = $this->db->query($query);
	}
		return $result;
	}

	/** GET DEALS DETAILS  **/

	public function get_deals_details($deal_key = "", $url_title = "",$type = "")
	{
			if($type == "admin-preview" || $type == "merchant-preview"){
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
			                $this->db->query("update deals set view_count = view_count + 1 where deal_key = '$deal_key'");
			       }
				 $condition = array("url_title" => $url_title, "deal_key" => $deal_key, "deal_status" => 1, "category.category_status" => 1, "store_status" => 1);
				 
				 $condition = array("url_title" => $url_title, "deal_key" => $deal_key, "deal_status" => 1, "for_store_cred" => 0, "category.category_status" => 1, "store_status" => 1);
				if($this->deal_club_condition_arr)
				$condition = array("url_title" => $url_title, "deal_key" => $deal_key, "deal_status" => 1, "for_store_cred" => 0, "category.category_status" => 1, "store_status" => 1);
			}
	        $result = $this->db->select("*","stores.phone_number as phone","stores.address1 as addr1","stores.address2 as addr2")
					->from("deals")
			                ->where($condition)
					->join("stores","stores.store_id","deals.shop_id")
			                ->join("city","city.city_id","stores.city_id")
			                ->join("country","country.country_id","stores.country_id")
					->join("users","users.user_id","deals.merchant_id")
					->join("category","category.category_id","deals.category_id")
	 	                        ->get();
                return $result;
	}



	/** GET RELATED CATEGORY DEALS LIST  **/

	public function get_related_category_deals_list($deal_id = "", $category_id = "")
	{

		$condition = "deal_id != $deal_id AND purchase_count < maximum_deals_limit AND deals.sec_category_id = $category_id AND enddate > ".time()." AND startdate < ".time()." AND deal_status = 1 ".$this->deal_club_condition."  AND category.category_status = 1 AND store_status = 1 ";
	 if(CITY_SETTING){
		$condition = "deal_id != $deal_id AND purchase_count < maximum_deals_limit AND deals.sec_category_id = $category_id AND stores.city_id = $this->city_id AND enddate > ".time()." AND startdate < ".time()." AND deal_status = 1 ".$this->deal_club_condition."  AND category.category_status = 1 AND store_status = 1 AND city.city_status = 1 ";

		// $condition = array("deal_id <>" => $deal_id,"deals.category_id" =>$category_id, "stores.city_id" => $city_id, "enddate >" => time(),"startdate <" => time(),"deal_status" => 1, "category.category_status" => 1, "store_status" => 1);
		}
	 $result = $this->db->query("select *,stores.phone_number as phone from deals join stores ON stores.store_id = deals.shop_id join city ON city.city_id = stores.city_id join category ON category.category_id = deals.category_id where $condition order by deal_id DESC ");

/*	        $result = $this->db->select("*","stores.phone_number as phone")->from("deals")
	                        ->where(array("deal_id <>" => $deal_id,"deals.category_id" =>$category_id, "stores.city_id" => $this->city_id, "enddate >" => time(),"startdate <" => time(),"deal_status" => 1, "category.category_status" => 1, "store_status" => 1))
			        ->join("stores","stores.store_id","deals.shop_id")
				->join("category","category.category_id","deals.category_id")
				//->limit(3)
 	                        ->get();  */
                return $result;
	}




	/** GET COMMENTS LIST **/

	public function get_comments_data($deal_id = "",$type = "")
	{

		$result = $this->db->from("discussion")
						   ->join("users","users.user_id","discussion.user_id")
						   ->where(array("deal_id" => $deal_id,"discussion_status" => "1","delete_status" => 1,"type" =>$type))->orderby("discussion_id", "DESC")->get();
		return $result;
	}

	/** GET LIKE COUNT **/

	public function get_like_data($deal_id = "",$type = "")
	{
		$result = $this->db->from('discussion_likes')->where(array('deal_id' => $deal_id,"type" =>$type))->get();
		return $result;
	}

	/** GET UNLIKE COUNT **/

	public function get_unlike_data($deal_id = "",$type = "")
	{
		$result = $this->db->from('discussion_unlike')->where(array('deal_id' => $deal_id,"type" =>$type))->get();
		return $result;
	}



	/** GET DEALS PAYMENT DETAILS  **/

	public function get_deals_payment_details($deal_key = "", $url_title = "")
	{
		 $n_condition = array("url_title" => $url_title, "deal_key" => $deal_key,"deal_status" => 1);
		 if($this->deal_club_condition_arr)
		  	$n_condition = array("url_title" => $url_title, "deal_key" => $deal_key,"deal_status" => 1, "for_store_cred" => 0);
		 
	        $result = $this->db->from("deals")
			            ->where($n_condition)
				    ->get();
                return $result;
	}

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




	/** AUCTION RATING **/

	public function save_deal_rating($post="")
	{
		$result= $this->db->from("rating")->where(array("type_id" => $post->deal_id, "user_id" => $this->UserID))->get();

		if(count($result)==0)
		{
			$result = $this->db->insert("rating", array("type_id" => $post->deal_id, "user_id" => $this->UserID, "rating" => $post->rate, "module_id" => 1));
		}
		elseif(count($result)>0)
		{
			$result= $this->db->update("rating", array("rating" => $post->rate), array("type_id" => $post->deal_id, "user_id" => $this->UserID, "module_id" => 1));
		}
	}

	/** AUCTION RATING **/

	public function get_deal_rating($deal_id="")
	{

		$result= $this->db->from("rating")->where(array("type_id" => $deal_id))->get();
		if(count($result)>0)
		{
			$get_rate = count($result);
			$sum= $this->db->query("select sum(rating) as sum from rating where type_id=$deal_id AND module_id = 1");
			$get_sum=$sum->current()->sum;
			$average= $get_sum/$get_rate;
			return $average;
		}
		elseif(count($result)==0)
		{
			return 0;
		}
	}
	
	public function get_deal_rating_sum($deal_id="")
	{

		$result= $this->db->from("rating")->where(array("type_id" => $deal_id))->get();
		if(count($result)>0)
		{
			$get_rate = count($result);
			$sum= $this->db->query("select sum(rating) as sum from rating where type_id=$deal_id AND module_id = 1");
			$get_sum=$sum->current()->sum;
			return $get_sum;
		}
		elseif(count($result)==0)
		{
			return 0;
		}
	}


		/** GET DEALS LIST **/

	public function  get_deals_min_max()
	{


		if(CITY_SETTING){
		$query = "select MAX(deal_value) as max_deal,MIN(deal_value) as min_deal,MAX(deal_savings) as max_per,MIN(deal_savings) as min_per from deals join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where  enddate > ".time()." and startdate < ".time()." and purchase_count < maximum_deals_limit  and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id'   order by deal_id  ";
		$result = $this->db->query($query);


	        return $result;
		}

		 else {

			$query = "select MAX(deal_value) as max_deal, MIN(deal_value) as min_deal ,MAX(deal_savings) as max_per,MIN(deal_savings) as min_per from deals join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where  enddate > ".time()." and startdate < ".time()." and purchase_count < maximum_deals_limit  and  deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1  order by deal_id ";
			$result = $this->db->query($query);

	        return $result;
		}
	}

		  /** GET DEALS LIST BY FILTER */

	 public function get_deals_lists_byfilter1($price_from="",$price_to="",$discount_from="",$discount_to="")
	  {

		if(CITY_SETTING){

				if($price_from == 0)
				{
					$price_to = 100000;
				}

				if($discount_from == 0)
				{
					$discount_to= 100;
				}

				$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where enddate > ".time()." and startdate <".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id' and deals.deal_value between $price_from and $price_to and deals.deal_percentage between $discount_from and $discount_to  order by deal_id ASC ";
				$result = $this->db->query($query);


				return $result;
		}
		else {
				if($price_from == 0)
				{
					$price_to = 100000;
				}


				if($discount_from == 0)
				{
					$discount_to= 100;
				}

				$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where  enddate > ".time()." and startdate <".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1  and deals.deal_value between $price_from and $price_to and deals.deal_percentage between $discount_from and $discount_to  order by deal_id ASC ";
				$result = $this->db->query($query);


				return $result;

		}
	  }

	/** GET DEALS CATEGORY LIST **/

	public function get_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"main_category_id"=>0))->orderby("category_name","ASC")->get();

		return $result;
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

	/** GET DEALS SUB CATEGORY LIST **/

	public function get_main_category($category="")
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"category_url"=>$category))->orderby("category_name","ASC")->get();
		return $result;
	}

			/** GET DEALS SUB CATEGORY LIST **/

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

	/** GET DEALS  COUNT  **/
	/*public function get_ajax_deals_count($discount="",$price ="",$main_cat="",$sub_cat="",$sec_cat="",$third_cat="")
	{
		$join =" join category on category.category_id=deals.category_id";

		$conditions = "";

		if($main_cat){
			 $conditions .= " and category.category_url='$main_cat'";
		}
		if($sub_cat){
			$conditions .= " and category.category_url='$sub_cat'";
			$join ="join category on category.category_id=deals.sub_category_id";
		}
		if($sec_cat){
			$conditions .= " and category.category_url='$sec_cat'";
			$join ="join category on category.category_id=deals.sec_category_id";
		}
		if($third_cat){
			$conditions .= " and category.category_url='$third_cat'";
			$join ="join category on category.category_id=deals.third_category_id";
		}

		if($discount){
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
		}

		if($price){
			$price = rtrim($price, ",");
			$price1 = explode(',',$price);
			$arr = array("1" => "<500", "2" => "501 and 1000", "3" => "1001 and 1500", "4" => "1501 and 2000", "5" => "2001 and 2500", "6" => ">2500");

			if(count($price1) == 1){

				$val = $price1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (deals.deal_value $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($discount1); $i++){
					$val = $discount1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (deals.deal_value between $arr[$val]";
						}else{
							$conditions .="and (deals.deal_value $arr[$val]";
						}
					}else if($i == count($discount1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or deals.deal_value between $arr[$val])";
						}else{
							$conditions .=" or deals.deal_value $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or deals.deal_value between $arr[$val]";
						}else{
							$conditions .=" or deals.deal_value $arr[$val]";
						}
					}
				}
			}
		}

		if(CITY_SETTING){
		$query = "select deals.deal_id from deals join stores on stores.store_id=deals.shop_id $join where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id'  $conditions group by deals.deal_id order by deals.deal_id DESC";
		$result = $this->db->query($query);

		} else {
			$query = "select deals.deal_id from deals  join stores on stores.store_id=deals.shop_id $join where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 $conditions group by deals.deal_id order by deals.deal_id DESC";
			$result = $this->db->query($query);

		} print_r($result);
		return count($result);
	} */

	/** GET DEALS LIST **/

	public function  get_ajax_deals_list($discount="",$price="",$main_cat="",$sub_cat="",$sec_cat="",$third_cat="",$price_text="",$type="")
	{
		$join =" join category on category.category_id=deals.category_id";

		$conditions = "";

		if($main_cat){
			 $conditions .= " and category.category_url='$main_cat'";
		}
		if($sub_cat){
			$conditions .= " and category.category_url='$sub_cat'";
			$join ="join category on category.category_id=deals.sub_category_id";
		}
		if($sec_cat){
			$conditions .= " and category.category_url='$sec_cat'";
			$join ="join category on category.category_id=deals.sec_category_id";
		}
		if($third_cat){
			$conditions .= " and category.category_url='$third_cat'";
			$join ="join category on category.category_id=deals.third_category_id";
		}

		if($discount){
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
		}

		if($price){
			$price = rtrim($price, ",");
			$price1 = explode(',',$price);
			$arr = array("1" => "<500", "2" => "501 and 1000", "3" => "1001 and 1500", "4" => "1501 and 2000", "5" => "2001 and 2500", "6" => ">2500");

			if(count($price1) == 1){

				$val = $price1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (deals.deal_value $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($price1); $i++){
					$val = $price1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (deals.deal_value between $arr[$val]";
						}else{
							$conditions .="and (deals.deal_value $arr[$val]";
						}
					}else if($i == count($price1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or deals.deal_value between $arr[$val])";
						}else{
							$conditions .=" or deals.deal_value $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or deals.deal_value between $arr[$val]";
						}else{
							$conditions .=" or deals.deal_value $arr[$val]";
						}
					}
				}
			}
		}

		if($price_text){
			$price_text = str_replace(array(CURRENCY_SYMBOL," "),"",$price_text);
			$price_array = explode("-", $price_text);
			$conditions .=" and deals.deal_value between $price_array[0] and $price_array[1]";
		}

		$pagin = "";
		if($type != 1){
			$pagin = " limit 12";
		}


		if(CITY_SETTING){
		$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,stores.store_url_title from deals join stores on stores.store_id=deals.shop_id $join where purchase_count < maximum_deals_limit and  enddate > ".time()." and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id'  $conditions group by deals.deal_id order by deals.deal_id DESC $pagin";
		$result = $this->db->query($query);

		} else {
			$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,stores.store_url_title from deals  join stores on stores.store_id=deals.shop_id $join where purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and enddate > ".time()." and category.category_status = 1 and  store_status = 1 $conditions group by deals.deal_id order by deals.deal_id DESC $pagin";
			$result = $this->db->query($query);

		}
		//print_r($result);
		return $result;
	}
	
	public function get_hot_all_deals_view($deal_id = "")
	{
	
	 if(CITY_SETTING){
				
				$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,store_url_title from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition."  and category.category_status = 1 and deal_id <> '$deal_id' and stores.city_id = '$this->city_id' and  deal_feature =  1 and store_status = 1 ORDER BY RAND()";
		$result = $this->db->query($query);
				return $result;
		}
		else {
	                        $query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,store_url_title from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 ".$this->deal_club_condition." and category.category_status = 1 and deal_id <> '$deal_id' and  deal_feature =  1 and store_status = 1 ORDER BY RAND()";
	$result = $this->db->query($query);
	
		return $result;
		}
	}
	
	/** GET LIKE COUNT **/

	public function get_deal_purchased_count($deal_id = "",$user_id = "")
	{
		$result = $this->db->from('transaction_mapping')->where(array('deal_id' => $deal_id,"user_id" =>$user_id))->get();
		return count($result);
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
