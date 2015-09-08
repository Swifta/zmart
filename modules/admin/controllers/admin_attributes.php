<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_attributes_Controller extends website_Controller 
{
	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html" ){

			url::redirect(PATH);
		} 
		 

		$this->admin = new Admin_attributes_Model();
	}

	
	/** ADD ATTRIBUTE  **/

	public function add_attribute()
	{
		if(!ADMIN_PRIVILEGES_SPECIFICATION_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->attributegroup_settings = 1;
		if($_POST){
			
			$this->userPost = $this->input->post();
		$post = Validation::factory($_POST)
					->pre_filter('trim')
					->add_rules('name', 'required')
					->add_rules('attribute_group', 'required',array($this,'check_attribute_group_sel'))
					->add_rules('sort_order', 'chars[0-9]');
			if($post->validate()){
			$status = $this->admin->add_attribute(arr::to_object($this->userPost));
			
			if($status==1){
			common::message(1, $this->Lang['ATTR_ADD']);
			url::redirect(PATH."admin/manage-attribute.html");
			}
			else{
					common::message(-1, $this->Lang['ATTR_ADD_ATTRGROUP']);
				} 
			
			}
			else{	
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->attribute_groups = $this->admin->get_all_attribute_group();
		$this->template->title = $this->Lang['ADD_ATTR_LABEL'];
		$this->template->content = new View("admin_attributes/add_attribute");
	}

	/** MANAGE ATTRIBUTE **/
	
	public function manage_attribute($page = "")
	{	
		if(!ADMIN_PRIVILEGES_SPECIFICATION)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->attributegroup_settings = 1;
		$count = $this->admin->get_attribute_count();
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-attribute.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->attributeDataList = $this->admin->get_attribute_list($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->title = $this->Lang['MANA_ATTR'];
		$this->template->content = new View("admin_attributes/manage_attribute");
	}
	
	/** EDIT ATTRIBUTE **/
	
	public function edit_attribute($attribute_id = "")
	{
		if(!ADMIN_PRIVILEGES_SPECIFICATION_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->attributegroup_settings = 1;
		$attribute_id =base64_decode($attribute_id);
		
				if($_POST){
					
					$this->userPost = $this->input->post();
		$post = Validation::factory($_POST)
					->pre_filter('trim')
					->add_rules('name', 'required')
					->add_rules('attribute_group', 'required',array($this,'check_attribute_group_sel'))
					->add_rules('sort_order', 'chars[0-9]');
			if($post->validate()){
			$status = $this->admin->edit_attribute($attribute_id,arr::to_object($this->userPost));
		
					if($status == 1){
						common::message(1, $this->Lang['ATTR_UPDATE']);
						$lastsession = $this->session->get("lasturl");
                                                if($lastsession){
                                                url::redirect(PATH.$lastsession);
                                                } else {
                                                url::redirect(PATH."admin/manage-attribute.html");
                                                }
					}
					else{
						$this->attr_exist= $this->Lang['ATTR_ADD_ATTRGROUP'];
						//common::message(-1, $this->Lang['ATTR_ADD_ATTRGROUP']);
						//url::redirect(PATH."admin/edit-attribute/".base64_encode($attribute_id).".html");
					}
				
			}
			else{	
				$this->form_error = error::_error($post->errors());
			}
			}
		$this->attribute_groups = $this->admin->get_all_attribute_group();
		$this->attributeData = $this->admin->getattributeData($attribute_id);
		$this->template->title = $this->Lang['EDIT_ATTR'];
		$this->template->content = new View("admin_attributes/edit_attribute");
	}
	
	/** DELETE ATTRIBUTE **/
	
	public function delete_attribute($attribute_id = "")
	{
		if(!ADMIN_PRIVILEGES_SPECIFICATION_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($attribute_id){
			$status = $this->admin->delete_attribute(base64_decode($attribute_id));
			if($status == 1){
				common::message(1, $this->Lang['ATTR_DEL']);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		common::message(1, $this->Lang['ATTR_GROUP_UPDATE']);
		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-attribute.html");
                }
	}
	

	/** ADD ATTRIBUTE GROUP  **/

	public function add_attribute_group()
	{
		if(!ADMIN_PRIVILEGES_SPECIFICATION_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->attributegroup_settings = 1;
		if($_POST){
			$this->userPost = $this->input->post();
		$post = Validation::factory($_POST)
					->pre_filter('trim')
					->add_rules('groupname', 'required',array($this,'check_attrgroup_exist'))
					->add_rules('sort_order', 'chars[0-9]');
			if($post->validate()){ 
			$status = $this->admin->add_attribute_group(arr::to_object($this->userPost));
			
				if($status==1){
				common::message(1, $this->Lang['ATTR_GROUP_ADD']);
				url::redirect(PATH."admin/manage-attribute-group.html");
				}
			}
			else{	
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->template->title = $this->Lang['ADD_ATTR_GROUP_LABEL'];
		$this->template->content = new View("admin_attributes/add_attribute_group");
	}

	/** MANAGE ATTRIBUTE GROUP **/
	
	public function manage_attribute_group($page = "")
	{	
		if(!ADMIN_PRIVILEGES_SPECIFICATION)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->attributegroup_settings = 1;
		$count = $this->admin->get_attribute_group_count();
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-attribute-group.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->attribute_groupList = $this->admin->get_attribute_group_list($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->title = $this->Lang['MANA_ATTR_GROUP'];
		$this->template->content = new View("admin_attributes/manage_attribute_group");
	}
	
	/** EDIT ATTRIBUTE GROUP **/
	
	public function edit_attribute_group($attribute_id = "")
	{
		if(!ADMIN_PRIVILEGES_SPECIFICATION_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->attributegroup_settings = 1;
		$attribute_id =base64_decode($attribute_id);
		
				if($_POST){
					$this->userPost = $this->input->post();
					$post = Validation::factory($_POST)
					->pre_filter('trim')
					->add_rules('groupname', 'required')
					->add_rules('sort_order', 'chars[0-9]');
			if($post->validate()){
			$status = $this->admin->edit_attribute_group($attribute_id,arr::to_object($this->userPost));
	
					if($status == 1){
						common::message(1, $this->Lang['ATTR_GROUP_UPDATE']);
						$lastsession = $this->session->get("lasturl");
                                                if($lastsession){
                                                url::redirect(PATH.$lastsession);
                                                } else {
                                                url::redirect(PATH."admin/manage-attribute-group.html");
                                                }
					}else{
						$this->attr_group_exist= $this->Lang['ATTR_GROUP_EXIST'];
					//url::redirect(PATH."admin/edit-attribute-group/".base64_encode($attribute_id).".html");
				} 
			}
			else{	
				$this->form_error = error::_error($post->errors());
			}
				 
			}
		
		$this->groupData = $this->admin->getattributegroupData($attribute_id);
		$this->template->title = $this->Lang['EDIT_ATTR_GROUP'];
		$this->template->content = new View("admin_attributes/edit_attribute_group");
	}
	
	/** DELETE ATTRIBUTE GROUP **/
	
	public function delete_attribute_group($attribute_id = "")
	{
		if(!ADMIN_PRIVILEGES_SPECIFICATION_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($attribute_id){
			$status = $this->admin->delete_attribute_group(base64_decode($attribute_id));
			if($status == 1){
				common::message(1, $this->Lang['ATTR_GROUP_DEL']);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}
		}
		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH."admin/manage-attribute-group.html");
                }
	}
	
	public function check_attrgroup_exist(){ 
		$exist = $this->admin->check_attrgroup_exist($this->input->post("groupname"));	
			return ($exist == 0)?true:false;
	}
	
	public function check_attribute_group_sel($group){
		
		if($group!=-1){
			return true;
		}else{
			return false;
		}
		
	}
	

}
