<?php defined('SYSPATH') OR die('No direct access allowed.'); 

class newsletter{
	
	public function send($city_list = array())
	{


		ini_set('memory_limit', '256M');
		if(!ini_get('safe_mode') ){
		set_time_limit(7200);
		}$userLists = array();  $cnt = 0;
		include APPPATH."/vendor/swift/SmtpApiHeader.php";

		$this->newsletter_user_list = $this->news->get_subscribed_user_list();
		$this->all_category_list = $this->news->get_top_category_list();
		$this->all_city_list = $this->news->get_all_city_list();
                $this->all_setting_module = $this->news->get_setting_module_list();
		foreach($this->all_setting_module as $setting){
		        $this->newsletter_setting = $setting->is_newsletter;
		}

		foreach($this->newsletter_user_list as $UList){
			$userLists[$UList->subscribe_id] = array("email" => $UList->email_id,"country_id" => explode(",", $UList->country_id), "city_id" => explode(",", $UList->city_id), "category_ids" => explode(",", $UList->category_id));

		}
		
		foreach($city_list as $C){

			$Cdata = explode("__", $C);


			if(isset($Cdata[0]) && isset($Cdata[1])){
				$category_id = $Cdata[0]; $category_name = $Cdata[1];

				$this->all_deals_list_by_city = $this->news->get_city_daily_deals_list($category_id);

				$this->all_products_list_by_city = $this->news->get_city_daily_products_list($category_id);

				$this->all_auction_list_by_city = $this->news->get_city_daily_auction_list($category_id);

				if(count($this->all_products_list_by_city) || count($this->all_deals_list_by_city) || count($this->all_auction_list_by_city)) {
					foreach($userLists as $UL){
					
					foreach($UL["category_ids"] as $cat){
					
					if($cat == $category_id){
					
						$this->cityName = $category_name;


						//if( $cnt > 0){
							$from = CONTACT_EMAIL;
							$this->email=$UL["email"];
							$title = $_SERVER['HTTP_HOST']." ".ucfirst($this->cityName).$this->Lang['DEALS']; 
						        
						        if($this->newsletter_setting == 1){
	        					        $template_content = new View("themes/".THEME_NAME."/send_daily_deal_template");
						        } elseif($this->newsletter_setting == 2){
	        					        $template_content = new View("themes/".THEME_NAME."/send_daily_deal_template_2");
						        } elseif($this->newsletter_setting == 3){
        						        $template_content = new View("themes/".THEME_NAME."/send_daily_deal_template_3");
						        } elseif($this->newsletter_setting == 4){
						                $template_content = new View("themes/".THEME_NAME."/send_daily_deal_template_4");
						        } 							
							
							if(EMAIL_TYPE==2){
							email::smtp1($from,array($UL["email"]), $title , $template_content);
							 
							}else{
								email::sendgrid($from,array($UL["email"]), $title , $template_content);
							}
							
		                               
		                               }
				        }
				        }
				        
				     }
				     else {
							echo $this->Lang['NO_DATA']; 
					}
				}



			//}
		}
		
	
	}

}
?>
