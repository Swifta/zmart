<script type="text/javascript" src="<?php echo PATH; ?>js/timer/kk_countdown_1_2_jquery_min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("body").kkCountDown({
            colorText: '#7b7b7b',
            addClass: 'shadow'
        });
    });
</script>
<?php // for filter functionality
	$main_cat = (isset($this->sub_cat) && ($this->sub_cat == "") && ($this->sub_cat !=2) && ($this->sub_cat !=3)) ? $this->category_url : "";
	$sub_cat = (isset($this->sub_cat) && ($this->sub_cat != "") && ($this->sub_cat !=2) && ($this->sub_cat !=3)) ? $this->category_url : "";
	$sec_cat = (isset($this->sub_cat) && ($this->sub_cat != "") && ($this->sub_cat ==2) && ($this->sub_cat !=3)) ? $this->category_url : "";
	$third_cat = (isset($this->sub_cat) && ($this->sub_cat != "") && ($this->sub_cat !=2) && ($this->sub_cat ==3)) ? $this->category_url : "";
	$symbol = CURRENCY_SYMBOL;
?>
<script type="text/javascript">
    $(document).ready(function() {
           $('#deal_discount_filter').hide();
        $('#deal_price_filter').hide();
        $('#deal_pricetext_filter').hide();
        $('a.view_more_but').live("click", function(e) {
        
            var offset = 0;
            offset = document.getElementById('offset').value;
            var record = document.getElementById('record').value;
            var record1 = document.getElementById('record1').value;
            var discount = "";
			$(".discount input:checked").each(function() {
				discount += this.value+',';
			});

			var price = "";
			$(".price input:checked").each(function() {
				price += this.value+',';
			});

			var price_text = $("#amount1").val();
			if(price_text==undefined){
			        var price_text = "";
			}
			

            var url = '<?php echo PATH; ?>' + 'deals/today_deals_1?offset=' + offset + '&record=' + record+'&discount='+discount+'&price='+price+'&main='+'<?php echo $main_cat; ?>'+'&sub='+'<?php echo $sub_cat; ?>'+'&sec='+'<?php echo $sec_cat; ?>'+'&third='+'<?php echo $third_cat; ?>'+'&price1='+price_text;

            $.post(url, function(check) {

                if (check) {
               
                    $('#deal').append(check);
                     $(".wloader_img").hide();
                    $('#loading').show();
                    
                    offset = parseInt(offset) + 12;

                    $("#offset").val(offset);

                    if (offset >= record1) {

                        $('#loading').hide();

                    }

                }
            });

        });
    });

</script>
<div class="contianer_outer">
    <div class="contianer_inner">
        <?php /*  <div class="bread_crumb">
          <ul>
          <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
          <li><p>
          <?php if (($this->uri->last_segment() != "today-deals.html")) { ?>
          <a href="<?php echo PATH; ?>today-deals.html" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['DEAL_LIST']; ?></a></p>
          <?php } else {
          echo $this->Lang['DEAL_LIST'];
          } ?>
          </li>
          <?php if (($this->uri->last_segment() != "today-deals.html")) { ?>

          <li class="bread_crum_about">

          <?php if(isset($this->sub_cat)) { ?>
          <p><a href="<?php echo PATH; ?>deal/c/<?php echo base64_encode("main"); ?>/<?php echo strtolower($this->category_name); ?>.html"><?php echo $this->category_name; ?></a>&nbsp;&nbsp;&nbsp;<?php echo $this->sub_cat; ?></p>
          <?php } else { ?>
          <p>  <?php echo $this->category_name; ?></p>
          <?php } ?>
          </li>
          <?php } ?>
          </ul>
          </div> */ ?>
        <?php if (count($this->all_deals_list) > 0) { ?>
            <div class="contianer">

                <!--content start-->
                <div class="content">                      
                    <div class="content_right">
						<div class="res_category">
                                                    <ul class="cate_menu">
							<?php
							$cat = explode(",", substr($this->session->get('categoryID'), 0, -1));
							$cat1 = array_unique($cat);?>
							<?php
							foreach ($this->categeory_list_deal as $d) {
								$check_sub_cat = $d->deal_count;
								$subcate_count = 1;
								$subcat_style = ($subcate_count==0)?"background:none":"";
								$encode_catid = $d->category_id;
								if ($d->deal == 1 && ($check_sub_cat != -1) && ($check_sub_cat !=0)) {?>
									<li <?php if ($this->category_id == $d->category_id) { ?> class="li_active" <?php } ?>>
									<?php $type = "deal";
									$categories = $d->category_url;?>
										<a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" class="sample cate_subarr" id="sample-<?php echo $encode_catid; ?>"  onclick="filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');"  title="<?php echo ucfirst($d->category_name); ?>"><?php echo ucfirst($d->category_name) . ' (' . $check_sub_cat . ')'; ?></a>
									</li>
								<?php }
								}?>
                                                    </ul>
						</div>
                        <div class="clearfix">
                            <?php if (count($this->banner_details) > 0) { ?>                        
                                        <?php if (count($this->banner_details) != 1) { ?>                        
                                <div class="banner">
                                    <div class="slider_home">
                                        <div class="images wloader_parent">
                                            <i class="wloader_img" style="min-height: 248px;">&nbsp;</i>   
            <?php foreach ($this->banner_details as $banner) { ?>                                            
                                                <div style="display: block;">                                                                                                        
                                                    <a target="_blank" href="<?php echo $banner->redirect_url; ?>" title = "<?php echo $banner->image_title; ?>">                                                       
                                                        <img src="<?php echo PATH . 'images/banner_images/' . $banner->banner_id . '.png'; ?>" alt="<?php echo $banner->image_title; ?>"></a>
                                                </div>
            <?php } ?>
                                        </div>
                                        <div class="controls">
                                            <div class="for_back">
                                                <a class="backward">&nbsp;</a>
                                            </div>
                                            <div class="slidetabs">
                                                <?php for ($i = 1; $i <= count($this->banner_details); $i++) { ?>
                                                    <a href="" class="current">&nbsp;</a>
            <?php } ?>
                                            </div>
                                            <div class="for_back">
                                                <a class="forward">&nbsp;</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <?php } else { ?>
                                <div class="banner">
                                    <div class="images">
                                        <?php foreach ($this->banner_details as $banner) { ?>
                                            <a  target="_blank" href="<?php echo $banner->redirect_url; ?>" title = "<?php echo $banner->image_title; ?>" ><img src="<?php echo PATH . 'images/banner_images/' . $banner->banner_id . '.png'; ?>" alt="<?php echo $banner->image_title; ?>"></a>
                                <?php } ?>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>
            <?php if (count($this->ads_details) > 0) { ?>   
                                    <?php foreach ($this->ads_details as $ads) { ?>    
            <?php if ($ads->ads_position == "rs1" && $ads->page_position==2) {  ?>                     
                                  <div class="banner_right_add2 wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
										 <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
                                  </div>
              <?php } ?>
              <?php if ($ads->ads_position == "rs2" && $ads->page_position==2){  ?>   
                         <div class="banner_right_add wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
										 <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a> </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
                            </div>
                       <?php if (count($this->view_hot_deals_list ) > 0) { ?>
                        <div class="hot_prodocuts">
                            <ul>
                             <?php
                                            foreach ($this->view_hot_deals_list as $h) {
                                                $symbol = CURRENCY_SYMBOL;
                                                ?>
                                <li>
                                    <div class="deal_listing_image wloader_parent">
                                        <i class="wloader_img">&nbsp;</i>
                                       <?php
											$image=array();
											for($i=1;$i<=5;$i++)
												if(file_exists(DOCROOT . 'images/deals/1000_800/' . $h->deal_key . '_'.$i. '.png'))
													$image[] = $i;
											
											if(count($image)>0){ 
												$image_url = PATH . 'images/deals/1000_800/' . $h->deal_key . '_'.$image[0] . '.png';
												$size = getimagesize($image_url);?>
											<div class="deal_image_3">
												<a href="<?php echo PATH . $h->store_url_title.'/deals/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>"> 
												<?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
												<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$h->deal_key.'_'.$image[0].'.png'?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>" alt="<?php echo $h->deal_title; ?>"   border="0" />
												<?php }else{?>
												 <img src="<?php echo PATH .'images/deals/1000_800/'.$h->deal_key.'_'.$image[0].'.png'?>" alt="<?php echo $h->deal_title; ?>"   border="0" />
												<?php }?>
												</a>
											</div>
											<?php 
												if(isset($image[1]) && $image[1]!=''){
													$image_url = PATH . 'images/deals/1000_800/' . $h->deal_key . '_'.$image[1] . '.png';
													$size = getimagesize($image_url); ?>
													<div class="deal_image_4">
														<a href="<?php echo PATH . $h->store_url_title.'/deals/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>"> 
													 <?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
														<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$h->deal_key.'_'.$image[1].'.png'?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>" alt="<?php echo $h->deal_title; ?>"   border="0" />
														<?php }else{?>
														 <img src="<?php echo PATH .'images/deals/1000_800/'.$h->deal_key.'_'.$image[1].'.png'?>" alt="<?php echo $h->deal_title; ?>"   border="0" />
														<?php }?>
														</a>
													</div>
												<?php }else{ ?>
												<div class="deal_image_4">
														<a href="<?php echo PATH . $h->store_url_title.'/deals/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $h->deal_title; ?>" title="<?php echo $h->deal_title; ?>" ></a>
												   </div>
												<?php }
											}else{ ?>
											 <div class="deal_image_3">
												<a href="<?php echo PATH . $h->store_url_title.'/deals/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $h->deal_title; ?>" title="<?php echo $h->deal_title; ?>" ></a>
										   </div>
											 <div class="deal_image_4">
												<a href="<?php echo PATH . $h->store_url_title.'/deals/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $h->deal_title; ?>" title="<?php echo $h->deal_title; ?>" ></a>
										   </div>
											<?php }?> 
                                       <?php /*<div class="deal_image_1">
                                     <?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $h->deal_key . '_1' . '.png')) { 
                                        $image_url = PATH . 'images/deals/1000_800/' . $h->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                                        ?>
                                                    <a href="<?php echo PATH . $h->store_url_title.'/deals/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>">
                                                    <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                                                         <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$h->deal_key.'_1'.'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $h->deal_title; ?>"   border="0" />
                                                         <?php } else { ?>
                                 <img src="<?php echo PATH .'images/deals/1000_800/'.$h->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                                     </a>
                                                <?php } else { ?>
                                                    <a href="<?php echo PATH . $h->store_url_title.'/deals/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>">
                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $h->deal_title; ?>" /></a>
            <?php } ?>

                                       </div>
                                        <div class="deal_image_2">
                                            <a href="<?php echo PATH . $h->store_url_title.'/deals/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>">
                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $h->deal_title; ?>" /></a>
                                        </div>*/?>
                                        
                                    </div>
                                    <div class="hot_label">
                                            <p>OFF</p>
                                            <p><?php echo round($h->deal_percentage); ?>%</p>
                                        </div>
                                    <div class="product_listing_detail">
                                        <h2><a class="cursor" href="<?php echo PATH . $h->store_url_title.'/deals/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>"><?php echo substr(ucfirst($h->deal_title), 0, 100); ?></a></h2>
                                        <div class="deal_listing_price_details">
                                            <strike><?php echo $symbol . " " . $h->deal_price; ?></strike>
                                            <p><?php echo $symbol . " " . $h->deal_value; ?></p>
                                        </div>
                                    </div>
                                    <div class="list_bottom">
                                    <div class="bottom_stars">
                                   <?php $avg_rating = $h->avg_rating;
										if($avg_rating!=''){
											$avg_rating = round($avg_rating); ?>
											<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
										<?php }else{?>
											<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
										<?php }?>
                                    </div>
                                    <div class="new_list_bottom_icons">
                                        <ul>
                                            <li class="new_cart"><a href="<?php echo PATH . $h->store_url_title.'/deals/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                </li>
                                <?php } ?>
                            </ul>

                        </div>
                           <?php } ?>
                        <!--action deal list-->
                        <div class="product_details_list">
                            <div class="pro_top clearfix">
                                <div class="pro_title"><h2> <?php echo $this->title_display; ?> </h2></div>
                            </div>
                            <div class="pro_mid">
                                <div id="deal" class="deal_listing">
    <?php echo new View("themes/" . THEME_NAME . "/deals/today_deals_list"); ?>
                                </div>
                            </div>
    <?php if (($this->all_deals_count > 1)) { ?>
                                <div id="loading">
        <?php if (($this->pagination) != "") { ?>
                                        <div class="feature_viewmore">
                                            <div class="fea_view_more">
                                                <a  class="view_more view_more_but" title="<?php echo $this->Lang['SEE_M_DEALS']; ?>">
                                                    <span class="view_more_icon">&nbsp;</span><?php echo $this->Lang['SEE_M_DEALS']; ?><span class="view_more_icon">&nbsp;</span>
                                                </a>
                                            </div>
                                        </div>
                                <?php } ?>
                                </div>
    <?php } else { ?>
        <?php echo $this->pagination; ?>
    <?php } ?>
    
             <?php /*if (count($this->ads_details) > 0) { ?>   
                                    <?php foreach ($this->ads_details as $ads) { ?>    
            <?php if ($ads->ads_position == "bf" && $ads->page_position==2) {  ?>          
                                     <div class="side_footer_part wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
                                        <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " width="790" height="100" /></a>
                                    </div>
            <?php } ?>
        <?php } ?>
    <?php }*/ ?>

                        </div>
                    </div>
                    <!--sidebar start-->
                    <div class="conntent_left">
                        <div class="category_sidebar">
                                <form action="" method="get" name="form1"  >
                                    <h1 class="cate_title"><a href="<?php echo PATH; ?>shop-all-category.html" title=""><?php echo $this->Lang['SHOP_AL']; ?></a></h1>
                                    <ul class="cate_menu">
                                        <?php
                                        $cat = explode(",", substr($this->session->get('categoryID'), 0, -1));
                                        $cat1 = array_unique($cat);
                                        ?>

                                        <?php
                                        foreach ($this->categeory_list_deal as $d) {
                                            //$check_sub_cat = common::get_subcat_count($d->category_id, 2, "main", $d->category_url); /*   COUNT OF SUBCATEGORY   */
                                            //$subcate_count = common::get_subcat_count1($d->category_id,$d->type);
                                            $check_sub_cat = $d->deal_count;
                                             $subcate_count = 1;
											$subcat_style = ($subcate_count==0)?"background:none":"";
											$encode_catid = $d->category_id;
                                            if ($d->deal == 1 && ($check_sub_cat != -1) && ($check_sub_cat !=0)) {
                                                ?>
                                                <li <?php if ($this->category_id == $d->category_id) { ?> class="li_active" <?php } ?>>
                                                    <?php $type = "deal";
                                                    $categories = $d->category_url;
                                                    ?>

                                                    <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" class="sample cate_subarr" id="sample-<?php echo $encode_catid; ?>"  onclick="filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');"  title="<?php echo ucfirst($d->category_name); ?>">
														<?php echo ucfirst($d->category_name) . ' (' . $check_sub_cat . ')'; ?>
                                                    </a>
                                                    <div class="cate_supmenu" id="today_deal_sub_category_<?php echo $encode_catid; ?>">
                                                        <ul  id="categeory-<?php echo $encode_catid; ?>">
                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php }       }            ?>

                                    </ul>
                                </form>
                            <input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" id="submit" style="display:none;">
                            </form>
                        </div>

                        <?php

						if(!empty($main_cat) || !empty($sub_cat) || !empty($sec_cat) || !empty($third_cat)) {
						?>
						<!-- Discount filter start -->
						<div class="product_filter_side">
                            <div class="product_filter_title">
                                <h1>
                                    <span><?php echo $this->Lang['DISCOUNT']; ?></span>
                                    <a id="deal_discount_filter" class="filter_deleticon" href="javascript:clear_filter('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>','<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>','discount','2');"><?php echo $this->Lang['CLR']; ?></a>
                                </h1>
                                <div class="discount side_filter_list fulli"> <?php  /* discount class used in ajax don't remove that */ ?>
                                    <ul>
                                        <li><input type="checkbox"  value="1" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $this->Lang['BELW']; ?> 10% </p></li>
                                        <li><input type="checkbox"  value="2" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p>10% - 20% </p></li>
                                        <li><input type="checkbox"  value="3" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p>20% - 30% </p></li>
                                        <li><input type="checkbox"  value="4" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p>30% - 50%</p></li>
                                        <li><input type="checkbox"  value="5" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p>50% - 75%</p></li>
                                        <li><input type="checkbox"  value="6" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $this->Lang['ABV']; ?> 75% </p></li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <!-- Discount filter end -->

                        <!-- price filter start -->
                         <div class="product_filter_side">
                            <div class="product_filter_title">
                                <h1>
                                    <span><?php echo $this->Lang['PRI']; ?></span>
                                    <a id="deal_price_filter" class="filter_deleticon" href="javascript:clear_filter('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>','<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>','price','2');"><?php echo $this->Lang['CLR']; ?></a>
                                </h1>
                                <div class="price side_filter_list fulli"> <?php  /* price class used in ajax don't remove that */ ?>
                                    <ul>
                                        <li><input type="checkbox"  value="1" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $this->Lang['BELW']; ?> <?php echo $symbol; ?> 500 </p></li>
                                        <li><input type="checkbox"  value="2" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $symbol; ?> 501 - <?php echo $symbol; ?> 1000 </p></li>
                                        <li><input type="checkbox"  value="3" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $symbol; ?> 1001 - <?php echo $symbol; ?> 1500 </p></li>
                                        <li><input type="checkbox"  value="4" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $symbol; ?> 1501 - <?php echo $symbol; ?> 2000 </p></li>
                                        <li><input type="checkbox"  value="5" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $symbol; ?> 2001 - <?php echo $symbol; ?> 2500 </p></li>
                                        <li><input type="checkbox"  value="6" onchange="show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $this->Lang['ABV']; ?> <?php echo $symbol; ?> 2500 </p></li>

                                    </ul>
								</div>
                            </div>
                        </div>
                        <!-- price filter start -->

			<?php if ($this->deal_min != $this->deal_max) { ?>
                            <div class="product_filter_side" id="s1000">
                                <div class="product_filter_title" id="f200" >
                                    <h1>
                                        <span><?php echo $this->Lang['PRICE_RANGE']; ?></span>
                                        <a id="deal_pricetext_filter" class="filter_deleticon" href="javascript:clearprice();">Clear</a></h1>
                                    <div class="pricerange_inner">
                                    <div class="catogory_content2" id="f300">
                                        <p style="padding-top:4px;font:normal 12px arial; color: 656565;" class="p1"></p>
                                        <div id="slider-range"></div>
                                        <input class="pricerange_input" type="text" id="amount"  readonly="readonly" name="amount"/>
                                    </div>
                                    <input type="hidden" id="amount1" style="border: 0;text-align:center;" />
                                    </div>
                                </div>
                            </div>
			<?php } ?>
                    

    <?php } ?>
     
                        <!--slider_right content start-->
                        <div class="sidebar_view_product">
<?php if (count($this->view_deals_list) > 0) { ?>
                                <div class="sidebar_view_product_title">
                                    <h2> <?php echo $this->Lang['MOST_DEAL']; ?></h2>
                                </div>
                                <ul>
                                    <?php
                                    foreach ($this->view_deals_list as $deals) {
                                        if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) {

                                        } else {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>
                                            <li>
                                                <div class="new_prdt_listing">
                                                    <div class="deal_listing_image wloader_parent">
                                                            <i class="wloader_img">&nbsp;</i>
                                                           
                <?php if ($this->session->get('cate') != "") { ?> <?php $url = $this->session->get('cate'); ?> <?php } else { ?> <?php $url = $deals->category_url; ?>  <?php } ?>
                                                        
                                                            <?php
                                                            $image=array();
                                                            for($i=1;$i<=5;$i++)
																if(file_exists(DOCROOT . 'images/deals/1000_800/' . $deals->deal_key . '_'.$i. '.png'))
																	$image[] = $i;
                                                            
                                                            if(count($image)>0){ 
																$image_url = PATH . 'images/deals/1000_800/' . $deals->deal_key . '_'.$image[0] . '.png';
																$size = getimagesize($image_url);?>
                                                            <div class="deal_image_3">
                                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"> 
                                                                <?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
                                                                <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_'.$image[0].'.png'?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>" alt="<?php echo $deals->deal_title; ?>"   border="0" />
                                                                <?php }else{?>
                                                                 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_'.$image[0].'.png'?>" alt="<?php echo $deals->deal_title; ?>"   border="0" />
                                                                <?php }?>
                                                                </a>
															</div>
															<?php 
																if(isset($image[1]) && $image[1]!=''){
																	$image_url = PATH . 'images/deals/1000_800/' . $deals->deal_key . '_'.$image[1] . '.png';
																	$size = getimagesize($image_url); ?>
																	<div class="deal_image_4">
																		<a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"> 
																	 <?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
																		<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_'.$image[1].'.png'?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>" alt="<?php echo $deals->deal_title; ?>"   border="0" />
																		<?php }else{?>
																		 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_'.$image[1].'.png'?>" alt="<?php echo $deals->deal_title; ?>"   border="0" />
																		<?php }?>
																		</a>
																	</div>
																<?php }else{ ?>
																<div class="deal_image_4">
																		<a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>
																   </div>
																<?php }
															}else{ ?>
															 <div class="deal_image_3">
                                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>
                                                           </div>
															 <div class="deal_image_4">
                                                                <a href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>
                                                           </div>
															<?php }?>   
                                                        <?php $url = PATH . 'deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>
                                                     </div>
                                                    <div class="new_prdt_listing_details">
                                                        <h2>
                                                            <a class="cursor" onclick="redirect_url('<?php echo $url; ?>');" title="<?php echo $deals->deal_title; ?>"><?php echo substr(ucfirst($deals->deal_title), 0, 100); ?></a>
                                                        </h2>
                                                        
                                                       <div class="deal_timer">
                                                                <label><span time="<?php echo $deals->enddate; ?>" class="kkcount-down" ></span></label>
                                                        </div>
                                                        <div class="deal_listing_price_details">
                                                                <strike><?php echo $symbol . " " . $deals->deal_price; ?></strike>
                                                                <p><?php echo $symbol . " " . $deals->deal_value; ?></p>
                                                            </div>
                                                    </div>
                                                    <div class="list_bottom">
                                                        <div class="bottom_stars">
                                                            <?php $avg_rating = $deals->avg_rating;
															if($avg_rating!=''){
																$avg_rating = round($avg_rating); ?>
																<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
															<?php }else{?>
																<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
															<?php }?>
                                                        </div>
                                                        <div class="new_list_bottom_icons">
                                                            <ul>
                                                                <li class="new_cart"><a  href="<?php echo PATH . $deals->store_url_title.'/deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php // echo $this->Lang['BUY_NOW2']; ?></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
            <?php }  }   ?></ul>
                            </div>
                               <?php } ?>
    
    <?php /*if (count($this->ads_details) > 0) { ?>   
                                    <?php foreach ($this->ads_details as $ads) { ?>    
            <?php if ($ads->ads_position == "ls" && $ads->page_position==2) {  ?>                     
                                     <div class="side_advertise_part wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
                                        <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " width="180" height="500" /></a>
                                    </div>
            <?php } ?>
        <?php } ?>
    <?php } */?>
                        </div>
                    <!--end-->
                </div>
            </div>
            <!--end-->
<?php } else { ?>
    <?php echo new View("themes/" . THEME_NAME . "/subscribe"); ?>
<?php } ?>

    </div>
</div>
</div>
<!--scroll filter start-->
<input type="hidden" name="offset" id="offset" value="12">
<input type="hidden" name="record" id="record" value="12">
<input type="hidden" name="record" id="record1" value="<?php echo $this->all_deals_count; ?>">
<script type="text/javascript">
	$(function() {
		$('.sample').mouseover(function() {
			var getUID =  $(this).attr('id').replace('sample-','');
			var id_val = $('#sample-'+getUID).attr('data-subcat');
				if(id_val==0)
				{
					$('#today_deal_sub_category_'+getUID).css('display','none');
					$('#categeory-'+getUID).css('background','none');
				}
				else{
					//var getUID =  $(this).attr('id').replace('sample32-','');
					var url = Path+"deals/today_deals/?cate_id="+(getUID)+'&t=1';
					$.post(url,function(check){
						if(getUID!=""){
							$('#categeory-'+getUID).html(check);
							$('#categeory-'+getUID).show();
						}
					});
				}

		});
	});

</script>



<!--price and discount script-->

<link rel="stylesheet" href="<?php echo PATH . 'themes/' . THEME_NAME . '/css/jquery-ui.css' ?>" />
<script src="<?php echo PATH . 'themes/' . THEME_NAME . '/js/jquery-ui.js' ?>"></script>
<script>
    $(function() {
        $("#slider-range").slider({
            range: true,
            min: <?php echo $this->deal_min; ?>,
            max: <?php echo $this->deal_max; ?>,
            values: [<?php echo $this->deal_min; ?>,<?php echo $this->deal_max; ?>],
            slide: function(event, ui) {
                $("#amount").val("<?php echo CURRENCY_SYMBOL; ?>" + ui.values[ 0 ] + " - " + "<?php echo CURRENCY_SYMBOL; ?>" + ui.values[ 1 ]);

                $("#amount1").val("<?php echo CURRENCY_SYMBOL; ?>" + ui.values[ 0 ] + " - " + "<?php echo CURRENCY_SYMBOL; ?>" + ui.values[ 1 ]);  // this one for filter

                show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');
            },
        });
        $("#amount").val("<?php echo CURRENCY_SYMBOL; ?>" + $("#slider-range").slider("values", 0) +
                " - " + "<?php echo CURRENCY_SYMBOL; ?>" + $("#slider-range").slider("values", 1));
    });

    function clearprice() {
       $(function() {
       $( "#slider-range" ).slider({


           range: true,
           min: <?php echo $this->deal_min; ?>,
           max: <?php echo $this->deal_max; ?>,
           values: [ <?php echo $this->deal_min; ?>,<?php echo $this->deal_max; ?> ]

       });

       $( "#amount" ).val("<?php echo CURRENCY_SYMBOL; ?>" + $( "#slider-range" ).slider( "values", 0 ) +
           " - " +"<?php echo CURRENCY_SYMBOL; ?>" + $( "#slider-range" ).slider( "values", 1 ) );

           $( "#amount1" ).val("<?php echo CURRENCY_SYMBOL; ?>" + $( "#slider-range" ).slider( "values", 0 ) +
           " - " +"<?php echo CURRENCY_SYMBOL; ?>" + $( "#slider-range" ).slider( "values", 1 ) );
			/* for show the ajax result */
	   show_deal_ajax_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');

   });
       }

</script>
<!--price filter end-->

<!--scroll filter end-->


<script src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery(1).js"  type="text/javascript"></script>
<script language="JavaScript">
	var j = $.noConflict();
    j(function() {
        j(".slidetabs").tabs(".images > div", {
            effect: 'fade',
            fadeOutSpeed: "medium",
            rotate: true
        }).slideshow();
    });
</script>
