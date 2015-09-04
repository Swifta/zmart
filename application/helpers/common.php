<?php defined('SYSPATH') OR die('No direct access allowed.');
class common{
	public function __construct()
	{
		parent::__construct();
		$this->session = Session::instance();
		$this->home = new Home_Model();
	}

	/** IMAGE RE-SIZE **/

	/*public function image($filename = "", $widthadjust1 = "", $heightadjust1 = "", $image_path = "")
	{
		$widthadjust = $widthadjust1;
		$heightadjust = $heightadjust1;
		list($width, $height) = getimagesize($filename);
		if($width > $widthadjust ){
			$heightadjust = $height * ( $widthadjust / $width);
		}
		else{
			$widthadjust = $width;
		}
		if($heightadjust >  $heightadjust1){
			Image::factory($filename)->resize($widthadjust,$heightadjust, Image::WIDTH)->crop($widthadjust, $heightadjust1, 'top')->save($image_path);
		}
		elseif($heightadjust < $height ){
			Image::factory($filename)->resize($widthadjust,$heightadjust, Image::HEIGHT)->crop($widthadjust, $heightadjust, 'top')->save($image_path);
		}
		else{
			Image::factory($filename)->resize($widthadjust,$heightadjust, Image::WIDTH)->save($image_path);
		}
	} */


	public function image($filename = "", $widthadjust1 = "", $heightadjust1 = "", $image_path = "")
	{
	        ini_set('memory_limit','512M');
	        set_time_limit(0);
		/* $path_parts = pathinfo($image_path);
		 $file_path = $path_parts['dirname'];
		 chmod($file_path, 0777);
		 chmod(PATH.'upload', 0777);  */
		$ext=$filename;
		$lastDot = strrpos($ext, ".");
                $string = str_replace(".", "", substr($ext, 0, $lastDot)) . substr($ext, $lastDot);
		$path = explode('.',$string);
		$extension = end($path);
		if($extension=="jpg" || $extension=="jpeg"|| $extension=="JPG"|| $extension=="JPEG" )
		{
		$uploadedfile = $filename;
		$src = imagecreatefromjpeg($uploadedfile);
		}
		else if($extension=="png"|| $extension=="PNG")
		{
		$uploadedfile = $filename;
		$src = imagecreatefrompng($uploadedfile);
		}
		else
		{
		$uploadedfile = $filename;
		$src = imagecreatefromgif($uploadedfile);
		}
                 //ORIGINAL DIMENTIONS
	        list( $width , $height ) = getimagesize($filename);
                //ORIGINAL SCALE
	        $xscale=$width/$widthadjust1;
		$yscale=$height/$heightadjust1;
                //NEW DIMENSIONS WITH SAME SCALE
		if ($yscale > $xscale)
		{
			$new_width = round($width * (1/$yscale));
			$new_height = round($height * (1/$yscale));
		}  else  {
                        $new_width = round($width * (1/$xscale));
                        $new_height = round($height * (1/$xscale));
		}
		if($height > $heightadjust1|| $width > $widthadjust1)
		{
			if($heightadjust1 < 700)
			{       $newheight1=$heightadjust1;     } else {
				$newheight1=700;
			}
			$newwidth1=$widthadjust1;
			$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
                                        imagealphablending($tmp1, false);
                                        imagesavealpha($tmp1, true);
                                        //$source = imagecreatefrompng($filename);
                                        imagealphablending($src, true);
                                        imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
			$filename = $image_path;
		        header('Content-Type: image/png');
			imagepng($tmp1,$filename);
			imagedestroy($tmp1);
		}
		elseif( $height > $heightadjust1 && $width > $widthadjust1)
		{
			$newwidth1=$widthadjust1;
			$newheight1=$heightadjust1;
			$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
					imagealphablending($tmp1, false);
					imagesavealpha($tmp1, true);
					//$source = imagecreatefrompng($filename);
					imagealphablending($src, true);
                                        imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
			$filename = $image_path;
			header('Content-Type: image/png');
			imagepng($tmp1,$filename);
			imagedestroy($tmp1);
		}
		else
		{
			$newwidth1=$width;
			$newheight1= $height;
			$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
					imagealphablending($tmp1, false);
					imagesavealpha($tmp1, true);
					//$source = imagecreatefrompng($filename);
					imagealphablending($src, true);
        				imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
			$filename = $image_path;
			header('Content-Type: image/png');
			imagepng($tmp1,$filename);
			imagedestroy($tmp1);
		}
	}

        public function compress($source = "", $destination = "", $quality = "") {
                ini_set('memory_limit','512M');
	        set_time_limit(0);
                $info = getimagesize($source);
                if ($info['mime'] == 'image/jpeg') 
	                $image = imagecreatefromjpeg($source);
                elseif ($info['mime'] == 'image/gif') 
	                $image = imagecreatefromgif($source);
                elseif ($info['mime'] == 'image/png') 
	                $image = imagecreatefrompng($source);
                imagejpeg($image, $destination, $quality);
                return $destination;
        }
        
        
        public function createthumb($source_image,$destination_image_url, $get_width, $get_height){
	ini_set('memory_limit','512M');
	set_time_limit(0);

	$image_array         = explode('/',$source_image);
	$image_name = $image_array[count($image_array)-1];
	$max_width     = $get_width;
	$max_height =$get_height;
	$quality = 100;

	//Set image ratio
	list($width, $height) = getimagesize($source_image);
	$ratio = ($width > $height) ? $max_width/$width : $max_height/$height;
	$ratiow = $width/$max_width ;
	$ratioh = $height/$max_height;
	$ratio = ($ratiow > $ratioh) ? $max_width/$width : $max_height/$height;

	if($width > $max_width || $height > $max_height) {
		$new_width = $width * $ratio;
		$new_height = $height * $ratio;
	} else {
		$new_width = $width;
		$new_height = $height;
	}

	if (preg_match("/.jpg/i","$source_image") or preg_match("/.jpeg/i","$source_image")) {
		//JPEG type thumbnail
		$image_p = imagecreatetruecolor($new_width, $new_height);
		$image = imagecreatefromjpeg($source_image);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagejpeg($image_p, $destination_image_url, $quality);
		imagedestroy($image_p);

	} elseif (preg_match("/.png/i", "$source_image")){
		//PNG type thumbnail
		$im = imagecreatefrompng($source_image);
		$image_p = imagecreatetruecolor ($new_width, $new_height);
		imagealphablending($image_p, false);
		imagecopyresampled($image_p, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagesavealpha($image_p, true);
		imagepng($image_p, $destination_image_url);

	} elseif (preg_match("/.gif/i", "$source_image")){
		//GIF type thumbnail
		$image_p = imagecreatetruecolor($new_width, $new_height);
		$image = imagecreatefromgif($source_image);
		$bgc = imagecolorallocate ($image_p, 255, 255, 255);
		imagefilledrectangle ($image_p, 0, 0, $new_width, $new_height, $bgc);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagegif($image_p, $destination_image_url, $quality);
		imagedestroy($image_p);

	} else {
		echo 'unable to load image source';
		exit;
	}
}
	
	/** SET STATUS MESSAGE **/

	public function message($type = "", $message = "")
	{
		if($type == 1){
			$this->session->set("Success", $message);
		}
		elseif($type == -1){
			$this->session->set("Error",$message);
		}
	}

	/** SEND EMAIL **/

	public function sentmail($to = "", $from = "", $subject = "", $message = "")
	{
		if($from == ""){
			$from = $this->message = Kohana::config('settings.admin_email');
		}
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'.$from.'' . "\r\n";
		mail($to, $subject, $message, $headers);
	}

	/** Category Mapping **/

	public function category_mapping($deal_category = "", $categoryList = array())
	{

		$category = 0; $sub_category = 0;
		if(is_object($deal_category)){
			$dealcat = "";
			foreach($deal_category as $c){
				$dealcat .= $c.",";
			}
			$deal_category = $dealcat;
		}


		$deal_category = explode(",", strtolower($deal_category));
		foreach($categoryList as $indx => $cat_list){
			foreach($deal_category as $dc){

				//$this->affiliate->add_category_mapping($dc);

				if(in_array($dc, array_map('strtolower',$cat_list)) && $dc ){
					$category = $indx;
					$sub_category = 0;
				}
			}
		}
		return array($category,$sub_category);
	}

	/** CURL FUNCTION FOR FACEBOOK POST **/

	public function fb_curl_function($req_url = "", $type = "", $arguments =  array())
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $req_url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		if($type == "POST") {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $arguments);
		}

		$result = curl_exec($ch);
		curl_close ($ch);
		return $result;
	}
	/* STORE'S DEAL,PRODUCT,AUCTION COUNT IN STORE PAGE */
	public function get_deal_count($store_id = "",$type="")
	{
		$this->stores = new Stores_Model();
		if($type==1) {
		$this->get_deals_categories = $this->stores->get_deals_categories($store_id,"",1);
		if(count($this->get_deals_categories)){
			return count( $this->get_deals_categories );
		} else {
			return  "-";
		}
		}
		if($type==2) {
		$this->get_product_categories = $this->stores->get_product_categories($store_id,"",1);
		if(count($this->get_product_categories)){
			return count( $this->get_product_categories );
		} else {
			return  "-";
		}
		}
		if($type==3) {
		$this->get_auction_categories = $this->stores->get_auction_categories($store_id,"",1);
		if(count($this->get_auction_categories)){
			return count( $this->get_auction_categories);
		} else {
			return  "-";
		}
		}
	}

	public function manage_subscriber($cityid="")
	{

		$this->news = new Newsletter_Model();
		$this->city_list = $this->news->getCityList1($cityid);
		if(count($this->city_list) >0 )
		{
			$city_name="";
			foreach($this->city_list as $city)
			 {
				 $city_name .= $city->city_name.',';
			 }
			 return rtrim($city_name,',');
		}
	}

	/*   COUNT OF SUBCATEGORY   */
	public function get_subcat_count($cat_id = "",$type = "",$cat_type = "",$cat_url = "")
	{

                        $deal_count = 0;
                        $product_count = 0;
                        $auction_count = 0;
                       if($type == 2){
                        $this->deals = new Deals_Model(); // for deal
			$deal_count = $this->deals->get_deals_count($cat_type,$cat_url);
			}
                        if($type == 3){
                        $this->products = new Products_Model(); // for product
			$product_count = $this->products->get_products_count($cat_type,$cat_url);
                        }
                        if($type == 4){
                        $this->auction = new Auction_Model(); // for auction
			$auction_count = $this->auction->get_deals_count($cat_type,$cat_url);
			}

			if($type == 1){ // for Home page category count
				return ($deal_count+$product_count+$auction_count);
			}
			else if($type == 2){  // For Deal category count
				return $deal_count;
			}
			else if($type == 3){ // For Product category count
				return $product_count;
			}
			else if($type == 4){ // For auction category count
				return $auction_count;
			}
			else{
				return 0;
			}
	}

	/*   COUNT OF SUBCATEGORY   */
	public function get_subcat_count1($cat_id = "",$cat_type = "")
	{
			$status = $this->home->get_subcat_count($cat_id,$cat_type);
			return $status;
	}
	public function currency_conversion($fromcurrency="",$tocurrency="",$amount="")
	{
		if($fromcurrency !="USD" && $amount!=0){
				// Currency conversion start
			/*$amount = urlencode($amount);
			$from_Currency = urlencode($fromcurrency);
			$to_Currency = urlencode($tocurrency);
			$url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
			$ch = curl_init();
			$timeout = 0;
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$rawdata = curl_exec($ch);
			curl_close($ch);
			$data = explode('"', $rawdata);
			$data = explode(' ', $data['3']);
			$var = $data['0'];
			return round($var,2); ///the 2 indicates how many decimal points you want. I set it at the API's limit of 2 */

			  $amount = urlencode($amount);
			$from_Currency = urlencode($fromcurrency);
			$to_Currency = urlencode($tocurrency);
			$get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
			$get = explode("<span class=bld>",$get); //print_r($get);
			$get = explode("</span>",$get[1]);
			$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);
			return round($converted_amount,2);
		}
		return $amount;
	}
	
	public function paypal_currency_conversion($fromcurrency="",$tocurrency="",$amount="")
	{
		if($fromcurrency !="USD" && $amount!=0){
			  $amount = urlencode($amount);
			$from_Currency = urlencode($fromcurrency);
			$to_Currency = urlencode($tocurrency);
			$get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
			$get = explode("<span class=bld>",$get); //print_r($get);
			$get = explode("</span>",$get[1]);
			$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);
			return $converted_amount;
		}
		return $amount;
	}

	public function truncate_digits($rate = 0)
	{
		$rand_amount = preg_replace("/[^0-9\.]/", '', $rate);
		$number = floor(($rand_amount*100))/100;
		return $number;
	}

	public function get_city_name($city_id)
	{
		$this->home = new Home_Model();
		return $this->home->get_city_name($city_id);
	}
	
	public function shipping_address()
	{
		$this->shipping_address =$this->home->get_ship_address();
		$data = "";
			foreach($this->shipping_address as $s) {

			$data .= "<address><p>".ucfirst($s->ship_name)."</p><p> ".ucfirst($s->ship_address1)."</p><p>$s->ship_address2</p><p> ".ucfirst($s->city_name)."".','."".ucfirst($s->country_name)."</p><p>Zipcode : $s->ship_zipcode</p><p>Phone : $s->ship_mobileno</p>";
			$data .= "<input type='hidden' id='ship_nam' value='$s->ship_name'>
				<input type='hidden' id='ship_address2' value='$s->ship_address2'>
				<input type='hidden' id='ship_zipcode' value='$s->ship_zipcode'>
				<input type='hidden' id='ship_city' value='$s->ship_city'>
				<input type='hidden' id='ship_country' value='$s->country_name'>
				<input type='hidden' id='ship_address1' value='$s->ship_address1'>
				<input type='hidden' id='ship_state' value='$s->ship_state' >
				<input type='hidden' id='ship_phone' value='$s->ship_mobileno' >

			</address> ";

			}
			echo $data;
	}
	
	public function shipping_rates_calculator($Product_weight = "", $Product_length = "", $Product_width = "", $Product_height = "", $usercity = "" , $userCountryCode = "")
	{
	
	//echo $Product_weight."- ".$Product_length." -".$Product_width." -".$Product_height; exit;
	
        $shipping_details =$this->home->get_shipping_settings();
        foreach($shipping_details as $shipping){
                        $AccountCountryCode = $shipping->AccountCountryCode;
                        $AccountEntity = $shipping->AccountEntity;
                        $AccountNumber = $shipping->AccountNumber;
                        $AccountPin = $shipping->AccountPin;
                        $UserName = $shipping->UserName;
                        $Password = $shipping->ShippingPassword;
        }
	$params = array(
		       'ClientInfo'  			=> array(
									        'AccountCountryCode'	=> $AccountCountryCode,
									        'AccountEntity'		 	=> $AccountEntity,
									        'AccountNumber'		=> $AccountNumber,
									        'AccountPin'		 	=> $AccountPin,
									        'UserName'			=> $UserName,
									        'Password'			=> $Password,
									        'Version'			 	=> 'v1.0'
								        ),
		        'Transaction' 			=> array(
									        'Reference1'			=> '001' 
								        ),
								
		        'OriginAddress' 	 	=> array(
									        'City'					=> 'Amman',
									        'CountryCode'			=> 'JO'
								        ),
								
		        'DestinationAddress' 	=> array(
									        'City'					=> 'Dubai',
									        'CountryCode'			=> 'AE'
								        ),
								        
		        'Dimensions'                    => array(
								                'Length'				=> $Product_length,
									        'Width'				=> $Product_width,
									        'Height'				=> $Product_height,
									        'Unit'				=> 'cm',
								        ),
								        
		        'ShipmentDetails'		=> array(
									        'PaymentType'			 => 'P',
									        'ProductGroup'			 => 'EXP',
									        'ProductType'			 => 'PPX',
									        'ActualWeight' 			 => array('Value' => $Product_weight, 'Unit' => 'KG'),
									        'ChargeableWeight' 	         => array('Value' => $Product_weight, 'Unit' => 'KG'),
									        'NumberOfPieces'		 => 1
								        )
	        );
	        $soapClient = new SoapClient('aramex-rates-calculator-wsdl.wsdl', array('trace' => 1));
	        $results = $soapClient->CalculateRate($params);
	        //print_r($results); exit;
	        return $results;
	        }
	        
        public function address_verification($address1 = "", $address2 = "", $PostCode = "", $CountryCode = "", $city = "")
	{
	        $soapClient = new SoapClient('Location-API-WSDL.wsdl');
	        $params = array(
	                'ClientInfo'  			=> array(
								                'AccountCountryCode'	=> 'JO',
								                'AccountEntity'		 	=> 'AMM',
								                'AccountNumber'		=> '20016',
								                'AccountPin'		 	=> '331421',
								                'UserName'			=> 'testingapi@aramex.com',
								                'Password'		 	=> 'R123456789$r',
								                'Version'		 	        => 'v1.0',
								                'Source' 			        => NULL	
							                ),
		        'Address' 			=> array(
									        'Line1'			=> $address1,
									        'Line2'			=> $address2,
									        'Line3'			=> '',
									        'City'			        => $city,
									        'StateOrProvinceCode'=> '',
									        'PostCode'			=> $PostCode,
									        'CountryCode'	        => $CountryCode						 
								        )
		        );
	        // calling the method and printing results
	        try {
		        $auth_call = $soapClient->ValidateAddress($params);
		       //  echo '<pre>';
		        //print_r($auth_call->HasErrors);
		        //print_r($auth_call);
		        return $auth_call;
		        die();
	        } catch (SoapFault $fault) {
		        die('Error : ' . $fault->faultstring);
	        }
	}
	
	/* GET THE MERCHANT BASED THEME */
	public function get_theme($store_url="")
	{
		$this->get_theme_details = $this->home->get_theme_name($store_url);
		return $this->get_theme_details;
	}
	
	public function mysql_escape_string_function($value)
	{
	    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
	    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

	    return str_replace($search, $replace, $value);
	}
	
	public function chmod_r($Path) {
	    chmod($Path, 0777);
	    $dp = opendir($Path);
	    
	     while($File = readdir($dp)) {
	       if($File != "." AND $File != "..") {
		 if(file_exists($Path."/".$File) && is_dir($Path."/".$File) && $File !='.svn'){
		    chmod($Path."/".$File, 0777);
		    common::chmod_r($Path."/".$File);
		 }else{
			if($File !='.svn')
			{
		     	chmod($Path."/".$File, 0777);
			}	
		 }
	       }
	     }
	   closedir($dp);
	}

}
?>
