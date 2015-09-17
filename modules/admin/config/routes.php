<?php defined('SYSPATH') OR die('No direct access allowed.');

/** Admin Details **/

$config['admin.html'] = '/admin';
$config['admin-login.html'] = "/admin/login";
$config['logout.html'] = "/layout/logout";
$config['admin/settings.html'] = '/admin/admin_settings';
$config['admin/Edit_info.html'] = '/admin/edit_admin';
$config['admin/change_password.html'] = '/admin/admin_password';

/** All settings **/

$config['admin/general-settings.html'] = "/settings/general_setting";
$config['admin/email-settings.html'] = "/settings/email_settings";
$config['admin/smtp-mailer-settings.html'] = "/settings/smtp_mailer_settings";
$config['admin/social-media-settings.html'] = "/settings/api_socialmedia";
$config['admin/payment-settings.html'] = "settings/payment_setting";
$config['admin/shipping-account-settings.html'] = "settings/shipping_account_setting";
$config['admin/logo-settings.html'] = "/settings/image_settings/logo";
$config['admin/favicon-settings.html'] = "/settings/image_settings/favicon";
$config['admin/noimage-settings.html'] = "/settings/image_settings/noimage";
$config['admin/image-zoom-settings.html'] = "/settings/image_zoom_settings";
$config['admin/manage-themes.html'] = "/admin/manage_themes";
$config['admin/module-settings.html'] = "settings/module_setting";

/** Country **/

$config['admin/add-country.html'] = "/admin/add_country";
$config['admin/edit-country/(.*).html'] = "/admin/edit_country/$1";
$config['admin/delete-country/(.*).html'] = "/admin/delete_country/$1";
$config['admin/block-country/(.*).html'] = "/admin/block_country/0/$1";
$config['admin/unblock-country/(.*).html'] = "/admin/block_country/1/$1";
$config['admin/manage-country.html'] = "/admin/manage_country";

/** City **/

$config['admin/add-city.html'] = "/admin/add_city";
$config['admin/edit-city/(.*)/(.*).html'] = "/admin/edit_city/$1/$2";
$config['admin/manage-city.html'] = "/admin/manage_city";
$config['admin/delete-city/(.*)/(.*).html'] = "/admin/delete_city/$1/$2";
$config['admin/block-city/(.*)/(.*).html'] = "/admin/block_city/0/$1/$2";
$config['admin/unblock-city/(.*)/(.*).html'] = "/admin/block_city/1/$1/$2";
$config['admin/city-maping/(.*)/(.*)/(.*).html'] = "/admin/city_map/$1/$2/$3";

/** COLOR MANAGEMENT  **/

$config['admin/add-color.html'] = "/admin/add_color";
$config['admin/manage-colors.html'] = "/admin/manage_colors";
$config['admin/manage-colors.html/page/(.*)'] = "/admin/manage_colors/$1";
$config['admin/edit-color/(.*).html'] = "/admin/edit_color/$1";
$config['admin/delete-color/(.*).html'] = "/admin/delete_color/$1";

/** SIZE MANGEMENT **/

$config['admin/add-size.html'] = "/admin/add_size";
$config['admin/manage-sizes.html'] = "/admin/manage_sizes";
$config['admin/manage-sizes.html/page/(.*)'] = "/admin/manage_sizes/$1";
$config['admin/edit-size/(.*).html'] = "/admin/edit_size/$1";
$config['admin/delete-size/(.*).html'] = "/admin/delete_size/$1";
$config['admin/block-size/(.*).html'] = "/admin/block_unblock_size/0/$1";
$config['admin/unblock-size/(.*).html'] = "/admin/block_unblock_size/1/$1";

/** BANNER IMAGE SETTING  **/

$config['admin/add-banner-image.html'] = "/settings/add_banner_image";
$config['admin/manage-banner-images.html'] = "/settings/manage_banner_images";
$config['admin/manage-banner-images.html/page/(.*)'] = "/settings/manage_banner_images/$1";
$config['admin/edit-banner-image/(.*).html'] = "/settings/edit_banner_image/$1";
$config['admin/delete-banner-image/(.*).html'] = "/settings/delete_banner_image/$1";
$config['admin/block-banner-image/(.*).html'] = "/settings/block_unblock_banner_image/0/$1";
$config['admin/unblock-banner-image/(.*).html'] = "/settings/block_unblock_banner_image/1/$1";

/** Category **/

$config['admin/add-category.html'] = "/admin/add_category";
$config['admin/edit-category/(.*)/(.*).html'] = "/admin/edit_category/$1/$2";
$config['admin/manage-category.html'] = "/admin/manage_category";
$config['admin/block-category/(.*)/(.*).html'] = "/admin/block_category/0/$1/$2";
$config['admin/unblock-category/(.*)/(.*).html'] = "/admin/block_category/1/$1/$2";
$config['admin/delete-category/(.*)/(.*).html'] = "/admin/delete_category/$1/$2";

/** Sub Category **/

$config['admin/add-sub-category/(.*)/(.*).html'] = "/admin/add_sub_category/$1/$2";
$config['admin/edit-sub-category/(.*)/(.*).html'] = "/admin/edit_sub_category/$1/$2";
$config['admin/manage-sub-category/(.*)/(.*).html'] = "/admin/manage_sub_category/$1/$2";
$config['admin/block-sub-category/(.*)/(.*)/(.*).html'] = "/admin/block_sub_category/0/$1/$2/$3";
$config['admin/unblock-sub-category/(.*)/(.*)/(.*).html'] = "/admin/block_sub_category/1/$1/$2/$3";

/** Secound layer Category **/

$config['admin/add-sec-sub-category/(.*)/(.*).html'] = "/admin/add_sec_sub_category/$1/$2";
$config['admin/edit-sec-sub-category/(.*)/(.*).html'] = "/admin/edit_sec_sub_category/$1/$2";
$config['admin/manage-sec-sub-category/(.*)/(.*).html'] = "/admin/manage_sec_sub_category/$1/$2";
$config['admin/block-sec-sub-category/(.*)/(.*)/(.*).html'] = "/admin/block_sec_sub_category/0/$1/$2/$3";
$config['admin/unblock-sec-sub-category/(.*)/(.*)/(.*).html'] = "/admin/block_sec_sub_category/1/$1/$2/$3";
$config['admin/sec-sub-delete-category/(.*)/(.*).html'] = "/admin/sec_sub_delete_category/$1/$2";

/** Third layer Category **/

$config['admin/add-third-sub-category/(.*)/(.*).html'] = "/admin/add_third_sub_category/$1/$2";
$config['admin/edit-third-sub-category/(.*)/(.*).html'] = "/admin/edit_third_sub_category/$1/$2";
$config['admin/manage-third-sub-category/(.*)/(.*).html'] = "/admin/manage_third_sub_category/$1/$2";
$config['admin/block-third-sub-category/(.*)/(.*)/(.*).html'] = "/admin/block_third_sub_category/0/$1/$2/$3";
$config['admin/unblock-third-sub-category/(.*)/(.*)/(.*).html'] = "/admin/block_third_sub_category/1/$1/$2/$3";
$config['admin/third-sub-delete-category/(.*)/(.*).html'] = "/admin/third_sub_delete_category/$1/$2";

/** DEAL COMMENTS **/

$config['admin/manage-deal-comments.html'] = "/admin_deals/manage_users_comments/1";
$config['admin/manage-deal-comments.html/page/(.*)'] = "/admin_deals/manage_users_comments/1/$1";
$config['admin/edit-deal-comments/(.*).html'] = "/admin_deals/edit_users_comments/$1";
$config['admin/block-deal-comments/(.*).html'] = "/admin_deals/block_users_comments/0/$1";
$config['admin/unblock-deal-comments/(.*).html'] = "/admin_deals/block_users_comments/1/$1";
$config['admin/delete-deal-comments/(.*).html'] = "/admin_deals/delete_users_comments/$1";

/** PRODUCT COMMENTS  **/

$config['admin/manage-product-comments.html'] = "/admin_products/manage_users_comments/2";
$config['admin/manage-product-comments.html/page/(.*)'] = "/admin_products/manage_users_comments/$1/2";
$config['admin/edit-product-comments/(.*).html'] = "/admin_products/edit_users_comments/$1";
$config['admin/block-product-comments/(.*).html'] = "/admin_products/block_users_comments/0/$1";
$config['admin/unblock-product-comments/(.*).html'] = "/admin_products/block_users_comments/1/$1";
$config['admin/delete-product-comments/(.*).html'] = "/admin_products/delete_users_comments/$1";

/** AUCTION COMMENTS  **/

$config['admin/manage-auction-comments.html'] = "/admin_auction/manage_users_comments/3";
$config['admin/manage-auction-comments.html/page/(.*)'] = "/admin_auction/manage_users_comments/$1/3";
$config['admin/edit-auction-comments/(.*).html'] = "/admin_auction/edit_users_comments/$1";
$config['admin/block-auction-comments/(.*).html'] = "/admin_auction/block_users_comments/0/$1";
$config['admin/unblock-auction-comments/(.*).html'] = "/admin_auction/block_users_comments/1/$1";
$config['admin/delete-auction-comments/(.*).html'] = "/admin_auction/delete_users_comments/$1";

/** STORE COMMENTS  **/

$config['admin/manage-store-comments.html'] = "/admin_merchant/manage_users_comments";
$config['admin/manage-store-comments.html/page/(.*)'] = "/admin_merchant/manage_users_comments/$1";
$config['admin/edit-store-comments/(.*).html'] = "/admin_merchant/edit_users_comments/$1";
$config['admin/block-store-comments/(.*).html'] = "/admin_merchant/block_users_comments/0/$1";
$config['admin/unblock-store-comments/(.*).html'] = "/admin_merchant/block_users_comments/1/$1";
$config['admin/delete-store-comments/(.*).html'] = "/admin_merchant/delete_users_comments/$1";

/** Users **/

$config['admin/add-user.html'] = "/admin_users/add_users";
$config['admin/manage-user.html'] = "/admin_users/manage_users";
$config['admin/manage-user.html/page/(.*)'] = "/admin_users/manage_users/$1";
$config['admin/edit-user/(.*).html'] = "/admin_users/edit_users/$1";
$config['admin/block-user/(.*)/(.*).html'] = "/admin_users/block_user/0/$1/$2";
$config['admin/unblock-user/(.*)/(.*).html'] = "/admin_users/block_user/1/$1/$2";
$config['admin/delete-user/(.*)/(.*).html'] = "/admin_users/delete_user/$1/$2";
$config['admin/view-user/(.*).html'] ="/admin_users/view_user/$1";
$config['admin/users-dashboard.html'] = "/admin_users/dashboard_users";

/**MANAGE EMaIL SUBSCRIBER **/

$config['admin/manage-email-subscriber.html'] = "/admin/manage_email_subscriber";
$config['admin/manage-email-subscriber.html/page/(.*)'] = "/admin/manage_email_subscriber/$1";
$config['admin/block-subscribe/(.*).html'] = "/admin/block_subscriber/0/$1";
$config['admin/unblock-subscribe/(.*).html'] = "/admin/block_subscriber/1/$1";
$config['admin/delete-subscribe/(.*).html'] = "/admin/delete_subscriber/$1";

/** MANAGE REFERRAL USERS   **/

$config['admin/manage-referral-users.html'] = "/admin/manage_referral_users";
$config['admin/manage-referral-users.html/page/(.*)'] = "/admin/manage_referral_users/$1";

/** FAQ **/

$config['faq_mgt/add_faq.html'] = "faq/add_faq";
$config['faq_mgt/manage_faq.html']="faq/manage_faq";
$config['manage_faq/page/(.*)'] = "faq/manage_faq/$1";
$config['faq/block-faq/(.*)'] = "/faq/block_faq/0/$1";
$config['faq/unblock-faq/(.*)'] = "/faq/block_faq/1/$1";
$config['faq/delete-faq/(.*)'] = "/faq/delete_faq/$1";
$config['faq/edit-faq/(.*)'] = "/faq/edit_faq/$1";

/**MANAGE CONTACT US **/

$config['admin/manage-contacts.html'] = "/admin/manage_contacts";
$config['admin/manage-contacts.html/page/(.*)'] = "/admin/manage_contacts/$1";
$config['admin/delete-contacts/(.*).html'] = "/admin/delete_contact/$1";
$config['admin/send-mail/(.*).html'] = "/admin/send_mail/$1";

/** SHIPPING DELIVERY **/

$config['admin/shipping-delivery.html'] = "/admin_products/shipping_delivery";
$config['admin/shipping-delivery.html/page/(.*)'] = "/admin_products/shipping_delivery/$1";
$config['admin/cash-delivery.html'] = "/admin_products/cash_on_delivery";
$config['admin/cash-delivery.html/page/(.*)'] = "/admin_products/cash_on_delivery/$1";
$config['admin/delivery_status/(.*)/(.*)/(.*)/(.*).html']="/admin_products/update_delivery_status/$1/$2/$3/$4";
$config['admin/cod-delivery_status/(.*)/(.*)/(.*)/(.*)/(.*).html']="/admin_products/update_cod_delivery_status/$1/$2/$3/$4/$5/$6/$7";

/** BLOG **/

$config['admin/add-blog.html'] = "/admin_blog/add_blog";
$config['admin/manage-publish-blog.html'] = "/admin_blog/manage_blog/1";
$config['admin/manage-draft-blog.html'] = "/admin_blog/manage_blog/2";
$config['admin/manage-publish-blog.html/page/(.*)'] = "/admin_blog/manage_blog/1/$1";
$config['admin/manage-draft-blog.html/page/(.*)'] = "/admin_blog/manage_blog/2/$1";
$config['admin/block-blog/(.*)/(.*)/(.*).html'] = "/admin_blog/block_blog/0/$1/$2/$3";
$config['admin/unblock-blog/(.*)/(.*)/(.*).html'] = "/admin_blog/block_blog/1/$1/$2/$3";
$config['admin/edit-blog/(.*)/(.*)/(.*).html'] = "/admin_blog/edit_blog/$1/$2/$3";
$config['admin/delete-blog/(.*)/(.*)/(.*).html'] = "/admin_blog/delete_blog/$1/$2/$3";
$config['admin/view-blog/(.*)/(.*)/(.*).html'] = "/admin_blog/view_blog/$1/$2/$3";
$config['admin/blog-settings.html'] = "/admin_blog/blog_settings";
$config['admin/publish-blog/(.*)/(.*)/(.*).html'] = "/admin_blog/publish_blog/$1/$2/$3";

/** BLOG COMMENTS **/

$config['admin/manage-comments/(.*).html'] = "/admin_blog/manage_comment/$1";
$config['admin/block-comments/(.*)/(.*).html'] = "/admin_blog/block_comments/0/$1/$2";
$config['admin/unblock-comments/(.*)/(.*).html'] = "/admin_blog/block_comments/1/$1/$2";
$config['admin/delete-comments/(.*).html'] = "/admin_blog/delete_comments/$1";
$config['admin/disapprove-comments/(.*)/(.*).html'] = "/admin_blog/approvedisapprove_comments/0/$1/$2";
$config['admin/approve-comments/(.*)/(.*).html'] = "/admin_blog/approvedisapprove_comments/1/$1/$2";

/** CMS PAGES **/

$config['cms/about-us.html'] = "/admin_cms/about_us";
$config['cms/add-pages.html'] = "/admin_cms/add_cms_page";
$config['cms/manage-pages.html'] = "/admin_cms/Manage_cms_page";
$config['cms/edit-cms/(.*)/(.*).html'] = "/admin_cms/edit_cms/$1/$2";
$config['cms/delete-cms/(.*)/(.*).html'] = "/admin_cms/delete_cms/$1/$2";
$config['cms/block-cms/(.*)/(.*).html'] = "/admin_cms/block_cms/0/$1/$2";
$config['cms/unblock-cms/(.*)/(.*).html'] = "/admin_cms/block_cms/1/$1/$2";
$config['cms/deals-bought.html'] = "/admin_cms/deals_bought";
$config['cms/copy-right.html'] = "/admin_cms/copy_right";

/** DEALS **/

$config['admin/add-deals.html'] = "/admin_deals/add_deal";
$config['admin/manage-deals.html'] = "/admin_deals/manage_deals";
$config['admin/manage-deals.html/page/(.*)'] = "/admin_deals/manage_deals/0/$1";
$config['admin/archive-deals.html'] = "/admin_deals/manage_deals/1";
$config['admin/archive-deals.html/page/(.*)'] = "/admin_deals/manage_deals/1/$1";
$config['admin/view-deal/(.*)/(.*).html'] ="/admin_deals/view_deals/$1/$2";
$config['admin/edit-deal/(.*)/(.*).html'] = "/admin_deals/edit_deals/$1/$2";
$config['admin/block-deal/(.*)/(.*).html'] = "/admin_deals/block_deals/0/$1/$2";
$config['admin/unblock-deal/(.*)/(.*).html'] = "/admin_deals/block_deals/1/$1/$2";
$config['admin/delete-deal/(.*)/(.*).html'] = "/admin_deals/delete_deals/$1/$2";
$config['admin/delete-deals.html'] = "admin/delete_deals";
$config['admin/deals-dashboard.html'] = "/admin_deals/dashboard_deals";
$config['admin/send-deal-mail/(.*)/(.*).html'] ="/admin_deals/send_email/$1/$2";
$config['admin/close-couopn-list.html'] = "/admin_deals/closed_coupon";
$config['admin/close-couopn-list.html/page/(.*)'] = "/admin_deals/closed_coupon/$1";
$config['admin-deal/cash-delivery.html'] = "/admin_deals/cash_on_delivery";
$config['admin-deal/cash-delivery.html/page/(.*)'] = "/admin_deals/cash_on_delivery/$1";
$config['delete-images.html']="/admin_deals/delete_images";

/** ADMIN AUCTION **/

$config['admin/add-auction.html'] = "/admin_auction/add_auction";
$config['admin/manage-auction.html'] = "/admin_auction/manage_auction";
$config['admin/manage-auction.html/page/(.*)'] = "/admin_auction/manage_auction/0/$1";
$config['admin/archive-auction.html'] = "/admin_auction/manage_auction/1";
$config['admin/archive-auction.html/page/(.*)'] = "/admin_auction/manage_auction/1/$1";
$config['admin/view-auction/(.*)/(.*).html'] ="/admin_auction/view_auction/$1/$2";
$config['admin/edit-auction/(.*)/(.*).html'] = "/admin_auction/edit_auction/$1/$2";
$config['admin/block-auction/(.*)/(.*).html'] = "/admin_auction/block_auction/0/$1/$2";
$config['admin/unblock-auction/(.*)/(.*).html'] = "/admin_auction/block_auction/1/$1/$2";
$config['admin/delete-auction/(.*)/(.*).html'] = "/admin_auction/delete_auction/$1/$2";
$config['admin/auction-dashboard.html'] = "/admin_auction/dashboard_auction";
$config['admin-auction/send-auction-email/(.*)/(.*).html'] ="/admin_auction/send_email/$1/$2";
$config['admin-auction/winner-list.html'] = "/admin_auction/winner";
$config['admin-auction/winner-list.html/page/(.*)'] = "/admin_auction/winner/$1";
$config['admin-auction/shipping-delivery.html'] = "/admin_auction/shipping_delivery";
$config['admin-auction/shipping-delivery.html/page/(.*)'] = "/admin_auction/shipping_delivery/$1";
$config['admin-auction/cod-delivery.html'] = "/admin_auction/cash_on_delivery";
$config['admin-auction/cod-delivery.html/page/(.*)'] = "/admin_auction/cash_on_delivery/$1";
$config['admin-auction/delivery_status/(.*)/(.*)/(.*)/(.*)/(.*)/(.*).html']="/admin_auction/update_delivery_status/$1/$2/$3/$4/$5/$6";
$config['admin-auction-cod/delivery_status/(.*)/(.*)/(.*)/(.*)/(.*)/(.*)/(.*).html']="/admin_auction/update_cod_delivery_status/$1/$2/$3/$4/$5/$6/$7";


/** ADMIN AUCTION  TRANSACTION**/

$config['admin-auction/all-transaction.html'] = "/admin_payment/auction_transaction";
$config['admin-auction/success-transaction.html'] = "/admin_payment/auction_transaction/Success";
$config['admin-auction/completed-transaction.html'] = "/admin_payment/auction_transaction/Completed";
$config['admin-auction/failed-transaction.html'] = "/admin_payment/auction_transaction/Faild";
$config['admin-auction/hold-transaction.html'] = "/admin_payment/auction_transaction/Pending";
$config['admin-auction/all-transaction/page/(.*)'] = "/admin_payment/auction_transaction/mail/$1";
$config['admin-auction/success-transaction/page/(.*)'] = "/admin_payment/auction_transaction/Success/$1";
$config['admin-auction/completed-transaction/page/(.*)'] = "/admin_payment/auction_transaction/Completed/$1";
$config['admin-auction/failed-transaction/page/(.*)'] = "/admin_payment/auction_transaction/Faild/$1";
$config['admin-auction/hold-transaction/page/(.*)'] = "/admin_payment/auction_transaction/Pending/$1";
$config['delete-auction1-images.html']="/admin_auction/delete_auction_images";

/** ADMIN PRODUCT TRANSACTION  **/

$config['admin-product/all-transaction.html'] = "/admin_payment/product_transaction";
$config['admin-product/success-transaction.html'] = "/admin_payment/product_transaction/Success";
$config['admin-product/completed-transaction.html'] = "/admin_payment/product_transaction/Completed";
$config['admin-product/failed-transaction.html'] = "/admin_payment/product_transaction/Faild";
$config['admin-product/hold-transaction.html'] = "/admin_payment/product_transaction/Pending";
$config['admin-product/all-transaction/page/(.*)'] = "/admin_payment/product_transaction/mail/$1";
$config['admin-product/success-transaction/page/(.*)'] = "/admin_payment/product_transaction/Success/$1";
$config['admin-product/completed-transaction/page/(.*)'] = "/admin_payment/product_transaction/Completed/$1";
$config['admin-product/failed-transaction/page/(.*)'] = "/admin_payment/product_transaction/Faild/$1";
$config['admin-product/hold-transaction/page/(.*)'] = "/admin_payment/product_transaction/Pending/$1";

/** ADMIN COD TRANSACTION  **/

$config['admin-cod/all-transaction.html'] = "/admin_payment/cod_transaction";
$config['admin-cod/success-transaction.html'] = "/admin_payment/cod_transaction/Completed";
$config['admin-cod/failed-transaction.html'] = "/admin_payment/cod_transaction/Failed";
$config['admin-cod/hold-transaction.html'] = "/admin_payment/cod_transaction/Pending";
$config['admin-cod/all-transaction/page/(.*)'] = "/admin_payment/cod_transaction/mail/$1";
$config['admin-cod/success-transaction/page/(.*)'] = "/admin_payment/cod_transaction/Completed/$1";
$config['admin-cod/failed-transaction/page/(.*)'] = "/admin_payment/cod_transaction/Failed/$1";
$config['admin-cod/hold-transaction/page/(.*)'] = "/admin_payment/cod_transaction/Pending/$1";

/** ADMIN AUCTION COD TRANSACTION  **/

$config['admin-cod-auction/all-transaction.html'] = "/admin_payment/auction_cod_transaction";
$config['admin-cod-auction/success-transaction.html'] = "/admin_payment/auction_cod_transaction/Completed";
$config['admin-cod-auction/failed-transaction.html'] = "/admin_payment/auction_cod_transaction/Failed";
$config['admin-cod-auction/hold-transaction.html'] = "/admin_payment/auction_cod_transaction/Pending";
$config['admin-cod-auction/all-transaction/page/(.*)'] = "/admin_payment/auction_cod_transaction/mail/$1";
$config['admin-cod-auction/success-transaction/page/(.*)'] = "/admin_payment/auction_cod_transaction/Completed/$1";
$config['admin-cod-auction/failed-transaction/page/(.*)'] = "/admin_payment/auction_cod_transaction/Failed/$1";
$config['admin-cod-auction/hold-transaction/page/(.*)'] = "/admin_payment/auction_cod_transaction/Pending/$1";

/** NEWS LETTER **/

$config['admin/subscribed-user.html'] = "/newsletter/subscribed_user";
$config['admin/subscribed-user.html/page/(.*)'] = "/newsletter/subscribed_user/0/$1";
$config['admin/delete-subscriber/(.*).html'] = "/newsletter/delete_subscriber/$1";
$config['admin/block-subscriber/(.*).html'] = "/newsletter/block_subscriber/0/$1";
$config['admin/unblock-subscriber/(.*).html'] = "/newsletter/block_subscriber/1/$1";
$config['admin/send-newsletter.html'] = "/newsletter/send_emails";
$config['admin/send-daily-deals.html'] = "/newsletter/send_daily_deals";
$config['admin/send-daily.html'] = "/newsletter/send_daily";
$config['admin/inquiries.html'] = "/inquirie/cus_inquiries";
$config['admin/detail/(.*).html'] = "/inquirie/con_details/$1";
$config['admin/delete/(.*).html'] = "/inquirie/con_delete/$1";
$config['admin/sendmail/(.*).html'] = "/inquirie/send_mail/$1";
$config['admin/contact-status/(.*)/(.*).html'] = "/inquirie/con_status/$1/$2";

/** ADMIN MERCHANT **/

$config['admin/add-merchant.html'] = "/admin_merchant/add_merchant";
$config['admin/merchant.html'] = "/admin_merchant/manage_merchant";
$config['admin/merchant.html/page/(.*)'] = "/admin_merchant/manage_merchant/$1";
$config['admin/edit-merchant/(.*).html'] = "/admin_merchant/edit_merchant/$1";
$config['admin/block-merchant/(.*)/(.*).html'] = "/admin_merchant/block_merchant/0/$1/$2";
$config['admin/unblock-merchant/(.*)/(.*).html'] = "/admin_merchant/block_merchant/1/$1/$2";
$config['admin/delete-merchant/(.*)/(.*).html'] = "/admin_merchant/delete_merchant/$1/$2";
$config['admin/merchant-dashboard.html'] = "/admin_merchant/dashboard_merchant";
$config['admin/disapprove-merchant/(.*).html'] = "/admin_merchant/approvedisapprove_merchant/0/$1";
$config['admin/approve-merchant/(.*).html'] = "/admin_merchant/approvedisapprove_merchant/1/$1";
$config['admin/edit-merchant-personalized/(.*).html'] = "/admin_merchant/edit_merchant_personalized/$1";

/** ADMIN MERCHANT SHOP**/

$config['admin/add-merchant-shop/(.*).html'] = "/admin_merchant/add_merchant_shop/$1";
$config['admin/merchant-shop/(.*).html'] = "/admin_merchant/manage_merchant_shop/$1";
$config['admin/merchant-shop/(.*).html/page/(.*)'] = "/admin_merchant/manage_merchant_shop/$1/$2";
$config['admin/edit-merchant-shop/(.*)/(.*).html'] = "/admin_merchant/edit_merchant_shop/$1/$2";
$config['admin/block-merchant-shop/(.*)/(.*).html'] = "/admin_merchant/block_merchant_shop/0/$1/$2";
$config['admin/unblock-merchant-shop/(.*)/(.*).html'] = "/admin_merchant/block_merchant_shop/1/$1/$2";
$config['admin/delete-merchant-shop/(.*)/(.*).html'] = "/admin_merchant/delete_merchant_shop/$1/$2";
$config['admin/merchant-details/(.*).html'] = "/admin_merchant/merchant_details/$1";

/** FUND REQUEST**/

$config['admin/all-fund-request.html'] = "/admin_payment";
$config['admin/approved-fund-request.html'] = "/admin_payment/index/request_status/2";
$config['admin/reject-fund-request.html'] = "/admin_payment/index/request_status/3";
$config['admin/success-fund-request.html'] = "/admin_payment/index/payment_status/1";
$config['admin/failed-fund-request.html'] = "/admin_payment/index/payment_status/2";
$config['admin/all-fund-request/page/(.*)'] = "/admin_payment/index/request_status//$1";
$config['admin/approved-fund-request/page/(.*)'] = "/admin_payment/index/request_status/2/$1";
$config['admin/reject-fund-request/page/(.*)'] = "/admin_payment/index/request_status/3/$1";
$config['admin/success-fund-request/page/(.*)'] = "/admin_payment/index/payment_status/1/$1";
$config['admin/failed-fund-request/page/(.*)'] = "/admin_payment/index/payment_status/2/$1";
$config['admin/update-fund-request-status/(.*)/(.*)/(.*).html'] = "/paypal/masspay_fund_update/$1/$2/$3";
$config['admin/message-fund-request-status/(.*)/(.*).html'] = "/admin_payment/message_fund_update/$1/$2";

/** TRANSACTION **/

$config['admin/transaction-dashboard.html'] = "/admin_payment/dashboard_transaction";
$config['admin/all-transaction.html'] = "/admin_payment/admin_transaction";
$config['admin/success-transaction.html'] = "/admin_payment/admin_transaction/Success";
$config['admin/completed-transaction.html'] = "/admin_payment/admin_transaction/Completed";
$config['admin/failed-transaction.html'] = "/admin_payment/admin_transaction/Failed";
$config['admin/hold-transaction.html'] = "/admin_payment/admin_transaction/Pending";
$config['admin/all-transaction/page/(.*)'] = "/admin_payment/admin_transaction/mail/$1";
$config['admin/success-transaction/page/(.*)'] = "/admin_payment/admin_transaction/Success/$1";
$config['admin/completed-transaction/page/(.*)'] = "/admin_payment/admin_transaction/Completed/$1";
$config['admin/failed-transaction/page/(.*)'] = "/admin_payment/admin_transaction/Failed/$1";
$config['admin/hold-transaction/page/(.*)'] = "/admin_payment/admin_transaction/Pending/$1";

/** DEAL COD TRANSACTION **/

$config['admin-deal-cod/all-transaction.html'] = "/admin_payment/deal_cod_transaction";
$config['admin-deal-cod/success-transaction.html'] = "/admin_payment/deal_cod_transaction/Success";
$config['admin-deal-cod/completed-transaction.html'] = "/admin_payment/deal_cod_transaction/Completed";
$config['admin-deal-cod/failed-transaction.html'] = "/admin_payment/deal_cod_transaction/Failed";
$config['admin-deal-cod/hold-transaction.html'] = "/admin_payment/deal_cod_transaction/Pending";
$config['admin-deal-cod/all-transaction/page/(.*)'] = "/admin_payment/deal_cod_transaction/mail/$1";
$config['admin-deal-cod/success-transaction/page/(.*)'] = "/admin_payment/deal_cod_transaction/Success/$1";
$config['admin-deal-cod/completed-transaction/page/(.*)'] = "/admin_payment/deal_cod_transaction/Completed/$1";
$config['admin-deal-cod/failed-transaction/page/(.*)'] = "/admin_payment/deal_cod_transaction/Failed/$1";
$config['admin-deal-cod/hold-transaction/page/(.*)'] = "/admin_payment/deal_cod_transaction/Pending/$1";

/** ADMIN PRODUCT**/

$config['admin/add-products.html'] = "/admin_products/add_product";
$config['admin/manage-products.html'] = "/admin_products/manage_product";
$config['admin/manage-products.html/page/(.*)'] = "/admin_products/manage_product/0/$1";
$config['admin/sold-products.html'] = "/admin_products/manage_product/1";
$config['admin/sold-products.html/page/(.*)'] = "/admin_products/manage_product/1/$1";
$config['admin/view-products/(.*)/(.*).html'] ="/admin_products/view_product/$1/$2";
$config['admin/edit-products/(.*)/(.*)/(.*).html'] = "/admin_products/edit_product/$1/$2/$3";
$config['admin/block-products/(.*)/(.*).html'] = "/admin_products/block_product/0/$1/$2";
$config['admin/unblock-products/(.*)/(.*).html'] = "/admin_products/block_product/1/$1/$2";
$config['admin/delete-products/(.*)/(.*).html'] = "/admin_products/delete_product/$1/$2";
$config['admin/products-dashboard.html'] = "/admin_products/dashboard_products";
$config['admin/send-product/(.*)/(.*).html'] ="/admin_products/send_email/$1/$2";
$config['delete-product-images.html']="/admin_products/delete_product_images";
$config['admin/confirm-product-status/(.*)/(.*).html'] = "/admin_products/confirm_product/$1/$2";


/** PRODUCT IMPORT **/

$config['admin/product-import.html'] = "/admin_products/product_import";
$config['admin/manage-product-import.html']="admin_products/manage-product-import";
$config['merchant/product-import.html'] = "/merchant/product_import";

/** ADS MANAGEMENT**/

$config['admin/block-ads/(.*)'] = "/ads/block_ads/0/$1";
$config['admin/unblock-ads/(.*)'] = "/ads/block_ads/1/$1";
$config['admin/delete-ads/(.*)'] = "/ads/delete_ads/$1";
$config['admin/edit-ads/(.*)'] = "/ads/edit_ads/$1";
$config['adds_mgmt/add_adds.html'] = "ads/add_adds";
$config['adds_mgmt/manage_adds.html']="ads/view_adds";

/** ATTRIBUTE MANAGEMENT  **/

$config['admin/add-attribute.html'] = "/admin_attributes/add_attribute";
$config['admin/manage-attribute.html'] = "/admin_attributes/manage_attribute";
$config['admin/manage-attribute.html/page/(.*)'] = "/admin_attributes/manage_attribute/$1";
$config['admin/edit-attribute/(.*).html'] = "/admin_attributes/edit_attribute/$1";
$config['admin/delete-attribute/(.*).html'] = "/admin_attributes/delete_attribute/$1";

/** ATTRIBUTE GROUP MANAGEMENT  **/

$config['admin/add-attribute-group.html'] = "/admin_attributes/add_attribute_group";
$config['admin/manage-attribute-group.html'] = "/admin_attributes/manage_attribute_group";
$config['admin/manage-attribute-group.html/page/(.*)'] = "/admin_attributes/manage_attribute_group/$1";
$config['admin/edit-attribute-group/(.*).html'] = "/admin_attributes/edit_attribute_group/$1";
$config['admin/delete-attribute-group/(.*).html'] = "/admin_attributes/delete_attribute_group/$1";

$config['facebook-post-deals.php'] = "/admin/facebook_autopost";
$config['admin/force-close/(.*)/(.*).html'] = "/admin_deals/forceclose_deal/$1/$2";
$config['admin/close-deals/(.*)/(.*)/(.*)/(.*).html'] = "/admin/close_deals/0/$1/$2/$3/$4";
$config['admin/close-deals-cod/(.*)/(.*)/(.*)/(.*).html'] = "/admin/close_deals_cod/0/$1/$2/$3/$4/$5";
$config['admin/couopn_code.html'] = "/admin/couopn_code";

/** SECTOR MANAGEMENT **/

$config['admin/add-sector.html'] = "/admin/add_sector";
$config['admin/manage-sector.html'] = "/admin/manage_sector";
$config['admin/manage-sector.html/page/(.*)'] = "/admin/manage_sector/$1";
$config['admin/edit-sector/(.*).html'] = "/admin/edit_sector/$1";
$config['admin/delete-sector/(.*).html'] = "/admin/delete_sector/$1";
$config['admin/block-sector/(.*).html'] = "/admin/block_sector/0/$1";
$config['admin/unblock-sector/(.*).html'] = "/admin/block_sector/1/$1";

/** Sub Sector **/

$config['admin/add-sub-sector/(.*)/(.*).html'] = "/admin/add_sub_sector/$1/$2";
$config['admin/edit-sub-sector/(.*)/(.*).html'] = "/admin/edit_sub_sector/$1/$2";
$config['admin/manage-sub-sector/(.*)/(.*).html'] = "/admin/manage_sub_sector/$1/$2";
$config['admin/block-sub-sector/(.*)/(.*)/(.*).html'] = "/admin/block_sub_sector/0/$1/$2/$3";
$config['admin/unblock-sub-sector/(.*)/(.*)/(.*).html'] = "/admin/block_sub_sector/1/$1/$2/$3";
$config['admin/delete-sub-sector/(.*).html'] = "/admin/delete_sub_sector/$1";


/** Customer care **/

$config['admin/add-customer-care.html'] = "/admin_customer_care/add_users";
$config['admin/manage-customer-care.html'] = "/admin_customer_care/manage_users";
$config['admin/manage-customer-care.html/page/(.*)'] = "/admin_customer_care/manage_users/$1";
$config['admin/edit-customer-care/(.*).html'] = "/admin_customer_care/edit_users/$1";
$config['admin/block-customer-care/(.*)/(.*).html'] = "/admin_customer_care/block_user/0/$1/$2";
$config['admin/unblock-customer-care/(.*)/(.*).html'] = "/admin_customer_care/block_user/1/$1/$2";
$config['admin/delete-customer-care/(.*)/(.*).html'] = "/admin_customer_care/delete_user/$1/$2";
$config['admin/view-customer-care/(.*).html'] ="/admin_customer_care/view_user/$1";
$config['admin/customer-care-dashboard.html'] = "/admin_customer_care/dashboard_users";

$config['admin/get_emailid.html'] = '/newsletter/get_emailid';




/** Admin User NEWSletter **/
$config['admin/send-user-newsletter.html'] = "/admin_users/send_user_emails";
$config['admin/send-merchant-newsletter.html'] = "/admin_merchant/send_merchant_emails";
$config['admin/email_inbox.html'] = "/admin_users/user_mail_inbox";
$config['admin/email_inbox.html/page/(.*)'] = "/admin_users/user_mail_inbox/$1";
$config['admin/show-user-message/(.*).html'] = "/admin_users/show_user_message/$1";
$config['admin/merchant_email_inbox.html'] = "/admin_merchant/merchant_mail_inbox";
$config['admin/merchant_email_inbox.html/page/(.*)'] = "/admin_merchant/merchant_mail_inbox/$1";
$config['admin/show-merchant-message/(.*).html'] = "/admin_merchant/show_merchant_message/$1";



$config['admin/getlike_subsector.html'] = "/admin/getlike_subsector";

$config['admin/add-template.html'] = "newsletter/add_template";
$config['admin/manage-template.html'] = "newsletter/manage_template";
$config['admin/manage-template.html/page/(.*)'] = "newsletter/manage_template/$1";
$config['admin/edit-template/(.*).html'] = "newsletter/edit_template/$1";
$config['admin/block-template/(.*).html'] = "newsletter/blockunblock_template/0/$1";
$config['admin/unblock-template/(.*).html'] = "newsletter/blockunblock_template/1/$1";
$config['admin/delete-template/(.*).html'] = "newsletter/delete_template/$1";



/* STORECREDIT ORDER MANAGEMENT */
$config['admin-products/storecredits/pending-transaction.html'] = "/admin_products/storecredit_transaction";
$config['admin-products/storecredits/pending-transaction.html/page/(.*)'] = "/admin_products/storecredit_transaction";
$config['admin-products/storecredits/success-transaction.html'] = "/admin_products/storecredit_transaction/Success";
$config['admin-products/storecredits/purchase-transaction.html'] = "/admin_products/storecredit_transaction/Purchased";
$config['admin-products/storecredits/failed-transaction.html'] = "/admin_products/storecredit_transaction/Failed";


$config['admin-storecredits/all-transaction.html'] = "/admin_payment/store_credits_transaction";
$config['admin-storecredits/success-transaction.html'] = "/admin_payment/store_credits_transaction/Completed";
$config['admin-storecredits/failed-transaction.html'] = "/admin_payment/store_credits_transaction/Failed";
$config['admin-storecredits/hold-transaction.html'] = "/admin_payment/store_credits_transaction/Pending";
$config['admin-storecredits/all-transaction/page/(.*)'] = "/admin_payment/store_credits_transaction/mail/$1";
$config['admin-storecredits/success-transaction/page/(.*)'] = "/admin_payment/store_credits_transaction/Completed/$1";
$config['admin-storecredits/failed-transaction/page/(.*)'] = "/admin_payment/store_credits_transaction/Faild/$1";
$config['admin-storecredits/hold-transaction/page/(.*)'] = "/admin_payment/store_credits_transaction/Pending/$1";

/* Moderator - starts */
$config['admin/moderator-dashboard.html'] = "/admin_moderator/dashboard_moderator";
$config['admin/add-moderator.html'] = "/admin_moderator/add_moderator";
$config['admin/manage-moderator.html'] = "/admin_moderator/manage_moderator";
$config['admin/manage-moderator.html/page/(.*)'] = "/admin_moderator/manage_moderator/$1";
$config['admin/edit-moderator/(.*).html'] = "/admin_moderator/edit_moderator/$1";
$config['admin/block-moderator/(.*)/(.*).html'] = "/admin_moderator/block_moderator/0/$1/$2";
$config['admin/unblock-moderator/(.*)/(.*).html'] = "/admin_moderator/block_moderator/1/$1/$2";
$config['admin/delete-moderator/(.*)/(.*).html'] = "/admin_moderator/delete_moderator/$1/$2";
$config['admin/view-moderator/(.*).html'] ="/admin_moderator/view_moderator/$1";
/* Moderator - End */
