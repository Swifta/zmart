<?php defined('SYSPATH') OR die('No direct access allowed.');
class Website_Controller extends Template_Controller 
{          
	public $template='themes/template';                 
	function __construct()
	{
		parent::__construct();
		$this->session = Session::instance();
		include Kohana::find_file('vendor/language/admin_language', DEFAULT_LANGUAGE);
		$this->Lang = $content_text;
		$this->template->title = $this->Lang["ADMIN_TITLE"];
		$this->template->content = "";
		
		$actual_link = $_SERVER['HTTP_HOST']; 
		$serverurl= $_SERVER['HTTP_HOST']; 
                if( $actual_link != $serverurl)
                {
                echo  DEFAULT_WEBSITE_MESSAGE;
                exit;
                }
                else
                {
                
		if(DEFAULT_LANGUAGE == "french" ){
			$this->template->style = html::stylesheet(array(PATH.'css/french_main.css'));
		} elseif(DEFAULT_LANGUAGE == "spanish"){
			$this->template->style = html::stylesheet(array(PATH.'css/spanish_main.css'));
		} else {
			$this->template->style = html::stylesheet(array(PATH.'css/main.css'));
		}
		$this->template->javascript = html::script(array(PATH.'js/jquery.js',PATH.'js/script.js'));
		$this->user_id = $this->session->get("user_id");
		$this->user_id1 = $this->session->get("user_id1");
		$this->user_type = $this->session->get("user_type");
		$this->store_admin_id = $this->session->get("store_admin_id");
		$this->response = $this->session->get('Success');
		$this->session->delete('Success');
		$this->error_response = $this->session->get('Error');
		$this->session->delete('Error'); 
		$this->settings = new Settings_Model(); 
		$this->all_setting_module = $this->settings->get_setting_module_list();
	        foreach($this->all_setting_module as $setting){
                        $this->free_shipping_setting = $setting->free_shipping;
                        $this->flat_shipping_setting = $setting->flat_shipping;
                        $this->per_product_setting = $setting->per_product;
                        $this->per_quantity_setting = $setting->per_quantity;
                        $this->aramex_setting = $setting->aramex;
	        }
	        define('REQUEST_URL_COUNT', 1);
	        // Moderator start	
	        
			if($this->user_type == "3" || $this->user_type == '9' ){
			                define('PRIVILEGES_DASHBOARD', 1);
			                
					define('PRIVILEGES_DEALS', 1);
					define('PRIVILEGES_DEALS_ADD', 1);
					define('PRIVILEGES_DEALS_EDIT', 1);
					define('PRIVILEGES_DEALS_BLOCK', 1);
					
					define('PRIVILEGES_PRODUCTS', 1);
					define('PRIVILEGES_PRODUCTS_ADD', 1);
					define('PRIVILEGES_PRODUCTS_EDIT', 1);
					define('PRIVILEGES_PRODUCTS_BLOCK', 1);
							
					define('PRIVILEGES_AUCTIONS', 1);
					define('PRIVILEGES_AUCTIONS_ADD', 1);
					define('PRIVILEGES_AUCTIONS_EDIT', 1);
					define('PRIVILEGES_AUCTIONS_BLOCK', 1);
													
					define('PRIVILEGES_TRANSACTIONS', 1);
					define('PRIVILEGES_FUNDREQUEST', 1);
					define('PRIVILEGES_FUNDREQUEST_EDIT', 1);
					
					define('PRIVILEGES_SHOPS', 1);
					define('PRIVILEGES_SHOPS_ADD', 1);
					define('PRIVILEGES_SHOPS_EDIT', 1);
					define('PRIVILEGES_SHOPS_BLOCK', 1);
					
					define('PRIVILEGES_SHIPPING_MODULE', 1);
					define('PRIVILEGES_SHIPPING_MODULE_EDIT', 1);
					
					define('PRIVILEGES_TERMS_AND_CONDITIONS', 1);
					define('PRIVILEGES_TERMS_AND_CONDITIONS_EDIT', 1);
					
					define('PRIVILEGES_RETURN_POLICY', 1);
					define('PRIVILEGES_RETURN_POLICY_EDIT', 1);
					
					define('PRIVILEGES_ABOUT_US', 1);
					define('PRIVILEGES_ABOUT_US_EDIT', 1);
					
					define('PRIVILEGES_PERSONALIZED_STORE', 1);
					define('PRIVILEGES_PERSONALIZED_STORE_EDIT', 1);
					
					define('PRIVILEGES_NEWSLETTER', 1);
					define('PRIVILEGES_NEWSLETTER_ADD', 1);
					
					define('PRIVILEGES_ATTRIBUTES', 1);
					define('PRIVILEGES_ATTRIBUTES_ADD', 1);
					define('PRIVILEGES_ATTRIBUTES_EDIT', 1);
										
					define('PRIVILEGES_CATEGORY', 1);
					define('PRIVILEGES_CATEGORY_ADD', 1);
					define('PRIVILEGES_CATEGORY_EDIT', 1);
									
					define('PRIVILEGES_SPECIFICATION', 1);
					define('PRIVILEGES_SPECIFICATION_ADD', 1);
					define('PRIVILEGES_SPECIFICATION_EDIT', 1);
					
					define('PRIVILEGES_GIFT', 1);
					define('PRIVILEGES_GIFT_ADD', 1);
					define('PRIVILEGES_GIFT_EDIT', 1);
					define('PRIVILEGES_GIFT_BLOCK', 1);
					
					
			} 
			if($this->user_type == "8"){
			$this->moderator_privileges = $this->settings->get_moderator_privileges($this->user_id1);
			        foreach($this->moderator_privileges as $mod) {
			                define('PRIVILEGES_DASHBOARD', $mod->privileges_dashboard);
			                
					define('PRIVILEGES_DEALS', $mod->privileges_deals);
					define('PRIVILEGES_DEALS_ADD', $mod->privileges_deals_add);
					define('PRIVILEGES_DEALS_EDIT', $mod->privileges_deals_edit);
					define('PRIVILEGES_DEALS_BLOCK', $mod->privileges_deals_block);
					
					define('PRIVILEGES_PRODUCTS', $mod->privileges_products);
					define('PRIVILEGES_PRODUCTS_ADD', $mod->privileges_products_add);
					define('PRIVILEGES_PRODUCTS_EDIT', $mod->privileges_products_edit);
					define('PRIVILEGES_PRODUCTS_BLOCK', $mod->privileges_products_block);
							
					define('PRIVILEGES_AUCTIONS', $mod->privileges_auctions);
					define('PRIVILEGES_AUCTIONS_ADD', $mod->privileges_auctions_add);
					define('PRIVILEGES_AUCTIONS_EDIT', $mod->privileges_auctions_edit);
					define('PRIVILEGES_AUCTIONS_BLOCK', $mod->privileges_auctions_block);
					
					define('PRIVILEGES_SHOPS', $mod->privileges_shop);
					define('PRIVILEGES_SHOPS_ADD', $mod->privileges_shop_add);
					define('PRIVILEGES_SHOPS_EDIT', $mod->privileges_shop_edit);
					define('PRIVILEGES_SHOPS_BLOCK', $mod->privileges_shop_block);
					
					define('PRIVILEGES_SHIPPING_MODULE', $mod->privileges_shipping);
					define('PRIVILEGES_SHIPPING_MODULE_EDIT', $mod->privileges_shipping_edit);
					
					define('PRIVILEGES_TERMS_AND_CONDITIONS', $mod->privileges_shipping_edit);
					define('PRIVILEGES_TERMS_AND_CONDITIONS_EDIT', $mod->privileges_tac_edit);
					
					define('PRIVILEGES_RETURN_POLICY', $mod->privileges_return_policy);
					define('PRIVILEGES_RETURN_POLICY_EDIT', $mod->privileges_return_policy_edit);
					
					define('PRIVILEGES_ABOUT_US', $mod->privileges_about_us);
					define('PRIVILEGES_ABOUT_US_EDIT', $mod->privileges_about_us_edit);
					
					define('PRIVILEGES_PERSONALIZED_STORE', $mod->privileges_personalized_store);
					define('PRIVILEGES_PERSONALIZED_STORE_EDIT', $mod->privileges_personalized_store_edit);
					
					define('PRIVILEGES_TRANSACTIONS', $mod->privileges_transactions);
					define('PRIVILEGES_FUNDREQUEST', $mod->privileges_fundrequest);
					define('PRIVILEGES_FUNDREQUEST_EDIT', $mod->privileges_fundrequest_edit);
					
					define('PRIVILEGES_NEWSLETTER', $mod->privileges_newsletter);
					define('PRIVILEGES_NEWSLETTER_ADD', $mod->privileges_newsletter_add);
					
					define('PRIVILEGES_ATTRIBUTES', $mod->privileges_attributs);
					define('PRIVILEGES_ATTRIBUTES_ADD', $mod->privileges_attributs_add);
					define('PRIVILEGES_ATTRIBUTES_EDIT', $mod->privileges_attributs_edit);
										
					define('PRIVILEGES_CATEGORY', $mod->privileges_categories);
					define('PRIVILEGES_CATEGORY_ADD', $mod->privileges_categories_add);
					define('PRIVILEGES_CATEGORY_EDIT', $mod->privileges_categories_edit);
									
					define('PRIVILEGES_SPECIFICATION', $mod->privileges_specification);
					define('PRIVILEGES_SPECIFICATION_ADD', $mod->privileges_specification_add);
					define('PRIVILEGES_SPECIFICATION_EDIT', $mod->privileges_specification_edit);
					
					define('PRIVILEGES_GIFT', $mod->privileges_gift);
					define('PRIVILEGES_GIFT_ADD', $mod->privileges_gift_add);
					define('PRIVILEGES_GIFT_EDIT', $mod->privileges_gift_edit);
					define('PRIVILEGES_GIFT_BLOCK', $mod->privileges_gift_block);
					
			        }
			} 
			
			if($this->user_type == "1"){
				define('ADMIN_PRIVILEGES_DASHBOARD', 1);
					define('ADMIN_PRIVILEGES_DEALS', 1);
					define('ADMIN_PRIVILEGES_DEALS_ADD', 1);
					define('ADMIN_PRIVILEGES_DEALS_EDIT', 1);
					define('ADMIN_PRIVILEGES_DEALS_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_PRODUCTS', 1);
					define('ADMIN_PRIVILEGES_PRODUCTS_ADD', 1);
					define('ADMIN_PRIVILEGES_PRODUCTS_EDIT', 1);
					define('ADMIN_PRIVILEGES_PRODUCTS_BLOCK', 1);
							
					define('ADMIN_PRIVILEGES_AUCTIONS', 1);
					define('ADMIN_PRIVILEGES_AUCTIONS_ADD', 1);
					define('ADMIN_PRIVILEGES_AUCTIONS_EDIT', 1);
					define('ADMIN_PRIVILEGES_AUCTIONS_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_CUSTOMER', 1);	
					define('ADMIN_PRIVILEGES_CUSTOMER_ADD', 1);	
					define('ADMIN_PRIVILEGES_CUSTOMER_EDIT', 1);	
					define('ADMIN_PRIVILEGES_CUSTOMER_BLOCK', 1);
							
					define('ADMIN_PRIVILEGES_MERCHANT', 1);
					define('ADMIN_PRIVILEGES_MERCHANT_ADD', 1);
					define('ADMIN_PRIVILEGES_MERCHANT_EDIT', 1);
					define('ADMIN_PRIVILEGES_MERCHANT_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_BLOG', 1);
					define('ADMIN_PRIVILEGES_BLOG_ADD', 1);
					define('ADMIN_PRIVILEGES_BLOG_EDIT', 1);
					define('ADMIN_PRIVILEGES_BLOG_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_CMS', 1);
					define('ADMIN_PRIVILEGES_CMS_ADD', 1);
					define('ADMIN_PRIVILEGES_CMS_EDIT', 1);
					define('ADMIN_PRIVILEGES_CMS_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_ATTRIBUTS', 1);
					define('ADMIN_PRIVILEGES_ATTRIBUTS_ADD', 1);
					define('ADMIN_PRIVILEGES_ATTRIBUTS_EDIT', 1);
					define('ADMIN_PRIVILEGES_ATTRIBUTS_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_CATEGORIES', 1);
					define('ADMIN_PRIVILEGES_CATEGORIES_ADD', 1);
					define('ADMIN_PRIVILEGES_CATEGORIES_EDIT', 1);
					define('ADMIN_PRIVILEGES_CATEGORIES_BLOCK', 1);
							
					define('ADMIN_PRIVILEGES_COUNTRY', 1);
					define('ADMIN_PRIVILEGES_COUNTRY_ADD', 1);
					define('ADMIN_PRIVILEGES_COUNTRY_EDIT', 1);
					define('ADMIN_PRIVILEGES_COUNTRY_BLOCK', 1); 
					
					define('ADMIN_PRIVILEGES_CITY', 1);
					define('ADMIN_PRIVILEGES_CITY_ADD', 1);
					define('ADMIN_PRIVILEGES_CITY_EDIT', 1);
					define('ADMIN_PRIVILEGES_CITY_BLOCK', 1);

					define('ADMIN_PRIVILEGES_TRANSACTIONS', 1);
					define('ADMIN_PRIVILEGES_FUNDREQUEST', 1);
					define('ADMIN_PRIVILEGES_FUNDREQUEST_EDIT', 1);
					define('ADMIN_PRIVILEGES_DAILY_NEWSLETTER', 1);
					
					define('ADMIN_PRIVILEGES_STORECREDIT', 1);
					
					define('ADMIN_PRIVILEGES_CUSTOMERCARE', 1);
					define('ADMIN_PRIVILEGES_CUSTOMERCARE_ADD', 1);
					define('ADMIN_PRIVILEGES_CUSTOMERCARE_EDIT', 1);
					define('ADMIN_PRIVILEGES_CUSTOMERCARE_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_BANNER', 1);
					define('ADMIN_PRIVILEGES_BANNER_ADD', 1);
					define('ADMIN_PRIVILEGES_BANNER_EDIT', 1);
					define('ADMIN_PRIVILEGES_BANNER_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_SPECIFICATION', 1);
					define('ADMIN_PRIVILEGES_SPECIFICATION_ADD', 1);
					define('ADMIN_PRIVILEGES_SPECIFICATION_EDIT', 1);
					define('ADMIN_PRIVILEGES_SPECIFICATION_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_SECTOR', 1);
					define('ADMIN_PRIVILEGES_SECTOR_ADD', 1);
					define('ADMIN_PRIVILEGES_SECTOR_EDIT', 1);
					define('ADMIN_PRIVILEGES_SECTOR_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_ADS', 1);
					define('ADMIN_PRIVILEGES_ADS_ADD', 1);
					define('ADMIN_PRIVILEGES_ADS_EDIT', 1);
					define('ADMIN_PRIVILEGES_ADS_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_FAQ', 1);
					define('ADMIN_PRIVILEGES_FAQ_ADD', 1);
					define('ADMIN_PRIVILEGES_FAQ_EDIT', 1);
					define('ADMIN_PRIVILEGES_FAQ_BLOCK', 1);
					
					define('ADMIN_PRIVILEGES_NEWSLETTER', 1);
					define('ADMIN_PRIVILEGES_NEWSLETTER_ADD', 1);
					define('ADMIN_PRIVILEGES_NEWSLETTER_EDIT', 1);
					define('ADMIN_PRIVILEGES_NEWSLETTER_BLOCK', 1);
					
			}else if($this->user_type == "2"){ 
				$this->moderator_privileges = $this->settings->get_admin_moderator_privileges($this->user_id);
			    foreach($this->moderator_privileges as $mod) {
					define('ADMIN_PRIVILEGES_DASHBOARD', $mod->privileges_dashboard);
					define('ADMIN_PRIVILEGES_DEALS', $mod->privileges_deals);
					define('ADMIN_PRIVILEGES_DEALS_ADD', $mod->privileges_deals_add);
					define('ADMIN_PRIVILEGES_DEALS_EDIT', $mod->privileges_deals_edit);
					define('ADMIN_PRIVILEGES_DEALS_BLOCK', $mod->privileges_deals_block);
					
					define('ADMIN_PRIVILEGES_PRODUCTS', $mod->privileges_products);
					define('ADMIN_PRIVILEGES_PRODUCTS_ADD', $mod->privileges_products_add);
					define('ADMIN_PRIVILEGES_PRODUCTS_EDIT', $mod->privileges_products_edit);
					define('ADMIN_PRIVILEGES_PRODUCTS_BLOCK', $mod->privileges_products_block);
							
					define('ADMIN_PRIVILEGES_AUCTIONS', $mod->privileges_auctions);
					define('ADMIN_PRIVILEGES_AUCTIONS_ADD', $mod->privileges_auctions_add);
					define('ADMIN_PRIVILEGES_AUCTIONS_EDIT', $mod->privileges_auctions_edit);
					define('ADMIN_PRIVILEGES_AUCTIONS_BLOCK', $mod->privileges_auctions_block);
					
					define('ADMIN_PRIVILEGES_CUSTOMER', $mod->privileges_customer);	
					define('ADMIN_PRIVILEGES_CUSTOMER_ADD', $mod->privileges_customer_add);	
					define('ADMIN_PRIVILEGES_CUSTOMER_EDIT', $mod->privileges_customer_edit);	
					define('ADMIN_PRIVILEGES_CUSTOMER_BLOCK', $mod->privileges_customer_block);
							
					define('ADMIN_PRIVILEGES_MERCHANT', $mod->privileges_merchant);
					define('ADMIN_PRIVILEGES_MERCHANT_ADD', $mod->privileges_merchant_add);
					define('ADMIN_PRIVILEGES_MERCHANT_EDIT', $mod->privileges_merchant_edit);
					define('ADMIN_PRIVILEGES_MERCHANT_BLOCK', $mod->privileges_merchant_block);
					
					define('ADMIN_PRIVILEGES_BLOG', $mod->privileges_blogs);
					define('ADMIN_PRIVILEGES_BLOG_ADD', $mod->privileges_blogs_add);
					define('ADMIN_PRIVILEGES_BLOG_EDIT', $mod->privileges_blogs_edit);
					define('ADMIN_PRIVILEGES_BLOG_BLOCK', $mod->privileges_blogs_block);
					
					define('ADMIN_PRIVILEGES_CMS', $mod->privileges_cms);
					define('ADMIN_PRIVILEGES_CMS_ADD', $mod->privileges_cms_add);
					define('ADMIN_PRIVILEGES_CMS_EDIT', $mod->privileges_cms_edit);
					define('ADMIN_PRIVILEGES_CMS_BLOCK', $mod->privileges_cms_block);
					
					define('ADMIN_PRIVILEGES_ATTRIBUTS', $mod->privileges_attributs);
					define('ADMIN_PRIVILEGES_ATTRIBUTS_ADD', $mod->privileges_attributs_add);
					define('ADMIN_PRIVILEGES_ATTRIBUTS_EDIT', $mod->privileges_attributs_edit);
					define('ADMIN_PRIVILEGES_ATTRIBUTS_BLOCK', $mod->privileges_attributs_block);
					
					define('ADMIN_PRIVILEGES_CATEGORIES', $mod->privileges_categories);
					define('ADMIN_PRIVILEGES_CATEGORIES_ADD', $mod->privileges_categories_add);
					define('ADMIN_PRIVILEGES_CATEGORIES_EDIT', $mod->privileges_categories_edit);
					define('ADMIN_PRIVILEGES_CATEGORIES_BLOCK', $mod->privileges_categories_block);
							
					define('ADMIN_PRIVILEGES_COUNTRY', $mod->privileges_country);
					define('ADMIN_PRIVILEGES_COUNTRY_ADD', $mod->privileges_country_add);
					define('ADMIN_PRIVILEGES_COUNTRY_EDIT', $mod->privileges_country_edit);
					define('ADMIN_PRIVILEGES_COUNTRY_BLOCK', $mod->privileges_country_block); 
					
					define('ADMIN_PRIVILEGES_CITY', $mod->privileges_city);
					define('ADMIN_PRIVILEGES_CITY_ADD', $mod->privileges_city_add);
					define('ADMIN_PRIVILEGES_CITY_EDIT', $mod->privileges_city_edit);
					define('ADMIN_PRIVILEGES_CITY_BLOCK', $mod->privileges_city_block);

					define('ADMIN_PRIVILEGES_TRANSACTIONS', $mod->privileges_transactions);
					define('ADMIN_PRIVILEGES_FUNDREQUEST', $mod->privileges_fundrequest);
					define('ADMIN_PRIVILEGES_FUNDREQUEST_EDIT', $mod->privileges_fundrequest_edit);
					define('ADMIN_PRIVILEGES_DAILY_NEWSLETTER', $mod->privileges_daily_newsletter);
					
					define('ADMIN_PRIVILEGES_STORECREDIT', $mod->privileges_storecredit);
					
					define('ADMIN_PRIVILEGES_CUSTOMERCARE', $mod->privileges_customercare);
					define('ADMIN_PRIVILEGES_CUSTOMERCARE_ADD', $mod->privileges_customercare_add);
					define('ADMIN_PRIVILEGES_CUSTOMERCARE_EDIT', $mod->privileges_customercare_edit);
					define('ADMIN_PRIVILEGES_CUSTOMERCARE_BLOCK', $mod->privileges_customercare_block);
					
					define('ADMIN_PRIVILEGES_BANNER', $mod->privileges_banner);
					define('ADMIN_PRIVILEGES_BANNER_ADD', $mod->privileges_banner_add);
					define('ADMIN_PRIVILEGES_BANNER_EDIT', $mod->privileges_banner_edit);
					define('ADMIN_PRIVILEGES_BANNER_BLOCK', $mod->privileges_banner_block);
					
					define('ADMIN_PRIVILEGES_SPECIFICATION', $mod->privileges_specification);
					define('ADMIN_PRIVILEGES_SPECIFICATION_ADD', $mod->privileges_specification_add);
					define('ADMIN_PRIVILEGES_SPECIFICATION_EDIT', $mod->privileges_specification_edit);
					define('ADMIN_PRIVILEGES_SPECIFICATION_BLOCK', $mod->privileges_specification_block);
					
					define('ADMIN_PRIVILEGES_SECTOR', $mod->privileges_sector);
					define('ADMIN_PRIVILEGES_SECTOR_ADD', $mod->privileges_sector_add);
					define('ADMIN_PRIVILEGES_SECTOR_EDIT', $mod->privileges_sector_edit);
					define('ADMIN_PRIVILEGES_SECTOR_BLOCK', $mod->privileges_sector_block);
					
					define('ADMIN_PRIVILEGES_ADS', $mod->privileges_ads);
					define('ADMIN_PRIVILEGES_ADS_ADD', $mod->privileges_ads_add);
					define('ADMIN_PRIVILEGES_ADS_EDIT', $mod->privileges_ads_edit);
					define('ADMIN_PRIVILEGES_ADS_BLOCK', $mod->privileges_ads_block);
					
					define('ADMIN_PRIVILEGES_FAQ', $mod->privileges_faq);
					define('ADMIN_PRIVILEGES_FAQ_ADD', $mod->privileges_faq_add);
					define('ADMIN_PRIVILEGES_FAQ_EDIT', $mod->privileges_faq_edit);
					define('ADMIN_PRIVILEGES_FAQ_BLOCK', $mod->privileges_faq_block);
					
					define('ADMIN_PRIVILEGES_NEWSLETTER', $mod->privileges_newsletter);
					define('ADMIN_PRIVILEGES_NEWSLETTER_ADD', $mod->privileges_newsletter_add);
					define('ADMIN_PRIVILEGES_NEWSLETTER_EDIT', $mod->privileges_newsletter_edit);
					define('ADMIN_PRIVILEGES_NEWSLETTER_BLOCK', $mod->privileges_newsletter_block);
					
			        }
			}else if($this->user_type==7){
				define('ADMIN_PRIVILEGES_DASHBOARD', 1);
				define('ADMIN_PRIVILEGES_DEALS', 1);
				define('ADMIN_PRIVILEGES_DEALS_ADD', 0);
				define('ADMIN_PRIVILEGES_DEALS_EDIT', 0);
				define('ADMIN_PRIVILEGES_DEALS_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_PRODUCTS', 1);
				define('ADMIN_PRIVILEGES_PRODUCTS_ADD', 0);
				define('ADMIN_PRIVILEGES_PRODUCTS_EDIT', 0);
				define('ADMIN_PRIVILEGES_PRODUCTS_BLOCK', 0);
						
				define('ADMIN_PRIVILEGES_AUCTIONS', 1);
				define('ADMIN_PRIVILEGES_AUCTIONS_ADD', 0);
				define('ADMIN_PRIVILEGES_AUCTIONS_EDIT', 0);
				define('ADMIN_PRIVILEGES_AUCTIONS_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_CUSTOMER', 1);	
				define('ADMIN_PRIVILEGES_CUSTOMER_ADD', 0);	
				define('ADMIN_PRIVILEGES_CUSTOMER_EDIT', 0);	
				define('ADMIN_PRIVILEGES_CUSTOMER_BLOCK', 0);
						
				define('ADMIN_PRIVILEGES_MERCHANT', 1);
				define('ADMIN_PRIVILEGES_MERCHANT_ADD', 0);
				define('ADMIN_PRIVILEGES_MERCHANT_EDIT', 0);
				define('ADMIN_PRIVILEGES_MERCHANT_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_BLOG', 1);
				define('ADMIN_PRIVILEGES_BLOG_ADD', 0);
				define('ADMIN_PRIVILEGES_BLOG_EDIT', 0);
				define('ADMIN_PRIVILEGES_BLOG_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_CMS', 1);
				define('ADMIN_PRIVILEGES_CMS_ADD', 0);
				define('ADMIN_PRIVILEGES_CMS_EDIT', 0);
				define('ADMIN_PRIVILEGES_CMS_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_ATTRIBUTS', 0);
				define('ADMIN_PRIVILEGES_ATTRIBUTS_ADD', 0);
				define('ADMIN_PRIVILEGES_ATTRIBUTS_EDIT', 0);
				define('ADMIN_PRIVILEGES_ATTRIBUTS_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_CATEGORIES', 1);
				define('ADMIN_PRIVILEGES_CATEGORIES_ADD', 0);
				define('ADMIN_PRIVILEGES_CATEGORIES_EDIT', 0);
				define('ADMIN_PRIVILEGES_CATEGORIES_BLOCK', 0);
						
				define('ADMIN_PRIVILEGES_COUNTRY', 1);
				define('ADMIN_PRIVILEGES_COUNTRY_ADD', 0);
				define('ADMIN_PRIVILEGES_COUNTRY_EDIT', 0);
				define('ADMIN_PRIVILEGES_COUNTRY_BLOCK', 0); 
				
				define('ADMIN_PRIVILEGES_CITY', 1);
				define('ADMIN_PRIVILEGES_CITY_ADD', 0);
				define('ADMIN_PRIVILEGES_CITY_EDIT', 0);
				define('ADMIN_PRIVILEGES_CITY_BLOCK', 0);

				define('ADMIN_PRIVILEGES_TRANSACTIONS', 1);
				define('ADMIN_PRIVILEGES_FUNDREQUEST', 1);
				define('ADMIN_PRIVILEGES_FUNDREQUEST_EDIT', 0);
				define('ADMIN_PRIVILEGES_DAILY_NEWSLETTER', 0);
				
				define('ADMIN_PRIVILEGES_STORECREDIT', 1);
				
				define('ADMIN_PRIVILEGES_CUSTOMERCARE', 1);
				define('ADMIN_PRIVILEGES_CUSTOMERCARE_ADD', 0);
				define('ADMIN_PRIVILEGES_CUSTOMERCARE_EDIT', 0);
				define('ADMIN_PRIVILEGES_CUSTOMERCARE_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_BANNER', 0);
				define('ADMIN_PRIVILEGES_BANNER_ADD', 0);
				define('ADMIN_PRIVILEGES_BANNER_EDIT', 0);
				define('ADMIN_PRIVILEGES_BANNER_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_SPECIFICATION', 1);
				define('ADMIN_PRIVILEGES_SPECIFICATION_ADD', 0);
				define('ADMIN_PRIVILEGES_SPECIFICATION_EDIT', 0);
				define('ADMIN_PRIVILEGES_SPECIFICATION_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_SECTOR', 1);
				define('ADMIN_PRIVILEGES_SECTOR_ADD', 0);
				define('ADMIN_PRIVILEGES_SECTOR_EDIT', 0);
				define('ADMIN_PRIVILEGES_SECTOR_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_ADS', 1);
				define('ADMIN_PRIVILEGES_ADS_ADD', 0);
				define('ADMIN_PRIVILEGES_ADS_EDIT', 0);
				define('ADMIN_PRIVILEGES_ADS_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_FAQ', 1);
				define('ADMIN_PRIVILEGES_FAQ_ADD', 0);
				define('ADMIN_PRIVILEGES_FAQ_EDIT', 0);
				define('ADMIN_PRIVILEGES_FAQ_BLOCK', 0);
				
				define('ADMIN_PRIVILEGES_NEWSLETTER', 0);
				define('ADMIN_PRIVILEGES_NEWSLETTER_ADD', 0);
				define('ADMIN_PRIVILEGES_NEWSLETTER_EDIT', 0);
				define('ADMIN_PRIVILEGES_NEWSLETTER_BLOCK', 0);
					
			}
			
			// Moderator End
			
		$this->resize_setting = $this->settings->get_image_resize_data();
		foreach($this->resize_setting as $row) {
			if($row->type == 1){
				define('LOGO_WIDTH', $row->list_width);
				define('LOGO_HEIGHT', $row->list_height);
				define('FAVICON_WIDTH', $row->detail_width);		
				define('FAVICON_HEIGHT', $row->detail_height);
				define('CATEGORY_WIDTH', $row->thumb_width);		
				define('CATEGORY_HEIGHT', $row->thumb_height);
			}
			if($row->type == 2){
				define('DEAL_LIST_WIDTH', $row->list_width);
				define('DEAL_LIST_HEIGHT', $row->list_height);
				define('DEAL_DETAIL_WIDTH', $row->detail_width);		
				define('DEAL_DETAIL_HEIGHT', $row->detail_height);
				define('DEAL_THUMB_WIDTH', $row->thumb_width);
				define('DEAL_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 3){
				define('PRODUCT_LIST_WIDTH', $row->list_width);
				define('PRODUCT_LIST_HEIGHT', $row->list_height);
				define('PRODUCT_DETAIL_WIDTH', $row->detail_width);		
				define('PRODUCT_DETAIL_HEIGHT', $row->detail_height);
				define('PRODUCT_THUMB_WIDTH', $row->thumb_width);
				define('PRODUCT_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 4){
				define('AUCTION_LIST_WIDTH', $row->list_width);
				define('AUCTION_LIST_HEIGHT', $row->list_height);
				define('AUCTION_DETAIL_WIDTH', $row->detail_width);		
				define('AUCTION_DETAIL_HEIGHT', $row->detail_height);
				define('AUCTION_THUMB_WIDTH', $row->thumb_width);
				define('AUCTION_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 5){
				define('STORE_LIST_WIDTH', $row->list_width);
				define('STORE_LIST_HEIGHT', $row->list_height);
				define('STORE_DETAIL_WIDTH', $row->detail_width);		
				define('STORE_DETAIL_HEIGHT', $row->detail_height);
				define('STORE_THUMB_WIDTH', $row->thumb_width);
				define('STORE_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 6){
				define('BANNER_WIDTH', $row->thumb_width);
				define('BANNER_HEIGHT', $row->thumb_height);
			}
                        if($row->type == 7){
				define('MAP_LIST_WIDTH', $row->list_width);
				define('MAP_LIST_HEIGHT', $row->list_height);
			}
		}
	}
	
	}
}
