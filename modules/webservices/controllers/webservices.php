<?php defined('SYSPATH') OR die('No direct access allowed.');
class Webservices_Controller extends Layout_Controller
{
	//const ALLOW_PRODUCTION = TRUE;
	public function __construct()
	{
		parent::__construct();
		$this->webservices = new Webservices_Model;		
        }
        
        public function get_details(){
            $ret = array();
            $ret['status'] = false;
            $ret['description'] = "InComplete Request. Check Documentation";
            $ret['data'] = array();
            $admin = $this->input->get('admin');
            $key = $this->input->get('key');
            $trnx = $this->input->get('transaction_id');
            $amount = $this->input->get('amount');
            $result = json_decode($this->webservices->get_details($admin, $key, $trnx, $amount));
            if($result->success){
                $ret['status'] = true;
                $ret['description'] = $result->msg;
                $ret['data'] = $result->data;
            }
            else{
                $ret['description'] = $result->msg;
            }
            echo json_encode($ret);
            exit;
        }
        
        public function pay(){
            $admin = $this->input->get('admin');
            $key = $this->input->get('key');
            $trnx = $this->input->get('transaction_id');
            $amount = $this->input->get('amount');
            $description = $this->input->get('description');
            $response = json_decode($this->webservices->pay($admin, $key, $trnx, $amount, $description));
            echo json_encode($response);
            exit;
        }
        
}