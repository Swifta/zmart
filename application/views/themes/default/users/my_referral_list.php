

<div class="contianer_outer1">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><?php echo $this->Lang['MY_REFERAL']; ?></p></li>
                </ul>
            </div>
            <!--content start-->
            <div class="content_abouts">
                <div class="all_mapbg_mid_common">
                    <div class="content_abou_common">
                         <div class="pro_top5">
                            <div class="common_ner_commont1">
<div class="common_ner_commont">     
                        <h2><?php echo $this->Lang['MY_REFERAL']; ?></h2>
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
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-account.html" title="<?php echo $this->Lang['MY_ACC']; ?>"><?php echo $this->Lang['MY_ACC']; ?></a></div>
                                            <div class="tab_rgt"></div>

                                        </li>
                                    <li>
                                        <div class="tab_left"></div>
                                        <div class="tab_mid"><a href="<?php echo PATH; ?>wishlist.html" title="<?php echo $this->Lang['MY_WISH']; ?>"><?php echo $this->Lang['MY_WISH']; ?></a></div>
                                        <div class="tab_rgt"></div>
                                    </li>
                                    
                                        <li>
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-coupons.html" title="<?php echo $this->Lang['MY_BUYS']; ?>"><?php echo $this->Lang['MY_BUYS']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        <li  class="tab_act">
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/my-referral-list.html" title="<?php echo $this->Lang['MY_REFERAL']; ?>"><?php echo $this->Lang['MY_REFERAL']; ?></a></div>
                                            <div class="tab_rgt"></div>
                                        </li>
                                        
                                        
                                        <li>
                                            <div class="tab_left"></div>
                                            <div class="tab_mid"><a href="<?php echo PATH; ?>users/email-subscribtions.html" title="<?php echo $this->Lang['MY_ELAL_SUB']; ?>"><?php echo $this->Lang['MY_ELAL_SUB']; ?></a></div> 
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
                        <div class="mybuys_content">  
                            <div class="my_account_table">
							 <?php if (count($this->user_refrel_list) > 0) { ?>
                            <table class="maccount_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0">
                                <thead>
                                    <tr>
                                        <th width="20" align="left"><?php echo $this->Lang['S_NO']; ?></th>
                                        <th width="100" align="left"> <?php echo $this->Lang['USER_NAME']; ?></th>
                                        <th width="100" align="left"><?php echo $this->Lang['EMAIL_ID']; ?></th>
                                        <th width="100" align="left"><?php echo $this->Lang['JOIN_DATE']; ?></th>
                                        <th width="100" align="center"><?php echo $this->Lang['PURCHACE_COUNT']; ?></th>
                                    </tr>
                                </thead>                            

                            
                                <?php
                                $i = 0;
                                    $first_item = $this->pagination->current_first_item;
                                    foreach ($this->user_refrel_list as $u) {
                                        ?> 
                                        <tr>
                                            <td><?php echo $i + $first_item; ?></td>
                                            <td><?php echo ucfirst($u->firstname); ?> </td>
                                            <td><?php echo $u->email; ?> </td>
                                            <td><?php echo date('d-M-Y', $u->joined_date); ?></td>
                                            <td align="center"><?php echo $u->deal_bought_count; ?> </td>
                                             </tr> 
                                            <?php $i++;
                                        }
                                   ?>



                            </table>
                            </div>
                            <div class="pagenation myrefer_pagenation"><?php echo $this->pagination; ?></div>
                            <?php } else { ?>
                                        <p class="no_referal"><?php echo $this->Lang['NO_REFERAL']; ?></p>
                                        
                            <?php } ?> 
                        </div>
 
                               

                    </div>
                </div>  


            </div>
            <!--end-->
        </div>
    </div>
</div>


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
