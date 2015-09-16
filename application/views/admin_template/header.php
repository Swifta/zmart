<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="head_out fl clr ">
    	<div class="head_in">
            <div class="header fl clr">
                <div class="header_in">
					<?php if($this->uri->last_segment()=="admin.html"){ ?>
                    <a href="<?php echo PATH;?>admin.html" title="<?php echo SITENAME; ?>" class="fl logo">
 <img alt="<?php echo SITENAME; ?>" src="<?php echo PATH.'resize.php';?>?src=<?php echo THEME; ?>/images/logo.png&w=<?php echo LOGO_WIDTH; ?>&h=<?php echo LOGO_HEIGHT; ?>"/>
</a>  
					<?php } else if($this->session->get("user_type")==9){ ?>
						<a href="<?php echo PATH;?>store-admin.html" title="<?php echo SITENAME; ?>" class="fl logo"><img alt="<?php echo SITENAME; ?>" src="<?php echo PATH.'resize.php';?>?src=<?php echo THEME; ?>/images/logo.png&w=<?php echo LOGO_WIDTH; ?>&h=<?php echo LOGO_HEIGHT; ?>"/></a> 
						<?php }else{ ?><a href="<?php echo PATH;?>merchant.html" title="<?php echo SITENAME; ?>" class="fl logo"><img alt="<?php echo SITENAME; ?>" src="<?php echo PATH.'resize.php';?>?src=<?php echo THEME; ?>/images/logo.png&w=<?php echo LOGO_WIDTH; ?>&h=<?php echo LOGO_HEIGHT; ?>"/></a> 
					<?php  }?>
                   
			   <?php if($this->user_id && $this->uri->last_segment() != "admin-login.html" && $this->uri->last_segment() != "merchant-login.html" && $this->uri->last_segment() != "forgot-password.html"){?>
                    <div class="fr head_rgt">
                    
                       <?php if($this->session->get("user_type") == 1){ 
						   ?> <div class="welcome_mun_left">  </div><div class="welcome_mun_mid">   <p class="fl"><?php echo 
						   $this->Lang["WELCOME_ADMIN"];?></p> </div> <div class="welcome_mun_right">  </div> <?php } 
						   else { ?><div class="welcome_mun_left">  </div><div class="welcome_mun_mid">   <p class="fl"><?php echo 
						   
						   
						   $this->Lang["WELCOME"]." ".$this->session->get("name"); ?><div class="welcome_mun_right">  </div><?php } ?> <?php if($this->session->get("user_type") == 1 || $this->session->get("user_type") == 7){ ?><div class="left_setting_bg">  </div>
                           <div class="welcome_mun_mid">   <a href="<?php echo PATH; ?>admin/settings.html" title="<?php echo $this->Lang['SETTINGS']; ?>" class="fl"><?php echo $this->Lang["SETTINGS"];?></a> </div> <div class="welcome_mun_right">  </div> <?php } else{  ?>
                           
                           
                   </div> 
                            <div class="left_setting_bg">  </div><div class="welcome_mun_mid">  <a <?php if(isset($this->store_admin_panel)){?> href="<?php echo PATH; ?>store-admin/settings.html" <?php }else{?> href="<?php echo PATH; ?>merchant/settings.html" <?php }?> title="<?php echo $this->Lang['SETTINGS']; ?>" class="fl"><?php echo $this->Lang["SETTINGS"];?></a></div> <div class="welcome_mun_right"></div>
                           
                            <?php } ?>
						<div class="left_user_log_bg"> </div> <div class="welcome_mun_mid">  <a href="<?php echo PATH; ?>logout.html" title="<?php echo $this->Lang['LOGOUT']; ?>" class="fl">
						<?php echo $this->Lang["LOGOUT"];?></a> <div class="welcome_mun_right">  </div> 
                    </div>
                <?php } ?>
              </div>
         </div>
    </div>
</div>

<?php  if(isset($this->merchant_panel)){ ?> 
<?php  if(($this->uri=="merchant-login.html")||($this->uri=="admin-login.html")||($this->uri=="merchant/forgot-password.html")){  }else { ?>
<div class="dash_main_menu"> 
<ul>
<li > <a <?php  if($this->uri=="merchant.html"){ ?> class="active" <?php } ?> href="<?php echo PATH?>merchant.html"><?php echo $this->Lang['DASH']; ?> </a>  </li>

	
<li> <a <?php if(isset($this->mer_settings_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>merchant/settings.html"><?php echo $this->Lang['SETTINGS']; ?>  </a>  </li>	

<?php 
if(PRIVILEGES_DEALS==1){?>	
<li> <a <?php if(isset($this->mer_deals_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>merchant/deals-dashboard.html"><?php echo $this->Lang['DEALS']; ?>  </a>  </li>
<?php } ?>

<?php
if(PRIVILEGES_PRODUCTS==1){?>
<li> <a <?php   if(isset($this->mer_products_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>merchant/products-dashboard.html"> <?php echo $this->Lang['PRODUCTS']; ?> </a>  </li>
<?php } ?>

<?php 
	if(PRIVILEGES_AUCTIONS==1){ ?>
 <li> <a <?php   if(isset($this->mer_auction_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>merchant/auction-dashboard.html"> <?php echo $this->Lang['AUCTION']; ?> </a>  </li>
 <?php } ?> 
 
<?php 
if(PRIVILEGES_TRANSACTIONS==1){?>
<li> <a <?php   if(isset($this->mer_transactions_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>merchant/transaction-dashboard.html"> <?php echo $this->Lang['TRANSACTIONS']; ?> </a>  </li>
<?php }?>

<!--
<?php 
if(PRIVILEGES_FUNDREQUEST==1){ ?>
<li> <a <?php   if(isset($this->mer_fund_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>merchant/fund_request.html"><?php echo $this->Lang['FUND_REQ']; ?></a>  </li>
<?php } ?>
-->
<?php 
	if(PRIVILEGES_SHOPS==1){?>
<li> <a <?php  if(isset($this->mer_merchant_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>merchant/manage-shop.html"> <?php echo $this->Lang['SHOP']; ?> </a>  </li>
<?php } ?>
<?php if($this->user_type==3){?>
<li> <a <?php  if(isset($this->mer_moderator_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>merchant/moderator-dashboard.html"> <?php echo $this->Lang['MERCHANT_MODERATOR']; ?> </a>  </li>
<?php } ?>

</ul>
</div>

<?php } } else if(isset($this->store_admin_panel)){ ?>
<?php  if(($this->uri=="store-admin-login.html")||($this->uri=="store-admin/forgot-password.html")){  }else { ?>
<div class="dash_main_menu"> 
<ul>
<li > <a <?php  if($this->uri=="store-admin.html"){ ?> class="active" <?php } ?> href="<?php echo PATH?>store-admin.html"><?php echo $this->Lang['DASH']; ?> </a>  </li>
<li> <a <?php if(isset($this->mer_settings_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>store-admin/settings.html"><?php echo $this->Lang['SETTINGS']; ?></a>  </li>
	
<li> <a <?php if(isset($this->mer_deals_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>store-admin/deals-dashboard.html"><?php echo $this->Lang['DEALS']; ?>  </a>  </li>
<li> <a <?php   if(isset($this->mer_products_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>store-admin/products-dashboard.html"> <?php echo $this->Lang['PRODUCTS']; ?> </a>  </li> 
 <li> <a <?php   if(isset($this->mer_auction_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>store-admin/auction-dashboard.html"> <?php echo $this->Lang['AUCTION']; ?> </a>  </li> 
<li> <a <?php   if(isset($this->mer_transactions_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>store-admin/transaction-dashboard.html"> <?php echo $this->Lang['TRANSACTIONS']; ?> </a>  </li>
<li> <a <?php  if(isset($this->mer_merchant_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>store-admin/return-policy.html"> <?php echo $this->Lang['SHOP']; ?> </a>  </li>
</ul>
</div>
<?php } }else{ ?>
<?php  if(($this->uri=="merchant-login.html")||($this->uri=="admin-login.html")||($this->uri=="merchant/forgot-password.html")){  }else { ?>
<div class="dash_main_menu"> 
<ul>
<li > <a <?php  if($this->uri=="admin.html"){ ?> class="active" <?php } ?> href="<?php echo PATH?>admin.html"><?php echo $this->Lang['DASH']; ?> </a>  </li>

<?php if($this->user_type==1){ ?>

<li> <a <?php if(isset($this->deals_act)||isset($this->products_act)||isset($this->auction_act)||isset($this->users_act)||isset($this->merchant_act)||isset($this->transactions_act)||isset($this->blog_act)|| $this->uri=="admin.html"||isset($this->customer_care_act) || isset($this->moderator_act)){ }else {?> class="active" <?php } ?> href="<?php echo PATH?>admin/general-settings.html"><?php echo $this->Lang['SETTINGS']; ?></a></li>

<?php }else if($this->user_type==2){ 
	if((ADMIN_PRIVILEGES_BANNER) || (ADMIN_PRIVILEGES_ATTRIBUTS) || (ADMIN_PRIVILEGES_SPECIFICATION) || (ADMIN_PRIVILEGES_COUNTRY) || (ADMIN_PRIVILEGES_CITY) || (ADMIN_PRIVILEGES_CATEGORIES) || (ADMIN_PRIVILEGES_SECTOR) || (ADMIN_PRIVILEGES_CMS) || (ADMIN_PRIVILEGES_ADS) || (ADMIN_PRIVILEGES_FAQ) || (ADMIN_PRIVILEGES_NEWSLETTER)){
	if(ADMIN_PRIVILEGES_BANNER)
		$href_setting="admin/manage-banner-images.html";
	else if(ADMIN_PRIVILEGES_ATTRIBUTS)
		$href_setting="admin/manage-colors.html";
	else if(ADMIN_PRIVILEGES_SPECIFICATION)
		$href_setting="admin/manage-attribute-group.html";
	else if(ADMIN_PRIVILEGES_COUNTRY)
		$href_setting="admin/manage-country.html";
	else if(ADMIN_PRIVILEGES_CITY)
		$href_setting="admin/manage-city.html";
	else if(ADMIN_PRIVILEGES_CATEGORIES)
		$href_setting="admin/manage-category.html";
	else if(ADMIN_PRIVILEGES_SECTOR)
		$href_setting="admin/manage-sector.html";
	else if(ADMIN_PRIVILEGES_CMS)
		$href_setting="cms/manage-pages.html";
	else if(ADMIN_PRIVILEGES_ADS)
		$href_setting="adds_mgmt/manage_adds.html";
	else if(ADMIN_PRIVILEGES_FAQ)
		$href_setting="faq_mgt/manage_faq.html";
	else if(ADMIN_PRIVILEGES_NEWSLETTER)
		$href_setting="admin/manage-template.html";
	?>
<li> <a <?php if(isset($this->deals_act)||isset($this->products_act)||isset($this->auction_act)||isset($this->users_act)||isset($this->merchant_act)||isset($this->transactions_act)||isset($this->blog_act)|| $this->uri=="admin.html"||isset($this->customer_care_act) || isset($this->moderator_act)){ }else {?> class="active" <?php } ?> href="<?php echo PATH.$href_setting?>"><?php echo $this->Lang['SETTINGS']; ?></a>  </li>

<?php }
}else{?>

<li> <a <?php if(isset($this->deals_act)||isset($this->products_act)||isset($this->auction_act)||isset($this->users_act)||isset($this->merchant_act)||isset($this->transactions_act)||isset($this->blog_act)|| $this->uri=="admin.html"||isset($this->customer_care_act) || isset($this->moderator_act)){ }else {?> class="active" <?php } ?> href="<?php echo PATH?>admin/manage-attribute-group.html"><?php echo $this->Lang['SETTINGS']; ?></a>  </li>

<?php } ?>

<?php if(ADMIN_PRIVILEGES_DEALS==1){?>
<li> <a <?php if(isset($this->deals_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>admin/deals-dashboard.html"><?php echo $this->Lang['DEALS']; ?>  </a>  </li>
<?php }?>

<?php if(ADMIN_PRIVILEGES_PRODUCTS==1 || ADMIN_PRIVILEGES_STORECREDIT==1 || ADMIN_PRIVILEGES_TRANSACTIONS==1){
	if(ADMIN_PRIVILEGES_PRODUCTS)
		$href_pro = 'admin/products-dashboard.html';
	else if(ADMIN_PRIVILEGES_TRANSACTIONS)
		$href_pro = 'admin/shipping-delivery.html';
	else
		$href_pro = 'admin-products/storecredits/pending-transaction.html';?>
<li> <a <?php   if(isset($this->products_act)){ ?> class="active" <?php } ?>href="<?php echo PATH.$href_pro?>"> <?php echo $this->Lang['PRODUCTS']; ?> </a>  </li> 
<?php }?>

<?php if(ADMIN_PRIVILEGES_AUCTIONS==1 || ADMIN_PRIVILEGES_TRANSACTIONS==1){
	if(ADMIN_PRIVILEGES_AUCTIONS)
		$href_auc = 'admin/auction-dashboard.html';
	else
		$href_auc = "admin-auction/shipping-delivery.html";?>
 <li> <a <?php   if(isset($this->auction_act)){ ?> class="active" <?php } ?>href="<?php echo PATH.$href_auc?>"> <?php echo $this->Lang['AUCTION']; ?> </a>  </li> 
 <?php }?>
 
 <?php if(ADMIN_PRIVILEGES_CUSTOMER==1){?>
<li> <a <?php   if(isset($this->users_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>admin/users-dashboard.html"><?php echo $this->Lang['CUSTOMERS']; ?> </a>  </li>
<?php }?>

<?php if(ADMIN_PRIVILEGES_MERCHANT==1){?>
<li> <a <?php  if(isset($this->merchant_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>admin/merchant-dashboard.html"> <?php echo $this->Lang['MERCHANTS']; ?> </a>  </li>
<?php }?>

<?php if(ADMIN_PRIVILEGES_TRANSACTIONS==1 || ADMIN_PRIVILEGES_FUNDREQUEST==1 || ADMIN_PRIVILEGES_STORECREDIT==1){
	if(ADMIN_PRIVILEGES_TRANSACTIONS)
		$href_trans = "admin/transaction-dashboard.html";
	else if(ADMIN_PRIVILEGES_STORECREDIT)
		$href_trans = "admin-storecredits/all-transaction.html";
	else
		$href_trans = "admin/all-fund-request.html";?>
		
<li> <a <?php   if(isset($this->transactions_act)){ ?> class="active" <?php } ?> href="<?php echo PATH.$href_trans?>"> <?php echo $this->Lang['TRANSACTIONS']; ?> </a>  </li>
<?php }?>

<?php if(ADMIN_PRIVILEGES_BLOG==1){?>
<li> <a <?php   if(isset($this->blog_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>admin/manage-publish-blog.html"><?php echo $this->Lang['BLOGS']; ?></a>  </li>
<?php }?>

<?php if(ADMIN_PRIVILEGES_CUSTOMERCARE==1){?>
<li> <a <?php   if(isset($this->customer_care_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>admin/customer-care-dashboard.html"><?php echo $this->Lang['CUSTOMER_CARE']; ?> </a>  </li>
<?php }?>

<?php if($this->user_type==1){?>
<li> <a <?php   if(isset($this->moderator_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>admin/moderator-dashboard.html"><?php echo $this->Lang['MODERATOR']; ?> </a>  </li>
<?php } ?>

</ul>
</div>
<?php } }?>

<div class="processing_image">
<p style="color:#f78f1e; font:normal 26px arial;"><?php echo $this->Lang['PROCE_PLS_WAIT']; ?></br>
<img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/loading.gif" alt="loading.gif" />
</p>

</div>
