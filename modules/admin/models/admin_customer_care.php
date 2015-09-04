<?php defined('SYSPATH') or die('No direct script access.');
class Admin_customer_care_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db=new Database();
		$this->session = Session::instance();	
	}
	
	/** ADD USER'S LIST **/
	
        public function add_user($post = "",$referral_id = "", $password = "")
        {
			$unique_identifier="";
			if($unique_identifier !=""){ 
				$user_auto_key = text::random($type = 'alnum', $length = 4);
			} else {
				$user_auto_key ="";
			}
               	$news_city = $post->city.",";
                $result = $this->db->insert("users", array("firstname" => $post->firstname,"lastname" => $post->lastname, "email" => $post->email, 'password' => md5($password), 'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $post->country, 'referral_id' => $referral_id, 'phone_number' => $post->mobile, 'login_type'=>'2', "joined_date" => time(),/*"gender" =>$post->gender,"age_range"=>$post->age_range,"unique_identifier"=>$post->unique_identifier,*/"user_auto_key"=>$user_auto_key,"user_type" =>7));
                
                $result_city = $this->db->select("city_id")->from("email_subscribe")->where(array("email_id" =>$post->email))->get();

		        if(count($result_city) > 0) {
                        $city_subscribe = $post->city;
                        $city_subscribe .=",".$post->city;
                        $result = $this->db->update("email_subscribe", array("user_id" =>$result->insert_id(),"country_id" =>$post->country,"city_id" =>$city_subscribe,"category_id"=> 0),array("email_id" => $post->email));		        
                } else {
		        $result_email_subscribe = $this->db->insert("email_subscribe", array("user_id" => $result->insert_id(), "email_id" => $post->email,"city_id" => $post->city,"country_id" =>$post->country,"category_id"=> 0));
  		        }

                $user_id = $result->insert_id();
                echo $this->session->set("id",$user_id); 
               
		return 1;
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
				->where(array("city_status" => '1'))
				->orderby("city.country_id", "ASC")			
				->get();
                return $result;
        }
        
        /** GET CITY LIST ONLY**/
        
	public function getCityListOnly()
        {
                $result = $this->db->from("city")
				->join("country","country.country_id","city.country_id")
				->where(array("city_status" => 1,"country.country_status" => 1))
				->orderby("city.city_name", "ASC")
				->get();
                return $result;
        }
	
	/** GET COUNTRY BASED CITY LIST **/
	
	public function get_city_by_country($country){
		$result = $this->db->from("city")->where(array("country_id" => $country, "city_status" => '1'))->orderby("city_name")->get();
		return $result;
	}
	
        /** CHECK PASSWORD **/

        public function exist_password($pass = "", $id = "")
        {
                $result = $this->db->count_records('users', array('user_id' => $id, 'password' => md5($pass)));
	                return (bool) $result;
        }
	
	/** GET USERS DATA  **/
	
        public function get_users_list($offset = "", $record = "",  $name = "", $email = "", $city = "", $logintype = "",$sort_type = "",$param = "",$limit="",$today="", $startdate = "", $enddate = "")
        {
			$limit1 = $limit !=1 ?"limit $offset,$record":"";
			
				$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
                $contitions = "user_type = 7";
                $joinorder = "order by users.user_id DESC ";
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

			$sort_arr = array("name"=>" order by users.firstname $sort","city"=>" order by city.city_name $sort","email"=>" order by users.email $sort","date"=>" order by users.joined_date $sort");
                        
		        if(isset($sort_arr[$param])){
			        $contitions .= $sort_arr[$param];
			        $joinorder = "";
			} else {
				$contitions .= '';
			}
                }
                        $result = $this->db->query("select * from users join city on city.city_id = users.city_id join country on country.country_id = users.country_id where $contitions $joinorder $limit1 ");
                
                return $result;
        }
	
        /** GET USERS COUNT DATA  **/
	
        public function get_users_count($name = "", $email = "", $city = "", $logintype = "",$sort_type = "",$param = "",$today="", $startdate = "", $enddate = "")
        { 
				$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
                $contitions = "user_type = 7";
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
			$sort_arr = array("name"=>" order by users.firstname $sort","city"=>" order by city.city_name $sort","email"=>" order by users.email $sort","date"=>" order by users.joined_date $sort");

			if(isset($sort_arr[$param])){
	       		 $contitions .= $sort_arr[$param];
		}else{  $contitions .= ' order by users.user_id DESC'; }

                        $result = $this->db->query("select ('user_id') from users join city on city.city_id = users.city_id join country on country.country_id = users.country_id where $contitions");
                }
                else{
                        $result = $this->db->from("users")
                                    ->where(array("user_type" => 7))
				    				->join("city","city.city_id","users.city_id")
				    				->join("country","country.country_id","users.country_id")
                                    ->orderby("user_id", "DESC")
                                    ->get();
                }
                return count($result);
        }
        
	/** GET SINGLE USER DATA **/
	
	public function get_users_data($userid = "")
	{
		$result = $this->db->from("users")->where(array("user_id" => $userid))->join("city","city.city_id","users.city_id")->limit(1)->get();
		return $result;
	}
		     
	/** CHECK EMAIL EXIST **/ 
	
	public function exist_email($email = "")
	{
		$result = $this->db->count_records('users', array('email' => $email));
		return (bool) $result;
	}
	
	/** UPDATE USER **/
	
        public function edit_users($id,$post) 
        {
                $result_emailid = $this->db->count_records("users", array("email" => $post->email,"user_id !=" => $id));
                        if($result_emailid == 0){
                                $result = $this->db->update("users", array("firstname" => $post->firstname,"lastname" => $post->lastname, "email" => $post->email, 'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $post->country, 'phone_number' => $post->mobile/*,"gender" =>$post->gender,"age_range"=>$post->age_range*/), array('user_id' => $id));
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
		$result = $this->db->delete('users', array('user_id' => $uid, "email" => $email, "user_type" => 7));
		return count($result);
	}
	
	/** GET SINGLE USER DATA FOR VIEW USER  **/
	
	public function get_user_view_data($userid = "")
	{
		$result = $this->db->from("users")->where(array("user_id" => $userid))->join("city","city.city_id","users.city_id")->join("country","country.country_id","users.country_id") ->limit(1)->get();
		return $result;
	}	
	
	/** VIEW USER FOR TRANSACTION**/
	
	public function get_transaction_data($userid = "")
	{ 
	       $result = $this->db->from("users")
                                ->where(array("transaction.user_id" => $userid))
	                            ->join("transaction","transaction.user_id","users.user_id")
	                            ->join("deals","deals.deal_id","transaction.deal_id")
	                             ->orderby("transaction.id", "DESC")
                                ->get();
                        return $result;
	} 
	/** VIEW USER FOR TRANSACTION**/
	
	public function get_transaction_product_data($userid = "")
	{
	       $result = $this->db->select('*','transaction.shipping_amount as shippingamount')->from("users")
                                ->where(array("transaction.user_id" => $userid))
	                            ->join("transaction","transaction.user_id","users.user_id")
	                            ->join("product","transaction.product_id","product.deal_id")
	                            ->orderby("transaction.id", "DESC")
                                ->get();
                return $result;
	} 
	
	/** VIEW USER FOR TRANSACTION**/
	
	public function get_transaction_auction_data($userid = "")
	{
	       $result = $this->db->from("users")
                                ->where(array("transaction.user_id" => $userid))
	                            ->join("transaction","transaction.user_id","users.user_id")
	                            ->join("auction","transaction.auction_id","auction.deal_id")
	                            ->orderby("transaction.id", "DESC")
                                ->get();
                return $result;
	} 
	
	
	/** GET USER REFERAL LIST**/

	public function user_refrel_list($user_id)
	{ 
		$result = $this->db->from("users")
                        ->where(array("user_status"=>1,"referred_user_id" => $user_id))
                        ->get();

		return $result;
	}
	
	/** GET USER LIST **/
	public function get_user_list()
	{
                $result = $this->db->query("SELECT * FROM users WHERE  user_status = 1  and user_type = 7 ");
                return $result;
	}
	
	
}
