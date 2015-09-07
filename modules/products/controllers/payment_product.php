<?php defined('SYSPATH') OR die('No direct access allowed.');
class Payment_product_Controller extends Layout_Controller {

	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->users = new Users_Model();
		$this->payment_products = new Payment_product_Model();
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

	/** PRODUCTS USER SIGNUP **/

	public function p_signup()
	{
	        if($this->UserID ){
			url::redirect(PATH);
		}
	        $user_referral_id = $this->session->get("User_Referral_ID");
                if($_POST){
			$this->userPost = $this->input->post();
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
				$status = $this->users->add_users(arr::to_object($this->userPost),$referral_id,$user_referral_id);
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
				        $this->users->login_users($this->email,$this->password);
				        common::message(1, $this->Lang["SUCC_SIGN"]);
				        url::redirect(PATH.'cart.html');
				}
			} else {
				$this->form_error = error::_error($post->errors());
				$this->template->content = new View("themes/".THEME_NAME."/products/cart_login");
			}
		}
	}

    /* PRODUCT USER LOGIN **/

	public function p_login()
	{
	        if($this->UserID ){
			url::redirect(PATH);
		}
		else{
			if($_POST){
				$email = $this->input->post("email");
				$password = $this->input->post("password");
				if(!$email || !$password){
					 common::message(-1, $this->Lang["EMAIL_REQUIRED"]);
				}
				elseif(!valid::email($email)){
					 common::message(-1, $this->Lang["INVAL_EMAIL"]);
				} else {
					$status = $this->users->login_users($email,$password);
					if($status == 1){
					    common::message(1, $this->Lang["SUCC_LOGIN"]);
					    url::redirect(PATH.'cart.html');
					}
					else if($status == 8){
						 common::message(-1, $this->Lang["USER_BLOCKED"]);
					}
					else{
						common::message(-1,$this->Lang["DOESNOT_MATCH"]);
					 }
				}
				url::redirect(PATH.'cart.html');
			}
		}
	}
	
	public function CitySelectionPayment($country = "")
	{
		if($country == -99 || $country == -1 || $country == ""){
			$list = '<select name="city" class="CityPAY select required" >';
			$list .='<option value="" >'.$this->Lang["COUNTRY_FIRST"].'</option>';
			echo $list .='</select>';
		exit;
		} else {
		        $CitySlist = $this->payment_products->get_city_by_country_pay($country);
		        if(count($CitySlist) == 0){
		                $list = '<select name="city"  class="select required" >';
			        $list .='<option value="">'.$this->Lang["CITY_FIRST"].'</option>';
			        echo $list .='</select>';
		                exit;
		        } else {
		                foreach($CitySlist as $s) {	
                                        if($s->city_id != 0)
                                        {
                                                $list = '<select name="city" class="CityPAY" >';
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


        public function CitySelectionPaymentstep($country = "")
	{
		if($country == -1 || $country == "" ){
			//$list = '<td><label>'.$this->Lang["SEL_CITY"].'*</label></td><td><label>:</label></td><td><select name="city" class="CityPAY select required" >';
			$list ='<option value="" >'.$this->Lang["COUNTRY_FIRST"].'</option>';
			//echo $list .='</select></td>';
			echo $list .='';
		exit;
		} else {
		        $CitySlist = $this->payment_products->get_city_by_country_pay($country);
		        if(count($CitySlist) == 0){
			        $list ='<option value="">'.$this->Lang["CITY_FIRST"].'</option>';
			        echo $list .='';
		                exit;
		        } else {
		                foreach($CitySlist as $s) {	
                                        if($s->city_id != 0)
                                        {
                                                $list = '<select name="city" class="CityPAY" >';
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
	/** PRODUCTS ITEM ADDED  **/

	public function cart_items()
	{
            $product_cart_id = $this->input->get('deal_id');
            $this->product_details=$this->payment_products->get_product_details_cart($product_cart_id);
            $store_url_title=$this->product_details->current()->store_url_title;
            $deal_key=$this->product_details->current()->deal_key;
            $url_title=$this->product_details->current()->url_title;
            $count_value = $this->session->get('count')+1;
                    foreach($_SESSION as $key=>$value)
                    {
                               if(($key=='product_cart_id'.$product_cart_id)){
				        common::message(1, $this->Lang['ALDY_EX']);
					 url::redirect( PATH .$store_url_title. '/product/' . $deal_key . '/' . $url_title . '.html');
                              }
                    }
	        $this->session->set('count',$count_value);
	        $this->session->set('product_cart_id'.$product_cart_id,$product_cart_id);
	        common::message(1, $this->Lang['CART_PRODUCT_SUCCESS']);
	       
	        url::redirect( PATH .$store_url_title. '/product/' . $deal_key . '/' . $url_title . '.html');
	}

	/** PRODUCTS ITEM REMOVED **/

	public function cart_remove($product_cart_id)
	{
	        $val = 1; 
	        
			
	        $deal_id = substr($product_cart_id,15);
                foreach($_SESSION as $key=>$value)
                {
                        if ((is_string($value)) && ($key == 'product_cart_id' . $deal_id)) {
                                $val = 2;
                                $deal_id = substr($product_cart_id,15);
									foreach($_SESSION as $key=>$value){
										 if(($key=='store_credit_id'.$deal_id)){
											  $this->session->delete('store_credit_id'.$deal_id);
										}
										if(($key=='store_credit_period'.$deal_id)){
											 $this->session->delete('store_credit_period'.$deal_id);
										}
										
									}
									
									
                                $count_value = $this->session->get('count')-1;
                                $this->session->delete($product_cart_id);
                                $this->session->delete('product_size_qty'.$deal_id);
                                $this->session->delete('product_quantity_qty'.$deal_id);
                                $this->session->delete('product_color_qty'.$deal_id);
                                 $this->session->delete('product_cart_qty'.$deal_id);
                                $this->session->set('count',$count_value);
                                $va = 0;
                                foreach($_SESSION as $key=>$value)
								{  
									$sto = substr($key,0,15);
									 if ($sto == 'store_credit_id') {
										  $va = 1;
									 }
								}
								
								if ($va == 0) {
									  $this->session->delete('is_store_credit');
								 } else {
									 $this->session->set('is_store_credit',1);
								 }
                                common::message(1, $this->Lang['CART_RMV']);
                                url::redirect(PATH."cart.html");
                        } 
                }
                if($val == 1){
                        common::message(-1, $this->Lang['NO_DATA_F']);
                        url::redirect(PATH."cart.html");
                }
                    
	}

	/** LOGIN TO REDIRECT TO CART PAGE **/

	public function cart_products_item()
	{
	     if($this->UserID){
	        $this->payment = new Payment_Model();
	        $this->get_cart_products_list = $this->payment_products->get_cart_products();
		$this->shipping_address = $this->payment_products->get_user_data_list();
	        $this->user_referral_balance = $this->payment->get_user_referral_balance_details();
	        $this->template->content = new View("themes/".THEME_NAME."/products/cart");
	     } else {
	        $this->template->content = new View("themes/".THEME_NAME."/products/cart_login");
	     }
	}

	/** LOGIN TO REDIRECT TO CART CHECKOUT PAGE **/

	public function cart_checkout_item()
	{
		if(!$this->UserID){
			url::redirect(PATH."prodicts/cart.html");
		}
		if($this->session->get('count') == 0){
			url::redirect(PATH."prodicts/cart.html");
		}
		$total_amount=0;
		$product_qty = 0;
		$duration_period = 0;
		$installment_value = 0;
		
		
		foreach($_SESSION as $key=>$value) 
		{
			if(($key =='product_cart_id'.$value)){                   
				$product_id = $_SESSION[$key];
				$item_qty = $this->input->post($key);
				foreach($_SESSION as $key=>$value) {
					if($key=='store_credit_id'.$product_id) {
						$durationid = $value;	 
						$this->store_credits_products = $this->payment_products->get_store_credits_product($product_id,$durationid);
						
						foreach($this->store_credits_products as $UL){
							$deal_key  = $UL->deal_key;
							$deal_value = $UL->deal_value;
							$merchant_id = $UL->merchant_id;
							$product_shipping = $UL->shipping_amount;
							$shipping_methods = $UL->shipping;
						}
						if($shipping_methods  == 1){
								$shipping_amount = 0;
						}  elseif($shipping_methods  == 2){
								$merchant_flat_amount = $this->payment_products->get_userflat_amount($merchant_id);
								$shipping_amount = $merchant_flat_amount->flat_amount;
						} elseif($shipping_methods  == 3){
								$shipping_amount =$product_shipping;
						} elseif($shipping_methods  == 4){
								$shipping_amount =$product_shipping*$item_qty;
						} elseif($shipping_methods  == 5){
								 $shipping_amount = 0;
						}
						foreach($_SESSION as $key=>$value) {
							if(($key=='store_credit_period'.$product_id)){
								$duration_period = $value;
							} 
						}
						$total_amount = ($deal_value*$item_qty)+$shipping_amount;
						$installment_value += $total_amount/$duration_period;
						//echo $deal_value." ".$item_qty." ".$shipping_amount;
						
					}
				}
			}
		} 

		if($installment_value>0 && MONTHLY_INSTALLMENT_LIMIT>0) {
			$check_installment_exceeds = $this->payment_products->check_user_instalment_limit($installment_value);
			if($check_installment_exceeds==-1) {
				common::message(-1,"Users not exists");
				url::redirect(PATH."cart.html");
			} else if($check_installment_exceeds >=0) {
				common::message(-1,"Oops! it seems you have exceeded your limit for store credit, please try again or select a cheaper product");
				url::redirect(PATH."cart.html");
			}
		}
		$normal_product =0;
		//print_r($_SESSION);
		foreach($_SESSION as $key=>$value) 
                {
                        if(($key=='product_cart_id'.$value)){                   
                                $deal_id = $_SESSION[$key];
                                $item_qty = $this->input->post($key);	
                                
                                if(!$this->session->get("store_credit_id".$deal_id)) {
									$normal_product =1;
								}
                                $this->session->set('product_cart_qty'.$deal_id,$item_qty);
                                $this->session->set('shipping_name',$this->input->post('shipping_name'));
                                $this->session->set('shipping_address1',$this->input->post('address1'));
                                $this->session->set('shipping_address2',$this->input->post('address2'));
                                $this->session->set('shipping_checkbox',$this->input->post('shipping_checkbox'));
                                $this->session->set('shipping_country',$this->input->post('country'));
                                $this->session->set('shipping_state',$this->input->post('state'));
                                $this->session->set('shipping_city',$this->input->post('city'));
                                $this->session->set('shipping_postal_code',$this->input->post('postal_code'));
                                $this->session->set('shipping_phone',$this->input->post('phone'));
                                $this->deals_payment_deatils = $this->payment_products->get_product_payment_details($deal_id);
									
                                foreach($_SESSION as $key=>$value) {
									$product_color = 0;
									$product_size = 0;
									$durationid = 0;
									$duration_period = 0;
									$product_qty = 0;
									$storecredit_document="";
									$installment_value = 0;
									$total_amount=0;
									
									if($key=='store_credit_id'.$deal_id) {
										$this->session->set('is_store_credit',1);
										$durationid = $value;	 
										$this->store_credits_products = $this->payment_products->get_store_credits_product($deal_id,$durationid);
										
										foreach($this->store_credits_products as $UL){
											$deal_key  = $UL->deal_key;
											$deal_value = $UL->deal_value;
											$merchant_id = $UL->merchant_id;
											$product_shipping = $UL->shipping_amount;
											$shipping_methods = $UL->shipping;
										}
											if($shipping_methods  == 1){
													$shipping_amount = 0;
											}  elseif($shipping_methods  == 2){
													$merchant_flat_amount = $this->payment_products->get_userflat_amount($merchant_id);
													$shipping_amount = $merchant_flat_amount->flat_amount;
											} elseif($shipping_methods  == 3){
													$shipping_amount =$product_shipping;
											} elseif($shipping_methods  == 4){
													$shipping_amount =$product_shipping*$item_qty;
											} elseif($shipping_methods  == 5){
													 $shipping_amount = 0;
											}
										foreach($_SESSION as $key=>$value) {
											if(($key=='store_credit_period'.$deal_id)){
												$duration_period = $value;
											} 
											if(($key=='product_size_qty'.$deal_id)){
												$product_size = $value;
											}
											if(($key=='product_color_qty'.$deal_id)){
												$product_color = $value;
											}
											if(($key=='product_cart_qty'.$deal_id)){
												$product_qty = $value;
											}
										}
										$total_amount = ($deal_value*$product_qty)+$shipping_amount;
										$installment_value = ($total_amount/$duration_period);
										
										$check_storecredit_aldy_exists = $this->payment_products->check_storecredit_already_exits($deal_id,$merchant_id,$durationid,$duration_period,$product_size,$product_color,$product_qty);
										
										if($check_storecredit_aldy_exists==0) {
											if($_FILES){
												$uploaddir = DOCROOT.'images/store_credit/';
												$uploadfile = $uploaddir . basename($this->UserID);
												if (move_uploaded_file($_FILES['storecredit']['tmp_name'], $uploadfile)) {
													
												} 
											}
											$insert_storecredit = $this->payment_products->insert_storecredit_products($deal_id,$deal_value,$product_qty,$merchant_id,$shipping_amount,$shipping_methods,$durationid,$duration_period,$product_size,$product_color,$installment_value);
											
											$this->product_size = $this->payment_products->get_shipping_product_size();
											$this->product_color = $this->payment_products->get_shipping_product_color();
											$this->product_list1 = $this->payment_products->get_products_list($insert_storecredit,$deal_id);
											$this->merchant_details = $this->payment_products->get_merchant_details($merchant_id);
											
											//$this->session->delete("storecredit_document".$deal_id);
											$message_merchant = new View("themes/".THEME_NAME."/store_credits/storecredit_merchant_mail");
											$message_user = new View("themes/".THEME_NAME."/store_credits/storecredit_approvemail");
											
											$user_email = $this->session->get("UserEmail");
											$merchant_email = $this->merchant_details->email;
											$from = CONTACT_EMAIL;
											 if(EMAIL_TYPE==2){
												email::smtp($from,$merchant_email, $this->Lang['THANKS_APPR'] ,$message_merchant);
												email::smtp($from,$user_email, $this->Lang['THANKS_CHOOS'] ,$message_user);
											} else {
												email::sendgrid($from,$merchant_email, $this->Lang['THANKS_APPR'] ,$message_merchant);
												email::sendgrid($from,$user_email, $this->Lang['THANKS_CHOOS'] ,$message_user);
											}
										} else {
											common::message(1,$this->Lang["PRD_ALRD_WAIT"]);
											url::redirect(PATH."cart.html");
										}
									} 
								}
								
                                foreach($this->deals_payment_deatils as $UL){
                                        if($UL->shipping == "5"){
                                        /* Aramex amount calculation start  */ 
                                        $countryurl = url::title($this->input->post('country'));
                                        $getcountrydata = $this->payment_products->getcountrydata($countryurl);
                                        $country_code = $getcountrydata->current()->country_code;
                                       // $address_status = common::address_verification($this->input->post('address1'), $this->input->post('address1'), $this->input->post('postal_code'), $country_code,"");
                                      
                                               // if($address_status->HasErrors != "1"){
                                               // $city_name = common::address_verification($this->input->post('address1'), $this->input->post('address1'), $this->input->post('postal_code'), $country_code,"dfd");
                                                //$user_city = $city_name->SuggestedAddresses->Address->City; 
                                                $user_city = "";
                                                $rates_calculator = common::shipping_rates_calculator($UL->weight, $UL->length, $UL->width, $UL->height, $user_city , $country_code);
                                                $aramex_CurrencyCode  = $rates_calculator->TotalAmount->CurrencyCode;
                                                $aramex_Value  = $rates_calculator->TotalAmount->Value;
                                                $this->session->set('aramex_currencycode'.$deal_id,$aramex_CurrencyCode);
                                                $this->session->set('aramex_value'.$deal_id,$aramex_Value);
                                               // }
                                                /* Aramex amount calculation end  */ 
                                       }
                               }
                        }
                }
		
		$this->get_cart_products_list = $this->payment_products->get_cart_products();
		$this->shipping_address = $this->payment_products->get_user_data_list();
		//echo kohana::debug($_SESSION); exit;
		$this->user_referral_balance = $this->payment_products->get_user_referral_balance_details();
		if($normal_product==0) {
				 foreach($_SESSION as $key=>$value)
					{
						//if(!is_object($value) && !is_array($value)) {
								if((is_string($value)) && ($key=='product_cart_id'.$value)){
								$qty = $this->session->get('product_cart_qty'.$value);
								$deal_id = $_SESSION[$key];
								foreach($_SESSION as $key=>$value)
								{
								if(($key=='product_size_qty'.$deal_id)){
								   unset($_SESSION[$key]);
								}
								if(($key=='product_quantity_qty'.$deal_id)){
								   unset($_SESSION[$key]);
								}
								if(($key=='product_color_qty'.$deal_id)){
									unset($_SESSION[$key]);
								}
								if(($key=='store_credit_id'.$deal_id)){
									  
									unset($_SESSION[$key]);
								}
								if(($key=='store_credit_period'.$deal_id)){
									unset($_SESSION[$key]);
								}
								if(($key=='main_storecreditid'.$deal_id)){
									unset($_SESSION[$key]);
								}
								if(($key=='product_cart_qty'.$deal_id)){
									unset($_SESSION[$key]);
								}

								}
							 }
						//}
				   }

				foreach($_SESSION as $key=>$value)
				{
						if(((is_string($value)) && ($key=='product_cart_id'.$value))){
								unset($_SESSION[$key]);
						}
				}
                $this->session->delete("count");
                $this->session->delete('shipping_name');
                $this->session->delete('shipping_address1');
                $this->session->delete('shipping_address2');
                $this->session->delete('shipping_checkbox');
                $this->session->delete('shipping_country');
                $this->session->delete('shipping_state');
                $this->session->delete('shipping_city');
                $this->session->delete('shipping_postal_code');
                $this->session->delete('shipping_phone');
                $this->session->delete('aramex_currencycode');
                $this->session->delete('aramex_value');
                $this->session->delete('payment_result');
			$this->template->content = new View("themes/".THEME_NAME."/storecredit_success_payment");
		} else {
			$this->template->content = new View("themes/".THEME_NAME."/products/cart_checkout");
		}

	}



	/** PRODUCTS REFERRAL PAYMENT **/

	public function referral_payment_product()
	{

	       if($_POST){
		        $referral_amount = $this->input->post("p_referral_amount");
		        $this->userPost = $this->input->post();
		        foreach($_SESSION as $key=>$value)
                        {
                        if(($key=='product_cart_id'.$value)){
                        $deal_id = $_SESSION[$key];
                        $item_qty = $this->input->post($key);
		                $amount = $this->input->post("amount");

			            $this->deals_payment_deatils = $this->payment_products->get_product_payment_details($deal_id);
			            if(count($this->deals_payment_deatils) == 0){
				            common::message(-1, $this->Lang["PAGE_NOT"]);
				            url::redirect(PATH);
			            }
			            $this->referral_balance_deatils = $this->payment_products->get_user_referral_balance_details();

			            foreach($this->deals_payment_deatils as $UL){
				            $purchase_qty = $UL->purchase_count;
				            $max_user_limit = $UL->user_limit_quantity;
				            $min_deals_limit = $UL->minimum_deals_limit;
				            $deal_amount = $UL->deal_value;
				            $deal_title = $UL->deal_title;
			            }
			            if($amount < 0){
				            common::message(-1, $this->Lang["INVALID_REF_AMONT"]);
				            url::redirect(PATH);
			            }

			            if($referral_amount > $this->referral_balance_deatils ){
				            common::message(-1, $this->Lang["INVALID_REF_AMONT"]);
				            url::redirect(PATH);
			            }

			            $this->get_user_details = $this->payment_products->get_user_details();

                        foreach($this->get_user_details as $U){
                        if($U->referred_user_id && $U->deal_bought_count == "0"){
				        $update_reff_amount = $this->payment_products->update_referral_amount($U->referred_user_id);
			            }

                                if($U->facebook_update == 1 ){
                                        foreach($this->deals_payment_deatils as $D){
                                        $dealURL = PATH."deals/".$D->deal_key.'/'.$D->url_title.".html";

                                        $message = $this->Lang['PURS_DEAL'].$D->deal_title." ".$dealURL.$this->Lang['LIMIT_OFF'];
                                        $post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");
                                        common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg);
                                        }
                                }
                        }

			$this->referral_payment_deatils = $this->payment_products->products_referral_payment_deatils(arr::to_object($this->userPost),$referral_amount,$item_qty,$deal_id,$purchase_qty,$deal_amount);
			 $this->transaction_mail = array("deal_title" => $deal_title, "item_qty" => $item_qty ,"total" => ($deal_amount * $item_qty) ,"ref_amount"=> ($deal_amount * $item_qty),"amount"=> $amount);
                    $this->result_mail = arr::to_object($this->transaction_mail);
                    /* Mail template */
                    $message = new View("themes/".THEME_NAME."/payment_mail");
		    if(EMAIL_TYPE==2){
                    email::smtp($U->email, $this->Lang['THANKS_BUY'] ,$message);
		    }
		   else{
		    email::sendgrid($U->email, $this->Lang['THANKS_BUY'] ,$message);

		   }
                            }
	                }

	                $this->referral_amount_payment_deatils = $this->payment_products->products_referral_amount_payment_deatils($referral_amount);
                        $key_val = "";
                    foreach($_SESSION as $key=>$value)
                        {
                            if(($key=='product_cart_id'.$value)){
                            $qty = $this->session->get('product_cart_qty'.$value);
                            $deal_id = $_SESSION[$key];
                            foreach($_SESSION as $key=>$value)
                            {
                            if(($key=='product_size_qty'.$deal_id)){
                               unset($_SESSION[$key]);
                            }
                            if(($key=='product_quantity_qty'.$deal_id)){
                                unset($_SESSION[$key]);
                            }
                            if(($key=='product_color_qty'.$deal_id)){
                                unset($_SESSION[$key]);
                            }

                            }
                         }
                       }
                        foreach($_SESSION as $key=>$value)
                        {
                                if(($key=='product_cart_id'.$value)){
                                        unset($_SESSION[$key]);
                                }
                        }
                        $this->session->delete("count");
	                    common::message(1, $this->Lang["THANK_FOR_PURCH"]);
                        url::redirect(PATH);
	            }
	      }

	   /* PRODUCT PAYMENT PAYPAL */
	public function cart_payment_paypal()
	{

	            foreach($_SESSION as $key=>$value)
                {
					//if(!is_object($value) && !is_array($value)) {
							if((is_string($value)) && ($key=='product_cart_id'.$value)){
							$qty = $this->session->get('product_cart_qty'.$value);
							$deal_id = $_SESSION[$key];
							foreach($_SESSION as $key=>$value)
							{
							if(($key=='product_size_qty'.$deal_id)){
							   unset($_SESSION[$key]);
							}
							if(($key=='product_quantity_qty'.$deal_id)){
							   unset($_SESSION[$key]);
							}
							if(($key=='product_color_qty'.$deal_id)){
								unset($_SESSION[$key]);
							}
							if(($key=='store_credit_id'.$deal_id)){
								  
								unset($_SESSION[$key]);
							}
							if(($key=='store_credit_period'.$deal_id)){
								unset($_SESSION[$key]);
							}
							if(($key=='main_storecreditid'.$deal_id)){
								unset($_SESSION[$key]);
							}
							if(($key=='product_cart_qty'.$deal_id)){
								unset($_SESSION[$key]);
							}

							}
						 }
					//}
               }

            foreach($_SESSION as $key=>$value)
            {
				//if(!is_object($value) && !is_array($value)) {

                    if(((is_string($value)) && ($key=='product_cart_id'.$value))){
                            unset($_SESSION[$key]);
                    }
                //}
            }
                $this->session->delete("count");
                $this->session->delete('shipping_name');
                $this->session->delete('shipping_address1');
                $this->session->delete('shipping_address2');
                $this->session->delete('shipping_checkbox');
                $this->session->delete('shipping_country');
                $this->session->delete('shipping_state');
                $this->session->delete('shipping_city');
                $this->session->delete('shipping_postal_code');
                $this->session->delete('shipping_phone');
                $this->session->delete('aramex_currencycode');
                $this->session->delete('aramex_value');
                $this->result = $this->session->get('payment_result');
                if($this->session->get('is_store_credit') ==1) {
					$this->is_store_credit = 1;
					$this->session->delete('is_store_credit');
				}
                
			if(!$this->result){
				url::redirect(PATH);
			}

	        $this->session->delete('payment_result');
			$this->template->content = new View("themes/".THEME_NAME."/success_payment");

            common::message(1, $this->Lang["THANK_FOR_PURCH"]);
            //url::redirect(PATH."products.html");
	}

	/* PROBLEM IN PAYMENT PAYPAL */
	public function problem_payment_paypal()
	{

	            foreach($_SESSION as $key=>$value)
                {
                    if(($key=='product_cart_id'.$value)){
                    $qty = $this->session->get('product_cart_qty'.$value);
                    $deal_id = $_SESSION[$key];
                    foreach($_SESSION as $key=>$value)
                    {
                    if(($key=='product_size_qty'.$deal_id)){
                       unset($_SESSION[$key]);
                    }
                    if(($key=='product_quantity_qty'.$deal_id)){
                       unset($_SESSION[$key]);
                    }
                    if(($key=='product_color_qty'.$deal_id)){
                        unset($_SESSION[$key]);
                    }

                    }
                 }
               }
                foreach($_SESSION as $key=>$value)
                {
                        if(($key=='product_cart_id'.$value)){
                                unset($_SESSION[$key]);
                        }
                }
                $this->session->delete("count");
                common::message(-1, $this->Lang["PAGE_NOT"]);
                url::redirect(PATH."products.html");
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
	/* set store credits session */
	public function set_store_credit($duration="",$productid="")
	{
		if($duration !="-1") {
			$product_duration = explode(',',$duration);
			$this->session->set("store_credit_id".$productid,$product_duration[0]);
			$this->session->set("store_credit_period".$productid,$product_duration[1]);
			echo 1;
		} else {
			$this->session->delete('store_credit_id'.$productid);
			$this->session->delete('store_credit_period'.$productid);
			echo -1;
		}
		exit;
		
	}
	
	public function storecredit_documents($productid="")
	{
		$product_id = base64_decode($productid);
		$random =rand();
		if($_FILES){
	        $uploaddir = DOCROOT.'images/store_credit/';
                $uploadfile = $uploaddir . basename($product_id."_".$this->UserID."_".$random);
                if (move_uploaded_file($_FILES['storecredit']['tmp_name'], $uploadfile)) {
					$this->session->set('storecredit_document'.$product_id,$product_id."_".$this->UserID."_".$random);
					common::message(1,"Files uploaded successfully");
					url::redirect(PATH."cart.html");
                } else {
					
                }
	        } 
		url::redirect(PATH);
		/* $filename = $this->input->get("filename");
		print_r($this->input->get("productid"));
		print_r($this->input->get("merchantid"));
		print_r($this->input->get("filepath"));
		exit;
		*/
	
	}
	
	
	
	function cart_window_products()
	{
		            
                                   
		$add_to_cart = new View("themes/".THEME_NAME."/cart_window_product");
		echo $add_to_cart;
		exit;
	}
	function cart_product_remove($product_cart_id="")
	{
		$val = 1; 
	        $deal_id = substr($product_cart_id,15);
                foreach($_SESSION as $key=>$value)
                {
                        if ((is_string($value)) && ($key == 'product_cart_id' . $deal_id)) {
                                $val = 2;
                                $deal_id = substr($product_cart_id,15);
                                $count_value = $this->session->get('count')-1;
                                $this->session->delete($product_cart_id);
                                $this->session->delete('product_size_qty'.$deal_id);
                                $this->session->delete('product_quantity_qty'.$deal_id);
                                $this->session->delete('product_color_qty'.$deal_id);
                                $this->session->set('count',$count_value);
                                common::message(1, $this->Lang['CART_RMV']);
                              
                                url::redirect(PATH);
                        } 
                }
                if($val == 1){
                        common::message(-1, $this->Lang['NO_DATA_F']);
                        url::redirect(PATH);
                }
					
	}
	
	
}
