<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_cms_Controller extends website_Controller 
{
	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		}
		
		$this->cms = new Admin_cms_Model();
		$this->cms_act = "1";					
	}
	
	/** ADD CMS PAGE **/
	
	public function add_cms_page()
	{
		if(!ADMIN_PRIVILEGES_CMS_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($_POST){
			$this->userPost = $this->input->post();
			$post = Validation::factory($_POST)
				->pre_filter('trim')
				->add_rules('title','required', 'chars[a-zA-Z0-9 \,.&_-]',array($this, 'cms_exist'));
				
				if($_POST['cms_type'] == 1 ){
					
				$post->add_rules('desc','required',array($this,'check_desc_empty'));
				
				}
				
				if($_POST['cms_type'] == 2 ){
					
				$post->add_rules('url','required','valid::url');
				
				}

			if($post->validate()){
				$status = $this->cms->add_pages(arr::to_object($this->userPost));

					if($status ==1){
						common::message(1,$this->Lang["CMS_ADD_SUC"]);
						url::redirect(PATH."cms/manage-pages.html");
					}
			}
			else{
			
				$this->form_error = error::_error($post->errors());            
			}
		}
		$this->template->title = $this->Lang["ADD_CMS_PAGE"];
		$this->template->content = new View("admin_cms/add_cms");  
	}
	
	/** check description empty **/
	
	public function check_desc_empty($val="")
	{
		
		if(strip_tags($val)=="")
		{ 
			return 0;
		}
		return 1;
		
	}
	
	/** MANAGE CMS PAGE **/

	public function Manage_cms_page()
	{
		if(!ADMIN_PRIVILEGES_CMS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->cms_page = $this->cms->get_pages();    
		$this->template->title = $this->Lang["MANAGE_PAGE"];
		$this->template->content = new View("admin_cms/manage_cms");

	}

	/** EDIT CMS PAGE **/

	public function edit_cms($cms_id = "", $cms_url = "")
	{
		if(!ADMIN_PRIVILEGES_CMS_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($_POST){

			$this->userPost = $this->input->post();
			$post = Validation::factory($_POST)
				->pre_filter('trim')
				->add_rules('title','required','chars[a-zA-Z0-9 \,.&_-]');
				//->add_rules('desc',array($this,'check_desc_empty'));
				if($_POST['cms_type'] == 1 ){
					
					$post->add_rules('desc','required',array($this,'check_desc_empty'));
				
				}
				
				if($_POST['cms_type'] == 2 ){
					
					$post->add_rules('url','required','valid::url'	);
				
				}

				if($post->validate()){
				//print_r($this->userPost); exit;
					$status = $this->cms->edit_cms($cms_id, $cms_url, arr::to_object($this->userPost));
                                        
					if($status ==1){
						common::message(1, $this->Lang["CMS_UDP_SUC"]);
						url::redirect(PATH."cms/manage-pages.html");
					}
					else{
						common::message(-1, $this->Lang["CMS_EXISTS"]);
					}
				} else {
					$this->form_error = error::_error($post->errors());            
				}
		}
		$this->cms_data = $this->cms->get_single_page($cms_id, $cms_url);
		$this->template->title = $this->Lang["EDIT_CMS"];
		$this->template->content = new View("admin_cms/edit_cms");
	}
    
	/** BLOCK AND UNBLOCK CMS **/

	public function block_cms($type = "",  $title = "", $id = "")
	{	
		if(!ADMIN_PRIVILEGES_CMS_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}

		if($id && $title){
			$status = $this->cms->blockunblock_cms($type, $id, $title);
			if($status == 1){
				if($type == 1){
					common::message(1, $this->Lang["CMS_UNB_SUC"]);
				}

				else{
					common::message(1, $this->Lang["CMS_BL_SUC"]);
				}

				}
				else{
					common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				}
		}
		url::redirect(PATH."cms/manage-pages.html");
	}

	/** DELETE CMS **/

	public function delete_cms($id = "",$title = "")
	{
		if(!ADMIN_PRIVILEGES_CMS_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->cms->delete_cms($id, $title);
			if($status == 1){
				common::message(1, $this->Lang["CMS_DL_SUC"]);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}		
		url::redirect(PATH."cms/manage-pages.html");
	}
	
	/** ABOUT US **/
	
	public function about_us()
	{
		if($this->user_type > 2)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($_POST) {  
				$post = Validation::factory($_POST)
				->pre_filter('trim') 
				->add_rules('data','required',array($this,'check_desc_empty'));
				if($post->validate()){
				$status = $this->cms->about_us($_POST['data']);
				if($status == 1){
					common::message(1, $this->Lang["ABT_SUC"]);
					url::redirect(PATH."cms/about-us.html");
				}
			}
			else{
			
				$this->form_error = error::_error($post->errors());            
			}
		}
		$this->about_us = $this->cms->about_us_data();
		$this->template->title = $this->Lang["ABOUT_US"];
		$this->template->content = new View("admin_cms/about_us");
	}

	/** CMS TITLE EXIST **/

	public function cms_exist($title = "")
	{		
		$exist = $this->cms->exist_cms($title);
		return ! $exist;
	}
	
	/** DEALS BOUGHT **/
	public function deals_bought()
	{
		if($_POST) {			
			$deals_bought = $_POST['deals_bought'];
			$status = $this->cms->deals_bought($deals_bought);
				if($status==1)  {
					common::message(1,$this->Lang["DEALB_SUCC"]);
					url::redirect(PATH."cms/manage-pages.html");
				}

		}
		$this->deals_bought = $this->cms->get_deals_bought();		
		$this->template->title = $this->Lang["DEBT"];        
		$this->template->content = new View("admin_cms/deals_bought");
	}
	
	/** COPY RIGHT **/
	public function copy_right()
	{
		if($_POST)
		{
			$copy_right = $_POST['copy_right'];
			$status = $this->cms->copy_right($copy_right);
				if($status==1) {
					common::message(1,$this->Lang["CR_SUCC"]);
					url::redirect(PATH."cms/manage-pages.html");
				}
		}   
		$this->copy_right = $this->cms->get_copy_right();
		$this->template->title = $this->Lang["CR"];        
		$this->template->content = new View("admin_cms/copy_right");
		}

}
