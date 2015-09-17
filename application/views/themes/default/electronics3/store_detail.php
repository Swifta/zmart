<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery(1).js"  type="text/javascript"></script>
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#mycarousel5').jcarousel({
            wrap: 'circular'
        });
    });
</script>
<script type="text/javascript" src="<?php echo PATH; ?>js/timer/kk_countdown_1_2_jquery_min.js"></script>
<script type="text/javascript" src="<?php echo PATH; ?>js/timer/kk_countdown_1_2_jquery_min_detail.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("body").kkCountDowndetail({
            colorText: '#7b7b7b',
            addClass: 'shadow'
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
	
       
         $('.submit-link')
               .click(function(e){ 
			$('input[name="c"]').val(btoa($(this).attr('id').replace('sample-','')));
			$('input[name="c_t"]').val('<?php echo base64_encode("main"); ?>');
                       e.preventDefault();
                       $(this).closest('form')
                               .submit();                                               
                });
        });
$(function() {
$(".slidetabs").tabs(".images > div", {
	effect: 'fade',
	fadeOutSpeed: "medium",
	rotate: true
}).slideshow();
});
</script>


		
         <?php 
				$font_color = "";
				$bg_color ="";
				$font_size ="";
				if(count($this->merchant_personalised_details)>0) { 
					foreach($this->merchant_personalised_details as $m) {  
						$font_color = "color:".$m->font_color.";";
						$bg_color ="background:".$m->bg_color.";";
						$font_size = $m->font_size."px";
					} 
				}	?>           
          
<div class="contianer_outer1" style="<?php echo $bg_color; ?>">
    <div class="contianer_inner">
        <div class="contianer">
            <?php /*<div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><a href="<?php echo PATH; ?>stores.html" title="<?php echo $this->Lang['STORES']; ?>"><?php echo $this->Lang['STORES']; ?></a></p></li>
                    <?php foreach ($this->get_store_details as $store) { ?>
                        <li><p><?php echo ucfirst($store->store_name); ?></p></li>
                    <?php } ?>
                </ul>
            </div> */ ?>
            <div  id="messagedisplay1" style="display:none;">      
                <div class="session_wrap">
                    <div class="session_container">
                        <div class="success_session">
                            <p><span ><?php echo $this->Lang['COMM_POST_SUCC']; ?>.</span></p>
                            <div class="close_session_2">
                                <a class="closestatus cur" title="<?php echo $this->Lang['CLOSE']; ?>"  onclick="return closeerr();" >&nbsp;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <?php echo new View("themes/" . THEME_NAME . "/".$this->theme_name."/store_center"); ?>
            
            
            <div class="tabs_part">

					<ul class="tab_menu">
						<?php //if ((count($this->get_product_categories) > 0 )|| (count($this->get_deals_categories) > 0) || (count($this->get_auction_categories) > 0)) { ?>  
							<li id="featured" class="active">Featured</li>
						<?php //}?>
						<?php //if ((count($this->get_product_categories) > 0 )|| (count($this->get_deals_categories) > 0) || (count($this->get_auction_categories) > 0)) { ?>
							<li id="new_arival">New Arrival</li>
						<?php //} ?>
						<?php //if ((count($this->get_product_categories) > 0 )|| (count($this->get_deals_categories) > 0) || (count($this->get_auction_categories) > 0)) { ?>
							<li id="top_selling">Top Selling</li>
						<?php //} ?>
					</ul>	
					<?php //if ((count($this->get_product_categories) > 0 )|| (count($this->get_deals_categories) > 0) || (count($this->get_auction_categories) > 0)) { ?>
						<div class="tab_cont featured inner_part_common">
							<?php  echo new View("themes/" . THEME_NAME."/".$this->theme_name. "/store_details_tab1"); ?>
						</div>
					<?php //} ?>
                                        <div class="tab_cont new_arival" style="visibility: hidden;">
						<?php //if ((count($this->get_product_categories) > 0 )|| (count($this->get_deals_categories) > 0) || (count($this->get_auction_categories) > 0)) { ?>
							<div class="tab_cont new_arival inner_part_common">			
								<?php  echo new View("themes/" . THEME_NAME ."/".$this->theme_name. "/store_details_tab2"); ?>
								<?php /*<p class="not_found">Products not found</p>*/?>
							</div>
						<?php //} ?>
					</div>
					<div class="tab_cont top_selling" style="visibility: hidden;">
						<?php //if ((count($this->get_product_categories) > 0 )|| (count($this->get_deals_categories) > 0) || (count($this->get_auction_categories) > 0)) { ?>	
							<div class="tab_cont top_selling inner_part_common">			
								<?php  echo new View("themes/" . THEME_NAME ."/".$this->theme_name. "/store_details_tab3"); ?>
							</div>
						<?php //} ?>
						<?php /*<p class="not_found">Products not found</p>*/?>
					</div>
                
                
				
			</div>  
			<?php if(count($this->best_seller)>0) { ?>
                    <div class="green_auction_bst_seller">
                        <div class="title_outer">
                            <h2 class="title_inner2">Best Seller</h2>
                        </div>
                        <div class="green_auction_bst_seller_inner">
                            <div class="slider_wrap">
                                <ul id="mycarousel5" class="jcarousel-skin-tango2">
								<?php foreach($this->best_seller as $best) {  $symbol = CURRENCY_SYMBOL; ?>
                                    <li>
                                        <div class="store_product_list">
                                            <div class=" store_product_list_img">
                                                 <a href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>" title="<?php echo $best->deal_title; ?>">
													<?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $best->deal_key . '_1' . '.png')) { $image_url = PATH . 'images/products/1000_800/' . $best->deal_key . '_1' . '.png';
												$size = getimagesize($image_url); if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                                                 <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $best->deal_key . '_1' . '.png' ?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $best->deal_title; ?>" title="<?php echo $best->deal_title; ?>" />
												<?php } else { ?>
												 <img src="<?php echo PATH .'images/products/1000_800/'.$best->deal_key.'_1'.'.png'?>" />
												<?php } ?>
                                                <?php } else { ?>
														<img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" alt="<?php echo $best->deal_title; ?>" title="<?php echo $best->deal_title; ?>" />
												<?php } ?>
                                               </a>
                                            </div>
                                            <a href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>"><div class=" bst_seller_list_img_hover"></div></a>
                                        <div class="store_product_list_detail">
                                            <a class="pro_title" href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>" title="<?php echo $best->deal_title; ?>" style="font:normal <?php echo $font_size; ?> arial;<?php echo $font_color; ?>"> <?php echo $best->deal_title; ?></a>
                                            <div class="ratings">
												
<?php $avg_rating = $best->avg_rating;
if($avg_rating!=''){
	$avg_rating = round($avg_rating); ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/star_<?php echo $avg_rating;?>.png"/>
<?php } else { ?>
	<img alt="" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/gray.png"/>
<?php } ?>
                                            </div>
                                            
                                            <p><?php echo $symbol . " " . $best->deal_value; ?></p>
                                        </div>
                                            <div class="store_product_list_hover">
                                                <a href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>"><div class=" store_product_list_img_hover"></div></a>
                                                <div class="store_product_list_detail white_bg">
                                                    <a class="pro_title" href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>" title="<?php echo $best->deal_title; ?>" style="font:normal <?php echo $font_size; ?> arial;<?php echo $font_color; ?>"> <?php echo $best->deal_title; ?></a>
                                                    <div class="green_cart_outer">
                                                        <a href="<?php echo PATH . $best->store_url_title . '/product/' . $best->deal_key . '/' . $best->url_title . '.html'; ?>" class="bst_seller_hover_cart_icon"></a>
                                                    </div>
                                                    <div class="compare_wish">
                                                    <div class="wish">
                                                        <a onclick="addToWishList('<?php echo $best->deal_id; ?>','<?php echo addslashes($best->deal_title); ?>');" title="<?php echo $this->Lang['ADD_WISH_LIST'];?>">&nbsp;</a>
                                                    </div>
                                                    <div class="cmpr">
                                                        
<a onclick="addToCompare('<?php echo $best->deal_id; ?>','','detail');" title="<?php echo $this->Lang['ADD_COMPARE']; ?>">&nbsp;</a>
                                                    </div>
                                                </div>
                                                </div>
                                                
                                            </div>
                                        
                                        </div>
                                    </li>
                                  <?php } ?>
                                </ul>
                            </div> 
                        </div>  
                    </div>   
                     <?php }else{  ?>  
            
            <div class="empty_product">
                <div class="title_outer">
                    <h2 class="title_inner2">Best Seller</h2>  
                </div>  
				<div class="no_deals">
					<p><?php echo $this->Lang["PRD_CURR_NT_AVAIL"]; ?></p>
				</div>
                <?php /*
                <ul>
					<?php for($bs=0;$bs<4;$bs++){?>
                    <li>
                        <div class="empty_product_list">
                            <div class=" store_product_list_img">
                                <a href="#" title="<?php echo $this->Lang['PRODUCT_IMG']; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/pro_noimage.png"/></a>
                            </div>
                            <div class="empty_pro_det">
                            <h3><a href="#" title="<?php echo $this->Lang['PRODUCT_TITLE']; ?>"><?php echo $this->Lang['PRODUCT_TITLE']; ?></a></h3>
                            <p><?php echo $this->Lang['PRODUCT_PRI']; ?></p>                                                       
                            </div>
                        </div>
                    </li>
                    <?php }?>
                </ul>
                */ ?>
            </div>
          <?php  } ?>  
            <div class="map_address_part">
                <div class="store_address">                    
                        <?php foreach ($this->get_store_details as $store) { ?>                
                    <?php /*<div class="store_image wloader_parent">
                        <i class="wloader_img" style="min-height: 300px;">&nbsp;</i>           
                        <?php if (file_exists(DOCROOT . 'images/merchant/600_370/' . $store->merchant_id . '_' . $store->store_id . '.png')) { ?>
                            <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/merchant/600_370/' . $store->merchant_id . '_' . $store->store_id . '.png' ?>&w=<?php echo STORE_DETAIL_WIDTH; ?>&h=<?php echo STORE_DETAIL_HEIGHT; ?>" alt="<?php echo $this->Lang['IMAGE']; ?>" />
                        <?php } else { ?>
                            <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_stores_details.png&w=<?php echo STORE_DETAIL_WIDTH; ?>&h=<?php echo STORE_DETAIL_HEIGHT; ?>"  alt="<?php echo $this->Lang['IMAGE']; ?>">
                        <?php } ?>
                    </div> */ ?>
                    <div class="map_address">                    
                        <div class="clearfix wloader_parent">
                            <i class="wloader_img">&nbsp;</i>
                            <div id="map_main" style="height:306px;"></div>
                            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                            <script type="text/javascript">
                                var latlng = new google.maps.LatLng(<?php echo $store->latitude; ?>,<?php echo $store->longitude; ?>);
                                var myOptions = {
                                    zoom: 12,
                                    center: latlng,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                                    navigationControl: true,
                                    mapTypeControl: true,
                                    scaleControl: true
                                };
                            
                                var map = new google.maps.Map(document.getElementById("map_main"), myOptions);
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    animation: google.maps.Animation.BOUNCE
                                });
                            
                                var infowindow = new google.maps.InfoWindow({
                                    content: '<b><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $store->store_name); ?></b><p><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $store->address1); ?></p><p><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $store->address2); ?></p><p><?php echo $store->city_name; ?>,<?php echo $store->country_name; ?></p>'
                                });
                            
                                google.maps.event.addListener(marker, 'click', function() { 
                                    infowindow.open(map, marker);
                                });
                                marker.setMap(map);
                            
                            </script>
                        </div>                                                                                                                        
                    </div>
                    <div class="store_address_cont">                    
                    <h2><?php echo ucfirst($store->store_name) ; ?></h2>                    
                        <?php /* <h2 class="deal_sub_title store_address_title"><?php echo $this->Lang['ADDRES']; ?></h2> */ ?>                        
                            <!--<h3><?php echo $store->store_name; ?>,</h3>-->
                            <p><?php echo $store->address1; ?>,</p>
                            <p><?php echo $store->address2; ?>,  </p>                                    
                            <p><?php echo $store->city_name; ?>, <?php echo $store->country_name; ?>. </p>                  
                            <p><?php echo $this->Lang['MOBILE']; ?>: <?php echo $store->phone_number; ?> </p>
                            <p><?php echo $this->Lang['WEBSITE']; ?>: <a href="<?php echo $store->website; ?>" target="blank" class="deal_web_link"> <?php echo $store->website; ?></a></p>                        
                    </div>
                <?php } ?>                    
                </div> 
                <div class="store_map_comment">
                    <div class="title_outer">
                        <h2 class="title_inner2"><?php echo $this->Lang['COMM']; ?></h2>  
                    </div>                    
                        <div class="fbok_comment wloader_parent" style="min-height:0px;">
                            <i class="wloader_img">&nbsp;</i>
                            <div id="fb-root"></div>
                            <script>
                                (function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;

                                    js = d.createElement(s); js.id = id;
                                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));														
                            </script>
                            <div width="100%" class="fb-comments" data-href="<?php echo PATH . $store->store_url_title.'/'; ?>" data-num-posts="10" ></div>
                        </div>                     
                </div>
            </div>
            <?php if (count($this->get_sub_store_details) > 0) { ?>     
            <div class="store_page_listing">
                <div class="product_list_inner">
                    
                        <div class="store_slide_list clearfix">
                                <h2 class="inner_commen_title" style="text-transform:uppercase;"> <?php echo $this->Lang['BRANCHES']; ?><span class="right_top_ae">&nbsp; </span></h2>                                                                        
                                <div class="slider_wrap">
                                    <ul <?php if (count($this->get_sub_store_details) > 6) { ?> id="mycarousel" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?> >


                                                    <?php foreach ($this->get_sub_store_details as $stores) { ?>

                                            <li>

                                                <div class="branch_listing">                                                                                                                        
                                                    <div class="branch_listing_img">      
                                                        <i class="wloader_img">&nbsp;</i>
                                                        <?php if (file_exists(DOCROOT . 'images/merchant/290_215/' . $stores->merchant_id . '_' . $stores->store_id . '.png')) { ?>
                                                            <a href="<?php echo PATH . $stores->store_url_title . '/'; ?>" title="<?php echo $stores->store_name; ?>">
                                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/merchant/290_215/' . $stores->merchant_id . '_' . $stores->store_id . '.png' ?>&w=150&h=130" alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>" />
            <?php /* <img  src="<?php echo PATH.'images/merchant/290_215/'.$stores->merchant_id.'_'.$stores->store_id.'.png';?>"   alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>"> */ ?></a>
        <?php } else { ?>
                                                            <a href="<?php echo PATH . $stores->store_url_title.'/'; ?>" title="<?php echo $stores->store_name; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_stores_list.png&w=150&h=130"   alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>" ></a>
        <?php } ?>                                                   
                                                    </div>
                                                    <div class="branch_details">
                                                        <a style="font:bold <?php echo $font_size; ?> arial;<?php echo $font_color; ?>" href="<?php echo PATH . $stores->store_url_title . '/'; ?>" title="<?php echo $stores->store_name; ?>"><?php echo substr(ucfirst($stores->store_name), 0, 100) ; ?></a>
                                                        <p style="font:11px/15px arial;color:#666;"><?php echo substr($stores->about_us,0,150); ?></p>
                                                        <!--<h3> <a title="<?php echo $stores->address1; ?>" ><?php echo $stores->address1; ?></a></h3> -->
                                                    
                                                                                                                                                                                                                                                                                                                                                    
                                                        <div class="branch_details_but">
                                                          <a href="<?php echo PATH . $stores->store_url_title.'/'; ?>" title="<?php echo $this->Lang['VIEW_DETAILS']; ?>"><?php echo $this->Lang['VIEW_DETAILS']; ?></a>                                                                                                                                                      
                                                        </div>
                                                        
                                                    </div>                                                                                                                        
                                                </div> 
                                            </li>
                                <?php } ?>   


                                    </ul>
                                </div>                                                                 
                                </div>

                </div>
            </div>
            <?php }else{  ?>
			<div class="empty_branches">
                            <h2 class="inner_commen_title" style="text-transform:uppercase;"> <?php echo $this->Lang['BRANCHES']; ?><span class="right_top_ae">&nbsp; </span></h2>
							<div class="no_deals">
								<p><?php echo $this->Lang["BRANCH_CURR_NT_AVAIL"]; ?></p>
							</div>
                            <?php /*
                            <ul>
								<?php for($kk=0;$kk<6;$kk++){?>
                                <li>
                                    <div class="empty_branch_list">
                                        <div class="branch_listing_img">
                                            <a href="#"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/branches_noimage.png"   alt="<?php echo $this->Lang['STORE_NAME']; ?>" title="<?php echo $this->Lang['STORE_NAME']; ?>" ></a>
                                        </div>
                                        <div class="empty_br_det">
                                            <h3><a href="#"><?php echo $this->Lang['STORE_NAME']; ?></a></h3>
                                            <p>Description</p>
                                        </div>
                                        <div class="empty_br_but">
                                            <a href="#" title="View more">View more</a>
                                           </div>
                                    </div>
                                </li>
                                <?php }?>
                            </ul>
                            */ ?>
                        </div>
                        <?php } ?>
			
</div>
</div>
</div>
<div class="store_subscribe_part_outer">
    <div class="store_subscribe_part">
        <div class="store_subscribe_part_inner">            
            <div class="sub_cont">
                <div class="sub_cont_inner">
                    <input type="text" name="store_subscriber" id="store_subscriber" placeholder="Enter Email Address" onkeypress="return check_color();" />
                    <input type="submit" onclick="return store_subscriber_validate('<?php echo $this->storeurl;?>');" value="Subscribe"/>
                    <input type="hidden" name="subscriber_store_id" id="subscriber_store_id" value="<?php echo $this->storeid;?>"/>
                </div>  
                <em id="email_subscriber_error"></em>
            </div>
        </div>
    </div>    
</div>

<?php /*
<script type="text/javascript">
$("#featured").on("click",function(){
    $("#featured").addClass("active");
    $("#new_arival").removeClass("active");
    $("#top_selling").removeClass("active");
    $(".featured").show();
    $(".new_arival").hide();
    $(".top_selling").hide();
});
$("#new_arival").on("click",function(){
    $("#new_arival").addClass("active");
    $("#featured").removeClass("active");
    $("#top_selling").removeClass("active");
    $(".featured").hide();
    $(".new_arival").show();
    $(".top_selling").hide();
});
$("#top_selling").on("click",function(){
    $("#featured").removeClass("active");
    $("#new_arival").removeClass("active");
    $("#top_selling").addClass("active");
    $(".featured").hide();
    $(".new_arival").hide();
    $(".top_selling").show();
});

</script> */?>


<script>
function store_subscriber_validate(store_url)
{
	var email = $("#store_subscriber").val();
	var atpos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	var x=0;
	if(email == '') {
			$('.sub_cont_inner').css('border','1px solid red');
			x++;
		}
		else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
		{
			x++;
			$('.sub_cont_inner').css('border','1px solid red');
		}
		else {
			x=0;
			$('#email_subscriber_error').html('');
		}
		if(x==0){
		var url= Path+'users/check_user_signup/?email='+email;
		$.post(url,function(check){
			if(check == -1){
				$('.sub_cont_inner').css('border','1px solid red');
				$("#store_subscriber").val('');
				$("#store_subscriber").attr('placeholder','<?php echo $this->Lang['EMAIL_EXIST']; ?>');
				return false;
			}
			add_store_email_subscriber(email,store_url);
			
		});
	}
	
}
function add_store_email_subscriber(email,store_url)
{
	var store_id=$("#subscriber_store_id").val();
	var url= Path+'stores/user_subscriber_signup/?email='+email+'&store_id='+store_id+'&store_url='+store_url;
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,
		dataType:"html",
		success:function(check)
		{
			window.location.href=Path+store_url+'/';
			
		},
		error:function()
		{
			
		}
	});
}
function check_color(){
	$('.sub_cont_inner').css('border','none');
}
</script>
<script>
 $(document).ready(function(){ 
	 $('.new_arival').css("display","none");
	  $('.top_selling').css("display","none");
 });	
</script>
