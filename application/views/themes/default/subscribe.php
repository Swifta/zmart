<script src="<?php echo PATH.'themes/'.THEME_NAME.'/js/jquery.validate.js' ?>"></script>

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
</script>

<script type="text/javascript">
    $(function() {
    		
        $('.sample33').mouseover(function() {
			var getUID =  $(this).attr('id').replace('sample33-','');
			var id_val = $('#sample33-'+getUID).attr('data-subcat');
			if(id_val==0)
			{
				$('#today_auction_sub_category_'+getUID).css('display','none');
				$('#categeory33-'+getUID).css('background','none');
			}
			else{
				//var getUID =  $(this).attr('id').replace('sample32-','');
				var url = Path+"auction/today_auction/?cate_id="+getUID+'&t=1';
				$.post(url,function(check){ 
					if(getUID!=""){
						$('#categeory33-'+getUID).html(check);
						$('#categeory33-'+getUID).show();
					}
				});
			}
			
		});		
            
    });  
</script>

<script>
$(document).ready(function(){

	$("#commentForm_deals_sub").validate({
	messages: {
		   	subscribe_email: {
			   required: "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>", 
			   email : "<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>"                             
		   },
    },
 submitHandler: function(form) {
   // some other code
   // maybe disabling submit button
   // then:
	
   form.submit();
 }
});

});
</script>



        <div class="contianer">

            <!--content start-->
            <div class="content">

                <!--sidebar start-->
                <div class="conntent_left">
                <?php if(!isset($this->is_soldout) && !isset($this->is_store)){ ?>
                    <div class="category_sidebar">                        
                            <h1 class="cate_title"><a href="<?php echo PATH; ?>shop-all-category.html" title="<?php echo $this->Lang['SHOP_AL']; ?>"><?php echo $this->Lang['SHOP_AL']; ?></a></h1>

                            <ul class="cate_menu">
                                <?php $cat = explode(",", substr($this->session->get('categoryID'), 0, -1));
                                $cat1 = array_unique($cat);
                                ?>

                                <?php foreach ($this->category_list as $d) {
										$check_sub_cat = common::get_subcat_count($d->category_id,3,"main",$d->category_url); /*   COUNT OF SUBCATEGORY   */
										$subcate_count = common::get_subcat_count1($d->category_id,$d->type);
										$subcat_style = ($subcate_count==0)?"background:none":"";
										$encode_catid = $d->category_id;		
													
									if ($d->product == 1 && isset($this->is_product) && ($check_sub_cat !=-1) && ($check_sub_cat !=0)) {
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
                                     <?php /*   <li <?php if ($this->category_id == $d->category_id) { ?> class="li_active" <?php } ?>>
                                            <span class="cate_check">
												<?php $type = "products";
													$categories = $d->category_url; ?>
											</span>

                                            <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" onclick="filtercategory('<?php echo $categories; ?>','<?php echo $type; ?>','<?php echo base64_encode("main"); ?>');" title="<?php echo $d->category_name; ?>"  class="sample_new cate_subarr" id="sample_new-<?php echo $encode_catid; ?>" title="<?php echo ucfirst($d->category_name); ?>">
												<?php echo ucfirst($d->category_name).' ('.$check_sub_cat.')'; ?>
                                            </a>
                                            <?php if($check_sub_cat > 0){ ?>
                                            <div class="cate_supmenu" id="today_product_sub_category_<?php echo $encode_catid; ?>">	                                                
                                                <ul id="categeory_new-<?php echo $encode_catid; ?>">
                                                </ul>
                                            </div>
                                            <?php } ?>
                                        </li>*/?>


								<?php } } ?>
                                        <?php foreach ($this->category_list as $d) {
												$check_sub_cat = common::get_subcat_count($d->category_id,2,"main",$d->category_url); 
												$subcate_count = common::get_subcat_count1($d->category_id,$d->type);
												$subcat_style = ($subcate_count==0)?"background:none":"";
												$encode_catid = $d->category_id;		
                                            if ($d->deal == 1 && isset($this->is_deals) && ($check_sub_cat !=-1)) {
                                                ?>
                                        <li <?php if ($this->category_id == $d->category_id) { ?> class="li_active" <?php } ?>>
                                            <span class="cate_check">
												<?php $type = "deal";
												$categories = $d->category_url; ?>
											</span>
                                                <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" class="sample23 <?php if($check_sub_cat > 0){ ?> cate_subarr <?php } ?>" id="sample23-<?php echo $encode_catid; ?>" onclick="filtercategory('<?php echo $categories; ?>','<?php echo $type; ?>','<?php echo base64_encode("main"); ?>');" title="<?php echo ucfirst($d->category_name); ?>">
													<?php echo ucfirst($d->category_name).' ('.$check_sub_cat.')'; ?>
                                                </a>
                                                <?php if($check_sub_cat > 0){ ?>
                                                <div class="cate_supmenu" id="today_deal_sub_category_<?php echo $encode_catid; ?>">	                                                    
                                                    <ul  id="categeory23-<?php echo $encode_catid; ?>">
                                                    </ul>
                                                </div>
                                                <?php } ?>
                                        </li>
                                        
									<?php }	} ?>
									
                                            <?php foreach ($this->category_list as $d) {
													$check_sub_cat = common::get_subcat_count($d->category_id,4,"main",$d->category_url); /*   COUNT OF SUBCATEGORY   */
													$subcate_count = common::get_subcat_count1($d->category_id,$d->type);
													$subcat_style = ($subcate_count==0)?"background:none":"";
													$encode_catid = $d->category_id;		
                                                   if ($d->auction == 1 && isset($this->is_auction) && ($check_sub_cat !=-1)) {
                                                    ?>
                                        <li <?php if ($this->category_id == $d->category_id) { ?> class="li_active" <?php } ?>>
                                            <span class="cate_check">
												<?php $type = "auction";
												$categories = $d->category_url; ?>
											</span>

                                                <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" class="sample33 <?php if($check_sub_cat > 0){ ?> cate_subarr <?php } ?>" id="sample33-<?php echo $encode_catid; ?>" onclick="filtercategory('<?php echo $categories; ?>','<?php echo $type; ?>','<?php echo base64_encode("main"); ?>');" title="<?php echo ucfirst($d->category_name); ?>">
													<?php echo ucfirst($d->category_name).' ('.$check_sub_cat.')'; ?>
                                                </a>
                                                <?php if($check_sub_cat > 0){ ?>
                                                <div class="cate_supmenu" id="today_auction_sub_category_<?php echo $encode_catid; ?>">	                                                    
                                                    <ul id="categeory33-<?php echo $encode_catid; ?>">
                                                    </ul>
                                                </div>
                                                <?php } ?>

                                        </li> 



							<?php }
						} ?>
                                <form>
						<?php foreach ($this->category_list as $d) {
	
	$check_sub_cat = common::get_subcat_count($d->category_id,1,"main",$d->category_url); /*   COUNT OF SUBCATEGORY   */
	$subcate_count = common::get_subcat_count1($d->category_id,$d->type);
	$subcat_style = ($subcate_count==0)?"background:none":"";
	$encode_catid = $d->category_id;		
													
    if ((!isset($this->is_deals)) && (!isset($this->is_product)) && (!isset($this->is_auction)) && ($check_sub_cat != -1)) { ?> 

                                            <li <?php if((isset($_GET['c']) && $_GET['c'] == base64_encode($d->category_id)) || (isset($_GET['m_c']) && $_GET['m_c'] == base64_encode($d->category_id) )) { ?> class="li_active" <?php } ?>>
        <?php $type = "";
        $categories = $d->category_url;
        ?>
                                                <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" class="sample_12 submit-link cate_subarr" id="sample-<?php echo $encode_catid; ?>"  title="<?php echo ucfirst($d->category_name); ?>">
        <?php echo ucfirst($d->category_name).' ('.$check_sub_cat.')'; ?>
                                                </a>
                                                <div class="cate_supmenu" id="sub_category_<?php echo $encode_catid; ?>">                                                    
                                                    <ul id="categeory1-<?php echo $encode_catid; ?>">
                                                    </ul>
                                                </div>
                                            </li>
                        <?php }
                    } ?>
                                    <input type="hidden" name="c" />
                                    <input type="hidden" name="c_t" />
                                    <input type="hidden" name="m_c">
                                    <p><input type="submit" style="display:none;"> </p>
                    <?php ?>
                                </form>

                            </ul>
                        
                    </div>
                    
                    
                    <?php } ?>
                    <?php if (isset($this->is_product)) { ?>
                        <?php /*
                          <div class="cat_outer2">
                          <div class="category">
                          <form action="" method="get" name="form1"  >
                          <h1>Apparel Men Size</h1>
                          <?php $cat = explode(",", substr($this->session->get('size'), 0, -1));
                          $cat1 = array_unique($cat);
                          ?>
                          <?php foreach ($this->size_list as $size) { ?>
                          <div class="apparel_size">
                          <div class="apparel_size_left">
                          <span><input  type="checkbox" name="size1[]" onclick="change_category1();" <?php foreach ($cat1 as $c) {
                          if ($size->size_id == $c) { ?> checked <?php }
                          } ?> value="<?php echo $size->size_id; ?>" /></span>
                          <?php /*         * <input type="checkbox" id="size" onclick="filter_size('<?php echo $size->size_id; ?>');" /> * */ ?> <?php /* <p><?php echo $size->size_name; ?></p>
                          </div>
                          </div>
                          <?php } ?>
                          <input type="submit" value="submit" id="submit_1" style="display:none;">
                          </form>
                          </div>
                          </div>
                         */ ?>                            

                        <?php /*
                          <div class="cat_outer3">

                          <div class="category">
                          <h1>Color</h1>
                          </div>
                          <div class="color_left23">
                          <div class="chose_color1">
                          <ul>

                          <?php  foreach ($this->color_list as $color) { ?>

                          <li>
                          <a  name="color"  class="<?php if($this->color_id==$color->color_id){ ?> active <?php } ?>"    onclick="filtercolor('<?php echo $color->color_id; ?>');" title="color1" >

                          <span class="choose_color_div" style="background:#<?php echo $color->color_name; ?>;"> </span>

                          </a>


                          </li>

                          <?php } ?>

                          </ul>

                          </div>

                          </div>









                          </div>
                         */ ?>       
<?php } ?>

                </div>
                <!--end-->

                <!--price and discount script-->

                <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
                <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
                <script>
		
                    $(function() {
                        $( "#slider-range" ).slider({


                            range: true,
                            <?php if (isset($this->pro_min)) { ?> min: <?php
    echo $this->pro_min;
?>, <?php } ?>
                         <?php if (isset($this->pro_max)) { ?>     max: <?php 
    echo $this->pro_max;
 ?>,<?php } ?>
                            values: [<?php if (isset($this->pro_min)) {
    echo $this->pro_min;
} ?>,<?php if (isset($this->pro_max)) {
    echo $this->pro_max;
} ?>  ],
                            slide: function( event, ui ) {

                                $( "#amount" ).val("<?php echo CURRENCY_SYMBOL; ?>"+ui.values[ 0 ] + " - " +"<?php echo CURRENCY_SYMBOL; ?>"+ ui.values[ 1 ] );
                                var amo=$( "#amount" ).val();
                                var url = Path+"products/ajax_post_products/?amount="+amo;
                                $.post(url,function(check){
                                    $('#product').html(check);
                                });
                            },
                        });
                        $( "#amount" ).val("<?php echo CURRENCY_SYMBOL; ?>" + $( "#slider-range" ).slider( "values", 0 ) +
                            " - " +"<?php echo CURRENCY_SYMBOL; ?>" + $( "#slider-range" ).slider( "values", 1 ) );
                    });
                </script>		 
                <!--price filter end-->
                <div class="subscribe_right">
                    <div class="content_deals_top">
                        <div class="subscribe_bg">
                            <div class="content_deals_midd">
                                   <span><?php echo $this->Lang["SUB_FOR"]; ?> <?php if (isset($this->is_deals)) {
                                        echo "deal";
                                    } elseif (isset($this->is_product)) {
                                        echo "product";
                                    } elseif (isset($this->is_auction)) {
                                        echo "auction";
                                    } else {
                                        echo "deal";
                                    } ?> <?php echo $this->Lang["NEWSLETTER"]; ?></span>                
                                <div class="cont_deal_city subscribe_frm">
                                    <form name="Subscribe" method="post" id="commentForm_deals_sub" action="<?php echo PATH; ?>users/subscribe_city">
                                        <div class="fullname">
                                            <input type="text" class="required email" name="subscribe_email" value="" placeholder="<?php echo $this->Lang['EMAIL_ADDR']; ?>" autofocus />
                                            <em style="padding-top:2px;"><?php if (isset($this->form_error['subscribe_email'])) {
                                        echo $this->form_error['subscribe_email'];
                                    } ?></em>
                                        </div>
                                        <div class="fullname">
                                        <select name="city_id" >
                                        <?php  foreach ($this->category_list as $d) { ?>
                                                 <option  value="<?php echo $d->category_id; ?>"><?php echo ucfirst($d->category_name); ?></option>
                                        <?php } ?>
                                            </select>

                                         <?php /*  <select name="city_id" >
        <?php foreach ($this->all_city_list as $city) { ?>
                                                    <option <?php if ($this->city_id == $city->city_id) {
                echo "selected='selected'";
            } ?>   value="<?php echo $city->city_id; ?>"><?php echo ucfirst($city->city_name); ?></option>
        <?php } ?>
                                            </select> */ ?>

                                        </div>

                                        <div class="deal_sub_button" >                                    
                                            <input class="sign_submit" type="submit" title="<?php echo $this->Lang['SUBS_NW']; ?>" value="<?php echo $this->Lang['SUBS_NW']; ?>" />
                                        </div>
                                    </form>
                                </div>

                                <div class="deal_already">
        <?php if (!$this->UserID) { ?>
                                        <a href="javascript:showlogin();" title="<?php echo $this->Lang['ALREADY_ACCESS2']; ?>"><?php echo $this->Lang['ALREADY_ACCESS2']; ?></a>
        <?php } ?>
                                    <p><?php echo $this->Lang['APP_BUSS']; ?></p>
                                </div>

                            </div>
                            <div class="deals_under_bg">
                                <p><?php echo $this->Lang['SORRY_CATE']; ?> <?php if (isset($this->is_deals)) {
        echo "deal";
    } elseif (isset($this->is_product)) {
        echo "product";
    } elseif (isset($this->is_auction)) {
        echo "auction";
    } else {
        echo "deal";
    } ?> <?php echo $this->Lang["TODAY"]; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end-->
        </div>
<script type="text/javascript">
    $(function() {    		
        $('.sample_new').mouseover(function() {
			var getUID =  $(this).attr('id').replace('sample_new-','');
			var id_val = $('#sample_new-'+getUID).attr('data-subcat');
			if(id_val==0)
			{
				$('#today_product_sub_category_'+getUID).css('display','none');
				$('#categeory_new-'+getUID).css('background','none');
			}
			else{
				//var getUID =  $(this).attr('id').replace('sample32-','');
				var url = Path+"products/all_products/?cate_id="+getUID+'&t='+1;
				$.post(url,function(check){
					if(getUID!=""){
						$('#categeory_new-'+getUID).html(check);
						$('#categeory_new-'+getUID).show();
					}
				});
			}			
		});
    });  
      

</script>
<script type="text/javascript">
    $(function() {    		
        $('.sample23').mouseover(function() {
			var getUID =  $(this).attr('id').replace('sample23-','');
			var id_val = $('#sample23-'+getUID).attr('data-subcat');
				if(id_val==0)
				{
					$('#today_deal_sub_category_'+getUID).css('display','none');
					$('#categeory23-'+getUID).css('background','none');
				}
				else{
					//var getUID =  $(this).attr('id').replace('sample32-','');
					var url = Path+"deals/today_deals/?cate_id="+getUID+'&t=1';
					$.post(url,function(check){
						if(getUID!=""){
							$('#categeory23-'+getUID).html(check);
							$('#categeory23-'+getUID).show();
						}
					});
				}			
		});		
    });    
</script>
