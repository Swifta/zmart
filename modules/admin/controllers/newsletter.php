<?php defined('SYSPATH') OR die('No direct access allowed.');
class Newsletter_Controller extends website_Controller {

	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		  
		$this->news = new Newsletter_Model();	

		$this->city_id= $this->session->get("CityID");
			
	}

	/** SUBSCRIBED USER **/
	
	public function subscribed_user($page = '')
	{   

                
                url::redirect(PATH."admin.html");
        	$this->subscriber_count = $this->news->subscriber_list_count();

		$this->pagination = new Pagination(array(
				'base_url'       => 'admin/subscribed-user.html/page/'.$page.'/',
				'uri_segment'    => 4,
				'total_items'    => $this->subscriber_count,
				'items_per_page' => 25, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->subscriber = $this->news->subscriber_list($this->pagination->sql_offset, $this->pagination->items_per_page);

        $this->template->title = $this->Lang['MANAGE_SUBSCRIBER'];
        $this->template->content = new View("newsletter/subscriber");
	}
	
	/** BLOCK UNBLOCK SUBSCRIBER **/
	
	public function block_subscriber($type = "", $user_id = "")
	{   
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
			
		$status = $this->news->blockunblocksubscriber($type,$user_id);

		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang['SUB_SUCCESS']);
			}
			else{
				common::message(1, $this->Lang['SUCCESS_UNSUBSCRIBE']);
			}
		}
		else{
			common::message(-1, $this->Lang['NO_RECORD_FOUND']);
		}
		url::redirect(PATH."admin/subscribed-user.html");
	}
	
	/** DELETE SUBSCRIBER **/
	
	public function delete_subscriber($user_id ="")
	{   
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}

		if($user_id){
			$status = $this->news->deletesubscriber($user_id);
			if($status == 1){
				common::message(1, $this->Lang['SUB_DELETE']);
			}
			else{
				common::message(-1, $this->Lang['NO_RECORD_FOUND']);
			}
		}
		url::redirect(PATH."admin/subscribed-user.html");
	}
	
	/** SEND EMAILS **/
	
	public function send_emails()
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->newsletter_act = "1";
	    if($_POST){
			$img_check = 0;
			$this->userPost = $this->input->post();
			$post = Validation::factory(array_merge($_POST,$_FILES))
							->add_rules('subject', 'required')
							->add_rules('message', 'required')
							->add_rules('template', 'required')
							->add_rules('attach', 'required')
							->add_rules('title', 'required')
							->add_rules('footer', 'required');
									
				if(!isset($post->users) && !isset($post->all_users))
				{
					$post->add_rules('all_users','required');
				}	
				if($_FILES["attach"]["name"]==''){
					$img_check = 1;
				} 
				if($post->validate() && $img_check ==0){
					$file=array();
					$extension="";
					$logo = "";
					if($_FILES["attach"]["name"]!=''){
						$tmp_name = $_FILES["attach"]["tmp_name"];
						$logo = $_FILES["attach"]["name"];
						move_uploaded_file($tmp_name, DOCROOT."images/newsletter/".$logo);
						chmod(DOCROOT."images/newsletter/".$logo,0777);
					}
					               
					$file1=array();
					pdf::template_create($post->template,$post->subject,$post->message);
					
					
					/*
						This points to server root folder which makes the path
						wrong if the site resides in another folder inside root.
						Original: array_push($file1, $_SERVER['DOCUMENT_ROOT']."images/newsletter/newsletter.pdf");
						New: array_push($file1, DOCROOT.'images/newsletter/newsletter.pdf');
						
						@Live
					*/
					
					
					array_push($file1, DOCROOT.'images/newsletter/newsletter.pdf');
					//chmod($_SERVER['DOCUMENT_ROOT']."images/newsletter/newsletter.pdf",0777);
                    $status = $this->news->send_newsletter(arr::to_object($this->userPost),$file1,$logo);
                    if($_FILES["attach"]["name"]!=''){
						$logo = $_FILES["attach"]["name"];
						unlink(DOCROOT."images/newsletter/".$logo);
					}
					if($status == 1){
						//unlink(DOCROOT.'images/newsletter/newsletter.'.$extension);
						unlink(DOCROOT.'images/newsletter/newsletter.pdf');
				        common::message(1, $this->Lang['NEWS_SENT']);
			        }else{
						//unlink(DOCROOT.'images/newsletter/newsletter.'.$extension);
						unlink(DOCROOT.'images/newsletter/newsletter.pdf');
				        common::message(-1, $this->Lang['NEWS_NOT_SENT']);
			        }
			        url::redirect(PATH."admin.html");
		        }
		        else{
		            $this->form_error = error::_error($post->errors());
		             if($_FILES["attach"]["name"]==''){
						$this->form_error['attach'] = $this->Lang['REQQ'];
					}
		        }
		}
		$this->city_list = $this->news->getCityList();       
		$this->users = $this->news->getUSERList();    
		$this->newsletter_list = $this->news->get_newsletter_list();
		if(count($this->newsletter_list)==0){
			common::message(-1, $this->Lang["NO_TEMPLATES_FOUND"]);        
			url::redirect(PATH."admin.html");
		}
        $this->template->title = $this->Lang['SEND_NEWSL'];
        $this->template->content = new View("newsletter/send_emils");	
	}

	/** SEND DAILY DEALS NEWS LETTER **/

	public function send_daily_deals()
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($_POST){

			$city_list = $this->input->post("citydata");

			newsletter::send($city_list);
			common::message(1, $this->Lang['DAILY_DEALS_SENT']);
			url::redirect(PATH."admin/send-daily-deals.html");
			
		}
		//$this->cityDataList  = $this->news->getCityList();
		$this->categorylist = $this->news->get_top_category_list();
		$this->template->title = $this->Lang['SEND_NEWSL'];
		$this->template->content = new View("newsletter/send_daily_deal");
	}


	/** SEND DAILY DEALS NEWS LETTER **/

	public function send_daily()
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($_POST){
		$this->city_list = $this->input->post("citydata");
		
		$this->newsletter_user_list = $this->news->get_subscribed_user_list();


		$this->all_category_list = $this->news->get_category_list();
			$cnt = 0;

		foreach($this->newsletter_user_list as $UList){

			$userLists[ $UList->user_id] = array("user_id" => $UList->user_id,  "email" => $UList->email_id,"country_id" => explode(",", $UList->country_id), "city_id" => explode(",", $UList->city_id), "category_id" => explode(",", $UList->category_id));
		}
		
		foreach($this->city_list as $C){

			$Cdata = explode("__", $C);
			if(isset($Cdata[0]) && isset($Cdata[1])){
				$country_id = $Cdata[0]; $city_id = $Cdata[1];

				$this->all_deals_list_by_city = $this->news->get_city_daily_deals_list($country_id, $city_id);
				foreach($userLists as $UL){
					$this->single_userdata = $UL;
					if(in_array($city_id, $UL["city_id"]) && count($this->all_deals_list_by_city) > 0){

						foreach($this->all_deals_list_by_city as $DList){
 							$this->cityName = ucfirst($DList->city_name);
							if(in_array($DList->category_id, $UL["category_id"])){
				
								 $cnt =  $cnt + 1;
							}
						}
						
					}
					
				}
				
                             }
                        }
                }
		$this->template->title = $this->Lang['SEND_NEWSL'];
		$this->template->content = new View("themes/".THEME_NAME."/send_daily_deal_template");
	}
	
	public function user_select1($all_users="",$city="",$gender="",$age_range="")
	{
		
			$this->user_list=$this->news->get_user_list($all_users,$city,$gender,$age_range);
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
	
	public function add_template(){
		if(!ADMIN_PRIVILEGES_NEWSLETTER_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->newsletter_act = 1;
		if($_POST){
			$this->userPost = $this->input->post();
			$post = Validation::factory(array_merge($_POST,$_FILES))
					->pre_filter('trim')
					->add_rules('title', 'required')
					->add_rules('template_file','required', 'upload::valid', 'upload::type[php]', 'upload::size[1M]')
					->add_rules('template_image','required','upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
			if($post->validate()){
				$status = $this->news->add_template(arr::to_object($this->userPost));
				if($status > 0){
					if($_FILES["template_file"]){
						$tmp_name = $_FILES["template_file"]["tmp_name"];
						$name = "Template_file_".$status.".php";
						move_uploaded_file($tmp_name, DOCROOT."application/views/themes/".THEME_NAME."/".$name);
						chmod(DOCROOT."application/views/themes/".THEME_NAME."/".$name,0777);
					}
					if($_FILES['template_image']['name']){
						$filename = upload::save('template_image'); 						
						$IMG_NAME = $status.'.png';						
						common::image($filename, 192, 98, DOCROOT.'images/newsletter/'.$IMG_NAME);
						unlink($filename);
					}
					common::message(1, $this->Lang["TEMPLATE_SUCESSS"]);
					url::redirect(PATH."admin/manage-template.html");
				}
				$this->form_error["title"] = $this->Lang["TEMPLATE_TITLE_EXIT"];
			}else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->template->title = $this->Lang["ADD_TEMPLATE"];
		$this->template->content = new View("newsletter/add_template");
	}
	
	public function manage_template($page=''){
		if(!ADMIN_PRIVILEGES_NEWSLETTER)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->newsletter_act = 1;
		$count = $this->news->get_template_count();
		$this->pagination = new Pagination(array(
		'base_url'       => 'admin/manage-template.html/page/'.$page."/",
		'uri_segment'    => 4,
		'total_items'    => $count,
		'items_per_page' => 20, 
		'style'          => 'digg',
		'auto_hide'      => TRUE
		));
		$this->newsletter_template_list = $this->news->get_template_list($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->title = $this->Lang["MANAGE_TEMPLATE"];
		$this->template->content = new View("newsletter/manage_template");
	}
	
	public function edit_template($newsletter_id=''){
		if(!ADMIN_PRIVILEGES_NEWSLETTER_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->newsletter_act = 1;
		$newsletter_id = base64_decode($newsletter_id);
		if(!is_numeric($newsletter_id)){
			common::message(-1, $this->Lang["RECORD_NOT"]);        
			url::redirect(PATH."admin/manage-template.html");
		}
		if($_POST){
			$this->userPost = $this->input->post();
			$post = Validation::factory(array_merge($_POST,$_FILES))
					->pre_filter('trim')
					->add_rules('title', 'required')
					->add_rules('template_file','required', 'upload::valid', 'upload::type[php]', 'upload::size[1M]')
					->add_rules('template_image','required','upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
			if($post->validate()){
				$status = $this->news->edit_template(arr::to_object($this->userPost),$newsletter_id);
				if($status > 0){
					if($_FILES["template_file"]["name"]!=''){
						$tmp_name = $_FILES["template_file"]["tmp_name"];
						$name = "Template_file_".$status.".php";
						move_uploaded_file($tmp_name, DOCROOT."application/views/themes/".THEME_NAME."/".$name);
						chmod(DOCROOT."application/views/themes/".THEME_NAME."/".$name,0777);
					}
					if($_FILES['template_image']['name']!=''){
						$filename = upload::save('template_image'); 						
						$IMG_NAME = $status.'.png';						
						common::image($filename, 192, 98, DOCROOT.'images/newsletter/'.$IMG_NAME);
						unlink($filename);
					}
					common::message(1, $this->Lang["TEMPLATE_EDIT_SUC"]);
					url::redirect(PATH."admin/manage-template.html");
				}
				$this->form_error["title"] = $this->Lang["TEMPLATE_TITLE_EXIT"];
			}else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->newsletter_details = $this->news->get_newsletter_details($newsletter_id);
		if(count($this->newsletter_details)==0){
			common::message(-1, $this->Lang["RECORD_NOT"]);        
			url::redirect(PATH."admin/manage-template.html");
		}
		$this->template->title = $this->Lang["EDIT_TEMPLATE"];
		$this->template->content = new View("newsletter/edit_template");
	}
	
	public function blockunblock_template($type="",$newsletter_id=""){
		if(!ADMIN_PRIVILEGES_NEWSLETTER_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->newsletter_act = 1;
		$newsletter_id = base64_decode($newsletter_id);
		if(!is_numeric($newsletter_id)){
			common::message(-1, $this->Lang["RECORD_NOT"]);        
			url::redirect(PATH."admin/manage-template.html");
		}
		$status = $this->news->blockunblockTemplate($type,$newsletter_id);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["TEMPLATE_UNBLOCK_SUC"]);
			}else{
				common::message(1, $this->Lang["TEMPLATE_BLOCK_SUC"]);
			}
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
			url::redirect(PATH.$lastsession);
		} else {
			url::redirect(PATH."admin/manage-template.html");
		}
	}
	
	public function delete_template($newsletter_id = "")
	{
		if(!ADMIN_PRIVILEGES_NEWSLETTER_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->newsletter_act = 1;
		$newsletter_id = base64_decode($newsletter_id);
		if(!is_numeric($newsletter_id)){
			common::message(-1, $this->Lang["RECORD_NOT"]);        
			url::redirect(PATH."admin/manage-template.html");
		}
		if($newsletter_id){
			$status = $this->news->deleteTemplate($newsletter_id);
			if($status == 1){
				unlink(DOCROOT."images/newsletter/".$newsletter_id.".png");
				unlink( DOCROOT."application/views/themes/".THEME_NAME."/Template_file_".$newsletter_id.".php");
				common::message(1, $this->Lang["TEMPLATE_DEL_SUC"]);
			}else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
			url::redirect(PATH.$lastsession);
		} else {
			url::redirect(PATH."admin/manage-template.html");
		}
	}
}
