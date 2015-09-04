<?php defined('SYSPATH') OR die('No direct access allowed.');
class Layout_Controller extends Template_Controller
{
     public $template = "themes/template";
	function __construct()
	{
		parent::__construct();
		$this->session = Session::instance();
		$this->city_id = $this->session->get("CityID");
		if($this->city_id == ""){
			$this->city_id = $this->session->get("city_id");
		}
		
                $actual_link = $_SERVER['HTTP_HOST'];                
                $serverurl= $_SERVER['HTTP_HOST']; 
                if( $actual_link != $serverurl)
                {
                echo  DEFAULT_WEBSITE_MESSAGE;
                exit;
                }
                else
                {
                
		$this->UserID = $this->session->get("UserID");
		/*if(isset($_COOKIE['front_language'])){
		$this->session->set("front_language", $_COOKIE['front_language']);
		$sess_lang = $_COOKIE['front_language'];
		setcookie ("front_language", "", time() - 3600);
		} else {
		$sess_lang = $this->session->get("front_language");
		}*/
		
		/*if(isset($_SESSION['front_language'])){
			$sess_lang = $this->session->get("front_language");
		}else{
			$this->session->set("front_language","english");
			$sess_lang = $this->session->get("front_language");
		}*/
		$sess_lang = "english";
		$site_lang= ($sess_lang!="")?$sess_lang:DEFAULT_LANGUAGE;
		define('LANGUAGE', $site_lang); 
		include Kohana::find_file('vendor/language/frontend_language',LANGUAGE);
		$this->Lang = $content_text;
		$this->template->title = SITE_TITLE;
		$this->template->description = META_DESCRIPTION;
		$this->template->keywords = META_KEYWORDS;
		$this->template->content = "";
		$this->is_auction_refresh = 0;
		$this->template->metaimage = PATH."themes/".THEME_NAME."/images/logo.png";
		$this->template->style = "";
		$this->template->javascript = html::script(array(PATH.'js/jquery.js',PATH.'themes/'.THEME_NAME.'/js/public.js'));
		$this->response = $this->session->get('Success');
		$this->session->delete('Success');
		$this->error_response = $this->session->get('Error');
		$this->session->delete('Error');
		$this->home = new Home_Model();
		$this->all_setting_module = $this->home->get_setting_module_list();
		foreach($this->all_setting_module as $setting){
		        $this->deal_setting = $setting->is_deal;
		        $this->product_setting = $setting->is_product;
		        $this->blog_setting = $setting->is_blog;
		        $this->auction_setting = $setting->is_auction;
		        $this->paypal_setting = $setting->is_paypal;
		        $this->credit_card_setting = $setting->is_credit_card;
		        $this->authorize_setting = $setting->is_authorize;
		        $this->cash_on_delivery_setting = $setting->is_cash_on_delivery;
		        $this->shipping_setting = $setting->is_shipping;
			$this->map_setting = $setting->is_map;
			$this->store_setting = $setting->is_store_list;
			$this->past_deal_setting = $setting->is_past_deal;
			$this->faq_setting = $setting->is_faq;
			$this->cms_setting = $setting->is_cms;
			$this->newsletter_setting = $setting->is_newsletter;	
			$this->pay_later_setting = $setting->is_pay_later;		
			define('CITY_SETTING', $setting->is_city);
		}
		/** USING GEOIP FIND CITY ID **/
       		$this->all_country_list = $this->home->get_all_country_list();
		$this->all_city_list = $this->home->get_all_city_list();
		$this->cms_tc = $this->home->get_cms_data("terms-and-conditions");
		if(isset($_COOKIE['CityID_old'])){
		$this->session->set("CityID", $_COOKIE['CityID_old']);
		setcookie ("CityID_old", "", time() - 3600);
		} else {
		        if($this->city_id == ""){
			        foreach($this->all_city_list as $cityList){
				        if($cityList->default == 1){
					        $this->city_id = $cityList->city_id;
					        $this->session->set("CityID", $this->city_id);
					
				        }
			        }
		        }
		        if($this->city_id == ""){
			        foreach($this->all_city_list as $cityList){
				        $this->city_id = $cityList->city_id;
				        $this->session->set("CityID", $this->city_id);
				        break;
			        }
		        }
		        /** USING GEOIP FIND CITY ID **/
		        $geodata = Kogeoip::getRecord($this->input->ip_address());
		        if(!$this->city_id && $geodata){
			        $city_url = url::title($geodata->city);
			        if($city_url){
				        foreach($this->all_city_list as $cityList){
					        if($cityList->city_name == $geodata->city || $cityList->city_url == $city_url){
						        $this->city_id = $cityList->city_id;
						        $this->session->set("CityID", $this->city_id);
					        }
				        }
			        }
		        } 
		}
                $this->category_list = $this->home->get_category_list($this->deal_setting,$this->product_setting,$this->auction_setting);
                $this->all_category_list = $this->category_list;

                //$this->sub_category_list = $this->home->get_sub_category_list();
                $this->get_all_cms_title = $this->home->get_all_cms_page();
                $this->limit_value = array("1"=> "20", "2"=>"50", "3"=>"75", "4"=>"100");  // used in wish list to show the no of rows
                /** Image size settings **/
                $this->settings = new Settings_Model(); 
                $this->resize_setting = $this->settings->get_image_resize_data();

                $this->categeory_list_product = $this->home->get_category_list_product_count();
                $this->categeory_list_deal = $this->home->get_category_list_deal_count();
                $this->categeory_list_auction = $this->home->get_category_list_auction_count();
                 $this->get_about_us = $this->home->abou_us_page();
		foreach($this->resize_setting as $row) {
			if($row->type == 1){
				if (!defined('LOGO_WIDTH')) define('LOGO_WIDTH', $row->list_width);
				if (!defined('LOGO_HEIGHT')) define('LOGO_HEIGHT', $row->list_height);
				if (!defined('FAVICON_WIDTH'))define('FAVICON_WIDTH', $row->detail_width);		
				if (!defined('FAVICON_HEIGHT')) define('FAVICON_HEIGHT', $row->detail_height);
				if (!defined('CATEGORY_WIDTH')) define('CATEGORY_WIDTH', $row->thumb_width);		
				if (!defined('CATEGORY_HEIGHT')) define('CATEGORY_HEIGHT', $row->thumb_height);
			}
			if($row->type == 2){
				if (!defined('DEAL_LIST_WIDTH')) define('DEAL_LIST_WIDTH', $row->list_width);
				if (!defined('DEAL_LIST_HEIGHT')) define('DEAL_LIST_HEIGHT', $row->list_height);
				if (!defined('DEAL_DETAIL_WIDTH')) define('DEAL_DETAIL_WIDTH', $row->detail_width);		
				if (!defined('DEAL_DETAIL_HEIGHT')) define('DEAL_DETAIL_HEIGHT', $row->detail_height);
				if (!defined('DEAL_THUMB_WIDTH')) define('DEAL_THUMB_WIDTH', $row->thumb_width);
				if (!defined('DEAL_THUMB_HEIGHT')) define('DEAL_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 3){
				if (!defined('PRODUCT_LIST_WIDTH')) define('PRODUCT_LIST_WIDTH', $row->list_width);
				if (!defined('PRODUCT_LIST_HEIGHT')) define('PRODUCT_LIST_HEIGHT', $row->list_height);
				if (!defined('PRODUCT_DETAIL_WIDTH')) define('PRODUCT_DETAIL_WIDTH', $row->detail_width);		
				if (!defined('PRODUCT_DETAIL_HEIGHT')) define('PRODUCT_DETAIL_HEIGHT', $row->detail_height);
				if (!defined('PRODUCT_THUMB_WIDTH')) define('PRODUCT_THUMB_WIDTH', $row->thumb_width);
				if (!defined('PRODUCT_THUMB_HEIGHT')) define('PRODUCT_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 4){
				if (!defined('AUCTION_LIST_WIDTH')) define('AUCTION_LIST_WIDTH', $row->list_width);
				if (!defined('AUCTION_LIST_HEIGHT')) define('AUCTION_LIST_HEIGHT', $row->list_height);
				if (!defined('AUCTION_DETAIL_WIDTH')) define('AUCTION_DETAIL_WIDTH', $row->detail_width);		
				if (!defined('AUCTION_DETAIL_HEIGHT')) define('AUCTION_DETAIL_HEIGHT', $row->detail_height);
				if (!defined('AUCTION_THUMB_WIDTH')) define('AUCTION_THUMB_WIDTH', $row->thumb_width);
				if (!defined('AUCTION_THUMB_HEIGHT')) define('AUCTION_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 5){
				if (!defined('STORE_LIST_WIDTH')) define('STORE_LIST_WIDTH', $row->list_width);
				if (!defined('STORE_LIST_HEIGHT')) define('STORE_LIST_HEIGHT', $row->list_height);
				if (!defined('STORE_DETAIL_WIDTH')) define('STORE_DETAIL_WIDTH', $row->detail_width);		
				if (!defined('STORE_DETAIL_HEIGHT')) define('STORE_DETAIL_HEIGHT', $row->detail_height);
				if (!defined('STORE_THUMB_WIDTH')) define('STORE_THUMB_WIDTH', $row->thumb_width);
				if (!defined('STORE_THUMB_HEIGHT')) define('STORE_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 6){
				if (!defined('USER_LIST_WIDTH')) define('USER_LIST_WIDTH', $row->list_width);
				if (!defined('USER_LIST_HEIGHT')) define('USER_LIST_HEIGHT', $row->list_height);
				if (!defined('USER_DETAIL_WIDTH')) define('USER_DETAIL_WIDTH', $row->detail_width);
				if (!defined('USER_DETAIL_HEIGHT')) define('USER_DETAIL_HEIGHT', $row->detail_height);
				if (!defined('BANNER_WIDTH')) define('BANNER_WIDTH', $row->thumb_width);
				if (!defined('BANNER_HEIGHT')) define('BANNER_HEIGHT', $row->thumb_height);
			}
			if($row->type == 7){
				if (!defined('MAP_LIST_WIDTH')) define('MAP_LIST_WIDTH', $row->list_width);
				if (!defined('MAP_LIST_HEIGHT')) define('MAP_LIST_HEIGHT', $row->list_height);
			}
		}
		
		if(count($this->all_category_list)>0){
			$this->subcategories_list = $this->home->get_subcategories_list();
			$this->secondcategories_list = $this->home->get_secondcategories_list();
		}
		
		}
	}

	/** LOGOUT **/
	
	public function logout()
	{
		$city_id = $this->session->get("CityID");
		$sess_lang = $this->session->get("front_language");		
		$this->session->destroy();
		setcookie("CityID_old", $city_id);
		setcookie("front_language", $sess_lang);
		url::redirect(PATH.'subscribe.html');
	}

}
