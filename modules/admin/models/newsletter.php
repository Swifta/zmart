<?php defined('SYSPATH') or die('No direct script access.');
class Newsletter_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db=new Database();
		$this->session = Session::instance();	
		$this->UserID = $this->session->get("UserID");
		
	}
	
	/** GET SUBSCRIBER DATA **/
	
	public function subscriber_list($offset = "", $record = "")
	{
		$result = $this->db->select("email_subscribe.*","city.city_name")->from("email_subscribe")
				->join("city","city.city_id","email_subscribe.city_id")
				->limit($record, $offset)
				->get();
				
		return $result;
	}
	
	/** COUNT OF RECORDS **/
	
	public function subscriber_list_count()
	{
		$result = $this->db->from("email_subscribe")
		->get();

		return count($result);
	}
	/** BLOCK UNBLOCK SUBSCRIBE **/
	
	public function blockunblocksubscriber($type = "",$user_id = "" )
	{  
	$status=0;
        if($type == 1){
          $status=1;
        }
        $result = $this->db->update("email_subscribe", array("suscribe_status" => $status), array("user_id" => $user_id));

        return count($result);
	}

	/** DELETE SUBSCRIBE  **/

	public function deletesubscriber($user_id = "")
	{
		$result = $this->db->delete('email_subscribe', array('user_id' => $user_id));
		return count($result);
	}
	
    
	/** NEWSLETTER SEND **/

	public function send_newsletter($post="",$file="",$logo="")
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
				
				$news=$this->db->query("select *,email_id as email from email_subscribe where  suscribe_status=1 and is_deleted= 0");
				
			}
			
			if(count($news) > 0){

			foreach($news as $c){
            	$from = CONTACT_EMAIL;
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
					$i++;
				}return 1;
				
			}
	
		
	}

	/** GET ALL CITY LIST **/
	
	public function getCityList()
	{
		$result = $this->db->from("city")
			->join("country","country.country_id","city.country_id")
			->orderby("city.city_name", "ASC")
			->where(array("city_status" => 1,"country.country_status"=>1))
			->get();

		return $result;
	}


	/** CHECK CITY EXIST OR NOT **/
    
	public function check_city_exist($country_id = "", $city_id = "")
	{
		$result = $this->db->from("city")
                            ->join("country","country.country_id","city.country_id")
			    ->where(array("city_status" => 1,"city.country_id" => $country_id, "city_id" => $city_id))
                            ->get();
        return $result;
	}
	
	/** GET SUB CATEGORY LIST **/
	
	public function get_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1))->orderby("category_name","ASC")->get();
		return $result;
	}

		/** GET SUB CATEGORY LIST **/
	
	public function get_top_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type" =>1))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	/** GET CITY DAILY DEALS LIST  **/
	
	public function get_city_daily_deals_list($category_id = 0)
	{
		$result = $this->db->query("select * from deals  left join stores on stores.store_id=deals.shop_id  left join city on city.city_id= stores.city_id left join  category on  category.category_id=deals.category_id  where deals.category_id = $category_id and deal_status = 1  and  stores.store_status = 1  and  category.category_status =1  and enddate >".time()." order by deals.deal_id DESC limit 5");
        return $result;
	}

	/** GET CITY DAILY DEALS LIST  **/
	
	public function get_city_daily_products_list($category_id = 0)
	{
		$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id  join city on city.city_id= stores.city_id join  category on  category.category_id=product.category_id  where product.category_id = $category_id  and deal_status = 1  and  stores.store_status = 1   and  category.category_status =1 and purchase_count < user_limit_quantity order by product.deal_id DESC limit 5");
	        return $result;
	}

	/** GET CITY DAILY DEALS LIST  **/
	
	public function get_city_daily_auction_list($category_id = 0)
	{
		$result = $this->db->query("select * from(auction)  join stores on stores.store_id=auction.shop_id  join city on city.city_id= stores.city_id join  category on  category.category_id=auction.category_id  where auction.category_id = $category_id and deal_status = 1 and enddate >".time()."  and  stores.store_status = 1   and  category.category_status =1  order by auction.deal_id DESC limit 5");
        return $result;
	}

	
	/** GET USERS CITY SUBSCRIPTION **/
	
	public function get_subscribed_user_list()
	{
		$result = $this->db->from("email_subscribe")
				->where(array("suscribe_city_status" => 1,"suscribe_status" => 1,"category_id !=" =>"" ,"category_id !=" =>"0" ))
				//->join("email_subscribe","email_subscribe.user_id","users.user_id")
				->get();
		return $result;
	}
	
	/**UPDATE USERS NEWSLETTER DATE **/
	public function update_users_news_date($user_id)
	{
	        $result = $this->db->update("users", array("newsletter_date" => time()), array("user_id" => $user_id));
	}

		/** GET CITY LIST JOIN COUNTRY **/

	public function get_all_city_list()
	{
		$result = $this->db->from("city")->join("country","country.country_id","city.country_id")->where(array("city_status" => 1,"country_status" => 1))->orderby("city_name", "ASC")->get();
		return $result;
	}
	
	/** GET CITY NAME FOR MANAGE SUBSCRIBER **/
	
	public function getCityList1($cityid="")
	{
		$result = $this->db->query("SELECT city.city_name FROM city WHERE FIND_IN_SET(city.city_id,'$cityid')");
		
		return $result;
	}
	
	/* GET MODULE SETTING LIST */
	public function get_setting_module_list()
	{
		$result = $this->db->from("module_settings")->get();
		return $result;
	}
	
	public function get_user_list($all_users="",$city="",$gender="",$age_range="")
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
		$news=$this->db->select("email","firstname","user_id")->from("users")->where(array("user_status"=>1,"user_type"=>4))->get();
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
			
			$news=$this->db->query("select * from  users where user_status=1 $conditions");
			return $news;
			
		}elseif(isset($all_users) && $all_users!=""){
			
			$news=$this->db->query("select * from  users where user_status=1 and user_type=4");
			return $news;
		}
		
		
	}
	
	public function getUSERList()
	{
		$result=$this->db->select("email","firstname")->from("users")->where(array("user_status"=>1,"user_type"=>4))->get();
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
	
	public function get_newsletter_list(){
		$result = $this->db->from("newsletter")->where("newsletter_status",1)->orderby("newsletter_id","ASC")->get();
		return $result;
	}
}
