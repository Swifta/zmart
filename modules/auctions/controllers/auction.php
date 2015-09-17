<?php defined('SYSPATH') OR die('No direct access allowed.');
class Auction_Controller extends Layout_Controller
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

		$this->deals = new Auction_Model();
		if(!$this->auction_setting){
		        url::redirect(PATH);
		}

	}

	/** TODAY AUCTION PAGE **/

	public function today_auction($page = "")
	{
		//$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/anythingzoomer.css'));
		$this->template->javascript .= html::script(array(PATH.'js/timer/kk_countdown_1_2_jquery_min.js'));
	    $this->is_auction = 1;
		$this->category_name="";
		$category_id="";
		$cur_category="";
		$this->sort = "";
		$this->category_id = "";

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
					 $this->sort = $this->input->get('sort');
					 $search = $this->input->get('q');

			}

		$this->all_deals_count = $this->deals->get_today_deals_count(substr($cur_category, 0, -1),$this->sort);
		$this->pagination = new Pagination(array(
				'base_url'       => 'auction/page/'.$page."/",
				'uri_segment'    => 3,
				'total_items'    => $this->all_deals_count,
				'items_per_page' => 12,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));

			$this->all_deals_list = $this->deals->get_today_deals_list($this->pagination->sql_offset, $this->pagination->items_per_page,substr($cur_category, 0, -1),$this->sort);
			$this->view_auction_list = $this->deals->get_auction_view();
			
                $this->view_hot_deals_list = $this->deals->get_hot_deals_view();
	    $this->all_payment_list = $this->deals->payment_list();
		//$this->avg_rating =$this->deals->get_all_auction_rating();
		//$this->categeory_list = $this->deals->get_subcategory_list();
		//$this->banner_details = $this->deals->get_banner_list();
		$this->template->title = $this->Lang["AUCTION"]." | ".SITENAME;
		$this->title_display = $this->Lang["AUCTION"];
		$this->template->content = new View("themes/".THEME_NAME."/auction/auction");
		if($id = $this->input->get('cate_id')){
		$type = ($this->input->get('t'));
			$id = ($this->input->get('cate_id'));

			if($type== 1){ // for main category to sub category list
				$this->view_type = 1;
				$this->categeory_list = $this->deals->get_subcategory_list($id);
				echo  new View("themes/".THEME_NAME."/auction/sub_categorey_list");
			}
			else if($type== 2){  // for sub category to 2nd level category list
				$this->view_type = 2;
				$this->categeory_list = $this->deals->get_subcategory_list($id,2);
				echo  new View("themes/".THEME_NAME."/auction/sub_categorey_list");
			}
			else if($type== 3){ // for 2nd category to 3rd level category list
				$this->view_type = 3;
				$this->categeory_list = $this->deals->get_subcategory_list($id,3);
				echo  new View("themes/".THEME_NAME."/auction/sub_categorey_list");
			}
		        exit;
		}

		$this->deals_list = $this->deals->get_auction_min_max();
		foreach ($this->deals_list as $auction ){
		$this->deal_max=$auction->max_deal;
		$this->deal_min=$auction->min_deal;


			}

	}

		/** TODAY'S DEAL VIEWMORE **/

	public function today_auction_1($page = "")
	{

		$deal_record = $this->input->get('record');
		$deal_offset = $this->input->get('offset');
		// for filter functionality
		$price = $this->input->get("price");
		$main_cat = $this->input->get("main");
		$sub_cat = $this->input->get("sub");
		$sec_cat = $this->input->get("sec");
		$third_cat = $this->input->get("third");
		$price_text = $this->input->get("price1");
                $this->view_hot_deals_list = $this->deals->get_hot_deals_view();
		$this->is_todaydeals = 1;
		$this->all_deals_count = $this->deals->get_today_deals_count();

		$this->record = $this->input->get('record');

		$this->all_payment_list = $this->deals->payment_list();
		$this->avg_rating =$this->deals->get_all_auction_rating();
		$this->categeory_list = $this->deals->get_subcategory_list();
		$this->all_deals_list = $this->deals->get_today_deals_list($deal_offset, $deal_record,"","","",$price,$main_cat,$sub_cat,$sec_cat,$third_cat,$price_text);
		$this->view_auction_list = $this->deals->get_auction_view();
		$this->template->title = $this->Lang["AUCTION"]." | ".SITENAME;
		$this->title_display = $this->Lang["AUCTION"];
		echo  new View("themes/".THEME_NAME."/auction/listing");
		exit;


	}

	public function load_page_content($page = "")
	{
		//$discount = $this->input->get("discount");
		$price = $this->input->get("price");
		$main_cat = $this->input->get("main");
		$sub_cat = $this->input->get("sub");
		$sec_cat = $this->input->get("sec");
		$third_cat = $this->input->get("third");
		$price_text = $this->input->get("price1");
		$type = $this->input->get("type");
		//$this->all_deals_count = $this->deals->get_ajax_deals_count($discount,$price,$main_cat,$sub_cat,$sec_cat,$third_cat);
		$this->all_payment_list = $this->deals->payment_list();
		$this->all_deals_list = $this->deals->get_ajax_auctions_list($price,$main_cat,$sub_cat,$sec_cat,$third_cat,$price_text,$type);
		$this->view_auction_list = $this->deals->get_auction_view();
		$this->template->title = $this->Lang["AUCTION"]." | ".SITENAME;
		$this->title_display = $this->Lang["AUCTION"];
		if($type == 1){
			echo count($this->all_deals_list);
		}else{
			echo  new View("themes/".THEME_NAME."/auction/listing");
		}
		exit;
	}



	/** DEALS  LISTING - SEARCH BASED **/

	public function search_list( $page = "")
	{
		$this->is_auction = 1;
		$this->category_id = ""; // for subscribe page
		$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/anythingzoomer.css'));
		$this->template->javascript .= html::script(array(PATH.'js/timer/kk_countdown_1_2_jquery_min.js'));
		$search = $this->input->get('q');
		$maincatid= $this->input->get("d_id"); // for search with category in header
		$this->all_deals_count = $this->deals->get_search_deals_count($search,$maincatid);

		$this->pagination = new Pagination(array(
				'base_url'       => '/auction/search.html/page/'.$page,
				'uri_segment'    => 4,
				'total_items'    => $this->all_deals_count,
				'items_per_page' => 12,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->all_deals_list = $this->deals->get_search_deals_list($search, $this->pagination->sql_offset, $this->pagination->items_per_page,$maincatid);
		$this->view_hot_deals_list = $this->deals->get_hot_deals_view();
		
		$this->view_auction_list = $this->deals->get_auction_view();
		$this->categeory_list = $this->deals->get_subcategory_list();
		$this->all_payment_list = $this->deals->payment_list();
		$this->avg_rating =$this->deals->get_all_auction_rating();
		
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
		
		$this->template->title = rtrim($this->Lang["AUCTION"].$title_display." | ".SITENAME);
		$this->title_display = rtrim($this->Lang["AUCTION"].$title_display);
		
		
		$this->category_name = $search;
		$this->sort = "";
		$this->deals_list = $this->deals->get_auction_min_max();
		foreach ($this->deals_list as $auction ){
		$this->deal_max=$auction->max_deal;
		$this->deal_min=$auction->min_deal;

			}

		$this->template->content = new View("themes/".THEME_NAME."/auction/auction");

	}

	/** AUCTION  LISTING - CATEGORY BASED **/

	public function categoery_list($cat_type="",$category = "", $page = "")
	{
		$cat_type=base64_decode($cat_type);
		$this->template->javascript .= html::script(array(PATH.'js/timer/kk_countdown_1_2_jquery_min.js'));
		$this->is_auction = 1;
		$this->category_id = "";
		$this->sub_cat="";
		$this->category_url = $category;
		$category_name="";

		if($cat_type=="sub"){
		        $this->sub_cat= $category;
				$category_deatils = $this->deals->get_categoryname($category);
				$this->category_id = $category_deatils[0]->main_category_id;
				$category_name = $category_deatils[0]->category_name;
		}
		elseif($cat_type=="sec"){
		        $this->sub_cat= "2";
				$category_deatils = $this->deals->get_categoryname($category);
				$this->category_id = $category_deatils[0]->main_category_id;
				$category_name = $category_deatils[0]->category_name;
		}
		else if($cat_type=="third"){
		        $this->sub_cat= "3";
				$category_deatils = $this->deals->get_categoryname($category);
				$this->category_id = $category_deatils[0]->main_category_id;
				$category_name = $category_deatils[0]->category_name;
		}
		else {
			$category_deatils = $this->deals->get_categoryname($category);
			$this->category_id = $category_deatils[0]->category_id;
			$category_name = $category_deatils[0]->category_name;
		}
		$this->all_deals_count = $this->deals->get_deals_count($cat_type,$category);
		$this->pagination = new Pagination(array(
				'base_url'       => 'auction-c/'.base64_encode($cat_type).'/'.$category.'.html/page/'.$page,
				'uri_segment'    => 5,
				'total_items'    => $this->all_deals_count,
				'items_per_page' => 12,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->all_deals_list = $this->deals->get_deals_list($cat_type,$category, $this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->view_hot_deals_list = $this->deals->get_hot_deals_view();
		$this->view_auction_list = $this->deals->get_auction_view();
		$this->all_payment_list = $this->deals->payment_list();
		$this->avg_rating =$this->deals->get_all_auction_rating();
		$this->categeory_list = $this->deals->get_subcategory_list();
		$this->template->title = rtrim($this->Lang['AUCTION'].' / '.$category_name." | ".SITENAME);
		$this->title_display = rtrim($this->Lang['AUCTION'].' / '.$category_name);
		$this->category_name = $category_name;
		$this->deals_list = $this->deals->get_auction_min_max();
		foreach ($this->deals_list as $auction ){
		        $this->deal_max=$auction->max_deal;
		        $this->deal_min=$auction->min_deal;
                }
		$this->template->content = new View("themes/".THEME_NAME."/auction/auction");
	}

	/** AUCTION DETAILS PAGE **/

	public function details_auction($storeurl="",$deal_key = "", $url_title = "",$type = "")
	{
	        $this->is_auction = 1;
	        $this->is_details = 1;
	        $this->is_auction_refresh = 1;
	        $this->storeurl = $storeurl;
	        $this->template->javascript .= html::script(array(PATH.'js/timer/kk_countdown_1_2_jquery_min.js'));
		$this->deals_deatils = $this->deals->get_deals_details($deal_key, $url_title,$type);
                $this->storeid = $this->deals->get_store_id($storeurl);
		if(count($this->deals_deatils) == 0){
			common::message(-1, $this->Lang["PAGE_NOT"]);
			url::redirect(PATH);
		}
		
		
		foreach($this->deals_deatils as $Deal){
			$this->avg_rating =$this->deals->get_auction_rating($Deal->deal_id);
			$this->all_deals_list = $this->deals->get_related_category_deals_list($Deal->deal_id, $Deal->sec_category_id);
			$this->products_list_name = $this->Lang['REL_AUCTION'];
                        if(count($this->all_deals_list) < 3){      
                        $this->all_deals_list = $this->deals->get_hot_all_deals_view($Deal->deal_id);
                        $this->products_list_name = $this->Lang['HOT_AUCTION'];
                                if(count($this->all_deals_list) < 3){ 
                                        $this->all_deals_list = $this->deals->get_related_category_deals_list($Deal->deal_id, $Deal->sec_category_id);
                                        $this->products_list_name = $this->Lang['REL_AUCTION'];
                                }
                        }
			$this->all_payment_list = $this->deals->payment_list();
			$this->comments_deatils = $this->deals->get_comments_data($Deal->deal_id,3);
			$this->like_details = $this->deals->get_like_data($Deal->deal_id,3);
			$this->unlike_details = $this->deals->get_unlike_data($Deal->deal_id,3);
			$this->transaction_details = $this->deals->get_auction_transaction_data($Deal->deal_id);
			$this->winner_transaction_details = $this->deals->get_auction_winner_transaction_data($Deal->deal_id);

			$this->template->title = $Deal->deal_title."/".$Deal->category_name."/".CURRENCY_SYMBOL.$Deal->deal_value." | ".SITENAME;
			
				if($Deal->meta_description){
					$this->template->description = $Deal->meta_description;
				}
				if($Deal->meta_keywords){
					$this->template->keywords = $Deal->meta_keywords;
				}
				if($Deal->deal_key){
				    $this->template->metaimage = PATH.'images/auction/1000_800/'.$Deal->deal_key.'_1.png';
			    }
			    /* Merchant Cms footer starts */
				$this->home = new Home_Model();
				$this->merchant_cms = $this->home->get_merchant_cms_data($storeurl);
				$this->about_us_footer = $this->home->get_about_us_footer($storeurl);
				$this->stores = new Stores_Model();
				$this->admin_details = $this->stores->get_admin_details();
				/* Merchant Cms footer ends */
				$this->footer_merchant_details = $this->deals->get_merchant_details($Deal->merchant_id);
		}
		$this->get_theme_name = common::get_theme($storeurl);
		$this->theme_name = $this->deals->get_theme_name($Deal->shop_id);
		
			if(count($this->get_theme_name)>0) { 
				$this->sector = $this->get_theme_name->current()->sector_name;
			} else {
				$this->sector ="";
			}
			
			if($this->theme_name) { 
			
			//$this->template->style = html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
			$this->template->style = html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/'.$this->theme_name.'/style.css',PATH.'themes/'.THEME_NAME.'/css/'.$this->theme_name.'/multi_style.css'));
			
			$this->template->content = new View("themes/".THEME_NAME."/".$this->theme_name."/auction/detail");
		} else {
			
			$this->template->content = new View("themes/".THEME_NAME."/auction/detail");
		}
		/*
			if($this->sector =="Electronics") { 
				$sector ="electronics"; 
				//$this->template->style = html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
				$this->template->style = html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/'.$sector.'/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
				$this->template->content = new View("themes/".THEME_NAME."/".$sector."/auction/detail");
			} elseif($this->sector =="Fashion") {
				$sector = "fashion";
				//$this->template->style = html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
				$this->template->style = html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/'.$sector.'/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
				$this->template->content = new View("themes/".THEME_NAME."/".$sector."/auction/detail");
			} else {
				$this->template->content = new View("themes/".THEME_NAME."/auction/detail");
			}*/
	}

	public function bid_history_amount($deal_key = "", $url_title = "",$type = "")
	{
		$this->deals_deatils = $this->deals->get_deals_details($deal_key, $url_title,$type);
		$deal = 1;
		foreach($this->deals_deatils as $Deal){
			if( $Deal->enddate < time()) $deal = 0;
			echo $Deal->deal_price.'--'.$deal;
		}
		exit;
	}

	public function bid_history($deal_id = "")
	{
			$this->transaction_details = $this->deals->get_auction_transaction_data($deal_id);
			echo new View("themes/".THEME_NAME."/auction/bid_history");
			exit;
	}
	
	/** BID PAYMENT **/
	public function bid_payment()
	{

		if($_POST){
			$this->current_bid_value = $this->input->post('bid_deal_current_value');
			$this->deal_value = $this->input->post('bid_deal_value');
			$this->deal_id = $this->input->post('bid_deal_id');
			$this->deal_key = $this->input->post('bid_deal_key');
			$this->bid_title = $this->input->post('bid_title');
			$this->url_title = $this->input->post('bid_url_title');
			$this->end_time = $this->input->post('end_time');
			$this->shipping_amount = $this->input->post('shipping_amount');
			$this->store_url = $this->input->post('store_url');

		} else {

				    common::message(-1, "Already Auction has bid. Try with new amount!");
					url::redirect(PATH);

			}
		$this->template->content = new View("themes/".THEME_NAME."/auction/bidding-page");

	}

/** SUCCESS BIDDING **/
	public function success_bidding()
	{
		//$this->template->javascript .= html::script(array(PATH.'js/timer/kk_countdown_1_2_jquery_min_detail.js'));
		if($_POST){
				$this->current_bid_value = $this->input->post('bid_value');
				$this->deal_value = $this->input->post('bid_deal_value');
				$this->deal_id = $this->input->post('bid_deal_id');
				$this->deal_key = $this->input->post('bid_deal_key');
				$this->bid_title = $this->input->post('bid_title');
				$this->url_title = $this->input->post('bid_url_title');
				$this->end_time = $this->input->post('end_time');
				$this->shipping_amount = $this->input->post('shipping_amount');
				$this->store_url = $this->input->post('store_url');
				if($this->end_time > time()){

				$status = $this->deals->insert_bidding(arr::to_object($_POST)); //insert the bidding details

				if($status>0)
				{
					$this->template->content = new View("themes/".THEME_NAME."/auction/success-auction");
				}
				if($status==0)
				{
					common::message(-1, "Already someone has bid same amount.! Try with new amount");
					url::redirect(PATH.$this->store_url."/auction/".$this->deal_key."/".$this->url_title.".html");
				}
			} else {

				    common::message(-1, "Auction time is closed!");
					url::redirect(PATH.$this->store_url."/auction/".$this->deal_key."/".$this->url_title.".html");

			}
		}

	}
	/**BUY AUCTION **/
	public function buy_auction($deal_id = "",$user_id = "",$amount = "",$bid_id = "")
	{
		$this->template->javascript .= html::script(array(PATH.'themes/'.THEME_NAME.'/js/jquery.validate.js'));
		$this->auction_buy = 1;
			if($_POST){
				url::redirect(PATH.'auction/buy_auction/'.$deal_id.'/'.$user_id.'/'.$amount.'/'.$bid_id);
			}
		$this->current_bid_value = base64_decode($amount);
		$this->bid_id = base64_decode($bid_id);
		$this->auction_user = base64_decode($user_id);
		$check_already_buy = $this->deals->check_already_buy($this->bid_id,$this->auction_user);

		if($check_already_buy){

			$this->deals_payment_deatils = $this->deals->get_payment_auction_details(base64_decode($deal_id));
			if(count($this->deals_payment_deatils)){
				$this->shipping_address = $this->deals->get_user_data_list();
				$this->template->content = new View("themes/".THEME_NAME."/auction/auction_payment1");
			}
			else{
				common::message(-1,"Sorry! this auction has been re-initiated");
				url::redirect(PATH.'auction.html');
			}
		}
		else {
			common::message(-1,"Sorry! You are already buy this Auction");
		  url::redirect(PATH.'auction.html');
		}


	}
	/** WINNER LIST  **/

	public function winner($page = "")
	{

         //$this->is_auction = 1;
         $this->auction_winner_act = 1;
		$this->count = $this->deals->get_winner_count();
		$this->pagination = new Pagination(array(
				'base_url'       => 'auction/winner.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $this->count,
				'items_per_page' => 10,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));

		$this->winner_list = $this->deals->get_winner_list($this->pagination->sql_offset,$this->pagination->items_per_page);
		$this->template->title = 'winners | '.SITENAME;
		$this->title_display =  'winners';
		$this->template->content = new View("themes/".THEME_NAME."/auction/winner");


	}

	/** AUCTION WINNER VIEWMORE **/

	public function winner_pagination($page = "")
	{

		$deal_record = $this->input->get('record');
		$deal_offset = $this->input->get('offset');

		$this->count = $this->deals->get_winner_count();

		$this->record = $this->input->get('record');
		$this->winner_list = $this->deals->get_winner_list($deal_offset, $deal_record);
		$this->template->title = 'winners | '.SITENAME;
                $this->title_display =  'winners';
		echo new View("themes/".THEME_NAME."/auction/winner_list");
		exit;


	}

	/** CHECK ALREADY BID AMOUNT FOR THE AUCTION  **/

	public function check_amount($amount = "",$auction_id = "")
	{
		if($amount && $auction_id ){
			$status = $this->deals->check_exist_amount($amount,$auction_id);
			if($status>0) { echo "2"; exit; }
			else { echo "1"; exit; }
		}
	}

/**AUCTION RATING **/
	public function auction_rating()
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
								$this->auction_rate = $this->deals->save_auction_rating(arr::to_object($this->userPost));
								$ch="auction_sess_".$_POST['deal_id'];
								$sta= $this->session->set($ch,$_POST['rate']);

						}
				}
		}
		echo json_encode($aResponse);
exit;

	}
		/**AJAX FILTER AUCTION **/

	public function ajax_post_auctions()
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
				    $this->all_payment_list = $this->deals->payment_list();
		$this->avg_rating =$this->deals->get_all_auction_rating();
		$this->categeory_list = $this->deals->get_subcategory_list();
			$this->all_deals_list = $this->deals->get_auctions_lists_byfilter($price1_1[1],$price1_2[1]);
			$this->view_auction_list = $this->deals->get_auction_view();
           		echo new View("themes/".THEME_NAME."/auction/listing");
			exit;
	}

}
