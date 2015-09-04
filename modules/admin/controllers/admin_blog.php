<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_blog_Controller extends website_Controller 
{
	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		$this->admin_blog = new Admin_blog_Model;				
		$this->blog_settings = $this->admin_blog->get_blog_settings_data();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		
		if(count($this->blog_settings) == 1){
			$this->comments_settings = $this->blog_settings->current()->require_adminapproval_comments;				
		}
		$this->blog_act="1";
	}

	/** ADD BLOG **/

	public function add_blog()
	{
		if(!ADMIN_PRIVILEGES_BLOG_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->add_blog="1";
		if($_POST){ 

			$this->userPost = $this->input->post();		
			$post = new Validation($_POST);
			$post = Validation::factory(array_merge($_POST,$_FILES))
						->pre_filter('trim')
						->add_rules('title', 'required', 'length[5,200]', array($this, 'blogtitle_available'))
						->add_rules('description', 'required')
						->add_rules('category', 'required')						
						->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
				if($post->validate()){
					
					$allow_comment = $this->input->post('allow_comments');
						if(!$allow_comment){
							$allow_comment = 0;
						}					
					$status = $this->admin_blog->add_blog(arr::to_object($this->userPost),$allow_comment);
						if($status > 0){						
								$filename = upload::save('image'); 						
								$IMG_NAME = $status.'.jpg';						
								$this->add_blog_image($filename, $IMG_NAME);				    					
								common::message(1, $this->Lang["BLOG_ADD_SUC"]);
									if($this->input->post('pub_status') == 1){
										url::redirect(PATH."admin/manage-publish-blog.html");                     
									} else {
										url::redirect(PATH."admin/manage-draft-blog.html");                     
									}	
						} else {
							
							common::message(-1, $this->Lang["PROB_ADDING_BLOG"]);  
							url::redirect(PATH."admin/add-blog.html"); 
						}
				}
				else{
					
					$this->form_error = error::_error($post->errors()); 
				}
		}	
		$this->category_list = $this->admin_blog->get_category_list();	
		$this->template->title = $this->Lang["ADD_BLOG"];
		$this->template->content = new View("admin_blog/add_blog");
	}
	
	/** MANAGE BLOG **/
	
	public function manage_blog($type = "", $page = "")
	{
		if(!ADMIN_PRIVILEGES_BLOG)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}

		if($type == 1){   
			$this->publish_blog="1";             			        	
			$this->template->title = $this->Lang["MANAG_PUBLISHED"];
			$this->url = "admin/manage-publish-blog.html";		
		} else {	           	
			$this->draft_blog="1";
			$this->template->title = $this->Lang["MANAGE_DRAFTED"];
			$this->url = "admin/manage-draft-blog.html";
		}
		$this->count_blog = $this->admin_blog->get_blog_count($this->input->get('name'), $this->input->get('category'), $type); 
		$this->pagination = new Pagination(array(
		'base_url'       => $this->url.'/page/'.$page."/",
		'uri_segment'    => 4,
		'total_items'    => $this->count_blog,
		'items_per_page' => 20, 
		'style'          => 'digg',
		'auto_hide' => TRUE
		));			
		$this->search = $this->input->get(); 
		$this->search_key = arr::to_object($this->search);
		$this->blog_list = $this->admin_blog->get_blog_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get('name'), $this->input->get('category'), $type);	
		$this->category_list = $this->admin_blog->get_category_list();				
		$this->template->content = new View("admin_blog/manage_blog");	
	}
	
	/** EDIT BLOG **/
	
	public function edit_blog($blog_id = "", $title_url = "" , $redirect_type = "")
	{		
		if(!ADMIN_PRIVILEGES_BLOG_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}		
		if($_POST){ 
			$this->userPost = $this->input->post();		
			$post = new Validation($_POST);
			$post = Validation::factory(array_merge($_POST,$_FILES))
						->pre_filter('trim')
						->add_rules('title', 'required','length[5,200]')
						->add_rules('description', 'required')
						->add_rules('category', 'required')						
						->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
			if($post->validate()){
				$allow_comment = $this->input->post('allow_comments');
					if(!$allow_comment){
						$allow_comment = 0;
					}					
				$status = $this->admin_blog->edit_blog(arr::to_object($this->userPost),$blog_id,$allow_comment,$redirect_type);
					if($status == 1) {
							if($_FILES['image']['name']){						
								$filename = upload::save('image'); 						
								$IMG_NAME = $blog_id.'.jpg';						
								$this->add_blog_image($filename, $IMG_NAME);				    							
							}
							common::message(1, $this->Lang["BLOG_EDIT_SUC"]);
								if($redirect_type == 1){
									
									$lastsession = $this->session->get("lasturl");
                                                                        if($lastsession){
                                                                        url::redirect(PATH.$lastsession);
                                                                        } else {
                                                                        url::redirect(PATH."admin/manage-publish-blog.html"); 
                                                                        }                    
								} else { 
									url::redirect(PATH."admin/manage-draft-blog.html");                     
								}	
					}
				$this->form_error['title'] = $this->Lang["BLOG_TITLE_EXISTS"];   
			} else {			
				$this->form_error = error::_error($post->errors()); 
			}
		}
		$this->category_list = $this->admin_blog->get_category_list();
		$this->get_blog = $this->admin_blog->get_edit_blog($blog_id,$title_url);
		$this->template->title = $this->Lang["EDIT_BLOG"];   
		$this->template->content = new View("admin_blog/edit_blog");
	}
	
	/** BLOCK UNBLOCK BLOG **/
	
	public function block_blog($type = "", $blog_id = "", $title_url = "", $redirect_type = "")
	{  
		if(!ADMIN_PRIVILEGES_BLOG_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($blog_id && $title_url){					  
			$status = $this->admin_blog->blockunblockblog($type, $blog_id, $title_url);
			$lastsession = $this->session->get("lasturl");
                        if($lastsession){
                        $url = PATH.$lastsession;
                        } else {
                        $url = PATH."admin/manage-publish-blog.html"; 
                        } 
			if($status == 1){
				if($type == 1){
					common::message(1, $this->Lang["BLOG_UBLOCK_SUC"]);
					$redirect_type == 1 ? url::redirect($url) : url::redirect(PATH."admin/manage-draft-blog.html");					
				}
				else{
					common::message(1, $this->Lang["BLOG_BLOCK_SUC"]);
					$redirect_type == 1 ? url::redirect($url) : url::redirect(PATH."admin/manage-draft-blog.html");					
				}
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				$redirect_type == 1 ? url::redirect($url) : url::redirect(PATH."admin/manage-draft-blog.html");	
			}
		}			
	}
	
	/** PUBLISH BLOG **/
	
	public function publish_blog($blog_id = "", $title_url = "", $redirect_type = "")
	{  
		if(!ADMIN_PRIVILEGES_BLOG)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $lastsession = $this->session->get("lasturl");
                        if($lastsession){
                        $url = PATH.$lastsession;
                        } else {
                        $url = PATH."admin/manage-publish-blog.html"; 
                        } 
		if($blog_id && $title_url){					  
			$status = $this->admin_blog->publishblog($blog_id, $title_url);
			if($status == 1){				
					common::message(1, $this->Lang["BLOG_PUB_SUCC"]);
					$redirect_type == 1 ? url::redirect($url) : url::redirect(PATH."admin/manage-draft-blog.html");											
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				$redirect_type == 1 ? url::redirect($url) : url::redirect(PATH."admin/manage-draft-blog.html");	
			}
		}			
	}
	
	/** DELETE BLOG **/
	
	public function delete_blog($blog_id = "", $title_url = "", $redirect_type = "")
	{		
		if(!ADMIN_PRIVILEGES_BLOG_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        $lastsession = $this->session->get("lasturl");
                        if($lastsession){
                        $url = PATH.$lastsession;
                        } else {
                        $url = PATH."admin/manage-publish-blog.html"; 
                        } 
		if($blog_id && $title_url){	
			$status = $this->admin_blog->deleteblog($blog_id, $title_url);
				if($status == 1){
					common::message(1, $this->Lang["BLOG_DEL_SUC"]);
					$redirect_type == 1 ? url::redirect($url) : url::redirect(PATH."admin/manage-draft-blog.html");	
				}
				else{
					common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
					$redirect_type == 1 ? url::redirect($url) : url::redirect(PATH."admin/manage-draft-blog.html");	
				}
		}
	}
	
	/** VIEW SINGLE BLOG TITLE **/
	
	public function view_blog($blog_id = "", $title_url = "", $redirect_type = "")
	{ 		  
		if(!ADMIN_PRIVILEGES_BLOG)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}          	                               
		$this->blog_details = $this->admin_blog->view_blog($blog_id,$title_url);	
			if(count($this->blog_details) == 0){
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				$redirect_type == 1 ? url::redirect(PATH."admin/manage-publish-blog.html") : url::redirect(PATH."admin/manage-draft-blog.html");
			}			
		$this->template->title = $this->Lang["VIEW_BLOG"];
		$this->template->content = new View("admin_blog/view_blog");
	}
	
	/** BLOG SETTINGS **/
	
	public function blog_settings()
	{ 
		if($this->user_type > 2)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->blog_set = "1";
		if($_POST){
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('allow_comment_posting', 'required')
						->add_rules('require_approval_comments', 'required')
						->add_rules('post_per_page', 'required',array($this, 'validnum'));
			
			if($post->validate()){
				$status = $this->admin_blog->blog_settings(arr::to_object($this->userPost));
					if($status == 1){
						common::message(1, $this->Lang["BLOG_SET_UPD_SUCC"]);  
						url::redirect(PATH."admin/blog-settings.html");
					}
			}
			else{
				$this->form_error = error::_error($post->errors());	
			}
		}
		$this->blog_settings_data = $this->admin_blog->get_blog_settings_data(); 
		$this->template->title = $this->Lang["BLOG_SETTING"];
		$this->template->content = new View("admin_blog/blog_settings");
	}
	
	/** MANAGE COMMENTS **/
	
	public function manage_comment($blog_id = "")
	{ 
		if(!ADMIN_PRIVILEGES_BLOG)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}  
		$this->publish_blog="1";
		$this->comments_list = $this->admin_blog->get_comments_list($blog_id);	
		$this->template->title = $this->Lang["MANAGE_COMM"];  
		$this->template->content = new View("admin_blog/manage_comments");
	
	}
	
	/** BLOCK UNBLOCK COMMENTS **/
	
	public function block_comments($type = "",$id = "",$blog_id = "")  
	{
		if(!ADMIN_PRIVILEGES_BLOG_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}  
		$status = $this->admin_blog->block_comments($type,$id,$blog_id);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["COMM_UB_SUCC"]);
			}
			else{
				common::message(1, $this->Lang["COMM_B_SUCC"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		url::redirect(PATH."admin/manage-comments/".$blog_id.".html");
		
	}
	
	/** DELETE COMMENT **/
	
	public function delete_comments($id = "", $blog_id = "")
	{
		if(!ADMIN_PRIVILEGES_BLOG_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}  
		if($id){
			$status = $this->admin_blog->delete_comments($id,$blog_id);
				if($status == 1){
					common::message(1, $this->Lang["COMM_DEL_SUCC"]);
				}
				else{
					common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				}
		}
		url::redirect(PATH."admin/manage-comments/$blog_id.html");
	}
	
	/** APPROVE DISAPPROVE COMMENTS **/
	
	public function approvedisapprove_comments($type = "",$id = "",$blog_id = "")
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		
		$status = $this->admin_blog->approvedisapprove_comments($type,$id,$blog_id);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["COMM_DIS_SUCC"]);
			}
			else{
				common::message(1, $this->Lang["COMM_APP_SUCC"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		url::redirect(PATH."admin/manage-comments/".$blog_id.".html");
		
	}	
		
	/** CHECK WHETHER BLOG NAME EXIST OR NOT **/
	 
	public function blogtitle_available($blogtitle)
	{
		$exist = $this->admin_blog->exist_blogtitle($blogtitle);
		return ! $exist;
	}
	
	/** CHECK WHETHER IMAGE IS NOT EMPTY **/
	 
	public function check_image($image)
	{
		if($image['name'] == ''){
			return 0;
		} 
		return 1;
	}
	
	/** CHECK VALID OR NOT **/
	
	public function validnum($validnum = "")
	{
	        if(valid::digit($validnum)){
			        return 1;
		}
		return 0;
	}
	
	/** ADD BLOG IMAGE **/

	public function add_blog_image($filename = "", $image_name = "")
	{ 				
		$photos_size = array("profile" => array("width" => 230, "height" => 300));
		if($filename){
			list($width, $height) = getimagesize($filename);
			$widthadjust  = $photos_size["profile"]["width"];
			$heightadjust  = $photos_size["profile"]["height"];

				if($width > $widthadjust ){
					$heightadjust = $height * ( $widthadjust / $width);
				}
				else{
					$widthadjust = $width;
				}
				if($heightadjust < $height ){
					Image::factory($filename)
							->resize($widthadjust,$heightadjust, Image::NONE)
							->crop($widthadjust, $photos_size["profile"]["height"], 'top')
							->save(DOCROOT.'images/blog_images/100/'.$image_name);
				}
				else{
					Image::factory($filename)
							->resize($widthadjust,$heightadjust, Image::WIDTH)
							->save(DOCROOT.'images/blog_images/100/'.$image_name);
				}
			Image::factory($filename)->save(DOCROOT.'images/blog_images/'.$image_name);        
			unlink($filename); 
			return;
		}
	}
}
