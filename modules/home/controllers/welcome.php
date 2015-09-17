<?php defined('SYSPATH') OR die('No direct access allowed.');
class Welcome_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->home = new Home_Model();
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
		
		
		foreach($this->generalSettings as $s){
		
		        $this->Api_Username = "nandhu_1337947987_biz_api1.gmail.com";
			$this->Api_Password = "1337948040";
			$this->Api_Signature = "A0YqGlJEML24al4qg2LnV2U.g2ThAfXD37NEiWIVcgjl1pxlygg-XaVs";

			$this->Api_Username = $s->paypal_account_id;
			$this->Api_Password = $s->paypal_api_password;
			$this->Api_Signature = $s->paypal_api_signature;			

			$this->Live_Mode = $s->paypal_payment_mode;
			$this->API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
			$this->Paypal_Url = "https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=";

			if($this->Live_Mode == 1){
				$this->API_Endpoint = "https://api-3t.paypal.com/nvp";
				$this->Paypal_Url = "https://www.paypal.com/webscr&cmd=_express-checkout&token=";
			}
		}
		$this->skip_value = $this->session->get("Skip");
		$this->Api_Version = "76.0";
		$this->Api_Subject = $this->AUTH_token = $this->AUTH_signature = $this->AUTH_timestamp = '';
		$this->template->javascript .= html::script(array(PATH.'themes/'.THEME_NAME.'/js/jquery.validate.js'));
	}

	/** HOME PAGE **/
	
	public function index($cityid = "")
	{ 
		
		if(!$cityid){
			$cityid = $this->city_id;
		}
        	$this->current_cityid = $cityid;
		//$this->get_city = $this->all_city_list;
		$this->is_home = 1;
		//$this->banner_details = $this->home->get_banner_list();
		//$this->view_products_list = $this->home->get_products_view();
		//$this->view_hot_products_list = $this->home->get_hot_products_view();
		$this->curr_city_id = $cityid;
		$this->template->content = new View("themes/".THEME_NAME."/home");
		
		//$this->all_payment_list = $this->home->payment_list();
		//$this->category_list = $this->home->get_category_list($this->deal_setting,$this->product_setting,$this->auction_setting);
		//$this->ads_details = $this->home->get_ads_list();
		$this->cat = "";
		$this->new_arrivals_list = $this->home->get_new_arrivals();
		$this->best_seller_list = $this->home->get_best_seller();
		
		
		$this->category_order = $this->home->get_category_orders();
		
		$this->category_order_1 = $this->home->get_category_orders_1();
		if(count($this->category_order)>0){
			$cat_count = 0;
			$cat_ids = array();
			foreach($this->category_order as $order){
				if($cat_count<3)
					$limit_type = 1;
				else
					$limit_type = 2;
				$this->cat_product_list[$cat_count] = $this->home->get_category_products($order->order_by,$limit_type,$order->category_id);
				$this->category_name_list[$cat_count] = $order->category_name;
				$cat_ids[] = $order->category_id;
				$cat_count++;
			}
			if($cat_count<7){
				$category_ids = implode(',',$cat_ids);
				$category_limit = 7-$cat_count;
				$this->category_order_1 = $this->home->get_category_orders_1($category_ids,$category_limit);
				if(count($this->category_order_1)>0){
					foreach($this->category_order_1 as $order2){
						if($cat_count<3)
							$limit_type = 1;
						else
							$limit_type = 2;
						$this->cat_product_list[$cat_count] = $this->home->get_category_products('',$limit_type,$order2->category_id);
						$this->category_name_list[$cat_count] = $order2->category_name;
						$cat_count++;
					}
				}
			}
		}else{
			$this->category_order_1 = $this->home->get_category_orders_1();
			if(count($this->category_order_1)>0){
				$cat_count = 0;
				foreach($this->category_order_1 as $order1){
					if($cat_count<3)
						$limit_type = 1;
					else
						$limit_type = 2;
					$this->cat_product_list[$cat_count] = $this->home->get_category_products('',$limit_type,$order1->category_id);
					$this->category_name_list[$cat_count] = $order1->category_name;
					$cat_count++;
				}
			}
		}//print_r($this->cat_product_list);exit;
		
		
		/*$this->cat_product_list1 = $this->home->get_category_products(1,1);
		$this->cat_product_list2 = $this->home->get_category_products(2,1);
		$this->cat_product_list3 = $this->home->get_category_products(3,1);*/
		$this->view_hot_deals_list = $this->home->get_hot_deals_view();
		$this->view_hot_deals_list1 = $this->home->get_hot_deals_view1();
		$this->blog_list = $this->home->get_blog_list();
		
		/*$cnt = 4;
		for($i=0;$i<4;$i++){
			$this->cat_product_list[$i] = $this->home->get_category_products($cnt,2);
			$cnt++;
		}*/
		
		if($_GET) { 
			$search="";
			$category=($this->input->get('c'));
			$main_cat = ($this->input->get('m_c'));
			$search=$this->input->get('q');
			$cat_type=($this->input->get('c_t'));
			foreach ($this->category_list as $row){
				if( $row->category_id == $main_cat )
				$this->cat = $row->category_url;
		 	}
		 	 $maincatid= $this->input->get("d_id"); // for search with category in header
		 	$this->deals_details = $this->home->get_search_deals_list($search,$category,$cat_type,$maincatid);
		 	if($this->deals_details||$this->products_details||$this->auction_details) {
		 	} else {
		 	        $this->template->content = new View("themes/".THEME_NAME."/subscribe");
		        }	
		}
		$this->template->title = $this->Lang["WEL"]." ".SITENAME;
	}
		
	public function home1()
	{ 
	$this->template->content = new View("themes/".THEME_NAME."/home1");
	$this->template->title = $this->Lang["WEL"]." ".SITENAME;
	}
	/** CMS **/

	public function cms($url = "")
	{ 
		$this->cms = $this->home->get_cms_data($url); 
		if(count($this->cms) == 0){
			url::redirect(PATH);
		}
		$this->is_cms =1;
		$this->template->title = $this->cms->current()->cms_title." | ".SITENAME; 
		$this->template->content = new View("themes/".THEME_NAME."/cms");
	}

	/** CONTACT US **/

	public function contact_us()
	{
	        if($_POST){
		        $this->userPost = $this->input->post();
		        $status = $this->home->contact_us_details(arr::to_object($this->userPost));
		        if($status == 1){
			        common::message(1, $this->Lang["THANK_CT"]);
			        url::redirect(PATH);
		        }
	        }
	        $this->isactive = "contact";
	        $this->template->title = $this->Lang["CONTACT_US"]." | ".SITENAME;
	        $this->template->content=new View("themes/".THEME_NAME."/contact_us");
	}

	public function show_category()
	{	
		$this->type =1;
		if(isset($this->is_home)) $this->type =1;
		else if(isset($this->is_deals)) $this->type = 2;
		else if(isset($this->is_product)) $this->type = 3;
		else if(isset($this->is_auction)) $this->type = 4;
		if($id = $this->input->get('cate_id')){
			$type = ($this->input->get('t'));
			$id = ($this->input->get('cate_id'));
			if($type== 1){ // for main category to sub category list
				$this->view_type = 1;
				$this->categeory_list = $this->home->get_subcategory_list($id);
				echo  new View("themes/".THEME_NAME."/sub_category_list");
			}
			else if($type== 2){  // for sub category to 2nd level category list
				$this->view_type = 2;
				$this->categeory_list = $this->home->get_subcategory_list($id,2);
				echo  new View("themes/".THEME_NAME."/sub_category_list");
			}
			else if($type== 3){ // for 2nd category to 3rd level category list
				$this->view_type = 3;
				$this->categeory_list = $this->home->get_subcategory_list($id,3);
				echo  new View("themes/".THEME_NAME."/sub_category_list");
			}
		exit;
		}
	}

	/** NEAR ME MAP **/

	public function near_map()
        {  
		if(!$this->map_setting){
		        url::redirect(PATH);
		}
		$type=base64_decode($this->input->get('t'));
		if($type=='2'){
			$this->deals_list = $this->home->get_products_list_map();
		}  else if($type=='3'){
			$this->all_payment_list = $this->home->payment_list1();
			$this->deals_list = $this->home->get_auction_list_map();
		}  else  {
			$this->deals_list = $this->home->get_deals_list_map();
		}
		$this->store_lists = $this->home->get_store_lists();
		$this->type=base64_decode($this->input->get('t'));   
		$this->is_map = 1;
		$this->template->title = $this->Lang["NEAR_MAP"]." | ".SITENAME;
		if($this->input->get('page')== 1){
		if(LANGUAGE=="french"){
			$style="french_style.css";
                        $style1="fr_multi_style.css";
		}
		else if(LANGUAGE=="spanish"){
			$style = "spanish_style.css";
                        $style1="sp_multi_style.css";
		}
		else {
			$style = "style.css";
                        $style1="multi_style.css";
		}
			$re ='<link rel="stylesheet" type="text/css" href="'.PATH.'themes/'.THEME_NAME.'/css/'.$style.'" media="all"><link rel="stylesheet" type="text/css" href="'.PATH.'themes/'.THEME_NAME.'/css/'.$style1.'" media="all"><script type="text/javascript" src="'.PATH.'js/jquery.js"></script><script type="text/javascript" src="'.PATH.'js/timer/kk_countdown_1_2_jquery_min.js"></script>';
			$re .= new View("themes/".THEME_NAME."/deals/near_me_map");
			echo $re;
			exit;
		}else{
			$this->template->content = new View("themes/".THEME_NAME."/deals/near_me_map");
		}
        }
        
	/** SHOW DEALS,PRODUCTS,AUCTIONS POPUP **/

        public function show_deals_popup()
        {
			$store_id = $this->input->get('store_id');
			$type = $this->input->get('type');
			$val = "";
			  if($type==1){
				/** DEALS**/
					$this->deals_list = $this->home->get_deals_list_map();
					foreach($this->deals_list as $deal){
						if (($deal->maximum_deals_limit == $deal->purchase_count) || ($deal->maximum_deals_limit < $deal->purchase_count) || ($deal->enddate < time())) { } else { 
							if($deal->shop_id == $store_id){
								  $imgpath = "images/deals/1000_800/".$deal->deal_key."_1.png"; 
								  if(!file_exists(DOCROOT.$imgpath)){
									 $imgpath = "themes/".THEME_NAME."/images/noimage.png";
								   }
								   $category_name=$deal->category_name;	
								  $imgpath = PATH.$imgpath;
								 $dealUrl = PATH.$deal->store_url_title."/deals/".$deal->deal_key."/".$deal->url_title.".html";
								$val.='<div class="pro_listing_map"><div class="det_img1_1"><a href="'.$dealUrl.'" title="'.$this->Lang["DEAL_IMG"].'"><img alt="'.$this->Lang["DEAL_IMG"].'" src="'.$imgpath.'"width="100px;" height="128"/></a></div>
								  <div class="deal_list_detail_map"><h2>'.substr(ucfirst($deal->deal_title),0,25).'</h2><h3><a href="'.$dealUrl.'" >'.substr(ucfirst(strip_tags($deal->deal_description)),0,25).'</a></h3>
								 <p><span class="usd1">'.CURRENCY_SYMBOL.$deal->deal_price.'</span></p> <p><span class="usd3">'.CURRENCY_SYMBOL.$deal->deal_value.'</span></p><div class="view_deals_map"><a class="buy_it" href="'.$dealUrl.'" title="'.$this->Lang["VIEW_DETAILS"].'">'.$this->Lang["VIEW_DETAILS"].'</a>
								 </div></div></div>';
							}
						}
					}
					echo $val;exit;  
			 /** DEALS END HERE**/	

			}else if($type==2){

			/**PRODUCTS**/

			 $this->deals_list = $this->home->get_products_list_map();
					foreach($this->deals_list as $deal){
						if($deal->shop_id == $store_id){
							  $imgpath = "images/products/1000_800/".$deal->deal_key."_1.png"; 
							  if(!file_exists(DOCROOT.$imgpath)){
								 $imgpath = "themes/".THEME_NAME."/images/noimage.png";
							   }
							   $category_name=$deal->category_name;		
							  $imgpath = PATH.$imgpath;
							 $dealUrl = PATH.$deal->store_url_title."/product/".$deal->deal_key."/".$deal->url_title.".html";
							 $val.='<div class="pro_listing_map"><div class="det_img1_1"><a href="'.$dealUrl.'" title=""><img alt="product img" src="'.$imgpath.'"width="100px;" height="128"/></a></div>
							  <div class="deal_list_detail_map"><h2>'.substr(ucfirst($deal->deal_title),0,25).'</h2><h3><a href="'.$dealUrl.'" >'.substr(ucfirst(strip_tags($deal->deal_description)),0,25).'</a></h3>
							 <p> <span class="usd1">'.CURRENCY_SYMBOL.$deal->deal_price.'</span></p><p> <span class="usd3">'.CURRENCY_SYMBOL.$deal->deal_value.'</span></p><div class="view_deals_map"><a class="buy_it" href="'.$dealUrl.'" title="'.$this->Lang["VIEW_DETAILS"].'">'.$this->Lang["VIEW_DETAILS"].'</a>
							 </div></div></div>';

						}   
					}
					echo $val;exit;  

			   /** PRODUCTS END HERE**/
			}
			else{
			   /*AUCTIONS**/ 
				
				$this->deals_list = $this->home->get_auction_list_map();
				$this->all_payment_list = $this->home->payment_list();
					foreach($this->deals_list as $deal){

						if($deal->shop_id == $store_id){
							  $imgpath = "images/auction/1000_800/".$deal->deal_key."_1.png"; 
							  if(!file_exists(DOCROOT.$imgpath)){
								 $imgpath = "themes/".THEME_NAME."/images/noimage.png";
							   }	
							   $category_url="images/category/icon/".$deal->category_url.".png"; 
							   if(!file_exists(DOCROOT.$category_url)){
								 $category_url = "images/cate_icon.png";
							   }	
							  $imgpath = PATH.$imgpath;
							 $dealUrl = PATH.$deal->store_url_title."/auction/".$deal->deal_key."/".$deal->url_title.".html";
								 $q=0; 

			                   foreach($this->all_payment_list as $payment){ 
				                   
					                   if($payment->auction_id==$deal->deal_id){ 
						                   	$firstname = $payment->firstname;
							                $transaction_time = $payment->transaction_date;
							                $q=1;
						                 }     
				                }
					   if($q==1){
							$last =$this->Lang["LAST_BID"];
							$name =ucfirst($firstname);
							$time=$this->Lang["BID_TIME"];
							$date=date("d-m-Y",$transaction_time);
							$tim=$deal->enddate;
						  }
					   if($q==0){ 
						   $last = $this->Lang["LAST_BID"];
						   $name=$this->Lang["NOT_YET_BID"];
				   
						   $time=$this->Lang["CLOSE_T"];
						   $date=date("d-m-Y",$deal->enddate);
						   $tim=$deal->enddate;
						}
					if($type!=3){ $count=$deal->purchase_count; }  if($type==3){  $count=$deal->bid_count;  }
                                        $val .= '<div class="auction_list_map1"><div class="action_img5"><div class="act_img_mid3">
                                        <a href="'.$dealUrl.'" title=""><img src="'.$imgpath.'" width="100px;" height="114" alt="auction_image"/></a>
                                        </div></div><div class="action_rgt_map5"><h3><a href="'.$dealUrl.'" title="">'.substr(ucfirst($deal->deal_title),0,25).'..'.'</a></h3><h3><a href="'.$dealUrl.'" title="">'.substr(ucfirst(strip_tags($deal->deal_description)),0,25).'..'.'</a></h3>
                                        <div class="bid_cont"><div class="bid_value_map"><label>'.$this->Lang["LAST_BID"].'  </label><b>:</b><p>'.$name.'</p>
                                        </div></div><div class="bid_cont"><div class="bid_value_map2"><label>'.$time.'</label><b>:</b><p>'.$date.' <span></span></p>
                                        </div></div><div class="bid_cont"><div class="bid_value_map"><label>'.$this->Lang["TIME_LEFT"].' </label><b>:</b><p> <span time="'.$tim.'"class="kkcount-down" ></span></p>
                                        </div></div><div class="view_deals_map">
                                        <a class="buy_it" href="'.$dealUrl.'" title="'.$this->Lang["VIEW_DETAILS"].'">'.$this->Lang["VIEW_DETAILS"].'</a></div></div></div> ';

						}   
					}
					echo $val;exit;
			 /** AUCTIONS END HERE **/
			}
        }

      public function ajax_load_map()
      {
		$type=base64_decode($this->input->get('t'));
		if($type=='2'){
				$this->deals_list = $this->home->get_products_list_map();
		}  else if($type=='3'){
			$this->all_payment_list = $this->home->payment_list1();
			$this->deals_list = $this->home->get_auction_list_map();
		}  else  {
			$this->deals_list = $this->home->get_deals_list_map();
		}
		$this->store_lists = $this->home->get_store_lists();
		$this->type=base64_decode($this->input->get('t'));   
		$this->is_map = 1;
		$this->template->title = $this->Lang["NEAR_MAP"]." | ".SITENAME;
		 echo new View('themes/'.THEME_NAME.'/deals/map');
			 exit;
	}

	/** CHECK VALID PHONE OR NOT **/

	public function validphone($phone = "")
	{
		if(valid::phone($phone,array(7,10,11,12,13)) == TRUE){
			return 1;
		}
		return 0;
	}

        /** ABOUT US **/

        public function about_us()
        {
                $this->about_us = $this->home->abou_us_page();
                $this->template->title = $this->Lang["ABT"]." | ".SITENAME;
		$this->isactive = "about";
                $this->template->content = new View("themes/".THEME_NAME."/about_us");
        }

	/** FAQ **/
	public function faq($page="")
	{
		if(!$this->faq_setting){
		        url::redirect(PATH);
		}
		$this->faq_count=$this->home->get_count();
		$this->pagination = new Pagination(array(
				'base_url'       => 'faq.html/page/'.$page,
				'uri_segment'    => 3,
				'total_items'    => $this->faq_count,
				'items_per_page' => 10, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->faq = $this->home->get_all_faq($this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->template->title = "FAQ | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/faq");
	}

	/** NEWS LETTER UNSUBSCRIBE  **/

	public function unsubscribe($id = "", $email_encript = "")
	{
		if($id){
			$this->status = $this->home->get_unsubscribed_user($id);
			foreach($this->status as $u){
				$email = md5($u->user_id."-".$u->email);
				if($id == $u->user_id && $email_encript == $email){
				$this->status = $this->home->unsubscriber_update($id);
					if($this->status == 1){
					$this->template->title = $this->Lang["UN_DAILY"]." | ".SITENAME;
					$this->template->content = new View("newsletter/unsubscribe");
					}
				}
				else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				url::redirect(PATH);
				}
			}
		}
	}
	
	/** THEME CHANGE **/

	public function theme_change($theme = "")
	{
		$Directory  = opendir(DOCROOT."themes"); $DL = array();
		while (false !== ($dirname = readdir($Directory))) {
			if(strlen($dirname) > 2){
			$DL[] = $dirname;
			}
		}
		if(in_array("$theme", $DL)){
		$theme_change = $this->home->change_theme_colour($theme);
			if($theme_change == '1'){
			url::redirect(PATH);
			}
		}
		else{
		$this->template->title = $this->Lang["PAGE_NOT"]." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/404_page");
		}
	}
	

	/** CHANGE CITY **/

	public function changecity($city_id = "", $city_url = "")
	{
		foreach($this->all_city_list as $cityList){
			if($cityList->city_id == $city_id && $cityList->city_url == $city_url){
				$this->session->set("CityID",$city_id);
			}
		}
		url::redirect(PATH);
	}
	
	/** CONFIRM EMAIL **/

	public function subscrib_confirm($mail="",$city="")
	{
		if($mail && $city){
			$mails = urldecode($mail);
			$cityid = explode("_",$city);
			$this->confirm = $this->home->confirm_newsletter($mails);
			$CatTag = array(0);
			$category = $this->home->all_category_list();
			foreach($category as $d){$CatTag[] = $d->category_id; }
			$this->session->set("CategoryTag", $CatTag);
			$this->session->set("CityID",$cityid[1]);
			url::redirect(PATH);
		}
		url::redirect(PATH);
	}

	/** USER REFERRAL **/
	
	public function referral_signup($referral = "")
	{
		$this->session->set("User_Referral_ID", $referral);
		url::redirect(PATH);
	}
	
	/** GENERATE RSS FEEDS **/

	public function rss($city_id = "", $city_url = "")
	{
		$Iscity = 0;
		foreach($this->all_city_list as $CL){
			if($city_id == $CL->city_id && $city_url == $CL->city_url ){
				$Iscity = 1;
				$this->city_name = $CL->city_name;
			}
		}
		if($Iscity == 1){ 
			$this->rss_deals_list = $this->home->get_rss_deals_lists($city_id);
			$this->rss_products_list = $this->home->get_rss_products_lists($city_id);
			$this->rss_auction_list = $this->home->get_rss_auction_lists($city_id);
			echo  new View("rss_feed");
			exit;
		}
		else{
			$this->template->title = $this->Lang["PAGE_NOT"]." | ".SITENAME;
			$this->template->content = new View("themes/".THEME_NAME."/404_page");
		}
	}
	
	public function rss_all()
	{
			$this->rss_deals_list = $this->home->get_rss_deals_lists(-1);
			$this->rss_products_list = $this->home->get_rss_products_lists(-1);
			$this->rss_auction_list = $this->home->get_rss_auction_lists(-1);
			echo  new View("rss_feed");
			exit;
		
	}

	/* AUCTION WINNER */
	public function auction_winner($deal_id = "")
	{           
	    $this->all_auction_close_list = $this->home->get_today_auction_list(); 
		if(count($this->all_auction_close_list)>0){
		foreach($this->all_auction_close_list as $auction){
		       $deal_id = $auction->deal_id;
		       $this->transaction_details = $this->home->get_auction_transaction_bid_amount_data($deal_id);
				if(count($this->transaction_details)){
		        	foreach($this->transaction_details as $tran){
						$fromEmail = CONTACT_EMAIL;
						$to = $tran->email;
						$subject = $this->Lang['WON_T_AUC'];

						  $message = new View("themes/".THEME_NAME."/auction/auction_payment_mail1");

						$mail_alert = $this->home->update_mail_alert($tran->bid_id,$tran->deal_key,$tran->user_id);
						
						if(EMAIL_TYPE==2) {        
							email::smtp($fromEmail,$to,$subject,$message); 
						}else {
							email::sendgrid($fromEmail,$to,$subject,$message);

						}   
					}				
				}
				else{
						$status = $this->home->update_auction_time($auction->deal_id);
				}		
			}
		} else { 
		}
	}
	
	public function store_list_details($page = "" )
	{		
		$this->store_details_count = $this->home->get_user_bought($page);
		url::redirect(PATH);
		
	}

	/* AUCTION ALERT */
	public function auction_alert()
	{
		$this_details = $this->home->get_auction_alert_details(1); 
		foreach($this_details as $alert) {
				$time_diff = time()-$alert->end_time;
				$days2 = AUCTION_ALERT_DAY*24*3600;  
				if($alert->mail_alert==1){   //alert mail for before reset the auction
					if($time_diff >= $days2){
							if(file_exists(DOCROOT.'images/auction/1000_800/'.$alert->deal_key.'_1'.'.png')) {
									$image = PATH.'images/auction/1000_800/'.$alert->deal_key.'_1'.'.png';
								} else {
									$image = PATH."themes/".THEME_NAME."/images/noimage_auctions_list.png";
								}
							$end_time = $alert->end_time+((AUCTION_ALERT_DAY+1)*24*60*60);
						  	$fromEmail = NOREPLY_EMAIL;
							$to = $alert->email;
							$subject = $this->Lang['FI_PAY_REMIN'];
							
							$alert_message = "<p style='color:red;'>".$this->Lang['FI_REQ_TIM_OUT'].",</p><p style='color:red;'>".$alert->firstname.",".$this->Lang['YOU_WON_AUC'].":</p><p><img border='0' src='$image' height='160px' width='160px'/></p><p>".$this->Lang['AUC_TIT']." : $alert->auction_title</p><p>".$this->Lang['BID_AMO'].": ".CURRENCY_SYMBOL.$alert->bid_amount."</p><p>".$this->Lang['AUC_CLOSE']." :".date('M d Y, h:i A', $alert->enddate)."</p><p>".$this->Lang['PAY_BEFORE']." : ".date('M d Y, h:i A', $end_time)."</p><p><a href='".PATH.'auction/buy_auction/'.base64_encode($alert->deal_id).'/'.base64_encode($alert->user_id).'/'.base64_encode($alert->bid_amount).'/'.base64_encode($alert->bid_id)."' style='decoration:none;'><input type='button' value='".$this->Lang['BUY_NOW2']."'></p></a>"; 
							
										
							$this->name = ucfirst($alert->firstname);
							$this->merchant_message = $alert_message;
							$alertmessage = new View("themes/".THEME_NAME."/merchant_signup_mail_template");
										
							if(EMAIL_TYPE==2) {
								email::smtp($fromEmail,$to,$subject,$alertmessage); 
							}else {
								email::sendgrid($fromEmail,$to,$subject,$alertmessage);

							}    
							
							$mail_alert = $this->home->update_second_mail_alert($alert->bid_id); 
						
					}
				
			} 
			
		}  
		$this_details = $this->home->get_auction_alert_details(2);
		foreach($this_details as $alert) {
			if($alert->mail_alert==2){   // First mail alert
				$time_diff = time()-$alert->end_time;
					$day_alert1 = AUCTION_ALERT_DAY + 1 ; 
				$days2 = $day_alert1*24*3600;  //alert mail for reset the auction 
					if($time_diff >= $days2){
						if(file_exists(DOCROOT.'images/auction/1000_800/'.$alert->deal_key.'_1'.'.png')) {
								$image = PATH.'images/auction/1000_800/'.$alert->deal_key.'_1'.'.png';
							} else {
								$image = PATH."themes/".THEME_NAME."/images/noimage_deals_details.png";
							} 
						$end_time = $alert->end_time+(AUCTION_ALERT_DAY*24*60*60);
						$fromEmail = NOREPLY_EMAIL;
						$to = $alert->email;
						$subject = $this->Lang['OR_B_CANCEL'];
						$close_message = "<p style='color:red;'>".$this->Lang['CAN_O_NOTICE']."<p/><p style='color:red;'>Sorry, ".$alert->firstname."!</p><p style='color:red;'>".$this->Lang['ORDR_CLED']."</p><p><img border='0' src='$image' height='160px' width='160px'/></p><p>".$this->Lang['AUC_TIT']." : $alert->auction_title</p>"; 
						
						$this->name = ucfirst($alert->firstname);
						$this->merchant_message = $close_message;
						$closemessage = new View("themes/".THEME_NAME."/merchant_signup_mail_template");
						
						if(EMAIL_TYPE==2) {        
							email::smtp($fromEmail,$to,$subject,$closemessage); 
						}else {
							email::sendgrid($fromEmail,$to,$subject,$closemessage);

						}
						
						$mail_alert = $this->home->update_third_mail_alert($alert->bid_id,$alert->auction_id); 
					} 
			} 
		} 
	}

	/* AUCTION CLOSE MAIL */
	public function auction_close_mail()
	{
		$this_details = $this->home->get_auction_alert_details(2);
		foreach($this_details as $alert) {
			if($alert->mail_alert==2){   // First mail alert
				$time_diff = time()-$alert->end_time;
					$day_alert1 = AUCTION_ALERT_DAY + 1 ; 
			                $days2 = $day_alert1*24*3600;  //alert mail for reset the auction 
				
						if(file_exists(DOCROOT.'images/auction/1000_800/'.$alert->deal_key.'_1'.'.png')) {
								$image = PATH.'images/auction/1000_800/'.$alert->deal_key.'_1'.'.png';
							} else {
								$image = PATH."themes/".THEME_NAME."/images/noimage_deals_details.png";
							} 
						$end_time = $alert->end_time+(AUCTION_ALERT_DAY*24*60*60);
						$fromEmail = NOREPLY_EMAIL;
						$to = $alert->email;
						$subject = $this->Lang['OR_B_CANCEL'];
						$close_message = "<p style='color:red;'>".$this->Lang['CAN_O_NOTICE']."<p/><p style='color:red;'>Sorry, ".$alert->firstname."!</p><p style='color:red;'>".$this->Lang['ORDR_CLED']."</p><p><img border='0' src='$image' height='160px' width='160px'/></p><p>".$this->Lang['AUC_TIT']." : $alert->auction_title</p>"; 
						
						$this->name = ucfirst($alert->firstname);
						$this->merchant_message = $close_message;
						$closemessage = new View("themes/".THEME_NAME."/merchant_signup_mail_template");
						
						if(EMAIL_TYPE==2) {        
							email::smtp($fromEmail,$to,$subject,$closemessage); 
						}else {
							email::sendgrid($fromEmail,$to,$subject,$closemessage);

						}
						
						$mail_alert = $this->home->update_third_mail_alert($alert->bid_id,$alert->auction_id); 
				
			} 
		} 
	} 
	

	/* AUCTION MAIL */
	public function auction_mail()
	{
		$this_details = $this->home->get_auction_alert_details(1); 
		foreach($this_details as $alert) {
				$time_diff = time()-$alert->end_time;
				$days2 = AUCTION_ALERT_DAY*24*3600;  
				if($alert->mail_alert==1){ 
							if(file_exists(DOCROOT.'images/auction/1000_800/'.$alert->deal_key.'_1'.'.png')) {
									$image = PATH.'images/auction/1000_800/'.$alert->deal_key.'_1'.'.png';
								} else {
									$image = PATH."themes/".THEME_NAME."/images/noimage_auctions_list.png";
								}
							$end_time = $alert->end_time+((AUCTION_ALERT_DAY+1)*24*60*60);
						  	$fromEmail = NOREPLY_EMAIL;
							$to = $alert->email;
							$subject = $this->Lang['FI_PAY_REMIN'];
							
							$alert_message = "<p style='color:red;'>".$this->Lang['FI_REQ_TIM_OUT'].",</p><p style='color:red;'>".$alert->firstname.",".$this->Lang['YOU_WON_AUC'].":</p><p><img border='0' src='$image' height='160px' width='160px'/></p><p>".$this->Lang['AUC_TIT']." : $alert->auction_title</p><p>".$this->Lang['BID_AMO'].": ".CURRENCY_SYMBOL.$alert->bid_amount."</p><p>".$this->Lang['AUC_CLOSE']." :".date('M d Y, h:i A', $alert->enddate)."</p><p>".$this->Lang['PAY_BEFORE']." : ".date('M d Y, h:i A', $end_time)."</p><p><a href='".PATH.'auction/buy_auction/'.base64_encode($alert->deal_id).'/'.base64_encode($alert->user_id).'/'.base64_encode($alert->bid_amount).'/'.base64_encode($alert->bid_id)."' style='decoration:none;'><input type='button' value='".$this->Lang['BUY_NOW2']."'></p></a>"; 
							
										
							$this->name = ucfirst($alert->firstname);
							$this->merchant_message = $alert_message;
							$alertmessage = new View("themes/".THEME_NAME."/merchant_signup_mail_template");
										
							if(EMAIL_TYPE==2) {
								email::smtp($fromEmail,$to,$subject,$alertmessage); 
							}else {
								email::sendgrid($fromEmail,$to,$subject,$alertmessage);

							}    
							
							$mail_alert = $this->home->update_second_mail_alert($alert->bid_id); 
						
					
				
			} 
			
		} 
	} 

   	/* POP UP */
	 public function subscriber_pop(){ 
		$this->session->set('skip_session',1);
		url::redirect(PATH);
	}
	
	 public function set_session(){
	 	$this->close_button = $this->home->get_close_city_list(); 
	 	foreach($this->close_button as $CB){
	 		$city_id = $CB->city_id;
	 	}
		$this->session->set("Skip",$city_id);
		$this->session->set("CityID",$city_id); 
		url::redirect(PATH);
	
	}
	/*  SUBSCRIPTION */
	public function subscriber()
    	{
		
           	$this->session->set("Skip",1); 
			$this->session->set('Club', 0);
	        url::redirect(PATH);
  	 }
  	 
  	 /** DEAL COMMENTS **/
	public function comments()
	{
			$action_type = $this->input->get("action_type"); 
			$comments = $this->input->get("comment"); 
			$deal_id = $this->input->get("deal_id");
			$type = $this->input->get("type");
			$discussion_id = $this->input->get("dis_id");
			if($action_type=="update") {
				$status = $this->home->update_comments($comments,$deal_id,$type,$discussion_id);
			} else {
				$status = $this->home->add_comments($comments,$deal_id,$type);
			}
			$this->comments_deatils = $this->home->get_comments_data($deal_id,$type);
			$this->like_details = $this->home->get_like_data($deal_id,$type);
			$this->unlike_details = $this->home->get_unlike_data($deal_id,$type);
			echo new View("themes/".THEME_NAME."/comment");
			exit;
	}
	    
	/** DEAL LIKE **/
	 public function like1()
        {
                $deal_id = $this->input->get('deal_id');
                $user_id = $this->input->get('user_id');
                $dis_id = $this->input->get('dis_id');	
                $type = $this->input->get('type');			
                $status = $this->home->like1($deal_id,$user_id,$dis_id,$type);
                $get_data = $this->home->get_like_details($dis_id,$type);
                $get_data1 = $this->home->get_unlike_details($dis_id,$type);
                $data = ' <div class="lode_over"><a class="like" style="cursor:pointer;" title="like">('.$get_data.')</a></div>';
                echo $data .= '<div class="lode_over2"><a class="dislike" title="unlike" style="cursor:pointer;" onclick="unlike1('.'&#39;'.$deal_id.'&#39;'.',&#39;'.$user_id.'&#39;'.',&#39;'.$dis_id.'&#39;'.',&#39;'.$type.'&#39;'.');">('.$get_data1.')</a></div>';
                exit;
        }
        /**DEAL UNLIKE **/
        public function unlike1()
        {
			
                $deal_id = $this->input->get('deal_id');
                $user_id = $this->input->get('user_id');
                $dis_id = $this->input->get('dis_id');	
                $type = $this->input->get('type');			
                $status = $this->home->unlike1($deal_id,$user_id,$dis_id,$type);
                $get_data = $this->home->get_unlike_details($dis_id,$type);
                $get_data1 = $this->home->get_like_details($dis_id,$type);
                $data = '<div class="lode_over"><a class="like" title="unlike" style="cursor:pointer;" onclick="like1('.'&#39;'.$deal_id.'&#39;'.',&#39;'.$user_id.'&#39;'.',&#39;'.$dis_id.'&#39;'.',&#39;'.$type.'&#39;'.');">('.$get_data1.')</a></div>';
                echo $data .= '<div class="lode_over2"><a class="dislike" style="cursor:pointer;" title="unlike">('.$get_data.')</a></div>';
                exit;
        }	
        
        /** DELETE USERCOMMENTS **/
	
	public function delete_users_comments()
	{ 
		
		$discussion_id = $this->input->get('dis_id');
		$deal_id = $this->input->get("deal_id");
		$type = $this->input->get("type");
		$status = $this->home->deleteusercomments($discussion_id);
		if($status == 1){			
			$this->comments_deatils = $this->home->get_comments_data($deal_id,$type);
			$this->like_details = $this->home->get_like_data($deal_id,$type);
			$this->unlike_details = $this->home->get_unlike_data($deal_id,$type);
			echo new View("themes/".THEME_NAME."/comment");
			exit;
		}
	}
	/* SHOP BY CATEGORY */
	public function show_all_category()
	{
			$this->category_list = $this->home->get_category_list($this->deal_setting,$this->product_setting,$this->auction_setting);
			$this->categeory_list = $this->home->get_sub_category_list();
			$this->template->title = $this->Lang['SHOP_AL']." | ".SITENAME;
			$this->template->content = new View("themes/".THEME_NAME."/shop_by_category");
		
	}
	
	public function set_session_theme($theme)
	{
		$this->session->set("theme", $theme);
		url::redirect(PATH);
	}
	
	public function ajax_search($search = "",$type = "",$store_id = "")
	{ 
		$this->type = $type;
		$this->search = $search;
		$this->search_category = $this->home->get_search_all_category_list($search);

		if($this->type == 1 || $this->type == 2 || $this->type == 3 || $this->type == 4 || $this->type == 5 || $this->type == 0) { 
			$this->deals_details = $this->home->get_search_deals_list($search,"","","",$store_id);
			$this->products_details = $this->home->get_search_products_list($search,"","","",$store_id);
			$this->auction_details = $this->home->get_search_auction_list($search,"","","",$store_id);
		}
		echo new View("themes/".THEME_NAME."/ajax_search_list");
		exit;
	}

	public function setlanguage()
	{
		$this->auto_render= false;
		$postval= $this->input->post('language');
		$set_lang = $this->home->get_lang_change($postval); 	
	}
	public function merchant_cms($store_url_title="",$merchantid = "",$title="")
	{
	   
		if($title=="warranty") {
			$this->type =1;
		} else if($title=="return_policy") {
				$this->type =2;
		} else if($title=="shipping") {
			$this->type =3;	
		}
		$this->storeurl = $store_url_title;
		$this->get_theme_name = common::get_theme($store_url_title);  
		if(count($this->get_theme_name)>0) {
			$this->sector = $this->get_theme_name->current()->sector_name;
		} else {
			$this->sector ="";
		}
		
		$this->merchant_cms = $this->home->get_merchant_cms_data($store_url_title,$title); 
		$this->about_us_footer = $this->home->get_about_us_footer($store_url_title);
		$this->stores = new Stores_Model();
		$this->admin_details = $this->stores->get_admin_details();
		if(count($this->merchant_cms) == 0){
			url::redirect(PATH);
		}
		
		
		if(count($this->merchant_cms)>0)
			$this->storeid = $this->merchant_cms[0]->store_id;
		$this->theme_name = $this->home->get_theme_name($store_url_title);
		if(count($this->theme_name)>0){
			$this->theme_name = strtolower($this->theme_name[0]->sector_name);
		}else{
			$this->theme_name = "default";
		}
		
		if($this->theme_name) { 
			$sector =$this->theme_name; 
			//$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/french_style.css',PATH.'themes/'.THEME_NAME.'/css/fr_multi_style.css')); 
			$this->template->style = html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/'.$sector.'/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
			//$this->template->content = new View("themes/".THEME_NAME."/store_detail");	
			$this->template->content = new View("themes/".THEME_NAME."/merchant_cms");
		
		} else {
			
			$this->template->content = new View("themes/".THEME_NAME."/merchant_cms");
		}
		$this->template->title = $title." | ".SITENAME;
		
	}

	public function set_session_lang($lang=''){
		if($lang!=''){
			if($lang=='Hausa')
				$_SESSION["select_lang"]=2;
			else if($lang=='Igbo')
				$_SESSION["select_lang"]=3;
			else if($lang=='Yoruba')
				$_SESSION["select_lang"]=4;
			else
				$_SESSION["select_lang"]=1;
		}else{
			$_SESSION["select_lang"]=1;
		}
		print_r($_SESSION);exit;
	}
	
}
