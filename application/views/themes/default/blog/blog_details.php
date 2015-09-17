<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript">
    function clearAll()
    {
        if((document.getElementById("sender_name").value)=='Name')
        {
            document.blog_comment.sender_name.value='';
        }
        if((document.getElementById("email").value)=='Email')
        {
            document.blog_comment.email.value='';
        }
        if((document.getElementById("comments").value)=='comments here..')
        {
            document.blog_comment.comments.value='';
        }               
        else{        
            return;
        }
    }
     $(document).ready(function(){
	$("#contactus").validate({
		 rules: {
                   sender_name: {
                       required: true
                   },
                   email: {
                       required: true
		           },
                   comments: {
                       required: true
                   }
          },
            messages: {
                   sender_name: {
                       required: "<?php echo $this->Lang['PLS_ENT_NAM']; ?>"                         
                   },
                   email: {
                       required: "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>", 
                       email : "<?php echo "valid email"; ?>"     
                   },
                   comments: {
                       required: "<?php echo $this->Lang['PLS_ENT_CMMT_HERE']; ?>"                         
                   },
           },
	 submitHandler: function(form) {
	   // some other code
	   // maybe disabling submit button
	   // then:
	   $('div#submit').hide();
	   form.submit();
	 }
	});
});
</script>
<script type="text/javascript">
    function onClick(target){
        target.value= "";
    }
</script>

<div class="contianer_outer">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="bread_crumb">
                <?php
                foreach ($this->blog_details as $blog_details) {
                    $imageName = PATH . "themes/" . THEME_NAME . "/images/noimage_deals_list.png";
                     if (file_exists(DOCROOT . "images/blog_images/100/" . $blog_details->blog_id . ".jpg")) {
                                    $imageName = PATH . "images/blog_images/100/" . $blog_details->blog_id . ".jpg";
                                } else {
                                        $imageName = PATH . "themes/" . THEME_NAME . "/images/noimage_products_list.png";
                                }
                    ?>
                    <ul>
                        <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                        <li><p><a href="<?php echo PATH; ?>blog" title="<?php echo $this->Lang['BLOG_LIST']; ?>"><?php echo $this->Lang['BLOG_LIST']; ?></a></p></li>
                        <li><p><?php echo html_entity_decode(ucfirst($blog_details->blog_title)); ?></p></li>
                    </ul>
                </div>
                <div class="blog_detalil_left_share">
                    <ul>
                        <li > <a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical" data-url="<?php echo PATH . 'blog'; ?>" data-lang="en"><?php echo $this->Lang['TWEET'];?></a> 
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> </li>
                        <li ><iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo PATH . 'blog'; ?>&amp;layout=box_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:65px; width:46px;" allowTransparency="true"></iframe>   </li>
                        <li> 
                        <g:plusone size="tall" href="<?php echo PATH . 'blog'; ?>"></g:plusone>
                        <!-- Place this render call where appropriate -->
                        <script type="text/javascript">
                            (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/plusone.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                            })();
                        </script>
                        </li>
                        <li> <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
                            <script type="IN/Share" data-url="<?php echo PATH . 'blog'; ?>" data-counter="top"></script>   </li>
                    </ul>             
                </div>
                <!--content start-->
                <div class="content">
                    <!--Blog content starts-->
                    <div class="blog_left">
                        <div class="blog_left_inner">                                                          
                            <h2 class="inner_commen_title"><?php echo $this->Lang['BLOG_DET']; ?></h2>
                            <div class="blog_list">
                                <h3 class="deal_title blog_list_title"><?php echo html_entity_decode(ucfirst($blog_details->blog_title)); ?></h3>
                                <div class="post_info">
                                    <ul>
                                        <li>
                                            <p><?php echo date("M jS", $blog_details->blog_date); ?></p>
                                        </li>
                                        <li><p>|</p></li>
                                        <li>
                                            <p><?php echo $this->Lang['POSTED_BY']; ?>  <?php echo $this->Lang['ADMIN']; ?></p></li><li><p>|</p></li><li><p><a href="<?php echo PATH . 'blog/category/' . $blog_details->category_url . '.html' ?>" title="<?php echo ucfirst($blog_details->category_name); ?>" class="post_on_new"><?php echo ucfirst($blog_details->category_name); ?> </a></p>
                                        </li>
                                        <li><p>|</p></li>
                                                <?php if ($this->allow_posting == 1) { /** allow comment posting start * */ ?>
                                            <li>
                                                <p><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/blog_comment.png" width="12" height="12" alt="<?php echo $this->Lang['IMAGE'];?>"/> 
                                            <?php echo $blog_details->comments_count; ?>  <?php echo $this->Lang['COMM']; ?></p>
                                            </li>
    <?php } /** allow comment posting end * */ ?>
                                        <li class="twitter_1"> <a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical" data-url="<?php echo PATH . 'blog/' . $blog_details->url_title . '.html' ?>"><?php echo $this->Lang['TWEET'];?></a>
                                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                        </li>
                                        <li class="quick" >
                                            <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo PATH . 'blog/' . $blog_details->url_title . '.html' ?>&amp;layout=box_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:65px; width:46px;" allowTransparency="true"></iframe>
                                        </li>
                                        <li>
                                            <!-- Place this tag where you want the +1 button to render -->
                                        <g:plusone size="tall" href="<?php echo PATH . 'blog/' . $blog_details->url_title . '.html' ?>"></g:plusone>
                                        <!-- Place this render call where appropriate -->
                                        <script type="text/javascript">
                                            (function() {
                                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                                po.src = 'https://apis.google.com/js/plusone.js';
                                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                            })();
                                        </script>
                                        </li>	
                                    </ul>
                                </div>
                                <div class="post_outer">									
                                    <div class="post_right2">	
                                        <div class="post_content2">
                                            <div class="post_img wloader_parent">
                                      <i class="wloader_img" >&nbsp;</i>
                                                <img src="<?php echo PATH.'resize.php';?>?src=<?php echo $imageName; ?>&w=246&h=176"/>
                                            </div>
                                            <p><?php echo strip_tags(html_entity_decode(ucfirst($blog_details->blog_description))); ?></p>
                                        </div>											
                                    </div>
                                </div>
                            </div>
                            <div class="blog_comment_area">
                                <?php if ($this->allow_posting == 1) { ?>
                                    <?php echo count($this->comments_list); ?> <?php echo $this->Lang['USR_CMT']; ?></h1>
                                    <?php
                                    if (count($this->comments_list) > 0) {
                                        foreach ($this->comments_list as $blog_comments) {
                                            ?>
                                            <h4></h4>
                                            <div class="blog_comment1">
                                                <div class="blog_comment_post_info">
                                                    <ul>
                                                        <li><p><?php echo date("F j, Y g:i a", $blog_comments->comments_date); ?> </p></li>
                <!--li><p>|</p></li>
                <li><p><a href="#" title="Reply">Reply</a></p></li-->
                                                    </ul>
                                                </div>
                                                <div class="blog_user_comment">
                                                    <div class="blog_user_image">
                                                        <img src="http://www.gravatar.com/avatar/<?php echo md5($blog_comments->name . $blog_comments->name) ?>?d=wavatar&s=50" width="75" height="60" alt="<?php echo $this->Lang['IMAGE']; ?>" />
                                                    </div>
                                                    <div class="blog_user_comment_text">
                                                        <b></b><?php echo $blog_comments->name; ?></b>
                                                        <p><?php echo $blog_comments->comments; ?></p>
                                                    </div>
                                                </div>
                                            </div>
            <?php }
        }
    }
} ?>
<?php if ($blog_details->allow_comments == 1) { ?>
                                <div class="blog_reply_area">
                                    <h5><?php echo $this->Lang['LEAVE_REPLY']; ?></h5>
                                    <div class="blog_reply_form">
                                        <form  action="" id="contactus" method="post" name="blog_comment" onsubmit="clearAll()">
                                            <div class="clearfix">
                                                <div class="blog_form_left">
                                                    <div class="blog_txtbox">
                                                        <input type="text" class="required"  name="sender_name" id="sender_name" value="<?php echo $this->Lang['NAME']; ?>" onBlur="if(this.value == '') { this.value='Name';}" onFocus="if (this.value == 'Name') {this.value='';}" autofocus />

                                                    </div>
                                                    <div class="blog_txtbox">
                                                        <input name="email"  class="required email"  type="text"  id="email" value="<?php echo $this->Lang['EMAIL_F']; ?>" onblur="if (this.value == '') {this.value = 'E-mail';}"onfocus="if(this.value == 'E-mail') {this.value = '';}"   />

                                                    </div>
                                                    <div class="blog_txtbox">
                                                        <input name="website" type="text"  value="<?php echo $this->Lang['WEBSITE']; ?>" onblur="if (this.value == '') {this.value = 'Website';}"onfocus="if(this.value == 'Website') {this.value = '';}" />
                                                        <label><?php echo $this->Lang['OPTIONAL']; ?></label>
                                                    </div>                                                   
                                                </div>
                                                <div class="blog_form_right">
                                                    <div class="blog_form_textarea">											
                                                        <textarea name="comments" class="required"  cols="" rows="" id="comments" placeholder="<?php echo $this->Lang['COMM_HERE']; ?>.."  ></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="blog_form_left">                                                    
                                                    <div class="buy_it complete_order_button">                                                                                                               
                                                        <input type="submit" value="<?php echo $this->Lang['SUB_COMM']; ?>" title="<?php echo $this->Lang['SUB_COMM']; ?>"/>                                                                                                                   
                                                    </div>
                                                    <input type="hidden" name="notify" value="1"/> 
                                                    <?php /*<div class="blog_form_checkbox">
                                                        <input type="checkbox" name="notify" value="1"/> 
                                                        <span><?php echo $this->Lang['NOTIFY_EMAIL']; ?></span>
                                                    </div> */ ?>
                                                </div>
                                        </form>  
                                        </div>
                                        </div>
                    <?php } /** allow comment posting end * */ ?>                                                   
                                </div>
                            </div>
                        </div>
                         <div class="blog_right">
<?php echo new View("themes/" . THEME_NAME . "/blog/blog_categories"); ?>
                </div>
                    </div>
                    
                </div>
               
            </div>
            <!--Blog content ends-->
        </div>
    </div>
</div>

