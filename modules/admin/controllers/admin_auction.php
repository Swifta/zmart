<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_auction_Controller extends website_Controller 
{
	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		
		$this->auction = new Admin_auction_Model();	
		$this->auction_act = "1"; 
	}

	/** ADD NEW DEALS **/
	
	public function add_auction()
	{
		if(!ADMIN_PRIVILEGES_AUCTIONS_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	    $this->add_auction="1";
		$adminid=$this->session->get('user_id');            
		$this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
			if($_POST){
				$this->userPost = $this->input->post();
				$post = Validation::factory(array_merge($_POST,$_FILES))
								->pre_filter('trim', 'title')
								->add_rules('title', 'required')
								->add_rules('description', 'required',array($this,'check_required'))
								->add_rules('category', 'required')
								->add_rules('sub_category', 'required')
								->add_rules('sec_category', 'required')
								->add_rules('bid_increment', 'required','chars[0-9.]',array($this,'check_price_val_lmi'),array($this,'check_bid_increment_val'))
								//->add_rules('quantity', 'required','chars[0-9]')
								->add_rules('shipping_fee', 'required','chars[0-9.]')
								->add_rules('shipping_info', 'required')  
								->add_rules('product_price', 'required','chars[0-9.]',array($this,'check_price_val_lmi')) 
								->add_rules('deal_value', 'required','chars[0-9.]',array($this,'check_deal_value_lmi'),array($this,'check_deal_price'))
								->add_rules('start_date', 'required')
								->add_rules('end_date', 'required', array($this, 'check_end_date'))
								->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
								->add_rules('stores','required')
								->add_rules('users', 'required');

				 if($post->validate()){

					$deal_key = text::random($type = 'alnum', $length = 8);	
					$status = $this->auction->add_auction_products(arr::to_object($this->userPost),$deal_key);
					if($status > 0 && $deal_key){
					
							if($_FILES['image']['name']['0'] != "" )
							{
									$i=1;
										foreach(arr::rotate($_FILES['image']) as $files){
											if($files){			
												$filename = upload::save($files);
													if($filename!=''){ 
														
														$IMG_NAME = $deal_key."_".$i.'.png';
														
											                        common::image($filename, 620,752, DOCROOT.'images/auction/1000_800/'.$IMG_NAME);
														unlink($filename);
													}
										}
										 $i++;
								   }
							}
							/**AUCTION AUTOPOST FACEBOOK WALL**/

							if($this->input->post('autopost')==1){
	
							    $auctionturl=url::title($this->input->post('title'));
							    $auctionURL = PATH."auction/".$deal_key.'/'.$auctionturl.".html";
							    $message = "A new auction product published onthe site"." ".$this->input->post('title')." ".$auctionURL." limited offer hurry up!";
							    $fb_access_token = $this->session->get("fb_access_token");
							    $fb_user_id = $this->session->get("fb_user_id");
							    $post_arg = array("access_token" => $fb_access_token, "message" => $message, "id" => $fb_user_id, "method" => "post");
							     common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg);
								
							}
						    /**AUCTION AUTOPOST FACEBOOK WALL END HERE**/

						common::message(1, $this->Lang["AUCTION_ADD_SUC"]);
						url::redirect(PATH."admin/manage-auction.html");
					}
					$this->form_error["city"] = $this->Lang["AUCTION_EXIST"];
				}
				else{	
					$this->form_error = error::_error($post->errors());				
				}
			}
		$this->category_lst = $this->auction->get_gategory_list();
		$this->sub_category_list = $this->auction->get_sub_category_list();
		$this->sec_category_list = $this->auction->get_sec_category_list();
		$this->third_category_list = $this->auction->get_third_category_list();
		$this->get_marchant_list = $this->auction->getmarchantlist();
		$this->shop_list = $this->auction->get_shop_list();
	    $this->template->title = $this->Lang['ADD_ACT_PRO'];
		$this->template->content = new View("admin_auction/add_auction");
	}

	/** MANAGE DEALS **/
	
	public function manage_auction($type= "", $page = "")
	{
		if(!ADMIN_PRIVILEGES_AUCTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->page = $page ==""?1:$page; // for export per page
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $serch=$this->input->get("id");
                $this->today = $this->input->get("today");
		$this->startdate  = $this->input->get("startdate");
		$this->enddate  = $this->input->get("enddate");	
		$this->date_range = isset($_GET['date_range'])?1:0;
		$this->more_action = "";
			if($type == 1){
				$this->archive_auction="1";
				$this->template->title = $this->Lang['ARCH_ACT_PRO'];
				$this->url = "admin/archive-auction.html";
				$this->sort_url= PATH.'admin/archive-auction.html?';
			}
			else{
				$this->manage_auction="1";
				$this->template->title = $this->Lang['MAG_ACT_PRO'];
				$this->url = "admin/manage-auction.html";
				$this->sort_url= PATH.'admin/manage-auction.html?';
			}
			
			$this->count_deal_all_record = $this->auction->get_all_deals_count($type, $this->input->get("city"), $this->input->get('name'),$this->type,$this->sort,$this->today,$this->startdate,$this->enddate);
			$this->city_list = $this->auction->get_city_lists();
			$this->search_key = arr::to_object($this->input->get());		
			$this->pagination = new Pagination(array(
					'base_url'       => $this->url.'/page/'.$page."/",
					'uri_segment'    => 4,
					'total_items'    => $this->count_deal_all_record,
					'items_per_page' => 25, 
					'style'          => 'digg',
					'auto_hide' => TRUE
			));

			$this->all_deal_list = $this->auction->get_all_deals_list($type, $this->pagination->sql_offset, $this->pagination->items_per_page ,$this->input->get("city"), $this->input->get('name'),$this->type,$this->sort,0,$this->today,$this->startdate,$this->enddate);
				if($serch == 'all'){  // for export all
					$this->all_deal_list = $this->auction->get_all_deals_list($type, $this->pagination->sql_offset, $this->pagination->items_per_page ,$this->input->get("city"), $this->input->get('name'),$this->type,$this->sort,1,$this->today,$this->startdate,$this->enddate);
				}
				if($serch){
					$out = '"S.No","Title","Category","Auction Price","Start Date","End Date","Bid Count","Bid Increment","Merchant Name","Shop Name","Country","City","Image"'."\r\n";

					$i=0; 
					$first_item = $this->pagination->current_first_item;
						foreach($this->all_deal_list as $d){			
								if(file_exists(DOCROOT.'images/auction/1000_800/'.$d->deal_key.'_1.png')){
									$deal_image =PATH.'images/auction/1000_800/'.$d->deal_key.'_1.png';
								}else
								{
									$deal_image =PATH.'images/no-images.png';
								}
							$out .= $i + $first_item.',"'.$d->deal_title.'","'.$d->category_name.'","'.(CURRENCY_SYMBOL.$d->deal_value).'","'.date('m/d/Y H:i:s',$d->startdate).'","'.date('m/d/Y H:i:s',$d->enddate).'","'.$d->bid_count.'","'.$d->bid_increment.'","'.$d->firstname.'","'.$d->store_name.'","'.$d->country_name.'","'.$d->city_name.'","'.$deal_image.'"'."\r\n";
							$i++;
						}
						header('Content-Description: File Transfer');
						header('Content-Type: application/octet-stream'); 
						header('Content-Disposition: attachment; filename=Auctions.xls');
						header('Content-Transfer-Encoding: binary');
						header('Expires: 0');
						header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
						header('Pragma: public');
						echo "\xEF\xBB\xBF"; // UTF-8 BOM
						echo $out;
						exit;
				}
			
			$this->template->content = new View("admin_auction/manage_auction");
	}
	
	/** VIEW DEALS **/
	
	public function view_auction($deal_key= "", $deal_id = "")
	{
	     
	     if(!ADMIN_PRIVILEGES_AUCTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	      if($_POST){ 
	        $commission = $this->input->post('commission_status');
	        $deal_key = $this->input->post('commission_deal_key');
	        $deal_id = $this->input->post('commission_deal_id');        
	                if($commission != ""){
	                        $commission_deatils = $this->auction->change_commission_data($commission, $deal_id);
	                }
	                common::message(1, $this->Lang["COMMISSION_CHANGE_STATUS"]);
	                url::redirect(PATH."admin/view-auction/".$deal_key."/".$deal_id.".html");
	        }   
	    $this->manage_auction="1";
	    $this->auction_key=$deal_key;
	    $this->auction_id=$deal_id;
		$this->deal_deatils = $this->auction->get_deals_data($deal_key, $deal_id);
		$this->bidding_list =  $this->auction->get_bidding_list($deal_id);
		$this->transaction_auction_list = $this->auction->get_transaction_data($deal_id);
		if(count($this->deal_deatils) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			$lastsession = $this->session->get("lasturl");
		                if($lastsession){
		                url::redirect(PATH.$lastsession);
		                } else {
		                url::redirect(PATH."admin/manage-auction.html");
		                }
		}
		$serch=$this->input->get("id");
		if($serch){ 
			if($serch=='Search') { 
					$out = '"S.No","Auction Name","User Name","Starting Bid('.CURRENCY_SYMBOL.')","Bid Amount('.CURRENCY_SYMBOL.')","Bid Time"'."\r\n";
					$i=0; 
					$first_item = $i+1;
					foreach($this->bidding_list as $d)
					{
	 					$out .= $i + $first_item.',"'.$d->deal_title.'","'.$d->firstname.'","'.$d->deal_value.'","'.$d->bid_amount.'","'.date("d-M-Y h:i:s A", $d->bidding_time).'"'."\r\n";
						$i++;
					}
				}elseif($serch=='BID') { 
					$out = '"S.No","Customers","Auction Title","Bidding Price('.CURRENCY_SYMBOL.')","Shipping Fee('.CURRENCY_SYMBOL.')","Pay Amount('.CURRENCY_SYMBOL.')","Status","Transaction Date","Transaction Type"'."\r\n";
					$i=0; 
					$first_item = $i+1;
					foreach($this->transaction_auction_list as $d)
					{
						if($d->payment_status=="SuccessWithWarning"){ $status=$this->Lang["SUCCESS"]; }
						elseif($d->payment_status=="Completed"){ $status=$this->Lang["COMPLETED"]; } 
						elseif($d->payment_status=="Success"){ $status=$this->Lang["SUCCESS"]; }
						elseif($d->payment_status=="Pending"){ $status=$this->Lang["PENDING"]; }
						elseif($d->payment_status=="Failed"){ $status=$this->Lang["FAILED"]; }
						
						if($d->type=="1"){ $transaction_type=$this->Lang["PAYPAL_CREDIT"]; }
						elseif($d->type=="2"){ $transaction_type=$this->Lang["PAYPAL"]; }
						elseif($d->type=="3"){ $transaction_type=$this->Lang["REF_PAYMENT"]; }
						elseif($d->type=="4"){ $transaction_type="Authorize.net(".$d->transaction_type.")"; }
						elseif($d->type=="5"){ $transaction_type=$d->transaction_type; }
						elseif($d->type=="6"){ $transaction_type=$this->Lang["PAY_LATER"]; }
					
					
	 					$out .= $i + $first_item.',"'.$d->firstname.'","'.$d->deal_title.'","'.$d->bid_amount.'","'.$d->shipping_amount.'","'.$d->amount.'","'.$status.'","'.date('d-M-Y h:i:s',$d->transaction_date).'","'.$transaction_type.'"'."\r\n";
						$i++;
					}
					
				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream'); 
					header('Content-Disposition: attachment; filename=Auctions.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out; 
					exit;
			}
		$this->category_list = $this->auction->all_category_list();
		
		$this->commission_list = $this->auction->get_merchant_balance();
		$this->highest_bid =  $this->auction->get_highest_bid($deal_id);
		$this->template->title = $this->Lang['AUC_PRO_DETAILS'];
		$this->template->content = new View("admin_auction/view_auction");
	}
	
	/** EDIT DEALS **/
	
	public function edit_auction($deal_id = "", $deal_key = "")
	{
		if(!ADMIN_PRIVILEGES_AUCTIONS_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$deal_id = base64_decode($deal_id);
		$this->manage_auction="1";
		$this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js', PATH.'js/multiimage.js'));
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
	        if($_POST){
				$this->userPost = $this->input->post();
				$post = Validation::factory(array_merge($_POST,$_FILES))
								->pre_filter('trim', 'title')
								->add_rules('title', 'required')
								->add_rules('description', 'required',array($this,'check_required'))
								->add_rules('category', 'required')
								->add_rules('sub_category', 'required')
								->add_rules('sec_category', 'required')
								->add_rules('bid_increment', 'required','chars[0-9.]',array($this,'check_price_val_lmi'),array($this,'check_bid_increment_val'))
								//->add_rules('quantity', 'required','chars[0-9]')

								->add_rules('shipping_fee', 'required','chars[0-9.]')
								->add_rules('shipping_info', 'required')  
								->add_rules('product_price', 'required','chars[0-9.]',array($this,'check_price_val_lmi')) 
								->add_rules('deal_value', 'required','chars[0-9.]',array($this,'check_deal_value_lmi'),array($this,'check_deal_price'))
								->add_rules('start_date', 'required')
								->add_rules('end_date', 'required', array($this, 'check_end_date'))
								->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
								->add_rules('stores','required')
								->add_rules('users', 'required');
					if($post->validate()){
						$status = $this->auction->edit_deals($deal_id, $deal_key, arr::to_object($this->userPost));
							if($status == 1 && $deal_key){

								if($_FILES['image']['name'] != "" ){         
									$i=1;
									foreach(arr::rotate($_FILES['image']) as $files){
										if($files){	
											
											$filename = upload::save($files); 
											if($filename!=''){ 
												if($i==1){
													$IMG_NAME = $deal_key."_1.png";
													common::image($filename, 620, 752, DOCROOT.'images/auction/1000_800/'.$IMG_NAME);
												} else { // replace if the 1st image s empty with the next successive image
														for($j=2;$j<=$i;$j++) {
															$IMG_NAME1 = $deal_key."_".$i; 
															common::image($filename, 620, 752, DOCROOT.'images/auction/1000_800/'.$IMG_NAME1.'.png'); 
														} 
													
													}
													
												$IMG_NAME = $deal_key."_".$i.'.png';					
											

											        common::image($filename, 620,752, DOCROOT.'images/auction/1000_800/'.$IMG_NAME);
												unlink($filename);
											}
										}
										$i++;
									}
								}
							common::message(1, $this->Lang["AUCTION_EDIT_SUC"]);
							$lastsession = $this->session->get("lasturl");
		                                        if($lastsession){
		                                        url::redirect(PATH.$lastsession);
		                                        } else {
		                                        url::redirect(PATH."admin/manage-auction.html");
		                                        }
												
							}
							elseif($status == 8){
							common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
							$lastsession = $this->session->get("lasturl");
		                                        if($lastsession){
		                                        url::redirect(PATH.$lastsession);
		                                        } else {
		                                        url::redirect(PATH."admin/manage-auction.html");
		                                        }
							}

					}
					else{	
						$this->form_error = error::_error($post->errors());
					}
			}
        $this->category_list = $this->auction->get_gategory_list();
	$this->sub_category_list = $this->auction->get_sub_category_list();
	$this->sec_category_list = $this->auction->get_sec_category_list();
	$this->third_category_list = $this->auction->get_third_category_list();
        $this->get_marchant_list = $this->auction->getmarchantlist();
        $this->shop_list = $this->auction->get_shop_list();
        $this->deal = $this->auction->get_edit_deal($deal_id,$deal_key);
        if(($this->deal->current()->enddate) <  time() ){
		common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
		url::redirect(PATH.$lastsession);
		} else {
		url::redirect(PATH."admin/manage-auction.html");
		}
	}
        $this->template->title = $this->Lang["EDIT_AUCTION"];
        $this->template->content = new View("admin_auction/edit_auction");	   
	}
	
	/** BLOCK UNBLOCK DEALS **/
	
	public function block_auction($type = "", $key = "", $deal_id = "")
	{
		if(!ADMIN_PRIVILEGES_AUCTIONS_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->auction->blockunblockdeal($type, $key, $deal_id);

		if($status == 1){
		        if($type == 1){
				common::message(1, $this->Lang["AUCTION_UNB_SUC"]);
			}
			else{
				common::message(1, $this->Lang["AUCTION_B_SUC"]);
			}
		}
		else{
		        common::message(-1, $this->Lang["AUC_ACTI"]);
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
		url::redirect(PATH.$lastsession);
		} else {
		url::redirect(PATH."admin/manage-auction.html");
		}
	}
	
	/** CHECK MIN USER LIMIT LESS THAN MAX USER LIMIT **/
	
	public function check_min_lmi()
	{
		if(($this->input->post("minlimit"))<=$this->input->post("maxlimit")){
			return 1;
		}
		return 0;
	}
	
	/** CHECK DISCOUNT PRICE  LESS THAN ORGINAL PRICE **/
	
	public function check_price_lmi()
	{
		if(($this->input->post("deal_value"))<=$this->input->post("price")){
			return 1;
		}
		return 0;
	}

	/** CHECK MAX USER PURCHACE LIMIT LESS THAN MAX USER LIMIT**/
	
	public function check_purchace_lmi()
	{
		if(($this->input->post("quantity"))<=$this->input->post("maxlimit")){
			return 1;
		}
		return 0;
	}
	
	/** CHECK VALID PHONE OR NOT **/
	
	public function validphone($phone = "")
	{
		if(valid::phone($phone,array(7,10,11,12,13,14)) == TRUE){
			return 1;
		}
		return 0;
	}
	
	/** CHECK ENDDATE GREATER STARTDATE **/
	
	public function check_end_date($end_date = "")
	{
		if(strtotime($this->input->post("start_date")) < strtotime($end_date)){
			return 1;
		}
		return 0;
	}
	
       /** CHECK DISCOUNT PRICE **/

	public function discount($savings= "")
	{
		if(($this->input->post("price")) > ($savings)){
			return 1;
		}
		return 0;
	}
	
	/** CHECK EXPIRTDATE GREATER ENDDATE **/
	
	public function check_expiry_date($expiry_date = "")
	{
		if(strtotime($this->input->post("end_date")) <= strtotime($expiry_date)){
			return 1;
		}
		return 0;
	}
	
	/** CHECK VALID IMAGE URL **/
	
	public function valid_image_url($url = "")
	{
		if(remote::status($url) == 200){
			return 1;
		}
		return 0;
	}
	
	/** CHECK IMAGE OR IMAGE URL ADDED **/
		
	public function check_image_or_url($image = "")
	{
		if($image["name"] || $this->input->post("image_url")){
			return 1;
		}
		return 0;
	}
	
	/** SELECT SUB CATEGORY AND UNDER CATEGORY USER **/
	
	public function change_category($category= "")
	{
		if($category == -1){
			$list = '<td><label>Select Main Category*</label></td><td><label>:</label></td><td><select name="sub_category">';
			$list .='<option value="">Select Category First</option>';
			echo $list .='</select></td>';
		    exit;
		}
		else {
		        $categorylist = $this->auction->get_sub_category($category); 
		        if(count($categorylist) > 0){
					$list = '<td><label>Select Main Category*</label></td>
								<td><label>:</label></td>


								<td><select name="sub_category" onchange="return sec_change_auction_category(this.value);">  
								<option value="">Select Any Category</option>';
					foreach($categorylist as $s){			
						$list .='<option value="'.$s->category_id.'">'.ucfirst($s->category_name).'</option>';
					}
					echo $list .='</select></td>';					
				}
				else {
					$list = '<td><label>Select Main Category*</label></td><td><label>:</label></td><td><select name="sub_category">';
					$list .='<option value="">No Main Category</option>';
					echo $list .='</select></td>';
				}
				exit;
		}
	}
	
	
	public function sec_change_category($category= "")
	{
		if($category == -1){
			$list = '<td><label>Select Sub Category*</label></td><td><label>:</label></td><td><select name="sub_category">';
			$list .='<option value="">Select Main Category First</option>';
			echo $list .='</select></td>';
		    exit;
		}
		else {
		        $categorylist = $this->auction->get_sec_category($category); 
		        if(count($categorylist) > 0){
					$list = '<td><label>Select Sub Category*</label></td>
								<td><label>:</label></td>
                                                                <td><select name="sec_category" onchange="return third_change_category(this.value);">  
								<option value="">Select Any Category</option>';
					foreach($categorylist as $s){			
						$list .='<option value="'.$s->category_id.'">'.ucfirst($s->category_name).'</option>';
					}
					echo $list .='</select></td>';					
				}
				else {
					$list = '<td><label>Select Sub Category*</label></td><td><label>:</label></td><td><select name="sec_category">';
					$list .='<option value="">No Sub Category</option>';
					echo $list .='</select></td>';
				}
				exit;
		}
	}
	
	
	public function third_change_category($category= "")
	{
		if($category == -1){
			$list = '<td><label>Select Second Sub Category</label></td><td><label>:</label></td><td><select name="third_category">';
			$list .='<option value="">Select Sub Category First</option>';
			echo $list .='</select></td>';
		    exit;
		}
		else {
		        $categorylist = $this->auction->get_third_category($category); 
		        if(count($categorylist) > 0){
					$list = '<td><label>Select Second Sub Category</label></td>
								<td><label>:</label></td>
                                                                <td><select name="third_category" > <option value="">Select Any Category</option> ';
					foreach($categorylist as $s){			
						$list .='<option value="'.$s->category_id.'">'.ucfirst($s->category_name).'</option>';
					}
					echo $list .='</select></td>';					
				}
				else {
					$list = '<td><label>Select Second Sub Category</label></td><td><label>:</label></td><td><select name="third_category">';
					$list .='<option value="">No Sub Category</option>';
					echo $list .='</select></td>';
				}
				exit;
		}
	}
		
        
	/** SELECT CITY AND AND CITY UNDER USER **/
	
   	public function shop($users= "")
	{
		if($users == -1){
			$list = '<td><label>Select Shop</label></td><td><label>:</label></td><td><select name="city">';
			$list .='<option value="">First Select Users</option>';
			echo $list .='</select></td>';
		exit;
		}
		else{
	        $shoplistlist = $this->auction->get_store_by_users($users);
	        if(count($shoplistlist) > 0){
				$list = '<td><label>Select Shop</label></td>
							<td><label>:</label></td>
							<td><select name="stores">';
				foreach($shoplistlist as $s){			
					$list .='<option value="'.$s->store_id.'">'.ucfirst($s->store_name).'</option>';
				}
				echo $list .='</select></td>';
				
			}
			else{
				$list = '<td><label>Select Shop</label></td><td><label>:</label></td><td><select name="city">';
				$list .='<option value="">No Shops Under This User</option>';
				echo $list .='</select></td>';
			}
			exit;
		}
	}
	
	/** CHECK PRICE VALUE LIMIT **/
	public function check_price_val_lmi($price = "")
	{
		if($price!= '0'){
			return 1;
		}		
		return 0;
	}

	/** CHECK AUCTION PRICE LESS THAN PRODUCT PRICE **/

	public function check_deal_price($price = "")
	{
		
		if($price < $this->input->post('product_price')){
			return 1;
		}		
		return 0;
	}

	/** CHECK BID PRICE LESS THAN AUCTION PRICE **/

	public function check_bid_increment_val($price = "")
	{
		if($price < $this->input->post('deal_value')){



			return 1;
		}		
		return 0;
	}

	/** DEAL VALUE LIMIT **/
	public function check_deal_value_lmi($deal_value)
	{
		if($deal_value!= '0'){
			return 1;
		}		
		return 0;
	}
	
	/** MAXLIMIT VALUE LIMIT **/
	public function check_maxlimit_lmi()
	{
		if(($this->input->post("maxlimit"))!= '0'){
			return 1;
		}		
		return 0;
	}
	
	
	public function check_required($val = "")
	{
		if(strip_tags($val) == "") return 0;return 1;
	}
	
	/**SEND EMAIL COPUONS **/
	
	public function send_email($deal_id = "", $deal_key = "")
    {
		$this->manage_auction="1";
		$this->deatils = $this->auction->get_deals_data_mail($deal_key, $deal_id);
		if(count($this->deatils) == 0){
	                common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
	                url::redirect(PATH."admin/manage-auction.html");
		}
		if($_POST){ 
			$this->userPost = $this->deal_deatils = $this->input->post();
			$users = $this->input->post("users");
			$fname = $this->input->post("firstname");
			$email = $this->input->post("email");
				$post = Validation::factory(array_merge($_POST,$_FILES))
							->add_rules('users', 'required')
							->add_rules('email','required')
							->add_rules('subject', 'required','chars[a-zA-z0-9- _,/.+]')
							->add_rules('message', 'required');
			if($post->validate()){

				foreach($email as $mail){
					$mails = explode("__",$mail);
					$useremail = $this->mail= $mails[0];
					$username =  $mails[1];
					if(isset($username) && isset($useremail)) 
						$message = " <p> ".$post->message." </p>";
						$message .= new View ("admin_auction/mail_auction");
						$this->email_id = $useremail;
                                                $this->name = $username;
                                                $this->message = $message;
                                                $fromEmail = NOREPLY_EMAIL;
                                                $message = new View("themes/".THEME_NAME."/admin_mail_template");
						$fromEmail = NOREPLY_EMAIL;
						if(EMAIL_TYPE==2){
						email::smtp($fromEmail,$useremail,$post->subject,$message);
						}
						else{
						email::sendgrid($fromEmail,$useremail,$post->subject,$message);
						}

						common::message(1, $this->Lang["MAIL_SENDED"]);
						
				}									
				$lastsession = $this->session->get("lasturl");
		                if($lastsession){
		                url::redirect(PATH.$lastsession);
		                } else {
		                url::redirect(PATH."admin/manage-auction.html");
		                }
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->template->title = $this->Lang["EMAIL_NEWS"];
		$this->template->content = new View("admin_auction/send_mail");	
	}

		/** WINNER LIST  **/
	
	public function winner($page = "")
	{
		if(!ADMIN_PRIVILEGES_AUCTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->page = $page ==""?1:$page; // for export per page
		
		$this->winner = 1;
		$this->url="admin-auction/winner-list.html";

		if($_POST){ 
			$this->deal_deatils = $this->input->post(); 
			$this->type="winner";
			$email_id = $this->input->post('email');
			$message = $this->input->post('message');
			//$this->deal_deatils = $this->auction->get_deals_data($this->input->post('deal_key'), $this->input->post('deal_id'));
			$message .= new View ("admin_auction/mail_auction");
			$message .= "<p></p><p>".$this->Lang['THANKS_RE']."</p> <p>". SITENAME ." ".$this->Lang['ADMIN']." </p>"; 
			
			$fromEmail = NOREPLY_EMAIL;
			if(EMAIL_TYPE==2){

			email::smtp($fromEmail,$email_id, SITENAME, $message);

			}
			else{
			email::sendgrid($fromEmail,$email_id, SITENAME, $message);
			}
			common::message(1, $this->Lang["MAIL_SENDED"]);

                        $lastsession = $this->session->get("lasturl");
                        if($lastsession){
                        url::redirect(PATH.$lastsession);
                        } else {
			url::redirect(PATH."admin-auction/winner-list.html");
			}
		
		}
		$this->search_key = arr::to_object($this->input->get());
		$count = $this->auction->get_winner_count($this->input->get('name'));
		$this->pagination = new Pagination(array(
				'base_url'       => 'admin-auction/winner-list.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$serch=$this->input->get("id");
		
		$this->winner_list = $this->auction->get_winner_list($this->pagination->sql_offset,$this->pagination->items_per_page, $this->input->get('name'),0); 

			if($serch == 'all'){ // for export all
				$this->winner_list = $this->auction->get_winner_list($this->pagination->sql_offset,$this->pagination->items_per_page, $this->input->get('name'),1); 
			}
			if($serch){
				$out = '"S.No","Auction Name","User name","Retail Price","Auction Price","Savings","Image"'."\r\n";
				$i=0; 
				$first_item = $this->pagination->current_first_item;
				foreach($this->winner_list as $d){			
					if(file_exists(DOCROOT.'images/auction/1000_800/'.$d->deal_key.'_1.png')){       
						$deal_image =PATH.'images/auction/1000_800/'.$d->deal_key.'_1.png';
					} else {
						$deal_image =PATH.'images/no-images.png';
					}
					$out .= $i + $first_item.',"'.$d->deal_title.'","'.$d->firstname.'","'.(CURRENCY_SYMBOL.$d->product_value).'","'.(CURRENCY_SYMBOL.$d->deal_value).'","'.round(($d->product_value - $d->deal_value)/$d->product_value * 100).'%'.'","'.$deal_image.'"'."\r\n";
					$i++;
				}
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream'); 
				header('Content-Disposition: attachment; filename=winner.xls');
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				echo "\xEF\xBB\xBF"; // UTF-8 BOM
				echo $out; 
				exit;
			}

		$this->template->title = $this->Lang['WIN_LIST2'];
		$this->template->content = new View("admin_auction/winner_list");
	}

	/** AUCTION SHIPPING DELIVERY **/
	
	public function shipping_delivery($page = "")
	{
		if(!ADMIN_PRIVILEGES_TRANSACTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
                $this->page = $page ==""?1:$page; // for export per page
                $this->url="admin-auction/shipping-delivery.html"; // for export
                $this->shipping_delivery="1";
                $search=$this->input->get("id"); // Export CSV format
                $this->count_shipping = $this->auction->get_shipping_count($this->input->get("search"));

                        $this->pagination = new Pagination(array(
                        'base_url'       => 'admin-auction/shipping-delivery.html/page/'.$page."/",
                        'uri_segment'    => 4,
                        'total_items'    => $this->count_shipping,
                        'items_per_page' => 20, 
                        'style'          => 'digg',
                        'auto_hide'      => TRUE
                        ));
		$this->search = $this->input->get();
		$this->search_key = arr::to_object($this->search);
		$this->shipping_list = $this->auction->get_shipping_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("search"),"",0);
		if($search == 'all'){ // for export all
			$this->shipping_list = $this->auction->get_shipping_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("search"),"",1);
		}
		if($search){ // Export in CSV format
				$out = '"S.No","Auction Title","Name","Email","Date & Time","Phone Number","Address","Delivery Status"'."\r\n";
				$i=0; 
				$first_item = $this->pagination->current_first_item;
				foreach($this->shipping_list as $d)
				{
					if($d->delivery_status == 0 ){
						$delivery = $this->Lang['PENDING'];
					}
					else if($d->delivery_status == 1 ){
							$delivery = $this->Lang['ORDER_PACKED'];
					}
					else if($d->delivery_status == 2 ){
							$delivery = $this->Lang['SHIPPED_DELI_CENT'];
					}
					else if($d->delivery_status == 3 ){
							$delivery = $this->Lang['OR_OUT_DELI'];
					}
					else if($d->delivery_status == 4 ){
							$delivery = $this->Lang['DELIVERED'];
					}
					
					$out .= $i+$first_item.',"'.$d->deal_title.'","'.$d->firstname.'","'.$d->email.'","'.date('d-M-Y h:i:s A',$d->shipping_date).'","'.$d->phone.'","'.$d->adderss1.",".$d->address2.'","'.$delivery.'"'."\r\n";
					$i++;

				}
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream'); 
				header('Content-Disposition: attachment; filename=Auction-Shipping.xls');
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				echo "\xEF\xBB\xBF"; // UTF-8 BOM
				echo $out; 
				exit;
			}

		$this->template->title = $this->Lang["SHIP_DEL"];
		$this->template->content = new View("admin_auction/shipping_delivery");
	}

	/** AUCTION COD DELIVERY **/
	
	public function cash_on_delivery($page = "")
	{
		if(!ADMIN_PRIVILEGES_TRANSACTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->page = $page ==""?1:$page; // for export per page

		$this->url="admin-auction/cod-delivery.html"; // for export
		
		$this->cod_delivery="1";
 	    $search=$this->input->get("id"); // Export CSV format
	 
		$this->count_shipping = $this->auction->get_shipping_count($this->input->get("search"),5);

				$this->pagination = new Pagination(array(
				'base_url'       => 'admin-auction/cod-delivery.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $this->count_shipping,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->search = $this->input->get();
		$this->search_key = arr::to_object($this->search);
		
		$this->shipping_list = $this->auction->get_shipping_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("search"),5,0);

		if($search == 'all'){ // for export all
			$this->shipping_list = $this->auction->get_shipping_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("search"),5,1);
		}
		
		if($search){ // Export in CSV format
				$out = '"S.No","Auction Title","Name","Email","Date & Time","Phone Number","Address","Delivery Status"'."\r\n";
				$i=0; 
				$first_item = $this->pagination->current_first_item;
				foreach($this->shipping_list as $d)
				{
					if($d->delivery_status == 0 ){
						$delivery = $this->Lang['PENDING'];
					}
					else if($d->delivery_status == 4 ){
							$delivery = $this->Lang['COMPLETED'];
					}
					else if($d->delivery_status == 5 ){
							$delivery = $this->Lang['FAILED'];
					}
						
					$out .= $i+$first_item.',"'.$d->deal_title.'","'.$d->firstname.'","'.$d->email.'","'.date('d-M-Y h:i:s A',$d->shipping_date).'","'.$d->phone.'","'.$d->adderss1.",".$d->address2.'","'.$delivery.'"'."\r\n";
					$i++;

				}
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream'); 
				header('Content-Disposition: attachment; filename=Auction-COD-Shipping.xls');
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				echo "\xEF\xBB\xBF"; // UTF-8 BOM
				echo $out; 
				exit;
			}

		$this->template->title = $this->Lang['CASH_ON_DEL'];
		$this->template->content = new View("admin_auction/cash_on_delivery");
	}

	/** MANAGE USER COMMENTS **/
	
	public function manage_users_comments($deal_type = "",$page = "")
	{		 
		$this->auction_comments = 1;		
		$count = $this->auction->get_users_comments_count($this->input->get('firstname'),$deal_type);
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-auction-comments.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->search = $this->input->get();
		$this->search_key = arr::to_object($this->search);
		$this->users_list = $this->auction->get_users_comments_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('firstname'),$deal_type);
		
		$this->template->title = $this->Lang["USER_COMM"];
		$this->template->content = new View("admin_auction/manage_users_comments");
	}
	
	/** UPDATE USER COMMENTS **/
	
	public function edit_users_comments($commentsid = "")
	{ 
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		if($_POST){
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('comments', 'required');
			if($post->validate()){
				$status = $this->auction->edit_users_comments($commentsid, arr::to_object($this->userpost));
					if($status ==1){
                        common::message(1, $this->Lang["COMM_SET_SUC"]);
                        url::redirect(PATH.'admin/manage-auction-comments.html');
                	}          
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		
	    $this->users_comments_data = $this->auction->get_users_comments_data($commentsid);	
		if(count($this->users_comments_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-auction-commants.html");
		}
		$this->template->title = $this->Lang["COMM_MERCHANT"];
		$this->template->content = new View("admin_auction/edit_users_comments");	
	}
	
	/** BLOCK AND UNBLOCK USERCOMMENTS **/
	
	public function block_users_comments($type = "", $uid = "")
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->auction->blockunblockusercomments($type, $uid);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["COMM_UNB"]);
			}
			else{
				common::message(1, $this->Lang["COMM_B"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		url::redirect(PATH."admin/manage-auction-comments.html");
	}

	/** DELETE USERCOMMENTS **/
	
	public function delete_users_comments($discussion_id = "")
	{ 
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->auction->deleteusercomments($discussion_id);
		if($status == 1){			
				common::message(1, $this->Lang["COMM_DEL"]);
			}			
		url::redirect(PATH."admin/manage-auction-comments.html");
	}
	
	/** DASHBOARD AUCTION **/
		
	public function dashboard_auction()
	{
		if(!ADMIN_PRIVILEGES_AUCTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->dashboard_auction="1";
		$this->start_date = "";
		$this->end_date = "";
		if($_GET){
			$this->start_date = $this->input->get('start_date');
			$this->end_date = $this->input->get('end_date');
		}
	    $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js',PATH.'js/jquery.js'));
	    $this->start_date = $this->input->get("start_date");
	    $this->end_date = $this->input->get("end_date");	   
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
		$this->transaction_list = $this->auction->get_transaction_chart_list();
		$this->deals_dashboard_data = $this->auction->get_deals_chart_list();
		$this->biding_data = $this->auction->get_bidding_data_list();
		$this->template->content = new View("admin_auction/auction_dashboard");
		$this->template->title = $this->Lang['ACT_DASH'];
	}
	
	/*MULTUPLE IMAGE DELETE */
	public function delete_auction_images()
	{ 
		
		$this->img=$this->input->get("img");
		$this->deal_id=$this->input->get("id");
		$IMG_NAME=base64_decode($this->img);
		$this->deal_key=$this->input->get("deal_key");
		
		$a = explode('_',$IMG_NAME);
		if($a[1] == 1) {
			if(file_exists(DOCROOT.'images/auction/1000_800/'.$IMG_NAME.'.png')) { 
			for($i=2;$i<=5;$i++) {
				$IMG_NAME1 = $this->deal_key."_".$i;
				if(file_exists(DOCROOT.'images/auction/1000_800/'.$IMG_NAME1.'.png')) {
				break; 
				}
								
			} 
			if(file_exists(DOCROOT.'images/auction/1000_800/'.$IMG_NAME1.'.png')) {
			$filename= DOCROOT."images/auction/1000_800/".$IMG_NAME1.".png";
			
			//common::image($filename, PRODUCT_LIST_WIDTH, PRODUCT_LIST_HEIGHT, DOCROOT.'images/auction/1000_800/'.$IMG_NAME.'.png'); 
			
			}
		}
		}
		else{
			
			for($i=1;$i<=5;$i++) {
				$IMG_NAME1 = $this->deal_key."_".$i;
				if(file_exists(DOCROOT.'images/auction/1000_800/'.$IMG_NAME1.'.png')) { 	
				break; 
				}
								
			} 
			if(file_exists(DOCROOT.'images/auction/1000_800/'.$IMG_NAME1.'.png')) {
			$filename= DOCROOT."images/auction/1000_800/".$IMG_NAME1.".png";
			
			//common::image($filename, PRODUCT_LIST_WIDTH, PRODUCT_LIST_HEIGHT, DOCROOT.'images/auction/1000_800/'.$this->deal_key.'_1.png'); 
			
			}
			
		
		}
		if(file_exists(DOCROOT.'images/auction/1000_800/'.$IMG_NAME.'.png')) {      
			$filename= DOCROOT.'images/auction/1000_800/'.$IMG_NAME.'.png';
			unlink($filename);
		}
		
		url::redirect(PATH."admin/edit-auction/".base64_encode($this->deal_id)."/".$this->deal_key.".html");
	}
	
	/* UPDATE STATUS DELIVERY FOR AUCTION */
	
	public function update_delivery_status($email_id="",$name="",$type="",$shippingid="",$auction_id="",$trans_id="")
	{
		
		$status = $this->auction->update_shipping_status($shippingid,$type);
		if($type==1) {
			
						$message = "<b>".$this->Lang['THK_PUR']."</b></br>";
						
						$this->auction_details = $this->auction->get_auction_mail_data($auction_id,$trans_id,$shippingid);

						$message .= new View("themes/".THEME_NAME."/auction/admin_auction_payment_mail"); 
						$subject="Your order has been delivered";
						
						 $this->email_id = $email_id;
                                                $this->name = $this->Lang["CUST"];
                                                $this->message = $message;
                                                $fromEmail = NOREPLY_EMAIL;
                                                $message = new View("themes/".THEME_NAME."/admin_mail_template");
                                                
						$fromEmail = CONTACT_EMAIL;
						if(EMAIL_TYPE==2){
							email::smtp($fromEmail,$email_id, $subject, $message);
						}else{
							email::sendgrid($fromEmail,$email_id, $subject, $message);
						}
						//common::message(1, $this->Lang["MAIL_SENDED"]);
					} 
						
			if($status){
						common::message(1, $this->Lang['STA_UPD']);
						$lastsession = $this->session->get("lasturl");
                                                if($lastsession){
                                                url::redirect(PATH.$lastsession);
                                                } else {
						url::redirect(PATH."admin-auction/shipping-delivery.html");
						}
					}	 
		
		
	}

	/* UPDATE COD STATUS DELIVERY FOR PRODUCT */
	public function update_cod_delivery_status($email_id="",$name="",$type="",$shippingid="",$auction_id=0,$trans_id=0,$merchant_id=0)
	{
		
		$status = $this->auction->update_cod_shipping_status($shippingid,$type,$trans_id,$auction_id,$merchant_id);
		if($type==4) {
			
						$message = "<b>".$this->Lang['THK_PUR']."</b></br>";
						$this->auction_details = $this->auction->get_auction_mail_data($auction_id,$trans_id,$shippingid);

						 $message .= new View("themes/".THEME_NAME."/auction/admin_auction_payment_mail"); 
						$subject="Your order has been delivered";
						
						 $this->email_id = $email_id;
                                                $this->name = $this->Lang["CUST"];
                                                $this->message = $message;
                                                $fromEmail = NOREPLY_EMAIL;
                                                $message = new View("themes/".THEME_NAME."/admin_mail_template");
						
						$fromEmail = CONTACT_EMAIL;
						if(EMAIL_TYPE==2){
							email::smtp($fromEmail,$email_id, $subject, $message);
						}else{
							email::sendgrid($fromEmail,$email_id, $subject, $message);
						}
						//common::message(1, $this->Lang["MAIL_SENDED"]);
					} 
						
					if($status){
						common::message(1, $this->Lang['STA_UPD']);
						$lastsession = $this->session->get("lasturl");
                                                if($lastsession){
                                                url::redirect(PATH.$lastsession);
                                                } else {
                                                url::redirect(PATH."admin-auction/cod-delivery.html");
                                                }
						
					}	 
		
		
	}
	
	/*MANAGE HOT AUCTION */
		
		public function popular_list($product="",$type="")
		{
			$this->popular_product_list = $this->auction->get_hot_product_list($product,$type);
			exit;
		}
	
		
}
