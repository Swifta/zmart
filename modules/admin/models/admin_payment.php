<?php defined('SYSPATH') or die('No direct script access.');
class Admin_payment_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->user_id = $this->session->get("user_id");	
	}

	/** GET WITHDRAW  DETAILS **/

	public function count_fund_request_list($field = "", $type = "", $search_key = "",$today="", $startdate = "", $enddate = "")
	{	
		 if($_GET){
		         $search_key = mysql_real_escape_string($search_key);
		        if($type=="") {
		                $conditions = "request_id > 0";
		        }else {
		                $conditions = "$field=$type";
		        }
		        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and request_fund.date_time between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and request_fund.date_time between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and request_fund.date_time between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( request_fund.date_time between $startdate_str and $enddate_str )";	
                        }

			$result = $this->db->query('select * from request_fund join users on users.user_id=request_fund.user_id where '.$conditions.' and (users.firstname like "%'.$search_key.'%" OR users.email like "%'.$search_key.'%")');
		} else {
			if($type=="") {
		                $conditions = array("request_id >" => 0);
		        } else {
		                $conditions = array($field => $type);
		        }
			$result = $this->db->select("request_fund.request_id")
						->from("request_fund")
						->join("users","users.user_id","request_fund.user_id")
						->where($conditions)
						->get();
		}
		return count($result);
	}

	/** GET FUND REQUEST LIST **/

	public function get_fund_request_list($field ="" , $type = "", $search_key = "", $offset = "", $item_per_page = "",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$item_per_page":"";

			if($type=="") {
		                $conditions = "request_id > 0 ";
		        }else {
		                $conditions = "$field=$type ";
		        }
		        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and request_fund.date_time between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and request_fund.date_time between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and request_fund.date_time between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( request_fund.date_time between $startdate_str and $enddate_str )";	
                        }
		        
		        if($_GET){
		               $search_key = mysql_real_escape_string($search_key);
		               $result = $this->db->query('select * from request_fund join users on users.user_id=request_fund.user_id where '.$conditions.' and (users.firstname like "%'.$search_key.'%" OR users.email like "%'.$search_key.'%") order by request_id DESC '.$limit1.'');
         		} else {
			        $result = $this->db->query('select * from request_fund join users on users.user_id=request_fund.user_id where '.$conditions.' order by request_id DESC '.$limit1.'');
		        }
		return $result;
	}


        /** APPROVE FUND REQUEST **/

	public function update_fund_request_status($request_id = "", $user_id = "", $request_status = "", $payment_status = "", $result = "",$request_amount)
	{  
	       if($result->ACK == 'Success' || $result->ACK == 'SuccessWithWarning'){
	 	$result = $this->db->update("request_fund", array("request_status" => $request_status, "payment_status" => $payment_status,"transaction_date"=>strtotime($result->TIMESTAMP),"transaction_id"=>$result->CORRELATIONID), array("request_id" => $request_id, "user_id" => $user_id));
	 	
	 	$this->db->query("update users set merchant_account_balance = merchant_account_balance - $request_amount where user_type = 1");
	 	
	 	} elseif($result->ACK == 'Failure') {
	 	$result = $this->db->update("request_fund", array("request_status" => $request_status, "payment_status" => $payment_status,"transaction_date"=>strtotime($result->TIMESTAMP),"transaction_id"=>$result->CORRELATIONID,"error_code"=>$result->L_ERRORCODE0,"error_title"=>$result->L_SHORTMESSAGE0,"error_message"=>$result->L_LONGMESSAGE0), array("request_id" => $request_id, "user_id" => $user_id));
	 	
	 	}		
        	return count($result);
	}
	
	/** REJECTED FUND REQUEST **/
	
	public function update_fund_reject_status($request_id = "", $user_id = "", $request_status = "", $payment_status = "", $amount = "")
	{  
	 	$result = $this->db->update("request_fund", array("request_status" => $request_status, "payment_status" => $payment_status), array("request_id" => $request_id, "user_id" => $user_id));
		if(count($result) && $request_status == 3){
			$result = $this->db->update("users", array("merchant_account_balance" => $amount), array( "user_id" => $user_id));
		}		
        	return count($result);
	}

	
		/** GET USER LIST **/
	public function get_transaction_list_dashboard()
	{
                $result = $this->db->query("SELECT * FROM transaction_mapping");
                return $result;
	}


    /** GET USER LIST **/
	public function get_transaction_chart_list()
	{	
	        $result = $this->db->from("transaction_mapping")
	                            ->get();
                return $result;
               
	}
	/** GET USER LIST **/
	public function get_transaction_list_count()
	{	
	        $result = $this->db->from("transaction")
	                            ->get();
                return $result;
               
	}
	
	/** GET USER DETAILS **/

	public function get_users_details_amount($request_id = "", $user_id = "")
	{
		 $result_fund = $this->db->select("request_status")->from("request_fund")
                            ->where(array("request_fund.request_id" => $request_id, "request_fund.user_id" => $user_id))
                            ->get();
                     if(count($result_fund)>0){
                     $request_status=$result_fund->current()->request_status;
                     if($request_status==1){
                           $result = $this->db->from("request_fund")->join("users","users.user_id","request_fund.user_id")
                                ->where(array("request_fund.request_id" => $request_id, "request_fund.user_id" => $user_id, "users.user_type" => 3, "request_status" => 1, "payment_status"=> 0))->get();
                            return $result;
                            } else {                            
                            $result = $this->db->from("request_fund")->join("users","users.user_id","request_fund.user_id")
                                ->where(array("request_fund.request_id" => $request_id, "request_fund.user_id" => $user_id, "users.user_type" => 3, "request_status" => 2, "payment_status"=> 2))->get();
                            return $result;
                            
                            }
                     }       
		return 0;
	}


        /** GET USER DETAILS **/

	public function get_users_details_error_message($request_id = "", $user_id = "" )
	{
		 $result = $this->db->from("request_fund")
                            ->join("users","users.user_id","request_fund.user_id")
                            ->where(array("request_fund.request_id" => $request_id, "request_fund.user_id" => $user_id, "users.user_type" => 3, "request_status" => 2))
                            ->get();
		return $result;
	}
	
	/** GET MERCHANT BALANCE **/
	
	public function get_merchant_balance()
	{
                $result =$this->db->from("users")->where(array("user_type" => 3))->get();
                return $result;
	 }

    /** GET COUNT FOR AUCTION TRANSACTION  **/

	public function count_auction_transaction_list($type = "", $search_key = "",$type1 = "",$sort_type = "",$param = "",$trans_type="",$today="", $startdate = "", $enddate = "")
	{	
		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}

		$conditions = "auction.deal_id > 0";
		 if($trans_type){
			$conditions .= " AND transaction.type = 5 ";
		}
		else{
			$conditions .= " AND transaction.type != 5 ";
		}
		       	
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions .= " and transaction.id > 0";
		          }else {
		                $conditions .= " and (payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
			$result = $this->db->query('select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join auction on auction.deal_id=transaction.auction_id where '.$conditions.' and ( users.firstname like "%'.$search_key.'%" OR transaction.transaction_id like "%'.$search_key.'%" OR auction.deal_title like "%'.$search_key.'%")');
		}
		else{
		       if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort_type","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");
				$conditions = "transaction.id >= 0 ";
					 if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
					else{
						$conditions .= " AND transaction.type != 5 ";
					}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");
			$conditions .= " AND payment_status = '$type' ";
				
		             }

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }
			$result = $this->db->select("*")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("auction","auction.deal_id","transaction.auction_id")
						->where($conditions)
						->get();
		}
		
		
		return count($result);
	} 	    

	/** GET COUNT FOR TRANSACTION  **/

	public function count_transaction_list($type = "", $search_key = "",$type1 = "",$sort_type = "",$param = "",$trans_type = "",$today="", $startdate = "", $enddate = "")
	{	
					$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		      $conditions = "product.deal_id > 0";
				if($trans_type){
					if($trans_type==7){
						$conditions .= " AND transaction.type = 7";
					} else {
						$conditions .= " AND transaction.type = 5";
					}	 
				}
				else{
					$conditions .= " AND transaction.type != 5";
				}
				
			if($_GET){ 
				$search_key = mysql_real_escape_string($search_key);
				    if(($type=="")||($type=="mail")) {
				            $conditions .= " and transaction.id > 0";
				    }else {
				            $conditions .= " and (payment_status='$type')";
				                           
				    }
				if($today == 1)
                                {
                                        $from_date = date("Y-m-d 00:00:01"); 
                                        $to_date = date("Y-m-d 23:59:59"); 
                                        $from_date_str = strtotime($from_date);
                                        $to_date_str = strtotime($to_date);
                                        $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                }
                                else if($today == 2)
                                {
                                        $to_date = date("Y-m-d 23:59:59"); 
                                        $to_date_str = strtotime($to_date);
                                        $from_date_str = $to_date_str - (7*24*3600);
                                        $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                }
                                else if($today == 3)
                                {
                                        $to_date = date("Y-m-d 23:59:59"); 
                                        $to_date_str = strtotime($to_date);
                                        $from_date_str = $to_date_str - (30*24*3600);
                                        $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                }
                                if( $startdate != "" && $enddate != "")
                                {
	                                $startdate_str = strtotime($startdate);
	                                $enddate_str = strtotime($enddate);
	                                $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                                }
				
                                $conditions .= ' and (users.firstname like "%'.$search_key.'%"';
                                $conditions .= ' OR product.deal_title like "%'.$search_key.'%")';
                                
                                $result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join product on product.deal_id=transaction.product_id where $conditions ");
 		} 
		else{
		       if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
			$conditions = "transaction.id >= 0 ";
				if($trans_type){
					if($trans_type==7){
						$conditions .= " AND transaction.type = 7";
					} else {
						$conditions .= " AND transaction.type = 5";
					}	
					
				}
				else{
					$conditions .= " AND transaction.type != 5 ";
				}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
			$conditions .= " AND payment_status = '$type' ";
		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }
			$result = $this->db->select('*','users.firstname as firstname')->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("product","product.deal_id","transaction.product_id")
						->where($conditions)
						//->limit($record, $offset)
						->get();
		} 
		return count($result);
	} 	
	/** GET COUNT FOR DEAL TRANSACTION  **/

	public function count_transaction_deal_list($type = "", $search_key = "",$sort_type = "",$param = "",$trans_type="",$today="", $startdate = "", $enddate = "")
	{	
		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
			
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0 ";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		          
		        if($trans_type){
				$conditions .= " AND transaction.type = 5 ";
			}
			else{
				$conditions .= " AND transaction.type != 5 ";
			}
			if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
			$result = $this->db->query('select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join deals on deals.deal_id=transaction.deal_id where '.$conditions.' and (users.firstname like "%'.$search_key.'%" OR transaction.transaction_id like "%'.$search_key.'%" OR deals.deal_title like "%'.$search_key.'%")');
		}
		else{
		       if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort_type","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");
				$conditions = "transaction.id >= 0 ";
				if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
					else{
						$conditions .= " AND transaction.type != 5 ";
					}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");
				$conditions = " payment_status = '$type'";

				if($trans_type){
					$conditions .= " AND transaction.type = 5 ";
				}
				else{
					$conditions .= " AND transaction.type != 5 ";
				}
				
		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }
			$result = $this->db->select("*")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("deals","deals.deal_id","transaction.deal_id")
						->where($conditions)
						->get();
		}

		return count($result);
	} 	
	
	/** GET AUCTION TRANSACTION LIST **/

	public function get_auction_transaction_list($type = "", $search_key = "", $offset = "", $record = "",$type1 = "",$sort_type = "",$param = "",$trans_type="",$limit="",$today="", $startdate = "", $enddate = "")
        { 
			$limit1 = $limit !=1 ?"limit $offset,$record":"";
			
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
               $conditions = "auction.deal_id > 0";
               if($trans_type){
					$conditions .= " AND transaction.type = 5 ";
				}
				else{
					$conditions .= " AND transaction.type != 5 ";
				}
				
		if($_GET){ 
		
		        if(($type=="")||($type=="mail")) {
		                $conditions .= " and transaction.id > 0";
		        }else {
		                $conditions .= " and (payment_status='$type')";
		        }
		        
		         if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
			 $search_key = mysql_real_escape_string($search_key);
			 $result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join auction on auction.deal_id=transaction.auction_id where $conditions and ( users.firstname like '%".$search_key."%' OR auction.deal_title like '%".$search_key."%') $limit1 ");
		} 
		else{
		       if(($type=="")||($type=="mail")) {
				   
						$sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");
					$conditions = "transaction.id >= 0 ";
				 if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
					else{
						$conditions .= " AND transaction.type != 5 ";
					}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");
			$conditions .= " AND payment_status = '$type' ";
				
		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }
			 $result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join auction on auction.deal_id=transaction.auction_id where $conditions $limit1 ");
			
		} 
		return $result;
	}
	/** GET TRANSACTION LIST **/

	public function get_transaction_list($type = "", $search_key = "", $offset = "", $record = "",$type1 = "",$sort_type = "",$param = "",$trans_type = "",$limit = "",$today="", $startdate = "", $enddate = "")
        {
			$limit1 = $limit !=1 ?"limit $offset,$record":"";
			
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		      $conditions = "product.deal_id > 0";
				if($trans_type){
					if($trans_type==7){
						$conditions .= " AND transaction.type = 7";
					} else {
						$conditions .= " AND transaction.type = 5";
					}	
					
				}
				else{
					$conditions .= " AND transaction.type != 5";
				}
			if($_GET){ 
				$search_key = mysql_real_escape_string($search_key);
				    if(($type=="")||($type=="mail")) {
				            $conditions .= " and transaction.id > 0";
				    }else {
				            $conditions .= " and (payment_status='$type')";
				                           
				    }
				        if($today == 1)
                                        {
                                                $from_date = date("Y-m-d 00:00:01"); 
                                                $to_date = date("Y-m-d 23:59:59"); 
                                                $from_date_str = strtotime($from_date);
                                                $to_date_str = strtotime($to_date);
                                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                        }
                                        else if($today == 2)
                                        {
                                                $to_date = date("Y-m-d 23:59:59"); 
                                                $to_date_str = strtotime($to_date);
                                                $from_date_str = $to_date_str - (7*24*3600);
                                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                        }
                                        else if($today == 3)
                                        {
                                                $to_date = date("Y-m-d 23:59:59"); 
                                                $to_date_str = strtotime($to_date);
                                                $from_date_str = $to_date_str - (30*24*3600);
                                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                        }
                                        if( $startdate != "" && $enddate != "")
                                        {
	                                        $startdate_str = strtotime($startdate);
	                                        $enddate_str = strtotime($enddate);
	                                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                                        }
				
				$conditions .= ' and (users.firstname like "%'.$search_key.'%"';
                $conditions .= ' OR product.deal_title like "%'.$search_key.'%")';

			 $result = $this->db->query("select *,users.firstname as firstname, transaction.shipping_amount as shippingamount from transaction join users on users.user_id=transaction.user_id join product on product.deal_id=transaction.product_id where $conditions $limit1 ");
 		} 
		else{
		       if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
			$conditions = "transaction.id >= 0 ";
				if($trans_type){
					if($trans_type==7){
						$conditions .= " AND transaction.type = 7";
					} else {
						$conditions .= " AND transaction.type = 5";
					}	
					
				}
				else{
					$conditions .= " AND transaction.type != 5 ";
				}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
			$conditions .= " AND payment_status = '$type' ";
		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }
	        	
			$result = $this->db->query("select *,users.firstname as firstname, transaction.shipping_amount as shippingamount from transaction join users on users.user_id=transaction.user_id join product on product.deal_id=transaction.product_id where $conditions $limit1 ");
		} 
		return $result;
	}
/** GET DEAL TRANSACTION LIST **/

	public function get_transaction_deal_list($type = "", $search_key = "", $offset = "", $record = "",$sort_type = "",$param = "",$trans_type="",$limit = "",$today="", $startdate = "", $enddate = "")
        {
			$limit1 = $limit !=1 ?"limit $offset,$record":"";
			
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
               
		if($_GET){ 
		        if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0";
		        }else {
		                $conditions = "(payment_status='$type')";
		                               
		        }

		        if($trans_type){
					$conditions .= " AND transaction.type = 5 ";
				}
				else{
					$conditions .= " AND transaction.type != 5 ";
				}
				 if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
			
			 $search_key = mysql_real_escape_string($search_key);
			
			 $result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join deals on deals.deal_id=transaction.deal_id where $conditions and (users.firstname like '%".$search_key."%' OR transaction.transaction_id like '%".$search_key."%' OR deals.deal_title like '%".$search_key."%') order by transaction.id DESC  $limit1 "); 

 		} 
		else{
		       if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");
		
				$conditions = "transaction.id >= 0 ";
				if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
					else{
						$conditions .= " AND transaction.type != 5 ";
					}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");
					$conditions = " payment_status = '$type'";
						if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
						}
						else{
							$conditions .= " AND transaction.type != 5 ";
						}
				
		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }
	        	
			$result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join deals on deals.deal_id=transaction.deal_id where $conditions $limit1 ");
		}
		return $result;
	}

	/** GET ADMIN BALANCE **/
	
	public function get_admin_balance()
	{
                $result =$this->db->select("merchant_account_balance")->from("users")->where(array("user_type" => 1))->get();
                return (count($result))?$result->current()->merchant_account_balance:0;
	 }
	 
	 /** GET COUNT FOR STORE CREDITS TRANSACTION  **/

	public function count_storecredit_transaction_list($type = "", $search_key = "",$type1 = "",$sort_type = "",$param = "",$trans_type = "",$today="", $startdate = "", $enddate = "")
	{	
					$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		      $conditions = "product.deal_id > 0";
				if($trans_type){
						$conditions .= " AND transaction.type = 5 AND store_credit_id !=0";
				}
				else{
					$conditions .= " AND transaction.type != 5 AND store_credit_id !=0";
				}
				
			if($_GET){ 
				$search_key = mysql_real_escape_string($search_key);
				    if(($type=="")||($type=="mail")) {
				            $conditions .= " and transaction.id > 0";
				    }else {
				            $conditions .= " and (payment_status='$type')";
				                           
				    }
				if($today == 1)
                                {
                                        $from_date = date("Y-m-d 00:00:01"); 
                                        $to_date = date("Y-m-d 23:59:59"); 
                                        $from_date_str = strtotime($from_date);
                                        $to_date_str = strtotime($to_date);
                                        $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                }
                                else if($today == 2)
                                {
                                        $to_date = date("Y-m-d 23:59:59"); 
                                        $to_date_str = strtotime($to_date);
                                        $from_date_str = $to_date_str - (7*24*3600);
                                        $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                }
                                else if($today == 3)
                                {
                                        $to_date = date("Y-m-d 23:59:59"); 
                                        $to_date_str = strtotime($to_date);
                                        $from_date_str = $to_date_str - (30*24*3600);
                                        $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                }
                                if( $startdate != "" && $enddate != "")
                                {
	                                $startdate_str = strtotime($startdate);
	                                $enddate_str = strtotime($enddate);
	                                $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                                }
				
                                $conditions .= ' and (users.firstname like "%'.$search_key.'%"';
                                $conditions .= ' OR product.deal_title like "%'.$search_key.'%")';
                                
                                $result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join product on product.deal_id=transaction.product_id where $conditions ");
 		} 
		else{
		       if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
			$conditions = "transaction.id >= 0 ";
				if($trans_type){
					
						$conditions .= " AND transaction.type = 5 AND store_credit_id !=0";
						
					
				}
				else{
					$conditions .= " AND transaction.type != 5 AND store_credit_id !=0 ";
				}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
			$conditions .= " AND payment_status = '$type' ";
		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }
			$result = $this->db->select('*','users.firstname as firstname')->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("product","product.deal_id","transaction.product_id")
						->where($conditions)
						//->limit($record, $offset)
						->get();
		} 
		return count($result);
	} 	
	/** GET TRANSACTION LIST **/

	public function get_storecredit_transaction_list($type = "", $search_key = "", $offset = "", $record = "",$type1 = "",$sort_type = "",$param = "",$trans_type = "",$limit = "",$today="", $startdate = "", $enddate = "")
        {
			$limit1 = $limit !=1 ?"limit $offset,$record":"";
			
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		      $conditions = "product.deal_id > 0";
				if($trans_type){
						$conditions .= " AND transaction.type = 5 AND store_credit_id !=0";
				}
				else{
					$conditions .= " AND transaction.type != 5 AND store_credit_id !=0";
				}
			if($_GET){ 
				$search_key = mysql_real_escape_string($search_key);
				    if(($type=="")||($type=="mail")) {
				            $conditions .= " and transaction.id > 0";
				    }else {
				            $conditions .= " and (payment_status='$type')";
				                           
				    }
				        if($today == 1)
                                        {
                                                $from_date = date("Y-m-d 00:00:01"); 
                                                $to_date = date("Y-m-d 23:59:59"); 
                                                $from_date_str = strtotime($from_date);
                                                $to_date_str = strtotime($to_date);
                                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                        }
                                        else if($today == 2)
                                        {
                                                $to_date = date("Y-m-d 23:59:59"); 
                                                $to_date_str = strtotime($to_date);
                                                $from_date_str = $to_date_str - (7*24*3600);
                                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                        }
                                        else if($today == 3)
                                        {
                                                $to_date = date("Y-m-d 23:59:59"); 
                                                $to_date_str = strtotime($to_date);
                                                $from_date_str = $to_date_str - (30*24*3600);
                                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                                        }
                                        if( $startdate != "" && $enddate != "")
                                        {
	                                        $startdate_str = strtotime($startdate);
	                                        $enddate_str = strtotime($enddate);
	                                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                                        }
				
				$conditions .= ' and (users.firstname like "%'.$search_key.'%"';
                $conditions .= ' OR product.deal_title like "%'.$search_key.'%")';

			 $result = $this->db->query("select *,users.firstname as firstname, transaction.shipping_amount as shippingamount from transaction join users on users.user_id=transaction.user_id join product on product.deal_id=transaction.product_id where $conditions $limit1 ");
 		} 
		else{
		       if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
			$conditions = "transaction.id >= 0 ";
				if($trans_type){
						$conditions .= " AND transaction.type = 5 AND store_credit_id !=0";
				}
				else{
					$conditions .= " AND transaction.type != 5 AND store_credit_id !=0 ";
				}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
			$conditions .= " AND payment_status = '$type' ";
		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }
	        	
			$result = $this->db->query("select *,users.firstname as firstname, transaction.shipping_amount as shippingamount from transaction join users on users.user_id=transaction.user_id join product on product.deal_id=transaction.product_id where $conditions $limit1 ");
		} 
		return $result;
	}
	
	/** GET COUNT FOR PRODUCT STORE CREDIT TRANSACTION  **/

	public function count_transaction_product_storecredit_list($type = "", $search_key = "",$sort_type = "",$param = "",$trans_type = "",$today="", $startdate = "", $enddate = "")
	{
					$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "storecredit_transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( storecredit_transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		        if($trans_type){
					
							$conditions .= " AND storecredit_transaction.type = 5 AND store_credit_id !=0";
							
							
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5 AND store_credit_id !=0";
					}
			$result = $this->db->query("select storecredit_transaction.id from storecredit_transaction join store_credit_save on store_credit_save.storecredit_id = storecredit_transaction.main_storecreditid join users on users.user_id=storecredit_transaction.user_id join product on product.deal_id=storecredit_transaction.product_id where $conditions  and ( users.firstname like '%".$search_key."%' OR storecredit_transaction.transaction_id like '%".$search_key."%' OR product.deal_title like '%".$search_key."%' )");
			
		}
		else{
				$conditions = "storecredit_transaction.id >= 0 ";
				if($trans_type){
						
							$conditions .= " AND storecredit_transaction.type = 5 AND store_credit_id !=0";
							
						
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5 AND store_credit_id !=0";
					}
			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by storecredit_transaction.quantity $sort","amount"=>" order by storecredit_transaction.amount $sort","refamount"=>" order by storecredit_transaction.referral_amount $sort","commision"=>" order by storecredit_transaction.deal_merchant_commission $sort","bidamount" => "order by storecredit_transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		       }
		      else {
				$conditions = " payment_status = '$type' ";
				if($trans_type){
				
							$conditions .= " AND storecredit_transaction.type = 5 AND store_credit_id !=0";
							
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5 AND store_credit_id !=0";
					}
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by storecredit_transaction.quantity $sort_type","amount"=>" order by storecredit_transaction.amount $sort","refamount"=>" order by storecredit_transaction.referral_amount $sort","commision"=>" order by storecredit_transaction.deal_merchant_commission $sort","bidamount" => "order by storecredit_transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		             }

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by storecredit_transaction.id DESC'; }

			$result = $this->db->select("storecredit_transaction.id")->from("storecredit_transaction")
						->join("store_credit_save","store_credit_save.storecredit_id","storecredit_transaction.main_storecreditid")
						->join("users","users.user_id","storecredit_transaction.user_id")
						->join("product","product.deal_id","storecredit_transaction.product_id")
						->where($conditions)
						->get();
		}
		return count($result);
	}
	
	/** GET PRODUCT STORE CREDITS TRANSACTION LIST **/

	public function get_transaction_product_storecredit_list($type = "", $search_key = "", $offset = "", $record = "",$type1 = "",$sort_type = "",$param = "",$trans_type = "",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";
		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "storecredit_transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and storecredit_transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( storecredit_transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		        if($trans_type){
						
							$conditions .= " AND storecredit_transaction.type = 5  AND store_credit_id !=0";
						
						
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5  AND store_credit_id !=0";
					}
			$result = $this->db->query("select *,users.firstname as firstname, storecredit_transaction.shipping_amount as shippingamount from storecredit_transaction join store_credit_save on store_credit_save.storecredit_id = storecredit_transaction.main_storecreditid join users on users.user_id=storecredit_transaction.user_id join product on product.deal_id=storecredit_transaction.product_id where $conditions and ( users.firstname like '%".$search_key."%' OR storecredit_transaction.transaction_id like '%".$search_key."%' OR product.deal_title like '%".$search_key."%' ) $limit1 ");
		}
		else{
				$conditions = "storecredit_transaction.id >= 0  ";
				if($trans_type){
						
							$conditions .= " AND storecredit_transaction.type = 5  AND store_credit_id !=0";
						
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5  AND store_credit_id !=0";
					}
			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by storecredit_transaction.quantity $sort","amount"=>" order by storecredit_transaction.amount $sort","refamount"=>" order by storecredit_transaction.referral_amount $sort","commision"=>" order by storecredit_transaction.deal_merchant_commission $sort","bidamount" => "order by storecredit_transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		       }
		      else {
				$conditions = " payment_status = '$type' ";
				if($trans_type){
						
							$conditions .= " AND storecredit_transaction.type = 5  AND store_credit_id !=0";
						
					}
				else{
						$conditions .= " AND storecredit_transaction.type != 5  AND store_credit_id !=0";
					}
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by storecredit_transaction.quantity $sort_type","amount"=>" order by storecredit_transaction.amount $sort","refamount"=>" order by storecredit_transaction.referral_amount $sort","commision"=>" order by storecredit_transaction.deal_merchant_commission $sort","bidamount" => "order by storecredit_transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by storecredit_transaction.storecredit_transaction_date DESC'; }

			$result = $this->db->select("*","storecredit_transaction.shipping_amount as shippingamount")->from("storecredit_transaction")
						->join("store_credit_save","store_credit_save.storecredit_id","storecredit_transaction.main_storecreditid")
						->join("users","users.user_id","storecredit_transaction.user_id")
						->join("product","product.deal_id","storecredit_transaction.product_id")
						->where($conditions)
						->limit($record, $offset)
						->get();
		}
		return $result;
	}
	
}            
