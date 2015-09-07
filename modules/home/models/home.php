<?php defined('SYSPATH') or die('No direct script access.');
class Home_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->city_id = $this->session->get("CityID");
		$this->UserID = $this->session->get("UserID");
	}

	/* GET MODULE SETTING LIST */
	public function get_setting_module_list()
	{
		$result = $this->db->from("module_settings")->get();
		return $result;
	}

	/* GET ADS LIST */
	public function get_ads_list()
	{
		$result = $this->db->from("ads")->where(array("status" => 1))->get();
		return $result;
	}

	/** GET THE IMAGE RESIZE DATA LIST  AND THIS FUNCTION USED IN WEBSITE CONTROLLER **/
	public function get_image_resize_data()
	{
		$result = $this->db->from("image_resize")->in('type', array(5,6))->get(); 
		return $result;
	}
	
       /** GET PRODUCTS DETAILS **/
	public function products_details($cityid="", $category_id = "")
	{
		$conditions="";
		if($this->session->get("prime_customer")==1)
		{
			$conditions=" and product.product_duration!='' ";
		}
		if(CITY_SETTING){
		        
			$result = $this->db->query("select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage,stores.store_url_title from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id  where deal_status = 1 and  store_status = 1 and product.category_id = '$category_id' and stores.city_id = '$cityid'  and purchase_count < user_limit_quantity $conditions order by deal_id DESC limit 4 ");
		} else {
			$result = $this->db->query("select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage,stores.store_url_title from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id  where deal_status = 1 and  store_status = 1  and product.category_id = '$category_id' and purchase_count < user_limit_quantity $conditions order by deal_id DESC limit 4 ");
	       
		} 
		return $result;
	}
	
	/** GET PRODUCTS DETAILS **/
	public function products_details1($cityid="", $category_id = "")
	{
		if(CITY_SETTING){
			$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id  where deal_status = 1 and  store_status = 1 and product.category_id = '$category_id'  and stores.city_id = '$cityid'  and purchase_count < user_limit_quantity order by deal_id DESC ");
	         return count($result);
		} else {
			$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id  where deal_status = 1 and  store_status = 1  and product.category_id = '$category_id' and purchase_count < user_limit_quantity order by deal_id DESC  ");
	        return count($result);
		}
	}
	
	/** GET DEALS DETAILS **/
	public function deals_details($cityid="")
	{
		if(CITY_SETTING) {
			$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id  where deal_status = 1 and startdate < ".time()." and enddate > ".time()." and  store_status = 1 and  category.category_status = 1  and purchase_count < maximum_deals_limit and stores.city_id ='$cityid' order by deal_id DESC limit 4");
		} else { 
			$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id  where deal_status = 1 and startdate < ".time()." and enddate > ".time()." and  store_status = 1 and  category.category_status = 1 and  purchase_count < maximum_deals_limit order by deal_id DESC limit 4"); 
		} 
		 return $result;
	}
	
	/** GET DEALS DETAILS **/
	public function deals_details1($cityid="")
	{
		if(CITY_SETTING) {
			$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id  where deal_status = 1 and startdate < ".time()." and enddate > ".time()." and  store_status = 1 and  category.category_status = 1  and purchase_count < maximum_deals_limit and stores.city_id ='$cityid' order by deal_id DESC ");
		} else { 
			$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id  where deal_status = 1 and startdate < ".time()." and enddate > ".time()." and  store_status = 1 and  category.category_status = 1  and purchase_count < maximum_deals_limit order by deal_id DESC ");
		} 
		return count($result);
	}
		/** GET AUCTION DETAILS **/

	public function auction_details($cityid="")
	{
		if(CITY_SETTING) {
                    $result = $this->db->from("auction")
					->where(array("deal_status" => 1,"enddate >" => time(),"startdate <" => time(),"stores.city_id" => $cityid,"category.category_status" => 1, "store_status" => 1,"auction_status" => 0))
					->join("category","category.category_id","auction.category_id")
					->join("stores","stores.store_id","auction.shop_id")
					->orderby("deal_id","DESC")
					->limit("4")
					->get();
	        return $result;
		} else { 
			 $result = $this->db->from("auction")
					->where(array("deal_status" => 1,"enddate >" => time(),"startdate <" => time(),"category.category_status" => 1, "store_status" => 1,"auction_status" => 0))
					->join("category","category.category_id","auction.category_id")
					->join("stores","stores.store_id","auction.shop_id")
					->orderby("deal_id","DESC")
					->limit("4")
					->get();
	        return $result;
		}
		
	}
			/** GET AUCTION DETAILS **/

	public function auction_details1($cityid="")
	{
		if(CITY_SETTING) {
                    $result = $this->db->from("auction")
					->where(array("deal_status" => 1,"enddate >" => time(),"startdate <" => time(),"stores.city_id" => $cityid,"category.category_status" => 1, "store_status" => 1,"auction_status" => 0))
					->join("category","category.category_id","auction.category_id")
					->join("stores","stores.store_id","auction.shop_id")
					->orderby("deal_id","DESC")
			
					->get();
	       return count($result);
		} else { 
			 $result = $this->db->from("auction")
					->where(array("deal_status" => 1,"enddate >" => time(),"startdate <" => time(),"category.category_status" => 1, "store_status" => 1,"auction_status" => 0))
					->join("category","category.category_id","auction.category_id")
					->join("stores","stores.store_id","auction.shop_id")
					->orderby("deal_id","DESC")
					->get();
	      return count($result);
		}
	}
		
	/** GET CITY LIST JOIN COUNTRY **/

	public function get_all_city_list()
	{
		$result = $this->db->from("city")->join("country","country.country_id","city.country_id")->where(array("city_status" => 1,"country_status" => 1))->orderby("city_name", "ASC")->get();
		return $result;
	}
	
	/** GET COUNTRY LIST JOIN COUNTRY **/

	public function get_all_country_list()
	{
		$result = $this->db->from("country")->where(array("country_status" => 1))->orderby("country_name", "ASC")->get();
		return $result;
	}


	/** ADD SUBSCRIBE TO USER EMAIL ADDRESS **/

	public function add_user_subscribe($email = "", $city_data = "")
	{
		if(CITY_SETTING) {
			$Cdata = explode("_", $city_data);
			if(isset($Cdata[0]) && isset($Cdata[1])){
				
				$result = $this->db->count_records("email_subscribe", array("email_id" =>  $email));
				if($result == 0){
					
					$status = $this->db->insert("email_subscribe", array("email_id" => $email, "country_id" => $Cdata[0] , "city_id" => $Cdata[1]));
					return $Cdata[1];
				} elseif($result == 1) {
					$status = $this->db->update("email_subscribe", array("country_id" => $Cdata[0] , "city_id" => $Cdata[1]),array("email_id" =>$email,"country_id"=>"","city_id" =>""));
					return $Cdata[1];
				}
				return $Cdata[1];
			}
			return -1;
		} else {
			$result = $this->db->count_records("email_subscribe", array("email_id" =>  $email));
				if($result == 0){
					$status = $this->db->insert("email_subscribe", array("email_id" => $email));
					return $status;
				}
				return 0;
		}
	}

	/** GET DEALS **/
	
	public function get_deals_list_map()
	{               
		if(CITY_SETTING) {
			$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id join city on city.city_id=stores.city_id where deal_status = 1 and startdate < ".time()." and enddate > ".time()." and  store_status = 1 and purchase_count < maximum_deals_limit  and stores.city_id ='$this->city_id' and city_status = 1 order by deal_id DESC ");
            
		} else { 
			$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id  where deal_status = 1 and startdate < ".time()." and enddate > ".time()." and  store_status = 1 and purchase_count < maximum_deals_limit  order by deal_id DESC ");
			 
		} 
	        
					
				return $result;	
	}

	/** GET Products **/
	
	public function get_products_list_map()
	{            
		if(CITY_SETTING){
			$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id  where deal_status = 1 and  store_status = 1   and stores.city_id = '$this->city_id'  and purchase_count < user_limit_quantity order by deal_id DESC  ");
	       
	        return $result;
		} else {
			$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id  where deal_status = 1 and  store_status = 1   and purchase_count < user_limit_quantity order by deal_id DESC limit 8 ");
	        return $result;
		}
		
	}
		/** GET Auction **/
	
	public function get_auction_list_map()
	{               
	        	if(CITY_SETTING) {
	        	$contition = array("stores.city_id" => $this->city_id ,"deal_status" => 1,"enddate >" => time(),"startdate <" => time(),"city_status" => 1,"auction_status" => 0);
		        $result = $this->db->from("auction")
		                ->join("stores","stores.store_id","auction.shop_id")
                                ->join("city","city.city_id","stores.city_id")
                                ->join("category","category.category_id","auction.category_id")
                                ->where($contition)
                                ->orderby("auction.deal_id","ASC")
                                ->get();
                        return $result;
					} else {
						$contition = array("deal_status" => 1,"enddate >" => time(),"startdate <" => time(),"auction_status" => 0);
						$result = $this->db->from("auction")
								->join("stores","stores.store_id","auction.shop_id")
                                ->join("category","category.category_id","auction.category_id")
                                ->where($contition)
                                ->orderby("auction.deal_id","ASC")
                                ->get();

                        return $result;
						
					}
	}

	/* PAYMENT LIST  */
	   public function payment_list1()
	{
		$result = $this->db->select("users.firstname","bidding_time as transaction_date","bidding.bid_amount","auction_id")->from("bidding")->join("auction", "auction.deal_id", "bidding.auction_id")->join("users","users.user_id","bidding.user_id")->get(); 
		//$result = $this->db->from("transaction")->join("users","users.user_id","transaction.user_id")->where(array("bid_amount !=" => 0))->orderby("id","ASC")->get(); 
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

        public function get_category_list_product_count()
	{ 
	        $con = "";
	        if(CITY_SETTING){ 
	        $con = "and stores.city_id = '$this->city_id'";
	        } 
	        
		$result = $this->db->query("select category_url, category.category_id, category_name , product , count(product.deal_id) as product_count from category join product on product.category_id = category.category_id join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id where category_status = 1 AND main_category_id = 0 AND product = 1 AND purchase_count < user_limit_quantity AND deal_status = 1  and  store_status = 1 and city_status=1 $con group by category.category_id  order by category_name ASC"); 
		return $result;
	}
	
	public function get_category_list_deal_count()
	{ 
	        $con = "";
	        if(CITY_SETTING){ 
	        $con = "and stores.city_id = '$this->city_id'";
	        } 
		$result = $this->db->query("select category_url, category.category_id, category_name , deal , count(deals.deal_id) as deal_count from category join deals on deals.category_id = category.category_id join stores on stores.store_id=deals.shop_id where category_status = 1 AND main_category_id = 0 AND deal = 1 AND enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 and  store_status = 1 $con group by category.category_id  order by category_name ASC"); 
		return $result;
	}
	
	public function get_category_list_auction_count()
	{ 
	        $con = "";
	        if(CITY_SETTING){ 
	        $con = "and stores.city_id = '$this->city_id'";
	        } 
		$result = $this->db->query("select category_url, category.category_id, category_name , auction , count(auction.deal_id) as auction_count from category join auction on auction.category_id = category.category_id join stores on stores.store_id=auction.shop_id where category_status = 1 AND main_category_id = 0 AND auction = 1 AND enddate > ".time()."  AND deal_status = 1 and  store_status = 1 $con group by category.category_id  order by category_name ASC"); 
		return $result;
	}
	

	/** GET DEALS CATEGORY LIST **/
	
	public function get_category_list($deal="",$product="",$auction = "")
	{ 
		$condition = " category_status = 1 AND main_category_id = 0 and type = 1 ";

		if($deal==1 && $product == 1 && $auction ==0 ){
			$condition .= " AND (deal=1 OR product = 1) ";
		}
		if($deal==1 && $product == 0 && $auction ==1 ){
			$condition .= " AND (deal=1 OR auction = 1) ";
		}
		if($deal==0 && $product == 1 && $auction ==1 ){
			$condition .= " AND (product=1 OR auction = 1) ";
		}
		if($deal==1 && $product == 0 && $auction ==0 ){
			$condition .= " AND deal = 1 ";
		}
		if($deal==0 && $product == 0 && $auction ==1 ){
			$condition .= " AND auction = 1 ";
		}
		if($deal==0 && $product == 1 && $auction ==0 ){
			$condition .= " AND product = 1 ";
		}

		if($deal==0 && $product == 0 && $auction ==0 ){
			return 0;
		}

		$result = $this->db->query("select * from category where $condition order by category_name ASC"); 
		return $result;
	}
	
	/** PRODUCTS COUNT **/

	public function get_products_count($search = "",$category = "",$cur_category="",$cur_size="",$maincatid="")
	{
        $conditions = "";
			$join ="join category on category.category_id=product.category_id";
		if($cur_category){
			$conditions = "and category.category_id IN ($cur_category)";
				}
		if($cur_size){
			$conditions = "and product_size.size_id IN ($cur_size) and product_size.quantity!=0";
				}
		if($category){
			 $conditions = " and category.category_url='$category'";
		}
		if($search=='sub'){
			$conditions = " and category.category_url='$category'";
			$join ="join category on category.category_id=product.sub_category_id";
		}
		if($search=='sec'){
			$conditions = " and category.category_url='$category'";
			$join =" join category on category.category_id=product.sec_category_id";
		}
		if($search=='third'){
			$conditions = " and category.category_url='$category'";
			$join =" join category on category.category_id=product.third_category_id";
		}
		if($maincatid!= 0) {

			$conditions .= " and category.category_id=$maincatid ";
		}

		if($search!='main' && $search!='sub' && $search!='sec' && $search!='third' && $search!=""){
			 $conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
			 $conditions .= " or deal_description like '%".mysql_real_escape_string($search)."%')";
		}
		if(CITY_SETTING){
		$query = "select product.deal_id from product  join stores on stores.store_id=product.shop_id join product_size on product_size.deal_id=product.deal_id $join where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id'  $conditions group by product.deal_id order by product.deal_id DESC";
		$result = $this->db->query($query);

		} else {
			$query = "select product.deal_id from product  join stores on stores.store_id=product.shop_id join product_size on product_size.deal_id=product.deal_id $join where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 $conditions group by product.deal_id order by product.deal_id DESC";
			$result = $this->db->query($query);

		}
		return count($result);
	}
	/** GET DEALS CATEGORY LIST **/
	
	public function get_all_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1))->orderby("category_name","ASC")->get();
		return $result;
	}
	/** GET DEALS SUB CATEGORY LIST **/
	
	public function get_sub_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"main_category_id !="=>0))->orderby("category_name","ASC")->get();
		return $result;
	}

	/** GET CATEGORY LIST WITH DEALS COUNT **/

	public function count_deals_category_list($city_id = "" )
	{
		$time = time();
		$result = $this->db->query("select category.category_id, count(deals.category_id) as counts from category
							join deals on deals.category_id=category.category_id join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id
							where  category_status = 1 and stores.city_id = $city_id and deal_status = 1 and enddate > $time
							GROUP BY deals.category_id");
		return $result;

	}
	
	/** CHECK CITY EXIST **/

	public function check_city_exist($City = "")
	{
		$result = $this->db->count_records("city", array("city_name" => $City[0], "city_id" => $City[1], "city_status" => 1));
		return $result;
	}

	/** GET DEALS BY COUNTRY **/
	public function get_deals_country_lists($country_id = "",  $category = "", $source = "")
	{
		if($category || $category == "others"){
			if($category == "others"){
				$category = 0;
			}
			$contition = array("deals.country_id" => $country_id ,"enddate >" => time(), "deal_status" => 1,  "city_status" => 1, "deals.category_id" =>  $category);
		}
		else{
			$contition = array("deals.country_id" => $country_id ,"enddate >" => time(), "deal_status" => 1, "city_status" => 1);
		}

		if($source){
			$contition = array("deals.country_id" => $country_id ,"enddate >" => time(), "deal_status" => 1, "city_status" => 1, );
		}
		 $result = $this->db->from("deals")
							        
                                                ->join("city","city.city_id","deals.city_id")
                                                ->where($contition)
                                                ->orderby("deals.enddate","ASC")
                                                ->get();
		return $result;
	}

	/** GET DEALS LIST **/
	public function get_deals_lists_filter($city_id = "",  $type = "")
	{

		if($type=='recent'){
	                $contition = "order by deals.deal_id DESC";
		}elseif($type=='savings'){
	                $contition = "order by deals.discount_percentage DESC";
		}elseif($type=='bought'){
	                $contition = "order by deals.purchase_count DESC";
		}else{
	                $contition = "order by deals.enddate";
		}
		$time = time();
		$query = "select * from deals  left join city on city.city_id=deals.city_id where deals.city_id = '$city_id' and deals.enddate > '$time' and deals.deal_status = 1 and city_status = 1 ".$contition."";
		 $result = $this->db->query($query);
		return $result;
	}
	/* GET DEALS LIST BY FILTER BY COUNTRY*/
	public function get_deals_lists_filter_country($country_id = "",  $type = "")
	{

		if($type=='recent'){
	                $contition = "order by deals.deal_id DESC";
		}elseif($type=='savings'){
	                $contition = "order by deals.discount_percentage DESC";
		}elseif($type=='bought'){
	                $contition = "order by deals.purchase_count DESC";
		}else{
	                $contition = "order by deals.enddate";
		}
		$time = time();
		$query = "select * from deals left join city on city.city_id=deals.city_id where deals.country_id = '$country_id' and deals.enddate > '$time' and deals.deal_status = 1  and city_status = 1 ".$contition."";
		 $result = $this->db->query($query);
		return $result;
	}


	/** GET DEALS LIST BY FILTER */

	public function get_deals_lists_by_filter($city_id = "" , $sources = "" , $category_tags= "")
	{
		$result = $this->db->from("deals")
			->join("city","city.city_id","deals.city_id")
			->where(array("deals.city_id" => $city_id ,"enddate >" => time(), "deal_status" => 1, "city_status" => 1))
			->in("category_id", $category_tags)
			->orderby("deals.enddate","ASC")
			->get();
		return $result;
	}

	/** DEAL CLICK **/

	public function deals_click_count($deal_id = "", $deal_click = "")
	{
		$result = $this->db->update("deals", array("deal_click" => $deal_click), array("deal_id" => $deal_id));
		return 1;
	}

	/** GET ABOUT US DATA **/

	public function get_cms_data($url = "")
	{
		$result = $this->db->from("cms")->where(array("cms_url" => $url, "cms_status" => 1))->limit(1)->get();
		return $result;

	}

	/** GET CMS TITLES **/

	public function get_all_cms_page()
	{
		$result = $this->db->from("cms")->where(array("cms_status" => 1,"type !=" => 1))->get();
		return $result;
	}

	/** ABOUT US PAGE **/

	public function abou_us_page()
	{
		$result = $this->db->from("cms")->where(array("type" => 1))->limit(1)->get();
		return $result;
	}

	/** CONTACT US **/

	public function contact_us_details($post)
	{

		$result = $this->db->insert("contact", array("name" =>$post->name, "email" => $post->email, "phone_number" => $post->phone, "message" => $post->message));
			if($result){
			
			$message = "Name :".ucfirst($post->name)."<br /><br />Email :".$post->email."<br /><br /> Message :<br />".$post->message;
			$this->email = $post->email;
			$this->names = $post->name;
			$this->phone = $post->phone;
			$this->message = $post->message;
			
			$message = new View("themes/".THEME_NAME."/contact_mail_template");
			$from = CONTACT_EMAIL;
			if(EMAIL_TYPE==2){
			    email::smtp($post->email,CONTACT_EMAIL, "Customer Inquiry", $message);
			}else{
			    email::sendgrid($post->email,CONTACT_EMAIL, "Customer Inquiry", $message);
			}
			    return 1;
			}
			else{
			    return 0;
			}
	}


	/** GET UNSUBSCRIBER DATA **/

	public function get_unsubscribed_user($id = "")
	{
		$result = $this->db->from("users")->where(array("user_id" => $id))->get();
		return $result;
	}

	/** UNSUBSCRIBE UPDATE **/

	public function unsubscriber_update($id = "")
	{
		$result = $this->db->update("users", array("newsletter_deals" => 0 ),array("user_id" => $id));
		return 1;
	}

	/** SUBSCRIBER CONFIRMATION **/

	public function confirm_newsletter($mail = "")
	{
		$result = $this->db->update("email_subscribe", array("confirm_status" => 1), array("email_address" => $mail));
		return 1;
	}

	/** GET RSS DEALS LIST  **/

	public function get_rss_deals_lists($city_id = "")
	{
		if(CITY_SETTING) {
			$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id join city on city.city_id=stores.city_id join country on country.country_id=stores.country_id where deal_status = 1 and city.city_id = $city_id and category.category_status = 1 and  store_status = 1 and stores.city_id = '$city_id' and enddate >".time()." and startdate <".time()." order by deals.enddate DESC");
		} else {
			$result = $this->db->query("select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id  where deal_status = 1 and category.category_status = 1 and  store_status = 1 and enddate >".time()." and startdate <".time()." order by deals.enddate DESC");
		}
		
	        return $result;
	}
	   /** GET PRODUCTS DETAILS **/

	public function get_rss_products_lists($cityid="")
	{
		if(CITY_SETTING){
			$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id join city on city.city_id=stores.city_id join country on country.country_id=stores.country_id where deal_status = 1 and  store_status = 1   and stores.city_id = '$cityid'  and purchase_count < user_limit_quantity order by deal_id DESC");
	        
		} else {
			$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id  where deal_status = 1 and  store_status = 1   and purchase_count < user_limit_quantity order by deal_id DESC");
	    }
	    
	    return $result;
	}
	/** GET AUCTION RSS DETAILS **/

	public function get_rss_auction_lists($cityid="")
	{
		if(CITY_SETTING) {
                    $result = $this->db->from("auction")
					->where(array("deal_status" => 1,"enddate >" => time(),"startdate <" => time(),"stores.city_id" => $cityid,"category.category_status" => 1, "store_status" => 1,"auction_status" => 0))
					->join("category","category.category_id","auction.category_id")
					->join("stores","stores.store_id","auction.shop_id")
					->join("city","city.city_id","stores.city_id")
					->join("country","country.country_id","stores.country_id")
					->orderby("deal_id","DESC")
					->get();
	        
		} else { 
		$result = $this->db->from("auction")
					->where(array("deal_status" => 1,"enddate >" => time(),"startdate <" => time(),"category.category_status" => 1, "store_status" => 1,"auction_status" => 0))
					->join("category","category.category_id","auction.category_id")
					->join("stores","stores.store_id","auction.shop_id")
					->orderby("deal_id","DESC")
					->get();
	        }
		return $result;
		
	}
	
	/** GET RSS DEALS LIST  **/	
	public function get_rss_deals_lists_country($country_id = "")
	{
		
		$result = $this->db->from("deals")
			->join("country","country.country_id","deals.country_id")
			->where(array("deals.country_id" => $country_id ,"enddate >" => time(),"startdate <" => time(), "deal_status" => 1, "country_status" => 1))
			->orderby("deals.enddate", "ASC")
			->get();
		return $result;
	}

	/**UPDATE THEME COLOR  **/

	public function change_theme_colour($theme = "")
	{
		$status = $this->db->update("settings",array("theme" => $theme),array("id" => 1));
		return 1;
	}
	
	/** GET ADDS CODE  **/

	public function get_ads_code()
	{
		$result = $this->db->from("ads")->where(array("status" => 1))->get();
		return $result;
	}

	/** GET COPY RIGHT  **/
	public function get_copy_right()
	{
		$result = $this->db->from("cms")->where(array("cms_id" => 8))->get();
		return $result;
	}
	
	/** GET ALL SETTINGS DATA**/

	public function get_all_settings_data()
	{
		$result = $this->db->from("settings")->limit(1)->get();
		return $result;
	}
	
	/** GET CITY  LIST**/
	public function get_city_by_country($country_id){
		$result = $this->db->from("city")->where(array("country_id" => $country_id))->orderby("city_name")->get();
		return $result;
	}
	
	/** GET AFFILIATE URL INPUT - SHORT URL  **/

	public function get_aff_url($deal_id = "", $deal_key = "")
	{
		$result = $this->db->select("url_title")->from("deals")->where(array("deal_id" => $deal_id, "deal_key" => $deal_key, "deal_status" => 1))->get();
		return $result;
	}

	/** DEALS DETAILS COUNT**/
         
        public function all_categorybase_details_count($category= "",$type = "") 

	{
	        $result_category = $this->db->select("category_id")->from("category")
		                        ->where(array("category_url" => $category))
		                        ->limit(1)
		                        ->get();
		                        
		                        $category_di_value = $result_category->current()->category_id;   
                if($type=="deal"){  
		 $conditions = array("deals.deal_type" => 1, "deal_status" => 1,"deals.category_id" => $category_di_value,"stores.city_id" => $this->city_id); 
		}  
		else{
		 $conditions= array("deals.deal_type" => 2, "deal_status" => 1,"deals.category_id" => $category_di_value,"stores.city_id" => $this->city_id);
		}
   		
		$result = $this->db->select("deal_id")->from("deals")
					->where($conditions)
					->join("category","category.category_id","deals.category_id")
				        ->join("stores","stores.store_id","deals.shop_id")
					->orderby("deal_id","DESC")
					->get();
		return count($result);
        }

	/** GET DEALS DETAILS **/

	public function all_categorybase_details($offset = "", $record = "",$category = "" , $type = "" )
	{
                        $result_category = $this->db->select("category_id")->from("category")
		                        ->where(array("category_url" => $category))
		                        ->limit(1)
		                        ->get();
		                        $category_di_value = $result_category->current()->category_id; 
		       
		
			if($type=="deals"){  
			 $conditions = array("deals.deal_type" => 1, "deal_status" => 1,"deals.category_id" => $category_di_value,"stores.city_id" => $this->city_id); 
			}  
			else{
			 $conditions= array("deals.deal_type" => 2, "deal_status" => 1,"deals.category_id" => $category_di_value,"stores.city_id" => $this->city_id);
			}			           
		$result = $this->db->from("deals")
					->where($conditions)
					->join("category","category.category_id","deals.category_id")
				        ->join("stores","stores.store_id","deals.shop_id")
					->orderby("deal_id","DESC")
					->limit($record, $offset)
					->get();
					return $result;
			
	}
	
	/** GET FAQ COUNT **/
	
	public function get_count()
	{
		$result = $this->db->from("faq")->where('faq_status',1)->get();
		return count($result);
	}	
	/* GET FAQ */
	public function get_all_faq($offset = "", $record = "")
	{
		$result = $this->db->from("faq")->where(array("faq_status" => 1))->orderby("faq_id","DESC")->limit($record,$offset)->get();
		
		return $result;
	}
	/* GET AUCTION LIST  */
	public function get_today_auction_list() //changed
	{
	$result = $this->db->from("auction")->select("auction.deal_id,auction.enddate")->where(array("enddate <=" => time(),"auction_status" => 0))
                                                ->join("category","category.category_id","auction.category_id")
                                                ->join("stores","stores.store_id","auction.shop_id")
                                                ->orderby("deal_id","DESC")
						->get(); 
	return $result;
	}
	/* GET AUCTION TRANSACTION BID AMOUNT */
	public function get_auction_transaction_bid_amount_data($deal_id = "")
	{ 
		$result = $this->db->query("select bidding.*,users.firstname,users.user_id,users.email,auction.deal_key,auction.enddate from bidding join users on users.user_id = bidding.user_id join auction on auction.deal_id = bidding.auction_id where bidding.auction_id = $deal_id ORDER BY bid_amount DESC LIMIT 1"); 
			return $result;
	
	}
	/* UPDATE AUCTION TIME */
	public function update_auction_time($deal_id = "")
	{	
		$time= (AUCTION_EXTEND_DAY * 24 * 60 * 60);
		$result = $this->db->query("UPDATE auction SET enddate = enddate + $time WHERE deal_id = $deal_id ");
		return 1;
	}
	/* UPDATE AUCTION MAIL ALERT */
	public function update_mail_alert($bid_id = "" , $deal_key = "" , $user_id = "")
	{
		$this->db->update("bidding",array("mail_alert" =>1,"winning_status" =>1),array("bid_id" => $bid_id));
		$this->db->update("auction",array("auction_status" => 1, "winner" => $user_id),array("deal_key" => $deal_key));
		return 1;	
	
	}
	/* UPDATE THIRD MAIL ALERT */
	public function update_third_mail_alert($bid_id = "",$auction_id = "")
	{
		$time=(AUCTION_EXTEND_DAY * 24 * 60 * 60);
		$result = $this->db->query("UPDATE auction SET enddate = enddate + $time,winner = 0,auction_status = 0 WHERE deal_id = $auction_id");
		$this->db->delete("bidding",array("auction_id" => $auction_id)); 

		return 1;	
	
	}
	/* UPDATE SECOND MAIL ALERT */
	public function update_second_mail_alert($bid_id = "")
	{
		$this->db->update("bidding",array("mail_alert" =>2),array("bid_id" => $bid_id));
		return 1;	
	
	}
	
/* GET AUCTION ALERT */
	public function get_auction_alert_details($mail_type)
	{
	    $result = $this->db->query("select bidding.*,enddate,deal_id,users.firstname,users.user_id,users.email,auction.deal_key from bidding join users on users.user_id = bidding.user_id join auction on auction.deal_id = bidding.auction_id where winning_status = 1 AND mail_alert = $mail_type "); 
		return $result;
	}

		/**close button city list**/
	/** GET CITY LIST **/

	public function get_close_city_list()
	{
		$result = $this->db->from("city")->where(array("city_status" => 1, "default" => 1))->get();
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
	/* PAYMENT LIST */
            public function payment_list()
            {
		        $result = $this->db->select("users.firstname","bidding_time as transaction_date","bidding.bid_amount","auction_id")->from("bidding")->join("auction", "auction.deal_id", "bidding.auction_id")->join("users","users.user_id","bidding.user_id")->get();
	            return $result;
            }
	    
	  /** GET SEARCH DEALS LIST **/

	public function  get_search_deals_list($search = "", $category="", $cat_type="",$maincatid="",$store_id='')
	{ 
	        $conditions = " ";
	        $join = "deals.category_id";
		if($category && $cat_type=='main') {
			$conditions .= " and category.category_id=$category ";
		}
		elseif($category && $cat_type=='sub') {
			$conditions .= " and deals.sub_category_id=$category ";
			$join = "deals.sub_category_id";
		}
		elseif($category && $cat_type=='sec') {
			$conditions .= " and deals.sec_category_id=$category ";
			$join = "deals.sec_category_id";
		}
		elseif($category && $cat_type=='third') {
			$conditions .= " and deals.third_category_id=$category ";
			$join = "deals.third_category_id";
		}
		if($search){
			$search_url = url::title($search);
                        $conditions .= " and ( deal_title like '%".mysql_real_escape_string($search)."%'";
                        $conditions .= " or url_title = '$search_url' )";
		}
		if($maincatid!= 0) {
			
			$conditions .= " and category.category_id=$maincatid ";
		}
		
		if($store_id!=''){
			$conditions .= " and stores.store_id = $store_id ";
		}
		
		if(CITY_SETTING) {
			$query = "select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=$join  where enddate >".time()." and purchase_count < maximum_deals_limit and deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id' $conditions group by deals.deal_id order by deals.deal_id DESC ";
			$result = $this->db->query($query);
				
		} else {
			$query = "select * from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=$join where enddate >".time()." and purchase_count < maximum_deals_limit and deal_status = 1 and category.category_status = 1 and  store_status = 1 $conditions group by deals.deal_id order by deal_id DESC ";
			$result = $this->db->query($query);
	
		}
		
		return $result;
	}
	
		/** GET SEARCH PRODUCTS LIST **/
	public function  get_search_products_list($search = "", $category = "",$cat_type="",$maincatid="",$store_id="")
	{
		
		$conditions = " ";
	        $join = "product.category_id";
		if($category && $cat_type=='main') {
			$conditions .= " and category.category_id=$category ";
		}
		elseif($category && $cat_type=='sub') {
			$conditions .= " and product.sub_category_id=$category ";
			$join = "product.sub_category_id";
		}
		elseif($category && $cat_type=='sec') {
			$conditions .= " and product.sec_category_id=$category ";
			$join = "product.sec_category_id";
		}
		elseif($category && $cat_type=='third') {
			$conditions .= " and product.third_category_id=$category ";
			$join = "product.third_category_id";
		}
		if($search){
			//$conditions .= " and deal_title like '%".mysql_real_escape_string($search)."%'";
			$search_url = url::title($search);
                        $conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
                        $conditions .= " or url_title = '$search_url' )";
		}
		if($maincatid!= 0) {
			$conditions .= " and category.category_id=$maincatid ";
		}
		
		if($store_id!=''){
			$conditions .= " and stores.store_id = $store_id ";
		}

		if(CITY_SETTING){
		$query = "select *,stores.store_url_title from product  join stores on stores.store_id=product.shop_id join category on category.category_id=$join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id' $conditions group by product.deal_id order by product.deal_id DESC ";
		$result = $this->db->query($query);
		} else {
		$query = "select *,stores.store_url_title from product  join stores on stores.store_id=product.shop_id join category on category.category_id=$join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 $conditions group by product.deal_id order by product.deal_id DESC "; 
		$result = $this->db->query($query);
		} 
		
		 return $result;
	}
	
	/** GET SEARCH AUCTIONS LIST **/

	public function  get_search_auction_list($search = "", $category="", $cat_type="",$maincatid="",$store_id="")
	{
		 $conditions = " ";
	        $join = "auction.category_id";
		if($category && $cat_type=='main') {
			$conditions .= " and category.category_id=$category ";
		}elseif($category && $cat_type=='sub') {
			$conditions .= " and auction.sub_category_id=$category ";
			$join = "auction.sub_category_id";
		}
		elseif($category && $cat_type=='sec') {
			$conditions .= " and auction.sec_category_id=$category ";
			$join = "auction.sec_category_id";
		}
		elseif($category && $cat_type=='third') {
			$conditions .= " and auction.third_category_id=$category ";
			$join = "auction.third_category_id";
		}
		   
		if($search){
			$search_url = url::title($search);
                        $conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
                        $conditions .= " or url_title = '$search_url' )";
		}

		if($maincatid!= 0) {
			
			$conditions .= " and category.category_id=$maincatid ";
		}
		
		if($store_id!=''){
			$conditions .= " and stores.store_id = $store_id ";
		}

		
		if(CITY_SETTING){ 
		
		$query = "select * from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=$join where enddate > ".time()." and deal_status = 1 and category.category_status = 1 and  store_status = 1 and auction_status = 0 and stores.city_id = '$this->city_id' $conditions group by auction.deal_id order by deal_id DESC ";
		$result = $this->db->query($query);
	        
		} else {
		$query = "select * from auction  join stores on stores.store_id=auction.shop_id join category on category.category_id=$join where enddate > ".time()." and deal_status = 1 and category.category_status = 1  and auction_status = 0 and  store_status = 1 $conditions group by auction.deal_id order by deal_id DESC ";
		$result = $this->db->query($query);
	        
		}
		return $result;
	}
	
	/** ADD COMMENTS **/

	public function add_comments($comments = "" , $deal_id = "",$type= "")
	{
	        $result = $this->db->insert("discussion", array("user_id" =>$this->UserID, "deal_id" => $deal_id, "comments" => $comments,"type" =>$type,"created_date" => time(),"discussion_status"=>0));
		return $result->insert_id(); 
	}
	
	/** UPDATE COMMENTS **/

	public function update_comments($comments = "" , $deal_id = "",$type= "",$discussion_id="")
	{
	        $result = $this->db->update("discussion", array("user_id" =>$this->UserID, "deal_id" => $deal_id, "comments" => $comments,"type" =>$type,"created_date" => time()),array("discussion_id" =>$discussion_id));
		return $result; 
	}
	
	/** GET COMMENTS LIST **/

	public function get_comments_data($deal_id = "",$type = "")
	{
		$result = $this->db->from("discussion")
				   ->join("users","users.user_id","discussion.user_id")
				   ->where(array("deal_id" => $deal_id,"discussion_status" => "1","delete_status" => 1,"type" =>$type))
				   ->orderby("discussion_id", "DESC")->get();
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
	
         /**COUNT LIKE  **/

        public function like1($deal_id = "",$user_id="",$dis_id = "",$type = "")
        { 
            $result = $this->db->insert("discussion_likes",array("discussion_id" => $dis_id, "deal_id" => $deal_id,"type" =>$type, "user_id" => $this->session->get('UserID')));
            $result = $this->db->from('discussion_unlike')->where(array("discussion_id" => $dis_id, "deal_id" => $deal_id, "type" =>$type,"user_id" => $this->session->get('UserID')))->get();
            if(count($result) > 0){
			        $result = $this->db->delete('discussion_unlike', array("discussion_id" => $dis_id, "deal_id" => $deal_id, "type" =>$type,"user_id" => $this->session->get('UserID')));
		        }
            return 1;
        }
    
        /* UNLIKE COUNT */
        public function unlike1($deal_id = "",$user_id="",$dis_id = "",$type = "")
        { 
            $result = $this->db->insert("discussion_unlike",array("discussion_id" => $dis_id, "deal_id" => $deal_id,"type" =>$type, "user_id" => $this->session->get('UserID')));
            $result = $this->db->from('discussion_likes')->where(array("discussion_id" => $dis_id, "deal_id" => $deal_id, "type" =>$type,"user_id" => $this->session->get('UserID')))->get();
            if(count($result) > 0){
			        $result = $this->db->delete('discussion_likes', array("discussion_id" => $dis_id, "deal_id" => $deal_id,"type" =>$type, "user_id" => $this->session->get('UserID')));
		        }
            return 1;
        }
    
        public function get_user_bought($uid = "")
        {
                $result = $this->db->query($uid);
                return count($result);
        }
    
        /** GET DEALS LIKE COUNT **/
	
	public function get_like_details($dis_id = "",$type = "")
	{
		$result = $this->db->from('discussion_likes')->where(array('discussion_id' => $dis_id,"type" => $type))->get();
		return count($result);
	}
	
	/* GET UNLIKE DETAILS */
	
	public function get_unlike_details($dis_id = "",$type = "")
	{
		$result = $this->db->from('discussion_unlike')->where(array('discussion_id' => $dis_id,"type" => $type))->get();
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
	
	public function get_subcat_count($cat_id = "",$type="")
	{
		$conditions = array("main_category_id" => $cat_id,"category_status" => 1,"type" => 2);
		if($type == 2){
			$conditions = array("main_category_id !=" =>0,"sub_category_id" => $cat_id,"category_status" => 1,"type" => 3);
		}
		if($type == 3){
			$conditions = array("main_category_id !=" =>0,"sub_category_id" => $cat_id,"category_status" => 1,"type" => 4);
		}
		return $this->db->count_records("category",$conditions);
	}

	public function get_city_name($city_id=0)
	{
		$result = $this->db->select('city_name')->from('city')->where(array('city_id' => $city_id))->get();
		return (count($result))?$result->current()->city_name:"";
	}
	
	/** GET SHIPPING ADDRESS */
	
	public function get_ship_address()
	{
		$result = $this->db->from("users")
				->join("country","country.country_id","users.ship_country")
				->join("city","city.city_id","users.ship_city")
				->where(array("user_id" =>$this->UserID))
				->get();
		return $result;
	}

	public function get_lang_change($lang)
	{
		$status = $this->session->set("front_language",$lang);
		return 1;
	}
	
	/** MOST VIEW PRODUCTS LIST **/

	public function get_products_view()
	{               
	        if(CITY_SETTING){ 
		$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage,stores.store_url_title from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id' order by product.view_count DESC limit 3";
		$result = $this->db->query($query);
		} else {
		$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage,stores.store_url_title from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1  order by product.view_count DESC limit 3";
		$result = $this->db->query($query);
		}
		
		return $result;
	}
	
	/** GET RELATED CATEGORY DEALS LIST  **/
	
	public function  get_hot_products_view()
	{
	        if(CITY_SETTING){ 
		$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage,stores.store_url_title  from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and deal_feature = 1 and stores.city_id = '$this->city_id'  ORDER BY RAND() limit 4";
		$result = $this->db->query($query);
		} else {
		$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage,stores.store_url_title from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and deal_feature = 1 ORDER BY RAND() limit 4";
		$result = $this->db->query($query);
		}
	        return $result;
	}
	
	public function  get_category_count($search = "",$category_id = "")
	{
		$conditions = " ";
		$join = "category_mapping.map_main_category_id";
	 	if($category_id) {			
			$conditions .= " and product.category_id=$category_id ";
		}
		if($search){
			$conditions .= " and (deal_title like '%".mysql_escape_string($search)."%'";
			$conditions .= " or deal_description like '%".mysql_escape_string($search)."%')";
		}
		$query = "select * from product join category_mapping on category_map_deal_id=product.deal_id join category on category.category_id=$join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1  $conditions group by product.deal_id order by product.deal_id DESC "; 
		$result = $this->db->query($query);
	        return count($result);
	}
	
	public function get_search_all_category_list($search = "")
	{
	        $conditions = " and category_name like '%".mysql_escape_string($search)."%'";
	        $query = "select * from category where category_status = 1  $conditions order by category_name ASC ";
		$result = $this->db->query($query);
		return $result;
	}

        /* GET SHIPPING SETTINGS */
	public function get_shipping_settings()
	{
		$result = $this->db->from("users")->where(array("user_type" => 1))->get();
		return $result;
	}
	/* GET THEME DETAILS */
	public function get_theme_name($store_url="")
	{
		$result = $this->db->select("sector_name")->from("sector")
							->join("users","user_sector_id","sector.sector_id")
							->join("stores","stores.store_admin_id","users.user_id")
							->where(array("stores.store_url_title"=>$store_url))
							->get();

		return $result;
	}
	public function get_merchant_cms_data($store_url_title="",$title="") {
		
		$result = $this->db->select("warranty_status,warranty,terms_conditions,terms_conditions_status,return_policy,return_policy_status,about_us,about_us_status,merchant_id,store_url_title,store_id")->from("stores")->where(array("store_type"=>1,"store_url_title"=>$store_url_title))->get();
		return $result;
	}
	/* GET ABOUT US FOR FOOTER */
	public function get_about_us_footer($storeurl="")
	{
		$result = $this->db->from("stores")->where(array("stores.store_url_title"=>$storeurl))->get();
		return $result;
	}
	
	public function get_subcategories_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"main_category_id !="=>0,"type"=>2))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	public function get_secondcategories_list(){
		$result = $this->db->from("category")->where(array("category_status" => 1,"main_category_id !="=>0,"type"=>3))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	public function get_new_arrivals(){
		if(CITY_SETTING){ 
			$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage,stores.store_url_title,(select avg(rating) from rating where type_id=product.deal_id and module_id=2) as avg_rating from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id  join users on users.user_id=stores.merchant_id join city on city.city_id=stores.city_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id' and users.user_status=1 and city.city_status=1 order by product.deal_id DESC limit 8";
			$result = $this->db->query($query);
		} else {
			$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage,stores.store_url_title,(select avg(rating) from rating where type_id=product.deal_id and module_id=2) as avg_rating  from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id  join users on users.user_id=stores.merchant_id join city on city.city_id=stores.city_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and users.user_status=1 and city.city_status=1 order by product.deal_id DESC limit 8";
			$result = $this->db->query($query);
		}
		return $result;
	}
	
	public function get_best_seller(){
		if(CITY_SETTING){ 
			$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage,stores.store_url_title,(select avg(rating) from rating where type_id=product.deal_id and module_id=2) as avg_rating from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id join users on users.user_id=stores.merchant_id join city on city.city_id=stores.city_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id' and users.user_status=1 and city.city_status=1 order by product.purchase_count DESC limit 8";
			$result = $this->db->query($query);
		} else {
			$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage,stores.store_url_title,(select avg(rating) from rating where type_id=product.deal_id and module_id=2) as avg_rating from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id join users on users.user_id=stores.merchant_id join city on city.city_id=stores.city_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and users.user_status=1 and city.city_status=1 order by product.purchase_count DESC limit 8";
			$result = $this->db->query($query);
		}
		return $result;
	}
	
	public function get_category_products($type='',$limit='',$category_id=''){
		if($limit==1)
			$li = 8;
		else
			$li = 3;
			
		$condition = " purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and users.user_status=1 and city.city_status=1 ";
		
		if(CITY_SETTING)
			$condition .= " and stores.city_id = '$this->city_id' ";
			
		if($type!='')
			$condition .= " and category.order_by=$type ";
			
		if($category_id!='')
			$condition .= " and category.category_id = $category_id ";
		
		$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage,stores.store_url_title,category.category_name,(select avg(rating) from rating where type_id=product.deal_id and module_id=2) as avg_rating from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id join users on users.user_id=stores.merchant_id join city on city.city_id=stores.city_id where $condition  order by product.deal_id DESC limit $li";
		$result = $this->db->query($query);
		return $result;
	}
	
	public function get_blog_list(){
		$result = $this->db->select("blog_id,blog_title,url_title,blog_description")->from("blog")->join("category","category.category_id","blog.category_id")->where(array("blog_status"=>1,"publish_status"=>1))->orderby("blog_id","DESC")->limit(6)->get();
		return $result;
	}
	
	/** DEAL LISTING **/
	public function get_hot_deals_view()
	{
	if(CITY_SETTING){ 
	$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,store_url_title,(select avg(rating) from rating where type_id=deals.deal_id and module_id=1) as avg_rating  from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id join users on users.user_id=stores.merchant_id where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 and category.category_status = 1 and store_status = 1 and stores.city_id = '$this->city_id' and user_status=1 ORDER BY deals.deal_id DESC limit 8";

	$result = $this->db->query($query);
	
	} else {
	$query = "select deals.deal_id,deals.deal_key,deals.deal_title,deals.url_title,deals.deal_value,deals.deal_price, category.category_url, deals.maximum_deals_limit, deals.purchase_count,deals.enddate,deals.deal_percentage,store_url_title,(select avg(rating) from rating where type_id=deals.deal_id and module_id=1) as avg_rating  from deals  join stores on stores.store_id=deals.shop_id join category on category.category_id=deals.category_id join users on users.user_id=stores.merchant_id where enddate > ".time()." and purchase_count < maximum_deals_limit and deal_status = 1 and category.category_status = 1 and store_status = 1 and user_status=1 ORDER BY deals.deal_id DESC limit 8";

	$result = $this->db->query($query);
	}
		return $result;
	}
	public function  get_hot_deals_view1()
	{
		if(CITY_SETTING){ 
			$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price,store_url_title,(select avg(rating) from rating where type_id=auction.deal_id and module_id=3) as avg_rating from auction join stores on stores.store_id=auction.shop_id join users on users.user_id=stores.merchant_id where enddate > ".time()." and deal_status = 1 and  store_status = 1 and auction_status = 0 and stores.city_id = '$this->city_id' ORDER BY auction.deal_id DESC limit 8";
			$result = $this->db->query($query);
			
		} else {
			$query = "select auction.deal_id,auction.deal_key,auction.deal_title,auction.url_title,auction.deal_value,auction.deal_price,store_url_title,(select avg(rating) from rating where type_id=auction.deal_id and module_id=3) as avg_rating from auction join stores on stores.store_id=auction.shop_id join users on users.user_id=stores.merchant_id where enddate > ".time()." and deal_status = 1 and  store_status = 1 and auction_status = 0 ORDER BY auction.deal_id DESC limit 8";
			$result = $this->db->query($query);
		}
	        return $result;
	}
	
	public function get_category_orders(){
		$result = $this->db->select("category_name,category_id,order_by")->from("category")->where(array("category_status"=>1,"order_by!="=>0))->orderby("order_by","ASC")->limit(7)->get();
		return $result;
	}
	
	public function get_category_orders_1($category_ids='',$limit=""){
		$condition = " category_status = 1 ";
		if($category_ids!='')
			$condition .= " and category_id not in ($category_ids)";
		if($limit=='')
			$limit = 7;
		$result = $this->db->query("select category_name,category_id,(select count(deal_id) from product join stores on stores.store_id=product.shop_id  join users on users.user_id=stores.merchant_id join city on city.city_id=stores.city_id where product.category_id=category.category_id and purchase_count < user_limit_quantity and deal_status = 1 and  store_status = 1 and users.user_status=1 and city.city_status=1 group by category_id) as product_count from category where $condition order by product_count DESC limit $limit");
		return $result;
	}
}
