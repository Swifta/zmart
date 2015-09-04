<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
	
<script src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery(1).js"  type="text/javascript"></script>
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
	
        $("body").kkCountDown({
            colorText:'#000000',
            colorTextDay:'#000000'	
        });
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

<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#mycarousel5').jcarousel({
            wrap: 'circular'
        });
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
				<div class="tab_cont featured inner_part_common">
					

				<!--Carousel Script-->
				<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js"></script>
				<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/tabs.js"></script>
				<script type="text/javascript">

					jQuery(document).ready(function() {
						jQuery('#mycarousel').jcarousel({
							wrap: 'circular'
						});
					});

				</script>
				<script type="text/javascript">

					jQuery(document).ready(function() {
						jQuery('#mycarousel2').jcarousel({
							wrap: 'circular'
						});
					});

				</script>
				<script type="text/javascript">

					jQuery(document).ready(function() {
						jQuery('#mycarousel3').jcarousel({
							wrap: 'circular'
						});
					});

				</script>
				<script type="text/javascript">

					jQuery(document).ready(function() {
						jQuery('#mycarousel4').jcarousel({
							wrap: 'circular'
						});
					});

				</script>
				<div class="store_page_listing">
					<div class="product_list_inner">
						<?php if ($this->product_setting) { ?>                                                                            
											
									<div class="related_product_list clearfix">
										<div class="title_outer">
											<h2 class="title_inner2"><?php echo $this->Lang['PRODUCTS']; ?></h2>  
										</div> 
										<?php if (count($this->get_sold_products) > 0) { ?>                                    
											<div class="slider_wrap">
													<ul  <?php if (count($this->get_sold_products) > 4) { ?> id="mycarousel2" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>                         
														<?php
														$k = 1;
														foreach ($this->get_sold_products as $products) {
															$symbol = CURRENCY_SYMBOL;
															?>
															<li <?php if (count($this->get_sold_products) < 5) { ?> <?php if($k==4) { ?> class="margin_zero" <?php } ?> <?php } else { ?> <?php } ?> >

																<div class="store_product_list">
																	<div class=" store_product_list_img">
																		<i class="wloader_img">&nbsp;</i>
																		<?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { 
																		$image_url = PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png';
																		$size = getimagesize($image_url);
																		?>
																			<a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>">
																			<?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
																				<img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png' ?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
																				 <?php } else { ?>
												 <img src="<?php echo PATH .'images/products/1000_800/'.$products->deal_key.'_1'.'.png'?>" />
												<?php } ?>
																				
																				<?php /* <img src="<?php echo PATH.'images/products/290_215/'.$products->deal_key.'_1'.'.png';?>"  alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>"> */ ?></a>
																		<?php } else { ?>
																			<a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"  alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>"></a>
																		<?php } ?>                                                            
																	</div>

																	<div class="store_product_list_detail">
																		<a class="pro_title" style="font:<?php echo $font_size; ?> arial; <?php echo $font_color; ?>" href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 100); ?></a>
																		<!--<h3><a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo substr(ucfirst(strip_tags($products->deal_description)), 0, 20) . '...'; ?>"><?php echo substr(ucfirst(strip_tags($products->deal_description)), 0, 25) . '...'; ?></a></h3>-->
																			<?php /* <p> <?php echo $symbol . " " . $products->deal_price; ?> <?php echo CURRENCY_CODE; ?></p> */ ?>
																		<p style="font:18px arial;color:#000;"><?php echo $symbol . " " . $products->deal_value; ?> <?php echo CURRENCY_CODE; ?> </p>                                                       
																		<?php /*<div class="store_add_to_cart">
																			<a href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php echo $this->Lang['ADD_TO_CART']; ?></a>                                                                     
																		</div> */ ?>
																	</div>
																	<div class="store_product_list_hover">
																		<div class=" store_product_list_img_hover"></div> 
																		<div class="store_product_list_detail white_bg">
																		<a class="pro_title" style="font:<?php echo $font_size; ?> arial;<?php echo $font_color; ?>" href="<?php echo PATH . $products->store_url_title . '/product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 100); ?></a> 
																	</div>
																	</div>
																</div> 
															</li>
														<?php $k++; } ?>

													</ul>
											  
											</div>
											<?php }else{ ?>    
											<div class="no_product_found"><?php echo $this->Lang['NO_PRODUCT_SOLD_OUT'];?></div> 
											<?php }?>
												</div>
									<?php }?>
								</div>
							</div>
							
							<div class="store_page_listing">
								<div class="product_list_inner">                                             
										<?php if (($this->deal_setting)) { ?>
											
									<div class="related_product_list clearfix"> 
										<div class="title_outer">
											<h2 class="title_inner2"><?php echo $this->Lang['DEALS']; ?> </h2>  
										</div>
											<?php if (count($this->get_sold_deals) > 0) { ?>             
											<div class="slider_wrap">                                
													<ul  <?php $i=1; if (count($this->get_sold_deals) > 4) { ?> id="mycarousel3" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>
														<?php
														foreach ($this->get_sold_deals as $deals_categories) {
															$symbol = CURRENCY_SYMBOL;
															?>
															<li <?php if (count($this->get_sold_deals) < 5) { ?> <?php if($i==4) { ?> class="margin_zero" <?php } ?> <?php } else { ?> <?php } ?>>
																<div class="green_store_deal_list">
																	<div class="green_store_deal_list_img">
																		<i class="wloader_img">&nbsp;</i>
																		<?php if (file_exists(DOCROOT . 'images/category/icon/' . $deals_categories->category_url . '.png')) { ?>

																		<?php } else { ?>

																		<?php } ?>

																		<?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals_categories->deal_key . '_1' . '.png')) {
																		   $image_url = PATH . 'images/deals/1000_800/' . $deals_categories->deal_key . '_1' . '.png';
																		   $size = getimagesize($image_url); ?>
																			<a href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" >
																			 <?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
																				<img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/deals/1000_800/' . $deals_categories->deal_key . '_1' . '.png'; ?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>" alt="<?php echo $this->Lang['IMAGE']; ?>" title="<?php echo $this->Lang['IMAGE']; ?>" />
																				<?php } else { ?>
																				 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals_categories->deal_key.'_1'.'.png'?>" />
																				<?php } ?>
																				<?php /* <img src="<?php echo PATH.'images/deals/220_160/'.$deals_categories->deal_key.'_1'.'.png';?>"   alt="<?php echo $this->Lang['IMAGE']; ?>" title="<?php echo $this->Lang['IMAGE']; ?>" > */ ?></a>
																		<?php } else { ?>
																		<a  href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" ><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"   alt="<?php echo $this->Lang['IMAGE']; ?>" title="<?php echo $this->Lang['IMAGE']; ?>"  ></a>
																		<?php } ?>
																		</div>
																	<div class="green_store_deal_list_detail">
																		<?php $type = "";
															$categories = $deals_categories->category_url;
																		?>
																			<a class="pro_title" style="font:<?php echo $font_size; ?> arial; <?php echo $font_color; ?>" href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo substr(ucfirst($deals_categories->deal_title), 0, 25) . "..."; ?>"><?php echo substr(ucfirst($deals_categories->deal_title), 0, 100) ; ?></a>
																		
																			<p style="font:18px arial;color:#5BB110;"><?php echo $symbol . " " . $deals_categories->deal_value; ?></p>
																			                                                                                                                        
																	</div>
																	<div class="green_deal_hover">
																	  <div class="green_store_deal_list_detail">
																		<?php $type = "";
															$categories = $deals_categories->category_url;
																		?>
																			<a class="pro_title" style="font:<?php echo $font_size; ?> arial;<?php echo $font_color; ?>" href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo substr(ucfirst($deals_categories->deal_title), 0, 25) . "..."; ?>"><?php echo substr(ucfirst($deals_categories->deal_title), 0, 100) ; ?></a>
																																		   
																		<?php /*<div class="deal_list_time">
																			<div class="time_price_lft">
																				<label> <span time="<?php echo $deals_categories->enddate; ?>" class="kkcount-down" ></span></label>
																			</div>
																		</div>    */ ?>                                                  
																			<p style="font:18px arial;color:#5BB110;"><?php echo $symbol . " " . $deals_categories->deal_value; ?></p>
																			<?php /*<div class="store_add_to_cart">
																				<a href="<?php echo PATH .$deals_categories->store_url_title. '/deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php echo $this->Lang['BUY_NOW2']; ?></a>
																			</div>   */ ?>                                                                                                                        
																	</div>
																	  

																</div> 
															</li>
													<?php $i++; } ?>
													</ul>
										   
											</div>
											 <?php }else{ ?>
                             <div class="no_product_found"><?php echo $this->Lang['NO_DEAL_SOLD_OUT'];?></div>
                             <?php }?>
												</div>
												
									<?php }?>						 
								</div>                 
							</div>
							<div class="store_page_listing">
								<div class="product_list_inner">
										<?php if (($this->auction_setting)) { ?>
											
									<div class="related_product_list clearfix"> 
											<div class="title_outer">
												<h2 class="title_inner2"><?php echo $this->Lang['AUCT']; ?></h2>  
											</div>                                
											<?php if (count($this->get_sold_auction) > 0) { ?>
											<div class="slider_wrap">  
													<ul <?php $j=1; if (count($this->get_sold_auction) > 4) { ?> id="mycarousel4" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>
														<?php
														foreach ($this->get_sold_auction as $deals1) {
															$symbol = CURRENCY_SYMBOL;
															?>			
															<li <?php if (count($this->get_sold_auction) < 5) { ?> <?php if($j==4) { ?> class="margin_zero" <?php } ?> <?php } else { ?> <?php } ?> >
																<div class="store_product_list">
																	<div class="store_product_list_img">
																		<i class="wloader_img">&nbsp;</i>
							<?php if (file_exists(DOCROOT . 'images/auction/1000_800/' . $deals1->deal_key . '_1' . '.png')) { 
							   $image_url = PATH . 'images/auction/1000_800/' . $deals1->deal_key . '_1' . '.png';
												$size = getimagesize($image_url);
												?>
																			<a href="<?php echo PATH . $deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>">
																							   <?php if(($size[0] > AUCTION_LIST_WIDTH) && ($size[1] > 130)) { ?>
																				<img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/auction/1000_800/' . $deals1->deal_key . '_1' . '.png'; ?>&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=130" alt="<?php echo $deals1->deal_title; ?>" alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" border="0" />
																				<?php } else { ?>
												 <img src="<?php echo PATH .'images/auction/1000_800/'.$deals1->deal_key.'_1'.'.png'?>" />
												<?php } ?>
																				
																			<?php /* <img src="<?php echo PATH.'images/auction/220_160/'.$deals1->deal_key.'_1'.'.png';?>"  alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" border="0" /> */ ?></a>

																		<?php } else { ?>
																			<a  href="<?php echo PATH .$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_auctions_list.png&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=130"  alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>"  border="0" /></a>
																<?php } ?>  
																	</div>
																	<div class="store_product_list_detail">
																		<?php $type = "";$categories = $deals1->category_url;?>
																		<a class="pro_title" style="font:<?php echo $font_size; ?> arial;<?php echo $font_color; ?>" class="cursor" href="<?php echo PATH .$deals1->store_url_title. '/auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>"><?php echo substr(ucfirst($deals1->deal_title), 0, 100); ?></a>
																	</div>
																</div> 
															</li>
														<?php  $j++; } ?>                    
												</ul>
											</div>  
											 <?php }else{?>
											<div class="no_product_found"><?php echo $this->Lang['NO_AUCTION_SOLD_OUT'];?></div>
											<?php }?>                                    
										</div>
							  <?php   }   ?>
								</div>
							</div>
						
				</div>
			</div>  
			
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
