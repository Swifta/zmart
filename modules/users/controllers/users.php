<?php defined('SYSPATH') OR die('No direct access allowed.');
class Users_Controller extends Layout_Controller {

	const ALLOW_PRODUCTION = FALSE;
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
		$this->users = new Users_Model();
	        $this->UserID = $this->session->get("UserID");
	        if(isset($_SESSION['select_lang'])){
			if($_SESSION['select_lang']==2){
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/ha_style.css',PATH.'themes/'.THEME_NAME.'/css/ha_multi_style.css'));
			}else if($_SESSION['select_lang']==3){
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/ig_style.css',PATH.'themes/'.THEME_NAME.'/css/ig_multi_style.css'));
			}else if($_SESSION['select_lang']==4){
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/yo_style.css',PATH.'themes/'.THEME_NAME.'/css/yo_multi_style.css'));
			}else{
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
			}
		}else{
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}
	        /*if(LANGUAGE == "french" ){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/french_style.css',PATH.'themes/'.THEME_NAME.'/css/fr_multi_style.css')); 
		}else if(LANGUAGE == "spanish"){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/spanish_style.css',PATH.'themes/'.THEME_NAME.'/css/sp_multi_style.css'));
		}
		else{
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}*/
		}
	}

	/** USER SIGNUP **/

	public function signup()
	{
	    $user_referral_id = $this->session->get("User_Referral_ID");
            if($_POST){
		        $this->userPost = $this->input->post();
                $post = new Validation($_POST);
                $post = Validation::factory($_POST)
                                ->add_rules('f_name', 'required')
                                ->add_rules('email', 'required','valid::email', array($this, 'email_available'))
                                ->add_rules('password', 'required','length[5,32]')
                                ->add_rules('gender', 'required')
								->add_rules('age_range', 'required')
                                 ->add_rules('country', 'required')
                                ->add_rules('city', 'required');

                $status = $this->users->add_users(arr::to_object($this->userPost),$user_referral_id);
				
				/*
					TODO
					Need to send both emarketplace and club membership signup
					@Live
				*/
					
			if(isset($_POST['z_offer'])){
						
				if(strcmp($_POST['z_offer'], "1") == 0){
							echo 1;
							exit;
				}
			}
					
            if($status == 1){
				$this->signup=1;
				$from = CONTACT_EMAIL;
				$this->name=$_POST['f_name'];
				$this->email =$_POST['email'];
				$this->password =$_POST['password'];  
				$subject = $this->Lang['YOUR'].' '.SITENAME.' '.$this->Lang['REG_COMPLETE'];
				$message = new View("themes/".THEME_NAME."/mail_template");
				if(EMAIL_TYPE==2){
					email::smtp($from, $post->email,$subject, $message);
				} else {
					email::sendgrid($from, $post->email,$subject, $message);
				}
				common::message(1, $this->Lang["SUCC_SIGN"]);
                                url::redirect(PATH."users/my-account.html");
                    }
                }
		if($this->UserID ){
			url::redirect(PATH);
		}
		$this->login = 1;
		$this->country_list = $this->users->getcountrylist();
		$this->city_list = $this->users->getCityList();
		$this->template->title = $this->Lang["USER_SIGNUP"]." | ".SITENAME;
		//$this->template->content = new View("themes/".THEME_NAME."/users/signup");
	}

    	/** USER LOGIN  **/

	public function login()
	{
               /*
					Added conditioning to add club membership flags
					@Live
				  */
				  if($_POST){
				  $email = $this->input->post('email');
				  $password = $this->input->post('password');
				  $url_redirect = $this->input->post('url');
				  
				  $z_offer = "0";
				  if(isset($_POST['z_offer'])){
					  $z_offer = $this->input->post('z_offer');
				  }
				  
				  $status = $this->users->login_users($email,$password);
				  if($status == 1 || -999){
					  
					  if(strcmp($z_offer, "1") == 0){
						  if(isset($_SESSION['Club']) && strcmp($_SESSION['Club'], "1") == "0"){
							  common::message(1, "You are already a Zenith Club member. Please enjoy the offers!");
						  	 echo PATH.$url_redirect;
					
						  }else{
							  echo 1;
						  } 
						 
						  exit;
					  }
		            common::message(1, $this->Lang["SUCC_LOGIN"]);
		             if($url_redirect){
				                url::redirect(PATH.$url_redirect);
			        }else {
				        url::redirect(PATH);
			        }
		        }
		        else if($status == 8){
				        common::message(-1, $this->Lang['USER_BLOCKED']);
				        url::redirect(PATH."users/login");
		        }
		        else{
		                common::message(-1,$this->Lang["DOESNOT_MATCH"]); 
		                url::redirect(PATH."users/login");
		         }
	        }
	}

	/** CHECK USER LOGIN **/
	
	public function check_user_login()
	{ 
	 /*
		  Added zenith offer status, to autoload offer UI.
		  @Live
	  */
	  $email = $this->input->get('email');
	  $password = $this->input->get('password');
	  $z_offer = $this->input->get('z_offer');
	  $check_user_exist = $this->users->login_users($email,$password, $z_offer);
	  echo $check_user_exist;   exit;
		  
		/*$email = $this->input->get('email');
		$password = $this->input->get('password');
		$check_user_exist = $this->users->login_users($email,$password);
		echo $check_user_exist;   exit;*/
		
		
	}
	
	/** CHECK USER SIGNUP **/
	
	public function check_user_signup()
	{
		/*
		  	Added Zenith offer parameter.
		  	@Live
		  */
		  $email = $this->input->get('email');
		  $z_offer = "0";
		  if(isset($_GET['z_offer']))
		  $z_offer = $this->input->get('z_offer');
		  echo $check = $this->users->check_user_exist($email, $z_offer);
		  exit;
		/*$email = $this->input->get('email');
		echo $check = $this->users->check_user_exist($email);
		exit;*/
	}

    	/** EDIT USER PROFILE **/

	public function edit_profile()
	{
		
		if(!$this->UserID){
			url::redirect(PATH);
		}        
		if($_POST){

                    $cat_pref = $this->input->post("categorytag");
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			
			$post = Validation::factory(array_merge($_POST,$_FILES))
						
						->add_rules('firstname','required','chars[a-zA-Z_ -.,%\']')
						->add_rules('lastname', 'chars[a-zA-Z_ -.,]')
						->add_rules('email','required','valid::email')
						->add_rules('mobile',array($this, 'validphone'), 'chars[0-9-+().]')
						->add_rules('user_image','required', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');

			if($post->validate()){

			$status = $this->users->update_user(arr::to_object($this->userPost),$cat_pref);
				if($status == 1){

				$listing_filename = upload::save('user_image');
				if($listing_filename!=''){
				common::image($listing_filename, 170, 165, DOCROOT.'images/user/150_115/'.$this->UserID.'.png');
				unlink($listing_filename); 
				}
				common::message(1, $this->Lang["SUCC_UPDATE"]);
				url::redirect(PATH."users/my-account.html");
				
				
				}
			}
			
			else{
			$this->form_error = error::_error($post->errors());
			}
		}
		$this->category_list = $this->users->get_gategory_list();
		$this->users_category_list = $this->users->get_users_category_list();
		$this->user_detail = $this->users->get_user_data_list();
		$this->template->title = $this->Lang["EDIT_USER_SET"]." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/users/edit_profile");
		
	}
	/*UPDATE PROFILE PHOTOS */
	public function update_prfile_photo()
		{ 


			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			
			$post = Validation::factory($_FILES)
					
						->add_rules('image','required', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
			if($post->validate()){
				

				$listing_filename = upload::save('image');
				if($listing_filename!=''){
			        common::image($listing_filename, USER_DETAIL_WIDTH, USER_DETAIL_HEIGHT, DOCROOT.'images/user/150_115/'.$this->UserID.'.png');
				common::image($listing_filename, USER_LIST_WIDTH, USER_LIST_HEIGHT, DOCROOT.'images/user/75_75/'.$this->UserID.'.png');
				unlink($listing_filename); 
				}

				common::message(1, "Profile picture updated successfully");
				url::redirect(PATH."users/my-account.html");
				
			}
			
			else{
			$this->form_error = error::_error($post->errors());
			}
		}

	/** USER CHANGE PASSWORD **/

	public function change_password()
	{
	        if(!$this->UserID){
			url::redirect(PATH);
		}


		if($_POST){

			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('oldpassword','required',array($this, 'check_password'))
						->add_rules('password','required')
						->add_rules('cpassword','required','matches[password]');						
			if($post->validate()){
				$status = $this->users->update_password(arr::to_object($this->userPost));
					if($status == 1){
						common::message(1, $this->Lang["PWD_SUC_UPD"]);
						url::redirect(PATH."users/my-account.html");
					}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}

		$this->users_details = $this->users->get_users_details();
		$this->template->content = new View("themes/".THEME_NAME."/users/change_password");
	}

	/** USER CITY SUBSCRIBE **/


	public function user_city()
	{

		if(!$this->UserID){
		url::redirect(PATH);
		}
			if($_POST){
			$citysub = $this->input->post("citysub");
			$status = $this->users->update_city_settings($citysub);
				if($status == 1){
				common::message(1, $this->Lang["CITY_SUB_UPDATE"]);
				url::redirect(PATH.'users/city-subscriptions.html');
				}
			}
		$this->CountyList = $this->users->allCountryList();
		$this->users_city_list = $this->users->get_users_city_list();
		$this->template->title = $this->Lang["EDIT_USER_SET"]." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/users/user_settings");
	}

	/** USER CATEGORY SETTINGS **/
	public function user_cate()
	        {
		        if(!$this->UserID){
                        url::redirect(PATH);
                }
		if($_POST){
	        $cat_pref = $this->input->post("categorytag");
			$status = $this->users->update_category_preference($cat_pref);
			if($status == 1){
				common::message(1, $this->Lang["CATEGORY_SUB_UPDATE"]);
				url::redirect(PATH.'users/city-setting.html');
			}
		}
		$this->category_list = $this->users->get_gategory_list();
		$this->users_category_list = $this->users->get_users_category_list();
        $this->template->title = $this->Lang["EDIT_USER_SET"]." | ".SITENAME;
        $this->template->content = new View("themes/".THEME_NAME."/users/user_settings");
	}

	public function user_bought()
	{

		if(!$this->UserID){
               url::redirect(PATH);
        }
        	
        	$this->deals_bought = $this->users->get_deals_bought();
		$this->template->title = $this->Lang["EDIT_USER_SET"]." | ".SITENAME;
        $this->template->content = new View("themes/".THEME_NAME."/users/user_dealbought");
	}
	
	
/** FORGOT PASSWORD **/

	public function forgot()
	{
		if($_POST){
            $this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
					->add_rules('email', 'required','valid::email');
			                        if($post->validate()){
						$email = $this->input->post("email");
						$status = $this->users->forgot_password($email);
						if($status){
						if($status == -2){
						common::message(-1,$this->Lang["USER_BLOCKED_ADMIN"]);
						url::redirect(PATH);
					        } else {
						$this->forgot=1;
						$from = CONTACT_EMAIL;  
						$subject = $this->Lang['YOUR_PASS_RE_SUCC'];
						$this->name =$status['name'];
						$this->password =$status['password'];
						$this->email = $_POST['email'];
						//$message .= "<p>Your Password  reset </p><p>Email : ".$status['email']."<p/><p>Password : ".$status['password']."<p/><br /> <p>Thanks,</p>";
						$message = new View("themes/".THEME_NAME."/mail_template");
						if(EMAIL_TYPE==2){
						email::smtp($from, $post->email,$subject, $message);
						}else{
						email::sendgrid($from, $post->email,$subject, $message);
						} 
						common::message(1,$this->Lang["PWD_RESET"]);
						url::redirect(PATH);
						}
			        } elseif($status == -2){
						$this->email_mobile_error = $this->Lang["USER_BLOCKED_ADMIN"];
					}
			        elseif($status == -1){
						$this->email_mobile_error = $this->Lang["INV_EMAIL"];
					}
					else{
						$this->email_mobile_error = $this->Lang["EMAIL_NOT_EXIST"];
					}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
			if($this->UserID ){
				url::redirect(PATH);
			}
		}
		$this->template->title= $this->Lang["FORGOT_PASS"]." | ".SITENAME;
		$this->template->content=new View("themes/".THEME_NAME."/users/forgot_password");
	}

	/** FACEBOOK CONNECT **/

	public function facebook()
	{ 
		
		$user_referral_id = $this->session->get("User_Referral_ID");
		$fb_access_token = $this->session->get("fb_access_token"); 
		$redirect_url = PATH."users/facebook/";
		if(!$fb_access_token && !$this->UserID){ 
			if($this->input->get("code")){
			$token_url = "https://graph.facebook.com/oauth/access_token?client_id=".FB_APP_ID."&redirect_uri=".$redirect_url."&client_secret=".FB_APP_SECRET."&code=".$this->input->get("code");
				$access_token = $this->curl_function($token_url);
				$FBtoken = str_replace("access_token=","", $access_token);
				$FBtoken = explode("&expires=", $FBtoken);
				if(isset($FBtoken[0])){
					$profile_data_url = "https://graph.facebook.com/me?access_token=".$FBtoken[0];
					$Profile_data = json_decode($this->curl_function($profile_data_url));
					if(isset($Profile_data->error)){
						echo $this->Lang["PROB_FB_CONNECT"]; exit;
					}
					else{
					        $password = text::random($type = 'alnum', $length = 10);
						$status = $this->users->register_facebook_user($Profile_data, $this->city_id, $FBtoken[0],$user_referral_id,$password);
						if($status > 1){
							
							$this->session->delete('fb_email');
						        
						        $user_details = $this->users->get_edit_name($status);
                                                        $this->signup=1;
                                                        $from = CONTACT_EMAIL;
                                                        $this->name=$user_details->current()->firstname;
                                                        $this->email =$user_details->current()->email;
                                                        $this->password =$password;
                                                        $subject = SITENAME." - Facebook Registration Details";
                                                        $message = new View("themes/".THEME_NAME."/mail_template");
                                                        if(EMAIL_TYPE==2){
                                                        email::smtp($from, $this->email,$subject, $message);
                                                        } else {
                                                        email::sendgrid($from, $this->email,$subject, $message);
                                                        }
						
						}
			
			
						($status==1)?common::message(1, $this->Lang["SUCC_LOGIN"]):common::message(1, $this->Lang["SUCC_SIGN"]);
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

	
	/** FACEBOOK CONNECT AUTO SHARE**/

	public function facebook_share()
	{
		$fb_access_token = $this->session->get("fb_access_token");
		$redirect_url = PATH."users/facebook_share/";
		if($this->UserID){
			if($this->input->get("code")){
			$token_url = "https://graph.facebook.com/oauth/access_token?client_id=".FB_APP_ID."&redirect_uri=".    							$redirect_url."&client_secret=".FB_APP_SECRET."&code=".$this->input->get("code");
				$access_token = $this->curl_function($token_url);
				$FBtoken = str_replace("access_token=","", $access_token);
				$FBtoken = explode("&expires=", $FBtoken);
				if(isset($FBtoken[0])){
					$profile_data_url = "https://graph.facebook.com/me?access_token=".$FBtoken[0];
					$Profile_data = json_decode($this->curl_function($profile_data_url));
					if(isset($Profile_data->error)){
						echo $this->Lang["PROB_FB_CONNECT"]; exit;
					}
					else{
					        $status = $this->users->facebook_share_user($Profile_data, $FBtoken[0]);
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

	/** POST DEALS TO USERS WALL **/

	public function post_wall()
	{
		echo $fb_access_token = $this->session->get("fb_access_token"); exit;
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


	/* USER DETAILS */

    public function user_deals($user)
	{
	       	$this->user_details = $this->users->get_user_bought_boughtau($user);
       		
		url::redirect(PATH);
	}
	/** CHECK OLD PASSWORD **/

	public function oldpassword($pass)
	{
	    $exist = $this->users->oldpassword($pass);
	    if($exist == 1){return 1;}
	    else{return 0;}
	}
		
	/** MY ACCOUNT **/

	public function my_account()
	{
	        if(!$this->UserID){
			url::redirect(PATH);
		}

		$this->user_detail1 = $this->users->get_user_data_list($this->input->get('fb_user_id'));
		if($_POST){

			$facebook= $this->input->post("facebook");
			$status= $this->users->update_facebook_wal($facebook);

			if($status  == 1){

				if($facebook == 1){ 
					foreach($this->user_detail1 as $u){ 
					 $facebook_id=$u->fb_user_id;
     				 }
					$fb_access_token = $this->session->get("fb_access_token");
					$url = 'https://graph.facebook.com/'.$facebook_id.'/feed';
					$attachment =  array(
					'access_token'  =>$fb_access_token,			
					'message'  => "welcome to ". SITENAME ,			
					);
					// set the target url
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
					curl_setopt($ch, CURLOPT_HEADER, 0);

					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$result = curl_exec($ch);
					curl_close ($ch);					
				 }

				common::message(1, $this->Lang["UPDATE_SUCCESS"]);
				url::redirect(PATH."users/my-account.html");
			}
		}
		$this->template->title = $this->Lang["MY_ACC"]." | ".SITENAME;
		$this->user_detail = $this->users->get_user_data_list($this->input->get('fb_user_id'));
		$this->template->content = new View("themes/".THEME_NAME."/users/my_account");
		$this->country_list = $this->users->getcountrylist();
		$this->user_detail = $this->users->get_user_data_list();
		$this->get_gategory_list = $this->users->get_gategory_list();
	}
	
	/** MY COUPONS **/
	public function my_coupons($page = "")
	{
		if(!$this->UserID){
			url::redirect(PATH);
		}
		if($_POST){
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory(array_merge($_POST,$_FILES))
					->add_rules('file', 'required');
			if($post->validate()){
				if($_FILES['file']['name'] != "" ){
					$target_file = DOCROOT.'images/Pay_Later_Doc/'.base64_encode($_POST['transaction_id']).'_'.$_FILES["file"]["name"];
					if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
						$result = $this->users->update_bank_deposit_document($_POST['transaction_id'],$_FILES["file"]["name"]);
						common::message(1, $this->Lang["SUCCESSFULLY_UPDATED_PAY_LATER_DOC"]);
						$this->session->set('hdn_type',$_POST['type']);
						url::redirect(PATH."users/my-coupons.html");
					} 
				}
			}
		}
		$this->deals_coupons_list_count = $this->users->get_deals_coupons_list_count();
		$this->pagination = new Pagination(array(
				'base_url'       => '/users/my_coupons/page/'.$page,
				'uri_segment'    => 4,
				'total_items'    => $this->deals_coupons_list_count,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));

		$this->deals_coupons_list = $this->users->get_deals_coupons_list($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->products_list_count = $this->users->get_products_coupons_list_count();
		$this->pagination_list = new Pagination(array(
				'base_url'       => '/users/my_coupons/page/'.$page,
				'uri_segment'    => 4,
				'total_items'    => $this->products_list_count,
				'items_per_page' => 2000, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->products_coupons_list = $this->users->get_products_coupons_list($this->pagination->sql_offset, $this->pagination->items_per_page);

		$this->product_size = $this->users->get_shipping_product_size();
		$this->product_color = $this->users->get_shipping_product_color();
		$this->auctions_coupons_list = $this->users->get_auctions_coupons_list();
		$this->template->title = $this->Lang["MY_BUYS"]." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/users/my_coupons");
	}
	
	/** REFER FRIENDS **/
	public function refer_amount($refamount)
	{
	    $this->users_details = $this->users->get_users_details_amount($refamount);
        url::redirect(PATH);
	}
	
	/** REFERRAL LIST **/
	public function referral_list($page = "")
	{
 		if(!$this->UserID){
			url::redirect(PATH);
		}
		$this->user_refrel_list_count= $this->users->user_refrel_list_count();

		$this->pagination = new Pagination(array(
				'base_url'       => 'users/my-referral-list.html/page/'.$page,
				'uri_segment'    => 4,
				'total_items'    => $this->user_refrel_list_count,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->template->title = $this->Lang["MY_REFERAL"]." | ".SITENAME;
		$this->user_refrel_list= $this->users->user_refrel_list($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->content = new View("themes/".THEME_NAME."/users/my_referral_list");
	}
	
	/** AUCTOIN WINNER LIST **/
	public function winner_list($page = "")
	{
 		if(!$this->UserID){
			url::redirect(PATH);
		}
		$count= $this->users->user_winner_list_count();
		$this->pagination = new Pagination(array(
				'base_url'       => 'users/my-winner-list.html/page/'.$page,
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 15, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));

		$this->user_winner_list= $this->users->user_winner_list($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->title = $this->Lang["WON_AUC"]." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/users/my_winner_list");
	}
	/** EMAIL SUBSCRIBTION **/
	public function email_subscribtions()
	{	
	        if(!$this->UserID){
			url::redirect(PATH);
		}
		if($_POST){

			$city_subscribe = $this->input->post("city_tag"); 
			
			if($city_subscribe !="") {
			$city_subscribe = array_unique($city_subscribe);
			}
	        	$cat_subscribe = $this->input->post("category_tag");
			$status = $this->users->update_preference($city_subscribe,$cat_subscribe);
			if($status == 1){
				common::message(1, $this->Lang["UPDATE_SUCCESS"]);
				url::redirect(PATH."users/email-subscribtions.html");
			}
			/*else{
				common::message(-1, $this->Lang["YOUR_NT_DONE"]);
				url::redirect(PATH."users/email-subscribtions.html");
			} */
		}
		$this->category_list = $this->users->get_category_list();  
		$this->get_city_list = $this->users->get_city_list(); 
		$this->users_select_list = $this->users->get_users_select_list(); 
		
		$this->users_select_list1 = $this->users->get_users_select_list1();
		$this->template->title = $this->Lang["MY_ELAL_SUB"]." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/users/email_subscribtions");
	}
	
	
	 /** CHECK EMAIL EXIST **/

	public function email_available($email)
	{
		
		$this->user_details = $this->users->get_user_bought_product($email);
	    if($email == $this->session->get('user_email')){
	    $exist = 0;
	    }else{
		$exist = $this->users->exist_email($email);
		}
		return ! $exist;
	}
	
	/** MY CONNECTIONS **/
	public function connections()
	{
	        if(!$this->UserID){
			    url::redirect(PATH);
		    }
		$this->user_detail1 = $this->users->get_user_data_list($this->input->get('fb_user_id'));
		if($_POST){

			$facebook= $this->input->post("facebook");
			$status= $this->users->update_facebook_wal($facebook);

			if($status  == 1){

				if($facebook == 1){ 
					foreach($this->user_detail1 as $u){ 
					 $facebook_id=$u->fb_user_id;
     				 }
					$fb_access_token = $this->session->get("fb_access_token");
					$url = 'https://graph.facebook.com/'.$facebook_id.'/feed';
					$attachment =  array(
					'access_token'  =>$fb_access_token,			
					'message'  => "welcome to ". SITENAME ,			
					);
					// set the target url
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
					curl_setopt($ch, CURLOPT_HEADER, 0);

					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$result = curl_exec($ch);
					curl_close ($ch);					
				 }

				common::message(1, $this->Lang["UPDATE_SUCCESS"]);
				url::redirect(PATH."users/connections.html");
			}
		}
     
		$this->user_detail = $this->users->get_user_data_list($this->input->get('fb_user_id'));
		$this->template->content = new View("themes/".THEME_NAME."/users/connections");
	}

    /** REFER FRIENDS **/
	public function refer_friends()
	{
	    $this->users_details = $this->users->get_users_details();
	    $this->template->title = "Refer Friends  | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/users/refer_friends");
		
	}
	
	/** CHECK VALID PHONE OR NOT **/
	
	public function validphone($phone = "")
	{
		if(valid::phone($phone,array(7,10,11,12,13)) == TRUE){
			return 1;
		}
		return 0;
	}

	 /** CHECK PASSWORD EXIST **/
	 
	public function check_password($password = "")
	{
		$exist = $this->users->exist_password($password, $this->UserID);
		$this->user_details = $this->users->get_user_bought($password);
		return $exist;
	}

	/** ADD MORE CITY **/
	public function addmore_city()
	{

		$city_id = $this->input->get('count');
		
		$this->get_city_data = $this->users->get_city_data($city_id);
		$list = "";
		foreach($this->get_city_data as $c){

			$list .="<li style='color: #676767;font: 13px/15px arial;'><input type='checkbox' name='city_tag[]' checked='checked' value='".$c->city_id."' class='check_subcity'>".$c->city_name."</li>";		
		 }
		echo $list;
		exit;
	}
	
		/** UPDATE Profile**/
	
	public function update_name()
	{ 

		if(!$this->UserID){			
			url::redirect(PATH); 	
		}
				
		$user_id = $this->input->get("user_id"); 
		$first_name = $this->input->get("first_name"); 
		$last_name = $this->input->get("last_name");
		$user_record = $this->users->update_user_info($user_id,$first_name,$last_name);	
		exit;	
	}

		/** UPDATE Profile**/
	
	public function update_password()
	{ 

		if(!$this->UserID){			
			url::redirect(PATH); 	
		}
				
		$old_pass = $this->input->get("o_pass");  
		$new_pass = $this->input->get("n_pass");
		$user_record = $this->users->update_user_password($old_pass,$new_pass);	
		exit;	
	}

	/* UPDATE PHONE NUMBER */
	public function update_phone()
	{ 

		if(!$this->UserID){			
			url::redirect(PATH); 	
		}
		
		$phone = $this->input->get("phone");
		$user_record = $this->users->update_phone($phone);	
		exit;	
	}
	/* UPDATE USER ADDRESS */
	public function update_address()
	{ 

		if(!$this->UserID){			
			url::redirect(PATH); 	
		}
		
		$address1 = $this->input->get("address1");
		$address2 = $this->input->get("address2");
		$user_record = $this->users->update_address($address1,$address2);	
		exit;	
	}
	/* UPDATE CITY */
	public function update_city()
	{ 

		if(!$this->UserID){			
			url::redirect(PATH); 	
		}
		
		$city = $this->input->get("city");
		$user_record = $this->users->update_city($city);	
		exit;	
	}
	/*UPDATE COUNTRY */
	public function update_country()
	{ 

		if(!$this->UserID){			
			url::redirect(PATH); 	
		}
		
		$country = $this->input->get("country"); 
		$user_record = $this->users->update_country($country);	
		exit;	
	}
	/** SUBSCRIBE / UNSUBSCRIBE CITY **/
	
	
	public function city_subscribe($type = "", $user_id = "")
	{
	        
	   $status = $this->users->blockunblocksubscriber($type,$user_id);
                if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang['SUCCESS_UNSUBSCRIBE']);
			}
			else{
				common::message(1, $this->Lang['UPDATE_SUCCESS']);
			}
		}
		else{
			common::message(-1, $this->Lang['NO_RECORD_FOUND']);
		}
		url::redirect(PATH."users/email-subscribtions.html");
		
	}
	
    /** COUPON GENERATE **/

	public function pdf()
	{   
 	    $deal_id=$this->input->get('id');
 	    
	    $this->deals_coupons= $this->users->get_deals_coupons($deal_id);
	    $coupon_code= text::random($type = 'alnum', $length = 10);
	    foreach($this->deals_coupons as $u){
            require_once(APPPATH.'vendor/pdf/config/lang/eng.php');
            require_once(APPPATH.'vendor/pdf/tcpdf.php');
            
             include "modules/BarcodeQR.php"; 
	     $qr = new BarcodeQR();
	     $qr->url($u->coupon_code); 									 
	     $qr->draw(180, DOCROOT."images/user/qrcode/".$u->coupon_code.".png");

	    $url1= PATH."modules/barcode_generator/barcode_generator.php?ccode=".$u->coupon_code;
	    $imageDir1 = "images/user/barcode/";
            $imagePath1 = $imageDir1.$u->coupon_code.".png";
	    $image11 = file_get_contents($url1);
	    file_put_contents(DOCROOT.$imagePath1, $image11);
	    
	    
           // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set document information
            $pdf->SetCreator(PDF_CREATOR);

            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            //set margins
            //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetMargins(6, 0, 0);
            $pdf->SetHeaderMargin(-10);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            //set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            //set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            //set some language-dependent strings
            $pdf->setLanguageArray($l);

            // ---------------------------------------------------------

            // set font
            $pdf->SetFont('helvetica', '', 10);

            // add a page
$pdf->AddPage();
$symbol = CURRENCY_CODE;
$Purchase=date('d-M-Y',$u->transaction_date);
$expirydate=date('d-M-Y',$u->expirydate);
$enddate=date('d-M-Y',$u->enddate);
$logo =PATH.'themes/'.THEME_NAME.'/images/logo.png';
$voucher_image1 =PATH.'themes/'.THEME_NAME.'/images/favicon.png';
$voucher_image2 =PATH.'themes/'.THEME_NAME.'/images/new/hw_1.png';
$voucher_image3 =PATH.'themes/'.THEME_NAME.'/images/new/hw_2.png';
$voucher_image4 =PATH.'themes/'.THEME_NAME.'/images/new/hw_3.png';
$voucher_image5 =PATH.'themes/'.THEME_NAME.'/images/new/hw_4.png';

if(file_exists(DOCROOT.'images/deals/1000_800/'.$u->deal_key.'_1.png'))       
{
 $deal_image =PATH.'images/deals/1000_800/'.$u->deal_key.'_1.png'; 
}
else
{
 $deal_image = PATH.'/themes/'.THEME_NAME.'/images/noimage_deals_details.png';
}
 if(file_exists(DOCROOT.'images/user/qrcode/'.$u->coupon_code.'.png'))        
    { 

  $qrcode =PATH.'images/user/qrcode/'.$u->coupon_code.'.png';

    }
 if(file_exists(DOCROOT.'images/user/barcode/'.$u->coupon_code.'.png'))        
    { 

  $barcode =PATH.'images/user/barcode/'.$u->coupon_code.'.png';

   }
	$contact_email=CONTACT_EMAIL;
	$phone=PHONE1;
$validate='<img src="'.PATH.'/themes/'.THEME_NAME.'/images/coupon_im.png"  width="240" height="207" />';

$desc = strip_tags($u->deal_description);
$description = text::limit_words($desc,60, '&nbsp;'); 
// define some HTML content with style

$pay_later_show = '';
if($u->type==6){
	$pay_later_show = '<tr height="5"><td></td></tr><tr><td>'.$this->Lang['PAY_LATER_DETAILS'].' : '.PAY_LATER.'</td></tr>';
}

if($this->session->get('language') == 'arabic') {
	$html = '<table width="745" cellpadding="0" cellspacing="0" border="0" style="margin:0;padding:0;direction:rtl;unicode-bidi:embed;">';
}
else {
	$html = '<table width="700" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #d3d2d1;">';
}
	$html .=
            '
			<tr height="15">
				<td colspan></td>
			</tr>
			<tr>
		<td width="10"></td>
                <td valign="top" width="680"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="margin:0;">
                        <tr>
                            <td valign="top"><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr height="46">
                                        <td width="10" bgcolor="#ffc367">&nbsp;</td>
                                        <td width="240" bgcolor="#fff" align="center"><img src="'.$logo.'" alt="uniemerchant" border="0" /></td>
                                         <td width="160" bgcolor="#fff" align="center"></td>
                                        <td width="250" align="right" valign="middle" style="font:bold 22px arial;color:#666666;"><img src="'.$barcode.'" alt="Barcode" border="0" width="189" height="38"/></td>
                                        <td width="10">&nbsp;</td>
                                        <td width="10" bgcolor="#ffc367">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr height="10"><td style="border-bottom: 1px dashed #c0c0c0;">&nbsp;</td>
                        </tr>
                        <tr height="10">
                            <td></td>
                        </tr>
                        <tr>
                            <td><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr height="220">
                                        <td width="370" align="center"><img src="'.$deal_image.'" width="354" height="220" alt="Main Deal Image" border="0" /></td>
                                        <td width="14"></td>
                                        <td valign="top"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="color:#666666;font:normal 13px arial;">
                                                <tr>
                                                    <td style="font:normal 12px arial;color:#000000;">'.$u->deal_title.'</td>
                                                </tr>
                                                <tr height="15"><td></td></tr>
                                                <tr>
                                                    <td>End date : '.date("Y - m - d",strtotime($enddate)).'</td>
                                                </tr>
                                                <tr height="15"><td></td></tr>
                                                <tr>
                                                    <td>Expires date : '.date("Y - m - d",strtotime($expirydate)).'</td>
                                                </tr>
                                                <tr height="15"><td></td></tr>
                                                <tr>
                                                    <td style="font:normal 15px arial;color:#000000;">Voucher Value : '.$symbol." ".$u->deal_value.'</td>
                                                </tr>
                                            </table></td>
                                    </tr>   
                                </table></td>
                        </tr>
                        <tr height="15">
                            <td style="border-bottom:1px dashed #c0c0c0;"></td>
                        </tr>
                        <tr height="15">
                            <td></td>
                        </tr>                        
                        <tr>
                            <td valign="top"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="font:normal 13px arial;color:#333;">                                                                     
                                    <tr>
                                        <td valign="top" width="370"><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td style="font:normal 18px arial;color:#ff9b02;">Voucher Code: <b> '.$u->coupon_code.'</b></td>
                                                </tr>
                                                <tr height="10">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Purchased Date : '.date("d/m/Y",strtotime($Purchase)).'</td>
                                                </tr>
                                                
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>IP : '.$u->ip.'</td>
                                                </tr>
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>IP City Name : '.$u->ip_city_name.'</td>
                                                </tr>
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>IP Country Name : '.$u->ip_country_name.'</td>
                                                </tr>'.$pay_later_show.'
                                            </table></td>
                                        <td width="14"></td>
                                        <td valign="top" ><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td style="font:normal 18px arial;color:#ff9b02;">'.$this->Lang['SHOP_ADDR'].'</td>
                                                </tr>
                                                <tr height="10">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>'.$u->store_name.',</td>
                                                </tr>
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>'.$u->address1.','.$u->address2.'</td>
                                                </tr>
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>'.$u->city_name.' - '.$u->zipcode.'</td>
                                                </tr>
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile: '.$u->phone_number.'</td>
                                                </tr></table></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr height="15">
                            <td style="border-bottom: 1px dashed #c0c0c0;">&nbsp;</td>
                        </tr>                                    
                        <tr height="15">
                            <td></td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                    <tr>
                                        <td valign="top">
                                            <table cellspacing="0" cellpadding="0" border="0" width="100%" style="font:normal 12px arial;color:#666;">
                                                
                                                <tr>
                                                    <td style="font:bold 15px arial;color:#000;">Description</td>
                                                </tr>
                                                <tr height="10"><td></td></tr>
                                                <tr>
                                                    <td>'.$description.'</td>
                                                </tr>                                               
                                            </table></td>
                                        <td align="right" valign="top"><img src="'.$qrcode.'" alt="Barcode" border="0" /></td>
                                    </tr>
                                </table></td>
                        </tr>                        
                        <tr height="20">
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font:normal 16px arial;color:#000;">This is How it Works</td>
                        </tr>                        
                        <tr height="15">
                            <td></td>
                        </tr>
                        <tr>
                            <td><table cellspacing="0" cellpadding="0" border="0" width="100%" style="font:normal 14px arial;color:#666;">
                                    <tr>
                                        <td><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td width="35"><img src="'.$voucher_image2.'" width="25" height="25" border="0" alt="1" /></td>
                                                    <td>Print voucher </td>
                                                </tr>
                                            </table></td> 
                                        <td><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td width="35"><img src="'.$voucher_image3.'" width="25" height="25" border="0" alt="1" /></td>
                                                    <td>Arrange an appointment with the business </td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                    <tr height="20">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td width="35"><img src="'.$voucher_image4.'" width="25" height="25" border="0" alt="1" /></td>
                                                    <td>Bring along your coupon </td>
                                                </tr>
                                            </table></td>
                                        <td><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td width="35"><img src="'.$voucher_image5.'" width="25" height="25" border="0" alt="1" /></td>
                                                    <td>Redeem and enjoy ! </td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr height="20">
                            <td style="border-bottom: 1px dashed #c0c0c0">&nbsp;</td>
                        </tr>
                        <tr height="20">
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font:normal 12px arial;color:#000000;"><span style="color:#000;font:bold 15px arial;">Any Questions ? Email Us :</span> '.CONTACT_EMAIL.' , User ‐ ID: email@gmail.com</td>
                        </tr>
                        <tr height="20">
                            <td style="border-bottom: 1px dashed #c0c0c0">&nbsp;</td>
                        </tr>
                        <tr height="15">
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font:normal 12px/18px arial;color:#000000;"><strong>'.$this->Lang['VOUCHER_FOOTER_CONTENT1'].'</strong> '.PHONE1.', <strong>'.$this->Lang['EMAIL'].' '.SITENAME.': </strong><a href="mailto:'.CONTACT_EMAIL.'" title="'.CONTACT_EMAIL.'" style="color: #333333;text-decoration: none;">'.CONTACT_EMAIL.'</a></td>
                        </tr>
                         </table></td>
						<td width="10"></td>
                        </tr>
						<tr height="15">
							<td></td>
						</tr>						
                         </table>
                        ';
//echo $html; exit;
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('voucher.pdf', 'I');        
            
	     }
   }
	
	/** SUBSCRIBE CITY **/
	
	public function subscribe_city()
	{
	        $this->home = new Home_Model();
		$this->products_details = $this->home->products_details();
		$this->deals_details = $this->home->deals_details();
		$this->auction_details = $this->home->auction_details();
		$this->products_details1 = $this->home->products_details1();
		$this->deals_details1 = $this->home->deals_details1();	
		$this->auction_details1 = $this->home->auction_details1();
		$this->all_payment_list = $this->home->payment_list();
	        if($_POST){
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
				->add_rules('subscribe_email','required','valid::email');
			if($post->validate()){
			        $status = $this->users->subscribe_city(arr::to_object($this->userPost));
					if($status==1){ 
				        $this->subscribe_city=1;
						$this->email = $post->subscribe_email;
						$from = CONTACT_EMAIL;  
						$subject = "Welcome on ".SITENAME;		
						$message1 = "The new Subscriber for our site <p><b>Email Id:</b>".$post->subscribe_email;
						$message = new View("themes/".THEME_NAME."/mail_template");
						if(EMAIL_TYPE==2){
						email::smtp($from, $post->subscribe_email,$subject, $message);

				               }	
				        	else{
						email::sendgrid($from, $post->subscribe_email,$subject, $message);

					      }
						common::message(1, $this->Lang['THANK_SUBSCRI']);
				        url::redirect(PATH);				        
				}
				elseif($status==-3){
					$this->form_error['subscribe_email'] = $this->Lang['ALRDY_SUBS_CITY'];
				}
			} else {

			        $this->form_error = error::_error($post->errors());
			}
		}		
			$this->template->content = new View("themes/".THEME_NAME."/subscribe");
	}
	
	/** SUBSCRIBE CATEGORY **/
	
	public function subscribe_category()
	{
	    $this->home = new Home_Model();
		$this->products_details = $this->home->products_details();
		$this->deals_details = $this->home->deals_details();
		$this->auction_details = $this->home->auction_details();
	        if($_POST){
			$this->user_Post = $this->input->post('subscribe_email');
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
				    ->add_rules('subscribe_email','required','valid::email');
			if($post->validate()){
			$status = $this->users->subscribe_category(arr::to_object($this->userPost));
				    if($status == 1){
				            common::message(1,$this->Lang['THANK_SUBSCRI']);
				            url::redirect($_SERVER['HTTP_REFERER']);			        
				    }
			}
			else if($this->user_Post==''){
			    common::message(-1, $this->Lang['EMAIL_REQ']);
			}
			else if($this->user_Post!='valid::email'){
			    common::message(-1, $this->Lang['ENTER_EMAIL']); 
			}
			url::redirect($_SERVER['HTTP_REFERER']);
		}		
		$this->template->content = new View("themes/".THEME_NAME."/home");	
	}
	
	/*  UPDATE USER NAME */
	public function edit_user_name()
	{ 
		if(!$this->UserID){			
			url::redirect(PATH); 	
		}
		$user_id = $this->input->get("user_id"); 						
		$followup_record = $this->users->get_edit_name($user_id);	
		exit;	

	}
	
	public function shipping_address()
	{
		
		if(!$this->UserID){
			url::redirect(PATH);
		}        
		if($_POST){
					$this->userPost = $this->input->post();
					$post = new Validation($_POST);
					$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('firstname','required','chars[a-zA-Z_ -.,%\']')
						->add_rules('address1','required')
						->add_rules('address2','required')
						->add_rules('country','required')
						->add_rules('city','required')
						->add_rules('state','required')
						->add_rules('zip_code','required','chars[0-9]')
						->add_rules('mobile','required',array($this, 'validphone'), 'chars[0-9-+().]');
			if($post->validate()){
				$status = $this->users->update_shipping_address(arr::to_object($this->userPost));
				if($status == 1){
					common::message(1, $this->Lang['SHIPP_UPDATE_SUCC']);
					url::redirect(PATH."users/my-shipping-address.html");
				}
			} else { 
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->shipping=1;
		$this->country_list = $this->users->getcountrylist();
		$this->user_detail = $this->users->get_user_data_list();
		$this->template->title = $this->Lang["MY_SHIPPING_ADD"]." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/users/shipping_info");
	}
	
	/** CITY SELECT SCRIPT  **/
			
	public function CitySelection($country = "")
	{
		if($country == -1){
			$list = '<td><label>'.$this->Lang["SEL_CITY"].'*</label></td><td><label>:</label></td><td><select name="city">';
			$list .='<option value=" " >'.$this->Lang["CITY_FIRST"].'</option>';
			echo $list .='</select></td>';
		exit;
		}
		else{
		
		        $CitySlist = $this->users->get_city_by_country($country);
		        if(count($CitySlist) == 0){
		                $list = '<td><label>'.$this->Lang["SEL_CITY"].'*</label></td><td><label>:</label></td><td><select name="city">';
			        $list .='<option value="">'.$this->Lang["NO_CITY"].'</option>';
			        echo $list .='</select></td>';
		                exit;
		        }
		        else{
		                foreach($CitySlist as $s) {	
		                if($s->city_id != 0)
		                {
		                $list = '<select name="city">';
                                    
                                    } 
                                }
		                foreach($CitySlist as $s){
			
			                $list .='<option value="'.$s->city_id.'">'.ucfirst($s->city_name).'</option>';
		                }
		                echo $list .='</select>';
		                exit;
		          }
		}
	}
	/* UPDATE GENDER */
	public function update_gender()
	{ 

		if(!$this->UserID){			
			url::redirect(PATH); 	
		}
		
		$gender = $this->input->get("gender");
		$user_record = $this->users->update_gender($gender);	
		exit;	
	}
	/* UPDATE AGE RANGE  */
	public function update_age_range()
	{ 

		if(!$this->UserID){			
			url::redirect(PATH); 	
		}
		
		$update_age_range = $this->input->get("age_range");
		$user_record = $this->users->update_agerange($update_age_range);	
		exit;	
	}
	
	/** GETTING EMAIL ID WHILE SIGNIG UP VIA FB **/
	
	public function fbsignup()
	{
		$user_email = $this->input->get("email"); 						
		$this->session->set("fb_email", $user_email);
				  
			exit;
	}
	
	/** UPDATING UNIQUE IDENTIFIER **/
	public function update_unique_identifier()
	{
		 
		 if(!$this->UserID){			
			url::redirect(PATH); 	
		}
		
		$unique_identifier = $this->input->get("unique_identifier");
		
		$user_record = $this->users->update_unique_identifier($unique_identifier);	
		exit;	
	}
	
	public function user_subscriber(){
		$email=$this->input->get('email');
		$this->add_email_subscriber=$this->users->add_email_subscriber($email);
		if($this->add_email_subscriber==1)
		{
			common::message(1, $this->Lang['YOU_SUBSCRIBE_SUCCESS']);
		}
		echo "1";
		exit;
	}
	
	/* STORE CREDITS PURCHASE */
	public function my_storecredits($page = "")
	{
		if(!$this->UserID || !$this->session->get('user_auto_key')){
			url::redirect(PATH);
		}
		$count= $this->users->user_storecredit_list_count();
		$this->pagination = new Pagination(array(
				'base_url'       => 'users/my-storecredit-purchase.html/page/'.$page,
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 15, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));

		$this->user_storecredit_list= $this->users->user_storecredit_list($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->title = $this->Lang["STR_CRD_PURCH"]." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/users/my_storecredit_list ");
		
	}
	
	/* STORE CREDITS LIST */
	public function my_storecredits_list($page = "")
	{
		if(!$this->UserID || !$this->session->get('user_auto_key')){
			url::redirect(PATH);
		}
		$count= $this->users->storecredit_list_count();
		$this->pagination = new Pagination(array(
				'base_url'       => 'users/my-storecredits.html/page/'.$page,
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 15, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));

		$this->user_storecredit_list= $this->users->storecredit_list($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->title = $this->Lang["STR_CRD_PURCH"]." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/users/my_storecredit_approve_list");
		
	}
	
	
	
	
	 

		  /*   
		   * ZENITH BANK GETTING BRANCH LIST AS AN ARRAY KEY=BRANCH CODE, VALUE=DEESCRIPTION
		   * @param None
		   */
		   
		   /*
		   		TODO
				Need to handle different API response other than
				the user normal/error response.
				@Live
		   */
		  public function club_registration_get_branch_list(){
			
			  $arg = array();
			  $arg['userName'] = ZENITH_TEST_USER;
			  $arg['Pwd'] = ZENITH_TEST_PASS;
			  $soap = new SoapClient(ZENITH_TEST_ENDPOINT);
			  $fun_resp_branch = $soap->getBranchList($arg);
			  
			  echo '<?xml version="1.0" encoding="utf-8"?>

<branches>';
  foreach($fun_resp_branch->getBranchListResult->Branches as $branch){
  echo "
  <branch>
    <branch-name>".$branch->BranchName."</branch-name>
    <branch-no>".$branch->BranchNo."</branch-no>
  </branch>
  ";
  }
  
  echo '</branches>
';
  
  exit(0);
  
  }
  
  
   /*
  * ZENITH BANK GETTING ACCOUNT CLASS AS AN ARRAY KEY=CODE, VALUE=DEESCRIPTION
  * @param None
  */
  public function club_registration_get_account_class(){
  $arg = array();
  $arg['userName'] = ZENITH_TEST_USER;
  $arg['Pwd'] = ZENITH_TEST_PASS;
  $soap = new SoapClient(ZENITH_TEST_ENDPOINT);
  $fun_resp_class = $soap->getAccountClass($arg);
  
  echo '
  <?xml version="1.0" encoding="utf-8"?>
  <classes>';
  
  foreach($fun_resp_class->getAccountClassResult->ClassCode as $class){
  
  //$ret[$value->ClassCodes] = $class->ClassName;
  
  echo "<class>
    <class-name>".$class->ClassName."</class-name>
    <class-code>".$class->ClassCodes."</class-code>
    </class>";
  
  
  }
  echo '</classes>
';
  
  exit;
  }
  
  

  public function club_open_bank_account_user($status = NULL){
  
  //before attempting to open this account for this user
  //need to check if user already created an account with this platform before
  
  /*
  Below code prunned for controller
  @Live
  */
  
  /*
  $result = $this->db->query("SELECT * FROM zenith_opened_account WHERE user_id=".$this->UserID);
  if(count($result) > 0){
  return -1;//user already opened account with this platform in the past
  }
  */
  
    /*
  TODO
  Need to internationalize this error message.
  @Live
  */
  
  
  if($status && strcmp($status, "1") == 0){
  
		common::message(1, "Thank you! Your Zenith bank account has been successfully created. please check it out in your profile.");
		$urlreferer = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:PATH;
		url::redirect($urlreferer);
  
  }elseif($status && strcmp($status, "-1") == 0){
  
		common::message(-1, "Sothing wen't wrong when openning up a Zenith bank account. Please try again.");
		url::redirect(PATH);
  
  }elseif($status){
	  
	 
  
	  /* 
	  TODO
	  *	Faking account creation due to a down API endpoint
	  *
	  *	@Live
	  */
	  
	  
	  
	  $account_number = "7767565657";
	  $account_name 	= "DUMMY NAME";
	  $account_class  = "57";
	  
	  $params = array('account_number'=>$account_number, 'account_name'=>$account_name, 'account_class'=>$account_class,);
	  $update_status = $this->users->update_user_to_club_membership(TRUE, $params);	
	  //common::message(1, '(MOCK NOTIFICATION) Your Bank Account has been created successfully.Thanks for choosing Zenith bank.');
	  common::message(-1, $status);
	  url::redirect(PATH);
  
  }
  
 
  
  if($_POST){
  
  
  $userPost = $this->input->post();
  $testPost = Validation::factory($userPost)
 			 ->add_rules('f_name', 'required')
 			 ->add_rules('l_name', 'required')
 			 ->add_rules('email', 'required','valid::email')
 			 ->add_rules('phone', 'required', array($this, 'validphone'), 'chars[0-9-+().]')
 			 ->add_rules('addr', 'required')
  			 ->add_rules('gender', 'required',  array($this, 'no_minus_99'))
  			 ->add_rules('branch_no', 'required', array($this, 'no_minus_99'))
 		     ->add_rules('class_code', 'required', array($this, 'no_minus_99'));
			
  
  
  
  if($testPost->validate()){
  		
		
		$post = arr::to_object($userPost);
		$arg = array();
		$arg['userName'] = ZENITH_TEST_USER;
		$arg['Pwd'] = ZENITH_TEST_PASS;
		
		$arg['FirstName'] = $post->f_name;
		$arg['LastName'] = $post->l_name;
		$arg['EmailAddress'] = $post->email;
		$arg['MobilePhoneNo'] = $post->phone;
		$arg['AddressLine'] = $post->addr;
		$arg['Sex'] = $post->gender;
		$arg['Branchno'] = $post->branch_no;
		$arg['ClassCode'] = $post->class_code;
		
		
  
		$soap = new SoapClient(ZENITH_TEST_ENDPOINT);
		$mtds = $soap->__getFunctions();
		$fun_resp = $soap->CreateAccount($arg);
 		$response = (array)$fun_resp->CreateAccountResult;
		$err = (isset($response['errorMessage']))?-1:1;
		
		if($err == -1){
			
			echo $err;
			exit;
			
		}
		
		$r = $this->users->update_user_to_club_membership(TRUE, $response);
		if($r == 1){
			echo $r;
			common::message(1, "Thank you! Your Zenith bank account has been successfully created. please check it out in your profile.");
			$urlreferer = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:PATH;
			url::redirect($urlreferer);
			exit;
			
		}else{
			echo -2;
		}
		exit;
				
  }else{
	  
		/*
			Invalid data in fields.
			@Live
		*/
	
			echo "<xml >";
			echo "<root>";
			echo "<errors>";
  
			foreach($this->form_error = error::_error($testPost->errors()) as $key => $value){;
			
				
				echo "<error key = \"".$key."\" value = \"".$value."\" />";
		
				
					
		
			}
			
			echo "</errors>";
			echo "</root>";
			
			
			exit;
			
	  
	  
 		 }
  
  
 	 }
  
  }
  
   /*
		  * ZENITH BANK VALIDATE ACCOUNT NUMBER FOR LOGGED IN USERS IF VALIDATION IS SUCCESSFUL
		  * WE UPDATE THE DB AND FLAG USER ROW AS A CLUB MEMBER AND INSERT USER'S 
		  * @param NUBAN provided
		  */
		  
		  /*
			  TODO
			  Need to validate inputs here.
			  I also don't see the need of passing $nuban in a post request.
			  $nuban should be sent as a value in post. 
			  @Live
		  */
		  public function club_registration_logged_in_user(){  
		  
		  		
		  
		  if($_POST){
			  $nuban = $this->input->post('nuban');
			  if($this->session->get("Club") == 1){
				
				  echo -1; //user is club member already.
				  exit(0);
			  }
			  else{
				 
				  $arg = array();
				  $arg['userName'] = ZENITH_TEST_USER;
				  $arg['Pwd'] = ZENITH_TEST_PASS;
				  $soap = new SoapClient(ZENITH_TEST_ENDPOINT);
				  $arg['account_number'] = $nuban;
				  $fun_resp = $soap->VerifyAccount($arg);
				  
				  $response = (array)$fun_resp->VerifyAccountResult;
					  if($response){
						  $nuban_response = (isset($response['errorMessage']))?-1:1;
						 
						  if($nuban_response == 1){
							  
							   $r = $this->users->update_user_to_club_membership(FALSE, $arg);
								common::message(1, "Thank you for signup! You can now enjoy club membership offers.");
								if($r == 1){
									 $urlreferer = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:PATH;
									 echo $urlreferer;
									 exit;
								}else{
									
									echo -2;
								}
								
								exit;	
							  
						  }
					  }
						  echo -1;
						  exit;
				 
			  }
			  
			 }
		  }
		  
  
  
    public function no_minus_99($sel_option = ""){
		 
		  
		  if(!$sel_option){
			  return 0;
		  }
		  
		  $sel_option = trim($sel_option);
		  
		  if($sel_option == "" || $sel_option == "0" || $sel_option == "-99" ){
			  return 0;
		  }
		  
		  return 1;
		  
	  }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
