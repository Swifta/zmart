<?php defined('SYSPATH') or die('No direct script access.');
class Settings_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();	
	}
	
	/** GET ALL SETTINGS DATA **/  
	
	public function getGeneralSettingsData()
	{
		$result =$this->db->from("settings")
						->get();
		return $result;
	}
	/* GET COUNTRY LIST */
	public function getcountrylist()
	{	
		$result =$this->db->from("settings")
						->join("country","country.currency_code","settings.currency_code")
						->get();
						
		return $result;
	}

	/** GET EMAIL SETTINGS DATA **/  
	
	public function getemailSettingsData()
	{
		$result =$this->db->from("email_settings")->get();
		return $result;
	}
	/* GET MODULE SETTING */
	public function getmoduleSettingsData()
	{
		$result =$this->db->from("module_settings")->get();
		return $result;
	}
	
	/** UPDATE GENERAL SETTING **/
	
	public function update_general_settings($post = "")
	{
		$status = $this->db->update("settings",array("site_name" => $post->name, "meta_keywords" => $post->keywords, "meta_description" => $post->description , "title" => $post->title , "theme" => $post->theme, "default_language" => $post->language), array("id" => 1));
		return 1;
	}

	/** UPDATE EMAIL SETTING **/
	
	public function email_settings($post = "")
	{
		$result = $this->db->update("settings",array("contact_name" => $post->name, "contact_email" => $post->contact_email, "webmaster_email" => $post->webmaster_email, "noreply_email" => $post->noreply_email,"phone1" => $post->phone1, "phone2" => $post->phone2 ,"latitude" => $post->latitude, "longitude" => $post->longitude), array("status" => 1));
		return 1;
	}
	
	/** UPDATE SMTP EMAIL SETTING **/
	
	public function sendgrid_mailer_settings($post = "")
	{ 	 	 	
		$result = $this->db->update("email_settings",array("sendgrid_host" => $post->smtp_host, "sendgrid_port" => $post->smtp_port, "sendgrid_username" => $post->smtp_username, "sendgrid_password" => $post->smtp_password), array("status" => 1));
		return 1;
	}
	/** UPDATE SMTP EMAIL SETTING **/
	
	public function smtp_mailer_settings($post = "")
	{ 	 	 	
		$result = $this->db->update("email_settings",array("smtp_host" => $post->host, "smtp_port" => $post->port, "smtp_username" => $post->username, "smtp_password" => $post->password), array("status" => 1));
		return 1;
	}
	/** UPDATE SMTP EMAIL SETTING **/
	
	public function mailchimp_mailer_settings($post = "")
	{ 	 	 	
		$result = $this->db->update("email_settings",array("api_key" => $post->api, "list_id" => $post->listid, "replay_to_mail" => $post->replay, "from_name" => $post->from), array("status" => 1));
		return 1;
	}
	
	/** UPDATE API SOCIAL MEDIA SETTING **/
	
	public function social_media($post = "",$addCode = "") 	 
	{
		$result = $this->db->update("settings",array("facebook_app_id" => $post->facebook_app_id, "facebook_secret_key" => $post->facebook_secret_key, "facebook_page" => $post->facebook, "twitter_page" => $post->twitter, "linkedin_page" => $post->linkedin,"instagram_page" => $post->instagram, "instagram_user_name" => $post->instagram_user_name, "instagram_user_id" => $post->instagram_user_id, "android_page" => $post->android, "iphone_page" => $post->iphone, "facebook_fanpage" => $post->fbfan, "youtube_url" => $post->youtube_url, "twitter_api_key" => $post->twitter_api_key, "twitter_secret_key" => $post->twitter_secret_key,"gmap_api_key" => $post->gmapkey,"analytics_code"=>$addCode), array("status" => 1));
		return 1;
	}

	/** UPDATE PAYMENT SETTING **/
	
	public function update_payment_settings($post = "")
	{

		$status = $this->db->update("settings",array("min_fund_request" => $post->minfund, "max_fund_request" => $post->maxfund, "currency_symbol" => trim($post->currency_symbol) , "currency_code" => trim($post->currency_code),"country_code" => trim($post->country_code),"referral_amount" => $post->referral_amount,"paypal_payment_mode" => $post->paypal_payment_mode,"paypal_account_id" => $post->Paypal_Account,"paypal_api_password" => $post->Paypal_API_Password,"paypal_api_signature" => $post->Paypal_API_Signature,"authorizenet_transaction_key" => $post->authorizenet_transaction_key,"authorizenet_api_id" => $post->authorizenet_api_id,"tax_percentage" => $post->tax_percentage,"flat_shipping" => $post->flat_shipping,"auction_extend_day" =>$post->auction_extend_day,"auction_alert_day" => $post->auction_alert_day,"pay_later"=>$post->pay_later,"monthly_storecredit"=>$post->monthly_storecredit), array("id" => 1)); 
		return 1;
	}

	/** GET CURRENCY **/
	
	public function get_currency()
	{
		$result = $this->db->select("currency_symbol")->from("settings")->get();
		return $result;
	}

	/** MODULE SETTINGS **/
		public function update_module($deal='',$product ='',$blog = '',$auction = '',$paypal = "",$credit_card = "",$authorize = "", $cash_on_delivery = "",$free_shipping = "",$flat_shipping = "",$per_product = "",$per_quantity = "",$aramex = "", $near_me_map = "",$store_list = "",$past_deal = "",$faq = "",$city = "",$cms ="",$newsletter = "",$pay_later="")
	{
		$status = $this->db->update("module_settings",array("is_deal" => $deal, "is_product" => $product, "is_auction" => $auction ,"is_blog" => $blog,"is_paypal" => $paypal, "is_credit_card" => $credit_card, "is_authorize" => $authorize, "is_cash_on_delivery" => $cash_on_delivery, "free_shipping" => $free_shipping,"flat_shipping" => $flat_shipping,"per_product" => $per_product,"per_quantity" => $per_quantity,"aramex" => $aramex,"is_map" =>$near_me_map,"is_store_list" =>$store_list,"is_past_deal" => $past_deal,"is_faq" =>$faq,"is_city" =>$city,"is_cms" =>$cms,"is_newsletter" =>$newsletter,"is_pay_later"=>$pay_later), array("module_id" => 1));
		return 1;
	}

	/** ADD BANNER	IMAGE  **/
	
	public function add_banner_image($image_title = "", $redirect_url = "", $post = "")
	{ 	
		$deal = (isset($_POST['deal']))?1:0;
		$product = (isset($_POST['product']))?1:0;
		$auction = (isset($_POST['auction']))?1:0;
		$status = $this->db->insert('banner_image',array("image_title" => $image_title, "product" => $product, "deal" => $deal, "auction" => $auction, "redirect_url" => $redirect_url));
		return $status->insert_id();
	}

	/** GET BANNER IMAGE COUNT  **/
	
	public function get_banner_image_count()
	{
		return $this->db->count_records("banner_image");
	}

	/** GET BANNER IMAGE LIST  **/
	
	public function get_banner_image_list($offset = "", $record = "")
	{
		return $this->db->limit($record,$offset)->orderby("banner_id","DESC")->get('banner_image');

	}

	/** EDIT BANNER IMAGE AND UPDATE  **/

	public function edit_banner_image($banner_id = "",$image_title = "",$redirect_url = "",$post = "")
	{ 
		$deal = (isset($_POST['deal']))?1:0;
		$product = (isset($_POST['product']))?1:0;
		$auction = (isset($_POST['auction']))?1:0;
		$status = $this->db->update("banner_image", array("image_title" =>$image_title,"product" => $product, "deal" => $deal, "auction" => $auction,"redirect_url"=>$redirect_url),array("banner_id" => $banner_id));
		return 1;
	}

	/** GET SINGLE BANNER IMAGE DATA FOR EDIT  **/

	public function getbannerData($banner_id = "")
	{
		return $this->db->getwhere('banner_image',array('banner_id' => $banner_id));
	}

	/** DELETE BANNER IMAGE **/
	
	public function delete_banner_image($banner_id = "")
	{
		$result = $this->db->delete("banner_image",array("banner_id" => $banner_id ));
		return count($result);
	}
		
	/** BLOCK UNBLOCK BANNER IMAGE **/
	
	public function blockunblock_banner_image($type = "", $banner_id = "")
	{
		$status = 0;
		if($type == 1){
			$status = 1;
		}
		
		$result = $this->db->update("banner_image", array("status" => $status),array("banner_id" => $banner_id));
		return count($result);
	}

	/** CHECK VALID POSITION FOR BANNER IMAGE **/
	
	public function check_position($position = "")
	{
			$result =  $this->db->count_records("banner_image", array("position" =>$position));
			if($result > 0){
				return 0;
			}
		return 1;

	}

	/** UPDATE BANNER RATING **/

		public function update_banner_rating($banner_id = "",$rate = "")
		{
			$check =  $this->db->select('banner_id','position')->from("banner_image")->where(array('position' =>$rate))->get();
				if(count($check) > 0){
					$old_rate = $this->db->select('position')->from('banner_image')->where(array('banner_id' =>$banner_id))->get();
						$this->db->update("banner_image", array("position" => $old_rate[0]->position), array("banner_id" => $check[0]->banner_id));
						$this->db->update("banner_image", array("position" => $rate), array("banner_id" => $banner_id));

				return $check[0]->banner_id.",".$old_rate[0]->position;
			}
				$result = $this->db->update("banner_image", array("position" => $rate), array("banner_id" => $banner_id));
                return count($result);
		}
			/** GET CURRENCY **/
	
	public function get_facebook_status($user_id)
	{
		$result = $this->db->select("facebook_update")->from("users")->where(array("user_id" => $user_id))->get();
		return $result;
	}
	/** GET COUNTRY **/
	
	public function get_country_list()
	{
			$result = $this->db->from("country")->where(array( "country_status" => '1'))->orderby("country_name")->get();
			return $result;
	}
	
		/** GET COUNTRY BASED CITY LIST **/
	
	public function get_currency_by_country($country){
		
		$result = $this->db->from("country")->where(array("country_id" => $country, "country_status" => '1'))->orderby("country_name")->get();
		return $result;
	}

	/** UPDATE  AUTO POST **/
	public function email_status($value1 = "")
	{	
		$result = $this->db->update("settings", array("email_type" =>$value1), array("status" => 1));
		return $result;
	}
	
	/** UPDATE  AUTO POST **/
	public function email_status1($value1 = "")
	{	
		$result = $this->db->update("settings", array("email_type" =>$value1), array("status" => 1));
		return $result;
	}
	
		/** UPDATE  AUTO POST **/
	public function email_status2($value1 = "")
	{	
		$result = $this->db->update("settings", array("email_type" =>$value1), array("status" => 1));
		return $result;
	}

	/** GET THE IMAGE RESIZE DATA LIST  AND THIS FUNCTION USED IN WEBSITE CONTROLLER **/

	public function get_image_resize_data()
	{
		$result = $this->db->get("image_resize"); 
		return $result;
	}
	
	/** UPDATE THE IMAGE RESIZE DATA'S   **/
	
	public function update_image_resize_settings($post = "")
	{
		if($post->common == 1){
				$this->db->update("image_resize",array("list_width" => $post->logo_width,"list_height" => $post->logo_height,"detail_width" => $post->favicon_width,"detail_height" => $post->favicon_height,"thumb_width" => $post->category_width,"thumb_height" => $post->category_height),array("type" => 1));
		}
		if($post->deal == 2){
				$this->db->update("image_resize",array("list_width" => $post->deal_list_width,"list_height" => $post->deal_list_height,"detail_width" => $post->deal_detail_width,"detail_height" => $post->deal_detail_height,"thumb_width" => $post->deal_thumb_width,"thumb_height" => $post->deal_thumb_height),array("type" => 2));
		}
		if($post->product == 3){
				$this->db->update("image_resize",array("list_width" => $post->product_list_width,"list_height" => $post->product_list_height,"detail_width" => $post->product_detail_width,"detail_height" => $post->product_detail_height,"thumb_width" => $post->product_thumb_width,"thumb_height" => $post->product_thumb_height),array("type" => 3));
		}
		if($post->auction == 4){
				$this->db->update("image_resize",array("list_width" => $post->auction_list_width,"list_height" => $post->auction_list_height,"detail_width" => $post->auction_detail_width,"detail_height" => $post->auction_detail_height,"thumb_width" => $post->auction_thumb_width,"thumb_height" => $post->auction_thumb_height),array("type" => 4));
		}
		if($post->store == 5){
				$this->db->update("image_resize",array("list_width" => $post->store_list_width,"list_height" => $post->store_list_height,"detail_width" => $post->store_detail_width,"detail_height" => $post->store_detail_height,"thumb_width" => $post->store_thumb_width,"thumb_height" => $post->store_thumb_height),array("type" => 5));
		}
		if($post->user == 6){
			
				$this->db->update("image_resize",array("list_width" => $post->user_list_width,"list_height" => $post->user_list_height,"detail_width" => $post->user_detail_width,"detail_height" => $post->user_detail_height,"thumb_width" => $post->banner_thumb_width,"thumb_height" => $post->banner_thumb_height),array("type" => 6));
		}
                if($post->map == 7){
				$this->db->update("image_resize",array("list_width" => $post->map_list_width,"list_height" => $post->map_list_height),array("type" => 7));
		} 
		return 1;
	}	

	/** GET DEALS CATEGORY LIST **/
	
	public function get_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"main_category_id"=>0))->orderby("category_name","ASC")->get();
		return $result;
	}
		/** GET DEALS SUB CATEGORY LIST **/
	
	public function get_subcategory_list($id="")
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"main_category_id !="=>0,"main_category_id"=>$id))->orderby("category_name","ASC")->get();
		return $result;
	}
	/* GET ADS LIST */
		public function get_ads_list()
	{
		$result = $this->db->from("ads")->where(array("status" => 1))->get();
		return $result;
	}
	/* GET BANNER LIST */
		public function get_banner_list()
	{
		$result = $this->db->from("banner_image")->where("status",1)->get();
		return $result;
	}
	
	/** UPDATE SHIPPING ACCOUNT SETTINGS **/
	
	public function shipping_settings($post = "")
	{
		$result = $this->db->update("users",array("AccountCountryCode" => $post->AccountCountryCode, "AccountEntity" => $post->AccountEntity, "AccountNumber" => $post->AccountNumber, "AccountPin" => $post->AccountPin,"UserName" => $post->UserName, "ShippingPassword" => $post->Password ), array("user_type" => 1));
		return 1;
	}
	
	/* GET SHIPPING SETTINGS */
	public function get_shipping_settings()
	{
		$result = $this->db->from("users")->where(array("user_type" => 1))->get();
		return $result;
	}
	
	/* GET MODULE SETTING LIST */
	public function get_setting_module_list()
	{
		$result = $this->db->from("module_settings")->get();
		return $result;
	}
	
	public function get_moderator_privileges($user_id = "")
	{
		return $this->db->getwhere('moderator_privileges_map',array('moderator_id' => $user_id));
	}
	
	public function get_admin_details()
	{
		$result = $this->db->select("address1,address2,city_name,country_name")->from("users")->join("city","city.city_id","users.city_id","left")->join("country","country.country_id","users.country_id","left")->where(array("user_type" => 1))->get();
		return $result;
	}
	
	public function get_admin_moderator_privileges($user_id = "")
	{
		return $this->db->getwhere('admin_moderator_privileges_map',array('moderator_id' => $user_id));
	}

}

