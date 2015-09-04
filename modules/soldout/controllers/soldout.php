<?php defined('SYSPATH') OR die('No direct access allowed.');
class Soldout_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		/*if(LANGUAGE == "french" ){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/french_style.css',PATH.'themes/'.THEME_NAME.'/css/fr_multi_style.css')); 
		}else if(LANGUAGE == "spanish"){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/spanish_style.css',PATH.'themes/'.THEME_NAME.'/css/sp_multi_style.css'));
		}
		else{
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}*/
		if(isset($_SESSION['select_lang'])){
			if($_SESSION['select_lang']==2){
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/ha_style.css',PATH.'themes/'.THEME_NAME.'/css/ha_multi_style.css'));
			}else if($_SESSION['select_lang']==3){
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/ig_style.css',PATH.'themes/'.THEME_NAME.'/css/ig_multi_style.css'));
			}else if($_SESSION['select_lang']==4){
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/yo_style.css',PATH.'themes/'.THEME_NAME.'/css/yo_multi_style.css'));
			}else{
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
			}
		}else{
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}
		$this->is_soldout = 1;
		$this->sold = new Soldout_Model();
		if(!$this->past_deal_setting){
		        url::redirect(PATH);
		}
	}
	
	/* ALL SOLDOUT */
	public function all_soldout($cityid="")
	{
		$cityid = $this->session->get('CityID');
		
		$this->get_sold_deals = $this->sold->get_solddeals_list($cityid);
		$this->get_sold_products = $this->sold->get_soldproducts_list($cityid);
		$this->get_sold_auction = $this->sold->get_soldauction_list($cityid);
		
		//$this->get_city = $this->home->get_all_city_list();
		//$this->products_details = $this->home->products_details($cityid);		
		//$this->deals_details = $this->home->deals_details($cityid);
		$this->template->title = $this->Lang['SOLD_OUT2']." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/soldout/all_soldout");
	}
	
	public function store_all_soldout($storeurl=''){
		$this->storeurl = $storeurl;
		$store_details = $this->sold->get_store_details($storeurl);
		if(count($store_details)==0){
			common::message(-1,"Error: No Data Found");
			url::redirect(PATH);
		}else{
			foreach($store_details as $store){
				$this->storeid = $store->store_id;
				$this->theme_name = $this->sold->get_theme_name($this->storeid);
				$this->merchant_personalised_details = $this->sold->get_merchant_personalised_details($store->merchant_id,$this->storeid);
				$this->merchant_cms = $this->sold->get_merchant_cms($store->merchant_id);
				$this->store_name = $store->store_name;
				$this->footer_merchant_details = $this->sold->get_merchant_details($store->merchant_id);
			}
		}
		$cityid = $this->session->get('CityID');
		$this->get_sold_deals = $this->sold->get_solddeals_list($cityid,$this->storeid);
		$this->get_sold_products = $this->sold->get_soldproducts_list($cityid,$this->storeid);
		$this->get_sold_auction = $this->sold->get_soldauction_list($cityid,$this->storeid);
		 
		$this->template->title = $this->Lang['SOLD_OUT2']." | ".$this->store_name;
		$this->about_us_footer = $this->sold->get_about_us_footer($storeurl);
		
		$this->get_theme_name = common::get_theme($storeurl);
		if(count($this->get_theme_name)>0) { 
			$this->sector = $this->get_theme_name->current()->sector_name;
		} else {
			$this->sector ="";
		}
		
		if($this->theme_name) { 
			$this->template->style = html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/'.$this->theme_name.'/style.css',PATH.'themes/'.THEME_NAME.'/css/'.$this->theme_name.'/multi_style.css'));
			$this->template->content = new View("themes/".THEME_NAME."/".$this->theme_name."/all_soldout");
		} else {
			$this->template->content = new View("themes/".THEME_NAME."/soldout/all_soldout");
		}
	}
}
