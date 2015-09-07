<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_payment_Controller extends website_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id && ($this->user_type != 1 || $this->user_type != 7)) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		}
		  
		$this->payment= new Admin_payment_Model();
		$this->transactions_act ="1";
	}

	/*** ADMIN PAYMENT***/

	public function index($field = "", $type = "", $page = "" )
	{
		if(!ADMIN_PRIVILEGES_FUNDREQUEST)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
                $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
	        $this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->page = $page ==""?1:$page; // for export per page
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $search=$this->input->get("id");
                $this->today = $this->input->get("today");
	        $this->startdate  = $this->input->get("startdate");
	        $this->enddate  = $this->input->get("enddate");	
	        $this->date_range = isset($_GET['date_range'])?1:0;
	        $this->more_action = "";
 	        $search=$this->input->get("id"); // Export CSV format
		if($field == "request_status" && $type == 2){
		 	$this->approved_fund = "1";
	        $this->more_action = 'message';
			$this->template->title = $this->Lang["WITH_DRAW_APP"];
			$base_URL = $this->base = 'admin/approved-fund-request/page/'.$page."/";
			$this->sort_url= PATH.'admin/approved-fund-request.html?';
		}
		elseif($field == "request_status" && $type == 3){
			$this->reject_fund = "1";
			$this->template->title = $this->Lang["WITH_DRAW_REG"];
			$base_URL = $this->base = 'admin/reject-fund-request/page/'.$page."/";
			$this->sort_url= PATH.'admin/reject-fund-request.html?';
		}
		elseif( $field == "payment_status" && $type == 1){
			$this->success_fund = "1";
			$this->template->title = $this->Lang["WITH_DRAW_SUCC"];
			$base_URL = $this->base = 'admin/success-fund-request/page/'.$page."/";
			$this->sort_url= PATH.'admin/success-fund-request.html?';
		}
		elseif( $field == "payment_status" && $type == 2){
			$this->failed_fund = "1";
		        $this->more_action = 'message';
			$this->template->title = $this->Lang["WITH_DRAW_FAIL"];
			$base_URL = $this->base = 'admin/failed-fund-request/page/'.$page."/";
			$this->sort_url= PATH.'admin/failed-fund-request.html?';
		} else {
			$this->all_fund = "1";
			$this->more_action = 'require';
			$this->template->title = $this->Lang["ALL_WITH_DRAW"];
			$base_URL = $this->base = 'admin/all-fund-request/page/'.$page."/";
			$this->sort_url= PATH.'admin/all-fund-request.html?';
		}

		$this->search_key =  $this->input->get('name');
		$this->count_fund_request_list = $this->payment->count_fund_request_list($field, $type,$this->search_key,$this->today,$this->startdate,$this->enddate);
		$this->pagination = new Pagination(array(
			'base_url'       => $base_URL,
			'uri_segment'    => 4,
			'total_items'    => $this->count_fund_request_list,
			'items_per_page' => 20,
			'style'          => 'digg',
			'auto_hide'      => TRUE
		));

		$this->balance = $this->payment->get_admin_balance();
		$this->fund_request_list = $this->payment->get_fund_request_list($field, $type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,0,$this->today,$this->startdate,$this->enddate);

		if($search == 'all'){ // Export all in CSV format
			$this->fund_request_list = $this->payment->get_fund_request_list($field, $type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,1,$this->today,$this->startdate,$this->enddate);
		}

		if($search){ // Export in CSV format
				$out = '"S.No","Merchant Name","Email","Request Amount('.CURRENCY_SYMBOL.')","Date","Status"'."\r\n";
				$i=0;
				$first_item = $this->pagination->current_first_item;
				foreach($this->fund_request_list as $u)
				{

					 if($u->payment_status==1){ $tran_type = $this->Lang["SUCCESS"]; }
		   			 if($u->payment_status==2){ $tran_type = $this->Lang["FAILURE"]; }
				     if($u->request_status==3){ $tran_type = $this->Lang["REJECTED"]; }
				     if($u->request_status==1){ $tran_type = $this->Lang["PENDING"]; }

					$out .= $i+$first_item.',"'.$u->firstname.'","'.$u->email.'","'.$u->amount.'","'.date('d-M-Y h:i:s A',$u->date_time).'","'.$tran_type.'"'."\r\n";
					$i++;

				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=Admin-Fund-Request.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}

		$this->template->content = new View("payment/payment");


	}

	/*** ADMIN PAYMENT SUCCESS ***/

	public function admin_payment_success($request_id = "", $user_id = "", $type = "")
	{
		$users_details = $this->payment->get_users_details($request_id, $user_id);
		$users_details_amount = $this->payment->get_users_details_amount($request_id, $user_id);

		if($users_details == 0){
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		else{
			$account_balance = $users_details_amount->current()->merchant_account_balance;
			$request_amount = $users_details_amount->current()->amount;
			$total_amount = $account_balance + $request_amount;
			if($type == 2){
				exit;
				$status = $this->payment->update_fund_request_status($request_id, $user_id, 2,1);
				common::message(1, $this->Lang["WITHD_SUCC"]);
			}
			elseif($type == 3){
				$status = $this->payment->update_fund_request_status($request_id, $user_id, 3,0, $total_amount,'');
				common::message(1, $this->Lang["WITHD_REJ"]);

			}
		}
		$lastsession = $this->session->get("lasturl");
                if($lastsession){
                url::redirect(PATH.$lastsession);
                } else {
                url::redirect(PATH.'admin/all-fund-request.html');
                }
		
	}



	/*** UPDATE FUND REQUEST ***/

	public function message_fund_update($request_id = "", $user_id = "")
	{
		$this->users_details_amount = $this->payment->get_users_details_error_message($request_id, $user_id);
		$this->template->title = $this->Lang["FAIL_FUND_REQ"];
		$this->template->content = new View("payment/payment_message");
	}


	/*** ADMIN TRANSACTION***/

	public function admin_transaction($type = "", $page = "" )
	{
		if(!ADMIN_PRIVILEGES_TRANSACTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
	        $this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->page = $page ==""?1:$page; // for export per page
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $search=$this->input->get("id");
                $this->today = $this->input->get("today");
	        $this->startdate  = $this->input->get("startdate");
	        $this->enddate  = $this->input->get("enddate");	
	        $this->date_range = isset($_GET['date_range'])?1:0;
		$this->deal_trans = 1;

			if($type == "Completed"){
				$this->template->title = "Deals ".$this->Lang["COMP_TRAN"];
				$base_URL = $this->base = 'admin/completed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin/completed-transaction.html?';
			}
			elseif($type == "Faild"){
				$this->template->title = "Deals ".$this->Lang["FAI_TRAN"];
				$base_URL = $this->base = 'admin/failed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin/failed-transaction.html?';
			}
			elseif($type == "Pending"){
				$this->template->title = "Deals ".$this->Lang["HOLD_TRAN"];
				$base_URL = $this->base = 'admin/hold-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin/hold-transaction.html?';
			}
			else if ($type == "Success"){
				$this->template->title = "Deals ".$this->Lang["SUCC_TRAN"];
				$base_URL = $this->base = 'admin/success-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin/success-transaction.html?';
			}
			else{
				$this->template->title = "Deals ".$this->Lang["ALL_TRAN"];
				$base_URL = $this->base = 'admin/all-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin/all-transaction.html?';
			}

		$this->search_key =  $this->input->get('name');
		$this->count_transaction_list = $this->payment->count_transaction_deal_list($type,$this->search_key,$this->type,$this->sort,"",$this->today,$this->startdate,$this->enddate);

		$this->pagination = new Pagination(array(
			'base_url'       => $base_URL,
			'uri_segment'    => 4,
			'total_items'    => $this->count_transaction_list,
			'items_per_page' => 25,
			'style'          => 'digg',
			'auto_hide'      => TRUE
		));

		$this->transaction_list = $this->payment->get_transaction_deal_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,$this->type,$this->sort,'',0,$this->today,$this->startdate,$this->enddate);

		if($search =='all'){  // for export all
				$this->transaction_list = $this->payment->get_transaction_deal_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,$this->type,$this->sort,'',1,$this->today,$this->startdate,$this->enddate);
		}
		if($search){  // Export in CSV format
			$out = '"S.No","Name","Deal Title","Quantity","Amount('.CURRENCY_SYMBOL.')","Referral Amount('.CURRENCY_SYMBOL.')","Admin Commission('.CURRENCY_SYMBOL.')","Status","Transaction Date & Time","Transaction Type"'."\r\n";
			$i=0;
			$first_item = $this->pagination->current_first_item;
			foreach($this->transaction_list as $u)
			{

                                if($u->payment_status=="SuccessWithWarning"){ $tran_type = $this->Lang["SUCCESS"]; }
                                if($u->payment_status=="Completed"){ $tran_type = $this->Lang["COMPLETED"]; }
                                if($u->payment_status=="Success"){ $tran_type = $this->Lang["SUCCESS"]; }
                                if($u->payment_status=="Pending"){$tran_type = $this->Lang["PENDING"];}
                                if($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }
                                if($u->type=="1"){ $tran_type1 = $this->Lang["PAYPAL_CREDIT"]; }
                                if($u->type=="2"){ $tran_type1 = $this->Lang["PAYPAL"]; }
                                if($u->type=="3"){ $tran_type1 = $this->Lang["REF_PAYMENT"]; }
                                if($u->type=="4"){ $tran_type1 = "Authorize.net(".$u->transaction_type.")"; }

				$out .= $i+$first_item.',"'.$u->firstname.'","'.$u->deal_title.'","'.$u->quantity.'","'.($u->deal_value-($u->deal_value *($u->deal_merchant_commission/100)))*$u->quantity.'","'.$u->referral_amount.'","'.($u->deal_value *($u->deal_merchant_commission/100))*$u->quantity.'","'.$tran_type.'","'.date('d-M-Y h:i:s A',$u->transaction_date).'","'.$tran_type1.'"'."\r\n";
				$i++;

				}
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=Deal-Transactions.xls');
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				echo "\xEF\xBB\xBF"; // UTF-8 BOM
				echo $out;
				exit;
			}

		$this->template->content = new View("payment/transaction");

        }

        /*** ADMIN TRANSACTION***/

	public function deal_cod_transaction($type = "", $page = "" )
	{
		if(!ADMIN_PRIVILEGES_TRANSACTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
                $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
	        $this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->page = $page ==""?1:$page; // for export per page
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $search=$this->input->get("id");
                $this->today = $this->input->get("today");
	        $this->startdate  = $this->input->get("startdate");
	        $this->enddate  = $this->input->get("enddate");	
	        $this->date_range = isset($_GET['date_range'])?1:0;
		$this->deal_cod_trans = 1;
		
			if($type == "Completed"){
				$this->template->title = $this->Lang["DEAL_COD"]." ".$this->Lang["COMP_TRAN"];
				$base_URL = $this->base = 'admin-deal-cod/completed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-deal-cod/completed-transaction.html?';
			}
			elseif($type == "Faild"){
				$this->template->title = $this->Lang["DEAL_COD"]." ".$this->Lang["FAI_TRAN"];
				$base_URL = $this->base = 'admin-deal-cod/failed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-deal-cod/failed-transaction.html?';
			}
			elseif($type == "Pending"){
				$this->template->title = $this->Lang["DEAL_COD"]." ".$this->Lang["HOLD_TRAN"];
				$base_URL = $this->base = 'admin/hold-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin/hold-transaction.html?';
			}
			else if ($type == "Success"){
				$this->template->title = $this->Lang["DEAL_COD"]." ".$this->Lang["SUCC_TRAN"];
				$base_URL = $this->base = 'admin-deal-cod/success-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-deal-cod/success-transaction.html?';
			}
			else{
				$this->template->title = $this->Lang["DEAL_COD"]." ".$this->Lang["ALL_TRAN"];
				$base_URL = $this->base = 'admin-deal-cod/all-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-deal-cod/all-transaction.html?';
			}

		$this->search_key =  $this->input->get('name');
		$this->count_transaction_list = $this->payment->count_transaction_deal_list($type,$this->search_key,$this->type,$this->sort,5,$this->today,$this->startdate,$this->enddate);

		$this->pagination = new Pagination(array(
			'base_url'       => $base_URL,
			'uri_segment'    => 4,
			'total_items'    => $this->count_transaction_list,
			'items_per_page' => 25,
			'style'          => 'digg',
			'auto_hide'      => TRUE
		));

		$this->cod_transaction_list = $this->payment->get_transaction_deal_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,$this->type,$this->sort,5,0,$this->today,$this->startdate,$this->enddate);

		if($search =='all'){  // for export all
				$this->cod_transaction_list = $this->payment->get_transaction_deal_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,$this->type,$this->sort,5,1,$this->today,$this->startdate,$this->enddate);
		}
		if($search){ // Export in CSV format
				$out = '"S.No","Name","Deal Title","Quantity","Amount('.CURRENCY_SYMBOL.')","Referral Amount('.CURRENCY_SYMBOL.')","Admin Commission('.CURRENCY_SYMBOL.')","Status","Transaction Date & Time"'."\r\n";
				$i=0;
				$first_item = $this->pagination->current_first_item;
				foreach($this->cod_transaction_list as $u)
				{

					 if($u->payment_status=="SuccessWithWarning"){ $tran_type = $this->Lang["SUCCESS"]; }
		   			 if($u->payment_status=="Completed"){ $tran_type = $this->Lang["COMPLETED"]; }
				     if($u->payment_status=="Success"){ $tran_type = $this->Lang["SUCCESS"]; }
				     if($u->payment_status=="Pending"){$tran_type = $this->Lang["PENDING"];}
				     if($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }


					$out .= $i+$first_item.',"'.$u->firstname.'","'.$u->deal_title.'","'.$u->quantity.'","'.($u->deal_value-($u->deal_value *($u->deal_merchant_commission/100)))*$u->quantity.'","'.$u->referral_amount.'","'.($u->deal_value *($u->deal_merchant_commission/100))*$u->quantity.'","'.$tran_type.'","'.date('d-M-Y h:i:s A',$u->transaction_date).'"'."\r\n";
					$i++;

				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=Deal-COD-Transactions.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}

		$this->template->content = new View("payment/deal_cod_transaction");

        }

		/*** PRODUCT TRANSACTION***/

	public function product_transaction($type = "", $page = "" )
	{
		if(!ADMIN_PRIVILEGES_TRANSACTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
                $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
	        $this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->page = $page ==""?1:$page; // for export per page
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $search=$this->input->get("id");
                $this->today = $this->input->get("today");
	        $this->startdate  = $this->input->get("startdate");
	        $this->enddate  = $this->input->get("enddate");	
	        $this->date_range = isset($_GET['date_range'])?1:0;
		$this->pro_trans = 1;
			if($type == "Success"){
				$this->template->title = "Products ".$this->Lang["SUCC_TRAN"];
				$base_URL = $this->base = 'admin-product/success-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-product/success-transaction.html?';
			}
			elseif($type == "Completed"){
				$this->template->title = "Products ".$this->Lang["COMP_TRAN"];
				$base_URL = $this->base = 'admin-product/completed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-product/completed-transaction.html?';
			}
			elseif($type == "Failed"){
				$this->template->title = "Products ".$this->Lang["FAI_TRAN"];
				$base_URL = $this->base = 'admin-product/failed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-product/failed-transaction.html?';
			}
			elseif($type == "Pending"){
				$this->template->title = "Products ".$this->Lang["HOLD_TRAN"];
				$base_URL = $this->base = 'admin-product/hold-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-product/hold-transaction.html?';
			}
			else{
				$this->template->title = "Products ".$this->Lang["ALL_TRAN"];
				$base_URL = $this->base = 'admin-product/all-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-product/all-transaction.html?';
			}
		$this->search_key =  $this->input->get('name');
		$this->count_transaction_list = $this->payment->count_transaction_list($type,$this->search_key,2,$this->type,$this->sort," ",$this->today,$this->startdate,$this->enddate);

		$this->pagination = new Pagination(array(
			'base_url'       => $base_URL,
			'uri_segment'    => 4,
			'total_items'    => $this->count_transaction_list,
			'items_per_page' => 25,
			'style'          => 'digg',
			'auto_hide'      => TRUE
		));

		$this->product_transaction_list = $this->payment->get_transaction_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,2,$this->type,$this->sort,"",0,$this->today,$this->startdate,$this->enddate);

			if($search == 'all'){ // for export all
				$this->product_transaction_list = $this->payment->get_transaction_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,2,$this->type,$this->sort,"",1,$this->today,$this->startdate,$this->enddate);
			}
			if($search){ // Export in CSV format
				$out = '"S.No","Name","Deal Title","Quantity","Amount('.CURRENCY_SYMBOL.')","Admin Commission('.CURRENCY_SYMBOL.')","Shipping Amount('.CURRENCY_SYMBOL.')","Status","Transaction Date & Time","Transaction Type"'."\r\n";
				$i=0;
				$first_item = $this->pagination->current_first_item;
				foreach($this->product_transaction_list as $u)
				{

					 if($u->payment_status=="SuccessWithWarning"){ $tran_type = $this->Lang["SUCCESS"]; }
		   			 if($u->payment_status=="Completed"){ $tran_type = $this->Lang["COMPLETED"]; }
				     if($u->payment_status=="Success"){ $tran_type = $this->Lang["SUCCESS"]; }
				     if($u->payment_status=="Pending"){$tran_type = $this->Lang["PENDING"];}
				     if($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }

					 if($u->type=="1"){ $tran_type1 = $this->Lang["PAYPAL_CREDIT"]; }
					 if($u->type=="2"){ $tran_type1 = $this->Lang["PAYPAL"]; }
					 if($u->type=="3"){ $tran_type1 = $this->Lang["REF_PAYMENT"]; }
					 if($u->type=="4"){ $tran_type1 = "Authorize.net(".$u->transaction_type.")"; }

					$out .= $i+$first_item.',"'.$u->firstname.'","'.$u->deal_title.'","'.$u->quantity.'","'.($u->deal_value-($u->deal_value *($u->deal_merchant_commission/100)))*$u->quantity.'","'.($u->deal_value *($u->deal_merchant_commission/100))*$u->quantity.'","'.$u->shippingamount.'","'.$tran_type.'","'.date('d-M-Y h:i:s A',$u->transaction_date).'","'.$tran_type1.'"'."\r\n";
					$i++;

				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=Product-Transactions.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}

		$this->template->content = new View("payment/product_transaction");

        }

	/*** CASH ON DELIVERY TRANSACTION***/

	public function cod_transaction($type = "", $page = "" )
	{
		if(!ADMIN_PRIVILEGES_TRANSACTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
                $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
	        $this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->page = $page ==""?1:$page; // for export per page
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $search=$this->input->get("id");
                $this->today = $this->input->get("today");
	        $this->startdate  = $this->input->get("startdate");
	        $this->enddate  = $this->input->get("enddate");	
	        $this->date_range = isset($_GET['date_range'])?1:0;
		$this->cod_trans = 1;
			if($type == "Completed"){
				$this->template->title = "Products COD ".$this->Lang["COMP_TRAN"];
				$base_URL = $this->base = 'admin-cod/success-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod/success-transaction.html?';
			}
			elseif($type == "Failed"){
				$this->template->title = "Products COD ".$this->Lang["FAI_TRAN"];
				$base_URL = $this->base = 'admin-cod/failed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod/failed-transaction.html?';
			}
			elseif($type == "Pending"){
				$this->template->title = "Products COD ".$this->Lang["HOLD_TRAN"];
				$base_URL = $this->base = 'admin-cod/hold-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod/hold-transaction.html?';
			}
			else{
				$this->template->title = "Products COD ".$this->Lang["ALL_TRAN"];
				$base_URL = $this->base = 'admin-cod/all-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod/all-transaction.html?';
			}

		$this->search_key =  $this->input->get('name');
		$this->count_transaction_list = $this->payment->count_transaction_list($type,$this->search_key,2,$this->type,$this->sort,5,$this->today,$this->startdate,$this->enddate);

		$this->pagination = new Pagination(array(
			'base_url'       => $base_URL,
			'uri_segment'    => 4,
			'total_items'    => $this->count_transaction_list,
			'items_per_page' => 25,
			'style'          => 'digg',
			'auto_hide'      => TRUE
		));

		$this->cod_transaction_list = $this->payment->get_transaction_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,2,$this->type,$this->sort,5,0,$this->today,$this->startdate,$this->enddate);

		if($search == 'all'){ // Export in CSV format
			$this->cod_transaction_list = $this->payment->get_transaction_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,2,$this->type,$this->sort,5,1,$this->today,$this->startdate,$this->enddate);
		}
			if($search){ // Export in CSV format
				$out = '"S.No","Name","Deal Title","Quantity","Amount('.CURRENCY_SYMBOL.')","Admin Commission('.CURRENCY_SYMBOL.')","Shipping Amount('.CURRENCY_SYMBOL.')","Status","Transaction Date & Time"'."\r\n";
				$i=0;
				$first_item = $this->pagination->current_first_item;
				foreach($this->cod_transaction_list as $u)
				{

					 if($u->payment_status=="SuccessWithWarning"){ $tran_type = $this->Lang["SUCCESS"]; }
		   			 if($u->payment_status=="Completed"){ $tran_type = $this->Lang["COMPLETED"]; }
				     if($u->payment_status=="Success"){ $tran_type = $this->Lang["SUCCESS"]; }
				     if($u->payment_status=="Pending"){$tran_type = $this->Lang["PENDING"];}
				     if($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }

					$out .= $i+$first_item.',"'.$u->firstname.'","'.$u->deal_title.'","'.$u->quantity.'","'.($u->deal_value-($u->deal_value *($u->deal_merchant_commission/100)))*$u->quantity.'","'.($u->deal_value *($u->deal_merchant_commission/100))*$u->quantity.'","'.$u->shippingamount.'","'.$tran_type.'","'.date('d-M-Y h:i:s A',$u->transaction_date).'"'."\r\n";
					$i++;

				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=Product-COD-Transactions.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}

		$this->template->content = new View("payment/cod_transaction");

        }
		/*** ADMIN AUCTION TRANSACTION***/

	public function auction_transaction($type = "", $page = "" )
	{
		if(!ADMIN_PRIVILEGES_TRANSACTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
                $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
	        $this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->page = $page ==""?1:$page; // for export per page
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $search=$this->input->get("id");
                $this->today = $this->input->get("today");
	        $this->startdate  = $this->input->get("startdate");
	        $this->enddate  = $this->input->get("enddate");	
	        $this->date_range = isset($_GET['date_range'])?1:0;
		$this->act_trans = 1;
			if($type == "Success"){
				$this->template->title = "Auction ".$this->Lang["SUCC_TRAN"];
				$base_URL = $this->base = 'admin-auction/success-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-auction/success-transaction.html?';
			}
			elseif($type == "Completed"){
				$this->template->title = "Auction ".$this->Lang["COMP_TRAN"];
				$base_URL = $this->base =  'admin-auction/completed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-auction/completed-transaction.html?';
			}
			elseif($type == "Faild"){
				$this->template->title = "Auction ".$this->Lang["FAI_TRAN"];
				$base_URL = $this->base = 'admin-auction/failed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-auction/failed-transaction.html?';
			}
			elseif($type == "Pending"){
				$this->template->title = "Auction ".$this->Lang["HOLD_TRAN"];
				$base_URL = $this->base = 'admin-auction/hold-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-auction/hold-transaction.html?';
			}
			else{
				$this->template->title = "Auction ".$this->Lang["ALL_TRAN"];
				$base_URL = $this->base = 'admin-auction/all-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-auction/all-transaction.html?';
			}


		$this->search_key =  $this->input->get('name');
		$this->count_transaction_list = $this->payment->count_auction_transaction_list($type,$this->search_key,3,$this->type,$this->sort," ",$this->today,$this->startdate,$this->enddate);

		$this->pagination = new Pagination(array(
			'base_url'       => $base_URL,
			'uri_segment'    => 4,
			'total_items'    => $this->count_transaction_list,
			'items_per_page' => 25,
			'style'          => 'digg',
			'auto_hide'      => TRUE
		));

		$this->transaction_auction_list = $this->payment->get_auction_transaction_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,3,$this->type,$this->sort,"",0,$this->today,$this->startdate,$this->enddate);

		if($search=='all'){ // Export in CSV format
			$this->transaction_auction_list = $this->payment->get_auction_transaction_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,3,$this->type,$this->sort,"",1,$this->today,$this->startdate,$this->enddate);
		}
		if($search){ // Export in CSV format
				$out = '"S.No","Name","Auction Title","Bidding Price('.CURRENCY_SYMBOL.')","Shipping Fee('.CURRENCY_SYMBOL.')","Pay Amount('.CURRENCY_SYMBOL.')","Admin Commission('.CURRENCY_SYMBOL.')","Status","Transaction Date & Time","Transaction Type"'."\r\n";
				$i=0;
				$first_item = $this->pagination->current_first_item;
				foreach($this->transaction_auction_list as $u)
				{

					 if($u->payment_status=="SuccessWithWarning"){ $tran_type = $this->Lang["SUCCESS"]; }
		   			 if($u->payment_status=="Completed"){ $tran_type = $this->Lang["COMPLETED"]; }
				     if($u->payment_status=="Success"){ $tran_type = $this->Lang["SUCCESS"]; }
				     if($u->payment_status=="Pending"){$tran_type = $this->Lang["PENDING"];}
				     if($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }

					 if($u->type=="1"){ $tran_type1 = $this->Lang["PAYPAL_CREDIT"]; }
					 if($u->type=="2"){ $tran_type1 = $this->Lang["PAYPAL"]; }
					 if($u->type=="3"){ $tran_type1 = $this->Lang["REF_PAYMENT"]; }
					 if($u->type=="4"){ $tran_type1 = "Authorize.net(".$u->transaction_type.")"; }

					$out .= $i+$first_item.',"'.$u->firstname.'","'.$u->deal_title.'","'.$u->bid_amount.'","'.$u->shipping_amount.'","'.$u->amount.'","'.($u->bid_amount *($u->deal_merchant_commission/100)).'","'.$tran_type.'","'.date('d-M-Y h:i:s A',$u->transaction_date).'","'.$tran_type1.'"'."\r\n";
					$i++;

				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=Auction-Transactions.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}


		$this->template->content = new View("payment/bid_transaction");

        }

        /*** CASH ON DELIVERY TRANSACTION FOR AUCTION ***/

	public function auction_cod_transaction($type = "", $page = "" )
	{
		if(!ADMIN_PRIVILEGES_TRANSACTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
                $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
	        $this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->page = $page ==""?1:$page; // for export per page
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $search=$this->input->get("id");
                $this->today = $this->input->get("today");
	        $this->startdate  = $this->input->get("startdate");
	        $this->enddate  = $this->input->get("enddate");	
	        $this->date_range = isset($_GET['date_range'])?1:0;
		$this->auction_cod_trans = 1;
			if($type == "Success"){
				$this->template->title = "COD ".$this->Lang["SUCC_TRAN"];
				$base_URL = $this->base = 'admin-cod-auction/success-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod-auction/success-transaction.html?';
			}
			else if($type == "Completed"){
				$this->template->title = "COD ".$this->Lang["SUCC_TRAN"];
				$base_URL = $this->base = 'admin-cod-auction/success-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod-auction/success-transaction.html?';
			}
			elseif($type == "Failed"){
				$this->template->title = "COD ".$this->Lang["FAI_TRAN"];
				$base_URL = $this->base = 'admin-cod-auction/failed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod-auction/failed-transaction.html?';
			}
			elseif($type == "Pending"){
				$this->template->title = "COD ".$this->Lang["HOLD_TRAN"];
				$base_URL = $this->base = 'admin-cod-auction/hold-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod-auction/hold-transaction.html?';
			}
			else{
				$this->template->title = "COD ".$this->Lang["ALL_TRAN"];
				$base_URL = $this->base = 'admin-cod-auction/all-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod-auction/all-transaction.html?';
			}

		$this->search_key =  $this->input->get('name');
		$this->count_transaction_list = $this->payment->count_auction_transaction_list($type,$this->search_key,3,$this->type,$this->sort,5,$this->today,$this->startdate,$this->enddate);

		$this->pagination = new Pagination(array(
			'base_url'       => $base_URL,
			'uri_segment'    => 4,
			'total_items'    => $this->count_transaction_list,
			'items_per_page' => 25,
			'style'          => 'digg',
			'auto_hide'      => TRUE
		));

		$this->transaction_auction_list = $this->payment->get_auction_transaction_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,3,$this->type,$this->sort,5,0,$this->today,$this->startdate,$this->enddate);
		if($search=='all'){ // Export in CSV format
			$this->transaction_auction_list = $this->payment->get_auction_transaction_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,3,$this->type,$this->sort,5,1,$this->today,$this->startdate,$this->enddate);
		}
		if($search){ // Export in CSV format
				$out = '"S.No","Name","Auction Title","Bidding Price('.CURRENCY_SYMBOL.')","Shipping Fee('.CURRENCY_SYMBOL.')","Pay Amount('.CURRENCY_SYMBOL.')","Admin Commission('.CURRENCY_SYMBOL.')","Status","Transaction Date & Time"'."\r\n";
				$i=0;
				$first_item = $this->pagination->current_first_item;
				foreach($this->transaction_auction_list as $u)
				{
                                        if($u->payment_status=="SuccessWithWarning"){ $tran_type = $this->Lang["SUCCESS"]; }
                                        if($u->payment_status=="Completed"){ $tran_type = $this->Lang["COMPLETED"]; }
                                        if($u->payment_status=="Success"){ $tran_type = $this->Lang["SUCCESS"]; }
                                        if($u->payment_status=="Pending"){$tran_type = $this->Lang["PENDING"];}
                                        if($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }
					$out .= $i+$first_item.',"'.$u->firstname.'","'.$u->deal_title.'","'.$u->bid_amount.'","'.$u->shipping_amount.'","'.$u->amount.'","'.($u->bid_amount *($u->deal_merchant_commission/100)).'","'.$tran_type.'","'.date('d-M-Y h:i:s A',$u->transaction_date).'"'."\r\n";
					$i++;
				}
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=Auction-COD-Transactions.xls');
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				echo "\xEF\xBB\xBF"; // UTF-8 BOM
				echo $out;
				exit;
			}

		$this->template->content = new View("payment/auction_cod_transaction");

        }


	/*** TRANSACTION DASHBOARD ***/

    public function dashboard_transaction()
	{
		if(!ADMIN_PRIVILEGES_TRANSACTIONS)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		$this->dashboard_transaction = "1";
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
		$this->transaction_list = $this->payment->get_transaction_chart_list();
		$this->deals_transaction_list = $this->payment->get_transaction_list_count();
		$this->template->content = new View("payment/transaction_dashboard");
		$this->template->title = $this->Lang["TRANS_DASH"];
	}
	/*** STORE CREDITS TRANSACTION***/

	public function storecredits($type = "", $page = "" )
	{
		if(!ADMIN_PRIVILEGES_STORECREDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
                $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
	        $this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->page = $page ==""?1:$page; // for export per page
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $search=$this->input->get("id");
                $this->today = $this->input->get("today");
	        $this->startdate  = $this->input->get("startdate");
	        $this->enddate  = $this->input->get("enddate");	
	        $this->date_range = isset($_GET['date_range'])?1:0;
		$this->storecredits = 1;
			if($type == "Completed"){
				$this->template->title = $this->Lang["PRD_STR_CRDS"].$this->Lang["COMP_TRAN"];
				$base_URL = $this->base = 'admin-storecredits/success-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod/success-transaction.html?';
			}
			elseif($type == "Failed"){
				$this->template->title = $this->Lang["PRD_STR_CRDS"].$this->Lang["FAI_TRAN"];
				$base_URL = $this->base = 'admin-storecredits/failed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod/failed-transaction.html?';
			}
			elseif($type == "Pending"){
				$this->template->title = $this->Lang["PRD_STR_CRDS"].$this->Lang["HOLD_TRAN"];
				$base_URL = $this->base = 'admin-storecredits/hold-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-cod/hold-transaction.html?';
			}
			else{
				$this->template->title = $this->Lang["PRD_STR_CRDS"].$this->Lang["ALL_TRAN"];
				$base_URL = $this->base = 'admin-storecredits/all-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-storecredits/all-transaction.html?';
			}

		$this->search_key =  $this->input->get('name');
		$this->count_transaction_list = $this->payment->count_storecredit_transaction_list($type,$this->search_key,2,$this->type,$this->sort,"",$this->today,$this->startdate,$this->enddate);

		$this->pagination = new Pagination(array(
			'base_url'       => $base_URL,
			'uri_segment'    => 4,
			'total_items'    => $this->count_transaction_list,
			'items_per_page' => 25,
			'style'          => 'digg',
			'auto_hide'      => TRUE
		));

		$this->cod_transaction_list = $this->payment->get_storecredit_transaction_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,2,$this->type,$this->sort,"",0,$this->today,$this->startdate,$this->enddate);

		if($search == 'all'){ // Export in CSV format
			$this->cod_transaction_list = $this->payment->get_storecredit_transaction_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,2,$this->type,$this->sort,"",1,$this->today,$this->startdate,$this->enddate);
		}
			if($search){ // Export in CSV format
				$out = '"S.No","Name","Deal Title","Quantity","Amount('.CURRENCY_SYMBOL.')","Admin Commission('.CURRENCY_SYMBOL.')","Shipping Amount('.CURRENCY_SYMBOL.')","Status","Transaction Date & Time"'."\r\n";
				$i=0;
				$first_item = $this->pagination->current_first_item;
				foreach($this->cod_transaction_list as $u)
				{

					 if($u->payment_status=="SuccessWithWarning"){ $tran_type = $this->Lang["SUCCESS"]; }
		   			 if($u->payment_status=="Completed"){ $tran_type = $this->Lang["COMPLETED"]; }
				     if($u->payment_status=="Success"){ $tran_type = $this->Lang["SUCCESS"]; }
				     if($u->payment_status=="Pending"){$tran_type = $this->Lang["PENDING"];}
				     if($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }

					$out .= $i+$first_item.',"'.$u->firstname.'","'.$u->deal_title.'","'.$u->quantity.'","'.($u->deal_value-($u->deal_value *($u->deal_merchant_commission/100)))*$u->quantity.'","'.($u->deal_value *($u->deal_merchant_commission/100))*$u->quantity.'","'.$u->shippingamount.'","'.$tran_type.'","'.date('d-M-Y h:i:s A',$u->transaction_date).'"'."\r\n";
					$i++;

				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=Product-Storecredit-Transactions.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}

		$this->template->content = new View("payment/cod_transaction");

        }
        
         /*** MERCHANT STORE CREDITS TRANSACTION***/

	public function store_credits_transaction($type = "", $page = "" )
	{
		if(!ADMIN_PRIVILEGES_STORECREDIT)
		{
			common::message(-1, $this->Lang["YOU_CAN_NOT_MODULE"]);        
			url::redirect(PATH."admin.html");
		}
		
		$this->storecredits = 1;
                $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->page = $page ==""?1:$page; // for export per page
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $search=$this->input->get("id");
                $this->today = $this->input->get("today");
		$this->startdate  = $this->input->get("startdate");
		$this->enddate  = $this->input->get("enddate");	
		$this->date_range = isset($_GET['date_range'])?1:0;
			if($type == "Completed"){
				$this->template->title = $this->Lang["PRD_STR_CRDS"].$this->Lang["SUCC_TRAN"];
				$base_URL = $this->base= 'admin-storecredits/success-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-storecredits/success-transaction.html?';
			}
			elseif($type == "Failed"){
				$this->template->title = $this->Lang["PRD_STR_CRDS"].$this->Lang["FAI_TRAN"];
				$base_URL = $this->base= 'admin-storecredits/failed-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-storecredits/failed-transaction.html?';
			}
			elseif($type == "Pending"){
				$this->template->title = $this->Lang["PRD_STR_CRDS"].$this->Lang["HOLD_TRAN"];
				$base_URL = $this->base= 'admin-storecredits/hold-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-storecredits/hold-transaction.html?';
			}
			else{
				$this->template->title = $this->Lang["PRD_STR_CRDS"].$this->Lang["ALL_TRAN"];
				$base_URL = $this->base= 'admin-storecredits/all-transaction/page/'.$page."/";
				$this->sort_url= PATH.'admin-storecredits/all-transaction.html?';
			}
		$this->search_key = $this->input->get('name');
		$this->count_transaction_list = $this->payment->count_transaction_product_storecredit_list($type,$this->search_key,$this->type,$this->sort,"",$this->today,$this->startdate,$this->enddate);
		$this->pagination = new Pagination(array(
			'base_url'       => $base_URL,
			'uri_segment'    => 4,
			'total_items'    => $this->count_transaction_list,
			'items_per_page' => 25,
			'style'          => 'digg',
			'auto_hide'      => TRUE
		));

		$this->store_credits_transaction_list = $this->payment->get_transaction_product_storecredit_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,2,$this->type,$this->sort,"",0,$this->today,$this->startdate,$this->enddate);

		if($search == 'all'){ // Export all in CSV format
			$this->store_credits_transaction_list = $this->payment->get_transaction_product_storecredit_list($type, $this->search_key, $this->pagination->sql_offset, $this->pagination->items_per_page,2,$this->type,$this->sort,"",1,$this->today,$this->startdate,$this->enddate);
		}
		if($search){ // Export in CSV format
				$out = '"S.No","Name","Product Title","Quantity","Amount('.CURRENCY_SYMBOL.')","Admin Commission('.CURRENCY_SYMBOL.')","Shipping Amount('.CURRENCY_SYMBOL.')","Status","Transaction Date & Time"'."\r\n";
				$i=0;
				$first_item = $this->pagination->current_first_item;
				foreach($this->store_credits_transaction_list as $u)
				{
				if($u->payment_status=="SuccessWithWarning"){ $tran_type = $this->Lang["SUCCESS"]; }
				if($u->payment_status=="Completed"){ $tran_type = $this->Lang["COMPLETED"]; }
				if($u->payment_status=="Success"){ $tran_type = $this->Lang["SUCCESS"]; }
				if($u->payment_status=="Pending"){$tran_type = $this->Lang["PENDING"];}
				if($u->payment_status=="Failed"){ $tran_type = $this->Lang["FAILED"]; }

					$out .= $i+$first_item.',"'.$u->firstname.'","'.$u->deal_title.'","'.$u->quantity.'","'.($u->deal_value-($u->deal_value *($u->deal_merchant_commission/100)))*$u->quantity.'","'.($u->deal_value *($u->deal_merchant_commission/100))*$u->quantity.'","'.$u->shippingamount.'","'.$tran_type.'","'.date('d-M-Y h:i:s A',$u->transaction_date).'"'."\r\n";
					$i++;
				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=Product-Storecredits-Transactions.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out;
					exit;
			}
		$this->template->content = new View("admin_product/store_credits_transaction");
        }
}
