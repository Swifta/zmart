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
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/deals-dashboard.html" title="<?php echo $this->Lang['DEAL_DASH']; ?>"><span class="fund_management fl"><?php echo $this->Lang['DEAL_DASH']; ?></span></a></li>
        <?php if(PRIVILEGES_DEALS_ADD==1){?>
        <li <?php if(isset($this->add_deal)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/add-deals.html" title="<?php echo $this->Lang["ADD_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ADD_DEALS"]; ?></span></a></li>
        <?php } ?>
        <li <?php if(isset($this->manage_deals)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/manage-deals.html" title="<?php echo $this->Lang["MANAGE_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["MANAGE_DEALS"]; ?></span></a></li>
        <li <?php if(isset($this->archive_deals)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/archive-deals.html" title="<?php echo $this->Lang["ARCHIVE_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ARCHIVE_DEALS"]; ?></span></a></li>        
        <li <?php if(isset($this->couopn_code)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/couopn_code.html" title="<?php echo $this->Lang["COUPON_VALIDATE"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["COUPON_VALIDATE"]; ?></span></a></li>
        <li <?php if(isset($this->close_code)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/close-couopn-list.html" title="<?php echo $this->Lang["REDEM_COU_LI"]; ?>"><span class="fund_management fl"><?php echo $this->Lang['REDEM_COU_LI']; ?></span></a></li>
        <?php } }?>
		<?php if(PRIVILEGES_PRODUCTS==1){?>
        <?php if(isset($this->mer_products_act)){ ?>
        <li <?php if(isset($this->dashboard_products)){ ?> class="menu_active"  <?php } ?>>
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/products-dashboard.html" title="<?php echo $this->Lang['PRODUCT_DASH']; ?>"><span class="fund_management fl"><?php echo $this->Lang['PRODUCT_DASH']; ?></span></a></li>
        <?php if(PRIVILEGES_PRODUCTS_ADD){?>
        <li <?php if(isset($this->add_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/add-products.html" title="<?php echo $this->Lang["ADD_PRODUCTS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ADD_PRODUCTS"]; ?></span></a></li>
        <?php } ?>
        <li <?php if(isset($this->manage_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/manage-products.html" title="<?php echo $this->Lang["MANAGE_PRODUCTS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["MANAGE_PRODUCTS"]; ?></span></a></li>
        <li <?php if(isset($this->archive_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/sold-products.html" title="<?php echo $this->Lang["ARCHIVE_PRODUCTS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ARCHIVE_PRODUCTS"]; ?></span></a></li>
        <li <?php if(isset($this->import_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/product-import.html" title="<?php echo $this->Lang["PRODUCT_IMPORT"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["PRODUCT_IMPORT"]; ?></span></a></li>
        <?php if(PRIVILEGES_GIFT==1){?>
        <?php if(PRIVILEGES_GIFT_ADD==1){?>
        <li <?php if(isset($this->add_free_gift)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/add-free-gift.html" title="<?php echo $this->Lang["ADD_FREE_GIFT"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ADD_FREE_GIFT"]; ?></span></a></li>
        <?php } ?>
        <li <?php if(isset($this->manage_free_gift)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/manage-free-gift.html" title="<?php echo $this->Lang["MANAGE_FREE_GIFT"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["MANAGE_FREE_GIFT"]; ?></span></a></li>
        <?php } ?>
       <li <?php if(isset($this->shipping_delivery)){ ?> class="menu_active"  <?php } ?> >
        <a href="<?php echo PATH?>store-admin/shipping-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['SHIP_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['SHIP_DEL']; ?></span></a></li>
        
        <li onclick="toggle(16)" <?php if(isset($this->storecredit)){ ?> class="menu_active"  <?php } ?> >        
			<a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['STR_CRD_ORD']; ?>"><span class="category_management fl"><?php echo $this->Lang['STR_CRD_ORD']; ?></span><img id="left_menubutton_16" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
			<ul class="toggleul_16">
				<li><a href="<?php echo PATH; ?>store-admin/storecredit/pending-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['PEN_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['PEN_ORD']; ?></span></a></li>			
				<li><a href="<?php echo PATH; ?>store-admin/storecredit/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['APPR_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['APPR_ORD']; ?></span></a></li>
                <li><a href="<?php echo PATH; ?>store-admin/storecredit/purchase-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['PURCH_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['PURCH_ORD']; ?></span></a></li>
				<li><a href="<?php echo PATH; ?>store-admin/storecredit/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAIL_ORD']; ?>"><span class="pl15"><?php echo $this->Lang['FAIL_ORD']; ?></span></a></li>
			</ul>
		</li>
        
        
         <?php /*<li <?php if(isset($this->cash_delivery)){ ?> class="menu_active"  <?php } ?> >
        <a href="<?php echo PATH?>store-admin/cash-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['CASH_ON_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['CASH_ON_DEL']; ?></span></a></li>
        <li onclick="toggle(4)" <?php if(isset($this->free_gift)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['SPENT_FREE_GIFT']; ?>"><span class="category_management fl"><?php echo $this->Lang["SPENT_FREE_GIFT"]; ?></span><img id="left_menubutton_3" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_4">
            <li>
                <a href="<?php echo PATH?>store-admin/add-free-gift.html" class="menu_rgt1" title="<?php echo $this->Lang['ADD_FREE_GIFT']; ?>"><span class="pl15"><?php echo $this->Lang["ADD_FREE_GIFT"]; ?></span></a></li>
                <li>
                <a href="<?php echo PATH?>store-admin/manage-free-gift.html" class="menu_rgt1" title="<?php echo $this->Lang['MANAGE_FREE_GIFT']; ?>"><span class="pl15"><?php echo $this->Lang["MANAGE_FREE_GIFT"]; ?></span></a>
            </li>
        </ul>
      </li>*/ ?>
      
      
        <?php }} ?>
        <?php if(PRIVILEGES_AUCTIONS==1){?>
        <?php   if(isset($this->mer_auction_act)){ ?>
        <li <?php if(isset($this->auction_products)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH?>store-admin/auction-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['ACT_DASH']; ?>"><span class="customer_comments"><?php echo $this->Lang['ACT_DASH']; ?></span></a></li>
        <?php if(PRIVILEGES_AUCTIONS_ADD==1){?>
        <li <?php if(isset($this->add_auction)){ ?> class="menu_active"  <?php } ?>>        
        <a href="<?php echo PATH?>store-admin/add-auction.html" class="menu_rgt" title="<?php echo $this->Lang['ADD_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['ADD_ACT_PRO']; ?></span></a></li>
        <?php } ?>
        <li <?php if(isset($this->manage_auction)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH?>store-admin/manage-auction.html" class="menu_rgt" title="<?php echo $this->Lang['MAG_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['MAG_ACT_PRO']; ?></span></a></li>
        <li <?php if(isset($this->archive_auction)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH?>store-admin/archive-auction.html" class="menu_rgt" title="<?php echo $this->Lang['ARCH_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['ARCH_ACT_PRO']; ?></span></a></li>
        <li <?php if(isset($this->winner)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH?>store-admin-auction/winner-list.html" class="menu_rgt" title="<?php echo $this->Lang['WIN_LIST2']; ?>"><span class="customer_comments"><?php echo $this->Lang['WIN_LIST2']; ?></span></a></li>
        <li <?php if(isset($this->shipping_delivery)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH?>store-admin-auction/shipping-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['SHIP_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['SHIP_DEL']; ?></span></a></li>        
       <?php /* <li <?php if(isset($this->cod_delivery)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH?>store-admin-auction/cod-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['CASH_ON_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['CASH_ON_DEL']; ?></span></a></li>*/?>
        <?php }}  ?>

        <?php if(isset($this->mer_merchant_act)){ ?>
        <?php if(PRIVILEGES_RETURN_POLICY_EDIT==1){?>
        <li <?php if(isset($this->return_policy)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/return-policy.html" title="<?php echo $this->Lang['RET_POL']; ?>"><span class="fund_management fl"><?php echo $this->Lang['RET_POL']; ?></span></a></li>
        <?php } ?>
        <?php if(PRIVILEGES_ABOUT_US_EDIT==1){?>
        <li <?php if(isset($this->about_us)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/warranty.html" title="<?php echo $this->Lang['WARRANTY']; ?>"><span class="fund_management fl"><?php echo $this->Lang['WARRANTY']; ?></span></a></li>
        <?php } ?>
	 <?php if(PRIVILEGES_TERMS_AND_CONDITIONS_EDIT==1){?>
        <li <?php if(isset($this->terms_and_conditions)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/terms-and-conditions.html" title="<?php echo $this->Lang['SHIP_ING']; ?>"><span class="fund_management fl"><?php echo $this->Lang['SHIP_ING']; ?></span></a></li>
        <?php } ?>
        <?php if(PRIVILEGES_PERSONALIZED_STORE_EDIT==1){?>
        <li <?php if(isset($this->store_personalized)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/store-personalized.html" title="<?php echo $this->Lang['STORE_PERSONALIZED']; ?>"><span class="fund_management fl"><?php echo $this->Lang['STORE_PERSONALIZED']; ?></span></a></li>
        <?php } ?>
        
        <?php } ?>
        
        <?php if (PRIVILEGES_TRANSACTIONS) { ?>
     <?php if((PRIVILEGES_DEALS)||(PRIVILEGES_PRODUCTS)||(PRIVILEGES_AUCTIONS)){ ?>
        
        <?php if(isset($this->mer_fund_act)){ ?>	
        <li <?php if(isset($this->manage_fund_request)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/fund_request.html" title="<?php echo $this->Lang["FUND_REQ_REP"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["FUND_REQ_REP"]; ?></span></a></li>
        <?php if(PRIVILEGES_FUNDREQUEST_EDIT==1){?>
        <li <?php if(isset($this->add_fund_request)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/add_fund_request.html" title="<?php echo $this->Lang["WITHDRAW_FUND"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["WITHDRAW_FUND"]; ?></span></a></li>
        <?php } }?>

	<?php   if(isset($this->mer_transactions_act)){ ?>    
	<li <?php if(isset($this->dashboard_transaction)){ ?> class="menu_active"  <?php } ?>>        
        <a href="<?php echo PATH?>store-admin/transaction-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['TRANS_DASH']; ?>"><span class="payment_transactions"><?php echo $this->Lang['TRANS_DASH']; ?></span></a></li>	
        <?php if(PRIVILEGES_DEALS){ ?>	
		<li onclick="toggle(12)" <?php if(isset($this->deal_trans)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['DLS_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['DLS_TRANS']; ?></span><img id="left_menubutton_12" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_12">
			<li><a href="<?php echo PATH?>store-admin/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>			
			<li>
        
        <a href="<?php echo PATH?>store-admin/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span></a></li>
                    <li><a href="<?php echo PATH?>store-admin/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li><a href="<?php echo PATH?>store-admin/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li><a href="<?php echo PATH?>store-admin/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>
      <?php } ?>
		<?php if(PRIVILEGES_PRODUCTS){ ?>
		<li onclick="toggle(11)" <?php if(isset($this->pro_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['PRO_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['PRO_TRANS']; ?></span><img id="left_menubutton_11" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_11">
			<li>
        
        <a href="<?php echo PATH?>store-admin-product/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			<?php /* <li>
        		
        			<a href="<?php echo PATH?>store-admin-product/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span>
					</a>
			</li> */ ?>
            <li>
        
        <a href="<?php echo PATH?>store-admin-product/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH?>store-admin-product/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH?>store-admin-product/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>
      
		<?php /*<li onclick="toggle(13)" <?php if(isset($this->cod_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['PRO_COD']; ?>"><span class="category_management fl"><?php echo $this->Lang['PRO_COD']; ?></span><img id="left_menubutton_13" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_13">
			<li>
        
        <a href="<?php echo PATH?>store-admin-cod/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			
            <li>
        
        <a href="<?php echo PATH?>store-admin-cod/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH?>store-admin-cod/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH?>store-admin-cod/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>*/?>
      
      	<li onclick="toggle(14)" <?php if(isset($this->storecredits_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['PRD_STR_CRDS']; ?>"><span class="category_management fl"><?php echo $this->Lang['PRD_STR_CRDS']; ?></span><img id="left_menubutton_14" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_14">
			<li>
        
        <a href="<?php echo PATH?>store-admin-storecredits/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
		<?php /*	
            <li>
        
        <a href="<?php echo PATH?>store-admin-storecredits/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH?>store-admin-storecredits/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH?>store-admin-storecredits/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        */ ?>
        </ul>
      </li>
      
      <?php }?>
      <?php if(PRIVILEGES_AUCTIONS){ ?>
		<li onclick="toggle(10)" <?php if(isset($this->act_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['ACT_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['ACT_TRANS']; ?></span><img id="left_menubutton_10" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_10">
			<li>
        
        <a href="<?php echo PATH?>store-admin-auction/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>

			<?php /* <li>
        		
        			<a href="<?php echo PATH?>store-admin-auction/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span>
					</a>
			</li> */ ?>
			
            <li>
        
        <a href="<?php echo PATH?>store-admin-auction/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH?>store-admin-auction/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH?>store-admin-auction/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>

     <?php /* <li onclick="toggle(15)" <?php if(isset($this->auction_cod_trans)){ ?> class="menu_active"  <?php } ?> >
        
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['ACT_COD']; ?>"><span class="category_management fl"><?php echo $this->Lang['ACT_COD']; ?></span><img id="left_menubutton_15" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_15">
			<li>
        
        <a href="<?php echo PATH?>store-admin-cod-auction/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			
            <li>
        
        <a href="<?php echo PATH?>store-admin-cod-auction/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH?>store-admin-cod-auction/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH?>store-admin-cod-auction/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>*/?>
      <?php } ?>
      
    <?php }}}?>


    <?php if(isset($this->mer_settings_act)){ ?>	
	
	    <li <?php if(isset($this->merchant_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/settings.html" title="<?php echo $this->Lang['SETTINGS']; ?>"><span class="fund_management fl"><?php echo $this->Lang['SETTINGS']; ?></span></a></li>
        <li <?php if(isset($this->edit_merchant)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/Edit_info.html" title="<?php echo $this->Lang['EDIT_ACC']; ?>"><span class="fund_management fl"><?php echo $this->Lang['EDIT_ACC']; ?></span></a></li>
        <li <?php if(isset($this->merchant_password)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/change_password.html" title="<?php echo $this->Lang['CHANGE_PASS']; ?>"><span class="fund_management fl"><?php echo $this->Lang['CHANGE_PASS']; ?></span></a></li>
   
             
        
        
    <?php } ?>
    
    <?php if(isset($this->mer_moderator_act)){ ?>	
	
	   <li <?php if(isset($this->mer_dashboard_moderator)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH?>store-admin/moderator-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['CUSTM_DASH']; ?>"><span class="customer_comments"><?php echo $this->Lang['CUSTM_DASH']; ?></span></a></li>
        
	<li <?php if(isset($this->add_mer_moderator)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH?>store-admin/add-moderator.html" class="menu_rgt" title="<?php echo $this->Lang['ADD_MER_MODE']; ?>"><span class="customer_comments"><?php echo $this->Lang['ADD_MER_MODE']; ?></span></a></li>
	<li <?php if(isset($this->manage_mer_moderator)){ ?> class="menu_active"  <?php } ?> >
        
        <a href="<?php echo PATH?>store-admin/manage-moderator.html" class="menu_rgt" title="<?php echo $this->Lang["MANAGE_MER_MODE"]; ?>"><span class="customer_comments"><?php echo $this->Lang["MANAGE_MER_MODE"]; ?></span></a></li>
        
        <li <?php if(isset($this->news_modarator_letter)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH?>store-admin/send-moderator-newsletter.html" title="<?php echo $this->Lang['NEWSLETTER1']; ?>"><span class="fund_management fl"><?php echo $this->Lang['NEWSLETTER1']; ?></span></a></li>
        
        
        
        
    <?php } ?>
    
    </ul>

  </div>
</div>
