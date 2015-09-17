<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="menu">
  <div class="menu_container">
	<?php if(isset($this->deals_act) && ADMIN_PRIVILEGES_DEALS){ ?>
	 <div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_deals.png" alt="<?php echo $this->Lang['DEALS']; ?>"/><span><?php echo $this->Lang['DEALS']; ?></span></p></div>
	<?php } ?>
	<?php   if(isset($this->products_act) && (ADMIN_PRIVILEGES_PRODUCTS || ADMIN_PRIVILEGES_TRANSACTIONS || ADMIN_PRIVILEGES_STORECREDIT)){ ?>
	<div class="menu_title"><p><img src="<?php echo PATH ?>images/title_products.png" alt="<?php echo $this->Lang['PRODUCTS']; ?>"/><span><?php echo $this->Lang['PRODUCTS']; ?></span></p></div>
	<?php } ?>  
	<?php   if(isset($this->auction_act) && (ADMIN_PRIVILEGES_AUCTIONS || ADMIN_PRIVILEGES_TRANSACTIONS)){ ?>
	<div class="menu_title"><p><img src="<?php echo PATH ?>images/auction_title.png" alt="<?php echo $this->Lang['AUCTION']; ?>"/><span><?php echo $this->Lang['AUCTION']; ?></span></p></div>
	<?php } ?>
	<?php   if(isset($this->users_act) && ADMIN_PRIVILEGES_CUSTOMER){ ?>
	<div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_customer.png" alt="<?php echo $this->Lang['CUSTOMERS']; ?>"/><span><?php echo $this->Lang['CUSTOMERS']; ?></span></p></div>
	<?php } ?>
	<?php  if(isset($this->merchant_act) && ADMIN_PRIVILEGES_MERCHANT){ ?>
	<div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_merchant.png" alt="<?php echo $this->Lang['MERCHANTS']; ?>"/><span><?php echo $this->Lang['MERCHANTS']; ?></span></p></div>
	<?php } ?>
	<?php   if(isset($this->transactions_act) && (ADMIN_PRIVILEGES_TRANSACTIONS || ADMIN_PRIVILEGES_STORECREDIT)){ ?>
	<div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_balance.png" alt="<?php echo $this->Lang['TRANS']; ?>"/><span><?php echo $this->Lang['TRANS']; ?></span></p></div>
	<?php } ?>
	<?php   if(isset($this->blog_act) && ADMIN_PRIVILEGES_BLOG){ ?>
	<div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_blog_comment.png" alt="<?php echo $this->Lang['BLOG']; ?>"/><span><?php echo $this->Lang['BLOG']; ?></span></p></div>
	<?php } ?>
	<?php   if(isset($this->customer_care_act) && ADMIN_PRIVILEGES_CUSTOMERCARE){ ?>
	<div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_customer.png" alt="<?php echo $this->Lang['CUSTOMER_CARE']; ?>"/><span><?php echo $this->Lang['CUSTOMER_CARE']; ?></span></p></div>
	<?php } ?>
	
	<?php 
	if(ADMIN_PRIVILEGES_BANNER|| ADMIN_PRIVILEGES_ATTRIBUTS || ADMIN_PRIVILEGES_SPECIFICATION || ADMIN_PRIVILEGES_COUNTRY || ADMIN_PRIVILEGES_CITY || ADMIN_PRIVILEGES_CATEGORIES || ADMIN_PRIVILEGES_SECTOR || ADMIN_PRIVILEGES_CMS || ADMIN_PRIVILEGES_ADS || ADMIN_PRIVILEGES_FAQ || ADMIN_PRIVILEGES_NEWSLETTER){
	if(isset($this->deals_act)||isset($this->products_act)|| isset($this->auction_act) ||isset($this->users_act)||isset($this->merchant_act)||isset($this->transactions_act)||isset($this->blog_act)||isset($this->customer_care_act)){ }else {?>
	
		<div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_module_settings.png" alt="<?php echo $this->Lang['SETTINGS']; ?>" /><span><?php echo $this->Lang['SETTINGS']; ?></span></p></div>
	<?php }
	} ?>
	
    <ul>
    <?php if(isset($this->deals_act) && ADMIN_PRIVILEGES_DEALS){ ?>
    
	<li <?php if(isset($this->dashboard_deals)){ ?> class="menu_active"  <?php } ?>>
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>admin/deals-dashboard.html" title="<?php echo $this->Lang['DEAL_DASH']; ?>"><span class="fund_management fl"><?php echo $this->Lang['DEAL_DASH']; ?></span></a></li>
        
 <?php if(ADMIN_PRIVILEGES_DEALS_ADD){ ?>
<li <?php if(isset($this->add_deal)){ ?> class="menu_active"  <?php } ?>>
        <a class="menu_rgt"  href="<?php echo PATH; ?>admin/add-deals.html" title="<?php echo $this->Lang["ADD_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ADD_DEALS"]; ?></span></a></li>
<?php } ?>

<li <?php if(isset($this->manage_deals)){ ?> class="menu_active"  <?php } ?>>
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>admin/manage-deals.html" title="<?php echo $this->Lang["MANAGE_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["MANAGE_DEALS"]; ?></span></a></li>
<li <?php if(isset($this->archive_deals)){ ?> class="menu_active"  <?php } ?>>
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>admin/archive-deals.html" title="<?php echo $this->Lang["ARCHIVE_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ARCHIVE_DEALS"]; ?></span></a></li>
        <?php if($this->user_type==1 || $this->user_type==2){?>
		<li <?php if(isset($this->validate_coupon)){ ?> class="menu_active"  <?php } ?> >
                
        <a class="menu_rgt"  href="<?php echo PATH; ?>admin/couopn_code.html" title="<?php echo $this->Lang["COUPON_VALIDATE"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["COUPON_VALIDATE"]; ?></span></a></li>

		<li <?php if(isset($this->close_code)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>admin/close-couopn-list.html" title="<?php echo $this->Lang['REDEM_COU_LI']; ?> "><span class="fund_management fl"><?php echo $this->Lang['REDEM_COU_LI']; ?></span></a></li>
        <?php } ?>
		<?php /*<li <?php if(isset($this->deal_comments)){ ?> class="menu_active"  <?php } ?>>
        
        <a href="<?php echo PATH; ?>admin/manage-deal-comments.html" class="menu_rgt" title="<?php echo $this->Lang['USER_COMM']; ?>"><span class="customer_comments"><?php echo $this->Lang["USER_COMM"]; ?></span></a></li> */ ?>
        <?php } ?>
	    <?php    if(isset($this->products_act) && (ADMIN_PRIVILEGES_PRODUCTS || ADMIN_PRIVILEGES_TRANSACTIONS || ADMIN_PRIVILEGES_STORECREDIT)){
			if(ADMIN_PRIVILEGES_PRODUCTS){ ?>
      	<li <?php if(isset($this->dashboard_products)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/products-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['PRODUCT_DASH']; ?>"><span class="customer_comments"><?php echo $this->Lang['PRODUCT_DASH']; ?></span></a></li>
        <?php if(ADMIN_PRIVILEGES_PRODUCTS_ADD){?>
	<li <?php if(isset($this->add_product)){ ?> class="menu_active"  <?php } ?>>
        
        <a href="<?php echo PATH; ?>admin/add-products.html" class="menu_rgt" title="<?php echo $this->Lang['ADD_PRODUCTS']; ?>"><span class="customer_comments"><?php echo $this->Lang['ADD_PRODUCTS']; ?></span></a></li>
        <?php } ?>
	<li <?php if(isset($this->manage_product)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/manage-products.html" class="menu_rgt" title="<?php echo $this->Lang["MANAGE_PRODUCTS"]; ?>"><span class="customer_comments"><?php echo $this->Lang["MANAGE_PRODUCTS"]; ?></span></a></li>
	<li <?php if(isset($this->archive_product)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/sold-products.html" class="menu_rgt" title="<?php echo $this->Lang["ARCHIVE_PRODUCTS"]; ?>"><span class="customer_comments"><?php echo $this->Lang["ARCHIVE_PRODUCTS"]; ?></span></a></li>
        
         <!-- Import products start  -->      
         <?php if($this->user_type==1 || $this->user_type==2){?>
    <li <?php if(isset($this->import_product)){ ?> class="menu_active"  <?php } ?> >
        <a href="<?php echo PATH; ?>admin/product-import.html" class="menu_rgt" title="<?php echo $this->Lang["PRODUCT_IMPORT"]; ?>"><span class="customer_comments"><?php echo $this->Lang["PRODUCT_IMPORT"]; ?></span></a></li>
        <?php } } ?>
        
  <!-- Import products End  -->
    
    <?php if(ADMIN_PRIVILEGES_TRANSACTIONS){?>
    	<li <?php if(isset($this->shipping_delivery)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/shipping-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['SHIP_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['SHIP_DEL']; ?></span></a></li>
        <?php }?>
		<?php /*<li <?php if(isset($this->cash_delivery)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/cash-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['CASH_ON_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['CASH_ON_DEL']; ?></span></a></li>*/?>
        <?php /*
		<li <?php if(isset($this->product_comments)){ ?> class="menu_active"  <?php } ?>>
        
        <a href="<?php echo PATH; ?>admin/manage-product-comments.html" class="menu_rgt" title="<?php echo $this->Lang['USER_COMM']; ?>"><span class="customer_comments"><?php echo $this->Lang["USER_COMM"]; ?></span></a></li> */ ?>
        
        <?php if(ADMIN_PRIVILEGES_STORECREDIT){?>
         <li onclick="toggle(16)" <?php if(isset($this->storecredit)){ ?> class="menu_active"  <?php } ?> >        
			<a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['STR_CRD_ORD']; ?>"><span class="category_management fl"><?php echo $this->Lang['STR_CRD_ORD']; ?></span><img id="left_menubutton_16" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
			<ul class="toggleul_16">
				<li><a href="<?php echo PATH; ?>admin-products/storecredits/pending-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['PEN_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['PEN_ORD']; ?></span></a></li>			
				<li><a href="<?php echo PATH; ?>admin-products/storecredits/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['APPR_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['APPR_ORD']; ?></span></a></li>
                <li><a href="<?php echo PATH; ?>admin-products/storecredits/purchase-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['PURCH_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['PURCH_ORD']; ?></span></a></li>
				<li><a href="<?php echo PATH; ?>admin-products/storecredits/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAIL_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['FAIL_ORD']; ?></span></a></li>
			</ul>
		</li>
		<?php }?>
		
    <?php } ?>
    
        <?php   if(isset($this->auction_act) && (ADMIN_PRIVILEGES_AUCTIONS || ADMIN_PRIVILEGES_TRANSACTIONS)){ 
			if(ADMIN_PRIVILEGES_AUCTIONS){?>
      	<li <?php if(isset($this->dashboard_auction)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/auction-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['ACT_DASH']; ?>"><span class="customer_comments"><?php echo $this->Lang['ACT_DASH']; ?></span></a></li>
        <?php if(ADMIN_PRIVILEGES_AUCTIONS_ADD){?>
	<li <?php if(isset($this->add_auction)){ ?> class="menu_active"  <?php } ?>>
        
        <a href="<?php echo PATH; ?>admin/add-auction.html" class="menu_rgt" title="<?php echo $this->Lang['ADD_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['ADD_ACT_PRO']; ?></span></a></li>
        <?php } ?>
	<li <?php if(isset($this->manage_auction)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/manage-auction.html" class="menu_rgt" title="<?php echo $this->Lang['MAG_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['MAG_ACT_PRO']; ?></span></a></li>
	<li <?php if(isset($this->archive_auction)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/archive-auction.html" class="menu_rgt" title="<?php echo $this->Lang['ARCH_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['ARCH_ACT_PRO']; ?></span></a></li>
		<li <?php if(isset($this->winner)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin-auction/winner-list.html" class="menu_rgt" title="<?php echo $this->Lang['WINNERS4']; ?>"><span class="customer_comments"><?php echo $this->Lang['WINNERS4']; ?></span></a></li>
        
        <?php }
        if(ADMIN_PRIVILEGES_TRANSACTIONS){ ?>
		<li <?php if(isset($this->shipping_delivery)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin-auction/shipping-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['SHIP_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['SHIP_DEL']; ?></span></a></li>
        <?php }?>

        <?php /*<li <?php if(isset($this->cod_delivery)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin-auction/cod-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['CASH_ON_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['CASH_ON_DEL']; ?></span></a></li>*/?>
        
       <?php /* <li <?php if(isset($this->auction_comments)){ ?> class="menu_active"  <?php } ?>>
        
        <a href="<?php echo PATH; ?>admin/manage-auction-comments.html" class="menu_rgt" title="<?php echo $this->Lang['USER_COMM']; ?>"><span class="customer_comments"><?php echo $this->Lang["USER_COMM"]; ?></span></a></li> */ ?>
        
    <?php } ?>	
   
	<?php   if(isset($this->users_act) && ADMIN_PRIVILEGES_CUSTOMER){ ?>
       
	<li <?php if(isset($this->dashboard_users)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/users-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['CUSTM_DASH']; ?>"><span class="customer_comments"><?php echo $this->Lang['CUSTM_DASH']; ?></span></a></li>
        <?php if(ADMIN_PRIVILEGES_CUSTOMER_ADD){?>
	<li <?php if(isset($this->add_users)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/add-user.html" class="menu_rgt" title="<?php echo $this->Lang['ADD_USER']; ?>"><span class="customer_comments"><?php echo $this->Lang['ADD_USER']; ?></span></a></li>
        <?php } ?>
	<li <?php if(isset($this->manage_users)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/manage-user.html" class="menu_rgt" title="<?php echo $this->Lang["MANAGE_USER"]; ?>"><span class="customer_comments"><?php echo $this->Lang["MANAGE_USER"]; ?></span></a></li>
      <li <?php if(isset($this->manage_contacts)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/manage-contacts.html" class="menu_rgt" title="<?php echo $this->Lang['MANG_CONT']; ?>"><span class="customer_comments"><?php echo $this->Lang['MANG_CONT']; ?></span></a></li>
        <li <?php if(isset($this->manage_email_subscriber)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/manage-email-subscriber.html" class="menu_rgt" title="<?php echo $this->Lang['MANAGE_SUBSCRIBER']; ?>"><span class="customer_comments"><?php echo $this->Lang['MANAGE_SUBSCRIBER']; ?></span></a></li>

		<li <?php if(isset($this->manage_referral_user)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/manage-referral-users.html" class="menu_rgt" title="<?php echo $this->Lang['MANA_REFE_USER']; ?>"><span class="customer_comments"><?php echo $this->Lang['MANA_REFE_USER']; ?></span></a></li>
        <?php if(ADMIN_PRIVILEGES_DAILY_NEWSLETTER){?>
        <li onclick="toggle(12)" <?php if(isset($this->user_news_letter)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['NEWSLETTER1']; ?>"><span class="category_management fl"><?php echo $this->Lang['NEWSLETTER1']; ?></span><img id="left_menubutton_12" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_12">
			<li>
        
        <a href="<?php echo PATH; ?>admin/send-user-newsletter.html" class="menu_rgt1" title="<?php echo $this->Lang['SEND_EMAILS']; ?>"><span class="pl15"><?php echo $this->Lang['SEND_EMAILS']; ?></span></a></li>
			
			<li>
        
        <a href="<?php echo PATH; ?>admin/email_inbox.html" class="menu_rgt1" title="<?php echo $this->Lang['EMAILS']; ?>"><span class="pl15"><?php echo $this->Lang['EMAILS']; ?></span></a></li>
            <li>
        
        
     
      <?php } ?>
      
	<?php } ?>
	<?php   if(isset($this->merchant_act) && ADMIN_PRIVILEGES_MERCHANT){ ?>

	<li <?php if(isset($this->dashboard_merchant)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/merchant-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['MERCHANT_DASHBOARD']; ?>"><span class="customer_comments"><?php echo $this->Lang['MERCHANT_DASHBOARD']; ?></span></a></li>
        <?php if(ADMIN_PRIVILEGES_MERCHANT_ADD){?>
	<li  <?php if(isset($this->add_merchant)){ ?> class="menu_active"  <?php } ?>>
        
        <a href="<?php echo PATH; ?>admin/add-merchant.html" class="menu_rgt" title="<?php echo $this->Lang["MERCHANT_ADD"]; ?>"><span class="customer_comments"><?php echo $this->Lang["MERCHANT_ADD"]; ?></span></a></li>
        <?php } ?>

	<li <?php if(isset($this->manage_merchant)){ ?> class="menu_active"  <?php } ?>>
        
        <a href="<?php echo PATH; ?>admin/merchant.html" class="menu_rgt" title="<?php echo $this->Lang["MERCHANT_MANAGE"]; ?>"><span class="customer_comments"><?php echo $this->Lang["MERCHANT_MANAGE"]; ?></span></a></li>
        <?php if(ADMIN_PRIVILEGES_DAILY_NEWSLETTER){?>
        
        
         <li onclick="toggle(12)" <?php if(isset($this->merchant_news_letter)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['NEWSLETTER1']; ?>"><span class="category_management fl"><?php echo $this->Lang['NEWSLETTER1']; ?></span><img id="left_menubutton_12" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_12">
			<li>
        
        <a href="<?php echo PATH; ?>admin/send-merchant-newsletter.html" class="menu_rgt1" title="<?php echo $this->Lang['SEND_EMAILS']; ?>"><span class="pl15"><?php echo $this->Lang['SEND_EMAILS']; ?></span></a></li>
			
			<li>
        
        <a href="<?php echo PATH; ?>admin/merchant_email_inbox.html" class="menu_rgt1" title="<?php echo $this->Lang['EMAILS']; ?>"><span class="pl15"><?php echo $this->Lang['EMAILS']; ?></span></a></li>
            <li>
        
        
     
      <?php } ?>
	<?php /* <li <?php if(isset($this->store_comments)){ ?> class="menu_active"  <?php } ?>>
        
        <a href="<?php echo PATH; ?>admin/manage-store-comments.html" class="menu_rgt" title="<?php echo $this->Lang['USER_COMM']; ?>"><span class="customer_comments"><?php echo $this->Lang["USER_COMM"]; ?></span></a></li> */ ?>
	<?php } ?>
	<?php   if(isset($this->transactions_act)){ 
		if(ADMIN_PRIVILEGES_TRANSACTIONS){?>
	<li <?php if(isset($this->dashboard_transaction)){ ?> class="menu_active"  <?php } ?>>
        
        <a href="<?php echo PATH; ?>admin/transaction-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['TRANS_DASH']; ?>"><span class="payment_transactions"><?php echo $this->Lang['TRANS_DASH']; ?></span></a></li>
		
		<li onclick="toggle(12)" <?php if(isset($this->deal_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['DLS_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['DLS_TRANS']; ?></span><img id="left_menubutton_12" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_12">
			<li>
        
        <a href="<?php echo PATH; ?>admin/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			
			<li>
        
        <a href="<?php echo PATH; ?>admin/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span></a></li>
            <li>
        
        <a href="<?php echo PATH; ?>admin/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>admin/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>admin/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>

     <?php /* <li onclick="toggle(20)" <?php if(isset($this->deal_cod_trans)){ ?> class="menu_active"  <?php } ?> >
        
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['DEAL_COD']; ?>"><span class="category_management fl"><?php echo $this->Lang['DEAL_COD']; ?></span><img id="left_menubutton_20" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_20">
			<li>
        
        <a href="<?php echo PATH; ?>admin-deal-cod/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			
            <li>
        
        <a href="<?php echo PATH; ?>admin-deal-cod/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>admin-deal-cod/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>admin-deal-cod/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>*/?>

		<li onclick="toggle(11)" <?php if(isset($this->pro_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['PRO_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['PRO_TRANS']; ?></span><img id="left_menubutton_11" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_11">
			<li>
        
        <a href="<?php echo PATH; ?>admin-product/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			
			<?php /* <li>
        		
        			<a href="<?php echo PATH; ?>admin-product/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span>
					</a>
			</li> */ ?>
       
            <li>
        
        <a href="<?php echo PATH; ?>admin-product/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>admin-product/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>admin-product/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>
<?php }?>
		<?php /*<li onclick="toggle(13)" <?php if(isset($this->cod_trans)){ ?> class="menu_active"  <?php } ?> >
        
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['PRO_COD']; ?>"><span class="category_management fl"><?php echo $this->Lang['PRO_COD']; ?></span><img id="left_menubutton_13" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_13">
			<li>
        
        <a href="<?php echo PATH; ?>admin-cod/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			
            <li>
        
        <a href="<?php echo PATH; ?>admin-cod/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>admin-cod/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>admin-cod/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>*/?>
     <?php if(ADMIN_PRIVILEGES_STORECREDIT){?>
      <li onclick="toggle(14)" <?php if(isset($this->storecredits)){ ?> class="menu_active"  <?php } ?> >
        
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['PRD_STR_CRDS']; ?>"><span class="category_management fl"><?php echo $this->Lang['PRD_STR_CRDS']; ?></span><img id="left_menubutton_14" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_14">
			<li>
        
        <a href="<?php echo PATH; ?>admin-storecredits/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
		<?php /*	
            <li>
        
        <a href="<?php echo PATH; ?>admin-storecredits/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>admin-cod/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
		<li>
        
        <a href="<?php echo PATH; ?>admin-storecredits/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        */ ?>
        </ul>
      </li>
<?php }?>
<?php if(ADMIN_PRIVILEGES_TRANSACTIONS){ ?>
		<li onclick="toggle(10)" <?php if(isset($this->act_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['ACT_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['ACT_TRANS']; ?></span><img id="left_menubutton_10" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_10">

			<li>
		        
			        <a href="<?php echo PATH; ?>admin-auction/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span>
					</a>
			</li>

			<?php  /* <li>
        			<a href="<?php echo PATH; ?>admin-auction/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span>
					</a>
			</li> */ ?>

        <li>
        <a href="<?php echo PATH; ?>admin-auction/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>admin-auction/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>admin-auction/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>
<?php }?>
      <?php /*<li onclick="toggle(15)" <?php if(isset($this->auction_cod_trans)){ ?> class="menu_active"  <?php } ?> >
        
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['ACT_COD']; ?>"><span class="category_management fl"><?php echo $this->Lang['ACT_COD']; ?></span><img id="left_menubutton_15" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_15">
			<li>
        
        <a href="<?php echo PATH; ?>admin-cod-auction/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			
            <li>
        
        <a href="<?php echo PATH; ?>admin-cod-auction/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>admin-cod-auction/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>admin-cod-auction/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>*/?>
  
      <!--
  <?php /*if(ADMIN_PRIVILEGES_FUNDREQUEST){
      
    <div class="menu_title"><p> <img style="float:left;padding:0px 0px 10px 10px;" src="<?php echo PATH ?>images/title_fund_request.png" alt="title_fund_request"/><span><?php echo $this->Lang['FUND_REQ']; ?></span></p></div>

	<li <?php if(isset($this->all_fund)){ ?> class="menu_active"  <?php } ?>>
        
        <a href="<?php echo PATH; ?>admin/all-fund-request.html" class="menu_rgt" title="<?php echo $this->Lang["WITH_DRAW_ALL"]; ?>"><span class="withdraw_fund_request"><?php echo $this->Lang["WITH_DRAW_ALL"]; ?></span></a></li>
	<li <?php if(isset($this->approved_fund)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/approved-fund-request.html" class="menu_rgt" title="<?php echo $this->Lang["WITH_DRAW_APP"]; ?>"><span class="withdraw_fund_request"><?php echo $this->Lang["WITH_DRAW_APP"]; ?></span></a></li>
	<li <?php if(isset($this->reject_fund)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/reject-fund-request.html" class="menu_rgt" title="<?php echo $this->Lang["WITH_DRAW_REG"]; ?>"><span class="withdraw_fund_request"><?php echo $this->Lang["WITH_DRAW_REG"]; ?></span></a></li>
	<li <?php if(isset($this->success_fund)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/success-fund-request.html" class="menu_rgt" title="<?php echo $this->Lang["WITH_DRAW_SUCC"]; ?>"><span class="withdraw_fund_request"><?php echo $this->Lang["WITH_DRAW_SUCC"]; ?></span></a></li>
	<li <?php if(isset($this->failed_fund)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/failed-fund-request.html" class="menu_rgt" title="<?php echo $this->Lang["WITH_DRAW_FAIL"]; ?>"><span class="withdraw_fund_request"><?php echo $this->Lang["WITH_DRAW_FAIL"]; ?></span></a></li>

  	
	<?php } */
	}?>
	<?php   if(isset($this->blog_act) && ADMIN_PRIVILEGES_BLOG){ ?>

    <li <?php if(isset($this->publish_blog)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/manage-publish-blog.html" class="menu_rgt" title="<?php echo $this->Lang['MANAGE_PUB_BLOGS']; ?>"><span class="withdraw_fund_request"><?php echo $this->Lang['MANAGE_PUB_BLOGS']; ?></span></a></li>
        <?php if(ADMIN_PRIVILEGES_BLOG_ADD){?>
	<li <?php if(isset($this->add_blog)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/add-blog.html" class="menu_rgt" title="<?php echo $this->Lang['ADD_BLOG']; ?>"><span class="withdraw_fund_request"><?php echo $this->Lang['ADD_BLOG']; ?></span></a></li>
        <?php } ?>
	
	<li <?php if(isset($this->draft_blog)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/manage-draft-blog.html" class="menu_rgt" title="<?php echo $this->Lang['MANAGE_DRAFTED_BLOGS']; ?>"><span class="withdraw_fund_request"><?php echo $this->Lang['MANAGE_DRAFTED_BLOGS']; ?></span></a></li>
        <?php if($this->user_type==1 || $this->user_type==2){?>
	<li <?php if(isset($this->blog_set)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/blog-settings.html" class="menu_rgt" title="<?php echo $this->Lang['BLOG_SETTINGS']; ?>"><span class="withdraw_fund_request"><?php echo $this->Lang['BLOG_SETTINGS']; ?></span></a></li>
        <?php } ?>


	<?php } ?>
	<?php if($this->user_type==1 || $this->user_type==2){?>
		<?php   if(isset($this->customer_care_act) && ADMIN_PRIVILEGES_CUSTOMERCARE){ ?>
       
	<li <?php if(isset($this->dashboard_customer_care)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/customer-care-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['CUSTM_DASH']; ?>"><span class="customer_comments"><?php echo $this->Lang['CUSTM_DASH']; ?></span></a></li>
        
    <?php if(ADMIN_PRIVILEGES_CUSTOMERCARE_ADD){?>    
	<li <?php if(isset($this->add_users)){ ?> class="menu_active"  <?php } ?> >
        <a href="<?php echo PATH; ?>admin/add-customer-care.html" class="menu_rgt" title="<?php echo $this->Lang['ADD_CUSTOMER_CARE']; ?>"><span class="customer_comments"><?php echo $this->Lang['ADD_CUSTOMER_CARE']; ?></span></a></li>
     <?php }?>
     
	<li <?php if(isset($this->manage_customer_care)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/manage-customer-care.html" class="menu_rgt" title="<?php echo $this->Lang["MANAGE_CUSTOMER_CARE"]; ?>"><span class="customer_comments"><?php echo $this->Lang["MANAGE_CUSTOMER_CARE"]; ?></span></a></li>
        <?php } ?>
        
        <?php   if($this->user_type==1 && isset($this->moderator_act)){ ?>
		<li <?php if(isset($this->dashboard_moderator)){ ?> class="menu_active"  <?php } ?> >
			<a href="<?php echo PATH; ?>admin/moderator-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['CUSTM_DASH']; ?>"><span class="customer_comments"><?php echo $this->Lang['CUSTM_DASH']; ?></span></a></li>
		<li <?php if(isset($this->add_moderator)){ ?> class="menu_active"  <?php } ?> >
			<a href="<?php echo PATH; ?>admin/add-moderator.html" class="menu_rgt" title="<?php echo $this->Lang['ADD_MODE']; ?>"><span class="customer_comments"><?php echo $this->Lang['ADD_MODE']; ?></span></a></li>
		<li <?php if(isset($this->manage_moderator)){ ?> class="menu_active"  <?php } ?> >
			<a href="<?php echo PATH; ?>admin/manage-moderator.html" class="menu_rgt" title="<?php echo $this->Lang["MANAGE_MODE"]; ?>"><span class="customer_comments"><?php echo $this->Lang["MANAGE_MODE"]; ?></span></a></li>
      <?php } 
      } ?>
	<?php if(isset($this->deals_act)||isset($this->products_act)|| isset($this->auction_act)||isset($this->users_act)||isset($this->merchant_act)||isset($this->transactions_act)||isset($this->blog_act)||isset($this->customer_care_act) || isset($this->moderator_act)){ }else {?>
	<?php if($this->user_type==1){ ?>
    
      <li <?php if(isset($this->general_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/general-settings.html" class="menu_rgt" title="<?php echo $this->Lang['GEN_SETTING']; ?>"><span class="bg_general pl15"><?php echo $this->Lang["GEN_SETTING"]; ?></span></a></li>
	<li <?php if(isset($this->email_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/email-settings.html" class="menu_rgt" title="<?php echo $this->Lang['EML_CNT_SET']; ?>"><span class="email_settings"><?php echo $this->Lang["EML_CNT_SET"]; ?></span></a></li>
      <li <?php if(isset($this->smtp_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/smtp-mailer-settings.html" class="menu_rgt" title="<?php echo $this->Lang['SMTP_MAIL']; ?>"><span class="mailer_settings"><?php echo $this->Lang["SMTP_MAIL"]; ?></span></a></li>
	<li <?php if(isset($this->socialmedia_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/social-media-settings.html" class="menu_rgt" title="<?php echo $this->Lang['SMP_SET']; ?>"><span class="social_media"><?php echo $this->Lang["SMP_SET"]; ?></span></a></li>
        <li <?php if(isset($this->payment_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/payment-settings.html" class="menu_rgt" title="<?php echo $this->Lang['PAY_SET']; ?>"><span class="payment_settings"><?php echo $this->Lang["PAY_SET"]; ?></span></a></li>
        <?php /*<li <?php if(isset($this->shipping_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>admin/shipping-account-settings.html" class="menu_rgt" title="<?php echo $this->Lang['SHIPP_ACC_SETT']; ?>"><span class="payment_settings"><?php echo $this->Lang["SHIPP_ACC_SETT"]; ?></span></a></li>*/ ?>
	<li <?php if(isset($this->module_settings)){ ?> class="menu_active"  <?php } ?> > 
        
        <a href="<?php echo PATH; ?>admin/module-settings.html" class="menu_rgt" title="<?php echo $this->Lang['MOD_SET'];  ?>"><span class="payment_settings"><?php echo $this->Lang['MOD_SET'];  ?></span></a></li>
     <li onclick="toggle(11)" <?php if(isset($this->image_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['IMG_SET']; ?>"><span class="img_settings fl"><?php echo $this->Lang["IMG_SET"]; ?></span><img id="left_menubutton_11" src="<?php echo PATH; ?>images/plus_but.png" alt="image" /></a>
        <ul class="toggleul_11">
          <li>
            
            <a href="<?php echo PATH; ?>admin/logo-settings.html" class="menu_rgt1" title="<?php echo $this->Lang['LOGO_SET']; ?>"><span class="pl15"><?php echo $this->Lang["LOGO_SET"]; ?></span></a></li>
          <li>
            
            <a href="<?php echo PATH; ?>admin/favicon-settings.html" class="menu_rgt1" title="<?php echo $this->Lang['FAV_SET']; ?>"><span class="pl15"><?php echo $this->Lang["FAV_SET"]; ?></span></a></li>
          <li>
            
            <a href="<?php echo PATH; ?>admin/noimage-settings.html" class="menu_rgt1" title="<?php echo $this->Lang['NO_IMG_LEFT']; ?>"><span class="pl15"><?php echo $this->Lang["NO_IMG_LEFT"]; ?></span></a></li>
			<li>
            
            <a href="<?php echo PATH; ?>admin/image-zoom-settings.html" class="menu_rgt1" title="<?php echo $this->Lang['IM_ZOOM_SETT']; ?>"><span class="pl15"><?php echo $this->Lang['IM_ZOOM_SETT']; ?></span></a></li>
        </ul>
      </li>
       <?php } ?>
       <?php if(ADMIN_PRIVILEGES_BANNER){?>
       
		<li onclick="toggle(23)" <?php if(isset($this->banner_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['BANNER_IM_SETT']; ?>"><span class="img_settings fl"><?php echo $this->Lang['BANNER_IM_SETT']; ?></span><img id="left_menubutton_23" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_23">
			<?php if(ADMIN_PRIVILEGES_BANNER_ADD){?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/add-banner-image.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_BANN_IMG']; ?>"><span class="pl15"><?php echo $this->Lang['ADD_BANN_IMG']; ?></span></a></li>
            <?php }?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/manage-banner-images.html" class="menu_rgt1" title="<?php echo $this->Lang['MANAGE_BA_IMAGE']; ?>"><span class="pl15"><?php echo $this->Lang['MANAGE_BA_IMAGE']; ?></span></a></li>
          
        </ul>
      </li>
      <?php }?>
      <?php if(ADMIN_PRIVILEGES_ATTRIBUTS){?>
		<li onclick="toggle(19)" <?php if(isset($this->color_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['ATTRI_MANA']; ?>"><span class="img_settings fl"><?php echo $this->Lang['ATTRI_MANA']; ?></span><img id="left_menubutton_19" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_19">
			<?php if(ADMIN_PRIVILEGES_ATTRIBUTS_ADD){?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/add-color.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_COLOR']; ?>"><span class="pl15"><?php echo $this->Lang['ADD_COLOR']; ?></span></a></li>
            <?php }?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/manage-colors.html" class="menu_rgt1" title="<?php echo $this->Lang['MANA_COLORS']; ?>"><span class="pl15"><?php echo $this->Lang['MANA_COLORS']; ?></span></a></li>
            <?php if(ADMIN_PRIVILEGES_ATTRIBUTS_ADD){?>
            <li>
            
            <a href="<?php echo PATH; ?>admin/add-size.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_SIZE']; ?>"><span class="pl15"><?php echo $this->Lang['ADD_SIZE']; ?></span></a></li>
            <?php }?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/manage-sizes.html" class="menu_rgt1" title="<?php echo $this->Lang['MANA_SIZE']; ?>"><span class="pl15"><?php echo $this->Lang['MANA_SIZE']; ?></span></a></li>

          
        </ul>
      </li>
      <?php }  ?>

		<?php if(ADMIN_PRIVILEGES_SPECIFICATION){?>
		<li onclick="toggle(22)" <?php if(isset($this->attributegroup_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['SPEC_MGT']; ?>"><span class="img_settings fl"><?php echo $this->Lang['SPEC_MGT']; ?></span><img id="left_menubutton_22" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_22">
			<?php if(ADMIN_PRIVILEGES_SPECIFICATION_ADD){ ?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/add-attribute-group.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_ATTR_GROUP_LABEL']; ?>"><span class="pl15"><?php echo $this->Lang['ADD_ATTR_GROUP_LABEL']; ?></span></a></li>
            <?php } ?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/manage-attribute-group.html" class="menu_rgt1" title="<?php echo $this->Lang['MANA_ATTR_GROUP']; ?>"><span class="pl15"><?php echo $this->Lang['MANA_ATTR_GROUP']; ?></span></a></li>
            <?php if(ADMIN_PRIVILEGES_SPECIFICATION_ADD){ ?>
            
            <li>
            
            <a href="<?php echo PATH; ?>admin/add-attribute.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_ATTR_LABEL']; ?>"><span class="pl15"><?php echo $this->Lang['ADD_ATTR_LABEL']; ?></span></a></li>
            <?php } ?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/manage-attribute.html" class="menu_rgt1" title="<?php echo $this->Lang['MANA_ATTR']; ?>"><span class="pl15"><?php echo $this->Lang['MANA_ATTR']; ?></span></a></li>
          
        </ul>
      </li>
	<?php }?>
	<?php if(ADMIN_PRIVILEGES_COUNTRY){?>
      <li onclick="toggle(1)" <?php if(isset($this->country)){ ?> class="menu_active"  <?php } ?>>
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['COUNTRY_MANAGE']; ?>"><span class="country_management fl"><?php echo $this->Lang["COUNTRY_MANAGE"]; ?></span><img id="left_menubutton_1" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_1">
			<?php if(ADMIN_PRIVILEGES_COUNTRY_ADD){?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/add-country.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_COUNTRY']; ?>"><span class="pl15"><?php echo $this->Lang["ADD_COUNTRY"]; ?></span></a></li>
            <?php } ?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/manage-country.html" class="menu_rgt1" title="<?php echo $this->Lang['MANAGE_COUNTRY']; ?>"><span class="pl15"><?php echo $this->Lang["MANAGE_COUNTRY"]; ?></span></a></li>
        </ul>
      </li>
      <?php }?>
      <?php if(ADMIN_PRIVILEGES_CITY){?>
      <li onclick="toggle(2)" <?php if(isset($this->city)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['CITY_MANAGE']; ?>"><span class="city_management fl"><?php echo $this->Lang["CITY_MANAGE"]; ?></span><img id="left_menubutton_2" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_2">
			<?php if(ADMIN_PRIVILEGES_CITY_ADD){?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/add-city.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_CITY']; ?>"><span class="pl15"><?php echo $this->Lang["ADD_CITY"]; ?></span></a></li>
            <?php } ?>
          <li>
            
            <a href="<?php echo PATH; ?>admin/manage-city.html" class="menu_rgt1" title="<?php echo $this->Lang['MANAGE_CITY']; ?>"><span class="pl15"><?php echo $this->Lang["MANAGE_CITY"]; ?></span></a></li>
        </ul>
      </li>
      <?php }?>
      <?php if(ADMIN_PRIVILEGES_CATEGORIES){?>
      <li onclick="toggle(3)" <?php if(isset($this->category)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['CATEGORY_MANAGE']; ?>"><span class="category_management fl"><?php echo $this->Lang["CATEGORY_MANAGE"]; ?></span><img id="left_menubutton_3" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_3">
			<?php if(ADMIN_PRIVILEGES_CATEGORIES_ADD){?>
            <li>
                
                <a href="<?php echo PATH; ?>admin/add-category.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_CATEGORY']; ?>"><span class="pl15"><?php echo $this->Lang["ADD_CATEGORY"]; ?></span></a></li>
                <?php } ?>
                <li>
                
                	<a href="<?php echo PATH; ?>admin/manage-category.html" class="menu_rgt1" title="<?php echo $this->Lang['MANAGE_CAT']; ?>"><span class="pl15"><?php echo $this->Lang["MANAGE_CAT"]; ?></span></a>
            </li>
        </ul>
      </li>
      <?php }?>
      
      <?php if(ADMIN_PRIVILEGES_SECTOR){?>
      <li onclick="toggle(4)" <?php if(isset($this->sector_settings)){ ?> class="menu_active"  <?php } ?>>
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['SECTOR_MANAGE']; ?>"><span class="cms fl"><?php echo $this->Lang["SECTOR_MANAGE"]; ?></span><img id="left_menubutton_4" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>"/></a>
        <ul class="toggleul_4">
			<?php if(ADMIN_PRIVILEGES_SECTOR_ADD){?>

          <li>
            <a href="<?php echo PATH; ?>admin/add-sector.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_SECTOR']; ?>"><span class="pl15"><?php echo $this->Lang["ADD_SECTOR"]; ?></span></a></li>
            <?php } ?>

          <li>
            <a href="<?php echo PATH; ?>admin/manage-sector.html" class="menu_rgt1" title="<?php echo $this->Lang['MANAGE_SECTOR']; ?>"><span class="pl15"><?php echo $this->Lang["MANAGE_SECTOR"]; ?></span></a></li>

        </ul>
      </li>
      <?php }?>
      
      <?php if(ADMIN_PRIVILEGES_CMS){?>
      <li onclick="toggle(10)" <?php if(isset($this->cms_act)){ ?> class="menu_active"  <?php } ?>>
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['CMS_MANAGE']; ?>"><span class="cms fl"><?php echo $this->Lang["CMS_MANAGE"]; ?></span><img id="left_menubutton_10" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>"/></a>
        <ul class="toggleul_10">
			<?php if(ADMIN_PRIVILEGES_CMS_ADD){?>
        
          <li>
            <a href="<?php echo PATH; ?>cms/add-pages.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_PAG']; ?>"><span class="pl15"><?php echo $this->Lang["ADD_PAG"]; ?></span></a></li>
            <?php } ?>
            
          <li>
            <a href="<?php echo PATH; ?>cms/manage-pages.html" class="menu_rgt1" title="<?php echo $this->Lang['MANAGE_PAG']; ?>"><span class="pl15"><?php echo $this->Lang["MANAGE_PAG"]; ?></span></a></li>
            <?php if($this->user_type==1 || $this->user_type==2){?>
            
          <li>
            <a href="<?php echo PATH; ?>cms/about-us.html" class="menu_rgt1" title="<?php echo $this->Lang['ABT']; ?>"><span class="pl15"><?php echo $this->Lang["ABT"]; ?></span></a></li>
            <?php } ?>
              
        </ul>
      </li>
      <?php }?>
     <?php /* <li onclick="toggle(8)">
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['NEWSLETTER']; ?>"><span class="news_letter fl"><?php echo $this->Lang["NEWSLETTER"]; ?></span><img id="left_menubutton_8" src="<?php echo PATH; ?>images/plus_but.png" /></a>
        <ul class="toggleul_8">
          <li>
            
            <a href="<?php echo PATH; ?>admin/subscribed-user.html" class="menu_rgt1" title="<?php echo $this->Lang['NEWS_LET_SUB']; ?>"><span class="pl15"><?php echo $this->Lang["NEWS_LET_SUB"]; ?></span></a></li>
          <li>
            
            <a href="<?php echo PATH; ?>admin/send-newsletter.html" class="menu_rgt1" title="<?php echo $this->Lang['SEND_NEWSL']; ?>"><span class="pl15"><?php echo $this->Lang["SEND_NEWSL"]; ?></span></a></li>
        </ul> 
      </li> */ ?>
      <?php if(ADMIN_PRIVILEGES_ADS){?>
      <li onclick="toggle(12)" <?php if(isset($this->ads_act)){ ?> class="menu_active"  <?php } ?>>
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['ADD_MGMT']; ?>"><span class="ads_management fl"><?php echo $this->Lang["ADD_MGMT"]; ?></span><img id="left_menubutton_12" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>"/></a>
        <ul class="toggleul_12">
			<?php if(ADMIN_PRIVILEGES_ADS_ADD){?>
          <li>
			  
            
            <a href="<?php echo PATH; ?>adds_mgmt/add_adds.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_ADDS']; ?>"><span class="pl15"><?php echo $this->Lang["ADD_ADDS"]; ?></span></a></li>
            <?php } ?>
          <li>
            
            <a href="<?php echo PATH; ?>adds_mgmt/manage_adds.html" class="menu_rgt1" title="<?php echo $this->Lang['MANAGE_ADDS']; ?>"><span class="pl15"><?php echo $this->Lang["MANAGE_ADDS"]; ?></span></a></li>
        </ul>
      </li>
	<?php }?>
	<!-- FAQ START-->

<?php if(ADMIN_PRIVILEGES_FAQ){?>
      <li onclick="toggle(21)" <?php if(isset($this->faq_act)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['FAQ']; ?>"><span class="faq_management fl"><?php echo $this->Lang['FAQ']; ?></span><img id="left_menubutton_21" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_21">
			<?php if(ADMIN_PRIVILEGES_FAQ_ADD){?>
          <li>
			  
            
            <a href="<?php echo PATH; ?>faq_mgt/add_faq.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_FAQ']; ?>"><span class="pl15"><?php echo $this->Lang['ADD_FAQ']; ?></span></a></li>
            <?php } ?>
          <li>
            
            <a href="<?php echo PATH; ?>faq_mgt/manage_faq.html" class="menu_rgt1" title="<?php echo $this->Lang['MAG_FAQ']; ?>"><span class="pl15"><?php echo $this->Lang['MAG_FAQ']; ?></span></a></li>
        </ul>
      </li>
<?php }?>
	<!-- FAQ END-->	
	<!--NEWS LETTER STARTS-->
	<?php if(ADMIN_PRIVILEGES_NEWSLETTER){?>
      <li onclick="toggle(18)" <?php if(isset($this->newsletter_act)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['NEWSLETTER']; ?>"><span class="faq_management fl"><?php echo $this->Lang['NEWSLETTER']; ?></span><img id="left_menubutton_18" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_18">
			<?php if(ADMIN_PRIVILEGES_NEWSLETTER_ADD){?>
			<li><a href="<?php echo PATH; ?>admin/add-template.html" class="menu_rgt1" title="<?php echo $this->Lang['SEND_NEWSL']; ?>"><span class="news_letter"><?php echo $this->Lang["ADD_TEMPLATE"]; ?></span></a></li>
			<?php }?>
			<li><a href="<?php echo PATH; ?>admin/manage-template.html" class="menu_rgt1" title="<?php echo $this->Lang['SEND_NEWSL']; ?>"><span class="news_letter"><?php echo $this->Lang["MANAGE_TEMPLATE"]; ?></span></a></li>
			<?php if(ADMIN_PRIVILEGES_DAILY_NEWSLETTER){?>
			<li><a href="<?php echo PATH; ?>admin/send-newsletter.html" class="menu_rgt1" title="<?php echo $this->Lang['SEND_NEWSL']; ?>"><span class="news_letter"><?php echo $this->Lang["SEND_NEWSL"]; ?></span></a></li>
			<?php }?>
          <?php /* <li>
            
             <a href="<?php echo PATH; ?>admin/subscribed-user.html" class="menu_rgt1" title="<?php echo $this->Lang['MANG_SUBS']; ?>"><span class="news_letter"><?php echo $this->Lang["MANG_SUBS"]; ?></span></a></li> */ ?>
        </ul>
      </li>
      <?php } ?>
   	<!--NEWS LETTER END-->
   

	<?php } ?>
      </ul>  
    
  </div>
</div>
<script type="text/javascript">
function toggle(ids){
	$(".toggleul_"+ids).slideToggle();
	var imgSrc = document.getElementById("left_menubutton_"+ids).src;
	img_sr = imgSrc.split("/");
	var ar_count = img_sr.length;
	var imgpath = img_sr[ar_count-1];
	
	//imgSrc = imgSrc.substr(-13, 13);
	if(imgpath == "minus_but.png"){
		document.getElementById("left_menubutton_"+ids).src = "<?php echo PATH; ?>images/plus_but.png"
	} else {
		document.getElementById("left_menubutton_"+ids).src = "<?php echo PATH; ?>images/minus_but.png"
	}
			
}
</script>
