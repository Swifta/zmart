<?php defined('SYSPATH') or die('No direct script access.');
class Ads_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();	
	}
	
	/* POST ADS */
	
	public function add_ads($addtitle = "",$add_position = "",$page_position="",$redirect_url="")
	{
		$result = $this->db->insert("ads", array("ads_title" => $addtitle,"ads_position" => $add_position,"page_position" => $page_position,"redirect_url" =>$redirect_url));
		return $result->insert_id();
	}

	/* CHECK POSITION EXISTS  */
	
	public function position_exist($page_position = "",$position="")
	{
		$result = $this->db->count_records("ads", array("ads_position" => $position,"page_position" =>$page_position));
		
		return (bool) $result;
	}

	/* GET ALL ADS - MANAGE ADS */
	
	public function manage_ad()
	{
		$records = $this->db->from("ads")->get();
		return $records;
	}
	
	/* GET ADS DATA  */
	
	public function get_one_record($id = "", $position = "")
	{
		$get_record=$this->db->from("ads")->where(array("ads_id" => $id, "ads_position" => $position))->get();
		return $get_record;
	}
	
	/** EDIT ADS **/

	public function ad_update($addtitle="",$position="",$oldpg_position="",$page_position="",$redirect_url="",$new_position="",$id="")
	{	
		if($position != $new_position ){
			$result = $this->db->count_records("ads", array("ads_position" => $new_position,"page_position" =>$page_position));
			if($result == 1){
				
				return 9;
			}
		} if($oldpg_position != $page_position ){
			$result = $this->db->count_records("ads", array("ads_position" => $new_position,"page_position" =>$page_position));
			if($result == 1){
				
				return 9;
			}
		}		
		$result=$this->db->update("ads",array("ads_title" => $addtitle,"ads_position" => $new_position,"page_position" =>$page_position,"redirect_url" =>$redirect_url), array("ads_id" => $id));
		
		return $id;	
	}
	
	/** BLOCK AND UNBLOCK ADS **/
	
	public function blockunblock_Ad($type="", $id = "")
	{	 
		$status = 0;
		if($type == 1){
			$status = 1;
		}
		$result = $this->db->update("ads", array("status" => $status), array("ads_id" => $id));		
		return count($result);
	}

	/** DELETE ADS **/

	public function delete_ads($id = "")
	{
		$status = $this->db->delete("ads", array("ads_id" => $id));
		return count($status);
	}
}
