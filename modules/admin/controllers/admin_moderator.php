<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_moderator_Controller extends website_Controller {

	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id || $this->user_type != 1) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		$this->moderator = new Admin_moderator_Model();	
		$this->moderator_act = "1";	
	}
	
	/** DASHBOARD ADMIN USER LIST**/	
	public function dashboard_moderator()
	{
		$this->dashboard_moderator = "1";
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
		$this->user_list = $this->moderator->get_user_list();
		$this->template->content = new View("admin_moderator/moderator_dashboard");
		$this->template->title = $this->Lang['CUSTM_DASH'];
		
	}
	/** ADD ADMIN USERS **/
	
	public function add_moderator()
	{
		$this->add_moderator = "1";
		if($_POST){
			$from = CONTACT_EMAIL;    	
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('firstname', 'required')
						->add_rules('lastname', 'required')
						->add_rules('email', 'required','valid::email', array($this, 'email_available'))
						->add_rules('mobile', 'required', array($this, 'validphone'), 'chars[0-9-+(). ]')
						->add_rules('address1', 'required')
						->add_rules('country', 'required')
						->add_rules('city', 'required');
			if($post->validate()){
				$referral_id = text::random($type = 'alnum', $length = 8);
				$password = text::random($type = 'alnum', $length = 8);
				$status = $this->moderator->add_moderator(arr::to_object($this->userPost),$referral_id,$password);
				if($status == 1){
					$from = CONTACT_EMAIL;    						
					$this->admin_signup_moderator = "1";
					$this->email = $post->email;
					$this->password = $password;
					$this->name =$post->firstname;
					$this->moderator = "1";
                      $data = array(
					 "privileges_deals","privileges_deals_add","privileges_deals_edit","privileges_deals_block",
					 "privileges_products","privileges_products_add","privileges_products_edit","privileges_products_block",
					 "privileges_auctions","privileges_auctions_add","privileges_auctions_edit","privileges_auctions_block",
					 "privileges_customer","privileges_customer_add","privileges_customer_edit","privileges_customer_block",
					 "privileges_merchant","privileges_merchant_add","privileges_merchant_edit","privileges_merchant_block",
					 "privileges_blogs","privileges_blogs_add","privileges_blogs_edit","privileges_blogs_block",
					 "privileges_cms","privileges_cms_add","privileges_cms_edit","privileges_cms_block",
					 "privileges_attributs","privileges_attributs_add","privileges_attributs_edit","privileges_attributs_block",
					 "privileges_categories","privileges_categories_add","privileges_categories_edit","privileges_categories_block",
					 "privileges_country","privileges_country_add","privileges_country_edit","privileges_country_block",
					 "privileges_city", "privileges_city_add", "privileges_city_edit", "privileges_city_block",
					 "privileges_transactions","privileges_fundrequest","privileges_fundrequest_edit","privileges_daily_newsletter","privileges_storecredit","privileges_customercare","privileges_customercare_add","privileges_customercare_edit","privileges_customercare_block","privileges_banner","privileges_banner_add","privileges_banner_edit","privileges_banner_block","privileges_specification","privileges_specification_add","privileges_specification_edit","privileges_specification_block","privileges_sector","privileges_sector_add","privileges_sector_edit","privileges_sector_block","privileges_ads","privileges_ads_add","privileges_ads_edit","privileges_ads_block","privileges_faq","privileges_faq_add","privileges_faq_edit","privileges_faq_block","privileges_newsletter","privileges_newsletter_add","privileges_newsletter_edit","privileges_newsletter_block");
					   $arr =array();
					   if(count($data)){
							   foreach($data as $row) {
										if(isset($_POST[$row])=="1"){
										$field = (isset($_POST[$row]))?1:0;
										$arr[$row] = $field.',';
										}
							   }
					   }
					   $dispaly_privi = "";
					   foreach($arr as $key => $value){
						$cont_privi = substr($key,11);
						$cont_privi_rep = str_replace("_"," ",$cont_privi);
						$dispaly_privi .= ucfirst($cont_privi_rep). " , ";
					   }
					   $this->front_end = 1;
						$this->moderator_privileges = substr($dispaly_privi,0,-2); 
						$message = new View("themes/".THEME_NAME."/mail_template");
						if(EMAIL_TYPE==2){
							email::smtp($from, $post->email, SITENAME , "<p>". SITENAME." - Moderator Registration </p>". $message);
						}else{
							email::sendgrid($from, $post->email, SITENAME , "<p>". SITENAME." - Moderator Registration </p>". $message);
						}
							common::message(1, $this->Lang["MODE_ADD_SUC"]);
							url::redirect(PATH."admin/manage-moderator.html");
						}
			}
			else{
				$this->form_error = error::_error($post->errors());	
			}
		}
		$this->country_list = $this->moderator->getcountrylist();
		$this->city_list = $this->moderator->getCityList();
		$this->template->title = $this->Lang["ADD_MODE"];
		$this->template->content = new View("admin_moderator/add_moderator");
	}
	/** CHECK EMAIL EXIST **/
	 
	public function email_available($email)
	{
		$exist = $this->moderator->exist_email($email);
		return !$exist;
	}
	/** CHECK VALID PHONE OR NOT **/
	
	public function validphone($phone = "")
	{
		if(valid::phone($phone,array(7,10,11,12,13,14)) == TRUE){
			return 1;
		}
		return 0;
	}
	/** Manage Users **/
	
	public function manage_moderator($page = "")
	{
		$this->page = $page ==""?1:$page; // for export per page

		$this->url="admin/manage-moderator.html"; // for export
		
		$this->manage_moderator = "1";
		
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
				url::redirect(PATH."admin/manage-moderator.html");
			}
			else{	
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->type = $this->input->get('sort');
		$this->sort = $this->input->get('param');
		$this->sort_url= PATH.'admin/manage-moderator.html?';
		$this->count_user = $this->moderator->get_moderator_count($this->input->get('name'), $this->input->get('email'), $this->input->get('city'), $this->input->get('logintype'),$this->type,$this->sort);

 

        $this->pagination = new Pagination(array(
            'base_url'       => 'admin/manage-moderator.html/page/'.$page."/",
            'uri_segment'    => 4,
            'total_items'    => $this->count_user,
            'items_per_page' => 10, 
            'style'          => 'digg',
            'auto_hide'      => TRUE
        ));
        $search = $this->input->get('id'); 
        $this->search = $this->input->get(); 
        $this->search_key = arr::to_object($this->search); 
        $this->city_list = $this->moderator->getCityListOnly();
        
        $this->users_list = $this->moderator->get_moderator_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('name'), $this->input->get('email'), $this->input->get('city'), $this->input->get('logintype'),$this->type,$this->sort,0);

			if($search == 'all'){ // for export all
				$this->users_list = $this->moderator->get_moderator_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('name'), $this->input->get('email'), $this->input->get('city'), $this->input->get('logintype'),$this->type,$this->sort,1);
			}
			if($search){
							
					$out = '"S.no","First-Name","Last-Name","E-Mail","Phone Number","Address1","Address2","Country","City","Joindate"'."\r\n";			
					$i=0; 
					$first_item = $this->pagination->current_first_item;
				foreach($this->users_list as $d)
				{
					$out .= $i+$first_item.',"'.$d->firstname.'","'.$d->lastname.'","'.$d->email.'","'.$d->phone_number.'","'.$d->address1.'","'.$d->address2.'","'.$d->country_name.'","'.$d->city_name.'","'.date('d-M-Y h:m:i a',$d->joined_date).'"'."\r\n";
					$i++;					
				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream'); 
					header('Content-Disposition: attachment; filename=Moderators.csv');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out; 
					exit;
			}	
                $this->template->title = $this->Lang["MANAGE_MODE"];
                $this->template->content = new View("admin_moderator/manage_moderator");
	}
	/** UPDATE USER MODERATOR DETAILS **/	
	
	public function edit_moderator($userid = "")
	{ 
		$this->manage_moderator = "1";
		if($_POST){
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);			
			$post = Validation::factory($_POST)
						->add_rules('firstname', 'required')
						//->add_rules('lastname','required','chars[a-zA-Z0-9 _-]')
						//->add_rules('email', 'required','valid::email',array($this,'email_available'))
						->add_rules('mobile', array($this, 'validphone'), 'chars[0-9-+(). ]')
						->add_rules('country', 'required')
						->add_rules('city', 'required');
			if($post->validate()){			
				$status = $this->moderator->edit_moderator($userid, arr::to_object($this->userpost));
				if($status ==1){
					common::message(1, $this->Lang["MODE_EDIT_SUC"]);
					url::redirect(PATH.'admin/manage-moderator.html');
				}
				elseif($status == 2 ){
					$this->form_error["email"] = $this->Lang["EMAIL_AL_E"];
				} 
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}		
		$this->city_list = $this->moderator->getCityList();
		$this->country_list = $this->moderator->getcountrylist();
		$this->moderator_list = $this->moderator->moderator_privileges($userid);
		$this->user_data = $this->moderator->get_moderator_data($userid);

		$this->cityid_name = $this->moderator->getCityId_name($this->user_data[0]->city_id);	

		if(count($this->user_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND_USER"]);
			url::redirect(PATH."admin/manage-moderator.html");
		}
		$this->template->title = $this->Lang["EDIT_MODE"];
		$this->template->content = new View("admin_moderator/edit_moderator");
	}
	/** BLOCK AND UNBLOCK USER **/
	
	public function block_moderator($type = "", $email="", $uid = "")
	{
	    $email = base64_decode($email);
		$status = $this->moderator->blockunblockuser($type, $uid, $email);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["MODE_UNB"]);
			}
			else{
				common::message(1, $this->Lang["MODE_B"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		url::redirect(PATH."admin/manage-moderator.html");
	}
	/** DELETE USER **/
	
	public function delete_moderator($uid = "", $email = "")
	{
	    $email =  base64_decode($email); 
		if($uid){
			$status = $this->moderator->deleteuser($uid, $email);
			if($status == 1){
				common::message(1, $this->Lang["MODE_DEL_SUC"]);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		url::redirect(PATH."admin/manage-moderator.html");
	}
	
	/** VIEW USER DETAILS**/
	
	public function view_moderator($user_id = "")
	{
	       
		$this->manage_moderator = "1";
		$this->users_deatils = $this->moderator->get_user_view_data($user_id);
		if(count($this->users_deatils) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-moderator.html");
		}
		$this->moderator_list = $this->moderator->moderator_privileges($user_id);
		$this->template->title = $this->Lang["MODE_DET"];
		$this->template->content = new View("admin_moderator/view_moderator");
	}
	
	
	
}
