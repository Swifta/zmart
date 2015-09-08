<?php defined('SYSPATH') or die('No direct script access.');
class Admin_blog_Model extends Model
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
						->where(array("category_status" => 1,"main_category_id"=>0))
						->orderby("category_name", "ASC")
						->get();
		return $result;
	}
	
	/** CHECK BLOG TITLE EXIST OR NOT **/

	public function exist_blogtitle($blogtitle)
	{
		$result = $this->db->count_records('blog', array('blog_title' => $blogtitle));
		return (bool) $result; 
	}
	
	/** ADD BLOG **/

	public function add_blog($post = "", $allow_comments = "")
	{ 

		$result = $this->db->insert("blog", array("blog_title" => $post->title, "url_title" => url::title($post->title), "category_id" => $post->category, "blog_description" => htmlspecialchars($post->description), "meta_title" => $post->meta_title, "meta_description" => $post->meta_description, "meta_keywords"=> $post->meta_keywords, "tags" => $post->tags, "allow_comments" => $allow_comments, "publish_status" => $post->pub_status, "blog_date" => time()));
		if(count($result) == 1){			
			$last_id = $result->insert_id();
			if($post->tags != ''){
				$tag_name=explode(",",$post->tags);
		                        foreach($tag_name as $tags_name)
		                        {                 
		                                $select = $this->db->select("tags_name")->from("tags")->where(array("tags_name" => $tags_name))->get();
		                                if(count($select)==0)
		                                {
		                                        $this->db->insert("tags", array("tags_name" => $tags_name, "module_type" => 1));
		                                }
		                                else
		                                {                                                 
		                                        $this->db->query("UPDATE tags set tags_count=tags_count+1 where tags_name='$tags_name'");
		                                }
		                        }     
			}	
			return $last_id; 
		}
		return 0; 
		
	}
	
	/** GET TOTAL NUMBER OF BLOGS **/
	
	public function get_blog_count($title = "", $category = "", $type = "")
	{ 				
		$conditions = 'blog.publish_status ='.$type;
		if($_GET){			
			if($title){
				$conditions .= ' and blog_title like "%'.mysql_real_escape_string($title).'%"';
			}									
			if($category){
				$conditions .= ' and blog.category_id = '.$category;
			}
			$query = "select * from blog left join category on category.category_id=blog.category_id where $conditions";			
			$result = $this->db->query($query);	
		}
		else{  												
			$result = $this->db->from("blog")
						->join("category","category.category_id","blog.category_id")					
						->where($conditions)						
						->orderby("blog.blog_id", "ASC")
						->get();
		} 
		return count($result);
	}
	
	/** GET ALL BLOG TITLES **/

	public function get_blog_list($offset = "", $record = "",  $title = "", $category = "", $type = "")
	{		
		$conditions = 'blog.publish_status ='.$type;
		if($_GET){			
			if($title){
				$conditions .= ' and blog_title like "%'.mysql_real_escape_string($title).'%"';
			}									
			if($category){
				$conditions .= ' and blog.category_id = '.$category;
			}
			$query = "select * from blog left join category on category.category_id=blog.category_id where $conditions order by blog.blog_id desc limit $offset,$record";			
			$result = $this->db->query($query);	
		}
		else{ 							
			$result = $this->db->from("blog")
						->join("category","category.category_id","blog.category_id")
						->where($conditions)								
						->limit($record,$offset)
						->orderby("blog.blog_id", "DESC")
						->get();

		} 
		return $result;
	}
		
	/** BLOCK UNBLOCK BLOGS **/
	
	public function blockunblockblog($type = "", $blog_id = "", $title_url = "")
	{
		$status = 0;
		if($type == 1){
		    $status = 1;
		}
		$result = $this->db->update("blog", array("blog_status" => $status), array("blog_id" => $blog_id, "url_title" => $title_url));
		return count($result);
	}
	
	/** PUBLISH BLOGS **/
	
	public function publishblog($blog_id = "", $title_url = "")
	{		
		$result = $this->db->update("blog", array("publish_status" => 1, "blog_date" => time()), array("blog_id" => $blog_id, "url_title" => $title_url)); 
		return count($result);
	}
	
	/** DELETE BLOGS **/
	
	public function deleteblog($blog_id = "", $title_url = "")
	{
		$result = $this->db->delete("blog", array("blog_id" => $blog_id, "url_title" => $title_url));
		if($result){
			$this->db->delete("blog_comments",array("blogg_id" => $blog_id));
			if(file_exists(DOCROOT.'/images/blog_images/'.$blog_id.'.jpg') )
			{                              
				unlink(DOCROOT.'/images/blog_images/'.$blog_id.'.jpg');                                                              
				unlink(DOCROOT.'/images/blog_images/100/'.$blog_id.'.jpg');
			}
               }   
		return count($result);
	} 
	
	/** VIEW SINGLE BLOG **/

	public function view_blog($blog_id = "", $title_url = "")
	{				 							
		$result = $this->db->from("blog")
					->join("category","category.category_id","blog.category_id")						
					->where(array("blog_id" => $blog_id, "url_title" => $title_url))
					->get();
		return $result;
	}
	
	/** GET BLOG DETAILS WHICH ARE TO BE EDITED  **/

	public function get_edit_blog($blog_id = "", $title_url = "")
	{				 							
		$result = $this->db->from("blog")
					->join("category","category.category_id","blog.category_id")						
					->where(array("blog_id" => $blog_id, "url_title" => $title_url))
					->get();
		return $result;
	}
	
	/** EDIT BLOG **/ 
	
	public function edit_blog($post = "", $blog_id = "", $allow_comments = "", $redirect_type = "")
	{			
		$blogdata = $this->db->select("blog_title","url_title")->from("blog")->where(array("blog_id" => $blog_id))->get();
		if(count($blogdata) == 1){						
			$oldurlTitle = $blogdata->current()->url_title;
			if($oldurlTitle != url::title($post->title)){	
				$result = $this->db->count_records("blog", array("url_title" => url::title($post->title)));
				if($result > 0){
					return 0;
				}
			}
		$result = $this->db->update("blog", array("blog_title" => $post->title, "url_title" => url::title($post->title), "category_id" => $post->category, "blog_description" => htmlspecialchars($post->description), "meta_title" => $post->meta_title, "meta_description" => $post->meta_description, "meta_keywords"=> $post->meta_keywords, "tags" => $post->tags, "allow_comments" => $allow_comments, "publish_status" => $post->pub_status),array("blog_id" => $blog_id));
			if($post->tags != ''){
				$tag_name=explode(",",$post->tags);

					foreach($tag_name as $tags_name)
					{                 
						$select = $this->db->select("tags_name")->from("tags")->where(array("tags_name" => $tags_name))->get();
						if(count($select)==0)
						{
						        $this->db->insert("tags", array("tags_name" => $tags_name, "module_type" => 1, "tags_count" => 1));
						}		                                
					}    
			}  
			if($post->pub_status == 1 && $redirect_type == 2){
				$result = $this->db->update("blog", array("blog_date" => time()),array("blog_id" => $blog_id));
			}
		return 1; 
		
		}
	}
	
	/*** GET ALL BLOG SETTINGS DATA **/
	
	public function get_blog_settings_data()
	{
		$result = $this->db->from("blog_settings")->limit(1)->get();
		return $result;
	}
	
	/** UPDATE BLOG SETTING **/
	
	public function blog_settings($post = "")
	{
		if($post->post_per_page == 0){
			$post->post_per_page = 1;
		}
		$result = $this->db->update("blog_settings",array("allow_comment_posting" => $post->allow_comment_posting, "require_adminapproval_comments" => $post->require_approval_comments, "posts_per_page" => $post->post_per_page ),array("blog_settings_id" => 1));
		return 1;
	}
	
	/** GET COMMENTS DEATILS **/
	
	public function get_comments_list($blog_id = "")
	{
		$result = $this->db->from("blog_comments")
							->join("blog","blog.blog_id", "blog_comments.blogg_id")
							->where(array("blog_comments.blogg_id" => $blog_id))
							->orderby("comments_id", "DESC")
							->get();
		return $result;
	}
	
	/** BLOCKUNBLOCK COMMENTS **/

	public function block_comments($type = "", $id = "",$blog_id = "")
	{
		$app_status = $this->db->select("approve_status")->from("blog_comments")->where(array("comments_id" => $id))->get();		
		$status = 0;
		if($type == 1){
			$status = 1;				
			if($app_status->current()->approve_status == 1){
				$this->db->query("update blog set comments_count = comments_count+1 where blog_id='$blog_id'");
			}	
		}else{
			if($app_status->current()->approve_status == 1){
				$this->db->query("update blog set comments_count = comments_count-1 where blog_id='$blog_id'");			
			}	
		}
		$result = $this->db->update("blog_comments", array("comments_status" => $status),array("comments_id" => $id,"blogg_id" => $blog_id));
		return count($result);
	}
	
	/** DELETE COMMENTS **/
	
	public function delete_comments($id = "",$blog_id = "")	
	{
		$this->db->query("update blog set comments_count = comments_count-1 where blog_id='$blog_id'");	
		$result = $this->db->delete("blog_comments",array("comments_id" => $id,"blogg_id" => $blog_id));
		return count($result);
	}
	
	/** APPROVE DISAPPROVE COMMENTS **/

	public function approvedisapprove_comments($type = "", $id = "",$blog_id = "")
	{
		$comm_status = $this->db->select("comments_status ")->from("blog_comments")->where(array("comments_id" => $id))->get();	
		$status = 0;
			if($type == 1){
				$status = 1;
				if($comm_status->current()->comments_status == 1){
					$this->db->query("update blog set comments_count = comments_count+1 where blog_id='$blog_id'");
				}	
			}else{
				if($comm_status->current()->comments_status == 1){
					$this->db->query("update blog set comments_count = comments_count-1 where blog_id='$blog_id'");			
				}	
			}
		$result = $this->db->update("blog_comments", array("approve_status" => $status),array("comments_id" => $id,"blogg_id" => $blog_id));
		return count($result);
	}
}
	
	 
