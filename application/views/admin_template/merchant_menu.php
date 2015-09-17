<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<script type="text/javascript">
function toggle(ids){
	$(".toggleul_"+ids).slideToggle();
	var imgSrc = document.getElementById("left_menubutton_"+ids).src;
	imgSrc = imgSrc.substr(-13, 13);
	if(imgSrc == "minus_but.png"){
		document.getElementById("left_menubutton_"+ids).src = "<?php echo PATH; ?>images/plus_but.png"
	}
	else{
		document.getElementById("left_menubutton_"+ids).src = "<?php echo PATH; ?>images/minus_but.png"
	}		
}
</script>
<div class="menu">
  <div class="menu_container">
	  
	  <?php if(PRIVILEGES_DEALS==1){?>
    <?php if(isset($this->mer_deals_act)){ ?>
	 <div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_deals.png" alt="<?php echo $this->Lang['DEALS']; ?>"/><span><?php echo $this->Lang['DEALS']; ?></span></p></div>
	<?php }}?>
	<?php if(PRIVILEGES_PRODUCTS==1){?>
	<?php if(isset($this->mer_products_act)){ ?>
	 <div class="menu_title"><p><img src="<?php echo PATH ?>images/title_products.png" alt="<?php echo $this->Lang['PRODUCTS']; ?>"/><span><?php echo $this->Lang['PRODUCTS']; ?></span></p></div>
	<?php }} ?>
	<?php if(isset($this->mer_auction_act)){ ?>
	 <div class="menu_title"><p><img src="<?php echo PATH ?>images/title_products.png" alt="<?php echo $this->Lang['AUCTION']; ?>"/><span><?php echo $this->Lang['AUCTION']; ?></span></p></div>
	<?php } ?>
	<?php if(PRIVILEGES_AUCTIONS==1){ ?>
	<?php if(isset($this->mer_merchant_act)){ ?>
	 <div class="menu_title"><p><img src="<?php echo PATH ?>images/title_merchant.png" alt="<?php echo $this->Lang['SHOP']; ?>"/><span><?php echo $this->Lang['SHOP']; ?></span></p></div>
	<?php }} ?>
	<?php if(PRIVILEGES_TRANSACTIONS==1){?>
	<?php if(isset($this->mer_transactions_act)){ ?>
	 <div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_balance.png" alt="<?php echo $this->Lang['TRANS']; ?>"/><span><?php echo $this->Lang['TRANS']; ?></span></p></div>
	<?php }} ?>
	<?php if(PRIVILEGES_FUNDREQUEST==1){ ?>
	<?php if(isset($this->mer_fund_act)){ ?>
	 <div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_fund_request.png" alt="<?php echo $this->Lang['FUND_REQ']; ?>"/><span><?php echo $this->Lang['FUND_REQ']; ?></span></p></div>
	<?php } }?>
	<?php if(isset($this->mer_settings_act)){ ?>
	 <div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_module_settings.png" alt="<?php echo $this->Lang['SETTINGS']; ?>" /><span><?php echo $this->Lang['SETTINGS']; ?></span></p></div>
	<?php } ?>
	<?php if($this->user_type==3){?>
	<?php if(isset($this->mer_moderator_act)){ ?>
	 <div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_module_settings.png" alt="<?php echo $this->Lang['MERCHANT_MODERATOR']; ?>" /><span><?php echo $this->Lang['MERCHANT_MODERATOR']; ?></span></p></div>
	<?php }} ?>
    <ul>   
        
        <?php if(PRIVILEGES_DEALS==1){?>
        <?php if(isset($this->mer_deals_act)){ ?>
        <li <?php if(isset($this->dashboard_deals)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/deals-dashboard.html" title="<?php echo $this->Lang['DEAL_DASH']; ?>"><span class="fund_management fl"><?php echo $this->Lang['DEAL_DASH']; ?></span></a></li>
        <?php if(PRIVILEGES_DEALS_ADD==1){?>
        <li <?php if(isset($this->add_deal)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/add-deals.html" title="<?php echo $this->Lang["ADD_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ADD_DEALS"]; ?></span></a></li>
        <?php } ?>
        <li <?php if(isset($this->manage_deals)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/manage-deals.html" title="<?php echo $this->Lang["MANAGE_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["MANAGE_DEALS"]; ?></span></a></li>
        <li <?php if(isset($this->archive_deals)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/archive-deals.html" title="<?php echo $this->Lang["ARCHIVE_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ARCHIVE_DEALS"]; ?></span></a></li>        
        <li <?php if(isset($this->couopn_code)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/couopn_code.html" title="<?php echo $this->Lang["COUPON_VALIDATE"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["COUPON_VALIDATE"]; ?></span></a></li>
        <li <?php if(isset($this->close_code)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/close-couopn-list.html" title="<?php echo $this->Lang["REDEM_COU_LI"]; ?>"><span class="fund_management fl"><?php echo $this->Lang['REDEM_COU_LI']; ?></span></a></li>
        <?php } }?>
		<?php if(PRIVILEGES_PRODUCTS==1){?>
        <?php if(isset($this->mer_products_act)){ ?>
        <li <?php if(isset($this->dashboard_products)){ ?> class="menu_active"  <?php } ?>>
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/products-dashboard.html" title="<?php echo $this->Lang['PRODUCT_DASH']; ?>"><span class="fund_management fl"><?php echo $this->Lang['PRODUCT_DASH']; ?></span></a></li>
        <?php if(PRIVILEGES_PRODUCTS_ADD){?>
        <li <?php if(isset($this->add_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/add-products.html" title="<?php echo $this->Lang["ADD_PRODUCTS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ADD_PRODUCTS"]; ?></span></a></li>
        <?php } ?>
        <li <?php if(isset($this->manage_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/manage-products.html" title="<?php echo $this->Lang["MANAGE_PRODUCTS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["MANAGE_PRODUCTS"]; ?></span></a></li>
        <li <?php if(isset($this->archive_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/sold-products.html" title="<?php echo $this->Lang["ARCHIVE_PRODUCTS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ARCHIVE_PRODUCTS"]; ?></span></a></li>
        <li <?php if(isset($this->import_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/product-import.html" title="<?php echo $this->Lang["PRODUCT_IMPORT"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["PRODUCT_IMPORT"]; ?></span></a></li>
        <?php if(PRIVILEGES_GIFT==1){?>
        <?php if(PRIVILEGES_GIFT_ADD==1){?>
        <li <?php if(isset($this->add_free_gift)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/add-free-gift.html" title="<?php echo $this->Lang["ADD_FREE_GIFT"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ADD_FREE_GIFT"]; ?></span></a></li>
        <?php } ?>
        <li <?php if(isset($this->manage_free_gift)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/manage-free-gift.html" title="<?php echo $this->Lang["MANAGE_FREE_GIFT"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["MANAGE_FREE_GIFT"]; ?></span></a></li>
        <?php } ?>
       <li <?php if(isset($this->shipping_delivery)){ ?> class="menu_active"  <?php } ?> >
        <a href="<?php echo PATH; ?>merchant/shipping-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['SHIP_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['SHIP_DEL']; ?></span></a></li>
        
        <li onclick="toggle(16)" <?php if(isset($this->storecredit)){ ?> class="menu_active"  <?php } ?> >        
			<a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['STR_CRD_ORD']; ?>"><span class="category_management fl"><?php echo $this->Lang['STR_CRD_ORD']; ?></span><img id="left_menubutton_16" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
			<ul class="toggleul_16">
				<li><a href="<?php echo PATH; ?>merchant/storecredit/pending-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['PEN_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['PEN_ORD']; ?></span></a></li>			
				<li><a href="<?php echo PATH; ?>merchant/storecredit/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['APPR_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['APPR_ORD']; ?></span></a></li>
                <li><a href="<?php echo PATH; ?>merchant/storecredit/purchase-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['PURCH_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['PURCH_ORD']; ?></span></a></li>
				<li><a href="<?php echo PATH; ?>merchant/storecredit/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAIL_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['FAIL_ORD']; ?></span></a></li>
			</ul>
		</li>
        
         <?php /*<li <?php if(isset($this->cash_delivery)){ ?> class="menu_active"  <?php } ?> >
        <a href="<?php echo PATH; ?>merchant/cash-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['CASH_ON_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['CASH_ON_DEL']; ?></span></a></li>
        <li onclick="toggle(4)" <?php if(isset($this->free_gift)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['SPENT_FREE_GIFT']; ?>"><span class="category_management fl"><?php echo $this->Lang["SPENT_FREE_GIFT"]; ?></span><img id="left_menubutton_3" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_4">
            <li>
                <a href="<?php echo PATH; ?>merchant/add-free-gift.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_FREE_GIFT']; ?>"><span class="pl15"><?php echo $this->Lang["ADD_FREE_GIFT"]; ?></span></a></li>
                <li>
                <a href="<?php echo PATH; ?>merchant/manage-free-gift.html" class="menu_rgt1" title="<?php echo $this->Lang['MANAGE_FREE_GIFT']; ?>"><span class="pl15"><?php echo $this->Lang["MANAGE_FREE_GIFT"]; ?></span></a>
            </li>
        </ul>
      </li>*/ ?>
      
      
        <?php }} ?>
        <?php if(PRIVILEGES_AUCTIONS==1){?>
        <?php   if(isset($this->mer_auction_act)){ ?>
        <li <?php if(isset($this->auction_products)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant/auction-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['ACT_DASH']; ?>"><span class="customer_comments"><?php echo $this->Lang['ACT_DASH']; ?></span></a></li>
        <?php if(PRIVILEGES_AUCTIONS_ADD==1){?>
        <li <?php if(isset($this->add_auction)){ ?> class="menu_active"  <?php } ?>>        
        <a href="<?php echo PATH; ?>merchant/add-auction.html" class="menu_rgt" title="<?php echo $this->Lang['ADD_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['ADD_ACT_PRO']; ?></span></a></li>
        <?php } ?>
        <li <?php if(isset($this->manage_auction)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant/manage-auction.html" class="menu_rgt" title="<?php echo $this->Lang['MAG_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['MAG_ACT_PRO']; ?></span></a></li>
        <li <?php if(isset($this->archive_auction)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant/archive-auction.html" class="menu_rgt" title="<?php echo $this->Lang['ARCH_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['ARCH_ACT_PRO']; ?></span></a></li>
        <li <?php if(isset($this->winner)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant-auction/winner-list.html" class="menu_rgt" title="<?php echo $this->Lang['WIN_LIST2']; ?>"><span class="customer_comments"><?php echo $this->Lang['WIN_LIST2']; ?></span></a></li>
        <li <?php if(isset($this->shipping_delivery)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant-auction/shipping-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['SHIP_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['SHIP_DEL']; ?></span></a></li>        
       <?php /* <li <?php if(isset($this->cod_delivery)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant-auction/cod-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['CASH_ON_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['CASH_ON_DEL']; ?></span></a></li>*/?>
        <?php }}  ?>

        <?php if(isset($this->mer_merchant_act)){ ?>
        <li <?php if(isset($this->manage_merchant_shop)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/manage-shop.html" title="<?php echo $this->Lang["MANAGE_SHOP"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["MANAGE_SHOP"]; ?></span></a></li>
        <?php if(PRIVILEGES_SHOPS_ADD==1){?>
        <li <?php if(isset($this->add_merchant_shop)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/add-shop.html" title="<?php echo $this->Lang['ADD_SHOPS']; ?>"><span class="fund_management fl"><?php echo $this->Lang['ADD_SHOPS']; ?></span></a></li>
        <?php } ?>
       
        <?php if(PRIVILEGES_RETURN_POLICY_EDIT==1){?>
        <li <?php if(isset($this->return_policy)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/return-policy.html" title="<?php echo $this->Lang['RET_POL']; ?>"><span class="fund_management fl"><?php echo $this->Lang['RET_POL']; ?></span></a></li>
        <?php } ?>
        <?php if(PRIVILEGES_ABOUT_US_EDIT==1){?>
        <li <?php if(isset($this->about_us)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/warranty.html" title="<?php echo $this->Lang['WARRANTY']; ?>"><span class="fund_management fl"><?php echo $this->Lang['WARRANTY']; ?></span></a></li>
        <?php } ?>
	 <?php if(PRIVILEGES_TERMS_AND_CONDITIONS_EDIT==1){?>
        <li <?php if(isset($this->terms_and_conditions)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/terms-and-conditions.html" title="<?php echo $this->Lang['SHIP_ING']; ?>"><span class="fund_management fl"><?php echo $this->Lang['SHIP_ING']; ?></span></a></li>
        <?php } ?>
        <?php /*if(PRIVILEGES_PERSONALIZED_STORE_EDIT==1){?>
        <li <?php if(isset($this->store_personalized)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/store-personalized.html" title="<?php echo $this->Lang['STORE_PERSONALIZED']; ?>"><span class="fund_management fl"><?php echo $this->Lang['STORE_PERSONALIZED']; ?></span></a></li>
        <?php } */?>
        
        <?php } ?>
        
        <?php if (PRIVILEGES_TRANSACTIONS) { ?>
     <?php if((PRIVILEGES_DEALS)||(PRIVILEGES_PRODUCTS)||(PRIVILEGES_AUCTIONS)){ ?>
        
        <?php if(isset($this->mer_fund_act)){ ?>	
        <li <?php if(isset($this->manage_fund_request)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/fund_request.html" title="<?php echo $this->Lang["FUND_REQ_REP"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["FUND_REQ_REP"]; ?></span></a></li>
        <?php if(PRIVILEGES_FUNDREQUEST_EDIT==1){?>
        <li <?php if(isset($this->add_fund_request)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/add_fund_request.html" title="<?php echo $this->Lang["WITHDRAW_FUND"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["WITHDRAW_FUND"]; ?></span></a></li>
        <?php } }?>

	<?php   if(isset($this->mer_transactions_act)){ ?>    
	<li <?php if(isset($this->dashboard_transaction)){ ?> class="menu_active"  <?php } ?>>        
        <a href="<?php echo PATH; ?>merchant/transaction-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['TRANS_DASH']; ?>"><span class="payment_transactions"><?php echo $this->Lang['TRANS_DASH']; ?></span></a></li>	
        <?php if(PRIVILEGES_DEALS){ ?>	
		<li onclick="toggle(12)" <?php if(isset($this->deal_trans)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['DLS_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['DLS_TRANS']; ?></span><img id="left_menubutton_12" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_12">
			<li><a href="<?php echo PATH; ?>merchant/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>			
			<li>
        
        <a href="<?php echo PATH; ?>merchant/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span></a></li>
                    <li><a href="<?php echo PATH; ?>merchant/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li><a href="<?php echo PATH; ?>merchant/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li><a href="<?php echo PATH; ?>merchant/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>
      <?php } ?>
		<?php if(PRIVILEGES_PRODUCTS){ ?>
		<li onclick="toggle(11)" <?php if(isset($this->pro_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['PRO_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['PRO_TRANS']; ?></span><img id="left_menubutton_11" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_11">
			<li>
        
        <a href="<?php echo PATH; ?>merchant-product/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			<?php /* <li>
        		
        			<a href="<?php echo PATH; ?>merchant-product/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span>
					</a>
			</li> */ ?>
            <li>
        
        <a href="<?php echo PATH; ?>merchant-product/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>merchant-product/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>merchant-product/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>
      
		<?php /*<li onclick="toggle(13)" <?php if(isset($this->cod_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['PRO_COD']; ?>"><span class="category_management fl"><?php echo $this->Lang['PRO_COD']; ?></span><img id="left_menubutton_13" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_13">
			<li>
        
        <a href="<?php echo PATH; ?>merchant-cod/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			
            <li>
        
        <a href="<?php echo PATH; ?>merchant-cod/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>merchant-cod/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>merchant-cod/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>*/?>
      
      	<li onclick="toggle(14)" <?php if(isset($this->storecredits_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['PRD_STR_CRDS']; ?>"><span class="category_management fl"><?php echo $this->Lang['PRD_STR_CRDS']; ?></span><img id="left_menubutton_14" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_14">
			<li>
        
        <a href="<?php echo PATH; ?>merchant-storecredits/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
		<?php /*	
            <li>
        
        <a href="<?php echo PATH; ?>merchant-storecredits/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>merchant-storecredits/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>merchant-storecredits/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        */ ?>
        </ul>
      </li>
      
      <?php }?>
      <?php if(PRIVILEGES_AUCTIONS){ ?>
		<li onclick="toggle(10)" <?php if(isset($this->act_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['ACT_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['ACT_TRANS']; ?></span><img id="left_menubutton_10" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_10">
			<li>
        
        <a href="<?php echo PATH; ?>merchant-auction/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>

			<?php /* <li>
        		
        			<a href="<?php echo PATH; ?>merchant-auction/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span>
					</a>
			</li> */ ?>
			
            <li>
        
        <a href="<?php echo PATH; ?>merchant-auction/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>merchant-auction/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>merchant-auction/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>

     <?php /* <li onclick="toggle(15)" <?php if(isset($this->auction_cod_trans)){ ?> class="menu_active"  <?php } ?> >
        
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['ACT_COD']; ?>"><span class="category_management fl"><?php echo $this->Lang['ACT_COD']; ?></span><img id="left_menubutton_15" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_15">
			<li>
        
        <a href="<?php echo PATH; ?>merchant-cod-auction/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			
            <li>
        
        <a href="<?php echo PATH; ?>merchant-cod-auction/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>merchant-cod-auction/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>merchant-cod-auction/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>*/?>
      <?php } ?>
      
    <?php }}}?>


    <?php if(isset($this->mer_settings_act)){ ?>	
	
	    <li <?php if(isset($this->merchant_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/settings.html" title="<?php echo $this->Lang['SETTINGS']; ?>"><span class="fund_management fl"><?php echo $this->Lang['SETTINGS']; ?></span></a></li>
        <li <?php if(isset($this->edit_merchant)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/Edit_info.html" title="<?php echo $this->Lang['EDIT_ACC']; ?>"><span class="fund_management fl"><?php echo $this->Lang['EDIT_ACC']; ?></span></a></li>
        <li <?php if(isset($this->merchant_password)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/change_password.html" title="<?php echo $this->Lang['CHANGE_PASS']; ?>"><span class="fund_management fl"><?php echo $this->Lang['CHANGE_PASS']; ?></span></a></li>
        <?php if(PRIVILEGES_SHIPPING_MODULE==1){?>
        
        <li <?php if(isset($this->flat_amount)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/change_shipping_setting.html" title="<?php echo $this->Lang['SHIPP_MODULE'].' '.$this->Lang['SETTINGS']; ?>"><span class="fund_management fl"><?php echo $this->Lang['SHIPP_MODULE'].' '.$this->Lang['SETTINGS']; ?></span></a></li>
        <?php } ?>
 
         <li onclick="toggle(3)" <?php if(isset($this->duration)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['DUR_MANAGE']; ?>"><span class="category_management fl"><?php echo $this->Lang["DUR_MANAGE"]; ?></span><img id="left_menubutton_3" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_3">
			
            <li>
                
                <a href="<?php echo PATH; ?>merchant/add-duration.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_DUR']; ?>"><span class="pl15"><?php echo $this->Lang["ADD_DUR"]; ?></span></a></li>
            
                <li>
                
                	<a href="<?php echo PATH; ?>merchant/manage-duration.html" class="menu_rgt1" title="<?php echo $this->Lang['MANAGE_DUR']; ?>"><span class="pl15"><?php echo $this->Lang["MANAGE_DUR"]; ?></span></a>
            </li>
        </ul>
      </li>
       <?php if(PRIVILEGES_NEWSLETTER==1){?>
        <li  onclick="toggle(31)" <?php if(isset($this->news_letter) || isset($this->newsletter_act)){ ?> class="menu_active"  <?php } ?> >
        
			 <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['NEWSLETTER']; ?>"><span class="faq_management fl"><?php echo $this->Lang['NEWSLETTER']; ?></span><img id="left_menubutton_31" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
			<ul class="toggleul_31">
				<li><a href="<?php echo PATH; ?>merchant/add-template.html" class="menu_rgt1" title="<?php echo $this->Lang['SEND_NEWSL']; ?>"><span class="news_letter"><?php echo $this->Lang["ADD_TEMPLATE"]; ?></span></a></li>
				<li><a href="<?php echo PATH; ?>merchant/manage-template.html" class="menu_rgt1" title="<?php echo $this->Lang['SEND_NEWSL']; ?>"><span class="news_letter"><?php echo $this->Lang["MANAGE_TEMPLATE"]; ?></span></a></li>
				<li><a href="<?php echo PATH; ?>merchant/send-newsletter.html" class="menu_rgt1" title="<?php echo $this->Lang['SEND_NEWSL']; ?>"><span class="news_letter"><?php echo $this->Lang["SEND_NEWSL"]; ?></span></a></li>
			</ul>
		</li>
        
        <?php }?>
        
        
        <?php if($this->user_type==3){?>
        <li onclick="toggle(24)" <?php if(isset($this->news_merchant_letter)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['NEWSLETTER1']; ?>"><span class="img_settings fl"><?php echo $this->Lang['NEWSLETTER1']; ?></span><img id="left_menubutton_22" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_24">
			
          <li>
            
            <a href="<?php echo PATH; ?>merchant/send-merchant-newsletter.html" class="menu_rgt1" title="<?php echo $this->Lang['SEND_EMAILS']; ?>"><span class="pl15"><?php echo $this->Lang['SEND_EMAILS']; ?></span></a></li>
            
          <li>
            
            <a href="<?php echo PATH; ?>merchant/merchant_email_inbox.html" class="menu_rgt1" title="<?php echo $this->Lang['EMAIL']; ?>"><span class="pl15"><?php echo $this->Lang['EMAIL']; ?></span></a></li>
        </ul>
      </li>
      <?php } ?>
        
         
        
                <?php /* if($this->aramex_setting == 1){ ?>
                <li <?php if(isset($this->shipp_acc_setting)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/shipping-account-settings.html" title="<?php echo $this->Lang['SHIPP_ACC_SETT']; ?>"><span class="fund_management fl"><?php echo $this->Lang['SHIPP_ACC_SETT']; ?></span></a></li>  
                <?php }  */ ?> 
                
    <?php if(PRIVILEGES_ATTRIBUTES==1){?>
    <li onclick="toggle(19)" <?php if(isset($this->color_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['ATTRI_MANA']; ?>"><span class="img_settings fl"><?php echo $this->Lang['ATTRI_MANA']; ?></span><img id="left_menubutton_19" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_19">
          <li>
            
            <a href="<?php echo PATH; ?>merchant/add-color.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_COLOR']; ?>"><span class="pl15"><?php echo $this->Lang['ADD_COLOR']; ?></span></a></li>
          <li>
            
            <a href="<?php echo PATH; ?>merchant/manage-colors.html" class="menu_rgt1" title="<?php echo $this->Lang['MANA_COLORS']; ?>"><span class="pl15"><?php echo $this->Lang['MANA_COLORS']; ?></span></a></li>
            
            <li>
            
            <a href="<?php echo PATH; ?>merchant/add-size.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_SIZE']; ?>"><span class="pl15"><?php echo $this->Lang['ADD_SIZE']; ?></span></a></li>
          <li>
            
            <a href="<?php echo PATH; ?>merchant/manage-sizes.html" class="menu_rgt1" title="<?php echo $this->Lang['MANA_SIZE']; ?>"><span class="pl15"><?php echo $this->Lang['MANA_SIZE']; ?></span></a></li>
            

          
        </ul>
      </li>
      <?php } ?>
      <?php if(PRIVILEGES_SPECIFICATION==1){?>
      <li onclick="toggle(22)" <?php if(isset($this->attributegroup_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['SPEC_MGT']; ?>"><span class="img_settings fl"><?php echo $this->Lang['SPEC_MGT']; ?></span><img id="left_menubutton_22" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_22">
			
          <li>
            
            <a href="<?php echo PATH; ?>merchant/add-attribute-group.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_ATTR_GROUP_LABEL']; ?>"><span class="pl15"><?php echo $this->Lang['ADD_ATTR_GROUP_LABEL']; ?></span></a></li>
            
          <li>
            
            <a href="<?php echo PATH; ?>merchant/manage-attribute-group.html" class="menu_rgt1" title="<?php echo $this->Lang['MANA_ATTR_GROUP']; ?>"><span class="pl15"><?php echo $this->Lang['MANA_ATTR_GROUP']; ?></span></a></li>
            
            
            <li>
            
            <a href="<?php echo PATH; ?>merchant/add-attribute.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_ATTR_LABEL']; ?>"><span class="pl15"><?php echo $this->Lang['ADD_ATTR_LABEL']; ?></span></a></li>
           
          <li>
            
            <a href="<?php echo PATH; ?>merchant/manage-attribute.html" class="menu_rgt1" title="<?php echo $this->Lang['MANA_ATTR']; ?>"><span class="pl15"><?php echo $this->Lang['MANA_ATTR']; ?></span></a></li>
          
        </ul>
      </li>
      <?php } ?>
      <?php if(PRIVILEGES_CATEGORY==1){?>
      <li onclick="toggle(5)" <?php if(isset($this->category)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['CATEGORY_MANAGE']; ?>"><span class="category_management fl"><?php echo $this->Lang["CATEGORY_MANAGE"]; ?></span><img id="left_menubutton_3" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_5">
			
            <li>
                
                <a href="<?php echo PATH; ?>merchant/add-category.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_CATEGORY']; ?>"><span class="pl15"><?php echo $this->Lang["ADD_CATEGORY"]; ?></span></a></li>
                
                <li>
                
                	<a href="<?php echo PATH; ?>merchant/manage-category.html" class="menu_rgt1" title="<?php echo $this->Lang['MANAGE_CAT']; ?>"><span class="pl15"><?php echo $this->Lang["MANAGE_CAT"]; ?></span></a>
            </li>
        </ul>
      </li>
      <?php } ?>
             
        
        
    <?php } ?>
    
    <?php if(isset($this->mer_moderator_act)){ ?>	
	
	   <li <?php if(isset($this->mer_dashboard_moderator)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>merchant/moderator-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['CUSTM_DASH']; ?>"><span class="customer_comments"><?php echo $this->Lang['CUSTM_DASH']; ?></span></a></li>
        
	<li <?php if(isset($this->add_mer_moderator)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>merchant/add-moderator.html" class="menu_rgt" title="<?php echo $this->Lang['ADD_MER_MODE']; ?>"><span class="customer_comments"><?php echo $this->Lang['ADD_MER_MODE']; ?></span></a></li>
	<li <?php if(isset($this->manage_mer_moderator)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH; ?>merchant/manage-moderator.html" class="menu_rgt" title="<?php echo $this->Lang["MANAGE_MER_MODE"]; ?>"><span class="customer_comments"><?php echo $this->Lang["MANAGE_MER_MODE"]; ?></span></a></li>
        
        
        
        <li onclick="toggle(24)" <?php if(isset($this->news_modarator_letter)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['NEWSLETTER1']; ?>"><span class="img_settings fl"><?php echo $this->Lang['NEWSLETTER1']; ?></span><img id="left_menubutton_22" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_24">
			
          <li>
            
            <a href="<?php echo PATH; ?>merchant/send-moderator-newsletter.html" class="menu_rgt1" title="<?php echo $this->Lang['SEND_EMAILS']; ?>"><span class="pl15"><?php echo $this->Lang['SEND_EMAILS']; ?></span></a></li>
            
          <li>
            
            <a href="<?php echo PATH; ?>merchant/moderator_email_inbox.html" class="menu_rgt1" title="<?php echo $this->Lang['EMAIL']; ?>"><span class="pl15"><?php echo $this->Lang['EMAIL']; ?></span></a></li>
        </ul>
      </li>
        
        
        
        
    <?php } ?>
    
    </ul>

  </div>
</div>
