<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_products_Controller extends website_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		}
		  
		$this->products = new Admin_products_Model();
		$this->products_act="1";
	}

	/** ADD NEW PRODUCTS **/

	public function add_product()
	{
		if(!ADMIN_PRIVILEGES_PRODUCTS_ADD)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->add_product="1";
		$adminid=$this->session->get('user_id');
		if($_POST){
			$this->userPost = $this->input->post();
			$post = Validation::factory(array_merge($_POST,$_FILES))
							->pre_filter('trim', 'title')
							->add_rules('title', 'required')
							->add_rules('description', 'required',array($this,'check_required'))
							->add_rules('category', 'required')
							->add_rules('sub_category', 'required')
							->add_rules('sec_category', 'required')
							//->add_rules('price', 'required', 'chars[0-9.]',array($this,'check_price_val_lmi'))
							->add_rules('deal_value', 'required', array($this, 'check_price_lmi_prd'),'chars[0-9.]',array($this,'check_deal_value_lmi'))
							->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
							->add_rules('stores','required')
							->add_rules('color_val','required')
							->add_rules('users', 'required')
							->add_rules('delivery_days','required');

	                        if($post->validate()){
                                $deal_key = text::random($type = 'alnum', $length = 8);
                                $size_quantity = $this->input->post("size_quantity");
								if(count($size_quantity)>1)
								{
								unset($size_quantity[0]);
								$size_quantity=array_values($size_quantity);
								}
                                $status = $this->products->add_product(arr::to_object($this->userPost),$deal_key,$adminid,$size_quantity);
				if($status > 0 && $deal_key){
				        if($_FILES['image']['name']['0'] != "" ){
                                                $i=1;
							foreach(arr::rotate($_FILES['image']) as $files){
                				        if($files){
									$filename = upload::save($files);
										if($filename!=''){
											$IMG_NAME = $deal_key."_".$i.'.png';
											common::image($filename, 620,752, DOCROOT.'images/products/1000_800/'.$IMG_NAME);
											unlink($filename);
										}
							        }
							    $i++;
							}
                                        }
					/**PRODUCT AUTOPOST FACEBOOK WALL**/
					if($this->input->post('autopost')==1){
							$producturl=url::title($this->input->post('title'));
							$productURL = PATH."product/".$deal_key.'/'.$producturl.".html";
							$message = "A new product published onthe site"." ".$this->input->post('title')." ".$productURL." limited offer hurry up!";
							$fb_access_token = $this->session->get("fb_access_token");
							$fb_user_id = $this->session->get("fb_user_id");
							$post_arg = array("access_token" => $fb_access_token, "message" => $message, "id" => $fb_user_id, "method" => "post");
							common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg);
					}
				     /**PRODUCT AUTOPOST FACEBOOK WALL END HERE**/
					  $this->product_deatils = $this->products->get_product_data($deal_key, $status);
					  $store_key =$this->product_deatils->current()->store_url_title;
					  $producturl =$this->product_deatils->current()->url_title;
					  if($this->input->post('status')==2){
						url::redirect(PATH.$store_key."/product/".$deal_key.'/'.$producturl."/admin-preview.html");
					  }else{
						common::message(1, $this->Lang["PRODUCT_ADD_SUC"]);
						url::redirect(PATH."admin/manage-products.html");
					  }
				}
				$this->form_error["city"] = $this->Lang["PRODUCT_EXIST"];
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		/** For attrbute adding **/
		$this->all_attributes=$this->products->getProductAttributes();
		$prdatr = $this->products->GetAttributes();
		$this->product_attributes = array();
		foreach($prdatr as $a){
			$this->product_attributes [$a->attribute_id]= $a->name ;
		}
		$this->category_list = $this->products->get_category_list();
		$this->sub_category_list = $this->products->get_sub_category_list();
		$this->sec_category_list = $this->products->get_sec_category_list();
		$this->third_category_list = $this->products->get_third_category_list();
		$this->get_marchant_list = $this->products->getmarchantlist();
		$this->shop_list = $this->products->get_shop_list();
		$this->color_code = $this->products->get_shipping_product_color();
		$this->product_size = $this->products->get_product_size();
		
	        $this->template->title = $this->Lang["ADD_PRODUCTS"];
		$this->template->content = new View("admin_product/add_products");
	}

	public function confirm_product($product_id = "",$preview_type='')
	{
	        $this->product = $this->products->change_product_status($product_id);
	        if(base64_decode($preview_type)=='preview'){
				common::message(1, $this->Lang["PRODUCT_ADD_SUC"]);
				url::redirect(PATH."admin/add-products.html");
			}else{
				common::message(1, $this->Lang["PRODUCT_EDIT_SUC"]);
				url::redirect(PATH."admin/manage-products.html");
			}
	}
	/** ADD MORE COLOR **/
	
	public function addmore_color()
	{
		$city_id = $this->input->get('count');
		$this->get_city_data = $this->products->get_color_data($city_id);
		$list = "";
		foreach($this->get_city_data as $c){
			$list .="<span style='padding:3px;margin:2px;width:auto;height:20px;vetical-align:top;display:inline-block;border:3px solid #$c->color_code;'><input type='checkbox' name='color[]' checked='checked' value='".$c->color_code."'>".ucfirst($c->color_name)."</span>  ";
		}
		echo $list;
		exit;
	}

	/** EDIT MORE COLOR **/
	
	public function editmore_color()
	{
		$city_id = $this->input->get('count');
		$deal_id = $this->input->get('deal');
		    $list = "";
		    $store_data = $this->products->store_color_data($city_id,$deal_id);
		    if($store_data == 1){
		    $this->get_city_data = $this->products->get_color_data($city_id);
		            foreach($this->get_city_data as $c){
			            $list .="<span style='padding:3px;margin:2px;width:auto;height:20px;vetical-align:top;display:inline-block;border:3px solid #$c->color_code;'><input type='checkbox' name='color[]' checked='checked' value='".$c->color_code."'>".ucfirst($c->color_name)."</span>  ";
		             }
		     }
		     echo $list;
		    exit;
	}
	
	/** ADD MORE SIZE **/
	
	public function addmore_size()
	{

		$city_id = $this->input->get('count');
		$this->get_city_data = $this->products->get_size_data($city_id);
		$list = "";
		foreach($this->get_city_data as $c){
			$list .="<p style='float:left;'><span style='width:3px;padding:3px;'> Select Size ".ucfirst($c->size_name)." <input type='checkbox' name='size[]' checked='checked' value='".$c->size_id."'></span><br> <span style='width:3px;padding:3px;'><input style='width:auto;' type='text' name='size_quantity[]'  maxlength='8' value='1' class='txtChar' onkeypress='return isNumberKey(event)'></span></p>";
		 }
		echo $list;
		exit;
	}
	/** EDIT MORE SIZE **/
	public function editmore_size()
	{

		    $city_id = $this->input->get('count');
		    $deal_id = $this->input->get('deal');
		    $list = "";
		    $store_data = $this->products->store_size_data($city_id,$deal_id);
		    if($store_data == 1){
		    $this->get_city_data = $this->products->get_size_data($city_id);
		            foreach($this->get_city_data as $c){
			           $list .="<p style='float:left;'><span style='width:3px;padding:3px;'>Select size = ".ucfirst($c->size_name)."<input type='checkbox' name='size[]' checked='checked' value='".$c->size_id."'></span> <br> <span style='width:3px;padding:3px;'><input style='width:auto;' type='text' name='size_quantity[]'  maxlength='8' value='1' class='txtChar' onkeypress='return isNumberKey(event)'></span> </p> ";
		             }
		     }
		     echo $list;
		    exit;

	}

	/** MANAGE PRODUCTS**/

	public function manage_product($type= "", $page = "")
	{
	
		if(!ADMIN_PRIVILEGES_PRODUCTS)
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
	    if($type == 1){
			$this->archive_product = "1";
			$this->template->title = $this->Lang["ARCHIVE_PRODUCTS"];
			$this->url = "admin/sold-products.html";
			$this->sort_url= PATH.'admin/sold-products.html?';
		}
		else{
			$this->manage_product = "1";
			$this->template->title = $this->Lang["MANAGE_PRODUCTS"];
			$this->url = "admin/manage-products.html";
			$this->sort_url= PATH.'admin/manage-products.html?';
		}
	        $this->count_products_all_record = $this->products->get_all_products_count($type, $this->input->get("city"), $this->input->get('name'),$this->type,$this->sort,$this->today,$this->startdate,$this->enddate,$this->input->get('product_duration'));
		$this->city_list = $this->products->get_city_lists();
		$this->search_key = arr::to_object($this->input->get());
		$this->pagination = new Pagination(array(
				'base_url'       => $this->url.'/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $this->count_products_all_record,
				'items_per_page' => 25,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->all_product_list = $this->products->get_all_products_list($type, $this->pagination->sql_offset, $this->pagination->items_per_page ,$this->input->get("city"), $this->input->get('name'),$this->type,$this->sort,0,$this->today,$this->startdate,$this->enddate,$this->input->get('product_duration'));

		if($serch =='all'){ // for export all
			$this->all_product_list = $this->products->get_all_products_list($type, $this->pagination->sql_offset, $this->pagination->items_per_page ,$this->input->get("city"), $this->input->get('name'),$this->type,$this->sort,1,$this->today,$this->startdate,$this->enddate,$this->input->get('product_duration'));
		}

			if($serch){
				$out = '"S.No","Title","Category","Original Price","Discount Price","Savings","Discount Percentage","Purchase Count","Merchant Name","Shop Name","Country","City","Image"'."\r\n";
				$i=0;
				$first_item = $this->pagination->current_first_item;
				foreach($this->all_product_list as $d)
				{
						if(file_exists(DOCROOT.'images/products/1000_800/'.$d->deal_key.'_1.png')){
							$deal_image =PATH.'images/products/1000_800/'.$d->deal_key.'_1.png';
						}
						else{
							$deal_image =PATH.'images/no-images.png';
						}
					$out .= $i + $first_item.',"'.$d->deal_title.'","'.$d->category_name.'","'.(CURRENCY_SYMBOL.$d->deal_price).'","'.(CURRENCY_SYMBOL.$d->deal_value).'","'.(CURRENCY_SYMBOL.$d->deal_savings).'","'.round($d->deal_percentage)."%".'","'.$d->purchase_count.'","'.$d->firstname.'","'.$d->store_name.'","'.$d->country_name.'","'.$d->city_name.'","'.$deal_image.'"'."\r\n";
					$i++;
				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=Products.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}
		$this->template->content = new View("admin_product/manage_products");
	}

	/** VIEW PRODUCTS **/

	public function view_product($deal_key= "", $deal_id = "")
	{
		if(!ADMIN_PRIVILEGES_PRODUCTS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
	        if($_POST){
	        $commission = $this->input->post('commission_status');
	        $deal_key = $this->input->post('commission_deal_key');
	        $deal_id = $this->input->post('commission_deal_id');
	                if($commission != ""){
	                        $commission_deatils = $this->products->change_commission_data($commission, $deal_id);
	                }
	                common::message(1, $this->Lang["COMMISSION_CHANGE_STATUS"]);
	                url::redirect(PATH."admin/view-products/".$deal_key."/".$deal_id.".html");
	        }
		$this->product_key = $deal_key;
		$this->product_id = $deal_id;
		$this->manage_product = "1";
		$this->product_deatils = $this->products->get_product_data($deal_key, $deal_id);
			if(count($this->product_deatils) == 0){
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				$lastsession = $this->session->get("lasturl");
		                if($lastsession){
		                url::redirect(PATH.$lastsession);
		                } else {
		                url::redirect(PATH."admin/manage-products.html");
		                }
			}
		$this->category_list = $this->products->all_category_list();
		$this->product_color = $this->products->get_product_color($deal_id);
		$this->product_size = $this->products->get_product_one_size($deal_id);
		$this->product_transaction_list = $this->products->get_transaction_data($deal_id);
		$this->cod_transaction_list = $this->products->get_cod_transaction_data($deal_id);
		$this->selectproduct_policy = $this->products->get_product_policy($deal_id);
		$this->commission_list = $this->products->get_merchant_balance();
		$serch=$this->input->get("id");

		if($serch){
			if($serch=='Search') {
				$out = '"S.No","Customers","Quantity","Amount","Admin Commission","Shipping","Status","Transaction Date","Transaction Type"'."\r\n";
					$i=0;
					$first_item = $i+1;
					foreach($this->product_transaction_list as $d)
					{
						if($d->payment_status=="SuccessWithWarning"){ $status=$this->Lang["SUCCESS"]; }
						elseif($d->payment_status=="Completed"){ $status=$this->Lang["COMPLETED"]; }
						elseif($d->payment_status=="Success"){ $status=$this->Lang["SUCCESS"]; }
						elseif($d->payment_status=="Pending"){ $status=$this->Lang["PENDING"]; }
						elseif($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }
						if($d->type=="1"){ $transaction_type=$this->Lang["PAYPAL_CREDIT"]; }
						elseif($d->type=="2"){ $transaction_type=$this->Lang["PAYPAL"]; }
						elseif($d->type=="3"){ $transaction_type=$this->Lang["REF_PAYMENT"]; }
						elseif($d->type=="4"){ $transaction_type="Authorize.net(".$d->transaction_type.")"; }
						elseif($d->type=="5"){ $transaction_type=$d->transaction_type; }
						elseif($d->type=="6"){ $transaction_type=$this->Lang["PAY_LATER"]; }
                                                $commission_val=$d->deal_merchant_commission;
                                                $commission=$d->deal_value *($commission_val/100);
                                                $Amount=($d->deal_value-$commission)*$d->quantity;
						$out .= $i + $first_item.',"'.$d->firstname.'","'.$d->quantity.'","'.($d->deal_value-$commission)*$d->quantity.'","'.$commission*$d->quantity.'","'.$d->shippingamount.'","'.$status.'","'.date('d-M-Y h:i:s A',$d->transaction_date).'","'.$transaction_type.'"'."\r\n";
						$i++;
					}
				} elseif($serch=='COD') {
					$out = '"S.No","Customers","Quantity","Amount","Admin Commission","Shipping","Status","Transaction Date","Transaction Type"'."\r\n";

					$i=0;
					$first_item = $i+1;
					foreach($this->cod_transaction_list as $d)
					{
						if($d->payment_status=="SuccessWithWarning"){ $status=$this->Lang["SUCCESS"]; }
						elseif($d->payment_status=="Completed"){ $status=$this->Lang["COMPLETED"]; }
						elseif($d->payment_status=="Success"){ $status=$this->Lang["SUCCESS"]; }
						elseif($d->payment_status=="Pending"){ $status=$this->Lang["PENDING"]; }
						elseif($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }

						if($d->type=="1"){ $transaction_type=$this->Lang["PAYPAL_CREDIT"]; }
						elseif($d->type=="2"){ $transaction_type=$this->Lang["PAYPAL"]; }
						elseif($d->type=="3"){ $transaction_type=$this->Lang["REF_PAYMENT"]; }
						elseif($d->type=="4"){ $transaction_type="Authorize.net(".$d->transaction_type.")"; }
						elseif($d->type=="5"){ $transaction_type=$d->transaction_type; }

						 $commission_val=$d->deal_merchant_commission;
						 $commission=$d->deal_value *($commission_val/100);
						 $Amount=($d->deal_value-$commission)*$d->quantity;

						$out .= $i + $first_item.',"'.$d->firstname.'","'.$d->quantity.'","'.($d->deal_value-$commission)*$d->quantity.'","'.$commission*$d->quantity.'","'.$d->shippingamount.'","'.$status.'","'.date('d-M-Y h:i:s A',$d->transaction_date).'","'.$transaction_type.'"'."\r\n";
						$i++;
					}
				}
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=Product-transactions.xls');
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				echo "\xEF\xBB\xBF"; // UTF-8 BOM
				echo $out;
				exit;
			}
		$this->template->title = $this->Lang["PRODUCT_DET"];
		$this->template->content = new View("admin_product/view_products");
	}
	
	/** IMPORT  PRODUCTS **/	
	
	public function product_import($title_data = "")
	{
		if($this->user_type > 2)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		//$this->postal_code_settings ="1";
		$this->import_product = "1";
		$adminid=$this->session->get('user_id');   
		
		if($_FILES){ 
		      
			$post = Validation::factory($_FILES)
						->add_rules('im_product','upload::required',array($this,'check_file_type'));				
		 	if($post->validate()){
		 	 
				$row = 1;
				$add_import = "";				
					$file_name = $_FILES['im_product']['tmp_name'];					
					$excel_name = '';
					if(isset($_FILES['im_product']['name']) && $_FILES['im_product']['name'] !='')
					{
						$temp = explode('.',$_FILES['im_product']['name']);
						$ext = end($temp);
						$excel_name = time().'.'.$ext;
						$path = DOCROOT.'upload/admin_excel/';
						move_uploaded_file($_FILES["im_product"]["tmp_name"],$path.$excel_name);
					}
					
					ini_set('memory_limit','5028m');
					set_time_limit(6400);
					/** Include path **/
					set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');
					/** PHPExcel_IOFactory */
					include DOCROOT.'PHPExcel/Classes/PHPExcel/IOFactory.php';
					$inputFileName = $path.$excel_name;
					//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
					$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
					$data1 = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			if(count($data1) > 0) {
				$add_import = 0;
				      $num = count($data1);
					   $row++;
					     if($num>0){ 
								 for($i=2;$i<=$num;$i++){
									$deal_key = text::random($type = 'alnum', $length = 8);	
									$title = "";
                                                                        ini_set('memory_limit','5028m');
                                                                        set_time_limit(6400);
									if(isset($data1[$i]['B'])){
										//$title_data = $this->products->importproduct_titleexists($data1[$i]['B']);
										$title = $data1[$i]['B'];
									}
									$category = "";
									if(isset($data1[$i]['C'])){
										$category = $data1[$i]['C'];
									}
									$sub_category = "";
									if(isset($data1[$i]['D'])){
										$sub_category = $data1[$i]['D'];
									}
									$sec_category = "";
									if(isset($data1[$i]['E'])){
										$sec_category = $data1[$i]['E'];
									}
									$third_category = "";
									if(isset($data1[$i]['F'])){
										$third_category = $data1[$i]['F'];
									}
									$product_price = "";
									if(isset($data1[$i]['G'])){
										$product_price = $data1[$i]['G'];
									}
									$discount_price = "";
									if(isset($data1[$i]['H'])){
										$discount_price = $data1[$i]['H'];
									}
									$product_desc = "";
									if(isset($data1[$i]['I'])){
										$product_desc = $data1[$i]['I'];
									}
									$sizes = "";
									if(isset($data1[$i]['J'])){
										$sizes = $data1[$i]['J'];
									}
									$color_code = "";
									if(isset($data1[$i]['K'])){
										$color_code = $data1[$i]['K'];
									}
									$attribute_type = "";
									if(isset($data1[$i]['L'])){
										$attribute_type = $data1[$i]['L'];
									}
									$attribute_val = "";
									if(isset($data1[$i]['M'])){
										$attribute_val = $data1[$i]['M'];
									}
									$deliver_days = "";
									if(isset($data1[$i]['N'])){
										$deliver_days = $data1[$i]['N'];
									}
									$deliver_policy = "";
									if(isset($data1[$i]['O'])){
										$deliver_policy = $data1[$i]['O'];
									}
									$merchant_name = "";
									if(isset($data1[$i]['P'])){
										$merchant_name = $data1[$i]['P'];
									} 
									$shop_name = "";
									if(isset($data1[$i]['Q'])){
										$shop_name = $data1[$i]['Q'];
									}
									$merchant_email = "";
									if(isset($data1[$i]['R'])){
										$merchant_email = $data1[$i]['R'];
									}
									$shipping_method = "";
									if(isset($data1[$i]['S'])){
										$shipping_method = $data1[$i]['S'];
									}	
									$shipping_amount = "";
									if(isset($data1[$i]['T'])){
										$shipping_amount = $data1[$i]['T'];
									}
									$shipping_weight = "";
									if(isset($data1[$i]['U'])){
										$shipping_weight = $data1[$i]['U'];
									}
									$shipping_height = "";
									if(isset($data1[$i]['V'])){
										$shipping_height = $data1[$i]['V'];
									}
									$shipping_length = "";
									if(isset($data1[$i]['W'])){
										$shipping_length = $data1[$i]['W'];
									}
									$shipping_width = "";
									if(isset($data1[$i]['X'])){
										$shipping_width = $data1[$i]['X'];
									}					
									$meta_keywords = "";
									if(isset($data1[$i]['Y'])){
										$meta_keywords = $data1[$i]['Y'];
									}
									$meta_description = "";
									if(isset($data1[$i]['Z'])){
										$meta_description = $data1[$i]['Z'];
									}
									
						/* attribute starts */
                                                $attribute_val .="$$";
                                                $attr_val = explode('$$',$attribute_val); //explode into single row
                                                $inner_attr= explode('#',$attr_val[0]);  //explode the multiple entry of specification from a single row 
                                                $category_data = $this->products->importproduct_addcategory($category,$sub_category,$sec_category,$third_category);
                                                $main_category_id = $category_data['main_category_id']; 
                                                $sub_category_id = $category_data['sub_category_id'];
                                                $sec_category_id = $category_data['sec_category_id'];
                                                $third_category_id = $category_data['third_category_id'];
                                                $this->get_merchant = $this->products->get_merchant_details($merchant_name,$shop_name,$merchant_email);
                                                $merchant_id = 0;
                                                $shop_id = 0;
						if(count($this->get_merchant) > 0){
							foreach($this->get_merchant as $merchant){
								$merchant_id = $merchant->user_id;
								$shop_id = $merchant->store_id;											
							}
						}
						$color_val = 0;
						$size_val = 0;
						$col = array();									     
                                                if($color_code){  
                                                        $color_val = 1;
                                                        $colors = explode("&", $color_code);
                                                        foreach($colors as $c){ 
                                                                $check_color_exist = $this->products->get_color_details($c);
                                                                if(isset($check_color_exist->current()->id)){
                                                                        $col[] = $check_color_exist->current()->id."_".$check_color_exist->current()->color_code."_".$check_color_exist->current()->color_name;
                                                                }
                                                        }
                                                        if(count($col) == 0) { 
                                                                $color_val = 0;
                                                        }
                                                }
                                                $size = array();
                                                $sizes_quantity = array();
                                                if($sizes){
                                                        $size_val = 1;
                                                        $size_quan = explode("&", $sizes);
                                                        $size = array();
                                                        foreach($size_quan as $d){ 
                                                                $sizes_nam = explode("_", $d);
                                                                if(count($sizes_nam)>1) {
                                                                $sizes_quantity[] = $sizes_nam[1];
                                                                $check_size_exist = $this->products->get_size_details($sizes_nam[0],$sizes_nam[1]);
                                                                $size[] = $check_size_exist->current()->size_id."_".$sizes_nam[0]."_".$sizes_nam[1]."_".$check_size_exist->current()->size_name;  
                                                                }
                                                        }
                                                        if(count($size) == 0) { 
                                                                $size_val = 0;
                                                        }
                                                }					
						//echo '$title:'.$title.'<br/>'.'$main_category_id:'.$main_category_id.'<br/> '.'$sub_category_id:'.$sub_category_id.'<br/>'.'$sec_category_id:'.$sec_category_id.'<br/>'.'$third_category:'.'<br/> '.$third_category.'<br/>'.'$product_price:'.$product_price.'<br/> '.'$discount_price:'.$discount_price.'<br/> '.' $shipping_method:'. $shipping_method.'<br/>'.' $shipping_amount:'. $shipping_amount.'<br/> '.'$product_desc:'.$product_desc.'<br/> '.'$deliver_days:'.$deliver_days.'<br/> '.'$merchant_id:'.$merchant_id.' <br/> '.'$shop_id:'.$shop_id.'<br/> '.'$color_val:'.$color_val.' <br/> '.'$size_val:'.$size_val.'<br/> '.'$col:'.$col.'<br/> '.'$size:'.$size.'<br/> '.'$sizes_quantity:'.$sizes_quantity;  exit;
						                          
						                        $merchant_and_shop_status = $this->products->get_merchant_and_shop_status($merchant_name,$shop_name,$merchant_email);
                                                                         
									if($title && $main_category_id !=0 && $sub_category_id !=0 && $product_price && $discount_price && $deliver_days && $merchant_id && $shop_id && $size_val && $size && $sizes_quantity && ($merchant_and_shop_status != 0)){
									$add_import = $this->products->add_import_product($adminid,$title,$deal_key,$main_category_id,$sub_category_id,$sec_category_id,$third_category_id,$product_price,$discount_price,$product_desc,$deliver_days,$merchant_id,$shop_id,$color_val,$size_val,$col,$size,$sizes_quantity,$attribute_type,$inner_attr,$meta_keywords,$meta_description,$deliver_policy,$shipping_amount, $shipping_method,$shipping_weight, $shipping_height, $shipping_length, $shipping_width);
									$image_url = "";
									if(isset($data1[$i]['AA'])){
										$image_url = $data1[$i]['AA'];
										if($image_url) { 
										$k=1;
										$imgs = explode("&", $image_url);
										        foreach($imgs as $d){
										                $IMG_NAME = $deal_key."_".$k.'.png'; 
										                $image = @file_get_contents($d);
										                $file = DOCROOT.'images/products/1000_800/'.$IMG_NAME;
										                file_put_contents($file, $image);
										                $k++;	
										        }
										}
									}
								}
								else
								{
									unlink($inputFileName);
									 common::message(1, $this->Lang['PRODUCT_UPDATE_SUCESS']);
									 url::redirect(PATH."admin/manage-products.html");
								} 
				                        } 
			                        }
	                         } 
				unlink($inputFileName);
				 common::message(1, $this->Lang['PRODUCT_UPDATE_SUCESS']);
				 url::redirect(PATH."admin/manage-products.html");
			}
			else{
					$this->form_error = error::_error($post->errors());				
				}
		}
		//url::redirect(PATH."admin/general-settings.html");
		$this->template->title = $this->Lang["PRODUCT_IMPORT"];
		$this->template->content = new View("admin_product/product_import");
		
	}

	public function csv_to_array($filename='', $delimiter=',')
	{

	  $header = NULL;
	  $data = array();
	  if (($handle = fopen($filename, "r")) === FALSE) return;
		while (($cols = fgetcsv($handle, 0, "\t")) !== FALSE) {
			foreach( $cols as $key => $val ) {
				$cols[$key] = trim( $cols[$key] );
                                // $cols[$key] = iconv('UCS-2', 'UTF-8', $cols[$key]."\0") ;
                                //$cols[$key] = str_replace('""', '"', $cols[$key]);
                                // $cols[$key] = preg_replace("/^\"(.*)\"$/sim", "$1", $cols[$key]);
			   }
			   $data[] = $cols;
		   // echo print_r($cols, 1);
		}
	  return $data;
	}
	
	public function check_file_type($file)
       {  
               $out=explode(".",$file['name']);
               if(isset($out[1]))
               {
				   $check =  strtolower($out[1]);
				   if($check=="xls"){
						   return 1;
				   }
				   else{ 
                        return 0;
		             }
		      }
		      else
		      {
				  return 0;
			  }
       }

	/**SEND EMAIL COPUONS **/

    public function send_email($deal_id = "", $deal_key = "")
    {
       
        $this->product_deatils = $this->products->get_product_data_mail($deal_key, $deal_id);
        if(count($this->product_deatils) == 0){
                common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
                url::redirect(PATH."admin/manage-products.html");
	}
	if($_POST){
                $this->product_deatils = $this->products->get_product_data_mail($deal_key, $deal_id);
  		$this->userPost = $this->input->post();
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
					$useremail =$this->mail=  $mails[0];
					$username =  $mails[1];
					if(isset($username) && isset($useremail))
						
						$message = " <p> ".$post->message." </p>";
						$message .= new View ("admin_product/mail_product");
						 $this->email_id = $useremail;
                                                $this->name = $username;
                                                $this->message = $message;
                                                $fromEmail = NOREPLY_EMAIL;
                                                $message = new View("themes/".THEME_NAME."/admin_mail_template");
						$fromEmail = NOREPLY_EMAIL;
						if(EMAIL_TYPE==2){
						email::smtp($fromEmail,$useremail,$post->subject,$message);
						}else{
						email::sendgrid($fromEmail,$useremail,$post->subject,$message);
						}
						common::message(1, "Mail Send Successfully");
				}
                                $lastsession = $this->session->get("lasturl");
                                if($lastsession){
                                url::redirect(PATH.$lastsession);
                                } else {
                                url::redirect(PATH."admin/manage-products.html");
                                }
	        }
	        else{
	            $this->form_error = error::_error($post->errors());
	        }
	}
	$this->template->title = $this->Lang["SEND_PRO"];
        $this->template->content = new View("admin_product/send_mail");
    }

	/** SELECT EMAIL UNDER THE USER **/

    public function user_select($users= "")
    {
		if($users == 4){
	        $shoplistlist = $this->products->get_users_data($users);
	        }
	        else if($users == 10){
	        echo $list = '<div class="input-text1 clearfix"><label>Select Email* :</label>
	                	<div class="search-input1"><div class="add_pt">
						<ul>
						<li><span>Select User First</span></li></ul></div></div> </div>'; exit;
	        }

	        if(count($shoplistlist) > 0){
				$list = '<div class="input-text1 clearfix"><label>Select Email* :</label>

	                	<div class="search-input1" ><div class="add_pt">
						<ul>
						<li><input type="checkbox" name="email" onclick="checkboxcheckAll(&#39;newsletter&#39;,&#39;email&#39;)" /><span>Select all</span></li>';
				foreach($shoplistlist as $s){
					$list .= '<li><input type="hidden" name="firstname[]" value="'.$s->firstname.'" /><input type="checkbox" name="email[]" class="case" value="'.$s->email.'__'.$s->firstname.'" /><span>'.$s->email.'</span></li>';
				}
				echo $list .='</ul></div></div></div>';
			}
			exit;
	}

	/** EDIT PRODUCTS **/

	public function edit_product($deal_id = "", $deal_key = "",$preview_type="")
	{
		if(!ADMIN_PRIVILEGES_PRODUCTS_EDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->preview_type = base64_decode($preview_type);
         $deal_id = base64_decode($deal_id);
		$this->manage_product = "1";
	
	        if($_POST){
			$this->userPost = $this->input->post();
			$post = Validation::factory(array_merge($_POST,$_FILES))
				->pre_filter('trim', 'title')
				->add_rules('title', 'required')
				->add_rules('description','required',array($this,'check_required'))
				->add_rules('category', 'required')
				->add_rules('sub_category', 'required')
				->add_rules('sec_category', 'required')
				//->add_rules('price', 'required', 'chars[0-9.]',array($this,'check_price_val_lmi'))
				->add_rules('deal_value', 'required', array($this, 'check_price_lmi_prd'),'chars[0-9.]',array($this,'check_deal_value_lmi'))
				->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]')
				->add_rules('users', 'required')
				->add_rules('stores','required')
				->add_rules('delivery_days','required');
				if($post->validate()){
				    $size_quantity = $this->input->post("size_quantity");
					$status = $this->products->edit_product($deal_id, $deal_key, arr::to_object($this->userPost), $size_quantity,$this->preview_type);
					  if($status == 1 && $deal_key){
							if($_FILES['image']['name'] != "" )
							{
								$i=1;
								foreach(arr::rotate($_FILES['image']) as $files){
								if($files){
									$filename = upload::save($files);
									if($filename!=''){
										if($i==1)
										{
										 $IMG_NAME = $deal_key."_1.png";
										 common::image($filename, 620, 752, DOCROOT.'images/products/1000_800/'.$IMG_NAME);
										 $source_img = $destination_img =  DOCROOT.'images/products/1000_800/'.$IMG_NAME;
										 common::compress($source_img, $destination_img, 90);
										// common::image($filename, PRODUCT_LIST_WIDTH, PRODUCT_LIST_HEIGHT, DOCROOT.'images/products/170_130/'.$IMG_NAME);
										 common::createthumb($filename, DOCROOT.'images/products/170_130/'.$IMG_NAME,PRODUCT_LIST_WIDTH, PRODUCT_LIST_HEIGHT);
										 $source_img = $destination_img =  DOCROOT.'images/products/170_130/'.$IMG_NAME;
										 common::compress($source_img, $destination_img, 90);
										 
										} else { // replace if the 1st image s empty with the next successive image
											for($j=2;$j<=$i;$j++) {
											$IMG_NAME1 = $deal_key."_".$i;
											common::image($filename, 620, 752, DOCROOT.'images/products/1000_800/'.$IMG_NAME1.'.png');
											}
										}
										
										$IMG_NAME1 = $deal_key."_".$i.'.png';
										common::image($filename, 620,752, DOCROOT.'images/products/1000_800/'.$IMG_NAME1);
										common::createthumb($filename, DOCROOT.'images/products/170_130/'.$IMG_NAME1,PRODUCT_LIST_WIDTH, PRODUCT_LIST_HEIGHT);
										$source_img1 = $destination_img1 =  DOCROOT.'images/products/1000_800/'.$IMG_NAME1;
										 common::compress($source_img1, $destination_img1, 90);
										 
										unlink($filename);
									}
								}
								$i++;
								}
							}
							$this->product_deatils = $this->products->get_product_data($deal_key, $deal_id);
					  $store_key =$this->product_deatils->current()->store_url_title;
					  $producturl =$this->product_deatils->current()->url_title;
					  if($this->input->post('status') == 2){
						url::redirect(PATH.$store_key."/product/".$deal_key.'/'.$producturl."/admin-preview.html");
					  }else{
						common::message(1, $this->Lang["PRODUCT_EDIT_SUC"]);
						url::redirect(PATH."admin/manage-products.html");
					  }
							/*common::message(1, $this->Lang["PRODUCT_EDIT_SUC"]);
							$lastsession = $this->session->get("lasturl");
		                                        if($lastsession){
		                                        url::redirect(PATH.$lastsession);
		                                        } else {
		                                        url::redirect(PATH."admin/manage-products.html");
		                                        }*/
					}
					elseif($status == 8){
						common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
						$lastsession = $this->session->get("lasturl");
						if($lastsession){
						url::redirect(PATH.$lastsession);
						} else {
						url::redirect(PATH."admin/manage-products.html");
						}
					}
					$this->form_error["title"] = $this->Lang["PRODUCT_EXIST"];
				}
				else{
					$this->form_error = error::_error($post->errors());
				}
		}

		$this->all_attributes=$this->products->getProductAttributes();
		$prdatr = $this->products->GetAttributes();
		$this->product_attributes = array();
		foreach($prdatr as $a){
			$this->product_attributes [$a->attribute_id]= $a->name ;
		}

		$this->selectproduct_attr = $this->products->get_product_attributes($deal_id);
		$this->selectproduct_policy = $this->products->get_product_policy($deal_id);
		$this->product_color = $this->products->get_product_color($deal_id);
		$this->selectproduct_size = $this->products->get_product_one_size($deal_id);
		$this->category_list = $this->products->get_category_list();
		$this->sub_category_list = $this->products->get_sub_category_list();
		$this->sec_category_list = $this->products->get_sec_category_list();
		$this->third_category_list = $this->products->get_third_category_list();
		$this->get_marchant_list = $this->products->getmarchantlist();
		$this->shop_list = $this->products->get_shop_list();
		$this->color_code = $this->products->get_shipping_product_color();
		$this->product_size = $this->products->get_product_size();
		$this->product = $this->products->get_edit_product($deal_id,$deal_key);
		
		if(($this->product->current()->purchase_count) >= ($this->product->current()->user_limit_quantity) ){
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				$lastsession = $this->session->get("lasturl");
	                        if($lastsession){
	                        url::redirect(PATH.$lastsession);
	                        } else {
	                        url::redirect(PATH."admin/manage-products.html");
	                        }
		}
		$this->shipping_data = $this->products->get_shipping_data($this->product->current()->merchant_id);
		//print_r($this->shipping_data); exit;
		$this->template->title = $this->Lang["EDIT_PRODUCT"];
		$this->template->content = new View("admin_product/edit_products");
	}

	/** BLOCK UNBLOCK PRODUCTS **/

	public function block_product($type = "", $key = "", $deal_id = "")
	{
		if(!ADMIN_PRIVILEGES_PRODUCTS_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->products->blockunblockproduct($type, $key, $deal_id);
		if($status == 1){
	                if($type == 1){
		        common::message(1, $this->Lang["PRODUCT_UNB_SUC"]);
		        } else {
		        common::message(1, $this->Lang["PRODUCT_B_SUC"]);
		        }
		} else {
		        common::message(-1, $this->Lang["PROD_ACTI"]);
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
		url::redirect(PATH.$lastsession);
		} else {
		url::redirect(PATH."admin/manage-products.html");
		}
	}

	/** MANAGE USER COMMENTS **/

	public function manage_users_comments($deal_type = "",$page = "")
	{
		$this->product_comments = 1;
		$count = $this->products->get_users_comments_count($this->input->get('firstname'),$deal_type);
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-product-comments.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $count,
				'items_per_page' => 20,
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->search = $this->input->get();
		$this->search_key = arr::to_object($this->search);
		$this->users_list = $this->products->get_users_comments_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('firstname'),$deal_type);
		$this->template->title = $this->Lang["USER_COMM"];
		$this->template->content = new View("admin_product/manage_users_comments");
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
                                $status = $this->products->edit_users_comments($commentsid, arr::to_object($this->userpost));
                                if($status ==1){
                                        common::message(1, $this->Lang["COMM_SET_SUC"]);
                                        url::redirect(PATH.'admin/manage-product-comments.html');
                                }
                        }
			else{
				$this->form_error = error::_error($post->errors());
			}
		}

		$this->users_comments_data = $this->products->get_users_comments_data($commentsid);
		if(count($this->users_comments_data) == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/manage-product-commants.html");
		}
		$this->template->title = $this->Lang["COMM_MERCHANT"];
		$this->template->content = new View("admin_product/edit_users_comments");
	}

	/** BLOCK AND UNBLOCK USER COMMENTS **/

	public function block_users_comments($type = "", $uid = "")
	{
		if($this->user_type != 1)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->products->blockunblockusercomments($type, $uid);
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
		url::redirect(PATH."admin/manage-product-comments.html");
	}

	/** DELETE USERCOMMENTS **/

	public function delete_users_comments($discussion_id = "")
	{
		if(!ADMIN_PRIVILEGES_PRODUCTS_BLOCK)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$status = $this->products->deleteusercomments($discussion_id);
		if($status == 1){
				common::message(1, $this->Lang["COMM_DEL"]);
			}
		url::redirect(PATH."admin/manage-product-comments.html");
	}

	/** CHECK DISCOUNT PRICE  LESS THAN ORGINAL PRICE **/

	public function check_price_lmi_prd()
	{
		
		if($this->input->post("price")!='')
		{
		if($this->input->post("deal_value")<$this->input->post("price"))
		{
		return 0;
		}
		}
		return 1;
		
	}

	/** CHECK VALID PHONE OR NOT **/

	public function validphone($phone = "")
	{
		if(valid::phone($phone,array(7,10,11,12,13)) == TRUE){
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

	/** SELECT SHOP UNDER STORE **/

    public function shop($users = "")
	{
		if($users == -1){
			$list = '<td><label>Select Shop*</label></td><td><label>:</label></td><td><select name="stores">';
			$list .='<option value=" " > Select Merchant First</option>';
			$list .='</select></td>';
			$list1 = '<td><label>Store Credit </label></td><td><label>:</label></td><td>Select Merchant First</td>';
			echo $list."#".$list1;
			exit;
		} else {
		        $shoplistlist = $this->products->get_store_by_users($users);
		        $list = '<td><label>Select Shop*</label></td>
                            <td><label>:</label></td>
                            <td><select name="stores">';
		        foreach($shoplistlist as $s){
			        $list .='<option value="'.$s->store_id.'">'.ucfirst($s->store_name).'</option>';
		        }
					$list .='</select></td>';
		$this->merchant_duration = $this->products->get_duration_values($users); // store credits options
				$list1 ='<td><label>Store Credit </label></td><td><label>:</label></td><td>';
			if(count($this->merchant_duration)>0) { 
				foreach($this->merchant_duration as $d) {
					$list1 .= '<input type ="checkbox" name="duration[]" value="'.$d->duration_id.','.$d->duration_period.'"/>'.$d->duration_period;
				} 
			} else {
				$list1 .='No Store Credit available ';
			}
			$list1 .='</td>';
			echo $list."#".$list1;
			exit;
		}
	}
	
	
	/** SELECT SHOP UNDER STORE **/

        public function shipping_type($users = "")
	{
		if($users == -1){
			$list = '<label><font size="2" color="red">';
			$list .=$this->Lang["ADMIN_SHIPP_METHODS"];
			$list .='</font> </label>';
			$list .='<script type="text/javascript">
                                        $(document).ready(function(){
                                        $("#check2").hide();
                                });
                        </script>';
                        echo $list .='';
		exit;
		}
		else{
		        $shippinglist = $this->products->get_shipping_data($users);
                        $submit = "0"; 
                        foreach($shippinglist as $ship){ 
                                $free = $ship->free;
                                $flat = $ship->flat;
                                $per_product = $ship->per_product;
                                $per_quantity = $ship->per_quantity;
                                $aramex = $ship->aramex;
                        } 
                                $list ='<table style="border: 1px solid #999; border-collapse: collapse; width:242px;">';             
                                if($this->free_shipping_setting == 1 && $free == 1){ $submit = "1"; 
                                $list .='<tr><td><input type="radio" name="shipping" value="1" onchange="return checkedretailprice(this)">Free Shipping</td></tr>';
                                } if($this->flat_shipping_setting == 1 && $flat == 1){ $submit = "1"; 
                                $list .='<tr><td><input type="radio" name="shipping" value="2" onchange="return checkedretailprice(this)">Flat Shipping</td></tr>';
                                } if($this->per_product_setting == 1 && $per_product == 1){ $submit = "1"; 
                                $list .='<tr><td><input type="radio" name="shipping" value="3"  id="perproduct" onchange="return checkedwholesaleprice(this)">Per product base Shipping</td></tr>';
                                } if($this->per_quantity_setting == 1 && $per_quantity == 1){ $submit = "1";
                                $list .='<tr><td><input type="radio" name="shipping" value="4" id="perquantity" onchange="return checkedwholesaleprice(this)">Per quantity base Shipping</td></tr>';
                                } if($this->aramex_setting == 1 && $aramex == 1){ $submit = "1";
                                $list .='<tr><td><input type="radio" name="shipping" value="5" id="productaramex" onchange="return checkedaramex(this)">Aramex Shipping</td></tr>';
                                }  if($submit == "0"){ 
                                $list .='<tr><td><label><font size="2" color="red">'.$this->Lang["ADMIN_SHIPP_METHODS"].'</font> </label></td></tr>';
                                }
		echo $list .='</table>';
		exit;
		}
	}
	
	public function shipping_type_pro($users = "",$deal_id = "")
	{
		if($users == -1){
			$list = '<label><font size="2" color="red">';
			$list .=$this->Lang["ADMIN_SHIPP_METHODS"];
			$list .='</font> </label>';
			$list .='<script type="text/javascript">
                                        $(document).ready(function(){
                                        $("#check2").hide();
                                });
                        </script>';
                        echo $list .='';
		exit;
		}
		else{
		        $checkproduct = $this->products->get_check_productdata($users,$deal_id);
		        
		        $checked = '';
		        if(count($checkproduct)>0){
		        $checked = $checkproduct->current()->shipping;
		        }     
		         
		        $shippinglist = $this->products->get_shipping_data($users);
                        $submit = "0"; 
                        foreach($shippinglist as $ship){ 
                                $free = $ship->free;
                                $flat = $ship->flat;
                                $per_product = $ship->per_product;
                                $per_quantity = $ship->per_quantity;
                                $aramex = $ship->aramex;
                        } 
                                $list ='<table style="border: 1px solid #999; border-collapse: collapse; width:242px;">';             
                                if($this->free_shipping_setting == 1 && $free == 1){ $submit = "1"; 
                                        if($checked =="1") {
                                                $checked1 = "checked";
                                        }  else {
                                                $checked1 = "";
                                        }  
                                $list .='<tr><td><input type="radio" name="shipping" value="1" onchange="return checkedretailprice(this)" '.$checked1.' >Free Shipping</td></tr>';
                                } if($this->flat_shipping_setting == 1 && $flat == 1){ $submit = "1"; 
                                        if($checked =="2") {
                                                $checked2 = "checked";
                                        }  else {
                                                $checked2 = "";
                                        }  
                                $list .='<tr><td><input type="radio" name="shipping" value="2" onchange="return checkedretailprice(this)" '.$checked2.' >Flat Shipping</td></tr>';
                                } if($this->per_product_setting == 1 && $per_product == 1){ $submit = "1"; 
                                        if($checked =="3") {
                                                $checked3 = "checked";
                                                $list .='<script type="text/javascript">
                                        $(document).ready(function(){
                                        $(".wholesaleprice").show();
                                });
                        </script>';
                                        }  else {
                                                $checked3 = "";
                                        } 
                                $list .='<tr><td><input type="radio" name="shipping" value="3"  id="perproduct" onchange="return checkedwholesaleprice(this)" '.$checked3.'  >Per product base Shipping</td></tr>';
                                } if($this->per_quantity_setting == 1 && $per_quantity == 1){ $submit = "1";
                                        if($checked =="4") {
                                                $checked4 = "checked";
                                                $list .='<script type="text/javascript">
                                        $(document).ready(function(){
                                        $(".wholesaleprice").show();
                                });
                        </script>';
                                        }  else {
                                                $checked4 = "";
                                        }
                                $list .='<tr><td><input type="radio" name="shipping" value="4"  id="perquantity" onchange="return checkedwholesaleprice(this)" '.$checked4.' >Per quantity base Shipping</td></tr>';
                                } if($this->aramex_setting == 1 && $aramex == 1){ $submit = "1";
                                        if($checked =="5") {
                                                $checked5 = "checked";
                                                $list .='<script type="text/javascript">
                                        $(document).ready(function(){
                                        $(".aramexshipping").show();
                                });
                        </script>';
                                                
                                        }  else {
                                                $checked5 = "";
                                        }
                                $list .='<tr><td><input type="radio" name="shipping" value="5" id="productaramex" onchange="return checkedaramex(this)" '.$checked5.'  >Aramex Shipping</td></tr>';
                                }  if($submit == "0"){ 
                                $list .='<tr><td><label><font size="2" color="red">'.$this->Lang["ADMIN_SHIPP_METHODS"].'</font> </label>';
                                }
		echo $list .='</table>';
		exit;
		}
	}

	/** PRODUCT SHIPPING DELIVERY **/

	public function shipping_delivery($page = "")
	{
		if(!ADMIN_PRIVILEGES_TRANSACTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		
                $this->page = $page ==""?1:$page; // for export per page
                $this->shipping_delivery="1";
                $search=$this->input->get("id"); // Export CSV format
                $this->count_shipping = $this->products->get_shipping_count($this->input->get("search"));

				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/shipping-delivery.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $this->count_shipping,
				'items_per_page' => 20,
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->search = $this->input->get();
		$this->search_key = arr::to_object($this->search);
		$this->shipping_list = $this->products->get_shipping_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("search"),"",0);
		if($search =='all'){ // for export all
			$this->shipping_list = $this->products->get_shipping_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("search"),"",1);
		}
		$this->product_size = $this->products->get_shipping_product_size();
		$this->product_color = $this->products->get_shipping_product_color();
		if($_POST){
				$email_id = $this->input->post('email');
				$this->shipping_id = $this->input->post('id');
				$message = $this->input->post('message');
				$message.= new View("admin_product/shipping_mail_template");
				$fromEmail = NOREPLY_EMAIL;
				if(EMAIL_TYPE==2){
				email::smtp($fromEmail,$email_id, SITENAME, $message);
				} else {
				email::sendgrid($fromEmail,$email_id, SITENAME, $message);
				}
				common::message(1, $this->Lang["MAIL_SENDED"]);
				$status = $this->products->update_shipping_status($this->input->post('id'));
				if($status){
					$lastsession = $this->session->get("lasturl");
                                        if($lastsession){
                                        url::redirect(PATH.$lastsession);
                                        } else {
                                        url::redirect(PATH."admin/shipping-delivery.html");
                                        }
				}
		}

		if($search){ // Export in CSV format
				$out = '"S.No","Product Title","Name","Email","Date & Time","Phone Number","Address","Delivery Status"'."\r\n";
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
					header('Content-Disposition: attachment; filename=Product-shipping.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}
		$this->template->title = $this->Lang["SHIP_DEL"];
		$this->template->content = new View("admin_product/shipping_delivery");
	}

	/** PRODUCT CASH ON DELIVERY **/

	public function cash_on_delivery($page = "")
	{
		if(!ADMIN_PRIVILEGES_TRANSACTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->page = $page ==""?1:$page; // for export per page
		$this->url="admin/cash-delivery.html";
		$this->cash_delivery="1";
 	        $search=$this->input->get("id"); // Export CSV format
		$this->count_shipping = $this->products->get_shipping_count($this->input->get("search"),"COD");
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/cash-delivery.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $this->count_shipping,
				'items_per_page' => 20,
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->search = $this->input->get();
		
		$this->search_key = arr::to_object($this->search);
		$this->shipping_list = $this->products->get_shipping_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("search"),"COD",0);
		if($search =='all'){ // for export all
			$this->shipping_list = $this->products->get_shipping_list($this->pagination->sql_offset, $this->pagination->items_per_page,$this->input->get("search"),"COD",1);
		}
		$this->product_size = $this->products->get_shipping_product_size();
		$this->product_color = $this->products->get_shipping_product_color();
		if($_POST){
			$email_id = $this->input->post('email');
			$this->shipping_id = $this->input->post('id');
			$message = $this->input->post('message');
			$message.= new View("admin_product/shipping_mail_template");
			$fromEmail = NOREPLY_EMAIL;
			if(EMAIL_TYPE==2){
			        email::smtp($fromEmail,$email_id, SITENAME, $message);
			}else{
			        email::sendgrid($fromEmail,$email_id, SITENAME, $message);
			}
			common::message(1, $this->Lang["MAIL_SENDED"]);
			$status = $this->products->update_shipping_status($this->input->post('id'));
			if($status){
			        $lastsession = $this->session->get("lasturl");
                                if($lastsession){
                                url::redirect(PATH.$lastsession);
                                } else {
                                url::redirect(PATH."admin/cash-delivery.html");
                                }
			}
		}

		if($search){ // Export in CSV format
				$out = '"S.No","Product Title","Name","Email","Date & Time","Phone Number","Address","Delivery Status"'."\r\n";
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
					header('Content-Disposition: attachment; filename=Product-COD.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}
		$this->template->title = $this->Lang['CASH_ON_DEL'];
		$this->template->content = new View("admin_product/cash_on_delivery");
	}

	/* VALIDATE COUPON */
	public function validate_coupon()
	{
			$coupon = $this->input->get('coupon');
			$amount = base64_decode($this->input->get('amount'));
			$trans_id = base64_decode($this->input->get('trans_id'));
			$coupon_check = $this->products->validate_coupon($coupon,$amount,$trans_id);
			echo $coupon_check; exit;
	}
	/** CHECK MAX USER PURCHACE LIMIT GREATER THEN ZERO**/

	public function check_product_purchace_lmi()
	{
		if(($this->input->post("quantity"))!= '0'){
			return 1;
		}
		return 0;
	}

	/** CHECK PRICE VALUE LIMIT **/
	public function check_price_val_lmi()
	{
		if(($this->input->post("price"))!= '0'){
			return 1;
		}
		return 0;
	}

	/** DEAL VALUE LIMIT **/
	public function check_deal_value_lmi()
	{
		if(($this->input->post("deal_value"))!= '0'){
			return 1;
		}
		return 0;
	}

	/** DASHBOARD PRODUCTS **/
	public function dashboard_products()
	{
		if(!ADMIN_PRIVILEGES_PRODUCTS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->dashboard_products = 1;
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
		$this->transaction_list = $this->products->get_transaction_chart_list();
		$this->deals_transaction_list = $this->products->get_transaction_chart_list();
		$this->deals_dashboard_data = $this->products->get_deals_chart_list();
		$this->template->content = new View("admin_product/products_dashboard");
		$this->template->title = $this->Lang["PRODUCT_DASH"];
	}

	/*MULTIPLE IMAGE DELETE */
	public function delete_product_images()
	{
		
		
		$this->img=$this->input->get("img");
		$this->deal_id=$this->input->get("id");
		$IMG_NAME=base64_decode($this->img);
		$this->deal_key=$this->input->get("deal_key");

	
		$a = explode('_',$IMG_NAME);

		if($a[1] == 1) {
			
			if(file_exists(DOCROOT.'images/products/1000_800/'.$IMG_NAME.'.png')) {
			for($i=2;$i<=5;$i++) {
				$IMG_NAME1 = $this->deal_key."_".$i;
				if(file_exists(DOCROOT.'images/products/1000_800/'.$IMG_NAME1.'.png')) {
				break;
				}

			}
			if(file_exists(DOCROOT.'images/products/1000_800/'.$IMG_NAME1.'.png')) {
			$filename= DOCROOT."images/products/1000_800/".$IMG_NAME1.".png";

			//common::image($filename, PRODUCT_LIST_WIDTH, PRODUCT_LIST_HEIGHT, DOCROOT.'images/products/1000_800/'.$IMG_NAME.'.png');

			}
			
		}
		}
		else{

			for($i=1;$i<=5;$i++) {
				$IMG_NAME1 = $this->deal_key."_".$i;

				if(file_exists(DOCROOT.'images/products/1000_800/'.$IMG_NAME1.'.png')) {
				break;
				}

			}
			if(file_exists(DOCROOT.'images/products/1000_800/'.$IMG_NAME1.'.png')) {

			$filename= DOCROOT."images/products/1000_800/".$IMG_NAME1.".png";

			//common::image($filename, PRODUCT_LIST_WIDTH, PRODUCT_LIST_HEIGHT, DOCROOT.'images/products/1000_800/'.$this->deal_key.'_1.png');

			}
			


		}

	
		if(file_exists(DOCROOT.'images/products/1000_800/'.$IMG_NAME.'.png')) {
			$filename= DOCROOT.'images/products/1000_800/'.$IMG_NAME.'.png';
			unlink($filename);
		}
		
		
		$redir_url = PATH."admin/edit-products/".base64_encode($this->deal_id)."/".$this->deal_key.".html";
		
		/**
		*	Default redirection url is invalid heere.
			Changed it to refer to the one in the SERVER session array.
		*	@Live
		*/
		if(isset($_SERVER['HTTP_REFERER']))
				$redir_url = $_SERVER['HTTP_REFERER'];

		url::redirect($redir_url);
	}

	/* UPDATE STATUS DELIVERY FOR PRODUCT */
	public function update_delivery_status($email_id="",$name="",$type="",$shippingid="")
	{
	        
		$this->shipping_id=$shippingid;
		$this->shipping_list = $this->products->get_shipping_list1();
		$this->product_size = $this->products->get_shipping_product_size();
		$this->product_color = $this->products->get_shipping_product_color();
		$status = $this->products->update_shipping_status($shippingid,$type);
		if($type==4) {

						$message = "Thank You For Your Purchase";
						$message.= new View("admin_product/shipping_mail_template");
						
						 $this->email_id = $email_id;
                                                $this->name = $this->Lang["CUST"];
                                                $this->message = $message;
                                                $fromEmail = NOREPLY_EMAIL;
                                                $message = new View("themes/".THEME_NAME."/admin_mail_template");

						$fromEmail = NOREPLY_EMAIL;
						if(EMAIL_TYPE==2){
							email::smtp($fromEmail,$email_id, SITENAME, $message);
						}else{
							email::sendgrid($fromEmail,$email_id, SITENAME, $message);
						}
						common::message(1, $this->Lang["MAIL_SENDED"]);
					}

			if($status){
						common::message(1, $this->Lang['STA_UPD']);
						$lastsession = $this->session->get("lasturl");
		                                if($lastsession){
		                                url::redirect(PATH.$lastsession);
		                                } else {
		                                url::redirect(PATH."admin/shipping-delivery.html");
		                                }
					}


	}

	/* UPDATE COD STATUS DELIVERY FOR PRODUCT */
	public function update_cod_delivery_status($email_id="",$name="",$type="",$shippingid="",$trans_id=0,$pro_id=0,$merchant_id=0)
	{
		$this->shipping_id=$shippingid;
		$this->shipping_list = $this->products->get_shipping_list1();
		$this->product_size = $this->products->get_shipping_product_size();
		$this->product_color = $this->products->get_shipping_product_color();
		$status = $this->products->update_cod_shipping_status($shippingid,$type,$trans_id,$pro_id,$merchant_id);
		if($type==4) {

						$message = "Thank You For Your Purchase";
						$message.= new View("admin_product/shipping_mail_template");
						
						 $this->email_id = $email_id;
                                                $this->name = $this->Lang["CUST"];
                                                $this->message = $message;
                                                $fromEmail = NOREPLY_EMAIL;
                                                $message = new View("themes/".THEME_NAME."/admin_mail_template");

						$fromEmail = NOREPLY_EMAIL;
						if(EMAIL_TYPE==2){
							email::smtp($fromEmail,$email_id, SITENAME, $message);
						}else{
							email::sendgrid($fromEmail,$email_id, SITENAME, $message);
						}
						common::message(1, $this->Lang["MAIL_SENDED"]);
					}

					if($status){
						common::message(1, $this->Lang['STA_UPD']);
						$lastsession = $this->session->get("lasturl");
		                                if($lastsession){
		                                url::redirect(PATH.$lastsession);
		                                } else {
		                                url::redirect(PATH."admin/cash-delivery.html");
		                                }
						
					}


	}

	public function check_required($val = "")
	{
		if(strip_tags($val) == "") return 0;return 1;
	}

	/*MANAGE HOT PRODUCTS */

		public function popular_list($product="",$type="")
		{
			$this->popular_product_list = $this->products->get_hot_product_list($product,$type);
			exit;
		}
		
		
        public function Aramex_request($shipping_id = ""){

        
        //file_put_contents("shipping_pdf"$shipping_id."-shipping-pdf.pdf", file_get_contents("http://www.pdf995.com/samples/pdf.pdf"));
        
        $shipping  = $this->products->get_shipping_info($shipping_id);

        //print_r($shipping);exit;

                foreach($shipping as $ship){

                        //echo $ship->curren_code; exit;
                        error_reporting(E_ALL);
                        ini_set('display_errors', '1');

                        $soapClient = new SoapClient('shipping-services-api-wsdl.wsdl');
                        echo '<pre>';
                        print_r($soapClient->__getFunctions()); 

                $params = array(
                        'Shipments' => array(
                                'Shipment' => array(
                                        'Shipper'	=> array(
                                                'Reference1' 	                => 'Ref1'.$ship->shipping_id,
                                                'AccountNumber'               => '4004234',
                                                'PartyAddress'	=> array(
                                                        'Line1'				=> '15 ABC St',
                                                        'Line2' 				=> '',
                                                        'Line3' 				=> '',
                                                        'City'					=> 'Riyadh',
                                                        'StateOrProvinceCode'	=> '',
                                                        'PostCode'				=> '543543',
                                                        'CountryCode'			=> 'SA'
                                                ),
                                                'Contact'		=> array(
                                                        'Department'			=> '',
                                                        'PersonName'			=> 'Marketty ',
                                                        'Title'				=> '',
                                                        'CompanyName'		=> 'Marketty',
                                                        'PhoneNumber1'		=> '966505289659',
                                                        'PhoneNumber1Ext'		=> '125',
                                                        'PhoneNumber2'		=> '966506276344',
                                                        'PhoneNumber2Ext'		=> '',
                                                        'FaxNumber'			=> '',
                                                        'CellPhone'			=> '966505289659',
                                                        'EmailAddress'			=> 'marketty.net@gmail.com',
                                                        'Type'				=> ''
                                                ),
                                        ),

                                        'Consignee'	=> array(
                                                'Reference1'	                        => 'Ref1'.$ship->shipping_id,
                                                'AccountNumber'                       => '',
                                                'PartyAddress'	=> array(
                                                        'Line1'				=> "Deal & More s.a.r.l, Bassam Arnaout",
                                                        'Line2'				=> "Jisr Al Basha  Al-Basha Center.",
                                                        'Line3'				=> '',
                                                        'City'					=> "Beirut",
                                                        'StateOrProvinceCode'	=> '',
                                                        'PostCode'				=>  "256262",
                                                        //'CountryCode'		=> $ship->country_code
                                                        'CountryCode'			=> 'LB'
                                                ),

                                                'Contact'		=> array(
                                                'Department'			        => '',
                                                'PersonName'			        => $ship->name,
                                                'Title'					=> '',
                                                'CompanyName'			=> $ship->name,
                                                'PhoneNumber1'			=> $ship->phone,
                                                'PhoneNumber1Ext'		        => '155',
                                                'PhoneNumber2'			=> '',
                                                'PhoneNumber2Ext'		        => '',
                                                'FaxNumber'				=> '',
                                                'CellPhone'				=> $ship->phone,
                                                'EmailAddress'			        => 'dd@gmail.com',
                                                'Type'					=> ''
                                                ),
                                        ),

                                        'ThirdParty' => array(
                                                'Reference1' 	                        => '',
                                                'Reference2' 	                        => '',
                                                'AccountNumber'                       => '',
                                                'PartyAddress'	=> array(
                                                        'Line1'				=> '',
                                                        'Line2'				=> '',
                                                        'Line3'				=> '',
                                                        'City'					=> '',
                                                        'StateOrProvinceCode'	=> '',
                                                        'PostCode'				=> '',
                                                        'CountryCode'			=> ''
                                                ),
                                                'Contact'		=> array(
                                                        'Department'			=> '',
                                                        'PersonName'			=> '',
                                                        'Title'				=> '',
                                                        'CompanyName'		=> '',
                                                        'PhoneNumber1'		=> '',
                                                        'PhoneNumber1Ext'		=> '',
                                                        'PhoneNumber2'		=> '',
                                                        'PhoneNumber2Ext'		=> '',
                                                        'FaxNumber'			=> '',
                                                        'CellPhone'			=> '',
                                                        'EmailAddress'			=> '',
                                                        'Type'				=> ''							
                                                ),
                                        ),

                                        'Reference1' 				=> 'Shpt1'.$ship->shipping_id,
                                        'Reference2' 				=> '',
                                        'Reference3' 				=> '',
                                        'ForeignHAWB'				=> '4563456150',
                                        'TransportType'				=> 0,
                                        'ShippingDateTime' 			=> time(),
                                        'DueDate'					=> time(),
                                        'PickupLocation'			=> 'Reception',
                                        'PickupGUID'				=> '',
                                        'Comments'				=> 'Shpt 0001',
                                        'AccountingInstrcutions' 	        => '',
                                        'OperationsInstructions'	        => '',

                                        'Details' => array(
                                                'Dimensions' => array(
                                                        'Length'				=> "4",
                                                        'Width'				=> "4",
                                                        'Height'				=> "5",
                                                        'Unit'				=> 'cm',

                                                ),

                                                'ActualWeight' => array(
                                                        'Value'				=> "2",
                                                        'Unit'				=> 'Kg'
                                                ),

                                                'ProductGroup' 		=> 'EXP',
                                                'ProductType'			=> 'PDX',
                                                'PaymentType'			=> 'P',
                                                'PaymentOptions' 		=> '',
                                                'Services'				=> '',
                                                'NumberOfPieces'		=> 1,
                                                'DescriptionOfGoods' 	=> 'Docs',
                                                'GoodsOriginCountry' 	=> 'Jo',

                                                'CashOnDeliveryAmount' 	=> array(
                                                        'Value'				=> 0,
                                                        'CurrencyCode'			=> ''
                                                ),

                                                'InsuranceAmount'		=> array(
                                                        'Value'				=> 1,
                                                        'CurrencyCode'			=> $ship->curren_code
                                                ),

                                                'CollectAmount'			=> array(
                                                        'Value'				=> 1,
                                                        'CurrencyCode'			=> $ship->curren_code
                                                ),

                                                'CashAdditionalAmount'	=> array(
                                                        'Value'				=> 1,
                                                        'CurrencyCode'			=> $ship->curren_code							
                                                ),

                                                'CashAdditionalAmountDescription' => '',

                                                'CustomsValueAmount' => array(
                                                        'Value'				=> $ship->amount,
                                                        'CurrencyCode'			=> $ship->curren_code								
                                                ),
                                                'Items' 				=> array(

                                                )
                                        ),
                                ),
                        ),

                        'ClientInfo'  			=> array(
                        'AccountCountryCode'	=> 'SA',
                        'AccountEntity'		 	=> 'RUH',
                        'AccountNumber'		=> '4004234',
                        'AccountPin'		 	=> '543543',
                        'UserName'			=> 'marketty.net@gmail.com',
                        'Password'			=> '1016842823As',
                        'Version'			 	=> 'v1.0'
                        ),

                        'Transaction' 			=> array(
                        'Reference1'			=> 'Shpt1'.$ship->shipping_id,
                        'Reference2'			=> '', 
                        'Reference3'			=> '', 
                        'Reference4'			=> '', 
                        'Reference5'			=> '',									
                        ),
                        'LabelInfo'			=> array(
                        'ReportID' 			=> 9201,
                        'ReportType'			=> 'URL',
                        ),
                );

                $params['Shipments']['Shipment']['Details']['Items'][] = array(
                        'PackageType' 	=> 'Box',
                        'Quantity'		=> 1,
                        'Weight'		=> array(
                        'Value'		=> 0.5,
                        'Unit'		=> 'Kg',		
                ),
                
                'Comments'		=> 'Docs',
                'Reference'		=> ''
                );
               // print_r($params);exit;
                        try {
                                $auth_call = $soapClient->CreateShipments($params);
                                echo '<pre>';
                                $k =  $auth_call->HasErrors;
                                if($k == '') {
                                        foreach($auth_call->Shipments as $s){
                                                $tracking =  $s->ID;
                                                $downloadurl = $auth_call->Shipments->ProcessedShipment->ShipmentLabel->LabelURL;
                                                $pdf = file_get_contents($downloadurl);
                                                $file = DOCROOT.'images/shipping_pdf/'.$shipping_id."-shipping-pdf.pdf";
                                                file_put_contents($file, $pdf);
                                        }
                                        if($tracking!= '') {
                                                $status = $this->products->tracking($shipping_id,$tracking);
                                                if($status == 1) {
                                                common::message(1, "Shipment added successfully Tracking Id :".$tracking);
                                                url::redirect(PATH.'admin/shipping-delivery.html');
                                                }
                                        }
                                } else {
                                common::message(-1, "Hash Error Occured");
                                url::redirect(PATH.'admin/shipping-delivery.html');
                                }
                                die();
                        } catch (SoapFault $fault) {
                                die('Error : ' . $fault->faultstring);
                        }
                }
        }
        
       
        
     public function storecredit_transaction($type="",$page="") 
	{
		if(!ADMIN_PRIVILEGES_STORECREDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->mer_products_act="1";
		$this->storecredit = "1";
		if($type == "Success"){
			$this->status ="2";
			$base_URL = $this->base= 'admin-products/storecredit/success-transaction.html/page/'.$page."/";
			$this->sort_url= PATH.'admin-products/storecredit/success-transaction.html?';
		}elseif($type == "Failed"){
			$this->status ="3";
			$base_URL = $this->base= 'admin-products/storecredit/failed-transaction.html/page/'.$page."/";
			$this->sort_url= PATH.'admin-products/storecredit/failed-transaction.html?';
		}elseif($type == "Purchased"){
			$this->status ="4";
			$base_URL = $this->base= 'admin-products/storecredit/purchase-transaction.html/page/'.$page."/";
			$this->sort_url= PATH.'admin-products/storecredit/purchase-transaction.html?';
		}else{
			$this->status ="1";
			$base_URL = $this->base= 'admin-products/storecredit/pending-transaction.html/page/'.$page."/";
			$this->sort_url= PATH.'admin-products/storecredit/pending-transaction.html?';
		}
		$this->url=$base_URL;
		$this->search_key = $this->input->get('name');
		$this->count_storecredit_list = $this->products->count_transaction_storecredit_list($this->status,$this->search_key);
		$this->pagination = new Pagination(array(
			'base_url'       => $base_URL,
			'uri_segment'    => 4,
			'total_items'    => $this->count_storecredit_list,
			'items_per_page' => 25,
			'style'          => 'digg',
			'auto_hide'      => TRUE
		));
		$this->storecredit_list = $this->products->get_transaction_storecredit_list($this->status,$this->search_key,$this->pagination->sql_offset,$this->pagination->items_per_page);
		$this->template->title = $this->Lang["STR_CRD_ORD"];
		$this->template->content = new View("admin_product/storecredit_delivery");
		
	}
        
}
