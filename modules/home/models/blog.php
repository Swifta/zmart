<?php defined('SYSPATH') or die('No direct script access.');
class Blog_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();	
		
	}
	
	/** GET BLOGS CATEGORY LIST **/
	
	public function get_category_list()
	{
		$result = $this->db->from("category")
		->where(array("category_status" => 1,"main_category_id"=>0))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	public function get_category_list_cat($blogcat = "")
	{
	        $result = $this->db->query("SELECT * FROM category  WHERE category_id IN ($blogcat) and category_status = 1 and main_category_id= 0 ");
		return $result;
	}
	
	/** GET BLOG DATA **/
	
	public function get_blog_count($category_url = "", $type = "", $search_cat = "")
	{              		
		$conditions = 'blog.publish_status = 1 and blog.blog_status = 1';
		if($_GET){
			if($search_cat){
				$conditions .= ' and blog.blog_title like "%'.mysql_real_escape_string($search_cat).'%"';	
			}
		}
		if($type != 1){  
		$res = $this->db->select("category_id")->from("category")->where(array("category_url" => $category_url))->get(); 	
			$conditions .= ' and blog.category_id = '.$res->current()->category_id;		
		}else{

		}    	
		$result = $this->db->from("blog")
				->join("category","category.category_id","blog.category_id")
				->where($conditions)								
				->orderby("blog.blog_id", "DESC")
				->get();
		return count($result);
	}
	
	/** GET BLOG DATA  **/
	
	public function get_blog_list($offset = "", $record = "", $category_url = "", $type = "",  $search_cat = "")
	{ 
		$conditions = 'blog.publish_status = 1 and blog.blog_status = 1';
		if($_GET){
			if($search_cat){
				$conditions .= ' and blog.blog_title like "%'.mysql_real_escape_string($search_cat).'%" ';	
			}
		}
		if($type != 1){  
			$res = $this->db->select("category_id")->from("category")->where(array("category_url" => $category_url))->get(); 	
			$conditions .= ' and blog.category_id = '.$res->current()->category_id;		
		}else{

		}   		
			$result = $this->db->from("blog")
						->join("category","category.category_id","blog.category_id")
						->where($conditions)								
						->orderby("blog.blog_id", "DESC")
						->limit($record,$offset)
						->get();							
		return $result;
	}
	
	
	public function get_blog_list_count()
	{ 
		$conditions = 'blog.publish_status = 1 and blog.blog_status = 1';
		
			$result = $this->db->from("blog")
						->join("category","category.category_id","blog.category_id")
						->where($conditions)								
						->orderby("blog.blog_id", "DESC")
						->get();							
		return $result;
	}
	
	/** GET BLOGS POPULAR LIST **/
	
	public function get_popular_list()
	{
		$result = $this->db->from("blog")
						->join("category","category.category_id","blog.category_id")
						->where(array("blog.publish_status"=> 1, "blog.blog_status" => 1))
						->orderby("blog.blog_views", "DESC")
						->limit(5)
						->get();	
		return $result;
	}
	
	/** GET SINGLE BLOG DATA **/
	
	public function get_blog_details($blog_url = "")
	{ 
						
		$result = $this->db->from("blog")
						->join("category","category.category_id","blog.category_id")						
						->where(array("blog.url_title" => $blog_url))       					
						->get(); 
		return $result;
	}
	
	/** GET COMMENT LIST FOR A PARTICULAR BLOG **/
	
	public function get_comments_list($blog_url = "")
	{ 
		$conditions = 'blog_comments.approve_status = 1 and blog_comments.comments_status = 1';
		if($blog_url){
			$res = $this->db->select("blog_id")->from("blog")->where(array("url_title" => $blog_url))->get(); 	
			$conditions .= ' and blog_comments.blogg_id = '.$res->current()->blog_id;		
		}
		$result = $this->db->from("blog_comments")
					->join("blog","blog.blog_id","blog_comments.blogg_id")
					->where($conditions)								
					->orderby("blog_comments.comments_id", "DESC")					
					->get();							
		return $result;
	}
	
	/** INSERT COMMENTS **/
	
	public function add_comments($post = "", $blog_url = "", $notify_comments = "", $approve_status = "")
	{ 
		$res = $this->db->select("blog_id")->from("blog")->where(array("url_title" => $blog_url))->get(); 
		if($res){
			$bloggid = $res->current()->blog_id;
			$result = $this->db->insert("blog_comments", array("name" => $post->sender_name, "email" => $post->email, "website" => $post->website, "comments" => htmlspecialchars($post->comments),"blogg_id" => $bloggid, "approve_status" => $approve_status, "notify_comments"=> $notify_comments, "comments_date" => time()));
			if(count($result) == 1){			
				if($approve_status == 1){			
					$this->db->query("update blog set comments_count = comments_count+1 where blog_id='$bloggid'");
					return 1 ;
				}else{					
					return 2;
				}
			}
		}	
		return 0; 
	}
	
	/** GET ALL BLOG SETTINGS DATA **/
	
	public function get_blog_settings_data()
	{
		$result = $this->db->from("blog_settings")->limit(1)->get();
		return $result;
	}
	
	/** GET ALL BLOG RSS DATA **/
	
	public function get_rss_blogs_lists()
	{		
		$conditions = 'blog.publish_status = 1 and blog.blog_status = 1';			
		$result = $this->db->from("blog")
					->join("category","category.category_id","blog.category_id")
					->where($conditions)								
					->orderby("blog.blog_id", "DESC")					
					->get();							
		return $result;
	}
		
}
