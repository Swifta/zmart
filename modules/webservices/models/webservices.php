<?php defined('SYSPATH') or die('No direct script access.');
class Webservices_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
	}
        
        public function get_details($admin, $key, $transaction_id, $amount){
            $ret = array();
            $ret['success'] = false;
            $ret['msg'] = "Invalid User Credentials";
            $result = $this->db->query("SELECT * FROM users WHERE email='".$admin."' AND password=md5('".$key."')");
            if(count($result) == 1){
	         $result = $this->db->from("transaction")
                            ->where(array("transaction.transaction_id"=>$transaction_id))
                            ->join("product","product.deal_id","transaction.product_id")
                            ->join("users","users.user_id","transaction.user_id")
                            ->join("city","city.city_id","users.city_id")
                            ->get();
                if(count($result) > 0){
                    $total_amount = 0;
                    $loop = 0;
                    foreach($result as $row){
                        if($row->approve_status != 1){
                            $ret['success'] = false;
                            $ret['msg'] = "User Account Blocked or Suspended";
                            break;
                        }

                        $data['fullname'] = $row->firstname;
                        $data['address'] = $row->address1.", ".$row->address2.". ".$row->city_name;
                        $data['telephone'] = $row->phone_number;
                        $data['email'] = $row->email;
                        $data['currency_code'] = $row->currency_code;
                        $data['transaction_date'] = $row->transaction_date;
                        $data['transaction_type'] = $row->transaction_type;

                        $product = array();
                        $product['product_id'] = $row->product_id;
                        $product['product_descr'] = $row->deal_title;
                        $product['quantity'] = $row->quantity;
                        $product['merchant_id'] = $row->merchant_id;
                        $product['shop_id'] = $row->shop_id;
                        $product['payment_status'] = $row->payment_status;
                        $product['amount'] = $row->amount;
                        $product['merchant_account'] = $row->nuban;

                        $product_breakdown[$loop] = $product;

                        $total_amount += $row->amount;
                        //var_dump($result);
                        $loop++;
                    }
                    if($total_amount == intval($amount)){
                        $ret['success'] = true;
                        $ret['msg'] = "OK";
                        $data['total_amount'] = $total_amount;
                        $data['product_breakdown'] = $product_breakdown;
                        $ret['data'] = $data;
                    }
                    else{
                        $ret['msg'] = "Transaction Not Found [INVALID AMOUNT]";
                    }
                }
                else{
                    $ret['msg'] = "No Such Transaction Found [INVALID]";
                }
            }
            return json_encode($ret);
        }
        
        public function pay($admin = "", $key = "", $transaction_id = "", $amount = "", $transaction_description = ""){
            $ret = array();
            $ret['success'] = false;
            $ret['msg'] = "Authentication Failed";
            $result = $this->db->query("SELECT * FROM users WHERE email='".$admin."' AND password=md5('".$key."')");
            if(count($result) == 1){
	         $result = $this->db->from("transaction")
                            ->where(array("transaction.transaction_id"=>$transaction_id))
                            ->join("product","product.deal_id","transaction.product_id")
                            ->join("users","users.user_id","transaction.user_id")
                            ->join("city","city.city_id","users.city_id")
                            ->get();
                if(count($result) > 0){
                    $total_amount = 0;
                    foreach($result as $row){
                        $total_amount += $row->amount;
                    }
                    if($amount == $total_amount){
                        $result = $this->db->update("transaction", array("payment_status" => "Success", 
                            "pending_reason" => $transaction_description), 
                                array("transaction_id"=>$transaction_id));
                        if(count($result) > 0){
                            $ret['msg'] = "Payment Successful";
                            $ret['success'] = true;
                        }
                        else{
                            $ret['msg'] = "Internal Error: Cannot Complete Payment Request or Duplicate Payment";
                        }
                        //var_dump($result);
                    }
                    else{
                        $ret['msg'] = "Amount Paid not Whats on the Invoice";
                    }
                   
                }
                else{
                    $ret['msg'] = "No Such Transaction Found [INVALID]";
                }
            }
            return json_encode($ret);            
        }
}