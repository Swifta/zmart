<?php defined('SYSPATH') OR die('No direct access allowed.');

/** Merchant Details **/

$config['store-admin.html'] = '/store_admin';
$config['store-admin-login.html'] = "/store_admin/login";
$config['store-admin/settings.html'] = '/store_admin/merchant_settings';
$config['store-admin/Edit_info.html'] = '/store_admin/edit_merchant';
$config['store-admin/change_password.html'] = '/store_admin/merchant_password';

/**MERCHANT SIDE PRODUCT TRANSACTION  **/

$config['store-admin-product/all-transaction.html'] = "/store_admin/product_transaction";
$config['store-admin-product/success-transaction.html'] = "/store_admin/product_transaction/Success";
$config['store-admin-product/completed-transaction.html'] = "/store_admin/product_transaction/Completed";
$config['store-admin-product/failed-transaction.html'] = "/store_admin/product_transaction/Faild";
$config['store-admin-product/hold-transaction.html'] = "/store_admin/product_transaction/Pending";
$config['store-admin-product/all-transaction/page/(.*)'] = "/store_admin/product_transaction/mail/$1";
$config['store-admin-product/success-transaction/page/(.*)'] = "/store_admin/product_transaction/Success/$1";
$config['store-admin-product/completed-transaction/page/(.*)'] = "/store_admin/product_transaction/Completed/$1";
$config['store-admin-product/failed-transaction/page/(.*)'] = "/store_admin/product_transaction/Faild/$1";
$config['store-admin-product/hold-transaction/page/(.*)'] = "/store_admin/product_transaction/Pending/$1";

/** MERCHANT AUCTION COD TRANSACTION  **/

$config['store-admin-cod-auction/all-transaction.html'] = "/store_admin/auction_cod_transaction";
$config['store-admin-cod-auction/success-transaction.html'] = "/store_admin/auction_cod_transaction/Completed";
$config['store-admin-cod-auction/failed-transaction.html'] = "/store_admin/auction_cod_transaction/Failed";
$config['store-admin-cod-auction/hold-transaction.html'] = "/store_admin/auction_cod_transaction/Pending";
$config['store-admin-cod-auction/all-transaction/page/(.*)'] = "/store_admin/auction_cod_transaction/mail/$1";
$config['store-admin-cod-auction/success-transaction/page/(.*)'] = "/store_admin/auction_cod_transaction/Completed/$1";
$config['store-admin-cod-auction/failed-transaction/page/(.*)'] = "/store_admin/auction_cod_transaction/Failed/$1";
$config['store-admin-cod-auction/hold-transaction/page/(.*)'] = "/store_admin/auction_cod_transaction/Pending/$1";

/** MERCHANT COD TRANSACTION  **/

$config['store-admin-cod/all-transaction.html'] = "/store_admin/cod_transaction";
$config['store-admin-cod/success-transaction.html'] = "/store_admin/cod_transaction/Completed";
$config['store-admin-cod/failed-transaction.html'] = "/store_admin/cod_transaction/Failed";
$config['store-admin-cod/hold-transaction.html'] = "/store_admin/cod_transaction/Pending";
$config['store-admin-cod/all-transaction/page/(.*)'] = "/store_admin/cod_transaction/mail/$1";
$config['store-admin-cod/success-transaction/page/(.*)'] = "/store_admin/cod_transaction/Completed/$1";
$config['store-admin-cod/failed-transaction/page/(.*)'] = "/store_admin/cod_transaction/Faild/$1";
$config['store-admin-cod/hold-transaction/page/(.*)'] = "/store_admin/cod_transaction/Pending/$1";

/** MERCHNAT SIDE AUCTION  **/

$config['store-admin/add-auction.html'] = "/store_admin/add_auction";
$config['store-admin/manage-auction.html'] = "/store_admin/manage_auction";
$config['store-admin/manage-auction.html/page/(.*)'] = "/store_admin/manage_auction/0/$1";
$config['store-admin/archive-auction.html'] = "/store_admin/manage_auction/1";
$config['store-admin/archive-auction.html/page/(.*)'] = "/store_admin/manage_auction/1/$1";
$config['store-admin/view-auction/(.*)/(.*).html'] ="/store_admin/view_auction/$1/$2";
$config['store-admin/edit-auction/(.*)/(.*).html'] = "/store_admin/edit_auction/$1/$2";
$config['store-admin/block-auction/(.*)/(.*).html'] = "/store_admin/block_auction/0/$1/$2";
$config['store-admin/unblock-auction/(.*)/(.*).html'] = "/store_admin/block_auction/1/$1/$2";
$config['store-admin/delete-auction/(.*)/(.*).html'] = "/store_admin/delete_auction/$1/$2";
$config['store-admin/auction-dashboard.html'] = "/store_admin/dashboard_auction";
$config['store-admin/send-auction-email/(.*)/(.*).html'] ="/store_admin/send_email/$1/$2";
$config['store-admin-auction/winner-list.html'] = "/store_admin/winner";
$config['store-admin-auction/winner-list.html/page/(.*)'] = "/store_admin/winner/$1";
$config['store-admin-auction/shipping-delivery.html'] = "/store_admin/auction_shipping_delivery";
$config['store-admin-auction/shipping-delivery.html/page/(.*)'] = "/store_admin/auction_shipping_delivery/$1";
$config['store-admin-auction/cod-delivery.html'] = "/store_admin/auction_cash_on_delivery";
$config['store-admin-auction/cod-delivery.html/page/(.*)'] = "/store_admin/auction_cash_on_delivery/$1";
$config['store-admin-auction/delivery_status/(.*)/(.*)/(.*)/(.*)/(.*)/(.*).html']="/store_admin/auction_update_delivery_status/$1/$2/$3/$4/$5/$6";
$config['store-admin-auction-cod/delivery_status/(.*)/(.*)/(.*)/(.*)/(.*)/(.*)/(.*).html']="/store_admin/auction_update_cod_delivery_status/$1/$2/$3/$4/$5/$6/$7";

/** MERCHANT AUCTION TRANSACTION  **/

$config['store-admin-auction/all-transaction.html'] = "/store_admin/auction_transaction";
$config['store-admin-auction/success-transaction.html'] = "/store_admin/auction_transaction/Success";
$config['store-admin-auction/completed-transaction.html'] = "/store_admin/auction_transaction/Completed";
$config['store-admin-auction/failed-transaction.html'] = "/store_admin/auction_transaction/Faild";
$config['store-admin-auction/hold-transaction.html'] = "/store_admin/auction_transaction/Pending";
$config['store-admin-auction/all-transaction/page/(.*)'] = "/store_admin/auction_transaction/mail/$1";
$config['store-admin-auction/success-transaction/page/(.*)'] = "/store_admin/auction_transaction/Success/$1";
$config['store-admin-auction/completed-transaction/page/(.*)'] = "/store_admin/auction_transaction/Completed/$1";
$config['store-admin-auction/failed-transaction/page/(.*)'] = "/store_admin/auction_transaction/Faild/$1";
$config['store-admin-auction/hold-transaction/page/(.*)'] = "/store_admin/auction_transaction/Pending/$1";
$config['delete-auction-images.html']="/store_admin/delete_auction_images";

/** MERCHANT LOGIN **/

$config['store-admin/add-deals.html'] = "/store_admin/add_deals";
$config['store-admin/manage-deals.html'] = "/store_admin/manage_deals";
$config['store-admin/manage-deals.html/page/(.*)'] = "/store_admin/manage_deals/0/$1";
$config['store-admin/archive-deals.html'] = "/store_admin/manage_deals/1";
$config['store-admin/archive-deals.html/page/(.*)'] = "/store_admin/manage_deals/1/$1";
$config['store-admin/view-deal/(.*)/(.*).html'] ="/store_admin/view_deals/$1/$2";
$config['store-admin/edit-deal/(.*)/(.*).html'] = "/store_admin/edit_deals/$1/$2";
$config['store-admin/block-deal/(.*)/(.*).html'] = "/store_admin/block_deals/0/$1/$2";
$config['store-admin/unblock-deal/(.*)/(.*).html'] = "/store_admin/block_deals/1/$1/$2";
$config['store-admin/send-deal-mail/(.*)/(.*).html'] ="/store_admin/deal_send_email/$1/$2";
$config['store-admin/deals-dashboard.html'] = "/store_admin/dashboard_deals";
$config['store-admin/close-couopn-list.html'] = "/store_admin/closed_coupon";
$config['store-admin/close-couopn-list.html/page/(.*)'] = "/store_admin/closed_coupon/$1";


/** MARCHANT PRODUCT**/

$config['store-admin/add-products.html'] = "/store_admin/add_products";
$config['store-admin/manage-products.html'] = "/store_admin/manage_products";
$config['store-admin/manage-products.html/page/(.*)'] = "/store_admin/manage_products/0/$1";
$config['store-admin/sold-products.html'] = "/store_admin/manage_products/1";
$config['store-admin/sold-products.html/page/(.*)'] = "/store_admin/manage_products/1/$1";
$config['store-admin/shipping-delivery.html'] = "/store_admin/shipping_delivery";
$config['store-admin/shipping-delivery.html/page/(.*)'] = "/store_admin/shipping_delivery/$1";
$config['store-admin/cash-delivery.html'] = "/store_admin/cash_on_delivery";
$config['store-admin/cash-delivery.html/page/(.*)'] = "/store_admin/cash_on_delivery/$1";
$config['store-admin/view-products/(.*)/(.*).html'] ="/store_admin/view_products/$1/$2";
$config['store-admin/edit-products/(.*)/(.*).html'] = "/store_admin/edit_products/$1/$2";
$config['store-admin/block-products/(.*)/(.*).html'] = "/store_admin/block_products/0/$1/$2";
$config['store-admin/unblock-products/(.*)/(.*).html'] = "/store_admin/block_products/1/$1/$2";
$config['store-admin/send-product/(.*)/(.*).html'] ="/store_admin/product_send_email/$1/$2";
$config['store-admin/products-dashboard.html'] = "/store_admin/dashboard_products";
$config['store-admin/delivery_status/(.*)/(.*)/(.*)/(.*).html']="/store_admin/update_delivery_status/$1/$2/$3/$4";
$config['store-admin/cod-delivery_status/(.*)/(.*)/(.*)/(.*)/(.*).html']="/store_admin/update_cod_delivery_status/$1/$2/$3/$4/$5/$6/$7";
$config['store-admin/confirm-product-status/(.*)/(.*).html'] = "/store_admin/confirm_product/$1/$2";
$config['store-admin/edit-product-status/(.*).html'] = "/store_admin/edi_confirm_product/$1";


/** MARCHANT TRANSACTION **/

$config['store-admin/transaction-dashboard.html'] = "/store_admin/dashboard_transaction";
$config['store-admin/all-transaction.html'] = "/store_admin/admin_transaction";
$config['store-admin/all-transaction.html/page/(.*)'] = "/store_admin/admin_transaction";
$config['store-admin/success-transaction.html'] = "/store_admin/admin_transaction/Success";
$config['store-admin/completed-transaction.html'] = "/store_admin/admin_transaction/Completed";
$config['store-admin/failed-transaction.html'] = "/store_admin/admin_transaction/Faild";
$config['store-admin/hold-transaction.html'] = "/store_admin/admin_transaction/Pending";

$config['store-admin/all-transaction/page/(.*)'] = "/store_admin/admin_transaction/mail/$1";
$config['store-admin/success-transaction/page/(.*)'] = "/store_admin/admin_transaction/Success/$1";
$config['store-admin/completed-transaction/page/(.*)'] = "/store_admin/admin_transaction/Completed/$1";
$config['store-admin/failed-transaction/page/(.*)'] = "/store_admin/admin_transaction/Faild/$1";
$config['store-admin/hold-transaction/page/(.*)'] = "/store_admin/admin_transaction/Pending/$1";

$config['store-admin/couopn_code.html'] = "/store_admin/couopn_code";
$config['store-admin/close-deals/(.*)/(.*)/(.*)/(.*).html'] = "/store_admin/close_deals/0/$1/$2/$3/$4";
$config['store-admin/forgot-password.html'] = "/store_admin/forgot_password";
$config['facebookpost.php'] = "/store_admin/facebook_auto_post";

$config['store-admin/terms-and-conditions.html'] = '/store_admin/terms_and_conditions';
$config['store-admin/return-policy.html'] = '/store_admin/return_policy';
$config['store-admin/warranty.html'] = '/store_admin/about_us';
$config['store-admin/store-personalized.html'] = '/store_admin/store_personalized';


/** SPENT FREE GIFT **/

$config['store-admin/add-free-gift.html'] = "/store_admin/add_free_gift";
$config['store-admin/edit-gift/(.*)/(.*).html'] = "/store_admin/edit_gift/$1/$2";
$config['store-admin/manage-free-gift.html'] = "/store_admin/manage_free_gift";
$config['store-admin/manage-free-gift.html/page/(.*)'] = "/store_admin/manage_free_gift/$1";
$config['store-admin/block-gift/(.*).html'] = "/store_admin/block_gift/0/$1";
$config['store-admin/unblock-gift/(.*).html'] = "/store_admin/block_gift/1/$1";
$config['store-admin/delete-gift/(.*)/(.*).html'] = "/store_admin/delete_gift/$1/$2";


$config['store-admin-storecredits/all-transaction.html'] = "/store_admin/storecredits_transaction";
$config['store-admin-storecredits/success-transaction.html'] = "/store_admin/storecredits_transaction/Completed";
$config['store-admin-storecredits/failed-transaction.html'] = "/store_admin/storecredits_transaction/Failed";
$config['store-admin-storecredits/hold-transaction.html'] = "/store_admin/storecredits_transaction/Pending";
$config['store-admin-storecredits/all-transaction/page/(.*)'] = "/store_admin/storecredits_transaction/mail/$1";
$config['store-admin-storecredits/success-transaction/page/(.*)'] = "/store_admin/storecredits_transaction/Completed/$1";
$config['store-admin-storecredits/failed-transaction/page/(.*)'] = "/store_admin/storecredits_transaction/Faild/$1";
$config['store-admin-storecredits/hold-transaction/page/(.*)'] = "/store_admin/storecredits_transaction/Pending/$1";



/* STORECREDIT ORDER MANAGEMENT */
$config['store-admin/storecredit/pending-transaction.html'] = "/store_admin/storecredit_transaction";
$config['store-admin/storecredit/pending-transaction.html/page/(.*)'] = "/store_admin/storecredit_transaction";
$config['store-admin/storecredit/success-transaction.html'] = "/store_admin/storecredit_transaction/Success";
$config['store-admin/storecredit/purchase-transaction.html'] = "/store_admin/storecredit_transaction/Purchased";
$config['store-admin/storecredit/failed-transaction.html'] = "/store_admin/storecredit_transaction/Failed";
$config['store-admin/storecredit-status/(.*)/(.*)/(.*).html'] = "/store_admin/storecredit_status/$1/$2/$3";
