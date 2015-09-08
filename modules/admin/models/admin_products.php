<?php defined('SYSPATH') or die('No direct script access.');
class Admin_products_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();	
	}

	/** GET PRODUCTS CATEGORY LIST **/
	
	public function get_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"main_category_id"=>0))->orderby("category_name","ASC")->get();
		return $result;
	}

	/** GET PRODUCTS SUB CATEGORY LIST **/
	
	public function get_sub_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type"=>2))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	public function get_sec_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type"=>3))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	public function get_third_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type"=>4))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	 /** GET SUB CATEGORY LIST BY CATEGORY **/
	 
        public function get_sub_category($category = "")
	{ 
		$result = $this->db->from("category")
                                        ->where(array("main_category_id" => $category, "category_status" => 1,"type" => 2))
                                        ->orderby("category_name")->get();
		return $result;
	} 
	
	/** GET SEC SUB CATEGORY LIST BY CATEGORY **/
	
        public function get_sec_category($category = "")
	{ 
		$result = $this->db->from("category")
                                        ->where(array("sub_category_id" => $category, "category_status" => 1,"type" => 3))
                                        ->orderby("category_name")->get();
		return $result;
	} 

	/** GET CITY LIST **/
	
	public function get_city_list()
	{
		$result = $this->db->from("city")->join("country","country.country_id","city.country_id")->where(array("city_status" => 1,"country_status" => 1))->orderby("city_name","ASC")->get();
		return $result;
	}

        /** GET PRODUCT COLOR **/
	
	public function store_color_data($city_id = "",$deal_id = "")
	{
                $dealdata = $this->db->select("color_id")->from("color")->where(array("deal_id" => $deal_id,"color_name" => $city_id))->get();
                if(count($dealdata) == 1){	    
                        return 0;
                } else {
                        $result_id = $this->db->select("id","color_name")->from("color_code")->where(array("color_code" => $city_id))->get();
                        $result = $this->db->insert("color", array("deal_id" => $deal_id,"color_code_id" => $result_id->current()->id,"color_name" => $city_id,"color_code_name" => $result_id->current()->color_name));
                        return 1;
                }
	}
	   
	/** ADD PRODUCTS **/
	
	public function add_product($post = "", $deal_key = "",$adminid = "",$size_quantity = "")
	{
	    $quantity = "";
	    foreach($size_quantity as $sq){
	      $quantity += $sq;
	    }
	                $inc_tax = "0";
			 if(isset($_POST['Including_tax'])) {
			        $inc_tax = "1";
			 }
			 
			 $shipping_amount = "0";
			 if(isset($_POST['shipping_amount'])) {
			        $shipping_amount = $_POST['shipping_amount'];
			 }
			 
			 $weight = "0";
			 if(isset($_POST['weight'])) {
			        $weight = $_POST['weight'];
			 }
			 $height = "0";
			 if(isset($_POST['height'])) {
			        $height = $_POST['height'];
			 }
			 $length = "0";
			 if(isset($_POST['length'])) {
			        $length = $_POST['length'];
			 }
			 $width = "0";
			 if(isset($_POST['width'])) {
			        $width = $_POST['width'];
			 }
			 $duration = "";
			 if(isset($_POST['duration'])) {
			        $duration = serialize($_POST['duration']);
			 }
			$pro_status = 1;
			if(isset($_POST['status']))
				$pro_status = $_POST['status'];
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal          
		//$sub_cat = implode(',',$sub_cat1);
		
		if($post->price!='') // if discount price is not empty orignal price value is inserted to deal_price field and discount price is inserted to deal value 
		{
			$deal_price = $post->deal_value;
			$deal_val = $post->price;
			$savings=($post->deal_value - $post->price);
			$value=($savings/$post->deal_value)*100;
		}else{ // if discount price is given empty orignal price value is inserted to deal_value field 
			$deal_val = $post->deal_value;
			$savings=0;
			$deal_price=0;
			$value=0;
		}
		
		//$savings=($post->price-$post->deal_value);
		$atr_option = isset($post->attr_option)?$post->attr_option:0;  // for attribute is present or not
				
		$result = $this->db->insert("product", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description,"delivery_period" => $post->delivery_days,"category_id" => $post->category,"sub_category_id" =>  $post->sub_category,"sec_category_id" =>  $post->sec_category,"third_category_id" => $post->third_category, "deal_type"=> $post->deal_type,"deal_price" => $deal_price,"deal_value" => $deal_val,"deal_savings" => $savings,"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => $value,"merchant_id"=>$post->users,"shop_id"=>$post->stores,"created_date" => time(),"created_by"=>$adminid,"color" => $post->color_val,"size" => $post->size_val,"user_limit_quantity"=>$quantity,"deal_status" =>$pro_status,"shipping_amount"=>$shipping_amount,"shipping"=>$post->shipping,"attribute"=>$atr_option,"Including_tax" =>$inc_tax,"weight" => $weight,"height" => $height,"length" => $length,"width" => $width,"product_duration"=>$duration));
	
	    $product_id = $result->insert_id();
	    if(($post->color_val) == 1){
	        foreach($post->color as $c){
	            $result_count = $this->db->from("color")->where(array("deal_id" => $product_id, "color_name" => $c))->get();
	            if(count($result_count)==0){	      
	            $result_id = $this->db->from("color_code")->where(array("color_code" => $c))->get();      
	            $result_color = $this->db->insert("color", array("deal_id" => $product_id, "color_name" => $c, "color_code_id" => $result_id->current()->id,"color_code_name" => $result_id->current()->color_name));
	            }
	        } 
	    }   
	    
	    if(($post->size_val) == 1){
	        $i= 0;
	        foreach($post->size as $s){
	            $result_count = $this->db->from("product_size")->where(array("deal_id" => $product_id, "size_id" => $s))->get();
	            if(count($result_count)==0){	  
	            $result_id = $this->db->from("size")->where(array("size_id" => $s))->get();        
	            		$size_tot = count((array)$post->size);
						//To avoid None size if other sizes selected
					if($size_tot == 1 && ($s!=1 || $s==1)){
						$result_color = $this->db->insert("product_size", array("deal_id" => $product_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
					}elseif($size_tot > 1 && $s!=1){
							$result_color = $this->db->insert("product_size", array("deal_id" => $product_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
					}    
	            $i++; }
	        } 
	    }  


		//Attribute start
		if(($post->attr_option) == 1){

	  	$attr_result = $this->db->delete('product_attribute', array('product_id' => $product_id));

		$attr = array_unique($_POST['attribute']);
		//print_r($attr);exit;
	        foreach($attr as $k=>$s){
		$result_attribute = $this->db->insert("product_attribute", array("product_id" => $product_id, "attribute_id" => $s,"text"=>$_POST['attribute_value'][$k]));
			
				}
	        }         
	        
		//Attribute end
		
		
		$policy = array_unique($_POST['Delivery_value']);
	        if(count($policy)>0){
	        $Deli_result = $this->db->delete('product_policy', array('product_id' => $product_id));
	        foreach($policy as $p=>$s){
		                $result_Delivery = $this->db->insert("product_policy", array("product_id" => $product_id,"text"=>$_POST['Delivery_value'][$p]));
				}
		}
		
		if(count($result) == 1){
				
			return $result->insert_id();
		}
		return 0;
          
	}
	
	
        /** CHECK TITLE EXIST **/ 
	
	public function exist_title($title = "")
	{
		$result = $this->db->count_records('product', array('deal_title' => $title));
		return (bool) $result;
	}
	
	/** MANAGE  PRODUCTS **/
	
	public function get_all_products_list($type = "",$offset = "", $record = "", $city = "", $name = "",$sort_type = "",$param = "",$limit="",$today="", $startdate = "", $enddate = "",$product_duration="")
	{
	      
		$limit1 = $limit !=1 ?"limit $offset,$record":"";
		
	    $sort = "ASC";
		if($sort_type == "DESC" ){
			$sort = "DESC";
		}		
		if($_GET){  
		        if($type != "1")
		        {
		                $conditions = "purchase_count < user_limit_quantity and deal_status!=2 ";
		        } else {
		                $conditions = "purchase_count >= user_limit_quantity and deal_status!=2 ";
		        }
                        
			if($city){
			        $conditions .= " and city.city_id = ".$city;
			}
			if($name){
			        $conditions .= " and (deal_title like '%".mysql_real_escape_string($name)."%'";
			        $conditions .= " or store_name like '%".mysql_real_escape_string($name)."%')";
			}
                        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( product.created_date between $startdate_str and $enddate_str )";	
                        }
			if($product_duration ==2){
				$conditions .= ' and product.product_duration =""';
			} else if($product_duration ==3){
				$conditions .= ' and product.product_duration !="" ';
			} 
                         
			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; }			
			$query = "select * , product.created_date as createddate from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions $limit1 ";
			$result = $this->db->query($query);
		}
		else{		
		
		       if($type != "1")
		        {
		                $conditions = "purchase_count < user_limit_quantity  and deal_status!=2 ";
		        }else {
		                $conditions = "purchase_count >= user_limit_quantity and deal_status!=2 ";
		        }

			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; }
			
			$query = "select * , product.created_date as createddate from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id join country on country.country_id=stores.country_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions $limit1 ";
			$result = $this->db->query($query);
		} 
		return $result;
	}
	
	/** PRODUCTS COUNT **/
	
	public function get_all_products_count($type = "", $city = "", $name = "",$sort_type = "",$param = "",$today = "",$startdate = "",$enddate = "",$product_duration="")
	{
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
            if($_GET){
                        if($type != "1")
                        {
                                $conditions = "purchase_count < user_limit_quantity and deal_status!=2 ";
                        }else {
                                $conditions = "purchase_count >= user_limit_quantity and deal_status!=2 ";
                        }
                        if($city){
                                $conditions .= " and city.city_id = ".$city;
                        }
                        if($name){
                                $conditions .= " and deal_title like '%".mysql_real_escape_string($name)."%'";
                        }
                        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 4)
                        {
                                $conditions .= "";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
                        $startdate_str = strtotime($startdate);
                        $enddate_str = strtotime($enddate);
                        $conditions .= " and product.created_date between $startdate_str and $enddate_str";
                        }
            if($product_duration ==2){
				$conditions .= ' and product.product_duration =""';
			} else if($product_duration ==3){
				$conditions .= ' and product.product_duration !="" ';
			} 

			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			    if(isset($sort_arr[$param])){
	       		        $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; }
	        	
			$query = "select product.deal_id from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id  join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions";
			$result = $this->db->query($query);
                } else {
                
			    if($type != "1")
		        {
		                $conditions = "purchase_count < user_limit_quantity and deal_status!=2 ";
		        }else {
		                $conditions = "purchase_count >= user_limit_quantity and deal_status!=2 ";
		        }
			
			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; } 

			$query = "select product.deal_id from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions";
			$result = $this->db->query($query);
                }
		
                return count($result);

	
	}
	
	/** VIEW PRODUCTS **/
	
	public function get_product_data($deal_key = "", $deal_id = "")
	{
	         $result = $this->db->select('*','product.sub_category_id as sub_cat','product.sec_category_id as sec_cat')->from("product")
	                        ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key))
			        ->join("stores","stores.store_id","product.shop_id")
	                        ->join("city","city.city_id","stores.city_id")
	                        ->join("country","country.country_id","stores.country_id")
				->join("users","users.user_id","product.merchant_id")
				->join("category","category.category_id","product.category_id")
 	                        ->get();
                return $result;
	}
	
	public function get_product_data_mail($deal_key = "", $deal_id = "")
	{
	         $result = $this->db->select('*','product.sub_category_id as sub_cat','product.sec_category_id as sec_cat')->from("product")
	                        ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key, "deal_status" => 1))
			        ->join("stores","stores.store_id","product.shop_id")
	                        ->join("city","city.city_id","stores.city_id")
	                        ->join("country","country.country_id","stores.country_id")
				->join("users","users.user_id","product.merchant_id")
				->join("category","category.category_id","product.category_id")
 	                        ->get();
                return $result;
	}
	
	
	/* GET CITY BY SHIPPING */
	public function get_city_by_shipping($store_id = "")
	{
	$result = $this->db->select("city.shipping_amount")->from("stores")	                
	                    ->where(array("store_id" => $store_id))
	                    ->join("city","city.city_id","stores.city_id")
	                    ->get();
		return $result;
	}
	
	
	/** GET PRODUCT COLOR **/
	
	public function get_product_color($deal_id = "")
	{
		$result = $this->db->from("color")
				->where(array("deal_id" => $deal_id))
		     		->get();
		return $result;
	}
	
	/** GET PRODUCT COLOR  CODE **/
	
	public function get_color_code()
	{
		$result = $this->db->from("color")->join("color_code","color_code.color_code","color.color_name","left")
				->where(array("color_status" =>0,"color_code.color_name!="=>"NULL"))
				->orderby("color.color_code_name","ASC")
				->groupby("color.color_name")
		     		->get();
		return $result;
	}
	
	/** GET PRODUCT COLOR **/
	
	public function get_color_data($color_id="")
	{
		$result = $this->db->from("color_code")
		                ->where(array("color_code" => $color_id))
				->get();
		return $result;
	}
	
	
	/** GET PRODUCT SIZE **/
	
	public function get_product_size()
	{
		$query = "SELECT * FROM size where size_id!=1 ORDER BY CAST(size_name as SIGNED INTEGER) ASC";
	        $result = $this->db->query($query);
		return $result;
	}
	
	
	/** GET PRODUCT SIZE **/
	
	public function get_size_data($size_id="")
	{
		$result = $this->db->from("size")
		                ->where(array("size_id" => $size_id))
		     		->get();
		return $result;
	}
	
	/** GET PRODUCT SIZE **/
	
	public function get_product_one_size($deal_id = "")
	{
		$result = $this->db->from("product_size")
				->where(array("deal_id" => $deal_id))
		     		->get();
		return $result;
	}
	
	
	/** GET PRODUCT COLOR **/
	
	public function store_size_data($city_id = "",$deal_id = "")
	{
	    $dealdata = $this->db->select("product_size_id")->from("product_size")->where(array("deal_id" => $deal_id,"size_id" => $city_id))->get();
	    if(count($dealdata) == 1){	    
	        return 0;
	    } else {
	    
	    $result_id = $this->db->select("size_name")->from("size")->where(array("size_id" => $city_id))->get();
		$result = $this->db->insert("product_size", array("deal_id" => $deal_id,"size_id" => $city_id,"size_name" => $result_id->current()->size_name));
		
		return 1;
		}
	}
	
	/** EDIT PRODUCT DATA **/
	
	public function get_edit_product($deal_id = "",$deal_key = "")
	{
		$result = $this->db->from("product")
				->where(array("deal_id" => $deal_id, "deal_key" => $deal_key))
		     		->get();
		return $result;
	}
	
	/** UPDATE PRODUCTS **/
	
	public function edit_product($deal_id = "", $deal_key = "", $post = "",$size_quantity = "",$preview_type="")
	{ 
	        
	     $quantity = 0;
	     for($i=0;$i<count($size_quantity); $i++){ 
			if($size_quantity[$i]!=0){
				$quantity +=$size_quantity[$i];
			}
		 }
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal          
		//$sub_cat = implode(',',$sub_cat1);
		$dealdata = $this->db->select("deal_title","url_title","user_limit_quantity","purchase_count")->from("product")->where(array("deal_id" => $deal_id, "deal_key" => $deal_key))->get();
		
		$total_quantity = $quantity;
		
		if( $dealdata->current()->purchase_count >= $dealdata->current()->user_limit_quantity)
		{ 
			$total_quantity = $dealdata->current()->user_limit_quantity+$quantity;
		}
		else if( $dealdata->current()->purchase_count < $dealdata->current()->user_limit_quantity && ($dealdata->current()->purchase_count !=0 ) && ($quantity ==0 ) ){
			$total_quantity = $dealdata->current()->purchase_count;
		}
		else if( $dealdata->current()->purchase_count < $dealdata->current()->user_limit_quantity && ($dealdata->current()->purchase_count !=0 ) && ($quantity !=0 ) ){ 
			$total_quantity = $dealdata->current()->purchase_count+$quantity; 
		}

		if(count($dealdata) == 1){
			$oldurlTitle = $dealdata->current()->url_title;
			if($oldurlTitle != url::title($post->title)){	
				$result = $this->db->count_records("product", array("url_title" => url::title($post->title)));
				if($result > 0){
					return 0;
				}
			}
			 
			 $inc_tax = "0";
			 if(isset($_POST['Including_tax'])) {
			        $inc_tax = "1";
			 }
			 
			$result = $this->db->delete('color', array('deal_id' => $deal_id));
			$result = $this->db->delete('product_size', array('deal_id' => $deal_id));
			$savings=($post->price-$post->deal_value);
			  $shipping_amount = "0";
			 if(isset($_POST['shipping_amount'])) {
			        $shipping_amount = $_POST['shipping_amount'];
			 }
			 
			 $weight = "0";
			 if(isset($_POST['weight'])) {
			        $weight = $_POST['weight'];
			 }
			 $height = "0";
			 if(isset($_POST['height'])) {
			        $height = $_POST['height'];
			 }
			 $length = "0";
			 if(isset($_POST['length'])) {
			        $length = $_POST['length'];
			 }
			 $width = "0";
			 if(isset($_POST['width'])) {
			        $width = $_POST['width'];
			 }
			 $duration = "";
			 if(isset($_POST['duration'])) {
			        $duration = serialize($_POST['duration']);
			 }
			 
			 if($post->price!='') // if discount price is not empty orignal price value is inserted to deal_price field and discount price is inserted to deal value 
			{
				$deal_price = $post->deal_value;
				$deal_val = $post->price;
				$savings=($post->deal_value - $post->price);
				$value=($savings/$post->deal_value)*100;
			} else { // if discount price is given empty orignal price value is inserted to deal_value field 
				$deal_val = $post->deal_value;
				$savings=0;
				$deal_price=0;
				$value=0;
			}
			 
			$atr_option = isset($post->attr_option)?$post->attr_option:0; // for attribute
			
			
			$this->db->update("product", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description,"delivery_period"=> $post->delivery_days,"category_id" => $post->category,"sub_category_id" =>  $post->sub_category,"sec_category_id" =>  $post->sec_category, "third_category_id" => $post->third_category, "deal_price" => $deal_price,"deal_value" => $deal_val,"deal_savings" =>$savings,"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => $value,"merchant_id"=>$post->users,"shop_id"=>$post->stores,"color" => $post->color_val,"size" => $post->size_val,"user_limit_quantity"=>$total_quantity,"shipping_amount"=>$shipping_amount,"attribute"=>$atr_option,"Including_tax"=>$inc_tax,"weight" => $weight,"height" => $height,"length" => $length,"width" => $width,"shipping"=>$post->shipping,"product_duration" =>$duration), array("deal_id" => $deal_id, "deal_key" => $deal_key));
			
			if($preview_type=="preview")
				$this->db->update("product",array("deal_status"=>2),array("deal_id" => $deal_id, "deal_key" => $deal_key));
				
			if(isset($_POST['status']) && $_POST['status']==1)
				$this->db->update("product",array("deal_status"=>1),array("deal_id" => $deal_id, "deal_key" => $deal_key,"deal_status"=>2));
			
			if(($post->color_val) == 1){
			foreach($post->color as $c){
			     $result_id = $this->db->from("color_code")->where(array("color_code" => $c))->get();	            
	            $result_color = $this->db->insert("color", array("deal_id" => $deal_id, "color_name" => $c, "color_code_id" => $result_id->current()->id,"color_code_name" => $result_id->current()->color_name));
	                }
	        }
	        
	       if(($post->size_val) == 1){
				$i= 0;
				foreach($post->size as $s){
					$result_count = $this->db->from("product_size")->where(array("deal_id" => $deal_id, "size_id" => $s))->get();
					if(count($result_count)==0){	  
					$result_id = $this->db->from("size")->where(array("size_id" => $s))->get();        
							$size_tot = count((array)$post->size);
							//To avoid None size if other sizes selected
						if($size_tot == 1 && ($s!=1 || $s==1)){
							$result_color = $this->db->insert("product_size", array("deal_id" => $deal_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
						}elseif($size_tot > 1 && $s!=1){
								$result_color = $this->db->insert("product_size", array("deal_id" => $deal_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
						}    
					$i++; }
				} 
			}


		//Attribute start
		
			$attr_result = $this->db->delete('product_attribute', array('product_id' => $deal_id));
		if(($post->attr_option) == 1){
			
		$attr = array_unique($_POST['attribute']);
		//print_r($attr);exit;
	        foreach($attr as $k=>$s){
		$result_attribute = $this->db->insert("product_attribute", array("product_id" => $deal_id, "attribute_id" => $s,"text"=>$_POST['attribute_value'][$k]));
			
				}
				
	        } 

		//Attribute end
		
		$policy = array_unique($_POST['Delivery_value']);
	        if(count($policy)>0){
	        $Deli_result = $this->db->delete('product_policy', array('product_id' => $deal_id));
	        foreach($policy as $p=>$s){
		                $result_Delivery = $this->db->insert("product_policy", array("product_id" => $deal_id,"text"=>$_POST['Delivery_value'][$p]));
				}
		}
		
			
			return 1;
		}
		return 8;
	}

	/** BLOCK UNBLOCK PRODUCTS **/
	
	public function blockunblockproduct($type = "", $key = "", $deal_id = "" )
	{  
		$status = 0;
		if($type == 1){
		$status = 1;
		}
		$result = $this->db->update("product", array("deal_status" => $status), array("deal_id" => $deal_id, "deal_key" => $key));
		return count($result);
	}
	
	/** GET CATEGORY LIST **/
	
	public function all_category_list()
	{
		$result = $this->db->from("category")->get();
		return $result;
	}
	
        /** GET MARCHANT LIST **/
        
	public function getmarchantlist()
        { 

		$result = $this->db->from("users")->where(array("user_type" => '3',"user_status"=> '1'))->orderby("firstname")->get();
		return $result;
        }
	
         /** GET SHOP LIST **/
         
	public function get_shop_list()
        {
                $result = $this->db->from("stores")
                            ->join("users","users.user_id","stores.merchant_id")
                            ->orderby("stores.store_name", "ASC")
                            ->where(array("store_status" => '1'))
                            ->get();
                return $result;
        }
        
        /** GET CITY LIST **/
   	public function get_city_lists()
        {
                $result = $this->db->from("city")
			    ->join("country","country.country_id","city.country_id")
                            ->orderby("city.city_name", "ASC")
                            ->where(array("city_status" => '1',"country.country_status"=>1))
                            ->get();
                return $result;
        }
        
        
        /** GET STORE LIST BY USER **/
        public function get_store_by_users($users = "")
	{
		$result = $this->db->from("stores")->where(array("user_id" => $users, "store_status" => '1',"city.city_status" => '1'))
		->join("city","city.city_id","stores.city_id")
		->join("users","users.user_id","stores.merchant_id")
		->orderby("store_name")->get();
		return $result;
	} 
	
        /** GET USER LIST **/
        
	public function getdeallist()
        {
                $result = $this->db->from("product")
                            ->orderby("deal_title", "ASC")
                            ->where(array("deal_status" => '1'))
                            ->get();
                return $result;
        }
        
        /** VIEW PRODUCT FOR TRANSACTION**/
	
	public function get_transaction_data($deal_id = "")
	{
                $result = $this->db->select("*","transaction.shipping_amount as shippingamount")->from("product")
                                ->where(array("transaction.product_id" => $deal_id,"transaction.type !=" =>5))
	                        	->join("transaction","transaction.product_id","product.deal_id")
	                        	->orderby("transaction.id","DESC")
                                ->get();
                return $result;
	}
	
	 /** VIEW PRODUCT FOR TRANSACTION**/
	
	public function get_cod_transaction_data($deal_id = "")
	{
                $result = $this->db->select("*","transaction.shipping_amount as shippingamount")->from("product")
                                ->where(array("transaction.product_id" => $deal_id,"transaction.type" =>5))
	                        	->join("transaction","transaction.product_id","product.deal_id")
	                        	->orderby("transaction.id","DESC")
                                ->get(); 
                return $result;
	}
	
	/** GET MERCHANT BALANCE **/
	
	public function get_merchant_balance()
	{
		$result =$this->db->from("users")->where(array("user_type" => 3))->get();
		return $result;
	 } 
	 
	 
	 /** GET USER LIST **/
	public function get_transaction_chart_list()
	{	
	        $result = $this->db->from("transaction_mapping")
	                            ->join("product","product.deal_id","transaction_mapping.product_id")
                                ->get();
                return $result;
               
	}
	
	public function get_deals_chart_list()
	{	
	    $result_active_products = $this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE purchase_count < user_limit_quantity and deal_status = 1 and stores.store_status = 1");
		$result["active_products"]=count($result_active_products);
		
		$result_sold_products =$this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE purchase_count = user_limit_quantity and deal_status = 1 and stores.store_status = 1");
		$result["archive_products"]=count($result_sold_products);
		return $result;
	}
	
	/** GET PRODUCT LIST  **/
	
        public function get_users_comments_list($offset = "", $record = "",  $firstname = "",$deal_type = "")
        {
                $contitions = "discussion.type = $deal_type ";
                        if($firstname){
                        $contitions .= ' AND (users.firstname like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR product.deal_title like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR discussion.comments like "%'.mysql_real_escape_string($firstname).'%")';
                        }
                       $result = $this->db->query("select *, discussion.created_date as dis_create from discussion join users on users.user_id=discussion.user_id join product on product.deal_id=discussion.deal_id where $contitions order by discussion_id DESC limit $offset, $record");
                return $result;
        }
	
        /** GET PRODUCT COMMENTS COUNT  **/
	
        public function get_users_comments_count($firstname = "",$deal_type = "")
        {
               $contitions = "discussion.type = $deal_type ";
                        if($firstname){
                        $contitions .= ' AND (users.firstname like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR product.deal_title like "%'.mysql_real_escape_string($firstname).'%"';
                        $contitions .= 'OR discussion.comments like "%'.mysql_real_escape_string($firstname).'%")';
                        }
                       $result = $this->db->query("select *, discussion.created_date as dis_create from discussion join users on users.user_id=discussion.user_id join product on product.deal_id=discussion.deal_id where $contitions order by discussion_id DESC");
                return count($result);
        }
		 /** GET SINGLE PRODUCT COMMENTS DATA **/
	
	public function get_users_comments_data($discussionid = "")
	{
		$result = $this->db->from("discussion")->where(array("discussion_id" => $discussionid))->join("product","product.deal_id","discussion.deal_id")->limit(1)->get();
		return $result;
	}
        
        /** UPDATE PRODUCT COMMENTS**/
	
        public function edit_users_comments($commentsid = "",$post = "") 
        {
                $result = $this->db->update("discussion", array("comments" => $post->comments, "created_date"=>time()), array("discussion_id" => $commentsid));
                return 1;
        }
        
        /** BLOCK & UNBLOCK PRODUCT COMMENTS**/
         
        public function blockunblockusercomments($type = "", $commentsid = "")
        {
                $status = 0;
                if($type == 1){
                    $status = 1;
                }
                $result = $this->db->update("discussion", array("discussion_status" => $status), array("discussion_id" => $commentsid));
                return count($result);
        }

		/** DELETE PRODUCT COMMENT  **/
		
		public function deleteusercomments($discussion_id = "")
		{
			$result = $this->db->delete('discussion', array('discussion_id' => $discussion_id));
					  $this->db->delete('discussion_likes', array('discussion_id' => $discussion_id));
					  $this->db->delete('discussion_unlike', array('discussion_id' => $discussion_id));
			return count($result);

		}		

		/** GET SHIPPING DATA  **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping    **/
	
        public function get_shipping_list($offset = "", $record = "",  $name= "",$type = "",$limit="")
        { 
			$limit1 = $limit !=1 ?"limit $offset,$record":"";
			
				$condition = "AND t.type != 5";
				
				if($type){
					$condition = " AND t.type = 5 ";
					
				}
        		if($_GET){
	        		$contitions = ' (u.firstname like "%'.mysql_real_escape_string($name).'%"';
                    $contitions .= 'OR u.email like "%'.mysql_real_escape_string($name).'%"';
            		$contitions .= 'OR tm.coupon_code like "%'.mysql_real_escape_string($name).'%")';
                   $result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping,stores.city_id as str_city_id from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where $contitions and shipping_type = 1 $condition group by shipping_id order by shipping_id DESC $limit1 "); 
				}
				else {
					$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping,stores.city_id as str_city_id from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id  where shipping_type = 1 $condition group by shipping_id order by shipping_id DESC $limit1 "); 
				}
            
                return $result;
        }

		 /** GET CONTACTS DATA  **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping     **/
	
        public function get_shipping_count($name = "",$type = "")
        {
				$condition = "AND t.type != 5";
				
				if($type){
					$condition = " AND t.type = 5 ";
				}
           		if($_GET){
			        $contitions = ' (u.firstname like "%'.mysql_real_escape_string($name).'%"';
                    $contitions .= ' OR u.email like "%'.mysql_real_escape_string($name).'%"';
					$contitions .= 'OR tm.coupon_code like "%'.mysql_real_escape_string($name).'%")';
                   
                   $result = $this->db->query("select s.shipping_id from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join users as u on u.user_id=s.user_id where $contitions and shipping_type = 1 $condition group by shipping_id order by shipping_id DESC "); 
		}
		else {
			$result = $this->db->query("select s.shipping_id from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join users as u on u.user_id=s.user_id where shipping_type = 1 $condition group by shipping_id order by shipping_id DESC"); 
		}
                return count($result);
        }

	public function update_shipping_status($id = "",$type="")
	{
		
		$result = $this->db->update('shipping_info',array('delivery_status' => $type),array('shipping_id' => $id ,'shipping_type' => 1)); 
		
		return count($result);
	}

	public function get_shipping_product_color()
	{
		$result = $this->db->from("color_code")->orderby("color_name","asc")->get();
		return $result;
	}
	
	public function get_shipping_product_size()
	{
		$result = $this->db->from("size")->get();
		return $result;
	}

	public function validate_coupon($coupon = "",$product_amount = "",$trans_id = "")
	{ 
		$result =  $this->db->count_records("transaction_mapping", array("coupon_code" => $coupon,"transaction_id" => $trans_id,"coupon_code_status" =>1)); 
			if($result > 0){
				$this->db->query("update users set merchant_account_balance = merchant_account_balance + $product_amount where user_type = 1");
				$this->db->update('transaction',array('captured' => 1,'captured_date' =>time(),'payment_status' => 'Success','pending_reason' =>'None'),array('id' => $trans_id));

				$this->db->update('transaction_mapping',array('coupon_code_status' => 0),array("transaction_id" => $trans_id));
				return 1;
			}
	
			else return 0;
	}

	/**  UPDATE THE DELIVERY STATUS OF COD **/
	public function update_cod_shipping_status($id = "",$type="",$trans_id=0,$product_id=0,$merchant_id=0)
	{
			$check = $this->db->count_records('shipping_info',array('shipping_id' =>$id,'delivery_status'=>0));
			if($check){
			$get_detail = $this->db->select("deal_merchant_commission","shipping_amount","tax_amount","amount","product_size","quantity")->from('transaction')->where(array("id" =>$trans_id,"product_id" =>$product_id))->get();
			if(count($get_detail)){
				if($type==4){ // for completed transaction update the merchant balance 
				$product_amount=$get_detail[0]->amount;
				 $total_pay_amount = ($product_amount + $get_detail[0]->shipping_amount + $get_detail[0]->tax_amount); 
				 $commission=(($product_amount)*($get_detail[0]->deal_merchant_commission/100));
				 $merchantcommission = $total_pay_amount - $commission ; 
				// $this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");

				 $this->db->update('transaction',array('captured' => 1,'captured_date' =>time(),'payment_status' => 'Completed','pending_reason' =>'None'),array('id' => $trans_id));

				$this->db->update('transaction_mapping',array('coupon_code_status' => 0),array("transaction_id" => $trans_id));
				
				}
				else if($type==5){  // for failed transcation reset the quantity for that size
						$quantity=$get_detail[0]->quantity;
						$size_id = $get_detail[0]->product_size;
					$this->db->query("update product_size set quantity = quantity + $quantity where deal_id = '$product_id' and size_id = '$size_id' ");

					$this->db->query("update product set user_limit_quantity = user_limit_quantity + $quantity where deal_id = '$product_id'");
					
					$this->db->update('transaction',array('payment_status' => 'Failed','pending_reason' =>'Not paid'),array('id' => $trans_id)); 	
					
				}
			}
		         
		$result = $this->db->update('shipping_info',array('delivery_status' => $type),array('shipping_id' => $id ,'shipping_type' => 1)); 
		
		return count($result);
		}
		return 0;
	}
	
		/** GET SHIPPING DATA FOR DELIVERY MAIL **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping    **/
	
        public function get_shipping_list1()
        {	
			$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id  where shipping_type = 1  group by shipping_id order by shipping_id DESC"); 
            return $result;
        }

        /** GET SINGLE USER DATA **/
	
	public function get_users_data($userid = "")
	{
		$result = $this->db->from("users")->where(array("user_type" => $userid))->where('user_status',1)->orderby("firstname","ASC")->get();
		return $result;
	}
	
	public function change_commission_data($commission = "" , $product_id = "")
	{
	        $result = $this->db->query("update product set commission_status = $commission where deal_id = '$product_id'");
	        return $result;
	}
	
	/*	GET HOT PRODUCT LIST */
	public function get_hot_product_list($product_id="",$type="")
	{
		
		$result= $this->db->update('product',array('deal_feature' => $type),array("deal_id" => $product_id));
		return 1;
	}

	/* Attributes start */
	/*To get all attributes*/
	public function GetAttributes(){
		 $result = $this->db->from("attribute")->get();

		return $result;
	}	

	/*To get single product attributes*/
	public function get_product_attributes($product_id=""){
		 $result = $this->db->from("product_attribute")->where(array("product_id"=>$product_id))->get();
		 return $result;
	}
	
	/*To get single product policy*/
	public function get_product_policy($product_id=""){
		 $result = $this->db->from("product_policy")->where(array("product_id"=>$product_id))->get();
		 return $result;
	}

	/*To get product attribute and attribute groups*/
	public function getProductAttributes() {
		$product_attribute_group_data = array();
		
		$product_attribute_group_query = $this->db->select("ag.attribute_group_id", "ag.groupname", "ag.sort_order")
						->from("attribute as a")
						->join("attribute_group as ag","a.attribute_group" ,"ag.attribute_group_id","left")
						->groupby("ag.attribute_group_id")
						->orderby("ag.sort_order", "ag.groupname","asc")
						->get()->as_array(false);
		//print_r($product_attribute_group_query); exit;
		 foreach ($product_attribute_group_query as $product_attribute_group) {
			$product_attribute_data = array();
			$product_attribute_query = $this->db->select("a.attribute_id", "a.name")
						->from("attribute as a")
						->where(array("a.attribute_group"=>$product_attribute_group['attribute_group_id']))
						->groupby("a.attribute_id")
						->orderby("a.sort_order", "a.name","asc")
						->get()->as_array(false);

			foreach ($product_attribute_query as $product_attribute) {
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute['attribute_id'],
					'name'         => $product_attribute['name']
				);
			}
			
			$product_attribute_group_data[] = array(
				'attribute_group_id' => $product_attribute_group['attribute_group_id'],
				'name'               => $product_attribute_group['groupname'],
				'attribute'          => $product_attribute_data
			);			
		}
		return $product_attribute_group_data;  
	}

	/* Attributes end */
	
	/* Shipping information */
	public function get_shipping_info($id = "")
	{
		$result = $this->db->query("SELECT *,transaction.currency_code as curren_code FROM (`shipping_info`)  LEFT JOIN transaction ON transaction.id = shipping_info.transaction_id WHERE `shipping_id` = $id");
		return $result;
	}
	
	public function tracking($shipping_id = "",$tracking="")
	{
		$result= $this->db->update('shipping_info',array('tracking' => $tracking),array("shipping_id" => $shipping_id));
		
		return 1;
	}
	
	/** GET MERCHANT SHIPPING DATA **/
	
	public function get_shipping_data($user_id = "")
	{
		$result = $this->db->from("shipping_module_settings")->where(array("ship_user_id" => $user_id))->limit(1)->get();
		return $result;
	}
	
	/** GET MERCHANT SHIPPING DATA **/
	
	public function get_check_productdata($user_id = "",$deal = "")
	{
		$result = $this->db->from("product")->where(array("deal_id" =>$deal, "merchant_id" => $user_id))->limit(1)->get();
		return $result;
	}
	
	/** Import product option category add **/

	public function importproduct_addcategory($category = "",$sub_category = "",$sec_category = "",$third_category = "")
	{
		$main_cat_id = 0;
		$sub_cat_id = 0;
		$sec_cat_id = 0;
		$third_cat_id = 0;
		if(($category != "") && ($sub_category != "")){			
		        $result = $this->db->count_records("category", array("category_url" => url::title($category)));
		        if($result > 0){
			        $status = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($category),"type"=>1))->get();
			        $main_cat_id = (count($status))?$status[0]->category_id:0;
		        }
		        if($main_cat_id!=0){
			        $result1 = $this->db->count_records("category", array("category_url" => url::title($sub_category)));
			        if($result1 > 0){
				        $status1 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($sub_category),"type"=>2))->get();
				        $sub_cat_id = (count($status1))?$status1[0]->category_id:0;
			        }
		        }
		        if($sub_cat_id!=0){
			        $result2 = $this->db->count_records("category", array("category_url" => url::title($sec_category)));
			        if($result2 > 0){
				        $status2 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($sec_category),"type"=>3))->get();
				        $sec_cat_id = (count($status2))?$status2[0]->category_id:0;
			        }
		        }
		        $third_cat_id=0;
		        if($third_category!=""){
			        if($sec_cat_id!=0){
				        $result3 = $this->db->count_records("category", array("category_url" => url::title($third_category)));
				        if($result3 > 0){
					        $status3 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($third_category),"type"=>4))->get();
					        $third_cat_id = (count($status3))?$status3[0]->category_id:0;
				        }
			        }
		        }
	        }
		$cat_result['main_category_id'] = $main_cat_id;
		$cat_result['sub_category_id'] = $sub_cat_id;
		$cat_result['sec_category_id'] = $sec_cat_id;
		$cat_result['third_category_id'] = $third_cat_id;
		return $cat_result;
	 }
	
        public function get_merchant_details($merchant_name="",$shop_name="",$merchant_email ="")
        {
	         $query = "select * from users left join stores ON users.user_id=stores.merchant_id where stores.store_name='$shop_name' AND users.email='$merchant_email'";
	         $result = $this->db->query($query);  
	         //print_r($result); exit;                   
	         return $result;
        }

        public function get_color_details($color)
        {
                $result = $this->db->from("color_code")->where(array("color_name" => $color))->get();
                return $result;
        }
	
	public function get_size_details($size)
	{
		$result = $this->db->count_records("size", array("size_name" => $size));
		if($result == 0){
			$result = $this->db->insert("size",array("size_name" =>$size,"size_arabic" =>""));
		}
		$result = $this->db->from("size")->where(array("size_name" => $size))->get();
		return $result;
	}
	
	public function get_merchant_and_shop_status($merchant_name="",$shop_name="",$merchant_email ="")
	{
		 $query = "select * from users left join stores ON users.user_id=stores.merchant_id where stores.store_name='$shop_name' AND users.email='$merchant_email'";
		$result_1 = $this->db->query($query);  
		$result = count($result_1);
		if($result == 1)
		{
			return 1;
		} else {
			return 0;
		}
	}
	
	public function add_import_product($adminid ="",$title = "",$deal_key="", $category_id = "",$sub_category_id = "",$sec_category_id = "",$third_category_id = "",$product_price ="", $discount_price ="", $product_desc = "",$deliver_days ="",$merchant_id ="",$shop_id ="",$color_val ="",$size_val ="",$col ="",$size ="",$size_quantity="",$attribute_type="",$attribute="",$meta_keywords="",$meta_description="",$deliver_policy="",$shipping_amount_val = "" , $shipping_method = "",$shipping_weight = "", $shipping_height = "", $shipping_length ="", $shipping_width ="")
	{
		if($category_id !="0" && $sub_category_id !="0" ) {
                        $quantity = "";
                        foreach($size_quantity as $sq){
                                $quantity += $sq;
                        }
			$inc_tax = "1";
			$shipping_amount = "0";
			 if(isset($shipping_amount_val)) {
			        $shipping_amount = $shipping_amount_val;
			 }
			 $weight = "0";
			 if(isset($shipping_weight)) {
			        $weight = $shipping_weight;
			 }
			 $height = "0";
			 if(isset($shipping_height)) {
			        $height = $shipping_height;
			 }
			 $length = "0";
			 if(isset($shipping_length)) {
			        $length = $shipping_length;
			 }
			 $width = "0";
			 if(isset($shipping_width)) {
			        $width = $shipping_width;
			 }
			 
			$savings=($product_price-$discount_price);
			$result = $this->db->insert("product", array("deal_title" => $title,"url_title" => url::title($title), "deal_key" => $deal_key,"category_id" => $category_id,"sub_category_id" => $sub_category_id,"sec_category_id" =>  $sec_category_id,"third_category_id" =>  $third_category_id,"deal_price" => $product_price,"deal_value" => $discount_price,"deal_savings" => $savings,"deal_percentage" => ($savings/$discount_price)*100,"deal_description" => $product_desc,"size" =>$size_val,"color" =>$color_val,"delivery_period" => $deliver_days,"merchant_id" =>$merchant_id,"shop_id" => $shop_id,"created_date" => time(),"created_by"=>$adminid,"user_limit_quantity"=>$quantity,"deal_status" =>0,"attribute"=>$attribute_type,"meta_description"=>$meta_description,"meta_keywords"=>$meta_keywords,"shipping_amount"=>$shipping_amount,"shipping"=>$shipping_method,"Including_tax" =>$inc_tax,"weight" => $weight,"height" => $height,"length" => $length,"width" => $width,"created_date" => time()));
	                $product_id = $result->insert_id();
                        if(($color_val) == 1){
                                foreach ($col as $colors) {
                                        $color_detail = explode("_",$colors);
                                        $color_id = $color_detail[0];
                                        $color_code = $color_detail[1];
                                        $color_name = $color_detail[2];
                                        $result_color = $this->db->insert("color", array("deal_id" => $product_id, "color_name" => $color_code, "color_code_id" => $color_id,"color_code_name" => $color_name));
                                }
                        }
                        if(($size_val) == 1){
                                foreach ($size as $sizes) {
                                        $size_detail = explode("_",$sizes);
                                        $size_id =$size_detail[0];
                                        $size_name =$size_detail[1];
                                        $size_quant =$size_detail[2];
                                        $result_color = $this->db->insert("product_size", array("deal_id" => $product_id, "size_name" => $size_name, "size_id" => $size_id,"quantity"=>$size_quant));
                                }		
                        }
                        if($attribute_type !=0){
                                foreach($attribute as $a) {
                                        $vals = explode('-',$a);
                                        $main_attr_group = isset($vals[0])?$vals[0]:'';
                                        $sub_attr_group = isset($vals[1])?$vals[1]:'';
                                        $attr_description = isset($vals[2])?$vals[2]:'';
                                        $main_group_id = $this->get_main_group($main_attr_group);
                                        $sub_group_id = $this->get_sub_group($sub_attr_group,$main_group_id);
                                        if(($main_attr_group !='') &&  ($sub_attr_group !='')) {
                                                $result_attribute = $this->db->insert("product_attribute", array("product_id" => $product_id, "attribute_id" => $sub_group_id,"text"=>$attr_description));
                                        }
                                }	
                        }
                        $Deli_result = $this->db->delete('product_policy', array('product_id' => $product_id));
	                $result_Delivery = $this->db->insert("product_policy", array("product_id" => $product_id,"text"=>$deliver_policy));
	                return $product_id;
	                }
           }
        
           /* GET ATTRIBUTE MAIN GROUP DETAILS */
	   public function get_main_group($groupname="")
	   {
			$result = $this->db->select("attribute_group_id")->from("attribute_group")->where(array("groupname"=>$groupname))->get();
			$group_id = (count($result))?$result[0]->attribute_group_id:0;
			return $group_id;
	   }
	   
	   /* GET ATTRIBUTE SUB GROUP DETAILS */
	   public function get_sub_group($subgroupname="",$maingroupid="")
	   {
			$result = $this->db->select("attribute_id")->from("attribute")->where(array("name"=>$subgroupname,"attribute_group"=>$maingroupid))->get();
			$sub_group_id = (count($result))?$result[0]->attribute_id:0;
			return $sub_group_id;
	   }
	   /* GET DURATION PERIOD ACCORDING TO MERCHANT */
		public function get_duration_values($user_id="")
		{
			$result = $this->db->from("duration")->where(array("duration_status"=>1,"duration_merchantid"=>$user_id))->orderby("duration_period","ASC")->get();
			return $result;
		}
		
	public function change_product_status($deal_id = "" )
	{
		$status = 1;
		$result = $this->db->update("product", array("deal_status" => $status), array("deal_id" => $deal_id));
		return count($result);
	}
	
	
		
	
/* COUNT OF STORE CREDIT TRANSACTION */
	public function count_transaction_storecredit_list($status="",$search_key="")
	{
		$result = $this->db->select("storecredit_id")->from("store_credit_save")->join("product","product.deal_id","store_credit_save.productid")->where(array("credit_status"=>$status))->get();
		return count($result);
	}
	
	/* GET STORE CREDIT TRANSACTION LIST */
	public function get_transaction_storecredit_list($status="",$search_key="",$offset = "", $record = "")
	{
		$condition="";
		$result = $this->db->query("select * from store_credit_save as s join product on product.deal_id = s.productid join users on users.user_id = s.userid where credit_status = $status $condition order by storecredit_id desc limit $offset,$record ");
		
		return $result;
	}

}
