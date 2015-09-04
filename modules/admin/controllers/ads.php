<?php defined('SYSPATH') OR die('No direct access allowed.');
class Ads_Controller extends website_Controller 
{
	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		  
		$this->ads = new Ads_Model();
		$this->ads_act = "1";
	}
		
	/* INSERT NEW ADS */
	
	public function add_adds()
	{
		if(!ADMIN_PRIVILEGES_ADS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($_POST){
			
			$this->AddPost = $this->input->post();
			$post = Validation::factory(array_merge($_POST,$_FILES))
				->pre_filter('trim')
				->add_rules('ads_position', 'required')
				->add_rules('pages','required',array($this,'position_exist'),array($this,'home_position_exist'))
				->add_rules('add_title', 'required','chars[a-zA-Z0-9 \,.&_-]')
				->add_rules('redirect_url','required', 'valid::url')
				->add_rules('image', 'upload::required','upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
				//->add_rules('add_code','required');
				
			if($post->validate()){ 
				//$addCode = $this->input->raw("post",'add_code');
				//$addCode = stripslashes($addCode);
				$addtitle = $this->AddPost["add_title"];
				$position = $this->AddPost["ads_position"];
				$page_position = $this->AddPost["pages"];
				$redirect_url = $this->AddPost["redirect_url"];	
				$status = $this->ads->add_ads($addtitle,$position,$page_position,$redirect_url);
				if($status){ 
					$filename = upload::save('image');
						$IMG_NAME =$status.".png";	
						if($position =="th") {
							common::image($filename, 775, 100, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="ls") {
							common::image($filename, 180, 500, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="bf") {
							common::image($filename, 790, 100, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="hr1" || $position =="hr2" || $position =="hr3" || $position =="hr4" || $position =="hr5" || $position =="rs1" || $position =="rs2") {
							common::image($filename, 196, 168, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="hs1" || $position =="hs2" || $position =="hs3" || $position =="hs4" || $position =="hs5" || $position =="hs6" || $position =="hs7") {
							common::image($filename, 196, 359, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="hc1" || $position =="hc2") {
							common::image($filename, 553, 118, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="hb1") {
							common::image($filename, 1120, 110, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="hb2") {
							common::image($filename, 1121, 279, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}
						unlink($filename);
						common::message(1,$this->Lang["ADDS_ADD_SUC"]);
						url::redirect(PATH."adds_mgmt/manage_adds.html");
					}
					else{
						common::message(1, "Error Please try again");
						url::redirect(PATH."admin/add-banner-image.html");		
					}
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->template->title = $this->Lang["ADDS_ADD_PAGE"]." | ".SITENAME;
		$this->template->content = new View("adds_mgt/add_adds");
	}
	
	/* MANAGE ADS  */
	
	public function view_adds()
	{
		if(!ADMIN_PRIVILEGES_ADS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->ad_details=$this->ads->manage_ad();
		$this->template->title=$this->Lang["MANAGE_ADD_PAGE"]." | ".SITENAME;
		$this->template->content=new View("adds_mgt/manage_adds");
	}

	/* CHECK ADD IS EXIST*/
	
	public function position_exist($page_position = "")
	{
		$ads_position=$this->input->post('ads_position');
		
		$exist = $this->ads->position_exist($page_position,$ads_position);
		
		return ! $exist;
	}
	
	/* CHECK HOME PAGE AD'S IS EXIST*/
	
	public function home_position_exist($page_position = "")
	{
		$ads_position=$this->input->post('ads_position');
		
		if((($ads_position=="hs1") || ($ads_position=="hs2") || ($ads_position=="hs3") || ($ads_position=="hs4") ||($ads_position=="hs5")||($ads_position=="hs6")||($ads_position=="hs7") ||($ads_position=="hr1") || ($ads_position=="hr2") || ($ads_position=="hc1") || ($ads_position=="hc2") || ($ads_position=="hb1") || ($ads_position=="hb2")) && ($page_position==1)) {
			return 1;
		} else if((($ads_position=="ls") || ($ads_position=="ls")) && ($page_position !=1) ) { 
			return 1;
		}else if((($ads_position=="rs1") || ($ads_position=="rs2"))) { 
			return 1;
		}
		return 0;
	}

	/* EDIT ADS */
	
	public function edit_ads($id = "")
	{ 
		if(!ADMIN_PRIVILEGES_ADS_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$get_code = explode("_", $id);
		$id = $get_code[0];
		$position = $get_code[1];
		$pg_position = $get_code[2];
		
			if($_POST){ 
				$this->AddPost = $this->input->post();
				//$addCode = $this->input->raw("post",'ad_code');
				//$addCode = stripslashes($addCode);
				$addtitle = $this->AddPost["ad_title"];
				$new_position = $this->AddPost["ads_position"];
				$page_position = $this->AddPost["pages"];
				$redirect_url = $this->AddPost["redirect_url"];	
				
				$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('ads_position', 'required')
						->add_rules('pages','required')
						->add_rules('ad_title', 'required','chars[a-zA-Z0-9 \,.&_-]')
						->add_rules('redirect_url','required', 'valid::url')
						->add_rules('image','upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
				
				if($post->validate()){
					$status=$this->ads->ad_update($addtitle,$position,$pg_position,$page_position,$redirect_url,$new_position,$id);
					
					if($status == 9){
						common::message(-1,$this->Lang["ADD_POS_EXIST"]);
					}
					else{ 
						if($_FILES['image']['name']) { 
							
							$filename = upload::save('image');
							$IMG_NAME =$status.".png";	
						if($position =="th") {
							common::image($filename, 775, 100, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="ls") {
							common::image($filename, 180, 500, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="bf") {
							common::image($filename, 790, 100, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="hr1" || $position =="hr2" || $position =="hr3" || $position =="hr4" || $position =="hr5" || $position =="rs1" || $position =="rs2") {
							common::image($filename, 196, 168, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="hs1" || $position =="hs2" || $position =="hs3" || $position =="hs4" || $position =="hs5" || $position =="hs6" || $position =="hs7") {
							common::image($filename, 196, 359, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="hc1" || $position =="hc2") {
							common::image($filename, 553, 118, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="hb1") {
							common::image($filename, 1120, 110, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}elseif($position =="hb2") {
							common::image($filename, 1121, 279, DOCROOT.'images/ad_image/'.$IMG_NAME);
						}
						unlink($filename); 
						
					} 
								
						common::message(1,$this->Lang["UPD_ADD_SUC"]);
					}
					url::redirect(PATH."adds_mgmt/manage_adds.html");
				}
				else{
					$this->form_error = error::_error($post->errors());
				}
			}
		$this->get_record = $this->ads->get_one_record($id, $position);
		if(count($this->get_record)== 0){
			common::message(1,$this->Lang["RECORD_NOT"]);
			url::redirect(PATH."adds_mgmt/manage_adds.html");
		}
		$this->template->content= new View("adds_mgt/edit_ads");
	}	
	
	/* BLOCK AND UNBLOCK ADS */

	public function block_ads($type = "", $id = "")
	{
		if(!ADMIN_PRIVILEGES_ADS_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	
                if($id){
                        $status = $this->ads->blockunblock_Ad($type, $id);
                        if($status == 1){
                                if($type == 1){
                                        common::message(1, $this->Lang["AD_UNB_SUC"]);
                                }
                                else{
                                        common::message(1, $this->Lang["AD_BL_SUC"]);
                                }
                        }
                        else{
                                common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
                        }
                }
                url::redirect(PATH."adds_mgmt/manage_adds.html");
	}

	/* DELETE ADS */

	public function delete_ads($id = "")
	{
		if(!ADMIN_PRIVILEGES_ADS_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->ads->delete_ads($id);
		if($status == 1){
				common::message(1, $this->Lang["ADD_DEL_SUC"]);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}		
		url::redirect(PATH."adds_mgmt/manage_adds.html");
	}
	
	public function show_ads_position($page=''){
		if($page!=''){
			$result = "<option valu=''>".$this->Lang['SEL_ADS_POS']."</option>";
			if($page==1){
				$ads_position = Kohana::config('settings'); 
				foreach($ads_position["ads_position"] as $index => $position){
					$result .= "<option value=".$index.">".$position."</option>";
				}
			}else{
				$ads_position = Kohana::config('settings'); 
				foreach($ads_position["ads_position_1"] as $index => $position){
					$result .= "<option value=".$index.">".$position."</option>";
				}
			}
		}else{
			$result = "<option valu=''>".$this->Lang['SELECT_PAGE_POSITION_FIRST']."</option>";
		}
		echo $result;
		exit;
	}
	
}


