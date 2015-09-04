<?php defined('SYSPATH') or die('No direct script access.');
class Admin_moderator_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db=new Database();
		$this->session = Session::instance();	
	}
	/** GET USER LIST **/
	public function get_user_list()
	{
		$result = $this->db->query("SELECT user_type,joined_date,login_type FROM users WHERE  user_status = 1  and user_type = 2 ");
		return $result;
	}
	/** GET COUNTRY LIST **/
    
	public function getcountrylist()
    {
		$result = $this->db->select("country_id,country_name")->from("country")->where(array("country_status" => '1'))->orderby("country_name")->get();
		return $result;
	}
	
    /** GET CITY LIST **/
    public function getCityList()
	{
		$result = $this->db->select("city_id,city_name,country.country_id")->from("city")
		->join("country","country.country_id","city.country_id")
		->where(array("city_status" => '1'))
		->orderby("city.country_id", "ASC")			
		->get();
			return $result;
	}
    /** ADD USER'S LIST **/
	
	public function add_moderator($post = "",$referral_id = "", $password = "")
	{

		$city_id = trim($post->city);

		$result = $this->db->insert("users", array("firstname" => $post->firstname,"lastname" => $post->lastname, "email" => $post->email, 'password' => md5($password), 'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $city_id, 'country_id' => $post->country, 'referral_id' => $referral_id, 'phone_number' => $post->mobile, 'login_type'=>'2','user_type'=>'2', "joined_date" => time()));
		$user_id = $result->insert_id();
		$result_city = $this->db->select("city_id")->from("email_subscribe")->where(array("email_id" =>$post->email))->get();

		if(count($result_city) > 0) {
			$city_subscribe = $city_id;
			$city_subscribe .=",".$city_id;
			$result = $this->db->update("email_subscribe", array("user_id" =>$result->insert_id(),"country_id" =>$post->country,"city_id" =>$city_subscribe,"category_id"=> 0),array("email_id" => $post->email));		        
		} else {
			$result_email_subscribe = $this->db->insert("email_subscribe", array("user_id" => $result->insert_id(), "email_id" => $post->email,"city_id" => $city_id,"country_id" =>$post->country,"category_id"=> 0));
		}
		
		$data = array(
					 "privileges_deals","privileges_deals_add","privileges_deals_edit","privileges_deals_block",
					 "privileges_products","privileges_products_add","privileges_products_edit","privileges_products_block",
					 "privileges_auctions","privileges_auctions_add","privileges_auctions_edit","privileges_auctions_block",
					 "privileges_customer","privileges_customer_add","privileges_customer_edit","privileges_customer_block",
					 "privileges_merchant","privileges_merchant_add","privileges_merchant_edit","privileges_merchant_block",
					 "privileges_blogs","privileges_blogs_add","privileges_blogs_edit","privileges_blogs_block",
					 "privileges_cms","privileges_cms_add","privileges_cms_edit","privileges_cms_block",
					 "privileges_attributs","privileges_attributs_add","privileges_attributs_edit","privileges_attributs_block",
					 "privileges_categories","privileges_categories_add","privileges_categories_edit","privileges_categories_block",
					 "privileges_country","privileges_country_add","privileges_country_edit","privileges_country_block",
					 "privileges_city", "privileges_city_add", "privileges_city_edit", "privileges_city_block",
					 "privileges_transactions","privileges_fundrequest","privileges_fundrequest_edit","privileges_daily_newsletter","privileges_storecredit","privileges_customercare","privileges_customercare_add","privileges_customercare_edit","privileges_customercare_block","privileges_banner","privileges_banner_add","privileges_banner_edit","privileges_banner_block","privileges_specification","privileges_specification_add","privileges_specification_edit","privileges_specification_block","privileges_sector","privileges_sector_add","privileges_sector_edit","privileges_sector_block","privileges_ads","privileges_ads_add","privileges_ads_edit","privileges_ads_block","privileges_faq","privileges_faq_add","privileges_faq_edit","privileges_faq_block","privileges_newsletter","privileges_newsletter_add","privileges_newsletter_edit","privileges_newsletter_block");
		$arr =array();
		if(count($data)){
			   foreach($data as $row) {
					   $field = (isset($_POST[$row]))?1:0;
						$arr[$row] = $field.',';
			   }
		}
		$user = array("moderator_id" => $user_id);
		$result_array = array_merge($arr, $user);
		$in = $this->db->insert("admin_moderator_privileges_map",$result_array);
		   
		return 1;
	}
        /** CHECK EMAIL EXIST **/ 
	
	public function exist_email($email = "")
	{
		$result = $this->db->count_records('users', array('email' => $email,'user_type' =>2));
		return (bool) $result;
	}
	
        /** GET USERS COUNT DATA  **/
	
        public function get_moderator_count($name = "", $email = "", $city = "", $logintype = "",$sort_type = "",$param = "")
        { 
				$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
                $contitions = "user_type = 2";
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
                                    ->where(array("user_type" => 2))
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
		/** GET USERS DATA  **/
	
        public function get_moderator_list($offset = "", $record = "",  $name = "", $email = "", $city = "", $logintype = "",$sort_type = "",$param = "",$limit="")
        {
			$limit1 = $limit !=1 ?"limit $offset,$record":"";
			
				$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
                $contitions = "user_type = 2";
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
        
        public function moderator_privileges($user_id)
		{ 
			$result = $this->db->from("admin_moderator_privileges_map")
							->where(array("moderator_id" => $user_id))
							->get();

			return $result;
		}
		/** GET SINGLE USER DATA **/
	
		public function get_moderator_data($userid = "")
		{
			$result = $this->db->from("users")->where(array("user_id" => $userid))->join("city","city.city_id","users.city_id")->limit(1)->get();
			return $result;
		}
		/** UPDATE USER **/
	
        public function edit_moderator($id,$post) 
        {

		$city_id = trim($post->city);
        $result_emailid = $this->db->count_records("users", array("email" => $post->email,"user_id !=" => $id));
			if($result_emailid == 0){
					$result = $this->db->update("users", array("firstname" => $post->firstname,"lastname" => $post->lastname, "email" => $post->email, 'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $city_id, 'country_id' => $post->country, 'phone_number' => $post->mobile), array('user_id' => $id,'user_type'=>'2'));
					$data = array(
					 "privileges_deals","privileges_deals_add","privileges_deals_edit","privileges_deals_block",
					 "privileges_products","privileges_products_add","privileges_products_edit","privileges_products_block",
					 "privileges_auctions","privileges_auctions_add","privileges_auctions_edit","privileges_auctions_block",
					 "privileges_customer","privileges_customer_add","privileges_customer_edit","privileges_customer_block",
					 "privileges_merchant","privileges_merchant_add","privileges_merchant_edit","privileges_merchant_block",
					 "privileges_blogs","privileges_blogs_add","privileges_blogs_edit","privileges_blogs_block",
					 "privileges_cms","privileges_cms_add","privileges_cms_edit","privileges_cms_block",
					 "privileges_attributs","privileges_attributs_add","privileges_attributs_edit","privileges_attributs_block",
					 "privileges_categories","privileges_categories_add","privileges_categories_edit","privileges_categories_block",
					 "privileges_country","privileges_country_add","privileges_country_edit","privileges_country_block",
					 "privileges_city", "privileges_city_add", "privileges_city_edit", "privileges_city_block",
					 "privileges_transactions","privileges_fundrequest","privileges_fundrequest_edit","privileges_daily_newsletter","privileges_storecredit","privileges_customercare","privileges_customercare_add","privileges_customercare_edit","privileges_customercare_block","privileges_banner","privileges_banner_add","privileges_banner_edit","privileges_banner_block","privileges_specification","privileges_specification_add","privileges_specification_edit","privileges_specification_block","privileges_sector","privileges_sector_add","privileges_sector_edit","privileges_sector_block","privileges_ads","privileges_ads_add","privileges_ads_edit","privileges_ads_block","privileges_faq","privileges_faq_add","privileges_faq_edit","privileges_faq_block","privileges_newsletter","privileges_newsletter_add","privileges_newsletter_edit","privileges_newsletter_block");
					$arr =array();
				   if(count($data)){
						   foreach($data as $row) {
								   $field = (isset($_POST[$row]))?1:0;
									$arr[$row] = $field.',';
						   }
				   }
				   $in = $this->db->update("admin_moderator_privileges_map",$arr,array('moderator_id' => $id));
					return 1;
		}
                return 2;
        }
        /** BLOCK & UNBLOCK USER **/
         
        public function blockunblockuser($type = "", $uid = "", $email = "")
        {
			$status = 0;
			if($type == 1){
				$status = 1;
			}
			$result = $this->db->update("users", array("user_status" => $status), array("user_id" => $uid, "email" => $email));
			return count($result);
        }
        
        /** DELETE USER **/
          
	public function deleteuser($uid = "", $email = "")
	{
		$result = $this->db->delete('users', array('user_id' => $uid, "email" => $email));
		$email = $this->db->delete('email_subscribe', array('user_id' => $uid, "email_id" => $email));
		$moderator = $this->db->delete('admin_moderator_privileges_map', array('moderator_id' => $uid));
		return count($result);
	}
	/** GET SINGLE USER DATA FOR VIEW USER  **/

	public function get_user_view_data($userid = "")
	{
		$result = $this->db->from("users")->where(array("user_id" => $userid))->join("city","city.city_id","users.city_id")->join("country","country.country_id","users.country_id")->limit(1)->get();
		return $result;
	}

	/** GET STATE LIST **/
	public function getStateList()
	{
		$result = $this->db->from("state")
							->join("country","country.country_id","state.state_country_id")
							->where(array("statestatus" => '1'))
							->orderby("state.state_name", "ASC")			
							->get();
		return $result;
	}

        /** GET CITY LIST **/
	public function getCityId_name($city_id)
        {
		$result = $this->db->query("SELECT city_id,city_name FROM city WHERE  city_status=1 and city_id='$city_id'");
                return $result;
        }	
}

