<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Allows a template to be automatically loaded and displayed. Display can be
 * dynamically turned off in the controller methods, and the template file
 * can be overloaded.
 *
 * To use it, declare your controller to extend this class:
 * `class Your_Controller extends Template_Controller`
 *
 * $Id: template.php 3769 2008-12-15 00:48:56Z zombor $
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */

abstract class Template_Controller extends Controller {

	// Template view name
	public $template = 'template';

	// Default to do auto-rendering
	public $auto_render = TRUE;

        /**
        * Template loading and setup routine.
        */
	public function __construct()
	{
		parent::__construct();

		$path = explode('.',$_SERVER['SCRIPT_NAME']);
		$url = explode('/',$path[0]);
		$cnt = count($url)-1; 
		$SEGMENT = "";
		for($i=0; $i<$cnt; $i++){
			$SEGMENT .= $url[$i].'/';
		}
		
		 $this->session = Session::instance();
		/* if($this->session->get("store_url")) {
			define('PATH', "http://".$_SERVER['HTTP_HOST']."/".$this->session->get("store_url")."/");
			$redirect_url = $this->session->get("store_url");
			$this->session->delete("store_url");
			//$this->session->delete("new_url");
			url::redirect(PATH);
		} else {
			define('PATH', "http://".$_SERVER['HTTP_HOST'].$SEGMENT);
		} */
		define('PATH', "http://".$_SERVER['HTTP_HOST'].$SEGMENT);
		//include Kohana::find_file('vendor', "mobile_device_detect");
		//$mobile = mobile_device_detect();

		/*if($mobile && strpos(PATH, "mob.") != 7){ 
			//url::redirect("http://mob.".$_SERVER['HTTP_HOST'].$SEGMENT);
		}*/
		
                $website_message = "<p style='margin:150px auto;background:#f7f7f7;font:nomral 20px arial;color:#000;text-align:center;width:600px;border:1px solid #dfdfdf;padding:20px;border-radius:2px;-moz-border-radius:2px;-webkit-border-radius:2px;'>Page not found...! Please contact <a href='http://www.uniecommerce.com/' title = 'UniEcommerce'>UniEcommerce</a> for further clarifications.</p>";
                define('DEFAULT_WEBSITE_MESSAGE', $website_message);
                
                $actual_link = $_SERVER['HTTP_HOST'];                
                $serverurl= $_SERVER['HTTP_HOST']; 
                if( $actual_link != $serverurl)
                {
                echo  DEFAULT_WEBSITE_MESSAGE;
                exit;
                }
                else
                {
                
		$this->settings = new Settings_Model();
		$this->generalSettings = $this->settings->getGeneralSettingsData();
		$this->category_list = $this->settings->get_category_list();
		//$this->categeory_list = $this->settings->get_subcategory_list();
		$this->ads_details = $this->settings->get_ads_list();
		$this->banner_details = $this->settings->get_banner_list();
		$this->admin_details = $this->settings->get_admin_details();
		if(count($this->generalSettings) == 1){
			foreach($this->generalSettings as $s){

				if($this->session->get("theme")){
					define('THEME_NAME', $this->session->get("theme"));
				} else {
					define('THEME_NAME', $s->theme);
				}

				define('SITENAME', $s->site_name);
				define('THEME',PATH."themes/".THEME_NAME."/");
				define('DEFAULT_LANGUAGE', $s->default_language); 
				define('SITE_TITLE', $s->title);
				define('META_KEYWORDS', $s->meta_keywords);
				define('META_DESCRIPTION', $s->meta_description);

				define('CONTACT_NAME', $s->contact_name);
				define('CONTACT_EMAIL', $s->contact_email);
				define('WEBMASTER_EMAIL', $s->webmaster_email);
				define('NOREPLY_EMAIL', $s->noreply_email);
				define('PHONE1', $s->phone1);
				define('PHONE2', $s->phone2);
				define('LATITUDE',$s->latitude);
				define('LONGITUDE',$s->longitude);
				define('EMAIL_TYPE', $s->email_type);

				define('FB_PAGE', $s->facebook_page);
				define('TWITTER_PAGE', $s->twitter_page);
				define('LINKEDIN_PAGE', $s->linkedin_page);
				define('INSTAGRAM_PAGE', $s->instagram_page);
				define('INSTAGRAM_USER', $s->instagram_user_name);
				define('INSTAGRAM_ID', $s->instagram_user_id);
				define('FB_FAN_PAGE', $s->facebook_fanpage);
				define('YOUTUBE_URL', $s->youtube_url);
				define('ANALYTICS_CODE', $s->analytics_code);
				define('FB_APP_ID', $s->facebook_app_id);
				define('FB_APP_SECRET',$s->facebook_secret_key);
				define('TWITTER_API_KEY', $s->twitter_api_key);
				define('TWITTER_SECRET_KEY', $s->twitter_secret_key);
				define('GMAP_API_KEY', $s->gmap_api_key);
				define('ANDROID_PAGE', $s->android_page);
				define('IPHONE_PAGE', $s->iphone_page);

                                define('MIN_FUND_REQUEST', $s->min_fund_request);
				define('MAX_FUND_REQUEST', $s->max_fund_request);
				define('FLAT_SHIPPING_AMOUNT', $s->flat_shipping);
				define('MONTHLY_INSTALLMENT_LIMIT', $s->monthly_storecredit);
				define('TAX_PRECENTAGE_VALUE', $s->tax_percentage);
				define('CURRENCY_SYMBOL', $s->currency_symbol);  
				define('CURRENCY_CODE', $s->currency_code);
				define('COUNTRY_CODE', $s->country_code);
				define('SITE_MODE', $s->site_mode);
				define('REFERRAL_AMOUNT', $s->referral_amount);
				define('AUCTION_EXTEND_DAY',$s->auction_extend_day);
				define('AUCTION_ALERT_DAY',$s->auction_alert_day);
				define('PAY_LATER',$s->pay_later);
			}
		}
		else
		{
			echo "Problem in Settings"; exit;	
		}
		$this->emailSettings = $this->settings->getemailSettingsData();
		if(count($this->emailSettings) == 1){
			foreach($this->emailSettings as $e){
				/*send grid**/
				define('SMTP_PORT', $e->sendgrid_port);  	 	 
				define('SMTP_USERNAME', $e->sendgrid_username);
				define('SMTP_PASSWORD', $e->sendgrid_password);
				define('SMTP_HOST', $e->sendgrid_host);

				/*smtp**/
				define('PORT', $e->smtp_port);  	 	 
				define('USERNAME', $e->smtp_username);
				define('PASSWORD', $e->smtp_password);
				define('HOST', $e->smtp_host);

				/*mailchimp**/
				define('API', $e->api_key);  	 	 
				define('LISTID', $e->list_id);
				define('REPLAY_TO_MAIL', $e->replay_to_mail);
				define('FROM', $e->from_name);
			}
		}
		else
		{
			echo "Problem in E-mail Settings"; exit;	
		}
		$this->template = new View($this->template);
		if ($this->auto_render == TRUE){
			Event::add('system.post_controller', array($this, '_render'));
		}
		}
	}

        /**
        * Render the loaded template.
        */
	public function _render()
	{
		if ($this->auto_render == TRUE)
		{
			// Render the template when the class is destroyed
			$this->template->render(TRUE);
		}
	}

} // End Template_Controller
