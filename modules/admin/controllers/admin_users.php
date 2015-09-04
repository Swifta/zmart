<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_users_Controller extends website_Controller {

	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		 
		$this->users = new Admin_users_Model();	
		$this->users_act = "1";	
	}
	
	/** ADD USERS **/
	
	public function add_users()
	{
	        //$ip=$_SERVER['REMOTE_ADDR'];
	        /*$ip = "41.184.34.101"; //Nigeria
	        $ip_country_code="";
	        $ip_country_name="";
	        $ip_city_name="";		
		$url = "http://api.ipinfodb.com/v3/ip-city/?key=8042c4ccb295723ec0791f306df5f9e92632e9b1ba0beda3e1ff399f207d2767&ip=$ip";
		$data = file_get_contents($url);
		$dat = explode(";",$data);
		if($dat[3] != "-"){
		        $country_code=$dat[3];
		        $country_name=$dat[4];
		        $city_name=$dat[5];
		} else {
		        $geodata = Kogeoip::getRecord($ip);
		        $country_code=$geodata->country_code;
		        $country_name=$geodata->country_name;
		        $city_name="";
		        if(!isset($geodata->country_code)){
			        $country_code = "Other";
			        $country_name="Other";
		                $city_name="Other";
			}
		} */ 

		if(!ADMIN_PRIVILEGES_CUSTOMER_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->add_users = "1";
        
			if($_POST){
				$this->userPost = $this->input->post();
				$post = new Validation($_POST);
				$post = Validation::factory($_POST)
							->add_rules('firstname', 'required', 'chars[a-zA-Z0-9 _-]')
							->add_rules('lastname', 'required', 'chars[a-zA-Z0-9 _-]')
							->add_rules('email', 'required','valid::email', array($this, 'email_available'))
							->add_rules('mobile', 'required', array($this, 'validphone'), 'chars[0-9-+(). ]')
							->add_rules('address1', 'required')
							->add_rules('gender', 'required')
							->add_rules('age_range', 'required')
							->add_rules('country', 'required')
							->add_rules('city', 'required');
				if($post->validate()){
					$referral_id = text::random($type = 'alnum', $length = 8);
					$password = text::random($type = 'alnum', $length = 8);
					$status = $this->users->add_user(arr::to_object($this->userPost),$referral_id,$password);
						if($status == 1){
                                                                $from = CONTACT_EMAIL;    						
                                                                $this->admin_signup = "1";
                                                                $this->email = $post->email;
                                                                $this->password = $password;
                                                                $message = new View("themes/".THEME_NAME."/mail_template");

                                                                if(EMAIL_TYPE==2){
                                                                email::smtp($from, $post->email, SITENAME , "<p>". SITENAME." - Admin Registration For User Details</p>". $message);
                                                                }else{
                                                                email::sendgrid($from, $post->email, SITENAME , "<p>". SITENAME." - Admin Registration For User Details</p>". $message);

                                                                }
			
							common::message(1, $this->Lang["USER_ADD_SUC"]);
							url::redirect(PATH."admin/manage-user.html");
						}
				}
				else{
					$this->form_error = error::_error($post->errors());	
				}
			}
		$this->country_list = $this->users->getcountrylist();
		$this->city_list = $this->users->getCityList();
		$this->template->title = $this->Lang["ADD_USER"];
		$this->template->content = new View("admin_user/add_users");
	}
	
	/** Manage Users **/
	
	public function manage_users($page = "")
	{
	
		if(!ADMIN_PRIVILEGES_CUSTOMER)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
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

		$this->url="admin/manage-user.html"; // for export
		
		$this->manage_users = "1";
		
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
				url::redirect(PATH."admin/manage-user.html");
			}
			else{	
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->type = $this->input->get('sort');
		$this->sort = $this->input->get('param');
		$this->sort_url= PATH.'admin/manage-user.html?';
		$this->count_user = $this->users->get_users_count($this->input->get('name'), $this->input->get('email'), $this->input->get('city'), $this->input->get('logintype'),$this->type,$this->sort,$this->today,$this->startdate,$this->enddate);

 

        $this->pagination = new Pagination(array(
            'base_url'       => 'admin/manage-user.html/page/'.$page."/",
            'uri_segment'    => 4,
            'total_items'    => $this->count_user,
            'items_per_page' => 10, 
            'style'          => 'digg',
            'auto_hide'      => TRUE
        ));
        $search = $this->input->get('id'); 
        $this->search = $this->input->get(); 
        $this->search_key = arr::to_object($this->search); 
        $this->city_list = $this->users->getCityListOnly();
        
        $this->users_list = $this->users->get_users_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('name'), $this->input->get('email'), $this->input->get('city'), $this->input->get('logintype'),$this->type,$this->sort,0,$this->today,$this->startdate,$this->enddate);

			if($search == 'all'){ // for export all
				$this->users_list = $this->users->get_users_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('name'), $this->input->get('email'), $this->input->get('city'), $this->input->get('logintype'),$this->type,$this->sort,1,$this->today,$this->startdate,$this->enddate);
			}
			if($search){
							
					$out = '"S.no","First-Name","Last-Name","E-Mail","Phone Number","Address1","Address2","Country","City","Referral Earned Amount","Join Date"'."\r\n";			
					$i=0; 
					$first_item = $this->pagination->current_first_item;
				foreach($this->users_list as $d)
				{
					$out .= $i+$first_item.',"'.$d->firstname.'","'.$d->lastname.'","'.$d->email.'","'.$d->phone_number.'","'.$d->address1.'","'.$d->address2.'","'.$d->country_name.'","'.$d->city_name.'","'.(CURRENCY_SYMBOL.$d->user_referral_balance).'","'.date('d-M-Y h:m:i a',$d->joined_date).'"'."\r\n";
					$i++;					
				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream'); 
					header('Content-Disposition: attachment; filename=Users.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}	
                $this->template->title = $this->Lang["MANAGE_USER"];
                $this->template->content = new View("admin_user/manage_users");
	}
	
	/** UPDATE USER DETAILS **/	
	
	public function edit_users($userid = "")
	{ 
		if(!ADMIN_PRIVILEGES_CUSTOMER_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->manage_users = "1";
		if($_POST){
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);			
			$post = Validation::factory($_POST)
						->add_rules('firstname', 'required', 'chars[a-zA-Z0-9 _-]')
						//->add_rules('lastname','required','chars[a-zA-Z0-9 _-]')
						->add_rules('email', 'required','valid::email')
						->add_rules('mobile', array($this, 'validphone'), 'chars[0-9-+(). ]')
						->add_rules('gender', 'required')
						->add_rules('age_range', 'required')
						->add_rules('country', 'required')
						->add_rules('city', 'required');
			if($post->validate()){			
				$status = $this->users->edit_users($userid, arr::to_object($this->userpost));
				if($status ==1){
					common::message(1, $this->Lang["USER_EDIT_SUC"]);
					$lastsession = $this->session->get("lasturl");
		                        if($lastsession){
		                        url::redirect(PATH.$lastsession);
		                        } else {
		                        url::redirect(PATH."admin/manage-user.html");
		                        }
				}
				elseif($status == 2 ){
					$this->form_error["email"] = $this->Lang["EMAIL_AL_E"];
				} 
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}		
		$this->city_list = $this->users->getCityList();
		$this->country_list = $this->users->getcountrylist();
		$this->user_data = $this->users->get_users_data($userid);	
		if(count($this->user_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND_USER"]);
			url::redirect(PATH."admin/manage-user.html");
		}
		$this->template->title = $this->Lang["EDIT_USER"];
		$this->template->content = new View("admin_user/edit_users");
	}
	
	/** BLOCK AND UNBLOCK USER **/
	
	public function block_user($type = "", $email="", $uid = "")
	{
		if(!ADMIN_PRIVILEGES_CUSTOMER_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	    $email = base64_decode($email);
		$status = $this->users->blockunblockuser($type, $uid, $email);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["USER_UNB"]);
			}
			else{
				common::message(1, $this->Lang["USER_B"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
		url::redirect(PATH.$lastsession);
		} else {
		url::redirect(PATH."admin/manage-user.html");
		}
	}
	
	/** DELETE USER **/
	
	public function delete_user($uid = "", $email = "")
	{
		if(!ADMIN_PRIVILEGES_CUSTOMER_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	    $email =  base64_decode($email); 
		if($uid){
			$status = $this->users->deleteuser($uid, $email);
			if($status == 1){
				common::message(1, $this->Lang["USER_DEL_SUC"]);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
		url::redirect(PATH.$lastsession);
		} else {
		url::redirect(PATH."admin/manage-user.html");
		}
	}
	
	/** CHECK PASSWORD EXIST **/
	 
	public function check_password($password = "")
	{
		$exist = $this->users->exist_password($password, $this->user_id);
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
	
	/** COUNTRY BASED CITY SELECT**/
	
	public function CityS($country)
	{

		if($country == -1){
			$list = '<td><label>Select City</label></td><td><label>:</label></td><td><select name="city">';
			$list .='<option value=" " >Select Country First</option>';
			echo $list .='</select></td>';
		exit;
		}
		else{		
		        $CitySlist = $this->users->get_city_by_country($country);
		        if(count($CitySlist) == 0){
		                $list = '<td><label>Select City</label></td><td><label>:</label></td><td><select name="city">';
			        $list .='<option value="" >No city under this country </option>';
			        echo $list .='</select></td>';
		                exit;
		        }
		        else{
		                foreach($CitySlist as $s) {	
		                if($s->city_id != 0)
		                {
		                $list = '<td><label>Select City</label></td>
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
	
	/** VIEW USER DETAILS**/
	
	public function view_user($user_id = "")
	{
		if(!ADMIN_PRIVILEGES_CUSTOMER)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->manage_users = "1";
		$this->users_deatils = $this->users->get_user_view_data($user_id);
			if(count($this->users_deatils) == 0){
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				url::redirect(PATH."admin/manage-user.html");
			}
		$this->transaction_list = $this->users->get_transaction_data($user_id);
		$this->product_transaction_list = $this->users->get_transaction_product_data($user_id);
		$this->transaction_auction_list = $this->users->get_transaction_auction_data($user_id);
		$this->user_refrel_list= $this->users->user_refrel_list($user_id);
		$this->template->title = $this->Lang["USER_DET"];
		$this->template->content = new View("admin_user/view_users");
	}
	
	/** DASHBOARD USER LIST**/	
	public function dashboard_users()
	{
		if(!ADMIN_PRIVILEGES_CUSTOMER)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->dashboard_users = "1";

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
		$this->user_list = $this->users->get_user_list();
		$this->template->content = new View("admin_user/users_dashboard");
		$this->template->title = $this->Lang['CUSTM_DASH'];
	}	
	
	/** SEND EMAILS **/
	
	public function send_user_emails()
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->user_news_letter = "1";
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
											
						 $status = $this->users->send_newsletter(arr::to_object($this->userPost),$file1,1);
					}else{
						$status = $this->users->send_newsletter(arr::to_object($this->userPost),"",2);
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
	$this->city_list = $this->users->getCityList();       
	$this->users = $this->users->getUSERList();       
        $this->template->title = $this->Lang['SEND_NEWSL'];
        $this->template->content = new View("admin_user/send_user_email");	
	}
	
	public function user_mail_inbox($page="")
	{
		if(!ADMIN_PRIVILEGES_DAILY_NEWSLETTER)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->user_news_letter = "1";
		$this->message_list_count=$this->users->get_user_messages_count();
		 $this->pagination = new Pagination(array(
            'base_url'       => 'admin/email_inbox.html/page/'.$page."/",
            'uri_segment'    => 4,
            'total_items'    => $this->message_list_count,
            'items_per_page' => 10, 
            'style'          => 'digg',
            'auto_hide'      => TRUE
        ));
		$this->message_list=$this->users->get_user_messages($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->content = new View("admin_user/user_inbox_email");	
	}
	
	public function show_user_message($message_id="")
	{
		if(!ADMIN_PRIVILEGES_DAILY_NEWSLETTER)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->user_news_letter = "1";
		$this->message=$this->users->get_user_message($message_id);
		$this->template->content = new View("themes/".THEME_NAME."/user_inbox_email_messages");	
	}
	
}
