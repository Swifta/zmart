<?php defined('SYSPATH') or die('No direct script access.');
class Admin_cms_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db = new Database();	
	}

	/** ADD PAGES **/

	public function add_pages($post = "")
	{
		$type =2 ;
		$description = $post->desc; 
		if($post->cms_type == 2){
			 $type = 3;
			 $description = $post->url;
		}
		$result = $this->db->insert("cms", array("cms_title" => ucfirst($post->title), "cms_url" => url::title($post->title), "cms_desc" =>$description ,"type" => $type));
		return 1;
	}

	/** GET PAGES **/

	public function get_pages()
	{
		$result = $this->db->from("cms")->get();
		return $result;
	}

	/** GET SINGLE PAGE **/

	public function get_single_page($cms_id = "", $cms_url = "")
	{
		$result = $this->db->from("cms")->where(array("cms_id" => $cms_id, "cms_url" => $cms_url))->get();
		return $result;
	}

	/** EDIT CMS PAGES **/

	public function edit_cms($cms_id ="", $cms_url="", $post="")
	{   

		if($cms_url != url::title($post->title)){
			$records = $this->db->from("cms")->where(array("cms_url" => $cms_url))->get();
			if(count($records) == 0){
			return 0;
			}
		}
			$type =2 ;
		$description = $post->desc; 
		if($post->cms_type == 2){
			 $type = 3;
			 $description = $post->url;
		}
		
		$result = $this->db->update("cms", array("cms_title" => ucfirst($post->title), "cms_url" => url::title($post->title),"cms_desc" =>$description ,"type" => $type), array("cms_id" => $cms_id));
		return  1;

	}
    
    	/** DELETE CMS **/

	public function delete_cms($id = "", $title = "")
	{	
		$status = $this->db->delete("cms", array("cms_id" => $id, "cms_url" => $title));
		return count($status);

	}

	/** BLOCK AND UNBLOCK CMS **/
	
	public function blockunblock_cms($type = "", $id = "", $title = "")
	{	
		$status = 0;
		if($type == 1){
			$status = 1;
		}
		$result = $this->db->update("cms", array("cms_status" => $status), array("cms_id" => $id, "cms_url" => $title ));		
		return count($result);
	}
	
	/** CMS EXIST **/
	
	public function exist_cms($title = "")
	{
		$result = $this->db->count_records('cms', array('cms_title' => $title));
		return (bool) $result;
	}
	
	/** GET ABOUT US DATA **/
	public function about_us_data()
	{
		$result = $this->db->from("cms")->where(array("type" => 1))->limit(1)->get(); 
		if(count($result) == 0){
		$this->db->insert("cms",array("cms_title" => 1,"cms_title" => "About Us", "cms_url" => "about-us","type" => 1));
		}
		return $result;
	}
	
	/** ABOUT US DATA ADD **/
	
	public function about_us($post = "")
	{   
		$result = $this->db->update("cms", array("cms_desc" => $post), array("type" => 1) );
		return 1;
	}
	
	/** DEALS BOUGHT ADD **/
	public function deals_bought($desc = "")
	{
		
		$result = $this->db->update("cms", array("cms_desc" => $desc), array("cms_id" => 7));
		return 1;
	}
	
	/** UPDATE COPY RIGHT **/
	public function copy_right($desc)
	{
		
		 $result = $this->db->update("cms", array("cms_desc" => $desc), array("cms_id" => 8));
		 return 1;
	}

	/**  GET DEALS BOUGHT **/
	
	public function get_deals_bought()
	{
		$result = $this->db->from("cms")->where(array("cms_id" => 7))->get();
		return $result;
	}
	
	/**  GET COPY RIGHT **/
	public function get_copy_right()
	{
		$result = $this->db->from("cms")->where(array("cms_id" => 8))->get();
		return $result;
	}

}

