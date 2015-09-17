<title> <?php echo SITENAME; ?> </title>
<?php
if (isset($this->is_product)) {
    $type = "products";
} else if (isset($this->is_auction)) {
    $type = "auction";
} else {
    $type = "deal";
}
/** For Front end language  start * */
$Directory = opendir(DOCROOT . "application/vendor/language/frontend_language");
$DL = array();
while (false !== ($dirname = readdir($Directory))) {
    if (strlen($dirname) > 2) {
        $ext = pathinfo($dirname, PATHINFO_EXTENSION);
        if ($ext == "php" || $ext == ".php" || $ext == "PHP") {
            $DL[] = $dirname;
        }
    }
}
sort($DL);
$this->language_List = str_replace(".php", "", $DL);

/** For Front end language  end * */
?>
<script>
    $(document).ready(function() {
        $('.submit-link2').click(function(e) {
            $('input[name="c"]').val($(this).attr('id').replace('sample123-', ''));
            $('input[name="c_t"]').val('<?php echo base64_encode("main"); ?>');
            e.preventDefault();
            $(this).closest('form').submit();
        });
    });
</script>
<!--[if IE]><script src="<?php echo PATH; ?>js/html5.js" type="text/javascript"></script><![endif]-->
<?php if (($this->uri->last_segment() == "near-map.html") || ($this->uri->last_segment() == "nearmap.html")) { } else { ?>
<!--header start-->
<!--header start-->
<header>
<div id="header">
<div class="first_header">
<div class="header_inner">
<div class="header_top_left">  
    <a class="toggleMenu1 htop_navicon1" href="javascript:;" title="Menu">&nbsp;</a>
 <?php if(isset($this->merchant_cms)){if(count($this->merchant_cms)>0) {  if(($this->merchant_cms->current()->warranty_status ==1) || ($this->merchant_cms->current()->return_policy_status ==1) || ($this->merchant_cms->current()->terms_conditions_status ==1)) { ?>
                                            <ul class="htop_nav1">
												<?php if($this->merchant_cms->current()->warranty_status ==1) { ?>
												<li><a href="<?php echo PATH.$this->storeurl.'/merchant-cms/'.base64_encode($this->merchant_cms->current()->merchant_id).'/warranty.html'; ?>"><?php echo $this->Lang["WARRANTY"]; ?></a></li>
                                                
                                                                                                <li class="mnav_dnone">|</li>
                                                <?php } ?>
						 <?php if($this->merchant_cms->current()->return_policy_status ==1) { ?>
                                                <li><a href="<?php echo PATH.$this->storeurl.'/merchant-cms/'.base64_encode($this->merchant_cms->current()->merchant_id).'/return_policy.html'; ?>" title=" <?php echo $this->Lang["RET_POLICY"]; ?>"> <?php echo $this->Lang["RET_POLICY"]; ?></a></li>
                                                <li class="mnav_dnone">|</li>
                                                <?php } ?>
						 <?php if($this->merchant_cms->current()->terms_conditions_status ==1) { ?>
                                                <li><a href="<?php echo PATH.$this->storeurl.'/merchant-cms/'.base64_encode($this->merchant_cms->current()->merchant_id).'/shipping.html'; ?>" title="<?php echo $this->Lang["SHIP_ING"]; ?>"><?php echo $this->Lang["SHIP_ING"]; ?></a></li>
                                                <li class="mnav_dnone">|</li>      
                                                <?php } ?>                                          
                                            </ul>	
                          <?php } }} ?>  
</div>
<div class="header_top_middle">
    <div class="refer_friend">
    <a  href="<?php echo PATH ?>refer-friends.html" title="<?php echo $this->Lang['REFER_FRIENDS'] . ' ' . CURRENCY_SYMBOL . '' . REFERRAL_AMOUNT . '*'; ?>">
            <?php echo $this->Lang['REFER_FRIENDS'] . ' ' . CURRENCY_SYMBOL . ' ' . REFERRAL_AMOUNT . '*'; ?></a>
    </div>
</div>


<?php  if($this->session->get('user_auto_key')) { ?>
<div  class="store_credit"> <a href="<?php echo PATH; ?>storecredits-products.html"> <?php echo $this->Lang["STR_CRDS"]; ?></a></div>
<?php } ?>
<div class="header_top_right">
    <a class="toggleMenu htop_navicon" href="javascript:;" title="Menu">&nbsp;</a>
<ul class="htop_nav">
<?php /* <li class="header_language">                                                                
<a class="select_lang <?php echo ucfirst(LANGUAGE); ?>" title="<?php echo ucfirst(LANGUAGE); ?>" alt="<?php echo ucfirst(LANGUAGE); ?>" ><?php echo ucfirst(LANGUAGE); ?><span class="lang_arrow">&nbsp;</span></a>
                <ul class="header_top_sup_menu">    <?php foreach ($this->language_List as $lan) {
if ($lan != LANGUAGE) {
                ?>
                                        <li><a class="<?php echo $lan; ?>" title="<?php echo ucfirst($lan); ?>" alt="<?php echo $lan; ?>" onclick="changelang('<?php echo $lan; ?>');">
                                                <?php echo ucfirst($lan); ?></a>  </li>   <?php }
        }
        ?>
 </ul>
</li> */ ?>
<li><a href="<?php echo PATH;?>">Home</a></li>
<li class="mnav_dnone">|</li>
<?php if ($this->session->get('UserID')) { ?>
	<li class="wel_txt"><span><?php echo $this->Lang['WELCOME']; ?> </span> <a href="<?php echo PATH; ?>users/my-account.html" title="<?php echo $this->session->get('UserName'); if($this->session->get('user_auto_key')) { echo "(".$this->session->get('user_auto_key').")"; } ?>"><b class="wel_usr"><?php echo $this->session->get('UserName');  if($this->session->get('user_auto_key')) { echo "(".$this->session->get('user_auto_key').")"; } ?></b></a></li>                                                                
	<li class="mnav_dnone">|</li>
	<li><a href="<?php echo PATH; ?>users/my-account.html" title="<?php echo $this->Lang['MY_ACC']; ?>"><?php echo $this->Lang['MY_ACC']; ?></a> </li>
	<li class="mnav_dnone">|</li>

<?php if(isset($this->is_home) || isset($this->is_product) ) { ?>
        
	
	<?php /*<li  <?php $compare = $this->session->get("product_compare"); if(is_array($compare) && count($compare)>1){  ?> class="compare_show" <?php } else { ?> class="compare_add" <?php } ?>>  <a href="<?php echo PATH; ?>product-compare.html" title="<?php echo $this->Lang['MY_COMP']; ?>"><?php echo $this->Lang['MY_COMP']; ?></a></li>
									
	<li <?php $compare = $this->session->get("product_compare"); if(is_array($compare) && count($compare)>1){  ?> class="mnav_dnone compare_show" <?php } else { ?> class="mnav_dnone compare_add" <?php } ?>>|</li> */ ?>
	<li  class="addcomper" >
	<?php $compare = $this->session->get("product_compare"); 
	if(is_array($compare) && count($compare)>1){  ?>
	<a href="<?php echo PATH; ?>product-compare.html" title="<?php echo $this->Lang['MY_COMP']; ?>"><?php echo $this->Lang['MY_COMP']; ?></a><?php } ?></li>								
	<li class="mnav_dnone"> <?php $compare = $this->session->get("product_compare"); 
	if(is_array($compare) && count($compare)>1){  ?> | <?php } ?></li> 
	
	
<?php } ?>
        <li><a href="<?php echo PATH; ?>wishlist.html" title="<?php echo $this->Lang['MY_WISH']; ?>"><?php echo $this->Lang['MY_WISH']; ?></a> </li>
	<li class="mnav_dnone">|</li>
	<li><a href="<?php echo PATH; ?>logout.html" title="<?php echo $this->Lang['LOGOUT']; ?>"><?php echo $this->Lang['LOGOUT']; ?></a> </li>
<?php } else { ?>

<?php if(isset($this->is_home) || isset($this->is_product) ) { ?>
	<?php /*<li  <?php $compare = $this->session->get("product_compare"); if(is_array($compare) && count($compare)>1){  ?> class="compare_show" <?php } else { ?> class="compare_add" <?php } ?>>  <a href="<?php echo PATH; ?>product-compare.html" title="<?php echo $this->Lang['MY_COMP']; ?>"><?php echo $this->Lang['MY_COMP']; ?></a></li>
									
	<li <?php $compare = $this->session->get("product_compare"); if(is_array($compare) && count($compare)>1){  ?> class="mnav_dnone compare_show" <?php } else { ?> class="mnav_dnone compare_add" <?php } ?>>|</li> */ ?>
	
	<li  class="addcomper" >
	<?php $compare = $this->session->get("product_compare"); 
	if(is_array($compare) && count($compare)>1){  ?>
	<a href="<?php echo PATH; ?>product-compare.html" title="<?php echo $this->Lang['MY_COMP']; ?>"><?php echo $this->Lang['MY_COMP']; ?></a><?php } ?></li>								
	<li class="mnav_dnone"> <?php $compare = $this->session->get("product_compare"); 
	if(is_array($compare) && count($compare)>1){  ?> | <?php } ?></li> 
	
<?php } ?>

	<li><a id="login" href="javascript:showlogin();" title="<?php echo $this->Lang['LOGIN']; ?>"><?php echo $this->Lang['LOGIN']; ?></a></li>
	<li class="mnav_dnone">|</li>
	<li><a href="javascript:showsignup();" title="<?php echo $this->Lang['SIGN_UP']; ?>"><?php echo $this->Lang['SIGN_UP']; ?></a> </li>
        <li class="head_fb"><a style="cursor:pointer;" onclick="facebookconnect();" title="<?php echo $this->Lang['FB_CONN']; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/f_connect.png" alt="f_connect"/></a></li>	
<?php } ?>
<?php if (FB_PAGE) { ?>
<!-- <li><a class="faceb" href="<?php echo FB_PAGE; ?>" target="blank" title="<?php echo $this->Lang['FB']; ?>">&nbsp;</a></li>-->
<?php }if (TWITTER_PAGE) { ?>
<!-- <li><a class="twitt" href="<?php echo TWITTER_PAGE; ?>" target="blank" title="<?php echo $this->Lang['TW']; ?>">&nbsp;</a></li>-->
<?php }if (LINKEDIN_PAGE) { ?>
<!--  <li><a class="linked" href="<?php echo LINKEDIN_PAGE; ?>" target="blank" title="<?php echo $this->Lang['LINK']; ?>">&nbsp;</a></li>-->
<?php } if ($this->city_id) { ?>
	<?php
	/*foreach ($this->all_city_list as $CX) {
		if ($this->city_id == $CX->city_id) {  ?>
			<!-- <li><a class="rss" href="<?php echo PATH . 'deals/rss/' . $this->city_id . '/' . $CX->city_url; ?>" target="blank" title="">&nbsp;</a></li>-->
                        <?php if (!$this->session->get('UserID')) { ?>
                        <li><a  style="cursor:pointer;" onclick="facebookconnect();" title="<?php echo $this->Lang['FB_CONN']; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/f_connect.png" alt="f_connect"/></a></li>
                        <?php } ?>
			<?php
		}
	} */
}  ?>
<?php /* <li><a class="google" href="<?php echo LINKEDIN_PAGE; ?>" target="blank" title="google">&nbsp;</a></li> */ ?>                                
</ul>
</div>
</div>
</div>
<div class="middle_header">
<div class="header_inner">
<div class="logo">
<h1>
	<?php if(count($this->about_us_footer)>0) { foreach($this->about_us_footer as $stores) { ?>
 <a href="<?php echo PATH.$stores->store_url_title.'/';?>"  title = "<?php echo $stores->store_name; ?>">
	<img alt="<?php echo $this->Lang['LOGO']; ?>" 	src="<?php echo PATH .'images/merchant/290_215/'.$stores->merchant_id.'_'.$stores->store_id.'.png'?>"/>

<?php /* <img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/logo.png"/> */ ?></a>
  <?php } } ?>
</h1>
</div>
<?php /*<div class="select_citys_common">
<ul>
<li>
<div class="city_cat">
<?php if (CITY_SETTING) { ?>
<ul>
<li>
<?php $city_name = "";
foreach ($this->all_city_list as $c) {
        if ($c->city_id == $this->session->get('CityID')) {
                $city_name = $c->city_name;
        }
} ?>
<a style="cursor:pointer;" title="<?php echo ucfirst($city_name); ?>"><?php echo ucfirst($city_name); ?></a>
<div class="drop_down1">
<ul>
<?php foreach ($this->all_city_list as $city) { ?>
	<li>
		<a style="cursor:pointer;" onclick="return changecity('<?php echo $city->city_id; ?>', '<?php echo $city->city_url; ?>');" title="<?php echo ucfirst($city->city_name); ?>" ><?php echo $city->city_name; ?>  </a>
	</li>
<?php } ?>
</ul>
</div>
</li>
			</ul>
		<?php
		} else {

		}
		?>
	</div>

</li>
</ul>
<input type="hidden" name="d_id" id="cat" value="" />

</div> */ ?>
<div class="msearch_cart_block">
<div class="search_new_common">
<div class="common_search">
<?php
$ajax_type = 0;
$srch = $this->Lang['SEARCH'];

if (isset($this->is_product)) {
$ajax_type = 1; // userd in auto suggestion search
$srch = $this->Lang['SRCH_PRD'];
?>
<form id="myform" action="<?php echo PATH.$this->storeurl; ?>/products.html">
<?php
}else if (isset($this->is_deals)) {
$ajax_type = 2; // userd in auto suggestion search
$srch = $this->Lang['SRCH_DEAL'];
?>
<form id="myform" action="<?php echo PATH.$this->storeurl; ?>/today-deals.html">
	<?php
} else if (isset($this->is_auction)) {
	$ajax_type = 3; // userd in auto suggestion search
	$srch = $this->Lang['SRCH_AUC'];
	?>
	<form id="myform" action="<?php echo PATH.$this->storeurl; ?>/auction.html">
		<?php
	} elseif (isset($this->is_store_details)) {
$ajax_type = 5; // userd in auto suggestion search
$srch = $this->Lang['SRCH_STR_DET'];
?>
<form id="myform" action="<?php echo PATH.$this->storeurl; ?>/products.html">
<?php
} elseif (isset($this->is_store)) {
$ajax_type = 4; // userd in auto suggestion search
$srch = $this->Lang['SRCH_STR'];
?>
<form id="myform" action="<?php echo PATH.$this->storeurl; ?>/products.html">
<?php
}  else {
		$srch = $this->Lang['SRCH_PRD'];
	?>
<form id="myform" action="<?php echo PATH.$this->storeurl; ?>/products.html">

<?php } ?>
    <div class="cities">
		<ul>
	        <li>
                <?php
                $catid = 0;
                $cat_name = $this->Lang['AL_CAT'];
                foreach ($this->category_list as $d) {
                        if ($d->category_id == $this->input->get('d_id')) {
                                $cat_name = $d->category_name;
                                $catid = $d->category_id;
                        }
                }
                ?>
                <a data-caty="<?php echo $catid; ?>" id="search_cat" style="cursor:pointer;" title="<?php echo ucfirst($cat_name); ?>"><?php echo ucfirst($cat_name); ?></a>

                <div class="drop_down">
                <ul>
                <?php
                foreach ($this->category_list as $d) {
                $cat = ($type == "products") ? 'product' : (($type == "auction") ? 'auction' : 'deal');
                ?>
                <li><a onclick="ChangeCategory('<?php echo $d->category_name; ?>', '<?php echo $d->category_id; ?>')" style="cursor:pointer;" title="<?php echo ucfirst($d->category_name); ?>" ><b><?php echo ucfirst($d->category_name); ?></b></a>
                </li>
                <?php } ?>
                </ul>
                </div>
	        </li>
        </ul>
        <input type="hidden" name="d_id" id="cat" value="" />
        </div>
    
<div class="text_box_header">
<?php $search = $this->input->get('q'); ?>
<input type="text" size="12"  name="q" class="search_tbox textbg" onkeyup="lookup(this.value);" <?php if (isset($search) && ($search != '')) { ?> value="<?php echo $search; ?>" <?php } else { ?>  AUTOCOMPLETE="OFF" placeholder="<?php echo $srch; ?> ..." <?php } ?> />
   <div id="suggestions" class="search_suggestions"></div>		
</div>
		
     
        <div class="sub"><input type="submit" value="" title="<?php echo $this->Lang['SEARCH']; ?>" /></div>
        </form>
        </div>
        </div>
         <div class="merchant_log">
			<p><?php echo $this->Lang['MERCHANT_ACC']; ?></p>
			<ul>
				<li><a  href="<?php echo PATH . 'merchant-login.html'; ?>" title="<?php  echo $this->Lang['MER_LOIN']; ?>"><?php echo $this->Lang['MER_LOIN']; ?></a></li>
				<li>|</li>
				<li><a  href="<?php echo PATH . 'merchant-signup-step1.html'; ?>" title="<?php  echo $this->Lang['MER_REGI']; ?>"><?php echo $this->Lang['MER_REGI']; ?></a></li>
			</ul>
		
		</div>
        <?php if ($this->product_setting) { ?>
        <div class="add_cart">
        <div class="cart_mid" id="cart_window">
	        <a href="<?php echo PATH; ?>cart.html"  title="<?php echo $this->Lang['CART']; ?>(<?php
	        if ($this->session->get('count') != '') {
		        echo $this->session->get('count');
	        } else {
		        echo '0';
	        }
                ?>)"> <span><?php
		           if ($this->session->get('count') != "") {
			           echo $this->session->get('count');
		           } else {
			           echo "0";
		           }
		           ?></span><?php echo $this->Lang['CART']; ?>(s)</a>
            <div class="cart_window_products1" style="display:none"></div>
        </div>
        </div>
        
        <?php } ?>
        </div>
        </div>
        </div>
        <div class="bottom_header">
        <div class="header_inner">                                                                                               
                        <?php if(isset($this->is_home)||isset($this->is_product)||isset($this->is_todaydeals)||isset($this->is_auction)){ ?>
                        <?php if(isset($this->is_details)){ ?>
                        <ul class="head_menu head_menu1 bold" >
                        <?php } else { ?>
                        
		        <ul class="head_menu bold" >
		        <?php } } else { ?>
		        <ul class="head_menu head_menu1 bold" >
		        <?php } ?>
                            
			        <li <?php
				        if (isset($this->is_home)) {
					        echo "class='active'";
				        }
				        ?>>

				        <a class="hmenu" href="<?php echo PATH.$this->storeurl; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?>
				        </a>
                                   <?php /* <div class="sub_cate_list_show">
                            <div class="sub_cate_list_show_inner">  
								<?php if($this->categeory_list_product){  
									foreach ($this->categeory_list_product as $d) {
										$check_sub_cat = $d->product_count;
										if(($check_sub_cat !=-1 )&&($check_sub_cat !=0)) { ?>
											<div class="sub_list_shw">
												<h2><?php echo ucfirst($d->category_name); ?></h2>
												<ul>
													<?php if(count($this->subcategories_list)>0){
														$hdn_second_cnt = 1;
														foreach($this->subcategories_list as $sub_cate){
															if($sub_cate->main_category_id == $d->category_id){
																if($hdn_second_cnt<5){?>
																<li><a href="javascript:filtercategory('<?php echo $sub_cate->category_url; ?>', 'products', '<?php echo base64_encode("sub"); ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo ucfirst($sub_cate->category_name);?></a></li> 
													<?php $hdn_second_cnt++;}
													if($hdn_second_cnt==5){?>
													<li class="cate_view_more"><a href="javascript:filtercategory('<?php echo $d->category_url; ?>', 'products', '<?php echo base64_encode("main"); ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo $this->Lang['VIW_MRE'];?></a></li> 
													<?php break;}
													}
													
													}
													}?>
												</ul>
												<div class="sub_list_ad_part">
													<?php if(file_exists(DOCROOT.'images/category/icon/'.$d->category_url.'.png')){ ?>
													   <img alt="" src="<?php echo PATH.'images/category/icon/'.$d->category_url.'.png'; ?>"/><?php }?>
												</div>
											</div>
									<?php }}}?>
                            </div>  
                        </div>*/?>
			        </li>

        <?php if ($this->product_setting) { ?>

        <li class="<?php if (isset($this->is_product)) echo "active"; ?>"> <a class="hmenu" href="<?php echo PATH.$this->storeurl; ?>/products.html" title="<?php echo $this->Lang['PRODUCTS']; ?>"><?php echo $this->Lang['PRODUCTS']; ?>

        </a>
        <?php $pr = 0; $pro = 0; $val_pro ="";
        foreach ($this->categeory_list_product as $d) {
		        //$check_sub_cat = common::get_subcat_count($d->category_id, 3, "main", $d->category_url); /*   COUNT OF SUBCATEGORY   */
		        //$val_pro .= $check_sub_cat.","; 
		        $check_sub_cat = $d->product_count;
		        if($check_sub_cat != 0){
		        $pro = $pr + 1;
		        $pr ++;
		        } }
		        $arr_product = explode(",", substr($val_pro,0,-1));
        ?>
        <div class="sub_cate_list_show">
			<div class="sub_cate_list_show_inner">  
				<?php if($this->categeory_list_product){  
					foreach ($this->categeory_list_product as $d) {
						$check_sub_cat = $d->product_count;
						if(($check_sub_cat !=-1 )&&($check_sub_cat !=0)) { ?>
							<div class="sub_list_shw">
								<h2><?php echo ucfirst($d->category_name); ?></h2>
								<ul>
									<?php if(count($this->subcategories_list)>0){
										$hdn_second_cnt = 1;
										foreach($this->subcategories_list as $sub_cate){
											if($sub_cate->main_category_id == $d->category_id){
												if($hdn_second_cnt<5){?>
												<li><a href="javascript:filtercategory_store('<?php echo $sub_cate->category_url; ?>', 'products', '<?php echo base64_encode("sub"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo ucfirst($sub_cate->category_name);?></a></li> 
									<?php $hdn_second_cnt++;}
									if($hdn_second_cnt==5){?>
									<li class="cate_view_more"><a href="javascript:filtercategory_store('<?php echo $d->category_url; ?>', 'products', '<?php echo base64_encode("main"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo $this->Lang['VIW_MRE'];?></a></li> 
									<?php break;}
									}
									
									}
									}?>
								</ul>
								<div class="sub_list_ad_part">
									<?php if(file_exists(DOCROOT.'images/category/icon/'.$d->category_url.'.png')){ ?>
									   <img alt="" src="<?php echo PATH.'images/category/icon/'.$d->category_url.'.png'; ?>"/><?php }?>
								</div>
							</div>
					<?php }}}?>
			</div>  
		</div>
        
        
       <?php /* <i class="hover_icon">&nbsp;</i>
        <div class="cate_menu head_cate_menu">
	        <?php if($pro != 0 ){ ?>
	        <b><?php echo $this->Lang['SHOP_BY_CATE']; ?></b>
	        <?php } ?> 
	        <ul>
		        <?php $count = 0;
		        foreach ($this->categeory_list_product as $d) {
		                $check_sub_cat = $d->product_count;
		                //$check_sub_cat = $arr_product[$count];
			        //$check_sub_cat = common::get_subcat_count($d->category_id, 3, "main", $d->category_url); //   COUNT OF SUBCATEGORY   
			        //$subcate_count = common::get_subcat_count1($d->category_id,$d->type);
			        $subcate_count = 1;
			        $subcat_style = ($subcate_count==0)?"background:none":"";
			        $encode_catid = $d->category_id;

			        if ($d->product == 1 && ($check_sub_cat != -1) && ($check_sub_cat != 0)) {
				        ?>
				        <li>
					        <?php
					        $type = "products";
					        $categories = $d->category_url;
					        ?>
					        <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" href="javascript:filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" class="sample32 cate_subarr" id="sample32-<?php echo $encode_catid; ?>" title="<?php echo ucfirst($d->category_name); ?>">
	        <?php echo ucfirst($d->category_name) . ' (' . $check_sub_cat . ')'; ?>
					        </a>
					        <div class="cate_supmenu" id="product_sub_category_<?php echo $encode_catid; ?>">                                                                                                                                                                                                    
                                                    <ul id="categeory32-<?php echo $encode_catid; ?>">
                                                    </ul>
					        </div>
				        </li>
				        <?php
			        }
			        $count++;
		        }
		        if($pro == 0){ ?>
	        <li>
	        <b><?php echo $this->Lang['NO_PRODUCTS']; ?></b>
	        </li>
	        <?php } ?>

	        </ul>
        </div> */?>
         </li>



        <?php } ?>

        <?php if ($this->deal_setting) { ?>
        <li class="<?php if (isset($this->is_todaydeals)) echo "active"; ?> "><a class="hmenu" href="<?php echo PATH.$this->storeurl; ?>/today-deals.html" title="<?php echo $this->Lang['DEALS']; ?>">
	        <?php echo $this->Lang['DEALS']; ?>
        </a>
        <?php $de = 0; $dea = 0;  $val_de ="";
        foreach ($this->categeory_list_deal as $d) {
		        //$check_sub_cat = common::get_subcat_count($d->category_id, 2, "main", $d->category_url); /*   COUNT OF SUBCATEGORY   */
		        $check_sub_cat = $d->deal_count;
		        $val_de .= $check_sub_cat.","; 
		        if($check_sub_cat != 0){
		        $dea = $de + 1;
		        $de ++;
		        } }
		        $arr_deal = explode(",", substr($val_de,0,-1));
        ?>
        <div class="sub_cate_list_show">
			<div class="sub_cate_list_show_inner">  
				<?php if($this->categeory_list_deal){  
					foreach ($this->categeory_list_deal as $d) {
						$check_sub_cat = $d->deal_count;
						if(($check_sub_cat !=-1 )&&($check_sub_cat !=0)) { ?>
							<div class="sub_list_shw">
								<h2><?php echo ucfirst($d->category_name); ?></h2>
								<ul>
									<?php if(count($this->subcategories_list)>0){
										$hdn_second_cnt = 1;
										foreach($this->subcategories_list as $sub_cate){
											if($sub_cate->main_category_id == $d->category_id){
												if($hdn_second_cnt<5){?>
												<li><a href="javascript:filtercategory_store('<?php echo $sub_cate->category_url; ?>', 'deal', '<?php echo base64_encode("sub"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo ucfirst($sub_cate->category_name);?></a></li> 
									<?php $hdn_second_cnt++;}
									if($hdn_second_cnt==5){?>
									<li class="cate_view_more"><a href="javascript:filtercategory_store('<?php echo $d->category_url; ?>', 'deal', '<?php echo base64_encode("main"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo $this->Lang['VIW_MRE'];?></a></li> 
									<?php break;}
									}
									
									}
									}?>
								</ul>
								<div class="sub_list_ad_part">
									<?php if(file_exists(DOCROOT.'images/category/icon/'.$d->category_url.'.png')){ ?>
									   <img alt="" src="<?php echo PATH.'images/category/icon/'.$d->category_url.'.png'; ?>"/><?php }?>
								</div>
							</div>
					<?php }}}?>
			</div>  
		</div>
       <?php /* <i class="hover_icon">&nbsp;</i>
        <div class="cate_menu head_cate_menu">
        <?php if($dea != 0 ){ ?>
	        <b><?php echo $this->Lang['SHOP_BY_CATE']; ?></b>
	        <?php } ?> 
	        <ul>

		        <?php $count = 0;
		        foreach ($this->categeory_list_deal as $d) {
			        //$check_sub_cat = common::get_subcat_count($d->category_id, 2, "main", $d->category_url); //  COUNT OF SUBCATEGORY  
			        //$subcate_count = common::get_subcat_count1($d->category_id,$d->type);
			        //$check_sub_cat = $arr_deal[$count];
			        $check_sub_cat = $d->deal_count;
			        $subcate_count = 1;
			        $subcat_style = ($subcate_count==0)?"background:none":"";
			        $encode_catid = $d->category_id;
			        if ($d->deal == 1 && $check_sub_cat != -1 && ($check_sub_cat != 0)) {
				        ?>
				        <li>
					        <?php
					        $type = "deal";
					        $categories = $d->category_url;
					        ?>
					        <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" class="sample324 cate_subarr" id="sample324-<?php echo $encode_catid; ?>" title="<?php echo ucfirst($d->category_name); ?>" href="javascript:filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" >

        <?php echo ucfirst($d->category_name) . ' (' . $check_sub_cat . ')'; ?>
					        </a>
					        <div class="cate_supmenu" id="deal_sub_category_<?php echo $encode_catid; ?>">                                                                                                                                                                                                    
						        <ul id="categeory324-<?php echo $encode_catid; ?>">
						        </ul>
					        </div>
				        </li>
				        <?php
			        }
			        $count ++;
		        } 
		
		        if($dea == 0){ ?>
	        <li>
	        <b><?php echo $this->Lang['NO_DEALS']; ?></b>
	        </li>
	        <?php } ?>
		

	        </ul>
        </div> */?>
        
        
        </li>


        <?php } ?>

        <?php if ($this->auction_setting) { ?>
        <li class="<?php if (isset($this->is_auction)) echo "active"; ?>"><a class="hmenu" href="<?php echo PATH.$this->storeurl; ?>/auction.html" title="<?php echo $this->Lang['AUCTION']; ?>">
        <?php echo $this->Lang['AUCTION']; ?>

        </a>
        <?php $au = 0; $aut = 0; $val = "";
        foreach ($this->categeory_list_auction as $d) {
        //$check_sub_cat = common::get_subcat_count($d->category_id, 4, "main", $d->category_url); /*   COUNT OF SUBCATEGORY   */
        $check_sub_cat = $d->auction_count;
        $val .= $check_sub_cat.","; 
        if($check_sub_cat != 0){
        $aut = $au + 1;
        $au ++;
        } }
        $arr_auction = explode(",", substr($val,0,-1));
        ?>
        <div class="sub_cate_list_show">
			<div class="sub_cate_list_show_inner">  
				<?php if($this->categeory_list_auction){  
					foreach ($this->categeory_list_auction as $d) {
						$check_sub_cat = $d->auction_count;
						if(($check_sub_cat !=-1 )&&($check_sub_cat !=0)) { ?>
							<div class="sub_list_shw">
								<h2><?php echo ucfirst($d->category_name); ?></h2>
								<ul>
									<?php if(count($this->subcategories_list)>0){
										$hdn_second_cnt = 1;
										foreach($this->subcategories_list as $sub_cate){
											if($sub_cate->main_category_id == $d->category_id){
												if($hdn_second_cnt<5){?>
												<li><a href="javascript:filtercategory_store('<?php echo $sub_cate->category_url; ?>', 'auction', '<?php echo base64_encode("sub"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo ucfirst($sub_cate->category_name);?></a></li> 
									<?php $hdn_second_cnt++;}
									if($hdn_second_cnt==5){?>
									<li class="cate_view_more"><a href="javascript:filtercategory_store('<?php echo $d->category_url; ?>', 'auction', '<?php echo base64_encode("main"); ?>','<?php echo $this->storeurl; ?>');" title="<?php echo ucfirst($sub_cate->category_name);?>"><?php echo $this->Lang['VIW_MRE'];?></a></li> 
									<?php break;}
									}
									
									}
									}?>
								</ul>
								<div class="sub_list_ad_part">
									<?php if(file_exists(DOCROOT.'images/category/icon/'.$d->category_url.'.png')){ ?>
									   <img alt="" src="<?php echo PATH.'images/category/icon/'.$d->category_url.'.png'; ?>"/><?php }?>
								</div>
							</div>
					<?php }}}?>
			</div>  
		</div>
        <?php /*<i class="hover_icon">&nbsp;</i>
        <div class="cate_menu head_cate_menu">
        <?php if($aut != 0 ){ ?>
        <b><?php echo $this->Lang['SHOP_BY_CATE']; ?></b>
        <?php } ?>
        <ul>
	        <?php $count = 0;
	        foreach ($this->categeory_list_auction as $d) {
		        //$check_sub_cat = common::get_subcat_count($d->category_id, 4, "main", $d->category_url); //   COUNT OF SUBCATEGORY  
		        //$subcate_count = common::get_subcat_count1($d->category_id,$d->type);
		        //$check_sub_cat = $arr_auction[$count];
		        $check_sub_cat = $d->auction_count;
		        $subcate_count = 1;
		        $subcat_style = ($subcate_count==0)?"background:none":"";
		        $encode_catid = $d->category_id;
		        if ($d->auction == 1 || $check_sub_cat != -1 && ($check_sub_cat != 0)) { ?>
			        <?php if($check_sub_cat > 0){ ?>
			        <li>
				        <?php
				        $type = "auction";
				        $categories = $d->category_url;
				        ?>
				        <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" class="sample325 cate_subarr" id="sample325-<?php echo $encode_catid; ?>" title="<?php echo ucfirst($d->category_name); ?>" href="javascript:filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');">
					        <?php echo ucfirst($d->category_name) . ' (' . $check_sub_cat . ')'; ?>
				        </a>
        <div class="cate_supmenu" id="auction_sub_category_<?php echo $encode_catid; ?>">
					        <ul id="categeory325-<?php echo $encode_catid; ?>">
					        </ul>
				        </div>
			        </li>
			        <?php } 
			
			         }
			         $count ++;
	        }
	
	        if($aut == 0){ ?>
	        <li>
	        <b><?php echo $this->Lang['NO_AUC_FOUND']; ?></b>
	        </li>
	        <?php } ?>
        </ul>
        </div>*/?>
        </li>
        <?php } ?>

        <?php if ($this->past_deal_setting) { ?>

	        <li <?php
		        if (isset($this->is_soldout)) {
			        echo "class='active'";
		        }
		        ?>>
		        <a   class="hmenu" href="<?php echo PATH.$this->storeurl; ?>/soldout.html" title=" <?php echo $this->Lang['SOLD_OUT2']; ?>">
			        <?php echo $this->Lang['SOLD_OUT2']; ?>
		        </a>
	        </li>
        <?php } ?>

        <?php if ($this->store_setting) { ?>
	        <li <?php
		        if (isset($this->is_store)) {
			        echo "class='active'";
		        }
		        ?>>
		        <a  class="hmenu" href="<?php echo PATH; ?>stores.html" title="<?php echo $this->Lang['STORES']; ?>">
			        <?php echo $this->Lang['STORES']; ?>
		        </a></li>
        <?php } ?>
        <?php if (($this->deal_setting == 1 || $this->product_setting == 1 || $this->auction_setting == 1 ) && $this->map_setting) { ?>
	        <li <?php
		        if (isset($this->is_map)) {
			        echo "class='active'";
		        }
		        ?>>
		        <a class="hmenu" href="<?php echo PATH; ?>near-map.html" title="<?php echo $this->Lang['NEAR_MAP']; ?>">
			        <?php echo $this->Lang['NEAR_MAP']; ?>
		        </a>
	        </li>
        <?php } ?>

        <?php if ($this->blog_setting) { ?>
        <li <?php
	        if (isset($this->is_blog)) {
		        echo "class='active'";
	        }
	        ?>>
	        <a  class="hmenu" href="<?php echo PATH; ?>blog" title="<?php echo $this->Lang['BLOG']; ?>">
		        <?php echo $this->Lang['BLOG']; ?>
	        </a>
        </li>
        <?php } ?>
        </ul>
        </div>
        </div>
        </div>
        </header>
        <!--header end-->
	<?php
	if ($this->cms_setting == 1) {
		if (count($this->get_all_cms_title)) {
			?>
			<div class="menu menu_mt">
				<div class="menu_left">
					<ul>
						<?php
						foreach ($this->get_all_cms_title as $d) {
							$cms_title = strtoupper($d->cms_title);
							?>
							<li> <a class="aerrnone" <?php if ($d->type == 3) { ?>href="<?php echo $d->cms_desc; ?>" <?php } else { ?> href="<?php echo PATH . $d->cms_url . '.php' ?>" <?php } ?> title="<?php echo $cms_title; ?>"> <span class="aerro_right_common1"> <?php echo $cms_title; ?></span></a></li>

			<?php } ?>
					</ul>
				</div>
			</div>
			<?php 
	        }
	}
	?>
<?php } ?>

<div class='popup_block'><?php echo new View("themes/" . THEME_NAME . '/users/login_popup'); ?></div>
<div class='popup_block1'><?php echo new View("themes/" . THEME_NAME . '/users/sign_up_popup'); ?></div>
<div class='popup_block2'><?php echo new View("themes/" . THEME_NAME . '/users/forget_popup'); ?></div>

 <script type="text/javascript">
    $(document).ready(function() {
        $(".show1").click(function() {
            $(".arro").toggle("slow", "linear");
            $(".drop_down").toggle("slow", "linear");
        });


    });
    
    function lookup(inputString) {
		var myString = inputString;
		var str = myString;
		var input_string=str.replace(/[^A-Za-z0-9-.]/g, " ");
        if (input_string.length == 0) {
            $('#suggestions').fadeOut(); // Hide the suggestions box
        } else {
            $.post("<?php echo PATH; ?>welcome/ajax_search/" + input_string + "/" + '<?php echo $ajax_type; ?>'+ ' / <?php echo $this->storeid;?>', function(data) { // Do an AJAX call
                $('#suggestions').fadeIn(); // Show the suggestions box
                $('#suggestions').html(data); // Fill the suggestions box
            });
        }
    }
    
    function lookup(inputString) {
		var myString = inputString;
		var str = myString;
		//var input_string=str.replace(/[^A-Za-z0-9-.]/g, " ");
		var input_string=str.replace(/[^a-zA-Z0-9-.,()\s]/g,'');
        if (input_string.length == 0) {
            $('#suggestions').fadeOut(); // Hide the suggestions box
        } else {
            $.post("<?php echo PATH; ?>welcome/ajax_search/" + input_string + "/" + '<?php echo $ajax_type; ?>'+ ' / <?php echo $this->storeid;?>', function(data) { // Do an AJAX call
                $('#suggestions').fadeIn(); // Show the suggestions box
                $('#suggestions').html(data); // Fill the suggestions box
            });
        }
    }


    function changelang(lang) {

        if (lang != "" && lang != "undefined") {

            var dataString = "language=" + lang;
            var url = '<?php echo PATH; ?>welcome/setlanguage';
            $.ajax(
                    {
                        type: 'POST',
                        url: url,
                        data: dataString,
                        success: function(result)
                        {
                            location.reload(true);
                        }


                        ,
                        error: function()
                        {
                            alert('Language cannot be set.');
                        }
                    });

        } else {
            alert("Please select language!");
        }

    }

    function ChangeCategory(catname, catid) {

        $("#search_cat").html(catname);
        $("#search_cat").attr("title", catname);
        $("#search_cat").attr("data-caty", catid);
        $('input[name=d_id]#cat').val(catid);
    }



</script>
<script>

var ww = document.body.clientWidth;

$(document).ready(function() {
	$(".htop_nav li a").each(function() {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		}
	});
        $(".htop_nav1 li a").each(function() {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		}
	});
	
	$(".toggleMenu").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$(".htop_nav").slideToggle();
	});
        $(".toggleMenu1").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$(".htop_nav1").slideToggle();
	});
	adjustMenu();
})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 1025 ) {
		$(".toggleMenu").css("display", "inline-block");
		if (!$(".toggleMenu").hasClass("active")) {
			$(".htop_nav").hide();
		} else {
			$(".htop_nav").show();
		}
		$(".htop_nav li").unbind('mouseenter mouseleave');
		$(".htop_nav li a.parent").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent("li").toggleClass("hover");
		});
                
                $(".toggleMenu1").css("display", "inline-block");
		if (!$(".toggleMenu1").hasClass("active")) {
			$(".htop_nav1").hide();
		} else {
			$(".htop_nav1").show();
		}
		$(".htop_nav1 li").unbind('mouseenter mouseleave');
		$(".htop_nav1 li a.parent").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent("li").toggleClass("hover");
		});
	} 
	else if (ww >= 1025) {
		$(".toggleMenu").css("display", "none");
		$(".htop_nav").show();
		$(".htop_nav li").removeClass("hover");
		$(".htop_nav li a").unbind('click');
		$(".htop_nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).toggleClass('hover');
		});
                
                $(".toggleMenu1").css("display", "none");
		$(".htop_nav1").show();
		$(".htop_nav1 li").removeClass("hover");
		$(".htop_nav1 li a").unbind('click');
		$(".htop_nav1 li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).toggleClass('hover');
		});
	}
}


</script>
<script>
    /*global jQuery:false */
jQuery(document).ready(function($) {
"use strict";

		//add some elements with animate effect
		$(".box").hover(
			function () {
			$(this).find('span.badge').addClass("animated fadeInLeft");
			$(this).find('.ico').addClass("animated fadeIn");
			},
			function () {
			$(this).find('span.badge').removeClass("animated fadeInLeft");
			$(this).find('.ico').removeClass("animated fadeIn");
			}
		);
		
	(function() {

		var $menu = $('.head_menu'),                        
			optionsList = '<option value="" selected>Go to..</option>';

		$menu.find('li').each(function() {
			var $this   = $(this),
				$anchor = $this.children('a'),
				depth   = $this.parents('ul').length - 1,
				indent  = '';

			if( depth ) {
				while( depth > 0 ) {
					indent += ' - ';
					depth--;
				}

			}
			$(".head_menu li").parent().addClass("bold");

			optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
		}).end()
		.after('<label class="head_categoryicon"><select class="head_category">' + optionsList + '</select></label>');
		
		$('select.head_category').on('change', function() {
			window.location = $(this).val();
		});
		
	})();

		//Navi hover
		$('ul.head_menu li.dropdown').hover(function () {
			$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
		}, function () {
			$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
		});
		
});

$("#cart_window").mouseover(function(){

	var url=Path+'/payment_product/cart_window_products';
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
					$(".cart_window_products1").css({"display":"block"});
					$(".cart_window_products1").html(check);
				}
			});
});

$("#cart_window").mouseout(function(){
	
	$(".cart_window_products1").hide();
	});


</script>
