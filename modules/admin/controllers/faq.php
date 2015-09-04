<?php defined('SYSPATH') OR die('No direct access allowed.');
class Faq_Controller extends website_Controller 
{
	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		 
		$this->faq = new Faq_Model();
		$this->faq_act = "1";
	}

	/** ADD FAQ QUESTIONS **/

	public function add_faq()
	{
		if(!ADMIN_PRIVILEGES_FAQ_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($_POST)
		{
			$this->userPost = $this->input->post();
			$post = Validation::factory($_POST)
				->add_rules('add_qus', 'required')
				->add_rules('answer', 'required');
				if($post->validate())
				{
					$status = $this->faq->add_qus(arr::to_object($this->userPost));
					if($status == 1)
					{				
					    url::redirect(PATH."faq_mgt/manage_faq.html");					
					}		    
				} else {
					$this->form_error = error::_error($post->errors());
				}		
		}
		$this->template->title = $this->Lang['FAQ']." | ".SITENAME;
		$this->template->content = new View("faq_mgt/add_faq");
	}

	/* MANAGE FAQ  */
	
	public function manage_faq($page="")
	{
		if(!ADMIN_PRIVILEGES_FAQ)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->faq_count=$this->faq->get_count();
		$this->pagination = new Pagination(array(
				'base_url'       => '/faq/manage_faq/page/'.$page,
				'uri_segment'    => 4,
				'total_items'    => $this->faq_count,
				'items_per_page' => 10, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->faq_details=$this->faq->get_questions($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->title=$this->Lang['MANG_FAQ']." | ".SITENAME;
		$this->template->content=new View("faq_mgt/manage_faq");
	}

	/* EDIT FAQ */
	
	public function edit_faq($id = "")
	{
		if(!ADMIN_PRIVILEGES_FAQ_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($_POST){
			$question = $this->input->post('question');
			$answer = $this->input->post('answer');
			$post = Validation::factory($_POST)
				        ->add_rules('question', 'required')
				        ->add_rules('answer', 'required');
			if($post->validate()){
				$status=$this->faq->faq_update($id,$question,$answer);
				if($status==1){ 
					common::message(1,$this->Lang["FAQ_SUCC_UP"]);
				}
				$lastsession = $this->session->get("lasturl");
                                if($lastsession){
                                url::redirect(PATH.$lastsession);
                                } else {
                                url::redirect(PATH."faq_mgt/manage_faq.html");
                                }
			} else {
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->get_record = $this->faq->get_one_record($id);
		if(count($this->get_record)== 0){
			common::message(1,$this->Lang["RECORD_NOT"]);
			$lastsession = $this->session->get("lasturl");
                                if($lastsession){
                                url::redirect(PATH.$lastsession);
                                } else {
                                url::redirect(PATH."faq_mgt/manage_faq.html");
                                }
		}
		$this->template->title=$this->Lang['EDIT_FAQ']." | ".SITENAME;
		$this->template->content= new View("faq_mgt/edit_faq");
	}	
	
	/* BLOCK AND UNBLOCK FAQ */

	public function block_faq($type = "", $id = "")
	{
		if(!ADMIN_PRIVILEGES_FAQ_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
                if($id){
                        $status = $this->faq->blockunblock_Faq($type, $id);
                        if($status == 1){
                                if($type == 1){
                                        common::message(1, $this->Lang["FAQ_UNB_SUC"]);
                                } else {
                                        common::message(1, $this->Lang["FAQ_BL_SUC"]);
                                }
                        } else {
                                common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
                        }
                }
              $lastsession = $this->session->get("lasturl");
                                if($lastsession){
                                url::redirect(PATH.$lastsession);
                                } else {
                                url::redirect(PATH."faq_mgt/manage_faq.html");
                                }
	}

	/* DELETE FAQ */

	public function delete_faq($id = "")
	{
		if(!ADMIN_PRIVILEGES_FAQ_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->faq->delete_faq($id);
		if($status == 1){
				common::message(1, $this->Lang["FAQ_DEL_SUC"]);
			} else {
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}		
		$lastsession = $this->session->get("lasturl");
                                if($lastsession){
                                url::redirect(PATH.$lastsession);
                                } else {
                                url::redirect(PATH."faq_mgt/manage_faq.html");
                                }
	}
}
