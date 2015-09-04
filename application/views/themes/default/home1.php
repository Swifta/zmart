<script src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery(1).js"  type="text/javascript"></script>
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#mycarousel11').jcarousel({
            wrap: 'circular'
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#mycarousel12').jcarousel({
            wrap: 'circular'
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#mycarousel13').jcarousel({
            wrap: 'circular'
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#mycarousel14').jcarousel({
            wrap: 'circular'
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#mycarousel15').jcarousel({
            wrap: 'circular'
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#mycarousel16').jcarousel({
            wrap: 'last',
            auto: true
        });
    });
</script>
<script type="text/javascript">
    $(function() {
$(".slidetabs").tabs(".images > div", {
	effect: 'fade',
	fadeOutSpeed: "medium",
	rotate: true
}).slideshow();
});
</script>
<div class="contianer_outer">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="home_top_outer">
                <div class="home_top_inner">
                    <div class="home_cont_left">
                         <div class="category_sidebar">                            
                                <h1 class="cate_title"><a href="<?php echo PATH; ?>shop-all-category.html" title="<?php echo $this->Lang['SHOP_AL']; ?>"><?php echo $this->Lang['SHOP_AL']; ?></a></h1>
                                <form>
                                <?php if($this->product_setting) { ?>
                                <ul class="cate_menu">
                                    <?php $cat = explode(",", substr($this->session->get('categoryID'), 0, -1));
                                    $cat1 = array_unique($cat);
                                    ?>

                                        <?php if($this->categeory_list_product){  foreach ($this->categeory_list_product as $d) {
                                        $check_sub_cat = $d->product_count;
                                         /*   COUNT OF SUBCATEGORY   */
                                        //$subcate_count = common::get_subcat_count1($d->category_id,$d->type);
                                        $subcate_count = 1;
                                        $subcat_style = ($subcate_count==0)?"background:none":"";
                                        $encode_catid = $d->category_id;
                                        if(($check_sub_cat !=-1 )&&($check_sub_cat !=0)) {
                                        ?>
                                        <li <?php if((isset($_GET['c']) && $_GET['c'] == base64_encode($d->category_id)) || (isset($_GET['m_c']) && $_GET['m_c'] == base64_encode($d->category_id) )) { ?> class="li_active" <?php } ?>>

        <?php $type = "products";

        $categories = $d->category_url; ?>
                                            <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>"  onclick="filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" class="sample_12 cate_subarr" id="sample-<?php echo $encode_catid; ?>"  title="<?php echo ucfirst($d->category_name); ?>">
						<?php echo ucfirst($d->category_name).' ('.$check_sub_cat.')'; ?>
                                            </a>                                            
                                            <ul class="cate_supmenu" id="sub_category_<?php echo $encode_catid; ?>">
                                               <div id="categeory1-<?php echo $encode_catid; ?>"></div>
                                            </ul> 
                                            
                                            <div class="sub_cate_list_show">
                            <div class="sub_cate_list_show_inner">
                                <div class="sub_cate_title_new_outer">
                                    <h2 class="sub_cate_title_new">Kids</h2>
                                </div>   
                                <div class="main_cate_lft">
                                  <div class="sub_list_shw">
                                    <h2>Cloths</h2>
                                    <ul>
                                        <li><a href="#" title="Dresses">Dresses</a></li> 
                                        <li><a href="#" title="Tops, Tees & Shirts">Tops, Tees & Shirts</a></li> 
                                        <li><a href="#" title="Tunics">Tunics</a></li> 
                                        <li><a href="#" title="Beachwear">Beachwear</a></li> 
                                        <li><a href="#" title="Sandals">Sandals</a></li> 
                                    </ul>                                    
                                </div>
                                <div class="sub_list_shw">
                                    <h2>Cloths</h2>
                                    <ul>
                                        <li><a href="#" title="Dresses">Dresses</a></li> 
                                        <li><a href="#" title="Tops, Tees & Shirts">Tops, Tees & Shirts</a></li> 
                                        <li><a href="#" title="Tunics">Tunics</a></li> 
                                        <li><a href="#" title="Beachwear">Beachwear</a></li> 
                                        <li><a href="#" title="Sandals">Sandals</a></li> 
                                    </ul>                                   
                                </div>
                                <div class="sub_list_shw">
                                    <h2>Cloths</h2>
                                    <ul>
                                        <li><a href="#" title="Dresses">Dresses</a></li> 
                                        <li><a href="#" title="Tops, Tees & Shirts">Tops, Tees & Shirts</a></li> 
                                        <li><a href="#" title="Tunics">Tunics</a></li> 
                                        <li><a href="#" title="Beachwear">Beachwear</a></li> 
                                        <li><a href="#" title="Sandals">Sandals</a></li> 
                                    </ul>                                   
                                </div>
                                <div class="sub_list_shw">
                                    <h2>Cloths</h2>
                                    <ul>
                                        <li><a href="#" title="Dresses">Dresses</a></li> 
                                        <li><a href="#" title="Tops, Tees & Shirts">Tops, Tees & Shirts</a></li> 
                                        <li><a href="#" title="Tunics">Tunics</a></li> 
                                        <li><a href="#" title="Beachwear">Beachwear</a></li> 
                                        <li><a href="#" title="Sandals">Sandals</a></li> 
                                    </ul>                                    
                                </div>  
                                </div>
                                <div class="main_cate_rgt">
                                   <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/imgs.png"/>                                    
                                </div>
                            </div>  
                        </div>
                                            
                                        </li>
                                <?php } } } ?>    
                                </ul>
                                <?php } ?>
                                <input type="hidden" name="c" />
                                <input type="hidden" name="c_t" />
                                <input type="hidden" name="m_c">
<p><input type="submit" style="display:none;"> </p>
	</form>
	                        </div> 
                        
                    </div>
                    <div class="home_cont_right">
                        <?php if (count($this->ads_details) > 0) { ?>   
                                    <?php foreach ($this->ads_details as $ads) { ?>    
            <?php if ($ads->ads_position == "th" && $ads->page_position==1) {  ?>  
                                    <div class="right_addess_for_addess wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
										<a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
                                  </div>  <?php } ?>
        <?php } ?>
    <?php } ?>
                     <div class="clearfix">
                <?php if (count($this->banner_details) > 0) {   ?>
                <?php if(count($this->banner_details) != 1) {   ?>                         
                            <div class="banner">
                                <div class="slider_home">
                                    <div class="images wloader_parent">
                                        <i class="wloader_img" style="min-height: 248px;">&nbsp;</i>   
					<?php foreach ($this->banner_details as $banner) { ?>                                        
                                    <div style="display: none;">                                                                                
                                    <a target="_blank" href="<?php echo $banner->redirect_url; ?>"  title = "<?php echo $banner->image_title; ?>">
                                        <img src="<?php echo PATH . 'images/banner_images/' . $banner->banner_id . '.png'; ?>" alt="<?php echo $banner->image_title; ?>">
                                    </a>
                                    </div>
                                 <?php } ?>      </div>                             
                                            <div class="controls">
                                                    <div class="for_back">
                                                             <a class="backward">&nbsp;</a>
                                                             <a class="forward">&nbsp;</a>
                                                    </div>
                                                            <div class="slidetabs">                                                    
								 <?php for($i=1;$i<=count($this->banner_details);$i++) { ?>                                                           
                                                            <a href="" class="current">&nbsp;</a>  <?php } ?>                                                           
                                                    </div>                                                                                                   
                                                      </div>
                                    </div>
                                                                 </div>
                        <?php }  else { ?>
                        
                        <div class="banner">
                        <div class="images  wloader_parent">
                        <i class="wloader_img" style="min-height: 248px;">&nbsp;</i>  
                                <?php foreach ($this->banner_details as $banner) { ?>
                                                                        <a  target="_blank" href="<?php echo $banner->redirect_url; ?>" title = "<?php echo $banner->image_title; ?>" ><img src="<?php echo PATH . 'images/banner_images/' . $banner->banner_id . '.png'; ?>" alt="<?php echo $banner->image_title; ?>"></a>
                                                                     <?php } ?>  
                         </div>                        						

                            </div>                        
                   <?php } }  ?>
 <?php if (count($this->ads_details) > 0) { ?>   
                                    <?php foreach ($this->ads_details as $ads) { ?>    
            <?php if ($ads->ads_position == "hr" && $ads->page_position==1) {  ?>                     
                                  <div class="banner_right_add wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
										 <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
										<?php /*<iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-138286787903644940' frameborder=0 height=250 width=300></iframe>  */ ?>
                                  </div>
                         <div class="banner_right_add2 wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
										 <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
										<?php /*<iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-138286787903644940' frameborder=0 height=250 width=300></iframe>  */ ?>
                                  </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
  </div>
                    </div>                  
                    
                </div> 
            </div>
            
            <div class="new_list_outer">
                <div class="new_list_inner">
                    <div class="new_list_lft">
                        <div class="new_list_lft_title">
                            <h2>New Arrivals</h2>
                        </div>
                        <div class="listing_part">
                            <ul id="mycarousel11" class="jcarousel-skin-tango5">
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <div class="new_prdt_listing_img1">
                                                <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                            </div>
                                            <div class="new_prdt_listing_img2">
                                               <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/hover_img.png"/></a> 
                                            </div>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="hot_values">
                                            <p>OFF</p>
                                            <p>50%</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <div class="new_prdt_listing_img1">
                                                <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                            </div>
                                            <div class="new_prdt_listing_img2">
                                               <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/hover_img.png"/></a> 
                                            </div>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="hot_values">
                                            <p>OFF</p>
                                            <p>50%</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <div class="new_prdt_listing_img1">
                                                <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                            </div>
                                            <div class="new_prdt_listing_img2">
                                               <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/hover_img.png"/></a> 
                                            </div>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="hot_values">
                                            <p>OFF</p>
                                            <p>50%</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <div class="new_prdt_listing_img1">
                                                <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                            </div>
                                            <div class="new_prdt_listing_img2">
                                               <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/hover_img.png"/></a> 
                                            </div>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="hot_values">
                                            <p>OFF</p>
                                            <p>50%</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="margin_0">
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <div class="new_prdt_listing_img1">
                                                <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                            </div>
                                            <div class="new_prdt_listing_img2">
                                               <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/hover_img.png"/></a> 
                                            </div>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="hot_values">
                                            <p>OFF</p>
                                            <p>50%</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="new_list_rgt">
                        <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/add_img.png"/></a>
                    </div>
                </div>
            </div>
            
            <div class="new_list_outer">
                <div class="new_list_inner">
                    <div class="new_list_lft">
                        <div class="new_list_lft_title">
                            <h2>Bestsellers</h2>
                        </div>
                        <div class="listing_part">
                            <ul id="mycarousel12" class="jcarousel-skin-tango5">
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <div class="new_prdt_listing_img1">
                                                <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                            </div>
                                            <div class="new_prdt_listing_img2">
                                               <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/hover_img.png"/></a> 
                                            </div>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="hot_values">
                                            <p>OFF</p>
                                            <p>50%</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="margin_0">
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="new_list_rgt">
                        <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/add_img.png"/></a>
                    </div>
                </div>
            </div>
            <div class="new_advertice_part">
                <div class="new_advertice_part_inner">
                    <div class="new_advertice_lft">
                        <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/add_new1.png"/></a>
                    </div>
                    <div class="new_advertice_rgt">
                        <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/add_new2.png"/></a>
                    </div>
                </div>
            </div>
            
            <div class="new_list_outer">
                <div class="new_list_inner">
                    <div class="new_list_lft">
                        <div class="new_list_lft_title">
                            <h2>Electronics</h2>
                        </div>
                        <div class="listing_part">
                            <ul id="mycarousel13" class="jcarousel-skin-tango5">
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="hot_values">
                                            <p>OFF</p>
                                            <p>50%</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="margin_0">
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="new_list_rgt">
                        <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/add_img.png"/></a>
                    </div>
                </div>
            </div>
            
            <div class="new_list_outer">
                <div class="new_list_inner">
                    <div class="new_list_lft">
                        <div class="new_list_lft_title">
                            <h2>Fashion</h2>
                        </div>
                        <div class="listing_part">
                            <ul id="mycarousel14" class="jcarousel-skin-tango5">
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="hot_values">
                                            <p>OFF</p>
                                            <p>50%</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="margin_0">
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="new_list_rgt">
                        <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/add_img.png"/></a>
                    </div>
                </div>
            </div>
            <div class="new_advertice_part">
                <div class="new_advertice_part_inner">
                    <div class="new_advertice_full_width">
                        <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/add_new.png"/></a>
                    </div>
                </div>
            </div>
            
            <div class="new_list_outer">
                <div class="new_list_inner">
                    <div class="new_list_lft">
                        <div class="new_list_lft_title">
                            <h2>Baby&kids</h2>
                        </div>
                        <div class="listing_part">
                            <ul id="mycarousel15" class="jcarousel-skin-tango5">
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <div class="new_prdt_listing_img1">
                                                <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                            </div>
                                            <div class="new_prdt_listing_img2">
                                               <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/hover_img.png"/></a> 
                                            </div>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="hot_values">
                                            <p>OFF</p>
                                            <p>50%</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="margin_0">
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
                                            <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/list_img.png"/></a>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="#" title="Trendy A-Line Denim Dress">Trendy A-Line Denim Dress</a></h2>
                                            <div class="new_price_details">
                                                <p>$ 308</p>
                                                <span>$ 208</span>
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a herf="#" title="Wishlist"></a></li>
                                                    <li class="new_compare"><a herf="#" title="Compare"></a></li>
                                                    <li class="new_cart"><a herf="#" title=" Cart"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="new_list_rgt">
                        <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/add_img.png"/></a>
                    </div>
                </div>
            </div>
            <div class="new_category_show">
                <ul>
                    <li>
                        <div class="new_category_list">
                    <div class="new_category_list_title">
                        <h2>Kids Shoes</h2>
                    </div>
                    <div class="new_category_list_shw">
                        <ul>                            
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li> 
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                    </li>
                    <li>
                        <div class="new_category_list">
                    <div class="new_category_list_title">
                        <h2>Red Wines</h2>
                    </div>
                    <div class="new_category_list_shw">
                        <ul>                            
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li> 
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                    </li>
                    <li>
                        <div class="new_category_list">
                    <div class="new_category_list_title">
                        <h2>Cameras</h2>
                    </div>
                    <div class="new_category_list_shw">
                        <ul>                            
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li> 
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                    </li>
                    <li class="margin_right0">
                        <div class="new_category_list">
                    <div class="new_category_list_title">
                        <h2>Tablets</h2>
                    </div>
                    <div class="new_category_list_shw">
                        <ul>                            
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li> 
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="new_cate_list_cont">
                                    <div class="new_cate_list_cont_lft">
                                       <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cate_img.png"/> 
                                    </div>
                                    <div class="new_cate_list_cont_rgt">
                                        <a href="#" title="Baby Sports">Baby Sports</a>
                                    <div class="new_cate_list_cont_rgt_stars">
                                        <img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/stars_img.png"/>
                                    </div>
                                    <p>$35.99 <span>$54.59</span></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                    </li>   
                </ul>
                
            </div>
            
            <div class="new_home_blog">
                <div class="new_home_blog_title">
                    <h2>From The Blog</h2>
                </div>
                <div class="new_home_blog_list">
                    <ul id="mycarousel16" class="jcarousel-skin-tango6">
                        <li>
                            <div class="new_home_blog_list_cont">
                                <div class="new_home_blog_list_cont_img">
                                    <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/blog_img.png"/></a>
                                </div>                            
                                <div class="new_home_blog_list_cont_details">
                                    <a href="#" title="">This is blog post for VIVAshop </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing lit. Aliquam iaculis egestas laoreet. ...</p>
                                </div>
                            </div>
                            
                            <div class="new_home_blog_list_cont">
                                <div class="new_home_blog_list_cont_img">
                                    <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/blog_img.png"/></a>
                                </div>                            
                                <div class="new_home_blog_list_cont_details">
                                    <a href="#" title="">This is blog post for VIVAshop </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing lit. Aliquam iaculis egestas laoreet. ...</p>
                                </div>
                            </div>
                            
                            <div class="new_home_blog_list_cont margin_right0">
                                <div class="new_home_blog_list_cont_img">
                                    <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/blog_img.png"/></a>
                                </div>                            
                                <div class="new_home_blog_list_cont_details">
                                    <a href="#" title="">This is blog post for VIVAshop </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing lit. Aliquam iaculis egestas laoreet. ...</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="new_home_blog_list_cont">
                                <div class="new_home_blog_list_cont_img">
                                    <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/blog_img.png"/></a>
                                </div>                            
                                <div class="new_home_blog_list_cont_details">
                                    <a href="#" title="">This is blog post for VIVAshop </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing lit. Aliquam iaculis egestas laoreet. ...</p>
                                </div>
                            </div>
                            
                            <div class="new_home_blog_list_cont">
                                <div class="new_home_blog_list_cont_img">
                                    <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/blog_img.png"/></a>
                                </div>                            
                                <div class="new_home_blog_list_cont_details">
                                    <a href="#" title="">This is blog post for VIVAshop </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing lit. Aliquam iaculis egestas laoreet. ...</p>
                                </div>
                            </div>
                            
                            <div class="new_home_blog_list_cont">
                                <div class="new_home_blog_list_cont_img">
                                    <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/blog_img.png"/></a>
                                </div>                            
                                <div class="new_home_blog_list_cont_details">
                                    <a href="#" title="">This is blog post for VIVAshop </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing lit. Aliquam iaculis egestas laoreet. ...</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="new_advertice_part">
                <div class="new_advertice_part_inner">
                    <div class="new_advertice_full_width">
                        <a href="#" title=""><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/ad4.png"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>