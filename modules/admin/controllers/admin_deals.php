<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_deals_Controller extends website_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		}
		 
		$this->deals = new Admin_deals_Model();
		$this->deals_act="1";
	}

	/** ADD NEW DEALS **/

	public function add_deal()
	{
		if(!ADMIN_PRIVILEGES_DEALS_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}

	        $this->add_deal="1";
		$adminid=$this->session->get('user_id');
		$this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js', PATH.'js/multiimage.js'));
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
			if($_POST){
				$this->userPost = $this->input->post();
				$post = Validation::factory(array_merge($_POST,$_FILES))
								->pre_filter('trim', 'title')
								->add_rules('title', 'required')
								->add_rules('description', 'required',array($this,'check_required'))
								->add_rules('category', 'required')
								->add_rules('sub_category', 'required')
								->add_rules('sec_category', 'required')
								->add_rules('price', 'required', 'chars[0-9.]',array($this,'check_price_val_lmi'))
								->add_rules('deal_value', 'required', array($this, 'check_price_lmi'),'chars[0-9.]',array($this,'check_deal_value_lmi'))
								->add_rules('start_date', 'required')
								->add_rules('end_date', 'required', array($this, 'check_end_date'))
								->add_rules('expiry_date', 'required', array($this, 'check_expiry_date'))
								->add_rules('minlimit', 'required',array($this,'check_min_lmi'),'chars[0-9]')
								->add_rules('maxlimit', 'required','chars[0-9]',array($this,'check_maxlimit_lmi'))
								->add_rules('deal_type', 'required')
								->add_rules('quantity', 'required', array($this,'check_purchace_lmi'),'chars[0-9]')
								->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
								->add_rules('stores','required')
								->add_rules('users', 'required');
				        if($post->validate()){
					$deal_key = text::random($type = 'alnum', $length = 8);
					$status = $this->deals->add_deals(arr::to_object($this->userPost),$deal_key,$adminid);
					if($status > 0 && $deal_key){
							if($_FILES['image']['name']['0'] != "" ){
								$i=1;
							foreach(arr::rotate($_FILES['image']) as $files){
								if($files){
									$filename = upload::save($files);
									if($filename!=''){

										$IMG_NAME = $deal_key."_".$i.'.png';
										common::image($filename, 620,752, DOCROOT.'images/deals/1000_800/'.$IMG_NAME);
										unlink($filename);
									}
								 }
								 $i++;
							   }
							}

							/**DEAL AUTOPOST FACEBOOK WALL**/

							if($this->input->post('autopost')==1){

							$dealurl=url::title($this->input->post('title'));
							$dealURL = PATH."deals/".$deal_key.'/'.$dealurl.".html";
								$message = "A new deal published onthe site"." ".$this->input->post('title')." ".$dealURL." limited offer hurry up!";
								$fb_access_token = $this->session->get("fb_access_token");
								$fb_user_id = $this->session->get("fb_user_id");
								$post_arg = array("access_token" => $fb_access_token, "message" => $message, "id" => $fb_user_id, "method" => "post");

								common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg);

							}
						/**DEAL AUTOPOST FACEBOOK WALL END HERE**/
						common::message(1, $this->Lang["DEAL_ADD_SUC"]);
						url::redirect(PATH."admin/manage-deals.html");
					}
					$this->form_error["city"] = $this->Lang["DEAL_EXIST"];
				}
				else{
					$this->form_error = error::_error($post->errors());
				}
			}
		$this->category_list = $this->deals->get_category_list();
		$this->sub_category_list = $this->deals->get_sub_category_list();
		$this->sec_category_list = $this->deals->get_sec_category_list();
		$this->third_category_list = $this->deals->get_third_category_list();
		$this->get_marchant_list = $this->deals->getmarchantlist();
		$this->shop_list = $this->deals->get_shop_list();
	        $this->template->title = $this->Lang["ADD_DEALS"];
		$this->template->content = new View("admin_deal/add_deals");
	}

	/** MANAGE DEALS **/

	public function manage_deals($type= "", $page = "")
	{
		if(!ADMIN_PRIVILEGES_DEALS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->page = $page ==""?1:$page; // for export per page
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $serch=$this->input->get("id");
                $this->today = $this->input->get("today");
		$this->startdate  = $this->input->get("startdate");
		$this->enddate  = $this->input->get("enddate");	
		$this->date_range = isset($_GET['date_range'])?1:0;
		$this->more_action = "";
	        if($type == 1){
			$this->archive_deals="1";
			$this->more_action = $this->Lang["REQU"];
			$this->template->title = $this->Lang["ARCHIVE_DEALS"];
			$this->url = "admin/archive-deals.html";
			$this->sort_url= PATH.'admin/archive-deals.html?';
		} else {
			$this->manage_deals="1";
			$this->template->title = $this->Lang["MANAGE_DEALS"];
			$this->url = "admin/manage-deals.html";
			$this->sort_url= PATH.'admin/manage-deals.html?';
		}
	        $this->count_deal_all_record = $this->deals->get_all_deals_count($type, $this->input->get("city"), $this->input->get('name'),$this->type,$this->sort,$this->today,$this->startdate,$this->enddate);
		$this->city_list = $this->deals->get_city_lists();
		$this->search_key = arr::to_object($this->input->get());
		$this->pagination = new Pagination(array(
				'base_url'       => $this->url.'/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $this->count_deal_all_record,
				'items_per_page' => 25,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->all_deal_list = $this->deals->get_all_deals_list($type, $this->pagination->sql_offset, $this->pagination->items_per_page ,$this->input->get("city"), $this->input->get('name'),$this->type,$this->sort,0,$this->today,$this->startdate,$this->enddate);
			if($serch == 'all'){
			$this->all_deal_list = $this->deals->get_all_deals_list($type, $this->pagination->sql_offset, $this->pagination->items_per_page ,$this->input->get("city"), $this->input->get('name'),$this->type,$this->sort,1,$this->today,$this->startdate,$this->enddate);
			}
			if($serch){
				$out = '"S.No","Title","Category","Original Price","Discount Price","Savings","Discount Percentage","Start Date","End Date","Expiry Date","Purchase Count","Merchant Name","Shop Name","Country","City","Image"'."\r\n";
				$i=0;
				$first_item = $this->pagination->current_first_item;
				foreach($this->all_deal_list as $d)
				{
					if(file_exists(DOCROOT.'images/deals/1000_800/'.$d->deal_key.'_1.png'))
					{
						$deal_image =PATH.'images/deals/1000_800/'.$d->deal_key.'_1.png';
					}
					else
					{
						$deal_image =PATH.'images/no-images.png';
					}
					$out .= $i + $first_item.',"'.$d->deal_title.'","'.$d->category_name.'","'.(CURRENCY_SYMBOL.$d->deal_price).'","'.(CURRENCY_SYMBOL.$d->deal_value).'","'.(CURRENCY_SYMBOL.$d->deal_savings).'","'.round($d->deal_percentage)."%".'","'.date('m/d/Y H:i:s',$d->startdate).'","'.date('m/d/Y H:i:s',$d->enddate).'","'.date('m/d/Y H:i:s',$d->expirydate).'","'.$d->purchase_count.'","'.$d->firstname.'","'.$d->store_name.'","'.$d->country_name.'","'.$d->city_name.'","'.$deal_image.'"'."\r\n";
					$i++;
				}
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=Deals.xls');
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				echo "\xEF\xBB\xBF"; // UTF-8 BOM
				echo $out;
				exit;
			}
		$this->template->content = new View("admin_deal/manage_deals");
	}

	/** VIEW DEALS **/

	public function view_deals($deal_key= "", $deal_id = "")
	{
		if(!ADMIN_PRIVILEGES_DEALS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($_POST){
	        $commission = $this->input->post('commission_status');
	        $deal_key = $this->input->post('commission_deal_key');
	        $deal_id = $this->input->post('commission_deal_id');
	                if($commission != ""){
	                        $commission_deatils = $this->deals->change_commission_data($commission, $deal_id);
	                }
	                common::message(1, $this->Lang["COMMISSION_CHANGE_STATUS"]);
	                url::redirect(PATH."admin/view-deal/".$deal_key."/".$deal_id.".html");
	        }
		$this->deal_key = $deal_key;
		$this->deal_id = $deal_id;
		$this->sort_url="";
		$this->manage_deals="1";
		$this->deal_deatils = $this->deals->get_deals_data($deal_key, $deal_id);
		$this->transaction_list = $this->deals->get_transaction_data($deal_id);
		$this->cod_transaction_list = $this->deals->get_transaction_data($deal_id,5);
		if(count($this->deal_deatils) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			$lastsession = $this->session->get("lasturl");
                        if($lastsession){
                        url::redirect(PATH.$lastsession);
                        } else {
                        url::redirect(PATH."admin/manage-deals.html");
                        }
		}
		$serch=$this->input->get("id");
		if($serch){
			if($serch!='COD'){
				$out = '"S.No","Customers","Deal Title","Quantity","Amount","Admin Commission","Status","Transaction Date","Transaction Type"'."\r\n";
				$i=0;
				$first_item = $i+1;
				foreach($this->transaction_list as $d)
				{
					if($d->payment_status=="SuccessWithWarning"){	$status=$this->Lang["SUCCESS"]; }
					elseif($d->payment_status=="Completed"){ $status=$this->Lang["COMPLETED"]; }
					elseif($d->payment_status=="Success"){ $status=$this->Lang["SUCCESS"]; }
					elseif($d->payment_status=="Pending"){ $status=$this->Lang["PENDING"]; }
					elseif($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }
					if($d->type=="1"){ $transaction_type=$this->Lang["PAYPAL_CREDIT"]; }
					elseif($d->type=="2"){ $transaction_type=$this->Lang["PAYPAL"]; }
					elseif($d->type=="3"){ $transaction_type=$this->Lang["REF_PAYMENT"]; }
					elseif($d->type=="4"){ $transaction_type="Authorize.net(".$d->transaction_type.")"; }
					elseif($d->type=="6"){ $transaction_type=$this->Lang["PAY_LATER"]; }
					//elseif($d->type=="5"){ $transaction_type="Cash On Delivery"; }
					$commission_val=$d->deal_merchant_commission;
					 $commission=$d->deal_value *($commission_val/100);
					 $Amount=($d->deal_value-$commission)*$d->quantity;
					$out .= $i + $first_item.',"'.$d->firstname.'","'.$d->deal_title.'","'.$d->quantity.'","'.($d->deal_value-$commission)*$d->quantity.'","'.$commission*$d->quantity.'","'.$status.'","'.date('d-M-Y h:i:s A',$d->transaction_date).'","'.$transaction_type.'"'."\r\n";
					$i++;
				}
			        } else {
				$out = '"S.No","Customers","Deal Title","Quantity","Amount","Admin Commission","Status","Transaction Date","Transaction Type"'."\r\n";
				$i=0;
				$first_item = $i+1;
				foreach($this->cod_transaction_list as $d)
				{
					if($d->payment_status=="SuccessWithWarning"){	$status=$this->Lang["SUCCESS"]; }
					elseif($d->payment_status=="Completed"){ $status=$this->Lang["COMPLETED"]; }
					elseif($d->payment_status=="Success"){ $status=$this->Lang["SUCCESS"]; }
					elseif($d->payment_status=="Pending"){ $status=$this->Lang["PENDING"]; }
					elseif($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }
					$transaction_type="Cash On Delivery";
					$commission_val=$d->deal_merchant_commission;
					 $commission=$d->deal_value *($commission_val/100);
					 $Amount=($d->deal_value-$commission)*$d->quantity;
					$out .= $i + $first_item.',"'.$d->firstname.'","'.$d->deal_title.'","'.$d->quantity.'","'.($d->deal_value-$commission)*$d->quantity.'","'.$commission*$d->quantity.'","'.$status.'","'.date('d-M-Y h:i:s A',$d->transaction_date).'","'.$transaction_type.'"'."\r\n";
					$i++;
				}
			}
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=Deal-transactions.xls');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			echo "\xEF\xBB\xBF"; // UTF-8 BOM
			echo $out;
			exit;
			}
		$this->category_list = $this->deals->all_category_list();
		$this->commission_list = $this->deals->get_merchant_balance();
		$this->template->title = $this->Lang["DEAL_DET"];
		$this->template->content = new View("admin_deal/view_deal");
	}

	/** EDIT DEALS **/

	public function edit_deals($deal_id = "", $deal_key = "")
	{
		if(!ADMIN_PRIVILEGES_DEALS_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $deal_id = base64_decode($deal_id);
		$this->manage_deals="1";
                $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js', PATH.'js/multiimage.js'));
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
	        if($_POST){
				$this->userPost = $this->input->post();
				$post = Validation::factory(array_merge($_POST,$_FILES))
								->pre_filter('trim', 'title')
								->add_rules('title', 'required')
								->add_rules('description','required',array($this,'check_required'))
								->add_rules('category', 'required')
								->add_rules('sub_category', 'required')
								->add_rules('sec_category', 'required')
								->add_rules('price', 'required', 'chars[0-9.]',array($this,'check_price_val_lmi'))
								->add_rules('deal_value', 'required', array($this, 'check_price_lmi'),'chars[0-9.]',array($this,'check_deal_value_lmi'))
								->add_rules('start_date', 'required')
								->add_rules('end_date', 'required', array($this, 'check_end_date'))
								->add_rules('expiry_date', 'required', array($this, 'check_expiry_date'))
								->add_rules('minlimit', 'required',array($this,'check_min_lmi'),'chars[0-9]')
								->add_rules('maxlimit', 'required','chars[0-9]',array($this,'check_maxlimit_lmi'))
								->add_rules('deal_type', 'required')
								->add_rules('quantity', 'required', array($this,'check_purchace_lmi'),'chars[0-9]')
								->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
								->add_rules('users', 'required')
								->add_rules('stores','required');
				if($post->validate()){
					$status = $this->deals->edit_deals($deal_id, $deal_key, arr::to_object($this->userPost));

							if($status == 1 && $deal_key){
								if($_FILES['image']['name']!= ""){
								$i=1;
								foreach(arr::rotate($_FILES['image']) as $files){
									if($files){
										$filename = upload::save($files);
										if($filename!=''){
											if($i==1)
											{
											$IMG_NAME = $deal_key."_1.png";
											common::image($filename, 620, 752, DOCROOT.'images/deals/1000_800/'.$IMG_NAME);
											} else { // replace if the 1st image s empty with the next successive image
												for($j=2;$j<=$i;$j++) {
												$IMG_NAME1 = $deal_key."_".$i;
												common::image($filename, 620, 752, DOCROOT.'images/deals/1000_800/'.$IMG_NAME1.'.png');
												}

											}

											$IMG_NAME = $deal_key."_".$i.'.png';

											common::image($filename, 620,752, DOCROOT.'images/deals/1000_800/'.$IMG_NAME);
											unlink($filename);
											}
									}
									$i++;
							  }
						}
						common::message(1, $this->Lang["DEAL_EDIT_SUC"]);
						$lastsession = $this->session->get("lasturl");
                                                if($lastsession){
                                                url::redirect(PATH.$lastsession);
                                                } else {
                                                url::redirect(PATH."admin/manage-deals.html");
                                                }
					}
					elseif($status == 8){
						common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
						$lastsession = $this->session->get("lasturl");
                                                if($lastsession){
                                                url::redirect(PATH.$lastsession);
                                                } else {
                                                url::redirect(PATH."admin/manage-deals.html");
                                                }
					}
				} else {
					$this->form_error = error::_error($post->errors());
				}
		}

        $this->category_list = $this->deals->get_category_list();
	$this->sub_category_list = $this->deals->get_sub_category_list();
	$this->sec_category_list = $this->deals->get_sec_category_list();
	$this->third_category_list = $this->deals->get_third_category_list();
        $this->get_marchant_list = $this->deals->getmarchantlist();
        $this->shop_list = $this->deals->get_shop_list();
        $this->deal = $this->deals->get_edit_deal($deal_id,$deal_key);
        if(($this->deal->current()->enddate) <  time() ){
		common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		$lastsession = $this->session->get("lasturl");
                        if($lastsession){
                        url::redirect(PATH.$lastsession);
                        } else {
                        url::redirect(PATH."admin/manage-deals.html");
                        }
	}
        $this->template->title = $this->Lang["EDIT_DEAL"];
        $this->template->content = new View("admin_deal/edit_deal");
	}

	/**SEND EMAIL COPUONS **/

        public function send_email($deal_id = "", $deal_key = "")
        {
			$this->manage_deals="1";
			$this->deal_deatils = $this->deals->get_deals_data_mail($deal_key, $deal_id);
			if(count($this->deal_deatils) == 0){
                                common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
                                url::redirect(PATH."admin/manage-deals.html");
                        }
				if($_POST){
						$this->deal_deatils = $this->deals->get_deals_data_mail($deal_key, $deal_id);
						$this->userPost = $this->input->post();
						$users = $this->input->post("users");
						$fname = $this->input->post("firstname");
						$email = $this->input->post("email");
						$post = Validation::factory(array_merge($_POST,$_FILES))
										->add_rules('users', 'required')
										->add_rules('email','required')
										->add_rules('subject', 'required','chars[a-zA-z0-9- _,/.+]')
										->add_rules('message', 'required');
							if($post->validate()){

								foreach($email as $mail){
									$mails = explode("__",$mail);
									$useremail = $this->mail= $mails[0];
									$username =  $mails[1];
									if(isset($username) && isset($useremail))
										$message = " <p> ".$post->message." </p>";
										$message .= new View ("admin_deal/mail_deal");
										
                                                                                $this->email_id = $useremail;
                                                                                $this->name = $username;
                                                                                $this->message = $message;
                                                                                $fromEmail = NOREPLY_EMAIL;
                                                                                $message = new View("themes/".THEME_NAME."/admin_mail_template");
                                                                                				
										$fromEmail = NOREPLY_EMAIL;
										if(EMAIL_TYPE==2){
										email::smtp($fromEmail,$useremail,$post->subject,$message);
		}								else {
										email::sendgrid($fromEmail,$useremail,$post->subject,$message);
										}
										common::message(1, $this->Lang["MAIL_SENDED"]);

								}
								$lastsession = $this->session->get("lasturl");
                                                                if($lastsession){
                                                                url::redirect(PATH.$lastsession);
                                                                } else {
                                                                url::redirect(PATH."admin/manage-deals.html");
                                                                }
							}
							else{
								$this->form_error = error::_error($post->errors());
							}
				}
			$this->template->title = $this->Lang["EMAIL_NEWS"];
			$this->template->content = new View("admin_deal/send_mail");
        }

		/** CLOSED COUPON LIST  **/

	public function closed_coupon($page = "")
	{
		if(!ADMIN_PRIVILEGES_DEALS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->page = $page ==""?1:$page; // for export per page
		$this->close_code = 1;
		$serch=$this->input->get("id");
		$count = $this->deals->get_coupon_count($this->input->get("coupon_code"), $this->input->get('name'));

		$this->search_key = arr::to_object($this->input->get());
		$this->pagination = new Pagination(array(
				'base_url'       => 'admin/close-couopn-list.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));

		$this->all_coupon_list = $this->deals->get_coupon_list($this->pagination->sql_offset, $this->pagination->items_per_page ,$this->input->get("coupon_code"), $this->input->get('name'),0);

		if($serch =='all'){
			$this->all_coupon_list = $this->deals->get_coupon_list($this->pagination->sql_offset, $this->pagination->items_per_page ,$this->input->get("coupon_code"), $this->input->get('name'),1);
		}

			if($serch){
				$out = '"S.No","Deal Name","User Name","Coupon Code","Date","Image"'."\r\n";

				$i=0;
				$first_item = $this->pagination->current_first_item;
					foreach($this->all_coupon_list as $d)
					{

							if(file_exists(DOCROOT.'images/deals/1000_800/'.$d->deal_key.'_1.png'))
							{
								$deal_image =PATH.'images/deals/1000_800/'.$d->deal_key.'_1.png';
							}
							else
							{
								$deal_image =PATH.'images/no-images.png';
							}
						$out .= $i+$first_item.',"'.$d->deal_title.'","'.$d->firstname.'","'.$d->coupon_code.'","'.date('m/d/Y H:i:s',$d->transaction_date).'","'.$deal_image.'"'."\r\n";
						$i++;
					}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=Redem-coupon-list.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}
		$this->template->title = $this->Lang['REDEM_COU_LI'];
		$this->template->content = new View("admin_deal/closed_coupon_list");

	}

		/** SELECT EMAIL UNDER THE USER **/

        public function user_select($users= "")
	    {
				if($users == 4){
		            $shoplistlist = $this->deals->get_users_data($users);
		        }
		        else if($users == 10){

		        echo $list = '<div class="input-text1 clearfix"><label>Select Email* :</label>
		                      <div class="search-input1"><div class="add_pt">
							  <ul>
							  <li><span>'.$this->Lang["SEL_USER_FST"].'</span></li></ul></div></div> </div>'; exit;
		        }

		        if(count($shoplistlist) > 0){
					$list = '<div class="input-text1 clearfix"><label>Select Email* :</label>
		                	 <div class="search-input1" ><div class="add_pt">


							 <ul>
							 <li><input type="checkbox" name="email" onclick="checkboxcheckAll(&#39;newsletter&#39;,&#39;email&#39;)" /><span>Select all</span></li>';
					foreach($shoplistlist as $s){
						$list .= '<li><input type="hidden" name="firstname[]" value="'.$s->firstname.'" /><input type="checkbox" name="email[]" class="case" value="'.$s->email.'__'.$s->firstname.'" /><span>'.$s->email.'</span></li>';
					}
					echo $list .='</ul></div></div></div>';
				}
				exit;
	}

	/** BLOCK UNBLOCK DEALS **/

	public function block_deals($type = "", $key = "", $deal_id = "")

	{
		if(!ADMIN_PRIVILEGES_DEALS_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}

		$status = $this->deals->blockunblockdeal($type, $key, $deal_id);
			if($status == 1){
		        if($type == 1){
			        common::message(1, $this->Lang["DEAL_UNB_SUC"]);
			        }
			        else{
			        common::message(1, $this->Lang["DEAL_B_SUC"]);
			        }
			}
			else{
		        common::message(-1, $this->Lang["DEAL_ACTIVE"]);
			}
                        $lastsession = $this->session->get("lasturl");
                        if($lastsession){
                        url::redirect(PATH.$lastsession);
                        } else {
                        url::redirect(PATH."admin/manage-deals.html");
                        }
	}

		/** VALIDATE COUPON **/
	public function validate_coupon()
	{
			$coupon = $this->input->get('coupon');
			$amount = base64_decode($this->input->get('amount'));
			$trans_id = base64_decode($this->input->get('trans_id'));
			$coupon_check = $this->deals->validate_coupon($coupon,$amount,$trans_id);

	}

	/** CHECK MIN USER LIMIT LESS THAN MAX USER LIMIT **/

	public function check_min_lmi()
	{
		if(($this->input->post("minlimit"))<=$this->input->post("maxlimit")){
			return 1;
		}
		return 0;
	}

	/** CHECK DISCOUNT PRICE  LESS THAN ORGINAL PRICE **/

	public function check_price_lmi()
	{
		if(($this->input->post("deal_value"))<=$this->input->post("price")){
			return 1;
		}
		return 0;
	}

	/** CHECK MAX USER PURCHACE LIMIT LESS THAN MAX USER LIMIT**/

	public function check_purchace_lmi()
	{
		if(($this->input->post("quantity"))<=$this->input->post("maxlimit")){
			return 1;
		}
		return 0;
	}

	/** CHECK VALID PHONE OR NOT **/

	public function validphone($phone = "")
	{
		if(valid::phone($phone,array(7,10,11,12,13,14)) == TRUE){
			return 1;
		}
		return 0;
	}

	/** CHECK ENDDATE GREATER STARTDATE **/

	public function check_end_date($end_date = "")
	{
		if(strtotime($this->input->post("start_date")) < strtotime($end_date)){
			return 1;
		}
		return 0;
	}

    /** CHECK DISCOUNT PRICE **/

	public function discount($savings= "")
	{
		if(($this->input->post("price")) > ($savings)){
			return 1;
		}
		return 0;
	}

	/** CHECK EXPIRY DATE GREATER ENDDATE **/

	public function check_expiry_date($expiry_date = "")
	{
		if(strtotime($this->input->post("end_date")) <= strtotime($expiry_date)){
			return 1;
		}
		return 0;
	}

	/** CHECK VALID IMAGE URL **/

	public function valid_image_url($url = "")
	{
		if(remote::status($url) == 200){
			return 1;
		}
		return 0;
	}

	/** CHECK IMAGE OR IMAGE URL ADDED **/

	public function check_image_or_url($image = "")
	{
		if($image["name"] || $this->input->post("image_url")){
			return 1;
		}
		return 0;
	}

	/** SELECT CITY AND AND CITY UNDER USER **/

    public function shop($users= "")
	{

		if($users == -1){
			$list = '<td><label>Select Shop*</label></td><td><label>:</label></td><td><select name="stores">';
			$list .='<option value="">Select Merchant First</option>';
			echo $list .='</select></td>';
		exit;
		}
		else{
		        $shoplistlist = $this->deals->get_store_by_users($users);
		        if(count($shoplistlist) > 0){
					$list = '<td><label>Select Shop*</label></td>
						     <td><label>:</label></td>
                             <td><select name="stores">';
					foreach($shoplistlist as $s){
						$list .='<option value="'.$s->store_id.'">'.ucfirst($s->store_name).'</option>';
					}
					echo $list .='</select></td>';
				}
				else {
					$list = '<td><label>Select Shop*</label></td><td><label>:</label></td><td><select name="stores">';
					$list .='<option value="">No Shops Under This Merchant</option>';
					echo $list .='</select></td>';
				}
				exit;
		}
	}

	/** SELECT SUB CATEGORY AND UNDER CATEGORY USER **/

    public function change_category($category= "")
	{
		if($category == -1){
			$list = '<td><label>Select Main Category*</label></td><td><label>:</label></td><td><select name="sub_category">';
			$list .='<option value="">Select Category First</option>';
			echo $list .='</select></td>';
		    exit;
		}
		else {
		        $categorylist = $this->deals->get_sub_category($category);
		        if(count($categorylist) > 0){
					$list = '<td><label>Select Main Category*</label></td>
								<td><label>:</label></td>


								<td><select name="sub_category" onchange="return sec_change_category(this.value);">
								<option value="">Select Any Category</option>';
					foreach($categorylist as $s){
						$list .='<option value="'.$s->category_id.'">'.ucfirst($s->category_name).'</option>';
					}
					echo $list .='</select></td>';
				}
				else {
					$list = '<td><label>Select Main Category*</label></td><td><label>:</label></td><td><select name="sub_category">';
					$list .='<option value="">No Main Category</option>';
					echo $list .='</select></td>';
				}
				exit;
		}
	}


	public function sec_change_category($category= "")
	{
		if($category == -1){
			$list = '<td><label>Select Sub Category*</label></td><td><label>:</label></td><td><select name="sub_category">';
			$list .='<option value="">Select Main Category First</option>';
			echo $list .='</select></td>';
		    exit;
		}
		else {
		        $categorylist = $this->deals->get_sec_category($category);
		        if(count($categorylist) > 0){
					$list = '<td><label>Select Sub Category*</label></td>
								<td><label>:</label></td>
                                                                <td><select name="sec_category" onchange="return third_change_category(this.value);">
								<option value="">Select Any Category</option>';
					foreach($categorylist as $s){
						$list .='<option value="'.$s->category_id.'">'.ucfirst($s->category_name).'</option>';
					}
					echo $list .='</select></td>';
				}
				else {
					$list = '<td><label>Select Sub Category*</label></td><td><label>:</label></td><td><select name="sec_category">';
					$list .='<option value="">No Sub Category</option>';
					echo $list .='</select></td>';
				}
				exit;
		}
	}


	public function third_change_category($category= "")
	{
		if($category == -1){
			$list = '<td><label>Select Second Sub Category</label></td><td><label>:</label></td><td><select name="third_category">';
			$list .='<option value="">Select Sub Category First</option>';
			echo $list .='</select></td>';
		    exit;
		}
		else {
		        $categorylist = $this->deals->get_third_category($category);
		        if(count($categorylist) > 0){
					$list = '<td><label>Select Second Sub Category</label></td>
								<td><label>:</label></td>
                                                                <td><select name="third_category" > <option value="">Select Any Category</option> ';
					foreach($categorylist as $s){
						$list .='<option value="'.$s->category_id.'">'.ucfirst($s->category_name).'</option>';
					}
					echo $list .='</select></td>';
				}
				else {
					$list = '<td><label>Select Second Sub Category</label></td><td><label>:</label></td><td><select name="third_category">';
					$list .='<option value="">No Sub Category</option>';
					echo $list .='</select></td>';
				}
				exit;
		}
	}

	/** MANAGE USER COMMENTS **/

	public function manage_users_comments($deal_type = "",$page = "")
	{
				$this->deal_comments = 1;

		$this->count_user = $this->deals->get_users_comments_count($this->input->get('firstname'),$deal_type);
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-deal-comments.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $this->count_user,
				'items_per_page' => 20,
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->search = $this->input->get();
		$this->search_key = arr::to_object($this->search);
		$this->users_list = $this->deals->get_users_comments_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('firstname'),$deal_type);

		$this->template->title = $this->Lang["USER_COMM"];
		$this->template->content = new View("admin_deal/manage_users_comments");
	}

	/** UPDATE USER COMMENTS **/

	public function edit_users_comments($commentsid = "")
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($_POST){
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
					->add_rules('comments', 'required');
                        if($post->validate()){
                        $status = $this->deals->edit_users_comments($commentsid, arr::to_object($this->userpost));
                                if($status ==1){
                                        common::message(1, $this->Lang["COMM_SET_SUC"]);
                                        url::redirect(PATH.'admin/manage-deal-comments.html');
                                }
                        }
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->users_comments_data = $this->deals->get_users_comments_data($commentsid);
			if(count($this->users_comments_data) == 0){
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				url::redirect(PATH."admin/manage-deal-commants.html");
			}
		$this->template->title = $this->Lang["COMM_MERCHANT"];
		$this->template->content = new View("admin_deal/edit_users_comments");
	}

	/** BLOCK AND UNBLOCK USERCOMMENTS **/

	public function block_users_comments($type = "", $uid = "")
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->deals->blockunblockusercomments($type, $uid);
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
		url::redirect(PATH."admin/manage-deal-comments.html");
	}

	/** DELETE USERCOMMENTS **/

	public function delete_users_comments($discussion_id = "")
	{
		$status = $this->deals->deleteusercomments($discussion_id);
		if($status == 1){
				common::message(1, $this->Lang["COMM_DEL"]);
			}
		url::redirect(PATH."admin/manage-deal-comments.html");
	}

	/** CHECK PRICE VALUE LIMIT **/
	public function check_price_val_lmi()
	{
		if(($this->input->post("price"))!= '0'){
			return 1;
		}
		return 0;
	}

	/** DEAL VALUE LIMIT **/
	public function check_deal_value_lmi()
	{
		if(($this->input->post("deal_value"))!= '0'){
			return 1;
		}
		return 0;
	}

	/** MAXLIMIT VALUE LIMIT **/
	public function check_maxlimit_lmi()
	{
		if(($this->input->post("maxlimit"))!= '0'){
			return 1;
		}
		return 0;
	}

	/** FORCE CLOSE DEALS **/
	public function forceclose_deal($deal_id = "", $deal_key = "")
	{
		$status = $this->deals->force_close_deal($deal_id, $deal_key);
		if($status == 1){
		        common::message(1,$this->Lang["DEAL_CLOSE"]);
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/archive-deals.html");
                }
		
	}

	/** DASHBOARD DEALS **/
	public function dashboard_deals()
	{
		if(!ADMIN_PRIVILEGES_DEALS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->start_date = "";
		$this->end_date = "";
			if($_GET){
				$this->start_date = $this->input->get('start_date');
				$this->end_date = $this->input->get('end_date');
			}
                $this->dashboard_deals="1";
                $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js',PATH.'js/jquery.js'));
                $this->start_date = $this->input->get("start_date");
                $this->end_date = $this->input->get("end_date");
                $this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->transaction_list = $this->deals->get_transaction_chart_list();

                $this->deals_transaction_list = $this->deals->get_transaction_chart_list();
                $this->deals_dashboard_data = $this->deals->get_deals_chart_list();
                $this->template->content = new View("admin_deal/deals_dashboard");
                $this->template->title = $this->Lang["DEAL_DASH"];
	}

	/*MULTIPLE IMAGE DELETE */
	public function delete_images()
	{
		$this->img=$this->input->get("img");
		$this->deal_id=$this->input->get("id");
		$IMG_NAME=base64_decode($this->img);
		$this->deal_key=$this->input->get("deal_key");
		$a = explode('_',$IMG_NAME);
		if($a[1] == 1) {
			if(file_exists(DOCROOT.'images/deals/1000_800/'.$IMG_NAME.'.png')) {
			        for($i=2;$i<=5;$i++) {
				        $IMG_NAME1 = $this->deal_key."_".$i;
				        if(file_exists(DOCROOT.'images/deals/1000_800/'.$IMG_NAME1.'.png')) {
				        break;
				        }
			        }
			        if(file_exists(DOCROOT.'images/deals/1000_800/'.$IMG_NAME1.'.png')) {
			        $filename= DOCROOT."images/deals/1000_800/".$IMG_NAME1.".png";
			        //common::image($filename, DEAL_LIST_WIDTH, DEAL_LIST_HEIGHT,DOCROOT.'images/deals/1000_800/'.$IMG_NAME.'.png');
			        }
		        }
		}
		else{
			for($i=1;$i<=5;$i++) {
				$IMG_NAME1 = $this->deal_key."_".$i;
				if(file_exists(DOCROOT.'images/deals/1000_800/'.$IMG_NAME1.'.png')) {
				break;
				}
			}
			if(file_exists(DOCROOT.'images/deals/1000_800/'.$IMG_NAME1.'.png')) {
			$filename= DOCROOT."images/deals/1000_800/".$IMG_NAME1.".png";
			//common::image($filename, PRODUCT_LIST_WIDTH, PRODUCT_LIST_HEIGHT, DOCROOT.'images/deals/1000_800/'.$this->deal_key.'_1.png');
			}
		}
		if(file_exists(DOCROOT.'images/deals/1000_800/'.$IMG_NAME.'.png')) {
			$filename= DOCROOT.'images/deals/1000_800/'.$IMG_NAME.'.png';
			unlink($filename);
		}
		url::redirect(PATH."admin/edit-deal/".base64_encode($this->deal_id)."/".$this->deal_key.".html");
	}

	public function check_required($val = "")
	{
		if(strip_tags($val) == "") return 0;return 1;
	}

	/*MANAGE HOT DEALS */

	public function popular_list($product="",$type="")
	{
		$this->popular_product_list = $this->deals->get_hot_product_list($product,$type);
		exit;
	}

}
