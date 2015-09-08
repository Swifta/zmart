<script src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery(1).js"  type="text/javascript"></script>
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#mycarousel16').jcarousel({
            auto: 1,
            wrap: 'last',
            animation: 5000
        });
    });
</script>
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
        jQuery('#mycarousel17').jcarousel({
            wrap: 'circular'
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#mycarousel18').jcarousel({
            wrap: 'circular'
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

                                        <?php if(count($this->categeory_list_product)>0){  foreach ($this->categeory_list_product as $d) {
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
														<h2 class="sub_cate_title_new"><?php echo ucfirst($d->category_name); ?></h2>
													</div>
													<div class="main_cate_lft">
													<?php if(count($this->subcategories_list)>0){
														foreach($this->subcategories_list as $sub_cate){
															if($sub_cate->main_category_id == $d->category_id){?>
													  <div class="sub_list_shw">
														<h2><a href="javascript:filtercategory('<?php echo $sub_cate->category_url; ?>', 'products', '<?php echo base64_encode("sub"); ?>');"><?php echo ucfirst($sub_cate->category_name);?></a></h2>
														<ul>
															<?php if(count($this->secondcategories_list)>0){
																$hdn_second_cnt = 1;
															foreach($this->secondcategories_list as $second_cate){
																if($second_cate->main_category_id==$d->category_id && $second_cate->sub_category_id==$sub_cate->category_id){
																	if($hdn_second_cnt<5){?>
															<li><a href="javascript:filtercategory('<?php echo $second_cate->category_url; ?>', 'products', '<?php echo base64_encode("sec"); ?>');" title="<?php echo ucfirst($second_cate->category_name);?>"><?php echo ucfirst($second_cate->category_name);?></a></li> 
															<?php $hdn_second_cnt++;
															}
															if($hdn_second_cnt==5){ ?>
															<li class="cate_view_more"><a href="javascript:filtercategory('<?php echo $sub_cate->category_url; ?>', 'products', '<?php echo base64_encode("sub"); ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo $this->Lang['VIW_MRE'];?></a></li> 
															<?php break;}
															}
															}
															}?>
														</ul>                                    
													</div>
													<?php }}}?>
													</div>
													<div class="main_cate_rgt">
														<?php if(file_exists(DOCROOT.'images/category/icon/'.$d->category_url.'_home.png')){ ?>
													   <img alt="" src="<?php echo PATH.'images/category/icon/'.$d->category_url.'_home.png'; ?>"/><?php }?>
													</div>
												</div>  
											</div>
                                        </li>
                                <?php } } } else{?><div style="text-align: center;height: 351px;color: white;font: 26px/362px bold arial;border: 1px solid #d8d8d8;"><?php echo "No categories found";?></div><?php }?>    
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
						<div class="res_category">
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
                                        </li>
                                <?php } } } ?>    
                                </ul>
                                <?php } ?>
						</div>
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
                                    <!--<a target="_blank" href="<?php echo $banner->redirect_url; ?>"  title = "<?php echo $banner->image_title; ?>">
                                        <img src="<?php echo PATH . 'images/banner_images/' . $banner->banner_id . '.png'; ?>" alt="<?php echo $banner->image_title; ?>">
                                    </a>-->
                                    
                                     <?php
								   /*  
								    *	
								   	*	Modification to add club membership signup banner conditions
									*	@Live
								   	*/
									 if(strcmp($banner->banner_id, '28') == 0){?>
										  <a target="_self" id="id_banner_club"  href="javascript:load_club();"<?php //echo $banner->redirect_url;?>
										 <?php }else{?>
                                         <a target="_blank" href="<?php echo $banner->redirect_url;	 
										 }?>"  title = "<?php echo $banner->image_title; ?>">
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
            <?php if ($ads->ads_position == "hr1" && $ads->page_position==1) {  ?>                     
                                  <div class="banner_right_add wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
										 <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
										<?php /*<iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-138286787903644940' frameborder=0 height=250 width=300></iframe>  */ ?>
                                  </div>
              <?php } }?>
              <?php foreach ($this->ads_details as $ads) {
				  if($ads->ads_position == "hr2" && $ads->page_position==1) {  ?>   
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
            <?php  if(count($this->new_arrivals_list)){?>
            <div class="new_list_outer">
                <div class="new_list_inner">
                    <div class="new_list_lft">
                        <div class="new_list_lft_title">
                            <h2><?php echo $this->Lang['NEW_ARRIVALS'];?></h2>
                        </div>
                        <div class="listing_part">
                            <ul id="mycarousel11" class="jcarousel-skin-tango5">
								<?php if(count($this->new_arrivals_list)){
									$symbol = CURRENCY_SYMBOL; 
									foreach($this->new_arrivals_list as $new_arrival){
										$image=array();
										for($i=1;$i<=5;$i++)
											if(file_exists(DOCROOT . 'images/products/1000_800/' . $new_arrival->deal_key . '_'.$i. '.png'))
												$image[] = $i;?>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
											<?php if(count($image)>0){?>
                                            <div class="new_prdt_listing_img1">
												<a href="<?php echo PATH .$new_arrival->store_url_title. '/product/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $new_arrival->deal_title; ?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$new_arrival->deal_key.'_'.$image[0].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
                                            </div>
                                            <?php if(isset($image[1]) && $image[1]!=''){?>
                                            <div class="new_prdt_listing_img2">
                                               <a href="<?php echo PATH .$new_arrival->store_url_title. '/product/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $new_arrival->deal_title; ?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$new_arrival->deal_key.'_'.$image[1].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
                                            </div>
                                            <?php }}else{?>
                                             <div class="new_prdt_listing_img1">
												<a href="<?php echo PATH .$new_arrival->store_url_title. '/product/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $new_arrival->deal_title; ?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
                                            </div>
                                            <div class="new_prdt_listing_img2">
												<a href="<?php echo PATH .$new_arrival->store_url_title. '/product/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $new_arrival->deal_title; ?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
                                            </div>
                                            
                                            <?php }?>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="<?php echo PATH .$new_arrival->store_url_title. '/product/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $new_arrival->deal_title; ?>"><?php echo substr(ucfirst($new_arrival->deal_title), 0, 100); ?></a></h2>
                                            <div class="new_price_details">
											 <?php if($new_arrival->deal_price!=0) { ?>	
												<p><?php echo $symbol . "" . $new_arrival->deal_price; ?> </p>
												<span><?php echo $symbol . "" . $new_arrival->deal_value; ?></span>
											   <?php } else  { ?>
												<span><?php echo $symbol."".$new_arrival->deal_value; ?> </span>
												<?php } ?> 
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
												<?php $avg_rating = $new_arrival->avg_rating;
												 if($avg_rating!=''){
													 $avg_rating = round($avg_rating); ?>
													<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
												<?php }else{?>
													<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
												<?php }?>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a onclick="addToWishList('<?php echo $new_arrival->deal_id; ?>','<?php echo addslashes($new_arrival->deal_title); ?>');" title="<?php echo $this->Lang['ADD_WISH_LIST'];?>"></a></li>
                                                    <li class="new_compare"> <a onclick="addToCompare('<?php echo $new_arrival->deal_id; ?>','','detail');" title="<?php echo $this->Lang['ADD_COMPARE']; ?>"></a></li>
                                                    <li class="new_cart"><a href="<?php echo PATH .$new_arrival->store_url_title. '/product/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART'];?>"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php if($new_arrival->deal_percentage>0 && $new_arrival->deal_percentage!=''){?>
                                        <div class="hot_values">
                                            <p><?php echo $this->Lang['OFF'];?></p>
                                            <p><?php echo round($new_arrival->deal_percentage);?>%</p>
                                        </div>
                                        <?php }?>
                                    </div>
                                </li>
                                <?php }}?>
                            </ul>
                        </div>
                    </div>
                    <?php if (count($this->ads_details) > 0 && count($this->new_arrivals_list)>0) {
						foreach ($this->ads_details as $ads) {
							if ($ads->ads_position == "hs1" && $ads->page_position==1) {  ?>
							<div class="new_list_rgt">
								<a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
							</div>
                    <?php }}}?>
                </div>
            </div>
            <?php }?>
            <?php if(count($this->best_seller_list)){ ?>
            <div class="new_list_outer">
                <div class="new_list_inner">
                    <div class="new_list_lft">
                        <div class="new_list_lft_title">
                            <h2><?php echo $this->Lang['BESTSELLERS'];?></h2>
                        </div>
                        <div class="listing_part">
                            <ul id="mycarousel12" class="jcarousel-skin-tango5">
							<?php if(count($this->best_seller_list)){
								$symbol = CURRENCY_SYMBOL; 
								foreach($this->best_seller_list as $best_sel){
									$image=array();
									for($i=1;$i<=5;$i++)
										if(file_exists(DOCROOT . 'images/products/1000_800/' . $best_sel->deal_key . '_'.$i. '.png'))
											$image[] = $i;?>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
											<?php if(count($image)>0){?>
                                            <div class="new_prdt_listing_img1">
												<a href="<?php echo PATH .$best_sel->store_url_title. '/product/' . $best_sel->deal_key . '/' . $best_sel->url_title . '.html'; ?>" title="<?php echo $best_sel->deal_title; ?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$best_sel->deal_key.'_'.$image[0].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
                                            </div>
                                            <?php if(isset($image[1]) && $image[1]!=''){?>
                                            <div class="new_prdt_listing_img2">
                                               <a href="<?php echo PATH .$best_sel->store_url_title. '/product/' . $best_sel->deal_key . '/' . $best_sel->url_title . '.html'; ?>" title="<?php echo $best_sel->deal_title; ?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$best_sel->deal_key.'_'.$image[1].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
                                            </div>
                                            <?php }}else{?>
                                             <div class="new_prdt_listing_img1">
												<a href="<?php echo PATH .$best_sel->store_url_title. '/product/' . $best_sel->deal_key . '/' . $best_sel->url_title . '.html'; ?>" title="<?php echo $best_sel->deal_title; ?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
                                            </div>
                                            <div class="new_prdt_listing_img2">
												<a href="<?php echo PATH .$best_sel->store_url_title. '/product/' . $best_sel->deal_key . '/' . $best_sel->url_title . '.html'; ?>" title="<?php echo $best_sel->deal_title; ?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                           <h2><a href="<?php echo PATH .$best_sel->store_url_title. '/product/' . $best_sel->deal_key . '/' . $best_sel->url_title . '.html'; ?>" title="<?php echo $best_sel->deal_title; ?>"><?php echo substr(ucfirst($best_sel->deal_title), 0, 100); ?></a></h2>
                                            <div class="new_price_details">
												 <?php if($best_sel->deal_price!=0) { ?>	
												<p><?php echo $symbol . "" . $best_sel->deal_price; ?> </p>
												<span><?php echo $symbol . "" . $best_sel->deal_value; ?></span>
											   <?php } else  { ?>
												<span><?php echo $symbol."".$best_sel->deal_value; ?> </span>
												<?php } ?> 
											
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                               <?php $avg_rating = $best_sel->avg_rating;
												 if($avg_rating!=''){
													 $avg_rating = round($avg_rating); ?>
													<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
												<?php }else{?>
													<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
												<?php }?>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a onclick="addToWishList('<?php echo $best_sel->deal_id; ?>','<?php echo addslashes($best_sel->deal_title); ?>');" title="<?php echo $this->Lang['ADD_WISH_LIST'];?>"></a></li>
                                                    <li class="new_compare"> <a onclick="addToCompare('<?php echo $best_sel->deal_id; ?>','','detail');" title="<?php echo $this->Lang['ADD_COMPARE']; ?>"></a></li>
                                                    <li class="new_cart"><a href="<?php echo PATH .$best_sel->store_url_title. '/product/' . $best_sel->deal_key . '/' . $best_sel->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART'];?>"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php if($best_sel->deal_percentage>0 && $best_sel->deal_percentage!=''){?>
                                        <div class="hot_values">
                                            <p><?php echo $this->Lang['OFF'];?></p>
                                            <p><?php echo round($best_sel->deal_percentage);?>%</p>
                                        </div>
                                        <?php }?>
                                    </div>
                                </li>
                                <?php }}?>
                            </ul>
                        </div>
                    </div>
                    <?php if (count($this->ads_details) > 0 && count($this->best_seller_list)>0) {
						foreach ($this->ads_details as $ads) {
							if ($ads->ads_position == "hs2" && $ads->page_position==1) {  ?>
							<div class="new_list_rgt">
								<a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
							</div>
                    <?php }}}?>
                </div>
            </div>
           
            <?php }?>
            
            <?php  if(count($this->view_hot_deals_list)){?>
            <div class="new_list_outer">
                <div class="new_list_inner">
                    <div class="new_list_lft">
                        <div class="new_list_lft_title">
                            <h2><?php echo $this->Lang['DEALS'];?></h2>
                        </div>
                        <div class="listing_part">
                            <ul id="mycarousel17" class="jcarousel-skin-tango5">
								<?php if(count($this->view_hot_deals_list)){
									$symbol = CURRENCY_SYMBOL; 
									foreach($this->view_hot_deals_list as $new_arrival){
										$image=array();
										for($i=1;$i<=5;$i++)
											if(file_exists(DOCROOT . 'images/deals/1000_800/' . $new_arrival->deal_key . '_'.$i. '.png'))
												$image[] = $i;?>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
											<?php if(count($image)>0){?>
                                            <div class="new_prdt_listing_img1">
												<a href="<?php echo PATH . $new_arrival->store_url_title.'/deals/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $new_arrival->deal_title; ?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$new_arrival->deal_key.'_'.$image[0].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
                                            </div>
                                            <?php if(isset($image[1]) && $image[1]!=''){?>
                                            <div class="new_prdt_listing_img2">
                                               <a href="<?php echo PATH . $new_arrival->store_url_title.'/deals/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $new_arrival->deal_title; ?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$new_arrival->deal_key.'_'.$image[1].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
                                            </div>
                                            <?php }}else{?>
                                             <div class="new_prdt_listing_img1">
												<a href="<?php echo PATH . $new_arrival->store_url_title.'/deals/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $new_arrival->deal_title; ?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
                                            </div>
                                            <div class="new_prdt_listing_img2">
												<a href="<?php echo PATH . $new_arrival->store_url_title.'/deals/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $new_arrival->deal_title; ?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
                                            </div>
                                            
                                            <?php }?>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="<?php echo PATH . $new_arrival->store_url_title.'/deals/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $new_arrival->deal_title; ?>"><?php echo substr(ucfirst($new_arrival->deal_title), 0, 100); ?></a></h2>
                                            <div class="new_price_details">
                                                <p><?php echo $symbol . " " . $new_arrival->deal_price; ?></p>
                                                <span><?php echo $symbol . " " . $new_arrival->deal_value; ?></span>
                                            </div>
                                        </div>
                                        <div class="list_bottom">
                                    <div class="bottom_stars">
                                   <?php $avg_rating = $new_arrival->avg_rating;
										if($avg_rating!=''){
											$avg_rating = round($avg_rating); ?>
											<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
										<?php }else{?>
											<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
										<?php }?>
                                    </div>
                                    <div class="new_list_bottom_icons">
                                        <ul>
                                            <li class="new_cart"><a href="<?php echo PATH . $new_arrival->store_url_title.'/deals/' . $new_arrival->deal_key . '/' . $new_arrival->url_title . '.html'; ?>" title="<?php echo $new_arrival->deal_title; ?>"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                        <?php if($new_arrival->deal_percentage>0 && $new_arrival->deal_percentage!=''){?>
                                        <div class="hot_values">
                                            <p><?php echo $this->Lang['OFF'];?></p>
                                            <p><?php echo round($new_arrival->deal_percentage);?>%</p>
                                        </div>
                                        <?php }?>
                                    </div>
                                </li>
                                <?php }}?>
                            </ul>
                        </div>
                    </div>
                    <?php if (count($this->ads_details) > 0 && count($this->new_arrivals_list)>0) {
						foreach ($this->ads_details as $ads) {
							if ($ads->ads_position == "hs6" && $ads->page_position==1) {  ?>
							<div class="new_list_rgt">
								<a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
							</div>
                    <?php }}}?>
                </div>
            </div>
             
            <?php }?>
            
            <?php  if(count($this->view_hot_deals_list1)){?>
            <div class="new_list_outer">
                <div class="new_list_inner">
                    <div class="new_list_lft">
                        <div class="new_list_lft_title">
                            <h2><?php echo $this->Lang['AUCTION'];?></h2>
                        </div>
                        <div class="listing_part">
                            <ul id="mycarousel18" class="jcarousel-skin-tango5">
								<?php if(count($this->view_hot_deals_list1)){
									$symbol = CURRENCY_SYMBOL; 
									foreach($this->view_hot_deals_list1 as $new_arrival){
										$image=array();
										for($i=1;$i<=5;$i++)
											if(file_exists(DOCROOT . 'images/auction/1000_800/' . $new_arrival->deal_key . '_'.$i. '.png'))
												$image[] = $i;?>
                                <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
											<?php if(count($image)>0){?>
                                            <div class="new_prdt_listing_img1">
												<a href="<?php echo PATH.$new_arrival->store_url_title.'/auction/'.$new_arrival->deal_key.'/'.$new_arrival->url_title.'.html';?>" title="<?php echo $new_arrival->deal_title;?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/auction/1000_800/'.$new_arrival->deal_key.'_'.$image[0].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
                                            </div>
                                            <?php if(isset($image[1]) && $image[1]!=''){?>
                                            <div class="new_prdt_listing_img2">
                                               <a href="<?php echo PATH.$new_arrival->store_url_title.'/auction/'.$new_arrival->deal_key.'/'.$new_arrival->url_title.'.html';?>" title="<?php echo $new_arrival->deal_title;?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/auction/1000_800/'.$new_arrival->deal_key.'_'.$image[1].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
                                            </div>
                                            <?php }}else{?>
                                             <div class="new_prdt_listing_img1">
												<a href="<?php echo PATH.$new_arrival->store_url_title.'/auction/'.$new_arrival->deal_key.'/'.$new_arrival->url_title.'.html';?>" title="<?php echo $new_arrival->deal_title;?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
                                            </div>
                                            <div class="new_prdt_listing_img2">
												<a href="<?php echo PATH.$new_arrival->store_url_title.'/auction/'.$new_arrival->deal_key.'/'.$new_arrival->url_title.'.html';?>" title="<?php echo $new_arrival->deal_title;?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
                                            </div>
                                            
                                            <?php }?>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                            <h2><a href="<?php echo PATH.$new_arrival->store_url_title.'/auction/'.$new_arrival->deal_key.'/'.$new_arrival->url_title.'.html';?>" title="<?php echo $new_arrival->deal_title;?>"><?php echo substr(ucfirst($new_arrival->deal_title), 0, 100); ?></a></h2>
                                            <div class="new_price_details">
                                                <p><?php echo $symbol . " " . $new_arrival->deal_price; ?></p>
                                                <span><?php echo $symbol . " " . $new_arrival->deal_value; ?></span>
                                            </div>
                                        </div>
                                        <div class="list_bottom">
                                    <div class="bottom_stars">
                                   <?php $avg_rating = $new_arrival->avg_rating;
										if($avg_rating!=''){
											$avg_rating = round($avg_rating); ?>
											<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
										<?php }else{?>
											<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
										<?php }?>
                                    </div>
                                    <div class="new_list_bottom_icons">
                                        <ul>
                                            <li class="new_bid"><a href="<?php echo PATH.$new_arrival->store_url_title.'/auction/'.$new_arrival->deal_key.'/'.$new_arrival->url_title.'.html';?>" title="<?php echo $new_arrival->deal_title;?>"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                        
                                    </div>
                                </li>
                                <?php }}?>
                            </ul>
                        </div>
                    </div>
                    <?php if (count($this->ads_details) > 0 && count($this->new_arrivals_list)>0) {
						foreach ($this->ads_details as $ads) {
							if ($ads->ads_position == "hs7" && $ads->page_position==1) {  ?>
							<div class="new_list_rgt">
								<a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
							</div>
                    <?php }}}?>
                </div>
            </div>
             <div class="new_advertice_part">
                <div class="new_advertice_part_inner">
					<?php if (count($this->ads_details) > 0) {
						foreach ($this->ads_details as $ads) {
							if ($ads->ads_position == "hc1" && $ads->page_position==1) {  ?>
							<div class="new_advertice_lft">
								<a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
							</div>
                    <?php }}}?>
                    <?php if (count($this->ads_details) > 0) {
						foreach ($this->ads_details as $ads) {
							if ($ads->ads_position == "hc2" && $ads->page_position==1) {  ?>
							<div class="new_advertice_lft">
								<a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
							</div>
                    <?php }}}?>
                </div>
            </div>
            <?php }?>
            
            <?php for($main_cat_cnt=0;$main_cat_cnt<3;$main_cat_cnt++){
				if(isset($this->cat_product_list[$main_cat_cnt]) && isset($this->category_name_list[$main_cat_cnt])){ ?>
            <div class="new_list_outer">
                <div class="new_list_inner">
                    <div class="new_list_lft">
						<?php if(isset($this->category_name_list[$main_cat_cnt]) && $this->category_name_list[$main_cat_cnt]!=''){?>
                        <div class="new_list_lft_title">
                            <h2><?php echo ucfirst($this->category_name_list[$main_cat_cnt]);?></h2>
                        </div>
                        <?php }?>
                        <?php if($main_cat_cnt==0){
								$mycarouse_id = "mycarousel13";
								$ads_position = "hs3";
							}else if($main_cat_cnt==1){
								$mycarouse_id = "mycarousel14";
								$ads_position = "hs4";
							}else if($main_cat_cnt==2){
								$mycarouse_id = "mycarousel15";
								$ads_position = "hs5";
							}?>
                        <div class="listing_part">
							<?php $this->cat_product_list1 = $this->cat_product_list[$main_cat_cnt];
							if(count($this->cat_product_list1)>0){?>
                            <ul id="<?php echo $mycarouse_id;?>" class="jcarousel-skin-tango5">
								<?php 
								if(count($this->cat_product_list1)>0){
									foreach($this->cat_product_list1 as $pro){
									$image=array();
									for($i=1;$i<=5;$i++)
										if(file_exists(DOCROOT . 'images/products/1000_800/' . $pro->deal_key . '_'.$i. '.png'))
											$image[] = $i;?>
                                 <li>
                                    <div class="new_prdt_listing">
                                        <div class="new_prdt_listing_img">
											<?php if(count($image)>0){?>
                                            <div class="new_prdt_listing_img1">
												<a href="<?php echo PATH .$pro->store_url_title. '/product/' . $pro->deal_key . '/' . $pro->url_title . '.html'; ?>" title="<?php echo $pro->deal_title; ?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$pro->deal_key.'_'.$image[0].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
                                            </div>
                                            <?php if(isset($image[1]) && $image[1]!=''){?>
                                            <div class="new_prdt_listing_img2">
                                               <a href="<?php echo PATH .$pro->store_url_title. '/product/' . $pro->deal_key . '/' . $pro->url_title . '.html'; ?>" title="<?php echo $pro->deal_title; ?>"><img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$pro->deal_key.'_'.$image[1].'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"/></a> 
                                            </div>
                                            <?php }}else{?>
                                             <div class="new_prdt_listing_img1">
												<a href="<?php echo PATH .$pro->store_url_title. '/product/' . $pro->deal_key . '/' . $pro->url_title . '.html'; ?>" title="<?php echo $pro->deal_title; ?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
                                            </div>
                                            <div class="new_prdt_listing_img2">
												<a href="<?php echo PATH .$pro->store_url_title. '/product/' . $pro->deal_key . '/' . $pro->url_title . '.html'; ?>" title="<?php echo $pro->deal_title; ?>"><img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png"/></a> 
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="new_prdt_listing_details">
                                           <h2><a href="<?php echo PATH .$pro->store_url_title. '/product/' . $pro->deal_key . '/' . $pro->url_title . '.html'; ?>" title="<?php echo $pro->deal_title; ?>"><?php echo substr(ucfirst($pro->deal_title), 0, 100); ?></a></h2>
                                            <div class="new_price_details">
												 <?php if($pro->deal_price!=0) { ?>	
												<p><?php echo $symbol . "" . $pro->deal_price; ?> </p>
												<span><?php echo $symbol . "" . $pro->deal_value; ?></span>
											   <?php } else  { ?>
												<span><?php echo $symbol."".$pro->deal_value; ?> </span>
												<?php } ?> 
                                            </div>
                                        </div>
                                        <div class="new_list_bottom">
                                            <div class="new_list_bottom_stars">
                                                 <?php $avg_rating = $pro->avg_rating;
												if($avg_rating!=''){
													$avg_rating = round($avg_rating); ?>
													<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
												<?php }else{?>
													<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
												<?php }?>
                                            </div>
                                            <div class="new_list_bottom_icons">
                                                <ul>
                                                    <li class="new_wishlist"><a onclick="addToWishList('<?php echo $pro->deal_id; ?>','<?php echo addslashes($pro->deal_title); ?>');" title="<?php echo $this->Lang['ADD_WISH_LIST'];?>"></a></li>
                                                    <li class="new_compare"> <a onclick="addToCompare('<?php echo $pro->deal_id; ?>','','detail');" title="<?php echo $this->Lang['ADD_COMPARE']; ?>"></a></li>
                                                    <li class="new_cart"><a href="<?php echo PATH .$pro->store_url_title. '/product/' . $pro->deal_key . '/' . $pro->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART'];?>"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php if($pro->deal_percentage>0 && $pro->deal_percentage!=''){?>
                                        <div class="hot_values">
                                            <p><?php echo $this->Lang['OFF'];?></p>
                                            <p><?php echo round($pro->deal_percentage);?>%</p>
                                        </div>
                                        <?php }?>
                                    </div>
                                </li>
                                <?php } }?>
                            </ul>
                            <?php }else{?>
								<div class="listing_no_product"><label><?php echo $this->Lang['NO_PRODUCTS'];?></label></div>
                            <?php }?>
                        </div>
                    </div>
                     <?php if (count($this->ads_details) > 0) {
						foreach ($this->ads_details as $ads) {
							if ($ads->ads_position == $ads_position && $ads->page_position==1) {  ?>
							<div class="new_list_rgt">
								<a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
							</div>
                    <?php }}}?>
                </div>
            </div>
            <?php }
            }?>
            
            <div class="new_advertice_part">
                <div class="new_advertice_part_inner">
					<?php if (count($this->ads_details) > 0 ) {
						foreach ($this->ads_details as $ads) {
							if ($ads->ads_position == "hb1" && $ads->page_position==1) {  ?>
							<div class="new_advertice_full_width">
								<a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
							</div>
                    <?php }}}?>
                </div>
            </div>
            
            <div class="new_category_show">
                <ul>
					<?php if(isset($this->cat_product_list) && count($this->cat_product_list)>0){
						$cat_cnt =3;
						for($k=0;$k<4;$k++){?>
                    <li <?php if($k==3){?> class='margin_right0' <?php }?>>
                        <div class="new_category_list">
							<?php if(isset($this->category_name_list[$cat_cnt]) && $this->category_name_list[$cat_cnt]!=''){?>
							<div class="new_category_list_title">
								<h2><?php echo ucfirst($this->category_name_list[$cat_cnt]);?></h2>
							</div>
							<?php }?>
							<div class="new_category_list_shw">
								<?php $cat_product = $this->cat_product_list[$cat_cnt];
								if(count($cat_product)>0){?>
								<ul>
									<?php foreach($cat_product as $cat_pro){
										$hdn_image=0;
										for($i=1;$i<=5;$i++)
											if(file_exists(DOCROOT . 'images/products/1000_800/' . $cat_pro->deal_key . '_'.$i. '.png')){
												$hdn_image = $i;
												break;
											}?>
									<li>
										<div class="new_cate_list_cont">
											<div class="new_cate_list_cont_lft">
												<?php if($hdn_image>0){?>
												<img alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$cat_pro->deal_key.'_'.$hdn_image.'.png'?>&w=56&h=57"/> 
												<?php }else{?>
												<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" style="width:56px;height:57px;"/> 
												<?php }?>
											</div>
											<div class="new_cate_list_cont_rgt">
												<a href="<?php echo PATH .$cat_pro->store_url_title. '/product/' . $cat_pro->deal_key . '/' . $cat_pro->url_title . '.html'; ?>" title="<?php echo $cat_pro->deal_title; ?>"><?php echo substr(ucfirst($cat_pro->deal_title), 0, 20); ?></a>
											<div class="new_cate_list_cont_rgt_stars">
												 <?php $avg_rating = $cat_pro->avg_rating;
												if($avg_rating!=''){
													$avg_rating = round($avg_rating); ?>
													<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
												<?php }else{?>
													<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
												<?php }?>
											</div>
											 <?php if($cat_pro->deal_price!=0) { ?>	
												<p><?php echo $symbol . " " . $cat_pro->deal_value; ?> <span><?php echo $symbol . " " . $cat_pro->deal_price; ?></span></p>
											   <?php } else  { ?>
												<p><?php echo $symbol . " " . $cat_pro->deal_value; ?> <span></span></p>
												<?php } ?> 
											
											</div>
										</div>
									</li> 
									<?php }?>
								</ul>
								<?php }else{?>
								<div class="listing_no_product1"><label><?php echo $this->Lang['NO_PRODUCTS'];?></label></label></div>
								<?php }?>
							</div>
						</div>
                    </li>
                    <?php  $cat_cnt++; }
                    }?>
                  </ul>
            </div>
            
            <div class="new_home_blog">
                <div class="new_home_blog_title">
                    <h2><?php echo $this->Lang['FROM_THE_BLOG'];?></h2>
                </div>
                <div class="new_home_blog_list">
                    <ul id="mycarousel16" class="jcarousel-skin-tango6">
						<?php if(count($this->blog_list)>0){ ?>
						<li>
							<?php for($blg=0;$blg<3;$blg++){ 
								$blg_det = $this->blog_list[$blg];
								if(is_object($blg_det) && count($blg_det)>0){?>
                            <div class="new_home_blog_list_cont <?php if($blg==2){?> margin_right0 <?php }?>">
                                <div class="new_home_blog_list_cont_img">
                                    <a href="<?php echo PATH.'blog/'.$blg_det->url_title.'.html';?>" title="<?php echo ucfirst($blg_det->blog_title);?>">
                                    <?php if(file_exists(DOCROOT.'images/blog_images/'.$blg_det->blog_id.'.jpg')){?>
										<img alt="" src="<?php echo PATH.'images/blog_images/'.$blg_det->blog_id.'.jpg';?>" style="width:343px;height:120px;"/>
									<?php }else{?>
										<img alt="" src="<?php echo PATH.'themes/'.THEME_NAME.'/images/noimage.png';?>" style="width:343px;height:120px;"/>
									<?php }?>
                                    </a>
                                </div>                            
                                <div class="new_home_blog_list_cont_details " >
                                    <a href="<?php echo PATH.'blog/'.$blg_det->url_title.'.html';?>" title="<?php echo ucfirst($blg_det->blog_title);?>"><?php echo substr(ucfirst($blg_det->blog_title),0,40);?> </a>
                                    <p><?php echo substr(strip_tags(html_entity_decode(ucfirst($blg_det->blog_description))),0,100);?></p>
                                </div>
                            </div>
                            <?php }}?>
                        </li>
                        <?php if(count($this->blog_list)>2){?>
                        <li>
                            <?php for($blg=2;$blg<count($this->blog_list);$blg++){ 
								$blg_det = $this->blog_list[$blg];
								if(is_object($blg_det) && count($blg_det)>0){?>
                            <div class="new_home_blog_list_cont">
                                <div class="new_home_blog_list_cont_img">
                                    <a href="<?php echo PATH.'blog/'.$blg_det->url_title.'.html';?>" title="<?php echo ucfirst($blg_det->blog_title);?>">
                                    <?php if(file_exists(DOCROOT.'images/blog_images/'.$blg_det->blog_id.'.jpg')){?>
										<img alt="" src="<?php echo PATH.'images/blog_images/'.$blg_det->blog_id.'.jpg';?>" style="width:343px;height:120px;"/>
									<?php }else{?>
										<img alt="" src="<?php echo PATH.'themes/'.THEME_NAME.'/images/noimage.png';?>" style="width:343px;height:120px;"/>
									<?php }?></a>
                                </div>                            
                                <div class="new_home_blog_list_cont_details">
                                    <a href="<?php echo PATH.'blog/'.$blg_det->url_title.'.html';?>" title="<?php echo ucfirst($blg_det->blog_title);?>"><?php echo substr(ucfirst($blg_det->blog_title),0,40);?> </a>
                                    <p><?php echo substr(strip_tags(html_entity_decode(ucfirst($blg_det->blog_description))),0,100);?></p>
                                </div>
                            </div>
                            <?php }}?>
                        </li>
                        <?php }}?>
                    </ul>
                </div>
            </div>
            <div class="new_advertice_part">
                <div class="new_advertice_part_inner">
					<?php if (count($this->ads_details) > 0) {
						foreach ($this->ads_details as $ads) {
							if ($ads->ads_position == "hb2" && $ads->page_position==1) {  ?>
							<div class="new_advertice_full_width">
								<a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
							</div>
                    <?php }}}?>
                </div>
            </div>
        </div>
    </div>
</div>
