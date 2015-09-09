<?php defined('SYSPATH') OR die('No direct access allowed.');
class Seller_Controller extends Layout_Controller {

	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
			$this->seller = new Seller_Model();
	        $this->UserID = $this->session->get("UserID");
	    /*if(LANGUAGE == "french" ){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/french_style.css',PATH.'themes/'.THEME_NAME.'/css/fr_multi_style.css')); 
		} else if(LANGUAGE == "spanish") {
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/spanish_style.css',PATH.'themes/'.THEME_NAME.'/css/sp_multi_style.css'));
		}
		else{
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
	        $this->is_seller = 1;
	        $this->seller_signup = 0;
	}
	
	/** SELLER  SIGNUP STEP 1 **/

	public function seller_signup_step1()
	{
		$this->template->title = $this->Lang['MER_SIGN_1'];
		$this->template->content = new View("themes/".THEME_NAME."/seller/seller_signup_step1");
		
	}

	/** SELLER  SIGNUP STEP 2 **/

	public function seller_signup_step2()
	{
			if($_POST){ 
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('firstname', 'required')
						->add_rules('mr_mobile', 'required',array($this, 'validphone'), 'chars[0-9-+(). ]')
						->add_rules('mr_address1', 'required')
						->add_rules('mr_address2', 'required')
						->add_rules('lastname', 'required')
						->add_rules('nuban', 'required', array($this, 'nuban_available'))
						->add_rules('sector', 'required')
						->add_rules('subsector', 'required')
						->add_rules('email', 'required','valid::email',array($this, 'email_available'));
						//->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
						if(isset($_POST['sector']) && $post->sector!=0)
						{
							$post->add_rules('subsector', 'required');
						}
                                                //var_dump($post->validate());die;
					if($post->validate())
					{
					
					        $free = "0";
                                                if(isset($post->free)){
                                                $free = $post->free;
                                                }
                                                $flat = "0";
                                                if(isset($post->flat)){
                                                $flat = $post->flat;
                                                }
                                                $product = "0";
                                                if(isset($post->product)){
                                                $product = $post->product;
                                                }
                                                $quantity = "0";
                                                if(isset($post->quantity)){
                                                $quantity = $post->quantity;
                                                }
                                                $aramex = "0";
                                                if(isset($post->aramex)){
                                                $aramex = $post->aramex;
                                                }
                                                
						 $this->session->set(array("firstname" => $post->firstname,"lastname" => $post->lastname, 'mraddress1' => $post->mr_address1, 'mraddress2' => $post->mr_address2, 'mphone_number' => $post->mr_mobile,"memail"=>$post->email,"nuban_session" => $post->nuban,"free" => $free,"flat" => $flat, "product" => $product,'quantity' => $quantity, 'aramex' => $aramex,"sector"=>$post->sector,"sub_sector"=>$post->subsector));
							common::message(1, $this->Lang['SUCC_COM_STEP2']);
                                                        //echo "Got here"; die;
							url::redirect(PATH."merchant-signup-step3.html");
							
					} else {
							$this->form_error = error::_error($post->errors());	
					}
			}
		        $this->all_setting_module = $this->seller->get_setting_module_list();
		        $this->sector_list=$this->seller->get_sector_list();
		        $this->sub_sector_list=$this->seller->get_all_sub_sectors();
		        foreach($this->all_setting_module as $setting){
                                $this->free_shipping_setting = $setting->free_shipping;
                                $this->flat_shipping_setting = $setting->flat_shipping;
                                $this->per_product_setting = $setting->per_product;
                                $this->per_quantity_setting = $setting->per_quantity;
                                $this->aramex_setting = $setting->aramex;
		        }
		$this->template->title = $this->Lang['MER_SIGN_2'];
		$this->template->content = new View("themes/".THEME_NAME."/seller/seller_signup_step2");
		
	}
	/** SELLER  SIGNUP STEP 3 **/
	public function seller_signup_step4()
	{
		if(($this->session->get('firstname') != "") && ($this->session->get('memail') != "") && ($this->session->get('payment_acc') != "")){
			if($_POST){ 
				$this->userPost = $this->input->post();
				$post = new Validation($_POST);
				$post = Validation::factory(array_merge($_POST,$_FILES))
							->add_rules('sector', 'required');
							if($post->validate())
					{
						$this->session->set(array("sector"=>$post->sector));
							common::message(1, $this->Lang['SUCC_COM_STEP3']);
							url::redirect(PATH."merchant-signup-step3.html");
						
					}else {
							$this->form_error = error::_error($post->errors());	
					}
			
			
		}
		$this->sector_list=$this->seller->get_sector_list();
		$this->template->title = $this->Lang['MER_SIGN_3'];
		$this->template->content = new View("themes/".THEME_NAME."/seller/seller_signup_step4");
		
		
	}
	else{
			 common::message(1, $this->Lang['PLZ_CORR_FILL']);
			 url::redirect(PATH."merchant-signup-step2.html");
		}
		
			
		
	}
	
	/** SELLER  SIGNUP STEP 4 **/

	public function seller_signup_step3($seller_id = "")
	{
	  
		if(($this->session->get('firstname') != "") && ($this->session->get('memail') != "") && ($this->session->get('nuban_session') != "") ){
			if($_POST){    
				$this->userPost = $this->input->post();
				$post = new Validation($_POST);
				$post = Validation::factory(array_merge($_POST,$_FILES))
							->add_rules('city', 'required')
							->add_rules('mobile', 'required', array($this, 'validphone'), 'chars[0-9-+(). ]')
							->add_rules('address1', 'required')
							->add_rules('address2', 'required')
							->add_rules('storename', 'required',array($this,'check_store_exist'))
							//->add_rules('zipcode', 'required', 'chars[0-9.]')
							//->add_rules('website','required'/*,'valid::url'*/)
							->add_rules('latitude', 'required','chars[0-9.-]')
							->add_rules('longitude', 'required','chars[0-9.-]')
							->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
							->add_rules('store_email_id', 'required',array($this,'check_store_admin'),array($this,'check_store_admin_with_supplier'))
							->add_rules('username', 'required');
						if($post->validate())
						{      
							$store_key = text::random($type = 'alnum', $length = 8);
							$password = text::random($type = 'alnum', $length = 8);
							$store_admin_password = text::random($type = 'alnum', $length = 10);
							$storename = $this->input->post('storename');
							 $status = $this->seller->add_merchant(arr::to_object($this->userPost),$store_key,$password,$store_admin_password); 
								if($status){
									$to=($status['email'])?$status['email']:CONTACT_EMAIL;
										$from = CONTACT_EMAIL;
										$this->country_list = $this->seller->getcountrylist();
										$country_name = "";
										$city_name = ""; 
										foreach($this->country_list as $count){
												if($count->country_id == $post->country ){
														$city_list = $this->seller->get_city_by_country($post->country);
														$city_name = $city_list->current()->city_name;
														$country_name = $count->country_name;
												}
										} 
										$modules_name = 'stores';
										if($this->session->get("sub_sector")!='')
										{
											$subsector = $this->session->get("sub_sector");
											$sector_details = $this->seller->get_subsector_name($subsector);
											$modules_name = strtolower($sector_details[0]->sector_name);	
										}


										$main_routes = DOCROOT.'modules/'.$modules_name.'/config/main_routes.php';
										$f = fopen($main_routes, "r");

										$file = DOCROOT.'modules/'.$modules_name.'/config/routes.php';
										$fp = fopen($file, "a");
							
										$i = 1;	
										while ( $line = fgets($f, 1000) ) {
											$change_line = str_replace("CHANGE",url::title($storename),$line);
											fputs($fp, $change_line);	
										}

										fclose($f);
										fclose($fp);     
										/* $file = DOCROOT.'modules/stores/config/routes.php';
										 $str = '$config[\''.url::title($post->storename).'\'] ="/stores/stores_home_page/'.url::title($post->storename).'";';
										 
										$str1 = '$config[\''.url::title($storename).'/products.html\'] = "'.$modules_name.'"/stores/product_list/'.url::title($storename).'";';										
										$str2 = '$config[\''.url::title($storename).'/today-deals.html\'] = "'.$modules_name.'"/stores/deal_list/'.url::title($storename).'";';
										$str3 = '$config[\''.url::title($storename).'/auction.html\'] = "'.$modules_name.'"/stores/auction_list/'.url::title($storename).'";';
										
										$str11 = '$config[\''.url::title($storename).'/products/c/(.*)/(.*).html\'] = "'.$modules_name.'"/stores/product_list/'.url::title($storename).'/$1/$2";';
										$str12 = '$config[\''.url::title($storename).'/deal/c/(.*)/(.*).html\'] = "'.$modules_name.'"/stores/deal_list/'.url::title($storename).'/$1/$2";';
										$str13 = '$config[\''.url::title($storename).'/auction/c/(.*)/(.*).html\'] = "'.$modules_name.'"/stores/auction_list/'.url::title($storename).'/$1/$2";';
										
										$f = fopen($file, 'a');
										fputs($f, '');
										fputs($f, PHP_EOL.$str);
										
										fputs($f, PHP_EOL.$str1);
										fputs($f, PHP_EOL.$str2);
										fputs($f, PHP_EOL.$str3);
										fputs($f, PHP_EOL.$str11);
										fputs($f, PHP_EOL.$str12);
										fputs($f, PHP_EOL.$str13);
										
										fclose($f);   */
										/** for send mail to the admin  **/
										$subject=$this->Lang['NEW_MERCHANT_ADD']." ".SITENAME;
										$admin_message = "<p><b>".$this->Lang['NEW_MERCHANT_ADD']." ".SITENAME."  </b></p><p></p><p> ".$this->Lang['EMAIL1']." : ".$this->session->get('memail')."</p> <p>".$this->Lang['STORE_NAME']." : ".$post->storename."<p/><p>".$this->Lang['SHOP_ADDR']."   : ".$post->address1.",".$post->address2." <p/><p>".$this->Lang['CITY']."   : ".$city_name." <p/><p>".$this->Lang['COUNTRY']."   : ".$country_name." <p/><p>".$this->Lang['ZIP_CODE']."   : ".$post->zipcode." <p/><p>".$this->Lang['SHOP_WEB']."  : ".$post->website." <p/><p>".$this->Lang['STORE_URL']." : <a href=".PATH.url::title($post->storename)."/>".PATH.url::title($post->storename)."/ </p>";

										/** for send mail to the merchant  **/
										$merchant_subject = SITENAME." - ".$this->Lang['MERCHANT_ADD_SUC'];
										$merchant_message = "<p><b>".$this->Lang['MERCHANT_ADD_SUC']." </b> </p><p></p><p> ".$this->Lang['YOR_EMAIL']." : ".$this->session->get('memail')."</p> <p>".$this->Lang['YOUR_PASS'].": ".$password."</p> <p>".$this->Lang['YOUR_SHOP_NAM']." : ".$post->storename."<p/><p>".$this->Lang['SHOP_ADDR']."   : ".$post->address1.",".$post->address2." <p/><p>".$this->Lang['CITY']."   : ".$city_name." <p/><p>".$this->Lang['COUNTRY']."   : ".$country_name." <p/><p>".$this->Lang['ZIP_CODE']."   : ".$post->zipcode." <p/><p>".$this->Lang['SHOP_WEB']."  : ".$post->website." <p/><p>".$this->Lang['STORE_URL']." : <a href=".PATH.url::title($post->storename)."/>".PATH.url::title($post->storename)."/ </p>";
										
										$this->adminname = $this->Lang['ADMIN'];
										$this->admin_message = $admin_message;
										
										$this->name = ucfirst($this->session->get('firstname'))." ".$this->session->get('lastname');
										$this->merchant_message = $merchant_message;
										
										$adminmessage = new View("themes/".THEME_NAME."/merchant_signup_admin_mail_template");
										$merchantmessage = new View("themes/".THEME_NAME."/merchant_signup_mail_template");
										
										//echo $adminmessage; echo "<br> <br> <br>"; echo $merchantmessage; exit;
										if($_FILES['image']['name']){
											$filename = upload::save('image'); 						
											$IMG_NAME = $status['image'].'.png';						
											common::image($filename, STORE_DETAIL_WIDTH, STORE_DETAIL_HEIGHT, DOCROOT.'images/merchant/600_370/'.$IMG_NAME);
											common::image($filename, STORE_LIST_WIDTH, STORE_LIST_HEIGHT, DOCROOT.'images/merchant/290_215/'.$IMG_NAME);
											unlink($filename);
										}

										if(EMAIL_TYPE==2){		
											email::smtp($from, $to, $subject , $adminmessage);
											email::smtp($from, $this->session->get('memail'), $merchant_subject , "<p>".SITENAME ." - ".$this->Lang['CRT_MER_ACC']."</p>".$merchantmessage);
										}
										else{
											email::sendgrid($from, $to, $subject , $adminmessage);
											email::sendgrid($from, $this->session->get('memail'), $merchant_subject , "<p>".SITENAME ." - ".$this->Lang['CRT_MER_ACC']."</p>".$merchantmessage);
										}
										
										$this->password = $store_admin_password;
										$this->email = $_POST['store_email_id'];
										$from = CONTACT_EMAIL;
										$this->name = $_POST['username'];
										$this->store_admin = 1;
										$message = new View("themes/".THEME_NAME."/mail_template");
										if(EMAIL_TYPE==2){				
											email::smtp($from, $this->email, SITENAME ." - ".$this->Lang['CRT_STORE_ADMIN_ACC'] , $message);
										}
										else{
											email::sendgrid($from, $this->email, SITENAME ." - ".$this->Lang['CRT_STORE_ADMIN_ACC'] , $message);
										}
										
										//  unset the merchant session for next merchant
										$this->session->delete('firstname');
										$this->session->delete('lastname');
										$this->session->delete('memail');
										$this->session->delete('mraddress1');
										$this->session->delete('mraddress2');
										$this->session->delete('mphone_number');
										$this->session->delete('payment_acc');
                                                                                $this->session->delete('nuban');
										$this->session->delete('sector'); 
										$this->session->delete('subsector'); 
										
											common::message(1, $this->Lang['SUCC_COM_FINAL']);
											url::redirect(PATH);
								}
								else{
									common::message(-1, $this->Lang['PLZ_TRY_ONS']);
									url::redirect(PATH);
								}
						}else{
								$this->form_error = error::_error($post->errors());	
						}
				
			}
			$this->country_list = $this->seller->getcountrylist();
			$this->template->title = $this->Lang['MER_SIGN_4'];
			$this->template->content = new View("themes/".THEME_NAME."/seller/seller_signup_step3");
		}
		else{
			 common::message(1, $this->Lang['PLZ_CORR_FILL']);
			 url::redirect(PATH."merchant-signup-step2.html");
		}
		
	}
	
	
	
	/** CHECK VALID PHONE OR NOT **/
	
	public function validphone($phone = "")
	{
		if(valid::phone($phone,array(7,10,11,12,13,14)) == TRUE){
			return 1;
		}
		return 0;
	}
        
	/** CHECK VALID NUBAN OR NOT **/
	
	public function validnuban($nuban = "")
	{
		if(valid::phone($nuban,array(7,10,11,12,13,14)) == TRUE){
			return 1;
		}
		return 0;
	}
	
	/** CHECK EMAIL EXIST **/
	 
	public function email_available($email= "")
	{
		$exist = $this->seller->exist_email($email);
		return ! $exist;
	}
        
        public function nuban_available($nuban = ""){
            $ret = false;
            $ret = $this->seller->validate_nuban($nuban);
            //var_dump($ret);die;
            return true;
        }
        
	public function check_store_exist(){
	   
	    $exist = $this->seller->exist_name($this->input->post("storename"));
	    return ($exist == 0)?true:false; 
	}
	
	      public function change_sector($sector = "")
	{
		if($sector == -1 || $sector == "" ){
			//$list = '<td><label>'.$this->Lang["SEL_CITY"].'*</label></td><td><label>:</label></td><td><select name="city" class="CityPAY select required" >';
			$list ='<option value="" >'.$this->Lang["SELECT_SECTORS_FIRST"].'</option>';
			//echo $list .='</select></td>';
			echo $list .='';
		exit;
		} else {
		        $CitySlist = $this->seller->get_sub_sectors($sector);
		        if(count($CitySlist) == 0){
			        $list ='<option value="">'.$this->Lang["SELECT_SECTORS_FIRST"].'</option>';
			        echo $list .='';
		                exit;
		        } else {
		                foreach($CitySlist as $s) {	
                                        if($s->sector_id != 0)
                                        {
                                                $list = '<select name="subsector" class="subSector" >';
                                        }
                                }
		                foreach($CitySlist as $s){
			                $list .='<option value="'.$s->sector_id.'">'.ucfirst($s->sector_name).'</option>';
		                }
		                echo $list .='</select>';
		                exit;
		          }
		}
	}
	
	public function check_store_admin(){
		$exist = $this->seller->exist_store_admin($this->input->post("store_email_id"));
	    return ($exist == 0)?true:false;
	}
	
	public function check_store_admin_with_supplier()
	{
		if(($this->input->post("store_email_id"))!= $this->session->get('memail')){
			return 1;
		}
		return 0;
		
	}

}
