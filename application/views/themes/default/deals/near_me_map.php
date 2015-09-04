<head>
<script type="text/javascript" src="<?php echo PATH;?>js/timer/kk_countdown_1_2_jquery_min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

	$("body").kkCountDown({
	colorText:'#ED7E2C',
	colorTextDay:'#ED7E2C',
	addClass : 'shadow',
	dayText:"<?php echo $this->Lang['DAY_TEXT'];?>",
	daysText:"<?php echo $this->Lang['DAYS_TEXT'];?>"

	});

	$('.near_map_auto').live("click",function(){
		id = $(this).attr("id");
	    $.post('<?php echo PATH; ?>'+'nearmap.html?t='+id+"&page=1",{
			}, function(response){ 
				$(".near_me_map").html(response);                  
		}); 
	});
		
	});
</script>

</head>
<script>
$(".show_full_map").live('click',function(){
	$('#map_canvas').css({'width' : '1348px'});
	$('#near_lft_auction').css({'display':'none'});
	$('.click_fun').removeClass('show_full_map');
	$('.click_fun').addClass('hide_full_map');
	$('.arrow_css').removeClass('nm_mid_arrow');
	$('.arrow_css').addClass('nm_mid_arrow1');
	$('.near_me_mid_right').css({'overflow':'visible'});

});
$(".hide_full_map").live('click',function(){
	$('#map_canvas').css({'width' : '1348px'});
	$('#near_lft_auction').css({'display':'block'});
	$('.click_fun').removeClass('hide_full_map');
	$('.click_fun').addClass('show_full_map');
	$('.arrow_css').addClass('nm_mid_arrow');
	$('.arrow_css').removeClass('nm_mid_arrow1');
	$('.near_me_mid_right').css({'overflow':'hidden'});
location.reload();
});
</script>  

<script type="text/javascript">
    function getval(sel) {
      var value= sel.value;


window.location = "<?php echo PATH; ?>nearmap.html?type="+value;

    }
</script>
<div class="header_outer">
    <div class="header_top_inner">
        <div class="header">
                  <div class="bread_crumb">
                       
                    </div>

                </div>
            </div>
        </div>
        <!--end-->



        <div class="contianer_outer1">
            <div class="full_container_wrap">
                <div class="nm_mid">
                    <div class="near_me_map">
                        <div class="near_me_mid">
                            <div class="near_me_mid_left1" id="near_lft_auction">

								<?php /* t-type  */ ?>
                                <div class="rayality">
									<ul>
										<?php if($this->product_setting) { ?>
										  <li <?php if($this->type==2) { ?> class="acti5" <?php } ?> ><a class="near_map_auto" id="<?php echo base64_encode("2"); ?>" title=""><?php echo $this->Lang['PRODUCT']; ?></a></li>
											
										<?php } ?>
										<?php if($this->deal_setting) { ?>
											<li <?php if(($this->type==1)||($this->type=='')) { ?> class="acti5" <?php } ?> ><a class="near_map_auto" id="<?php echo base64_encode("1"); ?>" title=""><?php echo $this->Lang['DEALS']; ?></a></li>
											
										<?php } ?>
										<?php if($this->auction_setting) { ?>
											<li <?php if($this->type==3) { ?> class="acti5" <?php } ?> ><a class="near_map_auto" id="<?php echo base64_encode("3"); ?>" title=""><?php echo $this->Lang['AUCTION']; ?></a></li>
										 <?php } ?>

									  
									  
									</ul>
                                </div> 
								<div class="near_me_mid_left" > 
								<?php if(count($this->deals_list)==0){ ?>
								        <?php if (($this->type==1)||($this->type=='')) { ?>
								                <?php $error_mess = $this->Lang['NO_DEALS']; ?>
								        <?php } else if($this->type==2){?>
								                 <?php $error_mess = $this->Lang['NO_PRODUCTS']; ?>
								        <?php  } else { ?>
								                 <?php $error_mess = $this->Lang['NO_AUC_FOUND']; ?>
								        <?php  } ?>
								<?php } ?>
								
									<?php if(count($this->deals_list) > 0){ ?>
									<?php foreach($this->deals_list as $deals){ ?>
										<?php if (($this->type==1)||($this->type=='')) { ?>
											<?php 
												if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) { } else {
											$dealUrl = PATH.$deals->store_url_title."/deals/".$deals->deal_key."/".$deals->url_title.".html"; 
											if(file_exists(DOCROOT.'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png')){ 

												$imgpath = PATH.'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png';
												
												 }
											else{
													$imgpath = PATH.'themes/'.THEME_NAME.'/images/noimage_deals_list.png';
											} } ?>

										<?php } else if($this->type==2){?> 

											<?php 
											 $dealUrl = PATH.$deals->store_url_title."/product/".$deals->deal_key."/".$deals->url_title.".html";
											if(file_exists(DOCROOT.'images/products/1000_800/'.$deals->deal_key.'_1'.'.png')){ 

												$imgpath = PATH.'images/products/1000_800/'.$deals->deal_key.'_1'.'.png'; }
											else{
													$imgpath = PATH.'themes/'.THEME_NAME.'/images/noimage_deals_list.png';
											} ?>
										<?php  } else {?>
											<?php 
												 $dealUrl = PATH.$deals->store_url_title."/auction/".$deals->deal_key."/".$deals->url_title.".html";
											if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png')){ 
												$imgpath = PATH.'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png'; }

											else{
													$imgpath = PATH.'themes/'.THEME_NAME.'/images/noimage_deals_list.png';
											} ?>
											<?php 
											$dealUrl = PATH.$deals->store_url_title."/auction/".$deals->deal_key."/".$deals->url_title.".html";
											if(file_exists(DOCROOT.'images/category/icon/'.$deals->category_url.'.png')){ 

												$category_img = PATH.'images/category/icon/'.$deals->category_url.'.png'; }
											else{
													$category_img = PATH.'images/new/cate_icon.png';
											} ?>
											

										<?php }?>
									<?php if (($this->type==1)||($this->type=='')) { 
										if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) { } else {
										?>
									<div class="pro_listing_map">
										<div class="det_img1_1">
											<a href="<?php echo $dealUrl;?>" title="<?php echo $deals->deal_title; ?>">
											
<img src="<?php echo PATH.'resize.php';?>?src=<?php echo $imgpath; ?>&w=<?php echo MAP_LIST_WIDTH; ?>&h=<?php echo MAP_LIST_HEIGHT; ?>"  alt="<?php echo $this->Lang['DEAL_IMG']; ?>"/>
											</a>
										</div>
										<div class="deal_list_detail_map">
											<h2><a href="<?php echo $dealUrl;?>" title="<?php echo $deals->deal_title; ?>"><?php echo substr(ucfirst($deals->deal_title),0,25); ?></a></h2>
											<h3><a href="<?php echo $dealUrl;?>" title="<?php echo substr(ucfirst(strip_tags($deals->deal_description)),0,25); ?>"><?php echo substr(ucfirst(strip_tags($deals->deal_description)),0,25); ?></a></h3>
											<?php if(($this->type==1) ||($this->type=='') ){ ?>
											<p> <span class="usd1"><?php echo CURRENCY_SYMBOL.$deals->deal_price; ?></span></p>
                                             <p> <span class="usd3"><?php echo CURRENCY_SYMBOL.$deals->deal_value; ?></span></p>	
                                            <p><span class="price"><?php echo $this->Lang['STORE_NAME']; ?> :</span> <span class="usd"><?php echo $deals->store_name; ?></span></p>
											<?php } ?>
										</div>
									</div>  
									<?php } }  elseif (($this->type==2)||($this->type=='')) { 
										?>
									<div class="pro_listing_map">
										<div class="det_img1_1">
											<a href="<?php echo $dealUrl;?>">
													<img src="<?php echo PATH.'resize.php';?>?src=<?php echo $imgpath; ?>&w=<?php echo MAP_LIST_WIDTH; ?>&h=<?php echo MAP_LIST_HEIGHT; ?>"  alt="<?php echo $this->Lang['DEAL_IMG']; ?>"/>
											</a>
										</div>
										<div class="deal_list_detail_map">
											<h2><a href="<?php echo $dealUrl;?>" title="<?php echo $deals->deal_title; ?>"><?php echo substr(ucfirst($deals->deal_title),0,25); ?></a></h2>
											<h3><a href="<?php echo $dealUrl;?>" title="<?php echo substr(ucfirst(strip_tags($deals->deal_description)),0,25); ?>"><?php echo substr(ucfirst(strip_tags($deals->deal_description)),0,25); ?></a></h3>
											<?php if(($this->type==1) ||($this->type==2) ||($this->type=='') ){ ?>
											<p> <span class="usd1"><?php echo CURRENCY_SYMBOL.$deals->deal_price; ?></span></p>
                                             <p> <span class="usd3"><?php echo CURRENCY_SYMBOL.$deals->deal_value; ?></span></p>	
                                            <p><span class="price"><?php echo $this->Lang['STORE_NAME']; ?> :</span> <span class="usd"><?php echo $deals->store_name; ?></span></p>
											<?php } ?>
										</div>
									</div>  
									<?php } else { ?>
									<div class="auction_list_map1">
                                        <div class="action_img5">
                                           
                                            <div class="act_img_mid3">
                                               
                                               	<a href="<?php echo $dealUrl;?>" title="<?php echo $deals->deal_title; ?>">

													<img src="<?php echo PATH.'resize.php';?>?src=<?php echo $imgpath; ?>&w=<?php echo MAP_LIST_WIDTH; ?>&h=<?php echo MAP_LIST_HEIGHT; ?>"  alt="<?php echo $this->Lang['DEAL_IMG']; ?>"/>
												</a>
                                            </div>
                                          
                                        </div>
                                        <?php if($this->type==3) { ?>
                                        <div class="action_rgt_map5">
                                            <h2><a href="<?php echo $dealUrl;?>" title="<?php echo $deals->deal_title; ?>"><?php echo substr(ucfirst($deals->deal_title),0,25); ?></a></h2>
                                            <h3><a href="<?php echo $dealUrl;?>" title="<?php echo substr(ucfirst(strip_tags($deals->deal_description)),0,25);  ?>"><?php echo substr(ucfirst(strip_tags($deals->deal_description)),0,25);  ?></a></h3>
												<?php $q=0; foreach($this->all_payment_list as $payment){ ?>
												<?php if($payment->auction_id==$deals->deal_id){ 

														$firstname = $payment->firstname;
														$transaction_time = $payment->transaction_date;
														$q=1;
													}     } ?>
											 <?php if($q==1){ ?>
                                            <div class="bid_cont">
                                                <div class="bid_value_map">
                                                    <label><?php echo $this->Lang['LAST_BID']; ?> </label>
                                                    <b>:</b>
                                                    <p><?php echo ucfirst($firstname); ?></p>
                                                </div>
                                            </div>
                                            <div class="bid_cont">
                                                <div class="bid_value_map2">
                                                    <label><?php echo $this->Lang['BID_TIME']; ?> </label>
                                                    <b>:</b>
                                                    <p> <?php echo date("d-m-Y",$transaction_time); ?> <span></span></p>
                                                </div>
                                            </div>
                                            
											<?php } ?>
                                                                         <?php if($q==0){ ?>	
                                        <div class="bid_cont">
                                            <div class="bid_value_map">
                                                <label><?php echo $this->Lang['LAST_BID']; ?> </label>
                                                <b>:</b>
                                                    <p> <?php echo $this->Lang['NOT_YET_BID']; ?></p>
                                                </div>
                                            </div>
                                            <div class="bid_value_map2">
                                                    <label><?php echo $this->Lang['CLOSE_T']; ?> </label>
                                                    <b>:</b>
                                                    <p> <?php echo date("d-m-Y",$deals->enddate); ?> <span></span></p>
                                            </div>
                                            
                                        <?php } ?>
                                       <div class="bid_cont">
                                                <div class="bid_value_map">
                                                    <label><?php echo $this->Lang['STORE_NAME']; ?> </label>
                                                    <b>:</b>
                                                    <p><span><?php echo $deals->store_name; ?></span> </p>
                                                </div>
                                            </div>
                                        </div>
           
                                        
                                        <?php } ?>
                                    </div>  
								<?php }  ?>
								
							<?php } ?>
															
<?php } else { ?>

<p style="float:left; padding:20px; font-size:20px;"><b><?php echo $error_mess; ?></b></p>

<?php } ?>
			
								</div>
								
                                <div class="bottom_gread">
                                    
                                </div>
                            </div>
							<!--<div class="near_me_mid_arrow">
                                <div class="arrow_css nm_mid_arrow">
                                    <a class="click_fun show_full_map" style="cursor:pointer;" href="javascript:void(0)" onclick ="reSize()">&nbsp;</a>
                                </div>
                            </div>-->
                            
                             <div class="near_me_mid_right" id="map_load">
								<?php echo new View('themes/'.THEME_NAME.'/deals/map'); ?>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
        </div>

<script >
	function ajax_load_map(t)
	{
		if(t){
			  var url= '<?php echo PATH; ?>'+'welcome/ajax_load_map?t='+btoa(t);
						 $.post(url,function(check){alert(check);
					document.getElementById('map_load').innerHTML = check;
					//$('.top_po').html(str_name);
					//$("#map_outer_id").show();
		});
		}
	}
</script>
