<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_Controller extends website_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
                
                $actual_link = $_SERVER['HTTP_HOST'];                
                $serverurl= $_SERVER['HTTP_HOST']; 
                if( $actual_link != $serverurl)
                {
                echo  DEFAULT_WEBSITE_MESSAGE;
                exit;
                }
                else
                {
                
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 2 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html" ){
			url::redirect(PATH);
		}      
		if($this->user_type==3 || $this->user_type==8){
			$this->session->destroy();
			url::redirect(PATH);
		}
		        
		$this->admin = new Admin_Model();
		$this->users = new Admin_users_Model();
		}
	}

	/** ADMIN HOME **/

	public function index()
	{

		$this->admin_dashboard_data = $this->admin->get_admin_dashboard_data();
		$this->balance = $this->admin->get_admin_balance1();
		$this->user_list = $this->admin->get_user_list();
		$this->transaction_list = $this->admin->get_transaction_list();
		$this->deals_transaction_list = $this->admin->get_transaction_chart_list();
		$this->template->content = new View("admin/home");
		$this->template->title = $this->Lang["ADMIN_DASHBOARD"];
	}

	/** ADMINISTRATOR LOGIN **/

	public function login()
	{
		if($this->user_id && ($this->user_type == 1 || $this->user_type == 2 || $this->user_type == 7)){

			url::redirect(PATH."admin.html");
		}

		if($_POST){
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			if($email){
				$status = $this->admin->admin_login($email, $password);
				if($status == 10){
				    common::message(1, $this->Lang["LOGIN_SUCCESS"] );
					url::redirect(PATH."admin.html");
				}
				elseif($status == 11){
					common::message(1, $this->Lang["LOGIN_SUCCESS"] );
					url::redirect(PATH."merchant.html");
				}
				elseif($status == 9){
					$this->error_login = $this->Lang["ACCOUNT_BLOCKED"];
				}
				elseif($status == 8){
					$this->error_login = $this->Lang["EMAIL_NOT_EXIST"];
				}
				elseif($status == 0){
					$this->postemail = $email;
					$this->error_login = $this->Lang["PASSWORD_NOT_MATCH"];
				}
				else{
				    common::message(-1,$this->Lang["CANT_LOGIN"]);
					url::redirect(PATH);
				}
			}
			else{
				$this->error_login = $this->Lang["EMAIL_REQUIRED"];

			    }

 		}
		$this->template->content = new View("admin/login");
		$this->template->title = $this->Lang["LOGIN_TITLE"];
	}

	/** ADD COUNTRY **/

	public function add_country()
	{
		if(!ADMIN_PRIVILEGES_COUNTRY_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->country = "1";

		if($_POST){
			$this->userPost = $this->input->post();
		$post = Validation::factory($_POST)
					->pre_filter('trim')
					->add_rules('country', 'required','chars[a-zA-Z _-]')
					->add_rules('country_code','required','chars[A-Z]')
					->add_rules('currency_symbol','required')
					->add_rules('currency_code','required','chars[A-Z]');
			if($post->validate()){
				$status = $this->admin->add_country(arr::to_object($this->userPost));
				if($status == 1){
					common::message(1, $this->Lang["COUNTRY_SUCESSS"]);
					url::redirect(PATH."admin/manage-country.html");
				}
				$this->form_error["country"] = $this->Lang["COUNTRY_ERR"];
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->template->title = $this->Lang["ADD_COUNTRY"];
		$this->template->content = new View("admin/add_country");
	}

	/** MANAGE COUNTRY **/

	public function manage_country()
	{
		if(!ADMIN_PRIVILEGES_COUNTRY)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->country = "1";
		$this->countryDataList = $this->admin->getcountryDataList();
		$this->template->title = $this->Lang["MANAGE_COUNTRY"];
		$this->template->content = new View("admin/manage_country");
	}

	/** EDIT COUNTRY **/

	public function edit_country($country = "")
	{
		if(!ADMIN_PRIVILEGES_COUNTRY_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->country = "1";

		if($_POST){

		$this->userPost = $this->input->post();
		$post = Validation::factory($_POST)
						->pre_filter('trim')
						->add_rules('country','required','chars[a-zA-Z _-]')
						->add_rules('country_code','required','chars[A-Z]')
						->add_rules('currency_symbol','required')
						->add_rules('currency_code','required','chars[A-Z]');
			if($post->validate()){
				$status = $this->admin->edit_country(arr::to_object($this->userPost),$country);
				if($status == 1){
					common::message(1, $this->Lang["COUNTRY_EDIT_SUC"]);
					$lastsession = $this->session->get("lasturl");
					 if($lastsession){
                                        url::redirect(PATH.$lastsession);
                                        } else {
                                        url::redirect(PATH."admin/manage-country.html");
                                        }
				}
				else{
					$this->form_error["country"] = $this->Lang["COUNTRY_EXISTS"];
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->countryData = $this->admin->getcountryData($country);
		if(count($this->countryData) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			$lastsession = $this->session->get("lasturl");
			if($lastsession){
                        url::redirect(PATH.$lastsession);
                        } else {
                        url::redirect(PATH."admin/manage-country.html");
                        }
		}
		$this->template->title = $this->Lang["EDIT_COUNTRY"];
		$this->template->content = new View("admin/edit_country");
	}

	/** DELETE COUNTRY **/

	public function delete_country($country = "")
	{
		if(!ADMIN_PRIVILEGES_COUNTRY_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($country){
			$status = $this->admin->deleteCountry($country);
			if($status == 1){
				common::message(1, $this->Lang["COUNTRY_DEL_SUC"]);
			}
			elseif($status==-1){
				common::message(-1, $this->Lang["SORRY_YOU_CANT"]);
				}else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-country.html");
                }
	}

	/** BLOCK UNBLOCK COUNTRY **/

	public function block_country($type = "", $country = "")
	{
		if(!ADMIN_PRIVILEGES_COUNTRY_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->admin->blockunblockcountry($type, $country);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["COUNTRY_UNBLOCK_SUC"]);
			}
			else{
				common::message(1, $this->Lang["COUNTRY_BLOCK_SUC"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-country.html");
                }
	}



	/** ADD CITY  **/

	public function add_city()
	{
		if(!ADMIN_PRIVILEGES_CITY_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->city = "1";
		if($_POST){
			$this->userPost = $this->input->post();
			$post = Validation::factory($_POST)
							->pre_filter('trim')
							->add_rules('country', 'required')
							->add_rules('city', 'required','chars[a-zA-Z _-]')
							->add_rules('latitude', 'required','chars[0-9.-]')
							->add_rules('longtitude', 'required','chars[0-9.-]');
			if($post->validate()){

				$country = $this->input->post("country");
				$city = $this->input->post("city");
				$status = $this->admin->add_city($country,$city,arr::to_object($this->userPost));
				if($status== 1){
					common::message(1, $this->Lang["CITY_ADD_SUC"]);
					url::redirect(PATH."admin/manage-city.html");
				}
				$this->form_error["city"] = $this->Lang["CITY_ERR"];
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}

		$this->country_list = $this->admin->get_country_list();
		$this->template->title = $this->Lang["ADD_CITY"];
		$this->template->content = new View("admin/add_city");
	}

	/** MANAGE CITY **/

	public function manage_city()
	{
		if(!ADMIN_PRIVILEGES_CITY)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->city = "1";
		if($_POST)
		{
		$city = $this->input->post("default_city");
		$status = $this->admin->default_city($city);
			if($status == 1){
			common::message(1,$this->Lang["DE_CI_UP"]);
			url::redirect(PATH."admin/manage-city.html");
			}
		}
		$this->cityDataList = $this->admin->get_all_City_List();
		$this->template->title = $this->Lang["MANAGE_CITY"];
		$this->template->content = new View("admin/manage_city");
	}

	/** EDIT CITY **/

	public function edit_city($country = "", $city = "")
	{
		if(!ADMIN_PRIVILEGES_CITY_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->city = "1";
		if($_POST){
			$post = Validation::factory($_POST)
							->pre_filter('trim')
							->add_rules('city', 'required', 'chars[a-zA-Z _-]')
							->add_rules('country', 'required')
							->add_rules('latitude', 'required','chars[0-9.-]')
						    ->add_rules('longtitude', 'required','chars[0-9.-]');

			if($post->validate()){

				$status = $this->admin->edit_city($country, $city, $this->input->post());

				if($status == 1){

					common::message(1, $this->Lang["CITY_EDIT_SUC"]);
					$lastsession = $this->session->get("lasturl");					
					if($lastsession){
                                        url::redirect(PATH.$lastsession);
                                        } else {
                                        url::redirect(PATH."admin/manage-city.html");
                                        }
				}
				else{
					$this->form_error["city"] = $this->Lang["CITY_EXISTS"];
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->country_list = $this->admin->get_country_list();
		$this->cityData = $this->admin->getCityData($country,$city);
		if(count($this->cityData) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		                        $lastsession = $this->session->get("lasturl");					
					if($lastsession){
                                        url::redirect(PATH.$lastsession);
                                        } else {
                                        url::redirect(PATH."admin/manage-city.html");
                                        }
		}
		$this->template->title = $this->Lang["EDIT_CITY"];
		$this->template->content = new View("admin/edit_city");
	}

	/** DELETE CITY **/

	public function delete_city($country = "", $city = "")
	{
		if(!ADMIN_PRIVILEGES_CITY_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($country && $city){
			$status = $this->admin->deleteCity($country,$city);
			if($status == 1){
				common::message(1, $this->Lang["CITY_DEL_SUC"]);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		$lastsession = $this->session->get("lasturl");					
					if($lastsession){
                                        url::redirect(PATH.$lastsession);
                                        } else {
                                        url::redirect(PATH."admin/manage-city.html");
                                        }
	}

	/** BLOCK OR UNBLOCK CITY **/

	public function block_city($type = "", $country = "", $city = "")
	{
		if(!ADMIN_PRIVILEGES_CITY_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->admin->blockunblockcity($type,$country, $city);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["CITY_UNBLOCK_SUC"]);
			}
			else{
				common::message(1, $this->Lang["CITY_BLOCK_SUC"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");					
					if($lastsession){
                                        url::redirect(PATH.$lastsession);
                                        } else {
                                        url::redirect(PATH."admin/manage-city.html");
                                        }
	}

	/** ADD CATEGORY  **/

	public function add_category()
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->category = "1";
		if($_POST){
			$this->userPost = $this->input->post();
			$post = Validation::factory(array_merge($_POST,$_FILES))->pre_filter('trim')
						->add_rules('category', 'required', 'chars[a-zA-Z0-9 _&-]')
						->add_rules('list_icon', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
			if($post->validate()){
				if( isset($_POST['deal']) || isset($_POST['product']) || isset($_POST['auction']) ) { // check the type
						$category = $this->input->post('category');
						$cat_status = $this->input->post('status');
						$deal = isset($_POST['deal'])? 1 : 0;
						$product = isset($_POST['product'])? 1 : 0;
						$auction = isset($_POST['auction'])? 1 : 0;
					$status = $this->admin->add_category($category,$cat_status,$deal,$product,$auction);
						if($status > 0){
							
							$listing_filename = upload::save('list_icon');
							if($listing_filename && $status){
								common::createthumb($listing_filename, DOCROOT.'images/category/icon/'.url::title($category).'.png',200, 280);
								//common::createthumb($listing_filename, DOCROOT.'images/category/icon/'.url::title($category).'_home.png',197, 361);
								common::createthumb($listing_filename, DOCROOT.'images/category/icon/'.url::title($category).'_home.png',200, 280);

							}
							common::message(1, $this->Lang["CAT_ADD_SUC"]);
							url::redirect(PATH."admin/manage-category.html");
						}
						$this->form_error["category"] = $this->Lang["CATEGORY_EXISTS"];
				}else{
					$this->form_error["type_error"] = $this->Lang['PLS_SE_TYPE'];
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->template->title = $this->Lang["ADD_CATEGORY"];
		$this->template->content = new View("admin/add_category");
	}

	/** EDIT CATEGORY **/

	public function edit_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->category = "1";
		if($_POST){
			$post = Validation::factory(array_merge($_POST,$_FILES))->pre_filter('trim')
						->add_rules('category', 'required','chars[a-zA-Z0-9 _&-]')
						->add_rules('list_icon', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');

			if($post->validate()){
				if( isset($_POST['deal']) || isset($_POST['product']) || isset($_POST['auction']) ) {
					$category = $this->input->post("category");
	 				$cat_status = $this->input->post("status");
					$deal = isset($_POST['deal'])? 1 : 0;
					$product = isset($_POST['product'])? 1 : 0;
					$auction = isset($_POST['auction'])? 1 : 0;
					$type=1;
					$status = $this->admin->edit_category($category, $cat_status, $cat_id, $cat_url,$type,$deal,$product,$auction);
						if($status == 1){
							$listing_filename = upload::save('list_icon');
							$Cat_img_URL = DOCROOT."images/category/icon/".url::title($cat_url).".png";  echo "<br>";
							$cat_image_rename = DOCROOT."images/category/icon/".url::title($category).".png";
								if(file_exists($Cat_img_URL)){
									rename($Cat_img_URL,$cat_image_rename);
								}
								if($listing_filename && $cat_id){
									common::createthumb($listing_filename, DOCROOT.'images/category/icon/'.url::title($category).'.png',200, 280);
									//common::createthumb($listing_filename, DOCROOT.'images/category/icon/'.url::title($category).'_home.png',197, 361);
									common::createthumb($listing_filename, DOCROOT.'images/category/icon/'.url::title($category).'_home.png',200, 280);
							         //$source_img = $destination_img =  DOCROOT.'images/category/icon/'.url::title($category).'_home.png';
							        /// common::compress($source_img, $destination_img, 90);
									unlink($listing_filename);
								}
							common::message(1, $this->Lang["CAT_EDIT_SUC"]);
							url::redirect(PATH."admin/manage-category.html");
						}
						else{
							$this->form_error["category"] = $this->Lang["CATEGORY_EXISTS"];
						}
				}else{
					$this->form_error["type_error"] = 'Please select any one type';	
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->category_data = $this->admin->get_category_data($cat_id, $cat_url);
		if(count($this->category_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-category.html");
		}
		$this->template->title = $this->Lang["EDIT_CATEGORY"];
		$this->template->content = new View("admin/edit_category");
	}

	/** MANAGE CATEGORY **/

	public function manage_category()
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->category = "1";
		$this->category_list = $this->admin->get_main_category_list();
		$this->sub_category_list = $this->admin->get_sub_category_list();
		$this->template->title = $this->Lang["MANAGE_TOP_CAT"];
		$this->template->content = new View("admin/manage_category");

	}

	/** DELETE CATEGORY **/

	public function delete_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($cat_id && $cat_url){
			$status = $this->admin->deleteCategory($cat_id, $cat_url);
			if($status == 1){

				$imgSRC = "images/category/".$cat_url.".png";
				$imgSRC_list = "images/category/".$cat_id.".png";
				if(file_exists(DOCROOT.$imgSRC)){
					unlink(DOCROOT.$imgSRC);
					unlink(DOCROOT.$imgSRC_list);
				}
				common::message(1, $this->Lang["CAT_DEL_SUC"]);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		url::redirect(PATH."admin/manage-category.html");
	}

	/** BLOCK OR UNBLOCK CATEGORY **/

	public function block_category($type = "", $cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->admin->blockunblockcategory($type, $cat_id, $cat_url);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["CAT_UNBLOCK_SUC"]);
			}
			else{
				common::message(1, $this->Lang["CAT_BLOCK_SUC"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		url::redirect(PATH."admin/manage-category.html");
	}

	/** ADD SUB CATEGORY **/

	public function add_sub_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->category = "1";
		if($_POST){
			$post = Validation::factory(array_merge($_POST,$_FILES))->pre_filter('trim')
						->add_rules('category', 'required','chars[a-zA-Z0-9 _&-]');


			if($post->validate()){
				$category = $this->input->post("category");
 				$cat_status = $this->input->post("status");
 				$cat_type = "2";
 				$type = "1";
				$status = $this->admin->add_sub_category($category, $cat_status, $cat_id,$cat_type,$type);
				if($status > 0){

					common::message(1, $this->Lang["MAIN_CAT_ADD_SUC"]);
					url::redirect(PATH."admin/manage-category.html");
				}
				else{
					$this->form_error["category"] = $this->Lang["CATEGORY_EXISTS"];
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->category_data = $this->admin->get_category_data($cat_id, $cat_url);
		if(count($this->category_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-category.html");
		}
		$this->main_cat = $this->Lang["TOP_CATEGORY_NAME"];
		$this->sub_cat= $this->Lang["MAIN_CAT_NAME"];
		$this->template->title = $this->Lang["ADD_MAIN_CAT"];
		$this->template->content = new View("admin/add_sub_category");
	}

	/** MANAGE SUB CATEGORY **/

	public function manage_sub_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->category = "1";
		$this->category_list = $this->admin->get_sub_category_list1($cat_id);
		$this->sub_category_list = $this->admin->get_sec_sub_category_list();
		$this->template->title = $this->Lang["MANAGE_MAIN_CAT"];
		$this->template->content = new View("admin/manage_sub_category");

	}

	/** EDIT SUB CATEGORY **/

	public function edit_sub_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $status_main = $this->admin->get_category($cat_id);
	        $main_cat_id = $status_main->current()->main_category_id;
		$this->category = "1";
		if($_POST){
			$post = Validation::factory(array_merge($_POST,$_FILES))->pre_filter('trim')
						->add_rules('category', 'required','chars[a-zA-Z0-9 _&-]');
			if($post->validate()){
				$category = $this->input->post("category");
 				$cat_status = $this->input->post("status");
 				$type=2;
				$status = $this->admin->edit_category($category, $cat_status, $cat_id, $cat_url,$type);
				if($status == 1){

					common::message(1, $this->Lang["MAIN_CAT_EDIT_SUC"]);
					url::redirect(PATH."admin/manage-sub-category/$main_cat_id/$cat_id/$cat_url.html");
				}
				else{
					$this->form_error["category"] = $this->Lang["CATEGORY_EXISTS"];
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$cat_type = "2";
		$this->category_data = $this->admin->get_sub_category_data($cat_id, $cat_url,$cat_type);
		if(count($this->category_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-sub-category/$main_cat_id/$cat_id/$cat_url.html");
		}
		$this->template->title = $this->Lang["EDIT_MAIN_CAT"];
		$this->template->content = new View("admin/edit_sub_category");
	}

	/** BLOCK OR UNBLOCK SUB CATEGORY **/

	public function block_sub_category($type = "",$main_cat_id = "", $cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->admin->blockunblocksubcategory($type, $main_cat_id, $cat_id, $cat_url);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["CAT_UNBLOCK_SUC2"]);
			}
			else{
				common::message(1, $this->Lang["CAT_BLOCK_SUC2"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		url::redirect(PATH."admin/manage-sub-category/$main_cat_id/$cat_id/$cat_url.html");
	}


	/** ADD 2 SUB CATEGORY **/

	public function add_sec_sub_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}

	        $type = "2";
	        $main_status = $this->admin->get_sub_category($cat_id,$type);
	        $main_category_id = $main_status->current()->category_id;
	        $main_category_url = $main_status->current()->category_url;
		$this->category = "1";
		if($_POST){

			$post = Validation::factory(array_merge($_POST,$_FILES))->pre_filter('trim')
				->add_rules('category', 'required','chars[a-zA-Z0-9 _&-]');

			if($post->validate()){
				$category = $this->input->post("category");
 				$cat_status = $this->input->post("status");
 				$cat_type = 3;
 				$type = "2";
				$status = $this->admin->add_sub_category($category, $cat_status, $cat_id,$cat_type,$type);
				if($status > 0){

					common::message(1, $this->Lang["SUB_CAT_ADD_SUC"]);
					url::redirect(PATH."admin/manage-sub-category/".$main_category_id."/".$main_category_url.".html");
				}
				else{
					$this->form_error["category"] = $this->Lang["CATEGORY_EXISTS"];
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->category_data = $this->admin->get_category_data($cat_id, $cat_url);
		if(count($this->category_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-sub-category/".$main_category_id."/".$main_category_url.".html");
		}
		$this->main_cat = $this->Lang["MAIN_CAT_NAME"];
		$this->sub_cat= $this->Lang["SUB_CAT_NAME"];
		$this->template->title = $this->Lang["ADD_SUB_CAT"];
		$this->template->content = new View("admin/add_sub_category");
	}

	/** MANAGE SUB CATEGORY **/

	public function manage_sec_sub_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->category = "1";
		$type = "2";
		$main_status = $this->admin->get_mail_category($cat_id,$type);
	        $this->main_category_id = $main_status->current()->category_id;
	        $this->main_category_url = $main_status->current()->category_url;
		$this->category_list = $this->admin->get_sub_category_list2($cat_id);
		$this->sub_category_list = $this->admin->get_third_sub_category_list();
		$this->template->title = $this->Lang["MANAGE_SUB_CAT"];
		$this->template->content = new View("admin/manage_sec_sub_category");

	}

	/** EDIT SUB CATEGORY **/

	public function edit_sec_sub_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $type = "3";
	        $main_status = $this->admin->get_sub_category($cat_id,$type);
	        $main_category_id = $main_status->current()->category_id;
	        $main_category_url = $main_status->current()->category_url;
		$this->category = "1";
		if($_POST){
			$post = Validation::factory(array_merge($_POST,$_FILES))->pre_filter('trim')
						->add_rules('category', 'required','chars[a-zA-Z0-9 _&-]');


			if($post->validate()){
				$category = $this->input->post("category");
 				$cat_status = $this->input->post("status");
 				$type=3;
				$status = $this->admin->edit_category($category, $cat_status, $cat_id, $cat_url,$type);
				if($status == 1){

					common::message(1, $this->Lang["SUB_CAT_EDIT_SUC"]);
					url::redirect(PATH."admin/manage-sec-sub-category/".$main_category_id."/".$main_category_url.".html");
				}
				else{
					$this->form_error["category"] = $this->Lang["CATEGORY_EXISTS"];
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$cat_type = "3";
		$this->category_data = $this->admin->get_sub_category_data($cat_id, $cat_url,$cat_type);
		if(count($this->category_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-sec-sub-category/".$main_category_id."/".$main_category_url.".html");
		}
		$this->template->title = $this->Lang["EDIT_SUB_CAT"];
		$this->template->content = new View("admin/edit_sub_category");
	}

	/** BLOCK OR UNBLOCK SUB CATEGORY **/

	public function block_sec_sub_category($type = "",$main_cat_id = "", $cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $main_status = $this->admin->get_category($main_cat_id);
	        $main_category_id = $main_status->current()->category_id;
	        $main_category_url = $main_status->current()->category_url;
		$status = $this->admin->blockunblocksecsubcategory($type, $main_cat_id, $cat_id, $cat_url);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["CAT_UNBLOCK_SUC1"]);
			}
			else{
				common::message(1, $this->Lang["CAT_BLOCK_SUC1"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		url::redirect(PATH."admin/manage-sec-sub-category/".$main_category_id."/".$main_category_url.".html");
	}

        public function sec_sub_delete_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $type = "3";
	        $main_status = $this->admin->get_sub_category($cat_id,$type);
	        $main_category_id = $main_status->current()->category_id;
	        $main_category_url = $main_status->current()->category_url;
		if($cat_id && $cat_url){
			$status = $this->admin->deleteCategory($cat_id, $cat_url);
			if($status == 1){

				common::message(1, $this->Lang["CAT_DEL_SUC"]);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		url::redirect(PATH."admin/manage-sec-sub-category/".$main_category_id."/".$main_category_url.".html");
	}


		/** ADD 3 SUB CATEGORY **/

	public function add_third_sub_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}

	        $type = "3";
	        $main_status = $this->admin->get_mail_category($cat_id, $type);
	        $main_category_id = $main_status->current()->category_id;
	        $main_category_url = $main_status->current()->category_url;
	         $sub_status = $this->admin->get_sub_category_list1($main_category_id);
	        $sub_category_id = $sub_status->current()->category_id;
	        $sub_category_url = $sub_status->current()->category_url;
		$this->category = "1";
		if($_POST){

			$post = Validation::factory(array_merge($_POST,$_FILES))->pre_filter('trim')
				->add_rules('category', 'required','chars[a-zA-Z0-9 _&-]');

			if($post->validate()){
				$category = $this->input->post("category");
 				$cat_status = $this->input->post("status");
 				$cat_type = "4";
 				$type = "3";
				$status = $this->admin->add_sub_category($category, $cat_status, $cat_id,$cat_type,$type);
				if($status > 0){

					common::message(1, $this->Lang["SEC_SUB_CAT_ADD_SUC"]);
					url::redirect(PATH."admin/manage-sec-sub-category/".$sub_category_id."/".$sub_category_url.".html");
				}
				else{
					$this->form_error["category"] = $this->Lang["CATEGORY_EXISTS"];
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->category_data = $this->admin->get_category_data($cat_id, $cat_url);
		if(count($this->category_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-sec-sub-category/".$sub_category_id."/".$sub_category_url.".html");
		}
		$this->main_cat = $this->Lang["SUB_CAT_NAME"];
		$this->sub_cat= $this->Lang["SUB_SEC_CAT_NAME"];
		$this->template->title = $this->Lang["ADD_SEC_SUB_CAT"];
		$this->template->content = new View("admin/add_sub_category");
	}

	/** MANAGE SUB CATEGORY **/

	public function manage_third_sub_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->category = "1";
		$type = "3";

		$main_status = $this->admin->get_mail_category($cat_id,$type);
	        $this->main_category_id = $main_status->current()->category_id;
	        $this->main_category_url = $main_status->current()->category_url;

	        $sub_status = $this->admin->get_sub_category_list11($this->main_category_id,$cat_id,$cat_url);
	        $this->sub_category_id = $sub_status->current()->category_id;
	        $this->sub_category_url = $sub_status->current()->category_url;
	        //print_r($cat_url); exit;

		$this->category_list = $this->admin->get_sub_category_list3($cat_id);
		$this->template->title = $this->Lang["MANAGE_SEC_SUB_CAT"];
		$this->template->content = new View("admin/manage_third_sub_category");

	}

	/** EDIT SUB CATEGORY **/

	public function edit_third_sub_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $type = "4";
	        $main_status = $this->admin->get_sub_category($cat_id,$type);
	        $main_category_id = $main_status->current()->category_id;
	        $main_category_url = $main_status->current()->category_url;
		$this->category = "1";
		if($_POST){
			$post = Validation::factory(array_merge($_POST,$_FILES))->pre_filter('trim')

						->add_rules('category', 'required','chars[a-zA-Z0-9 _&-]');


			if($post->validate()){
				$category = $this->input->post("category");
 				$cat_status = $this->input->post("status");
 				$type=4;
				$status = $this->admin->edit_category($category, $cat_status, $cat_id, $cat_url,$type);
				if($status == 1){

					common::message(1, $this->Lang["SEC_SUB_CAT_EDIT_SUC"]);
					url::redirect(PATH."admin/manage-third-sub-category/".$main_category_id."/".$main_category_url.".html");
				}
				else{
					$this->form_error["category"] = $this->Lang["CATEGORY_EXISTS"];
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$cat_type = "4";
		$this->category_data = $this->admin->get_sub_category_data($cat_id, $cat_url,$cat_type);
		if(count($this->category_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-third-sub-category/".$main_category_id."/".$main_category_url.".html");
		}
		$this->template->title = $this->Lang["EDIT_SEC_SUB_CAT"];
		$this->template->content = new View("admin/edit_sub_category");
	}

	/** BLOCK OR UNBLOCK SUB CATEGORY **/

	public function block_third_sub_category($type = "",$main_cat_id = "", $cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $main_status = $this->admin->get_sub_sec_category($main_cat_id);
	        $main_category_id = $main_status->current()->category_id;
	        $main_category_url = $main_status->current()->category_url;
		$status = $this->admin->blockunblocksecsubcategory($type, $main_cat_id, $cat_id, $cat_url);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["SEC_CAT_UNBLOCK_SUC1"]);
			}
			else{
				common::message(1, $this->Lang["SEC_CAT_BLOCK_SUC1"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		url::redirect(PATH."admin/manage-third-sub-category/".$main_category_id."/".$main_category_url.".html");
	}

        public function third_sub_delete_category($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_CATEGORIES_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $type = "4";
	        $main_status = $this->admin->get_sub_category($cat_id,$type);
	        $main_category_id = $main_status->current()->category_id;
	        $main_category_url = $main_status->current()->category_url;
		if($cat_id && $cat_url){
			$status = $this->admin->deleteCategory($cat_id, $cat_url);
			if($status == 1){

				common::message(1, $this->Lang["CAT_DEL_SUC"]);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		url::redirect(PATH."admin/manage-third-sub-category/".$main_category_id."/".$main_category_url.".html");
	}

	/** MANAGE THEMES **/

	public function manage_themes()
	{
		$Directory  = opendir(DOCROOT."themes"); $DL = array();
		while (false !== ($dirname = readdir($Directory))) {
			if(strlen($dirname) > 2){
				$DL[] = $dirname;
			}
		}
		sort($DL);
		$this->themes_list = $DL;
		$this->template->title = $this->Lang["MANAGE_THEMES"];
		$this->template->content = new View("admin/manage_themes");
	}

	/* DELETE DEALS */

	public function delete_deals()
	{
		$this->get_key = $this->admin->get_key();
	}


   /** ADMIN SETTINGS **/

	public function admin_settings()
	{

		$this->user_detail = $this->admin->user_details();


		$this->template->content = new View("admin/admin_settings");
		$this->template->title = $this->Lang["ADMIN_SET"];

	}

	/** ADMIN PROFILE UPDATE **/

	public function edit_admin()
	{
		if($this->user_type > 2 )
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}

	    	$userid = $this->user_id;
		if($_POST){
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('name','required','chars[a-zA-Z_ -.,%\']')
						->add_rules('email','required','valid::email')
						->add_rules('mobile',array($this,'validphone'),'chars[0-9 +()-]')
						->add_rules('city','required');

			if($post->validate()){
				$status = $this->admin->edit_admin($userid, arr::to_object($this->userpost));
				if($status){
				    common::message(1, $this->Lang["ADMIN_UPD"]);
				    url::redirect(PATH.'admin/settings.html');
			    }
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->city_list = $this->admin->getCityList();
		$this->user_data = $this->admin->get_users_data($userid);
		if(count($this->user_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/settings.html");
		}
		$this->template->title = $this->Lang["EDIT_ADMIN"];
		$this->template->content = new View("admin/edit_admin");
	}

	/** CHANGE PASSWORD **/

	public function admin_password()
	{
		
        $userid = $this->user_id;
		if($_POST){

			$this->userpost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('oldpassword','required',array($this, 'check_password'))
						->add_rules('password','length[5,32]', 'required')
						->add_rules('cpassword','required','matches[password]');
			if($post->validate()){
				$status = $this->admin->change_password($userid, arr::to_object($this->userpost));
				if($status == 1){
				    common::message(1, $this->Lang["PWD_UPD"]);
			    }
			    url::redirect(PATH.'admin/settings.html');
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->city_list = $this->admin->get_City_List();
		$this->user_data = $this->admin->get_users_data($userid);
		$this->template->title = $this->Lang["CHANGE_PASS"];
		$this->template->content = new View("admin/change_pass");
	}

	/** GET  DEALS COUPON **/
	public function couopn_code()
	{
		if(!ADMIN_PRIVILEGES_DEALS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->deals_act="1";
		$this->validate_coupon="1";
		$code= $this->input->get('code');
	        if($_POST){
		$code= $this->input->post('code');
		$post = new Validation($_POST);
		$post = Validation::factory(array_merge($_POST))
				->add_rules('code', 'required');


			if($post->validate()) {
				$this->deal_list=$this->admin->coupon_code_validate($code);
		                if(count($this->deal_list) == 0){
			        common::message(-1, $this->Lang["COUPON_VERIFIED"]);
				url::redirect(PATH."admin/couopn_code.html");
		                }
			}
            else {
                    $this->form_error = error::_error($post->errors());
            }
		}
		if($code!='')
		{
		    $this->deal_list=$this->admin->coupon_code_validate($code);
		}
		$this->template->title = $this->Lang["COUPON_VALIDATE"];
		$this->template->content = new View("admin/coupon_code");

	}

        /** CLOSE DEALS COUPON **/

        public function close_deals($type = "",$coupon_code="",$deal_id="",$trans_id=0,$act)
        {
		$this->deals_act="1";
	        $status = $this->admin->close_coupon_status($type,$coupon_code,$deal_id,$trans_id,$act);
	        if($status){
			        common::message(1, $this->Lang["COUPON_CLOSED"]);
		     }
		     else{
				 common::message(-1, $this->Lang["COUPON_ALREADY"]);
			 }
	        url::redirect(PATH."admin/couopn_code.html");
        }

         /** CLOSE DEALS COUPON **/

        /*public function close_deals_cod($type = "",$coupon_code="",$deal_id="",$trans_id=0,$mer_id=0,$val=0)
        {
			$this->deals_act="1";
	        $status = $this->admin->close_coupon_status_cod($type,$coupon_code,$deal_id,$trans_id,$mer_id,$val);
	        if($status){
			        common::message(1, $this->Lang["COUPON_CLOSED"]);
		     }
	        url::redirect(PATH."admin/couopn_code.html");
        } */

    /** CHECK PASSWORD EXIST **/

	public function check_password($password = "")
	{
		$exist = $this->admin->exist_password($password, $this->user_id);
		return $exist;
	}


	/** CHECK EMAIL EXIST **/

	public function email_available($email)
	{
		$exist = $this->users->exist_email($email);
		return ! $exist;
	}

   /** CHECK VALID PHONE OR NOT **/

	public function validphone($phone = "")
	{
		if(valid::phone($phone,array(7,10,11,12,13,14)) == TRUE){
			return 1;
		}
		return 0;
	}

	/** MANAGE EMAIL SUBSCRIBER **/

	public function manage_email_subscriber($page = "")
	{
		if(!ADMIN_PRIVILEGES_CUSTOMER)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->users_act="1";
		$this->manage_email_subscriber="1";
		$this->count_user = $this->admin->get_subscriber_count($this->input->get("category"), $this->input->get('email'));


				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-email-subscriber.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $this->count_user,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));

		$search = $this->input->get('id'); 
		$this->search = $this->input->get();
		$this->search_key = arr::to_object($this->search);
		$this->category_list = $this->admin->get_main_category_list();
		$this->users_list = $this->admin->get_subscriber_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("category"), $this->input->get('email'));

			if($search){
				$out = '"S.no","E-Mail","category"'."\r\n";
				$i = 1;

					foreach($this->users_list as $u)
					{
						$category_ids = explode(',',$u->category_ids);
						$category_names = "";

						foreach($category_ids as $d){ 
							foreach($this->category_list as $s){
								if($s->category_id == $d){
									$category_names .= $s->category_name.',';
								}
							}

						}			
						$out .= $i.',"'.$u->email_id.'","'.trim($category_names,",").'"'."\r\n";
							$i++;					
					}
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Content-Length: " . strlen($out));
					header("Content-type: application/csv");
					header("Content-type: application/octet-stream");
					header("Content-Disposition: attachment; filename=subscriber.xls");
					echo $out; 
					exit;
			}
		$this->template->title = $this->Lang["MANG_SUBS"];
		$this->template->content = new View("admin/manage_email_subscriber");
	}

	/** BLOCK AND UNBLOCK USERCOMMENTS **/
	public function block_subscriber($type = "", $subscribe_id="")
	{
		if(!ADMIN_PRIVILEGES_CUSTOMER_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->admin->block_subscriber($type, $subscribe_id);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["SUB_UNB"]);
			}
			else{
				common::message(1, $this->Lang["SUB_B"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
		url::redirect(PATH.$lastsession);
		} else {
		url::redirect(PATH."admin/manage-email-subscriber.html");
		}
	}

	/** DELETE USERCOMMENTS **/

	public function delete_subscriber($subscribe_id = "")
	{
		if(!ADMIN_PRIVILEGES_CUSTOMER_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->admin->delete_subscriber($subscribe_id);
		if($status == 1){
				common::message(1, $this->Lang["SUCC_DEL1"]);
				}

		$lastsession = $this->session->get("lasturl");
		if($lastsession){
		url::redirect(PATH.$lastsession);
		} else {
		url::redirect(PATH."admin/manage-email-subscriber.html");
		}
	}

	/** MANAGE EMAIL REFERRAL USERS **/

	public function manage_referral_users($page = "")
	{
		$this->page = $page ==""?1:$page; // for export per page

		$this->url="admin/manage-referral-users.html"; // for export

		$this->users_act="1";
		$this->manage_referral_user="1";
		$count = $this->admin->get_referral_users_count($this->input->get("name"), $this->input->get('email'));

				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-referral-users.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20,
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));

		$search = $this->input->get('id');
		$this->search = $this->input->get();
		$this->search_key = arr::to_object($this->search);
		$this->city_list = $this->users->getCityListOnly();

		$this->users_list = $this->admin->get_referral_users_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("name"), $this->input->get('email'),0);

		if($search =='all'){  // for export all
			$this->users_list = $this->admin->get_referral_users_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("name"), $this->input->get('email'),1);
		}

			if($search){
				$out = '"S.no","Name","E-Mail","Refered By","Join Date"'."\r\n";
				$i=0;
				$first_item = $this->pagination->current_first_item;
					foreach($this->users_list as $d)
					{
						$out .= $i+$first_item.',"'.$d->referal_name.'","'.$d->ref_email.'","'.$d->refered_name.'","'.date('d-M-Y h:m:i a',$d->ref_joined_date).'"'."\r\n";
						$i++;
					}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=Referral-users.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}
		$this->template->title = $this->Lang['MANA_REFE_USER'];
		$this->template->content = new View("admin/manage_referral_users");
	}

	/** MANAGE CONTACTS **/

	public function manage_contacts($page = "")
	{
		$this->page = $page ==""?1:$page; // for export per page

		$this->url="admin/manage-contacts.html"; // for export

		$this->users_act="1";
		$this->manage_contacts="1";

		if($_POST){
				$post = Validation::factory($_POST)->pre_filter('trim')->add_rules('message', 'required','chars[a-zA-Z0-9 _-]');
			if($post->validate()){

				$email_id = $this->input->post('email');
				$message = $this->input->post('message');
				
				$this->email_id = $this->input->post('email');
				$this->name = $this->input->post('name');
				$this->message = $this->input->post('message');
				$fromEmail = NOREPLY_EMAIL;
				$message = new View("themes/".THEME_NAME."/admin_mail_template");
				
				$fromEmail = NOREPLY_EMAIL;
				if(EMAIL_TYPE==2){
				email::smtp($fromEmail,$email_id, SITENAME, $message);
				}else{
				email::sendgrid($fromEmail,$email_id, SITENAME, $message);
				}
				common::message(1,$this->Lang["MAIL_SENDED"]);
				$lastsession = $this->session->get("lasturl");
                                if($lastsession){
                                url::redirect(PATH.$lastsession);
                                } else {
                                url::redirect(PATH."admin/manage-contacts.html");
                                }

			}
			else{
				$this->form_error = error::_error($post->errors());
			}

		}
		$this->count_user = $this->admin->get_contacts_count($this->input->get("search"));

				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-contacts.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $this->count_user,
				'items_per_page' =>20,
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$search = $this->input->get('id');
		$this->search = $this->input->get();
		$this->search_key = arr::to_object($this->search);

		$this->contacts_list = $this->admin->get_contacts_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("search"),0);
		if($search =='all'){ // for export all
				$this->contacts_list = $this->admin->get_contacts_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("search"),1);
		}
		if($search){  // Export conatcts in CSV format //
			$out = '"S.no","Name","E-Mail","Phone Number","Message"'."\r\n";
			$i=0;
			$first_item = $this->pagination->current_first_item;
				foreach($this->contacts_list as $d)
				{
					$out .= $i+$first_item.',"'.$d->name.'","'.$d->email.'","'.$d->phone_number.'","'.$d->message.'"'."\r\n";
					$i++;
				}
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=Contacts.xls');
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				echo "\xEF\xBB\xBF"; // UTF-8 BOM
				echo $out;
				exit;
		}
		$this->template->title = $this->Lang["MANG_CONT"];
		$this->template->content = new View("admin/manage_contacts");
	}

		/** BLOCK AND UNBLOCK USERCOMMENTS **/

	public function block_contact($type = "", $contact_id="")
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->admin->block_contact($type, $contact_id);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["COMM_UNB"]);
			}
			else{
				common::message(1, $this->Lang["COMM_B"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-contacts.html");
                }
	}

	/** DELETE USER COMMENTS **/

	public function delete_contact($contact_id = "")
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->admin->delete_contact($contact_id);
		if($status == 1){

				common::message(1, $this->Lang["SUCC_DEL2"]);
				}

		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-contacts.html");
                }
	}

	/** ADD COLOR  **/

	public function add_color()
	{
		if(!ADMIN_PRIVILEGES_ATTRIBUTS_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->color_settings = 1;
		if($_POST){
			$status = $this->admin->add_color($_POST['color_code'],$_POST['color_name']);

			if($status==1){
			common::message(1, $this->Lang['COL_ADD']);
			url::redirect(PATH."admin/add-color.html");
			}
		}
		$this->template->title = $this->Lang['ADD_CO'];
		$this->template->content = new View("admin/add_color");
	}

	/** MANAGE COLOR **/

	public function manage_colors($page = "")
	{
		if(!ADMIN_PRIVILEGES_ATTRIBUTS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->color_settings = 1;
		$count = $this->admin->get_color_count();
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-colors.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20,
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->countryDataList = $this->admin->get_color_list($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->title = $this->Lang['MANA_CO'];
		$this->template->content = new View("admin/manage_color");
	}

	/** EDIT COLOR **/

	public function edit_color($color_id = "")
	{
		if(!ADMIN_PRIVILEGES_ATTRIBUTS_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->color_settings = 1;
		$color_id =base64_decode($color_id);

			if($_POST){
				$status = $this->admin->edit_color($color_id,$_POST['color_code'],$_POST['color_name']);
				($status == 1)?common::message(1, $this->Lang['CO_EDIT_SUCC']):common::message(-1, $this->Lang['CO_AL']);
				$lastsession = $this->session->get("lasturl");
                                if($lastsession){
                                url::redirect(PATH.$lastsession);
                                } else {
                                url::redirect(PATH."admin/manage-colors.html");
                                }
			}

		$this->colorData = $this->admin->getcolorData($color_id);
		$this->template->title = $this->Lang['EDIT_CO'];
		$this->template->content = new View("admin/edit_color");
	}

	/** DELETE COLOR **/

	public function delete_color($color_id = "")
	{
		if(!ADMIN_PRIVILEGES_ATTRIBUTS_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($color_id){
			$status = $this->admin->delete_color(base64_decode($color_id));
			if($status == 1){
				common::message(1, $this->Lang['CO_DELETE_SUCC']);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-colors.html");
                }
	}


	/** ADD SIZE **/

	public function add_size()
	{
		if(!ADMIN_PRIVILEGES_ATTRIBUTS_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->color_settings = 1;

		if($_POST){

			$post = Validation::factory($_POST)
							->pre_filter('trim')
							->add_rules('size', 'required','chars[a-zA-Z0-9.]');
			if($post->validate()){
				$status = $this->admin->add_size($_POST['size']);
				if($status == 1){
					common::message(1,$this->Lang['SIZE_ADD_SUCC']);
					url::redirect(PATH.'admin/manage-sizes.html');
				}
			}
			else{
                    $this->form_error = error::_error($post->errors());
            }

		}

		$this->template->title = $this->Lang['ADD_SIZE'];
		$this->template->content = new View("admin/add_size");
	}

	/** MANGE SIZES **/

	public function manage_sizes($page = "")
	{
		if(!ADMIN_PRIVILEGES_ATTRIBUTS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->color_settings = 1;
		$count = $this->admin->get_sizes_count();
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-sizes.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20,
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->sizeDataList = $this->admin->get_sizes_list($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->title = $this->Lang['MANA_SIZE'];
		$this->template->content = new View("admin/manage_size");
	}

	/** EDIT SIZE **/

	public function edit_size($id = "")
	{
		if(!ADMIN_PRIVILEGES_ATTRIBUTS_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->color_settings = 1;
		$size_id =base64_decode($id);

			if($_POST){

				$post = Validation::factory($_POST)
							->pre_filter('trim')
							->add_rules('size', 'required','chars[a-zA-Z0-9.]');
					if($post->validate()){
							$status = $this->admin->edit_size($size_id,$_POST['size']);

									if($status == 1){
										common::message(1, $this->Lang['SIZE_EDIT_SUCC']);
										$lastsession = $this->session->get("lasturl");
                                                                                if($lastsession){
                                                                                url::redirect(PATH.$lastsession);
                                                                                } else {
                                                                                url::redirect(PATH."admin/manage-sizes.html");
                                                                                }
									}
									else{
										common::message(-1, $this->Lang['SIZE_AL_EX']);
										url::redirect(PATH."admin/edit-size/$id.html");
									}
						}
						else{
						        $this->form_error = error::_error($post->errors());
						}

			}

		$this->sizeData = $this->admin->getsizeData($size_id);
		$this->template->title = $this->Lang['EDIT_SIZE'];
		$this->template->content = new View("admin/edit_size");
	}

	/** DELETE SIZE **/

	public function delete_size($size_id = "")
	{
		if(!ADMIN_PRIVILEGES_ATTRIBUTS_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($size_id){
			$status = $this->admin->delete_size(base64_decode($size_id));
			if($status == 1){
				common::message(1, $this->Lang['SIZE_DE_SUCC']);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-sizes.html");
                }
	}

	/** CURL GET AND POST**/

	private function curl_function($req_url = "" , $type = "", $arguments =  array())
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $req_url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		if($type == "POST"){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $arguments);
		}

		$result = curl_exec($ch);
		curl_close ($ch);
		return $result;
	}

	/** ADMIN DEAL AUTO POST FACEBOOK CONNECT **/

	public function facebook_autopost()
	{

		$fb_access_token = $this->session->get("fb_access_token");
		$redirect_url = PATH."admin/facebook_autopost";
		if(!$fb_access_token){
			if($this->input->get("code")){
				$token_url = "https://graph.facebook.com/oauth/access_token?client_id=".FB_APP_ID."&redirect_uri=".$redirect_url."&client_secret=".FB_APP_SECRET."&code=".$this->input->get("code");
				
				$access_token = $this->curl_function($token_url);
				//print_r($access_token); exit;
				$FBtoken = str_replace("access_token=","", $access_token);
				$FBtoken = explode("&expires=", $FBtoken);
					if(isset($FBtoken[0])){
						$profile_data_url = "https://graph.facebook.com/me?access_token=".$FBtoken[0];
						$Profile_data = json_decode($this->curl_function($profile_data_url));
							if(isset($Profile_data->error)){
								echo $this->Lang["PROB_FB_CONNECT"]; exit;
							}
							else{
								$status = $this->admin->register_autopost($Profile_data,$FBtoken[0]);
								common::message(1,"Updated");
							}
					}
					else{
						echo $this->Lang["PROB_FB_CONNECT"]; exit;
					}
				?><script>window.close();</script><?php
			}
			else{
				url::redirect("https://www.facebook.com/dialog/oauth?client_id=".FB_APP_ID."&redirect_uri=".urlencode($redirect_url)."&scope=email,read_stream,publish_stream,offline_access&display=popup");
				die();
			}
		}
		else{
			?><script>window.close();</script><?php
		 }
	}

	  /** UPDATE AUTO POST  DEAL IN TO FACEBOOK**/

	public function autopost()
	{
		$value = $this->input->get("value");

		$status = $this->admin->update_autopost($value);
		$this->session->delete("facebook_status");
		$this->session->delete("fb_access_token");
		$this->session->delete("fb_user_id");
		exit;
	}

        
	/** ADD ATTRIBUTE GROUP  **/

	public function add_sector()
	{
		if(!ADMIN_PRIVILEGES_SECTOR_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		/*if(PRIVILEGES_ATTRIBUTS_ADD != 1){
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");	        
		} */ 
		$this->sector_settings = 1;
		if($_POST){
			$this->userPost = $this->input->post();
		        $post = Validation::factory($_POST)
					->pre_filter('trim')
					->add_rules('sector', 'required',array($this,'check_sector_exist'));


			if($post->validate()){ 
			$status = $this->admin->add_sector(arr::to_object($this->userPost));

			if($status==1){

			        common::message(1, $this->Lang['SECTOR_ADD_SUCC']);
			        url::redirect(PATH."admin/manage-sector.html");
			}
			} else {
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->category_list = $this->admin->get_main_category_list();
		$this->template->title = $this->Lang['ADD_SECTOR'];
		$this->template->content = new View("admin/add_sector");
	}

	/** MANAGE ATTRIBUTE GROUP **/
	
	public function manage_sector($page = "")
	{	
		if(!ADMIN_PRIVILEGES_SECTOR){
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");	        
		} 
		$this->sector_settings = 1;
		$count = $this->admin->get_sector_count();
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-sector.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->sector_list = $this->admin->get_sector_list($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->sub_sector_list = $this->admin->get_sub_sector_list1();
		$this->template->title = $this->Lang['MANAGE_SECTOR'];
		$this->template->content = new View("admin/manage_sector");
	}
	
	/** EDIT ATTRIBUTE GROUP **/
	
	public function edit_sector($sector_id = "")
	{
		if(!ADMIN_PRIVILEGES_SECTOR_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		/*if(PRIVILEGES_ATTRIBUTS_EDIT != 1){
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");	        
		} */
		$this->sector_settings = 1;
		$sector_id =base64_decode($sector_id);
                if($_POST){
                        $this->userPost = $this->input->post();
                        $post = Validation::factory($_POST)
                                        ->pre_filter('trim')
                                     //   ->add_rules('category', 'required')
                                        ->add_rules('sector', 'required');
                        if($post->validate()){
                                $status = $this->admin->edit_sector($sector_id,arr::to_object($this->userPost));
                                if($status == 1){
                                        common::message(1, $this->Lang['SECTOR_UPDATE']);
                                        $lastsession = $this->session->get("lasturl");
                                        if($lastsession){
                                                url::redirect(PATH.$lastsession);
                                        } else {
                                                url::redirect(PATH."admin/manage-sector.html");
                                        }
                                } else {
                                        $this->attr_group_exist= $this->Lang['SECTOR_EXIST'];
                                        //url::redirect(PATH."admin/edit-attribute-group/".base64_encode($attribute_id).".html");
                                }
                        } else  {	
                                $this->form_error = error::_error($post->errors());
                        }
                }
		$this->category_list = $this->admin->get_main_category_list();
		$this->groupData = $this->admin->getsectorData($sector_id);
		$this->template->title = $this->Lang['EDIT_SECTOR'];
		$this->template->content = new View("admin/edit_sector");
	}
	
	/** DELETE ATTRIBUTE GROUP **/
	
	public function delete_sector($sector_id = "")
	{
		if(!ADMIN_PRIVILEGES_SECTOR_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		/*if(PRIVILEGES_ATTRIBUTS != 1){
				common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
				url::redirect(PATH."admin.html");	        
		} */
		if($sector_id){
			$status = $this->admin->delete_sector(base64_decode($sector_id));
			if($status == 1){
				common::message(1, $this->Lang['DELETE_SECTOR']);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-sector.html");
                }
	}
	
	/** BLOCK AND UNBLOCK SELECT **/

	public function block_sector($type = "", $sector_id="")
	{
		if(!ADMIN_PRIVILEGES_SECTOR_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->admin->block_sector($type, $sector_id);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["SELECT_UNB"]);
			}
			else{
				common::message(1, $this->Lang["SELECT_B"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-sector.html");
                }
	}


	public function check_sector_exist(){ 
		$exist = $this->admin->exist_name($this->input->post("sector"));	
			return ($exist == 0)?true:false;
	}
	/** ADD SUB SECTOR **/

	public function add_sub_sector($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_SECTOR_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->sector_settings = 1;
		if($_POST){
			$post = Validation::factory(array_merge($_POST,$_FILES))->pre_filter('trim')
						->add_rules('zip_file', 'upload::valid', 'upload::type[zip]', 'upload::size[1M]')
						->add_rules('subsector', 'required','chars[a-zA-Z0-9]');


			if($post->validate()){
				$subsector = $this->input->post("subsector");
 				$cat_status = $this->input->post("status");
 				//$cat_type = "2";
 				$type = "2";
				$status = $this->admin->check_sub_sector($subsector, $cat_status, $cat_id,$type);
				if($status == 0){
					$check_insert_file = false;
					/* Extrat Files */
					if($_FILES["zip_file"]["name"]) {
						$filename = $_FILES["zip_file"]["name"];
						$source = $_FILES["zip_file"]["tmp_name"];
						$type = $_FILES["zip_file"]["type"];
	
						$name = explode(".", $filename);
						$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
						foreach($accepted_types as $mime_type) {
							if($mime_type == $type) {
								$okay = true;
								break;
							} 
						}
						$continue = strtolower($name[1]) == 'zip' ? true : false;
						if(!$continue) {
							common::message(1, $this->Lang['NOT_ZIPFILE']);
							url::redirect(PATH."admin/manage-sector.html");
						}

						$file_folder = explode('.',$filename);
						$file_folder = $file_folder[0];

						$target_path = DOCROOT."upload/zipper/".$filename;  
						$target_dir = DOCROOT."upload/zipper/";

						$dir_name = strtolower($subsector);

						$target_css = DOCROOT."themes/default/css/".$dir_name;
						$target_view = DOCROOT."application/views/themes/default/".$dir_name;
						$target_modules = DOCROOT."modules/".$dir_name;

						if(is_dir($target_modules)){
							common::message(-1, $this->Lang['ALREADY_MODULES_FOLDER_EXISTS']);
							url::redirect(PATH."admin/manage-sector.html");
						}
						if(is_dir($target_css)){
							common::message(-1, $this->Lang['ALREADY_CSS_FOLDER_EXISTS']);
							url::redirect(PATH."admin/manage-sector.html");
						}
						if(is_dir($target_view)){
							common::message(-1, $this->Lang['ALREADY_VIEW_FOLDER_EXISTS']);
							url::redirect(PATH."admin/manage-sector.html");
						}

						if(is_dir(DOCROOT.'upload/zipper')){
							$this->rrmdir(DOCROOT.'upload/zipper');
							mkdir(DOCROOT.'upload/zipper', 0777,true);
						}


						mkdir($target_dir.$file_folder, 0777, true);
						if(move_uploaded_file($source, $target_path)) {
							$zip = new ZipArchive();
							$x = $zip->open($target_path);
							if ($x === true) {
								$zip->extractTo($target_dir); // change this to the correct site path
								
								/* check controller is already exsits or not  - Start */
								$controller_check = true; 
								$dir = $target_dir.$file_folder.'/modules/controllers';
								$files_list = scandir($dir);
								if(count($files_list)>0){
									foreach($files_list as $f){
										if(strpos($f,'.php') !== false){
											$theme_controller = explode('.',$f);
											$dirs = glob(DOCROOT.'modules/*', GLOB_ONLYDIR);
											if(count($dirs)>0){
												foreach($dirs as $d){
													if(is_dir($d."/controllers")) {
														$files_list = scandir($d."/controllers");
														if(count($files_list)>0){
															foreach($files_list as $f1){
																if(strpos($f1,'.php') !== false){ 
																	$exists_controller = explode('.',$f1);
																	if(isset($exists_controller[0]) && isset($theme_controller[0]) && $exists_controller[0]!='' && $theme_controller[0]!=''){
																		if(strtolower($exists_controller[0])==strtolower($theme_controller[0])){ 
																			$controller_check = false;
																			break;
																		}
																	}
																}
															}
														}
													}
													if($controller_check==false)
														break;
												}
											}
										}
									}
								}
								
								if($controller_check==false){
									common::message(-1, $this->Lang['THEME_CONTROLLER_ALREADY_EXISTS']);
									url::redirect(PATH."admin/manage-sector.html");
								}
								/* check controller is already exsits or not  - end */
								
								/* check Model is already exsits or not  - Start */								
								$model_check = true;
								$dir = $target_dir.$file_folder.'/modules/models';
								$files_list = scandir($dir);
								if(count($files_list)>0){
									foreach($files_list as $f){
										if(strpos($f,'.php') !== false){
											$theme_models = explode('.',$f);
											$dirs = glob(DOCROOT.'modules/*', GLOB_ONLYDIR);
											if(count($dirs)>0){
												foreach($dirs as $d){
													if(is_dir($d."/models")) {
														$files_list = scandir($d."/models");
														if(count($files_list)>0){
															foreach($files_list as $f1){
																if(strpos($f1,'.php') !== false){
																	$exists_model = explode('.',$f1);
																	if(isset($exists_model[0]) && isset($theme_models[0]) && $theme_models[0]!='' && $exists_model[0]!=''){
																		if(strtolower($exists_model[0])==strtolower($theme_models[0])){
																			$model_check = false;
																			break;
																		}
																	}
																}
															}
														}
													}
													if($model_check==false)
														break;
												}
											}
										}
									}
								}
								if($model_check==false){
									common::message(-1, $this->Lang['THEME_MODEL_ALREADY_EXISTS']);
									url::redirect(PATH."admin/manage-sector.html");
								}
								/* check Model is already exsits or not  - end */
								
								
								rename($target_dir.$file_folder.'/css',$target_css);
								common::chmod_r($target_css);
								rename($target_dir.$file_folder.'/view',$target_view);
								common::chmod_r($target_view);
								rename($target_dir.$file_folder.'/modules',$target_modules);
								common::chmod_r($target_modules);
	
								$zip->close();
	
								unlink($target_path);
								rmdir($target_dir.$file_folder);
								$check_insert_file = true;
							}
						} 
					}
					
					if($check_insert_file==true){
						$type = "2";
						$status = $this->admin->add_sub_sector($subsector, $cat_status, $cat_id,$type);
					}else{
						common::message(-1, $this->Lang['PROB_ZIP_FILE_UPLOAD']);
						url::redirect(PATH."admin/manage-sector.html");
					}
					/* Extrat Files */

					common::message(1, $this->Lang["MAIN_CAT_ADD_SUC"]);
					url::redirect(PATH."admin/manage-sector.html");
				}
				else{
					$this->form_error["subsector"] = $this->Lang["SECTOR_EXISTS"];
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->sector_data = $this->admin->get_sector_data($cat_id, $cat_url);
		if(count($this->sector_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-sector.html");
		}
		$this->main_cat = $this->Lang["SECTOR_NAME"];
		$this->sub_cat= $this->Lang["SUB_SECTOR_NAME"];
		$this->template->title = $this->Lang["ADD_SUB_SECTOR"];
		$this->template->content = new View("admin/add_sub_sector");
	}
	/** MANAGE CATEGORY **/

	public function manage_sub_sector($sector_id="",$sector_name = "")
	{
		if(!ADMIN_PRIVILEGES_SECTOR)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		
		$this->sector_settings = 1;
		
		$count = $this->admin->get_sub_sector_count();
				/*$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-sector.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));*/
		$this->sector_list = $this->admin->get_sub_sector_list($sector_id);
		
		$this->template->title = $this->Lang["MANAGE_SUBSECTOR"];
		$this->template->content = new View("admin/manage_sub_sector");

	}
	
	/** BLOCK AND UNBLOCK SECTORS**/
	
	public function block_sub_sector($type = "",$main_cat_id = "", $cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_SECTOR_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->admin->blockunblocksubsector($type, $main_cat_id, $cat_id, $cat_url);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["SELECT_UNB"]);
			}
			else{
				common::message(1, $this->Lang["SELECT_B"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		url::redirect(PATH."admin/manage-sub-sector/$main_cat_id/$cat_id/$cat_url.html");
	}
	
	/** EDIT SUB CATEGORY **/

	public function edit_sub_sector($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_SECTOR_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $status_main = $this->admin->get_subsector($cat_id);
	        $main_cat_id = $status_main->current()->main_sector_id;
		$this->category = "1";
		if($_POST){
			$post = Validation::factory(array_merge($_POST,$_FILES))->pre_filter('trim')
						->add_rules('subsector', 'required','chars[a-zA-Z0-9]');
			if($post->validate()){
				$category = $this->input->post("subsector");
 				$cat_status = $this->input->post("status");
				$status = $this->admin->edit_sub_sector($category, $cat_status, $cat_id, $cat_url);
				if($status == 1){

					common::message(1, $this->Lang["SUB_SECTOR_EDIT_SUC"]);
					url::redirect(PATH."admin/manage-sub-sector/$main_cat_id/$cat_id/$cat_url.html");
				}
				else{
					$this->form_error["subsector"] = $this->Lang["SUB_SECTOR_EXISTS"];
				}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$cat_type = "2";
		$this->sector_data = $this->admin->get_sub_sector_data($cat_id, $cat_url,$cat_type);
		if(count($this->sector_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-sub-sector/$main_cat_id/$cat_id/$cat_url.html");
		}
		$this->template->title = $this->Lang["EDIT_SUB_SECTOR"];
		$this->template->content = new View("admin/edit_sub_sector");
	}
	/** DELETE SUB SECTOR **/

	public function delete_sub_sector($cat_id = "", $cat_url = "")
	{
		if(!ADMIN_PRIVILEGES_SECTOR_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($cat_id && $cat_url){
			$status = $this->admin->deletesubsector($cat_id, $cat_url);
			if($status == 1){

				
				common::message(1, $this->Lang["DELETE_SECTOR"]);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		url::redirect(PATH."admin/manage-sector.html");
	}

	public function getlike_subsector()
	{

		$result = $this->admin->getlike_subsector($_GET['q']);

		$json_array = array();		
		$i = 0;
		if(count($result) > 0)
		{
			foreach($result as $u){
					$json_array[$i]['name'] = $u->sector_name;
					$json_array[$i]['id'] = $u->sector_id;
			$i++;
			} 

				$json_array[$i]['name'] = $_GET['q'];
				$json_array[$i]['id'] = 0;
		}
		else
		{
				$json_array[$i]['name'] = $_GET['q'];
				$json_array[$i]['id'] = 0;
		}

		$json_response = json_encode($json_array,true);
		echo $json_response;exit;

	}
	
	public function change_sortorder($order='',$category_id=''){
		$result = $this->admin->change_sortorder($order,$category_id);
		if($result == 1)
			 common::message(1, "Successfully Updated Sort Order");
		echo $result;exit;
	}
	
	public function rrmdir($dir) {
	  if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
		  if ($object != "." && $object != "..") {
			if (filetype($dir."/".$object) == "dir") 
			   $this->rrmdir($dir."/".$object); 
			else unlink   ($dir."/".$object);
		  }
		}
		reset($objects);
		rmdir($dir);
	  }
	 }

}
