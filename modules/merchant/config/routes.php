<?php defined('SYSPATH') OR die('No direct access allowed.');

/** Merchant Details **/

$config['merchant.html'] = '/merchant';
$config['merchant-login.html'] = "/merchant/login";
$config['merchant/settings.html'] = '/merchant/merchant_settings';
$config['merchant/Edit_info.html'] = '/merchant/edit_merchant';
$config['merchant/change_password.html'] = '/merchant/merchant_password';
$config['merchant/change_shipping_setting.html'] = '/merchant/change_shipping_setting';

/**MERCHANT SIDE PRODUCT TRANSACTION  **/

$config['merchant-product/all-transaction.html'] = "/merchant/product_transaction";
$config['merchant-product/success-transaction.html'] = "/merchant/product_transaction/Success";
$config['merchant-product/completed-transaction.html'] = "/merchant/product_transaction/Completed";
$config['merchant-product/failed-transaction.html'] = "/merchant/product_transaction/Faild";
$config['merchant-product/hold-transaction.html'] = "/merchant/product_transaction/Pending";
$config['merchant-product/all-transaction/page/(.*)'] = "/merchant/product_transaction/mail/$1";
$config['merchant-product/success-transaction/page/(.*)'] = "/merchant/product_transaction/Success/$1";
$config['merchant-product/completed-transaction/page/(.*)'] = "/merchant/product_transaction/Completed/$1";
$config['merchant-product/failed-transaction/page/(.*)'] = "/merchant/product_transaction/Faild/$1";
$config['merchant-product/hold-transaction/page/(.*)'] = "/merchant/product_transaction/Pending/$1";

/** MERCHANT AUCTION COD TRANSACTION  **/

$config['merchant-cod-auction/all-transaction.html'] = "/merchant/auction_cod_transaction";
$config['merchant-cod-auction/success-transaction.html'] = "/merchant/auction_cod_transaction/Completed";
$config['merchant-cod-auction/failed-transaction.html'] = "/merchant/auction_cod_transaction/Failed";
$config['merchant-cod-auction/hold-transaction.html'] = "/merchant/auction_cod_transaction/Pending";
$config['merchant-cod-auction/all-transaction/page/(.*)'] = "/merchant/auction_cod_transaction/mail/$1";
$config['merchant-cod-auction/success-transaction/page/(.*)'] = "/merchant/auction_cod_transaction/Completed/$1";
$config['merchant-cod-auction/failed-transaction/page/(.*)'] = "/merchant/auction_cod_transaction/Failed/$1";
$config['merchant-cod-auction/hold-transaction/page/(.*)'] = "/merchant/auction_cod_transaction/Pending/$1";

/** MERCHANT COD TRANSACTION  **/

$config['merchant-cod/all-transaction.html'] = "/merchant/cod_transaction";
$config['merchant-cod/success-transaction.html'] = "/merchant/cod_transaction/Completed";
$config['merchant-cod/failed-transaction.html'] = "/merchant/cod_transaction/Failed";
$config['merchant-cod/hold-transaction.html'] = "/merchant/cod_transaction/Pending";
$config['merchant-cod/all-transaction/page/(.*)'] = "/merchant/cod_transaction/mail/$1";
$config['merchant-cod/success-transaction/page/(.*)'] = "/merchant/cod_transaction/Completed/$1";
$config['merchant-cod/failed-transaction/page/(.*)'] = "/merchant/cod_transaction/Faild/$1";
$config['merchant-cod/hold-transaction/page/(.*)'] = "/merchant/cod_transaction/Pending/$1";

/** MERCHNAT SIDE AUCTION  **/

$config['merchant/add-auction.html'] = "/merchant/add_auction";
$config['merchant/manage-auction.html'] = "/merchant/manage_auction";
$config['merchant/manage-auction.html/page/(.*)'] = "/merchant/manage_auction/0/$1";
$config['merchant/archive-auction.html'] = "/merchant/manage_auction/1";
$config['merchant/archive-auction.html/page/(.*)'] = "/merchant/manage_auction/1/$1";
$config['merchant/view-auction/(.*)/(.*).html'] ="/merchant/view_auction/$1/$2";
$config['merchant/edit-auction/(.*)/(.*).html'] = "/merchant/edit_auction/$1/$2";
$config['merchant/block-auction/(.*)/(.*).html'] = "/merchant/block_auction/0/$1/$2";
$config['merchant/unblock-auction/(.*)/(.*).html'] = "/merchant/block_auction/1/$1/$2";
$config['merchant/delete-auction/(.*)/(.*).html'] = "/merchant/delete_auction/$1/$2";
$config['merchant/auction-dashboard.html'] = "/merchant/dashboard_auction";
$config['merchant/send-auction-email/(.*)/(.*).html'] ="/merchant/send_email/$1/$2";
$config['merchant-auction/winner-list.html'] = "/merchant/winner";
$config['merchant-auction/winner-list.html/page/(.*)'] = "/merchant/winner/$1";
$config['merchant-auction/shipping-delivery.html'] = "/merchant/auction_shipping_delivery";
$config['merchant-auction/shipping-delivery.html/page/(.*)'] = "/merchant/auction_shipping_delivery/$1";
$config['merchant-auction/cod-delivery.html'] = "/merchant/auction_cash_on_delivery";
$config['merchant-auction/cod-delivery.html/page/(.*)'] = "/merchant/auction_cash_on_delivery/$1";
$config['merchant-auction/delivery_status/(.*)/(.*)/(.*)/(.*)/(.*)/(.*).html']="/merchant/auction_update_delivery_status/$1/$2/$3/$4/$5/$6";
$config['merchant-auction-cod/delivery_status/(.*)/(.*)/(.*)/(.*)/(.*)/(.*)/(.*).html']="/merchant/auction_update_cod_delivery_status/$1/$2/$3/$4/$5/$6/$7";

/** MERCHANT AUCTION TRANSACTION  **/

$config['merchant-auction/all-transaction.html'] = "/merchant/auction_transaction";
$config['merchant-auction/success-transaction.html'] = "/merchant/auction_transaction/Success";
$config['merchant-auction/completed-transaction.html'] = "/merchant/auction_transaction/Completed";
$config['merchant-auction/failed-transaction.html'] = "/merchant/auction_transaction/Faild";
$config['merchant-auction/hold-transaction.html'] = "/merchant/auction_transaction/Pending";
$config['merchant-auction/all-transaction/page/(.*)'] = "/merchant/auction_transaction/mail/$1";
$config['merchant-auction/success-transaction/page/(.*)'] = "/merchant/auction_transaction/Success/$1";
$config['merchant-auction/completed-transaction/page/(.*)'] = "/merchant/auction_transaction/Completed/$1";
$config['merchant-auction/failed-transaction/page/(.*)'] = "/merchant/auction_transaction/Faild/$1";
$config['merchant-auction/hold-transaction/page/(.*)'] = "/merchant/auction_transaction/Pending/$1";
$config['delete-auction-images.html']="/merchant/delete_auction_images";

/** MERCHANT LOGIN **/

$config['merchant/add-deals.html'] = "/merchant/add_deals";
$config['merchant/manage-deals.html'] = "/merchant/manage_deals";
$config['merchant/manage-deals.html/page/(.*)'] = "/merchant/manage_deals/0/$1";
$config['merchant/archive-deals.html'] = "/merchant/manage_deals/1";
$config['merchant/archive-deals.html/page/(.*)'] = "/merchant/manage_deals/1/$1";
$config['merchant/view-deal/(.*)/(.*).html'] ="/merchant/view_deals/$1/$2";
$config['merchant/edit-deal/(.*)/(.*).html'] = "/merchant/edit_deals/$1/$2";
$config['merchant/block-deal/(.*)/(.*).html'] = "/merchant/block_deals/0/$1/$2";
$config['merchant/unblock-deal/(.*)/(.*).html'] = "/merchant/block_deals/1/$1/$2";
$config['merchant/send-deal-mail/(.*)/(.*).html'] ="/merchant/deal_send_email/$1/$2";
$config['merchant/deals-dashboard.html'] = "/merchant/dashboard_deals";
$config['merchant/close-couopn-list.html'] = "/merchant/closed_coupon";
$config['merchant/close-couopn-list.html/page/(.*)'] = "/merchant/closed_coupon/$1";

$config['merchant/add-shop.html'] = "merchant/add_merchant_shop";
$config['merchant/manage-shop.html'] = "/merchant/manage_merchant_shop";
$config['merchant/manage-shop.html/page/(.*)'] = "/merchant/manage_merchant_shop/$1";
$config['merchant/manage-shop/page/(.*)'] = "/merchant/manage_merchant_shop/$1";
$config['merchant/edit-shop/(.*).html'] = "/merchant/edit_merchant_shop/$1";
$config['merchant/block-shop/(.*).html'] = "/merchant/block_merchant_shop/0/$1";
$config['merchant/unblock-shop/(.*).html'] = "/merchant/block_merchant_shop/1/$1";

$config['merchant/add_fund_request.html'] = "/merchant/add_fund_request";
$config['merchant/fund_request.html'] = "/merchant/manage_fund_request";
$config['merchant/delete-fund-request/(.*)/(.*)'] = "/merchant/delete_fund_request/$1/$2";
$config['merchant/edit-fund-request/(.*)/(.*).html'] = "/merchant/edit_fund_request/$1/$2";
$config['delete-deal-images.html']="/merchant/delete_deal_images";
$config['merchant/shipping-account-settings.html'] = "/merchant/shipping_account_setting";


/** MARCHANT PRODUCT**/

$config['merchant/add-products.html'] = "/merchant/add_products";
$config['merchant/manage-products.html'] = "/merchant/manage_products";
$config['merchant/manage-products.html/page/(.*)'] = "/merchant/manage_products/0/$1";
$config['merchant/sold-products.html'] = "/merchant/manage_products/1";
$config['merchant/sold-products.html/page/(.*)'] = "/merchant/manage_products/1/$1";
$config['merchant/shipping-delivery.html'] = "/merchant/shipping_delivery";
$config['merchant/shipping-delivery.html/page/(.*)'] = "/merchant/shipping_delivery/$1";
$config['merchant/cash-delivery.html'] = "/merchant/cash_on_delivery";
$config['merchant/cash-delivery.html/page/(.*)'] = "/merchant/cash_on_delivery/$1";
$config['merchant/view-products/(.*)/(.*).html'] ="/merchant/view_products/$1/$2";
$config['merchant/edit-products/(.*)/(.*)/(.*).html'] = "/merchant/edit_products/$1/$2/$3";
$config['merchant/block-products/(.*)/(.*).html'] = "/merchant/block_products/0/$1/$2";
$config['merchant/unblock-products/(.*)/(.*).html'] = "/merchant/block_products/1/$1/$2";
$config['merchant/send-product/(.*)/(.*).html'] ="/merchant/product_send_email/$1/$2";
$config['merchant/products-dashboard.html'] = "/merchant/dashboard_products";
$config['merchant/delivery_status/(.*)/(.*)/(.*)/(.*).html']="/merchant/update_delivery_status/$1/$2/$3/$4";
$config['merchant/cod-delivery_status/(.*)/(.*)/(.*)/(.*)/(.*).html']="/merchant/update_cod_delivery_status/$1/$2/$3/$4/$5/$6/$7";
$config['merchant/confirm-product-status/(.*)/(.*).html'] = "/merchant/confirm_product/$1/$2";
$config['merchant/edit-product-status/(.*).html'] = "/merchant/edi_confirm_product/$1";


/** MARCHANT TRANSACTION **/

$config['merchant/transaction-dashboard.html'] = "/merchant/dashboard_transaction";
$config['merchant/all-transaction.html'] = "/merchant/admin_transaction";
$config['merchant/all-transaction.html/page/(.*)'] = "/merchant/admin_transaction";
$config['merchant/success-transaction.html'] = "/merchant/admin_transaction/Success";
$config['merchant/completed-transaction.html'] = "/merchant/admin_transaction/Completed";
$config['merchant/failed-transaction.html'] = "/merchant/admin_transaction/Faild";
$config['merchant/hold-transaction.html'] = "/merchant/admin_transaction/Pending";

$config['merchant/all-transaction/page/(.*)'] = "/merchant/admin_transaction/mail/$1";
$config['merchant/success-transaction/page/(.*)'] = "/merchant/admin_transaction/Success/$1";
$config['merchant/completed-transaction/page/(.*)'] = "/merchant/admin_transaction/Completed/$1";
$config['merchant/failed-transaction/page/(.*)'] = "/merchant/admin_transaction/Faild/$1";
$config['merchant/hold-transaction/page/(.*)'] = "/merchant/admin_transaction/Pending/$1";

$config['merchant/couopn_code.html'] = "/merchant/couopn_code";
$config['merchant/close-deals/(.*)/(.*)/(.*)/(.*).html'] = "/merchant/close_deals/0/$1/$2/$3/$4";
$config['merchant/forgot-password.html'] = "/merchant/forgot_password";
$config['facebookpost.php'] = "/merchant/facebook_auto_post";

$config['merchant/terms-and-conditions.html'] = '/merchant/terms_and_conditions';
$config['merchant/return-policy.html'] = '/merchant/return_policy';
$config['merchant/warranty.html'] = '/merchant/about_us';
$config['merchant/store-personalized/(.*).html'] = '/merchant/store_personalized/$1';

/** MERCHANT MODERATOR **/
$config['merchant/moderator-dashboard.html'] = "/merchant/dashboard_moderator";
$config['merchant/add-moderator.html'] = "/merchant/add_moderator";
$config['merchant/manage-moderator.html'] = "/merchant/manage_moderator";
$config['merchant/manage-moderator.html/page/(.*)'] = "/merchant/manage_moderator/$1";
$config['merchant/edit-moderator/(.*).html'] = "/merchant/edit_moderator/$1";
$config['merchant/block-moderator/(.*)/(.*).html'] = "/merchant/block_moderator/0/$1/$2";
$config['merchant/unblock-moderator/(.*)/(.*).html'] = "/merchant/block_moderator/1/$1/$2";
$config['merchant/delete-moderator/(.*)/(.*).html'] = "/merchant/delete_moderator/$1/$2";
$config['merchant/view-moderator/(.*).html'] ="/merchant/view_moderator/$1";

/** NEWSLETTER **/

$config['merchant/send-newsletter.html'] = "/merchant/send_emails";
$config['merchant/send-moderator-newsletter.html'] = "/merchant/send_moderator_emails";
$config['merchant/send-merchant-newsletter.html'] = "/merchant/send_merchant_emails";
$config['merchant/merchant_email_inbox.html'] = "/merchant/merchant_mail_inbox";
$config['merchant/merchant_email_inbox.html/page/(.*)'] = "/merchant/merchant_mail_inbox/$1";
$config['merchant/show-user-message/(.*).html'] = "/merchant/show_user_message/$1";
$config['merchant/show-merchant-message/(.*).html'] = "/merchant/show_merchant_message/$1";
$config['merchant/moderator_email_inbox.html'] = "/merchant/moderator_mail_inbox";
$config['merchant/moderator_email_inbox.html/page/(.*)'] = "/merchant/moderator_mail_inbox/$1";
$config['merchant/show-merchant-message/(.*).html'] = "/merchant/show_moderator_message/$1";



/* DURATION MANAGEMENT */
$config['merchant/add-duration.html'] = "/merchant/add_duration";
$config['merchant/edit-duration/(.*).html'] = "/merchant/edit_duration/$1";
$config['merchant/manage-duration.html'] = "/merchant/manage_duration";
$config['merchant/manage-duration.htm/page/(.*)'] = "/merchant/manage_duration/$1";
$config['merchant/block-duration/(.*).html'] = "/merchant/block_duration/0/$1";
$config['merchant/unblock-duration/(.*).html'] = "/merchant/block_duration/1/$1";
$config['merchant/delete-duration/(.*)/(.*).html'] = "/merchant/delete_duration/$1/$2";

/** SPENT FREE GIFT **/

$config['merchant/add-free-gift.html'] = "/merchant/add_free_gift";
$config['merchant/edit-gift/(.*)/(.*).html'] = "/merchant/edit_gift/$1/$2";
$config['merchant/manage-free-gift.html'] = "/merchant/manage_free_gift";
$config['merchant/manage-free-gift.html/page/(.*)'] = "/merchant/manage_free_gift/$1";
$config['merchant/block-gift/(.*).html'] = "/merchant/block_gift/0/$1";
$config['merchant/unblock-gift/(.*).html'] = "/merchant/block_gift/1/$1";
$config['merchant/delete-gift/(.*)/(.*).html'] = "/merchant/delete_gift/$1/$2";


$config['merchant-storecredits/all-transaction.html'] = "/merchant/storecredits_transaction";
$config['merchant-storecredits/success-transaction.html'] = "/merchant/storecredits_transaction/Completed";
$config['merchant-storecredits/failed-transaction.html'] = "/merchant/storecredits_transaction/Failed";
$config['merchant-storecredits/hold-transaction.html'] = "/merchant/storecredits_transaction/Pending";
$config['merchant-storecredits/all-transaction/page/(.*)'] = "/merchant/storecredits_transaction/mail/$1";
$config['merchant-storecredits/success-transaction/page/(.*)'] = "/merchant/storecredits_transaction/Completed/$1";
$config['merchant-storecredits/failed-transaction/page/(.*)'] = "/merchant/storecredits_transaction/Faild/$1";
$config['merchant-storecredits/hold-transaction/page/(.*)'] = "/merchant/storecredits_transaction/Pending/$1";

/** COLOR MANAGEMENT  **/

$config['merchant/add-color.html'] = "/merchant/add_color";
$config['merchant/manage-colors.html'] = "/merchant/manage_colors";
$config['merchant/manage-colors.html/page/(.*)'] = "/merchant/manage_colors/$1";
$config['merchant/edit-color/(.*).html'] = "/merchant/edit_color/$1";

/** SIZE MANGEMENT **/

$config['merchant/add-size.html'] = "/merchant/add_size";
$config['merchant/manage-sizes.html'] = "/merchant/manage_sizes";
$config['admin/manage-sizes.html/page/(.*)'] = "/merchant/manage_sizes/$1";
$config['merchant/edit-size/(.*).html'] = "/merchant/edit_size/$1";


/** Category **/

$config['merchant/add-category.html'] = "/merchant/add_category";
$config['merchant/edit-category/(.*)/(.*).html'] = "/merchant/edit_category/$1/$2";
$config['merchant/manage-category.html'] = "/merchant/manage_category";
$config['merchant/block-category/(.*)/(.*).html'] = "/merchant/block_category/0/$1/$2";
$config['merchant/unblock-category/(.*)/(.*).html'] = "/merchant/block_category/1/$1/$2";
$config['merchant/delete-category/(.*)/(.*).html'] = "/merchant/delete_category/$1/$2";

/** Sub Category **/

$config['merchant/add-sub-category/(.*)/(.*).html'] = "/merchant/add_sub_category/$1/$2";
$config['merchant/edit-sub-category/(.*)/(.*).html'] = "/merchant/edit_sub_category/$1/$2";
$config['merchant/manage-sub-category/(.*)/(.*).html'] = "/merchant/manage_sub_category/$1/$2";
$config['merchant/block-sub-category/(.*)/(.*)/(.*).html'] = "/merchant/block_sub_category/0/$1/$2/$3";
$config['merchant/unblock-sub-category/(.*)/(.*)/(.*).html'] = "/merchant/block_sub_category/1/$1/$2/$3";

/** Secound layer Category **/

$config['merchant/add-sec-sub-category/(.*)/(.*).html'] = "/merchant/add_sec_sub_category/$1/$2";
$config['merchant/edit-sec-sub-category/(.*)/(.*).html'] = "/merchant/edit_sec_sub_category/$1/$2";
$config['merchant/manage-sec-sub-category/(.*)/(.*).html'] = "/merchant/manage_sec_sub_category/$1/$2";
$config['merchant/block-sec-sub-category/(.*)/(.*)/(.*).html'] = "/merchant/block_sec_sub_category/0/$1/$2/$3";
$config['merchant/unblock-sec-sub-category/(.*)/(.*)/(.*).html'] = "/merchant/block_sec_sub_category/1/$1/$2/$3";
$config['merchant/sec-sub-delete-category/(.*)/(.*).html'] = "/merchant/sec_sub_delete_category/$1/$2";

/** Third layer Category **/

$config['merchant/add-third-sub-category/(.*)/(.*).html'] = "/merchant/add_third_sub_category/$1/$2";
$config['merchant/edit-third-sub-category/(.*)/(.*).html'] = "/merchant/edit_third_sub_category/$1/$2";
$config['merchant/manage-third-sub-category/(.*)/(.*).html'] = "/merchant/manage_third_sub_category/$1/$2";
$config['merchant/block-third-sub-category/(.*)/(.*)/(.*).html'] = "/merchant/block_third_sub_category/0/$1/$2/$3";
$config['merchant/unblock-third-sub-category/(.*)/(.*)/(.*).html'] = "/merchant/block_third_sub_category/1/$1/$2/$3";
$config['merchant/third-sub-delete-category/(.*)/(.*).html'] = "/merchant/third_sub_delete_category/$1/$2";

/** ATTRIBUTE MANAGEMENT  **/

$config['merchant/add-attribute.html'] = "/merchant/add_attribute";
$config['merchant/manage-attribute.html'] = "/merchant/manage_attribute";
$config['merchant/manage-attribute.html/page/(.*)'] = "/merchant/manage_attribute/$1";
$config['merchant/edit-attribute/(.*).html'] = "/merchant/edit_attribute/$1";


/** ATTRIBUTE GROUP MANAGEMENT  **/

$config['merchant/add-attribute-group.html'] = "/merchant/add_attribute_group";
$config['merchant/manage-attribute-group.html'] = "/merchant/manage_attribute_group";
$config['merchant/manage-attribute-group.html/page/(.*)'] = "/merchant/manage_attribute_group/$1";
$config['merchant/edit-attribute-group/(.*).html'] = "/merchant/edit_attribute_group/$1";
$config['merchant/delete-attribute-group/(.*).html'] = "/merchant/delete_attribute_group/$1";

/* STORECREDIT ORDER MANAGEMENT */
$config['merchant/storecredit/pending-transaction.html'] = "/merchant/storecredit_transaction";
$config['merchant/storecredit/pending-transaction.html/page/(.*)'] = "/merchant/storecredit_transaction";
$config['merchant/storecredit/success-transaction.html'] = "/merchant/storecredit_transaction/Success";
$config['merchant/storecredit/purchase-transaction.html'] = "/merchant/storecredit_transaction/Purchased";
$config['merchant/storecredit/failed-transaction.html'] = "/merchant/storecredit_transaction/Failed";

$config['merchant/storecredit-status/(.*)/(.*)/(.*).html'] = "/merchant/storecredit_status/$1/$2/$3";


$config['merchant/add-template.html'] = "merchant/add_template";
$config['merchant/manage-template.html'] = "merchant/manage_template";
$config['merchant/manage-template.html/page/(.*)'] = "merchant/manage_template/$1";
$config['merchant/edit-template/(.*).html'] = "merchant/edit_template/$1";
$config['merchant/block-template/(.*).html'] = "merchant/blockunblock_template/0/$1";
$config['merchant/unblock-template/(.*).html'] = "merchant/blockunblock_template/1/$1";
$config['merchant/delete-template/(.*).html'] = "merchant/delete_template/$1";
