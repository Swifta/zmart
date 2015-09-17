<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
                                                        <?php if(count($this->category_list)>0){ ?>
							 <div class="facebook_follow1">
								 
								 <div class="blog-icons-panel">
									  <h1><?php echo $this->Lang['FOLLOW']; ?></h1>
							<ul>							
							<?php if(FB_PAGE){ ?>
                        	<li><div class="blog-fb-box"><a href="<?php echo FB_PAGE; ?>" target="_blank" class="blog_social_icon blog-fb"></a></div></li>
                        	<?php } if(LINKEDIN_PAGE){ ?> 
                            <li><div class="blog-in-box"><a href="<?php echo LINKEDIN_PAGE; ?>" target="_blank" class="blog_social_icon blog-in"></a></div></li>
                            <?php } if(TWITTER_PAGE){ ?> 
                            <li><div class="blog-t-box"><a  href="<?php echo TWITTER_PAGE; ?>" target="_blank" class="blog_social_icon blog-t"></a></div></li>
                            <?php } if(YOUTUBE_URL){ ?>
                            <li><div class="blog-yt-box"><a href="<?php echo YOUTUBE_URL; ?>" target="_blank" class="blog_social_icon blog-yt"></a></div></li>
                            <?php } ?>							
							</ul>
						</div>
							  	
						<?php if($this->search == 1){ ?> 
	                    <form action="" method="get"> 
                        <div class="blog_search">
                     	<div class="search_key">
                     		<input type="text" name="search" value="" autofocus />
                     	</div>
                        	<div class="ser_sub">
                        		<input class="b_none" type="submit" value="&nbsp;" />
                        	</div>
                            </div>
                        	</form>
                    <?php } ?>
						</div>
						
                            <div class="blog_category_outer">								
                                <div class="categorynew">
                                    <h1> <?php echo $this->Lang['CATEGORIES1']; ?> </h1>
                                    <ul>
                                                
						
	                                            <?php foreach($this->category_list as $category){
                                                        ?>       
                                                        <li><a href="<?php echo PATH.'blog/category/'.$category->category_url.'.html'?>"><?php echo ucfirst($category->category_name);?></a></li>
                                        <?php  }  ?>
                                    </ul>
                                </div>
                            </div>
					
                            <div class="facebook_follow">
								<p class="faq-heading-text categories-border"><?php echo $this->Lang['POPULAR_POST']; ?></p>
								<div class="blog_posts">
						<?php if(count($this->popular_list)>0){ 
	foreach($this->popular_list as $popular){

			$imageName = "noimage.jpg"; 
			if(file_exists(DOCROOT."images/blog_images/100/".$popular->blog_id.".jpg")){
				$imageName = $popular->blog_id.".jpg";
			}            

?> 
                      <ul>
                      <li>
                      <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/posts_bg.png" width="9" height="9" alt="<?php echo $this->Lang['IMAGE']; ?>" /><label>
    <a href="<?php echo PATH.'blog/'.$popular->url_title.'.html'?>" title="<?php echo $popular->blog_title;?>"><?php if(strlen($popular->blog_title)>100) {
  		echo html_entity_decode(ucfirst(substr(($popular->blog_title),0,100)))."... ";
	} else {
		echo html_entity_decode(ucfirst($popular->blog_title));
	} ?>
	</a></label></li>
  </ul>    
 <?php  } } ?>                      
        </div>
    </div>
    <?php  }  ?>	
<div class="facebook_follow">
<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo FB_PAGE; ?>&amp;width=235&amp;height=268&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:240px; height:300px;" class="fan_box connections_grid  grid_item" allowTransparency="true"></iframe>
</div>
<?php /*
<div class="facebook_follow">								
<div id="twtr-search-widget"></div>
<script src="http://widgets.twimg.com/j/1/widget.js"></script>
<link href="http://widgets.twimg.com/j/1/widget.css" type="text/css" rel="stylesheet">
<script>
new TWTR.Widget({
search: 'uni_ecommerce',
        id: 'twtr-search-widget',
        loop: true,
        type: 'list', 
        rpp: 30, 
        interval: 300, 
        title: '<img src=<?php echo PATH;?>themes/green/images/new_uni_ecommerce_v3_logo.png>', 
        subject: '',
        width: 'auto',
        height: 300,
        theme: {
            shell: {
                background: '#333333',
                color: '#faf5fa'
            },
            tweets: {
                background: '#000000',
                color: '#ABED61',
                links: '#6195ED'
            }
        }
}).render().start();
</script>					 
    </div> */ ?>

