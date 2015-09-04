<?php defined('SYSPATH') OR die('No direct access allowed.');
class error {

	/** ERROR HANDLING **/

	public function _error($err_arr = "")
	{
		$my_error = array();
		foreach($err_arr as $key => $value)
		{
			switch ($value) {
				case 'Required*':
					$my_error[$key] = $this->Lang["REQQ"];
					break;
				case 'required':
					$my_error[$key] = $this->Lang["REQQ"];
					break;
					
				case 'check_required':
					$my_error[$key] = $this->Lang["REQQ"];
					break;
								
				case 'length':
					$my_error[$key] = $key ." ".$this->Lang["RE_C"];
					break;
				case 'email':
					$my_error[$key] = $this->Lang["IN_EM"];
					break;
				case 'url':
					 $my_error[$key] = $this->Lang["IN_URL"];
					break;
				case 'chars':
					 $my_error[$key] = $this->Lang["INVA"]." " .$key;
					break;
				case 'type':
					$my_error[$key] = $this->Lang["IN_IMG"];
					break;
				case 'size':
					$my_error[$key] = $this->Lang["IMG_LESS"];
					break;
				case 'available':
				    $my_error[$key] = $this->Lang["EMAIL_AL_E"];
				    break;
				case 'title_available':
				    $my_error[$key] = $this->Lang["TITLE_AL_E"];
				    break;
				case 'price_available':
				    $my_error[$key] = $this->Lang["PRICE_AL_E"];
				    break;
			        case 'email_available':
				    $my_error[$key] = $this->Lang["EMAIL_AL_E"];
				    break;
			        case 'affiliate_available':
				    $my_error[$key] = $this->Lang["SITE_NA_E"];
				    break;
			        case 'city_avaliable':
				    $my_error[$key] = $this->Lang["CITY_AL_E"];
				    break;
				case 'validphone':
					 $my_error[$key] = $this->Lang["INV_PH"];
					break;
				case 'validnum':
					 $my_error[$key] = $this->Lang["INV_NUM"];
					break;	
					
				case 'valid_commision':
					 $my_error[$key] = $this->Lang["COMM_PE"];
					break;

				case 'check_end_date':
					 $my_error[$key] = $this->Lang["END_V"];
					break;
				
				case 'check_price_lmi':
					 $my_error[$key] = $this->Lang["CHK_P"];
					break;
				case 'check_price_lmi_prd':
					 $my_error[$key] = $this->Lang["CHK_PRD"];
					break;
				case 'check_min_fund':
					 $my_error[$key] = $this->Lang["MIN_F"];
					 break;
				case 'check_desc_empty':
					$my_error[$key] = $this->Lang["REQQ"];
					break;
				
				case 'check_purchace_lmi':
					 $my_error[$key] = $this->Lang["MAX_U"];
					 break;
				case 'check_min_lmi':
					 $my_error[$key] = $this->Lang["MIN_L"];
					 break;
				case 'check_product_purchace_lmi':
					 $my_error[$key] = $this->Lang["PUR_L"];
					 break;

				case 'check_expiry_date':
					 $my_error[$key] = $this->Lang["EXP_V"];
					break;
				case 'discount';
					$my_error[$key] = $this->Lang["SAV_GRT"];
					break;
				case 'valid_image_url':
					 $my_error[$key] = $this->Lang["IN_IM"];
					break;
				case 'check_image_or_url':
					 $my_error[$key] = $this->Lang["ADD_IM_S"];
					break;
				case 'matches':
				    $my_error[$key] = $this->Lang["PDM"];
				    break;
			    	case 'oldpassword':
				    $my_error[$key] = $this->Lang["OLD_P_D"];
				    break;
			    	case 'check_password':
				    $my_error[$key] = $this->Lang["CUR_P_D"];
				    break;
			    	case 'cms_exist':
			        $my_error[$key] = $this->Lang["PAG_AL_E"];
			        break;

				case 'position_exist':
					$my_error[$key] = $this->Lang["POSITION_AL_E"];
			        break;
			    case 'home_position_exist':
					$my_error[$key] = $this->Lang["POSITION_CANT_E"];
			        break;
			   case 'fund_max_lmi':
					 $my_error[$key] = $this->Lang["MAX_FUND_REQ"];
				break;
			        case 'fund_min_lmi':
					 $my_error[$key] = $this->Lang["MIN_FUND_REQ"];
				break;
				
				case 'check_price_val_lmi':
					 $my_error[$key] = $this->Lang["IN_VALID"];
				break;
				case 'check_deal_value_lmi':
					 $my_error[$key] = $this->Lang["IN_VALID"];
				break;
				case 'check_maxlimit_lmi':
					 $my_error[$key] = $this->Lang["MAXIMUM_DEAL"];
				break;
				case 'check_deal_price':
					 $my_error[$key] = $this->Lang["ACT_PRI_LES_PRO_PRI"];
				break;
				case 'check_bid_increment_val':
					 $my_error[$key] = $this->Lang["BID_PRI_LES_ACT_PRI"];
				break;
				case 'validposition':
					 $my_error[$key] = $this->Lang["POS_EXIST"];
				break;
				case 'check_percentage':
					$my_error[$key] = $this->Lang["PER_GR"];
				break;
				case 'check_value':
					 $my_error[$key] = $this->Lang["ENTR_NON_ZR"];
				break;
				case 'check_day':
					 $my_error[$key] = $this->Lang["PLZ_ENTR"];
				break;                           
				case 'check_sector_exist':
					 $my_error[$key] = $this->Lang["ALL_SEC"];
				break;
				case 'check_store_exist':
					 $my_error[$key] = $this->Lang["ALL_STR"];
				break;
				case 'check_store_exist1':
					 $my_error[$key] = $this->Lang["ALL_STR"];
				break;
				case 'check_attrgroup_exist':
				$my_error[$key] = $this->Lang["ATTR_GROUP_EXIST"];
				break;
				case 'check_store_admin':
				$my_error[$key] = $this->Lang["STORE_ADMIN_ALREADY_EXIT"];
				break;
				case 'check_store_admin1':
				$my_error[$key] = $this->Lang["STORE_ADMIN_ALREADY_EXIT"];
				break;
				case 'check_store_admin_with_supplier':
				$my_error[$key] = $this->Lang["STORE_ADMIN_MAIL"];
				break;
				case 'check_store_admin_with_supplier1':
				$my_error[$key] = $this->Lang["STORE_ADMIN_MAIL"];
				break;
				case 'check_store_admin_with_supplier33':
				$my_error[$key] = $this->Lang["STORE_ADMIN_MAIL"];
				break;

			}
		}
		return $my_error;
	}

	public function setMessage($type = "", $msg = "")
	{
		$session = Session::instance();
		if($type == 1){
			$session->set("Msg",$msg);
		}elseif($type == -1)
		{
			$session->set("Emsg",$msg);
		}
	}

}
