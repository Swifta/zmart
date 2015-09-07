<?php defined('SYSPATH') or die('No direct script access.');
class Admin_attributes_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->user_id = $this->session->get("user_id");	
	}

	/** ADD ATTRIBUTE  **/
	
	public function add_attribute($data = "")
	{ 

		$result =  $this->db->count_records("attribute", array("name" => $data->name,"attribute_group="=>$data->attribute_group));
			if($result > 0){
				return 0;
			} 
		$result = $this->db->insert("attribute",array("name" =>$data->name, "attribute_group" =>$data->attribute_group,"sort_order"=>$data->sort_order));
			return 1;
	}	

	/** GET ATTRIBUTE COUNT  **/
	
	public function get_attribute_count()
	{
		return $this->db->count_records("attribute");
	}

	/** GET ATTRIBUTE LIST  **/
	
	public function get_attribute_list($offset = "", $record = "")
	{
		$result = $this->db->select("attribute.name","attribute.attribute_id","attribute.sort_order", "attribute.attribute_group", "attribute_group.groupname")->from('attribute')->join("attribute_group","attribute.attribute_group","attribute_group.attribute_group_id","left")->orderby("attribute.sort_order","ASC","attribute.name","ASC")->limit($record,$offset)->get();
 
		return $result;

	}

	/** EDIT ATTRIBUTE DATA AND UPDATE  **/

	public function edit_attribute($attribute_id = "",$data = "")
	{
			$result =  $this->db->count_records("attribute", array("name" => $data->name,"attribute_group="=>$data->attribute_group,"attribute_id!="=>$attribute_id));
			if($result > 0){
				return 0;
			}
			$status = $this->db->update("attribute", array("name" =>$data->name, "attribute_group" =>$data->attribute_group,"sort_order"=>$data->sort_order),array("attribute_id" => $attribute_id));
		return 1;

	}

	public function get_all_attribute_group(){
		return $this->db->orderby("sort_order","ASC","groupname","ASC")->get('attribute_group');
	}

	/** GET SINGLE ATTRIBUTE DATA FOR EDIT  **/

	public function getattributeData($attribute_id = "")
	{
		return $this->db->getwhere('attribute',array('attribute_id' => $attribute_id));
	}
	
	/** DELETE ATTRIBUTE **/
	
	public function delete_attribute($attribute_id = "")
       {
               $this->db->delete("product_attribute",array("attribute_id" => $attribute_id ));
               $result = $this->db->delete("attribute",array("attribute_id" => $attribute_id ));
               return count($result);
       }
	
	/*UNIQUE ATTRIBUTE NAME CHECK*/
	public function check_attribute_exist($name,$group){
			
		$result =  $this->db->count_records("attribute", array("name" => $name,"attribute_group_id"=>$group));
		 
		return $result;
	}

	/** INSERT SIZE VALUE TO THE DATABASE */
	
	public function add_attribute_group($data = "")
	{
		$result = $this->db->insert("attribute_group",array("groupname" =>$data->groupname,"sort_order"=>$data->sort_order));
			return 1;
	}	
	
	
	/** GET ATTRIBUTE GROUP COUNT  **/
	
	public function get_attribute_group_count()
	{
		return $this->db->count_records("attribute_group");
	}

	/** GET ATTRIBUTE GROUP LIST  **/
	
	public function get_attribute_group_list($offset = "", $record = "")
	{
		return $this->db->orderby("sort_order","ASC","groupname","ASC")->limit($record,$offset)->get('attribute_group');
	}

	/** EDIT ATTRIBUTE GROUP DATA AND UPDATE  **/

	public function edit_attribute_group($group_id = "",$data = "")
	{

		$result =  $this->db->count_records("attribute_group", array("groupname" => $data->groupname,"attribute_group_id!=" => $group_id));
			if($result > 0){
				return 0;
			}

		$status = $this->db->update("attribute_group", array("groupname" =>$data->groupname,"sort_order"=>$data->sort_order),array("attribute_group_id" => $group_id));
		return 1;

	}

	/** GET SINGLE ATTRIBUTE GROUP DATA FOR EDIT  **/

	public function getattributegroupData($group_id = "")
	{
		return $this->db->getwhere('attribute_group',array('attribute_group_id' => $group_id));
	}

	/** DELETE ATTRIBUTE GROUP **/
	
	public function delete_attribute_group($group_id = "")
	{
	   $attr_array= $this->db->select('attribute_id')->from('attribute')->where(array('attribute_group' => $group_id))->get()->as_array(false);
               $attr_id = "";
               foreach($attr_array as $val)
               {
                       $attr_id .= $val['attribute_id'].",";
                       
               }
               $attr_id = rtrim($attr_id,",");
               if($attr_id!=""){
				$this->db->query(" DELETE ab FROM product_attribute AS ab WHERE ab.attribute_id IN ($attr_id) "); // for delete the releted product attributes
				}
             
               $this->db->delete("attribute",array("attribute_group" => $group_id )); // for delete the releted atttributes
              
               $result = $this->db->delete("attribute_group",array("attribute_group_id" => $group_id )); // for delete the attrtibute group
              return count($result);
              
		return count($result);
	}

	/*UNIQUE ATTRIBUTE GROUP NAME CHECK*/
	public function check_attrgroup_exist($groupname){
			
		$result =  $this->db->count_records("attribute_group", array("groupname" => $groupname));
		 
		return $result;
	}

}
