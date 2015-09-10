<?php defined('SYSPATH') OR die('No direct access allowed.');
class Settings_Controller extends Website_Controller 
{
const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		 
		
	}

        /** GENERAL SETTINGS **/
	
	public function general_setting()
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		
		$this->general_settings = "1";
		if($_POST){
			$this->userPost = $this->input->post();
			$post = Validation::factory($_POST)
							->pre_filter('trim')
							->add_rules('name', 'required', 'chars[a-zA-Z0-9_ -.,@%\']')
							->add_rules('title', 'required','chars[a-zA-Z0-9_ -.,@%|\']')
							->add_rules('keywords', 'required', 'chars[a-zA-Z0-9_ -.,@%\']')
							->add_rules('description', 'required', 'chars[a-zA-Z0-9_ -.,@%\']')
							->add_rules('theme', 'required')
							->add_rules('language', 'required');		
			if($post->validate()){

				$status = $this->settings->update_general_settings(arr::to_object($this->userPost));
				if($status == 1){
					common::message(1, $this->Lang["GEN_SET_SUC"]);
					url::redirect(PATH."admin/general-settings.html");
				}
			}
			else{	
				$this->form_error = error::_error($post->errors());
			}
		}
		$Directory  = opendir(DOCROOT."themes"); $DL = array();
		while (false !== ($dirname = readdir($Directory))) {
			if(strlen($dirname) > 2){
				$DL[] = $dirname;
			}
		}
		sort($DL);
		$this->themes_list = $DL;
		$Directory  = opendir(DOCROOT."application/vendor/language/admin_language"); $DL = array();
		while (false !== ($dirname = readdir($Directory))) {
			if(strlen($dirname) > 2){
				$ext = pathinfo($dirname, PATHINFO_EXTENSION);
				if($ext=="php" || $ext==".php" || $ext=="PHP"){
						$DL[] = $dirname;
					}
			}
		}
		sort($DL);
		$this->language_List = str_replace(".php","",$DL);
		$this->template->title = $this->Lang["GEN_SETTING"];
		$this->template->content = new View("admin_settings/general_settings");
	}


	
	/** EMAIL SETTINGS **/
	
	public function email_settings()
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->email_settings = "1";
		if($_POST){
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('name', 'required', 'chars[a-zA-Z0-9_ -.,@%\']')
						->add_rules('contact_email', 'required','valid::email')
						->add_rules('webmaster_email', 'required', 'valid::email')
						->add_rules('noreply_email', 'required', 'valid::email')
						->add_rules('phone1', 'required', array($this, 'validphone'))
						->add_rules('latitude', 'required','chars[0-9.-]')
						->add_rules('longitude', 'required','chars[0-9.-]')
						->add_rules('phone2', 'required', array($this, 'validphone'));

			
			if($post->validate()){
				$status = $this->settings->email_settings(arr::to_object($this->userPost));
				if($status == 1){
				    common::message(1, $this->Lang['EMAIL_UPD']);
				    url::redirect(PATH."admin/email-settings.html");
				}
			}
			else{
				$this->form_error = error::_error($post->errors());	
			}
		}
		$this->template->title = $this->Lang['EMAIL_SETT'];
		$this->template->content = new View("admin_settings/email_settings");
	}
	
       /** SMTP MAILER SETTINGS **/
	
	public function smtp_mailer_settings()
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}

		$this->smtp_settings = "1";

		/** SENDGRID**/
	 	if(isset($_POST['sendgrid'])){ 

			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('smtp_host', 'required')
						->add_rules('smtp_port', 'required')
						->add_rules('smtp_username', 'required')
						->add_rules('smtp_password', 'required');

			
			if($post->validate()){
				$status = $this->settings->sendgrid_mailer_settings(arr::to_object($this->userPost));
				if($status == 1){
				    common::message(1, $this->Lang['SMTP_UPD1']);
				    url::redirect(PATH."admin/smtp-mailer-settings.html");
				}
			}
			else{
				$this->form_error = error::_error($post->errors());	
			}
		}

		/** SMTP **/

		if(isset($_POST['smtp'])){ 

			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('host', 'required')
						->add_rules('port', 'required')
						->add_rules('username', 'required')
						->add_rules('password', 'required');

			
			if($post->validate()){
				$status = $this->settings->smtp_mailer_settings(arr::to_object($this->userPost));
				if($status == 1){
				    common::message(1, $this->Lang['SMTP_UPD2']);
				    url::redirect(PATH."admin/smtp-mailer-settings.html");
				}
			}
			else{
				$this->form_error = error::_error($post->errors());	
			}
		}

		/** MAILCHIMP **/
		if(isset($_POST['mailchimp'])){ 

			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('api', 'required')
						->add_rules('listid', 'required')
						->add_rules('replay', 'required')
						->add_rules('from', 'required');

			
			if($post->validate()){
				$status = $this->settings->mailchimp_mailer_settings(arr::to_object($this->userPost));
				if($status == 1){
				    common::message(1, $this->Lang['SMTP_UPD3']);
				    url::redirect(PATH."admin/smtp-mailer-settings.html");
				}
			}
			else{
				$this->form_error = error::_error($post->errors());	
			}
		}
		$this->template->title = $this->Lang['SMTP_MAIL'];
		$this->template->content = new View("admin_settings/smtp_mailer_settings");
	}


        /** PAYMENT SETTINGS **/
	
	public function payment_setting()
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->payment_settings = "1";
		if($_POST){
			$this->userPost = $this->input->post();
			 
			$post = Validation::factory($_POST)                        
							->pre_filter('trim')
							->add_rules('minfund','required',array($this, 'check_min_fund'),array($this, 'check_minfund_val_lmi'),'chars[.0-9]')
							->add_rules('maxfund','required','chars[.0-9]')
							->add_rules('auction_extend_day','required','chars[.0-9]',array($this,'check_day'))
							->add_rules('auction_alert_day','required','chars[.0-9]',array($this,'check_day'))
							->add_rules('flat_shipping','required','chars[.0-9]')
							->add_rules('tax_percentage','required',array($this,'check_percentage'),'chars[.0-9]')
							->add_rules('country','required')
      					                ->add_rules('currency_symbol','required')
							->add_rules('currency_code','required','chars[A-Z]')
							->add_rules('paypal_payment_mode','required')
							->add_rules('Paypal_Account','required')
							->add_rules('Paypal_API_Password','required')
							->add_rules('Paypal_API_Signature','required')
							->add_rules('authorizenet_transaction_key','required')
							->add_rules('authorizenet_api_id','required')
							->add_rules('referral_amount','required','chars[.0-9]')
							->add_rules('monthly_storecredit','required')
							->add_rules('pay_later','required');
                                          				
			if($post->validate()){
				$status = $this->settings->update_payment_settings(arr::to_object($this->userPost));
				if($status == 1){
					common::message(1, $this->Lang["PAY_SET_SUC"]);
					url::redirect(PATH."admin/payment-settings.html");
				}
			}
			else{	
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->payment_settings_data = $this->settings->getGeneralSettingsData();
		$this->country_list = $this->settings->getcountrylist();
		if(count($this->payment_settings_data) == 0){
			common::message(-1, $this->Lang["PAY_SET_ERR"]);
			url::redirect(PATH."admin.html");
		}
		$this->countryname_list = $this->settings->get_country_list();
		$this->currency = $this->settings->get_currency();
		$this->currency_list = array("$","¥","€");
		//$this->currency_list = array("$","ƒ","¥","₡","₱","£","€","¢","Q","L","﷼","₪","лв","₩","₭","Ls","Lt","ден","₮","₦");


		$this->template->title = $this->Lang["PAYMENT_SETTING"];
		$this->template->content = new View("admin_settings/payment_settings");
	}
	
	
	/** SHIPPING ACCOUNT SETTINGS **/
	
	public function shipping_account_setting()
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        
		$this->shipping_settings = "1";
		if($_POST){
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('AccountCountryCode', 'required')
						->add_rules('AccountEntity', 'required')
						->add_rules('AccountNumber', 'required')
						->add_rules('AccountPin', 'required')
						->add_rules('UserName', 'required')
						->add_rules('Password', 'required');

			
			if($post->validate()){
				$status = $this->settings->shipping_settings(arr::to_object($this->userPost));
				if($status == 1){
				    common::message(1, $this->Lang['SHIPP_ACC_SETT_UPDA']);

				    url::redirect(PATH."admin/shipping-account-settings.html");
				}
			}
			else{
				$this->form_error = error::_error($post->errors());	
			}
		}
		$this->shipping_settings_data = $this->settings->get_shipping_settings();
		$this->template->title = $this->Lang['SHIPP_ACC_SETT'];
		$this->template->content = new View("admin_settings/shipping_settings");
	}
	
	/** COUNTRY BASED CURRENCY  SELECT**/
	
	public function countryS($country)
	{
			
			if($country == -1){
				$CountrySlist = $this->settings->get_currency_by_country($country);
		        $this->countryname_list = $this->settings->get_country_list();
			$list = '<tr>
                    <td style="width: 165px;"><label>country nam</label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><select name="country" onchange="return country_change(this.value);">
                    <option value="" selected="selected">Select Country</option>';
                    foreach($this->countryname_list as $country)
                    {
			$list .='<option value="'.$country->country_id.'">'.$country->country_name.'</option>';
				}
			$list .='</select></tr>';
			$list  .= '<tr><td style="width: 200px;"><label>Country Code </label><span>*</span></td><td><label>:</label></td><td>';
			$list .='<input type="text" name="country_code" value="First select country" readonly /></td></tr>';
			$list .= '<tr><td><label>Currency Symbol</label><span>*</span></td><td><label>:</label></td><td>';
			$list .='<input type="text" name="currency_symbol" value="First select country" readonly /></td></tr>';
			$list .= '<tr><td><label>Currency Code</label><span>*</span></td><td><label>:</label></td><td>';
			$list .='<input type="text" name="currency_code" value="First select country" readonly /></td></tr>';
			echo $list;
			exit;
		}
		else{
		        $CountrySlist = $this->settings->get_currency_by_country($country);
		        $this->countryname_list = $this->settings->get_country_list();
					if(count($CountrySlist) == 0){
						$list = '<tr >
                    <td style="width: 200px;"><label>country name</label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><select name="country" onchange="return country_change(this.value);">
                    <option value="">Select Country</option></select></tr>';
						$list  .= '<tr><td style="width: 200px;"><label>Country Code </label><span>*</span></td><td><label>:</label></td><td>';
						$list .='<input type="text" name="country_code" value="First select country" readonly /></td></tr>';
						$list .= '<tr><td><label>Currency Symbol</label></td><td><label>:</label><span>*</span></td><td>';
						$list .='<input type="text" name="currency_symbol" value="First select country" readonly /></td></tr>';
						$list .= '<tr><td><label>Currency Code</label></td><td><label>:</label><span>*</span></td><td>';
						$list .='<input type="text" name="currency_code" value="First select country" readonly /></td></tr>';
						echo $list;
							exit;
					}
					else {
						
							foreach($CountrySlist as $s) {	
								if($s->country_id != 0) {
									$list = '<tr >
                    <td style="width: 200px;"><label>Country Name</label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><select name="country" onchange="return country_change(this.value);">
                    <option value="" selected="selected">Select Country</option>';
                    foreach($this->countryname_list as $country){ 
						if($country->country_id== $s->country_id) 
						{
							$list .='<option value="'.$country->country_id .'"selected="selected" >'. $country->country_name.'</option>';
						} else {
							$list .='<option value="'.$country->country_id .'" >'. $country->country_name.'</option>';
							}
						} 
									$list .= '</select></tr>';
									$list .= '<tr><td style="width: 200px;"><label>Country Code </label><span>*</span></td><td><label>:</label></td><td>';
									$list .='<input type="text" name="country_code" value="'.$s->country_code.'" readonly /></td></tr>';
									$list .= '<tr><td><label>Currency Symbol </label><span>*</span></td>
											<td><label>:</label></td>';
									$list .='<td><input type="text" name="currency_symbol" value="'.$s->currency_symbol.'" readonly /></td></tr>';
									$list .= '<tr><td  style="width: 200px;"><label>Currency code </label><span>*</span></td>
											<td><label>:</label></td>';
									$list .='<td><input type="text" name="currency_code" value="'.$s->currency_code.'" readonly /></td></tr>';
								}
							}
							echo $list;
							exit;
					}
		}
	}
	
	 /** CHECK MINFUND LESS THEN MAXFUND **/
	
	public function check_min_fund()
	{
		if(($this->input->post("minfund"))<=$this->input->post("maxfund")){
			return 1;
		}
		return 0;
	}
	
	/* CHECK PERCENTAGE */
	public function check_percentage($value)
	{
		if($value<=100){
			return 1;
		}
		return 0;

	}

	/** AUCTION EXTEND AND ALERT DAYS  **/
	public function check_day($value)
	{
		if($value >= 2){ 
			return 1;
		}
		return 0;

	}
	public function module_setting()
	{ 
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}

		$this->module_settings = "1";
		if($_POST){ 
			$deal = $this->input->post('deal');
			$product = $this->input->post('product');
			$auction = $this->input->post('auction');
			$blog = $this->input->post('blog');
			$paypal = $this->input->post('paypal');
			$credit_card = $this->input->post('credit_card');
			$authorize = $this->input->post('authorize');
			$free_shipping = $this->input->post('free_shipping');
			$flat_shipping = $this->input->post('flat_shipping');
			$per_product = $this->input->post('per_product');
			$per_quantity = $this->input->post('per_quantity');
			$aramex = $this->input->post('aramex');
			$cash_on_delivery = $this->input->post('cash_on_delivery');
			$near_me_map = $this->input->post('near_me_map');
			$store_list = $this->input->post('store_list');
			$past_deal = $this->input->post('past_deal');
			$faq = $this->input->post('faq');
			$city = $this->input->post('city');
			$cms = $this->input->post('cms');
			$newsletter = $this->input->post('newsletter');
			$pay_later = $this->input->post('pay_later');
                        $interswitch = $this->input->post('interswitch');
			

			if($free_shipping == ""){ $free_shipping =0; }
			if($flat_shipping == ""){ $flat_shipping =0; }
			if($per_product == ""){ $per_product =0; }
			if($per_quantity == ""){ $per_quantity =0; }
			if($aramex == ""){ $aramex =0; }
				if(($free_shipping=="") && ($flat_shipping =="") && ($per_product =="") && ($per_quantity =="") && ($aramex =="")){
					common::message(-1, $this->Lang["SHIP_SET_ERR1"]);
					url::redirect(PATH."admin/module-settings.html");
				}
				
			if($paypal == ""){ $paypal =0; }
			if($credit_card == ""){ $credit_card =0; }
			if($authorize == ""){ $authorize =0; }
			if($cash_on_delivery == ""){ $cash_on_delivery =0; }
			if($pay_later == ""){ $pay_later =0; }
                        if($interswitch == ""){ $interswitch =0; }
				if(($paypal=="") && ($credit_card =="") && ($authorize =="") && ($cash_on_delivery =="") && ($pay_later == "")){
					common::message(-1, $this->Lang["PAY_SET_ERR1"]);
					url::redirect(PATH."admin/module-settings.html");
				}
				if(($paypal=="") && ($credit_card =="") && ($authorize =="") && ($pay_later == "")){
					common::message(-1, $this->Lang["PAY_SET_ERR2"]);
					url::redirect(PATH."admin/module-settings.html");
				}
				
			if($deal == ""){ $deal =0; }
			if($product == ""){ $product =0; }
			if($auction == ""){ $auction =0; }
			if($blog == ""){ $blog =0; }
			if($near_me_map == ""){ $near_me_map =0; }
			if($store_list == ""){ $store_list =0; }
			if($past_deal == ""){ $past_deal =0; }
			if($faq == ""){ $faq =0; }
			if($cms =="") { $cms =0; }
			if($newsletter =="") { $newsletter =0; }
			if($deal != "" || $product != "" || $auction != ""||$blog != "" || $store_list!= "" || $past_deal = "" || $faq || $cms || $newsletter){
				
			$status = $this->settings->update_module($deal,$product,$blog,$auction,$paypal,$credit_card,$authorize,$cash_on_delivery,$free_shipping,$flat_shipping,$per_product,$per_quantity,$aramex,$near_me_map,$store_list,$past_deal,$faq,$city,$cms,$newsletter,$pay_later,$interswitch);
			if($status==1){
				common::message(1,$this->Lang['MODULE_SUCC_UPTD']);
					url::redirect(PATH."admin/module-settings.html");
			}

			}
			else {
				common::message(-1,$this->Lang['SEL_MODULE']);
					url::redirect(PATH."admin/module-settings.html");
			}
		}
			
				
		$this->set_module = $this->settings->getmoduleSettingsData();
		$this->template->title = $this->Lang['MOD_SET'];
		$this->template->content = new View("admin_settings/module_settings");
		
	}

       /** SOCIAL MEDIA SETTINGS **/
	
	public function api_socialmedia()
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->socialmedia_settings = "1";
		if($_POST){
	   	$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('facebook_app_id', 'required', 'chars[a-zA-Z0-9]')
						->add_rules('facebook_secret_key', 'required', 'chars[a-zA-Z0-9_ -.,@%]')
						->add_rules('facebook', 'required', 'valid::url')
						->add_rules('fbfan', 'required', 'valid::url')
						->add_rules('twitter', 'required', 'valid::url')
						->add_rules('linkedin', 'required', 'valid::url')
						->add_rules('instagram', 'required', 'valid::url')
						->add_rules('youtube_url', 'required', 'valid::url')
						->add_rules('twitter_api_key', 'required')
						->add_rules('twitter_secret_key', 'required')
						->add_rules('gmapkey', 'required')
						->add_rules('instagram_user_name', 'required')
						->add_rules('instagram_user_id', 'required')
						->add_rules('android', 'valid::url')
						->add_rules('iphone', 'valid::url')
						->add_rules('analytics_code', 'required');
											

			if($post->validate()){

				$addCode = $this->input->raw("post",'analytics_code');
				$status = $this->settings->social_media(arr::to_object($this->userPost), $addCode);

				if($status == 1){
				    common::message(1, $this->Lang['SOC_MEDIA_PAG_UPD']);
				    url::redirect(PATH."admin/social-media-settings.html");
				}
			}
			else{
				$this->form_error = error::_error($post->errors());	
			}
		}
		$this->status = 0;
		$status1 = $this->settings->get_facebook_status($this->user_id);
		foreach ($status1 as $st){
		$this->status= $st->facebook_update;
		}
		$this->template->title = $this->Lang['SOC_MEDIA_PAG'];
		$this->template->content = new View("admin_settings/socialmedia_api_setting");
	}



        /** IMAGE SETTINGS **/
	
	public function image_settings($funname = "")
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->image_settings = "1";
		$this->viewName = $funname;
		if($_POST){
			if($_FILES["image"]["name"]){
				
				$_FILES = Validation::factory($_FILES)->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
				if ($_FILES->validate()){
					$filename = upload::save('image');
					$themeName = $this->input->post("theme");

					if(is_dir(DOCROOT."themes/".$themeName."/images") && $filename){

						$Image = Kohana::config("settings.image");
						$widthadjust  = $Image[$funname]["width"];
						$heightadjust  = $Image[$funname]["height"]; 
						$img_path = DOCROOT.'themes/'.$themeName.'/images/'.$funname.'.png';
		
						common::image($filename, $widthadjust, $heightadjust, $img_path);
						common::image($filename, PRODUCT_LIST_WIDTH, PRODUCT_LIST_HEIGHT, DOCROOT.'themes/'.$themeName.'/images/'.$funname.'_products_list.png');
						common::image($filename, PRODUCT_DETAIL_WIDTH, PRODUCT_DETAIL_HEIGHT, DOCROOT.'themes/'.$themeName.'/images/'.$funname.'_products_details.png');
						common::image($filename, DEAL_LIST_WIDTH, DEAL_LIST_HEIGHT, DOCROOT.'themes/'.$themeName.'/images/'.$funname.'_deals_list.png');
						common::image($filename, DEAL_DETAIL_WIDTH, DEAL_DETAIL_HEIGHT, DOCROOT.'themes/'.$themeName.'/images/'.$funname.'_deals_details.png');
						common::image($filename, AUCTION_LIST_WIDTH, AUCTION_LIST_HEIGHT, DOCROOT.'themes/'.$themeName.'/images/'.$funname.'_auctions_list.png');
						common::image($filename, AUCTION_DETAIL_WIDTH, AUCTION_DETAIL_HEIGHT, DOCROOT.'themes/'.$themeName.'/images/'.$funname.'_auctions_details.png');
						
						common::image($filename, STORE_LIST_WIDTH, STORE_LIST_HEIGHT, DOCROOT.'themes/'.$themeName.'/images/'.$funname.'_stores_list.png');
						common::image($filename, STORE_DETAIL_WIDTH, STORE_DETAIL_HEIGHT, DOCROOT.'themes/'.$themeName.'/images/'.$funname.'_stores_details.png');
						unlink($filename); 
						common::message(1, ucfirst($funname)." ".$this->Lang["COM_UPD_SUC"]);
						url::redirect(PATH."admin/".$funname."-settings.html");
					}
					else{	
						$this->form_error["theme"] = $this->Lang["NO_THEME_ERR"];
					}	
				}
				else{
					$this->form_error = error::_error($_FILES->errors());
				}     
			}
			else{
				common::message(1, ucfirst($funname)." ".$this->Lang["COM_UPD_SUC"]);
				url::redirect(PATH."admin/".$funname."-settings.html");
				
			}
		}
		$Directory  = opendir(DOCROOT."themes"); $DL = array();
		while (false !== ($dirname = readdir($Directory))) {
			if(strlen($dirname) > 2){
				$DL[] = $dirname;
			}
		}
		sort($DL);
		$this->themes_list = $DL;
		$this->template->title = ucfirst($funname)." ".$this->Lang["SETTINGS"];
		$this->template->content = new View("admin_settings/logo_image_settings");

	}

	/** IMAGE ZOOM SETTINGS   **/

	public function image_zoom_settings()
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->image_settings = "1";
		
		if($_POST){ 
			$this->userPost = $this->input->post();
			
			 
			$post = Validation::factory($_POST)                        
							->pre_filter('trim')
							->add_rules('logo_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('logo_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('favicon_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('favicon_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('category_width','required',array($this,'check_value'),'chars[0-9]')	
							->add_rules('category_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('deal_list_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('deal_list_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('deal_detail_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('deal_list_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('deal_detail_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('deal_detail_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('deal_thumb_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('deal_thumb_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('product_list_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('product_list_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('product_detail_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('product_list_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('product_detail_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('product_detail_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('product_thumb_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('product_thumb_height','required',array($this,'check_value'),'chars[0-9]')	
							->add_rules('auction_list_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('auction_list_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('auction_detail_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('auction_list_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('auction_detail_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('auction_detail_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('auction_thumb_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('auction_thumb_height','required',array($this,'check_value'),'chars[0-9]')		
							->add_rules('store_list_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('store_list_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('store_detail_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('store_detail_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('store_thumb_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('store_thumb_height','required',array($this,'check_value'),'chars[0-9]')	
							->add_rules('user_list_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('user_list_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('user_detail_width','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('user_detail_height','required',array($this,'check_value'),'chars[0-9]')
							->add_rules('banner_thumb_width','required',array($this,'check_value'),'chars[0-9]')
						    ->add_rules('banner_thumb_height','required',array($this,'check_value'),'chars[0-9]')
                            ->add_rules('map_list_width','required',array($this,'check_value'),'chars[0-9]') 		
					        ->add_rules('map_list_height','required',array($this,'check_value'),'chars[0-9]'); 		
                                          				
			if($post->validate()){
				$status = $this->settings->update_image_resize_settings(arr::to_object($this->userPost));
				if($status == 1){
					common::message(1, 'Image resize settings updated successfully.');
					url::redirect(PATH."admin/image-zoom-settings.html");
				}
			}
			else{	
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->image_settings_data = $this->settings->get_image_resize_data();
		$this->template->title = 'Image resize settings';
		$this->template->content = new View("admin_settings/image_zoom_settings");
		
	}
	
	/** ADD BANNER IMAGE **/
	public function add_banner_image()
	{
		if(!ADMIN_PRIVILEGES_BANNER_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->banner_settings = 1;
		if($_POST){ 
				$this->userPost = $this->input->post();
               
				$post = Validation::factory(array_merge($_POST,$_FILES))
							//->add_rules('position', 'required','chars[0-9]',array($this,'validposition')) 
							->add_rules('title', 'required')
							->add_rules('redirect_url','required', 'valid::url')
							->add_rules('image', 'upload::required','upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
								
		 	if($post->validate()){
				$status = $this->settings->add_banner_image($_POST['title'],$_POST['redirect_url'],arr::to_object($this->userPost));
				if($status>0){
					$filename = upload::save('image');
						$IMG_NAME =$status.".png";	
						common::image($filename, BANNER_WIDTH, BANNER_HEIGHT, DOCROOT.'images/banner_images/'.$IMG_NAME);
						unlink($filename);
						common::message(1, $this->Lang['BANN_ADD_SUCC']);
						url::redirect(PATH."admin/manage-banner-images.html");	
					}
					else{
						common::message(1,  $this->Lang['ERR_PLS_TRY_AG']);
						url::redirect(PATH."admin/add-banner-image.html");		
					}
				 		
			}
			else{	
					$this->form_error = error::_error($post->errors());	
								
				}
				
		}
		$this->template->title = $this->Lang['ADD_BANN_IMG'];
		$this->template->content = new View("admin_settings/add_banner_image");
	}

	/** MANAGE BANNER IMAGES  **/

	public function manage_banner_images($page = "")
	{
		if(!ADMIN_PRIVILEGES_BANNER)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->banner_settings = 1;
		$count = $this->settings->get_banner_image_count();
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-banner-images.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->bannerDataList = $this->settings->get_banner_image_list($this->pagination->sql_offset, $this->pagination->items_per_page);

		$this->template->title =$this->Lang['MANAGE_BANN'];
		$this->template->content = new View("admin_settings/manage_banner_images");
	}

	/** EDIT BANNER IMAGE   **/

	public function edit_banner_image($banner_id = "")
	{ 
		if(!ADMIN_PRIVILEGES_BANNER_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$banner_id = base64_decode($banner_id);
		$this->banner_settings = 1;
		if($_POST){ 
				$this->userPost = $this->input->post();
				$post = Validation::factory(array_merge($_POST,$_FILES))
							->add_rules('title', 'required')
							->add_rules('redirect_url','required', 'valid::url')
							->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
		 	if($post->validate()){
					$status = $this->settings->edit_banner_image($banner_id,$_POST['title'],$_POST['redirect_url'],arr::to_object($this->userPost));
				if($status>0){
					if($_FILES['image']['name']!=''){

							$filename = upload::save('image');
							$IMG_NAME =$banner_id.".png";	
							common::image($filename, BANNER_WIDTH, BANNER_HEIGHT, DOCROOT.'images/banner_images/'.$IMG_NAME);
							unlink($filename);
					}
						common::message(1, $this->Lang['BANN_UP_SUCC']);
						$lastsession = $this->session->get("lasturl");
		                                if($lastsession){
		                                url::redirect(PATH.$lastsession);
		                                } else {
		                                url::redirect(PATH."admin/manage-banner-images.html");
		                                }
					}
					else{
						common::message(1, $this->Lang['ERR_PLS_TRY_AG']);
						$lastsession = $this->session->get("lasturl");
		                                if($lastsession){
		                                url::redirect(PATH.$lastsession);
		                                } else {
		                                url::redirect(PATH."admin/manage-banner-images.html");	
		                                }	
					}
				 		
			}
			else{	
					$this->form_error = error::_error($post->errors());				
				}
		}
		$this->bannerData = $this->settings->getbannerData($banner_id);
		$this->template->title =$this->Lang['EDIT_BANN'];
		$this->template->content = new View("admin_settings/edit_banner_image");
	}
		
	/** BLOCK AND UNBLOCK BANNER IMAGE  **/
	
	public function block_unblock_banner_image($type = "", $banner_id = "")
	{
		if(!ADMIN_PRIVILEGES_BANNER_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->settings->blockunblock_banner_image($type, base64_decode($banner_id));

		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang['BANN_IMG_UN_BLOCK_SUCC']);
			}
			else{
				common::message(1, $this->Lang['BANN_IMG_BLOCK_SUCC']);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-banner-images.html");
                }
	}
	

	/** DELETE BANNER IMAGE **/
	
	public function delete_banner_image($banner_id = "")
	{
		if(!ADMIN_PRIVILEGES_BANNER_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$banner_id = base64_decode($banner_id);
		if($banner_id){
			$status = $this->settings->delete_banner_image($banner_id);
			if($status == 1){
				$filename = DOCROOT.'images/banner_images/'.$banner_id.'.png';
				unlink($filename);
				common::message(1, $this->Lang['BANN_IMG_DELE_SUCC']);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-banner-images.html");
                }
	}

	/** BANNER POSTION CHANGE **/

	public function banner_rating($banner_id = "", $rate = "")
	{
		$status = $this->settings->update_banner_rating($banner_id,$rate);
		echo $status;
		exit;
	}

	/** CHECK VALID PHONE OR NOT **/
	
	public function validphone($phone = "")
	{
		if(valid::phone($phone,array(7,10,11,12,13)) == TRUE){
			return 1;
		}
		return 0;
	}
	/** CHECK VALID POSITION FOR BANNER IMAGE **/
	
	public function validposition($position = "")
	{
		$status = $this->settings->check_position($position);
		return $status;
	}
	
	/** CHECK MINIMUM FUND LIMIT **/
	public function check_minfund_val_lmi()
	{
		if(($this->input->post("minfund"))!= '0'){
			return 1;
		}		
		return 0;
	}
	/** CHECK VALUE */
	public function check_value($value)
	{
		if($value!=0) return 1;
		return 0;
	}
			  /** UPDATE AUTO POST  DEAL IN TO FACEBOOK**/

	public function sengrid_emailstatus()
	{  
		$value1 = $this->input->get("value1");

		$status = $this->settings->email_status($value1);

		exit;
	}
	/* SENDGRID EMAIL STATUS */
		public function sengrid_emailstatus1()
	{  
		$value1 = $this->input->get("value1");

		$status = $this->settings->email_status1($value1);

		exit;
	}
	/*SENDGRID EMAIL STATUS */
	public function sengrid_emailstatus2()
	{  
		$value1 = $this->input->get("value1");

		$status = $this->settings->email_status2($value1);

		exit;
	}


}	
