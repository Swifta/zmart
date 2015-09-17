<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="contianer_outer">
    <div class="contianer_inner">
        <div class="contianer">

            <div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><?php echo $this->Lang['BLOG']; ?></p></li>
                </ul>
            </div>
            <div class="blog_detalil_left_share">
                <ul>
                    <li> <a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical" data-url="<?php echo PATH . 'blog'; ?>" data-lang="en">Tweet</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> </li>
                    <li> <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo PATH . 'blog'; ?>&amp;layout=box_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:65px; width:46px;" allowTransparency="true"></iframe>  </li>
                    <li> <!-- Place this tag where you want the +1 button to render -->
                    <g:plusone size="tall" href="<?php echo PATH . 'blog'; ?>"></g:plusone>

                    <!-- Place this render call where appropriate -->
                    <script type="text/javascript">
                        (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/plusone.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                        })();
                    </script>  </li>
                    <li> <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
                        <script type="IN/Share" data-url="<?php echo PATH . 'blog'; ?>" data-counter="top"></script>  </li>
                </ul>
            </div>

            <!--content start-->
            <div class="content">
                <!--Blog content starts-->
                <div class="blog_left">
                    <div class="blog_left_inner">                        
                        <h2 class="inner_commen_title"><?php echo $this->Lang['BLOG']; ?> <span class="right_top_ae">&nbsp; </span></h2>
                        <?php
                        if (count($this->blog_list) > 0) {
                            $i = 1;
                            foreach ($this->blog_list as $blog) {

                                $imageName = PATH . "themes/" . THEME_NAME . "/images/noimage_deals_list.png";
                                if (file_exists(DOCROOT . "images/blog_images/100/" . $blog->blog_id . ".jpg")) {
                                    $imageName = PATH . "images/blog_images/100/" . $blog->blog_id . ".jpg";
                                } else {
                                        $imageName = PATH . "themes/" . THEME_NAME . "/images/noimage_products_list.png";
                                }
                                ?>
                                <div class="blog_list">
                                    <h3 class="deal_title blog_list_title">
                                        <a href="<?php echo PATH . 'blog/' . $blog->url_title . '.html' ?>" title="<?php echo $blog->blog_title; ?>" >
                                        <?php echo html_entity_decode(ucfirst($blog->blog_title)); ?></a>
                                    </h3>
                                    <div class="post_info">
                                        <ul>
                                            <li>
                                                <p><?php echo date("M jS", $blog->blog_date); ?></p>
                                            </li>
                                            <li><p>|</p></li>
                                            <li>
                                                <p><?php echo $this->Lang['POSTED_BY']; ?>  <?php echo $this->Lang['ADMIN']; ?></p>
                                            </li>
                                            <li><p>|</p></li>
                                            <li>
                                                <p><a href="<?php echo PATH . 'blog/category/' . $blog->category_url . '.html' ?>" title="<?php echo ucfirst($blog->category_name); ?>" class="post_on_new"><?php echo ucfirst($blog->category_name); ?> </a></p>
                                            </li>
                                            <li>
                                                <p><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/blog_comment.png" width="12" height="12" alt="img" /> <span><a href="<?php echo PATH . 'blog/' . $blog->url_title . '.html' ?>#comment_list" title="<?php echo $this->Lang['COMM']; ?>" class="post_on_new"><?php echo $blog->comments_count; ?> <?php echo $this->Lang['COMM']; ?></a></span>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="post_outer">
                                        <div class="post_left">
                                            <div class="post_img wloader_parent">
                                      <i class="wloader_img" >&nbsp;</i>
                                                <a>
                                                <img src="<?php echo PATH.'resize.php';?>?src=<?php echo $imageName; ?>&w=246&h=176" alt="<?php echo $this->Lang['IMAGE']; ?>" />
                                                    <?php /* <img width="246" height="176" src="<?php echo PATH; ?>images/blog_images/100/<?php echo $imageName; ?>" alt="<?php echo $this->Lang['IMG']; ?>" /> */ ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post_right">
                                            <div class="post_share">
                                                <ul>
                                                    <li class="twitter_1">
                                                        <a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical" data-url="<?php echo PATH . 'blog/' . $blog->url_title . '.html'; ?>" data-lang="en">Tweet</a>
                                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                                    </li>
                                                    <li class="quick" >
                                                        <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo PATH . 'blog/' . $blog->url_title . '.html'; ?>&amp;layout=box_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:65px; width:46px;" allowTransparency="true"></iframe>


                                                    </li>


                                                    <li>
                                                        <!-- Place this tag where you want the +1 button to render -->
                                                    <g:plusone size="tall" href="<?php echo PATH . 'blog/' . $blog->url_title . '.html'; ?>"></g:plusone>

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
                                            <div class="post_content">
                                                <p>
        <?php echo strip_tags(html_entity_decode(ucfirst(substr(($blog->blog_description), 0, 450)))) . "..."; ?></p>


                                            </div>      
                                            <div class="post_continue_button_outer">
                                                <a class="buy_it" href="<?php echo PATH . 'blog/' . $blog->url_title . '.html' ?>" title="<?php echo $this->Lang['CON_READ']; ?>">
                                                <?php echo $this->Lang['CON_READ']; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        <?php $i++;
    } ?>
                            <?php echo $this->pagination; ?>
                        <?php } else { ?><p class="no_data"><?php echo $this->Lang['NO_DATA_F']; ?></p> <?php } ?>
                    </div>
                </div>

                <div class="blog_right">
                    <?php echo new View("themes/" . THEME_NAME . "/blog/blog_categories"); ?>
                </div>
            </div>
            <!--Blog content ends-->
        </div>
    </div>
</div>
