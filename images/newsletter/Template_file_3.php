public function importproduct_addcategory($category = "",$sub_category = "",$sec_category = "",$third_category = "")
	{
		$main_cat_id = 0;
		$sub_cat_id = 0;
		$sec_cat_id = 0;
		$third_cat_id = 0;
		if(($category != "") && ($sub_category != "")){			
			$result = $this->db->count_records("category", array("category_url" => url::title($category)));
			if($result > 0){ // Get Main Category id
				$status = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($category),"type"=>1))->get();
				$main_cat_id = (count($status))?$status[0]->category_id:0;
				if($main_cat_id!=0){
			        $result1 = $this->db->count_records("category", array("category_url" => url::title($sub_category)));
			        if($result1 > 0){ // Get Sub Category id
				        $status1 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($sub_category),"type"=>2))->get();
				        $sub_cat_id = (count($status1))?$status1[0]->category_id:0;
				         if($sub_cat_id!=0){ 
							$result2 = $this->db->count_records("category", array("category_url" => url::title($sec_category)));
							if($result2 > 0){ // Get Secondary Category id
								$status2 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($sec_category),"type"=>3))->get();
								$sec_cat_id = (count($status2))?$status2[0]->category_id:0;
								if($third_category!=""){
									if($sec_cat_id!=0){
										$result3 = $this->db->count_records("category", array("category_url" => url::title($third_category)));
										if($result3 > 0){ // Get Third Category id
											$status3 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($third_category),"type"=>4))->get();
											$third_cat_id = (count($status3))?$status3[0]->category_id:0;
										}else{ // Add Third Category 
											$insert_result3 = $this->db->insert("category", array("category_name" => $third_category , "category_url" => url::title($third_category),"category_status" => 1,"product" => 1,"type" => 4,"main_category_id"=>$main_cat_id,"sub_category_id"=>$sec_cat_id));
											if(count($insert_result3) == 1)
												$third_cat_id=$insert_result3->insert_id();
										}
									}
								}
							}else{ // Add Secondary Category 
								$insert_result2 = $this->db->insert("category", array("category_name" => $sec_category , "category_url" => url::title($sec_category),"category_status" => 1,"product" => 1,"type" => 3,"main_category_id"=>$main_cat_id,"sub_category_id"=>$sub_cat_id));
								if(count($insert_result2) == 1){
									$sec_cat_id=$insert_result2->insert_id();
									if($third_category!=""){ // Add Third Category 
										$insert_result3 = $this->db->insert("category", array("category_name" => $third_category , "category_url" => url::title($third_category),"category_status" => 1,"product" => 1,"type" => 4,"main_category_id"=>$main_cat_id,"sub_category_id"=>$sec_cat_id));
										if(count($insert_result3) == 1)
											$third_cat_id=$insert_result3->insert_id();
									}
								}
							}
						}
			        }else{ // Add Sub Category 
						$insert_result1 = $this->db->insert("category", array("category_name" => $sub_category , "category_url" => url::title($sub_category),"category_status" => 1,"product" => 1,"type" => 2,"main_category_id"=>$main_cat_id,"sub_category_id"=>$main_cat_id));
						if(count($insert_result1) == 1){
							$sub_cat_id=$insert_result1->insert_id(); // Add Secondary Category 
							$insert_result2 = $this->db->insert("category", array("category_name" => $sec_category , "category_url" => url::title($sec_category),"category_status" => 1,"product" => 1,"type" => 3,"main_category_id"=>$main_cat_id,"sub_category_id"=>$sub_cat_id));
							if(count($insert_result2)==1){
								$sec_cat_id=$insert_result2->insert_id(); // Third category add process
								if($third_category!=""){
									$insert_result3 = $this->db->insert("category", array("category_name" => $third_category , "category_url" => url::title($third_category),"category_status" => 1,"product" => 1,"type" => 4,"main_category_id"=>$main_cat_id,"sub_category_id"=>$sec_cat_id));
									if(count($insert_result3) == 1)
										$third_cat_id=$insert_result3->insert_id();
								}								
							}
						}
					}
		        }
			}else{ // Main category add process
				$insert_result = $this->db->insert("category", array("category_name" => $category , "category_url" => url::title($category),"category_status" => 1,"product" => 1,"type" => 1,"main_category_id"=>0,"sub_category_id"=>0));
				if(count($insert_result) == 1){
					$main_cat_id=$insert_result->insert_id(); // Sub category add process
					$insert_result1 = $this->db->insert("category", array("category_name" => $sub_category , "category_url" => url::title($sub_category),"category_status" => 1,"product" => 1,"type" => 2,"main_category_id"=>$main_cat_id,"sub_category_id"=>$main_cat_id));
					if(count($insert_result1)==1){
						$sub_cat_id=$insert_result1->insert_id(); // Sec Sub category add process
						$insert_result2 = $this->db->insert("category", array("category_name" => $sec_category , "category_url" => url::title($sec_category),"category_status" => 1,"product" => 1,"type" => 3,"main_category_id"=>$main_cat_id,"sub_category_id"=>$sub_cat_id));
						if(count($insert_result2)==1){
							$sec_cat_id=$insert_result2->insert_id(); // Third category add process
							if($third_category!=""){
								$insert_result3 = $this->db->insert("category", array("category_name" => $third_category , "category_url" => url::title($third_category),"category_status" => 1,"product" => 1,"type" => 4,"main_category_id"=>$main_cat_id,"sub_category_id"=>$sec_cat_id));
								if(count($insert_result3) == 1)
									$third_cat_id=$insert_result3->insert_id();
							}
						}
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
			$result = $this->db->insert("product", array("deal_title" => $title,"url_title" => url::title($title), "deal_key" => $deal_key,"category_id" => $category_id,"sub_category_id" => $sub_category_id,"sec_category_id" =>  $sec_category_id,"third_category_id" =>  $third_category_id,"deal_price" => $product_price,"deal_value" => $discount_price,"deal_savings" => $savings,"deal_percentage" => ($savings/$discount_price)*100,"deal_description" => $product_desc,"size" =>$size_val,"color" =>$color_val,"delivery_period" => $deliver_days,"merchant_id" =>$merchant_id,"shop_id" => $shop_id,"created_date" => time(),"created_by"=>$adminid,"user_limit_quantity"=>$quantity,"deal_status" =>1,"attribute"=>$attribute_type,"meta_description"=>$meta_description,"meta_keywords"=>$meta_keywords,"shipping_amount"=>$shipping_amount,"shipping"=>$shipping_method,"Including_tax" =>$inc_tax,"weight" => $weight,"height" => $height,"length" => $length,"width" => $width,"created_date" => time()));
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
