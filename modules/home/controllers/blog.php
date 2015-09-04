<?php defined('SYSPATH') OR die('No direct access allowed.');
class Blog_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->blog = new Blog_Model;
		$this->blog_settings = $this->blog->get_blog_settings_data();
		$this->header = "blog";
		$this->is_blog = 1;
		/*if(LANGUAGE == "french" ){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/french_style.css',PATH.'themes/'.THEME_NAME.'/css/fr_multi_style.css'));
		}else if(LANGUAGE == "spanish"){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/spanish_style.css',PATH.'themes/'.THEME_NAME.'/css/sp_multi_style.css'));
		}
		else{
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}*/
		if(isset($_SESSION['select_lang'])){
			if($_SESSION['select_lang']==2){
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/ha_style.css',PATH.'themes/'.THEME_NAME.'/css/ha_multi_style.css'));
			}else if($_SESSION['select_lang']==3){
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/ig_style.css',PATH.'themes/'.THEME_NAME.'/css/ig_multi_style.css'));
			}else if($_SESSION['select_lang']==4){
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/yo_style.css',PATH.'themes/'.THEME_NAME.'/css/yo_multi_style.css'));
			}else{
				$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
			}
		}else{
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}
		$this->template->javascript .= html::script(array(PATH.'themes/'.THEME_NAME.'/js/jquery.validate.js'));
		if(count($this->blog_settings) == 1){
			$this->allow_posting = $this->blog_settings->current()->allow_comment_posting;
			$this->comments_settings = $this->blog_settings->current()->require_adminapproval_comments;
			$this->post_per_page = $this->blog_settings->current()->posts_per_page ;
		}
		if(!$this->blog_setting){
		        url::redirect(PATH);
		}
	}

	/** BLOG **/

	public function index($type = "", $category_url = "", $page = "")
	{
		if($type == 1){
                        $this->url = 'blog';
                        $seg = 3;
		} else {
                        $this->url = 'blog/category/'.$category_url.'.html';
                        $seg = 5;
		}
		$this->count_blogs = $this->blog->get_blog_count($category_url,$type,$this->input->get('search'));
		$this->pagination = new Pagination(array(
	                'base_url'       => $this->url.'/page/'.$page."/",
	                'uri_segment'    => $seg,
	                'total_items'    => $this->count_blogs,
	                'items_per_page' => $this->post_per_page,
	                'style'          => 'digg',
	                'auto_hide' => TRUE
	                ));
		$this->blog_list = $this->blog->get_blog_list($this->pagination->sql_offset, $this->pagination->items_per_page, $category_url, $type, $this->input->get('search'));
		$this->blog_list_count = $this->blog->get_blog_list_count();
		$blogval = "";
		foreach($this->blog_list_count as $blog){
		        $blogval .=$blog->category_id.",";
		}
		$blogcat = substr($blogval,'0','-1');
		$this->search = 1;
		if($blogcat == ""){
		$blogcat = "0";
		}
		$this->category_list = $this->blog->get_category_list_cat($blogcat);
		$this->popular_list = $this->blog->get_popular_list();
		$this->template->title = $this->Lang["BLOG"]." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/blog/blog");
	}

	/** BLOG DETAILS **/

	public function blog_detail($blog_url = "")
	{
			if($_POST){
				$this->userPost = $this->input->post();
				$post = new Validation($_POST);
				$post = Validation::factory($_POST)
							->add_rules('sender_name', 'required')
							->add_rules('email', 'valid::email', 'required')
							->add_rules('comments', 'required');

				if($post->validate()){
					$notify_comment = $this->input->post('notify');
					if(!$notify_comment){
						$notify_comment = 0;
					}
					 
					if($this->comments_settings == 1){
						$approve_comments = 0;
					}else{
						$approve_comments = 1;
					}
					$status = $this->blog->add_comments(arr::to_object($this->userPost),$blog_url,$notify_comment,$approve_comments);
                                        if($status == 1){
                                               if($notify_comment == "1"){
                                                $email_id = $this->input->post('email');
				                $this->email_id = $this->input->post('email');
				                $this->name = $this->input->post('sender_name');
				                $this->message = $this->input->post('comments');
				                $fromEmail = NOREPLY_EMAIL;
				                $message = new View("themes/".THEME_NAME."/admin_mail_template");
				                        if(EMAIL_TYPE==2){
				                                email::smtp($fromEmail,$email_id, SITENAME, $message);
				                        } else {
				                                email::sendgrid($fromEmail,$email_id, SITENAME, $message);
				                        }
                                                }
                                                common::message(1, $this->Lang["THANK_POSTING"]);
                                                url::redirect(PATH."blog/".$blog_url.".html");
                                        }elseif($status == 2){
                                                common::message(1, $this->Lang["YOUR_COMM_APPROVAL"]);
                                                url::redirect(PATH."blog/".$blog_url.".html");
                                        }else{
                                                common::message(-1, $this->Lang["INTERNAL_PROB"]);
                                                url::redirect(PATH."blog/".$blog_url.".html");
                                        }
				}
				else{
					$this->form_error = error::_error($post->errors());
					foreach($this->form_error as $key => $value){
						if($key == 'sender_name') {
							$this->name_error = $this->Lang['REQQ'];
						}
						if($key == 'email'){
							$this->comment_error = $this->Lang["ENTER_EMAIL"];
						}
						if($key == 'comments') {
							$this->message_error = $this->Lang['PLS_ENT_CMMT_HERE'];
						}
						else{
							$this->other_error = $this->Lang["ALL_REQU_FIELD"];
						}
					}
				}
			}
		$this->blog_details = $this->blog->get_blog_details($blog_url);
			if(count($this->blog_details) == 0){
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				url::redirect(PATH.'blog');
			}else{
				$this->template->title = $this->blog_details->current()->meta_title." | ".SITENAME;
				$this->template->description = $this->blog_details->current()->meta_description;
				$this->template->keywords = $this->blog_details->current()->meta_keywords;
			}
		$this->search = '';
		$this->comments_list = $this->blog->get_comments_list($blog_url);
		$this->blog_list = $this->blog->get_blog_list_count();
		$blogval = "";
		foreach($this->blog_list as $blog){
		        $blogval .=$blog->category_id.",";
		}
		$blogcat = substr($blogval,'0','-1');
		$this->category_list = $this->blog->get_category_list_cat($blogcat);
		//$this->category_list = $this->blog->get_category_list();
		$this->popular_list = $this->blog->get_popular_list();
		$this->template->content = new View("themes/".THEME_NAME."/blog/blog_details");
	}

	/** RSS FEEDS **/

	public function rss()
	{
		$this->category_list = $this->blog->get_category_list();
		$this->rss_blogs_list = $this->blog->get_rss_blogs_lists();
		echo new View("rss_feed");
		exit;
	}

}
