<?php defined('SYSPATH') OR die('No direct access allowed.');
class Webpay_Controller extends Layout_Controller
{
	//const ALLOW_PRODUCTION = TRUE;
	public function __construct()
	{
		parent::__construct();
		$this->webpay = new Webpay_Model;
                //interswitch constants.
                $this->mac_key = "E187B1191265B18338B5DEBAF9F38FEC37B170FF582D4666DAB1F098304D5EE7F3BE15540461FE92F1D40332FDBBA34579034EE2AC78B1A1B8D9A321974025C4";
                $this->product_id = 6204;
                $this->currency = 566;
                $this->payment_params = "payment_split";
                $this->site_redirect_url = PATH."webpay/confirmed.html";
                $this->site_name = "www.abc.com";
                $this->cust_id = $this->session->get('UserEmail'); //$this->session->get('UserID');
                $this->cust_id_desc = $this->session->get('UserID');
                $this->cust_name = $this->session->get('UserName');
                $this->cust_name_desc = "";
                $this->txn_ref = "";
                $this->pay_item_id = 101;
                $this->pay_item_name = "eMarketPlace";
                $this->xml_data = "";
                $this->hash = "";
                $this->xml_data = "";
                //constants ends here
                if(LANGUAGE == "french" ){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/french_style.css',PATH.'themes/'.THEME_NAME.'/css/fr_multi_style.css'));
		}else if(LANGUAGE == "spanish"){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/spanish_style.css',PATH.'themes/'.THEME_NAME.'/css/sp_multi_style.css'));
		}
		else{
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}
        }
        
        public function confirm(){
            $this->response_code = "UNKNOWN";
            $this->response_discription = "";
            $this->paid_amount = 0;
//            echo "Interswitch Called Redirect URL HERE<br />"; 
//            echo $_REQUEST['resp']."<br />";
//            echo $_REQUEST['desc']."<br />";
            //txnref=1234567&payRef=&refRef=238477494594&cardNum=0&apprAmt=0
            if(isset($_REQUEST['resp'])){
                //echo "Response Details <br />";
                //echo $_REQUEST['resp']."<br />";
                //echo $_REQUEST['desc']."<br />";
                $txnref = $_REQUEST['txnref'];
                $payRef = $_REQUEST['payRef'];
                $retRef = $_REQUEST['retRef'];
                $cardNum = $_REQUEST['cardNum'];
                $apprAmt = $_REQUEST['apprAmt'];
                //echo "Gotten from WebPaypay: ".$txnref.", ".$payRef.", ".$retRef.", ".$cardNum.", ".$apprAmt;
                $hash = hash("sha512", $this->product_id.$txnref.$this->mac_key);
                $url_call = "https://stageserv.interswitchng.com/test_paydirect/api/v1/".
                    "gettransaction.json?productid=".$this->product_id."&transactionreference=".$txnref.
                        "&amount=".$this->session->get('webpay_total');
                $headers = array(
                    'Hash: '.$hash, 
                    'UserAgent: Mozilla/4.0 (compatible; MSIE 6.0; MS Web Services Client Protocol 4.0.30319.239)'
                );
                $ch = curl_init();
                // Set query data here with the URL
                curl_setopt($ch, CURLOPT_URL, $url_call); 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                //curl_setopt($ch, CURLOPT_USERAGENT, 'eMarketplace');
                
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                $response = curl_exec($ch);

                if($response == false)
                {
                    var_dump(curl_error($ch));
                }
                //var_dump(json_decode($response));
                $interswitch = json_decode($response);
                //echo $url_call."<br />";
                //echo $hash;
                $this->response_code = $interswitch->ResponseCode;
                $this->response_discription = $interswitch->ResponseDescription;
                if($interswitch->Amount > 0){
                    $this->paid_amount = intval($interswitch->Amount/100);
                }
                
                curl_close($ch);
            }
            //die;
            $this->transaction_result = array("TIMESTAMP" => date('m/d/Y h:i:s a', time()), "ACK" => "FAILED TRANSACTION","AMT"=> $this->paid_amount,"CURRENCYCODE"=>CURRENCY_CODE);
            $this->transaction_result['T_ID'] = $txnref;
            $this->result_transaction = arr::to_object($this->transaction_result);
            $this->session->set('payment_result', $this->result_transaction);
            $this->template->title = $this->result_transaction->ACK." Interswitch Payment System";
            $this->template->content = new View("themes/".THEME_NAME."/interswitch/payment_finished");   
        }


        public function pay(){
            //var_dump($_SESSION);die;
	    foreach($_SESSION as $key=>$value){
            if($value && (is_string($value)) && ($key=='product_cart_id'.$value)){
           
            $deal_id = $_SESSION[$key];
             $item_qty = $this->session->get('product_cart_qty'.$deal_id);
             $product_size = "1";
               foreach($_SESSION as $key=>$value) {
                    if(($key=='product_size_qty'.$deal_id)){
                        $product_size = $value;
                    }
                    if(($key=='product_quantity_qty'.$deal_id)){
                        $product_quantity = $value;
                    }

                }

                $this->product_size_details = $this->webpay->product_size_details($deal_id, $product_size);

               $dbquantity=$this->product_size_details->current()->quantity;

                if($dbquantity < $item_qty){
                    $this->session->set('product_quantity_qty'.$deal_id,$dbquantity);
                    common::message(-1, $this->Lang['CHE_PRO_QTY']);
                    url::redirect(PATH."cart.html");
                }
            }
        }

        
/////
        
		if($_POST){

			$referral_amount = $this->input->post("p_referral_amount");
		        $this->userPost = $this->input->post();
			$product_color="";
			$paymentType = "INTERSWITCH";
			$captured = 0;
			$total_amount="";
		        $total_qty="";
		        $product_title="";
		        $produ_qty="";
		        $total_shipping="";
		        $pay_amount1=0; // for total transaction amount for success page
                        //var_dump($_SESSION); die;
				/*
					TODO
					I have changed transaction id for COD transactions
					From: One transaction id for all merchants
					To:   Unique transaction id(s) based on all merchants.
					This may be helpful in the pay late/and COD apis
					@Live
				*/
				
                //really fantastic to do the below . make sens
                $total_item_in_cart = $this->session->get("count");
                $loop = 0;
                $TRANSACTIONID = text::random($type = 'alnum', $length = 15);
                //while($loop < $total_item_in_cart){
		foreach($_SESSION as $key=>$value){
                    
                    //$value = $this->session->get("count");
                    if(!is_array($value)){
                    if(($value && $key=='product_cart_id'.$value)){
                        //echo "in ";
			$product_color = 0;
                        $product_size = 0;
                        $deal_id = $_SESSION[$key]; //$value = intval($loop+1); 
                        $item_qty = $this->session->get('product_cart_qty'.$deal_id);
                        $this->session->set('product_cart_qty'.$deal_id,$item_qty);
                        $amount = $this->input->post("amount");
                        //echo $deal_id;break;
                        $this->deals_payment_deatils = $this->webpay->get_product_payment_details($deal_id);
                        //var_dump($this->deals_payment_deatils); die;
                        //echo $deal_id." and ".$this->deals_payment_deatils->deal_title; die;
                        if(count($this->deals_payment_deatils) == 0){
                                        unset($_SESSION[$key]);
                                        $this->session->delete('product_cart_qty'.$value);
                                        $this->session->delete("count");
                                        common::message(-1, $this->Lang["PAGE_NOT"]);
                                        url::redirect(PATH."products.html");
                        }
                        foreach($this->deals_payment_deatils as $UL){

                                $purchase_qty = $UL->purchase_count;
                                $deal_title = $UL->deal_title;
                                $deal_key  = $UL->deal_key;
                                $url_title = $UL->url_title;
                                $deal_value = $UL->deal_value;
                                $product_amount = $UL->deal_value*$item_qty;
                                $merchant_id = $UL->merchant_id;
                                $product_shipping = $UL->shipping_amount;
                                $shipping_methods = $UL->shipping;
                        }

                         if($shipping_methods  == 1){
                                $shipping_amount = 0;
                        }  elseif($shipping_methods  == 2){
                                $merchant_flat_amount = $this->webpay->get_userflat_amount($merchant_id);
                                $shipping_amount = $merchant_flat_amount->flat_amount;
                        } elseif($shipping_methods  == 3){
                                $shipping_amount =$product_shipping;
                        } elseif($shipping_methods  == 4){
                                $shipping_amount =$product_shipping*$item_qty;
                        } elseif($shipping_methods  == 5){
                                 $shipping_amount = 0;
                        }

                        $taxdeal_amount=($deal_value*$item_qty)+$shipping_amount;
                        $tax_amount = ((TAX_PRECENTAGE_VALUE/100)*$taxdeal_amount);
                        $pay_amount1 += ($taxdeal_amount+$tax_amount);

                        foreach($_SESSION as $key=>$value)
                        {
                                if(($key=='product_size_qty'.$deal_id)){
                                $product_size = $value;
                                }
                                if(($key=='product_color_qty'.$deal_id)){
                                $product_color = $value;
                                }
                        }
                        
                        $transaction = $this->webpay->insert_transaction_details($deal_id, $referral_amount, $item_qty, 5, $captured, $purchase_qty,$paymentType,$product_amount,$merchant_id,$product_size,$product_color,$tax_amount,$shipping_amount,$shipping_methods, arr::to_object($this->userPost),$TRANSACTIONID);
                        //var_dump($transaction);
                        $status = $this->do_captured_transaction($captured, $deal_id,$item_qty,$transaction);
                        //echo "here"; die;
                        //break;
                       }
                        //$loop++;
                }
	            }
                    //$this->product_id = $transaction;
                    $this->session->set('webpay_total', intval($pay_amount1*100));
                    //then run a code to get the splitting xml file and co
                    
                    $this->xml_data = '<payment_item_detail>'. 
                        '<item_details detail_ref="eMarketPlace" institution="Store" sub_location="Lagos" location="Lagos">';
                    $this->xml_data .= $this->webpay->get_split_marchant_xml($TRANSACTIONID);//pass in the transaction ID
                        //'<item_detail item_id="1" item_name="Butter" item_amt="'.(($pay_amount1/2)*100).'" bank_id="117" acct_num="4356789876" />'.
                        //    '<item_detail item_id="2" item_name="Grape" item_amt="'.(($pay_amount1/2)*100).'" bank_id="117" acct_num="4351189876" />'. 
                    $this->xml_data .= '</item_details></payment_item_detail>';
                    //var_dump($this->xml_data);die;
                    //var_dump($this->xml_data); die;
                    $combination = $TRANSACTIONID.$this->product_id.$this->pay_item_id.($pay_amount1*100).
                            $this->site_redirect_url.$this->mac_key;
                    $this->hash = hash("sha512", $combination);
                    //die;
                    //var_dump($_SESSION);
                    //die;
               //$status = $this->do_captured_transaction1($captured, $deal_id,$item_qty,$transaction,$TRANSACTIONID);
                $this->transaction_result = array("TIMESTAMP" => date('m/d/Y h:i:s a', time()), "ACK" => $this->Lang['SUCCESS'] ,"AMT"=> $pay_amount1,"CURRENCYCODE"=>CURRENCY_CODE);
                $this->result_transaction = arr::to_object($this->transaction_result);
                //dont need the line of code below
                //$this->session->set('payment_result', $this->result_transaction);
                $this->txn_ref = $TRANSACTIONID;
                $this->total_amount_to_pay = $pay_amount1;
                $this->template->title = "Interswitch Payment System";
                $this->template->content = new View("themes/".THEME_NAME."/interswitch/payment_process");                     
                    //echo $this->txn_ref; die;
	            //$status = $this->do_captured_transaction1($captured, $deal_id,$item_qty,$transaction,$TRANSACTIONID);
				

	               // url::redirect(PATH.'transaction.html');

            }
            //exit;
           // $this->session->set('p_payment_type', 'INTERSWITCH');
                    //url::redirect(PATH."payment_product/cart_order_complete.html");
                   // var_dump($_SESSION);die;

            /*-- MODULE X --*/
 
        }
        
        
	/** DOCAPTURED PAYMENT, UPDATED AMOUNT TO REFERED USERS, POST PURCHASE DEALS TO FACEBOOK WALL and SEND MAIL **/

	public function do_captured_transaction($captured = "", $deal_id = "", $qty = "",$transaction = "")
	{
		
		
	           
            //var_dump($_SESSION);
	        $from = CONTACT_EMAIL;
		$this->products_list = $this->webpay->get_products_coupons_list($transaction,$deal_id);
		$this->product_size = $this->webpay->get_shipping_product_size();
		$this->product_color = $this->webpay->get_shipping_product_color();

                $this->merchant_id = $this->products_list->current()->merchant_id;
                $this->get_merchant_details = $this->webpay->get_merchant_details($this->merchant_id);
                $this->merchant_firstneme = $this->get_merchant_details->current()->firstname;
                $this->merchant_lastname = $this->get_merchant_details->current()->lastname;
                $this->merchant_email = $this->get_merchant_details->current()->email;
                $message_merchant = new View("themes/".THEME_NAME."/payment_mail_product_merchant");
				
			

		if(EMAIL_TYPE==2) {
			
			
				email::smtp($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
				
				
		}else{
			
						
		                email::sendgrid($from,$this->merchant_email, $this->Lang['USER_BUY'] ,$message_merchant);
		}

		$user_details = $this->webpay->get_purchased_user_details();
		foreach($user_details as $U){
			if($U->referred_user_id && $U->deal_bought_count == $qty){
				$update_reff_amount = $this->webpay->update_referral_amount($U->referred_user_id);
			}
			$deals_details = $this->webpay->get_deals_details($deal_id);
			if($U->facebook_update == 1){
				foreach($deals_details as $D){
					$dealURL = PATH."product/".$D->deal_key.'/'.$D->url_title.".html";
					$message = $this->Lang['PRO_PURCASH'].$D->deal_title." ".$dealURL;
					$post_arg = array("access_token" => $U->fb_session_key, "message" => $message, "id" => $U->fb_user_id, "method" => "post");
					common::fb_curl_function("https://graph.facebook.com/feed", "POST", $post_arg);
				}
			}

		}
		return;
	}
        
	public function do_captured_transaction1($captured = "", $deal_id = "", $qty = "",$transaction = "",$transid ="")
	{
		$user_details = $this->webpay->get_purchased_user_details();
		foreach($user_details as $U){

		$deals_details = $this->webpay->get_deals_details($deal_id);
		/** Send Purchase details to user Email **/
		foreach($deals_details as $D){
		    $deal_title = $D->deal_title;
		    $deal_amount = $D->deal_value;
		}

                $friend_details = $this->webpay->get_friend_transaction_details($deal_id, $transaction);
                $friend_email = $friend_details->current()->friend_email;
                $friend_name = $friend_details->current()->friend_name;
            if($friend_email != "xxxyyy@zzz.com"){
                $from = CONTACT_EMAIL;
                $this->transaction_mail =array("deal_title" => $deal_title, "item_qty" => $qty ,"total" => ($deal_amount * $qty) ,"amount"=> ($deal_amount * $qty),"ref_amount"=> "0","value" =>$deal_amount,"friend_name" => $friend_name,"value" =>$deal_amount);
                $this->result_mail = arr::to_object($this->transaction_mail);
                $this->admin_list = $this->webpay->get_admin_list();
		$this->admin_email = $this->admin_list->current()->email;
		$this->products_list = $this->webpay->get_products_coupons_list($transaction,$deal_id);
				$this->product_size = $this->webpay->get_shipping_product_size();
				$this->product_color = $this->webpay->get_shipping_product_color();
                $friend_message = new View("themes/".THEME_NAME."/friend_buyit_mail");
                $message_admin = new View("themes/".THEME_NAME."/payment_mail_product_admin");
                 if(EMAIL_TYPE==2) {
			//email::smtp($from,$friend_email, $this->Lang['PRO_GIFT']. SITENAME ,$friend_message);
			//email::smtp($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
		}else{
			//email::sendgrid($from,$friend_email, $this->Lang['PRO_GIFT']. SITENAME ,$friend_message);
			//email::sendgrid($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
		}

            } else {
                $from = CONTACT_EMAIL;
				$this->products_list = $this->webpay->get_products_coupons_list($transaction,$deal_id);
				$this->product_size = $this->webpay->get_shipping_product_size();
				$this->product_color = $this->webpay->get_shipping_product_color();

				$this->admin_list = $this->webpay->get_admin_list();
				$this->admin_email = $this->admin_list->current()->email;
                $message = new View("themes/".THEME_NAME."/payment_mail_product");
                $message_admin = new View("themes/".THEME_NAME."/payment_mail_product_admin");

                if(EMAIL_TYPE==2) {
			//email::smtp($from,$U->email, $this->Lang['THANKS_BUY'] ,$message);
			//email::smtp($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
		}else{
			//email::sendgrid($from,$U->email, $this->Lang['THANKS_BUY'] ,$message);
			//email::sendgrid($from,$this->admin_email, $this->Lang['USER_BUY'] ,$message_admin);
		}
            }
         }
		return;
	}
}