<?php defined('SYSPATH') OR die('No direct access allowed.');
class Deals_Controller extends Layout_Controller
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
		$this->deals = new Deals_Model();
		if(!$this->deal_setting){
		        url::redirect(PATH);
		}
		$this->is_deals="1";
	}

	/** TODAY DEALS  PAGE **/

	public function today_deals($page = "")
	{
		$this->is_todaydeals = 1;
		$this->category_name="";
		$this->category_id = "";
		$category_id="";
		$cur_category="";
			if(!$this->session->get('categoryID')){
			$this->session->set('categoryID',"");
			}
			if(count($this->session->get('categoryID'))=="1"){
						$this->session->delete('categoryID');
			}
			if($_GET){
			$this->category = $this->input->get('category');
				if($this->category){
					$category_id = implode(',',$this->category);
						if(count($category_id)==""){
							$this->session->delete('categoryID');
						}
						if($this->session->get('categoryID')){
							$this->session->set('categoryID',$category_id);
						}
					$category_new = $category_id.",".$this->session->get('categoryID');
					$this->session->set('categoryID',$category_new);
					$cur_category = $this->session->get('categoryID');
				}
			}
		$this->all_deals_count = $this->deals->get_today_deals_count(substr($cur_category, 0, -1));
		$this->pagination = new Pagination(array(
				'base_url'       => 'today-deals/page/'.$page."/",
				'uri_segment'    => 3,
				'total_items'    => $this->all_deals_count,
				'items_per_page' => 12,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));

		$this->all_deals_list = $this->deals->get_today_deals_list($this->pagination->sql_offset, $this->pagination->items_per_page,substr($cur_category, 0, -1));
		$this->view_deals_list = $this->deals->get_deals_view();
		$this->view_hot_deals_list = $this->deals->get_hot_deals_view();
		$this->deals_list = $this->deals->get_deals_min_max();
		//$this->banner_details = $this->deals->get_banner_list();
		foreach ($this->deals_list as $deals ){
		        $this->deal_max=$deals->max_deal;
		        $this->deal_min=$deals->min_deal;
		        $this->max_per=$deals->max_per;
		        $this->min_per=$deals->min_per;
	        }
		//$this->category_list = $this->deals->get_category_list();
		$this->template->title = $this->Lang["DEALS"]." | ".SITENAME;
		$this->title_display = $this->Lang["DEALS"];
		$this->template->content = new View("themes/".THEME_NAME."/deals/today_deals");
		$this->categeory_list = $this->deals->get_subcategory_list();
			if($id = $this->input->get('cate_id')){
				$type = ($this->input->get('t'));
				$id = ($this->input->get('cate_id'));

				if($type== 1){ // for main category to sub category list
					$this->view_type = 1;
					$this->categeory_list = $this->deals->get_subcategory_list($id);
					echo  new View("themes/".THEME_NAME."/deals/subcategory_list");
				}
				else if($type== 2){  // for sub category to 2nd level category list
					$this->view_type = 2;
					$this->categeory_list = $this->deals->get_subcategory_list($id,2);
					echo  new View("themes/".THEME_NAME."/deals/subcategory_list");
				}
				else if($type== 3){ // for 2nd category to 3rd level category list
					$this->view_type = 3;
					$this->categeory_list = $this->deals->get_subcategory_list($id,3);
					echo  new View("themes/".THEME_NAME."/deals/subcategory_list");
				}
					exit;
		}


	}

	/** TODAY'S DEAL VIEWMORE **/

	public function today_deals_1($page = "")
	{
		$deal_record = $this->input->get('record');
		$deal_offset = $this->input->get('offset');
		// for filter functionality
		$discount = $this->input->get("discount");
		$price = $this->input->get("price");
		$main_cat = $this->input->get("main");
		$sub_cat = $this->input->get("sub");
		$sec_cat = $this->input->get("sec");
		$third_cat = $this->input->get("third");
		$price_text = $this->input->get("price1");
		$this->is_todaydeals = 1;
		$this->all_deals_count = $this->deals->get_today_deals_count();
		$this->record = $this->input->get('record');
		$this->all_deals_list = $this->deals->get_today_deals_list($deal_offset, $deal_record,"",$discount,$price,$main_cat,$sub_cat,$sec_cat,$third_cat,$price_text);
		$this->view_deals_list = $this->deals->get_deals_view();
		$this->view_hot_deals_list = $this->deals->get_hot_deals_view();
		$this->template->title = $this->Lang["DEALS"]." | ".SITENAME;
		$this->title_display = $this->Lang["DEALS"];
		echo  new View("themes/".THEME_NAME."/deals/today_deals_list");
		exit;
	}

	public function load_page_content($page = "")
	{
		$discount = $this->input->get("discount");
		$price = $this->input->get("price");
		$main_cat = $this->input->get("main");
		$sub_cat = $this->input->get("sub");
		$sec_cat = $this->input->get("sec");
		$third_cat = $this->input->get("third");
		$price_text = $this->input->get("price1");
		$type = $this->input->get("type");
		//$this->all_deals_count = $this->deals->get_ajax_deals_count($discount,$price,$main_cat,$sub_cat,$sec_cat,$third_cat);
		$this->all_deals_list = $this->deals->get_ajax_deals_list($discount,$price,$main_cat,$sub_cat,$sec_cat,$third_cat,$price_text,$type);
		$this->template->title = $this->Lang["DEALS"]." | ".SITENAME;
		$this->title_display = $this->Lang["DEALS"];
		if($type == 1){
			echo count($this->all_deals_list);
		}else{
			echo  new View("themes/".THEME_NAME."/deals/today_deals_list");
		}
		exit;
	}

	/** DEALS  LISTING - SEARCH BASED **/

	public function search_list( $page = "")
	{
		$this->is_todaydeals = 1;
		$this->category_id = "";
		$search = $this->input->get('q');
		$maincatid= $this->input->get("d_id"); // for search with category in header
		$this->all_deals_count = $this->deals->get_search_deals_count($search,$maincatid);
		$this->pagination = new Pagination(array(
				'base_url'       => '/deals/search.html/page/'.$page,
				'uri_segment'    => 4,
				'total_items'    => $this->all_deals_count,
				'items_per_page' => 12,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->all_deals_list = $this->deals->get_search_deals_list($search, $this->pagination->sql_offset, $this->pagination->items_per_page,$maincatid);
		$this->view_deals_list = $this->deals->get_deals_view();
		$this->view_hot_deals_list = $this->deals->get_hot_deals_view();
		
		$title_category_name = "";
		if($maincatid!=''){
			if(count($this->category_list)>0){
				foreach ($this->category_list as $d) {
					if($d->category_id==$maincatid)
						$title_category_name = $d->category_name;
				}
			}
		}
		
		$title_display = "";
		if($title_category_name!=''){
			if($search!='')
				$title_display = ' / '.$title_category_name.' - '.$search;
			else
				$title_display = ' / '.$title_category_name;
		}else{
			if($search!='')
				$title_display = ' - '.$search;
		}
		
		$this->template->title = rtrim($this->Lang["DEALS"].$title_display." | ".SITENAME);
		$this->title_display = rtrim($this->Lang["DEALS"].$title_display);
		
		
		$this->category_name = $search;
		$this->categeory_list = $this->deals->get_subcategory_list();
		$this->deals_list = $this->deals->get_deals_min_max();
		foreach ($this->deals_list as $deals ){
		        $this->deal_max=$deals->max_deal;
		        $this->deal_min=$deals->min_deal;
		        $this->max_per=$deals->max_per;
		        $this->min_per=$deals->min_per;
		}
		$this->template->content = new View("themes/".THEME_NAME."/deals/today_deals");
	}

	/** DEALS  LISTING - CATEGORY BASED **/

	public function categoery_list($cat_type = "",$category = "", $page = "")
	{
		$this->is_todaydeals = 1;
		$cat_type=base64_decode($cat_type);
		$this->category_id = "";
		$this->sub_cat="";
		$this->category_url = $category;
		$category_name="";
		if($cat_type=="sub"){
		                $this->sub_cat= $category;
				$category_deatils = $this->deals->get_categoryname($category);
				$this->category_id = $category_deatils[0]->main_category_id;
				$category_name = $category_deatils[0]->category_name;
		} elseif($cat_type=="sec"){
		                $this->sub_cat= "2";
				$category_deatils = $this->deals->get_categoryname($category);
				$this->category_id = $category_deatils[0]->main_category_id;
				$category_name = $category_deatils[0]->category_name;
		} else if($cat_type=="third"){
		                $this->sub_cat= "3";
				$category_deatils = $this->deals->get_categoryname($category);
				$this->category_id = $category_deatils[0]->main_category_id;
				$category_name = $category_deatils[0]->category_name;
		} else {
			$category_deatils = $this->deals->get_categoryname($category);
			$this->category_id = $category_deatils[0]->category_id;
			$category_name = $category_deatils[0]->category_name;
		}
		$this->all_deals_count = $this->deals->get_deals_count($cat_type,$category);
		$this->pagination = new Pagination(array(
				'base_url'       => 'deal/c/'.base64_encode($cat_type).'/'.$category.'.html/page/'.$page,
				'uri_segment'    => 6,
				'total_items'    => $this->all_deals_count,
				'items_per_page' => 12,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->all_deals_list = $this->deals->get_deals_list($cat_type,$category, $this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->view_deals_list = $this->deals->get_deals_view();
		$this->view_hot_deals_list = $this->deals->get_hot_deals_view();
		$this->template->title = rtrim($this->Lang['DEALS'].' / '.$category_name." | ".SITENAME);
		$this->title_display = rtrim($this->Lang['DEALS'].' / '.$category_name);
		$this->category_name = $category_name;
                $this->categeory_list = $this->deals->get_subcategory_list();
                $this->deals_list = $this->deals->get_deals_min_max();
		foreach ($this->deals_list as $deals ){
		$this->deal_max=$deals->max_deal;
		$this->deal_min=$deals->min_deal;
		$this->max_per=$deals->max_per;
		$this->min_per=$deals->min_per;

			}
		$this->template->content = new View("themes/".THEME_NAME."/deals/today_deals");
	}

	/** DEALS DETAILS PAGE **/

	public function details_deals($storeurl="",$deal_key = "", $url_title = "",$type = "")
	{
		$this->is_todaydeals = 1;
                $this->is_details = 1;
        $this->storeurl = $storeurl;
		$this->deals_deatils = $this->deals->get_deals_details($deal_key, $url_title,$type);
		if(count($this->deals_deatils) == 0){
			common::message(-1, $this->Lang["PAGE_NOT"]);
			url::redirect(PATH);
		}
		foreach($this->deals_deatils as $Deal){
			$this->all_deals_list = $this->deals->get_related_category_deals_list($Deal->deal_id, $Deal->sec_category_id);
			$this->products_list_name = $this->Lang['REL_DEAL'];
			if(count($this->all_deals_list) < 3){     
			        $this->all_deals_list= $this->deals->get_hot_all_deals_view($Deal->deal_id);
			        $this->products_list_name = $this->Lang['HOT_DEAL'];
			         if(count($this->all_deals_list) < 3){     
			                $this->all_deals_list = $this->deals->get_related_category_deals_list($Deal->deal_id, $Deal->sec_category_id);
			                $this->products_list_name = $this->Lang['REL_DEAL'];
			         }
			}
 			$this->avg_rating =$this->deals->get_deal_rating($Deal->deal_id);
 			$this->sum_rating =$this->deals->get_deal_rating_sum($Deal->deal_id);
			$this->comments_deatils = $this->deals->get_comments_data($Deal->deal_id,1);
			$this->like_details = $this->deals->get_like_data($Deal->deal_id,1);
			$this->unlike_details = $this->deals->get_unlike_data($Deal->deal_id,1);
			$this->template->title = $Deal->deal_title."/".$Deal->category_name."/".CURRENCY_SYMBOL.$Deal->deal_value." | ".SITENAME;
				if($Deal->meta_description){
					$this->template->description = $Deal->meta_description;
				}
				if($Deal->meta_keywords){
					$this->template->keywords = $Deal->meta_keywords;
				}
				if($Deal->deal_key){
				        $this->template->metaimage = PATH.'images/deals/1000_800/'.$Deal->deal_key.'_1.png';
			    }
			    /* Merchant Cms footer starts */
				$this->home = new Home_Model();
				$this->merchant_cms = $this->home->get_merchant_cms_data($storeurl);
				$this->about_us_footer = $this->home->get_about_us_footer($storeurl);
				$this->stores = new Stores_Model();
				$this->admin_details = $this->stores->get_admin_details();
				/* Merchant Cms footer ends */
				$this->theme_name = $this->deals->get_theme_name($Deal->shop_id);
				$this->footer_merchant_details = $this->deals->get_merchant_details($Deal->merchant_id);
		   }
		   $this->storeid = $this->deals->get_store_id($storeurl);
		   $this->get_theme_name = common::get_theme($storeurl);
			if(count($this->get_theme_name)>0) { 
				$this->sector = $this->get_theme_name->current()->sector_name;
			} else {
				$this->sector ="";
			}
			
			if($this->theme_name) { 
			
			//$this->template->style = html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
			$this->template->style = html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/'.$this->theme_name.'/style.css',PATH.'themes/'.THEME_NAME.'/css/'.$this->theme_name.'/multi_style.css'));
			
			$this->template->content = new View("themes/".THEME_NAME."/".$this->theme_name."/deals/details_deals");
		} else {
			
			$this->template->content = new View("themes/".THEME_NAME."/deals/details_deals");
		}
	
		
	}

        /** DEAL RATING **/
	public function deal_rating()
	{
		$aResponse['error'] = false;

		if($this->UserID == "") $aResponse['error'] = true;

		$aResponse['message'] = '';
		$aResponse['server'] = '';
			if(isset($_POST['action']) && $this->UserID)
			{
				if(htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'rating')
				{
						$id = intval($_POST['idBox']);
						$rate = floatval($_POST['rate']);
						$deal_id=$_POST['deal_id'];
						$success = true;
						if($success)
						{
								$aResponse['message'] = 'Your rate has been successfuly recorded. Thanks for your rate :)';
								$aResponse['server'] = '<strong>Success answer :</strong> Success : Your rate has been recorded. Thanks for your rate :)<br />';
								$aResponse['server'] .= '<strong>Rate received :</strong> '.$rate.'<br />';
								$aResponse['server'] .= '<strong>Deal ID :</strong> '.$deal_id.'<br />';
								$aResponse['server'] .= '<strong>ID to update :</strong> '.$id;
								$this->userPost = $this->input->post();
								$this->auction_rate = $this->deals->save_deal_rating(arr::to_object($this->userPost));
								$ch="auction_sess_".$_POST['deal_id'];
								$sta= $this->session->set($ch,$_POST['rate']);

						}
				}
		}
		echo json_encode($aResponse);
exit;

	}
		/**AJAX FILTER DEALS **/

	public function ajax_post_deals()
	{

		$price = $this->input->get('amount');

		$price_from = 0;
		$price_to = 100000;
		if($this->input->get('amount')){
			$price1 = explode('-',$price);
			$price_from = trim($price1[0]);
			$price_to = trim($price1[1]);
		}
		$price1_1 = explode(CURRENCY_SYMBOL,$price_from);
			$price1_2 = explode(CURRENCY_SYMBOL,$price_to);


		$discount_from = 0;
		$discount_to = 100;

		if($this->input->get('discount')){

			$discount = $this->input->get('discount');
			$discount1 = explode('-',$discount);
			$discount_from = trim($discount1[0]);
			$discount_to = trim($discount1[1]);

			$vaslu1=$price1_1[0];
			$vaslu2=$price1_2[0];
		}
		else {
			$vaslu1=$price1_1[1];
			$vaslu2=$price1_2[1];
		}
			$from = explode("%",$discount_from);
			$to = explode("%",$discount_to);

			$this->all_deals_list = $this->deals->get_deals_lists_byfilter1($vaslu1,$vaslu2,$from[0],$to[0]);
			$this->view_deals_list = $this->deals->get_deals_view();
			$this->view_hot_deals_list = $this->deals->get_hot_deals_view();
			echo  new View("themes/".THEME_NAME."/deals/today_deals_list");

		exit;
	}
	public function test_details_deals($store_url="",$product_url="",$product_urls="")
	{
		echo $store_url." ".$product_url." ".$product_urls;
		echo " test deal "; exit;
	}

}
