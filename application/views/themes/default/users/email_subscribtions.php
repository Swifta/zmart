<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

        <div class="contianer_outer1">
            <div class="contianer_inner">
                <div class="contianer">
                    
                    <div class="bread_crumb">
                        <ul>
                            <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                            
                            <li><p title="<?php echo $this->Lang['MY_ELAL_SUB']; ?>"><?php echo $this->Lang['MY_ELAL_SUB']; ?></p></li>
                        </ul>
                    </div>
                    <!--content start-->
                    <div class="content_abouts">
                         <div class="all_mapbg_mid_common">
                        <div class="content_abou_common">
                            <div class="pro_top5">
                                                                                                              <div class="common_ner_commont1">
<div class="common_ner_commont">    
                            <h2><?php echo $this->Lang['MY_ELAL_SUB']; ?></h2>
</div>
                                                                                                              </div>
                            </div>
                            <div class="all_mapbg_mid">   
                                <div class="myemai_mnu">
                                    <div class="top_menu myemail_subbor">
                                        <a class="tab_navicon" href="#" title="Menu">Menu</a>
                                        <ul class="tab_nav">
                                        <li>
                                                <div class="tab_left"></div>
                                                <div class="tab_mid"><a href="<?php echo PATH;?>users/my-account.html" title="<?php echo $this->Lang['MY_ACC']; ?>"><?php echo $this->Lang['MY_ACC']; ?></a></div>
                                                <div class="tab_rgt"></div>

                                            </li>
                                                <li>
                                        <div class="tab_left"></div>
                                        <div class="tab_mid"><a href="<?php echo PATH; ?>wishlist.html" title="<?php echo $this->Lang['MY_WISH']; ?>"><?php echo $this->Lang['MY_WISH']; ?></a></div>
                                        <div class="tab_rgt"></div>
                                    </li>
                                    
                                            <li>
                                                <div class="tab_left"></div>
                                                <div class="tab_mid"><a href="<?php echo PATH;?>users/my-coupons.html" title="<?php echo $this->Lang['MY_BUYS']; ?>"><?php echo $this->Lang['MY_BUYS']; ?></a></div>
                                                <div class="tab_rgt"></div>
                                            </li>
                                            <li>
                                                <div class="tab_left"></div>
                                                <div class="tab_mid"><a href="<?php echo PATH;?>users/my-referral-list.html" title="<?php echo $this->Lang['MY_REFERAL']; ?>"><?php echo $this->Lang['MY_REFERAL']; ?></a></div>
                                                <div class="tab_rgt"></div>
                                            </li>
                                            
                                            <li   class="tab_act">
                                                <div class="tab_left"></div>
                                                <div class="tab_mid"><a href="<?php echo PATH;?>users/email-subscribtions.html" title="<?php echo $this->Lang['MY_ELAL_SUB']; ?>"><?php echo $this->Lang['MY_ELAL_SUB']; ?></a></div> 
                                                <div class="tab_rgt"></div>
                                            </li>
                                            <li>
                                                <div class="tab_left"></div>
                                                <div class="tab_mid"><a href="<?php echo PATH;?>users/my-winner-list.html" title="<?php echo $this->Lang['WON_AUC']; ?>"><?php echo $this->Lang['WON_AUC']; ?></a></div> 
                                                <div class="tab_rgt"></div>

                                            </li>
                                            <li>
                                            <div class="tab_left"></div>
                                             <div class="tab_mid"><a href="<?php echo PATH;?>users/my-shipping-address.html" title="<?php echo $this->Lang['MY_SHIPPING_ADD']; ?>"><?php echo $this->Lang['MY_SHIPPING_ADD']; ?></a></div> 
                                            <div class="tab_rgt"></div>
                                            </li>
                                       <?php  if($this->session->get('user_auto_key')) { ?>
                                        <li>
                                            <div class="tab_left"></div>
                                             <div class="tab_mid"><a href="<?php echo PATH;?>users/my-storecredit-purchase.html" title="<?php echo $this->Lang['STR_CRD_PURCH']; ?>"><?php echo $this->Lang['STR_CRD_PURCH']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <li >
                                            <div class="tab_left"></div>
                                             <div class="tab_mid"><a href="<?php echo PATH;?>users/my-storecredits.html" title="<?php echo $this->Lang['MY_STR_LIST']; ?>"><?php echo $this->Lang["MY_STR_LIST"]; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <?php } ?>
                                        </ul>                                                                
                                    </div> 
                                </div>
                            </div>
                                <div class="my_email_sub pos_rel">  

                                    <div class="title">
										<h1></h1>    
                                    </div>
									
                                    <p class="fl mt10">  <?php echo $this->Lang['TELL_US1']; ?>   <span class="user_email_ref"><?php echo $this->Lang['EMAIL_ADDRESS']; ?>:<?php foreach($this->users_select_list as $city1){ ?><span style=" font: normal 12px arial; color:#666;"><?php echo $city1->email_id; ?></span><?php }?></span> </p>                
									
                                    <div class="myemail_daily_deals">
										<form method="post" class="admin_form" name="email_subscribe">
											<h1><?php echo $this->Lang['NATION']; ?></h1>
							<?php /*			<?php if(CITY_SETTING) { ?>
                                        
                                        <ul>
											 <?php $city1->city_id=""; foreach($this->get_city_list as $city) {
											foreach($this->users_select_list as $city1){
											 $user_city = $city1->city_id;
											 $city_Tags = explode(",", $user_city);
											 if(in_array($city->city_id, $city_Tags)){
											?>
											  <li><input type="checkbox"  <?php if(in_array($city->city_id, $city_Tags)){?> checked="checked" <?php } ?>value="<?php echo $city->city_id;?>"  name="city_tag[]" class="check_subcity" /><p> <?php echo ucfirst($city->city_name); ?></p></li>
										  <?php } } } ?>
										   <span id="city_display"> </span>
											  <li><a  id="displayText" href="javascript:toggle();" title="<?php echo $this->Lang['ADD_ANOTHER']; ?>"><div class="add_city"><?php if(($city1->city_id=='') || ($city1->city_id==$this->city_id) ){?>

											<?php echo $this->Lang['ADD_ANY']; ?>
								
									<?php } else{ ?>
											<?php echo $this->Lang['ADD_ANOTHER']; ?>
								
									<?php } ?> </a></li>
										<select name="city_tag[]" id="toggleText" style="display: none">
										  
										<option value="">Select city</option>
										<?php foreach($this->get_city_list as $CityL){ 
										foreach($this->users_select_list as $city1){
										 $user_city = $city1->city_id;
										 $city_Tags = explode(",", $user_city);
										 if(!in_array($CityL->city_id, $city_Tags)){
										?>
										<option <?php if($CityL->city_url==$this->input->get('city')){ echo 'Selected="true"'; } ?> value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
										<?php } }
										} ?>
										</select>
											   </ul>
											   <?php } ?>

																	  
										*/ ?>					   
                                    </div>

                                     <div class="myemail_daily_deals_cat">
                                        <h1><?php echo $this->Lang['CATEGORIES1']; ?></h1>
                                        <?php foreach($this->category_list as $categories){
			      foreach($this->users_select_list1 as $categories1){
			 $category = $categories1->category_id;
		 	 $category_Tags = explode(",", $category); 
			      ?>
                                        <ul>
											<li><input type="checkbox" class="check_subcity" <?php if(in_array($categories->category_id, $category_Tags)){?> checked="checked" <?php } ?> value="<?php echo $categories->category_id;?>"  name="category_tag[]" autofocus /> <p><?php echo ucfirst($categories->category_name); ?></p></li>
                                            
                                        </ul>
                                        <?php }}?>
                                      
                                    </div>
                                    
                                <div class="clearfix">                                                                            
                                    <input class="sign_submit email_subcription" name="Submit" type="Submit" value="<?php echo $this->Lang['SAVE']; ?>" />                                                                              
                                </div>
                                </form>
                            </div>
                        </div>  


                    </div>
                    <!--end-->
                </div>
            </div>
        </div>
<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "none") {
    		ele.style.display = "";
    		text.style.display = "none";
  	}
	else {
		ele.style.display = "none";
		text.style.display = "";
	}
} 

       /* $(document).ready(function() {
	       $('#toggleText').change(function() {
               var count=$(this).val();
               $.post("<?php echo PATH;?>add_city.html?count="+count,{
                       }, function(response){ 
                               $("#city_display").append(response);
                       });
               });
          }); */

	

</script>

<script>

var ww = document.body.clientWidth;

$(document).ready(function() {
	$(".tab_nav li a").each(function() {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		}
	});
	
	$(".tab_navicon").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$(".tab_nav").slideToggle();
	});
	adjustMenu();
})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 960 ) {
		$(".tab_navicon").css("display", "inline-block");
		if (!$(".tab_navicon").hasClass("active")) {
			$(".tab_nav").hide();
		} else {
			$(".tab_nav").show();
		}
		$(".tab_nav li").unbind('mouseenter mouseleave');
		$(".tab_nav li a.parent").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent("li").toggleClass("hover");
		});
	} 
	else if (ww >= 960) {
		$(".tab_navicon").css("display", "none");
		$(".tab_nav").show();
		$(".tab_nav li").removeClass("hover");
		$(".tab_nav li a").unbind('click');
		$(".tab_nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).toggleClass('hover');
		});
	}
}


</script>
