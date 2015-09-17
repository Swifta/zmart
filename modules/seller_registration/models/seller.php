<?php defined('SYSPATH') or die('No direct script access.');
class Seller_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db=new Database();
		$this->session = Session::instance();
		$this->city_id = $this->session->get("CityID");
		//$this->UserID = $this->session->get("UserID");
		
	}
	
        /*
         * @musty
         */
        public function validate_nuban($nuban = ""){
          $arg = array();
          $arg['userName'] = ZENITH_TEST_USER;
          $arg['Pwd'] = ZENITH_TEST_PASS;
          $soap = new SoapClient(ZENITH_TEST_ENDPOINT);
          $arg['account_number'] = $nuban;
          $fun_resp = $soap->VerifyAccount($arg);
          
          $response = (array)$fun_resp->VerifyAccountResult;
          if($response){
              $nuban_response = (isset($response['errorMessage']))?-1:1;
              if($nuban_response == 1){
                  //valid account. check duplicate use
                  $check_duplicate = $this->checkDuplicateUser($nuban);
                  if(!$check_duplicate){
                      return 1; //verified and valid
                  }
                  else{
                      return -1; //duplicate use of nuban number (fraud)
                  }
              }
              else{
                  return 0; //not verified
              }
          }
          else{
              return 0;
          }
          //var_dump($response); die;
        }
        
        public function checkDuplicateUser($nuban = ""){
            $result = $this->db->count_records('users', array('nuban' => $nuban));
            return (bool) $result;            
        }
        
	/** GET COUNTRY BASED CITY LIST **/
	
	    public function get_city_by_country($country = "")
	    {
		    $result = $this->db->from("city")->where(array("country_id" => $country, "city_status" => '1'))->orderby("city_name")->get();
		    return $result;
	    }
	    
	    /** ADD MERCHANT ACCOUNT **/
	
	public function add_merchant($post = "",$store_key = "",$password="",$store_admin_password='')
	{ 

                $result_email = $this->db->select("email")->from("users")->where(array("email" =>$this->session->get('memail')))->limit(1)->get(); 
                if(count($result_email) == 0){
		$result_country1 = $this->db->select("country_id")->from("city")->where(array("city_id" => $post->city ))->limit(1)->get(); 
		// for store country value
			$country_value1 = $result_country1->current()->country_id;
			//$password = text::random($type = 'alnum', $length = 8);

			$result = $this->db->insert("users", array("firstname" => $this->session->get('firstname'),"lastname" => $this->session->get('lastname'), "email" =>$this->session->get('memail'),'password' => md5($password),"payment_account_id" =>$this->session->get('payment_acc'),
                            'address1' => $this->session->get('mraddress1'), 'address2' => $this->session->get('mraddress2'), 'city_id' =>$post->city, 'country_id' => $country_value1, 
                            'phone_number' => $this->session->get('mphone_number'), 'user_type'=>'3','login_type'=>'2', "joined_date" => time(),"user_status" =>0,"approve_status" => 0,"user_sector_id" =>$this->session->get('sector'),
                            "user_sub_sector_id" =>$this->session->get("sub_sector"), "nuban"=>  $this->session->get("nuban")));
			
			$merchant_id = $result->insert_id();
			
			
			$shipping_result = $this->db->insert("shipping_module_settings", array("free" =>$this->session->get('free'),"flat" => $this->session->get('flat'), "per_product" => $this->session->get('product'),'per_quantity' => $this->session->get('quantity'), 'aramex' => $this->session->get('aramex'),'ship_user_id' => $merchant_id));
		 
				/*$result_country1 = $this->db->select("country_id")->from("city")->where(array("city_id" => $post->city ))->limit(1)->get(); // for store country value
				$country_value1 = $result_country1->current()->country_id; */
				
		 $res = $this->db->insert("users",array("firstname"=>$post->username,"email"=>$post->store_email_id,"password"=>md5($store_admin_password),"user_type"=>9,"created_by"=>$merchant_id,"referred_user_id"=>$merchant_id,"user_status"=>1,"login_type"=>1,"approve_status"=>1,"address1"=>$post->address1,"address2"=>$post->address2,"city_id"=>$post->city,"country_id"=>$country_value1, 'phone_number' => $post->mobile,"user_sector_id"=>$this->session->get("sub_sector")));
				
		
			$website="http://".$post->website;
				$store_result = $this->db->insert("stores", array("store_name" => $post->storename,"store_url_title" => url::title($post->storename),'store_key' =>$store_key,'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $country_value1, 'phone_number' => $post->mobile, 'website' => $website, 'zipcode' => $post->zipcode,'latitude' => $post->latitude, 'longitude' => $post->longitude,'store_type' => '1','merchant_id'=>$merchant_id,"store_status" => '0',"created_date" => time(),'created_by'=>$merchant_id,'about_us'=>$post->data,"store_admin_id"=>$res->insert_id(),"store_sector_id" =>$this->session->get('sector'),"store_subsector_id" =>$this->session->get("sub_sector")));
                                $result = $this->db->insert("merchant_attribute", array("merchant_id" => $merchant_id,"storeid" =>$store_result->insert_id()));
				$admin = $this->db->select('email')->from('users')->where(array('user_type' =>1))->limit(1)->get();

				$email=(count($admin))?$email = $admin[0]->email:"";
				
				$return_result['image']=$merchant_id.'_'.$store_result->insert_id();

				$return_result['email']=$email;
					
			 return $return_result;
			 
			 }
		
	}	
	
	 /** GET COUNTRY LIST **/
	public function getcountrylist()
        {
		$result = $this->db->from("country")
                        ->orderby("country.country_name", "ASC")
		        ->where(array("country_status" => '1'))->get();
		return $result;
	}
	
	/** CHECK EMAIL EXIST **/ 
	
	public function exist_email($email = "")
	{
		$result = $this->db->count_records('users', array('email' => $email));
		return (bool) $result;
	}
	
	/* GET MODULE SETTING LIST */
	public function get_setting_module_list()
	{
		$result = $this->db->from("module_settings")->get();
		return $result;
	}
	
	/** TO GET THE SECTOR LIST **/ 
	public function get_sector_list()
	{
		$result=$this->db->from("sector")->where(array("sector_status" =>1,"type"=>1))->orderby("sector_name","ASC")->get();
		return $result;
	}
	  public function exist_name($name = "")
	{
		
		$result = $this->db->count_records('stores', array('store_name' => $name));
		
		return (bool) $result;
	}
	
	public function get_all_sub_sectors()
	{
		$result=$this->db->select("sector_id","sector_name","main_sector_id")->from("sector")->where(array("type"=>2))->get();
		return $result;
		
	}
	/** LISTING THE SUB SECTORS CORRESPONDING TO THE SECTOR SELECTED **/
	public function get_sub_sectors($sector="")
	{
		$result=$this->db->select("sector_id","sector_name")->from("sector")->where(array("main_sector_id" => $sector,"sector_status" =>1))->get();
		return $result;
	}
	
	public function exist_store_admin($email='',$user_id=''){
		if($user_id!='')
			$result = $this->db->count_records('users', array('user_type' => 9,'email'=>$email,'user_id!='=>$user_id));
		else
			$result = $this->db->count_records('users', array('user_type' => 9,'email'=>$email));
		return (bool) $result;
	}
	
	public function get_subsector_name($sector_id ='')
	{
		$sector_query = $this->db->query("select * from  sector where sector_id='$sector_id' ");
		return $sector_query;
	}	
}
