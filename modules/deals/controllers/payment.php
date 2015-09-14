<?php defined('SYSPATH') OR die('No direct access allowed.');
class Payment_Controller extends Layout_Controller {

	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{	        
		parent::__construct();
		$this->users = new Users_Model();
		$this->payment = new Payment_Model();
		$this->UserID = $this->session->get("UserID");
		/*if(LANGUAGE == "french" ){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/french_style.css',PATH.'themes/'.THEME_NAME.'/css/fr_multi_style.css')); 
		}else if(LANGUAGE == "spanish"){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/spanish_style.css',PATH.'themes/'.THEME_NAME.'/css/sp_multi_style.css'));
		} else {
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}*/
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
		$this->template->javascript .= html::script(array(PATH.'themes/'.THEME_NAME.'/js/buy.js',PATH.'themes/'.THEME_NAME.'/js/jquery.validate.js'));
	}
	/** USER SIGNUP **/
	
	public function signup_user()
	{
	  
	        $user_referral_id = $this->session->get("User_Referral_ID");

                if($_POST){

			$this->userPost = $this->input->post();
			$this->url_title = $this->input->post("url_title");
			$this->deal_key = $this->input->post("deal_key");
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('f_name', 'required', 'chars[a-zA-Z_ -.,%\']')
						->add_rules('email', 'required','valid::email', array($this, 'email_available'))
						->add_rules('password', 'required','length[5,32]')
						->add_rules('cpassword', 'required','length[5,32]')
						->add_rules('city', 'required')
						->add_rules('country', 'required');
			if($post->validate()){
			        $referral_id = text::random($type = 'alnum', $length = 8);
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
				        $this->users->login_users($this->email,$this->password);
				$status = $this->users->add_users(arr::to_object($this->userPost),$referral_id,$user_referral_id);
				$status_login = $this->users->login_users($this->email,$this->password);
				if($status == 1){
				    common::message(1, $this->Lang["SUCC_SIGN"]);
				    url::redirect(PATH.'deal/payment_details/'.$this->deal_key.'/'.$this->url_title.'.html');
				}
			}
			else{

			$this->form_error = error::_error($post->errors());

				$this->deals_payment_deatils = $this->payment->get_deals_payment_details($this->deal_key, $this->url_title);
				if(count($this->deals_payment_deatils)==0){
					common::message(-1, $this->Lang["THE_DEAL_SOLD_OUT"]);
					url::redirect(PATH."today-deals.html");
				}
				
			}
			$this->template->content = new View("themes/".THEME_NAME."/payment_login");

		}
	}

    	/** USER  LOG IN **/

	public function login()
	{
	        if($this->UserID ){
			url::redirect(PATH);
		} 
		else{
			if($_POST){
			    

				$url_title = $this->input->post("url");
				$deal_key = $this->input->post("dealid");
				$email = $this->input->post("email");
				$password = $this->input->post("password");
				if(!$email || !$password){
					 common::message(-1,$this->Lang["EMAIL_REQUIRED"]);
				}
				elseif(!valid::email($email)){
					common::message(-1, $this->Lang["INVAL_EMAIL"]);
				}
				else{
					$status = $this->users->login_users($email,$password);
			
					if($status == 1){
					    url::redirect(PATH.'deal/payment_details/'.$deal_key.'/'.$url_title.'.html');
					}
					else if($status == 8){
						 common::message(-1, $this->Lang["USER_BLOCKED"]);
					}
					else{
						common::message(-1,$this->Lang["DOESNOT_MATCH"]); 
					 }
				}
				url::redirect(PATH.'deals/p/'.$deal_key.'/'.$url_title.'.html');
			}
		}		 
	}
	
	/** DEALS PAYMENT PAGE **/
	
	public function payment_deals($deal_key = "", $url_title = "")
	{	
		if($this->UserID) {
			url::redirect(PATH.'deal/payment_details/'.$deal_key.'/'.$url_title.'.html');
		}
		$this->deals_payment_deatils = $this->payment->get_deals_payment_details($deal_key, $url_title);
		if(count($this->deals_payment_deatils)==0){
			common::message(-1, $this->Lang["THE_DEAL_SOLD_OUT"]);
			url::redirect(PATH."today-deals.html");
		}
		$this->template->content = new View("themes/".THEME_NAME."/payment_login");
	}

	/** DEALS PAYMENT PAGE **/
	
	public function payment_details($deal_key = "", $url_title = "")
	{		
	      
		if(!$this->UserID) {
			url::redirect(PATH.'deals/p/'.$deal_key.'/'.$url_title.'.html');
		}
	        $this->deals_payment_deatils = $this->payment->get_deals_payment_details($deal_key, $url_title);
	        
	        if(count($this->deals_payment_deatils)==0){ 
		        common::message(-1, $this->Lang["PAGE_NOT"]);
		        url::redirect(PATH);
		}
		$this->user_referral_balance = $this->payment->get_user_referral_balance_details();
		$this->get_user_limit_count = $this->payment->get_user_limit_details($this->deals_payment_deatils->current()->deal_id);
		if($this->get_user_limit_count >= $this->deals_payment_deatils->current()->user_limit_quantity ){
			common::message(-1, $this->Lang["YOUR_PURCH_CROSSED"]);
		        url::redirect(PATH);
		}
	        $this->template->content = new View("themes/".THEME_NAME."/payment");
	}  
	
	
	/** DEALS PAYMENT PAGE FOR FRIEND**/
	
	public function payment_details_friend($deal_key = "", $url_title = "")
	{		
	      
		if(!$this->UserID) {
			url::redirect(PATH.'users/login');
		}
	        $this->deals_payment_deatils = $this->payment->get_deals_payment_details($deal_key, $url_title);
	        
	        if(count($this->deals_payment_deatils)==0){
		        common::message(-1, $this->Lang["PAGE_NOT"]);
		        url::redirect(PATH);
		}
		foreach($_SESSION as $key=>$value) 
                {
                        if(($key=='product_cart_id'.$value)){                   
                                $deal_id = $_SESSION[$key];
                                $item_qty = $this->input->post($key);	
                                $this->session->set('product_cart_qty'.$deal_id,$item_qty);
                                $this->session->set('shipping_name',$this->input->post('shipping_name'));
                                $this->session->set('shipping_address1',$this->input->post('address1'));
                                $this->session->set('shipping_address2',$this->input->post('address2'));
                                $this->session->set('shipping_country',$this->input->post('country'));
                                $this->session->set('shipping_state',$this->input->post('state'));
                                $this->session->set('shipping_city',$this->input->post('city'));
                                $this->session->set('shipping_postal_code',$this->input->post('postal_code'));
                                $this->session->set('shipping_phone',$this->input->post('phone'));
                                
                        }
                }
		$this->user_referral_balance = $this->payment->get_user_referral_balance_details();
		$this->get_user_limit_count = $this->payment->get_user_limit_details($this->deals_payment_deatils->current()->deal_id);
		if($this->get_user_limit_count >= $this->deals_payment_deatils->current()->user_limit_quantity ){
			common::message(-1, $this->Lang["YOUR_PURCH_CROSSED"]);
		        url::redirect(PATH);
		}
	        $this->template->content = new View("themes/".THEME_NAME."/payment");
	} 
	
	/** REFERRAL PAYMENT  **/
	
	public function referral_payment()
	{ 
	       if($_POST){
			
			$deal_id = $this->input->post("deal_id");
			$deal_key = $this->input->post("deal_key");
			$referral_amount = $this->input->post("p_referral_amount");
			$item_qty = $this->input->post("P_QTY");
			$amount = $this->input->post("amount");
			$friend_name = $this->input->post("friend_name");
			$friend_email = $this->input->post("friend_email");
			$friend_gift_status = $this->input->post("friend_gift");
			
			$this->deals_payment_deatils = $this->payment->get_deals_payments_details($deal_id, $deal_key);
			if(count($this->deals_payment_deatils) == 0){
				common::message(-1, $this->Lang["PAGE_NOT"]);
				url::redirect(PATH);
			}
			
			$this->referral_balance_deatils = $this->payment->get_user_referral_balance_details();
			$this->get_user_limit_details = $this->payment->get_user_limit_details($deal_id);
			$this->user_referral_balance = $this->payment->get_user_referral_balance_details();

			foreach($this->deals_payment_deatils as $UL) {
				$purchase_qty = $UL->purchase_count;
				$max_user_limit = $UL->user_limit_quantity;
				$min_deals_limit = $UL->minimum_deals_limit;
				$deal_price = $UL->deal_value;
				$deal_title = $UL->deal_title;
				$merchant_id = $UL->merchant_id;
			}

			if($referral_amount > $this->referral_balance_deatils || $amount < 0 || ($deal_price * $item_qty) != $referral_amount){
				common::message(-1, $this->Lang["INVALID_REF_AMONT"]);
				url::redirect(PATH);
			}

			if(($this->get_user_limit_details + $item_qty) > $max_user_limit){
				common::message(-1, $this->Lang["MAX_PURCH_LIMIT"]);
				url::redirect(PATH);
			}
			
			if(($purchase_qty + $item_qty) >= $min_deals_limit){
				$captured = 0;
			}
			else{
				$captured = 1;
			}
			   
	        $this->result = $this->payment->insert_referral_tranasaction($referral_amount, $item_qty, $deal_id, $purchase_qty, $friend_name, $friend_email, $friend_gift_status,$merchant_id); 
	                  
			$this->get_user_details = $this->payment->get_user_details();
			foreach($this->get_user_details as $U){ 

				if($U->referred_user_id && $U->deal_bought_count == $item_qty){
					$update_reff_amount = $this->payment->update_referral_amount($U->referred_user_id);
				} 
                if($U->facebook_update == 1 ){
                        foreach($this->deals_payment_deatils as $D){
                        $dealURL = PATH.$D->store_url_title."/deals/".$D->deal_key.'/'.$D->url_title.".html";

                        $message = $this->Lang['PURS_DEAL'].$D->deal_title." ".$dealURL.$this->Lang['LIMIT_OFF'];
                        $post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");							
                        common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg);

                        }
                }
				
	            $this->transaction_mail = array("deal_title" => $deal_title, "item_qty" => $item_qty ,"total" => $referral_amount ,"ref_amount"=> $referral_amount,"amount"=> $amount,"value"=>$deal_price,"friend_name"=>$friend_name);
	            $this->result_mail = arr::to_object($this->transaction_mail);
				/* Mail template */
				$from = CONTACT_EMAIL;
				$subject = $this->Lang['THANKS_BUY'];
				$message = new View("themes/".THEME_NAME."/payment_mail");


				if($captured == 0){
				        pdf::pdf_created($this->result);
				        $count= count($this->result);
				        $file=array();
				        for($i=0; $i < $count; $i++){
				                array_push($file, "images/pdf/Voucher".$i.".pdf");
				        }
				        email::sendgrid_attach($from, $U->email, $subject ,$message,$file);
												
				        for($i=0; $i < $count; $i++){
				                unlink("images/pdf/Voucher".$i.".pdf");
				        }
				}  else {
					if(EMAIL_TYPE==2){
						if($friend_gift_status ==1) {
							$subject = $this->Lang['FRI_SUB'];
							
							 $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail"); 
							email::smtp($from, $friend_email, $subject, $friend_message);
						} else {
							email::smtp($from, $U->email, $subject, $message);
						}
					}else{
						if($friend_gift_status ==1) {
							$subject = $this->Lang['FRI_SUB'];
							 $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail"); 	
							email::sendgrid($from, $friend_email, $subject, $friend_message);
						} else {
							email::sendgrid($from, $U->email, $subject, $message);
						}
					}
				}
				
             }
             $this->transaction_result = array("TIMESTAMP" => date('m/d/Y h:i:s a', time()), "ACK" => "Success" ,"AMT"=> $referral_amount);
	                $this->result_transaction = arr::to_object($this->transaction_result);
	                $this->session->set('payment_result', $this->result_transaction);
	                url::redirect(PATH.'transaction.html');
			
	       }
	} 	
	
	/** PAYMENT STATS AFTER PAYMENT PROCESS COMPLETE **/
		
	public function success()
	{
	        $this->result = $this->session->get('payment_result');
		if(!$this->result){
			url::redirect(PATH);
		}
	        $this->session->delete('payment_result');
			
		$this->template->content = new View("themes/".THEME_NAME."/success_payment");
	}
	
	 /** CHECK EMAIL EXIST **/

	public function email_available($email)
	{
	    if($email == $this->session->get('user_email')){
	    $exist = 0;
	    }else{
		
		$exist = $this->users->exist_email($email);
		}
		return ! $exist;
	}			
}
