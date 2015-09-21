<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_merchant_Controller extends website_Controller {

	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		 
		$this->merchant = new Admin_merchant_Model();	
		$this->merchant_act = "1";		
	}
	
	/** ADD MERCHANT **/
	
	public function add_merchant()
	{
		if(!ADMIN_PRIVILEGES_MERCHANT_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->add_merchant = "1";
		$adminid=$this->session->get('user_id');
		if($_POST){
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('firstname', 'required')
						->add_rules('lastname', 'required')
						->add_rules('email', 'required','valid::email',array($this, 'email_available'))
						->add_rules('mobile', 'required', array($this, 'validphone'))
						->add_rules('address1', 'required')
						->add_rules('address2', 'required')
						->add_rules('mr_mobile', 'required', array($this, 'validphone'))
						->add_rules('mr_address1', 'required')
						->add_rules('mr_address2', 'required')
						->add_rules('country', 'required')
						->add_rules('city', 'required')
						->add_rules('sector', 'required')
						->add_rules('subsector', 'required')
						->add_rules('payment_acc', 'required','valid::email')
						->add_rules('storename', 'required',array($this,'check_store_exist'))
						->add_rules('about_us', 'required')
						->add_rules('zipcode', 'required', 'chars[a-zA-Z0-9.]')
						->add_rules('website', 'required'/*,'valid::url'*/)
						->add_rules('latitude', 'required','chars[0-9.-]')
						->add_rules('longitude', 'required','chars[0-9.-]')
						->add_rules('commission','required',array($this, 'valid_commision'),'chars[0-9]')
						->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
						->add_rules('store_email', 'required',array($this,'check_store_admin'),array($this,'check_store_admin_with_supplier'))
						->add_rules('username', 'required');
						if(isset($_POST['sector']) && $post->sector!=0)
						{
							$post->add_rules('subsector', 'required');
						}
					if($post->validate())
					{
						$password = text::random($type = 'alnum', $length = 8);
						$store_key = text::random($type = 'alnum', $length = 8);
						$store_admin_password = text::random($type = 'alnum', $length = 10);
						$storename = $this->input->post('storename');
						
						
						$status = "1";
						$status = $this->merchant->add_merchant(arr::to_object($this->userPost),$adminid,$store_key,$password,$store_admin_password);
							if($status){
							        $this->password = $password;
								$from = CONTACT_EMAIL;  
								$this->country_list = $this->merchant->getcountrylist();
		                                                $this->city_list = $this->merchant->getCityList();
                                                                $this->country_name = "";
                                                                $this->city_name = ""; 
                                                                foreach($this->country_list as $count){
                                                                        if($count->country_id == $post->country ){                                
                                                                                $this->country_name = $count->country_name;
                                                                        }
                                                                }
                                                                
                                                                foreach($this->city_list as $city){
                                                                        if($city->city_id == $post->city ){                                
                                                                                $this->city_name = $city->city_name;
                                                                        }
                                                                }
                         
                                				/* $message = "<b> ".$this->Lang['DEAR']." :".ucfirst($post->firstname)." ".$post->lastname.",</b>";
				$message .= "<p>".$this->Lang['MERCHANT_ADD_SUC']."  </p><p> ".$this->Lang['YOR_EMAIL']." : ".$post->email."</p> <p>".$this->Lang['YOUR_PASS'].": ".$password."</p> <p>".$this->Lang['UR_DEAL_COMM']."  : ".$post->commission." % <p/> <p>".$this->Lang['YOUR_SHOP_NAM']." : ".$post->storename."<p/><p>".$this->Lang['SHOP_ADDR']."   : ".$post->address1.",".$post->address2." <p/><p>".$this->Lang['SHOP_WEB']."  : ".$post->website." <p/><br /> <a href='".PATH."merchant-login.html' >".$this->Lang['LOGIN_URL']."</a><br/><p>".$this->Lang['THANK'].",</p>"; */ 
				
								$message = new View("themes/".THEME_NAME."/merchant_signin_mail_template");
				                               	// echo $message;  exit;
									if($_FILES['image']['name'])
									{
										$filename =$_FILES["image"]["name"];
										$uploadedfile = $_FILES['image']['tmp_name'];
										
										$extension = $this->getExtension($filename);
										$extension = strtolower($extension);
										
										if (!(($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))){
											if($extension=="jpg" || $extension=="jpeg" ){
												$uploadedfile = $_FILES["image"]['tmp_name'];
												$src = $this->LoadJpeg($uploadedfile);
											}else if($extension=="png"){
												$uploadedfile = $_FILES["image"]['tmp_name'];
												$src = $this->LoadPNG($uploadedfile);
											}else{
												$src = $this->LoadGif($uploadedfile);
											}
											
											list($width,$height)=getimagesize($uploadedfile);
											
											$max_width0=244;
											$max_height0=150;
											
											$width0 = $width;
											$height0 = $height;				
											if ($height0 > $max_height0) {
												$width0 = ($max_height0 / $height0) * $width0;
												$height0 = $max_height0;
											}
											if ($width0 > $max_width0) {
												$height0 = ($max_width0 / $width0) * $height0;
												$width0 = $max_width0;
											}
											$tmp0=imagecreatetruecolor($width0,$height0);
											
											$white = imagecolorallocate($tmp0, 255, 255, 255);
											imagefill($tmp0, 0, 0, $white);
											
											$max_width1=210;
											$max_height1=75;
											
											$width1 = $width;
											$height1 = $height;				
											if ($height1 > $max_height1) {
												$width1 = ($max_height1 / $height1) * $width1;
												$height1 = $max_height1;
											}
											if ($width1 > $max_width1) {
												$height1 = ($max_width1 / $width1) * $height1;
												$width1 = $max_width1;
											}
											$IMG_NAME = $status.'.png';
											$tmp1=imagecreatetruecolor($width1,$height1);
											
											$white = imagecolorallocate($tmp1, 255, 255, 255);
											imagefill($tmp1, 0, 0, $white);
											
											imagecopyresampled($tmp0,$src,0,0,0,0,$width0,$height0,$width,$height);
											imagecopyresampled($tmp1,$src,0,0,0,0,$width1,$height1,$width,$height);

											$filename0 = DOCROOT."images/merchant/600_370/". $IMG_NAME;
											$filename1 = DOCROOT."images/merchant/290_215/". $IMG_NAME;

											imagejpeg($tmp0,$filename0,100,777);
											imagejpeg($tmp1,$filename1,100,777);

											imagedestroy($src);
											imagedestroy($tmp0);
											imagedestroy($tmp1);
										}
										
										/*$filename = upload::save('image'); 						
										$IMG_NAME = $merchantid."_".$storeid.'.png';
										common::image($filename, STORE_DETAIL_WIDTH, STORE_DETAIL_HEIGHT, DOCROOT.'images/merchant/600_370/'.$IMG_NAME);
										common::image($filename, STORE_LIST_WIDTH, STORE_LIST_HEIGHT, DOCROOT.'images/merchant/290_215/'.$IMG_NAME);
										unlink($filename);*/
									}
									
									if(EMAIL_TYPE==2){				
										if(email::smtp($from, $post->email, SITENAME ." - ".$this->Lang['CRT_MER_ACC'] , $message))
										email::add_account_to_sendinblue("merchant", $post->email);
									}
									else{
										email::sendgrid($from, $post->email, SITENAME ." - ".$this->Lang['CRT_MER_ACC'] , $message);
									}
									
									$this->password = $store_admin_password;
									$this->email = $_POST['store_email'];
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
					
									/** for routes creation for front end  start **/
									$modules_name = 'stores';
									if(isset($_POST['subsector']) && ($_POST['subsector']!=''))
									{
										$subsector = $_POST['subsector'];
										$sector_details = $this->merchant->get_subsector_name($subsector);
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
									/** for routes creation for front end  end **/
										


										common::message(1, $this->Lang["MERCHANT_ADD_SUC"]);
										url::redirect(PATH."admin/merchant.html");
							}
					}else{
							$this->form_error = error::_error($post->errors());
							
					}
			}
		$this->country_list = $this->merchant->getcountrylist();
		$this->city_list = $this->merchant->getCityList();
		$this->sector_list = $this->merchant->get_all_sector_data();
		$this->sub_sector_list=$this->merchant->get_all_sub_sectors();
		
		$this->template->title = $this->Lang["MERCHANT_ADD"];
		$this->template->content = new View("admin_merchant/add_merchant");
	}
	
	/** MANAGE MERCHANT **/
	
	public function manage_merchant($page = "")
	{
		if(!ADMIN_PRIVILEGES_MERCHANT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        if($_POST){
			$post = Validation::factory($_POST)->pre_filter('trim')->add_rules('message', 'required');		
				if($post->validate()){

				$email_id = $this->input->post('email');
				$this->email_id = $this->input->post('email');
				$this->name = $this->input->post('name');
				$this->message = $this->input->post('message');
				$fromEmail = NOREPLY_EMAIL;
				$message = new View("themes/".THEME_NAME."/admin_mail_template");
				if(EMAIL_TYPE==2){
				email::smtp($fromEmail,$email_id, SITENAME, $message);
				}
			   	else{
				email::sendgrid($fromEmail,$email_id, SITENAME, $message);
				}
				common::message(1, "Mail Successfully Sended");
				url::redirect(PATH."admin/merchant.html");
			}
			else{	
				$this->form_error = error::_error($post->errors());
			}
		}
		
		$this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $serch=$this->input->get("id");
                $this->today = $this->input->get("today");
		$this->startdate  = $this->input->get("startdate");
		$this->enddate  = $this->input->get("enddate");	
		$this->date_range = isset($_GET['date_range'])?1:0;
		$this->page = $page ==""?1:$page; // for export per page
		$this->url="admin/merchant.html"; // for export
		$this->manage_merchant = "1";
		$this->sort_url= PATH.'admin/merchant.html?';
                $this->count_merchant = $this->merchant->get_merchant_count($this->input->get('name'), $this->input->get('email'), $this->input->get('city'),$this->type,$this->sort,$this->today,$this->startdate,$this->enddate);
                   $this->pagination = new Pagination(array(
		                'base_url'       => 'admin/merchant.html/page/'.$page."/",
		                'uri_segment'    => 4,
		                'total_items'    => $this->count_merchant,
		                'items_per_page' => 10, 
		                'style'          => 'digg',
		                'auto_hide'      => TRUE
	                ));
		$search=$this->input->get("id");
                $this->search = $this->input->get();
                $this->search_key = arr::to_object($this->search);
                $this->city_list = $this->merchant->getCityListOnly();
                $this->getstoreslist = $this->merchant->getstoreslist();
                
                $this->users_list = $this->merchant->get_merchant_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('name'), $this->input->get('email'), $this->input->get('city'),$this->type,$this->sort,0,$this->today,$this->startdate,$this->enddate);
                if($search =='all'){
					$this->users_list = $this->merchant->get_merchant_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('name'), $this->input->get('email'), $this->input->get('city'),$this->type,$this->sort,1,$this->today,$this->startdate,$this->enddate);
				}
                
			if($search){
				$out = '"S.No","First Name","Last Name","Shop Name","Email","Joined Date","Mobile","Address1","Address2","Payment Account","Country","City"'."\r\n";

				$i=0; 
				$first_item = $this->pagination->current_first_item;
				foreach($this->users_list as $d)
				{
			
					$out .= $i + $first_item.',"'.$d->firstname.'","'.$d->lastname.'","'.$d->store_name.'","'.$d->email.'","'.date('d-M-Y h:m:i a',$d->joined_date).'","'.$d->user_phone_number.'","'.$d->user_address1.'","'.$d->user_address2.'","'.$d->payment_account_id.'","'.$d->country_name.'","'.$d->city_name.'"'."\r\n";
					$i++;
				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream'); 
					header('Content-Disposition: attachment; filename=Merchants.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out; 
					exit;
			}
				$this->template->title = $this->Lang["MERCHANT_MANAGE"];
                $this->template->content = new View("admin_merchant/manage_merchant");
	}

	/** MERCHANT UPDATE **/
	
	public function edit_merchant($userid = "")
	{ 
		if(!ADMIN_PRIVILEGES_MERCHANT_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->manage_merchant = "1";
		$this->merchant_id=$userid;
	    if($_POST){
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('firstname', 'required')
						->add_rules('lastname', 'required')
						->add_rules('email', 'required','valid::email',array($this,'check_store_admin_with_supplier33'))
						->add_rules('mer_mobile', 'required', array($this, 'validphone'))
						->add_rules('mer_address1', 'required')
						->add_rules('mer_address2', 'required')
						->add_rules('country', 'required')
						->add_rules('city', 'required')
						->add_rules('commission','required', array($this, 'valid_commision'),'chars[0-9]')
						->add_rules('payment_acc', 'required','valid::email');

				if($post->validate())
				{

					$status = $this->merchant->edit_merchant($userid, arr::to_object($this->userpost));
						if($status == $userid)
						{
							common::message(1, $this->Lang["MERCHANT_SET_SUC"]);
							$lastsession = $this->session->get("lasturl");
		                                        if($lastsession){
		                                        url::redirect(PATH.$lastsession);
		                                        } else {
		                                        url::redirect(PATH."admin/merchant.html");
		                                        }
						}
						elseif($status == 2 )
						{
							$this->form_error["email"] = $this->Lang["EMAIL_AL_E"];
						} 
				}
				else
				{
					$this->form_error = error::_error($post->errors());
				}
		}
		$this->city_list = $this->merchant->getCityList();
		$this->country_list = $this->merchant->getcountrylist();
		$this->user_data = $this->merchant->get_merchant_data($userid);	
		$this->shipping_data = $this->merchant->get_shipping_data($userid);
                $this->sector_list = $this->merchant->get_all_sector_data();
                $this->sub_sector_list=$this->merchant->get_all_sub_sectors();
                
		if(count($this->user_data) == 0)
		{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/merchant.html");
		}
		$this->template->title = $this->Lang["EDIT_MERCHANT"];
		$this->template->content = new View("admin_merchant/edit_merchant");
	
	}
      
        public function edit_merchant_personalized($store_id = "")
	{ 
		if(!ADMIN_PRIVILEGES_MERCHANT_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->manage_merchant = "1";
		$merchant=$this->merchant->get_merchnat_id($store_id);
		$merchant_store_name=$this->merchant->get_merchant_store_name($store_id);
		$sector_data = $this->merchant->get_merchant_sector_data_list($store_id);
		if(count($sector_data)>0){
		    $this->sector_name = $sector_data->current()->sector_name;
		    $sector=$this->merchant->get_sector_data($sector_data->current()->main_sector_id);
		    $this->sectorname=$sector->current()->sector_name;
		}else{
		    $this->sector_name ="Default";
		    $this->sectorname ="Default";
		}
	        $this->banner_width ="1280";
	        $this->banner_height ="525"; 
	        $this->ads_width ="370";
	        $this->ads_height ="260";
	        if($this->sectorname =="Electronics"){
	                $this->banner_width ="900";
	                $this->banner_height ="350"; 
	                $this->ads_width ="565";
	                $this->ads_height ="157";
	        }
	        if($this->sectorname =="Fashion"){
	                $this->banner_width ="1400";
	                $this->banner_height ="525"; 
	                $this->ads_width ="370";
	                $this->ads_height ="260";
	        }
	        if($_POST){    
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('bg_color','required')
						->add_rules('font_color','required')
						->add_rules('sector','required')
						->add_rules('subsector','required')
						->add_rules('font_size','required')
						->add_rules('banner_1', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
						->add_rules('banner_1_link','valid::url')
						->add_rules('banner_2', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
						->add_rules('banner_2_link','valid::url')
						->add_rules('bannee_3', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
						->add_rules('banner_3_link','valid::url')
						->add_rules('ads_1', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
						->add_rules('ads_1_link','valid::url')
						->add_rules('ads_2', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
						->add_rules('ads_2_link','valid::url')
						->add_rules('ads_3', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
						->add_rules('ads_3_link','valid::url');
						if(isset($_POST['sector']) && $post->sector!=0)
						{
							$post->add_rules('subsector','required');
						}
				if($post->validate()){
					$store_details = $this->merchant->get_store_name($store_id,$merchant);
					$old_store_name = $store_details[0]->store_url_title;
					$old_modules_name = 'stores';

					if($store_details[0]->store_subsector_id != 0)
					{
						$store_details[0]->store_subsector_id;
						$old_modules_details = $this->merchant->get_subsector_name($store_details[0]->store_subsector_id);
						$old_modules_name = isset($old_modules_details[0]->sector_name)?strtolower($old_modules_details[0]->sector_name):'stores';
					}
			        $status = $this->merchant->update_merchant_attribute(arr::to_object($this->userpost), $store_id);
			        if($status){
						$this->sectorname = "Default";
						if($this->userpost['sector']!=''){
							$sector=$this->merchant->get_sector_data($this->userpost['sector']);
							$this->sectorname=$sector->current()->sector_name;
						}
						
						$this->banner_width ="1280";
						$this->banner_height ="525"; 
						$this->ads_width ="370";
						$this->ads_height ="260";
						if(strtolower($this->sectorname) == "electronics"){
								$this->banner_width ="900";
								$this->banner_height ="350"; 
								$this->ads_width ="565";
								$this->ads_height ="157";
						}
						if(strtolower($this->sectorname) == "fashion"){
								$this->banner_width ="1400";
								$this->banner_height ="525"; 
								$this->ads_width ="370";
								$this->ads_height ="260";
						}
						
					if($_FILES['banner_1']['name']){
						$banner1 = upload::save('banner_1');
						$IMG_NAME = $status.'_'.$this->sectorname."_1_banner.png";
						common::image($banner1, $this->banner_width, $this->banner_height, DOCROOT.'images/merchant/banner/'.$IMG_NAME);
						unlink($banner1);
					}
					if($_FILES['banner_2']['name']){
						$banner2 = upload::save('banner_2');
						$IMG_NAME = $status.'_'.$this->sectorname."_2_banner.png";
						common::image($banner2, $this->banner_width, $this->banner_height, DOCROOT.'images/merchant/banner/'.$IMG_NAME);
						unlink($banner2);
					}
					if($_FILES['banner_3']['name']){
						$banner3 = upload::save('banner_3');
						$IMG_NAME = $status.'_'.$this->sectorname."_3_banner.png";
						common::image($banner3, $this->banner_width, $this->banner_height, DOCROOT.'images/merchant/banner/'.$IMG_NAME);
						unlink($banner3);
					}
					if($_FILES['ads_1']['name']){
						$ads1 = upload::save('ads_1');
						$IMG_NAME = $status."_".$this->sectorname."_1_ads.png";
						common::image($ads1, $this->ads_width, $this->ads_height, DOCROOT.'images/merchant/ads/'.$IMG_NAME);
						unlink($ads1);
					}
					
					if($_FILES['ads_2']['name']){
						$ads2 = upload::save('ads_2');
						$IMG_NAME = $status."_".$this->sectorname."_2_ads.png";
						common::image($ads2, $this->ads_width, $this->ads_height, DOCROOT.'images/merchant/ads/'.$IMG_NAME);
						unlink($ads2);
					}
					
					if($_FILES['ads_3']['name']){
						$ads3 = upload::save('ads_3');
						$IMG_NAME = $status."_".$this->sectorname."_3_ads.png";
						common::image($ads3, $this->ads_width, $this->ads_height, DOCROOT.'images/merchant/ads/'.$IMG_NAME);
						unlink($ads3);
					}
						$modules_name = 'stores';
						if(isset($_POST['subsector']) && ($_POST['subsector']!=''))
						{
							$subsector = $_POST['subsector'];
							$sector_details = $this->merchant->get_subsector_name($subsector);
							$modules_name = strtolower($sector_details[0]->sector_name);	
						}
						
						if(($modules_name != $old_modules_name) ){
							
							
							$old_modules_file = DOCROOT.'modules/'.$old_modules_name.'/config/routes.php';

							$old_line = file($old_modules_file);

							$old_file = DOCROOT.'modules/'.$old_modules_name.'/config/main_routes.php';
							$old_f = fopen($old_file, "r");

							unset($old_line[0]);

							$new_array = array();
							$i =0 ;
							foreach( $old_line as $key => $value )
							{
								if( $value != "" && !is_array($value) ) { $new_array[$i] = $value; $i++;} 
	
							}

							$change_line = array();
							while ( $line = fgets($old_f, 1000) ) {
								$change_line[] = str_replace("CHANGE",url::title($old_store_name),$line);
							}

							$new_array = array_diff($new_array,$change_line);

							$data = implode('', array_values($new_array));
							
							$file = fopen($old_modules_file,"w+");
							fputs($file, "<?php defined('SYSPATH') OR die('No direct access allowed.');\n");
							fputs($file, $data);
							fclose($file);
	
							$main_routes = DOCROOT.'modules/'.$modules_name.'/config/main_routes.php';
							$f = fopen($main_routes, "r");


							$file = DOCROOT.'modules/'.$modules_name.'/config/routes.php';
							$fp = fopen($file, "a");
						
							while ( $line = fgets($f, 1000) ) {
								$change_line = str_replace("CHANGE",url::title($merchant_store_name),$line);
								fputs($fp, $change_line);	
							}

							fclose($f);
							fclose($fp);

						}
					
				        common::message(1, $this->Lang["STORE_PERSONALIZED_UPDATE"]);
			        }
			       // $lastsession = $this->session->get("lasturl");
                               // if($lastsession){
                               // url::redirect(PATH.$lastsession);
                               // } else {
                                url::redirect(PATH."admin/merchant-shop/".$merchant.".html");
                                //}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
			
	        $this->user_details = $this->merchant->get_merchant_balance($store_id);
	        $this->sector_list = $this->merchant->get_all_sector_data();
	        $this->data = $this->merchant->get_merchant_attribute_data_list($store_id);
	        $this->sub_sector_list=$this->merchant->get_all_sub_sectors();
		$this->template->title = $this->Lang["EDIT_PERSONALIZED"];
		$this->template->content = new View("admin_merchant/edit_merchant_personalized");
	}
	/** BLOCK AND UNBLOCK MERCHANT **/
	
	public function block_merchant($type = "", $email="", $uid = "")
	{
		if(!ADMIN_PRIVILEGES_MERCHANT_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	    $email = base64_decode($email);
		$status = $this->merchant->blockunblockmerchant($type, $uid, $email);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["MERCHANT_UNB"]);
			}
			else{
				common::message(1, $this->Lang["MERCHANT_B"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
		url::redirect(PATH.$lastsession);
		} else {
		url::redirect(PATH."admin/merchant.html");
		}
		
	}
	
		
	/** ADD MERCHANT SHOP**/
	
	public function add_merchant_shop($uid= "")
	{
		if(!ADMIN_PRIVILEGES_MERCHANT_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->m_id=$uid;
		$this->add_merchant = "1";
	    $adminid=$this->session->get('user_id');
	        if($_POST){
		        $this->userPost = $this->input->post();
		        $post = new Validation($_POST);
		        $post = Validation::factory(array_merge($_POST,$_FILES))
					        ->add_rules('mobile', 'required', array($this, 'validphone'))
					        ->add_rules('address1', 'required')
					        ->add_rules('address2', 'required')
					        ->add_rules('country', 'required')
					        ->add_rules('city', 'required')
					        ->add_rules('storename', 'required',array($this,'check_store_exist'))
					        ->add_rules('zipcode', 'required', 'chars[a-zA-Z0-9.]')
					        ->add_rules('website', 'required'/*,'valid::url'*/)
					        ->add_rules('latitude', 'required','chars[0-9.-]')
					        ->add_rules('longitude', 'required','chars[0-9.-]')
							->add_rules('sector', 'required')
							->add_rules('subsector', 'required')
					        ->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
					        ->add_rules('store_email', 'required',array($this,'check_store_admin'),array($this,'check_store_admin_with_supplier2'))
							->add_rules('username', 'required');

						if(isset($_POST['sector']) && $post->sector!=0)
						{
							$post->add_rules('subsector', 'required');
						}

			
			if($post->validate())
			{	
				$store_key = text::random($type = 'alnum', $length = 8);
				$password = text::random($type = 'alnum', $length = 10);
				$storename = $this->input->post("storename");
				$status = $this->merchant->add_merchant_shop(arr::to_object($this->userPost),$uid,$adminid,$store_key,$password);

				if($status){
				
				        $from = CONTACT_EMAIL;  
				        
				                                
				                                $shop_detail = $this->merchant->get_merchant_shop_data($status);
								$user_detail = $this->merchant->user_details($shop_detail->current()->merchant_id);
								//print_r($user_detail); exit;
								$this->email = $user_detail->current()->email;
								$this->firstname = $user_detail->current()->firstname;
								$this->country_list = $this->merchant->getcountrylist();
		                                                $this->city_list = $this->merchant->getCityList();
                                                                $this->country_name = "";
                                                                $this->city_name = ""; 
                                                                foreach($this->country_list as $count){
                                                                        if($count->country_id == $post->country ){                                
                                                                                $this->country_name = $count->country_name;
                                                                        }
                                                                }
                                                                
                                                                foreach($this->city_list as $city){
                                                                        if($city->city_id == $post->city ){                                
                                                                                $this->city_name = $city->city_name;
                                                                        }
                                                                }
			
								$message = new View("themes/".THEME_NAME."/merchant_shop_add_mail_template");
				                              //  echo $message;  exit;
									/*if($_FILES['image']['name'])
					                                {						
							                                $filename = upload::save('image'); 						
							                                $IMG_NAME = $uid."_".$status.'.png';			
							                                common::image($filename, STORE_DETAIL_WIDTH, STORE_DETAIL_HEIGHT, DOCROOT.'images/merchant/600_370/'.$IMG_NAME);
						                                        common::image($filename, STORE_LIST_WIDTH, STORE_LIST_HEIGHT, DOCROOT.'images/merchant/290_215/'.$IMG_NAME);
							                                unlink($filename);
					                                }*/
					                                if($_FILES['image']['name'])
													{
														$filename =$_FILES["image"]["name"];
														$uploadedfile = $_FILES['image']['tmp_name'];
														
														$extension = $this->getExtension($filename);
														$extension = strtolower($extension);
														
														if (!(($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))){
															if($extension=="jpg" || $extension=="jpeg" ){
																$uploadedfile = $_FILES["image"]['tmp_name'];
																$src = $this->LoadJpeg($uploadedfile);
															}else if($extension=="png"){
																$uploadedfile = $_FILES["image"]['tmp_name'];
																$src = $this->LoadPNG($uploadedfile);
															}else{
																$src = $this->LoadGif($uploadedfile);
															}
															
															list($width,$height)=getimagesize($uploadedfile);
															
															$max_width0=244;
															$max_height0=150;
															
															$width0 = $width;
															$height0 = $height;				
															if ($height0 > $max_height0) {
																$width0 = ($max_height0 / $height0) * $width0;
																$height0 = $max_height0;
															}
															if ($width0 > $max_width0) {
																$height0 = ($max_width0 / $width0) * $height0;
																$width0 = $max_width0;
															}
															$tmp0=imagecreatetruecolor($width0,$height0);
															
															$white = imagecolorallocate($tmp0, 255, 255, 255);
															imagefill($tmp0, 0, 0, $white);
															
															$max_width1=210;
															$max_height1=75;
															
															$width1 = $width;
															$height1 = $height;				
															if ($height1 > $max_height1) {
																$width1 = ($max_height1 / $height1) * $width1;
																$height1 = $max_height1;
															}
															if ($width1 > $max_width1) {
																$height1 = ($max_width1 / $width1) * $height1;
																$width1 = $max_width1;
															}
															$IMG_NAME = $uid."_".$status.'.png';
															$tmp1=imagecreatetruecolor($width1,$height1);
															
															$white = imagecolorallocate($tmp1, 255, 255, 255);
															imagefill($tmp1, 0, 0, $white);
															
															imagecopyresampled($tmp0,$src,0,0,0,0,$width0,$height0,$width,$height);
															imagecopyresampled($tmp1,$src,0,0,0,0,$width1,$height1,$width,$height);

															$filename0 = DOCROOT."images/merchant/600_370/". $IMG_NAME;
															$filename1 = DOCROOT."images/merchant/290_215/". $IMG_NAME;

															imagejpeg($tmp0,$filename0,100,777);
															imagejpeg($tmp1,$filename1,100,777);

															imagedestroy($src);
															imagedestroy($tmp0);
															imagedestroy($tmp1);
														}
													}
									
									if(EMAIL_TYPE==2){				
										email::smtp($from, $this->email, SITENAME ." - ".$this->Lang['CRT_NEWSHOP_ACC'] , $message);
									}
									else{
										email::sendgrid($from, $this->email, SITENAME ." - ".$this->Lang['CRT_NEWSHOP_ACC'] , $message);
									}
									
									$this->password = $password;
									$this->email = $_POST['store_email'];
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



									$modules_name = 'stores';
									if(isset($_POST['subsector']) && ($_POST['subsector']!=''))
									{
										$subsector = $_POST['subsector'];
										$sector_details = $this->merchant->get_subsector_name($subsector);
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
									/** for routes creation for front end  end **/
									
					
					common::message(1, $this->Lang["MERCHANT_STORES_ADD_SUC"]);
					url::redirect(PATH."admin/merchant.html");
				}
			}
			else
			{
				$this->form_error = error::_error($post->errors());	
			}
		}
                $this->country_list = $this->merchant->getcountrylist();
                $this->city_list = $this->merchant->getCityList();
		$this->sector_list = $this->merchant->get_all_sector_data();
		$this->sub_sector_list=$this->merchant->get_all_sub_sectors();

                $this->template->title = $this->Lang["MERCHANT_STORES_ADD"];
                $this->template->content = new View("admin_merchant/add_merchant_shop");
	}
	
	/** MANAGE MERCHANT SHOP **/
	
	public function manage_merchant_shop($uid = "",$page = "")
	{
		if(!ADMIN_PRIVILEGES_MERCHANT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	$this->manage_merchant = "1";
        $this->get_merchant_shop_count = $this->merchant->get_merchant_shop_count($this->input->get('storename'),  $this->input->get('city'),$uid);
                   $this->pagination = new Pagination(array(
		                'base_url'       => 'admin/merchant-shop/'.$uid.'.html/page/'.$page,
		                'uri_segment'    => 5,
		                'total_items'    => $this->get_merchant_shop_count,
		                'items_per_page' => 25, 
		                'style'          => 'digg',
		                'auto_hide'      => TRUE
	                ));
                $this->search = $this->input->get();
                $this->search_key = arr::to_object($this->search);
                $this->users_list = $this->merchant->get_merchant_list_shop($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('storename'),$this->input->get('city'),$uid);

                $this->city_list = $this->merchant->getCityListOnly();
                $this->template->title = $this->Lang["MERCHANT_STORES_MANAGE"];
                $this->template->content = new View("admin_merchant/manage_merchant_shop");
	}
	
	/** MERCHANT SHOP UPDATE **/
	
	public function edit_merchant_shop($storeid = "",$merchantid="")
	{ 
		if(!ADMIN_PRIVILEGES_MERCHANT_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->manage_merchant = "1";
		$this->mer_id=$merchantid;
		if($_POST){
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('mobile', 'required', array($this, 'validphone'))
						->add_rules('address1', 'required')
						->add_rules('address2', 'required')
						->add_rules('country', 'required')
						->add_rules('city', 'required')
						->add_rules('storename', 'required',array($this,'check_store_exist1'))
						->add_rules('zipcode', 'required', 'chars[a-zA-Z0-9.]')
						->add_rules('website', 'required'/*,'valid::url'*/)
						->add_rules('latitude', 'required','chars[0-9.-]')
						->add_rules('longitude', 'required','chars[0-9.-]')
						->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
						->add_rules('store_email', 'required',array($this,'check_store_admin1'),array($this,'check_store_admin_with_supplier1'))
						->add_rules('sector', 'required')
						->add_rules('subsector', 'required')
						->add_rules('username', 'required');

						if(isset($_POST['sector']) && $post->sector!=0)
						{
							$post->add_rules('subsector', 'required');
						}


			if($post->validate()){
					$storename = $this->input->post("storename");
					$store_details = $this->merchant->get_store_name($storeid,$merchantid);
					$old_store_name = $store_details[0]->store_url_title;
					$old_modules_name = 'stores';

					if($store_details[0]->store_subsector_id != 0)
					{
						$store_details[0]->store_subsector_id;
						$old_modules_details = $this->merchant->get_subsector_name($store_details[0]->store_subsector_id);
						$old_modules_name = isset($old_modules_details[0]->sector_name)?strtolower($old_modules_details[0]->sector_name):'stores';
					}
					$status = $this->merchant->edit_merchant_shop($storeid,arr::to_object($this->userpost),$merchantid);
					if($status > 0)
					{
						
						if($_FILES['image']['name'])
						{
							$filename =$_FILES["image"]["name"];
							$uploadedfile = $_FILES['image']['tmp_name'];
							
							$extension = $this->getExtension($filename);
							$extension = strtolower($extension);
							
							if (!(($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))){
								if($extension=="jpg" || $extension=="jpeg" ){
									$uploadedfile = $_FILES["image"]['tmp_name'];
									$src = $this->LoadJpeg($uploadedfile);
								}else if($extension=="png"){
									$uploadedfile = $_FILES["image"]['tmp_name'];
									$src = $this->LoadPNG($uploadedfile);
								}else{
									$src = $this->LoadGif($uploadedfile);
								}
								
								list($width,$height)=getimagesize($uploadedfile);
								
								$max_width0=244;
								$max_height0=150;
								
								$width0 = $width;
								$height0 = $height;				
								if ($height0 > $max_height0) {
									$width0 = ($max_height0 / $height0) * $width0;
									$height0 = $max_height0;
								}
								if ($width0 > $max_width0) {
									$height0 = ($max_width0 / $width0) * $height0;
									$width0 = $max_width0;
								}
								$tmp0=imagecreatetruecolor($width0,$height0);
								
								$white = imagecolorallocate($tmp0, 255, 255, 255);
								imagefill($tmp0, 0, 0, $white);
								
								$max_width1=210;
								$max_height1=75;
								
								$width1 = $width;
								$height1 = $height;				
								if ($height1 > $max_height1) {
									$width1 = ($max_height1 / $height1) * $width1;
									$height1 = $max_height1;
								}
								if ($width1 > $max_width1) {
									$height1 = ($max_width1 / $width1) * $height1;
									$width1 = $max_width1;
								}
								$IMG_NAME = $merchantid."_".$storeid.'.png';
								$tmp1=imagecreatetruecolor($width1,$height1);
								
								$white = imagecolorallocate($tmp1, 255, 255, 255);
								imagefill($tmp1, 0, 0, $white);
								
								imagecopyresampled($tmp0,$src,0,0,0,0,$width0,$height0,$width,$height);
								imagecopyresampled($tmp1,$src,0,0,0,0,$width1,$height1,$width,$height);

								$filename0 = DOCROOT."images/merchant/600_370/". $IMG_NAME;
								$filename1 = DOCROOT."images/merchant/290_215/". $IMG_NAME;

								imagejpeg($tmp0,$filename0,100,777);
								imagejpeg($tmp1,$filename1,100,777);

								imagedestroy($src);
								imagedestroy($tmp0);
								imagedestroy($tmp1);
							}
							
							/*$filename = upload::save('image'); 						
							$IMG_NAME = $merchantid."_".$storeid.'.png';
							common::image($filename, STORE_DETAIL_WIDTH, STORE_DETAIL_HEIGHT, DOCROOT.'images/merchant/600_370/'.$IMG_NAME);
						    common::image($filename, STORE_LIST_WIDTH, STORE_LIST_HEIGHT, DOCROOT.'images/merchant/290_215/'.$IMG_NAME);
							unlink($filename);*/
						}


						$modules_name = 'stores';
						if(isset($_POST['subsector']) && ($_POST['subsector']!=''))
						{
							$subsector = $_POST['subsector'];
							$sector_details = $this->merchant->get_subsector_name($subsector);
							$modules_name = strtolower($sector_details[0]->sector_name);	
						}

						if((url::title($storename) != $old_store_name) || ($modules_name != $old_modules_name) ){
							
							$old_modules_file = DOCROOT.'modules/'.$old_modules_name.'/config/routes.php';

							$old_line = file($old_modules_file);

							$old_file = DOCROOT.'modules/'.$old_modules_name.'/config/main_routes.php';
							$old_f = fopen($old_file, "r");

							unset($old_line[0]);

							$new_array = array();
							$i =0 ;
							foreach( $old_line as $key => $value )
							{
								if( $value != "" && !is_array($value) ) { $new_array[$i] = $value; $i++;} 
	
							}

							$change_line = array();
							while ( $line = fgets($old_f, 1000) ) {
								$change_line[] = str_replace("CHANGE",url::title($old_store_name),$line);
							}

							$new_array = array_diff($new_array,$change_line);

							$data = implode('', array_values($new_array));
							
							$file = fopen($old_modules_file,"w+");
							fputs($file, "<?php defined('SYSPATH') OR die('No direct access allowed.');\n");
							fputs($file, $data);
							fclose($file);
	
							
							$main_routes = DOCROOT.'modules/'.$modules_name.'/config/main_routes.php';
							$f = fopen($main_routes, "r");


							$file = DOCROOT.'modules/'.$modules_name.'/config/routes.php';
							$fp = fopen($file, "a");
						
							while ( $line = fgets($f, 1000) ) {
								$change_line = str_replace("CHANGE",url::title($storename),$line);
								fputs($fp, $change_line);	
							}

							fclose($f);
							fclose($fp);

						}
						/*
						// for routes creation for front end  start //	
						if(url::title($storename) != $old_store_name){

							$DELETE = '$config[\''.url::title($old_store_name).'\'] ="/stores/stores_home_page/'.url::title($old_store_name).'";';
							$data = file($file);

							$out = array();

							 foreach($data as $line) {
								 if((trim($line) != $DELETE)) {
									 $out[] = $line;
								 }
							 }
							
							fclose($fp); 
						}
						// for routes creation for front end  end //
						*/


						common::message(1, $this->Lang["MERCHANT_STORES_SET_SUC"]);
						url::redirect(PATH."admin/merchant-shop/".$merchantid.".html");
					}                                                               
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		
		$this->country_list = $this->merchant->getcountrylist();
	    	$this->city_list = $this->merchant->getCityList();
		$this->sector_list = $this->merchant->get_all_sector_data();
		$this->sub_sector_list=$this->merchant->get_all_sub_sectors();

		$this->user_data = $this->merchant->get_merchant_shop_data($storeid);
		if(count($this->user_data) == 0)
		{
		        common::message(-1, $this->Lang["STORE_CANT_EDIT"]);
			    url::redirect(PATH."admin/merchant-shop/".$merchantid.".html");
		}
		$this->template->title = $this->Lang["EDIT_STORES_MERCHANT"];
		$this->template->content = new View("admin_merchant/edit_merchant_shop");  
	}
	
	/** BLOCK AND UNBLOCK MERCHANT  SHOP **/
	
	public function block_merchant_shop($type = "", $storesid = "", $merchantid= "")
	{
		if(!ADMIN_PRIVILEGES_MERCHANT_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->merchant->blockunblockmerchantshop($type, $storesid);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["MERCHANT_STORES_UNB"]);
			}
			else{
				common::message(1, $this->Lang["MERCHANT_STORES_B"]);
			}
		}
		else if($status == -1){
			common::message(-1, $this->Lang["MERCHANT_BLOCKED"]);
		}
		url::redirect(PATH."admin/merchant-shop/".$merchantid.".html");
	}
	public function check_store_exist(){
	    $exist = $this->merchant->exist_name($this->input->post("storename"));
	    return ($exist == 0)?true:false; 
	}
	public function check_store_exist1(){
	    $exist = $this->merchant->exist_name($this->input->post("storename"),$this->input->post("storeid"));
	    return ($exist == 0)?true:false; 
	}
	/** MANAGE USER COMMENTS **/
	
	public function manage_users_comments($page = "")
	{		 
		$this->store_comments = 1;		
		$this->count_user = $this->merchant->get_users_comments_count($this->input->get('firstname'));
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-store-comments.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $this->count_user,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->search = $this->input->get();
		$this->search_key = arr::to_object($this->search);
		$this->users_list = $this->merchant->get_users_comments_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('firstname'));
		
		$this->template->title = $this->Lang["USER_COMM"];
		$this->template->content = new View("admin_merchant/manage_users_comments");
	}
	
	/** UPDATE USER COMMENTS **/
	
	public function edit_users_comments($commentsid = "")
	{ 
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->store_comments = 1;
		if($_POST){
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('comments', 'required');
			if($post->validate()){
				$status = $this->merchant->edit_users_comments($commentsid, arr::to_object($this->userpost));
					if($status ==1){
                        common::message(1, $this->Lang["COMM_SET_SUC"]);
                        url::redirect(PATH.'admin/manage-store-comments.html');
                	}          
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		
		$this->users_comments_data = $this->merchant->get_users_comments_data($commentsid);	
			if(count($this->users_comments_data) == 0){
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				url::redirect(PATH."admin/manage-store-commants.html");
			}
		$this->template->title = $this->Lang["COMM_MERCHANT"];
		$this->template->content = new View("admin_merchant/edit_users_comments");
	
	}
	
	/** BLOCK AND UNBLOCK USERCOMMENTS **/
	
	public function block_users_comments($type = "", $uid = "")
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->merchant->blockunblockusercomments($type, $uid);
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
		url::redirect(PATH."admin/manage-store-comments.html");
	}

	/** DELETE USERCOMMENTS **/
	
	public function delete_users_comments($discussion_id = "")
	{ 
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->merchant->deleteusercomments($discussion_id);
		if($status == 1){			
				common::message(1, $this->Lang["COMM_DEL"]);
			}			
		url::redirect(PATH."admin/manage-store-comments.html");
	}

	/** CHECK PASSWORD EXIST **/
	 
	public function check_password($password = "")
	{
		$exist = $this->merchant->exist_password($password, $this->user_id);
		return $exist;
	}
	
	/** CHECK EMAIL EXIST **/
	 
	public function email_available($email= "")
	{
		$exist = $this->merchant->exist_email($email);
		return ! $exist;
	}
	
	/** CHECK VALID PHONE OR NOT **/
	
	public function validphone($phone = "")
	{
	        if(valid::numeric($phone)){
		        if(valid::phone($phone,array(7,10,11,12,13,14)) == TRUE){
			        return 1;
		        }
		}
		return 0;
	}
	
	/** CHECK VALID PHONE OR NOT **/
	
	public function valid_commision($merchant_commission = "")
	{
		if($merchant_commission <= "100"){
			return 1;
		}
		return 0;
	}
	/** CITY SELECT SCRIPT  **/
			
	public function CityS($country = "")
	{
		if($country == -1){
			$list = '<td><label>'.$this->Lang["SEL_CITY"].'*</label></td><td><label>:</label></td><td><select name="city">';
			$list .='<option value=" " >'.$this->Lang["CITY_FIRST"].'</option>';
			echo $list .='</select></td>';
		exit;
		}
		else{
		
		        $CitySlist = $this->merchant->get_city_by_country($country);
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
		                $list = '<td><label>'.$this->Lang["SEL_CITY"].'*</label></td>
                                    <td><label>:</label></td>
                                    <td><select name="city">';
                                    
                                    } 
                                }
		                foreach($CitySlist as $s){
			
			                $list .='<option value="'.$s->city_id.'">'.ucfirst($s->city_name).'</option>';
		                }
		                echo $list .='</select></td>';
		                exit;
		          }
		}
	}
	
	/** SHOP RATING **/
	public function shop_rating($merchant_id = "", $rate = "")
	{
		$status = $this->merchant->update_shop_rating($merchant_id,$rate);
		echo $status;
		exit;
	}
	/** MERCHANT DETAILS **/
	
	public function merchant_details($id = "")
	{
		if(!ADMIN_PRIVILEGES_MERCHANT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->manage_merchant = "1";

		$id = base64_decode($id);
		$this->shipping_data = $this->merchant->get_shipping_data($id);
		$this->merchant_details = $this->merchant->get_merchant_details($id);
		$this->store_details = $this->merchant->get_store_details($id);
		$this->sector_list = $this->merchant->get_all_sector_data();
		$this->template->title = $this->Lang["MERCHANT_DETAILS"];
		$this->template->content = new View("admin_merchant/merchant_details");
	}
	
	/** MERCHANT DASHBOARD LIST **/
	public function dashboard_merchant()
	{
		if(!ADMIN_PRIVILEGES_MERCHANT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->dashboard_merchant = "1";

		$this->start_date = "";
		$this->end_date = "";

		if($_GET){
			$this->start_date = $this->input->get('start_date');
			$this->end_date = $this->input->get('end_date');
		}

	    $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
	    $this->start_date = $this->input->get("start_date");
	    $this->end_date = $this->input->get("end_date");	   
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
		$this->user_list = $this->merchant->get_user_list();
		$this->stores_list = $this->merchant->getstoreslist();
		$this->admin_details = $this->merchant->get_admin_details_data();
		$this->admin_id = $this->admin_details->current()->user_id; 
		$this->template->content = new View("admin_merchant/merchant_dashboard");
		$this->template->title = $this->Lang["MERCHANT_DASHBOARD"];
	}

	public function approvedisapprove_merchant($type = "",$merchant_id="")
	{ 
	
	if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->merchant->approvedisapprove_merchant($type,base64_decode($merchant_id));
		if($status == 1){
			$details = $this->merchant->get_merchant_details(base64_decode($merchant_id));
			if($type == 1){
				
				$from = CONTACT_EMAIL;
				$subject = SITENAME." - ".$this->Lang['MER_APP'];
				
				$merchant_message = "<p> <b>".$this->Lang['CONGRA']."! ".$this->Lang['YOUR_APP_MER']."  </b></p><p> ".$this->Lang['YOR_EMAIL']." : ".$details[0]->email."</p> <p>".$this->Lang['UR_DEAL_COMM']."  : ".$details[0]->merchant_commission." % <p/> <p> ".$this->Lang['LOGIN_URL']." :  <a href='".PATH."merchant-login.html' > Click here </a>";
				
				$this->name = ucfirst($details[0]->firstname)." ".$details[0]->lastname;
				$this->merchant_message = $merchant_message;
				$merchantmessage = new View("themes/".THEME_NAME."/merchant_signup_mail_template");		
				if(EMAIL_TYPE==2){				
					email::smtp($from, $details[0]->email, $subject ,$merchantmessage);
				}
				else{
					email::sendgrid($from, $details[0]->email, $subject , $merchantmessage);
				}
				
				common::message(1, $this->Lang["COMM_DIS_SUCC"]);
			}
			else{
				$from = CONTACT_EMAIL;
				$subject = SITENAME." - ".$this->Lang['MER_DIS_APP'];
				$merchant_message = "<p> <b>".$this->Lang['YOUR_DIS_APP_MER']." </b></p><p> ".$this->Lang['YOR_EMAIL']." : ".$details[0]->email."</p>";
				
				$this->name = ucfirst($details[0]->firstname)." ".$details[0]->lastname;
				$this->merchant_message = $merchant_message;
				$merchantmessage = new View("themes/".THEME_NAME."/merchant_signup_mail_template");
				
				echo $merchantmessage; exit;
				
				if(EMAIL_TYPE==2){				
					email::smtp($from, $details[0]->email, $subject ,$merchantmessage);
				}
				else{
					email::sendgrid($from, $details[0]->email, $subject , $merchantmessage);
				}
				
				common::message(1, $this->Lang["COMM_APP_SUCC"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
		url::redirect(PATH.$lastsession);
		} else {
		url::redirect(PATH."admin/merchant.html");
		}
		
	}
	
	
	/** LISTING SUBSECTORS WHILE CHANGING THE SECTORS **/

    public function change_sector($sector= "")
	{
		if($sector == -1){
			$list = '<td><label>"'.$this->Lang['SELECT_SECTOR'].'"*</label></td><td><label>:</label></td><td><select name="sub_category">';
			$list .='<option value="">"'.$this->Lang['SELECT_SECTORS_FIRST'].'"</option>';
			echo $list .='</select></td>';
		    exit;
		}
		else {
		        $sectorlist = $this->merchant->get_sub_sectors($sector);
		        if(count($sectorlist) > 0){
					$list = '<td><label>'.$this->Lang['SUBSECTOR'].'*</label></td>
								<td><label>:</label></td>


								<td><select name="subsector" >
								<option value="">'.$this->Lang['SELECT_SECTOR'].'</option>';
					foreach($sectorlist as $s){
						$theme_check = true;
						$theme_name = strtolower($s->sector_name);
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/controllers/'.$theme_name.'.php'))
							$theme_check = false;
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/models/'.$theme_name.'.php'))
							$theme_check = false;
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/config/routes.php'))
							$theme_check = false;
						if(!is_dir(DOCROOT.'themes/'.THEME_NAME.'/css/'.$theme_name))
							$theme_check = false;
						if(!is_dir(DOCROOT.'application/views/themes/'.THEME_NAME.'/'.$theme_name))
							$theme_check = false;
						if($theme_check==true)
							$list .='<option value="'.$s->sector_id.'">'.ucfirst($s->sector_name).'</option>';
					}
					echo $list .='</select></td>';
				}
				else {
					$list = '<td><label>'.$this->Lang['SUBSECTOR'].'*</label></td><td><label>:</label></td><td><select name="sub_category">';
					$list .='<option value="">No Sectors</option>';
					echo $list .='</select></td>';
				}
				exit;
		}
	}
	/** LISTING SUBSECTORS WHILE CHANGING THE SECTORS **/

    public function change_sector_admin($sector= "")
	{
		if($sector == -1){
			$list = '<td><label>'.$this->Lang['SUBSECTOR'].':</label></td></td><td><select name="sub_category">';
			$list .='<option value="">'.$this->Lang['SELECT_SECTORS_FIRST'].'</option>';
			echo $list .='</select></td>';
		    exit;
		}
		else {
		        $sectorlist = $this->merchant->get_sub_sectors($sector);
		        if(count($sectorlist) > 0){
					$list = '<td><label>'.$this->Lang['SUBSECTOR'].':*</label></td>
								


								<td><select name="subsector" >
								<option value="">'.$this->Lang['SELECT_SECTOR'].'</option>';
					foreach($sectorlist as $s){
						$theme_check = true;
						$theme_name = strtolower($s->sector_name);
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/controllers/'.$theme_name.'.php'))
							$theme_check = false;
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/models/'.$theme_name.'.php'))
							$theme_check = false;
						if(!file_exists(DOCROOT.'modules/'.$theme_name.'/config/routes.php'))
							$theme_check = false;
						if(!is_dir(DOCROOT.'themes/'.THEME_NAME.'/css/'.$theme_name))
							$theme_check = false;
						if(!is_dir(DOCROOT.'application/views/themes/'.THEME_NAME.'/'.$theme_name))
							$theme_check = false;
						if($theme_check==true)
							$list .='<option value="'.$s->sector_id.'">'.ucfirst($s->sector_name).'</option>';
					}
					echo $list .='</select></td>';
				}
				else {
					$list = '<td><label>'.$this->Lang['SUBSECTOR'].'</label></td><td><select name="sub_category">';
					$list .='<option value="">No Sectors</option>';
					echo $list .='</select></td>';
				}
				exit;
		}
	}
	/** SEND EMAILS **/
	
	public function send_merchant_emails()
	{
		if(!ADMIN_PRIVILEGES_MERCHANT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->merchant_news_letter = "1";
	    if($_POST){

			$this->userPost = $this->input->post();
			$post = Validation::factory(array_merge($_POST,$_FILES))
							->add_rules('subject', 'required')
							->add_rules('message', 'required');
									
						if(!isset($post->users) && !isset($post->all_users))
						{
							$post->add_rules('all_users','required');
						}	 
						if($post->add_temp==1){
							$post->add_rules('template','required');
						}
				if($post->validate()){
					if($post->add_temp==1){
						$file=array();
						$extension="";
						if($_FILES['attach']['name']['0'] != "" ){
													$i=1;
								foreach(arr::rotate($_FILES['attach']) as $files){
											if($files){
										$filename = upload::save($files);
											if($filename!=''){
												//$IMG_NAME = "news_letter";
												$ext=$filename;
												$lastDot = strrpos($ext, ".");
												$string = str_replace(".", "", substr($ext, 0, $lastDot)) . substr($ext, $lastDot);
												$path = explode('.',$string);
												$extension = end($path);
												$f=file_get_contents($filename);
												file_put_contents(DOCROOT.'images/newsletter/newsletter.'.$extension,$f);
												
											}
										}
									$i++;
								}
								 $file[0]=DOCROOT.'images/newsletter/newsletter.'.$extension;
											}
											
											$file1=array();
											pdf::template_create($post->template,$post->subject,$post->message);
										   
											array_push($file1, $_SERVER['DOCUMENT_ROOT']."/images/newsletter/newsletter.pdf");
											// chmod($_SERVER['DOCUMENT_ROOT']."/images/newsletter/newsletter.pdf",0777);
											
						 $status = $this->merchant->send_newsletter(arr::to_object($this->userPost),$file1,1);
					}else{
						$status = $this->merchant->send_newsletter(arr::to_object($this->userPost),"",2);
					}

		             	if($status == 1){
							//unlink(DOCROOT.'images/newsletter/newsletter.'.$extension);
							unlink(DOCROOT.'images/newsletter/newsletter.pdf');
				        common::message(1, $this->Lang['NEWS_SENT']);
			        }
			        else{
						//unlink(DOCROOT.'images/newsletter/newsletter.'.$extension);
						unlink(DOCROOT.'images/newsletter/newsletter.pdf');
				        common::message(-1, $this->Lang['NEWS_NOT_SENT']);
			        }
		       		 url::redirect(PATH."admin.html");
		        }
		        else{
		            $this->form_error = error::_error($post->errors());
		        }
		}
	$this->city_list = $this->merchant->getCityList();       
	$this->users = $this->merchant->getUSERList();       
        $this->template->title = $this->Lang['SEND_NEWSL'];
        $this->template->content = new View("admin_merchant/send_merchant_emails");	
	}
	public function user_select1($all_users="",$city="",$gender="",$age_range="")
	{
		
			$this->user_list=$this->merchant->get_user_list1($all_users,$city,$gender,$age_range);
			 if(count($this->user_list) > 0){
					$list = '<td id="email"><div class="input-text1 clearfix">
		                	 <div class="search-input1" style="padding:0;" ><div class="add_pt"><ul>
							 <li><input type="checkbox" name="email" onclick="checkboxcheckAllUsers(&#39;settings_newsletter&#39;,&#39;email&#39;)" /><span>Select all</span></li>';
					foreach($this->user_list as $s){
						$list .= '<li><input type="hidden" name="firstname[]" value="'.$s->firstname.'" /><input type="checkbox" name="email[]" class="case" value="'.$s->email.'__'.$s->firstname.'__'.$s->user_id.'" /><span>'.$s->email.'</span></li>';
					}
					echo $list .='</ul></div></div></div></td>';
				}else{
					echo $list = '<input type="hidden" name="email[]" value="0"  />No users under this category';
				}
		exit;
	}

	public function check_store_admin(){
		$exist = $this->merchant->exist_store_admin($this->input->post("store_email"));
	    return ($exist == 0)?true:false;
	}
	
	public function check_store_admin1(){
		$exist = $this->merchant->exist_store_admin($this->input->post("store_email"),$this->input->post("store_admin_id"));
	    return ($exist == 0)?true:false;
	}
	
	/** EAMIL COMMUNICATION FROM ADMIN AND MERCHANT **/
	public function merchant_mail_inbox($page="")
		{
			if(!ADMIN_PRIVILEGES_DAILY_NEWSLETTER)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
			$this->merchant_news_letter = "1";
		$this->message_list_count=$this->merchant->get_user_messages_count();
		 $this->pagination = new Pagination(array(
            'base_url'       => 'admin/merchant_email_inbox.html/page/'.$page."/",
            'uri_segment'    => 4,
            'total_items'    => $this->message_list_count,
            'items_per_page' => 10, 
            'style'          => 'digg',
            'auto_hide'      => TRUE
        ));
		$this->message_list=$this->merchant->get_user_messages($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->content = new View("admin_user/user_inbox_email");	
		
	}
	
	public function show_merchant_message($message_id="")
	{
		if(!ADMIN_PRIVILEGES_DAILY_NEWSLETTER)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->merchant_news_letter = "1";
		$this->message=$this->merchant->get_user_message($message_id);
		$this->template->content = new View("themes/".THEME_NAME."/user_inbox_email_messages");	
	}
	
	public function check_store_admin_with_supplier()
	{
		if(($this->input->post("store_email"))!= $this->input->post("email")){
			return 1;
		}
		return 0;
		
	}
	
	public function check_store_admin_with_supplier1()
	{
		$merchant_email=$this->merchant->get_merchant_email($this->mer_id);
		
		if(($this->input->post("store_email"))!= $merchant_email){
			return 1;
		}
		return 0;
	}
	public function check_store_admin_with_supplier2()
	{
		$merchant_email=$this->merchant->get_merchant_email($this->m_id);
		
		if(($this->input->post("store_email"))!= $merchant_email){
			return 1;
		}
		return 0;
	}
	
	public function check_store_admin_with_supplier33()
	{
		$merchant_email=$this->merchant->get_merchant_emails($this->merchant_id);
		
		foreach($merchant_email as $e)
		{
		if(($this->input->post("email"))!= $e->email){
			return 1;
		}
		return 0;
		
		}
	}
	
	public function getExtension($str)
	{
		// $i = strrpos($str,".");
		$i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
	}
	
	public function LoadPNG($imgname)
	{
		/* Attempt to open */
		$im = @imagecreatefrompng($imgname);
		
		/* See if it failed */
		if(!$im)
		{
		/* Create a blank image */
		$im  = imagecreatetruecolor(150, 30);
		$bgc = imagecolorallocate($im, 255, 255, 255);
		$tc  = imagecolorallocate($im, 0, 0, 0);
		
		imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
		
		/* Output an error message */
		imagestring($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
		}
		
		return $im;
	}


	public function LoadJpeg($imgname)
	{
		/* Attempt to open */
		$im = @imagecreatefromjpeg($imgname);
		
		/* See if it failed */
		if(!$im)
		{
		/* Create a black image */
		$im  = imagecreatetruecolor(150, 30);
		$bgc = imagecolorallocate($im, 255, 255, 255);
		$tc  = imagecolorallocate($im, 0, 0, 0);
		
		imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
		
		/* Output an error message */
		imagestring($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
		}
		
		return $im;
	}
	
	public function LoadGif($imgname)
	{
		/* Attempt to open */
		$im = @imagecreatefromgif($imgname);
		
		/* See if it failed */
		if(!$im)
		{
		/* Create a blank image */
		$im = imagecreatetruecolor (150, 30);
		$bgc = imagecolorallocate ($im, 255, 255, 255);
		$tc = imagecolorallocate ($im, 0, 0, 0);
		
		imagefilledrectangle ($im, 0, 0, 150, 30, $bgc);
		
		/* Output an error message */
		imagestring ($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
		}
		
		return $im;
	}

}
